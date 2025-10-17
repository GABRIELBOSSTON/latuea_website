<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['province_id'])) {
  echo json_encode([]);
  exit;
}

$provinceId = intval($_GET['province_id']);
$stmt = $pdo->prepare("SELECT name FROM regencies WHERE province_id = ? ORDER BY name ASC");
$stmt->execute([$provinceId]);
$regencies = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($regencies);
?>
