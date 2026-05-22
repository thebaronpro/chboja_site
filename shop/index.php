<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data.php';

$tabs = ['썬팅', '블랙박스', '카매트', '기타'];
$active_idx = (int)($_GET['t'] ?? 0);
if ($active_idx < 0 || $active_idx >= count($tabs)) $active_idx = 0;

$products = get_products();

$steps = [
    ['step' => 'STEP 01', 'title' => '상품 선택',     'desc' => '원하는 썬팅 필름, 블랙박스, 카매트 등 상품을 선택하세요.'],
    ['step' => 'STEP 02', 'title' => '시공점 예약',    'desc' => '전국 제휴 시공점 중 원하는 위치와 날짜를 선택해 예약합니다.'],
    ['step' => 'STEP 03', 'title' => '시공 완료',     'desc' => '예약한 날짜에 방문하면 전문 시공사가 빠르게 시공해드립니다.'],
];

$page_title  = '자동차용품';
$current_nav = '자동차용품';
$BASE        = '../';
$bnav_active = 'search';

require __DIR__ . '/../includes/header.php';
?>

<section class="bg-neutral-950 py-20 text-white">
  <div class="mx-auto max-w-7xl px-6 text-center">
    <p class="mb-3 text-sm font-black tracking-widest text-neutral-500 uppercase">CAR ACCESSORIES</p>
    <h1 class="text-5xl font-black leading-tight">내 차에 맞는 전문 용품점을<br/>연결해드립니다</h1>
    <p class="mt-5 text-base font-semibold text-neutral-400">썬팅 · 블랙박스 · 코팅 · 카매트 · 전국 시공점 연결</p>
    <div class="mt-10 flex justify-center gap-3">
      <button class="bg-white text-neutral-900 hover:bg-neutral-100 inline-flex items-center gap-2 px-7 py-3 text-sm font-bold transition">전체 상품 보기</button>
      <button class="text-white inline-flex items-center gap-2 px-7 py-3 text-sm font-bold transition" style="background:#2858E0" onmouseover="this.style.background='#1E4FCC'" onmouseout="this.style.background='#2858E0'">시공점 찾기</button>
    </div>
  </div>
</section>

<div class="border-b border-neutral-200 bg-white">
  <div class="mx-auto flex max-w-7xl overflow-x-auto px-4">
    <?php foreach ($tabs as $i => $t): $on = ($i === $active_idx); ?>
      <a href="?t=<?= $i ?>" class="min-w-fit px-8 py-4 text-sm font-bold whitespace-nowrap <?= $on ? 'border-b-4 border-neutral-900 text-neutral-950' : 'text-neutral-500 hover:text-neutral-900' ?>"><?= h($t) ?></a>
    <?php endforeach; ?>
  </div>
</div>

<section class="mx-auto max-w-7xl px-6 py-16">
  <div class="mb-8 flex items-end justify-between gap-4">
    <div>
      <h2 class="text-3xl font-black tracking-tight text-neutral-950">추천 용품</h2>
      <p class="mt-2 text-sm font-semibold text-neutral-400">전문 시공점과 직접 연결 · 가격 비교 후 예약</p>
    </div>
    <div class="text-sm font-bold text-neutral-500">전체 보기 →</div>
  </div>
  <div class="grid gap-6 md:grid-cols-4">
    <?php foreach ($products as $p): ?>
      <article class="border border-neutral-200 bg-white">
        <?php if (!empty($p['image'])): ?>
          <img src="<?= h($p['image']) ?>" alt="" class="object-cover h-44 w-full"/>
        <?php else: ?>
          <div class="bg-slate-200 h-44 w-full"></div>
        <?php endif; ?>
        <div class="p-5">
          <h3 class="text-sm font-black"><?= h($p['name']) ?></h3>
          <p class="mt-1 text-xs font-bold text-neutral-700"><?= h($p['rating']) ?></p>
          <p class="mt-1 text-sm font-black"><?= h($p['price']) ?></p>
          <button class="mt-7 w-full bg-neutral-900 py-3 text-xs font-bold text-white hover:bg-red-600 transition">시공점 예약 · 구매하기</button>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="bg-neutral-100 py-12">
  <div class="mx-auto max-w-7xl px-6">
    <div class="mb-8 flex items-end justify-between gap-4">
      <div>
        <h2 class="text-3xl font-black tracking-tight text-neutral-950">이용 방법</h2>
        <p class="mt-2 text-sm font-semibold text-neutral-400">간단한 3단계로 용품 시공을 예약하세요</p>
      </div>
    </div>
    <div class="grid gap-6 md:grid-cols-3">
      <?php foreach ($steps as $s): ?>
        <div class="bg-white p-8">
          <p class="mb-3 text-xs font-black tracking-widest text-red-600"><?= h($s['step']) ?></p>
          <h3 class="mb-3 text-xl font-black"><?= h($s['title']) ?></h3>
          <p class="text-sm text-neutral-500 leading-relaxed"><?= h($s['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
