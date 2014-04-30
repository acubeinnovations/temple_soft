-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2014 at 09:40 AM
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
(53, 'Change Password', -1, 34, 1, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
