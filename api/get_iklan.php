<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// Ambil iklan terbaru
$stmt = $pdo->query("SELECT image_path FROM iklan ORDER BY uploaded_at DESC LIMIT 1");
$iklan = $stmt->fetch(PDO::FETCH_ASSOC);

// Return hasil dalam format JSON
header('Content-Type: application/json');

if ($iklan && !empty($iklan['image_path'])) {
    echo json_encode([
        "status" => "success",
        "image_path" => $iklan['image_path']
    ]);
} else {
    echo json_encode([
        "status" => "empty",
        "image_path" => ""
    ]);
}
