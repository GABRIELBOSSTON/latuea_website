<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// Ambil ID property dari URL
$property_id = $_GET['id'] ?? null;
if (!$property_id) {
    die("Property tidak ditemukan.");
}

// 🔹 Ambil data property + agen (pakai agent_id)
$stmt = $pdo->prepare("
  SELECT 
      p.*, 
      a.name AS agent_name, 
      a.phone_number, 
      a.email, 
      a.photo_path
  FROM properties p
  LEFT JOIN agents a ON p.agent_id = a.id
  WHERE p.id = ?
");
$stmt->execute([$property_id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    die("Property tidak ditemukan.");
}

// 🔹 Ambil semua gambar properti (utama dulu)
$stmtImg = $pdo->prepare("
    SELECT id, image_path, is_main 
    FROM property_images 
    WHERE property_id = ? 
    ORDER BY is_main DESC, id ASC
");
$stmtImg->execute([$property_id]);
$images = $stmtImg->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../includes/header.php'; ?>

<div class="max-w-[1100px] mx-auto px-4">

  <!-- Back Button -->
  <div class="py-4">
    <a href="javascript:history.back()" class="text-sm text-gray-500 hover:text-blue-600">← Kembali</a>
  </div>

  <!-- Gambar + Card Agen -->
  <div class="flex flex-col lg:flex-row gap-6">
    <!-- Galeri Properti -->
    <div class="flex-1">
      <div class="grid grid-cols-[4fr_1.2fr] gap-8 h-[540px]">
        <!-- Gambar utama -->
        <div class="h-full overflow-hidden rounded-[45px_0_0_45px]">
          <?php if (!empty($images[0]['image_path'])): ?>
            <div class="w-full h-full bg-center bg-cover"
                 style="background-image:url('/LatuaGroup/uploads/properties/<?= htmlspecialchars($images[0]['image_path']) ?>')"></div>
          <?php else: ?>
            <div class="w-full h-full bg-gray-300"></div>
          <?php endif; ?>
        </div>

        <!-- Thumbnail -->
        <div class="grid grid-rows-3 gap-8 h-full">
          <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="overflow-hidden <?= $i === 1 ? 'rounded-tr-[45px]' : '' ?> <?= $i === 3 ? 'rounded-br-[45px]' : '' ?>">
              <?php if (!empty($images[$i]['image_path'])): ?>
                <div class="w-full h-full bg-center bg-cover"
                     style="background-image:url('/LatuaGroup/uploads/properties/<?= htmlspecialchars($images[$i]['image_path']) ?>')"></div>
              <?php else: ?>
                <div class="w-full h-full bg-gray-300"></div>
              <?php endif; ?>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>

    <!-- 🔹 Kartu Agen -->
    <div class="w-[280px] bg-white rounded-2xl shadow-lg border border-gray-200 p-6 flex flex-col items-center text-center">
      <?php if (!empty($property['photo_path']) && file_exists($_SERVER['DOCUMENT_ROOT'] . "/LatuaGroup/Uploads/agents/" . $property['photo_path'])): ?>
        <img src="/LatuaGroup/Uploads/agents/<?= htmlspecialchars($property['photo_path']) ?>" 
             alt="<?= htmlspecialchars($property['agent_name']) ?>" 
             class="w-24 h-24 rounded-full object-cover border-4 border-blue-700 shadow-md mb-3">
      <?php else: ?>
        <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 mb-3">
          <i class="fas fa-user text-4xl"></i>
        </div>
      <?php endif; ?>

      <h3 class="font-bold text-lg text-blue-900 mb-1"><?= htmlspecialchars($property['agent_name'] ?? 'Agen Tidak Diketahui') ?></h3>

      <p class="text-gray-700 text-sm mb-1"><i class="fas fa-phone-alt mr-2"></i><?= htmlspecialchars($property['phone_number'] ?? '-') ?></p>
      <p class="text-gray-700 text-sm mb-3"><i class="fas fa-envelope mr-2"></i><?= htmlspecialchars($property['email'] ?? '-') ?></p>

      <div class="flex gap-2 justify-center">
        <?php if (!empty($property['phone_number'])): ?>
          <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $property['phone_number']) ?>" target="_blank" 
             class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm flex items-center gap-2 shadow">
             <i class="fab fa-whatsapp"></i> WA
          </a>
          <a href="tel:<?= preg_replace('/[^0-9]/', '', $property['phone_number']) ?>" 
             class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-full text-sm flex items-center gap-2 shadow">
             <i class="fas fa-phone-alt"></i> Telp
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Info Properti -->
  <div class="w-[900px] ml-10 mt-6 space-y-2">
    <h2 class="text-3xl font-bold text-gray-900">
      Rp <?= number_format($property['price'], 0, ',', '.') ?>
      <span class="ml-2 text-lg font-medium text-gray-500">
        <?= $property['property_type'] === 'for_sale' ? "JUAL" : "SEWA" ?>
      </span>
    </h2>
    <h1 class="text-2xl font-semibold text-blue-700"><?= htmlspecialchars($property['title']) ?></h1>
    <p class="text-gray-500 text-lg"><?= htmlspecialchars($property['regency']) ?>, <?= htmlspecialchars($property['province']) ?></p>
    <p class="text-sm text-gray-400">Diposting pada: <?= date("j F Y", strtotime($property['created_at'])) ?></p>
  </div>

  <!-- Deskripsi -->
  <div class="w-[900px] ml-10 py-6 mt-10">
    <div class="border-b-4 border-black mb-4"></div>
    <h2 class="text-3xl font-bold mb-4">Deskripsi</h2>
    <div class="text-gray-800 leading-relaxed text-base whitespace-pre-line">
      <?= nl2br(htmlspecialchars($property['description'])) ?>
    </div>
  </div>

  <!-- Fasilitas -->
  <div class="w-[900px] ml-10 mt-8 mb-16">
    <h2 class="text-2xl font-bold mb-4">Fasilitas</h2>
    <div class="space-y-2 text-gray-700 leading-relaxed">
      <?php if (!empty($property['facilities'])): ?>
        <?php foreach (explode(',', $property['facilities']) as $f): ?>
          <div class="flex items-center gap-2">
            <span class="w-2 h-2 bg-green-600 rounded-full"></span>
            <span><?= htmlspecialchars(trim($f)) ?></span>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-gray-500">Tidak ada fasilitas yang ditambahkan.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>
