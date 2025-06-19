~}|"<?php
session_start();
$isLoggedIn = isset($_SESSION['pelanggan_id']) ? 'true' : 'false';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marhaban Parfume</title>

    <!-- CSS dan Font -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow py-4 px-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="#" class="flex items-center">
                <img src="images/logo.png" alt="Logo" class="h-12 w-12 mr-2">
                <span class="text-xl font-bold">Marhaban Parfume</span>
            </a>
            <div class="flex items-center space-x-6">
                <a href="#" class="cart-icon relative">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                    <span class="cart-count absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">0</span>
                </a>
                <?php if ($isLoggedIn === 'true'): ?>
                    <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded">Logout</a>
                <?php else: ?>
                    <a href="loginpelanggan.php" class="text-gray-700">Login</a>
                    <a href="registrasi_pelanggan.php" class="bg-blue-500 text-white px-4 py-2 rounded">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Produk -->
    <section class="py-12 px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Produk Kami</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            include 'db.php';
            $result = mysqli_query($conn, "SELECT * FROM products");
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="bg-white rounded-lg shadow overflow-hidden product-card">
                    <input type="hidden" value="' . $row['id'] . '">
                    <img src="images/' . $row['image'] . '" alt="' . $row['name'] . '" class="w-full h-64 object-contain">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">' . $row['name'] . '</h3>
                        <p class="text-gray-600 my-2">' . $row['description'] . '</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-blue-600 font-bold">Rp ' . number_format($row['price'], 0, ',', '.') . '</span>
                            <button class="detail-btn bg-blue-500 text-white px-4 py-2 rounded">Detail</button>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </section>

    <!-- Modal Produk -->
    <div class="modal hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg w-11/12 md:w-2/3 lg:w-1/2 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-bold product-name"></h3>
                <button class="close-modal text-2xl">&times;</button>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <img src="" alt="Produk" class="product-image w-full h-64 object-contain">

                <div>
                    <p class="product-description text-gray-700 mb-4"></p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-blue-600 font-bold text-xl product-price"></span>
                        <div class="flex items-center border rounded">
                            <button class="qty-minus px-3 py-1 bg-gray-100">-</button>
                            <input type="number" value="1" min="1" class="w-12 text-center quantity">
                            <button class="qty-plus px-3 py-1 bg-gray-100">+</button>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <a href="#" class="whatsapp-btn bg-green-500 text-white px-4 py-2 rounded flex items-center">
                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                        </a>
                        <button class="add-to-cart bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                            <i class="fas fa-cart-plus mr-2"></i> Keranjang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/6289510175754" class="fixed bottom-8 right-8 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center text-2xl shadow-lg">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isLoggedIn = <?= $isLoggedIn ?>;
            let currentProduct = {};

            // Buka modal produk
            document.querySelectorAll('.detail-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const card = this.closest('.product-card');
                    currentProduct = {
                        id: card.querySelector('input').value,
                        name: card.querySelector('h3').textContent,
                        price: card.querySelector('span').textContent.replace(/\D/g, ''),
                        description: card.querySelector('p').textContent,
                        image: card.querySelector('img').src
                    };

                    // Isi data modal
                    document.querySelector('.product-name').textContent = currentProduct.name;
                    document.querySelector('.product-description').textContent = currentProduct.description;
                    document.querySelector('.product-price').textContent = 'Rp ' + parseInt(currentProduct.price).toLocaleString('id-ID');
                    document.querySelector('.product-image').src = currentProduct.image;
                    document.querySelector('.quantity').value = 1;

                    // Update link WhatsApp
                    const waLink = `https://wa.me/6289510175754?text=Saya%20mau%20pesan%20${encodeURIComponent(currentProduct.name)}%20sebanyak%201%20pcs`;
                    document.querySelector('.whatsapp-btn').href = waLink;

                    // Tampilkan modal
                    document.querySelector('.modal').classList.remove('hidden');
                });
            });

            // Tutup modal
            document.querySelector('.close-modal').addEventListener('click', function() {
                document.querySelector('.modal').classList.add('hidden');
            });

            // Quantity +/-
            document.querySelector('.qty-minus').addEventListener('click', function() {
                const qtyInput = document.querySelector('.quantity');
                if (qtyInput.value > 1) qtyInput.value--;
                updateTotal();
            });

            document.querySelector('.qty-plus').addEventListener('click', function() {
                const qtyInput = document.querySelector('.quantity');
                qtyInput.value++;
                updateTotal();
            });

            document.querySelector('.quantity').addEventListener('change', function() {
                if (this.value < 1) this.value = 1;
                updateTotal();
            });

            function updateTotal() {
                const quantity = document.querySelector('.quantity').value;
                const total = currentProduct.price * quantity;
                document.querySelector('.product-price').textContent = 'Rp ' + total.toLocaleString('id-ID');

                // Update WA link
                const waLink = `https://wa.me/6289510175754?text=Saya%20mau%20pesan%20${encodeURIComponent(currentProduct.name)}%20sebanyak%20${quantity}%20pcs`;
                document.querySelector('.whatsapp-btn').href = waLink;
            }

            // Tambah ke keranjang
            document.querySelector('.add-to-cart').addEventListener('click', function() {
                if (!isLoggedIn) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login Diperlukan',
                        text: 'Silakan login terlebih dahulu'
                    });
                    return;
                }

                const quantity = document.querySelector('.quantity').value;

                // Kirim data ke server (simplified)
                fetch('add_to_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            product_id: currentProduct.id,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update counter keranjang
                            const cartCount = document.querySelector('.cart-count');
                            cartCount.textContent = parseInt(cartCount.textContent) + parseInt(quantity);

                            // Tampilkan notifikasi
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: quantity + ' ' + currentProduct.name + ' ditambahkan',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            // Tutup modal
                            document.querySelector('.modal').classList.add('hidden');
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    });
            });
        });
    </script>
</body>

</html>