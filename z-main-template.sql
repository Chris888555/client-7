-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 11:44 PM
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
-- Database: `z-main-template`
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
-- Table structure for table `funnel_page_views`
--

CREATE TABLE `funnel_page_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_cookie` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funnel_page_views`
--

INSERT INTO `funnel_page_views` (`id`, `user_id`, `user_cookie`, `created_at`, `updated_at`) VALUES
(12, 152, 'user-rBQ6P4', '2025-04-16 06:42:33', '2025-04-16 06:42:33'),
(13, 152, 'd8c2400c-0054-4044-95f3-f2a3d3f8582e', '2025-04-16 06:44:29', '2025-04-16 06:44:29'),
(14, 152, 'dbd2e396-35b6-48fd-a0ba-3aef798c3f73', '2025-04-16 07:52:02', '2025-04-16 07:52:02');

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
(27, '2025_04_12_134254_create_video_view_progress_table', 15),
(28, '2025_04_16_164633_create_nav_settings_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `nav_settings`
--

CREATE TABLE `nav_settings` (
  `id` int(11) NOT NULL,
  `nav_bg_color` varchar(20) DEFAULT NULL,
  `nav_text_color` varchar(20) DEFAULT NULL,
  `nav_text_list_hover_color` varchar(20) DEFAULT NULL,
  `nav_list_bg_hover_color` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nav_settings`
--

INSERT INTO `nav_settings` (`id`, `nav_bg_color`, `nav_text_color`, `nav_text_list_hover_color`, `nav_list_bg_hover_color`, `created_at`, `updated_at`) VALUES
(3, '#6243b6', '#f2f2f2', '#555190', '#ffffff', '2025-04-16 12:47:38', '2025-04-16 13:23:13');

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
('BE4D7lA4gzbHQn5YUwmXxnriIKMLUajkTO4OUmKb', 174, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSHhLaDh2OTlGOXFOYnNFSUNjMktOaWlHbXZMUzQ0RVdDOU9oNVB1cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNzQ7fQ==', 1744839362),
('tRLtySYkDnokECN8tjkJJVpdyusOxDNqS8DFuMEo', 152, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZXR6OEZGTFAxS21vSlBOTUQ4SGNPQ1U3aUxvdTIxRkNPdjFDTlhIZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9uYXYtc2V0dGluZ3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNTI7fQ==', 1744839438);

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
(152, NULL, 'Christian De Lumnen', 'admin@gmail.com', 'admin3', NULL, '$2y$12$xbDX48//thrU0UfZbvqZJ.YcrBntExIxVcVP0Hm5nuVDF0Sjm2ufC', '2025-04-12 10:14:01', '2025-04-16 07:55:43', NULL, NULL, 1, 1, 'profile_photos/profile_1744812101.jpg', 'profile_photos/profile_1744481641.jpg', 0, 'https://www.facebook.com/your-messenger-link', 'https://www.facebook.com/your-gc-group-link', 'https://www.facebook.com/page-link', 0, 0, 'Struggling to Make Sales? This Funnel Does the Selling For You2', 'Automate your leads, boost your sales, and grow your business — even while you sleep', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4'),
(174, NULL, 'Maylene Gaspar', 'maylene@gmail.com', 'maylene', NULL, '$2y$12$cfK0.r.bcvuIjXEQlNsZqOd3v2PBd35aVdYz04aaBKSd6hx2ldaHK', '2025-04-15 07:25:29', '2025-04-16 12:26:06', NULL, NULL, 0, 1, 'profile_photos/profile_1744807765.jpg', 'profile_photos/profile_1744730728.jpg', 0, 'https://www.facebook.com/your-messenger-link', 'https://www.facebook.com/your-gc-group-link', 'https://www.facebook.com/page-link', 0, 0, 'Struggling to Make Sales? This Funnel Does the Selling For You2', 'Automate your leads, boost your sales, and grow your business — even while you sleep', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4');

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
(36, 152, 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4', 5.47638, 62.7758, 'user_slxc5hdw0', '2025-04-16 07:39:16', '2025-04-16 07:46:27');

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
-- Indexes for table `funnel_page_views`
--
ALTER TABLE `funnel_page_views`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `nav_settings`
--
ALTER TABLE `nav_settings`
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
-- AUTO_INCREMENT for table `funnel_page_views`
--
ALTER TABLE `funnel_page_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `marketing_contents`
--
ALTER TABLE `marketing_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `nav_settings`
--
ALTER TABLE `nav_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `video_watch_progress`
--
ALTER TABLE `video_watch_progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
