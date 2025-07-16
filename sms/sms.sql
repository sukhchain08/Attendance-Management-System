-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql312.infinityfree.com
-- Generation Time: May 15, 2025 at 06:43 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `sr_no` int(11) NOT NULL,
  `uid` int(6) NOT NULL,
  `password` varchar(15) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `admin_number` bigint(10) NOT NULL,
  `admin_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`sr_no`, `uid`, `password`, `admin_name`, `admin_number`, `admin_email`) VALUES
(1, 991155, 'sukh@098', 'Sukhchain Singh', 9914905575, 'karirsukhchain122@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `sr_no` int(11) NOT NULL,
  `student_name` varchar(40) NOT NULL,
  `date` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  `semester` int(20) NOT NULL,
  `student_number` bigint(10) NOT NULL,
  `teacher_number` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_info`
--

CREATE TABLE `course_info` (
  `sr_no` int(11) NOT NULL,
  `course_name` varchar(10) NOT NULL,
  `course_id` int(20) NOT NULL,
  `total_semester` int(10) NOT NULL,
  `course_duration` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_info`
--

INSERT INTO `course_info` (`sr_no`, `course_name`, `course_id`, `total_semester`, `course_duration`) VALUES
(1, 'BCA', 0, 6, '3 Year');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `sr_no` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `course` varchar(50) NOT NULL,
  `subject1` int(3) NOT NULL,
  `subject2` int(3) NOT NULL,
  `subject3` int(3) NOT NULL,
  `publish_date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `sr_no` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_father_name` varchar(50) NOT NULL,
  `student_number` bigint(10) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_password` varchar(30) NOT NULL,
  `student_course` varchar(30) NOT NULL,
  `student_semester` int(20) NOT NULL,
  `student_dob` varchar(11) NOT NULL,
  `student_gender` varchar(8) NOT NULL,
  `student_address` varchar(150) NOT NULL,
  `student_alt_number` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`sr_no`, `student_name`, `student_father_name`, `student_number`, `student_email`, `student_password`, `student_course`, `student_semester`, `student_dob`, `student_gender`, `student_address`, `student_alt_number`) VALUES
(1, 'Sukhchain Singh', 'Sukhjinder Singh', 9914905575, 'karirsukhchain122@gmail.com', '232020', 'BCA', 0, '2005-10-08', 'Male', 'Kapurthala', 9914905575);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sr_no` int(11) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `subject_full_name` varchar(150) NOT NULL,
  `subject_short_name` varchar(50) NOT NULL,
  `subject_code` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `sr_no` int(11) NOT NULL,
  `teacher_name` varchar(40) NOT NULL,
  `teacher_number` bigint(10) NOT NULL,
  `teacher_email` varchar(100) NOT NULL,
  `teacher_password` varchar(30) NOT NULL,
  `teacher_course` varchar(50) NOT NULL,
  `teacher_course_1` varchar(10) NOT NULL,
  `teacher_course_2` varchar(10) NOT NULL,
  `teacher_course_3` varchar(10) NOT NULL,
  `teacher_gender` varchar(6) NOT NULL,
  `teacher_dob` varchar(15) NOT NULL,
  `teacher_address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`sr_no`, `teacher_name`, `teacher_number`, `teacher_email`, `teacher_password`, `teacher_course`, `teacher_course_1`, `teacher_course_2`, `teacher_course_3`, `teacher_gender`, `teacher_dob`, `teacher_address`) VALUES
(1, 'Sukhchain Singh ', 9914905575, 'karirsukhchain122@gmail.com', '232020', 'BCA', '', '', '', 'Male', '2005-10-08', 'Kapurthala');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `sr_no` int(11) NOT NULL,
  `teacher_course` varchar(50) NOT NULL,
  `teacher_number` bigint(10) NOT NULL,
  `subject1` varchar(150) NOT NULL,
  `subject2` varchar(150) NOT NULL,
  `subject3` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`sr_no`, `teacher_course`, `teacher_number`, `subject1`, `subject2`, `subject3`) VALUES
(1, 'BCA', 9914905575, 'Information Technology', 'Programming in C++', 'Data Structure and Algorithm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `course_info`
--
ALTER TABLE `course_info`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_info`
--
ALTER TABLE `course_info`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher_info`
--
ALTER TABLE `teacher_info`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
