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
    $result = inquiry_process('lease', $form);
    if ($result['ok']) {
        $submitted = true;
        $inquiry_id = $result['id'];
        $form = ['name' => '', 'phone' => '', 'car' => ''];
    } else {
        $form_errors = $result['errors'];
    }
}

$tabs = ['1톤 리스', '2.5톤 리스', '5톤 리스', '특장차 리스', '냉동탑차'];
$active_idx = (int)($_GET['t'] ?? 0);
if ($active_idx < 0 || $active_idx >= count($tabs)) $active_idx = 0;

$trucks   = get_trucks();
$benefits = [
    ['num' => '01', 'title' => '부가세 환급',      'desc' => '사업자 명의 리스 계약 시 차량 부가세(VAT) 전액 환급 가능합니다. 취득 비용을 크게 줄일 수 있습니다.'],
    ['num' => '02', 'title' => '비용처리 100%',     'desc' => '리스료 전액을 법인·개인사업자 비용으로 처리해 과세 소득을 줄이고 절세 효과를 누릴 수 있습니다.'],
    ['num' => '03', 'title' => '보증금 0원 출고',   'desc' => '신용 조건 충족 시 보증금 없이 즉시 출고 가능. 초기 자금 부담 없이 사업을 시작하세요.'],
];

$page_title  = '화물리스';
$current_nav = '화물리스';
$BASE        = '../';
$bnav_active = 'search';

require __DIR__ . '/../includes/header.php';
?>

<section class="bg-slate-950 py-20 text-white">
  <div class="mx-auto max-w-7xl px-6">
    <div class="grid gap-10 md:grid-cols-2 md:items-center">
      <div>
        <p class="mb-3 text-sm font-black tracking-widest text-slate-400 uppercase">TRUCK LEASE</p>
        <h1 class="text-5xl font-black leading-tight">사업용 화물차 리스로<br/>세금 혜택까지</h1>
        <p class="mt-5 text-base font-semibold text-slate-300">부가세 환급 · 비용 처리 · 보증금 0원 가능</p>
        <div class="mt-8 flex gap-3">
          <button class="bg-white text-neutral-900 hover:bg-neutral-100 inline-flex items-center justify-center gap-2 px-7 py-3 text-sm font-bold transition">사업자 견적받기</button>
          <button class="bg-neutral-900 text-white hover:bg-[#1E4FCC] inline-flex items-center justify-center gap-2 px-7 py-3 text-sm font-bold transition">세금 혜택 안내</button>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-4 text-center">
        <?php foreach ([['부가세','환급 가능'],['비용','100% 처리'],['보증금','0원 가능']] as [$a,$b]): ?>
          <div class="border border-slate-700 p-6">
            <p class="text-2xl font-black text-white"><?= h($a) ?></p>
            <p class="mt-1 text-xs text-slate-400"><?= h($b) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<div class="border-b border-neutral-200 bg-white">
  <div class="mx-auto flex max-w-7xl overflow-x-auto px-4">
    <?php foreach ($tabs as $i => $t): $on = ($i === $active_idx); ?>
      <a href="?t=<?= $i ?>" class="min-w-fit px-8 py-4 text-sm font-bold whitespace-nowrap <?= $on ? 'border-b-4 border-[#2858E0] text-[#1E4FCC]' : 'text-neutral-500 hover:text-neutral-900' ?>"><?= h($t) ?></a>
    <?php endforeach; ?>
  </div>
</div>

<section class="mx-auto max-w-7xl px-6 py-16">
  <div class="mb-8 flex items-end justify-between gap-4">
    <div>
      <h2 class="text-3xl font-black tracking-tight text-neutral-950">화물차 리스 라인업</h2>
      <p class="mt-2 text-sm font-semibold text-neutral-400">전 차종 보증금 0원 옵션 · 부가세 환급 안내 포함</p>
    </div>
    <div class="text-sm font-bold text-neutral-500">전체 보기 →</div>
  </div>
  <div class="grid gap-6 md:grid-cols-4">
    <?php foreach ($trucks as $c): ?>
      <article class="border border-neutral-200 bg-white">
        <?php if (!empty($c['image'])): ?>
          <img src="<?= h($c['image']) ?>" alt="" class="object-cover h-72 w-full"/>
        <?php else: ?>
          <div class="bg-slate-200 h-72 w-full"></div>
        <?php endif; ?>
        <div class="p-5">
          <?php if (!empty($c['tag'])): ?>
            <span class="mb-3 inline-flex bg-neutral-800 px-3 py-1 text-xs font-black text-white"><?= h($c['tag']) ?></span>
          <?php endif; ?>
          <h3 class="font-black text-neutral-950"><?= h($c['name']) ?></h3>
          <p class="mt-1 font-black text-neutral-950"><?= h($c['price']) ?></p>
          <p class="mt-1 text-sm text-neutral-500"><?= h($c['meta']) ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="bg-neutral-100 py-16">
  <div class="mx-auto max-w-7xl px-6">
    <div class="mb-8 flex items-end justify-between gap-4">
      <div>
        <h2 class="text-3xl font-black tracking-tight text-neutral-950">화물리스 주요 혜택</h2>
        <p class="mt-2 text-sm font-semibold text-neutral-400">사업자라면 꼭 확인하세요</p>
      </div>
    </div>
    <div class="grid gap-6 md:grid-cols-3">
      <?php foreach ($benefits as $b): ?>
        <div class="bg-white p-8">
          <p class="mb-4 text-5xl font-black text-neutral-200"><?= h($b['num']) ?></p>
          <h3 class="mb-3 text-lg font-black"><?= h($b['title']) ?></h3>
          <p class="text-sm text-neutral-500 leading-relaxed"><?= h($b['desc']) ?></p>
          <button class="mt-6 text-sm font-black hover:underline" style="color:#2858E0">자세히 보기 →</button>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-neutral-900 py-16 text-white">
  <div class="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-6 md:grid-cols-[1.3fr_.8fr] md:items-center">
    <div>
      <h2 class="mb-3 text-4xl font-black">화물리스 무료 상담</h2>
      <p class="font-semibold text-neutral-400">사업자 맞춤 리스 조건을 빠르게 안내해드립니다.</p>
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
        <input name="name"  value="<?= h($form['name']) ?>"  class="border border-neutral-200 px-5 py-4 text-sm text-neutral-900" placeholder="성함 / 상호명"/>
        <input name="phone" value="<?= h($form['phone']) ?>" class="border border-neutral-200 px-5 py-4 text-sm text-neutral-900" placeholder="휴대폰 번호"/>
        <input name="car"   value="<?= h($form['car']) ?>"   class="border border-neutral-200 px-5 py-4 text-sm text-neutral-900 md:col-span-2" placeholder="관심 차종 (예: 포터 EV, 봉고3)"/>
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

<?php require __DIR__ . '/../includes/footer.php'; ?>
