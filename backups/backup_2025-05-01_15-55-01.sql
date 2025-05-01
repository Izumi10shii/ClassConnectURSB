-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: classconnectdb
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `audit_trail`
--

DROP TABLE IF EXISTS `audit_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_trail` (
  `audit_id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `action` varchar(255) DEFAULT NULL,
  `student_no` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  PRIMARY KEY (`audit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_trail`
--

LOCK TABLES `audit_trail` WRITE;
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookmarks_tb`
--

DROP TABLE IF EXISTS `bookmarks_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmarks_tb` (
  `bookmark_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `bookmarked_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`bookmark_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks_tb`
--

LOCK TABLES `bookmarks_tb` WRITE;
/*!40000 ALTER TABLE `bookmarks_tb` DISABLE KEYS */;
INSERT INTO `bookmarks_tb` VALUES (11,19,'David1234','2025-04-27 15:10:40'),(12,20,'David1234','2025-04-27 20:14:42'),(16,41,'Izumii10shii','2025-04-30 18:45:52'),(17,42,'Izumii10shii','2025-05-01 18:43:44'),(18,43,'Izumii10shii','2025-05-01 20:48:22'),(19,20,'Izumii10shii','2025-05-01 20:48:30');
/*!40000 ALTER TABLE `bookmarks_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_likes_tb`
--

DROP TABLE IF EXISTS `comment_likes_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_likes_tb` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `username` int(11) NOT NULL,
  `like_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_likes_tb`
--

LOCK TABLES `comment_likes_tb` WRITE;
/*!40000 ALTER TABLE `comment_likes_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment_likes_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_replies_tb`
--

DROP TABLE IF EXISTS `comment_replies_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_replies_tb` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `username` int(11) NOT NULL,
  `reply_text` text NOT NULL,
  `reply_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_replies_tb`
--

LOCK TABLES `comment_replies_tb` WRITE;
/*!40000 ALTER TABLE `comment_replies_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment_replies_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_tb`
--

DROP TABLE IF EXISTS `comment_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_tb` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `comment_desc` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_tb`
--

LOCK TABLES `comment_tb` WRITE;
/*!40000 ALTER TABLE `comment_tb` DISABLE KEYS */;
INSERT INTO `comment_tb` VALUES (9,'David1234','Testing',20,'2025-04-26 06:24:10'),(11,'Izumii10shii','naaah',20,'2025-04-29 13:01:45'),(18,'Izumii10shii','a',20,'2025-04-30 04:46:16'),(19,'randomUser','test',20,'2025-04-30 06:04:22'),(20,'Izumii10shii','Yeah',43,'2025-05-01 11:13:44'),(21,'Izumii10shii','Yeeaaa',43,'2025-05-01 11:17:02'),(22,'Izumii10shii','Yeeaaa',43,'2025-05-01 11:19:22'),(23,'Izumii10shii','wow',43,'2025-05-01 11:27:29');
/*!40000 ALTER TABLE `comment_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_storage_tb`
--

DROP TABLE IF EXISTS `file_storage_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_storage_tb` (
  `sfile_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`sfile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_storage_tb`
--

LOCK TABLES `file_storage_tb` WRITE;
/*!40000 ALTER TABLE `file_storage_tb` DISABLE KEYS */;
INSERT INTO `file_storage_tb` VALUES (2,'David1234','Skirk','Genshin','1345025.png','2025-04-27 20:13:46'),(5,'Izumii10shii','Vergil','Yeah','1105295_1746099173.jpg','2025-05-01 19:32:53'),(7,'Izumii10shii','Text','Try','b1b2cb1fa43c79e52a86e51c448ac04e_1746101422.jpg','2025-05-01 20:10:22'),(8,'Izumii10shii','Skirk','Genshin','1345025 (1).png','2025-05-01 20:16:35'),(9,'Izumii10shii','Skirk','Yeah','1345025 (1).png','2025-05-01 20:25:20'),(16,'Izumii10shii','Vergil','Yeah','1105295.jpg','2025-05-01 20:44:33'),(17,'Izumii10shii','Vergil','Try','image_2025-05-01_210425699.png','2025-05-01 21:04:26');
/*!40000 ALTER TABLE `file_storage_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_files_tb`
--

DROP TABLE IF EXISTS `post_files_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_files_tb` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_url` varchar(500) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_files_tb`
--

LOCK TABLES `post_files_tb` WRITE;
/*!40000 ALTER TABLE `post_files_tb` DISABLE KEYS */;
INSERT INTO `post_files_tb` VALUES (1,14,'1105295.jpg','../uploads/1105295.jpg','2025-04-25 13:20:41'),(2,15,'capucchino.jpg','../uploads/capucchino.jpg','2025-04-25 13:41:16'),(5,17,'1345025.png','../uploads/1345025.png','2025-04-25 13:57:08'),(8,19,'1345025.png','../uploads/1345025.png','2025-04-25 14:10:14'),(9,8,'1105295.jpg','../uploads/1105295.jpg','2025-04-25 14:10:14'),(10,20,'1345025.png','../uploads/1345025.png','2025-04-25 14:15:36'),(11,20,'capucchino.jpg','../uploads/capucchino.jpg','2025-04-25 14:15:36'),(14,22,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:32:54'),(15,23,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:33:14'),(16,24,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:33:15'),(17,25,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:33:15'),(18,26,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:33:58'),(19,27,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:34:17'),(20,28,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:34:18'),(21,29,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:34:18'),(22,30,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:34:21'),(23,31,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:34:26'),(24,32,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:34:27'),(25,33,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:34:27'),(26,34,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:34:28'),(27,35,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:34:59'),(28,36,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:36:28'),(29,37,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:36:45'),(30,38,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:37:56'),(31,39,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:38:08'),(32,41,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 10:42:17'),(33,42,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-04-30 11:31:47'),(34,43,'b1b2cb1fa43c79e52a86e51c448ac04e.jpg','../uploads/b1b2cb1fa43c79e52a86e51c448ac04e.jpg','2025-05-01 11:12:06');
/*!40000 ALTER TABLE `post_files_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_likes_tb`
--

DROP TABLE IF EXISTS `post_likes_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_likes_tb` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`like_id`),
  UNIQUE KEY `post_id` (`post_id`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_likes_tb`
--

LOCK TABLES `post_likes_tb` WRITE;
/*!40000 ALTER TABLE `post_likes_tb` DISABLE KEYS */;
INSERT INTO `post_likes_tb` VALUES (15,13,'TestUser','2025-04-25 09:36:30'),(16,12,'TestUser','2025-04-25 09:37:32'),(27,19,'David1234','2025-04-27 11:52:50'),(34,20,'David1234','2025-04-27 12:35:25'),(35,20,'Izumii10shii','2025-04-29 12:59:34'),(37,41,'Izumii10shii','2025-04-30 10:42:35'),(38,42,'Izumii10shii','2025-04-30 12:00:12'),(39,43,'Izumii10shii','2025-05-01 11:13:30');
/*!40000 ALTER TABLE `post_likes_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_reports_tb`
--

DROP TABLE IF EXISTS `post_reports_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_reports_tb` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `reason` text DEFAULT NULL,
  `reported_at` datetime DEFAULT current_timestamp(),
  `status` enum('pending','reviewed') DEFAULT 'pending',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_reports_tb`
--

LOCK TABLES `post_reports_tb` WRITE;
/*!40000 ALTER TABLE `post_reports_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_reports_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tb`
--

DROP TABLE IF EXISTS `post_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_tb` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `likes_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comments_count` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tb`
--

LOCK TABLES `post_tb` WRITE;
/*!40000 ALTER TABLE `post_tb` DISABLE KEYS */;
INSERT INTO `post_tb` VALUES (14,'David1234','Media Test','Picture',0,'2025-04-25 13:20:41',0),(15,'David1234','Capuccino Assassino','CAAAPUCAPUCAPUUCHINOO ASSASIIIINOOO',0,'2025-04-25 13:41:15',0),(19,'David1234','Test 2 Image','2 Images',1,'2025-04-25 14:10:14',0),(20,'David1234','Test 2 Part 2','2 Images',2,'2025-04-25 14:15:36',4),(42,'Izumii10shii','Dante','Dante',1,'2025-04-30 11:31:47',0),(43,'David123','Dante','Yeah',1,'2025-05-01 11:12:06',4);
/*!40000 ALTER TABLE `post_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_tb`
--

DROP TABLE IF EXISTS `student_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_tb` (
  `student_no` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `year` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `otp_enabled` tinyint(1) DEFAULT 1,
  `is_admin` tinyint(1) DEFAULT 0,
  `profile_pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`student_no`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_tb`
--

LOCK TABLES `student_tb` WRITE;
/*!40000 ALTER TABLE `student_tb` DISABLE KEYS */;
INSERT INTO `student_tb` VALUES ('ADMIN','Izumii10shii','Christian David','Paras','21232f297a57a5a743894a0e4a801fc3','paraschristiandavid@gmail.com','Information Technology','2','1','2025-04-29 12:46:02',0,1,'../uploads/profile_pics/ADMIN_1345025 (1).png'),('B2023-00293','David123','Dabvid','Yes','720d57fa36845e86d1db588e6f46eea4','infinitydavid23@gmail.com','Information Technology','2','1','2025-04-24 06:31:30',1,0,'../uploads/profile_pics/B2023-00293_1105295.jpg');
/*!40000 ALTER TABLE `student_tb` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-01 21:55:02
