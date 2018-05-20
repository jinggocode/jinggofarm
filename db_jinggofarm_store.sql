-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2018 at 09:08 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jinggofarm_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'pelanggan', 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_alamat_pelanggan`
--

CREATE TABLE `tb_alamat_pelanggan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_alamat` int(11) DEFAULT NULL,
  `provinsi` int(11) DEFAULT NULL,
  `kota` int(11) DEFAULT NULL,
  `kecamatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_artikel`
--

CREATE TABLE `tb_artikel` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `isi` longtext,
  `foto` varchar(50) NOT NULL DEFAULT 'default.png',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_artikel`
--

INSERT INTO `tb_artikel` (`id`, `id_kategori`, `judul`, `slug`, `isi`, `foto`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Konsumsi Susu di Indonesia Masih Rendah di ASEAN', 'konsumsi-susu-di-indonesia-masih-rendah-di-asean', '<p><strong>VIVA</strong>&nbsp;&ndash;&nbsp;Jumlah konsumsi susu masyarakat Indonesia disebut masih rendah jika dibandingkan dengan negara-negara ASEAN. Berdasarkan data Kementerian Pertanian tahun 2016, konsumsi susu di Indonesia saat ini masih lebih rendah dibandingkan dengan negara lainnya yaitu hanya berkisar 11,8 liter per kapita per tahun termasuk produk olahan yang mengandung susu.&nbsp;</p>\r\n\r\n<p>Negara tetangga seperti Malaysia konsumsi susunya mencapai 36,2&nbsp;liter/kapita/tahun, Myanmar mencapai 26,7 liter/kapita/tahun, Thailand mencapai 22,2 liter/kapita/tahun, dan Filipina mencapai 17,8 liter/kapita/tahun. Kalaupun terjadi kenaikan angka tersebut tidak akan banyak melonjak.</p>\r\n\r\n<p>Kesadaran masyarakat Indonesia akan pentingnya manfaat yang bisa diperoleh hanya dari segelas susu rupanya menjadi perhatian tersendiri bagi salah satu perusahaan susu besar di Indonesia, Frisian Flag. Perusahaan yang terus berupaya meningkatkan kualitas susu sapi lokal ini heran dengan jumlah konsumsi susu masyarakat yang masih di angka sama selama bertahun-tahun.&nbsp;</p>\r\n\r\n<p>&quot;<em>Bayangin</em>&nbsp;kita bicara 10 sampai 15 tahun lalu, namanya promosi susu itu selalu ada, tapi kenapa? Itu adalah misteri yang harus dipecahkan semua pemangku kepentingan,&quot; kata Andrew F. Saputro,&nbsp;<em>Corporate Affairs Director</em>&nbsp;Frisian Flag Indonesia usai penutupan program Farmer2Farmer 2018, di Pasuruan, Jawa Timur, Rabu 28 Februari 2018.&nbsp;</p>\r\n\r\n<p><img alt=\"Konsumsi Susu Rendah : Perah Sapi\" src=\"https://static.viva.co.id/thumbs3/2010/05/18/89715_konsumsi_susu_rendah___perah_sapi_663_382.jpg\" style=\"height:auto; width:100%\" /></p>\r\n\r\n<p>&quot;Kalau di Indonesia apakah masalah di budaya atau edukasi di sekolah-sekolah kurang. Makanya kami punya Gerakan Nusantara minum susu kerja sama dengan Kementerian Pendidikan karena edukasi salah satu pilar penting. Kami&nbsp;ingin benar-benar ingin&nbsp;<em>crack the box</em>, kenapa kok kita bisa sampai kalah. Harapan kami adalah pemerintah bisa memberikan pencerahan atau bantuan,&quot; tuturnya.</p>\r\n\r\n<p>Perkembangan rata-rata konsumsi susu murni tahun 1993 hingga 2016 meningkat 1,86 liter/kapita/tahun, di mana penurunan tertinggi sebesar 50,24 persen terjadi pada 2009. Kesadaran masyarakat untuk mengonsumsi susu cair olahan, perlu ditingkatkan agar terus memaksimalkan serapan produksi susu sapi lokal. Salah satunya dengan mendorong industri untuk meningkatkan produksi produk susu olahan segar dibanding olahan bubuk.&nbsp;</p>\r\n\r\n<p><img alt=\"Menyaring susu sapi murni di Malang\" src=\"https://static.viva.co.id/thumbs3/2009/07/27/74329_menyaring_susu_sapi_murni_di_malang_663_382.jpg\" style=\"height:auto; width:100%\" /></p>', 'ART_PVZSWIBX_20180316082614.jpeg', '2018-03-16 19:45:25', 1, '2018-03-26 09:17:34', 1),
(2, 2, 'Keunggulan Sapi Perah', 'keunggulan-sapi-perah-1', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. LOLUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. LOLDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'ART_KGLQEGWG_20180316082657.jpg', '2018-03-16 20:26:57', 1, '2018-03-16 20:34:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bukti_transfer`
--

CREATE TABLE `tb_bukti_transfer` (
  `id` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `nama_rek` varchar(50) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bukti_transfer`
--

INSERT INTO `tb_bukti_transfer` (`id`, `id_pembelian`, `nama_rek`, `no_rek`, `foto`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 11, 'Rahmat Ramadhan', '564654', 'TF_OCIWPJEV_20180403041456.jpg', '1', '2018-04-03 04:14:56', 1, '2018-04-03 11:21:06', 1),
(2, 12, 'Lukman', '35465456421', 'TF_TDDLVMJX_20180403100935.jpeg', '1', '2018-04-03 10:09:35', 1, '2018-04-03 11:42:20', 1),
(3, 13, 'Ronaldo', '564654', 'TF_RFIMCZAF_20180403120654.jpeg', '1', '2018-04-03 12:06:55', 1, '2018-04-03 12:07:55', 1),
(4, 14, 'Rahmat', '1655654', 'TF_RXGZCGNZ_20180403121131.jpeg', '1', '2018-04-03 12:11:31', 1, '2018-04-03 12:11:50', 1),
(5, 15, 'Dimas', '126381232', 'TF_WKZHGNRE_20180409043716.jpg', '1', '2018-04-09 04:37:16', 25, '2018-04-09 05:33:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_pembelian`
--

CREATE TABLE `tb_detail_pembelian` (
  `id` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_pembelian`
--

INSERT INTO `tb_detail_pembelian` (`id`, `id_pembelian`, `id_produk`, `qty`, `subtotal`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 9, 4, 1, 100000, '2018-04-02 21:50:05', 1, NULL, NULL),
(4, 9, 5, 1, 100, '2018-04-02 21:50:05', 1, NULL, NULL),
(5, 10, 4, 1, 100000, '2018-04-02 22:10:53', 1, NULL, NULL),
(6, 10, 5, 1, 100, '2018-04-02 22:10:53', 1, NULL, NULL),
(7, 11, 6, 1, 150000, '2018-04-02 22:17:32', 1, NULL, NULL),
(8, 11, 7, 1, 20000, '2018-04-02 22:17:32', 1, NULL, NULL),
(9, 12, 7, 2, 40000, '2018-04-03 10:08:46', 1, NULL, NULL),
(10, 12, 6, 1, 150000, '2018-04-03 10:08:46', 1, NULL, NULL),
(11, 13, 7, 2, 40000, '2018-04-03 11:54:10', 1, NULL, NULL),
(12, 13, 6, 1, 150000, '2018-04-03 11:54:10', 1, NULL, NULL),
(13, 14, 6, 6, 900000, '2018-04-03 12:11:10', 1, NULL, NULL),
(14, 15, 6, 3, 450000, '2018-04-09 04:29:42', 25, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_artikel`
--

CREATE TABLE `tb_kategori_artikel` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_artikel`
--

INSERT INTO `tb_kategori_artikel` (`id`, `nama`) VALUES
(1, 'Umum'),
(2, 'Lain - lain');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_produk`
--

CREATE TABLE `tb_kategori_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_produk`
--

INSERT INTO `tb_kategori_produk` (`id`, `nama`) VALUES
(1, 'Makanan'),
(2, 'Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_konfirmasi_pembayaran`
--

CREATE TABLE `tb_konfirmasi_pembayaran` (
  `id` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `nama_rek` varchar(50) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kurir`
--

CREATE TABLE `tb_kurir` (
  `id` int(11) NOT NULL,
  `nama_kurir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(11) NOT NULL,
  `nama` int(11) DEFAULT NULL,
  `email` int(11) DEFAULT NULL,
  `no_telp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_penerima` varchar(50) DEFAULT NULL,
  `nomor_hp` varchar(13) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `kode_pembelian` varchar(10) DEFAULT NULL,
  `biaya_kirim` int(11) DEFAULT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  `provinsi_id` int(11) DEFAULT NULL,
  `detail_alamat` varchar(255) DEFAULT NULL,
  `kurir` enum('jne','tiki','pos') DEFAULT NULL,
  `status` enum('0','1','2','3','4') DEFAULT NULL COMMENT '0 : belum bayar, 1: sudah bayar, 2:valid menunggu resi, 3:resi dikirim, 4:batal tidak valid',
  `no_resi` varchar(50) DEFAULT NULL,
  `batas_bayar` int(11) DEFAULT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id`, `id_user`, `nama_penerima`, `nomor_hp`, `email`, `kode_pembelian`, `biaya_kirim`, `kabupaten_id`, `provinsi_id`, `detail_alamat`, `kurir`, `status`, `no_resi`, `batas_bayar`, `jumlah_bayar`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(11, 21, NULL, NULL, NULL, 'OR-0001', 19000, 31, 11, 'asd', 'pos', '2', NULL, NULL, 170000, '2018-04-02 22:17:32', 1, '2018-04-03 11:21:06', 1),
(12, 22, NULL, NULL, NULL, 'OR-0002', 8000, 179, 11, 'lorem', 'jne', '2', NULL, NULL, 190000, '2018-04-03 10:08:46', 1, '2018-04-03 11:42:20', 1),
(13, 23, NULL, NULL, NULL, 'OR-0003', 46000, 66, 15, 'lorem', 'jne', '3', NULL, NULL, 190000, '2018-04-03 11:54:10', 1, '2018-04-09 05:33:28', 1),
(14, 24, NULL, NULL, NULL, 'OR-0004', 7000, 51, 11, 'asd', 'jne', '4', NULL, NULL, 900000, '2018-04-03 12:11:10', 1, '2018-04-03 12:11:51', 1),
(15, 25, 'Dimas Ferian JJ', '082146631959', NULL, 'OR-0005', 7000, 51, 11, 'lorem', 'jne', '3', '123123', NULL, 450000, '2018-04-09 04:29:42', 25, '2018-04-09 05:38:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `deskripsi` longtext,
  `berat` int(11) DEFAULT NULL,
  `harga_produksi` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `sisa_stok` int(11) DEFAULT NULL,
  `foto` varchar(70) DEFAULT NULL,
  `status_kurir` enum('0','1') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id`, `id_kategori`, `nama`, `slug`, `deskripsi`, `berat`, `harga_produksi`, `harga_jual`, `stok`, `sisa_stok`, `foto`, `status_kurir`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, 2, 'Sabun Susu', 'sabun-susu-1', 'lorem ipsum', 100, NULL, 150000, 10, 4, 'PRD_PQUGDMAE_20180402101357.jpg', NULL, '2018-04-02 22:13:57', 1, '2018-04-09 05:33:39', 1),
(7, 1, 'Yogurt', 'yogurt', 'lorem', 100, NULL, 20000, 5, 5, 'PRD_LEMIAPEM_20180402101503.jpg', NULL, '2018-04-02 22:15:04', 1, '2018-04-08 15:23:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '2',
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `first_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `provinsi_id` int(11) DEFAULT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  `detail_alamat` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `group_id`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `phone`, `provinsi_id`, `kabupaten_id`, `detail_alamat`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '192.168.137.1', 1, 'admin', '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', '', 'admin@admin.com', NULL, NULL, NULL, NULL, 0, 1523243261, 1, 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-08 23:59:18', 25),
(6, '', 3, 'rahmat', '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', '', 'rahmat@rahmat.com', NULL, NULL, NULL, NULL, 0, 1519979910, 1, 'Rahmat', NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-08 23:59:18', 25),
(8, '::1', 3, NULL, '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', '', 'ronaldo@gmail.com', NULL, NULL, NULL, NULL, 1519614536, 1519628347, 1, 'Ronaldo', '082146631959', NULL, NULL, NULL, NULL, NULL, '2018-04-08 23:59:18', 25),
(9, '::1', 3, NULL, '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', '', 'edi@gmail.com', NULL, NULL, NULL, NULL, 1519723739, 1519725083, 1, 'Edi Siswanto', '0822526535', NULL, NULL, NULL, NULL, NULL, '2018-04-08 23:59:18', 25),
(10, '192.168.137.220', 3, NULL, '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', '', 'rukuman25@gmail.com', NULL, NULL, NULL, NULL, 1519878078, 1519878105, 1, 'Eman', '085331358840', NULL, NULL, NULL, NULL, NULL, '2018-04-08 23:59:18', 25),
(11, '192.168.137.1', 1, 'dimas', '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', '', '', NULL, NULL, NULL, NULL, 0, 1522061700, 1, 'dimas', NULL, NULL, NULL, NULL, '2018-03-26 12:41:33', 1, '2018-04-08 23:59:18', 25),
(21, '::1', 2, NULL, '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', NULL, 'rahmatramadhan.ti.poliwangi@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Rahmat', '85735030674', NULL, NULL, NULL, '2018-04-02 22:17:32', 1, '2018-04-08 23:59:18', 25),
(22, '::1', 2, NULL, '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', NULL, 'lukman@lukman.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Lukman', '082146631959', NULL, NULL, NULL, '2018-04-03 10:08:46', 1, '2018-04-08 23:59:18', 25),
(23, '::1', 2, NULL, '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', NULL, 'hendri@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Hendriyanto', '08524562123', NULL, NULL, NULL, '2018-04-03 11:54:10', 1, '2018-04-08 23:59:18', 25),
(24, '::1', 2, NULL, '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', NULL, 'rahmatramadhan.ti.poliwangi@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Rahmat', '85735030674', NULL, NULL, NULL, '2018-04-03 12:11:10', 1, '2018-04-08 23:59:18', 25),
(25, '::1', 2, NULL, '$2y$10$v67c71lQ/pdo8UkeJm9skevVuubRpdVqCtDuB5gAHiAHb/iUEOxWm', NULL, 'dimas@dimas.com', NULL, NULL, NULL, NULL, 0, 1523256647, 1, 'Dimas Ferian JJ', '082146631959', 11, 51, 'lorem', '2018-04-08 17:10:36', 1, '2018-04-09 03:45:41', 25);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'operator', 'Operator'),
(3, 'investor', 'Investor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_alamat_pelanggan`
--
ALTER TABLE `tb_alamat_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_artikel`
--
ALTER TABLE `tb_artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tb_artikel_tb_kategori_artikel` (`id_kategori`);

--
-- Indexes for table `tb_bukti_transfer`
--
ALTER TABLE `tb_bukti_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tb_bukti_transfer_tb_pembelian` (`id_pembelian`);

--
-- Indexes for table `tb_detail_pembelian`
--
ALTER TABLE `tb_detail_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori_artikel`
--
ALTER TABLE `tb_kategori_artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_konfirmasi_pembayaran`
--
ALTER TABLE `tb_konfirmasi_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__tb_pembelian` (`id_pembelian`);

--
-- Indexes for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__tb_kategori_produk` (`id_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_users_groups` (`group_id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_alamat_pelanggan`
--
ALTER TABLE `tb_alamat_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_artikel`
--
ALTER TABLE `tb_artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_bukti_transfer`
--
ALTER TABLE `tb_bukti_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_detail_pembelian`
--
ALTER TABLE `tb_detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_kategori_artikel`
--
ALTER TABLE `tb_kategori_artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_konfirmasi_pembayaran`
--
ALTER TABLE `tb_konfirmasi_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_artikel`
--
ALTER TABLE `tb_artikel`
  ADD CONSTRAINT `FK_tb_artikel_tb_kategori_artikel` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori_artikel` (`id`);

--
-- Constraints for table `tb_bukti_transfer`
--
ALTER TABLE `tb_bukti_transfer`
  ADD CONSTRAINT `FK_tb_bukti_transfer_tb_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `tb_pembelian` (`id`);

--
-- Constraints for table `tb_konfirmasi_pembayaran`
--
ALTER TABLE `tb_konfirmasi_pembayaran`
  ADD CONSTRAINT `FK__tb_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `tb_pembelian` (`id`);

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `FK__tb_kategori_produk` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori_produk` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
