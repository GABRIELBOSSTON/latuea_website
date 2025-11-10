<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// Ambil ID agen
$id = $_GET['id'] ?? null;
if (!$id) {
  die("ID agen tidak ditemukan.");
}

// Ambil data agen
$stmt = $pdo->prepare("SELECT * FROM agents WHERE id = ?");
$stmt->execute([$id]);
$agent = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$agent) {
  die("Agen tidak ditemukan.");
}

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  // Jika admin upload foto baru
  $new_photo = $agent['photo_path'];
  if (!empty($_FILES['photo']['name'])) {
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/uploads/agents/';
    if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

    // Hapus foto lama jika ada
    if ($agent['photo_path'] && file_exists($upload_dir . $agent['photo_path'])) {
      unlink($upload_dir . $agent['photo_path']);
    }

    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $new_photo_name = time() . '_agent_' . uniqid() . '.' . $ext;
    $target_file = $upload_dir . $new_photo_name;
    move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);
    $new_photo = $new_photo_name;
  }

  // Update ke database
  $stmt = $pdo->prepare("UPDATE agents SET name = ?, email = ?, phone_number = ?, photo_path = ? WHERE id = ?");
  $stmt->execute([$name, $email, $phone, $new_photo, $id]);

  header("Location: agents.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Agen - Latuae Land</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
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

    <!-- Form Edit -->
    <main class="flex-1 p-8">
      <h2 class="text-2xl font-bold mb-6">Edit Agen</h2>

      <form method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-lg">
        <div class="mb-4">
          <label class="block font-medium mb-1">Nama Agen</label>
          <input type="text" name="name" value="<?= htmlspecialchars($agent['name']) ?>" required
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
          <label class="block font-medium mb-1">Email</label>
          <input type="email" name="email" value="<?= htmlspecialchars($agent['email']) ?>" required
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
          <label class="block font-medium mb-1">Nomor Telepon</label>
          <input type="text" name="phone" value="<?= htmlspecialchars($agent['phone_number']) ?>" required
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
          <label class="block font-medium mb-1">Foto Agen</label>
          <?php if ($agent['photo_path']): ?>
            <img src="/LatuaGroup/uploads/agents/<?= htmlspecialchars($agent['photo_path']) ?>" 
                 alt="Foto Agen" class="w-24 h-24 rounded-full object-cover mb-3">
          <?php endif; ?>
          <input type="file" name="photo" accept="image/*" class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
        </div>

        <div class="flex justify-between mt-6">
          <a href="agents.php" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
          <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">Simpan Perubahan</button>
        </div>
      </form>
    </main>
  </div>
</body>
</html>
