<?php
require '../db.php'; // koneksi ke database

$username = "superadmin"; // ganti sesuai keinginan
$password = "pwku"; // ganti sesuai keinginan

// Enkripsi password
$hash = password_hash($password, PASSWORD_DEFAULT);

// Masukkan ke database
$stmt = $conn->prepare("INSERT INTO superadmin (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);

if ($stmt->execute()) {
    echo "Akun super admin berhasil ditambahkan!";
} else {
    echo "Gagal menambahkan: " . $stmt->error;
}
?>
