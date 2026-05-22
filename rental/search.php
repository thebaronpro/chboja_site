<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>차량검색 — RENT insight</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Pretendard Variable',Pretendard,-apple-system,BlinkMacSystemFont,system-ui,Roboto,sans-serif;background:#fff;color:#0a0a0a}
a{text-decoration:none;color:inherit}
main{max-width:1280px;margin:0 auto;padding:2.5rem 1.5rem 4rem}
.sw{background:#f5f5f5;border-bottom:1px solid #e5e5e5}
.sw-inner{display:flex;align-items:center;gap:.75rem;max-width:1280px;margin:0 auto;padding:.75rem 1.5rem}
.sw input{flex:1;font-size:.875rem;border:none;outline:none;background:transparent;font-family:inherit;color:#0a0a0a}
.sw input::placeholder{color:#a3a3a3}
.sw button{cursor:pointer;color:#a3a3a3;font-size:.9rem;border:none;background:none;display:none}
.tabs{display:flex;gap:.5rem;margin-bottom:1.25rem}
.tab{padding:.5rem 1.25rem;font-size:.875rem;font-weight:700;border-radius:999px;border:1.5px solid #d4d4d4;background:#fff;color:#525252;cursor:pointer;transition:all .15s}
.tab.on{background:#0a0a0a;color:#fff;border-color:#0a0a0a}
.brands{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1rem}
.brand{padding:.45rem 1.1rem;font-size:.875rem;font-weight:700;border-radius:999px;border:1.5px solid #e5e5e5;background:#fff;color:#404040;cursor:pointer;transition:all .15s}
.brand:hover{border-color:#0a0a0a}.brand.on{background:#0a0a0a;color:#fff;border-color:#0a0a0a}
.brand span{opacity:.55;font-size:.8rem}
.types{display:flex;flex-wrap:wrap;gap:.45rem;margin-bottom:2rem;padding-top:1rem;border-top:1px dashed #e5e5e5}
.type-pill{padding:.4rem 1rem;font-size:.82rem;font-weight:700;border-radius:999px;border:1.5px solid #d4d4d4;background:#fff;color:#525252;cursor:pointer;transition:all .15s;display:inline-flex;align-items:center;gap:.3rem}
.type-pill:hover{border-color:#0a0a0a;color:#0a0a0a}
.type-pill.on{background:#2858E0;color:#fff;border-color:#2858E0}
.type-pill span{opacity:.7;font-size:.75rem}
.type-pill.on span{opacity:.85}
.grid{display:grid;grid-template-columns:repeat(7,1fr);gap:1rem}
@media(max-width:900px){.grid{grid-template-columns:repeat(4,1fr)}}
.card{border:1.5px solid #e5e5e5;border-radius:.75rem;background:#fff;padding:.75rem;text-align:center;cursor:pointer;transition:border-color .15s,box-shadow .15s}
.card:hover{border-color:#0a0a0a;box-shadow:0 2px 8px rgba(0,0,0,.08)}
.card img{width:100%;height:5rem;object-fit:contain}
.card p{margin-top:.5rem;font-size:.75rem;font-weight:600;color:#404040;line-height:1.3}
.empty{padding:4rem 0;text-align:center;color:#a3a3a3;font-size:.9rem;display:none}
.cnt{margin-bottom:1rem;font-size:.875rem;color:#737373}
.q-header{display:flex;align-items:center;gap:.6rem;margin-bottom:1rem}
.q-title{font-size:1.1rem;font-weight:900}
.q-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:1rem;margin-bottom:2.5rem}
.q-card{border:1.5px solid #e5e5e5;border-radius:.75rem;background:#fff;padding:.75rem;text-align:center;cursor:pointer;transition:border-color .15s,box-shadow .15s}
.q-card:hover{border-color:#0a0a0a;box-shadow:0 2px 8px rgba(0,0,0,.08)}
.q-card img{width:100%;height:5rem;object-fit:contain;background:#fff}
.q-info{margin-top:.5rem;display:flex;justify-content:space-between;align-items:center}
.q-name{font-weight:600;font-size:.75rem;color:#404040;text-align:left}
.q-stock{font-size:.75rem;font-weight:700;color:#dc2626;white-space:nowrap}
.q-dot{display:none}
.q-divider{border:none;border-top:1.5px solid #e5e5e5;margin:1.5rem 0}
@media(max-width:900px){.q-grid{grid-template-columns:repeat(4,1fr)}}
@media(max-width:768px){
  .q-grid{display:flex;flex-direction:column;gap:0;border-top:1px solid #e5e5e5;margin-bottom:1.5rem}
  .q-card{display:flex;flex-direction:row;align-items:center;border:none;border-bottom:1px solid #f0f0f0;border-radius:0;transform:none!important;box-shadow:none!important;padding:.85rem 1rem;gap:.875rem}
  .q-card img{width:90px;height:60px;flex-shrink:0}
  .q-info{margin:0;padding:0;flex:1;min-width:0;display:flex;flex-direction:row;align-items:center;justify-content:space-between;gap:.5rem}
  .q-name{font-size:.95rem;font-weight:700;color:#0a0a0a;letter-spacing:-.01em;flex:1;min-width:0;text-align:left;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
  .q-stock{flex-shrink:0;display:inline-flex;align-items:center;gap:.3rem;background:#18181b;color:#fafafa;font-size:.7rem;font-weight:800;padding:.3rem .6rem;border-radius:999px;letter-spacing:-.01em;line-height:1;border:none;box-shadow:0 1px 3px rgba(0,0,0,.12)}
  .q-dot{display:inline-block;width:.35rem;height:.35rem;border-radius:50%;background:#fb7185;flex-shrink:0;margin:0}
}


@media(max-width:768px){
  .car-grid{grid-template-columns:repeat(2,1fr);gap:1rem}
  #unit-list{grid-template-columns:repeat(2,1fr);gap:1rem}
  .filter-tab{padding:.6rem .9rem;font-size:.8rem}
  main{padding:1rem 1rem 3rem}
  .unit-img{height:9rem}
  .sw-inner,.sb-inner{padding:.65rem 1rem}

  /* 검색 브라우즈 모드 모바일 */
  .tabs{gap:.4rem;margin-bottom:1rem;padding:.3rem;background:#f3f4f6;border-radius:.7rem}
  .tab{flex:1;padding:.6rem .5rem;font-size:.88rem;border:none;background:transparent;border-radius:.5rem;color:#737373}
  .tab.on{background:#fff;color:#0a0a0a;box-shadow:0 1px 3px rgba(0,0,0,.08)}
  .brands{flex-wrap:wrap;gap:.4rem;margin-bottom:1.25rem}
  .brand{padding:.4rem .85rem;font-size:.8rem;border-width:1px}
  .brand span{font-size:.72rem}
  .grid{grid-template-columns:repeat(3,1fr);gap:.5rem}
  .card{padding:.6rem .5rem;border-radius:.65rem;border-width:1px}
  .card img{height:3.6rem}
  .card p{margin-top:.4rem;font-size:.72rem;font-weight:700;color:#0a0a0a;line-height:1.25;min-height:1.85rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
}
@media(max-width:480px){
  .car-grid{grid-template-columns:1fr}
  #unit-list{grid-template-columns:1fr}
}




.bnav-item{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:.6rem .25rem .5rem;gap:.2rem;text-decoration:none;color:#a3a3a3;font-size:.65rem;font-weight:600}
.bnav-item.active{color:#dc2626}
.bnav-quick{color:#0a0a0a!important}
.bnav-quick-bar{position:absolute;top:0;left:50%;transform:translateX(-50%);width:2rem;height:3px;background:#0a0a0a;border-radius:0 0 3px 3px}
body{padding-bottom:4rem}
.mob-bottom-nav{position:fixed;bottom:0;left:0;right:0;z-index:9999;background:#fff;border-top:1px solid #e5e5e5;padding-bottom:env(safe-area-inset-bottom);display:none}
@media(max-width:768px){.mob-bottom-nav{display:block}}
</style>
</head>
<body>
<?php
$top_active    = '장기렌트';
$subnav_active = 'search';
require __DIR__ . '/../includes/rental_header.php';
?>
<main>
  <div id="browse">
    <div class="tabs">
      <button class="tab on" data-t="국산차">국산차</button>
      <button class="tab" data-t="수입차">수입차</button>
    </div>
    <div class="brands" id="brands"></div>
    <div class="types" id="types"></div>
    <div class="grid" id="grid"></div>
  </div>
  <div id="results" style="display:none">
    <div id="quick-section" style="display:none;margin-bottom:1.5rem">
      <div class="q-header">
        <span style="color:#dc2626;font-size:1.1rem">⚡</span>
        <span class="q-title">빠른출고 차량</span>
        <span id="q-cnt" style="font-size:.8rem;color:#737373"></span>
      </div>
      <div class="q-grid" id="qgrid"></div>
      <hr class="q-divider">
    </div>
    <div id="special-section" style="display:none;margin-bottom:1.5rem">
      <div class="q-header">
        <span style="color:#dc2626;font-size:1.1rem">★</span>
        <span class="q-title">특가차량</span>
        <span id="sp-cnt" style="font-size:.8rem;color:#737373"></span>
      </div>
      <div class="q-grid" id="spgrid"></div>
      <hr class="q-divider">
    </div>
    <p class="cnt" id="cnt"></p>
    <div class="grid" id="rgrid"></div>
    <p class="empty" id="empty">검색 결과가 없습니다.</p>
  </div>
</main>

<script>
const DOMESTIC_BRANDS=["현대", "기아", "제네시스", "KG모빌리티", "르노코리아", "쉐보레"];
const IMPORT_BRANDS=["BMW", "BYD", "GMC", "동풍", "람보르기니", "랜드로버", "렉서스", "로터스", "롤스로이스", "링컨", "마세라티", "맥라렌", "메르세데스-벤츠", "미니", "벤틀리", "볼보", "아우디", "애스턴마틴", "이네오스", "이스즈", "지프", "캐딜락", "테슬라", "토요타", "페라리", "포드", "포르쉐", "폭스바겐", "폴스타", "푸조", "혼다"];
const ALL_BRAND_CARS={"현대": [{"n": "포터2", "i": "../cars/303_1901.png"}, {"n": "쏠라티", "i": "../cars/303_3297.png"}, {"n": "마이티", "i": "../cars/303_3500.png"}, {"n": "카운티", "i": "../cars/303_3502.png"}, {"n": "베뉴", "i": "../cars/303_3654.png"}, {"n": "파비스", "i": "../cars/303_4003.png"}, {"n": "스타리아", "i": "../cars/303_4014.png"}, {"n": "아이오닉 9", "i": "../cars/303_4088.png"}, {"n": "그랜저", "i": "../cars/cdn_4188.png"}, {"n": "코나", "i": "../cars/303_4361.png"}, {"n": "포터2 일렉트릭", "i": "../cars/303_4399.png"}, {"n": "카운티 일렉트릭", "i": "../cars/303_4400.png"}, {"n": "싼타페", "i": "../cars/cdn_4435.png"}, {"n": "아반떼", "i": "../cars/cdn_4455.png"}, {"n": "쏘나타 디 엣지", "i": "../cars/cdn_4466.png"}, {"n": "코나 일렉트릭", "i": "../cars/303_4510.png"}, {"n": "아이오닉 5 N", "i": "../cars/cdn_4558.png"}, {"n": "아반떼 N", "i": "../cars/cdn_4564.png"}, {"n": "투싼", "i": "../cars/cdn_4592.png"}, {"n": "아이오닉 5", "i": "../cars/cdn_4624.png"}, {"n": "ST1", "i": "../cars/303_4626.png"}, {"n": "캐스퍼 일렉트릭", "i": "../cars/cdn_4653.png"}, {"n": "캐스퍼", "i": "../cars/cdn_4671.png"}, {"n": "디 올 뉴 넥쏘", "i": "../cars/cdn_4677.png"}, {"n": "디 올 뉴 팰리세이드", "i": "../cars/cdn_4699.png"}, {"n": "아이오닉 6 N", "i": "../cars/303_4742.png"}, {"n": "더 뉴 아이오닉 6", "i": "../cars/303_4746.png"}, {"n": "더 뉴 스타리아", "i": "../cars/cdn_4765.png"}], "포르쉐": [{"n": "718 Boxster", "i": "../cars/381_3336.png"}, {"n": "718 Cayman", "i": "../cars/381_3361.png"}, {"n": "911", "i": "../cars/381_3666.png"}, {"n": "Cayenne", "i": "../cars/381_4506.png"}, {"n": "Panamera", "i": "../cars/381_4593.png"}, {"n": "Macan Electric", "i": "../cars/381_4613.png"}, {"n": "Taycan", "i": "../cars/381_4619.png"}, {"n": "The New 911", "i": "../cars/381_4651.png"}, {"n": "Cayenne Electric", "i": "../cars/381_4762.png"}], "동풍": [{"n": "C31", "i": "../cars/617_3487.png"}, {"n": "C32", "i": "../cars/617_3488.png"}, {"n": "C35", "i": "../cars/617_3489.png"}, {"n": "Fengon ix5", "i": "../cars/617_3802.png"}, {"n": "Rich6 EV", "i": "../cars/617_4583.png"}], "람보르기니": [{"n": "Urus", "i": "../cars/440_3526.png"}, {"n": "Huracan EVO", "i": "../cars/440_3746.png"}, {"n": "Urus S", "i": "../cars/440_4425.png"}, {"n": "Revuelto", "i": "../cars/440_4505.png"}], "아우디": [{"n": "A7", "i": "../cars/371_3537.png"}, {"n": "Q3", "i": "../cars/371_3668.png"}, {"n": "A6", "i": "../cars/371_3713.png"}, {"n": "Q4 e-tron", "i": "../cars/371_4062.png"}, {"n": "A6 e-tron", "i": "../cars/371_4142.png"}, {"n": "A8", "i": "../cars/371_4431.png"}, {"n": "Q8 e-tron", "i": "../cars/371_4436.png"}, {"n": "Q6 e-tron", "i": "../cars/371_4690.png"}, {"n": "Q8", "i": "../cars/371_4697.png"}, {"n": "Q7", "i": "../cars/371_4698.png"}, {"n": "A3", "i": "../cars/371_4707.png"}, {"n": "The new A5", "i": "../cars/371_4735.png"}, {"n": "The new Q5", "i": "../cars/371_4736.png"}, {"n": "The new e-tron GT", "i": "../cars/371_4759.png"}], "애스턴마틴": [{"n": "Vantage", "i": "../cars/404_3580.png"}, {"n": "DBX", "i": "../cars/404_3816.png"}, {"n": "DB12", "i": "../cars/404_4530.png"}], "이스즈": [{"n": "ELF", "i": "../cars/537_3664.png"}, {"n": "Forward", "i": "../cars/537_4623.png"}], "렉서스": [{"n": "UX", "i": "../cars/486_3688.png"}, {"n": "LS", "i": "../cars/486_4031.png"}, {"n": "ES", "i": "../cars/486_4093.png"}, {"n": "NX", "i": "../cars/486_4164.png"}, {"n": "RX", "i": "../cars/486_4390.png"}, {"n": "LM", "i": "../cars/486_4635.png"}, {"n": "LX", "i": "../cars/486_4700.png"}], "페라리": [{"n": "SF90 Stradale", "i": "../cars/436_3751.png"}, {"n": "812 GTS", "i": "../cars/436_3818.png"}, {"n": "SF90 Spider", "i": "../cars/436_4010.png"}, {"n": "296 GTB", "i": "../cars/436_4079.png"}, {"n": "Purosangue", "i": "../cars/436_4184.png"}, {"n": "Roma Spider", "i": "../cars/436_4497.png"}, {"n": "12Cilindri", "i": "../cars/436_4643.png"}, {"n": "296 GTS", "i": "../cars/436_4694.png"}, {"n": "Amalfi", "i": "../cars/436_4739.png"}], "기아": [{"n": "봉고 3", "i": "../cars/307_3772.png"}, {"n": "K9", "i": "../cars/307_4066.png"}, {"n": "EV9", "i": "../cars/307_4128.png"}, {"n": "니로", "i": "../cars/307_4130.png"}, {"n": "셀토스", "i": "../cars/cdn_4391.png"}, {"n": "니로 EV", "i": "../cars/307_4396.png"}, {"n": "봉고 3 EV", "i": "../cars/307_4404.png"}, {"n": "EV5", "i": "../cars/cdn_4499.png"}, {"n": "모닝", "i": "../cars/cdn_4554.png"}, {"n": "쏘렌토", "i": "../cars/cdn_4563.png"}, {"n": "K5", "i": "../cars/cdn_4585.png"}, {"n": "카니발", "i": "../cars/cdn_4586.png"}, {"n": "EV6", "i": "../cars/307_4641.png"}, {"n": "EV3", "i": "../cars/307_4647.png"}, {"n": "K8", "i": "../cars/cdn_4665.png"}, {"n": "스포티지", "i": "../cars/cdn_4684.png"}, {"n": "타스만", "i": "../cars/307_4686.png"}, {"n": "레이", "i": "../cars/307_4689.png"}, {"n": "레이 EV", "i": "../cars/307_4691.png"}, {"n": "EV4", "i": "../cars/307_4712.png"}, {"n": "PV5", "i": "../cars/307_4714.png"}, {"n": "디 올 뉴 셀토스", "i": "../cars/cdn_4763.png"}, {"n": "더 뉴 니로", "i": "../cars/cdn_4775.png"}], "폭스바겐": [{"n": "Atlas", "i": "../cars/376_3773.png"}, {"n": "ID.4", "i": "../cars/376_4005.png"}, {"n": "ID.5", "i": "../cars/376_4121.png"}, {"n": "Touareg", "i": "../cars/376_4531.png"}, {"n": "Golf", "i": "../cars/376_4720.png"}], "BMW": [{"n": "2 Series", "i": "../cars/362_3803.png"}, {"n": "X4", "i": "../cars/362_4072.png"}, {"n": "X4 M", "i": "../cars/362_4073.png"}, {"n": "2 Series Active Tourer", "i": "../cars/362_4114.png"}, {"n": "8 Series", "i": "../cars/362_4171.png"}, {"n": "M8", "i": "../cars/362_4172.png"}, {"n": "i7", "i": "../cars/362_4181.png"}, {"n": "X7", "i": "../cars/362_4192.png"}, {"n": "7 Series", "i": "../cars/362_4196.png"}, {"n": "X1", "i": "../cars/362_4371.png"}, {"n": "iX1", "i": "../cars/362_4372.png"}, {"n": "XM", "i": "../cars/362_4422.png"}, {"n": "Z4", "i": "../cars/362_4424.png"}, {"n": "X5", "i": "../cars/362_4475.png"}, {"n": "X6", "i": "../cars/362_4476.png"}, {"n": "X5 M", "i": "../cars/362_4479.png"}, {"n": "X6 M", "i": "../cars/362_4480.png"}, {"n": "5 Series", "i": "../cars/362_4517.png"}, {"n": "i5", "i": "../cars/362_4528.png"}, {"n": "X2", "i": "../cars/362_4580.png"}, {"n": "iX2", "i": "../cars/362_4582.png"}, {"n": "4 Series", "i": "../cars/362_4614.png"}, {"n": "M4", "i": "../cars/362_4615.png"}, {"n": "i4", "i": "../cars/362_4639.png"}, {"n": "M3", "i": "../cars/362_4649.png"}, {"n": "3 Series", "i": "../cars/362_4650.png"}, {"n": "1 Series", "i": "../cars/362_4652.png"}, {"n": "M2", "i": "../cars/362_4655.png"}, {"n": "X3", "i": "../cars/362_4656.png"}, {"n": "M5", "i": "../cars/362_4657.png"}, {"n": "2 Series Gran Coupe", "i": "../cars/362_4683.png"}, {"n": "iX", "i": "../cars/362_4708.png"}, {"n": "The New iX3", "i": "../cars/cdn_4751.png"}], "테슬라": [{"n": "Cybertruck", "i": "../cars/611_3825.png"}, {"n": "Model X", "i": "../cars/611_4027.png"}, {"n": "Model S", "i": "../cars/611_4043.png"}, {"n": "Roadster", "i": "../cars/611_4193.png"}, {"n": "Model 3", "i": "../cars/611_4610.png"}, {"n": "Model Y", "i": "../cars/cdn_4667.png"}], "메르세데스-벤츠": [{"n": "AMG GT", "i": "../cars/349_3982.png"}, {"n": "S-Class", "i": "../cars/349_3992.png"}, {"n": "Maybach S-Class", "i": "../cars/349_4011.png"}, {"n": "C-Class", "i": "../cars/349_4037.png"}, {"n": "EQE", "i": "../cars/349_4111.png"}, {"n": "GLC-Class", "i": "../cars/349_4373.png"}, {"n": "SL-Class", "i": "../cars/349_4380.png"}, {"n": "EQS SUV", "i": "../cars/349_4381.png"}, {"n": "A-Class", "i": "../cars/349_4427.png"}, {"n": "EQE SUV", "i": "../cars/349_4430.png"}, {"n": "CLA-Class", "i": "../cars/349_4461.png"}, {"n": "GLE-Class", "i": "../cars/349_4471.png"}, {"n": "GLA-Class", "i": "../cars/349_4495.png"}, {"n": "GLB-Class", "i": "../cars/349_4496.png"}, {"n": "GLS-Class", "i": "../cars/349_4507.png"}, {"n": "Maybach GLS", "i": "../cars/349_4508.png"}, {"n": "Maybach EQS SUV", "i": "../cars/349_4511.png"}, {"n": "E-Class", "i": "../cars/349_4516.png"}, {"n": "CLE", "i": "../cars/349_4555.png"}, {"n": "The New AMG GT", "i": "../cars/349_4566.png"}, {"n": "EQA", "i": "../cars/349_4568.png"}, {"n": "EQB", "i": "../cars/349_4569.png"}, {"n": "G-Class", "i": "../cars/349_4629.png"}, {"n": "EQS", "i": "../cars/349_4634.png"}, {"n": "Electric G-Class", "i": "../cars/349_4638.png"}, {"n": "Maybach SL", "i": "../cars/349_4670.png"}], "제네시스": [{"n": "G70", "i": "../cars/304_3995.png"}, {"n": "G90", "i": "../cars/cdn_4016.png"}, {"n": "GV80", "i": "../cars/cdn_4465.png"}, {"n": "G80", "i": "../cars/cdn_4603.png"}, {"n": "GV70", "i": "../cars/cdn_4609.png"}, {"n": "Electrified G80", "i": "../cars/cdn_4660.png"}, {"n": "GV60", "i": "../cars/304_4701.png"}, {"n": "Electrified GV70", "i": "../cars/cdn_4705.png"}, {"n": "GV60 MAGMA", "i": "../cars/cdn_4761.png"}], "마세라티": [{"n": "MC20", "i": "../cars/445_3996.png"}, {"n": "Grecale", "i": "../cars/445_4176.png"}, {"n": "MC20 Cielo", "i": "../cars/445_4366.png"}, {"n": "GranTurismo", "i": "../cars/445_4426.png"}, {"n": "GranCabrio", "i": "../cars/445_4625.png"}, {"n": "Grecale Folgore", "i": "../cars/445_4685.png"}, {"n": "GT2 Stradale", "i": "../cars/cdn_4696.png"}, {"n": "GranTurismo Folgore", "i": "../cars/445_4733.png"}, {"n": "GranCabrio Folgore", "i": "../cars/445_4734.png"}], "볼보": [{"n": "V90 Cross Country", "i": "../cars/459_4007.png"}, {"n": "XC40", "i": "../cars/459_4405.png"}, {"n": "EX90", "i": "../cars/cdn_4418.png"}, {"n": "V60 Cross Country", "i": "../cars/459_4421.png"}, {"n": "EX30", "i": "../cars/459_4446.png"}, {"n": "XC90", "i": "../cars/459_4737.png"}, {"n": "S90", "i": "../cars/459_4740.png"}, {"n": "XC60", "i": "../cars/459_4747.png"}, {"n": "EX30 CC", "i": "../cars/459_4750.png"}], "벤틀리": [{"n": "Bentayga", "i": "../cars/390_4024.png"}, {"n": "The New Flying Spur", "i": "../cars/390_4676.png"}, {"n": "The new Continental", "i": "../cars/390_4688.png"}], "맥라렌": [{"n": "Artura", "i": "../cars/409_4035.png"}], "포드": [{"n": "Bronco", "i": "../cars/569_4059.png"}, {"n": "Ranger", "i": "../cars/569_4138.png"}, {"n": "Expedition", "i": "../cars/569_4360.png"}, {"n": "Mustang", "i": "../cars/569_4415.png"}, {"n": "Explorer", "i": "../cars/569_4616.png"}], "토요타": [{"n": "Sienna", "i": "../cars/491_4063.png"}, {"n": "RAV4", "i": "../cars/491_4173.png"}, {"n": "GR 86", "i": "../cars/491_4177.png"}, {"n": "Prius", "i": "../cars/491_4439.png"}, {"n": "Crown", "i": "../cars/491_4447.png"}, {"n": "Highlander", "i": "../cars/491_4460.png"}, {"n": "Alphard", "i": "../cars/491_4473.png"}, {"n": "Camry", "i": "../cars/491_4674.png"}], "랜드로버": [{"n": "Discovery", "i": "../cars/399_4064.png"}, {"n": "Range Rover", "i": "../cars/399_4119.png"}, {"n": "Range Rover Sport", "i": "../cars/399_4363.png"}, {"n": "Range Rover Velar", "i": "../cars/399_4472.png"}, {"n": "Discovery Sport", "i": "../cars/399_4548.png"}, {"n": "Range Rover Evoque", "i": "../cars/399_4551.png"}, {"n": "New Defender", "i": "../cars/cdn_4776.png"}], "지프": [{"n": "Grand Cherokee", "i": "../cars/587_4065.png"}, {"n": "Wrangler", "i": "../cars/587_4509.png"}, {"n": "Gladiator", "i": "../cars/587_4732.png"}], "로터스": [{"n": "Emira", "i": "../cars/408_4081.png"}, {"n": "Eletre", "i": "../cars/408_4183.png"}, {"n": "Emeya", "i": "../cars/408_4574.png"}], "GMC": [{"n": "Sierra", "i": "../cars/602_4127.png"}, {"n": "Acadia", "i": "../cars/cdn_4136.png"}, {"n": "Canyon", "i": "../cars/cdn_4779.png"}], "혼다": [{"n": "Pilot", "i": "../cars/500_4189.png"}, {"n": "CR-V", "i": "../cars/500_4469.png"}, {"n": "Accord", "i": "../cars/500_4547.png"}, {"n": "Odyssey", "i": "../cars/500_4715.png"}], "푸조": [{"n": "408", "i": "../cars/413_4377.png"}, {"n": "308", "i": "../cars/413_4379.png"}, {"n": "All New 5008", "i": "../cars/cdn_4628.png"}, {"n": "3008", "i": "../cars/413_4741.png"}], "쉐보레": [{"n": "콜로라도", "i": "../cars/312_4395.png"}, {"n": "트랙스 크로스오버", "i": "../cars/312_4429.png"}, {"n": "트레일블레이저", "i": "../cars/312_4474.png"}], "링컨": [{"n": "Navigator", "i": "../cars/573_4417.png"}, {"n": "Nautilus", "i": "../cars/573_4512.png"}, {"n": "Aviator", "i": "../cars/573_4617.png"}], "롤스로이스": [{"n": "Spectre", "i": "../cars/385_4433.png"}, {"n": "Phantom Series II", "i": "../cars/385_4443.png"}, {"n": "Cullinan Series2", "i": "../cars/385_4682.png"}, {"n": "Ghost Series II", "i": "../cars/385_4721.png"}], "폴스타": [{"n": "Polestar 2", "i": "../cars/458_4468.png"}, {"n": "Polestar 4", "i": "../cars/458_4513.png"}], "이네오스": [{"n": "Grenadier", "i": "../cars/556_4482.png"}], "KG모빌리티": [{"n": "토레스 EVX", "i": "../cars/326_4492.png"}, {"n": "렉스턴 뉴 아레나", "i": "../cars/326_4518.png"}, {"n": "티볼리", "i": "../cars/326_4545.png"}, {"n": "액티언", "i": "../cars/326_4622.png"}, {"n": "토레스", "i": "../cars/326_4646.png"}, {"n": "무쏘 EV", "i": "../cars/326_4666.png"}, {"n": "무쏘 스포츠", "i": "../cars/326_4716.png"}, {"n": "무쏘 칸", "i": "../cars/326_4717.png"}, {"n": "무쏘", "i": "../cars/cdn_4766.png"}], "BYD": [{"n": "T4K", "i": "../cars/380_4498.png"}, {"n": "ATTO 3", "i": "../cars/380_4702.png"}, {"n": "SEAL", "i": "../cars/380_4703.png"}, {"n": "Dolphin", "i": "../cars/cdn_4704.png"}, {"n": "SEALION 7", "i": "../cars/380_4706.png"}], "르노코리아": [{"n": "아르카나", "i": "../cars/321_4560.png"}, {"n": "세닉 E-테크 일렉트릭", "i": "../cars/321_4632.png"}, {"n": "그랑 콜레오스", "i": "../cars/cdn_4659.png"}, {"n": "필랑트", "i": "../cars/cdn_4772.png"}], "캐딜락": [{"n": "Escalade IQ", "i": "../cars/546_4565.png"}, {"n": "Escalade", "i": "../cars/546_4663.png"}], "미니": [{"n": "Mini Electric", "i": "../cars/367_4571.png"}, {"n": "Countryman Electric", "i": "../cars/367_4572.png"}, {"n": "Countryman", "i": "../cars/367_4587.png"}, {"n": "Cooper", "i": "../cars/367_4618.png"}, {"n": "Aceman", "i": "../cars/367_4640.png"}, {"n": "Convertible", "i": "../cars/367_4681.png"}]};

const QUICK_CARS=[
  {name:"현대 아반떼",img:"../cars/cdn_4455.png",stock:98},{name:"현대 그랜저",img:"../cars/cdn_4188.png",stock:43},
  {name:"현대 쏘나타",img:"../cars/cdn_4466.png",stock:56},{name:"현대 싼타페",img:"../cars/cdn_4435.png",stock:62},
  {name:"현대 투싼",img:"../cars/cdn_4592.png",stock:51},{name:"현대 팰리세이드",img:"../cars/cdn_4699.png",stock:8},
  {name:"기아 K5",img:"../cars/cdn_4585.png",stock:74},{name:"기아 K8",img:"../cars/cdn_4665.png",stock:27},
  {name:"기아 카니발",img:"../cars/cdn_4586.png",stock:15},{name:"기아 스포티지",img:"../cars/cdn_4684.png",stock:34},
  {name:"기아 쏘렌토",img:"../cars/cdn_4563.png",stock:29},{name:"BMW 5 Series",img:"../cars/362_4517.png",stock:12},
  {name:"BMW X5",img:"../cars/362_4475.png",stock:9},{name:"벤츠 E클래스",img:"../cars/349_4516.png",stock:7},
  {name:"벤츠 GLC",img:"../cars/349_4373.png",stock:11},{name:"아우디 A6",img:"../cars/371_3713.png",stock:6},
  {name:"볼보 XC60",img:"../cars/459_4747.png",stock:14},{name:"포르쉐 Cayenne",img:"../cars/381_4506.png",stock:3},
  {name:"현대 아이오닉 5",img:"../cars/cdn_4624.png",stock:23},{name:"현대 아이오닉 9",img:"../cars/303_4088.png",stock:17},
  {name:"캐스퍼 일렉트릭",img:"../cars/cdn_4653.png",stock:45},{name:"기아 EV3",img:"../cars/307_4647.png",stock:38},
  {name:"기아 EV6",img:"../cars/307_4641.png",stock:19},{name:"기아 EV9",img:"../cars/307_4128.png",stock:11},
  {name:"테슬라 모델Y",img:"../cars/cdn_4667.png",stock:8},{name:"현대 그랜저 HEV",img:"../cars/cdn_4188.png",stock:31},
  {name:"현대 싼타페 HEV",img:"../cars/cdn_4435.png",stock:25},{name:"현대 투싼 HEV",img:"../cars/cdn_4592.png",stock:43},
  {name:"기아 K8 HEV",img:"../cars/cdn_4665.png",stock:22},{name:"기아 쏘렌토 HEV",img:"../cars/cdn_4563.png",stock:28},
  {name:"기아 스포티지 HEV",img:"../cars/cdn_4684.png",stock:37},
];
const SPECIAL_CARS=[
  {name:"현대 아반떼",img:"../cars/cdn_4455.png",price:"월 299,000원~",tag:"특가",type:"general"},
  {name:"현대 그랜저",img:"../cars/cdn_4188.png",price:"월 599,000원~",tag:"특가",type:"general"},
  {name:"기아 K8",img:"../cars/cdn_4665.png",price:"월 549,000원~",tag:"특가",type:"general"},
  {name:"기아 카니발",img:"../cars/cdn_4586.png",price:"월 680,000원~",tag:"특가",type:"general"},
  {name:"현대 싼타페",img:"../cars/cdn_4435.png",price:"월 520,000원~",tag:"특가",type:"general"},
  {name:"기아 스포티지",img:"../cars/cdn_4684.png",price:"월 449,000원~",tag:"특가",type:"general"},
  {name:"현대 투싼",img:"../cars/cdn_4592.png",price:"월 399,000원~",tag:"특가",type:"general"},
  {name:"현대 팰리세이드",img:"../cars/cdn_4699.png",price:"월 730,000원~",tag:"특가",type:"general"},
  {name:"현대 아이오닉 5",img:"../cars/cdn_4624.png",price:"월 480,000원~",tag:"EV",type:"ev"},
  {name:"현대 아이오닉 6 N",img:"../cars/303_4742.png",price:"월 560,000원~",tag:"EV",type:"ev"},
  {name:"현대 아이오닉 9",img:"../cars/303_4088.png",price:"월 720,000원~",tag:"EV",type:"ev"},
  {name:"기아 EV6",img:"../cars/307_4641.png",price:"월 510,000원~",tag:"EV",type:"ev"},
  {name:"기아 EV9",img:"../cars/307_4128.png",price:"월 680,000원~",tag:"EV",type:"ev"},
  {name:"기아 EV3",img:"../cars/307_4647.png",price:"월 380,000원~",tag:"EV",type:"ev"},
  {name:"캐스퍼 일렉트릭",img:"../cars/cdn_4653.png",price:"월 320,000원~",tag:"EV",type:"ev"},
  {name:"테슬라 모델Y",img:"../cars/cdn_4667.png",price:"월 650,000원~",tag:"EV",type:"ev"},
];
let tab='국산차', brand=DOMESTIC_BRANDS.find(b=>ALL_BRAND_CARS[b])||'', typeFilter=null;

/* 2026년 5월 기준 인기 순위 (한국 시장 등록/판매) */
const BRAND_POPULARITY={
  '현대':1,'기아':2,'제네시스':3,'KG모빌리티':4,'쉐보레':5,'르노코리아':6,
  'BMW':1,'메르세데스-벤츠':2,'테슬라':3,'아우디':4,'볼보':5,
  '렉서스':6,'미니':7,'포르쉐':8,'토요타':9,'폭스바겐':10,
  '랜드로버':11,'포드':12,'폴스타':13,'지프':14,'BYD':15,
  '캐딜락':16,'혼다':17,'푸조':18,'마세라티':19,'페라리':20,
  '람보르기니':21,'벤틀리':22,'롤스로이스':23,'애스턴마틴':24,'맥라렌':25,
  '로터스':26,'링컨':27,'GMC':28,'이스즈':29,'동풍':30,'이네오스':31
};
const MODEL_POPULARITY={
  '현대':['그랜저','싼타페','디 올 뉴 팰리세이드','투싼','쏘나타 디 엣지','아반떼','아이오닉 5','캐스퍼','코나','캐스퍼 일렉트릭','아이오닉 9','베뉴','더 뉴 아이오닉 6','코나 일렉트릭','디 올 뉴 넥쏘','아이오닉 5 N','아이오닉 6 N','아반떼 N','스타리아','더 뉴 스타리아','포터2','포터2 일렉트릭','ST1','쏠라티','마이티','카운티','카운티 일렉트릭','파비스'],
  '기아':['카니발','쏘렌토','스포티지','K8','K5','셀토스','디 올 뉴 셀토스','모닝','EV6','EV9','레이','EV3','EV4','K9','니로','더 뉴 니로','EV5','니로 EV','레이 EV','타스만','PV5','봉고 3','봉고 3 EV'],
  '제네시스':['G80','GV80','GV70','GV60','G90','G70','Electrified GV70','Electrified G80','GV60 MAGMA'],
  'KG모빌리티':['토레스','토레스 EVX','액티언','무쏘','무쏘 EV','티볼리','렉스턴 뉴 아레나','무쏘 스포츠','무쏘 칸'],
  '쉐보레':['트랙스 크로스오버','트레일블레이저','콜로라도'],
  '르노코리아':['그랑 콜레오스','아르카나','필랑트','세닉 E-테크 일렉트릭'],
  'BMW':['5 Series','3 Series','X3','X5','i5','i4','X1','4 Series','1 Series','X4','iX1','i7','7 Series','iX','X6','X7','M3','M4','2 Series','iX2','X2','2 Series Gran Coupe','2 Series Active Tourer','M5','M2','8 Series','M8','XM','X5 M','X6 M','X4 M','Z4','The New iX3'],
  '메르세데스-벤츠':['E-Class','S-Class','GLC-Class','GLE-Class','C-Class','EQE','EQS','EQS SUV','EQE SUV','A-Class','CLA-Class','GLA-Class','GLB-Class','GLS-Class','EQA','EQB','CLE','AMG GT','The New AMG GT','SL-Class','G-Class','Electric G-Class','Maybach S-Class','Maybach GLS','Maybach EQS SUV','Maybach SL'],
  '테슬라':['Model Y','Model 3','Model S','Model X','Cybertruck','Roadster'],
  '아우디':['A6','Q5','The new Q5','A4','Q7','Q8','A8','Q4 e-tron','A3','Q3','Q8 e-tron','Q6 e-tron','A6 e-tron','A7','The new A5','The new e-tron GT'],
  '볼보':['XC60','XC90','S90','XC40','EX30','EX90','V90 Cross Country','V60 Cross Country','EX30 CC'],
  '렉서스':['ES','RX','NX','UX','LS','LM','LX'],
  '미니':['Cooper','Countryman','Countryman Electric','Aceman','Mini Electric','Convertible'],
  '포르쉐':['Cayenne','Macan Electric','Taycan','Panamera','911','The New 911','718 Boxster','718 Cayman','Cayenne Electric'],
  '토요타':['Camry','RAV4','Sienna','Alphard','Highlander','Crown','Prius','GR 86'],
  '폭스바겐':['Touareg','ID.4','ID.5','Atlas','Golf'],
  '랜드로버':['Range Rover Sport','Range Rover','Range Rover Velar','Discovery','Range Rover Evoque','Discovery Sport','New Defender'],
  '포드':['Explorer','Bronco','Mustang','Expedition','Ranger'],
  '폴스타':['Polestar 4','Polestar 2'],
  '지프':['Wrangler','Grand Cherokee','Gladiator'],
  'BYD':['ATTO 3','SEAL','SEALION 7','Dolphin','T4K'],
  '캐딜락':['Escalade','Escalade IQ'],
  '혼다':['Accord','CR-V','Pilot','Odyssey'],
  '푸조':['3008','All New 5008','408','308'],
  '마세라티':['Grecale','GranTurismo','GranCabrio','MC20','Grecale Folgore','GranTurismo Folgore','GranCabrio Folgore','MC20 Cielo','GT2 Stradale'],
  '페라리':['Purosangue','296 GTB','296 GTS','Roma Spider','SF90 Stradale','SF90 Spider','12Cilindri','Amalfi','812 GTS'],
  '람보르기니':['Urus','Urus S','Revuelto','Huracan EVO'],
  '벤틀리':['Bentayga','The new Continental','The New Flying Spur'],
  '롤스로이스':['Cullinan Series2','Spectre','Ghost Series II','Phantom Series II'],
  '애스턴마틴':['DBX','DB12','Vantage'],
  '맥라렌':['Artura'],
  '로터스':['Eletre','Emeya','Emira'],
  '링컨':['Aviator','Navigator','Nautilus'],
  'GMC':['Sierra','Acadia','Canyon'],
  '이스즈':['ELF','Forward'],
  '동풍':['Fengon ix5','Rich6 EV','C35','C31','C32'],
  '이네오스':['Grenadier']
};
function brandRank(b){return BRAND_POPULARITY[b]||999;}
function modelRank(brand,name){
  const list=MODEL_POPULARITY[brand];
  if(!list) return 999;
  const i=list.indexOf(name);
  return i===-1?998:i;
}
function popularitySort(brand, cars){
  return cars.slice().sort((a,b)=>{
    const ra=modelRank(brand,a.n), rb=modelRank(brand,b.n);
    if(ra!==rb) return ra-rb;
    return a.n.localeCompare(b.n,'ko');
  });
}

/* 차종 명시적 분류 (트럭은 어느 카테고리에도 포함 안 함) */
const TYPE_MEMBERSHIP={
  '국산세단':{
    '현대':['그랜저','쏘나타 디 엣지','아반떼','아반떼 N','더 뉴 아이오닉 6','아이오닉 6 N'],
    '기아':['K5','K8','K9','EV4'],
    '제네시스':['G70','G80','G90','Electrified G80'],
    '르노코리아':[]
  },
  '국산SUV':{
    '현대':['싼타페','투싼','디 올 뉴 팰리세이드','코나','베뉴','캐스퍼','디 올 뉴 넥쏘','아이오닉 5','아이오닉 5 N','아이오닉 9','코나 일렉트릭','캐스퍼 일렉트릭'],
    '기아':['쏘렌토','스포티지','셀토스','디 올 뉴 셀토스','니로','더 뉴 니로','EV3','EV5','EV6','EV9','니로 EV'],
    '제네시스':['GV80','GV70','GV60','GV60 MAGMA','Electrified GV70'],
    'KG모빌리티':['토레스','액티언','티볼리','무쏘','무쏘 칸','렉스턴 뉴 아레나','토레스 EVX','무쏘 EV'],
    '쉐보레':['트랙스 크로스오버','트레일블레이저'],
    '르노코리아':['아르카나','그랑 콜레오스','세닉 E-테크 일렉트릭','필랑트']
  },
  '승합':{
    '현대':['스타리아','더 뉴 스타리아','쏠라티','카운티','카운티 일렉트릭'],
    '기아':['카니발','PV5']
  },
  '전기차':{
    '현대':['아이오닉 5','아이오닉 5 N','아이오닉 6 N','더 뉴 아이오닉 6','아이오닉 9','코나 일렉트릭','캐스퍼 일렉트릭','ST1','포터2 일렉트릭','카운티 일렉트릭'],
    '기아':['EV3','EV4','EV5','EV6','EV9','니로 EV','봉고 3 EV','레이 EV'],
    '제네시스':['Electrified G80','Electrified GV70','GV60','GV60 MAGMA'],
    'KG모빌리티':['토레스 EVX','무쏘 EV'],
    '르노코리아':['세닉 E-테크 일렉트릭'],
    '테슬라':['Model Y','Model 3','Model S','Model X','Cybertruck','Roadster'],
    '폴스타':['Polestar 4','Polestar 2'],
    'BYD':['ATTO 3','SEAL','SEALION 7','Dolphin','T4K'],
    'BMW':['iX','iX1','iX2','The New iX3','i4','i5','i7'],
    '메르세데스-벤츠':['EQE','EQS','EQS SUV','EQE SUV','EQA','EQB','Electric G-Class','Maybach EQS SUV'],
    '포르쉐':['Taycan','Macan Electric','Cayenne Electric'],
    '아우디':['Q4 e-tron','Q8 e-tron','Q6 e-tron','A6 e-tron','The new e-tron GT'],
    '볼보':['EX90','EX30','EX30 CC'],
    '미니':['Mini Electric','Countryman Electric'],
    '캐딜락':['Escalade IQ'],
    '롤스로이스':['Spectre'],
    '로터스':['Eletre','Emeya'],
    '마세라티':['Grecale Folgore','GranTurismo Folgore','GranCabrio Folgore'],
    '폭스바겐':['ID.4','ID.5'],
    '동풍':['Rich6 EV']
  },
  '하이브리드':{
    '현대':['그랜저','싼타페','투싼','코나','아반떼'],
    '기아':['K5','K8','쏘렌토','스포티지','니로','더 뉴 니로'],
    '토요타':['Camry','Prius','RAV4','Highlander','Crown','Sienna','Alphard'],
    '렉서스':['ES','RX','NX','UX','LM','LX','LS'],
    '혼다':['Accord','CR-V','Pilot','Odyssey'],
    '볼보':['XC60','XC90','S90','XC40','V60 Cross Country','V90 Cross Country'],
    '메르세데스-벤츠':['E-Class','S-Class','GLE-Class','GLC-Class','C-Class','CLE'],
    'BMW':['5 Series','7 Series','X5','X3','XM'],
    '포르쉐':['Cayenne','Panamera'],
    '아우디':['A6','A7','Q5','The new Q5'],
    '폭스바겐':['Touareg'],
    '랜드로버':['Range Rover','Range Rover Sport','Range Rover Velar','Range Rover Evoque'],
    '푸조':['3008','All New 5008','408','308'],
    '미니':['Countryman','Cooper'],
    '지프':['Wrangler','Grand Cherokee']
  }
};

function carMatchesType(carName, brand, type){
  if(!type) return true;
  const list=TYPE_MEMBERSHIP[type]?.[brand];
  if(!list) return false;
  return list.includes(carName);
}

function typeCount(type){
  let n=0;
  Object.keys(ALL_BRAND_CARS).forEach(b=>{
    (ALL_BRAND_CARS[b]||[]).forEach(c=>{ if(carMatchesType(c.n,b,type)) n++; });
  });
  return n;
}

function blist(){
  return(tab==='국산차'?DOMESTIC_BRANDS:IMPORT_BRANDS).filter(b=>ALL_BRAND_CARS[b]).slice().sort((a,b)=>{
    const ra=brandRank(a), rb=brandRank(b);
    if(ra!==rb) return ra-rb;
    return a.localeCompare(b,'ko');
  });
}
function card(c){const d=document.createElement('div');d.className='card';d.onclick=()=>location.href='car.php?name='+encodeURIComponent(c.n);d.innerHTML='<img src="'+c.i+'" alt="'+c.n+'" loading="lazy" onerror="this.style.opacity=.25"><p>'+c.n+'</p>';return d;}
function qcard(c){
  const d=document.createElement('div');d.className='q-card';
  d.onclick=()=>location.href='variants.php?name='+encodeURIComponent(c.name);
  d.innerHTML='<img src="'+c.img+'" alt="'+c.name+'" onerror="this.style.opacity=.2"><div class="q-info"><div class="q-name">'+c.name+'</div><div class="q-stock"><span class="q-dot"></span>'+c.stock+'대</div></div>';
  return d;
}
function spcard(c){
  const d=document.createElement('div');d.className='q-card';
  d.onclick=()=>location.href='special.php'+(c.type==='ev'?'?tab=ev':'');
  const badgeBg=c.type==='ev'?'linear-gradient(135deg,#0d3b2e,#1a5c3a)':'#dc2626';
  const badgeColor=c.type==='ev'?'#4ade80':'#fff';
  const badgeText=c.type==='ev'?'⚡ EV':'특가';
  d.innerHTML='<img src="'+c.img+'" alt="'+c.name+'" onerror="this.style.opacity=.2"><div class="q-info"><div class="q-name">'+c.name+'</div><div class="q-stock" style="background:'+badgeBg+';color:'+badgeColor+';border:none">'+badgeText+'</div></div>';
  return d;
}
function rBrands(){
  const el=document.getElementById('brands');el.innerHTML='';
  blist().forEach(b=>{
    const bt=document.createElement('button');bt.className='brand'+(b===brand?' on':'');
    if(typeFilter) bt.style.opacity='.45';
    const cnt=(ALL_BRAND_CARS[b]||[]).length;
    bt.innerHTML=b+(cnt?'<span> ('+cnt+')</span>':'');
    bt.onclick=()=>{typeFilter=null;brand=b;rBrands();rTypes();rCars();};
    el.appendChild(bt);
  });
}
const TYPE_LIST=['국산세단','국산SUV','승합','전기차','하이브리드'];
function rTypes(){
  const el=document.getElementById('types');if(!el) return;el.innerHTML='';
  TYPE_LIST.forEach(t=>{
    const bt=document.createElement('button');
    bt.className='type-pill'+(t===typeFilter?' on':'');
    const cnt=typeCount(t);
    bt.innerHTML=t+(cnt?'<span>('+cnt+')</span>':'');
    bt.onclick=()=>{
      typeFilter=(t===typeFilter?null:t);
      rBrands();rTypes();rCars();
    };
    el.appendChild(bt);
  });
}
function rCars(){
  const g=document.getElementById('grid');g.innerHTML='';
  if(typeFilter){
    const blistAll=Object.keys(ALL_BRAND_CARS).slice().sort((a,b)=>{
      const ra=brandRank(a), rb=brandRank(b);
      if(ra!==rb) return ra-rb;
      return a.localeCompare(b,'ko');
    });
    blistAll.forEach(b=>{
      const matches=(ALL_BRAND_CARS[b]||[]).filter(c=>carMatchesType(c.n,b,typeFilter));
      popularitySort(b, matches).forEach(c=>g.appendChild(card(c)));
    });
  } else {
    popularitySort(brand, ALL_BRAND_CARS[brand]||[]).forEach(c=>g.appendChild(card(c)));
  }
}
document.querySelectorAll('.tab').forEach(bt=>{
  bt.onclick=()=>{
    tab=bt.dataset.t;
    typeFilter=null;
    document.querySelectorAll('.tab').forEach(b=>b.classList.remove('on'));
    bt.classList.add('on');
    const l=blist();brand=l[0]||'';rBrands();rTypes();rCars();
  };
});
const qi=document.getElementById('qi'),qc=document.getElementById('qc');
let composing=false;
qi.addEventListener('compositionstart',()=>{composing=true;});
qi.addEventListener('compositionend',()=>{composing=false;});
const IS_MAKE_MODE = new URLSearchParams(location.search).get('mode') === 'make';
if (IS_MAKE_MODE) qi.placeholder = '내차만들기 — 차량명 검색';
qi.addEventListener('input',()=>{
  const q=qi.value.trim();qc.style.display=q?'':'none';
  if(q && q.length>=2){
    document.getElementById('browse').style.display='none';
    document.getElementById('results').style.display='';
    const ql=q.toLowerCase();
    // 빠른출고 매칭 (내차만들기 모드에서는 표시 안 함)
    const qres = IS_MAKE_MODE ? [] : QUICK_CARS.filter(c=>c.name.toLowerCase().includes(ql));
    const qsec=document.getElementById('quick-section');
    const qg=document.getElementById('qgrid');
    qg.innerHTML='';
    if(qres.length){
      qres.forEach(c=>qg.appendChild(qcard(c)));
      document.getElementById('q-cnt').textContent=qres.reduce((a,c)=>a+c.stock,0)+'대 재고';
      qsec.style.display='';
    }else{
      qsec.style.display='none';
    }
    // 특가차량 매칭 (내차만들기 모드에서는 표시 안 함)
    const spres = IS_MAKE_MODE ? [] : SPECIAL_CARS.filter(c=>c.name.toLowerCase().includes(ql));
    const spsec=document.getElementById('special-section');
    const spg=document.getElementById('spgrid');
    spg.innerHTML='';
    if(spres.length){
      spres.forEach(c=>spg.appendChild(spcard(c)));
      document.getElementById('sp-cnt').textContent=spres.length+'건';
      spsec.style.display='';
    }else{
      spsec.style.display='none';
    }
    // 일반 검색
    const all=Object.values(ALL_BRAND_CARS).flat();
    const res=all.filter(c=>c.n.toLowerCase().includes(ql)).sort((a,b)=>a.n.localeCompare(b.n,'ko'));
    document.getElementById('cnt').innerHTML='<span style="font-size:1.1rem;font-weight:900;color:#0a0a0a">전체 차종</span> <span style="font-size:.8rem;color:#737373">'+res.length+'건</span>';
    const rg=document.getElementById('rgrid');rg.innerHTML='';
    res.forEach(c=>rg.appendChild(card(c)));
    document.getElementById('empty').style.display=(!qres.length&&!spres.length&&!res.length)?'':'none';
  }else{
    document.getElementById('browse').style.display='';
    document.getElementById('results').style.display='none';
  }
});
qc.onclick=()=>{qi.value='';qi.dispatchEvent(new Event('input'));qi.focus();};

// URL 파라미터로 진입한 경우 필터 자동 적용
(function applyUrlFilter(){
  const params=new URLSearchParams(location.search);
  const urlTab=params.get('tab');
  const urlType=params.get('type');
  if(urlTab==='수입차'||urlTab==='import'){
    tab='수입차';
    document.querySelectorAll('.tab').forEach(b=>{
      b.classList.toggle('on', b.dataset.t==='수입차');
    });
    const l=blist();brand=l[0]||'';
  }
  if(urlType && ['국산세단','국산SUV','승합','전기차','하이브리드'].includes(urlType)){
    typeFilter=urlType;
  }
})();

rBrands();rTypes();rCars();
</script>

<?php
$bnav_active = 'search';
require __DIR__ . '/../includes/rental_bnav.php';
?>
</body>
</html>