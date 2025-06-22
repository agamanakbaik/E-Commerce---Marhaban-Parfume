<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['id']);
    $productSize = $_POST['size'] ?? '';
    $action = $_POST['action'] ?? 'increase';
    $variantId = isset($_POST['variant_id']) ? intval($_POST['variant_id']) : 0;

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => &$item) {
            if (
                $item['id'] == $productId &&
                isset($item['variant_id']) &&
                $item['variant_id'] == $variantId
            ) {
                if ($action === 'increase') {
                    $item['quantity']++;
                } else {
                    if ($item['quantity'] > 1) {
                        $item['quantity']--;
                    } else {
                        unset($_SESSION['cart'][$index]);
                        $_SESSION['cart'] = array_values($_SESSION['cart']);
                    }
                }
                break;
            }
        }
    }

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false]);
exit;
