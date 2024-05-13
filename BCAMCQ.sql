-- MariaDB dump 10.19-11.3.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: BCAMCQ
-- ------------------------------------------------------
-- Server version	11.3.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `aname` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES
(1,'admin','$2y$10$EHuUlv3fRdJf7emVQvcWU.0aW7kc0V5XUKEtmbTGVaOFhycn.hHYS'),
(2,'root','$2y$10$bMZHNF9PcVwUs4bMO6tk..SXvhNov1lbOXpXnfAC/Jb33rZCWXxam');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text DEFAULT NULL,
  `option_A` varchar(256) DEFAULT NULL,
  `option_B` varchar(256) DEFAULT NULL,
  `option_C` varchar(256) DEFAULT NULL,
  `option_D` varchar(256) DEFAULT NULL,
  `answer` varchar(256) DEFAULT NULL,
  `explanation` text DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES
(73,'How does technology impact employment and the future of work?','Automation and job displacement','Skills evolution and retraining','Gig economy and flexible work arrangements','All of the above','D','Technology affects employment by introducing automation, evolving skills requirements, and shaping the gig economy, necessitating retraining and adaptation for the future of work.'),
(74,'What are the implications of AI and machine learning in decision-making?','Efficiency and accuracy in data analysis','Bias and ethical considerations','Automated decision-making processes','All of the above','D','AI and machine learning offer efficiency and accuracy but also raise concerns about bias and ethical decision-making in automated processes.'),
(75,'How does technology influence privacy and personal data protection?','Data encryption and secure storage','Surveillance and data breaches','Privacy regulations and compliance','All of the above','D','Technology impacts privacy through encryption and secure storage but also raises concerns about surveillance, data breaches, and the need for privacy regulations and compliance.'),
(76,'des','opta','optb','optc','optd','ans','exp'),
(77,'des','opta','optb','optc','optd','ans','exp'),
(81,'neae','dsfsdf','dsffs','dsfaf','dsffs','adfaf','hi'),
(85,'sdfasd','asdf','adfa','sdfg','sdfg','sdfg','sdfgd'),
(86,'sdfasd','asdf','adfa','sdfg','sdfg','sdfg','sdfgd'),
(87,'dadf','asdf','asdf','asdf','adsf','asddf','assdf'),
(88,'What is SQL?','Structured Query Language','Static Query Language','Sequential Query Language','Structured Question Language','Structured Query Language','SQL stands for Structured Query Language.'),
(89,'What is the default sorting order of ORDER BY clause?','ASC','DESC','RAND','None of the above','ASC','ASC is the default sorting order in ORDER BY clause.'),
(90,'Which SQL keyword is used to retrieve a unique value from a table?','UNIQUE','DISTINCT','SINGLE','SELECT','DISTINCT','DISTINCT is used to retrieve unique values.'),
(91,'What does the SQL command COMMIT do?','Saves changes to the database','Reverts changes made in the current session','Creates a new table','None of the above','Saves changes to the database','COMMIT saves changes made in the current transaction to the database.'),
(92,'Which operator is used in SQL for pattern matching?','LIKE','MATCH','FIND','SEARCH','LIKE','LIKE operator is used for pattern matching in SQL.'),
(93,'hi','hghjk','ghjk','ghj','ghj','ghj','fghjkghj');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`semester_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

LOCK TABLES `semester` WRITE;
/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
INSERT INTO `semester` VALUES
(1,'First Semester'),
(2,'Second Semester'),
(3,'Third Semester');
/*!40000 ALTER TABLE `semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester_subject`
--

DROP TABLE IF EXISTS `semester_subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semester_subject` (
  `semester_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  KEY `semester_id` (`semester_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `semester_subject_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  CONSTRAINT `semester_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester_subject`
--

LOCK TABLES `semester_subject` WRITE;
/*!40000 ALTER TABLE `semester_subject` DISABLE KEYS */;
INSERT INTO `semester_subject` VALUES
(1,1),
(1,2),
(1,3),
(1,4),
(1,5),
(2,6),
(2,7),
(2,8),
(2,9),
(2,10),
(3,11),
(3,12),
(3,13),
(3,14),
(3,15);
/*!40000 ALTER TABLE `semester_subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES
(1,'Computer Fundamentals & Applications'),
(2,'Society & Technology'),
(3,'English I'),
(4,'Mathematics I'),
(5,'Digital Logic'),
(6,'C Programming'),
(7,'Financial Accounting'),
(8,'English II'),
(9,'Mathematics II'),
(10,'Microproccessor and Computer Architecture'),
(11,'Data Structures & Algorithms'),
(12,'Probability and Statistics'),
(13,'System Analysis and Design'),
(14,'OOP in Java'),
(15,'Web Technology');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject_question`
--

DROP TABLE IF EXISTS `subject_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_question` (
  `subject_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`,`question_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `subject_question_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  CONSTRAINT `subject_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_question`
--

LOCK TABLES `subject_question` WRITE;
/*!40000 ALTER TABLE `subject_question` DISABLE KEYS */;
INSERT INTO `subject_question` VALUES
(2,73),
(2,74),
(2,75),
(2,77),
(1,81),
(7,85),
(7,86),
(1,87),
(5,88),
(5,89),
(5,90),
(5,91),
(5,92),
(2,93);
/*!40000 ALTER TABLE `subject_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(64) DEFAULT NULL,
  `lname` varchar(64) NOT NULL,
  `uname` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `contact_no` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(2,'sakhjg','kjlhg','ljkhg','adfsgdfsg','sagar@gamil.com','089876'),
(3,';ljkhgfds','kljhgf','hari','$2y$10$3boajxhcG.MVoULXP.jJZO1n8wXwnXPxgiz/Ga6Fl9l1ZMqlknFq6','dfghjg.@gmail.com','09867987'),
(4,'user','user','user','$2y$10$bMZHNF9PcVwUs4bMO6tk..SXvhNov1lbOXpXnfAC/Jb33rZCWXxam','user@gmail.com','80967'),
(5,'ghjk','gjhkjlk','hjkl;','$2y$10$t489..lBQcLtRGi1W3oPm.uMGKPWusWznHgrrkOanTd3rbZmnjhOS','hgjkl','ghjkl'),
(6,'ghjk','ghjkl','hgjkll','$2y$10$OS1rRpvQZVHdfOA16OK5AOme9sfar13tvmVs7TETtwNUg9.pD6Dd2','hgjkl','hjgkl'),
(7,'summer','ghjk','summer','$2y$10$wbgZeiInCvbtGpHgRLRePuYEbGMI8mORkFnow91GMODRYRBvqdmsi','hjk','jhk'),
(8,'summer','ghjk','kgh','$2y$10$KsIeMDqJYV5Zms6GIjnBlOOqa2a/Fa41mPexOGi.dxey8DjNXu0bK','ghjk','ghj'),
(9,'summer','ghjk','hgjk','$2y$10$kyPoHgHFnHALMgFIbsDuhOz.k38keIVQqz.ceqGIAx0IE1vttWNGK','ghjkl','hgjk'),
(10,'ghjk','ghjk','gfhjk','$2y$10$AA2TQlaLLzanPybVy6A3huGCOqQtdkJj60Dx1nvil6zO0q2FgUe8m','ghjk','gfhjk'),
(11,'ghjkl','jkl','ghjkl','$2y$10$QqoyVWdkX.jK0WMbd0iBA.Zd9z0y4n6GN67kSkl3ekoP67JhHz2hK','ghjkl','ghjkl'),
(12,'ghjkl','hjk','hjkl','$2y$10$lo.pN/ocHw39kQtugH3/cuRX7x8fMj2STMKwMrO2yjXfIXTTG8a9K','gvhjkl','hjkl'),
(13,'fghj','ghjk','ghjk','$2y$10$mA5bJ75HpFxW1z7DWHbApOrKCalQBV/qtck6mDul5nuwgAbL0/Qni','ghjk','ghjk'),
(14,'ghjk','hgjkl','vhjkl','$2y$10$SeoeIN8HMl3EccuES7u64.6gfyuFGmfIOEtw/hKOfyjGLyQhSW8py','ghjkl','ghjkl'),
(15,'gjhkl','ghjkl','hjkl;ghjkl;','$2y$10$hu4q5id8cLxH1CtcrFb7lOcaoYeHyPk1xBgjPpSvI9MJ2evXqp6/S','ghjkl;','hjkl'),
(16,'safa','hgjkl','ghjklghjkl','$2y$10$/YogJKBFgJzQPMnBWdK6w.JaAB19PLl2g5UmrCk3MOjLrdhfZ0Sha','ghjkl','ghjkl'),
(17,'jhkl','ghjkl','hgjkl','$2y$10$LBfGnFyCIf93vfeelp74huB.4z8tHKbF3VW/RIrSomjtivEs8.YhG','ghjkl','hgjkl'),
(18,'gfhjkl','ghjkl','gfhjkl','$2y$10$YH.3tl68/hHZUaKwo0hWTutzx.trx0OY3N1DEZZFQnOG6ILT1xAt6','ghjkl','gfhjkl'),
(19,'sagar','summe','hjgk','$2y$10$Tbik9iHiQ1Bf95s9cLAkY.m7iouo4srY5kWiK8hQgCFulpe5GIhji','hjk','ghjk'),
(20,'ghjk','fdghj','ghjkgfhjk','$2y$10$NBsdY2o4U3MFGFm3cRMrhuNhMg1uAp1JXOzY4pQ5iZrjjopPmrPly','fghj','gfhjk'),
(21,'fghjkl','fghjkl;','ghjkl;','$2y$10$9ArV/HO.WPsvvlMtMhjaYOO73Wg2ykFnGnDknFdVO4yFJEVhW0vHS','fghjkl;','gfhjkl;'),
(22,'fghjkl','ghjk','ghjklgfhjkl','$2y$10$lTMbbh/TSlmwDVICoJH1RO7K6hpXRyKqyUMnAf9qInMGdj2Ggl3A.','ghjkl','ghjkl'),
(23,'a','b','h','$2y$10$IAOMJweXZc6mfJpW0wUxHu0OTPuiJME9oulL/vAcUtGzlw5rdd9xu','s','g'),
(24,'b','g','j','$2y$10$nbrSbJwu2/gh76ejDug75OPpMd3ZjHoUH5w6e4EG6O1kZ5CaF4XCe','h','h'),
(25,'b','g','jg','$2y$10$tNc1.1cWTYHhOl13sUMphudHGF5i2Ln.Humx2.T74ax1TydFy8A0O','h','h'),
(26,'hi','hi','hi','$2y$10$GQ5PLj9tt0vvjT0eCW9SJe65UsowBpMUQc2XawWKa9eVJRp8I/mhO','hi','hi'),
(27,'i','hi','highjkl','$2y$10$TVYI57LzZ1e00vyRN.PQXunu3ccheGUTwsRlPI0ZZicz6tXLN3dvG','h','i'),
(28,'fgh','ghjk','ghj','$2y$10$jLKiBR09TsxBXAJls0ABC.gN6.mYF5Weu4jSa/5ujaSF6oItMgybK','ghj','ghjk'),
(29,'ghjk','fgh','ghj5678','$2y$10$DDqoIz31C.BvJAXwNwg1seo/CQcjFXJHHyA09pRYRihadJW5PC7Au','ghj','fghj'),
(30,'dfad','adsfasdf','assdd','$2y$10$YnV7jYi48L16sNAI3Shx.erjL18IAHg8YRjjpFrrzkxy5R50HaqPm','adsaf','sdadsf'),
(31,'dfad','adsfasdf','assdds','$2y$10$FKJdelNXXSgk1CKGQP8p6.CauJp9sZe6C8OYL1.B8wJT0cwu8GNMW','adsaf','sdadsf'),
(32,'dfad','adsfasdf','assddsdsfsa','$2y$10$8YLkhMEqFZ9GwBa1CKsJVO.RsjT/Gp6NL5OxNSF66Y1SCbXVN8hMC','adsaf','sdadsf'),
(33,'dfad','adsfasdf','assddsdsfsasdfas','$2y$10$b7tnTTmQr21W3kE42ibJz.Pohi/jRtEa2lVaMlztPeqTRsgkWZIOq','adsaf','sdadsf'),
(34,'ghjk','ghjk','ghjkghjk','$2y$10$aKmsgaaEfa42jMHJpQzPL.s6mdT2HSZFAgVmwE6lMf0xe9zo0PhDy','ghjk','ghjk'),
(35,'ghjk','ghjk','ghjkghjkxfg','$2y$10$nySQv3dihLYJM5y/mbGlsOxtzdiSiq/RDCFWp5IbBGvTuncdQ42Y6','ghjk','ghjk'),
(36,'ghjk','ghjk','ghjkghjkxfgfgh','$2y$10$T6Vlu6GBeBcVw31ACV3vVOAE3A4kE45vJMfGe6WU7LEQnm/lOj8iu','ghjk','ghjk');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-13  7:10:28
