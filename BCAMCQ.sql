-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 14, 2024 at 02:08 AM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.3.11

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
(2, 'root', '$2y$10$bMZHNF9PcVwUs4bMO6tk..SXvhNov1lbOXpXnfAC/Jb33rZCWXxam'),
(3, 'summer', '$2y$10$q7z8wfvH.t7fylLIHrIVw.vfZdokQ1uGYTj9aH0UixFYbZok2XLOC'),
(4, 'summer', '$2y$10$q7z8wfvH.t7fylLIHrIVw.vfZdokQ1uGYTj9aH0UixFYbZok2XLOC');

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
  `explanation` text DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `description`, `option_A`, `option_B`, `option_C`, `option_D`, `answer`, `explanation`, `year`) VALUES
(213, 'What is the size of the int data type in C?', '2 bytes', 'sdfa4 bytes', '8 bytes', 'Depends on the system architecture', 'sdfa4 bytes', 'The size of int data type is 4 bytes in most systems.', 0),
(214, 'What will be the output of the following code snippet?\n#include <stdio.h>\nint main()\n{\n    int i = 5;\n    printf(\"%d\", ++i * ++i);\n    return 0;\n}', '36', '30', '42', 'Compiler Error', '42', 'The value of ++i is incremented twice before the multiplication operation.', 0),
(215, 'Which operator is used to access the value at the address of a variable in C?', '*', '&', '$', '#', '&', 'The & operator is used for address-of operations in C.', 0),
(216, 'What is the output of the following code snippet?\n#include <stdio.h>\nint main()\n{\n    int i = 10;\n    printf(\"%d %d %d\", i++, i++, i++);\n    return 0;\n}', '10 11 12', '12 11 10', '11 12 10', 'Undefined behavior', '11 12 10', 'The order of evaluation of i++ is not defined, resulting in undefined behavior.', 0),
(217, 'Which function is used to allocate memory dynamically in C?', 'malloc()', 'calloc()', 'realloc()', 'All of the above', 'All of the above', 'All three functions (malloc, calloc, realloc) are used for dynamic memory allocation.', 0),
(218, 'What is the correct way to declare a pointer to an integer in C?', 'int ptr;', 'ptr int;', 'int *ptr;', 'pointer int;', 'int *ptr;', 'The correct syntax to declare a pointer to an integer is int *ptr;', 0),
(219, 'What does the \'int\' keyword signify in a function declaration in C?', 'The function returns an integer value.', 'The function accepts an integer argument.', 'The function is of type integer.', 'The function is internal to the program.', 'The function returns an integer value.', 'The \'int\' keyword in a function declaration indicates that the function returns an integer value.', 0),
(220, 'What will be the output of the following code snippet?\n#include <stdio.h>\nint main()\n{\n    int x = 5;\n    printf(\"%d %d %d\", x++, x++, x++);\n    return 0;\n}', '5 6 7', '7 6 5', 'Undefined behavior', 'Compiler Error', '5 6 7', 'The order of evaluation of x++ is defined in this case, resulting in the output 5 6 7.', 0),
(221, 'Which of the following is a valid comment in C?', '// This is a comment', '# This is a comment', '; This is a comment', '<!-- This is a comment -->', '// This is a comment', 'In C, comments start with // for single-line comments and /* */ for multi-line comments.', 0),
(222, 'What is the purpose of the sizeof operator in C?', 'To return the size of a variable or data type in bytes', 'To calculate the square root of a number', 'To convert a string to uppercase', 'To increment a variable by 1', 'To return the size of a variable or data type in bytes', 'The sizeof operator is used to determine the size of a variable or data type in bytes.', 0),
(223, 'What will be the output of the following code snippet?\n#include <stdio.h>\nint main()\n{\n    int x = 10;\n    if (x == 10)\n    {\n        printf(\"x is equal to 10\");\n    }\n    else\n    {\n        printf(\"x is not equal to 10\");\n    }\n    return 0;\n}', 'x is equal to 10', 'x is not equal to 10', 'Compiler Error', 'Undefined behavior', 'x is equal to 10', 'The condition x == 10 is true, so the output will be \"x is equal to 10\".', 0),
(224, 'Which of the following is the correct way to declare an array in C?', 'int array[10];', 'array int[10];', 'int *array = new int[10];', 'Array<int> array = new Array<int>(10);', 'int array[10];', 'The correct syntax to declare an array in C is int array[10];', 0),
(225, 'What is the size of the int data type in C?', '2 bytes', '4 bytes', '8 bytes', 'Depends on the system architecture', '4 bytes', 'The size of int data type is 4 bytes in most systems.', 0),
(229, 'fladfj', 'kklh', '', '', '', 'kklh', '', 0),
(231, '', '', '', '', '', '', '', 0),
(238, 'hi', 'salsdfjl', 'dfasdf`', 'dfads', 'dsaf', 'salsdfjl', 'sdfaoidufapisdfujpoa', 0),
(246, 'ddf', 'dsf', 'dsaf', 'adsf', 'asdf', 'dsf', 'asdfa', 2018),
(247, 'asd', 'klasdkff', 'asdf', 'asdfa', 'asdf', 'klasdkff', 'asdf', 2022),
(248, 'daf', 'jgjh', 'jgjhg', 'jhgjg', 'jgj', 'jgjh', 'jgjg', 2023),
(249, 'asd', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'fasdf', 2017),
(250, 'hi', 'hii', 'jkk', 'kjk', 'jkkjk', 'hii', 'kk', 2017),
(251, 'asdf', 'asdf', 'adfa', 'adfa', 'asdf', 'asdf', 'asdf', 2020),
(252, 'fadf', 'asdf', 'adsfaadsf', 'adfafd', 'adf', 'asdf', 'adfafdafds', 2023),
(253, 'asdfa', 'asdf', 'sdfsd', 'asdf', 'asdf', 'asdf', 'adsaf', 2020),
(254, 'asfd', 'jhkjh', 'jhjh', 'jjh', 'jhj', 'jhkjh', 'jjhjh', 2020),
(255, 'asdf', 'asdf', 'sdfas', 'asdf', 'asdf', 'asdf', 'asdfasd', 2020),
(256, 'what', 'as', 'kjhjk', 'jkkjh', 'kjhkjh', 'as', 'kjhkj', 2019),
(257, 'Any measure indicating the centre of a set of data, arranged in an increasing or decreasing order of magnitude, is called a measure of:', 'Skewness', 'Symmetry', 'Central tendency', 'Dispersion', 'Central tendency', 'Central tendency measures the typical or central value in a dataset, which is what this question is describing.', 2020),
(258, 'Scores that differ greatly from the measures of central tendency are called:', 'Raw scores', 'The best scores', 'Extreme scores', 'Z-scores', 'Extreme scores', 'Extreme scores are those that are significantly different from the central measures, fitting the description in the question.', 2020),
(259, 'The measure of central tendency listed below is', 'The raw score', 'The mean', 'The range', 'Standard deviation', 'The mean', 'Among the options, only the mean is a measure of central tendency. The others are either raw data or measures of dispersion.', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `marks` varchar(256) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `marks`, `subject_id`) VALUES
(1, '9/10', 3),
(2, '7/10', 5),
(3, '9/10', 10),
(4, '9/8', 2),
(5, '5/8', 1),
(6, '5/8', 1),
(7, '0', 1),
(8, '0', 1),
(9, '1', 1),
(10, '0', 1),
(11, '1', 1),
(12, '0', 1),
(13, '1', 1),
(14, '1', 1),
(15, '1', 1),
(16, '0', 1),
(17, '0', 1),
(18, '0', 1),
(19, '2', 1),
(20, '1', 1),
(21, '0', 1),
(22, '1', 1),
(23, '1', 2),
(24, '1', 1),
(25, '2', 1),
(26, '1', 4);

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
(6, 224),
(6, 225),
(2, 229),
(3, 231),
(6, 238),
(1, 246),
(1, 247),
(1, 248),
(1, 249),
(1, 250),
(1, 251),
(1, 252),
(1, 253),
(1, 254),
(1, 255),
(1, 256),
(4, 257),
(4, 258),
(4, 259);

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
(37, 'summer', 'hazy', 'kj', '$2y$10$V1LOZeX8dtWJbRwIv./IWu9MzFPMurQohwq7XSdNMhN/.rN.ohFwi', 'hkjl', 'kj'),
(38, 'haze', 'sagarrrr', 'kjk', '$2y$10$dONvZ2IGYZQgtf7tIOYVBu4jjX0G7HkZaJpXOi3SOXM6xW03azlF6', 'adf', 'khk'),
(39, 'summer', 'hazzzz', 'adlfjl', '$2y$10$klxijZnWTNN5Cf.OjjsFUeALaYJL/0ksVJDK.PYbWeb7J/BU3GjKu', 'daf', 'adfljk'),
(40, 'asdfa', 'ljad;slfkj', 'abc', '$2y$10$RSdVPItWCf3tKuuHYZd79Oj/iz9/BRekuAQAT4VhrBc2YqQXcSF1S', 'kj;alskdfj;lk', 'jj;lkajdf;lkj'),
(41, 'adsfa', 'lakjd;flk', 'abcd', '$2y$10$WCd3zTKYHycHT0z1QzGGJu0/WfTfOcXMygEksdN4k.fVl73hlW3ge', 'lajksdf;lkj', 'alksdf;lk'),
(42, 'dhfakljh', 'khlkjh', 'hkjhkjh', '$2y$10$Hfk0U.T70wTjWird.vDYMuZI/84/O1zdVlnmceyS13ok.9W2UhZZK', 'kjhlkjhl', 'hlkjhlkj'),
(43, 'arr', 'dfa', 'lakjdf;lak', '$2y$10$/KJArWKd9qBfpZW/1PzK6.pkzT5tmUx5auDRfDx0DJsGDV4dEoXGy', 'alfjalk', 'lkja;ldkfj;lkaa'),
(44, 'daf', 'ljl', 'ljl', '$2y$10$P8XZHQVMnr9hnJZVWOBLBe980CM25AFvUOJwfbGKM8nINdKjB.CJ.', 'lkjlk', 'lkj'),
(45, 'afa', 'lj;lkj', 'l;kj;lk', '$2y$10$z1FdnIMx.ZEJFObRW1B/EObO6tFkKR7PYMK.xJCqcvtBq46nGOfpe', 'lkj', ';lkj;lkj'),
(46, 'adkfjalk', 'lkja;lsdkfjlk', 'lk.j;lakj', '$2y$10$omUfhgMvEm6YozrRIoU2EOp7VAqBvcQxI7OyL2eJm1Da.wutXxCVy', 'j;lkja;sldkfj', 'lkja;sdlkfj;'),
(47, 'dsfalj', ';lkj;lkj;l', 'j;', '$2y$10$F2JVekJBLLtJBQEbpR5PFOPwDw5JlKARSKSjaJ6Gt8O.JW6pxMeSS', 'kj;lkj', ';lk.j;lk'),
(48, 'dfa', 'lkja;lkjdff', 'kjad', '$2y$10$.1efgeVaFq0JpQprsxyTjuFZYYBdO7D.TLBCe1MMfS8KxGGcc1o.G', 'lj;lakjdsf;lkj', ';lkja;lkdsfjm;l'),
(49, 'adf', 'ljadlkj', 'kj;kljd;lkjak', '$2y$10$LI4d6sBL53j6JlJEGgFzCuEuyfIdC0M1EPQtwdmXRY2HMel9m6QTW', 'ljk;lk', 'j;lkalkdj;'),
(50, 'sagar', 'lamichhane', 'summerlc', '$2y$10$p0IsWnco15/zR9Cn2kuCxeE0LwxF5XkL1eU0hcQF3bs2TdQxQmEkC', 'sagarlamichhane929@gamil.com', '987876598'),
(51, 'summer', 'haze', 'sagar', '$2y$10$Y95CB/IXIigp8n9i1pORJeYZISp9NyuHtuTNRLbMldlCJNzOuUvQa', 'sagarlamichhane@gmail.com', '98765678767887'),
(52, 'summer', 'hazzy', 'summer', '$2y$10$q7z8wfvH.t7fylLIHrIVw.vfZdokQ1uGYTj9aH0UixFYbZok2XLOC', 'summer@gmail.com', '1111111'),
(53, 'hi', 'asd', 'fadsfa', '$2y$10$tt7p3zn9TWJl./39Ya1wV.nZj3rAB/4x.drEfxuJvjw3icUzNld8m', 'afda@gmai.com', 'dfas'),
(54, 'ldjfa;lsdk', 'aksjdf;lkj', 'aklsdjf;laksj', '$2y$10$XBn7l2M/4ERcg6fFgnFHXOz3sSPTgn0dCcj5oMcfSVAzfKzHz0qWe', 'swefrghjj@gmail.com', 'kls'),
(55, 'saf', 'asd', 'saga', '$2y$10$a53d8zBbT.3kcCjwlsN0L./SkIVOYJiwz87PZeqQWjVjdR0D7WzxW', 'asdfsd@gmai.com', '98576565656'),
(56, 'sagar', 'haze', 'summerh', '$2y$10$HKFjlPSF.tC9vUOVT1x2o.z4endQNfXUSplztYaqkACEF9sKfpyR2', 'summerhaze@gmail.com', '1234567898'),
(57, 'asdfa', 'adfa', 'adfa', '$2y$10$TEV6h5oN5cCgE9ae.Yneq.h23F0k5VdV1TlUnTuKHVV/hhgtChEVu', 'asdf', 'adf'),
(58, 'sdf', 'asdf', 'asdf', '$2y$10$qGbBv25sYzofv37jmePXReTKDa3/mTDiYK2JSnrIlvz/HvaFscvmC', 'asdf', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_report`
--

CREATE TABLE `user_report` (
  `user_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_report`
--

INSERT INTO `user_report` (`user_id`, `report_id`) VALUES
(50, 5),
(52, 25),
(52, 26);

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
-- Indexes for table `user_report`
--
ALTER TABLE `user_report`
  ADD PRIMARY KEY (`report_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_report`
--
ALTER TABLE `user_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
