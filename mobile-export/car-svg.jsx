// Car silhouette SVGs — clean side views, designed to look like product photography placeholders
// Each car accepts a `color` and `accent` prop and an optional `size` style.

const carDefs = (
  <defs>
    <linearGradient id="bodyG" x1="0" y1="0" x2="0" y2="1">
      <stop offset="0" stopColor="rgba(255,255,255,1)" />
      <stop offset="0.45" stopColor="rgba(245,245,247,1)" />
      <stop offset="1" stopColor="rgba(200,200,205,1)" />
    </linearGradient>
    <linearGradient id="bodyGDark" x1="0" y1="0" x2="0" y2="1">
      <stop offset="0" stopColor="#3A3A40" />
      <stop offset="0.5" stopColor="#202024" />
      <stop offset="1" stopColor="#0E0E10" />
    </linearGradient>
    <linearGradient id="bodyGGreen" x1="0" y1="0" x2="0" y2="1">
      <stop offset="0" stopColor="#A6C5A0" />
      <stop offset="0.5" stopColor="#7D9F77" />
      <stop offset="1" stopColor="#52704D" />
    </linearGradient>
    <linearGradient id="bodyGBrown" x1="0" y1="0" x2="0" y2="1">
      <stop offset="0" stopColor="#C7A788" />
      <stop offset="0.5" stopColor="#9D7E61" />
      <stop offset="1" stopColor="#6E5740" />
    </linearGradient>
    <linearGradient id="glassG" x1="0" y1="0" x2="0" y2="1">
      <stop offset="0" stopColor="#cfd8dc" />
      <stop offset="1" stopColor="#90a0aa" />
    </linearGradient>
    <radialGradient id="wheelG" cx="0.5" cy="0.5" r="0.5">
      <stop offset="0" stopColor="#444" />
      <stop offset="0.6" stopColor="#1a1a1a" />
      <stop offset="1" stopColor="#000" />
    </radialGradient>
  </defs>
);

// Sedan side view — Avante / Grandeur style
function CarSedan({ tone = 'silver', shadow = true }) {
  const fill =
    tone === 'silver' ? 'url(#bodyG)' :
    tone === 'dark'   ? 'url(#bodyGDark)' :
    tone === 'brown'  ? 'url(#bodyGBrown)' :
    'url(#bodyG)';
  return (
    <svg viewBox="0 0 260 110" className="car-illust" xmlns="http://www.w3.org/2000/svg">
      {carDefs}
      {shadow && <ellipse cx="130" cy="98" rx="105" ry="5" fill="rgba(0,0,0,0.18)" />}
      {/* body */}
      <path d="M18,82
               C20,72 28,68 42,67
               L70,58
               C80,46 100,42 130,42
               C158,42 178,46 192,56
               L228,62
               C240,64 248,70 250,80
               L250,86
               C250,90 246,92 242,92
               L20,92
               C16,92 14,90 14,86 Z"
            fill={fill} stroke="rgba(0,0,0,0.05)" strokeWidth="0.4"/>
      {/* highlight strip */}
      <path d="M22,80 L246,80" stroke="rgba(255,255,255,0.4)" strokeWidth="0.6" fill="none"/>
      {/* windows */}
      <path d="M82,57 L98,46 C108,44 122,43 130,43 L156,44 C172,46 184,50 192,56 L182,67 L92,67 Z"
            fill="url(#glassG)" opacity="0.8"/>
      <path d="M130,46 L130,66" stroke="rgba(0,0,0,0.15)" strokeWidth="0.8"/>
      {/* door line */}
      <path d="M115,68 L115,90" stroke="rgba(0,0,0,0.08)" strokeWidth="0.5"/>
      <path d="M155,68 L155,90" stroke="rgba(0,0,0,0.08)" strokeWidth="0.5"/>
      {/* headlight */}
      <path d="M236,72 L250,76 L250,80 L236,78 Z" fill="#fff" opacity="0.9"/>
      <path d="M14,76 L24,72 L26,78 L14,80 Z" fill="rgba(0,0,0,0.2)"/>
      {/* wheels */}
      <circle cx="64" cy="90" r="15" fill="url(#wheelG)"/>
      <circle cx="64" cy="90" r="9" fill="#2a2a2a"/>
      <circle cx="64" cy="90" r="5" fill="#6a6a6a"/>
      <circle cx="200" cy="90" r="15" fill="url(#wheelG)"/>
      <circle cx="200" cy="90" r="9" fill="#2a2a2a"/>
      <circle cx="200" cy="90" r="5" fill="#6a6a6a"/>
      {/* wheel wells */}
      <path d="M48,92 A16,16 0 0 1 80,92" fill="none" stroke="rgba(0,0,0,0.4)" strokeWidth="1.2"/>
      <path d="M184,92 A16,16 0 0 1 216,92" fill="none" stroke="rgba(0,0,0,0.4)" strokeWidth="1.2"/>
    </svg>
  );
}

