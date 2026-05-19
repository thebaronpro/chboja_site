/* ===================== PAGES/HOME.JS ===================== */

function MainCarousel({ setActive }) {
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
    const timer = window.setInterval(() => {
      setCurrent(i => wrapIndex(i, 1, MAIN_BANNERS.length));
      start = null;
    }, DURATION);
    return () => { window.clearInterval(timer); cancelAnimationFrame(raf); };
  }, [current]);

  const move = d => setCurrent(i => wrapIndex(i, d, MAIN_BANNERS.length));

  return (
    <section className="relative overflow-hidden bg-white py-4">
      <div className="relative mx-auto max-w-[1600px] overflow-hidden" style={{ height: 460 }}>
        {MAIN_BANNERS.map((banner, index) => {
          let offset = index - current;
          if (offset > MAIN_BANNERS.length / 2) offset -= MAIN_BANNERS.length;
          if (offset < -MAIN_BANNERS.length / 2) offset += MAIN_BANNERS.length;
          const isActive = offset === 0, visible = Math.abs(offset) <= 1;
          const aw = 70, sw = 22;
          const lp = 50 + offset * (aw / 2 + sw / 2 + 1);
          return (
            <button key={banner.title}
              onClick={() => isActive ? setActive(banner.target) : setCurrent(index)}
              className={`absolute top-6 h-[400px] overflow-hidden text-left transition-all duration-700 ease-out ${visible ? "opacity-100" : "pointer-events-none opacity-0"}`}
              style={{ left: `${lp}%`, width: isActive ? `${aw}%` : `${sw}%`, transform: `translateX(-50%) scale(${isActive ? 1 : 0.85})`, zIndex: isActive ? 20 : 10, filter: isActive ? "none" : "saturate(0.7)" }}
              aria-label={`${banner.label} 배너`}>
              {isActive ? <>
                {banner.image && <img src={banner.image} alt={banner.label} className="absolute inset-0 w-full h-full object-cover" />}
                <div className="absolute inset-0" style={{ background: "linear-gradient(to right, rgba(0,0,0,0.72) 40%, rgba(0,0,0,0.15) 100%)" }} />
                <div className="relative z-10 px-16 py-12">
                  <span className={`mb-4 inline-flex w-fit px-4 py-1.5 text-sm font-black text-white ${banner.badge}`}>{banner.label}</span>
                  <h1 className="whitespace-pre-line text-4xl font-black leading-tight text-white">{banner.title}</h1>
                  <p className="mt-3 text-sm font-bold text-neutral-300">{banner.desc}</p>
                  <span className="mt-6 inline-flex w-fit items-center gap-2 bg-white text-neutral-900 px-6 py-2.5 text-sm font-black">{banner.button} <Icon name="arrow" size={14} /></span>
                </div>
              </> : <>
                {banner.image && <img src={banner.image} alt="" className="absolute inset-0 w-full h-full object-cover" />}
                <div className="absolute inset-0" style={{ background: "rgba(0,0,0,0.45)" }} />
                <div className="absolute bottom-0 left-0 right-0 z-10 px-6 py-6 opacity-90">
                  <span className={`mb-2 inline-flex w-fit px-2 py-1 text-xs font-black text-white ${banner.badge}`}>{banner.label}</span>
                  <p className="whitespace-pre-line text-sm font-black leading-snug text-white">{banner.title}</p>
                </div>
              </>}
            </button>
          );
        })}
        <button onClick={() => move(-1)} className="absolute top-1/2 z-30 -translate-y-1/2 p-3 transition opacity-70 hover:opacity-100" style={{ left: `calc(15% + 16px)` }} aria-label="이전 배너">
          <span style={{ display:'inline-block', width:14, height:14, borderLeft:'3px solid #fff', borderBottom:'3px solid #fff', transform:'rotate(45deg) translate(3px,-3px)' }} />
        </button>
        <button onClick={() => move(1)} className="absolute top-1/2 z-30 -translate-y-1/2 p-3 transition opacity-70 hover:opacity-100" style={{ right: `calc(15% + 16px)` }} aria-label="다음 배너">
          <span style={{ display:'inline-block', width:14, height:14, borderRight:'3px solid #fff', borderTop:'3px solid #fff', transform:'rotate(45deg) translate(-3px,3px)' }} />
        </button>
      </div>
      <div className="h-[3px] bg-neutral-200">
        <div className="h-full bg-neutral-900 transition-none" style={{ width: `${progress * 100}%` }} />
      </div>
      <div className="py-4 text-center text-xs tracking-[8px] text-neutral-500">
        {MAIN_BANNERS.map((_, i) => <button key={i} onClick={() => setCurrent(i)} className={i === current ? "text-neutral-900" : "text-neutral-300"} aria-label={`${i+1}번 배너`}>●</button>)}
      </div>
    </section>
  );
}

