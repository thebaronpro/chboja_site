<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data.php';
require_once __DIR__ . '/../includes/inquiry.php';

$submitted = false; $inquiry_id = null; $form_errors = [];
$form = ['name' => '', 'phone' => '', 'car' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['name']  = trim($_POST['name']  ?? '');
    $form['phone'] = trim($_POST['phone'] ?? '');
    $form['car']   = trim($_POST['car']   ?? '');
    $result = inquiry_process('installment', $form);
    if ($result['ok']) {
        $submitted = true;
        $inquiry_id = $result['id'];
        $form = ['name' => '', 'phone' => '', 'car' => ''];
    } else {
        $form_errors = $result['errors'];
    }
}

$tabs = ['신차 할부', '중고차 할부', '할부 계산기', '금리 안내', '제휴 금융사'];
$active_idx = (int)($_GET['t'] ?? 0);
if ($active_idx < 0 || $active_idx >= count($tabs)) $active_idx = 0;

$banners = get_installment_banners();
$cars    = get_home_cars();

$page_title  = '할부';
$current_nav = '할부';
$BASE        = '../';
$bnav_active = 'search';

require __DIR__ . '/../includes/header.php';
?>

<section class="relative overflow-hidden bg-white py-4">
  <div class="relative mx-auto max-w-[1600px] overflow-hidden" id="ins-banner-wrap" style="height:460px">
    <?php foreach ($banners as $i => $b): ?>
      <div class="ins-banner absolute top-6 h-[400px] overflow-hidden text-left transition-all duration-700 ease-out" data-idx="<?= $i ?>" style="opacity:0;pointer-events:none">
        <?php if (!empty($b['image'])): ?>
          <img src="<?= h($b['image']) ?>" alt="" class="absolute inset-0 w-full h-full object-cover"/>
        <?php endif; ?>
        <div class="ins-banner-bg absolute inset-0"></div>
        <div class="ins-banner-active relative z-10 px-16 py-12">
          <span class="mb-4 inline-flex w-fit px-4 py-1.5 text-sm font-black text-white <?= h($b['badge']) ?>"><?= h($b['label']) ?></span>
          <h1 class="whitespace-pre-line text-4xl font-black leading-tight text-white"><?= h($b['title']) ?></h1>
          <p class="mt-3 text-sm font-bold text-neutral-300"><?= h($b['desc']) ?></p>
          <a href="../contact/" class="mt-6 inline-flex items-center gap-2 bg-white text-neutral-900 px-6 py-2.5 text-sm font-black"><?= h($b['button']) ?> →</a>
        </div>
        <div class="ins-banner-inactive absolute bottom-0 left-0 right-0 z-10 px-6 py-6" style="display:none">
          <span class="mb-2 inline-flex w-fit px-2 py-1 text-xs font-black text-white <?= h($b['badge']) ?>"><?= h($b['label']) ?></span>
          <p class="whitespace-pre-line text-sm font-black text-white"><?= h($b['title']) ?></p>
        </div>
      </div>
    <?php endforeach; ?>
    <button id="ins-prev" class="absolute top-1/2 z-30 -translate-y-1/2 p-3 opacity-70 hover:opacity-100 transition" style="left:calc(15% + 16px)">
      <span style="display:inline-block;width:14px;height:14px;border-left:3px solid #fff;border-bottom:3px solid #fff;transform:rotate(45deg) translate(3px,-3px)"></span>
    </button>
    <button id="ins-next" class="absolute top-1/2 z-30 -translate-y-1/2 p-3 opacity-70 hover:opacity-100 transition" style="right:calc(15% + 16px)">
      <span style="display:inline-block;width:14px;height:14px;border-right:3px solid #fff;border-top:3px solid #fff;transform:rotate(45deg) translate(-3px,3px)"></span>
    </button>
  </div>
  <div class="h-[3px] bg-neutral-200"><div class="h-full bg-neutral-900" id="ins-progress" style="width:0%"></div></div>
  <div class="py-4 text-center text-xs tracking-[8px] text-neutral-500" id="ins-dots">
    <?php foreach ($banners as $i => $b): ?>
      <button class="ins-dot text-neutral-300" data-idx="<?= $i ?>">●</button>
    <?php endforeach; ?>
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
      <h2 class="text-3xl font-black tracking-tight text-neutral-950">할부 신청 차량</h2>
      <p class="mt-2 text-sm font-semibold text-neutral-400">현대·기아 전 차종 무이자·저금리 할부 가능</p>
    </div>
    <div class="text-sm font-bold text-neutral-500">전체 보기 →</div>
  </div>
  <div class="grid gap-6 md:grid-cols-4">
    <?php foreach ($cars as $c): ?>
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
          <button class="mt-8 w-full bg-neutral-900 py-3 text-sm font-bold text-white hover:bg-red-600 transition">할부 신청하기</button>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="bg-neutral-100 py-16">
  <div class="mx-auto max-w-3xl px-6">
    <div class="mb-8 flex items-end justify-between gap-4">
      <div>
        <h2 class="text-3xl font-black tracking-tight text-neutral-950">할부 계산기</h2>
        <p class="mt-2 text-sm font-semibold text-neutral-400">차량 가격과 조건을 입력하면 월 납입금을 계산해드립니다.</p>
      </div>
    </div>
    <div class="bg-white p-8 shadow-sm">
      <div class="grid gap-6 md:grid-cols-2">
        <div>
          <label class="mb-2 block text-xs font-black text-neutral-500">차량 가격 (만원)</label>
          <input id="calc-price" type="number" value="3500" class="w-full border border-neutral-200 px-4 py-3 text-sm font-bold focus:outline-none focus:border-neutral-900"/>
        </div>
        <div>
          <label class="mb-2 block text-xs font-black text-neutral-500">선납금 / 계약금 (만원)</label>
          <input id="calc-deposit" type="number" value="500" class="w-full border border-neutral-200 px-4 py-3 text-sm font-bold focus:outline-none focus:border-neutral-900"/>
        </div>
        <div>
          <label class="mb-2 block text-xs font-black text-neutral-500">연 이자율 (%)</label>
          <input id="calc-rate" type="number" step="0.1" value="4.5" class="w-full border border-neutral-200 px-4 py-3 text-sm font-bold focus:outline-none focus:border-neutral-900"/>
        </div>
        <div>
          <label class="mb-2 block text-xs font-black text-neutral-500">할부 기간 (개월)</label>
          <select id="calc-months" class="w-full border border-neutral-200 px-4 py-3 text-sm font-bold focus:outline-none focus:border-neutral-900 bg-white">
            <?php foreach ([12,24,36,48,60,72] as $m): ?>
              <option value="<?= $m ?>"<?= $m === 48 ? ' selected' : '' ?>><?= $m ?>개월</option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="mt-8 border-t border-neutral-200 pt-8 text-center">
        <p class="text-sm font-bold text-neutral-500">예상 월 납입금</p>
        <p class="mt-2 text-5xl font-black text-neutral-950"><span id="calc-monthly">0</span><span class="text-2xl font-bold text-neutral-400">원</span></p>
        <p class="mt-3 text-xs text-neutral-400">※ 실제 금융 조건에 따라 다를 수 있습니다. 정확한 견적은 상담을 통해 확인하세요.</p>
        <button class="mt-6 bg-neutral-900 px-12 py-4 text-sm font-black text-white hover:bg-red-600 transition">할부 상담 신청하기</button>
      </div>
    </div>
  </div>
