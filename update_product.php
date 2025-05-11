<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // Cek apakah ada upload gambar baru
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = basename($_FILES["image"]["name"]);
            $query = "UPDATE products SET name='$name', description='$description', price='$price', image='$image' WHERE id=$id";
        } else {
            echo "Gagal upload gambar.";
            exit;
        }
    } else {
        $query = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id=$id";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: halamanadmin.php"); // ganti ke halaman admin kamu
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>
