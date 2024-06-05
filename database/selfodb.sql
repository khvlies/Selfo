-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 05:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `selfodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_notes`
--

CREATE TABLE `additional_notes` (
  `addN_id` int(11) NOT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `pdf_link` varchar(2083) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(20) DEFAULT NULL,
  `admin_password` varchar(8) DEFAULT NULL,
  `admin_phone` varchar(15) DEFAULT NULL,
  `admin_email` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_password`, `admin_phone`, `admin_email`) VALUES
(1, 'admin1', 'ad01', '0136409816', 'admin1@gmail.com'),
(2, 'admin2', 'ad02', '0118906654', 'admin2@gmail.com'),
(3, 'admin3', 'ad03', '0179527791', 'admin3@gmail.com'),
(4, 'admin4', 'ad04', '0128805632', 'admin4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `basic_user`
--

CREATE TABLE `basic_user` (
  `basic_id` int(11) NOT NULL,
  `basic_name` varchar(30) DEFAULT NULL,
  `basic_password` varchar(8) DEFAULT NULL,
  `basic_phone` varchar(15) DEFAULT NULL,
  `basic_email` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basic_user`
--

INSERT INTO `basic_user` (`basic_id`, `basic_name`, `basic_password`, `basic_phone`, `basic_email`) VALUES
(1, 'Mohd Iqbal', 'bal080', '0122964080', 'iqbal@gmail.com'),
(2, 'Mohd Idham', 'idhm729', '0145562729', 'idham@gmail.com'),
(3, 'Nur Sakinah', 'nur114', '01165710114', 'sakinah@gmail.com'),
(4, 'Elly Elysha', 'sha505', '0163531505', 'elly@gmail.com'),
(5, 'Mohd Iskandar', 'iskndr07', '0174769707', 'iskandar@gmail.com'),
(6, 'Danial Aiman', 'dani862', '0182408862', 'aiman@gmail.com'),
(7, 'Ainul Aiza', 'ainul106', '0154216106', 'ainul@gmail.com'),
(8, 'Syafirah Adira', 'ira349', '0109257349', 'adira@gmail.com'),
(9, 'Ain Nadira', 'ain053', '0194865053', 'ainnad@gmail.com'),
(10, 'Wan Syarmila', 'wan697', '0102639697', 'syarmila@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `online_session`
--

CREATE TABLE `online_session` (
  `online_id` int(11) NOT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `pdf_link` varchar(2083) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `past_year_paper`
--

CREATE TABLE `past_year_paper` (
  `paper_id` int(11) NOT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `paper` varchar(2083) DEFAULT NULL,
  `answer` varchar(2083) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `premium_user`
--

CREATE TABLE `premium_user` (
  `premium_id` int(11) NOT NULL,
  `premium_name` varchar(30) DEFAULT NULL,
  `premium_password` varchar(8) DEFAULT NULL,
  `premium_phone` varchar(15) DEFAULT NULL,
  `premium_email` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `premium_user`
--

INSERT INTO `premium_user` (`premium_id`, `premium_name`, `premium_password`, `premium_phone`, `premium_email`) VALUES
(1, 'Syuhada Natasya', 'syu123', '0145678367', 'syuhada@gmail.com'),
(2, 'Amir Hilman', 'amir2324', '0128907765', 'hilman@gmail.com'),
(3, 'Raysha Maheera', 'ray456', '0102334478', 'raysha@gmail.com'),
(4, 'Andau Yasun', 'yasun926', '0136729926', 'andau@gmail.com'),
(5, 'Zhang Wei', 'wei169', '011571169', 'zhangwei@gmail.com'),
(6, 'Syed Haikal', 'syed462', '0199892462', 'haikal@gmail.com'),
(7, 'Azhar Matusin', 'azhar484', '0195016484', 'azhar@gmail.com'),
(8, 'Mohd Hardy', 'hardy331', '01578442331', 'hardy@gmail.com'),
(9, 'Ishita Anala', 'nala172', '0170541172', 'anala@gmail.com'),
(10, 'Daniel Hakim', 'kim458', '0179781458', 'daniel@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `study_material`
--

CREATE TABLE `study_material` (
  `study_id` int(11) NOT NULL,
  `course_code` varchar(7) DEFAULT NULL,
  `pdf_link` varchar(2083) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tutor_id` int(11) NOT NULL,
  `tutor_name` varchar(30) DEFAULT NULL,
  `tutor_password` varchar(8) DEFAULT NULL,
  `tutor_phone` varchar(15) DEFAULT NULL,
  `tutor_email` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutor_id`, `tutor_name`, `tutor_password`, `tutor_phone`, `tutor_email`) VALUES
(1, 'Siti Bahiyah', 'sitiB246', '0115639246', 'sbahiyah@gmail.com'),
(2, 'Ayu Nurili', 'ayu854', '0194296854', 'ayu@gmail.com'),
(3, 'Abdul Rahman', 'abd261', '0167133261', 'abdrhmn@gmail.com'),
(4, 'Zakaria Hamdan', 'hmd771', '0174909771', 'zakaria@gmail.com'),
(5, 'Hasan Bakhtiar', 'bakh593', '012872593', 'hasan@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_notes`
--
ALTER TABLE `additional_notes`
  ADD PRIMARY KEY (`addN_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `basic_user`
--
ALTER TABLE `basic_user`
  ADD PRIMARY KEY (`basic_id`);

--
-- Indexes for table `online_session`
--
ALTER TABLE `online_session`
  ADD PRIMARY KEY (`online_id`);

--
-- Indexes for table `past_year_paper`
--
ALTER TABLE `past_year_paper`
  ADD PRIMARY KEY (`paper_id`);

--
-- Indexes for table `premium_user`
--
ALTER TABLE `premium_user`
  ADD PRIMARY KEY (`premium_id`);

--
-- Indexes for table `study_material`
--
ALTER TABLE `study_material`
  ADD PRIMARY KEY (`study_id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tutor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_notes`
--
ALTER TABLE `additional_notes`
  MODIFY `addN_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `basic_user`
--
ALTER TABLE `basic_user`
  MODIFY `basic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `online_session`
--
ALTER TABLE `online_session`
  MODIFY `online_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `past_year_paper`
--
ALTER TABLE `past_year_paper`
  MODIFY `paper_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `premium_user`
--
ALTER TABLE `premium_user`
  MODIFY `premium_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `study_material`
--
ALTER TABLE `study_material`
  MODIFY `study_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `tutor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
