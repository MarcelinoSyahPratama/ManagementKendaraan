-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 03:10 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesananmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktifitaslogin`
--

CREATE TABLE `aktifitaslogin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(60) NOT NULL,
  `tanggal` date NOT NULL,
  `waktuMasuk` time NOT NULL,
  `waktuKeluar` time NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aktifitaslogin`
--

INSERT INTO `aktifitaslogin` (`id`, `nama`, `jabatan`, `tanggal`, `waktuMasuk`, `waktuKeluar`, `id_user`) VALUES
(4, 'marcel11', 'admin', '2022-06-24', '06:19:11', '07:54:31', 2),
(5, 'marcel11', 'admin', '2022-06-24', '06:20:59', '07:54:31', 2),
(6, 'aku', 'admin', '2022-06-24', '06:21:31', '07:55:35', 3),
(7, 'aku', 'admin', '2022-06-24', '06:22:08', '07:55:35', 3),
(8, 'aku', 'pengawas', '2022-06-24', '06:24:20', '07:55:35', 3),
(9, 'aku', 'pengawas', '2022-06-24', '07:44:18', '07:55:35', 3),
(10, 'marcel11', 'admin', '2022-06-24', '07:46:36', '07:54:31', 2),
(11, 'aku', 'pengawas', '2022-06-24', '07:54:51', '07:55:35', 3);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL,
  `namaKendaraan` varchar(100) NOT NULL,
  `plat` varchar(100) NOT NULL,
  `bbm` varchar(100) NOT NULL,
  `serviceterakhir` date NOT NULL,
  `jadwalService` date NOT NULL,
  `status` enum('dipakai','kosong','dipesan','harusService') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `namaKendaraan`, `plat`, `bbm`, `serviceterakhir`, `jadwalService`, `status`) VALUES
(4, 'truk', 'N 6043 KL', '12KM/L', '2022-06-22', '2022-07-22', 'dipesan'),
(5, 'FUSO', 'N 6546 NN', '12KM/L', '2022-06-23', '2022-07-23', 'dipesan'),
(6, 'BeLAZ 75710', 'N 3723 MK', '12KM/l', '2022-06-24', '2022-07-24', 'kosong'),
(7, 'Dump Truck', 'N 9765 BM', '6KM/L', '2022-06-25', '2022-07-25', 'kosong'),
(8, 'Bucyrus MT 6300 AC', 'N 6423 JK', '4KM/L', '2022-06-25', '2022-07-25', 'dipesan'),
(9, 'End Dump', 'N 9087 HK', '13KM/L', '2022-06-25', '2022-07-25', 'dipesan');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `namaPemesan` varchar(30) NOT NULL,
  `namaDriver` varchar(30) NOT NULL,
  `namaKendaraan` varchar(20) NOT NULL,
  `platKendaraan` varchar(10) NOT NULL,
  `namaAtasan` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `tglkembali` date NOT NULL,
  `status` enum('menunggu','setuju','ditolak','dikembalikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `namaPemesan`, `namaDriver`, `namaKendaraan`, `platKendaraan`, `namaAtasan`, `tanggal`, `tglkembali`, `status`) VALUES
(10, 'Okta', 'Okta', 'End Dump', 'N 9087 HK', 'aku', '2022-06-26', '0000-00-00', 'menunggu'),
(11, 'marcel', 'zaka', 'Bucyrus MT 6300 AC', 'N 6423 JK', 'aku', '2022-06-28', '0000-00-00', 'ditolak'),
(12, 'Azka', 'budi', 'FUSO', 'N 6546 NN', 'aku', '2022-06-27', '0000-00-00', 'setuju');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `jabatan` enum('admin','pengawas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `pass`, `jabatan`) VALUES
(2, 'marcel11', 'lino21', '$2y$10$zBHrK65THv.C4r/X3TA1weQeWPjOKSq5ND/29XX48YYaNuTDF.aDC', 'admin'),
(3, 'aku', 'siapa', '$2y$10$V1XD.VKD1nEz.vqwhfDyGuc2U.zFQ4UxDHiChONyjFCEJtzGNmPam', 'pengawas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktifitaslogin`
--
ALTER TABLE `aktifitaslogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktifitaslogin`
--
ALTER TABLE `aktifitaslogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
