<?php
session_start();
require '../db.php'; // Sesuaikan path ke koneksi database

// Contoh: tombol backup database
if (isset($_GET['backup']) && $_GET['backup'] == '1') {
    $nama_file = "backup_" . date("Y-m-d_H-i-s") . ".sql";
    header("Content-Disposition: attachment; filename=$nama_file");
    header("Content-Type: application/sql");

    // Command untuk mysqldump (kamu harus pastikan mysqldump tersedia di server)
    // Jangan gunakan ini di shared hosting kecuali dengan izin
    system("mysqldump -u root -p your_db_name");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Sistem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-5xl mx-auto bg-white rounded shadow p-6 space-y-6">
        <h1 class="text-2xl font-bold mb-4">Manajemen Sistem</h1>

        <!-- Section: Akun Admin -->
        <div>
            <h2 class="text-lg font-semibold mb-2">Manajemen Akun Admin</h2>
            <a href="kelola_admin.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Kelola
                Admin</a>
        </div>

        <!-- Section: Backup Database -->
        <div>
            <h2 class="text-lg font-semibold mb-2">Backup Database</h2>
            <a href="?backup=1" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Download Backup</a>
        </div>

        <!-- Section: Reset Data -->
        <div>
            <h2 class="text-lg font-semibold mb-2">Reset Data</h2>
            <form method="post" onsubmit="return confirm('Yakin ingin menghapus semua data pesanan?');">
                <button type="submit" name="reset_pesanan"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Hapus Semua Pesanan
                </button>
            </form>
        </div>

        <!-- Section: Pengaturan Sistem -->
        <div>
            <h2 class="text-lg font-semibold mb-2">Pengaturan Sistem</h2>
            <p class="text-sm text-gray-600">Fitur ini bisa kamu kembangkan lebih lanjut, misalnya untuk mengatur nama
                toko, email notifikasi, dsb.</p>
        </div>
        <!-- Section: Pengaturan Toko -->
        <div>
            <h2 class="text-lg font-semibold mb-2">Pengaturan Toko</h2>
            <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block font-medium">Nama Toko:</label>
                    <input type="text" name="nama_toko" value="<?= htmlspecialchars($toko['nama_toko']) ?>" required
                        class="w-full border border-gray-300 rounded px-4 py-2" />
                </div>

                <div>
                    <label class="block font-medium">Banner Saat Ini:</label>
                    <img src="../uploads/<?= $toko['banner'] ?>" alt="Banner"
                        class="w-full max-w-xs rounded shadow mt-2" />
                </div>

                <div>
                    <label class="block font-medium">Ganti Banner:</label>
                    <input type="file" name="banner" accept="image/*"
                        class="w-full border border-gray-300 rounded px-4 py-2" />
                </div>

                <div>
                    <button type="submit" name="update_toko"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div> 
    </div>
</body>

</html>