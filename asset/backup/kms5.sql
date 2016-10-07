-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2016 at 07:28 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kms`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('4d0cdc94597662c544f36a648802f060', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1475814106, 'a:16:{s:9:"user_data";s:0:"";s:7:"idkarya";s:6:"112392";s:8:"usrkarya";s:3:"212";s:9:"passkarya";s:40:"8cb2237d0679ca88db6464eac60da96345513964";s:9:"namekarya";s:17:"Rafles Nainggolan";s:8:"imgkarya";s:10:"avatar.png";s:10:"emailkarya";s:16:"rafles@gmail.com";s:11:"login_karya";b:1;s:5:"idusr";s:6:"112392";s:7:"nikuser";s:3:"212";s:8:"passuser";s:40:"8cb2237d0679ca88db6464eac60da96345513964";s:8:"nameuser";s:17:"Rafles Nainggolan";s:11:"level_admin";s:5:"staff";s:7:"picuser";s:10:"avatar.png";s:9:"emailuser";s:16:"rafles@gmail.com";s:12:"login_status";b:1;}'),
('76c4633650cb730ed142e32323b660d1', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', 1475817751, 'a:16:{s:9:"user_data";s:0:"";s:7:"idkarya";s:6:"112392";s:8:"usrkarya";s:3:"212";s:9:"passkarya";s:40:"8cb2237d0679ca88db6464eac60da96345513964";s:9:"namekarya";s:17:"Rafles Nainggolan";s:8:"imgkarya";s:10:"avatar.png";s:10:"emailkarya";s:16:"rafles@gmail.com";s:11:"login_karya";b:1;s:5:"idusr";s:6:"112393";s:7:"nikuser";s:3:"515";s:8:"passuser";s:40:"8cb2237d0679ca88db6464eac60da96345513964";s:8:"nameuser";s:5:"admin";s:11:"level_admin";s:5:"admin";s:7:"picuser";s:11:"avatar3.png";s:9:"emailuser";s:15:"admin@gmail.com";s:12:"login_status";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE `diskusi` (
  `id_diskusi` int(10) UNSIGNED NOT NULL,
  `judul_diskusi` varchar(255) NOT NULL,
  `ket_diskusi` text NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aktif` enum('Y','N') NOT NULL,
  `createby` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diskusi`
--

INSERT INTO `diskusi` (`id_diskusi`, `judul_diskusi`, `ket_diskusi`, `id_kategori`, `file_path`, `url`, `tgl_dibuat`, `aktif`, `createby`) VALUES
(4, 'tugas accounting', 'tugas accounting', 1, NULL, NULL, '2016-02-01 14:21:23', 'Y', '3'),
(5, 'Tigas IT', 'Tugas programmer', 1, NULL, NULL, '2016-02-01 14:21:29', 'Y', '3'),
(7, 'Perhitungan accountn g', 'Perhitungan accountn g', 2, NULL, NULL, '2016-02-01 23:39:07', 'Y', '3'),
(8, 'Info cara mengkoreksi', 'Info cara mengkoreksi', 2, NULL, NULL, '2016-02-05 00:07:10', 'Y', '3'),
(9, 'Info cara mengkoreksi data material bagaimana?', 'Info cara mengkoreksi data material bagaimana?', 1, NULL, NULL, '2016-02-05 00:08:54', 'Y', '3'),
(11, 'Tingkatkan pelayanan CS', 'Tingkatkan pelayanan CS Tingkatkan pelayanan CS Tingkatkan pelayanan CS Tingkatkan pelayanan CS', 3, NULL, NULL, '2016-09-26 22:37:32', 'Y', '212'),
(12, 'Tanggapi Keluhan Pelanggan segera', '                       \r\nTanggapi Keluhan Pelanggan segeraTanggapi Keluhan Pelanggan segeraTanggapi Keluhan Pelanggan segera', 3, NULL, NULL, '2016-09-26 22:38:51', 'Y', '212'),
(13, 'Terimakasi atas semua Pelayanan atas kerja IM', 'Terimakasi atas semua Pelayanan atas kerja IMTerimakasi atas semua Pelayanan atas kerja IMTerimakasi atas semua Pelayanan atas kerja IMTerimakasi atas semua Pelayanan atas kerja IMTerimakasi atas semua Pelayanan atas kerja IMTerimakasi atas semua Pelayanan atas kerja IMTerimakasi atas semua Pelayanan atas kerja IMTerimakasi atas semua Pelayanan atas kerja IMTerimakasi atas semua Pelayanan atas kerja IM', 3, NULL, NULL, '2016-09-26 22:47:44', 'Y', '313'),
(14, 'Tugas Project BAru', '                       \r\nTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAruTugas Project BAru', 1, NULL, NULL, '2016-09-26 22:48:36', 'Y', '313'),
(15, 'pembuatan amnesti pajak', '                       \r\npembuatan amnesti pajakpembuatan amnesti pajakpembuatan amnesti pajakpembuatan amnesti pajakpembuatan amnesti pajakpembuatan amnesti pajakpembuatan amnesti pajak', 2, NULL, NULL, '2016-10-07 15:05:46', 'Y', '212');

-- --------------------------------------------------------

--
-- Table structure for table `diskusi_detail`
--

CREATE TABLE `diskusi_detail` (
  `id_diskusi_detail` int(10) UNSIGNED NOT NULL,
  `id_diskusi` int(10) UNSIGNED NOT NULL,
  `komentar` text NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diskusi_detail`
