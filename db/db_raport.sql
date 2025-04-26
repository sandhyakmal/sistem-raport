-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 26, 2025 at 12:55 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_raport`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(3, 'Admin'),
(4, 'Siswa'),
(5, 'Guru'),
(6, 'Wali Kelas');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_name` varchar(100) DEFAULT NULL,
  `can_view` tinyint(1) DEFAULT '0',
  `can_create` tinyint(1) DEFAULT '0',
  `can_update` tinyint(1) DEFAULT '0',
  `can_delete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `menu_name`, `can_view`, `can_create`, `can_update`, `can_delete`) VALUES
(35, 4, 'data pelajaran', 1, 0, 0, 0),
(36, 4, 'jadwal pelajaran', 1, 0, 0, 0),
(72, 3, 'data siswa', 1, 1, 1, 1),
(73, 3, 'data guru', 1, 1, 1, 1),
(74, 3, 'data pelajaran', 1, 1, 1, 1),
(75, 3, 'jadwal pelajaran', 1, 1, 1, 1),
(76, 3, 'input nilai', 1, 1, 1, 1),
(77, 3, 'cetak raport', 1, 0, 0, 0),
(78, 3, 'laporan', 1, 0, 0, 0),
(79, 5, 'data siswa', 1, 0, 0, 0),
(80, 5, 'data guru', 1, 0, 0, 0),
(81, 5, 'data pelajaran', 1, 0, 0, 0),
(82, 5, 'jadwal pelajaran', 1, 0, 0, 0),
(83, 5, 'input nilai', 1, 1, 1, 1),
(84, 5, 'cetak raport', 1, 0, 0, 0),
(85, 5, 'laporan', 1, 0, 0, 0),
(86, 6, 'data siswa', 1, 0, 0, 0),
(87, 6, 'data guru', 1, 0, 0, 0),
(88, 6, 'data pelajaran', 1, 0, 0, 0),
(89, 6, 'jadwal pelajaran', 1, 0, 0, 0),
(90, 6, 'input nilai', 1, 1, 1, 1),
(91, 6, 'cetak raport', 1, 0, 0, 0),
(92, 6, 'laporan', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `ijazah_terakhir` varchar(50) DEFAULT NULL,
  `tahun_lulus` varchar(10) DEFAULT NULL,
  `pangkat_golongan` varchar(50) DEFAULT NULL,
  `tmt_cpns` date DEFAULT NULL,
  `tmt_pns` date DEFAULT NULL,
  `masa_kerja` varchar(50) DEFAULT NULL,
  `nuptk` varchar(30) DEFAULT NULL,
  `karpeg` varchar(30) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `email_aktif` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id`, `nama`, `nip`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `ijazah_terakhir`, `tahun_lulus`, `pangkat_golongan`, `tmt_cpns`, `tmt_pns`, `masa_kerja`, `nuptk`, `karpeg`, `npwp`, `email_aktif`) VALUES
