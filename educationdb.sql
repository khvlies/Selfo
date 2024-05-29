-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 06:13 AM
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
-- Database: `educationdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(5) NOT NULL,
  `admin_name` varchar(10) DEFAULT NULL,
  `admin_password` varchar(8) DEFAULT NULL,
  `admin_phone` int(11) DEFAULT NULL,
  `admin_email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_password`, `admin_phone`, `admin_email`) VALUES
('AD01', 'admin1', 'ad01', 136409816, 'admin1@gmail.com'),
('AD02', 'admin2', 'ad02', 118906654, 'admin2@gmail.com'),
('AD03', 'admin3', 'ad03', 179527791, 'admin3@gmail.com'),
('AD04', 'admin4', 'ad04', 28805632, 'admin4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `basic_user`
--

CREATE TABLE `basic_user` (
  `basic_id` varchar(5) NOT NULL,
  `basic_password` varchar(8) DEFAULT NULL,
  `basic_name` varchar(20) DEFAULT NULL,
  `basic_phone` int(11) DEFAULT NULL,
  `basic_email` varchar(20) DEFAULT NULL,
  `study_id` varchar(5) DEFAULT NULL,
  `paper_id` varchar(5) DEFAULT NULL,
  `admin_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basic_user`
--

INSERT INTO `basic_user` (`basic_id`, `basic_password`, `basic_name`, `basic_phone`, `basic_email`, `study_id`, `paper_id`, `admin_id`) VALUES
('BU01', 'bal080', 'Iqbaal Ramadhani', 122964080, 'iqbaal@gmail.com', 'NT05', 'PP01', 'AD01'),
('BU02', 'idhm729', 'Mohd Idham', 145562729, 'idham@gmail.com', 'YT02', 'PP02', 'AD01'),
('BU03', 'nur114', 'Nur Sakinah', 1165710114, 'sakinah@gmail.com', 'NT03', 'PP03', 'AD01'),
('BU04', 'sha505', 'Elly Elysha', 163531505, 'elly@gmail.com', 'NT02', 'PP04', 'AD01'),
('BU05', 'iskndr07', 'Mohd Iskandar', 174769707, 'iskandar@gmail.com', 'NT05', 'PP05', 'AD01'),
('BU06', 'dani862', 'Danial Aiman', 182408862, 'aiman@gmail.com', 'YT01', 'PP06', 'AD04'),
('BU07', 'ainul106', 'Ainul Aiza', 154216106, 'ainul@gmail.com', 'NT04', 'PP07', 'AD04'),
('BU08', 'ira349', 'Syafirah Adira', 109257349, 'adira@gmail.com', 'YT04', 'PP08', 'AD04'),
('BU09', 'ain053', 'Ain Nadira', 194865053, 'ainnad@gmail.com', 'YT05', 'PP09', 'AD04'),
('BU10', 'wan697', 'Wan Syarmila', 102639697, 'syarmila@gmail.com', 'NT01', 'PP10', 'AD04');

-- --------------------------------------------------------

--
-- Table structure for table `past_year_paper`
--

CREATE TABLE `past_year_paper` (
  `paper_id` varchar(5) NOT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `admin_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `past_year_paper`
--

INSERT INTO `past_year_paper` (`paper_id`, `course_code`, `admin_id`) VALUES
('PP01', 'CSC126', 'AD02'),
('PP02', 'CSC186', 'AD02'),
('PP03', 'CS248', 'AD02'),
('PP04', 'MAT133', 'AD02'),
('PP05', 'MAT183', 'AD02'),
('PP06', 'ICT200', 'AD04'),
('PP07', 'ITT320', 'AD04'),
('PP08', 'CSC207', 'AD04'),
('PP09', 'MAT210', 'AD04'),
('PP10', 'CSC305', 'AD04');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(5) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `admin_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_type`, `admin_id`) VALUES
('P01', 'Online Banking', 'AD01'),
('P02', 'Online Banking', 'AD01'),
('P03', 'Credit/Debit Card', 'AD01'),
('P04', 'Credit/Debit Card', 'AD01'),
('P05', 'Online Banking', 'AD01'),
('P06', 'Online Banking', 'AD01'),
('P07', 'Credit/Debit Card', 'AD01'),
('P08', 'Credit/Debit Card', 'AD01'),
('P09', 'Online Banking', 'AD01'),
('P10', 'Online Banking', 'AD01');

-- --------------------------------------------------------

--
-- Table structure for table `premium_user`
--

