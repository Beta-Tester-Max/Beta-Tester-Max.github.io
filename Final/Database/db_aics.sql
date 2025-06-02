-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 01:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(1, 'Admin', '', '123', 'Admin', '0000-00-00 00:00:00'),
(29, 'aa1', 'Testacc@gmail.com', '12345678', 'User', '2025-06-02 01:46:05');

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
(13, 29, 229, 'Fake Street', 'San Fake', 'Alaminos', 'Laguna', '4A', 4001);

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
(1, 2, 1, 'Admin'),
(2, 8, 1, 'Bobert 3000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_logs`
--

CREATE TABLE `tbl_admin_logs` (
  `Log_ID` int(11) NOT NULL,
  `Token_ID` int(11) NOT NULL,
  `Action` text NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_logs`
--

INSERT INTO `tbl_admin_logs` (`Log_ID`, `Token_ID`, `Action`, `TimeStamp`) VALUES
(1, 5, 'Token: $2y$10$fQvI0uers.OnGPHRLrGKMuABoqMlNzC0fo.AY/lGuxt77cHG7U.Gm; has been generated.', '2025-06-02 06:23:25'),
(2, 6, 'f1KE40118b has been generated.', '2025-06-02 06:26:51'),
(3, 7, 'Key: 7Kd8f7a2bE; has been generated.', '2025-06-02 06:31:17'),
(4, 2, 'has logged out.', '2025-06-02 06:50:34'),
(5, 2, 'has logged in.', '2025-06-02 06:50:44'),
(6, 8, 'Token has been generated.', '2025-06-02 15:17:18'),
(7, 8, 'has logged in.', '2025-06-02 15:18:44'),
(8, 8, 'created new Availability \"Twice a week\". ID: 10.', '2025-06-02 15:59:43'),
(9, 8, 'deleted an availability. ID: 10.', '2025-06-02 16:00:28'),
(10, 8, 'created has Approved an Application. ID 10030.', '2025-06-02 16:29:38'),
(11, 8, 'has logged in.', '2025-06-02 17:55:38'),
(12, 8, 'has approved an Application. ID 10031.', '2025-06-02 17:56:14'),
(13, 8, 'has rejected an Application. ID 10032.', '2025-06-02 18:08:43'),
(14, 8, 'has rejected an Application. ID 10032.', '2025-06-02 18:12:56'),
(15, 8, 'has logged in.', '2025-06-02 22:17:56'),
(16, 8, 'has logged in.', '2025-06-02 22:31:50'),
(17, 8, 'has rejected an Application. ID 10033.', '2025-06-02 22:35:40');

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
(8, 'a8Ka3fEb3e', '$2y$10$M7Ok0nRtd.mLqE5arOay6uUgRGWZsyDbG4lGqevt8fyzW3JIPfKLq', '2025-06-02 15:17:18');

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
  `Reviewed_By` int(11) DEFAULT NULL,
  `Date_Reviewed` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Files` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_applications`
--

INSERT INTO `tbl_applications` (`Application_ID`, `Account_ID`, `Assistance_ID`, `Beneficiary`, `Representative`, `Severity`, `Reason`, `Status`, `Date_Submitted`, `ReasonFR`, `Reviewed_By`, `Date_Reviewed`, `Files`, `is_deleted`) VALUES
(10031, 29, 5, 25, 25, 9, 'I\'m Hungry', 'Approved', '2025-06-02 17:54:35', NULL, 8, '2025-06-02 17:56:14', '162, 163, 164', 0),
(10032, 29, 5, 25, 25, 9, 'I\'m Hungry Again', 'Rejected', '2025-06-02 18:08:20', 'Nope no more food for u', 8, '2025-06-02 18:12:56', '165, 166, 167', 0),
(10033, 29, 5, 25, 25, 9, 'I\'m Hungry this time too', 'Rejected', '2025-06-02 22:34:56', 'I told u not again', 8, '2025-06-02 22:35:40', '168, 169, 170', 0);

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
  `Availability_Name` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_availability`
--

INSERT INTO `tbl_availability` (`Availability_ID`, `Availability_Name`, `is_deleted`) VALUES
(1, 'Always', 0),
(2, 'Daily', 0),
(3, 'Weekly', 0),
(4, 'Monthly', 0),
(5, 'Quarterly', 0),
(6, 'Semi-Annually', 0),
(7, 'Annually', 0),
(8, 'Per-Semester', 0),
(9, 'Per-School-Year', 0),
(10, 'Twice a week', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_budget`
--

CREATE TABLE `tbl_budget` (
  `Budget_ID` int(11) NOT NULL,
  `Assistance_ID` int(11) NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_budget`
--

INSERT INTO `tbl_budget` (`Budget_ID`, `Assistance_ID`, `Amount`) VALUES
(1, 5, 12000),
(2, 6, 20000);

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
(13, 29, 'Doe');

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
(16, 29, 13, 25);

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
(25, 'John', 'Diaz', 'Doe', 'jd@gmail.com', '0999-999-9999', '1996-06-17', 'm', 'Single', '', '', '2025-06-02 02:21:12', 0);

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
(162, 29, 34, 'deleted_162_29_34.pdf', '2025-06-02 17:54:35', 1),
(163, 29, 35, 'deleted_163_29_35.pdf', '2025-06-02 17:54:35', 1),
(164, 29, 36, 'deleted_164_29_36.pdf', '2025-06-02 17:54:35', 1),
(165, 29, 34, 'deleted_165_29_34.pdf', '2025-06-02 18:08:20', 1),
(166, 29, 35, 'deleted_166_29_35.pdf', '2025-06-02 18:08:20', 1),
(167, 29, 36, 'deleted_167_29_36.pdf', '2025-06-02 18:08:20', 1),
(168, 29, 34, '29_34.pdf', '2025-06-02 22:34:56', 0),
(169, 29, 35, '29_35.pdf', '2025-06-02 22:34:56', 0),
(170, 29, 36, '29_36.pdf', '2025-06-02 22:34:56', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_logs`
--

CREATE TABLE `tbl_user_logs` (
  `Log_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Action` text NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_logs`
--

INSERT INTO `tbl_user_logs` (`Log_ID`, `Account_ID`, `Action`, `TimeStamp`) VALUES
(2, 29, 'Account aa1/Testacc@gmail.com has been created.', '2025-06-02 01:46:05'),
(3, 29, 'Account / logged in.', '2025-06-02 01:59:58'),
(4, 29, 'Account aa1/Testacc@gmail.com logged in.', '2025-06-02 02:02:31'),
(5, 29, 'has set their Profile.', '2025-06-02 02:12:04'),
(6, 29, 'has added 1 family member/s.', '2025-06-02 02:18:37'),
(7, 29, 'has set their Family Name and Address. and added 1 family member/s', '2025-06-02 02:21:12'),
(8, 29, 'has created an Food Assistance type Application.', '2025-06-02 02:28:11'),
(9, 29, 'has deleted an Application. ID: 10029.', '2025-06-02 02:33:37'),
(10, 29, 'has logged out.', '2025-06-02 02:43:20'),
(11, 29, 'has logged in.', '2025-06-02 02:44:22'),
(12, 29, 'has logged out.', '2025-06-02 02:44:37'),
(15, 29, 'has logged in.', '2025-06-02 16:15:07'),
(16, 29, 'has created a Food Assistance type Application. ID: 10030.', '2025-06-02 16:28:51'),
(17, 29, 'has created a Food Assistance type Application. ID: 10031.', '2025-06-02 17:54:35'),
(18, 29, 'has created a Food Assistance type Application. ID: 10032.', '2025-06-02 18:08:20'),
(19, 29, 'has logged in.', '2025-06-02 22:34:33'),
(20, 29, 'has created a Food Assistance type Application. ID: 10033.', '2025-06-02 22:34:56');

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
-- Indexes for table `tbl_admin_logs`
--
ALTER TABLE `tbl_admin_logs`
  ADD PRIMARY KEY (`Log_ID`);

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
-- Indexes for table `tbl_budget`
--
ALTER TABLE `tbl_budget`
  ADD PRIMARY KEY (`Budget_ID`);

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
-- Indexes for table `tbl_user_logs`
--
ALTER TABLE `tbl_user_logs`
  ADD PRIMARY KEY (`Log_ID`),
  ADD KEY `User_Logs>Accounts` (`Account_ID`);

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
  MODIFY `Account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `Address_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_admin_info`
--
ALTER TABLE `tbl_admin_info`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_admin_logs`
--
ALTER TABLE `tbl_admin_logs`
  MODIFY `Log_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_admin_token`
--
ALTER TABLE `tbl_admin_token`
  MODIFY `Token_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_applications`
--
ALTER TABLE `tbl_applications`
  MODIFY `Application_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10034;

--
-- AUTO_INCREMENT for table `tbl_assistance`
--
ALTER TABLE `tbl_assistance`
  MODIFY `Assistance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_availability`
--
ALTER TABLE `tbl_availability`
  MODIFY `Availability_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_budget`
--
ALTER TABLE `tbl_budget`
  MODIFY `Budget_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  MODIFY `Document_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_family`
--
ALTER TABLE `tbl_family`
  MODIFY `Family_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_family_composition`
--
ALTER TABLE `tbl_family_composition`
  MODIFY `Family_Composition_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_family_member`
--
ALTER TABLE `tbl_family_member`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_feedbacks`
--
ALTER TABLE `tbl_feedbacks`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `File_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

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
-- AUTO_INCREMENT for table `tbl_user_logs`
--
ALTER TABLE `tbl_user_logs`
  MODIFY `Log_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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

--
-- Constraints for table `tbl_user_logs`
--
ALTER TABLE `tbl_user_logs`
  ADD CONSTRAINT `User_Logs>Accounts` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_accounts` (`Account_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
