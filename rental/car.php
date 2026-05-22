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
.page-backbar{max-width:1200px;margin:0 auto;padding:.75rem 1rem .25rem}
@media(max-width:768px){
  .page-backbar{position:sticky;top:44px;z-index:40;max-width:none;margin:0;padding:.55rem 1rem;background:rgba(255,255,255,.96);backdrop-filter:saturate(140%) blur(6px);-webkit-backdrop-filter:saturate(140%) blur(6px);border-bottom:1px solid #f0f0f0}
}
.back-btn{display:inline-flex;align-items:center;gap:.25rem;background:none;border:none;color:#171717;font-size:.95rem;font-weight:500;cursor:pointer;padding:.4rem .25rem;font-family:inherit;letter-spacing:-.01em}
.back-btn:hover{color:#525252}
@media(max-width:768px){
  .hamburger{display:flex!important}
  .gnb-nav{display:none!important}
  .gnb-topright{display:none}
  .gnb-subnav{display:none!important}
}

.car-hero{background:#fff;padding:1.5rem 2rem 2rem;margin-bottom:1.5rem;border-radius:1rem}

.rental-options{padding:1.5rem 1.25rem;background:#fff;margin-bottom:1.5rem;border-radius:1rem;border:1px solid #f0f0f0}

/* ===== 아코디언 (모바일 전용) ===== */
.acc-block{margin-bottom:.75rem}
.acc-header{display:none;width:100%;background:#fff;border:1px solid #f0f0f0;border-radius:1rem;padding:1.05rem 1.25rem;font-family:inherit;font-size:1.02rem;font-weight:800;color:#0a0a0a;letter-spacing:-.01em;cursor:pointer;text-align:left;align-items:center;justify-content:space-between;gap:.6rem;transition:border-color .15s}
.acc-header:hover{border-color:#d4d4d4}
.acc-header-title{flex:1;min-width:0;display:flex;align-items:center;gap:.5rem}
.acc-chevron{width:1rem;height:1rem;flex-shrink:0;transition:transform .25s ease;color:#737373}
.acc-block.open .acc-chevron{transform:rotate(180deg)}
.acc-body{transition:max-height .3s ease}

@media(max-width:768px){
  .acc-header{display:flex}
  .acc-block{margin-bottom:.65rem}
  .acc-block:not(.open) > .acc-body{display:none}
  .acc-block.open > .acc-header{border-bottom-left-radius:0;border-bottom-right-radius:0;border-bottom:none;margin-bottom:0}
  .acc-block.open > .acc-body > .section,
  .acc-block.open > .acc-body > .color-section,
  .acc-block.open > .acc-body > .rental-options{border-top-left-radius:0;border-top-right-radius:0;margin-bottom:0;border-top:none}
}
.rental-row{padding:1.1rem 0;border-bottom:1px solid #f0f0f0}
.rental-row:first-child{padding-top:.25rem}
.rental-row:last-child{border-bottom:none;padding-bottom:.25rem}
.rental-label{font-size:1rem;font-weight:800;color:#171717;margin-bottom:.7rem;display:flex;align-items:center;gap:.4rem;letter-spacing:-.01em}
.rental-label-desc{font-size:.72rem;font-weight:400;color:#a3a3a3;font-weight:500}
.rental-help{display:inline-flex;align-items:center;justify-content:center;width:1.15rem;height:1.15rem;border-radius:50%;background:#e5e5e5;color:#525252;font-size:.72rem;font-weight:800;border:none;cursor:pointer;font-family:inherit;line-height:1;padding:0;transition:background .15s;flex-shrink:0}
.rental-help:hover{background:#d4d4d4;color:#0a0a0a}
.rental-tip{position:absolute;background:#1c1917;color:#fff;padding:.6rem .8rem;border-radius:.5rem;font-size:.78rem;font-weight:500;max-width:260px;line-height:1.45;z-index:999;box-shadow:0 6px 18px rgba(0,0,0,.25);letter-spacing:-.01em;animation:tipFade .15s ease-out}
.rental-tip::after{content:'';position:absolute;bottom:100%;left:.85rem;border:6px solid transparent;border-bottom-color:#1c1917}
@keyframes tipFade{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:translateY(0)}}
.rental-btns{display:flex;flex-direction:row;gap:.5rem;flex-wrap:wrap}
.rental-btn{flex:1;min-width:0;padding:.8rem .25rem;border:1px solid transparent;background:#f3f4f6;font-size:.88rem;font-weight:600;color:#525252;cursor:pointer;border-radius:.65rem;transition:all .15s;font-family:inherit;text-align:center;line-height:1.2}
.rental-btn:hover{background:#e5e7eb;color:#0a0a0a}
.rental-btn.selected{border-color:#2858E0;background:#fff;color:#0a0a0a;font-weight:800;border-width:2px;padding:calc(.8rem - 1px) .25rem}
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
.lim-discount-badge{display:inline-flex;align-items:center;gap:.25rem;background:#eff6ff;color:#1d4ed8;font-size:.72rem;font-weight:800;padding:.22rem .55rem;border-radius:999px;line-height:1}
.lim-discount-badge::before{content:"✦";color:#1d4ed8}
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
.lim-opts-list li{color:#0a0a0a;font-weight:700;line-height:1.45;display:flex;gap:.4rem;align-items:center;justify-content:space-between}
.lim-opts-list li::before{content:"·";color:#0a0a0a;flex-shrink:0;padding-top:0}
.lim-opts-list li.lim-opt-row::before{display:none}
.lim-opts-list .lim-opt-name{flex:1;min-width:0;font-weight:700;color:#0a0a0a;letter-spacing:-.01em;position:relative;padding-left:.7rem}
.lim-opts-list .lim-opt-name::before{content:"·";position:absolute;left:0;color:#0a0a0a}
.lim-opts-list .lim-opt-price{flex-shrink:0;color:#525252;font-weight:600;font-size:.85em;letter-spacing:-.01em}
.lim-opts-detail{margin-top:.65rem;padding-top:.65rem;border-top:1px solid #e5e5e5;display:flex;justify-content:center;align-items:center;gap:.25rem;color:#525252;font-size:.85rem;font-weight:600;cursor:pointer}
.lim-opts-detail::after{content:"›";font-weight:900}
.model-group{margin-bottom:2rem}
.model-group-title{font-size:1.1rem;font-weight:700;color:#0a0a0a;margin-bottom:.75rem}
.model-list,.trim-list{display:flex;flex-direction:column;gap:.5rem;max-width:100%}
.model-item,.trim-card{border:2px solid #e5e5e5;border-radius:.75rem;padding:.85rem 1rem;cursor:pointer;transition:all .2s;background:#f5f5f5;position:relative;padding-left:2.75rem;display:flex;align-items:center;justify-content:space-between}
.model-item:hover,.trim-card:hover{background:#ececec}
.model-item.selected,.trim-card.selected{border-color:#2858E0;background:#fff}
.model-item.selected::before,.trim-card.selected::before{content:'✓';position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:#2858E0;font-weight:900;font-size:1.1rem}
.model-item-name,.trim-name{font-weight:400;font-size:.85rem;color:#0a0a0a;flex:1;line-height:1.4}
.trim-price{font-size:.95rem;font-weight:600;color:#0a0a0a;white-space:nowrap;margin-left:1rem;align-self:flex-start}

.options-panel{margin-top:.5rem;padding-left:1.5rem;animation:slideDown .2s ease}
.options-title{font-size:.85rem;font-weight:700;color:#4f46e5;margin-bottom:.5rem}
.options-box{display:flex;flex-direction:column;gap:.5rem}
.option-item{border:2px solid #e5e5e5;border-radius:.75rem;padding:.85rem 1rem;cursor:pointer;transition:all .2s;background:#f5f5f5;position:relative;padding-left:2.75rem}
.option-item.standard{cursor:default;opacity:.6}
.option-item:hover:not(.standard){background:#ececec}
.option-item.selected{background:#fff!important;border-color:#2858E0!important}
.option-item.selected::before{content:'✓';position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:#2858E0;font-weight:900;font-size:1.1rem}
.option-name{font-size:.85rem;font-weight:400;color:#0a0a0a}
.option-desc{font-size:.8rem;color:#737373;margin-top:.25rem}
@keyframes slideDown{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}

.color-section{background:#fff;padding:2rem;margin-bottom:1.5rem;border-radius:1rem}
.color-group{margin-bottom:1.5rem}
.color-group:last-child{margin-bottom:0}
.color-group-title{font-size:1rem;font-weight:700;color:#0a0a0a;margin-bottom:.85rem}
.color-list{display:flex;flex-direction:column;gap:.4rem}
.color-item{border:2px solid #e5e5e5;border-radius:.75rem;padding:.75rem 1rem .75rem 2.75rem;cursor:pointer;transition:all .2s;background:#f5f5f5;display:flex;align-items:center;gap:.85rem;position:relative}
.color-item:hover{background:#ececec}
.color-item.selected{border-color:#2858E0;background:#fff}
.color-item.selected::before{content:'✓';position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:#2858E0;font-weight:900;font-size:1.1rem}
.color-swatch{width:28px;height:28px;border-radius:50%;border:2px solid rgba(0,0,0,.08);flex-shrink:0}
.color-swatch.two-tone{background:linear-gradient(135deg,var(--c1) 50%,var(--c2) 50%)}
.color-name{font-size:.85rem;font-weight:400;color:#0a0a0a}

.cta-box{position:fixed;bottom:44px;left:0;right:0;z-index:100;background:#1f2937;padding:.85rem 1rem;border-top:1px solid #111827;display:flex;flex-direction:column;gap:.7rem;padding-bottom:.85rem;border-top-left-radius:1rem;border-top-right-radius:1rem}
.car-icon-nav{position:fixed;bottom:0;left:0;right:0;z-index:99;background:#fff;border-top:1px solid #e5e5e5;display:none;align-items:stretch;padding-bottom:env(safe-area-inset-bottom)}
@media(max-width:768px){.car-icon-nav{display:flex}}
.car-icon-nav a{flex:1;display:flex;align-items:center;justify-content:center;padding:.55rem .25rem;color:#a3a3a3;text-decoration:none;transition:color .12s}
.car-icon-nav a:hover{color:#171717}
.car-icon-nav a.active{color:#dc2626}
.car-icon-nav a.quick{color:#0a0a0a}
.cta-price-bar{display:flex;align-items:center;justify-content:space-between;gap:.5rem;padding:0 .15rem}
.cta-price-label{font-size:.92rem;font-weight:700;color:#d1d5db;letter-spacing:-.01em}
.cta-price-value{font-size:1.25rem;font-weight:900;color:#fff;letter-spacing:-.02em}
.cta-btns{display:flex;gap:.5rem}
.cta-btn{flex:1;padding:.85rem .5rem;font-size:.95rem;font-weight:800;border:none;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:.4rem;border-radius:.6rem}
.cta-primary{background:#fff;color:#0a0a0a}
.cta-primary:hover{background:#f3f4f6}
.cta-kakao{background:#FEE500;color:#191919}
.cta-kakao:hover{background:#f0d800}
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
  .rental-label{margin-bottom:0;font-size:1.05rem;flex-direction:column;align-items:flex-start;gap:.3rem}
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
  main{padding-bottom:9rem!important}
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
          <div class="lim-row-label">월 렌트료</div>
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

    <!-- 트림 선택 + 색상 선택 통합 아코디언 (모바일 전용 접힘) -->
    <div class="acc-block" data-acc="trim">
      <button class="acc-header" type="button" onclick="toggleAcc(this)">
        <span class="acc-header-title">세부모델·트림·색상 선택</span>
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
        <div class="rental-label">이용기간</div>
        <div class="rental-btns" data-group="period">
          <button class="rental-btn" data-value="36">36개월</button>
          <button class="rental-btn selected" data-value="48">48개월</button>
          <button class="rental-btn" data-value="60">60개월</button>
        </div>
      </div>
      <div class="rental-row" id="mileageRow">
        <div class="rental-label">연간 약정 주행거리<button class="rental-help" type="button" data-tip="계약 만료 후, 총 누적거리 기준 km당 추가 비용 발생" aria-label="설명 보기">?</button></div>
        <div class="rental-btns" data-group="mileage">
          <button class="rental-btn" data-value="10000">1만km</button>
          <button class="rental-btn selected" data-value="20000">2만km</button>
          <button class="rental-btn" data-value="30000">3만km</button>
          <button class="rental-btn" data-value="40000">4만km</button>
          <button class="rental-btn" data-value="unlimited">무제한</button>
        </div>
      </div>
      <div class="rental-row" id="prepayRow">
        <div class="rental-label">선납금<button class="rental-help" type="button" data-tip="미리 납부해 월 렌트료를 낮추는 금액" aria-label="설명 보기">?</button></div>
        <div class="rental-btns" data-group="prepay">
          <button class="rental-btn selected" data-value="0">없음</button>
          <button class="rental-btn" data-value="10">10%</button>
          <button class="rental-btn" data-value="20">20%</button>
          <button class="rental-btn" data-value="30">30%</button>
        </div>
      </div>
      <div class="rental-row">
        <div class="rental-label">보증금<button class="rental-help" type="button" data-tip="계약 시 맡기고 만기 후 돌려받는 금액 (보증금 이자만큼 일부 할인)" aria-label="설명 보기">?</button></div>
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
      <span class="cta-price-label">월 기본료</span>
      <span class="cta-price-value" id="ctaPriceValue">-</span>
    </div>
    <div class="cta-btns">
      <button class="cta-btn cta-primary" onclick="submitQuote()">견적 문의</button>
      <button class="cta-btn cta-kakao" onclick="submitQuote()">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><ellipse cx="9" cy="8" rx="8" ry="7" fill="#191919"/><path d="M5 8c0-1.1.9-2 2-2h4c1.1 0 2 .9 2 2 0 .8-.5 1.5-1.2 1.8L13 12H9.5l-.8-1.5C8.5 10.8 8.2 11 8 11c-1.7 0-3-1.3-3-3z" fill="#FEE500"/></svg>
        카카오로 견적 문의
      </button>
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


<?php require_once __DIR__ . '/../includes/car_data.php'; ?>
<script src="../car_brands.js"></script>
<script>
/* ===== PHP-injected data ===== */
window.COLOR_HEX_DB = <?= json_js(get_color_hex_map()) ?>;
const OPT_PRICES    = <?= json_js(get_opt_prices()) ?>;

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

  // 월 렌트료 갱신 함수 (선택된 옵션 기반)
  function updatePrice() {
    const depositPct = parseInt(document.querySelector('.rental-btns[data-group="deposit"] .rental-btn.selected')?.dataset.value || '0');
    const periodVal = document.querySelector('.rental-btns[data-group="period"] .rental-btn.selected')?.dataset.value || '48';
    const mileageVal = document.querySelector('.rental-btns[data-group="mileage"] .rental-btn.selected')?.dataset.value || '20000';
    const prepayVal = document.querySelector('.rental-btns[data-group="prepay"] .rental-btn.selected')?.dataset.value || '0';
    const periodMonths = parseInt(periodVal);

    // 보증금 0%→30% 보간으로 베이스 산정, 그 후 기간/주행/선납 보정 곱
    let monthly = price0;
    if (price0 && price30) {
      monthly = price0 - (price0 - price30) * (depositPct / 30);
    }
    const pm = PERIOD_MULT[periodVal] ?? 1;
    const mm = MILEAGE_MULT[mileageVal] ?? 1;
    const ppm = PREPAY_MULT[prepayVal] ?? 1;
    monthly = Math.round(monthly * pm * mm * ppm);

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

  // 옵션 (· 또는 ,로 split) + 가격 표시
  const optsList = document.getElementById('limOptsList');
  if (opts) {
    const items = opts.split(/[·,]/).map(s => s.trim()).filter(Boolean);
    optsList.innerHTML = items.map(it => {
      const m = it.match(/\(([^)]+)\)/);
      const priceTxt = m ? m[1] : `${guessOptPrice(it)}만원`;
      const nameTxt = m ? it.replace(/\s*\([^)]+\)\s*$/, '').trim() : it.trim();
      return `<li class="lim-opt-row"><span class="lim-opt-name">${nameTxt}</span><span class="lim-opt-price">${priceTxt}</span></li>`;
    }).join('');
  } else {
    optsList.innerHTML = '<li style="color:#a3a3a3">옵션 정보 없음</li>';
  }
}


function loadCar(name) {
  // 모든 브랜드에서 차량 찾기
  for (const brand of CAR_DATA.brands) {
    const vehicle = brand.vehicles.find(v =>
      v.name === name ||
      name.includes(v.name) ||
      v.name.includes(name)
    );

    if (vehicle && vehicle.trims && vehicle.trims.length > 0) {
      selectedCar = vehicle;
      renderCar();
      return;
    }
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
      <h3 class="model-group-title">트림선택</h3>
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
  document.getElementById('colorSection').style.display = 'none';

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
        selectedTrim.option_packages.forEach((opt, optIdx) => {
          html += `<div class="option-item" data-opt-idx="${optIdx}" onclick="toggleOption(${optIdx})"><div class="option-name">${opt}</div></div>`;
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

  // 기존 swatch 색상 섹션 항상 숨김
  if (colorSection) colorSection.style.display = 'none';

  const extColors = trim.exterior_colors || [];
  const intColors = trim.interior_colors || [];

  if (extColors.length === 0 && intColors.length === 0) {
    heroColors.style.display = 'none';
    return;
  }

  heroColors.style.display = '';

  // 외장 색상 swatch
  if (extColors.length > 0) {
    extEl.innerHTML = extColors.map(c => makeHeroSwatch(c,'ext')).join('');
    extEl.parentElement.style.display = '';
  } else {
    extEl.parentElement.style.display = 'none';
  }

  // 내장 색상 swatch
  if (intColors.length > 0) {
    intEl.innerHTML = intColors.map(c => makeHeroSwatch(c,'int')).join('');
    intEl.parentElement.style.display = '';
  } else {
    intEl.parentElement.style.display = 'none';
  }
  // 색상 선택/호버 핸들러 부착
  attachSwatchHandlers();
  // 이름 영역 초기화
  const extName = document.getElementById('heroExtName');
  const intName = document.getElementById('heroIntName');
  if (extName) extName.textContent = selectedExtColor || '';
  if (intName) intName.textContent = selectedIntColor || '';
}

function makeHeroSwatch(c, type) {
  const hexes = (c.hex || '').split('/');
  const safeName = (c.name || '').replace(/"/g, '&quot;');
  const attrs = `data-color-name="${safeName}" data-color-type="${type}" title="${safeName}"`;
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
    sw.addEventListener('mouseenter', () => { if (targetName) targetName.textContent = name; });
    sw.addEventListener('mouseleave', () => {
      const sel = type === 'ext' ? selectedExtColor : selectedIntColor;
      if (targetName) targetName.textContent = sel || '';
    });
    sw.addEventListener('click', () => {
      // 같은 타입 다른 스워치들 해제
      document.querySelectorAll('.hero-swatch[data-color-type="'+type+'"]').forEach(o => o.classList.remove('selected'));
      sw.classList.add('selected');
      if (type === 'ext') selectedExtColor = name; else selectedIntColor = name;
      if (targetName) targetName.textContent = name;
      updateSelectionSummary();
    });
  });
}

function parseOptionPrice(label){
  const m = (label||'').match(/\(([\d,]+)\s*만원\)/);
  return m ? parseInt(m[1].replace(/,/g,''), 10) || 0 : 0;
}

function updateSelectionSummary(){
  // 월 기본료는 데스크탑/모바일 공통 갱신
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
  rows.push({ label:'외장색상', value: selectedExtColor || null });
  rows.push({ label:'내장색상', value: selectedIntColor || null });
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

  item.innerHTML = `<div class="${swatchClass}" ${swatchStyle}></div><div class="color-name">${c.name}</div>`;
  item.onclick = () => {
    document.querySelectorAll(`.color-item[data-color-type="${type}"]`).forEach(el => el.classList.remove('selected'));
    item.classList.add('selected');
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
  } else {
    selectedOptions.push(optIdx);
    optItem.classList.add('selected');
  }
  updateSelectionSummary();
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
      {label:'월 기본료', value:monthlyTxt, price:true},
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

// 일반 차량 월 기본료 자동 계산
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
  const price0  = Math.round(vehicleWon * 0.0145);
  const price30 = Math.round(vehicleWon * 0.0109);
  let monthly = price0 - (price0 - price30) * (depositPct / 30);
  const PERIOD_MULT  = { '36':1.08, '48':1.00, '60':0.93 };
  const MILEAGE_MULT = { '10000':0.95, '20000':1.00, '30000':1.05, '40000':1.10, 'unlimited':1.18 };
  const PREPAY_MULT  = { '0':1.00, '10':0.95, '20':0.90, '30':0.85 };
  monthly = Math.round(monthly * (PERIOD_MULT[periodVal]||1) * (MILEAGE_MULT[mileageVal]||1) * (PREPAY_MULT[prepayVal]||1));
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
<!-- 견적페이지 아이콘 전용 하단 내비 -->
<nav class="car-icon-nav" aria-label="하단 내비">
  <a href="index.php" aria-label="홈">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
  </a>
  <a href="search.php" aria-label="차량검색">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
  </a>
  <a href="limited.php" class="quick" aria-label="빠른출고"><span style="font-size:1.35rem;line-height:1">⚡</span></a>
  <a href="special.php" aria-label="특가">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
  </a>
  <a href="#" aria-label="마이">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
  </a>
</nav>
</body>
</html>
