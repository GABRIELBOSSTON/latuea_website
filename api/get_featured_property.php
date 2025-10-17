<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';
header('Content-Type: application/json');

// Ambil properti yang dijadikan Project Terbaru
$stmt = $pdo->query("
    SELECT p.id, p.title, p.price, p.province, p.regency, p.property_type, p.description,
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
           ) AS image_url
    FROM properties p
    WHERE p.is_featured = 1
    LIMIT 1
");

$property = $stmt->fetch(PDO::FETCH_ASSOC);

if ($property) {
    $property['image_url'] = $property['image_url'] 
        ? "/LatuaGroup/uploads/properties/" . $property['image_url']
        : "/LatuaGroup/uploads/default.jpg";
    echo json_encode([$property]);
} else {
    echo json_encode([]);
}
