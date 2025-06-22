<?php
session_start();
if (!isset($_SESSION['pelanggan'])) {
    header("Location: loginpelanggan.php");
    exit;
}

include 'db.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marhaban Parfume - Pusat Grosir Parfume Berkualitas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #4a5568;
        }

        .nav-link {
            font-weight: 500;
            color: #4a5568;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #099ea3;
        }

        .dropdown-item:hover {
            background-color: #f3e8ff;
            color: #099ea3;
        }

        .product-card {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: auto;
            object-fit: contain;
            aspect-ratio: 4 / 3;
        }

        .price-tag {
            font-weight: 600;
            color: #099ea3;
        }

        .detail-btn {
            background-color: #099ea3;
            color: white;
            transition: all 0.3s ease;
        }

        .detail-btn:hover {
            background-color: rgb(31, 92, 184);
            color: white;
        }

        .search-box {
            border-radius: 2rem;
            padding: 0.5rem 1.5rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .search-box:focus {
            outline: none;
            border-color: rgb(70, 158, 193);
            box-shadow: 0 0 0 3px rgba(107, 70, 193, 0.1);
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background: linear-gradient(to right, rgb(20, 185, 226), rgb(122, 180, 234));
            bottom: -10px;
            left: 25%;
            border-radius: 3px;
        }

        .about-section,
        .order-section {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            color: #1f2937;
        }

        .modal-content {
            border-radius: 1rem;
            overflow: hidden;
        }

        .modal-image {
            max-height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 0.5rem;
        }

        .buy-btn {
            background-color: rgb(37, 99, 235);
            color: white;
            transition: all 0.3s ease;
        }

        .buy-btn:hover {
            background-color: rgb(31, 92, 184);
            color: white;
        }

        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .floating-whatsapp {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .floating-whatsapp:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .variant-btn {
            transition: all 0.2s ease;
        }

        .variant-btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <!-- Alert Message -->
    <?php if (isset($_SESSION['message'])): ?>
        <div id="alert-box" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 transition-opacity duration-500 ease-out" role="alert">
            <span class="block sm:inline"><?= $_SESSION['message'] ?></span>
            <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Tutup</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('alert-box');
                if (alert) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 1000);
                }
            }, 3000);
        </script>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-2 px-6 sticky top-0 z-50 lg:px-12">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="navbar-brand flex items-center">
                    <img src="./images/logo.png" alt="Logo" class="h-12 w-12 mr-2">
                    <span>Marhaban Parfume</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <div class="relative inline-block">
                    <button onclick="toggleDropdown()" class="flex items-center gap-1 text-gray-700 font-medium hover:text-[#099ea3] transition">
                        Produk Kami
                        <i id="chevron" class="fas fa-chevron-down text-xs mt-0.5 transition-transform duration-300"></i>
                    </button>

                    <div id="dropdownMenu" class="absolute left-0 hidden bg-white shadow-lg rounded-md mt-2 py-2 w-48 z-10">
                        <a href="halamanpelanggan.php" class="block px-4 py-2 hover:bg-purple-100 text-gray-700 transition">Semua Kategori</a>
                        <a href="halamanpelanggan.php?category_id=1" class="block px-4 py-2 hover:bg-purple-100 text-gray-700 transition">Bibit Parfume</a>
                        <a href="halamanpelanggan.php?category_id=2" class="block px-4 py-2 hover:bg-purple-100 text-gray-700 transition">Botol Parfume</a>
                        <a href="halamanpelanggan.php?category_id=3" class="block px-4 py-2 hover:bg-purple-100 text-gray-700 transition">Paket Usaha</a>
                    </div>
                </div>

                <a href="#tentangkami" class="nav-link">Tentang Kami</a>
                <a href="#caraorder" class="nav-link">Cara Order</a>

                <a href="keranjang.php" class="flex items-center space-x-1 text-gray-700 hover:text-gray-900">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="text-base font-semibold">
                        <?php
                        $cart_count = 0;
                        if (isset($_SESSION['pelanggan']) && is_array($_SESSION['pelanggan']) && isset($_SESSION['pelanggan']['id'])) {
                            $user_id = intval($_SESSION['pelanggan']['id']);
                            $query = "SELECT SUM(quantity) as total FROM cart WHERE user_id = $user_id";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $cart_count = $row['total'] ?? 0;
                            }
                        }
                        echo $cart_count;
                        ?>
                    </span>
                </a>

                <!-- Profil Pengguna -->
                <div class="btn-group">
                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="w-10 h-10 transition duration-200" style="margin-bottom: 7px;">
                        <img src="images/profil/profil_default.png" alt="Profil" class="w-10 h-10 object-cover rounded-full">
                    </button>
                    <!-- dropdown menu -->
                    <ul class="dropdown-menu shadow-lg rounded-lg overflow-hidden">
                        <li class="hover:bg-gray-100 transition-colors duration-200">
                            <a class="dropdown-item flex items-center gap-2 py-2 px-3 hover:bg-gray-50" href="akun_pelanggan.php">
                                <img src="images/profil/profil_default.png" alt="Profil" class="w-10 h-10 object-contain rounded-full">
                                <span>Akun Saya</span>
                            </a>
                        </li>
                        <li class="hover:bg-gray-100 transition-colors duration-200">
                            <a class="dropdown-item py-2 px-3 text-red-600 hover:text-red-800 hover:bg-red-50" href="logout.php">
                                <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

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
                <a href="#products" class="bg-white text-blue-700 px-6 py-3 rounded-full font-medium hover:bg-purple-50 transition duration-300">
                    Belanja Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <section id="products" class="py-12 px-6 lg:px-12 max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="section-title text-3xl font-bold text-gray-800">Koleksi Kami</h2>
            <p class="max-w-2xl mx-auto text-gray-600 mt-4">
                Toko Grosir Marhaban Perfume menjual berbagai aroma bibit parfum, botol parfum, perlengkapan racik
                parfum, dll.
                Diharapkan bertanya terlebih dahulu sebelum melakukan pemesanan agar kami bisa cek ketersediaan stok.
                <br>Jam Operasional: Senin - Sabtu 08:30-17:00
            </p>
        </div>

        <!-- Pencarian -->
        <div id="sesi-list" class="flex justify-end mb-8">
            <div class="relative w-full md:w-1/3 max-w-md">
                <input type="text" id="cari-list" placeholder="Cari produk..." class="search-box w-full pl-10 pr-5 py-3 focus:outline-none text-gray-800 hover:text-black-700 focus:ring-1 focus:ring-[#077c7f] rounded-lg border border-gray-300">

                <!-- Ikon pencarian -->
                <button onclick="document.getElementById('cari-list').focus()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-[#077c7f]">
                    <i class="fas fa-search text-base"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="product-container">
            <?php
            if (isset($_GET['category_id'])) {
                $category_id = $_GET["category_id"];
                $result = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id");
            } else {
                $result = mysqli_query($conn, "SELECT * FROM products");
            }

            if (!$result) {
                die("Query error: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $id = htmlspecialchars($row["id"]);
                $name = htmlspecialchars($row["name"]);
                $description = htmlspecialchars($row["description"]);
                $image = !empty($row["image"]) ? "images/" . $row["image"] : "images/no-image.jpg";
                $category_id = htmlspecialchars($row["category_id"]);

                // Ambil harga terendah dari varian
                $variant_query = "SELECT MIN(price) as min_price FROM product_variants WHERE product_id = $id";
                $variant_result = mysqli_query($conn, $variant_query);
                $variant_data = mysqli_fetch_assoc($variant_result);
                $min_price = $variant_data['min_price'] ? number_format($variant_data['min_price'], 0, ',', '.') : '0';

                echo "
                <div class='product-card bg-white rounded-xl overflow-hidden shadow-md product-item' 
                     data-name='$name' 
                     data-description='$description'
                     data-category='$category_id'>
                    <input type='hidden' value='$id'>
                    <div>
                        <img src='$image' style='max-height: 100%; max-width: 100%; object-fit: contain;' class='w-full h-96 object-contain product-image' alt='$name' />
                    </div>
                    <div class='p-4 pb-6'>
                        <h3 class='font-semibold text-lg mb-2'>$name</h3>
                        <div class='d-none deskripsi'>
                            <p class='text-gray-700 mb-4 text-center hidden'>$description</p>
                        </div>
                        <div class='flex justify-between items-center mt-4'>
                            <button class='detail-btn px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium'>
                                Detail
                            </button>
                            <span class='harga text-blue-600 font-bold'>Rp $min_price</span>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentangkami" class="about-section py-8 px-6 lg:px-12">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0 lg:pr-12">
                    <h2 class="section-title text-3xl font-bold mb-4">Tentang Kami</h2>
                    <p class="mb-4 leading-relaxed">
                        Marhaban Perfume telah berkarya sejak tahun 2017 dan didirikan oleh Bapak Syarif Salim Bahanan.
                        Kami menyediakan berbagai jenis parfum berkualitas dan melayani pengiriman ke seluruh Indonesia.
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        Jl. Empang No.31B, Empang, Kota Bogor, Jawa Barat 16132
                    </p>
                </div>
                <div class="lg:w-1/2">
                    <img src="images/about-us.png" alt="About Us" class="rounded-lg shadow-xl w-full max-h-72 object-contain">
                </div>
            </div>
        </div>
    </section>

    <!-- Order Section -->
    <section id="caraorder" class="order-section py-8 px-6 lg:px-12">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0 lg:order-1 lg:pl-12 order-2">
                    <h2 class="section-title text-3xl font-bold mb-4">Cara Order</h2>
                    <p class="mb-4 leading-relaxed">
                        Pilih produk yang diinginkan, lalu klik menu Detail. Anda bisa memilih varian yang tersedia.
                        Jika sudah yakin, tambahkan ke keranjang atau langsung hubungi kami via WhatsApp.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="step-box p-4 rounded-lg text-center flex-1 shadow">
                            <i class="fas fa-search text-2xl mb-2 text-indigo-600"></i>
                            <h3 class="font-semibold text-sm">1. Cari Produk</h3>
                        </div>
                        <div class="step-box p-4 rounded-lg text-center flex-1 shadow">
                            <i class="fas fa-cart-plus text-2xl mb-2 text-indigo-600"></i>
                            <h3 class="font-semibold text-sm">2. Pilih Varian</h3>
                        </div>
                        <div class="step-box p-4 rounded-lg text-center flex-1 shadow">
                            <i class="fas fa-check-circle text-2xl mb-2 text-indigo-600"></i>
                            <h3 class="font-semibold text-sm">3. Checkout</h3>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 lg:order-2 order-1">
                    <img src="images/order.png" alt="Order Process" class="rounded-lg shadow-xl w-full max-h-72 object-contain">
                </div>
            </div>
        </div>
    </section>

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
                            <i class="fas fa-phone-alt mr-2 text-purple-400"></i>
                            <span>+62 895-1017-5754</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-purple-400"></i>
                            <span>info@marhabanparfume.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-purple-400"></i>
                            <span>Jl. Empang No.31B, Bogor</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="https://web.facebook.com/marhabanperfumeofficial" target="_blank" class="bg-purple-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/marhabanparfum" target="_blank" class="bg-purple-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/6289510175754" target="_blank" class="bg-purple-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Marhaban Perfume. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Produk Modal -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto bg-black bg-opacity-50"
        id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none max-w-4xl my-8 mx-auto">
            <div
                class="modal-content border-none shadow-xl relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-lg outline-none text-current transform transition-all">

                <!-- Header -->
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-6 border-b border-gray-100 rounded-t-lg bg-gray-50">
                    <h5 class="text-2xl font-semibold text-gray-900" id="productModalLabel"></h5>
                    <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                        data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body relative p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <!-- Product Image -->
                    <div
                        class="modal-image-container flex items-center justify-center bg-gray-50 rounded-lg overflow-hidden">
                        <img src="" alt="Gambar Produk" class="modal-image w-full h-auto max-h-96 object-contain">
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-6">

                        <!-- Description -->
                        <div class="modal-description text-gray-700 leading-relaxed"></div>

                        <!-- Variant Options -->
                        <div class="variant-options space-y-3">
                            <h4 class="font-medium text-gray-900">Pilih Varian:</h4>
                            <div class="variant-list grid grid-cols-2 gap-3"></div>
                        </div>

                        <!-- Price & Quantity -->
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-gray-500 text-sm">Total Harga:</span>
                                <span class="modal-price text-3xl font-bold text-blue-600 block">Rp 0</span>
                            </div>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                <button class="qty-minus bg-gray-100 hover:bg-gray-200 px-4 py-2 transition-colors">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" min="1" value="1"
                                    class="w-12 text-center border-x border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 quantity-input">
                                <button class="qty-plus bg-gray-100 hover:bg-gray-200 px-4 py-2 transition-colors">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <a href="#" target="_blank"
                                class="buy-btn bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition-colors flex-1 flex items-center justify-center space-x-2">
                                <i class="fab fa-whatsapp text-2xl"></i>
                                <span>Hubungi via WhatsApp</span>
                            </a>

                            <form method="post" action="add_to_cart.php" class="flex-1" enctype="multipart/form-data">
                                <input type="hidden" class="product_id" name="product_id" value="">
                                <input type="hidden" class="product_name" name="product_name" value="">
                                <input type="hidden" class="product_price" name="product_price" value="">
                                <input type="hidden" class="product_image" name="product_image" value="">
                                <input type="hidden" class="product_quantity" name="product_quantity" value="1">
                                <input type="hidden" class="variant_id" name="variant_id" value="">
                                <input type="hidden" class="variant_size" name="variant_size" value="">

                                <button type="submit" name="add_to_cart"
                                    class="w-full bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>+ Keranjang</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/6289510175754" class="floating-whatsapp">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi dropdown menu
            function toggleDropdown() {
                const menu = document.getElementById('dropdownMenu');
                const icon = document.getElementById('chevron');
                menu.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            }

            // Fungsi modal detail produk
            const detailButtons = document.querySelectorAll('.detail-btn');
            detailButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const productCard = this.closest('.product-card');
                    const productId = productCard.querySelector('input').value;
                    const productName = productCard.querySelector('h3').textContent;
                    const productImage = productCard.querySelector('.product-image').src;
                    const productDescription = productCard.dataset.description;

                    // Set input hidden
                    document.querySelector('.product_id').value = productId;
                    document.querySelector('.product_name').value = productName;
                    document.querySelector('.product_image').value = productImage;
                    document.querySelector('.product_quantity').value = 1;

                    // Isi modal
                    document.getElementById('productModalLabel').textContent = productName;
                    document.querySelector('.modal-image').src = productImage;
                    document.querySelector('.modal-description').innerHTML = `<p>${productDescription}</p>`;

                    // Ambil data varian dari server
                    fetch(`get_variants.php?product_id=${productId}`)
                        .then(response => response.json())
                        .then(variants => {
                            const variantList = document.querySelector('.variant-list');
                            variantList.innerHTML = '';

                            if (variants.length > 0) {
                                variants.forEach(variant => {
                                    const variantBtn = document.createElement('button');
                                    variantBtn.className = 'variant-btn border border-gray-300 rounded-lg py-2 px-4 hover:border-blue-500 hover:text-blue-600 transition-colors';
                                    variantBtn.dataset.variantId = variant.id;
                                    variantBtn.dataset.size = variant.size;
                                    variantBtn.dataset.price = variant.price;
                                    variantBtn.dataset.stock = variant.stock;
                                    variantBtn.innerHTML = `
                                        <div class="font-medium">${variant.size}</div>
                                        <div class="text-sm font-semibold">Rp ${parseInt(variant.price).toLocaleString('id-ID')}</div>
                                        ${variant.stock > 0 ? 
                                            `<div class="text-xs text-green-600">Stok: ${variant.stock}</div>` : 
                                            `<div class="text-xs text-red-600">Stok Habis</div>`}
                                    `;

                                    if (variant.stock <= 0) {
                                        variantBtn.disabled = true;
                                        variantBtn.classList.add('opacity-50', 'cursor-not-allowed');
                                    }

                                    variantBtn.addEventListener('click', function() {
                                        // Set active variant
                                        document.querySelectorAll('.variant-btn').forEach(btn => {
                                            btn.classList.remove('border-blue-500', 'text-blue-600', 'bg-blue-50');
                                            btn.classList.add('border-gray-300');
                                        });
                                        this.classList.add('border-blue-500', 'text-blue-600', 'bg-blue-50');
                                        this.classList.remove('border-gray-300');

                                        // Update hidden inputs
                                        document.querySelector('.variant_id').value = this.dataset.variantId;
                                        document.querySelector('.variant_size').value = this.dataset.size;
                                        document.querySelector('.product_price').value = this.dataset.price;

                                        // Update price display
                                        updateTotalPrice();
                                    });

                                    variantList.appendChild(variantBtn);
                                });

                                // Auto select first available variant
                                const firstAvailable = document.querySelector('.variant-btn:not([disabled])');
                                if (firstAvailable) {
                                    firstAvailable.click();
                                }
                            } else {
                                variantList.innerHTML = '<p class="text-gray-500">Tidak ada varian tersedia</p>';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching variants:', error);
                            document.querySelector('.variant-list').innerHTML = '<p class="text-red-500">Gagal memuat varian</p>';
                        });

                    // Tampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('productModal'));
                    modal.show();

                    // Fungsi update total harga
                    function updateTotalPrice() {
                        const quantity = parseInt(document.querySelector('.quantity-input').value);
                        const price = parseFloat(document.querySelector('.product_price').value) || 0;
                        const totalPrice = price * quantity;

                        document.querySelector('.modal-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
                        document.querySelector('.product_quantity').value = quantity;

                        // Update WhatsApp link
                        const selectedVariantBtn = document.querySelector('.variant-btn.border-blue-500');
                        let sizeInfo = '';
                        if (selectedVariantBtn) {
                            sizeInfo = `Ukuran: ${selectedVariantBtn.dataset.size}\n`;
                        }

                        const message = `Halo, saya tertarik dengan produk berikut:\n` +
                            `Nama: ${productName}\n` +
                            `${sizeInfo}` +
                            `Jumlah: ${quantity}\n` +
                            `Total Harga: Rp ${totalPrice.toLocaleString('id-ID')}\n` +
                            `Apakah produk ini tersedia?`;

                        const whatsappLink = `https://wa.me/6289510175754?text=${encodeURIComponent(message)}`;
                        document.querySelector('.buy-btn').href = whatsappLink;
                    }

                    // Quantity controls
                    document.querySelectorAll('.qty-minus').forEach(btn => {
                        btn.onclick = function() {
                            const quantityInput = document.querySelector('.quantity-input');
                            let quantity = parseInt(quantityInput.value);
                            if (quantity > 1) {
                                quantityInput.value = quantity - 1;
                                updateTotalPrice();
                            }
                        };
                    });

                    document.querySelectorAll('.qty-plus').forEach(btn => {
                        btn.onclick = function() {
                            const quantityInput = document.querySelector('.quantity-input');
                            let quantity = parseInt(quantityInput.value);
                            quantityInput.value = quantity + 1;
                            updateTotalPrice();
                        };
                    });

                    document.querySelector('.quantity-input').addEventListener('change', function() {
                        let quantity = parseInt(this.value);
                        if (isNaN(quantity) || quantity < 1) {
                            this.value = 1;
                        }
                        updateTotalPrice();
                    });
                });
            });

            // Fungsi pencarian
            const searchInput = document.getElementById('cari-list');
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const productItems = document.querySelectorAll('.product-item');

                productItems.forEach(item => {
                    const name = item.getAttribute('data-name').toLowerCase();
                    const description = item.getAttribute('data-description').toLowerCase();

                    if (name.includes(searchTerm) || description.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>