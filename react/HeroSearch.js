const HeroSearch = () => {
  const [activeTab, setActiveTab] = React.useState("for_sale");
  const [keyword, setKeyword] = React.useState("");
  const [propertyType, setPropertyType] = React.useState("");
  const [sort, setSort] = React.useState("cheap");

  const handleSearch = () => {
    const query = new URLSearchParams({
      q: keyword,
      type: activeTab,
      property: propertyType,
      sort: sort,
    }).toString();

    window.location.href = `/LatuaGroup/pages/listproperty.php?${query}`;
  };

  return (
    <div className="relative w-full h-[320px] md:h-[400px] font-['Raleway']">
      {/* Background */}
      <img
        src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
        alt="bg"
        className="absolute inset-0 w-full h-full object-cover"
      />
      <div className="absolute inset-0 bg-black/40"></div>

      {/* Search Box */}
      <div className="relative flex flex-col items-center justify-center h-full px-4">
        <div className="bg-[#0E1B4D]/95 rounded-3xl w-full max-w-5xl shadow-2xl text-white overflow-hidden backdrop-blur-md">

          {/* Tabs */}
          <div className="flex text-base font-medium border-b border-white/20">
            <button
              onClick={() => setActiveTab("for_sale")}
              className={`flex-1 py-4 transition-all ${
                activeTab === "for_sale"
                  ? "border-b-2 border-white font-semibold"
                  : "opacity-70 hover:opacity-100"
              }`}
            >
              Properti Dijual
            </button>
            <button
              onClick={() => setActiveTab("for_rent")}
              className={`flex-1 py-4 transition-all ${
                activeTab === "for_rent"
                  ? "border-b-2 border-white font-semibold"
                  : "opacity-70 hover:opacity-100"
              }`}
            >
              Properti Disewa
            </button>
          </div>

          {/* Input Row */}
          <div className="flex flex-col md:flex-row items-center gap-3 px-6 py-5 bg-[#0E1B4D]">
            <div className="flex items-center bg-white rounded-full flex-1 px-5 py-2 shadow-inner">
              <i className="fas fa-search text-gray-400 mr-2"></i>
              <input
                type="text"
                placeholder="Cari properti berdasarkan nama, provinsi, atau kota..."
                value={keyword}
                onChange={(e) => setKeyword(e.target.value)}
                className="flex-1 text-gray-700 placeholder-gray-400 focus:outline-none bg-transparent"
              />
            </div>
            <button
              onClick={handleSearch}
              className="bg-[#3C4CAC] hover:bg-[#2A3990] px-8 py-2.5 rounded-full font-semibold transition text-white whitespace-nowrap"
            >
              Cari Properti
            </button>
          </div>

          {/* Filters */}
          <div className="flex flex-wrap justify-center md:justify-start gap-4 px-6 py-4 bg-[#152047] rounded-b-3xl text-gray-100">
            <select
              className="px-5 py-2 bg-white text-gray-800 rounded-full border border-gray-300 text-sm focus:outline-none"
              value={propertyType}
              onChange={(e) => setPropertyType(e.target.value)}
            >
              <option value="">Jenis Properti</option>
              <option value="Rumah">Rumah</option>
              <option value="Apartemen">Apartemen</option>
              <option value="Ruko">Ruko</option>
              <option value="Tanah">Tanah</option>
              <option value="Other">Other</option>
            </select>

            <select
              className="px-5 py-2 bg-white text-gray-800 rounded-full border border-gray-300 text-sm focus:outline-none"
              value={sort}
              onChange={(e) => setSort(e.target.value)}
            >
              <option value="cheap">Harga Termurah</option>
              <option value="expensive">Harga Termahal</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  );
};


