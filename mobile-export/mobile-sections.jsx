// Mobile sections — each is a self-contained React component
const { useState, useEffect, useRef } = React;

// ─────────────────────────────────────────────────────────────
// Hero carousel — auto-rotating with progress bar
// ─────────────────────────────────────────────────────────────
const HERO_SLIDES = [
  {
    chip: '장기렌트',
    title: <>선납금 0원,<br/><strong>월 납입금만</strong>으로</>,
    img: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200&q=80',
    meta: ['보험·세금 포함', '계약 12~60개월'],
  },
  {
    chip: '한정특가',
    title: <>이번 주 <strong>한정재고</strong><br/>최대 28% 할인</>,
    img: 'https://images.unsplash.com/photo-1542362567-b07e54358753?w=1200&q=80',
    meta: ['10월 15일까지', '한정 수량'],
  },
  {
    chip: '전기차',
    title: <><strong>전기차 보조금</strong>까지<br/>월 32만원부터</>,
    img: 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?w=1200&q=80',
    meta: ['보조금 + 0원 선납', '충전 크레딧 제공'],
  },
];

function Hero() {
  const [idx, setIdx] = useState(0);
  const [progress, setProgress] = useState(0);
  const [paused, setPaused] = useState(false);
  useEffect(() => {
    if (paused) return;
    setProgress(0);
    const dur = 4800;
    const start = performance.now();
    let raf;
    const tick = (t) => {
      const p = Math.min(1, (t - start) / dur);
      setProgress(p * 100);
      if (p < 1) raf = requestAnimationFrame(tick);
      else setIdx((i) => (i + 1) % HERO_SLIDES.length);
    };
    raf = requestAnimationFrame(tick);
    return () => cancelAnimationFrame(raf);
  }, [idx, paused]);

  return (
    <div className="hero">
      <div className="hero-card">
        {HERO_SLIDES.map((s, i) => (
          <div key={i} className="hero-slide" style={{
            backgroundImage: `url(${s.img})`,
            opacity: i === idx ? 1 : 0,
          }} />
        ))}
        <div className="hero-content">
          <span className="hero-chip">{HERO_SLIDES[idx].chip}</span>
          <div className="hero-title">{HERO_SLIDES[idx].title}</div>
          <div className="hero-meta">
            {HERO_SLIDES[idx].meta.map((m, j) => (
              <React.Fragment key={j}>
                {j > 0 && <span className="dot"/>}
                <span>{m}</span>
              </React.Fragment>
            ))}
          </div>
        </div>
        <div className="hero-progress">
          {HERO_SLIDES.map((_, i) => (
            <div key={i}
              className={`hp-bar ${i < idx ? 'done' : i === idx ? 'active' : 'idle'}`}
              style={i === idx ? { '--p': `${progress}%` } : {}}
              onClick={() => setIdx(i)} />
          ))}
          <span className="hp-counter">{String(idx + 1).padStart(2,'0')} / {String(HERO_SLIDES.length).padStart(2,'0')}</span>
          <button onClick={() => setPaused(p => !p)} style={{ color: '#fff', opacity: 0.8, marginLeft: 4 }}>
            {paused
              ? <svg width="11" height="11" viewBox="0 0 12 12" fill="currentColor"><path d="M3 1.5L11 6 3 10.5z"/></svg>
              : <svg width="10" height="11" viewBox="0 0 10 12" fill="currentColor"><rect x="0" y="0" width="3" height="12" rx="0.5"/><rect x="7" y="0" width="3" height="12" rx="0.5"/></svg>
            }
          </button>
        </div>
      </div>
    </div>
  );
}

