-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2014 at 09:50 AM
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
(62, 'change_password', 'admin', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
