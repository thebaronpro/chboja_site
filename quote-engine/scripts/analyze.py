"""
수집된 베이스 데이터 분석.

- 차종 카테고리별 잔가율 분포 (평균/표준편차)
- 인기/비인기 클러스터링
- 보간 공식 차종군별 튜닝 권장값 출력

사용:
  python -m scripts.analyze sample_data/kb_full_matrix.json
"""

import json
import statistics
import sys
from collections import defaultdict
from pathlib import Path


def analyze(json_path: str):
    data = json.loads(Path(json_path).read_text(encoding='utf-8'))

    print("=" * 90)
    print(f"수집 데이터 분석 — {json_path}")
    print(f"수집일: {data['_metadata']['collected_at']}")
    print("=" * 90)

    # 카테고리별 트림 모으기
    by_category = defaultdict(list)
    for v in data['vehicles']:
        cat = v['category']
        for tr in v['trims']:
            if not tr['base_quotes']: continue
            by_category[cat].append({
                'vehicle_id': v['vehicle_id'],
                'trim_name': tr['trim']['trim_name'],
                'base_price': tr['trim']['base_price'],
                'base_quotes': tr['base_quotes'],
            })

    # 카테고리별 잔가율 분석 (48개월/1만km 기준)
    print(f"\n{'카테고리':25} {'트림수':>6} {'48m/1만 잔가%':>15} {'표준편차':>10}")
    print("-" * 70)
    for cat in sorted(by_category.keys()):
        trims = by_category[cat]
        residuals = []
        for tr in trims:
            for bq in tr['base_quotes']:
                if bq['term_months'] == 48 and bq['annual_mileage_km'] == 10000:
                    residuals.append(bq['residual_pct'])
        if residuals:
            mean = statistics.mean(residuals)
            stdev = statistics.stdev(residuals) if len(residuals) > 1 else 0
            print(f"{cat:25} {len(trims):>6} {mean:>14.1f}% {stdev:>9.2f}")

    # 차종군별 잔가율 변동 패턴 (계약기간/주행거리에 따른)
    print(f"\n\n{'='*90}")
    print("차종군별 잔가율 매트릭스 (평균)")
    print("=" * 90)
    for cat in sorted(by_category.keys()):
        trims = by_category[cat]
        if not trims: continue
        # term × mileage 평균 잔가율
        grid = defaultdict(list)
        for tr in trims:
            for bq in tr['base_quotes']:
                key = (bq['term_months'], bq['annual_mileage_km'])
                grid[key].append(bq['residual_pct'])
        if not grid: continue
        print(f"\n[{cat}] ({len(trims)} 트림)")
        terms = sorted(set(k[0] for k in grid))
        mileages = sorted(set(k[1] for k in grid))
        # 헤더
        header = "   계약   " + "  ".join(f"{m//10000 if m>0 else '무제한':>7}" for m in mileages)
        print(header)
        for t in terms:
            row = f"  {t:>3}개월"
            for m in mileages:
                values = grid.get((t, m), [])
                if values:
                    row += f"  {statistics.mean(values):>6.1f}%"
                else:
                    row += f"  {'-':>7}"
            print(row)

    # 보간 공식 튜닝 권장값
    print(f"\n\n{'='*90}")
    print("보간 공식 — 카테고리별 잔가율 평균값 (formula_params 시드 권장)")
    print("=" * 90)
    print(f"{'카테고리':25} {'평균잔가율 (48m/1만)':>20}  {'권장 interest_rate':>20}")
    for cat in sorted(by_category.keys()):
        trims = by_category[cat]
        residuals = []
        for tr in trims:
            for bq in tr['base_quotes']:
                if bq['term_months'] == 48 and bq['annual_mileage_km'] == 10000:
                    residuals.append(bq['residual_pct'])
        if residuals:
            avg = statistics.mean(residuals)
            # 카테고리별 추정 이자율 (이전 측정값 기반)
            est_rate = {
                'sedan_popular': 0.060,
                'suv_popular': 0.062,
                'suv_compact': 0.064,
                'minivan': 0.063,
                'compact_low': 0.066,
                'ev_imported': 0.071,
                'ev_domestic': 0.068,
                'imported_sedan': 0.065,
            }.get(cat, 0.062)
            print(f"{cat:25} {avg:>19.1f}% {est_rate*100:>19.2f}%")

    # 에러 요약
    errors = [(v['vehicle_id'], v['errors']) for v in data['vehicles'] if v.get('errors')]
    if errors:
        print(f"\n\n{'='*90}")
        print("⚠️  수집 에러 발생 차량")
        print("=" * 90)
        for vid, errs in errors:
            print(f"  {vid}: {errs}")


if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("사용: python -m scripts.analyze <json_path>")
        sys.exit(1)
    analyze(sys.argv[1])
