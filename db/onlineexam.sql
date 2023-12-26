-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 01:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `mobile`, `email`, `pass`, `status`, `image`) VALUES
(1, 'admin', 'Teacher 1', '9354123456', 'geraldbathan24@gmail.com', '12345678', 1, 0x6173736574732f696d616765732f75736572732f746561636865722e706e67),
(2, 'test2', 'Teacher 2', '9364804461', 'test@gmail.com', '12345678', 1, ''),
(200101080, 'test3', 'Teacher 3', '9354804412', 'test2@gmail.com', '12345678', 0, NULL),
(200101081, 'test4', 'Teacher 4', '9320045741', 'test3@gmail.com', '12345678', 0, NULL),
(200101082, 'test5', 'Teacher 5', '9329945741', 'test4@mailinator.com', '12345678', 2, NULL),
(200101083, 'test6', 'Teacher 6', '9329942341', 'test5@mailinator.com', '12345678', 1, NULL),
(200101084, 'test7', 'Teacher 7', '9361942341', 'test6@mailinator.com', '12345678', 0, NULL);

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
  `total_question` int(11) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `semester_id`, `subject_id`, `name`, `status`, `admin_id`, `duration`, `question_mark`, `total_mark`, `total_question`, `startDate`, `endDate`) VALUES
(6, 4, 8, 'HUMAN ANATOMY', 1, 1, 1, 1, 1, 10, '2023-11-01', '2025-12-01'),
(7, 4, 9, 'CHEMISTRY 101 | FINAL EXAM', 1, 1, 1, 1, 1, 5, '2023-11-01', '2025-12-01'),
(10, 4, 10, 'PHYSICS 201', 1, 1, 1, 1, 1, 3, '2023-11-01', '2025-12-01'),
(11, 4, 8, 'BIOLOGY | MIDTERM', 1, 1, 1, 1, 1, 3, '2023-11-01', '2025-12-01'),
(12, 4, 8, 'SCIENCE 101', 1, 200101083, 1, 1, 1, 3, '2023-11-01', '2025-12-01'),
(14, 4, 10, 'EXPERIMENTAL BEHAVIOR', 1, 200101083, 1, 1, 1, 8, '2023-12-01', '2023-12-31');

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
  `admin_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `custom` tinyint(1) NOT NULL,
  `islock` tinyint(1) NOT NULL,
  `prev_islock` tinyint(1) NOT NULL,
  `isrubric` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experiment`
--