--

INSERT INTO `diskusi_detail` (`id_diskusi_detail`, `id_diskusi`, `komentar`, `id_karyawan`, `tgl_dibuat`) VALUES
(1, 4, 'Lorem ipsum dolor sita amet', 212, '2016-02-02 13:48:39'),
(2, 4, 'Lorem ipsum dolor sita ametLorem ipsum dolor sita amet', 212, '2016-02-03 03:45:42'),
(3, 5, 'wah bagus tuh', 414, '2016-07-24 08:20:45'),
(4, 4, 'Lorem ipsum dolor sita ametLorem ipsum dolor sita ametLorem ipsum dolor sita amet', 313, '2016-08-23 12:58:33'),
(5, 4, 'Lorem ipsum dolor sita amet', 414, '2016-09-19 18:43:39'),
(6, 5, 'Banatu sundaul aja alah', 212, '2016-09-19 18:43:44'),
(7, 4, 'Penting nih buat wawasasn', 313, '2016-09-19 18:44:06'),
(8, 5, 'Good lah menirutrjt', 313, '2016-09-25 17:50:35'),
(9, 9, 'koreksi apa? by rafles', 212, '2016-09-26 13:01:22'),
(10, 9, 'iya bingung :) by: saputra', 313, '2016-09-26 13:02:02'),
(11, 7, 'testing', 212, '2016-09-26 13:03:28'),
(12, 8, 'sundul', 212, '2016-09-26 13:05:08'),
(13, 8, 'sundul juga', 313, '2016-09-26 13:05:26'),
(14, 8, 'hmmmmm', 212, '2016-09-26 13:14:50'),
(15, 9, 'sundul lagi', 212, '2016-09-26 13:40:42'),
(16, 7, 'test juga', 313, '2016-09-26 14:15:56'),
(17, 4, 'dadasd', 212, '2016-09-26 20:55:49'),
(18, 7, 'testingggggg', 212, '2016-09-26 20:56:20'),
(19, 4, 'ijin bergabung', 111, '2016-09-26 21:36:07'),
(20, 11, 'Siap dilaksanakan', 212, '2016-09-26 22:40:39'),
(21, 11, 'okehhh sipp', 111, '2016-09-26 22:41:18'),
(22, 11, 'caranya gmana', 313, '2016-09-26 22:41:38'),
(23, 11, 'terimaksih atas pemberitahuanya', 414, '2016-09-26 22:42:04'),
(24, 8, 'oke sippp', 414, '2016-09-26 22:44:46'),
(25, 13, 'testingtesting', 212, '2016-09-26 23:08:46'),
(26, 13, 'testing juga', 414, '2016-09-26 23:09:13'),
(27, 9, 'admin nih comment', 515, '2016-10-06 02:14:41'),
(28, 9, 'ini manager lagi comment', 616, '2016-10-06 02:15:51'),
(29, 14, 'testing pertamax', 616, '2016-10-06 02:16:56'),
(30, 14, 'okeyyyyyyyyyyyyyyyyyyyyy', 212, '2016-10-06 02:17:37'),
(31, 14, 'ini admin komentar', 515, '2016-10-06 14:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(10) UNSIGNED NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `deskripsi` varchar(30) NOT NULL,
  `createby` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `id_kategori`, `nama_jabatan`, `deskripsi`, `createby`) VALUES
