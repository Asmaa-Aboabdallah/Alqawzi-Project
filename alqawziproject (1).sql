-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2023 at 11:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alqawziproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_main_uploads`
--

CREATE TABLE `admin_main_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` int(11) NOT NULL,
  `admin_uploads` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `c2_c_services`
--

CREATE TABLE `c2_c_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subOrder_id` bigint(20) UNSIGNED NOT NULL,
  `log_image_from` varchar(255) DEFAULT NULL,
  `letter_from` varchar(255) DEFAULT NULL,
  `driving_license_from` varchar(255) DEFAULT NULL,
  `others_from` varchar(255) DEFAULT NULL,
  `log_image_to` varchar(255) DEFAULT NULL,
  `letter_to` varchar(255) DEFAULT NULL,
  `driving_license_to` varchar(255) DEFAULT NULL,
  `others_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `c2_p_services`
--

CREATE TABLE `c2_p_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subOrder_id` bigint(20) UNSIGNED NOT NULL,
  `log_image_from` varchar(255) DEFAULT NULL,
  `letter_from` varchar(255) DEFAULT NULL,
  `driving_license_from` varchar(255) DEFAULT NULL,
  `others_from` varchar(255) DEFAULT NULL,
  `id_photo_to` varchar(255) DEFAULT NULL,
  `driving_license_to` varchar(255) DEFAULT NULL,
  `others_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `insurance_services`
--

CREATE TABLE `insurance_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `id_photo` varchar(255) DEFAULT NULL,
  `form` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `main_services`
--

CREATE TABLE `main_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` tinyint(4) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_services`
--

INSERT INTO `main_services` (`id`, `name`, `short_desc`, `description`, `duration`, `price`, `img`, `created_at`, `updated_at`) VALUES
(1, 'نقل الملكيه', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،', 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق\r\n', 2, '200.00', 'services/Img.png', '2022-12-13 06:44:12', '2022-12-13 06:44:12'),
(2, 'تجديد الرخصة', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،', 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق\r\n', 2, '200.00', 'services/Img2.png', '2022-12-13 06:44:12', '2022-12-13 06:44:12'),
(3, 'التامين', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،', 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق\r\n', 2, '200.00', 'services/Ellipse 6.png', '2022-12-13 06:44:12', '2022-12-13 06:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `main_service_users`
--

CREATE TABLE `main_service_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `main_service_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` int(11) NOT NULL,
  `status` enum('reviewing','pendingPayment','pendingOTPConfirmation','otpConfirmed','completed') NOT NULL DEFAULT 'reviewing',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_service_users`
--

INSERT INTO `main_service_users` (`id`, `user_id`, `main_service_id`, `order_number`, `status`, `created_at`, `updated_at`) VALUES
(38, 3, 1, 6651, 'reviewing', '2022-12-29 12:06:30', '2022-12-29 12:06:30');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_13_060154_create_services_table', 2),
(6, '2022_12_13_060651_create_payments_table', 2),
(7, '2022_12_13_061226_create_orders_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `new_services`
--

CREATE TABLE `new_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `id_photo` varchar(255) DEFAULT NULL,
  `form` varchar(255) DEFAULT NULL,
  `Examination` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `p2_c_services`
--

