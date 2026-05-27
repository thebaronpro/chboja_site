"""
보간 공식 정확도 검증.

sample_data/*.json의 validation_samples를 사용해
  - DB에 적재된 베이스 견적 + 보간 공식
  - JSON의 site_monthly_payment (실측값)
오차율을 계산하여 출력. 1% 초과 시 비정상으로 표시.

사용:
  python -m scripts.validate sample_data/kb_baseline_20260526.json
"""

import json
import sys
from pathlib import Path

from core.db import get_conn, fetch_one
from core.models import BaseQuote, FormulaParams, Trim, QuoteRequest
from core.calc import CalcInputs, calculate


def load_formula_params(capital_id: int) -> FormulaParams:
    row = fetch_one("""
        SELECT * FROM formula_params
        WHERE capital_id = %s
          AND CURRENT_DATE BETWEEN effective_from AND COALESCE(effective_to, CURRENT_DATE)
        ORDER BY effective_from DESC LIMIT 1
    """, (capital_id,))
    if not row:
        raise RuntimeError(f"formula_params 없음 (capital_id={capital_id})")
    return FormulaParams(**{k: row[k] for k in ("capital_id", "interest_rate", "deposit_factor", "prepay_factor", "effective_from")})


def lookup_base_quote(capital_id: int, trim_id: int, term: int, mileage: int) -> BaseQuote:
    row = fetch_one("""
        SELECT * FROM base_quote
        WHERE capital_id = %s AND trim_id = %s
          AND term_months = %s AND annual_mileage_km = %s
        ORDER BY collected_at DESC LIMIT 1
    """, (capital_id, trim_id, term, mileage))
    if not row:
        raise RuntimeError(f"base_quote 없음 (trim={trim_id}, term={term}, mileage={mileage})")
    return BaseQuote(**{k: row[k] for k in row if k in BaseQuote.model_fields})


def lookup_trim(brand: str, model_name: str, year_code: str) -> tuple[int, Trim]:
    row = fetch_one("""
        SELECT t.* FROM trim t
        JOIN vehicle_model m ON m.id = t.model_id
        WHERE m.brand = %s AND m.model_name = %s AND m.year_code = %s
          AND t.is_representative = TRUE
        LIMIT 1
    """, (brand, model_name, year_code))
    if not row:
        raise RuntimeError(f"대표 트림 없음 ({brand} {model_name} {year_code})")
    trim = Trim(**{k: row[k] for k in row if k in Trim.model_fields})
    return row["id"], trim


def validate(json_path: str) -> None:
    with open(json_path, encoding="utf-8") as f:
        data = json.load(f)

    meta = data["_metadata"]
    capital_code = meta["capital_code"]

    capital_row = fetch_one("SELECT id, name FROM capital_company WHERE code = %s", (capital_code,))
    capital_id = capital_row["id"]
    capital_name = capital_row["name"]

    formula = load_formula_params(capital_id)
    print(f"\n검증 대상: {capital_name}")
    print(f"이자율: {formula.interest_rate*100:.3f}%")
    print(f"검증일: {meta['collected_at']}\n")

    print("=" * 100)
    print(f"{'차량':30} {'조건':30} {'실측':>10} {'계산':>10} {'오차':>10} {'결과':>6}")
    print("=" * 100)

    total = 0
    over_1pct = 0
    for v in data["vehicles"]:
        samples = v.get("validation_samples", [])
        if not samples:
            continue
        trim_id, trim = lookup_trim(v["brand"], v["model_name"], v["year_code"])

        for s in samples:
            base = lookup_base_quote(capital_id, trim_id, s["term_months"], s["annual_mileage_km"])
            req = QuoteRequest(
                capital_id=capital_id, trim_id=trim_id, color_id=None,
                term=s["term_months"], mileage=s["annual_mileage_km"],
                prepay_pct=s["prepay_pct"], deposit_pct=0,
            )
            inputs = CalcInputs(
                base=base, representative_trim=trim, target_trim=trim,
                color=None, formula=formula, request=req,
            )
            result = calculate(inputs)
            site = s["site_monthly_payment"]
            calc = result.monthly_payment
            err = (calc - site) / site * 100
            mark = "OK" if abs(err) < 1.0 else "WARN"
            if abs(err) >= 1.0:
                over_1pct += 1
            total += 1
            cond_str = f"{s['term_months']}개월/{s['annual_mileage_km']//10000}만km/선납{s['prepay_pct']}%"
            print(f"{v['model_name']:30} {cond_str:30} {site:>10,} {calc:>10,} {err:>9.3f}% {mark:>6}")

    print("=" * 100)
    print(f"\n총 {total}건 / 오차 1% 초과: {over_1pct}건 ({over_1pct/total*100:.1f}%)" if total else "검증 샘플 없음")
    if over_1pct == 0:
        print("✓ 모든 검증 통과 (오차 1% 이내)")
    else:
        print(f"⚠  {over_1pct}건 오차 임계값 초과 — formula_params 재튜닝 필요")
        sys.exit(1)


if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("사용: python -m scripts.validate <sample_json_path>")
        sys.exit(1)
    validate(sys.argv[1])
