-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 10:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `property_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT 4.5,
  `total_deals` int(11) DEFAULT 0,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `company`, `rating`, `total_deals`, `phone_number`, `email`, `photo_path`, `created_at`) VALUES
(15, 'yopon', NULL, 4.5, 0, '873847328', 'tyo@gmail.com', '1760732711_prop_68d7cb8cca116.jpg', '2025-10-17 20:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `hero_images`
--

CREATE TABLE `hero_images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero_images`
--

INSERT INTO `hero_images` (`id`, `image_path`, `is_active`, `uploaded_at`) VALUES
(12, '68adc91b7f20b_office.jpg', 1, '2025-08-26 14:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `pending_properties`
--

CREATE TABLE `pending_properties` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `status_properti` varchar(50) NOT NULL,
  `detail_properti` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `id_properti` varchar(50) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `regency` varchar(100) DEFAULT NULL,
  `district_or_area` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `property_type` enum('for_sale','for_rent') NOT NULL DEFAULT 'for_sale',
  `property_kind` varchar(50) DEFAULT NULL,
  `tipe_properti` varchar(50) DEFAULT NULL,
  `luas_tanah` varchar(50) DEFAULT NULL,
  `luas_bangunan` varchar(50) DEFAULT NULL,
  `arah_bangunan` varchar(50) DEFAULT NULL,
  `jenis_bangunan` varchar(50) DEFAULT NULL,
  `jumlah_lantai` varchar(50) DEFAULT NULL,
  `kamar_tidur` varchar(50) DEFAULT NULL,
  `kamar_pembantu` varchar(50) DEFAULT NULL,
  `kamar_mandi` varchar(50) DEFAULT NULL,
  `daya_listrik` varchar(50) DEFAULT NULL,
  `saluran_air` varchar(50) DEFAULT NULL,
  `jalur_telepon` varchar(50) DEFAULT NULL,
  `interior` varchar(50) DEFAULT NULL,
  `garasi_parkir` varchar(50) DEFAULT NULL,
  `sertifikat` varchar(50) DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `agent_id` int(11) DEFAULT NULL,
  `facilities` text DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `id_properti`, `title`, `description`, `price`, `province`, `regency`, `district_or_area`, `image`, `created_at`, `property_type`, `property_kind`, `tipe_properti`, `luas_tanah`, `luas_bangunan`, `arah_bangunan`, `jenis_bangunan`, `jumlah_lantai`, `kamar_tidur`, `kamar_pembantu`, `kamar_mandi`, `daya_listrik`, `saluran_air`, `jalur_telepon`, `interior`, `garasi_parkir`, `sertifikat`, `view_count`, `agent_id`, `facilities`, `is_featured`) VALUES
(39, NULL, 'rumahh siap huni', 'rumah bagus siap huni muat buat 12 anak ', 1200000.00, 'Jawa Barat', 'Bekasi Kabupaten', NULL, NULL, '2025-09-27 11:33:32', 'for_sale', 'Apartemen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '24 jam anti maling ', 0),
(40, NULL, 'rumah atta halilintar', 'ini rumah bukan rumah rumahan hehehe', 1200000.00, 'DKI Jakarta', 'Jakarta Pusat', NULL, NULL, '2025-09-27 17:02:23', 'for_sale', 'Rumah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'ada kolam renang\r\nsatpam 24 jam\r\nkeren dh', 0),
(42, NULL, 'xczc', 'zcxxcxzc', 1000000.00, 'DKI Jakarta', 'Jakarta Barat', NULL, NULL, '2025-10-17 19:36:51', 'for_sale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'cxzczx\r\nczxczx\r\nzxczxc', 1),
(43, NULL, 'adasd', 'adasdasdas', 10000000.00, 'Jawa Barat', 'Bandung Kota', NULL, NULL, '2025-10-17 19:45:00', 'for_rent', 'Apartemen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 15, 'dasdsa', 0),
(44, NULL, 'wqeqwe', 'wqrqwfd', 1000000.00, 'DKI Jakarta', 'Jakarta Barat', NULL, NULL, '2025-10-17 20:25:42', 'for_rent', 'Apartemen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 15, 'efsdfsdfs', 0);

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `property_id`, `image_path`, `is_main`) VALUES
(44, 39, 'prop_68d7cb8cc7ccb.jpg', 0),
(45, 39, 'prop_68d7cb8cc93f5.jpg', 0),
(46, 39, 'prop_68d7cb8cca116.jpg', 0),
(47, 39, 'prop_68d7cb8ccb86f.jpg', 1),
(48, 40, 'prop_68d8189f29771.jpg', 0),
(49, 40, 'prop_68d8189f2a4de.jpg', 0),
(50, 40, 'prop_68d8189f2b9f0.jpg', 0),
(51, 40, 'prop_68d8189f2c14b.jpg', 1),
(56, 42, 'prop_68f29ad3c9008.jpg', 1),
(57, 42, 'prop_68f29ad3c9454.jpg', 0),
(58, 42, 'prop_68f29ad3c9c1b.jpg', 0),
(59, 42, 'prop_68f29ae3968d5.jpg', 0),
(60, 43, 'prop_68f29cbc3b980.jpg', 1),
(61, 43, 'prop_68f29cbc3bcc7.jpg', 0),
(62, 43, 'prop_68f29cbc3c34a.jpg', 0),
(63, 43, 'prop_68f29cbc3c5ee.jpg', 0),
(64, 44, 'prop_68f2a646a97bb.jpg', 0),
(65, 44, 'prop_68f2a646a9f4b.jpg', 1),
(66, 44, 'prop_68f2a646aa6f9.jpg', 0),
(67, 44, 'prop_68f2a646aaaed.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `property_images_temp`
--

CREATE TABLE `property_images_temp` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mime_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_images_temp`
--

