<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

if (defined('CHABOZA_RENTAL_DATA_LOADED')) return;
define('CHABOZA_RENTAL_DATA_LOADED', true);

const MOB_CATS = ['인기차종', 'SUV', '세단', '전기차', '하이브리드', '생에 첫 차'];

function get_rental_cars(): array
{
    return [
        ['tag' => '특가', 'name' => '현대 아반떼', 'price' => '월 320,000원', 'price30' => '월 280,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4455.png', 'stock' => 98, 'trimRange' => '프리미엄 ~ 인스퍼레이션 터보', 'carPrice' => '2,094만원~2,801만원', 'colors' => ['아틀라스 화이트','세니트 블랙','문라이트 블루','미스틱 그레이','어비스 블랙펄'], 'tagline' => '생애 첫 차 BEST', 'rating' => '4.8', 'reviews' => 1247],
        ['tag' => '인기', 'name' => '현대 그랜저', 'price' => '월 650,000원', 'price30' => '월 570,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4188.png', 'stock' => 43, 'trimRange' => '프리미엄 ~ 캘리그래피',       'carPrice' => '4,218만원~5,512만원', 'colors' => ['아틀라스 화이트','미스틱 그레이','어비스 블랙펄','문라이트 블루','그라파이트 그레이'], 'tagline' => '오너 만족도 1위', 'rating' => '4.9', 'reviews' => 982],
        ['tag' => '인기', 'name' => '기아 K8',    'price' => '월 580,000원', 'price30' => '월 510,000원', 'meta' => '선납금 0원 · 36개월', 'image' => '../cars/cdn_4665.png', 'stock' => 27, 'trimRange' => '프레스티지 ~ 시그니처',       'carPrice' => '3,876만원~5,224만원', 'colors' => ['스노우 화이트펄','오로라 블랙펄','갤럭시아 블루','문라이트 블루','실버리 라임'], 'tagline' => '가성비 프리미엄', 'rating' => '4.7', 'reviews' => 614],
        ['tag' => '신차', 'name' => '기아 카니발', 'price' => '월 720,000원', 'price30' => '월 630,000원', 'meta' => '선납금 0원 · 60개월', 'image' => '../cars/cdn_4586.png', 'stock' => 15, 'trimRange' => '프레스티지 ~ 시그니처',       'carPrice' => '4,156만원~5,638만원', 'colors' => ['스노우 화이트펄','어비스 블랙펄','실버리 라임','카키 그린'], 'tagline' => '패밀리 1픽', 'rating' => '4.9', 'reviews' => 1583],
        ['tag' => '인기', 'name' => '현대 싼타페', 'price' => '월 560,000원', 'price30' => '월 490,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4435.png', 'stock' => 62, 'trimRange' => '인스퍼레이션 ~ 캘리그래피',   'carPrice' => '3,524만원~4,792만원', 'colors' => ['어비스 블랙펄','테라 브라운','아틀라스 화이트','갤럭시아 블루','그라파이트 그레이'], 'tagline' => '주말 캠핑 추천', 'rating' => '4.8', 'reviews' => 875],
    ];
}

