<?php
require_once __DIR__ . '/functions.php';

$bnav_active ??= 'home';
?>
<footer class="bg-neutral-950 text-neutral-400">
  <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 px-6 py-10 md:grid-cols-4">
    <div>
      <p class="mb-2 font-bold text-white">차보자</p>
      <p class="text-xs leading-6">서울특별시 금천구 가산동<br>사업자등록번호 000-00-00000<br>대표 임운호</p>
    </div>
    <a href="index.php" class="text-left">
      <p class="mb-2 font-bold text-red-600">회사소개</p>
      <p class="text-xs">신규 입점 문의</p>
    </a>
    <a href="../contact/" class="text-left">
      <p class="mb-2 font-bold text-red-600">고객센터</p>
      <p class="text-xs">상담신청 및 자주 묻는 질문</p>
    </a>
    <div>
      <p class="mb-2 font-bold text-red-600">대표전화</p>
      <p class="text-xs">1661-3583</p>
    </div>
  </div>
  <div class="mx-auto max-w-7xl border-t border-neutral-800 px-6 py-6 text-xs text-neutral-500">
    이용약관&nbsp;&nbsp;&nbsp;개인정보처리방침<br>Copyright © 2026 CHABOZA. All Rights Reserved.
  </div>
</footer>

<?php require __DIR__ . '/rental_bnav.php'; ?>
