<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/inquiry.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'method_not_allowed'], JSON_UNESCAPED_UNICODE);
    exit;
}

$ctype = $_SERVER['CONTENT_TYPE'] ?? '';
$in = [];
if (stripos($ctype, 'application/json') !== false) {
    $raw = file_get_contents('php://input');
    $decoded = json_decode($raw ?: '{}', true);
    if (is_array($decoded)) $in = $decoded;
} else {
    $in = $_POST;
}

$source = (string)($in['source'] ?? '');
if (!isset(INQUIRY_SOURCES[$source])) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'invalid_source'], JSON_UNESCAPED_UNICODE);
    exit;
}

$result = inquiry_process($source, [
    'name'     => $in['name']     ?? '',
    'phone'    => $in['phone']    ?? '',
    'car'      => $in['car']      ?? null,
    'message'  => $in['message']  ?? null,
    'category' => $in['category'] ?? null,
    'consent_marketing' => !empty($in['consent_marketing']),
]);

if (!$result['ok']) http_response_code(422);
echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
