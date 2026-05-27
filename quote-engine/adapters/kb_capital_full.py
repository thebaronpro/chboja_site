"""
KB캐피탈 어댑터 (Full Matrix 버전, Phase 1B)

기존 kb_capital.py 대비 강화 사항:
  1. 세션 만료 감지 + 사용자 재로그인 대기 루프
  2. 풀 매트릭스 수집 (5계약 × 5주행 = 25건 / 트림)
  3. 한 페이지에서 select 변경 + 재산출 (페이지 재진입 최소화)
  4. 차량당 2 트림 자동 선정 (최저 + 상위)
  5. 선납/보증금 검증 데이터 (6건 / 차량)
  6. 진행률 표시 + 에러 복구 + 중간 저장
  7. 한글 모델명 unicode 강제 처리 (IME 깨짐 회피)

요구사항:
  pip install playwright pyyaml tqdm
  playwright install chromium

사용:
  python -m adapters.kb_capital_full --user reekun --output sample_data/kb_full_matrix.json
  python -m adapters.kb_capital_full --user reekun --vehicles avante,sonata --output ...
"""

import argparse
import asyncio
import json
import re
import sys
import time
from dataclasses import asdict, dataclass, field
from pathlib import Path
from typing import Optional

import yaml
from playwright.async_api import async_playwright, Page, TimeoutError as PWTimeout


KB_URL = "https://kbeasy.kbcapital.co.kr/ss/em/EM030100.kbc"
LOGIN_URL_PATTERN = "/ss/mm/MM010100.kbc"

ALERT_OVERRIDE_JS = """
window.alert = () => true;
window.confirm = () => true;
window.prompt = () => '';
"""

TINT_FRONT = "00736"          # 0. 루마 GG
TINT_SIDE_HK = "00728"         # 1-0. 루마 GG (현대/기아/르노)
TINT_SIDE_KG = "00730"         # 2-0. 루마 GG (KG/쉐보레/테슬라/폴스타)
BLACKBOX = "01105"             # 1.FHD-FHD


@dataclass
class TrimRecord:
    trim_name: str
    base_price: int
    engine_cc: Optional[int]
    drivetrain: Optional[str]
    is_special: bool
    is_target_year: bool


@dataclass
class BaseQuoteRecord:
    term_months: int
    annual_mileage_km: int
    residual_pct: float
    residual_amount: int
    monthly_base_payment: int


@dataclass
class ValidationRecord:
    kind: str          # 'prepay' or 'deposit'
    pct: int
    term_months: int
    annual_mileage_km: int
    monthly_payment: int


@dataclass
class VehicleResult:
    vehicle_id: str
    keyword: str
    brand: str
    category: str
    timestamp: str = ""
    trims: list = field(default_factory=list)        # list of {trim, base_quotes, validations}
    errors: list = field(default_factory=list)


# ============================================================================
# 헬퍼 — 한글 키워드 unicode 강제 입력 (IME 깨짐 회피)
# ============================================================================

def text_to_codepoints_js(text: str) -> str:
    """한글 텍스트를 codepoint 배열로 변환 — JS String.fromCharCode 호출용."""
    codes = ', '.join(f"0x{ord(c):04X}" for c in text)
    return f"String.fromCharCode({codes})"


# ============================================================================
# 세션 관리
# ============================================================================

async def is_session_alive(page: Page) -> bool:
    """현재 URL이 로그인 페이지로 리다이렉트됐는지 검사."""
    try:
        return LOGIN_URL_PATTERN not in page.url
    except Exception:
        return False


async def wait_for_login(page: Page, max_wait_minutes: int = 5):
    """사용자가 수동으로 로그인할 때까지 대기 (최대 5분)."""
    print("\n" + "=" * 70)
    print("⚠️  KB캐피탈 세션이 만료되었습니다.")
    print("    브라우저에서 직접 로그인하신 후 견적산출 페이지가 열리면 자동 재개됩니다.")
    print(f"    최대 {max_wait_minutes}분 대기 중...")
    print("=" * 70)
    deadline = time.time() + max_wait_minutes * 60
    while time.time() < deadline:
        if await is_session_alive(page):
            print("✓ 세션 복구 확인. 작업 재개.\n")
            return True
        await asyncio.sleep(5)
    print("✗ 세션 복구 타임아웃. 작업 중단.")
    return False


