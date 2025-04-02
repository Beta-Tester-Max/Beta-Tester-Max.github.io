-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 10:37 AM
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
-- Database: `aics database`
--

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
(1, 19, 'Fake Street', 'San Fake', 'Alaminos', 'Laguna', '4A', 4001);

-- --------------------------------------------------------

--
-- Table structure for table `application_tbl`
--

CREATE TABLE `application_tbl` (
  `Application_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Full_Name` varchar(70) NOT NULL,
  `Birth_Date` date NOT NULL,
  `Address_ID` varchar(255) NOT NULL,
  `Assistance_Type` varchar(255) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(19, 'Test', '', 'Testacc@gmail.com', '123', 'User', '2025-04-02 08:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `requirements_tbl`
--

CREATE TABLE `requirements_tbl` (
  `Requirements_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Document_Type` varchar(255) NOT NULL,
  `File_Name` varchar(255) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 19, 'Admin', 'Modifier', 'Owner', '2025-04-23', 'm', '0888-888-8888', 'Single', 'Roman Catholic', 'filipino');

--
-- Indexes for dumped tables
--

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
  ADD KEY `Relation5` (`User_ID`);

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
  ADD KEY `Relation2` (`User_ID`);

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
-- AUTO_INCREMENT for table `address_tbl`
--
ALTER TABLE `address_tbl`
  MODIFY `Address_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `application_tbl`
--
ALTER TABLE `application_tbl`
  MODIFY `Application_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages_tbl`
--
ALTER TABLE `messages_tbl`
  MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `register_tbl`
--
ALTER TABLE `register_tbl`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `requirements_tbl`
--
ALTER TABLE `requirements_tbl`
  MODIFY `Requirements_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `userinfo_tbl`
--
ALTER TABLE `userinfo_tbl`
  MODIFY `UserInfo_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `Relation5` FOREIGN KEY (`User_ID`) REFERENCES `register_tbl` (`User_ID`);

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
  ADD CONSTRAINT `Relation2` FOREIGN KEY (`User_ID`) REFERENCES `register_tbl` (`User_ID`);

--
-- Constraints for table `userinfo_tbl`
--
ALTER TABLE `userinfo_tbl`
  ADD CONSTRAINT `Relation1` FOREIGN KEY (`User_ID`) REFERENCES `register_tbl` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