CREATE TABLE `premium_user` (
  `premium_id` varchar(5) NOT NULL,
  `premium_password` varchar(8) DEFAULT NULL,
  `premium_name` varchar(20) DEFAULT NULL,
  `premium_phone` int(11) DEFAULT NULL,
  `premium_email` varchar(20) DEFAULT NULL,
  `admin_id` varchar(5) DEFAULT NULL,
  `study_id` varchar(5) DEFAULT NULL,
  `paper_id` varchar(5) DEFAULT NULL,
  `tutor_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `premium_user`
--

INSERT INTO `premium_user` (`premium_id`, `premium_password`, `premium_name`, `premium_phone`, `premium_email`, `admin_id`, `study_id`, `paper_id`, `tutor_id`) VALUES
('PU01', 'syu123', 'Syuhada Natasya', 145678367, 'syuhada@gmail.com', 'AD02', 'NT02', 'PP03', 'TU01'),
('PU02', 'amir2324', 'Amir Hilman', 128907765, 'hilman@gmail.com', 'AD02', 'NT04', 'PP09', 'TU01'),
('PU03', 'ray456', 'Raysha Maheera', 102334478, 'raysha@gmail.com', 'AD02', 'NT01', 'PP05', 'TU02'),
('PU04', 'yasun926', 'Andau Yasun', 136729926, 'andau@gmail.com', 'AD02', 'NT03', 'PP01', 'TU03'),
('PU05', 'wei169', 'Zhang Wei', 11571169, 'zhangwei@gmail.com', 'AD02', 'NT03', 'PP10', 'TU04'),
('PU06', 'syed462', 'Syed Haikal', 199892462, 'haikal@gmail.com', 'AD03', 'YT02', 'PP02', 'TU05'),
('PU07', 'azhar484', 'Azhar Matusin', 195016484, 'azhar@gmail.com', 'AD03', 'YT05', 'PP02', 'TU05'),
('PU08', 'hardy331', 'Mohd Hardy', 1578442331, 'hardy@gmail.com', 'AD03', 'YT03', 'PP04', 'TU02'),
('PU09', 'nala172', 'Ishita Anala', 170541172, 'anala@gmail.com', 'AD03', 'YT01', 'PP07', 'TU03'),
('PU10', 'kim458', 'Daniel Hakim', 179781458, 'daniel@gmail.com', 'AD03', 'YT04', 'PP08', 'TU01');

-- --------------------------------------------------------

--
-- Table structure for table `study_material`
--

CREATE TABLE `study_material` (
  `study_id` varchar(5) NOT NULL,
  `admin_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study_material`
--

INSERT INTO `study_material` (`study_id`, `admin_id`) VALUES
('NT01', 'AD01'),
('NT02', 'AD01'),
('NT03', 'AD01'),
('NT04', 'AD01'),
('NT05', 'AD01'),
('YT01', 'AD03'),
('YT02', 'AD03'),
('YT03', 'AD03'),
('YT04', 'AD03'),
('YT05', 'AD03');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tutor_id` varchar(5) NOT NULL,
  `tutor_password` varchar(8) DEFAULT NULL,
  `tutor_name` varchar(20) DEFAULT NULL,
  `tutor_phone` int(11) DEFAULT NULL,
  `tutor_email` varchar(20) DEFAULT NULL,
  `admin_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutor_id`, `tutor_password`, `tutor_name`, `tutor_phone`, `tutor_email`, `admin_id`) VALUES
('TU01', 'sitiB246', 'Siti Bahiyah', 115639246, 'sbahiyah@gmail.com', 'AD04'),
('TU02', 'ayu854', 'Ayu Nurili', 194296854, 'ayu@gmail.com', 'AD04'),
('TU03', 'abd261', 'Abdul Rahman', 167133261, 'abdrhmn@gmail.com', 'AD04'),
('TU04', 'hmd771', 'Zakaria Hamdan', 174909771, 'zakaria@gmail.com', 'AD04'),
('TU05', 'bakh593', 'Hasan Bakhtiar', 12872593, 'hasan@gmail.com', 'AD04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `basic_user`
--
ALTER TABLE `basic_user`
  ADD PRIMARY KEY (`basic_id`),
  ADD KEY `study_id` (`study_id`),
  ADD KEY `paper_id` (`paper_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `past_year_paper`
--
ALTER TABLE `past_year_paper`
  ADD PRIMARY KEY (`paper_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `premium_user`
--
ALTER TABLE `premium_user`
  ADD PRIMARY KEY (`premium_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `study_id` (`study_id`),
  ADD KEY `paper_id` (`paper_id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `study_material`
--
ALTER TABLE `study_material`
  ADD PRIMARY KEY (`study_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tutor_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basic_user`
--
ALTER TABLE `basic_user`
  ADD CONSTRAINT `basic_user_ibfk_1` FOREIGN KEY (`study_id`) REFERENCES `study_material` (`study_id`),
  ADD CONSTRAINT `basic_user_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `past_year_paper` (`paper_id`),
  ADD CONSTRAINT `basic_user_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `past_year_paper`
--
ALTER TABLE `past_year_paper`
  ADD CONSTRAINT `past_year_paper_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `premium_user`
--
ALTER TABLE `premium_user`
  ADD CONSTRAINT `premium_user_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `premium_user_ibfk_2` FOREIGN KEY (`study_id`) REFERENCES `study_material` (`study_id`),
  ADD CONSTRAINT `premium_user_ibfk_3` FOREIGN KEY (`paper_id`) REFERENCES `past_year_paper` (`paper_id`),
  ADD CONSTRAINT `premium_user_ibfk_4` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`tutor_id`);

--
-- Constraints for table `study_material`
--
ALTER TABLE `study_material`
  ADD CONSTRAINT `study_material_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
