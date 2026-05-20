# CAFE24 배포 가이드

## 1. CAFE24 호스팅 환경 사전 확인

### 1-1. PHP 버전
CAFE24 호스팅 관리자 → 부가서비스 → PHP 버전 설정
- **8.4.x 권장** (현재 코드 호환 버전)
- 사용 불가 시 **8.2 이상**으로 설정 (호환 가능, 권장 8.4)
- 7.x는 절대 사용 금지 (`declare(strict_types=1)`, `??=`, 화살표 함수 등 사용)

### 1-2. MariaDB / MySQL
- CAFE24 기본: MariaDB 10.x
- 문자셋: **utf8mb4 / utf8mb4_unicode_ci** (관리자에서 확인/변경)

### 1-3. PHP 익스텐션 (필수)
호스팅 관리자에서 활성화 확인:
- `pdo_mysql` (DB 연결)
- `mbstring` (한글 처리)
- `openssl` (HTTPS, Kakao OAuth)
- `curl` (Kakao OAuth)
- `json` (기본)

### 1-4. .htaccess / mod_rewrite
CAFE24는 기본 활성화. 본 프로젝트의 `.htaccess` 그대로 사용 가능.

---

## 2. DB 마이그레이션

### 2-1. 호스팅 DB 정보 확인
관리자 페이지 → 부가서비스 → MySQL/MariaDB
- 호스트 (보통 `localhost` 또는 `db.cafe24.com`)
- DB 이름
- DB 사용자
- DB 비밀번호

### 2-2. car 데이터 import
phpMyAdmin에서:
```
1. 데이터베이스 선택
2. 가져오기 → db/car_clean.sql 업로드 (13.5MB, ~30초 소요)
```

또는 SSH/CLI:
```bash
mysql -u USER -p DB_NAME < db/car_clean.sql
```

### 2-3. 운영 테이블 생성
```bash
mysql -u USER -p DB_NAME < db/migrations.sql
```
또는 phpMyAdmin에서 SQL 실행.

확인:
```sql
SHOW TABLES;
-- car_202603ep_en, _ko, _option_color, _option_list, _option_price, _price
-- chaboza_inquiries, chaboza_users, chaboza_sessions, chaboza_oauth_state
```

---

## 3. 환경 설정 (includes/config.php)

`includes/config.php`는 자동으로 환경 분기 — 로컬은 root, 운영은 환경변수.

### 3-1. CAFE24 환경변수 설정 방법
CAFE24는 일반적으로 `.env` 미지원. 대신 다음 중 하나:

**옵션 A: includes/config.php 직접 수정 (간단)**
```php
} else {
    define('DB_HOST', 'localhost');
    define('DB_PORT', 3306);
    define('DB_NAME', '실제_DB_이름');
    define('DB_USER', '실제_DB_사용자');
    define('DB_PASS', '실제_비밀번호');
}
```

**옵션 B: 별도 secret 파일 (권장, git 미커밋)**
1. `includes/config.local.php` 생성 (`.gitignore`에 추가):
   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_NAME', '...');
   define('DB_USER', '...');
   define('DB_PASS', '...');
   ```
2. `includes/config.php`에서 production 분기에 `require_once`:
   ```php
   } else {
       require __DIR__ . '/config.local.php';
       define('DB_PORT', 3306);
   }
   ```

---

## 4. 파일 업로드

### 업로드 대상 (FTP / SFTP)
- 모든 `*.php`
- `includes/`, `api/`, `cowork/`, `db/`, `rental/`, `contact/`, `event/`, `shop/`, `installment/`, `used-car/`, `lease/`
- `cars/` (~50MB, 차량 이미지)
- `lib/`, `main banner/`, `mobile-export/`
- `car_brands.js`, `data.js`, `components.js`
- `*.json` 데이터
- `.htaccess`

### 업로드 제외
- `.claude/` (Claude Code 메타)
- `.git/` (git 메타)
- `*.bak`, `index.react.backup.html`
- `_test_*.php` (있다면)
- `search_template.html`, `search_data.js` (미사용)

### 권한
- 디렉터리: 755
- 파일: 644
- `.htaccess`: 644

---

## 5. HTTPS 설정

### 5-1. CAFE24 무료 SSL 신청
호스팅 관리자 → 부가서비스 → SSL → Let's Encrypt 무료 인증서 신청 (보통 1-2시간 소요)

### 5-2. HTTPS 강제 (선택)
`.htaccess`의 다음 블록 주석 해제:
```apache
RewriteEngine On
RewriteCond %{HTTPS} !=on
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## 6. 검증 체크리스트

