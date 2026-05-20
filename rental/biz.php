<?php
$top_active    = '장기렌트';
$subnav_active = 'biz';
$bnav_active   = 'search';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>사업자렌트 — CHABOZA</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700;900&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Noto Sans KR',-apple-system,sans-serif;background:#fff;color:#0a0a0a;padding-bottom:4rem}
a{text-decoration:none;color:inherit}
.car-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem}
@media(max-width:768px){.car-grid{grid-template-columns:1fr;gap:.75rem}}
.car-card{border:1px solid #e5e5e5;background:#fff;cursor:pointer;transition:box-shadow .2s,transform .2s;border-radius:14px;overflow:hidden}
.car-card:hover{transform:translateY(-4px);box-shadow:0 8px 32px rgba(0,0,0,.1)}
.car-card img{width:100%;height:12rem;object-fit:contain;background:#f8f8f8;padding:.5rem}
.car-info{padding:1.25rem}
.badge{display:inline-block;background:#16a34a;color:#fff;padding:.2rem .6rem;font-size:.7rem;font-weight:900;margin-bottom:.5rem;border-radius:3px;letter-spacing:.02em}
.car-name{font-weight:900;font-size:1rem}
.car-price{font-size:1.125rem;font-weight:900;margin-top:.35rem}
.car-meta{font-size:.75rem;color:#a3a3a3;margin-top:.2rem}
.car-btn{display:block;width:100%;margin-top:1.25rem;padding:.75rem;background:#0a0a0a;color:#fff;font-size:.875rem;font-weight:700;border:none;cursor:pointer;transition:background .15s;text-align:center;border-radius:6px}
.car-btn:hover{background:#16a34a}
.biz-benefits{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2rem}
@media(max-width:768px){.biz-benefits{grid-template-columns:1fr;gap:.5rem}}
.biz-benefit{background:#f0fdf4;border:1px solid #dcfce7;border-radius:10px;padding:1rem 1.25rem}
.biz-benefit p:first-child{font-size:.75rem;font-weight:800;color:#16a34a;letter-spacing:.04em;margin-bottom:.3rem}
.biz-benefit p:last-child{font-size:.95rem;font-weight:700;color:#0a0a0a;line-height:1.35}
</style>
</head>
<body>
<?php require __DIR__ . '/../includes/rental_header.php'; ?>

<main style="max-width:1280px;margin:0 auto;padding:2.5rem 1.5rem 3rem">
  <div style="margin-bottom:1.75rem">
    <p style="font-size:.72rem;font-weight:800;color:#16a34a;letter-spacing:.08em;margin-bottom:.45rem">— BUSINESS</p>
    <h1 style="font-size:2.2rem;font-weight:900;letter-spacing:-.02em">사업자 <span style="color:#16a34a">렌트</span></h1>
    <p style="margin-top:.55rem;font-size:.95rem;color:#737373;font-weight:500">법인·개인사업자 전용 세제 혜택 차량</p>
  </div>
  <div class="biz-benefits">
    <div class="biz-benefit"><p>BENEFIT 01</p><p>월 렌트료 전액 비용 처리</p></div>
    <div class="biz-benefit"><p>BENEFIT 02</p><p>부가세 환급 (9인승 이상)</p></div>
    <div class="biz-benefit"><p>BENEFIT 03</p><p>선납금 0원 · 보험·세금 포함</p></div>
  </div>
  <div class="car-grid" id="car-grid"></div>
</main>

<?php require __DIR__ . '/../includes/rental_footer.php'; ?>

<?php require_once __DIR__ . '/../includes/rental_data.php'; ?>
<script>
const CARS = <?= json_js(get_biz_cars()) ?>;
const grid = document.getElementById('car-grid');
function renderCars(list) {
  if (!list.length) {
    grid.innerHTML = '<p style="grid-column:1/-1;text-align:center;padding:3rem;color:#737373">검색 결과가 없습니다.</p>';
    return;
  }
  grid.innerHTML = list.map(c => `
    <div class="car-card">
      <img src="${c.img}" alt="${c.name}" onerror="this.style.opacity='.2'">
      <div class="car-info">
        <span class="badge">${c.tag}</span>
        <div class="car-name">${c.name}</div>
        <div class="car-price">${c.price}</div>
        <div class="car-meta">${c.meta}</div>
        <button class="car-btn">사업자 견적 신청</button>
      </div>
    </div>`).join('');
}
renderCars(CARS);

const qi = document.getElementById('qi');
const qc = document.getElementById('qc');
if (qi) {
  qi.addEventListener('input', () => {
    const q = qi.value.trim().toLowerCase();
    if (qc) qc.style.display = q ? 'inline-block' : 'none';
    renderCars(q ? CARS.filter(c => c.name.toLowerCase().includes(q)) : CARS);
  });
}
if (qc) qc.addEventListener('click', () => { qi.value = ''; qi.dispatchEvent(new Event('input')); qi.focus(); });
</script>
</body>
</html>
