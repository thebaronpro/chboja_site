# CHABOZA Mobile 시안

## 실행 방법
1. 폴더 안의 `mobile.html`을 그대로 브라우저로 열면 됩니다.
2. 또는 로컬 서버에 올려서 보세요 (예: `npx serve .`).

## 파일 구조
```
mobile.html             브라우저 진입점 (CSS + 스크립트 로더)
mobile.jsx              메인 앱 (헤더/탭/검색/탭바 + MobileStage)
mobile-sections.jsx     섹션 컴포넌트들
                        - Hero (자동 카루셀)
                        - Benefits (3개 베네핏 스트립)
                        - QuickActions (4타일)
                        - FastDelivery (빠른출고 한정재고)
                        - TimeDeal (타임딜 + 빛 streak 애니메이션)
                        - PopularVehicles (가로 스크롤)
                        - EVSpecial (스크롤 진입 시 충전 게이지)
                        - WeeklySpecials (2col 그리드)
                        - Consultation (상담 폼)
                        - Footer, TabBar
car-svg.jsx             차량 SVG (Sedan/SUV/Compact/EV/Van)
ios-frame.jsx           iOS 디바이스 프레임 (시안용 — 실제 React Native가 아닌 미리보기)
```

## 컬러 토큰 (mobile.html `<style>` 안 `:root`)
```css
--brand: #E11D2E;     /* CHABOZA 빨강 */
--ink: #0A0A0B;       /* 본문 텍스트 */
--surface: #F7F7F8;   /* 카드 배경 */
--ev: #2ECC8A;        /* 전기차 그린 */
```

## React 코드를 본인 코드베이스로 옮길 때
- React 18 사용 — 그대로 동작합니다.
- 인라인 JSX (Babel standalone) 대신 빌드 환경이 있다면, 각 `.jsx` 파일을 그대로 옮기고 import만 정리하면 됩니다.
- `window.IOSDevice`, `window.CarSedan` 등 글로벌 등록은 빌드 환경에서는 `export`로 바꾸세요.
- CSS는 `<style>` 블록을 `mobile.css`로 분리해서 import하면 깔끔합니다.

## 차량 이미지 교체
`car-svg.jsx`의 SVG 실루엣은 플레이스홀더입니다. 실제 운영 시에는:
1. PNG/JPG 제품 사진으로 교체 — `<img src=...>` 로 바꾸면 됩니다.
2. 위치는 `fd-img`, `pop-img`, `wk-img`, `td-car` 등 컨테이너 안.

## 알려진 인터랙션
- **Hero**: 4.8초 자동 슬라이드, 인디케이터 클릭으로 점프, 일시정지 버튼
- **Time Deal**: 카운트다운 1초마다, 빛 streak 무한 반복
- **EV Special**: IntersectionObserver로 스크롤 진입 시 충전 바 채워짐
- **Consultation**: 인풋 포커스 시 검정 보더, 폼 검증은 미구현
- **Tab Bar**: 하단 5탭 상태 전환만 (라우팅 없음)

## 작업 환경
- React 18.3.1 (UMD CDN)
- Babel Standalone 7.29.0 (CDN)
- Pretendard (jsDelivr CDN)
- Archivo Black, JetBrains Mono (Google Fonts CDN)
