-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2014 at 10:03 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `account_master`
--

CREATE TABLE IF NOT EXISTS `account_master` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` varchar(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

--
-- Dumping data for table `account_settings`
--

INSERT INTO `account_settings` (`id`, `current_fy_id`, `default_capital`, `organization_name`, `organization_address`, `tax_payers_id_no`, `central_sales_tax_reg_no`, `central_exise_reg_no`, `reg_no`) VALUES
(1, 1, 66, 'Sree Hariharasudha Ayyapa Temple', 'Ernakulam', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ac_books`
--

CREATE TABLE IF NOT EXISTS `ac_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) NOT NULL,
  `ledgers` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ac_books`
--

INSERT INTO `ac_books` (`id`, `name`, `ledgers`) VALUES
(1, 'Day Book', 'a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";}'),
(2, 'Cash Book', 'a:1:{i:0;s:1:"4";}');

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

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `username`, `password`, `emailid`, `registrationdate`, `lastlogin`, `image`, `securityquestion_id`, `answer`, `created`, `updated`, `record_user_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'rosy.swapna@acube.co', NULL, '2014-03-22 12:00:53', NULL, NULL, NULL, '2013-04-22 00:00:00', NULL, NULL);

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

--
-- Dumping data for table `form_type`
--

INSERT INTO `form_type` (`id`, `value`, `form_variables`) VALUES
(1, 'Form8', 'a:15:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"4";i:3;s:1:"5";i:4;s:1:"6";i:5;s:1:"7";i:6;s:1:"8";i:7;s:1:"9";i:8;s:2:"10";i:9;s:2:"11";i:10;s:2:"12";i:11;s:2:"13";i:12;s:2:"14";i:13;s:2:"15";i:14;s:2:"16";}'),
(2, 'Form8B', 'a:11:{i:0;s:1:"1";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"6";i:4;s:1:"7";i:5;s:1:"8";i:6;s:2:"11";i:7;s:2:"12";i:8;s:2:"13";i:9;s:2:"14";i:10;s:2:"15";}'),
(3, 'Form8C', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}');

-- --------------------------------------------------------

--
-- Table structure for table `form_variables`
--

CREATE TABLE IF NOT EXISTS `form_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `form_variables`
--

INSERT INTO `form_variables` (`id`, `description`) VALUES
(1, 'SlNo'),
(2, 'Schl with entry No.'),
(3, 'Commodity Code'),
(4, 'Commodity'),
(5, 'HSN Code'),
(6, 'Rate of Tax'),
(7, 'Unit Price'),
(8, 'Qty'),
(9, 'Value'),
(10, 'Excise Duty'),
(11, 'Gross Value'),
(12, 'Cash discount'),
(13, 'Net Taxable Value'),
(14, 'Tax in %'),
(15, 'Total'),
(16, 'Qty discount/gifts free etc.');

-- --------------------------------------------------------

--
-- Table structure for table `fy_ledger_sub`
--

