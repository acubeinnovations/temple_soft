ALTER TABLE `account_master` ADD UNIQUE(`voucher_number`, `voucher_type_id`, `ref_ledger`);
ALTER TABLE `pooja` ADD UNIQUE (`ledger_sub_id`);