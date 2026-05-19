/* ===================== PAGES/SHOP.JS ===================== */

function ShopPage({ setActive }) {
  return (
    <>
      <section className="bg-neutral-950 text-white">
        <div className="mx-auto grid max-w-7xl grid-cols-1 gap-8 px-6 py-12 md:grid-cols-[1fr_1.1fr]">
          <div className="flex flex-col justify-center">
            <p className="mb-4 text-neutral-400">차량 계약 후,</p>
            <h1 className="mb-8 text-6xl font-black leading-tight">내 차에 맞는<br />전문 용품점을 연결해드립니다</h1>
            <p className="mb-8 text-neutral-400">렌트 · 리스 · 할부 계약 고객에게 검증된 용품점을 직접 연결합니다</p>
            <div className="flex gap-3">
              <Button dark={false}>용품점 찾기 <Icon name="arrow" size={16} /></Button>
              <Button>패키지 상품 보기</Button>
            </div>
          </div>
          <div className="grid gap-6 md:grid-cols-3">
            {["프리미엄 썬팅\n전국 인증 시공점", "공식 인증\n블랙박스 설치점", "차량 출고 후\n원스톱 용품 시공"].map(text => (
              <div key={text} className="flex h-80 flex-col justify-end bg-neutral-800 p-8">
                <p className="whitespace-pre-line text-xl font-black">{text}</p>
                <p className="mt-4 text-sm text-neutral-400">가까운 전문점 찾기 →</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      <QuickTabs tabs={["썬팅", "블랙박스", "카매트", "기타"]} />

      <section className="mx-auto max-w-7xl px-6 py-16">
        <div className="mb-8 flex items-center justify-between">
          <SectionHeader title="썬팅 전체 상품" />
          <div className="text-sm font-bold text-neutral-500">필터 ▼ &nbsp;&nbsp; 낮은가격순 ▼</div>
        </div>
        <div className="grid gap-8 md:grid-cols-4">
          {PRODUCTS.map(p => <ProductCard key={p.name} item={p} />)}
        </div>
        <div className="mt-16 text-center">
          <Button dark={false} className="border border-neutral-900 px-24">썬팅 상품 더보기 <Icon name="down" size={16} /></Button>
        </div>
      </section>

      <section className="bg-neutral-900 py-16 text-white">
        <div className="mx-auto flex max-w-7xl flex-col items-start justify-between gap-8 px-6 md:flex-row md:items-center">
          <div>
            <p className="mb-2 text-sm text-neutral-400">렌트·리스·할부 계약 고객 전용</p>
            <h2 className="text-4xl font-black">차량 출고 후 용품 시공까지, 차보자가 한번에 연결합니다</h2>
          </div>
          <Button onClick={() => setActive("고객센터")}>용품점 연결하기 <Icon name="arrow" size={16} /></Button>
        </div>
      </section>
    </>
  );
}
