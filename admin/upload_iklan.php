<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

$message = "";

// --- Hapus iklan ---
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("SELECT image_path FROM iklan WHERE id = ?");
    $stmt->execute([$id]);
    $iklan = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($iklan) {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . $iklan['image_path'];
        if (file_exists($filePath)) unlink($filePath);
        $pdo->prepare("DELETE FROM iklan WHERE id = ?")->execute([$id]);
        $message = "🗑️ Iklan berhasil dihapus!";
    }
}

// --- Upload iklan baru ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['iklan'])) {
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/LatuaGroup/uploads/iklan/";
    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

    $fileName = uniqid('iklan_') . '.' . pathinfo($_FILES['iklan']['name'], PATHINFO_EXTENSION);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['iklan']['tmp_name'], $targetFile)) {
        $stmt = $pdo->prepare("INSERT INTO iklan (image_path, uploaded_at) VALUES (?, NOW())");
        $stmt->execute(["/LatuaGroup/uploads/iklan/" . $fileName]);
        $message = "✅ Iklan berhasil diunggah!";
    } else {
        $message = "❌ Gagal mengunggah gambar.";
    }
}

// --- Ambil semua iklan ---
$stmt = $pdo->query("SELECT * FROM iklan ORDER BY uploaded_at DESC");
$iklans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Iklan - Admin</title>
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
        <a href="upload_iklan.php" class="block bg-white/20 rounded-md px-3 py-2">🪧 Iklan</a>
        <a href="feedbacks.php" class="block hover:text-gray-300">💬 Feedback User</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <h2 class="text-3xl font-semibold text-gray-800 mb-6">🪧 Kelola Iklan</h2>

      <!-- Notifikasi -->
      <?php if ($message): ?>
        <div class="mb-6 px-4 py-3 rounded-lg text-center font-semibold 
                    <?= str_contains($message, '✅') ? 'bg-green-100 text-green-700' : (str_contains($message, '🗑️') ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') ?>">
          <?= htmlspecialchars($message) ?>
        </div>
      <?php endif; ?>

      <!-- Upload Form -->
      <div class="bg-white shadow rounded-2xl p-6 mb-10 max-w-xl">
        <h3 class="text-xl font-bold text-gray-700 mb-4">Upload Iklan Baru</h3>

        <form method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
          <label class="font-medium text-gray-700">Pilih Gambar Iklan</label>
          <input type="file" name="iklan" id="iklanInput" accept="image/*" required
                 class="border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">

          <!-- Preview Gambar -->
          <div class="w-full h-56 border rounded-lg overflow-hidden hidden" id="previewContainer">
            <img id="previewImage" src="#" alt="Preview" class="w-full h-full object-cover">
          </div>

          <button type="submit"
                  class="bg-blue-900 text-white font-semibold rounded-lg py-2 hover:bg-blue-800 transition">
            Upload
          </button>
        </form>
      </div>

      <!-- Daftar Iklan -->
      <div class="bg-white rounded-2xl shadow-md p-6">
        <h3 class="text-xl font-bold mb-4 text-gray-800">📋 Daftar Iklan</h3>

        <?php if (count($iklans) > 0): ?>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($iklans as $i): ?>
              <div class="border rounded-xl overflow-hidden shadow-sm">
                <img src="<?= htmlspecialchars($i['image_path']) ?>" alt="Iklan" class="w-full h-40 object-cover">
                <div class="p-3 text-sm flex items-center justify-between">
                  <span class="text-gray-600"><?= date("d M Y", strtotime($i['uploaded_at'])) ?></span>
                  <a href="?delete=<?= $i['id'] ?>" class="text-red-600 hover:underline text-sm font-medium">Hapus</a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-gray-500 text-center py-4">Belum ada iklan yang diunggah.</p>
        <?php endif; ?>
      </div>
    </main>
  </div>

  <!-- Preview Gambar Script -->
  <script>
    document.getElementById("iklanInput").addEventListener("change", function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(evt) {
          const preview = document.getElementById("previewImage");
          preview.src = evt.target.result;
          document.getElementById("previewContainer").classList.remove("hidden");
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>
</html>
