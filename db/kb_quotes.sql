-- ============================================================
-- CHABOZA — KB 견적 시스템 테이블 (MySQL / CAFE24)
-- ============================================================
-- 1. db/migrations.sql 이후 실행
-- 2. quote-engine/scripts/load_sample.php 로 데이터 적재
-- ============================================================

SET NAMES utf8mb4;

-- 캐피탈사
CREATE TABLE IF NOT EXISTS chaboza_capital_company (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(20) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  product_code VARCHAR(50) DEFAULT NULL,
  active TINYINT(1) DEFAULT 1,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='캐피탈사 마스터 (KB, 현대, 삼성 등)';

-- 차종
CREATE TABLE IF NOT EXISTS chaboza_vehicle_model (
  id INT AUTO_INCREMENT PRIMARY KEY,
  brand VARCHAR(50) NOT NULL,
  model_name VARCHAR(100) NOT NULL,
  year_code VARCHAR(10) DEFAULT NULL,
  fuel_type VARCHAR(20) DEFAULT NULL,
  category VARCHAR(30) DEFAULT NULL COMMENT 'sedan_popular, suv_popular, ev_imported 등',
  active TINYINT(1) DEFAULT 1,
  UNIQUE KEY uk_model (brand, model_name, year_code),
  INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='차종 마스터';

-- 트림
CREATE TABLE IF NOT EXISTS chaboza_trim (
  id INT AUTO_INCREMENT PRIMARY KEY,
  model_id INT NOT NULL,
  trim_name VARCHAR(200) NOT NULL,
  engine_cc INT DEFAULT NULL,
  drivetrain VARCHAR(10) DEFAULT NULL,
  base_price INT NOT NULL,
  is_representative TINYINT(1) DEFAULT 0,
  active TINYINT(1) DEFAULT 1,
  UNIQUE KEY uk_trim (model_id, trim_name),
  FOREIGN KEY (model_id) REFERENCES chaboza_vehicle_model(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='트림 마스터';

-- 베이스 견적 매트릭스 (★ 핵심 테이블)
CREATE TABLE IF NOT EXISTS chaboza_base_quote (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  capital_id INT NOT NULL,
  trim_id INT NOT NULL,
  term_months INT NOT NULL COMMENT '12/24/36/48/60',
  annual_mileage_km INT NOT NULL COMMENT '10000/15000/20000/30000/-1(무제한)',
  residual_pct DECIMAL(5,2) NOT NULL,
  residual_amount INT NOT NULL,
  monthly_base_payment INT NOT NULL COMMENT '선납 0% 기준 월 납입료',
  source_quote_no VARCHAR(50) DEFAULT NULL,
  collected_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  raw_data JSON DEFAULT NULL,
  UNIQUE KEY uk_quote (capital_id, trim_id, term_months, annual_mileage_km, collected_at),
  INDEX idx_lookup (capital_id, trim_id, term_months, annual_mileage_km),
  FOREIGN KEY (capital_id) REFERENCES chaboza_capital_company(id),
  FOREIGN KEY (trim_id) REFERENCES chaboza_trim(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='베이스 견적 매트릭스';

-- 보간 공식 파라미터
CREATE TABLE IF NOT EXISTS chaboza_formula_params (
  id INT AUTO_INCREMENT PRIMARY KEY,
  capital_id INT NOT NULL,
  category VARCHAR(30) DEFAULT NULL COMMENT 'NULL=전체 기본값, 그 외=카테고리별',
  interest_rate DECIMAL(6,4) NOT NULL COMMENT '예: 0.0614 = 6.14%',
  deposit_factor DECIMAL(6,4) DEFAULT 0.0004,
  prepay_factor DECIMAL(6,4) DEFAULT 1.0000,
  effective_from DATE NOT NULL,
  effective_to DATE DEFAULT NULL,
  notes VARCHAR(500) DEFAULT NULL,
  INDEX idx_lookup (capital_id, category, effective_from),
  FOREIGN KEY (capital_id) REFERENCES chaboza_capital_company(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='보간 공식 파라미터';

-- 견적 요청 로그 (분석용)
CREATE TABLE IF NOT EXISTS chaboza_quote_request_log (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  session_id VARCHAR(100) DEFAULT NULL,
  capital_id INT DEFAULT NULL,
  trim_id INT DEFAULT NULL,
  params JSON NOT NULL,
  monthly_payment INT DEFAULT NULL,
  response_ms INT DEFAULT NULL,
  ip_address VARCHAR(45) DEFAULT NULL,
  user_agent VARCHAR(500) DEFAULT NULL,
  requested_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_requested (requested_at DESC),
  INDEX idx_trim (trim_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='랜딩 페이지 견적 요청 로그';

-- ============================================================
-- 초기 시드 — KB캐피탈
-- ============================================================
INSERT INTO chaboza_capital_company (code, name, product_code) VALUES
  ('KB', 'KB캐피탈', '5010000003')
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- 기본 이자율 (Phase 1 검증: 6.14%)
INSERT INTO chaboza_formula_params (capital_id, category, interest_rate, deposit_factor, prepay_factor, effective_from, notes)
SELECT id, NULL, 0.0614, 0.0004, 1.0000, CURRENT_DATE,
  'Phase 1 검증값 — 9대 평균 6.34%, 보수적으로 6.14% 적용'
FROM chaboza_capital_company WHERE code = 'KB'
ON DUPLICATE KEY UPDATE notes = VALUES(notes);
