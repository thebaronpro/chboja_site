<?php
require_once __DIR__ . '/functions.php';

$bnav_active ??= 'home';
?>
<nav class="mob-bottom-nav">
  <div class="mob-bottom-nav-inner" style="display:flex;align-items:stretch">
    <a href="index.php" class="bnav-item<?= active_if($bnav_active === 'home') ?>" data-tab="홈">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>홈</span>
    </a>
    <a href="search.php" class="bnav-item<?= active_if($bnav_active === 'search') ?>" data-tab="차량검색">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <span>차량검색</span>
    </a>
    <a href="limited.php" class="bnav-item bnav-quick<?= active_if($bnav_active === 'quick') ?>" data-tab="빠른출고" style="position:relative">
      <span class="bnav-quick-bar"></span>
      <span style="font-size:1.25rem">⚡</span>
      <span>빠른출고</span>
    </a>
    <a href="special.php" class="bnav-item<?= active_if($bnav_active === 'special') ?>" data-tab="특가">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
      <span>특가</span>
    </a>
    <a href="#" class="bnav-item<?= active_if($bnav_active === 'my') ?>" data-tab="마이">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      <span>마이</span>
    </a>
  </div>
</nav>
