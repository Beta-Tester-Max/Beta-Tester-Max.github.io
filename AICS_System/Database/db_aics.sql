-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 08:22 AM
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
-- Table structure for table `tbl_a`
--

CREATE TABLE `tbl_a` (
  `id` int(2) NOT NULL,
  `aC` char(5) NOT NULL,
  `aN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_a`
--

INSERT INTO `tbl_a` (`id`, `aC`, `aN`) VALUES
(1, 'TA', 'Transportation Assistance'),
(2, 'MA', 'Medical Assistance'),
(3, 'BA', 'Burial Assistance'),
(4, 'EA', 'Educational Assistance'),
(5, 'FA', 'Food Assistance'),
(6, 'CRA', 'Cash Relief Assistance'),
(7, 'PS', 'Psychosocial Support');

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
  `is_pwd` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cn`
--

CREATE TABLE `tbl_cn` (
  `id` int(5) NOT NULL,
  `c` int(5) NOT NULL,
  `cn` varchar(13) NOT NULL DEFAULT '0XXX-XXX-XXXX'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cs`
--

CREATE TABLE `tbl_cs` (
  `id` int(11) NOT NULL,
  `cSName` varchar(50) NOT NULL,
  `form_I` tinyint(1) DEFAULT 0,
  `r` int(5) DEFAULT NULL,
  `b` char(5) DEFAULT NULL,
  `form_II` tinyint(1) DEFAULT 0,
  `form_III` text DEFAULT NULL,
  `form_IV` text DEFAULT NULL,
  `form_V` text DEFAULT NULL,
  `asType` char(5) DEFAULT NULL,
  `cost` decimal(11,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Ongoing',
  `tS` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `tbl_family`
--

CREATE TABLE `tbl_family` (
  `id` int(5) NOT NULL,
  `Family_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_r`
--

CREATE TABLE `tbl_r` (
  `id` int(2) NOT NULL,
  `rC` char(5) NOT NULL,
  `rN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_r`
--

INSERT INTO `tbl_r` (`id`, `rC`, `rN`) VALUES
(1, 'S', 'Son'),
(2, 'D', 'Daughter'),
(3, 'SI', 'Sister'),
(4, 'BR', 'Brother'),
(5, 'GS', 'Grandson'),
(6, 'GD', 'Granddaughter'),
(7, 'M', 'Mother'),
(8, 'F', 'Father'),
(9, 'GF', 'Grandfather'),
(10, 'GM', 'Grandmother'),
(11, 'SP', 'Spouse'),
(12, 'LIP', 'Live-in Partner'),
(13, 'R', 'Relative');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rel`
--

CREATE TABLE `tbl_rel` (
  `id` int(5) NOT NULL,
  `Family_ID` int(5) NOT NULL,
  `findiv` int(5) NOT NULL,
  `sindiv` int(5) NOT NULL,
  `relation` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `tbl_a`
--
ALTER TABLE `tbl_a`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aC` (`aC`);

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
-- Indexes for table `tbl_cn`
--
ALTER TABLE `tbl_cn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_from_tbl_c` (`c`);

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
-- Indexes for table `tbl_family`
--
ALTER TABLE `tbl_family`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_r`
--
ALTER TABLE `tbl_r`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rC` (`rC`);

--
-- Indexes for table `tbl_rel`
--
ALTER TABLE `tbl_rel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `findiv_from_tbl_c` (`findiv`),
  ADD KEY `sindiv_from_tbl_c` (`sindiv`),
  ADD KEY `relation_from_tbl_r` (`relation`),
  ADD KEY `familyID_from_tbl_family` (`Family_ID`);

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
-- AUTO_INCREMENT for table `tbl_a`
--
ALTER TABLE `tbl_a`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_b`
--
ALTER TABLE `tbl_b`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_c`
--
ALTER TABLE `tbl_c`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_cn`
--
ALTER TABLE `tbl_cn`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cs`
--
ALTER TABLE `tbl_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `tbl_family`
--
ALTER TABLE `tbl_family`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_r`
--
ALTER TABLE `tbl_r`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_rel`
--
ALTER TABLE `tbl_rel`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `tbl_cn`
--
ALTER TABLE `tbl_cn`
  ADD CONSTRAINT `c_from_tbl_c` FOREIGN KEY (`c`) REFERENCES `tbl_c` (`id`);

--
-- Constraints for table `tbl_cs`
--
ALTER TABLE `tbl_cs`
  ADD CONSTRAINT `b_from_tbl_b(bC)` FOREIGN KEY (`b`) REFERENCES `tbl_b` (`bC`),
  ADD CONSTRAINT `r_from_tbl_c` FOREIGN KEY (`r`) REFERENCES `tbl_c` (`id`);

--
-- Constraints for table `tbl_rel`
--
ALTER TABLE `tbl_rel`
  ADD CONSTRAINT `familyID_from_tbl_family` FOREIGN KEY (`Family_ID`) REFERENCES `tbl_family` (`id`),
  ADD CONSTRAINT `findiv_from_tbl_c` FOREIGN KEY (`findiv`) REFERENCES `tbl_c` (`id`),
  ADD CONSTRAINT `relation_from_tbl_r` FOREIGN KEY (`relation`) REFERENCES `tbl_r` (`rC`),
  ADD CONSTRAINT `sindiv_from_tbl_c` FOREIGN KEY (`sindiv`) REFERENCES `tbl_c` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
