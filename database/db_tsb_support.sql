-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2019 at 10:04 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tsb_support`
--

-- --------------------------------------------------------

--
-- Table structure for table `ms_user`
--

CREATE TABLE `ms_user` (
  `id_user` int(5) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_user`
--

INSERT INTO `ms_user` (`id_user`, `nama`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'password', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_schedule_cancel`
--

CREATE TABLE `tb_schedule_cancel` (
  `id` int(6) NOT NULL,
  `reason` text DEFAULT NULL,
  `request_by` varchar(50) DEFAULT NULL,
  `reason_time` datetime DEFAULT NULL,
  `receipt_number` varchar(50) DEFAULT NULL,
  `cancel_by` int(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(6) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_schedule_cancel`
--

INSERT INTO `tb_schedule_cancel` (`id`, `reason`, `request_by`, `reason_time`, `receipt_number`, `cancel_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Dikarenakan Adanya Jadwal yang tertumpuk', 'Anna', '2019-09-19 17:14:21', '9003-180919-01', 1, '2019-09-19 17:14:21', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_schedule_cancel`
--
ALTER TABLE `tb_schedule_cancel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_user`
--
ALTER TABLE `ms_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_schedule_cancel`
--
ALTER TABLE `tb_schedule_cancel`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
