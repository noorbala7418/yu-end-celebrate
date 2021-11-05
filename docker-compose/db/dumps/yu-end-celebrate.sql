-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Nov 05, 2021 at 06:16 PM
-- Server version: 5.7.35
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yu-end-celebrate`
--

-- --------------------------------------------------------

--
-- Table structure for table `anjomans`
--

CREATE TABLE `anjomans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hamrahan_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_people` int(11) NOT NULL,
  `used_people` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anjomans`
--

INSERT INTO `anjomans` (`id`, `name`, `person_price`, `hamrahan_price`, `total_people`, `used_people`, `created_at`, `updated_at`) VALUES
(1, 'مهندسی معدن', '90000', '60000', 60, 0, '2021-10-03 18:55:46', '2021-10-21 00:13:13'),
(2, 'مهندسی مواد و متالورژی', '90000', '60000', 60, 0, '2021-10-03 18:56:40', '2021-10-20 21:39:17'),
(3, 'مهندسی نساجی', '90000', '60000', 60, 0, '2021-10-03 18:56:57', '2021-10-19 12:14:18'),
(4, 'مهندسی مکانیک', '90000', '60000', 60, 0, '2021-10-03 18:58:59', '2021-10-19 08:35:01'),
(5, 'مهندسی کامپیوتر پردیس مهریز', '90000', '60000', 60, 0, '2021-10-03 19:03:03', '2021-10-20 17:16:46'),
(6, 'علوم کامپیوتر', '90000', '60000', 60, 0, '2021-10-03 19:03:55', '2021-10-19 19:08:54'),
(7, 'مدیریت بازرگانی', '90000', '60000', 60, 0, '2021-10-03 19:04:17', '2021-10-20 13:19:30'),
(8, 'مدیریت صنعتی', '90000', '60000', 60, 0, '2021-10-03 19:05:18', '2021-10-19 18:30:25'),
(9, 'مدیریت جهانگردی و گردشگری', '90000', '60000', 60, 0, '2021-10-03 19:05:18', '2021-10-18 21:53:32'),
(10, 'اقتصاد', '110000', '60000', 60, 0, '2021-10-03 19:05:18', '2021-10-16 18:42:31'),
(11, 'حسابداری', '90000', '60000', 60, 0, '2021-10-03 19:05:18', '2021-10-18 13:20:00'),
(12, 'مدیریت مالی', '90000', '60000', 60, 0, '2021-10-03 19:05:56', '2021-10-18 12:59:56'),
(13, 'حسابداری پردیس مهریز', '90000', '60000', 60, 0, '2021-10-03 19:05:56', '2021-10-16 22:07:54'),
(14, 'مدیریت بازرگانی پردیس مهریز', '90000', '60000', 60, 0, '2021-10-03 19:05:56', '2021-10-16 21:24:57'),
(15, 'ادبیات انگلیسی', '90000', '60000', 60, 0, '2021-10-03 19:05:56', '2021-10-16 16:39:24'),
(16, 'زبان و ادبیات عربی', '90000', '60000', 60, 0, '2021-10-03 19:06:58', '2021-10-18 18:06:31'),
(17, 'روانشناسی', '90000', '60000', 60, 0, '2021-10-03 19:06:58', '2021-10-18 19:48:36'),
(18, 'روانشناسی پردیس مهریز', '90000', '60000', 60, 0, '2021-10-03 19:06:58', '2021-10-18 09:56:05'),
(19, 'علوم تربیتی', '90000', '60000', 60, 0, '2021-10-03 19:06:58', '2021-10-16 21:23:40'),
(20, 'علم اطلاعات و دانش‌شناسی', '90000', '60000', 60, 0, '2021-10-03 19:07:47', '2021-10-18 11:19:30'),
(21, 'پژوهش و رفاه اجتماعی', '90000', '60000', 60, 0, '2021-10-03 19:07:47', '2021-10-03 19:07:47'),
(22, 'حقوق', '90000', '60000', 60, 0, '2021-10-03 19:07:47', '2021-10-18 15:39:49'),
(23, 'حقوق پردیس مهریز', '90000', '60000', 60, 0, '2021-10-03 19:07:47', '2021-10-19 10:19:15'),
(24, 'فقه و حقوق اسلامی', '90000', '60000', 60, 0, '2021-10-03 19:08:39', '2021-10-19 18:06:46'),
(25, 'محیط زیست', '90000', '60000', 60, 0, '2021-10-03 19:08:40', '2021-10-16 18:41:10'),
(26, 'مراتع و آبخیزداری', '90000', '60000', 60, 0, '2021-10-03 19:08:40', '2021-10-16 23:49:55'),
(27, 'علوم و مهندسی خاک', '90000', '60000', 60, 0, '2021-10-03 19:08:40', '2021-10-22 14:48:08'),
(28, 'زیست‌شناسی', '90000', '60000', 60, 0, '2021-10-03 19:09:29', '2021-10-19 12:31:29'),
(29, 'جغرافیا', '90000', '60000', 60, 0, '2021-10-03 19:09:30', '2021-10-18 00:21:08'),
(30, 'شیمی', '90000', '60000', 60, 0, '2021-10-03 19:09:30', '2021-10-21 23:00:59'),
(31, 'گرافیک', '70000', '38000', 60, 0, '2021-10-03 19:09:30', '2021-10-03 19:09:30'),
(32, 'مهندسی معماری', '90000', '60000', 60, 0, '2021-10-03 19:10:00', '2021-10-03 19:10:00'),
(33, 'مهندسی شهرسازی', '90000', '60000', 60, 0, '2021-10-03 19:10:00', '2021-10-03 19:10:00'),
(34, 'نقاشی', '100000', '60000', 60, 0, '2021-10-03 19:10:00', '2021-10-16 19:57:29'),
(35, 'مهندسی کامپیوتر', '90000', '60000', 60, 0, '2021-10-03 19:18:11', '2021-10-20 23:58:17'),
(37, 'مهندسی برق', '90000', '60000', 60, 0, '2021-10-04 21:57:58', '2021-10-16 21:17:33'),
(38, 'زبان و ادبیات فارسی', '90000', '60000', 60, 0, '2021-10-18 13:44:07', '2021-10-19 00:05:58'),
(39, 'تاریخ', '90000', '60000', 60, 0, '2021-10-03 21:44:11', '2021-10-21 20:39:47'),
(40, 'زمین شناسی', '90000', '60000', 60, 0, '2021-10-03 21:44:24', '2021-10-20 14:22:35'),
(42, 'مهندسی عمران', '90000', '60000', 60, 0, '2021-10-03 21:44:31', '2021-10-21 00:30:12');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('food','gift','code') COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `product`, `type`, `unit`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'ناهار - جوجه کباب', 'food', 'پرس', '35000', '2021-10-05 17:20:43', '2021-10-05 17:20:43'),
(2, 'تندیس', 'gift', 'عدد', '45000', '2021-10-05 17:20:43', '2021-10-05 17:20:43'),
(3, 'شام - جوجه کباب', 'food', 'پرس', '35000', '2021-10-05 17:20:44', '2021-10-05 17:20:44'),
(4, 'UNi1400YZD', 'code', 'عدد', '0', '2021-10-05 17:20:44', '2021-10-05 17:20:44');

