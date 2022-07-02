-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2022 at 06:05 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `id` int(11) NOT NULL,
  `nama_diagnosa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`id`, `nama_diagnosa`) VALUES
(1, 'migren');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `harga` double NOT NULL,
  `stok` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `harga`, `stok`, `jenis`) VALUES
(1, 'paracetamol', 10000, '35', 'tablet'),
(2, 'amoksilin', 5000, '23', 'tablet');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `umur` int(11) NOT NULL,
  `no_telepon` varchar(200) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `no_ktp` varchar(200) NOT NULL,
  `no_bpjs` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_pasien`, `alamat`, `umur`, `no_telepon`, `jk`, `no_ktp`, `no_bpjs`) VALUES
(1, 'Fajrul Edit', 'Tanjung Sari', 21, '08933423', 'L', '09993953', '00932324');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `no_pemeriksaan` varchar(200) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keluhan` text NOT NULL,
  `id_diagnosa` int(11) NOT NULL,
  `harga` double NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`no_pemeriksaan`, `id_pasien`, `tanggal`, `keluhan`, `id_diagnosa`, `harga`, `id`) VALUES
('001', 1, '2022-02-01', 'nyeri kepala', 1, 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `no_rm` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `no_pemeriksaan` varchar(100) NOT NULL,
  `rincian_biaya` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`no_rm`, `id_pasien`, `no_pemeriksaan`, `rincian_biaya`) VALUES
(1, 1, '001', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `no_resep` int(11) NOT NULL,
  `no_pemeriksaan` varchar(200) NOT NULL,
  `id` int(11) NOT NULL,
  `jumlah` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`no_resep`, `no_pemeriksaan`, `id`, `jumlah`) VALUES
(1, '001', 2, '5'),
(2, '001', 1, '10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('admin','dokter','apoteker') NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `level`, `nama`) VALUES
(1, 'sadam@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'admin', 'sadam'),
(2, 'apoteker@apoteker', '$2y$10$f3Pkiw72RT6j8Vd6pUhgQ.mGMk96JNbO7JYpau6dBC3necDgFO2Si', 'apoteker', 'apoteker'),
(3, 'lala@gmail.com', '$2y$10$bWOF1R./rooGJ8uhCbR78OCAcqJEXfI1dwsexTt1TWzwuWKX/8AR6', 'dokter', 'Lala'),
(5, 'edit@edit', '$2y$10$hS53XZcaqHQI.rmPpu3oX.f7gGEspTWtlXvhhGoyR5Q6QVESPAmT.', 'dokter', 'tambah Data');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`no_pemeriksaan`),
  ADD KEY `id_pasien` (`id_pasien`,`id_diagnosa`,`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_diagnosa` (`id_diagnosa`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`no_rm`),
  ADD KEY `id_pasien` (`id_pasien`,`no_pemeriksaan`),
  ADD KEY `no_pemeriksaan` (`no_pemeriksaan`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`no_resep`),
  ADD KEY `no_pemeriksaan` (`no_pemeriksaan`,`id`),
  ADD KEY `id_obat` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `no_rm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `no_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pemeriksaan_ibfk_3` FOREIGN KEY (`id_diagnosa`) REFERENCES `diagnosa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rekam_medis_ibfk_2` FOREIGN KEY (`no_pemeriksaan`) REFERENCES `pemeriksaan` (`no_pemeriksaan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`no_pemeriksaan`) REFERENCES `pemeriksaan` (`no_pemeriksaan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`id`) REFERENCES `obat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
