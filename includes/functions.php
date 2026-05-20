<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

function h($v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function won($amount, string $unit = '원'): string
{
    $n = (int)preg_replace('/[^0-9\-]/', '', (string)$amount);
    return number_format($n) . $unit;
}

function won_man($amount): string
{
    $n = (int)preg_replace('/[^0-9\-]/', '', (string)$amount);
    $man = (int)floor($n / 10000);
    return number_format($man) . '만원';
}

function param(string $key, ?string $default = null): ?string
{
    $v = $_GET[$key] ?? $_POST[$key] ?? $default;
    return $v === null ? null : trim((string)$v);
}

function param_int(string $key, int $default = 0): int
{
    return (int)(param($key, (string)$default));
}

function is_mobile(): bool
{
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    return (bool)preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $ua);
}

function asset_url(string $path): string
{
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');
    $depth = substr_count($base, '/');
    return str_repeat('../', $depth) . ltrim($path, '/');
}

function not_header_clause(string $tableSuffix, string $alias = ''): string
{
    $a = $alias ? "$alias." : '';
    switch ($tableSuffix) {
        case 'en':
        case 'ko':
            return "{$a}car_model_code != '자동차 모델코드'";
        case 'option_color':
        case 'option_list':
            return "{$a}brand_code NOT LIKE 'DNWA\\_%' ESCAPE '\\\\'";
        case 'option_price':
            return "{$a}model_code NOT LIKE 'DNWA\\_%' ESCAPE '\\\\'";
        case 'price':
            return "{$a}brand != '브랜드 명칭'";
        default:
            throw new InvalidArgumentException("Unknown table suffix: $tableSuffix");
    }
}

function car_data_all(string $tableSuffix, string $where = '', array $params = [], string $orderLimit = ''): array
{
    $table  = car_table($tableSuffix);
    $filter = not_header_clause($tableSuffix);
    $whereSql = $where === '' ? "WHERE $filter" : "WHERE $filter AND ($where)";
    $sql = "SELECT * FROM `$table` $whereSql $orderLimit";
    return db_all($sql, $params);
}

function car_data_one(string $tableSuffix, string $where, array $params = []): ?array
{
    $table  = car_table($tableSuffix);
    $filter = not_header_clause($tableSuffix);
    $sql = "SELECT * FROM `$table` WHERE $filter AND ($where) LIMIT 1";
    return db_one($sql, $params);
}

function active_if(bool $cond, string $cls = 'active'): string
{
    return $cond ? " $cls" : '';
}

function json_js($data): string
{
    return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}
