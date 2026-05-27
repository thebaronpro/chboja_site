"""
KB캐피탈 어댑터를 실행해 베이스 견적을 실수집하고 DB에 적재.

전제:
  - playwright 설치 + Chromium 다운로드 완료
  - KB 사이트에 채널 ID(chnlUserId)로 접근 가능한 세션 보유

사용:
  python -m scripts.collect --capital KB --user reekun --vehicles 아반떼,싼타페,팰리세이드

베이스 견적 매트릭스 (차종당 16건):
  계약기간 4종 (24/36/48/60) × 주행거리 4종 (1만/1.5만/2만/3만)
  모두 선납 0% 기준.
"""

import argparse
import asyncio
import json
import os
from datetime import datetime

from playwright.async_api import async_playwright

from adapters import get_adapter
from adapters.base import QuoteCondition, TrimInfo
from core.db import get_conn

TERMS = [24, 36, 48, 60]
MILEAGES = [10000, 15000, 20000, 30000]


async def collect_vehicle(adapter, page, keyword: str) -> dict | None:
    """단일 차량 베이스 견적 수집 (16건)."""
    trims = await adapter.search_trims(page, keyword)
    if not trims:
        print(f"  ! {keyword}: 검색 결과 없음")
        return None

    rep = adapter.select_representative_trim(trims)
    print(f"  대표 트림: {rep.trim_name} ({rep.base_price:,}원)")

    conditions = [
        QuoteCondition(term_months=t, annual_mileage_km=m, prepay_pct=0)
        for t in TERMS for m in MILEAGES
    ]

    quotes = await adapter.get_quotes_batch(page, rep, conditions)

    print(f"  ✓ {len(quotes)}건 수집 완료")
    return {
        "trim": rep,
        "conditions": conditions,
        "quotes": quotes,
    }


async def save_to_db(capital_code: str, vehicle_data: dict) -> None:
    """수집 결과를 DB에 적재 (마스터 + base_quote)."""
    with get_conn() as conn, conn.cursor() as cur:
        cur.execute("SELECT id FROM capital_company WHERE code = %s", (capital_code,))
        capital_id = cur.fetchone()["id"]

        trim = vehicle_data["trim"]
        # 차종 식별 — 트림명에서 브랜드/모델 분리는 단순화
        brand = "현대"  # TODO: 트림명 파싱 또는 어댑터에서 같이 반환
        model_name = trim.trim_name.split(']')[-1].strip().split()[1]
        year_code = trim.trim_name.split(']')[0].lstrip('[')

        cur.execute("""
            INSERT INTO vehicle_model (brand, model_name, year_code)
            VALUES (%s, %s, %s)
            ON CONFLICT (brand, model_name, year_code) DO UPDATE SET active = TRUE
            RETURNING id
        """, (brand, model_name, year_code))
        model_id = cur.fetchone()["id"]

        cur.execute("""
            INSERT INTO trim (model_id, trim_name, engine_cc, drivetrain, base_price, is_representative)
            VALUES (%s, %s, %s, %s, %s, TRUE)
            ON CONFLICT (model_id, trim_name) DO UPDATE
                SET base_price = EXCLUDED.base_price
            RETURNING id
        """, (model_id, trim.trim_name, trim.engine_cc, trim.drivetrain, trim.base_price))
        trim_id = cur.fetchone()["id"]

        for cond, q in zip(vehicle_data["conditions"], vehicle_data["quotes"]):
            cur.execute("""
                INSERT INTO base_quote
                    (capital_id, trim_id, term_months, annual_mileage_km,
                     residual_pct, residual_amount, monthly_base_payment,
                     raw_data)
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s::jsonb)
            """, (capital_id, trim_id, cond.term_months, cond.annual_mileage_km,
                  q.residual_pct, q.residual_amount, q.monthly_payment,
                  json.dumps(q.raw_data, ensure_ascii=False)))


async def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("--capital", required=True, help="캐피탈사 코드 (KB)")
    parser.add_argument("--user", required=True, help="채널 사용자 ID (KB: chnlUserId)")
    parser.add_argument("--vehicles", required=True, help="콤마로 구분된 차량 키워드 리스트")
    parser.add_argument("--save-json", help="DB 적재 대신 JSON 파일로 저장")
    parser.add_argument("--headless", action="store_true", help="헤드리스 모드 (디버깅 시 끔)")
    args = parser.parse_args()

    keywords = [k.strip() for k in args.vehicles.split(",")]
    adapter = get_adapter(args.capital, channel_user_id=args.user)

    async with async_playwright() as pw:
        browser = await pw.chromium.launch(headless=args.headless)
        ctx = await browser.new_context()
        page = await ctx.new_page()
        await adapter.login(page)

        all_results = []
        for kw in keywords:
            print(f"\n[{kw}] 수집 시작...")
            result = await collect_vehicle(adapter, page, kw)
            if result and not args.save_json:
                await save_to_db(args.capital, result)
            if result:
                all_results.append(result)

        await browser.close()

    if args.save_json:
        # JSON 직렬화는 별도 변환 필요 — 생략 (TODO)
        print(f"수집 완료. JSON 저장 옵션은 TODO")

    print(f"\n총 {len(all_results)}개 차량 처리 완료.")


if __name__ == "__main__":
    asyncio.run(main())
