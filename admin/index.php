<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// Hitung jumlah properti & agen
$total_properties = $pdo->query("SELECT COUNT(*) FROM properties")->fetchColumn();
$total_agents = $pdo->query("SELECT COUNT(*) FROM agents")->fetchColumn();

// Ambil daftar iklan terbaru
$iklans = $pdo->query("SELECT * FROM iklan ORDER BY uploaded_at DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Latuae Land</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
  <div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#0E1B4D] text-white p-6 space-y-6">
      <h1 class="text-2xl font-bold">Latuae Admin</h1>
      <nav class="space-y-4">
        <a href="index.php" class="block hover:text-gray-300">🏠 Dashboard</a>
        <a href="properties.php" class="block hover:text-gray-300">🏡 Properti</a>
        <a href="agents.php" class="block hover:text-gray-300">👨‍💼 Agen</a>
        <a href="upload_iklan.php" class="block hover:text-gray-300">🪧 Kelola Iklan</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <h2 class="text-3xl font-semibold text-gray-800 mb-6">Dashboard</h2>

      <!-- Statistik -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-xl font-bold text-gray-700">Total Properti</h3>
          <p class="text-4xl mt-4 text-blue-600"><?= $total_properties ?></p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
          <h3 class="text-xl font-bold text-gray-700">Total Agen</h3>
          <p class="text-4xl mt-4 text-green-600"><?= $total_agents ?></p>
        </div>
      </div>

      <!-- Upload Iklan -->
      <div class="bg-white rounded-lg shadow p-6 mb-10">
        <h3 class="text-xl font-bold text-gray-700 mb-4">🪧 Upload Iklan Baru</h3>

        <form action="upload_iklan.php" method="POST" enctype="multipart/form-data" class="space-y-4">
          <div>
            <label class="block text-gray-700 mb-2 font-medium">Pilih Gambar Iklan</label>
            <input type="file" name="image" accept="image/*" required
                   class="block w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
          </div>

          <button type="submit"
                  class="bg-blue-800 hover:bg-blue-900 text-white px-6 py-2 rounded-lg font-semibold transition">
            Upload Sekarang
          </button>
        </form>
      </div>

      <!-- Daftar Iklan Terbaru -->
      <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-700 mb-4">📸 Iklan Terbaru</h3>
        <?php if (count($iklans) > 0): ?>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php foreach ($iklans as $iklan): ?>
              <div class="border rounded-lg overflow-hidden shadow-sm">
                <img src="/LatuaGroup/uploads/iklan/<?= htmlspecialchars($iklan['image_path']) ?>"
                     alt="Iklan" class="w-full h-32 object-cover">
                <div class="p-2 text-sm text-gray-500 text-center">
                  <?= date('d M Y', strtotime($iklan['uploaded_at'])) ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-gray-500 text-sm">Belum ada iklan yang diunggah.</p>
        <?php endif; ?>
      </div>
    </main>
  </div>
</body>
</html>
