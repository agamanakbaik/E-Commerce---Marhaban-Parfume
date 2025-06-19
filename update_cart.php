<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['id']);
    $productSize = $_POST['size'] ?? '';
    $action = $_POST['action'] ?? 'increase';

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $productId && $item['size'] == $productSize) {
                if ($action === 'increase') {
                    $item['quantity']++;
                } else {
                    if ($item['quantity'] > 1) {
                        $item['quantity']--;
                    } else {
                        // Jika quantity 1 dan dikurangi, hapus item
                        $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($i) use ($productId, $productSize) {
                            return !($i['id'] == $productId && $i['size'] == $productSize);
                        });
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
