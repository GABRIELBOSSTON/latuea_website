const ProjectSection = () => {
  const [project, setProject] = React.useState(null);
  const [loading, setLoading] = React.useState(true);

  React.useEffect(() => {
    fetch("http://localhost/LatuaGroup/api/get_featured_property.php")
      .then((res) => res.json())
      .then((data) => {
        if (Array.isArray(data) && data.length > 0) {
          setProject(data[0]);
        }
      })
      .catch((err) => console.error("Error fetching data:", err))
      .finally(() => setLoading(false));
  }, []);

  if (loading) {
    return (
      <section className="bg-white py-8 px-4 sm:px-6 text-center">
        <div className="bg-[#152047] py-12 rounded-3xl">
          <p className="text-white">Memuat data proyek...</p>
        </div>
      </section>
    );
  }

  if (!project) {
    return (
      <section className="bg-white py-8 px-4 sm:px-6 text-center">
        <div className="bg-[#152047] py-12 rounded-3xl">
          <p className="text-white">Tidak ada data proyek ditemukan.</p>
        </div>
      </section>
    );
  }

  const goToDetail = () => {
    window.location.href = `/LatuaGroup/pages/detail_property.php?id=${project.id}`;
  };

  return (
    <section className="bg-white pt-4 md:pt-6 pb-0 font-['Raleway']">
      {/* Background biru dimulai dari 30% bagian atas */}
      <div className="relative">
        {/* Spacer untuk area putih di atas */}
        <div className="h-[60px] sm:h-[80px] md:h-[100px] lg:h-[120px]"></div>
        
        {/* Background biru yang dimulai dari tengah card - FULL WIDTH */}
        <div className="absolute top-[200px] sm:top-[250px] md:top-[100px] lg:top-[240px] left-0 right-0 bottom-0 bg-[#152047]"></div>
        
        {/* Content dengan position relative agar di atas background */}
        <div className="relative max-w-7xl mx-auto flex flex-col lg:flex-row gap-6 md:gap-8 lg:gap-10 items-center pb-12 md:pb-16 lg:pb-20 px-4 sm:px-6">
          {/* === Card Properti === */}
          <div className="w-full lg:w-[674px] max-w-full bg-white rounded-3xl md:rounded-[44px] shadow-2xl overflow-hidden flex flex-col cursor-pointer transition-all duration-300 hover:shadow-2xl hover:scale-[1.01]">
            <div className="p-2 sm:p-3">
              <img
                src={`http://localhost${project.image_url}`}
                alt={project.title}
                className="w-full h-[250px] sm:h-[320px] md:h-[380px] lg:h-[435px] object-cover rounded-2xl md:rounded-[37px] transition-all duration-300 hover:scale-[1.02]"
                onError={(e) => (e.target.src = "/LatuaGroup/uploads/properties/default.jpg")}
              />
            </div>

            <div className="px-4 sm:px-5 pt-2 pb-3 flex flex-col">
              {/* Judul - Rata Tengah */}
              <h3 className="font-bold text-xl sm:text-2xl mb-1 text-black leading-tight line-clamp-1 text-center">{project.title}</h3>
              
              {/* Harga dan WhatsApp, Telepon */}
              <div className="flex flex-col sm:flex-row items-center justify-between gap-2 mb-1">
                <p className="text-xl sm:text-2xl font-bold text-[#334894] text-center sm:text-left">
                  Rp {Number(project.price).toLocaleString("id-ID")}
                </p>
                
                {/* Button untuk Mobile - Full Width dengan Text */}
                <div className="flex sm:hidden flex-col gap-2 w-full">
                  <button
                    className="bg-[#25D366] text-white flex items-center justify-center gap-2 py-3 px-4 rounded-lg hover:bg-[#20bd5a] transition-all duration-300 shadow-md hover:shadow-lg w-full font-medium"
                    onClick={(e) => {
                      e.stopPropagation();
                      window.open(`https://wa.me/${project.whatsapp || "6281234567890"}`, "_blank");
                    }}
                  >
                    <i className="fab fa-whatsapp text-xl"></i>
                    <span className="text-base">WhatsApp</span>
                  </button>
                  <button
                    className="bg-white border-2 border-gray-300 text-gray-700 flex items-center justify-center gap-2 py-3 px-4 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 shadow-md hover:shadow-lg w-full font-medium"
                    onClick={(e) => {
                      e.stopPropagation();
                      window.location.href = `tel:${project.phone || project.whatsapp || "6281234567890"}`;
                    }}
                  >
                    <i className="fas fa-phone text-xl"></i>
                    <span className="text-base">Telepon</span>
                  </button>
                </div>

                {/* Button untuk Desktop - Side by Side, Icon Only */}
                <div className="hidden sm:flex items-center gap-2 w-auto">
                  <button
                    className="bg-[#25D366] text-white flex items-center justify-center w-[110px] h-[40px] rounded-md hover:bg-[#20bd5a] transition-colors shadow-md"
                    onClick={(e) => {
                      e.stopPropagation();
                      window.open(`https://wa.me/${project.whatsapp || "6281234567890"}`, "_blank");
                    }}
                  >
                    <i className="fab fa-whatsapp text-lg"></i>
                  </button>
                  <button
                    className="bg-white border border-gray-300 text-gray-700 flex items-center justify-center w-[110px] h-[40px] rounded-md hover:bg-gray-50 transition-colors shadow-md"
                    onClick={(e) => {
                      e.stopPropagation();
                      window.location.href = `tel:${project.phone || project.whatsapp || "6281234567890"}`;
                    }}
                  >
                    <i className="fas fa-phone text-lg"></i>
                  </button>
                </div>
              </div>

              {/* Provinsi */}
              <div className="flex flex-col sm:flex-row items-center justify-between gap-2">
                <p className="text-base sm:text-[19px] text-[#736767] text-center sm:text-left w-full sm:w-auto">
                  {project.regency}, {project.province}
                </p>
              </div>
            </div>
          </div>

          {/* === Deskripsi Project === */}
          <div className="text-white max-w-2xl text-center lg:text-left">
            <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4 lg:mb-5">Project Terbaru</h2>
            <h3 className="text-lg sm:text-xl font-normal mb-3 sm:mb-4 opacity-90">Project Yang sedang kami kerjakan</h3>
            <p className="text-sm sm:text-base leading-relaxed opacity-85 mb-6 sm:mb-8">
              {project.description ||
                "Dengan lokasi strategis dan fasilitas bertaraf dunia, proyek terbaru kami bukan sekadar hunian, melainkan sebuah karya seni arsitektur. Rasakan pengalaman tinggal di lingkungan mewah yang hanya dimiliki oleh segelintir orang terpilih."}
            </p>
            <button
              className="bg-[#334894] text-white py-2.5 sm:py-3 px-6 sm:px-8 rounded-full font-semibold text-sm sm:text-base hover:bg-[#4a7dd9] hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#5B8DEE]/40 transition-all duration-300 cursor-pointer w-full sm:w-auto"
              onClick={goToDetail}
            >
              Lihat Properti
            </button>
          </div>
        </div>
      </div>
    </section>
  );
}