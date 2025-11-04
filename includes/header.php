<?php
$page_title = isset($page_title) ? $page_title : 'Latuae Land';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($page_title) ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"/>
  <style>
    .goog-te-banner-frame, .goog-te-menu-value, #goog-gt-tt, .goog-te-balloon { display: none !important; }
    body { top: 0 !important; }
  </style>
</head>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const searchInputs = document.querySelectorAll("#searchInput, #searchInputMob");
  const searchIcons = document.querySelectorAll(".fa-search");

  // Fungsi pencarian
  function doSearch(query) {
    if (!query.trim()) return;
    const url = `/LatuaGroup/pages/listproperty.php?q=${encodeURIComponent(query)}`;
    window.location.href = url;
  }

  // Enter di input
  searchInputs.forEach(input => {
    input.addEventListener("keypress", function(e) {
      if (e.key === "Enter") {
        e.preventDefault();
        doSearch(this.value);
      }
    });
  });

  // Klik ikon search
  searchIcons.forEach(icon => {
    icon.addEventListener("click", function() {
      const input = this.closest("div").querySelector("input");
      if (input) doSearch(input.value);
    });
  });
});
</script>


<body>
<!-- HEADER NAVIGATION (warna biru tua + font putih) -->
<nav id="mainNav" class="fixed top-0 left-0 w-full z-50 bg-[#0F1940] shadow-md text-white">
  <div class="max-w-[90%] mx-auto px-6 py-4 flex items-center justify-between space-x-10">
                                          
    <!-- Logo -->
    <a href="/LatuaGroup/pages/index.php" class="flex items-center space-x-2">
      <img src="/LatuaGroup/uploads/latualogo3.png" 
          alt="Latuae Land" 
          class="h-14 sm:h-18 w-auto">        
    </a>                                      

    <!-- Desktop Nav -->
    <div class="hidden md:flex items-center gap-12 lg:gap-16 whitespace-nowrap">
      <div class="relative group" id="propertiDropdown">
        <button type="button" class="inline-flex items-center gap-2 text-white hover:text-gray-300 font-medium">
          Properti <i class="fa-solid fa-chevron-down text-[10px]"></i>
        </button>
        <div class="pointer-events-none group-hover:pointer-events-auto invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 absolute left-0 mt-3 w-56 rounded-lg border border-gray-200 bg-[#0F1940] shadow-lg transition-all duration-150" data-menu="properti">
          <ul class="py-2 text-sm text-white">
            <li><a href="/LatuaGroup/pages/listproperty.php?property=rumah" class="block px-4 py-2 hover:bg-[#18245f]">Rumah</a></li>
            <li><a href="/LatuaGroup/pages/listproperty.php?property=apartemen" class="block px-4 py-2 hover:bg-[#18245f]">Apartemen</a></li>
            <li><a href="/LatuaGroup/pages/listproperty.php?property=ruko" class="block px-4 py-2 hover:bg-[#18245f]">Ruko</a></li>
            <li><a href="/LatuaGroup/pages/listproperty.php?property=tanah" class="block px-4 py-2 hover:bg-[#18245f]">Tanah</a></li>
          </ul>
        </div>
      </div>
      <a href="/LatuaGroup/pages/agen.php" class="text-white hover:text-gray-300 font-medium">Cari Agen</a>
      <a href="office.php" class="text-white hover:text-gray-300 font-medium">Layanan</a>
      <a href="/LatuaGroup/pages/about.php" class="text-white hover:text-gray-300 font-medium">Tentang Kami</a>
    </div>

    <!-- Right Section -->
    <div class="hidden md:flex items-center gap-3 lg:gap-4">
      <!-- Language Dropdown -->
      <div class="relative group" id="langDropdown">
        <button type="button" class="inline-flex items-center gap-2 border border-gray-400 rounded-md px-3 py-2 text-[15px] text-white hover:border-gray-300 hover:text-gray-300 bg-transparent focus:outline-none">
          <i class="fa-solid fa-globe"></i>
          <span id="langLabel">IND</span>
          <i class="fa-solid fa-chevron-down text-[10px]"></i>
        </button>
        <div class="pointer-events-none group-hover:pointer-events-auto invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 absolute right-0 mt-2 w-36 rounded-lg border border-gray-200 bg-[#0F1940] shadow-lg transition-all duration-150" data-menu="lang">
          <ul class="py-2 text-sm text-white">
            <li><button type="button" data-lang="id" class="w-full text-left px-4 py-2 hover:bg-[#18245f] flex items-center gap-2">
              <span class="fi fi-id"></span> IND
            </button></li>
            <li><button type="button" data-lang="en" class="w-full text-left px-4 py-2 hover:bg-[#18245f] flex items-center gap-2">
              <span class="fi fi-us"></span> ENG
            </button></li>
          </ul>
        </div>
      </div>

      <a href="/LatuaGroup/pages/contact.php" class="inline-flex items-center gap-2 bg-[#1E3A8A] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#2a4fbf] transition">
        <i class="fa-solid fa-phone"></i> Hubungi Kami
      </a>

      <div class="relative">
        <input type="text" id="searchInput" placeholder="Cari properti..." 
              class="h-10 pl-3 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black placeholder-gray-400">
        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
          <i class="fas fa-search"></i>
        </span>
      </div>

      <!-- Mobile Hamburger -->
      <button id="hamburgerBtn" class="md:hidden w-10 h-10 flex items-center justify-center rounded-md text-white hover:text-gray-300">
        <i class="fa-solid fa-bars text-xl"></i>
      </button>
    </div>
  </div>
