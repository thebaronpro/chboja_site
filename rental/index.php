<?php header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0'); header('Pragma: no-cache'); header('Expires: 0'); ?><!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<title>장기렌트 — RENT insight</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body { font-family: 'Pretendard Variable', Pretendard, -apple-system, BlinkMacSystemFont, system-ui, Roboto, sans-serif; background:#fff; color:#0a0a0a; padding-bottom:4rem; }
a{text-decoration:none;color:inherit}

/* Bottom nav */
.mob-bottom-nav{position:fixed;bottom:0;left:0;right:0;z-index:9999;background:#fff;border-top:1px solid #e5e5e5;padding-bottom:env(safe-area-inset-bottom);display:none}
@media (max-width: 768px) { .mob-bottom-nav{display:block} }
.mob-bottom-nav-inner{display:flex;align-items:stretch}
.bnav-item{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:.6rem .25rem .5rem;gap:.2rem;text-decoration:none;color:#a3a3a3;font-size:.65rem;font-weight:600}
.bnav-item.active{color:#2858E0}
.bnav-quick{color:#0a0a0a !important}
.bnav-quick-bar{position:absolute;top:0;left:50%;transform:translateX(-50%);width:2rem;height:3px;background:#0a0a0a;border-radius:0 0 3px 3px}

/* Page fade in */

/* Shared utilities */
.whitespace-pre-line { white-space: pre-line; }
.td-bottom-btn { display: none; }
.limited-trim-info { display: block; }
.popular-arrows { display: flex; }

@media (max-width: 768px) {
  .popular-arrows { display: none !important; }

  /* 빠른출고 한정재고: 차 사진 위 세로 타이틀 */
  .limited-section {
    padding: 1.5rem 1rem !important;
  }
  .limited-head {
    margin-bottom: .9rem !important;
  }
  .limited-eyebrow { display: block !important; }
  .limited-title {
    font-size: 1.55rem !important;
    line-height: 1.15 !important;
    display: flex !important;
    gap: .4rem !important;
    flex-direction: row !important;
    align-items: baseline !important;
    margin: 0 !important;
  }
  .limited-title br { display: none !important; }
  .limited-title span { font-size: 1.55rem !important; }
  .limited-sub { display: none !important; }
  .limited-sub-mob { display: block !important; }
  .limited-trim-info { display: none !important; }
  .limited-name-row { display: none !important; }

  /* 타임딜 모바일 */
  .td-inner { display: grid !important; grid-template-columns: 1fr 1fr !important; gap: 1rem .5rem !important; padding: 1.25rem 1rem !important; }
  .td-inner > div:nth-child(3) { justify-self: end !important; }
  .td-img { justify-self: start !important; }
  .td-top-row { grid-column: 1/3 !important; }
  .td-inner > div:nth-child(2) { grid-column: 1/3 !important; }
  .td-inner > div:nth-child(3) { grid-column: 1 !important; align-self: center !important; }
  .td-img { grid-column: 2 !important; align-self: center !important; }
  .td-top-row { text-align: center !important; }
  .td-top-row h3 { font-size: 2rem !important; display: flex !important; justify-content: center !important; }
  .td-top-row p { display: none !important; }
  .td-inner > div:nth-child(2) { justify-content: stretch !important; gap: .5rem !important; width: 100% !important; }
  .td-inner > div:nth-child(2) > div { flex: 1 !important; padding: 1.25rem .5rem !important; text-align: center !important; }
  .td-inner > div:nth-child(2) > div p:first-child { font-size: 2.75rem !important; }
  .td-inner > div:nth-child(2) > div p:last-child { font-size: .9rem !important; }
  .td-bottom-btn { display: flex !important; width: 100% !important; align-items: center; justify-content: center; padding: .75rem; font-size: .875rem; font-weight: 700; background: #2858E0; color: #fff; border: none; cursor: pointer; margin-top: .5rem; }
  .td-orig-btn { display: none !important; }
  .td-inner > div:nth-child(3) { flex: 1 !important; }
  .td-img {
    display: flex !important; align-items: center !important; justify-content: center !important;
    height: 90px !important; overflow: visible !important; flex: 1 !important;
  }
  .td-img img, .td-img span {
    position: static !important; transform: none !important;
    height: 80px !important; animation: none !important; opacity: 1 !important;
  }
  .td-car-row { display: flex !important; flex-direction: row !important; align-items: center !important; gap: .5rem !important; }
  .zoom-card { width: 100% !important; min-width: unset !important; }

  /* 한정재고 모바일 리스트형 */
  .limited-grid {
    display: flex !important;
    flex-direction: column !important;
    gap: 0 !important;
    border-top: 1px solid #e5e5e5;
  }
  .limited-grid article {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    border: none !important;
    border-bottom: 1px solid #f0f0f0 !important;
    border-radius: 0 !important;
    transform: none !important;
    box-shadow: none !important;
    padding: .7rem 1rem !important;
    gap: .5rem !important;
  }
  .limited-grid article .limited-img-wrap {
    width: 110px !important;
    height: 75px !important;
    flex-shrink: 0 !important;
    align-self: center !important;
    background: transparent !important;
  }
  .limited-grid article .limited-img-wrap img {
    width: 100% !important; height: 100% !important;
    transform: none !important; object-fit: contain !important;
  }
  .limited-grid article > div.mob-card-info {
    flex: 1 !important;
    min-width: 0 !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-start !important;
    justify-content: center !important;
    padding: 0 0 0 .5rem !important;
    gap: .35rem !important;
    padding-right: 2.5rem !important;
  }
  .limited-grid article > div.mob-card-info .m-name {
    font-size: 1rem !important;
    font-weight: 800 !important;
    color: #0a0a0a !important;
    letter-spacing: -.01em;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    max-width: 100%;
  }
  .limited-grid article > div.mob-card-info .m-price {
    font-size: .95rem !important;
    font-weight: 800 !important;
    color: #0a0a0a !important;
    letter-spacing: -.01em;
  }
  .limited-grid article > .m-stock {
    position: absolute !important;
    top: 50% !important;
    right: 1rem !important;
    transform: translateY(-50%) !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: .3rem !important;
    background: #18181b !important;
    color: #fafafa !important;
    font-size: .7rem !important;
    font-weight: 800 !important;
    padding: .3rem .6rem !important;
    border-radius: 999px !important;
    line-height: 1 !important;
    border: none !important;
    letter-spacing: -.01em;
    box-shadow: 0 1px 3px rgba(0,0,0,.12);
  }
  .limited-grid article > .m-stock::before {
    content: "";
    width: .35rem !important;
    height: .35rem !important;
    border-radius: 50% !important;
    background: #fb7185 !important;
    flex-shrink: 0;
  }
}
.mob-card-info { display: none; }
.limited-grid article > .m-stock { display: none; }
.limited-bg-name {
  position: absolute; top: 21%; left: 50%;
  transform: translate(-50%, -50%);
  font-size: 2.2rem; font-weight: 900; letter-spacing: -.05em;
  color: rgba(0,0,0,.32); white-space: nowrap; pointer-events: none;
  text-shadow: 0 1px 2px rgba(255,255,255,.4); font-family: inherit;
  z-index: 1;
  transition: font-size .45s cubic-bezier(.2,.7,.2,1), color .3s ease, text-shadow .3s ease, z-index 0s linear .45s;
}
.zoom-card:hover .limited-bg-name {
  font-size: 2.6rem;
  color: rgba(0,0,0,.7);
  text-shadow: 0 1.5px 2px rgba(255,255,255,.6);
  z-index: 5;
  transition: font-size .45s cubic-bezier(.2,.7,.2,1), color .3s ease, text-shadow .3s ease, z-index 0s linear 0s;
}
@media (max-width: 768px) {
  .limited-grid article > div.mob-card-info { display: flex !important; }
  .limited-grid article > .m-stock { display: inline-flex !important; }
  .limited-grid article > div.desktop-bottom { display: none !important; }
  .limited-bg-name { display: none !important; }

  /* SubCarousel 모바일: 상하좌우 여백 + 트랙 라운드 */
  #subcar-section { padding: 0 1rem 1rem !important; background: #fff; }
  #subcar-track { border-radius: 16px !important; }
}

@keyframes carDriveIn {
  0%   { transform: translateY(-50%) translateX(260px); opacity: 0; }
  12%  { opacity: 1; }
  68%  { transform: translateY(-50%) translateX(-22px); }
  80%  { transform: translateY(-50%) translateX(9px); }
  90%  { transform: translateY(-50%) translateX(-4px); }
  100% { transform: translateY(-50%) translateX(0); }
}
.car-drive-in { animation: carDriveIn 0.9s ease-out forwards; }

.zoom-card { transition: transform 0.6s cubic-bezier(0.16,1,0.3,1), box-shadow 0.6s cubic-bezier(0.16,1,0.3,1); }
.zoom-card:hover { transform: translateY(-6px); z-index: 10; position: relative; box-shadow: 0 12px 36px rgba(0,0,0,.16); }
.zoom-card .zoom-img { transition: transform 0.6s cubic-bezier(0.16,1,0.3,1); transform: scale(1); object-fit: cover; }
.zoom-card:hover .zoom-img { transform: scale(0.82); object-fit: contain; background: #fff; }

@keyframes carRide {
  0%   { transform: translateY(-50%); }
  4%   { transform: translateY(-51.2%); }
  8%   { transform: translateY(-49.2%); }
  12%  { transform: translateY(-51.2%); }
  16%  { transform: translateY(-49.2%); }
  20%  { transform: translateY(-51.2%); }
  24%  { transform: translateY(-49.2%); }
  28%  { transform: translateY(-51%); }
  32%  { transform: translateY(-49.5%); }
  36%  { transform: translateY(-56%); }
  40%  { transform: translateY(-43%); }
  43%  { transform: translateY(-52%); }
  46%  { transform: translateY(-49%); }
  52%  { transform: translateY(-51.2%); }
  56%  { transform: translateY(-49.2%); }
  60%  { transform: translateY(-51.2%); }
  64%  { transform: translateY(-49.2%); }
  68%  { transform: translateY(-51%); }
  72%  { transform: translateY(-49.5%); }
  76%  { transform: translateY(-51%); }
  80%  { transform: translateY(-53.5%); }
  83%  { transform: translateY(-47%); }
  86%  { transform: translateY(-50.5%); }
  90%  { transform: translateY(-51%); }
  94%  { transform: translateY(-49.5%); }
  97%  { transform: translateY(-51%); }
  100% { transform: translateY(-50%); }
}
.car-ride { animation: carRide 3s linear infinite; }

@keyframes chargePulse {
  0%,100% { opacity:.3; transform:scale(1); }
  50%      { opacity:1;  transform:scale(1.15); }
}
@keyframes chargeBar {
  0%   { width:0%; }
  100% { width:100%; }
}
@keyframes evGlow {
  0%,100% { filter: drop-shadow(0 0 0px #4ade80); }
  50%      { filter: drop-shadow(0 0 18px #4ade80); }
}
.ev-banner:hover .ev-car { animation: evGlow 1.2s ease-in-out infinite; }
.ev-banner:hover .ev-bolt { animation: chargePulse .7s ease-in-out infinite; }
.ev-banner:hover .ev-bar  { animation: chargeBar 1.8s ease-out forwards; }

@keyframes streak {
  0%   { transform: translateX(-400%); opacity: 0; }
  8%   { opacity: 1; }
  88%  { opacity: 1; }
  100% { transform: translateX(120%); opacity: 0; }
}

/* Popular cars carousel */
.popular-scroll{display:flex;gap:1rem;overflow-x:auto;padding-bottom:.5rem;scrollbar-width:none}
.popular-scroll::-webkit-scrollbar{display:none}
.popular-card{flex-shrink:0;width:14rem;min-width:14rem;border:1px solid #f5f5f5;border-radius:.75rem;background:#fafafa;overflow:hidden;cursor:pointer;transition:transform .3s,box-shadow .3s;position:relative}
.popular-img-wrap{position:relative;background:#fff;padding:.75rem 1rem .5rem;overflow:hidden}
.popular-bignum{position:absolute;font-weight:900;user-select:none;line-height:1;font-size:11rem;letter-spacing:-.05em;right:-20%;top:50%;transform:translateY(-50%);white-space:nowrap;z-index:1;transition:all .4s}
.popular-bignum.top3{color:rgba(200,199,205,1)}
.popular-bignum.normal{color:rgba(200,199,205,1)}
@media (max-width:768px) {
  .popular-bignum{right:5% !important;font-size:13rem !important;z-index:1 !important}
  .popular-bignum.top3{color:rgba(200,199,205,.45) !important}
  .popular-bignum.normal{color:rgba(200,199,205,.4) !important}
}
@media (hover: hover) and (pointer: fine) {
  .popular-card:hover{transform:scale(1.1);box-shadow:0 12px 32px rgba(0,0,0,.18);z-index:10}
  .popular-card:hover .popular-bignum.top3{color:rgba(160,159,165,.75);z-index:20;right:-4%}
  .popular-card:hover .popular-bignum.normal{color:rgba(160,159,165,.7);z-index:20;right:-4%}
}
.popular-img{width:100%;height:8rem;object-fit:contain;position:relative;z-index:10}
.popular-info{padding:.5rem 1rem 1rem}
.popular-info p:first-child{font-size:.875rem;font-weight:900;color:#171717;line-height:1.25}
.popular-info p:last-child{margin-top:.25rem;font-size:1rem;font-weight:900;color:#0a0a0a}

/* Sub-carousel base */
.subcar-card-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;image-rendering:high-quality;image-rendering:-webkit-optimize-contrast;backface-visibility:hidden;-webkit-backface-visibility:hidden;transform:translateZ(0);-webkit-transform:translateZ(0)}
@media (max-width:768px) { .subcar-card-img { object-position: right center; } }
.subcar-slide { border-radius: 16px !important; overflow: hidden !important; -webkit-mask-image: -webkit-radial-gradient(white, black); box-shadow: 0 0 0 1px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.06); }
.subcar-slide > img.subcar-card-img { border-radius: 16px !important; }
.subcar-slide > div { border-radius: inherit; }
.subcar-card-overlay{display:none}

/* Desktop carousel: 1280px wide, 4:1 ratio */
/* Hero row: 캐러셀 + 우측 프로모션 카드 */
.hero-row { max-width:1232px; margin:1.5rem auto 0; padding:0; box-sizing:border-box; position:relative; height:440px; }
.hero-row > #subcar-section { width:calc(70% - 0.5rem); height:100%; }
.hero-promos { position:absolute; top:0; right:0; bottom:0; width:calc(30% - 0.5rem); display:flex; flex-direction:column; gap:1rem; height:100%; }
.promo-card { position:relative; display:block; padding:1.4rem 1.3rem; border-radius:14px; overflow:hidden; color:#fff; text-decoration:none; min-height:0; flex:1; transition:transform .15s ease, box-shadow .15s ease; }
.promo-card:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,.15); }
.promo-orange { background:linear-gradient(135deg,#2858E0 0%,#1E4FCC 100%); }
.promo-green { background:linear-gradient(135deg,#1F8A5B 0%,#176C46 100%); }
.promo-badge { display:inline-flex; align-items:center; background:rgba(0,0,0,.28); color:#fff; font-size:.7rem; font-weight:700; padding:.22rem .65rem; border-radius:999px; margin-bottom:.7rem; letter-spacing:-.01em; }
.promo-card h3 { font-size:1.1rem; font-weight:900; letter-spacing:-.02em; line-height:1.2; }
.promo-card p { font-size:1rem; font-weight:800; margin-top:.25rem; letter-spacing:-.01em; }
.promo-card img { position:absolute; bottom:-10px; right:-15px; width:70%; max-width:200px; opacity:.92; pointer-events:none; }
@media (max-width:768px) { .hero-row { padding:0; height:auto; margin-top:0; } .hero-row > #subcar-section { width:100%; height:auto; } .hero-promos { display:none; } }

/* 카테고리 버튼 행 */
.cat-row { max-width:1232px; margin:1.2rem auto 0; padding:0; box-sizing:border-box; display:grid; grid-template-columns:repeat(8,1fr); gap:.7rem; }
.cat-btn { display:flex; flex-direction:column; align-items:center; justify-content:center; gap:.55rem; background:transparent; border:none; border-radius:12px; padding:1rem .5rem; text-decoration:none; color:#0a0a0a; font-size:.85rem; font-weight:700; transition:all .15s; }
.cat-btn:hover { transform:translateY(-2px); }
.cat-btn img { width:89px; height:89px; object-fit:contain; pointer-events:none; }
@media (max-width:768px) { .cat-row { display:none; } }

/* 모바일 카테고리 (캐러셀 아래 4개) */
.mob-cat-row { display:none; }
@media (max-width:768px) {
  .mob-cat-row { display:flex; gap:.7rem; padding:0 1rem 1rem; background:#fff; overflow-x:auto; -webkit-overflow-scrolling:touch; scrollbar-width:none; }
  .mob-cat-row::-webkit-scrollbar { display:none; }
  .mob-cat-btn { flex:0 0 auto; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:.4rem; text-decoration:none; color:#0a0a0a; font-size:.74rem; font-weight:700; min-width:5.2rem; white-space:nowrap; }
  .mob-cat-btn img { width:68px; height:68px; object-fit:contain; pointer-events:none; }

  /* 이번 주 특가: 모바일 1컬럼 가로 카드 */
  #weekly-grid{grid-template-columns:1fr !important;gap:.6rem !important}
  #weekly-grid article{display:flex !important;flex-direction:row !important;align-items:center !important;border-radius:14px !important;overflow:hidden !important;padding:0 !important;position:relative;cursor:pointer}
  #weekly-grid article > div:first-child{order:2;width:48%;flex-shrink:0;padding:0}
  #weekly-grid article > div:first-child img{height:5.2rem !important;width:100% !important;object-fit:contain !important;padding:.25rem .35rem !important}
  #weekly-grid article > div:last-child{order:1;flex:1;padding:.85rem 1rem !important;min-width:0}
  #weekly-grid article > div:last-child .car-badge{margin-bottom:.45rem !important;padding:.18rem .55rem !important;font-size:.65rem !important;border-radius:4px}
  #weekly-grid article > div:last-child h3{font-size:.92rem !important;font-weight:800 !important;letter-spacing:-.01em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
  #weekly-grid article > div:last-child p:nth-of-type(1){font-size:1.05rem !important;font-weight:900 !important;margin-top:.15rem !important}
  #weekly-grid article > div:last-child p:nth-of-type(2){font-size:.7rem !important;margin-top:.15rem !important;color:#737373 !important}
  #weekly-grid article > div:last-child button{display:none !important}
  #weekly-grid article::after{content:"›";position:absolute;right:.7rem;top:50%;transform:translateY(-50%);color:#a3a3a3;font-size:1.4rem;line-height:1;font-weight:600;pointer-events:none}
}


@media (min-width: 769px) {
  #subcar-section {
    box-sizing: border-box;
  }
  #subcar-section #subcar-track,
  #subcar-section > #subcar-overlay {
    height: 100% !important;
    aspect-ratio: unset !important;
    max-height: none !important;
  }
}
</style>
</head>
<body>

<?php
$top_active    = '장기렌트';
$subnav_active = 'home';
require __DIR__ . '/../includes/rental_header.php';
?>
<main style="padding-bottom:4.5rem">

  <!-- ============== HERO ROW: 캐러셀 + 프로모션 카드 ============== -->
  <div class="hero-row">
    <!-- 좌측: 메인 캐러셀 -->
    <section class="relative bg-white" id="subcar-section">
      <div class="relative mx-auto overflow-hidden" id="subcar-track" style="height:500px"></div>
      <div id="subcar-overlay" class="pointer-events-none" style="position:absolute;top:0;left:0;right:0;height:500px;z-index:25">
        <div class="mx-auto px-6 h-full" style="position:relative;max-width:1280px">
          <div id="subcar-overlay-text" class="pointer-events-auto" style="position:absolute;top:50%;transform:translateY(-50%);left:4rem;right:4rem;z-index:10"></div>
          <div id="subcar-overlay-card" class="pointer-events-auto" style="position:absolute;bottom:2rem;right:1.5rem;width:320px;z-index:30;cursor:pointer"></div>
        </div>
      </div>
      <div id="subcar-progress-wrap" style="display:none"><div id="subcar-progress" style="display:none"></div></div>
    </section>

    <!-- 우측: 2개 프로모션 카드 -->
    <div class="hero-promos">
      <a href="variants.php?name=<?= rawurlencode('테슬라 모델Y') ?>" class="promo-card promo-orange">
        <span class="promo-badge">10대 한정</span>
        <h3>모델Y 롱레인지 출시</h3>
        <p>월 800,000원~</p>
        <img src="../cars/cdn_4667.png" alt="테슬라 모델Y" onerror="this.style.opacity='.2'">
      </a>
      <a href="ev.php" class="promo-card promo-green">
        <span class="promo-badge">⚡ 전기차</span>
        <h3>기아 EV6</h3>
        <p>월 480,000원~</p>
        <img src="../cars/307_4641.png" alt="EV6" onerror="this.style.opacity='.2'">
      </a>
    </div>
  </div>

  <!-- ============== 모바일 카테고리 (가로 슬라이드) ============== -->
  <section class="mob-cat-row md:hidden">
    <a href="direct.php" class="mob-cat-btn"><img src="sub/dt.png" alt=""><span>다이렉트</span></a>
    <a href="search.php?type=국산세단" class="mob-cat-btn"><img src="sub/k_sed.png" alt=""><span>국산 세단</span></a>
    <a href="search.php?type=국산SUV" class="mob-cat-btn"><img src="sub/k_suv.png" alt=""><span>국산 SUV</span></a>
    <a href="biz.php" class="mob-cat-btn"><img src="sub/busi_car.png" alt=""><span>사업자혜택</span></a>
    <a href="search.php?type=승합" class="mob-cat-btn"><img src="sub/k_van.png" alt=""><span>승합</span></a>
    <a href="search.php?type=전기차" class="mob-cat-btn"><img src="sub/k_elec.png" alt=""><span>전기차</span></a>
    <a href="search.php?type=하이브리드" class="mob-cat-btn"><img src="sub/k_hev.png" alt=""><span>하이브리드</span></a>
    <a href="search.php?tab=수입차" class="mob-cat-btn"><img src="sub/w_car.png" alt=""><span>수입차</span></a>
  </section>

  <!-- ============== 카테고리 버튼 ============== -->
  <section class="cat-row">
    <a href="direct.php" class="cat-btn"><img src="sub/dt.png" alt=""><span>다이렉트</span></a>
    <a href="search.php?type=국산세단" class="cat-btn"><img src="sub/k_sed.png" alt=""><span>국산 세단</span></a>
    <a href="search.php?type=국산SUV" class="cat-btn"><img src="sub/k_suv.png" alt=""><span>국산 SUV</span></a>
    <a href="biz.php" class="cat-btn"><img src="sub/busi_car.png" alt=""><span>사업자혜택</span></a>
    <a href="search.php?type=승합" class="cat-btn"><img src="sub/k_van.png" alt=""><span>승합</span></a>
    <a href="search.php?type=전기차" class="cat-btn"><img src="sub/k_elec.png" alt=""><span>전기차</span></a>
    <a href="search.php?type=하이브리드" class="cat-btn"><img src="sub/k_hev.png" alt=""><span>하이브리드</span></a>
    <a href="search.php?tab=수입차" class="cat-btn"><img src="sub/w_car.png" alt=""><span>수입차</span></a>
  </section>

  <!-- ============== 모바일 빠른액션 (캐러셀 아래) ============== -->
  <section class="md:hidden" style="padding:1rem 1rem 0;background:#fff">
    <style>
      .qa-card{position:relative;display:block;padding:1rem 1.1rem;min-height:5.5rem;border-radius:1rem;text-decoration:none;overflow:hidden;transition:transform .15s ease,box-shadow .15s ease;box-shadow:0 1px 3px rgba(0,0,0,.06),0 6px 18px rgba(0,0,0,.06)}
      .qa-card:active{transform:scale(.985)}
      .qa-quick{background:radial-gradient(120% 140% at 100% 100%,#3b0a0a 0%,#0a0a0a 60%);color:#fff}
      .qa-make{background:linear-gradient(135deg,#fdf6e9 0%,#f5ead0 100%);color:#0a0a0a;border:1px solid rgba(0,0,0,.05)}
      .qa-title{font-size:1.05rem;font-weight:900;letter-spacing:-.02em;line-height:1.2;position:relative;z-index:1}
      .qa-quick .qa-title{color:#fff}
      .qa-make .qa-title{color:#1a1a1a}
      .qa-sub{margin-top:.3rem;font-size:.72rem;font-weight:500;line-height:1.35;position:relative;z-index:1}
      .qa-quick .qa-sub{color:rgba(255,255,255,.65)}
      .qa-make .qa-sub{color:#737373}
      .qa-icon{position:absolute;right:-.2rem;bottom:-.4rem;width:3.6rem;height:3.6rem;display:flex;align-items:center;justify-content:center;opacity:.9;z-index:0;pointer-events:none}
      .qa-quick .qa-icon svg{color:#dc2626;filter:drop-shadow(0 0 14px rgba(239,68,68,.45))}
      .qa-make .qa-icon svg{color:#9c8156}
    </style>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.65rem">
      <a href="limited.php" class="qa-card qa-quick">
        <div class="qa-title">빠른출고</div>
        <div class="qa-sub">일주일 내 출고</div>
        <span class="qa-icon" aria-hidden="true">
          <svg width="44" height="44" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L4.5 13.5h6.2L9 22l8.5-12.6h-6L13 2z"/></svg>
        </span>
      </a>
      <a href="search.php?mode=make" class="qa-card qa-make">
        <div class="qa-title">내차만들기</div>
        <div class="qa-sub">트림 · 옵션 조합</div>
        <span class="qa-icon" aria-hidden="true">
          <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        </span>
      </a>
    </div>
  </section>

  <!-- ============== 빠른출고 한정재고 ============== -->
  <section class="limited-section mx-auto max-w-7xl px-6" style="padding-top:1.5rem;padding-bottom:4rem" id="limited-section">
    <div class="limited-head" style="margin-bottom:2rem">
      <h2 class="limited-title text-3xl font-black" style="letter-spacing:-.02em;color:#0E0E12"><span>빠른출고</span> <span class="font-light">·</span> <span class="font-light">한정재고</span></h2>
      <p class="limited-sub mt-1 text-sm font-semibold text-neutral-400">수량 한정 · 소진 시 종료</p>
      <p class="limited-sub-mob" style="display:none;font-size:.78rem;color:#737373;margin-top:.35rem">오늘 즉시 출고 가능한 차량만</p>
    </div>
    <div style="min-width:0">
      <div id="mob-cats-wrap" style="margin-bottom:1.2rem;display:none;overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:none;margin-left:-1rem;margin-right:-1rem">
        <div id="mob-cats" style="display:flex;gap:.5rem;padding:.1rem 1rem .35rem;width:max-content;flex-wrap:nowrap"></div>
      </div>
      <style>#mob-cats-wrap::-webkit-scrollbar{display:none}</style>
      <div class="limited-grid grid grid-cols-1 gap-5 md:grid-cols-5" id="limited-grid" style="min-width:0"></div>
    </div>
  </section>

  <!-- ============== 타임딜 카운트다운 ============== -->
  <section class="bg-neutral-900 py-12 text-white overflow-hidden" style="position:relative" id="timedeal">
    <div id="streaks"></div>
    <div class="td-inner mx-auto grid max-w-7xl grid-cols-1 items-center gap-10 px-6 md:grid-cols-[1fr_auto_1fr_320px]" style="position:relative;z-index:1">
      <div class="td-top-row">
        <h3 class="text-3xl font-black"><span aria-hidden="true" class="inline-flex items-center justify-center leading-none mr-2 text-yellow-400" style="width:18px;height:18px;font-size:18px">⚡</span>타임딜</h3>
        <p class="text-sm text-neutral-400">오늘 차량재고만 · 선착순 마감</p>
      </div>
      <div class="flex justify-center gap-5 text-center">
        <div class="bg-neutral-700 px-8 py-5"><p class="text-4xl font-black" id="cd-h">00</p><p class="text-xs text-neutral-400">시간</p></div>
        <div class="bg-neutral-700 px-8 py-5"><p class="text-4xl font-black" id="cd-m">00</p><p class="text-xs text-neutral-400">분</p></div>
        <div class="bg-neutral-700 px-8 py-5"><p class="text-4xl font-black" id="cd-s">00</p><p class="text-xs text-neutral-400">초</p></div>
      </div>
      <div>
        <p class="font-black">현대 캐스퍼 일렉트릭</p>
        <p class="text-sm text-neutral-400">월 380,000원~ · 선납금 0원</p>
        <button class="td-orig-btn mt-4 inline-flex items-center justify-center gap-2 px-7 py-3 text-sm font-bold transition bg-red-600 text-white" onmouseenter="this.style.boxShadow='inset 0 0 0 2px #fff'" onmouseleave="this.style.boxShadow='none'">지금 혜택 신청</button>
      </div>
      <div class="td-img relative h-48 overflow-visible">
        <img id="td-car" src="casper.png" alt="현대 캐스퍼 일렉트릭" class="absolute top-1/2 object-contain drop-shadow-2xl opacity-0" style="height:104px;right:0">
      </div>
    </div>
    <button class="td-bottom-btn" onmouseenter="this.style.boxShadow='inset 0 0 0 2px #fff'" onmouseleave="this.style.boxShadow='none'">지금 혜택 신청</button>
  </section>

  <!-- ============== 인기 차량 가로 캐러셀 ============== -->
  <section class="py-16 bg-white">
    <div class="mx-auto max-w-7xl px-6">
      <div class="mb-8 flex items-end justify-between">
        <div>
          <h2 class="text-3xl font-black" style="letter-spacing:-.02em">인기 차량</h2>
          <p class="mt-1 text-sm font-semibold text-neutral-400">이번 달 가장 많이 선택한 차량</p>
        </div>
        <div class="popular-arrows flex gap-2">
          <button onclick="popularScroll(-1)" class="h-9 w-9 flex items-center justify-center border border-neutral-200 hover:bg-neutral-900 hover:text-white transition" aria-label="이전">
            <span style="display:inline-block;width:9px;height:9px;border-left:2px solid currentColor;border-bottom:2px solid currentColor;transform:rotate(45deg) translate(2px,-2px)"></span>
          </button>
          <button onclick="popularScroll(1)" class="h-9 w-9 flex items-center justify-center border border-neutral-200 hover:bg-neutral-900 hover:text-white transition" aria-label="다음">
            <span style="display:inline-block;width:9px;height:9px;border-right:2px solid currentColor;border-top:2px solid currentColor;transform:rotate(45deg) translate(-2px,2px)"></span>
          </button>
        </div>
      </div>
      <div class="popular-scroll" id="popular-scroll"></div>
    </div>
  </section>

  <!-- ============== EV BANNER ============== -->
  <div class="ev-banner mx-auto max-w-7xl px-6 py-4 cursor-pointer" id="ev-banner" onclick="evGo()">
    <div class="relative overflow-hidden rounded-2xl flex items-center justify-between" style="background:linear-gradient(135deg, #0a1628 0%, #0d3b2e 50%, #0a2818 100%);min-height:160px;padding:2rem 3rem">
      <div style="position:absolute;right:320px;top:-60px;width:280px;height:280px;border-radius:50%;background:rgba(74,222,128,.06)"></div>
      <div style="position:absolute;right:200px;bottom:-80px;width:200px;height:200px;border-radius:50%;background:rgba(74,222,128,.04)"></div>
      <div style="position:relative;z-index:2">
        <div class="flex items-center gap-2 mb-2">
          <span class="ev-bolt text-2xl">⚡</span>
          <span style="font-size:.8rem;font-weight:700;color:#4ade80;letter-spacing:.12em;text-transform:uppercase">친환경 전기차</span>
        </div>
        <h2 style="font-size:2rem;font-weight:900;color:#fff;line-height:1.2;margin-bottom:.75rem">특가차량</h2>
        <p style="font-size:.875rem;color:rgba(255,255,255,.55);margin-bottom:1rem">지금 바로 전기차 렌트, 보조금 + 선납금 0원</p>
        <div style="width:180px;height:4px;background:rgba(255,255,255,.15);border-radius:999px;overflow:hidden">
          <div class="ev-bar" style="height:100%;background:linear-gradient(to right,#4ade80,#22d3ee);border-radius:999px;width:0"></div>
        </div>
        <p id="ev-charging" style="font-size:.7rem;color:transparent;margin-top:.4rem;letter-spacing:.12em;font-family:monospace;transition:color 0.15s">Charging.</p>
      </div>
      <div style="position:relative;z-index:2;flex-shrink:0">
        <img class="ev-car" src="../cars/cdn_4624.png" alt="아이오닉 5" style="height:170px;object-fit:contain;margin-right:-1rem;filter:drop-shadow(0 8px 24px rgba(0,0,0,.4))">
      </div>
    </div>
  </div>

  <!-- ============== 이번 주 국산차 특가 ============== -->
  <section class="mx-auto max-w-7xl px-6 py-16">
    <div class="mb-8 flex items-end justify-between gap-4">
      <div>
        <h2 class="text-3xl font-black tracking-tight text-neutral-950" style="letter-spacing:-.02em">국산차 특가</h2>
        <p class="mt-1 text-sm font-semibold text-neutral-400">선납금 0원, 월 납입금 패키지 포함</p>
      </div>
      <a href="special.php" class="text-sm font-bold text-neutral-700 hover:text-neutral-950" style="display:inline-flex;align-items:center;gap:.15rem">전체 <span style="font-size:1.1rem">›</span></a>
    </div>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4 md:gap-6" id="weekly-grid"></div>
  </section>

  <!-- ============== 상담 신청 ============== -->
  <section class="py-16" style="background:linear-gradient(135deg,#eff6ff 0%,#dbeafe 100%)">
    <div class="mx-auto max-w-7xl px-6">
      <h2 class="mb-3 text-4xl font-black whitespace-pre-line" style="color:#0a0a0a;letter-spacing:-.02em">장기렌트,
아직 <span style="color:#2858E0">고민중</span>이신가요?</h2>
      <p class="mb-8 font-semibold" style="color:#525252">전문 상담사가 최적 차량을 빠르게 안내해드립니다. 평일 09:00 - 18:00</p>
      <div class="grid grid-cols-1 gap-6 md:grid-cols-[1.3fr_.8fr] md:items-stretch">
        <form id="rentalBottomForm" class="grid gap-4 p-8 md:grid-cols-2 content-start" style="background:#fff;border-radius:16px;box-shadow:0 4px 20px rgba(37,99,235,.08)">
          <input name="name"  class="px-5 py-4 text-sm" style="border:1px solid #e5e7eb;border-radius:10px;color:#0a0a0a;outline:none" placeholder="성함을 입력해주세요">
          <input name="phone" class="px-5 py-4 text-sm" style="border:1px solid #e5e7eb;border-radius:10px;color:#0a0a0a;outline:none" placeholder="휴대폰 번호를 입력해주세요">
          <input name="car"   class="px-5 py-4 text-sm md:col-span-2" style="border:1px solid #e5e7eb;border-radius:10px;color:#0a0a0a;outline:none" placeholder="관심 차량을 선택해주세요">
          <button type="submit" class="py-4 text-sm font-black text-white md:col-span-2" style="background:linear-gradient(135deg,#3b82f6 0%,#2858E0 100%);border:none;border-radius:10px;cursor:pointer;box-shadow:0 4px 14px rgba(37,99,235,.25);transition:all .2s" onmouseover="this.style.boxShadow='0 6px 20px rgba(37,99,235,.4)';this.style.transform='translateY(-1px)'" onmouseout="this.style.boxShadow='0 4px 14px rgba(37,99,235,.25)';this.style.transform='translateY(0)'">무료 상담 신청하기</button>
          <div id="rentalBottomMsg" class="md:col-span-2 text-sm font-bold" style="display:none"></div>
        </form>
        <div class="p-10 flex flex-col justify-center" style="background:#fff;border-radius:16px;box-shadow:0 4px 20px rgba(37,99,235,.08)">
          <p class="mb-5 text-lg font-bold" style="color:#2858E0">전화 상담</p>
          <p class="mb-2 text-5xl font-black" style="color:#0a0a0a;letter-spacing:-.02em">1661-3583</p>
          <p class="mb-8 text-sm" style="color:#737373">평일 09:00 ~ 18:00 (주말·공휴일 휴무)</p>
          <button class="px-10 py-4 text-sm font-bold" style="background:#FEE500;color:#191919;border:none;border-radius:10px;cursor:pointer;transition:background .15s" onmouseover="this.style.background='#f0d800'" onmouseout="this.style.background='#FEE500'"><span aria-hidden="true" class="inline-flex items-center justify-center leading-none mr-2" style="width:16px;height:16px;font-size:16px">●</span>카카오 상담</button>
        </div>
      </div>
    </div>
  </section>

</main>

<!-- ============== FOOTER + BOTTOM NAV ============== -->
<?php
$bnav_active = 'home';
require __DIR__ . '/../includes/rental_footer.php';
?>

<!-- ============== FLOATING 간편상담 (모바일 전용) ============== -->
<style>
.fab-consult{display:none;position:fixed;right:1rem;bottom:calc(4.6rem + env(safe-area-inset-bottom));z-index:9998;background:#0a0a0a;color:#fff;font-family:inherit;width:3.4rem;height:3.4rem;padding:0;border:none;border-radius:50%;cursor:pointer;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(0,0,0,.28),0 1px 4px rgba(0,0,0,.18);animation:fabPop .25s ease}
.fab-consult svg{width:1.5rem;height:1.5rem;stroke:#fff}
.fab-consult::after{content:"";position:absolute;top:.3rem;right:.3rem;width:.6rem;height:.6rem;border-radius:50%;background:#22c55e;border:2px solid #0a0a0a;animation:fabPulse 1.4s ease-in-out infinite}
.fab-consult:active{transform:scale(.94)}
@keyframes fabPop{from{transform:scale(.8);opacity:0}to{transform:scale(1);opacity:1}}
@keyframes fabPulse{
  0%{box-shadow:0 0 0 0 rgba(34,197,94,.6),0 0 6px rgba(34,197,94,.7)}
  70%{box-shadow:0 0 0 8px rgba(34,197,94,0),0 0 6px rgba(34,197,94,.4)}
  100%{box-shadow:0 0 0 0 rgba(34,197,94,0),0 0 6px rgba(34,197,94,.7)}
}
@media(max-width:768px){.fab-consult{display:inline-flex}}

/* 데스크탑 빠른상담 카드 (우측 고정) */
.quick-consult-card{display:none;position:fixed;right:1.5rem;top:50%;transform:translateY(-50%);z-index:9998;width:18rem;background:#fff;border-radius:1rem;box-shadow:0 10px 32px rgba(0,0,0,.18),0 1px 4px rgba(0,0,0,.08);font-family:inherit;overflow:hidden}
@media (min-width: 769px){
  .quick-consult-card{display:block;animation:qcPopIn .28s cubic-bezier(.2,.9,.3,1.2)}
}
@keyframes qcPopIn{
  from{transform:translateY(-50%) scale(.92);opacity:0}
  to  {transform:translateY(-50%) scale(1);   opacity:1}
}
.qc-header{padding:1rem 1.1rem;background:#0a0a0a;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:.75rem;transition:background .15s;user-select:none}
.qc-header:hover{background:#1f1f1f}
.qc-header-title{font-size:1rem;font-weight:900;letter-spacing:-.02em;line-height:1.2;display:flex;align-items:center;gap:.45rem}
.qc-header-dot{width:.55rem;height:.55rem;border-radius:50%;background:#22c55e;box-shadow:0 0 0 0 rgba(34,197,94,.6);animation:qcPulse 1.6s ease-in-out infinite}
@keyframes qcPulse{
  0%{box-shadow:0 0 0 0 rgba(34,197,94,.55)}
  70%{box-shadow:0 0 0 7px rgba(34,197,94,0)}
  100%{box-shadow:0 0 0 0 rgba(34,197,94,0)}
}
.qc-header-sub{margin-top:.25rem;font-size:.72rem;color:rgba(255,255,255,.62);font-weight:500;letter-spacing:-.01em}
.qc-chevron{width:1.1rem;height:1.1rem;flex-shrink:0;transition:transform .28s ease}
.quick-consult-card.open .qc-chevron{transform:rotate(180deg)}
.qc-body{max-height:0;overflow:hidden;transition:max-height .32s ease}
.quick-consult-card.open .qc-body{max-height:520px}
.qc-form{padding:1rem 1.1rem 1.1rem;display:flex;flex-direction:column;gap:.6rem}
.qc-field{display:flex;flex-direction:column;gap:.3rem}
.qc-field label{font-size:.72rem;font-weight:700;color:#525252;letter-spacing:-.01em}
.qc-field label .req{color:#dc2626;margin-left:.15rem}
.qc-field input{width:100%;padding:.7rem .8rem;font-size:.92rem;border:1px solid #e5e7eb;border-radius:.55rem;font-family:inherit;color:#0a0a0a;outline:none;transition:border-color .15s;box-sizing:border-box}
.qc-field input:focus{border-color:#0a0a0a}
.qc-field input::placeholder{color:#a3a3a3}
.qc-cta{margin-top:.4rem;padding:.85rem;font-size:.95rem;font-weight:800;background:#2858E0;color:#fff;border:none;border-radius:.6rem;cursor:pointer;font-family:inherit;letter-spacing:-.01em;transition:background .15s}
.qc-cta:hover{background:#1E4FCC}
.qc-cta:disabled{opacity:.6;cursor:wait}

/* 간편상담 모달 */
.consult-modal{position:fixed;inset:0;z-index:10000;display:none;align-items:center;justify-content:center;padding:1.25rem;animation:cmFadeIn .18s ease}
.consult-modal.open{display:flex}
.consult-modal-bd{position:absolute;inset:0;background:rgba(10,10,10,.55);backdrop-filter:blur(2px)}
.consult-modal-card{position:relative;width:100%;max-width:380px;background:#fff;border-radius:1.1rem;overflow:hidden;box-shadow:0 20px 50px rgba(0,0,0,.25);animation:cmPopIn .22s cubic-bezier(.2,.9,.3,1.2)}
.consult-modal-head{padding:1.3rem 1.4rem .35rem;text-align:left}
.consult-modal-title{font-size:1.08rem;font-weight:900;color:#0a0a0a;letter-spacing:-.02em;margin:0 0 .25rem}
.consult-modal-sub{font-size:.8rem;color:#737373;line-height:1.45;margin:0}
.consult-modal-body{padding:.9rem 1.4rem 0;display:flex;flex-direction:column;gap:.65rem}
.consult-field{display:flex;flex-direction:column;gap:.3rem}
.consult-field label{font-size:.74rem;font-weight:700;color:#525252;letter-spacing:-.01em}
.consult-field label .req{color:#dc2626;margin-left:.2rem}
.consult-field input{width:100%;padding:.7rem .8rem;font-size:.92rem;border:1px solid #e5e7eb;border-radius:.55rem;font-family:inherit;color:#0a0a0a;outline:none;transition:border-color .15s}
.consult-field input:focus{border-color:#0a0a0a}
.consult-field input::placeholder{color:#a3a3a3}
.consult-consent{margin-top:.4rem;padding:.7rem .8rem;background:#f9fafb;border:1px solid #f0f0f0;border-radius:.6rem;display:flex;flex-direction:column;gap:.4rem}
.consent-row{display:flex;align-items:center;gap:.45rem;font-size:.78rem;color:#0a0a0a;cursor:pointer;line-height:1.3;letter-spacing:-.01em}
.consent-row input[type="checkbox"]{appearance:none;-webkit-appearance:none;width:1.05rem;height:1.05rem;border:1.5px solid #d4d4d8;border-radius:.25rem;background:#fff;cursor:pointer;flex-shrink:0;display:inline-flex;align-items:center;justify-content:center;position:relative;transition:all .15s}
.consent-row input[type="checkbox"]:checked{background:#22c55e;border-color:#22c55e}
.consent-row input[type="checkbox"]:checked::after{content:"";width:.32rem;height:.62rem;border:solid #fff;border-width:0 2px 2px 0;transform:rotate(45deg) translate(-1px,-1px)}
.consent-text{flex:1;color:#171717;font-weight:500}
.consent-tag{color:#737373;font-weight:500;margin-right:.15rem}
.consent-tag-req{color:#dc2626}
.consent-link{flex-shrink:0;font-size:.72rem;color:#a3a3a3;text-decoration:underline;font-weight:500}
.consent-link:hover{color:#525252}
.consent-desc{font-size:.7rem;color:#737373;line-height:1.45;margin:0;padding-left:1.5rem}

.consult-modal-footer{padding:1rem 1.4rem 1.2rem;display:flex;gap:.5rem}
.consult-btn{flex:1;padding:.85rem;font-size:.95rem;font-weight:800;border:none;border-radius:.7rem;cursor:pointer;font-family:inherit;letter-spacing:-.01em;transition:background .15s}
.consult-btn-cancel{background:#f3f4f6;color:#525252}
.consult-btn-cancel:hover{background:#e5e7eb}
.consult-btn-submit{background:#0a0a0a;color:#fff}
.consult-btn-submit:hover{background:#262626}
@keyframes cmFadeIn{from{opacity:0}to{opacity:1}}
@keyframes cmPopIn{from{transform:scale(.92);opacity:0}to{transform:scale(1);opacity:1}}
</style>
<button class="fab-consult" onclick="document.getElementById('consultModal').classList.add('open');document.body.style.overflow='hidden'" aria-label="간편신청">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
</button>

<!-- ============== 데스크탑 빠른상담 카드 ============== -->
<div class="quick-consult-card" id="quickConsult" aria-live="polite">
  <div class="qc-header" onclick="toggleQuickConsult()" role="button" tabindex="0" aria-expanded="false" aria-controls="qcBody">
    <div>
      <div class="qc-header-title"><span class="qc-header-dot"></span>빠른 상담 신청</div>
      <div class="qc-header-sub">이름 · 전화번호만 남기면 끝</div>
    </div>
    <svg class="qc-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
  </div>
  <div class="qc-body" id="qcBody">
    <div class="qc-form">
      <div class="qc-field">
        <label>이름<span class="req">*</span></label>
        <input id="qcName" type="text" placeholder="홍길동" autocomplete="name">
      </div>
      <div class="qc-field">
        <label>전화번호<span class="req">*</span></label>
        <input id="qcPhone" type="tel" placeholder="010-1234-5678" autocomplete="tel" inputmode="tel">
      </div>
      <div class="qc-field">
        <label>차종</label>
        <input id="qcCar" type="text" placeholder="예: 현대 그랜저">
      </div>
      <button class="qc-cta" onclick="submitQuickConsult()">상담신청하기</button>
    </div>
  </div>
</div>

<div class="consult-modal" id="consultModal" role="dialog" aria-modal="true" aria-labelledby="consultModalTitle">
  <div class="consult-modal-bd" onclick="closeConsultModal()"></div>
  <div class="consult-modal-card">
    <div class="consult-modal-head">
      <h3 class="consult-modal-title" id="consultModalTitle">간편 상담 신청</h3>
      <p class="consult-modal-sub">간단한 정보만 남기면 담당자가 곧 연락드립니다.</p>
    </div>
    <div class="consult-modal-body">
      <div class="consult-field">
        <label>이름<span class="req">*</span></label>
        <input id="ctName" type="text" placeholder="홍길동" autocomplete="name">
      </div>
      <div class="consult-field">
        <label>연락처<span class="req">*</span></label>
        <input id="ctPhone" type="tel" placeholder="010-1234-5678" autocomplete="tel" inputmode="tel">
      </div>
      <div class="consult-field">
        <label>관심 차량</label>
        <input id="ctCar" type="text" placeholder="선택 입력 (예: 현대 그랜저)">
      </div>
      <div class="consult-consent">
        <label class="consent-row">
          <input type="checkbox" id="ctConsent1" checked>
          <span class="consent-text"><span class="consent-tag consent-tag-req">[필수]</span> 개인정보 수집·이용·제공 동의</span>
          <a href="#" class="consent-link" onclick="event.preventDefault();event.stopPropagation();alert('개인정보 수집·이용·제공 동의 전문\\n\\n수집 항목: 이름, 연락처, 관심차량\\n이용 목적: 상담 및 견적 안내\\n보유 기간: 상담 종료 후 1년\\n동의를 거부할 권리가 있으며, 거부 시 상담 서비스 제공이 제한됩니다.')">보기</a>
        </label>
        <label class="consent-row">
          <input type="checkbox" id="ctConsent2" checked>
          <span class="consent-text"><span class="consent-tag">[선택]</span> 마케팅 정보 수신 동의</span>
          <a href="#" class="consent-link" onclick="event.preventDefault();event.stopPropagation();alert('마케팅 정보 수신 동의 전문\\n\\nSMS, 이메일, 카카오톡 채널을 통한 광고성 정보 수신에 동의합니다.\\n수신 동의는 언제든지 철회할 수 있습니다.')">보기</a>
        </label>
        <p class="consent-desc">SMS, 이메일, 카카오톡 채널을 통한 광고성 정보 수신에 동의합니다.</p>
      </div>
    </div>
    <div class="consult-modal-footer">
      <button class="consult-btn consult-btn-cancel" onclick="closeConsultModal()">취소</button>
      <button class="consult-btn consult-btn-submit" onclick="submitConsult()">상담신청하기</button>
    </div>
  </div>
</div>
<script>
function closeConsultModal(){
  document.getElementById('consultModal').classList.remove('open');
  document.body.style.overflow='';
}
function submitConsult(){
  const name = document.getElementById('ctName').value.trim();
  const phone = document.getElementById('ctPhone').value.trim();
  const car = document.getElementById('ctCar').value.trim();
  const consent2 = document.getElementById('ctConsent2').checked;
  if(!name){ document.getElementById('ctName').focus(); alert('이름을 입력해주세요.'); return; }
  if(!phone){ document.getElementById('ctPhone').focus(); alert('연락처를 입력해주세요.'); return; }

  const btn = document.querySelector('.consult-btn-submit');
  if (btn) { btn.disabled = true; btn.textContent = '전송 중...'; }

  fetch('../api/inquiry.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({
      source: 'rental_fab',
      name: name, phone: phone, car: car,
      consent_marketing: consent2
    })
  })
  .then(r => r.json())
  .then(data => {
    if (data.ok) {
      alert('상담 신청이 접수되었습니다 (접수번호 #' + data.id + ').\n담당자가 곧 연락드리겠습니다.');
      document.getElementById('ctName').value='';
      document.getElementById('ctPhone').value='';
      document.getElementById('ctCar').value='';
      closeConsultModal();
    } else {
      const errs = data.errors || {};
      const msg = Object.values(errs).join('\n') || '접수에 실패했습니다.';
      alert(msg);
    }
  })
  .catch(() => alert('네트워크 오류로 접수에 실패했습니다.'))
  .finally(() => { if (btn) { btn.disabled = false; btn.textContent = '상담신청하기'; } });
}

function toggleQuickConsult(){
  const card = document.getElementById('quickConsult');
  if (!card) return;
  const open = card.classList.toggle('open');
  const header = card.querySelector('.qc-header');
  if (header) header.setAttribute('aria-expanded', open ? 'true' : 'false');
  if (open) setTimeout(() => { const el = document.getElementById('qcName'); if (el) el.focus(); }, 200);
}
function submitQuickConsult(){
  const name  = document.getElementById('qcName').value.trim();
  const phone = document.getElementById('qcPhone').value.trim();
  const car   = document.getElementById('qcCar').value.trim();
  if(!name){ document.getElementById('qcName').focus(); alert('이름을 입력해주세요.'); return; }
  if(!phone){ document.getElementById('qcPhone').focus(); alert('전화번호를 입력해주세요.'); return; }

  const btn = document.querySelector('.qc-cta');
  if (btn) { btn.disabled = true; btn.textContent = '전송 중...'; }

  fetch('../api/inquiry.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({
      source: 'rental_quick',
      name: name, phone: phone, car: car
    })
  })
  .then(r => r.json())
  .then(data => {
    if (data.ok) {
      alert('상담 신청이 접수되었습니다 (접수번호 #' + data.id + ').\n담당자가 곧 연락드리겠습니다.');
      document.getElementById('qcName').value='';
      document.getElementById('qcPhone').value='';
      document.getElementById('qcCar').value='';
      const card = document.getElementById('quickConsult');
      if (card) { card.classList.remove('open'); const h = card.querySelector('.qc-header'); if (h) h.setAttribute('aria-expanded','false'); }
    } else {
      const errs = data.errors || {};
      const msg = Object.values(errs).join('\n') || '접수에 실패했습니다.';
      alert(msg);
    }
  })
  .catch(() => alert('네트워크 오류로 접수에 실패했습니다.'))
  .finally(() => { if (btn) { btn.disabled = false; btn.textContent = '상담신청하기'; } });
}

// 하단 "장기렌트, 아직 고민중이신가요?" 폼
$(function () {
  $('#rentalBottomForm').on('submit', function (e) {
    e.preventDefault();
    const $f = $(this);
    const $msg = $('#rentalBottomMsg');
    const data = {
      source: 'rental_bottom',
      name:  $.trim($f.find('[name=name]').val()),
      phone: $.trim($f.find('[name=phone]').val()),
      car:   $.trim($f.find('[name=car]').val())
    };
    if (!data.name || !data.phone) {
      $msg.show().css('color', '#fca5a5').text('성함과 휴대폰 번호를 입력해주세요.');
      return;
    }
    const $btn = $f.find('button[type=submit]');
    $btn.prop('disabled', true).text('전송 중...');
    fetch('../api/inquiry.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(res => {
      if (res.ok) {
        $msg.show().css('color', '#86efac').text('접수되었습니다 (#' + res.id + '). 곧 연락드리겠습니다.');
        $f.find('input').val('');
      } else {
        const errs = Object.values(res.errors || {}).join(' ') || '접수 실패';
        $msg.show().css('color', '#fca5a5').text(errs);
      }
    })
    .catch(() => $msg.show().css('color', '#fca5a5').text('네트워크 오류'))
    .finally(() => $btn.prop('disabled', false).text('무료 상담 신청하기'));
  });
});
</script>

<!-- (mob-bottom-nav rendered above via rental_footer.php) -->

<?php require_once __DIR__ . '/../includes/rental_data.php'; ?>
<script>
/* ===================== DATA (PHP-injected) ===================== */
const CARS           = <?= json_js(get_rental_cars()) ?>;
const MOB_CARS       = <?= json_js(get_mob_cars()) ?>;
const WEEKLY_CARS    = <?= json_js(get_weekly_cars()) ?>;
const POPULAR        = <?= json_js(get_popular_rental()) ?>;
const RENTAL_BANNERS = <?= json_js(get_rental_banners()) ?>;
const MOB_CATS       = <?= json_js(MOB_CATS) ?>;
</script>
<script>

/* UTILS */
function wrapIndex(current, delta, length) {
  if (!length) return 0;
  return ((current + delta) % length + length) % length;
}
function isMobile() { return window.innerWidth <= 768; }

/* ===================== COUNTDOWN ===================== */
function updateCountdown() {
  const now = new Date();
  const end = new Date();
  end.setHours(23, 59, 59, 999);
  const diff = Math.max(0, end - now);
  const h = String(Math.floor(diff / 3600000)).padStart(2, '0');
  const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
  const s = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
  const eh = document.getElementById('cd-h'), em = document.getElementById('cd-m'), es = document.getElementById('cd-s');
  if (eh) eh.textContent = h;
  if (em) em.textContent = m;
  if (es) es.textContent = s;
}
setInterval(updateCountdown, 1000);
updateCountdown();

/* ===================== STREAKS ===================== */
(function renderStreaks() {
  const wrap = document.getElementById('streaks');
  if (!wrap) return;
  const streaks = [
    {top:'18%', w:180, h:2,   op:0.55, dur:'1.4s', delay:'0s'},
    {top:'28%', w:120, h:1.5, op:0.35, dur:'1.1s', delay:'0.5s'},
    {top:'40%', w:260, h:2.5, op:0.7,  dur:'1.8s', delay:'0.2s'},
    {top:'52%', w:90,  h:1,   op:0.3,  dur:'0.9s', delay:'0.8s'},
    {top:'62%', w:200, h:2,   op:0.5,  dur:'1.5s', delay:'0.35s'},
    {top:'72%', w:140, h:1.5, op:0.45, dur:'1.2s', delay:'0.9s'},
    {top:'33%', w:80,  h:1,   op:0.25, dur:'0.8s', delay:'1.2s'},
    {top:'58%', w:320, h:3,   op:0.6,  dur:'2.0s', delay:'0.6s'},
  ];
  wrap.innerHTML = streaks.map(s => `<div style="position:absolute;top:${s.top};right:0;width:${s.w}px;height:${s.h}px;background:linear-gradient(to left, transparent, rgba(255,255,220,${s.op}) 40%, rgba(255,255,255,${s.op*0.6}) 70%, transparent);animation: streak ${s.dur} linear ${s.delay} infinite;pointer-events:none;z-index:0"></div>`).join('');
})();

/* ===================== CAR DRIVE IN ===================== */
(function carDriveIn() {
  const img = document.getElementById('td-car');
  if (!img) return;
  const obs = new IntersectionObserver(([e]) => {
    if (e.isIntersecting) {
      obs.disconnect();
      setTimeout(() => {
        img.classList.remove('opacity-0');
        img.classList.add('car-drive-in');
      }, 500);
      setTimeout(() => {
        img.classList.remove('car-drive-in');
        img.classList.add('car-ride');
      }, 1400);
    }
  }, { threshold: 0.4 });
  obs.observe(img);
})();

/* ===================== 빠른출고 한정재고 ===================== */
let mobFilter = "인기차종";

const LIMITED_CARD_BG = {
  '아반떼': '#1e3a5f',
  '그랜저': '#1a1a1a',
  'K8': '#2c2c2c',
  '카니발': '#3d3a2e',
  '싼타페': '#3a2820',
  '스포티지': '#595959',
  '투싼': '#4a4a4a',
  '팰리세이드': '#1f4030',
  '캐스퍼': '#a83a3a',
  '레이': '#b89968',
  '아이오닉5': '#3a4a60',
  '아이오닉6': '#3a4a60',
  'EV6': '#4a3a60'
};
function getLimitedBg(name) {
  const s = name.replace(/^(현대|기아|제네시스|르노|쉐보레)\s+/, '');
  let base = '#2a2a2a';
  for (const k in LIMITED_CARD_BG) {
    if (s.indexOf(k) !== -1) { base = LIMITED_CARD_BG[k]; break; }
  }
  // 쇼룸 벽-바닥 효과: 동일 베이스 컬러 + 밝기 차이로 수평선 구분
  return `linear-gradient(180deg, rgba(255,255,255,.38) 0%, rgba(255,255,255,.38) 58%, rgba(0,0,0,.22) 58%, rgba(0,0,0,.22) 100%), ${base}`;
}
function getLimitedFloor(name) {
  const s = name.replace(/^(현대|기아|제네시스|르노|쉐보레)\s+/, '');
  let base = '#2a2a2a';
  for (const k in LIMITED_CARD_BG) {
    if (s.indexOf(k) !== -1) { base = LIMITED_CARD_BG[k]; break; }
  }
  return `linear-gradient(rgba(0,0,0,.22), rgba(0,0,0,.22)), ${base}`;
}

// 색상명 → 실제 컬러 매핑 (베이지/브라운 우선순위 → 카키/그린 순)
const COLOR_CHIP_MAP = [
  { k: ['화이트','white'],          bg:'#ffffff', tx:'#0a0a0a', bd:'#d4d4d4' },
  { k: ['블랙펄'],                  bg:'#0a0a0a', tx:'#fff',    bd:'transparent' },
  { k: ['블랙','black'],            bg:'#1a1a1a', tx:'#fff',    bd:'transparent' },
  { k: ['베이지','beige'],          bg:'#d4c4a8', tx:'#3a2a14', bd:'transparent' },
  { k: ['테라','브라운','brown'],   bg:'#6b4423', tx:'#fff',    bd:'transparent' },
  { k: ['카키 그린','카키'],         bg:'#5a6e3a', tx:'#fff',    bd:'transparent' },
  { k: ['갤럭시아'],                bg:'#1e3a5f', tx:'#fff',    bd:'transparent' },
  { k: ['문라이트'],                bg:'#3a5070', tx:'#fff',    bd:'transparent' },
  { k: ['오로라'],                  bg:'#1a1f2e', tx:'#fff',    bd:'transparent' },
  { k: ['블루','blue'],             bg:'#2858E0', tx:'#fff',    bd:'transparent' },
  { k: ['실버리 라임','라임'],       bg:'#b8c08c', tx:'#2d3a1a', bd:'transparent' },
  { k: ['그라파이트'],              bg:'#3a3a3a', tx:'#fff',    bd:'transparent' },
  { k: ['미스틱'],                  bg:'#6b7280', tx:'#fff',    bd:'transparent' },
  { k: ['실버','silver'],           bg:'#c0c4c8', tx:'#0a0a0a', bd:'transparent' },
  { k: ['그레이','gray','그레이펄'], bg:'#6b7280', tx:'#fff',    bd:'transparent' },
  { k: ['그린','green'],            bg:'#16a34a', tx:'#fff',    bd:'transparent' },
  { k: ['레드','red'],              bg:'#dc2626', tx:'#fff',    bd:'transparent' },
];
function getColorChip(name) {
  for (const m of COLOR_CHIP_MAP) {
    if (m.k.some(kw => name.indexOf(kw) !== -1)) return m;
  }
  return { bg:'#f5f5f5', tx:'#525252', bd:'#e5e5e5' };
}
function renderLimitedCards() {
  const grid = document.getElementById('limited-grid');
  if (!grid) return;
  const mob = isMobile();
  const list = mob ? MOB_CARS.filter(c => c.cat.indexOf(mobFilter) !== -1) : CARS;
  let html = list.map(car => `
    <article class="border border-neutral-200 bg-white overflow-hidden zoom-card" style="cursor:pointer;position:relative;border-radius:14px" onclick="location.href='variants.php?name=${encodeURIComponent(car.name)}'">
      <div class="limited-img-wrap" style="position:relative;background:${getLimitedBg(car.name)};height:200px;overflow:hidden">
        <span class="limited-bg-name">${car.name}</span>
        <img src="${car.image}" alt="${car.name}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:contain;z-index:2" onerror="this.style.opacity='.2'">
      </div>
      ${car.colors ? `
      <div class="limited-trim-info px-4 pt-1 pb-1">
        ${car.tagline ? `<div style="display:inline-flex;align-items:center;gap:.3rem;background:#0E0E12;color:#F5B042;font-size:.65rem;font-weight:800;padding:.18rem .5rem;border-radius:4px;margin-bottom:.4rem;letter-spacing:-.01em">${car.tagline}</div>` : ''}
        <p style="font-size:.75rem;color:#0a0a0a;font-weight:700;margin-bottom:.4rem">${car.trimRange}</p>
        <div style="display:flex;flex-wrap:wrap;gap:.25rem;margin-bottom:.4rem;min-height:4.6rem;align-content:flex-start;overflow:hidden">
          ${car.colors.map(c => { const cc = getColorChip(c); const lt = cc.bg === '#ffffff' ? 'border:1px solid #d4d4d4;' : ''; return `<span style="font-size:.65rem;color:#404040;display:inline-flex;align-items:center;gap:.3rem;white-space:nowrap;padding:.1rem .15rem"><span style="display:inline-block;width:.6rem;height:.6rem;border-radius:50%;background:${cc.bg};${lt}flex-shrink:0"></span>${c}</span>`; }).join('')}
        </div>
        <p style="font-size:.85rem;font-weight:700;color:#0a0a0a">${car.carPrice}</p>
      </div>` : ''}
      <div class="p-4 desktop-bottom" style="display:flex;justify-content:space-between;align-items:center">
        <p class="font-black text-neutral-950 text-base">${car.price30}</p>
        <span class="bg-neutral-900 text-white text-sm font-black px-3 py-1">${car.stock}대</span>
      </div>
      <div class="mob-card-info">
        <p class="m-name">${car.name}</p>
        <p class="m-price">${(car.price30||'').replace(/원\s*$/,'원~')}</p>
      </div>
      <span class="m-stock">${car.stock}대</span>
    </article>
  `).join('');
  html += `<a href="limited.php" style="grid-column:1 / -1;display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.95rem;border:1px solid #0a0a0a;background:#0a0a0a;text-decoration:none;font-weight:700;font-size:.875rem;color:#fff;transition:background .15s;border-radius:12px" onmouseenter="this.style.background='#262626'" onmouseleave="this.style.background='#0a0a0a'">빠른출고 차량 전체보기 →</a>`;
  grid.innerHTML = html;
}

function renderMobCats() {
  const wrap = document.getElementById('mob-cats-wrap');
  const inner = document.getElementById('mob-cats');
  if (!wrap || !inner) return;
  const mob = isMobile();
  wrap.style.display = mob ? 'block' : 'none';
  inner.innerHTML = MOB_CATS.map(cat => {
    const active = mobFilter === cat;
    return `<button onclick="setMobFilter('${cat.replace(/'/g, "\\'")}')" style="flex-shrink:0;padding:.45rem 1rem;font-size:.8rem;font-weight:700;border:1.5px solid;border-radius:999px;border-color:${active?'#0a0a0a':'#e5e5e5'};background:${active?'#0a0a0a':'#fff'};color:${active?'#fff':'#737373'};cursor:pointer;white-space:nowrap;transition:all .15s;font-family:inherit">${cat}</button>`;
  }).join('');
}

function setMobFilter(cat) {
  mobFilter = cat;
  renderMobCats();
  renderLimitedCards();
}

function adjustLimitedPadding() {
  const sec = document.getElementById('limited-section');
  if (!sec) return;
  if (isMobile()) {
    sec.style.paddingTop = '2.4rem';
    sec.style.paddingBottom = '4rem';
  } else {
    sec.style.paddingTop = '1.5rem';
    sec.style.paddingBottom = '4rem';
  }
}

/* ===================== 인기 차량 ===================== */
function renderPopular() {
  const wrap = document.getElementById('popular-scroll');
  if (!wrap) return;
  wrap.innerHTML = POPULAR.map(car => `
    <div class="popular-card">
      <div class="popular-img-wrap">
        <span class="popular-bignum ${car.rank<=3?'top3':'normal'}">${car.rank}</span>
        <img src="${car.img}" alt="${car.name}" class="popular-img" onerror="this.style.opacity='.2'">
      </div>
      <div class="popular-info">
        <p>${car.name}</p>
        <p>${car.price}</p>
      </div>
    </div>
  `).join('');
}

function popularScroll(dir) {
  const el = document.getElementById('popular-scroll');
  if (!el) return;
  if (dir === -1) el.scrollTo({ left: 0, behavior: 'smooth' });
  else el.scrollTo({ left: el.scrollWidth, behavior: 'smooth' });
}

/* ===================== 이번 주 특가 ===================== */
function renderWeekly() {
  const grid = document.getElementById('weekly-grid');
  if (!grid) return;
  grid.innerHTML = WEEKLY_CARS.map(car => `
    <article class="border border-neutral-200 bg-white overflow-hidden">
      <div class="overflow-hidden">
        <img src="${car.image}" alt="${car.name}" class="h-48 w-full object-contain bg-white">
      </div>
      <div class="p-5">
        ${(car.tag || car.type) ? `<span class="car-badge mb-3 inline-flex bg-neutral-800 px-3 py-1 text-xs font-black text-white">${car.tag || car.type}</span>` : ''}
        <h3 class="font-black text-neutral-950">${car.name}</h3>
        <p class="mt-1 font-black text-neutral-950">${car.price}</p>
        <p class="mt-1 text-sm font-semibold text-neutral-500">${car.meta}</p>
        <button class="mt-8 w-full bg-neutral-900 py-3 text-sm font-bold text-white transition hover:bg-red-600">견적 신청하기</button>
      </div>
    </article>
  `).join('');
}

/* ===================== EV BANNER ===================== */
let evPopupTimer = null;
let evDotsTimer = null;
const EV_DOTS_SEQ = ['.', '..', '...', '.', '..', '...'];

function openEvPopup() {
  const p = document.getElementById('ev-popup');
  if (p) p.style.display = 'flex';
}
function closeEvPopup(e) {
  const p = document.getElementById('ev-popup');
  if (p) p.style.display = 'none';
}
function evGo() {
  clearTimeout(evPopupTimer);
  window.location.href = 'ev.php';
}

(function evBannerInit() {
  const banner = document.getElementById('ev-banner');
  const charging = document.getElementById('ev-charging');
  if (!banner) return;
  const mob = window.matchMedia('(hover: none)').matches;

  // 게이지 차오른 후 자동 팝업 기능 제거. 게이지 애니메이션은 hover 시 유지.
  if (!mob) {
    banner.addEventListener('mouseenter', () => {
      if (charging) charging.style.color = 'rgba(74,222,128,.8)';
      let i = 0;
      evDotsTimer = setInterval(() => {
        i = (i + 1) % EV_DOTS_SEQ.length;
        if (charging) charging.textContent = 'Charging' + EV_DOTS_SEQ[i];
      }, 180);
    });
    banner.addEventListener('mouseleave', () => {
      clearInterval(evDotsTimer);
      if (charging) {
        charging.style.color = 'transparent';
        charging.textContent = 'Charging.';
      }
    });
  }
})();

/* ===================== SUB CAROUSEL ===================== */
let subCurrent = 0;
let subPrevCurrent = 0;
let subPaused = false;
let subRaf = null;
let subInterval = null;
let subProgressStart = null;
const SUB_DURATION = 4000;
const SUB_AW = 100, SUB_SW = 13;
let subTouchX = null;

const navTargets = {
  "홈": "../index.php",
  "장기렌트": "index.php",
  "할부": "../installment/",
  "중고차": "../used-car/",
  "화물리스": "../lease/",
  "자동차용품": "../shop/",
  "이벤트&혜택": "../event/",
  "고객센터": "../contact/"
};
function setActiveNav(p) {
  const url = navTargets[p] || "#";
  if (url !== "#") window.location.href = url;
}

function renderSubCarousel() {
  const track = document.getElementById('subcar-track');
  if (!track) return;
  const mob = isMobile();
  if (mob) {
    track.style.height = '340px';
  } else {
    track.style.height = '';
  }
  const containerH = mob ? 340 : (track.clientHeight || 460);
  const banners = RENTAL_BANNERS;

  let cardsHtml = banners.map((banner, index) => {
    let offset = index - subCurrent;
    if (offset > banners.length / 2) offset -= banners.length;
    if (offset < -banners.length / 2) offset += banners.length;
    const isActive = offset === 0;
    const visible = mob ? (Math.abs(offset) <= 1) : isActive;
    let prevOffset = index - subPrevCurrent;
    if (prevOffset > banners.length / 2) prevOffset -= banners.length;
    if (prevOffset < -banners.length / 2) prevOffset += banners.length;
    const isJumping = mob && Math.abs(offset - prevOffset) > 1;

    const lp = 50 + offset * (SUB_AW / 2 + SUB_SW / 2 + 1);
    const transform = mob
      ? `translateX(${offset * 100}%)`
      : `translateX(-50%) scale(${isActive ? 1 : 0.93})`;
    const cardW = mob ? '100%' : (isActive ? `${SUB_AW}%` : `${SUB_SW}%`);
    const cardLeft = mob ? '0' : `${lp}%`;
    const cardTop = '0';
    const cardH = containerH;

    let inner = '';
    const imgSrc = (mob && banner.mobImage) ? banner.mobImage : banner.image;
    if (imgSrc) inner += `<img src="${imgSrc}" alt="${banner.label}" class="subcar-card-img">`;
    inner += `<div class="subcar-card-overlay"></div>`;

    const titleEsc = banner.title.replace(/'/g, "\\'");
    const labelEsc = banner.label.replace(/'/g, "\\'");

    if (mob && isActive) {
      const md = !!banner.textDark;
      const cM = md ? '#0a0a0a' : '#fff';
      const cL = md ? 'rgba(0,0,0,.7)' : 'rgba(255,255,255,.85)';
      const cD = md ? 'rgba(0,0,0,.65)' : 'rgba(255,255,255,.78)';
      const ts = md ? '' : 'text-shadow:0 2px 8px rgba(0,0,0,.3);';
      inner += `
        <div style="position:absolute;top:1.25rem;left:1rem;right:1rem;z-index:10">
          <p style="font-size:.7rem;font-weight:700;color:${cL};margin-bottom:.35rem;letter-spacing:.05em">${banner.label}</p>
          <h1 style="font-size:1.35rem;font-weight:900;line-height:1.25;color:${cM};white-space:pre-line;${ts}">${banner.title}</h1>
          <p style="margin-top:.55rem;font-size:.78rem;font-weight:500;color:${cD};line-height:1.4">${banner.desc||''}</p>
        </div>`;
    } else if (!mob && isActive) {
      const dots = banners.map((_, i) => `<span onclick="event.stopPropagation();subGo(${i})" style="width:${i===subCurrent?24:7}px;height:7px;border-radius:999px;background:${i===subCurrent?'#fff':'rgba(255,255,255,.35)'};transition:all .3s;display:inline-block;cursor:pointer"></span>`).join('');
      // 액티브 카드는 이미지만 표시 (텍스트/인포카드는 트랙 외부에서 오버레이로 처리)
    } else if (!mob && !isActive) {
      inner += `
        <div style="position:absolute;bottom:1.5rem;left:1rem;right:1rem;z-index:10">
          <p style="font-size:.8rem;font-weight:900;color:rgba(255,255,255,.9)">${banner.label}</p>
          <p style="font-size:.72rem;color:rgba(255,255,255,.65);margin-top:.2rem;overflow:hidden;white-space:nowrap;text-overflow:ellipsis">${banner.title.split('\n')[0]}</p>
        </div>`;
    }

    return `<div onclick="subCardClick(${index},${isActive ? 'true' : 'false'},'${banner.target}')" class="subcar-slide absolute text-left" aria-label="${banner.label}" style="position:absolute;top:${cardTop};left:${cardLeft};width:${cardW};height:${cardH}px;border-radius:16px;overflow:hidden;transform:${transform};z-index:${isActive?20:10};opacity:${!visible?0:(!mob&&!isActive)?0.75:1};pointer-events:${visible?'auto':'none'};filter:${(!mob&&!isActive)?'saturate(0.6)':'none'};transition:${isJumping?'none':mob?'transform 0.42s cubic-bezier(0.4,0,0.2,1)':'all 0.6s ease-out'};cursor:pointer">${inner}</div>`;
  }).join('');

  if (!mob) {
    cardsHtml += `
      <button onclick="subMove(-1)" class="absolute z-30" aria-label="이전" style="top:50%;left:8px;transform:translateY(-50%);background:rgba(0,0,0,.4);border:1px solid rgba(255,255,255,.2);border-radius:8px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;cursor:pointer">
        <span style="display:inline-block;width:9px;height:9px;border-left:2.5px solid #fff;border-bottom:2.5px solid #fff;transform:rotate(45deg) translate(2px,-2px)"></span>
      </button>
      <button onclick="subMove(1)" class="absolute z-30" aria-label="다음" style="top:50%;right:8px;transform:translateY(-50%);background:rgba(0,0,0,.4);border:1px solid rgba(255,255,255,.2);border-radius:8px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;cursor:pointer">
        <span style="display:inline-block;width:9px;height:9px;border-right:2.5px solid #fff;border-top:2.5px solid #fff;transform:rotate(45deg) translate(-2px,2px)"></span>
      </button>`;
  } else {
    const dots = banners.map((_, i) => `<span onclick="subGo(${i})" style="width:${i===subCurrent?20:6}px;height:6px;border-radius:999px;background:${i===subCurrent?'#fff':'rgba(255,255,255,.5)'};transition:all .3s;display:inline-block;cursor:pointer;box-shadow:0 1px 3px rgba(0,0,0,.2)"></span>`).join('');
    cardsHtml += `
      <div style="position:absolute;bottom:1rem;left:1.5rem;right:1.5rem;z-index:40;display:flex;align-items:center;gap:5px">
        ${dots}
        <button onclick="subTogglePause()" style="margin-left:auto;background:rgba(0,0,0,.4);border:1px solid rgba(255,255,255,.35);color:#fff;width:24px;height:24px;border-radius:5px;font-size:.65rem;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,.2)">${subPaused?'▶':'⏸'}</button>
      </div>`;
  }

  track.innerHTML = cardsHtml;

  const pw = document.getElementById('subcar-progress-wrap');
  if (pw) pw.style.display = mob ? 'none' : '';

  // 오버레이 (액티브 카드 위에 텍스트 + 인포카드, safe zone 내부 고정)
  const overlay = document.getElementById('subcar-overlay');
  const overlayText = document.getElementById('subcar-overlay-text');
  const overlayCard = document.getElementById('subcar-overlay-card');
  if (overlay && overlayText && overlayCard) {
    if (mob) {
      overlay.style.display = 'none';
    } else {
      overlay.style.display = '';
      const active = banners[subCurrent];
      const dark = !!active.textDark;
      const cMain = dark ? '#0a0a0a' : '#fff';
      const cLbl  = dark ? 'rgba(0,0,0,.7)' : 'rgba(255,255,255,.85)';
      const cLblBg= dark ? 'rgba(0,0,0,.06)' : 'rgba(255,255,255,.18)';
      const cDesc = dark ? 'rgba(0,0,0,.65)' : 'rgba(255,255,255,.72)';
      const cDotA = dark ? '#0a0a0a' : '#fff';
      const cDotI = dark ? 'rgba(0,0,0,.25)' : 'rgba(255,255,255,.35)';
      const cBtnBg= dark ? 'rgba(0,0,0,.08)' : 'rgba(0,0,0,.35)';
      const cBtnBd= dark ? 'rgba(0,0,0,.2)' : 'rgba(255,255,255,.3)';
      const dots = banners.map((_, i) => `<span onclick="event.stopPropagation();subGo(${i})" style="width:${i===subCurrent?24:7}px;height:7px;border-radius:999px;background:${i===subCurrent?cDotA:cDotI};transition:all .3s;display:inline-block;cursor:pointer"></span>`).join('');
      overlayText.innerHTML = `
        <span style="display:inline-block;font-size:.72rem;font-weight:900;color:${cLbl};letter-spacing:.1em;margin-bottom:.5rem;background:${cLblBg};padding:.2rem .75rem;border-radius:999px">${active.label}</span>
        <h1 style="font-size:2.25rem;font-weight:900;line-height:1.25;color:${cMain};white-space:pre-line">${active.title}</h1>
        <p style="margin-top:.5rem;font-size:.875rem;font-weight:500;color:${cDesc}">${active.desc}</p>
        <div style="display:flex;align-items:center;gap:6px;margin-top:1.25rem">
          ${dots}
          <button onclick="event.stopPropagation();subTogglePause()" style="margin-left:8px;background:${cBtnBg};border:1px solid ${cBtnBd};color:${cMain};width:26px;height:26px;border-radius:4px;font-size:.65rem;cursor:pointer;display:flex;align-items:center;justify-content:center">${subPaused?'▶':'⏸'}</button>
        </div>`;
      overlayCard.style.display = 'none';
    }
  }
}

function subCardClick(index, isActive, target) {
  if (isActive) setActiveNav(target);
  else {
    let offset = index - subCurrent;
    if (offset > RENTAL_BANNERS.length / 2) offset -= RENTAL_BANNERS.length;
    if (offset < -RENTAL_BANNERS.length / 2) offset += RENTAL_BANNERS.length;
    subMove(offset);
  }
}

function subMove(d) {
  subPrevCurrent = subCurrent;
  subCurrent = wrapIndex(subCurrent, d, RENTAL_BANNERS.length);
  renderSubCarousel();
  subRestartAuto();
}
function subGo(i) {
  subPrevCurrent = subCurrent;
  subCurrent = i;
  renderSubCarousel();
  subRestartAuto();
}
function subTogglePause() {
  subPaused = !subPaused;
  renderSubCarousel();
  if (subPaused) subStopAuto();
  else subRestartAuto();
}

function subStopAuto() {
  if (subInterval) clearInterval(subInterval);
  if (subRaf) cancelAnimationFrame(subRaf);
  subInterval = null;
  subRaf = null;
  const pbar = document.getElementById('subcar-progress');
  if (pbar) pbar.style.width = '0%';
}

function subRestartAuto() {
  subStopAuto();
  if (subPaused) return;
  const mob = isMobile();
  if (!mob) {
    subProgressStart = null;
    const pbar = document.getElementById('subcar-progress');
    const tick = ts => {
      if (!subProgressStart) subProgressStart = ts;
      const p = Math.min((ts - subProgressStart) / SUB_DURATION, 1);
      if (pbar) pbar.style.width = (p * 100) + '%';
      if (p < 1) subRaf = requestAnimationFrame(tick);
    };
    subRaf = requestAnimationFrame(tick);
    subInterval = setInterval(() => {
      subPrevCurrent = subCurrent;
      subCurrent = wrapIndex(subCurrent, 1, RENTAL_BANNERS.length);
      renderSubCarousel();
      subProgressStart = null;
    }, SUB_DURATION);
  } else {
    subInterval = setInterval(() => {
      subPrevCurrent = subCurrent;
      subCurrent = wrapIndex(subCurrent, 1, RENTAL_BANNERS.length);
      renderSubCarousel();
    }, SUB_DURATION);
  }
}

(function subInit() {
  const sec = document.getElementById('subcar-section');
  if (!sec) return;
  sec.addEventListener('touchstart', e => { subTouchX = e.touches[0].clientX; });
  sec.addEventListener('touchend', e => {
    if (subTouchX === null) return;
    const diff = subTouchX - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 40) subMove(diff > 0 ? 1 : -1);
    subTouchX = null;
  });
})();

/* ===================== HERO PROMOS HEIGHT — 강제 동기화 ===================== */
function lockHeroPromoHeight() {
  const sec = document.getElementById('subcar-section');
  const promos = document.querySelector('.hero-promos');
  if (!sec || !promos) return;
  if (window.innerWidth >= 769) {
    promos.style.height = sec.offsetHeight + 'px';
  } else {
    promos.style.height = '';
  }
}
// 여러 시점에서 강제로 동기화
['DOMContentLoaded','load'].forEach(e => window.addEventListener(e, lockHeroPromoHeight));
[0, 50, 200, 500, 1000, 2000].forEach(ms => setTimeout(lockHeroPromoHeight, ms));
if (window.ResizeObserver) {
  const _s = document.getElementById('subcar-section');
  if (_s) new ResizeObserver(lockHeroPromoHeight).observe(_s);
}

/* ===================== RESIZE HANDLER ===================== */
let resizeTimer = null;
window.addEventListener('resize', () => {
  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(() => {
    renderSubCarousel();
    renderLimitedCards();
    renderMobCats();
    adjustLimitedPadding();
    lockHeroPromoHeight();
  }, 100);
});

/* ===================== INITIAL RENDER ===================== */
renderSubCarousel();
subRestartAuto();
renderLimitedCards();
renderMobCats();
adjustLimitedPadding();
renderPopular();
renderWeekly();

/* ===================== 모바일 카테고리: 자동 사이클 + 스크롤 연동 ===================== */
(function setupMobCatHint(){
  if (window.innerWidth > 768) return;
  const row = document.querySelector('.mob-cat-row');
  if (!row) return;

  const MAX_OFFSET    = 95;
  const TRIGGER_RANGE = 400;

  let userInteracted = false;
  let autoRunning    = false;
  ['touchstart','pointerdown','wheel'].forEach(ev =>
    row.addEventListener(ev, () => { userInteracted = true; }, { once:true, passive:true })
  );

  function easeInOutCubic(t){
    return t < 0.5 ? 4*t*t*t : 1 - Math.pow(-2*t + 2, 3) / 2;
  }

  function runAutoCycle(){
    autoRunning = true;
    const outDur  = 850;
    const holdDur = 380;
    const backDur = 800;

    return new Promise(resolve => {
      const t0 = performance.now();
      function phaseOut(now){
        if (userInteracted) { autoRunning = false; resolve(); return; }
        const t = Math.min((now - t0) / outDur, 1);
        row.scrollLeft = MAX_OFFSET * easeInOutCubic(t);
        if (t < 1) requestAnimationFrame(phaseOut);
        else setTimeout(() => requestAnimationFrame(phaseBack), holdDur);
      }
      let t1 = 0;
      function phaseBack(now){
        if (userInteracted) { autoRunning = false; resolve(); return; }
        if (!t1) t1 = now;
        const t = Math.min((now - t1) / backDur, 1);
        row.scrollLeft = MAX_OFFSET * (1 - easeInOutCubic(t));
        if (t < 1) requestAnimationFrame(phaseBack);
        else { row.scrollLeft = 0; autoRunning = false; resolve(); }
      }
      requestAnimationFrame(phaseOut);
    });
  }

  let rafId = null;
  let lastY = -1;
  function scrollLinkedLoop(){
    if (userInteracted || autoRunning) { rafId = null; return; }
    const y = window.scrollY || window.pageYOffset || 0;
    if (y !== lastY) {
      lastY = y;
      const ratio = Math.max(0, Math.min(y / TRIGGER_RANGE, 1));
      const eased = 1 - Math.pow(1 - ratio, 4);
      row.scrollLeft = MAX_OFFSET * eased;
    }
    rafId = requestAnimationFrame(scrollLinkedLoop);
  }

  setTimeout(() => {
    runAutoCycle().then(() => {
      if (!userInteracted && rafId == null) {
        rafId = requestAnimationFrame(scrollLinkedLoop);
        window.addEventListener('scroll', () => {
          if (rafId == null && !userInteracted) rafId = requestAnimationFrame(scrollLinkedLoop);
        }, { passive: true });
      }
    });
  }, 600);
})();
</script>

</body>
</html>
