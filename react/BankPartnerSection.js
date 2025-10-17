function BankPartnerSection() {
  const banks = [
    { id: 1, name: "Bank BCA", logo: "/LatuaGroup/uploads/banks/bca.jpeg" },
    { id: 2, name: "Bank Mandiri", logo: "/LatuaGroup/uploads/banks/mandiri.png" },
    { id: 3, name: "Bank BRI", logo: "/LatuaGroup/uploads/banks/bri.jpeg" },
    { id: 4, name: "Bank BNI", logo: "/LatuaGroup/uploads/banks/bni.jpeg" },
  ];

  const defaultLogo = "/LatuaGroup/uploads/banks/default.png"; // fallback logo

  return (
    <section className="py-12 px-6 bg-gray-50">
      <div className="max-w-6xl mx-auto text-center">
        {/* Title */}
        <h2 className="text-2xl md:text-3xl font-bold text-gray-800 mb-8">
          KERJA SAMA BANK
        </h2>

        {/* Logo Grid */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 items-center justify-center">
          {banks.map((bank) => (
            <div
              key={bank.id}
              className="flex items-center justify-center bg-white rounded-xl shadow-md p-4 hover:shadow-lg transition"
            >
              <img
                src={bank.logo}
                alt={bank.name}
                className="w-32 h-20 object-contain border border-gray-200 bg-white"
                onError={(e) => {
                  console.warn(`⚠️ Logo gagal load: ${bank.logo}, diganti default`);
                  e.target.src = defaultLogo;
                }}
              />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
