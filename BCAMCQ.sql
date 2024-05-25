-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2024 at 09:59 AM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BCAMCQ`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `aname` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `aname`, `password`) VALUES
(1, 'admin', '$2y$10$EHuUlv3fRdJf7emVQvcWU.0aW7kc0V5XUKEtmbTGVaOFhycn.hHYS'),
(2, 'root', '$2y$10$bMZHNF9PcVwUs4bMO6tk..SXvhNov1lbOXpXnfAC/Jb33rZCWXxam');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `option_A` varchar(256) DEFAULT NULL,
  `option_B` varchar(256) DEFAULT NULL,
  `option_C` varchar(256) DEFAULT NULL,
  `option_D` varchar(256) DEFAULT NULL,
  `answer` varchar(256) DEFAULT NULL,
  `explanation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `description`, `option_A`, `option_B`, `option_C`, `option_D`, `answer`, `explanation`) VALUES
(211, 'What is the output of the following code snippet?', 'int x = 10; printf(\"%d\", x++);', '10', '11', 'Compiler Error', '10', 'The postfix increment operator (x++) increments x after returning its value.'),
(212, 'Which of the following is not a valid keyword in C?', 'yield', 'int', 'extern', 'goto', 'yield', 'yield is not a valid keyword in C programming.'),
(213, 'What is the size of the int data type in C?', '2 bytes', '4 bytes', '8 bytes', 'Depends on the system architecture', '4 bytes', 'The size of int data type is 4 bytes in most systems.'),
(214, 'What will be the output of the following code snippet?\n#include <stdio.h>\nint main()\n{\n    int i = 5;\n    printf(\"%d\", ++i * ++i);\n    return 0;\n}', '36', '30', '42', 'Compiler Error', '42', 'The value of ++i is incremented twice before the multiplication operation.'),
(215, 'Which operator is used to access the value at the address of a variable in C?', '*', '&', '$', '#', '&', 'The & operator is used for address-of operations in C.'),
(216, 'What is the output of the following code snippet?\n#include <stdio.h>\nint main()\n{\n    int i = 10;\n    printf(\"%d %d %d\", i++, i++, i++);\n    return 0;\n}', '10 11 12', '12 11 10', '11 12 10', 'Undefined behavior', '11 12 10', 'The order of evaluation of i++ is not defined, resulting in undefined behavior.'),
(217, 'Which function is used to allocate memory dynamically in C?', 'malloc()', 'calloc()', 'realloc()', 'All of the above', 'All of the above', 'All three functions (malloc, calloc, realloc) are used for dynamic memory allocation.'),
(218, 'What is the correct way to declare a pointer to an integer in C?', 'int ptr;', 'ptr int;', 'int *ptr;', 'pointer int;', 'int *ptr;', 'The correct syntax to declare a pointer to an integer is int *ptr;'),
(219, 'What does the \'int\' keyword signify in a function declaration in C?', 'The function returns an integer value.', 'The function accepts an integer argument.', 'The function is of type integer.', 'The function is internal to the program.', 'The function returns an integer value.', 'The \'int\' keyword in a function declaration indicates that the function returns an integer value.'),
(220, 'What will be the output of the following code snippet?\n#include <stdio.h>\nint main()\n{\n    int x = 5;\n    printf(\"%d %d %d\", x++, x++, x++);\n    return 0;\n}', '5 6 7', '7 6 5', 'Undefined behavior', 'Compiler Error', '5 6 7', 'The order of evaluation of x++ is defined in this case, resulting in the output 5 6 7.'),
(221, 'Which of the following is a valid comment in C?', '// This is a comment', '# This is a comment', '; This is a comment', '<!-- This is a comment -->', '// This is a comment', 'In C, comments start with // for single-line comments and /* */ for multi-line comments.'),
(222, 'What is the purpose of the sizeof operator in C?', 'To return the size of a variable or data type in bytes', 'To calculate the square root of a number', 'To convert a string to uppercase', 'To increment a variable by 1', 'To return the size of a variable or data type in bytes', 'The sizeof operator is used to determine the size of a variable or data type in bytes.'),
(223, 'What will be the output of the following code snippet?\n#include <stdio.h>\nint main()\n{\n    int x = 10;\n    if (x == 10)\n    {\n        printf(\"x is equal to 10\");\n    }\n    else\n    {\n        printf(\"x is not equal to 10\");\n    }\n    return 0;\n}', 'x is equal to 10', 'x is not equal to 10', 'Compiler Error', 'Undefined behavior', 'x is equal to 10', 'The condition x == 10 is true, so the output will be \"x is equal to 10\".'),
(224, 'Which of the following is the correct way to declare an array in C?', 'int array[10];', 'array int[10];', 'int *array = new int[10];', 'Array<int> array = new Array<int>(10);', 'int array[10];', 'The correct syntax to declare an array in C is int array[10];');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `marks` varchar(256) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_name`) VALUES
(1, 'First Semester'),
(2, 'Second Semester'),
(3, 'Third Semester');

-- --------------------------------------------------------

--
-- Table structure for table `semester_subject`
--

CREATE TABLE `semester_subject` (
  `semester_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `semester_subject`
