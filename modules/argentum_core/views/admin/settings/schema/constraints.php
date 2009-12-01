--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>currencies` (`id`);

--
-- Constraints for table `clients_contacts`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>clients_contacts`
  ADD CONSTRAINT `clients_contacts_ibfk_5` FOREIGN KEY (`client_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clients_contacts_ibfk_6` FOREIGN KEY (`contact_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>clients` (`id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>currencies` (`id`);

--
-- Constraints for table `invoice_payments`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>invoice_payments`
  ADD CONSTRAINT `invoice_payments_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `non_hourly`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>non_hourly`
  ADD CONSTRAINT `non_hourly_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>clients` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>tickets`
  ADD CONSTRAINT `tickets_ibfk_10` FOREIGN KEY (`project_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_11` FOREIGN KEY (`invoice_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>invoices` (`id`),
  ADD CONSTRAINT `tickets_ibfk_9` FOREIGN KEY (`user_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>users` (`id`);

--
-- Constraints for table `time`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>time`
  ADD CONSTRAINT `time_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_roles`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>users_roles`
  ADD CONSTRAINT `users_roles_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_roles_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `<?=Kohana::config('database.default.table_prefix')?>user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `<?=Kohana::config('database.default.table_prefix')?>users` (`id`) ON DELETE CASCADE;
