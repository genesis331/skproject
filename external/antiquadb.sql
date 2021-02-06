-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2020 at 02:51 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antiquadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `alamat` varchar(750) NOT NULL,
  `negeri` varchar(750) NOT NULL,
  `poskod` varchar(5) NOT NULL,
  `bandar` varchar(750) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`alamat`, `negeri`, `poskod`, `bandar`) VALUES
('9, JALAN PELANGI, HILLSIDE', 'PULAU PINANG', '11200', 'TANJUNG BUNGAH');

-- --------------------------------------------------------

--
-- Table structure for table `antik`
--

CREATE TABLE `antik` (
  `idantik` varchar(9) NOT NULL,
  `namaantik` varchar(750) NOT NULL,
  `hargaantik` double NOT NULL,
  `penjelasanantik` text NOT NULL,
  `tempatasalantik` varchar(750) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antik`
--

INSERT INTO `antik` (`idantik`, `namaantik`, `hargaantik`, `penjelasanantik`, `tempatasalantik`, `status`) VALUES
('A01719810', 'THE BATTLE OF SAN ROMANO', 234000000, 'The Battle of San Romano is a set of three paintings by the Florentine painter Paolo Uccello depicting events that took place at the Battle of San Romano between Florentine and Sienese forces in 1432.', 'ITALI', 0),
('A06851260', 'THE TRIBUTE MONEY', 530000000, 'The Tribute Money is a fresco by the Italian Early Renaissance painter Masaccio, located in the Brancacci Chapel of the basilica of Santa Maria del Carmine, Florence.', 'ITALI', 0),
('A42778497', 'Nvidia RTX 2080 (year 2000)', 1300, 'RTX all the way from year 2000. Definitely not a scam.', 'Nvidia', 1),
('A60362042', 'THE MARRIAGE OF THE VIRGIN', 124000000, 'The Marriage of the Virgin, also known as Lo Sposalizio, is an oil painting by the Italian High Renaissance artist Raphael.', 'ITALI', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jualan`
--

CREATE TABLE `jualan` (
  `idjualan` varchar(6) NOT NULL,
  `jumlahjualan` double NOT NULL,
  `tarikhjualan` date NOT NULL,
  `idpembeli` varchar(6) NOT NULL,
  `idpekerja` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jualan`
--

INSERT INTO `jualan` (`idjualan`, `jumlahjualan`, `tarikhjualan`, `idpembeli`, `idpekerja`) VALUES
('R39158', 234000000, '2020-04-08', 'B72847', 'W50115'),
('R53960', 654000000, '2020-07-22', 'B72847', 'W97499');

-- --------------------------------------------------------

--
-- Table structure for table `pekerja`
--

CREATE TABLE `pekerja` (
  `idpekerja` varchar(6) NOT NULL,
  `namapekerja` varchar(750) NOT NULL,
  `notelefonpekerja` varchar(12) NOT NULL,
  `katalaluanpekerja` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerja`
--

INSERT INTO `pekerja` (`idpekerja`, `namapekerja`, `notelefonpekerja`, `katalaluanpekerja`, `status`) VALUES
('W50115', 'CHEAH ZIXU', '0182764331', '1234567', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `idpembeli` varchar(6) NOT NULL,
  `nokadicpembeli` varchar(12) NOT NULL,
  `notelefonpembeli` varchar(12) NOT NULL,
  `namapembeli` varchar(750) NOT NULL,
  `alamat` varchar(750) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`idpembeli`, `nokadicpembeli`, `notelefonpembeli`, `namapembeli`, `alamat`) VALUES
('B72847', '030331070597', '0182764331', 'CHEAH ZIXU', '9, JALAN PELANGI, HILLSIDE');

-- --------------------------------------------------------

--
-- Table structure for table `rekod`
--

CREATE TABLE `rekod` (
  `idrekod` int(255) NOT NULL,
  `idjualan` varchar(6) NOT NULL,
  `idantik` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekod`
--

INSERT INTO `rekod` (`idrekod`, `idjualan`, `idantik`) VALUES
(6, 'R39158', 'A01719810'),
(7, 'R53960', 'A60362042'),
(8, 'R53960', 'A06851260');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`alamat`);

--
-- Indexes for table `antik`
--
ALTER TABLE `antik`
  ADD PRIMARY KEY (`idantik`);

--
-- Indexes for table `jualan`
--
ALTER TABLE `jualan`
  ADD PRIMARY KEY (`idjualan`),
  ADD KEY `idpekerja` (`idpekerja`),
  ADD KEY `idpembeli` (`idpembeli`);

--
-- Indexes for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD PRIMARY KEY (`idpekerja`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`idpembeli`),
  ADD KEY `alamat` (`alamat`);

--
-- Indexes for table `rekod`
--
ALTER TABLE `rekod`
  ADD PRIMARY KEY (`idrekod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rekod`
--
ALTER TABLE `rekod`
  MODIFY `idrekod` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `jualan`
--
ALTER TABLE `jualan`
  ADD CONSTRAINT `jualan_ibfk_2` FOREIGN KEY (`idpembeli`) REFERENCES `pembeli` (`idpembeli`);

--
-- Constraints for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD CONSTRAINT `pembeli_ibfk_1` FOREIGN KEY (`alamat`) REFERENCES `alamat` (`alamat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
