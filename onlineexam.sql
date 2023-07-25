-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2022 at 08:54 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mobile`, `email`, `pass`, `status`) VALUES
(1, 'Labid\r\n', '01611187733', 'labiddbzg@gmail.com', '123456', 1),
(2, 'susmita', '1312233626', 'susmita123@gmail.com', '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `question_mark` int(11) DEFAULT NULL,
  `total_mark` int(11) DEFAULT NULL,
  `total_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `semester_id`, `subject_id`, `name`, `status`, `admin_id`, `duration`, `question_mark`, `total_mark`, `total_question`) VALUES
(2, 1, 1, 'MID 2022', 1, 1, 2, 1, 3, 3),
(3, 1, 6, 'class test 1', 1, 1, NULL, 0, 0, 0),
(4, 1, 1, 'aassdd', 1, 1, 3, 2, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `meritlist`
--

CREATE TABLE `meritlist` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `examid` int(11) NOT NULL,
  `semesterid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pdf`
--

CREATE TABLE `pdf` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pdf`
--

INSERT INTO `pdf` (`id`, `semester_id`, `subject_id`, `exam_id`, `title`, `pdf_file`, `status`, `admin_id`) VALUES
(4, 1, 1, 2, 'asdfg', '2022_05_28_1653719874_728f.pdf', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `des` text NOT NULL,
  `op1` text NOT NULL,
  `op2` text NOT NULL,
  `op3` text NOT NULL,
  `op4` text NOT NULL,
  `ans` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `exam_id`, `des`, `op1`, `op2`, `op3`, `op4`, `ans`, `status`) VALUES
(1, 2, 'what is capital of Bangladesh ?', 'Dhaka', 'Rajshahi', 'Khulna', 'Barishal', 'a', 1),
(2, 2, 'what is capital of India ?', 'Kolkata', 'Dilli', 'Mumbai', 'Goa', 'b', 1),
(3, 2, 'what is capital of America?', 'Yashington', 'Losangels', 'city 3', 'city 4', 'a', 1),
(4, 3, 'what is the capital city of bangladesh?', 'Dhaka', 'Rajshahi', 'Khulna', 'Barishal', 'a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `sl` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `correct_ans` varchar(10) DEFAULT NULL,
  `given_ans` varchar(10) DEFAULT NULL,
  `question_mark` varchar(10) NOT NULL,
  `sts` varchar(10) NOT NULL COMMENT '0 = no action, 1 = correct ans, 2 = wrong ans, 3 = skiped, 4 = blank ans',
  `unique_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `sl`, `student_id`, `exam_id`, `question_id`, `correct_ans`, `given_ans`, `question_mark`, `sts`, `unique_code`) VALUES
(1, 1, 3, 2, 1, 'a', '0', '0', '0', '1653605791_3_517'),
(2, 2, 3, 2, 2, 'b', '0', '0', '0', '1653605791_3_517'),
(3, 3, 3, 2, 3, 'a', '0', '0', '0', '1653605791_3_517'),
(4, 1, 3, 2, 1, 'a', '0', '0', '0', '1653606023_3_308'),
(5, 2, 3, 2, 2, 'b', '0', '0', '0', '1653606023_3_308'),
(6, 3, 3, 2, 3, 'a', '0', '0', '0', '1653606023_3_308'),
(7, 1, 3, 2, 1, 'a', '0', '0', '0', '1653606346_3_484'),
(8, 2, 3, 2, 2, 'b', '0', '0', '0', '1653606346_3_484'),
(9, 3, 3, 2, 3, 'a', '0', '0', '0', '1653606346_3_484'),
(10, 1, 3, 2, 1, 'a', '0', '0', '0', '1653606393_3_190'),
(11, 2, 3, 2, 2, 'b', '0', '0', '0', '1653606393_3_190'),
(12, 3, 3, 2, 3, 'a', '0', '0', '0', '1653606393_3_190'),
(13, 1, 3, 2, 1, 'a', 'a', '1', '1', '1653606577_3_777'),
(14, 2, 3, 2, 2, 'b', 'a', '0', '2', '1653606577_3_777'),
(15, 3, 3, 2, 3, 'a', 'b', '0', '2', '1653606577_3_777'),
(16, 1, 3, 3, 4, 'a', 'c', '0', '2', '1653607756_3_464'),
(17, 1, 3, 2, 1, 'a', 'a', '1', '1', '1653607767_3_753'),
(18, 2, 3, 2, 2, 'b', 'b', '1', '1', '1653607767_3_753'),
(19, 3, 3, 2, 3, 'a', 'a', '1', '1', '1653607767_3_753'),
(20, 1, 3, 2, 1, 'a', 'a', '1', '1', '1653702782_3_913'),
(21, 2, 3, 2, 2, 'b', 'c', '0', '2', '1653702782_3_913'),
(22, 3, 3, 2, 3, 'a', 'a', '1', '1', '1653702782_3_913'),
(23, 1, 3, 2, 1, 'a', 'b', '0', '2', '1653705563_3_997'),
(24, 2, 3, 2, 2, 'b', 'c', '0', '2', '1653705563_3_997'),
(25, 3, 3, 2, 3, 'a', 'b', '0', '2', '1653705563_3_997'),
(26, 1, 3, 3, 4, 'a', '0', '0', '0', '1653705789_3_713'),
(27, 1, 3, 2, 1, 'a', 'b', '0', '2', '1653705842_3_944'),
(28, 2, 3, 2, 2, 'b', 'a', '0', '2', '1653705842_3_944'),
(29, 3, 3, 2, 3, 'a', 'd', '0', '2', '1653705842_3_944');