-- --------------------------------------------------------

--
-- Table structure for table `hamrahan`
--

CREATE TABLE `hamrahan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anjoman_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `stdID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hamrahan` int(11) NOT NULL DEFAULT '0',
  `launchs` int(11) NOT NULL DEFAULT '0',
  `dinners` int(11) NOT NULL DEFAULT '0',
  `bill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hamrahan_payments`
--

CREATE TABLE `hamrahan_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anjoman_id` bigint(20) UNSIGNED NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `person_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `order_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_code` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stdID` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hamrahan` int(11) NOT NULL DEFAULT '0',
  `launchs` int(11) NOT NULL DEFAULT '0',
  `dinners` int(11) NOT NULL DEFAULT '0',
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
(17, '2014_10_12_000000_create_users_table', 1),
(18, '2014_10_12_100000_create_password_resets_table', 1),
(19, '2019_08_19_000000_create_failed_jobs_table', 1),
(20, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(32, '2021_10_01_060906_create_anjomans_table', 3),
(41, '2021_10_03_163529_create_fees_table', 5),
(44, '2021_10_01_070418_create_payments_table', 6),
(45, '2021_10_01_211020_create_students_table', 6),
(46, '2021_10_16_185709_add_orderid_not_madnatory_to_payments_table', 7),
(47, '2021_10_16_192710_create_hamrahan-payments_table', 7),
(48, '2021_10_16_192804_create_hamrahan_table', 7);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anjoman_id` bigint(20) UNSIGNED NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `person_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `order_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_code` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stdID` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hamrahan` int(11) NOT NULL DEFAULT '0',
  `tandis` tinyint(1) NOT NULL DEFAULT '0',
  `launchs` int(11) NOT NULL DEFAULT '0',
  `dinners` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anjoman_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `stdID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hamrahan` int(11) NOT NULL DEFAULT '0',
  `tandis` tinyint(1) NOT NULL DEFAULT '0',
  `launchs` int(11) NOT NULL DEFAULT '0',
  `dinners` int(11) NOT NULL DEFAULT '0',
  `bill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Indexes for table `anjomans`
--
ALTER TABLE `anjomans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hamrahan`
--
ALTER TABLE `hamrahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hamrahan_anjoman_id_foreign` (`anjoman_id`),
  ADD KEY `hamrahan_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `hamrahan_payments`
--
ALTER TABLE `hamrahan_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hamrahan_payments_order_id_unique` (`order_id`),
  ADD UNIQUE KEY `hamrahan_payments_transaction_id_unique` (`transaction_id`),
  ADD UNIQUE KEY `hamrahan_payments_reference_id_unique` (`reference_id`),
  ADD UNIQUE KEY `hamrahan_payments_link_unique` (`link`),
  ADD KEY `hamrahan_payments_anjoman_id_foreign` (`anjoman_id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_order_id_unique` (`order_id`),
  ADD UNIQUE KEY `payments_transaction_id_unique` (`transaction_id`),
  ADD UNIQUE KEY `payments_reference_id_unique` (`reference_id`),
  ADD UNIQUE KEY `payments_link_unique` (`link`),
  ADD KEY `payments_anjoman_id_foreign` (`anjoman_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_stdid_unique` (`stdID`),
  ADD KEY `students_anjoman_id_foreign` (`anjoman_id`),
  ADD KEY `students_payment_id_foreign` (`payment_id`);

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
-- AUTO_INCREMENT for table `anjomans`
--
ALTER TABLE `anjomans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hamrahan`
--
ALTER TABLE `hamrahan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hamrahan_payments`
--
ALTER TABLE `hamrahan_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hamrahan`
--
ALTER TABLE `hamrahan`
  ADD CONSTRAINT `hamrahan_anjoman_id_foreign` FOREIGN KEY (`anjoman_id`) REFERENCES `anjomans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hamrahan_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `hamrahan_payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hamrahan_payments`
--
ALTER TABLE `hamrahan_payments`
  ADD CONSTRAINT `hamrahan_payments_anjoman_id_foreign` FOREIGN KEY (`anjoman_id`) REFERENCES `anjomans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_anjoman_id_foreign` FOREIGN KEY (`anjoman_id`) REFERENCES `anjomans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_anjoman_id_foreign` FOREIGN KEY (`anjoman_id`) REFERENCES `anjomans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