// ─────────────────────────────────────────────────────────────
// Benefits strip
// ─────────────────────────────────────────────────────────────
function Benefits() {
  return (
    <div className="benefits">
      <div className="benefit">
        <div className="benefit-ic">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
            <path d="M12 2v6M12 22v-2M2 12h6M22 12h-2M5 5l3 3M16 16l3 3M5 19l3-3M16 8l3-3"/>
          </svg>
        </div>
        <div>
          <div className="benefit-lbl">선납금</div>
          <div className="benefit-val">0원</div>
        </div>
      </div>
      <div className="benefit" style={{ borderLeft: '1px solid var(--line)', paddingLeft: 14 }}>
        <div className="benefit-ic">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
            <rect x="1" y="6" width="15" height="13" rx="2"/><polygon points="16 8 20 8 23 11 23 19 16 19"/><circle cx="6" cy="20" r="2"/><circle cx="18" cy="20" r="2"/>
          </svg>
        </div>
        <div>
          <div className="benefit-lbl">전국</div>
          <div className="benefit-val">무료 배송</div>
        </div>
      </div>
      <div className="benefit" style={{ borderLeft: '1px solid var(--line)', paddingLeft: 14 }}>
        <div className="benefit-ic">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
            <path d="M12 22s8-4 8-10V4l-8-2-8 2v8c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>
          </svg>
        </div>
        <div>
          <div className="benefit-lbl">보험·세금</div>
          <div className="benefit-val">전부 포함</div>
        </div>
      </div>
    </div>
  );
}

// ─────────────────────────────────────────────────────────────
// Quick actions tiles
// ─────────────────────────────────────────────────────────────
function QuickActions() {
  const tiles = [
    { lbl: '월렌트료\n계산기', ic: '🧮', cls: 'brand' },
    { lbl: '차량\n검색', ic: '🔍' },
    { lbl: '전기차\n특가', ic: '⚡', cls: 'ev' },
    { lbl: '내 견적\n관리', ic: '📋' },
  ];
  return (
    <div className="quick">
      {tiles.map((t, i) => (
        <button key={i} className={`quick-tile ${t.cls || ''}`}>
          <div className="quick-ic">{t.ic}</div>
          <div className="quick-lbl" style={{ whiteSpace: 'pre-line', textAlign: 'center', lineHeight: 1.3 }}>{t.lbl}</div>
        </button>
      ))}
    </div>
  );
}

// ─────────────────────────────────────────────────────────────
// Fast delivery (빠른출고 한정재고)
// ─────────────────────────────────────────────────────────────
const FD_CATS = ['인기차종', 'SUV', '세단', '전기차', '하이브리드', '생애 첫 차'];
const FD_ITEMS = [
  { name: '현대 아반떼', trim: '프리미엄 · 인스퍼레이션 터보', price: '280,000', stock: 98, car: <CarSedan tone="silver"/>, hot: false },
  { name: '현대 그랜저', trim: '캘리그래피 · 아틀라스 화이트', price: '570,000', stock: 43, car: <CarSedan tone="silver"/>, hot: false },
  { name: '기아 K8', trim: '시그니처 · 스노우 화이트펄', price: '510,000', stock: 27, car: <CarSedan tone="brown"/>, hot: false },
  { name: '기아 카니발', trim: '시그니처 · 그래비티 그레이', price: '630,000', stock: 8, car: <CarVan tone="silver"/>, hot: true, low: true },
  { name: '현대 싼타페', trim: '캘리그래피 · 어비스 블랙펄', price: '490,000', stock: 62, car: <CarSUV tone="dark"/>, hot: false },
];

function FastDelivery() {
  const [cat, setCat] = useState('인기차종');
  return (
    <section>
      <div className="section-head">
        <div>
          <div className="section-title"><span className="accent">빠른출고</span> 한정재고</div>
          <div className="section-sub">오늘 즉시 출고 가능한 차량만</div>
        </div>
      </div>
      <div className="chips-row">
        {FD_CATS.map(c => (
          <button key={c} className={`pill ${c === cat ? 'dark' : 'outline'}`} onClick={() => setCat(c)}>{c}</button>
        ))}
      </div>
      <div className="fd-list">
        {FD_ITEMS.map((it, i) => (
          <div key={i} className="fd-card">
            <div className="fd-card-inner">
              <div className="fd-img">{it.car}</div>
              <div className="fd-info">
                <div className="fd-trim">{it.trim}</div>
                <div className="fd-name">{it.name}</div>
                <div className="fd-price">월 {it.price}<small>원</small></div>
                <div className="fd-pricesub">선납 0원 · 48개월</div>
              </div>
            </div>
            <div className={`fd-stock ${it.low ? 'low' : ''} ${it.hot ? 'hot' : ''}`}>{it.stock}대</div>
          </div>
        ))}
      </div>
      <button className="fd-more">
        빠른출고 차량 전체보기
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </button>
    </section>
  );
}

