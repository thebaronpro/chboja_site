"""
KB캐피탈 어댑터 (Playwright 기반)

검증된 견적 절차 (2026-05-26):
  1. 페이지 진입 → alert/confirm/prompt 자동 승인 코드 주입
  2. 차량명 키워드 검색 (예: '아반떼') → 조회
  3. 차종 클릭 → 세부 트림 목록
  4. 26MY가 붙은 최저트림 선택 (특가 제외) → 다음
  5. 색상: 가격 표시 없는 무료 색상 → 다음
  6. 전면/측후면 썬팅, 블랙박스 모두 첫 번째 옵션 → 확인
  7. 개별소비세율 팝업은 alert 오버라이드로 자동 처리
  8. 상품코드: 장기렌터카(다이렉트) (value=5010000003)
  9. 견적서 ①②③ 동시 산출 (효율 3배)
  10. 월납입료 추출

요구 패키지: playwright (pip install playwright && playwright install chromium)
"""

import asyncio
import re
from typing import Optional

from .base import CapitalAdapter, TrimInfo, ColorInfo, QuoteCondition, QuoteResult


KB_URL = "https://kbeasy.kbcapital.co.kr/ss/em/EM030100.kbc"
PRODUCT_CODE_DIRECT = "5010000003"     # 장기렌터카(다이렉트)
TINT_FRONT_FIRST = "00736"             # 0. 루마 GG
TINT_SIDE_FIRST_HK = "00728"           # 1-0. 루마 GG (현대,기아,르노)
BLACKBOX_FIRST = "01105"               # 1.FHD-FHD

# 알림창/팝업 자동 승인 (개별소비세율 팝업 등)
ALERT_OVERRIDE_JS = """
window.alert = () => true;
window.confirm = () => true;
window.prompt = () => '';
"""


