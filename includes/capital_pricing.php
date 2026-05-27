<?php
/**
 * 캐피탈사별 차량가격 lookup.
 *
 * 다나와 가격은 제조사 권장가 → 캐피탈마다 자체 가격 정책 다름.
 * 특히 KB는 특가/할인이 많아 다나와와 다를 수 있음.
 *
 * 사용:
 *   $kb_price = capital_price_for('KB', ['brand'=>'현대', 'model_name'=>'아반떼',
 *                                        'trim_name'=>'가솔린 1.6 스마트 A/T']);
 *   // 매칭되면 KB 실측 가격 (예: 20,650,000), 매칭 안되면 null
 */

declare(strict_types=1);


function load_kb_trim_map(): array {
    static $cache = null;
    if ($cache === null) {
        $path = dirname(__DIR__) . '/quote-engine/sample_data/kb_trim_map.json';
        if (!file_exists($path)) return ['mappings' => []];
        $cache = json_decode(file_get_contents($path), true);
    }
    return $cache;
}


/**
 * 누적 KB 수집 데이터 (kb_collected.json) 로드.
 * merge_kb_data.py가 자동 관리. 정확한 매트릭스 데이터.
 */
function load_kb_collected(): array {
    static $cache = null;
    if ($cache === null) {
        $path = dirname(__DIR__) . '/quote-engine/sample_data/kb_collected.json';
        if (!file_exists($path)) return ['trims' => []];
        $cache = json_decode(file_get_contents($path), true);
    }
    return $cache;
}


/**
 * 누적 데이터에서 정확한 베이스 견적 검색.
 *
 * @return array|null 매칭되는 base_quote (term, mileage 일치 시)
 *                    못 찾으면 null → 카테고리 추정으로 fallback
 */
function kb_lookup_exact_quote(array $vehicle, int $term, int $mileage): ?array {
    $collected = load_kb_collected();
    $match = kb_find_collected_trim($vehicle);
    if (!$match) return null;

    foreach ($match['base_quotes'] as $bq) {
        if ((int)$bq['term_months'] === $term && (int)$bq['annual_mileage_km'] === $mileage) {
            return array_merge($bq, [
                'trim_record' => $match,
                'is_exact_match' => true,
            ]);
        }
    }
    return null;
}


/**
 * 누적 데이터에서 trim 매칭 (가격 + 카테고리 정보용)
 */
function kb_find_collected_trim(array $vehicle): ?array {
    $collected = load_kb_collected();
    $brand = (string)($vehicle['brand'] ?? '');
    $model = (string)($vehicle['model_name'] ?? '');
    $trim = (string)($vehicle['trim_name'] ?? '');

    foreach ($collected['trims'] as $t) {
        $keys = $t['danawa_match_keywords'] ?? [];
        if ($t['brand'] !== $brand) continue;
        if (!empty($keys['engine']) && mb_stripos($trim, $keys['engine']) === false) continue;
        if (!empty($keys['trim_keyword']) && mb_stripos($trim, $keys['trim_keyword']) === false) continue;
        if (!empty($keys['extra']) && mb_stripos($trim, $keys['extra']) === false) continue;
        // 모델명도 느슨한 매칭 (디 올 뉴 그랜저 vs 그랜저)
        $model_kw = mb_substr($t['model_name'], -3);  // 마지막 3글자 (그랜저, 아반떼 등)
        if (mb_stripos($model, $model_kw) === false && mb_stripos($model, $t['model_name']) === false) continue;
        return $t;
    }
    return null;
}


/**
 * KB 트림 매핑에서 일치하는 항목 검색.
 * 차종 + 엔진 + 트림 키워드가 모두 일치해야 함.
 */
function kb_find_trim(array $vehicle): ?array {
    $map = load_kb_trim_map();
    $brand = (string)($vehicle['brand'] ?? '');
    $model = (string)($vehicle['model_name'] ?? '');
    $trim = (string)($vehicle['trim_name'] ?? '');

    foreach ($map['mappings'] as $m) {
        $keys = $m['danawa_keys'];
        if (!empty($keys['brand']) && $keys['brand'] !== $brand) continue;
        if (!empty($keys['model_keyword']) && mb_stripos($model, $keys['model_keyword']) === false) continue;
        if (!empty($keys['engine']) && mb_stripos($trim, $keys['engine']) === false) continue;
        if (!empty($keys['trim_keyword']) && mb_stripos($trim, $keys['trim_keyword']) === false) continue;
        if (!empty($keys['extra']) && mb_stripos($trim, $keys['extra']) === false) continue;
        return $m['kb'];
    }
    return null;
}


/**
 * 캐피탈별 차량가격 반환. 매핑 없으면 다나와 가격 fallback.
 *
 * @return array ['price' => int, 'source' => 'kb_actual'|'danawa_fallback', 'kb_trim_name' => ?string]
 */
function capital_price_for(string $capital_code, array $vehicle): array {
    $danawa_price = (int)($vehicle['base_price'] ?? 0);
    $result = [
        'price' => $danawa_price,
        'source' => 'danawa_fallback',
        'matched_trim_name' => null,
    ];

    if ($capital_code === 'KB') {
        // 1) 누적 데이터에서 우선 검색 (정확한 매트릭스 가능성 있음)
        $collected = kb_find_collected_trim($vehicle);
        if ($collected) {
            $result['price'] = (int)$collected['base_price'];
            $result['source'] = 'kb_actual';
            $result['matched_trim_name'] = $collected['kb_full_trim_name'];
            $result['completeness'] = $collected['completeness'] ?? 'partial';
        } else {
            // 2) 구버전 trim_map.json fallback
            $kb_match = kb_find_trim($vehicle);
            if ($kb_match) {
                $result['price'] = (int)$kb_match['base_price'];
                $result['source'] = 'kb_actual';
                $result['matched_trim_name'] = $kb_match['trim_name'];
                $result['completeness'] = 'mapping_only';
            }
        }
    }
    // TODO: 현대캐피탈, 삼성카드 등 추가 시 동일 패턴

    return $result;
}


/**
 * 지원하는 모든 캐피탈사 코드 (랜딩에서 비교할 대상).
 */
function supported_capitals(): array {
    return [
        ['code' => 'KB',       'name' => 'KB캐피탈',    'enabled' => true],
        ['code' => 'HYUNDAI',  'name' => '현대캐피탈',  'enabled' => false, 'note' => 'Phase 2'],
        ['code' => 'SAMSUNG',  'name' => '삼성카드',    'enabled' => false, 'note' => 'Phase 2'],
        ['code' => 'LOTTE',    'name' => '롯데오토리스', 'enabled' => false, 'note' => 'Phase 2'],
        ['code' => 'WOORI',    'name' => '우리캐피탈',  'enabled' => false, 'note' => 'Phase 3'],
        ['code' => 'SHINHAN',  'name' => '신한카드',    'enabled' => false, 'note' => 'Phase 3'],
        ['code' => 'HANA',     'name' => '하나캐피탈',  'enabled' => false, 'note' => 'Phase 3'],
    ];
}
