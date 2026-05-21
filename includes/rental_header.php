<?php
require_once __DIR__ . '/functions.php';

$top_active    ??= '장기렌트';
$subnav_active ??= 'home';
$site_root     ??= '../';   // path to site root (sub-folder default)
?>
<style>
/* ===== View Transitions API: GNB가 페이지 이동 시 정지된 상태로 유지 ===== */
@view-transition { navigation: auto; }
::view-transition-group(top-gnb),
::view-transition-group(mob-bnav) {
  animation-duration: 0s !important;
}
::view-transition-old(top-gnb),
::view-transition-new(top-gnb),
::view-transition-old(mob-bnav),
::view-transition-new(mob-bnav) {
  animation: none !important;
  mix-blend-mode: normal;
}
::view-transition-old(root),
::view-transition-new(root) {
  animation-duration: .18s;
}

/* ===== 공유 헤더 베이스 ===== */
html { scrollbar-gutter: stable; overflow-x: clip; }
body { overflow-x: clip; padding-bottom: 4rem; width: 100%; }
header { position:sticky !important; top:0 !important; left:0 !important; right:0 !important; z-index:50 !important; background:#fff !important; width:100% !important; view-transition-name: top-gnb; }
@media (max-width:768px) { header { position:static !important; } }
.logo { display:inline-flex; align-items:center; text-decoration:none; line-height:1; }
.logo img { height:24px; width:auto; display:block; }
.logo-bar { display:flex; align-items:center; justify-content:flex-start; height:52px; position:relative; padding-left:1rem; }
@media (min-width:769px) { .logo-bar { justify-content:space-between; height:44px; padding-left:0; } }
.topright { display:none; }
header > nav { display:none !important; }
.navlist { display:none; list-style:none; }
.hamburger { display:none; flex-direction:column; gap:5px; cursor:pointer; padding:6px; background:none; border:none; position:absolute; right:1rem; }
.hamburger span { display:block; width:22px; height:2px; background:#0a0a0a; }
.mob-overlay { display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:#fff; z-index:9999; overflow-y:auto; }
.mob-overlay.open { display:block; }
.mob-ov-inner { padding:1.5rem 1.5rem 3rem; }
.mob-ov-head { display:flex; align-items:center; justify-content:space-between; padding-bottom:1.5rem; border-bottom:1px solid #f0f0f0; margin-bottom:1rem; }
.mob-ov-logo { display:inline-flex; align-items:center; text-decoration:none; line-height:1; }
.mob-ov-logo img { height:30px; width:auto; display:block; }
.mob-ov-close { font-size:1.5rem; background:none; border:none; cursor:pointer; color:#0a0a0a; line-height:1; }
.mob-nav-link { display:block; padding:1rem 0; font-size:1rem; font-weight:600; color:#525252; border-bottom:1px solid #f5f5f5; text-decoration:none; }
.mob-nav-link.active { color:#0a0a0a; font-weight:900; }
@media (max-width:768px) {
  .hamburger { display:none !important; } /* 나중에 사용 예정 — flex로 되돌리면 노출 */
  .topright { display:none !important; }
}

/* ===== 공유 헤더 ===== */
.util-bar { background:#fafafa; border-bottom:1px solid #eee; }
.util-bar-inner { max-width:1280px; margin:0 auto; padding:.4rem 1.5rem; display:flex; justify-content:space-between; align-items:center; font-size:.78rem; color:#525252; gap:1.5rem; }
.util-bar-left { display:flex; gap:1rem; align-items:center; flex-wrap:wrap; }
.util-bar-right { display:flex; gap:1rem; align-items:center; flex-shrink:0; }
.util-bar-right a { color:#525252; text-decoration:none; transition:color .15s; }
.util-bar-right a:hover { color:#0a0a0a; }
.util-notice { color:#0a0a0a; font-weight:700; display:inline-flex; align-items:center; gap:.3rem; }
.util-notice::before { content:""; display:inline-block; width:.5rem; height:.5rem; background:#fbbf24; border-radius:50%; }
.util-sub { color:#737373; }
.util-phone { color:#0a0a0a; font-weight:700; display:inline-flex; align-items:center; gap:.3rem; }
.util-phone::before { content:"📞"; font-size:.75rem; }
@media (max-width: 768px) { .util-bar { display:none; } }

/* Desktop header layout */
@media (min-width: 769px) {
  header { display:block !important; padding:0 !important; background:#fff; }
  .header-inner {
    max-width:1280px; margin:0 auto; padding:.9rem 1.5rem;
    display:flex; align-items:center; gap:2rem;
  }
  header .logo-bar { flex-shrink:0; height:auto; background:transparent; padding:0; margin:0; width:auto; }
  header > nav { display:none; }
  header .subnav { display:none; }
}

/* 메인 네비게이션 (로고 옆) */
.main-nav { display:flex; align-items:center; gap:1.8rem; flex:1; }
.main-nav a {
  font-size:.95rem; font-weight:600; color:#525252; text-decoration:none;
  position:relative; padding:.3rem 0; transition:color .15s;
  white-space:nowrap;
}
.main-nav a:hover { color:#0a0a0a; }
.main-nav a.active { color:#dc2626; font-weight:800; }
.main-nav a.active::after {
  content:""; position:absolute; bottom:-.3rem; left:0; right:0;
  height:2px; background:#dc2626;
}
@media (max-width:768px) { .main-nav { display:none; } }

/* 메뉴 아래 전체 차종 검색바 — sticky + 스크롤 방향 감지 시 토글 */
.page-search-wrap {
  background:#f5f5f5; cursor:pointer; max-width:1232px; margin:.25rem auto 0;
  box-sizing:border-box; border-radius:10px;
  position:sticky; top:60px; z-index:45;
  transition:transform .25s ease, opacity .25s ease;
}
.page-search-wrap.search-hidden {
  transform:translateY(-130px);
  opacity:0;
  pointer-events:none;
}
.page-search-inner { display:flex; align-items:center; gap:.75rem; padding:.85rem 1.25rem; }
.page-search-inner span.placeholder { font-size:.875rem; color:#a3a3a3; }
.page-search-input { flex:1; font-size:.875rem; border:none; outline:none; background:transparent; font-family:inherit; color:#0a0a0a; }
.page-search-input::placeholder { color:#a3a3a3; }
.page-search-clear { cursor:pointer; color:#a3a3a3; font-size:.9rem; border:none; background:none; display:none; }
@media (max-width:768px) { .page-search-wrap { display:none; margin-top:0; } }

/* 우측 EVENT */
.header-right { display:flex; align-items:center; gap:.55rem; flex-shrink:0; }
.event-badge {
  background:#fbbf24; color:#0a0a0a; font-size:.7rem; font-weight:900;
  padding:.18rem .5rem; border-radius:3px; letter-spacing:.04em;
}
.event-text { font-size:.78rem; color:#525252; }
@media (max-width:768px) { .header-right { display:none; } }

/* 모바일 전용 이벤트 표시 (로고 옆, 우측 정렬, 2줄 배지+텍스트) */
.mob-event { display:none; }
@media (max-width:768px) {
  .mob-event { display:flex; flex-direction:column; align-items:flex-end; gap:.05rem; margin-left:auto; margin-right:1rem; overflow:hidden; min-width:0; line-height:1.2; }
  .mob-event-label { display:inline-block; font-size:.58rem; font-weight:900; color:#fff; background:#2563eb; letter-spacing:.14em; padding:.15rem .42rem; border-radius:3px; line-height:1.1; }
  .mob-event .event-text { font-size:.72rem; color:#0a0a0a; font-weight:700; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
}
</style>
<div class="util-bar">
  <div class="util-bar-inner">
    <div class="util-bar-left">
      <span class="util-notice">한정수량 EV 보조금 적용</span>
      <span class="util-sub">오늘 빠른출고 245대 · 30분 내 응답 보장</span>
    </div>
    <div class="util-bar-right">
      <span class="util-phone"><strong>1661-3583</strong></span>
      <a href="#">로그인</a>
      <a href="#">회원가입</a>
      <a href="#">관심차량</a>
      <a href="#"<?= active_if($subnav_active === 'my') ?>>마이</a>
    </div>
  </div>
</div>
<header>
  <div class="header-inner">
    <div class="logo-bar">
      <a class="logo" href="<?= h($site_root) ?>rental/index.php" aria-label="RENT insight"><img src="<?= h($site_root) ?>rental/logo/rent_insight_logo_vector.svg" alt="RENT insight"></a>
      <div class="mob-event">
        <span class="mob-event-label">EVENT</span>
        <span class="event-text">운전자보험 3년 무료 가입</span>
      </div>
      <button class="hamburger" onclick="document.getElementById('mobNav').classList.add('open')" aria-label="메뉴">
        <span></span><span></span><span></span>
      </button>
    </div>
    <nav class="main-nav">
      <a href="<?= h($site_root) ?>rental/index.php"<?= active_if($subnav_active === 'home') ?>>홈</a>
      <a href="<?= h($site_root) ?>rental/search.php"<?= active_if($subnav_active === 'search') ?>>전체차량</a>
      <a href="<?= h($site_root) ?>rental/limited.php"<?= active_if($subnav_active === 'quick') ?>>빠른출고</a>
      <a href="<?= h($site_root) ?>rental/direct.php"<?= active_if($subnav_active === 'direct') ?>>다이렉트존</a>
      <a href="<?= h($site_root) ?>rental/special.php"<?= active_if($subnav_active === 'special') ?>>특가차량</a>
      <a href="<?= h($site_root) ?>rental/biz.php"<?= active_if($subnav_active === 'biz') ?>>사업자혜택</a>
      <a href="<?= h($site_root) ?>event/"<?= active_if($top_active === '이벤트&혜택') ?>>이벤트</a>
      <a href="<?= h($site_root) ?>rental/insight.php"<?= active_if($subnav_active === 'insight') ?>>RENT <span style="color:#2563eb">insight</span></a>
    </nav>
    <div class="header-right">
      <span class="event-badge">EVENT</span>
      <span class="event-text">운전자보험 3년 무료 가입</span>
    </div>
  </div>
  <nav style="display:none"><ul class="navlist">
    <li><a href="<?= h($site_root) ?>index.php"<?= active_if($top_active === '홈') ?>>홈</a></li>
    <li><a href="<?= h($site_root) ?>rental/index.php"<?= active_if($top_active === '장기렌트') ?>>장기렌트</a></li>
    <li><a href="<?= h($site_root) ?>installment/"<?= active_if($top_active === '할부') ?>>할부</a></li>
    <li><a href="<?= h($site_root) ?>used-car/"<?= active_if($top_active === '중고차') ?>>중고차</a></li>
    <li><a href="<?= h($site_root) ?>lease/"<?= active_if($top_active === '화물리스') ?>>화물리스</a></li>
    <li><a href="<?= h($site_root) ?>shop/"<?= active_if($top_active === '자동차용품') ?>>자동차용품</a></li>
    <li><a href="<?= h($site_root) ?>event/"<?= active_if($top_active === '이벤트&혜택') ?>>이벤트&혜택</a></li>
    <li><a href="<?= h($site_root) ?>contact/"<?= active_if($top_active === '고객센터') ?>>고객센터</a></li>
  </ul></nav>
</header>
<?php
$_searchPlaceholders = [
  'search'  => '전체 차종 검색(전체차량, 빠른출고, 특가차량)',
  'quick'   => '빠른출고 차량 검색',
  'special' => '특가차량 검색',
  'biz'     => '사업자렌트 차량 검색',
  'import'  => '수입차 검색',
  'ev'      => '전기차 검색',
];
$_isInlineSearch = isset($_searchPlaceholders[$subnav_active]);
$_searchPh = $_searchPlaceholders[$subnav_active] ?? '전체 차종 검색(전체차량, 빠른출고, 특가차량)';
?>
<div class="page-search-wrap"<?= $_isInlineSearch ? '' : ' onclick="window.location.href=\'' . h($site_root) . 'rental/search.php\'"' ?>>
  <div class="page-search-inner">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#737373" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    <?php if ($_isInlineSearch): ?>
      <input id="qi" class="page-search-input" type="text" placeholder="<?= htmlspecialchars($_searchPh) ?>" autocomplete="off"<?= $subnav_active === 'search' ? ' autofocus' : '' ?>>
      <button id="qc" class="page-search-clear" type="button">✕</button>
    <?php else: ?>
      <span class="placeholder"><?= htmlspecialchars($_searchPh) ?></span>
    <?php endif; ?>
  </div>
</div>

<div class="mob-overlay" id="mobNav">
  <div class="mob-ov-inner">
    <div class="mob-ov-head">
      <a class="mob-ov-logo" href="<?= h($site_root) ?>index.php" aria-label="RENT insight"><img src="<?= h($site_root) ?>rental/logo/rent_insight_logo_vector.svg" alt="RENT insight"></a>
      <button class="mob-ov-close" onclick="document.getElementById('mobNav').classList.remove('open')">&#215;</button>
    </div>
    <a class="mob-nav-link" href="<?= h($site_root) ?>index.php"<?= active_if($top_active === '홈') ?>>홈</a>
    <a class="mob-nav-link" href="<?= h($site_root) ?>rental/index.php"<?= active_if($top_active === '장기렌트') ?>>장기렌트</a>
    <a class="mob-nav-link" href="<?= h($site_root) ?>installment/"<?= active_if($top_active === '할부') ?>>할부</a>
    <a class="mob-nav-link" href="<?= h($site_root) ?>used-car/"<?= active_if($top_active === '중고차') ?>>중고차</a>
    <a class="mob-nav-link" href="<?= h($site_root) ?>lease/"<?= active_if($top_active === '화물리스') ?>>화물리스</a>
    <a class="mob-nav-link" href="<?= h($site_root) ?>shop/"<?= active_if($top_active === '자동차용품') ?>>자동차용품</a>
    <a class="mob-nav-link" href="<?= h($site_root) ?>event/"<?= active_if($top_active === '이벤트&혜택') ?>>이벤트&혜택</a>
    <a class="mob-nav-link" href="<?= h($site_root) ?>rental/insight.php"<?= active_if($subnav_active === 'insight') ?>>RENT <span style="color:#2563eb">insight</span></a>
    <a class="mob-nav-link" href="<?= h($site_root) ?>contact/"<?= active_if($top_active === '고객센터') ?>>고객센터</a>
  </div>
</div>
<script>
(function(){
  var bar = document.querySelector('.page-search-wrap');
  if (!bar) return;
  var lastY = window.scrollY;
  var ticking = false;
  window.addEventListener('scroll', function(){
    if (ticking) return;
    requestAnimationFrame(function(){
      var y = window.scrollY;
      var dy = y - lastY;
      if (y > 120 && dy > 4) {
        bar.classList.add('search-hidden');
      } else if (dy < -4) {
        bar.classList.remove('search-hidden');
      }
      lastY = y;
      ticking = false;
    });
    ticking = true;
  }, {passive:true});
})();
</script>
