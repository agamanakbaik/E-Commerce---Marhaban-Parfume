<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Hapus isi keranjang setelah checkout
mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");

echo "<p>Checkout berhasil! Terima kasih sudah berbelanja.</p>";
echo "<a href='index.php'>Kembali ke Beranda</a>";

session_destroy();
?>
