function ActivitySection() {
  const activities = [
    {
      id: 1,
      img: "../uploads/aktivitas1.png", // gambar dari folder uploads
      desc: "Cluster premium dengan akses tol mudah, pusat belanja ternama, dan Club House yang nyaman untuk keluarga Anda.",
    },
    {
      id: 2,
      img: "../uploads/aktivitas2.png",
      desc: "Hunian modern dengan keamanan 24 jam, lingkungan asri, dan fasilitas olahraga lengkap untuk keluarga.",
    },
    {
      id: 3,
      img: "../uploads/aktivitas3.png",
      desc: "Lokasi strategis dekat pusat bisnis, sekolah, dan rumah sakit dengan desain rumah eksklusif.",
    },
  ];

  return (
    <section className="py-16 px-6 bg-white">
      {/* Judul Section */}
      <div className="max-w-6xl mx-auto text-center mb-12">
        <h3 className="text-gray-500 uppercase tracking-wide">AKTIVITAS</h3>
        <h2 className="text-3xl md:text-4xl font-bold text-gray-900">
          AKTIVITAS KAMI
        </h2>
        <div className="w-20 h-[3px] bg-[#334894] mx-auto mt-0.5 mb-6"></div>
      </div>

      {/* Cards */}
      <div className="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">
        {activities.map((item) => (
          <div
            key={item.id}
            className="bg-white rounded-[65px] border border-black shadow-md overflow-hidden flex flex-col"
          >
            {/* Gambar */}
            <div className="w-full h-60 bg-gray-200 overflow-hidden rounded-t-[65px]">
              {item.img ? (
                <img
                  src={item.img}
                  alt={`Activity ${item.id}`}
                  className="w-full h-full object-cover"
                />
              ) : (
                <div className="w-full h-full flex items-center justify-center text-gray-500 text-sm">
                  Gambar di sini
                </div>
              )}
            </div>

            {/* Deskripsi */}
            <div className="p-5 flex flex-col flex-grow text-center">
              <p className="text-gray-600 text-sm leading-relaxed">
                {item.desc}
              </p>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}