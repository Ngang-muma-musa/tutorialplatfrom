-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2020 at 10:16 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academia`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `studentId` int(11) NOT NULL,
  `ansId` int(11) NOT NULL,
  `answer` text NOT NULL,
  `mark` int(11) NOT NULL,
  `assignmentId` int(11) NOT NULL,
  `status` varchar(225) NOT NULL,
  `submit_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`studentId`, `ansId`, `answer`, `mark`, `assignmentId`, `status`, `submit_date`) VALUES
(1, 1, 'Boolean algebra and logic circuits7.pdf', 15, 1, 'MARKED', 'Saturday 8th of August 2020 07:56:30 AM'),
(3, 2, 'AWAMBENG CAPENTRY WORKSHOP.pdf', 16, 2, 'MARKED', 'Sunday 9th of August 2020 01:58:23 PM'),
(3, 3, 'Past question Physics FET 2018.pdf', 15, 3, 'MARKED', 'Sunday 9th of August 2020 02:04:25 PM');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignmentId` int(11) NOT NULL,
  `topicId` int(11) NOT NULL,
  `content` text NOT NULL,
  `mark` int(3) NOT NULL,
  `correction` text NOT NULL,
  `submit_date` text NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignmentId`, `topicId`, `content`, `mark`, `correction`, `submit_date`, `title`) VALUES
(1, 1, 'matrices.pdf', 30, 'Boolean algebra and logic circuits5-converted.pdf', 'Saturday 8th of August 2020 02:11:30 AM', 'How to do dc analysis'),
(2, 1, 'cef-268-course-outline.pdf', 60, 'fu-money.pdf', 'Saturday 8th of August 2020 11:46:28 PM', 'Ac analysis'),
(3, 8, 'FET 2017 mathematics paper entrance english.pdf', 30, 'FET 2017 mathematics paper entrance english.pdf', 'Sunday 9th of August 2020 02:02:01 PM', 'Tut1');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseCode` varchar(7) NOT NULL,
  `courseTitle` varchar(225) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `creditValue` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseCode`, `courseTitle`, `teacherId`, `creditValue`) VALUES
('CEF210', 'analysis', 3, 4),
('CEF260', 'circuit analysis', 1, 4),
('CSC210', 'matrices', 4, 6),
('CSS231', 'Fuck You', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `courseCode` varchar(7) NOT NULL,
  `studentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`courseCode`, `studentId`) VALUES
('CEF260', 1),
('CEF260', 3),
('CSC210', 3),
('CSS231', 1),
('CSS231', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentId` int(11) NOT NULL,
  `firstName` varchar(225) NOT NULL,
  `lastName` varchar(225) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentId`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'Alice', 'Ndeh', 'alicendeh16@gmail.com', '$2y$10$NZ2exuZuETCHvdcCwDaSM.n2PLTFKOS9mBINn3WFJ.Vy42R8pGhI6'),
(2, 'yannick', 'njume', 'njumeyannick@gmail.com', '$2y$10$RDK.yjLJqJEq/VOkaLyBsupXna7CY7vTmxORkPmNR/mUYjS3jkHKS'),
(3, 'Student', 'Students', 'student@gmail.com', '$2y$10$dVNzXFPsC3932odzqbC7sOgHcx56BAmT81iYXSccaX.Z5WHpHbmOu');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teachersId` int(11) NOT NULL,
  `firstName` varchar(225) NOT NULL,
  `lastName` varchar(225) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teachersId`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'Muma', 'Musa', 'ngangmuma00@gmail.com', '$2y$10$yLZx.h0u/l.nWamKWcjFFeBZxodcIVi3AGrmJjO0vfeigM/b7l4yK'),
(2, 'Mangi ELIjah', 'NChim', 'mangielijah8@gmail.com', '$2y$10$J2YHoIlzyh2Wzy8ZIjByAe28xL7g2HEpYGJAS3qzf7g8dfnjG338m'),
(3, 'Njume', 'Yannick', 'njumeyannick@gmail.com', '$2y$10$XC.DIiLbj1xr77LbfyWCy.N1y15gJJz1n1OdLcXKR0u5n1EPPKm2C'),
(4, 'Teacher', 'Teachers', 'teacher@gmail.com', '$2y$10$t2fFqL6lxLPfKgx9/LfTcejDozWl55IR6laKcKUSyl0fIYSK4xe3y');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `topicId` int(11) NOT NULL,
  `courseCode` varchar(7) NOT NULL,
  `topicName` varchar(225) NOT NULL,
  `Date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topicId`, `courseCode`, `topicName`, `Date`) VALUES
(1, 'CEF260', 'DC Analysis', 'Friday 7th of August 2020 03:11:45 PM'),
(2, 'CEF260', 'This is a topic', 'Friday 7th of August 2020 06:29:27 PM'),
(3, 'CEF260', 'This is a topic', 'Friday 7th of August 2020 06:47:39 PM'),
(4, 'CEF260', 'jhlkjhlkjh l', 'Friday 7th of August 2020 06:53:14 PM'),
(5, 'CEF260', 'Sdkfja;df', 'Friday 7th of August 2020 06:56:41 PM'),
(6, 'CEF260', 'This ias  new topic', 'Friday 7th of August 2020 06:59:42 PM'),
(7, 'CEF210', 'polynomials', 'Sunday 9th of August 2020 11:18:11 AM'),
(8, 'CSC210', 'Vector Spaces', 'Sunday 9th of August 2020 01:23:25 PM');

-- --------------------------------------------------------

--
-- Table structure for table `topiccontent`
--

CREATE TABLE `topiccontent` (
  `contentId` int(11) NOT NULL,
  `topicId` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `submit_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topiccontent`
--

INSERT INTO `topiccontent` (`contentId`, `topicId`, `title`, `content`, `submit_date`) VALUES
(1, 1, 'How to do dc analysis', 'matrices.pdf', 'Friday 7th of August 2020 10:09:41 PM'),
(2, 1, 'How to do dc analysis', 'matrices.pdf', 'Saturday 8th of August 2020 01:52:11 AM'),
(3, 8, 'M1', 'C How to Program.pdf', 'Sunday 9th of August 2020 01:24:03 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`ansId`),
  ADD KEY `studentId` (`studentId`),
  ADD KEY `assignmentId` (`assignmentId`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignmentId`),
  ADD KEY `topicId` (`topicId`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseCode`),
  ADD KEY `teacherId` (`teacherId`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`courseCode`,`studentId`),
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teachersId`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topicId`),
  ADD KEY `courseCode` (`courseCode`);

--
-- Indexes for table `topiccontent`
--
ALTER TABLE `topiccontent`
  ADD PRIMARY KEY (`contentId`),
  ADD KEY `topicId` (`topicId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `ansId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teachersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `topicId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `topiccontent`
--
ALTER TABLE `topiccontent`
  MODIFY `contentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`),
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`assignmentId`);

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`topicId`) REFERENCES `topic` (`topicId`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`teacherId`) REFERENCES `teachers` (`teachersId`);

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`courseCode`) REFERENCES `course` (`courseCode`),
  ADD CONSTRAINT `register_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`courseCode`) REFERENCES `course` (`courseCode`);

--
-- Constraints for table `topiccontent`
--
ALTER TABLE `topiccontent`
  ADD CONSTRAINT `topiccontent_ibfk_1` FOREIGN KEY (`topicId`) REFERENCES `topic` (`topicId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
