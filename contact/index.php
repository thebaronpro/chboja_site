<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/inquiry.php';

$submitted = false;
$inquiry_id = null;
$form_errors = [];
$form = ['name' => '', 'phone' => '', 'category' => '장기렌트', 'message' => ''];
$categories = ['장기렌트','할부','중고차','화물리스','자동차용품','기타'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['name']     = trim($_POST['name']     ?? '');
    $form['phone']    = trim($_POST['phone']    ?? '');
    $form['category'] = in_array($_POST['category'] ?? '', $categories, true) ? $_POST['category'] : '장기렌트';
    $form['message']  = trim($_POST['message']  ?? '');

    $result = inquiry_process('contact', [
        'name'     => $form['name'],
        'phone'    => $form['phone'],
        'category' => $form['category'],
        'message'  => $form['message'],
    ]);

    if ($result['ok']) {
        $submitted = true;
        $inquiry_id = $result['id'];
        $form = ['name' => '', 'phone' => '', 'category' => '장기렌트', 'message' => ''];
    } else {
        $form_errors = $result['errors'];
    }
}

$page_title  = '고객센터';
$current_nav = '고객센터';
$BASE        = '../';
$bnav_active = 'search';

require __DIR__ . '/../includes/header.php';
?>

<section class="bg-neutral-900 py-20 text-white">
  <div class="mx-auto max-w-7xl px-6 text-center">
    <p class="mb-3 text-sm font-black tracking-widest text-neutral-500 uppercase">CUSTOMER SERVICE</p>
    <h1 class="text-5xl font-black">고객센터</h1>
    <p class="mt-4 text-base font-semibold text-neutral-400">빠르고 친절하게 도와드리겠습니다.</p>
  </div>
</section>

