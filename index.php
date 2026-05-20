<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/data.php';

$banners   = get_main_banners();
$popular   = get_popular_cars();
$hot_deals = get_hot_deals();
$events    = array_slice(get_events(), 0, 4);

$used_blocks = [
    ['title' => '장기렌트', 'desc' => '월납입금으로 내 차를',     'href' => 'rental/'],
    ['title' => '중고차',   'desc' => '믿을 수 있는 인증 매물',   'href' => 'used-car/'],
    ['title' => '화물리스', 'desc' => '사업자를 위한 절세 리스', 'href' => 'lease/'],
];
$shop_tiles = [
    ['text' => "블랙박스\nTHINKWARE",   'dark' => true],
    ['text' => "카시트\nCYBEX",         'dark' => false],
    ['text' => "썬팅\n3M",             'dark' => true],
    ['text' => "내비게이션\nMAPPY",     'dark' => false],
    ['text' => "세차용품\nTURTLE WAX",  'dark' => true],
    ['text' => "차량 매트\n3D MAT",     'dark' => false],
];

$target_to_href = [
    '홈'         => 'index.php',
    '장기렌트'   => 'rental/',
    '할부'       => 'installment/',
    '중고차'     => 'used-car/',
    '화물리스'   => 'lease/',
    '자동차용품' => 'shop/',
    '이벤트&혜택' => 'event/',
    '고객센터'   => 'contact/',
];

$page_title  = '차보자';
$current_nav = '홈';
$BASE        = '';
$bnav_active = 'home';

$extra_head = <<<HTML
<style>
@keyframes carDriveIn {
  0%   { transform: translateY(-50%) translateX(260px); opacity: 0; }
  12%  { opacity: 1; }
  68%  { transform: translateY(-50%) translateX(-22px); }
  80%  { transform: translateY(-50%) translateX(9px); }
  90%  { transform: translateY(-50%) translateX(-4px); }
  100% { transform: translateY(-50%) translateX(0); }
}
.car-drive-in { animation: carDriveIn 0.9s ease-out forwards; }
</style>
HTML;

require __DIR__ . '/includes/header.php';
?>

<!-- ============== MAIN CAROUSEL ============== -->
<section class="relative overflow-hidden bg-white py-4" id="main-carousel">
  <div class="relative mx-auto max-w-[1600px] overflow-hidden" style="height:460px">
    <?php foreach ($banners as $i => $b): ?>
      <button class="mc-banner absolute top-6 h-[400px] overflow-hidden text-left transition-all duration-700 ease-out" data-idx="<?= $i ?>" data-target="<?= h($target_to_href[$b['target']] ?? '#') ?>" aria-label="<?= h($b['label']) ?> 배너" style="opacity:0;pointer-events:none">
        <?php if (!empty($b['image'])): ?>
          <img src="<?= h($b['image']) ?>" alt="<?= h($b['label']) ?>" class="absolute inset-0 w-full h-full object-cover"/>
        <?php endif; ?>
        <div class="mc-banner-bg absolute inset-0"></div>
        <div class="mc-banner-active relative z-10 px-16 py-12">
          <span class="mb-4 inline-flex w-fit px-4 py-1.5 text-sm font-black text-white <?= h($b['badge']) ?>"><?= h($b['label']) ?></span>
          <h1 class="whitespace-pre-line text-4xl font-black leading-tight text-white"><?= h($b['title']) ?></h1>
          <p class="mt-3 text-sm font-bold text-neutral-300"><?= h($b['desc']) ?></p>
          <span class="mt-6 inline-flex w-fit items-center gap-2 bg-white text-neutral-900 px-6 py-2.5 text-sm font-black"><?= h($b['button']) ?> →</span>
        </div>
        <div class="mc-banner-inactive absolute bottom-0 left-0 right-0 z-10 px-6 py-6 opacity-90" style="display:none">
          <span class="mb-2 inline-flex w-fit px-2 py-1 text-xs font-black text-white <?= h($b['badge']) ?>"><?= h($b['label']) ?></span>
          <p class="whitespace-pre-line text-sm font-black leading-snug text-white"><?= h($b['title']) ?></p>
        </div>
      </button>
    <?php endforeach; ?>
    <button id="mc-prev" class="absolute top-1/2 z-30 -translate-y-1/2 p-3 transition opacity-70 hover:opacity-100" style="left:calc(15% + 16px)" aria-label="이전 배너">
      <span style="display:inline-block;width:14px;height:14px;border-left:3px solid #fff;border-bottom:3px solid #fff;transform:rotate(45deg) translate(3px,-3px)"></span>
    </button>
    <button id="mc-next" class="absolute top-1/2 z-30 -translate-y-1/2 p-3 transition opacity-70 hover:opacity-100" style="right:calc(15% + 16px)" aria-label="다음 배너">
      <span style="display:inline-block;width:14px;height:14px;border-right:3px solid #fff;border-top:3px solid #fff;transform:rotate(45deg) translate(-3px,3px)"></span>
    </button>
  </div>
  <div class="h-[3px] bg-neutral-200"><div class="h-full bg-neutral-900" id="mc-progress" style="width:0%"></div></div>
  <div class="py-4 text-center text-xs tracking-[8px] text-neutral-500" id="mc-dots">
    <?php foreach ($banners as $i => $_): ?>
      <button class="mc-dot text-neutral-300" data-idx="<?= $i ?>">●</button>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============== POPULAR CARS ============== -->
