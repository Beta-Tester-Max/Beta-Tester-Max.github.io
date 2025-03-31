-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 08:09 AM
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
-- Table structure for table `messages_tbl`
--

CREATE TABLE `messages_tbl` (
  `Message_ID` int(11) NOT NULL,
  `Sender_ID` int(11) NOT NULL,
  `Reciever_ID` int(11) NOT NULL,
  `Message` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages_tbl`
--

INSERT INTO `messages_tbl` (`Message_ID`, `Sender_ID`, `Reciever_ID`, `Message`, `Timestamp`) VALUES
(28, 9, 13, 'hello john', '2025-03-27 05:35:58'),
(29, 9, 10, 'hello samps', '2025-03-27 05:36:07'),
(30, 10, 9, 'hello aswell', '2025-03-27 05:36:36'),
(31, 10, 13, 'heloo john', '2025-03-27 05:36:59'),
(32, 9, 10, 'hello1', '2025-03-31 00:40:06'),
(33, 9, 10, 'hello2', '2025-03-31 00:40:10'),
(34, 9, 10, 'hello3', '2025-03-31 00:40:14'),
(35, 9, 10, 'Hello 4', '2025-03-31 00:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `register_tbl`
--

CREATE TABLE `register_tbl` (
  `User_ID` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Mname` varchar(50) DEFAULT NULL,
  `Lname` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Is_Admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_tbl`
--

INSERT INTO `register_tbl` (`User_ID`, `Fname`, `Mname`, `Lname`, `Username`, `Email`, `Password`, `Is_Admin`) VALUES
(9, 'Admin', 'Modifier', 'Owner', 'Test', 'Testacc@gmail.com', '123', 0),
(10, 'Samp', '', 'Samps', 'hello', '1234@gmail.com', '123', 0),
(13, 'John Doe', 'Not', 'Found', '333', '1234@gmail.com', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requirements_tbl`
--

CREATE TABLE `requirements_tbl` (
  `Requirements_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Brgy_Indigency` varchar(255) NOT NULL,
  `Valid_ID` varchar(255) NOT NULL,
  `Birth/Marriage_Cert` varchar(255) NOT NULL,
  `Ref_Letter` varchar(255) NOT NULL,
  `Med/Psycho_Rep` varchar(255) DEFAULT NULL,
  `Police/Legal_Rep` varchar(255) DEFAULT NULL,
  `Disaster/Emergency_Cert` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages_tbl`
--
ALTER TABLE `messages_tbl`
  ADD PRIMARY KEY (`Message_ID`),
  ADD KEY `Sender_ID` (`Sender_ID`);

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
  ADD KEY `User_ID` (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages_tbl`
--
ALTER TABLE `messages_tbl`
  MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `register_tbl`
--
ALTER TABLE `register_tbl`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `requirements_tbl`
--
ALTER TABLE `requirements_tbl`
  MODIFY `Requirements_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requirements_tbl`
--
ALTER TABLE `requirements_tbl`
  ADD CONSTRAINT `User_ID` FOREIGN KEY (`User_ID`) REFERENCES `register_tbl` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
