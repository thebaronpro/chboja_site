import json

banners = [
    {"label":"장기렌트","badge":"#171717","title":"선납금 없이, 월 납입금으로\n내 차를 타는 스마트한 방법","desc":"보험료 · 세금 · 유지비 포함 / 전국 무료 배송","btn":"무료 견적 신청","img":"https://images.unsplash.com/photo-1555215695-3004980ad54e?w=1200&q=80"},
    {"label":"전기차 렌트","badge":"#dc2626","title":"전기차 장기렌트\n충전비 걱정 없이 타세요","desc":"EV 보조금 적용 · 충전카드 포함 · 선납금 0원","btn":"전기차 견적보기","img":"https://images.unsplash.com/photo-1593941707882-a5bba14938c7?w=1200&q=80"},
    {"label":"수입차 렌트","badge":"#404040","title":"수입차도 월 납입금으로\n부담 없이 시작하세요","desc":"BMW · 벤츠 · 아우디 전 차종 / 보험 포함","btn":"수입차 견적보기","img":"https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=1200&q=80"},
]
cars = [
    {"tag":"특가","name":"현대 아반떼","price":"월 320,000원~","meta":"선납금 0원 · 48개월","img":"../cars/303_4455.png"},
    {"tag":"인기","name":"현대 그랜저","price":"월 650,000원~","meta":"선납금 0원 · 48개월","img":"../cars/cdn_4188.png"},
    {"tag":"인기","name":"기아 K8","price":"월 580,000원~","meta":"선납금 0원 · 36개월","img":"../cars/cdn_4665.png"},
    {"tag":"신차","name":"기아 카니발","price":"월 720,000원~","meta":"선납금 0원 · 60개월","img":"../cars/cdn_4586.png"},
]

with open('C:/Users/user/chaboza site/rental/_banners.json', 'w', encoding='utf-8') as f:
    json.dump(banners, f, ensure_ascii=False)
with open('C:/Users/user/chaboza site/rental/_cars.json', 'w', encoding='utf-8') as f:
    json.dump(cars, f, ensure_ascii=False)
print('OK')
