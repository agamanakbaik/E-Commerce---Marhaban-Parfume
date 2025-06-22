<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$admin_username = mysqli_real_escape_string($conn, $_SESSION['admin']);
$admin_foto = 'images/profil/profil_default.png'; // Gunakan foto default

// Ambil varian untuk ditampilkan di modal edit
$variantMap = [];
$variantResult = mysqli_query($conn, "SELECT * FROM product_variants");
while ($v = mysqli_fetch_assoc($variantResult)) {
    $variantMap[$v['product_id']][] = $v;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Marhaban Parfume</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary-color: rgb(31, 92, 184);
            --secondary-color: #6366f1;
            --accent-color: #818cf8;
            --dark-color: #111827;
            --light-color: #f9fafb;
            --gold-accent: #f59e0b;
            --gradient-1: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-color);
            line-height: 1.6;
        }

        .card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            background: white;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .navbar-brand {
            font-weight: 700;
            color: #4a5568(--primary-color);
        }

        .btn-primary {
            background: var(--gradient-1);
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15pxr rgb(31, 92, 184);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgb(31, 92, 184);
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: var(--gradient-1);
            color: white;
            border-bottom: none;
            padding: 20px 24px;
            border-radius: 10px 10px 0 0 !important;
        }

        .modal-title {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .modal-content {
            border: none;
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .search-box {
            position: relative;
            max-width: 300px;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #64748b;
        }

        .search-box input {
            padding-left: 40px;
            border-radius: 50px;
            border: 1px solid #e2e8f0;
        }

        .banner {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--dark-color);
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 40px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--gold-accent));
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 4px;
        }

        .price-tag {
            background: var(--gradient-1);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: inline-block;
            min-width: 80px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .tentangkami {
            font-weight: 500;
            color: #4a5568;
            transition: all 0.3s ease;
        }

        .tentangkami:hover {
            color: #099ea3;
            ;
        }

        .produkami {
            font-weight: 500;
            color: #4a5568;
            transition: all 0.3s ease;
        }

        .produkami:hover {
            color: #099ea3;
            ;
        }
    </style>
</head>

<body>

    <!-- Main Container/pembungkus utama -->
    <div class="container-fluid px-0">

        <!-- navbar -->
        <nav class="bg-white shadow-md py-2 px-6 sticky top-0 z-50 lg:px-12">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center">
                    <a href="#" class="navbar-brand flex items-center hover:text-gray-800">
                        <img src="images/logo.png" alt="Foto Anda" class="h-12 w-12 mr-2">
                        <span>Marhaban Parfume</span> </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">

                    <!-- Wrapper/pembungkus -->
                    <div class="relative inline-block">

                        <!-- Tombol -->
                        <button onclick="toggleDropdown()" class="flex items-center gap-1 produkami">
                            Produk Kami
                            <i id="chevron"
                                class="fas fa-chevron-down text-xs mt-0.5 transition-transform duration-300"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdownMenu"
                            class="absolute left-0 hidden bg-white shadow-lg rounded-md mt-2 py-2 w-48 z-10">
                            <a href="halamanadmin.php"
                                class="block px-4 py-2 hover:text-[#099ea3] text-gray-700 transition">Semua
                                Kategori</a>
                            <a href="halamanadmin.php?category_id=1"
                                class="block px-4 py-2 hover:text-[#099ea3] text-gray-700 transition">Bibit Parfume</a>
                            <a href="halamanadmin.php?category_id=2"
                                class="block px-4 py-2 hover:text-[#099ea3] text-gray-700 transition">Botol Parfume</a>
                            <a href="halamanadmin.php?category_id=3"
                                class="block px-4 py-2 hover:text-[#099ea3] text-gray-700 transition">Paket Usaha</a>
                        </div>
                    </div>

                    <!-- Script  dropdown menu-->
                    <script>
                        function toggleDropdown() {
                            const menu = document.getElementById('dropdownMenu');
                            const icon = document.getElementById('chevron');
                            menu.classList.toggle('hidden');
                            icon.classList.toggle('rotate-180');
                        }

                        // Optional: klik luar nutup menu
                        document.addEventListener('click', function(e) {
                            const btn = e.target.closest('button');
                            const menu = document.getElementById('dropdownMenu');
                            if (!e.target.closest('.relative')) {
                                menu.classList.add('hidden');
                                document.getElementById('chevron').classList.remove('rotate-180');
                            }
                        });
                    </script>

                    <!-- pencarian -->
                    <div class="relative">
                        <input type="text" id="cari-list" placeholder="Cari produk..."
                            class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#099ea3] focus:border-transparent">
                        <!-- ikon pencarian bisa di klik -->
                        <button onclick="document.getElementById('cari-list').focus()"
                            class="absolute right-3 top-2.5 text-gray-300 hover:text-[#077c7f]">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <!-- buat ngatur profil -->
                    <div class="btn-group">
                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            class="w-10 h-10 transition duration-200" style="margin-bottom: 7px;">
                            <img src="<?= htmlspecialchars($admin_foto) ?>" alt="Profil"
                                class="w-10 h-10 object-cover rounded-full">
                        </button>
                        <!-- dropdown menu -->
                        <ul class="dropdown-menu shadow-lg rounded-lg overflow-hidden">
                            <li class="hover:bg-gray-100 transition-colors duration-200">
                                <a class="dropdown-item flex items-center gap-2 py-2 px-3 hover:bg-gray-50"
                                    href="akun_admin.php">
                                    <img src="<?= htmlspecialchars($admin_foto) ?>" alt="Profil"
                                        class="w-10 h-10 object-contain rounded-full">
                                    <span>Akun Saya</span>
                                </a>
                            </li>
                            <li class="hover:bg-gray-100 transition-colors duration-200">
                                <a class="dropdown-item py-2 px-3 text-red-600 hover:text-red-800 hover:bg-red-50"
                                    href="logout.php">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content/konten utama -->
        <div class="container my-4">

            <!-- Banner -->
            <div class="relative">
                <div class="w-full h-96 overflow-hidden">
                    <img src="images/banner_marhaban.png" alt="Marhaban Parfume" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-transparent opacity-75"></div>
                <div class="absolute inset-0 flex items-center px-6 lg:px-12">
                    <div class="max-w-2xl">
                        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Koleksi Parfume Berkualitas</h1>
                        <p class="text-lg text-white mb-6">Temukan aroma yang sempurna untuk setiap kesempatan</p>
                        <a href="#cari-list"
                            class="bg-white text-blue-700 px-6 py-3 rounded-full font-medium hover:bg-gray-800 transition duration-300">
                            Kelola Produk
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <!--penjelasan produk -->
            <div class="text-center mb-5">
                <h3 class="section-title">Koleksi Kami</h3>
                <p class="text-muted w-75 mx-auto">
                    Toko Grosir Marhaban Perfume menjual berbagai aroma bibit parfum, botol parfum, perlengkapan racik
                    parfum, dll.
                    Wajib bertanya-tanya terlebih dahulu sebelum melakukan pengambilan barang agar kami cek ketersediaan
                    bahan
                    yang diinginkan.
                    <br>Jam Operasional: Senin - Sabtu 08:30-17:00
                </p>
            </div>

            <!-- tambah produk -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fas fa-plus me-2"></i>Tambah Produk
            </button>
        </div>

        <!-- produk Grid -->
        <div id="kumpulan_katalog" class="row g-4">
            <?php
            include 'db.php';

            if (!$conn) {
                die("Koneksi database gagal: " . mysqli_connect_error());
            }

            if (isset($_GET['category_id'])) {
                $category_id = intval($_GET['category_id']);
                $result = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id");
            } else {
                $result = mysqli_query($conn, "SELECT * FROM products");
            }

            if (!$result) {
                die("Query error: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['id'];
                // Ambil varian termurah
                $variant_result = mysqli_query($conn, "SELECT MIN(price) as min_price FROM product_variants WHERE product_id = $product_id");
                $variant_data = mysqli_fetch_assoc($variant_result);
                $price = $variant_data ? number_format($variant_data['min_price'], 0, ',', '.') : '-';

                $name = htmlspecialchars($row["name"]);
                $description = htmlspecialchars($row["description"]);
                $image = !empty($row["image"]) ? "images/" . $row["image"] : "images/no-image.jpg";

                echo "
                    <div class='col-md-3 col-sm-6 col-12 product-item' data-name='$name' data-description='$description'>
                        <div class='card h-100'>
                            <!-- Gambar responsif dan tidak terpotong -->
                            <img src='$image' class=' rounded-xl img-fluid object-fit-contain' style='object-fit: cover;' alt='$name'>
                            <div class='card-body'>
                                <h5 class='card-title'>$name</h5>
                                <div class='d-none deskripsi'>
                                    <p class='card-text text-muted'>$description</p>
                                </div>
                            </div>
                            <div class='card-footer bg-transparent border-top-0'>
                                <div class='d-flex justify-content-between align-items-center'>
                                    <span class='price-tag'>Rp $price</span>
                                    <div class='btn-group'>
                                        <button class='btn btn-sm btn-outline-primary btnDetail'>
                                            <i class='fas fa-eye'></i>
                                        </button>
                                        <button class='btn btn-sm btn-outline-success btnEdit'
                                            data-bs-toggle='modal' data-bs-target='#editProductModal'
                                            data-id='{$row['id']}'
                                            data-name='" . htmlspecialchars($row['name']) . "'
                                            data-description='" . htmlspecialchars($row['description']) . "'
                                            data-image='{$row['image']}'>
                                            <i class='fas fa-edit'></i>
                                        </button>
                                        <button class='btn btn-sm btn-outline-danger btnDelete' data-id='{$row['id']}'>
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
            ?>
        </div>
        <br>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-8 px-6 lg:px-12">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">Marhaban Parfume</h3>
                        <p class="text-gray-400">Pusat Grosir Parfume Berkualitas sejak 2017</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Kontak Kami</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <i class="fas fa-phone-alt mr-2 text-green-400"></i>
                                <span>+62 895-1017-5754</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-2 text-white-400"></i>
                                <span>info@marhabanparfume.com</span>
                            </li>
                            <a href="https://www.google.com/maps/place/Marhaban+Parfum/@-6.606362,106.7926423,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69c5d18c750557:0x8c2366fb253444ed!8m2!3d-6.606362!4d106.7952172!16s%2Fg%2F11mg9qzsd8?entry=ttu&g_ep=EgoyMDI1MDYxMS4wIKXMDSoASAFQAw%3D%3D"
                                target="_blank" class="block">
                                <li class="flex items-center hover:underline text-white">
                                    <i class="fas fa-map-marker-alt mr-2 text-red-400"></i>
                                    <span>Jl. Empang No.31B, Bogor</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Ikuti Kami</h3>
                        <div class="flex space-x-4">
                            <a href="https://web.facebook.com/marhabanperfumeofficial" target="blank"
                                class="bg-[#1877F2] w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#155FCB] transition">
                                <i class="fab fa-facebook-f text-white"></i>
                            </a>
                            <a target="_blank"
                                href="https://www.instagram.com/marhabanparfum?utm_source=ig_web_button_share_sheet&igsh=MXBkYzMyNzliMWZlYw=="
                                class="bg-[#E1306C] w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#C72E65] transition">
                                <i class="fab fa-instagram text-white"></i>
                            </a>
                            <a href="https://wa.me/6289510175754" target="_blank"
                                class="bg-[#25D366] w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#1DA851] transition">
                                <i class="fab fa-whatsapp text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2025 Marhaban Perfume. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addProductModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Produk Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form action="add_product.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Nama Produk" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php
                                    include 'db.php';
                                    $result = mysqli_query($conn, "SELECT * FROM categories");
                                    while ($cat = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Produk</label>
                            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Deskripsi Produk"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Gambar Produk</label>
                                <input type="file" id="image" name="image" class="form-control" required>
                            </div>
                        </div>

                        <hr>
                        <h6 class="fw-bold mt-3 mb-2">Varian Ukuran & Harga</h6>
                        <div id="variant-container">
                            <div class="row g-2 mb-2 variant-row">
                                <div class="col-md-4">
                                    <input type="text" name="variant_size[]" class="form-control" placeholder="Ukuran (contoh: 30ml)" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="variant_price[]" class="form-control" placeholder="Harga" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="variant_stock[]" class="form-control" placeholder="Stok" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger btn-sm remove-variant"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="add-variant"><i class="fas fa-plus me-1"></i> Tambah Varian</button>

                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="update_product.php" method="POST" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Edit Produk
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nama Produk</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="edit-description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit-category" class="form-label">Kategori</label>
                        <select name="category_id" id="edit-category" class="form-select" required>
                            <?php
                            $catResult = mysqli_query($conn, "SELECT * FROM categories");
                            while ($cat = mysqli_fetch_assoc($catResult)) {
                                echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-image" class="form-label">Gambar Baru (opsional)</label>
                        <input type="file" name="image" id="edit-image" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                    </div>

                    <hr>
                    <h6 class="fw-bold mb-2">Varian Ukuran & Harga</h6>
                    <div id="existing-variants"></div>

                    <div id="edit-variant-container">
                        <div class="row g-2 mb-2 variant-row">
                            <div class="col-md-4">
                                <input type="text" name="new_variant_size[]" class="form-control" placeholder="Ukuran (contoh: 30ml)">
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="new_variant_price[]" class="form-control" placeholder="Harga">
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="new_variant_stock[]" class="form-control" placeholder="Stok">
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <button type="button" class="btn btn-danger btn-sm remove-variant"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="add-edit-variant"><i class="fas fa-plus me-1"></i> Tambah Varian Baru</button>
                </div>

                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- modal detail produk -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="productDetailModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <img id="detailImage" src="" class="img-fluid rounded" alt="Gambar Produk">
                    </div>
                    <div class="col-md-6">
                        <h3 id="detailTitle" class="mb-3"></h3>
                        <div id="detailDescription" class="mb-4 text-muted"></div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span id="detailPrice" class="price-tag"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Product Detail Modal Handler
        $(document).ready(function() {
            $('.btnDetail').click(function() {
                const card = $(this).closest('.card');
                const title = card.find('.card-title').text();
                const description = card.find('.deskripsi p').text();
                const price = card.find('.price-tag').text();
                const imageSrc = card.find('img').attr('src');

                $('#detailTitle').text(title);
                $('#detailDescription').text(description);
                $('#detailPrice').text(price);
                $('#detailImage').attr('src', imageSrc);

                $('#productDetailModal').modal('show');
            });

            // Live Search / Pencarian Langsung
            $('#cari-list').on('keyup', function() {
                const keyword = $(this).val().toLowerCase();
                $('.product-item').each(function() {
                    const name = $(this).data('name').toLowerCase();
                    const description = $(this).data('description').toLowerCase();

                    if (name.includes(keyword) || description.includes(keyword)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Delete Product Confirmation
            $('.btnDelete').click(function(e) {
                e.preventDefault();

                if (!confirm("Yakin ingin menghapus produk ini?")) {
                    return;
                }

                const productId = $(this).data('id');

                $.ajax({
                    url: 'delete_product.php',
                    type: 'POST',
                    data: {
                        id: productId
                    },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            alert("Produk berhasil dihapus.");
                            location.reload();
                        } else {
                            alert("Gagal menghapus: " + response);
                        }
                    },
                    error: function() {
                        alert("Terjadi kesalahan saat menghapus.");
                    }
                });
            });

            // Edit Product Modal Handler
            $('.btnEdit').click(function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const description = $(this).data('description');
                const category = $(this).data('category');
                $('#edit-id').val(id);
                $('#edit-name').val(name);
                $('#edit-description').val(description);
                $('#edit-category').val(category);

                // Muat varian via Ajax
                $.getJSON('get_variants.php', {
                    product_id: id
                }, function(variants) {
                    const container = $('#existing-variants');
                    container.empty();
                    variants.forEach(v => {
                        container.append(`
                            <div class="row g-2 mb-2 align-items-center existing-variant-row">
                                <input type="hidden" name="existing_variant_id[]" value="${v.id}">
                                <div class="col-md-4">
                                    <input type="text" name="existing_variant_size[]" class="form-control" value="${v.size}" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="existing_variant_price[]" class="form-control" value="${v.price}" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="existing_variant_stock[]" class="form-control" value="${v.stock}" required>
                                </div>
                                <div class="col-md-2 text-end">
                                    <input type="checkbox" name="delete_variants[]" value="${v.id}"> Hapus
                                </div>
                            </div>`);
                    });
                });
            });

            // Tambah varian baru di modal edit
            $('#add-edit-variant').click(function() {
                const newRow = `
                    <div class="row g-2 mb-2 variant-row">
                        <div class="col-md-4">
                            <input type="text" name="new_variant_size[]" class="form-control" placeholder="Ukuran">
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="new_variant_price[]" class="form-control" placeholder="Harga">
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="new_variant_stock[]" class="form-control" placeholder="Stok">
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm remove-variant"><i class="fas fa-times"></i></button>
                        </div>
                    </div>`;
                $('#edit-variant-container').append(newRow);
            });

            // Hapus baris varian baru (belum disimpan)
            $('#edit-variant-container').on('click', '.remove-variant', function() {
                $(this).closest('.variant-row').remove();
            });

            //ketika tombol pencarian di klik/di cari produknya, langsung ngeredirect ke produk yang di cari
            function scrollToTombol() {
                document.getElementById('kumpulan_katalog').scrollIntoView({
                    behavior: 'smooth'
                });
            }

            function focusAndScroll() {
                const input = document.getElementById('cari-list');
                input.focus();
                scrollToTombol();
            }
            //trigger scroll juga saat user mulai ngetik
            document.getElementById('cari-list').addEventListener('input', scrollToTombol);

            // Tambah varian di modal tambah produk
            $('#add-variant').click(function() {
                const newRow = `
                    <div class="row g-2 mb-2 variant-row">
                        <div class="col-md-4">
                            <input type="text" name="variant_size[]" class="form-control" placeholder="Ukuran (contoh: 30ml)" required>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="variant_price[]" class="form-control" placeholder="Harga" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="variant_stock[]" class="form-control" placeholder="Stok" required>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm remove-variant"><i class="fas fa-times"></i></button>
                        </div>
                    </div>`;
                $('#variant-container').append(newRow);
            });

            // Hapus varian di modal tambah produk
            $('#variant-container').on('click', '.remove-variant', function() {
                $(this).closest('.variant-row').remove();
            });
        });
    </script>
</body>

</html>