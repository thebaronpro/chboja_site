<?php
/**
 * 견적 API — 랜딩 페이지가 호출하는 엔드포인트
 *
 * GET /api/quote.php?term=48&mileage=10000&prepay_pct=30&deposit_pct=0
 *   (JSON 백엔드: vehicle_id 옵션, MySQL 백엔드: trim_id 필수)
 */

declare(strict_types=1);

require_once __DIR__ . '/../includes/quote_engine.php';

// CORS — 운영 시 도메인 제한 권장
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'method_not_allowed'], JSON_UNESCAPED_UNICODE);
    exit;
}

// 입력 파싱
$req = [
    'capital_code' => $_GET['capital_code'] ?? 'KB',
    'trim_id'      => isset($_GET['trim_id']) ? (int)$_GET['trim_id'] : 0,
    'vehicle_id'   => $_GET['vehicle_id'] ?? null,
    'term'         => (int)($_GET['term'] ?? 48),
    'mileage'      => (int)($_GET['mileage'] ?? 10000),
    'prepay_pct'   => (int)($_GET['prepay_pct'] ?? 0),
    'deposit_pct'  => (int)($_GET['deposit_pct'] ?? 0),
    // 카테고리 매트릭스 추정 모드 (수집 안 된 차량용)
    'vehicle_price' => isset($_GET['vehicle_price']) ? (int)$_GET['vehicle_price'] : 0,
    'brand'        => $_GET['brand'] ?? '',
    'model_name'   => $_GET['model_name'] ?? '',
    'trim_name'    => $_GET['trim_name'] ?? '',
    'fuel_type'    => $_GET['fuel_type'] ?? '',
    'category'     => $_GET['category'] ?? '',   // 수동 지정 시
];

// 입력 검증
if (!in_array($req['term'], [12, 24, 36, 48, 60], true)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'invalid_term'], JSON_UNESCAPED_UNICODE);
    exit;
}
if (!in_array($req['mileage'], [10000, 15000, 20000, 30000, -1], true)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'invalid_mileage'], JSON_UNESCAPED_UNICODE);
    exit;
}
if ($req['prepay_pct'] < 0 || $req['prepay_pct'] > 50
    || $req['deposit_pct'] < 0 || $req['deposit_pct'] > 50) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'invalid_percent'], JSON_UNESCAPED_UNICODE);
    exit;
}

$result = quote_calculate($req);

if (!$result['ok']) {
    http_response_code(404);
}
echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
