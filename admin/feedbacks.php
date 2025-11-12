<?php
require_once 'auth_check.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// --- Hapus feedback kalau ada parameter ?delete=id ---
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM feedback WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: feedbacks.php?deleted=1");
    exit;
}

// --- Ambil semua feedback dari database ---
$stmt = $pdo->query("SELECT * FROM feedback ORDER BY created_at DESC");
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Feedback User - Latuae Admin</title>
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
        <a href="feedbacks.php" class="block text-yellow-300 font-semibold">💬 Feedback User</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <h2 class="text-3xl font-semibold text-gray-800 mb-6">💬 Feedback dari Pengguna</h2>

      <?php if (isset($_GET['deleted'])): ?>
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
          ✅ Feedback berhasil dihapus.
        </div>
      <?php endif; ?>

      <div class="bg-white rounded-lg shadow p-6">
        <?php if (count($feedbacks) > 0): ?>
          <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg">
              <thead class="bg-blue-800 text-white">
                <tr>
                  <th class="py-3 px-4 text-left">Nama</th>
                  <th class="py-3 px-4 text-left">Email</th>
                  <th class="py-3 px-4 text-left">Pesan</th>
                  <th class="py-3 px-4 text-left">Tanggal</th>
                  <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <?php foreach ($feedbacks as $f): ?>
                  <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 font-medium">
                      <?= htmlspecialchars($f['first_name'] . ' ' . $f['last_name']) ?>
                    </td>
                    <td class="py-3 px-4"><?= htmlspecialchars($f['email']) ?></td>
                    <td class="py-3 px-4"><?= nl2br(htmlspecialchars($f['message'])) ?></td>
                    <td class="py-3 px-4 text-gray-500"><?= date('d M Y H:i', strtotime($f['created_at'])) ?></td>
                    <td class="py-3 px-4 text-center">
                      <a href="feedbacks.php?delete=<?= $f['id'] ?>"
                         onclick="return confirm('Yakin ingin menghapus feedback ini?')"
                         class="text-red-600 hover:text-red-800 font-semibold">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <p class="text-gray-500 text-center py-6">Belum ada feedback dari user.</p>
        <?php endif; ?>
      </div>
    </main>
  </div>
</body>
</html>
