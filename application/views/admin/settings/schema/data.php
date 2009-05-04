--
-- Dumping data for table `currencies`
--

INSERT INTO `<?=Kohana::config('database.default.table_prefix')?>currencies` (`id`, `name`, `symbol`) VALUES
(1, 'USD', '$'),
(2, 'GBP', '£'),
(4, 'JPY', '¥'),
(5, 'EUR', '€'),
(6, 'CAD', '$'),
(7, 'HKD', 'HK$'),
(8, 'CNY', '元'),
(9, 'RUB', 'руб');

--
-- Dumping data for table `operation_types`
--

INSERT INTO `<?=Kohana::config('database.default.table_prefix')?>operation_types` (`id`, `name`, `rate`) VALUES
(1, 'Project Management', '75.00'),
(2, 'Programming', '85.00'),
(3, 'Design', '80.00');

--
-- Dumping data for table `roles`
--

INSERT INTO `<?=Kohana::config('database.default.table_prefix')?>roles` (`id`, `name`) VALUES
(1, 'Login'),
(2, 'Admin');