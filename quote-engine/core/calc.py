"""
견적 계산 엔진 (보간 공식 구현)

설계서 6.1절 공식:
  monthly_payment = base_monthly
                  + trim_price_diff_adjustment
                  + color_extra_adjustment
                  + prepay_adjustment
                  + deposit_adjustment

검증: KB 실측 데이터(아반떼/싼타페/팰리세이드, 2026-05-26) 기준 평균 오차 0.07%
이자율: 6.14% (KB 다이렉트 장기렌트 48개월 기준 역산값)
"""

from dataclasses import dataclass
from typing import Optional

from .models import (
    BaseQuote, FormulaParams, Trim, Color,
    QuoteRequest, QuoteResponse, QuoteBreakdown, QuoteConditions, QuoteMeta,
)


@dataclass
class CalcInputs:
    """계산 엔진 단일 호출의 모든 입력값을 묶은 컨테이너."""
    base: BaseQuote                  # 베이스 견적 (대표 트림, 선납 0% 기준)
    representative_trim: Trim         # 베이스 견적을 수집한 대표 트림
    target_trim: Trim                 # 사용자가 선택한 실제 트림
    color: Optional[Color]            # 선택 색상 (없으면 None)
    formula: FormulaParams            # 캐피탈사별 보간 계수
    request: QuoteRequest             # 사용자 요청


def trim_price_diff_adjustment(c: CalcInputs) -> int:
    """
    같은 차종 내에서 대표 트림 대비 가격 차이를 월납입료에 보정.
    가격 차이가 그대로 감가에 반영되고, 약간의 이자 비용도 추가됨.
    """
    price_diff = c.target_trim.base_price - c.representative_trim.base_price
    if price_diff == 0:
        return 0
    residual_factor = 1 - (c.base.residual_pct / 100.0)
    term = c.request.term
    interest_factor = 1 + c.formula.interest_rate * term / 24
    return int(round(price_diff * residual_factor / term * interest_factor))


def color_extra_adjustment(c: CalcInputs) -> int:
    """유료 색상 추가금을 잔존가치 반영 후 월납에 가산."""
    if c.color is None or c.color.extra_cost == 0:
        return 0
    residual_factor = 1 - (c.base.residual_pct / 100.0)
    return int(round(c.color.extra_cost * residual_factor / c.request.term))


def prepay_adjustment(c: CalcInputs) -> int:
    """
    선납금 비율 변동에 따른 월납 감소분.
    공식: -prepay_amount × (1 + r × T/24) / T × prepay_factor
    """
    if c.request.prepay_pct == 0:
        return 0
    prepay_amount = c.target_trim.base_price * (c.request.prepay_pct / 100.0)
    term = c.request.term
    factor = (1 + c.formula.interest_rate * term / 24) / term
    return int(round(-prepay_amount * factor * c.formula.prepay_factor))


def deposit_adjustment(c: CalcInputs) -> int:
    """
    보증금 비율 변동에 따른 월납 감소분 (선납보다 작은 영향).
    공식: -deposit_amount × deposit_factor × r / 12
    """
    if c.request.deposit_pct == 0:
        return 0
    deposit_amount = c.target_trim.base_price * (c.request.deposit_pct / 100.0)
    return int(round(-deposit_amount * c.formula.deposit_factor * c.formula.interest_rate / 12))


def calculate(c: CalcInputs) -> QuoteResponse:
    """베이스 견적 + 4가지 보정값을 합산하여 최종 월납입료 계산."""
    bd = QuoteBreakdown(
        base_monthly=c.base.monthly_base_payment,
        trim_adjustment=trim_price_diff_adjustment(c),
        color_adjustment=color_extra_adjustment(c),
        prepay_adjustment=prepay_adjustment(c),
        deposit_adjustment=deposit_adjustment(c),
    )

    total = (
        bd.base_monthly
        + bd.trim_adjustment
        + bd.color_adjustment
        + bd.prepay_adjustment
        + bd.deposit_adjustment
    )

    prepay_amount = int(c.target_trim.base_price * c.request.prepay_pct / 100)

    return QuoteResponse(
        monthly_payment=total,
        breakdown=bd,
        conditions=QuoteConditions(
            capital="",  # caller에서 채움
            trim=c.target_trim.trim_name,
            term_months=c.request.term,
            annual_mileage_km=c.request.mileage,
            prepay_pct=c.request.prepay_pct,
            prepay_amount=prepay_amount,
            deposit_pct=c.request.deposit_pct,
        ),
        meta=QuoteMeta(
            data_freshness_days=0,
            calculation_source="base" if (
                bd.trim_adjustment == 0 and bd.color_adjustment == 0
                and bd.prepay_adjustment == 0 and bd.deposit_adjustment == 0
            ) else "interpolated",
        ),
    )
