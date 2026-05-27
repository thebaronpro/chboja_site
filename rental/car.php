<?php
$top_active    = '장기렌트';
$subnav_active = '';
$bnav_active   = '';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>차량 상세 — RENT insight</title>
<link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
html{overflow-x:clip}
body{font-family:'Pretendard Variable',Pretendard,-apple-system,BlinkMacSystemFont,system-ui,Roboto,sans-serif;background:#f9f9f9;color:#0a0a0a;overflow-x:clip}
a{text-decoration:none;color:inherit}
.page-backbar{max-width:1200px;margin:0 auto;padding:.75rem 1rem .25rem}
@media(max-width:768px){
  .page-backbar{position:sticky;top:0;z-index:40;max-width:none;margin:0;padding:.55rem 1rem;background:rgba(255,255,255,.96);backdrop-filter:saturate(140%) blur(6px);-webkit-backdrop-filter:saturate(140%) blur(6px);border-bottom:1px solid #f0f0f0}
}
.back-btn{display:inline-flex;align-items:center;gap:.25rem;background:none;border:none;color:#171717;font-size:.95rem;font-weight:500;cursor:pointer;padding:.4rem .25rem;font-family:inherit;letter-spacing:-.01em}
.back-btn:hover{color:#525252}
/* === 구 GNB (사용 안 함, 호환을 위해 빈 셀렉터로 무효화) === */
.gnb-header,.gnb-logo-row,.gnb-logo,.gnb-topright,.gnb-nav,.gnb-nav-inner,.gnb-item,.gnb-subnav,.gnb-subnav-inner,.gnb-tab,.gnb-search,.gnb-search-inner,.gnb-search-text{display:none}
.gnb-topright{position:absolute;right:2rem;font-size:.75rem;color:#737373}
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:6px;background:none;border:none;position:absolute;right:1rem}
.hamburger span{display:block;width:22px;height:2px;background:#0a0a0a}
.gnb-nav{display:none}
.gnb-nav-inner{display:flex;justify-content:center;overflow-x:auto;max-width:80rem;margin:0 auto;padding:0 1rem}
.gnb-item{display:block;padding:1rem 2rem;font-size:1rem;font-weight:600;color:#737373;white-space:nowrap;border-bottom:4px solid transparent;text-decoration:none;transition:color .15s}
.gnb-item:hover{color:#171717}
.gnb-item.active{color:#0a0a0a;font-weight:900;border-bottom-color:#171717}
.gnb-subnav{background:#fafafa;border-bottom:1px solid #e5e5e5}
.gnb-subnav-inner{display:flex;justify-content:center;max-width:80rem;margin:0 auto;padding:0;overflow-x:auto;gap:.5rem}
.gnb-tab{display:flex;align-items:center;justify-content:center;padding:.95rem 1.4rem;font-size:1.05rem;font-weight:600;color:#737373;white-space:nowrap;border-bottom:2px solid transparent;text-decoration:none;transition:color .15s;text-align:center}
.gnb-tab:hover{color:#171717}
.gnb-tab.active{color:#171717;font-weight:900;border-bottom-color:#a3a3a3}
.gnb-tab.quick{color:#dc2626;font-weight:900}
.gnb-tab.quick:hover{color:#b91c1c}
.gnb-search{background:#f5f5f5;border-bottom:1px solid #e5e5e5;cursor:pointer}
.gnb-search-inner{display:flex;align-items:center;gap:.75rem;max-width:80rem;margin:0 auto;padding:.75rem 1.5rem}
.gnb-search-text{font-size:.875rem;color:#a3a3a3}
.back-btn{display:inline-flex;align-items:center;gap:.25rem;background:none;border:none;color:#171717;font-size:.95rem;font-weight:500;cursor:pointer;padding:.4rem .25rem;font-family:inherit;letter-spacing:-.01em}
.back-btn:hover{color:#525252}
@media(max-width:768px){
  /* car.php 모바일에서는 GNB 로고바 숨김 — back-bar가 그 자리를 차지하도록 */
  header > .logo-bar{display:none !important}
  .page-backbar{position:sticky;top:0;z-index:40;max-width:none;margin:0;padding:.55rem 1rem;background:rgba(255,255,255,.96);backdrop-filter:saturate(140%) blur(6px);-webkit-backdrop-filter:saturate(140%) blur(6px);border-bottom:1px solid #f0f0f0}
  .hamburger{display:flex!important}
  .gnb-nav{display:none!important}
  .gnb-topright{display:none}
  .gnb-subnav{display:none!important}
}

.car-hero{background:#fff;padding:1.5rem 2rem 2rem;margin-bottom:1.5rem;border-radius:1rem}

.rental-options{padding:1.5rem 1.25rem;background:#fff;margin-bottom:1.5rem;border-radius:1rem;border:1px solid #f0f0f0}

/* ===== 아코디언 (모바일 전용) ===== */
.acc-block{margin-bottom:.75rem}
.acc-header{display:none;width:100%;background:#fff;border:1px solid #E2E0DA;border-radius:1rem;padding:1.05rem 1.25rem;font-family:inherit;font-size:1.02rem;font-weight:800;color:#0E0E12;letter-spacing:-.01em;cursor:pointer;text-align:left;align-items:center;justify-content:space-between;gap:.6rem;transition:border-color .15s, background-color .15s;position:relative}
.acc-header:hover{border-color:#2858E0}
.acc-header-title{flex:1;min-width:0;display:flex;align-items:center;gap:.5rem}
.acc-header-hint{font-size:.72rem;font-weight:600;color:#2858E0;margin-right:.5rem;letter-spacing:-.01em}
.acc-block.open .acc-header-hint{display:none}
.acc-chevron{width:1.15rem;height:1.15rem;flex-shrink:0;transition:transform .25s ease;color:#2858E0;stroke-width:3}
.acc-block.open .acc-chevron{transform:rotate(180deg)}
.acc-block:not(.open) > .acc-header{background:#DEE7FB;border-color:#BFD2F8}
.acc-body{transition:max-height .3s ease}

@media(max-width:768px){
  .acc-header{display:flex}
  .acc-block{margin-bottom:1rem}
  .acc-block:not(.open) > .acc-body{display:none}
  /* 펼침 상태: 블록 전체를 단일 카드로 감쌈 */
  .acc-block.open{border:1px solid #E2E0DA;border-radius:1rem;background:#fff;overflow:hidden}
  .acc-block.open > .acc-header{border:none;border-bottom:1px solid #BFD2F8;border-radius:0;background:#DEE7FB;margin-bottom:0}
  .acc-block.open > .acc-body > .section,
  .acc-block.open > .acc-body > .color-section,
  .acc-block.open > .acc-body > .rental-options{border:none !important;border-radius:0 !important;margin-bottom:0 !important;box-shadow:none !important}
  /* 렌탈 조건 블록은 항상 펼친 상태로 — 접힘 불가 */
  .acc-block[data-acc="rental"] > .acc-header{display:none}
  .acc-block[data-acc="rental"] > .acc-body{display:block !important}
  .acc-block[data-acc="rental"].open{border:1px solid #E2E0DA;border-radius:1rem;overflow:hidden}
}
.rental-row{padding:1.1rem 0;border-bottom:1px solid #f0f0f0}
.rental-row:first-child{padding-top:.25rem}
.rental-row:last-child{border-bottom:none;padding-bottom:.25rem}
.rental-label{font-size:1rem;font-weight:800;color:#171717;margin-bottom:.7rem;display:flex;align-items:center;gap:.4rem;letter-spacing:-.01em}
.rental-label-desc{font-size:.72rem;font-weight:400;color:#a3a3a3;font-weight:500}
.rental-help{display:inline-flex;align-items:center;justify-content:center;width:1.15rem;height:1.15rem;border-radius:50%;background:#e5e5e5;color:#525252;font-size:.72rem;font-weight:800;border:none;cursor:pointer;font-family:inherit;line-height:1;padding:0;transition:background .15s;flex-shrink:0}
.rental-help:hover{background:#d4d4d4;color:#0a0a0a}
.rental-tip{position:absolute;background:#1c1917;color:#fff;padding:.7rem .9rem;border-radius:.5rem;font-size:.78rem;font-weight:500;max-width:280px;line-height:1.55;z-index:999;box-shadow:0 6px 18px rgba(0,0,0,.25);letter-spacing:-.01em;animation:tipFade .15s ease-out;white-space:pre-line}
.rental-tip::after{content:'';position:absolute;bottom:100%;left:.85rem;border:6px solid transparent;border-bottom-color:#1c1917}
@keyframes tipFade{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:translateY(0)}}
.rental-btns{display:flex;flex-direction:row;gap:.5rem;flex-wrap:wrap}
.rental-btn{flex:1;min-width:0;padding:.8rem .25rem;border:1px solid #E2E0DA;background:#fff;font-size:.88rem;font-weight:600;color:#525252;cursor:pointer;border-radius:.65rem;transition:all .15s;font-family:inherit;text-align:center;line-height:1.2}
.rental-btn:hover{background:#F7F5F0;color:#0a0a0a;border-color:#C8C7CD}
.rental-btn.selected{border-color:#BFD2F8;background:#F0F4FE;color:#1E4FCC;font-weight:800}

/* === 상품 종류 (장기렌트/리스) — 더 진한 배경으로 시각적 비중 강조 === */
.product-pick{padding:1.5rem 1.25rem;background:#DEE7FB;margin-bottom:1rem;border-radius:1rem;border:1px solid #BFD2F8}
/* 진한 배경 위에서 selected 가 묻히지 않게 — 솔리드 블루로 강조 */
.product-pick .rental-btn.selected{background:#2858E0;color:#fff;border-color:#2858E0}
/* 데스크탑: 다른 rental-row 와 동일하게 라벨 좌측 / 버튼 우측 — 가로 늘어짐 방지 */
@media (min-width:769px){
  .product-pick{padding:1.4rem 2rem;display:grid;grid-template-columns:200px 1fr;gap:1.5rem;align-items:center}
  .product-pick > .rental-label{margin-bottom:0}
  .product-pick > .rental-btns{max-width:24rem}
}
.car-image{width:100%;max-width:600px;margin:0 auto;display:block}
.car-info-row{display:flex;align-items:center;justify-content:space-between;margin-top:1.25rem;padding-top:1.25rem;border-top:2px solid #0a0a0a;gap:1rem}
.car-title{font-size:1.4rem;font-weight:900;position:relative}
.car-title::after{content:'';display:block;width:2rem;height:3px;background:#2858E0;margin-top:.35rem;border-radius:2px}
.car-price-wrap{text-align:right}
.car-price-label{font-size:.7rem;font-weight:700;color:#a3a3a3;letter-spacing:.05em;text-transform:uppercase;margin-bottom:.2rem}
.car-price{font-size:1.5rem;font-weight:900;color:#1E4FCC;white-space:nowrap;letter-spacing:-.02em}
.car-price-sub{font-size:.8rem;font-weight:400;color:#a3a3a3}
.hero-colors{margin-top:1rem;padding-top:1rem;border-top:1px solid #f0f0f0;display:flex;flex-direction:column;gap:.75rem}
.hero-color-row{display:flex;align-items:center;gap:.75rem;font-size:.9rem}
.hero-color-label{flex-shrink:0;width:3rem;color:#737373;font-weight:700;font-size:.85rem}
.hero-color-swatches{flex:1;display:flex;flex-wrap:wrap;gap:.45rem}
.hero-swatch{width:1.5rem;height:1.5rem;border-radius:50%;border:1px solid rgba(0,0,0,.12);box-shadow:inset 0 0 0 1px rgba(255,255,255,.2);cursor:pointer;flex-shrink:0;position:relative;transition:transform .15s,box-shadow .15s}
.hero-swatch:hover{transform:scale(1.15);z-index:2;box-shadow:inset 0 0 0 1px rgba(255,255,255,.2),0 0 0 2px rgba(220,38,38,.25)}
.hero-swatch.selected{box-shadow:inset 0 0 0 1px rgba(255,255,255,.2),0 0 0 2px #2858E0}
.hero-swatch.two-tone{background:linear-gradient(135deg,var(--c1) 50%,var(--c2) 50%)}
.hero-color-name{display:none}
/* 색상 호버 시 말풍선 툴팁 */
.hero-swatch::after{
  content:attr(data-color-name);
  position:absolute;bottom:calc(100% + 8px);left:50%;transform:translateX(-50%) translateY(4px);
  background:#0a0a0a;color:#fff;padding:.38rem .6rem;border-radius:.4rem;
  font-size:.72rem;font-weight:600;letter-spacing:-.01em;white-space:nowrap;pointer-events:none;
  opacity:0;transition:opacity .15s,transform .15s;z-index:50
}
.hero-swatch::before{
  content:"";position:absolute;bottom:calc(100% + 2px);left:50%;transform:translateX(-50%);
  border:5px solid transparent;border-top-color:#0a0a0a;pointer-events:none;opacity:0;transition:opacity .15s;z-index:50
}
.hero-swatch:hover::after,.hero-swatch:hover::before{opacity:1;transform:translateX(-50%) translateY(0)}
.hero-swatch:hover::before{transform:translateX(-50%)}
/* 모바일은 툴팁 비활성 */
@media (max-width: 768px){
  .hero-swatch::after,.hero-swatch::before{display:none !important}
}

/* 선택 요약 패널 (차량 사진 아래 컴팩트 박스) */
.sel-summary{position:fixed;right:1.5rem;top:7rem;width:17rem;max-height:calc(100vh - 10rem);overflow-y:auto;z-index:90;background:#fff;border:1px solid #f0f0f0;border-radius:14px;padding:1rem 1.1rem;font-size:.78rem;box-shadow:0 10px 32px rgba(0,0,0,.12),0 1px 4px rgba(0,0,0,.06)}
.sel-summary-title{font-size:.78rem;font-weight:800;color:#0a0a0a;letter-spacing:-.01em;margin-bottom:.45rem}
.sel-summary-rows{display:flex;flex-direction:column;gap:.15rem}
.sel-summary-row{display:flex;align-items:flex-start;gap:.5rem;font-size:.76rem;padding:.22rem 0;border-bottom:1px dashed #ececec}
.sel-summary-row:last-child{border-bottom:none}
.sel-summary-label{flex-shrink:0;width:3.6rem;color:#737373;font-weight:600;font-size:.72rem}
.sel-summary-value{flex:1;color:#0a0a0a;font-weight:600;word-break:keep-all;line-height:1.35;font-size:.78rem}
.sel-summary-value.empty{color:#bdbdbd;font-weight:500}
.sel-summary-row.total{margin-top:.2rem;padding-top:.35rem;border-top:1px solid #e5e7eb;border-bottom:none}
.sel-summary-row.total .sel-summary-label{color:#0a0a0a;font-weight:800}
.sel-summary-row.total .sel-summary-value{font-size:.92rem;font-weight:900;color:#1E4FCC}
.sel-opt-chip{display:inline-flex;align-items:center;gap:.25rem;background:#eef2ff;color:#1e3a8a;font-size:.66rem;font-weight:700;padding:.15rem .4rem;border-radius:999px;line-height:1.2;margin:.08rem .2rem .08rem 0}

/* 모바일: 선택 요약 패널만 숨김 (색상 선택은 가능) */
@media (max-width: 768px) {
  .sel-summary { display: none !important; }
  .hero-color-name { display: none !important; }
  .hero-colors { display: none !important; }
  /* car-hero: 이미지 좌측 / 차량명+가격 우측 */
  .car-hero:not([style*="display: none"]):not([style*="display:none"]) {
    display: grid !important;
    grid-template-columns: 130px 1fr !important;
    gap: 1rem !important;
    align-items: center !important;
    padding: 1rem 1.25rem !important;
    margin-bottom: 1rem !important;
  }
  .car-hero > img.car-image {
    width: 100% !important;
    max-width: 130px !important;
    height: auto !important;
    object-fit: contain !important;
    margin: 0 !important;
  }
  .car-hero > .car-info-row {
    margin-top: 0 !important;
    padding-top: 0 !important;
    border-top: none !important;
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: .5rem !important;
  }
  .car-hero > .car-info-row .car-price-wrap {
    text-align: left !important;
  }
}
.hero-swatch.two-tone{background:linear-gradient(135deg,var(--c1) 50%,var(--c2) 50%)}
.car-brand{display:none}

.section{background:#fff;padding:2rem;margin-bottom:1.5rem;border-radius:1rem}
.section-title{font-size:1.5rem;font-weight:900;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:2px solid #e5e5e5}
/* 빠른출고 차량 고정 스펙 표시 (기존, 호환용) */
.limited-spec{background:#fff;padding:1.5rem;margin-bottom:1.5rem;border-radius:1rem}
.limited-spec-title{font-size:1.1rem;font-weight:900;color:#0a0a0a;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
.limited-spec-badge{font-size:.7rem;font-weight:900;background:#dc2626;color:#fff;padding:.2rem .55rem;border-radius:999px;letter-spacing:.02em}
.limited-spec-row{display:flex;align-items:flex-start;gap:.75rem;padding:.65rem 0;border-bottom:1px solid #f0f0f0;font-size:.95rem}
.limited-spec-row:last-child{border-bottom:none}
.limited-spec-label{flex-shrink:0;width:5.5rem;color:#737373;font-weight:700;font-size:.875rem}
.limited-spec-value{flex:1;color:#0a0a0a;font-weight:600;line-height:1.5}

/* === 빠른출고 차량 새 카드 디자인 === */
.lim-card{background:#fff;border:1px solid #e5e5e5;border-radius:1.25rem;margin-bottom:1.5rem;box-shadow:0 4px 24px rgba(0,0,0,.04);overflow:hidden}
/* 상단 헤더 스트립 (밝은 배경) */
.lim-header-strip{background:#f9fafb;border-bottom:1px solid #e5e7eb;padding:.6rem 1.25rem;display:flex;align-items:center;justify-content:space-between;gap:.5rem;font-size:.78rem;font-weight:700;letter-spacing:.02em;flex-wrap:nowrap;white-space:nowrap}
.lim-stock-pill{display:inline-flex;align-items:center;gap:.4rem;background:#fff;color:#171717;padding:.34rem .8rem .34rem .65rem;border-radius:999px;font-size:.78rem;font-weight:700;line-height:1;border:1px solid #e5e7eb;letter-spacing:-.01em}
.lim-stock-pill::before{content:"";width:.4rem;height:.4rem;border-radius:50%;background:#ef4444;flex-shrink:0;animation:limPulse 1.8s ease-in-out infinite}
@keyframes limPulse{0%,100%{opacity:1}50%{opacity:.4}}
.lim-header-strip-right{display:flex;align-items:center;gap:.5rem;color:#525252;font-weight:700}
.lim-header-strip-left{display:flex;align-items:center;gap:.4rem;flex-wrap:nowrap;min-width:0}
.lim-header-strip-right{flex-shrink:0}
@media(max-width:420px){
  .lim-header-strip{padding:.55rem .8rem;gap:.35rem}
  .lim-stock-pill{font-size:.68rem;padding:.28rem .6rem .28rem .52rem;gap:.32rem}
  .lim-stock-pill::before{width:.34rem;height:.34rem}
  .lim-discount-badge{font-size:.62rem;padding:.18rem .42rem}
  .lim-header-strip-right{gap:.3rem;font-size:.7rem}
  .lim-header-tag-quick{font-size:.7rem}
  .lim-header-tag-type{font-size:.68rem}
  .lim-header-sep{font-size:.65rem}
}
.lim-header-tag{display:inline-flex;align-items:center;gap:.25rem}
.lim-header-tag-quick{color:#0a0a0a;font-weight:900}
.lim-header-sep{color:#d4d4d4;font-weight:400}
.lim-header-tag-type{color:#525252;font-weight:700}
/* 카드 본문 */
.lim-body{padding:1.25rem 1.25rem 1.25rem}
.lim-top{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-bottom:.85rem}
.lim-title-wrap{flex:1;min-width:0}
.lim-model{font-size:1.5rem;font-weight:900;color:#0a0a0a;letter-spacing:-.02em;line-height:1.15;margin-bottom:.35rem}
.lim-subtitle{font-size:.85rem;font-weight:500;color:#525252;line-height:1.4;margin-bottom:0}
.lim-img-wrap{flex-shrink:0;width:120px;height:90px;display:flex;align-items:center;justify-content:center;position:relative}
.lim-img{max-width:100%;max-height:100%;object-fit:contain}

.lim-divider{height:1px;background:#f0f0f0;margin:1rem 0}
.lim-specs{display:flex;flex-direction:column;gap:.55rem}
.lim-row{display:flex;align-items:center;justify-content:space-between;gap:.75rem;font-size:.95rem}
.lim-row-label{color:#737373;font-weight:600;font-size:.92rem}
.lim-row-value{color:#0a0a0a;font-weight:800;font-size:1rem}
.lim-row-stack{align-items:center;flex-direction:row;justify-content:space-between;gap:.75rem;padding-top:.3rem}
.lim-price-col{display:flex;flex-direction:column;align-items:flex-end;gap:.25rem}
.lim-discount-badge{display:inline-flex;align-items:center;gap:.25rem;background:#DEE7FB;color:#1E4FCC;font-size:.72rem;font-weight:800;padding:.22rem .55rem;border-radius:999px;line-height:1}
.lim-discount-badge::before{content:"✦";color:#1E4FCC}
.lim-price-orig{color:#a3a3a3;text-decoration:line-through;font-size:.88rem;font-weight:600}
.lim-price-final{color:#0a0a0a;font-weight:900;font-size:1.15rem;letter-spacing:-.01em}

/* 색상 (원 + 이름) */
.lim-colors{margin-top:1rem;display:flex;flex-direction:column;gap:.55rem;background:#fafafa;border-radius:.75rem;padding:.85rem 1rem}
.lim-color-row{display:flex;align-items:center;gap:.75rem;font-size:.92rem}
.lim-color-label{flex-shrink:0;width:4.25rem;color:#737373;font-weight:600}
.lim-color-circle{width:1.05rem;height:1.05rem;border-radius:50%;border:1px solid rgba(0,0,0,.12);flex-shrink:0}
.lim-color-circle.two-tone{background:linear-gradient(135deg,var(--c1) 50%,var(--c2) 50%)}
.lim-color-name{color:#0a0a0a;font-weight:700}

/* 옵션 */
.lim-opts{margin-top:.75rem;background:#fafafa;border-radius:.75rem;padding:.85rem 1rem}
.lim-opts-row{display:flex;gap:.75rem;align-items:flex-start;font-size:.92rem}
.lim-opts-label{flex-shrink:0;width:4.25rem;color:#737373;font-weight:600;padding-top:.05rem}
.lim-opts-list{flex:1;list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:.35rem}
.lim-opts-list li{color:#0a0a0a;font-weight:700;line-height:1.45;display:flex;gap:.4rem;align-items:center}
.lim-opts-list li::before{content:"·";color:#0a0a0a;flex-shrink:0;padding-top:0}
.lim-opts-list li.lim-opt-row::before{display:none}
.lim-opts-list .lim-opt-name{flex:0 1 auto;min-width:0;font-weight:700;color:#0a0a0a;letter-spacing:-.01em;position:relative;padding-left:.7rem}
.lim-opts-list .lim-opt-name::before{content:"·";position:absolute;left:0;color:#0a0a0a}
.lim-opts-list .lim-opt-price{flex-shrink:0;color:#525252;font-weight:600;font-size:.85em;letter-spacing:-.01em;margin-left:auto}
.lim-opt-info{display:inline-flex;align-items:center;justify-content:center;width:1.15rem;height:1.15rem;border-radius:50%;background:#e5e5e5;color:#525252;font-size:.7rem;font-weight:800;border:none;cursor:pointer;font-family:inherit;line-height:1;padding:0;transition:background .15s,color .15s;flex-shrink:0}
.lim-opt-info:hover{background:#BFD2F8;color:#1E4FCC}
.lim-opts-detail{margin-top:.65rem;padding-top:.65rem;border-top:1px solid #e5e5e5;display:flex;justify-content:center;align-items:center;gap:.25rem;color:#525252;font-size:.85rem;font-weight:600;cursor:pointer}
.lim-opts-detail::after{content:"›";font-weight:900}
.model-group{margin-bottom:2rem}
.model-group-title{font-size:1.1rem;font-weight:700;color:#0a0a0a;margin-bottom:.75rem}
.model-list,.trim-list{display:flex;flex-direction:column;gap:.5rem;max-width:100%}
.model-item,.trim-card{border:1px solid #E2E0DA;border-radius:.75rem;padding:.85rem 1rem;cursor:pointer;transition:all .2s;background:#fff;position:relative;padding-left:2.75rem;display:flex;align-items:center;justify-content:space-between}
.model-item:hover,.trim-card:hover{background:#F7F5F0;border-color:#C8C7CD}
.model-item.selected,.trim-card.selected{border-color:#BFD2F8;background:#F0F4FE;color:#1E4FCC}
.model-item.selected::before,.trim-card.selected::before{content:'✓';position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:#1E4FCC;font-weight:900;font-size:1.1rem}
.model-item-name,.trim-name{font-weight:400;font-size:.85rem;color:#0a0a0a;flex:1;line-height:1.4}
.trim-price{font-size:.95rem;font-weight:600;color:#0a0a0a;white-space:nowrap;margin-left:1rem;align-self:flex-start}

.options-panel{margin-top:.5rem;padding-left:1.5rem;animation:slideDown .2s ease}
.options-title{font-size:.85rem;font-weight:700;color:#4f46e5;margin-bottom:.5rem}
.options-box{display:flex;flex-direction:column;gap:.5rem}
.option-item{border:1px solid #E2E0DA;border-radius:.75rem;padding:.85rem 1rem;cursor:pointer;transition:all .2s;background:#fff;position:relative;padding-left:2.75rem}
.option-item.standard{cursor:default;opacity:.6}
.option-item:hover:not(.standard){background:#F7F5F0;border-color:#C8C7CD}
.option-item.selected{background:#F0F4FE!important;border-color:#BFD2F8!important;color:#1E4FCC}
.option-item.selected::before{content:'✓';position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:#1E4FCC;font-weight:900;font-size:1.1rem}
.option-name{font-size:.85rem;font-weight:400;color:#0a0a0a}
.option-desc{font-size:.8rem;color:#737373;margin-top:.25rem}
.option-item:has(.opt-info){padding-right:2.75rem}
.opt-info{position:absolute;right:.85rem;top:50%;transform:translateY(-50%);display:inline-flex;align-items:center;justify-content:center;width:1.25rem;height:1.25rem;border-radius:50%;background:#e5e5e5;color:#525252;font-size:.75rem;font-weight:800;border:none;cursor:pointer;font-family:inherit;line-height:1;padding:0;transition:background .15s,color .15s;z-index:2}
.opt-info:hover{background:#BFD2F8;color:#1E4FCC}

.conflict-overlay{position:fixed;inset:0;background:rgba(14,14,18,.55);z-index:10001;display:flex;align-items:center;justify-content:center;padding:1rem;animation:optOverlayIn .18s ease}
.conflict-dialog{background:#fff;width:100%;max-width:420px;border-radius:1rem;padding:1.6rem 1.5rem 1.25rem;display:flex;flex-direction:column;align-items:center;text-align:center;animation:optSheetIn .22s cubic-bezier(.2,.9,.3,1.1);box-shadow:0 12px 40px rgba(0,0,0,.18)}
.conflict-icon{width:2.6rem;height:2.6rem;border-radius:50%;background:#FEF3E7;color:#F5B042;font-size:1.45rem;font-weight:900;display:flex;align-items:center;justify-content:center;margin-bottom:.85rem;line-height:1}
.conflict-title{font-size:1.08rem;font-weight:800;color:#0E0E12;letter-spacing:-.01em;margin-bottom:.5rem}
.conflict-msg{font-size:.88rem;font-weight:500;color:#525252;line-height:1.5;margin-bottom:.85rem}
.conflict-msg b{font-weight:800;color:#1E4FCC}
.conflict-list{list-style:none;padding:0;margin:0 0 1.25rem;width:100%;background:#F7F5F0;border-radius:.6rem;padding:.65rem .85rem;text-align:left;max-height:9rem;overflow-y:auto}
.conflict-list li{font-size:.84rem;font-weight:600;color:#0E0E12;padding:.3rem 0;line-height:1.35;display:flex;align-items:flex-start;gap:.45rem}
.conflict-list li::before{content:"·";color:#737373;font-weight:900;line-height:1.35;flex-shrink:0}
.conflict-actions{display:flex;gap:.55rem;width:100%}
.conflict-btn{flex:1;padding:.85rem 0;font-size:.92rem;font-weight:800;border:none;border-radius:.6rem;cursor:pointer;font-family:inherit;letter-spacing:-.01em;transition:background .15s,color .15s}
.conflict-btn-cancel{background:#F7F5F0;color:#525252}
.conflict-btn-cancel:hover{background:#EDEAE2;color:#0E0E12}
.conflict-btn-confirm{background:#2858E0;color:#fff}
.conflict-btn-confirm:hover{background:#1E4FCC}

.opt-info-overlay{position:fixed;inset:0;background:rgba(14,14,18,.55);z-index:10000;display:flex;align-items:flex-end;justify-content:center;animation:optOverlayIn .2s ease}
@keyframes optOverlayIn{from{opacity:0}to{opacity:1}}
.opt-info-sheet{background:#fff;width:100%;max-width:560px;max-height:85vh;border-radius:1rem 1rem 0 0;display:flex;flex-direction:column;animation:optSheetIn .25s cubic-bezier(.2,.9,.3,1.1)}
@keyframes optSheetIn{from{transform:translateY(20px);opacity:0}to{transform:translateY(0);opacity:1}}
.opt-info-head{display:flex;align-items:center;justify-content:space-between;gap:.75rem;padding:1.1rem 1.25rem;border-bottom:1px solid #E2E0DA}
.opt-info-title{font-size:1.05rem;font-weight:800;color:#0E0E12;letter-spacing:-.01em;flex:1;min-width:0}
.opt-info-close{background:none;border:none;font-size:1.6rem;font-weight:400;color:#737373;cursor:pointer;line-height:1;padding:.1rem .35rem;font-family:inherit}
.opt-info-close:hover{color:#0a0a0a}
.opt-info-body{overflow-y:auto;padding:.5rem 0;-webkit-overflow-scrolling:touch}
.opt-info-item{display:flex;gap:.85rem;padding:.85rem 1.25rem;border-bottom:1px solid #F4F2EC;align-items:flex-start}
.opt-info-item:last-child{border-bottom:none}
.opt-info-img{flex-shrink:0;width:5.5rem;height:4rem;object-fit:cover;border-radius:.5rem;background:#F7F5F0;border:1px solid #E2E0DA}
.opt-info-img-empty,.opt-info-img-broken{background:transparent;border:none}
.opt-info-text{flex:1;min-width:0;display:flex;flex-direction:column;gap:.35rem;padding-top:.1rem}
.opt-info-name{font-size:.9rem;font-weight:700;color:#0E0E12;letter-spacing:-.01em;line-height:1.35}
.opt-info-exp{font-size:.8rem;font-weight:500;color:#525252;line-height:1.5;letter-spacing:-.005em}
@media(min-width:769px){
  .opt-info-overlay{align-items:center}
  .opt-info-sheet{border-radius:1rem;max-height:80vh}
}
@keyframes slideDown{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}

.color-section{background:#fff;padding:2rem;margin-bottom:1.5rem;border-radius:1rem}
@media(min-width:769px){ .color-section{display:none !important} }
@media(max-width:768px){
  .color-section{padding:1rem 1.25rem;margin-bottom:0;border-radius:0;background:transparent}
  .color-list{flex-direction:row !important;flex-wrap:wrap;gap:.4rem !important}
  .color-item{
    flex:0 0 auto;
    padding:.4rem .8rem .4rem .55rem !important;
    border-radius:999px !important;
    gap:.45rem !important;
    background:#fff;
    border:1px solid #E2E0DA;
    font-size:.78rem;
  }
  .color-item.selected{border-color:#BFD2F8;background:#F0F4FE;color:#1E4FCC}
  .color-item.selected::before{display:none}
  .color-item .color-swatch{width:1rem;height:1rem;border-width:1px}
  .color-item .color-name{font-size:.78rem;font-weight:600;color:inherit;letter-spacing:-.01em}
  .color-group-title{font-size:.85rem;font-weight:700;margin-bottom:.55rem;color:#525252}
}
.color-group{margin-bottom:1.5rem}
.color-group:last-child{margin-bottom:0}
.color-group-title{font-size:1rem;font-weight:700;color:#0a0a0a;margin-bottom:.85rem}
.color-list{display:flex;flex-direction:column;gap:.4rem}
.color-item{border:1px solid #E2E0DA;border-radius:.75rem;padding:.75rem 1rem .75rem 2.75rem;cursor:pointer;transition:all .2s;background:#fff;display:flex;align-items:center;gap:.85rem;position:relative}
.color-item:hover{background:#F7F5F0;border-color:#C8C7CD}
.color-item.selected{border-color:#BFD2F8;background:#F0F4FE;color:#1E4FCC}
.color-item.selected::before{content:'✓';position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:#1E4FCC;font-weight:900;font-size:1.1rem}
.color-swatch{width:28px;height:28px;border-radius:50%;border:2px solid rgba(0,0,0,.08);flex-shrink:0}
.color-swatch.two-tone{background:linear-gradient(135deg,var(--c1) 50%,var(--c2) 50%)}
.color-name{font-size:.85rem;font-weight:400;color:#0a0a0a}

.cta-box{position:fixed;bottom:env(safe-area-inset-bottom);left:0;right:0;z-index:100;background:#1f2937;padding:.85rem 1rem;border-top:1px solid #111827;display:flex;flex-direction:column;gap:.7rem;padding-bottom:.85rem;border-top-left-radius:1rem;border-top-right-radius:1rem}
.cta-price-bar{display:flex;align-items:center;justify-content:space-between;gap:.5rem;padding:0 .15rem}
.cta-price-label{font-size:.92rem;font-weight:700;color:#d1d5db;letter-spacing:-.01em}
.cta-price-value{font-size:1.25rem;font-weight:900;color:#fff;letter-spacing:-.02em}
.cta-btns{display:flex;gap:.5rem}
.cta-btn{flex:1;padding:.85rem .5rem;font-size:.95rem;font-weight:800;border:none;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:.4rem;border-radius:.6rem}
.cta-primary{background:#fff;color:#0a0a0a}
.cta-primary:hover{background:#f3f4f6}
.cta-hyundai{background:#002C5F;color:#fff}
.cta-hyundai:hover{background:#001f47}
@media (max-width:768px){
  .cta-box{padding:.7rem .85rem;padding-bottom:.7rem;gap:.55rem}
  .cta-price-label{font-size:.88rem}
  .cta-price-value{font-size:1.15rem}
  .cta-btn{padding:.75rem .5rem;font-size:.9rem}
}

/* ============== 데스크탑 견적화면 레이아웃 ============== */
@media (min-width: 769px) {
  main[style*="max-width:1200px"]{max-width:1200px !important;padding:2rem 1.5rem 9rem !important}

  /* 히어로: 이미지 좌 / 정보 우 */
  .car-hero{
    display:grid;grid-template-columns:360px 1fr;gap:2.5rem;align-items:start;justify-items:center;
    padding:2rem 2.5rem;border:1px solid #f0f0f0;margin-bottom:1.5rem;
  }
  .car-hero > img.car-image{display:block;margin:0 auto;max-width:300px;max-height:200px;width:100%;object-fit:contain;grid-column:1;grid-row:1;align-self:start;justify-self:center}
  .car-hero > .sel-summary{grid-row:2}
  .car-hero > .car-info-row{
    grid-column:2;margin:0;padding:0;border-top:none;
    display:flex;flex-direction:column;align-items:flex-start;gap:1rem;
    justify-self:start;width:100%;
  }
  .car-hero > .hero-colors{justify-self:start;width:100%}
  .car-hero > .car-info-row .car-title{font-size:2rem;letter-spacing:-.02em}
  .car-hero > .car-info-row .car-title::after{margin-top:.6rem;width:2.5rem;height:4px}
  .car-hero > .car-info-row .car-price-wrap{text-align:left}
  .car-hero > .car-info-row .car-price{font-size:1.85rem}
  .car-hero > .hero-colors{grid-column:2;margin-top:0;padding-top:1rem;border-top:1px solid #f0f0f0}
  .car-hero > .sel-summary{grid-column:1;grid-row:2;justify-self:stretch;width:100%;max-width:360px;margin-top:0;align-self:start}

  /* 빠른출고 카드: 좌 정보 / 우 이미지 크게 */
  .lim-card{max-width:none}
  .lim-body{display:grid;grid-template-columns:1.2fr 1fr;gap:2rem;padding:1.5rem 2rem 2rem;column-gap:3rem}
  .lim-body .lim-top{grid-column:1 / -1;display:grid;grid-template-columns:1.2fr 1fr;gap:2rem;align-items:center;margin-bottom:0}
  .lim-body .lim-top .lim-title-wrap{order:1}
  .lim-body .lim-top .lim-img-wrap{order:2;width:100%;height:200px}
  .lim-body .lim-top .lim-img{max-height:100%;max-width:100%}
  .lim-body .lim-model{font-size:2rem}
  .lim-body .lim-divider{grid-column:1 / -1;margin:.5rem 0 0}
  .lim-body .lim-specs{grid-column:1;margin:0}
  .lim-body .lim-colors{grid-column:2;grid-row:3;margin:0}
  .lim-body .lim-opts{grid-column:1 / -1;margin:.25rem 0 0}

  /* 세부모델 좌측 / 트림 + 옵션 우측 (2열 그리드, 항상 노출) */
  #modelContainer{display:grid;grid-template-columns:1fr 1.3fr;gap:1.5rem;align-items:start;padding:0;background:transparent;border:none}
  #modelContainer .model-group{margin:0;background:#fff;border:1px solid #f0f0f0;border-radius:1rem;padding:1.5rem 1.75rem}
  #modelContainer .model-group:first-child{grid-column:1;position:sticky;top:8rem}
  #modelContainer #trimSection{grid-column:2;display:block !important}
  .trim-empty{color:#a3a3a3;font-size:.9rem;text-align:center;padding:2.5rem 1rem;background:#fafafa;border:1px dashed #e5e7eb;border-radius:.7rem}

  /* 색상 섹션 */
  .color-section{padding:1.5rem 1.75rem;border:1px solid #f0f0f0;display:grid;grid-template-columns:1fr 1fr;gap:1.5rem}
  .color-group{margin:0}

  /* 렌탈 옵션: 각 행 좌측 라벨 / 우측 버튼 */
  .rental-options{padding:2rem 2rem;border:1px solid #f0f0f0;border-radius:1rem;margin-bottom:1.5rem}
  .rental-row{display:grid;grid-template-columns:200px 1fr;gap:1.5rem;align-items:center;padding:1.4rem 0}
  .rental-row:first-child{padding-top:.25rem}
  .rental-label{margin-bottom:0;font-size:1.05rem;flex-direction:row;align-items:center;gap:.4rem}
  .rental-label-desc{font-size:.72rem}
  .rental-btns{flex-wrap:wrap}

  /* CTA: 가운데 정렬, 가로폭 제한, 데스크탑 풍 */
  .cta-box{
    bottom:0 !important;padding:1rem 1.5rem !important;padding-bottom:1rem !important;
    flex-direction:row !important;align-items:center !important;justify-content:space-between !important;
    gap:1.5rem !important;border-radius:1rem 1rem 0 0;
    max-width:1200px;left:50% !important;right:auto !important;transform:translateX(-50%);
    box-shadow:0 -8px 24px rgba(0,0,0,.15);
  }
  .cta-price-bar{flex-shrink:0;padding:0;gap:1rem}
  .cta-price-label{font-size:.95rem}
  .cta-price-value{font-size:1.45rem}
  .cta-btns{flex:1;justify-content:flex-end;gap:.6rem}
  .cta-btn{flex:0 0 auto;min-width:180px;padding:.95rem 1.5rem !important;font-size:.98rem !important}

  /* 페이지 백바: 데스크탑 더 여유롭게 */
  .page-backbar{padding:1.25rem 1rem .5rem}
  .back-btn{font-size:1rem}
}

/* 견적 문의 모달 */
.quote-modal{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;padding:1.25rem;animation:qmFadeIn .18s ease}
.quote-modal-backdrop{position:absolute;inset:0;background:rgba(10,10,10,.55);backdrop-filter:blur(2px)}
.quote-modal-card{position:relative;width:100%;max-width:380px;background:#fff;border-radius:1.1rem;overflow:hidden;box-shadow:0 20px 50px rgba(0,0,0,.25);animation:qmPopIn .22s cubic-bezier(.2,.9,.3,1.2)}
.quote-modal-header{padding:1.4rem 1.4rem .9rem;text-align:center}
.quote-modal-icon{width:3rem;height:3rem;border-radius:50%;background:#ecfdf5;display:inline-flex;align-items:center;justify-content:center;margin-bottom:.6rem}
.quote-modal-icon svg{stroke:#059669}
.quote-modal-title{font-size:1.08rem;font-weight:900;color:#0a0a0a;letter-spacing:-.02em;margin:0 0 .3rem}
.quote-modal-sub{font-size:.85rem;color:#737373;margin:0;line-height:1.4}
.quote-modal-body{padding:.2rem 1.1rem 1rem;max-height:50vh;overflow-y:auto}
.quote-modal-body .qm-row{display:flex;justify-content:space-between;gap:.75rem;padding:.55rem .35rem;border-bottom:1px solid #f3f4f6;font-size:.88rem}
.quote-modal-body .qm-row:last-child{border-bottom:none}
.quote-modal-body .qm-label{color:#737373;font-weight:600;flex-shrink:0}
.quote-modal-body .qm-value{color:#0a0a0a;font-weight:500;text-align:right;word-break:keep-all;line-height:1.5}
.quote-modal-body .qm-value.qm-price{color:#0a0a0a;font-weight:800;font-size:.95rem}
.quote-modal-footer{padding:.4rem 1.1rem 1.1rem;display:flex;gap:.5rem}
.quote-modal-footer .quote-modal-btn{flex:1}
.quote-modal-btn-cancel{background:#f3f4f6!important;color:#525252!important}
.quote-modal-btn-cancel:hover{background:#e5e7eb!important}

/* 카카오 로그인 팝업 (데스크탑) */
.kakao-overlay{position:fixed;inset:0;z-index:10001;display:none;align-items:center;justify-content:center;background:rgba(10,10,10,.55);backdrop-filter:blur(2px);padding:1.5rem;animation:qmFadeIn .18s ease}
.kakao-overlay.open{display:flex}
.kakao-overlay-bd{position:absolute;inset:0;cursor:pointer}
.kakao-frame-wrap{position:relative;width:100%;max-width:460px;height:760px;max-height:90vh;border-radius:1.1rem;overflow:hidden;background:#fff;box-shadow:0 24px 64px rgba(0,0,0,.35);animation:qmPopIn .22s cubic-bezier(.2,.9,.3,1.2)}
.kakao-frame{width:100%;height:100%;border:none;display:block}

/* 연락처 입력 영역 */
.quote-contact{padding:.4rem 1.1rem 0;display:flex;flex-direction:column;gap:.55rem}
.qc-field{display:flex;flex-direction:column;gap:.28rem}
.qc-field label{font-size:.74rem;font-weight:600;color:#525252;letter-spacing:-.01em}
.qc-field .qc-req{color:#dc2626;margin-left:.2rem}
.qc-field input{width:100%;padding:.65rem .8rem;font-size:.9rem;border:1px solid #e5e7eb;border-radius:.55rem;font-family:inherit;color:#0a0a0a;outline:none;transition:border-color .15s}
.qc-field input:focus{border-color:#0a0a0a}
.qc-field input::placeholder{color:#a3a3a3}

/* 간편가입 안내 */
.quote-signup{margin:.85rem 1.1rem .4rem;padding:.85rem 1rem;background:linear-gradient(135deg,#f9fafb 0%,#f3f4f6 100%);border:1px solid #e5e7eb;border-radius:.7rem}
.qs-head{display:flex;align-items:center;gap:.4rem;margin-bottom:.45rem}
.qs-icon{font-size:.95rem}
.qs-title{font-size:.85rem;font-weight:800;color:#0a0a0a;letter-spacing:-.01em;margin:0}
.qs-benefits{list-style:none;padding:0;margin:0 0 .65rem;display:flex;flex-direction:column;gap:.18rem}
.qs-benefits li{font-size:.74rem;color:#525252;line-height:1.4;padding-left:.85rem;position:relative}
.qs-benefits li::before{content:"✓";position:absolute;left:0;top:0;color:#22c55e;font-weight:800}
.qs-btn-kakao{display:flex;align-items:center;justify-content:center;gap:.4rem;width:100%;padding:.7rem;background:#FEE500;border:none;border-radius:.55rem;color:#191919;font-size:.88rem;font-weight:800;cursor:pointer;font-family:inherit;letter-spacing:-.01em;transition:background .15s}
.qs-btn-kakao:hover{background:#f0d800}
.qs-btn-kakao svg{flex-shrink:0}
.quote-modal-btn{width:100%;padding:.85rem;background:#0a0a0a;color:#fff;border:none;border-radius:.7rem;font-size:.95rem;font-weight:800;cursor:pointer;font-family:inherit;letter-spacing:-.01em}
.quote-modal-btn:hover{background:#262626}
@keyframes qmFadeIn{from{opacity:0}to{opacity:1}}
@keyframes qmPopIn{from{transform:scale(.92);opacity:0}to{transform:scale(1);opacity:1}}

/* ===== NICE 신용정보 동의 모달 ===== */
.nice-modal{position:fixed;inset:0;z-index:10000;display:none;align-items:center;justify-content:center;padding:1rem;animation:qmFadeIn .18s ease}
.nice-modal.open{display:flex}
.nice-modal-backdrop{position:absolute;inset:0;background:rgba(10,10,10,.6);backdrop-filter:blur(2px);cursor:pointer}
.nice-modal-card{position:relative;width:100%;max-width:440px;background:#fff;border-radius:1.1rem;overflow:hidden;box-shadow:0 24px 60px rgba(0,0,0,.3);animation:qmPopIn .22s cubic-bezier(.2,.9,.3,1.2);display:flex;flex-direction:column;max-height:92vh}
.nice-head{position:relative;padding:1.25rem 1.3rem 1rem;background:linear-gradient(135deg,#002C5F 0%,#0a4485 100%);color:#fff}
.nice-head-title{font-size:1.05rem;font-weight:900;letter-spacing:-.02em;margin:0 0 .35rem}
.nice-head-sub{font-size:.78rem;color:rgba(255,255,255,.85);margin:0;line-height:1.5}
.nice-head-close{position:absolute;top:.85rem;right:.85rem;width:1.8rem;height:1.8rem;border:none;background:rgba(255,255,255,.18);color:#fff;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.2rem;line-height:1;padding:0;font-family:inherit}
.nice-head-close:hover{background:rgba(255,255,255,.32)}
.nice-body{padding:1.1rem 1.3rem;overflow-y:auto;flex:1;min-height:0}
.nice-section{margin-bottom:1.2rem}
.nice-section:last-child{margin-bottom:0}
.nice-section-title{font-size:.88rem;font-weight:800;color:#0a0a0a;letter-spacing:-.02em;margin:0 0 .65rem;display:flex;align-items:center;gap:.4rem}
.nice-section-title::before{content:"";display:inline-block;width:3px;height:.9rem;background:#002C5F;border-radius:2px}
.nice-agree-all{display:flex;align-items:center;gap:.6rem;padding:.85rem 1rem;background:#f5f7fb;border:1px solid #dce3ed;border-radius:.65rem;cursor:pointer;user-select:none;margin-bottom:.55rem;transition:background .12s,border-color .12s}
.nice-agree-all:hover{background:#eef2f8;border-color:#bfd0e3}
.nice-agree-all input{width:1.2rem;height:1.2rem;accent-color:#002C5F;cursor:pointer;flex-shrink:0;margin:0}
.nice-agree-all-label{font-size:.92rem;font-weight:800;color:#0a0a0a;letter-spacing:-.01em}
.nice-agree-list{display:flex;flex-direction:column;padding:0 .35rem}
.nice-agree-item{display:flex;align-items:center;gap:.55rem;padding:.5rem 0;font-size:.82rem}
.nice-agree-item input{width:1.05rem;height:1.05rem;accent-color:#002C5F;cursor:pointer;flex-shrink:0;margin:0}
.nice-agree-item label{flex:1;color:#404040;cursor:pointer;line-height:1.4;letter-spacing:-.01em}
.nice-agree-item .nice-req-tag{color:#1428A0;font-weight:800;margin-right:.25rem}
.nice-view{font-size:.72rem;color:#737373;text-decoration:underline;background:none;border:none;cursor:pointer;padding:.2rem .3rem;font-family:inherit;flex-shrink:0}
.nice-view:hover{color:#0a0a0a}
.nice-form{display:flex;flex-direction:column;gap:.7rem}
.nice-field{display:flex;flex-direction:column;gap:.3rem}
.nice-field>label{font-size:.74rem;font-weight:600;color:#525252;letter-spacing:-.01em}
.nice-field .nice-req{color:#dc2626;margin-left:.2rem}
.nice-field input,.nice-field select{width:100%;padding:.7rem .85rem;font-size:.93rem;border:1px solid #e5e7eb;border-radius:.55rem;font-family:inherit;color:#0a0a0a;outline:none;transition:border-color .15s;background:#fff;font-weight:500}
.nice-field input:focus,.nice-field select:focus{border-color:#002C5F}
.nice-field input::placeholder{color:#a3a3a3;font-weight:400}
.nice-row-jumin{display:grid;grid-template-columns:1fr .9rem 2.4rem auto;gap:.4rem;align-items:center}
.nice-jumin-sep{color:#a3a3a3;font-weight:800;font-size:1.05rem;text-align:center;line-height:1}
.nice-jumin-back{text-align:center;padding-left:.3rem!important;padding-right:.3rem!important}
.nice-jumin-mask{color:#a3a3a3;letter-spacing:.18em;font-weight:800;font-size:1rem}
.nice-verify-row{display:none;margin-top:.15rem;padding:.7rem .85rem;background:#f8fafc;border:1px solid #e5e7eb;border-radius:.55rem;flex-direction:column;gap:.5rem}
.nice-verify-row.show{display:flex}
.nice-verify-row .nice-field input{background:#fff}
.nice-verify-bottom{display:flex;justify-content:space-between;align-items:center;gap:.5rem}
.nice-verify-timer{font-size:.72rem;color:#dc2626;font-weight:700}
.nice-verify-resend{padding:.4rem .7rem;background:#fff;color:#404040;border:1px solid #d4d4d8;border-radius:.4rem;font-size:.74rem;font-weight:700;cursor:pointer;font-family:inherit}
.nice-verify-resend:hover{background:#f3f4f6}
.nice-foot{padding:.85rem 1.3rem 1.1rem;background:#fafafa;border-top:1px solid #f0f0f0}
.nice-foot-logo{display:inline-flex;align-items:center;gap:.4rem;font-size:.72rem;font-weight:700;color:#525252;letter-spacing:-.01em;margin-bottom:.55rem}
.nice-foot-logo::before{content:"NICE";display:inline-block;background:#fff;color:#002C5F;border:1.5px solid #002C5F;padding:.12rem .38rem;border-radius:.2rem;font-size:.62rem;font-weight:900;letter-spacing:.04em}
.nice-foot-note{font-size:.66rem;color:#a3a3a3;line-height:1.55;margin:.45rem 0 0}
.nice-submit-btn{width:100%;padding:.95rem;background:#002C5F;color:#fff;border:none;border-radius:.6rem;font-size:.98rem;font-weight:800;cursor:pointer;font-family:inherit;letter-spacing:-.02em;transition:background .15s}
.nice-submit-btn:hover:not(:disabled){background:#001f47}
.nice-submit-btn:disabled{background:#cbd5e1;cursor:not-allowed;color:#737373}

@media (max-width:480px){
  .nice-modal{padding:0}
  .nice-modal-card{max-width:100%;max-height:100vh;height:100vh;border-radius:0}
  .nice-head{padding:1.05rem 1.1rem .9rem;padding-top:calc(1.05rem + env(safe-area-inset-top))}
  .nice-body{padding:1rem 1.1rem}
  .nice-foot{padding:.75rem 1.1rem 1rem;padding-bottom:calc(1rem + env(safe-area-inset-bottom))}
}

/* ===== 현대캐피탈 본인인증 모달 ===== */
.ha-modal{position:fixed;inset:0;z-index:10000;display:none;align-items:flex-start;justify-content:center;background:#fff;animation:qmFadeIn .18s ease;overflow-y:auto}
.ha-modal.open{display:flex}
.ha-backdrop{display:none}
.ha-card{position:relative;width:100%;max-width:480px;background:#fff;display:flex;flex-direction:column;min-height:100vh}
.ha-header{position:sticky;top:0;z-index:5;display:flex;align-items:center;justify-content:center;padding:1.05rem 1.25rem;background:#fff;border-bottom:1px solid transparent}
.ha-header-title{font-size:1rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;margin:0;text-align:center;flex:1}
.ha-close{position:absolute;top:50%;right:1.1rem;transform:translateY(-50%);width:2rem;height:2rem;border:none;background:transparent;color:#0a0a0a;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.5rem;line-height:1;padding:0;font-family:inherit}
.ha-close:hover{opacity:.7}
.ha-body{padding:1.25rem 1.4rem 1rem;flex:1}
.ha-title{font-size:1.6rem;font-weight:800;color:#0a0a0a;letter-spacing:-.03em;line-height:1.3;margin:0 0 .9rem}
.ha-desc{font-size:.92rem;color:#525252;line-height:1.55;letter-spacing:-.01em;margin:0 0 1.8rem}
.ha-field{display:flex;align-items:baseline;gap:1rem;padding:.85rem 0;border-bottom:1px solid #e5e7eb;position:relative}
.ha-field>label{font-size:1.05rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;flex-shrink:0;min-width:4.5rem}
.ha-field input[type="text"],.ha-field input[type="tel"]{flex:1;border:none;outline:none;background:transparent;font-size:1rem;font-weight:600;font-family:inherit;color:#0a0a0a;padding:.1rem 0;letter-spacing:-.01em;min-width:0;width:100%}
.ha-field input::placeholder{color:#cbd5e1}
.ha-jumin-row{flex:1;display:flex;align-items:center;gap:.5rem;min-width:0}
.ha-jumin-row input{flex:0 1 auto;width:6rem}
.ha-jumin-sep{color:#a3a3a3;font-weight:600;font-size:1rem}
.ha-jumin-back{width:1.5rem!important;text-align:center;flex:0 0 1.5rem!important}
.ha-jumin-mask{color:#a3a3a3;letter-spacing:.2em;font-weight:700;font-size:1.05rem;flex-shrink:0}

.ha-carrier-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.55rem;margin:2rem 0 1.2rem}
.ha-carrier-btn{padding:1.05rem .5rem;background:#fff;border:1px solid #e5e7eb;border-radius:.5rem;font-size:.98rem;font-weight:700;color:#525252;cursor:pointer;font-family:inherit;letter-spacing:-.01em;transition:all .12s;line-height:1}
.ha-carrier-btn:hover{border-color:#94B3F2}
.ha-carrier-btn.selected{border:2px solid #3D6FE8;color:#0a0a0a;font-weight:800;padding:calc(1.05rem - 1px) calc(.5rem - 1px)}

.ha-agree-card{display:flex;flex-direction:column;background:#fff;border:1px solid #e5e7eb;border-radius:.55rem;user-select:none;margin-bottom:.6rem;transition:border-color .12s;color:#d4d4d8;overflow:hidden}
.ha-agree-card:hover{border-color:#94B3F2}
.ha-agree-card.checked{color:#3D6FE8}
.ha-agree-head{display:flex;align-items:center;gap:.7rem;padding:1rem 1.1rem;cursor:pointer}
.ha-agree-check{flex-shrink:0;width:22px;height:22px;display:inline-flex;align-items:center;justify-content:center}
.ha-agree-check svg{width:22px;height:22px;display:block}
.ha-agree-card.checked .ha-agree-check svg circle{fill:#3D6FE8;stroke:#3D6FE8}
.ha-agree-card.checked .ha-agree-check svg path{stroke:#fff}
.ha-agree-text{flex:1;font-size:.95rem;color:#0a0a0a;letter-spacing:-.01em;font-weight:500}
.ha-agree-req{color:#0a0a0a;font-weight:700}
.ha-agree-chevron{background:none;border:none;cursor:pointer;padding:.2rem;display:inline-flex;align-items:center;justify-content:center;transition:transform .2s}
.ha-agree-chevron.expanded{transform:rotate(180deg)}
.ha-agree-details{display:none;padding:.45rem .55rem .6rem;background:#f5f6f8;border-top:1px solid #ebeef2}
.ha-agree-details.show{display:block}
.ha-sub-item{display:flex;align-items:center;gap:.85rem;padding:.7rem .9rem;background:transparent;border:none;width:100%;cursor:pointer;font-family:inherit;text-align:left;border-radius:.4rem;transition:background .12s}
.ha-sub-item:hover{background:rgba(0,0,0,.025)}
.ha-sub-check{flex-shrink:0;color:#0a0a0a;width:18px;height:18px;display:inline-flex;align-items:center;justify-content:center}
.ha-sub-label{flex:1;font-size:.95rem;color:#0a0a0a;letter-spacing:-.01em;font-weight:500}
.ha-sub-arrow{flex-shrink:0;color:#a3a3a3;width:18px;height:18px;display:inline-flex;align-items:center;justify-content:center}

.ha-field-phone .ha-phone-row,
.ha-field-code .ha-phone-row{display:flex;align-items:center;gap:.6rem;flex:1;min-width:0}
.ha-phone-row input{flex:1;min-width:0}
.ha-send-btn{flex-shrink:0;padding:.55rem .85rem;background:#f3f4f6;color:#a3a3a3;border:none;border-radius:.4rem;font-size:.82rem;font-weight:700;cursor:not-allowed;font-family:inherit;letter-spacing:-.01em;white-space:nowrap;transition:all .15s}
.ha-send-btn.active{background:#fff;color:#3D6FE8;border:1px solid #BFD2F8;cursor:pointer}
.ha-send-btn.active:hover{background:#F0F4FE}
.ha-send-btn.sent{background:#fff;color:#737373;border:1px solid #e5e7eb;cursor:pointer}
.ha-timer{flex-shrink:0;font-size:.95rem;color:#3D6FE8;font-weight:700;font-variant-numeric:tabular-nums;letter-spacing:.02em}
.ha-timer.expired{color:#a3a3a3}

.ha-footer{position:sticky;bottom:0;padding:.75rem 1.4rem 1.1rem;background:#fff;padding-bottom:calc(1.1rem + env(safe-area-inset-bottom))}
.ha-next-btn{width:100%;padding:1.05rem;background:#e5e7eb;color:#a3a3a3;border:none;border-radius:.55rem;font-size:1.05rem;font-weight:700;cursor:not-allowed;font-family:inherit;letter-spacing:-.02em;transition:all .15s}
.ha-next-btn.active{background:#0a0a0a;color:#fff;cursor:pointer}
.ha-next-btn.active:hover{background:#262626}

@media (min-width:768px){
  .ha-modal{align-items:center;padding:2rem;background:rgba(10,10,10,.55);backdrop-filter:blur(2px)}
  .ha-backdrop{display:block;position:absolute;inset:0;cursor:pointer}
  .ha-card{max-width:480px;min-height:auto;max-height:92vh;border-radius:1.1rem;overflow-y:auto;box-shadow:0 24px 60px rgba(0,0,0,.3);animation:qmPopIn .22s cubic-bezier(.2,.9,.3,1.2)}
  .ha-header{border-bottom:none}
  .ha-footer{position:relative;padding-bottom:1.2rem}
}

/* ===== 신용정보조회 동의 모달 (본인인증 완료 후) ===== */
.ci-modal{position:fixed;inset:0;z-index:10000;display:none;align-items:flex-start;justify-content:center;background:#fff;animation:qmFadeIn .18s ease;overflow-y:auto}
.ci-modal.open{display:flex}
.ci-backdrop{display:none}
.ci-card{position:relative;width:100%;max-width:480px;background:#fff;display:flex;flex-direction:column;min-height:100vh}
.ci-header{position:sticky;top:0;z-index:5;display:flex;align-items:center;justify-content:center;padding:1.05rem 1.25rem;background:#fff}
.ci-header-title{font-size:1rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;margin:0;text-align:center;flex:1}
.ci-close{position:absolute;top:50%;right:1.1rem;transform:translateY(-50%);width:2rem;height:2rem;border:none;background:transparent;color:#0a0a0a;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.5rem;line-height:1;padding:0;font-family:inherit}
.ci-close:hover{opacity:.7}
.ci-body{padding:.5rem 1.1rem 1rem;flex:1}

.ci-agree-card{display:flex;flex-direction:column;background:#fff;border:1px solid #e5e7eb;border-radius:.7rem;margin-bottom:.75rem;overflow:hidden;user-select:none}
.ci-agree-head{display:flex;align-items:flex-start;gap:.75rem;padding:1rem 1.1rem;cursor:pointer}
.ci-agree-check{flex-shrink:0;width:24px;height:24px;display:inline-flex;align-items:center;justify-content:center;margin-top:.05rem}
.ci-agree-check svg{width:24px;height:24px;display:block;color:#d4d4d8}
.ci-agree-card.checked .ci-agree-check svg{color:#3D6FE8}
.ci-agree-card.checked .ci-agree-check svg circle{fill:#3D6FE8;stroke:#3D6FE8}
.ci-agree-card.checked .ci-agree-check svg path{stroke:#fff}
.ci-agree-text{flex:1;font-size:1rem;color:#0a0a0a;letter-spacing:-.02em;font-weight:600;line-height:1.45;padding-top:.05rem}
.ci-req{color:#0a0a0a;font-weight:700;margin-right:.15rem}
.ci-agree-toggle{flex-shrink:0;background:none;border:none;cursor:pointer;padding:.2rem;display:inline-flex;align-items:center;justify-content:center;color:#737373;transition:transform .2s;margin-top:.1rem}
.ci-agree-toggle.expanded{transform:rotate(180deg)}
.ci-agree-view-only{flex-shrink:0;background:none;border:none;cursor:pointer;padding:.2rem;display:inline-flex;align-items:center;justify-content:center;color:#737373;margin-top:.1rem}

.ci-agree-details{display:none;padding:1rem 1.1rem 1.15rem;background:#f5f6f8;border-top:1px solid #ebeef2;flex-direction:column;gap:.1rem}
.ci-agree-details.show{display:flex}
.ci-sub-item{display:flex;align-items:center;gap:.85rem;padding:.45rem 0;background:transparent;border:none;width:100%;cursor:pointer;font-family:inherit;text-align:left}
.ci-sub-check{flex-shrink:0;color:#0a0a0a;width:18px;height:18px;display:inline-flex;align-items:center;justify-content:center}
.ci-sub-label{flex:1;font-size:.95rem;color:#0a0a0a;letter-spacing:-.01em;font-weight:500;line-height:1.4}
.ci-sub-view{flex-shrink:0;font-size:.82rem;color:#a3a3a3;letter-spacing:-.01em}

.ci-footer{position:sticky;bottom:0;padding:.6rem 1.1rem 1rem;background:#fff;padding-bottom:calc(1rem + env(safe-area-inset-bottom))}
.ci-next-btn{width:100%;padding:1.05rem;background:#3D6FE8;color:#fff;border:none;border-radius:.55rem;font-size:1.05rem;font-weight:700;cursor:pointer;font-family:inherit;letter-spacing:-.02em;transition:background .15s}
.ci-next-btn:hover:not(:disabled){background:#2858E0}
.ci-next-btn:disabled{background:#cbd5e1;cursor:not-allowed;color:#737373}

@media (min-width:768px){
  .ci-modal{align-items:center;padding:2rem;background:rgba(10,10,10,.55);backdrop-filter:blur(2px)}
  .ci-backdrop{display:block;position:absolute;inset:0;cursor:pointer}
  .ci-card{max-width:480px;min-height:auto;max-height:92vh;border-radius:1.1rem;overflow-y:auto;box-shadow:0 24px 60px rgba(0,0,0,.3);animation:qmPopIn .22s cubic-bezier(.2,.9,.3,1.2)}
  .ci-footer{position:relative;padding-bottom:1.1rem}
}

/* ===== 계약 단계 안내 모달 (신용정보 동의 후) ===== */
.cs-modal{position:fixed;inset:0;z-index:10000;display:none;align-items:flex-start;justify-content:center;background:#fff;animation:qmFadeIn .18s ease;overflow-y:auto}
.cs-modal.open{display:flex}
.cs-backdrop{display:none}
.cs-card{position:relative;width:100%;max-width:480px;background:#fff;display:flex;flex-direction:column;min-height:100vh}
.cs-header{position:sticky;top:0;z-index:5;display:flex;align-items:center;justify-content:center;padding:1.05rem 1.25rem;background:#fff}
.cs-header-title{font-size:1rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;margin:0;text-align:center;flex:1}
.cs-close{position:absolute;top:50%;right:1.1rem;transform:translateY(-50%);width:2rem;height:2rem;border:none;background:transparent;color:#0a0a0a;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.5rem;line-height:1;padding:0;font-family:inherit}
.cs-close:hover{opacity:.7}
.cs-body{padding:1rem 1.4rem 1.5rem;flex:1}
.cs-title{font-size:1.6rem;font-weight:800;color:#0a0a0a;letter-spacing:-.03em;line-height:1.3;margin:0 0 2.5rem}

.cs-steps{display:flex;flex-direction:column;position:relative}
.cs-step-row{position:relative;display:flex;align-items:flex-start;gap:1.1rem;padding-bottom:1.7rem}
.cs-step-row:last-child{padding-bottom:0}
.cs-step-row:not(:last-child)::after{content:"";position:absolute;left:31px;top:82px;bottom:.5rem;width:1.5px;background:#e5e7eb;z-index:0}
.cs-step-icon-wrap{position:relative;display:flex;flex-direction:column;align-items:center;gap:.4rem;flex-shrink:0;width:64px;z-index:1}
.cs-step-icon{width:62px;height:62px;border-radius:50%;background:#f0f4fe;display:flex;align-items:center;justify-content:center;color:#3D6FE8}
.cs-step-icon svg{width:30px;height:30px}
.cs-step-num{font-size:.7rem;font-weight:800;color:#3D6FE8;background:#f0f4fe;padding:.18rem .55rem;border-radius:.35rem;letter-spacing:.04em}
.cs-step-text{flex:1;padding-top:1.05rem}
.cs-step-title{font-size:1.05rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;line-height:1.4;margin:0}
.cs-step-sub{font-size:.85rem;color:#737373;font-weight:500;margin-top:.35rem;line-height:1.5;letter-spacing:-.01em}

/* 빨간 + 배지 (STEP 2의 카드) */
.cs-icon-badge-plus{position:absolute;right:-2px;bottom:-2px;width:18px;height:18px;border-radius:50%;background:#dc2626;color:#fff;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:900;line-height:1;border:2px solid #f0f4fe}
.cs-icon-badge-check{position:absolute;right:-2px;bottom:-2px;width:18px;height:18px;border-radius:50%;background:#22c55e;color:#fff;display:flex;align-items:center;justify-content:center;border:2px solid #f0f4fe}
.cs-icon-rel{position:relative;display:flex;align-items:center;justify-content:center;width:30px;height:30px}

/* 미리 준비해 주세요 섹션 */
.cs-prep{margin-top:2.5rem;padding-top:1.8rem;border-top:8px solid #f5f6f8;margin-left:-1.4rem;margin-right:-1.4rem;padding-left:1.4rem;padding-right:1.4rem}
.cs-prep-title{font-size:1.25rem;font-weight:800;color:#0a0a0a;letter-spacing:-.03em;margin:0 0 1.3rem}
.cs-prep-row{display:flex;align-items:flex-start;gap:1.1rem;padding:.7rem 0}
.cs-prep-row + .cs-prep-row{border-top:1px solid #f0f0f0;padding-top:1.4rem;margin-top:.5rem}
.cs-prep-icon{width:46px;height:46px;border-radius:.45rem;background:#f0f4fe;display:flex;align-items:center;justify-content:center;color:#3D6FE8;flex-shrink:0;position:relative}
.cs-prep-icon svg{width:26px;height:26px}
.cs-prep-info{flex:1;padding-top:.3rem}
.cs-prep-name{font-size:1rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;margin:0}
.cs-prep-sub{font-size:.85rem;color:#737373;font-weight:500;margin-top:.3rem;line-height:1.5;letter-spacing:-.01em}

.cs-footer{position:sticky;bottom:0;padding:.6rem 1.1rem 1rem;background:#fff;padding-bottom:calc(1rem + env(safe-area-inset-bottom))}
.cs-next-btn{width:100%;padding:1.05rem;background:#3D6FE8;color:#fff;border:none;border-radius:.55rem;font-size:1.05rem;font-weight:700;cursor:pointer;font-family:inherit;letter-spacing:-.02em;transition:background .15s}
.cs-next-btn:hover{background:#2858E0}

@media (min-width:768px){
  .cs-modal{align-items:center;padding:2rem;background:rgba(10,10,10,.55);backdrop-filter:blur(2px)}
  .cs-backdrop{display:block;position:absolute;inset:0;cursor:pointer}
  .cs-card{max-width:480px;min-height:auto;max-height:92vh;border-radius:1.1rem;overflow-y:auto;box-shadow:0 24px 60px rgba(0,0,0,.3);animation:qmPopIn .22s cubic-bezier(.2,.9,.3,1.2)}
  .cs-footer{position:relative;padding-bottom:1.1rem}
}

/* ===== 금융사기 안내 모달 (계약 단계 안내 후) ===== */
.ff-modal{position:fixed;inset:0;z-index:10000;display:none;align-items:flex-start;justify-content:center;background:#fff;animation:qmFadeIn .18s ease;overflow-y:auto}
.ff-modal.open{display:flex}
.ff-backdrop{display:none}
.ff-card{position:relative;width:100%;max-width:480px;background:#fff;display:flex;flex-direction:column;min-height:100vh}
.ff-header{position:sticky;top:0;z-index:5;display:flex;align-items:center;justify-content:center;padding:1.05rem 1.25rem;background:#fff;border-bottom:1px solid #f0f0f0}
.ff-header-title{font-size:1rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;margin:0;text-align:center;flex:1}
.ff-close{position:absolute;top:50%;right:1.1rem;transform:translateY(-50%);width:2rem;height:2rem;border:none;background:transparent;color:#0a0a0a;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.5rem;line-height:1;padding:0;font-family:inherit}
.ff-close:hover{opacity:.7}
.ff-body{padding:1.5rem 1.4rem 1.5rem;flex:1}
.ff-title{font-size:1.55rem;font-weight:800;color:#0a0a0a;letter-spacing:-.03em;line-height:1.3;margin:0 0 1.8rem}
.ff-subhead{font-size:1.02rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;line-height:1.45;margin:0 0 1rem}
.ff-list{list-style:none;padding:0;margin:0 0 1.6rem;display:flex;flex-direction:column;gap:.65rem}
.ff-list li{position:relative;padding-left:.95rem;font-size:.93rem;color:#525252;letter-spacing:-.01em;line-height:1.55;font-weight:500}
.ff-list li::before{content:"·";position:absolute;left:.15rem;top:0;color:#525252;font-weight:700}
.ff-footnote{font-size:.95rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;line-height:1.55;margin:0}

.ff-footer{position:sticky;bottom:0;display:flex;gap:.55rem;padding:.6rem 1.1rem 1rem;background:#fff;padding-bottom:calc(1rem + env(safe-area-inset-bottom))}
.ff-btn{flex:1;padding:1.05rem .5rem;border:none;border-radius:.55rem;font-size:1.02rem;font-weight:700;cursor:pointer;font-family:inherit;letter-spacing:-.02em;transition:background .15s}
.ff-btn-stop{background:#f0f4fe;color:#3D6FE8}
.ff-btn-stop:hover{background:#DEE7FB}
.ff-btn-go{background:#3D6FE8;color:#fff}
.ff-btn-go:hover{background:#2858E0}

@media (min-width:768px){
  .ff-modal{align-items:center;padding:2rem;background:rgba(10,10,10,.55);backdrop-filter:blur(2px)}
  .ff-backdrop{display:block;position:absolute;inset:0;cursor:pointer}
  .ff-card{max-width:480px;min-height:auto;max-height:92vh;border-radius:1.1rem;overflow-y:auto;box-shadow:0 24px 60px rgba(0,0,0,.3);animation:qmPopIn .22s cubic-bezier(.2,.9,.3,1.2)}
  .ff-footer{position:relative;padding-bottom:1.1rem}
}

/* ===== 면허증 확인 모달 (금융사기 안내 후) ===== */
.dlv-modal{position:fixed;inset:0;z-index:10000;display:none;align-items:flex-start;justify-content:center;background:#fff;animation:qmFadeIn .18s ease;overflow-y:auto}
.dlv-modal.open{display:flex}
.dlv-backdrop{display:none}
.dlv-card{position:relative;width:100%;max-width:480px;background:#fff;display:flex;flex-direction:column;min-height:100vh}
.dlv-header{position:sticky;top:0;z-index:5;display:flex;align-items:center;justify-content:center;padding:1.05rem 1.25rem;background:#fff}
.dlv-header-title{font-size:1rem;font-weight:700;color:#0a0a0a;letter-spacing:-.02em;margin:0;text-align:center;flex:1}
.dlv-close{position:absolute;top:50%;right:1.1rem;transform:translateY(-50%);width:2rem;height:2rem;border:none;background:transparent;color:#0a0a0a;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.5rem;line-height:1;padding:0;font-family:inherit}
.dlv-close:hover{opacity:.7}
.dlv-body{padding:1rem 1.4rem 1.5rem;flex:1}
.dlv-title{font-size:1.55rem;font-weight:800;color:#0a0a0a;letter-spacing:-.03em;line-height:1.3;margin:0 0 1.5rem}

/* 면허증 카드 (일러스트 mockup) */
.dlv-license-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:.85rem;padding:1rem 1.1rem;margin-bottom:2rem;box-shadow:0 1px 3px rgba(0,0,0,.04);font-family:inherit}
.dlv-lic-top{display:flex;gap:.85rem;margin-bottom:.7rem}
.dlv-lic-type{flex-shrink:0;font-size:.7rem;line-height:1.35;color:#0a0a0a}
.dlv-lic-type strong{display:block;font-weight:800;margin-top:.1rem;font-size:.75rem}
.dlv-lic-doc{flex:1;font-size:.78rem;font-weight:800;color:#0a0a0a}
.dlv-lic-doc small{font-weight:600;color:#525252}
.dlv-lic-mid{display:flex;gap:.8rem;align-items:stretch}
.dlv-lic-photo{flex-shrink:0;width:84px;height:104px;background:#dbeafe;border-radius:.3rem;display:flex;align-items:flex-end;justify-content:center;overflow:hidden;position:relative}
.dlv-lic-photo svg{width:100%;height:auto;display:block}
.dlv-lic-info{flex:1;display:flex;flex-direction:column;gap:.45rem;padding-top:.1rem}
.dlv-lic-row2{display:flex;gap:1.2rem}
.dlv-lic-row2-col{flex:1}
.dlv-lic-meta{font-size:.65rem;color:#525252;margin-bottom:.1rem}
.dlv-lic-val{font-size:.82rem;font-weight:800;color:#0a0a0a;letter-spacing:-.01em}
.dlv-lic-name{font-size:.85rem;font-weight:700;color:#0a0a0a;margin-top:.1rem}
.dlv-lic-rrn{font-size:.78rem;color:#0a0a0a;font-weight:600;letter-spacing:.02em}
.dlv-lic-blur{height:6px;background:#f0f0f0;border-radius:3px}
.dlv-lic-foot{display:flex;justify-content:space-between;font-size:.7rem;color:#0a0a0a;margin-top:.3rem}
.dlv-lic-foot strong{font-weight:700}
.dlv-lic-sub-photo{flex-shrink:0;width:38px;display:flex;flex-direction:column;align-items:center;gap:.15rem}
.dlv-lic-sub-photo-img{width:38px;height:46px;background:#dbeafe;border-radius:.2rem;display:flex;align-items:flex-end;justify-content:center;overflow:hidden}
.dlv-lic-sub-photo-img svg{width:100%;height:auto;display:block}
.dlv-lic-sub-code{font-size:.6rem;font-weight:700;color:#525252;letter-spacing:.04em}

/* 정보입력 섹션 */
.dlv-section{margin-bottom:1.8rem}
.dlv-section-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:.7rem}
.dlv-section-title{font-size:1.2rem;font-weight:800;color:#0a0a0a;letter-spacing:-.02em;margin:0}
.dlv-autofill{display:inline-flex;align-items:center;gap:.4rem;background:transparent;border:none;font-family:inherit;font-size:.88rem;color:#a3a3a3;font-weight:500;cursor:pointer;padding:.3rem 0;letter-spacing:-.01em;transition:color .12s}
.dlv-autofill:hover{color:#525252}
.dlv-autofill.active{color:#3D6FE8;font-weight:700}
.dlv-autofill-circle{width:18px;height:18px;border-radius:50%;border:1.5px solid currentColor;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;color:#d4d4d8;transition:all .12s}
.dlv-autofill.active .dlv-autofill-circle{background:#3D6FE8;border-color:#3D6FE8;color:#fff}
.dlv-autofill-circle svg{width:11px;height:11px}
.dlv-desc{font-size:.93rem;color:#525252;line-height:1.55;letter-spacing:-.01em;margin:0 0 .55rem}
.dlv-note-asterisk{font-size:.85rem;color:#737373;font-weight:500;margin:0 0 1.5rem;letter-spacing:-.01em}

/* 폼 (밑줄 input) */
.dlv-form{display:flex;flex-direction:column;gap:0}
.dlv-row-2{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:.5rem}
.dlv-field{position:relative;border-bottom:1px solid #d4d4d8;padding:.3rem 0;margin-bottom:1rem;transition:border-color .12s}
.dlv-field:focus-within{border-bottom-color:#0a0a0a}
.dlv-field input,.dlv-field select{width:100%;border:none;outline:none;background:transparent;padding:.8rem 0 .65rem;font-size:1.05rem;font-family:inherit;color:#0a0a0a;font-weight:600;-webkit-appearance:none;-moz-appearance:none;appearance:none;letter-spacing:-.01em}
.dlv-field input::placeholder{color:#cbd5e1;font-weight:500}
.dlv-field select{cursor:pointer;padding-right:1.5rem}
.dlv-field select:invalid,.dlv-field select option[value=""]{color:#cbd5e1}
.dlv-select-arrow{position:absolute;right:.1rem;top:50%;transform:translateY(-50%);color:#a3a3a3;pointer-events:none}
.dlv-notes{margin:.5rem 0 1.5rem;display:flex;flex-direction:column;gap:.5rem;padding:0}
.dlv-notes li{position:relative;padding-left:.95rem;font-size:.85rem;color:#737373;letter-spacing:-.01em;line-height:1.55;font-weight:500;list-style:none}
.dlv-notes li::before{content:"·";position:absolute;left:.15rem;top:0;font-weight:700}

/* 렌터카 이용 확인사항 / 동의 카드 */
.dlv-check-card{background:#fff;border:1px solid #e5e7eb;border-radius:.65rem;overflow:hidden;margin-bottom:.7rem}
.dlv-check-item{display:flex;align-items:center;gap:.85rem;padding:1.05rem 1.1rem;cursor:pointer;background:transparent;border:none;width:100%;font-family:inherit;text-align:left;border-bottom:1px solid #f0f0f0}
.dlv-check-item:last-child{border-bottom:none}
.dlv-check-item:hover{background:#fafafa}
.dlv-check-icon{flex-shrink:0;color:#a3a3a3;width:18px;height:18px;display:inline-flex;align-items:center;justify-content:center}
.dlv-check-item.checked .dlv-check-icon{color:#0a0a0a}
.dlv-check-label{flex:1;font-size:.95rem;color:#0a0a0a;letter-spacing:-.01em;font-weight:500;line-height:1.4}
.dlv-check-arrow{flex-shrink:0;color:#a3a3a3;display:inline-flex;align-items:center;justify-content:center}

/* 동의 카드 (펼침형) */
.dlv-agree-card{background:#fff;border:1px solid #e5e7eb;border-radius:.65rem;overflow:hidden;user-select:none}
.dlv-agree-head{display:flex;align-items:flex-start;gap:.75rem;padding:1.05rem 1.1rem;cursor:pointer}
.dlv-agree-check{flex-shrink:0;width:22px;height:22px;display:inline-flex;align-items:center;justify-content:center;margin-top:.05rem;color:#d4d4d8}
.dlv-agree-check svg{width:22px;height:22px;display:block}
.dlv-agree-card.checked .dlv-agree-check{color:#3D6FE8}
.dlv-agree-card.checked .dlv-agree-check svg circle{fill:#3D6FE8;stroke:#3D6FE8}
.dlv-agree-card.checked .dlv-agree-check svg path{stroke:#fff}
.dlv-agree-text{flex:1;font-size:.95rem;color:#0a0a0a;letter-spacing:-.01em;font-weight:500;line-height:1.45;padding-top:.05rem}
.dlv-agree-req{font-weight:600;margin-right:.15rem}
.dlv-agree-toggle{flex-shrink:0;background:none;border:none;cursor:pointer;padding:.2rem;display:inline-flex;align-items:center;justify-content:center;color:#737373;transition:transform .2s;margin-top:.1rem}
.dlv-agree-toggle.expanded{transform:rotate(180deg)}
.dlv-agree-details{display:none;padding:1rem 1.1rem 1.15rem;background:#f5f6f8;border-top:1px solid #ebeef2;color:#525252;font-size:.85rem;line-height:1.55;letter-spacing:-.01em}
.dlv-agree-details.show{display:block}

.dlv-footer{position:sticky;bottom:0;padding:.6rem 1.1rem 1rem;background:#fff;padding-bottom:calc(1rem + env(safe-area-inset-bottom))}
.dlv-next-btn{width:100%;padding:1.05rem;background:#e5e7eb;color:#a3a3a3;border:none;border-radius:.55rem;font-size:1.05rem;font-weight:700;cursor:not-allowed;font-family:inherit;letter-spacing:-.02em;transition:all .15s}
.dlv-next-btn.active{background:#3D6FE8;color:#fff;cursor:pointer}
.dlv-next-btn.active:hover{background:#2858E0}

@media (min-width:768px){
  .dlv-modal{align-items:center;padding:2rem;background:rgba(10,10,10,.55);backdrop-filter:blur(2px)}
  .dlv-backdrop{display:block;position:absolute;inset:0;cursor:pointer}
  .dlv-card{max-width:480px;min-height:auto;max-height:92vh;border-radius:1.1rem;overflow-y:auto;box-shadow:0 24px 60px rgba(0,0,0,.3);animation:qmPopIn .22s cubic-bezier(.2,.9,.3,1.2)}
  .dlv-footer{position:relative;padding-bottom:1.1rem}
}

.empty-state{text-align:center;padding:4rem 2rem;color:#a3a3a3}
.loading{text-align:center;padding:4rem 2rem;color:#737373}

@media (max-width: 768px) {
  .navlist{display:none !important} header nav{display:none !important}
  .car-title{font-size:1.15rem;line-height:1.2}
  .car-title::after{margin-top:.3rem;width:1.6rem;height:2px}
  .car-price{font-size:1.15rem}
  .car-price-label{font-size:.62rem}
  .trim-grid{grid-template-columns:1fr}
  .section{padding:1.5rem}
  .topright{display:none}
  /* main padding-top 은 인라인 1rem 그대로 — backbar border 에서 car-hero 까지 시각 간격 1rem 매칭 */
  main{padding-bottom:9rem!important}
  /* 빠른출고 카드도 다른 박스와 동일 간격 */
  .lim-card{margin-bottom:1rem}
}
</style>
</head>
<body>
<?php require __DIR__ . '/../includes/rental_header.php'; ?>

<div class="page-backbar">
  <button class="back-btn" id="backBtn" onclick="history.length>1?history.back():(window.location.href='index.php')" aria-label="목록으로">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    <span id="backBtnLabel">뒤로</span>
  </button>
</div>

<main style="max-width:1200px;margin:0 auto;padding:1rem 1rem 7rem">
  <div id="loading" class="loading">차량 정보를 불러오는 중...</div>
  <div id="content" style="display:none">
    <!-- 차량 이미지 -->
    <div class="car-hero">
      <img id="carImage" class="car-image" alt="">
      <div class="car-info-row">
        <h1 id="carTitle" class="car-title"></h1>
        <div class="car-price-wrap">
          <div class="car-price-label">차량가격</div>
          <div id="carPrice" class="car-price"></div>
        </div>
      </div>
      <!-- 색상 표시 (트림 선택 시 자동 갱신) -->
      <div class="hero-colors" id="heroColors" style="display:none">
        <div class="hero-color-row">
          <span class="hero-color-label">외장</span>
          <div class="hero-color-swatches" id="heroExtColors"></div>
          <span class="hero-color-name" id="heroExtName"></span>
        </div>
        <div class="hero-color-row">
          <span class="hero-color-label">내장</span>
          <div class="hero-color-swatches" id="heroIntColors"></div>
          <span class="hero-color-name" id="heroIntName"></span>
        </div>
      </div>

      <!-- 선택 요약 (차량 사진 아래) -->
      <div class="sel-summary" id="selSummary" style="display:none">
        <div class="sel-summary-title">선택 내역</div>
        <div class="sel-summary-rows" id="selSummaryRows"></div>
      </div>
    </div>

    <!-- 빠른출고 차량 카드 (새 디자인) -->
    <div class="lim-card" id="limCard" style="display:none">
      <!-- 상단 헤더 스트립 -->
      <div class="lim-header-strip">
        <div class="lim-header-strip-left">
          <span class="lim-stock-pill" id="limStockBadge">잔여 0대</span>
          <span class="lim-discount-badge" id="limDiscountBadge" style="display:none"></span>
        </div>
        <div class="lim-header-strip-right">
          <span class="lim-header-tag lim-header-tag-quick">⚡ 빠른출고</span>
          <span class="lim-header-sep">·</span>
          <span class="lim-header-tag lim-header-tag-type">장기렌트</span>
        </div>
      </div>

      <!-- 카드 본문 -->
      <div class="lim-body">
      <div class="lim-top">
        <div class="lim-title-wrap">
          <h2 class="lim-model" id="limModelName"></h2>
          <p class="lim-subtitle" id="limSubtitle"></p>
        </div>
        <div class="lim-img-wrap">
          <img class="lim-img" id="limCardImg" alt="">
        </div>
      </div>

      <div class="lim-divider"></div>

      <div class="lim-specs">
        <div class="lim-row">
          <div class="lim-row-label">차량가(옵션포함)</div>
          <div class="lim-row-value" id="limCarPriceVal">-</div>
        </div>
        <div class="lim-row lim-row-stack">
          <div class="lim-row-label">월 납입금</div>
          <div class="lim-price-col">
            <span class="lim-price-final" id="limPriceFinal">-</span>
          </div>
        </div>
      </div>

      <div class="lim-colors">
        <div class="lim-color-row">
          <span class="lim-color-label">외장색상</span>
          <span class="lim-color-circle" id="limExtCircle"></span>
          <span class="lim-color-name" id="limExtName"></span>
        </div>
        <div class="lim-color-row">
          <span class="lim-color-label">내장색상</span>
          <span class="lim-color-circle" id="limIntCircle"></span>
          <span class="lim-color-name" id="limIntName"></span>
        </div>
      </div>

      <div class="lim-opts">
        <div class="lim-opts-row">
          <div class="lim-opts-label">옵션</div>
          <ul class="lim-opts-list" id="limOptsList"></ul>
        </div>
      </div>
      </div><!-- /lim-body -->
    </div>

    <!-- 상품 종류 (장기렌트 / 리스) — 가장 근본적 선택, 맨 위 -->
    <div class="product-pick">
      <div class="rental-label">상품 종류<button class="rental-help" type="button" data-tip="[ 장기렌트 ]&#10;신용점수에 영향 없음 — 신용 평가나 대출한도에 잡히지 않아요.&#10;보험·세금·정기검사 같은 운영비가 월 납입금에 포함돼서 관리가 편해요.&#10;차 명의는 렌터카 회사 소유라 사고·정비 부담이 적어요.&#10;&#10;[ 리스 ]&#10;금융 상품이라 이용 시 신용점수에 반영되고, 본인의 대출한도에 차감돼요.&#10;주담대·신용대출 계획이 있다면 한도 영향을 미리 확인하세요.&#10;차 명의는 본인 또는 회사로 선택 가능해요." aria-label="설명 보기">?</button></div>
      <div class="rental-btns" data-group="product">
        <button type="button" class="rental-btn selected" data-value="rent">장기렌트</button>
        <button type="button" class="rental-btn" data-value="lease">리스</button>
      </div>
    </div>

    <!-- 트림 선택 + 색상 선택 통합 아코디언 (모바일 전용 접힘) -->
    <div class="acc-block" data-acc="trim">
      <button class="acc-header" type="button" onclick="toggleAcc(this)">
        <span class="acc-header-title">세부모델·트림·색상 선택</span>
        <span class="acc-header-hint">탭하여 펼치기</span>
        <svg class="acc-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      </button>
      <div class="acc-body">
        <div class="section" id="modelContainer"></div>
        <div class="color-section" id="colorSection" style="display:none">
          <div class="color-group" id="exteriorColorGroup">
            <div class="color-group-title">외장 색상</div>
            <div class="color-list" id="exteriorColorList"></div>
          </div>
          <div class="color-group" id="interiorColorGroup" style="display:none">
            <div class="color-group-title">내장 색상</div>
            <div class="color-list" id="interiorColorList"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- 렌탈 조건 아코디언 -->
    <div class="acc-block open" data-acc="rental">
      <button class="acc-header" type="button" onclick="toggleAcc(this)">
        <span class="acc-header-title">렌탈 조건</span>
        <svg class="acc-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
      </button>
      <div class="acc-body">
    <div class="rental-options">
      <div class="rental-row">
        <div class="rental-label">이용기간<button class="rental-help" type="button" data-tip="차를 빌리는 기간이에요.&#10;&#10;보통 길게 약정할수록 월 납부금이 가벼워져요.&#10;&#10;3~5년 사이에서 편한 기간으로 골라보세요." aria-label="설명 보기">?</button></div>
        <div class="rental-btns" data-group="period">
          <button class="rental-btn" data-value="36">36개월</button>
          <button class="rental-btn" data-value="48">48개월</button>
          <button class="rental-btn selected" data-value="60">60개월</button>
        </div>
      </div>
      <div class="rental-row" id="mileageRow">
        <div class="rental-label">연간 약정 주행거리<button class="rental-help" type="button" data-tip="매년이 아니라, 계약 전체 기간의 누적 주행거리 기준이에요.&#10;&#10;예) 연 2만km × 4년 = 총 8만km 약정.&#10;어느 해엔 많이, 어느 해엔 적게 타도 합산해서 약정 거리만 안 넘으면 OK.&#10;&#10;계약 종료 시 약정치 초과분은 km당 추가 요금이 부과돼요." aria-label="설명 보기">?</button></div>
        <div class="rental-btns" data-group="mileage">
          <button class="rental-btn selected" data-value="10000">1만km</button>
          <button class="rental-btn" data-value="20000">2만km</button>
          <button class="rental-btn" data-value="30000">3만km</button>
          <button class="rental-btn" data-value="40000">4만km</button>
          <button class="rental-btn" data-value="unlimited">무제한</button>
        </div>
      </div>
      <div class="rental-row" id="prepayRow">
        <div class="rental-label">선납금<button class="rental-help" type="button" data-tip="계약 시작 시점에 미리 납부하는 금액이에요.&#10;그만큼 매달 내는 렌트료가 낮아집니다.&#10;&#10;여유 자금이 있을 때 월 부담을 줄이는 방법으로 활용하세요.&#10;&#10;⚠ 선납금은 계약이 끝나도 돌려받지 못하는 비용이에요." aria-label="설명 보기">?</button></div>
        <div class="rental-btns" data-group="prepay">
          <button class="rental-btn" data-value="0">없음</button>
          <button class="rental-btn" data-value="10">10%</button>
          <button class="rental-btn" data-value="20">20%</button>
          <button class="rental-btn selected" data-value="30">30%</button>
        </div>
      </div>
      <div class="rental-row">
        <div class="rental-label">보증금<button class="rental-help" type="button" data-tip="계약 시작 시 맡기고, 계약 종료 시 전액 돌려받는 금액이에요.&#10;&#10;맡긴 금액의 이자만큼 매달 렌트료가 할인됩니다.&#10;&#10;원금은 그대로 보존되면서 이자 효과만큼 월 납입금이 줄어드는 구조예요." aria-label="설명 보기">?</button></div>
        <div class="rental-btns" data-group="deposit">
          <button class="rental-btn selected" data-value="0">없음</button>
          <button class="rental-btn" data-value="10">10%</button>
          <button class="rental-btn" data-value="20">20%</button>
          <button class="rental-btn" data-value="30">30%</button>
        </div>
      </div>
    </div>
      </div><!-- /acc-body 렌탈 -->
    </div><!-- /acc-block 렌탈 -->
  </div>

  <!-- CTA -->
  <div class="cta-box" id="ctaBox" style="display:none">
    <div class="cta-price-bar">
      <span class="cta-price-label">월 납입금</span>
      <span class="cta-price-value" id="ctaPriceValue">-</span>
    </div>
    <div class="cta-btns">
      <button class="cta-btn cta-primary" onclick="submitQuote()">견적 문의</button>
      <button class="cta-btn cta-hyundai" onclick="openNiceConsent()">현대캐피탈 다이렉트 견적</button>
    </div>
  </div>

  <div id="emptyState" class="empty-state" style="display:none">
    해당 차량의 정보를 찾을 수 없습니다.
  </div>
</main>

<!-- 카카오 로그인 팝업 (데스크탑) -->
<div class="kakao-overlay" id="kakaoOverlay" role="dialog" aria-modal="true" aria-label="카카오 로그인">
  <div class="kakao-overlay-bd" onclick="closeKakaoOverlay()"></div>
  <div class="kakao-frame-wrap">
    <iframe class="kakao-frame" id="kakaoFrame" src="" title="카카오 로그인"></iframe>
  </div>
</div>

<!-- 견적 문의 모달 -->
<div class="quote-modal" id="quoteModal" style="display:none" role="dialog" aria-modal="true" aria-labelledby="quoteModalTitle">
  <div class="quote-modal-backdrop" onclick="closeQuoteModal()"></div>
  <div class="quote-modal-card">
    <div class="quote-modal-header">
      <div class="quote-modal-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0a0a0a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <h3 class="quote-modal-title" id="quoteModalTitle">확인 버튼을 누르시면 견적이 접수됩니다.</h3>
      <p class="quote-modal-sub">담당자가 확인 후 연락드릴 예정입니다.</p>
    </div>
    <div class="quote-modal-body" id="quoteModalBody"></div>
    <div class="quote-contact" id="quoteContact">
      <div class="qc-field">
        <label>이름<span class="qc-req">*</span></label>
        <input id="qcName" type="text" placeholder="홍길동" autocomplete="name">
      </div>
      <div class="qc-field">
        <label>연락처<span class="qc-req">*</span></label>
        <input id="qcPhone" type="tel" placeholder="010-1234-5678" autocomplete="tel" inputmode="tel">
      </div>
    </div>
    <div class="quote-signup" id="quoteSignup">
      <div class="qs-head">
        <p class="qs-title">간편 가입하고 더 편하게</p>
      </div>
      <ul class="qs-benefits">
        <li>견적 저장 · 비교</li>
        <li>내 차량 관리</li>
        <li>계약 진행상황 확인</li>
      </ul>
      <button class="qs-btn-kakao" onclick="openKakaoLogin()">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><ellipse cx="9" cy="8" rx="8" ry="7" fill="#191919"/><path d="M5 8c0-1.1.9-2 2-2h4c1.1 0 2 .9 2 2 0 .8-.5 1.5-1.2 1.8L13 12H9.5l-.8-1.5C8.5 10.8 8.2 11 8 11c-1.7 0-3-1.3-3-3z" fill="#FEE500"/></svg>
        <span>카카오톡 간편 가입</span>
      </button>
    </div>
    <div class="quote-modal-footer">
      <button class="quote-modal-btn quote-modal-btn-cancel" onclick="closeQuoteModal()">취소</button>
      <button class="quote-modal-btn" onclick="confirmQuote()">확인</button>
    </div>
  </div>
</div>

<!-- NICE 신용정보 동의 모달 (현대캐피탈 다이렉트 견적) -->
<div class="nice-modal" id="niceModal" role="dialog" aria-modal="true" aria-labelledby="niceModalTitle">
  <div class="nice-modal-backdrop" onclick="closeNiceConsent()"></div>
  <div class="nice-modal-card">
    <div class="nice-head">
      <button class="nice-head-close" onclick="closeNiceConsent()" aria-label="닫기">&times;</button>
      <h3 class="nice-head-title" id="niceModalTitle">현대캐피탈 다이렉트 견적</h3>
      <p class="nice-head-sub">정확한 견적을 위해 본인확인 및<br>신용정보 조회 동의가 필요합니다.</p>
    </div>

    <div class="nice-body">
      <!-- 약관 동의 -->
      <div class="nice-section">
        <h4 class="nice-section-title">약관 동의</h4>
        <label class="nice-agree-all" for="niceAgreeAll">
          <input type="checkbox" id="niceAgreeAll" onchange="niceAgreeAllToggle(this.checked)">
          <span class="nice-agree-all-label">아래 모든 항목에 동의합니다</span>
        </label>
        <div class="nice-agree-list">
          <div class="nice-agree-item">
            <input type="checkbox" id="niceAgree1" class="nice-agree-req" onchange="niceAgreeChange()">
            <label for="niceAgree1"><span class="nice-req-tag">[필수]</span>개인(신용)정보 수집·이용 동의</label>
            <button type="button" class="nice-view" onclick="niceViewTerm(1)">내용 보기</button>
          </div>
          <div class="nice-agree-item">
            <input type="checkbox" id="niceAgree2" class="nice-agree-req" onchange="niceAgreeChange()">
            <label for="niceAgree2"><span class="nice-req-tag">[필수]</span>개인(신용)정보 제3자 제공 동의</label>
            <button type="button" class="nice-view" onclick="niceViewTerm(2)">내용 보기</button>
          </div>
          <div class="nice-agree-item">
            <input type="checkbox" id="niceAgree3" class="nice-agree-req" onchange="niceAgreeChange()">
            <label for="niceAgree3"><span class="nice-req-tag">[필수]</span>개인(신용)정보 조회 동의</label>
            <button type="button" class="nice-view" onclick="niceViewTerm(3)">내용 보기</button>
          </div>
          <div class="nice-agree-item">
            <input type="checkbox" id="niceAgree4" class="nice-agree-req" onchange="niceAgreeChange()">
            <label for="niceAgree4"><span class="nice-req-tag">[필수]</span>본인확인 서비스 이용약관</label>
            <button type="button" class="nice-view" onclick="niceViewTerm(4)">내용 보기</button>
          </div>
        </div>
      </div>

      <!-- 본인정보 입력 -->
      <div class="nice-section">
        <h4 class="nice-section-title">본인정보 입력</h4>
        <div class="nice-form">
          <div class="nice-field">
            <label for="niceName">이름<span class="nice-req">*</span></label>
            <input type="text" id="niceName" placeholder="홍길동" autocomplete="name">
          </div>
          <div class="nice-field">
            <label>주민등록번호<span class="nice-req">*</span></label>
            <div class="nice-row-jumin">
              <input type="text" id="niceJuminFront" placeholder="앞 6자리" maxlength="6" inputmode="numeric" autocomplete="off">
              <span class="nice-jumin-sep">-</span>
              <input type="text" id="niceJuminBack" class="nice-jumin-back" maxlength="1" inputmode="numeric" autocomplete="off">
              <span class="nice-jumin-mask">••••••</span>
            </div>
          </div>
          <div class="nice-field">
            <label for="niceCarrier">통신사<span class="nice-req">*</span></label>
            <select id="niceCarrier">
              <option value="">통신사를 선택하세요</option>
              <option value="SKT">SKT</option>
              <option value="KT">KT</option>
              <option value="LGU">LG U+</option>
              <option value="SKT_MVNO">알뜰폰 (SKT)</option>
              <option value="KT_MVNO">알뜰폰 (KT)</option>
              <option value="LGU_MVNO">알뜰폰 (LG U+)</option>
            </select>
          </div>
          <div class="nice-field">
            <label for="nicePhone">휴대폰 번호<span class="nice-req">*</span></label>
            <input type="tel" id="nicePhone" placeholder="010-1234-5678" inputmode="tel" autocomplete="tel">
          </div>
          <div class="nice-verify-row" id="niceVerifyRow">
            <div class="nice-field">
              <label for="niceVerifyCode">인증번호<span class="nice-req">*</span></label>
              <input type="text" id="niceVerifyCode" placeholder="6자리 입력" maxlength="6" inputmode="numeric">
            </div>
            <div class="nice-verify-bottom">
              <span class="nice-verify-timer" id="niceVerifyTimer">남은 시간 3:00</span>
              <button type="button" class="nice-verify-resend" onclick="niceRequestCode()">재전송</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="nice-foot">
      <div class="nice-foot-logo">평가정보㈜ 본인확인 서비스</div>
      <button class="nice-submit-btn" id="niceSubmitBtn" onclick="niceSubmit()" disabled>본인인증 요청</button>
      <p class="nice-foot-note">입력하신 정보는 본인확인 목적 외 사용되지 않으며, NICE평가정보㈜를 통해 안전하게 처리됩니다.</p>
    </div>
  </div>
</div>

<!-- 본인인증 화면 (현대캐피탈 다이렉트) -->
<div class="ha-modal" id="haModal" role="dialog" aria-modal="true" aria-labelledby="haModalTitle">
  <div class="ha-backdrop" onclick="closeHyundaiAuth()"></div>
  <div class="ha-card">
    <div class="ha-header">
      <h3 class="ha-header-title" id="haModalTitle">본인인증</h3>
      <button class="ha-close" type="button" onclick="closeHyundaiAuth()" aria-label="닫기">&times;</button>
    </div>
    <div class="ha-body">
      <h2 class="ha-title">휴대폰으로<br>본인인증을 진행해 주세요</h2>
      <p class="ha-desc">상품 이용 가능 여부를 확인하기 위해 개인신용정보 조회가 필요합니다. 이는 개인신용평점에 영향을 미치지 않으니, 알림이 오더라도 안심하세요.</p>

      <div class="ha-field">
        <label for="haName">이름</label>
        <input type="text" id="haName" autocomplete="name" oninput="haCheckForm()">
      </div>

      <div class="ha-field ha-field-jumin">
        <label>생년월일</label>
        <div class="ha-jumin-row">
          <input type="text" id="haJuminFront" maxlength="6" inputmode="numeric" autocomplete="off" placeholder="">
          <span class="ha-jumin-sep">-</span>
          <input type="text" id="haJuminBack" class="ha-jumin-back" maxlength="1" inputmode="numeric" autocomplete="off">
          <span class="ha-jumin-mask">******</span>
        </div>
      </div>

      <div class="ha-carrier-grid" id="haCarrierGrid">
        <button type="button" class="ha-carrier-btn selected" data-carrier="SKT">SKT</button>
        <button type="button" class="ha-carrier-btn" data-carrier="KT">KT</button>
        <button type="button" class="ha-carrier-btn" data-carrier="LGU">LGU+</button>
        <button type="button" class="ha-carrier-btn" data-carrier="SKT_MVNO">SKT알뜰폰</button>
        <button type="button" class="ha-carrier-btn" data-carrier="KT_MVNO">KT알뜰폰</button>
        <button type="button" class="ha-carrier-btn" data-carrier="LGU_MVNO">LGU+알뜰폰</button>
      </div>

      <div class="ha-agree-card" id="haAgreeCard">
        <div class="ha-agree-head" onclick="haToggleAgree()">
          <span class="ha-agree-check">
            <svg viewBox="0 0 22 22" fill="none">
              <circle cx="11" cy="11" r="10" stroke="currentColor" stroke-width="1.5" fill="none"/>
              <path d="M6.5 11l3 3 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            </svg>
          </span>
          <span class="ha-agree-text"><span class="ha-agree-req">(필수)</span> 휴대폰 인증 이용약관 동의</span>
          <button type="button" class="ha-agree-chevron" id="haAgreeChevron" onclick="event.stopPropagation();haToggleAgreeExpand()" aria-label="펼치기">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><polyline points="6 9 12 15 18 9" stroke="#737373" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>
        <div class="ha-agree-details" id="haAgreeDetails">
          <button type="button" class="ha-sub-item" onclick="haViewSubTerm(1)">
            <span class="ha-sub-check"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><polyline points="3 8 6.5 11.5 13 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            <span class="ha-sub-label">개인정보 수집·이용 동의</span>
            <span class="ha-sub-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><polyline points="9 6 15 12 9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </button>
          <button type="button" class="ha-sub-item" onclick="haViewSubTerm(2)">
            <span class="ha-sub-check"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><polyline points="3 8 6.5 11.5 13 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            <span class="ha-sub-label">고유식별정보 처리 동의</span>
            <span class="ha-sub-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><polyline points="9 6 15 12 9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </button>
          <button type="button" class="ha-sub-item" onclick="haViewSubTerm(3)">
            <span class="ha-sub-check"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><polyline points="3 8 6.5 11.5 13 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            <span class="ha-sub-label">통신사 이용약관 동의</span>
            <span class="ha-sub-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><polyline points="9 6 15 12 9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </button>
          <button type="button" class="ha-sub-item" onclick="haViewSubTerm(4)">
            <span class="ha-sub-check"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><polyline points="3 8 6.5 11.5 13 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            <span class="ha-sub-label">서비스 이용약관 동의</span>
            <span class="ha-sub-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><polyline points="9 6 15 12 9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </button>
        </div>
      </div>

      <div class="ha-field ha-field-phone">
        <label for="haPhone">휴대폰번호</label>
        <div class="ha-phone-row">
          <input type="tel" id="haPhone" inputmode="tel" autocomplete="tel" placeholder="" oninput="haCheckForm()">
          <button type="button" class="ha-send-btn" id="haSendBtn" onclick="haSendCode()" disabled>인증번호 전송</button>
        </div>
      </div>

      <!-- 인증번호 입력 (인증번호 전송 후 노출) -->
      <div class="ha-field ha-field-code" id="haCodeField" style="display:none">
        <label for="haCode">인증번호 6자리</label>
        <div class="ha-phone-row">
          <input type="text" id="haCode" inputmode="numeric" maxlength="6" placeholder="" oninput="haCheckForm()">
          <span class="ha-timer" id="haTimer">3:00</span>
        </div>
      </div>
    </div>
    <div class="ha-footer">
      <button type="button" class="ha-next-btn" id="haNextBtn" onclick="haNext()" disabled>다음</button>
    </div>
  </div>
</div>

<!-- 신용정보조회 동의 모달 (본인인증 완료 후) -->
<?php
$ci_agreements = [
  [
    'id' => 1,
    'label' => '<span class="ci-req">(필수)</span> 현대캐피탈 신차렌트 선택형 상품 이용을 위한 개인(신용)정보 처리 동의',
    'expandable' => true,
    'subs' => [
      '개인(신용)정보 수집·이용 동의',
      '고유식별정보 수집·이용 동의',
      '개인(신용)정보 조회 동의',
      '고유식별정보 조회 동의',
      '개인(신용)정보 제공 동의',
      '고유식별정보 제공 동의',
    ],
  ],
  [
    'id' => 2,
    'label' => '<span class="ci-req">(필수)</span> 현대캐피탈 표준 전자금융거래 기본 약관 동의',
    'expandable' => false,
    'subs' => [],
  ],
  [
    'id' => 3,
    'label' => '<span class="ci-req">(필수)</span> 금융결제원 자동이체 정보를 이용한 심사·유지 목적 개인(신용)정보 처리 동의',
    'expandable' => true,
    'subs' => [
      '개인(신용)정보 이용 관련 동의',
      '개인(신용)정보 제3자 제공 관련 동의',
    ],
  ],
];
?>
<div class="ci-modal" id="ciModal" role="dialog" aria-modal="true" aria-labelledby="ciModalTitle">
  <div class="ci-backdrop" onclick="closeCreditInfoConsent()"></div>
  <div class="ci-card">
    <div class="ci-header">
      <h3 class="ci-header-title" id="ciModalTitle">신용정보조회 동의</h3>
      <button class="ci-close" type="button" onclick="closeCreditInfoConsent()" aria-label="닫기">&times;</button>
    </div>
    <div class="ci-body">
      <?php foreach ($ci_agreements as $ag): $aid = $ag['id']; ?>
      <div class="ci-agree-card" id="ciCard<?= $aid ?>" data-id="<?= $aid ?>">
        <div class="ci-agree-head" onclick="ciToggleAgree(<?= $aid ?>)">
          <span class="ci-agree-check">
            <svg viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="none"/>
              <path d="M7 12l3.5 3.5L17 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            </svg>
          </span>
          <span class="ci-agree-text"><?= $ag['label'] ?></span>
          <?php if ($ag['expandable']): ?>
          <button type="button" class="ci-agree-toggle" id="ciToggle<?= $aid ?>" onclick="event.stopPropagation();ciToggleExpand(<?= $aid ?>)" aria-label="펼치기">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><polyline points="6 9 12 15 18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <?php else: ?>
          <button type="button" class="ci-agree-view-only" onclick="event.stopPropagation();ciViewMain(<?= $aid ?>)" aria-label="약관 보기">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><polyline points="9 6 15 12 9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <?php endif; ?>
        </div>
        <?php if ($ag['expandable'] && !empty($ag['subs'])): ?>
        <div class="ci-agree-details" id="ciDetails<?= $aid ?>">
          <?php foreach ($ag['subs'] as $idx => $sub): ?>
          <button type="button" class="ci-sub-item" onclick="ciViewSub(<?= $aid ?>,<?= $idx ?>)">
            <span class="ci-sub-check"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><polyline points="3 8 6.5 11.5 13 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            <span class="ci-sub-label"><?= htmlspecialchars($sub, ENT_QUOTES) ?></span>
            <?php if ($idx === 0): ?><span class="ci-sub-view">내용 보기</span><?php endif; ?>
          </button>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="ci-footer">
      <button type="button" class="ci-next-btn" id="ciNextBtn" onclick="ciNext()">다음</button>
    </div>
  </div>
</div>

<!-- 계약 단계 안내 모달 -->
<div class="cs-modal" id="csModal" role="dialog" aria-modal="true" aria-labelledby="csModalTitle">
  <div class="cs-backdrop" onclick="closeContractSteps()"></div>
  <div class="cs-card">
    <div class="cs-header">
      <h3 class="cs-header-title" id="csModalTitle">계약 단계 안내</h3>
      <button class="cs-close" type="button" onclick="closeContractSteps()" aria-label="닫기">&times;</button>
    </div>
    <div class="cs-body">
      <h2 class="cs-title"><span id="csCustomerName">고객</span>님,<br>이 단계만 마치면 차량이 도착해요</h2>

      <div class="cs-steps">
        <!-- STEP 1 -->
        <div class="cs-step-row">
          <div class="cs-step-icon-wrap">
            <div class="cs-step-icon">
              <svg viewBox="0 0 32 32" fill="none">
                <rect x="4" y="7" width="24" height="18" rx="2.5" stroke="currentColor" stroke-width="1.8"/>
                <circle cx="12" cy="14" r="2.5" stroke="currentColor" stroke-width="1.8" fill="none"/>
                <path d="M8 21c0-2 2-3.5 4-3.5s4 1.5 4 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <line x1="18" y1="13" x2="24" y2="13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <line x1="18" y1="17" x2="24" y2="17" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <line x1="18" y1="21" x2="22" y2="21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
              </svg>
            </div>
            <div class="cs-step-num">STEP 1</div>
          </div>
          <div class="cs-step-text">
            <h4 class="cs-step-title">운전면허증 정보 입력</h4>
          </div>
        </div>

        <!-- STEP 2 -->
        <div class="cs-step-row">
          <div class="cs-step-icon-wrap">
            <div class="cs-step-icon">
              <div class="cs-icon-rel">
                <svg viewBox="0 0 32 32" fill="none">
                  <rect x="3" y="8" width="22" height="16" rx="2.5" fill="#3D6FE8"/>
                  <rect x="3" y="11.5" width="22" height="3" fill="#1E4FCC"/>
                  <rect x="6.5" y="18" width="6" height="2" rx="1" fill="#BFD2F8"/>
                </svg>
                <div class="cs-icon-badge-plus">+</div>
              </div>
            </div>
            <div class="cs-step-num">STEP 2</div>
          </div>
          <div class="cs-step-text">
            <h4 class="cs-step-title">필수 약관 확인 및 결제 계좌 입력</h4>
          </div>
        </div>

        <!-- STEP 3 -->
        <div class="cs-step-row">
          <div class="cs-step-icon-wrap">
            <div class="cs-step-icon">
              <div class="cs-icon-rel">
                <svg viewBox="0 0 32 32" fill="none">
                  <rect x="6" y="4" width="18" height="22" rx="2" stroke="currentColor" stroke-width="1.8"/>
                  <line x1="10" y1="10" x2="20" y2="10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                  <line x1="10" y1="15" x2="20" y2="15" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <div class="cs-icon-badge-check">
                  <svg width="11" height="11" viewBox="0 0 12 12" fill="none"><polyline points="2.5 6.5 5 9 9.5 3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
              </div>
            </div>
            <div class="cs-step-num">STEP 3</div>
          </div>
          <div class="cs-step-text">
            <h4 class="cs-step-title">ARS 자동이체 출금 동의</h4>
          </div>
        </div>

        <!-- STEP 4 -->
        <div class="cs-step-row">
          <div class="cs-step-icon-wrap">
            <div class="cs-step-icon">
              <svg viewBox="0 0 32 32" fill="none">
                <circle cx="16" cy="12" r="4.5" fill="currentColor"/>
                <path d="M7 26c0-4.5 4-7.5 9-7.5s9 3 9 7.5" fill="currentColor"/>
              </svg>
            </div>
            <div class="cs-step-num">STEP 4</div>
          </div>
          <div class="cs-step-text">
            <h4 class="cs-step-title">계약 완료 본인인증</h4>
          </div>
        </div>

        <!-- STEP 5 -->
        <div class="cs-step-row">
          <div class="cs-step-icon-wrap">
            <div class="cs-step-icon">
              <div class="cs-icon-rel">
                <svg viewBox="0 0 32 32" fill="none">
                  <path d="M5 19l2.5-6.5c.4-1 1.4-1.7 2.5-1.7h12c1.1 0 2.1.7 2.5 1.7L27 19v4c0 .6-.4 1-1 1h-2c-.6 0-1-.4-1-1v-1.5H9V23c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-4z" stroke="currentColor" stroke-width="1.7" fill="none" stroke-linejoin="round"/>
                  <circle cx="10" cy="19.5" r="1.5" fill="currentColor"/>
                  <circle cx="22" cy="19.5" r="1.5" fill="currentColor"/>
                </svg>
                <div class="cs-icon-badge-check">
                  <svg width="11" height="11" viewBox="0 0 12 12" fill="none"><polyline points="2.5 6.5 5 9 9.5 3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
              </div>
            </div>
            <div class="cs-step-num">STEP 5</div>
          </div>
          <div class="cs-step-text">
            <h4 class="cs-step-title">확정 신청 완료</h4>
            <p class="cs-step-sub">차량은 평일 기준 5일 안에 배송될 예정입니다.</p>
          </div>
        </div>
      </div>

      <!-- 미리 준비해 주세요 -->
      <div class="cs-prep">
        <h3 class="cs-prep-title">미리 준비해 주세요.</h3>
        <div class="cs-prep-row">
          <div class="cs-prep-icon">
            <svg viewBox="0 0 32 32" fill="none">
              <rect x="4" y="7" width="24" height="18" rx="2.5" stroke="currentColor" stroke-width="1.8"/>
              <circle cx="12" cy="14" r="2.5" stroke="currentColor" stroke-width="1.8" fill="none"/>
              <path d="M8 21c0-2 2-3.5 4-3.5s4 1.5 4 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
              <line x1="18" y1="13" x2="24" y2="13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
              <line x1="18" y1="17" x2="24" y2="17" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
              <line x1="18" y1="21" x2="22" y2="21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </div>
          <div class="cs-prep-info">
            <h4 class="cs-prep-name">운전면허증</h4>
          </div>
        </div>
        <div class="cs-prep-row">
          <div class="cs-prep-icon" style="position:relative">
            <svg viewBox="0 0 32 32" fill="none">
              <rect x="3" y="8" width="22" height="16" rx="2.5" fill="#3D6FE8"/>
              <rect x="3" y="11.5" width="22" height="3" fill="#1E4FCC"/>
              <rect x="6.5" y="18" width="6" height="2" rx="1" fill="#BFD2F8"/>
            </svg>
            <div class="cs-icon-badge-plus" style="border:2px solid #f0f4fe;right:2px;bottom:2px">+</div>
          </div>
          <div class="cs-prep-info">
            <h4 class="cs-prep-name">자동이체 계좌</h4>
            <p class="cs-prep-sub">계약자의 본인 명의 계좌 정보가 필요합니다.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="cs-footer">
      <button type="button" class="cs-next-btn" id="csNextBtn" onclick="csNext()">다음</button>
    </div>
  </div>
</div>

<!-- 금융사기 안내 모달 -->
<div class="ff-modal" id="ffModal" role="dialog" aria-modal="true" aria-labelledby="ffModalTitle">
  <div class="ff-backdrop" onclick="closeFinancialFraudAlert()"></div>
  <div class="ff-card">
    <div class="ff-header">
      <h3 class="ff-header-title" id="ffModalTitle">금융사기 안내</h3>
      <button class="ff-close" type="button" onclick="closeFinancialFraudAlert()" aria-label="닫기">&times;</button>
    </div>
    <div class="ff-body">
      <h2 class="ff-title">금융사기 유형별<br>사례 고지 및 안내</h2>
      <p class="ff-subhead">혹시 아래와 같은 조건으로 리스·렌터카 상품을 신청하시나요?</p>
      <ul class="ff-list">
        <li>고객 본인이 자동차를 실제로 사용하기 위한 대출이 아닌 경우</li>
        <li>다른 사람에게 명의를 빌려준 경우</li>
        <li>다른 사람의 대출을 대신 신청하는 경우(지인을 비롯한 제3자)</li>
        <li>이 대출과 관련해 현대캐피탈이 아닌 제3자에게 수익 제공을 약속받고 대출을 진행하는 경우(렌터카 운영 수익, 보증금 또는 투자금 유치를 조건으로 월 납입금 대납 등)</li>
        <li>이 대출과 관련해 제3자와 별도의 계약을 했거나 약정한 사실이 있는 경우</li>
        <li>취업을 목적으로, 취업하려는 회사의 요청에 따라 대출을 진행하는 경우</li>
        <li>자동차 구입 외 다른 용도로도 사용하기 위해 차량가 대비 높은 대출 금액을 신청한 경우</li>
      </ul>
      <p class="ff-footnote">현대캐피탈과의 대출 계약 외 조건으로 대출을 신청한 경우 현대캐피탈과 무관하며, 대출 금액 상환은 민법 및 전자문서법 등 관련 규정에 따라 고객에게 최종적인 책임이 있음을 알려드립니다.</p>
    </div>
    <div class="ff-footer">
      <button type="button" class="ff-btn ff-btn-stop" onclick="ffStop()">네(진행 중지)</button>
      <button type="button" class="ff-btn ff-btn-go" onclick="ffContinue()">아니요(계속 진행)</button>
    </div>
  </div>
</div>

<!-- 면허증 확인 모달 -->
<div class="dlv-modal" id="dlvModal" role="dialog" aria-modal="true" aria-labelledby="dlvModalTitle">
  <div class="dlv-backdrop" onclick="closeLicenseVerify()"></div>
  <div class="dlv-card">
    <div class="dlv-header">
      <h3 class="dlv-header-title" id="dlvModalTitle">면허증 확인</h3>
      <button class="dlv-close" type="button" onclick="closeLicenseVerify()" aria-label="닫기">&times;</button>
    </div>
    <div class="dlv-body">
      <h2 class="dlv-title">운전면허증<br>정보를 확인해 주세요</h2>

      <!-- 면허증 카드 (mockup) -->
      <div class="dlv-license-card">
        <div class="dlv-lic-top">
          <div class="dlv-lic-type">면허종별<strong>1종 보통</strong></div>
          <div class="dlv-lic-doc">자동차운전면허증 <small>(Driver's License)</small></div>
        </div>
        <div class="dlv-lic-mid">
          <div class="dlv-lic-photo">
            <svg viewBox="0 0 84 104" preserveAspectRatio="xMidYEnd meet">
              <!-- 머리/얼굴 -->
              <circle cx="42" cy="36" r="18" fill="#fcd9b6"/>
              <!-- 머리카락 -->
              <path d="M24 32 Q24 16 42 16 Q60 16 60 32 Q60 28 56 26 Q52 24 42 24 Q32 24 28 26 Q24 28 24 32 Z" fill="#6b4423"/>
              <!-- 눈 -->
              <ellipse cx="36" cy="36" rx="1.6" ry="2.2" fill="#1f2937"/>
              <ellipse cx="48" cy="36" rx="1.6" ry="2.2" fill="#1f2937"/>
              <!-- 입 -->
              <path d="M38 44 Q42 47 46 44" stroke="#7a3f1f" stroke-width="1.4" fill="none" stroke-linecap="round"/>
              <!-- 목 -->
              <rect x="36" y="52" width="12" height="10" fill="#fcd9b6"/>
              <!-- 양복 -->
              <path d="M14 104 L14 78 Q14 64 28 60 L42 72 L56 60 Q70 64 70 78 L70 104 Z" fill="#2858E0"/>
              <!-- 셔츠 -->
              <path d="M34 60 L42 72 L50 60 L46 70 L42 74 L38 70 Z" fill="#fff"/>
              <!-- 넥타이 -->
              <path d="M40 72 L44 72 L46 78 L42 100 L38 78 Z" fill="#1428A0"/>
            </svg>
          </div>
          <div class="dlv-lic-info">
            <div class="dlv-lic-row2">
              <div class="dlv-lic-row2-col">
                <div class="dlv-lic-meta">발행기관</div>
                <div class="dlv-lic-val">서울 (11)</div>
              </div>
              <div class="dlv-lic-row2-col">
                <div class="dlv-lic-meta">면허번호</div>
                <div class="dlv-lic-val">12-123456-12</div>
              </div>
            </div>
            <div class="dlv-lic-name">김현대</div>
            <div class="dlv-lic-rrn">000000-0000000</div>
            <div class="dlv-lic-blur"></div>
            <div class="dlv-lic-blur" style="width:75%"></div>
            <div class="dlv-lic-foot">
              <span>2020.00.00</span>
              <strong>서울지방경찰청장</strong>
            </div>
          </div>
          <div class="dlv-lic-sub-photo">
            <div class="dlv-lic-sub-photo-img">
              <svg viewBox="0 0 38 46" preserveAspectRatio="xMidYEnd meet">
                <circle cx="19" cy="17" r="9" fill="#fcd9b6"/>
                <path d="M10 14 Q10 6 19 6 Q28 6 28 14 Q28 12 26 11 Q24 10 19 10 Q14 10 12 11 Q10 12 10 14 Z" fill="#6b4423"/>
                <rect x="16" y="24" width="6" height="5" fill="#fcd9b6"/>
                <path d="M5 46 L5 36 Q5 30 12 28 L19 33 L26 28 Q33 30 33 36 L33 46 Z" fill="#2858E0"/>
              </svg>
            </div>
            <div class="dlv-lic-sub-code">1A2B3C</div>
          </div>
        </div>
      </div>

      <!-- 정보입력 -->
      <div class="dlv-section">
        <div class="dlv-section-head">
          <h3 class="dlv-section-title">정보입력</h3>
          <button class="dlv-autofill" id="dlvAutofillBtn" onclick="dlvToggleAutofill()" type="button">
            <span class="dlv-autofill-circle">
              <svg viewBox="0 0 11 11" fill="none"><polyline points="2 5.8 4.5 8 9 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            내 정보 자동 입력
          </button>
        </div>
        <p class="dlv-desc">내 정보 자동 입력을 선택하면 현대캐피탈에 등록된 고객님의 이름, 운전면허정보, 주소, 전화번호, 이메일 주소, 계좌번호가 자동으로 입력됩니다.</p>
        <p class="dlv-note-asterisk">* 입력된 정보는 직접 수정할 수 있습니다.</p>

        <div class="dlv-form">
          <div class="dlv-row-2">
            <div class="dlv-field">
              <select id="dlvLicType" onchange="dlvCheckForm()">
                <option value="">면허종별코드</option>
                <option value="1종대형">1종 대형</option>
                <option value="1종보통" selected>1종 보통</option>
                <option value="2종보통">2종 보통</option>
                <option value="2종소형">2종 소형</option>
                <option value="원동기">원동기</option>
              </select>
              <span class="dlv-select-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><polyline points="6 9 12 15 18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
            <div class="dlv-field">
              <select id="dlvIssuer" onchange="dlvCheckForm()">
                <option value="">발행 기관 선택</option>
                <option value="서울" selected>서울지방경찰청</option>
                <option value="부산">부산지방경찰청</option>
                <option value="대구">대구지방경찰청</option>
                <option value="인천">인천지방경찰청</option>
                <option value="광주">광주지방경찰청</option>
                <option value="대전">대전지방경찰청</option>
                <option value="울산">울산지방경찰청</option>
                <option value="경기남부">경기남부지방경찰청</option>
                <option value="경기북부">경기북부지방경찰청</option>
                <option value="강원">강원지방경찰청</option>
                <option value="충북">충북지방경찰청</option>
                <option value="충남">충남지방경찰청</option>
                <option value="전북">전북지방경찰청</option>
                <option value="전남">전남지방경찰청</option>
                <option value="경북">경북지방경찰청</option>
                <option value="경남">경남지방경찰청</option>
                <option value="제주">제주지방경찰청</option>
              </select>
              <span class="dlv-select-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><polyline points="6 9 12 15 18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
          </div>
          <div class="dlv-field">
            <input type="text" id="dlvLicNo" placeholder="면허번호" oninput="dlvCheckForm()" autocomplete="off">
          </div>
          <div class="dlv-field">
            <input type="text" id="dlvSerial" placeholder="암호일련번호(식별번호)" maxlength="6" oninput="dlvCheckForm()" autocomplete="off">
          </div>
        </div>

        <ul class="dlv-notes">
          <li>운전면허증 오른쪽 사진 아래에 위치한, 영문과 숫자로 구성된 6자리 번호입니다.</li>
          <li>입력한 정보는 운전면허 진위 확인에만 사용되며, 확인 후 파기됩니다.</li>
        </ul>
      </div>

      <!-- 렌터카 이용 확인사항 -->
      <div class="dlv-section">
        <h3 class="dlv-section-title" style="margin-bottom:.7rem">렌터카 이용 확인사항</h3>
        <div class="dlv-check-card">
          <button type="button" class="dlv-check-item" id="dlvCheck1" onclick="dlvViewCheckItem(1)">
            <span class="dlv-check-icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"><polyline points="3.5 9.5 7 13 14.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            <span class="dlv-check-label"><span style="font-weight:600">(필수)</span> 운전자 범위 필수 안내 사항</span>
            <span class="dlv-check-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><polyline points="9 6 15 12 9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </button>
          <button type="button" class="dlv-check-item" id="dlvCheck2" onclick="dlvViewCheckItem(2)">
            <span class="dlv-check-icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"><polyline points="3.5 9.5 7 13 14.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            <span class="dlv-check-label"><span style="font-weight:600">(필수)</span> 운전자격 필수 확인 사항</span>
            <span class="dlv-check-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><polyline points="9 6 15 12 9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </button>
        </div>
      </div>

      <!-- 렌터카 이용 동의 -->
      <div class="dlv-section">
        <h3 class="dlv-section-title" style="margin-bottom:.7rem">렌터카 이용 동의</h3>
        <div class="dlv-agree-card" id="dlvAgreeCard">
          <div class="dlv-agree-head" onclick="dlvToggleAgree()">
            <span class="dlv-agree-check">
              <svg viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="1.5" fill="none"/>
                <path d="M7 12l3.5 3.5L17 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
            </span>
            <span class="dlv-agree-text"><span class="dlv-agree-req">(필수)</span> 현대캐피탈 렌터카 대여 자격 확인 및 사고 접수 처리를 위한 개인정보 동의</span>
            <button type="button" class="dlv-agree-toggle" id="dlvAgreeToggle" onclick="event.stopPropagation();dlvToggleAgreeExpand()" aria-label="펼치기">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><polyline points="6 9 12 15 18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          </div>
          <div class="dlv-agree-details" id="dlvAgreeDetails">
            현대캐피탈은 본 동의를 받아 렌터카 대여 자격 확인 및 사고 발생 시 신속한 접수·처리를 위해 운전면허정보, 연락처 등 개인정보를 활용합니다. 수집된 정보는 관계 법령에 따라 안전하게 관리되며, 목적이 달성된 후에는 지체 없이 파기됩니다.
          </div>
        </div>
      </div>
    </div>
    <div class="dlv-footer">
      <button type="button" class="dlv-next-btn" id="dlvNextBtn" onclick="dlvNext()" disabled>다음</button>
    </div>
  </div>
</div>


<?php require_once __DIR__ . '/../includes/car_data.php'; ?>
<script src="../car_brands.js"></script>
<script src="../cars-data/options_data.js"></script>
<script src="../cars-data/options_conflicts.js"></script>
<script>
/* ===== PHP-injected data ===== */
window.COLOR_HEX_DB   = <?= json_js(get_color_hex_map()) ?>;
window.COLOR_PRICE_DB = <?= json_js(get_color_price_map()) ?>;
const OPT_PRICES      = <?= json_js(get_opt_prices()) ?>;

let CAR_DATA = null;
let selectedCar = null;
let selectedTrim = null;
let selectedOptions = [];
let selectedExtColor = null;
let selectedIntColor = null;
function guessOptPrice(name){
  const clean = (name||'').trim().replace(/\s+/g,'');
  if (OPT_PRICES[clean] !== undefined) return OPT_PRICES[clean];
  for (const key of Object.keys(OPT_PRICES)) {
    if (clean.includes(key)) return OPT_PRICES[key];
  }
  return 69;
}
let selectedModelKey = null;

// URL 파라미터에서 차량명 가져오기
const params = new URLSearchParams(window.location.search);
const carName = params.get('name');
const isLimited = params.get('from') === 'limited';
if (isLimited) {
  const lbl = document.getElementById('backBtnLabel');
  if (lbl) lbl.textContent = '목록으로';
  const btn = document.getElementById('backBtn');
  if (btn) btn.setAttribute('aria-label','목록으로');
  // 빠른출고 진입 시 세부모델·트림·색상 선택 아코디언 숨김 (이미 단일 변형으로 진입)
  const trimAcc = document.querySelector('.acc-block[data-acc="trim"]');
  if (trimAcc) trimAcc.style.display = 'none';
}

if (!carName) {
  document.getElementById('loading').style.display = 'none';
  document.getElementById('emptyState').style.display = 'block';
} else if (isLimited) {
  // 빠른출고: URL 파라미터에서 직접 데이터 로드
  renderLimitedCar();
} else if (window.CAR_BRANDS_DATA) {
  CAR_DATA = window.CAR_BRANDS_DATA;
  loadCar(carName);
} else {
  document.getElementById('loading').style.display = 'none';
  document.getElementById('emptyState').style.display = 'block';
}

// 색상 이름 → 정규화 키 (공백/괄호 코드 제거, lowercase). PHP color_key()와 동일 로직.
function colorKey(name) {
  return (name || '')
    .replace(/\s*\([^)]*\)\s*$/, '')
    .replace(/\s+/g, '')
    .toLowerCase();
}

// 유료 색상 가격 매칭용 정규화 키 — PHP color_price_key() 와 동일 로직
function colorPriceKey(name) {
  return (name || '')
    .replace(/[-–—]?\s*유료\s*(\([^)]*\))?/g, '')
    .replace(/\([^)]*\)/g, '')
    .replace(/\s+/g, '')
    .toLowerCase();
}

// 색상 표시명 — DB 가격 있으면 "+XX만원" 으로 표시, "-유료" 텍스트는 정리. 없으면 원본 그대로.
function formatColorDisplay(name) {
  if (!name) return '';
  var priceWon = (window.COLOR_PRICE_DB || {})[colorPriceKey(name)] || 0;
  var hasYuryo = /유료/.test(name);
  // "-유료" 텍스트 정리 (있는 경우만), (무광) 같은 마지막 괄호는 보존
  var cleaned = hasYuryo
    ? name
        .replace(/\s*[-–—]\s*유료\s*\(([^)]*)\)/g, ' ($1)') // -유료(무광) → (무광)
        .replace(/\s*[-–—]?\s*유료\s*/g, '')                 // 남은 -유료/유료 제거
        .replace(/\s{2,}/g, ' ')
        .trim()
    : name;
  if (priceWon > 0) {
    return cleaned + ' +' + Math.round(priceWon / 10000) + '만원';
  }
  // DB에 가격 없음 — 원본 텍스트 유지 (기존 -유료 표기 그대로 보존)
  return name;
}

// 색상 이름에서 hex 추정 — 우선순위: DB(chaboza.car_202603ep_option_color) → car_brands.js → 키워드 fallback
function guessColorHex(name) {
  if (!name) return '#cccccc';
  // 1) PHP가 주입한 DB 색상 맵 (rgbcode 직접 매칭, 정규화 키 기준)
  if (window.COLOR_HEX_DB) {
    const k = colorKey(name);
    if (k && window.COLOR_HEX_DB[k]) return window.COLOR_HEX_DB[k];
  }
  const n = name.toLowerCase();
  // 2) car_brands.js에서 hex 매칭 시도
  if (window.CAR_BRANDS_DATA) {
    for (const brand of window.CAR_BRANDS_DATA.brands) {
      for (const v of brand.vehicles) {
        for (const t of v.trims || []) {
          for (const c of [...(t.exterior_colors || []), ...(t.interior_colors || [])]) {
            if (c.name === name && c.hex) {
              return c.hex.split('/')[0].startsWith('#') ? c.hex.split('/')[0] : '#' + c.hex.split('/')[0];
            }
          }
        }
      }
    }
  }
  // 3) 키워드 기반 fallback
  if (/화이트|펄 white|스노우|아틀라스/.test(n)) return '#f5f5f5';
  if (/블랙|어비스|오로라|온닉스/.test(n)) return '#1a1a1a';
  if (/그레이|실버|스틸|매카노/.test(n)) return '#9ca3af';
  if (/블루|네이비|문라이트|갤럭시|소닉|스펙트라/.test(n)) return '#1e3a8a';
  if (/레드|루비|크림슨/.test(n)) return '#b91c1c';
  // 복합 이름(예: "카키 베이지")이 키워드 매칭에서 잘못 잡히지 않도록 베이지/브라운을 카키/그린보다 먼저 체크
  if (/브라운|베이지|밍크|테라|오크/.test(n)) return '#92400e';
  if (/그린|카키|에코|올리브|연두/.test(n)) return '#15803d';
  if (/옐로우|골드|아이보리/.test(n)) return '#eab308';
  return '#cccccc';
}

function renderLimitedCar() {
  document.getElementById('loading').style.display = 'none';
  document.getElementById('content').style.display = 'block';
  document.getElementById('ctaBox').style.display = 'flex';

  const img = params.get('img');
  const trim = params.get('trim');
  const colorExt = params.get('color_ext');
  const colorInt = params.get('color_int');
  const opts = params.get('options');
  const price0Str = params.get('price0');
  const price30Str = params.get('price30');
  const stock = params.get('stock');

  // 기존 car-hero, 트림 선택, 색상 선택, heroColors 모두 숨김 (빠른출고는 새 카드만 사용)
  const carHero = document.querySelector('.car-hero');
  if (carHero) carHero.style.display = 'none';
  document.getElementById('modelContainer').style.display = 'none';
  document.getElementById('colorSection').style.display = 'none';
  const heroColors = document.getElementById('heroColors');
  if (heroColors) heroColors.style.display = 'none';

  // 이용기간/주행거리/선납금/보증금 모두 표시 (HTML 기본값 유지)

  // 빠른출고 새 카드 표시
  document.getElementById('limCard').style.display = 'block';

  // 모델명: 첫 단어를 모델, 나머지를 영문/서브 (e.g., "현대 아반떼" → "현대 아반떼" / trim을 서브타이틀)
  document.getElementById('limModelName').textContent = carName;
  document.getElementById('limSubtitle').textContent = trim || '';

  // 이미지
  if (img) document.getElementById('limCardImg').src = img;
  document.getElementById('limCardImg').alt = carName;

  // 잔여 배지
  document.getElementById('limStockBadge').textContent = `잔여 ${stock || 0}대`;

  // 차량가 (car_brands.js에서 매칭)
  let carPriceWon = 0;
  if (window.CAR_BRANDS_DATA) {
    for (const brand of window.CAR_BRANDS_DATA.brands) {
      const vehicle = brand.vehicles.find(v =>
        v.name === carName || carName.includes(v.name) || v.name.includes(carName)
      );
      if (vehicle && vehicle.trims && vehicle.trims.length > 0) {
        const prices = vehicle.trims.map(t => t.base_price).filter(p => p > 0);
        if (prices.length > 0) {
          carPriceWon = Math.min(...prices);
        }
        break;
      }
    }
  }
  document.getElementById('limCarPriceVal').textContent = carPriceWon ? carPriceWon.toLocaleString() + '원' : '-';

  // 가격 파싱
  const price0 = parseInt((price0Str || '0').replace(/[^\d]/g, ''));
  const price30 = parseInt((price30Str || '0').replace(/[^\d]/g, ''));

  // 옵션별 가격 보정 계수
  const PERIOD_MULT = { '36':1.08, '48':1.00, '60':0.93 };
  const MILEAGE_MULT = { '10000':0.95, '20000':1.00, '30000':1.05, '40000':1.10, 'unlimited':1.18 };
  const PREPAY_MULT = { '0':1.00, '10':0.95, '20':0.90, '30':0.85 };
  // 상품 종류: 리스는 보험·세금·검사 운영비가 제외돼서 월 납입금이 더 낮음
  const PRODUCT_MULT = { 'rent':1.00, 'lease':0.88 };

  // 월 납입금 갱신 함수 (선택된 옵션 기반)
  function updatePrice() {
    const depositPct = parseInt(document.querySelector('.rental-btns[data-group="deposit"] .rental-btn.selected')?.dataset.value || '0');
    const periodVal = document.querySelector('.rental-btns[data-group="period"] .rental-btn.selected')?.dataset.value || '48';
    const mileageVal = document.querySelector('.rental-btns[data-group="mileage"] .rental-btn.selected')?.dataset.value || '20000';
    const prepayVal = document.querySelector('.rental-btns[data-group="prepay"] .rental-btn.selected')?.dataset.value || '0';
    const productVal = document.querySelector('.rental-btns[data-group="product"] .rental-btn.selected')?.dataset.value || 'rent';
    const periodMonths = parseInt(periodVal);

    // 보증금 0%→30% 보간으로 베이스 산정, 그 후 기간/주행/선납/상품 보정 곱
    let monthly = price0;
    if (price0 && price30) {
      monthly = price0 - (price0 - price30) * (depositPct / 30);
    }
    const pm = PERIOD_MULT[periodVal] ?? 1;
    const mm = MILEAGE_MULT[mileageVal] ?? 1;
    const ppm = PREPAY_MULT[prepayVal] ?? 1;
    const prm = PRODUCT_MULT[productVal] ?? 1;
    monthly = Math.round(monthly * pm * mm * ppm * prm);

    document.getElementById('limPriceFinal').textContent = '월 ' + monthly.toLocaleString() + '원~';
    const ctaEl = document.getElementById('ctaPriceValue');
    if (ctaEl) ctaEl.textContent = monthly.toLocaleString() + '원';

    // 할인 표시 (현재 절감액 또는 최대 절감액)
    const badge = document.getElementById('limDiscountBadge');
    if (price0 && monthly < price0) {
      const savedPerMonth = price0 - monthly;
      const totalSaved = savedPerMonth * periodMonths;
      const savedManwon = Math.round(totalSaved / 10000);
      badge.textContent = savedManwon + '만원 할인';
      badge.style.display = '';
    } else if (price0 && price30 && price30 < price0) {
      const maxSavedPerMonth = price0 - price30;
      const maxTotal = maxSavedPerMonth * periodMonths;
      const maxManwon = Math.round(maxTotal / 10000);
      badge.textContent = maxManwon + '만원 할인';
      badge.style.display = '';
    } else {
      badge.textContent = '192만원 할인';
      badge.style.display = '';
    }
  }
  // URL 파라미터로 옵션 선택 미리 세팅 (variants.php에서 최저가 조합 넘어옴)
  function preselectGroup(group, value){
    if (!value) return;
    const groupEl = document.querySelector(`.rental-btns[data-group="${group}"]`);
    if (!groupEl) return;
    const btn = groupEl.querySelector(`.rental-btn[data-value="${CSS.escape(value)}"]`);
    if (!btn) return;
    groupEl.querySelectorAll('.rental-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
  }
  preselectGroup('period', params.get('period'));
  preselectGroup('mileage', params.get('mileage'));
  preselectGroup('prepay', params.get('prepay'));
  preselectGroup('deposit', params.get('deposit'));

  updatePrice();
  // 모든 렌탈 옵션 변경 시 가격 갱신
  document.querySelectorAll('.rental-btns').forEach(g => {
    g.addEventListener('click', () => setTimeout(updatePrice, 0));
  });

  // 색상 (원 + 이름)
  const extHex = guessColorHex(colorExt);
  document.getElementById('limExtCircle').style.background = extHex;
  document.getElementById('limExtName').textContent = colorExt || '-';
  const intHex = guessColorHex(colorInt);
  document.getElementById('limIntCircle').style.background = intHex;
  document.getElementById('limIntName').textContent = colorInt || '-';

  // 옵션 (· 또는 ,로 split) + 가격 + 옵션 상세 ? 버튼 표시
  const optsList = document.getElementById('limOptsList');
  // 모델 ID 추출: "../cars/303_4665.png" 또는 "../cars/cdn_4665.png" → "4665"
  const limModelId = (img || '').match(/_(\d{4})\.png/)?.[1] || '';
  if (opts) {
    const items = opts.split(/[·,]/).map(s => s.trim()).filter(Boolean);
    optsList.innerHTML = items.map(it => {
      const m = it.match(/\(([^)]+)\)/);
      const priceTxt = m ? m[1] : `${guessOptPrice(it)}만원`;
      const nameTxt = m ? it.replace(/\s*\([^)]+\)\s*$/, '').trim() : it.trim();
      const cleanName = stripOptionPriceSuffix(nameTxt);
      // 약식 이름 → CAR_OPTIONS_DATA 풀네임 퍼지 매칭
      const fullName = findOptionMatch(cleanName, limModelId);
      const infoBtn = fullName
        ? `<button class="lim-opt-info" type="button" data-model="${limModelId}" data-opt="${escapeAttr(fullName)}" onclick="event.stopPropagation();openOptionInfo(this)" aria-label="옵션 상세 보기">?</button>`
        : '';
      return `<li class="lim-opt-row"><span class="lim-opt-name">${nameTxt}</span>${infoBtn}<span class="lim-opt-price">${priceTxt}</span></li>`;
    }).join('');
  } else {
    optsList.innerHTML = '<li style="color:#a3a3a3">옵션 정보 없음</li>';
  }
}


function loadCar(name) {
  // 매칭 우선순위: 1) 정확 일치 → 2) 차량명 길이 차이가 가장 작은 부분 일치
  // (예: "G80" 검색 시 "Electrified G80"이 substring 일치라도 정확한 "G80"이 우선)
  const candidates = [];
  for (const brand of CAR_DATA.brands) {
    for (const v of (brand.vehicles || [])) {
      if (!v.trims || v.trims.length === 0) continue;
      if (v.name === name) {
        candidates.push({v, score: 0});
      } else if (name.includes(v.name) || v.name.includes(name)) {
        candidates.push({v, score: Math.abs(v.name.length - name.length) + 1});
      }
    }
  }
  candidates.sort((a, b) => a.score - b.score);

  if (candidates.length > 0) {
    selectedCar = candidates[0].v;
    renderCar();
    return;
  }

  // 차량을 찾지 못한 경우
  document.getElementById('loading').style.display = 'none';
  document.getElementById('emptyState').style.display = 'block';
}

function renderCar() {
  document.getElementById('loading').style.display = 'none';
  document.getElementById('content').style.display = 'block';
  document.getElementById('ctaBox').style.display = 'flex';
  // 색상/트림/옵션 선택 초기화
  selectedExtColor = null; selectedIntColor = null;
  selectedTrim = null; selectedOptions = [];
  updateSelectionSummary();

  // 차량 정보 표시
  document.getElementById('carImage').src = selectedCar.image_url || '';
  document.getElementById('carImage').alt = selectedCar.name;
  document.getElementById('carTitle').textContent = selectedCar.name;

  const minPrice = Math.min(...selectedCar.trims.map(t => t.base_price).filter(p => p > 0));
  const priceStr = Math.round(minPrice / 10000).toLocaleString();
  document.getElementById('carPrice').innerHTML = `${priceStr}만원 <span class="car-price-sub">~</span>`;

  // 색상: 모든 트림에서 유니크 색상 수집 후 즉시 표시 (트림 선택 무관)
  renderHeroColorsForCar(selectedCar);

  // 엔진별로 트림 그룹화
  const groupedTrims = {};
  selectedCar.trims.forEach((trim, idx) => {
    const engineKey = trim.engine || '기타';
    if (!groupedTrims[engineKey]) {
      groupedTrims[engineKey] = [];
    }
    groupedTrims[engineKey].push({trim, idx});
  });

  // 세부모델 섹션 렌더링
  const container = document.getElementById('modelContainer');
  container.innerHTML = `
    <div class="model-group">
      <h3 class="model-group-title">세부모델</h3>
      <div class="model-list" id="modelList"></div>
    </div>
    <div class="model-group" id="trimSection">
      <h3 class="model-group-title">트림·옵션 선택</h3>
      <div class="trim-list" id="trimList"><div class="trim-empty">먼저 세부모델을 선택해주세요</div></div>
    </div>
  `;

  const modelList = document.getElementById('modelList');
  Object.keys(groupedTrims).forEach(engineKey => {
    const item = document.createElement('div');
    item.className = 'model-item';
    item.dataset.engineKey = engineKey;
    item.onclick = () => selectModel(engineKey, groupedTrims);

    const displayName = engineKey.replace(/하이브리드/g, '<span style="color:#2858E0;font-weight:900">하이브리드</span>');
    item.innerHTML = `<div class="model-item-name">${displayName}</div>`;
    modelList.appendChild(item);
  });
}

function selectModel(engineKey, groupedTrims) {
  selectedModelKey = engineKey;
  selectedTrim = null;
  selectedOptions = [];

  // 모델 선택 표시
  document.querySelectorAll('.model-item').forEach(item => {
    item.classList.toggle('selected', item.dataset.engineKey === engineKey);
  });

  // 트림 리스트 표시
  const trimSection = document.getElementById('trimSection');
  const trimList = document.getElementById('trimList');
  trimSection.style.display = '';
  trimList.innerHTML = '';

  // 기존 옵션 패널 제거
  const existingPanel = document.querySelector('.options-panel');
  if (existingPanel) existingPanel.remove();

  groupedTrims[engineKey].forEach(({trim, idx}) => {
    const card = document.createElement('div');
    card.className = 'trim-card';
    card.dataset.trimIdx = idx;
    card.onclick = () => selectTrim(idx);

    const price = (trim.base_price / 10000).toLocaleString(undefined, {maximumFractionDigits: 0});
    const trimName = trim.name.replace(/하이브리드/g, '<span style="color:#2858E0;font-weight:900">하이브리드</span>');

    card.innerHTML = `
      <div class="trim-name">${trimName}</div>
      <div class="trim-price">+${price}만원</div>
    `;
    trimList.appendChild(card);
  });
}

function selectTrim(idx) {
  const trimList = document.getElementById('trimList');
  const clickedCard = document.querySelector(`.trim-card[data-trim-idx="${idx}"]`);
  const existingPanel = document.querySelector('.options-panel');

  // 같은 트림 다시 클릭 시 접기
  if (clickedCard.classList.contains('selected')) {
    clickedCard.classList.remove('selected');
    if (existingPanel) existingPanel.remove();
    selectedTrim = null;
    selectedOptions = [];
    updateSelectionSummary();
    return;
  }

  // 다른 트림 선택
  selectedTrim = selectedCar.trims[idx];
  selectedOptions = [];

  // 기존 옵션 패널 제거
  if (existingPanel) {
    existingPanel.remove();
  }

  // 선택 표시
  document.querySelectorAll('.trim-card').forEach(card => {
    card.classList.remove('selected');
  });
  clickedCard.classList.add('selected');

  // 옵션 패널 생성
  if (true) {
    const panel = document.createElement('div');
    panel.className = 'options-panel';

    const hasOptions = (selectedTrim.standard_options?.length > 0) || (selectedTrim.option_packages?.length > 0);
    let html = '<div class="options-title">옵션</div><div class="options-box">';

    if (!hasOptions) {
      html += `<div class="option-item standard"><div class="option-name" style="color:#a3a3a3">선택 가능한 옵션이 없습니다.</div></div>`;
    } else {
      if (selectedTrim.standard_options?.length > 0) {
        selectedTrim.standard_options.forEach(opt => {
          html += `<div class="option-item standard"><div class="option-name">${opt}</div></div>`;
        });
      }
      if (selectedTrim.option_packages?.length > 0) {
        const modelId = extractModelIdFromUrl(selectedCar?.image_url);
        selectedTrim.option_packages.forEach((opt, optIdx) => {
          const cleanName = stripOptionPriceSuffix(opt);
          const hasInfo = hasOptionInfo(modelId, cleanName);
          const infoBtn = hasInfo
            ? `<button class="opt-info" type="button" data-model="${modelId}" data-opt="${escapeAttr(cleanName)}" onclick="event.stopPropagation();openOptionInfo(this)" aria-label="옵션 상세 보기">?</button>`
            : '';
          html += `<div class="option-item" data-opt-idx="${optIdx}" onclick="toggleOption(${optIdx})"><div class="option-name">${opt}</div>${infoBtn}</div>`;
        });
      }
    }

    html += '</div>';
    panel.innerHTML = html;

    clickedCard.insertAdjacentElement('afterend', panel);
  }
  updateSelectionSummary();

  // 색상은 renderCar()에서 이미 표시됨 (트림 선택 무관, 차량 전체 색상 표시)
}

function renderHeroColorsForCar(vehicle) {
  // 차량의 모든 트림에서 유니크한 색상 수집
  const extMap = new Map();
  const intMap = new Map();
  for (const trim of vehicle.trims || []) {
    (trim.exterior_colors || []).forEach(c => { if (c.name && !extMap.has(c.name)) extMap.set(c.name, c); });
    (trim.interior_colors || []).forEach(c => { if (c.name && !intMap.has(c.name)) intMap.set(c.name, c); });
  }
  renderHeroColors({
    exterior_colors: Array.from(extMap.values()),
    interior_colors: Array.from(intMap.values())
  });
}

function renderHeroColors(trim) {
  const heroColors = document.getElementById('heroColors');
  const extEl = document.getElementById('heroExtColors');
  const intEl = document.getElementById('heroIntColors');
  const colorSection = document.getElementById('colorSection');
  const extList = document.getElementById('exteriorColorList');
  const intList = document.getElementById('interiorColorList');
  const extGroup = document.getElementById('exteriorColorGroup');
  const intGroup = document.getElementById('interiorColorGroup');

  const extColors = trim.exterior_colors || [];
  const intColors = trim.interior_colors || [];

  if (extColors.length === 0 && intColors.length === 0) {
    heroColors.style.display = 'none';
    if (colorSection) colorSection.style.display = 'none';
    return;
  }

  // === 데스크탑용 hero-swatch ===
  heroColors.style.display = '';
  if (extColors.length > 0) {
    extEl.innerHTML = extColors.map(c => makeHeroSwatch(c,'ext')).join('');
    extEl.parentElement.style.display = '';
  } else {
    extEl.parentElement.style.display = 'none';
  }
  if (intColors.length > 0) {
    intEl.innerHTML = intColors.map(c => makeHeroSwatch(c,'int')).join('');
    intEl.parentElement.style.display = '';
  } else {
    intEl.parentElement.style.display = 'none';
  }
  attachSwatchHandlers();
  const extName = document.getElementById('heroExtName');
  const intName = document.getElementById('heroIntName');
  if (extName) extName.textContent = formatColorDisplay(selectedExtColor) || '';
  if (intName) intName.textContent = formatColorDisplay(selectedIntColor) || '';

  // === 모바일 아코디언용 color-item 리스트 ===
  if (colorSection) {
    colorSection.style.display = '';
    if (extList) {
      extList.innerHTML = '';
      if (extColors.length > 0) {
        extColors.forEach((c, i) => extList.appendChild(makeColorItem(c, i, 'ext')));
        if (extGroup) extGroup.style.display = '';
      } else if (extGroup) {
        extGroup.style.display = 'none';
      }
    }
    if (intList) {
      intList.innerHTML = '';
      if (intColors.length > 0) {
        intColors.forEach((c, i) => intList.appendChild(makeColorItem(c, i, 'int')));
        if (intGroup) intGroup.style.display = '';
      } else if (intGroup) {
        intGroup.style.display = 'none';
      }
    }
  }
}

function makeHeroSwatch(c, type) {
  const hexes = (c.hex || '').split('/');
  const safeName = (c.name || '').replace(/"/g, '&quot;');
  const displayName = formatColorDisplay(c.name || '').replace(/"/g, '&quot;');
  const attrs = `data-color-name="${safeName}" data-color-type="${type}" title="${displayName}"`;
  if (hexes.length >= 2) {
    return `<div class="hero-swatch two-tone" style="--c1:#${hexes[0]};--c2:#${hexes[1]}" ${attrs}></div>`;
  } else if (hexes[0]) {
    return `<div class="hero-swatch" style="background:#${hexes[0]}" ${attrs}></div>`;
  }
  return `<div class="hero-swatch" style="background:#ccc" ${attrs}></div>`;
}

function attachSwatchHandlers(){
  document.querySelectorAll('.hero-swatch').forEach(sw => {
    const type = sw.dataset.colorType;
    const name = sw.dataset.colorName || '';
    const targetName = document.getElementById(type === 'ext' ? 'heroExtName' : 'heroIntName');
    sw.addEventListener('mouseenter', () => { if (targetName) targetName.textContent = formatColorDisplay(name); });
    sw.addEventListener('mouseleave', () => {
      const sel = type === 'ext' ? selectedExtColor : selectedIntColor;
      if (targetName) targetName.textContent = formatColorDisplay(sel) || '';
    });
    sw.addEventListener('click', () => {
      // 같은 타입 다른 스워치들 해제
      document.querySelectorAll('.hero-swatch[data-color-type="'+type+'"]').forEach(o => o.classList.remove('selected'));
      sw.classList.add('selected');
      if (type === 'ext') selectedExtColor = name; else selectedIntColor = name;
      if (targetName) targetName.textContent = formatColorDisplay(name);
      updateSelectionSummary();
    });
  });
}

function parseOptionPrice(label){
  const m = (label||'').match(/\(([\d,]+)\s*만원\)/);
  return m ? parseInt(m[1].replace(/,/g,''), 10) || 0 : 0;
}

function stripOptionPriceSuffix(label){
  return (label || '').replace(/\s*\([^)]*\)\s*$/, '').trim();
}

function extractModelIdFromUrl(url){
  const m = (url || '').match(/photo\/(\d+)\//);
  return m ? m[1] : '';
}

function escapeAttr(s){
  return (s || '').replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function hasOptionInfo(modelId, optName){
  if (!modelId || !optName) return false;
  const data = window.CAR_OPTIONS_DATA;
  if (!data || !data[modelId]) return false;
  const items = data[modelId][optName];
  return Array.isArray(items) && items.length > 0;
}

/* 약식 옵션명 → CAR_OPTIONS_DATA 의 풀네임으로 퍼지 매칭.
   "HUD" → "헤드업 디스플레이 + 스마트 커넥트", "렉시콘" → "메리디안 프리미엄 사운드" 등 */
function findOptionMatch(abbrName, modelId){
  if (!modelId || !abbrName) return null;
  const data = window.CAR_OPTIONS_DATA;
  if (!data || !data[modelId]) return null;
  const keys = Object.keys(data[modelId]);
  if (!keys.length) return null;
  const norm = s => (s || '').replace(/[\s()·,]/g, '').toLowerCase();
  const an = norm(abbrName);
  if (!an) return null;

  // 1) 완전 일치
  for (const k of keys) if (norm(k) === an) return k;

  // 2) 부분 일치 (양방향)
  for (const k of keys) {
    const kn = norm(k);
    if (kn.includes(an) || an.includes(kn)) return k;
  }

  // 3) 약식 ↔ 풀네임 키워드 매핑
  const ALIAS = {
    'hud':'헤드업','헤드업':'hud',
    '어드밴스드':'드라이브와이즈',
    '렉시콘':'사운드','메리디안':'사운드','bose':'사운드','krell':'사운드','b&w':'사운드','bw':'사운드',
    '뱅앤올룹슨':'사운드','하만카돈':'사운드','부메스터':'사운드','뱅':'사운드',
    '파노라마선루프':'파노라마','스카이라운지선루프':'스카이라운지',
    '통풍시트':'통풍','히팅시트':'열선','빌트인캠':'빌트인',
    '솔라패널':'솔라','히트펌프':'히트펌프','360캠':'360',
    '주차보조':'주차','원격스마트주차':'주차',
    '64색앰비언트':'앰비언트','스마트크루즈':'크루즈',
    '뒷열통풍':'뒷열','에어서스':'에어서스',
    '오토파일럿':'오토파일럿','바코드라이빙':'바코드',
    '릴렉션시트':'릴렉션','디지털센터미러':'센터미러','스포츠크로노':'크로노',
    'fsd':'fsd','fsd옵션':'fsd',
  };
  const cand = new Set([an]);
  if (ALIAS[an]) cand.add(ALIAS[an]);
  // "20인치휠"/"19인치휠" 등 사이즈+휠 패턴
  const sizeM = an.match(/^(\d+)인치/);
  if (sizeM) { cand.add('휠'); cand.add(sizeM[1]+'인치'); }
  for (const k of keys) {
    const kn = norm(k);
    for (const c of cand) {
      if (c && (kn.includes(c) || c.includes(kn))) return k;
    }
  }
  return null;
}

function getOptionInfo(modelId, optName){
  const data = window.CAR_OPTIONS_DATA;
  if (!data || !data[modelId]) return null;
  return data[modelId][optName] || null;
}

function openOptionInfo(btn){
  const modelId = btn.dataset.model;
  const optName = btn.dataset.opt;
  const items = getOptionInfo(modelId, optName);
  if (!items) return;
  const prefix = window.CAR_OPTIONS_IMG_PREFIX || '';
  const anyImage = items.some(it => it.i);
  const itemHtml = items.map(it => {
    const name = (it.n || '').replace(/&amp;/g, '&');
    const imgSrc = it.i ? (it.i.startsWith('http') ? it.i : prefix + it.i) : '';
    const imgEl = anyImage
      ? (imgSrc ? `<img class="opt-info-img" src="${imgSrc}" alt="" onerror="this.classList.add('opt-info-img-broken')">` : '<div class="opt-info-img opt-info-img-empty" aria-hidden="true"></div>')
      : '';
    const expEl = it.e ? `<div class="opt-info-exp">${it.e}</div>` : '';
    return `<div class="opt-info-item">${imgEl}<div class="opt-info-text"><div class="opt-info-name">${name}</div>${expEl}</div></div>`;
  }).join('');
  const sheet = document.createElement('div');
  sheet.className = 'opt-info-overlay';
  sheet.innerHTML = `
    <div class="opt-info-sheet" role="dialog" aria-modal="true">
      <div class="opt-info-head">
        <div class="opt-info-title">${optName}</div>
        <button class="opt-info-close" type="button" aria-label="닫기">×</button>
      </div>
      <div class="opt-info-body">${itemHtml}</div>
    </div>`;
  document.body.appendChild(sheet);
  document.body.style.overflow = 'hidden';
  const close = () => { sheet.remove(); document.body.style.overflow = ''; };
  sheet.addEventListener('click', e => { if (e.target === sheet) close(); });
  sheet.querySelector('.opt-info-close').addEventListener('click', close);
  document.addEventListener('keydown', function onEsc(e){ if (e.key === 'Escape') { close(); document.removeEventListener('keydown', onEsc); }});
}

function updateSelectionSummary(){
  // 월 납입금은 데스크탑/모바일 공통 갱신
  if (typeof updateCarMonthly === 'function') updateCarMonthly();
  // 모바일에서는 선택 요약 패널 갱신 비활성 (원래 디자인 유지)
  if (window.matchMedia && window.matchMedia('(max-width: 768px)').matches) return;
  const wrap = document.getElementById('selSummary');
  const rowsEl = document.getElementById('selSummaryRows');
  if (!wrap || !rowsEl) return;

  const hasAnySelection = selectedExtColor || selectedIntColor || selectedTrim || selectedOptions.length > 0;
  if (!hasAnySelection) { wrap.style.display = 'none'; return; }
  wrap.style.display = '';

  const rows = [];
  rows.push({ label:'외장색상', value: formatColorDisplay(selectedExtColor) || null });
  rows.push({ label:'내장색상', value: formatColorDisplay(selectedIntColor) || null });
  if (selectedTrim) {
    rows.push({ label:'모델', value: selectedTrim.engine || '-' });
    rows.push({ label:'트림', value: selectedTrim.name || '-' });
  } else {
    rows.push({ label:'모델/트림', value: null });
  }
  // 옵션
  let optHtml = null;
  if (selectedTrim && selectedOptions.length > 0) {
    optHtml = selectedOptions
      .map(idx => selectedTrim.option_packages?.[idx])
      .filter(Boolean)
      .map(n => `<span class="sel-opt-chip">${n}</span>`)
      .join('');
  }
  rows.push({ label:'선택 옵션', value: optHtml, html:true });

  // 차량가 계산: trim base_price + 옵션 합계 (모두 만원 단위 표시)
  if (selectedTrim) {
    const basePriceManwon = (selectedTrim.base_price || 0) / 10000;
    const optTotalManwon = selectedOptions
      .map(idx => parseOptionPrice(selectedTrim.option_packages?.[idx]))
      .reduce((a,b) => a+b, 0);
    const total = Math.round(basePriceManwon + optTotalManwon);
    rows.push({ label:'차량가', value:`${total.toLocaleString()}만원`, html:true, total:true });
    // 상단 carPrice도 같이 갱신
    const cp = document.getElementById('carPrice');
    if (cp) cp.innerHTML = `${total.toLocaleString()}만원`;
  }

  rowsEl.innerHTML = rows.map(r => {
    const valHtml = r.value
      ? (r.html ? r.value : `<span class="sel-summary-value">${r.value}</span>`)
      : '<span class="sel-summary-value empty">선택 안 함</span>';
    const cls = r.total ? ' total' : '';
    if (r.html && r.value) {
      return `<div class="sel-summary-row${cls}"><span class="sel-summary-label">${r.label}</span><div class="sel-summary-value">${r.value}</div></div>`;
    }
    return `<div class="sel-summary-row${cls}"><span class="sel-summary-label">${r.label}</span>${valHtml}</div>`;
  }).join('');
}

function makeColorItem(c, idx, type) {
  const item = document.createElement('div');
  item.className = 'color-item';
  item.dataset.colorIdx = idx;
  item.dataset.colorType = type;

  const hexes = c.hex.split('/');
  let swatchStyle;
  if (hexes.length >= 2) {
    swatchStyle = `style="--c1:#${hexes[0]};--c2:#${hexes[1]}"`;
  } else {
    swatchStyle = `style="background:#${hexes[0]}"`;
  }
  const swatchClass = hexes.length >= 2 ? 'color-swatch two-tone' : 'color-swatch';

  item.innerHTML = `<div class="${swatchClass}" ${swatchStyle}></div><div class="color-name">${formatColorDisplay(c.name)}</div>`;
  item.onclick = () => {
    document.querySelectorAll(`.color-item[data-color-type="${type}"]`).forEach(el => el.classList.remove('selected'));
    item.classList.add('selected');
    // 데스크탑 hero-swatch와 동기화
    document.querySelectorAll(`.hero-swatch[data-color-type="${type}"]`).forEach(sw => {
      sw.classList.toggle('selected', sw.dataset.colorName === c.name);
    });
    if (type === 'ext') selectedExtColor = c.name; else selectedIntColor = c.name;
    const targetName = document.getElementById(type === 'ext' ? 'heroExtName' : 'heroIntName');
    if (targetName) targetName.textContent = formatColorDisplay(c.name);
    updateSelectionSummary();
  };
  return item;
}

function toggleOption(optIdx) {
  const optItem = document.querySelector(`.option-item[data-opt-idx="${optIdx}"]`);
  if (!optItem) return;

  const isSelected = selectedOptions.includes(optIdx);

  if (isSelected) {
    selectedOptions = selectedOptions.filter(i => i !== optIdx);
    optItem.classList.remove('selected');
    updateSelectionSummary();
    return;
  }

  // 충돌 검사
  const conflictingIdxs = findConflictingOptions(optIdx);
  if (conflictingIdxs.length === 0) {
    selectedOptions.push(optIdx);
    optItem.classList.add('selected');
    updateSelectionSummary();
    return;
  }

  // 충돌 발견 → 사용자에게 확인 요청
  const newName = stripOptionPriceSuffix(selectedTrim.option_packages[optIdx] || '');
  const conflictNames = conflictingIdxs.map(i => stripOptionPriceSuffix(selectedTrim.option_packages[i] || ''));
  openConflictConfirm(newName, conflictNames, () => {
    // 사용자 확정 시: 충돌 옵션 해제 + 새 옵션 선택
    conflictingIdxs.forEach(idx => {
      const el = document.querySelector(`.option-item[data-opt-idx="${idx}"]`);
      if (el) el.classList.remove('selected');
    });
    selectedOptions = selectedOptions.filter(i => !conflictingIdxs.includes(i));
    selectedOptions.push(optIdx);
    optItem.classList.add('selected');
    updateSelectionSummary();
  });
}

function findConflictingOptions(newOptIdx){
  if (!selectedTrim || !selectedTrim.option_packages) return [];
  const modelId = extractModelIdFromUrl(selectedCar?.image_url);
  const newLabel = selectedTrim.option_packages[newOptIdx] || '';
  const newName = stripOptionPriceSuffix(newLabel);
  if (!newName) return [];

  const conflictMap = window.CAR_OPTIONS_CONFLICTS || {};
  const modelConflicts = conflictMap[modelId] || {};
  const conflicts = new Set(modelConflicts[newName] || []);
  const sameNameRule = conflicts.has('__SAME_NAME__');

  const found = [];
  selectedOptions.forEach(idx => {
    if (idx === newOptIdx) return;
    const otherName = stripOptionPriceSuffix(selectedTrim.option_packages[idx] || '');
    if (!otherName) return;
    if (conflicts.has(otherName) || (sameNameRule && otherName === newName)) {
      found.push(idx);
    }
  });
  return found;
}

function openConflictConfirm(newName, conflictNames, onConfirm){
  const conflictListHtml = conflictNames.map(n => `<li>${n}</li>`).join('');
  const overlay = document.createElement('div');
  overlay.className = 'conflict-overlay';
  overlay.innerHTML = `
    <div class="conflict-dialog" role="dialog" aria-modal="true">
      <div class="conflict-icon" aria-hidden="true">!</div>
      <div class="conflict-title">함께 선택할 수 없는 옵션이에요</div>
      <div class="conflict-msg"><b>${newName}</b>를 선택하려면 아래 옵션은 자동으로 해제됩니다.</div>
      <ul class="conflict-list">${conflictListHtml}</ul>
      <div class="conflict-actions">
        <button type="button" class="conflict-btn conflict-btn-cancel">취소</button>
        <button type="button" class="conflict-btn conflict-btn-confirm">해제하고 선택</button>
      </div>
    </div>`;
  document.body.appendChild(overlay);
  document.body.style.overflow = 'hidden';
  const close = () => { overlay.remove(); document.body.style.overflow = ''; };
  overlay.addEventListener('click', e => { if (e.target === overlay) close(); });
  overlay.querySelector('.conflict-btn-cancel').addEventListener('click', close);
  overlay.querySelector('.conflict-btn-confirm').addEventListener('click', () => {
    close();
    onConfirm();
  });
  document.addEventListener('keydown', function onEsc(e){
    if (e.key === 'Escape') { close(); document.removeEventListener('keydown', onEsc); }
  });
}

function showQuoteModal(rows) {
  const body = document.getElementById('quoteModalBody');
  body.innerHTML = '';
  body.style.display = 'none';
  document.getElementById('quoteContact').style.display = '';
  document.getElementById('quoteSignup').style.display = '';
  const modal = document.getElementById('quoteModal');
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeQuoteModal() {
  document.getElementById('quoteModal').style.display = 'none';
  document.body.style.overflow = '';
}

/* ===== NICE 신용정보 동의 + 본인인증 모달 (Track 1) ===== */
let niceVerifyTimerId = null;
let niceVerifyStep = 0; // 0: 인증번호 미요청, 1: 발송됨

/* 🧪 데모용 자동 입력 값 — 시연 시 수동 입력 부담 제거 */
const DEMO_AUTOFILL = {
  name: '홍길동',
  juminFront: '940101',
  juminBack: '1',
  carrier: 'SKT',
  phone: '010-1234-5678',
  verifyCode: '123456'
};

function openNiceConsent() {
  document.getElementById('niceModal').classList.add('open');
  document.body.style.overflow = 'hidden';
  // 폼/상태 초기화 (재진입 대비)
  document.getElementById('niceVerifyRow').classList.remove('show');
  document.getElementById('niceSubmitBtn').textContent = '본인인증 요청';
  document.getElementById('niceVerifyCode').value = '';
  niceVerifyStep = 0;
  if (niceVerifyTimerId) { clearInterval(niceVerifyTimerId); niceVerifyTimerId = null; }

  // 🧪 데모 자동 입력
  document.querySelectorAll('.nice-agree-req').forEach(cb => cb.checked = true);
  document.getElementById('niceAgreeAll').checked = true;
  document.getElementById('niceName').value = DEMO_AUTOFILL.name;
  document.getElementById('niceJuminFront').value = DEMO_AUTOFILL.juminFront;
  document.getElementById('niceJuminBack').value = DEMO_AUTOFILL.juminBack;
  document.getElementById('niceCarrier').value = DEMO_AUTOFILL.carrier;
  document.getElementById('nicePhone').value = DEMO_AUTOFILL.phone;
  niceCheckCanSubmit();
}
function closeNiceConsent() {
  document.getElementById('niceModal').classList.remove('open');
  document.body.style.overflow = '';
  if (niceVerifyTimerId) { clearInterval(niceVerifyTimerId); niceVerifyTimerId = null; }
}
function niceAgreeAllToggle(checked) {
  document.querySelectorAll('.nice-agree-req').forEach(cb => cb.checked = checked);
  niceCheckCanSubmit();
}
function niceAgreeChange() {
  const all = document.querySelectorAll('.nice-agree-req');
  const allChecked = Array.from(all).every(cb => cb.checked);
  document.getElementById('niceAgreeAll').checked = allChecked;
  niceCheckCanSubmit();
}
function niceCheckCanSubmit() {
  const allTermsOk = Array.from(document.querySelectorAll('.nice-agree-req')).every(cb => cb.checked);
  document.getElementById('niceSubmitBtn').disabled = !allTermsOk;
}
function niceViewTerm(n) {
  const titles = {
    1: '개인(신용)정보 수집·이용 동의',
    2: '개인(신용)정보 제3자 제공 동의',
    3: '개인(신용)정보 조회 동의',
    4: '본인확인 서비스 이용약관'
  };
  alert('[' + titles[n] + ']\n\n약관 전문은 정식 연동 후 별도 페이지로 노출됩니다.');
}
function niceRequestCode() {
  const name = document.getElementById('niceName').value.trim();
  const juminFront = document.getElementById('niceJuminFront').value.trim();
  const juminBack = document.getElementById('niceJuminBack').value.trim();
  const carrier = document.getElementById('niceCarrier').value;
  const phoneRaw = document.getElementById('nicePhone').value.replace(/[-\s]/g,'');
  if (!name) { alert('이름을 입력해주세요.'); document.getElementById('niceName').focus(); return; }
  if (!/^\d{6}$/.test(juminFront)) { alert('주민등록번호 앞 6자리를 정확히 입력해주세요.'); document.getElementById('niceJuminFront').focus(); return; }
  if (!/^[1-4]$/.test(juminBack)) { alert('주민등록번호 뒷자리 첫 1자리(1~4)를 입력해주세요.'); document.getElementById('niceJuminBack').focus(); return; }
  if (!carrier) { alert('통신사를 선택해주세요.'); document.getElementById('niceCarrier').focus(); return; }
  if (!/^010\d{8}$/.test(phoneRaw)) { alert('올바른 휴대폰 번호를 입력해주세요. (예: 010-1234-5678)'); document.getElementById('nicePhone').focus(); return; }

  document.getElementById('niceVerifyRow').classList.add('show');
  document.getElementById('niceSubmitBtn').textContent = '인증 완료 및 다음 단계';
  niceVerifyStep = 1;
  // 🧪 데모: 인증번호 자동 입력
  document.getElementById('niceVerifyCode').value = DEMO_AUTOFILL.verifyCode;
  if (niceVerifyTimerId) clearInterval(niceVerifyTimerId);
  let sec = 180;
  const timerEl = document.getElementById('niceVerifyTimer');
  const tick = () => {
    const m = Math.floor(sec/60), s = sec%60;
    timerEl.textContent = '남은 시간 ' + m + ':' + s.toString().padStart(2,'0');
    if (sec <= 0) {
      clearInterval(niceVerifyTimerId); niceVerifyTimerId = null;
      timerEl.textContent = '시간 만료 — 재전송 해주세요';
    }
    sec--;
  };
  tick();
  niceVerifyTimerId = setInterval(tick, 1000);
}
function niceSubmit() {
  // Step 0: 인증번호 발송 (입력 필드 펼침)
  if (niceVerifyStep === 0) { niceRequestCode(); return; }
  // Step 1: 인증번호 검증 → Track 2 (현대캐피탈 본인인증)로 체인
  const code = document.getElementById('niceVerifyCode').value.trim();
  if (!/^\d{6}$/.test(code)) { alert('6자리 인증번호를 입력해주세요.'); document.getElementById('niceVerifyCode').focus(); return; }
  if (niceVerifyTimerId) { clearInterval(niceVerifyTimerId); niceVerifyTimerId = null; }
  closeNiceConsent();
  // 약간의 전환 텀 후 본인인증 화면 (현대캐피탈) 오픈
  setTimeout(openHyundaiAuth, 120);
}

/* ===== 현대캐피탈 본인인증 모달 ===== */
let haSelectedCarrier = 'SKT';
let haAgreed = false;
let haCodeSent = false;
let haTimerId = null;
function openHyundaiAuth() {
  document.getElementById('haModal').classList.add('open');
  document.body.style.overflow = 'hidden';
  // 폼/상태 초기화 (재진입 대비)
  haCodeSent = false;
  document.getElementById('haCodeField').style.display = 'none';
  document.getElementById('haCode').value = '';
  if (haTimerId) { clearInterval(haTimerId); haTimerId = null; }
  document.getElementById('haTimer').classList.remove('expired');
  document.getElementById('haTimer').textContent = '3:00';
  // 약관 펼침 상태 리셋
  document.getElementById('haAgreeDetails').classList.remove('show');
  document.getElementById('haAgreeChevron').classList.remove('expanded');

  // 🧪 데모 자동 입력
  document.getElementById('haName').value = DEMO_AUTOFILL.name;
  document.getElementById('haJuminFront').value = DEMO_AUTOFILL.juminFront;
  document.getElementById('haJuminBack').value = DEMO_AUTOFILL.juminBack;
  haSelectedCarrier = DEMO_AUTOFILL.carrier;
  document.querySelectorAll('.ha-carrier-btn').forEach(b => {
    b.classList.toggle('selected', b.dataset.carrier === DEMO_AUTOFILL.carrier);
  });
  haAgreed = true;
  document.getElementById('haAgreeCard').classList.add('checked');
  document.getElementById('haPhone').value = DEMO_AUTOFILL.phone;
  haCheckForm();
}
function closeHyundaiAuth() {
  document.getElementById('haModal').classList.remove('open');
  document.body.style.overflow = '';
  if (haTimerId) { clearInterval(haTimerId); haTimerId = null; }
}
function haToggleAgree() {
  haAgreed = !haAgreed;
  document.getElementById('haAgreeCard').classList.toggle('checked', haAgreed);
  haCheckForm();
}
function haToggleAgreeExpand() {
  const details = document.getElementById('haAgreeDetails');
  const chevron = document.getElementById('haAgreeChevron');
  const expanded = details.classList.toggle('show');
  chevron.classList.toggle('expanded', expanded);
}
function haViewSubTerm(n) {
  const titles = {
    1: '개인정보 수집·이용 동의',
    2: '고유식별정보 처리 동의',
    3: '통신사 이용약관 동의',
    4: '서비스 이용약관 동의'
  };
  alert('[' + titles[n] + ']\n\n약관 전문은 정식 연동 후 별도 페이지로 노출됩니다.');
}
function haCheckForm() {
  const name = document.getElementById('haName').value.trim();
  const juminFront = document.getElementById('haJuminFront').value.trim();
  const juminBack = document.getElementById('haJuminBack').value.trim();
  const phoneRaw = document.getElementById('haPhone').value.replace(/[-\s]/g,'');
  const codeRaw = document.getElementById('haCode').value.trim();

  // 인증번호 전송 버튼 활성 조건: 이름+생년월일7자리+통신사+휴대폰번호+약관 동의
  const canSend = name.length >= 2
    && /^\d{6}$/.test(juminFront)
    && /^[1-4]$/.test(juminBack)
    && haSelectedCarrier
    && /^010\d{8}$/.test(phoneRaw)
    && haAgreed;
  const sendBtn = document.getElementById('haSendBtn');
  if (haCodeSent) {
    sendBtn.classList.remove('active');
    sendBtn.classList.add('sent');
    sendBtn.textContent = '재전송';
    sendBtn.disabled = false;
  } else {
    sendBtn.classList.toggle('active', canSend);
    sendBtn.classList.remove('sent');
    sendBtn.textContent = '인증번호 전송';
    sendBtn.disabled = !canSend;
  }

  // 다음 버튼: 인증번호 전송 후 6자리 입력 시
  const canNext = haCodeSent && /^\d{6}$/.test(codeRaw) && canSend;
  const nextBtn = document.getElementById('haNextBtn');
  nextBtn.classList.toggle('active', canNext);
  nextBtn.disabled = !canNext;
}
function haSendCode() {
  if (document.getElementById('haSendBtn').disabled) return;
  document.getElementById('haCodeField').style.display = 'flex';
  haCodeSent = true;
  // 🧪 데모: 인증번호 자동 입력
  document.getElementById('haCode').value = DEMO_AUTOFILL.verifyCode;
  haStartTimer();
  haCheckForm();
}
function haStartTimer() {
  if (haTimerId) clearInterval(haTimerId);
  let sec = 180;
  const timerEl = document.getElementById('haTimer');
  timerEl.classList.remove('expired');
  const tick = () => {
    const m = Math.floor(sec/60), s = sec%60;
    timerEl.textContent = m + ':' + s.toString().padStart(2,'0');
    if (sec <= 0) {
      clearInterval(haTimerId); haTimerId = null;
      timerEl.textContent = '시간 만료';
      timerEl.classList.add('expired');
    }
    sec--;
  };
  tick();
  haTimerId = setInterval(tick, 1000);
}
function haNext() {
  if (document.getElementById('haNextBtn').disabled) return;
  if (haTimerId) { clearInterval(haTimerId); haTimerId = null; }
  closeHyundaiAuth();
  // 다음 단계: 신용정보조회 동의 화면
  setTimeout(openCreditInfoConsent, 120);
}

/* ===== 신용정보조회 동의 모달 (본인인증 후) ===== */
const CI_SUB_TITLES = {
  '1': ['개인(신용)정보 수집·이용 동의','고유식별정보 수집·이용 동의','개인(신용)정보 조회 동의','고유식별정보 조회 동의','개인(신용)정보 제공 동의','고유식별정보 제공 동의'],
  '2': [],
  '3': ['개인(신용)정보 이용 관련 동의','개인(신용)정보 제3자 제공 관련 동의']
};
const CI_MAIN_TITLES = {
  '1': '현대캐피탈 신차렌트 선택형 상품 이용을 위한 개인(신용)정보 처리 동의',
  '2': '현대캐피탈 표준 전자금융거래 기본 약관',
  '3': '금융결제원 자동이체 정보를 이용한 심사·유지 목적 개인(신용)정보 처리 동의'
};
function openCreditInfoConsent() {
  document.getElementById('ciModal').classList.add('open');
  document.body.style.overflow = 'hidden';
  // 🧪 데모: 3개 동의 모두 체크 + 펼쳐진 카드(1, 3)는 펼침
  [1,2,3].forEach(id => document.getElementById('ciCard'+id).classList.add('checked'));
  [1,3].forEach(id => {
    document.getElementById('ciDetails'+id).classList.add('show');
    document.getElementById('ciToggle'+id).classList.add('expanded');
  });
  ciCheckCanNext();
}
function closeCreditInfoConsent() {
  document.getElementById('ciModal').classList.remove('open');
  document.body.style.overflow = '';
}
function ciToggleAgree(id) {
  document.getElementById('ciCard'+id).classList.toggle('checked');
  ciCheckCanNext();
}
function ciToggleExpand(id) {
  const details = document.getElementById('ciDetails'+id);
  const toggle = document.getElementById('ciToggle'+id);
  const expanded = details.classList.toggle('show');
  toggle.classList.toggle('expanded', expanded);
}
function ciViewMain(id) {
  alert('[' + CI_MAIN_TITLES[id] + ']\n\n약관 전문은 정식 연동 후 별도 페이지로 노출됩니다.');
}
function ciViewSub(id, idx) {
  const t = (CI_SUB_TITLES[id] || [])[idx] || '약관';
  alert('[' + t + ']\n\n약관 전문은 정식 연동 후 별도 페이지로 노출됩니다.');
}
function ciCheckCanNext() {
  const allChecked = [1,2,3].every(id => document.getElementById('ciCard'+id).classList.contains('checked'));
  document.getElementById('ciNextBtn').disabled = !allChecked;
}
function ciNext() {
  if (document.getElementById('ciNextBtn').disabled) return;
  closeCreditInfoConsent();
  // 다음 단계: 계약 단계 안내
  setTimeout(openContractSteps, 120);
}

/* ===== 계약 단계 안내 모달 ===== */
function maskKoreanName(name) {
  if (!name) return '고객';
  const n = name.trim();
  if (n.length <= 1) return n;
  if (n.length === 2) return n[0] + '*';
  return n[0] + '*' + n.slice(-1);
}
function openContractSteps() {
  document.getElementById('csModal').classList.add('open');
  document.body.style.overflow = 'hidden';
  // 이름 마스킹: 가장 최근 입력값 우선, 없으면 데모 기본값
  const name = (document.getElementById('haName')?.value
    || document.getElementById('niceName')?.value
    || DEMO_AUTOFILL.name);
  document.getElementById('csCustomerName').textContent = maskKoreanName(name) + ' 고객';
  // 스크롤 위치 초기화
  document.getElementById('csModal').scrollTop = 0;
  document.querySelector('#csModal .cs-card').scrollTop = 0;
}
function closeContractSteps() {
  document.getElementById('csModal').classList.remove('open');
  document.body.style.overflow = '';
}
function csNext() {
  closeContractSteps();
  // 다음 단계: 금융사기 안내
  setTimeout(openFinancialFraudAlert, 120);
}

/* ===== 금융사기 안내 모달 ===== */
function openFinancialFraudAlert() {
  document.getElementById('ffModal').classList.add('open');
  document.body.style.overflow = 'hidden';
  document.getElementById('ffModal').scrollTop = 0;
}
function closeFinancialFraudAlert() {
  document.getElementById('ffModal').classList.remove('open');
  document.body.style.overflow = '';
}
function ffStop() {
  closeFinancialFraudAlert();
  alert('신청이 중단되었습니다.');
}
function ffContinue() {
  closeFinancialFraudAlert();
  // 다음 단계: 면허증 확인
  setTimeout(openLicenseVerify, 120);
}

/* ===== 면허증 확인 모달 ===== */
const DLV_DUMMY = {
  licType: '1종보통',
  issuer: '서울',
  licNo: '12-123456-12',
  serial: '1A2B3C'
};
let dlvAgreed = false;
let dlvAutofillOn = false;
function openLicenseVerify() {
  document.getElementById('dlvModal').classList.add('open');
  document.body.style.overflow = 'hidden';
  document.getElementById('dlvModal').scrollTop = 0;
  // 🧪 데모 자동 입력: 자동입력 토글 on + 폼 채움 + 동의 체크
  dlvAutofillOn = true;
  document.getElementById('dlvAutofillBtn').classList.add('active');
  document.getElementById('dlvLicType').value = DLV_DUMMY.licType;
  document.getElementById('dlvIssuer').value = DLV_DUMMY.issuer;
  document.getElementById('dlvLicNo').value = DLV_DUMMY.licNo;
  document.getElementById('dlvSerial').value = DLV_DUMMY.serial;
  dlvAgreed = true;
  document.getElementById('dlvAgreeCard').classList.add('checked');
  // 확인사항 2개도 체크 표시
  document.getElementById('dlvCheck1').classList.add('checked');
  document.getElementById('dlvCheck2').classList.add('checked');
  // 펼침 상태 리셋
  document.getElementById('dlvAgreeDetails').classList.remove('show');
  document.getElementById('dlvAgreeToggle').classList.remove('expanded');
  dlvCheckForm();
}
function closeLicenseVerify() {
  document.getElementById('dlvModal').classList.remove('open');
  document.body.style.overflow = '';
}
function dlvToggleAutofill() {
  dlvAutofillOn = !dlvAutofillOn;
  document.getElementById('dlvAutofillBtn').classList.toggle('active', dlvAutofillOn);
  if (dlvAutofillOn) {
    document.getElementById('dlvLicType').value = DLV_DUMMY.licType;
    document.getElementById('dlvIssuer').value = DLV_DUMMY.issuer;
    document.getElementById('dlvLicNo').value = DLV_DUMMY.licNo;
    document.getElementById('dlvSerial').value = DLV_DUMMY.serial;
  } else {
    document.getElementById('dlvLicType').value = '';
    document.getElementById('dlvIssuer').value = '';
    document.getElementById('dlvLicNo').value = '';
    document.getElementById('dlvSerial').value = '';
  }
  dlvCheckForm();
}
function dlvToggleAgree() {
  dlvAgreed = !dlvAgreed;
  document.getElementById('dlvAgreeCard').classList.toggle('checked', dlvAgreed);
  dlvCheckForm();
}
function dlvToggleAgreeExpand() {
  const details = document.getElementById('dlvAgreeDetails');
  const toggle = document.getElementById('dlvAgreeToggle');
  const expanded = details.classList.toggle('show');
  toggle.classList.toggle('expanded', expanded);
}
function dlvViewCheckItem(n) {
  const titles = { 1: '운전자 범위 필수 안내 사항', 2: '운전자격 필수 확인 사항' };
  alert('[' + titles[n] + ']\n\n약관 전문은 정식 연동 후 별도 페이지로 노출됩니다.');
}
function dlvCheckForm() {
  const licType = document.getElementById('dlvLicType').value;
  const issuer = document.getElementById('dlvIssuer').value;
  const licNo = document.getElementById('dlvLicNo').value.trim();
  const serial = document.getElementById('dlvSerial').value.trim();
  const canNext = !!(licType && issuer && licNo && serial && dlvAgreed);
  const btn = document.getElementById('dlvNextBtn');
  btn.classList.toggle('active', canNext);
  btn.disabled = !canNext;
}
function dlvNext() {
  if (document.getElementById('dlvNextBtn').disabled) return;
  // 다음 화면 — 사용자가 디자인 제공 예정
  alert('면허증 확인 완료.\n다음 화면 디자인 대기 중입니다.');
}
/* 통신사 버튼 선택 + 입력 마스킹 */
document.addEventListener('DOMContentLoaded', () => {
  // 통신사 토글
  document.querySelectorAll('.ha-carrier-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.ha-carrier-btn').forEach(b => b.classList.remove('selected'));
      btn.classList.add('selected');
      haSelectedCarrier = btn.dataset.carrier;
      haCheckForm();
    });
  });
  // 휴대폰 자동 하이픈
  const phone = document.getElementById('haPhone');
  if (phone) {
    phone.addEventListener('input', e => {
      let v = e.target.value.replace(/\D/g,'').slice(0,11);
      if (v.length >= 7) v = v.slice(0,3)+'-'+v.slice(3,7)+'-'+v.slice(7);
      else if (v.length >= 4) v = v.slice(0,3)+'-'+v.slice(3);
      e.target.value = v;
      haCheckForm();
    });
  }
  // 생년월일 6자리 → 뒷자리 자동 포커스
  const jf = document.getElementById('haJuminFront');
  const jb = document.getElementById('haJuminBack');
  if (jf && jb) {
    jf.addEventListener('input', e => {
      e.target.value = e.target.value.replace(/\D/g,'').slice(0,6);
      if (e.target.value.length === 6) jb.focus();
      haCheckForm();
    });
    jb.addEventListener('input', e => {
      e.target.value = e.target.value.replace(/\D/g,'').slice(0,1);
      haCheckForm();
    });
  }
  // 인증번호 숫자만
  const code = document.getElementById('haCode');
  if (code) {
    code.addEventListener('input', e => {
      e.target.value = e.target.value.replace(/\D/g,'').slice(0,6);
      haCheckForm();
    });
  }

  /* ===== NICE 모달 입력 포맷팅 (Track 1) ===== */
  const nicePhoneEl = document.getElementById('nicePhone');
  if (nicePhoneEl) {
    nicePhoneEl.addEventListener('input', e => {
      let v = e.target.value.replace(/\D/g,'').slice(0,11);
      if (v.length >= 7) v = v.slice(0,3)+'-'+v.slice(3,7)+'-'+v.slice(7);
      else if (v.length >= 4) v = v.slice(0,3)+'-'+v.slice(3);
      e.target.value = v;
    });
  }
  const nJf = document.getElementById('niceJuminFront');
  const nJb = document.getElementById('niceJuminBack');
  if (nJf && nJb) {
    nJf.addEventListener('input', e => {
      e.target.value = e.target.value.replace(/\D/g,'').slice(0,6);
      if (e.target.value.length === 6) nJb.focus();
    });
    nJb.addEventListener('input', e => { e.target.value = e.target.value.replace(/\D/g,'').slice(0,1); });
  }
  const nCode = document.getElementById('niceVerifyCode');
  if (nCode) {
    nCode.addEventListener('input', e => { e.target.value = e.target.value.replace(/\D/g,'').slice(0,6); });
  }
});

function openKakaoLogin() {
  const isMobile = window.matchMedia && window.matchMedia('(max-width: 768px)').matches;
  if (isMobile) {
    closeQuoteModal();
    setTimeout(function(){ location.href = 'kakao_login.php'; }, 150);
    return;
  }
  // 데스크탑: iframe 팝업
  closeQuoteModal();
  const overlay = document.getElementById('kakaoOverlay');
  const frame = document.getElementById('kakaoFrame');
  if (!overlay || !frame) { location.href = 'kakao_login.php'; return; }
  frame.src = 'kakao_login.php';
  overlay.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeKakaoOverlay() {
  const overlay = document.getElementById('kakaoOverlay');
  const frame = document.getElementById('kakaoFrame');
  if (overlay) overlay.classList.remove('open');
  if (frame) frame.src = '';
  document.body.style.overflow = '';
}
function confirmQuote() {
  const nameEl = document.getElementById('qcName');
  const phoneEl = document.getElementById('qcPhone');
  // 토스트 모드(필드 영역 없음)면 그냥 닫기
  if (!nameEl || !phoneEl) { closeQuoteModal(); return; }
  const name = nameEl.value.trim();
  const phone = phoneEl.value.trim();
  if (!name) { nameEl.focus(); alert('이름을 입력해주세요.'); return; }
  if (!phone) { phoneEl.focus(); alert('연락처를 입력해주세요.'); return; }
  alert('견적 신청이 접수되었습니다.\n담당자가 곧 연락드리겠습니다.');
  nameEl.value = ''; phoneEl.value = '';
  closeQuoteModal();
}
function showQuoteToast(msg) {
  const body = document.getElementById('quoteModalBody');
  body.style.display = '';
  body.innerHTML = `<div style="text-align:center;padding:1rem 0;color:#525252;font-size:.92rem">${msg}</div>`;
  document.querySelector('.quote-modal-title').textContent = '알림';
  document.querySelector('.quote-modal-sub').style.display = 'none';
  document.querySelector('.quote-modal-icon').style.background = '#fef3c7';
  document.querySelector('.quote-modal-icon svg').style.stroke = '#d97706';
  document.getElementById('quoteContact').style.display = 'none';
  document.getElementById('quoteSignup').style.display = 'none';
  document.getElementById('quoteModal').style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

function submitQuote() {
  // 빠른출고 차량
  if (isLimited) {
    const period = document.querySelector('.rental-btns[data-group="period"] .rental-btn.selected')?.dataset.value || '48';
    const deposit = document.querySelector('.rental-btns[data-group="deposit"] .rental-btn.selected')?.dataset.value || '0';
    const prepay = document.querySelector('.rental-btns[data-group="prepay"] .rental-btn.selected')?.dataset.value || '0';
    const mileage = document.querySelector('.rental-btns[data-group="mileage"] .rental-btn.selected')?.dataset.value || '20000';
    const trim = params.get('trim') || '';
    const opts = params.get('options') || '';
    const monthlyTxt = document.getElementById('ctaPriceValue')?.textContent || '-';
    showQuoteModal([
      {label:'차량', value:`${carName} (빠른출고)`},
      {label:'트림', value:trim || '-'},
      {label:'색상', value:`${params.get('color_ext')||'-'} / ${params.get('color_int')||'-'}`},
      {label:'옵션', value:opts || '-'},
      {label:'이용기간', value:`${period}개월`},
      {label:'연간 주행거리', value: mileage==='unlimited' ? '무제한' : parseInt(mileage).toLocaleString()+'km'},
      {label:'선납금', value:`${prepay}%`},
      {label:'보증금', value:`${deposit}%`},
      {label:'월 납입금', value:monthlyTxt, price:true},
    ]);
    return;
  }

  // 일반 검색 차량
  if (!selectedTrim) {
    showQuoteToast('트림을 선택해주세요.');
    return;
  }

  const basePriceManwon = selectedTrim.base_price / 10000;
  let optTotalManwon = 0;
  const optNamesArr = selectedOptions
    .map(idx => selectedTrim.option_packages[idx])
    .filter(Boolean);
  optNamesArr.forEach(name => {
    const m = name.match(/\(([\d,]+)\s*만원\)/);
    if (m) optTotalManwon += parseInt(m[1].replace(/,/g, ''), 10) || 0;
  });
  const totalManwon = basePriceManwon + optTotalManwon;
  const totalStr = Math.round(totalManwon).toLocaleString();

  const rows = [
    {label:'차량', value:selectedCar.name},
    {label:'트림', value:selectedTrim.name},
    {label:'전체 가격', value:`${totalStr}만원`, price:true},
  ];
  if (optNamesArr.length > 0) {
    rows.push({label:'선택 옵션', value:optNamesArr.join('<br>')});
  }
  showQuoteModal(rows);
}

// 아코디언 토글 (모바일 전용)
function toggleAcc(btn) {
  const block = btn.closest('.acc-block');
  if (block) block.classList.toggle('open');
}

// 일반 차량 월 납입금 자동 계산
function updateCarMonthly() {
  if (typeof isLimited !== 'undefined' && isLimited) return;
  const ctaEl = document.getElementById('ctaPriceValue');
  if (!ctaEl) return;
  if (typeof selectedTrim === 'undefined' || !selectedTrim) { ctaEl.textContent = '-'; return; }
  const basePriceWon = selectedTrim.base_price || 0;
  let optTotalManwon = 0;
  (selectedOptions||[]).forEach(idx => {
    const opt = selectedTrim.option_packages?.[idx];
    if (!opt) return;
    const m = opt.match(/\(([\d,]+)\s*만원\)/);
    if (m) optTotalManwon += parseInt(m[1].replace(/,/g,''), 10) || 0;
  });
  const vehicleWon = basePriceWon + optTotalManwon * 10000;
  const depositPct = parseInt(document.querySelector('.rental-btns[data-group="deposit"] .rental-btn.selected')?.dataset.value || '0');
  const periodVal  = document.querySelector('.rental-btns[data-group="period"] .rental-btn.selected')?.dataset.value || '48';
  const mileageVal = document.querySelector('.rental-btns[data-group="mileage"] .rental-btn.selected')?.dataset.value || '20000';
  const prepayVal  = document.querySelector('.rental-btns[data-group="prepay"] .rental-btn.selected')?.dataset.value || '0';
  const productVal = document.querySelector('.rental-btns[data-group="product"] .rental-btn.selected')?.dataset.value || 'rent';
  const price0  = Math.round(vehicleWon * 0.0145);
  const price30 = Math.round(vehicleWon * 0.0109);
  let monthly = price0 - (price0 - price30) * (depositPct / 30);
  const PERIOD_MULT  = { '36':1.08, '48':1.00, '60':0.93 };
  const MILEAGE_MULT = { '10000':0.95, '20000':1.00, '30000':1.05, '40000':1.10, 'unlimited':1.18 };
  const PREPAY_MULT  = { '0':1.00, '10':0.95, '20':0.90, '30':0.85 };
  const PRODUCT_MULT = { 'rent':1.00, 'lease':0.88 };
  monthly = Math.round(monthly * (PERIOD_MULT[periodVal]||1) * (MILEAGE_MULT[mileageVal]||1) * (PREPAY_MULT[prepayVal]||1) * (PRODUCT_MULT[productVal]||1));
  ctaEl.textContent = monthly.toLocaleString() + '원';
}

// 렌탈 옵션 버튼 클릭
document.querySelectorAll('.rental-btns').forEach(group => {
  group.addEventListener('click', e => {
    const btn = e.target.closest('.rental-btn');
    if (!btn) return;
    group.querySelectorAll('.rental-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    updateCarMonthly();
  });
});

// 도움말 툴팁 토글
let activeTip = null;
document.addEventListener('click', e => {
  const btn = e.target.closest('.rental-help');
  if (activeTip) {
    activeTip.remove();
    activeTip = null;
    if (!btn) return;
  }
  if (!btn) return;
  e.stopPropagation();
  const tip = document.createElement('div');
  tip.className = 'rental-tip';
  tip.textContent = btn.dataset.tip || '';
  document.body.appendChild(tip);
  const rect = btn.getBoundingClientRect();
  const tipRect = tip.getBoundingClientRect();
  let left = rect.left + window.scrollX - 8;
  const maxLeft = window.innerWidth - tipRect.width - 12;
  if (left > maxLeft) left = maxLeft;
  if (left < 8) left = 8;
  tip.style.top = (rect.bottom + window.scrollY + 8) + 'px';
  tip.style.left = left + 'px';
  activeTip = tip;
});

</script>
</body>
</html>
