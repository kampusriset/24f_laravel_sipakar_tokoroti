-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2026 at 01:46 PM
-- Server version: 8.4.3
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_roti`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan` int NOT NULL,
  `nama_bahan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_saat_ini` int NOT NULL,
  `stok_minimum` int NOT NULL,
  `harga_per_satuan` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bahan`, `nama_bahan`, `satuan`, `stok_saat_ini`, `stok_minimum`, `harga_per_satuan`, `created_at`, `updated_at`) VALUES
(1, 'Tepung Terigu Protein Tinggi', 'kg', 50, 10, 12000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(2, 'Tepung Terigu Serbaguna', 'kg', 30, 8, 10000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(3, 'Gula Pasir', 'kg', 25, 5, 15000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(4, 'Mentega', 'kg', 15, 3, 45000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(5, 'Telur Ayam', 'butir', 200, 50, 2500.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(6, 'Susu Cair', 'liter', 20, 5, 18000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(7, 'Coklat Bubuk', 'kg', 5, 1, 80000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(8, 'Keju Cheddar', 'kg', 8, 2, 90000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(9, 'Selai Nanas', 'kg', 10, 2, 35000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(10, 'Ragi Instan', 'gram', 1000, 200, 200.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 3, 8000.00, 24000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(2, 1, 4, 2, 8500.00, 17000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(3, 1, 7, 1, 12000.00, 12000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(4, 2, 1, 1, 18000.00, 18000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(5, 2, 3, 2, 8000.00, 16000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(6, 3, 9, 1, 120000.00, 120000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(7, 4, 2, 1, 22000.00, 22000.00, '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(11, 8, 9, 4, 12000.00, 48000.00, '2026-07-19 11:46:06', '2026-07-19 11:47:09'),
(12, 9, 3, 10, 8000.00, 80000.00, '2026-07-19 12:12:04', '2026-07-19 12:12:04'),
(13, 10, 1, 1, 18000.00, 18000.00, '2026-07-23 23:40:28', '2026-07-23 23:40:28'),
(14, 11, 2, 1, 22000.00, 22000.00, '2026-07-24 00:07:57', '2026-07-24 00:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_kategori` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Roti Tawar', 'Roti dengan tekstur lembut, biasa untuk sarapan', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(2, 'Roti Manis', 'Roti dengan isian coklat, keju, atau krim', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(3, 'Kue Kering', 'Kue kering seperti nastar, kastengel', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(4, 'Pastry', 'Croissant, Danish, Puff Pastry', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(5, 'Kue Basah', 'Brownies, Bolu, Lapis Legit', '2026-07-09 13:07:48', '2026-07-09 13:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_01_000001_add_custom_fields_to_users_table', 1),
(5, '2026_07_05_215357_create_personal_access_tokens_table', 1),
(6, '2026_07_24_080239_add_ai_fields_to_produk_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int NOT NULL,
  `nama_pegawai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` enum('Admin','Kasir') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `jabatan`, `no_telepon`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Andi Saputra', 'Admin', '081234567890', 'Surakarta', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(2, 'Budi Santoso', 'Kasir', '081234567891', 'Surakarta', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(3, 'Agus', 'Kasir', '082229836542', 'Boyolali', '2026-07-09 11:37:28', '2026-07-11 20:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `metode_pembayaran` enum('Tunai','QRIS','Debit','Transfer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_dibayar` decimal(15,2) NOT NULL,
  `jumlah_kembalian` decimal(15,2) DEFAULT '0.00',
  `tanggal_pembayaran` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `metode_pembayaran`, `jumlah_dibayar`, `jumlah_kembalian`, `tanggal_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tunai', 60000.00, 7000.00, '2025-01-15 02:35:00', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(2, 2, 'QRIS', 34000.00, 0.00, '2025-01-15 07:20:00', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(3, 3, 'Tunai', 150000.00, 30000.00, '2025-01-16 03:05:00', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(4, 4, 'Debit', 22000.00, 0.00, '2025-01-16 12:50:00', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(6, 8, 'Tunai', 100000.00, 52000.00, '2026-07-19 11:57:03', '2026-07-19 11:59:07', '2026-07-19 11:59:07'),
(7, 9, 'Tunai', 100000.00, 20000.00, '2026-07-19 12:12:16', '2026-07-19 12:12:46', '2026-07-19 12:12:46'),
(8, 10, 'Tunai', 20000.00, 2000.00, '2026-07-23 23:41:42', '2026-07-23 23:41:42', '2026-07-23 23:41:42'),
(9, 11, 'QRIS', 30000.00, 8000.00, '2026-07-24 00:14:37', '2026-07-24 00:14:37', '2026-07-24 00:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` int NOT NULL,
  `harga_jual` decimal(15,2) NOT NULL,
  `tingkat_manis` tinyint UNSIGNED DEFAULT NULL,
  `alergi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `id_kategori`, `harga_jual`, `tingkat_manis`, `alergi`, `keperluan`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Roti Tawar Putih', 1, 18000.00, 2, 'Gluten', 'Sarapan', 'Roti tawar putih tanpa kulit, 500 gram', 'produk/01KX5PCKJQDJZV7WRTY6CM3PRC.jpg', '2026-07-09 13:07:48', '2026-07-24 02:07:48'),
(2, 'Roti Tawar Gandum', 1, 22000.00, 2, 'Gluten', 'Sarapan', 'Roti tawar gandum utuh', 'produk/01KX5Q1SJ5HR4R781EPDWHYE08.jpg', '2026-07-09 13:07:48', '2026-07-24 02:08:30'),
(3, 'Roti Coklat', 2, 8000.00, 7, 'Gluten', 'Cemilan', 'Roti isi coklat', 'produk/01KX5QBW31Z67FR0CQC8XEQYKW.jpg', '2026-07-09 13:07:48', '2026-07-24 02:09:18'),
(4, 'Roti Keju', 2, 8500.00, 5, 'Susu', 'Cemilan', 'Roti isi keju cheddar', 'produk/01KX5QRJR28D2S9HY8T2YFDFC4.jpg', '2026-07-09 13:07:48', '2026-07-24 02:09:52'),
(5, 'Nastar', 3, 45000.00, 8, 'Gluten', 'Oleh-oleh', 'Kue nastar isi nanas', 'produk/01KX5QSKDVKV2J7WG78A6EZKT0.jpg', '2026-07-09 13:07:48', '2026-07-24 02:10:51'),
(6, 'Kastengel', 3, 50000.00, 3, 'Susu', 'Oleh-oleh', 'Kue keju gurih', 'produk/01KX5QT5VA5A39KZNB17AMTC84.jpg', '2026-07-09 13:07:48', '2026-07-24 02:11:26'),
(7, 'Croissant', 4, 12000.00, 4, 'Gluten', 'Sarapan', 'Croissant mentega', 'produk/01KX5QTQ4NS3ZRRFCNWXG1V31V.jpg', '2026-07-09 13:07:48', '2026-07-24 02:12:03'),
(8, 'Brownies Kukus', 5, 35000.00, 9, 'Telur', 'Hadiah', 'Brownies kukus coklat', 'produk/01KX5QV7CJ2JEMCXGEDZ135NM6.jpg', '2026-07-09 13:07:48', '2026-07-24 02:12:36'),
(9, 'Lapis Legit', 5, 60000.00, 9, 'Gluten', 'Oleh-oleh', 'Lapis legit tradisional', 'produk/01KXRNHMV2HKX4VR9YP9FND6D5.jpg', '2026-07-09 13:07:48', '2026-07-24 13:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_produk`
--

CREATE TABLE `stok_produk` (
  `id_stok_produk` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah_stok` int NOT NULL,
  `tanggal_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok_produk`
--

INSERT INTO `stok_produk` (`id_stok_produk`, `id_produk`, `jumlah_stok`, `tanggal_update`) VALUES
(1, 1, 99, '2026-07-23 23:41:43'),
(2, 2, 99, '2026-07-24 00:14:37'),
(3, 3, 90, '2026-07-19 12:12:46'),
(4, 4, 80, '2026-07-09 13:07:48'),
(5, 5, 90, '2026-07-09 13:07:48'),
(6, 6, 90, '2026-07-09 13:07:48'),
(7, 7, 100, '2026-07-09 13:07:48'),
(8, 8, 100, '2026-07-09 13:07:48'),
(9, 9, 100, '2026-07-09 13:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `tanggal_transaksi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_pegawai` int NOT NULL,
  `total_bayar` decimal(15,2) DEFAULT '0.00',
  `status_transaksi` enum('Pending','Selesai','Dibatalkan') COLLATE utf8mb4_unicode_ci DEFAULT 'Selesai',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `id_pegawai`, `total_bayar`, `status_transaksi`, `created_at`, `updated_at`) VALUES
(1, '2025-01-15 02:30:00', 2, 53000.00, 'Selesai', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(2, '2025-01-15 07:15:00', 2, 34000.00, 'Selesai', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(3, '2025-01-16 03:00:00', 2, 120000.00, 'Selesai', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(4, '2025-01-16 12:45:00', 2, 22000.00, 'Selesai', '2026-07-09 13:07:48', '2026-07-09 13:07:48'),
(8, '2026-07-19 18:44:29', 2, 48000.00, 'Selesai', '2026-07-19 11:45:12', '2026-07-19 12:36:57'),
(9, '2026-07-19 12:10:48', 2, 80000.00, 'Selesai', '2026-07-19 12:11:17', '2026-07-19 12:12:46'),
(10, '2026-07-23 23:27:40', 2, 18000.00, 'Selesai', '2026-07-23 23:27:58', '2026-07-23 23:41:43'),
(11, '2026-07-24 00:05:37', 2, 22000.00, 'Selesai', '2026-07-24 00:05:49', '2026-07-24 00:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kasir',
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `google_id`, `avatar`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$12$1T/7myQhpU0h3R7F.nzM7.p4Iiqw6zJGJbL/IZp30Q9krO.LvVH5m', NULL, '2026-07-09 11:12:11', '2026-07-09 11:12:11', 'admin', NULL, NULL),
(2, 'Budi Santoso', 'kasir1@gmail.com', NULL, '$2y$12$4lXgNe4MliULCtXf7/mgousrWlSmD526k0W9xoDLKZ3psjq1qxfjq', NULL, '2026-07-17 09:11:41', '2026-07-17 09:11:41', 'kasir', NULL, NULL),
(3, 'Agus', 'kasir2@gmail.com', NULL, '$2y$12$8YxxbGKbmMiXawCpkNPhfOWGv3oPb.88Fymp.lvg7qnQQMM/mpOMe', NULL, '2026-07-17 09:12:41', '2026-07-17 09:12:41', 'kasir', NULL, NULL),
(4, 'Andre Hannik', 'andrenordboyz@gmail.com', NULL, '$2y$12$PwuQREDmKd1/vhJIbKTeB.oALedne5zTRpQiqLPWqvifP95Jb64Q2', NULL, '2026-07-31 10:33:38', '2026-08-02 00:08:10', 'kasir', '108846511701895043264', 'https://lh3.googleusercontent.com/a/ACg8ocLth3xzjkXKAc_vSGsvs7k3K7IHbYxu9N-DzHENwZ4Mtdu6a-E=s96-c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_transaksi` (`id_transaksi`),
  ADD KEY `fk_detail_produk` (`id_produk`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`);

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
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `fk_pembayaran_transaksi` (`id_transaksi`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `fk_produk_kategori` (`id_kategori`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stok_produk`
--
ALTER TABLE `stok_produk`
  ADD PRIMARY KEY (`id_stok_produk`),
  ADD KEY `fk_stok_produk` (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_pegawai` (`id_pegawai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id_bahan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stok_produk`
--
ALTER TABLE `stok_produk`
  MODIFY `id_stok_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_detail_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_produk` (`id_kategori`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `stok_produk`
--
ALTER TABLE `stok_produk`
  ADD CONSTRAINT `fk_stok_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