function PopularCars({ setActive }) {
  const [start, setStart] = React.useState(0);
  const PER = 3;
  const medal = r => r === 1 ? "🥇" : r === 2 ? "🥈" : r === 3 ? "🥉" : null;
  return (
    <section className="mx-auto max-w-7xl px-6 py-16">
      <SectionHeader
        title={<><span className="font-black">Popular</span><span className="font-light text-neutral-400"> Cars</span></>}
        desc="이번 달 가장 많이 선택한 차량"
        right={
          <div className="flex items-center gap-3">
            <span className="text-xs text-neutral-400">{start+1}–{Math.min(start+PER, POPULAR_CARS.length)} / {POPULAR_CARS.length}</span>
            <button onClick={() => setStart(s => Math.max(0, s-1))} disabled={start === 0} className="h-10 w-10 flex items-center justify-center border border-neutral-300 disabled:opacity-30 hover:bg-neutral-900 hover:text-white transition">
              <span style={{ display:'inline-block', width:9, height:9, borderLeft:'2px solid currentColor', borderBottom:'2px solid currentColor', transform:'rotate(45deg) translate(2px,-2px)' }} />
            </button>
            <button onClick={() => setStart(s => Math.min(POPULAR_CARS.length-PER, s+1))} disabled={start >= POPULAR_CARS.length-PER} className="h-10 w-10 flex items-center justify-center border border-neutral-300 disabled:opacity-30 hover:bg-neutral-900 hover:text-white transition">
              <span style={{ display:'inline-block', width:9, height:9, borderRight:'2px solid currentColor', borderTop:'2px solid currentColor', transform:'rotate(45deg) translate(-2px,2px)' }} />
            </button>
          </div>
        } />
      <div className="grid grid-cols-3 gap-5">
        {POPULAR_CARS.slice(start, start+PER).map(car => (
          <button key={car.rank} onClick={() => setActive("장기렌트")} className="relative h-80 overflow-hidden group text-left">
            <img src={car.image} alt={car.name} className="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-105" />
            <div className="absolute inset-0" style={{ background: "linear-gradient(to top, rgba(0,0,0,0.82) 40%, rgba(0,0,0,0.1) 100%)" }} />
            <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
              <p className="mb-1 text-xs font-black tracking-widest text-neutral-400 uppercase">
                {medal(car.rank) ? <><span className="mr-1">{medal(car.rank)}</span>이번 달 {car.rank}위</> : `이번 달 ${car.rank}위`}
              </p>
              <h3 className="text-xl font-black leading-tight">{car.name}</h3>
              <p className="mt-1 text-sm font-semibold text-neutral-300">{car.price}</p>
            </div>
          </button>
        ))}
      </div>
    </section>
  );
}

