-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 16, 2026 at 05:55 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techfix_servis`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_servis`
--

CREATE TABLE `detail_servis` (
  `id_detail` int NOT NULL,
  `id_servis` int DEFAULT NULL,
  `id_sparepart` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `harga_saat_servis` int DEFAULT NULL,
  `subtotal` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_servis`
--

INSERT INTO `detail_servis` (`id_detail`, `id_servis`, `id_sparepart`, `qty`, `harga_saat_servis`, `subtotal`) VALUES
(1, 1, 2, 1, 70000, 70000),
(2, 2, 3, 1, 60000, 60000),
(3, 3, 1, 1, 150000, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `nota_pembayaran`
--

CREATE TABLE `nota_pembayaran` (
  `id_nota` int NOT NULL,
  `id_servis` int DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `total_bayar` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`) VALUES
(1, 'Rivaldo'),
(2, 'Dimas'),
(3, 'Zidan');

-- --------------------------------------------------------

--
-- Table structure for table `servis`
--

CREATE TABLE `servis` (
  `id_servis` int NOT NULL,
  `id_pelanggan` int DEFAULT NULL,
  `keluhan` text,
  `status` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `biaya_jasa` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `servis`
--

INSERT INTO `servis` (`id_servis`, `id_pelanggan`, `keluhan`, `status`, `tanggal_masuk`, `biaya_jasa`) VALUES
(1, 1, 'ganti rom', 'Selesai', '2026-04-16', 20000),
(2, 2, 'Beli keyboard', 'Selesai', '2026-04-16', 0),
(3, 3, 'ganti ram', 'Selesai', '2026-04-16', 25000),
(4, 1, 'ganti vga', 'Proses', '2026-04-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE `sparepart` (
  `id_sparepart` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `harga_beli` int DEFAULT NULL,
  `harga_jual` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sparepart`
--

INSERT INTO `sparepart` (`id_sparepart`, `nama`, `stok`, `harga_beli`, `harga_jual`) VALUES
(1, 'RAM 15GB', 3, 100000, 150000),
(2, 'ROM 260GB', 3, 50000, 70000),
(3, 'Keyboard', 1, 50000, 60000),
(4, 'VGA', 2, 160000, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` enum('admin','teknisi') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', '123', 'admin'),
(2, 'teknisi', '123', 'teknisi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_servis`
--
ALTER TABLE `detail_servis`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_servis` (`id_servis`),
  ADD KEY `id_sparepart` (`id_sparepart`);

--
-- Indexes for table `nota_pembayaran`
--
ALTER TABLE `nota_pembayaran`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_servis` (`id_servis`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `servis`
--
ALTER TABLE `servis`
  ADD PRIMARY KEY (`id_servis`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `sparepart`
--
ALTER TABLE `sparepart`
  ADD PRIMARY KEY (`id_sparepart`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_servis`
--
ALTER TABLE `detail_servis`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nota_pembayaran`
--
ALTER TABLE `nota_pembayaran`
  MODIFY `id_nota` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `servis`
--
ALTER TABLE `servis`
  MODIFY `id_servis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sparepart`
--
ALTER TABLE `sparepart`
  MODIFY `id_sparepart` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_servis`
--
ALTER TABLE `detail_servis`
  ADD CONSTRAINT `detail_servis_ibfk_1` FOREIGN KEY (`id_servis`) REFERENCES `servis` (`id_servis`),
  ADD CONSTRAINT `detail_servis_ibfk_2` FOREIGN KEY (`id_sparepart`) REFERENCES `sparepart` (`id_sparepart`);

--
-- Constraints for table `nota_pembayaran`
--
ALTER TABLE `nota_pembayaran`
  ADD CONSTRAINT `nota_pembayaran_ibfk_1` FOREIGN KEY (`id_servis`) REFERENCES `servis` (`id_servis`);

--
-- Constraints for table `servis`
--
ALTER TABLE `servis`
  ADD CONSTRAINT `servis_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
