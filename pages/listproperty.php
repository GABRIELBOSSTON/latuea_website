<?php
// Prevent caching
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// Ambil parameter pencarian dari URL
$q = $_GET['q'] ?? '';
$type = $_GET['type'] ?? '';
$propertyKind = $_GET['property'] ?? '';
$sort = $_GET['sort'] ?? 'cheap'; // default sort: harga termurah

// Bangun query dinamis
$sql = "
    SELECT 
        p.id, p.title, p.price, p.province, p.regency, p.property_type, p.property_kind, p.description,
        COALESCE(
            (SELECT pi.image_path FROM property_images pi WHERE pi.property_id = p.id AND pi.is_main = 1 LIMIT 1),
            (SELECT pi2.image_path FROM property_images pi2 WHERE pi2.property_id = p.id ORDER BY pi2.id ASC LIMIT 1),
            'default.jpg'
        ) AS main_image_path
    FROM properties p
    WHERE 1
";

$params = [];

// Filter pencarian teks (judul/lokasi)
if (!empty($q)) {
    $sql .= " AND (p.title LIKE ? OR p.regency LIKE ? OR p.province LIKE ?)";
    $params[] = "%$q%";
    $params[] = "%$q%";
    $params[] = "%$q%";
}

// Filter tipe properti (jual/sewa)
if (!empty($type)) {
    $sql .= " AND p.property_type = ?";
    $params[] = $type;
}

// Filter jenis properti (rumah, apartemen, dll)
if (!empty($propertyKind)) {
    $sql .= " AND p.property_kind = ?";
    $params[] = $propertyKind;
}

// Urutan harga
switch ($sort) {
    case 'cheap':
        $sql .= " ORDER BY p.price ASC";
        break;
    case 'expensive':
        $sql .= " ORDER BY p.price DESC";
        break;
    default:
        $sql .= " ORDER BY p.price ASC";
        break;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Properti - Latuae Land</title>
  
  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    .line-clamp-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .custom-select {
      border-radius: 85px;
      border: 1px solid #000;
      padding: 10px 20px;
      background-color: #fff;
      font-size: 14px;
      outline: none;
      cursor: pointer;
    }
  </style>
</head>
<body class="bg-gray-100 font-['Raleway'] text-black overflow-x-hidden">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/header.php'; ?>

<!-- Konten -->
<div class="max-w-7xl mx-auto px-6 py-12">
  <!-- Judul + Filter -->
  <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12">
    <div class="text-center md:text-left mb-6 md:mb-0">
      <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
        <?= !empty($q) ? "Hasil pencarian untuk '$q'" : "Daftar Properti" ?>
      </h1>
      <p class="text-gray-500 mt-2">
        <?= !empty($q) ? "Menampilkan properti sesuai pencarian Anda" : "Temukan rumah idaman Anda di lokasi strategis" ?>
      </p>
    </div>

    <!-- Filter -->
    <div class="flex flex-wrap gap-4 justify-center md:justify-end">
      <form method="GET" action="" class="flex flex-wrap gap-4">
        <input 
          type="text" 
          name="q"
          value="<?= htmlspecialchars($q) ?>"
          placeholder="Cari lokasi atau nama properti..."
          class="custom-select px-4 py-2"
        />

        <select name="property" class="custom-select">
          <option value="">Semua Jenis</option>
          <option value="rumah" <?= $propertyKind === 'rumah' ? 'selected' : '' ?>>Rumah</option>
          <option value="apartemen" <?= $propertyKind === 'apartemen' ? 'selected' : '' ?>>Apartemen</option>
          <option value="ruko" <?= $propertyKind === 'ruko' ? 'selected' : '' ?>>Ruko</option>
          <option value="tanah" <?= $propertyKind === 'tanah' ? 'selected' : '' ?>>Tanah</option>
          <option value="other" <?= $propertyKind === 'other' ? 'selected' : '' ?>>Other</option>
        </select>

        <select name="type" class="custom-select">
          <option value="">Transaksi</option>
          <option value="for_sale" <?= $type === 'for_sale' ? 'selected' : '' ?>>Dijual</option>
          <option value="for_rent" <?= $type === 'for_rent' ? 'selected' : '' ?>>Disewa</option>
        </select>

        <select name="sort" class="custom-select">
          <option value="cheap" <?= $sort === 'cheap' ? 'selected' : '' ?>>Harga Termurah</option>
          <option value="expensive" <?= $sort === 'expensive' ? 'selected' : '' ?>>Harga Termahal</option>
        </select>

        <button type="submit" class="bg-[#3C4CAC] text-white px-6 py-2 rounded-full hover:bg-[#2A3990] transition">
          Cari
        </button>
      </form>
    </div>
  </div>

  <!-- Grid Property -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    <?php if (count($properties) > 0): ?>
      <?php foreach ($properties as $p): ?>
        <a href="/LatuaGroup/pages/detail_property.php?id=<?= $p['id'] ?>" 
           class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition flex flex-col">
          <!-- Gambar -->
          <img src="/LatuaGroup/uploads/properties/<?= $p['main_image_path'] ?>" 
               alt="<?= htmlspecialchars($p['title']) ?>" 
               class="w-full h-48 object-cover" 
               onerror="this.src='/LatuaGroup/uploads/properties/default.jpg'" />

          <!-- Konten -->
          <div class="p-4 flex flex-col flex-grow">
            <h3 class="font-bold text-lg uppercase mb-1"><?= htmlspecialchars($p['title']) ?></h3>
            <p class="text-gray-500 text-sm mb-1">
              <i class="fas fa-map-marker-alt text-blue-600 mr-1"></i>
              <?= htmlspecialchars($p['regency']) ?>, <?= htmlspecialchars($p['province']) ?>
            </p>

            <div class="flex items-center justify-between mb-2">
              <p class="text-gray-900 font-bold">
                Rp <?= number_format($p['price'], 0, ',', '.') ?>
              </p>
              <span class="px-3 py-1 text-xs font-semibold rounded-full text-white
                <?= $p['property_type'] === 'for_sale' ? 'bg-blue-800' : 'bg-blue-500' ?>">
                <?= $p['property_type'] === 'for_sale' ? 'JUAL' : 'SEWA' ?>
              </span>
            </div>

            <p class="text-gray-600 text-sm line-clamp-2">
              <?= htmlspecialchars(mb_strimwidth($p['description'], 0, 80, "...")) ?>
            </p>
          </div>
        </a>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="col-span-full text-center text-gray-500">Tidak ada properti ditemukan.</p>
    <?php endif; ?>
  </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/footer.php'; ?>
</body>
</html>
