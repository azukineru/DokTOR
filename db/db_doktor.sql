-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2017 at 05:41 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_doktor`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `no_dokumen` int(11) NOT NULL,
  `tanggal_dokumen` date NOT NULL,
  `cost_center` varchar(10) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `jenis_dokumen` varchar(20) NOT NULL,
  `program` varchar(300) NOT NULL,
  `file_torjustifikasi` varchar(100) DEFAULT NULL,
  `ext_torjustifikasi` varchar(10) DEFAULT NULL,
  `size_torjustifikasi` int(11) DEFAULT NULL,
  `file_pr` varchar(100) DEFAULT NULL,
  `ext_pr` varchar(10) DEFAULT NULL,
  `size_pr` int(11) DEFAULT NULL,
  `file_evaluasi` varchar(100) DEFAULT NULL,
  `ext_evaluasi` varchar(10) DEFAULT NULL,
  `size_evaluasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dokumentasi`
--

INSERT INTO `dokumentasi` (`no_dokumen`, `tanggal_dokumen`, `cost_center`, `unit`, `jenis_dokumen`, `program`, `file_torjustifikasi`, `ext_torjustifikasi`, `size_torjustifikasi`, `file_pr`, `ext_pr`, `size_pr`, `file_evaluasi`, `ext_evaluasi`, `size_evaluasi`) VALUES
(1, '2017-09-22', 'F3434', 'OPD', 'OPEX', '4343434343', '1-10216-3572011809930004.pdf', 'pdf', 97781, '1-AST-0169965_Anatomy-of-a-mobile-app-ebook.pdf', 'pdf', 2753006, '1-AST-0181451_Hitachi_CloudTransformation.pdf', 'pdf', 2158540);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `email`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin.doktor@telkom.co.id');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`no_dokumen`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `no_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
