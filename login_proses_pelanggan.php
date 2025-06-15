<?php
session_start();
require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM pelanggan WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['pelanggan'] = true;
        $_SESSION['pelanggan_id'] = $row['id'];

        if (isset($_POST['remember'])) {
            setcookie('remember_me', $row['id'], time() + (86400 * 30), "/");
        }

        header("Location: halamanpelanggan.php");
        exit;
    }
}

// Jika gagal login
header("Location: loginpelanggan.php?error=1");
exit;
