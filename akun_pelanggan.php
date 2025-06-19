<?php
session_start();
require 'db.php';

if (!isset($_SESSION['pelanggan_id'])) {
    header("Location: loginpelanggan.php");
    exit;
}

$id = $_SESSION['pelanggan_id'];
$default_foto = 'profil_default.png';

// Ambil data awal pelanggan
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = $id"));
$foto = 'images/profil/' . ($data['foto'] ?: $default_foto);

// Tangani form update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update') {
    $nama = $_POST['nama'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $password_baru = $_POST['password_baru'] ?? '';
    $konfirmasi = $_POST['konfirmasi_password'] ?? '';
    $password_sql = "";
    $foto_sql = "";

    // Password baru
    if (!empty($password_baru)) {
        if ($password_baru === $konfirmasi) {
            $hash = password_hash($password_baru, PASSWORD_DEFAULT);
            $password_sql = ", password='$hash'";
        } else {
            echo "<script>alert('Konfirmasi password tidak cocok!');</script>";
        }
    }

    // Hapus foto
    if (isset($_POST['hapus_foto']) && $data['foto'] !== $default_foto) {
        $foto_path = 'images/profil/' . $data['foto'];
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }
        $foto_sql = ", foto='$default_foto'";
    }

    // Upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $size = $_FILES['foto']['size'];
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $nama_file = time() . '_' . basename($_FILES['foto']['name']);
            $target = "images/profil/" . $nama_file;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
                if ($data['foto'] !== $default_foto) {
                    $lama = 'images/profil/' . $data['foto'];
                    if (file_exists($lama)) {
                        unlink($lama);
                    }
                }
                $foto_sql = ", foto='$nama_file'";
            }
        }
    }

    // Update DB
    $sql = "UPDATE pelanggan SET nama=?, telepon=?, alamat=?$password_sql$foto_sql WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $telepon, $alamat, $id);


    //logika buat allert
    if (mysqli_stmt_execute($stmt)) {
    header("Location: akun_pelanggan.php?status=sukses");
    exit;
} else {
    header("Location: akun_pelanggan.php?status=gagal");
    exit;
}

}

// Ambil ulang data terbaru
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = $id"));
$foto = 'images/profil/' . ($data['foto'] ?: $default_foto);

// var_dump($data['foto']);
// var_dump($default_foto);
// var_dump($foto);
// var_dump(file_exists($foto));
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akun Pelanggan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="max-w-3xl mx-auto p-6 mt-10 bg-white rounded-lg shadow-md">
    <div class="flex flex-col items-center">
      <img id="previewFoto" src="<?= $foto ?>" alt="Foto Profil"
           class="w-24 h-24 rounded-full object-cover border mb-2">
      <h2 class="text-2xl font-semibold"><?= htmlspecialchars($data['nama'] ?: '-') ?></h2>
      <p class="text-gray-500"><?= htmlspecialchars($data['email']) ?></p>
    </div>

    <div class="mt-6 border-t pt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <p class="text-sm text-gray-600">Nama</p>
        <p class="font-medium"><?= htmlspecialchars($data['nama']) ?></p>
      </div>
      <div>
        <p class="text-sm text-gray-600">No. Telepon</p>
        <p class="font-medium"><?= htmlspecialchars($data['telepon']) ?></p>
      </div>
      <div>
        <p class="text-sm text-gray-600">Alamat</p>
        <p class="font-medium"><?= htmlspecialchars($data['alamat']) ?></p>
      </div>
    </div>

    <div class="mt-6 flex flex-col sm:flex-row gap-4">
      <button onclick="openModal()"
              class="flex-1 bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
        Edit Profil
      </button>
      <a href="halamanpelanggan.php"
         class="flex-1 text-center bg-green-500 text-white py-2 rounded hover:bg-green-600">
        kembali
      </a>
    </div>
  </div>

  <!-- Modal Edit -->
  <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden"></div>
  <div id="modal" class="fixed inset-0 flex items-center justify-center p-4 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md overflow-hidden">
      <form method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
        <input type="hidden" name="action" value="update">
        <h3 class="text-xl font-semibold text-center">Edit Profil</h3>
        
        <div class="space-y-3">
    <label class="block text-sm font-medium text-gray-700">Foto Profil</label>

    <input type="file" name="foto" accept="image/*" onchange="previewImage(event)"
        class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 
               file:rounded file:border-0 file:text-sm file:font-semibold 
               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition"/>

    <?php if ($data['foto'] !== $default_foto): ?>
        <button type="submit" name="hapus_foto" value="1"
            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
            Hapus Foto Profil
        </button>
    <?php endif; ?>
</div>


        <div>
          <label class="block text-sm font-medium">Nama</label>
          <input type="text" name="nama" class="w-full border px-3 py-2 rounded"
                 value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>

        <div>
          <label class="block text-sm font-medium">No. Telepon</label>
          <input type="text" name="telepon" class="w-full border px-3 py-2 rounded"
                 value="<?= htmlspecialchars($data['telepon']) ?>" required>
        </div>

        <div>
          <label class="block text-sm font-medium">Alamat</label>
          <textarea name="alamat" class="w-full border px-3 py-2 rounded" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>

        <div>
          <label class="block text-sm font-medium">Password Baru</label>
          <input type="password" name="password_baru" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
          <label class="block text-sm font-medium">Konfirmasi Password</label>
          <input type="password" name="konfirmasi_password" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex justify-end gap-2 pt-2">
          <button type="button" onclick="closeModal()"
                  class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
          <button type="submit"
                  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById('modal').classList.remove('hidden');
      document.getElementById('modalBackdrop').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
      document.getElementById('modalBackdrop').classList.add('hidden');
    }

    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function () {
        const output = document.getElementById('previewFoto');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    //kalo datanya kosong, tidak bisa klik tombol simpan
    function openModal() {
  document.getElementById('modal').classList.remove('hidden');
  document.getElementById('modalBackdrop').classList.remove('hidden');

  // Ambil data dari tampilan
  const nama = "<?= htmlspecialchars($data['nama']) ?>";
  const telepon = "<?= htmlspecialchars($data['telepon']) ?>";
  const alamat = `<?= htmlspecialchars($data['alamat']) ?>`;

  document.querySelector('[name="nama"]').value = nama;
  document.querySelector('[name="telepon"]').value = telepon;
  document.querySelector('[name="alamat"]').value = alamat;
}

  </script>

  <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  const urlParams = new URLSearchParams(window.location.search);
  const status = urlParams.get('status');

  if (status === 'sukses') {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: 'Data berhasil diperbarui.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'OK'
    }).then(() => {
      window.history.replaceState({}, document.title, window.location.pathname);
    });
  }

  if (status === 'gagal') {
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: 'Terjadi kesalahan saat memperbarui data.',
      confirmButtonColor: '#d33',
      confirmButtonText: 'Tutup'
    }).then(() => {
      window.history.replaceState({}, document.title, window.location.pathname);
    });
  }
</script>

</body>
</html>
