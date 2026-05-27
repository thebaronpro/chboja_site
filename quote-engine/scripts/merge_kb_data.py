"""
KB 수집 결과 JSON → kb_collected.json 자동 머지

사용:
  # 새 차량 수집 후
  python -m scripts.merge_kb_data --input collected_2026-06-01.json
  → kb_collected.json 업데이트 + kb_trim_map.json 자동 갱신

  # 또는 직접 trim 1개 추가
  python -m scripts.merge_kb_data --add-trim trim_data.json

머지 규칙:
- trim_key가 같으면 새 데이터로 base_quotes 머지 (중복 조건 덮어쓰기, 신규는 추가)
- completeness 자동 계산 (25건 채워지면 'full', 아니면 'partial')
"""

import argparse
import json
import sys
from datetime import date
from pathlib import Path


SAMPLE_DATA_DIR = Path(__file__).resolve().parent.parent / "sample_data"
COLLECTED_PATH = SAMPLE_DATA_DIR / "kb_collected.json"
TRIM_MAP_PATH = SAMPLE_DATA_DIR / "kb_trim_map.json"


def make_trim_key(year_code: str, brand: str, model_short: str, trim_short: str) -> str:
    return f"{year_code}|{brand}|{model_short}|{trim_short}"


def load_collected() -> dict:
    if not COLLECTED_PATH.exists():
        return {
            "_metadata": {
                "version": "v1",
                "last_updated": str(date.today()),
                "description": "KB 수집 데이터 누적 파일 (auto-managed)",
            },
            "trims": [],
        }
    return json.loads(COLLECTED_PATH.read_text(encoding="utf-8"))


def save_collected(data: dict):
    data["_metadata"]["last_updated"] = str(date.today())
    COLLECTED_PATH.write_text(
        json.dumps(data, ensure_ascii=False, indent=2),
        encoding="utf-8",
    )
    print(f"✓ {COLLECTED_PATH.name} 업데이트 ({len(data['trims'])} 트림)")


def rebuild_trim_map(collected: dict):
    """kb_collected → kb_trim_map.json 자동 생성"""
    mappings = []
    for t in collected["trims"]:
        keys = t.get("danawa_match_keywords", {})
        if not keys:
            continue
        m = {
            "danawa_keys": {
                "brand": t["brand"],
                "model_keyword": t["model_name"].split()[-1] if t["model_name"] else "",
                **keys,
            },
            "kb": {
                "trim_name": t["kb_full_trim_name"],
                "base_price": t["base_price"],
                "year_code": t["year_code"],
            },
        }
        mappings.append(m)

    TRIM_MAP_PATH.write_text(
        json.dumps({
            "_metadata": {
                "version": "v2 (auto-generated from kb_collected.json)",
                "generated_at": str(date.today()),
                "mapping_count": len(mappings),
            },
            "mappings": mappings,
        }, ensure_ascii=False, indent=2),
        encoding="utf-8",
    )
    print(f"✓ {TRIM_MAP_PATH.name} 재생성 ({len(mappings)} 매핑)")


def merge_trim(collected: dict, new_trim: dict):
    """단일 trim을 collected에 머지 (trim_key 기준 덮어쓰기 + base_quotes 합치기)"""
    key = new_trim["trim_key"]
    existing = next((t for t in collected["trims"] if t["trim_key"] == key), None)

    if existing is None:
        collected["trims"].append(new_trim)
        print(f"  + 신규 트림: {key}")
        return

    # 기존 trim — base_quotes를 (term, mileage) 기준으로 머지
    existing_keys = {(q["term_months"], q["annual_mileage_km"]) for q in existing.get("base_quotes", [])}
    added = 0
    for nq in new_trim.get("base_quotes", []):
        k = (nq["term_months"], nq["annual_mileage_km"])
        if k in existing_keys:
            # 덮어쓰기
            existing["base_quotes"] = [
                nq if (q["term_months"], q["annual_mileage_km"]) == k else q
                for q in existing["base_quotes"]
            ]
        else:
            existing["base_quotes"].append(nq)
            added += 1

    # completeness 재계산
    n = len(existing["base_quotes"])
    if n >= 20:
        existing["completeness"] = "full"
    elif n >= 5:
        existing["completeness"] = "partial"
    else:
        existing["completeness"] = "mapping_only" if n == 0 else "partial"

    # 기타 메타 업데이트 (가격 등)
    for k_field in ("base_price", "category", "kb_full_trim_name"):
        if k_field in new_trim:
            existing[k_field] = new_trim[k_field]
    existing["collected_at"] = str(date.today())

    print(f"  ~ 머지: {key} (+{added}건, 총 {n}건, {existing['completeness']})")


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("--input", help="kb_capital_full.py 출력 JSON 또는 단일 trim JSON")
    parser.add_argument("--add-trim", help="단일 trim JSON 파일 추가")
    parser.add_argument("--rebuild-map", action="store_true", help="trim_map만 재생성")
    args = parser.parse_args()

    collected = load_collected()

    if args.input:
        data = json.loads(Path(args.input).read_text(encoding="utf-8"))
        # kb_capital_full.py 출력 형태: { vehicles: [{trims: [...]}] }
        if "vehicles" in data:
            for v in data["vehicles"]:
                for tr in v.get("trims", []):
                    # 정규화 — trim_key 필수
                    trim_obj = normalize_trim(v, tr)
                    if trim_obj:
                        merge_trim(collected, trim_obj)
        else:
            # 단일 trim 형태
            merge_trim(collected, data)
        save_collected(collected)

    if args.add_trim:
        data = json.loads(Path(args.add_trim).read_text(encoding="utf-8"))
        merge_trim(collected, data)
        save_collected(collected)

    rebuild_trim_map(collected)


def normalize_trim(vehicle: dict, trim_payload: dict) -> dict | None:
    """kb_capital_full.py 출력의 trim 객체 → kb_collected 표준 형태로 변환"""
    trim = trim_payload.get("trim", {})
    if not trim.get("trim_name"):
        return None
    full_name = trim["trim_name"]
    year_match = full_name.split(']')[0].lstrip('[') if ']' in full_name else "??MY"
    return {
        "trim_key": f"{year_match}|{vehicle.get('brand', '?')}|{vehicle.get('keyword', '?')}|{trim.get('trim_name', '')[:30]}",
        "brand": vehicle.get("brand", ""),
        "model_name": vehicle.get("keyword", ""),
        "year_code": year_match,
        "trim_name": trim.get("trim_name", ""),
        "kb_full_trim_name": full_name,
        "engine_cc": trim.get("engine_cc"),
        "drivetrain": trim.get("drivetrain"),
        "base_price": trim.get("base_price"),
        "product_code": "5020000002" if trim.get("is_imported") else "5010000003",
        "category": "",  # 별도 classify 단계에서 채워짐
        "base_quotes": [
            {
                "term_months": q["term_months"],
                "annual_mileage_km": q["annual_mileage_km"],
                "residual_pct": q.get("residual_pct"),
                "residual_amount": q.get("residual_amount"),
                "monthly_base_payment": q.get("monthly_payment"),
            }
            for q in trim_payload.get("base_quotes", [])
        ],
        "collected_at": str(date.today()),
    }


if __name__ == "__main__":
    main()
