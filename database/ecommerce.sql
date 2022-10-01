-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2022 at 04:24 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `status`, `image`, `about`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin@gmail.com', '1', 'default.png', NULL, NULL, '$2a$12$sK/G49jt3Sy/vvlYDAIFl.9Br9ka0voRyirXIRELK7G2IORfQWxpa', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_languages`
--

CREATE TABLE `admin_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'electronics', 1, '1647532419SriMadav-logos_(30.jpeg', '2022-03-17 09:53:39', '2022-03-17 09:53:39'),
(2, 'Mobile', 'mobile', 1, '1647682155download.png', '2022-03-19 03:29:15', '2022-03-19 03:29:15'),
(3, 'Sunglass', 'sunglass', 1, '1647682391download(2).jfif', '2022-03-19 03:33:11', '2022-03-19 03:33:11'),
(4, 'Watch', 'watch', 1, '1647682514download.jfif', '2022-03-19 03:35:14', '2022-03-19 03:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `child_categories`
--

CREATE TABLE `child_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontend_languages`
--

CREATE TABLE `frontend_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_03_08_035027_create_admins_table', 1),
(5, '2022_03_09_053320_create_categories_table', 1),
(6, '2022_03_09_054335_create_sub_categories_table', 1),
(7, '2022_03_09_054421_create_child_categories_table', 1),
(8, '2022_03_10_103956_create_products_table', 1),
(9, '2022_03_14_065920_create_frontend_languages_table', 1),
(10, '2022_03_15_050615_create_admin_languages_table', 1),
(11, '2022_03_16_062920_create_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `childcategory_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `orginal_price` decimal(8,2) NOT NULL,
  `selling_price` decimal(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `small_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` decimal(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `trending` tinyint(4) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `category_id`, `subcategory_id`, `childcategory_id`, `quantity`, `orginal_price`, `selling_price`, `image`, `details`, `small_details`, `tax`, `status`, `trending`, `views`, `tag`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(2, 'LG LF540T 43″ LED Television', 'lg-lf540t-43-led-television', 1, 1, NULL, 30, '38900.00', '33100.00', '1647660172download.jfif', 'The LG 43″ LED TV LF540T comes with great picture quality and sound system that’ll blow your mind. This 43 inch Led Tv equipped with full HD view is also called LG Game TV. And offers a sleek metallic design.', 'Screen Size: 43″\r\nResolution: HD 1920×1080\r\nTriple XD Engine\r\nLG Game TV\r\nEasy Installment Facility Available', '10.00', '1', 1, 0, 'LG, Butterfly, Led', 'LG LF540T 43″ LED Television', 'LG LF540T 43″ LED TelevisionLG LF540T 43″ LED TelevisionLG LF540T 43″ LED TelevisionLG LF540T 43″ LED TelevisionLG LF540T 43″ LED Television', 'LG', '2022-03-18 21:22:52', '2022-03-18 21:22:52'),
(3, 'Samsung Galaxy S22+', 'samsung-galaxy-s22', 2, NULL, NULL, 45, '345000.00', '345000.00', '1647682664Samsung-Galaxy-S22-Plus-image.jpg', 'Samsung Galaxy S22+ comes with 6.6 inches Full HD+ Dynamic AMOLED 2X screen. It has a punch-hole front camera design. The back camera is of triple 50+10+12 MP with Dual Pixel PDAF, telephoto, OIS, ultrawide, 3x optical zoom etc. and 8K video recording. The front camera is of 10 Megapixel. Galaxy S22+ comes with 4500 mAh battery with 45W fast charging. It has 12 GB RAM, up to 3.0 GHz octa-core CPU and Adreno 730 GPU. It is powered by a Qualcomm Snapdragon 8 Gen 1 (4 nm) chipset. The device comes with 256 GB UFS 3.1 internal storage and no MicroSD slot. There is an ultrasonic in-display fingerprint sensor in this phone.', '– Stylus (Bluetooth integration, accelerometer, gyro)\r\n– Samsung Pay (Visa, MasterCard certified)\r\n– Samsung DeX, Samsung Wireless DeX\r\n– Bixby\r\n– Ultra Wideband support', '345.00', '1', 1, 0, 'Samsung', 'Samsung', 'Samsung Samsung Samsung Samsung', 'Samsung', '2022-03-19 03:37:44', '2022-03-19 03:37:44'),
(4, 'Xiaomi Haylou Solar LS05 Smart Watch', 'xiaomi-haylou-solar-ls05-smart-watch', 4, NULL, NULL, 45, '4356.00', '3456.00', '1647682861download(1).jfif', 'Product Type:Smart Watch\r\nModel: Haylou LS05\r\nDisplay: 1.28inch TFT screen\r\nDefinition: 240*240\r\nBT Version: V5.0\r\nSensor: Ultra-low dynamic optical heart rate sensor and accelerometer\r\nBattery Capacity: 340mAh', 'Product Type:Smart Watch\r\nModel: Haylou LS05\r\nDisplay: 1.28inch TFT screen', '456.00', '1', 1, 0, 'Watch', 'Watch', 'Watch', 'Watch', '2022-03-19 03:41:01', '2022-03-19 03:42:07'),
(5, 'AELFIE MATTE BLACK', 'aelfie-matte-black', 3, NULL, NULL, 445, '456.00', '456.00', '1647683295ALFIE-MATTE-BLACK-1-600x600.jpg', 'UV400 PROTECTION? YES\r\n\r\nPOLARIZED? YES\r\n\r\nFRAME MATERIAL: PC\r\n\r\nLENS MATERIAL: TAC\r\n\r\nFRAME COLOUR: BLACK\r\n\r\nLENS COLOUR: BLACK\r\n\r\nLENS WIDTH: 59MM\r\n\r\nLENS HEIGHT: 45MM\r\n\r\nFRAME LENGTH', 'UV400 PROTECTION? YES\r\n\r\nPOLARIZED? YES\r\n\r\nFRAME MATERIAL: PC\r\n\r\nLENS MATERIAL: TAC\r\n\r\nFRAME COLOUR: BLACK\r\n\r\nLENS COLOUR: BLACK\r\n\r\nLENS WIDTH: 59MM\r\n\r\nLENS HEIGHT: 45MM\r\n\r\nFRAME LENGTH', '45.00', '1', 1, 0, 'Sunglass', 'Sunglass', 'Sunglass', 'Sunglass', '2022-03-19 03:48:15', '2022-03-19 03:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontend_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `backend_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'LG', 'lg', 1, '1647532450SriMadav-logos_(30.jpeg', '2022-03-17 09:54:10', '2022-03-17 09:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_languages`
--
ALTER TABLE `admin_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_categories`
--
ALTER TABLE `child_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `frontend_languages`
--
ALTER TABLE `frontend_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_languages`
--
ALTER TABLE `admin_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `child_categories`
--
ALTER TABLE `child_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontend_languages`
--
ALTER TABLE `frontend_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