(2, 'PRATAMA', 'PRATAMA', '', '2025-04-23', '', '', '', '', '2025-04-23', '2025-04-23', '', '', '', '', ''),
(3, 'DWI', 'DWI', '', '2025-04-24', '', '', '', '', '2025-04-24', '2025-04-24', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_pelajaran`
--

CREATE TABLE `tb_jadwal_pelajaran` (
  `id` int(11) NOT NULL,
  `id_guru` int(10) NOT NULL,
  `id_pelajaran` int(10) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jadwal_pelajaran`
--

INSERT INTO `tb_jadwal_pelajaran` (`id`, `id_guru`, `id_pelajaran`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(4, 2, 3, 'Senin', '08:00:00', '09:00:00'),
(5, 3, 4, 'Senin', '09:00:00', '10:00:00'),
(6, 2, 5, 'Selasa', '08:00:00', '09:00:00'),
(7, 2, 6, 'Rabu', '09:00:00', '10:00:00'),
(8, 3, 7, 'Kamis', '09:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keterangan_siswa`
--

CREATE TABLE `tb_keterangan_siswa` (
  `id` int(11) NOT NULL,
  `id_siswa` int(10) DEFAULT NULL,
  `kegiatan` varchar(50) DEFAULT NULL,
  `predikat` varchar(10) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `sakit` int(10) DEFAULT NULL,
  `izin` int(10) DEFAULT NULL,
  `alpa` int(10) DEFAULT NULL,
  `semester` varchar(2) NOT NULL,
  `fase` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_keterangan_siswa`
--

INSERT INTO `tb_keterangan_siswa` (`id`, `id_siswa`, `kegiatan`, `predikat`, `keterangan`, `sakit`, `izin`, `alpa`, `semester`, `fase`, `tahun_ajaran`, `catatan`) VALUES
(4, 3, '-', '-', '-', 0, 0, 0, '1', 'A', '2025/2026', 'Tingkatkan'),
(5, 5, '-', '-', '-', 2, 2, 2, '1', 'A', '2025/2026', 'Jangan Malas masuk kelas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_siswa`
--

CREATE TABLE `tb_nilai_siswa` (
  `id` int(11) NOT NULL,
  `id_pelajaran` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `kelas` varchar(5) DEFAULT NULL,
  `nilai_akhir` varchar(20) DEFAULT NULL,
  `capaian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_nilai_siswa`
--

INSERT INTO `tb_nilai_siswa` (`id`, `id_pelajaran`, `id_siswa`, `kelas`, `nilai_akhir`, `capaian`) VALUES
(8, 3, 3, '1', '78', 'TEST NAIK KELAS'),
(9, 6, 3, '2', '80', 'TEST JADI NAIK KELAS'),
(10, 7, 3, '2', '80', 'LANJUTKAN'),
(11, 3, 5, '1', '80', 'TEST');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelajaran`
--

CREATE TABLE `tb_pelajaran` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_pelajaran`
--

INSERT INTO `tb_pelajaran` (`id`, `kelas`, `nama`) VALUES
(3, '1', 'Pendidikan Agama Islam'),
(4, '1', 'Pendidikan Pancasila dan Kewarganegaraan'),
(5, '1', 'Bahasa Indonesia'),
(6, '2', 'Matematika'),
(7, '2', 'Pendidikan Agama Islam (PAI)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `kelas` varchar(10) NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(30) DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `status_dalam_keluarga` varchar(50) DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp_rumah` varchar(20) DEFAULT NULL,
  `sekolah_asal` varchar(100) DEFAULT NULL,
  `diterima_tanggal` date DEFAULT NULL,
  `diterima_di_kelas` varchar(10) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `alamat_orang_tua` varchar(255) DEFAULT NULL,
  `no_telp_orang_tua` varchar(20) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `alamat_wali` varchar(255) DEFAULT NULL,
  `no_telp_wali` varchar(20) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `nama_lengkap`, `nisn`, `kelas`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_dalam_keluarga`, `anak_ke`, `alamat`, `no_telp_rumah`, `sekolah_asal`, `diterima_tanggal`, `diterima_di_kelas`, `nama_ayah`, `nama_ibu`, `alamat_orang_tua`, `no_telp_orang_tua`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `alamat_wali`, `no_telp_wali`, `pekerjaan_wali`, `foto`) VALUES
(3, 'DEWI', '182736123123', '2', 'Jakarta', '2025-04-21', 'Perempuan', '', '', 1, '', '', '', '2025-04-21', '', '', '', '', '', '', '', '', '', '', '', '3302101602980003 - Rejected.jpeg'),
(4, 'SANDHY', '12412413', '2', '', '2025-04-24', 'Perempuan', '', '', 1, '', '', '', '2025-04-24', '', '', '', '', '', '', '', '', '', '', '', '3506042602660001 - Reguler.jpeg'),
(5, 'RIKY', '219836123', '1', '', '2025-04-24', 'Laki-laki', '', '', 1, '', '', '', '2025-04-24', '', '', '', '', '', '', '', '', '', '', '', '3171234567890123 - Approved.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`) VALUES
(1, 'admin', 'admin', 3),
(2, 'PRATAMA', 'PRATAMA', 5),
(3, 'DEWI', 'DEWI', 4),
(4, 'WALI', 'WALI', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jadwal_pelajaran`
--
ALTER TABLE `tb_jadwal_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_keterangan_siswa`
--
ALTER TABLE `tb_keterangan_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilai_siswa`
--
ALTER TABLE `tb_nilai_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jadwal_pelajaran`
--
ALTER TABLE `tb_jadwal_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_keterangan_siswa`
--
ALTER TABLE `tb_keterangan_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_nilai_siswa`
--
ALTER TABLE `tb_nilai_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_pelajaran`
--
ALTER TABLE `tb_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
