# 차보자 사이트 — 견적 엔진 통합 가이드

KB캐피탈 견적 데이터를 차보자 사이트(`chaboza-site/`)에 통합하기 위한 단계별 가이드.

## 통합 구조

```
chaboza site/
├── rental/, lease/, installment/   ← 기존 (변경 없음)
├── api/
│   ├── inquiry.php                  (기존)
│   └── quote.php                    ★ 신규 (랜딩 페이지가 호출)
├── includes/
│   ├── db.php, inquiry.php          (기존)
│   └── quote_engine.php             ★ 신규 (PHP 보간 엔진)
├── db/
│   ├── migrations.sql               (기존)
│   └── kb_quotes.sql                ★ 신규 (견적 테이블)
└── quote-engine/                    ★ 신규 폴더 — Python 자동 수집
    ├── adapters/kb_capital_full.py  (KB 사이트 자동 수집)
    ├── scripts/                     (분석, 검증, 데모)
    ├── sample_data/                 (수집된 견적 JSON)
    ├── config/vehicles.yaml         (15대 차량 마스터)
    └── README.md
```

## 단계별 적용

### Phase A — JSON 백엔드로 빠르게 테스트 (DB 없이)

가장 빠른 검증 경로. 1시간 이내 완료 가능.

#### 1) 견적 데이터 확보
```bash
cd quote-engine
# (현재 sample_data/avante_full_matrix_20260526.json 이미 포함됨 — 1대 데모용)
# 추가 차량은 본인 PC에서 수집:
python -m adapters.kb_capital_full --user reekun --priority P0 \
    --output sample_data/kb_p0.json
```

#### 2) PHP API 동작 확인
```bash
# 환경변수 설정 (없으면 JSON 백엔드 자동)
# QUOTE_BACKEND=json (기본)
# QUOTE_JSON_PATH=/path/to/quote-engine/sample_data/avante_full_matrix_20260526.json

# 로컬에서 API 호출 테스트 (PHP 내장 서버 사용 시)
php -S localhost:8000

# 다른 터미널에서:
curl "http://localhost:8000/api/quote.php?term=48&mileage=10000&prepay_pct=30"
```

기대 응답:
```json
{
  "ok": true,
  "monthly_payment": 187554,
  "currency": "KRW",
  "breakdown": {
    "base_monthly": 332620,
    "prepay_adjustment": -145066,
    "deposit_adjustment": 0
  },
  "conditions": {
    "trim_name": "[26MY]현대 더 뉴 아반떼(CN7) 1.6 가솔린 스마트",
    "vehicle_price": 20650000,
    "term_months": 48,
    "annual_mileage_km": 10000,
    "prepay_pct": 30,
    "prepay_amount": 6195000
  },
  "meta": { "backend": "json", "response_ms": 4 }
}
```

#### 3) 랜딩 페이지에서 호출 (rental/direct.php 등에 추가)

```javascript
// 견적 슬라이더 조작 시
async function updateQuote() {
  const params = new URLSearchParams({
    term: document.getElementById('term-slider').value,
    mileage: document.getElementById('mileage-slider').value,
    prepay_pct: document.getElementById('prepay-slider').value,
    deposit_pct: document.getElementById('deposit-slider').value,
  });
  const res = await fetch(`/api/quote.php?${params}`);
  const data = await res.json();
  if (data.ok) {
    document.getElementById('price-display').textContent =
      data.monthly_payment.toLocaleString() + '원/월';
  }
}
```

### Phase B — MySQL 백엔드로 전환 (운영)

차량 10대 이상 또는 CAFE24 운영 환경.

#### 1) 테이블 생성
```bash
mysql -u <user> -p <db> < db/kb_quotes.sql
```

#### 2) JSON → MySQL 적재 (수집 후 매번 실행)
```bash
# Python 측에서 (quote-engine/scripts/)
python -m scripts.load_to_mysql sample_data/kb_p0.json --dsn "mysql://..."
# 또는 PHP 스크립트로 가능 (TODO)
```

#### 3) 환경변수 전환
```bash
# .env 또는 PHP-FPM 환경변수
QUOTE_BACKEND=mysql
```

`/api/quote.php` 호출 시 `trim_id` 파라미터 필수:
```
curl "https://chaboza.com/api/quote.php?trim_id=42&term=48&mileage=10000&prepay_pct=30"
```

## 매월 갱신 운영 (정착되면)

1. 매월 1일 새벽 → 본인 PC에서 `kb_capital_full.py` 실행 (약 3~4시간)
2. 결과 JSON → MySQL 적재 (PHP 스크립트 1번 실행)
3. 랜딩 페이지는 즉시 최신 견적 응답

## 트러블슈팅

| 증상 | 원인 | 해결 |
|---|---|---|
| `api/quote.php` 호출 시 500 에러 | `include/quote_engine.php` 경로 문제 | 절대경로 확인 |
| `no_base_quote` 응답 | JSON에 해당 조건 없음 | term/mileage가 매트릭스 범위 내인지 확인 |
| MySQL 백엔드 PDO 에러 | `includes/db.php`의 db_pdo() 함수 필요 | 기존 차보자 DB 헬퍼 호출 형태에 맞춰 수정 |

## 다음 단계 (선택)

- **현대캐피탈, 삼성카드 등** 다른 캐피탈사 어댑터 추가 → 가장 저렴한 캐피탈 자동 선택
- **차량 이미지/색상 옵션** 통합 (car_brands.json과 연동)
- **상품 유형 분기** (장기렌트/리스/할부) — 캐피탈사별 상품코드 매핑
- **CSV 내보내기** — 운영자가 견적 매트릭스 다운로드
