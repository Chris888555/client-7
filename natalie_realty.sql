-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 10:23 PM
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
-- Database: `natalie_realty`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `page_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_contents`
--

CREATE TABLE `marketing_contents` (
  `id` int(11) NOT NULL,
  `caption` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketing_contents`
--

INSERT INTO `marketing_contents` (`id`, `caption`, `image`, `created_at`, `updated_at`) VALUES
(18, 'Sure, what\'s the context for the caption you\'d like to create? Are we talking about a social media post, an advertisement, or something else? And any specific details or themes you\'d like to include? Let me know how I can help!', 'marketing_image/MCZRiV9Qw2QapYRy0FoqMJqqj1AbNGvVzXzIoTAe.jpg', '2025-03-26 04:25:15', '2025-03-26 04:25:15'),
(21, 'Sure, what\'s the context for the caption you\'d lik.', 'marketing_image/KjNL9oeLlth98tKqsUezibXcW3H43OvhV5ABOr4K.jpg', '2025-04-07 07:07:19', '2025-04-07 07:07:19'),
(22, 'Sure, what\'s the context for the caption you\'d lik.', 'marketing_image/HWL6639qfcmALctUhqvRUn4EZvN9gPMAjRwsJJgg.jpg', '2025-04-07 07:07:34', '2025-04-07 07:07:34'),
(23, 'Sure, what\'s the context for the caption you\'d lik.', 'marketing_image/mgyZOswCeGIk46PQheD0HQpgnn6GrL1sJif8owCD.jpg', '2025-04-07 07:07:47', '2025-04-07 07:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(9, '0001_01_01_000001_create_cache_table', 2),
(10, '0001_01_01_000002_create_jobs_table', 2),
(11, '2025_03_08_125104_update_users_table', 2),
(12, '2025_03_08_125422_update_users_table', 2),
(14, '2025_03_10_160812_add_subdomain_to_users_table', 3),
(15, '2025_03_13_202019_add_referral_code_to_users_table', 4),
(16, '2025_03_13_223028_create_members_table', 5),
(17, '2025_03_13_233017_add_referral_columns_to_users_table', 6),
(18, '2025_03_14_110111_add_referral_code_and_referred_by_to_users_table', 7),
(19, '2025_03_14_144215_create_playlists_table', 8),
(20, '2025_03_14_155055_add_thumbnail_url_to_playlists_table', 9),
(21, '2025_03_17_220023_create_brands_table', 10),
(22, '2025_03_17_220245_create_checkouts_table', 11),
(24, '2025_03_17_220437_add_shipping_rules_to_products_table', 12),
(25, '2025_03_31_191410_create_funnel_pages_table', 13),
(26, '2025_03_31_201956_create_clients_table', 14),
(27, '2025_04_12_134254_create_video_view_progress_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thumbnail_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `video_link`, `created_at`, `updated_at`, `thumbnail_url`) VALUES
(8, 'Forex Module One', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4', '2025-03-14 10:07:47', '2025-04-07 07:11:14', 'thumbnails/j3liGkxUjywAFllhgnd2xtz1q0WF3UssRjqote5z.png'),
(9, 'Forex Module Two', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4', '2025-03-14 10:08:04', '2025-04-07 07:11:02', 'thumbnails/15hwP5tMLCFRZd7lJmjOwBj7kSXrRwp4wGQm0GGt.jpg'),
(15, 'Forex Module Three', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4', '2025-04-07 06:04:25', '2025-04-07 07:10:47', 'thumbnails/BwTg98NC4VM6knUfLpru6xCH9rBk69RTyJwtSeai.jpg'),
(16, 'Forex Module Four', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4', '2025-04-07 07:10:25', '2025-04-07 07:10:25', 'thumbnails/yNOCP3nI7bhfYPMkilt4ECLRH5nWJAMCYkdwxxq8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5njEbF1p7hVnbEYZzlSxD0F9LTI8yFs5jcAvdzWY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekZiV1ZYdURSTldaRHNGelBvR2Jlc2xTVHlVQ3N4N1p2UjdYUG5hbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744489247),
('QbqvhDT4M1kke3FfWHpZRuB68VdnU3nqQFciznUv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGhYdFNkeW4wM3J0U0taWmNzOHVjQ2tpaVJ1RFZXZE1jbVIweW92YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744489247),
('Ry9oNtumil7iZIJoL7jlKpUmoWM2148Xv6eZCd06', 152, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMDFUUGFWMDdnS3BST0ZoTTZTdUZHbjJYWnlWZWtYRGhqc29tZmpvWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92aWRlby1hbmFseXRpY3M/cGFnZT0xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTUyO30=', 1744489276);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subdomain` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `password_reset_expires` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `profile_picture` varchar(255) DEFAULT NULL,
  `default_profile` varchar(255) DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `facebook_link` varchar(255) DEFAULT 'https://www.facebook.com/princeonlinegenius',
  `join_fb_group` varchar(255) DEFAULT NULL,
  `page_link` varchar(255) NOT NULL DEFAULT 'https://www.facebook.com/page-link',
  `page_toggle` tinyint(1) NOT NULL DEFAULT 0,
  `group_toggle` tinyint(1) NOT NULL DEFAULT 0,
  `headline` varchar(255) DEFAULT NULL,
  `subheadline` varchar(255) DEFAULT NULL,
  `video_link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_id`, `name`, `email`, `subdomain`, `email_verified_at`, `password`, `created_at`, `updated_at`, `password_reset_token`, `password_reset_expires`, `is_admin`, `approved`, `profile_picture`, `default_profile`, `is_online`, `facebook_link`, `join_fb_group`, `page_link`, `page_toggle`, `group_toggle`, `headline`, `subheadline`, `video_link`) VALUES
