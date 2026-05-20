<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/kakao_oauth.php';

if (!kakao_oauth_configured()) {
    http_response_code(503);
    exit('Kakao OAuth가 설정되지 않았습니다. includes/kakao_oauth.php의 KAKAO_REST_KEY 및 KAKAO_REDIRECT_URI를 채워주세요.');
}

$code  = (string)($_GET['code']  ?? '');
$state = (string)($_GET['state'] ?? '');
$error = (string)($_GET['error'] ?? '');

if ($error !== '') {
    http_response_code(400);
    exit('카카오 로그인 거부됨: ' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8'));
}
if ($code === '' || $state === '') {
    http_response_code(400);
    exit('잘못된 콜백 요청입니다.');
}

$redirectTo = kakao_consume_state($state);
if ($redirectTo === null) {
    http_response_code(403);
    exit('state 검증 실패 (만료 또는 위조).');
}

try {
    $token = kakao_exchange_token($code);
    $info  = kakao_fetch_user($token['access_token']);
    $userId = kakao_user_upsert($info);
    kakao_session_create($userId);
} catch (Throwable $e) {
    error_log('[kakao_callback] ' . $e->getMessage());
    http_response_code(500);
    exit('카카오 로그인 처리 중 오류가 발생했습니다.');
}

$dest = $redirectTo !== '' ? $redirectTo : '/rental/';
header('Location: ' . $dest);
exit;
