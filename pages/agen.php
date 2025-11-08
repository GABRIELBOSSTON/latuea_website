<?php
require __DIR__ . '/../includes/db_connect.php';
require __DIR__ . '/../includes/header.php';

// Fetch agents from database with additional mock data for demonstration
$agents = [];
try {
    // Diasumsikan tabel 'agents' memiliki kolom: id, name, email, phone_number, company, photo_path
    $stmt_agents = $pdo->query("SELECT * FROM agents ORDER BY name ASC");
    $agents = $stmt_agents->fetchAll(PDO::FETCH_ASSOC);

    // Add mock data for demonstration. In a real app, this would come from the database.
    foreach ($agents as $key => $agent) {
        // Mock data ini bisa Anda hapus jika sudah ada di database Anda
        $agents[$key]['total_deals'] = rand(10, 180);
    }
} catch (PDOException $e) {
    $agents = [];
    error_log("Error fetching agents: " . $e->getMessage());
    echo "<div class='container mx-auto px-4 py-6'><p class='text-red-600'>Terjadi kesalahan saat mengambil data agen.</p></div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Agen - Latuae Land</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background-color: #f5f7fa;
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
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
        /* Fixed photo dimensions: 8.5cm x 5.5cm = approximately 321px x 208px at 96 DPI */
        .agent-photo-container {
            width: 100%;
            height: 321px; /* 8.5cm converted to pixels */
            position: relative;
            overflow: hidden;
        }
        .agent-photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
        }
    </style>
    <script>
        // Konfigurasi warna custom dari desain baru
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#1c7edc',
                        'primary-outline': '#1c7edc',
                        'text-primary': '#2c3e50',
                        'text-secondary': '#7f8c8d',
                    }
                }
            }
        }
    </script>
</head>
<body class="text-gray-800">

<!-- Header Section -->
<header class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-12 px-5 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-3 animate-fadeInUp">Temukan Agen Impian Anda</h1>
        <p class="text-lg sm:text-xl text-blue-200 mb-8 animate-fadeInUp" style="animation-delay: 0.2s;">Jelajahi profesional properti terbaik di wilayah Anda.</p>
        <div class="relative w-full max-w-xl mx-auto animate-fadeInUp" style="animation-delay: 0.4s;">
            <input type="text" placeholder="Cari agen berdasarkan nama, email, atau perusahaan..." id="agent-search"
                   class="w-full px-6 py-4 rounded-full border-2 border-transparent focus:outline-none focus:ring-4 focus:ring-blue-600 focus:border-blue-700 transition-all duration-300 shadow-xl text-gray-800">
            <button id="search-button" class="absolute right-2 top-1/2 -translate-y-1/2 px-5 py-2 rounded-full bg-green-600 text-white font-semibold hover:bg-green-700 transition-colors">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold text-text-primary mb-8 sm:mb-10 text-center">Agen Properti Pilihan Kami</h1>

    <!-- Grid untuk daftar agen dengan desain baru (responsive) -->
    <div id="agent-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4">
        <?php if (!empty($agents)): ?>
            <?php foreach ($agents as $agent): ?>
                <div class="agent-card-wrapper" data-agent='<?php echo htmlspecialchars(json_encode($agent), ENT_QUOTES, 'UTF-8'); ?>'>
                    <div class="bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer hover:-translate-y-1 overflow-hidden flex flex-col w-full max-w-[240px] mx-auto">
                        
                        <!-- Agent Image Container - Fixed size 8.5cm x 5.5cm -->
                        <div class="agent-photo-container">
                            <?php
                            $photo_url = null;
                            if (isset($agent['photo_path']) && !empty($agent['photo_path']) && file_exists(__DIR__ . '/../Uploads/agents/' . $agent['photo_path'])) {
                                $photo_url = "../Uploads/agents/" . htmlspecialchars($agent['photo_path']);
                            }
                            
                            if ($photo_url): ?>
                                <img src="<?php echo $photo_url; ?>" alt="Foto profil <?php echo htmlspecialchars($agent['name']); ?>">
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-300 text-5xl"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Agent Contact Section -->
                        <div class="bg-[#28388D] p-3 sm:p-4 text-center">
                            <div class="w-3/5 mx-auto mb-2 border-t border-black"></div>
                            <p class="text-white text-xs sm:text-sm mb-1 flex items-center justify-center gap-1.5">
                                <i class="fas fa-phone text-xs"></i> 
                                <span class="truncate"><?php echo htmlspecialchars($agent['phone_number'] ?? 'N/A'); ?></span>
                            </p>
                            <p class="text-white text-xs sm:text-sm flex items-center justify-center gap-1.5">
                                <i class="fas fa-envelope text-xs"></i> 
                                <span class="truncate"><?php echo htmlspecialchars($agent['email'] ?? 'N/A'); ?></span>
                            </p>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="col-span-full text-center text-gray-600 mt-10 text-lg">
                <i class="fas fa-info-circle text-3xl mb-4 text-blue-700"></i><br>
                Saat ini belum ada agen yang terdaftar.
            </p>
        <?php endif; ?>
    </div>
    
    <!-- Pesan jika hasil pencarian tidak ditemukan -->
    <div id="no-results-message" class="hidden text-center text-gray-600 mt-10">
        <i class="fas fa-search-minus text-4xl mb-4 text-blue-700"></i>
        <p class="text-lg">Mohon maaf, tidak ada agen yang cocok dengan pencarian Anda.</p>
    </div>

</main>

<!-- Tombol Back to Top -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-blue-800 text-white p-4 rounded-full shadow-lg transition-all duration-300 opacity-0 transform scale-0 hover:bg-blue-900">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Modal Detail Agen -->
<div id="agent-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl relative animate-fadeInUp">
        <button id="close-modal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-800 text-2xl z-10">
            <i class="fas fa-times-circle"></i>
        </button>
        <div id="modal-content">
            <!-- Konten modal akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<!-- Footer -->
