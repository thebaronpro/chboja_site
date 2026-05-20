<?php
$top_active    = '장기렌트';
$subnav_active = 'import';
$bnav_active   = 'search';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>수입차 — CHABOZA</title>
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
.badge{display:inline-block;background:#0ea5e9;color:#fff;padding:.2rem .6rem;font-size:.7rem;font-weight:900;margin-bottom:.5rem;border-radius:3px;letter-spacing:.02em}
.car-name{font-weight:900;font-size:1rem}
.car-price{font-size:1.125rem;font-weight:900;margin-top:.35rem}
.car-meta{font-size:.75rem;color:#a3a3a3;margin-top:.2rem}
.car-btn{display:block;width:100%;margin-top:1.25rem;padding:.75rem;background:#0a0a0a;color:#fff;font-size:.875rem;font-weight:700;border:none;cursor:pointer;transition:background .15s;text-align:center;border-radius:6px}
.car-btn:hover{background:#0ea5e9}
</style>
</head>
<body>
<?php require __DIR__ . '/../includes/rental_header.php'; ?>

<main style="max-width:1280px;margin:0 auto;padding:2.5rem 1.5rem 3rem">
  <div style="margin-bottom:1.75rem">
    <p style="font-size:.72rem;font-weight:800;color:#0ea5e9;letter-spacing:.08em;margin-bottom:.45rem">— IMPORT</p>
    <h1 style="font-size:2.2rem;font-weight:900;letter-spacing:-.02em">수입차 <span style="color:#0ea5e9">렌트</span></h1>
    <p style="margin-top:.55rem;font-size:.95rem;color:#737373;font-weight:500">BMW · 벤츠 · 아우디 · 미니 등 프리미엄 수입차 장기렌트</p>
  </div>
  <div class="car-grid" id="car-grid"></div>
</main>

<?php require __DIR__ . '/../includes/rental_footer.php'; ?>

<?php require_once __DIR__ . '/../includes/rental_data.php'; ?>
<script>
const CARS = <?= json_js(get_import_cars()) ?>;
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
        <button class="car-btn">견적 신청하기</button>
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
