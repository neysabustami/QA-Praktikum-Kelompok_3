-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2026 at 02:41 PM
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
-- Database: `db_spk_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `jenis_dokumen` varchar(100) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `tanggal_upload` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id_dokumen`, `id_guru`, `jenis_dokumen`, `nama_file`, `tanggal_upload`, `status`) VALUES
(5, 7, 'Artikel', '1781537775_Modul Perkuliahan Kelima.pdf', '2026-06-15 22:36:15', 'Diverifikasi'),
(4, 7, 'Modul Ajar', '1781537763_Modul Perkuliahan Keempatbelas.pdf', '2026-06-15 22:36:03', 'Diverifikasi'),
(6, 7, 'Sertifikat', '1781537788_Modul Perkuliahan Kelimabelas.pdf', '2026-06-15 22:36:28', 'Diverifikasi'),
(7, 8, 'Modul Ajar', '1781538782_Tugas Perkuliahan Ketiga.pdf', '2026-06-15 22:53:02', 'Diverifikasi'),
(8, 8, 'Sertifikat', '1781538794_Tugas Perkuliahan Ketiga.pdf', '2026-06-15 22:53:14', 'Diverifikasi'),
(9, 9, 'Artikel', '1781548441_Modul Perkuliahan Keempatbelas.pdf', '2026-06-16 01:34:01', 'Diverifikasi'),
(10, 9, 'Modul Ajar', '1781548499_Modul Perkuliahan Kelima.pdf', '2026-06-16 01:34:59', 'Diverifikasi'),
(11, 10, 'Modul Ajar', '1781549236_Modul Perkuliahan Keempatbelas.pdf', '2026-06-16 01:47:16', 'Diverifikasi'),
(12, 10, 'Sertifikat', '1781549257_Modul Pertemuan Kedua.pdf', '2026-06-16 01:47:37', 'Diverifikasi'),
(13, 10, 'Artikel', '1781549265_Modul Pertemuan Keempat.pdf', '2026-06-16 01:47:45', 'Diverifikasi'),
(14, 10, 'Piagam Penghargaan', '1781549275_Modul Pertemuan Keenam.pdf', '2026-06-16 01:47:55', 'Diverifikasi'),
(15, 12, 'Modul Ajar', '1781574416_Modul Perkuliahan Keempatbelas.pdf', '2026-06-16 08:46:56', 'Diverifikasi'),
(16, 12, 'Sertifikat', '1781574434_Modul Perkuliahan Keempatbelas.pdf', '2026-06-16 08:47:14', 'Diverifikasi'),
(17, 11, 'Modul Ajar', '1781574475_Modul Perkuliahan Kelimabelas.pdf', '2026-06-16 08:47:55', 'Diverifikasi'),
(18, 11, 'Artikel', '1781574488_Modul Pertemuan Keduabelas.pdf', '2026-06-16 08:48:08', 'Diverifikasi'),
(19, 13, 'Modul Ajar', '1789620565_Modul Perkuliahan Keempatbelas.pdf', '2026-09-17 11:49:25', 'Diverifikasi'),
(20, 14, 'Modul Ajar', '1789697875_Modul Perkuliahan Keempatbelas.pdf', '2026-09-18 09:17:55', 'Diverifikasi'),
(21, 14, 'Artikel', '1789737851_Modul Perkuliahan Keempatbelas.pdf', '2026-09-18 20:24:11', 'Diverifikasi'),
(22, 14, 'Sertifikat', '1789737862_Modul Perkuliahan Kesepuluh.pdf', '2026-09-18 20:24:22', 'Pending'),
(23, 15, 'Modul Ajar', '1793964785_Modul Perkuliahan Keempatbelas.pdf', '2026-11-06 18:33:05', 'Diverifikasi'),
(24, 15, 'Sertifikat', '1793964795_Modul Pertemuan Keempat.pdf', '2026-11-06 18:33:15', 'Diverifikasi'),
(25, 17, 'Modul Ajar', '1793965915_Modul Perkuliahan Kesepuluh.pdf', '2026-11-06 18:51:55', 'Diverifikasi'),
(26, 17, 'Piagam Penghargaan', '1793965926_Modul Pertemuan Keduabelas.pdf', '2026-11-06 18:52:06', 'Diverifikasi'),
(27, 16, 'Artikel', '1793965948_Modul Pertemuan Keduabelas.pdf', '2026-11-06 18:52:28', 'Diverifikasi'),
(28, 18, 'Modul Ajar', '1793966417_Modul Pertemuan Keduabelas.pdf', '2026-11-06 19:00:17', 'Diverifikasi'),
(31, 20, 'Artikel', '1793982802_Modul Pertemuan Keduabelas.pdf', '2026-11-06 23:33:22', 'Diverifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `nama_guru` varchar(100) DEFAULT NULL,
  `mapel` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `id_user`, `nip`, `nama_guru`, `mapel`) VALUES
