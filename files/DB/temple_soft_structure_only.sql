-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2014 at 11:24 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `temple_soft`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GET_NEXT_VOUCHER_NUMBER`(vid INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE next_voucher_number INT(11);
	SELECT IF (EXISTS ( SELECT 1 FROM account_master WHERE voucher_type_id = vid),
(SELECT MAX(voucher_number)+1 FROM account_master WHERE voucher_type_id = vid) ,
(SELECT series_start FROM voucher WHERE voucher_id = vid)) INTO next_voucher_number ;

	RETURN next_voucher_number;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account_master`
--

CREATE TABLE IF NOT EXISTS `account_master` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` int(11) NOT NULL,
  `voucher_type_id` int(11) NOT NULL,
  `fy_id` int(11) NOT NULL,
  `reference_number` varchar(125) NOT NULL,
  `account_from` int(11) NOT NULL,
  `account_to` int(11) NOT NULL,
  `account_debit` double(25,2) NOT NULL,
  `account_credit` double(25,2) NOT NULL,
  `date` date NOT NULL,
  `narration` text NOT NULL,
  `ref_ledger` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `account_settings`
--

CREATE TABLE IF NOT EXISTS `account_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_fy_id` int(11) NOT NULL,
  `default_capital` int(11) DEFAULT NULL,
  `organization_name` text,
  `organization_address` text,
  `tax_payers_id_no` text,
  `central_sales_tax_reg_no` text,
  `central_exise_reg_no` text,
  `reg_no` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ac_books`
--

CREATE TABLE IF NOT EXISTS `ac_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `ledgers` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailid` text COLLATE utf8_unicode_ci,
  `registrationdate` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `securityquestion_id` int(11) DEFAULT NULL,
  `answer` text COLLATE utf8_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `record_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `securityquestion_id` (`securityquestion_id`),
  KEY `record_user_id` (`record_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(250) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_mobile` varchar(15) NOT NULL,
  `customer_fax` varchar(15) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_cst_number` varchar(50) NOT NULL,
  `customer_tin_number` varchar(50) NOT NULL,
  `ledger_sub_id` int(11) NOT NULL DEFAULT '-1',
  `deleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `form_type`
--

CREATE TABLE IF NOT EXISTS `form_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(15) NOT NULL,
  `form_variables` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `form_variables`
--

CREATE TABLE IF NOT EXISTS `form_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `fy_ledger_sub`
--

CREATE TABLE IF NOT EXISTS `fy_ledger_sub` (
  `fy_id` int(11) NOT NULL,
  `ledger_sub_id` int(11) NOT NULL,
  KEY `fy_id` (`fy_id`,`ledger_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fy_master`
--

CREATE TABLE IF NOT EXISTS `fy_master` (
  `fy_id` int(11) NOT NULL AUTO_INCREMENT,
  `fy_name` varchar(125) NOT NULL,
  `fy_start` date NOT NULL,
  `fy_end` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1for open and 0 for closed',
  PRIMARY KEY (`fy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_master`
--

CREATE TABLE IF NOT EXISTS `ledger_master` (
  `ledger_id` int(11) NOT NULL AUTO_INCREMENT,
  `ledger_name` varchar(100) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_sub`
--

