<?php
session_start();
require '../db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM superadmin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['superadmin'] = $row['username'];
        header("Location: halaman_superadmin.php");
        exit;
    }
}

header("Location: login_superadmin.php?error=1");
exit;
