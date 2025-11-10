<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Ambil user dari database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) { // bisa diganti password_verify kalau pakai hash
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: /LatuaGroup/admin/index.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin - Latuae Land</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white shadow-lg rounded-xl p-8 w-96">
    <h2 class="text-2xl font-bold text-center text-blue-800 mb-6">Login Admin</h2>
    <?php if ($error): ?>
      <p class="text-red-500 text-sm mb-4 text-center"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
      <div>
        <label class="block mb-1 text-gray-700">Username</label>
        <input type="text" name="username" required class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
      </div>
      <div>
        <label class="block mb-1 text-gray-700">Password</label>
        <input type="password" name="password" required class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
      </div>
      <button type="submit" class="w-full bg-blue-800 hover:bg-blue-900 text-white py-2 rounded-lg font-semibold transition">
        Login
      </button>
    </form>
  </div>
</body>
</html>
