"""Pydantic 데이터 모델 — DB row와 API request/response의 타입 정의."""
from datetime import date, datetime
from typing import Optional, Literal
from pydantic import BaseModel, Field


# ---------- Master ----------

class CapitalCompany(BaseModel):
    id: int
    code: str
    name: str
    product_code: Optional[str] = None


class VehicleModel(BaseModel):
    id: int
    brand: str
    model_name: str
    year_code: Optional[str] = None
    fuel_type: Optional[str] = None


class Trim(BaseModel):
    id: int
    model_id: int
    trim_name: str
    engine_cc: Optional[int] = None
    drivetrain: Optional[str] = None
    base_price: int  # 차량가격 (원)
    is_representative: bool = False


class Color(BaseModel):
    id: int
    trim_id: int
    color_code: Optional[str] = None
    color_name: Optional[str] = None
    is_exterior: bool = True
    extra_cost: int = 0


# ---------- Base Quote ----------

class BaseQuote(BaseModel):
    id: Optional[int] = None
    capital_id: int
    trim_id: int
    term_months: int
    annual_mileage_km: int  # -1 = unlimited
    residual_pct: float
    residual_amount: int
    insurance_cost: Optional[int] = None
    maintenance_cost: Optional[int] = None
    monthly_base_payment: int  # 선납 0% 기준 월납입료
    source_quote_no: Optional[str] = None
    collected_at: Optional[datetime] = None
    raw_data: Optional[dict] = None


class FormulaParams(BaseModel):
    capital_id: int
    interest_rate: float  # 연 이자율 (예: 0.0614 = 6.14%)
    deposit_factor: float = 1.0
    prepay_factor: float = 1.0
    effective_from: date


# ---------- API ----------

class QuoteRequest(BaseModel):
    capital_id: int = Field(..., description="캐피탈사 id")
    trim_id: int = Field(..., description="트림 id")
    color_id: Optional[int] = Field(None, description="색상 id (선택)")
    term: int = Field(..., ge=12, le=60, description="계약기간(개월)")
    mileage: int = Field(..., description="연간 주행거리(km), -1=무제한")
    prepay_pct: int = Field(0, ge=0, le=50, description="선납금 비율(%)")
    deposit_pct: int = Field(0, ge=0, le=50, description="보증금 비율(%)")


class QuoteBreakdown(BaseModel):
    base_monthly: int
    trim_adjustment: int = 0
    color_adjustment: int = 0
    prepay_adjustment: int = 0
    deposit_adjustment: int = 0


class QuoteConditions(BaseModel):
    capital: str
    trim: str
    term_months: int
    annual_mileage_km: int
    prepay_pct: int
    prepay_amount: int
    deposit_pct: int


class QuoteMeta(BaseModel):
    data_freshness_days: int
    calculation_source: Literal["base", "interpolated", "fallback"]
    cache_hit: bool = False
    response_ms: Optional[int] = None


class QuoteResponse(BaseModel):
    monthly_payment: int
    currency: str = "KRW"
    breakdown: QuoteBreakdown
    conditions: QuoteConditions
    meta: QuoteMeta
