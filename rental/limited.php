<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>한정재고 특가차량 — RENT insight</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Pretendard Variable',Pretendard,-apple-system,BlinkMacSystemFont,system-ui,Roboto,sans-serif;background:#fff;color:#0a0a0a}
a{text-decoration:none;color:inherit}
.car-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem}
.car-card{border:1px solid #e5e5e5;background:#fff;cursor:pointer;transition:box-shadow .2s,transform .2s}
.car-card:hover{transform:translateY(-3px);box-shadow:0 6px 24px rgba(0,0,0,.1)}
.car-card img{width:100%;height:12rem;object-fit:contain;background:#fff}
.car-card{position:relative}
.car-info{padding:1rem 1.25rem 1.25rem;display:flex;flex-direction:column;align-items:flex-start;gap:.15rem}
.car-trim{font-size:.72rem;color:#737373;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100%}
.car-name{font-weight:900;font-size:1.05rem;color:#0a0a0a;letter-spacing:-.01em}
.car-price{font-size:1rem;font-weight:800;color:#0a0a0a;margin-top:.35rem;letter-spacing:-.01em}
.car-meta{font-size:.7rem;color:#a3a3a3;font-weight:500;margin-top:.1rem}
.car-stock{position:absolute;top:.9rem;right:.9rem;display:inline-flex;align-items:center;background:#fef2f2;color:#dc2626;font-size:.72rem;font-weight:800;padding:.28rem .55rem;border-radius:999px;line-height:1;border:1px solid #fecaca;letter-spacing:-.01em}
.car-mobile-detail{display:none}
footer{background:#0a0a0a;color:#737373;padding:2.5rem 0;margin-top:5rem}

.filter-tab { padding:.55rem 1.1rem;font-size:.875rem;font-weight:600;color:#525252;border:1px solid #e5e7eb;background:#fff;cursor:pointer;border-radius:999px;transition:all .15s;white-space:nowrap;flex-shrink:0;font-family:inherit; }
.filter-tab:hover { color:#0a0a0a;border-color:#a3a3a3; }
.filter-tab.active { color:#fff;font-weight:800;background:#0a0a0a;border-color:#0a0a0a; }

@media (max-width: 768px) {
  .filter-tab { padding: .6rem .9rem; font-size: .8rem; }
  main { padding: 1rem 0 3rem; }

  /* 리스트형 카드 */
  .car-grid {
    display: flex;
    flex-direction: column;
    gap: 0;
    border-top: 1px solid #e5e5e5;
  }
  .car-card {
    position: relative;
    display: flex;
    flex-direction: row;
    align-items: center;
    border: none;
    border-bottom: 1px solid #f0f0f0;
    border-radius: 0;
    transform: none !important;
    box-shadow: none !important;
    padding: .9rem 1rem;
    gap: .9rem;
  }
  .car-card img {
    width: 96px;
    height: 72px;
    flex-shrink: 0;
    border-radius: 6px;
    object-fit: contain;
  }
  .car-info {
    padding: 0;
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    gap: .35rem;
    padding-right: 4rem;
  }
  .car-name {
    font-size: 1rem;
    font-weight: 800;
    color: #0a0a0a;
    letter-spacing: -.01em;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
  }
  .car-price {
    font-size: .95rem;
    font-weight: 800;
    color: #0a0a0a;
    letter-spacing: -.01em;
  }
  .car-stock {
    position: absolute;
    top: 50%;
    right: 1rem;
    transform: translateY(-50%);
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    background: #18181b;
    color: #fafafa;
    font-size: .7rem;
    font-weight: 800;
    padding: .3rem .6rem;
    border-radius: 999px;
    line-height: 1;
    border: none;
    letter-spacing: -.01em;
    box-shadow: 0 1px 3px rgba(0,0,0,.12);
  }
  .car-stock::before {
    content: "";
    width: .35rem;
    height: .35rem;
    border-radius: 50%;
    background: #fb7185;
    flex-shrink: 0;
  }
}




.bnav-item{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:.6rem .25rem .5rem;gap:.2rem;text-decoration:none;color:#a3a3a3;font-size:.65rem;font-weight:600}
.bnav-item.active{color:#dc2626}
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
$subnav_active = 'quick';
require __DIR__ . '/../includes/rental_header.php';
?>
<main style="max-width:1280px;margin:0 auto;padding:2.5rem 1.5rem 3rem">
  <div style="margin-bottom:1.75rem">
    <h1 style="font-size:2.2rem;font-weight:900;letter-spacing:-.02em">빠른출고 <span style="color:#dc2626">특가차량</span></h1>
    <p style="margin-top:.55rem;font-size:.95rem;color:#737373;font-weight:500">수량 한정 · 소진 시 종료</p>
  </div>
  <div style="display:flex;gap:.4rem;overflow-x:auto;flex-wrap:nowrap;white-space:nowrap;scrollbar-width:none;margin-bottom:1.5rem" id="filter-tabs">
    <button class="filter-tab active" data-filter="인기차종" onclick="setFilter(this,'인기차종')">인기차종</button>
    <button class="filter-tab" data-filter="국산차" onclick="setFilter(this,'국산차')">국산차</button>
    <button class="filter-tab" data-filter="외제차" onclick="setFilter(this,'외제차')">외제차</button>
    <button class="filter-tab" data-filter="SUV" onclick="setFilter(this,'SUV')">SUV</button>
    <button class="filter-tab" data-filter="세단" onclick="setFilter(this,'세단')">세단</button>
    <button class="filter-tab" data-filter="전기차" onclick="setFilter(this,'전기차')">전기차</button>
    <button class="filter-tab" data-filter="하이브리드" onclick="setFilter(this,'하이브리드')">하이브리드</button>
    <button class="filter-tab" data-filter="생에 첫 차" onclick="setFilter(this,'생에 첫 차')">생에 첫 차</button>
  </div>
  <div class="car-grid" id="car-grid"></div>
</main>

<?php
$bnav_active = 'quick';
require __DIR__ . '/../includes/rental_footer.php';
?>

<script src="limited_cars.js"></script>
<script>
const CARS_SRC = window.LIMITED_CARS_DATA || [];
// 모델명 단위로 그룹핑 (대표 카드 = 첫 항목, stock=합계, cat=union)
const CARS_GROUPED = (() => {
  const map = new Map();
  CARS_SRC.forEach(c => {
    if (!map.has(c.name)) map.set(c.name, { name:c.name, img:c.img, cat:new Set(c.cat||[]), stock:0, variants:[] });
    const g = map.get(c.name);
    g.stock += (c.stock||0);
    (c.cat||[]).forEach(t => g.cat.add(t));
    g.variants.push(c);
  });
  return Array.from(map.values()).map(g => ({...g, cat:Array.from(g.cat)}));
})();
const CARS = CARS_GROUPED;

const grid = document.getElementById('car-grid');
function parsePrice(s){
  const m = (s||'').match(/([\d,]+)/);
  return m ? parseInt(m[1].replace(/,/g,''),10) : 0;
}
CARS.forEach((c) => {
  const target = `variants.php?name=${encodeURIComponent(c.name)}`;
  const prices = c.variants.map(v => parsePrice(v.price30)).filter(n => n>0);
  const minPrice = prices.length ? Math.min(...prices) : 0;
  const priceTxt = minPrice ? `월 ${minPrice.toLocaleString()}원~` : '-';
  grid.innerHTML += `
    <div class="car-card" data-cat="${c.cat.join(' ')}" onclick="location.href='${target}'">
      <img src="${c.img}" alt="${c.name}" onerror="this.style.opacity='.2'">
      <div class="car-info">
        <div class="car-name">${c.name}</div>
        <div class="car-price">${priceTxt}</div>
      </div>
      <span class="car-stock">${c.stock}대</span>
    </div>`;
});

// 필터
var currentFilter = '인기차종';
function setFilter(el, filter) {
  currentFilter = filter;
  document.querySelectorAll('.filter-tab').forEach(function(t){ t.classList.remove('active'); });
  el.classList.add('active');
  applyFilters();
}

// 페이지 내 검색 (공유 헤더 검색바 id=qi)
var searchInput = document.getElementById('qi');
var searchClear = document.getElementById('qc');

function applyFilters() {
  var q = searchInput ? searchInput.value.trim().toLowerCase() : '';
  var cards = document.querySelectorAll('.car-card');
  cards.forEach(function(card) {
    var name = card.querySelector('.car-name') ? card.querySelector('.car-name').textContent.toLowerCase() : '';
    var cat = card.getAttribute('data-cat') || '';
    var matchQ = !q || name.includes(q);
    var domestic = ['현대','기아','제네시스','쌍용','르노','KG'];
    var isDomestic = domestic.some(function(b){ return card.querySelector('.car-name').textContent.indexOf(b) === 0; });
    var matchF = currentFilter === '국산차' ? isDomestic
               : currentFilter === '외제차' ? !isDomestic
               : cat.split(' ').indexOf(currentFilter) !== -1;
    card.style.display = (matchQ && matchF) ? '' : 'none';
  });
}

if (searchInput) {
  searchInput.addEventListener('input', function() {
    if (searchClear) searchClear.style.display = this.value.trim() ? 'inline-block' : 'none';
    applyFilters();
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
