"""
견적 API 서버 (FastAPI)

엔드포인트:
  GET  /v1/health             — 헬스 체크
  GET  /v1/capitals           — 캐피탈사 목록
  GET  /v1/models             — 차종 목록
  GET  /v1/models/{id}/trims  — 트림 목록
  GET  /v1/quote              — 견적 조회 (핵심)

실행:
  uvicorn api.main:app --reload --host 0.0.0.0 --port 8000
"""

import time
from datetime import datetime, date
from typing import Optional

from fastapi import FastAPI, HTTPException, Query
from fastapi.middleware.cors import CORSMiddleware

from core.db import fetch_one, fetch_all
from core.models import (
    BaseQuote, FormulaParams, Trim, Color,
    QuoteRequest, QuoteResponse,
)
from core.calc import CalcInputs, calculate


app = FastAPI(title="Rent Quote API (PoC)", version="0.1.0")

# 랜딩 페이지에서 호출 — 운영에서는 도메인 제한 필요
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_methods=["GET", "POST"],
    allow_headers=["*"],
)


@app.get("/v1/health")
def health():
    row = fetch_one("SELECT MAX(collected_at) AS last FROM base_quote")
    return {
        "status": "ok",
        "last_collection": str(row["last"]) if row and row["last"] else None,
    }


@app.get("/v1/capitals")
def list_capitals():
    return fetch_all("SELECT id, code, name FROM capital_company WHERE active = TRUE ORDER BY id")


@app.get("/v1/models")
def list_models(brand: Optional[str] = None):
    if brand:
        return fetch_all(
            "SELECT id, brand, model_name, year_code, fuel_type FROM vehicle_model "
            "WHERE brand = %s AND active = TRUE ORDER BY model_name", (brand,))
    return fetch_all(
        "SELECT id, brand, model_name, year_code, fuel_type FROM vehicle_model "
        "WHERE active = TRUE ORDER BY brand, model_name")


@app.get("/v1/models/{model_id}/trims")
def list_trims(model_id: int):
    return fetch_all(
        "SELECT id, trim_name, engine_cc, drivetrain, base_price, is_representative "
        "FROM trim WHERE model_id = %s AND active = TRUE ORDER BY base_price", (model_id,))


@app.get("/v1/trims/{trim_id}/colors")
def list_colors(trim_id: int):
    return fetch_all(
        "SELECT id, color_code, color_name, is_exterior, extra_cost "
        "FROM color WHERE trim_id = %s ORDER BY extra_cost, color_name", (trim_id,))


@app.get("/v1/quote", response_model=QuoteResponse)
def get_quote(
    capital_id: int,
    trim_id: int,
    term: int = Query(..., ge=12, le=60),
    mileage: int = Query(..., description="연간 주행거리 km (-1=무제한)"),
    prepay_pct: int = Query(0, ge=0, le=50),
    deposit_pct: int = Query(0, ge=0, le=50),
    color_id: Optional[int] = None,
):
    start = time.time()
    req = QuoteRequest(
        capital_id=capital_id, trim_id=trim_id, color_id=color_id,
        term=term, mileage=mileage, prepay_pct=prepay_pct, deposit_pct=deposit_pct,
    )

    capital = fetch_one("SELECT name FROM capital_company WHERE id = %s", (capital_id,))
    if not capital:
        raise HTTPException(404, "capital_id not found")

    target_trim_row = fetch_one("SELECT * FROM trim WHERE id = %s", (trim_id,))
    if not target_trim_row:
        raise HTTPException(404, "trim_id not found")
    target_trim = Trim(**{k: target_trim_row[k] for k in target_trim_row if k in Trim.model_fields})

    rep_row = fetch_one("""
        SELECT * FROM trim WHERE model_id = %s AND is_representative = TRUE LIMIT 1
    """, (target_trim_row["model_id"],))
    if not rep_row:
        rep_row = target_trim_row
    rep_trim = Trim(**{k: rep_row[k] for k in rep_row if k in Trim.model_fields})

    base_row = fetch_one("""
        SELECT * FROM base_quote
        WHERE capital_id = %s AND trim_id = %s
          AND term_months = %s AND annual_mileage_km = %s
        ORDER BY collected_at DESC LIMIT 1
    """, (capital_id, rep_row["id"], term, mileage))
    if not base_row:
        raise HTTPException(404, f"베이스 견적 없음 (term={term}, mileage={mileage})")
    base = BaseQuote(**{k: base_row[k] for k in base_row if k in BaseQuote.model_fields})

    fp_row = fetch_one("""
        SELECT * FROM formula_params WHERE capital_id = %s
        ORDER BY effective_from DESC LIMIT 1
    """, (capital_id,))
    if not fp_row:
        raise HTTPException(500, "formula_params 없음")
    formula = FormulaParams(**{k: fp_row[k] for k in fp_row if k in FormulaParams.model_fields})

    color = None
    if color_id:
        c_row = fetch_one("SELECT * FROM color WHERE id = %s", (color_id,))
        if c_row:
            color = Color(**{k: c_row[k] for k in c_row if k in Color.model_fields})

    result = calculate(CalcInputs(
        base=base, representative_trim=rep_trim, target_trim=target_trim,
        color=color, formula=formula, request=req,
    ))
    result.conditions.capital = capital["name"]
    elapsed_ms = int((time.time() - start) * 1000)
    result.meta.response_ms = elapsed_ms
    if base.collected_at:
        freshness = (datetime.now() - base.collected_at).days
        result.meta.data_freshness_days = freshness
    return result