(5, '2', 'accountant', 'accountant', '1'),
(6, '1', 'System Analys', 'System Analys', '1'),
(7, '2', 'Pajak', 'Pajak', '1'),
(8, '3', 'Pengarsipan Data', 'HRDPengarsipan Data', '1'),
(10, '4', 'Senior Marketing', 'Marketing', '1'),
(16, '1', 'programmer', 'programmer', '1'),
(19, '1', 'Database admin', 'Database admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `nik` int(10) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `id_jabatan` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `picture` text NOT NULL,
  `level` enum('staff','manager','admin') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama`, `jenis_kelamin`, `id_kategori`, `id_jabatan`, `email`, `password`, `picture`, `level`) VALUES
(112377, 111, 'Huda Azzuhri', 'L', 1, 5, 'huda.azzuhri@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'yuda.jpg', 'staff'),
(112391, 414, 'Budi Hartono', 'L', 1, 6, 'budihartono@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'budi.jpg', 'staff'),
(112392, 212, 'Rafles Nainggolan', 'L', 1, 6, 'rafles@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'avatar.png', 'staff'),
(112390, 313, 'saputra', 'L', 1, 7, 'saputra@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'yuda.jpg', 'staff'),
(112393, 515, 'admin', 'L', 1, 7, 'admin@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'avatar3.png', 'admin'),
(112394, 616, 'manager', 'L', 1, 7, 'admin@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'avatar04.png', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `createby` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`, `deskripsi`, `createby`) VALUES
(1, 'Devisi IT', 'room Devisi IT', '3'),
(2, 'Devisi Accounting', 'room Devisi Accounting', '3'),
(4, 'Devisi Marketing', 'room Devisi Marketing', '1'),
(3, 'Devisi CS', 'room Devisi Custoer Service', '1'),
(5, 'Devisi HRD', 'room Devisi HRD', '1');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `judul_materi` varchar(255) NOT NULL,
  `ket_materi` varchar(35) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createby` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `id_kategori`, `judul_materi`, `ket_materi`, `file_path`, `url`, `tgl_update`, `createby`) VALUES
(1, 1, 'Pengumuman Libur Lebaran', 'Pengumuman Libur Lebaran', 'html5_tutorial.pdf', '', '2016-09-06 15:07:10', '3'),
(2, 4, 'Pengumuman Libur Tahun Baru', 'Pengumuman Libur Tahun Baru', 'Bv__3MdCIAERH2L.jpg', '', '2016-09-06 15:07:12', '3'),
(5, 2, 'Pengumuman Libur Tahun BaruBaru', 'Pengumuman Libur Tahun Baru', 'kms4.sql', '', '2016-10-05 07:00:00', '515');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(10) UNSIGNED NOT NULL,
  `id_pengirim` int(10) UNSIGNED NOT NULL,
  `id_penerima` int(10) UNSIGNED NOT NULL,
  `pesan` text NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `tgl_kirim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dilihat` enum('Y','N') DEFAULT 'N',
  `aktif` enum('Y','N') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim`, `id_penerima`, `pesan`, `lampiran`, `tgl_kirim`, `dilihat`, `aktif`) VALUES
