<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>특가차량 — RENT insight</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Pretendard Variable',Pretendard,-apple-system,BlinkMacSystemFont,system-ui,Roboto,sans-serif;background:#fff;color:#0a0a0a}
a{text-decoration:none;color:inherit}
.car-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem}
.car-card{border:1px solid #e5e5e5;background:#fff;cursor:pointer;transition:box-shadow .2s,transform .2s;border-radius:14px;overflow:hidden}
.car-card:hover{transform:translateY(-4px);box-shadow:0 8px 32px rgba(0,0,0,.1)}
.car-card img{width:100%;height:12rem;object-fit:contain;background:#fff}
.car-info{padding:1.25rem}
.badge{display:inline-block;background:#dc2626;color:#fff;padding:.2rem .75rem;font-size:.7rem;font-weight:900;margin-bottom:.5rem}
.car-name{font-weight:900;font-size:1rem}
.car-price{font-size:1.125rem;font-weight:900;margin-top:.35rem}
.car-meta{font-size:.75rem;color:#a3a3a3;margin-top:.2rem}
.car-btn{display:block;width:100%;margin-top:1.25rem;padding:.75rem;background:#0a0a0a;color:#fff;font-size:.875rem;font-weight:700;border:none;cursor:pointer;transition:background .15s;text-align:center;border-radius:8px}
.car-btn:hover{background:#dc2626}
footer{background:#0a0a0a;color:#737373;padding:2.5rem 0;margin-top:4rem}


@media (max-width: 768px) {
  .car-grid { grid-template-columns: repeat(2,1fr) !important; gap: .75rem; }
  #unit-list { grid-template-columns: repeat(2,1fr); gap: 1rem; }
  .filter-tab { padding: .6rem .9rem; font-size: .8rem; }
  main { padding: 1.25rem 1rem 3rem !important; }
  .sp-title { font-size: 1.5rem !important; }
  .sp-sub { font-size: .85rem !important; }
  .unit-img { height: 9rem; }
  .sw-inner, .sb-inner { padding: .65rem 1rem; }

  /* 카드 모바일 */
  .car-card img { height: 7.5rem !important; }
  .car-info { padding: .75rem !important; }
  .badge { font-size: .6rem !important; padding: .15rem .55rem !important; margin-bottom: .35rem !important }
  .car-name { font-size: .9rem !important; line-height: 1.25 }
  .car-price { font-size: 1rem !important; margin-top: .25rem !important }
  .car-meta { font-size: .68rem !important; line-height: 1.35 }
  .car-btn { margin-top: .75rem !important; padding: .55rem !important; font-size: .8rem !important }
}




.bnav-item{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:.6rem .25rem .5rem;gap:.2rem;text-decoration:none;color:#a3a3a3;font-size:.65rem;font-weight:600}
.bnav-item.active{color:#2858E0}
.bnav-quick{color:#0a0a0a!important}
.bnav-quick-bar{position:absolute;top:0;left:50%;transform:translateX(-50%);width:2rem;height:3px;background:#0a0a0a;border-radius:0 0 3px 3px}
body{padding-bottom:4rem}
.mob-bottom-nav{position:fixed;bottom:0;left:0;right:0;z-index:9999;background:#fff;border-top:1px solid #e5e5e5;padding-bottom:env(safe-area-inset-bottom);display:none}
@media(max-width:768px){.mob-bottom-nav{display:block}}
</style>
</head>
<body>
<?php
$top_active    = '장기렌트';
$subnav_active = 'special';
require __DIR__ . '/../includes/rental_header.php';
?>
<!-- (mob-overlay rendered via rental_header.php) -->

<main class="sp-main" style="max-width:1280px;margin:0 auto;padding:2.5rem 1.5rem 3rem">
  <div style="margin-bottom:1.75rem">
    <h1 class="sp-title" style="font-size:2.2rem;font-weight:900;letter-spacing:-.02em;color:#0E0E12">특가 <span style="color:#1E4FCC">차량</span></h1>
    <p class="sp-sub" style="margin-top:.55rem;font-size:.95rem;color:#737373;font-weight:500">선납금 0원 · 한정 수량 · 즉시 출고 가능</p>
  </div>
  <div class="sp-tabs" id="spTabs" style="display:flex;gap:.4rem;padding:.3rem;background:#F7F5F0;border:1px solid #E2E0DA;border-radius:.7rem;margin-bottom:1.5rem;max-width:24rem">
    <button class="sp-tab" data-tab="general" style="flex:1;padding:.6rem .5rem;font-size:.88rem;font-weight:700;border:none;background:transparent;border-radius:.5rem;color:#737373;cursor:pointer;font-family:inherit;transition:all .15s">내연차특가</button>
    <button class="sp-tab" data-tab="ev" style="flex:1;padding:.6rem .5rem;font-size:.88rem;font-weight:700;border:none;background:transparent;border-radius:.5rem;color:#737373;cursor:pointer;font-family:inherit;transition:all .15s">⚡ 전기차특가</button>
  </div>
  <div class="car-grid" id="car-grid"></div>
</main>

<?php
$bnav_active = 'special';
require __DIR__ . '/../includes/rental_footer.php';
?>

<?php require_once __DIR__ . '/../includes/rental_data.php'; ?>
<script>
const GENERAL_CARS = <?= json_js(get_special_general_cars()) ?>;
const EV_CARS      = <?= json_js(get_special_ev_cars()) ?>;
const grid = document.getElementById('car-grid');
function renderCars(list, isEv) {
  grid.innerHTML = '';
  list.forEach(c => {
    const badgeStyle = isEv
      ? 'background:linear-gradient(135deg,#0d3b2e,#1a5c3a);color:#4ade80'
      : 'background:#dc2626;color:#fff';
    grid.innerHTML += `
      <div class="car-card">
        <img src="${c.img}" alt="${c.name}" onerror="this.style.opacity='.2'">
        <div class="car-info">
          <span class="badge" style="${badgeStyle}">${isEv ? '⚡ EV' : c.tag}</span>
          <div class="car-name">${c.name}</div>
          <div class="car-price">${c.price}</div>
          <div class="car-meta">${c.meta}</div>
          <button class="car-btn">견적 신청하기</button>
        </div>
      </div>`;
  });
}
function setSpTab(name) {
  document.querySelectorAll('.sp-tab').forEach(b => {
    const on = b.dataset.tab === name;
    b.style.background = on ? '#F0F4FE' : 'transparent';
    b.style.color = on ? '#1E4FCC' : '#737373';
    b.style.fontWeight = on ? '800' : '700';
    b.style.boxShadow = on ? '0 0 0 1px #BFD2F8 inset' : 'none';
  });
  if (name === 'ev') renderCars(EV_CARS, true);
  else renderCars(GENERAL_CARS, false);
  try { history.replaceState(null, '', name === 'ev' ? '?tab=ev' : 'special.php'); } catch(e){}
}
document.querySelectorAll('.sp-tab').forEach(b => {
  b.addEventListener('click', () => setSpTab(b.dataset.tab));
});
const _initTab = new URLSearchParams(location.search).get('tab') === 'ev' ? 'ev' : 'general';
setSpTab(_initTab);

// 페이지 내 검색 (공유 헤더 검색바 id=qi)
var searchInput = document.getElementById('qi');
var searchClear = document.getElementById('qc');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    var q = this.value.trim().toLowerCase();
    if (searchClear) searchClear.style.display = q ? 'inline-block' : 'none';
    var cards = document.querySelectorAll('.car-card');
    cards.forEach(function(card) {
      var name = card.querySelector('.car-name') ? card.querySelector('.car-name').textContent.toLowerCase() : '';
      card.style.display = (!q || name.includes(q)) ? '' : 'none';
    });
  });
}
if (searchClear) {
  searchClear.addEventListener('click', function() {
    searchInput.value = '';
    searchInput.dispatchEvent(new Event('input'));
    searchInput.focus();
  });
}
</script>

<!-- (mob-bottom-nav rendered above via rental_footer.php) -->
</body>
</html>