CREATE TABLE `p2_c_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subOrder_id` bigint(20) UNSIGNED NOT NULL,
  `id_photo_from` varchar(255) DEFAULT NULL,
  `driving_license_from` varchar(255) DEFAULT NULL,
  `others_from` varchar(255) DEFAULT NULL,
  `log_image_to` varchar(255) DEFAULT NULL,
  `letter_to` varchar(255) DEFAULT NULL,
  `driving_license_to` varchar(255) DEFAULT NULL,
  `others_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `p2_p_services`
--

CREATE TABLE `p2_p_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subOrder_id` bigint(20) UNSIGNED NOT NULL,
  `id_photo_from` varchar(255) DEFAULT NULL,
  `driving_license_from` varchar(255) DEFAULT NULL,
  `others_from` varchar(255) DEFAULT NULL,
  `id_photo_to` varchar(255) DEFAULT NULL,
  `driving_license_to` varchar(255) DEFAULT NULL,
  `others_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p2_p_services`
--

INSERT INTO `p2_p_services` (`id`, `user_id`, `subOrder_id`, `id_photo_from`, `driving_license_from`, `others_from`, `id_photo_to`, `driving_license_to`, `others_to`, `created_at`, `updated_at`) VALUES
(6, 3, 11, 'files/PuNA2ic19bkoduhfkQ2Lq5BMVczkzheuPsEIyNU3.png', 'files/hcp1fkzM7rzLwLtpkQeimDHGfG8yqUyk503T1uu7.png', NULL, 'files/OQZbUyZUUMZ63YCzl0jqTuki0dZJ5qRzjv3pMPqa.png', 'files/tZVDh1bJgdjTeFPvp16A1SksflvBtk9E6aoIvOGA.png', NULL, '2022-12-29 12:06:30', '2022-12-29 12:06:30');

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
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` int(11) NOT NULL,
  `payment_receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-12-17 10:41:35', '2022-12-17 10:41:35'),
(2, 'user', '2022-12-17 10:41:35', '2022-12-17 10:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `sub_services`
--

CREATE TABLE `sub_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_service_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_services`
--

INSERT INTO `sub_services` (`id`, `main_service_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'شخص الي شخص', '2022-12-17 10:57:40', '2022-12-17 10:57:40'),
(2, 1, 'شركة الي شركة', '2022-12-17 10:57:40', '2022-12-17 10:57:40'),
(3, 1, 'شخص الي شركة', '2022-12-17 10:57:40', '2022-12-17 10:57:40'),
(4, 1, 'شركة الي شخص ', '2022-12-17 10:57:40', '2022-12-17 10:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `sub_service_users`
--

CREATE TABLE `sub_service_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sub_service_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_service_users`
--

INSERT INTO `sub_service_users` (`id`, `user_id`, `sub_service_id`, `order_number`, `created_at`, `updated_at`) VALUES
(11, 3, 1, 6651, '2022-12-29 12:06:30', '2022-12-29 12:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT 2,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `phone`, `account_verified_at`, `password`, `remember_token`, `access_token`, `otp`, `created_at`, `updated_at`) VALUES
(2, 2, 'Asmaa Fathy', '01005034376', NULL, '$2y$10$ui6Vb020gz18OTyHL80DZe6GKzJ1OjC6wPh2GZIETgfrwhkvKXXIy', NULL, '2TZev1VVO0VREqhTyW8NOvS8fRvDpeJCM1dRtrb2zwf7sLvYJUNDy8uGMLZlVjdw', NULL, '2022-12-12 12:59:49', '2022-12-24 10:15:55'),
(3, 2, 'Mohamed nabil awad ouf', '01064451586', NULL, '$2y$10$FFwMsFzaMTAHGvx5/PkH4ea9ptaj5MitwFq7CC8LEr9idqcSFC9pC', NULL, 'rmfWe7VPcPU0aBwFrvYIdUT1W3DBcy532EDI7dRZOZmgeUIJn3PkIdO7pCvY7yTd', '1450', '2022-12-18 07:35:25', '2023-01-24 17:55:54'),
(5, 1, 'Asmaa Abo abdallah', '01013041651', NULL, '$2y$10$Zn02Mw.Z/eSmAVM9WRcEH.Przf6Tog6vzv5w2jpBHzl5OVdlue796', 'malwcKB4ER8vr8czDP4o8uKiaip5QOEzxgBfnh8UhTRw12HAOEvflgn4XQA6', NULL, '7064', '2022-12-19 12:36:56', '2022-12-19 12:05:30'),
(6, 2, 'Mohamed nabil awad ouf1', '010644515861', NULL, '$2y$10$8jpQnPG6pjzioQhe8kkLFu8kV.HR1EtzJphlU7FogX2p/LfXT352G', NULL, 'ouQ5rveyZhrJUFymzn1PLJCGdTBtRDu3hzsTeOl9zllDuyZ4QPvrWiHC6uqZtCWO', NULL, '2022-12-27 09:15:21', '2022-12-27 09:15:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_main_uploads`
--
ALTER TABLE `admin_main_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order6` (`order_id`);

--
-- Indexes for table `c2_c_services`
--
ALTER TABLE `c2_c_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subOrder_id` (`subOrder_id`),
  ADD KEY `user2_foreign` (`user_id`),
  ADD KEY `order2_foreign` (`subOrder_id`);

--
-- Indexes for table `c2_p_services`
--
ALTER TABLE `c2_p_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subOrder_id` (`subOrder_id`),
  ADD KEY `user3_foreign` (`user_id`),
  ADD KEY `order3_foreign` (`subOrder_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `insurance_services`
--
ALTER TABLE `insurance_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_user` (`user_id`),
  ADD KEY `foreign_order` (`order_id`);

--
-- Indexes for table `main_services`
--
ALTER TABLE `main_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_service_users`
--
ALTER TABLE `main_service_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_foreign` (`user_id`),
  ADD KEY `main_id_foreign` (`main_service_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_services`
--
ALTER TABLE `new_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `user_foreign` (`user_id`),
  ADD KEY `order_foreign` (`order_id`);

--
-- Indexes for table `p2_c_services`
--
ALTER TABLE `p2_c_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subOrder_id` (`subOrder_id`),
  ADD KEY `user4_foreign` (`user_id`),
  ADD KEY `order4_foreign` (`subOrder_id`);

--
-- Indexes for table `p2_p_services`
--
ALTER TABLE `p2_p_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subOrder_id` (`subOrder_id`),
  ADD KEY `user1_foreign` (`user_id`),
  ADD KEY `order1_foreign` (`subOrder_id`);

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
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_services`
--
ALTER TABLE `sub_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_service_id_foreign` (`main_service_id`);

--
-- Indexes for table `sub_service_users`
--
ALTER TABLE `sub_service_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_id_foreign` (`sub_service_id`),
  ADD KEY `user_foreign_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_main_uploads`
--
ALTER TABLE `admin_main_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `c2_c_services`
--
ALTER TABLE `c2_c_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `c2_p_services`
--
ALTER TABLE `c2_p_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_services`
--
ALTER TABLE `insurance_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `main_services`
--
ALTER TABLE `main_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `main_service_users`
--
ALTER TABLE `main_service_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `new_services`
--
ALTER TABLE `new_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `p2_c_services`
--
ALTER TABLE `p2_c_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `p2_p_services`
--
ALTER TABLE `p2_p_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_services`
--
ALTER TABLE `sub_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_service_users`
--
ALTER TABLE `sub_service_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_main_uploads`
--
ALTER TABLE `admin_main_uploads`
  ADD CONSTRAINT `order6` FOREIGN KEY (`order_id`) REFERENCES `main_service_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `c2_c_services`
--
ALTER TABLE `c2_c_services`
  ADD CONSTRAINT `order2_foreign` FOREIGN KEY (`subOrder_id`) REFERENCES `sub_service_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user2_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `c2_p_services`
--
ALTER TABLE `c2_p_services`
  ADD CONSTRAINT `order3_foreign` FOREIGN KEY (`subOrder_id`) REFERENCES `sub_service_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user3_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insurance_services`
--
ALTER TABLE `insurance_services`
  ADD CONSTRAINT `foreign_order` FOREIGN KEY (`order_id`) REFERENCES `main_service_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `main_service_users`
--
ALTER TABLE `main_service_users`
  ADD CONSTRAINT `main_id_foreign` FOREIGN KEY (`main_service_id`) REFERENCES `main_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `new_services`
--
ALTER TABLE `new_services`
  ADD CONSTRAINT `order_foreign` FOREIGN KEY (`order_id`) REFERENCES `main_service_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p2_c_services`
--
ALTER TABLE `p2_c_services`
  ADD CONSTRAINT `order4_foreign` FOREIGN KEY (`subOrder_id`) REFERENCES `sub_service_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user4_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p2_p_services`
--
ALTER TABLE `p2_p_services`
  ADD CONSTRAINT `order1_foreign` FOREIGN KEY (`subOrder_id`) REFERENCES `sub_service_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user1_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_services`
--
ALTER TABLE `sub_services`
  ADD CONSTRAINT `main_service_id_foreign` FOREIGN KEY (`main_service_id`) REFERENCES `main_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_service_users`
--
ALTER TABLE `sub_service_users`
  ADD CONSTRAINT `sub_id_foreign` FOREIGN KEY (`sub_service_id`) REFERENCES `sub_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_foreign_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
