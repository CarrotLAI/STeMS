-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2023 at 07:12 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stemsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_acc`
--

CREATE TABLE `admin_acc` (
  `id` int(4) NOT NULL,
  `username` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_acc`
--

INSERT INTO `admin_acc` (`id`, `username`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `archived_data`
--

CREATE TABLE `archived_data` (
  `id` int(255) NOT NULL,
  `Student_ID` varchar(24) NOT NULL,
  `Last_Name` text NOT NULL,
  `First_Name` text NOT NULL,
  `Course` varchar(8) NOT NULL,
  `Year` int(4) NOT NULL,
  `Section` char(4) NOT NULL,
  `rf_id` varchar(64) NOT NULL,
  `Temperature` float NOT NULL,
  `date` date NOT NULL,
  `Time` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archived_data`
--

INSERT INTO `archived_data` (`id`, `Student_ID`, `Last_Name`, `First_Name`, `Course`, `Year`, `Section`, `rf_id`, `Temperature`, `date`, `Time`) VALUES
(283, 'CC-19-097', 'daras', 'lester jun', 'BSIT', 1, 'A', '426510', 35.57, '2023-05-03', '03:26 PM'),
(284, 'CC-19-097', 'daras', 'lester jun', 'BSIT', 1, 'A', '426510', 35.53, '2023-05-03', '03:28 PM'),
(285, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 36.43, '2023-05-03', '03:31 PM'),
(287, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 36.43, '2023-05-03', '03:40 PM'),
(290, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 35.83, '2023-05-03', '03:44 PM'),
(291, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 36.73, '2023-05-03', '03:57 PM'),
(292, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 36.11, '2023-05-03', '03:58 PM'),
(293, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 35.57, '2023-05-05', '08:54 AM'),
(294, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 35.35, '2023-05-05', '08:55 AM'),
(295, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', '2440600', 35.75, '2023-05-19', '05:44 AM'),
(297, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', '2440600', 35.21, '2023-05-19', '05:49 AM'),
(298, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', '2440600', 35.91, '2023-05-19', '05:59 AM'),
(299, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', '2440600', 35.15, '2023-05-19', '06:01 AM'),
(300, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 35.49, '2023-05-19', '09:51 AM'),
(301, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', '2440600', 35.51, '2023-05-19', '09:53 AM'),
(302, 'CC-20-007', 'benban', 'catherine', 'BSIT', 1, 'A', '868980', 36.41, '2023-05-19', '11:39 AM'),
(303, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', '2440600', 35.01, '2023-05-19', '11:47 AM'),
(318, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 36.43, '2023-05-03', '03:31 PM'),
(319, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 36.43, '2023-05-03', '03:40 PM'),
(320, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 35.83, '2023-05-03', '03:44 PM'),
(321, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 36.73, '2023-05-03', '03:57 PM'),
(322, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 36.11, '2023-05-03', '03:58 PM'),
(323, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 35.57, '2023-05-05', '08:54 AM'),
(324, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', '426510', 35.35, '2023-05-05', '08:55 AM');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_form`
--

CREATE TABLE `attendance_form` (
  `No.` int(11) NOT NULL,
  `Student_ID` varchar(24) NOT NULL,
  `Last_Name` text NOT NULL,
  `First_Name` text NOT NULL,
  `Course` varchar(8) NOT NULL,
  `Year` int(4) NOT NULL,
  `Section` char(1) NOT NULL,
  `rf_id` int(64) NOT NULL,
  `Temperature` float NOT NULL,
  `Date` date NOT NULL,
  `Time` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_form`
--

INSERT INTO `attendance_form` (`No.`, `Student_ID`, `Last_Name`, `First_Name`, `Course`, `Year`, `Section`, `rf_id`, `Temperature`, `Date`, `Time`) VALUES
(197, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', 2440600, 35.75, '2023-05-19', '05:44 AM'),
(198, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', 2440600, 35.21, '2023-05-19', '05:49 AM'),
(199, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', 2440600, 35.91, '2023-05-19', '05:59 AM'),
(200, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', 2440600, 35.15, '2023-05-19', '06:01 AM'),
(201, 'CC-19-097', 'Perez', 'Herven', 'BSIT', 4, 'B', 426510, 35.49, '2023-05-19', '09:51 AM'),
(202, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', 2440600, 35.51, '2023-05-19', '09:53 AM'),
(203, 'CC-20-007', 'benban', 'catherine', 'BSIT', 1, 'A', 868980, 36.41, '2023-05-19', '11:39 AM'),
(204, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', 2440600, 35.01, '2023-05-19', '11:47 AM');

-- --------------------------------------------------------

--
-- Table structure for table `condition_2`
--

CREATE TABLE `condition_2` (
  `id` int(11) NOT NULL,
  `isfetch` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `condition_2`
--

INSERT INTO `condition_2` (`id`, `isfetch`) VALUES
(0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `id` int(16) NOT NULL,
  `rf_id` varchar(112) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stems_condition`
--

CREATE TABLE `stems_condition` (
  `id` int(11) NOT NULL,
  `isrf_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stems_condition`
--

INSERT INTO `stems_condition` (`id`, `isrf_id`) VALUES
(0, 0),
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(255) NOT NULL,
  `student_id` varchar(11) NOT NULL,
  `rf_id` int(8) NOT NULL,
  `last_name` text NOT NULL,
  `first_name` text NOT NULL,
  `middle_initial` char(4) NOT NULL,
  `sex` text NOT NULL,
  `course` text NOT NULL,
  `year` int(11) NOT NULL,
  `section` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `rf_id`, `last_name`, `first_name`, `middle_initial`, `sex`, `course`, `year`, `section`) VALUES
(153, 'CC-01-971', 7098317, 'kjh', 'kjh', '', 'Male', 'BSIT', 1, 'A'),
(146, 'CC-02-311', 8908621, 'jn', 'kn', '', 'Male', 'BSIT', 1, 'A'),
(144, 'CC-09-097', 90975674, 'kj', 'kjkhj', '', 'Male', 'BSIT', 1, 'A'),
(156, 'CC-18-156', 2440600, 'Cabayao', 'renante', 'L', 'Male', 'BSIT', 4, 'B'),
(142, 'CC-19-081', 1171820, 'Daras', 'Lester Jun', 'L', 'Male', 'BSIT', 4, 'A'),
(129, 'CC-19-097', 426510, 'Perez', 'Herven', 'P', 'Male', 'BSIT', 4, 'B'),
(155, 'CC-19-340', 1223910, 'villacastin', 'carlito', '', 'Male', 'BSIT', 4, 'A'),
(124, 'CC-20-007', 868980, 'benban', 'catherine', 'L', 'Female', 'BSIT', 1, 'A'),
(125, 'CC-20-187', 892780, 'pagtanan', 'regina grace', 'P', 'Female', 'BSIT', 3, 'A'),
(123, 'CC-20-202', 1524210, 'Monares', 'JN', '', 'Male', 'BSIT', 3, 'A'),
(122, 'CC-20-228', 1413410, 'jimenez', 'nino jesry', '', 'Male', 'BSIT', 3, 'B'),
(130, 'CC-20-781', 2147483647, 'sape', 'grape', '', 'Female', 'BSIT', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `student_log`
--

CREATE TABLE `student_log` (
  `No.` int(8) NOT NULL,
  `Student_ID` varchar(11) NOT NULL,
  `Last_Name` text NOT NULL,
  `First_Name` text NOT NULL,
  `Course` varchar(8) NOT NULL,
  `Year` int(4) NOT NULL,
  `Section` char(1) NOT NULL,
  `rf_id` int(64) DEFAULT NULL,
  `Temperature` float NOT NULL,
  `Date` date NOT NULL,
  `Time` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_log`
--

INSERT INTO `student_log` (`No.`, `Student_ID`, `Last_Name`, `First_Name`, `Course`, `Year`, `Section`, `rf_id`, `Temperature`, `Date`, `Time`) VALUES
(304, 'CC-18-156', 'Cabayao', 'renante', 'BSIT', 4, 'B', 2440600, 0, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `temperature_log`
--

CREATE TABLE `temperature_log` (
  `id` int(100) NOT NULL,
  `student_id` varchar(24) NOT NULL,
  `rf_id` varchar(64) NOT NULL,
  `temperature` double NOT NULL,
  `date` date NOT NULL,
  `time` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temperature_log`
--

INSERT INTO `temperature_log` (`id`, `student_id`, `rf_id`, `temperature`, `date`, `time`) VALUES
(3, 'CC-21-189', '1171820', 38.5, '2023-03-19', '838:59:59.999999'),
(4, 'CC-21-189', '1171820', 38.5, '2023-03-19', '00:00:00.000000'),
(13, 'CC-19-097', '426510', 38.33000183105469, '2023-05-03', '03:34 PM'),
(14, 'CC-19-097', '426510', 48.689998626708984, '2023-05-03', '03:43 PM'),
(15, 'CC-18-156', '2440600', 44.90999984741211, '2023-05-19', '05:46 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archived_data`
--
ALTER TABLE `archived_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `rf_id` (`rf_id`);

--
-- Indexes for table `attendance_form`
--
ALTER TABLE `attendance_form`
  ADD PRIMARY KEY (`No.`),
  ADD KEY `rf_id` (`rf_id`) USING BTREE,
  ADD KEY `Student_ID` (`No.`,`Student_ID`);

--
-- Indexes for table `condition_2`
--
ALTER TABLE `condition_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stems_condition`
--
ALTER TABLE `stems_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `UNIQUE` (`id`),
  ADD KEY `rf_id` (`rf_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `student_log`
--
ALTER TABLE `student_log`
  ADD PRIMARY KEY (`No.`),
  ADD UNIQUE KEY `rf_id` (`rf_id`),
  ADD KEY `Student ID` (`Student_ID`);

--
-- Indexes for table `temperature_log`
--
ALTER TABLE `temperature_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `rf_id` (`rf_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `archived_data`
--
ALTER TABLE `archived_data`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `attendance_form`
--
ALTER TABLE `attendance_form`
  MODIFY `No.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `condition_2`
--
ALTER TABLE `condition_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stems_condition`
--
ALTER TABLE `stems_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `student_log`
--
ALTER TABLE `student_log`
  MODIFY `No.` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `temperature_log`
--
ALTER TABLE `temperature_log`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
