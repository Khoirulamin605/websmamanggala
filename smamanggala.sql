-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 06, 2020 at 10:20 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smamanggala`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `hello` (`s` CHAR(20)) RETURNS CHAR(50) CHARSET latin1 RETURN CONCAT('Hello, ',s,'!')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `masuk` varchar(20) NOT NULL,
  `pulang` varchar(20) NOT NULL,
  `jumlah_jam` int(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `bulan_tahun` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id`, `id_pegawai`, `tanggal`, `masuk`, `pulang`, `jumlah_jam`, `keterangan`, `bulan_tahun`) VALUES
(1, 3, '05-07-2020', '23:22:52', '23:26:06', 2, '', '07-2020'),
(2, 17, '05-07-2020', '23:22:56', '23:26:11', 2, '', '07-2020'),
(3, 8, '05-07-2020', '23:22:59', '23:26:13', 2, '', '07-2020'),
(4, 4, '05-07-2020', '23:25:54', '23:26:16', 2, '', '07-2020'),
(5, 7, '05-07-2020', '23:25:57', '23:26:18', 2, '', '07-2020'),
(6, 1, '05-07-2020', '23:26:00', '23:26:21', 0, '', '07-2020'),
(7, 22, '05-07-2020', '23:26:03', '23:26:23', 0, '', '07-2020'),
(8, 6, '06-07-2020', '15:06:12', '15:07:08', 2, '', '07-2020'),
(9, 9, '06-07-2020', '15:06:15', '15:07:11', 3, '', '07-2020'),
(10, 12, '06-07-2020', '15:06:17', '15:07:14', 2, '', '07-2020'),
(11, 3, '06-07-2020', '15:06:20', '15:07:15', 3, '', '07-2020'),
(12, 7, '06-07-2020', '15:06:22', '15:07:17', 2, '', '07-2020'),
(13, 11, '06-07-2020', '15:06:25', '15:07:18', 2, '', '07-2020'),
(14, 1, '06-07-2020', '15:06:27', '15:07:20', 0, '', '07-2020'),
(15, 22, '06-07-2020', '15:06:30', '15:07:22', 0, '', '07-2020');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gaji` int(25) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`, `gaji`, `keterangan`) VALUES
(1, 'Guru', 20000, 'Per Jam'),
(2, 'Kepala Jurusan', 300000, 'Per Bulan'),
(3, 'Kepala Sekolah', 500000, 'Per Bulan'),
(4, 'Waka Kurikulum', 150000, 'Per Bulan'),
(5, 'Waka Kesiswaan', 150000, 'Per Bulan'),
(6, 'Operator', 500000, 'Per Bulan'),
(7, 'Staff TU', 500000, 'Per Bulan'),
(9, 'Wali Kelas', 100000, 'Per Bulan');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `hari` varchar(15) NOT NULL,
  `jumlah_jam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `kepala_jurusan` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `jurusan`, `kepala_jurusan`, `status`) VALUES
(2, 'Ilmu Pengetahuan Sosial', 16, 'Active'),
(3, 'Ilmu Pengetahuan Alam', 13, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `rombel` varchar(20) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `jurusan`, `nama_kelas`, `rombel`, `wali_kelas`, `status`) VALUES
(1, 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Kelas X', 'Mohamad Desi Qomaruddin', 'Active'),
(3, 'Ilmu Pengetahuan Sosial', 'Keals XI', 'Kelas XI', 'Achmad Purwadi', 'Active'),
(4, 'Ilmu Pengetahuan Sosial', 'Keals XII', 'Kelas XII', 'Mafrudlotun Inwaroh', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `id` int(11) NOT NULL,
  `uang_masuk` int(20) NOT NULL,
  `uang_keluar` int(20) NOT NULL,
  `saldo_akhir` int(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id`, `uang_masuk`, `uang_keluar`, `saldo_akhir`, `keterangan`, `tanggal`) VALUES
