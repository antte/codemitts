-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2010 at 01:29 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codemitts`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created`, `modified`) VALUES
(13, 'Codemitts', 'Social coding on unicorn meat!', '2010-07-05 15:13:13', '2010-07-05 15:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'java'),
(52, 'php'),
(51, 'ruby'),
(56, 'er'),
(55, 'ajax');

-- --------------------------------------------------------

--
-- Table structure for table `tags_tasks`
--

CREATE TABLE IF NOT EXISTS `tags_tasks` (
  `tag_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  KEY `tag_id` (`tag_id`,`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_tasks`
--

INSERT INTO `tags_tasks` (`tag_id`, `task_id`) VALUES
(3, 52),
(3, 55),
(4, 56);

-- --------------------------------------------------------

--
-- Table structure for table `tags_users`
--

CREATE TABLE IF NOT EXISTS `tags_users` (
  `tag_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `tag_id` (`tag_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_users`
--

INSERT INTO `tags_users` (`tag_id`, `user_id`) VALUES
(1, 9),
(52, 9),
(55, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `project_id`, `created`, `modified`) VALUES
(3, 'Ajax username availability', 'On the login screen check for username availability when the user wants to register a new account.', 13, '2010-07-22 20:23:32', '2010-07-22 20:23:39'),
(4, 'ER', 'Update the ER diagram to incorporate the new features.', 13, '2010-05-22 20:24:14', '2010-05-22 20:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(9, 'user', '1a1dc91c907325c69271ddf0c944bc72');
