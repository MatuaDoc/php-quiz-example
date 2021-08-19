-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 19, 2021 at 11:32 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `QuizDemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answers`
--

CREATE TABLE `Answers` (
  `AnswerID` tinyint(4) NOT NULL,
  `QuestionID` tinyint(4) NOT NULL,
  `AnswerText` text NOT NULL,
  `AnswerIsCorrect` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Answers`
--

INSERT INTO `Answers` (`AnswerID`, `QuestionID`, `AnswerText`, `AnswerIsCorrect`) VALUES
(1, 1, 'Onslow College', 1),
(2, 1, 'Newlands College', 0),
(3, 1, 'Wellington High School', 0),
(4, 1, 'Sacred Heart College', 0),
(5, 2, 'C', 1),
(6, 2, 'C++', 0),
(7, 2, 'C#', 0),
(8, 2, 'D', 0),
(9, 3, 'Autumn', 1),
(10, 3, 'Fall', 0),
(11, 3, 'Spring', 0),
(12, 3, 'Summer', 0),
(13, 4, '10', 1),
(14, 4, '8', 0),
(15, 4, '11', 0),
(16, 4, 'π', 0),
(17, 5, '42', 1),
(18, 5, 'To be happy', 0),
(19, 5, 'To contribute to the world', 0),
(20, 5, 'To help one another', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE `Questions` (
  `QuestionID` tinyint(4) NOT NULL,
  `QuestionText` text NOT NULL,
  `QuizID` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Questions`
--

INSERT INTO `Questions` (`QuestionID`, `QuestionText`, `QuizID`) VALUES
(1, 'What school do we go to?', 1),
(2, 'Which is the oldest programming language?', 1),
(3, 'What season comes before winter in New Zealand?', 1),
(4, 'What number comes after 9?', 1),
(5, 'What is the meaning of life?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Quiz`
--

CREATE TABLE `Quiz` (
  `QuizID` tinyint(3) UNSIGNED NOT NULL,
  `QuizName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Quiz`
--

INSERT INTO `Quiz` (`QuizID`, `QuizName`) VALUES
(1, 'Basic Quiz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answers`
--
ALTER TABLE `Answers`
  ADD PRIMARY KEY (`AnswerID`),
  ADD KEY `AnswersBelongToQuestions` (`QuestionID`);

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`QuestionID`);

--
-- Indexes for table `Quiz`
--
ALTER TABLE `Quiz`
  ADD PRIMARY KEY (`QuizID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Answers`
--
ALTER TABLE `Answers`
  MODIFY `AnswerID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `QuestionID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Quiz`
--
ALTER TABLE `Quiz`
  MODIFY `QuizID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answers`
--
ALTER TABLE `Answers`
  ADD CONSTRAINT `AnswersBelongToQuestions` FOREIGN KEY (`QuestionID`) REFERENCES `Questions` (`QuestionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
