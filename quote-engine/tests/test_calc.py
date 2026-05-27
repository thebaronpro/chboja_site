"""
계산 엔진 단위 테스트.

DB 의존성 없이 핵심 보간 공식만 검증.
실측 데이터 (KB 2026-05-26): 아반떼/싼타페/팰리세이드 선납 0%→30% 변환.
"""

import pytest
from datetime import date

from core.models import BaseQuote, FormulaParams, Trim, QuoteRequest
from core.calc import CalcInputs, calculate


# KB 검증된 이자율
KB_RATE = 0.0614
KB_FORMULA = FormulaParams(capital_id=1, interest_rate=KB_RATE, deposit_factor=1.0,
                            prepay_factor=1.0, effective_from=date(2026, 5, 26))


def make_inputs(price: int, base_monthly: int, term: int,
                residual_pct: float, residual_amt: int,
                prepay_pct: int = 0, deposit_pct: int = 0):
    trim = Trim(id=1, model_id=1, trim_name="test", base_price=price)
    base = BaseQuote(capital_id=1, trim_id=1, term_months=term, annual_mileage_km=10000,
                     residual_pct=residual_pct, residual_amount=residual_amt,
                     monthly_base_payment=base_monthly)
    req = QuoteRequest(capital_id=1, trim_id=1, term=term, mileage=10000,
                       prepay_pct=prepay_pct, deposit_pct=deposit_pct)
    return CalcInputs(base=base, representative_trim=trim, target_trim=trim,
                       color=None, formula=KB_FORMULA, request=req)


def test_base_quote_no_adjustments():
    """선납/보증금/트림/색상 모두 기본값이면 base_monthly 그대로."""
    c = make_inputs(20_650_000, 332_620, 48, 64.0, 13_216_000)
    r = calculate(c)
    assert r.monthly_payment == 332_620
    assert r.meta.calculation_source == "base"


@pytest.mark.parametrize("price,base_m,site_m30", [
    (20_650_000, 332_620, 187_630),   # 아반떼
    (36_620_000, 539_040, 282_390),   # 싼타페
    (43_830_000, 652_350, 344_610),   # 팰리세이드
])
def test_prepay_30_within_1pct(price, base_m, site_m30):
    """선납 30% 보간 결과가 실측값과 1% 이내 오차."""
    c = make_inputs(price, base_m, 48, 64.0, int(price*0.64), prepay_pct=30)
    r = calculate(c)
    err = abs(r.monthly_payment - site_m30) / site_m30 * 100
    assert err < 1.0, f"오차 {err:.3f}% > 1.0%, 계산={r.monthly_payment} 실측={site_m30}"
    assert r.meta.calculation_source == "interpolated"


def test_breakdown_consistency():
    """breakdown 합 = monthly_payment."""
    c = make_inputs(36_620_000, 539_040, 48, 63.0, 23_071_000, prepay_pct=30)
    r = calculate(c)
    bd = r.breakdown
    total = bd.base_monthly + bd.trim_adjustment + bd.color_adjustment + bd.prepay_adjustment + bd.deposit_adjustment
    assert total == r.monthly_payment


def test_prepay_amount_in_response():
    """conditions.prepay_amount = base_price × prepay_pct/100."""
    c = make_inputs(20_650_000, 332_620, 48, 64.0, 13_216_000, prepay_pct=30)
    r = calculate(c)
    assert r.conditions.prepay_amount == 6_195_000
