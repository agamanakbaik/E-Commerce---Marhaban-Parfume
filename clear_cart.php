<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['cart']);
    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false]);
exit;
