/* ===================== COMPONENTS.JS ===================== */

function CarDriveIn({ src, alt, className, style }) {
  const ref = React.useRef(null);
  const [go, setGo] = React.useState(false);
  React.useEffect(() => {
    if (!ref.current) return;
    const obs = new IntersectionObserver(([e]) => {
      if (e.isIntersecting) { setGo(true); obs.disconnect(); }
    }, { threshold: 0.4 });
    obs.observe(ref.current);
    return () => obs.disconnect();
  }, []);
  return (
    <img ref={ref} src={src} alt={alt}
      className={`${className} ${go ? 'car-drive-in' : 'opacity-0'}`}
      style={style} />
  );
}

function Icon({ name, size = 18, className = "" }) {
  return (
    <span aria-hidden="true"
      className={`inline-flex items-center justify-center leading-none ${className}`}
      style={{ width: size, height: size, fontSize: size }}>
      {ICONS[name] || "•"}
    </span>
  );
}

function Placeholder({ dark = false, label, className = "", src }) {
  if (src) return <img src={src} alt="" className={`object-cover ${className}`} />;
  return (
    <div className={`flex items-center justify-center ${dark ? "bg-neutral-700" : "bg-slate-200"} ${className}`}>
      {label && <span className="text-xs font-bold text-white/80">{label}</span>}
    </div>
  );
}

function Button({ children, dark = true, className = "", onClick }) {
  return (
    <button onClick={onClick}
      className={`${dark ? "bg-neutral-900 text-white hover:bg-red-600" : "bg-white text-neutral-900 hover:bg-neutral-100"} inline-flex items-center justify-center gap-2 px-7 py-3 text-sm font-bold transition ${className}`}>
      {children}
    </button>
  );
}

function SectionHeader({ eyebrow, title, desc, right, big = false }) {
  return (
    <div className="mb-8 flex items-end justify-between gap-4">
      <div>
        {eyebrow && <p className="mb-2 text-sm font-bold text-neutral-500">{eyebrow}</p>}
        <h2 className={`${big ? "text-6xl" : "text-3xl"} font-black tracking-tight text-neutral-950`}>{title}</h2>
        {desc && <p className="mt-2 text-sm font-semibold text-neutral-400">{desc}</p>}
      </div>
      {right && <div className="text-sm font-bold text-neutral-500">{right}</div>}
    </div>
  );
}

function QuickTabs({ tabs }) {
  return (
    <div className="border-b border-neutral-200 bg-white">
      <div className="mx-auto flex max-w-7xl overflow-x-auto px-4">
        {tabs.map((tab, idx) =>
          <button key={tab} className={`min-w-fit px-8 py-4 text-sm font-bold whitespace-nowrap ${idx === 0 ? "border-b-4 border-neutral-900 text-neutral-950" : "text-neutral-500"}`}>{tab}</button>
        )}
      </div>
    </div>
  );
}

function CarCard({ item, button = "견적 신청하기", tall = false }) {
  return (
    <article className="border border-neutral-200 bg-white">
      <Placeholder src={item.image} className={tall ? "h-72" : "h-48"} />
      <div className="p-5">
        {(item.tag || item.type) && <span className="mb-3 inline-flex bg-neutral-800 px-3 py-1 text-xs font-black text-white">{item.tag || item.type}</span>}
        <h3 className="font-black text-neutral-950">{item.name}</h3>
        <p className="mt-1 font-black text-neutral-950">{item.price}</p>
        <p className="mt-1 text-sm font-semibold text-neutral-500">{item.meta}</p>
        {button && <button className="mt-8 w-full bg-neutral-900 py-3 text-sm font-bold text-white transition hover:bg-red-600">{button}</button>}
      </div>
    </article>
  );
}

function ProductCard({ item }) {
  return (
    <article className="border border-neutral-200 bg-white">
      <Placeholder src={item.image} className="h-44" />
      <div className="p-5">
        <h3 className="text-sm font-black text-neutral-950">{item.name}</h3>
        <p className="mt-1 text-xs font-bold text-neutral-700">{item.rating}</p>
        <p className="mt-1 text-sm font-black text-neutral-950">{item.price}</p>
        <button className="mt-7 w-full bg-neutral-900 py-3 text-xs font-bold text-white transition hover:bg-red-600">시공점 예약 · 구매하기</button>
      </div>
    </article>
  );
}