INSERT INTO `experiment` (`id`, `subject_id`, `name`, `url`, `status`, `admin_id`, `description`, `custom`, `islock`, `prev_islock`, `isrubric`) VALUES
(1, 8, 'Density', 'https://phet.colorado.edu/sims/html/density/latest/density_en.html', 1, 1, 'Density is a word we use to describe how much space an object or substance takes up (its volume) in relation \nto the amount of matter in that object or substance (its mass). \n\n<img src=\"https://blog.udemy.com/wp-content/uploads/2014/05/bigstock-test-icon-63758263.jpg\" width=250 height=100>\n\nAnother way to put it is that density is the \namount of mass per unit of volume. If an object is heavy and compact, it has a high density.', 0, 0, 0, 0),
(4, 9, 'Volcano Experiment', './volcano/index.html', 1, 1, '<b>Instruction</b><br> A DIY volcano experiment is a fun and educational activity that can be done at home. To make one, you will need baking  soda, vinegar, food coloring, and a plastic bottle or container.  <br> <img src=\"https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fartsphere.org%2Fwp-content%2Fuploads%2F2019%2F04%2F1.png&f=1&nofb=1&ipt=5feb746c02bef2702410d90b412e71558ed6563da8ffc7f3616d70d900f6f7c9&ipo=images\" width=350 height=200> <br> First, fill the bottle with baking soda. Next, add a couple of drops of food coloring and then pour in some vinegar.  The reaction between the baking soda and vinegar will cause the mixture to bubble and erupt, creating a mini volcano.', 1, 0, 0, 0),
(5, 10, 'Energy Skate Park', 'https://phet.colorado.edu/sims/html/energy-skate-park/latest/energy-skate-park_en.html', 1, 1, 'Energy Skate Park simulation Description/instruction', 0, 0, 0, 0),
(6, 9, 'State of matter', 'https://phet.colorado.edu/sims/html/states-of-matter-basics/latest/states-of-matter-basics_en.html', 1, 1, 'State of matter simulation Description/instruction', 0, 0, 0, 0),
(7, 8, 'Frog Dissecting', './frog/index.html', 1, 1, 'Frog Disecting simulation Description/instruction and mechanics', 1, 0, 0, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `isread` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `student_id`, `details`, `isread`, `created_at`) VALUES
(182, 1, 'Frog Dissecting is Lock!', 1, '2023-12-08 19:48:48'),
(183, 2, 'Frog Dissecting is Lock!', 1, '2023-12-08 19:48:48'),
(184, 18, 'Frog Dissecting is Lock!', 0, '2023-12-08 19:48:48'),
(185, 1, 'State of matter is Lock!', 1, '2023-12-08 19:57:24'),
(186, 2, 'State of matter is Lock!', 1, '2023-12-08 19:57:24'),
(187, 18, 'State of matter is Lock!', 0, '2023-12-08 19:57:24'),
(188, 1, 'Energy Skate Park is Lock!', 1, '2023-12-08 20:02:45'),
(189, 2, 'Energy Skate Park is Lock!', 1, '2023-12-08 20:02:45'),
(190, 18, 'Energy Skate Park is Lock!', 0, '2023-12-08 20:02:45'),
(191, 1, 'Density is Unlock!', 1, '2023-12-08 20:04:43'),
(192, 2, 'Density is Unlock!', 1, '2023-12-08 20:04:43'),
(193, 18, 'Density is Unlock!', 0, '2023-12-08 20:04:43'),
(194, 1, 'Volcano Experiment is Unlock!', 1, '2023-12-10 23:02:31'),
(195, 2, 'Volcano Experiment is Unlock!', 1, '2023-12-10 23:02:31'),
(196, 18, 'Volcano Experiment is Unlock!', 0, '2023-12-10 23:02:31'),
(197, 1, 'Volcano Experiment is Unlock!', 1, '2023-12-10 23:02:49'),
(198, 2, 'Volcano Experiment is Unlock!', 1, '2023-12-10 23:02:49'),
(199, 18, 'Volcano Experiment is Unlock!', 0, '2023-12-10 23:02:49'),
(200, 1, 'Energy Skate Park is Unlock!', 1, '2023-12-10 23:02:57'),
(201, 2, 'Energy Skate Park is Unlock!', 1, '2023-12-10 23:02:57'),
(202, 18, 'Energy Skate Park is Unlock!', 0, '2023-12-10 23:02:57'),
(203, 1, 'State of matter is Unlock!', 1, '2023-12-10 23:03:00'),
(204, 2, 'State of matter is Unlock!', 1, '2023-12-10 23:03:00'),
(205, 18, 'State of matter is Unlock!', 0, '2023-12-10 23:03:00'),
(206, 1, 'Frog Dissecting is Unlock!', 1, '2023-12-10 23:03:02'),
(207, 2, 'Frog Dissecting is Unlock!', 1, '2023-12-10 23:03:02'),
(208, 18, 'Frog Dissecting is Unlock!', 0, '2023-12-10 23:03:02'),
(209, 1, 'Frog Dissecting is Lock!', 1, '2023-12-10 23:12:11'),
(210, 2, 'Frog Dissecting is Lock!', 1, '2023-12-10 23:12:11'),
(211, 18, 'Frog Dissecting is Lock!', 0, '2023-12-10 23:12:11'),
(212, 1, 'Frog Dissecting is Unlock!', 1, '2023-12-10 23:15:19'),
(213, 2, 'Frog Dissecting is Unlock!', 1, '2023-12-10 23:15:19'),
(214, 18, 'Frog Dissecting is Unlock!', 0, '2023-12-10 23:15:19'),
(215, 3, 'new experiment teacher 2 is Lock!', 1, '2023-12-10 23:32:08'),
(216, 4, 'new experiment teacher 2 is Lock!', 0, '2023-12-10 23:32:08'),
(217, 2, 'new experiment teacher 2 is Unlock!', 0, '2023-12-11 01:19:28'),
(218, 3, 'new experiment teacher 2 is Unlock!', 0, '2023-12-11 01:19:28'),
(219, 4, 'new experiment teacher 2 is Unlock!', 0, '2023-12-11 01:19:28'),
(220, 2, 'new experiment teacher 2 is Lock!', 0, '2023-12-11 01:29:44'),
(221, 3, 'new experiment teacher 2 is Lock!', 0, '2023-12-11 01:29:44'),
(222, 4, 'new experiment teacher 2 is Lock!', 0, '2023-12-11 01:29:44'),
(223, 1, 'State of matter is Lock!', 0, '2023-12-11 01:30:28'),
(224, 18, 'State of matter is Lock!', 0, '2023-12-11 01:30:28'),
(225, 1, 'State of matter is Unlock!', 0, '2023-12-11 01:36:14'),
(226, 18, 'State of matter is Unlock!', 0, '2023-12-11 01:36:14'),
(227, 1, 'Frog Dissecting is Lock!', 0, '2023-12-11 01:36:30'),
(228, 18, 'Frog Dissecting is Lock!', 0, '2023-12-11 01:36:30'),
(229, 2, 'new experiment teacher 2 is Unlock!', 0, '2023-12-11 01:37:08'),
(230, 3, 'new experiment teacher 2 is Unlock!', 0, '2023-12-11 01:37:08'),
(231, 4, 'new experiment teacher 2 is Unlock!', 0, '2023-12-11 01:37:08'),
(232, 1, 'Frog Dissecting is Unlock!', 0, '2023-12-21 16:22:22');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pdf`
--

INSERT INTO `pdf` (`id`, `semester_id`, `subject_id`, `exam_id`, `title`, `pdf_file`, `status`, `admin_id`) VALUES
(6, 4, 8, 6, 'Test Report PDF 1', 'PRU-Enrollment-Form-CC.pdf', 1, 1),
(7, 4, 9, 7, 'Test Report PDF 2', '2022_05_28_1653719874_728f.pdf', 1, 1),
(8, 6, 9, 6, 'Test Report PDF 3', 'VAL_OTAMNL-P-MNL-TEST THREE.pdf', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pdf_status`
--