</nav>


<div class="h-[64px] sm:h-[72px]"></div>

<!-- Google Translate Widget -->
<div id="google_translate_element" style="position:absolute; left:-9999px;"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'id',
    includedLanguages: 'en,id',
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
    autoDisplay: false
  }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- TRANSLATE + UPDATE ATRIBUT -->
<script>
let translateReady = false;
const translations = {
  id: {
    search: "Cari properti...",
    contact: "Hubungi Kami",
    property: "Properti",
    house: "Rumah",
    apartment: "Apartemen",
    shophouse: "Ruko",
    land: "Tanah"
  },
  en: {
    search: "Search property...",
    contact: "Contact Us",
    property: "Property",
    house: "House",
    apartment: "Apartment",
    shophouse: "Shophouse",
    land: "Land"
  }
};

const checkInterval = setInterval(() => {
  if (document.querySelector('.goog-te-combo')) {
    translateReady = true;
    clearInterval(checkInterval);
  }
}, 100);

function switchLanguage(lang) {
  if (!translateReady) {
    setTimeout(() => switchLanguage(lang), 200);
    return;
  }

  const select = document.querySelector('.goog-te-combo');
  if (select && select.value !== lang) {
    select.value = lang;
    select.dispatchEvent(new Event('change'));
  }

  // Update label
  document.getElementById('langLabel').textContent = lang.toUpperCase();
  document.getElementById('langLabelMob').textContent = lang.toUpperCase();

  // Update placeholder & text
  const t = translations[lang];
  document.querySelectorAll('#searchInput, #searchInputMob').forEach(el => el.placeholder = t.search);
  document.querySelector('a[href*="contact.php"] > i + span').textContent = t.contact;
}

document.querySelectorAll('[data-lang]').forEach(btn => {
  btn.addEventListener('click', () => switchLanguage(btn.getAttribute('data-lang')));
});

setTimeout(() => switchLanguage('id'), 1500);
</script>

<!-- Script Asli -->
<script>
(function(){
  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  const mobileBackdrop = document.getElementById('mobileBackdrop');
  const mobileClose = document.getElementById('mobileClose');

  function openMobile(){ mobileMenu.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
  function closeMobile(){ mobileMenu.classList.add('hidden'); document.body.style.overflow = ''; }

  hamburgerBtn?.addEventListener('click', openMobile);
  mobileBackdrop?.addEventListener('click', closeMobile);
  mobileClose?.addEventListener('click', closeMobile);

  document.querySelectorAll('[data-accordion]').forEach(btn => {
    btn.addEventListener('click', () => {
      const key = btn.getAttribute('data-accordion');
      const panel = document.querySelector(`[data-panel="${key}"]`);
      const chevron = document.querySelector(`[data-chevron="${key}"]`);
      const expanded = panel.style.maxHeight;

      document.querySelectorAll('[data-panel]').forEach(p => p.style.maxHeight = null);
      document.querySelectorAll('[data-chevron]').forEach(c => c.style.transform = 'rotate(0deg)');

      if (!expanded) {
        panel.style.maxHeight = panel.scrollHeight + 'px';
        chevron.style.transform = 'rotate(180deg)';
      }
    });
  });

  const propDropdown = document.getElementById('propertiDropdown');
  if (propDropdown) {
    const menu = propDropdown.querySelector('[data-menu="properti"]');
    let showTimer, hideTimer;
    propDropdown.addEventListener('mouseenter', () => {
      clearTimeout(hideTimer);
      showTimer = setTimeout(() => {
        menu.classList.remove('invisible', 'opacity-0', 'translate-y-2');
        menu.classList.add('visible', 'opacity-100', 'translate-y-0', 'pointer-events-auto');
      }, 150);
    });
    propDropdown.addEventListener('mouseleave', () => {
      clearTimeout(showTimer);
      hideTimer = setTimeout(() => {
        menu.classList.remove('visible', 'opacity-100', 'translate-y-0', 'pointer-events-auto');
        menu.classList.add('invisible', 'opacity-0', 'translate-y-2');
      }, 300);
    });
  }
})();
</script>
</body>
</html>