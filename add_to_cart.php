<?php
session_start();
include 'db.php'; // Koneksi ke database

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = rand(1000, 9999); // ID sementara jika belum login
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

// Cek apakah produk sudah ada di keranjang
$check_query = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // Jika sudah ada, tambahkan quantity
    $update_query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'";
    mysqli_query($conn, $update_query);
} else {
    // Jika belum ada, tambahkan ke keranjang
    $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', 1)";
    mysqli_query($conn, $insert_query);
}

header("Location: cart.php");
exit();
?>
