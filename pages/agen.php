<?php
require __DIR__ . '/../includes/db_connect.php';
require __DIR__ . '/../includes/header.php';

// Fetch agents from database with additional mock data for demonstration
$agents = [];
try {
    $stmt_agents = $pdo->query("SELECT * FROM agents ORDER BY name ASC");
    $agents = $stmt_agents->fetchAll(PDO::FETCH_ASSOC);

    // Add mock data for demonstration purposes. In a real app, this data would come from the database.
    foreach ($agents as $key => $agent) {
        $agents[$key]['specialty_area'] = 'Real Estat Komersial'; // Example
        $agents[$key]['is_verified'] = $key % 2 === 0; // Example: alternate verified agents
        $agents[$key]['rating'] = rand(40, 50) / 10; // Example: random rating
        $agents[$key]['total_deals'] = rand(10, 50); // Example: random deal count
    }
} catch (PDOException $e) {
    $agents = [];
    error_log("Error fetching agents: " . $e->getMessage());
    echo "<div class='container mx-auto px-4 py-6'><p class='text-red-600'>Terjadi kesalahan saat mengambil data agen.</p></div>";
}

// Select a few agents to be "featured"
$featured_agents = array_slice($agents, 0, 3);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Agen - Latuae Land</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .agent-card:hover .chat-button {
            transform: translateY(-4px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
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
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Header Section with a more modern search bar -->
<header class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-12 px-5 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-3 animate-fadeInUp">Temukan Agen Impian Anda</h1>
        <p class="text-lg sm:text-xl text-blue-200 mb-8 animate-fadeInUp" style="animation-delay: 0.2s;">Jelajahi profesional properti terbaik di wilayah Anda.</p>
        <div class="relative w-full max-w-xl mx-auto animate-fadeInUp" style="animation-delay: 0.4s;">
            <input type="text" placeholder="Cari agen, area, kantor…" id="agent-search"
                   class="w-full px-6 py-4 rounded-full border-2 border-transparent focus:outline-none focus:ring-4 focus:ring-blue-600 focus:border-blue-700 transition-all duration-300 shadow-xl text-gray-800">
            <button id="search-button" class="absolute right-2 top-1/2 -translate-y-1/2 px-5 py-2 rounded-full bg-green-600 text-white font-semibold hover:bg-green-700 transition-colors">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
    <!-- Featured Agents Section -->
    <?php if (!empty($featured_agents)): ?>
    <section class="mb-12 animate-fadeInUp">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b-2 border-blue-700 pb-2">Agen Pilihan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($featured_agents as $agent): ?>
            <div class="agent-card bg-white rounded-3xl shadow-xl p-8 text-center border-t-4 border-yellow-400 hover:scale-[1.02] hover:shadow-2xl transition-transform duration-300 ease-in-out cursor-pointer" data-agent='<?php echo json_encode($agent); ?>'>
                <div class="relative w-40 h-40 mx-auto mb-6 rounded-full overflow-hidden border-4 border-blue-700 shadow-md">
                    <?php if (isset($agent['photo_path']) && file_exists(__DIR__ . '/../Uploads/agents/' . $agent['photo_path'])): ?>
                        <img src="../Uploads/agents/<?php echo htmlspecialchars($agent['photo_path']); ?>" alt="Foto Agen <?php echo htmlspecialchars($agent['name']); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                            <i class="fas fa-user-circle text-7xl text-blue-900"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <h3 class="text-2xl font-bold text-blue-900 mb-1"><?php echo htmlspecialchars($agent['name']); ?></h3>
                <p class="text-sm text-gray-600 mb-2"><?php echo htmlspecialchars($agent['company'] ?? 'Tidak tersedia'); ?></p>
                <div class="flex justify-center items-center gap-4 text-sm text-gray-500 mb-4">
                    <span><i class="fas fa-star text-yellow-400"></i> <?php echo htmlspecialchars($agent['rating'] ?? '4.5'); ?></span>
                    <span><i class="fas fa-handshake text-blue-700"></i> <?php echo htmlspecialchars($agent['total_deals'] ?? '20'); ?> Transaksi</span>
                </div>
                <button class="bg-blue-700 text-white rounded-full px-6 py-3 font-semibold hover:bg-blue-800 transition-colors mt-4 show-details-button">
                    Lihat Detail
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>
    
    <!-- Message for no search results -->
    <div id="no-results-message" class="hidden text-center text-gray-600 mt-10">
        <i class="fas fa-info-circle text-3xl mb-4 text-blue-700"></i>
        <p class="text-lg">Mohon maaf, tidak ada agen yang cocok dengan pencarian Anda.</p>
    </div>
</main>

<!-- Floating Back to Top Button (New!) -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-blue-800 text-white p-4 rounded-full shadow-lg transition-all duration-300 opacity-0 transform scale-0 hover:bg-blue-900">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Agent Details Modal (New!) -->
<div id="agent-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-lg relative animate-fadeInUp">
        <button id="close-modal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-xl">
            <i class="fas fa-times-circle"></i>
        </button>
        <div id="modal-content" class="text-center">
            <!-- Content will be injected here by JavaScript -->
        </div>
    </div>
</div>

<!-- Footer -->
<?php include '../includes/footer.php'; ?>

<script>
    // Real-time filter agents by name, company, or specialty area
    const agentSearchInput = document.getElementById('agent-search');
    const agentCards = document.querySelectorAll('.agent-card');
    const noResultsMessage = document.getElementById('no-results-message');

    function filterAgents() {
        const filterText = agentSearchInput.value.toLowerCase();
        let resultsFound = false;
        
        agentCards.forEach(function(card) {
            const agentData = JSON.parse(card.getAttribute('data-agent'));
            const agentName = agentData.name.toLowerCase();
            const agentCompany = (agentData.company || '').toLowerCase();
            const agentSpecialty = (agentData.specialty_area || '').toLowerCase();
            
            if (agentName.includes(filterText) || agentCompany.includes(filterText) || agentSpecialty.includes(filterText)) {
                card.style.display = 'block';
                resultsFound = true;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (resultsFound) {
            noResultsMessage.classList.add('hidden');
        } else {
            noResultsMessage.classList.remove('hidden');
        }
    }

    // Agent Details Modal Logic
    const agentModal = document.getElementById('agent-modal');
    const closeModalButton = document.getElementById('close-modal');
    const modalContent = document.getElementById('modal-content');

    agentCards.forEach(card => {
        card.addEventListener('click', () => {
            const agentData = JSON.parse(card.getAttribute('data-agent'));
            
            const photoPath = agentData.photo_path ? `../Uploads/agents/${agentData.photo_path}` : 'https://dummyimage.com/160x160/cbd5e1/1a202c&text=L'; // Placeholder if no photo
            
            modalContent.innerHTML = `
                <div class="mb-4">
                    <img src="${photoPath}" alt="Foto Agen ${agentData.name}" class="w-32 h-32 rounded-full mx-auto border-4 border-blue-700 shadow-lg object-cover">
                </div>
                <h3 class="text-3xl font-bold text-blue-900 mb-1">${agentData.name}</h3>
                <p class="text-lg text-gray-600 mb-2">${agentData.company || 'Tidak tersedia'}</p>
                <div class="flex flex-col items-center justify-center space-y-2 text-md text-gray-700">
                    <span><i class="fas fa-briefcase text-blue-700 mr-2"></i> ${agentData.specialty_area || 'Spesialisasi: Tidak diketahui'}</span>
                    <span><i class="fas fa-star text-yellow-400 mr-2"></i> ${agentData.rating || '4.5'} Rating</span>
                    <span><i class="fas fa-handshake text-green-700 mr-2"></i> ${agentData.total_deals || '20'} Transaksi</span>
                    <span><i class="fas fa-phone-alt text-gray-700 mr-2"></i> ${agentData.phone_number}</span>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row items-center justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="https://wa.me/${agentData.phone_number.replace(/[^0-9]/g, '')}" target="_blank"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-500 text-white rounded-full font-bold text-base hover:bg-green-600 transition-transform duration-300 shadow-md">
                        <i class="fab fa-whatsapp text-lg"></i> Chat WhatsApp
                    </a>
                    <a href="tel:${agentData.phone_number.replace(/[^0-9]/g, '')}"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-700 text-white rounded-full font-bold text-base hover:bg-blue-800 transition-colors duration-300 shadow-md">
                        <i class="fas fa-phone-alt text-lg"></i> Telepon
                    </a>
                </div>
            `;
            agentModal.classList.remove('hidden');
        });
    });

    closeModalButton.addEventListener('click', () => {
        agentModal.classList.add('hidden');
    });

    // Close modal when clicking outside
    agentModal.addEventListener('click', (e) => {
        if (e.target.id === 'agent-modal') {
            agentModal.classList.add('hidden');
        }
    });

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

    // Event listener for real-time search on input
    agentSearchInput.addEventListener('keyup', filterAgents);
    
    // Event listener for search button click (also triggers filter)
    document.getElementById('search-button').addEventListener('click', filterAgents);
</script>

</body>
</html>
