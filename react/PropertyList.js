const PropertyList = () => {
  const [properties, setProperties] = React.useState([]);
  const [loading, setLoading] = React.useState(true);

  React.useEffect(() => {
    fetch("/LatuaGroup/api/get_properties.php")
      .then(res => res.json())
      .then(data => {
        setProperties(data);
        setLoading(false);
      })
      .catch(err => {
        console.error("Error fetching properties:", err);
        setLoading(false);
      });
  }, []);

  if (loading) return <p className="text-center text-gray-500">Loading...</p>;

  return (
    <div className="relative">
      <h2 className="text-center text-gray-400 text-sm uppercase">Properti</h2>
      <h1 className="text-2xl font-bold text-center mb-6">Properti Terbaru</h1>

      <div id="property-slider" className="flex gap-6 overflow-x-auto px-6 pb-4 scrollbar-hide">
        {properties.length === 0 
          ? <p className="col-span-full text-center text-gray-500">Belum ada properti tersedia.</p>
          : properties.map((p) => <PropertyCard key={p.id} {...p} />)}
      </div>
    </div>
  );
};
