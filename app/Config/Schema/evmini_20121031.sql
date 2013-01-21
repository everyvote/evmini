-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2012 at 10:30 AM
-- Server version: 5.1.63
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET foreign_key_checks=0;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `controlp_evmini`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `election_id` int(10) unsigned NOT NULL,
  `office_id` int(10) unsigned NOT NULL,
  `about_text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Candidate_Office1_idx` (`office_id`),
  KEY `fk_Candidate_Person1_idx` (`user_id`),
  KEY `fk_Candidate_Election1_idx` (`election_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `user_id`, `election_id`, `office_id`, `about_text`) VALUES
(3, 2, 1, 2, 'Testing\\nTesting\\nTesting\\n123\\nTesting\\nTesting\\nTesting\\n123\\n:D');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `constituencies`
--

CREATE TABLE IF NOT EXISTS `constituencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `constituencies`
--

INSERT INTO `constituencies` (`id`, `name`, `description`, `logo`, `parent_id`, `lft`, `rght`) VALUES
(1, 'Northern Illinois University Student Association', 'NIU', 'uni_logo.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `constituents`
--

CREATE TABLE IF NOT EXISTS `constituents` (
  `id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `constituency_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`constituency_id`),
  KEY `fk_Person_has_Constituency_Constituency1_idx` (`constituency_id`),
  KEY `fk_Person_has_Constituency_Person1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE IF NOT EXISTS `elections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `constituency_id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_elections_constituencies1_idx` (`constituency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `constituency_id`, `name`, `description`, `startdate`, `enddate`, `user_id`) VALUES
(1, 1, 'October Student Elections', 'An election for someone to win in this fine month of October.', '2012-10-01 20:29:00', '2012-10-05 20:29:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `election_id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `term_start` datetime NOT NULL COMMENT 'Number of Days?',
  `term_end` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Office_Constituency1_idx` (`election_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `election_id`, `name`, `description`, `term_start`, `term_end`) VALUES
(1, 1, 'Senator', '', '2012-10-25 00:00:00', '2012-10-27 00:00:00'),
(2, 1, 'President', '', '2012-10-25 00:00:00', '2012-10-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stances`
--

CREATE TABLE IF NOT EXISTS `stances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `desc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This is where you put your Yay / Nay / Undecided vote enums.' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stances`
--

INSERT INTO `stances` (`id`, `name`, `desc`) VALUES
(1, 'In Support', 'Supports or agrees with a Candidate.'),
(2, 'In Dissent', 'Disapproval and disagreement with Canidate.'),
(3, 'Undecided', 'Currently undecided on a stance or position.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facebook_id` int(11) DEFAULT NULL,
  `name` text NOT NULL,
  `image` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `name`, `image`) VALUES
(1, 1295170606, 'Krasimir Stavrev', 'http://profile.ak.fbcdn.net/hprofile-ak-ash4/260972_1295170606_3587850_n.jpg'),
(2, 1904038, 'Mitch Downey', 'http://profile.ak.fbcdn.net/hprofile-ak-snc7/369064_1904038_338775722_n.jpg'),
(3, 500283379, 'Kevin Hoople', 'http://profile.ak.fbcdn.net/hprofile-ak-ash3/70766_500283379_7652115_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `candidacy_id` int(10) unsigned NOT NULL,
  `comment_id` int(10) unsigned DEFAULT NULL,
  `stances_id` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`stances_id`),
  KEY `fk_Vote_Person1_idx` (`user_id`),
  KEY `fk_Vote_Candidate1_idx` (`candidacy_id`),
  KEY `fk_votes_comments1_idx` (`comment_id`),
  KEY `fk_votes_stances1` (`stances_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `candidacy_id`, `comment_id`, `stances_id`, `added`) VALUES
(3, 2, 3, NULL, 3, '2012-10-27 22:22:12'),
(4, 3, 3, NULL, 1, '2012-10-27 22:24:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Candidate_Election1` FOREIGN KEY (`election_id`) REFERENCES `elections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Candidate_Person1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `constituents`
--
ALTER TABLE `constituents`
  ADD CONSTRAINT `fk_Person_has_Constituency_Constituency1` FOREIGN KEY (`constituency_id`) REFERENCES `constituencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Person_has_Constituency_Person1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `elections`
--
ALTER TABLE `elections`
  ADD CONSTRAINT `fk_elections_constituencies1` FOREIGN KEY (`constituency_id`) REFERENCES `constituencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `offices`
--
ALTER TABLE `offices`
  ADD CONSTRAINT `offices_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `elections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `fk_votes_comments1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_votes_stances1` FOREIGN KEY (`stances_id`) REFERENCES `stances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Vote_Candidate1` FOREIGN KEY (`candidacy_id`) REFERENCES `candidates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Vote_Person1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
SET foreign_key_checks=1;
