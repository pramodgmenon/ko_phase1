-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2015 at 08:49 AM
-- Server version: 5.5.40
-- PHP Version: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kolapilly`
--

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `username`, `password`, `emailid`, `registrationdate`, `lastlogin`, `image`, `created`, `updated`, `record_user_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, '2015-01-12 12:20:21', NULL, '2013-04-22 00:00:00', NULL, NULL);

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `name`, `page_id`, `content`, `description`, `language_id`, `contenttype_id`, `publish`) VALUES
(1, 'Index Heading', 1, 'Demo Application', '', 1, 2, 0),
(2, 'Index Content', 1, '<p>1) Login to Demo Application 	</p>							\n		<p>2) Username : tester@gfw.legreensolutions.com</p>		\n		<p>3) Password : 123456</p>\n		<p>4) Please check Demo on Dashboard  .</p>', '', 1, 1, 0);

--
-- Dumping data for table `contenttypes`
--

INSERT INTO `contenttypes` (`id`, `name`, `description`) VALUES
(1, 'HTML', 'Html Editor'),
(2, 'TEXT', 'No Html Editor');

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `publish`) VALUES
(1, 'English', 1),
(2, 'Malayalam', 1);

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`) VALUES
(1, 'index.php');

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Inactive');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `address`, `occupation`, `user_status_id`, `registration_date`, `activation_token`, `password_token`) VALUES
(1, 'tester@gfw.legreensolutions.com', 'e10adc3949ba59abbe56e057f20f883e', 'Tester', 'Acube', 'tester@gfw.legreensolutions.com', '', 'tester@gfw.legreensolutions.com', 'tester@gfw.legreensolutions.com', 1, '0000-00-00 00:00:00', NULL, NULL);

--
-- Dumping data for table `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `name`, `description`) VALUES
(1, 'Active', 'Active'),
(2, 'Waiting Email Activation', 'Email activation required'),
(3, 'Suspended', 'Suspended'),
(4, 'Disabled', 'Disabled');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
