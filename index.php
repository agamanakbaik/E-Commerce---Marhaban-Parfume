<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marhaban Parfume - Pusat Grosir Parfume Berkualitas</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
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
            /* agar tidak terpotong */
            object-fit: contain;
            /* tampilkan seluruh gambar tanpa cropping */
            aspect-ratio: 4 / 3;
            /* opsional: menjaga proporsi */
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
            background-color:rgb(31, 92, 184);
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
            border-color: #6b46c1;
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
            background: linear-gradient(to right, #6b46c1, #9f7aea);
            bottom: -10px;
            left: 25%;
            border-radius: 3px;
        }

        .about-section,
        .order-section {
            background: linear-gradient(135deg, #6b46c1 0%, #9f7aea 100%);
            color: white;
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
            background-color:rgb(37, 99, 235);
            color: white;
            transition: all 0.3s ease;
        }

        .buy-btn:hover {
            background-color:rgb(31, 92, 184); 
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
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-md py-4 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="navbar-brand flex items-center">
                <img src="./images/logo.png" alt="Foto Anda" class="h-12 w-12 mr-2">
                    <span>Marhaban Parfume</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <!-- Wrapper -->
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

                <a href="halamankeranjang.php" class="nav-link cart-icon">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="cart-count">0</span>
                </a>

                <div class="relative group">
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
            </button>
        </div>
    </nav>

    <!-- Hero Banner -->
    <div class="relative">
        <img src="images/banner.jpg" alt="Marhaban Parfume" class="w-full h-96 object-cover">
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

    <!-- Products Section -->
    <section id="products" class="py-12 px-6 lg:px-12 max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="section-title text-3xl font-bold text-gray-800">Our Collection</h2>
            <p class="max-w-2xl mx-auto text-gray-600 mt-4">
                Toko Grosir Marhaban Perfume menjual berbagai aroma bibit parfum, botol parfum, perlengkapan racik
                parfum, dll.
                Diharapkan bertanya-tanya terlebih dahulu sebelum melakukan pengambilan barang agar kami cek
                ketersediaan bahan yang diinginkan.
                <br>Jam Operasional: Senin - Sabtu 08:30-17:00
            </p>
        </div>

        <div class="flex justify-end mb-8">
            <div class="relative w-full md:w-1/3">
                <input type="text" id="cari-list" placeholder="Cari produk..."
                    class="search-box w-full pl-10 pr-5 py-3 focus:outline-none">
                <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="product-container">
            <?php
            include 'db.php';

            // Pastikan koneksi database tersedia
            if (!$conn) {
                die("Koneksi database gagal: " . mysqli_connect_error());
            }
            if (isset($_GET['category_id'])) {
                $category_id = $_GET["category_id"];
                // Ambil data dari tabel products
                $result = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id");
            } else if (!isset($_GET['category_id'])) {
                $result = mysqli_query($conn, "SELECT * FROM products ");
            } else {
                echo "Parameter category_id tidak ditemukan.";
            }


            if (!$result) {
                die("Query error: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                // Pastikan data aman untuk ditampilkan
                $name = htmlspecialchars($row["name"]);
                $description = htmlspecialchars($row["description"]);
                $price = number_format($row["price"], 0, ',', '.'); // Format harga
                $image = !empty($row["image"]) ? "images/" . $row["image"] : "images/no-image.jpg"; // Fallback jika gambar kosong
            
                echo "
                    <div class='product-card bg-white rounded-xl overflow-hidden shadow-md product-item'            data-name='$name' data-description='$description'>
                        <img src='$image' class='w-full h-96 object-contain product-image' alt='$name' />
                        <div class='p-4 pb-6'>
                            <h3 class='font-semibold text-lg mb-2'>$name</h3>
                            <div class='flex justify-between items-center mt-4'>
                                <a href='#' class='detail-btn px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium'>Detail</a>
                                <span class='harga text-blue-600 font-bold'>Rp. $price</span>
                            </div>
                        </div>
                        <div class='d-none deskripsi'>
                            <p  class='text-gray-700 mb-4 text-center'>$description</p>
                        </div> 
                    </div>";

                }
            ?>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentangkami" class="about-section py-16 px-6 lg:px-12">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0 lg:pr-12">
                    <h2 class="section-title text-3xl font-bold text-white mb-6">Tentang Kami</h2>
                    <p class="text-white mb-6">
                        Marhaban Perfume telah berkarya sejak tahun 2017 dan didirikan oleh Bapak Syarif Salim Bahanan.
                        Kami
                        menyediakan berbagai jenis parfum berkualitas dan melayani pengiriman ke seluruh Indonesia.
                    </p>
                    <p class="text-white">
                        <i class="fas fa-map-marker-alt mr-2"></i> Jl. Empang No.31B, Empang, Kota Bogor, Jawa Barat
                        16132
                    </p>
                </div>
                <div class="lg:w-1/2">
                    <img src="images/about-us.png" alt="About Us" class="rounded-lg shadow-xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Order Section -->
    <section id="caraorder" class="order-section py-16 px-6 lg:px-12">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0 lg:order-1 lg:pl-12 order-2">
                    <h2 class="section-title text-3xl font-bold text-white mb-6">Cara Order</h2>
                    <p class="text-white mb-6">
                        Pilih produk yang diinginkan, lalu klik menu Detail. Jika hanya membeli satu produk, klik tombol
                        <span class="font-semibold">Beli Produk Ini</span>. Namun jika ingin membeli lebih dari satu
                        produk, masukkan ke keranjang
                        terlebih dahulu.
                    </p>
                    <div class="flex space-x-4">
                        <div class="bg-white bg-opacity-20 p-4 rounded-lg flex-1">
                            <i class="fas fa-search text-2xl mb-2"></i>
                            <h3 class="font-semibold">1. Cari Produk</h3>
                        </div>
                        <div class="bg-white bg-opacity-20 p-4 rounded-lg flex-1">
                            <i class="fas fa-cart-plus text-2xl mb-2"></i>
                            <h3 class="font-semibold">2. Tambah ke Keranjang</h3>
                        </div>
                        <div class="bg-white bg-opacity-20 p-4 rounded-lg flex-1">
                            <i class="fas fa-check-circle text-2xl mb-2"></i>
                            <h3 class="font-semibold">3. Checkout</h3>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 lg:order-2 order-1">
                    <img src="images/order.png" alt="Order Process" class="rounded-lg shadow-xl w-full">
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
                        <a href="#"
                            class="bg-purple-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="bg-purple-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="bg-purple-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
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

    <!-- Product Modal -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto bg-black bg-opacity-50"
    id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none max-w-4xl my-8 mx-auto">
        <div class="modal-content border-none shadow-xl relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-lg outline-none text-current transform transition-all">
            <!-- Header -->
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-6 border-b border-gray-100 rounded-t-lg bg-gray-50">
                <h5 class="text-2xl font-semibold text-gray-900" id="productModalLabel"></h5>
                <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Body -->
            <div class="modal-body relative p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Gambar Produk -->
                <div class="modal-image-container flex items-center justify-center bg-gray-50 rounded-lg overflow-hidden">
                    <img src="" alt="Product Image" class="modal-image w-full h-auto max-h-96 object-contain">
                </div>
                
                <!-- Detail Produk -->
                <div class="space-y-6">
                    <!-- Deskripsi -->
                    <div class="modal-description text-gray-700 leading-relaxed"></div>
                    
                    <!-- Pilihan Ukuran -->
                    <div class="size-options space-y-3">
                        <h4 class="font-medium text-gray-900">Pilih Ukuran:</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="size-btn border border-gray-300 rounded-lg py-2 px-4 hover:border-blue-500 hover:text-blue-600 transition-colors" 
                                    data-size="100ml" data-price="150000">
                                100ml - Rp150.000
                            </button>
                            <button class="size-btn border border-gray-300 rounded-lg py-2 px-4 hover:border-blue-500 hover:text-blue-600 transition-colors" 
                                    data-size="500ml" data-price="250000">
                                500ml - Rp250.000
                            </button>
                            <button class="size-btn border border-gray-300 rounded-lg py-2 px-4 hover:border-blue-500 hover:text-blue-600 transition-colors" 
                                    data-size="1000ml" data-price="400000">
                                1000ml - Rp400.000
                            </button>
                            <button class="size-btn border border-gray-300 rounded-lg py-2 px-4 hover:border-blue-500 hover:text-blue-600 transition-colors" 
                                    data-size="5000ml" data-price="607000">
                                5000ml - Rp607.000
                            </button>
                        </div>
                    </div>
                    
                    <!-- Harga & Qty -->
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-gray-500 text-sm">Total Harga:</span>
                            <span class="modal-price text-3xl font-bold text-blue-600 block">Rp607.000</span>
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
                    
                    <!-- Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button class="buy-btn bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex-1 flex items-center justify-center space-x-2">
                            <i class="fas fa-bolt"></i>
                            <span>Beli Sekarang</span>
                        </button>
                        <button class="add-to-cart-btn bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-lg font-medium transition-colors flex-1 flex items-center justify-center space-x-2">
                            <i class="fas fa-shopping-cart"></i>
                            <span>+ Keranjang</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variabel untuk menyimpan harga dasar dan kuantitas
    let basePrice = 607000;
    let currentQuantity = 1;
    const priceElement = document.querySelector('.modal-price');
    const quantityInput = document.querySelector('.quantity-input');
    
    // Fungsi untuk update harga total
    function updateTotalPrice() {
        const totalPrice = basePrice * currentQuantity;
        priceElement.textContent = 'Rp' + totalPrice.toLocaleString('id-ID');
    }
    
    // Fungsi kuantitas minus
    document.querySelectorAll('.qty-minus').forEach(btn => {
        btn.addEventListener('click', function() {
            if (currentQuantity > 1) {
                currentQuantity--;
                quantityInput.value = currentQuantity;
                updateTotalPrice();
            }
        });
    });

    // Fungsi kuantitas plus
    document.querySelectorAll('.qty-plus').forEach(btn => {
        btn.addEventListener('click', function() {
            currentQuantity++;
            quantityInput.value = currentQuantity;
            updateTotalPrice();
        });
    });
    
    // Fungsi saat input quantity diubah manual
    quantityInput.addEventListener('change', function() {
        const newValue = parseInt(this.value);
        if (!isNaN(newValue) && newValue >= 1) {
            currentQuantity = newValue;
            updateTotalPrice();
        } else {
            this.value = currentQuantity;
        }
    });

    // Fungsi pilihan ukuran
    const sizeButtons = document.querySelectorAll('.size-btn');
    
    sizeButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Hapus active class dari semua tombol
            sizeButtons.forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-600', 'bg-blue-50');
                btn.classList.add('border-gray-300');
            });
            
            // Tambah active class ke tombol yang diklik
            this.classList.add('border-blue-500', 'text-blue-600', 'bg-blue-50');
            this.classList.remove('border-gray-300');
            
            // Update harga dasar
            basePrice = parseInt(this.getAttribute('data-price'));
            updateTotalPrice();
            
            // Simpan data ukuran yang dipilih
            const selectedSize = this.getAttribute('data-size');
            // Anda bisa menggunakan data ini untuk proses selanjutnya
        });
    });

    // Set default selected size (5000ml)
    document.querySelector('.size-btn[data-size="5000ml"]').click();
});
</script>

