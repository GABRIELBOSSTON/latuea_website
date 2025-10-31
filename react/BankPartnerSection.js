function BankPartnerSection() {
  const banks = [
    { id: 1, name: "Bank BCA", logo: "/LatuaGroup/uploads/banks/bca.jpeg" },
    { id: 2, name: "Bank Mandiri", logo: "/LatuaGroup/uploads/banks/mandiri.png" },
    { id: 3, name: "Bank BRI", logo: "/LatuaGroup/uploads/banks/bri.jpeg" },
    { id: 4, name: "Bank BNI", logo: "/LatuaGroup/uploads/banks/bni.jpeg" },
  ];

  const defaultLogo = "/LatuaGroup/uploads/banks/default.png";

  return (
    <section className="py-12 px-6 bg-white">
      <div className="max-w-6xl mx-auto">

        {/* === JUDUL DENGAN GARIS (SESUAI FIGMA) === */}
        <div className="flex items-center justify-center gap-4 md:gap-8 my-8">
          {/* Garis Kiri */}
          <div 
            className="h-1 bg-[#B2A5A5] hidden md:block"
            style={{ width: '424px', flexShrink: 0 }}
          ></div>

          {/* Teks Tengah */}
          <h2 
            className="text-[#6E6E6E] text-xl md:text-[36px] font-bold whitespace-nowrap leading-none"
            style={{
              fontFamily: 'Raleway, sans-serif',
              width: '455px',
              height: '85px',
              flexShrink: 0,
              lineHeight: '85px',
              textAlign: 'center'
            }}
          >
            KERJA SAMA BANK
          </h2>

          {/* Garis Kanan */}
          <div 
            className="h-1 bg-[#B2A5A5] hidden md:block"
            style={{ width: '424px', flexShrink: 0 }}
          ></div>
        </div>

        {/* === DESKTOP: GRID 4 KOLOM === */}
        <div className="hidden md:grid md:grid-cols-4 gap-6 items-center justify-center">
          {banks.map((bank) => (
            <div
              key={bank.id}
              className="flex items-center justify-center bg-white rounded-[46px] border border-black p-4 hover:shadow-lg transition"
              style={{ width: '240px', height: '90px' }}
            >
              <img
                src={bank.logo}
                alt={bank.name}
                className="max-w-full max-h-full object-contain"
                onError={(e) => {
                  console.warn(`Logo gagal load: ${bank.logo}, diganti default`);
                  e.target.src = defaultLogo;
                }}
              />
            </div>
          ))}
        </div>

        {/* === MOBILE: HORIZONTAL SCROLL + AUTO SCROLL (CSS ONLY) === */}
        <div className="md:hidden overflow-x-auto scrollbar-hide">
          <div className="flex gap-4 pb-4 bank-slider-mobile">
            {/* Duplikat untuk infinite loop */}
            {[...banks, ...banks].map((bank, index) => (
              <div
                key={`${bank.id}-${index}`}
                className="flex-shrink-0 flex items-center justify-center bg-white rounded-[46px] border border-black p-4"
                style={{ width: '240px', height: '90px' }}
              >
                <img
                  src={bank.logo}
                  alt={bank.name}
                  className="max-w-full max-h-full object-contain"
                  onError={(e) => {
                    e.target.src = defaultLogo;
                  }}
                />
              </div>
            ))}
          </div>
        </div>

      </div>

      {/* === CSS: HIDE SCROLLBAR + AUTO SCROLL MOBILE === */}
      <style jsx>{`
        /* Sembunyikan scrollbar */
        .scrollbar-hide::-webkit-scrollbar {
          display: none;
        }
        .scrollbar-hide {
          -ms-overflow-style: none;
          scrollbar-width: none;
        }

        /* Auto scroll mobile - infinite loop */
        .bank-slider-mobile {
          display: flex;
          width: max-content;
          animation: scrollBank 12s linear infinite;
        }

        @keyframes scrollBank {
          0% {
            transform: translateX(0);
          }
          100% {
            transform: translateX(-50%);
          }
        }

        /* Pause saat hover atau sentuh */
        .bank-slider-mobile:hover,
        .bank-slider-mobile:active {
          animation-play-state: paused;
        }

        /* Smooth di semua browser */
        .bank-slider-mobile {
          -webkit-animation: scrollBank 12s linear infinite;
        }
      `}</style>
    </section>
  );
}