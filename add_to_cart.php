<?php
session_start();

if (isset($_POST['add_to_cart'])) {
    // Validasi input
    if (empty($_POST['product_id']) || empty($_POST['product_name']) || !isset($_POST['product_price'])) {
        die("Data produk tidak lengkap");
    }

    // Bersihkan input
    $product_id = intval($_POST['product_id']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $product_price = floatval($_POST['product_price']);
    $product_image = htmlspecialchars($_POST['product_image']);
    $product_quantity = intval($_POST['product_quantity']);
    $product_size = isset($_POST['product_size']) ? htmlspecialchars($_POST['product_size']) : ''; // Ambil ukuran

    // Validasi harga
    if ($product_price < 0) {
        die("Harga produk tidak valid");
    }

    // Item lengkap dengan ukuran
    $product_size = htmlspecialchars($_POST['product_size'] ?? ''); // bisa 100ml, 5000ml, dll

$item = [
    'id' => $product_id,
    'name' => $product_name,
    'price' => $product_price,
    'image' => $product_image,
    'quantity' => $product_quantity,
    'size' => $product_size
];


    // Inisialisasi keranjang
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Cek apakah produk + ukuran sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $product_id && $cart_item['size'] == $product_size) {
            $cart_item['quantity'] += $product_quantity;
            $found = true;
            break;
        }
    }

    // Jika belum ada, tambahkan
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    // Redirect
    $_SESSION['message'] = "Produk $product_name ($product_size) berhasil ditambahkan ke keranjang!";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    header("Location: halamanpelanggan.php");
    exit();
}
?>