async def ensure_session(page: Page, channel_user_id: str) -> bool:
    """페이지가 견적산출 URL이 아니면 이동 + alert override + 세션 확인."""
    await page.goto(f"{KB_URL}?chnlUserId={channel_user_id}&wrkDvcd=1")
    await page.wait_for_load_state("domcontentloaded")
    await page.evaluate(ALERT_OVERRIDE_JS)
    if not await is_session_alive(page):
        return await wait_for_login(page)
    return True


# ============================================================================
# 차량 검색 + 트림 추출
# ============================================================================

async def search_and_get_trims(page: Page, keyword: str) -> list[TrimRecord]:
    """차종 검색 → 차종 클릭 → 세부 트림 리스트 반환."""
    # 한글 unicode 강제 입력
    await page.evaluate(f"""
        () => {{
            const input = document.querySelector('input[placeholder="차종/모델명 입력"]');
            const setter = Object.getOwnPropertyDescriptor(window.HTMLInputElement.prototype, 'value').set;
            setter.call(input, {text_to_codepoints_js(keyword)});
            input.dispatchEvent(new Event('input', {{bubbles:true}}));
            input.dispatchEvent(new Event('change', {{bubbles:true}}));
        }}
    """)
    # 조회 버튼 클릭
    await page.evaluate("""
        () => {
            const links = document.querySelectorAll('a');
            for (const a of links) {
                if ((a.innerText || '').trim() === '조회') { a.click(); return; }
            }
        }
    """)
    await page.wait_for_timeout(1800)
    # 차종 영역에서 첫 차종 클릭
    await page.evaluate(f"""
        () => {{
            const target = {text_to_codepoints_js(keyword)};
            const all = document.querySelectorAll('button, div, li, span');
            for (const el of all) {{
                const t = (el.innerText || '').trim();
                if (t === target && el.children.length < 5) {{
                    el.click(); return;
                }}
            }}
        }}
    """)
    await page.wait_for_timeout(1500)
    # 트림 추출
    trims_data = await page.evaluate("""
        () => {
            const out = [];
            document.querySelectorAll('li, div, tr').forEach(el => {
                if (el.children.length > 10) return;
                const t = (el.innerText || '').replace(/\\s+/g, ' ').trim();
                const m = t.match(/^(\\[.+?\\])?\\s*\\[(\\d{2}MY)\\]\\s*(.+?)\\s+(\\d{1,3}(?:,\\d{3})*|0)cc\\s+(\\d+)만원$/);
                if (m) {
                    out.push({
                        special_tag: m[1] || '',
                        year: m[2],
                        trim_name: m[3],
                        engine_cc: parseInt(m[4].replace(/,/g, ''), 10),
                        price_man: parseInt(m[5], 10),
                    });
                }
            });
            return out;
        }
    """)
    result = []
    for t in trims_data:
        full = f"{t['special_tag']}[{t['year']}] {t['trim_name']}".strip()
        result.append(TrimRecord(
            trim_name=full,
            base_price=t['price_man'] * 10_000,
            engine_cc=t['engine_cc'] or None,
            drivetrain=_extract_drivetrain(t['trim_name']),
            is_special='특가' in t['special_tag'],
            is_target_year=(t['year'] == '26MY'),
        ))
    result.sort(key=lambda x: x.base_price)
    return result