function ConsultationBand({ title, desc }) {
  return (
    <section className="bg-neutral-900 py-16 text-white">
      <div className="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-6 md:grid-cols-[1.3fr_.8fr] md:items-center">
        <div>
          <h2 className="mb-3 text-4xl font-black">{title}</h2>
          <p className="font-semibold text-neutral-400">{desc}</p>
          <div className="mt-8 grid gap-4 bg-white p-8 md:grid-cols-2">
            <input className="border border-neutral-200 px-5 py-4 text-sm text-neutral-900" placeholder="성함을 입력해주세요" />
            <input className="border border-neutral-200 px-5 py-4 text-sm text-neutral-900" placeholder="휴대폰 번호를 입력해주세요" />
            <input className="border border-neutral-200 px-5 py-4 text-sm text-neutral-900 md:col-span-2" placeholder="관심 차량을 선택해주세요" />
            <button className="bg-neutral-900 py-4 text-sm font-black text-white md:col-span-2">무료 상담 신청하기</button>
          </div>
        </div>
        <div className="bg-neutral-700 p-10">
          <p className="mb-5 text-lg font-bold text-white">전화 상담</p>
          <p className="mb-2 text-5xl font-black text-white">1661-3583</p>
          <p className="mb-8 text-sm text-neutral-300">평일 09:00 ~ 18:00 (주말·공휴일 휴무)</p>
          <button className="bg-neutral-400 px-10 py-4 text-sm font-bold text-white"><Icon name="chat" className="mr-2" size={16} />카카오 상담</button>
        </div>
      </div>
    </section>
  );
}

function SubCarousel({ banners, setActive }) {
  const [current, setCurrent] = React.useState(0);
  const [progress, setProgress] = React.useState(0);
  const DURATION = 4500;

  React.useEffect(() => {
    setProgress(0);
    let start = null, raf;
    const tick = ts => {
      if (!start) start = ts;
      const p = Math.min((ts - start) / DURATION, 1);
      setProgress(p);
      if (p < 1) raf = requestAnimationFrame(tick);
    };
    raf = requestAnimationFrame(tick);
    const t = window.setInterval(() => {
      setCurrent(i => wrapIndex(i, 1, banners.length));
      start = null;
    }, DURATION);
    return () => { window.clearInterval(t); cancelAnimationFrame(raf); };
  }, [current]);

  const move = d => setCurrent(i => wrapIndex(i, d, banners.length));
  return (
    <section className="relative overflow-hidden bg-white py-4">
      <div className="relative mx-auto max-w-[1600px] overflow-hidden" style={{ height: 460 }}>
        {banners.map((banner, index) => {
          let offset = index - current;
          if (offset > banners.length / 2) offset -= banners.length;
          if (offset < -banners.length / 2) offset += banners.length;
          const isActive = offset === 0, visible = Math.abs(offset) <= 1;
          const aw = 70, sw = 22;
          const lp = 50 + offset * (aw / 2 + sw / 2 + 1);
          return (
            <button key={banner.title}
              onClick={() => isActive ? setActive(banner.target) : setCurrent(index)}
              className={`absolute top-6 h-[400px] overflow-hidden text-left transition-all duration-700 ease-out ${visible ? "opacity-100" : "pointer-events-none opacity-0"}`}
              style={{ left: `${lp}%`, width: isActive ? `${aw}%` : `${sw}%`, transform: `translateX(-50%) scale(${isActive ? 1 : 0.85})`, zIndex: isActive ? 20 : 10, filter: isActive ? "none" : "saturate(0.7)" }}
              aria-label={banner.label}>
              {banner.image && <img src={banner.image} alt={banner.label} className="absolute inset-0 w-full h-full object-cover" />}
              <div className="absolute inset-0" style={{ background: isActive ? "linear-gradient(to right, rgba(0,0,0,0.72) 40%, rgba(0,0,0,0.15) 100%)" : "rgba(0,0,0,0.45)" }} />
              {isActive ? (
                <div className="relative z-10 px-16 py-12">
                  <span className={`mb-4 inline-flex w-fit px-4 py-1.5 text-sm font-black text-white ${banner.badge}`}>{banner.label}</span>
                  <h1 className="whitespace-pre-line text-4xl font-black leading-tight text-white">{banner.title}</h1>
                  <p className="mt-3 text-sm font-bold text-neutral-300">{banner.desc}</p>
                  <span className="mt-6 inline-flex w-fit items-center gap-2 bg-white text-neutral-900 px-6 py-2.5 text-sm font-black">{banner.button} <Icon name="arrow" size={14} /></span>
                </div>
              ) : (
                <div className="absolute bottom-0 left-0 right-0 z-10 px-6 py-6">
                  <span className={`mb-2 inline-flex w-fit px-2 py-1 text-xs font-black text-white ${banner.badge}`}>{banner.label}</span>
                  <p className="whitespace-pre-line text-sm font-black leading-snug text-white">{banner.title}</p>
                </div>
              )}
            </button>
          );
        })}
        <button onClick={() => move(-1)} className="absolute top-1/2 z-30 -translate-y-1/2 p-3 transition opacity-70 hover:opacity-100" style={{ left: `calc(15% + 16px)` }} aria-label="이전">
          <span style={{ display:'inline-block', width:14, height:14, borderLeft:'3px solid #fff', borderBottom:'3px solid #fff', transform:'rotate(45deg) translate(3px,-3px)' }} />
        </button>
        <button onClick={() => move(1)} className="absolute top-1/2 z-30 -translate-y-1/2 p-3 transition opacity-70 hover:opacity-100" style={{ right: `calc(15% + 16px)` }} aria-label="다음">
          <span style={{ display:'inline-block', width:14, height:14, borderRight:'3px solid #fff', borderTop:'3px solid #fff', transform:'rotate(45deg) translate(-3px,3px)' }} />
        </button>
      </div>
      <div className="h-[3px] bg-neutral-200">
        <div className="h-full bg-neutral-900 transition-none" style={{ width: `${progress * 100}%` }} />
      </div>
      <div className="py-4 text-center text-xs tracking-[8px] text-neutral-500">
        {banners.map((_, i) => <button key={i} onClick={() => setCurrent(i)} className={i === current ? "text-neutral-900" : "text-neutral-300"}>●</button>)}
      </div>
    </section>
  );
}

