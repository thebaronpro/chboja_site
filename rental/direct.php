<?php
$top_active    = '장기렌트';
$subnav_active = 'direct';
$bnav_active   = '';

$SK_POPULAR = [
  ['name'=>'기아 더 뉴 셀토스',       'img'=>'../cars/cdn_4391.png', 'price'=>'310,500', 'original'=>'2,817만원', 'color'=>'스노우 화이트펄',  'chip'=>'#fafafa', 'border'=>true,  'badges'=>['#즉시배송','첫 달 0원']],
  ['name'=>'현대 더 뉴 아반떼 (CN7)', 'img'=>'../cars/cdn_4455.png', 'price'=>'285,000', 'original'=>'2,424만원', 'color'=>'아틀라스 화이트', 'chip'=>'#fafafa', 'border'=>true,  'badges'=>['#즉시배송','첫 달 0원']],
  ['name'=>'르노 그랑 콜레오스',     'img'=>'../cars/cdn_4659.png', 'price'=>'357,100', 'original'=>'4,309만원', 'color'=>'메탈릭 블랙',     'chip'=>'#1c1c1c', 'border'=>false, 'badges'=>['#즉시배송','첫 달 0원','한정특가']],
];

$SK_GRID = [
  ['name'=>'르노 그랑 콜레오스',     'img'=>'../cars/cdn_4659.png', 'price'=>'357,100', 'original'=>'4,309만원', 'tag'=>'빠른배송',  'chips'=>[['#1c1c1c',false]],                                                  'badges'=>['#즉시배송','첫 달 0원','한정특가']],
  ['name'=>'르노 그랑 콜레오스',     'img'=>'../cars/cdn_4659.png', 'price'=>'379,100', 'original'=>'3,915만원', 'tag'=>'맞춤주문',  'chips'=>[['#fafafa',true],['#d6c5a8',false],['#1c1c1c',false],['#9ca3af',false]],     'badges'=>[]],
  ['name'=>'현대 그랜저 (GN7)',      'img'=>'../cars/cdn_4188.png', 'price'=>'426,700', 'original'=>'4,185만원', 'tag'=>'맞춤주문',  'chips'=>[['#fafafa',true],['#7a1a20',false],['#9ca3af',false],['#1c1c1c',false]], 'extra'=>6, 'badges'=>['신형 출시']],
  ['name'=>'기아 디 올 뉴 니로',     'img'=>'../cars/cdn_4775.png', 'price'=>'302,700', 'original'=>'2,985만원', 'tag'=>'맞춤주문',  'chips'=>[['#9ca3af',false],['#1c1c1c',false],['#a16f3a',false],['#525252',false]], 'extra'=>1, 'badges'=>[]],
  ['name'=>'기아 더 뉴 기아 레이',   'img'=>'../cars/307_4689.png', 'price'=>'256,200', 'original'=>'1,490만원', 'tag'=>'맞춤주문',  'chips'=>[['#aedfe2',false],['#9ca3af',false],['#1c1c1c',false],['#525252',false]], 'extra'=>3, 'badges'=>['경차혜택!']],
  ['name'=>'기아 더 뉴 기아 레이',   'img'=>'../cars/307_4689.png', 'price'=>'280,700', 'original'=>'1,835만원', 'tag'=>'빠른배송',  'chips'=>[['#fafafa',true]],                                                       'badges'=>['#즉시배송','첫 달 0원']],
];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>다이렉트존 — RENT insight</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Pretendard Variable',Pretendard,-apple-system,BlinkMacSystemFont,system-ui,Roboto,sans-serif;background:#fff;color:#0a0a0a;padding-bottom:4rem}
a{text-decoration:none;color:inherit}

