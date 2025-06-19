<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$admin_username = mysqli_real_escape_string($conn, $_SESSION['admin']);

// Hapus foto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete_photo') {
    $admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT foto FROM admin WHERE username='$admin_username'"));
    $foto_path = $admin['foto'] ? 'images/profil/' . $admin['foto'] : '';

    if ($admin['foto'] && file_exists($foto_path) && $admin['foto'] !== 'profil_default.png') {
        unlink($foto_path);
    }

    mysqli_query($conn, "UPDATE admin SET foto=NULL WHERE username='$admin_username'");
    header('Location: akun_admin.php');
    exit;
}

// Update profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_profile') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $foto_sql = '';

    if (!empty($_FILES['foto']['name'])) {
        $file = time() . '_' . basename($_FILES['foto']['name']);
        if (move_uploaded_file($_FILES['foto']['tmp_name'], 'images/profil/' . $file)) {
            $foto_sql = ", foto='$file'";
        }
    }

    $sql = "UPDATE admin SET nama='$nama' $foto_sql WHERE username='$admin_username'";
    mysqli_query($conn, $sql);

    header('Location: akun_admin.php');
    exit;
}

// Ambil data admin
$result = mysqli_query($conn, "SELECT username, nama, foto FROM admin WHERE username='$admin_username'");
if (!$result || mysqli_num_rows($result) === 0) {
    die('Admin tidak ditemukan');
}
$row = mysqli_fetch_assoc($result);

$username = $row['username'];
$admin_nama = $row['nama'] ?: $row['username'];
$admin_foto = $row['foto'] ? 'images/profil/' . $row['foto'] : 'images/profil/profil_default.png';

// Hitung produk
function countByCat($c) {
    global $conn;
    $st = $conn->prepare("SELECT COUNT(*) t FROM products WHERE category_id=?");
    $st->bind_param('i', $c);
    $st->execute();
    return $st->get_result()->fetch_assoc()['t'] ?: 0;
}
$jb = countByCat(1);
$jo = countByCat(2);
$jp = countByCat(3);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akun Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="max-w-xl mx-auto p-6 mt-10 bg-white rounded-xl shadow-lg relative">
    <!-- Foto & Username -->
    <div class="flex flex-col items-center mb-4">
      <img src="<?= htmlspecialchars($admin_foto) ?>"
           alt="Foto Admin"
           class="w-24 h-24">
      <span class="text-gray-600">@<?= htmlspecialchars($username) ?></span>
    </div>

    <h2 class="text-2xl font-bold mb-2 text-center"><?= htmlspecialchars($admin_nama) ?></h2>

    <div class="bg-gray-50 p-4 rounded-lg shadow-inner mb-6">
      <h3 class="font-semibold mb-2">Jumlah Produk</h3>
      <ul class="list-disc pl-6 space-y-1 text-gray-800">
        <li>Bibit Parfume: <strong><?= $jb ?></strong></li>
        <li>Botol Parfume: <strong><?= $jo ?></strong></li>
        <li>Paket Usaha: <strong><?= $jp ?></strong></li>
      </ul>
    </div>

    <div class="space-y-3">
      <button id="openModalBtn"
              class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600">
        Edit Profil
      </button>
      <a href="halamanadmin.php"
         class="block w-full text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Kelola Produk
      </a>
      <a href="logout.php"
         class="block w-full text-center bg-red-600 text-white py-2 rounded hover:bg-red-700">
        Logout
      </a>
    </div>

    <!-- Modal -->
    <div id="backdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden"></div>
    <div id="modal" class="fixed inset-0 flex items-center justify-center p-4 hidden z-50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b">
          <h3 class="text-lg font-semibold">Edit Profil</h3>
        </div>
        <form method="POST" enctype="multipart/form-data" class="px-6 py-4 space-y-4">
          <input type="hidden" name="action" value="update_profile">
          <div class="flex flex-col items-center">
            <img src="<?= htmlspecialchars($admin_foto) ?>"
                 class="w-20 h-20 rounded-full object-cover border mb-2"
                 alt="Foto Admin">
          </div>
          <div>
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($admin_nama) ?>"
                   class="w-full border-gray-300 border rounded px-3 py-2" required>
          </div>
          <div>
            <label class="block mb-1 font-medium">Username</label>
            <input type="text" value="<?= htmlspecialchars($username) ?>" disabled
                   class="w-full border-gray-300 border rounded px-3 py-2 bg-gray-100">
          </div>
          <div>
            <label class="block mb-1 font-medium">Ganti Foto</label>
            <input type="file" name="foto" accept="image/*" class="w-full">
          </div>
          <div class="flex justify-between items-center pt-4 border-t">
            <div>
              <?php if ($row['foto'] && $row['foto'] !== 'profil_default.png'): ?>
                <form method="POST" onsubmit="return confirm('Yakin ingin menghapus foto profil?');">
                  <input type="hidden" name="action" value="delete_photo">
                  <button type="submit"
                          class="text-sm px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                    Hapus Foto
                  </button>
                </form>
              <?php endif; ?>
            </div>
            <div class="space-x-2">
              <button type="button" id="closeModalBtn"
                      class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                Batal
              </button>
              <button type="submit"
                      class="px-4 py-2 rounded bg-yellow-500 text-white hover:bg-yellow-600">
                Simpan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    let o = document.getElementById('openModalBtn'),
        c = document.getElementById('closeModalBtn'),
        m = document.getElementById('modal'),
        b = document.getElementById('backdrop');
    o.onclick = () => { m.classList.remove('hidden'); b.classList.remove('hidden'); };
    c.onclick = () => { m.classList.add('hidden'); b.classList.add('hidden'); };
    b.onclick = () => { m.classList.add('hidden'); b.classList.add('hidden'); };
  </script>
</body>
</html>
