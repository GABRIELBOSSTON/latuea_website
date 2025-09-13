<?php
// Set default page title
$page_title = isset($page_title) ? $page_title : 'Latuae Land';
?>

<nav id="mainNav" class="fixed top-0 left-0 w-full z-50 bg-white shadow-md">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-6 py-3 sm:py-4 flex items-center justify-between">
    
    <!-- Logo -->
    <a href="/LatuaGroup/pages/index.php" class="flex items-center space-x-2" aria-label="Beranda Latuae Land">
      <img src="/LatuaGroup/uploads/latualogo.png" alt="Latuae Land" class="h-8 sm:h-9 w-auto">
    </a>

    <!-- Desktop Nav -->
    <div class="hidden md:flex items-center gap-6 lg:gap-8">
      <!-- Properti dropdown (hover) -->
      <div class="relative group" id="propertiDropdown">
        <button type="button" class="inline-flex items-center gap-2 text-gray-700 hover:text-blue-900 font-medium focus:outline-none">
          Properti
          <i class="fa-solid fa-chevron-down text-[10px]"></i>
        </button>
        <div
          class="pointer-events-none group-hover:pointer-events-auto invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 absolute left-0 mt-3 w-56 rounded-lg border border-gray-100 bg-white shadow-lg transition-all duration-150"
          data-menu="properti"
        >
          <ul class="py-2 text-sm text-gray-700">
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-50">Rumah</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-50">Apartemen</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-50">Ruko</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-50">Tanah</a></li>
          </ul>
        </div>
      </div>

      <a href="office.php" class="text-gray-700 hover:text-blue-900 font-medium">Layanan</a>
      <a href="#" class="text-gray-700 hover:text-blue-900 font-medium">Proyek</a>
      <a href="/LatuaGroup/pages/about.php" class="text-gray-700 hover:text-blue-900 font-medium">Tentang Kami</a>
    </div>

    <!-- Right (desktop) -->
    <div class="hidden md:flex items-center gap-3 lg:gap-4">
      <!-- Language dropdown (hover) -->
      <div class="relative group" id="langDropdown">
        <button type="button"
          class="inline-flex items-center gap-2 border border-gray-300 rounded-md px-3 py-2 text-[15px] text-gray-700 hover:border-blue-400 hover:text-blue-900 bg-white focus:outline-none">
          <i class="fa-solid fa-globe"></i>
          <span id="langLabel">IND</span>
          <i class="fa-solid fa-chevron-down text-[10px]"></i>
        </button>
        <div
          class="pointer-events-none group-hover:pointer-events-auto invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 absolute right-0 mt-2 w-36 rounded-lg border border-gray-100 bg-white shadow-lg transition-all duration-150"
          data-menu="lang"
        >
          <ul class="py-2 text-sm text-gray-700">
            <li><button type="button" data-lang="IND" class="w-full text-left px-4 py-2 hover:bg-gray-50">IND</button></li>
            <li><button type="button" data-lang="ENG" class="w-full text-left px-4 py-2 hover:bg-gray-50">ENG</button></li>
          </ul>
        </div>
      </div>

      <!-- Contact -->
      <a href="/LatuaGroup/pages/contact.php"
         class="inline-flex items-center gap-2 bg-blue-900 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
        <i class="fa-solid fa-phone"></i>
        Hubungi Kami
      </a>

      <!-- Search -->
      <div class="relative">
        <input type="text" placeholder="Cari properti..."
               class="h-10 pl-3 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
          <i class="fas fa-search"></i>
        </span>
      </div>
    </div>

    <!-- Mobile Hamburger -->
    <button id="hamburgerBtn" class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-md text-gray-700 hover:text-blue-900 focus:outline-none" aria-label="Open Menu" aria-expanded="false">
      <i class="fa-solid fa-bars text-xl"></i>
    </button>
  </div>

  <!-- Mobile Drawer -->
  <div id="mobileMenu" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40" id="mobileBackdrop"></div>
    <div class="absolute top-0 right-0 h-full w-80 max-w-[85%] bg-white shadow-xl p-5 overflow-y-auto">
      <div class="flex items-center justify-between mb-4">
        <span class="text-lg font-semibold">Menu</span>
        <button id="mobileClose" class="w-10 h-10 flex items-center justify-center rounded-md text-gray-600 hover:text-gray-900 focus:outline-none">
          <i class="fa-solid fa-xmark text-xl"></i>
        </button>
      </div>

      <nav class="space-y-2 text-[17px]">
        <!-- Properti expandable -->
        <div>
          <button class="w-full flex items-center justify-between py-3 px-2 rounded-md hover:bg-gray-50 font-medium text-gray-800" data-accordion="prop">
            <span class="flex items-center gap-2"><i class="fa-regular fa-building"></i> Properti</span>
            <i class="fa-solid fa-chevron-down text-sm" data-chevron="prop"></i>
          </button>
          <div class="max-h-0 overflow-hidden transition-all" data-panel="prop">
            <ul class="pl-4 py-1 text-[16px] text-gray-700">
              <li><a href="#" class="block px-2 py-2 rounded hover:bg-gray-50">Rumah</a></li>
              <li><a href="#" class="block px-2 py-2 rounded hover:bg-gray-50">Apartemen</a></li>
              <li><a href="#" class="block px-2 py-2 rounded hover:bg-gray-50">Ruko</a></li>
              <li><a href="#" class="block px-2 py-2 rounded hover:bg-gray-50">Tanah</a></li>
            </ul>
          </div>
        </div>

        <a href="#" class="block py-3 px-2 rounded-md hover:bg-gray-50 font-medium text-gray-800">Layanan</a>
        <a href="#" class="block py-3 px-2 rounded-md hover:bg-gray-50 font-medium text-gray-800">Proyek</a>
        <a href="/LatuaGroup/pages/about.php" class="block py-3 px-2 rounded-md hover:bg-gray-50 font-medium text-gray-800">Tentang Kami</a>

        <!-- Bahasa expandable -->
        <div class="mt-2">
          <button class="w-full flex items-center justify-between py-3 px-2 rounded-md hover:bg-gray-50 font-medium text-gray-800" data-accordion="lang">
            <span class="flex items-center gap-2"><i class="fa-solid fa-globe"></i> Bahasa: <span id="langLabelMob" class="font-semibold">IND</span></span>
            <i class="fa-solid fa-chevron-down text-sm" data-chevron="lang"></i>
          </button>
          <div class="max-h-0 overflow-hidden transition-all" data-panel="lang">
            <div class="pl-2 py-1">
              <button type="button" data-lang="IND" class="block w-full text-left px-2 py-2 rounded hover:bg-gray-50">IND</button>
              <button type="button" data-lang="ENG" class="block w-full text-left px-2 py-2 rounded hover:bg-gray-50">ENG</button>
            </div>
          </div>
        </div>

        <!-- Contact + Search -->
        <div class="pt-4 space-y-3">
          <a href="/LatuaGroup/pages/contact.php" class="w-full inline-flex items-center justify-center gap-2 bg-blue-900 text-white px-4 py-3 rounded-lg font-semibold hover:bg-blue-800 transition">
            <i class="fa-solid fa-phone"></i> Hubungi Kami
          </a>
          <div class="relative">
            <input type="text" placeholder="Cari properti..." class="w-full pl-3 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
              <i class="fas fa-search"></i>
            </span>
          </div>
        </div>
      </nav>
    </div>
  </div>