(152, NULL, 'Christian De Lumnen', 'admin@gmail.com', 'admin', NULL, '$2y$12$WuGqW5AGL6Cc1zNoK4u2IOff60groGEA1gJUDNa6sc.FKtEv2pvOq', '2025-04-12 10:14:01', '2025-04-12 10:14:01', NULL, NULL, 1, 1, NULL, 'profile_photos/profile_1744481641.jpg', 0, 'https://www.facebook.com/your-messenger-link', 'https://www.facebook.com/your-gc-group-link', 'https://www.facebook.com/page-link', 0, 0, 'Struggling to Make Sales? This Funnel Does the Selling For You', 'Automate your leads, boost your sales, and grow your business — even while you sleep', 'https://www.youtube.com/embed/ccbp7R1li3w');

-- --------------------------------------------------------

--
-- Table structure for table `video_watch_progress`
--

CREATE TABLE `video_watch_progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `progress` float DEFAULT 0,
  `max_watch_percentage` float DEFAULT 0,
  `user_cookie` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_watch_progress`
--

INSERT INTO `video_watch_progress` (`id`, `user_id`, `video_link`, `progress`, `max_watch_percentage`, `user_cookie`, `created_at`, `updated_at`) VALUES
(10, 152, 'https://www.youtube.com/embed/ccbp7R1li3w', 40.8164, 85.5651, 'user_l6ssnxcj9', '2025-04-12 11:52:45', '2025-04-12 11:54:58'),
(12, 152, 'https://www.youtube.com/embed/ccbp7R1li3w', 40.7668, 40.7668, 'user_kw2m2ww2o', '2025-04-12 12:03:23', '2025-04-12 12:03:40'),
(13, 152, 'https://www.youtube.com/embed/ccbp7R1li3w', 0.158624, 0.158624, 'user_8est4gtfs', '2025-04-12 12:04:05', '2025-04-12 12:04:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`),
  ADD KEY `clients_page_id_foreign` (`page_id`);

--
-- Indexes for table `marketing_contents`
--
ALTER TABLE `marketing_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `subdomain` (`subdomain`),
  ADD UNIQUE KEY `google_id` (`google_id`);

--
-- Indexes for table `video_watch_progress`
--
ALTER TABLE `video_watch_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_watch_progress_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `marketing_contents`
--
ALTER TABLE `marketing_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `video_watch_progress`
--
ALTER TABLE `video_watch_progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_watch_progress`
--
ALTER TABLE `video_watch_progress`
  ADD CONSTRAINT `video_watch_progress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
