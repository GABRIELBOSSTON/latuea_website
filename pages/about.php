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
          Latuae Land — solusi properti cerdas, aman, dan menguntungkan.
        </p>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- INTRO / COMPANY SNAPSHOT     -->
  <!-- ============================= -->
  <section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Narasi -->
        <div class="lg:col-span-2">
          <h2 class="reveal-up text-2xl sm:text-3xl font-bold text-gray-900">
            Selamat Datang di Latuae Land
          </h2>
          <p class="reveal-up-2 mt-3 text-base sm:text-lg leading-relaxed text-gray-700">
            Kami memahami bahwa setiap properti bukan sekadar bangunan—melainkan
            <span class="font-semibold">impian, tujuan, dan investasi masa depan</span>.
            Dengan pengalaman dan jejaring yang kuat, kami hadir untuk membantu proses
            <span class="font-semibold">jual, beli, maupun sewa</span> secara lebih mudah, transparan, dan menguntungkan.
          </p>
          <p class="reveal-up-3 mt-3 text-base sm:text-lg leading-relaxed text-gray-700">
            Layanan kami meliputi riset pasar, pemasaran digital, negosiasi, hingga pendampingan legal,
            sehingga Anda bisa fokus pada keputusan terbaik—sementara kami pastikan semua proses berjalan rapi dan aman.
          </p>
        </div>

        <!-- Stats ringkas -->
        <div class="reveal-up lg:pl-6">
          <div class="grid grid-cols-2 gap-4 sm:gap-6 bg-gray-50 rounded-xl p-5 sm:p-6">
            <div>
              <div class="text-2xl sm:text-3xl font-extrabold text-blue-700">500+</div>
              <div class="mt-1 text-gray-600 text-sm sm:text-base">Unit Terpasarkan</div>
            </div>
            <div>
              <div class="text-2xl sm:text-3xl font-extrabold text-blue-700">50+</div>
              <div class="mt-1 text-gray-600 text-sm sm:text-base">Proyek Aktif</div>
            </div>
            <div>
              <div class="text-2xl sm:text-3xl font-extrabold text-blue-700">20+</div>
              <div class="mt-1 text-gray-600 text-sm sm:text-base">Mitra Perbankan</div>
            </div>
            <div>
              <div class="text-2xl sm:text-3xl font-extrabold text-blue-700">100%</div>
              <div class="mt-1 text-gray-600 text-sm sm:text-base">Pendampingan Legal</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- MISI & VISI                   -->
  <!-- ============================= -->
  <section class="bg-[#f7f7f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="reveal-up bg-white rounded-xl shadow-sm p-6">
          <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Misi</h3>
          <p class="mt-3 text-gray-700 leading-relaxed">
            Memberikan solusi properti terbaik dengan integritas tinggi, transparansi, dan pelayanan prima
            untuk mewujudkan impian setiap klien.
          </p>
        </div>
        <div class="reveal-up bg-white rounded-xl shadow-sm p-6">
          <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Visi</h3>
          <p class="mt-3 text-gray-700 leading-relaxed">
            Menjadi perusahaan properti terdepan dan mitra terpercaya dalam menciptakan nilai tambah yang berkelanjutan.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- KEUNGGULAN / WHY US          -->
  <!-- ============================= -->
  <section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12">
      <h3 class="reveal-up text-2xl sm:text-3xl font-bold text-gray-900 text-center">
        Mengapa Memilih Kami
      </h3>
      <p class="reveal-up-2 mt-3 text-center text-gray-700 max-w-3xl mx-auto">
        Kombinasi pengalaman, jejaring pasar, dan proses yang rapi membuat perjalanan properti Anda terasa lebih mudah dan pasti.
      </p>

      <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="reveal-up bg-gray-50 rounded-xl p-6">
          <div class="w-11 h-11 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
            <i class="fa-solid fa-handshake"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900">Pelayanan Profesional</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Tim berpengalaman dengan etika kerja dan standard layanan yang konsisten.
          </p>
        </div>

        <div class="reveal-up bg-gray-50 rounded-xl p-6">
          <div class="w-11 h-11 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
            <i class="fa-solid fa-network-wired"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900">Jaringan Luas</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Akses ke penjual, pembeli, pengembang, dan perbankan untuk mempercepat transaksi.
          </p>
        </div>

        <div class="reveal-up bg-gray-50 rounded-xl p-6">
          <div class="w-11 h-11 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
            <i class="fa-solid fa-shield-halved"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900">Transparan & Aman</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Proses terdokumentasi, verifikasi berlapis, dan pendampingan legal menyeluruh.
          </p>
        </div>

        <div class="reveal-up bg-gray-50 rounded-xl p-6">
          <div class="w-11 h-11 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
            <i class="fa-solid fa-chart-line"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900">Riset & Pemasaran</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Strategi harga & pemasaran digital berbasis data agar listing cepat terserap.
          </p>
        </div>

        <div class="reveal-up bg-gray-50 rounded-xl p-6">
          <div class="w-11 h-11 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
            <i class="fa-solid fa-people-group"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900">Konsultasi Personal</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Solusi yang disesuaikan kebutuhan, dari pemula hingga investor berpengalaman.
          </p>
        </div>

        <div class="reveal-up bg-gray-50 rounded-xl p-6">
          <div class="w-11 h-11 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
            <i class="fa-solid fa-file-signature"></i>
          </div>
          <h4 class="mt-4 font-semibold text-gray-900">Pendampingan Legal</h4>
          <p class="mt-2 text-gray-700 text-sm leading-relaxed">
            Notaris/PPAT rekanan tepercaya, pengurusan dokumen, hingga balik nama.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- TIMELINE SINGKAT              -->
  <!-- ============================= -->
  <section class="bg-[#f7f7f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12">
      <h3 class="reveal-up text-2xl sm:text-3xl font-bold text-gray-900 text-center">Perjalanan Kami</h3>

      <div class="mt-8 relative max-w-3xl mx-auto">
        <!-- garis vertikal -->
        <div class="absolute left-4 sm:left-1/2 sm:-translate-x-1/2 top-0 bottom-0 w-px bg-gray-300"></div>

        <ol class="space-y-8">
          <li class="reveal-up flex gap-4 sm:gap-8">
            <div class="mt-1 shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white grid place-items-center">1</div>
            <div>
              <h4 class="font-semibold text-gray-900">Mulai Beroperasi</h4>
              <p class="text-gray-700 text-sm mt-1">Membangun tim inti dan fondasi layanan properti yang solid.</p>
            </div>
          </li>
          <li class="reveal-up flex gap-4 sm:gap-8">
            <div class="mt-1 shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white grid place-items-center">2</div>
            <div>
              <h4 class="font-semibold text-gray-900">Ekspansi Portofolio</h4>
              <p class="text-gray-700 text-sm mt-1">Menambah listing apartemen, rumah, ruko, dan tanah di area strategis.</p>
            </div>
          </li>
          <li class="reveal-up flex gap-4 sm:gap-8">
            <div class="mt-1 shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white grid place-items-center">3</div>
            <div>
              <h4 class="font-semibold text-gray-900">Kemitraan Perbankan</h4>
              <p class="text-gray-700 text-sm mt-1">Berkolaborasi dengan bank & lembaga pembiayaan untuk solusi KPR/KPA.</p>
            </div>
          </li>
          <li class="reveal-up flex gap-4 sm:gap-8">
            <div class="mt-1 shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white grid place-items-center">4</div>
            <div>
              <h4 class="font-semibold text-gray-900">Digitalisasi Pemasaran</h4>
              <p class="text-gray-700 text-sm mt-1">Mengoptimalkan pemasaran digital agar exposure listing makin tinggi.</p>
            </div>
          </li>
        </ol>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- CTA HUBUNGI / FOOTER LEAD    -->
  <!-- ============================= -->
  <section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12">
      <div class="reveal-up bg-blue-700 rounded-2xl p-6 sm:p-8 text-white flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
          <h4 class="text-xl sm:text-2xl font-bold">Siap mendiskusikan kebutuhan properti Anda?</h4>
          <p class="mt-1 text-white/90">Tim kami akan membantu dari awal hingga selesai.</p>
        </div>
        <div class="flex items-center gap-3">
          <a href="/LatuaGroup/pages/contact.php" class="inline-flex items-center gap-2 bg-white text-blue-800 font-semibold px-5 py-3 rounded-lg hover:bg-blue-50 transition">
            <i class="fa-solid fa-phone"></i> Hubungi Kami
          </a>
          <a href="mailto:Marketing@akrland.com" class="inline-flex items-center gap-2 border border-white/70 text-white font-semibold px-5 py-3 rounded-lg hover:bg-white/10 transition">
            <i class="fa-solid fa-envelope"></i> Email
          </a>
        </div>
      </div>
    </div>
  </section>

  <?php require __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