<section class="mx-auto max-w-7xl px-6 py-16">
  <div class="mb-8 flex items-end justify-between gap-4">
    <div>
      <p class="mb-2 text-sm font-bold text-neutral-500"></p>
      <h2 class="text-3xl font-black tracking-tight text-neutral-950"><span class="font-black">Popular</span><span class="font-light text-neutral-400"> Cars</span></h2>
      <p class="mt-2 text-sm font-semibold text-neutral-400">이번 달 가장 많이 선택한 차량</p>
    </div>
    <div class="flex items-center gap-3">
      <span class="text-xs text-neutral-400"><span id="pop-range">1–3</span> / <?= count($popular) ?></span>
      <button id="pop-prev" class="h-10 w-10 flex items-center justify-center border border-neutral-300 hover:bg-neutral-900 hover:text-white transition disabled:opacity-30"><span style="display:inline-block;width:9px;height:9px;border-left:2px solid currentColor;border-bottom:2px solid currentColor;transform:rotate(45deg) translate(2px,-2px)"></span></button>
      <button id="pop-next" class="h-10 w-10 flex items-center justify-center border border-neutral-300 hover:bg-neutral-900 hover:text-white transition disabled:opacity-30"><span style="display:inline-block;width:9px;height:9px;border-right:2px solid currentColor;border-top:2px solid currentColor;transform:rotate(45deg) translate(-2px,2px)"></span></button>
    </div>
  </div>
  <div class="grid grid-cols-3 gap-5" id="pop-grid">
    <?php foreach ($popular as $idx => $car): $medal = ['1' => '🥇', '2' => '🥈', '3' => '🥉'][$car['rank']] ?? ''; ?>
      <a href="rental/" class="pop-card relative h-80 overflow-hidden group text-left block" data-idx="<?= $idx ?>" style="<?= $idx < 3 ? '' : 'display:none' ?>">
        <img src="<?= h($car['image']) ?>" alt="<?= h($car['name']) ?>" class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-105"/>
        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.82) 40%, rgba(0,0,0,0.1) 100%)"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
          <p class="mb-1 text-xs font-black tracking-widest text-neutral-400 uppercase">
            <?php if ($medal): ?><span class="mr-1"><?= $medal ?></span>이번 달 <?= h($car['rank']) ?>위<?php else: ?>이번 달 <?= h($car['rank']) ?>위<?php endif; ?>
          </p>
          <h3 class="text-xl font-black leading-tight"><?= h($car['name']) ?></h3>
          <p class="mt-1 text-sm font-semibold text-neutral-300"><?= h($car['price']) ?></p>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============== EVENTS TILES ============== -->
