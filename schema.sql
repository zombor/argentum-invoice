-- phpMyAdmin SQL Dump
-- version 2.9.0-rc1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 09, 2008 at 07:31 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.6
-- 
-- Database: `argentum`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `modules`
-- 

CREATE TABLE `modules` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `active` binary(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `clients`
-- 

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` mediumint(9) NOT NULL auto_increment,
  `company_name` varchar(75) NOT NULL,
  `short_name` varchar(75) NOT NULL,
  `contact_first_name` varchar(20) NOT NULL,
  `contact_last_name` varchar(30) NOT NULL,
  `mailing_address` text NOT NULL,
  `mailing_city` varchar(30) NOT NULL,
  `mailing_state` char(2) NOT NULL,
  `mailing_zip_code` char(10) NOT NULL,
  `email_address` varchar(75) NOT NULL,
  `phone_number` char(12) NOT NULL,
  `tax_rate` decimal(5,2) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `short_name` (`short_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `clients`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `invoice_payments`
-- 

DROP TABLE IF EXISTS `invoice_payments`;
CREATE TABLE `invoice_payments` (
  `id` mediumint(9) NOT NULL auto_increment,
  `invoice_id` mediumint(9) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `invoice_payments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `invoices`
-- 

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` mediumint(9) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `date` int(11) NOT NULL,
  `comments` text NOT NULL,
  `client_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `invoices`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `non_hourly`
-- 

DROP TABLE IF EXISTS `non_hourly`;
CREATE TABLE `non_hourly` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `non_hourly`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `operation_types`
-- 

DROP TABLE IF EXISTS `operation_types`;
CREATE TABLE `operation_types` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `operation_types`
-- 

INSERT INTO `operation_types` (`id`, `name`, `rate`) VALUES 
(1, 'Project Management', 75.00),
(2, 'Programming', 85.00),
(3, 'Design', 80.00),
(4, 'Web Hosting', 19.95);

-- --------------------------------------------------------

-- 
-- Table structure for table `projects`
-- 

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `client_id` mediumint(9) NOT NULL,
  `notes` text NOT NULL,
  `complete` binary(1) NOT NULL default '0',
  `taxable` binary(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `projects`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `roles`
-- 

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
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
CREATE TABLE `sessions` (
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
CREATE TABLE `tickets` (
  `id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) default NULL,
  `project_id` mediumint(9) NOT NULL,
  `description` text NOT NULL,
  `creation_date` int(11) NOT NULL,
  `close_date` int(11) NOT NULL,
  `complete` binary(1) NOT NULL,
  `billable` binary(1) NOT NULL,
  `invoiced` binary(1) NOT NULL,
  `invoice_id` mediumint(9) default NULL,
  `operation_type_id` mediumint(9) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `operation_type_id` (`operation_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tickets`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `time`
-- 

DROP TABLE IF EXISTS `time`;
CREATE TABLE `time` (
  `id` mediumint(9) NOT NULL auto_increment,
  `ticket_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `time`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `user_tokens`
-- 

DROP TABLE IF EXISTS `user_tokens`;
CREATE TABLE `user_tokens` (
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


-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` mediumint(9) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `last_login` int(11) NOT NULL,
  `logins` mediumint(9) NOT NULL,
  `email_ticket_create` binary(1) NOT NULL default '1',
  `email_ticket_close` binary(1) NOT NULL default '1',
  `email_ticket_update` binary(1) NOT NULL default '1',
  `email_ticket_time` binary(1) NOT NULL default '1',
  `email_project_creation` binary(1) NOT NULL default '0',
  `email_project_close` binary(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `password`, `email`, `last_login`, `logins`, `email_ticket_create`, `email_ticket_close`, `email_ticket_update`, `email_ticket_time`, `email_project_creation`, `email_project_close`) VALUES 
(1, 'admin', 'Admin', 'User', '67e34ce34532ca41db7941c0182066516a9d7f6aa783f5cbdb', 'test@test.com', 1226546253, 282, 0x31, 0x31, 0x31, 0x31, 0x30, 0x30),
(4, 'demo', 'Demo', 'User', '785e0c0ccfb860d466d5d870b95c87220b374e4f2ce8a5bc0c', 'test@test.com', 1226494173, 15, 0x31, 0x31, 0x31, 0x31, 0x30, 0x30);

-- --------------------------------------------------------

-- 
-- Table structure for table `users_roles`
-- 

DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE `users_roles` (
  `id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) NOT NULL,
  `role_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `users_roles`
-- 

INSERT INTO `users_roles` (`id`, `user_id`, `role_id`) VALUES 
(11, 1, 2),
(12, 1, 1),
(14, 4, 1);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `invoice_payments`
-- 
ALTER TABLE `invoice_payments`
  ADD CONSTRAINT `invoice_payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `invoices`
-- 
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

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
  ADD CONSTRAINT `tickets_ibfk_10` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,  ADD CONSTRAINT `tickets_ibfk_11` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),  ADD CONSTRAINT `tickets_ibfk_9` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

-- 
-- Constraints for table `time`
-- 
ALTER TABLE `time`
  ADD CONSTRAINT `time_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `user_tokens`
-- 
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

-- 
-- Constraints for table `users_roles`
-- 
ALTER TABLE `users_roles`
  ADD CONSTRAINT `users_roles_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,  ADD CONSTRAINT `users_roles_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