class KBCapitalAdapter(CapitalAdapter):
    CAPITAL_CODE = "KB"
    DISPLAY_NAME = "KB캐피탈"

    def __init__(self, channel_user_id: str):
        """
        channel_user_id: KB캐피탈 로그인 후 부여되는 사용자 식별자.
        URL의 ?chnlUserId= 파라미터로 사용됨. 로그인 세션이 활성 상태여야 함.
        """
        self.channel_user_id = channel_user_id

    # ------------------------------------------------------------------
    # 0. 페이지 진입 (모든 페이지 전환 시 호출)
    # ------------------------------------------------------------------
    async def _enter_quote_page(self, page) -> None:
        """초기 페이지 진입 + alert 자동 승인 주입."""
        await page.goto(f"{KB_URL}?chnlUserId={self.channel_user_id}&wrkDvcd=1")
        await page.wait_for_load_state("domcontentloaded")
        await page.evaluate(ALERT_OVERRIDE_JS)

    async def login(self, page) -> None:
        """
        KB캐피탈은 사용자가 미리 브라우저에서 로그인을 마쳐야 함.
        본 어댑터는 채널 사용자 ID로 직접 접근 가능한 세션을 가정.
        세션 만료 시 사이트가 로그인 페이지로 리다이렉트되므로 추후 감지 로직 추가 가능.
        """
        await self._enter_quote_page(page)

    # ------------------------------------------------------------------
    # 1. 차종 검색
    # ------------------------------------------------------------------
    async def search_trims(self, page, keyword: str) -> list[TrimInfo]:
        await self._enter_quote_page(page)

        # 차량검색 영역 열기 (이미 열려있으면 무시)
        search_btn = page.locator('button:has-text("차량검색")').first
        if await search_btn.is_visible():
            try:
                await search_btn.click(timeout=2000)
            except Exception:
                pass

        # 키워드 입력 후 조회
        input_el = page.locator('input[placeholder="차종/모델명 입력"]')
        await input_el.fill(keyword)
        await page.locator('a:has-text("조회")').first.click()
        await page.wait_for_timeout(1500)

        # 차종 선택 영역에서 매칭되는 차종 클릭 (첫 번째)
        model_btn = page.locator('text=' + keyword).first
        await model_btn.click()
        await page.wait_for_timeout(1500)

        # 세부 트림 추출 — 각 행에서 트림명, cc, 가격 파싱
        trims = await page.evaluate("""
            () => {
                const items = [];
                // 세부 차종 선택 리스트의 각 항목 (사이트 DOM 구조에 의존)
                document.querySelectorAll('li, tr, div').forEach(el => {
                    if (el.children.length > 10) return;
                    const t = (el.innerText || '').replace(/\\s+/g, ' ').trim();
                    const m = t.match(/^(\\[.+?\\])?\\s*\\[(\\d{2}MY)\\]\\s*(.+?)\\s+(\\d{1,3}(?:,\\d{3})*)cc\\s+(\\d+)만원$/);
                    if (m) {
                        items.push({
                            special_tag: m[1] || '',
                            year: m[2],
                            trim_name: m[3],
                            engine_cc: parseInt(m[4].replace(/,/g, ''), 10),
                            price_man: parseInt(m[5], 10),
                            full: t,
                        });
                    }
                });
                return items;
            }
        """)

        result = []
        for t in trims:
            full_name = f"{t['special_tag']}[{t['year']}] {t['trim_name']}".strip()
            result.append(TrimInfo(
                trim_name=full_name,
                base_price=t['price_man'] * 10_000,
                engine_cc=t['engine_cc'],
                drivetrain=_extract_drivetrain(t['trim_name']),
                is_special='특가' in t['special_tag'],
                is_26my=(t['year'] == '26MY'),
            ))
        # 가격순 정렬
        result.sort(key=lambda x: x.base_price)
        return result

    # ------------------------------------------------------------------
    # 2. 색상 옵션 (대표 트림 선택 후 호출)
    # ------------------------------------------------------------------
    async def list_colors(self, page, trim: TrimInfo) -> list[ColorInfo]:
        # 트림 선택 → 다음 진행으로 색상 화면 진입은 select_and_advance_to_options()에서 처리
        # 여기서는 이미 옵션 화면에 도달했다고 가정
        colors = await page.evaluate("""
            () => {
                const out = [];
                // 외장 색상 영역 (사이트 구조: 색상 셀에 가격이 표기되거나 없음)
                document.querySelectorAll('[class*="color"], [class*="외장"]').forEach(el => {
                    const t = (el.innerText || '').replace(/\\s+/g, ' ').trim();
                    if (!t || t.length > 200) return;
                    // '메타 블루 펄(PM2)' 또는 '크리미 화이트 펄 WW2 80,000원'
                    const m = t.match(/(.+?)(?:\\((\\w+)\\))?\\s*(?:(\\d{1,3}(?:,\\d{3})*)원)?$/);
                    if (m) {
                        out.push({
                            color_name: (m[1] || '').trim(),
                            color_code: m[2] || null,
                            extra_cost: m[3] ? parseInt(m[3].replace(/,/g, ''), 10) : 0,
                        });
                    }
                });
                return out;
            }
        """)
        return [ColorInfo(**c, is_exterior=True) for c in colors if c['color_name']]

    # ------------------------------------------------------------------
    # 3. 견적 산출 (한 트림에 대해 여러 조건 한 번에 — 견적서 ①②③ 활용)
    # ------------------------------------------------------------------
    async def get_quotes_batch(self, page, trim: TrimInfo,
                                conditions: list[QuoteCondition]) -> list[QuoteResult]:
        """
        KB의 견적서 ①②③을 활용해 한 페이지에서 최대 3건 동시 산출.
        조건이 3개 초과면 페이지 새로 진입하여 반복.
        """
        results: list[QuoteResult] = []
        for i in range(0, len(conditions), 3):
            chunk = conditions[i:i+3]
            results.extend(await self._batch_three(page, trim, chunk))
        return results

    async def _batch_three(self, page, trim: TrimInfo,
                            conditions: list[QuoteCondition]) -> list[QuoteResult]:
        """한 페이지에서 최대 3건 동시 산출."""
        await self._enter_quote_page(page)
        await self._select_trim_and_advance(page, trim)
        await self._fill_options_and_advance(page)

        # 상품코드 선택
        await page.locator('select').filter(has_text="상품코드").first.select_option(PRODUCT_CODE_DIRECT)
        await page.wait_for_timeout(1000)

        # 견적서별 조건 입력
        for idx, cond in enumerate(conditions):
            await self._fill_quote_form(page, idx, cond)

        # 견적산출 버튼 (각 견적서별)
        await page.evaluate("""
            () => {
                document.querySelectorAll('button, a').forEach(b => {
                    if ((b.innerText || '').trim() === '견적산출') b.click();
                });
            }
        """)
        await page.wait_for_timeout(6000)  # 산출 대기

        # 결과 추출
        payments = await page.evaluate("""
            () => {
                const out = [];
                document.querySelectorAll('[class*="월납입료"], [class*="payment"]').forEach(el => {
                    const t = (el.innerText || '').match(/([\\d,]+)\\s*원/);
                    if (t) out.push(parseInt(t[1].replace(/,/g, ''), 10));
                });
                return out;
            }
        """)

        # 잔존가치 추출
        residual = await page.evaluate("""
            () => {
                const inputs = document.querySelectorAll('input[name="aplyRvrt"]');
                const amounts = document.querySelectorAll('input[name="aplyRmvl"]');
                const out = [];
                for (let i = 0; i < inputs.length; i++) {
                    out.push({
                        pct: parseFloat(inputs[i].value || '0'),
                        amt: parseInt((amounts[i]?.value || '0').replace(/,/g, ''), 10),
                    });
                }
                return out;
            }
        """)

        results = []
        for i, cond in enumerate(conditions):
            results.append(QuoteResult(
                monthly_payment=payments[i] if i < len(payments) else 0,
                residual_pct=residual[i]['pct'] if i < len(residual) else 0,
                residual_amount=residual[i]['amt'] if i < len(residual) else 0,
                source_quote_no=None,
                raw_data={
                    "term_months": cond.term_months,
                    "annual_mileage_km": cond.annual_mileage_km,
                    "prepay_pct": cond.prepay_pct,
                },
            ))
        return results

    async def get_quote(self, page, trim: TrimInfo, condition: QuoteCondition) -> QuoteResult:
        """단일 견적 — get_quotes_batch의 thin wrapper."""
        return (await self.get_quotes_batch(page, trim, [condition]))[0]

    # ------------------------------------------------------------------
    # 내부 헬퍼
    # ------------------------------------------------------------------
    async def _select_trim_and_advance(self, page, trim: TrimInfo) -> None:
        """검색 → 트림 선택 → 다음 클릭하여 색상 화면 진입."""
        # 키워드 검색
        keyword = _model_keyword_from_trim(trim.trim_name)
        await page.locator('input[placeholder="차종/모델명 입력"]').fill(keyword)
        await page.locator('a:has-text("조회")').first.click()
        await page.wait_for_timeout(1500)
        await page.locator('text=' + keyword).first.click()
        await page.wait_for_timeout(1500)

        # 정확한 트림명 클릭 (full name 일부로 매칭)
        await page.evaluate(f"""
            (target) => {{
                document.querySelectorAll('li, tr, div').forEach(el => {{
                    const t = (el.innerText || '').replace(/\\s+/g, ' ').trim();
                    if (t.includes(target) && el.children.length < 10) el.click();
                }});
            }}
        """, trim.trim_name[:30])
        await page.wait_for_timeout(1000)

        # 다음
        await page.locator('a:has-text("다음")').first.click()
        await page.wait_for_timeout(2500)

    async def _fill_options_and_advance(self, page) -> None:
        """색상 + 썬팅/블랙박스 첫 옵션 선택 → 확인."""
        # 무료 색상 (가격 표시 없는 첫 색상) 선택 — DOM 구조 의존
        await page.evaluate("""
            () => {
                const colors = document.querySelectorAll('[class*="color-item"], [class*="외장"]');
                for (const c of colors) {
                    const t = (c.innerText || '').trim();
                    if (t && !/\\d+원/.test(t)) {
                        c.click();
                        return;
                    }
                }
            }
        """)
        await page.wait_for_timeout(500)
        await page.locator('a:has-text("다음")').first.click()
        await page.wait_for_timeout(2500)

        # 썬팅/블랙박스 첫 옵션
        selects = page.locator('select')
        await selects.filter(has_text="전면 썬팅").first.select_option(TINT_FRONT_FIRST)
        await selects.filter(has_text="측후면 썬팅").first.select_option(TINT_SIDE_FIRST_HK)
        await selects.filter(has_text="블랙박스").first.select_option(BLACKBOX_FIRST)
        await page.wait_for_timeout(500)
        await page.locator('a:has-text("확인")').first.click()
        await page.wait_for_timeout(3000)
        # 개별소비세율 팝업은 alert override로 자동 처리됨

    async def _fill_quote_form(self, page, idx: int, cond: QuoteCondition) -> None:
        """견적서 idx(0/1/2)에 조건 입력."""
        # 계약기간, 주행거리 (해당 견적서의 idx번째 select 활용)
        await page.evaluate(f"""
            (args) => {{
                const {{idx, term, mileage}} = args;
                const setters = Object.getOwnPropertyDescriptor(window.HTMLSelectElement.prototype, 'value').set;
                const setInp = Object.getOwnPropertyDescriptor(window.HTMLInputElement.prototype, 'value').set;
                // 각 견적서별로 select 그룹이 있음 — 동일 name 배열에서 idx 위치 사용
                const terms = document.querySelectorAll('select[name*="term"], select[name*="cntr"]');
                const miles = document.querySelectorAll('select[name*="mileage"], select[name*="drvn"]');
                if (terms[idx]) {{
                    setters.call(terms[idx], String(term));
                    terms[idx].dispatchEvent(new Event('change', {{bubbles: true}}));
                }}
                if (miles[idx]) {{
                    // 주행거리는 '1만Km' 형태의 텍스트 — 옵션 텍스트로 매칭
                    const opt = Array.from(miles[idx].options).find(o => o.text.includes(String(mileage/10000) + '만'));
                    if (opt) {{
                        setters.call(miles[idx], opt.value);
                        miles[idx].dispatchEvent(new Event('change', {{bubbles: true}}));
                    }}
                }}
                // 선납금 라디오 + 비율 입력
                if ({cond.prepay_pct} > 0) {{
                    const radios = document.querySelectorAll('input[type="radio"][value="2"]'); // 선납금 라디오 value=2
                    if (radios[idx]) radios[idx].click();
                    const ppyInputs = document.querySelectorAll('input[name="ppyRt"]');
                    if (ppyInputs[idx]) {{
                        setInp.call(ppyInputs[idx], '{cond.prepay_pct}');
                        ppyInputs[idx].dispatchEvent(new Event('input', {{bubbles: true}}));
                        ppyInputs[idx].dispatchEvent(new Event('change', {{bubbles: true}}));
                        ppyInputs[idx].dispatchEvent(new Event('blur', {{bubbles: true}}));
                    }}
                }}
            }}
        """, {"idx": idx, "term": cond.term_months, "mileage": cond.annual_mileage_km})
        await page.wait_for_timeout(500)


# ---------- 모듈 헬퍼 ----------

def _extract_drivetrain(name: str) -> Optional[str]:
    for d in ("AWD", "4WD", "2WD"):
        if d in name:
            return d
    return None


def _model_keyword_from_trim(trim_name: str) -> str:
    """트림명에서 검색용 키워드 추출 (예: '현대 더 뉴 아반떼' → '아반떼')."""
    # 단순화: 한글 모델명 첫 단어. 실 운영에서는 vehicle_model 마스터에서 가져옴.
    m = re.search(r'(아반떼|쏘나타|그랜저|싼타페|팰리세이드|스포티지|카니발|셀토스|니로|K5|Model 3)', trim_name)
    return m.group(1) if m else trim_name.split()[-1]
