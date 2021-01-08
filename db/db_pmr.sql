-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 05, 2020 at 05:06 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pmr`
--

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `filename`, `info`, `created_at`, `updated_at`) VALUES
(2, '1580485076.jpg', 'lorem ipsum dolor set amet consectetur', '2020-01-31 07:37:56', '2020-01-31 07:37:56'),
(3, '1580485390.jpg', 'lorem ipsum learning image design', '2020-01-31 07:43:10', '2020-01-31 07:43:10'),
(7, '1580488358.jpg', 'elearning lorem ipsum dolor', '2020-01-31 08:32:38', '2020-01-31 08:32:38'),
(8, '1580488380.jpg', 'design lorem ipsum dolor set amet consectetur', '2020-01-31 08:33:00', '2020-01-31 08:33:00'),
(9, '1580488401.png', 'beautifl nature digital art lorem ipsum', '2020-01-31 08:33:21', '2020-01-31 08:33:21'),
(10, '1580488416.jpg', 'lorem ipsum dolor set amets', '2020-01-31 08:33:36', '2020-01-31 08:35:05'),
(11, '1580488461.jpg', 'lorem1', '2020-01-31 08:34:21', '2020-02-04 01:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pelaksana` date NOT NULL,
  `waktu_pelaksana` time NOT NULL,
  `panitia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dilihat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `tgl_pelaksana`, `waktu_pelaksana`, `panitia`, `deskripsi_kegiatan`, `foto`, `dilihat`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum Az', '2020-02-11', '14:23:00', 'Lorem Is', 'lorem ipsdfsf1', '1580627642.jpg', '1,10,1,10,1,10,1,1,1,1', '2020-02-01 22:46:45', '2020-02-01 23:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sejarah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `struktur` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_struktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`id`, `sejarah`, `visi`, `struktur`, `img_struktur`, `created_at`, `updated_at`) VALUES
(1, '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n<br><br>\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage,\r\n\r\n<br><b></b>', '<h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '<h2>Where can I get some?</h2><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.<br><br></p><p><ul><li>lorem ipsum</li><li>dolor set amet</li><li>consectetur</li></ul></p>', NULL, NULL, '2020-02-05 06:58:49');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `filename`, `info`, `created_at`, `updated_at`) VALUES
(1, '1580567641.pdf', 'lorem ipsum file', '2020-02-01 06:34:01', '2020-02-01 06:34:01'),
(2, '1580567683.pdf', 'permenkes, data farmasis', '2020-02-01 06:34:43', '2020-02-01 07:02:55'),
(3, '1580867263.pdf', 'test2', '2020-02-04 17:47:43', '2020-02-04 17:47:54');

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
(3, '2020_01_30_130023_create_user_details_table', 1),
(4, '2020_01_31_124816_create_gallery_table', 2),
(5, '2020_02_01_130137_create_materi_table', 3),
(6, '2020_02_01_152921_create_pengumuman_table', 4),
(7, '2020_02_02_022300_create_content_table', 5),
(10, '2020_02_02_055753_create_activity_table', 6);

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
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengumuman` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dilihat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `pengumuman`, `dilihat`, `created_at`, `updated_at`) VALUES
(2, 'Pengumuman Orem Ipsu', '<strong>Lorem Ipsum</strong>&nbsp;is <i>simply </i><u>dummy </u>text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. <br><br>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <b>yeah</b>!<br>', '1,10,1,10,1,1,10,1,1', '2020-02-01 09:19:39', '2020-02-01 09:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','non_aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ashta V', 'ashta@gmail.com', 'admin', NULL, '$2y$10$fUnYr6G/bT2ImQQ1HkASCOL3E75oMtZ2ZjTlFcBXsAnyuO1cnZWs2', NULL, 'aktif', NULL, '2020-02-05 08:59:28', NULL),
(9, 'Daniel Jango', 'daniel@gmail.com', 'member', NULL, '12345', NULL, 'non_aktif', '2020-01-30 07:45:31', '2020-01-31 04:36:37', NULL),
(10, 'Rizki Warzukis', 'rizki@gmail.com', 'member', NULL, '$2y$10$la1SZIwUuOY0eDixRe01xehlg3tl7HvqPfkWMrhfkbI7i2OjN6NvG', NULL, 'aktif', '2020-01-30 07:46:19', '2020-02-02 00:19:52', NULL),
(11, 'Ngurah Maharta', 'ngurah@gmail.com', 'member', NULL, '$2y$10$Shj4VTbVXHT7D.4RhyR8zew0cddeMusG/YgiBJcEQqpaVXtr6FVnW', NULL, 'aktif', '2020-01-30 07:47:24', '2020-02-04 01:10:42', NULL),
(13, 'Putri Mios', 'mia@gmail.com', 'member', NULL, 'secret', NULL, 'aktif', '2020-01-30 07:50:00', '2020-02-05 08:55:01', NULL),
(14, 'Lorem Ipsum', 'lorem@gmail.com', 'member', NULL, '$2y$10$UgdpgIwP4Lq/OyjTNENK4eqB0vTe.qvgi/FPVvhX0xaz4Lgkbyvr2', NULL, 'aktif', '2020-02-04 01:07:52', '2020-02-05 08:54:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tmp_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'laki-laki',
  `gol_darah` enum('A','B','AB','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` enum('buddha','hindu','islam','katolik','konghucu','kristen','none') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `tgl_lahir`, `tmp_lahir`, `jk`, `gol_darah`, `agama`, `foto`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, '1994-01-29', 'Denpasar', 'laki-laki', 'A', 'hindu', '1580616480.png', '081999111', 'Jl. Lorem Ipsum Denpasar', NULL, '2020-02-01 20:08:00'),
(9, '1993-10-12', 'Tabanan', 'laki-laki', NULL, 'katolik', NULL, '08111111', 'Jl. Lorem Ipsum Dolor Tabanan', '2020-01-30 07:45:31', '2020-01-31 04:38:03'),
(10, '1992-10-12', 'Medan', 'laki-laki', NULL, 'islam', NULL, '0810000000', 'Jl. Lorem Ipsum Kapal Mengwi', '2020-01-30 07:46:19', '2020-01-30 07:46:19'),
(11, '1933-10-12', 'Denpasar', 'laki-laki', 'O', 'hindu', NULL, '81000000123', '', '2020-01-30 07:47:24', '2020-02-04 01:10:42'),
(13, '1992-12-02', 'Jaya Pura', 'perempuan', NULL, 'hindu', NULL, '081212121', 'Jl. Lorem Ipsum Dolor St', '2020-01-30 07:50:00', '2020-01-31 04:38:44'),
(14, '2020-02-13', 'Denpasar', 'perempuan', 'B', 'buddha', NULL, '081000', 'Denpasar', '2020-02-04 01:07:52', '2020-02-04 01:07:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
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
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konten`
--
ALTER TABLE `konten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
