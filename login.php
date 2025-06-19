<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: halamanadmin.php");
    exit;
}

$showError = false;
if (isset($_GET['error']) && $_GET['error'] === '1') {
    $showError = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Marhaban Parfume</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-100 to-white min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md border border-purple-200">
        <div class="text-center mb-6">
            <img src="./images/logo.png" alt="Marhaban Parfume" class="h-16 mx-auto mb-2">
            <h2 class="text-2xl font-bold text-gray-800">Login Admin</h2>
            <p class="text-sm text-gray-500">Panel khusus untuk administrator</p>
        </div>

        <!--alert gagal login-->
        <?php if ($showError): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm text-center">
                <strong>Login gagal!</strong> Username atau password salah.
            </div>
        <?php endif; ?>

        <!-- proses login -->
        <form action="login_proses.php" method="post" class="space-y-4">
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Username</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600" />
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600" />
            </div>

            <div>
                <input type="submit" value="Login"
                    class="w-full bg-[#099ea3] hover:bg-[#077c7f] text-white font-semibold py-2 rounded-lg transition duration-200 cursor-pointer" />
            </div>
        </form>
    </div>

    <!-- menghilangkan alert 4 detik -->
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.bg-red-100');
            if (alert) alert.style.display = 'none';
        }, 4000);
    </script>

</body>
</html>
