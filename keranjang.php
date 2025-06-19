<?php
session_start();

// Hitung total belanja
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}

// Pesan WhatsApp
$whatsappMessage = "Halo, saya ingin memesan:\n\n";
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $item) {
        $whatsappMessage .= "- " . $item['name'];
        if (!empty($item['size'])) {
            $whatsappMessage .= " (" . $item['size'] . ")";
        }
        $whatsappMessage .= " - " . $item['quantity'] . " x Rp " . number_format($item['price'], 0, ',', '.') . "\n";
    }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .cart-scroll {
            max-height: 60vh;
            overflow-y: auto;
        }

        .cart-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .cart-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .cart-scroll::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .cart-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="halamanpelanggan.php" class="flex items-center space-x-2">
                <img src="images/logo.png" alt="Logo" class="h-10 w-10">
                <h1 class="text-xl font-bold text-gray-800">Marhaban Parfume</h1>
            </a>
            <div class="flex items-center space-x-4">
                <a href="halamanpelanggan.php" class="text-gray-600 hover:text-blue-500">
                    <i class="fas fa-store text-lg"></i>
                </a>
                <a href="keranjang.php" class="text-gray-600 hover:text-blue-500 relative">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                    </span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-shopping-cart mr-2"></i> Keranjang Belanja
            </h2>
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <button id="clearCart" class="text-red-500 hover:text-red-700 flex items-center">
                    <i class="fas fa-trash mr-2"></i> Kosongkan Keranjang
                </button>
            <?php endif; ?>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Daftar Produk -->
            <div class="lg:w-2/3">
                <div id="cartItems" class="bg-white rounded-lg shadow p-4 cart-scroll">
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <div class="space-y-4">
                            <?php foreach ($_SESSION['cart'] as $index => $item):
                                $image = !empty($item['image']) ? $item['image'] : "images/no-image.jpg";
                                $itemTotal = $item['price'] * $item['quantity'];
                            ?>
                                <div class="cart-item bg-white border border-gray-200 rounded-lg p-4 transition duration-300">
                                    <div class="flex flex-col md:flex-row gap-4">
                                        <!-- Gambar Produk -->
                                        <div class="flex-shrink-0">
                                            <img src="<?= $image ?>" alt="<?= htmlspecialchars($item['name']) ?>"
                                                class="w-20 h-20 object-cover rounded-lg">
                                        </div>

                                        <!-- Detail Produk -->
                                        <div class="flex-grow">
                                            <div class="flex justify-between">
                                                <div>
                                                    <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($item['name']) ?></h3>
                                                    <?php if (!empty($item['size'])): ?>
                                                        <p class="text-sm text-gray-500 mt-1">Ukuran: <?= htmlspecialchars($item['size']) ?></p>
                                                    <?php endif; ?>
                                                    <p class="text-blue-600 font-semibold mt-2">
                                                        Rp <?= number_format($item['price'], 0, ',', '.') ?>
                                                    </p>
                                                </div>
                                                <button class="remove-item text-red-500 hover:text-red-700 h-8"
                                                    data-id="<?= $item['id'] ?>"
                                                    data-size="<?= htmlspecialchars($item['size'] ?? '') ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>

                                            <!-- Kontrol Kuantitas -->
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                                    <button class="quantity-btn minus bg-gray-100 px-3 py-1 hover:bg-gray-200"
                                                        data-id="<?= $item['id'] ?>"
                                                        data-size="<?= htmlspecialchars($item['size'] ?? '') ?>">
                                                        <i class="fas fa-minus text-sm"></i>
                                                    </button>
                                                    <span class="quantity bg-white px-4 py-1 text-center w-12">
                                                        <?= $item['quantity'] ?>
                                                    </span>
                                                    <button class="quantity-btn plus bg-gray-100 px-3 py-1 hover:bg-gray-200"
                                                        data-id="<?= $item['id'] ?>"
                                                        data-size="<?= htmlspecialchars($item['size'] ?? '') ?>">
                                                        <i class="fas fa-plus text-sm"></i>
                                                    </button>
                                                </div>
                                                <p class="font-bold text-blue-600">
                                                    Rp <?= number_format($itemTotal, 0, ',', '.') ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <i class="fas fa-shopping-basket text-5xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Keranjang Belanja Kosong</h3>
                            <p class="text-gray-500 mb-6">Belum ada produk di keranjang belanja Anda</p>
                            <a href="halamanpelanggan.php"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                                <i class="fas fa-store-alt mr-2"></i> Lanjutkan Belanja
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Ringkasan Belanja -->
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Ringkasan Belanja</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Barang</span>
                                <span><?= count($_SESSION['cart']) ?> produk</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-3 mb-4">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total</span>
                                <span class="text-blue-600">Rp <?= number_format($total, 0, ',', '.') ?></span>
                            </div>
                        </div>
                        <button id="checkoutBtn" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center transition duration-300">
                            <i class="fab fa-whatsapp mr-2 text-xl"></i> Pesan via WhatsApp
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tombol quantity
            document.querySelectorAll('.quantity-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const productSize = this.getAttribute('data-size');
                    const isMinus = this.classList.contains('minus');

                    fetch('update_cart.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `id=${productId}&size=${encodeURIComponent(productSize)}&action=${isMinus ? 'decrease' : 'increase'}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                });
            });

            // Hapus item
            document.querySelectorAll('.remove-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const productSize = this.getAttribute('data-size');

                    Swal.fire({
                        title: 'Hapus Produk?',
                        text: "Produk akan dihapus dari keranjang",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('remove_from_cart.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: `id=${productId}&size=${encodeURIComponent(productSize)}`
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        location.reload();
                                    }
                                });
                        }
                    });
                });
            });

            // Kosongkan keranjang
            document.getElementById('clearCart')?.addEventListener('click', function() {
                Swal.fire({
                    title: 'Kosongkan Keranjang?',
                    text: "Semua produk akan dihapus dari keranjang",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Kosongkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
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
            });

            // Checkout WhatsApp
            document.getElementById('checkoutBtn')?.addEventListener('click', function() {
                Swal.fire({
                    title: 'Lanjutkan ke WhatsApp?',
                    text: "Pesanan akan dikirim via WhatsApp",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#25D366',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Lanjutkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const waMessage = `<?= rawurlencode($whatsappMessage) ?>`;
                        const waNumber = "6289510175754";
                        window.location.href = `https://wa.me/${waNumber}?text=${waMessage}`;

                        // Kosongkan keranjang setelah checkout
                        fetch('clear_cart.php', {
                            method: 'POST'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>