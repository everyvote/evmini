CREATE DATABASE  IF NOT EXISTS `evmini` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `evmini`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: evmini
-- ------------------------------------------------------
-- Server version	5.5.25a

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `candidacy_id` int(10) unsigned NOT NULL,
  `comment_id` int(10) unsigned DEFAULT NULL,
  `stances_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`stances_id`),
  KEY `fk_Vote_Person1_idx` (`user_id`),
  KEY `fk_Vote_Candidate1_idx` (`candidacy_id`),
  KEY `fk_votes_comments1_idx` (`comment_id`),
  KEY `fk_votes_stances1` (`stances_id`),
  CONSTRAINT `fk_Vote_Candidate1` FOREIGN KEY (`candidacy_id`) REFERENCES `candidates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_votes_comments1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Vote_Person1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_votes_stances1` FOREIGN KEY (`stances_id`) REFERENCES `stances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facebook_id` int(11) DEFAULT NULL,
  `name` text NOT NULL,
  `image` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `facebook_id`, `name`, `image`) VALUES (1,NULL,'John Smith',NULL),(2,NULL,'John Travolta',NULL),(3,NULL,'Fonzie',NULL),(4,NULL,'Candidate Doe','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `constituents`
--

DROP TABLE IF EXISTS `constituents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `constituents` (
  `id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `constituency_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`constituency_id`),
  KEY `fk_Person_has_Constituency_Constituency1_idx` (`constituency_id`),
  KEY `fk_Person_has_Constituency_Person1_idx` (`user_id`),
  CONSTRAINT `fk_Person_has_Constituency_Constituency1` FOREIGN KEY (`constituency_id`) REFERENCES `constituencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Person_has_Constituency_Person1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `constituents`
--

LOCK TABLES `constituents` WRITE;
/*!40000 ALTER TABLE `constituents` DISABLE KEYS */;
/*!40000 ALTER TABLE `constituents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elections`
--

DROP TABLE IF EXISTS `elections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `constituency_id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_elections_constituencies1_idx` (`constituency_id`),
  CONSTRAINT `fk_elections_constituencies1` FOREIGN KEY (`constituency_id`) REFERENCES `constituencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elections`
--

LOCK TABLES `elections` WRITE;
/*!40000 ALTER TABLE `elections` DISABLE KEYS */;
INSERT INTO `elections` (`id`, `constituency_id`, `name`, `description`, `startdate`, `enddate`) VALUES (1,1,'October Student Elections','An election for someone to win in this fine month of October.','2012-10-01 20:29:00','2012-10-05 20:29:00');
/*!40000 ALTER TABLE `elections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users1_idx` (`user_id`),
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `user_id`, `body`, `date`) VALUES (1,1,'This is a sample comment.','2012-10-05 00:40:00'),(2,3,'This is another comment about a candidate.','2012-10-05 00:43:00'),(3,1,'This is a comment about nothing in particular.','2012-10-05 03:06:00');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `constituency_id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `term_start` datetime NOT NULL COMMENT 'Number of Days?',
  `term_end` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Office_Constituency1_idx` (`constituency_id`),
  CONSTRAINT `fk_Office_Constituency1` FOREIGN KEY (`constituency_id`) REFERENCES `constituencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offices`
--

LOCK TABLES `offices` WRITE;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` (`id`, `constituency_id`, `name`, `description`, `term_start`, `term_end`) VALUES (1,1,'District 1 Senator','1','2010-01-12 00:00:00','2010-01-13 00:00:00'),(2,1,'District 2 Senator','2','2010-01-12 00:00:00','2010-01-13 00:00:00'),(3,1,'District 3 Senator','3','2010-01-12 00:00:00','2010-01-13 00:00:00'),(4,1,'District 4 Senator','4','2010-01-12 00:00:00','2010-01-13 00:00:00'),(5,1,'District 5 Senator','5','2010-01-12 00:00:00','2010-01-13 00:00:00');
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stances`
--

DROP TABLE IF EXISTS `stances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `desc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='This is where you put your Yay / Nay / Undecided vote enums.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stances`
--

LOCK TABLES `stances` WRITE;
/*!40000 ALTER TABLE `stances` DISABLE KEYS */;
INSERT INTO `stances` (`id`, `name`, `desc`) VALUES (1,'In Support','Supports or agrees with a Candidate.'),(2,'In Dissent','Disapproval and disagreement with Canidate.'),(3,'Undecided','Currently undecided on a stance or position.');
/*!40000 ALTER TABLE `stances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `constituencies`
--

DROP TABLE IF EXISTS `constituencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `constituencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `constituencies`
--

LOCK TABLES `constituencies` WRITE;
/*!40000 ALTER TABLE `constituencies` DISABLE KEYS */;
INSERT INTO `constituencies` (`id`, `name`, `description`, `parent_id`, `lft`, `rght`) VALUES (1,'Northern Illinois University Student Association','NIU',NULL,NULL,NULL);
/*!40000 ALTER TABLE `constituencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `election_id` int(10) unsigned NOT NULL,
  `office_id` int(10) unsigned NOT NULL,
  `about_text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Candidate_Office1_idx` (`office_id`),
  KEY `fk_Candidate_Person1_idx` (`user_id`),
  KEY `fk_Candidate_Election1_idx` (`election_id`),
  CONSTRAINT `fk_Candidate_Election1` FOREIGN KEY (`election_id`) REFERENCES `elections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Candidate_Office1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Candidate_Person1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidates`
--

LOCK TABLES `candidates` WRITE;
/*!40000 ALTER TABLE `candidates` DISABLE KEYS */;
INSERT INTO `candidates` (`id`, `user_id`, `election_id`, `office_id`, `about_text`) VALUES (1,2,1,1,'Proin ut quam eros. Donec sed lobortis diam. Nulla nec odio lacus. Quisque porttitor egestas dolor in placerat. Nunc vehicula dapibus ipsum. Duis venenatis risus non nunc fermentum dapibus. Morbi lorem ante, malesuada in mollis nec, auctor nec massa. Aenean tempus dui eget felis blandit at fringilla urna ultrices.'),(2,1,1,3,'Proin ut quam eros. Donec sed lobortis diam. Nulla nec odio lacus. Quisque porttitor egestas dolor in placerat. Nunc vehicula dapibus ipsum. Duis venenatis risus non nunc fermentum dapibus. Morbi lorem ante, malesuada in mollis nec, auctor nec massa. Aenean tempus dui eget felis blandit at fringilla urna ultrices.'),(3,2,1,5,'Proin ut quam eros. Donec sed lobortis diam. Nulla nec odio lacus. Quisque porttitor egestas dolor in placerat. Nunc vehicula dapibus ipsum. Duis venenatis risus non nunc fermentum dapibus. Morbi lorem ante, malesuada in mollis nec, auctor nec massa. Aenean tempus dui eget felis blandit at fringilla urna ultrices.'),(4,3,1,4,'A newcomer to politics.');
/*!40000 ALTER TABLE `candidates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-10-05  3:45:09
