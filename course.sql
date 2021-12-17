-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 07:22 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `created_at`, `status`) VALUES
(1, 'Admin', 'cradmin@gmail.com', '202cb962ac59075b964b07152d234b70', '2021-06-13 14:56:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courseenrolls`
--

CREATE TABLE `courseenrolls` (
  `id` int(11) NOT NULL,
  `student_regno` varchar(55) NOT NULL,
  `Student_Dept` varchar(255) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `courseCode` varchar(55) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `courseTeacher` varchar(55) NOT NULL,
  `syllabysVersion` varchar(50) NOT NULL,
  `courseCredit` int(11) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `payment_status` int(10) DEFAULT 0,
  `enrollDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseenrolls`
--

INSERT INTO `courseenrolls` (`id`, `student_regno`, `Student_Dept`, `semester`, `courseCode`, `courseName`, `courseTeacher`, `syllabysVersion`, `courseCredit`, `status`, `payment_status`, `enrollDate`) VALUES
(148, '201', '40', '56', 'CSE 123', 'Computer Algorithm', '100', '', 4, 3, 1, '2021-10-27 22:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `courseCredit` int(11) NOT NULL,
  `coursePlan` varchar(255) NOT NULL,
  `courseTeacher` varchar(55) NOT NULL,
  `syllabus_version` text NOT NULL,
  `dept_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courseCode`, `courseName`, `courseCredit`, `coursePlan`, `courseTeacher`, `syllabus_version`, `dept_id`, `pro_id`, `sem_id`, `status`, `created_at`) VALUES
(72, 'CSE 123', 'Computer Algorithm', 4, '../uploads/course/53f873bdfa.jpg', '100', '46', 40, 42, 56, 1, '2021-10-27 16:37:53'),
(73, 'BBA111', 'Business Fundamental ', 3, '../uploads/course/ced0eb99b9.jpg', '101', '49', 38, 45, 56, 1, '2021-10-27 16:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `created_at`, `status`) VALUES
(38, 'Bachelor of Business Administration', '2021-10-27 16:29:20', 1),
(39, 'Bachelor of Arts', '2021-10-27 16:29:27', 1),
(40, 'Computer Science & Engineering ', '2021-10-27 16:29:55', 1),
(41, 'Civil Engineering ', '2021-10-27 16:30:06', 1),
(42, 'Textile Engineering ', '2021-10-27 16:30:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `student_id` varchar(55) NOT NULL,
  `semesterFee` varchar(55) NOT NULL,
  `waiver` int(11) NOT NULL DEFAULT 0,
  `special_waiver` int(11) DEFAULT 0,
  `gendar_waiver` int(11) DEFAULT 0,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `semesterFee`, `waiver`, `special_waiver`, `gendar_waiver`, `status`, `created_at`) VALUES
(33, '200', '7000', 5, 10, 0, 0, '2021-10-25 15:26:28'),
(34, '201', '7000', 4, 10, 10, 0, '2021-10-25 15:28:08'),
(35, '200', '7000', 5, 10, 0, 0, '2021-10-27 22:40:24'),
(36, '201', '7000', 10, 8, 10, 0, '2021-10-27 22:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `TransactionID` varchar(55) NOT NULL,
  `UserID` varchar(255) NOT NULL,
  `PayCourseID` varchar(255) NOT NULL,
  `payAmount` varchar(55) NOT NULL,
  `PaymentSS` varchar(255) NOT NULL,
  `PayDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `TransactionID`, `UserID`, `PayCourseID`, `payAmount`, `PaymentSS`, `PayDate`) VALUES
(33, '7L617H2ADK', '201', 'SOc111', '9000', '../uploads/0b84e01929.', '2021-10-26 05:15:14'),
(34, '7L617H2ADK', '201', 'SOc111', '9000', '../uploads/0ee047a3dd.', '2021-10-26 05:15:40'),
(35, '7L617H2ADK', '201', 'SOc111', '9000', '../uploads/85b3c92e33.', '2021-10-26 05:17:48'),
(36, '7L617H2ADK', '201', 'SOc111', '9000', '../uploads/70f14eef3f.', '2021-10-26 05:18:33'),
(37, '7L134O82GR', '201', 'SOc111', '9000', '../uploads/e3d20c85f1.', '2021-10-26 05:58:40'),
(38, '7L637H3P47', '201', 'SOc111', '9000', '../uploads/2f4625ed92.', '2021-10-27 06:18:57'),
(39, '8AG10CQHPM', '201', 'SOc111', '9000', '../uploads/800553f7cc.', '2021-10-27 06:20:22'),
(40, '7L617H2ADK', '201', 'CSE 123', '12000', '../uploads/3ebeb0568c.', '2021-10-27 16:46:13'),
(41, '7L667GZXPM', '201', 'CSE 123', '12000', '../uploads/059f2fc15d.jpg', '2021-10-27 16:53:51'),
(42, '8A62QPO4GR', '201', 'CSE 123', '12000', '../uploads/67a8e7174f.', '2021-10-28 09:57:29'),
(43, '7L617H2ADK', '201', 'CSE 123', '12000', '../uploads/37d5a25e6f.', '2021-10-28 09:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_Id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `program_code` varchar(55) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_Id`, `department_id`, `program_code`, `status`, `created_at`) VALUES
(42, 40, 'UG02', 1, '2021-10-27 22:30:50'),
(43, 40, 'PG02', 1, '2021-10-27 22:31:01'),
(44, 38, 'UG03', 1, '2021-10-27 22:31:14'),
(45, 38, 'PG03', 1, '2021-10-27 22:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `semester_name` varchar(50) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `semester_year` year(4) NOT NULL,
  `syl_id` int(11) NOT NULL,
  `start_date` varchar(55) NOT NULL,
  `end_date` varchar(55) NOT NULL,
  `regi_deadline` datetime NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_name`, `dept_id`, `program_id`, `semester_year`, `syl_id`, `start_date`, `end_date`, `regi_deadline`, `status`, `created_at`) VALUES
(55, 'Fall', 40, 42, 2021, 46, '2021-11-01', '2021-12-30', '2021-12-30 00:00:00', 1, '2021-10-27 16:33:40'),
(56, 'Spring', 38, 45, 2022, 49, '2022-01-01', '2022-03-31', '2022-03-31 00:00:00', 1, '2021-10-27 16:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `syllabuses`
--

CREATE TABLE `syllabuses` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `program_code` int(11) NOT NULL,
  `syllabus_version` varchar(55) NOT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syllabuses`
--

INSERT INTO `syllabuses` (`id`, `department_id`, `program_code`, `syllabus_version`, `status`, `created_at`) VALUES
(46, 40, 42, 'Version 1', 1, '2021-10-27 22:31:47'),
(47, 40, 43, 'Version 2', 1, '2021-10-27 22:32:13'),
(48, 38, 44, 'Version 1', 1, '2021-10-27 22:32:32'),
(49, 38, 45, 'Version 2', 1, '2021-10-27 22:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `todolists`
--

CREATE TABLE `todolists` (
  `id` int(11) NOT NULL,
  `topicName` varchar(255) NOT NULL,
  `deadlineDateTime` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todolists`
--

INSERT INTO `todolists` (`id`, `topicName`, `deadlineDateTime`, `status`) VALUES
(63, 'Add teachers data', '2021-10-30 10:28:00', 1),
(64, 'Check enroll student list', '2021-11-01 13:30:00', 1),
(65, 'Add Transaction ID', '2021-10-26 14:30:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactionid`
--

CREATE TABLE `transactionid` (
  `id` int(11) NOT NULL,
  `trnxID` varchar(55) NOT NULL,
  `trnxIdProvider` varchar(55) NOT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactionid`
--

INSERT INTO `transactionid` (`id`, `trnxID`, `trnxIdProvider`, `status`, `created_at`) VALUES
(5, '7L667GZXPM', 'Bkash', 2, '2021-07-06 05:40:51'),
(6, '8AG10CQHPM', 'Bkash', 2, '2021-07-06 05:41:22'),
(8, '8A62QPO4GR', 'Rocket', 2, '2021-07-06 05:42:28'),
(9, '7L134O82GR', 'Rocket', 1, '2021-07-06 05:43:12'),
(10, '7L617H2ADK', 'Nagad', 2, '2021-07-06 05:43:38'),
(12, '7L637H3P47', 'Nagad', 2, '2021-07-06 05:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `gendar` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(55) DEFAULT NULL,
  `userID` varchar(55) DEFAULT NULL,
  `advisor_id` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(10) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `syllabus_version` varchar(55) DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gendar`, `email`, `phone`, `department`, `designation`, `userID`, `advisor_id`, `password`, `user_type`, `photo`, `syllabus_version`, `status`, `created_at`) VALUES
(125, 'Ehsan Chowdhury', 'male', 'ehsan@gmail.com', '01854695428', '38', 'Associate Professor', '100', NULL, '202cb962ac59075b964b07152d234b70', 1, '../uploads/4ca8e6ee56.png', NULL, 1, '2021-10-27 16:35:55'),
(126, 'Himel Hawladar', 'male', 'himel@gmail.com', '0215478965', '40', 'Professor', '101', NULL, '202cb962ac59075b964b07152d234b70', 1, '../uploads/fee20bc772.png', NULL, 1, '2021-10-27 16:36:57'),
(127, 'Shahidul Islam', 'male', 'mdshahidulcse@gmail.com', '01928403658', '38', NULL, '200', NULL, '202cb962ac59075b964b07152d234b70', 2, '../uploads/08a5fffe69.png', '48', 1, '2021-10-27 16:40:24'),
(128, 'Farzana Ferdos', 'female', 'farzana@gmail.com', '01284596574', '40', NULL, '201', NULL, '202cb962ac59075b964b07152d234b70', 2, '../uploads/50cd361e4b.png', '46', 1, '2021-10-27 16:41:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courseenrolls`
--
ALTER TABLE `courseenrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_Id`),
  ADD KEY `department_programs_relation` (`department_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syllabuses`
--
ALTER TABLE `syllabuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_sylla_relation` (`department_id`),
  ADD KEY `programs_sylla_relation` (`program_code`);

--
-- Indexes for table `todolists`
--
ALTER TABLE `todolists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactionid`
--
ALTER TABLE `transactionid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courseenrolls`
--
ALTER TABLE `courseenrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `syllabuses`
--
ALTER TABLE `syllabuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `todolists`
--
ALTER TABLE `todolists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `transactionid`
--
ALTER TABLE `transactionid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `department_programs_relation` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `syllabuses`
--
ALTER TABLE `syllabuses`
  ADD CONSTRAINT `department_sylla_relation` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `programs_sylla_relation` FOREIGN KEY (`program_code`) REFERENCES `programs` (`program_Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