// SUV side view — Palisade / Santa Fe style
function CarSUV({ tone = 'silver', shadow = true }) {
  const fill =
    tone === 'silver' ? 'url(#bodyG)' :
    tone === 'dark'   ? 'url(#bodyGDark)' :
    tone === 'green'  ? 'url(#bodyGGreen)' :
    tone === 'brown'  ? 'url(#bodyGBrown)' :
    'url(#bodyG)';
  return (
    <svg viewBox="0 0 260 110" className="car-illust" xmlns="http://www.w3.org/2000/svg">
      {carDefs}
      {shadow && <ellipse cx="130" cy="98" rx="108" ry="5" fill="rgba(0,0,0,0.18)" />}
      <path d="M16,82
               C18,68 28,62 44,62
               L56,42
               C60,36 68,32 80,32
               L188,32
               C204,32 214,38 220,48
               L240,58
               C250,60 252,68 252,80
               L252,86
               C252,90 248,92 244,92
               L18,92
               C14,92 12,90 12,86 Z"
            fill={fill} stroke="rgba(0,0,0,0.05)" strokeWidth="0.4"/>
      <path d="M20,80 L246,80" stroke="rgba(255,255,255,0.35)" strokeWidth="0.6" fill="none"/>
      {/* windows */}
      <path d="M62,40 C66,36 72,34 80,34 L188,34 C200,34 208,38 212,46 L210,62 L62,62 Z"
            fill="url(#glassG)" opacity="0.85"/>
      <path d="M130,36 L130,62" stroke="rgba(0,0,0,0.15)" strokeWidth="0.8"/>
      <path d="M178,36 L178,62" stroke="rgba(0,0,0,0.15)" strokeWidth="0.6"/>
      {/* doors */}
      <path d="M105,64 L105,90" stroke="rgba(0,0,0,0.08)" strokeWidth="0.5"/>
      <path d="M160,64 L160,90" stroke="rgba(0,0,0,0.08)" strokeWidth="0.5"/>
      {/* lights */}
      <path d="M238,68 L252,72 L252,76 L238,74 Z" fill="#fff" opacity="0.9"/>
      <path d="M12,72 L24,68 L26,74 L12,76 Z" fill="rgba(0,0,0,0.25)"/>
      {/* wheels */}
      <circle cx="62" cy="90" r="16" fill="url(#wheelG)"/>
      <circle cx="62" cy="90" r="10" fill="#2a2a2a"/>
      <circle cx="62" cy="90" r="5" fill="#6a6a6a"/>
      <circle cx="200" cy="90" r="16" fill="url(#wheelG)"/>
      <circle cx="200" cy="90" r="10" fill="#2a2a2a"/>
      <circle cx="200" cy="90" r="5" fill="#6a6a6a"/>
      <path d="M44,92 A18,18 0 0 1 80,92" fill="none" stroke="rgba(0,0,0,0.4)" strokeWidth="1.2"/>
      <path d="M182,92 A18,18 0 0 1 218,92" fill="none" stroke="rgba(0,0,0,0.4)" strokeWidth="1.2"/>
    </svg>
  );
}

