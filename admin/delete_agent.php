<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// Pastikan ada parameter ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID agen tidak valid.");
}

$agentId = intval($_GET['id']);

try {
    // 🔹 Cek apakah agen masih dipakai di properti (supaya tidak rusak relasi)
    $check = $pdo->prepare("SELECT COUNT(*) FROM properties WHERE agent_id = ?");
    $check->execute([$agentId]);
    $used = $check->fetchColumn();

    if ($used > 0) {
        echo "<script>
            alert('Agen ini masih terhubung dengan beberapa properti dan tidak bisa dihapus.');
            window.location.href = 'agents.php';
        </script>";
        exit;
    }

    // 🔹 Ambil path foto untuk hapus file fisik
    $stmt = $pdo->prepare("SELECT photo_path FROM agents WHERE id = ?");
    $stmt->execute([$agentId]);
    $agent = $stmt->fetch(PDO::FETCH_ASSOC);

    // 🔹 Hapus agen dari database
    $delete = $pdo->prepare("DELETE FROM agents WHERE id = ?");
    $delete->execute([$agentId]);

    // 🔹 Hapus file foto jika ada
    if (!empty($agent['photo_path'])) {
        $photoPath = $_SERVER['DOCUMENT_ROOT'] . "/LatuaGroup/uploads/agents/" . $agent['photo_path'];
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }

    // 🔹 Redirect kembali ke agents.php
    header("Location: agents.php?deleted=1");
    exit;
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
