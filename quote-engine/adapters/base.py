"""
캐피탈사 어댑터의 공통 인터페이스.

새 캐피탈사 추가 시:
  1. CapitalAdapter 상속 + 추상 메서드 모두 구현
  2. CAPITAL_CODE 클래스 변수 설정
  3. adapters/__init__.py의 REGISTRY에 등록
  4. 단위 테스트로 검증 (10대 차종 베이스 견적 정상 수집 확인)
"""

from abc import ABC, abstractmethod
from dataclasses import dataclass, field
from typing import Optional


# ---------- 어댑터가 다루는 도메인 객체 (DB 모델과 별개의 가벼운 dataclass) ----------

@dataclass
class TrimInfo:
    """검색 결과의 한 트림."""
    trim_name: str          # 전체 명칭 (예: '[26MY] 현대 더 뉴 아반떼 1.6 가솔린 스마트')
    base_price: int         # 차량가격 (원)
    engine_cc: Optional[int] = None
    drivetrain: Optional[str] = None
    is_special: bool = False   # [특가] 여부
    is_26my: bool = False      # 26MY 여부 (대표 트림 선정용)
    site_id: Optional[str] = None  # 사이트 내부 고유 식별자


@dataclass
class ColorInfo:
    color_name: str
    color_code: Optional[str] = None
    extra_cost: int = 0
    is_exterior: bool = True


@dataclass
class QuoteCondition:
    """단일 견적 산출 조건."""
    term_months: int               # 12, 24, 36, 48, 60
    annual_mileage_km: int         # 10000, 15000, 20000, 30000, -1
    prepay_pct: int = 0
    deposit_pct: int = 0


@dataclass
class QuoteResult:
    """사이트에서 추출한 한 견적."""
    monthly_payment: int           # 월납입료 (원)
    residual_pct: float            # 잔존가치율 (%)
    residual_amount: int           # 잔존가치 (원)
    source_quote_no: Optional[str] = None
    raw_data: dict = field(default_factory=dict)


# ---------- 추상 어댑터 ----------

class CapitalAdapter(ABC):
    """모든 캐피탈사 모듈이 구현해야 하는 추상 클래스."""

    CAPITAL_CODE: str = ""      # 예: 'KB', 'HYUNDAI'
    DISPLAY_NAME: str = ""      # 예: 'KB캐피탈'

    @abstractmethod
    async def login(self, page) -> None:
        """사이트 로그인 또는 세션 확보. 로그인 불필요시 pass."""

    @abstractmethod
    async def search_trims(self, page, keyword: str) -> list[TrimInfo]:
        """키워드로 차종 검색 → 세부 트림 목록 반환 (가격순 정렬 권장)."""

    @abstractmethod
    async def list_colors(self, page, trim: TrimInfo) -> list[ColorInfo]:
        """트림 선택 후 색상 옵션 추출. 무료 색상부터 정렬."""

    @abstractmethod
    async def get_quote(self, page, trim: TrimInfo, condition: QuoteCondition) -> QuoteResult:
        """단일 견적 산출 (페이지 진입 → 조건 입력 → 산출 → 결과 추출)."""

    async def get_quotes_batch(self, page, trim: TrimInfo,
                                conditions: list[QuoteCondition]) -> list[QuoteResult]:
        """
        동시 견적 산출 (KB는 ①②③ 동시 산출 활용으로 효율 3배).
        기본 구현: 순차 처리. 캐피탈사별로 오버라이드 권장.
        """
        results = []
        for cond in conditions:
            results.append(await self.get_quote(page, trim, cond))
        return results

    def select_representative_trim(self, trims: list[TrimInfo]) -> Optional[TrimInfo]:
        """
        대표 트림 선정 규칙 (모든 어댑터 공통):
          1. 26MY가 있으면 26MY 우선
          2. [특가]가 아닌 일반 버전 우선
          3. 가격이 가장 낮은 트림
        """
        if not trims:
            return None
        my26 = [t for t in trims if t.is_26my]
        candidates = my26 if my26 else trims
        normal = [t for t in candidates if not t.is_special]
        candidates = normal if normal else candidates
        return sorted(candidates, key=lambda t: t.base_price)[0]