(4, 212, 313, 'ohh gitu put', NULL, '2016-02-02 13:37:38', 'Y', 'Y'),
(5, 313, 212, 'dimana aja raf', NULL, '2016-02-02 13:38:42', 'Y', 'Y'),
(6, 212, 313, 'dimana put', NULL, '2016-08-23 12:32:53', 'Y', 'Y'),
(7, 313, 212, 'lag santai raf', NULL, '2016-08-23 12:33:09', 'N', 'Y'),
(8, 212, 313, 'lagi apa put', NULL, '2016-08-23 12:34:04', 'N', 'Y'),
(9, 313, 212, 'sore jg raf', NULL, '2016-09-06 09:53:55', 'N', 'Y'),
(10, 212, 313, 'sore put', NULL, '2016-09-19 05:16:12', 'N', 'Y'),
(11, 212, 515, 'cobaaaaaaaaaaa', NULL, '2016-09-19 05:16:22', 'N', 'Y'),
(12, 414, 212, 'percobaan', NULL, '2016-09-22 08:38:29', 'N', 'Y'),
(13, 212, 414, 'hai sobattttt', NULL, '2016-09-22 08:38:29', 'N', 'Y'),
(20, 212, 414, 'hai juga broooo', NULL, '2016-09-26 04:11:45', 'N', 'Y'),
(15, 666, 777, 'lorem', NULL, '2016-09-22 08:38:29', 'N', 'Y'),
(16, 212, 313, 'sore put', NULL, '2016-09-19 05:16:12', 'N', 'Y'),
(19, 414, 212, 'hai rafles', NULL, '2016-09-26 04:11:09', 'N', 'Y'),
(21, 414, 212, 'lagi dimana ente rfa', NULL, '2016-09-26 04:12:53', 'N', 'Y'),
(22, 212, 414, 'dirumah aja sob budi', NULL, '2016-09-26 04:14:08', 'N', 'Y'),
(23, 212, 414, 'emang kenapa bud', NULL, '2016-09-26 04:14:20', 'N', 'Y'),
(24, 414, 212, 'gpp ko cuma tanya aja ko', NULL, '2016-09-26 04:14:40', 'N', 'Y'),
(25, 212, 414, 'kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet .kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet .kirain ada apa. Lorem ipsum dolor sit amet kirain ada apa. Lorem ipsum dolor sit amet ', NULL, '2016-09-26 04:16:31', 'N', 'Y'),
(27, 313, 212, 'iya sori baru balas', NULL, '2016-09-26 12:38:47', 'N', 'Y'),
(28, 212, 313, 'gpp ko', NULL, '2016-09-26 12:40:29', 'N', 'Y'),
(29, 212, 111, 'meeting', NULL, '2016-09-26 21:25:38', 'N', 'Y'),
(30, 212, 111, 'sasas', NULL, '2016-09-26 21:26:06', 'N', 'Y'),
(31, 212, 111, 'lorem ipsum dolor sit amet', NULL, '2016-09-26 21:30:59', 'N', 'Y'),
(32, 212, 111, 'asasas', NULL, '2016-09-26 21:32:47', 'N', 'Y'),
(33, 111, 212, 'helloooo oooooooooo', NULL, '2016-09-26 21:34:04', 'N', 'Y'),
(34, 212, 111, 'sippsssss', NULL, '2016-09-26 21:34:17', 'N', 'Y'),
(35, 212, 313, 'dsad', NULL, '2016-09-26 21:34:33', 'N', 'Y'),
(36, 212, 313, 'gooood', NULL, '2016-09-26 21:34:54', 'N', 'Y'),
(37, 414, 313, 'selamat pagi', NULL, '2016-09-26 22:42:45', 'N', 'Y'),
(38, 313, 414, 'Selamat pagi juga pak', NULL, '2016-09-26 22:44:05', 'N', 'Y'),
(39, 414, 111, 'hello', NULL, '2016-09-27 01:24:11', 'N', 'Y'),
(40, 212, 313, 'testinggggggggggggggg', NULL, '2016-09-28 13:14:44', 'N', 'Y'),
(41, 313, 414, 'hiiiiiiii', NULL, '2016-10-06 02:12:13', 'N', 'Y'),
(42, 616, 212, 'haiiiiiiiiiiiiiii', NULL, '2016-10-06 02:16:15', 'N', 'Y'),
(49, 212, 616, 'yeeeaaaaaaaaaaaaaaaa', NULL, '2016-10-07 14:25:33', 'N', 'Y'),
(48, 212, 515, 'sorryyyy', NULL, '2016-10-07 14:22:27', 'N', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) UNSIGNED NOT NULL,
  `jabatan` varchar(15) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `images` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `jabatan`, `fullname`, `username`, `password`, `images`) VALUES
(1, '8', 'Administrator', 'admin', '8cb2237d0679ca88db6464eac60da96345513964', 'the-magic-to-think-big-9-638.jpg'),
(3, '6', 'Rafles Nainggolan', 'rafles', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'the-magic-to-think-big-8-638.jpg'),
(2, '10', 'amin', 'amin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'the-magic-to-think-big-6-638.jpg'),
(4, '10', 'aldy', 'aldy', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'the-magic-to-think-big-4-638.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id_diskusi`),
  ADD KEY `FK_diskusi_kategori` (`id_kategori`);

--
-- Indexes for table `diskusi_detail`
--
ALTER TABLE `diskusi_detail`
  ADD PRIMARY KEY (`id_diskusi_detail`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `FK_karyawan_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `FK_materi_kategori` (`id_kategori`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id_diskusi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `diskusi_detail`
--
ALTER TABLE `diskusi_detail`
  MODIFY `id_diskusi_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112395;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
