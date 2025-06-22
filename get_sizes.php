<?php
include 'db.php';

// Validasi input
if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id'])) {
    http_response_code(400); // Bad Request
    die(json_encode(['error' => 'ID produk tidak valid']));
}

$product_id = intval($_GET['product_id']);

// Gunakan prepared statement untuk mencegah SQL injection
$stmt = mysqli_prepare($conn, "SELECT id, size, price FROM product_variants WHERE product_id = ?");
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$sizes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $sizes[] = [
        'id' => $row['id'],
        'size' => htmlspecialchars($row['size']), // Escape output
        'price' => $row['price']
    ];
}

// Tutup statement
mysqli_stmt_close($stmt);

header('Content-Type: application/json');
echo json_encode($sizes);
