<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// Ambil semua properti dan cover image-nya
$stmt = $pdo->query("
    SELECT p.id, p.title, p.price, p.province, p.regency, p.property_type, p.is_featured,
           COALESCE(
               (SELECT pi.image_path 
                FROM property_images pi 
                WHERE pi.property_id = p.id AND pi.is_main = 1 
                LIMIT 1),
               (SELECT pi2.image_path 
                FROM property_images pi2 
                WHERE pi2.property_id = p.id 
                ORDER BY pi2.id ASC 
                LIMIT 1)
           ) AS main_image_path
    FROM properties p
    ORDER BY p.created_at DESC
");
$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Properti - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .fade-in {
      animation: fadeIn 0.4s ease-in-out forwards;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body class="bg-gray-100 font-sans">
  <div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#0E1B4D] text-white p-6 space-y-6">
      <h1 class="text-2xl font-bold">Latuae Admin</h1>
      <nav class="space-y-4">
        <a href="index.php" class="block hover:text-gray-300">🏠 Dashboard</a>
        <a href="properties.php" class="block hover:text-gray-300 font-semibold text-blue-200">🏡 Properti</a>
        <a href="agents.php" class="block hover:text-gray-300">👨‍💼 Agen</a>
        <a href="upload_iklan.php" class="block hover:text-gray-300">🪧 Kelola Iklan</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Properti</h1>
        <a href="add_property.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          + Tambah Properti
        </a>
      </div>
      
      <table class="w-full bg-white shadow rounded fade-in">
        <thead>
          <tr class="bg-gray-100 border-b">
            <th class="p-3 text-left">Gambar</th>
            <th class="p-3 text-left">Judul</th>
            <th class="p-3 text-left">Harga</th>
            <th class="p-3 text-left">Lokasi</th>
            <th class="p-3 text-left">Tipe</th>
            <th class="p-3 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($properties as $p): ?>
            <tr class="border-t hover:bg-gray-50 transition">
              <td class="p-3">
                <img 
                  src="/LatuaGroup/uploads/properties/<?= $p['main_image_path'] ?: 'default.jpg' ?>" 
                  alt="<?= htmlspecialchars($p['title']) ?>" 
                  class="w-20 h-16 object-cover rounded shadow-sm"
                >
              </td>
              <td class="p-3 font-medium text-gray-700"><?= htmlspecialchars($p['title']) ?></td>
              <td class="p-3 font-semibold text-gray-800">
                Rp <?= number_format($p['price'], 0, ',', '.') ?>
              </td>
              <td class="p-3 text-gray-600">
                <?= htmlspecialchars($p['regency']) ?>, <?= htmlspecialchars($p['province']) ?>
              </td>
              <td class="p-3">
                <span class="px-2 py-1 text-xs rounded-full text-white 
                  <?= $p['property_type'] === 'for_sale' ? 'bg-blue-700' : 'bg-emerald-600' ?>">
                  <?= $p['property_type'] === 'for_sale' ? 'Dijual' : 'Disewa' ?>
                </span>
              </td>
              <td class="p-3 space-x-2">
                <a href="edit_property.php?id=<?= $p['id'] ?>" 
                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                   Edit
                </a>
                <a href="delete_property.php?id=<?= $p['id'] ?>" 
                   onclick="return confirm('Yakin hapus properti ini?')" 
                   class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                   Hapus
                </a>
                <button 
                  id="featured-btn-<?= $p['id'] ?>"
                  onclick="setFeatured(<?= $p['id'] ?>)" 
                  class="px-3 py-1 rounded text-white transition <?= $p['is_featured'] ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-700 hover:bg-blue-800' ?>"
                >
                  <?= $p['is_featured'] ? '✅ Ditampilkan' : 'Tampilkan' ?>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </main>
  </div>

  <!-- Notifikasi Kecil -->
  <div id="toast" class="hidden fixed bottom-6 right-6 bg-green-600 text-white px-4 py-2 rounded shadow-lg"></div>

  <script>
  function showToast(msg, color = 'green') {
    const toast = document.getElementById('toast');
    toast.textContent = msg;
    toast.className = `fixed bottom-6 right-6 bg-${color}-600 text-white px-4 py-2 rounded shadow-lg fade-in`;
    setTimeout(() => toast.classList.add('hidden'), 3000);
  }

  function setFeatured(id) {
    fetch('/LatuaGroup/api/set_featured_property.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'id=' + id
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        // Update tampilan tombol tanpa reload
        document.querySelectorAll('[id^="featured-btn-"]').forEach(btn => {
          btn.textContent = 'Tampilkan';
          btn.classList.remove('bg-green-600', 'hover:bg-green-700');
          btn.classList.add('bg-blue-700', 'hover:bg-blue-800');
        });

        const btn = document.getElementById('featured-btn-' + id);
        btn.textContent = '✅ Ditampilkan';
        btn.classList.remove('bg-blue-700', 'hover:bg-blue-800');
        btn.classList.add('bg-green-600', 'hover:bg-green-700');

        showToast('Properti berhasil dijadikan Project Terbaru!');
      } else {
        showToast('Gagal memperbarui properti', 'red');
      }
    })
    .catch(err => {
      console.error(err);
      showToast('Terjadi kesalahan koneksi', 'red');
    });
  }
  </script>
</body>
</html>
