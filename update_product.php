<?php
session_start();
require 'db.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil & bersihkan data input
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category_id = intval($_POST['category_id']);

    $imageUpdate = '';

    // Upload gambar baru jika ada
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "images/";
        $imageName = time() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $imageName;
        $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) die("File bukan gambar.");
        if ($_FILES["image"]["size"] > 2000000) die("Ukuran file terlalu besar (maks 2MB).");
        if (!in_array($imageType, ['jpg', 'jpeg', 'png', 'gif'])) die("Format tidak didukung.");

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $imageUpdate = ", image='$imageName'";
        } else {
            die("Upload gambar gagal.");
        }
    }

    // Update produk
    $updateProduct = "UPDATE products SET 
                        name='$name', 
                        description='$description', 
                        category_id=$category_id
                        $imageUpdate
                      WHERE id=$id";

    if (!mysqli_query($conn, $updateProduct)) {
        die("Gagal update produk: " . mysqli_error($conn));
    }

    // =============================
    // DELETE VARIANTS
    // =============================
    if (isset($_POST['delete_variants'])) {
        $delete_ids = array_map('intval', $_POST['delete_variants']);
        if (!empty($delete_ids)) {
            $delete_str = implode(",", $delete_ids);
            mysqli_query($conn, "DELETE FROM product_variants WHERE id IN ($delete_str)");
        }
    }

    // =============================
    // UPDATE EXISTING VARIANTS
    // =============================
    if (isset($_POST['existing_variant_id'])) {
        foreach ($_POST['existing_variant_id'] as $index => $variant_id) {
            $variant_id = intval($variant_id);
            $size = mysqli_real_escape_string($conn, $_POST['existing_variant_size'][$index]);
            $price = floatval($_POST['existing_variant_price'][$index]);
            $stock = intval($_POST['existing_variant_stock'][$index]);

            $update_query = "UPDATE product_variants SET 
                                size='$size', 
                                price=$price, 
                                stock=$stock 
                             WHERE id=$variant_id";
            mysqli_query($conn, $update_query);
        }
    }

    // =============================
    // INSERT NEW VARIANTS
    // =============================
    if (!empty($_POST['new_variant_size']) && is_array($_POST['new_variant_size'])) {
        foreach ($_POST['new_variant_size'] as $index => $size) {
            $size = mysqli_real_escape_string($conn, trim($size));
            $price = floatval($_POST['new_variant_price'][$index]);
            $stock = intval($_POST['new_variant_stock'][$index]);

            // Skip kosong / invalid
            if ($size === '' || $price <= 0 || $stock < 0) continue;

            $insert_query = "INSERT INTO product_variants (product_id, size, price, stock) 
                             VALUES ($id, '$size', $price, $stock)";
            mysqli_query($conn, $insert_query);
        }
    }

    header("Location: halamanadmin.php?update=success");
    exit;
}
