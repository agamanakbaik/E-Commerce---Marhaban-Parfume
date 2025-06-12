<?php
session_start();

//Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
//Cegah browser menyimpan cache halaman admin
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">

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
            --primary-color: #6d28d9;
            --secondary-color: #8b5cf6;
            --accent-color: #a78bfa;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
        }

        .card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
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
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            bottom: -10px;
            left: 25%;
            border-radius: 3px;
        }

        .price-tag {
            background-color: var(--primary-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>


    <script>
        var isLoggedIn = <?= json_encode($loggedIn) ?>; // Kirim status login ke JavaScript
    </script>
    <script src="main.js"></script> <!-- Hubungkan file JS -->

    <!-- Main Container -->
    <div class="container-fluid px-0">
        <!-- navbar -->
    <nav class="bg-white shadow-md py-4 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="navbar-brand flex items-center">
                    <img src="./images/logo.png" alt="Foto Anda" class="h-12 w-12 mr-2">
                    <span>Marhaban Parfume</span> </a>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <!-- Wrapper/pembungkus -->
                <div class="relative inline-block">
                    <!-- Tombol -->
                    <button onclick="toggleDropdown()"
                        class="flex items-center gap-1 text-gray-700 font-medium hover:text-[#099ea3] transition">
                        Produk Kami
                        <i id="chevron"
                            class="fas fa-chevron-down text-xs mt-0.5 transition-transform duration-300"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu"
                        class="absolute left-0 hidden bg-white shadow-lg rounded-md mt-2 py-2 w-48 z-10">
                        <a href="index.php" class="block px-4 py-2 hover:bg-purple-100 text-gray-700 transition">Semua
                            Kategori</a>
                        <a href="index.php?category_id=1"
                            class="block px-4 py-2 hover:bg-purple-100 text-gray-700 transition">Bibit Parfume</a>
                        <a href="index.php?category_id=2"
                            class="block px-4 py-2 hover:bg-purple-100 text-gray-700 transition">Botol Parfume</a>
                        <a href="index.php?category_id=3"
                            class="block px-4 py-2 hover:bg-purple-100 text-gray-700 transition">Paket Usaha</a>
                    </div>
                </div>

                <!-- Script -->
                <script>
                    function toggleDropdown() {
                        const menu = document.getElementById('dropdownMenu');
                        const icon = document.getElementById('chevron');
                        menu.classList.toggle('hidden');
                        icon.classList.toggle('rotate-180');
                    }

                    // Optional: klik luar nutup menu
                    document.addEventListener('click', function (e) {
                        const btn = e.target.closest('button');
                        const menu = document.getElementById('dropdownMenu');
                        if (!e.target.closest('.relative')) {
                            menu.classList.add('hidden');
                            document.getElementById('chevron').classList.remove('rotate-180');
                        }
                    });
                </script>

                <a href="#tentangkami" class="nav-link">Tentang Kami</a>
                <a href="#caraorder" class="nav-link">Cara Order</a>

                <a href="keranjang.php" class="nav-link cart-icon">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="cart-count">0</span>
                </a>

                <!-- <div class="relative group">
                    <button class="flex items-center space-x-1">
                        <img src="https://ui-avatars.com/api/?name=User&background=6b46c1&color=fff"
                            class="w-8 h-8 rounded-full border-2 border-purple-200">
                    </button> 
                    <div
                        class="absolute right-0 hidden group-hover:block bg-white shadow-lg rounded-md mt-2 py-2 w-48 z-10">
                        <a href="#" class="block px-4 py-2 hover:bg-purple-50 text-gray-700">Akun Saya</a>
                        <a href="logout.php" class="block px-4 py-2 hover:bg-purple-50 text-gray-700">Logout</a>
                    </div>
                </div>
            </div>

            <button class="md:hidden text-gray-600 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>  -->
            </div>
    </nav>

   

        <!-- Main Content -->
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
                <a href="#products"
                    class="bg-white text-blue-700 px-6 py-3 rounded-full font-medium hover:bg-purple-50 transition duration-300">
                    Belanja Sekarang
                </a>
            </div>
        </div>
    </div>

            <!-- Search and Add Product -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" id="cari-list" placeholder="Cari produk...">
                </div>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fas fa-plus me-2"></i>Tambah Produk
                </button>
            </div>

            <!-- Products Section -->
            <div class="text-center mb-5">
                <h3 class="section-title">Our Collection</h3>
                <p class="text-muted w-75 mx-auto">
                    Toko Grosir Marhaban Perfume menjual berbagai aroma bibit parfum, botol parfum, perlengkapan racik
                    parfum, dll.
                    Wajib bertanya-tanya terlebih dahulu sebelum melakukan pengambilan barang agar kami cek ketersediaan
                    bahan
                    yang diinginkan.
                    <br>Jam Operasional: Senin - Sabtu 08:30-17:00
                </p>
            </div>

            <!-- Products Grid -->
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
                    $name = htmlspecialchars($row["name"]);
                    $description = htmlspecialchars($row["description"]);
                    $price = number_format($row["price"], 0, ',', '.');
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
                                            data-price='{$row['price']}'
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

            <!-- About Us Section -->
            <div id="tentangkami" class="bg-white p-5 rounded-3 shadow-sm mb-4">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        <img src="images/about-us.png" class="img-fluid" style="max-height: 150px;" alt="About Us">
                    </div>
                    <div class="col-md-9">
                        <h3 class="section-title">Tentang Kami</h3>
                        <p class="text-muted">
                            Marhaban Perfume telah berkarya sejak tahun 2017 dan didirikan oleh Bapak Syarif Salim
                            Bahanan. Kami
                            menyediakan berbagai jenis parfum berkualitas dan melayani pengiriman ke seluruh Indonesia.
                            Toko
                            kami berlokasi di Jl. Empang No.31B, Empang, Kota Bogor, Jawa Barat 16132.
                        </p>
                    </div>
                </div>
            </div>

            <!-- How to Order Section -->
            <div id="caraorder" class="bg-white p-5 rounded-3 shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-9 order-2 order-md-1">
                        <h3 class="section-title">Cara Order</h3>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem praesentium optio,
                            asperiores et
                            illum nam. Natus tempore ad sint eius deleniti autem aliquam nam adipisci atque quaerat
                            libero et
                            quisquam placeat deserunt, quae explicabo exercitationem voluptate nostrum facere ut error
                            quam
                            itaque dolorem! Exercitationem, sapiente in? Aliquam distinctio incidunt illo!
                        </p>
                    </div>
                    <div class="col-md-3 text-center order-1 order-md-2 mb-4 mb-md-0">
                        <img src="images/order.png" class="img-fluid" style="max-height: 150px;" alt="How to Order">
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-white py-4">
            <div class="container">
                <div class="text-center">
                    <p class="mb-0">&copy; 2025 Marhaban Perfume. - Pusat Grosir Parfume Berkualitas</p>
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
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_product.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Nama Produk"
                                    required>
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
                            <textarea id="description" name="description" class="form-control" rows="3"
                                placeholder="Deskripsi Produk"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="price" name="price" class="form-control"
                                        placeholder="Harga" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Gambar Produk</label>
                                <input type="file" id="image" name="image" class="form-control" required>
                            </div>
                        </div>

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
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-name" class="form-label">Nama Produk</label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-price" class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price" id="edit-price" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="edit-description" class="form-control" rows="3"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-image" class="form-label">Gambar Baru (Opsional)</label>
                        <input type="file" name="image" id="edit-image" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                    </div>
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

    <!-- Product Detail Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="productDetailModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <img id="detailImage" src="" class="img-fluid rounded" alt="Product Image">
                    </div>
                    <div class="col-md-6">
                        <h3 id="detailTitle" class="mb-3"></h3>
                        <div id="detailDescription" class="mb-4 text-muted"></div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span id="detailPrice" class="price-tag"></span>
                            <a href="#" target="_blank" class="btn btn-primary">
                                <i class="fas fa-shopping-cart me-1"></i> Beli Sekarang
                            </a>
                        </div>
                        <a href="#" class="text-primary">
                            <i class="fas fa-cart-plus me-1"></i> Tambahkan ke keranjang
                        </a>
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
        $(document).ready(function () {
            $('.btnDetail').click(function () {
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

            // Live Search
            $('#cari-list').on('keyup', function () {
                const keyword = $(this).val().toLowerCase();
                $('.product-item').each(function () {
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
            $('.btnDelete').click(function (e) {
                e.preventDefault();

                if (!confirm("Yakin ingin menghapus produk ini?")) {
                    return;
                }

                const productId = $(this).data('id');

                $.ajax({
                    url: 'delete_product.php',
                    type: 'POST',
                    data: { id: productId },
                    success: function (response) {
                        if (response.trim() === 'success') {
                            alert("Produk berhasil dihapus.");
                            location.reload();
                        } else {
                            alert("Gagal menghapus: " + response);
                        }
                    },
                    error: function () {
                        alert("Terjadi kesalahan saat menghapus.");
                    }
                });
            });

            // Edit Product Modal Handler
            $('.btnEdit').click(function () {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const description = $(this).data('description');
                const price = $(this).data('price');

                $('#edit-id').val(id);
                $('#edit-name').val(name);
                $('#edit-description').val(description);
                $('#edit-price').val(price);
            });
        });
    </script>
</body>

</html>