CREATE TABLE IF NOT EXISTS `ledger_sub` (
  `ledger_sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `ledger_sub_name` text NOT NULL,
  `ledger_id` int(11) NOT NULL DEFAULT '0',
  `parent_sub_ledger_id` int(11) DEFAULT NULL,
  `fy_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active, 2 for inactive',
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`ledger_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=134 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE IF NOT EXISTS `menu_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 for active ,2 for inactive',
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=75 ;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=87 ;

-- --------------------------------------------------------

--
-- Table structure for table `pooja`
--

CREATE TABLE IF NOT EXISTS `pooja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `ledger_sub_id` int(11) NOT NULL DEFAULT '-1',
  `status_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_head` varchar(250) NOT NULL,
  `lhs` tinyint(1) NOT NULL DEFAULT '2',
  `rhs` tinyint(1) NOT NULL DEFAULT '2',
  `lhs_head` varchar(125) NOT NULL,
  `rhs_head` varchar(125) NOT NULL,
  `header` text NOT NULL,
  `footer` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active,2 for inactive',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `report_feature`
--

CREATE TABLE IF NOT EXISTS `report_feature` (
  `feature_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `ledger_master_id` int(11) NOT NULL COMMENT 'master ledger id',
  `sub_ledgers` varchar(125) NOT NULL,
  `position` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 for LHS ,2 for RHS',
  `sort_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active, 2 for inactive',
  PRIMARY KEY (`feature_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE IF NOT EXISTS `stars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE IF NOT EXISTS `stock_master` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(250) NOT NULL,
  `uom_id` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_register`
--

CREATE TABLE IF NOT EXISTS `stock_register` (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` int(11) NOT NULL,
  `voucher_type_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_rate` double(25,2) NOT NULL,
  `input_type` varchar(50) NOT NULL COMMENT 'purchase or donation(+) and auction or delivery(-) opening(+)',
  `purchase_reference_number` varchar(125) NOT NULL,
  `date` date NOT NULL,
  `tax_id` int(11) NOT NULL DEFAULT '-1',
  `fy_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`stk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` text NOT NULL,
  `supplier_phone` varchar(15) NOT NULL,
  `contact_person` varchar(125) NOT NULL,
  `contact_mobile` varchar(15) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `supplier_fax` varchar(15) NOT NULL,
  `supplier_cst_number` varchar(50) NOT NULL,
  `supplier_tin_number` varchar(50) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  `ledger_sub_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax_master`
--

CREATE TABLE IF NOT EXISTS `tax_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `rate` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  `ledger_sub_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '-1' COMMENT '1 for sale ,2 for purchase',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `uom_master`
--

CREATE TABLE IF NOT EXISTS `uom_master` (
  `uom_id` int(11) NOT NULL AUTO_INCREMENT,
  `uom_value` varchar(125) NOT NULL,
  PRIMARY KEY (`uom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_status_id` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_status_id` (`user_status_id`),
  KEY `organization_id` (`organization_id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_page`
--

CREATE TABLE IF NOT EXISTS `user_page` (
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_statuses`
--

CREATE TABLE IF NOT EXISTS `user_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_type_page`
--

CREATE TABLE IF NOT EXISTS `user_type_page` (
  `user_type_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vazhipadu`
--

CREATE TABLE IF NOT EXISTS `vazhipadu` (
  `vazhipadu_id` int(11) NOT NULL AUTO_INCREMENT,
  `vazhipadu_rpt_number` int(11) NOT NULL COMMENT 'voucher number from account_master',
  `vazhipadu_date` date NOT NULL,
  `star_id` int(11) NOT NULL,
  `pooja_id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `age` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(25,2) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '1' COMMENT '2 for deleted,1 not deleted',
  `user_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`vazhipadu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_name` varchar(250) NOT NULL,
  `voucher_description` text NOT NULL,
  `fy_id` int(11) NOT NULL,
  `voucher_master_id` int(11) NOT NULL,
  `header` text,
  `footer` text,
  `number_series` varchar(20) NOT NULL,
  `series_prefix` varchar(10) NOT NULL,
  `series_sufix` varchar(10) NOT NULL,
  `series_start` int(11) NOT NULL,
  `print_size` int(11) NOT NULL,
  `series_seperator` varchar(5) NOT NULL,
  `default_from` varchar(50) NOT NULL,
  `default_to` varchar(50) NOT NULL,
  `form_type_id` int(11) NOT NULL,
  `source` tinyint(4) NOT NULL COMMENT '1-voucher for ac and 2-voucher for inventory',
  `hidden` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 show,2hidden',
  `module_id` int(11) DEFAULT '-1',
  PRIMARY KEY (`voucher_id`),
  UNIQUE KEY `fy_id` (`fy_id`,`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_master`
--

CREATE TABLE IF NOT EXISTS `voucher_master` (
  `voucher_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_master_name` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 for active ,2 for inactive',
  PRIMARY KEY (`voucher_master_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
