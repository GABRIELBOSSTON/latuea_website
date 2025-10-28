<!-- popup_iklan.php -->
<div id="popupOverlay"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-[9999] transition-opacity duration-500">
  <div id="popupBox"
       class="relative bg-white rounded-2xl w-[90%] max-w-sm p-5 text-center shadow-2xl transform scale-95 opacity-0 transition-all duration-300">

    <!-- Tombol Close -->
    <button id="popupClose"
            class="absolute top-3 right-3 w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-lg transition focus:outline-none">
      &times;
    </button>

    <!-- Gambar Promo -->
    <div class="aspect-square mb-4 overflow-hidden rounded-xl">
      <img id="popupImage" src="" alt="Promo Properti" class="w-full h-full object-cover">
    </div>

    <!-- Konten -->
    <h2 class="text-xl font-bold text-gray-900 mb-2">✨ Promo Rumah Impian!</h2>
    <p class="text-gray-600 mb-5 leading-relaxed">
      Nikmati diskon spesial untuk properti pilihan kami — berlaku hanya minggu ini!
    </p>

    <!-- Tombol CTA -->
    <a href="/LatuaGroup/pages/listproperty.php?property=rumah"
       class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition">
      Lihat Sekarang
    </a>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", async function () {
  const overlay = document.getElementById("popupOverlay");
  const box = document.getElementById("popupBox");
  const closeBtn = document.getElementById("popupClose");
  const img = document.getElementById("popupImage");

  const defaultImage =
    "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80";

  try {
    // 🔹 Ambil data iklan terbaru dari API
    const res = await fetch("http://localhost/LatuaGroup/api/get_iklan.php");
    const data = await res.json();
    console.log("Data iklan dari API:", data);

    if (data && data.image_path) {
      // 🔹 Pastikan path valid (hindari double /LatuaGroup/)
      img.src = data.image_path.startsWith("http")
        ? data.image_path
        : "http://localhost" + data.image_path;
    } else {
      img.src = defaultImage;
    }
  } catch (err) {
    console.error("Gagal ambil data iklan:", err);
    img.src = defaultImage;
  }

  // 🔹 Tampilkan popup sekali per sesi
  if (!sessionStorage.getItem("popupShown")) {
    setTimeout(() => {
      overlay.classList.remove("hidden");
      requestAnimationFrame(() => {
        overlay.classList.add("flex", "opacity-100");
        box.classList.remove("opacity-0", "scale-95");
        box.classList.add("opacity-100", "scale-100");
      });
    }, 1000);
    sessionStorage.setItem("popupShown", "true");
  }

  // 🔹 Tutup popup
  closeBtn.addEventListener("click", () => {
    box.classList.add("opacity-0", "scale-95");
    setTimeout(() => {
      overlay.classList.add("hidden");
      overlay.classList.remove("flex", "opacity-100");
    }, 300);
  });
});
</script>
