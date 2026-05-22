<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data.php';

$filters = ['전체', '무사고', '인증', '직거래'];
$active_filter = $_GET['f'] ?? '전체';
if (!in_array($active_filter, $filters, true)) $active_filter = '전체';

$query = trim((string)($_GET['q'] ?? ''));

$cars = get_used_cars();
$filtered = array_values(array_filter($cars, function ($c) use ($active_filter, $query) {
    if ($active_filter !== '전체' && $c['tag'] !== $active_filter) return false;
    if ($query !== '' && mb_stripos($c['name'], $query) === false) return false;
    return true;
}));

$features = [
    ['icon' => '✓', 'title' => '허위매물 ZERO',   'desc' => '등록 전 전담 검수팀이 직접 실물 확인합니다.'],
    ['icon' => '★', 'title' => '인증 딜러 보증',   'desc' => '공식 인증 딜러만 입점, 계약서 안전 보장.'],
    ['icon' => '↗', 'title' => '즉시 출고 가능',    'desc' => '재고 차량 기준 최단 1~3일 내 출고.'],
];

$page_title  = '중고차';
$current_nav = '중고차';
$BASE        = '../';
$bnav_active = 'search';

require __DIR__ . '/../includes/header.php';
?>

<section class="bg-neutral-800 py-20 text-white">
  <div class="mx-auto max-w-7xl px-6 text-center">
    <p class="mb-3 text-sm font-black tracking-widest text-neutral-400 uppercase">USED CAR</p>
    <h1 class="text-5xl font-black leading-tight">믿을 수 있는 인증 중고차<br/>직거래 플랫폼</h1>
    <p class="mt-5 text-base font-semibold text-neutral-300">허위 매물 없이, 검증된 딜러와 직접 연결해드립니다.</p>
    <div class="mt-10 flex justify-center gap-3">
      <button class="bg-white text-neutral-900 hover:bg-neutral-100 inline-flex items-center justify-center gap-2 px-7 py-3 text-sm font-bold transition">인증 중고차 보기</button>
      <button class="bg-neutral-900 text-white hover:bg-[#1E4FCC] inline-flex items-center justify-center gap-2 px-7 py-3 text-sm font-bold transition">매입 문의하기</button>
    </div>
  </div>
</section>

<section class="bg-white py-10 border-b border-neutral-200">
  <div class="mx-auto max-w-3xl px-6">
    <form method="get" action="" class="flex gap-3">
      <div class="relative flex-1">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400">⌕</span>
        <input
          type="text"
          name="q"
          value="<?= h($query) ?>"
          placeholder="차량명, 브랜드 검색"
          class="w-full border border-neutral-200 pl-11 pr-4 py-4 text-sm font-bold focus:outline-none focus:border-neutral-900"
        />
      </div>
      <input type="hidden" name="f" value="<?= h($active_filter) ?>"/>
      <button type="submit" class="bg-neutral-900 px-8 py-4 text-sm font-black text-white hover:bg-[#1E4FCC] transition">검색</button>
    </form>
    <div class="mt-4 flex gap-2">
      <?php foreach ($filters as $f): $on = ($f === $active_filter); ?>
        <a href="?<?= http_build_query(['f' => $f, 'q' => $query]) ?>" class="px-5 py-2 text-xs font-black border rounded-full transition <?= $on ? 'bg-[#DEE7FB] text-[#1E4FCC] border-[#2858E0]' : 'border-neutral-200 text-neutral-500 hover:border-neutral-900 hover:text-neutral-900' ?>"><?= h($f) ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="mx-auto max-w-7xl px-6 py-16">
  <div class="mb-8 flex items-end justify-between gap-4">
    <div>
      <h2 class="text-3xl font-black tracking-tight text-neutral-950">인증 중고차</h2>
      <p class="mt-2 text-sm font-semibold text-neutral-400">전체 <?= count($cars) ?>대 · 무사고 우선 · 즉시 출고 가능</p>
    </div>
    <div class="text-sm font-bold text-neutral-500">최신 등록순</div>
  </div>
  <?php if (count($filtered) > 0): ?>
    <div class="grid gap-6 md:grid-cols-4">
      <?php foreach ($filtered as $c): ?>
        <article class="border border-neutral-200 bg-white">
          <?php if (!empty($c['image'])): ?>
            <img src="<?= h($c['image']) ?>" alt="" class="object-cover h-48 w-full"/>
          <?php else: ?>
            <div class="bg-slate-200 h-48 w-full"></div>
          <?php endif; ?>
          <div class="p-5">
            <span class="mb-3 inline-flex bg-neutral-800 px-3 py-1 text-xs font-black text-white"><?= h($c['tag']) ?></span>
            <h3 class="font-black text-neutral-950"><?= h($c['name']) ?></h3>
            <p class="mt-1 font-black text-neutral-950"><?= h($c['price']) ?></p>
            <p class="mt-1 text-sm text-neutral-500"><?= h($c['meta']) ?></p>
            <button class="mt-8 w-full bg-neutral-900 py-3 text-sm font-bold text-white hover:bg-[#1E4FCC] transition">상세보기</button>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="py-20 text-center text-neutral-400 font-bold">검색 결과가 없습니다.</div>
  <?php endif; ?>
</section>

<section class="bg-neutral-100 py-12">
  <div class="mx-auto max-w-7xl px-6">
    <div class="grid gap-6 md:grid-cols-3 text-center">
      <?php foreach ($features as $b): ?>
        <div class="bg-white p-8">
          <p class="mb-3 text-4xl"><?= h($b['icon']) ?></p>
          <h3 class="mb-2 font-black"><?= h($b['title']) ?></h3>
          <p class="text-sm text-neutral-500"><?= h($b['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
