class WhyChooseUsSection extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      activeSlide: 0
    };

    this.setSlide = this.setSlide.bind(this);
  }

  setSlide(index) {
    this.setState({ activeSlide: index });
  }

  render() {
    const { activeSlide } = this.state;

    const slides = [
      // === SLIDE 1: Kenapa Memilih Kami ===
      (
        <div className="flex flex-col md:flex-row items-center justify-center gap-8 min-h-[500px] px-6">
          {/* Foto */}
          <div className="w-full md:w-1/2">
            <img
              src="/LatuaGroup/uploads/team.PNG"
              alt="Tim Latuae Land"
              className="rounded-xl shadow-2xl w-full h-[350px] object-cover"
            />
          </div>

          {/* Box teks */}
          <div className="bg-[#1F2937] text-white rounded-xl shadow-2xl w-full md:w-1/2 p-10 relative">
            <div className="absolute top-[-20px] left-6 text-yellow-400 text-[100px] font-black opacity-50">
              &rdquo;
            </div>
            <p className="relative z-10 text-lg leading-relaxed">
              Kami adalah perusahaan properti yang berkomitmen menghadirkan hunian
              premium dengan lokasi strategis, desain modern, serta fasilitas
              eksklusif yang mendukung gaya hidup berkelas.
            </p>
          </div>
        </div>
      ),

      // === SLIDE 2: Apa Kata Agen ===
      (
        <div className="flex flex-col md:flex-row items-center justify-center gap-8 min-h-[500px] px-6">
          {/* Foto Agen */}
          <div className="w-full md:w-1/2">
            <img
              src="/LatuaGroup/uploads/team.PNG"
              alt="Foto Agen"
              className="rounded-xl shadow-2xl w-full h-[350px] object-cover"
            />
          </div>

          {/* Box Testimoni */}
          <div className="bg-[#1F2937] text-white rounded-xl shadow-2xl w-full md:w-1/2 p-10 relative">
            <div className="absolute top-[-20px] left-6 text-yellow-400 text-[100px] font-black opacity-50">
              &rdquo;
            </div>
            <p className="relative z-10 text-lg leading-relaxed">
              “Bergabung dengan Latuae Land memberikan saya banyak pengalaman
              berharga. Training yang diberikan sangat lengkap, mulai dari
              pengetahuan properti, teknik penjualan, hingga cara berkomunikasi
              dengan klien.”
            </p>
            <p className="mt-6 font-semibold">– Andi Pratama</p>
            <p className="text-sm">Property Consultant</p>
          </div>
        </div>
      ),
    ];

    return (
      <section className="bg-white py-12 px-4 sm:px-6 relative overflow-hidden">
        {/* Judul dinamis */}
        <div className="text-center mb-12">
          {activeSlide === 0 ? (
            <>
              <p className="text-gray-500 text-lg">KAMI</p>
              <h2 className="text-3xl md:text-4xl font-bold text-gray-800 mt-1">
                KENAPA MEMILIH KAMI?
              </h2>
              <div className="w-20 h-[3px] bg-[#334894] mx-auto mt-0.5 mb-6"></div>
            </>
          ) : (
            <>
              <p className="text-gray-500 text-lg">AGEN</p>
              <h2 className="text-3xl md:text-4xl font-bold text-gray-800 mt-1">
                APA KATA AGEN
              </h2>
              <div className="w-20 h-[3px] bg-[#334894] mx-auto mt-0.5 mb-6"></div>
            </>
          )}
        </div>

        {/* SLIDER WRAPPER */}
        <div className="relative w-full max-w-6xl mx-auto overflow-hidden">
          <div
            className="flex transition-transform duration-700 ease-in-out"
            style={{ transform: `translateX(-${activeSlide * 100}%)` }}
          >
            {slides.map((slide, index) => (
              <div key={index} className="w-full flex-shrink-0">
                {slide}
              </div>
            ))}
          </div>
        </div>

        {/* Dot Navigation */}
        <div className="flex justify-center mt-8 space-x-3">
          {slides.map((_, index) => (
            <button
              key={index}
              onClick={() => this.setSlide(index)}
              className={`w-4 h-4 rounded-full transition ${
                index === activeSlide ? "bg-blue-600" : "bg-gray-300"
              }`}
            ></button>
          ))}
        </div>
      </section>
    );
  }
}