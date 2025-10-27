const PropertyList = () => {
  const [properties, setProperties] = React.useState([]);
  const [loading, setLoading] = React.useState(true);
  const sliderRef = React.useRef(null);
  const isScrolling = React.useRef(false);
  const startX = React.useRef(0);
  const scrollLeft = React.useRef(0);
  const velocity = React.useRef(0);
  const animationId = React.useRef(null);

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

  // Apple-style momentum scrolling
  const applyMomentum = () => {
    if (Math.abs(velocity.current) > 0.5) {
      velocity.current *= 0.95; // Decay factor untuk smooth stop
      sliderRef.current.scrollLeft += velocity.current;
      animationId.current = requestAnimationFrame(applyMomentum);
    } else {
      velocity.current = 0;
    }
  };

  const handleMouseDown = (e) => {
    isScrolling.current = true;
    startX.current = e.pageX - sliderRef.current.offsetLeft;
    scrollLeft.current = sliderRef.current.scrollLeft;
    velocity.current = 0;
    
    if (animationId.current) {
      cancelAnimationFrame(animationId.current);
    }
    
    sliderRef.current.style.cursor = 'grabbing';
    sliderRef.current.style.userSelect = 'none';
  };

  const handleMouseMove = (e) => {
    if (!isScrolling.current) return;
    e.preventDefault();
    
    const x = e.pageX - sliderRef.current.offsetLeft;
    const walk = (x - startX.current) * 2; // Multiplier untuk sensitivitas
    const newScrollLeft = scrollLeft.current - walk;
    
    velocity.current = sliderRef.current.scrollLeft - newScrollLeft;
    sliderRef.current.scrollLeft = newScrollLeft;
  };

  const handleMouseUp = () => {
    if (isScrolling.current) {
      isScrolling.current = false;
      sliderRef.current.style.cursor = 'grab';
      sliderRef.current.style.userSelect = 'auto';
      
      // Start momentum
      animationId.current = requestAnimationFrame(applyMomentum);
    }
  };

  const handleMouseLeave = () => {
    if (isScrolling.current) {
      handleMouseUp();
    }
  };

  // Touch events untuk mobile
  const handleTouchStart = (e) => {
    startX.current = e.touches[0].pageX;
    scrollLeft.current = sliderRef.current.scrollLeft;
    velocity.current = 0;
    
    if (animationId.current) {
      cancelAnimationFrame(animationId.current);
    }
  };

  const handleTouchMove = (e) => {
    const x = e.touches[0].pageX;
    const walk = (startX.current - x) * 1.5;
    const newScrollLeft = scrollLeft.current + walk;
    
    velocity.current = sliderRef.current.scrollLeft - newScrollLeft;
    sliderRef.current.scrollLeft = newScrollLeft;
  };

  const handleTouchEnd = () => {
    // Start momentum untuk touch
    animationId.current = requestAnimationFrame(applyMomentum);
  };

  // Cleanup
  React.useEffect(() => {
    return () => {
      if (animationId.current) {
        cancelAnimationFrame(animationId.current);
      }
    };
  }, []);

  if (loading) return <p className="text-center text-gray-500">Loading...</p>;

  return (
    <div className="relative pt-6 bg-[#FFFFFF]">
      <h2 className="text-center text-gray-400 text-sm uppercase">Properti</h2>
      <h1 className="text-2xl font-bold text-center mb-1">Properti Terbaru</h1>
      <div className="w-20 h-[3px] bg-[#334894] mx-auto mt-0.5 mb-6"></div>

      <div 
        ref={sliderRef}
        id="property-slider" 
        className="flex gap-6 overflow-x-auto px-6 pb-4 scrollbar-hide" 
        style={{ 
          WebkitOverflowScrolling: 'touch',
          scrollbarWidth: 'none',
          msOverflowStyle: 'none',
          cursor: 'grab'
        }}
        onMouseDown={handleMouseDown}
        onMouseMove={handleMouseMove}
        onMouseUp={handleMouseUp}
        onMouseLeave={handleMouseLeave}
        onTouchStart={handleTouchStart}
        onTouchMove={handleTouchMove}
        onTouchEnd={handleTouchEnd}
      >
        {properties.length === 0 
          ? <p className="col-span-full text-center text-gray-500">Belum ada properti tersedia.</p>
          : properties.map((p) => <PropertyCard key={p.id} {...p} />)}
      </div>

      <style jsx>{`
        .scrollbar-hide::-webkit-scrollbar {
          display: none;
        }
        
        #property-slider {
          scroll-snap-type: x proximity;
          -webkit-overflow-scrolling: touch;
        }
        
        #property-slider > * {
          scroll-snap-align: start;
        }
      `}</style>
    </div>
  );
};