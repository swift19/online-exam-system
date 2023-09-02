-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 02:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `mobile`, `email`, `pass`, `status`, `image`) VALUES
(1, 'admin', 'Teacher 1', '9354123456', 'admin@mail.com', 'admin', 1, 0x6173736574732f696d616765732f75736572732f746561636865722e6a7067),
(2, 'test', 'Teacher 2', '9354804461', 'test@mail.com', 'test', 1, '');

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
(6, 4, 8, 'BIOLOGY | FINAL EXAM', 1, 1, 5, 1, 1, 10),
(7, 4, 9, 'CHEMISTRY 101 | FINAL EXAM', 1, 1, 3, 5, 5, 5),
(10, 4, 10, 'PHYSICS 201', 1, 1, 1, 1, 1, 3),
(11, 4, 8, 'BIOLOGY | MIDTERM', 1, 1, 5, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `experiment`
--

CREATE TABLE `experiment` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experiment`
--

INSERT INTO `experiment` (`id`, `subject_id`, `name`, `url`, `status`, `admin_id`) VALUES
(1, 8, 'Density', 'https://phet.colorado.edu/sims/html/density/latest/density_en.html', 1, 1),
(4, 9, 'Volcano Experiment', './volcano/index.html', 1, 1),
(5, 10, 'Energy Skate Park', 'https://phet.colorado.edu/sims/html/energy-skate-park/latest/energy-skate-park_en.html', 1, 1),
(6, 9, 'State of matter', 'https://phet.colorado.edu/sims/html/states-of-matter-basics/latest/states-of-matter-basics_en.html', 1, 1);

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
(6, 4, 8, 6, 'CEB Scan Report', '2023_08_07_1691396829_5641.pdf', 1, 1),
(7, 4, 9, 7, 'CEB CheckmarX Report', '2023_08_07_1691396882_384).pdf', 1, 1);

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
(6, 6, 'The net effect of photosynthesis, chemically, is reduction, leading to the formation of which products?', 'Carbon dioxide and carbohydrates', 'Carbon dioxide and protein', 'Oxygen and carbohydrates', 'Oxygen and ATP', 'c', 1),
(7, 6, 'A cell membrane is', 'Permeable', 'Semipermeable', 'Nonpermeable', 'None of the above.', 'b', 1),
(8, 6, 'A cell uses which of the following to accelerate chemical reactions enabling its metabolic machinery to operate?', 'Centrasome', 'Lysosome', 'Golgi apparatus', 'Enzymes', 'd', 1),
(9, 6, 'Which of the following is not part of the metabolic sequence?', 'Photosynthesis', 'Respiration', 'Hydoplasm', 'Digestion', 'c', 1),
(10, 6, 'Which of the following are NOT organelles found in animal cells?', 'Nucleus and golgi apparatus', 'Cellular membrane and cytoplasm', 'Mitochondria and ribosomes', 'Chloroplast and central vacuole', 'd', 1),
(11, 6, 'Light initiates different types of cellular reactions. Which of the following responses to light converts the energy from light into a gain of potential energy?', 'Phototaxis', 'Photoperiodism', 'Photosynthesis', 'All of the above', 'c', 1),
(12, 6, 'The functional unit of heredity is the ____________', 'Gene', 'Chromosome', 'Protein', 'Nucleus', 'a', 1),
(13, 6, 'DNA exists in the form of __________ strands of DNA coiled about each other', 'Double', 'Triple', 'Quadruple', 'Quintuple', 'a', 1),
(14, 6, 'Genes are located within the cytoplasm of the cell.', 'Nucleus', 'Mitochondria', 'Cytoplasm', 'Endoplasmic reticulum', 'a', 1),
(15, 6, 'Genetic information is transferred from the nucleus to cytoplasm by way of _______________.', 'Hydrochloric acid', 'Dexyribonucleic acid', 'Ribonucleic acid', 'Amino acid', 'c', 1),
(16, 6, 'When sexual reproduction occurs in multicellular organisms, a process takes place before cells fuse whereby a cell is left with half of its chromosomes, enabling the creation of a cell with a characteristic chromosome number. What is this process called?', 'Osmosis', 'Meiosis', 'Anabolism', 'Differentiation', 'b', 1),
(17, 7, 'The correct formula for aluminum nitrate is', 'Al3N2', 'Al3(NO3)', 'Al(NO2)3', 'Al(NO3)3', 'd', 1),
(18, 7, 'A substance releases heat when it changes from', 'liquid to solid', 'solid to gas', 'liquid to gas', 'solid to liquid', 'a', 1),
(19, 7, 'Given the balanced equation: 2H2(g) + O2(g) --> 2H2O(l) How many grams of H2O are formed if 9.00 mol H2(g) reacts completely with an excess of O2(g)?  The molar mass of H2O is 18.0g/mol.', '18.0g', '36.0g', '81.0g', '162g', 'd', 1),
(20, 7, 'Which element has exactly five electrons in the highest principal energy level (the outer shell)?', 'Se', 'Ba', 'P', 'Ge', 'c', 1),
(21, 7, 'Which element is a metal?', 'Se (atomic number = 34)', 'Co (atomic number = 27)', 'C (atomic number = 6)', 'Br (atomic number = 35)', 'b', 1),
(22, 7, 'What volume of 1.5M NaOH is needed to provide 0.75 mol of NaOH?', '500L', '5.0 L', '500 mL', '0.75 L', 'c', 1),
(23, 8, 'Question 1 here', 'answer 1', 'answer 2', 'answer 3', 'answer 4', 'a', 1),
(24, 8, 'Question 2 here', ' answer a', ' answer b', ' answer c', ' answer d', '', 1),
(25, 9, 'Question 1', 'answer A', 'answer B', 'answer C', 'answer D', 'a', 1),
(26, 9, 'Question 2', 'test a', 'test b', 'test c', 'test d', 'd', 1),
(27, 10, 'Question 1 here', 'answer A', 'answer B', 'answer C', 'answer D', 'a', 1),
(28, 10, 'Question 2', 'type A', 'type B', 'type C', 'type D', 'd', 1),
(29, 10, 'testing 3', 'test 1', 'test 2', 'test 3', 'test 4', 'd', 1);

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
(37, 1, 8, 6, 6, 'c', '0', '0', '0', '1691385761_8_577'),
(38, 2, 8, 6, 7, 'b', '0', '0', '0', '1691385761_8_577'),
(39, 3, 8, 6, 8, 'd', '0', '0', '0', '1691385761_8_577'),
(40, 4, 8, 6, 9, 'c', '0', '0', '0', '1691385761_8_577'),
(41, 5, 8, 6, 10, 'd', '0', '0', '0', '1691385761_8_577'),
(42, 6, 8, 6, 11, 'c', '0', '0', '0', '1691385761_8_577'),
(43, 7, 8, 6, 12, 'a', '0', '0', '0', '1691385761_8_577'),
(44, 8, 8, 6, 13, 'a', '0', '0', '0', '1691385761_8_577'),
(45, 9, 8, 6, 14, 'a', '0', '0', '0', '1691385761_8_577'),
(46, 10, 8, 6, 15, 'c', '0', '0', '0', '1691385761_8_577'),
(47, 11, 8, 6, 16, 'b', '0', '0', '0', '1691385761_8_577'),
(48, 1, 8, 6, 6, 'c', '0', '0', '0', '1691385827_8_283'),
(49, 2, 8, 6, 7, 'b', '0', '0', '0', '1691385827_8_283'),
(50, 3, 8, 6, 8, 'd', '0', '0', '0', '1691385827_8_283'),
(51, 4, 8, 6, 9, 'c', '0', '0', '0', '1691385827_8_283'),
(52, 5, 8, 6, 10, 'd', '0', '0', '0', '1691385827_8_283'),
(53, 6, 8, 6, 11, 'c', '0', '0', '0', '1691385827_8_283'),
(54, 7, 8, 6, 12, 'a', '0', '0', '0', '1691385827_8_283'),
(55, 8, 8, 6, 13, 'a', '0', '0', '0', '1691385827_8_283'),
(56, 9, 8, 6, 14, 'a', '0', '0', '0', '1691385827_8_283'),
(57, 10, 8, 6, 15, 'c', '0', '0', '0', '1691385827_8_283'),
(58, 11, 8, 6, 16, 'b', '0', '0', '0', '1691385827_8_283'),
(59, 1, 8, 6, 6, 'c', '0', '0', '0', '1691385844_8_343'),
(60, 2, 8, 6, 7, 'b', '0', '0', '0', '1691385844_8_343'),
(61, 3, 8, 6, 8, 'd', '0', '0', '0', '1691385844_8_343'),
(62, 4, 8, 6, 9, 'c', '0', '0', '0', '1691385844_8_343'),
(63, 5, 8, 6, 10, 'd', '0', '0', '0', '1691385844_8_343'),
(64, 6, 8, 6, 11, 'c', '0', '0', '0', '1691385844_8_343'),
(65, 7, 8, 6, 12, 'a', '0', '0', '0', '1691385844_8_343'),
(66, 8, 8, 6, 13, 'a', '0', '0', '0', '1691385844_8_343'),
(67, 9, 8, 6, 14, 'a', '0', '0', '0', '1691385844_8_343'),
(68, 10, 8, 6, 15, 'c', '0', '0', '0', '1691385844_8_343'),
(69, 11, 8, 6, 16, 'b', '0', '0', '0', '1691385844_8_343'),
(70, 1, 8, 6, 6, 'c', '0', '0', '0', '1691385904_8_770'),
(71, 2, 8, 6, 7, 'b', '0', '0', '0', '1691385904_8_770'),
(72, 3, 8, 6, 8, 'd', '0', '0', '0', '1691385904_8_770'),
(73, 4, 8, 6, 9, 'c', '0', '0', '0', '1691385904_8_770'),
(74, 5, 8, 6, 10, 'd', '0', '0', '0', '1691385904_8_770'),
(75, 6, 8, 6, 11, 'c', '0', '0', '0', '1691385904_8_770'),
(76, 7, 8, 6, 12, 'a', '0', '0', '0', '1691385904_8_770'),
(77, 8, 8, 6, 13, 'a', '0', '0', '0', '1691385904_8_770'),
(78, 9, 8, 6, 14, 'a', '0', '0', '0', '1691385904_8_770'),
(79, 10, 8, 6, 15, 'c', '0', '0', '0', '1691385904_8_770'),
(80, 11, 8, 6, 16, 'b', '0', '0', '0', '1691385904_8_770'),
(81, 1, 8, 6, 6, 'c', '0', '0', '0', '1691385904_8_770'),
(82, 2, 8, 6, 7, 'b', '0', '0', '0', '1691385904_8_770'),
(83, 3, 8, 6, 8, 'd', '0', '0', '0', '1691385904_8_770'),
(84, 4, 8, 6, 9, 'c', '0', '0', '0', '1691385904_8_770'),
(85, 5, 8, 6, 10, 'd', '0', '0', '0', '1691385904_8_770'),
(86, 6, 8, 6, 11, 'c', '0', '0', '0', '1691385904_8_770'),
(87, 7, 8, 6, 12, 'a', '0', '0', '0', '1691385904_8_770'),
(88, 8, 8, 6, 13, 'a', '0', '0', '0', '1691385904_8_770'),
(89, 9, 8, 6, 14, 'a', '0', '0', '0', '1691385904_8_770'),
(90, 10, 8, 6, 15, 'c', '0', '0', '0', '1691385904_8_770'),
(91, 11, 8, 6, 16, 'b', '0', '0', '0', '1691385904_8_770'),
(92, 1, 8, 6, 6, 'c', '0', '0', '0', '1691385904_8_770'),
(93, 2, 8, 6, 7, 'b', '0', '0', '0', '1691385904_8_770'),
(94, 3, 8, 6, 8, 'd', '0', '0', '0', '1691385904_8_770'),
(95, 4, 8, 6, 9, 'c', '0', '0', '0', '1691385904_8_770'),
(96, 5, 8, 6, 10, 'd', '0', '0', '0', '1691385904_8_770'),
(97, 6, 8, 6, 11, 'c', '0', '0', '0', '1691385904_8_770'),
(98, 7, 8, 6, 12, 'a', '0', '0', '0', '1691385904_8_770'),
(99, 8, 8, 6, 13, 'a', '0', '0', '0', '1691385904_8_770'),
(100, 9, 8, 6, 14, 'a', '0', '0', '0', '1691385904_8_770'),
(101, 10, 8, 6, 15, 'c', '0', '0', '0', '1691385904_8_770'),
(102, 11, 8, 6, 16, 'b', '0', '0', '0', '1691385904_8_770'),
(103, 1, 8, 6, 6, 'c', '0', '0', '0', '1691385904_8_770'),
(104, 2, 8, 6, 7, 'b', '0', '0', '0', '1691385904_8_770'),
(105, 3, 8, 6, 8, 'd', '0', '0', '0', '1691385904_8_770'),
(106, 4, 8, 6, 9, 'c', '0', '0', '0', '1691385904_8_770'),
(107, 5, 8, 6, 10, 'd', '0', '0', '0', '1691385904_8_770'),
(108, 6, 8, 6, 11, 'c', '0', '0', '0', '1691385904_8_770'),
(109, 7, 8, 6, 12, 'a', '0', '0', '0', '1691385904_8_770'),
(110, 8, 8, 6, 13, 'a', '0', '0', '0', '1691385904_8_770'),
(111, 9, 8, 6, 14, 'a', '0', '0', '0', '1691385904_8_770'),
(112, 10, 8, 6, 15, 'c', '0', '0', '0', '1691385904_8_770'),
(113, 11, 8, 6, 16, 'b', '0', '0', '0', '1691385904_8_770'),
(114, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386054_8_815'),
(115, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386054_8_815'),
(116, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386054_8_815'),
(117, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386054_8_815'),
(118, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386054_8_815'),
(119, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386054_8_815'),
(120, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386054_8_815'),
(121, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386054_8_815'),
(122, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386054_8_815'),
(123, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386054_8_815'),
(124, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386054_8_815'),
(125, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386061_8_222'),
(126, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386061_8_222'),
(127, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386061_8_222'),
(128, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386061_8_222'),
(129, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386061_8_222'),
(130, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386061_8_222'),
(131, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386061_8_222'),
(132, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386061_8_222'),
(133, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386061_8_222'),
(134, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386061_8_222'),
(135, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386061_8_222'),
(136, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386110_8_135'),
(137, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386110_8_135'),
(138, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386110_8_135'),
(139, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386110_8_135'),
(140, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386110_8_135'),
(141, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386110_8_135'),
(142, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386110_8_135'),
(143, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386110_8_135'),
(144, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386110_8_135'),
(145, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386110_8_135'),
(146, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386110_8_135'),
(147, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386110_8_135'),
(148, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386110_8_135'),
(149, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386110_8_135'),
(150, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386110_8_135'),
(151, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386110_8_135'),
(152, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386110_8_135'),
(153, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386110_8_135'),
(154, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386110_8_135'),
(155, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386110_8_135'),
(156, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386110_8_135'),
(157, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386110_8_135'),
(158, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386110_8_135'),
(159, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386110_8_135'),
(160, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386110_8_135'),
(161, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386110_8_135'),
(162, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386110_8_135'),
(163, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386110_8_135'),
(164, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386110_8_135'),
(165, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386110_8_135'),
(166, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386110_8_135'),
(167, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386110_8_135'),
(168, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386110_8_135'),
(169, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386110_8_135'),
(170, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386110_8_135'),
(171, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386110_8_135'),
(172, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386110_8_135'),
(173, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386110_8_135'),
(174, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386110_8_135'),
(175, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386110_8_135'),
(176, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386110_8_135'),
(177, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386110_8_135'),
(178, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386110_8_135'),
(179, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386110_8_135'),
(180, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386110_8_135'),
(181, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386110_8_135'),
(182, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386110_8_135'),
(183, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386110_8_135'),
(184, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386110_8_135'),
(185, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386110_8_135'),
(186, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386110_8_135'),
(187, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386110_8_135'),
(188, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386110_8_135'),
(189, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386110_8_135'),
(190, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386110_8_135'),
(191, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386110_8_135'),
(192, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386110_8_135'),
(193, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386110_8_135'),
(194, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386110_8_135'),
(195, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386110_8_135'),
(196, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386110_8_135'),
(197, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386110_8_135'),
(198, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386110_8_135'),
(199, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386110_8_135'),
(200, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386110_8_135'),
(201, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386110_8_135'),
(202, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386110_8_135'),
(203, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386110_8_135'),
(204, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386110_8_135'),
(205, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386110_8_135'),
(206, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386110_8_135'),
(207, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386110_8_135'),
(208, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386110_8_135'),
(209, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386110_8_135'),
(210, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386110_8_135'),
(211, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386110_8_135'),
(212, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386110_8_135'),
(213, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386110_8_135'),
(214, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386110_8_135'),
(215, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386110_8_135'),
(216, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386110_8_135'),
(217, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386110_8_135'),
(218, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386110_8_135'),
(219, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386110_8_135'),
(220, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386110_8_135'),
(221, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386110_8_135'),
(222, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386110_8_135'),
(223, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386110_8_135'),
(224, 1, 8, 6, 6, 'c', '0', '0', '0', '1691386110_8_135'),
(225, 2, 8, 6, 7, 'b', '0', '0', '0', '1691386110_8_135'),
(226, 3, 8, 6, 8, 'd', '0', '0', '0', '1691386110_8_135'),
(227, 4, 8, 6, 9, 'c', '0', '0', '0', '1691386110_8_135'),
(228, 5, 8, 6, 10, 'd', '0', '0', '0', '1691386110_8_135'),
(229, 6, 8, 6, 11, 'c', '0', '0', '0', '1691386110_8_135'),
(230, 7, 8, 6, 12, 'a', '0', '0', '0', '1691386110_8_135'),
(231, 8, 8, 6, 13, 'a', '0', '0', '0', '1691386110_8_135'),
(232, 9, 8, 6, 14, 'a', '0', '0', '0', '1691386110_8_135'),
(233, 10, 8, 6, 15, 'c', '0', '0', '0', '1691386110_8_135'),
(234, 11, 8, 6, 16, 'b', '0', '0', '0', '1691386110_8_135'),
(235, 1, 4, 6, 6, 'c', 'a', '0', '2', '1691398079_4_252'),
(236, 2, 4, 6, 7, 'b', 'b', '1', '1', '1691398079_4_252'),
(237, 3, 4, 6, 8, 'd', '0', '0', '0', '1691398079_4_252'),
(238, 4, 4, 6, 9, 'c', '0', '0', '0', '1691398079_4_252'),
(239, 5, 4, 6, 10, 'd', '0', '0', '0', '1691398079_4_252'),
(240, 6, 4, 6, 11, 'c', '0', '0', '0', '1691398079_4_252'),
(241, 7, 4, 6, 12, 'a', '0', '0', '0', '1691398079_4_252'),
(242, 8, 4, 6, 13, 'a', '0', '0', '0', '1691398079_4_252'),
(243, 9, 4, 6, 14, 'a', '0', '0', '0', '1691398079_4_252'),
(244, 10, 4, 6, 15, 'c', '0', '0', '0', '1691398079_4_252'),
(245, 11, 4, 6, 16, 'b', '0', '0', '0', '1691398079_4_252'),
(246, 1, 4, 9, 25, 'a', 'a', '2', '1', '1691398276_4_712'),
(247, 2, 4, 9, 26, 'd', 'd', '2', '1', '1691398276_4_712'),
(248, 1, 4, 10, 27, 'a', 'a', '1', '1', '1691398694_4_702'),
(249, 2, 4, 10, 28, 'd', 'd', '1', '1', '1691398694_4_702'),
(250, 3, 4, 10, 29, 'd', 'd', '1', '1', '1691398694_4_702');

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
(16, 8, 6, '1', '0', 0, '1691385761_8_577', '2023-08-07', 4, 8),
(17, 8, 6, '1', '0', 0, '1691385827_8_283', '2023-08-07', 4, 8),
(18, 8, 6, '1', '0', 0, '1691385844_8_343', '2023-08-07', 4, 8),
(19, 8, 6, '1', '0', 0, '1691385904_8_770', '2023-08-07', 4, 8),
(20, 8, 6, '1', '0', 0, '1691385904_8_770', '2023-08-07', 4, 8),
(21, 8, 6, '1', '0', 0, '1691385904_8_770', '2023-08-07', 4, 8),
(22, 8, 6, '1', '0', 0, '1691385904_8_770', '2023-08-07', 4, 8),
(23, 8, 6, '1', '0', 0, '1691386054_8_815', '2023-08-07', 4, 8),
(24, 8, 6, '1', '0', 0, '1691386061_8_222', '2023-08-07', 4, 8),
(25, 8, 6, '1', '0', 0, '1691386110_8_135', '2023-08-07', 4, 8),
(26, 8, 6, '1', '0', 0, '1691386110_8_135', '2023-08-07', 4, 8),
(27, 8, 6, '1', '0', 0, '1691386110_8_135', '2023-08-07', 4, 8),
(28, 8, 6, '1', '0', 0, '1691386110_8_135', '2023-08-07', 4, 8),
(29, 8, 6, '1', '0', 0, '1691386110_8_135', '2023-08-07', 4, 8),
(30, 8, 6, '1', '0', 0, '1691386110_8_135', '2023-08-07', 4, 8),
(31, 8, 6, '1', '0', 0, '1691386110_8_135', '2023-08-07', 4, 8),
(32, 8, 6, '1', '0', 0, '1691386110_8_135', '2023-08-07', 4, 8),
(33, 8, 6, '1', '0', 0, '1691386110_8_135', '2023-08-07', 4, 8),
(34, 4, 6, '1', '0', 0, '1691398079_4_252', '2023-08-07', 4, 8),
(35, 4, 9, '2', '4', 1, '1691398276_4_712', '2023-08-07', 4, 10),
(36, 4, 10, '1', '3', 1, '1691398694_4_702', '2023-08-07', 4, 10);

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
(4, '1st Semester', 1, 1),
(5, '2nd Semester', 1, 1),
(6, '3nd Semester', 1, 1);

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
  `status` int(11) NOT NULL,
  `designation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `studentid`, `name`, `dept`, `phoneno`, `email`, `pass`, `address`, `status`, `designation`) VALUES
