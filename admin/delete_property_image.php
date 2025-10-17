<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : 0;

if ($id && $property_id) {
    // Ambil nama file
    $stmt = $pdo->prepare("SELECT image_path FROM property_images WHERE id = ? AND property_id = ?");
    $stmt->execute([$id, $property_id]);
    $img = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($img) {
        // Hapus file fisik
        $file = $_SERVER['DOCUMENT_ROOT'] . "/LatuaGroup/uploads/properties/" . $img['image_path'];
        if (file_exists($file)) unlink($file);

        // Hapus dari database
        $pdo->prepare("DELETE FROM property_images WHERE id = ? AND property_id = ?")->execute([$id, $property_id]);
    }
}

header("Location: edit_property.php?id=$property_id");
exit;