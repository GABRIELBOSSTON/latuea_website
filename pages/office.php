<?php
// Set dynamic title for this page
$page_title = 'Kantor Kami';

// Include header
require __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?> - Latuae Land</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Animasi teks muncul dari bawah ke atas */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out forwards;
        }
        /* Animasi untuk tombol back to top */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        /* Animasi Back to Top */
        #back-to-top {
            animation: fadeInScale 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Header Section -->
<header class="relative w-full h-[450px] md:h-[60vh] min-h-[300px] bg-cover bg-center flex items-center justify-center text-white text-center" style="background-image: url('/LatuaGroup/uploads/about-hero.jpg');">
    <div class="absolute inset-0 bg-blue-900 bg-opacity-70"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-5">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 animate-fadeInUp">Kunjungi Kantor Kami</h1>
        <p class="text-lg md:text-xl text-blue-200 animate-fadeInUp" style="animation-delay: 0.2s;">Kami siap membantu Anda mencapai impian properti Anda.</p>
    </div>
</header>

<main class="py-16 px-5 max-w-7xl mx-auto">
    <!-- Our Office Section -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16 animate-fadeInUp">
        <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:scale-[1.01] transition-transform duration-300">
            <div class="flex items-center mb-6">
                <img src="https://placehold.co/80x80/0e1b4d/ffffff&text=L" alt="Latuae Group Logo" class="rounded-full w-20 h-20 shadow-md mr-4">
                <div>
                    <h2 class="text-3xl font-bold text-blue-900 mb-1">Kantor Latuae Land</h2>
                    <p class="text-md text-gray-600">Pusat Layanan Properti Terbaik</p>
                </div>
            </div>
            <p class="text-md text-gray-700 leading-relaxed mb-6"><i class="fas fa-map-marker-alt text-blue-700 mr-2"></i> Summarecon Bekasi, Jl. Bulevar Selatan Blok UG 08, RT 004/011, Marga Mulya, Kec. Bekasi Utara, Jawa Barat 17142</p>
            <div class="space-y-4">
                <div class="flex items-center text-gray-700">
                    <i class="fas fa-envelope text-blue-700 w-6 h-6 mr-3"></i>
                    <a href="mailto:latuealand@gmail.com" class="text-blue-700 hover:underline">latuealand@gmail.com</a>
                </div>
                <div class="flex items-center text-gray-700">
                    <i class="fas fa-phone-alt text-blue-700 w-6 h-6 mr-3"></i>
                    <a href="tel:08111440205" class="text-blue-700 hover:underline">08111440205</a>
                </div>
            </div>
            <a href="https://maps.google.com/?q=Summarecon+Bekasi,+Jl.+Bulevar+Selatan+Blok+UG+08,+RT+004/011,+Marga+Mulya,+Kec.+Bekasi+Utara,+Jawa+Barat+17142" target="_blank" class="mt-8 inline-block px-8 py-3 bg-blue-700 text-white rounded-full font-semibold hover:bg-blue-800 transition-colors shadow-lg">
                <i class="fas fa-directions mr-2"></i> Dapatkan Petunjuk Arah
            </a>
        </div>
        <div class="rounded-2xl shadow-xl overflow-hidden animate-fadeInUp" style="animation-delay: 0.4s;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0446489845514!2d106.99869631476939!3d-6.260959995465998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c0e5d6e5b8d%3A0x5e8f5e8f5e8f5e8f!2sSummarecon%20Bekasi!5e0!3m2!1sen!2sid!4v1635744000000!5m2!1sen!2sid"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </section>

    <!-- Kunjungi Kantor Kami Section -->
    <section class="flex justify-center mb-16 animate-fadeInUp" style="animation-delay: 0.6s;">
        <a href="https://maps.google.com/?q=Summarecon+Bekasi,+Jl.+Bulevar+Selatan+Blok+UG+08,+RT+004/011,+Marga+Mulya,+Kec.+Bekasi+Utara,+Jawa+Barat+17142" target="_blank" class="bg-blue-800 text-white py-3 px-8 rounded-lg font-semibold text-xl hover:bg-blue-900 transform hover:scale-105 transition-all shadow-lg">
            Kunjungi Kantor Kami
        </a>
    </section>

</main>

<!-- Floating Back to Top Button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-blue-800 text-white p-4 rounded-full shadow-lg transition-all duration-300 opacity-0 transform scale-0 hover:bg-blue-900">
    <i class="fas fa-arrow-up"></i>
</button>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
    // Back to Top button logic
    const backToTopButton = document.getElementById('back-to-top');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopButton.classList.add('opacity-100', 'scale-100');
            backToTopButton.classList.remove('opacity-0', 'scale-0');
        } else {
            backToTopButton.classList.remove('opacity-100', 'scale-100');
            backToTopButton.classList.add('opacity-0', 'scale-0');
        }
    });

    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

</body>
</html>