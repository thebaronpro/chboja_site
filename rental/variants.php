<?php
$top_active    = '장기렌트';
$subnav_active = 'quick';
$bnav_active   = 'quick';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>차량 옵션 선택 — RENT insight</title>
<link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Pretendard Variable',Pretendard,-apple-system,BlinkMacSystemFont,system-ui,Roboto,sans-serif;background:#fff;color:#0a0a0a;padding-bottom:4rem}
a{text-decoration:none;color:inherit}
main{max-width:1200px;margin:0 auto;padding:0 1rem 3rem}
.back-bar{padding:.75rem 0 .25rem}
.back-btn{display:inline-flex;align-items:center;gap:.25rem;background:none;border:none;color:#171717;font-size:.95rem;font-weight:500;cursor:pointer;padding:.4rem .25rem;font-family:inherit;letter-spacing:-.01em}
.back-btn:hover{color:#525252}

.model-head{display:flex;align-items:center;gap:1rem;padding:1rem .25rem 1.25rem}
.model-head img{width:120px;height:90px;object-fit:contain;flex-shrink:0}
.model-title{flex:1;min-width:0}
.model-name{font-size:1.45rem;font-weight:900;color:#0a0a0a;letter-spacing:-.02em;line-height:1.15;margin-bottom:.35rem}
.model-sub{font-size:.85rem;color:#737373;font-weight:500}
.model-stock-pill{display:inline-flex;align-items:center;gap:.4rem;background:#fff;color:#171717;padding:.34rem .8rem .34rem .65rem;border-radius:999px;font-size:.78rem;font-weight:700;line-height:1;border:1px solid #e5e7eb;letter-spacing:-.01em;margin-top:.4rem}
.model-stock-pill::before{content:"";width:.4rem;height:.4rem;border-radius:50%;background:#ef4444;animation:vmPulse 1.8s ease-in-out infinite}
@keyframes vmPulse{0%,100%{opacity:1}50%{opacity:.4}}

.section-title{font-size:1.05rem;font-weight:900;color:#0a0a0a;letter-spacing:-.01em;margin:.5rem .25rem 1rem;display:flex;align-items:baseline;gap:.5rem}
.section-title .count{font-size:.85rem;font-weight:600;color:#737373}

.variant-list{display:flex;flex-direction:column;gap:.7rem}
.variant{position:relative;padding:1rem 1.1rem;background:#fff;border:1px solid #e5e7eb;border-radius:1rem;cursor:pointer;transition:transform .15s ease,box-shadow .15s ease}
.variant:hover{border-color:#171717}
.variant:active{transform:scale(.99)}
.variant-top{display:flex;align-items:center;justify-content:space-between;gap:.5rem;margin-bottom:.55rem}
.variant-trim{font-size:1rem;font-weight:800;color:#0a0a0a;letter-spacing:-.01em;line-height:1.25;flex:1;min-width:0}
.variant-stock{flex-shrink:0;display:inline-flex;align-items:center;gap:.3rem;background:#18181b;color:#fafafa;font-size:.7rem;font-weight:800;padding:.3rem .6rem;border-radius:999px;line-height:1;border:none;letter-spacing:-.01em;box-shadow:0 1px 3px rgba(0,0,0,.12)}
.variant-stock::before{content:"";width:.35rem;height:.35rem;border-radius:50%;background:#fb7185;flex-shrink:0}
.variant-meta{display:flex;flex-wrap:wrap;gap:.4rem;margin-bottom:.6rem}
.meta-chip{display:inline-flex;align-items:center;gap:.3rem;font-size:.7rem;font-weight:600;color:#525252;background:#f3f4f6;padding:.22rem .55rem;border-radius:.45rem;line-height:1.2}
.color-dot{display:inline-block;width:.7rem;height:.7rem;border-radius:50%;border:1px solid rgba(0,0,0,.12)}
.variant-options{font-size:.75rem;color:#737373;line-height:1.45;display:flex;flex-direction:column;gap:.2rem;padding:.3rem 0}
.variant-opt-row{display:flex;justify-content:space-between;gap:.5rem;font-size:.75rem;align-items:center}
.variant-opt-row .v-opt-name{color:#0a0a0a;font-weight:600;flex:1;min-width:0;position:relative;padding-left:.7rem}
.variant-opt-row .v-opt-name::before{content:"·";position:absolute;left:0;color:#0a0a0a}
.variant-opt-row .v-opt-price{color:#737373;font-weight:600;flex-shrink:0;font-size:.7rem}
.variant-price{margin-top:.6rem;padding-top:.6rem;border-top:1px dashed #f0f0f0;display:flex;align-items:baseline;justify-content:space-between;gap:.5rem}
.variant-price-label{font-size:.72rem;color:#a3a3a3;font-weight:600}
.variant-price-val{font-size:1.05rem;font-weight:900;color:#0a0a0a;letter-spacing:-.01em}

.empty{text-align:center;padding:3rem 1rem;color:#a3a3a3}

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
<?php require __DIR__ . '/../includes/rental_header.php'; ?>

<main>
  <div class="back-bar">
    <button class="back-btn" onclick="history.length>1?history.back():(window.location.href='limited.php')" aria-label="목록으로">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
      <span>목록으로</span>
    </button>
  </div>

  <div class="model-head" id="modelHead"></div>
  <h3 class="section-title">옵션별 차량 선택 <span class="count" id="variantCount"></span></h3>
  <div class="variant-list" id="variantList"></div>
  <div class="empty" id="emptyState" style="display:none">해당 차량 정보가 없습니다.</div>
</main>

<?php require_once __DIR__ . '/../includes/car_data.php'; ?>
<script src="limited_cars.js"></script>
<script>
/* PHP-injected: chaboza DB color_name → rgbcode 정규화 맵 */
window.COLOR_HEX_DB = <?= json_js(get_color_hex_map()) ?>;

const params = new URLSearchParams(location.search);
const modelName = params.get('name') || '';
const ALL = window.LIMITED_CARS_DATA || [];
const variants = ALL.filter(c => c.name === modelName);

// 색상 이름 정규화 (공백/괄호 코드 제거, lowercase) — car.php와 동일 로직
function colorKey(name) {
  return (name || '')
    .replace(/\s*\([^)]*\)\s*$/, '')
    .replace(/\s+/g, '')
    .toLowerCase();
}

// 색상 매핑: (1) DB rgbcode → (2) 키워드 fallback
// car.php와 같은 우선순위. variants는 CAR_BRANDS_DATA 미로드라 2단계만.
function colorHex(name){
  if(!name) return '#cccccc';
  // 1) DB 정확 매칭
  if (window.COLOR_HEX_DB) {
    const k = colorKey(name);
    if (k && window.COLOR_HEX_DB[k]) return window.COLOR_HEX_DB[k];
  }
  // 2) 키워드 매핑 fallback (구체 키워드를 일반 키워드 앞에 둠)
  const m = {
    '화이트':'#f3f3f3','블랙':'#1a1a1a','펄':'#ededed','실버':'#bdbdbd','그레이':'#7a7a7a','블루':'#2b4a7a',
    '레드':'#a32a2a','베이지':'#d6c9a8','브라운':'#5a3d28','테라':'#7a4a2a','퀼팅':'#3a2a1a','캐슬':'#d6c9a8',
    '네이비':'#1f2a44','오로라':'#1a1a1a','스노우':'#f5f5f5','오션':'#244c3a','갤럭시':'#1f2a44',
    '옥닉스':'#1a1a1a','온닉스':'#1a1a1a','문라이트':'#4a5a78','디지털':'#365a55','그라비티':'#9a8459',
    '미네랄':'#e8e8e8','알파인':'#fafafa','플로렛':'#bdbdbd','하이테크':'#cccccc','마카사':'#1a1a1a',
    '스펙트라':'#2b4a7a','매카노':'#7a7a7a','그린':'#3d5a3a','카키':'#5a5a3a','연두':'#7da76e'
  };
  for (const k of Object.keys(m)) { if (name.includes(k)) return m[k]; }
  return '#cccccc';
}

// 옵션명 키워드로 더미 가격(만원) 산정
const OPT_PRICES_V = {
  '파노라마선루프':117,'스카이라운지선루프':218,'선루프':89,
  '통풍시트':74,'HUD':79,'빌트인캠':49,'BOSE':118,'렉시콘':118,'머리디안':118,
  '하만카돈':188,'부메스터':188,'뱅앤올룹슨':188,'B&W':218,'BANG':188,
  'V2L':49,'솔라패널':99,'히트펌프':79,'360캠':89,
  '19인치휠':138,'20인치휠':158,'20인치':158,'19인치':138,'18인치':89,
  '스마트크루즈':138,'어드밴스드':198,'릴렉션시트':168,
  '뒷열통풍':99,'64색앰비언트':49,'주차보조':79,'원격스마트주차':99,
  '에어서스':268,'스포츠크로노':198,'파일럿어시스트':148,'M스포츠패키지':298,
  '오토파일럿':358,'FSD옵션':588,'히팅시트':49,'바코드라이빙':168,
  '디지털센터미러':49,'카운트다운':49
};
function guessOptPriceV(name){
  const clean = (name||'').trim().replace(/\s+/g,'');
  if (OPT_PRICES_V[clean] !== undefined) return OPT_PRICES_V[clean];
  for (const key of Object.keys(OPT_PRICES_V)) {
    if (clean.includes(key)) return OPT_PRICES_V[key];
  }
  return 69;
}

// 최저가 산정용 보정 계수 (car.php과 동일)
const PERIOD_MULT = { '36':1.08, '48':1.00, '60':0.93 };
const MILEAGE_MULT = { '10000':0.95, '20000':1.00, '30000':1.05, '40000':1.10, 'unlimited':1.18 };
const PREPAY_MULT = { '0':1.00, '10':0.95, '20':0.90, '30':0.85 };
// 최저가 조합 (이용기간 60, 주행 1만, 선납 30%, 보증 0% — 선수금만 30%)
const BEST = { period:'60', mileage:'10000', prepay:'30', deposit:'0' };

function lowestMonthly(price0, price30){
  const p0 = parseInt((price0||'0').replace(/[^\d]/g,'')) || 0;
  const p30 = parseInt((price30||'0').replace(/[^\d]/g,'')) || 0;
  if (!p0) return 0;
  // 보증금 30% → monthly = p30 (보간 결과), 그 후 기간/주행/선납 곱
  let base = p0;
  if (p0 && p30) base = p0 - (p0 - p30) * (parseInt(BEST.deposit)/30);
  base = base * PERIOD_MULT[BEST.period] * MILEAGE_MULT[BEST.mileage] * PREPAY_MULT[BEST.prepay];
  return Math.round(base);
}

if (!modelName || variants.length === 0) {
  document.getElementById('emptyState').style.display = '';
  document.getElementById('modelHead').style.display = 'none';
  document.querySelector('.section-title').style.display = 'none';
} else {
  const totalStock = variants.reduce((s,v)=>s+(v.stock||0),0);
  const headImg = variants[0].img || '';
  document.getElementById('modelHead').innerHTML = `
    <img src="${headImg}" alt="${modelName}" onerror="this.style.opacity='.2'">
    <div class="model-title">
      <div class="model-name">${modelName}</div>
      <div class="model-sub">옵션별 ${variants.length}종 · 총 ${totalStock}대</div>
      <span class="model-stock-pill">잔여 ${totalStock}대</span>
    </div>`;
  document.getElementById('variantCount').textContent = `(${variants.length}종)`;

  const list = document.getElementById('variantList');
  variants.forEach(v => {
    const qp = new URLSearchParams({
      name: v.name,
      from: 'limited',
      trim: v.trim || '',
      color_ext: v.color_ext || '',
      color_int: v.color_int || '',
      options: v.options || '',
      price30: v.price30 || '',
      price0: v.price0 || '',
      img: v.img || '',
      stock: String(v.stock||''),
      period: BEST.period,
      mileage: BEST.mileage,
      prepay: BEST.prepay,
      deposit: BEST.deposit
    });
    const minMonthly = lowestMonthly(v.price0, v.price30);
    const minPriceTxt = minMonthly ? `월 ${minMonthly.toLocaleString()}원` : '-';
    const extHex = colorHex(v.color_ext);
    const intHex = colorHex(v.color_int);
    list.insertAdjacentHTML('beforeend', `
      <div class="variant" onclick="location.href='car.php?${qp.toString()}'">
        <div class="variant-top">
          <div class="variant-trim">${v.trim || '-'}</div>
          <span class="variant-stock">${v.stock||0}대</span>
        </div>
        <div class="variant-meta">
          <span class="meta-chip"><span class="color-dot" style="background:${extHex}"></span>${v.color_ext||'-'}</span>
          <span class="meta-chip"><span class="color-dot" style="background:${intHex}"></span>${v.color_int||'-'}</span>
        </div>
        <div class="variant-options">${(v.options||'').split(/[·,]/).map(s=>s.trim()).filter(Boolean).map(it => {
          const m = it.match(/\(([^)]+)\)/);
          const priceTxt = m ? m[1] : `${guessOptPriceV(it)}만원`;
          const nameTxt = m ? it.replace(/\s*\([^)]+\)\s*$/, '').trim() : it.trim();
          return `<div class="variant-opt-row"><span class="v-opt-name">${nameTxt}</span><span class="v-opt-price">${priceTxt}</span></div>`;
        }).join('')}</div>
        <div class="variant-price">
          <span class="variant-price-label">월 렌트료 (선수금 30%)</span>
          <span class="variant-price-val">${minPriceTxt}</span>
        </div>
      </div>`);
  });
}
</script>

<?php require __DIR__ . '/../includes/rental_bnav.php'; ?>

</body>
</html>