<section class="border-b border-neutral-200 py-12 bg-white">
  <div class="mx-auto max-w-7xl px-6">
    <div class="grid gap-6 md:grid-cols-3">
      <?php
      $channels = [
          ['icon'=>'☎','title'=>'전화 상담','main'=>'1661-3583','sub'=>'평일 09:00 ~ 18:00','note'=>'점심시간 12:00 ~ 13:00 제외','btn'=>'전화하기','color'=>'bg-neutral-900','textDark'=>false],
          ['icon'=>'●','title'=>'카카오 상담','main'=>'@차보자','sub'=>'평일 09:00 ~ 20:00','note'=>'채팅으로 빠르게 상담받으세요','btn'=>'카카오 상담하기','color'=>'bg-yellow-400','textDark'=>true],
          ['icon'=>'✉','title'=>'이메일 문의','main'=>'help@chaboza.kr','sub'=>'24시간 접수','note'=>'영업일 기준 1일 이내 답변','btn'=>'이메일 보내기','color'=>'bg-red-600','textDark'=>false],
      ];
      foreach ($channels as $c): ?>
        <div class="border border-neutral-200 p-8">
          <p class="mb-4 text-4xl"><?= h($c['icon']) ?></p>
          <p class="text-xs font-black tracking-widest text-neutral-400 uppercase mb-2"><?= h($c['title']) ?></p>
          <p class="text-2xl font-black text-neutral-950"><?= h($c['main']) ?></p>
          <p class="mt-1 text-sm font-bold text-neutral-500"><?= h($c['sub']) ?></p>
          <p class="mt-1 text-xs text-neutral-400"><?= h($c['note']) ?></p>
          <button class="mt-6 w-full py-3 text-sm font-black transition <?= h($c['color']) ?> <?= $c['textDark'] ? 'text-neutral-900' : 'text-white' ?> hover:opacity-90"><?= h($c['btn']) ?></button>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-neutral-100 py-16">
  <div class="mx-auto max-w-3xl px-6">
    <div class="mb-8 flex items-end justify-between gap-4">
      <div>
        <h2 class="text-3xl font-black tracking-tight text-neutral-950">자주 묻는 질문</h2>
        <p class="mt-2 text-sm font-semibold text-neutral-400">궁금한 점을 빠르게 확인하세요.</p>
      </div>
    </div>
    <div class="space-y-2" id="faq-list">
      <?php foreach (FAQS as $i => [$q, $a]): ?>
        <div class="bg-white border border-neutral-200 faq-item">
          <button type="button" class="faq-toggle flex w-full items-center justify-between px-6 py-5 text-left font-black hover:bg-neutral-50 transition" data-idx="<?= $i ?>">
            <span class="flex items-center gap-3">
              <span class="text-red-600 font-black text-sm">Q</span>
              <?= h($q) ?>
            </span>
            <span class="faq-caret ml-4 flex-shrink-0 text-neutral-400 transition-transform" style="display:inline-block">⌄</span>
          </button>
          <div class="faq-answer border-t border-neutral-100 px-6 py-5 text-sm text-neutral-600 leading-relaxed" style="display:none">
            <span class="font-black text-neutral-900 mr-3">A</span><?= h($a) ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-16 bg-white">
  <div class="mx-auto max-w-2xl px-6">
    <div class="mb-8 flex items-end justify-between gap-4">
      <div>
        <h2 class="text-3xl font-black tracking-tight text-neutral-950">1:1 문의</h2>
        <p class="mt-2 text-sm font-semibold text-neutral-400">상담 내용을 남겨주시면 빠르게 답변드립니다.</p>
      </div>
    </div>
    <?php if ($submitted): ?>
      <div class="border border-green-200 bg-green-50 text-green-800 px-6 py-4 text-sm font-bold mb-6">
        문의가 접수되었습니다 (접수번호 #<?= h($inquiry_id) ?>). 빠른 시일 내 답변드리겠습니다.
      </div>
    <?php endif; ?>
    <?php if (!empty($form_errors)): ?>
      <div class="border border-red-200 bg-red-50 text-red-800 px-6 py-4 text-sm font-bold mb-6">
        <?php foreach ($form_errors as $msg): ?>
          <p><?= h($msg) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <form method="post" action="" class="grid gap-4" id="contact-form">
      <div class="grid gap-4 md:grid-cols-2">
        <div>
          <label class="mb-2 block text-xs font-black text-neutral-500">성함</label>
          <input name="name" value="<?= h($form['name']) ?>" class="w-full border border-neutral-200 px-5 py-4 text-sm focus:outline-none focus:border-neutral-900" placeholder="홍길동"/>
        </div>
        <div>
          <label class="mb-2 block text-xs font-black text-neutral-500">휴대폰 번호</label>
          <input name="phone" value="<?= h($form['phone']) ?>" class="w-full border border-neutral-200 px-5 py-4 text-sm focus:outline-none focus:border-neutral-900" placeholder="010-0000-0000"/>
        </div>
      </div>
      <div>
        <label class="mb-2 block text-xs font-black text-neutral-500">문의 유형</label>
        <select name="category" class="w-full border border-neutral-200 px-5 py-4 text-sm focus:outline-none focus:border-neutral-900 bg-white">
          <?php foreach ($categories as $c): ?>
            <option value="<?= h($c) ?>"<?= $c === $form['category'] ? ' selected' : '' ?>><?= h($c) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="mb-2 block text-xs font-black text-neutral-500">문의 내용</label>
        <textarea name="message" rows="6" class="w-full border border-neutral-200 px-5 py-4 text-sm focus:outline-none focus:border-neutral-900 resize-none" placeholder="문의하실 내용을 자유롭게 입력해주세요."><?= h($form['message']) ?></textarea>
      </div>
      <p class="text-xs text-neutral-400">개인정보 수집 및 이용에 동의합니다. (필수)</p>
      <button type="submit" class="w-full bg-neutral-900 py-4 text-sm font-black text-white hover:bg-red-600 transition">문의 접수하기</button>
    </form>
  </div>
</section>

<script>
$(function () {
  $('.faq-toggle').on('click', function () {
    var $item   = $(this).closest('.faq-item');
    var $answer = $item.find('.faq-answer');
    var $caret  = $item.find('.faq-caret');
    var open    = $answer.is(':visible');
    $('#faq-list .faq-answer').hide();
    $('#faq-list .faq-caret').css('transform', '');
    if (!open) {
      $answer.show();
      $caret.css('transform', 'rotate(180deg)');
    }
  });

  $('#contact-form').on('submit', function (e) {
    var name  = $.trim($(this).find('[name=name]').val());
    var phone = $.trim($(this).find('[name=phone]').val());
    if (!name || !phone) {
      e.preventDefault();
      alert('성함과 휴대폰 번호를 입력해 주세요.');
    }
  });
});
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
