<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';
$agents = $pdo->query("SELECT * FROM agents ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Agen</title>
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
        <a href="feedbacks.php" class="block hover:text-gray-300">💬 Feedback User</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <h1 class="text-2xl font-bold mb-6">Daftar Agen</h1>
      <a href="add_agent.php" class="mb-6 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Tambah Agen</a>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($agents as $a): ?>
          <div class="bg-white border rounded-2xl shadow-md p-6 flex flex-col items-center hover:shadow-lg transition">
            <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-blue-100">
              <img src="/LatuaGroup/uploads/agents/<?= htmlspecialchars($a['photo_path'] ?? 'default.jpg') ?>" 
                  class="w-full h-full object-cover">
            </div>
            <h3 class="text-lg font-semibold mt-3 text-gray-800"><?= htmlspecialchars($a['name']) ?></h3>
            <p class="text-gray-500 text-sm mt-1"><?= htmlspecialchars($a['phone_number']) ?></p>
            <p class="text-gray-500 text-sm"><?= htmlspecialchars($a['email']) ?></p>
            
            <div class="flex space-x-4 mt-4">
              <a href="edit_agent.php?id=<?= $a['id'] ?>" 
                class="text-blue-600 hover:bg-blue-50 px-3 py-1 rounded-md transition">Edit</a>
              <a href="delete_agent.php?id=<?= $a['id'] ?>" 
                onclick="return confirm('Hapus agen ini?')" 
                class="text-red-600 hover:bg-red-50 px-3 py-1 rounded-md transition">Hapus</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </main>
  </div>
</body>
</html>
