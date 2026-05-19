/* ===================== PAGES/RENTAL.JS ===================== */

function RentalPage({ setActive }) {
  return (
    <>
      <SubCarousel banners={RENTAL_BANNERS} setActive={setActive} />
      <QuickTabs tabs={["국산차 렌트", "수입차 렌트", "전기차 렌트", "간편 견적", "특가 차량", "렌트 비교"]} />
      <section className="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-6 py-16 md:grid-cols-[1fr_.9fr] md:items-center">
        <div className="grid grid-cols-1 gap-5 md:grid-cols-3">
          {CARS.slice(0, 3).map(car => <CarCard key={car.name} item={car} button="견적 신청하기" />)}
        </div>
        <div>
          <h2 className="text-7xl font-black leading-tight">한정재고<br /><span className="font-light text-neutral-400">특가차량</span></h2>
          <p className="mt-4 text-sm font-semibold text-neutral-400">수량 한정 · 소진 시 종료</p>
        </div>
      </section>

      <section className="bg-neutral-900 py-12 text-white overflow-hidden">
        <div className="mx-auto grid max-w-7xl grid-cols-1 items-center gap-10 px-6 md:grid-cols-[1fr_auto_1fr_320px]">
          <div>
            <h3 className="text-3xl font-black"><Icon name="zap" className="mr-2 text-yellow-400" />타임딜</h3>
            <p className="text-sm text-neutral-400">오늘 차량재고만 · 선착순 마감</p>
          </div>
          <div className="flex justify-center gap-5 text-center">
            {[["08","시간"],["34","분"],["22","초"]].map(([n, t]) => (
              <div key={t} className="bg-neutral-700 px-8 py-5">
                <p className="text-4xl font-black">{n}</p>
                <p className="text-xs text-neutral-400">{t}</p>
              </div>
            ))}
          </div>
          <div>
            <p className="font-black">현대 캐스퍼 일렉트릭</p>
            <p className="text-sm text-neutral-400">월 380,000원~ · 선납금 0원</p>
            <Button className="mt-4">지금 혜택 신청</Button>
          </div>
          <div className="relative h-48 overflow-visible">
            <CarDriveIn
              src="image 21.png"
              alt="현대 캐스퍼 일렉트릭"
              className="absolute top-1/2 object-contain drop-shadow-2xl"
              style={{ height: '104px', right: '0' }} />
          </div>
        </div>
      </section>

      <section className="mx-auto max-w-7xl px-6 py-16">
        <SectionHeader title="이번 주 국산차 특가" desc="선납금 0원, 월 납입금 패키지 포함" right="전체 보기 →" />
        <div className="grid gap-6 md:grid-cols-4">
          {CARS.map(car => <CarCard key={car.name} item={car} />)}
        </div>
      </section>
      <ConsultationBand title="장기렌트, 아직 고민 중이신가요?" desc="전문 상담사가 최적 차량을 빠르게 안내해드립니다. 평일 09:00 - 18:00" />
    </>
  );
}
