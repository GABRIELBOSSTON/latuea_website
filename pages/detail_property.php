<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// Ambil ID property dari URL
$property_id = $_GET['id'] ?? null;
if (!$property_id) {
    die("Property tidak ditemukan.");
}

// Ambil data property + agen (pakai agent_id)
$stmt = $pdo->prepare("
  SELECT 
      p.*, 
      a.name AS agent_name, 
      a.phone_number, 
      a.email, 
      a.photo_path
  FROM properties p
  LEFT JOIN agents a ON p.agent_id = a.id
  WHERE p.id = ?
");
$stmt->execute([$property_id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    die("Property tidak ditemukan.");
}

// Ambil semua gambar properti (utama dulu)
$stmtImg = $pdo->prepare("
    SELECT id, image_path, is_main 
    FROM property_images 
    WHERE property_id = ? 
    ORDER BY is_main DESC, id ASC
");
$stmtImg->execute([$property_id]);
$images = $stmtImg->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../includes/header.php'; ?>

<!-- Google Fonts Raleway -->
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
  body {
    font-family: "Raleway", sans-serif;
    background-color: #f9fafb;
  }
  
  /* Gallery Animations */
  .gallery-image {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }
  
  .gallery-image:hover {
    transform: scale(1.02);
    filter: brightness(1.1);
  }
  
  /* Lightbox Animations */
  .lightbox-overlay {
    animation: fadeIn 0.3s ease-out;
  }
  
  .lightbox-overlay.closing {
    animation: fadeOut 0.3s ease-out;
  }
  
  @keyframes fadeIn {
    from {
      opacity: 0;
      backdrop-filter: blur(0px);
    }
    to {
      opacity: 1;
      backdrop-filter: blur(8px);
    }
  }
  
  @keyframes fadeOut {
    from {
      opacity: 1;
      backdrop-filter: blur(8px);
    }
    to {
      opacity: 0;
      backdrop-filter: blur(0px);
    }
  }
  
  .lightbox-image {
    animation: zoomIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  }
  
  @keyframes zoomIn {
    from {
      opacity: 0;
      transform: scale(0.5) translateY(30px);
    }
    to {
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }
  
  .slide-left {
    animation: slideFromRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }
  
  .slide-right {
    animation: slideFromLeft 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }
  
  @keyframes slideFromRight {
    from {
      opacity: 0;
      transform: translateX(100px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }
  
  @keyframes slideFromLeft {
    from {
      opacity: 0;
      transform: translateX(-100px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }
  
  .nav-button {
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }
  
  .nav-button:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.1);
  }
  
  .close-button {
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }
  
  .close-button:hover {
    background: rgba(255, 0, 0, 0.4);
    transform: rotate(90deg) scale(1.1);
  }
  
  .counter-badge {
    backdrop-filter: blur(10px);
    background: rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: slideUp 0.5s ease-out 0.2s backwards;
  }
  
  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .spinner {
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top: 3px solid white;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  /* Agent Card Styling - Figma Design */
  .agent-card {
    background: #ffffff;
    border-radius: 70px;
    border: 2px solid #000;
    width: 100%;
    max-width: 422px;
    min-height: 388px;
    transition: all 0.3s ease;
  }

  .agent-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
  }

  .agent-avatar {
    border: 3px solid #e5e7eb;
    transition: all 0.3s ease;
  }

  .agent-avatar:hover {
    transform: scale(1.05);
    border-color: #000;
  }

  .contact-btn {
    transition: all 0.3s ease;
    border-radius: 50px;
    font-weight: 600;
  }

  .contact-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
  }

  .wa-btn {
    background: #25D366;
  }

  .wa-btn:hover {
    background: #128C7E;
  }

  .call-btn {
    background: #4285F4;
  }

  .call-btn:hover {
    background: #2563EB;
  }

  /* Responsive Design */
  @media (max-width: 1024px) {
    .agent-card {
      max-width: 100%;
      min-height: auto;
    }
    
    .gallery-container {
      height: auto !important;
    }
    
    .gallery-main {
      height: 400px !important;
    }
    
    .gallery-thumbs {
      display: none;
    }
  }

  @media (max-width: 768px) {
    .agent-card {
      border-radius: 40px;
      padding: 2rem !important;
    }
    
    .gallery-main {
      height: 300px !important;
      border-radius: 30px !important;
    }
    
    .property-info-card,
    .description-card,
    .facilities-card {
      padding: 1.5rem !important;
    }
  }

  @media (max-width: 640px) {
    .agent-card {
      border-radius: 30px;
      padding: 1.5rem !important;
    }
    
    .contact-btn {
      padding: 0.75rem 1rem !important;
      font-size: 0.875rem !important;
    }
  }
</style>

<div class="max-w-[1200px] mx-auto px-4 py-6">

  <!-- Back Button -->
  <div class="mb-6">
    <a href="javascript:history.back()" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors duration-300">
      <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
  </div>

  <!-- Main Content: Gallery + Agent Card -->
  <div class="flex flex-col lg:flex-row gap-6 mb-8">
    
    <!-- Gallery Section -->
    <div class="flex-1">
      <div class="gallery-container grid grid-cols-1 lg:grid-cols-[4fr_1.2fr] gap-2 h-[540px]">
        <!-- Main Image -->
        <div class="gallery-main h-full overflow-hidden rounded-l-[45px] lg:rounded-l-[45px] rounded-r-[45px] lg:rounded-r-none cursor-pointer gallery-image" onclick="openLightbox(0)">
          <?php if (!empty($images[0]['image_path'])): ?>
            <div class="w-full h-full bg-center bg-cover"
                 style="background-image:url('/LatuaGroup/uploads/properties/<?= htmlspecialchars($images[0]['image_path']) ?>')"></div>
          <?php else: ?>
            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
              <i class="fas fa-image text-gray-400 text-6xl"></i>
            </div>
          <?php endif; ?>
        </div>

        <!-- Thumbnails -->
        <div class="gallery-thumbs hidden lg:grid grid-rows-3 gap-2 h-full">
          <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="overflow-hidden <?= $i === 1 ? 'rounded-tr-[45px]' : '' ?> <?= $i === 3 ? 'rounded-br-[45px]' : '' ?> cursor-pointer gallery-image" onclick="openLightbox(<?= $i ?>)">
              <?php if (!empty($images[$i]['image_path'])): ?>
                <div class="w-full h-full bg-center bg-cover"
                     style="background-image:url('/LatuaGroup/uploads/properties/<?= htmlspecialchars($images[$i]['image_path']) ?>')"></div>
              <?php else: ?>
                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                  <i class="fas fa-image text-gray-400 text-2xl"></i>
                </div>
              <?php endif; ?>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>

    <!-- Agent Card - Figma Style -->
    <div class="w-full lg:w-auto flex justify-center lg:justify-start">
      <div class="agent-card p-8 flex flex-col items-center text-center">
        
        <!-- Agent Photo -->
        <?php if (!empty($property['photo_path']) && file_exists($_SERVER['DOCUMENT_ROOT'] . "/LatuaGroup/Uploads/agents/" . $property['photo_path'])): ?>
          <img src="/LatuaGroup/Uploads/agents/<?= htmlspecialchars($property['photo_path']) ?>" 
               alt="<?= htmlspecialchars($property['agent_name']) ?>" 
               class="agent-avatar w-28 h-28 rounded-full object-cover mb-5 shadow-md">
        <?php else: ?>
          <div class="agent-avatar w-28 h-28 rounded-full bg-gray-100 flex items-center justify-center mb-5 shadow-md">
            <i class="fas fa-user text-gray-400 text-4xl"></i>
          </div>
        <?php endif; ?>

        <!-- Agent Name -->
        <h3 class="font-bold text-2xl text-gray-900 mb-4">
          <?= htmlspecialchars($property['agent_name'] ?? 'Agent Name') ?>
        </h3>

        <!-- Contact Info -->
        <div class="space-y-3 mb-6 w-full">
          <div class="flex items-center justify-center text-gray-700 text-base">
            <i class="fas fa-phone-alt mr-3 text-gray-500"></i>
            <span><?= htmlspecialchars($property['phone_number'] ?? '(021) 2991 8900') ?></span>
          </div>
          <div class="flex items-center justify-center text-gray-700 text-sm">
            <i class="fas fa-envelope mr-3 text-gray-500"></i>
            <span><?= htmlspecialchars($property['email'] ?? 'agent@email.com') ?></span>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 w-full px-4">
          <?php if (!empty($property['phone_number'])): ?>
            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $property['phone_number']) ?>" 
               target="_blank" 
               class="wa-btn contact-btn flex-1 text-white px-6 py-3 font-semibold text-sm flex items-center justify-center gap-2 shadow-md">
               <i class="fab fa-whatsapp text-xl"></i>
            </a>
            <a href="tel:<?= preg_replace('/[^0-9]/', '', $property['phone_number']) ?>" 
               class="call-btn contact-btn flex-1 text-white px-6 py-3 font-semibold text-sm flex items-center justify-center gap-2 shadow-md">
               <i class="fas fa-phone-alt text-lg"></i>
            </a>
          <?php else: ?>
            <button class="wa-btn contact-btn flex-1 text-white px-6 py-3 font-semibold text-sm flex items-center justify-center gap-2 shadow-md opacity-50 cursor-not-allowed">
              <i class="fab fa-whatsapp text-xl"></i>
            </button>
            <button class="call-btn contact-btn flex-1 text-white px-6 py-3 font-semibold text-sm flex items-center justify-center gap-2 shadow-md opacity-50 cursor-not-allowed">
              <i class="fas fa-phone-alt text-lg"></i>
            </button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Property Info -->
  <div class="property-info-card bg-white rounded-2xl shadow-sm p-6 md:p-8 mb-6">
    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
      <div class="flex-1">
        <div class="flex flex-wrap items-center gap-3 mb-3">
          <h2 class="text-2xl md:text-4xl font-bold text-gray-900">
            Rp <?= number_format($property['price'], 0, ',', '.') ?>
          </h2>
          <span class="px-4 py-1 rounded-full text-sm font-semibold whitespace-nowrap <?= $property['property_type'] === 'for_sale' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' ?>">
            <?= $property['property_type'] === 'for_sale' ? "DIJUAL" : "DISEWA" ?>
          </span>
        </div>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($property['title']) ?></h1>
        <p class="text-gray-600 flex items-center gap-2 text-sm md:text-base">
          <i class="fas fa-map-marker-alt text-red-500"></i>
          <?= htmlspecialchars($property['regency']) ?>, <?= htmlspecialchars($property['province']) ?>
        </p>
      </div>
    </div>
    <p class="text-xs md:text-sm text-gray-400">
      <i class="far fa-calendar-alt mr-2"></i>
      Diposting pada: <?= date("j F Y", strtotime($property['created_at'])) ?>
    </p>
  </div>

  <!-- Description Section -->
  <div class="description-card bg-white rounded-2xl shadow-sm p-6 md:p-8 mb-6">
    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">Deskripsi</h2>
    <div class="text-gray-700 leading-relaxed text-sm md:text-base whitespace-pre-line">
      <?= nl2br(htmlspecialchars($property['description'])) ?>
    </div>
  </div>

  <!-- Facilities Section -->
  <div class="facilities-card bg-white rounded-2xl shadow-sm p-6 md:p-8 mb-6">
    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200">Fasilitas</h2>
    <?php if (!empty($property['facilities'])): ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        <?php foreach (explode(',', $property['facilities']) as $f): ?>
          <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg">
            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
              <i class="fas fa-check text-white text-sm"></i>
            </div>
            <span class="text-gray-700 font-medium text-sm md:text-base"><?= htmlspecialchars(trim($f)) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-gray-500 text-center py-4 text-sm md:text-base">Tidak ada fasilitas yang ditambahkan.</p>
    <?php endif; ?>
  </div>

</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="hidden fixed inset-0 bg-black bg-opacity-95 z-50 flex items-center justify-center p-4 lightbox-overlay" onclick="closeLightbox()">
  
  <!-- Close Button -->
  <button onclick="closeLightbox()" class="close-button absolute top-6 right-6 text-white text-3xl w-12 h-12 rounded-full flex items-center justify-center z-20">
    <i class="fas fa-times"></i>
  </button>
  
  <!-- Navigation Buttons -->
  <button onclick="event.stopPropagation(); changeImage(-1)" class="nav-button absolute left-6 text-white text-4xl w-12 h-12 rounded-full flex items-center justify-center z-20">
    <i class="fas fa-chevron-left"></i>
  </button>
  <button onclick="event.stopPropagation(); changeImage(1)" class="nav-button absolute right-6 text-white text-4xl w-12 h-12 rounded-full flex items-center justify-center z-20">
    <i class="fas fa-chevron-right"></i>
  </button>
  
  <!-- Loading Spinner -->
  <div id="loading-spinner" class="spinner absolute"></div>
  
  <!-- Image Container -->
  <div class="max-w-6xl max-h-[90vh] w-full h-full flex items-center justify-center" onclick="event.stopPropagation()">
    <img id="lightbox-img" src="" alt="Property Image" class="lightbox-image max-w-full max-h-full object-contain rounded-xl shadow-2xl">
  </div>
  
  <!-- Counter Badge -->
  <div class="counter-badge absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white text-sm px-6 py-3 rounded-full">
    <span id="current-index">1</span> / <span id="total-images"><?= count($images) ?></span>
  </div>
</div>

<script>
// Image data from PHP
const images = <?= json_encode(array_map(function($img) {
    return '/LatuaGroup/uploads/properties/' . $img['image_path'];
}, $images)) ?>;

let currentIndex = 0;
let isAnimating = false;

function openLightbox(index) {
    currentIndex = index;
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    
    lightbox.classList.remove('hidden', 'closing');
    document.body.style.overflow = 'hidden';
    
    document.getElementById('loading-spinner').style.display = 'block';
    lightboxImg.style.opacity = '0';
    
    const img = new Image();
    img.onload = function() {
        lightboxImg.src = images[currentIndex];
        lightboxImg.className = 'lightbox-image max-w-full max-h-full object-contain rounded-xl shadow-2xl';
        document.getElementById('loading-spinner').style.display = 'none';
        lightboxImg.style.opacity = '1';
        updateCounter();
    };
    img.src = images[currentIndex];
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('closing');
    
    setTimeout(() => {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('closing');
        document.body.style.overflow = 'auto';
    }, 300);
}

function changeImage(direction) {
    if (isAnimating) return;
    isAnimating = true;
    
    const lightboxImg = document.getElementById('lightbox-img');
    
    currentIndex += direction;
    if (currentIndex < 0) currentIndex = images.length - 1;
    if (currentIndex >= images.length) currentIndex = 0;
    
    const animClass = direction > 0 ? 'slide-left' : 'slide-right';
    
    lightboxImg.style.opacity = '0';
    lightboxImg.style.transform = direction > 0 ? 'translateX(-50px)' : 'translateX(50px)';
    lightboxImg.style.transition = 'all 0.3s ease';
    
    setTimeout(() => {
        const img = new Image();
        img.onload = function() {
            lightboxImg.src = images[currentIndex];
            lightboxImg.className = `${animClass} max-w-full max-h-full object-contain rounded-xl shadow-2xl`;
            lightboxImg.style.opacity = '1';
            lightboxImg.style.transform = 'translateX(0)';
            updateCounter();
            
            setTimeout(() => {
                isAnimating = false;
            }, 400);
        };
        img.src = images[currentIndex];
    }, 300);
}

function updateCounter() {
    document.getElementById('current-index').textContent = currentIndex + 1;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox.classList.contains('hidden')) {
        if (e.key === 'ArrowLeft') changeImage(-1);
        if (e.key === 'ArrowRight') changeImage(1);
        if (e.key === 'Escape') closeLightbox();
    }
});

// Touch swipe support
let touchStartX = 0;
let touchEndX = 0;

document.getElementById('lightbox')?.addEventListener('touchstart', function(e) {
    touchStartX = e.changedTouches[0].screenX;
});

document.getElementById('lightbox')?.addEventListener('touchend', function(e) {
    touchEndX = e.changedTouches[0].screenX;
    if (touchEndX < touchStartX - 50) changeImage(1);
    if (touchEndX > touchStartX + 50) changeImage(-1);
});
</script>

<?php include '../includes/footer.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>
