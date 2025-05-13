-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 11:00 AM
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
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `Account_ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Access_Level` varchar(10) NOT NULL DEFAULT 'User',
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`Account_ID`, `Username`, `Email`, `Password`, `Access_Level`, `TimeStamp`) VALUES
(17, 'a1', 'a1@gmail.com', '$2y$10$1lw4SnH0.JpxB4yYO2YL8e5NXGPnEySA6b6istcoIdI.YUGn/9cTu', 'User', '2025-04-30 04:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_requirements`
--

CREATE TABLE `tbl_account_requirements` (
  `Account_Requirement_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Document_ID` int(11) NOT NULL,
  `File_ID` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Pending',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `Address_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `House_Number` int(4) NOT NULL,
  `Street_Address` varchar(50) NOT NULL,
  `Barangay` varchar(50) NOT NULL,
  `City_or_Municipality` varchar(50) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `Region` varchar(50) NOT NULL,
  `Zip_Code` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assistance`
--

CREATE TABLE `tbl_assistance` (
  `Assistance_ID` int(11) NOT NULL,
  `Assistance_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_assistance`
--

INSERT INTO `tbl_assistance` (`Assistance_ID`, `Assistance_Name`) VALUES
(1, 'Transportation Assistance'),
(2, 'Medical Assistance'),
(3, 'Burial Assistance'),
(4, 'Educational Assistance'),
(5, 'Food Assistance'),
(6, 'Cash Relief Assistance'),
(7, 'Psychosocial Support');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents`
--

CREATE TABLE `tbl_documents` (
  `Document_ID` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_documents`
--

INSERT INTO `tbl_documents` (`Document_ID`, `Description`) VALUES
(1, 'Updated Original Certificate of Indigency from Barangay proving financial incapacity'),
(2, 'Medical Certificate Referral'),
(3, 'Death Certificate or Medical Report'),
(4, 'Police or Legal Report or Social Worker’s Assessment'),
(5, 'Representative Valid ID'),
(6, 'Valid ID'),
(7, 'Birth or Marriage Certificate'),
(8, 'Medical Certificate or Clinical Abstract'),
(9, 'Hospital Billing Statement for Hospitalization or procedure'),
(10, 'Pharmacy Quotation for required medications'),
(11, 'Laboratory or Diagnostic request for test and imaging'),
(12, 'Official Receipt'),
(13, 'Certification of outstanding debts or Payable Obligations'),
(14, 'Funeral Contract'),
(15, 'Marriage Contract'),
(16, 'Authorization Letter'),
(17, 'Certified True Copy of Enrollment Assessment Form or Certificate of Enrollment'),
(18, 'School ID of the student or Beneficiary'),
(19, 'Certified True Copy of Grades signed by the authorized personnel'),
(20, 'Disaster or Emergency Certificate'),
(21, 'Incident Report from BFP, LGU or disaster response agency'),
(22, 'Referral Letter from Social Worker, Barangay Officer, or Mental Health Professional'),
(23, 'Medical or Psychological Report');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_family`
--

CREATE TABLE `tbl_family` (
  `Family_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Family_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

CREATE TABLE `tbl_files` (
  `File_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `File_Name` text NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requirements`
--

CREATE TABLE `tbl_requirements` (
  `Requirement_ID` int(11) NOT NULL,
  `Assistance_ID` int(11) NOT NULL,
  `Document_ID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Importance` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_requirements`
--

INSERT INTO `tbl_requirements` (`Requirement_ID`, `Assistance_ID`, `Document_ID`, `Description`, `Importance`) VALUES
(1, 1, 1, 'Updated Original Certificate of Indigency from Barangay proving financial incapacity', 'Required'),
(2, 1, 2, 'Medical Certificate referral', 'Required'),
(3, 1, 3, 'Death Certificate or Medical report', 'Required'),
(4, 1, 4, 'Police Report', 'Required'),
(5, 1, 5, 'Representative Valid ID', 'Required'),
(6, 1, 6, 'Patient ID', 'Required'),
(7, 1, 7, 'Birth or Marriage Certificate', 'Required'),
(8, 2, 1, 'Updated Original Certificate of Indigency from Barangay proving financial incapacity', 'Required'),
(9, 2, 8, 'Medical Certificate or Clinical Abstract', 'Required'),
(10, 2, 9, 'Hospital Billing Statement for Hospitalization or procedure', 'Required'),
(11, 2, 10, 'Pharmacy Quotation for required medications', 'Required'),
(12, 2, 11, 'Laboratory or Diagnostic request for test and imaging', 'Required'),
(13, 2, 12, 'Official Receipt', 'Required'),
(14, 2, 13, 'Certification of outstanding debts or Payable Obligations', 'Required'),
(15, 2, 5, 'Representative Valid ID', 'Required'),
(16, 2, 6, 'Patient ID', 'Required'),
(17, 2, 7, 'Birth or Marriage Certificate', 'Required'),
(18, 3, 1, 'Updated Original Certificate of Indigency from Barangay proving financial incapacity', 'Required'),
(19, 3, 3, 'Death Certificate ', 'Required'),
(20, 3, 14, 'Funeral Contract', 'Required'),
(21, 3, 12, 'Official Receipt', 'Required'),
(22, 3, 5, 'Representative Valid ID', 'Required'),
(23, 3, 6, 'ID of Expired Person', 'Required'),
(24, 3, 7, 'Birth or Marriage Certificate', 'Required'),
(25, 3, 15, 'Marriage Contract', 'Required'),
(26, 3, 16, 'Authorization Letter', 'Required'),
(27, 3, 13, 'Certification of Outstanding Debts or Payable Obligations', 'Required'),
(28, 4, 1, 'Updated Original Certificate of Indigency from Barangay proving financial incapacity', 'Required'),
(29, 4, 17, 'Certified True Copy of Enrollment Assessment Form or Certificate of Enrollment', 'Required'),
(30, 4, 18, 'School ID of the student/ Beneficiary', 'Required'),
(31, 4, 19, 'Certified True Copy of Grades signed by the authorized personnel ', 'Required'),
(32, 4, 8, 'Medical Certificate', 'Optional'),
(33, 4, 4, 'Police Report or Social Worker’s Assessment', 'Required'),
(34, 5, 1, 'Updated Original Certificate of Indigency from Barangay with proof of low income', 'Required'),
(35, 5, 6, 'Valid ID', 'Required'),
(36, 5, 7, 'Birth or Marriage Certificate', 'Required'),
(37, 5, 20, 'Disaster Certificate', 'Optional'),
(38, 5, 8, 'Medical Certificate or Referral', 'Optional'),
(39, 6, 1, 'Updated Original Certificate of Indigency from Barangay with proof of low income', 'Required'),
(40, 6, 6, 'Valid ID', 'Required'),
(41, 6, 7, 'Birth or Marriage Certificate', 'Required'),
(42, 6, 21, 'Incident Report from BFP, LGU or disaster response agency', 'Required'),
(43, 6, 8, 'Medical Certificate or Referral', 'Optional'),
(44, 7, 1, 'Updated Original Certificate of Indigency from Barangay with proof of low income', 'Required'),
(45, 7, 6, 'Valid ID', 'Required'),
(46, 7, 7, 'Birth or Marriage Certificate', 'Required'),
(47, 7, 22, 'Referral Letter from Social Worker, Barangay Officer, or Mental Health Professional', 'Required'),
(48, 7, 23, 'Medical or Psychological Report', 'Optional'),
(49, 7, 4, 'Police or Legal Report', 'Optional'),
(50, 7, 20, 'Disaster or Emergency Certificate', 'Optional');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`Account_ID`);

--
-- Indexes for table `tbl_account_requirements`
--
ALTER TABLE `tbl_account_requirements`
  ADD PRIMARY KEY (`Account_Requirement_ID`),
  ADD KEY `AR>Accounts` (`Account_ID`),
  ADD KEY `AR>Files` (`File_ID`),
  ADD KEY `AR>Documents` (`Document_ID`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`Address_ID`),
  ADD KEY `Account>Address` (`Account_ID`);

--
-- Indexes for table `tbl_assistance`
--
ALTER TABLE `tbl_assistance`
  ADD PRIMARY KEY (`Assistance_ID`);

--
-- Indexes for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  ADD PRIMARY KEY (`Document_ID`);

--
-- Indexes for table `tbl_family`
--
ALTER TABLE `tbl_family`
  ADD PRIMARY KEY (`Family_ID`),
  ADD KEY `Account>Family` (`Account_ID`);

--
-- Indexes for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`File_ID`),
  ADD KEY `Files>Accounts` (`Account_ID`);

--
-- Indexes for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  ADD PRIMARY KEY (`Requirement_ID`),
  ADD KEY `Documents>Requirements` (`Document_ID`),
  ADD KEY `Assistance>Requirements` (`Assistance_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `Account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_account_requirements`
--
ALTER TABLE `tbl_account_requirements`
  MODIFY `Account_Requirement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `Address_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_assistance`
--
ALTER TABLE `tbl_assistance`
  MODIFY `Assistance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  MODIFY `Document_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_family`
--
ALTER TABLE `tbl_family`
  MODIFY `Family_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `File_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  MODIFY `Requirement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_account_requirements`
--
ALTER TABLE `tbl_account_requirements`
  ADD CONSTRAINT `AR>Accounts` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`),
  ADD CONSTRAINT `AR>Documents` FOREIGN KEY (`Document_ID`) REFERENCES `tbl_documents` (`Document_ID`),
  ADD CONSTRAINT `AR>Files` FOREIGN KEY (`File_ID`) REFERENCES `tbl_files` (`File_ID`);

--
-- Constraints for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD CONSTRAINT `Account>Address` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`);

--
-- Constraints for table `tbl_family`
--
ALTER TABLE `tbl_family`
  ADD CONSTRAINT `Account>Family` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`);

--
-- Constraints for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD CONSTRAINT `Files>Accounts` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`);

--
-- Constraints for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  ADD CONSTRAINT `Assistance>Requirements` FOREIGN KEY (`Assistance_ID`) REFERENCES `tbl_assistance` (`Assistance_ID`),
  ADD CONSTRAINT `Documents>Requirements` FOREIGN KEY (`Document_ID`) REFERENCES `tbl_documents` (`Document_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