(2, 10000, 0, 10000, 'Sisa Pembelian Barang', '2020-06-25'),
(3, 21000000, 0, 21010000, 'MAsuk dari dana BOS Triwulan III', '2020-06-25'),
(4, 0, 100000, 20910000, 'Pembelian Kertas A4', '2020-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `guru_pengajar` varchar(100) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jumlah_jam` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `nama_mapel`, `jurusan`, `kelas`, `guru_pengajar`, `hari`, `jumlah_jam`, `status`) VALUES
(2, 'Bahasa Inggris', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Munik Erviyati', '4', 2, 'Active'),
(3, 'Bahasa Arab', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Achmad Purwadi', '2', 2, 'Active'),
(4, 'Bahasa Indonesia', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Habibatus Sadiyah', '1', 2, 'Active'),
(5, 'Matematika', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Siti Nur Aeni', '6', 2, 'Active'),
(6, 'Ekonomi', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Achmad Machrus Romli', '7', 2, 'Active'),
(7, 'Kimia', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Mufathiroh', '1', 2, 'Active'),
(8, 'PJOK', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Mohamad Desi Qomaruddin', '1', 2, 'Active'),
(9, 'Bahasa Jawa', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'M Saddam Yusuf', '7', 2, 'Active'),
(10, 'Pendidikan Pancasila Dan Kewarga negaraan', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Misbahul Munir', '2', 2, 'Active'),
(11, 'Sosiologi', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Muhammad Salim Quthbi', '6', 2, 'Active'),
(12, 'Sejarah', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Khoirotun Nisa', '3', 2, 'Active'),
(13, 'Pendidikan Agama Islam', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'S.nurul Laili', '4', 2, 'Active'),
(14, 'Bahasa Inggris', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Munik Erviyati', '3', 3, 'Active'),
(15, 'Bahasa Indonesia', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Habibatus Sadiyah', '4', 3, 'Active'),
(16, 'Matematika', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Siti Nur Aeni', '4', 3, 'Active'),
(17, 'Ekonomi', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Mafrudlotun Inwaroh', '3', 3, 'Active'),
(19, 'PJOK', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Mohamad Desi Qomaruddin', '2', 2, 'Active'),
(20, 'Bahasa Jawa', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'M Saddam Yusuf', '6', 2, 'Active'),
(21, 'SBK', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Pranoto Jatmiko', '2', 2, 'Active'),
(22, 'PAI', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Achmad Purwadi', '7', 2, 'Active'),
(23, 'Sejarah', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Khoirotun Nisa', '7', 2, 'Active'),
(24, 'Sosiologi', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Achmad Machrus Romli', '1', 3, 'Active'),
(25, 'TIK', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Adib Maimun', '6', 2, 'Active'),
(26, 'Pendidikan Pancasila Dan Kewarga negaraan', 'Ilmu Pengetahuan Sosial', 'Kelas XI', 'Misbahul Munir', '2', 2, 'Active'),
(27, 'Bahasa Inggris', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Munik Erviyati', '4', 3, 'Active'),
(28, 'Bahasa Indonesia', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Habibatus Sadiyah', '2', 3, 'Active'),
(29, 'Matematika', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Siti Nur Aeni', '3', 3, 'Active'),
(30, 'Ekonomi', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Muhammad Salim Quthbi', '2', 3, 'Active'),
(31, 'Sejarah', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Khoirotun Nisa', '1', 2, 'Active'),
(32, 'TIK', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Adib Maimun', '7', 2, 'Active'),
(33, 'PJOK', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Mohamad Desi Qomaruddin', '1', 2, 'Active'),
(34, 'Pendidikan Pancasila Dan Kewarga negaraan', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Misbahul Munir', '6', 2, 'Active'),
(35, 'PAI', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Achmad Purwadi', '7', 2, 'Active'),
(36, 'Bahasa Jawa', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'M Saddam Yusuf', '6', 2, 'Active'),
(37, 'Sosiologi', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Achmad Machrus Romli', '4', 3, 'Active'),
(38, 'SBK', 'Ilmu Pengetahuan Sosial', 'Kelas XII', 'Pranoto Jatmiko', '6', 2, 'Active'),
(39, 'TIK', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Adib Maimun', '3', 2, 'Active'),
(40, 'Bahasa Arab', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Achmad Purwadi', '6', 2, 'Active'),
(41, 'Geografi', 'Ilmu Pengetahuan Sosial', 'Kelas X', 'Mafrudlotun Inwaroh', '1', 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_siswa`, `id_jurusan`, `tahun_ajaran`, `semester`, `id_mapel`, `kelas`, `nilai`) VALUES
(1, 3, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(2, 3, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(3, 3, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(4, 3, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(5, 3, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(6, 3, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(7, 3, 2, '2019/2020', 'Genap', 2, 'Kelas X', 90),
(8, 3, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(9, 3, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(10, 3, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(11, 3, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(12, 3, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(13, 8, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(14, 8, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(15, 8, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(16, 8, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(17, 8, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(18, 8, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(19, 8, 2, '2019/2020', 'Genap', 2, 'Kelas X', 80),
(20, 8, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(21, 8, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(22, 8, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(23, 8, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(24, 8, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(25, 11, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(26, 11, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(27, 11, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(28, 11, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(29, 11, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(30, 11, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(31, 11, 2, '2019/2020', 'Genap', 2, 'Kelas X', 89),
(32, 11, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(33, 11, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(34, 11, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(35, 11, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(36, 11, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(37, 14, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(38, 14, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(39, 14, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(40, 14, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(41, 14, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(42, 14, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(43, 14, 2, '2019/2020', 'Genap', 2, 'Kelas X', 90),
(44, 14, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(45, 14, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(46, 14, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(47, 14, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(48, 14, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(49, 15, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(50, 15, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(51, 15, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(52, 15, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(53, 15, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(54, 15, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(55, 15, 2, '2019/2020', 'Genap', 2, 'Kelas X', 85),
(56, 15, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(57, 15, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(58, 15, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(59, 15, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(60, 15, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(61, 22, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(62, 22, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(63, 22, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(64, 22, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(65, 22, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(66, 22, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(67, 22, 2, '2019/2020', 'Genap', 2, 'Kelas X', 89),
(68, 22, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(69, 22, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(70, 22, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(71, 22, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(72, 22, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(73, 27, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(74, 27, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(75, 27, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(76, 27, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(77, 27, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(78, 27, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(79, 27, 2, '2019/2020', 'Genap', 2, 'Kelas X', 90),
(80, 27, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(81, 27, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(82, 27, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(83, 27, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(84, 27, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(85, 35, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(86, 35, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(87, 35, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(88, 35, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(89, 35, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(90, 35, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(91, 35, 2, '2019/2020', 'Genap', 2, 'Kelas X', 86),
(92, 35, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(93, 35, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(94, 35, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(95, 35, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(96, 35, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(97, 47, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(98, 47, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(99, 47, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(100, 47, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(101, 47, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(102, 47, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(103, 47, 2, '2019/2020', 'Genap', 2, 'Kelas X', 95),
(104, 47, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(105, 47, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(106, 47, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(107, 47, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(108, 47, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(109, 60, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(110, 60, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(111, 60, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(112, 60, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(113, 60, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(114, 60, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(115, 60, 2, '2019/2020', 'Genap', 2, 'Kelas X', 85),
(116, 60, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(117, 60, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(118, 60, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(119, 60, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(120, 60, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(121, 61, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(122, 61, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(123, 61, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(124, 61, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(125, 61, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(126, 61, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(127, 61, 2, '2019/2020', 'Genap', 2, 'Kelas X', 87),
(128, 61, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(129, 61, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(130, 61, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(131, 61, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(132, 61, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(133, 65, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(134, 65, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(135, 65, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(136, 65, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(137, 65, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(138, 65, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(139, 65, 2, '2019/2020', 'Genap', 2, 'Kelas X', 89),
(140, 65, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(141, 65, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(142, 65, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(143, 65, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(144, 65, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(145, 69, 2, '2019/2020', 'Genap', 4, 'Kelas X', NULL),
(146, 69, 2, '2019/2020', 'Genap', 8, 'Kelas X', NULL),
(147, 69, 2, '2019/2020', 'Genap', 12, 'Kelas X', NULL),
(148, 69, 2, '2019/2020', 'Genap', 3, 'Kelas X', NULL),
(149, 69, 2, '2019/2020', 'Genap', 7, 'Kelas X', NULL),
(150, 69, 2, '2019/2020', 'Genap', 11, 'Kelas X', NULL),
(151, 69, 2, '2019/2020', 'Genap', 2, 'Kelas X', 95),
(152, 69, 2, '2019/2020', 'Genap', 6, 'Kelas X', NULL),
(153, 69, 2, '2019/2020', 'Genap', 10, 'Kelas X', NULL),
(154, 69, 2, '2019/2020', 'Genap', 5, 'Kelas X', NULL),
(155, 69, 2, '2019/2020', 'Genap', 9, 'Kelas X', NULL),
(156, 69, 2, '2019/2020', 'Genap', 13, 'Kelas X', NULL),
(157, 1, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(158, 1, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(159, 1, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(160, 1, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(161, 1, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(162, 1, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(163, 1, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(164, 1, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(165, 1, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(166, 1, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(167, 1, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(168, 1, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(169, 2, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(170, 2, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(171, 2, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(172, 2, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(173, 2, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(174, 2, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(175, 2, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(176, 2, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(177, 2, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(178, 2, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(179, 2, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(180, 2, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(181, 4, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(182, 4, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(183, 4, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(184, 4, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(185, 4, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(186, 4, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(187, 4, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(188, 4, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(189, 4, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(190, 4, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(191, 4, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(192, 4, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(193, 10, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(194, 10, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(195, 10, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(196, 10, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(197, 10, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(198, 10, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(199, 10, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(200, 10, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(201, 10, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(202, 10, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(203, 10, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(204, 10, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(205, 12, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(206, 12, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(207, 12, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(208, 12, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(209, 12, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(210, 12, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(211, 12, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(212, 12, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(213, 12, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(214, 12, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(215, 12, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(216, 12, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(217, 16, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(218, 16, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(219, 16, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(220, 16, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(221, 16, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(222, 16, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(223, 16, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(224, 16, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(225, 16, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(226, 16, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(227, 16, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(228, 16, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(229, 17, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(230, 17, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(231, 17, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(232, 17, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(233, 17, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(234, 17, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(235, 17, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(236, 17, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(237, 17, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(238, 17, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(239, 17, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(240, 17, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(241, 20, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(242, 20, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(243, 20, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(244, 20, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(245, 20, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(246, 20, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(247, 20, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(248, 20, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(249, 20, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(250, 20, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(251, 20, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(252, 20, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(253, 23, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(254, 23, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(255, 23, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(256, 23, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(257, 23, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(258, 23, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(259, 23, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(260, 23, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(261, 23, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(262, 23, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(263, 23, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(264, 23, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(265, 26, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(266, 26, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(267, 26, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(268, 26, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(269, 26, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(270, 26, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(271, 26, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(272, 26, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(273, 26, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(274, 26, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(275, 26, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(276, 26, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(277, 28, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(278, 28, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(279, 28, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(280, 28, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(281, 28, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(282, 28, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(283, 28, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(284, 28, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(285, 28, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(286, 28, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(287, 28, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(288, 28, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(289, 29, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(290, 29, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(291, 29, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(292, 29, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(293, 29, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(294, 29, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(295, 29, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(296, 29, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(297, 29, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(298, 29, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(299, 29, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(300, 29, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(301, 31, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(302, 31, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(303, 31, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(304, 31, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(305, 31, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(306, 31, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(307, 31, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(308, 31, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(309, 31, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(310, 31, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(311, 31, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(312, 31, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(313, 34, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(314, 34, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(315, 34, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(316, 34, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(317, 34, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(318, 34, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(319, 34, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(320, 34, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(321, 34, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(322, 34, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(323, 34, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(324, 34, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(325, 36, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(326, 36, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(327, 36, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(328, 36, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(329, 36, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(330, 36, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(331, 36, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(332, 36, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(333, 36, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(334, 36, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(335, 36, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(336, 36, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(337, 39, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(338, 39, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(339, 39, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(340, 39, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(341, 39, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(342, 39, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(343, 39, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(344, 39, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(345, 39, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(346, 39, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(347, 39, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(348, 39, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(349, 41, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(350, 41, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(351, 41, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(352, 41, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(353, 41, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(354, 41, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(355, 41, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(356, 41, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(357, 41, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(358, 41, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(359, 41, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(360, 41, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(361, 43, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(362, 43, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(363, 43, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(364, 43, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(365, 43, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(366, 43, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(367, 43, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(368, 43, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(369, 43, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(370, 43, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(371, 43, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(372, 43, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(373, 45, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(374, 45, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(375, 45, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(376, 45, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(377, 45, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(378, 45, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(379, 45, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(380, 45, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(381, 45, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(382, 45, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(383, 45, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(384, 45, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(385, 46, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(386, 46, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(387, 46, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(388, 46, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(389, 46, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(390, 46, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(391, 46, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(392, 46, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(393, 46, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(394, 46, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(395, 46, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(396, 46, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(397, 50, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(398, 50, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(399, 50, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(400, 50, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(401, 50, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(402, 50, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(403, 50, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(404, 50, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(405, 50, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(406, 50, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(407, 50, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(408, 50, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(409, 51, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(410, 51, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(411, 51, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(412, 51, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(413, 51, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(414, 51, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(415, 51, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(416, 51, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(417, 51, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(418, 51, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(419, 51, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(420, 51, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(421, 53, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(422, 53, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(423, 53, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(424, 53, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(425, 53, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(426, 53, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(427, 53, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(428, 53, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(429, 53, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(430, 53, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(431, 53, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(432, 53, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(433, 55, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(434, 55, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(435, 55, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(436, 55, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(437, 55, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(438, 55, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(439, 55, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(440, 55, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(441, 55, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(442, 55, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(443, 55, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(444, 55, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(445, 59, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(446, 59, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(447, 59, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(448, 59, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(449, 59, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(450, 59, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(451, 59, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(452, 59, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(453, 59, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(454, 59, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(455, 59, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(456, 59, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(457, 67, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(458, 67, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(459, 67, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(460, 67, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(461, 67, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(462, 67, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(463, 67, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(464, 67, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(465, 67, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(466, 67, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(467, 67, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(468, 67, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL),
(469, 68, 2, '2019/2020', 'Genap', 14, 'Kelas XI', NULL),
(470, 68, 2, '2019/2020', 'Genap', 18, 'Kelas XI', NULL),
(471, 68, 2, '2019/2020', 'Genap', 22, 'Kelas XI', NULL),
(472, 68, 2, '2019/2020', 'Genap', 26, 'Kelas XI', NULL),
(473, 68, 2, '2019/2020', 'Genap', 17, 'Kelas XI', NULL),
(474, 68, 2, '2019/2020', 'Genap', 21, 'Kelas XI', NULL),
(475, 68, 2, '2019/2020', 'Genap', 25, 'Kelas XI', NULL),
(476, 68, 2, '2019/2020', 'Genap', 16, 'Kelas XI', NULL),
(477, 68, 2, '2019/2020', 'Genap', 20, 'Kelas XI', NULL),
(478, 68, 2, '2019/2020', 'Genap', 15, 'Kelas XI', NULL),
(479, 68, 2, '2019/2020', 'Genap', 19, 'Kelas XI', NULL),
(480, 68, 2, '2019/2020', 'Genap', 23, 'Kelas XI', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `kode_pegawai` varchar(20) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pendidikan_terahir` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `pegawai` varchar(10) NOT NULL,
  `tugas_tambahan` varchar(100) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `kode_pegawai`, `nama_pegawai`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `pendidikan_terahir`, `email`, `password`, `role`, `pegawai`, `tugas_tambahan`, `avatar`, `status`) VALUES
(1, '3939766667130202', 'Ahmad Khoirul Amin', 'Lamongan', '1998-03-01', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'D2', 'khoirulamin@gmail.com', '$2y$10$tMzKuc.jMTgmKaBdqMbW5.8zspNMiIHiNoihuSsZ0SNLrRkzBuN76', 'admin', '6', NULL, NULL, 'Active'),
(2, '8842757658130162', 'Munik Erviyati', 'Lamongan', '1994-06-01', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', 'Waka Kurikulum', NULL, 'Active'),
(3, '8842757658130163', 'Achmad Machrus Romli', 'Lamongan', '1970-07-07', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', 'Waka Kesiswaan', NULL, 'Active'),
(4, '3939766667130203', 'Achmad Purwadi', 'Lamongan', '1988-06-07', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', 'Wali Kelas', NULL, 'Active'),
(5, '3939766667130204', 'Ahmad Kafani', 'Lamongan', '1973-12-12', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', '', NULL, 'Active'),
(6, '3939766667130205', 'Habibatus Sadiyah', 'Lamongan', '1989-12-10', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', '', NULL, 'Active'),
(7, '3939766667130206', 'Khoirotun Nisa', 'Lamongan', '1993-06-01', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', '', NULL, 'Active'),
(8, '3939766667130207', 'M Saddam Yusuf', 'Lamongan', '1991-01-25', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', '', NULL, 'Active'),
(9, '3939766667130208', 'Mafrudlotun Inwaroh', 'Lamongan', '1987-11-04', 'Perempuan', 'Tebluru-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', 'Wali Kelas', NULL, 'Active'),
(10, '3939766667130209', 'Misbahul Munir', 'Lamongan', '1970-12-20', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'S1', NULL, NULL, '', '1', 'Kepala Sekolah', NULL, 'Active'),
(11, '3939766667130211', 'Mohamad Desi Qomaruddin', 'Lamongan', '1987-12-08', 'Laki-Laki', 'Sukodadi-Lamongan', 'S1', NULL, NULL, NULL, '1', 'Wali Kelas', NULL, 'Active'),
(12, '3939766667130212', 'Mufathiroh', 'Lamongan', '1990-05-10', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', '', NULL, 'Active'),
(13, '3939766667130213', 'Muhammad Salim Quthbi', 'Lamongan', '1991-03-04', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', 'Kepala Jurusan', NULL, 'Active'),
(14, '3939766667130214', 'S.nurul Laili', 'Lamongan', '1971-07-14', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', '', NULL, 'Active'),
(15, '3939766667130215', 'Sirojul Haq', 'Lamongan', '1989-05-25', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', '', NULL, 'Active'),
(16, '3939766667130216', 'Siti Nur Aeni', 'Lamongan', '1992-04-03', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', 'Kepala Jurusan', NULL, 'Active'),
(17, '3939766667130217', 'Adib Maimun', 'Lamongan', '1998-07-05', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', NULL, NULL, 'Active'),
(18, '3939766667130218', 'Miftahul Khoir', 'Lamongan', '1980-07-02', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', NULL, NULL, 'Active'),
(19, '3939766667130219', 'Pranoto Jatmiko', 'Lamongan', '1985-07-02', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', NULL, NULL, 'Active'),
(20, '3939766667130220', 'Fathul Mujib', 'Lamongan', '1987-07-15', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', NULL, NULL, 'Active'),
(21, '3939766667130221', 'Miftahul Jannah', 'Lamongan', '1995-07-24', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'S1', NULL, NULL, NULL, '1', NULL, NULL, 'Active'),
(22, '3939766667130222', 'Yusrotun Naimah', 'Lamongan', '1994-07-06', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'SMA', NULL, NULL, NULL, '7', NULL, NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

CREATE TABLE `penggajian` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `total_jam` int(11) NOT NULL,
  `gaji` int(11) NOT NULL,
  `tambahan` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`id`, `id_pegawai`, `periode`, `total_jam`, `gaji`, `tambahan`, `total`) VALUES
(1, 4, '07-2020', 2, 40000, 100000, 140000),
(2, 8, '07-2020', 2, 40000, 0, 40000),
(3, 12, '07-2020', 2, 40000, 0, 40000),
(4, 3, '07-2020', 5, 100000, 150000, 250000),
(5, 7, '07-2020', 4, 80000, 0, 80000),
(6, 11, '07-2020', 2, 40000, 100000, 140000),
(7, 22, '07-2020', 0, 500000, 0, 500000),
(8, 1, '07-2020', 0, 500000, 0, 500000),
(9, 6, '07-2020', 2, 40000, 0, 40000),
(10, 9, '07-2020', 3, 60000, 100000, 160000),
(11, 17, '07-2020', 2, 40000, 0, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `npsn` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `tahun_berdiri` varchar(20) DEFAULT NULL,
  `kepala` int(20) DEFAULT NULL,
  `wakakur` int(20) DEFAULT NULL,
  `wakasis` int(20) DEFAULT NULL,
  `akreditasi` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `kurikulum` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id`, `npsn`, `nama`, `alamat`, `tahun_berdiri`, `kepala`, `wakakur`, `wakasis`, `akreditasi`, `email`, `telpon`, `kurikulum`, `status`) VALUES
(1, 69857712, 'SMAS MANGGALA SAKTI', 'Jl. Sumur Mojo, Rt/Rw:10/02 Ds. Dadapan, Kec. Solokuro, Kab. Lamongan, POS:62265', '2014-06-01', 10, 2, 3, 'B', 'smamanggalasakti@gmail.com', '085967176079', 'Kurikulum 2013', 'Swasta');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `no_induk` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `wali` varchar(50) NOT NULL,
  `avatar` varchar(30) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `jurusan` int(11) DEFAULT NULL,
  `tanggal_masuk` varchar(20) DEFAULT NULL,
  `alasan_masuk` varchar(20) DEFAULT NULL,
  `tanggal_keluar` varchar(20) DEFAULT NULL,
  `status_lulus` varchar(20) DEFAULT NULL,
  `status_aktif` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `no_induk`, `nama_siswa`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `wali`, `avatar`, `kelas`, `jurusan`, `tanggal_masuk`, `alasan_masuk`, `tanggal_keluar`, `status_lulus`, `status_aktif`) VALUES
(1, '3036911455', 'Ahmad Hafidz Saifullah', 'Lamongan', '2003-06-04', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Shofiyatul Hikmah', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(2, '0003372361', 'Ahmad Wildan Ittaqillah', 'Lamongan', '2000-06-23', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Siti Asiyah', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(3, '0021816405', 'Alvian Bhakti Setiawan', 'Lamongan', '2002-12-20', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Utik Suraliningtyas', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(4, '0029557800', 'ANINDIA SAFITRI HIDAYAH', 'Lamongan', '2013-12-15', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'SATIUL HIDAYATI', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(5, '0022072376', 'Dwi Kananda Maulidia Damayanti', 'Lamongan', '2002-05-18', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'Anis Faulutfiyah', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(6, '0086880476', 'Enmah intan Nur laila', 'Lamongan', '2002-03-31', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'ENAWATI', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(7, '0015893560', 'Fajar Aditya Brahmana Saputra', 'Lamongan', '2001-11-09', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Sri Utami', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(8, '0036795050', 'Fikar Rohmatulloh', 'Lamongan', '2003-02-18', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Sujanah', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(9, '0021877076', 'Gea Amanda', 'Lamongan', '2002-05-02', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'Sukarlik', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(10, '0022071443', 'Gilang Purnama Ainul Haq', 'Lamongan', '2002-05-10', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Lasiyatin', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(11, '0025190034', 'IIF SYARIFAH', 'Lamongan', '2002-05-02', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'LUTFIYAH', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(12, '0032771846', 'Irfana Rahmaniyah', 'Lamongan', '2003-06-25', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'Shofiyah', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(13, '0015893559', 'Khafsin Asrori', 'Lamongan', '2001-10-09', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Sulasri', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(14, '0043636312', 'Khoirul Hadi Taqiyudin', 'Lamongan', '2004-09-26', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Anik Nur Kholis', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(15, '0033000632', 'Kis\'atin Nuroh', 'Lamongan', '2003-09-06', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'Sukaini', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(16, '0022472754', 'LAILATUL EKA NURMALA ALAFIA', 'Lamongan', '2002-10-03', 'Perempuan', 'Dadapan-Solokuro-Lamongan', 'MUNAFIAH', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(17, '0032771910', 'Leo Diva Arianto', 'Lamongan', '2003-03-29', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Maratus Sholihah', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(18, '0015891943', 'M. ARIF FURQON', 'Lamongan', '2002-10-16', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'CHOLIFAH', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(19, '0022072393', 'M. Azmi Naufal', 'Lamongan', '2002-10-12', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Titim Muhimmah', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(20, '0000608735', 'M. Hasbullah', 'Lamongan', '2000-08-15', 'Laki-Laki', 'Dadapan-Solokuro-Lamongan', 'Qibtiatun', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(21, '0025160358', 'M. Kamaluddin', 'Lamongan', '2002-06-05', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'Shofiatul Ummah', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(22, '0043636304', 'M. MUSHLIHIN', 'Lamongan', '2004-06-18', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'Kusmiati', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(23, '0036222944', 'M. Mustaqim', 'Lamongan', '2003-06-03', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'Warlin', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(24, '0018186120', 'M. ROFI\'UL HIMAM', 'Lamongan', '2001-10-24', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'NUR AFIDAH', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(25, '0011971146', 'Mahardika Putra Arianto', 'Lamongan', '2001-08-04', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'Karsitah', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(26, '0036591623', 'Mar\'tun Najiyah', 'Lamongan', '2003-05-23', 'Perempuan', 'Tebluru-Solokuro-Lamongan', 'Luluk Anisatul Hamidah', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(27, '0043860081', 'Mawar Umu Salamah', 'Lamongan', '2004-11-16', 'Perempuan', 'Tebluru-Solokuro-Lamongan', 'Siti Rohmawati', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(28, '0036528396', 'Miftakhun Nikmah', 'Lamongan', '2003-01-07', 'Perempuan', 'Tebluru-Solokuro-Lamongan', 'Nasri', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(29, '0035988425', 'Misbahul Munir', 'Lamongan', '2003-12-19', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'Siti Rokhimi', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(30, '0030155012', 'MOH. AFIF NASHIRON', 'Lamongan', '2003-01-08', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'ISMAROH', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(31, '3011396246', 'MOH. BURHANUDDIN', 'Lamongan', '2001-04-26', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'ISTINAROH', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(32, '0022072372', 'MOH. ERIK FIRMANSYAH', 'Lamongan', '2002-05-04', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'KHUSNUL KHOTIMAH', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(33, '0022072373', 'Moh. Nashirul Huda', 'Lamongan', '2002-05-05', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'Rupiyatun', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(34, '0022220835', 'MOH. WAHYUDI', 'Lamongan', '2002-04-12', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'DARMINI', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(35, '0049275802', 'Mohammad Putra Maulana', 'Lamongan', '2004-08-09', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'Martin Ningrum', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(36, '0015763336', 'MUHAMAD FATCHUR ROHMAN', 'Lamongan', '2001-12-16', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'SITI MUHAIMIN', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(37, '0023722121', 'MUHAMMAD ALEX', 'Lamongan', '2002-06-30', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'SUTATIK', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(38, '0007128302', 'MUHAMMAD ALFIN NURUS SALAM', 'Lamongan', '2000-08-24', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'SITI AISYAH', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(39, '0031188760', 'MUHAMMAD AMIRUDDIN MA\'SUM', 'Lamongan', '2003-06-20', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'NURHANA', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(40, '0027927171', 'MUHAMMAD ARDIANSYA MAULANA', 'Lamongan', '2002-05-01', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'DEWI HARTINI', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(41, '3025890005', 'MUHAMMAD FAHMI ZAKARIYA', 'Lamongan', '2002-08-06', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'TUTIK HIDAYATI', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(42, '0016013834', 'MUHAMMAD MAWAHIBUR ROHMAN', 'Lamongan', '2001-09-26', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'NURUL HIDAYAH', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(43, '0026498471', 'MUHAMMAD WILDANUL ATQIYA', 'Lamongan', '2002-10-18', 'Laki-Laki', 'Tebluru-Solokuro-Lamongan', 'SULISTIYANI', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(44, '3011960152', 'MUNTI\'AH', 'Lamongan', '2001-09-06', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'DASRI', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(45, '0025891969', 'Mutiara Suci Khoirun Nisa\'', 'Lamongan', '2002-12-13', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Eni Saidah', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(46, '0032538002', 'NABILATUS SHOLIHAH', 'Lamongan', '2003-03-04', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'LULUK MAMLUHAH', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(47, '0043430188', 'Nada Rifqiyah', 'Lamongan', '2004-04-21', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Sholihatin Nur', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(48, '0010818929', 'NAILA FARIHA', 'Lamongan', '2001-07-25', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'MARWIYAH', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(49, '0015891573', 'NASHRUL UMAM', 'Lamongan', '2001-11-23', 'Laki-Laki', 'Paciran-Solokuro-Lamongan', 'NAFSAROH', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(50, '0026177924', 'NGRENI MASFUFAH', 'Lamongan', '2002-07-14', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'WIWIN IRA WATI', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(51, '0043415811', 'Nila Faizatul Maula', 'Lamongan', '2004-01-21', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Siti Aisyah', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(52, '0020010878', 'Nur Aeni Azizah', 'Lamongan', '2002-03-01', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Rofi\'', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(53, '0032170800', 'Nur Fadlilatus Sania', 'Lamongan', '2003-07-14', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Mufarochah', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(54, '0015891407', 'NUR MAHMUDI ISNAENI', 'Lamongan', '2001-11-28', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'ARIK INDRAWATI', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(55, '3982665084', 'OLIVIA NATANIA', 'Lamongan', '1998-10-18', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'SAUDAH', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(56, '0013205147', 'Risa', 'Lamongan', '2001-07-24', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Surat', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(57, '0027365521', 'RIZKY ISNAINI MAULIDY', 'Lamongan', '2002-08-01', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'ZULIANA', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(58, '0018692941', 'Roikhatus Zulfa', 'Lamongan', '2001-01-23', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Wasriyah', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(59, '3014180593', 'Sa\'adah Abadiah', 'Lamongan', '2001-08-05', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Siti Nur Kholifah', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(60, '0049354011', 'Shofiyah', 'Lamongan', '2004-06-08', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Maliyah', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(61, '0024624570', 'SITI MUTAMIMAH', 'Lamongan', '2001-10-28', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'SITI ULZIMAH', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(62, '0023637063', 'Siti Riyani', 'Lamongan', '2002-02-04', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Marwati', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(63, '0021641781', 'SOVA SEVILIA', 'Lamongan', '2002-09-28', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'SULISWATI', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(64, '0019130060', 'SYAHRUL RAMADAN', 'Lamongan', '2001-11-12', 'Laki-Laki', 'Paciran-Solokuro-Lamongan', 'SUSANTI', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(65, '0012976218', 'TAUJIDDAH ARGUN', 'Lamongan', '2001-05-08', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Kusriyati', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(66, '0016828133', 'TEGUH FIRMANSYAH', 'Lamongan', '2001-05-22', 'Laki-Laki', 'Paciran-Solokuro-Lamongan', 'DEPA LENI', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(67, '0026549910', 'Umi Fitriani', 'Lamongan', '2002-12-06', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Karjumi', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(68, '0032778749', 'VANNY ABDUL ADIL BAIN NURKAN', 'Lamongan', '2003-04-26', 'Laki-Laki', 'Paciran-Solokuro-Lamongan', 'Giharti', NULL, 'Kelas XI', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(69, '0037536645', 'WASI\'UL MAGHFIROH', 'Lamongan', '2003-12-19', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'ANIK FAUZIAH', NULL, 'Kelas X', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(70, '0028558052', 'Waus Saniyah', 'Lamongan', '2002-05-04', 'Perempuan', 'Paciran-Solokuro-Lamongan', 'Casripah', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active'),
(71, '0022072374', 'Zufar Lazuardi', 'Lamongan', '2002-05-12', 'Laki-Laki', 'Paciran-Solokuro-Lamongan', 'Siti Rahmatun', NULL, 'Kelas XII', 2, '2020-06-22', 'Baru', NULL, NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `tgl_bayar` varchar(20) DEFAULT NULL,
  `nominal` int(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id`, `id_siswa`, `periode`, `tgl_bayar`, `nominal`, `status`) VALUES
(1, 1, '6/2020', '2020-07-05', 100000, 'Lunas'),
(2, 2, '6/2020', '2020-07-05', 100000, 'Lunas'),
(3, 3, '6/2020', '2020-07-05', 100000, 'Lunas'),
(4, 4, '6/2020', NULL, 100000, 'Belum Dibayar'),
(5, 5, '6/2020', NULL, 100000, 'Belum Dibayar'),
(6, 6, '6/2020', NULL, 100000, 'Belum Dibayar'),
(7, 7, '6/2020', NULL, 100000, 'Belum Dibayar'),
(8, 8, '6/2020', NULL, 100000, 'Belum Dibayar'),
(9, 9, '6/2020', NULL, 100000, 'Belum Dibayar'),
(10, 10, '6/2020', NULL, 100000, 'Belum Dibayar'),
(11, 11, '6/2020', NULL, 100000, 'Belum Dibayar'),
(12, 12, '6/2020', NULL, 100000, 'Belum Dibayar'),
(13, 13, '6/2020', NULL, 100000, 'Belum Dibayar'),
(14, 14, '6/2020', NULL, 100000, 'Belum Dibayar'),
(15, 15, '6/2020', NULL, 100000, 'Belum Dibayar'),
(16, 16, '6/2020', NULL, 100000, 'Belum Dibayar'),
(17, 17, '6/2020', NULL, 100000, 'Belum Dibayar'),
(18, 18, '6/2020', NULL, 100000, 'Belum Dibayar'),
(19, 19, '6/2020', NULL, 100000, 'Belum Dibayar'),
(20, 20, '6/2020', NULL, 100000, 'Belum Dibayar'),
(21, 21, '6/2020', NULL, 100000, 'Belum Dibayar'),
(22, 22, '6/2020', NULL, 100000, 'Belum Dibayar'),
(23, 23, '6/2020', NULL, 100000, 'Belum Dibayar'),
(24, 24, '6/2020', NULL, 100000, 'Belum Dibayar'),
(25, 25, '6/2020', NULL, 100000, 'Belum Dibayar'),
(26, 26, '6/2020', NULL, 100000, 'Belum Dibayar'),
(27, 27, '6/2020', NULL, 100000, 'Belum Dibayar'),
(28, 28, '6/2020', NULL, 100000, 'Belum Dibayar'),
(29, 29, '6/2020', NULL, 100000, 'Belum Dibayar'),
(30, 30, '6/2020', NULL, 100000, 'Belum Dibayar'),
(31, 31, '6/2020', NULL, 100000, 'Belum Dibayar'),
(32, 32, '6/2020', NULL, 100000, 'Belum Dibayar'),
(33, 33, '6/2020', NULL, 100000, 'Belum Dibayar'),
(34, 34, '6/2020', NULL, 100000, 'Belum Dibayar'),
(35, 35, '6/2020', NULL, 100000, 'Belum Dibayar'),
(36, 36, '6/2020', NULL, 100000, 'Belum Dibayar'),
(37, 37, '6/2020', NULL, 100000, 'Belum Dibayar'),
(38, 38, '6/2020', NULL, 100000, 'Belum Dibayar'),
(39, 39, '6/2020', NULL, 100000, 'Belum Dibayar'),
(40, 40, '6/2020', NULL, 100000, 'Belum Dibayar'),
(41, 41, '6/2020', NULL, 100000, 'Belum Dibayar'),
(42, 42, '6/2020', NULL, 100000, 'Belum Dibayar'),
(43, 43, '6/2020', NULL, 100000, 'Belum Dibayar'),
(44, 44, '6/2020', NULL, 100000, 'Belum Dibayar'),
(45, 45, '6/2020', NULL, 100000, 'Belum Dibayar'),
(46, 46, '6/2020', NULL, 100000, 'Belum Dibayar'),
(47, 47, '6/2020', NULL, 100000, 'Belum Dibayar'),
(48, 48, '6/2020', NULL, 100000, 'Belum Dibayar'),
(49, 49, '6/2020', NULL, 100000, 'Belum Dibayar'),
(50, 50, '6/2020', NULL, 100000, 'Belum Dibayar'),
(51, 51, '6/2020', NULL, 100000, 'Belum Dibayar'),
(52, 52, '6/2020', NULL, 100000, 'Belum Dibayar'),
(53, 53, '6/2020', NULL, 100000, 'Belum Dibayar'),
(54, 54, '6/2020', NULL, 100000, 'Belum Dibayar'),
(55, 55, '6/2020', NULL, 100000, 'Belum Dibayar'),
(56, 56, '6/2020', NULL, 100000, 'Belum Dibayar'),
(57, 57, '6/2020', NULL, 100000, 'Belum Dibayar'),
(58, 58, '6/2020', NULL, 100000, 'Belum Dibayar'),
(59, 59, '6/2020', NULL, 100000, 'Belum Dibayar'),
(60, 60, '6/2020', NULL, 100000, 'Belum Dibayar'),
(61, 61, '6/2020', NULL, 100000, 'Belum Dibayar'),
(62, 62, '6/2020', NULL, 100000, 'Belum Dibayar'),
(63, 63, '6/2020', NULL, 100000, 'Belum Dibayar'),
(64, 64, '6/2020', NULL, 100000, 'Belum Dibayar'),
(65, 65, '6/2020', NULL, 100000, 'Belum Dibayar'),
(66, 66, '6/2020', NULL, 100000, 'Belum Dibayar'),
(67, 67, '6/2020', NULL, 100000, 'Belum Dibayar'),
(68, 68, '6/2020', NULL, 100000, 'Belum Dibayar'),
(69, 69, '6/2020', NULL, 100000, 'Belum Dibayar'),
(70, 70, '6/2020', NULL, 100000, 'Belum Dibayar'),
(71, 71, '6/2020', NULL, 100000, 'Belum Dibayar');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_absen`
-- (See below for the actual view)
--
CREATE TABLE `v_absen` (
`id` int(11)
,`id_pegawai` int(11)
,`tanggal` varchar(20)
,`masuk` varchar(20)
,`pulang` varchar(20)
,`jumlah_jam` int(20)
,`keterangan` varchar(50)
,`nama_pegawai` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_custom_mapel`
-- (See below for the actual view)
--
CREATE TABLE `v_custom_mapel` (
`id` int(11)
,`nama_mapel` varchar(50)
,`jurusan` varchar(100)
,`kelas` varchar(10)
,`status` varchar(10)
,`id_jurusan` bigint(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jam`
-- (See below for the actual view)
--
CREATE TABLE `v_jam` (
`guru_pengajar` varchar(100)
,`jumlah_jam` int(11)
,`hari` varchar(20)
,`id_pegawai` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jumlah_jam`
-- (See below for the actual view)
--
CREATE TABLE `v_jumlah_jam` (
`id_pegawai` int(11)
,`bulan_tahun` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jurusan`
-- (See below for the actual view)
--
CREATE TABLE `v_jurusan` (
`id` int(11)
,`jurusan` varchar(50)
,`kepala_jurusan` int(11)
,`status` varchar(20)
,`nama_pegawai` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_nilai`
-- (See below for the actual view)
--
CREATE TABLE `v_nilai` (
`id` int(11)
,`id_siswa` int(11)
,`id_jurusan` int(11)
,`tahun_ajaran` varchar(20)
,`semester` varchar(20)
,`id_mapel` int(11)
,`kelas` varchar(20)
,`nilai` int(11)
,`nama_siswa` varchar(50)
,`jurusan` varchar(50)
,`nama_mapel` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pegawai`
-- (See below for the actual view)
--
CREATE TABLE `v_pegawai` (
`id` int(11)
,`kode_pegawai` varchar(20)
,`nama_pegawai` varchar(50)
,`tempat_lahir` varchar(50)
,`tanggal_lahir` varchar(20)
,`jenis_kelamin` varchar(20)
,`alamat` varchar(100)
,`pendidikan_terahir` varchar(50)
,`email` varchar(50)
,`password` varchar(100)
,`role` varchar(10)
,`pegawai` varchar(10)
,`tugas_tambahan` varchar(100)
,`avatar` varchar(50)
,`status` varchar(20)
,`jabatan` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penggajian`
-- (See below for the actual view)
--
CREATE TABLE `v_penggajian` (
`id` int(11)
,`id_pegawai` int(11)
,`periode` varchar(20)
,`total_jam` int(11)
,`gaji` int(11)
,`tambahan` int(11)
,`total` int(11)
,`nama_pegawai` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penghitung_gaji`
-- (See below for the actual view)
--
CREATE TABLE `v_penghitung_gaji` (
`id_pegawai` int(11)
,`bulan_tahun` varchar(20)
,`pegawai` varchar(10)
,`gaji_pokok` bigint(25)
,`gaji_tambahan` bigint(25)
,`tugas_tambahan` varchar(100)
,`total_jam` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sekolah`
-- (See below for the actual view)
--
CREATE TABLE `v_sekolah` (
`id` int(11)
,`npsn` int(11)
,`nama` varchar(100)
,`alamat` varchar(200)
,`tahun_berdiri` varchar(20)
,`kepala` int(20)
,`wakakur` int(20)
,`wakasis` int(20)
,`akreditasi` varchar(10)
,`email` varchar(100)
,`telpon` varchar(20)
,`kurikulum` varchar(100)
,`status` varchar(100)
,`nama_kasek` varchar(50)
,`nama_wakakur` varchar(50)
,`nama_wakasis` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_siswa_aktif`
-- (See below for the actual view)
--
CREATE TABLE `v_siswa_aktif` (
`id` int(11)
,`no_induk` varchar(20)
,`nama_siswa` varchar(50)
,`tempat_lahir` varchar(20)
,`tanggal_lahir` varchar(20)
,`jenis_kelamin` varchar(20)
,`alamat` varchar(100)
,`wali` varchar(50)
,`avatar` varchar(30)
,`kelas` varchar(10)
,`jurusan` int(11)
,`tanggal_masuk` varchar(20)
,`alasan_masuk` varchar(20)
,`tanggal_keluar` varchar(20)
,`status_lulus` varchar(20)
,`status_aktif` varchar(15)
,`nama_jurusan` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_siswa_inactive`
-- (See below for the actual view)
--
CREATE TABLE `v_siswa_inactive` (
`id` int(11)
,`no_induk` varchar(20)
,`nama_siswa` varchar(50)
,`tempat_lahir` varchar(20)
,`tanggal_lahir` varchar(20)
,`jenis_kelamin` varchar(20)
,`alamat` varchar(100)
,`wali` varchar(50)
,`avatar` varchar(30)
,`kelas` varchar(10)
,`jurusan` int(11)
,`tanggal_masuk` varchar(20)
,`alasan_masuk` varchar(20)
,`tanggal_keluar` varchar(20)
,`status_lulus` varchar(20)
,`status_aktif` varchar(15)
,`nama_jurusan` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_siswa_lulus`
-- (See below for the actual view)
--
CREATE TABLE `v_siswa_lulus` (
`id` int(11)
,`no_induk` varchar(20)
,`nama_siswa` varchar(50)
,`tempat_lahir` varchar(20)
,`tanggal_lahir` varchar(20)
,`jenis_kelamin` varchar(20)
,`alamat` varchar(100)
,`wali` varchar(50)
,`avatar` varchar(30)
,`kelas` varchar(10)
,`jurusan` int(11)
,`tanggal_masuk` varchar(20)
,`alasan_masuk` varchar(20)
,`tanggal_keluar` varchar(20)
,`status_lulus` varchar(20)
,`status_aktif` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_spp`
-- (See below for the actual view)
--
CREATE TABLE `v_spp` (
`id` int(11)
,`id_siswa` int(11)
,`periode` varchar(20)
,`tgl_bayar` varchar(20)
,`nominal` int(20)
,`status` varchar(20)
,`nama_siswa` varchar(50)
,`kelas` varchar(10)
);

-- --------------------------------------------------------

--
-- Structure for view `v_absen`
--
DROP TABLE IF EXISTS `v_absen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_absen`  AS  select `absen`.`id` AS `id`,`absen`.`id_pegawai` AS `id_pegawai`,`absen`.`tanggal` AS `tanggal`,`absen`.`masuk` AS `masuk`,`absen`.`pulang` AS `pulang`,`absen`.`jumlah_jam` AS `jumlah_jam`,`absen`.`keterangan` AS `keterangan`,`pegawai`.`nama_pegawai` AS `nama_pegawai` from (`absen` join `pegawai`) where (`absen`.`id_pegawai` = `pegawai`.`id`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_custom_mapel`
--
DROP TABLE IF EXISTS `v_custom_mapel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_custom_mapel`  AS  select `mapel`.`id` AS `id`,`mapel`.`nama_mapel` AS `nama_mapel`,`mapel`.`jurusan` AS `jurusan`,`mapel`.`kelas` AS `kelas`,`mapel`.`status` AS `status`,(select `jurusan`.`id` from `jurusan` where (`jurusan`.`jurusan` = `mapel`.`jurusan`)) AS `id_jurusan` from `mapel` ;

-- --------------------------------------------------------

--
-- Structure for view `v_jam`
--
DROP TABLE IF EXISTS `v_jam`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jam`  AS  select `mapel`.`guru_pengajar` AS `guru_pengajar`,`mapel`.`jumlah_jam` AS `jumlah_jam`,`mapel`.`hari` AS `hari`,`pegawai`.`id` AS `id_pegawai` from (`mapel` join `pegawai`) where (`mapel`.`guru_pengajar` = `pegawai`.`nama_pegawai`) group by `mapel`.`hari`,`mapel`.`guru_pengajar`,`pegawai`.`id`,`mapel`.`jumlah_jam` ;

-- --------------------------------------------------------

--
-- Structure for view `v_jumlah_jam`
--
DROP TABLE IF EXISTS `v_jumlah_jam`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jumlah_jam`  AS  select `absen`.`id_pegawai` AS `id_pegawai`,`absen`.`bulan_tahun` AS `bulan_tahun` from `absen` group by `absen`.`id_pegawai`,`absen`.`bulan_tahun` ;

-- --------------------------------------------------------

--
-- Structure for view `v_jurusan`
--
DROP TABLE IF EXISTS `v_jurusan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jurusan`  AS  select `jurusan`.`id` AS `id`,`jurusan`.`jurusan` AS `jurusan`,`jurusan`.`kepala_jurusan` AS `kepala_jurusan`,`jurusan`.`status` AS `status`,`pegawai`.`nama_pegawai` AS `nama_pegawai` from (`jurusan` join `pegawai`) where (`jurusan`.`kepala_jurusan` = `pegawai`.`id`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_nilai`
--
DROP TABLE IF EXISTS `v_nilai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nilai`  AS  select `nilai`.`id` AS `id`,`nilai`.`id_siswa` AS `id_siswa`,`nilai`.`id_jurusan` AS `id_jurusan`,`nilai`.`tahun_ajaran` AS `tahun_ajaran`,`nilai`.`semester` AS `semester`,`nilai`.`id_mapel` AS `id_mapel`,`nilai`.`kelas` AS `kelas`,`nilai`.`nilai` AS `nilai`,`siswa`.`nama_siswa` AS `nama_siswa`,`jurusan`.`jurusan` AS `jurusan`,`mapel`.`nama_mapel` AS `nama_mapel` from (((`nilai` join `jurusan`) join `siswa`) join `mapel`) where ((`nilai`.`id_siswa` = `siswa`.`id`) and (`nilai`.`id_jurusan` = `jurusan`.`id`) and (`nilai`.`id_mapel` = `mapel`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pegawai`
--
DROP TABLE IF EXISTS `v_pegawai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pegawai`  AS  select `pegawai`.`id` AS `id`,`pegawai`.`kode_pegawai` AS `kode_pegawai`,`pegawai`.`nama_pegawai` AS `nama_pegawai`,`pegawai`.`tempat_lahir` AS `tempat_lahir`,`pegawai`.`tanggal_lahir` AS `tanggal_lahir`,`pegawai`.`jenis_kelamin` AS `jenis_kelamin`,`pegawai`.`alamat` AS `alamat`,`pegawai`.`pendidikan_terahir` AS `pendidikan_terahir`,`pegawai`.`email` AS `email`,`pegawai`.`password` AS `password`,`pegawai`.`role` AS `role`,`pegawai`.`pegawai` AS `pegawai`,`pegawai`.`tugas_tambahan` AS `tugas_tambahan`,`pegawai`.`avatar` AS `avatar`,`pegawai`.`status` AS `status`,`jabatan`.`jabatan` AS `jabatan` from (`pegawai` join `jabatan`) where (`pegawai`.`pegawai` = `jabatan`.`id`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_penggajian`
--
DROP TABLE IF EXISTS `v_penggajian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penggajian`  AS  select `penggajian`.`id` AS `id`,`penggajian`.`id_pegawai` AS `id_pegawai`,`penggajian`.`periode` AS `periode`,`penggajian`.`total_jam` AS `total_jam`,`penggajian`.`gaji` AS `gaji`,`penggajian`.`tambahan` AS `tambahan`,`penggajian`.`total` AS `total`,`pegawai`.`nama_pegawai` AS `nama_pegawai` from (`penggajian` join `pegawai`) where (`penggajian`.`id_pegawai` = `pegawai`.`id`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_penghitung_gaji`
--
DROP TABLE IF EXISTS `v_penghitung_gaji`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penghitung_gaji`  AS  select `v_jumlah_jam`.`id_pegawai` AS `id_pegawai`,`v_jumlah_jam`.`bulan_tahun` AS `bulan_tahun`,`pegawai`.`pegawai` AS `pegawai`,(select `jabatan`.`gaji` from `jabatan` where (`jabatan`.`id` = `pegawai`.`pegawai`)) AS `gaji_pokok`,(select `jabatan`.`gaji` from `jabatan` where (`jabatan`.`jabatan` = `pegawai`.`tugas_tambahan`)) AS `gaji_tambahan`,`pegawai`.`tugas_tambahan` AS `tugas_tambahan`,(select sum(`absen`.`jumlah_jam`) from `absen` where (`absen`.`id_pegawai` = `v_jumlah_jam`.`id_pegawai`)) AS `total_jam` from (`v_jumlah_jam` join `pegawai`) where (`v_jumlah_jam`.`id_pegawai` = `pegawai`.`id`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_sekolah`
--
DROP TABLE IF EXISTS `v_sekolah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sekolah`  AS  select `sekolah`.`id` AS `id`,`sekolah`.`npsn` AS `npsn`,`sekolah`.`nama` AS `nama`,`sekolah`.`alamat` AS `alamat`,`sekolah`.`tahun_berdiri` AS `tahun_berdiri`,`sekolah`.`kepala` AS `kepala`,`sekolah`.`wakakur` AS `wakakur`,`sekolah`.`wakasis` AS `wakasis`,`sekolah`.`akreditasi` AS `akreditasi`,`sekolah`.`email` AS `email`,`sekolah`.`telpon` AS `telpon`,`sekolah`.`kurikulum` AS `kurikulum`,`sekolah`.`status` AS `status`,(select `pegawai`.`nama_pegawai` from `pegawai` where (`sekolah`.`kepala` = `pegawai`.`id`)) AS `nama_kasek`,(select `pegawai`.`nama_pegawai` from `pegawai` where (`sekolah`.`wakakur` = `pegawai`.`id`)) AS `nama_wakakur`,(select `pegawai`.`nama_pegawai` from `pegawai` where (`sekolah`.`wakasis` = `pegawai`.`id`)) AS `nama_wakasis` from `sekolah` ;

-- --------------------------------------------------------

--
-- Structure for view `v_siswa_aktif`
--
DROP TABLE IF EXISTS `v_siswa_aktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_siswa_aktif`  AS  (select `siswa`.`id` AS `id`,`siswa`.`no_induk` AS `no_induk`,`siswa`.`nama_siswa` AS `nama_siswa`,`siswa`.`tempat_lahir` AS `tempat_lahir`,`siswa`.`tanggal_lahir` AS `tanggal_lahir`,`siswa`.`jenis_kelamin` AS `jenis_kelamin`,`siswa`.`alamat` AS `alamat`,`siswa`.`wali` AS `wali`,`siswa`.`avatar` AS `avatar`,`siswa`.`kelas` AS `kelas`,`siswa`.`jurusan` AS `jurusan`,`siswa`.`tanggal_masuk` AS `tanggal_masuk`,`siswa`.`alasan_masuk` AS `alasan_masuk`,`siswa`.`tanggal_keluar` AS `tanggal_keluar`,`siswa`.`status_lulus` AS `status_lulus`,`siswa`.`status_aktif` AS `status_aktif`,`jurusan`.`jurusan` AS `nama_jurusan` from (`siswa` join `jurusan`) where ((`siswa`.`status_aktif` = 'Active') and (`siswa`.`jurusan` = `jurusan`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_siswa_inactive`
--
DROP TABLE IF EXISTS `v_siswa_inactive`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_siswa_inactive`  AS  (select `siswa`.`id` AS `id`,`siswa`.`no_induk` AS `no_induk`,`siswa`.`nama_siswa` AS `nama_siswa`,`siswa`.`tempat_lahir` AS `tempat_lahir`,`siswa`.`tanggal_lahir` AS `tanggal_lahir`,`siswa`.`jenis_kelamin` AS `jenis_kelamin`,`siswa`.`alamat` AS `alamat`,`siswa`.`wali` AS `wali`,`siswa`.`avatar` AS `avatar`,`siswa`.`kelas` AS `kelas`,`siswa`.`jurusan` AS `jurusan`,`siswa`.`tanggal_masuk` AS `tanggal_masuk`,`siswa`.`alasan_masuk` AS `alasan_masuk`,`siswa`.`tanggal_keluar` AS `tanggal_keluar`,`siswa`.`status_lulus` AS `status_lulus`,`siswa`.`status_aktif` AS `status_aktif`,`jurusan`.`jurusan` AS `nama_jurusan` from (`siswa` join `jurusan`) where ((`siswa`.`status_aktif` <> 'Active') and (`siswa`.`jurusan` = `jurusan`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_siswa_lulus`
--
DROP TABLE IF EXISTS `v_siswa_lulus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_siswa_lulus`  AS  select `siswa`.`id` AS `id`,`siswa`.`no_induk` AS `no_induk`,`siswa`.`nama_siswa` AS `nama_siswa`,`siswa`.`tempat_lahir` AS `tempat_lahir`,`siswa`.`tanggal_lahir` AS `tanggal_lahir`,`siswa`.`jenis_kelamin` AS `jenis_kelamin`,`siswa`.`alamat` AS `alamat`,`siswa`.`wali` AS `wali`,`siswa`.`avatar` AS `avatar`,`siswa`.`kelas` AS `kelas`,`siswa`.`jurusan` AS `jurusan`,`siswa`.`tanggal_masuk` AS `tanggal_masuk`,`siswa`.`alasan_masuk` AS `alasan_masuk`,`siswa`.`tanggal_keluar` AS `tanggal_keluar`,`siswa`.`status_lulus` AS `status_lulus`,`siswa`.`status_aktif` AS `status_aktif` from `siswa` where (`siswa`.`status_lulus` = 'Lulus') ;

-- --------------------------------------------------------

--
-- Structure for view `v_spp`
--
DROP TABLE IF EXISTS `v_spp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_spp`  AS  (select `spp`.`id` AS `id`,`spp`.`id_siswa` AS `id_siswa`,`spp`.`periode` AS `periode`,`spp`.`tgl_bayar` AS `tgl_bayar`,`spp`.`nominal` AS `nominal`,`spp`.`status` AS `status`,`siswa`.`nama_siswa` AS `nama_siswa`,`siswa`.`kelas` AS `kelas` from (`spp` join `siswa`) where (`spp`.`id_siswa` = `siswa`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `penggajian`
--
ALTER TABLE `penggajian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