// Compact crossover — Casper EV style (short, tall, cute)
function CarCompact({ tone = 'green', shadow = true }) {
  const fill =
    tone === 'silver' ? 'url(#bodyG)' :
    tone === 'green'  ? 'url(#bodyGGreen)' :
    tone === 'dark'   ? 'url(#bodyGDark)' :
    'url(#bodyGGreen)';
  return (
    <svg viewBox="0 0 260 110" className="car-illust" xmlns="http://www.w3.org/2000/svg">
      {carDefs}
      {shadow && <ellipse cx="130" cy="98" rx="80" ry="4.5" fill="rgba(0,0,0,0.25)" />}
      {/* body — short and tall */}
      <path d="M60,82
               C58,66 62,58 70,54
               L76,32
               C80,26 88,22 100,22
               L168,22
               C182,22 190,28 194,38
               L200,54
               C212,56 218,62 220,72
               L220,86
               C220,90 216,92 212,92
               L62,92
               C58,92 56,90 56,86 Z"
            fill={fill} stroke="rgba(0,0,0,0.06)" strokeWidth="0.4"/>
      <path d="M64,80 L216,80" stroke="rgba(255,255,255,0.3)" strokeWidth="0.6" fill="none"/>
      {/* windows */}
      <path d="M80,30 C84,26 90,24 100,24 L168,24 C178,24 184,28 188,38 L186,54 L80,54 Z"
            fill="url(#glassG)" opacity="0.85"/>
      <path d="M130,26 L130,54" stroke="rgba(0,0,0,0.15)" strokeWidth="0.8"/>
      {/* charge port hint */}
      <rect x="208" y="58" width="6" height="4" rx="1" fill="rgba(255,255,255,0.4)"/>
      {/* headlight */}
      <rect x="200" y="64" width="14" height="6" rx="1" fill="#fff" opacity="0.9"/>
      <rect x="58" y="64" width="14" height="6" rx="1" fill="rgba(0,0,0,0.3)"/>
      {/* wheels — bigger ratio */}
      <circle cx="92" cy="88" r="17" fill="url(#wheelG)"/>
      <circle cx="92" cy="88" r="10" fill="#2a2a2a"/>
      <circle cx="92" cy="88" r="5" fill="#6a6a6a"/>
      <circle cx="186" cy="88" r="17" fill="url(#wheelG)"/>
      <circle cx="186" cy="88" r="10" fill="#2a2a2a"/>
      <circle cx="186" cy="88" r="5" fill="#6a6a6a"/>
      <path d="M72,92 A20,20 0 0 1 112,92" fill="none" stroke="rgba(0,0,0,0.4)" strokeWidth="1.2"/>
      <path d="M166,92 A20,20 0 0 1 206,92" fill="none" stroke="rgba(0,0,0,0.4)" strokeWidth="1.2"/>
    </svg>
  );
}

// EV crossover — IONIQ 5 style (long, low, futuristic)
function CarEV({ tone = 'silver', shadow = true, glow = false }) {
  const fill = tone === 'silver' ? 'url(#bodyG)' : 'url(#bodyGDark)';
  return (
    <svg viewBox="0 0 280 120" className="car-illust" xmlns="http://www.w3.org/2000/svg">
      {carDefs}
      {glow && (
        <ellipse cx="140" cy="80" rx="130" ry="22" fill="rgba(46,204,138,0.5)" filter="blur(20px)"/>
      )}
      {shadow && <ellipse cx="140" cy="106" rx="115" ry="5" fill="rgba(0,0,0,0.28)" />}
      <path d="M18,86
               C20,72 30,66 46,66
               L62,42
               C66,36 76,32 88,32
               L196,32
               C212,32 220,38 226,50
               L246,62
               C260,64 264,72 264,84
               L264,90
               C264,94 260,96 256,96
               L20,96
               C16,96 14,94 14,90 Z"
            fill={fill} stroke="rgba(0,0,0,0.05)" strokeWidth="0.4"/>
      <path d="M22,84 L256,84" stroke="rgba(255,255,255,0.35)" strokeWidth="0.6" fill="none"/>
      {/* windows wraparound */}
      <path d="M70,40 C74,36 80,34 88,34 L196,34 C208,34 216,38 220,46 L218,62 L70,62 Z"
            fill="url(#glassG)" opacity="0.85"/>
      <path d="M140,36 L140,62" stroke="rgba(0,0,0,0.12)" strokeWidth="0.6"/>
      {/* pixel headlight pattern */}
      <g transform="translate(244,68)" fill={glow ? '#9DF3CC' : '#fff'}>
        <rect x="0" y="0" width="2" height="2"/>
        <rect x="3" y="0" width="2" height="2"/>
        <rect x="6" y="0" width="2" height="2"/>
        <rect x="0" y="3" width="2" height="2"/>
        <rect x="6" y="3" width="2" height="2"/>
        <rect x="0" y="6" width="2" height="2"/>
        <rect x="3" y="6" width="2" height="2"/>
        <rect x="6" y="6" width="2" height="2"/>
      </g>
      {/* pixel taillight */}
      <g transform="translate(14,68)" fill="rgba(255,80,80,0.7)">
        <rect x="0" y="0" width="2" height="2"/><rect x="3" y="0" width="2" height="2"/><rect x="6" y="0" width="2" height="2"/>
        <rect x="0" y="3" width="2" height="2"/><rect x="6" y="3" width="2" height="2"/>
        <rect x="0" y="6" width="2" height="2"/><rect x="3" y="6" width="2" height="2"/><rect x="6" y="6" width="2" height="2"/>
      </g>
      {/* wheels */}
      <circle cx="66" cy="94" r="17" fill="url(#wheelG)"/>
      <circle cx="66" cy="94" r="11" fill="#2a2a2a"/>
      <circle cx="66" cy="94" r="5" fill="#6a6a6a"/>
      <circle cx="214" cy="94" r="17" fill="url(#wheelG)"/>
      <circle cx="214" cy="94" r="11" fill="#2a2a2a"/>
      <circle cx="214" cy="94" r="5" fill="#6a6a6a"/>
      <path d="M46,96 A20,20 0 0 1 86,96" fill="none" stroke="rgba(0,0,0,0.45)" strokeWidth="1.2"/>
      <path d="M194,96 A20,20 0 0 1 234,96" fill="none" stroke="rgba(0,0,0,0.45)" strokeWidth="1.2"/>
    </svg>
  );
}

