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
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .goog-te-banner-frame, .goog-te-menu-value, #goog-gt-tt, .goog-te-balloon { display: none !important; }
        body { top: 0 !important; }
        
        /* Smooth transitions */
        .mobile-menu-enter {
            transform: translateX(-100%);
            opacity: 0;
        }
        .mobile-menu-enter-active {
            transform: translateX(0);
            opacity: 1;
            transition: all 0.3s ease-out;
        }
        .mobile-menu-exit {
            transform: translateX(0);
            opacity: 1;
        }
        .mobile-menu-exit-active {
            transform: translateX(-100%);
            opacity: 0;
            transition: all 0.3s ease-in;
        }
    </style>
</head>

<body>
<!-- HEADER NAVIGATION -->
<nav id="mainNav" class="fixed top-0 left-0 w-full z-50 bg-[#0F1940] shadow-md text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            
            <!-- Logo -->
            <a href="/LatuaGroup/pages/index.php" class="flex items-center flex-shrink-0">
                <img src="/LatuaGroup/uploads/latualogo3.png" 
                    alt="Latuae Land" 
                    class="h-10 sm:h-12 lg:h-14 w-auto">        
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <!-- Properti Dropdown -->
                <div class="relative group">
                    <button type="button" class="inline-flex items-center gap-2 text-white hover:text-gray-300 font-medium transition-colors">
                        Properti <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                    <div class="invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 absolute left-0 mt-2 w-48 rounded-lg border border-gray-700 bg-[#0F1940] shadow-xl transition-all duration-200">
                        <ul class="py-2 text-sm text-white">
                            <li><a href="/LatuaGroup/pages/listproperty.php?property=rumah" class="block px-4 py-2.5 hover:bg-[#1E3A8A] transition-colors">Rumah</a></li>
                            <li><a href="/LatuaGroup/pages/listproperty.php?property=apartemen" class="block px-4 py-2.5 hover:bg-[#1E3A8A] transition-colors">Apartemen</a></li>
                            <li><a href="/LatuaGroup/pages/listproperty.php?property=ruko" class="block px-4 py-2.5 hover:bg-[#1E3A8A] transition-colors">Ruko</a></li>
                            <li><a href="/LatuaGroup/pages/listproperty.php?property=tanah" class="block px-4 py-2.5 hover:bg-[#1E3A8A] transition-colors">Tanah</a></li>
                        </ul>
                    </div>
                </div>

                <a href="/LatuaGroup/pages/agen.php" class="text-white hover:text-gray-300 font-medium transition-colors">Cari Agen</a>
                <a href="office.php" class="text-white hover:text-gray-300 font-medium transition-colors">Layanan</a>
                <a href="/LatuaGroup/pages/about.php" class="text-white hover:text-gray-300 font-medium transition-colors">Tentang Kami</a>
            </div>

            <!-- Right Section Desktop (POSISI DITUKAR DI SINI) -->
            <div class="hidden lg:flex items-center space-x-4">
                
                <!-- 1. Contact Button (Pindah ke posisi pertama) -->
                <a href="/LatuaGroup/pages/contact.php" 
                   class="inline-flex items-center gap-2 bg-[#1E3A8A] text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-[#2563eb] transition-all shadow-lg hover:shadow-xl">
                    <i class="fa-solid fa-phone"></i>
                    <span>Hubungi Kami</span>
                </a>
                
                <!-- 2. Search Bar (Pindah ke posisi kedua) -->
                <div class="relative">
                    <input type="text" 
                            id="searchInput" 
                            placeholder="Cari properti..." 
                            class="w-56 h-10 pl-4 pr-10 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn" 
                    class="lg:hidden p-2 rounded-lg text-white hover:bg-[#1a2a5e] transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Menu Backdrop -->
<div id="mobileBackdrop" 
      class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden transition-opacity duration-300"></div>