CREATE TABLE IF NOT EXISTS `fy_ledger_sub` (
  `fy_id` int(11) NOT NULL,
  `ledger_sub_id` int(11) NOT NULL,
  KEY `fy_id` (`fy_id`,`ledger_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fy_ledger_sub`
--

INSERT INTO `fy_ledger_sub` (`fy_id`, `ledger_sub_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

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

--
-- Dumping data for table `fy_master`
--

INSERT INTO `fy_master` (`fy_id`, `fy_name`, `fy_start`, `fy_end`, `status`) VALUES
(1, '2014-2015', '2014-04-01', '2015-03-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ledger_master`
--

CREATE TABLE IF NOT EXISTS `ledger_master` (
  `ledger_id` int(11) NOT NULL AUTO_INCREMENT,
  `ledger_name` varchar(100) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `ledger_master`
--

INSERT INTO `ledger_master` (`ledger_id`, `ledger_name`) VALUES
(1, 'Bank Accounts'),
(2, 'Bank OCC A/C'),
(3, 'Bank OD A/C'),
(4, 'Branch/ Divisions'),
(5, 'Capital Account'),
(6, 'Cash-In-Hand'),
(7, 'Current Assets'),
(8, 'Current Liabilities'),
(9, 'Deposits (Asset)'),
(10, 'Direct Expenses'),
(11, 'Direct Incomes'),
(12, 'Duties & Taxes'),
(13, 'Expenses (Direct)'),
(14, 'Expenses (Indirect)'),
(15, 'Fixed Assets'),
(16, 'Income (Direct)'),
(17, 'Income (Indirect)'),
(18, 'Indirect Incomes'),
(19, 'Indirect Expenses'),
(20, 'Investments'),
(21, 'Loans and Advances (Asset)'),
(22, 'Loans (Liability)'),
(23, 'Misc Expense (Asset)'),
(24, 'Provisions'),
(25, 'Purchase Accounts'),
(26, 'Reserve And Surplus'),
(27, 'Retained Earinies'),
(28, 'Sales Accounts'),
(29, 'Secured Loans'),
(30, 'Stock-In-Hand'),
(31, 'Sundry Creditors'),
(32, 'Sundry Debtors'),
(33, 'Suspense Account'),
(34, 'Un-Secured Loans');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ledger_sub`
--

INSERT INTO `ledger_sub` (`ledger_sub_id`, `ledger_sub_name`, `ledger_id`, `parent_sub_ledger_id`, `fy_id`, `status`, `deleted`) VALUES
(1, 'Vazhipadu', 11, -1, 1, 1, 1),
(2, 'പുഷ്പാഞ്ജലി', 11, 1, 1, 1, 1),
(3, 'പാല്‍പായസം', 11, 1, 1, 1, 1),
(4, 'Cash', 6, -1, 1, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56 ;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`id`, `name`, `parent_id`, `page_id`, `status`, `sort_order`) VALUES
(1, 'Dash Board', -1, 35, 1, 1),
(2, 'Master', -1, -1, 1, 2),
(3, 'Vazhipadu', -1, -1, 1, 3),
(4, 'Accounting', -1, -1, 1, 4),
(5, 'Administrator', -1, -1, 1, 5),
(6, 'Pooja', 2, 41, 1, 0),
(7, 'Stars', 2, 44, 1, 0),
(8, 'Add Vazhipadu', 3, 46, 1, 0),
(9, 'Cancel Vazhipadu', 3, 33, 1, 0),
(10, 'Vazhipadu Register', 3, 49, 1, 0),
(11, 'Pooja Register', 3, 40, 1, 0),
(12, 'Books', 4, -1, 1, 0),
(13, 'Add Book', 12, 2, 1, 0),
(14, 'Customer', 4, -1, 1, 0),
(15, 'Add Customer', 14, 3, 1, 0),
(16, 'List Customer', 14, 4, 1, 0),
(17, 'Supplier', 4, -1, 1, 0),
(18, 'Add Supplier', 17, 24, 1, 0),
(19, 'List Supplier', 17, 25, 1, 0),
(20, 'Ledger', 4, -1, 1, 0),
(21, 'Add Ledger', 20, 15, 1, 0),
(22, 'List Ledger', 20, 14, 1, 0),
(23, 'Single Ledger', 20, 20, 1, 0),
(24, 'Voucher', 4, -1, 1, 0),
(25, 'Add Voucher', 24, 29, 1, 0),
(26, 'Report', 4, -1, 1, 0),
(27, 'Add Report', 26, 16, 1, 0),
(28, 'List Report', 26, 18, 1, 0),
(29, 'Balancesheet', 26, 32, 1, 0),
(30, 'Form Type', 4, -1, 1, 0),
(31, 'Add Form type', 30, 8, 1, 0),
(32, 'List Form Type', 30, 10, 1, 0),
(33, 'Add Form Variable', 30, 11, 1, 0),
(34, 'Financial Year', 4, -1, 1, 0),
(35, 'Add Financial Year', 34, 6, 1, 0),
(36, 'List Financial Year', 34, 5, 1, 0),
(37, 'Tax', 4, -1, 1, 0),
(38, 'Add Tax', 37, 26, 1, 0),
(39, 'List Tax', 37, 27, 1, 0),
(40, 'Stock', 4, -1, 1, 0),
(41, 'Add Item', 40, 21, 1, 0),
(42, 'List Item', 40, 23, 1, 0),
(43, 'Stock Register', 40, 22, 1, 0),
(44, 'Sale Register', 40, 50, 1, 0),
(45, 'Purchase Register', 40, 51, 1, 0),
(46, 'Settings', 4, 1, 1, 0),
(47, 'Menu', 5, -1, 1, 0),
(48, 'Add Menu', 47, 30, 1, 0),
(49, 'List Menu', 47, 38, 1, 0),
(50, 'Assign Menu', 47, 31, 1, 0),
(51, 'Users', 5, 55, 1, 0),
(52, 'Change Password', 5, 62, 1, 0),
(53, 'Change Password', -1, 34, 1, 6),
(54, 'Cash Receipt', 24, 63, 1, 0),
(55, 'Cash Payment', 24, 64, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`) VALUES
(1, 'Vazhipadu');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=65 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `route`, `params`) VALUES
(1, 'ac_account_settings', '', ''),
(2, 'ac_books', '', ''),
(3, 'ac_customer', '', ''),
(4, 'ac_customers', '', ''),
(5, 'ac_financial_years', '', ''),
(6, 'ac_financial_year', '', ''),
(7, 'ac_form_print', '', ''),
(8, 'ac_form_type', '', ''),
(9, 'ac_form_type_variable', '', ''),
(10, 'ac_form_types', '', ''),
(11, 'ac_form_variable', '', ''),
(12, 'ac_generate_voucher', '', ''),
(13, 'ac_generated_vouchers', '', ''),
(14, 'ac_ledger_list', '', ''),
(15, 'ac_ledgers', '', ''),
(16, 'ac_report', '', ''),
(17, 'ac_report_features', '', ''),
(18, 'ac_report_list', '', ''),
(19, 'ac_show_report', '', ''),
(20, 'ac_single_ledger', '', ''),
(21, 'ac_stock', '', ''),
(22, 'ac_stock_register', '', ''),
(23, 'ac_stocks', '', ''),
(24, 'ac_supplier', '', ''),
(25, 'ac_suppliers', '', ''),
(26, 'ac_tax', '', ''),
(27, 'ac_taxs', '', ''),
(28, 'ac_voucher_print', '', ''),
(29, 'ac_vouchers', '', ''),
(30, 'add_menu', '', ''),
(31, 'assign_menu', '', ''),
(32, 'balancesheet', '', ''),
(33, 'cancel_vazhipadu', '', ''),
(34, 'change_password', '', ''),
(35, 'dashboard', '', ''),
(36, 'forgot_password', '', ''),
(37, 'forgot_password_message', '', ''),
(38, 'list_menu', '', ''),
(39, 'pooja', '', ''),
(40, 'pooja_register', '', ''),
(41, 'poojas', '', ''),
(42, 'settings', '', ''),
(43, 'star', '', ''),
(44, 'stars', '', ''),
(45, 'user_check', '', ''),
(46, 'vazhipadu', '', ''),
(47, 'vazhipadu_bookings', '', ''),
(48, 'vazhipadu_print', '', ''),
(49, 'vazhipadu_register', '', ''),
(50, 'ac_stock_register', '', 'type=Sale'),
(51, 'ac_stock_register', '', 'type=Purchase'),
(52, 'update_user_password', 'admin', ''),
(53, 'user', 'admin', ''),
(54, 'user_check', 'admin', ''),
(55, 'users', 'admin', ''),
(60, 'ac_generated_vouchers', '', 'bid=1'),
(61, 'ac_generated_vouchers', '', 'bid=2'),
(62, 'change_password', 'admin', ''),
(63, 'ac_generate_voucher', '', 'v=2'),
(64, 'ac_generate_voucher', '', 'v=3');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pooja`
--

INSERT INTO `pooja` (`id`, `name`, `rate`, `ledger_sub_id`, `status_id`) VALUES
(1, 'പുഷ്പാഞ്ജലി', 5, 2, 1),
(2, 'പാല്‍പായസം', 200, 3, 1);

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

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `report_head`, `lhs`, `rhs`, `lhs_head`, `rhs_head`, `header`, `footer`, `status`) VALUES
(1, 'Income', 1, 2, 'Particulars', '', '', '', 1),
(2, 'test report head', 1, 1, 'Income', 'Expense', '', '', 1);

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

--
-- Dumping data for table `report_feature`
--

INSERT INTO `report_feature` (`feature_id`, `report_id`, `ledger_master_id`, `sub_ledgers`, `position`, `sort_order`, `status`) VALUES
(1, 1, 11, '5,6,7,8,9,10,11,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,36,37,39,40,41,42,43,44,45,46,69', 1, 1, 1),
(25, 2, 11, '36,37', 1, 1, 1),
(26, 2, 10, '38', 2, 1, 1);

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

--
-- Dumping data for table `stars`
--

INSERT INTO `stars` (`id`, `name`, `status_id`) VALUES
(1, 'കാര്‍ത്തിക', 1),
(2, 'അശ്വതി', 1),
(3, 'തിരുവാതിര', 1),
(4, 'പൂരം', 1),
(5, 'അത്തം', 1),
(6, 'ചിത്തിര', 1),
(7, 'ചോതി', 1),
(8, 'പൂരാടം', 1),
(9, 'മകം', 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Inactive');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_register`
--

CREATE TABLE IF NOT EXISTS `stock_register` (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_number` varchar(125) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `uom_master`
--

CREATE TABLE IF NOT EXISTS `uom_master` (
  `uom_id` int(11) NOT NULL AUTO_INCREMENT,
  `uom_value` varchar(125) NOT NULL,
  PRIMARY KEY (`uom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `uom_master`
--

INSERT INTO `uom_master` (`uom_id`, `uom_value`) VALUES
(1, 'Kilo Gram'),
(2, 'Gram'),
(3, 'Litre'),
(4, 'Piece');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `address`, `occupation`, `user_status_id`, `organization_id`, `registration_date`, `activation_token`, `password_token`, `user_type_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator', NULL, 'rosy.swapna@acube.co', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 3),
(2, 'counter01', 'e10adc3949ba59abbe56e057f20f883e', 'sdf', 'df', '', '', '', '', 1, 0, '2014-04-30 10:24:01', '', NULL, 1),
(3, 'finance01', 'e10adc3949ba59abbe56e057f20f883e', 'sdf', 'df', '', '', '', '', 1, 0, '2014-04-30 10:24:36', '', NULL, 2);

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

--
-- Dumping data for table `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `name`, `description`) VALUES
(1, 'Active', 'Active'),
(2, 'Waiting Email Activation', 'Email activation required'),
(3, 'Suspended', 'Suspended'),
(4, 'Disabled', 'Disabled');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, 'COUNTER'),
(2, 'FINANCE'),
(3, 'ADMINISTRATOR');

-- --------------------------------------------------------

--
-- Table structure for table `user_type_page`
--

CREATE TABLE IF NOT EXISTS `user_type_page` (
  `user_type_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_type_page`
--

INSERT INTO `user_type_page` (`user_type_id`, `page_id`) VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22),
(3, 23),
(3, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(3, 33),
(3, 62),
(3, 35),
(3, 36),
(3, 37),
(3, 38),
(3, 39),
(3, 40),
(3, 41),
(3, 42),
(3, 43),
(3, 44),
(3, 45),
(3, 46),
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51),
(3, 52),
(3, 53),
(3, 54),
(3, 55),
(3, 56),
(3, 57),
(3, 58),
(3, 59),
(3, 60),
(3, 61),
(1, 35),
(2, 35),
(1, 46),
(1, 47),
(1, 48),
(1, 40),
(1, 49),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 32),
(2, 34),
(1, 34),
(3, 72),
(1, 72),
(2, 72),
(3, 73),
(1, 73),
(2, 73),
(3, 74),
(1, 74),
(2, 74),
(3, 75),
(1, 75),
(2, 75),
(3, 63),
(1, 63),
(2, 63),
(3, 64),
(1, 64),
(2, 64);

