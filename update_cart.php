<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];
    $action = $_POST['action'];
    
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            if ($action === 'increase') {
                $item['quantity']++;
            } elseif ($action === 'decrease' && $item['quantity'] > 1) {
                $item['quantity']--;
            }
            break;
        }
    }
    
    echo json_encode(['success' => true]);
    exit;
}