CREATE TABLE `pdf_status` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `pdf_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdf_status`
--

INSERT INTO `pdf_status` (`id`, `student_id`, `admin_id`, `is_read`, `pdf_id`) VALUES
(10, '1', '1', 1, '6'),
(11, '2', '1', 1, '8');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(17, 7, 'The correct formula for aluminum nitrate is', 'Al3N2', 'Al3(NO3)', 'Al(NO2)3', 'Al(NO3)3', 'd', 1),
(18, 7, 'A substance releases heat when it changes from', 'liquid to solid', 'solid to gas', 'liquid to gas', 'solid to liquid', 'a', 1),
(19, 7, 'Given the balanced equation: 2H2(g) + O2(g) --> 2H2O(l) How many grams of H2O are formed if 9.00 mol H2(g) reacts completely with an excess of O2(g)?  The molar mass of H2O is 18.0g/mol.', '18.0g', '36.0g', '81.0g', '162g', 'd', 1),
(20, 7, 'Which element has exactly five electrons in the highest principal energy level (the outer shell)?', 'Se', 'Ba', 'P', 'Ge', 'c', 1),
(21, 7, 'Which element is a metal?', 'Se (atomic number = 34)', 'Co (atomic number = 27)', 'C (atomic number = 6)', 'Br (atomic number = 35)', 'b', 1),
(23, 8, 'Question 1 here', 'answer 1', 'answer 2', 'answer 3', 'answer 4', 'a', 1),
(24, 8, 'Question 2 here', ' answer a', ' answer b', ' answer c', ' answer d', '', 1),
(25, 9, 'Question 1', 'answer A', 'answer B', 'answer C', 'answer D', 'a', 1),
(26, 9, 'Question 2', 'test a', 'test b', 'test c', 'test d', 'd', 1),
(30, 12, '1+1 =', '2', '4', '3', '5', 'a', 1),
(44, 12, '2', '2', '2', '2', '2', 'a', 1),
(60, 10, 'A car is initially at rest. If it accelerates uniformly at  2   m/s 2 2m/s  2   for  5   s 5s, what is its final velocity?', '5m/s', '10m/s', '15m/s', '20m/s', 'a', 1),
(61, 10, 'What is the SI unit of electric current?', 'Volt (V)', 'Watt (W)', 'Ampere (A)', 'Ohm (Ω)', 'c', 1),
(62, 10, 'Which of the following is a fundamental force of nature that acts between all particles with mass?', 'Electromagnetic force', 'Gravitational force', 'Nuclear force', 'Frictional force', 'b', 1),
(63, 11, 'Which organelle is responsible for cellular respiration, producing ATP (adenosine triphosphate) as an energy source for the cell?', 'Nucleus', 'Chloroplast', 'Mitochondrion', 'Endoplasmic reticulum', 'c', 1),
(64, 11, 'Which of the following organelles is responsible for cellular respiration and energy production in eukaryotic cells?', 'Endoplasmic reticulum', 'Golgi apparatus', 'Mitochondrion', 'Nucleus', 'c', 1),
(65, 11, 'What is the primary function of the mitochondria in a eukaryotic cell?', 'Protein synthesis', 'Energy production', 'Storage of genetic material', 'Cellular respiration', 'b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_experiment`
--

CREATE TABLE `question_experiment` (
  `id` int(11) NOT NULL,
  `experiment_id` int(11) NOT NULL,
  `des` text NOT NULL,
  `op1` text NOT NULL,
  `op2` text NOT NULL,
  `op3` text NOT NULL,
  `op4` text NOT NULL,
  `ans` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `question_experiment`
--

INSERT INTO `question_experiment` (`id`, `experiment_id`, `des`, `op1`, `op2`, `op3`, `op4`, `ans`, `status`) VALUES
(1, 1, 'What is my favorite color', 'Red', 'Blue', 'Black', 'Green', 'b', 1),
(6, 9, 'What is my age range', '20s', '30s', '40s', '50s', 'a', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `sl`, `student_id`, `exam_id`, `question_id`, `correct_ans`, `given_ans`, `question_mark`, `sts`, `unique_code`) VALUES
(352, 1, 2, 6, 6, 'c', 'c', '1', '1', '1703395614_2_455'),
(353, 2, 2, 6, 7, 'b', 'b', '1', '1', '1703395614_2_455'),
(354, 3, 2, 6, 8, 'd', 'd', '1', '1', '1703395614_2_455'),
(355, 4, 2, 6, 9, 'c', 'c', '1', '1', '1703395614_2_455'),
(356, 5, 2, 6, 10, 'd', 'd', '1', '1', '1703395614_2_455'),
(357, 6, 2, 6, 11, 'c', 'c', '1', '1', '1703395614_2_455'),
(358, 7, 2, 6, 12, 'a', 'a', '1', '1', '1703395614_2_455'),
(359, 8, 2, 6, 13, 'a', 'a', '1', '1', '1703395614_2_455'),
(360, 9, 2, 6, 14, 'a', 'a', '1', '1', '1703395614_2_455'),
(361, 10, 2, 6, 15, 'c', 'c', '1', '1', '1703395614_2_455'),
(362, 1, 1, 6, 6, 'c', 'c', '1', '1', '1703395814_1_759'),
(363, 2, 1, 6, 7, 'b', 'b', '1', '1', '1703395814_1_759'),
(364, 3, 1, 6, 8, 'd', 'd', '1', '1', '1703395814_1_759'),
(365, 4, 1, 6, 9, 'c', 'c', '1', '1', '1703395814_1_759'),
(366, 5, 1, 6, 10, 'd', 'd', '1', '1', '1703395814_1_759'),
(367, 6, 1, 6, 11, 'c', 'c', '1', '1', '1703395814_1_759'),
(368, 7, 1, 6, 12, 'a', 'a', '1', '1', '1703395814_1_759'),
(369, 8, 1, 6, 13, 'a', 'a', '1', '1', '1703395814_1_759'),
(370, 9, 1, 6, 14, 'a', 'd', '0', '2', '1703395814_1_759'),
(371, 10, 1, 6, 15, 'c', 'c', '1', '1', '1703395814_1_759'),
(372, 1, 14, 11, 63, 'c', 'c', '1', '1', '1703396043_14_915'),
(373, 2, 14, 11, 64, 'c', 'c', '1', '1', '1703396043_14_915'),
(374, 3, 14, 11, 65, 'b', 'b', '1', '1', '1703396043_14_915'),
(375, 1, 15, 11, 63, 'c', 'c', '1', '1', '1703396156_15_484'),
(376, 2, 15, 11, 64, 'c', 'c', '1', '1', '1703396156_15_484'),
(377, 3, 15, 11, 65, 'b', 'c', '0', '2', '1703396156_15_484'),
(378, 1, 14, 10, 60, 'a', 'a', '1', '1', '1703396834_14_885'),
(379, 2, 14, 10, 61, 'c', 'c', '1', '1', '1703396834_14_885'),
(380, 3, 14, 10, 62, 'b', 'b', '1', '1', '1703396834_14_885'),
(381, 1, 15, 10, 60, 'a', 'a', '1', '1', '1703396863_15_838'),
(382, 2, 15, 10, 61, 'c', 'c', '1', '1', '1703396863_15_838'),
(383, 3, 15, 10, 62, 'b', 'd', '0', '2', '1703396863_15_838'),
(384, 1, 38, 7, 17, 'd', 'd', '1', '1', '1703398999_38_388'),
(385, 2, 38, 7, 18, 'a', 'a', '1', '1', '1703398999_38_388'),
(386, 3, 38, 7, 19, 'd', 'd', '1', '1', '1703398999_38_388'),
(387, 4, 38, 7, 20, 'c', 'c', '1', '1', '1703398999_38_388'),
(388, 5, 38, 7, 21, 'b', 'd', '0', '2', '1703398999_38_388');

-- --------------------------------------------------------

--
-- Table structure for table `result_experiment`
--

CREATE TABLE `result_experiment` (
  `id` int(11) NOT NULL,
  `sl` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `experiment_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `correct_ans` varchar(10) DEFAULT NULL,
  `given_ans` varchar(10) DEFAULT NULL,
  `question_mark` varchar(10) NOT NULL,
  `sts` varchar(10) NOT NULL COMMENT '0 = no action, 1 = correct ans, 2 = wrong ans, 3 = skiped, 4 = blank ans',
  `unique_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result_summery`
--

INSERT INTO `result_summery` (`id`, `student_id`, `exam_id`, `total_mark`, `your_mark`, `sts`, `unique_code`, `created_at`, `semester_id`, `subject_id`) VALUES
(66, 2, 6, '1', '10', 1, '1703395614_2_455', '2023-12-24', 4, 8),
(67, 1, 6, '1', '9', 1, '1703395814_1_759', '2023-12-24', 4, 8),
(68, 14, 11, '1', '3', 1, '1703396043_14_915', '2023-12-24', 4, 8),
(69, 15, 11, '1', '2', 1, '1703396156_15_484', '2023-12-24', 4, 8),
(70, 14, 10, '1', '3', 1, '1703396834_14_885', '2023-12-24', 4, 10),
(71, 15, 10, '1', '2', 1, '1703396863_15_838', '2023-12-24', 4, 10),
(72, 38, 7, '1', '4', 1, '1703398999_38_388', '2023-12-24', 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `result_summery_experiment`
--

CREATE TABLE `result_summery_experiment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `experiment_id` int(11) NOT NULL,
  `total_mark` varchar(10) NOT NULL,
  `your_mark` varchar(10) NOT NULL,
  `sts` int(11) NOT NULL,
  `unique_code` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `name`, `status`, `admin_id`, `startDate`, `endDate`) VALUES
(4, '1st Semester', 1, 0, '2023-12-01', '2023-12-04'),
(5, '2nd Semester', 1, 0, '2023-12-05', '2023-12-13'),
(6, '3nd Semester', 1, 0, '2023-12-14', '2023-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `started_exam`
--

CREATE TABLE `started_exam` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `is_started` tinyint(1) NOT NULL,
  `exam_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `started_exam`
--

INSERT INTO `started_exam` (`id`, `student_id`, `admin_id`, `is_started`, `exam_id`) VALUES
(21, '2', '1', 1, 6),
(22, '1', '1', 1, 6),
(23, '14', '1', 1, 11),
(24, '15', '1', 1, 11),
(25, '14', '1', 1, 10),
(26, '15', '1', 1, 10),
(27, '38', '1', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `phoneno` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `designation` int(11) NOT NULL,
  `image` blob DEFAULT NULL,
  `conPerson` varchar(255) DEFAULT NULL,
  `conNumber` varchar(255) DEFAULT NULL,
  `conAddress` varchar(255) DEFAULT NULL,
  `conRelationship` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `studentid`, `name`, `dept`, `phoneno`, `email`, `pass`, `address`, `status`, `designation`, `image`, `conPerson`, `conNumber`, `conAddress`, `conRelationship`) VALUES
(1, '20230727', 'Test Student 1', 'FLEMING', '09354804468', 'test1@gmail.com', '12345678', 'test address 1', 1, 1, 0x6173736574732f696d616765732f75736572732f73747564656e742e706e67, 'test contact person', '09354804468', 'test address', 'relationship'),
(2, '20230728', 'Test Student 2', 'DESCARTES', '09994804423', 'test2@gmail.com', '12345678', 'test address 2', 1, 1, NULL, '', '', '', NULL),
(3, '20230729', 'Test Student 3', 'TESLA', '09894828423', 'test3@gmail.com', '12345678', 'test address 3', 1, 2, NULL, '', '', '', NULL),
(4, '20230730', 'Test Student 4', 'LEWIS', '09234891423', 'test4@gmail.com', '12345678', 'test address 4', 1, 2, NULL, '', '', '', NULL),
(12, '20230830', 'Test Student 5', 'OP4', '09234891612', 'test5@gmail.com', '12345678', 'test address 5', 1, 0, NULL, '', '', '', NULL),
(13, '20230901', 'Test Student 6', 'KR4', '09354478810', 'test6@gmail.com', '12345678', 'test address 6', 1, 0, NULL, '', '', '', NULL),
(14, '20231220', 'Test Student 7', 'FLEMING', '09366478810', 'test7@gmail.com', '12345678', 'test address 7', 1, 1, NULL, '', '', '', NULL),
(15, '20231221', 'Test Student 8', 'DESCARTES', '09354478712', 'test8@mailinator.com', '12345678', 'test address 8', 1, 1, NULL, 'test contact person', '09354804468', 'test address', 'relationship'),
(16, '20231222', 'Test Student 9', 'TESLA', '09383278712', 'test9@mailinator.com', '12345678', 'test address 9', 1, 2, NULL, '', '', '', NULL),
(18, '20231224', 'Test Student 10', 'LEWIS', '09354008712', 'test10@mailinator.com', '12345678', 'test address 10', 1, 2, NULL, '', '', '', NULL),
(38, '20231225', 'Test Student 11', 'LANDSTEINER', '09354471234', 'test11@mailinator.com', '12345678', 'test address 11', 1, 1, NULL, 'test contact person', '09354804468', 'test address', 'relationship');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `semester_id`, `name`, `status`, `admin_id`, `startDate`, `endDate`) VALUES
(8, 4, 'BIOLOGY', 1, 1, '2022-12-01', '2024-12-31'),
(9, 4, 'CHEMISTRY', 1, 1, '2022-12-01', '2024-12-31'),
(10, 4, 'PHYSICS', 1, 1, '2022-12-01', '2024-12-31'),
(13, 5, 'NEUROLOGY', 1, 1, '2023-12-01', '2023-12-05');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vdo`
--

INSERT INTO `vdo` (`id`, `semester_id`, `subject_id`, `exam_id`, `title`, `url`, `status`, `admin_id`) VALUES
(5, 4, 8, 6, 'Biology: Cell Structure I Nucleus Medical Media', 'URUJD5NEXC8?si=SA-uTTc1FhBbXype', 1, 1),
(6, 4, 8, 11, 'Frog Dissection: Internal Anatomy', 'jdgs3VRZezo?si=eC6rMmKRYlw-Jdfs', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id`, `year`, `startDate`, `endDate`) VALUES
(2, '2023 - 2024', '2024-01-01', '2024-12-31'),
(3, '2022 - 2023', '2023-01-01', '2023-12-31');

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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_status`
--
ALTER TABLE `pdf_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_experiment`
--
ALTER TABLE `question_experiment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_experiment`
--
ALTER TABLE `result_experiment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_summery`
--
ALTER TABLE `result_summery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_summery_experiment`
--
ALTER TABLE `result_summery_experiment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `started_exam`
--
ALTER TABLE `started_exam`
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
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200101085;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `experiment`
--
ALTER TABLE `experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meritlist`
--
ALTER TABLE `meritlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `pdf`
--
ALTER TABLE `pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pdf_status`
--
ALTER TABLE `pdf_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `question_experiment`
--
ALTER TABLE `question_experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;

--
-- AUTO_INCREMENT for table `result_experiment`
--
ALTER TABLE `result_experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `result_summery`
--
ALTER TABLE `result_summery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `result_summery_experiment`
--
ALTER TABLE `result_summery_experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `started_exam`
--
ALTER TABLE `started_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vdo`
--
ALTER TABLE `vdo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
