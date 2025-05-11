<?php
include 'db.php'; // Koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image = $_FILES["image"]["name"];
    $target = "images/" . basename($image);
    $category_id = $_POST["category_id"];
    
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);

    $query = "INSERT INTO products (name, description, price, image, category_id) VALUES ('$name', '$description', '$price', '$image', '$category_id')";
    mysqli_query($conn, $query);

    header("Location: halamanadmin.php"); // Redirect ke halaman admin
}
?>
