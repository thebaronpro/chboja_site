-- ============================================================================
-- 렌트 견적 통합 시스템 - DB 스키마 (Phase 1 PoC)
-- 대상: PostgreSQL 14+
-- ============================================================================

-- ---------- Master Tables ----------

CREATE TABLE IF NOT EXISTS capital_company (
    id              SERIAL PRIMARY KEY,
    code            VARCHAR(20) UNIQUE NOT NULL,
    name            VARCHAR(100) NOT NULL,
    product_code    VARCHAR(50),
    site_url        TEXT,
    active          BOOLEAN DEFAULT TRUE,
    created_at      TIMESTAMP DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS vehicle_model (
    id              SERIAL PRIMARY KEY,
    brand           VARCHAR(50)  NOT NULL,
    model_name      VARCHAR(100) NOT NULL,
    year_code       VARCHAR(10),
    fuel_type       VARCHAR(20),
    segment         VARCHAR(20),
    active          BOOLEAN DEFAULT TRUE,
    UNIQUE(brand, model_name, year_code)
);

CREATE TABLE IF NOT EXISTS trim (
    id                  SERIAL PRIMARY KEY,
    model_id            INTEGER NOT NULL REFERENCES vehicle_model(id),
    trim_name           VARCHAR(200) NOT NULL,
    engine_cc           INTEGER,
    drivetrain          VARCHAR(10),
    base_price          INTEGER NOT NULL,
    is_special          BOOLEAN DEFAULT FALSE,
    is_representative   BOOLEAN DEFAULT FALSE,
    active              BOOLEAN DEFAULT TRUE,
    UNIQUE(model_id, trim_name)
);

CREATE TABLE IF NOT EXISTS color (
    id              SERIAL PRIMARY KEY,
    trim_id         INTEGER NOT NULL REFERENCES trim(id),
    color_code      VARCHAR(20),
    color_name      VARCHAR(100),
    is_exterior     BOOLEAN DEFAULT TRUE,
    extra_cost      INTEGER DEFAULT 0
);

-- ---------- Base Quote (핵심 매트릭스) ----------

CREATE TABLE IF NOT EXISTS base_quote (
    id                      BIGSERIAL PRIMARY KEY,
    capital_id              INTEGER NOT NULL REFERENCES capital_company(id),
    trim_id                 INTEGER NOT NULL REFERENCES trim(id),
    term_months             INTEGER NOT NULL,
    annual_mileage_km       INTEGER NOT NULL,
    residual_pct            NUMERIC(5,2) NOT NULL,
    residual_amount         INTEGER NOT NULL,
    insurance_cost          INTEGER,
    maintenance_cost        INTEGER,
    monthly_base_payment    INTEGER NOT NULL,
    source_quote_no         VARCHAR(50),
    collected_at            TIMESTAMP NOT NULL DEFAULT NOW(),
    raw_data                JSONB,
    UNIQUE(capital_id, trim_id, term_months, annual_mileage_km, collected_at)
);

CREATE INDEX IF NOT EXISTS idx_base_quote_lookup
    ON base_quote (capital_id, trim_id, term_months, annual_mileage_km, collected_at DESC);

-- ---------- Formula Parameters (보간 계수) ----------

CREATE TABLE IF NOT EXISTS formula_params (
    id                  SERIAL PRIMARY KEY,
    capital_id          INTEGER NOT NULL REFERENCES capital_company(id),
    interest_rate       NUMERIC(6,4),       -- 연 이자율 (예: 0.0614 = 6.14%)
    deposit_factor      NUMERIC(6,4),       -- 보증금 기회비용 계수
    prepay_factor       NUMERIC(6,4),       -- 선납금 추가 보정 계수 (기본 1.0)
    effective_from      DATE NOT NULL,
    effective_to        DATE,
    notes               TEXT
);

-- ---------- 운영 로그 ----------

CREATE TABLE IF NOT EXISTS validation_log (
    id                  BIGSERIAL PRIMARY KEY,
    base_quote_id       BIGINT REFERENCES base_quote(id),
    validation_date     DATE NOT NULL DEFAULT CURRENT_DATE,
    test_params         JSONB NOT NULL,
    site_value          INTEGER NOT NULL,
    formula_value       INTEGER NOT NULL,
    diff_pct            NUMERIC(6,3) NOT NULL,
    status              VARCHAR(20) NOT NULL,
    alarm_sent          BOOLEAN DEFAULT FALSE,
    created_at          TIMESTAMP DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS quote_request_log (
    id                  BIGSERIAL PRIMARY KEY,
    user_session        VARCHAR(100),
    capital_id          INTEGER,
    trim_id             INTEGER,
    params              JSONB NOT NULL,
    monthly_payment     INTEGER,
    cache_hit           BOOLEAN,
    response_ms         INTEGER,
    requested_at        TIMESTAMP DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_qrl_requested_at
    ON quote_request_log (requested_at DESC);

-- ============================================================================
-- 초기 시드 데이터 (Phase 1 KB)
-- ============================================================================

INSERT INTO capital_company (code, name, product_code, site_url) VALUES
    ('KB', 'KB캐피탈', '5010000003', 'https://kbeasy.kbcapital.co.kr/ss/em/EM030100.kbc')
ON CONFLICT (code) DO NOTHING;

-- 검증된 이자율: 6.136% (2026-05-26 실측 데이터로 역산, 평균 오차 0.07%)
INSERT INTO formula_params (capital_id, interest_rate, deposit_factor, prepay_factor, effective_from, notes)
SELECT id, 0.0614, 1.0, 1.0, CURRENT_DATE, 'Initial value derived from 2026-05-26 empirical data (avg error 0.07%)'
FROM capital_company WHERE code = 'KB'
ON CONFLICT DO NOTHING;
