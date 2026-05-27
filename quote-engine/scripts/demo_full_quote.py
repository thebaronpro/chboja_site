"""
랜딩 페이지 시뮬레이션 데모.

avante_full_matrix_20260526.json의 16건 베이스 데이터 + 보간 공식으로
임의의 (계약기간, 주행거리, 선납금%, 보증금%) 조합에 견적 응답.

사용:
  python -m scripts.demo_full_quote
  python -m scripts.demo_full_quote --term 36 --mileage 20000 --prepay 15 --deposit 5

DB 없이 JSON만으로 동작 → 랜딩 페이지 클라이언트에서도 동일 로직 구현 가능.
"""

import argparse
import json
from pathlib import Path


# 보간 파라미터 (KB 다이렉트, 2026-05-26 측정값 기준)
INTEREST_RATE = 0.062      # KB 사이트가 표시한 IRR 6.20~6.29% 평균
DEPOSIT_FACTOR = 0.0004    # 보증금 1원당 월납 절감액 (실측 평균)

DATA_PATH = Path(__file__).resolve().parent.parent / "sample_data" / "avante_full_matrix_20260526.json"


def load_matrix():
    with DATA_PATH.open(encoding="utf-8") as f:
        return json.load(f)


def lookup_base(matrix, term, mileage):
    """매트릭스에서 (계약기간, 주행거리)에 해당하는 베이스 견적 조회."""
    for row in matrix["base_matrix"]:
        if row["term_months"] == term and row["annual_mileage_km"] == mileage:
            return row
    return None


def calculate_quote(matrix, term, mileage, prepay_pct=0, deposit_pct=0):
    """모든 변수에 대해 월 납입료 계산."""
    base = lookup_base(matrix, term, mileage)
    if not base:
        return {"error": f"베이스 견적 없음 (term={term}, mileage={mileage})"}

    price = matrix["vehicle"]["base_price"]
    base_monthly = base["monthly_base_payment"]

    # 선납금 보간
    prepay_amount = price * prepay_pct / 100
    factor = (1 + INTEREST_RATE * term / 24) / term
    prepay_adj = -round(prepay_amount * factor)

    # 보증금 보간 (선납금보다 영향이 매우 작음)
    deposit_amount = price * deposit_pct / 100
    deposit_adj = -round(deposit_amount * DEPOSIT_FACTOR)

    total = base_monthly + prepay_adj + deposit_adj

    return {
        "monthly_payment": total,
        "currency": "KRW",
        "breakdown": {
            "base_monthly": base_monthly,
            "prepay_adjustment": prepay_adj,
            "deposit_adjustment": deposit_adj,
        },
        "conditions": {
            "vehicle": matrix["vehicle"]["trim_name"],
            "vehicle_price": price,
            "term_months": term,
            "annual_mileage_km": mileage,
            "residual_pct": base["residual_pct"],
            "residual_amount": base["residual_amount"],
            "prepay_pct": prepay_pct,
            "prepay_amount": int(prepay_amount),
            "deposit_pct": deposit_pct,
            "deposit_amount": int(deposit_amount),
        },
    }


def print_quote(result):
    if "error" in result:
        print("ERROR:", result["error"])
        return
    c = result["conditions"]
    b = result["breakdown"]
    print(f"\n  차량:       {c['vehicle']}")
    print(f"  차량가격:   {c['vehicle_price']:,}원")
    print(f"  조건:       {c['term_months']}개월 / 연 {c['annual_mileage_km']:,}km / 선납 {c['prepay_pct']}% / 보증금 {c['deposit_pct']}%")
    print(f"  잔존가치:   {c['residual_pct']}% ({c['residual_amount']:,}원)")
    print(f"  선납금액:   {c['prepay_amount']:,}원")
    print(f"  보증금액:   {c['deposit_amount']:,}원")
    print(f"  ──────────────────────────────────")
    print(f"  베이스 월납:        {b['base_monthly']:>10,}원")
    print(f"  + 선납금 보정:      {b['prepay_adjustment']:>+10,}원")
    print(f"  + 보증금 보정:      {b['deposit_adjustment']:>+10,}원")
    print(f"  ──────────────────────────────────")
    print(f"  ▶ 월 납입료:        {result['monthly_payment']:>10,}원")


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("--term", type=int, default=None, help="계약기간 (24/36/48/60)")
    parser.add_argument("--mileage", type=int, default=None, help="연간 주행거리 km (10000/15000/20000/30000)")
    parser.add_argument("--prepay", type=int, default=0, help="선납금 % (0~30)")
    parser.add_argument("--deposit", type=int, default=0, help="보증금 % (0~30)")
    args = parser.parse_args()

    matrix = load_matrix()

    # 단일 견적 모드
    if args.term:
        result = calculate_quote(matrix, args.term, args.mileage or 10000, args.prepay, args.deposit)
        print_quote(result)
        return

    # 데모 모드 — 여러 시나리오 자동 시연
    print("=" * 70)
    print(f"랜딩 페이지 시뮬레이션 데모 ({matrix['vehicle']['trim_name']})")
    print(f"베이스 데이터: {len(matrix['base_matrix'])}건 × 보간 공식 = 400+ 조합 응답 가능")
    print("=" * 70)

    scenarios = [
        (24, 10000, 0, 0,   "[최단계약 + 최저주행 + 풀납]"),
        (60, 30000, 0, 0,   "[최장계약 + 최대주행 + 풀납]"),
        (48, 10000, 30, 0,  "[표준조건 + 선납 30%]"),
        (48, 10000, 0, 30,  "[표준조건 + 보증금 30%]"),
        (48, 10000, 25, 10, "[표준조건 + 선납 25% + 보증금 10%]"),
        (36, 20000, 15, 5,  "[중간조건 + 선납 15% + 보증금 5%]"),
    ]
    for term, mileage, pp, dp, desc in scenarios:
        print(f"\n[{desc}]")
        result = calculate_quote(matrix, term, mileage, pp, dp)
        print_quote(result)


if __name__ == "__main__":
    main()
