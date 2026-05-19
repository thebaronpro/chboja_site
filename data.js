/* ===================== DATA.JS ===================== */

const NAV_ITEMS = ["홈", "장기렌트", "할부", "중고차", "화물리스", "자동차용품", "이벤트&혜택", "고객센터"];

const ICONS = {
  left: "←", right: "→", down: "⌄", arrow: "→", search: "⌕",
  phone: "☎", mail: "✉", chat: "●", plus: "+", zap: "⚡", send: "↗"
};

const IMG = {
  avante:   "https://images.unsplash.com/photo-1609521263047-f8f205293f24?auto=format&fit=crop&w=700&h=420&q=80",
  grandeur: "https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=700&h=420&q=80",
  k8:       "https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=700&h=420&q=80",
  carnival: "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=700&h=420&q=80",
  genesis:  "https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=700&h=420&q=80",
  palisade: "https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?auto=format&fit=crop&w=700&h=420&q=80",
  stinger:  "https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=420&q=80",
  bmw5:     "https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=700&h=420&q=80",
  truck1:   "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=700&h=420&q=80",
  truck2:   "https://images.unsplash.com/photo-1485291571150-772bcfc10da5?auto=format&fit=crop&w=700&h=420&q=80",
  ev:       "https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&w=700&h=420&q=80",
  tesla:    "https://images.unsplash.com/photo-1560958089-b8a1929cea89?auto=format&fit=crop&w=700&h=420&q=80",
  tint:     "https://images.unsplash.com/photo-1601362840469-51e4d8d58785?auto=format&fit=crop&w=700&h=420&q=80",
  product:  "https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=600&h=380&q=80",
};

const CARS = [
  { tag: "특가", name: "현대 아반떼", price: "월 320,000원~", meta: "선납금 0원 · 48개월", image: IMG.avante },
  { tag: "인기", name: "현대 그랜저", price: "월 650,000원~", meta: "선납금 0원 · 48개월", image: IMG.grandeur },
  { tag: "인기", name: "기아 K8",    price: "월 580,000원~", meta: "선납금 0원 · 36개월", image: IMG.k8 },
  { tag: "신차", name: "기아 카니발", price: "월 720,000원~", meta: "선납금 0원 · 60개월", image: IMG.carnival },
];

const USED_CARS = [
  { tag: "무사고", name: "제네시스 G80 (2022)",    price: "월 680,000원~", meta: "금리 4.5% · 48개월 · 1인 소유", image: IMG.genesis },
  { tag: "인증",   name: "현대 팰리세이드 (2023)", price: "월 720,000원~", meta: "금리 3.9% · 60개월 · 무사고",   image: IMG.palisade },
  { tag: "직거래", name: "기아 스팅어 (2022)",     price: "월 520,000원~", meta: "금리 4.2% · 48개월 · 1인 소유", image: IMG.stinger },
  { tag: "무사고", name: "BMW 5시리즈 (2021)",     price: "월 860,000원~", meta: "금리 4.8% · 60개월 · 무사고",   image: IMG.bmw5 },
];

const TRUCKS = [
  { tag: "인기", name: "현대 포터 전기",  price: "월 580,000원~", meta: "보증금 0원 · 48개월",  image: IMG.ev },
  { tag: "특가", name: "기아 봉고3 EV",  price: "월 560,000원~", meta: "보증금 0원 · 48개월",  image: IMG.truck1 },
  { tag: "신차", name: "현대 포터 디젤", price: "월 420,000원~", meta: "보증금 100만 · 60개월", image: IMG.truck2 },
  { tag: "냉동", name: "기아 봉고3 냉동탑", price: "월 680,000원~", meta: "보증금 0원 · 48개월", image: IMG.truck1 },
];

const PRODUCTS = [
  "3M Crystalline 70", "LLumar CTX 70", "V-KOOL 40", "Huper Optik Neo 65",
  "Solar Gard Stratos", "XPEL Prime XR Plus", "3M Ceramic IR 40", "Johnson Window Films",
].map((name, i) => ({
  name,
  rating: i < 2 ? "★★★★★" : "★★★★☆",
  price: ["720,000원~","580,000원~","490,000원~","420,000원~","380,000원~","850,000원~","620,000원~","320,000원~"][i],
  image: [IMG.tint, IMG.product, IMG.tint, IMG.product, IMG.tint, IMG.product, IMG.tint, IMG.product][i],
}));

