<?php
/**
 * 다중 캐피탈 견적 비교 API.
 *
 * 차량 + 조건 받으면 모든 활성 캐피탈사의 견적을 동시에 반환.
 * 가장 저렴한 캐피탈을 자동 추천.
 *
 * GET /api/quote_compare.php?brand=현대&model_name=아반떼&trim_name=...&term=48&...
 */

declare(strict_types=1);

require_once __DIR__ . '/../includes/quote_engine.php';
require_once __DIR__ . '/../includes/capital_pricing.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'method_not_allowed']);
    exit;
}

$base_req = [
    'term'         => (int)($_GET['term'] ?? 48),
    'mileage'      => (int)($_GET['mileage'] ?? 10000),
    'prepay_pct'   => (int)($_GET['prepay_pct'] ?? 0),
    'deposit_pct'  => (int)($_GET['deposit_pct'] ?? 0),
    'brand'        => $_GET['brand'] ?? '',
    'model_name'   => $_GET['model_name'] ?? '',
    'trim_name'    => $_GET['trim_name'] ?? '',
    'fuel_type'    => $_GET['fuel_type'] ?? '',
    'vehicle_price' => (int)($_GET['vehicle_price'] ?? 0),
];

$start = microtime(true);
$results = [];

foreach (supported_capitals() as $cap) {
    if (!$cap['enabled']) {
        $results[] = [
            'capital_code' => $cap['code'],
            'capital_name' => $cap['name'],
            'enabled' => false,
            'note' => $cap['note'] ?? '',
        ];
        continue;
    }
    $req = $base_req;
    $req['capital_code'] = $cap['code'];
    $r = quote_calculate($req);
    $results[] = [
        'capital_code'    => $cap['code'],
        'capital_name'    => $cap['name'],
        'enabled'         => true,
        'ok'              => $r['ok'],
        'monthly_payment' => $r['ok'] ? $r['monthly_payment'] : null,
        'vehicle_price'   => $r['ok'] ? $r['conditions']['vehicle_price'] : null,
        'price_source'    => $r['ok'] ? ($r['conditions']['price_source'] ?? null) : null,
        'matched_kb_trim' => $r['ok'] ? ($r['conditions']['matched_kb_trim'] ?? null) : null,
        'breakdown'       => $r['ok'] ? $r['breakdown'] : null,
        'conditions'      => $r['ok'] ? $r['conditions'] : null,
        'calculation_source' => $r['ok'] ? $r['meta']['calculation_source'] : null,
        'error'           => $r['ok'] ? null : ($r['error'] ?? null),
    ];
}

// 최저가 캐피탈 추천
$enabled_ok = array_filter($results, fn($r) => ($r['ok'] ?? false));
$cheapest = null;
if (count($enabled_ok) > 0) {
    $sorted = $enabled_ok;
    usort($sorted, fn($a, $b) => $a['monthly_payment'] - $b['monthly_payment']);
    $cheapest = $sorted[0]['capital_code'];
}

echo json_encode([
    'ok' => true,
    'request' => $base_req,
    'results' => $results,
    'recommended' => $cheapest,
    'meta' => [
        'response_ms' => (int)round((microtime(true) - $start) * 1000),
        'enabled_count' => count($enabled_ok),
        'total_count' => count($results),
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
