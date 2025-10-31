<?php
  // ---------- Setup ----------
  $page_title = 'Hubungi Kami';

  // Gambar hero (pastikan file ada)
  $heroImage = '/LatuaGroup/uploads/contact-hero.jpg';

  include '../includes/header.php';
?>

<!-- ====== CDN (hapus jika header.php sudah memuatnya) ====== -->
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- ====== Animasi Slide Up ====== -->
<style>
  @keyframes slideUpFade {
    0% { transform: translateY(40px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
  }
  .animate-slide-up {
    animation: slideUpFade 1s ease-out forwards;
  }
  html { -webkit-text-size-adjust: 100%; }
  body { font-size: 16px; line-height: 1.6; }
</style>

<!-- ===== HERO ===== -->
<section class="relative">
  <div class="h-44 sm:h-56 md:h-72 lg:h-80 w-full bg-cover bg-center"
       style="background-image:url('<?= htmlspecialchars($heroImage, ENT_QUOTES) ?>');">
  </div>
  <div class="absolute inset-0 bg-black/25"></div>
  <div class="absolute inset-0 flex items-center justify-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
      <h1 class="text-white text-2xl sm:text-3xl md:text-4xl font-semibold leading-tight animate-slide-up">
        Hubungi Kami
      </h1>
    </div>
  </div>
</section>

<!-- ===== CONTENT ===== -->
<main class="bg-[#f3f1ec]">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      
      <!-- === Form kiri === -->
      <div class="lg:col-span-2 bg-white shadow-sm rounded-xl p-4 sm:p-6 md:p-8">
        <h2 class="text-2xl sm:text-3xl font-semibold tracking-wide leading-snug">
          ADA YANG BISA KAMI BANTU?
        </h2>
        <p class="mt-2 text-base sm:text-lg text-gray-700 leading-relaxed">
          Latuae Land siap membantu Anda mendapatkan hunian impian.
        </p>

        <form class="mt-5 sm:mt-6 space-y-4 sm:space-y-5" method="post" action="#">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
            <div>
              <label class="block text-base font-medium mb-2">Nama Depan <span class="text-red-500">*</span></label>
              <input type="text" name="first_name" required placeholder="Enter your name"
                     class="w-full border border-gray-300 rounded-lg px-3 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div>
              <label class="block text-base font-medium mb-2">Nama Belakang <span class="text-red-500">*</span></label>
              <input type="text" name="last_name" required placeholder="Enter your last name"
                     class="w-full border border-gray-300 rounded-lg px-3 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
          </div>

          <div>
            <label class="block text-base font-medium mb-2">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" required placeholder="Email"
                   class="w-full border border-gray-300 rounded-lg px-3 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-600">
          </div>

          <div>
            <label class="block text-base font-medium mb-2">Pesan <span class="text-red-500">*</span></label>
            <textarea name="message" rows="6" required placeholder="Message"
                      class="w-full border border-gray-300 rounded-lg px-3 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
          </div>

          <button type="submit"
                  class="w-full sm:w-auto px-6 sm:px-7 md:px-8 bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-lg transition">
            Kirim
          </button>
        </form>
      </div>

      <!-- === Sidebar kanan === -->
      <div class="space-y-4 sm:space-y-6">
        <div class="bg-white shadow-sm rounded-xl p-4 sm:p-6">
          <h3 class="text-lg font-semibold text-gray-700">Info Lebih Lanjut :</h3>
          <p class="mt-3 text-gray-700 text-base">Admin Latuae Land</p>
          <p class="mt-2 font-semibold text-blue-700 text-base">
            <a href="tel:08111440205">08111440205</a>
          </p>
          <p class="mt-2 text-base">
            <a class="text-gray-700 hover:text-blue-900" href="mailto:latuealand@gmail.com">latuealand@gmail.com</a>
          </p>
        </div>

        <div class="bg-white shadow-sm rounded-xl p-4 sm:p-6">
          <h3 class="text-lg font-semibold text-gray-700">Latuae Land Marketing Office</h3>
          <p class="mt-3 text-gray-700 text-base leading-relaxed">
            Summarecon Bekasi, Jl. Bulevar Selatan Blok UG 08<br>
            RT 004/011, Marga Mulya, Kec. Bekasi Utara<br>
            Jawa Barat 17142
          </p>
        </div>

        <div class="bg-white shadow-sm rounded-xl p-4 sm:p-6">
          <div class="flex flex-wrap items-center gap-3 sm:gap-4">
            <a href="#" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#3b5998] flex items-center justify-center text-white" aria-label="Facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#1da1f2] flex items-center justify-center text-white" aria-label="Twitter">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#0a66c2] flex items-center justify-center text-white" aria-label="LinkedIn">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#ff0000] flex items-center justify-center text-white" aria-label="YouTube">
              <i class="fab fa-youtube"></i>
            </a>
            <a href="#" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-black flex items-center justify-center text-white" aria-label="TikTok">
              <i class="fab fa-tiktok"></i>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>

<!-- ===== MAPS: Lokasi Summarecon Bekasi ===== -->
<section class="bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
    <h2 class="text-2xl sm:text-3xl font-semibold mb-3 sm:mb-4">Lokasi Kami</h2>
    <div class="w-full h-64 sm:h-80 md:h-96 rounded-xl overflow-hidden shadow">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.364096289107!2d106.9875065756768!3d-6.224377993767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d1f5f5f5f5f%3A0x5f5f5f5f5f5f5f5f!2sSummarecon%20Bekasi!5e0!3m2!1sid!2sid!4v1735667890123!5m2!1sid!2sid"
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
    <p class="mt-3 sm:mt-4 text-gray-700 text-base">
      <strong>Alamat:</strong> Summarecon Bekasi, Jl. Bulevar Selatan Blok UG 08, RT 004/011, Marga Mulya, Kec. Bekasi Utara, Jawa Barat 17142 – 
      <a href="https://maps.google.com?q=Summarecon+Bekasi,+Jl.+Bulevar+Selatan+Blok+UG+08,+Bekasi" 
         target="_blank" class="text-blue-700 hover:underline">Get Directions</a>
    </p>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">