<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

const INQUIRY_SOURCES = [
    'contact'        => '1:1 문의 (고객센터)',
    'installment'    => '할부 상담',
    'lease'          => '화물리스 상담',
    'rental_fab'     => '간편 상담 (모바일 FAB)',
    'rental_bottom'  => '장기렌트 하단 상담',
    'rental_quote'   => '견적 문의',
];

const INQUIRY_NOTIFY_TO   = 'help@chaboza.kr';
const INQUIRY_NOTIFY_FROM = 'noreply@chaboza.kr';

function inquiry_normalize_phone(string $raw): string
{
    $s = preg_replace('/[^\d]/', '', $raw);
    if ($s === null || $s === '') return '';
    if (preg_match('/^010\d{7,8}$/', $s)) {
        return preg_replace('/^(010)(\d{3,4})(\d{4})$/', '$1-$2-$3', $s);
    }
    return $s;
}

function inquiry_validate(array $in): array
{
    $errors = [];
    $name = trim((string)($in['name'] ?? ''));
    $phone = trim((string)($in['phone'] ?? ''));

    if ($name === '')                            $errors['name']  = '성함을 입력해 주세요.';
    elseif (mb_strlen($name, 'UTF-8') > 100)     $errors['name']  = '성함이 너무 깁니다.';

    if ($phone === '')                                       $errors['phone'] = '연락처를 입력해 주세요.';
    elseif (!preg_match('/[\d]{8,}/', preg_replace('/[^\d]/', '', $phone))) $errors['phone'] = '연락처 형식을 확인해 주세요.';

    return $errors;
}

function inquiry_save(string $source, array $in): ?int
{
    if (!isset(INQUIRY_SOURCES[$source])) {
        throw new InvalidArgumentException("Unknown inquiry source: $source");
    }

    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if (mb_strlen($ua, 'UTF-8') > 500) $ua = mb_substr($ua, 0, 500, 'UTF-8');

    $sql = "INSERT INTO chaboza_inquiries
            (source, category, name, phone, car, message, consent_marketing, ip_address, user_agent)
            VALUES (:source, :category, :name, :phone, :car, :message, :consent, :ip, :ua)";

    db_exec($sql, [
        ':source'   => $source,
        ':category' => $in['category'] ?? null,
        ':name'     => trim((string)($in['name'] ?? '')),
        ':phone'    => inquiry_normalize_phone((string)($in['phone'] ?? '')),
        ':car'      => trim((string)($in['car'] ?? '')) ?: null,
        ':message'  => trim((string)($in['message'] ?? '')) ?: null,
        ':consent'  => !empty($in['consent_marketing']) ? 1 : 0,
        ':ip'       => $_SERVER['REMOTE_ADDR'] ?? null,
        ':ua'       => $ua ?: null,
    ]);

    $id = (int)db()->lastInsertId();
    return $id > 0 ? $id : null;
}

function inquiry_notify(string $source, array $in, int $id): bool
{
    if (!function_exists('mail')) return false;

    $label = INQUIRY_SOURCES[$source] ?? $source;
    $to = INQUIRY_NOTIFY_TO;
    $subject = sprintf('[차보자] 새 문의 #%d - %s', $id, $label);

    $lines = [
        "출처: {$label}",
        "접수번호: #{$id}",
        "시각: " . date('Y-m-d H:i:s'),
        "",
        "이름: " . trim((string)($in['name'] ?? '')),
        "연락처: " . inquiry_normalize_phone((string)($in['phone'] ?? '')),
    ];
    if (!empty($in['category']))           $lines[] = "유형: " . trim((string)$in['category']);
    if (!empty($in['car']))                $lines[] = "관심 차량: " . trim((string)$in['car']);
    if (!empty($in['message']))            $lines[] = "\n내용:\n" . trim((string)$in['message']);
    if (!empty($in['consent_marketing']))  $lines[] = "\n마케팅 수신 동의: 예";

    $body = implode("\n", $lines);
    $headers  = "From: " . INQUIRY_NOTIFY_FROM . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: chaboza-php/" . phpversion();

    return @mail($to, $subject, $body, $headers);
}

/**
 * 폼 POST 처리. validation → DB 저장 → 이메일 알림.
 * @return array{ok:bool, id:?int, errors:array<string,string>, notified:?bool}
 */
function inquiry_process(string $source, array $in): array
{
    $errors = inquiry_validate($in);
    if (!empty($errors)) {
        return ['ok' => false, 'id' => null, 'errors' => $errors, 'notified' => null];
    }

    try {
        $id = inquiry_save($source, $in);
    } catch (Throwable $e) {
        error_log('[inquiry] save failed: ' . $e->getMessage());
        return ['ok' => false, 'id' => null, 'errors' => ['_db' => '저장 중 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.'], 'notified' => null];
    }

    if ($id === null) {
        return ['ok' => false, 'id' => null, 'errors' => ['_db' => '접수에 실패했습니다.'], 'notified' => null];
    }

    $notified = inquiry_notify($source, $in, $id);
    return ['ok' => true, 'id' => $id, 'errors' => [], 'notified' => $notified];
}
