-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 11:04 AM
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
-- Table structure for table `tbl_access_control`
--

CREATE TABLE `tbl_access_control` (
  `Access_ID` int(11) NOT NULL,
  `Access_Level` varchar(50) NOT NULL,
  `Access` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_access_control`
--

INSERT INTO `tbl_access_control` (`Access_ID`, `Access_Level`, `Access`) VALUES
(1, 'Owner', '1, 1');

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
(1, 'Admin', '', '$2y$10$4EQwJIARDJjkesvHLmygse552iZeBpa8lF.2UVxpScgABFslgE9D2', 'Admin', '0000-00-00 00:00:00'),
(24, 'aa1', '1234@gmail.com', '$2y$10$BK8n9P7/Li0S8sPcWtNhp.WlhUFJqSNhuC.TNXPcDTmB7WQUVjLnq', 'User', '2025-05-22 07:02:45'),
(26, 'aa2', 'Testacc@gmail.com', '$2y$10$wuNiXIGQjvRVq0AfnwRNAukE.XY0I.FOzDqDWWcIhWQkd0TblfTim', 'User', '2025-05-27 02:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `Address_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `House_Number` int(4) NOT NULL,
  `Street_Name` varchar(50) NOT NULL,
  `Barangay` varchar(50) NOT NULL,
  `City_or_Municipality` varchar(50) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `Region` varchar(50) NOT NULL,
  `Zip_Code` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`Address_ID`, `Account_ID`, `House_Number`, `Street_Name`, `Barangay`, `City_or_Municipality`, `Province`, `Region`, `Zip_Code`) VALUES
(10, 24, 229, 'Fake Street', 'San Fake', 'Alaminos', 'Laguna', '4A', 4001),
(11, 26, 300, 'Purok 2', 'San Juan', 'Alaminos', 'Laguna', '4A', 4001);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_info`
--

CREATE TABLE `tbl_admin_info` (
  `Admin_ID` int(11) NOT NULL,
  `Token_ID` int(11) NOT NULL,
  `Access_ID` int(11) DEFAULT NULL,
  `Admin_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_info`
--

INSERT INTO `tbl_admin_info` (`Admin_ID`, `Token_ID`, `Access_ID`, `Admin_Name`) VALUES
(1, 2, 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_token`
--

