<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/data.php';

$page_title  ??= 'RENT insight';
$current_nav ??= '';
$BASE        ??= '../';
$viewport    ??= 'width=device-width, initial-scale=1';
$extra_head  ??= '';

// Map root-page conventions to rental_header conventions
$top_active     = $current_nav ?: ($top_active ?? '');
$subnav_active  ??= '';
$site_root       = $BASE;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8"/><meta name="viewport" content="<?= h($viewport) ?>"/>
  <title><?= h($page_title) ?> — RENT insight</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    body { font-family: 'Pretendard Variable', Pretendard, -apple-system, BlinkMacSystemFont, system-ui, Roboto, sans-serif; color:#0a0a0a; background:#fff; }
    a { text-decoration:none; color:inherit; }
    .whitespace-pre-line { white-space: pre-line; }
    .mob-bottom-nav{position:fixed;bottom:0;left:0;right:0;z-index:9999;background:#fff;border-top:1px solid #e5e5e5;padding-bottom:env(safe-area-inset-bottom);display:block}
    .bnav-inner{display:flex;align-items:stretch}
    .bnav-item{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:.55rem .25rem .45rem;gap:.18rem;text-decoration:none;color:#a3a3a3;font-size:.65rem;font-weight:600;font-family:inherit}
    .bnav-item.active{color:#2858E0}
    .bnav-quick{color:#0a0a0a!important}
    .bnav-quick-bar{position:absolute;top:0;left:50%;transform:translateX(-50%);width:2rem;height:3px;background:#0a0a0a;border-radius:0 0 3px 3px}
  </style>
  <?= $extra_head ?>
</head>
<body>
<?php require __DIR__ . '/rental_header.php'; ?>
<main>
