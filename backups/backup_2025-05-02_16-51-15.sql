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
  `account_id` int(11) DEFAULT NULL,
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
  `bookmarked_at` datetime DEFAULT current_timestamp(),
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bookmark_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks_tb`
--

LOCK TABLES `bookmarks_tb` WRITE;
/*!40000 ALTER TABLE `bookmarks_tb` DISABLE KEYS */;
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
  `account_id` int(11) DEFAULT NULL,
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
  `parent_comment_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `reply_desc` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
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
  `account_id` int(11) DEFAULT NULL,
  `comment_desc` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_tb`
--

LOCK TABLES `comment_tb` WRITE;
/*!40000 ALTER TABLE `comment_tb` DISABLE KEYS */;
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
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sfile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_storage_tb`
--

LOCK TABLES `file_storage_tb` WRITE;
/*!40000 ALTER TABLE `file_storage_tb` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_files_tb`
--

LOCK TABLES `post_files_tb` WRITE;
/*!40000 ALTER TABLE `post_files_tb` DISABLE KEYS */;
INSERT INTO `post_files_tb` VALUES (1,1,'1345025 (1).png','../uploads/1345025 (1).png','2025-05-02 14:50:03');
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
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`like_id`),
  UNIQUE KEY `post_id` (`post_id`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_likes_tb`
--

LOCK TABLES `post_likes_tb` WRITE;
/*!40000 ALTER TABLE `post_likes_tb` DISABLE KEYS */;
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
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `likes_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comments_count` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tb`
--

LOCK TABLES `post_tb` WRITE;
/*!40000 ALTER TABLE `post_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_tb`
--

DROP TABLE IF EXISTS `student_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_tb` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_tb`
--

LOCK TABLES `student_tb` WRITE;
/*!40000 ALTER TABLE `student_tb` DISABLE KEYS */;
INSERT INTO `student_tb` VALUES (1,'B2023-00293','David1234','David','Waaaaaa','720d57fa36845e86d1db588e6f46eea4','infinitydavid23@gmail.com','Information Technology','2','1','2025-04-24 06:31:30',0,0,'../uploads/profile_pics/B2023-00293_b1b2cb1fa43c79e52a86e51c448ac04e.jpg'),(2,'ADMIN','Izumii10shii','Christian David','Paras','21232f297a57a5a743894a0e4a801fc3','paraschristiandavid@gmail.com','Information Technology','2','1','2025-04-29 12:46:02',0,1,'../uploads/profile_pics/ADMIN_1345025 (1).png');
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

-- Dump completed on 2025-05-02 22:51:16
