-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2016 at 05:12 AM
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
('7227f92e2238d864525ab5af94e362bd', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474253455, 'a:3:{s:9:"user_data";s:0:"";s:15:"flash:old:notif";s:22:"You Must Login First !";s:15:"flash:new:notif";s:22:"You Must Login First !";}'),
('85d2cabd0a5d807af276b0f730d2f2fb', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', 1474253215, 'a:3:{s:9:"user_data";s:0:"";s:15:"flash:old:notif";s:22:"You Must Login First !";s:15:"flash:new:notif";s:22:"You Must Login First !";}'),
('ac747ce7c80dccf21f0a2afbf435d3eb', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', 1474254413, 'a:7:{s:9:"user_data";s:0:"";s:5:"idusr";s:1:"1";s:6:"usradm";s:5:"admin";s:7:"passadm";s:40:"8cb2237d0679ca88db6464eac60da96345513964";s:7:"nameadm";s:13:"Administrator";s:8:"adminimg";s:19:"20140305_174110.jpg";s:12:"login_status";b:1;}'),
('c9ef7db42e84d43f0088eeef1f22e578', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1474251927, 'a:3:{s:9:"user_data";s:0:"";s:15:"flash:old:notif";s:22:"You Must Login First !";s:15:"flash:new:notif";s:22:"You Must Login First !";}'),
('e0d4be463fec5acb01204193f8971441', '192.168.10.22', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1474254013, 'a:2:{s:9:"user_data";s:0:"";s:15:"flash:old:notif";s:22:"You Must Login First !";}');

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
(4, 'asdasd', 'asdasd', 1, NULL, NULL, '2016-02-01 14:21:23', 'Y', '3'),
(5, 'asdasd', 'asdads', 1, NULL, NULL, '2016-02-01 14:21:29', 'Y', '3'),
(7, 'TEsting', 'sdfasdfasdfas', 2, NULL, NULL, '2016-02-01 23:39:07', 'Y', '2'),
(8, 'SAP', 'Info cara mengkoreksi', 1, NULL, NULL, '2016-02-05 00:07:10', 'Y', '2'),
(9, 'SAP', 'Info cara mengkoreksi data material bagaimana?', 1, NULL, NULL, '2016-02-05 00:08:54', 'Y', '2'),
(10, 'aaa', 'aaaaaa', 1, NULL, NULL, '2016-02-05 03:59:30', 'Y', '3');

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
(1, 4, 'asdasdasdasd', 2, '2016-02-02 13:48:39'),
(2, 4, 'po', 4, '2016-02-03 03:45:42'),
(3, 9, 'wah bagus tuh', 7, '2016-07-24 08:20:45'),
(4, 10, 'bbbb', 1, '2016-08-23 12:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(10) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `deskripsi` varchar(30) NOT NULL,
  `createby` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `deskripsi`, `createby`) VALUES
(5, 'accountant', 'accountant', '1'),
(6, 'IT', 'IT Departement', '1'),
(7, 'sasas', 'asasas', '1'),
(8, 'erere', 'rerer', '1');

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
  `picture` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama`, `jenis_kelamin`, `id_kategori`, `id_jabatan`, `email`, `password`, `picture`) VALUES
(2, 112346, 'Testing', 'L', 2, NULL, 'testing@email.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(3, 112347, 'Prima Yudha Delano Hernaz', 'L', 1, NULL, 'delano.hernaz@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'login.jpg'),
(4, 112348, 'Sigit Grando', 'L', 1, NULL, 'sigit.grando@ymail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(6, 112349, 'Jojo', 'L', 2, 2, 'jojo@email.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'profile.png'),
(7, 112350, 'Joni', 'L', 1, NULL, 'joni@ymail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112352, 112351, 'eldo', 'L', 1, NULL, 'riyanto@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112354, 112346, 'Testing', 'L', 2, NULL, 'testing@email.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'login.jpg'),
(112355, 112347, 'Prima Yudha Delano Hernaz', 'L', 1, NULL, 'delano.hernaz@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112356, 112348, 'Sigit Grando', 'L', 1, NULL, 'sigit.grando@ymail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112357, 112349, 'Jojo', 'L', 2, 2, 'jojo@email.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112358, 112350, 'Joni', 'L', 1, NULL, 'joni@ymail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'profile.png'),
(112364, 112351, 'eldo', 'L', 1, NULL, 'riyanto@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112366, 112346, 'Testing', 'L', 2, NULL, 'testing@email.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112367, 112347, 'Prima Yudha Delano Hernaz', 'L', 1, NULL, 'delano.hernaz@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'login.jpg'),
(112368, 112348, 'Sigit Grando', 'L', 1, NULL, 'sigit.grando@ymail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'profile.png'),
(112369, 112349, 'Jojo', 'L', 2, 2, 'jojo@email.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112370, 112350, 'Joni', 'L', 1, NULL, 'joni@ymail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112377, 112345, 'Huda Azzuhri', 'L', 1, NULL, 'huda.azzuhri@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'profile.png'),
(112378, 112346, 'Testing', 'L', 2, NULL, 'testing@email.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112380, 112348, 'Sigit Grando', 'L', 1, NULL, 'sigit.grando@ymail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112381, 112349, 'Jojo', 'L', 2, 2, 'jojo@email.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112382, 112350, 'Joni', 'L', 1, NULL, 'joni@ymail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user.png'),
(112390, 212, 'Rafles Nainggolan', 'L', 1, 3, 'rafles@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'user.png');

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
(4, 'Devisi Produksi', 'room Devisi Accounting', '3'),
(12, 'Devisi CS', 'room Devisi Custoer Service', '3');

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
(5, 4, 'Pengumuman Libur Tahun Baru', 'Pengumuman Libur Tahun Baru', 'Bv__3MdCIAERH2L.jpg', '', '2016-09-06 15:07:07', '3');

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
  `dilihat` enum('Y','N') DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim`, `id_penerima`, `pesan`, `lampiran`, `tgl_kirim`, `dilihat`) VALUES
(4, 1, 2, 'Testing', NULL, '2016-02-02 13:37:38', 'Y'),
(5, 2, 1, 'Bro bro', NULL, '2016-02-02 13:38:42', 'Y'),
(6, 1, 3, 'kgkgkghk', NULL, '2016-08-23 12:32:53', 'Y'),
(7, 1, 4, 'asfdhsagk', NULL, '2016-08-23 12:33:09', 'N'),
(8, 3, 1, 'asgdashdg\r\n', NULL, '2016-08-23 12:34:04', 'N'),
(9, 112389, 3, 'tgertertert', NULL, '2016-09-06 09:53:55', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) UNSIGNED NOT NULL,
  `id_jabatan` varchar(10) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `images` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_jabatan`, `fullname`, `username`, `password`, `images`) VALUES
(1, '1', 'Administrator', 'admin', '8cb2237d0679ca88db6464eac60da96345513964', '20140305_174110.jpg'),
(3, '2', 'Rafles Nainggolan', 'rafles', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user.png'),
(12, '', 'amin', 'amin', '8d589e7f5ea57b9b28beb346ff56c309feae9c52', 'programmer.jpg'),
(15, '', 'rere', 'rere', '6c18be65d055be68bbcf06fdc6a47929341caf99', 'how-to-build-the-perfect-team-4-638.jpg');

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
  MODIFY `id_diskusi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `diskusi_detail`
--
ALTER TABLE `diskusi_detail`
  MODIFY `id_diskusi_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112391;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