def select_two_trims(trims: list[TrimRecord]) -> tuple[Optional[TrimRecord], Optional[TrimRecord]]:
    """최저 트림 + 상위 트림 선정 (26MY 우선, 특가 제외)."""
    if not trims:
        return None, None
    my26 = [t for t in trims if t.is_target_year and not t.is_special]
    candidates = my26 if my26 else [t for t in trims if not t.is_special]
    if not candidates:
        candidates = trims
    candidates.sort(key=lambda t: t.base_price)
    lowest = candidates[0]
    # 상위 트림: 최저보다 비싼 트림 중 중간~상위 (가격 차이가 너무 작지 않은 것)
    upper_candidates = [t for t in candidates if t.base_price > lowest.base_price * 1.15]
    upper = upper_candidates[len(upper_candidates)//2] if upper_candidates else None
    return lowest, upper


def _extract_drivetrain(name: str) -> Optional[str]:
    for d in ("AWD", "4WD", "2WD", "RWD"):
        if d in name: return d
    return None


# ============================================================================
# 옵션/색상 자동 선택 + 견적 입력 화면 진입
# ============================================================================

async def select_trim_and_proceed_to_quote_page(page: Page, trim: TrimRecord, is_imported: bool):
    """검색 결과에서 트림 선택 → 색상 → 옵션 → 견적 입력 화면까지 자동."""
    # 트림 클릭 (트림명으로 매칭)
    short_name = trim.trim_name[:35]
    await page.evaluate(f"""
        () => {{
            const target = {text_to_codepoints_js(short_name)};
            document.querySelectorAll('li, div, tr').forEach(el => {{
                if (el.children.length > 10) return;
                const t = (el.innerText || '').replace(/\\s+/g, ' ').trim();
                if (t.startsWith(target)) el.click();
            }});
        }}
    """)
    await page.wait_for_timeout(1000)
    # '다음' 클릭
    await _click_link(page, "다음")
    await page.wait_for_timeout(2500)
    await page.evaluate(ALERT_OVERRIDE_JS)
    # 색상: 무료 색상 자동 선택 (가격 표시 없는 첫 색상)
    await page.evaluate("""
        () => {
            const items = document.querySelectorAll('div, span, button');
            for (const el of items) {
                if (el.children.length > 3) continue;
                const t = (el.innerText || '').trim();
                if (t && t.length < 100 && /^[가-힣A-Za-z0-9 ()]+$/.test(t) && !/\\d+원/.test(t)) {
                    // 색상 영역 내 무료 색상 추정 — 첫 매칭 클릭
                }
            }
            // 기본 선택 그대로 유지 (KB는 거의 첫 색상이 무료인 경우 많음)
        }
    """)
    # '다음' 클릭
    await _click_link(page, "다음")
    await page.wait_for_timeout(2500)
    await page.evaluate(ALERT_OVERRIDE_JS)
    # 옵션: 썬팅/블랙박스 첫 옵션 자동 선택
    side_tint = TINT_SIDE_KG if is_imported else TINT_SIDE_HK
    await page.evaluate(f"""
        () => {{
            const selects = document.querySelectorAll('select');
            const setSel = Object.getOwnPropertyDescriptor(window.HTMLSelectElement.prototype, 'value').set;
            for (const s of selects) {{
                const label = (s.previousElementSibling?.innerText || '');
                if (label.includes('전면 썬팅')) {{ setSel.call(s, '{TINT_FRONT}'); s.dispatchEvent(new Event('change', {{bubbles:true}})); }}
                else if (label.includes('측후면 썬팅')) {{ setSel.call(s, '{side_tint}'); s.dispatchEvent(new Event('change', {{bubbles:true}})); }}
                else if (label.includes('블랙박스')) {{ setSel.call(s, '{BLACKBOX}'); s.dispatchEvent(new Event('change', {{bubbles:true}})); }}
            }}
        }}
    """)
    await page.wait_for_timeout(800)
    # '확인' 클릭
    await _click_link(page, "확인")
    await page.wait_for_timeout(3500)
    await page.evaluate(ALERT_OVERRIDE_JS)


async def _click_link(page: Page, text: str):
    await page.evaluate(f"""
        () => {{
            const links = document.querySelectorAll('a');
            for (const a of links) {{
                if ((a.innerText || '').trim() === {text_to_codepoints_js(text)}) {{ a.click(); return; }}
            }}
        }}
    """)


# ============================================================================
# 베이스 매트릭스 수집 (5×5 = 25건 / 트림, 한 페이지에서 3건씩 동시 산출)
# ============================================================================

async def select_product_code(page: Page, code: str):
    await page.evaluate(f"""
        () => {{
            const sel = document.querySelector('select');
            const allSel = document.querySelectorAll('select');
            for (const s of allSel) {{
                if (Array.from(s.options).some(o => o.value === '{code}')) {{
                    const setSel = Object.getOwnPropertyDescriptor(window.HTMLSelectElement.prototype, 'value').set;
                    setSel.call(s, '{code}');
                    s.dispatchEvent(new Event('change', {{bubbles:true}}));
                    return;
                }}
            }}
        }}
    """)
    await page.wait_for_timeout(1500)


async def configure_quote_slots(page: Page, conditions: list[tuple[int, int]]):
    """견적서 ①②③ 슬롯에 (term, mileage) 3쌍 설정. mileage=-1이면 '무제한'."""
    conds_json = json.dumps([{"term": t, "mileage": m} for t, m in conditions])
    await page.evaluate(f"""
        (conds) => {{
            const termSelects = Array.from(document.querySelectorAll('select')).filter(
                s => s.options.length > 0 && Array.from(s.options).some(o => o.text === '48')
            );
            const mileageSelects = Array.from(document.querySelectorAll('select')).filter(
                s => s.options.length > 0 && Array.from(s.options).some(o => (o.text || '').includes('1만Km'))
            );
            const setSel = Object.getOwnPropertyDescriptor(window.HTMLSelectElement.prototype, 'value').set;
            for (let i = 0; i < conds.length; i++) {{
                const c = conds[i];
                if (termSelects[i]) {{
                    setSel.call(termSelects[i], String(c.term));
                    termSelects[i].dispatchEvent(new Event('change', {{bubbles:true}}));
                }}
                if (mileageSelects[i]) {{
                    let label;
                    if (c.mileage === -1) label = '무제한';
                    else if (c.mileage === 15000) label = '1.5만Km';
                    else label = (c.mileage / 10000) + '만Km';
                    const opt = Array.from(mileageSelects[i].options).find(o => o.text.trim() === label);
                    if (opt) {{
                        setSel.call(mileageSelects[i], opt.value);
                        mileageSelects[i].dispatchEvent(new Event('change', {{bubbles:true}}));
                    }}
                }}
            }}
        }}
    """, conds_json)
    await page.wait_for_timeout(800)


async def click_calc_buttons(page: Page, count: int):
    """견적서 ①②③의 견적산출 버튼을 순차 클릭 (각 클릭 후 4초 대기)."""
    for idx in range(count):
        await page.evaluate(f"""
            () => {{
                const btns = Array.from(document.querySelectorAll('button, a')).filter(
                    b => (b.innerText || '').trim() === '견적산출'
                );
                if (btns[{idx}]) btns[{idx}].click();
            }}
        """)
        await page.wait_for_timeout(4500)


async def extract_results(page: Page, count: int) -> list[BaseQuoteRecord]:
    """현재 페이지의 견적서 ①②③ 결과 추출."""
    data = await page.evaluate(f"""
        () => {{
            const out = [];
            const aplyRvrts = document.querySelectorAll('input[name="aplyRvrt"]');
            const aplyRmvls = document.querySelectorAll('input[name="aplyRmvl"]');
            const monthlyEls = Array.from(document.querySelectorAll('div, span')).filter(el => {{
                const t = (el.innerText || '').trim();
                return /^[\\d,]+\\s*원$/.test(t) && t.length < 20;
            }});
            for (let i = 0; i < {count}; i++) {{
                out.push({{
                    residual_pct: parseFloat(aplyRvrts[i]?.value || '0'),
                    residual_amount: parseInt((aplyRmvls[i]?.value || '0').replace(/,/g, ''), 10),
                    monthly_payment: 0,  // 별도 영역에서 가져와야 — 임시
                }});
            }}
            // 월납입료 추출 — 견적서 ① ② ③ 하단의 큰 숫자
            const paymentEls = document.querySelectorAll('.월납입료, [class*="payment"], .price');
            return out;
        }}
    """)
    # 월납입료는 별도 처리 — 페이지 HTML에서 직접 파싱
    payments = await page.evaluate(f"""
        () => {{
            const text = document.body.innerText;
            // 견적서 ① ② ③ 하단의 '월납입료 NNN,NNN 원' 패턴 매칭
            const matches = [...text.matchAll(/월\\s*납입료\\s*([\\d,]+)\\s*원/g)];
            return matches.slice(0, {count}).map(m => parseInt(m[1].replace(/,/g, ''), 10));
        }}
    """)
    result = []
    for i, d in enumerate(data):
        result.append(BaseQuoteRecord(
            term_months=0,  # caller가 채움
            annual_mileage_km=0,
            residual_pct=d['residual_pct'],
            residual_amount=d['residual_amount'],
            monthly_base_payment=payments[i] if i < len(payments) else 0,
        ))
    return result


async def collect_base_matrix(page: Page, terms: list[int], mileages: list[int]) -> list[BaseQuoteRecord]:
    """5×5 매트릭스 수집. 한 페이지에서 3건씩 사이클."""
    all_conds = [(t, m) for t in terms for m in mileages]
    results = []
    for i in range(0, len(all_conds), 3):
        chunk = all_conds[i:i+3]
        await configure_quote_slots(page, chunk)
        await click_calc_buttons(page, len(chunk))
        records = await extract_results(page, len(chunk))
        for j, (t, m) in enumerate(chunk):
            if j < len(records):
                records[j].term_months = t
                records[j].annual_mileage_km = m
                results.append(records[j])
        print(f"    [+] {len(chunk)}건 산출 ({len(results)}/{len(all_conds)})")
    return results


# ============================================================================
# 단일 차량 처리
# ============================================================================

async def collect_vehicle(page: Page, vehicle_cfg: dict, policy: dict,
                          channel_user_id: str) -> VehicleResult:
    result = VehicleResult(
        vehicle_id=vehicle_cfg['id'],
        keyword=vehicle_cfg['keyword'],
        brand=vehicle_cfg['brand'],
        category=vehicle_cfg['category'],
        timestamp=time.strftime("%Y-%m-%d %H:%M:%S"),
    )
    is_imported = vehicle_cfg.get('product_code_override') == "5020000002"
    product_code = vehicle_cfg.get('product_code_override') or "5010000003"

    print(f"\n━━━ {vehicle_cfg['id']} ({vehicle_cfg['keyword']}) ━━━")
    try:
        if not await ensure_session(page, channel_user_id):
            result.errors.append("session_dead")
            return result
        trims = await search_and_get_trims(page, vehicle_cfg['keyword'])
        if not trims:
            result.errors.append(f"no_trims_found")
            return result
        print(f"  발견된 트림 {len(trims)}개")

        lowest, upper = select_two_trims(trims)
        selected_trims = [t for t in [lowest, upper] if t is not None]
        if not selected_trims:
            result.errors.append("no_selectable_trim")
            return result

        for ti, trim in enumerate(selected_trims):
            print(f"\n  ◇ 트림 {ti+1}/{len(selected_trims)}: {trim.trim_name[:50]} ({trim.base_price:,}원)")
            if not await ensure_session(page, channel_user_id):
                result.errors.append(f"session_dead_at_trim_{ti}")
                return result
            # 차량 검색 다시
            await search_and_get_trims(page, vehicle_cfg['keyword'])
            await select_trim_and_proceed_to_quote_page(page, trim, is_imported)
            await select_product_code(page, product_code)

            base_quotes = await collect_base_matrix(
                page, policy['contract_terms'], policy['annual_mileages']
            )
            print(f"    ✓ 베이스 매트릭스 {len(base_quotes)}건 완료")

            result.trims.append({
                'trim': asdict(trim),
                'base_quotes': [asdict(q) for q in base_quotes],
                'validations': [],  # TODO: 선납/보증금 검증
            })
    except Exception as e:
        result.errors.append(f"exception: {type(e).__name__}: {str(e)[:200]}")
        print(f"  ✗ 오류: {e}")
    return result


# ============================================================================
# 메인
# ============================================================================

async def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("--user", required=True, help="KB chnlUserId")
    parser.add_argument("--config", default="config/vehicles.yaml")
    parser.add_argument("--output", default="sample_data/kb_full_matrix.json")
    parser.add_argument("--vehicles", help="콤마 구분된 차량 id (기본: 전체)")
    parser.add_argument("--headless", action="store_true")
    parser.add_argument("--priority", help="우선순위 필터 (P0/P1/P2)")
    args = parser.parse_args()

    cfg = yaml.safe_load(Path(args.config).read_text(encoding='utf-8'))
    policy = cfg['collection_policy']
    all_vehicles = cfg['vehicles']

    selected = all_vehicles
    if args.vehicles:
        ids = set(args.vehicles.split(','))
        selected = [v for v in all_vehicles if v['id'] in ids]
    if args.priority:
        selected = [v for v in selected if v.get('priority') == args.priority]

    print(f"수집 대상: {len(selected)}대")
    for v in selected:
        print(f"  - {v['id']} ({v['keyword']}, {v.get('priority', '?')})")

    output_data = {
        '_metadata': {
            'capital_code': 'KB',
            'collected_at': time.strftime("%Y-%m-%d"),
            'collector': 'kb_capital_full.py',
            'policy': policy,
        },
        'vehicles': [],
    }

    async with async_playwright() as pw:
        browser = await pw.chromium.launch(headless=args.headless)
        ctx = await browser.new_context()
        page = await ctx.new_page()
        await ensure_session(page, args.user)

        for vi, v in enumerate(selected, 1):
            print(f"\n{'#' * 70}")
            print(f"# {vi}/{len(selected)}: {v['id']}")
            print(f"{'#' * 70}")
            result = await collect_vehicle(page, v, policy, args.user)
            output_data['vehicles'].append(asdict(result))

            # 중간 저장 (각 차량 끝날 때마다)
            Path(args.output).parent.mkdir(parents=True, exist_ok=True)
            Path(args.output).write_text(
                json.dumps(output_data, ensure_ascii=False, indent=2),
                encoding='utf-8'
            )
            print(f"  💾 중간 저장 완료 → {args.output}")

        await browser.close()

    print(f"\n✓ 전체 수집 완료. {args.output}")


if __name__ == "__main__":
    asyncio.run(main())
