const HeroSearch = () => {

  const [activeTab, setActiveTab] = React.useState("for_sale");

  const [keyword, setKeyword] = React.useState("");

  const [propertyType, setPropertyType] = React.useState("");

  const [sort, setSort] = React.useState("");



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

    <div className="relative w-full h-[320px] md:h-[400px] lg:h-[500px] font-['Raleway']">

      {/* Background */}

      <img

        src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"

        alt="bg"

        className="absolute inset-0 w-full h-full object-cover"

      />

      <div className="absolute inset-0 bg-black/40"></div>



      {/* Search Box */}

      <div className="relative flex flex-col items-center justify-center h-full px-4 sm:px-6">

        <div className="bg-[#0E1B4D]/95 rounded-3xl w-full max-w-5xl shadow-2xl text-white overflow-hidden backdrop-blur-md">

          {/* Tabs */}

          <div className="flex text-base font-medium border-b border-white/10 relative">

            {/* Animated underline */}

            <div 

              className="absolute bottom-0 h-0.5 bg-white transition-all duration-500 ease-out"

              style={{

                width: '50%',

                left: activeTab === "for_sale" ? '0%' : '50%'

              }}

            ></div>

            

            <button

              onClick={() => setActiveTab("for_sale")}

              className={`flex-1 py-4 transition-all duration-500 ease-out relative ${

                activeTab === "for_sale"

                  ? "font-semibold"

                  : "opacity-60 hover:opacity-90"

              }`}

            >

              <span className="text-white">Properti Dijual</span>

            </button>

            <button

              onClick={() => setActiveTab("for_rent")}

              className={`flex-1 py-4 transition-all duration-500 ease-out relative ${

                activeTab === "for_rent"

                  ? "font-semibold"

                  : "opacity-60 hover:opacity-90"

              }`}

            >

              <span className="text-white">Properti Disewa</span>

            </button>

          </div>



          {/* Input Row */}

          <div className="flex flex-col md:flex-row items-center gap-3 px-6 py-5 bg-[#0E1B4D]">

            <div className="flex items-center bg-white rounded-full flex-1 px-4 py-2 shadow-inner max-w-[300px] sm:max-w-[400px] md:max-w-none transition-all duration-300 ease-out hover:shadow-lg">

              <i className="fas fa-search text-gray-400 mr-2"></i>

              <input

                type="text"

                placeholder="Cari properti berdasarkan nama, provinsi, atau kota..."

                value={keyword}

                onChange={(e) => setKeyword(e.target.value)}

                className="flex-1 text-gray-700 placeholder-gray-400 focus:outline-none bg-transparent text-sm sm:text-base"

              />

            </div>

            <button

              onClick={handleSearch}

              className="bg-[#3C4CAC] hover:bg-[#2A3990] px-6 py-2 rounded-full font-semibold transition-all duration-300 ease-out text-white whitespace-nowrap text-sm sm:text-base hover:shadow-lg hover:scale-[1.02] active:scale-[0.98]"

            >

              Cari Properti

            </button>

          </div>



          {/* Filters */}

          <div className="flex flex-col sm:flex-row justify-center md:justify-start gap-4 px-6 py-4 bg-[#152047] rounded-b-3xl text-gray-100">

            <div className="relative w-full sm:w-auto group">

              <select

                className="w-full px-5 py-2.5 pr-12 bg-white/10 backdrop-blur-sm text-white rounded-full text-sm focus:outline-none appearance-none cursor-pointer transition-all duration-300 ease-out hover:bg-white/20 focus:bg-white/20 border border-white/20 hover:border-white/40 focus:border-white/40"

                value={propertyType}

                onChange={(e) => setPropertyType(e.target.value)}

              >

                <option value="" className="text-gray-700 bg-white">Jenis Properti</option>

                <option value="Rumah" className="text-gray-700 bg-white">Rumah</option>

                <option value="Apartemen" className="text-gray-700 bg-white">Apartemen</option>

                <option value="Ruko" className="text-gray-700 bg-white">Ruko</option>

                <option value="Tanah" className="text-gray-700 bg-white">Tanah</option>

                <option value="Other" className="text-gray-700 bg-white">Other</option>

              </select>

              <div className="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 transition-transform duration-300 ease-out group-hover:translate-y-0.5">

                <svg className="w-4 h-4 text-white transition-transform duration-300 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path>

                </svg>

              </div>

            </div>



            <div className="relative w-full sm:w-auto group">

              <select

                className="w-full px-5 py-2.5 pr-12 bg-white/10 backdrop-blur-sm text-white rounded-full text-sm focus:outline-none appearance-none cursor-pointer transition-all duration-300 ease-out hover:bg-white/20 focus:bg-white/20 border border-white/20 hover:border-white/40 focus:border-white/40"

                value={sort}

                onChange={(e) => setSort(e.target.value)}

              >

                <option value="" className="text-gray-700 bg-white">Urutkan</option>

                <option value="cheap" className="text-gray-700 bg-white">Harga Termurah</option>

                <option value="expensive" className="text-gray-700 bg-white">Harga Termahal</option>

              </select>

              <div className="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 transition-transform duration-300 ease-out group-hover:translate-y-0.5">

                <svg className="w-4 h-4 text-white transition-transform duration-300 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path>

                </svg>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  );

};