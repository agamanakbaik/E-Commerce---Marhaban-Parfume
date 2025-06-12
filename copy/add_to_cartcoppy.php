<?php
// add_to_cart.php

// Koneksi database
$pdo = new PDO('mysql:host=localhost;dbname=marhaban', 'username', 'password');

// Ambil data dari POST
$data = json_decode(file_get_contents('php://input'), true);

// Validasi data
if (!isset($data['product_id']) || !isset($data['quantity'])) {
    echo json_encode(['success' => false, 'message' => 'Data tidak valid']);
    exit;
}

// 1. Cari keranjang yang aktif untuk user ini (jika ada sistem user)
// Jika tidak, bisa menggunakan session
session_start();
if (!isset($_SESSION['cart_id'])) {
    // Buat keranjang baru
    $stmt = $pdo->prepare("INSERT INTO cart (user_id) VALUES (?)");
    $stmt->execute([$_SESSION['user_id'] ?? null]);
    $_SESSION['cart_id'] = $pdo->lastInsertId();
}

// 2. Cek apakah produk sudah ada di keranjang
$stmt = $pdo->prepare("SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?");
$stmt->execute([$_SESSION['cart_id'], $data['product_id']]);
$existingItem = $stmt->fetch();

if ($existingItem) {
    // Update quantity jika sudah ada
    $newQuantity = $existingItem['quantity'] + $data['quantity'];
    $stmt = $pdo->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
    $stmt->execute([$newQuantity, $existingItem['id']]);
} else {
    // Tambahkan item baru
    // Dapatkan harga produk
    $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->execute([$data['product_id']]);
    $product = $stmt->fetch();
    
    $stmt = $pdo->prepare("INSERT INTO cart_items (cart_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['cart_id'],
        $data['product_id'],
        $data['quantity'],
        $product['price']
    ]);
}

echo json_encode(['success' => true, 'cart_id' => $_SESSION['cart_id']]);