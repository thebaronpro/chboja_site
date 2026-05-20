<?php
$BASE          ??= '../';
$bnav_active   ??= 'search';
?>
</main>
<footer class="bg-neutral-950 text-neutral-400">
  <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 px-6 py-10 md:grid-cols-4">
    <div>
      <p class="mb-2 font-bold text-white">차보자</p>
      <p class="text-xs leading-6">서울특별시 금천구 가산동<br/>사업자등록번호 000-00-00000<br/>대표 임운호</p>
    </div>
    <a href="<?= h($BASE) ?>rental/" class="text-left">
      <p class="mb-2 font-bold text-red-600">회사소개</p>
      <p class="text-xs">신규 입점 문의</p>
    </a>
    <a href="<?= h($BASE) ?>contact/" class="text-left">
      <p class="mb-2 font-bold text-red-600">고객센터</p>
      <p class="text-xs">상담신청 및 자주 묻는 질문</p>
    </a>
    <div>
      <p class="mb-2 font-bold text-red-600">대표전화</p>
      <p class="text-xs">1661-3583</p>
    </div>
  </div>
  <div class="mx-auto max-w-7xl border-t border-neutral-800 px-6 py-6 text-xs text-neutral-500">
    이용약관&nbsp;&nbsp;개인정보처리방침<br/>Copyright © 2026 CHABOZA. All Rights Reserved.
  </div>
</footer>
<nav class="mob-bottom-nav">
  <div class="bnav-inner">
    <a href="<?= h($BASE) ?>index.php" class="bnav-item<?= active_if($bnav_active === 'home') ?>">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>홈</span>
    </a>
    <a href="<?= h($BASE) ?>rental/search.php" class="bnav-item<?= active_if($bnav_active === 'search') ?>">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <span>차량검색</span>
    </a>
    <a href="<?= h($BASE) ?>rental/limited.php" class="bnav-item bnav-quick<?= active_if($bnav_active === 'quick') ?>" style="position:relative">
      <span class="bnav-quick-bar"></span>
      <span style="font-size:1.25rem">⚡</span>
      <span>빠른출고</span>
    </a>
    <a href="#" class="bnav-item<?= active_if($bnav_active === 'quote') ?>">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <span>내 견적</span>
    </a>
    <a href="#" class="bnav-item<?= active_if($bnav_active === 'my') ?>">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      <span>마이</span>
    </a>
  </div>
</nav>
</body>
</html>
