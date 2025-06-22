-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2025 pada 10.25
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marhaban`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(16, 'agam', '$2y$10$JLzNT9Txcja29CWqq2.bFuWFch4eZl4jKoaKNYZD3ogAG6sNNxXJK'),
(19, 'royan', '$2y$10$lZwOAMkM5.G70VsjShXAKupLFJ6l/PqcHqvgHJQ7sm9oOittL3dVG'),
(20, 'royan', '$2y$10$IOhpigVB6tQ3/x9E56ovtO2MeYdN9OaGjmMp.WB5/fnq5F0LhB0xK'),
(21, 'royan', '$2y$10$4NFPa3EkicdCrHvJLKsozOGSAVwzbkwHgV0B6g0ZqmpiHSaooo976');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` varchar(32) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Bibit Parfume'),
(2, 'Botol Parfume'),
(3, 'Paket Usaha');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `email`, `password`) VALUES
(1, 'contoh@mail.com', '$2y$10$kJ5zQJklw3liz6hKiICv/.7UlKXckAwe1HTI18wBMCeLO3O/6ivC6'),
(4, 'abdulhermawan1213@gmail.com', '$2y$10$OrS.Hg0IniMgXjWqe9zcG.hwRv47F/ytaaWcDUXTWdhDcIn6x71b2'),
(5, 'royan@gmail.com12345', '$2y$10$VyzK2wwr6RHb3qFV78hHuOTGmb09sS2.F2ueYqHVcWoqqJeR7siBG'),
(6, 'fff@gmail.com', '$2y$10$HplxpHojcUrR6MqBOw2gHe3GABuSdGbIfwLs2yzMnPiVTfllcfnca'),
(7, '1121@dsd', '$2y$10$HrBWs.VpEjTwk9QpJR83Xed3K482.VR7vY8UeUq6jGlVcYAtvbyF6'),
(8, '111@111', '$2y$10$0qUVwRLPVkKUpi.QnK/KHO5g6CAtC6MDxGWLw8G/DeqWHuvJm1WIy'),
(9, 'agam@gmail.com', '$2y$10$Pu4gFjxgkBB28jlhqwoMZuJR319lBS8aevYdmK7CXVbBrdFC.tuja'),
(10, 'pakdede@gmail.com', '$2y$10$FHCVjJLAd6gTzRUXJL0klOs18ZiQGRdMeLLrnLV6FOKRC1KWkjzs6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan_toko`
--

CREATE TABLE `pengaturan_toko` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `banner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaturan_toko`
--

INSERT INTO `pengaturan_toko` (`id`, `nama_toko`, `banner`) VALUES
(1, 'Marhaban Parfume', 'default-banner.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `category_id`, `size`) VALUES
(11, 'Paket Usaha Belajar 1.5', 'Bebas Request Aroma', 1480000.00, 'paket1.5.jpg', '2025-04-09 13:37:38', 3, NULL),
(22, 'Paket Usaha Uji Coba', 'Aroma Terseleksi', 995000.00, 'paket995.jpg', '2025-04-24 18:47:03', 3, NULL),
(27, 'CHRISTINA AGUERA', 'cristina aguera memiliki wangi yang khas harum', 800000.00, 'CHRISTINA AGUERA.png', '2025-05-10 09:47:00', 1, NULL),
(29, 'CREED AVENTUS', 'creed aventus memiliki wangi seperti aroma sakura yang khas', 80000.00, 'CREED AVENTUS.png', '2025-05-10 09:49:13', 1, NULL),
(32, 'CUDDLE BABY', 'Bibit Parfume cuddle baby', 65000.00, 'CUDDLE BABY.png', '2025-05-12 12:21:06', 1, NULL),
(34, 'ABOUT YOU', 'Bibit Parfume Murni', 80000.00, 'ABOUT YOU.png', '2025-05-13 02:48:11', 1, NULL),
(35, 'AIGNER BLUE', 'Bibit Parfume Murni', 70000.00, 'AIGNER BLUE.png', '2025-05-13 02:48:33', 1, NULL),
(36, 'AL FARES', 'Bibit Parfume Murni', 90000.00, 'AL FARES.png', '2025-05-13 02:49:04', 1, NULL),
(37, 'ANGEL HEART', 'Bibit Parfume Murni', 85000.00, 'ANGEL HEART.png', '2025-05-13 02:49:38', 1, NULL),
(38, 'ANTONIO BANDERAZ', 'Bibit Parfume Murni', 90000.00, 'ANTONIO BANDERAZ.png', '2025-05-13 02:50:11', 1, NULL),
(39, 'AQUA KISS', 'Bibit Parfume Murni', 70000.00, 'AQUA KISS.png', '2025-05-13 02:50:35', 1, NULL),
(40, 'BACCARAT ROUGE 540', 'Bibit Parfume Murni', 80000.00, 'BACCARAT ROUGE 540.png', '2025-05-13 02:51:14', 1, NULL),
(41, 'BLACK OPIUM', 'Bibit Parfume Murni', 75000.00, 'BLACK OPIUM.png', '2025-05-13 02:51:47', 1, NULL),
(42, 'BUBBLE GUM', 'Bibit Parfume Murni', 70000.00, 'BUBBLE GUM.png', '2025-05-13 02:52:29', 1, NULL),
(43, 'BULGARY AQUA MARINE', 'Bibit Parfume Murni', 75000.00, 'BULGARY AQUA MARINEE.png', '2025-05-13 02:53:06', 1, NULL),
(44, 'BULGARY AQUA', 'Bibit Parfume Murni', 70000.00, 'BULGARY AQUA.png', '2025-05-13 02:53:39', 1, NULL),
(45, 'BULGARY EXTREME', 'Bibit Parfume Murni', 75000.00, 'BULGARY EXTREME.png', '2025-05-13 02:54:12', 1, NULL),
(46, 'CHOCHOLATE', 'Bibit Parfume Murni', 65000.00, 'CHOCOLATE.png', '2025-05-13 02:55:08', 1, NULL),
(47, 'CALVIN KLEIN ONE', 'Bibit Parfume Murni', 85000.00, 'CK ONE.png', '2025-05-13 02:55:54', 1, NULL),
(48, 'TOLA BATIK SILVER 3ML', 'BOTOL TOLA BATIK SILVER (STICK) 3ML', 12000.00, 'TOLA BATIK SILVER (STIK).jpg', '2025-05-13 03:10:27', 2, NULL),
(49, 'CHLOE 30ML', 'BOTOL CHLOE 30ML', 87000.00, 'cloe 30ml.png', '2025-05-13 04:52:05', 2, NULL),
(50, 'DIPTIQUE 30ML', 'BOTOL DIPTIQUE 30ML', 84000.00, 'diptique 30ml.png', '2025-05-13 04:54:18', 2, NULL),
(51, 'HERMES 50ML', 'BOTOL HERMES 50ML', 67000.00, 'hermes50ml.png', '2025-05-13 04:55:06', 2, NULL),
(52, 'INOCU 30ML', 'BOTOL INOCU 30ML', 64000.00, 'inocu 30ml.png', '2025-05-13 04:55:48', 2, NULL),
(53, 'LELABO 30ML', 'BOTOL LELABO 30ML', 54000.00, 'lelabo 30ml.png', '2025-05-13 04:56:31', 2, NULL),
(54, 'LELABO BLACK 30ML', 'BOTOL LELABO BLACK 30ML', 89000.00, 'lelabo BLACK 30ml.png', '2025-05-13 04:57:12', 2, NULL),
(55, 'SAVAGE 30ML', 'BOTOL SAVAGE 30ML', 67000.00, 'savage 30ml.png', '2025-05-13 04:58:35', 2, NULL),
(56, 'SUPREME 30ML', 'BOTOL SUPREME 30ML', 57000.00, 'supreme 30ml.png', '2025-05-13 04:59:30', 2, NULL),
(57, 'TIWLLY 30ML', 'BOTOL TIWLLY 30ML', 78000.00, 'tiwlly 30ml.png', '2025-05-13 05:00:14', 2, NULL),
(58, 'TOMFORD 30ML', 'BOTOL TOMFORD 30ML', 120000.00, 'tomford 30ml.png', '2025-05-13 05:01:19', 2, NULL),
(59, 'TOMFORD 50ML', 'TOMFORD 50ML', 140000.00, 'tomford 50ml.png', '2025-05-13 05:01:53', 2, NULL),
(60, 'Paket Usaha 9.200.000', '', 3434343.00, 'paket9.2.jpg', '2025-06-06 07:16:44', 3, NULL),
(69, 'Bulgarian', 'bulgarian cuy', NULL, '1750523940_1750493542_Bukti SS Zoom Sesi 1.jpeg', '2025-06-21 16:39:00', 2, NULL),
(70, 'oncom', 'oncaom 2', NULL, '1750526089_1750497033_Screenshot 2025-06-21 152242.png', '2025-06-21 17:14:49', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `size`, `price`, `stock`) VALUES
(1, 69, '30 ml', 100000.00, 1000),
(3, 70, 'ukuran 50 ml', 50000.00, 55),
(4, 22, 'paket usaha uji coba', 1500000.00, 10),
(5, 11, 'paket usaha belajar', 1000000.00, 10),
(6, 27, '30 ml', 30000.00, 100),
(7, 27, '50 ml', 45000.00, 100),
(8, 27, '100 ml', 90000.00, 100),
(9, 29, '30 ml', 45000.00, 100),
(10, 29, '50 ml', 75000.00, 100),
(11, 29, '100 ml', 120000.00, 100),
(12, 32, '30 ml', 30000.00, 100),
(13, 32, '50 ml', 50000.00, 100),
(14, 32, '100 ml', 70000.00, 100),
(15, 48, '12 botol', 120000.00, 10),
(16, 48, '24 botol', 24000.00, 10),
(17, 49, '12 botol', 150000.00, 100),
(18, 49, '24 botol', 250000.00, 100),
(19, 70, 'ukuran 100 ml', 100000.00, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `superadmin`
--

INSERT INTO `superadmin` (`id`, `username`, `password`) VALUES
(1, 'superadmin', '$2y$10$bGw2kXlcMnWGwfqbrO4VYOge6F7Xwn5nR8EVWY1Pk2m6fpT.kb1AC');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `pengaturan_toko`
--
ALTER TABLE `pengaturan_toko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- Indeks untuk tabel `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengaturan_toko`
--
ALTER TABLE `pengaturan_toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
