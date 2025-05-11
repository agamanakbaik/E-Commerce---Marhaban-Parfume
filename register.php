<?php
session_start();
include 'config.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        echo "Konfirmasi password tidak cocok.";
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username sudah digunakan.";
        exit;
    }

    // Simpan user baru
    $query = "INSERT INTO admin (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Pendaftaran berhasil. Silakan <a href='login.php'>login</a>.";
    } else {
        echo "Pendaftaran gagal: " . $conn->error;
    }
}
?>

<!-- Form pendaftaran -->
<form method="POST" action="">
    <h2>Daftar Admin Baru</h2>
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Konfirmasi Password:</label><br>
    <input type="password" name="confirm" required><br><br>

    <button type="submit">Daftar</button>
</form>
