<?php
$BASE          ??= '../';
$bnav_active   ??= 'home';
$site_root      = $BASE;
?>
</main>
<footer style="background:#fafafa;color:#525252;border-top:1px solid #e5e5e5">
  <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 px-6 py-10 md:grid-cols-4">
    <div>
      <p class="mb-2 font-bold" style="color:#0a0a0a">(주)더바론 - 차보자</p>
      <p class="text-xs leading-6">서울특별시 금천구 가산디지털2로 135<br/>가산어반워크1 A동 1602호<br/>사업자등록번호 264-81-12870<br/>대표 엄윤호</p>
    </div>
    <a href="<?= h($BASE) ?>rental/" class="text-left">
      <p class="mb-2 font-bold" style="color:#2858E0">회사소개</p>
      <p class="text-xs">신규 입점 문의</p>
    </a>
    <a href="<?= h($BASE) ?>contact/" class="text-left">
      <p class="mb-2 font-bold" style="color:#2858E0">고객센터</p>
      <p class="text-xs">상담신청 및 자주 묻는 질문</p>
    </a>
    <div>
      <p class="mb-2 font-bold" style="color:#2858E0">대표전화</p>
      <p class="text-xs">1661-3583</p>
    </div>
  </div>
  <div class="mx-auto max-w-7xl px-6 py-6 text-xs" style="border-top:1px solid #e5e5e5;color:#a3a3a3">
    이용약관&nbsp;&nbsp;개인정보처리방침<br/>Copyright @ 2026 CHABOJA All Rights Reserved.
  </div>
</footer>
<?php require __DIR__ . '/rental_bnav.php'; ?>
</body>
</html>
