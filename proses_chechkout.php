<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Simpan pesanan ke database (sesuaikan dengan struktur tabel Anda)
    $conn = new mysqli("localhost", "root", "", "marhaban_perfume");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $totalHarga = 0;

    foreach ($_SESSION['cart'] as $item) {
        $totalHarga += $item['jumlah'] * $item['harga'];
    }

    $sql = "INSERT INTO pesanan (user_id, nama, alamat, metode_pembayaran, total_harga, status) 
            VALUES ('$user_id', '$nama', '$alamat', '$metode_pembayaran', '$totalHarga', 'Menunggu Pembayaran')";

    if ($conn->query($sql) === TRUE) {
        // Kosongkan keranjang setelah berhasil checkout
        unset($_SESSION['cart']);
        echo "<script>alert('Pesanan berhasil dibuat!'); window.location.href='halamanpelanggan.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    header("Location: checkout.php");
}
?>
