<?php
$top_active    = '장기렌트';
$subnav_active = 'insight';
$bnav_active   = '';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>RENT insight — 럭셔리 카 매거진</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@400;500;700;900&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Pretendard Variable',Pretendard,-apple-system,BlinkMacSystemFont,system-ui,Roboto,sans-serif;background:#fafaf9;color:#1c1917;padding-bottom:4rem}
a{text-decoration:none;color:inherit}
img{display:block;max-width:100%}

.mg-serif{font-family:'Noto Serif KR','Playfair Display',Georgia,serif}
.mg-display{font-family:'Playfair Display',Georgia,serif;letter-spacing:-.02em}
.mg-kicker{font-size:.7rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:#2858E0}
.mg-kicker-dark{color:#1c1917}
.mg-byline{font-size:.72rem;color:#78716c;letter-spacing:.05em;font-weight:500}
.mg-rule{display:inline-block;width:32px;height:1px;background:#1c1917;vertical-align:middle;margin-right:.75rem}

.mg-masthead{max-width:1280px;margin:0 auto;padding:2.25rem 1.5rem 1.25rem;display:flex;align-items:flex-end;justify-content:space-between;gap:2rem;border-bottom:1px solid #e7e5e4}
.mg-mast-title h1{font-family:'Playfair Display',Georgia,serif;font-size:3rem;font-weight:900;letter-spacing:-.03em;line-height:1}
.mg-mast-title h1 em{font-style:italic;font-weight:400;color:#2858E0}
.mg-mast-title p{margin-top:.55rem;font-size:.78rem;color:#78716c;font-weight:500;letter-spacing:.05em}
.mg-mast-meta{text-align:right;font-size:.72rem;color:#78716c;font-weight:600;letter-spacing:.08em;line-height:1.7;text-transform:uppercase}
.mg-mast-meta strong{color:#1c1917;font-weight:900;display:block;font-size:.95rem;letter-spacing:.04em;margin-top:.2rem}

.mg-secnav{max-width:1280px;margin:0 auto;padding:1.25rem 1.5rem 0;display:flex;justify-content:center;flex-wrap:wrap;gap:2.5rem;font-size:.78rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#57534e}
.mg-secnav a{padding:.5rem 0;border-bottom:2px solid transparent;transition:.15s}
.mg-secnav a:hover{color:#1c1917;border-bottom-color:#1c1917}
.mg-secnav a.active{color:#1c1917;border-bottom-color:#2858E0}

.mg-hero{max-width:1280px;margin:2.5rem auto 0;padding:0 1.5rem}
.mg-hero-card{position:relative;border-radius:6px;overflow:hidden;aspect-ratio:16/8;background:#1c1917}
.mg-hero-card img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.78}
.mg-hero-text{position:absolute;left:0;right:0;bottom:0;padding:3rem 3rem 2.5rem;background:linear-gradient(0deg,rgba(0,0,0,.85) 0%,rgba(0,0,0,.5) 60%,transparent 100%);color:#fff}
.mg-hero-kicker{font-size:.72rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:#93c5fd;margin-bottom:.85rem;display:flex;align-items:center}
.mg-hero-kicker .mg-rule{background:#93c5fd;margin-right:.75rem}
.mg-hero-title{font-family:'Playfair Display',Georgia,serif;font-size:3.5rem;font-weight:900;letter-spacing:-.025em;line-height:1.05;max-width:65%;text-shadow:0 2px 16px rgba(0,0,0,.4)}
.mg-hero-title em{font-style:italic;font-weight:400;color:#93c5fd}
.mg-hero-sub{margin-top:1rem;font-size:1rem;color:rgba(255,255,255,.85);max-width:55%;line-height:1.55;font-weight:400}
.mg-hero-byline{margin-top:1.5rem;font-size:.72rem;color:rgba(255,255,255,.7);letter-spacing:.08em;text-transform:uppercase}

.mg-section{max-width:1280px;margin:5rem auto 0;padding:0 1.5rem}
.mg-section-head{display:flex;align-items:baseline;justify-content:space-between;margin-bottom:2rem;border-bottom:1px solid #d6d3d1;padding-bottom:1rem}
.mg-section-title{font-family:'Playfair Display',Georgia,serif;font-size:1.85rem;font-weight:900;letter-spacing:-.02em;display:flex;align-items:center;gap:.85rem}
.mg-section-title .mg-num{font-family:'Playfair Display',Georgia,serif;font-style:italic;font-weight:400;font-size:1.1rem;color:#2858E0;padding:.15rem .65rem;border:1px solid #2858E0;border-radius:999px}
.mg-section-more{font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#57534e;display:inline-flex;align-items:center;gap:.4rem}
.mg-section-more:hover{color:#2858E0}

.mg-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:2.25rem}
.mg-pick-card{cursor:pointer;transition:.18s}
.mg-pick-card:hover .mg-pick-img img{transform:scale(1.04)}
.mg-pick-img{position:relative;overflow:hidden;border-radius:4px;background:#e7e5e4;aspect-ratio:4/3;margin-bottom:1.1rem}
.mg-pick-img img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
.mg-pick-cat{position:absolute;top:1rem;left:1rem;background:#fff;color:#1c1917;font-size:.65rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;padding:.35rem .65rem;border-radius:2px}
.mg-pick-title{font-family:'Noto Serif KR','Playfair Display',Georgia,serif;font-size:1.35rem;font-weight:900;line-height:1.3;letter-spacing:-.015em;margin-bottom:.6rem}
.mg-pick-sub{font-size:.88rem;color:#57534e;line-height:1.55;margin-bottom:.85rem}
.mg-pick-meta{font-size:.7rem;color:#a8a29e;letter-spacing:.05em;font-weight:500}

.mg-feature{display:grid;grid-template-columns:5fr 7fr;gap:3.5rem;align-items:center}
.mg-feature-img{position:relative;border-radius:4px;overflow:hidden;aspect-ratio:5/6;background:#e7e5e4}
.mg-feature-img img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
.mg-feature-img .mg-feature-tag{position:absolute;top:1.25rem;left:1.25rem;background:#1c1917;color:#fff;font-size:.65rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;padding:.4rem .75rem}
.mg-feature-text .mg-kicker{margin-bottom:1.1rem;display:flex;align-items:center}
.mg-feature-text h2{font-family:'Playfair Display',Georgia,serif;font-size:3rem;font-weight:900;letter-spacing:-.025em;line-height:1.05;margin-bottom:1.25rem}
.mg-feature-text h2 em{font-style:italic;font-weight:400;color:#2858E0}
.mg-feature-text p{font-size:1.02rem;line-height:1.75;color:#404040;margin-bottom:1.1rem;font-weight:400}
.mg-feature-text p:first-letter{font-family:'Playfair Display',Georgia,serif;font-size:3.5rem;float:left;line-height:.85;padding:.3rem .55rem 0 0;font-weight:900;color:#1c1917}
.mg-feature-byline{margin-top:1.5rem;display:flex;align-items:center;gap:1rem;padding-top:1.5rem;border-top:1px solid #d6d3d1}
.mg-feature-byline-avatar{width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,#2858E0,#1c1917);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:900;font-size:.85rem;letter-spacing:.02em}
.mg-feature-byline-info{font-size:.78rem;color:#57534e;line-height:1.4}
.mg-feature-byline-info strong{color:#1c1917;display:block;font-weight:700;letter-spacing:.02em}

.mg-interview{background:#1c1917;color:#fff;border-radius:4px;overflow:hidden;display:grid;grid-template-columns:1fr 1fr;gap:0;align-items:stretch}
.mg-interview-photo{position:relative;background:#0a0a0a;min-height:480px}
.mg-interview-photo img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.85}
.mg-interview-body{padding:3.5rem 3rem;display:flex;flex-direction:column;justify-content:center}
.mg-interview-kicker{font-size:.7rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#93c5fd;margin-bottom:1.25rem}
.mg-interview-quote{font-family:'Playfair Display',Georgia,serif;font-size:2.1rem;line-height:1.35;font-weight:400;font-style:italic;letter-spacing:-.01em;color:#fafaf9;position:relative;padding-left:1.5rem}
.mg-interview-quote::before{content:'"';position:absolute;left:-.5rem;top:-1.5rem;font-size:6rem;color:#2858E0;line-height:1;font-weight:900;font-family:'Playfair Display',Georgia,serif}
.mg-interview-attrib{margin-top:2rem;font-size:.85rem;color:#a8a29e;line-height:1.6}
.mg-interview-attrib strong{color:#fff;display:block;font-size:1.05rem;font-weight:900;font-style:normal;letter-spacing:-.005em;margin-bottom:.2rem}
.mg-interview-cta{margin-top:1.75rem;display:inline-block;font-size:.72rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#93c5fd;padding-bottom:.3rem;border-bottom:1px solid #93c5fd;align-self:flex-start}

.mg-gallery{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem}
.mg-gal-item{position:relative;border-radius:4px;overflow:hidden;aspect-ratio:3/4;background:#1c1917;cursor:pointer}
.mg-gal-item img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .5s ease,opacity .3s}
.mg-gal-item:hover img{transform:scale(1.06);opacity:.7}
.mg-gal-cap{position:absolute;left:0;right:0;bottom:0;padding:1.25rem 1.1rem .9rem;background:linear-gradient(0deg,rgba(0,0,0,.85),transparent);color:#fff}
.mg-gal-cap .mg-pick-cat{position:static;background:transparent;color:#93c5fd;padding:0;margin-bottom:.45rem;display:block}
.mg-gal-cap h4{font-family:'Noto Serif KR','Playfair Display',Georgia,serif;font-size:1rem;font-weight:900;line-height:1.25;letter-spacing:-.005em}

.mg-col-item{cursor:pointer;padding-top:.25rem}
.mg-col-item .mg-kicker{margin-bottom:.85rem}
.mg-col-item h3{font-family:'Noto Serif KR','Playfair Display',Georgia,serif;font-size:1.5rem;font-weight:900;line-height:1.3;letter-spacing:-.015em;margin-bottom:.85rem;transition:.15s}
.mg-col-item:hover h3{color:#2858E0}
.mg-col-item p{font-size:.88rem;line-height:1.65;color:#57534e;margin-bottom:1rem}
.mg-col-item .mg-pick-meta{display:flex;align-items:center;gap:.75rem}
.mg-col-item .mg-pick-meta::before{content:'';display:inline-block;width:32px;height:1px;background:#1c1917}

.mg-news{display:grid;grid-template-columns:repeat(2,1fr);gap:0 3rem}
.mg-news-item{display:flex;gap:1.25rem;padding:1.5rem 0;border-bottom:1px solid #e7e5e4;cursor:pointer;transition:.15s}
.mg-news-item:hover h4{color:#2858E0}
.mg-news-thumb{width:120px;flex-shrink:0;aspect-ratio:1/1;border-radius:3px;overflow:hidden;background:#e7e5e4}
.mg-news-thumb img{width:100%;height:100%;object-fit:cover}
.mg-news-body{flex:1;min-width:0}
.mg-news-body .mg-kicker{font-size:.65rem;color:#1c1917;margin-bottom:.45rem;display:block}
.mg-news-body h4{font-family:'Noto Serif KR','Playfair Display',Georgia,serif;font-size:1.05rem;font-weight:900;line-height:1.35;letter-spacing:-.01em;margin-bottom:.5rem;transition:.15s}
.mg-news-body p{font-size:.78rem;color:#78716c;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.mg-news-body .mg-pick-meta{margin-top:.55rem;font-size:.68rem}

.mg-newsletter{margin:6rem auto 0;padding:0 1.5rem;max-width:1280px}
.mg-newsletter-inner{background:linear-gradient(135deg,#1c1917 0%,#0a0a0a 100%);color:#fff;border-radius:6px;padding:4rem 3.5rem;display:grid;grid-template-columns:1.4fr 1fr;gap:3rem;align-items:center;position:relative;overflow:hidden}
.mg-newsletter-inner::before{content:'';position:absolute;top:-50%;right:-10%;width:60%;height:200%;background:radial-gradient(circle,rgba(40,88,224,.18) 0%,transparent 60%);pointer-events:none}
.mg-newsletter-left{position:relative;z-index:2}
.mg-newsletter-kicker{font-size:.72rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#93c5fd;margin-bottom:1rem;display:flex;align-items:center}
.mg-newsletter-kicker .mg-rule{background:#93c5fd}
.mg-newsletter h2{font-family:'Playfair Display',Georgia,serif;font-size:2.4rem;font-weight:900;letter-spacing:-.02em;line-height:1.1;margin-bottom:1rem}
.mg-newsletter h2 em{font-style:italic;font-weight:400;color:#93c5fd}
.mg-newsletter p{font-size:.95rem;color:rgba(255,255,255,.7);line-height:1.65;max-width:90%}
.mg-newsletter-form{position:relative;z-index:2;display:flex;flex-direction:column;gap:.85rem}
.mg-newsletter-form input{padding:1.05rem 1.25rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.18);color:#fff;font-size:.92rem;font-weight:500;border-radius:3px;outline:none;font-family:inherit;transition:.15s}
.mg-newsletter-form input::placeholder{color:rgba(255,255,255,.45)}
.mg-newsletter-form input:focus{border-color:#93c5fd;background:rgba(255,255,255,.1)}
.mg-newsletter-form button{padding:1.05rem 1.25rem;background:#2858E0;color:#fff;border:none;font-size:.85rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;cursor:pointer;border-radius:3px;transition:.15s;font-family:inherit}
.mg-newsletter-form button:hover{background:#1E4FCC}
.mg-newsletter-note{font-size:.7rem;color:rgba(255,255,255,.45);letter-spacing:.05em;margin-top:.5rem}

@media(max-width:768px){
  .mg-masthead{flex-direction:column;align-items:flex-start;gap:.75rem;padding:1.5rem 1.25rem 1rem}
  .mg-mast-title h1{font-size:2rem}
  .mg-mast-meta{text-align:left;font-size:.65rem}
  .mg-secnav{padding:1rem 1.25rem 0;gap:1.25rem;font-size:.7rem;overflow-x:auto;flex-wrap:nowrap;justify-content:flex-start;-webkit-overflow-scrolling:touch;scrollbar-width:none}
  .mg-secnav::-webkit-scrollbar{display:none}
  .mg-secnav a{white-space:nowrap;flex-shrink:0}

  .mg-hero{margin-top:1.5rem;padding:0 1.25rem}
  .mg-hero-card{aspect-ratio:4/5}
  .mg-hero-text{padding:1.5rem 1.25rem 1.25rem}
  .mg-hero-title{font-size:1.7rem;max-width:100%}
  .mg-hero-sub{font-size:.85rem;max-width:100%}

  .mg-section{margin-top:3rem;padding:0 1.25rem}
  .mg-section-title{font-size:1.4rem}
  .mg-section-title .mg-num{font-size:.95rem;padding:.1rem .55rem}

  .mg-grid-3{grid-template-columns:1fr;gap:2.25rem}
  .mg-pick-title{font-size:1.2rem}

  .mg-feature{grid-template-columns:1fr;gap:1.75rem}
  .mg-feature-img{aspect-ratio:4/3}
  .mg-feature-text h2{font-size:1.85rem}
  .mg-feature-text p{font-size:.95rem}
  .mg-feature-text p:first-letter{font-size:2.6rem}

  .mg-interview{grid-template-columns:1fr}
  .mg-interview-photo{min-height:280px}
  .mg-interview-body{padding:2rem 1.5rem}
  .mg-interview-quote{font-size:1.35rem;padding-left:1rem}
  .mg-interview-quote::before{font-size:4rem;top:-1rem;left:-.3rem}

  .mg-gallery{grid-template-columns:repeat(2,1fr);gap:.75rem}
  .mg-gal-cap{padding:.75rem .65rem .6rem}
  .mg-gal-cap h4{font-size:.85rem}

  .mg-news{grid-template-columns:1fr;gap:0}
  .mg-news-thumb{width:90px}
  .mg-news-body h4{font-size:.95rem}

  .mg-newsletter{margin-top:3.5rem;padding:0 1.25rem}
  .mg-newsletter-inner{grid-template-columns:1fr;gap:1.75rem;padding:2.5rem 1.75rem}
  .mg-newsletter h2{font-size:1.55rem}
}
</style>
</head>
<body>
<?php require __DIR__ . '/../includes/rental_header.php'; ?>

<section class="mg-masthead">
  <div class="mg-mast-title">
    <h1>RENT <em>insight</em></h1>
    <p>드라이브의 본질을 탐구하는 럭셔리 카 매거진</p>
  </div>
  <div class="mg-mast-meta">
    Vol.07 — May 2026
    <strong>The Electric Issue</strong>
  </div>
</section>

<nav class="mg-secnav">
  <a href="#" class="active">전체</a>
  <a href="#">커버 스토리</a>
  <a href="#">시승기</a>
  <a href="#">인터뷰</a>
  <a href="#">칼럼</a>
  <a href="#">라이프스타일</a>
  <a href="#">뉴스</a>
</nav>

<section class="mg-hero">
  <article class="mg-hero-card">
    <img src="https://images.unsplash.com/photo-1617531653332-bd46c24f2068?w=1800&auto=format&fit=crop" alt="">
    <div class="mg-hero-text">
      <div class="mg-hero-kicker"><span class="mg-rule"></span>COVER STORY · MAY 2026</div>
      <h1 class="mg-hero-title">전동화 시대,<br>다시 쓰는 <em>럭셔리</em>의 정의</h1>
      <p class="mg-hero-sub">메르세데스 EQS, BMW i7, 그리고 포르쉐 타이칸이 새롭게 그려가는 럭셔리의 좌표. 정숙성과 가속, 디지털과 장인정신 사이에서 발견한 다음 세대의 럭셔리.</p>
      <div class="mg-hero-byline">에디터 — 김유진 · PHOTO MIN HYEOK</div>
    </div>
  </article>
</section>

<section class="mg-section">
  <header class="mg-section-head">
    <h2 class="mg-section-title"><span class="mg-num">01</span>Editor's Pick</h2>
    <a href="#" class="mg-section-more">전체 보기 →</a>
  </header>
  <div class="mg-grid-3">
    <article class="mg-pick-card">
      <div class="mg-pick-img">
        <span class="mg-pick-cat">시승기</span>
        <img src="https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=1200&auto=format&fit=crop" alt="">
      </div>
      <h3 class="mg-pick-title">제네시스 G90, 동양적 정밀의 절제미</h3>
      <p class="mg-pick-sub">서울에서 강릉까지 240km. 플래그십 세단에서 발견한 '비움'의 미학.</p>
      <p class="mg-pick-meta">에디터 박재우 · 7 MIN READ</p>
    </article>
    <article class="mg-pick-card">
      <div class="mg-pick-img">
        <span class="mg-pick-cat">인터뷰</span>
        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=1200&auto=format&fit=crop" alt="">
      </div>
      <h3 class="mg-pick-title">BMW 디자인 디렉터가 말하는 '디지털 시대의 비례'</h3>
      <p class="mg-pick-sub">i 시리즈를 만든 사람의 노트북 속, 다음 세대 BMW의 스케치들.</p>
      <p class="mg-pick-meta">에디터 한지수 · 12 MIN READ</p>
    </article>
    <article class="mg-pick-card">
      <div class="mg-pick-img">
        <span class="mg-pick-cat">컬럼</span>
        <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=1200&auto=format&fit=crop" alt="">
      </div>
      <h3 class="mg-pick-title">자동차가 사라지는 미래에 대하여</h3>
      <p class="mg-pick-sub">자율주행과 구독 모델, 그리고 소유의 종말. 다섯 명의 컬럼니스트가 응답한다.</p>
      <p class="mg-pick-meta">에디터 이수민 · 9 MIN READ</p>
    </article>
  </div>
</section>

<section class="mg-section">
  <header class="mg-section-head">
    <h2 class="mg-section-title"><span class="mg-num">02</span>Feature</h2>
    <a href="#" class="mg-section-more">시승기 더보기 →</a>
  </header>
  <article class="mg-feature">
    <div class="mg-feature-img">
      <span class="mg-feature-tag">TEST DRIVE</span>
      <img src="https://images.unsplash.com/photo-1614026480418-bd11fde6f0c1?w=1200&auto=format&fit=crop" alt="">
    </div>
    <div class="mg-feature-text">
      <div class="mg-kicker"><span class="mg-rule"></span>PORSCHE TAYCAN TURBO S</div>
      <h2>침묵 속의 <em>분노</em>, 타이칸의 마지막 답변</h2>
      <p>전기 슈퍼카는 무엇이어야 하는가. 포르쉐가 7년에 걸쳐 답한 결과물이 타이칸 터보 S다. 0→100km/h 2.4초, 그리고 그 가속을 견뎌내는 자세 제어 하나하나에 스튜트가르트의 집착이 묻어있다. 우리는 강원도 인제 스피디움에서 그 한계를 시험했다.</p>
      <p>스포츠 플러스 모드의 런치 컨트롤. 페달을 끝까지 밟는 순간 시야 가장자리가 비틀린다. 동승석의 동료는 무의식적으로 시트를 움켜쥐었다. "이게 정말 전기차가 맞느냐"는 질문이 익숙해질 때까지 다섯 번을 더 반복했다.</p>
      <div class="mg-feature-byline">
        <div class="mg-feature-byline-avatar">박재</div>
        <div class="mg-feature-byline-info">
          <strong>박재우 · 시승 에디터</strong>
          2026년 5월 18일 · 14분 분량
        </div>
      </div>
    </div>
  </article>
</section>

<section class="mg-section">
  <header class="mg-section-head">
    <h2 class="mg-section-title"><span class="mg-num">03</span>Interview</h2>
    <a href="#" class="mg-section-more">모든 인터뷰 →</a>
  </header>
  <article class="mg-interview">
    <div class="mg-interview-photo">
      <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=1200&auto=format&fit=crop" alt="">
    </div>
    <div class="mg-interview-body">
      <div class="mg-interview-kicker">DESIGN DIRECTOR · KIA</div>
      <p class="mg-interview-quote">자동차는 점점 가전제품을 닮아갑니다. 그래서 우리는 더더욱 감정을 디자인해야 합니다. 사람이 차에 다가갈 때 느끼는 첫 0.3초의 떨림 — 그것이 우리가 다투는 진짜 전장입니다.</p>
      <div class="mg-interview-attrib">
        <strong>카림 하비브 (Karim Habib)</strong>
        기아 디자인센터장 · 2026.05.10 서울 스튜디오
      </div>
      <a href="#" class="mg-interview-cta">전체 인터뷰 읽기 →</a>
    </div>
  </article>
</section>

<section class="mg-section">
  <header class="mg-section-head">
    <h2 class="mg-section-title"><span class="mg-num">04</span>The Gallery</h2>
    <a href="#" class="mg-section-more">2026 SS 모음 →</a>
  </header>
  <div class="mg-gallery">
    <article class="mg-gal-item">
      <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a?w=900&auto=format&fit=crop" alt="">
      <div class="mg-gal-cap">
        <span class="mg-pick-cat">LUXURY EV</span>
        <h4>롤스로이스 스펙터, 침묵을 디자인하다</h4>
      </div>
    </article>
    <article class="mg-gal-item">
      <img src="https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=900&auto=format&fit=crop" alt="">
      <div class="mg-gal-cap">
        <span class="mg-pick-cat">SUPERCAR</span>
        <h4>람보르기니 레부엘토, V12의 부활</h4>
      </div>
    </article>
    <article class="mg-gal-item">
      <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=900&auto=format&fit=crop" alt="">
      <div class="mg-gal-cap">
        <span class="mg-pick-cat">GRAND TOURING</span>
        <h4>벤틀리 컨티넨탈 GT, 12기통의 마지막 노래</h4>
      </div>
    </article>
    <article class="mg-gal-item">
      <img src="https://images.unsplash.com/photo-1542362567-b07e54358753?w=900&auto=format&fit=crop" alt="">
      <div class="mg-gal-cap">
        <span class="mg-pick-cat">CONCEPT</span>
        <h4>현대 N 비전 74, 미래에서 온 헌사</h4>
      </div>
    </article>
  </div>
</section>

<section class="mg-section">
  <header class="mg-section-head">
    <h2 class="mg-section-title"><span class="mg-num">05</span>Columns</h2>
    <a href="#" class="mg-section-more">모든 컬럼 →</a>
  </header>
  <div class="mg-grid-3">
    <article class="mg-col-item">
      <div class="mg-kicker">DRIVE &amp; CULTURE</div>
      <h3>아우토반에서 배운 것, 그리고 잃은 것</h3>
      <p>독일에서 보낸 10년. 무제한 속도 구간이 가르쳐준 운전자의 윤리. 우리는 왜 한국에서 그것을 갖지 못했나.</p>
      <p class="mg-pick-meta">정세영 · 객원 필자</p>
    </article>
    <article class="mg-col-item">
      <div class="mg-kicker">LIFESTYLE</div>
      <h3>주말 드라이브 코스 — 동해 7번 국도, 봄</h3>
      <p>강릉부터 영덕까지 280km. 정동진의 일출, 망상의 점심, 그리고 7번 국도 위의 적막.</p>
      <p class="mg-pick-meta">에디터 이수민</p>
    </article>
    <article class="mg-col-item">
      <div class="mg-kicker">TECH</div>
      <h3>운전자 보조 시스템, 어디까지 믿어야 하나</h3>
      <p>레벨 2와 레벨 3 사이의 회색지대. 자율주행을 둘러싼 책임의 윤리학에 대해.</p>
      <p class="mg-pick-meta">최지원 · 자동차 기자</p>
    </article>
  </div>
</section>

<section class="mg-section">
  <header class="mg-section-head">
    <h2 class="mg-section-title"><span class="mg-num">06</span>This Week</h2>
    <a href="#" class="mg-section-more">전체 뉴스 →</a>
  </header>
  <div class="mg-news">
    <article class="mg-news-item">
      <div class="mg-news-thumb"><img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=400&auto=format&fit=crop" alt=""></div>
      <div class="mg-news-body">
        <span class="mg-kicker">REVIEW · 05.20</span>
        <h4>제네시스 GV80 쿠페, 한국형 럭셔리의 새 분기점</h4>
        <p>플래그십 SUV의 정통성을 유지하면서 더 낮고, 더 빠르고, 더 도전적으로.</p>
        <p class="mg-pick-meta">5 min read</p>
      </div>
    </article>
    <article class="mg-news-item">
      <div class="mg-news-thumb"><img src="https://images.unsplash.com/photo-1601706354441-c12fda9d3a0c?w=400&auto=format&fit=crop" alt=""></div>
      <div class="mg-news-body">
        <span class="mg-kicker">INDUSTRY · 05.18</span>
        <h4>현대차그룹, 2027년 솔리드스테이트 배터리 양산 선언</h4>
        <p>1회 충전 800km, 충전 시간 12분 — 게임 체인저가 될 수 있을까.</p>
        <p class="mg-pick-meta">6 min read</p>
      </div>
    </article>
    <article class="mg-news-item">
      <div class="mg-news-thumb"><img src="https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?w=400&auto=format&fit=crop" alt=""></div>
      <div class="mg-news-body">
        <span class="mg-kicker">REVIEW · 05.17</span>
        <h4>BMW M5 하이브리드, 727마력의 모순과 매혹</h4>
        <p>전동화된 M의 정체성은 더 강해졌나, 아니면 흐려졌나.</p>
        <p class="mg-pick-meta">8 min read</p>
      </div>
    </article>
    <article class="mg-news-item">
      <div class="mg-news-thumb"><img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?w=400&auto=format&fit=crop" alt=""></div>
      <div class="mg-news-body">
        <span class="mg-kicker">CULTURE · 05.15</span>
        <h4>'드라이버' 다큐멘터리, 칸 영화제 초청</h4>
        <p>운전자라는 직업의 마지막 10년을 기록한 한국 다큐멘터리.</p>
        <p class="mg-pick-meta">4 min read</p>
      </div>
    </article>
  </div>
</section>

<section class="mg-newsletter">
  <div class="mg-newsletter-inner">
    <div class="mg-newsletter-left">
      <div class="mg-newsletter-kicker"><span class="mg-rule"></span>SUBSCRIBE TO RENT INSIGHT</div>
      <h2>매달 첫 주, 가장 빠른 <em>드라이브의 이야기</em>를 메일로</h2>
      <p>에디터들이 직접 큐레이션한 시승기, 인터뷰, 럭셔리 라이프스타일. 매월 1편의 깊은 글과 함께 한 달치 뉴스 요약을.</p>
    </div>
    <form class="mg-newsletter-form" onsubmit="event.preventDefault();alert('데모입니다. 실제 구독은 향후 연동됩니다.')">
      <input type="email" placeholder="이메일 주소" required>
      <button type="submit">무료 구독하기</button>
      <p class="mg-newsletter-note">언제든 한 번의 클릭으로 구독 해지가 가능합니다.</p>
    </form>
  </div>
</section>

<?php require __DIR__ . '/../includes/rental_footer.php'; ?>
</body>
</html>
