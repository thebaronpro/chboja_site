<?php
/**
 * 차량 → 카테고리 자동 분류기
 *
 * car_brands.json의 임의 차량을 받아 카테고리 코드 반환.
 * 카테고리는 category_matrix.json의 키와 일치해야 함.
 */

declare(strict_types=1);

// ===========================================================================
// 분류 룰
// ===========================================================================

const DOMESTIC_BRANDS = ['현대', '기아', '제네시스', 'KG모빌리티', '르노코리아', '쉐보레', '르노'];
const LUXURY_BRANDS_HIGH = ['롤스로이스', '벤틀리', '마세라티', '람보르기니', '포르쉐', '맥라렌', '페라리'];
const LUXURY_MODELS_KEYWORDS = ['S-Class', 'S클래스', '7 Series', '7시리즈', 'A8', 'LS', 'EQS', '제네시스 G90', 'G90'];

// 차종명 → 카테고리 즉시 매핑 (가장 우선)
const MODEL_OVERRIDES = [
    // 경차/소형
    '모닝' => 'compact_low',
    '레이' => 'compact_low',
    '스파크' => 'compact_low',
    // 인기 세단
    '아반떼' => 'sedan_popular',
    'Avante' => 'sedan_popular',
    'CN7' => 'sedan_popular',
    '쏘나타' => 'sedan_popular',
    'Sonata' => 'sedan_popular',
    'DN8' => 'sedan_popular',
    '그랜저' => 'sedan_popular',
    'Grandeur' => 'sedan_popular',
    'GN7' => 'sedan_popular',
    'K3' => 'sedan_popular',
    'K5' => 'sedan_popular',
    'K7' => 'sedan_popular',
    'K8' => 'sedan_popular',
    // 인기 SUV
    '스포티지' => 'suv_popular',
    'Sportage' => 'suv_popular',
    '싼타페' => 'suv_popular',
    'SantaFe' => 'suv_popular',
    '팰리세이드' => 'suv_popular',
    'Palisade' => 'suv_popular',
    '쏘렌토' => 'suv_popular',
    'Sorento' => 'suv_popular',
    '투싼' => 'suv_popular',
    'Tucson' => 'suv_popular',
    // 소형 SUV
    '셀토스' => 'suv_compact',
    'Seltos' => 'suv_compact',
    '코나' => 'suv_compact',
    'Kona' => 'suv_compact',
    '트레일블레이저' => 'suv_compact',
    '캐스퍼' => 'suv_compact',
    'QM6' => 'suv_compact',
    '니로' => 'suv_compact',
    // 미니밴
    '카니발' => 'minivan',
    'Carnival' => 'minivan',
    '스타리아' => 'minivan',
    'Staria' => 'minivan',
];


/**
 * 메인 분류 함수.
 *
 * @param array $vehicle  ['brand'=>?, 'model_name'=>?, 'trim_name'=>?, 'fuel_type'=>?, 'base_price'=>?]
 * @return string 카테고리 코드 (category_matrix.json 키와 일치)
 */
function classify_vehicle(array $vehicle): string {
    $brand = (string)($vehicle['brand'] ?? '');
    $model = (string)($vehicle['model_name'] ?? '');
    $trim  = (string)($vehicle['trim_name'] ?? '');
    $fuel  = strtolower((string)($vehicle['fuel_type'] ?? ''));
    $price = (int)($vehicle['base_price'] ?? 0);

    $is_domestic = in_array($brand, DOMESTIC_BRANDS, true);
    $is_luxury_brand = in_array($brand, LUXURY_BRANDS_HIGH, true);

    // 1) 차종명 키워드 즉시 매핑 (가장 신뢰)
    foreach (MODEL_OVERRIDES as $keyword => $cat) {
        if (stripos($model, $keyword) !== false || stripos($trim, $keyword) !== false) {
            return $cat;
        }
    }

    // 2) 럭셔리 키워드 (S-Class 등)
    foreach (LUXURY_MODELS_KEYWORDS as $kw) {
        if (stripos($model, $kw) !== false || stripos($trim, $kw) !== false) {
            return 'luxury';
        }
    }
    if ($is_luxury_brand || $price >= 150000000) {
        return 'luxury';
    }

    // 3) 전기차
    if ($fuel === 'electric' || $fuel === '전기' ||
        stripos($model, 'EV') !== false || stripos($trim, '전기') !== false) {
        return $is_domestic ? 'ev_domestic' : 'ev_imported';
    }

    // 4) 수입차 — 차급 추정 (가격 + 차종명)
    if (!$is_domestic) {
        // SUV 키워드
        $suv_kw = ['SUV', 'X1', 'X2', 'X3', 'X4', 'X5', 'X6', 'X7', 'GLA', 'GLB', 'GLC', 'GLE', 'GLS',
                    'Q3', 'Q5', 'Q7', 'Q8', 'XC', 'F-PACE', 'Cayenne', 'Macan', 'Range Rover', 'Defender'];
        foreach ($suv_kw as $kw) {
            if (stripos($model, $kw) !== false || stripos($trim, $kw) !== false) {
                return 'imported_suv';
            }
        }
        return 'imported_sedan';
    }

    // 5) 국산 fallback — 가격 + 차종명으로 추정
    // 미니밴
    if (preg_match('/(밴|미니밴|Van|MPV)/iu', $model . ' ' . $trim)) return 'minivan';
    // SUV
    if (preg_match('/(SUV|크로스오버|어반|루프|wagon)/iu', $model . ' ' . $trim)) {
        return $price >= 35000000 ? 'suv_popular' : 'suv_compact';
    }
    // 경차 (가격 기준)
    if ($price > 0 && $price < 20000000) return 'compact_low';

    // 6) 기본값
    return 'sedan_popular';
}


/**
 * 카테고리 매트릭스 로드 (캐싱).
 */
function load_category_matrix(): array {
    static $cache = null;
    if ($cache === null) {
        $path = dirname(__DIR__) . '/quote-engine/sample_data/category_matrix.json';
        if (!file_exists($path)) {
            throw new RuntimeException("category_matrix.json not found at $path");
        }
        $cache = json_decode(file_get_contents($path), true);
    }
    return $cache;
}


/**
 * 카테고리 + (계약기간, 주행거리) → 잔가율
 */
function lookup_residual_pct(string $category, int $term, int $mileage): float {
    $matrix = load_category_matrix();
    $cats = $matrix['categories'] ?? [];
    $cat_data = $cats[$category] ?? $cats['_default'];
    $key = $term . '_' . $mileage;
    return (float)($cat_data['residual_grid'][$key] ?? $cat_data['residual_grid']['48_10000']);
}


/**
 * 카테고리별 이자율
 */
function lookup_interest_rate(string $category): float {
    $matrix = load_category_matrix();
    $cats = $matrix['categories'] ?? [];
    return (float)($cats[$category]['interest_rate'] ?? $cats['_default']['interest_rate'] ?? 0.063);
}
