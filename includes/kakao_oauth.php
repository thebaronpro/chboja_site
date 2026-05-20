<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

/*
|--------------------------------------------------------------------------
| 카카오 OAuth 설정
|--------------------------------------------------------------------------
| 1. Kakao Developers (https://developers.kakao.com) 앱 생성
| 2. 앱 키 (REST API) 발급
| 3. 플랫폼 → Web → 사이트 도메인 등록 (HTTPS)
| 4. 카카오 로그인 활성화 + Redirect URI 등록:
|       https://도메인/rental/kakao_callback.php
| 5. 동의 항목: 카카오계정(이메일), 프로필 닉네임, 전화번호(선택)
|
| 운영 환경에서는 KAKAO_REST_KEY를 환경변수 또는 별도 파일로 분리.
| 로컬에서는 HTTPS가 없어 실제 OAuth 흐름 테스트 불가.
*/

const KAKAO_REST_KEY     = '';  // ★ Kakao Developers에서 발급받은 REST API 키
const KAKAO_REDIRECT_URI = '';  // ★ 예: https://chaboza.cafe24.com/rental/kakao_callback.php
const KAKAO_LOGOUT_REDIRECT = '/';  // 로그아웃 후 이동 URL

const KAKAO_AUTH_URL  = 'https://kauth.kakao.com/oauth/authorize';
const KAKAO_TOKEN_URL = 'https://kauth.kakao.com/oauth/token';
const KAKAO_USER_URL  = 'https://kapi.kakao.com/v2/user/me';
const KAKAO_LOGOUT_URL = 'https://kauth.kakao.com/oauth/logout';

const SESSION_COOKIE_NAME = 'chaboza_sess';
const SESSION_DAYS = 14;

function kakao_oauth_configured(): bool
{
    return KAKAO_REST_KEY !== '' && KAKAO_REDIRECT_URI !== '';
}

/* ---------------------- state (CSRF 방어) ---------------------- */
function kakao_create_state(?string $redirectTo = null): string
{
    $state = bin2hex(random_bytes(16));
    db_exec(
        "INSERT INTO chaboza_oauth_state (state, redirect_to) VALUES (:s, :r)",
        [':s' => $state, ':r' => $redirectTo]
    );
    db_exec("DELETE FROM chaboza_oauth_state WHERE created_at < DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
    return $state;
}

function kakao_consume_state(string $state): ?string
{
    $row = db_one(
        "SELECT redirect_to FROM chaboza_oauth_state
         WHERE state = :s AND created_at >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)",
        [':s' => $state]
    );
    if (!$row) return null;
    db_exec("DELETE FROM chaboza_oauth_state WHERE state = :s", [':s' => $state]);
    return $row['redirect_to'] ?? '/';
}

/* ---------------------- 인증 URL 생성 ---------------------- */
function kakao_authorize_url(?string $redirectTo = null): string
{
    if (!kakao_oauth_configured()) {
        throw new RuntimeException('Kakao OAuth not configured (KAKAO_REST_KEY / KAKAO_REDIRECT_URI).');
    }
    $state = kakao_create_state($redirectTo);
    $params = http_build_query([
        'response_type' => 'code',
        'client_id'     => KAKAO_REST_KEY,
        'redirect_uri'  => KAKAO_REDIRECT_URI,
        'state'         => $state,
    ]);
    return KAKAO_AUTH_URL . '?' . $params;
}

/* ---------------------- 토큰 교환 ---------------------- */
function kakao_exchange_token(string $code): array
{
    $payload = http_build_query([
        'grant_type'   => 'authorization_code',
        'client_id'    => KAKAO_REST_KEY,
        'redirect_uri' => KAKAO_REDIRECT_URI,
        'code'         => $code,
    ]);
    $ch = curl_init(KAKAO_TOKEN_URL);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 8,
    ]);
    $res = curl_exec($ch);
    if ($res === false) {
        $err = curl_error($ch);
        curl_close($ch);
        throw new RuntimeException("Kakao token exchange curl error: $err");
    }
    curl_close($ch);
    $data = json_decode($res, true);
    if (!is_array($data) || empty($data['access_token'])) {
        throw new RuntimeException('Kakao token exchange failed: ' . (string)$res);
    }
    return $data;
}

