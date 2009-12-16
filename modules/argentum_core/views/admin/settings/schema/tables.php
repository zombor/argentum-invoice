-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2008 at 10:55 PM
-- Server version: 5.0.54
-- PHP Version: 5.2.6-pl2-gentoo

--
-- Database: `argentum`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>clients`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>clients` (
  `id` mediumint(9) NOT NULL auto_increment,
  `company_name` varchar(75) NOT NULL,
  `short_name` varchar(75) NOT NULL,
  `contact_first_name` varchar(20) NOT NULL,
  `contact_last_name` varchar(30) NOT NULL,
  `mailing_address` text NOT NULL,
  `mailing_city` varchar(30) NOT NULL,
  `mailing_state` varchar(30) NOT NULL,
  `mailing_country` varchar(25) NOT NULL,
  `mailing_zip_code` char(10) NOT NULL,
  `email_address` varchar(75) NOT NULL,
  `phone_number` char(15) NOT NULL,
  `tax_rate` decimal(5,2) NOT NULL,
  `currency_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `short_name` (`short_name`),
  KEY `currency_id` (`currency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `clients_contacts`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>clients_contacts`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>clients_contacts` (
  `id` mediumint(9) NOT NULL auto_increment,
  `client_id` mediumint(9) NOT NULL,
  `contact_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `clients_contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>contacts`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>contacts` (
  `id` mediumint(9) NOT NULL auto_increment,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>currencies`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>currencies` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` char(3) NOT NULL,
  `symbol` varchar(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>invoices`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>invoices` (
  `id` mediumint(9) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `date` int(11) NOT NULL,
  `comments` text NOT NULL,
  `client_id` mediumint(9) NOT NULL,
  `template_name` varchar(50) NOT NULL,
  `currency_id` mediumint(9) NOT NULL,
  `conversion_rate` float NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`),
  KEY `currency_id` (`currency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invoices`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>invoice_payments`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>invoice_payments` (
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
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>modules`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>modules` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `active` binary(1) NOT NULL,
  `installed` binary(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `modules`
--

-- --------------------------------------------------------

--
-- Table structure for table `non_hourly`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>non_hourly`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>non_hourly` (
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

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>operation_types`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>operation_types` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>projects`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>projects` (
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

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>roles`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>roles` (
  `id` mediumint(9) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>sessions`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>sessions` (
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

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>tickets`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>tickets` (
  `id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) default NULL,
  `created_by` mediumint(9) NOT NULL,
  `project_id` mediumint(9) NOT NULL,
  `description` text NOT NULL,
  `creation_date` int(11) NOT NULL,
  `close_date` int(11) NOT NULL,
  `complete` binary(1) NOT NULL default '0',
  `billable` binary(1) NOT NULL default '1',
  `invoiced` binary(1) NOT NULL default '0',
  `invoice_id` mediumint(9) default NULL,
  `operation_type_id` mediumint(9) NULL default NULL,
  `rate` decimal(10,2) NOT NULL default '0.00',
  `physical` binary(1) NOT NULL default '0',
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

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>time`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>time` (
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>users`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>users` (
  `id` mediumint(9) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `last_login` int(11) NOT NULL,
  `logins` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>users_roles`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>users_roles` (
  `id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) NOT NULL,
  `role_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

DROP TABLE IF EXISTS `<?=Kohana::config('database.default.table_prefix')?>user_tokens`;
CREATE TABLE IF NOT EXISTS `<?=Kohana::config('database.default.table_prefix')?>user_tokens` (
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