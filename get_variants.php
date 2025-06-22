<?php
require 'db.php';

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    $result = mysqli_query($conn, "SELECT id, size, price, stock FROM product_variants WHERE product_id = $product_id");

    $variants = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $variants[] = $row;
    }

    echo json_encode($variants);
}
