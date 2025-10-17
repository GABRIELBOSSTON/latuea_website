<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';
header('Content-Type: application/json');

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$type = isset($_GET['type']) ? trim($_GET['type']) : '';
$propertyKind = isset($_GET['property']) ? trim($_GET['property']) : '';
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : 'cheap';

$sql = "
    SELECT 
        p.id, p.title, p.price, p.province, p.regency, p.property_type, p.property_kind, p.description,
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
    WHERE 1
";

$params = [];

// 🔍 Filter pencarian
if ($q !== '') {
    $sql .= " AND (p.title LIKE ? OR p.regency LIKE ? OR p.province LIKE ?)";
    $params[] = "%$q%";
    $params[] = "%$q%";
    $params[] = "%$q%";
}

if ($type !== '') {
    $sql .= " AND p.property_type = ?";
    $params[] = $type;
}

if ($propertyKind !== '') {
    $sql .= " AND p.property_kind = ?";
    $params[] = $propertyKind;
}

// 🔽 Urutkan berdasar harga
switch ($sort) {
    case 'expensive':
        $sql .= " ORDER BY p.price DESC";
        break;
    default: // cheap
        $sql .= " ORDER BY p.price ASC";
        break;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Format path gambar
foreach ($properties as &$p) {
    $p['image_url'] = $p['image_url']
        ? "/LatuaGroup/uploads/properties/" . $p['image_url']
        : "/LatuaGroup/uploads/properties/default.jpg";
}

echo json_encode($properties);