(1, 20230727, 'Test Student 1', 'CS7', '09354804468', 'test1@gmail.com', '123', 'test address 1', 1, 1),
(2, 20230728, 'Test Student 2', 'COE', '09994804423', 'test2@gmail.com', '123', 'test address 2', 1, 1),
(3, 20230729, 'Test Student 3', 'BEA', '09894828423', 'test3@gmail.com', '123', 'test address 3', 1, 2),
(4, 20230730, 'Test Student 4', 'NU2', '09234891423', 'test4@mail.com', '123', 'test address 4', 1, 2),
(12, 20230830, 'Test Student 5', 'OP4', '09234891612', 'test5@mail.com', '123', 'test address 5', 1, 0),
(13, 20230901, 'Test Student 6', 'KR4', '09354478810', 'test6@mail.com', '123', 'test address 6', 1, 0);

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
(8, 4, 'BIOLOGY', 1, 1),
(9, 4, 'CHEMISTRY', 1, 1),
(10, 4, 'PHYSICS', 1, 1);

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
(5, 4, 8, 6, 'Biology: Cell Structure I Nucleus Medical Media', 'URUJD5NEXC8?si=SA-uTTc1FhBbXype', 1, 1),
(6, 4, 8, 11, 'Frog Dissection: Internal Anatomy', 'iDRzbRlUzDw?si=GzcpQDk-c6uqQ-NT', 1, 1);

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
-- Indexes for table `experiment`
--
ALTER TABLE `experiment`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200101078;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `experiment`
--
ALTER TABLE `experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `meritlist`
--
ALTER TABLE `meritlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pdf`
--
ALTER TABLE `pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `result_summery`
--
ALTER TABLE `result_summery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vdo`
--
ALTER TABLE `vdo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