<section class="mx-auto max-w-7xl px-6 py-16">
  <div class="mb-8">
    <p class="mb-2 text-sm font-bold text-neutral-500">At,</p>
    <h2 class="text-3xl font-black tracking-tight text-neutral-950">Chaboza Event</h2>
    <p class="mt-2 text-sm font-semibold text-neutral-400">이번 주 차보자 추천 이벤트</p>
  </div>
  <div class="grid gap-6 md:grid-cols-4">
    <?php foreach ($events as $idx => $e): ?>
      <a href="event/" class="group h-56 bg-neutral-200 p-6 text-left transition hover:bg-neutral-800 hover:text-white block">
        <?php if ($idx === 1): ?>
          <span class="mb-8 inline-flex bg-neutral-800 px-3 py-1 text-xs font-bold text-white group-hover:bg-red-600">NOW OPEN</span>
        <?php endif; ?>
        <p class="mt-20 text-xs font-black">4.1 - 4.30</p>
        <h3 class="font-black"><?= h($e['title']) ?></h3>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============== HOT DEALS ============== -->
<section class="py-16">
  <div class="mx-auto max-w-7xl px-6">
    <div class="mb-8">
      <h2 class="text-3xl font-black tracking-tight text-neutral-950"><span class="font-black">Hot</span><span class="font-light">Deal</span></h2>
      <p class="mt-2 text-sm font-semibold text-neutral-400">오늘의 특가</p>
    </div>
    <div class="grid grid-cols-3 gap-5">
      <?php foreach (array_slice($hot_deals, 0, 3) as $d): ?>
        <a href="<?= h($target_to_href[$d['target']] ?? '#') ?>" class="overflow-hidden text-left <?= h($d['tone']) ?> block" style="height:320px">
          <?php if (!empty($d['image'])): ?>
            <img src="<?= h($d['image']) ?>" alt="" class="w-full object-cover" style="height:195px"/>
          <?php endif; ?>
          <div class="flex flex-col justify-end p-6" style="height:125px">
            <p class="mb-1 text-xs font-black text-red-500">HOT DEAL</p>
            <h3 class="whitespace-pre-line text-2xl font-black leading-tight"><?= h($d['title']) ?></h3>
            <p class="mt-2 text-lg font-black"><?= h($d['price']) ?></p>
            <p class="mt-1 text-xs font-bold opacity-60"><?= h($d['meta']) ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============== USED CAR BLOCKS ============== -->
<section class="mx-auto max-w-7xl px-6 py-16">
  <div class="mb-10 text-right">
    <h2 class="text-5xl font-black">Used<span class="font-light">Car</span></h2>
    <p class="text-sm font-semibold text-neutral-400">믿을 수 있는 인증 중고차 직거래</p>
  </div>
  <div class="grid gap-6 md:grid-cols-3">
    <?php foreach ($used_blocks as $idx => $b): ?>
      <a href="<?= h($b['href']) ?>" class="<?= $idx === 1 ? 'bg-slate-200' : 'bg-neutral-300' ?> h-48 p-7 text-left transition hover:bg-neutral-900 hover:text-white block">
        <p class="text-sm font-bold text-neutral-500"><?= h($b['title']) ?></p>
        <h3 class="mt-24 font-black"><?= h($b['desc']) ?></h3>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============== SHOP TILES ============== -->
<section class="mx-auto max-w-7xl px-6 py-16">
  <div class="mb-8 flex items-end justify-between gap-4">
    <div>
      <h2 class="text-3xl font-black tracking-tight text-neutral-950"><span class="font-black">Chaboza</span> <span class="font-light">Shop</span></h2>
      <p class="mt-2 text-sm font-semibold text-neutral-400">내 차를 더 스마트하게 만드는 자동차용품</p>
    </div>
  </div>
  <div class="grid grid-cols-2 gap-4 md:grid-cols-6">
    <?php foreach ($shop_tiles as $t): ?>
      <a href="shop/" class="<?= $t['dark'] ? 'bg-neutral-800 text-white' : 'bg-slate-200 text-neutral-950' ?> h-64 whitespace-pre-line p-6 text-left font-black block"><?= h($t['text']) ?></a>
    <?php endforeach; ?>
  </div>