// ─────────────────────────────────────────────────────────────
// Time deal — countdown with animated streaks
// ─────────────────────────────────────────────────────────────
function useCountdown(initialSec) {
  const [s, setS] = useState(initialSec);
  useEffect(() => {
    const t = setInterval(() => setS(v => v > 0 ? v - 1 : initialSec), 1000);
    return () => clearInterval(t);
  }, []);
  const h = Math.floor(s / 3600);
  const m = Math.floor((s % 3600) / 60);
  const sec = s % 60;
  return { h, m, s: sec };
}

function TimeDeal() {
  const { h, m, s } = useCountdown(12 * 3600 + 23 * 60 + 54);
  return (
    <div className="timedeal-wrap">
      <div className="timedeal">
        <div className="td-head">
          <div className="td-head-line"/>
          <div className="td-title"><span className="td-bolt">⚡</span> 타임딜</div>
          <div className="td-head-line"/>
        </div>
        <div className="td-sub">오늘 차량재고만 · 선착순 마감</div>

        <div className="td-counter">
          <div className="td-cell">
            <div className="td-num">{String(h).padStart(2,'0')}</div>
            <div className="td-lbl">HOURS</div>
          </div>
          <div className="td-cell">
            <div className="td-num">{String(m).padStart(2,'0')}</div>
            <div className="td-lbl">MINUTES</div>
          </div>
          <div className="td-cell">
            <div className="td-num">{String(s).padStart(2,'0')}</div>
            <div className="td-lbl">SECONDS</div>
          </div>
        </div>

        <div className="td-scene">
          <span className="td-streak s1"/>
          <span className="td-streak s2"/>
          <span className="td-streak s3"/>
          <span className="td-streak s4"/>
          <span className="td-streak s5"/>
          <div className="td-glow"/>
          <div className="td-car"><CarCompact tone="green"/></div>
          <div className="td-floor"/>
        </div>

        <div className="td-info">
          <div>
            <div className="td-info-name">현대 캐스퍼 일렉트릭</div>
            <div className="td-info-price">월 <b>380,000원</b>~ · 선납금 0원</div>
          </div>
          <div className="td-info-tag">-28%</div>
        </div>

        <button className="td-cta">
          지금 혜택 신청
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>
  );
}

// ─────────────────────────────────────────────────────────────
// Popular vehicles (인기 차량)
// ─────────────────────────────────────────────────────────────
const POP_ITEMS = [
  { rank: 1, name: '현대 그랜저', price: '237,000', car: <CarSedan tone="silver"/>, trim: '캘리그래피' },
  { rank: 2, name: '기아 카니발', price: '228,000', car: <CarVan tone="silver"/>, trim: '시그니처' },
  { rank: 3, name: '현대 팰리세이드', price: '272,000', car: <CarSUV tone="dark"/>, trim: '캘리그래피' },
  { rank: 4, name: '르노 그랑 콜레오스', price: '279,000', car: <CarSUV tone="silver"/>, trim: '에스프리 알핀' },
  { rank: 5, name: '현대 싼타페', price: '209,000', car: <CarSUV tone="brown"/>, trim: '캘리그래피' },
];

