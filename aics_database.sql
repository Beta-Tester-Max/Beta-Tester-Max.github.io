-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 03:26 AM
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
(24, 5, 3, 'Hello Admin', '2025-03-27 02:07:08'),
(25, 3, 5, 'Hello samp', '2025-03-27 02:20:57'),
(26, 6, 5, 'hello samp', '2025-03-27 02:22:15'),
(27, 5, 3, 'can i apply', '2025-03-27 02:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `register_tbl`
--

CREATE TABLE `register_tbl` (
  `User_ID` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Is_Admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_tbl`
--

INSERT INTO `register_tbl` (`User_ID`, `Fname`, `Lname`, `Username`, `Email`, `Password`, `Is_Admin`) VALUES
(3, 'Admin', 'Owner', 'Test', 'Testacc@gmail.com', '123', 0),
(5, 'samp', 'samps', 'hello', '1234@gmail.com', '123', 0),
(6, 'John', 'Doe', 'jduser', 'jduser@gmail.com', '123', 0);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages_tbl`
--
ALTER TABLE `messages_tbl`
  MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `register_tbl`
--
ALTER TABLE `register_tbl`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
