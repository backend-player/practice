-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2022 at 05:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiket_bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_penumpang`
--

CREATE TABLE `data_penumpang` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(200) NOT NULL,
  `bus` varchar(200) NOT NULL,
  `kursi` int(11) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `tanggal_booking` datetime NOT NULL,
  `status_pembayaran` varchar(200) NOT NULL,
  `kode_pembayaran` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_penumpang`
--

INSERT INTO `data_penumpang` (`id`, `nama`, `nomor_hp`, `email`, `jenis_kelamin`, `bus`, `kursi`, `tanggal_berangkat`, `tanggal_booking`, `status_pembayaran`, `kode_pembayaran`) VALUES
(3, 'alpha', '08123456', 'alpha@a.com', 'laki-laki', 'bus-1', 1, '2022-07-01', '2022-07-01 23:06:23', 'batal', '900700fc94'),
(4, 'bravo', '08122222', 'bravo@gmail.com', 'laki-laki', 'bus-1', 2, '2022-07-01', '2022-07-01 23:30:55', 'batal', '88f58b6b51'),
(5, 'charlie', '0812333', 'charile@gmail.com', 'laki-laki', 'bus-1', 3, '2022-07-03', '2022-07-03 04:25:47', 'batal', '40d5185a27'),
(6, 'delta', '081234444', 'delta@gmail.com', 'perempuan', 'bus-1', 5, '2022-07-03', '2022-07-03 02:30:24', 'batal', 'b915538dbb'),
(8, 'edward', '0812345', 'edward@ed.com', 'laki-laki', 'bus-1', 8, '2022-07-03', '2022-07-03 03:18:22', 'batal', 'ee89bd749f'),
(9, 'fire', '08123456', 'fire@gm.com', 'perempuan', 'bus-1', 7, '2022-07-03', '2022-07-03 03:19:33', 'batal', '819baaa5da'),
(11, 'gon', '081234567', 'gon@yahoo.com', 'laki-laki', 'bus-1', 2, '2022-07-03', '2022-07-03 03:24:06', 'berhasil', '3d19b4d509'),
(12, 'asd', '1234', 'asd@gmail.com', 'laki-laki', 'bus-1', 1, '2022-07-29', '2022-07-29 21:17:15', 'menunggu', '0830014a4f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_penumpang`
--
ALTER TABLE `data_penumpang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_penumpang`
--
ALTER TABLE `data_penumpang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_status_booking_minibus` ON SCHEDULE EVERY 1 HOUR STARTS '2022-07-01 02:35:44' ENDS '2023-07-01 02:35:44' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE data_penumpang SET status_pembayaran = 'batal' WHERE status_pembayaran = 'menunggu'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
