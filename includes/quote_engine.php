<?php
/**
 * 차보자 견적 엔진 — KB 베이스 매트릭스 + 보간 공식
 *
 * Python의 scripts/demo_full_quote.py를 PHP로 포팅한 버전.
 * MySQL/JSON 두 백엔드를 환경변수로 전환 가능.
 *
 * 환경변수:
 *   QUOTE_BACKEND = 'mysql' | 'json'  (기본: json)
 *   QUOTE_JSON_PATH = JSON 파일 경로 (백엔드가 json일 때)
 *
 * 사용:
 *   require_once __DIR__ . '/quote_engine.php';
 *   $result = quote_calculate([
 *       'capital_code' => 'KB',
 *       'trim_id'      => 42,           // MySQL 백엔드용
 *       'vehicle_id'   => 'avante',     // JSON 백엔드용
 *       'term'         => 48,
 *       'mileage'      => 10000,
 *       'prepay_pct'   => 30,
 *       'deposit_pct'  => 0,
 *   ]);
 */

declare(strict_types=1);

// ===========================================================================
// 1. 설정
// ===========================================================================

const QUOTE_DEFAULT_INTEREST_RATE = 0.0614;   // KB 다이렉트 검증값
const QUOTE_DEFAULT_DEPOSIT_FACTOR = 0.0004;
const QUOTE_DEFAULT_PREPAY_FACTOR = 1.0;

function quote_backend(): string {
    return getenv('QUOTE_BACKEND') ?: 'json';
}

function quote_json_path(): string {
    return getenv('QUOTE_JSON_PATH')
        ?: dirname(__DIR__) . '/quote-engine/sample_data/avante_full_matrix_20260526.json';
}


// ===========================================================================
// 2. 베이스 견적 조회 — 백엔드 분기
// ===========================================================================

function quote_lookup_base(array $req): ?array {
    if (quote_backend() === 'mysql') {
        return quote_lookup_base_mysql($req);
    }
    return quote_lookup_base_json($req);
}

