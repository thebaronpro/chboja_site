<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/data.php';

$page_title  ??= 'CHABOZA';
$current_nav ??= '';
$BASE        ??= '../';
$viewport    ??= 'width=1280';
$extra_head  ??= '';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8"/><meta name="viewport" content="<?= h($viewport) ?>"/>
  <title><?= h($page_title) ?> — CHABOZA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700;900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    body { font-family: 'Noto Sans KR', sans-serif; }
    .whitespace-pre-line { white-space: pre-line; }
    .mob-bottom-nav{position:fixed;bottom:0;left:0;right:0;z-index:9999;background:#fff;border-top:1px solid #e5e5e5;padding-bottom:env(safe-area-inset-bottom);display:block}
    .bnav-inner{display:flex;align-items:stretch}
    .bnav-item{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:.55rem .25rem .45rem;gap:.18rem;text-decoration:none;color:#a3a3a3;font-size:.65rem;font-weight:600;font-family:inherit}
    .bnav-item.active{color:#dc2626}
    .bnav-quick{color:#0a0a0a!important}
    .bnav-quick-bar{position:absolute;top:0;left:50%;transform:translateX(-50%);width:2rem;height:3px;background:#0a0a0a;border-radius:0 0 3px 3px}
  </style>
  <?= $extra_head ?>
</head>
<body style="padding-bottom:4rem">
<header class="sticky top-0 z-50 border-t-4 border-neutral-900 bg-white/95 backdrop-blur">
  <div class="mx-auto flex h-11 max-w-7xl items-center justify-center px-4 relative">
    <a href="<?= h($BASE) ?>index.php" class="text-3xl font-black tracking-tight text-red-600">CHABOZA</a>
    <div class="absolute right-8 top-4 hidden text-xs text-neutral-500 md:block">로그인&nbsp;|&nbsp;KR</div>
  </div>
  <nav class="border-y border-neutral-200">
    <div class="mx-auto flex max-w-7xl justify-center px-4">
      <?php foreach (NAV_ITEMS as $n): $active = ($current_nav === $n['label']); ?>
        <a href="<?= h($BASE . $n['href']) ?>" class="min-w-fit px-8 py-4 text-sm font-semibold transition whitespace-nowrap <?= $active ? 'border-b-4 border-neutral-900 text-neutral-950' : 'border-b-4 border-transparent text-neutral-500 hover:text-neutral-900' ?>"><?= h($n['label']) ?></a>
      <?php endforeach; ?>
    </div>
  </nav>
</header>
<main>
