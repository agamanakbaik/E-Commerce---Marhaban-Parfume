<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['id']);
    $variantId = isset($_POST['variant_id']) ? intval($_POST['variant_id']) : 0;

    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productId, $variantId) {
            return !($item['id'] == $productId && $item['variant_id'] == $variantId);
        });

        // Reset indeks array biar urut
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false]);
exit;