/* === 탭 === */
.dt-tabs{display:flex;gap:.5rem;border-bottom:1.5px solid #e5e5e5;margin-bottom:2rem;overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:none}
.dt-tabs::-webkit-scrollbar{display:none}
.dt-tab{flex-shrink:0;padding:.85rem 1.4rem;font-size:.95rem;font-weight:700;color:#737373;background:none;border:none;cursor:pointer;border-bottom:2.5px solid transparent;margin-bottom:-1.5px;transition:all .15s;font-family:inherit;letter-spacing:-.01em;white-space:nowrap}
.dt-tab:hover{color:#0a0a0a}
.dt-tab.active{color:#2858E0;border-bottom-color:#2858E0;font-weight:900}

/* === 배너 === */
.dt-banner-wrap{position:relative;margin-bottom:2.5rem}
.dt-banner{position:relative;border-radius:18px;overflow:hidden;background:linear-gradient(135deg,#ddd6fe 0%,#c4b5fd 100%);padding:2.5rem 3.5rem;display:flex;align-items:center;justify-content:space-between;gap:2rem;min-height:170px}
.dt-banner-text h2{font-size:2rem;font-weight:900;color:#1c1917;letter-spacing:-.02em;line-height:1.2}
.dt-banner-text h2 em{font-style:normal;color:#7c3aed;font-weight:900}
.dt-banner-text p{margin-top:.6rem;font-size:.95rem;color:#525252;font-weight:500}
.dt-banner-visual{flex-shrink:0;width:240px;height:140px;display:flex;align-items:center;justify-content:center;position:relative}
.dt-banner-zero{font-family:'Pretendard Variable',Pretendard,sans-serif;font-size:9rem;font-weight:900;line-height:1;background:linear-gradient(180deg,#a78bfa 0%,#7c3aed 100%);-webkit-background-clip:text;background-clip:text;color:transparent;letter-spacing:-.06em;text-shadow:0 8px 24px rgba(124,58,237,.25)}
.dt-banner-tag{position:absolute;bottom:8px;right:-10px;background:#fff;color:#7c3aed;font-size:.7rem;font-weight:800;padding:.3rem .65rem;border-radius:999px;box-shadow:0 4px 12px rgba(0,0,0,.1);letter-spacing:-.01em}
.dt-arrow{position:absolute;top:50%;transform:translateY(-50%);width:36px;height:36px;border-radius:50%;background:rgba(0,0,0,.18);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;z-index:5}
.dt-arrow.prev{left:.6rem}
.dt-arrow.next{right:.6rem}
.dt-dots{position:absolute;bottom:.85rem;left:50%;transform:translateX(-50%);display:flex;gap:5px;z-index:5}
.dt-dot{width:8px;height:8px;border-radius:999px;background:rgba(0,0,0,.18);transition:all .15s}
.dt-dot.active{width:20px;background:#7c3aed}

/* === 인기 섹션 === */
.dt-popular-section{background:#fafafa;border-radius:18px;padding:2.5rem 1.5rem;margin-bottom:3rem;text-align:center}
.dt-pop-title{font-size:1.35rem;font-weight:900;color:#0a0a0a;letter-spacing:-.02em;margin-bottom:.45rem}
.dt-pop-sub{font-size:.85rem;color:#a3a3a3;font-weight:500;margin-bottom:1.75rem;letter-spacing:.02em}
.dt-pop-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem;max-width:920px;margin-left:auto;margin-right:auto}
.dt-pop-card{background:#fff;border-radius:14px;padding:1rem 1rem 1.25rem;text-align:left;position:relative}
.dt-pop-img{position:relative;background:#f5f5f5;border-radius:10px;padding:1.25rem 1rem;height:160px;display:flex;align-items:center;justify-content:center;margin-bottom:.65rem}
.dt-pop-img img{max-width:100%;max-height:100%;object-fit:contain}
.dt-fast-badge{position:absolute;top:.65rem;left:.65rem;background:#dc2626;color:#fff;font-size:.62rem;font-weight:800;padding:.2rem .5rem;border-radius:5px;letter-spacing:-.01em;z-index:2}
.dt-pop-color-row{display:flex;align-items:center;gap:.35rem;padding:.4rem;background:#fafafa;border-radius:6px;font-size:.7rem;color:#737373;justify-content:center;margin-bottom:.65rem}
.dt-pop-color-row .dt-chip{width:.7rem;height:.7rem;border-radius:50%;flex-shrink:0}
.dt-pop-label{font-size:.7rem;color:#a3a3a3;font-weight:500;margin-bottom:.18rem}
.dt-pop-name{font-size:1rem;font-weight:900;color:#0a0a0a;letter-spacing:-.02em;margin-bottom:.6rem;line-height:1.25}
.dt-pop-period{font-size:.75rem;color:#737373;font-weight:600}
.dt-pop-price{font-size:1.15rem;font-weight:900;color:#dc2626;letter-spacing:-.02em;margin:.15rem 0 .25rem}
.dt-pop-orig{font-size:.72rem;color:#a3a3a3;font-weight:500;margin-bottom:.6rem}
.dt-badges{display:flex;flex-wrap:wrap;gap:.3rem}
.dt-badge{font-size:.66rem;font-weight:700;padding:.18rem .45rem;border-radius:4px;border:1px solid #fca5a5;color:#dc2626;background:#fff;letter-spacing:-.01em}
.dt-pop-more{display:inline-flex;align-items:center;gap:.3rem;padding:.7rem 1.4rem;background:#fff;color:#0a0a0a;border:1.5px solid #e5e5e5;border-radius:999px;font-size:.88rem;font-weight:700;cursor:pointer;transition:all .15s}
.dt-pop-more:hover{border-color:#0a0a0a}

/* === 전체 그리드 === */
.dt-grid-section{margin-bottom:2rem}
.dt-grid-head{display:flex;justify-content:flex-end;margin-bottom:1.5rem}
.dt-sort{display:inline-flex;align-items:center;gap:.35rem;font-size:.85rem;color:#525252;font-weight:600;cursor:pointer}
.dt-sort::after{content:"⌄";font-size:.85rem;color:#a3a3a3;line-height:1}
.dt-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem}
.dt-card{background:#fff;border-radius:14px;overflow:hidden;cursor:pointer;transition:box-shadow .15s,transform .15s}
.dt-card:hover{box-shadow:0 4px 18px rgba(0,0,0,.08);transform:translateY(-2px)}
.dt-card-img{position:relative;background:#f5f5f5;height:200px;display:flex;align-items:center;justify-content:center;padding:1.25rem}
.dt-card-img img{max-width:100%;max-height:100%;object-fit:contain}
.dt-tag-fast{position:absolute;top:.85rem;left:.85rem;background:#dc2626;color:#fff;font-size:.65rem;font-weight:800;padding:.22rem .55rem;border-radius:5px;letter-spacing:-.01em}
.dt-tag-custom{position:absolute;top:.85rem;left:.85rem;background:rgba(28,28,28,.78);color:#fff;font-size:.65rem;font-weight:700;padding:.22rem .55rem;border-radius:5px;letter-spacing:-.01em;backdrop-filter:blur(4px)}
.dt-card-chips{position:absolute;bottom:.65rem;left:.85rem;display:flex;align-items:center;gap:.3rem}
.dt-card-chips .dt-chip{width:.75rem;height:.75rem;border-radius:50%}
.dt-card-chips .dt-extra{font-size:.7rem;color:#737373;font-weight:600;margin-left:.15rem}
.dt-card-body{padding:.9rem 1rem 1.2rem}
.dt-card-label{font-size:.7rem;color:#a3a3a3;font-weight:500;margin-bottom:.2rem}
.dt-card-name{font-size:1.02rem;font-weight:900;color:#0a0a0a;letter-spacing:-.02em;margin-bottom:.7rem;line-height:1.25}
.dt-card-period{font-size:.75rem;color:#737373;font-weight:600}
.dt-card-price{font-size:1.2rem;font-weight:900;color:#dc2626;letter-spacing:-.02em;margin:.18rem 0 .3rem}
.dt-card-orig{font-size:.75rem;color:#a3a3a3;font-weight:500;margin-bottom:.7rem}

/* === 다른 탭 빈 상태 === */
.dt-empty{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.5rem;padding:5rem 1rem;text-align:center;color:#a3a3a3;background:#fafafa;border-radius:14px}
.dt-empty strong{color:#0a0a0a;font-size:1.05rem;font-weight:800}

@media(max-width:768px){
  .dt-tab{padding:.7rem 1rem;font-size:.88rem}
  .dt-banner{padding:1.5rem 1.75rem;flex-direction:row;gap:1rem;min-height:140px}
  .dt-banner-text h2{font-size:1.2rem}
  .dt-banner-text p{font-size:.78rem;margin-top:.4rem}
  .dt-banner-visual{width:110px;height:90px}
  .dt-banner-zero{font-size:5.2rem}
  .dt-banner-tag{font-size:.58rem;padding:.22rem .5rem;bottom:0;right:-6px}
  .dt-arrow{width:30px;height:30px;font-size:.95rem}

  .dt-popular-section{padding:1.5rem 1rem;border-radius:14px}
  .dt-pop-title{font-size:1.05rem}
  .dt-pop-sub{font-size:.75rem;margin-bottom:1.2rem}
  .dt-pop-grid{grid-template-columns:1fr;gap:.75rem}
  .dt-pop-img{height:140px}

  .dt-grid{grid-template-columns:repeat(2,1fr);gap:.75rem}
  .dt-card-img{height:140px;padding:.85rem}
  .dt-card-name{font-size:.92rem}
  .dt-card-price{font-size:1.05rem}
  .dt-tag-fast,.dt-tag-custom{font-size:.6rem;padding:.18rem .42rem}
}
</style>
</head>
<body>
<?php require __DIR__ . '/../includes/rental_header.php'; ?>

<main style="max-width:1280px;margin:0 auto;padding:2.5rem 1.5rem 3rem">
  <div style="margin-bottom:1.75rem">
    <h1 style="font-size:2.2rem;font-weight:900;letter-spacing:-.02em">다이렉트 <span style="color:#2858E0">존</span></h1>
    <p style="margin-top:.55rem;font-size:.95rem;color:#737373;font-weight:500">중간 수수료 0원, 본사 직거래 다이렉트 렌트</p>
  </div>

  <nav class="dt-tabs" role="tablist">
    <button class="dt-tab" data-tab="hyundai" role="tab">현대다이렉트</button>
    <button class="dt-tab" data-tab="lotte" role="tab">롯데다이렉트</button>
    <button class="dt-tab active" data-tab="sk" role="tab">SK다이렉트</button>
    <button class="dt-tab" data-tab="kb" role="tab">KB다이렉트</button>
  </nav>

  <!-- SK 다이렉트 콘텐츠 -->
  <div class="dt-content" data-content="sk">
    <!-- 캐러셀 배너 -->
    <div class="dt-banner-wrap">
      <button class="dt-arrow prev" aria-label="이전">‹</button>
      <div class="dt-banner">
        <div class="dt-banner-text">
          <h2>신차 렌탈료 <em>첫 달 0원</em></h2>
          <p>즉시 출고되는 빠른 배송 신차를 0원으로 시작!</p>
        </div>
        <div class="dt-banner-visual">
          <span class="dt-banner-zero">0</span>
          <span class="dt-banner-tag">신차 인기차량</span>
        </div>
      </div>
      <button class="dt-arrow next" aria-label="다음">›</button>
      <div class="dt-dots">
        <span class="dt-dot active"></span><span class="dt-dot"></span><span class="dt-dot"></span><span class="dt-dot"></span><span class="dt-dot"></span>
      </div>
    </div>

    <!-- 인기 차량 섹션 -->
    <section class="dt-popular-section">
      <h2 class="dt-pop-title">'첫 달 0원, 신차 렌탈료 프리' 인기차량</h2>
      <p class="dt-pop-sub">#봄맞이 특별할인 #선착순 한정 #1개월 무료</p>
      <div class="dt-pop-grid">
        <?php foreach ($SK_POPULAR as $c): ?>
        <article class="dt-pop-card">
          <div class="dt-pop-img">
            <span class="dt-fast-badge">빠른배송</span>
            <img src="<?= h($c['img']) ?>" alt="<?= h($c['name']) ?>" onerror="this.style.opacity=.2">
          </div>
          <div class="dt-pop-color-row">
            <span class="dt-chip" style="background:<?= h($c['chip']) ?>;<?= $c['border']?'border:1px solid #d4d4d4':'' ?>"></span>
            <span><?= h($c['color']) ?></span>
          </div>
          <p class="dt-pop-label">신차</p>
          <h3 class="dt-pop-name"><?= h($c['name']) ?></h3>
          <p class="dt-pop-period">48개월</p>
          <p class="dt-pop-price">월 <?= h($c['price']) ?>원 ~</p>
          <p class="dt-pop-orig">신차 출고가 <?= h($c['original']) ?></p>
          <div class="dt-badges">
            <?php foreach ($c['badges'] as $b): ?>
              <span class="dt-badge"><?= h($b) ?></span>
            <?php endforeach; ?>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
      <button class="dt-pop-more" type="button">'첫 달 0원' 차종 전체보기 ›</button>
    </section>

    <!-- 전체 그리드 -->
    <section class="dt-grid-section">
      <div class="dt-grid-head">
        <span class="dt-sort">모델 가나다순</span>
      </div>
      <div class="dt-grid">
        <?php foreach ($SK_GRID as $c): ?>
        <article class="dt-card">
          <div class="dt-card-img">
            <span class="<?= $c['tag']==='빠른배송'?'dt-tag-fast':'dt-tag-custom' ?>"><?= h($c['tag']) ?></span>
            <img src="<?= h($c['img']) ?>" alt="<?= h($c['name']) ?>" onerror="this.style.opacity=.2">
            <div class="dt-card-chips">
              <?php foreach ($c['chips'] as $chip): ?>
                <span class="dt-chip" style="background:<?= h($chip[0]) ?>;<?= $chip[1]?'border:1px solid #d4d4d4':'' ?>"></span>
              <?php endforeach; ?>
              <?php if (!empty($c['extra'])): ?>
                <span class="dt-extra">+<?= (int)$c['extra'] ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div class="dt-card-body">
            <p class="dt-card-label">신차</p>
            <h3 class="dt-card-name"><?= h($c['name']) ?></h3>
            <p class="dt-card-period">48개월</p>
            <p class="dt-card-price">월 <?= h($c['price']) ?>원 ~</p>
            <p class="dt-card-orig">신차 출고가 <?= h($c['original']) ?></p>
            <?php if (!empty($c['badges'])): ?>
            <div class="dt-badges">
              <?php foreach ($c['badges'] as $b): ?>
                <span class="dt-badge"><?= h($b) ?></span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </section>
  </div>

  <!-- 다른 탭들 -->
  <div class="dt-content" data-content="hyundai" style="display:none">
    <div class="dt-empty"><strong>현대다이렉트</strong><span>준비 중입니다.</span></div>
  </div>
  <div class="dt-content" data-content="lotte" style="display:none">
    <div class="dt-empty"><strong>롯데다이렉트</strong><span>준비 중입니다.</span></div>
  </div>
  <div class="dt-content" data-content="kb" style="display:none">
    <div class="dt-empty"><strong>KB다이렉트</strong><span>준비 중입니다.</span></div>
  </div>
</main>

<?php require __DIR__ . '/../includes/rental_footer.php'; ?>

<script>
document.querySelectorAll('.dt-tab').forEach(btn => {
  btn.addEventListener('click', () => {
    const key = btn.dataset.tab;
    document.querySelectorAll('.dt-tab').forEach(b => b.classList.toggle('active', b===btn));
    document.querySelectorAll('.dt-content').forEach(p => {
      p.style.display = (p.dataset.content === key) ? '' : 'none';
    });
  });
});
</script>
</body>
</html>
