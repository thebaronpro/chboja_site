<?php
require_once __DIR__ . '/../includes/kakao_oauth.php';

// OAuth가 설정되면 카카오 인증 URL로 리다이렉트, 아니면 목업 동의 화면 표시
if (kakao_oauth_configured()) {
    $redirectTo = $_GET['next'] ?? '/rental/';
    header('Location: ' . kakao_authorize_url($redirectTo));
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>kakao</title>
<link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Pretendard Variable',Pretendard,-apple-system,BlinkMacSystemFont,system-ui,Roboto,sans-serif;background:#fff;color:#191919;padding-bottom:0;animation:fadeIn .18s ease}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}
a{text-decoration:none;color:inherit}
.kk-wrap{max-width:480px;margin:0 auto;min-height:100vh;display:flex;flex-direction:column}
.kk-header{position:relative;padding:1.1rem 1.25rem;border-bottom:1px solid #f0f0f0;text-align:center}
.kk-header-title{font-size:1.05rem;font-weight:500;color:#191919;letter-spacing:-.01em}
.kk-close{position:absolute;right:.6rem;top:50%;transform:translateY(-50%);width:3.4rem;height:3.4rem;display:inline-flex;align-items:center;justify-content:center;background:none;border:none;cursor:pointer;color:#191919;border-radius:50%;transition:background .15s;padding:0;font-family:inherit}
.kk-close:hover{background:#f3f4f6}
.kk-close svg{width:2.2rem;height:2.2rem;stroke:currentColor;stroke-width:2.6}
.kk-body{flex:1;padding:1.1rem 1.25rem 1rem;overflow-y:auto}
.kk-app{display:flex;align-items:center;gap:.75rem;padding:.4rem 0 1rem}
.kk-app-logo{width:48px;height:48px;border-radius:50%;background:#fff;border:1px solid #ececec;display:flex;align-items:center;justify-content:center;color:#0a0a0a;font-size:.68rem;font-weight:900;letter-spacing:-.05em}
.kk-app-logo .lg-i{color:#2563eb}
.kk-app-name .lg-i{color:#2563eb}
.kk-app-name{font-size:1.1rem;font-weight:900;color:#191919;letter-spacing:-.02em}
.kk-app-sub{font-size:.78rem;color:#7d7d7d;margin-top:.15rem}
.kk-divider{height:1px;background:#f0f0f0;margin:.25rem 0 1rem}
.kk-all{display:flex;align-items:flex-start;gap:.6rem;padding:.4rem 0 .8rem}
.kk-check{width:1.6rem;height:1.6rem;border-radius:50%;border:1.5px solid #d4d4d8;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;cursor:pointer;transition:all .12s;background:#fff}
.kk-check.on{background:#000;border-color:#000}
.kk-check.on::after{content:"";width:.55rem;height:.85rem;border:solid #fff;border-width:0 2px 2px 0;transform:rotate(45deg) translate(-1px,-1px)}
.kk-all-text{flex:1}
.kk-all-title{font-size:1rem;font-weight:700;color:#191919;margin-bottom:.25rem;letter-spacing:-.01em}
.kk-all-desc{font-size:.75rem;color:#7d7d7d;line-height:1.5}
.kk-account{display:flex;align-items:center;gap:.5rem;padding:.85rem .75rem;background:#fafafa;border-radius:.45rem;margin:.55rem 0}
.kk-account-icon{width:1.4rem;height:1.4rem;border-radius:50%;background:#e0e0e0;display:inline-flex;align-items:center;justify-content:center;color:#9e9e9e;flex-shrink:0;font-size:.85rem}
.kk-account-email{flex:1;font-size:.85rem;color:#191919}
.kk-account-change{font-size:.75rem;color:#7d7d7d;text-decoration:none;flex-shrink:0;padding:.2rem .4rem;cursor:pointer}
.kk-section{padding:1rem 0 .5rem}
.kk-section-title{font-size:.95rem;font-weight:700;color:#191919;margin-bottom:.55rem;letter-spacing:-.01em}
.kk-section-desc{font-size:.78rem;color:#7d7d7d;line-height:1.55;margin-bottom:.6rem}
.kk-item{display:flex;align-items:flex-start;gap:.55rem;padding:.45rem 0}
.kk-item-check{width:1.05rem;height:1.05rem;flex-shrink:0;display:inline-flex;align-items:center;justify-content:center;color:#7d7d7d;font-weight:900;font-size:1rem;margin-top:.15rem}
.kk-item-check.on{color:#000}
.kk-item-text{flex:1;font-size:.82rem;color:#191919;letter-spacing:-.01em}
.kk-item-tag{color:#191919;font-weight:700;margin-right:.15rem}
.kk-item-sub{font-size:.74rem;color:#7d7d7d;margin-top:.2rem;line-height:1.45}
.kk-item-view{font-size:.74rem;color:#9e9e9e;text-decoration:underline;padding:.2rem .3rem;flex-shrink:0;cursor:pointer}
.kk-footer{padding:.85rem 1.25rem 1.1rem;border-top:1px solid #f0f0f0;background:#fff}
.kk-submit{width:100%;padding:.9rem;background:#bdbdbd;color:#fff;border:none;border-radius:.45rem;font-size:.95rem;font-weight:700;cursor:pointer;font-family:inherit;letter-spacing:-.01em;transition:background .15s}
.kk-submit.active{background:#191919;cursor:pointer}
.kk-submit.active:hover{background:#000}
.kk-copy{text-align:center;padding:.75rem 0 1rem;font-size:.7rem;color:#bdbdbd}
</style>
</head>
<body>
<div class="kk-wrap">
  <div class="kk-header">
    <span class="kk-header-title">kakao</span>
    <button class="kk-close" onclick="closeKakao()" aria-label="닫기">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>
  <div class="kk-body">
    <div class="kk-app">
      <div class="kk-app-logo">RENT<span class="lg-i">inside</span></div>
      <div>
        <div class="kk-app-name">RENT<span class="lg-i">inside</span></div>
        <div class="kk-app-sub">(주)차보자</div>
      </div>
    </div>
    <div class="kk-divider"></div>

    <div class="kk-all" onclick="toggleAll()">
      <div class="kk-check on" id="kkAllCheck"></div>
      <div class="kk-all-text">
        <div class="kk-all-title">전체 동의하기</div>
        <div class="kk-all-desc">전체동의는 카카오 및 (주)차보자의 서비스 동의를 포함하고 있습니다. 전체동의는 선택목적에 대한 동의를 포함하고 있으며, 선택목적에 대한 동의를 거부해도 서비스 이용이 가능합니다.</div>
      </div>
    </div>

    <div class="kk-account">
      <span class="kk-account-icon">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </span>
      <span class="kk-account-email">user****@kakao.com</span>
      <span class="kk-account-change">계정 변경</span>
    </div>

    <div class="kk-section">
      <div class="kk-section-title">카카오 로그인 동의</div>
      <div class="kk-section-desc">차보자 서비스 제공을 위해 회원번호와 함께 개인정보가 제공됩니다. 보다 자세한 개인정보 제공항목은 동의 내용에서 확인하실 수 있습니다. 해당 정보는 동의 철회 또는 서비스 탈퇴 시 지체없이 파기됩니다.</div>

      <div class="kk-item">
        <span class="kk-item-check on" data-item="1">✓</span>
        <div class="kk-item-text">
          <span class="kk-item-tag">[필수]</span>카카오 개인정보 제3자 제공 동의
          <div class="kk-item-sub">카카오계정(전화번호), 이름</div>
        </div>
        <span class="kk-item-view" onclick="alert('카카오 개인정보 제3자 제공 동의 전문\\n\\n수집·이용 항목: 카카오계정(전화번호), 이름\\n제공받는 자: (주)차보자\\n이용 목적: 회원가입 및 견적 서비스 제공\\n보유 기간: 회원 탈퇴 시까지')">보기</span>
      </div>

      <div class="kk-item">
        <span class="kk-item-check on" data-item="2">✓</span>
        <div class="kk-item-text">
          <span class="kk-item-tag" style="color:#7d7d7d">[선택]</span>마케팅 정보 수신 동의
          <div class="kk-item-sub">카카오톡 채널, SMS, 이메일을 통한 광고성 정보 수신에 동의합니다.</div>
        </div>
        <span class="kk-item-view" onclick="alert('마케팅 정보 수신 동의 전문\\n\\n수신 채널: 카카오톡 채널, SMS, 이메일\\n수신 정보: 신차 출시, 특가 프로모션, 한정 재고 알림\\n수신 동의는 언제든지 철회할 수 있습니다.')">보기</span>
      </div>
    </div>
  </div>

  <div class="kk-footer">
    <button class="kk-submit active" id="kkSubmit" onclick="proceed()">동의하고 계속하기</button>
  </div>
  <div class="kk-copy">Copyright © Kakao Corp. All rights reserved.</div>
</div>

<script>
const items = [
  document.querySelector('[data-item="1"]'),
  document.querySelector('[data-item="2"]'),
];
const allCheck = document.getElementById('kkAllCheck');
const submitBtn = document.getElementById('kkSubmit');

function updateSubmit(){
  // 필수(1번)가 체크되어야 활성
  const required = items[0].classList.contains('on');
  if (required) submitBtn.classList.add('active');
  else submitBtn.classList.remove('active');
}

function updateAll(){
  const allOn = items.every(it => it.classList.contains('on'));
  if (allOn) allCheck.classList.add('on');
  else allCheck.classList.remove('on');
}

function toggleAll(){
  const allOn = allCheck.classList.contains('on');
  if (allOn) {
    allCheck.classList.remove('on');
    items.forEach(it => it.classList.remove('on'));
  } else {
    allCheck.classList.add('on');
    items.forEach(it => it.classList.add('on'));
  }
  updateSubmit();
}

items.forEach(it => {
  it.addEventListener('click', () => {
    it.classList.toggle('on');
    updateAll();
    updateSubmit();
  });
});

function inIframe(){
  try { return window.self !== window.top; } catch(e){ return true; }
}
function closeKakao(){
  if (inIframe() && window.parent && typeof window.parent.closeKakaoOverlay === 'function') {
    try { window.parent.closeKakaoOverlay(); return; } catch(e){}
  }
  if (history.length > 1) history.back();
  else location.href = 'index.php';
}
function proceed(){
  if (!submitBtn.classList.contains('active')) {
    alert('필수 항목에 동의해주세요.');
    return;
  }
  alert('카카오톡 간편 가입이 완료되었습니다.\n\n• 견적 저장, 내 차량 관리, 계약 진행상황 확인 등의 기능을 이용하실 수 있습니다.');
  closeKakao();
}
</script>
</body>
</html>
