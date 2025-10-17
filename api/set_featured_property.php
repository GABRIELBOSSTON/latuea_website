<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

header('Content-Type: application/json');

// Pastikan method-nya POST dan ada ID
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'Permintaan tidak valid.']);
    exit;
}

$id = intval($_POST['id']);

// Reset semua properti (set 0)
$reset = $pdo->prepare("UPDATE properties SET is_featured = 0");
$reset->execute();

// Set properti terpilih menjadi featured (1)
$stmt = $pdo->prepare("UPDATE properties SET is_featured = 1 WHERE id = ?");
$success = $stmt->execute([$id]);

if ($success) {
    echo json_encode(['success' => true, 'message' => 'Properti berhasil dijadikan Project Terbaru.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data.']);
}
