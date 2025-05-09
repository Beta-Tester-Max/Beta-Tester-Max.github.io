-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 07:09 AM
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
-- Database: `aics_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_control_tbl`
--

CREATE TABLE `access_control_tbl` (
  `ID` int(11) NOT NULL,
  `Access_Level` varchar(10) NOT NULL,
  `Mod1` tinyint(1) NOT NULL DEFAULT 0,
  `Mod2` tinyint(1) NOT NULL DEFAULT 0,
  `Access_Control` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_control_tbl`
--

INSERT INTO `access_control_tbl` (`ID`, `Access_Level`, `Mod1`, `Mod2`, `Access_Control`, `is_deleted`) VALUES
(1, 'Admin', 1, 1, 1, 0),
(6, 'User', 0, 0, 0, 0),
(7, 'Mod', 1, 1, 0, 1),
(8, 'Mod', 1, 1, 0, 0),
(9, 'Validator', 1, 0, 0, 0),
(10, 'Staff', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `address_tbl`
--

CREATE TABLE `address_tbl` (
  `Address_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Street_Address` varchar(50) NOT NULL,
  `Barangay` varchar(50) NOT NULL,
  `CityorMunicipality` varchar(50) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `Region` varchar(50) NOT NULL,
  `Zip_Code` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address_tbl`
--

INSERT INTO `address_tbl` (`Address_ID`, `User_ID`, `Street_Address`, `Barangay`, `CityorMunicipality`, `Province`, `Region`, `Zip_Code`) VALUES
(6, 25, 'Fake Street', 'San Fake', 'Alaminos', 'Laguna', '4A', 4001),
(7, 26, 'Fake Street', 'San Fake', 'Alaminos', 'Laguna', '4A', 4001);

-- --------------------------------------------------------

--
-- Table structure for table `application_tbl`
--

CREATE TABLE `application_tbl` (
  `Application_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Full_Name` varchar(70) NOT NULL,
  `Birth_Date` date NOT NULL,
  `Address_ID` int(11) NOT NULL,
  `Assistance_Type` varchar(255) NOT NULL,
  `Civil_Status` varchar(50) NOT NULL,
  `Contact_Number` varchar(13) NOT NULL DEFAULT '0000-000-0000',
  `Email` varchar(50) NOT NULL,
  `Reason` text NOT NULL,
  `Req1` int(11) DEFAULT NULL,
  `Req2` int(11) DEFAULT NULL,
  `Req3` int(11) DEFAULT NULL,
  `Req4` int(11) DEFAULT NULL,
  `Req5` int(11) DEFAULT NULL,
  `Req6` int(11) DEFAULT NULL,
  `Req7` int(11) DEFAULT NULL,
  `Req8` int(11) DEFAULT NULL,
  `Req9` int(11) DEFAULT NULL,
  `Req10` int(11) DEFAULT NULL,
  `Req11` int(11) DEFAULT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'Pending',
  `Date_Submitted` date NOT NULL,
  `Edited_Count` int(255) NOT NULL DEFAULT 0,
  `Date_Edited` text NOT NULL,
  `Date_ApporRej` date NOT NULL,
  `ReasonFR` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_tbl`
--

CREATE TABLE `file_tbl` (
  `File_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `File_Name` text NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_tbl`
--

INSERT INTO `file_tbl` (`File_ID`, `User_ID`, `File_Name`, `TimeStamp`, `is_deleted`) VALUES
(32, 25, '25_Barangay_Indigency.pdf', '2025-04-24 01:14:15', 0),
(33, 26, '26_Barangay_Indigency.pdf', '2025-04-24 01:17:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages_tbl`
--

CREATE TABLE `messages_tbl` (
  `Message_ID` int(11) NOT NULL,
  `Sender_ID` int(11) NOT NULL,
  `Reciever_ID` int(11) NOT NULL,
  `Message` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register_tbl`
--

CREATE TABLE `register_tbl` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Profile_Pic` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Access_Level` varchar(10) NOT NULL DEFAULT 'User',
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_tbl`
--

INSERT INTO `register_tbl` (`User_ID`, `Username`, `Profile_Pic`, `Email`, `Password`, `Access_Level`, `Timestamp`) VALUES
(1, 'Admin', '', '', '$2y$10$HXSTS5yRlEgMCXk7OWmiJufCx56XUkHA6lA.hcR.WoP.PRQZU8rl.', 'Admin', '0000-00-00 00:00:00'),
(25, 'Test', '', 'jduser@gmail.com', '$2y$10$VxV2sngnEWpjPyUUH2Ilie8bIOh/CJC91701qKrWNumRzQdXh8cvq', 'User', '2025-04-24 01:13:37'),
(26, 'ph', '', 'ph@gmail.com', '$2y$10$Fo1h2cEQUkLRLOmWjEGi0.EDTRMtRRidEYe.RHt9ZVV/6wV5oaHc6', 'User', '2025-04-24 01:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `requirements_tbl`
--

CREATE TABLE `requirements_tbl` (
  `Requirements_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Document_Type` varchar(255) NOT NULL,
  `File_ID` int(11) NOT NULL,
  `Importance` varchar(10) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Unvalidated',
  `ReasonFR` text NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirements_tbl`
--

INSERT INTO `requirements_tbl` (`Requirements_ID`, `User_ID`, `Document_Type`, `File_ID`, `Importance`, `Status`, `ReasonFR`, `TimeStamp`) VALUES
(107, 25, 'Barangay Indigency', 32, 'Required', 'Unvalidated', '', '2025-04-24 01:14:15'),
(108, 26, 'Barangay Indigency', 33, 'Required', 'Unvalidated', '', '2025-04-24 01:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo_tbl`
--

CREATE TABLE `userinfo_tbl` (
  `UserInfo_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Mname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Birth_Date` date NOT NULL,
  `Sex` char(1) NOT NULL,
  `Contact_Number` varchar(13) NOT NULL DEFAULT '0000-000-0000',
  `Civil_Status` varchar(50) NOT NULL,
  `Religion` varchar(50) NOT NULL,
  `Nationality` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo_tbl`
--

INSERT INTO `userinfo_tbl` (`UserInfo_ID`, `User_ID`, `Fname`, `Mname`, `Lname`, `Birth_Date`, `Sex`, `Contact_Number`, `Civil_Status`, `Religion`, `Nationality`) VALUES
(11, 25, 'John', 'T', 'Doe', '2025-04-09', 'M', '0888-888-8888', 'Single', 'Roman Catholic', 'filipino'),
(12, 26, 'Place', '', 'Holder', '2025-04-07', 'M', '0987-654-3210', 'Single', 'Roman Catholic', 'filipino');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_control_tbl`
--
ALTER TABLE `access_control_tbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `address_tbl`
--
ALTER TABLE `address_tbl`
  ADD PRIMARY KEY (`Address_ID`),
  ADD KEY `Relation6` (`User_ID`);

--
-- Indexes for table `application_tbl`
--
ALTER TABLE `application_tbl`
  ADD PRIMARY KEY (`Application_ID`),
  ADD KEY `Relation5` (`User_ID`),
  ADD KEY `Relation8` (`Address_ID`),
  ADD KEY `Req1` (`Req1`),
  ADD KEY `Req2` (`Req2`),
  ADD KEY `Req3` (`Req3`),
  ADD KEY `Req4` (`Req4`),
  ADD KEY `Req5` (`Req5`),
  ADD KEY `Req6` (`Req6`),
  ADD KEY `Req7` (`Req7`),
  ADD KEY `Req8` (`Req8`),
  ADD KEY `Req9` (`Req9`),
  ADD KEY `Req10` (`Req10`),
  ADD KEY `Req11` (`Req11`);

--
-- Indexes for table `file_tbl`
--
ALTER TABLE `file_tbl`
  ADD PRIMARY KEY (`File_ID`),
  ADD KEY `Relation10` (`User_ID`);

--
-- Indexes for table `messages_tbl`
--
ALTER TABLE `messages_tbl`
  ADD PRIMARY KEY (`Message_ID`),
  ADD KEY `Relation3` (`Sender_ID`),
  ADD KEY `Relation4` (`Reciever_ID`);

--
-- Indexes for table `register_tbl`
--
ALTER TABLE `register_tbl`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `requirements_tbl`
--
ALTER TABLE `requirements_tbl`
  ADD PRIMARY KEY (`Requirements_ID`),
  ADD KEY `Relation2` (`User_ID`),
  ADD KEY `Relation7` (`File_ID`);

--
-- Indexes for table `userinfo_tbl`
--
ALTER TABLE `userinfo_tbl`
  ADD PRIMARY KEY (`UserInfo_ID`),
  ADD KEY `Relation1` (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_control_tbl`
--
ALTER TABLE `access_control_tbl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `address_tbl`
--
ALTER TABLE `address_tbl`
  MODIFY `Address_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `application_tbl`
--
ALTER TABLE `application_tbl`
  MODIFY `Application_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `file_tbl`
--
ALTER TABLE `file_tbl`
  MODIFY `File_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `messages_tbl`
--
ALTER TABLE `messages_tbl`
  MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `register_tbl`
--
ALTER TABLE `register_tbl`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `requirements_tbl`
--
ALTER TABLE `requirements_tbl`
  MODIFY `Requirements_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `userinfo_tbl`
--
ALTER TABLE `userinfo_tbl`
  MODIFY `UserInfo_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address_tbl`
--
ALTER TABLE `address_tbl`
  ADD CONSTRAINT `Relation6` FOREIGN KEY (`User_ID`) REFERENCES `register_tbl` (`User_ID`);

--
-- Constraints for table `application_tbl`
--
ALTER TABLE `application_tbl`
  ADD CONSTRAINT `Relation5` FOREIGN KEY (`User_ID`) REFERENCES `register_tbl` (`User_ID`),
  ADD CONSTRAINT `Relation8` FOREIGN KEY (`Address_ID`) REFERENCES `address_tbl` (`Address_ID`);

--
-- Constraints for table `file_tbl`
--
ALTER TABLE `file_tbl`
  ADD CONSTRAINT `Relation10` FOREIGN KEY (`User_ID`) REFERENCES `register_tbl` (`User_ID`);

--
-- Constraints for table `messages_tbl`
--
ALTER TABLE `messages_tbl`
  ADD CONSTRAINT `Relation3` FOREIGN KEY (`Sender_ID`) REFERENCES `register_tbl` (`User_ID`),
  ADD CONSTRAINT `Relation4` FOREIGN KEY (`Reciever_ID`) REFERENCES `register_tbl` (`User_ID`);

--
-- Constraints for table `requirements_tbl`
--
ALTER TABLE `requirements_tbl`
  ADD CONSTRAINT `Relation2` FOREIGN KEY (`User_ID`) REFERENCES `register_tbl` (`User_ID`),
  ADD CONSTRAINT `Relation7` FOREIGN KEY (`File_ID`) REFERENCES `file_tbl` (`File_ID`);

--
-- Constraints for table `userinfo_tbl`
--
ALTER TABLE `userinfo_tbl`
  ADD CONSTRAINT `Relation1` FOREIGN KEY (`User_ID`) REFERENCES `register_tbl` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