function get_mob_cars(): array
{
    return [
        ['tag' => '특가', 'name' => '현대 아반떼',     'trim' => '인스퍼레이션 1.6',       'price' => '월 320,000원', 'price30' => '월 280,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4455.png', 'stock' => 98, 'cat' => ['인기차종','세단','생에 첫 차']],
        ['tag' => '인기', 'name' => '현대 그랜저',     'trim' => '르블랑 2.5 가솔린',      'price' => '월 650,000원', 'price30' => '월 570,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4188.png', 'stock' => 43, 'cat' => ['인기차종','세단']],
        ['tag' => '인기', 'name' => '기아 K8',         'trim' => '노블레스 3.5 가솔린',     'price' => '월 580,000원', 'price30' => '월 510,000원', 'meta' => '선납금 0원 · 36개월', 'image' => '../cars/cdn_4665.png', 'stock' => 27, 'cat' => ['인기차종','세단']],
        ['tag' => '신차', 'name' => '기아 카니발',     'trim' => '시그니처 2.2D 9인승',     'price' => '월 720,000원', 'price30' => '월 630,000원', 'meta' => '선납금 0원 · 60개월', 'image' => '../cars/cdn_4586.png', 'stock' => 15, 'cat' => ['인기차종','SUV']],
        ['tag' => '인기', 'name' => '현대 싼타페',     'trim' => '캘리그래피 2.5T',         'price' => '월 560,000원', 'price30' => '월 490,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4435.png', 'stock' => 62, 'cat' => ['인기차종','SUV']],
        ['tag' => '인기', 'name' => '기아 스포티지',   'trim' => '시그니처 1.6T',           'price' => '월 480,000원', 'price30' => '월 420,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4684.png', 'stock' => 38, 'cat' => ['SUV','생에 첫 차']],
        ['tag' => '특가', 'name' => '현대 투싼',       'trim' => '인스퍼레이션 1.6T',       'price' => '월 430,000원', 'price30' => '월 380,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4592.png', 'stock' => 54, 'cat' => ['SUV']],
        ['tag' => '신차', 'name' => '현대 팰리세이드', 'trim' => '캘리그래피 2.2D',         'price' => '월 780,000원', 'price30' => '월 690,000원', 'meta' => '선납금 0원 · 60개월', 'image' => '../cars/cdn_4699.png', 'stock' => 9,  'cat' => ['SUV']],
        ['tag' => '인기', 'name' => '현대 아이오닉5', 'trim' => '롱레인지 2WD 인스퍼레이션', 'price' => '월 580,000원', 'price30' => '월 510,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4624.png', 'stock' => 21, 'cat' => ['전기차']],
        ['tag' => '신차', 'name' => '기아 EV6',       'trim' => '롱레인지 2WD GT-Line',    'price' => '월 620,000원', 'price30' => '월 545,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/307_4641.png', 'stock' => 14, 'cat' => ['전기차']],
        ['tag' => '특가', 'name' => '현대 캐스퍼',     'trim' => '인스퍼레이션 1.0T',       'price' => '월 250,000원', 'price30' => '월 220,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4455.png', 'stock' => 76, 'cat' => ['생에 첫 차']],
        ['tag' => '특가', 'name' => '기아 레이',       'trim' => '시그니처 1.0',            'price' => '월 230,000원', 'price30' => '월 200,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4665.png', 'stock' => 88, 'cat' => ['생에 첫 차']],
        ['tag' => '인기', 'name' => '현대 그랜저 HEV', 'trim' => '르블랑 2.5 하이브리드',    'price' => '월 680,000원', 'price30' => '월 600,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4188.png', 'stock' => 31, 'cat' => ['하이브리드','세단']],
        ['tag' => '인기', 'name' => '기아 K8 HEV',    'trim' => '노블레스 1.6T 하이브리드',  'price' => '월 610,000원', 'price30' => '월 535,000원', 'meta' => '선납금 0원 · 36개월', 'image' => '../cars/cdn_4665.png', 'stock' => 19, 'cat' => ['하이브리드','세단']],
        ['tag' => '신차', 'name' => '현대 싼타페 HEV', 'trim' => '캘리그래피 1.6T 하이브리드', 'price' => '월 590,000원', 'price30' => '월 520,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4435.png', 'stock' => 24, 'cat' => ['하이브리드','SUV']],
        ['tag' => '인기', 'name' => '기아 스포티지 HEV', 'trim' => '시그니처 1.6T 하이브리드', 'price' => '월 510,000원', 'price30' => '월 450,000원', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4684.png', 'stock' => 17, 'cat' => ['하이브리드','SUV']],
    ];
}

function get_weekly_cars(): array
{
    return [
        ...get_rental_cars(),
        ['tag' => '인기', 'name' => '기아 스포티지',   'price' => '월 480,000원~', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4684.png'],
        ['tag' => '인기', 'name' => '현대 투싼',       'price' => '월 430,000원~', 'meta' => '선납금 0원 · 48개월', 'image' => '../cars/cdn_4592.png'],
        ['tag' => '신차', 'name' => '현대 팰리세이드', 'price' => '월 780,000원~', 'meta' => '선납금 0원 · 60개월', 'image' => '../cars/cdn_4699.png'],
    ];
}

function get_popular_rental(): array
{
    return [
        ['rank' => 1,  'name' => '현대 그랜저',        'price' => '월 237,000원~', 'rate' => 34, 'img' => '../cars/cdn_4188.png'],
        ['rank' => 2,  'name' => '기아 카니발',         'price' => '월 228,000원~', 'rate' => 31, 'img' => '../cars/cdn_4586.png'],
        ['rank' => 3,  'name' => '현대 팰리세이드',     'price' => '월 272,000원~', 'rate' => 29, 'img' => '../cars/cdn_4699.png'],
        ['rank' => 4,  'name' => '르노 그랑 콜레오스',  'price' => '월 279,000원~', 'rate' => 24, 'img' => '../cars/cdn_4659.png'],
        ['rank' => 5,  'name' => '현대 싼타페',         'price' => '월 209,000원~', 'rate' => 22, 'img' => '../cars/cdn_4435.png'],
        ['rank' => 6,  'name' => '기아 스포티지',       'price' => '월 198,000원~', 'rate' => 19, 'img' => '../cars/cdn_4684.png'],
        ['rank' => 7,  'name' => '기아 K8',             'price' => '월 245,000원~', 'rate' => 17, 'img' => '../cars/cdn_4665.png'],
        ['rank' => 8,  'name' => '현대 투싼',           'price' => '월 185,000원~', 'rate' => 15, 'img' => '../cars/cdn_4592.png'],
        ['rank' => 9,  'name' => '기아 쏘렌토',         'price' => '월 221,000원~', 'rate' => 13, 'img' => '../cars/cdn_4563.png'],
        ['rank' => 10, 'name' => '현대 아반떼',         'price' => '월 167,000원~', 'rate' => 11, 'img' => '../cars/cdn_4455.png'],
    ];
}

function get_rental_banners(): array
{
    $all = [
        ['label' => '장기렌트',   'badge' => 'bg-neutral-900', 'title' => "선납금 없이, 월 납입금으로\n내 차를 타는 스마트한 방법", 'desc' => '보험료 · 세금 · 유지비 포함 / 전국 무료 배송 / 계약 12~60개월', 'button' => '무료 견적 신청',  'target' => '고객센터', 'image' => 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=1600&auto=format',         'mobCardImg' => '../cars/cdn_4188.png', 'mobIconBg' => '#eff6ff', 'hidden' => true],
        ['label' => '다이렉트 계약', 'badge' => 'bg-blue-600', 'title' => "중간 수수료 0원\n직접 계약하는 다이렉트렌트",  'desc' => '본사 직거래 · 중간 마진 없는 투명 견적 · 비대면 100% 계약',    'button' => '다이렉트 견적받기','target' => '고객센터', 'image' => 'banners/big/directp.png', 'mobImage' => 'banners/big/direct_mob.png', 'mobCardImg' => '../cars/cdn_4188.png', 'mobIconBg' => '#eff6ff', 'textDark' => true],
        ['label' => '전기차 렌트', 'badge' => 'bg-red-600',    'title' => "전기차 장기렌트\n충전비 걱정 없이 타세요",            'desc' => 'EV 보조금 적용 · 충전카드 포함 · 선납금 0원',                  'button' => '전기차 견적보기', 'target' => '고객센터', 'image' => 'banners/big/elec.png',  'mobImage' => 'banners/big/elec_mob.png',                              'mobCardImg' => '../cars/cdn_4624.png', 'mobIconBg' => '#f0fdf4', 'textDark' => true],
        ['label' => '수입차 렌트', 'badge' => 'bg-neutral-700','title' => "수입차도 월 납입금으로\n부담 없이 시작하세요",         'desc' => 'BMW · 벤츠 · 아우디 전 차종 / 보험 포함',                     'button' => '수입차 견적보기', 'target' => '고객센터', 'image' => 'banners/벥츠.jpg',                                                                    'mobCardImg' => '../cars/349_4516.png', 'mobIconBg' => '#f8fafc', 'hidden' => true],
        ['label' => 'SUV 특가',   'badge' => 'bg-neutral-600','title' => "팰리세이드 · 카니발\n가족을 위한 SUV 렌트 특가",        'desc' => '대형 SUV · 승합 전 차종 / 선납금 0원 · 보험 포함',             'button' => 'SUV 견적보기',   'target' => '고객센터', 'image' => 'banners/팰리세이드.jpg',                                                              'mobCardImg' => '../cars/cdn_4699.png', 'mobIconBg' => '#fffbeb', 'hidden' => true],
        ['label' => '한정 특가',   'badge' => 'bg-red-700',    'title' => "이번 주 한정 재고 특가\n지금 바로 출고 가능",            'desc' => '소진 시 즉시 종료 · 월 납입금 최저가 보장',                    'button' => '특가 보러가기',  'target' => '고객센터', 'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1600&auto=format',     'mobCardImg' => '../cars/cdn_4665.png', 'mobIconBg' => '#fff1f2', 'hidden' => true],
    ];
    // 'hidden' => true 슬라이드는 캐러셀에서 제외. 나중에 다시 보이게 하려면 해당 라인의 'hidden' => true 만 제거.
    return array_values(array_filter($all, fn($b) => empty($b['hidden'])));
}

function get_special_general_cars(): array
{
    return [
        ['tag' => '특가', 'name' => '현대 아반떼',     'price' => '월 299,000원~', 'meta' => '선납금 0원 · 48개월 · 즉시출고', 'img' => '../cars/cdn_4455.png'],
        ['tag' => '특가', 'name' => '현대 그랜저',     'price' => '월 599,000원~', 'meta' => '선납금 0원 · 48개월 · 즉시출고', 'img' => '../cars/cdn_4188.png'],
        ['tag' => '특가', 'name' => '기아 K8',         'price' => '월 549,000원~', 'meta' => '선납금 0원 · 36개월 · 즉시출고', 'img' => '../cars/cdn_4665.png'],
        ['tag' => '특가', 'name' => '기아 카니발',     'price' => '월 680,000원~', 'meta' => '선납금 0원 · 60개월 · 즉시출고', 'img' => '../cars/cdn_4586.png'],
        ['tag' => '특가', 'name' => '현대 싼타페',     'price' => '월 520,000원~', 'meta' => '선납금 0원 · 48개월 · 즉시출고', 'img' => '../cars/cdn_4435.png'],
        ['tag' => '특가', 'name' => '기아 스포티지',   'price' => '월 449,000원~', 'meta' => '선납금 0원 · 48개월 · 즉시출고', 'img' => '../cars/cdn_4684.png'],
        ['tag' => '특가', 'name' => '현대 투싼',       'price' => '월 399,000원~', 'meta' => '선납금 0원 · 48개월 · 즉시출고', 'img' => '../cars/cdn_4592.png'],
        ['tag' => '특가', 'name' => '현대 팰리세이드', 'price' => '월 730,000원~', 'meta' => '선납금 0원 · 60개월 · 즉시출고', 'img' => '../cars/cdn_4699.png'],
    ];
}

function get_special_ev_cars(): array
{
    return [
        ['tag' => 'EV', 'name' => '현대 아이오닉 5',   'price' => '월 480,000원~', 'meta' => '보조금 적용 · 선납금 0원 · 48개월', 'img' => '../cars/cdn_4624.png'],
        ['tag' => 'EV', 'name' => '현대 아이오닉 6 N', 'price' => '월 560,000원~', 'meta' => '보조금 적용 · 선납금 0원 · 48개월', 'img' => '../cars/303_4742.png'],
        ['tag' => 'EV', 'name' => '현대 아이오닉 9',   'price' => '월 720,000원~', 'meta' => '보조금 적용 · 선납금 0원 · 60개월', 'img' => '../cars/303_4088.png'],
        ['tag' => 'EV', 'name' => '기아 EV6',          'price' => '월 510,000원~', 'meta' => '보조금 적용 · 선납금 0원 · 48개월', 'img' => '../cars/307_4641.png'],
        ['tag' => 'EV', 'name' => '기아 EV9',          'price' => '월 680,000원~', 'meta' => '보조금 적용 · 선납금 0원 · 60개월', 'img' => '../cars/307_4128.png'],
        ['tag' => 'EV', 'name' => '기아 EV3',          'price' => '월 380,000원~', 'meta' => '보조금 적용 · 선납금 0원 · 48개월', 'img' => '../cars/307_4647.png'],
        ['tag' => 'EV', 'name' => '캐스퍼 일렉트릭',   'price' => '월 320,000원~', 'meta' => '보조금 적용 · 선납금 0원 · 48개월', 'img' => '../cars/cdn_4653.png'],
        ['tag' => 'EV', 'name' => '테슬라 모델Y',      'price' => '월 650,000원~', 'meta' => '보조금 적용 · 선납금 0원 · 48개월', 'img' => '../cars/cdn_4667.png'],
    ];
}

function get_ev_cars(): array
{
    return get_special_ev_cars();
}

function get_import_cars(): array
{
    return [
        ['tag' => '수입', 'name' => 'BMW 5시리즈',    'price' => '월 1,180,000원~', 'meta' => '풀옵션 · 선납금 0원 · 60개월', 'img' => '../cars/349_2380.png'],
        ['tag' => '수입', 'name' => '벤츠 E-클래스',  'price' => '월 1,250,000원~', 'meta' => '풀옵션 · 선납금 0원 · 60개월', 'img' => '../cars/349_2383.png'],
        ['tag' => '수입', 'name' => '아우디 A6',      'price' => '월 1,080,000원~', 'meta' => '풀옵션 · 선납금 0원 · 60개월', 'img' => '../cars/349_2385.png'],
        ['tag' => '수입', 'name' => 'BMW X3',         'price' => '월 1,150,000원~', 'meta' => '풀옵션 · 선납금 0원 · 60개월', 'img' => '../cars/349_2388.png'],
        ['tag' => '수입', 'name' => '벤츠 GLC',       'price' => '월 1,280,000원~', 'meta' => '풀옵션 · 선납금 0원 · 60개월', 'img' => '../cars/349_2391.png'],
        ['tag' => '수입', 'name' => '아우디 Q5',      'price' => '월 1,050,000원~', 'meta' => '풀옵션 · 선납금 0원 · 60개월', 'img' => '../cars/349_2394.png'],
        ['tag' => '수입', 'name' => '미니 쿠퍼',      'price' => '월 720,000원~',   'meta' => '풀옵션 · 선납금 0원 · 60개월', 'img' => '../cars/349_2397.png'],
        ['tag' => '수입 EV', 'name' => '테슬라 모델Y','price' => '월 650,000원~',   'meta' => '보조금 적용 · 선납금 0원 · 48개월', 'img' => '../cars/cdn_4667.png'],
    ];
}

function get_biz_cars(): array
{
    return [
        // 9인승 이상 승합/미니버스 — 부가세 환급
        ['tag' => '9인승+',  'name' => '기아 카니발 9인승',   'price' => '월 620,000원~',  'meta' => '부가세 환급 · 9인승 · 60개월',          'img' => '../cars/cdn_4586.png'],
        ['tag' => '9인승+',  'name' => '현대 스타리아 9인승', 'price' => '월 560,000원~',  'meta' => '부가세 환급 · 9~11인승 · 60개월',       'img' => '../cars/303_4014.png'],
        ['tag' => '미니버스','name' => '현대 솔라티',         'price' => '월 1,180,000원~','meta' => '부가세 환급 · 15인승 · 60개월',         'img' => '../cars/303_3297.png'],
        // 경차 — 부가세 환급
        ['tag' => '경차',    'name' => '기아 레이',           'price' => '월 240,000원~',  'meta' => '부가세 환급 · 1,000cc · 48개월',        'img' => '../cars/307_4689.png'],
        ['tag' => '경차 EV', 'name' => '기아 레이 EV',        'price' => '월 280,000원~',  'meta' => '부가세 환급 · 전기 경차 · 48개월',      'img' => '../cars/307_4691.png'],
        ['tag' => '경차',    'name' => '현대 캐스퍼',         'price' => '월 250,000원~',  'meta' => '부가세 환급 · 1,000cc · 48개월',        'img' => '../cars/cdn_4671.png'],
        ['tag' => '경차 EV', 'name' => '캐스퍼 일렉트릭',     'price' => '월 320,000원~',  'meta' => '부가세 환급 · 보조금 적용 · 48개월',    'img' => '../cars/cdn_4653.png'],
        ['tag' => '경차',    'name' => '기아 모닝',           'price' => '월 220,000원~',  'meta' => '부가세 환급 · 1,000cc · 48개월',        'img' => '../cars/cdn_4554.png'],
        // 1톤 트럭 / 화물 — 부가세 환급
        ['tag' => '트럭',    'name' => '현대 포터2',          'price' => '월 360,000원~',  'meta' => '부가세 환급 · 1톤 트럭 · 48개월',       'img' => '../cars/303_1901.png'],
        ['tag' => '트럭 EV', 'name' => '현대 포터2 일렉트릭', 'price' => '월 480,000원~',  'meta' => '부가세 환급 · 보조금 적용 · 48개월',    'img' => '../cars/303_4399.png'],
        ['tag' => '트럭',    'name' => '기아 봉고3',          'price' => '월 360,000원~',  'meta' => '부가세 환급 · 1톤 트럭 · 48개월',       'img' => '../cars/307_3772.png'],
        ['tag' => '트럭 EV', 'name' => '기아 봉고3 EV',       'price' => '월 480,000원~',  'meta' => '부가세 환급 · 보조금 적용 · 48개월',    'img' => '../cars/307_4404.png'],
        // 중형 트럭
        ['tag' => '대형',    'name' => '현대 마이티',         'price' => '월 720,000원~',  'meta' => '부가세 환급 · 중형 트럭 · 60개월',      'img' => '../cars/303_3502.png'],
    ];
}

