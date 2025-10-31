class WhyChooseUsSection extends React.Component {
  constructor(props) {
    super(props);
    this.state = { activeSlide: 0 };
    this.setSlide = this.setSlide.bind(this);
  }

  setSlide(index) {
    this.setState({ activeSlide: index });
  }

  render() {
    const { activeSlide } = this.state;

    const slides = [
      {
        image: "/LatuaGroup/uploads/team.PNG",
        quote: "Kami adalah perusahaan properti yang berkomitmen menghadirkan hunian premium dengan lokasi strategis, desain modern, serta fasilitas eksklusif yang mendukung gaya hidup berkelas.",
        title: "KENAPA MEMILIH KAMI?",
        subtitle: "KAMI",
      },
      {
        image: "/LatuaGroup/uploads/team.PNG",
        quote: `"Bergabung dengan Latuae Land memberikan saya banyak pengalaman berharga. Training yang diberikan sangat lengkap, mulai dari pengetahuan properti, teknik penjualan, hingga cara berkomunikasi dengan klien."`,
        author: "– Andi Pratama",
        role: "Property Consultant",
        title: "APA KATA AGEN",
        subtitle: "AGEN",
      },
    ];

    const current = slides[activeSlide];

    return (
      <section className="bg-white py-12 px-4 sm:px-6 relative">
        {/* JUDUL DINAMIS */}
        <div className="text-center mb-12">
          <p className="text-gray-500 text-lg">{current.subtitle}</p>
          <h2 className="text-3xl md:text-4xl font-bold text-gray-800 mt-1">
            {current.title}
          </h2>
          <div className="w-20 h-[3px] bg-[#353232] mx-auto mt-0.5 mb-6"></div>
        </div>

        {/* === MOBILE: FLEX COLUMN (SAMA KAYAK YANG KAMU SUKA) === */}
        <div className="block md:hidden">
          <div className="flex flex-col items-center space-y-6 max-w-md mx-auto">
            {/* Foto */}
            <div className="w-[88%]">
              <img
                src={current.image}
                alt="Slide"
                className="w-full h-64 sm:h-72 rounded-xl shadow-xl object-cover"
              />
            </div>

            {/* Box Teks */}
            <div className="relative w-[88%] bg-[#353232] text-white rounded-xl shadow-2xl p-6 sm:p-7">
              <div className="absolute -top-3 right-5 text-yellow-400 text-6xl font-black opacity-50 leading-none">
                "
              </div>
              <p className="text-sm sm:text-base leading-relaxed pt-6 pr-4 pl-1">
                {current.quote}
              </p>
              {current.author && (
                <div className="mt-5 pl-1">
                  <p className="font-semibold text-sm sm:text-base">{current.author}</p>
                  <p className="text-xs sm:text-sm text-gray-300">{current.role}</p>
                </div>
              )}
            </div>
          </div>
        </div>

        {/* === DESKTOP: ABSOLUTE + OVERLAP (SAMA PERSIS KAYAK KODE PERTAMA KAMU) === */}
        <div className="hidden md:block relative min-h-[450px] px-6 flex items-center justify-center pt-16 max-w-6xl mx-auto">
          {/* Foto (kiri) */}
          <div className="absolute top-[20px] left-[20px] md:left-[100px] w-full md:w-[400px] h-[350px] z-[2]">
            <img
              src={current.image}
              alt="Slide"
              className="rounded-xl shadow-2xl w-full h-full object-cover"
            />
          </div>

          {/* Box teks (kanan) */}
          <div className="absolute top-[80px] left-[200px] md:left-[350px] w-full md:w-[650px] h-[340px] bg-[#353232] text-white rounded-xl shadow-2xl p-8 z-[1]">
            <div className="absolute top-[-15px] right-6 text-yellow-400 text-[80px] font-black opacity-50">
              "
            </div>
            <p className="relative z-10 text-lg leading-relaxed pt-14 pl-32 md:pl-40 pr-8">
              {current.quote}
            </p>
            {current.author && (
              <>
                <p className="mt-4 font-semibold text-base pl-32 md:pl-40">{current.author}</p>
                <p className="text-sm pl-32 md:pl-40 text-gray-300">{current.role}</p>
              </>
            )}
          </div>
        </div>

        {/* DOTS */}
        <div className="flex justify-center mt-8 space-x-3">
          {slides.map((_, index) => (
            <button
              key={index}
              onClick={() => this.setSlide(index)}
              className={`w-4 h-4 rounded-full transition-all duration-300 ${
                index === activeSlide
                  ? "bg-[#353232] scale-110"
                  : "bg-gray-300 hover:bg-gray-400"
              }`}
            />
          ))}
        </div>
      </section>
    );
  }
}