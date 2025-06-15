<?php
session_start();
if (!isset($_SESSION['superadmin'])) {
    header("Location: login_superadmin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Super Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 font-sans">
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-[#099ea3]">Super Admin Dashboard</h1>
        <div>
            <span class="text-gray-600 mr-4">Halo, <?= htmlspecialchars($_SESSION['superadmin']) ?></span>
            <a href="logout.php" class="text-red-500 hover:underline">Logout</a>
        </div>
    </nav>

    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Kelola Admin</h2>
            <p class="text-sm text-gray-500 mb-4">Tambah, ubah, atau hapus akun admin.</p>
            <a href="kelola_admin.php" class="text-[#099ea3] hover:underline text-sm">Lihat Detail</a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Laporan Penjualan</h2>
            <p class="text-sm text-gray-500 mb-4">Lihat laporan performa toko.</p>
            <a href="laporan_penjualan.php" class="text-[#099ea3] hover:underline text-sm">Lihat Laporan</a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Manajemen Sistem</h2>
            <p class="text-sm text-gray-500 mb-4">Kontrol sistem & database.</p>
            <a href="pengaturan_sistem.php" class="text-[#099ea3] hover:underline text-sm">Lihat Pengaturan</a>
        </div>
    </div>
</body>
</html>
