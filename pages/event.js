/* ===================== PAGES/EVENT.JS ===================== */

function EventPage() {
  return (
    <>
      <section className="mx-auto max-w-7xl px-6 py-16">
        <div className="mb-10 flex items-end gap-5">
          <h1 className="text-4xl font-black">이벤트 & 혜택</h1>
          <p className="mb-1 text-sm font-bold text-neutral-400">진행중 8건 &nbsp;|&nbsp; 종료 4건</p>
        </div>
      </section>

      <section className="bg-neutral-100 py-8">
        <div className="mx-auto grid max-w-7xl gap-6 px-6 md:grid-cols-4">
          {EVENTS.map(event => (
            <article key={event.title} className="border border-neutral-200 bg-white">
              <div className="relative h-56 overflow-hidden">
                {event.image && event.open
                  ? <img src={event.image} alt={event.title} className="w-full h-full object-cover" />
                  : <Placeholder dark={!event.open} label={!event.open ? "종료" : ""} className="h-56" />
                }
                {!event.open && (
                  <div className="absolute inset-0 bg-neutral-900/60 flex items-center justify-center">
                    <span className="text-white font-black text-lg">종료</span>
                  </div>
                )}
              </div>
              <div className={`${event.open ? "bg-white" : "bg-neutral-100"} p-5`}>
                <h3 className="text-xl font-black">{event.title}</h3>
                <p className="mt-1 font-semibold text-neutral-500">{event.desc}</p>
                <p className="mt-16 text-sm text-neutral-400">기간&nbsp; {event.date}</p>
              </div>
            </article>
          ))}
        </div>
        <div className="mt-16 text-center">
          <button className="border border-neutral-900 bg-white px-32 py-4 text-sm font-black">이벤트 더보기 (종료 포함) ↓</button>
        </div>
      </section>
    </>
  );
}
