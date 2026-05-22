<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data.php';

$filter_map = ['all' => '전체', 'open' => '진행 중', 'closed' => '종료'];
$filter_key = $_GET['f'] ?? 'all';
if (!isset($filter_map[$filter_key])) $filter_key = 'all';

$events_all = get_events();
$events = array_values(array_filter($events_all, function ($e) use ($filter_key) {
    if ($filter_key === 'open')   return $e['open'];
    if ($filter_key === 'closed') return !$e['open'];
    return true;
}));

$page_title  = '이벤트&혜택';
$current_nav = '이벤트&혜택';
$BASE        = '../';
$bnav_active = 'search';

require __DIR__ . '/../includes/header.php';
?>

<section class="border-b border-neutral-200 bg-white py-14">
  <div class="mx-auto max-w-7xl px-6">
    <p class="mb-2 text-sm font-black tracking-widest text-neutral-400 uppercase">EVENTS &amp; BENEFITS</p>
    <h1 class="text-5xl font-black leading-tight text-neutral-950">이벤트 &amp; 혜택</h1>
    <p class="mt-4 text-base font-semibold text-neutral-400">차보자 고객을 위한 특별한 혜택을 확인하세요.</p>
  </div>
</section>

<div class="border-b border-neutral-200 bg-white">
  <div class="mx-auto flex max-w-7xl gap-0 px-6">
    <?php foreach ($filter_map as $key => $label): $active = ($filter_key === $key); ?>
      <a href="?f=<?= h($key) ?>" class="px-8 py-4 text-sm font-bold whitespace-nowrap <?= $active ? 'border-b-4 border-neutral-900 text-neutral-950' : 'border-b-4 border-transparent text-neutral-500 hover:text-neutral-900' ?>"><?= h($label) ?></a>
    <?php endforeach; ?>
  </div>
</div>

<section class="bg-neutral-100 py-16">
  <div class="mx-auto max-w-7xl px-6">
    <?php if (count($events) > 0): ?>
      <div class="grid gap-6 md:grid-cols-3">
        <?php foreach ($events as $e): ?>
          <article class="bg-white border <?= $e['open'] ? 'border-neutral-200' : 'border-neutral-100 opacity-60' ?> overflow-hidden">
            <div class="relative">
              <?php if (!empty($e['image'])): ?>
                <img src="<?= h($e['image']) ?>" alt="" class="object-cover h-48 w-full"/>
              <?php else: ?>
                <div class="bg-slate-200 h-48 w-full"></div>
              <?php endif; ?>
              <span class="absolute left-4 top-4 px-3 py-1 text-xs font-black text-white" style="background:<?= $e['open'] ? '#2858E0' : '#9A9AA0' ?>"><?= $e['open'] ? '진행 중' : '종료' ?></span>
            </div>
            <div class="p-6">
              <h3 class="text-base font-black text-neutral-950"><?= h($e['title']) ?></h3>
              <p class="mt-2 text-sm text-neutral-500"><?= h($e['desc']) ?></p>
              <p class="mt-3 text-xs font-bold text-neutral-400"><?= h($e['date']) ?></p>
              <?php if ($e['open']): ?>
                <button class="mt-5 w-full bg-neutral-900 py-3 text-sm font-bold text-white hover:bg-[#1E4FCC] transition">혜택 신청하기</button>
              <?php endif; ?>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="py-20 text-center text-neutral-400 font-bold">해당하는 이벤트가 없습니다.</div>
    <?php endif; ?>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