<a href="https://wa.me/6289510175754" class="floating-whatsapp">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sample product data (in a real app, this would come from your database)
            /*  const products = [
                  {
                      id: 1,
                      name: "$",
                      description: "Deskripsi lengkap parfume A dengan berbagai keunggulan dan spesifikasi produk. Aroma yang tahan lama hingga 12 jam dengan wangi floral yang segar.",
                      price: "150.000",
                      image: "https://via.placeholder.com/600x400"
                  },
                  {
                      id: 2,
                      name: "Parfume B",
                      description: "Deskripsi lengkap parfume B dengan berbagai keunggulan dan spesifikasi produk. Cocok untuk acara formal dengan aroma woody yang elegan.",
                      price: "200.000",
                      image: "https://via.placeholder.com/600x400"
                  },
                  {
                      id: 3,
                      name: "Parfume C",
                      description: "Deskripsi lengkap parfume C dengan berbagai keunggulan dan spesifikasi produk. Aroma citrus yang menyegarkan untuk aktivitas sehari-hari.",
                      price: "250.000",
                      image: "https://via.placeholder.com/600x400"
                  },
                  {
                      id: 4,
                      name: "Parfume D",
                      description: "Deskripsi lengkap parfume D dengan berbagai keunggulan dan spesifikasi produk. Kombinasi unik antara floral dan fruity untuk penampilan yang memikat.",
                      price: "180.000",
                      image: "https://via.placeholder.com/600x400"
                  }
              ];*/

            // Initialize cart count
            let cartCount = 0;
            updateCartCount();

            // Product detail modal functionality
            const detailButtons = document.querySelectorAll('.detail-btn');
            detailButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    const productCard = this.closest('.product-card');
                    const productName = productCard.querySelector('h3').textContent;
                    const productPrice = productCard.querySelector('.harga').textContent;
                    const productImage = productCard.querySelector('.product-image').src;
                    const productDescription = productCard.dataset.description;

                    // Isi modal
                    document.getElementById('productModalLabel').textContent = productName;
                    document.querySelector('.modal-image').src = productImage;
                    document.querySelector('.modal-description').innerHTML = `<p>${productDescription}</p>`;
                    document.querySelector('.modal-price').textContent = productPrice;

                    const whatsappLink = `https://wa.me/6289510175754?text=Saya%20tertarik%20dengan%20produk%20${encodeURIComponent(productName)}%20dengan%20harga%20${encodeURIComponent(productPrice)}.%20Apakah%20produk%20ini%20tersedia?`;
                    document.querySelector('.buy-btn').href = whatsappLink;

                    // Tampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('productModal'));
                    modal.show();
                });
            });


            // Add to cart functionality
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function () {
                    cartCount++;
                    updateCartCount();

                    // Show success message
                    alert('Produk telah ditambahkan ke keranjang!');
                });
            });

            // Search functionality
            const searchInput = document.getElementById('cari-list');
            searchInput.addEventListener('keyup', function () {
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

            // Update cart count in UI
            function updateCartCount() {
                document.querySelector('.cart-count').textContent = cartCount;
            }

            // Mobile menu toggle (would need more implementation for full mobile menu)
            const mobileMenuButton = document.querySelector('.md\\:hidden');
            mobileMenuButton.addEventListener('click', function () {
                alert('Mobile menu would open here in a full implementation.');
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>