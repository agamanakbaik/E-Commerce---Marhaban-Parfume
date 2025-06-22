<?php
session_start();

if (isset($_POST['add_to_cart'])) {
    // Validasi data yang diperlukan
    if (empty($_POST['product_id']) || empty($_POST['product_name']) || !isset($_POST['product_price'])) {
        $_SESSION['error'] = "Data produk tidak lengkap";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Sanitasi input
    $product_id = intval($_POST['product_id']);
    $product_name = htmlspecialchars(trim($_POST['product_name']));
    $product_price = floatval($_POST['product_price']);
    $product_image = isset($_POST['product_image']) ? htmlspecialchars(trim($_POST['product_image'])) : '';
    $product_quantity = isset($_POST['product_quantity']) ? intval($_POST['product_quantity']) : 1;
    $product_size = isset($_POST['product_size']) ? htmlspecialchars(trim($_POST['product_size'])) : '';
    $product_category = isset($_POST['product_category']) ? intval($_POST['product_category']) : 0;
    $variant_id = isset($_POST['variant_id']) ? intval($_POST['variant_id']) : 0;

    // Validasi harga
    if ($product_price <= 0) {
        $_SESSION['error'] = "Harga produk tidak valid";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Validasi kuantitas
    if ($product_quantity <= 0) {
        $product_quantity = 1;
    }

    // Siapkan item keranjang
    $item = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image,
        'quantity' => $product_quantity,
        'size' => $product_size,
        'category' => $product_category,
        'variant_id' => $variant_id
    ];

    // Inisialisasi keranjang jika belum ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Cek apakah produk + varian sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $product_id && $cart_item['variant_id'] == $variant_id) {
            $cart_item['quantity'] += $product_quantity;
            $found = true;
            break;
        }
    }

    // Jika belum ada, tambahkan item baru
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    // Set pesan sukses
    $size_display = !empty($product_size) ? "($product_size)" : "";
    $_SESSION['message'] = "Produk $product_name $size_display berhasil ditambahkan ke keranjang!";

    // Redirect kembali
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Jika tidak ada aksi add_to_cart, redirect ke halaman utama
    header("Location: halamanpelanggan.php");
    exit();
}