--

INSERT INTO `semester_subject` (`semester_id`, `subject_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`) VALUES
(1, 'Computer Fundamentals & Applications'),
(2, 'Society & Technology'),
(3, 'English I'),
(4, 'Mathematics I'),
(5, 'Digital Logic'),
(6, 'C Programming'),
(7, 'Financial Accounting'),
(8, 'English II'),
(9, 'Mathematics II'),
(10, 'Microproccessor and Computer Architecture'),
(11, 'Data Structures & Algorithms'),
(12, 'Probability and Statistics'),
(13, 'System Analysis and Design'),
(14, 'OOP in Java'),
(15, 'Web Technology');

-- --------------------------------------------------------

--
-- Table structure for table `subject_question`
--

CREATE TABLE `subject_question` (
  `subject_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subject_question`
--

INSERT INTO `subject_question` (`subject_id`, `question_id`) VALUES
(6, 211),
(6, 212),
(6, 213),
(6, 214),
(6, 215),
(6, 216),
(6, 217),
(6, 218),
(6, 219),
(6, 220),
(6, 221),
(6, 222),
(6, 223),
(6, 224);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `fname` varchar(64) DEFAULT NULL,
  `lname` varchar(64) NOT NULL,
  `uname` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `contact_no` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `fname`, `lname`, `uname`, `password`, `email`, `contact_no`) VALUES
