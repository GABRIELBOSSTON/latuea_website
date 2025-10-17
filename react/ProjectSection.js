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
      <section className="bg-[#0E1B4D] py-20 px-6 text-center text-white">
        <p>Memuat data proyek...</p>
      </section>
    );
  }

  if (!project) {
    return (
      <section className="bg-[#0E1B4D] py-20 px-6 text-center text-white">
        <p>Tidak ada data proyek ditemukan.</p>
      </section>
    );
  }

  const goToDetail = () => {
    window.location.href = `/LatuaGroup/pages/detail_property.php?id=${project.id}`;
  };

  return (
    <section className="bg-[#0E1B4D] py-20 px-6">
      <div className="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center text-white">
        {/* === Card Properti === */}
        <div className="flex justify-center">
          <div
            className="w-[674px] h-[596px] bg-white rounded-[44px] shadow-lg overflow-hidden flex flex-col cursor-pointer transition-all duration-300 hover:shadow-2xl hover:scale-[1.01]"
            onClick={goToDetail}
          >
            <div className="p-3">
              <img
                src={`http://localhost${project.image_url}`}
                alt={project.title}
                className="w-[648px] h-[435px] object-cover rounded-[37px] transition-all duration-300 hover:scale-[1.02]"
                onError={(e) => (e.target.src = "/LatuaGroup/uploads/properties/default.jpg")}
              />
            </div>

            <div className="px-6 py-3 flex flex-col flex-grow">
              <h3 className="font-bold text-xl mb-1 text-gray-900">{project.title}</h3>
              <p className="text-gray-500 text-sm mb-1 flex items-center gap-1">
                <i className="fas fa-map-marker-alt text-blue-600"></i>
                {project.regency}, {project.province}
              </p>

              <div className="flex items-center justify-between my-3">
                <p className="text-gray-900 font-semibold text-lg">
                  Rp {Number(project.price).toLocaleString("id-ID")}
                </p>
                <span
                  className={`px-4 py-1.5 text-xs font-semibold rounded-full text-white tracking-wide ${
                    project.property_type === "for_sale" ? "bg-blue-800" : "bg-blue-500"
                  }`}
                >
                  {project.property_type === "for_sale" ? "JUAL" : "SEWA"}
                </span>
              </div>

              <p className="text-gray-600 text-sm line-clamp-2">
                {project.description || "Deskripsi properti belum tersedia."}
              </p>
            </div>

            <div className="flex justify-between items-center px-6 py-4 border-t border-gray-200">
              <button
                className="text-green-600 flex items-center gap-2 text-sm font-medium hover:underline"
                onClick={(e) => {
                  e.stopPropagation();
                  window.open(`https://wa.me/${project.whatsapp || "6281234567890"}`, "_blank");
                }}
              >
                <i className="fab fa-whatsapp"></i> WhatsApp
              </button>
              <button
                className="text-gray-700 text-sm font-medium hover:underline"
                onClick={(e) => {
                  e.stopPropagation();
                  if (project.brochure_url) window.open(project.brochure_url, "_blank");
                }}
              >
                E-Brochure
              </button>
            </div>
          </div>
        </div>

        {/* === Deskripsi Project === */}
        <div className="flex flex-col justify-center">
          <h2 className="text-3xl md:text-4xl font-bold mb-2 relative w-fit after:content-[''] after:block after:w-full after:h-[3px] after:bg-white after:mt-2">
            Project Terbaru
          </h2>
          <p className="text-gray-200 leading-relaxed mb-6">
            {project.description || "Deskripsi belum tersedia."}
          </p>
          <button
            className="bg-gradient-to-r from-[#3C4CAC] to-[#2A3990] text-white px-6 py-3 rounded-lg w-fit font-medium hover:opacity-90 transition"
            onClick={goToDetail}
          >
            Lihat Properti
          </button>
        </div>
      </div>
    </section>
  );
};
