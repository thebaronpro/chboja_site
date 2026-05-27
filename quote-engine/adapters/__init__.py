"""캐피탈사 어댑터 레지스트리."""
from .base import CapitalAdapter, TrimInfo, ColorInfo, QuoteCondition, QuoteResult
from .kb_capital import KBCapitalAdapter

REGISTRY: dict[str, type[CapitalAdapter]] = {
    "KB": KBCapitalAdapter,
}


def get_adapter(code: str, **kwargs) -> CapitalAdapter:
    cls = REGISTRY.get(code.upper())
    if not cls:
        raise ValueError(f"Unknown capital code: {code}. Available: {list(REGISTRY.keys())}")
    return cls(**kwargs)


__all__ = [
    "CapitalAdapter", "TrimInfo", "ColorInfo", "QuoteCondition", "QuoteResult",
    "KBCapitalAdapter", "REGISTRY", "get_adapter",
]
