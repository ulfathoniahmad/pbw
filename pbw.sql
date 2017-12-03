-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2017 at 02:58 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbw`
--
CREATE DATABASE IF NOT EXISTS `pbw` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pbw`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `idAdmin` int(2) NOT NULL,
  `admin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `admin`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `idKelas` int(2) NOT NULL,
  `namaKelas` varchar(10) NOT NULL,
  `jumlahSiswa` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`idKelas`, `namaKelas`, `jumlahSiswa`) VALUES
(1, '10-IPA1', 0),
(2, '10-IPA2', 0),
(3, '10-IPA3', 0),
(4, '10-IPS1', 0),
(5, '10-IPS2', 0),
(6, '10-IPS3', 0),
(7, '11-IPA1', 0),
(8, '11-IPA2', 0),
(9, '11-IPA3', 0),
(10, '11-IPS1', 0),
(11, '11-IPS2', 0),
(12, '11-IPS3', 0),
(13, '12-IPA1', 0),
(14, '12-IPA2', 0),
(15, '12-IPA3', 0),
(16, '12-IPS1', 0),
(17, '12-IPS2', 0),
(18, '12-IPS3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ortu`
--

DROP TABLE IF EXISTS `ortu`;
CREATE TABLE `ortu` (
  `NIS` int(5) NOT NULL,
  `namaOrtu` varchar(25) NOT NULL,
  `pekerjaan` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `teleponOrtu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ortu`
--

INSERT INTO `ortu` (`NIS`, `namaOrtu`, `pekerjaan`, `alamat`, `teleponOrtu`) VALUES
(15001, 'Parmadi', 'Petani', 'Ds. Munggung, Kec. Pulung, Kab. Ponorogo', '085733919340'),
(15002, 'Evan', 'Gamers', 'Ds. Singgahan, Kec. Pulung, Kab. Ponorogo', '085331209500');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `NIS` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tempatLahir` varchar(20) NOT NULL,
  `tglLahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`NIS`, `nama`, `kelamin`, `tempatLahir`, `tglLahir`) VALUES
(15001, 'Ahmad Ulfathoni', 'Laki-Laki', 'Ponorogo', '1997-07-28'),
(15002, 'Laili Daviatin', 'Perempuan', 'Ponorogo', '1997-02-07'),
(15003, 'Ika Maharani Pertiwi', 'Perempuan', 'Malang', '1997-06-10'),
(15004, 'Aditya Nur Yafie', 'Laki-Laki', 'Sumedang', '1997-03-29'),
(15006, 'Thomas Aquinas Candra D', 'Laki-Laki', 'Ponorogo', '1996-09-01'),
(15007, 'Dimas Gustryawiyoga', 'Laki-Laki', 'Ponorogo', '1996-08-17'),
(15008, 'Ananda Desta Maharani', 'Perempuan', 'Ponorogo', '1997-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` enum('admin','guru','siswa','ortu') NOT NULL,
  `id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idKelas`);

--
-- Indexes for table `ortu`
--
ALTER TABLE `ortu`
  ADD PRIMARY KEY (`NIS`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`NIS`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idKelas` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `NIS` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15009;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ortu`
--
ALTER TABLE `ortu`
  ADD CONSTRAINT `ortu_ibfk_1` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
