<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: properties.php");
    exit;
}

// === Ambil data properti lama ===
$stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
$stmt->execute([$id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$property) {
    echo "Properti tidak ditemukan.";
    exit;
}

// === Ambil daftar provinsi & agen ===
$provinces = $pdo->query("SELECT id, name FROM provinces ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
$agents = $pdo->query("SELECT id, name FROM agents ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);

// === Ambil kabupaten untuk provinsi saat ini ===
$currentProvinceId = $pdo->prepare("SELECT id FROM provinces WHERE name = ? LIMIT 1");
$currentProvinceId->execute([$property['province']]);
$provRow = $currentProvinceId->fetch();
$currentProvinceId = $provRow ? $provRow['id'] : null;

$regencies = [];
if ($currentProvinceId) {
    $stmtReg = $pdo->prepare("SELECT name FROM regencies WHERE province_id = ? ORDER BY name ASC");
    $stmtReg->execute([$currentProvinceId]);
    $regencies = $stmtReg->fetchAll(PDO::FETCH_ASSOC);
}

// === Ambil semua gambar properti (cover duluan) ===
$stmtImg = $pdo->prepare("SELECT * FROM property_images WHERE property_id = ? ORDER BY is_main DESC, id ASC");
$stmtImg->execute([$id]);
$images = $stmtImg->fetchAll(PDO::FETCH_ASSOC);

// === Update Data ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title         = $_POST['title'];
    $price         = $_POST['price'];
    $provinceId    = $_POST['province'];
    $regency       = $_POST['regency'];
    $description   = $_POST['description'];
    $propertyType  = $_POST['property_type'];
    $propertyKind  = $_POST['property_kind'];
    $facilities    = $_POST['facilities'] ?? '';
    $agentId       = $_POST['agent_id'] ?? null;
    $coverImgId    = isset($_POST['main_image_id']) ? intval($_POST['main_image_id']) : null;

    // Ambil nama provinsi dari ID
    $provinceStmt = $pdo->prepare("SELECT name FROM provinces WHERE id = ? LIMIT 1");
    $provinceStmt->execute([$provinceId]);
    $provinceRow = $provinceStmt->fetch();
    $provinceName = $provinceRow ? $provinceRow['name'] : '';

    // === Update data properti ===
    $stmt = $pdo->prepare("
        UPDATE properties
        SET title=?, price=?, province=?, regency=?, description=?, property_type=?, property_kind=?, facilities=?, agent_id=?
        WHERE id=?
    ");
    $stmt->execute([$title, $price, $provinceName, $regency, $description, $propertyType, $propertyKind, $facilities, $agentId, $id]);

    // === Upload gambar baru ===
    $stmtImgCount = $pdo->prepare("SELECT COUNT(*) FROM property_images WHERE property_id = ?");
    $stmtImgCount->execute([$id]);
    $imgCount = $stmtImgCount->fetchColumn();

    $maxImages = 4;
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/LatuaGroup/uploads/properties/";
    $count = 0;

    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            if ($imgCount + $count >= $maxImages) break;
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $newFileName = uniqid("prop_") . "." . $ext;
                    $targetPath = $uploadDir . $newFileName;
                    if (move_uploaded_file($tmpName, $targetPath)) {
                        $pdo->prepare("INSERT INTO property_images (property_id, image_path, is_main) VALUES (?, ?, 0)")
                            ->execute([$id, $newFileName]);
                        $count++;
                    }
                }
            }
        }
    }

    // === Update cover image ===
    if ($coverImgId) {
        $pdo->prepare("UPDATE property_images SET is_main = 0 WHERE property_id = ?")->execute([$id]);
        $pdo->prepare("UPDATE property_images SET is_main = 1 WHERE id = ? AND property_id = ?")->execute([$coverImgId, $id]);
    }

    header("Location: properties.php?success=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Properti</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
  <div class="max-w-3xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-semibold mb-6">Edit Properti</h1>

    <form method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded-lg shadow">

      <!-- Judul -->
      <div>
        <label class="block mb-1 font-semibold">Judul Properti</label>
        <input type="text" name="title" value="<?= htmlspecialchars($property['title']) ?>" class="w-full border px-3 py-2 rounded" required>
      </div>

      <!-- Deskripsi -->
      <div>
        <label class="block mb-1 font-semibold">Deskripsi Properti</label>
        <textarea name="description" class="w-full border px-3 py-2 rounded" rows="6" required><?= htmlspecialchars($property['description']) ?></textarea>
      </div>

      <!-- Harga -->
      <div>
        <label class="block mb-1 font-semibold">Harga</label>
        <input type="number" name="price" value="<?= htmlspecialchars($property['price']) ?>" class="w-full border px-3 py-2 rounded" required>
      </div>

      <!-- Provinsi -->
      <div>
        <label class="block mb-1 font-semibold">Provinsi</label>
        <select id="province" name="province" class="w-full border px-3 py-2 rounded" required>
          <option value="">Pilih Provinsi</option>
          <?php foreach ($provinces as $prov): ?>
            <option value="<?= $prov['id'] ?>" <?= $property['province'] === $prov['name'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($prov['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Kabupaten -->
      <div>
        <label class="block mb-1 font-semibold">Kabupaten/Kota</label>
        <select id="regency" name="regency" class="w-full border px-3 py-2 rounded" required>
          <option value="">Pilih Kabupaten/Kota</option>
          <?php foreach ($regencies as $r): ?>
            <option value="<?= htmlspecialchars($r['name']) ?>" <?= $r['name'] === $property['regency'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($r['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Pilih Agen -->
      <div>
        <label class="block mb-1 font-semibold">Pilih Agen</label>
        <select name="agent_id" class="w-full border px-3 py-2 rounded" required>
          <option value="">-- Pilih Agen --</option>
          <?php foreach ($agents as $a): ?>
            <option value="<?= htmlspecialchars($a['id']) ?>" <?= $a['id'] == $property['agent_id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($a['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Jenis & Tipe Properti -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block mb-1 font-semibold">Jenis Properti</label>
          <select name="property_kind" class="w-full border px-3 py-2 rounded" required>
            <?php $kinds = ['Rumah','Apartemen','Ruko','Tanah','Other']; ?>
            <?php foreach ($kinds as $k): ?>
              <option value="<?= $k ?>" <?= $property['property_kind'] === $k ? 'selected' : '' ?>><?= $k ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label class="block mb-1 font-semibold">Tipe Properti</label>
          <select name="property_type" class="w-full border px-3 py-2 rounded" required>
            <option value="for_sale" <?= $property['property_type']==='for_sale'?'selected':'' ?>>Dijual</option>
            <option value="for_rent" <?= $property['property_type']==='for_rent'?'selected':'' ?>>Disewa</option>
          </select>
        </div>
      </div>

      <!-- Fasilitas -->
      <div>
        <label class="block mb-1 font-semibold">Fasilitas</label>
        <textarea name="facilities" class="w-full border px-3 py-2 rounded" rows="4"><?= htmlspecialchars($property['facilities']) ?></textarea>
      </div>

      <!-- Upload Gambar Baru -->
      <div>
        <label class="block mb-1 font-semibold">Tambah Foto Properti (maks 4 gambar total)</label>
        <input type="file" id="images" name="images[]" accept="image/*" multiple class="w-full max-w-xs">
        <span id="fileCount" class="text-sm text-gray-600"></span>
        <p class="text-xs text-gray-500">* Maksimal 4 gambar total. Pilih cover di bawah.</p>
      </div>

      <!-- Gambar Saat Ini -->
      <?php if ($images): ?>
      <div>
        <label class="block mb-1 font-semibold">Gambar Saat Ini</label>
        <div class="flex flex-wrap gap-4">
          <?php foreach ($images as $img): ?>
            <div class="flex flex-col items-center relative">
              <img src="/LatuaGroup/uploads/properties/<?= htmlspecialchars($img['image_path']) ?>"
                   class="w-24 h-24 object-cover rounded mb-1 border <?= $img['is_main'] ? 'border-blue-500' : 'border-gray-300' ?>">
              <input type="radio" name="main_image_id" value="<?= $img['id'] ?>" <?= $img['is_main'] ? 'checked' : '' ?>>
              <span class="text-xs">Cover</span>
              <a href="delete_property_image.php?id=<?= $img['id'] ?>&property_id=<?= $property['id'] ?>" 
                 onclick="return confirm('Hapus gambar ini?')" 
                 class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs hover:bg-red-700"
                 style="transform: translate(40%, -40%);">&times;</a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
    </form>
  </div>

  <script>
  // === Dynamic Kabupaten ===
  document.getElementById('province').addEventListener('change', function() {
    const id = this.value, regencySelect = document.getElementById('regency');
    regencySelect.innerHTML = '<option>Loading...</option>';
    fetch(`/LatuaGroup/api/get_regencies.php?province_id=${id}`)
      .then(res => res.json())
      .then(data => {
        regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        data.forEach(d => regencySelect.innerHTML += `<option value="${d.name}">${d.name}</option>`);
      })
      .catch(() => alert('Gagal mengambil data kabupaten.'));
  });

  // === Batas upload gambar ===
  document.getElementById('images').addEventListener('change', function() {
    const fileCount = document.getElementById('fileCount');
    if (this.files.length > 4) {
      alert('Maksimal 4 file gambar!');
      this.value = '';
      fileCount.textContent = '';
      return;
    }
    fileCount.textContent = this.files.length + ' file dipilih';
  });
  </script>
</body>
</html>
