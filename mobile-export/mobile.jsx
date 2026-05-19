// Main mobile app — assembles the iOS frame and all sections
const TABS = ['장기렌트 홈', '차량검색', '빠른출고', '전기차특가', '특가차량'];

function AppHeader() {
  return (
    <div className="topbar">
      <div className="topbar-inner">
        <button className="iconbtn" aria-label="menu">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
            <path d="M3 7h18M3 12h18M3 17h12"/>
          </svg>
        </button>
        <div className="brand">CHABOZA</div>
        <button className="iconbtn" aria-label="search">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <circle cx="11" cy="11" r="7"/><path d="M21 21l-5-5"/>
          </svg>
        </button>
      </div>
    </div>
  );
}

function AppTabs() {
  const [active, setActive] = React.useState('장기렌트 홈');
  return (
    <div className="tabs">
      {TABS.map(t => (
        <button key={t} className={`tab ${t === active ? 'active' : ''}`} onClick={() => setActive(t)}>
          {t === '빠른출고' && <span className="bolt">⚡</span>}
          {t}
        </button>
      ))}
    </div>
  );
}

function SearchBar() {
  return (
    <div className="search">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
        <circle cx="11" cy="11" r="7"/><path d="M21 21l-5-5"/>
      </svg>
      <span>차량명을 입력해주세요</span>
    </div>
  );
}

function App() {
  return (
    <div className="app">
      <AppHeader/>
      <AppTabs/>
      <SearchBar/>
      <Hero/>
      <Benefits/>
      <QuickActions/>
      <FastDelivery/>
      <TimeDeal/>
      <PopularVehicles/>
      <EVSpecial/>
      <WeeklySpecials/>
      <Consultation/>
      <Footer/>
      <div style={{ height: 80 }}/>
      <TabBar/>
    </div>
  );
}

// Scale device to viewport
function MobileStage() {
  const DEVICE_W = 402;
  const DEVICE_H = 874;
  const [scale, setScale] = React.useState(1);
  React.useEffect(() => {
    const fit = () => {
      const vw = window.innerWidth;
      const vh = window.innerHeight;
      const sx = (vw - 32) / DEVICE_W;
      const sy = (vh - 48) / DEVICE_H;
      setScale(Math.min(1, sx, sy));
    };
    fit();
    window.addEventListener('resize', fit);
    return () => window.removeEventListener('resize', fit);
  }, []);
  return (
    <div className="stage">
      <div className="device-mount" style={{ transform: `scale(${scale})` }}>
        <IOSDevice width={DEVICE_W} height={DEVICE_H} dark={false}>
          <App/>
        </IOSDevice>
      </div>
    </div>
  );
}

ReactDOM.createRoot(document.getElementById('root')).render(<MobileStage/>);
