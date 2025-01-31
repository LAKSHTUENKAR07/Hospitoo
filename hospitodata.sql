-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 10:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitodata`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `adminID` int(11) NOT NULL,
  `emailID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contactno` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Hcode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`adminID`, `emailID`, `pwd`, `contactno`, `fullname`, `Hcode`) VALUES
(4, 'nikhil.nkp985@gmail.com', '$2y$10$M8LjfMwONpvmWhroCRRzwOc9wcctmPTcHSCZW1jKzMGG1juucXYw6', '+917558498271', 'Nikhil kumar', 'NIKHIL123'),
(5, 'sahil@gmail.com', '$2y$10$eH2pz4hwqeUT9TL8ZXNPluHg55CcLi2MRqrNNeKJI4HBZtnOWhWFm', '+917568498251', 'sahil kumar', 'SAHIL123');

-- --------------------------------------------------------

--
-- Table structure for table `healthf`
--

CREATE TABLE `healthf` (
  `age` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `question` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Hcode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `healthf`
--

INSERT INTO `healthf` (`age`, `question`, `Hcode`) VALUES
('child', 'do you feel dipressed regularly?', 'NIKHIL123'),
('adult', 'Do you have diabities?', 'NIKHIL123'),
('adult', 'Do you have head ache or stomach pain?', 'NIKHIL123'),
('adult', 'Do you have lose motion?', 'NIKHIL123'),
('child', 'Do you have regular head ache?', 'NIKHIL123'),
('child', 'what is your screen time?', 'NIKHIL123'),
('child', 'what time do you sleep at night?', 'NIKHIL123'),
('child', 'what time do you wake up in the morning?', 'NIKHIL123');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalinfo`
--

CREATE TABLE `hospitalinfo` (
  `hospID` int(11) NOT NULL,
  `hospName` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stabYR` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospaddress` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospemailID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hosptype` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospNO` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adderName` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adderemailID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adderNO` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospPASS` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fileLinks` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pricelist` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Hcode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitalinfo`
--

INSERT INTO `hospitalinfo` (`hospID`, `hospName`, `stabYR`, `hospaddress`, `hospemailID`, `hosptype`, `hospNO`, `adderName`, `adderemailID`, `adderNO`, `hospPASS`, `fileLinks`, `pricelist`, `Hcode`) VALUES
(13, 'rakshak', '1850', 'new vihar, mumbai, maharashtra', 'raksha@yaahomail.com', 'pvt', '1234512345|00011119999', 'Nikhil kumar', 'nikhil.nkp985@gmail.com', '+917558498271', '$2y$10$gRI/OLtPhM0muInaFG8sB./IEI6EiwSGlP2JxvWj3C.ITQ.76XQ8.', 'Screenshot__47_.png|Screenshot__46_.png|Screenshot__45_.png|Order_by_in_MySQL_0_.mp4|', 'assignment_3_EVS.pdf', 'NIKHIL123'),
(15, 'lifeGaurd', '2023', 'near Pink valley restaurant, jaipur, Rajasthan', 'lifegaurd@gmail.com', 'govt', '+91 1234567890| 000111', 'sahil kumar', 'sahil@gmail.com', '+917568498251', '$2y$10$fcR0q9/I5RicdpDgCchQjuVsWg0M4KCNdVNB/5pyVDedIUXrrkjyK', 'Screenshot__47_(1).png|Screenshot__46_(1).png|Screenshot__45_(2).png|Screenshot__44_(1).png|', 'assignment_3_EVS(2).pdf', 'SAHIL123');

-- --------------------------------------------------------

--
-- Table structure for table `patientinfo`
--

CREATE TABLE `patientinfo` (
  `userID` int(11) NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `emailID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contactno` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `report` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `savedhospitals` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Hcode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fees` varchar(20) NOT NULL,
  `fullname` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Pcode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Areport` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientinfo`
--

INSERT INTO `patientinfo` (`userID`, `username`, `emailID`, `pwd`, `contactno`, `gender`, `report`, `savedhospitals`, `Hcode`, `fees`, `fullname`, `Pcode`, `age`, `Areport`) VALUES
(8, 'abin123', 'jeev@gmail.com', '$2y$10$uALDNi8fbZBgZUiLGqiMq.K7T4b0G8H7eSlFKSD3In.vm270rKfOy', '+917568498251', 'Male', 'he has hypersynopiya', 'lifeGaurd', 'SAHIL123', '500 /-', 'abin', 'abinIN', '18', 'you are having little fever.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `healthf`
--
ALTER TABLE `healthf`
  ADD UNIQUE KEY `question` (`question`);

--
-- Indexes for table `hospitalinfo`
--
ALTER TABLE `hospitalinfo`
  ADD PRIMARY KEY (`hospID`);

--
-- Indexes for table `patientinfo`
--
ALTER TABLE `patientinfo`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admininfo`
--
ALTER TABLE `admininfo`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospitalinfo`
--
ALTER TABLE `hospitalinfo`
  MODIFY `hospID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patientinfo`
--
ALTER TABLE `patientinfo`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
