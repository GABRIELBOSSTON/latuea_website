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
        {/* Title */}
        <h2 className="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">
          KERJA SAMA BANK
        </h2>

        {/* Desktop Grid (hidden on mobile) */}
        {/* UBAH: Jarak antar item diubah dari gap-8 menjadi gap-6 */}
        <div className="hidden md:grid md:grid-cols-4 gap-6 items-center justify-center">
          {banks.map((bank) => (
            <div
              key={bank.id}
              className="flex items-center justify-center bg-white rounded-[46px] border border-black p-4 hover:shadow-lg transition"
              // UBAH: Ukuran diperkecil dari 302px x 114px menjadi 240px x 90px
              style={{ width: '240px', height: '90px' }}
            >
              <img
                src={bank.logo}
                alt={bank.name}
                className="max-w-full max-h-full object-contain"
                onError={(e) => {
                  console.warn(`⚠️ Logo gagal load: ${bank.logo}, diganti default`);
                  e.target.src = defaultLogo;
                }}
              />
            </div>
          ))}
        </div>

        {/* Mobile Horizontal Scroll */}
        <div className="md:hidden overflow-x-auto scrollbar-hide">
          {/* UBAH: Jarak antar item diubah dari gap-6 menjadi gap-4 */}
          <div className="flex gap-4 pb-4">
            {banks.map((bank) => (
              <div
                key={bank.id}
                className="flex-shrink-0 flex items-center justify-center bg-white rounded-[46px] border border-black p-4"
                 // UBAH: Ukuran diperkecil dari 302px x 114px menjadi 240px x 90px
                style={{ width: '240px', height: '90px' }}
              >
                <img
                  src={bank.logo}
                  alt={bank.name}
                  className="max-w-full max-h-full object-contain"
                  onError={(e) => {
                    console.warn(`⚠️ Logo gagal load: ${bank.logo}, diganti default`);
                    e.target.src = defaultLogo;
                  }}
                />
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Custom CSS untuk menyembunyikan scrollbar */}
      <style jsx>{`
        .scrollbar-hide::-webkit-scrollbar {
          display: none;
        }
        .scrollbar-hide {
          -ms-overflow-style: none;
          scrollbar-width: none;
        }
      `}</style>
    </section>
  );
}

