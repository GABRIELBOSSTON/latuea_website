<?php
  // --------- Page meta ---------
  $page_title = 'Tentang Kami - Latuae Land';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?= htmlspecialchars($page_title, ENT_QUOTES) ?></title>

  <!-- Tailwind CDN (pastikan tidak double di layout lain) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome (ikon) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Google Font (Inter) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    html { -webkit-text-size-adjust: 100%; }
    body { font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji'; }

    /* Animasi reveal halus */
    @keyframes revealUp {
      from { opacity: 0; transform: translateY(18px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .reveal-up { opacity: 0; animation: revealUp .8s ease-out .15s forwards; }
    .reveal-up-2 { opacity: 0; animation: revealUp .8s ease-out .30s forwards; }
    .reveal-up-3 { opacity: 0; animation: revealUp .8s ease-out .45s forwards; }

    /* Custom gradient untuk visi misi */
    .gradient-visi {
      background: linear-gradient(135deg, #334894 0%, #1e3a8a 100%);
    }
    .gradient-misi {
      background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    }
  </style>
</head>
<body class="bg-white text-gray-800">

  <?php require __DIR__ . '/../includes/header.php'; ?>

  <!-- ============================= -->
  <!-- HERO VIDEO: Tentang Kami     -->
  <!-- ============================= -->
  <section class="relative w-full min-h-[60vh] md:min-h-[72vh] flex items-center">
    <!-- VIDEO background -->
    <video
      class="absolute inset-0 w-full h-full object-cover"
      autoplay
      muted
      loop
      playsinline
      poster="/LatuaGroup/uploads/about-hero.jpg"
    >
      <source src="/LatuaGroup/uploads/about-hero.jpg" type="video/mp4" />
      <!-- Fallback jika browser tidak support video -->
      Browser Anda tidak mendukung video HTML5.
    </video>

    <!-- Overlay gradient untuk keterbacaan teks -->
    <div class="absolute inset-0 bg-black/40 md:bg-black/35"></div>
    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-black/35 to-transparent"></div>

    <!-- Breadcrumb kecil -->
    <div class="absolute top-3 sm:top-4 left-0 right-0">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 text-xs sm:text-sm text-white/80">
        <a href="/LatuaGroup/pages/index.php" class="hover:text-white transition">Beranda</a>
        <span class="mx-2">/</span>
        <span class="text-white">Tentang Kami</span>
      </div>
    </div>

    <!-- Judul -->
    <div class="relative z-10 w-full">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h1 class="reveal-up text-white text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight">
          Tentang Kami
        </h1>
        <p class="reveal-up-2 mt-3 max-w-2xl text-white/90 text-base sm:text-lg">
          Konsultan properti terpercaya yang membantu mewujudkan nilai dan peluang masa depan Anda.
        </p>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- INTRO / COMPANY SNAPSHOT     -->
  <!-- ============================= -->
  <section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12 lg:py-16">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Narasi -->
        <div class="lg:col-span-2">
          <h2 class="reveal-up text-2xl sm:text-3xl font-bold text-gray-900">
            Selamat Datang di Latuealand
          </h2>
          <p class="reveal-up-2 mt-3 text-base sm:text-lg leading-relaxed text-gray-700">
            Temukan properti impian Anda dengan mudah bersama Latuealand, konsultan properti terpercaya yang siap membantu Anda dalam setiap langkah perjalanan investasi dan kepemilikan properti.
          </p>
          <p class="reveal-up-3 mt-3 text-base sm:text-lg leading-relaxed text-gray-700">
            Kami menyediakan layanan lengkap mulai dari pencarian properti, penjualan, pembelian, pemasaran, hingga konsultasi investasi. Dengan dukungan tim berpengalaman dan jaringan luas, kami memastikan Anda mendapatkan solusi terbaik yang sesuai dengan kebutuhan dan tujuan Anda.
          </p>
          <p class="reveal-up-3 mt-3 text-base sm:text-lg leading-relaxed text-gray-900 font-semibold">
            Di Latuealand, kami tidak hanya membantu Anda menemukan properti — kami membantu Anda menemukan nilai dan peluang masa depan.
          </p>
        </div>

        <!-- Stats ringkas -->
        <div class="reveal-up lg:pl-6">
          <div class="grid grid-cols-2 gap-4 sm:gap-6 bg-gray-50 rounded-xl p-5 sm:p-6">
            <div>
              <div class="text-2xl sm:text-3xl font-extrabold text-[#334894]">500+</div>
              <div class="mt-1 text-gray-600 text-sm sm:text-base">Unit Terpasarkan</div>
            </div>
            <div>
              <div class="text-2xl sm:text-3xl font-extrabold text-[#334894]">50+</div>
              <div class="mt-1 text-gray-600 text-sm sm:text-base">Proyek Aktif</div>
            </div>
            <div>
              <div class="text-2xl sm:text-3xl font-extrabold text-[#334894]">20+</div>
              <div class="mt-1 text-gray-600 text-sm sm:text-base">Mitra Perbankan</div>
            </div>
            <div>
              <div class="text-2xl sm:text-3xl font-extrabold text-[#334894]">100%</div>
              <div class="mt-1 text-gray-600 text-sm sm:text-base">Pendampingan Legal</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- KENAPA MEMILIH KAMI - ENHANCED -->
  <!-- ============================= -->
  <section class="bg-gradient-to-br from-blue-50 via-indigo-50 to-white relative overflow-hidden">
    <!-- Decorative elements for desktop -->
    <div class="hidden lg:block absolute top-0 right-0 w-96 h-96 bg-[#334894]/5 rounded-full blur-3xl"></div>
    <div class="hidden lg:block absolute bottom-0 left-0 w-96 h-96 bg-indigo-500/5 rounded-full blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 lg:py-20 relative z-10">
      <div class="text-center max-w-4xl mx-auto">
        <div class="reveal-up inline-block">
          <span class="inline-flex items-center gap-2 px-4 py-2 bg-[#334894]/10 text-[#334894] rounded-full text-sm font-semibold mb-4">
            <i class="fa-solid fa-star"></i>
            Keunggulan Kami
          </span>
        </div>
        <h3 class="reveal-up text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mt-3">
          Kenapa Memilih Latuealand?
        </h3>
        <div class="reveal-up-2 mt-6 space-y-4">
          <p class="text-lg sm:text-xl lg:text-2xl leading-relaxed text-gray-800 font-medium">
            Karena kami melihat properti bukan sekadar bangunan, tapi 
            <span class="text-[#334894] font-bold">visi masa depan Anda</span>.
          </p>
          <p class="text-base sm:text-lg lg:text-xl leading-relaxed text-gray-700 max-w-3xl mx-auto">
            Dengan keahlian, jaringan luas, dan strategi tepat, Latuealand membantu mewujudkan nilai dan peluang terbaik bagi setiap klien.
          </p>
        </div>

        <!-- Feature highlights untuk desktop -->
        <div class="reveal-up-3 hidden lg:grid grid-cols-3 gap-6 mt-12 max-w-4xl mx-auto">
          <div class="bg-white/60 backdrop-blur-sm rounded-xl p-6 border border-gray-200/50 shadow-sm hover:shadow-md transition-all">
            <div class="w-14 h-14 mx-auto rounded-full bg-[#334894]/10 text-[#334894] flex items-center justify-center text-2xl mb-4">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <h4 class="font-bold text-gray-900 text-lg">Keahlian</h4>
            <p class="text-gray-600 text-sm mt-2">Tim profesional berpengalaman</p>
          </div>
          <div class="bg-white/60 backdrop-blur-sm rounded-xl p-6 border border-gray-200/50 shadow-sm hover:shadow-md transition-all">
            <div class="w-14 h-14 mx-auto rounded-full bg-[#334894]/10 text-[#334894] flex items-center justify-center text-2xl mb-4">
              <i class="fa-solid fa-network-wired"></i>
            </div>
            <h4 class="font-bold text-gray-900 text-lg">Jaringan Luas</h4>
            <p class="text-gray-600 text-sm mt-2">Koneksi ke seluruh ekosistem</p>
          </div>
          <div class="bg-white/60 backdrop-blur-sm rounded-xl p-6 border border-gray-200/50 shadow-sm hover:shadow-md transition-all">
            <div class="w-14 h-14 mx-auto rounded-full bg-[#334894]/10 text-[#334894] flex items-center justify-center text-2xl mb-4">
              <i class="fa-solid fa-chess-knight"></i>
            </div>
            <h4 class="font-bold text-gray-900 text-lg">Strategi Tepat</h4>
            <p class="text-gray-600 text-sm mt-2">Solusi berbasis data & riset</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- VISI & MISI - ENHANCED       -->
  <!-- ============================= -->
  <section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 lg:py-20">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">
        <!-- Visi -->
        <div class="reveal-up gradient-visi rounded-2xl shadow-2xl p-8 sm:p-10 lg:p-12 text-white relative overflow-hidden group hover:shadow-3xl transition-all duration-300">
          <!-- Decorative gradient overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-white/0 via-white/0 to-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          
          <div class="relative z-10">
            <div class="w-16 h-16 lg:w-20 lg:h-20 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
              <i class="fa-solid fa-eye text-3xl lg:text-4xl"></i>
            </div>
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold">Visi</h3>
            <div class="mt-2 w-20 h-1.5 bg-white/50 rounded-full"></div>
            <p class="mt-6 text-white/95 leading-relaxed text-base lg:text-lg">
              Menjadi konsultan properti terpercaya dan inovatif yang memberikan solusi terbaik dalam setiap langkah investasi, pengelolaan, dan pengembangan properti — serta menjadi mitra strategis dalam mewujudkan nilai dan peluang masa depan bagi setiap klien.
            </p>
          </div>

          <!-- Decorative circle -->
          <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
        </div>

        <!-- Misi -->
        <div class="reveal-up gradient-misi rounded-2xl shadow-2xl p-8 sm:p-10 lg:p-12 text-white relative overflow-hidden group hover:shadow-3xl transition-all duration-300">
          <!-- Decorative gradient overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-white/0 via-white/0 to-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          
          <div class="relative z-10">
            <div class="w-16 h-16 lg:w-20 lg:h-20 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
              <i class="fa-solid fa-bullseye text-3xl lg:text-4xl"></i>
            </div>
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold">Misi</h3>
            <div class="mt-2 w-20 h-1.5 bg-white/50 rounded-full"></div>
            <p class="mt-6 text-white/95 leading-relaxed text-base lg:text-lg">
              Misi kami adalah memberikan layanan konsultasi properti yang profesional, transparan, dan berorientasi pada hasil. Dengan mengutamakan kepercayaan, inovasi, dan strategi yang tepat, Latuealand membantu setiap klien menemukan nilai dan peluang terbaik dalam setiap keputusan properti.
            </p>
          </div>

          <!-- Decorative circle -->
          <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- KEUNGGULAN / WHY US          -->
  <!-- ============================= -->
  <section class="bg-[#f7f7f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12">
      <h3 class="reveal-up text-2xl sm:text-3xl font-bold text-gray-900 text-center">
        Keunggulan Kami
      </h3>
      <p class="reveal-up-2 mt-3 text-center text-gray-700 max-w-3xl mx-auto">
        Kombinasi pengalaman, jejaring pasar, dan proses yang profesional membuat perjalanan properti Anda lebih mudah dan pasti.
      </p>

      <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="reveal-up bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 rounded-lg bg-[#334894]/10 text-[#334894] flex items-center justify-center text-xl">
            <i class="fa-solid fa-handshake"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900 text-lg">Pelayanan Profesional</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Tim berpengalaman dengan etika kerja dan standard layanan yang konsisten untuk kepuasan klien.
          </p>
        </div>

        <div class="reveal-up bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 rounded-lg bg-[#334894]/10 text-[#334894] flex items-center justify-center text-xl">
            <i class="fa-solid fa-network-wired"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900 text-lg">Jaringan Luas</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Akses ke penjual, pembeli, pengembang, dan perbankan untuk mempercepat proses transaksi Anda.
          </p>
        </div>

        <div class="reveal-up bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 rounded-lg bg-[#334894]/10 text-[#334894] flex items-center justify-center text-xl">
            <i class="fa-solid fa-shield-halved"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900 text-lg">Transparan & Aman</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Proses terdokumentasi dengan baik, verifikasi berlapis, dan pendampingan legal menyeluruh.
          </p>
        </div>

        <div class="reveal-up bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 rounded-lg bg-[#334894]/10 text-[#334894] flex items-center justify-center text-xl">
            <i class="fa-solid fa-chart-line"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900 text-lg">Strategi Pemasaran</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Riset pasar mendalam dan pemasaran digital berbasis data untuk hasil maksimal.
          </p>
        </div>

        <div class="reveal-up bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 rounded-lg bg-[#334894]/10 text-[#334894] flex items-center justify-center text-xl">
            <i class="fa-solid fa-people-group"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900 text-lg">Konsultasi Personal</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Solusi yang disesuaikan dengan kebutuhan Anda, dari pemula hingga investor berpengalaman.
          </p>
        </div>

        <div class="reveal-up bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
          <div class="w-12 h-12 rounded-lg bg-[#334894]/10 text-[#334894] flex items-center justify-center text-xl">
            <i class="fa-solid fa-file-signature"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900 text-lg">Pendampingan Legal</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Notaris/PPAT rekanan terpercaya, pengurusan dokumen lengkap, hingga balik nama.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- TIMELINE SINGKAT - ENHANCED  -->
  <!-- ============================= -->
  <section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 lg:py-20">
      <h3 class="reveal-up text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 text-center">Perjalanan Kami</h3>
      <p class="reveal-up-2 mt-3 text-center text-gray-600 max-w-2xl mx-auto">
        Dari fondasi kuat hingga digitalisasi, inilah tonggak perjalanan Latuealand.
      </p>

      <div class="mt-10 lg:mt-16 relative max-w-5xl mx-auto">
        <!-- Desktop: Horizontal timeline -->
        <div class="hidden lg:block">
          <div class="relative">
            <!-- Horizontal line -->
            <div class="absolute top-10 left-0 right-0 h-1 bg-gradient-to-r from-[#334894] via-[#334894] to-[#334894]"></div>
            
            <div class="grid grid-cols-4 gap-8 relative">
              <!-- Item 1 -->
              <div class="reveal-up text-center">
                <div class="relative z-10 mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-[#334894] to-[#1e3a8a] text-white grid place-items-center font-bold text-2xl shadow-lg ring-4 ring-white">
                  1
                </div>
                <div class="mt-6 bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                  <h4 class="font-bold text-gray-900 text-lg">Mulai Beroperasi</h4>
                  <p class="text-gray-600 text-sm mt-3 leading-relaxed">Membangun tim inti dan fondasi layanan properti yang solid.</p>
                </div>
              </div>

              <!-- Item 2 -->
              <div class="reveal-up text-center">
                <div class="relative z-10 mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-[#334894] to-[#1e3a8a] text-white grid place-items-center font-bold text-2xl shadow-lg ring-4 ring-white">
                  2
                </div>
                <div class="mt-6 bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                  <h4 class="font-bold text-gray-900 text-lg">Ekspansi Portofolio</h4>
                  <p class="text-gray-600 text-sm mt-3 leading-relaxed">Menambah listing apartemen, rumah, ruko, dan tanah di area strategis.</p>
                </div>
              </div>

              <!-- Item 3 -->
              <div class="reveal-up text-center">
                <div class="relative z-10 mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-[#334894] to-[#1e3a8a] text-white grid place-items-center font-bold text-2xl shadow-lg ring-4 ring-white">
                  3
                </div>
                <div class="mt-6 bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                  <h4 class="font-bold text-gray-900 text-lg">Kemitraan Perbankan</h4>
                  <p class="text-gray-600 text-sm mt-3 leading-relaxed">Berkolaborasi dengan bank & lembaga pembiayaan untuk solusi KPR/KPA.</p>
                </div>
              </div>

              <!-- Item 4 -->
              <div class="reveal-up text-center">
                <div class="relative z-10 mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-[#334894] to-[#1e3a8a] text-white grid place-items-center font-bold text-2xl shadow-lg ring-4 ring-white">
                  4
                </div>
                <div class="mt-6 bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                  <h4 class="font-bold text-gray-900 text-lg">Digitalisasi Pemasaran</h4>
                  <p class="text-gray-600 text-sm mt-3 leading-relaxed">Mengoptimalkan pemasaran digital agar exposure listing makin tinggi.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile: Vertical timeline (existing) -->
        <div class="lg:hidden">
          <!-- garis vertikal -->
          <div class="absolute left-4 top-0 bottom-0 w-px bg-[#334894]"></div>

          <ol class="space-y-8">
            <li class="reveal-up flex gap-4">
              <div class="mt-1 shrink-0 w-8 h-8 rounded-full bg-[#334894] text-white grid place-items-center font-semibold text-sm">1</div>
              <div>
                <h4 class="font-semibold text-gray-900">Mulai Beroperasi</h4>
                <p class="text-gray-700 text-sm mt-1">Membangun tim inti dan fondasi layanan properti yang solid.</p>
              </div>
            </li>
            <li class="reveal-up flex gap-4">
              <div class="mt-1 shrink-0 w-8 h-8 rounded-full bg-[#334894] text-white grid place-items-center font-semibold text-sm">2</div>
              <div>
                <h4 class="font-semibold text-gray-900">Ekspansi Portofolio</h4>
                <p class="text-gray-700 text-sm mt-1">Menambah listing apartemen, rumah, ruko, dan tanah di area strategis.</p>
              </div>
            </li>
            <li class="reveal-up flex gap-4">
              <div class="mt-1 shrink-0 w-8 h-8 rounded-full bg-[#334894] text-white grid place-items-center font-semibold text-sm">3</div>
              <div>
                <h4 class="font-semibold text-gray-900">Kemitraan Perbankan</h4>
                <p class="text-gray-700 text-sm mt-1">Berkolaborasi dengan bank & lembaga pembiayaan untuk solusi KPR/KPA.</p>
              </div>
            </li>
            <li class="reveal-up flex gap-4">
              <div class="mt-1 shrink-0 w-8 h-8 rounded-full bg-[#334894] text-white grid place-items-center font-semibold text-sm">4</div>
              <div>
                <h4 class="font-semibold text-gray-900">Digitalisasi Pemasaran</h4>
                <p class="text-gray-700 text-sm mt-1">Mengoptimalkan pemasaran digital agar exposure listing makin tinggi.</p>
              </div>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- CTA HUBUNGI / FOOTER LEAD    -->
  <!-- ============================= -->
  <section class="bg-[#f7f7f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12">
      <div class="reveal-up bg-gradient-to-r from-[#334894] to-[#1e3a8a] rounded-2xl p-6 sm:p-8 lg:p-10 text-white flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-xl hover:shadow-2xl transition-shadow">
        <div>
          <h4 class="text-xl sm:text-2xl lg:text-3xl font-bold">Siap mendiskusikan kebutuhan properti Anda?</h4>
          <p class="mt-2 text-white/90 text-base lg:text-lg">Tim kami akan membantu dari awal hingga selesai.</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
          <a href="/LatuaGroup/pages/contact.php" class="inline-flex items-center gap-2 bg-white text-[#334894] font-semibold px-5 py-3 rounded-lg hover:bg-gray-50 transition shadow-md hover:shadow-lg">
            <i class="fa-solid fa-phone"></i> Hubungi Kami
          </a>
          <a href="mailto:Marketing@akrland.com" class="inline-flex items-center gap-2 border-2 border-white/70 text-white font-semibold px-5 py-3 rounded-lg hover:bg-white/10 transition">
            <i class="fa-solid fa-envelope"></i> Email
          </a>
        </div>
      </div>
    </div>
  </section>

  <?php require __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>