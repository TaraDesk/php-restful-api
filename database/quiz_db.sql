-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql210.infinityfree.com
-- Generation Time: Apr 07, 2025 at 02:56 PM
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
-- Database: `if0_37803116_db_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option_text`, `is_correct`) VALUES
(1, 1, 'Mitochondria', 1),
(2, 1, 'Nucleus', 0),
(3, 1, 'Chloroplast', 0),
(4, 1, 'Endoplasmic Reticulum', 0),
(5, 2, '3.14', 1),
(6, 2, '3.41', 0),
(7, 3, 'William Shakespeare', 1),
(8, 3, 'Charles Dickens', 0),
(9, 3, 'Jane Austen', 0),
(10, 3, 'Mark Twain', 0),
(11, 4, '100', 1),
(12, 4, '0', 0),
(13, 5, 'Mars', 1),
(14, 5, 'Venus', 0),
(15, 5, 'Jupiter', 0),
(16, 5, 'Mercury', 0),
(17, 6, 'Au', 1),
(18, 6, 'Ag', 0),
(19, 7, '1945', 1),
(20, 7, '1939', 0),
(21, 7, '1918', 0),
(22, 7, '1965', 0),
(23, 8, '½ × base × height', 1),
(24, 8, 'base × height', 0),
(25, 9, 'Carbon Dioxide', 1),
(26, 9, 'Oxygen', 0),
(27, 9, 'Nitrogen', 0),
(28, 9, 'Hydrogen', 0),
(29, 10, 'Portuguese', 1),
(30, 10, 'Spanish', 0),
(31, 11, 'Force = mass × acceleration', 1),
(32, 11, 'Force = mass ÷ volume', 0),
(33, 11, 'Force = speed × time', 0),
(34, 11, 'Force = energy × distance', 0),
(35, 12, 'Federalism', 1),
(36, 12, 'Monarchy', 0),
(37, 13, 'Gross Domestic Product', 1),
(38, 13, 'General Domestic Profit', 0),
(39, 13, 'Global Development Plan', 0),
(40, 13, 'Gross Development Projection', 0),
(41, 14, 'Adolf Hitler', 1),
(42, 14, 'Winston Churchill', 0),
(43, 15, 'Protein', 1),
(44, 15, 'Carbohydrate', 0),
(45, 15, 'Fat', 0),
(46, 15, 'Water', 0),
(47, 16, 'Central Processing Unit', 1),
(48, 16, 'Central Power Utility', 0),
(49, 17, 'Asia', 1),
(50, 17, 'Africa', 0),
(51, 17, 'Europe', 0),
(52, 17, 'Antarctica', 0),
(53, 18, 'Sigmund Freud', 1),
(54, 18, 'Carl Jung', 0),
(55, 19, 'Epistemology', 1),
(56, 19, 'Ethics', 0),
(57, 19, 'Ontology', 0),
(58, 19, 'Metaphysics', 0),
(59, 20, 'Society and social behavior', 1),
(60, 20, 'Cultural traditions only', 0),
(61, 21, 'x = 5', 1),
(62, 21, 'x = 10', 0),
(63, 22, '2x', 1),
(64, 22, 'x²', 0),
(65, 22, '1', 0),
(66, 22, 'x', 0),
(67, 23, '5', 1),
(68, 23, '7', 0),
(69, 24, 'Sine, Cosine, Tangent', 1),
(70, 24, 'Linear regression', 0),
(71, 24, 'Parabola function', 0),
(72, 24, 'Exponential decay', 0),
(73, 25, 'Mantle', 1),
(74, 25, 'Core', 0),
(75, 26, 'Red and Blue', 1),
(76, 26, 'Green and Yellow', 0),
(77, 26, 'Blue and Yellow', 0),
(78, 26, 'Red and Green', 0),
(79, 27, 'Treble Clef', 1),
(80, 27, 'Bass Clef', 0),
(81, 28, 'Tragedy', 1),
(82, 28, 'Comedy', 0),
(83, 28, 'Satire', 0),
(84, 28, 'Romance', 0),
(85, 29, 'Morality and values', 1),
(86, 29, 'Government systems', 0),
(87, 30, 'Engineering', 1),
(88, 30, 'Linguistics', 0),
(89, 30, 'Botany', 0),
(90, 30, 'Philosophy', 0),
(91, 31, 'Calcium', 1),
(92, 31, 'Iron', 0),
(93, 32, 'DNA', 1),
(94, 32, 'RNA', 0),
(95, 32, 'ATP', 0),
(96, 32, 'Glucose', 0),
(97, 33, 'Mammals', 1),
(98, 33, 'Reptiles', 0),
(99, 34, 'Leaves', 1),
(100, 34, 'Roots', 0),
(101, 34, 'Stems', 0),
(102, 34, 'Flowers', 0),
(103, 35, '35 ppt', 1),
(104, 35, '15 ppt', 0),
(105, 36, 'Barometer', 1),
(106, 36, 'Thermometer', 0),
(107, 36, 'Anemometer', 0),
(108, 36, 'Altimeter', 0),
(109, 37, 'Political Science', 1),
(110, 37, 'Sociology', 0),
(111, 38, 'Anthropology', 1),
(112, 38, 'Biology', 0),
(113, 38, 'Ecology', 0),
(114, 38, 'Psychology', 0),
(115, 39, 'Environmental Ethics', 1),
(116, 39, 'Environmental Science', 0),
(117, 40, 'Creative Writing', 1),
(118, 40, 'Technical Writing', 0),
(119, 40, 'Analytical Writing', 0),
(120, 40, 'Business Writing', 0),
(121, 41, 'Ottawa', 1),
(122, 41, 'Toronto', 0),
(123, 42, 'Saturn', 1),
(124, 42, 'Neptune', 0),
(125, 42, 'Uranus', 0),
(126, 42, 'Mars', 0),
(127, 43, '32°F', 1),
(128, 43, '0°F', 0),
(129, 44, 'World War I', 1),
(130, 44, 'World War II', 0),
(131, 44, 'Cold War', 0),
(132, 44, 'Vietnam War', 0),
(133, 45, '50', 1),
(134, 45, '25', 0),
(135, 46, '12', 1),
(136, 46, '14', 0),
(137, 46, '11', 0),
(138, 46, '13', 0),
(139, 47, 'Oxygen', 1),
(140, 47, 'Gold', 0),
(141, 48, 'Personification', 1),
(142, 48, 'Metaphor', 0),
(143, 48, 'Irony', 0),
(144, 48, 'Hyperbole', 0),
(145, 49, 'Temperature', 1),
(146, 49, 'Pressure', 0),
(147, 50, 'Evaporation', 1),
(148, 50, 'Condensation', 0),
(149, 50, 'Precipitation', 0),
(150, 50, 'Freezing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `category`) VALUES
(1, 'What is the powerhouse of the cell?', 'Biology'),
(2, 'What is the value of ? (pi) rounded to 2 decimal places?', 'Mathematics'),
(3, 'Who wrote \"Romeo and Juliet\"?', 'Literature'),
(4, 'What is the boiling point of water in Celsius?', 'Chemistry'),
(5, 'Which planet is known as the Red Planet?', 'Astronomy'),
(6, 'What is the chemical symbol for gold?', 'Periodic Table'),
(7, 'In which year did World War II end?', 'History'),
(8, 'What’s the formula for calculating area of a triangle?', 'Geometry'),
(9, 'Which gas do plants absorb from the atmosphere?', 'Environmental Science'),
(10, 'What is the main language spoken in Brazil?', 'Languages'),
(11, 'What is the formula for force in physics?', 'Physics'),
(12, 'What type of government divides power between national and state levels?', 'Civics'),
(13, 'What does GDP stand for?', 'Economics'),
(14, 'Who was the leader of Germany during World War II?', 'World History'),
(15, 'Which nutrient helps build and repair body tissues?', 'Health Science'),
(16, 'What does CPU stand for in computing?', 'Computer Science'),
(17, 'What is the largest continent by land area?', 'Geography'),
(18, 'Who is considered the father of psychoanalysis?', 'Psychology'),
(19, 'Which branch of philosophy deals with knowledge?', 'Philosophy'),
(20, 'What does sociology primarily study?', 'Sociology'),
(21, 'What is the solution to the equation 2x = 10?', 'Algebra'),
(22, 'What is the derivative of x²?', 'Calculus'),
(23, 'What is the median of the data set: 3, 5, 7?', 'Statistics'),
(24, 'Which function describes a right triangle relationship?', 'Trigonometry'),
(25, 'What layer of Earth lies below the crust?', 'Earth Science'),
(26, 'What primary colors make up purple?', 'Art'),
(27, 'Which clef is typically used for violin music?', 'Music'),
(28, 'Which genre is Shakespeare’s “Macbeth”?', 'Drama'),
(29, 'What does ethics primarily deal with?', 'Ethics'),
(30, 'Which field includes the study of machines and structures?', 'Engineering'),
(31, 'Which mineral is essential for strong bones?', 'Nutrition'),
(32, 'What molecule carries genetic information?', 'Genetics'),
(33, 'Which classification includes lions?', 'Zoology'),
(34, 'What part of the plant conducts photosynthesis?', 'Botany'),
(35, 'What is the average salinity of ocean water?', 'Oceanography'),
(36, 'Which tool is used to measure atmospheric pressure?', 'Meteorology'),
(37, 'What is the study of governments and political processes?', 'Political Science'),
(38, 'What is the study of human cultures and societies?', 'Anthropology'),
(39, 'What field studies the moral relationship between humans and nature?', 'Environmental Ethics'),
(40, 'What type of writing focuses on imagination and creativity?', 'Creative Writing'),
(41, 'What is the capital city of Canada?', 'Geography'),
(42, 'Which planet is known for its rings?', 'Astronomy'),
(43, 'What is the freezing point of water in Fahrenheit?', 'Chemistry'),
(44, 'Which war ended with the Treaty of Versailles?', 'Modern History'),
(45, 'What is 25% of 200?', 'Arithmetic'),
(46, 'What is the square root of 144?', 'Mathematics'),
(47, 'Which element has the chemical symbol \"O\"?', 'Chemistry'),
(48, 'Which literary device involves giving human traits to non-human things?', 'Literature'),
(49, 'What does a thermometer measure?', 'Physics'),
(50, 'What is the process of water turning into vapor called?', 'Earth Science');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `purpose`, `expires_at`) VALUES
(1, 'c8af0257-13df-11f0-b1fd-186dd9f852af', 'test-token-for-api', '2025-04-14 11:40:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_option` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `fk_option` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
