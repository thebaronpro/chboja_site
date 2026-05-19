/* ===================== PAGES/CONTACT.JS ===================== */

function ContactPage() {
  const [openFaq, setOpenFaq] = React.useState(0);
  return (
    <>
      <section className="bg-neutral-900 py-16 text-center text-white">
        <h1 className="text-4xl font-black">고객센터</h1>
        <p className="mt-4 text-neutral-400">무엇이든 도와드리겠습니다. 언제든지 연락주세요.</p>
      </section>

      <section className="mx-auto grid max-w-7xl gap-12 px-6 py-12 md:grid-cols-3">
        {[
          { icon: "phone", title: "전화 상담",     sub: "1661-3583",        note: "평일 09:00 ~ 18:00" },
          { icon: "chat",  title: "카카오톡 상담", sub: "카카오톡으로 편리하게", note: "언제든지 문의하세요" },
          { icon: "mail",  title: "1:1 문의",      sub: "이메일로 상세한 내용을", note: "문의해주세요" },
        ].map(({ icon, title, sub, note }) => (
          <div key={title} className="h-44 border border-neutral-200 bg-neutral-100 p-8">
            <Icon name={icon} className="mb-3 text-neutral-500" size={22} />
            <h3 className="font-black">{title}</h3>
            <p className="font-black">{sub}</p>
            <p className="text-sm font-semibold">{note}</p>
          </div>
        ))}
      </section>

      <section className="bg-neutral-100 py-16">
        <div className="mx-auto max-w-7xl px-6">
          <SectionHeader title="자주 묻는 질문" />
          <div className="space-y-3">
            {FAQS.map(([q, a], i) => (
              <div key={q} className="border border-neutral-200 bg-white">
                <button onClick={() => setOpenFaq(openFaq === i ? -1 : i)} className="flex w-full items-center justify-between p-5 text-left font-black">
                  {q}<Icon name="plus" size={18} />
                </button>
                {openFaq === i && <p className="border-t border-neutral-100 p-5 text-sm font-semibold leading-7 text-neutral-600">{a}</p>}
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-6 py-16 md:grid-cols-[1.4fr_1fr]">
        <div>
          <SectionHeader title="1:1 문의하기" />
          <div className="grid gap-5 border border-neutral-200 bg-neutral-100 p-8 md:grid-cols-2">
            <input className="border border-neutral-200 px-5 py-4" placeholder="이름" />
            <input className="border border-neutral-200 px-5 py-4" placeholder="연락처" />
            <input className="border border-neutral-200 px-5 py-4 md:col-span-2" placeholder="제목" />
            <textarea className="h-40 border border-neutral-200 px-5 py-4 md:col-span-2" placeholder="문의 내용을 입력해주세요" />
            <button className="bg-neutral-900 py-4 font-black text-white md:col-span-2">
              <Icon name="send" className="mr-2" size={16} />문의 접수하기
            </button>
          </div>
        </div>
        <div className="mt-16 bg-neutral-900 p-10 text-white">
          <h3 className="mb-8 text-xl font-black">운영 안내</h3>
          <p className="leading-8 text-neutral-400">
            전화 상담&nbsp;&nbsp;&nbsp;1661-3583<br />
            평일&nbsp;&nbsp;&nbsp;09:00 ~ 18:00<br />
            주말/공휴일&nbsp;&nbsp;&nbsp;휴무<br />
            이메일&nbsp;&nbsp;&nbsp;info@chaboza.com<br />
            답변 시간&nbsp;&nbsp;&nbsp;영업일 1~2일 이내
          </p>
        </div>
      </section>
    </>
  );
}
