<?php
session_start();
require '../db.php'; // Sesuaikan path-nya

// Ambil data pengaturan saat ini
$query = $conn->query("SELECT * FROM pengaturan_toko LIMIT 1");
$toko = $query->fetch_assoc();

// Proses jika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_toko = trim($_POST['nama_toko']);

    // Upload banner jika ada
    $banner = $toko['banner']; // default
    if ($_FILES['banner']['error'] === 0) {
        $ext = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
        $filename = 'banner_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['banner']['tmp_name'], '../images/' . $filename);
        $banner = $filename;
    }

    // Update database
    $stmt = $conn->prepare("UPDATE pengaturan_toko SET nama_toko = ?, banner = ?");
    $stmt->bind_param("ss", $nama_toko, $banner);
    $stmt->execute();

    header("Location: pengaturan_toko.php?success=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Toko</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md p-6 rounded-lg">
        <h2 class="text-xl font-bold mb-4">Pengaturan Toko</h2>

        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">Pengaturan berhasil disimpan!</div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block font-medium">Nama Toko</label>
                <input type="text" name="nama_toko" value="<?= htmlspecialchars($toko['nama_toko']) ?>" required
                       class="w-full border rounded px-4 py-2 mt-1" />
            </div>

            <div>
                <label class="block font-medium">Banner Toko (Opsional)</label>
                <input type="file" name="banner" accept="image/*" class="mt-1" />
                <?php if (!empty($toko['banner'])): ?>
                    <img src="../images/<?= $toko['banner'] ?>" alt="Banner" class="mt-2 w-full rounded" />
                <?php endif; ?>
            </div>

            <div>
                <button type="submit" class="bg-[#099ea3] text-white px-6 py-2 rounded hover:bg-[#077c7f]">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