<?php include '../includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const agentSearchInput = document.getElementById('agent-search');
    const searchButton = document.getElementById('search-button');
    const agentContainer = document.getElementById('agent-container');
    const allAgentCards = agentContainer.querySelectorAll('.agent-card-wrapper');
    const noResultsMessage = document.getElementById('no-results-message');

    function filterAgents() {
        const filterText = agentSearchInput.value.toLowerCase().trim();
        let resultsFound = false;

        allAgentCards.forEach(function(cardWrapper) {
            const agentData = JSON.parse(cardWrapper.getAttribute('data-agent'));
            const agentName = (agentData.name || '').toLowerCase();
            const agentEmail = (agentData.email || '').toLowerCase();
            const agentCompany = (agentData.company || '').toLowerCase();

            if (agentName.includes(filterText) || agentEmail.includes(filterText) || agentCompany.includes(filterText)) {
                cardWrapper.style.display = 'block';
                resultsFound = true;
            } else {
                cardWrapper.style.display = 'none';
            }
        });

        noResultsMessage.classList.toggle('hidden', resultsFound);
    }

    agentSearchInput.addEventListener('keyup', filterAgents);
    searchButton.addEventListener('click', filterAgents);

    // --- Logika Modal ---
    const agentModal = document.getElementById('agent-modal');
    const closeModalButton = document.getElementById('close-modal');
    const modalContent = document.getElementById('modal-content');

    allAgentCards.forEach(cardWrapper => {
        const card = cardWrapper.querySelector('div');
        card.addEventListener('click', (e) => {
            const agentData = JSON.parse(cardWrapper.getAttribute('data-agent'));
            const photoPath = agentData.photo_path ? `../Uploads/agents/${agentData.photo_path}` : null;

            modalContent.innerHTML = `
                <div class="flex flex-col sm:flex-row items-stretch text-center sm:text-left rounded-xl overflow-hidden">
                    <!-- Kolom Kiri: Foto dan Statistik -->
                    <div class="w-full sm:w-1/3 bg-gray-100 p-6 flex flex-col items-center justify-center">
                        ${photoPath ? 
                            `<img src="${photoPath}" alt="Foto Agen ${agentData.name}" class="w-32 h-32 rounded-full border-4 border-white shadow-xl object-cover mb-4">` :
                            `<div class="w-32 h-32 rounded-full border-4 border-white shadow-xl mb-4 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400 text-5xl"></i>
                            </div>`
                        }
                        <h3 class="text-2xl font-bold text-text-primary">${agentData.name}</h3>
                        <p class="text-md text-gray-600 mb-5">${agentData.company || 'Independen'}</p>
                        <div class="w-full bg-primary-blue text-white rounded-lg p-3 text-center">
                            <p class="text-sm uppercase tracking-wider">Total Transaksi</p>
                            <p class="text-3xl font-bold">${agentData.total_deals || '0'}</p>
                        </div>
                    </div>
            
                    <!-- Kolom Kanan: Info Kontak dan Aksi -->
                    <div class="w-full sm:w-2/3 p-8 flex flex-col justify-between">
                        <div>
                            <h4 class="text-xl font-bold text-text-primary border-b pb-2 mb-6">Detail Kontak Agen</h4>
                            <div class="space-y-4 text-gray-700">
                                <p class="flex items-center text-sm">
                                    <i class="fas fa-id-card text-primary-blue w-6 text-center mr-3 text-lg"></i>
                                    <span class="font-semibold text-gray-500 w-20">ID Agen</span>
                                    <span>: ${agentData.id || 'N/A'}</span>
                                </p>
                                <p class="flex items-center text-sm">
                                    <i class="fas fa-envelope text-primary-blue w-6 text-center mr-3 text-lg"></i>
                                    <span class="font-semibold text-gray-500 w-20">Email</span>
                                    <span>: ${agentData.email || 'Tidak tersedia'}</span>
                                </p>
                                <p class="flex items-center text-sm">
                                    <i class="fas fa-phone-alt text-primary-blue w-6 text-center mr-3 text-lg"></i>
                                    <span class="font-semibold text-gray-500 w-20">Telepon</span>
                                    <span>: ${agentData.phone_number || 'Tidak tersedia'}</span>
                                </p>
                            </div>
                        </div>
            
                        <div class="mt-8 pt-6 border-t flex flex-col sm:flex-row items-center justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                            <a href="https://wa.me/${(agentData.phone_number || '').replace(/[^0-9]/g, '')}" target="_blank"
                               class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-green-500 text-white rounded-lg font-bold text-base hover:bg-green-600 transition-all duration-300 shadow-md hover:shadow-lg w-full sm:w-auto">
                                <i class="fab fa-whatsapp text-xl"></i> Chat via WhatsApp
                            </a>
                            <a href="tel:${(agentData.phone_number || '').replace(/[^0-9]/g, '')}"
                               class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-primary-blue text-white rounded-lg font-bold text-base hover:bg-blue-800 transition-all duration-300 shadow-md hover:shadow-lg w-full sm:w-auto">
                                <i class="fas fa-phone-alt text-lg"></i> Telepon Langsung
                            </a>
                        </div>
                    </div>
                </div>
            `;
            agentModal.classList.remove('hidden');
        });
    });

    closeModalButton.addEventListener('click', () => {
        agentModal.classList.add('hidden');
    });

    agentModal.addEventListener('click', (e) => {
        if (e.target.id === 'agent-modal') {
            agentModal.classList.add('hidden');
        }
    });

    // --- Logika Tombol Back to Top ---
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
});
</script>

</body>
</html>