const PropertyCard = ({ id, title, price, province, regency, property_type, image_url, description }) => {
  const goToDetail = () => {
    window.location.href = `/LatuaGroup/pages/detail_property.php?id=${id}`;
  };

  return (
    <div 
      className="min-w-[250px] max-w-[300px] bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition flex flex-col cursor-pointer"
      onClick={goToDetail}
    >
      {/* Gambar */}
      <img 
        src={image_url || "/LatuaGroup/uploads/properties/default.jpg"} 
        alt={title} 
        className="w-full h-48 object-cover"
        onError={(e) => e.target.src = "/LatuaGroup/uploads/properties/default.jpg"}
      />

      {/* Konten */}
      <div className="p-4 flex flex-col flex-grow">
        <h3 className="font-bold text-lg uppercase mb-1">{title}</h3>
        <p className="text-gray-500 text-sm mb-1">
          <i className="fas fa-map-marker-alt text-blue-600 mr-1"></i>
          {regency}, {province}
        </p>

        <div className="flex items-center justify-between mb-2">
          <p className="text-gray-900 font-bold">
            Rp {Number(price).toLocaleString("id-ID")}
          </p>
          <span className={`px-3 py-1 text-xs font-semibold rounded-full text-white 
            ${property_type === "for_sale" ? "bg-blue-800" : "bg-blue-500"}`}>
            {property_type === "for_sale" ? "JUAL" : "SEWA"}
          </span>
        </div>

        <p className="text-gray-600 text-sm line-clamp-2">
          {description || "Deskripsi properti belum tersedia."}
        </p>
      </div>
    </div>
  );
};
