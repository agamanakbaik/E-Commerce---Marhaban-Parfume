<?php
session_start();
include 'db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: halamanpelanggan.php");
    exit();
}

$user_id = intval($_SESSION['user_id']);

// Hapus keranjang dari database
$stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Optional: kosongkan session cart jika ada
unset($_SESSION['cart']);

// Tampilkan halaman sukses
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout Berhasil</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <h1 class="text-2xl font-bold text-green-600 mb-4">✅ Checkout Berhasil!</h1>
        <p class="text-gray-700 mb-6">Terima kasih telah berbelanja di <strong>Marhaban Parfume</strong>.<br>Pesanan Anda sedang diproses.</p>
        <a href="halamanpelanggan.php" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md transition">
            Kembali ke Beranda
        </a>
    </div>

</body>

</html>