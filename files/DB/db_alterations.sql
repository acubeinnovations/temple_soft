
#db alterations
 ___________________________28/05/2014_______________________________

ALTER TABLE `voucher` CHANGE `series_start` `series_start` INT( 11 ) NOT NULL ;

ALTER TABLE `voucher` ADD `print_size` INT( 11 ) NOT NULL AFTER `series_start` ;

ALTER TABLE `account_master` CHANGE `voucher_number` `voucher_number` INT( 11 ) NOT NULL ;

ALTER TABLE `stock_register` CHANGE `voucher_number` `voucher_number` INT( 11 ) NOT NULL ;

ALTER TABLE `vazhipadu` CHANGE `vazhipadu_rpt_number` `vazhipadu_rpt_number` INT( 11 ) NOT NULL COMMENT 'voucher number from account_master';



