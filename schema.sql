-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2008 at 06:07 PM
-- Server version: 5.0.54
-- PHP Version: 5.2.6-pl2-gentoo

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` mediumint(9) NOT NULL auto_increment,
  `company_name` varchar(75) NOT NULL,
  `short_name` varchar(75) NOT NULL,
  `contact_first_name` varchar(20) NOT NULL,
  `contact_last_name` varchar(30) NOT NULL,
  `mailing_address` text NOT NULL,
  `mailing_city` varchar(30) NOT NULL,
  `mailing_state` char(2) NOT NULL,
  `mailing_zip_code` char(5) NOT NULL,
  `email_address` varchar(75) NOT NULL,
  `phone_number` char(10) NOT NULL,
  `tax_exempt` binary(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `short_name` (`short_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `company_name`, `short_name`, `contact_first_name`, `contact_last_name`, `mailing_address`, `mailing_city`, `mailing_state`, `mailing_zip_code`, `email_address`, `phone_number`, `tax_exempt`) VALUES
(1, 'test', '', 'test', '', '', '', '', '', '', '', '\0'),
(2, 'Image Management LLC', 'image-management-llc', 'Jeremy', 'Bush', '610 Main St\nSuite 200', 'Racine', 'WI', '53402', 'jeremy@zombor.net', '262-898-91', '0');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` mediumint(9) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `date` int(11) NOT NULL,
  `comments` text NOT NULL,
  `client_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invoices`
--


-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

DROP TABLE IF EXISTS `invoice_payments`;
CREATE TABLE IF NOT EXISTS `invoice_payments` (
  `id` mediumint(9) NOT NULL auto_increment,
  `invoice_id` mediumint(9) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invoice_payments`
--


-- --------------------------------------------------------

--
-- Table structure for table `non_hourly`
--

DROP TABLE IF EXISTS `non_hourly`;
CREATE TABLE IF NOT EXISTS `non_hourly` (
  `id` mediumint(9) NOT NULL auto_increment,
  `project_id` mediumint(9) NOT NULL,
  `quantity` mediumint(9) NOT NULL,
  `description` text NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `invoiced` binary(1) NOT NULL default '0',
  `invoice_id` mediumint(9) NOT NULL,
  `creation_date` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `non_hourly`
--


-- --------------------------------------------------------

--
-- Table structure for table `operation_types`
--

DROP TABLE IF EXISTS `operation_types`;
CREATE TABLE IF NOT EXISTS `operation_types` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `operation_types`
--

INSERT INTO `operation_types` (`id`, `name`, `rate`) VALUES
(1, 'Project Management', '75.00'),
(2, 'Programming', '85.00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `client_id` mediumint(9) NOT NULL,
  `notes` text NOT NULL,
  `complete` binary(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `projects`
--


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Login'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(127) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) NOT NULL,
  `project_id` mediumint(9) NOT NULL,
  `description` text NOT NULL,
  `creation_date` int(11) NOT NULL,
  `close_date` int(11) NOT NULL,
  `complete` binary(1) NOT NULL,
  `billable` binary(1) NOT NULL,
  `invoiced` binary(1) NOT NULL,
  `invoice_id` mediumint(9) default NULL,
  `operation_type_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `operation_type_id` (`operation_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tickets`
--


-- --------------------------------------------------------

--
-- Table structure for table `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `id` mediumint(9) NOT NULL auto_increment,
  `ticket_id` mediumint(9) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `time`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(9) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `last_login` int(11) NOT NULL,
  `logins` mediumint(9) NOT NULL,
  `active` binary(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `last_login`, `logins`, `active`) VALUES
(1, 'admin', '67e34ce34532ca41db7941c0182066516a9d7f6aa783f5cbdb', 'test@test.com', 1225494105, 4, '1');

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE IF NOT EXISTS `users_roles` (
  `id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) NOT NULL,
  `role_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`id`, `user_id`, `role_id`) VALUES
(11, 1, 2),
(12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) NOT NULL,
  `expires` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_tokens`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD CONSTRAINT `invoice_payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `non_hourly`
--
ALTER TABLE `non_hourly`
  ADD CONSTRAINT `non_hourly_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_11` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `tickets_ibfk_10` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_9` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `time`
--
ALTER TABLE `time`
  ADD CONSTRAINT `time_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `users_roles_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_roles_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