(2, 'sakhjg', 'kjlhg', 'ljkhg', 'adfsgdfsg', 'sagar@gamil.com', '089876'),
(3, ';ljkhgfds', 'kljhgf', 'hari', '$2y$10$3boajxhcG.MVoULXP.jJZO1n8wXwnXPxgiz/Ga6Fl9l1ZMqlknFq6', 'dfghjg.@gmail.com', '09867987'),
(4, 'user', 'user', 'user', '$2y$10$bMZHNF9PcVwUs4bMO6tk..SXvhNov1lbOXpXnfAC/Jb33rZCWXxam', 'user@gmail.com', '80967'),
(5, 'ghjk', 'gjhkjlk', 'hjkl;', '$2y$10$t489..lBQcLtRGi1W3oPm.uMGKPWusWznHgrrkOanTd3rbZmnjhOS', 'hgjkl', 'ghjkl'),
(6, 'ghjk', 'ghjkl', 'hgjkll', '$2y$10$OS1rRpvQZVHdfOA16OK5AOme9sfar13tvmVs7TETtwNUg9.pD6Dd2', 'hgjkl', 'hjgkl'),
(7, 'summer', 'ghjk', 'summer', '$2y$10$wbgZeiInCvbtGpHgRLRePuYEbGMI8mORkFnow91GMODRYRBvqdmsi', 'hjk', 'jhk'),
(8, 'summer', 'ghjk', 'kgh', '$2y$10$KsIeMDqJYV5Zms6GIjnBlOOqa2a/Fa41mPexOGi.dxey8DjNXu0bK', 'ghjk', 'ghj'),
(9, 'summer', 'ghjk', 'hgjk', '$2y$10$kyPoHgHFnHALMgFIbsDuhOz.k38keIVQqz.ceqGIAx0IE1vttWNGK', 'ghjkl', 'hgjk'),
(10, 'ghjk', 'ghjk', 'gfhjk', '$2y$10$AA2TQlaLLzanPybVy6A3huGCOqQtdkJj60Dx1nvil6zO0q2FgUe8m', 'ghjk', 'gfhjk'),
(11, 'ghjkl', 'jkl', 'ghjkl', '$2y$10$QqoyVWdkX.jK0WMbd0iBA.Zd9z0y4n6GN67kSkl3ekoP67JhHz2hK', 'ghjkl', 'ghjkl'),
(12, 'ghjkl', 'hjk', 'hjkl', '$2y$10$lo.pN/ocHw39kQtugH3/cuRX7x8fMj2STMKwMrO2yjXfIXTTG8a9K', 'gvhjkl', 'hjkl'),
(13, 'fghj', 'ghjk', 'ghjk', '$2y$10$mA5bJ75HpFxW1z7DWHbApOrKCalQBV/qtck6mDul5nuwgAbL0/Qni', 'ghjk', 'ghjk'),
(14, 'ghjk', 'hgjkl', 'vhjkl', '$2y$10$SeoeIN8HMl3EccuES7u64.6gfyuFGmfIOEtw/hKOfyjGLyQhSW8py', 'ghjkl', 'ghjkl'),
(15, 'gjhkl', 'ghjkl', 'hjkl;ghjkl;', '$2y$10$hu4q5id8cLxH1CtcrFb7lOcaoYeHyPk1xBgjPpSvI9MJ2evXqp6/S', 'ghjkl;', 'hjkl'),
(16, 'safa', 'hgjkl', 'ghjklghjkl', '$2y$10$/YogJKBFgJzQPMnBWdK6w.JaAB19PLl2g5UmrCk3MOjLrdhfZ0Sha', 'ghjkl', 'ghjkl'),
(17, 'jhkl', 'ghjkl', 'hgjkl', '$2y$10$LBfGnFyCIf93vfeelp74huB.4z8tHKbF3VW/RIrSomjtivEs8.YhG', 'ghjkl', 'hgjkl'),
(18, 'gfhjkl', 'ghjkl', 'gfhjkl', '$2y$10$YH.3tl68/hHZUaKwo0hWTutzx.trx0OY3N1DEZZFQnOG6ILT1xAt6', 'ghjkl', 'gfhjkl'),
(19, 'sagar', 'summe', 'hjgk', '$2y$10$Tbik9iHiQ1Bf95s9cLAkY.m7iouo4srY5kWiK8hQgCFulpe5GIhji', 'hjk', 'ghjk'),
(20, 'ghjk', 'fdghj', 'ghjkgfhjk', '$2y$10$NBsdY2o4U3MFGFm3cRMrhuNhMg1uAp1JXOzY4pQ5iZrjjopPmrPly', 'fghj', 'gfhjk'),
(21, 'fghjkl', 'fghjkl;', 'ghjkl;', '$2y$10$9ArV/HO.WPsvvlMtMhjaYOO73Wg2ykFnGnDknFdVO4yFJEVhW0vHS', 'fghjkl;', 'gfhjkl;'),
(22, 'fghjkl', 'ghjk', 'ghjklgfhjkl', '$2y$10$lTMbbh/TSlmwDVICoJH1RO7K6hpXRyKqyUMnAf9qInMGdj2Ggl3A.', 'ghjkl', 'ghjkl'),
(23, 'a', 'b', 'h', '$2y$10$IAOMJweXZc6mfJpW0wUxHu0OTPuiJME9oulL/vAcUtGzlw5rdd9xu', 's', 'g'),
(24, 'b', 'g', 'j', '$2y$10$nbrSbJwu2/gh76ejDug75OPpMd3ZjHoUH5w6e4EG6O1kZ5CaF4XCe', 'h', 'h'),
(25, 'b', 'g', 'jg', '$2y$10$tNc1.1cWTYHhOl13sUMphudHGF5i2Ln.Humx2.T74ax1TydFy8A0O', 'h', 'h'),
(26, 'hi', 'hi', 'hi', '$2y$10$GQ5PLj9tt0vvjT0eCW9SJe65UsowBpMUQc2XawWKa9eVJRp8I/mhO', 'hi', 'hi'),
(27, 'i', 'hi', 'highjkl', '$2y$10$TVYI57LzZ1e00vyRN.PQXunu3ccheGUTwsRlPI0ZZicz6tXLN3dvG', 'h', 'i'),
(28, 'fgh', 'ghjk', 'ghj', '$2y$10$jLKiBR09TsxBXAJls0ABC.gN6.mYF5Weu4jSa/5ujaSF6oItMgybK', 'ghj', 'ghjk'),
(29, 'ghjk', 'fgh', 'ghj5678', '$2y$10$DDqoIz31C.BvJAXwNwg1seo/CQcjFXJHHyA09pRYRihadJW5PC7Au', 'ghj', 'fghj'),
(30, 'dfad', 'adsfasdf', 'assdd', '$2y$10$YnV7jYi48L16sNAI3Shx.erjL18IAHg8YRjjpFrrzkxy5R50HaqPm', 'adsaf', 'sdadsf'),
(31, 'dfad', 'adsfasdf', 'assdds', '$2y$10$FKJdelNXXSgk1CKGQP8p6.CauJp9sZe6C8OYL1.B8wJT0cwu8GNMW', 'adsaf', 'sdadsf'),
(32, 'dfad', 'adsfasdf', 'assddsdsfsa', '$2y$10$8YLkhMEqFZ9GwBa1CKsJVO.RsjT/Gp6NL5OxNSF66Y1SCbXVN8hMC', 'adsaf', 'sdadsf'),
(33, 'dfad', 'adsfasdf', 'assddsdsfsasdfas', '$2y$10$b7tnTTmQr21W3kE42ibJz.Pohi/jRtEa2lVaMlztPeqTRsgkWZIOq', 'adsaf', 'sdadsf'),
(34, 'ghjk', 'ghjk', 'ghjkghjk', '$2y$10$aKmsgaaEfa42jMHJpQzPL.s6mdT2HSZFAgVmwE6lMf0xe9zo0PhDy', 'ghjk', 'ghjk'),
(35, 'ghjk', 'ghjk', 'ghjkghjkxfg', '$2y$10$nySQv3dihLYJM5y/mbGlsOxtzdiSiq/RDCFWp5IbBGvTuncdQ42Y6', 'ghjk', 'ghjk'),
(36, 'ghjk', 'ghjk', 'ghjkghjkxfgfgh', '$2y$10$T6Vlu6GBeBcVw31ACV3vVOAE3A4kE45vJMfGe6WU7LEQnm/lOj8iu', 'ghjk', 'ghjk');

-- --------------------------------------------------------

--
-- Table structure for table `user_report`
--

CREATE TABLE `user_report` (
  `user_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `semester_subject`
--
ALTER TABLE `semester_subject`
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_question`
--
ALTER TABLE `subject_question`
  ADD PRIMARY KEY (`subject_id`,`question_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `semester_subject`
--
ALTER TABLE `semester_subject`
  ADD CONSTRAINT `semester_subject_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `semester_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`);

--
-- Constraints for table `subject_question`
--
ALTER TABLE `subject_question`
  ADD CONSTRAINT `subject_question_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `subject_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
