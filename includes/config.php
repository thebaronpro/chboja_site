<?php
declare(strict_types=1);

if (defined('CHABOZA_CONFIG_LOADED')) return;
define('CHABOZA_CONFIG_LOADED', true);

define('APP_ROOT', dirname(__DIR__));
define('APP_INCLUDES', __DIR__);

$isLocal = in_array(($_SERVER['SERVER_NAME'] ?? ''), ['localhost', '127.0.0.1', '::1'], true);
define('APP_ENV', $isLocal ? 'local' : 'production');

if (APP_ENV === 'local') {
    define('DB_HOST', '127.0.0.1');
    define('DB_PORT', 3306);
    define('DB_NAME', 'chaboza');
    define('DB_USER', 'root');
    define('DB_PASS', '');
} else {
    define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('DB_PORT', (int)(getenv('DB_PORT') ?: 3306));
    define('DB_NAME', getenv('DB_NAME') ?: '');
    define('DB_USER', getenv('DB_USER') ?: '');
    define('DB_PASS', getenv('DB_PASS') ?: '');
}

define('DB_CHARSET', 'utf8mb4');

define('CAR_TABLE_PREFIX', 'car_202603ep');

if (APP_ENV === 'local') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
}

date_default_timezone_set('Asia/Seoul');
mb_internal_encoding('UTF-8');
