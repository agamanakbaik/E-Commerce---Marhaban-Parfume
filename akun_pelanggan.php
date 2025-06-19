<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akun Pelanggan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

  <div class="max-w-3xl mx-auto p-6 mt-10 bg-white rounded-lg shadow-md">
    <!-- Profil Pelanggan -->
    <div class="flex flex-col items-center">
      <img src="images/profil/default.png" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover border mb-2">
      <h2 class="text-2xl font-semibold">Nama Pelanggan</h2>
      <p class="text-gray-500">email@example.com</p>
    </div>

    <!-- Informasi Detail Akun -->
    <div class="mt-6 border-t pt-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="text-sm text-gray-600">Nama</p>
          <p class="font-medium">Nama Pelanggan</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Email</p>
          <p class="font-medium">email@example.com</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">No. Telepon</p>
          <p class="font-medium">08123456789</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Alamat</p>
          <p class="font-medium">Jl. Contoh No. 123, Kota, Provinsi</p>
        </div>
      </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-6 flex flex-col sm:flex-row gap-4">
      <a href="edit_profil.php" class="flex-1 block text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
        Edit Profil
      </a>
      <a href="logout.php" class="flex-1 block text-center bg-red-500 text-white py-2 rounded hover:bg-red-600">
        Logout
      </a>
    </div>

    <!-- Riwayat Pesanan -->
    <div class="mt-8">
      <h3 class="text-xl font-semibold mb-4">Riwayat Pesanan</h3>
      
      <!-- Jika belum ada pesanan -->
      <p class="text-gray-500">Anda belum memiliki pesanan.</p>

      <!-- Contoh list pesanan (aktifkan bila ada data) -->
      
      <ul class="space-y-4">
        <li class="border p-4 rounded">
          <div class="flex justify-between">
            <span class="font-medium">#12345</span>
            <span class="text-sm text-gray-500">15 Mei 2023</span>
          </div>
          <div class="mt-2">
            <p class="text-gray-700">Nama Produk: Produk A</p>
            <p class="text-gray-700">Jumlah: 2</p>
            <p class="text-gray-700">Status: Dikirim</p>
          </div>
        </li>
        <li class="border p-4 rounded">
          <div class="flex justify-between">
            <span class="font-medium">#67890</span>
            <span class="text-sm text-gray-500">10 Mei 2023</span>
          </div>
          <div class="mt-2">
            <p class="text-gray-700">Nama Produk: Produk B</p>
            <p class="text-gray-700">Jumlah: 1</p>
            <p class="text-gray-700">Status: Selesai</p>
          </div>
        </li>
      </ul>
     

    </div>
  </div>

</body>
</html>