배포 후 모든 페이지 200 확인:
- [ ] `https://도메인/` — 홈 (메인 캐러셀, 인기차량)
- [ ] `https://도메인/rental/` — 장기렌트 (SubCarousel, 빠른출고, 인기차량, 주간 특가)
- [ ] `https://도메인/rental/limited.php` — 빠른출고 목록
- [ ] `https://도메인/rental/variants.php?name=현대%20싼타페` — 변형 목록
- [ ] `https://도메인/rental/car.php?name=현대%20그랜저` — 견적 화면
- [ ] `https://도메인/rental/car.php?from=limited&...` — 빠른출고 견적
- [ ] `https://도메인/rental/special.php` — 특가 (`?tab=ev` 분기 확인)
- [ ] `https://도메인/rental/search.php` — 검색
- [ ] `https://도메인/installment/` — 할부 (계산기 동작)
- [ ] `https://도메인/used-car/` — 중고차 (검색/필터)
- [ ] `https://도메인/lease/` — 화물리스
- [ ] `https://도메인/shop/` — 자동차용품
- [ ] `https://도메인/event/` — 이벤트 (`?f=open/closed/all`)
- [ ] `https://도메인/contact/` — 고객센터 (FAQ 토글, 폼 POST)

### 폼 동작 검증
각 페이지의 상담 신청 폼 제출 → `chaboza_inquiries` 테이블 확인:
```sql
SELECT id, source, name, phone, status, created_at
FROM chaboza_inquiries
ORDER BY id DESC LIMIT 10;
```

### 이메일 알림 검증
CAFE24는 `mail()` 함수 지원. `includes/inquiry.php`의 `INQUIRY_NOTIFY_TO`를 실제 받을 이메일로 변경 후 테스트.
**중요:** 보내는 주소(`INQUIRY_NOTIFY_FROM`)가 사이트 도메인과 일치해야 스팸 처리 안 됨. 예: `noreply@chaboza.cafe24.com` 또는 본인 도메인.

---

## 7. 트러블슈팅

### 한글 깨짐
- DB charset: `utf8mb4`
- 페이지 charset: 모든 PHP 파일 `<meta charset="UTF-8">` 확인됨
- DB 연결 시 `SET NAMES utf8mb4` (이미 `includes/db.php`에 포함)

### 500 에러
- `.htaccess` 문법 → CAFE24 가이드와 비교
- PHP 버전 → 8.2 미만이면 strict_types 등 에러 발생
- 디렉터리 권한 → 755

### 폼 POST 실패
- `/api/inquiry.php` 직접 접근해서 405 응답 오는지 확인
- DB 연결 실패 시: `includes/config.php`의 DB 정보 재확인
- 로그: CAFE24 호스팅 관리자 → 에러 로그 확인

### 카카오 로그인 안 됨
- 현재 `rental/kakao_login.php`는 **목업** (실제 OAuth 미구현)
- 운영 시 카카오 OAuth 통합 별도 작업 필요 — `cowork/oauth_kakao_setup.md` 참조 (없으면 추후 생성)

---

## 8. 운영 전 최종 확인

- [ ] `includes/config.php`의 production DB 정보 채움
- [ ] `includes/inquiry.php`의 `INQUIRY_NOTIFY_TO` 실제 이메일로 변경
- [ ] `.gitignore`에 `includes/config.local.php` 추가 (사용 시)
- [ ] HTTPS 인증서 적용 완료
- [ ] `.htaccess`의 HTTPS 강제 블록 활성화
- [ ] 모든 페이지 도메인 기반 URL로 동작 확인
- [ ] DB 백업 정책 설정 (CAFE24 자동 백업 활용)
- [ ] CAFE24 호스팅 만료일 확인

---

## 부록: CAFE24 호스팅 vs 로컬 차이점

| 항목 | 로컬 (XAMPP) | CAFE24 |
|---|---|---|
| URL | http://localhost:8000 | https://도메인 |
| DB host | 127.0.0.1 | localhost or db.cafe24.com |
| DB user | root (비밀번호 없음) | 호스팅 발급 |
| `mail()` | 미동작 (notified=false) | 동작 |
| HTTPS | 없음 | 무료 Let's Encrypt |
| 카카오 OAuth | 불가 (HTTPS 필요) | 가능 |
| `includes/config.php` 분기 | local | production |
