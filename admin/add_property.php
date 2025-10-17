<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/LatuaGroup/includes/db_connect.php';

// === Ambil daftar provinsi & agen dari database ===
$provinces = $pdo->query("SELECT id, name FROM provinces ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
$agents = $pdo->query("SELECT id, name FROM agents ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);

// === Handle form submit ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title          = $_POST['title'] ?? '';
    $price          = $_POST['price'] ?? 0;
    $provinceId     = $_POST['province'] ?? ''; 
    $regency        = $_POST['regency'] ?? '';
    $description    = $_POST['description'] ?? '';
    $propertyType   = $_POST['property_type'] ?? 'for_sale';
    $propertyKind   = $_POST['property_kind'] ?? '';
    $facilities     = $_POST['facilities'] ?? '';
    $agentId        = $_POST['agent_id'] ?? null; // 🔹 Agen yang dipilih

    try {
        // === Ambil nama provinsi dari ID ===
        $provinceStmt = $pdo->prepare("SELECT name FROM provinces WHERE id = ? LIMIT 1");
        $provinceStmt->execute([$provinceId]);
        $provinceRow = $provinceStmt->fetch();
        $provinceName = $provinceRow ? $provinceRow['name'] : '';

        // === 1. Simpan properti ke tabel properties ===
        $stmt = $pdo->prepare("
            INSERT INTO properties 
            (title, description, price, province, regency, property_type, property_kind, facilities, agent_id, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $title,
            $description,
            $price,
            $provinceName,
            $regency,
            $propertyType,
            $propertyKind,
            $facilities,
            $agentId
        ]);
        $propertyId = $pdo->lastInsertId();

        // === 2. Upload maksimal 4 gambar ===
        $uploaded = 0;
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/LatuaGroup/uploads/properties/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $maxImages = 4;
            $coverIndex = isset($_POST['cover_index']) ? intval($_POST['cover_index']) : 0;
            $validFiles = [];
            $validExt = ['jpg', 'jpeg', 'png', 'webp'];

            // Filter file valid
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION));
                    if (in_array($ext, $validExt)) {
                        $validFiles[] = [
                            'tmp_name' => $tmpName,
                            'orig_name' => $_FILES['images']['name'][$key],
                            'ext' => $ext
                        ];
                    }
                }
            }

            // Batasi maksimal 4 file
            $validFiles = array_slice($validFiles, 0, $maxImages);

            foreach ($validFiles as $i => $file) {
                $newFileName = uniqid("prop_") . "." . $file['ext'];
                $targetPath = $uploadDir . $newFileName;

                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    $isMain = ($i === $coverIndex) ? 1 : 0;
                    $stmtImg = $pdo->prepare("INSERT INTO property_images (property_id, image_path, is_main) VALUES (?, ?, ?)");
                    $stmtImg->execute([$propertyId, $newFileName, $isMain]);
                    $uploaded++;
                }
            }
        }

        header("Location: properties.php?success=1&uploaded={$uploaded}");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Properti</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
  <div class="max-w-2xl mx-auto py-10 px-5">
    <h1 class="text-2xl font-semibold mb-6">Tambah Properti Baru</h1>

    <form method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded-lg shadow">

      <!-- Judul -->
      <div>
        <label class="block mb-1 font-semibold">Judul Properti</label>
        <input type="text" name="title" class="w-full border px-3 py-2 rounded" required>
      </div>

      <!-- Deskripsi -->
      <div>
        <label class="block mb-1 font-semibold">Deskripsi Properti</label>
        <textarea name="description" class="w-full border px-3 py-2 rounded" rows="6" required></textarea>
      </div>

      <!-- Harga -->
      <div>
        <label class="block mb-1 font-semibold">Harga</label>
        <input type="number" name="price" class="w-full border px-3 py-2 rounded" required>
      </div>

      <!-- Provinsi -->
      <div>
        <label class="block mb-1 font-semibold">Provinsi</label>
        <select id="province" name="province" class="w-full border px-3 py-2 rounded" required>
          <option value="">Pilih Provinsi</option>
          <?php foreach ($provinces as $prov): ?>
            <option value="<?= htmlspecialchars($prov['id']) ?>"><?= htmlspecialchars($prov['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Kabupaten -->
      <div>
        <label class="block mb-1 font-semibold">Kabupaten/Kota</label>
        <select id="regency" name="regency" class="w-full border px-3 py-2 rounded" required disabled>
          <option value="">Pilih Kabupaten/Kota</option>
        </select>
      </div>

      <!-- Pilih Agen -->
      <div>
        <label class="block mb-1 font-semibold">Pilih Agen</label>
        <select name="agent_id" class="w-full border px-3 py-2 rounded" required>
          <option value="">-- Pilih Agen --</option>
          <?php foreach ($agents as $a): ?>
            <option value="<?= htmlspecialchars($a['id']) ?>"><?= htmlspecialchars($a['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Jenis & Tipe -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block mb-1 font-semibold">Jenis Properti</label>
          <select name="property_kind" class="w-full border px-3 py-2 rounded" required>
            <option value="">Pilih Jenis Properti</option>
            <option value="Rumah">Rumah</option>
            <option value="Apartemen">Apartemen</option>
            <option value="Ruko">Ruko</option>
            <option value="Tanah">Tanah</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div>
          <label class="block mb-1 font-semibold">Tipe Properti</label>
          <select name="property_type" class="w-full border px-3 py-2 rounded">
            <option value="for_sale">Dijual</option>
            <option value="for_rent">Disewa</option>
          </select>
        </div>
      </div>

      <!-- Fasilitas -->
      <div>
        <label class="block mb-1 font-semibold">Fasilitas</label>
        <textarea name="facilities" class="w-full border px-3 py-2 rounded" rows="4" placeholder="Contoh: Keamanan 24 jam, Parkir luas, Kolam renang"></textarea>
      </div>

      <!-- Upload Gambar -->
      <div>
        <label class="block mb-1 font-semibold">Foto Properti (maks 4 gambar)</label>
        <div class="flex items-center gap-3">
          <input type="file" id="images" name="images[]" accept="image/*" multiple class="w-full max-w-xs">
          <span id="fileCount" class="text-sm text-gray-600"></span>
        </div>
        <div id="coverSelector" class="mt-2"></div>
        <input type="hidden" name="cover_index" id="cover_index" value="0">
        <p class="text-xs text-gray-500">* Maksimal 4 gambar. Pilih salah satu sebagai cover.</p>
      </div>

      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Simpan
      </button>
    </form>
  </div>

  <script>
  // === Ambil kabupaten dinamis ===
  document.getElementById('province').addEventListener('change', function() {
    const provinceId = this.value;
    const regencySelect = document.getElementById('regency');

    if (!provinceId) {
      regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
      regencySelect.disabled = true;
      return;
    }

    fetch(`/LatuaGroup/api/get_regencies.php?province_id=${provinceId}`)
      .then(res => res.json())
      .then(data => {
        regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        data.forEach(item => {
          regencySelect.innerHTML += `<option value="${item.name}">${item.name}</option>`;
        });
        regencySelect.disabled = false;
      })
      .catch(err => {
        console.error(err);
        alert('Gagal mengambil data kabupaten.');
      });
  });

  // === Preview jumlah file & pilih cover ===
  document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('images');
    const fileCount = document.getElementById('fileCount');
    const coverSelector = document.getElementById('coverSelector');
    const coverIndexInput = document.getElementById('cover_index');

    input.addEventListener('change', function() {
      if (input.files.length > 4) {
        alert('Maksimal 4 file gambar!');
        input.value = '';
        fileCount.textContent = '';
        coverSelector.innerHTML = '';
        return;
      }
      if (input.files.length > 0) {
        fileCount.textContent = input.files.length + ' file dipilih';
        let html = '<label class="block mb-1 font-semibold">Pilih gambar utama (cover):</label>';
        for (let i = 0; i < input.files.length; i++) {
          html += `
            <label class="inline-flex items-center mr-4">
              <input type="radio" name="cover_radio" value="${i}" ${i === 0 ? 'checked' : ''}>
              <span class="ml-1 text-sm">${input.files[i].name}</span>
            </label>`;
        }
        coverSelector.innerHTML = html;

        document.querySelectorAll('input[name="cover_radio"]').forEach(radio => {
          radio.addEventListener('change', function() {
            coverIndexInput.value = this.value;
          });
        });
        coverIndexInput.value = 0;
      } else {
        fileCount.textContent = '';
        coverSelector.innerHTML = '';
        coverIndexInput.value = '';
      }
    });
  });
  </script>
</body>
</html>
