<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

if (defined('CHABOZA_CAR_DATA_LOADED')) return;
define('CHABOZA_CAR_DATA_LOADED', true);

function get_opt_prices(): array
{
    return [
        '파노라마선루프' => 117, '스카이라운지선루프' => 218, '선루프' => 89,
        '통풍시트' => 74, 'HUD' => 79, '빌트인캠' => 49, 'BOSE' => 118, '렉시콘' => 118, '머리디안' => 118,
        '하만카돈' => 188, '부메스터' => 188, '뱅앤올룹슨' => 188, 'B&W' => 218, 'BANG' => 188,
        'V2L' => 49, '솔라패널' => 99, '히트펌프' => 79, '360캠' => 89,
        '19인치휠' => 138, '20인치휠' => 158, '20인치' => 158, '19인치' => 138, '18인치' => 89,
        '스마트크루즈' => 138, '어드밴스드' => 198, '릴렉션시트' => 168,
        '뒷열통풍' => 99, '64색앰비언트' => 49, '주차보조' => 79, '원격스마트주차' => 99,
        '에어서스' => 268, '스포츠크로노' => 198, '파일럿어시스트' => 148, 'M스포츠패키지' => 298,
        '오토파일럿' => 358, 'FSD옵션' => 588, '히팅시트' => 49, '바코드라이빙' => 168,
        '디지털센터미러' => 49, '카운트다운' => 49,
    ];
}

function normalize_color_name(string $name): string
{
    $clean = preg_replace('/\s*\([^)]*\)\s*$/u', '', $name);
    $clean = preg_replace('/\s+/u', ' ', $clean);
    return trim($clean);
}

function color_key(string $name): string
{
    $clean = preg_replace('/\s*\([^)]*\)\s*$/u', '', $name);
    $clean = preg_replace('/\s+/u', '', $clean);
    return mb_strtolower(trim($clean));
}

function get_color_hex_map(): array
{
    $rows = db_all(
        "SELECT color_name, rgbcode
         FROM " . car_table('option_color') . "
         WHERE " . not_header_clause('option_color') . "
           AND rgbcode != ''
           AND color_name != ''"
    );

    $map = [];
    foreach ($rows as $r) {
        $name = $r['color_name'];
        $hex  = $r['rgbcode'];
        if ($hex === '' || $hex === null) continue;
        if ($hex[0] !== '#') $hex = '#' . $hex;
        $key = color_key($name);
        if ($key !== '' && !isset($map[$key])) {
            $map[$key] = $hex;
        }
    }
    return $map;
}

/**
 * 색상 가격 매칭용 정규화 키 — "-유료" 텍스트 및 괄호 제거하여 핵심 색상명만 추출.
 * JS의 colorPriceKey()와 동일 로직이어야 함.
 */
function color_price_key(string $name): string
{
    $clean = preg_replace('/[-–—]?\s*유료\s*(\([^)]*\))?/u', '', $name);
    $clean = preg_replace('/\([^)]*\)/u', '', $clean);
    $clean = preg_replace('/\s+/u', '', $clean);
    return mb_strtolower(trim($clean ?? ''));
}

/**
 * 유료 색상 → 가격(원) 맵. DB의 option_color 테이블에서 price > 0 인 행만.
 */
function get_color_price_map(): array
{
    $rows = db_all(
        "SELECT color_name, price
         FROM " . car_table('option_color') . "
         WHERE " . not_header_clause('option_color') . "
           AND CAST(price AS UNSIGNED) > 0
           AND color_name != ''"
    );

    $map = [];
    foreach ($rows as $r) {
        $name  = $r['color_name'];
        $price = (int) $r['price'];
        if ($price <= 0) continue;
        $key = color_price_key($name);
        if ($key !== '' && !isset($map[$key])) {
            $map[$key] = $price;
        }
    }
    return $map;
}