</nav>

<!-- Spacer supaya konten tidak ketiban navbar fixed -->
<div class="h-[64px] sm:h-[72px]"></div>

<script>
(function(){
  // ===== Desktop: set label bahasa saat pilih =====
  const langDesk = document.getElementById('langDropdown');
  if (langDesk){
    const deskLabel = document.getElementById('langLabel');
    langDesk.querySelectorAll('[data-lang]').forEach(btn=>{
      btn.addEventListener('click', ()=>{ if(deskLabel) deskLabel.textContent = btn.getAttribute('data-lang'); });
    });
  }

  // ===== Mobile Drawer =====
  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  const mobileBackdrop = document.getElementById('mobileBackdrop');
  const mobileClose = document.getElementById('mobileClose');

  function openMobile(){
    mobileMenu.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    if (hamburgerBtn) hamburgerBtn.setAttribute('aria-expanded','true');
  }
  function closeMobile(){
    mobileMenu.classList.add('hidden');
    document.body.style.overflow = '';
    if (hamburgerBtn) hamburgerBtn.setAttribute('aria-expanded','false');
  }
  if (hamburgerBtn){ hamburgerBtn.addEventListener('click', openMobile); }
  if (mobileBackdrop){ mobileBackdrop.addEventListener('click', closeMobile); }
  if (mobileClose){ mobileClose.addEventListener('click', closeMobile); }

  // ===== Mobile accordion (Properti & Bahasa) =====
  const panels = document.querySelectorAll('[data-panel]');
  const chevrons = document.querySelectorAll('[data-chevron]');
  document.querySelectorAll('[data-accordion]').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const key = btn.getAttribute('data-accordion');
      const panel = document.querySelector(`[data-panel="${key}"]`);
      const chevron = document.querySelector(`[data-chevron="${key}"]`);
      const expanded = panel.style.maxHeight && panel.style.maxHeight !== '0px';

      // Tutup semua
      panels.forEach(p=>{ p.style.maxHeight = null; });
      chevrons.forEach(c=>{ c.style.transform = 'rotate(0deg)'; });

      // Toggle
      if (!expanded) {
        panel.style.maxHeight = panel.scrollHeight + 'px';
        chevron.style.transform = 'rotate(180deg)';
      }
    });
  });

  // ===== Mobile language label =====
  const langMobLabel = document.getElementById('langLabelMob');
  document.querySelectorAll('#mobileMenu [data-lang]').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      if (langMobLabel) langMobLabel.textContent = btn.getAttribute('data-lang');
    });
  });
})();
</script>