function PopularVehicles() {
  return (
    <section>
      <div className="section-head">
        <div>
          <div className="section-title">인기 차량</div>
          <div className="section-sub">이번 달 가장 많이 선택한 차량</div>
        </div>
        <a className="section-more">전체 ›</a>
      </div>
      <div className="pop-scroll">
        {POP_ITEMS.map(it => (
          <div key={it.rank} className="pop-card">
            <div className="pop-rank">{it.rank}</div>
            <div className="pop-img">{it.car}</div>
            <div className="pop-body">
              <div className="pop-name">{it.name}</div>
              <div className="pop-price">월 {it.price}<small>원~</small></div>
              <div className="pop-tags">
                <span className="tag">{it.trim}</span>
                <span className="tag">선납 0원</span>
              </div>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}

// ─────────────────────────────────────────────────────────────
// EV special — charge animation on scroll into view
// ─────────────────────────────────────────────────────────────
function EVSpecial() {
  const ref = useRef(null);
  const [active, setActive] = useState(false);
  useEffect(() => {
    const obs = new IntersectionObserver(([e]) => {
      if (e.isIntersecting) setActive(true);
    }, { threshold: 0.3 });
    if (ref.current) obs.observe(ref.current);
    return () => obs.disconnect();
  }, []);
  return (
    <div ref={ref} className="ev-card" style={{ minHeight: 220 }}>
      <div className="ev-card-top">
        <span style={{ color: 'var(--ev)', fontSize: 16 }}>⚡</span>
        <span className="ev-tag">친환경 전기차</span>
      </div>
      <div className="ev-title">특가차량</div>
      <div className="ev-sub" style={{ maxWidth: 200 }}>지금 바로 전기차 렌트<br/>보조금 + 선납금 0원</div>
      <div className="ev-meter">
        <div className={`ev-bar ${active ? 'active' : ''}`}><i/></div>
        <div className="ev-charge">
          <span>{active ? 'Charging...' : 'Standby'}</span>
          <span>{active ? '78%' : '0%'}</span>
        </div>
      </div>
      <button className="ev-cta">
        전기차 특가 보기
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </button>
      <div className="ev-car-img" style={{ width: 180, right: -14, bottom: 22 }}>
        <CarEV tone="silver" glow={active} shadow={false}/>
      </div>
    </div>
  );
}

// ─────────────────────────────────────────────────────────────
// Weekly Korean car specials (이번 주 국산차 특가)
// ─────────────────────────────────────────────────────────────
const WK_ITEMS = [
  { name: '현대 아반떼', price: '320,000', meta: '선납 0원 · 48개월', badge: '특가', car: <CarSedan tone="silver"/> },
  { name: '현대 그랜저', price: '650,000', meta: '선납 0원 · 48개월', badge: '인기', car: <CarSedan tone="silver"/>, badgeCls: 'hot' },
  { name: '기아 K8', price: '480,000', meta: '선납 0원 · 48개월', badge: '특가', car: <CarSedan tone="brown"/> },
  { name: '기아 카니발', price: '590,000', meta: '선납 0원 · 48개월', badge: 'EV', car: <CarSUV tone="silver"/>, badgeCls: 'ev' },
];

function WeeklySpecials() {
  return (
    <section>
      <div className="section-head">
        <div>
          <div className="section-title">이번 주 국산차 특가</div>
          <div className="section-sub">선납금 0원, 월 납입금 패키지 포함</div>
        </div>
        <a className="section-more">전체 ›</a>
      </div>
      <div className="wk-grid">
        {WK_ITEMS.map((it, i) => (
          <div key={i} className="wk-card">
            <div className="wk-img">
              <span className={`wk-badge ${it.badgeCls || ''}`}>{it.badge}</span>
              {it.car}
            </div>
            <div className="wk-name">{it.name}</div>
            <div className="wk-price">월 {it.price}<span style={{fontSize: 11, color: 'var(--mute)', fontWeight: 500}}>원</span></div>
            <div className="wk-meta">{it.meta}</div>
            <button className="wk-cta">견적 신청하기</button>
          </div>
        ))}
      </div>
    </section>
  );
}

// ─────────────────────────────────────────────────────────────
// Consultation form
// ─────────────────────────────────────────────────────────────
function Consultation() {
  const [name, setName] = useState('');
  const [phone, setPhone] = useState('');
  const [model, setModel] = useState('');
  const [agree, setAgree] = useState(false);
  const [focus, setFocus] = useState(null);

  const field = (key, v, set, placeholder, opts = {}) => (
    <div
      className={`cs-field ${v ? 'has' : ''} ${focus === key ? 'focus' : ''} ${opts.select ? 'select' : ''}`}
      onClick={() => {
        if (opts.select) {
          const choice = prompt('관심 차량을 입력해주세요', v || '');
          if (choice) set(choice);
        } else {
          setFocus(key);
          const input = document.getElementById('cs-' + key);
          if (input) input.focus();
        }
      }}
    >
      {opts.select ? (
        <>
          <span>{v || placeholder}</span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M6 9l6 6 6-6"/></svg>
        </>
      ) : (
        <input
          id={'cs-' + key}
          value={v}
          onChange={e => set(e.target.value)}
          onFocus={() => setFocus(key)}
          onBlur={() => setFocus(null)}
          placeholder={placeholder}
          style={{
            border: 'none', outline: 'none', width: '100%',
            fontSize: 14, background: 'transparent', color: 'inherit',
            fontFamily: 'inherit',
          }}
        />
      )}
    </div>
  );

  return (
    <div className="cs-section">
      <div className="cs-eyebrow">FREE CONSULTATION</div>
      <div className="cs-title">장기렌트,<br/>아직 고민 중이신가요?</div>
      <div className="cs-sub">전문 상담사가 최적 차량을<br/>빠르게 안내해드립니다.</div>
      <div className="cs-meta">
        <span><i className="dot"/> 평일 09:00 - 18:00</span>
        <span>· 평균 응답 4분</span>
      </div>

      <div className="cs-form">
        {field('name', name, setName, '성함을 입력해주세요')}
        {field('phone', phone, setPhone, '휴대폰 번호를 입력해주세요')}
        {field('model', model, setModel, '관심 차량을 선택해주세요', { select: true })}

        <div className="cs-agree" onClick={() => setAgree(!agree)}>
          <div className={`cb ${agree ? 'on' : ''}`}>
            {agree && <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3"><path d="M5 12l5 5L20 7"/></svg>}
          </div>
          <span>개인정보 수집 및 이용에 동의합니다 (필수)</span>
        </div>

        <button className="cs-submit">
          무료 상담 신청하기
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>

      <div className="cs-aux">
        <div className="cs-aux-card">
          <div className="cs-aux-title">📞 전화 상담</div>
          <div className="cs-aux-desc">바로 통화로<br/>안내받기</div>
          <div className="cs-aux-link" style={{ color: '#FF8B95' }}>1588-0000 ›</div>
        </div>
        <div className="cs-aux-card">
          <div className="cs-aux-title">💬 카카오톡</div>
          <div className="cs-aux-desc">채팅으로<br/>빠르게 문의</div>
          <div className="cs-aux-link">카톡 상담 ›</div>
        </div>
      </div>
    </div>
  );
}

// ─────────────────────────────────────────────────────────────
// Footer
// ─────────────────────────────────────────────────────────────
function Footer() {
  return (
    <footer>
      <div className="f-brand">CHABOZA</div>
      <div className="f-row">
        <a>회사소개</a>
        <a>이용약관</a>
        <a>개인정보처리방침</a>
      </div>
      <div>
        주식회사 차보자 · 대표 홍길동 · 사업자등록번호 000-00-00000
        <br/>서울특별시 강남구 테헤란로 000 · 1588-0000
        <br/>© 2026 CHABOZA Inc.
      </div>
    </footer>
  );
}

// Bottom tab bar
function TabBar() {
  const [active, setActive] = useState('home');
  const items = [
    { k: 'home',  l: '홈',     ic: <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M3 12l9-9 9 9M5 10v10h14V10"/></svg> },
    { k: 'find',  l: '차량검색', ic: <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-5-5"/></svg> },
    { k: 'fast',  l: '빠른출고', ic: <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L4 14h6l-1 8 9-12h-6l1-8z"/></svg> },
    { k: 'quote', l: '내 견적',  ic: <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/></svg> },
    { k: 'me',    l: '마이',    ic: <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-7 8-7s8 3 8 7"/></svg> },
  ];
  return (
    <div className="tabbar">
      {items.map(it => (
        <button key={it.k} className={`tb ${active === it.k ? 'active' : ''}`} onClick={() => setActive(it.k)}>
          <div className="tb-ic">{it.ic}</div>
          <div>{it.l}</div>
        </button>
      ))}
    </div>
  );
}

Object.assign(window, {
  Hero, Benefits, QuickActions, FastDelivery, TimeDeal, PopularVehicles,
  EVSpecial, WeeklySpecials, Consultation, Footer, TabBar,
});
