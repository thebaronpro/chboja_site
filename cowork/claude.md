# CHABOZA 프로젝트 — Claude 작업 가이드

## 프로젝트 개요
- 한국 자동차 렌트/할부/중고차 플랫폼 (차보자)
- React → 순수 PHP 8.4 + jQuery 3.7.1 + MariaDB(chaboza DB) 마이그레이션 완료
- 호스팅: CAFE24
- 로컬: XAMPP MariaDB(:3306) + PHP 8.4.10 빌트인 서버(`C:\php-8.4\php.exe`)

## 로컬 실행
```powershell
# MariaDB
"C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:/xampp/mysql/bin/my.ini" --console

# PHP dev 서버
"C:\php-8.4\php.exe" -S localhost:8000 -t "C:/Users/user/chaboza site"
```
- 사이트: http://localhost:8000/
- DB: localhost:3306 / root / (pw 없음) / chaboza

## 파일 구조 핵심
- `includes/` — PHP 공통 모듈 (config, db, functions, data, header, footer, rental_*, car_data)
- `rental/` — 장기렌트 페이지들 (index/limited/variants/special/search/car/ev/kakao_login)
- `contact/`, `event/`, `shop/`, `installment/`, `used-car/`, `lease/` — 각 섹션
- `index.php` (루트) — 홈
- `car_brands.js`, `limited_cars.js` — 큰 외부 JS 데이터

## 작업 시 절대 규칙
1. **데스크탑 절대 건드리지 말 것** — 모바일 작업 시 `@media (max-width:768px)` 안에만 변경. 데스크탑 레이아웃 변경 금지.
2. **시키지 않은 변경 금지** — 요청한 것만 정확하게. 임의 디자인/구조 변경 절대 금지.
3. **대수 뱃지 통일** — 차콜 `#18181b` 배경 + 살구 `#fb7185` 점 + 흰 글씨. 분홍 뱃지 금지.
4. **하단 mob-bottom-nav의 "홈"** — rental 페이지에서는 `index.php` (장기렌트 홈)으로 가야 함. `../index.php` (차보자 루트) 금지. 차보자 루트는 햄버거 메뉴에서만.

## 색상 매핑 (car.php의 guessColorHex)
우선순위: (1) DB rgbcode (`window.COLOR_HEX_DB`) → (2) `CAR_BRANDS_DATA` → (3) 키워드 fallback.
키워드 fallback에서 **베이지/브라운 먼저** 체크, 카키/그린 나중. "카키 베이지" 같은 복합명 오매칭 방지.

## DB 주의사항
- 모든 chaboza 테이블 첫 행은 헤더(메타데이터) — `not_header_clause()` 또는 `car_data_*()` 헬퍼로 필터.
- collation은 `utf8mb3 utf8_general_ci` (DB 자체는 utf8mb4).
- 모든 컬럼 `varchar(255)` — 숫자 비교 시 `(int)`/`(float)` 캐스팅.

## 메모리 트리거
사용자가 다음 단어 중 하나를 말하면 `cowork/memory.md`를 **덮어쓰기**로 갱신:
- "메모리", "메모리 해", "기록해", "save", "memory"

저장 내용 형식: 날짜·시각, 최근 작업 요약, 변경된 파일 목록, 현재 사이트 상태, 미해결 이슈/다음 단계.