// Van — Carnival style
function CarVan({ tone = 'silver', shadow = true }) {
  const fill = tone === 'silver' ? 'url(#bodyG)' : 'url(#bodyGDark)';
  return (
    <svg viewBox="0 0 260 110" className="car-illust" xmlns="http://www.w3.org/2000/svg">
      {carDefs}
      {shadow && <ellipse cx="130" cy="100" rx="108" ry="4.5" fill="rgba(0,0,0,0.18)" />}
      <path d="M14,82
               C16,66 28,58 44,58
               L52,30
               C56,24 64,20 76,20
               L196,20
               C210,20 220,26 224,38
               L240,58
               C250,60 254,68 254,80
               L254,88
               C254,92 250,94 246,94
               L16,94
               C12,94 10,92 10,88 Z"
            fill={fill} stroke="rgba(0,0,0,0.05)" strokeWidth="0.4"/>
      <path d="M18,82 L250,82" stroke="rgba(255,255,255,0.3)" strokeWidth="0.6" fill="none"/>
      <path d="M58,28 C62,24 68,22 76,22 L196,22 C208,22 216,28 220,38 L218,58 L58,58 Z"
            fill="url(#glassG)" opacity="0.85"/>
      <path d="M118,24 L118,58" stroke="rgba(0,0,0,0.15)" strokeWidth="0.7"/>
      <path d="M170,24 L170,58" stroke="rgba(0,0,0,0.15)" strokeWidth="0.7"/>
      <path d="M14,72 L26,68 L28,74 L14,76 Z" fill="rgba(0,0,0,0.25)"/>
      <path d="M240,68 L254,72 L254,76 L240,74 Z" fill="#fff" opacity="0.9"/>
      <circle cx="62" cy="92" r="15" fill="url(#wheelG)"/>
      <circle cx="62" cy="92" r="9" fill="#2a2a2a"/>
      <circle cx="62" cy="92" r="5" fill="#6a6a6a"/>
      <circle cx="204" cy="92" r="15" fill="url(#wheelG)"/>
      <circle cx="204" cy="92" r="9" fill="#2a2a2a"/>
      <circle cx="204" cy="92" r="5" fill="#6a6a6a"/>
      <path d="M44,94 A18,18 0 0 1 80,94" fill="none" stroke="rgba(0,0,0,0.4)" strokeWidth="1.2"/>
      <path d="M186,94 A18,18 0 0 1 222,94" fill="none" stroke="rgba(0,0,0,0.4)" strokeWidth="1.2"/>
    </svg>
  );
}

Object.assign(window, { CarSedan, CarSUV, CarCompact, CarEV, CarVan, carDefs });