</section>

<script>
$(function () {
  /* === Main Carousel === */
  var banners = $('.mc-banner');
  var dots    = $('.mc-dot');
  var cur = 0;
  var timer = null, raf = null, progressStart = null;
  var DURATION = 4500;

  function render() {
    banners.each(function (i) {
      var off = i - cur;
      if (off > banners.length / 2)  off -= banners.length;
      if (off < -banners.length / 2) off += banners.length;
      var active = (off === 0);
      var visible = Math.abs(off) <= 1;
      var lp = 50 + off * (70/2 + 22/2 + 1);
      $(this).css({
        left: lp + '%',
        width: active ? '70%' : '22%',
        transform: 'translateX(-50%) scale(' + (active ? 1 : 0.85) + ')',
        zIndex: active ? 20 : 10,
        filter: active ? 'none' : 'saturate(0.7)',
        opacity: visible ? 1 : 0,
        pointerEvents: visible ? '' : 'none'
      });
      $(this).find('.mc-banner-bg').css('background',
        active
          ? 'linear-gradient(to right, rgba(0,0,0,0.72) 40%, rgba(0,0,0,0.15) 100%)'
          : 'rgba(0,0,0,0.45)'
      );
      $(this).find('.mc-banner-active').toggle(active);
      $(this).find('.mc-banner-inactive').toggle(!active && visible);
    });
    dots.each(function (i) {
      $(this).removeClass('text-neutral-900 text-neutral-300').addClass(i === cur ? 'text-neutral-900' : 'text-neutral-300');
    });
  }
  function startAuto() {
    stopAuto();
    progressStart = null;
    function tick(ts) {
      if (!progressStart) progressStart = ts;
      var p = Math.min((ts - progressStart) / DURATION, 1);
      $('#mc-progress').css('width', (p * 100) + '%');
      if (p < 1) raf = requestAnimationFrame(tick);
    }
    raf = requestAnimationFrame(tick);
    timer = setInterval(function () {
      cur = (cur + 1) % banners.length;
      progressStart = null;
      render();
    }, DURATION);
  }
  function stopAuto() {
    if (timer) { clearInterval(timer); timer = null; }
    if (raf)   { cancelAnimationFrame(raf); raf = null; }
    $('#mc-progress').css('width', '0%');
  }
  $('#mc-prev').on('click', function () { cur = (cur - 1 + banners.length) % banners.length; render(); startAuto(); });
  $('#mc-next').on('click', function () { cur = (cur + 1) % banners.length; render(); startAuto(); });
  dots.on('click', function () { cur = parseInt($(this).data('idx'), 10); render(); startAuto(); });
  banners.on('click', function () {
    var idx = parseInt($(this).data('idx'), 10);
    if (idx === cur) {
      var target = $(this).data('target');
      if (target && target !== '#') location.href = target;
    } else {
      cur = idx; render(); startAuto();
    }
  });
  render();
  startAuto();

  /* === Popular Cars paging === */
  var popular = $('.pop-card');
  var popStart = 0;
  var PER = 3;
  function renderPop() {
    popular.each(function (i) {
      $(this).toggle(i >= popStart && i < popStart + PER);
    });
    $('#pop-range').text((popStart + 1) + '–' + Math.min(popStart + PER, popular.length));
    $('#pop-prev').prop('disabled', popStart === 0);
    $('#pop-next').prop('disabled', popStart >= popular.length - PER);
  }
  $('#pop-prev').on('click', function () { popStart = Math.max(0, popStart - 1); renderPop(); });
  $('#pop-next').on('click', function () { popStart = Math.min(popular.length - PER, popStart + 1); renderPop(); });
  renderPop();
});
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
