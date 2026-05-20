-- ============================================================
-- CHABOZA — 운영 DB 마이그레이션 스크립트 (CAFE24 import용)
-- ============================================================
-- 1. car_clean.sql 먼저 import (6개 car_202603ep_* 테이블)
-- 2. 이 파일 import (운영에 필요한 추가 테이블)
-- 3. CAFE24 phpMyAdmin 또는 mysql CLI에서 실행
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ============================================================
-- 문의/상담 신청
-- ============================================================
CREATE TABLE IF NOT EXISTS chaboza_inquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  source VARCHAR(30) NOT NULL COMMENT '출처: contact, installment, lease, rental_fab, rental_bottom, rental_quote',
  category VARCHAR(50) DEFAULT NULL COMMENT '문의 유형',
  name VARCHAR(100) NOT NULL,
  phone VARCHAR(30) NOT NULL,
  car VARCHAR(255) DEFAULT NULL COMMENT '관심 차량',
  message TEXT DEFAULT NULL,
  consent_marketing TINYINT(1) DEFAULT 0,
  ip_address VARCHAR(45) DEFAULT NULL,
  user_agent VARCHAR(500) DEFAULT NULL,
  status VARCHAR(20) DEFAULT 'new' COMMENT 'new, contacted, closed',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_source (source),
  INDEX idx_status (status),
  INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='상담/문의 접수 (contact, installment, lease, rental FAB·bottom)';

-- ============================================================
-- 카카오 OAuth 사용자 (5단계 이후 활성화)
-- ============================================================
CREATE TABLE IF NOT EXISTS chaboza_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kakao_id BIGINT NOT NULL,
  email VARCHAR(255) DEFAULT NULL,
  nickname VARCHAR(100) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  consent_marketing TINYINT(1) DEFAULT 0,
  status VARCHAR(20) DEFAULT 'active',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  last_login_at DATETIME DEFAULT NULL,
  UNIQUE KEY uk_kakao_id (kakao_id),
  INDEX idx_email (email),
  INDEX idx_phone (phone)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='카카오 OAuth 로그인 사용자';

CREATE TABLE IF NOT EXISTS chaboza_sessions (
  id VARCHAR(64) PRIMARY KEY,
  user_id INT NOT NULL,
  ip_address VARCHAR(45) DEFAULT NULL,
  user_agent VARCHAR(500) DEFAULT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  expires_at DATETIME NOT NULL,
  INDEX idx_user (user_id),
  INDEX idx_expires (expires_at),
  FOREIGN KEY (user_id) REFERENCES chaboza_users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='로그인 세션';

-- ============================================================
-- (선택) OAuth state 보관 — CSRF 방어
-- ============================================================
CREATE TABLE IF NOT EXISTS chaboza_oauth_state (
  state VARCHAR(64) PRIMARY KEY,
  redirect_to VARCHAR(500) DEFAULT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='OAuth state 토큰 (10분 후 정리)';

SET FOREIGN_KEY_CHECKS = 1;
