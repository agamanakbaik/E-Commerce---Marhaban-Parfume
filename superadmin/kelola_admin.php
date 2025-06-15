<?php
session_start();
require '../db.php'; // ganti path sesuai struktur folder

// Tambah Admin
if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
}

// Update Admin
if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    if ($password) {
        $stmt = $conn->prepare("UPDATE admin SET username=?, password=? WHERE id=?");
        $stmt->bind_param("ssi", $username, $password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE admin SET username=? WHERE id=?");
        $stmt->bind_param("si", $username, $id);
    }

    $stmt->execute();
}

// Hapus Admin
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM admin WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Ambil semua admin
$result = $conn->query("SELECT * FROM admin ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-6 text-center">Kelola Admin</h1>

        <!-- Form Tambah -->
        <form method="post" class="space-y-3 mb-8">
            <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 border rounded">
            <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 border rounded">
            <button type="submit" name="tambah" class="bg-green-500 text-white px-4 py-2 rounded">Tambah Admin</button>
        </form>

        <!-- Tabel Admin -->
        <table class="w-full text-sm table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">ID</th>
                    <th class="p-2">Username</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="border-t">
                    <form method="post">
                        <td class="p-2"><?= $row['id'] ?></td>
                        <td class="p-2">
                            <input type="text" name="username" value="<?= htmlspecialchars($row['username']) ?>" class="border px-2 py-1 w-full">
                        </td>
                        <td class="p-2 flex gap-2">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="password" name="password" placeholder="Ganti Password (opsional)" class="border px-2 py-1 w-44">
                            <button type="submit" name="ubah" class="bg-blue-500 text-white px-3 py-1 rounded">Ubah</button>
                            <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</a>
                        </td>
                    </form>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