<!-- Mobile Menu Sidebar -->
<div id="mobileMenu" 
      class="hidden fixed top-0 left-0 h-full w-80 max-w-[85%] bg-gradient-to-br from-[#0F1940] to-[#1a2a5e] z-50 shadow-2xl lg:hidden overflow-y-auto">
    
    <!-- Mobile Menu Header -->
    <div class="flex items-center justify-between p-5 border-b border-gray-700 bg-[#0a1230]">
        <img src="/LatuaGroup/uploads/latualogo3.png" 
            alt="Latuae Land" 
            class="h-12 w-auto">
        <button id="closeMobileMenu" 
                class="p-2 rounded-full text-white hover:bg-white/10 transition-all duration-200 active:scale-95">
            <i class="fa-solid fa-times text-2xl"></i>
        </button>
    </div>

    <!-- Mobile Menu Content -->
    <div class="p-5">
        <!-- Search Mobile -->
        <div class="mb-6">
            <div class="relative">
                <input type="text" 
                        id="searchInputMob" 
                        placeholder="Cari properti..." 
                        class="w-full h-12 pl-4 pr-12 border-2 border-gray-300 rounded-xl bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm">
                <button class="absolute right-3 top-1/2 -translate-y-1/2 bg-[#1E3A8A] text-white w-9 h-9 rounded-lg flex items-center justify-center hover:bg-[#2563eb] transition-all active:scale-95">
                    <i class="fas fa-search text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Menu Items -->
        <nav class="space-y-2">
            <!-- Properti Accordion -->
            <div class="bg-white/5 rounded-xl overflow-hidden backdrop-blur-sm">
                <button type="button" 
                        data-accordion="properti"
                        class="w-full flex items-center justify-between px-4 py-4 text-white font-semibold transition-all hover:bg-white/10">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-building text-blue-400"></i>
                        Properti
                    </span>
                    <i data-chevron="properti" class="fa-solid fa-chevron-down text-sm transition-transform duration-300"></i>
                </button>
                <div data-panel="properti" 
                      class="overflow-hidden transition-all duration-300" 
                      style="max-height: 0">
                    <div class="px-4 pb-3 space-y-1 bg-black/20">
                        <a href="/LatuaGroup/pages/listproperty.php?property=rumah" 
                           class="flex items-center gap-3 py-3 px-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                            <i class="fa-solid fa-home text-xs"></i>
                            Rumah
                        </a>
                        <a href="/LatuaGroup/pages/listproperty.php?property=apartemen" 
                           class="flex items-center gap-3 py-3 px-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                            <i class="fa-solid fa-building text-xs"></i>
                            Apartemen
                        </a>
                        <a href="/LatuaGroup/pages/listproperty.php?property=ruko" 
                           class="flex items-center gap-3 py-3 px-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                            <i class="fa-solid fa-store text-xs"></i>
                            Ruko
                        </a>
                        <a href="/LatuaGroup/pages/listproperty.php?property=tanah" 
                           class="flex items-center gap-3 py-3 px-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                            <i class="fa-solid fa-map text-xs"></i>
                            Tanah
                        </a>
                    </div>
                </div>
            </div>

            <a href="/LatuaGroup/pages/agen.php" 
               class="flex items-center gap-3 px-4 py-4 text-white font-semibold bg-white/5 rounded-xl hover:bg-white/10 transition-all backdrop-blur-sm">
                <i class="fa-solid fa-user-tie text-blue-400"></i>
                Cari Agen
            </a>

            <a href="office.php" 
               class="flex items-center gap-3 px-4 py-4 text-white font-semibold bg-white/5 rounded-xl hover:bg-white/10 transition-all backdrop-blur-sm">
                <i class="fa-solid fa-briefcase text-blue-400"></i>
                Layanan
            </a>

            <a href="/LatuaGroup/pages/about.php" 
               class="flex items-center gap-3 px-4 py-4 text-white font-semibold bg-white/5 rounded-xl hover:bg-white/10 transition-all backdrop-blur-sm">
                <i class="fa-solid fa-info-circle text-blue-400"></i>
                Tentang Kami
            </a>
        </nav>

        <!-- Contact Button Mobile -->
        <div class="mt-6 pt-6 border-t border-gray-700">
            <a href="/LatuaGroup/pages/contact.php" 
               class="flex items-center justify-center gap-3 w-full bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] text-white px-6 py-4 rounded-xl font-bold hover:shadow-xl hover:scale-[1.02] transition-all active:scale-95 shadow-lg">
                <i class="fa-solid fa-phone-volume text-lg"></i>
                <span>Hubungi Kami</span>
            </a>
        </div>
    </div>
</div>

<!-- Spacer untuk fixed navbar -->
<div class="h-16 lg:h-20"></div>

<!-- Search Functionality Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInputs = document.querySelectorAll("#searchInput, #searchInputMob");
    const searchButtons = document.querySelectorAll(".fa-search");

    function doSearch(query) {
        if (!query.trim()) return;
        const url = `/LatuaGroup/pages/listproperty.php?q=${encodeURIComponent(query)}`;
        window.location.href = url;
    }

    searchInputs.forEach(input => {
        input.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                doSearch(this.value);
            }
        });
    });

    searchButtons.forEach(button => {
        button.addEventListener("click", function() {
            const input = this.closest("div").querySelector("input");
            if (input) doSearch(input.value);
        });
    });
});
</script>

<!-- Mobile Menu Script -->
<script>
(function() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileBackdrop = document.getElementById('mobileBackdrop');
    const closeMobileMenu = document.getElementById('closeMobileMenu');

    function openMobileMenu() {
        mobileMenu.classList.remove('hidden');
        mobileBackdrop.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            mobileMenu.style.transform = 'translateX(0)';
            mobileBackdrop.style.opacity = '1';
        }, 10);
    }

    function closeMobileMenuFunc() {
        mobileMenu.style.transform = 'translateX(-100%)';
        mobileBackdrop.style.opacity = '0';
        
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
            mobileBackdrop.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    mobileMenuBtn?.addEventListener('click', openMobileMenu);
    closeMobileMenu?.addEventListener('click', closeMobileMenuFunc);
    mobileBackdrop?.addEventListener('click', closeMobileMenuFunc);

    // Accordion functionality
    document.querySelectorAll('[data-accordion]').forEach(btn => {
        btn.addEventListener('click', () => {
            const key = btn.getAttribute('data-accordion');
            const panel = document.querySelector(`[data-panel="${key}"]`);
            const chevron = document.querySelector(`[data-chevron="${key}"]`);
            const isOpen = panel.style.maxHeight && panel.style.maxHeight !== '0px';

            // Close all panels
            document.querySelectorAll('[data-panel]').forEach(p => {
                p.style.maxHeight = '0';
            });
            document.querySelectorAll('[data-chevron]').forEach(c => {
                c.style.transform = 'rotate(0deg)';
            });

            // Open clicked panel if it was closed
            if (!isOpen) {
                panel.style.maxHeight = panel.scrollHeight + 'px';
                chevron.style.transform = 'rotate(180deg)';
            }
        });
    });

    // Close mobile menu when clicking on links
    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', () => {
            closeMobileMenuFunc();
        });
    });
})();
</script>

</body>
</html>