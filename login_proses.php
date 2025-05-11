<?php 
session_start();
include 'config.php'; // Menghubungkan ke database

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cari data admin berdasarkan username
$query = "SELECT * FROM admin WHERE username=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Verifikasi password dengan password_verify()
    if (password_verify($password, $row['password'])) {
        // Set session
        $_SESSION['admin'] = $row['username'];

        // Redirect ke halaman admin
        header("Location: halamanadmin.php");
        exit;
    } else {
        echo "Password salah.";
    }
} else {
    echo "Username tidak ditemukan.";
}
?>
