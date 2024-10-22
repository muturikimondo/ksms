-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2024 at 01:37 PM
-- Server version: 9.0.1
-- PHP Version: 8.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smsweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `county` varchar(100) NOT NULL,
  `home_address` text,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `upload_photo` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `date_of_admission` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `name`, `date_of_birth`, `gender`, `county`, `home_address`, `phone`, `email`, `upload_photo`, `category`, `date_of_admission`) VALUES
(1, 'Muturi Kimondo', '1908-10-10', 'Male', 'Laikipia', '1234', '0900989898', 'jgatweku@gmail.com', 'muturi.jpeg', 'Student', '2009-01-01'),
(2, 'Muguthi', '1988-12-10', 'Female', 'Nakuru', '1234', '0800989898', 'muguthi@yahoo.com', 'deputy_Governor-removebg-preview.png', 'Student', NULL),
(3, 'Kagotho Kennedy Kigondu', '2007-09-02', 'Male', 'Laikipia', '1234', '0800989898', 'kagotho@yahoo.com', 'muturi.webp', 'Admin', '2025-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int NOT NULL,
  `class_level` varchar(20) DEFAULT NULL,
  `stream` varchar(20) DEFAULT NULL,
  `class_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_level`, `stream`, `class_name`) VALUES
(2, 'Form 1', 'East', 'Form 1 East'),
(3, 'Form 1', 'West', 'Form 1 West'),
(4, 'Form 1', 'North', 'Form 1 North'),
(5, 'Form 1', 'South', 'Form 1 South'),
(6, 'Form 2', 'North', 'Form 2 North');

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `id` int NOT NULL,
  `exam_type` varchar(50) NOT NULL,
  `exam_month` varchar(20) NOT NULL,
  `exam_year` year NOT NULL,
  `exam_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`id`, `exam_type`, `exam_month`, `exam_year`, `exam_name`) VALUES
(1, 'CAT', 'February', '2024', 'CAT - February 2024'),
(2, 'CAT', 'January', '2024', 'CAT - January 2024');

-- --------------------------------------------------------

--
-- Table structure for table `exam_subject_scores`
--

CREATE TABLE `exam_subject_scores` (
  `id` int NOT NULL,
  `examination` varchar(100) NOT NULL,
  `class_entered` varchar(100) NOT NULL,
  `subject_entered` varchar(100) NOT NULL,
  `Student_regno` varchar(50) NOT NULL,
  `student_marks` int DEFAULT NULL,
  `date_entered` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `exam_subject_scores`
--

INSERT INTO `exam_subject_scores` (`id`, `examination`, `class_entered`, `subject_entered`, `Student_regno`, `student_marks`, `date_entered`) VALUES
(1, 'CAT - February 2024', 'Form 1 West', '1', '789', 36, '2024-10-22 10:11:42'),
(2, 'CAT - February 2024', 'Form 1 North', '1', '790', 32, '2024-10-22 10:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `students_admission`
--

CREATE TABLE `students_admission` (
  `id` int NOT NULL,
  `admission_number` varchar(50) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `class_admitted` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students_admission`
--

INSERT INTO `students_admission` (`id`, `admission_number`, `student_email`, `class_admitted`) VALUES
(1, '789', 'jgatweku@gmail.com', 'Form 1 West'),
(2, '790', 'kagotho@yahoo.com', 'Form 1 North'),
(3, '791', 'muguthi@yahoo.com', 'Form 1 South');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject_group` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `code`, `name`, `subject_group`) VALUES
(1, '100', 'Mathematics', 'Regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_name` (`class_name`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_exam` (`exam_type`,`exam_month`,`exam_year`),
  ADD UNIQUE KEY `exam_name` (`exam_name`);

--
-- Indexes for table `exam_subject_scores`
--
ALTER TABLE `exam_subject_scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_score` (`examination`,`class_entered`,`subject_entered`,`Student_regno`),
  ADD KEY `class_entered` (`class_entered`);

--
-- Indexes for table `students_admission`
--
ALTER TABLE `students_admission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_email` (`student_email`),
  ADD KEY `class_admitted` (`class_admitted`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_subject_scores`
--
ALTER TABLE `exam_subject_scores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students_admission`
--
ALTER TABLE `students_admission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_subject_scores`
--
ALTER TABLE `exam_subject_scores`
  ADD CONSTRAINT `exam_subject_scores_ibfk_1` FOREIGN KEY (`examination`) REFERENCES `examinations` (`exam_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_subject_scores_ibfk_2` FOREIGN KEY (`class_entered`) REFERENCES `classes` (`class_name`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `students_admission`
--
ALTER TABLE `students_admission`
  ADD CONSTRAINT `students_admission_ibfk_1` FOREIGN KEY (`class_admitted`) REFERENCES `classes` (`class_name`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
