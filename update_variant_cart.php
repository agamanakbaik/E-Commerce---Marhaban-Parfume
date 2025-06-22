<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $new_variant_id = intval($_POST['variant_id']);
    $current_variant_id = intval($_POST['current_variant_id']);

    // Ambil data varian baru dari database
    $query = "SELECT size, price FROM product_variants WHERE id = $new_variant_id LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $variant = mysqli_fetch_assoc($result);
        $new_size = $variant['size'];
        $new_price = $variant['price'];

        // Update di session cart
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id && $item['variant_id'] == $current_variant_id) {
                // Update semua data varian
                $item['variant_id'] = $new_variant_id;
                $item['size'] = $new_size;
                $item['price'] = $new_price;
                break;
            }
        }
    }
}

header("Location: keranjang.php");
exit;
