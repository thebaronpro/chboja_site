/* ===================== PAGES/USED-CAR.JS ===================== */

function UsedCarPage({ setActive }) {
  return (
    <>
      <section className="bg-neutral-800 text-white">
        <div className="mx-auto max-w-7xl px-6 py-20">
          <span className="mb-6 inline-flex bg-neutral-600 px-5 py-2 text-sm font-bold">중고차</span>
          <h1 className="mb-6 text-6xl font-black leading-tight">믿을 수 있는 인증 중고차<br />직거래 플랫폼</h1>
          <p className="mb-8 text-neutral-400">전국 인증 딜러 보증 · 허위 매물 0% · 무사고 차량 우선</p>
          <Button onClick={() => setActive("고객센터")}>차량 검색하기 <Icon name="arrow" size={16} /></Button>
        </div>
      </section>

      <section className="bg-neutral-100 py-5">
        <div className="mx-auto flex max-w-7xl gap-5 px-6">
          <input className="flex-1 border border-neutral-200 bg-white px-6 py-4" placeholder="브랜드, 차종, 연식으로 검색하세요" />
          <Button><Icon name="search" size={16} /> 검색</Button>
        </div>
      </section>

      <section className="mx-auto max-w-7xl px-6 py-16">
        <SectionHeader title="이번 주 인기 중고차" desc="전국 인증 딜러가 보증하는 매물" right="전체 보기 →" />
        <div className="grid gap-6 md:grid-cols-4">
          {USED_CARS.map(car => <CarCard key={car.name} item={car} button="상세보기" />)}
        </div>
      </section>
    </>
  );
}