</section>

<section class="bg-neutral-900 py-16 text-white">
  <div class="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-6 md:grid-cols-[1.3fr_.8fr] md:items-center">
    <div>
      <h2 class="mb-3 text-4xl font-black">할부, 아직 고민 중이신가요?</h2>
      <p class="font-semibold text-neutral-400">전문 상담사가 최적 금융 상품을 빠르게 안내해드립니다.</p>
      <?php if ($submitted): ?>
        <div class="mt-6 border border-green-200 bg-green-50 text-green-800 px-6 py-4 text-sm font-bold">
          상담 신청이 접수되었습니다 (#<?= h($inquiry_id) ?>). 곧 연락드리겠습니다.
        </div>
      <?php endif; ?>
      <?php if (!empty($form_errors)): ?>
        <div class="mt-6 border border-red-200 bg-red-50 text-red-800 px-6 py-4 text-sm font-bold">
          <?php foreach ($form_errors as $msg): ?><p><?= h($msg) ?></p><?php endforeach; ?>
        </div>
      <?php endif; ?>
      <form method="post" action="" class="mt-8 grid gap-4 bg-white p-8 md:grid-cols-2">
        <input name="name"  value="<?= h($form['name']) ?>"  class="border border-neutral-200 px-5 py-4 text-sm text-neutral-900" placeholder="성함"/>
        <input name="phone" value="<?= h($form['phone']) ?>" class="border border-neutral-200 px-5 py-4 text-sm text-neutral-900" placeholder="휴대폰 번호"/>
        <input name="car"   value="<?= h($form['car']) ?>"   class="border border-neutral-200 px-5 py-4 text-sm text-neutral-900 md:col-span-2" placeholder="관심 차량"/>
        <button type="submit" class="bg-neutral-900 py-4 text-sm font-black text-white md:col-span-2">무료 상담 신청하기</button>
      </form>
    </div>
    <div class="bg-neutral-700 p-10">
      <p class="mb-5 text-lg font-bold text-white">전화 상담</p>
      <p class="mb-2 text-5xl font-black text-white">1661-3583</p>
      <p class="mb-8 text-sm text-neutral-300">평일 09:00 ~ 18:00</p>
    </div>
  </div>
</section>

<script>
$(function () {
  /* === 할부 계산기 (원금균등 amortization) === */
  function calc() {
    var price   = parseFloat($('#calc-price').val())   || 0;
    var deposit = parseFloat($('#calc-deposit').val()) || 0;
    var rate    = parseFloat($('#calc-rate').val())    || 0;
    var months  = parseInt($('#calc-months').val(), 10) || 1;
    var principal = Math.max(price * 10000 - deposit * 10000, 0);
    var r = (rate / 100) / 12;
    var monthly = r > 0
      ? principal * r / (1 - Math.pow(1 + r, -months))
      : principal / months;
    $('#calc-monthly').text(Math.round(monthly).toLocaleString());
  }
  $('#calc-price, #calc-deposit, #calc-rate, #calc-months').on('input change', calc);
  calc();

  /* === SubCarousel === */
  var banners = $('.ins-banner');
  var dots    = $('.ins-dot');
  var cur = 0;
  var timer = null;
  var raf   = null;
  var progressStart = null;
  var DURATION = 4500;

  function render() {
    banners.each(function (i) {
      var off = i - cur;
      if (off > banners.length / 2)  off -= banners.length;
      if (off < -banners.length / 2) off += banners.length;
      var active = off === 0;
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
      $(this).find('.ins-banner-bg').css('background',
        active
          ? 'linear-gradient(to right, rgba(0,0,0,.72) 40%, rgba(0,0,0,.15) 100%)'
          : 'rgba(0,0,0,.45)'
      );
      $(this).find('.ins-banner-active').toggle(active);
      $(this).find('.ins-banner-inactive').toggle(!active && visible);
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
      $('#ins-progress').css('width', (p * 100) + '%');
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
    $('#ins-progress').css('width', '0%');
  }

  $('#ins-prev').on('click', function () { cur = (cur - 1 + banners.length) % banners.length; render(); startAuto(); });
  $('#ins-next').on('click', function () { cur = (cur + 1) % banners.length; render(); startAuto(); });
  dots.on('click', function () { cur = parseInt($(this).data('idx'), 10); render(); startAuto(); });
  banners.on('click', function () {
    var idx = parseInt($(this).data('idx'), 10);
    if (idx === cur) { location.href = '../contact/'; }
    else { cur = idx; render(); startAuto(); }
  });

  render();
  startAuto();
});
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