/* ---------------------- 사용자 정보 조회 ---------------------- */
function kakao_fetch_user(string $accessToken): array
{
    $ch = curl_init(KAKAO_USER_URL);
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $accessToken],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 8,
    ]);
    $res = curl_exec($ch);
    if ($res === false) {
        $err = curl_error($ch);
        curl_close($ch);
        throw new RuntimeException("Kakao user fetch curl error: $err");
    }
    curl_close($ch);
    $data = json_decode($res, true);
    if (!is_array($data) || empty($data['id'])) {
        throw new RuntimeException('Kakao user fetch failed: ' . (string)$res);
    }
    return $data;
}

/* ---------------------- 사용자 upsert ---------------------- */
function kakao_user_upsert(array $kakaoUser): int
{
    $kakaoId  = (int)$kakaoUser['id'];
    $account  = $kakaoUser['kakao_account'] ?? [];
    $profile  = $account['profile'] ?? [];
    $email    = $account['email']    ?? null;
    $nickname = $profile['nickname'] ?? null;
    $phone    = $account['phone_number'] ?? null;

    $existing = db_one("SELECT id FROM chaboza_users WHERE kakao_id = :k", [':k' => $kakaoId]);
    if ($existing) {
        db_exec(
            "UPDATE chaboza_users
             SET email = COALESCE(:e, email),
                 nickname = COALESCE(:n, nickname),
                 phone = COALESCE(:p, phone),
                 last_login_at = NOW()
             WHERE id = :id",
            [':e' => $email, ':n' => $nickname, ':p' => $phone, ':id' => $existing['id']]
        );
        return (int)$existing['id'];
    }

    db_exec(
        "INSERT INTO chaboza_users (kakao_id, email, nickname, phone, last_login_at)
         VALUES (:k, :e, :n, :p, NOW())",
        [':k' => $kakaoId, ':e' => $email, ':n' => $nickname, ':p' => $phone]
    );
    return (int)db()->lastInsertId();
}

/* ---------------------- 세션 ---------------------- */
function kakao_session_create(int $userId): string
{
    $sid = bin2hex(random_bytes(32));
    $expires = (new DateTimeImmutable('+' . SESSION_DAYS . ' days'))->format('Y-m-d H:i:s');
    db_exec(
        "INSERT INTO chaboza_sessions (id, user_id, ip_address, user_agent, expires_at)
         VALUES (:id, :u, :ip, :ua, :exp)",
        [
            ':id'  => $sid,
            ':u'   => $userId,
            ':ip'  => $_SERVER['REMOTE_ADDR'] ?? null,
            ':ua'  => mb_substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
            ':exp' => $expires,
        ]
    );
    setcookie(SESSION_COOKIE_NAME, $sid, [
        'expires'  => time() + SESSION_DAYS * 86400,
        'path'     => '/',
        'secure'   => true,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    return $sid;
}

function kakao_session_destroy(): void
{
    $sid = $_COOKIE[SESSION_COOKIE_NAME] ?? null;
    if ($sid) {
        db_exec("DELETE FROM chaboza_sessions WHERE id = :s", [':s' => $sid]);
    }
    setcookie(SESSION_COOKIE_NAME, '', [
        'expires'  => time() - 3600,
        'path'     => '/',
        'secure'   => true,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

function current_user(): ?array
{
    static $cached = false; static $user = null;
    if ($cached) return $user;
    $cached = true;
    $sid = $_COOKIE[SESSION_COOKIE_NAME] ?? null;
    if (!$sid) return null;
    $user = db_one(
        "SELECT u.* FROM chaboza_users u
         JOIN chaboza_sessions s ON s.user_id = u.id
         WHERE s.id = :s AND s.expires_at > NOW() AND u.status = 'active'
         LIMIT 1",
        [':s' => $sid]
    );
    return $user;
}

function require_login(string $loginUrl = '/rental/kakao_login.php'): void
{
    if (!current_user()) {
        header('Location: ' . $loginUrl);
        exit;
    }
}
