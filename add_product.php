<?php
session_start();
require 'db.php';

// Cek session admin
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Bersihkan input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category_id = intval($_POST['category_id']);

    // Upload gambar
    $imageName = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = 'images/' . $imageName;

        // Validasi gambar
        $check = getimagesize($imageTmp);
        if ($check === false) {
            die("File bukan gambar.");
        }

        if ($_FILES['image']['size'] > 2000000) {
            die("Ukuran file terlalu besar (maksimal 2MB).");
        }

        $imageType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
        if (!in_array($imageType, ['jpg', 'jpeg', 'png', 'gif'])) {
            die("Format gambar tidak valid. Gunakan JPG, JPEG, PNG, atau GIF.");
        }

        if (!move_uploaded_file($imageTmp, $targetPath)) {
            die("Gagal upload gambar.");
        }
    }

    // Simpan produk
    $query = "INSERT INTO products (name, description, image, category_id) 
              VALUES ('$name', '$description', '$imageName', $category_id)";

    if (!mysqli_query($conn, $query)) {
        die("Gagal menyimpan produk: " . mysqli_error($conn));
    }

    $product_id = mysqli_insert_id($conn);

    // Simpan varian (ukuran, harga, stok)
    if (!empty($_POST['variant_size']) && is_array($_POST['variant_size'])) {
        foreach ($_POST['variant_size'] as $index => $size) {
            $size = mysqli_real_escape_string($conn, trim($_POST['variant_size'][$index]));
            $price = floatval($_POST['variant_price'][$index]);
            $stock = intval($_POST['variant_stock'][$index]);

            // Skip varian jika salah satu kosong atau invalid
            if ($size === '' || $price <= 0 || $stock < 0) {
                continue;
            }

            $variantQuery = "INSERT INTO product_variants (product_id, size, price, stock) 
                             VALUES ($product_id, '$size', $price, $stock)";
            mysqli_query($conn, $variantQuery);
        }
    }

    header('Location: halamanadmin.php?success=1');
    exit;
}