function quote_lookup_base_mysql(array $req): ?array {
    if (!function_exists('db_pdo')) {
        require_once __DIR__ . '/db.php';
    }
    $pdo = db_pdo();

    // capital_id 조회
    $stmt = $pdo->prepare("SELECT id FROM chaboza_capital_company WHERE code = ? LIMIT 1");
    $stmt->execute([$req['capital_code'] ?? 'KB']);
    $capital = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$capital) return null;

    // 베이스 견적
    $stmt = $pdo->prepare("
        SELECT bq.*, t.base_price AS vehicle_price, t.trim_name, vm.brand, vm.model_name, vm.category
        FROM chaboza_base_quote bq
        JOIN chaboza_trim t ON t.id = bq.trim_id
        JOIN chaboza_vehicle_model vm ON vm.id = t.model_id
        WHERE bq.capital_id = ? AND bq.trim_id = ?
          AND bq.term_months = ? AND bq.annual_mileage_km = ?
        ORDER BY bq.collected_at DESC LIMIT 1
    ");
    $stmt->execute([
        (int)$capital['id'],
        (int)$req['trim_id'],
        (int)$req['term'],
        (int)$req['mileage'],
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) return null;

    return [
        'capital_id'           => (int)$capital['id'],
        'trim_id'              => (int)$row['trim_id'],
        'vehicle_price'        => (int)$row['vehicle_price'],
        'trim_name'            => $row['trim_name'],
        'category'             => $row['category'] ?? null,
        'residual_pct'         => (float)$row['residual_pct'],
        'residual_amount'      => (int)$row['residual_amount'],
        'monthly_base_payment' => (int)$row['monthly_base_payment'],
        'collected_at'         => $row['collected_at'],
    ];
}

function quote_lookup_base_json(array $req): ?array {
    static $cache = null;
    if ($cache === null) {
        $path = quote_json_path();
        if (!file_exists($path)) return null;
        $cache = json_decode(file_get_contents($path), true);
    }
    if (!is_array($cache)) return null;

    $vehicle = $cache['vehicle'] ?? null;
    if (!$vehicle) return null;

    foreach (($cache['base_matrix'] ?? []) as $bm) {
        if ((int)$bm['term_months'] === (int)$req['term']
            && (int)$bm['annual_mileage_km'] === (int)$req['mileage']) {
            return [
                'capital_id'           => 1,
                'trim_id'              => 0,
                'vehicle_price'        => (int)$vehicle['base_price'],
                'trim_name'            => $vehicle['trim_name'],
                'category'             => 'sedan_popular',
                'residual_pct'         => (float)$bm['residual_pct'],
                'residual_amount'      => (int)$bm['residual_amount'],
                'monthly_base_payment' => (int)$bm['monthly_base_payment'],
                'collected_at'         => $cache['_metadata']['collected_at'] ?? null,
            ];
        }
    }
    return null;
}


// ===========================================================================
// 3. 보간 공식 파라미터 조회
// ===========================================================================

function quote_get_params(int $capital_id, ?string $category): array {
    if (quote_backend() === 'mysql' && $capital_id > 0) {
        if (!function_exists('db_pdo')) require_once __DIR__ . '/db.php';
        $pdo = db_pdo();
        // 카테고리별 우선, 없으면 capital 기본값
        $stmt = $pdo->prepare("
            SELECT interest_rate, deposit_factor, prepay_factor
            FROM chaboza_formula_params
            WHERE capital_id = ?
              AND (category = ? OR category IS NULL)
              AND CURRENT_DATE BETWEEN effective_from AND COALESCE(effective_to, CURRENT_DATE)
            ORDER BY (category = ?) DESC, effective_from DESC
            LIMIT 1
        ");
        $stmt->execute([$capital_id, $category, $category]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return [
                'interest_rate'  => (float)$row['interest_rate'],
                'deposit_factor' => (float)$row['deposit_factor'],
                'prepay_factor'  => (float)$row['prepay_factor'],
            ];
        }
    }
    return [
        'interest_rate'  => QUOTE_DEFAULT_INTEREST_RATE,
        'deposit_factor' => QUOTE_DEFAULT_DEPOSIT_FACTOR,
        'prepay_factor'  => QUOTE_DEFAULT_PREPAY_FACTOR,
    ];
}


// ===========================================================================
// 4. 핵심 계산 함수
// ===========================================================================

function quote_calculate(array $req): array {
    $start_us = microtime(true);

    // 입력 검증
    $term       = (int)($req['term'] ?? 48);
    $mileage    = (int)($req['mileage'] ?? 10000);
    $prepay_pct = max(0, min(50, (int)($req['prepay_pct'] ?? 0)));
    $deposit_pct = max(0, min(50, (int)($req['deposit_pct'] ?? 0)));

    // 1순위: KB 누적 데이터에서 정확한 매트릭스 매칭 시도
    require_once __DIR__ . '/capital_pricing.php';
    $is_estimated = false;
    $base = null;
    if (($req['capital_code'] ?? 'KB') === 'KB' && !empty($req['model_name'])) {
        $exact = kb_lookup_exact_quote([
            'brand' => $req['brand'] ?? '',
            'model_name' => $req['model_name'] ?? '',
            'trim_name' => $req['trim_name'] ?? '',
        ], $term, $mileage);
        if ($exact) {
            $tr = $exact['trim_record'];
            $base = [
                'capital_id' => 1,
                'trim_id' => 0,
                'vehicle_price' => $tr['base_price'],
                'price_source' => 'kb_actual',
                'matched_kb_trim' => $tr['kb_full_trim_name'],
                'danawa_price' => (int)($req['vehicle_price'] ?? 0),
                'trim_name' => $tr['kb_full_trim_name'],
                'category' => $tr['category'] ?? null,
                'residual_pct' => (float)$exact['residual_pct'],
                'residual_amount' => (int)$exact['residual_amount'],
                'monthly_base_payment' => (int)$exact['monthly_base_payment'],
                'collected_at' => $tr['collected_at'] ?? null,
            ];
        }
    }

    // 2순위: 기존 DB/JSON lookup
    if (!$base) {
        $base = quote_lookup_base($req);
    }

    // 3순위: 카테고리 매트릭스 추정
    if (!$base) {
        if (!empty($req['vehicle_price']) && !empty($req['model_name'])) {
            $base = quote_estimate_from_category($req, $term, $mileage);
            $is_estimated = true;
        } else {
            return [
                'ok'    => false,
                'error' => 'no_base_quote',
                'message' => '베이스 견적이 없고, vehicle_price/model_name도 없어 추정 불가.',
            ];
        }
    }

    // 파라미터
    $params = quote_get_params($base['capital_id'], $base['category'] ?? null);

    // 보간 계산
    $price = $base['vehicle_price'];
    $base_monthly = $base['monthly_base_payment'];

    // 선납금
    $prepay_amount = $price * $prepay_pct / 100;
    $factor = (1 + $params['interest_rate'] * $term / 24) / $term;
    $prepay_adj = -(int)round($prepay_amount * $factor * $params['prepay_factor']);

    // 보증금
    $deposit_amount = $price * $deposit_pct / 100;
    $deposit_adj = -(int)round($deposit_amount * $params['deposit_factor']);

    $monthly = $base_monthly + $prepay_adj + $deposit_adj;

    return [
        'ok' => true,
        'monthly_payment' => $monthly,
        'currency' => 'KRW',
        'breakdown' => [
            'base_monthly'       => $base_monthly,
            'prepay_adjustment'  => $prepay_adj,
            'deposit_adjustment' => $deposit_adj,
        ],
        'conditions' => [
            'trim_name'         => $base['trim_name'],
            'vehicle_price'     => $price,
            'price_source'      => $base['price_source'] ?? 'collected',
            'danawa_price'      => $base['danawa_price'] ?? null,
            'matched_kb_trim'   => $base['matched_kb_trim'] ?? null,
            'term_months'       => $term,
            'annual_mileage_km' => $mileage,
            'residual_pct'      => $base['residual_pct'],
            'residual_amount'   => $base['residual_amount'],
            'prepay_pct'        => $prepay_pct,
            'prepay_amount'     => (int)$prepay_amount,
            'deposit_pct'       => $deposit_pct,
            'deposit_amount'    => (int)$deposit_amount,
        ],
        'meta' => [
            'calculation_source' => $is_estimated
                ? 'estimated_from_category'
                : (($prepay_adj === 0 && $deposit_adj === 0) ? 'base' : 'interpolated'),
            'category'           => $base['category'] ?? null,
            'data_collected_at'  => $base['collected_at'] ?? null,
            'backend'            => quote_backend(),
            'response_ms'        => (int)round((microtime(true) - $start_us) * 1000),
        ],
    ];
}


// ===========================================================================
// 5. 카테고리 매트릭스 기반 추정 (수집 안 된 차량 처리)
// ===========================================================================

function quote_estimate_from_category(array $req, int $term, int $mileage): array {
    require_once __DIR__ . '/vehicle_classifier.php';
    require_once __DIR__ . '/capital_pricing.php';

    // ★ 캐피탈별 가격 lookup — KB는 다나와와 다름
    $capital_code = $req['capital_code'] ?? 'KB';
    $pricing = capital_price_for($capital_code, [
        'brand' => $req['brand'] ?? '',
        'model_name' => $req['model_name'] ?? '',
        'trim_name' => $req['trim_name'] ?? '',
        'base_price' => (int)$req['vehicle_price'],
    ]);
    $price = $pricing['price'];   // KB 가격 또는 다나와 fallback
    $price_source = $pricing['source'];
    $matched_kb_trim = $pricing['matched_trim_name'];

    $category = !empty($req['category'])
        ? $req['category']
        : classify_vehicle([
            'brand' => $req['brand'] ?? '',
            'model_name' => $req['model_name'] ?? '',
            'trim_name' => $req['trim_name'] ?? '',
            'fuel_type' => $req['fuel_type'] ?? '',
            'base_price' => $price,
        ]);

    // 잔가율 lookup
    $residual_pct = lookup_residual_pct($category, $term, $mileage);
    $residual_amount = (int)round($price * $residual_pct / 100);

    // 베이스 월납 추정 — 회귀 분석 기반 공식 (KB 9대 실측 데이터로 도출)
    //   월납 = (감가) × multiplier + 고정비
    //   multiplier: 감가에 추가되는 이자/마진 (약 1.55~1.60)
    //   fixed_cost: 차량가 무관 고정비 (보험 + 정비비 + 부대비용, 약 85,000~95,000원)
    // 카테고리마다 약간 다르게 튜닝 가능 (현재는 공통값 사용)
    $depreciation = ($price - $residual_amount) / $term;
    $multiplier = 1.572;
    $fixed_cost = 89081;

    $base_monthly = (int)round($depreciation * $multiplier + $fixed_cost);

    return [
        'capital_id'           => 1,
        'trim_id'              => 0,
        'vehicle_price'        => $price,
        'price_source'         => $price_source,            // 'kb_actual' 또는 'danawa_fallback'
        'matched_kb_trim'      => $matched_kb_trim,
        'danawa_price'         => (int)$req['vehicle_price'], // 비교용 (다나와 가격)
        'trim_name'            => $matched_kb_trim ?? (($req['brand'] ?? '') . ' ' . ($req['model_name'] ?? '') . ' ' . ($req['trim_name'] ?? '')),
        'category'             => $category,
        'residual_pct'         => $residual_pct,
        'residual_amount'      => $residual_amount,
        'monthly_base_payment' => $base_monthly,
        'collected_at'         => null,
    ];
}