const EVENTS = [
  { title: "장기렌트 첫 달 무료",     desc: "선납금 없이 첫 달 렌트비 100% 면제",     date: "2026.04.01 ~ 2026.04.30", open: true,  image: IMG.grandeur },
  { title: "3M 썬팅 최대 30% 할인",  desc: "크리스탈린 전 제품 특가 진행",           date: "2026.04.01 ~ 2026.04.30", open: true,  image: IMG.tint },
  { title: "할부 무이자 36개월",      desc: "현대·기아 전 차종 무이자 할부 적용",     date: "2026.04.15 ~ 2026.05.15", open: true,  image: IMG.stinger },
  { title: "봄맞이 중고차 특가전",    desc: "전국 인증 중고차 최대 200만원 할인",     date: "2026.04.01 ~ 2026.05.31", open: true,  image: IMG.genesis },
  { title: "화물리스 보증금 면제",    desc: "1톤~5톤 전 차종 보증금 0원 적용",        date: "2026.04.01 ~ 2026.06.30", open: true },
  { title: "블랙박스 무료 설치",      desc: "장기렌트 계약 시 블랙박스 무상 설치",    date: "2026.04.10 ~ 2026.04.30", open: true },
  { title: "카시트 구매 20% 할인",    desc: "렌트 계약 고객 카시트 할인권 제공",      date: "2026.04.01 ~ 2026.05.31", open: true },
  { title: "전기차 충전기 설치비 지원", desc: "EV 렌트 계약 고객 50% 지원",          date: "2026.04.01 ~ 2026.06.30", open: true },
  { title: "신차 할부 금리 우대",     desc: "KB·현대캐피탈 금리 0.5% 추가 인하",     date: "2026.02.01 ~ 2026.03.31", open: false },
  { title: "용품점 연결 첫 이용 혜택", desc: "첫 이용 시 5만원 즉시 할인",           date: "2026.01.01 ~ 2026.03.31", open: false },
  { title: "카카오 간편 상담 이벤트", desc: "카카오톡 상담 신청 시 견적 즉시 발송",   date: "2026.01.15 ~ 2026.03.15", open: false },
  { title: "렌트·리스 패키지 특가",   desc: "출고 후 용품 패키지 세트 30% 할인",     date: "2026.02.01 ~ 2026.03.31", open: false },
];

const FAQS = [
  ["장기렌트와 리스의 차이점이 무엇인가요?", "장기렌트는 보험·세금·정비를 포함해 월 납입금으로 차량을 이용하는 방식이고, 리스는 금융상품 성격이 강해 비용처리와 소유 옵션에 장점이 있습니다."],
  ["선납금 없이 계약이 가능한가요?",          "가능합니다. 차종과 신용 조건에 따라 보증금 0원 또는 선납금 0원 상품을 안내해드립니다."],
  ["계약 중 차량 교체가 가능한가요?",         "계약 조건에 따라 중도 변경 또는 승계가 가능합니다."],
  ["견적 신청 후 얼마나 걸리나요?",           "영업시간 기준 평균 30분~2시간 안에 1차 견적을 안내드립니다."],
];

const RENTAL_BANNERS = [
  { label: "장기렌트", badge: "bg-neutral-900", title: "선납금 없이, 월 납입금으로\n내 차를 타는 스마트한 방법", desc: "보험료 · 세금 · 유지비 포함 / 전국 무료 배송 / 계약 12~60개월", button: "무료 견적 신청", target: "고객센터", image: IMG.grandeur },
  { label: "전기차 렌트", badge: "bg-red-600",    title: "전기차 장기렌트\n충전비 걱정 없이 타세요",           desc: "EV 보조금 적용 · 충전카드 포함 · 선납금 0원",             button: "전기차 견적보기", target: "고객센터", image: IMG.ev },
  { label: "수입차 렌트", badge: "bg-neutral-700", title: "수입차도 월 납입금으로\n부담 없이 시작하세요",       desc: "BMW · 벤츠 · 아우디 전 차종 / 보험 포함",                button: "수입차 견적보기", target: "고객센터", image: IMG.bmw5 },
  { label: "SUV 특가",   badge: "bg-neutral-600", title: "팰리세이드 · 카니발\n가족을 위한 SUV 렌트 특가",   desc: "대형 SUV · 승합 전 차종 / 선납금 0원 · 보험 포함",       button: "SUV 견적보기",  target: "고객센터", image: IMG.palisade },
  { label: "한정 특가",  badge: "bg-red-700",     title: "이번 주 한정 재고 특가\n지금 바로 출고 가능",       desc: "소진 시 즉시 종료 · 월 납입금 최저가 보장",              button: "특가 보러가기", target: "고객센터", image: IMG.stinger },
];

