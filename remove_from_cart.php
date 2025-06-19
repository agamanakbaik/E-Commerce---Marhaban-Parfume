<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['id']);
    $productSize = $_POST['size'] ?? '';

    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productId, $productSize) {
            return !($item['id'] == $productId && $item['size'] == $productSize);
        });
        // Reset array keys
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false]);
