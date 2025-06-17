-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 10:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aics`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_b`
--

CREATE TABLE `tbl_b` (
  `id` int(2) NOT NULL,
  `bC` char(5) NOT NULL,
  `bN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_b`
--

INSERT INTO `tbl_b` (`id`, `bC`, `bN`) VALUES
(1, 'BIP', 'Barangay I (Poblacion)'),
(2, 'BIIP', 'Barangay II (Poblacion)'),
(3, 'BIIIP', 'Barangay III (Poblacion)'),
(4, 'BIVP', 'Barangay IV (Poblacion)'),
(5, 'DC', 'Del Carmen'),
(6, 'P', 'Palma'),
(7, 'SAA', 'San Agustin (Antipolo)'),
(8, 'SA', 'San Andres'),
(9, 'SBP', 'San Benito (Palita)'),
(10, 'SG', 'San Gregorio'),
(11, 'SI', 'San Ildefonso'),
(12, 'SJ', 'San Juan'),
(13, 'SM', 'San Miguel'),
(14, 'SR', 'San Roque'),
(15, 'STR', 'Santa Rosa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_c`
--

CREATE TABLE `tbl_c` (
  `id` int(5) NOT NULL,
  `fN` varchar(50) NOT NULL,
  `mN` varchar(50) DEFAULT NULL,
  `lN` varchar(50) NOT NULL,
  `dB` date NOT NULL,
  `s` char(5) NOT NULL,
  `cS` char(5) NOT NULL,
  `eA` char(5) DEFAULT 'N/A',
  `o` varchar(50) DEFAULT 'None',
  `cN` varchar(13) NOT NULL DEFAULT '0000-000-0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_c`
--

INSERT INTO `tbl_c` (`id`, `fN`, `mN`, `lN`, `dB`, `s`, `cS`, `eA`, `o`, `cN`) VALUES
(1, 'Admin', '', 'Owner', '2025-06-02', 'M', 'S', 'CG', '', '0999-999-9999'),
(2, 'Admin', '', 'Owner', '2025-06-02', 'M', 'S', 'CG', '', '0999-999-9999'),
(3, 'Admin', '', 'Owner', '2025-06-03', 'M', 'S', NULL, '', '0999-999-9999');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cs`
--

CREATE TABLE `tbl_cs` (
  `id` int(11) NOT NULL,
  `r` int(5) NOT NULL,
  `b` char(5) NOT NULL,
  `tS` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cs`
--

INSERT INTO `tbl_cs` (`id`, `r`, `b`, `tS`) VALUES
(1, 1, 'BIP', '2025-06-17 07:25:51'),
(2, 2, 'BIP', '2025-06-17 07:29:15'),
(3, 3, 'BIP', '2025-06-17 08:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cvs`
--

CREATE TABLE `tbl_cvs` (
  `id` int(11) NOT NULL,
  `cSC` char(5) NOT NULL,
  `cSN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cvs`
--

INSERT INTO `tbl_cvs` (`id`, `cSC`, `cSN`) VALUES
(1, 'S', 'Single'),
(2, 'M', 'Married'),
(3, 'D', 'Divorced'),
(4, 'SP', 'Separated'),
(5, 'W', 'Widowed'),
(6, 'CL', 'Common Law');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ea`
--

CREATE TABLE `tbl_ea` (
  `id` int(11) NOT NULL,
  `eAC` char(5) NOT NULL,
  `eAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ea`
--

INSERT INTO `tbl_ea` (`id`, `eAC`, `eAN`) VALUES
(1, 'CG', 'College Graduate'),
(2, 'CU', 'College Undergraduate'),
(3, 'SHSG', 'Senior High School Graduate'),
(4, 'SHSU', 'Senior High School Undergraduate'),
(5, 'JHSG', 'Junior High School Graduate'),
(6, 'JHSU', 'Junior High School Undergraduate'),
(7, 'EG', 'Elementary Graduate'),
(8, 'U', 'Undergraduate'),
(9, 'N/A', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sx`
--

CREATE TABLE `tbl_sx` (
  `id` int(2) NOT NULL,
  `sC` char(5) NOT NULL,
  `sN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sx`
--

INSERT INTO `tbl_sx` (`id`, `sC`, `sN`) VALUES
(1, 'M', 'Male'),
(2, 'F', 'Female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_b`
--
ALTER TABLE `tbl_b`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bC` (`bC`);

--
-- Indexes for table `tbl_c`
--
ALTER TABLE `tbl_c`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_from_tbl_sx(sC)` (`s`),
  ADD KEY `cS_from_tbl_cvs(cSC)` (`cS`),
  ADD KEY `eA_from_tbl_ea(eAC)_nullable` (`eA`);

--
-- Indexes for table `tbl_cs`
--
ALTER TABLE `tbl_cs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_from_tbl_c` (`r`),
  ADD KEY `b_from_tbl_b(bC)` (`b`);

--
-- Indexes for table `tbl_cvs`
--
ALTER TABLE `tbl_cvs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cSC` (`cSC`);

--
-- Indexes for table `tbl_ea`
--
ALTER TABLE `tbl_ea`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eAC` (`eAC`);

--
-- Indexes for table `tbl_sx`
--
ALTER TABLE `tbl_sx`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sC` (`sC`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_b`
--
ALTER TABLE `tbl_b`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_c`
--
ALTER TABLE `tbl_c`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cs`
--
ALTER TABLE `tbl_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cvs`
--
ALTER TABLE `tbl_cvs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_ea`
--
ALTER TABLE `tbl_ea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_sx`
--
ALTER TABLE `tbl_sx`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_c`
--
ALTER TABLE `tbl_c`
  ADD CONSTRAINT `cS_from_tbl_cvs(cSC)` FOREIGN KEY (`cS`) REFERENCES `tbl_cvs` (`cSC`),
  ADD CONSTRAINT `eA_from_tbl_ea(eAC)_nullable` FOREIGN KEY (`eA`) REFERENCES `tbl_ea` (`eAC`),
  ADD CONSTRAINT `s_from_tbl_sx(sC)` FOREIGN KEY (`s`) REFERENCES `tbl_sx` (`sC`);

--
-- Constraints for table `tbl_cs`
--
ALTER TABLE `tbl_cs`
  ADD CONSTRAINT `b_from_tbl_b(bC)` FOREIGN KEY (`b`) REFERENCES `tbl_b` (`bC`),
  ADD CONSTRAINT `r_from_tbl_c` FOREIGN KEY (`r`) REFERENCES `tbl_c` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