-- --------------------------------------------------------

--
-- Table structure for table `vazhipadu`
--

CREATE TABLE IF NOT EXISTS `vazhipadu` (
  `vazhipadu_id` int(11) NOT NULL AUTO_INCREMENT,
  `vazhipadu_rpt_number` varchar(125) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `series_start` varchar(50) NOT NULL,
  `series_seperator` varchar(5) NOT NULL,
  `default_from` varchar(50) NOT NULL,
  `default_to` varchar(50) NOT NULL,
  `form_type_id` int(11) NOT NULL,
  `source` tinyint(4) NOT NULL COMMENT '1-voucher for ac and 2-voucher for inventory',
  `hidden` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 show,2hidden',
  `module_id` int(11) DEFAULT '-1',
  PRIMARY KEY (`voucher_id`),
  UNIQUE KEY `fy_id` (`fy_id`,`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `voucher_name`, `voucher_description`, `fy_id`, `voucher_master_id`, `header`, `footer`, `number_series`, `series_prefix`, `series_sufix`, `series_start`, `series_seperator`, `default_from`, `default_to`, `form_type_id`, `source`, `hidden`, `module_id`) VALUES
(1, 'Vazhipadu', '', 1, 2, '', '', '001', '', '', '001', '', '4', '1', -1, -1, 2, 1),
(2, 'Cash Receipt', '', 1, 2, '', '', '001', '', '', '001', '', 'a:1:{i:0;s:1:"4";}', '', -1, 1, 1, NULL),
(3, 'Cash Payment', '', 1, 1, '', '', '001', '', '', '001', '', '', 'a:1:{i:0;s:1:"4";}', -1, 1, 1, NULL);

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

--
-- Dumping data for table `voucher_master`
--

INSERT INTO `voucher_master` (`voucher_master_id`, `voucher_master_name`, `status`) VALUES
(1, 'Cash Payment', 1),
(2, 'Cash Receipt', 1),
(3, 'Cash Receipt Note', 2),
(4, 'Bank Receipt', 1),
(5, 'Bank Payment', 1),
(6, 'Sales Return', 2),
(7, 'Purchase Return', 2),
(8, 'Stock IN', 2),
(9, 'Delivery Note', 1),
(10, 'Receipt Note', 1),
(11, 'Journel', 2),
(12, 'Stock Out', 2),
(13, 'Sales', 1),
(14, 'Purchase', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
