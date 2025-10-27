const PropertyCard = ({ id, title, price, province, regency, property_type, image_url, description }) => {
  const goToDetail = () => {
    window.location.href = `/LatuaGroup/pages/detail_property.php?id=${id}`;
  };
  return (
    <div 
      className="w-full sm:w-[280px] h-auto sm:h-[430px] flex-shrink-0 bg-white rounded-[25px] sm:rounded-[55px] shadow-sm overflow-hidden border border-[rgba(208, 203, 203, 0.66)] hover:shadow-xl transition flex flex-col cursor-pointer mx-auto sm:mx-0"
      onClick={goToDetail}
    >
      {/* Gambar */}
      <img  
        src={image_url || "/LatuaGroup/uploads/properties/default.jpg"} 
        alt={title} 
        className="w-full h-[180px] sm:h-[230px] object-cover rounded-t-[25px] sm:rounded-t-[55px] rounded-b-[25px] sm:rounded-b-[55px]"
        onError={(e) => e.target.src = "/LatuaGroup/uploads/properties/default.jpg"}
      />
      {/* Konten */}
      <div className="p-4 sm:p-4 flex flex-col flex-grow rounded-b-[25px] sm:rounded-b-[55px]">
        <h3 className="font-bold text-base sm:text-xl text-gray-800 mb-2 line-clamp-1 text-left">
          {title}
        </h3>
        <p className="text-gray-500 text-xs mb-2 text-left">
          <i className="fas fa-map-marker-alt text-blue-600 mr-1"></i>
          {regency}, {province}
        </p>
        <div className="flex flex-row items-center justify-between mb-3 gap-2">
          <p className="text-gray-900 font-bold text-sm sm:text-base text-left">
            Rp {Number(price).toLocaleString("id-ID")}
          </p>
          <span className={`px-3 py-1 text-xs font-semibold rounded-full text-white whitespace-nowrap
            ${property_type === "for_sale" ? "bg-blue-800" : "bg-blue-500"}`}>
            {property_type === "for_sale" ? "JUAL" : "SEWA"}
          </span>
        </div>
        <p className="text-gray-600 text-xs leading-relaxed line-clamp-2 flex-grow text-left">
          {description || "Deskripsi properti belum tersedia."}
        </p>
      </div>
    </div>
  );
};