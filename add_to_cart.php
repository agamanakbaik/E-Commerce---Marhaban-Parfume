<?php
session_start();
// Cek apakah tombol "add_to_cart" ditekan
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
    //$quantity = 1;
    // Validasi harga tidak boleh negatif
    if ($product_price < 0) {
        die("Harga produk tidak valid");
    }

    // Siapkan item sebagai array
    $item = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image,
        'quantity' => $product_quantity
    ];

    // Inisialisasi keranjang jika belum ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Cek apakah produk sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        //while ($_SESSION['cart'] = $item) {
            if ($cart_item['id'] == $product_id) {
                $cart_item['quantity'] += $product_quantity ;
                $found = true;
                break;
            }
        //}
    }

    // Jika belum ada, tambahkan ke keranjang
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    // Redirect kembali ke halaman produk dengan pesan sukses
    $_SESSION['message'] = "Produk $product_name berhasil ditambahkan ke keranjang!";
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Jika akses langsung ke file
    header("Location: index.php");
    exit();
}
?>