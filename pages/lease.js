/* ===================== PAGES/LEASE.JS ===================== */

function LeasePage({ setActive }) {
  return (
    <>
      <section className="bg-slate-950 text-white">
        <div className="mx-auto max-w-7xl px-6 py-20">
          <span className="mb-6 inline-flex bg-neutral-600 px-5 py-2 text-sm font-bold">화물리스</span>
          <h1 className="mb-6 text-6xl font-black leading-tight">사업용 화물차 리스로<br />세금 혜택까지</h1>
          <p className="mb-8 text-neutral-400">1톤 · 2.5톤 · 5톤 · 특장차 전 차종 · 보증금 0원 가능</p>
          <Button onClick={() => setActive("고객센터")}>무료 견적 신청 <Icon name="arrow" size={16} /></Button>
        </div>
      </section>

      <QuickTabs tabs={["1톤 리스", "2.5톤 리스", "5톤 리스", "특장차 리스", "냉동탑차"]} />

      <section className="mx-auto max-w-7xl px-6 py-16">
        <SectionHeader title="1톤 화물차 리스" desc="보증금 0원 · 사업자 세금 혜택 적용" />
        <div className="grid gap-6 md:grid-cols-4">
          {TRUCKS.map(car => <CarCard key={car.name} item={car} button={null} tall />)}
        </div>
      </section>

      <section className="bg-neutral-100 py-16">
        <div className="mx-auto max-w-7xl px-6">
          <SectionHeader title="화물리스 혜택" />
          <div className="grid gap-6 md:grid-cols-3">
            {[
              "💰 세금 절감\n리스료 전액 비용처리 가능\n부가세 환급 혜택",
              "▣ 보험 포함\n자동차 보험료 포함\n사고 시 대차 서비스 제공",
              "🔧 유지관리\n정기 점검 무료\n소모품 교환 서비스",
            ].map(text => (
              <div key={text} className="h-64 whitespace-pre-line border border-neutral-200 bg-white p-10 text-xl font-black leading-9">{text}</div>
            ))}
          </div>
        </div>
      </section>
    </>
  );
}