function Header({ active, setActive }) {
  const [openMenu, setOpenMenu] = React.useState(null);
  const closeTimer = React.useRef(null);
  const onEnter = item => { clearTimeout(closeTimer.current); setOpenMenu(MEGA_MENU[item] ? item : null); };
  const onLeave = () => { closeTimer.current = setTimeout(() => setOpenMenu(null), 120); };
  return (
    <header className="sticky top-0 z-50 border-t-4 border-neutral-900 bg-white/95 backdrop-blur">
      <div className="mx-auto flex h-11 max-w-7xl items-center justify-center px-4 relative">
        <button onClick={() => setActive("홈")} className="text-3xl font-black tracking-tight text-red-600">CHABOZA</button>
        <div className="absolute right-8 top-4 hidden text-xs text-neutral-500 md:block">로그인&nbsp;&nbsp;|&nbsp;&nbsp;KR&nbsp;&nbsp;|&nbsp;&nbsp;⌕</div>
      </div>
      <nav className="border-y border-neutral-200 relative" onMouseLeave={onLeave}>
        <div className="mx-auto flex max-w-7xl justify-center overflow-x-auto px-4">
          {NAV_ITEMS.map(item =>
            <button key={item}
              onClick={() => { setActive(item); setOpenMenu(null); }}
              onMouseEnter={() => onEnter(item)}
              className={`min-w-fit px-8 py-4 text-sm font-semibold transition whitespace-nowrap ${active === item ? "border-b-4 border-neutral-900 text-neutral-950" : "border-b-4 border-transparent text-neutral-500 hover:text-neutral-900"}`}>
              {item}
            </button>
          )}
        </div>
        {openMenu && (
          <div onMouseEnter={() => clearTimeout(closeTimer.current)} onMouseLeave={onLeave}
            className="absolute left-0 right-0 top-full bg-white border-b-2 border-neutral-900 shadow-xl z-50"
            style={{ animation: "megaFadeIn 0.18s ease" }}>
            <div className="mx-auto max-w-7xl px-8 py-8">
              <div className="grid gap-8" style={{ gridTemplateColumns: `repeat(${MEGA_MENU[openMenu].length}, minmax(0,1fr))` }}>
                {MEGA_MENU[openMenu].map(col => (
                  <div key={col.title}>
                    <p className="mb-3 text-xs font-black uppercase tracking-widest text-neutral-400">{col.title}</p>
                    <ul className="space-y-1">
                      {col.items.map(sub => (
                        <li key={sub}>
                          <button onClick={() => { setActive(openMenu); setOpenMenu(null); }}
                            className="w-full text-left py-1.5 text-sm font-semibold text-neutral-700 hover:text-red-600 hover:pl-1 transition-all">
                            {sub}
                          </button>
                        </li>
                      ))}
                    </ul>
                  </div>
                ))}
              </div>
            </div>
          </div>
        )}
      </nav>
      <style>{`@keyframes megaFadeIn { from { opacity:0; transform:translateY(-6px) } to { opacity:1; transform:translateY(0) } }`}</style>
    </header>
  );
}

function Footer({ setActive }) {
  return (
    <footer className="bg-neutral-950 text-neutral-400">
      <div className="mx-auto grid max-w-7xl grid-cols-1 gap-8 px-6 py-10 md:grid-cols-4">
        <div><p className="mb-2 font-bold text-white">차보자</p><p className="text-xs leading-6">서울특별시 금천구 가산동<br />사업자등록번호 000-00-00000<br />대표 임운호</p></div>
        <button onClick={() => setActive("장기렌트")} className="text-left"><p className="mb-2 font-bold text-red-600">회사소개</p><p className="text-xs">신규 입점 문의</p></button>
        <button onClick={() => setActive("고객센터")} className="text-left"><p className="mb-2 font-bold text-red-600">고객센터</p><p className="text-xs">상담신청 및 자주 묻는 질문</p></button>
        <div><p className="mb-2 font-bold text-red-600">대표전화</p><p className="text-xs">1661-3583</p></div>
      </div>
      <div className="mx-auto max-w-7xl border-t border-neutral-800 px-6 py-6 text-xs text-neutral-500">
        이용약관&nbsp;&nbsp;&nbsp;개인정보처리방침<br />Copyright © 2026 AutoPortal. All Rights Reserved.
      </div>
    </footer>
  );
}
