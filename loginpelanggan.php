<?php
session_start();
require 'db.php';

// Auto login jika ada cookie
if (isset($_COOKIE['remember_me'])) {
    $userId = $_COOKIE['remember_me'];
    $stmt = $conn->prepare("SELECT * FROM pelanggan WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $_SESSION['pelanggan'] = true;
        $_SESSION['pelanggan_id'] = $row['id'];
        header("Location: halamanpelanggan.php");
        exit;
    }
}

//jika ada yang berhasil registrasi
$showSuccess = false;
if (isset($_GET['register']) && $_GET['register'] === 'success') {
    $showSuccess = true;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Pelanggan - Marhaban Parfume</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
<!-- JavaScript SweetAlert2 jik ada yang berhasil registrasi-->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-to-br from-purple-100 to-white min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md border border-purple-200">
        <div class="text-center mb-6">
            <img src="./images/logo.png" alt="Marhaban Parfume" class="h-16 mx-auto mb-2">
            <h2 class="text-2xl font-bold text-gray-800">Login Pelanggan</h2>
            <p class="text-sm text-gray-500">Selamat datang kembali di Marhaban Parfume</p>
        </div>

        <!--notifikasi jika ada eror -->
        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm text-center">
                <strong>Login gagal!</strong> Email atau password salah.
            </div>
        <?php endif; ?>


        <form action="login_proses_pelanggan.php" method="post" class="space-y-4">
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" />
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" />
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-gray-600">
                    <input type="checkbox" name="remember" class="accent-purple-500">
                    Ingat Saya
                </label>
                <a href="lupa_password.php" class="text-[#099ea3] hover:underline">Lupa Password?</a>
            </div>

            <div>
                <input type="submit" value="Login"
                    class="w-full bg-[#099ea3] hover:bg-[#077c7f] text-white font-semibold py-2 rounded-lg transition duration-200 cursor-pointer" />
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">
            Belum punya akun?
            <a href="registrasi_pelanggan.php" class="text-[#099ea3] hover:underline">Daftar Sekarang</a>
        </p>
    </div>
        <!--menghilangkan  notif 4 detik-->
    <script>
    setTimeout(() => {
        const alert = document.querySelector('.bg-red-100');
        if (alert) alert.style.display = 'none';
    }, 4000); // hilang setelah 4 detik
</script>

 <!--jika ada yang berhasil registrasi -->

 <?php if ($showSuccess): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Selamat! Anda berhasil mendaftar.',
                confirmButtonColor: '#099ea3'
            });
        });
    </script>
    <?php endif; ?>


</body>

</html>