const INSTALLMENT_BANNERS = [
  { label: "할부 특가",  badge: "bg-red-600",     title: "무이자 36개월\n신차 구매 부담을 낮추다",   desc: "현대·기아 인기 차종 대상 특별 금융 혜택",      button: "할부 계산하기",    target: "고객센터", image: IMG.stinger },
  { label: "전기차 할부", badge: "bg-neutral-900", title: "전기차 할부\n보조금까지 한 번에",         desc: "EV6 · 아이오닉6 · 코나EV / 보조금 상담 포함", button: "전기차 할부 보기", target: "고객센터", image: IMG.ev },
  { label: "중고차 할부", badge: "bg-neutral-700", title: "인증 중고차 할부\n최저 금리 3.9%",        desc: "전국 인증 딜러 보증 · 즉시 출고 가능",        button: "중고차 할부 보기", target: "고객센터", image: IMG.genesis },
];

const MAIN_BANNERS = [
  { label: "장기렌트",  title: "첫 달 렌트비 0원\n지금 가장 가볍게 시작하세요",  desc: "선납금 0원 · 보험료 포함 · 전국 무료 배송",    button: "장기렌트 견적보기", target: "장기렌트", badge: "bg-neutral-900", image: IMG.grandeur },
  { label: "할부 특가", title: "무이자 36개월\n신차 구매 부담을 낮추다",         desc: "현대·기아 인기 차종 대상 특별 금융 혜택",      button: "할부 계산하기",    target: "할부",    badge: "bg-red-600",     image: IMG.stinger },
  { label: "인증 중고차", title: "허위매물 없이\n검증된 중고차만 모았습니다",    desc: "무사고 우선 · 인증 딜러 보증 · 직거래 상담",   button: "중고차 둘러보기", target: "중고차",  badge: "bg-neutral-800", image: IMG.genesis },
  { label: "화물리스",  title: "사업용 차량 리스\n세금 혜택까지 한 번에",        desc: "1톤·2.5톤·5톤 전 차종 / 보증금 0원 가능",     button: "사업자 견적받기", target: "화물리스", badge: "bg-neutral-600", image: IMG.truck1, dark: true },
];

const HOT_DEALS = [
  { title: "현대 그랜저\n장기렌트 특가", price: "월 650,000원~", meta: "선납금 0원 · 48개월 · 보험 포함", target: "장기렌트",  tone: "bg-neutral-900 text-white",      image: IMG.grandeur },
  { title: "기아 EV6\n전기차 할부",     price: "월 580,000원~", meta: "무이자 36개월 · 보조금 상담",    target: "할부",      tone: "bg-slate-200 text-neutral-950",  image: IMG.ev },
  { title: "테슬라 모델Y\n인증 중고차", price: "월 720,000원~", meta: "무사고 · 즉시 출고 가능",        target: "중고차",    tone: "bg-neutral-300 text-neutral-950", image: IMG.tesla },
  { title: "포터 EV\n사업자 화물리스",  price: "월 560,000원~", meta: "부가세 환급 · 비용처리 가능",    target: "화물리스",  tone: "bg-neutral-800 text-white",      image: IMG.truck1 },
  { title: "3M 썬팅\n패키지 할인",     price: "최대 30% OFF",  meta: "계약 고객 전용 시공 혜택",       target: "자동차용품", tone: "bg-slate-300 text-neutral-950",  image: IMG.tint },
  { title: "기아 K8\n장기렌트 특가",   price: "월 580,000원~", meta: "선납금 0원 · 36개월 · 보험 포함", target: "장기렌트", tone: "bg-neutral-700 text-white",      image: IMG.k8 },
];

