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
        $agents[$key]['total_deals'] = rand(10, 180); // Mengganti nama 'listings' dengan 'total_deals' agar konsisten
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
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

<!-- Header Section (Dipertahankan dari kode lama untuk fungsionalitas pencarian) -->
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

<!-- Main Content with New Design -->
<main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold text-text-primary mb-8 sm:mb-10 text-center">Agen Properti Pilihan Kami</h1>

    <!-- Grid untuk daftar agen dengan desain baru -->
    <div id="agent-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($agents)): ?>
            <?php foreach ($agents as $agent): ?>
                <div class="agent-card bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 cursor-pointer" data-agent='<?php echo htmlspecialchars(json_encode($agent), ENT_QUOTES, 'UTF-8'); ?>'>
                    <div class="flex items-start mb-4">
                        <!-- Foto Profil dan Detail Agen -->
                        <div class="flex-shrink-0 mr-4">
                            <?php
                            $photo_url = "https://placehold.co/80x80/2c3e50/ffffff?font=Inter&text=N/A";
                            if (isset($agent['photo_path']) && !empty($agent['photo_path']) && file_exists(__DIR__ . '/../Uploads/agents/' . $agent['photo_path'])) {
                                $photo_url = "../Uploads/agents/" . htmlspecialchars($agent['photo_path']);
                            }
                            ?>
                            <img src="<?php echo $photo_url; ?>" alt="Foto profil <?php echo htmlspecialchars($agent['name']); ?>" class="w-20 h-20 rounded-full object-cover border-2 border-gray-100">
                        </div>
                        <div class="flex-grow">
                            <p class="text-xs text-gray-500 mb-0.5">ID: <?php echo htmlspecialchars($agent['id'] ?? 'N/A'); ?></p>
                            <h2 class="text-text-primary text-lg font-bold truncate leading-snug"><?php echo htmlspecialchars($agent['name']); ?></h2>
                            <p class="text-text-secondary text-sm truncate"><?php echo htmlspecialchars($agent['email'] ?? 'Email tidak tersedia'); ?></p>
                        </div>
                    </div>

                    <!-- Total Listing dan Tombol Aksi -->
                    <div class="border-t border-gray-100 pt-4 mt-4">
                        <p class="text-sm font-medium text-text-primary mb-3">Total Listing <span class="font-bold ml-1 text-xl"><?php echo htmlspecialchars($agent['total_deals'] ?? '0'); ?></span></p>

                        <div class="flex space-x-3">
                            <!-- Tombol Telepon (diubah menjadi link 'tel:') -->
                            <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $agent['phone_number'] ?? ''); ?>"
                               class="action-button flex-1 flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-lg border-2 border-primary-outline text-primary-outline hover:bg-primary-outline hover:text-white transition duration-200"
                               aria-label="Telepon <?php echo htmlspecialchars($agent['name']); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.772-1.549a1 1 0 011.06-.54l4.435.74A1 1 0 0118 16.847V18a1 1 0 01-1 1H3a1 1 0 01-1-1V3z" /></svg>
                                Telepon
                            </a>

                            <!-- Tombol Whatsapp (diubah menjadi link 'wa.me') -->
                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $agent['phone_number'] ?? ''); ?>" target="_blank"
                               class="action-button flex-1 flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-lg bg-primary-blue text-white hover:bg-blue-700 transition duration-200"
                               aria-label="Whatsapp <?php echo htmlspecialchars($agent['name']); ?>">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99 0-3.902-.539-5.57-1.528L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.447-4.435-9.884-9.888-9.884-5.448 0-9.886 4.434-9.889 9.885.002 2.024.603 3.962 1.725 5.613l-1.192 4.359 4.463-1.182zM15.251 12.11c-.328-.164-1.939-.958-2.24-1.066-.3-.107-.517-.164-.732.164-.215.328-.847 1.066-1.038 1.282-.19.216-.38.244-.732.082-.352-.164-1.48- .544-2.82-1.744-1.045-.958-1.748-2.13-1.939-2.49-.19-.36.0- .552.146-.708.13-.145.328-.36.492-.544.164-.184.216-.305.328-.517.112-.212.056-.381-.028-.545-.084-.164-.732-1.76-1.008-2.406-.268-.628-.544-.544-.732-.552-.18-.01-.38-.01-.58-.01-.19 0-.517.082-.783.381-.268.299-1.038 1.008-1.038 2.459 0 1.451 1.066 2.858 1.212 3.072.146.216 2.016 3.11 4.887 4.341 2.871 1.23 2.871.823 3.386.791.517-.03 1.939-.783 2.21-1.528.268-.745.268-1.39.184-1.528-.082-.139-.305-.217-.633-.38z"/></svg>
                                Whatsapp
                            </a>
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

<!-- Tombol Back to Top (Dipertahankan) -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-blue-800 text-white p-4 rounded-full shadow-lg transition-all duration-300 opacity-0 transform scale-0 hover:bg-blue-900">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Modal Detail Agen (Desain Diperbarui) -->
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
    const allAgentCards = agentContainer.querySelectorAll('.agent-card');
    const noResultsMessage = document.getElementById('no-results-message');

    function filterAgents() {
        const filterText = agentSearchInput.value.toLowerCase().trim();
        let resultsFound = false;

        allAgentCards.forEach(function(card) {
            const agentData = JSON.parse(card.getAttribute('data-agent'));
            const agentName = (agentData.name || '').toLowerCase();
            const agentEmail = (agentData.email || '').toLowerCase();
            const agentCompany = (agentData.company || '').toLowerCase();

            if (agentName.includes(filterText) || agentEmail.includes(filterText) || agentCompany.includes(filterText)) {
                card.style.display = 'block';
                resultsFound = true;
            } else {
                card.style.display = 'none';
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

    allAgentCards.forEach(card => {
        card.addEventListener('click', (e) => {
            if (e.target.closest('.action-button')) {
                return;
            }

            const agentData = JSON.parse(card.getAttribute('data-agent'));
            const photoPath = agentData.photo_path ? `../Uploads/agents/${agentData.photo_path}` : `https://placehold.co/128x128/1c7edc/ffffff?font=Inter&text=${agentData.name.charAt(0)}`;

            modalContent.innerHTML = `
                <div class="flex flex-col sm:flex-row items-stretch text-center sm:text-left rounded-xl overflow-hidden">
                    <!-- Kolom Kiri: Foto dan Statistik -->
                    <div class="w-full sm:w-1/3 bg-gray-100 p-6 flex flex-col items-center justify-center">
                        <img src="${photoPath}" alt="Foto Agen ${agentData.name}" class="w-32 h-32 rounded-full border-4 border-white shadow-xl object-cover mb-4">
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

