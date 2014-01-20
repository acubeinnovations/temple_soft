-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2014 at 04:50 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

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
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `username`, `password`, `emailid`, `registrationdate`, `lastlogin`, `image`, `securityquestion_id`, `answer`, `created`, `updated`, `record_user_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, '2014-01-20 09:44:17', NULL, NULL, NULL, '2013-04-22 00:00:00', NULL, NULL);

--
-- Dumping data for table `pooja`
--

INSERT INTO `pooja` (`id`, `name`, `rate`, `status_id`) VALUES
(1, 'à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 5, 0),
(2, 'à´—àµà´°àµà´¤à´¿ à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 10, 1),
(3, 'à´¶à´¤àµà´°àµ à´¸à´‚à´¹à´¾à´° à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 20, 0),
(4, 'à´®àµƒà´¤àµà´¯àµà´žàµà´œà´¯ à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 20, 0),
(5, 'à´­à´¾à´—àµà´¯à´¸àµ‚à´•àµà´¤ à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 20, 0),
(6, 'à´¸àµà´ªàµ†à´·àµà´¯à´²àµâ€ à´ªàµà´·àµà´ªà´¾à´žàµà´œà´²à´¿', 20, 0),
(7, 'à´—àµà´°àµà´¤à´¿', 5, 0),
(8, 'à´µàµ†à´³àµà´³à´¨àµ‡à´¦àµà´¯à´‚', 10, 0),
(9, 'à´•àµ‚à´Ÿàµà´Ÿàµà´ªà´¾à´¯à´¸à´‚', 40, 0),
(10, 'à´•à´Ÿàµà´‚à´ªà´¾à´¯à´¸à´‚', 50, 0),
(11, 'à´¨àµ†à´¯àµà´ªà´¾à´¯à´¸à´‚', 75, 0),
(12, 'à´…à´¤à´¿à´®à´§àµà´°à´ªà´¾à´¯à´¸à´‚', 50, 0),
(13, 'à´ªà´¿à´´à´¿à´žàµà´žàµà´ªà´¾à´¯à´¸à´‚', 75, 0),
(14, 'à´†à´±àµà´¨à´¾à´´à´¿à´ªà´¾à´¯à´¸à´‚', 400, 0),
(15, 'à´ªà´¾à´²àµâ€à´ªà´¾à´¯à´¸à´‚', 50, 0),
(16, 'à´ªà´¿à´¤àµƒà´¨à´®à´¸àµà´•à´¾à´°à´‚', 12, 0),
(18, 'à´•àµ‚à´Ÿàµà´Ÿà´¨à´®à´¸àµà´•à´¾à´°à´‚', 30, 0),
(19, 'à´’à´±àµà´±à´¯à´ªàµà´ªà´‚', 30, 0),
(20, 'à´—à´£à´ªà´¤à´¿à´¹àµ‹à´®à´‚', 60, 0),
(21, 'à´…à´·àµà´Ÿà´¦àµà´°à´µàµà´¯à´—à´£à´ªà´¤à´¿à´¹àµ‹à´®à´‚', 200, 0),
(22, 'à´•à´±àµà´•à´¹àµ‹à´®à´‚', 50, 0),
(23, 'à´­à´—à´µà´¤à´¿à´¸àµ‡à´µ', 100, 0),
(24, 'à´¸à´°àµâ€à´ªàµà´ªà´¨àµ‡à´¦àµà´¯à´‚', 10, 0),
(25, 'à´¨àµ‚à´±àµà´‚à´ªà´¾à´²àµà´‚', 50, 0),
(26, 'à´¨à´¿à´±à´®à´¾à´²', 100, 0),
(27, 'à´¨àµ€à´°à´¾à´žàµà´œà´¨à´‚', 10, 0),
(28, 'à´ªà´¤àµà´®à´®à´¿à´Ÿàµà´Ÿàµà´¨àµ‡à´¦àµà´¯à´‚', 15, 0),
(29, 'à´šàµ‹à´±àµ‚à´£àµ', 50, 0),
(30, 'à´µà´¿à´µà´¾à´¹à´‚', 250, 0),
(31, 'à´µà´¾à´¹à´¨à´ªàµ‚à´œ', 100, 0),
(32, 'à´’à´°àµà´¦à´¿à´µà´¸à´¤àµà´¤àµ†à´ªàµ‚à´œ', 300, 0),
(33, 'à´’à´°àµà´¨àµ‡à´°à´ªàµ‚à´œ', 150, 0),
(34, 'à´¤àµà´°à´¿à´•à´¾à´²à´ªàµ‚à´œ', 350, 0),
(35, 'à´¸àµà´®à´‚à´—à´²à´¿à´ªàµ‚à´œ', 500, 0),
(36, 'à´®à´‚à´—à´²àµà´¯à´ªàµ‚à´œ', 500, 0),
(37, 'à´®à´£àµà´¡à´²à´ªàµ‚à´œ', 450, 0),
(38, 'à´šà´¨àµà´¦à´¨à´‚à´šà´¾à´°àµâ€à´¤àµà´¤àµ(à´®àµà´–à´‚)', 30, 0),
(39, 'à´•àµˆà´µàµ†à´Ÿàµà´Ÿà´—àµà´°àµà´¤à´¿', 10, 0),
(40, 'à´ªà´¨àµà´¤àµ€à´°à´¾à´´à´¿', 800, 0),
(41, 'à´…à´°à´ªà´¨àµà´¤àµ€à´°à´´à´¿', 400, 0),
(42, 'à´•à´¾à´²àµâ€à´ªà´¨àµà´¤àµ€à´°à´¾à´´à´¿', 250, 0),
(43, 'à´¤àµà´°à´¿à´®à´§àµà´°à´‚', 30, 0),
(44, 'à´•à´²à´‚à´•à´°à´¿à´•àµà´•à´²àµâ€', 10, 0),
(45, 'à´¤àµà´²à´¾à´­à´¾à´°à´‚', 20, 0),
(46, 'à´­à´°à´£à´¿à´Šà´Ÿàµà´Ÿàµ', 250, 0),
(47, 'à´®à´§àµà´ªàµ‚à´œ', 250, 0),
(48, 'à´µà´²à´¿à´¯à´—àµà´°àµà´¤à´¿', 5500, 0),
(49, 'KURUKAHOMAMMM', 5, 0);

--
-- Dumping data for table `star`
--

INSERT INTO `star` (`id`, `name`, `status_id`) VALUES
(1, 'à´…à´¶àµà´µà´¤à´¿', 0),
(2, 'à´­à´°à´£à´¿', 0),
(3, 'à´•à´¾à´°àµâ€à´¤àµà´¤à´¿à´•', 0),
(4, 'à´°àµ‹à´¹à´¿à´£à´¿', 0),
(5, 'à´®à´•à´¯à´¿à´°à´‚', 0),
(6, 'à´¤à´¿à´°àµà´µà´¾à´¤à´¿à´°', 0),
(7, 'à´ªàµà´£à´°àµâ€à´¤à´‚', 0),
(8, 'à´ªàµ‚à´¯à´‚', 0),
(9, 'à´†à´¯à´¿à´²àµà´¯à´‚', 0),
(10, 'à´®à´•à´‚', 0),
(12, 'à´‰à´¤àµà´°à´‚', 0),
(13, 'à´…à´¤àµà´¤à´‚', 0),
(14, 'à´šà´¿à´¤àµà´¤à´¿à´°', 0),
(15, 'à´šàµ‹à´¤à´¿', 0),
(16, 'à´µà´¿à´¶à´¾à´–à´‚', 0),
(17, 'à´…à´¨à´¿à´´à´‚', 0),
(18, 'à´¤àµƒà´•àµà´•àµ‡à´Ÿàµà´Ÿ', 0),
(19, 'à´®àµ‚à´²à´‚', 0),
(20, 'à´ªàµ‚à´°à´¾à´Ÿà´‚', 0),
(21, 'à´‰à´¤àµà´°à´¾à´Ÿà´‚', 0),
(22, 'à´¤à´¿à´°àµà´µàµ‹à´£à´‚', 0),
(23, 'à´…à´µà´¿à´Ÿàµà´Ÿà´‚', 0),
(24, 'à´šà´¤à´¯à´‚', 0),
(25, 'à´ªàµ‚à´°àµà´Ÿàµà´Ÿà´¾à´¤à´¿', 0),
(26, 'à´‰à´¤àµà´°à´Ÿàµà´Ÿà´¾à´¤à´¿', 0),
(27, 'à´°àµ‡à´µà´¤à´¿', 0),
(29, 'à´ªàµ‚à´¯à´¿à´²àµà´¯à´‚', 0),
(33, 'POORAM', 0);

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Inactive');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `address`, `occupation`, `user_status_id`, `organization_id`, `registration_date`, `activation_token`, `password_token`) VALUES
(1, 'tester@acube.co', '81dc9bdb52d04dc20036dbd8313ed055', 'Tester', 'Acube', 'tester@acube.co', '', 'tester@acube.co', 'tester@acube.co', 1, NULL, '0000-00-00 00:00:00', NULL, NULL),
(2, 'febeena@acube.co', '81dc9bdb52d04dc20036dbd8313ed055', 'febeena', 'shamneer', '', '9539031126', 'kochin', '', 1, 0, '2014-01-09 14:35:51', '', NULL),
(3, 'swapna', '81dc9bdb52d04dc20036dbd8313ed055', 'swapna', 'shiju', 'swapnam@gmail.com', '789456', 'swapnam@gmail.com', '789456', 1, 0, '2014-01-13 15:56:33', '', NULL),
(4, 'swapna@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'swapna', 'shijo', 'swapna@gmail.com', '98956485', 'swapna@gmail.com', '56565787', 1, 0, '2014-01-13 17:11:33', '', NULL),
(5, 'minto@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'minto', 'jojo', 'minto@gmail.com', '98954522', 'minto@gmail.com', '9895254', 1, 0, '2014-01-13 17:17:33', '', NULL),
(6, 'arun@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'arun', 'arun', 'arun@gmail.com', '36985214', 'arun@gmail.com', '4578588', 1, 0, '2014-01-13 17:19:36', '', NULL);

--
-- Dumping data for table `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `name`, `description`) VALUES
(1, 'Active', 'Active'),
(2, 'Waiting Email Activation', 'Email activation required'),
(3, 'Suspended', 'Suspended'),
(4, 'Disabled', 'Disabled');

--
-- Dumping data for table `vazhipadu`
--

INSERT INTO `vazhipadu` (`id`, `bill_item_id`, `name`, `star_id`, `pooja_id`, `rate`, `quantity`, `date`) VALUES
(1, 0, 'gfhgfhhgf', -1, 8, 34, 10, '0000-00-00'),
(2, 0, 'dfhgdf', -1, 2, 12, 10, '0000-00-00'),
(3, 0, 'swapna', -1, 9, 1, 40, '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