const POPULAR_CARS = [
  { rank: 1,  name: "현대 그랜저",   price: "월 650,000원~", meta: "선납금 0원 · 48개월", image: IMG.grandeur },
  { rank: 2,  name: "기아 K8",      price: "월 580,000원~", meta: "선납금 0원 · 36개월", image: IMG.k8 },
  { rank: 3,  name: "현대 팰리세이드", price: "월 720,000원~", meta: "선납금 0원 · 60개월", image: IMG.palisade },
  { rank: 4,  name: "기아 카니발",   price: "월 720,000원~", meta: "선납금 0원 · 60개월", image: IMG.carnival },
  { rank: 5,  name: "제네시스 G80",  price: "월 680,000원~", meta: "선납금 0원 · 48개월", image: IMG.genesis },
  { rank: 6,  name: "현대 아반떼",   price: "월 320,000원~", meta: "선납금 0원 · 48개월", image: IMG.avante },
  { rank: 7,  name: "기아 스팅어",   price: "월 520,000원~", meta: "선납금 0원 · 48개월", image: IMG.stinger },
  { rank: 8,  name: "BMW 5시리즈",   price: "월 860,000원~", meta: "선납금 0원 · 60개월", image: IMG.bmw5 },
  { rank: 9,  name: "테슬라 모델Y",  price: "월 720,000원~", meta: "선납금 0원 · 48개월", image: IMG.tesla },
  { rank: 10, name: "현대 포터 EV",  price: "월 580,000원~", meta: "보증금 0원 · 48개월", image: IMG.ev },
];

const MEGA_MENU = {
  "장기렌트": [
    { title: "차종별 렌트", items: ["국산차 렌트", "수입차 렌트", "전기차 렌트", "승합·SUV 렌트"] },
    { title: "특가 상품",   items: ["이번 주 특가", "한정 재고 특가", "타임딜", "신규 출고 특가"] },
    { title: "견적·상담",   items: ["간편 견적 신청", "렌트 VS 리스 비교", "장기렌트 안내"] },
  ],
  "할부": [
    { title: "신차 할부",   items: ["국산차 할부", "수입차 할부", "전기차 할부", "상용차 할부"] },
    { title: "중고차 할부", items: ["인증 중고차 할부", "직거래 할부 상담"] },
    { title: "금융 안내",   items: ["할부 계산기", "금리 비교", "제휴 금융사 안내"] },
  ],
  "중고차": [
    { title: "차종별",   items: ["국산 중고차", "수입 중고차", "전기 중고차", "SUV·RV"] },
    { title: "거래 유형", items: ["인증 중고차", "직거래", "무사고 차량"] },
    { title: "시세·정보", items: ["중고차 시세 조회", "차량 상태 확인", "매입 문의"] },
  ],
  "화물리스": [
    { title: "차급별",     items: ["1톤 리스", "2.5톤 리스", "5톤 리스", "특장차 리스"] },
    { title: "차종별",     items: ["냉동탑차", "윙바디", "카고 트럭", "탑차"] },
    { title: "사업자 안내", items: ["세금 혜택 안내", "부가세 환급", "비용처리 안내"] },
  ],
  "자동차용품": [
    { title: "시공 서비스", items: ["썬팅 필름", "블랙박스 설치", "차량 코팅"] },
    { title: "편의 용품",   items: ["카시트", "내비게이션", "차량용 매트"] },
    { title: "관리 용품",   items: ["세차용품", "흠집 제거제", "방향제·탈취제"] },
  ],
  "이벤트&혜택": [
    { title: "이벤트", items: ["진행 중 이벤트", "종료된 이벤트"] },
    { title: "혜택",   items: ["쿠폰 받기", "멤버십 혜택", "첫 가입 혜택"] },
  ],
  "고객센터": [
    { title: "고객 지원", items: ["공지사항", "자주 묻는 질문", "1:1 문의"] },
    { title: "상담 채널", items: ["전화 상담", "카카오 상담", "이메일 문의"] },
  ],
};

/* UTILS */
function calculateMonthlyPayment(price, deposit, rate, months) {
  const principal = Math.max((Number(price)||0) - (Number(deposit)||0), 0);
  const r = (Number(rate)||0) / 100 / 12;
  const n = Math.max(Number(months)||1, 1);
  return Math.round(r ? principal * r / (1 - Math.pow(1 + r, -n)) : principal / n);
}
function wrapIndex(current, delta, length) {
  if (!length) return 0;
  return ((current + delta) % length + length) % length;
}
