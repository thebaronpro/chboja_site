"""
sample_data/kb_baseline_20260526.json을 DB에 적재.

사용:
  python -m scripts.load_sample sample_data/kb_baseline_20260526.json

전제: schema.sql 적용 완료 및 .env의 DB 접속 정보 설정 완료.
"""

import json
import sys
from pathlib import Path

from core.db import get_conn


def load(json_path: str) -> None:
    path = Path(json_path)
    with path.open(encoding="utf-8") as f:
        data = json.load(f)

    meta = data["_metadata"]
    vehicles = data["vehicles"]

    with get_conn() as conn, conn.cursor() as cur:
        # 캐피탈사 id
        cur.execute("SELECT id FROM capital_company WHERE code = %s", (meta["capital_code"],))
        cap = cur.fetchone()
        if not cap:
            raise RuntimeError(f"capital_company에 {meta['capital_code']} 없음 — schema.sql 시드 확인")
        capital_id = cap["id"]

        for v in vehicles:
            # vehicle_model upsert
            cur.execute("""
                INSERT INTO vehicle_model (brand, model_name, year_code, fuel_type)
                VALUES (%s, %s, %s, %s)
                ON CONFLICT (brand, model_name, year_code) DO UPDATE
                  SET fuel_type = EXCLUDED.fuel_type
                RETURNING id
            """, (v["brand"], v["model_name"], v["year_code"], v.get("fuel_type")))
            model_id = cur.fetchone()["id"]

            # trim upsert
            cur.execute("""
                INSERT INTO trim (model_id, trim_name, engine_cc, drivetrain, base_price, is_representative)
                VALUES (%s, %s, %s, %s, %s, %s)
                ON CONFLICT (model_id, trim_name) DO UPDATE
                  SET base_price = EXCLUDED.base_price,
                      is_representative = EXCLUDED.is_representative
                RETURNING id
            """, (model_id, v["trim_name"], v.get("engine_cc"), v.get("drivetrain"),
                  v["base_price"], v.get("is_representative", False)))
            trim_id = cur.fetchone()["id"]

            # base_quote INSERT (덮어쓰기 없음 — 매번 새 row)
            for bq in v["base_quotes"]:
                cur.execute("""
                    INSERT INTO base_quote
                        (capital_id, trim_id, term_months, annual_mileage_km,
                         residual_pct, residual_amount, monthly_base_payment,
                         source_quote_no, raw_data, collected_at)
                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s::jsonb, %s::timestamp)
                    ON CONFLICT DO NOTHING
                """, (capital_id, trim_id, bq["term_months"], bq["annual_mileage_km"],
                      bq["residual_pct"], bq["residual_amount"], bq["monthly_base_payment"],
                      bq.get("source_quote_no"), json.dumps(bq, ensure_ascii=False),
                      meta["collected_at"]))

            print(f"✓ {v['brand']} {v['model_name']} ({v['year_code']}) — {len(v['base_quotes'])}건 적재")

    print(f"\n총 {len(vehicles)}개 차량 적재 완료.")


if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("사용: python -m scripts.load_sample <json_path>")
        sys.exit(1)
    load(sys.argv[1])
