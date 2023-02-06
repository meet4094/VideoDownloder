-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 11:46 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allinoneviddown`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_calls`
--

CREATE TABLE `api_calls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` int(11) NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `api_calls`
--

INSERT INTO `api_calls` (`id`, `app_id`, `device_id`, `app_token`, `package_name`, `app_version`, `version_code`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 9, 'TEST4', '', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 04:43:39', NULL),
(2, 9, 'TEST4', '', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 04:44:28', NULL),
(3, 9, 'TEST4', '', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 04:45:58', NULL),
(4, 9, 'TEST4', '', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 04:46:12', NULL),
(5, 9, 'TEST4', '', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 04:55:19', NULL),
(6, 9, 'TEST4', '', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 04:55:57', NULL),
(7, 9, 'TEST4', '', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 13:33:49', NULL),
(8, 9, 'TEST4', 'i6vX0Gd2luQwSMM', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 13:45:57', NULL),
(9, 9, 'TEST4', 'oT758Tz5sqtkqCJ', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 13:46:37', NULL),
(10, 9, 'TEST4', 'qDn2SiNErbLgtnf', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 13:48:10', NULL),
(11, 9, 'TEST4', 'lTnVks2rqsbDK47', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 13:48:45', NULL),
(12, 9, 'TEST4', '5Jo1RImoYAgOMko', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 13:52:41', NULL),
(13, 9, 'TEST4', 'GBqoVc9v02Qn5MF', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 13:54:50', NULL),
(14, 9, 'TEST4', 'AoDofObsMSdqKUc', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-30 14:02:00', NULL),
(15, 9, 'TEST4', 'WVHteS1nfl50aNG', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-31 06:35:07', NULL),
(16, 9, 'TEST4', 't7GfTENrTXqniGQ', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-31 06:35:36', NULL),
(17, 9, 'TEST4', 'iLMB9SxRHOo3f2X', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-31 06:35:56', NULL),
(18, 9, 'TEST4', 'Jq9gOryD7a4uD8N', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-31 06:42:06', NULL),
(19, 3, 'TEST4', 'UwGuD2NUHGKwmut', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-31 06:59:13', NULL),
(20, 3, 'TEST4', 'uzgXI4FPfz3DFlQ', 'XYZ', '1.1', '123', '127.0.0.1', '2023-01-31 07:19:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buttons`
--

CREATE TABLE `buttons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `button_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_del` tinytext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 = Desible, 0 = Enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buttons`
--

INSERT INTO `buttons` (`id`, `button_name`, `button_slug`, `created_at`, `updated_at`, `is_del`) VALUES
(1, 'Youtube Video Downloader', 'youtube-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(2, 'Dailymotion Video Downloader', 'dailymotion-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(3, 'Espn Video Downloader', 'espn-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(4, 'Odnoklassniki Video Downloader', 'odnoklassniki-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(5, 'Mashable Video Downloader', 'mashable-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(6, 'Tumblr Video Downloader', 'tumblr-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(7, 'Buzzfeed Video Downloader', 'buzzfeed-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(8, 'Instagram Video Downloader', 'instagram-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(9, 'Liveleak Video Downloader', 'liveleak-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(10, 'Break Video Downloader', 'break-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(11, 'Twitter Video Downloader', 'twitter-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(12, 'Vimeo Video Downloader', 'vimeo-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(13, 'Soundcloud Music Downloader', 'soundcloud-music-downloader', '2023-01-30 04:29:41', NULL, '1'),
(14, 'Izlesene Video Downloader', 'izlesene-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(15, 'Tiktok Video Downloader', 'tiktok-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(16, 'Bandcamp Music Downloader', 'bandcamp-music-downloader', '2023-01-30 04:29:41', NULL, '1'),
(17, 'Imgur Video Downloader', 'imgur-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(18, 'Imdb Video Downloader', 'imdb-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(19, 'Flickr Video Downloader', 'flickr-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(20, 'Facebook Video Downloader', 'facebook-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(21, '9GAG Video Downloader', '9gag-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(22, 'TED Video Downloader', 'ted-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(23, 'Vkontakte Video Downloader', 'vk-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(24, 'Pinterest Video Downloader', 'pinterest-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(25, 'Likee Video Downloader', 'likee-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(26, 'Twitch Video Downloader', 'twitch-clip-downloader', '2023-01-30 04:29:41', NULL, '1'),
(27, 'Blogger Video Downloader', 'blogger-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(28, 'Reddit Video Downloader', 'reddit-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(29, 'Douyin Video Downloader', 'douyin-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(30, 'Kwai Video Downloader', 'kwai-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(31, 'Linkedin Video Downloader', 'linkedin-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(32, 'Streamable Video Downloader', 'streamable-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(33, 'Bitchute Video Downloader', 'bitchute-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(34, 'Akıllı TV Video', 'akillitv-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(35, 'Gaana Music Downloader', 'gaana-music-downloader', '2023-01-30 04:29:41', NULL, '1'),
(36, 'Periscope Video Downloader', 'periscope-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(37, 'Rumble Video Downloader', 'rumble-video-downloader', '2023-01-30 04:29:41', NULL, '0'),
(38, 'Febspot Video Downloader', 'febspot-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(39, 'Bilibili Video Downloader', 'bilibili-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(40, 'PuhuTV Video Downloader', 'puhutv-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(41, 'BluTV Video Downloader', 'blutv-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(42, '4Anime Video Downloader', '4anime-video-downloader', '2023-01-30 04:29:41', NULL, '1'),
(43, 'MXTakatak Video Downloader', 'mxtakatak-video-downloader', '2023-01-30 04:29:41', NULL, '1');

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
(5, '2023_01_23_035133_setting', 2),
(6, '2023_01_23_040319_setting', 3),
(7, '2023_01_25_144842_create_flights_table', 4),
(8, '2023_01_25_145151_create_buttons_table', 5),
(9, '2023_01_26_134344_create_videos_table', 6),
(10, '2023_01_26_135516_create_api_calls_table', 7);

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
-- Table structure for table `proxies`
--

CREATE TABLE `proxies` (
  `ID` int(11) NOT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `port` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(14) DEFAULT NULL,
  `usage_count` bigint(20) NOT NULL DEFAULT 0,
  `banned` int(14) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_del` tinytext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_name`, `package_name`, `account_name`, `request_token`, `app_version`, `created_at`, `updated_at`, `is_del`) VALUES
(3, 'abcd1', 'abcd1', 'abcd1', 'g5sJ26RgZdm3i4u', 'abcd1', '2023-01-25 14:18:31', NULL, '0'),
(9, 'Test', 'Test', 'Test', '1vBnKoEj8FGRaID', '1', '2023-01-27 14:19:13', NULL, '0');

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin@123.com', NULL, '$2y$10$k9b.nLGTla3XiRMtJGtAi.rkNVzankIpK4TtIL95nrjNcw/EZ9eiy', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `download_meta` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `download_links` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `download_source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `devices_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `download_meta`, `download_links`, `download_source`, `devices_id`, `created_at`, `updated_at`) VALUES
(1, '{\"title\":\"Popatlal \\u0915\\u094b \\u0915\\u094d\\u092f\\u094b\\u0902 \\u0939\\u0948 Jethalal \\u092a\\u0930 \\u0936\\u0915? | Taarak Mehta Ka Ooltah Chashmah | Patrakar Popatlal - YouTube\",\"thumbnail\":\"https:\\/\\/i.ytimg.com\\/vi\\/7bZzqRK-UFc\\/maxresdefault.jpg\",\"video_url\":\"https:\\/\\/youtu.be\\/7bZzqRK-UFc\",\"client_ip\":\"::1\"}', '', 'youtube', 'TEST4', '2023-01-31 06:52:21', NULL),
(2, '{\"title\":\"PM Modi \\u0915\\u093e Opposition \\u0915\\u094b \\u0932\\u0947\\u0915\\u0930 \\u092c\\u092f\\u093e\\u0928 \\u0915\\u0939\\u093e- \\u0924\\u0915\\u0930\\u093e\\u0930 \\u092d\\u0940 \\u0930\\u0939\\u0947\\u0917\\u0940, \\u0924\\u0915\\u0930\\u0940\\u0930 \\u092d\\u0940 \\u0924\\u094b \\u0939\\u094b\\u0928\\u0940 \\u091a\\u093e\\u0939\\u093f\\u090f I Budget Session 2023\",\"thumbnail\":\"https:\\/\\/s1.dmcdn.net\\/v\\/Ucttk1ZsE7cZTvqxP\\/x1080\",\"video_url\":\"https:\\/\\/dai.ly\\/x8hq8dq\",\"duration\":\"07:05\",\"client_ip\":\"::1\"}', '', 'dailymotion', 'TEST4', '2023-01-31 06:53:35', NULL),
(3, '{\"title\":\"PM Modi \\u0915\\u093e Opposition \\u0915\\u094b \\u0932\\u0947\\u0915\\u0930 \\u092c\\u092f\\u093e\\u0928 \\u0915\\u0939\\u093e- \\u0924\\u0915\\u0930\\u093e\\u0930 \\u092d\\u0940 \\u0930\\u0939\\u0947\\u0917\\u0940, \\u0924\\u0915\\u0930\\u0940\\u0930 \\u092d\\u0940 \\u0924\\u094b \\u0939\\u094b\\u0928\\u0940 \\u091a\\u093e\\u0939\\u093f\\u090f I Budget Session 2023\",\"thumbnail\":\"https:\\/\\/s2.dmcdn.net\\/v\\/Ucttk1ZsE7cZTvqxP\\/x1080\",\"video_url\":\"https:\\/\\/dai.ly\\/x8hq8dq\",\"duration\":\"07:05\",\"client_ip\":\"::1\"}', '', 'dailymotion', 'TEST4', '2023-01-31 06:32:49', NULL),
(4, '{\"title\":\"PM Modi \\u0915\\u093e Opposition \\u0915\\u094b \\u0932\\u0947\\u0915\\u0930 \\u092c\\u092f\\u093e\\u0928 \\u0915\\u0939\\u093e- \\u0924\\u0915\\u0930\\u093e\\u0930 \\u092d\\u0940 \\u0930\\u0939\\u0947\\u0917\\u0940, \\u0924\\u0915\\u0930\\u0940\\u0930 \\u092d\\u0940 \\u0924\\u094b \\u0939\\u094b\\u0928\\u0940 \\u091a\\u093e\\u0939\\u093f\\u090f I Budget Session 2023\",\"thumbnail\":\"https:\\/\\/s1.dmcdn.net\\/v\\/Ucttk1ZsE7cZTvqxP\\/x1080\",\"video_url\":\"https:\\/\\/dai.ly\\/x8hq8dq\",\"duration\":\"07:05\",\"client_ip\":\"::1\"}', '', 'dailymotion', 'TEST4', '2023-02-01 07:04:57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_calls`
--
ALTER TABLE `api_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buttons`
--
ALTER TABLE `buttons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `proxies`
--
ALTER TABLE `proxies`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_calls`
--
ALTER TABLE `api_calls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `buttons`
--
ALTER TABLE `buttons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proxies`
--
ALTER TABLE `proxies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
