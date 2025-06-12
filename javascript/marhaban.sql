-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 01:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(16, 'agam', '$2y$10$JLzNT9Txcja29CWqq2.bFuWFch4eZl4jKoaKNYZD3ogAG6sNNxXJK');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
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
-- Table structure for table `cart_items`
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Bibit Parfume'),
(2, 'Botol Parfume'),
(3, 'Paket Usaha');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `category_id`) VALUES
(11, 'Paket Usaha Belajar 1.5', 'Bebas Request Aroma', 1480000.00, 'paket1.5.jpg', '2025-04-09 13:37:38', 3),
(15, 'Paket Usaha 2.0', 'Bebas Request Aroma', 2165000.00, 'paket2.0.jpg', '2025-04-24 18:29:16', 3),
(16, 'Paket Usaha 4.0', 'Bebas Request Aroma', 3835000.00, 'paket4.0.jpg', '2025-04-24 18:30:27', 3),
(17, 'Paket Usaha Kios 6.2', 'Bebas Request Aroma', 6255000.00, 'paket6.2.jpg', '2025-04-24 18:31:26', 3),
(18, 'Paket Usaha Kios 6.6', 'Bebas Request Aroma', 660000.00, 'paket6.6.jpg', '2025-04-24 18:32:30', 3),
(20, 'Paket Usaha Ruko 13.9', 'Bebas Request Aroma', 13900000.00, 'paket13.9.jpg', '2025-04-24 18:43:54', 3),
(21, 'Paket Usaha Ruko 15.7', 'Bebas Request Aroma', 15715000.00, 'paket15.7.jpg', '2025-04-24 18:44:55', 3),
(22, 'Paket Usaha Uji Coba', 'Aroma Terseleksi', 995000.00, 'paket995.jpg', '2025-04-24 18:47:03', 3),
(27, 'CHRISTINA AGUERA', '100ML', 800000.00, 'CHRISTINA AGUERA.png', '2025-05-10 09:47:00', 1),
(28, 'CALVIN KLEIN BEE', '100ML', 80000.00, 'CK BEE.png', '2025-05-10 09:48:36', 1),
(29, 'CREED AVENTUS', '100ML', 80000.00, 'CREED AVENTUS.png', '2025-05-10 09:49:13', 1),
(32, 'CUDDLE BABY', 'Bibit Parfume', 65000.00, 'CUDDLE BABY.png', '2025-05-12 12:21:06', 1),
(33, '1000  Bunga', 'Bibit Parfume Murni', 60000.00, '1000 BUNGA.png', '2025-05-13 02:47:35', 1),
(34, 'ABOUT YOU', 'Bibit Parfume Murni', 80000.00, 'ABOUT YOU.png', '2025-05-13 02:48:11', 1),
(35, 'AIGNER BLUE', 'Bibit Parfume Murni', 70000.00, 'AIGNER BLUE.png', '2025-05-13 02:48:33', 1),
(36, 'AL FARES', 'Bibit Parfume Murni', 90000.00, 'AL FARES.png', '2025-05-13 02:49:04', 1),
(37, 'ANGEL HEART', 'Bibit Parfume Murni', 85000.00, 'ANGEL HEART.png', '2025-05-13 02:49:38', 1),
(38, 'ANTONIO BANDERAZ', 'Bibit Parfume Murni', 90000.00, 'ANTONIO BANDERAZ.png', '2025-05-13 02:50:11', 1),
(39, 'AQUA KISS', 'Bibit Parfume Murni', 70000.00, 'AQUA KISS.png', '2025-05-13 02:50:35', 1),
(40, 'BACCARAT ROUGE 540', 'Bibit Parfume Murni', 80000.00, 'BACCARAT ROUGE 540.png', '2025-05-13 02:51:14', 1),
(41, 'BLACK OPIUM', 'Bibit Parfume Murni', 75000.00, 'BLACK OPIUM.png', '2025-05-13 02:51:47', 1),
(42, 'BUBBLE GUM', 'Bibit Parfume Murni', 70000.00, 'BUBBLE GUM.png', '2025-05-13 02:52:29', 1),
(43, 'BULGARY AQUA MARINE', 'Bibit Parfume Murni', 75000.00, 'BULGARY AQUA MARINEE.png', '2025-05-13 02:53:06', 1),
(44, 'BULGARY AQUA', 'Bibit Parfume Murni', 70000.00, 'BULGARY AQUA.png', '2025-05-13 02:53:39', 1),
(45, 'BULGARY EXTREME', 'Bibit Parfume Murni', 75000.00, 'BULGARY EXTREME.png', '2025-05-13 02:54:12', 1),
(46, 'CHOCHOLATE', 'Bibit Parfume Murni', 65000.00, 'CHOCOLATE.png', '2025-05-13 02:55:08', 1),
(47, 'CALVIN KLEIN ONE', 'Bibit Parfume Murni', 85000.00, 'CK ONE.png', '2025-05-13 02:55:54', 1),
(48, 'TOLA BATIK SILVER 3ML', 'BOTOL TOLA BATIK SILVER (STICK) 3ML', 12000.00, 'TOLA BATIK SILVER (STIK).jpg', '2025-05-13 03:10:27', 2),
(49, 'CHLOE 30ML', 'BOTOL CHLOE 30ML', 87000.00, 'cloe 30ml.png', '2025-05-13 04:52:05', 2),
(50, 'DIPTIQUE 30ML', 'BOTOL DIPTIQUE 30ML', 84000.00, 'diptique 30ml.png', '2025-05-13 04:54:18', 2),
(51, 'HERMES 50ML', 'BOTOL HERMES 50ML', 67000.00, 'hermes50ml.png', '2025-05-13 04:55:06', 2),
(52, 'INOCU 30ML', 'BOTOL INOCU 30ML', 64000.00, 'inocu 30ml.png', '2025-05-13 04:55:48', 2),
(53, 'LELABO 30ML', 'BOTOL LELABO 30ML', 54000.00, 'lelabo 30ml.png', '2025-05-13 04:56:31', 2),
(54, 'LELABO BLACK 30ML', 'BOTOL LELABO BLACK 30ML', 89000.00, 'lelabo BLACK 30ml.png', '2025-05-13 04:57:12', 2),
(55, 'SAVAGE 30ML', 'BOTOL SAVAGE 30ML', 67000.00, 'savage 30ml.png', '2025-05-13 04:58:35', 2),
(56, 'SUPREME 30ML', 'BOTOL SUPREME 30ML', 57000.00, 'supreme 30ml.png', '2025-05-13 04:59:30', 2),
(57, 'TIWLLY 30ML', 'BOTOL TIWLLY 30ML', 78000.00, 'tiwlly 30ml.png', '2025-05-13 05:00:14', 2),
(58, 'TOMFORD 30ML', 'BOTOL TOMFORD 30ML', 120000.00, 'tomford 30ml.png', '2025-05-13 05:01:19', 2),
(59, 'TOMFORD 50ML', 'TOMFORD 50ML', 140000.00, 'tomford 50ml.png', '2025-05-13 05:01:53', 2),
(60, 'Paket Usaha 9.200.000', '', 3434343.00, 'paket9.2.jpg', '2025-06-06 07:16:44', 3),
(61, 'Paket Usaha 607', 'sfsufsfisfddvnffjfjmffmfmmfsffhdhhhfhhfhfhfhfhfhfhfhfhhfhfhfhfhfhfhfhfhfhfhfhfhfhhggjjgbknbfnf jfbfvknkffffbfgfgjfgkfng', 607000.00, 'paket600.jpg', '2025-06-07 07:11:19', 3),
(62, 'hhvvgvg', 'jvhjhvh', 87878787.00, 'AL FARES.png', '2025-06-09 14:39:12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
