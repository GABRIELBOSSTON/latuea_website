<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// Ambil ID property dari URL
$property_id = $_GET['id'] ?? null;

if (!$property_id) {
    die("Property tidak ditemukan.");
}

// Ambil data property + agen
$stmt = $pdo->prepare("
    SELECT p.*, a.name AS agent_name, a.phone_number, a.email, a.photo_path,
           GROUP_CONCAT(pi.image_path) AS images
    FROM properties p
    LEFT JOIN agents a ON p.agent_id = a.id
    LEFT JOIN property_images pi ON p.id = pi.property_id
    WHERE p.id = ?
    GROUP BY p.id
");
$stmt->execute([$property_id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    die("Property tidak ditemukan.");
}

$images = $property['images'] ? explode(',', $property['images']) : ['default.jpg'];
?>

<?php include '../includes/header.php'; ?>

<!-- Back Button -->
<div class="max-w-7xl mx-auto py-4">
  <a href="index.php" class="text-sm text-gray-500 hover:text-blue-600">← Kembali ke pencarian</a>
</div>

<!-- Property Content -->
<div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 px-4">

  <!-- Gambar + Detail -->
  <div class="lg:col-span-2 space-y-6">
    <!-- Gambar utama + thumbnail -->
    <div class="grid grid-cols-3 gap-4">
      <img src="/LatuaGroup/uploads/properties/<?= $images[0] ?>" 
           class="col-span-2 w-full h-80 object-cover rounded-lg shadow-lg transition-all duration-500 ease-in-out transform hover:scale-110">
      <div class="space-y-2">
        <?php foreach (array_slice($images, 1, 3) as $img): ?>
          <img src="/LatuaGroup/uploads/properties/<?= $img ?>" 
               class="w-full h-24 object-cover rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Info Properti -->
    <div class="mt-6">
      <h2 class="text-4xl font-semibold text-blue-600 flex items-center space-x-2">
        <i class="fas fa-dollar-sign text-2xl"></i> 
        <span>Rp <?= number_format($property['price'], 0, ',', '.') ?> 
        <?= $property['property_type'] === 'for_sale' ? "Jual" : "Sewa" ?></span>
      </h2>
      <h1 class="text-3xl text-gray-900 font-bold"><?= htmlspecialchars($property['title']) ?></h1>
      <p class="text-gray-500 text-lg"><?= htmlspecialchars($property['regency']) ?>, <?= htmlspecialchars($property['province']) ?></p>
      <p class="text-sm text-gray-400 mt-2">Diposting pada: <?= date("j F Y", strtotime($property['created_at'])) ?></p>
    </div>

    <!-- Deskripsi -->
    <div class="mt-6">
      <h3 class="text-2xl font-semibold text-gray-900 mb-3">Deskripsi</h3>
      <p class="text-gray-700 text-lg"><?= nl2br(htmlspecialchars($property['description'])) ?></p>
    </div>

    <!-- Fasilitas -->
    <div class="mt-6">
      <h3 class="text-2xl font-semibold text-gray-900 mb-4">Fasilitas</h3>
      <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
        <div class="flex items-center space-x-2">
          <i class="fas fa-shield-alt text-green-600 text-3xl"></i>
          <p class="text-gray-700">Keamanan 24 jam</p>
        </div>
        <div class="flex items-center space-x-2">
          <i class="fas fa-wifi text-blue-600 text-3xl"></i>
          <p class="text-gray-700">Wi-Fi Gratis</p>
        </div>
        <div class="flex items-center space-x-2">
          <i class="fas fa-swimmer text-indigo-600 text-3xl"></i>
          <p class="text-gray-700">Kolam Renang</p>
        </div>
        <div class="flex items-center space-x-2">
          <i class="fas fa-dumbbell text-red-600 text-3xl"></i>
          <p class="text-gray-700">Gym</p>
        </div>
        <div class="flex items-center space-x-2">
          <i class="fas fa-parking text-gray-600 text-3xl"></i>
          <p class="text-gray-700">Area Parkir</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Agent Card -->
  <aside class="bg-white shadow-lg rounded-lg p-6 text-center border-2 border-gray-200 mt-6 lg:mt-0">
    <img src="/LatuaGroup/uploads/agents/<?= htmlspecialchars($property['photo_path'] ?? 'default.jpg') ?>" 
         class="w-24 h-24 mx-auto rounded-full object-cover shadow-lg mb-4">
    <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($property['agent_name'] ?? 'Tidak ada agen') ?></h3>
    <p class="text-gray-500 text-sm"><?= htmlspecialchars($property['phone_number'] ?? '-') ?></p>
    <p class="text-gray-500 text-sm"><?= htmlspecialchars($property['email'] ?? '-') ?></p>
    <div class="mt-4 space-x-2">
      <a href="tel:<?= $property['phone_number'] ?>" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
        📞 Hubungi
      </a>
      <a href="mailto:<?= $property['email'] ?>" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        ✉ Kirim Email
      </a>
    </div>
  </aside>
</div>

<?php include '../includes/footer.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>
