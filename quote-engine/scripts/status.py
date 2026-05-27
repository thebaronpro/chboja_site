"""
KB 수집 현황 대시보드 (터미널 출력).

사용:
  python -m scripts.status
"""

import json
import yaml
from collections import defaultdict
from pathlib import Path


BASE = Path(__file__).resolve().parent.parent
COLLECTED = BASE / "sample_data" / "kb_collected.json"
PRIORITY = BASE / "config" / "priority_vehicles.yaml"


def main():
    collected = json.loads(COLLECTED.read_text(encoding="utf-8"))
    priority = yaml.safe_load(PRIORITY.read_text(encoding="utf-8"))

    trims = collected["trims"]
    print("=" * 80)
    print(f"KB 수집 현황 (마지막 업데이트: {collected['_metadata']['last_updated']})")
    print("=" * 80)

    # 완성도별 통계
    completeness = defaultdict(int)
    total_quotes = 0
    for t in trims:
        completeness[t.get("completeness", "?")] += 1
        total_quotes += len(t.get("base_quotes", []))

    print(f"\n총 트림 수: {len(trims)}")
    print(f"총 견적 데이터 수: {total_quotes}")
    print(f"  - full      (25/25): {completeness['full']:>3}개")
    print(f"  - partial   (1~24):  {completeness['partial']:>3}개")
    print(f"  - mapping_only:      {completeness['mapping_only']:>3}개")

    # 카테고리별
    print(f"\n[카테고리 분포]")
    by_cat = defaultdict(list)
    for t in trims:
        by_cat[t.get("category", "?")].append(t)
    for cat, items in sorted(by_cat.items()):
        print(f"  {cat:25}: {len(items):>2}개")

    # 우선순위 진행도
    print(f"\n[우선순위 진행도]")
    by_status = defaultdict(list)
    for v in priority["vehicles"]:
        by_status[v.get("status", "pending")].append(v)
    for status, vs in by_status.items():
        print(f"  {status:15}: {len(vs):>2}개 — {', '.join(v['id'] for v in vs[:6])}{'...' if len(vs)>6 else ''}")

    # 다음 수집 추천 (P0 → P1 → ... 순서 + status=pending 우선)
    print(f"\n[다음 수집 추천 (top 5)]")
    pending = sorted(
        [v for v in priority["vehicles"] if v.get("status") in ("pending", "partial")],
        key=lambda v: (v.get("priority", "P9"), v.get("status") != "pending"),
    )
    for v in pending[:5]:
        cmd = f"python -m adapters.kb_capital_full --user reekun --vehicles {v['id']} --output collected_{v['id']}.json"
        print(f"  {v['priority']} {v['id']:12} ({v['keyword']:10}) — {v.get('status')}")
        print(f"    실행: {cmd}")

    # 정확도 추정
    full_count = completeness["full"]
    partial_count = completeness["partial"]
    print(f"\n[정확도 추정]")
    print(f"  완전 측정 트림 (오차 ~0%):      {full_count}개 — 모든 조건 정확")
    print(f"  부분 측정 트림 (측정조건만 정확): {partial_count}개")
    print(f"  매핑 없는 트림 (오차 ~5~10%):   ~{2933 - len(trims):,}개 (다나와 fallback + 카테고리 추정)")

    print()
    print("매번 수집 후 다음 명령으로 자동 머지:")
    print("  python -m scripts.merge_kb_data --input collected_*.json")


if __name__ == "__main__":
    main()