function HotDealCarousel({ setActive }) {
  return (
    <section className="py-16">
      <div className="mx-auto max-w-7xl px-6">
        <SectionHeader title={<><span className="font-black">Hot</span><span className="font-light">Deal</span></>} desc="오늘의 특가" />
        <div className="grid grid-cols-3 gap-5">
          {HOT_DEALS.slice(0, 3).map(deal => (
            <button key={deal.title} onClick={() => setActive(deal.target)}
              className={`overflow-hidden text-left ${deal.tone}`} style={{ height: 320 }}>
              {deal.image && <img src={deal.image} alt="" className="w-full object-cover" style={{ height: 195 }} />}
              <div className="flex flex-col justify-end p-6" style={{ height: 125 }}>
                <p className="mb-1 text-xs font-black text-red-500">HOT DEAL</p>
                <h3 className="whitespace-pre-line text-2xl font-black leading-tight">{deal.title}</h3>
                <p className="mt-2 text-lg font-black">{deal.price}</p>
                <p className="mt-1 text-xs font-bold opacity-60">{deal.meta}</p>
              </div>
            </button>
          ))}
        </div>
      </div>
    </section>
  );
}

function HomePage({ setActive }) {
  const featureBlocks = [
    { title: "장기렌트", desc: "월납입금으로 내 차를",     page: "장기렌트" },
    { title: "중고차",   desc: "믿을 수 있는 인증 매물",   page: "중고차" },
    { title: "화물리스", desc: "사업자를 위한 절세 리스",  page: "화물리스" },
  ];
  return (
    <>
      <MainCarousel setActive={setActive} />
      <PopularCars setActive={setActive} />
      <section className="mx-auto max-w-7xl px-6 py-16">
        <SectionHeader eyebrow="At," title="Chaboza Event" desc="이번 주 차보자 추천 이벤트" />
        <div className="grid gap-6 md:grid-cols-4">
          {EVENTS.slice(0, 4).map((event, idx) =>
            <button key={event.title} onClick={() => setActive("이벤트&혜택")} className="group h-56 bg-neutral-200 p-6 text-left transition hover:bg-neutral-800 hover:text-white">
              {idx === 1 && <span className="mb-8 inline-flex bg-neutral-800 px-3 py-1 text-xs font-bold text-white group-hover:bg-red-600">NOW OPEN</span>}
              <p className="mt-20 text-xs font-black">4.1 - 4.30</p>
              <h3 className="font-black">{event.title}</h3>
            </button>
          )}
        </div>
      </section>
      <HotDealCarousel setActive={setActive} />
      <section className="mx-auto max-w-7xl px-6 py-16">
        <div className="mb-10 text-right"><h2 className="text-5xl font-black">Used<span className="font-light">Car</span></h2><p className="text-sm font-semibold text-neutral-400">믿을 수 있는 인증 중고차 직거래</p></div>
        <div className="grid gap-6 md:grid-cols-3">
          {featureBlocks.map((b, idx) =>
            <button key={b.title} onClick={() => setActive(b.page)} className={`${idx === 1 ? "bg-slate-200" : "bg-neutral-300"} h-48 p-7 text-left transition hover:bg-neutral-900 hover:text-white`}>
              <p className="text-sm font-bold text-neutral-500">{b.title}</p>
              <h3 className="mt-24 font-black">{b.desc}</h3>
            </button>
          )}
        </div>
      </section>
      <section className="mx-auto max-w-7xl px-6 py-16">
        <SectionHeader title={<><span className="font-black">Chaboza</span> <span className="font-light">Shop</span></>} desc="내 차를 더 스마트하게 만드는 자동차용품" right={<><Icon name="left" /> <Icon name="right" /></>} />
        <div className="grid grid-cols-2 gap-4 md:grid-cols-6">
          {["블랙박스\nTHINKWARE","카시트\nCYBEX","썬팅\n3M","내비게이션\nMAPPY","세차용품\nTURTLE WAX","차량 매트\n3D MAT"].map((text, idx) =>
            <button key={text} onClick={() => setActive("자동차용품")} className={`${idx%2 ? "bg-slate-200 text-neutral-950" : "bg-neutral-800 text-white"} h-64 whitespace-pre-line p-6 text-left font-black`}>{text}</button>
          )}
        </div>
      </section>
    </>
  );
}