CREATE TABLE `tbl_admin_token` (
  `Token_ID` int(11) NOT NULL,
  `Key` varchar(255) NOT NULL,
  `Token` varchar(255) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_token`
--

INSERT INTO `tbl_admin_token` (`Token_ID`, `Key`, `Token`, `TimeStamp`) VALUES
(2, '4689ddK2E5', '$2y$10$p55B/NbT5qjAWCAauTo1hOjRFqntB9YL7ilKwRoHv3gkHhUWRKUPO', '2025-05-22 07:35:22'),
(3, '33fc17EK15', '$2y$10$1kUwROrgl2CLBi/C2TAzde6C11XFYhAh5FGNCPIA0bmkQXBtaYX3O', '2025-05-22 07:37:29'),
(4, 'c4EK51dadb', '$2y$10$vuhdvO07S7uuHQQ54EK6ce2rCIZ9kbPTvHE7hBrajd.Axvkw6zD3m', '2025-05-28 03:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applications`
--

CREATE TABLE `tbl_applications` (
  `Application_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Assistance_ID` int(11) NOT NULL,
  `Beneficiary` int(11) NOT NULL,
  `Representative` int(11) DEFAULT NULL,
  `Severity` int(11) NOT NULL,
  `Reason` text DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Pending',
  `Date_Submitted` timestamp NOT NULL DEFAULT current_timestamp(),
  `ReasonFR` text DEFAULT NULL,
  `Date_Reviewed` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Files` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_applications`
--

INSERT INTO `tbl_applications` (`Application_ID`, `Account_ID`, `Assistance_ID`, `Beneficiary`, `Representative`, `Severity`, `Reason`, `Status`, `Date_Submitted`, `ReasonFR`, `Date_Reviewed`, `Files`, `is_deleted`) VALUES
(10021, 24, 5, 18, 18, 9, 'Need Food Assistance', 'Pending', '2025-05-22 07:55:34', NULL, '2025-05-22 07:59:24', '95, 96, 97', 1),
(10022, 24, 1, 18, 18, 1, 'zxczxczxcddawdsd', 'Approved', '2025-05-22 07:57:24', NULL, '2025-05-28 02:35:51', '98, 99, 100, 101, 102, 103, 104', 0),
(10023, 24, 4, 18, 18, 8, 'dfffsdfdsfdsfdfs', 'Rejected', '2025-05-22 08:01:59', 'Not Good Enough', '2025-05-28 03:09:53', '105, 106, 107, 108, 109', 0),
(10024, 24, 5, 18, 18, 9, 'asjdliaskjldas', 'Pending', '2025-05-22 08:06:16', NULL, '2025-05-27 04:58:33', '110, 111, 112', 1),
(10025, 26, 5, 19, 19, 9, 'I\'m Hungry', 'Pending', '2025-05-27 02:55:59', NULL, NULL, '113, 114, 115', 0),
(10026, 26, 6, 19, 19, 10, 'I need money', 'Pending', '2025-05-27 02:58:40', NULL, NULL, '116, 117, 118, 119', 0),
(10027, 24, 5, 18, 18, 9, 'I\'m Hungry', 'Pending', '2025-05-27 04:59:17', NULL, NULL, '120, 121, 122', 0);

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
-- Table structure for table `tbl_availability`
--

CREATE TABLE `tbl_availability` (
  `Availability_ID` int(11) NOT NULL,
  `Availability_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_availability`
--

INSERT INTO `tbl_availability` (`Availability_ID`, `Availability_Name`) VALUES
(1, 'Always'),
(2, 'Daily'),
(3, 'Weekly'),
(4, 'Monthly'),
(5, 'Quarterly'),
(6, 'Semi-Annually'),
(7, 'Annually'),
(8, 'Per-Semester'),
(9, 'Per-School-Year');

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
(23, 'Medical or Psychological Report'),
(38, 'Tax Certificate');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_family`
--

CREATE TABLE `tbl_family` (
  `Family_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Family_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_family`
--

INSERT INTO `tbl_family` (`Family_ID`, `Account_ID`, `Family_Name`) VALUES
(10, 24, 'Cruz'),
(11, 26, 'Doe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_family_composition`
--

CREATE TABLE `tbl_family_composition` (
  `Family_Composition_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Family_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_family_composition`
--

INSERT INTO `tbl_family_composition` (`Family_Composition_ID`, `Account_ID`, `Family_ID`, `User_ID`) VALUES
(9, 24, 10, 18),
(10, 26, 11, 19),
(11, 24, 10, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_family_member`
--

CREATE TABLE `tbl_family_member` (
  `User_ID` int(11) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Middle_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone_Number` varchar(13) DEFAULT '0000-000-0000',
  `Birth_Day` date NOT NULL,
  `Sex` varchar(50) NOT NULL,
  `Civil_Status` varchar(50) NOT NULL,
  `Educational_Attainment` varchar(50) DEFAULT 'N/A',
  `Occupation` varchar(50) DEFAULT 'N/A',
  `TimeStamp` timestamp NULL DEFAULT current_timestamp(),
  `is_deceased` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_family_member`
--

INSERT INTO `tbl_family_member` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Email`, `Phone_Number`, `Birth_Day`, `Sex`, `Civil_Status`, `Educational_Attainment`, `Occupation`, `TimeStamp`, `is_deceased`) VALUES
(18, 'John', 'Diaz', 'Doe', 'jd@gmail.com', '0999-999-9999', '2000-02-24', 'm', 'Single', '', '', '2025-05-22 07:54:39', 0),
(19, 'John', '', 'Doe', 'jduser@gmail.com', '0888-888-8888', '1992-08-26', 'm', 'Single', '', '', '2025-05-27 02:32:59', 0),
(20, 'Jane', 'Dhana', 'Doe', '', '', '2025-05-22', 'f', 'Single', '', '', '2025-05-28 05:48:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedbacks`
--

CREATE TABLE `tbl_feedbacks` (
  `Feedback_ID` int(11) NOT NULL,
  `Message` text NOT NULL,
  `Rating` tinyint(1) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

CREATE TABLE `tbl_files` (
  `File_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Requirement_ID` int(11) NOT NULL,
  `File_Name` text NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_files`
--

INSERT INTO `tbl_files` (`File_ID`, `Account_ID`, `Requirement_ID`, `File_Name`, `TimeStamp`, `is_deleted`) VALUES
(95, 24, 34, 'deleted_95_24_34.pdf', '2025-05-22 07:55:34', 1),
(96, 24, 35, 'deleted_96_24_35.pdf', '2025-05-22 07:55:34', 1),
(97, 24, 36, 'deleted_97_24_36.pdf', '2025-05-22 07:55:34', 1),
(98, 24, 1, '24_1.pdf', '2025-05-22 07:57:24', 0),
(99, 24, 2, '24_2.pdf', '2025-05-22 07:57:24', 0),
(100, 24, 3, '24_3.pdf', '2025-05-22 07:57:24', 0),
(101, 24, 4, '24_4.pdf', '2025-05-22 07:57:24', 0),
(102, 24, 5, '24_5.pdf', '2025-05-22 07:57:24', 0),
(103, 24, 6, '24_6.pdf', '2025-05-22 07:57:24', 0),
(104, 24, 7, '24_7.pdf', '2025-05-22 07:57:24', 0),
(105, 24, 28, '24_28.pdf', '2025-05-22 08:01:59', 0),
(106, 24, 29, '24_29.pdf', '2025-05-22 08:01:59', 0),
(107, 24, 30, '24_30.pdf', '2025-05-22 08:01:59', 0),
(108, 24, 31, '24_31.pdf', '2025-05-22 08:01:59', 0),
(109, 24, 33, '24_33.pdf', '2025-05-22 08:01:59', 0),
(110, 24, 34, 'deleted_110_24_34.pdf', '2025-05-22 08:06:16', 1),
(111, 24, 35, 'deleted_111_24_35.pdf', '2025-05-22 08:06:16', 1),
(112, 24, 36, 'deleted_112_24_36.pdf', '2025-05-22 08:06:16', 1),
(113, 26, 34, '26_34.pdf', '2025-05-27 02:55:59', 0),
(114, 26, 35, '26_35.pdf', '2025-05-27 02:55:59', 0),
(115, 26, 36, '26_36.pdf', '2025-05-27 02:55:59', 0),
(116, 26, 39, '26_39.pdf', '2025-05-27 02:58:40', 0),
(117, 26, 40, '26_40.pdf', '2025-05-27 02:58:40', 0),
(118, 26, 41, '26_41.pdf', '2025-05-27 02:58:40', 0),
(119, 26, 42, '26_42.pdf', '2025-05-27 02:58:40', 0),
(120, 24, 34, '24_34.pdf', '2025-05-27 04:59:16', 0),
(121, 24, 35, '24_35.pdf', '2025-05-27 04:59:17', 0),
(122, 24, 36, '24_36.pdf', '2025-05-27 04:59:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rates`
--

CREATE TABLE `tbl_rates` (
  `Rate_ID` int(11) NOT NULL,
  `Assistance_ID` int(11) NOT NULL,
  `Criteria` text NOT NULL,
  `Cost` int(11) NOT NULL,
  `Availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rates`
--

INSERT INTO `tbl_rates` (`Rate_ID`, `Assistance_ID`, `Criteria`, `Cost`, `Availability`) VALUES
(1, 1, 'Transport, Sea/Land/Air, abuse cases and other emergency related cases.', 3000, 7),
(2, 2, 'For Hospitalization/ Procedure', 5000, 1),
(3, 2, 'For Medication/ Medicine', 5000, 1),
(4, 2, 'Critical or Life-threatening illnesses (cancer, kidney failure, chronic heart disease, surgery)', 10000, 5),
(5, 3, 'For Funeral and burial expenses of deceased family members.', 10000, 1),
(6, 4, 'Elementary Students', 500, 9),
(7, 4, 'High School Students', 1500, 7),
(8, 4, 'Senior High School or College Students', 3000, 6),
(9, 5, 'Food Subsidy for individuals/ families', 3000, 5),
(10, 6, 'Affected by fire, calamities or other emergency situations', 10000, 1),
(11, 7, 'For mental Instability and Trauma (In need of Counseling)', 0, 1);

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
-- Indexes for table `tbl_access_control`
--
ALTER TABLE `tbl_access_control`
  ADD PRIMARY KEY (`Access_ID`),
  ADD UNIQUE KEY `Role` (`Access_Level`);

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`Account_ID`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`Address_ID`),
  ADD KEY `Account>Address` (`Account_ID`);

--
-- Indexes for table `tbl_admin_info`
--
ALTER TABLE `tbl_admin_info`
  ADD PRIMARY KEY (`Admin_ID`),
  ADD KEY `Admin_Info>Admin_Token` (`Token_ID`);

--
-- Indexes for table `tbl_admin_token`
--
ALTER TABLE `tbl_admin_token`
  ADD PRIMARY KEY (`Token_ID`),
  ADD UNIQUE KEY `Key` (`Key`);

--
-- Indexes for table `tbl_applications`
--
ALTER TABLE `tbl_applications`
  ADD PRIMARY KEY (`Application_ID`),
  ADD KEY `App_Acc_ID` (`Account_ID`),
  ADD KEY `App_As_ID` (`Assistance_ID`),
  ADD KEY `App_Ben` (`Beneficiary`),
  ADD KEY `App_Rep` (`Representative`),
  ADD KEY `FIle1` (`Files`(768));

--
-- Indexes for table `tbl_assistance`
--
ALTER TABLE `tbl_assistance`
  ADD PRIMARY KEY (`Assistance_ID`);

--
-- Indexes for table `tbl_availability`
--
ALTER TABLE `tbl_availability`
  ADD PRIMARY KEY (`Availability_ID`);

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
  ADD KEY `Family>Accounts` (`Account_ID`);

--
-- Indexes for table `tbl_family_composition`
--
ALTER TABLE `tbl_family_composition`
  ADD PRIMARY KEY (`Family_Composition_ID`),
  ADD KEY `FC>Accounts` (`Account_ID`),
  ADD KEY `FC>Family` (`Family_ID`),
  ADD KEY `FC>FM` (`User_ID`);

--
-- Indexes for table `tbl_family_member`
--
ALTER TABLE `tbl_family_member`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `tbl_feedbacks`
--
ALTER TABLE `tbl_feedbacks`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`File_ID`),
  ADD KEY `Files>Accounts` (`Account_ID`),
  ADD KEY `Files>Requirements` (`Requirement_ID`);

--
-- Indexes for table `tbl_rates`
--
ALTER TABLE `tbl_rates`
  ADD PRIMARY KEY (`Rate_ID`),
  ADD KEY `Rates>Assistance` (`Assistance_ID`),
  ADD KEY `Rates>Availability` (`Availability`);

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
-- AUTO_INCREMENT for table `tbl_access_control`
--
ALTER TABLE `tbl_access_control`
  MODIFY `Access_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `Account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `Address_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_admin_info`
--
ALTER TABLE `tbl_admin_info`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_admin_token`
--
ALTER TABLE `tbl_admin_token`
  MODIFY `Token_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_applications`
--
ALTER TABLE `tbl_applications`
  MODIFY `Application_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10028;

--
-- AUTO_INCREMENT for table `tbl_assistance`
--
ALTER TABLE `tbl_assistance`
  MODIFY `Assistance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_availability`
--
ALTER TABLE `tbl_availability`
  MODIFY `Availability_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  MODIFY `Document_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_family`
--
ALTER TABLE `tbl_family`
  MODIFY `Family_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_family_composition`
--
ALTER TABLE `tbl_family_composition`
  MODIFY `Family_Composition_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_family_member`
--
ALTER TABLE `tbl_family_member`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_feedbacks`
--
ALTER TABLE `tbl_feedbacks`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `File_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tbl_rates`
--
ALTER TABLE `tbl_rates`
  MODIFY `Rate_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  MODIFY `Requirement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD CONSTRAINT `Account>Address` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`);

--
-- Constraints for table `tbl_admin_info`
--
ALTER TABLE `tbl_admin_info`
  ADD CONSTRAINT `Admin_Info>Admin_Token` FOREIGN KEY (`Token_ID`) REFERENCES `tbl_admin_token` (`Token_ID`);

--
-- Constraints for table `tbl_applications`
--
ALTER TABLE `tbl_applications`
  ADD CONSTRAINT `App_Acc_ID` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`),
  ADD CONSTRAINT `App_As_ID` FOREIGN KEY (`Assistance_ID`) REFERENCES `tbl_assistance` (`Assistance_ID`),
  ADD CONSTRAINT `App_Ben` FOREIGN KEY (`Beneficiary`) REFERENCES `tbl_family_member` (`User_ID`);

--
-- Constraints for table `tbl_family`
--
ALTER TABLE `tbl_family`
  ADD CONSTRAINT `Family>Accounts` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`);

--
-- Constraints for table `tbl_family_composition`
--
ALTER TABLE `tbl_family_composition`
  ADD CONSTRAINT `FC>Accounts` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`),
  ADD CONSTRAINT `FC>FM` FOREIGN KEY (`User_ID`) REFERENCES `tbl_family_member` (`User_ID`),
  ADD CONSTRAINT `FC>Family` FOREIGN KEY (`Family_ID`) REFERENCES `tbl_family` (`Family_ID`);

--
-- Constraints for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD CONSTRAINT `Files>Accounts` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`),
  ADD CONSTRAINT `Files>Requirements` FOREIGN KEY (`Requirement_ID`) REFERENCES `tbl_requirements` (`Requirement_ID`);

--
-- Constraints for table `tbl_rates`
--
ALTER TABLE `tbl_rates`
  ADD CONSTRAINT `Rates>Assistance` FOREIGN KEY (`Assistance_ID`) REFERENCES `tbl_assistance` (`Assistance_ID`),
  ADD CONSTRAINT `Rates>Availability` FOREIGN KEY (`Availability`) REFERENCES `tbl_availability` (`Availability_ID`);

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
