-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2022 at 02:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ppdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES
(1, 'Dani Hakim', 'JL. Rawabali', '0812-9936-9059', 'PPDB', 'PPDB', 'logo1.jpeg', 'Copy Right ©', '1.0.0.0', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `ayah`
--

CREATE TABLE `ayah` (
  `no_pendaftaran` varchar(20) NOT NULL,
  `nama_ayah` varchar(40) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan` varchar(30) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ayah`
--

INSERT INTO `ayah` (`no_pendaftaran`, `nama_ayah`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `pekerjaan`) VALUES
('148', 'zaza', 'banyumas', '2022-07-01', 'smp/mts', 'pns'),
('252', 'zaza', 'banyumas', '2022-07-08', 'diploma', 'lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `ibu`
--

CREATE TABLE `ibu` (
  `no_pendaftaran` varchar(20) NOT NULL,
  `nama_ibu` varchar(40) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan` varchar(40) NOT NULL,
  `pekerjaan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ibu`
--

INSERT INTO `ibu` (`no_pendaftaran`, `nama_ibu`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `pekerjaan`) VALUES
('148', 'wewe', 'banyumas', '2022-07-01', 'smp/mts', 'pns'),
('252', 'wewe', 'banyumas', '2022-07-08', 'diploma', 'lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `golongan` varchar(11) NOT NULL,
  `sumbangan_awal` varchar(50) NOT NULL,
  `seragam` varchar(50) NOT NULL,
  `majalah` varchar(50) NOT NULL,
  `alat_tulis` varchar(50) NOT NULL,
  `is_active` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_tahun`, `golongan`, `sumbangan_awal`, `seragam`, `majalah`, `alat_tulis`, `is_active`) VALUES
(89, 1, 'B', '200000', '100000', '100000', '100000', 'Y'),
(99, 1, 'A', '200000', '200000', '100000', '100000', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `priodik`
--

CREATE TABLE `priodik` (
  `no_pendaftaran` varchar(20) NOT NULL,
  `tinggi_badan` varchar(20) NOT NULL,
  `berat_badan` varchar(20) NOT NULL,
  `jarak_kesekolah` varchar(20) NOT NULL,
  `waktu_kesekolah` varchar(30) NOT NULL,
  `saudara_kandung` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `priodik`
--

INSERT INTO `priodik` (`no_pendaftaran`, `tinggi_badan`, `berat_badan`, `jarak_kesekolah`, `waktu_kesekolah`, `saudara_kandung`) VALUES
('148', '170', '60', 'kd_1_km', '30 meint', '2'),
('252', '170', '60', 'kd_1_km', '10 menit', '2');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `no_pendaftaran` varchar(20) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(20) NOT NULL,
  `kewarganegaraan` varchar(40) NOT NULL,
  `ber_khusus` varchar(30) NOT NULL,
  `alamat` longtext NOT NULL,
  `rt` varchar(5) NOT NULL,
  `rw` varchar(5) NOT NULL,
  `dusun` varchar(30) NOT NULL,
  `desa` varchar(30) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `tempat_tinggal` varchar(40) NOT NULL,
  `transportasi` varchar(40) NOT NULL,
  `anak_keberapa` varchar(40) NOT NULL,
  `id_verivikasi` int(11) NOT NULL,
  `golongan` enum('A','B') NOT NULL,
  `kk` varchar(30) NOT NULL,
  `ktp` varchar(30) NOT NULL,
  `akta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`no_pendaftaran`, `id_tahun`, `tanggal_daftar`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `kewarganegaraan`, `ber_khusus`, `alamat`, `rt`, `rw`, `dusun`, `desa`, `kecamatan`, `kode_pos`, `tempat_tinggal`, `transportasi`, `anak_keberapa`, `id_verivikasi`, `golongan`, `kk`, `ktp`, `akta`) VALUES
('148', 1, '2022-07-11', 'laki-laki', 'banyumas', '2022-07-01', 'Islam', 'wni', 'tidak', 'JL. Rawabali', '12', '02', 'sirau', 'sirau', 'sirau', '55188', 'Banyumas', 'Motor', '1', 3, 'A', 'KK148.pdf', 'KTP148.pdf', 'AKTA148.pdf'),
('252', 1, '2022-07-11', 'laki-laki', 'banyumas', '2022-07-08', 'Islam', 'wni', 'tidak', 'JL. Rawabali', '03', '02', 'sirau', 'sirau', 'sirau', '55188', 'sirau', 'Motor', '3', 1, 'B', 'KK252.pdf', 'KTP252.pdf', 'AKTA252.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun`, `status`) VALUES
(1, '2022/2023', 'Y'),
(43, '2023/2024', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `no_tlp` varchar(30) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `no_tlp`, `password`, `id_level`, `image`, `is_active`) VALUES
(1, 'admin', 'Administrator', '085797887711', '$2y$10$sjPrxBpeFs438dZD3F67MOgd3Ub0dNvYhobdIUok1HFmkIC61BnMG', 1, 'admin1.jpg', 'Y'),
(148, 'maman', 'Dani Lukman Hakim', '085797887722', '$2y$05$s1ch7OFFwsWethWhlPY8/epTVqHqooX64TyJafq9ABQsPAoc6TVCC', 2, NULL, 'Y'),
(252, 'septian', 'vivi', '085797887700', '$2y$05$iEZMR//iirlVtnBTBeKkveMYcARmxTTFaJUnQVWaUe7AW1FFAIzgS', 2, NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlevel`
--

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) UNSIGNED NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_userlevel`
--

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'siswa'),
(3, 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `verivikasi`
--

CREATE TABLE `verivikasi` (
  `id` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verivikasi`
--

INSERT INTO `verivikasi` (`id`, `status`) VALUES
(1, 'TERVERIVIKASI'),
(2, 'BELUM DIVERIVIKASI'),
(3, 'TIDAK LULUS');

-- --------------------------------------------------------

--
-- Table structure for table `wali`
--

CREATE TABLE `wali` (
  `no_pendaftaran` varchar(20) NOT NULL,
  `nama_wali` varchar(40) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan` varchar(40) NOT NULL,
  `pekerjaan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `verivikasi`
--
ALTER TABLE `verivikasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=997;

--
-- AUTO_INCREMENT for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  MODIFY `id_level` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `verivikasi`
--
ALTER TABLE `verivikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