INSERT INTO `property_images_temp` (`id`, `image_path`, `uploaded_at`, `mime_type`) VALUES
(1, 'img_6876a02a024880.73161506.jpg', '2025-07-15 18:38:34', NULL),
(2, 'img_6876a03c3219c5.44081300.jpg', '2025-07-15 18:38:52', NULL),
(5, 'img_687b9f2c1055f9.03575798.png', '2025-07-19 13:35:40', NULL),
(6, 'img_688cb59c3dd275.00555717.jpg', '2025-08-01 12:39:56', NULL),
(7, 'img_688cb59fc0bdc7.17503185.jpg', '2025-08-01 12:39:59', NULL),
(11, 'img_68949d6668b512.89437661.png', '2025-08-07 12:34:46', NULL),
(17, 'img_689b125baf0f07.21256992.png', '2025-08-12 10:07:23', NULL),
(22, '689b2f4f586a3.png', '2025-08-12 12:10:55', 'image/png'),
(29, '689b84ac2c21e.png', '2025-08-12 18:15:08', 'image/png'),
(31, '689b84d69d34f.png', '2025-08-12 18:15:50', 'image/png'),
(43, 'prop_68adb77a464ee.jpg', '2025-08-26 13:32:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(1, 'DKI Jakarta'),
(2, 'Jawa Barat'),
(3, 'Jawa Tengah'),
(4, 'Jawa Timur');

-- --------------------------------------------------------

--
-- Table structure for table `regencies`
--

CREATE TABLE `regencies` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regencies`
--

INSERT INTO `regencies` (`id`, `province_id`, `name`) VALUES
(1, 1, 'Jakarta Pusat'),
(2, 1, 'Jakarta Selatan'),
(3, 1, 'Jakarta Timur'),
(4, 1, 'Jakarta Barat'),
(5, 1, 'Jakarta Utara'),
(6, 2, 'Bekasi Kota'),
(7, 2, 'Bekasi Kabupaten'),
(8, 2, 'Bandung Kota'),
(9, 2, 'Depok'),
(10, 4, 'Surabaya'),
(11, 4, 'Malang');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_images`
--
ALTER TABLE `hero_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_properties`
--
ALTER TABLE `pending_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_agent_id` (`agent_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `property_images_temp`
--
ALTER TABLE `property_images_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `regencies`
--
ALTER TABLE `regencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hero_images`
--
ALTER TABLE `hero_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pending_properties`
--
ALTER TABLE `pending_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `property_images_temp`
--
ALTER TABLE `property_images_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `regencies`
--
ALTER TABLE `regencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `fk_agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`);

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regencies`
--
ALTER TABLE `regencies`
  ADD CONSTRAINT `regencies_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