(21, 16, '987', 'budi', 'bahasa indonesia'),
(20, 17, '789', 'cimo', 'matematika'),
(9, 9, '78', 'ghaazy', 'ipa'),
(18, 15, '456', 'citra putri', 'IPS'),
(11, 11, '789', 'ahmad', 'ips'),
(12, 12, '456', 'naufal', 'sejarah'),
(22, 18, '654', 'timi', 'mulok'),
(23, 20, '123', 'neysa', 'mtk');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_saw`
--

CREATE TABLE `hasil_saw` (
  `id_hasil` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `nilai_akhir` double NOT NULL,
  `peringkat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_saw`
--

INSERT INTO `hasil_saw` (`id_hasil`, `id_guru`, `nilai_akhir`, `peringkat`) VALUES
(1, 9, 0.715, 1),
(2, 15, 0.71, 2),
(3, 12, 0.625, 3),
(4, 11, 0.57, 4);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) DEFAULT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot`) VALUES
(1, 'C1', 'Kompetensi Pedagogik', 0.25),
(2, 'C2', 'Kompetensi Profesional', 0.25),
(3, 'C3', 'Kompetensi Kepribadian', 0.15),
(4, 'C4', 'Kompetensi Sosial', 0.1),
(5, 'C5', 'Disiplin dan Kinerja', 0.15),
(6, 'C6', 'Inovasi/Karya Prestasi', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `pengesahan`
--

CREATE TABLE `pengesahan` (
  `id_pengesahan` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` enum('Belum Disahkan','Sudah Disahkan') DEFAULT 'Belum Disahkan',
  `id_kepsek` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengesahan`
--

INSERT INTO `pengesahan` (`id_pengesahan`, `tanggal`, `status`, `id_kepsek`, `last_update`) VALUES
(1, '2026-11-08 08:37:10', 'Sudah Disahkan', 3, NULL),
(2, NULL, 'Belum Disahkan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_user`, `id_guru`, `id_kriteria`, `nilai`) VALUES
(96, 3, 18, 6, 60),
(95, 3, 18, 5, 80),
(94, 3, 18, 4, 60),
(93, 3, 18, 3, 80),
(92, 3, 18, 2, 60),
(91, 3, 18, 1, 80),
(90, 4, 18, 6, 60),
(89, 4, 18, 5, 80),
(88, 4, 18, 4, 60),
(87, 4, 18, 3, 80),
(86, 4, 18, 2, 60),
(85, 4, 18, 1, 80),
(31, 3, 9, 1, 60),
(32, 3, 9, 2, 80),
(33, 3, 9, 3, 80),
(34, 3, 9, 4, 60),
(35, 3, 9, 5, 80),
(36, 3, 9, 6, 80),
(37, 4, 9, 1, 60),
(38, 4, 9, 2, 80),
(39, 4, 9, 3, 60),
(40, 4, 9, 4, 60),
(41, 4, 9, 5, 80),
(42, 4, 9, 6, 80),
(108, 4, 20, 6, 100),
(107, 4, 20, 5, 100),
(106, 4, 20, 4, 100),
(105, 4, 20, 3, 100),
(104, 4, 20, 2, 100),
(103, 4, 20, 1, 100),
(102, 4, 21, 6, 20),
(101, 4, 21, 5, 20),
(100, 4, 21, 4, 20),
(99, 4, 21, 3, 20),
(98, 4, 21, 2, 20),
(97, 4, 21, 1, 20),
(55, 3, 11, 1, 60),
(56, 3, 11, 2, 40),
(57, 3, 11, 3, 60),
(58, 3, 11, 4, 60),
(59, 3, 11, 5, 60),
(60, 3, 11, 6, 80),
(61, 3, 12, 1, 80),
(62, 3, 12, 2, 60),
(63, 3, 12, 3, 60),
(64, 3, 12, 4, 60),
(65, 3, 12, 5, 60),
(66, 3, 12, 6, 60),
(67, 4, 11, 1, 60),
(68, 4, 11, 2, 40),
(69, 4, 11, 3, 60),
(70, 4, 11, 4, 60),
(71, 4, 11, 5, 60),
(72, 4, 11, 6, 80),
(73, 4, 12, 1, 60),
(74, 4, 12, 2, 60),
(75, 4, 12, 3, 60),
(76, 4, 12, 4, 60),
(77, 4, 12, 5, 60),
(78, 4, 12, 6, 60);

-- --------------------------------------------------------

--
-- Table structure for table `rubrik_penilaian`
--

CREATE TABLE `rubrik_penilaian` (
  `id_rubrik` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `kategori` varchar(150) DEFAULT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rubrik_penilaian`
--

INSERT INTO `rubrik_penilaian` (`id_rubrik`, `id_kriteria`, `kategori`, `nilai`) VALUES
(1, 1, 'Sangat Kurang', 20),
(2, 1, 'Kurang', 40),
(3, 1, 'Cukup', 60),
(4, 1, 'Baik', 80),
(5, 1, 'Sangat Baik', 100),
(6, 2, 'Tidak Ada', 20),
(7, 2, 'Artikel Lokal', 40),
(8, 2, 'Jurnal Nasional', 60),
(9, 2, 'SINTA 5-6', 70),
(10, 2, 'SINTA 3-4', 85),
(11, 2, 'SINTA 1-2', 95),
(12, 2, 'Internasional', 100),
(13, 3, 'Tidak Ada', 20),
(14, 3, 'Sekolah', 40),
(15, 3, 'Kecamatan', 60),
(16, 3, 'Kabupaten', 80),
(17, 3, 'Provinsi', 90),
(18, 3, 'Nasional', 100);

-- --------------------------------------------------------

--
-- Table structure for table `submit_kepsek`
--

CREATE TABLE `submit_kepsek` (
  `id_submit` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `status` enum('Draft','Submitted') DEFAULT 'Draft'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submit_kepsek`
--

INSERT INTO `submit_kepsek` (`id_submit`, `id_user`, `id_guru`, `status`) VALUES
(1, 3, 8, 'Submitted'),
(2, 3, 7, 'Submitted'),
(3, 0, 9, 'Submitted'),
(4, 3, 9, 'Submitted'),
(5, 0, 10, 'Submitted'),
(6, 3, 10, 'Submitted'),
(7, 0, 11, 'Submitted'),
(8, 0, 12, 'Submitted'),
(9, 3, 11, 'Submitted'),
(10, 3, 12, 'Submitted'),
(11, 0, 14, 'Submitted'),
(12, 0, 18, 'Submitted'),
(13, 3, 18, 'Submitted');

-- --------------------------------------------------------

--
-- Table structure for table `submit_penilai`
--

CREATE TABLE `submit_penilai` (
  `id_submit` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `status` enum('Draft','Submitted') DEFAULT 'Draft'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submit_penilai`
--

INSERT INTO `submit_penilai` (`id_submit`, `id_user`, `id_guru`, `status`) VALUES
(1, 4, 8, 'Submitted'),
(2, 4, 7, 'Submitted'),
(3, 4, 9, 'Submitted'),
(4, 4, 10, 'Submitted'),
(5, 4, 11, 'Submitted'),
(6, 4, 12, 'Submitted'),
(7, 4, 18, 'Submitted'),
(8, 4, 21, 'Submitted'),
(9, 4, 20, 'Submitted');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','penilai','kepsek','guru') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Admin Sistem', 'admin', '123', 'admin'),
(3, 'Kepala Sekolah', 'kepsek', '123', 'kepsek'),
(4, 'Tim Penilai', 'penilai', '123', 'penilai'),
(17, 'cimo tomo', 'cimo', '123', 'guru'),
(16, 'budi setia', 'budi', '123', 'guru'),
(9, 'ghaazy', 'adik', '123', 'guru'),
(11, 'ahmad', 'ahmad', '123', 'guru'),
(12, 'naufal', 'naufal', '123', 'guru'),
(15, 'citra putri', 'citra', '789', 'guru'),
(18, 'timi lila', 'timi', '123', 'guru'),
(20, 'neysa', 'neysa rizqi putri bu', '123', 'guru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `hasil_saw`
--
ALTER TABLE `hasil_saw`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `pengesahan`
--
ALTER TABLE `pengesahan`
  ADD PRIMARY KEY (`id_pengesahan`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `rubrik_penilaian`
--
ALTER TABLE `rubrik_penilaian`
  ADD PRIMARY KEY (`id_rubrik`);

--
-- Indexes for table `submit_kepsek`
--
ALTER TABLE `submit_kepsek`
  ADD PRIMARY KEY (`id_submit`);

--
-- Indexes for table `submit_penilai`
--
ALTER TABLE `submit_penilai`
  ADD PRIMARY KEY (`id_submit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `hasil_saw`
--
ALTER TABLE `hasil_saw`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengesahan`
--
ALTER TABLE `pengesahan`
  MODIFY `id_pengesahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `rubrik_penilaian`
--
ALTER TABLE `rubrik_penilaian`
  MODIFY `id_rubrik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `submit_kepsek`
--
ALTER TABLE `submit_kepsek`
  MODIFY `id_submit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `submit_penilai`
--
ALTER TABLE `submit_penilai`
  MODIFY `id_submit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
