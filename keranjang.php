<?php
session_start();

$whatsappMessage = "Halo, saya ingin memesan:\n";

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $item) {
        $whatsappMessage .= "- " . $item['name'] . " (" . $item['quantity'] . "x)\n";
    }
    $subtotal = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $shipping = 25000;
    $total = $subtotal + $shipping;
    $whatsappMessage .= "\nSubtotal: Rp " . number_format($subtotal, 0, ',', '.');
    $whatsappMessage .= "\nTotal: Rp " . number_format($total, 0, ',', '.');
} else {
    $whatsappMessage = "Keranjang Anda kosong.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Marhaban Parfume</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10B981',
                        secondary: '#059669',
                        accent: '#EC4899',
                        dark: '#1F2937',
                        light: '#F3F4F6',
                    }
                }
            }
        }
    </script>
    <style>
        .cart-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .empty-cart {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="./images/logo.png" alt="Foto Anda" class="h-12 w-12 mr-2">
                <h1 class="text-xl font-bold text-dark">Marhaban Parfume</h1>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-dark hover:text-primary">
                    <i class="fas fa-home text-xl"></i>
                </a>
                <a href="#" class="text-dark hover:text-primary relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span id="cartCount"
                        class="absolute -top-2 -right-2 bg-accent text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </a>
            </div>
        </div>
    </header>

    <!--konten utama -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-dark">Keranjang Belanja</h2>
            <button id="clearCart" class="text-red-500 hover:text-red-700 flex items-center">
                <i class="fas fa-trash-alt mr-1"></i> Kosongkan Keranjang
            </button>
        </div>

        <!-- Cart Items -->
        <div id="cartItems" class="space-y-4 mb-8">
            <?php
            include 'db.php'; // Pastikan koneksi database tersedia
            
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
                $cartIds = array_map(function ($item) {
                    return $item['id'];
                }, $_SESSION['cart']);
                $idsString = implode(",", $cartIds);
                $total = 0;
                foreach ($_SESSION['cart'] as $item):

                    if ($item): // Jika produk ditemukan di database
                        $image = !empty($item['image']) ? /** "images/" . **/ $item['image'] : "images/no-image.jpg";
                        $itemTotal = $item['price']; //* $item['quantity']; //* $item['quantity'];
                        //$total += $total;
                        ?>
                        <div class="cart-item bg-white rounded-lg shadow p-4 flex flex-col md:flex-row transition duration-300">
                            <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-4">
                                <img src="<?= $image ?>" alt="<?= htmlspecialchars($item['name']) ?>"
                                    class="w-24 h-24 object-cover rounded">

                                <h3 class="font-semibold text-lg text-dark"><?= htmlspecialchars($item['name']) ?></h3>

                                <?php if (!empty($item['size'])): ?>
                                    <p class="text-sm text-gray-500 mb-1">Ukuran: <?= htmlspecialchars($item['size']) ?></p>
                                <?php endif; ?>

                            </div>
                            <div class="flex-grow">
                                <div class="flex justify-between">
                                    <h3 class="font-semibold text-lg text-dark"><?= htmlspecialchars($item['name']) ?></h3>
                                    <button class="text-red-500 hover:text-red-700 remove-item" data-id="<?= $item['id'] ?>">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!--<p class="text-gray-600 text-sm mb-2"><?= htmlspecialchars($item['description']) ?></p>-->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <button class="quantity-btn minus bg-gray-200 px-2 py-1 rounded-l hover:bg-gray-300"
                                            data-id="<?= $item['id'] ?>">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="quantity bg-gray-100 px-4 py-1"><?= $item['quantity'] ?></span>
                                        <button class="quantity-btn plus bg-gray-200 px-2 py-1 rounded-r hover:bg-gray-300"
                                            data-id="<?= $item['id'] ?>">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <p class="font-bold text-primary">Rp <?= number_format($itemTotal, 0, ',', '.') ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    endif;
                    //mysqli_free_result($query);
                endforeach;
            else: ?>

                <div id="emptyCart" class="text-center py-12 empty-cart">
                    <i class="fas fa-shopping-cart text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-500 mb-2">Keranjang Belanja Kosong</h3>
                    <p class="text-gray-500 mb-6">Tambahkan produk ke keranjang untuk mulai berbelanja</p>
                    <a href="halamanpelanggan.php"
                        class="inline-block bg-primary hover:bg-secondary text-white font-medium py-2 px-6 rounded-full transition duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali Berbelanja
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Ringkasan Pesanan -->
        <div id="orderSummary" class="bg-white rounded-lg shadow p-6" <?= (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) ? 'style="display:none;"' : '' ?>>
            <h3 class="font-bold text-lg text-dark mb-4">Ringkasan Pesanan</h3>
            <div class="space-y-3 mb-6">
                <?php
                $subtotal = 0;
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        $subtotal += $item['price'] * $item['quantity'];
                    }
                }
                //$shipping = 25000;
                $total = $subtotal //+ $shipping;
                    ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal (<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                        produk)</span>
                    <span class="font-medium">Rp <?= number_format($subtotal) ?></span>
                </div>
                <div class="border-t border-gray-200 pt-3 flex justify-between">
                    <span class="font-semibold">Total Pembayaran</span>
                    <span class="font-bold text-primary text-xl">Rp <?= number_format($total) ?></span>
                </div>
            </div>
            <button id="checkoutBtn"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center transition duration-300">
                <i class="fab fa-whatsapp mr-2 text-xl"></i> Lanjutkan ke WhatsApp
            </button>

        </div>

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

        <script>
            document.getElementById("checkoutBtn")?.addEventListener("click", function () {
                const confirmSend = confirm("Lanjutkan ke WhatsApp dan kirim pesanan?");
                if (!confirmSend) return;

                // Isi pesan dari PHP (di-generate dinamis)
                const waMessage = `<?= rawurlencode($whatsappMessage) ?>`;
                const waNumber = "6289510175754";
                const waLink = `https://wa.me/${waNumber}?text=${waMessage}`;

                // Hapus keranjang dulu via AJAX
                fetch("clear_cart.php", {
                    method: "POST"
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Setelah keranjang dihapus, redirect ke WhatsApp
                            window.location.href = waLink;
                        } else {
                            alert("Gagal mengosongkan keranjang.");
                        }
                    });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Update cart count on load
                updateCartCount();

                // Quantity buttons functionality
                document.querySelectorAll('.quantity-btn').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const productId = this.getAttribute('data-id');
                        const isMinus = this.classList.contains('minus');

                        // Send AJAX request to update quantity
                        fetch('update_cart.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `id=${productId}&action=${isMinus ? 'decrease' : 'increase'}`
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload(); // Refresh to show updated cart
                                }
                            });
                    });
                });

                // Remove item functionality
                document.querySelectorAll('.remove-item').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const productId = this.getAttribute('data-id');

                        // Kirim permintaan AJAX untuk menghapus item
                        fetch('remove_from_cart.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `id=${productId}`
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload(); // Refresh to show updated cart
                                }
                            });
                    });
                });

                // Clear cart functionality
                document.getElementById('clearCart')?.addEventListener('click', function () {
                    if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
                        fetch('clear_cart.php', {
                            method: 'POST'
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                }
                            });
                    }
                });

                // Update cart count function
                function updateCartCount() {
                    const count = <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>;
                    document.getElementById('cartCount').textContent = count;
                }
            });
        </script>
</body>

</html>