-- --------------------------------------------------------

--
-- Table structure for table `result_summery`
--

CREATE TABLE `result_summery` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `total_mark` varchar(10) NOT NULL,
  `your_mark` varchar(10) NOT NULL,
  `sts` int(11) NOT NULL,
  `unique_code` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result_summery`
--

INSERT INTO `result_summery` (`id`, `student_id`, `exam_id`, `total_mark`, `your_mark`, `sts`, `unique_code`, `created_at`, `semester_id`, `subject_id`) VALUES
(1, 3, 2, '3', '0', 0, '1653605791_3_517', '2022-05-27', 1, 1),
(2, 3, 2, '3', '0', 0, '1653606023_3_308', '2022-05-27', 1, 1),
(3, 3, 2, '3', '0', 0, '1653606346_3_484', '2022-05-27', 1, 1),
(4, 3, 2, '3', '0', 0, '1653606393_3_190', '2022-05-27', 1, 1),
(5, 3, 2, '3', '1', 1, '1653606577_3_777', '2022-05-27', 1, 1),
(6, 3, 3, '0', '0', 1, '1653607756_3_464', '2022-05-27', 1, 6),
(7, 3, 2, '3', '3', 1, '1653607767_3_753', '2022-05-27', 1, 1),
(8, 3, 2, '3', '2', 1, '1653702782_3_913', '2022-05-28', 1, 1),
(9, 3, 2, '3', '0', 1, '1653705563_3_997', '2022-05-28', 1, 1),
(10, 3, 3, '0', '0', 1, '1653705789_3_713', '2022-05-28', 1, 6),
(11, 3, 2, '3', '0', 1, '1653705842_3_944', '2022-05-28', 1, 1),
(12, 3, 4, '10', '0', 1, '1653720165_3_636', '2022-05-28', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `name`, `status`, `admin_id`) VALUES
(1, '2-2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `phoneno` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `studentid`, `name`, `dept`, `phoneno`, `email`, `pass`, `address`, `status`) VALUES
(1, 123, 'Amzad Hossain', 'CSE', '01862727878', 'amzad@gmail.com', '112233', 'Dhaka, Bangladesh.', 1),
(2, 144, 'Sojib Ahmed', 'CSE', '01610203040', 'sojib@gmail.com', '1999', 'Dhaka', 1),
(3, 899, 'Saiful', 'CSE', '01911103525', 'saiful@gmail.com', '123', 'Dhaka', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `semester_id`, `name`, `status`, `admin_id`) VALUES
(1, 1, 'Data Structures and Algorithms', 1, 1),
(2, 1, 'Theory of Computation', 1, 1),
(3, 1, 'Database', 1, 1),
(4, 2, 'OOP', 1, 1),
(5, 2, 'Discrete Mathmatics', 1, 1),
(6, 1, 'compiler', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vdo`
--

CREATE TABLE `vdo` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vdo`
--

INSERT INTO `vdo` (`id`, `semester_id`, `subject_id`, `exam_id`, `title`, `url`, `status`, `admin_id`) VALUES
(1, 1, 1, 2, 'first vdo', 'OB4xAQSU3Rw', 1, 1),
(2, 1, 2, 3, 'dfdsfdsf', 'fAAZixBzIAI', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meritlist`
--
ALTER TABLE `meritlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_summery`
--
ALTER TABLE `result_summery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vdo`
--
ALTER TABLE `vdo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200101076;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meritlist`
--
ALTER TABLE `meritlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pdf`
--
ALTER TABLE `pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `result_summery`
--
ALTER TABLE `result_summery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vdo`
--
ALTER TABLE `vdo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
