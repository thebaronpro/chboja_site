/* ===================== PAGES/INSTALLMENT.JS ===================== */

function InstallmentPage({ setActive }) {
  const [price,   setPrice]   = React.useState(30000000);
  const [deposit, setDeposit] = React.useState(5000000);
  const [rate,    setRate]    = React.useState(3.5);
  const [months,  setMonths]  = React.useState(36);
  const payment = React.useMemo(
    () => calculateMonthlyPayment(price, deposit, rate, months).toLocaleString("ko-KR"),
    [price, deposit, rate, months]
  );

  return (
    <>
      <SubCarousel banners={INSTALLMENT_BANNERS} setActive={setActive} />
      <QuickTabs tabs={["신차 할부", "중고차 할부", "할부 계산기", "금리 안내", "제휴 금융사"]} />

      <section className="mx-auto max-w-7xl px-6 py-16">
        <SectionHeader title="신차 할부 특가" desc="최저 금리 2.9%, 무이자 할부 최대 36개월" right="전체 보기 →" />
        <div className="grid gap-6 md:grid-cols-4">
          {CARS.map(car => <CarCard key={car.name} item={car} button="할부 신청하기" />)}
        </div>
      </section>

      <section className="bg-neutral-100 py-16">
        <div className="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-6 md:grid-cols-[.7fr_1.3fr] md:items-start">
          <div>
            <h2 className="text-7xl font-black">할부 <span className="font-light text-neutral-400">계산기</span></h2>
            <p className="mt-3 text-sm font-semibold text-neutral-400">예상 월 납입금을 미리 계산해보세요</p>
          </div>
          <div className="bg-white p-8">
            <div className="grid gap-5 md:grid-cols-2">
              <input value={price}   onChange={e => setPrice(e.target.value)}   className="bg-neutral-100 px-5 py-4 text-sm" placeholder="차량 가격 입력 (원)" />
              <input value={deposit} onChange={e => setDeposit(e.target.value)} className="bg-neutral-100 px-5 py-4 text-sm" placeholder="선납금 입력 (원)" />
              <div className="flex gap-3">
                {[36, 48, 60].map(m => (
                  <button key={m} onClick={() => setMonths(m)} className={`${months === m ? "bg-neutral-900 text-white" : "bg-neutral-100 text-neutral-500"} flex-1 py-4 text-sm font-bold`}>{m}개월</button>
                ))}
              </div>
              <input value={rate} onChange={e => setRate(e.target.value)} className="bg-neutral-100 px-5 py-4 text-sm" placeholder="금리 입력 (%)" />
              <div className="bg-neutral-900 p-6 text-white md:col-span-2">
                <p className="text-sm font-bold text-neutral-400">예상 월 납입금</p>
                <p className="mt-2 text-4xl font-black">{payment}원 / 월</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <ConsultationBand title="할부, 아직 고민 중이신가요?" desc="금리, 기간, 초기비용까지 전문 상담사가 최적 플랜을 안내해드립니다" />
    </>
  );
}
