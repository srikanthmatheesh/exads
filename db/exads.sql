-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2019 at 12:42 AM
-- Server version: 5.6.27
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `exads`
--

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

DROP TABLE IF EXISTS `designs`;
CREATE TABLE `designs` (
  `design_id` int(11) NOT NULL,
  `design_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `split_percent` int(3) NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`design_id`, `design_name`, `split_percent`, `view_count`) VALUES
(1, 'Design_1', 50, 0),
(2, 'Design_2 ', 25, 0),
(3, 'Design_3', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exads_test`
--

DROP TABLE IF EXISTS `exads_test`;
CREATE TABLE `exads_test` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `age` int(3) NOT NULL,
  `job_title` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`design_id`);

--
-- Indexes for table `exads_test`
--
ALTER TABLE `exads_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `design_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `exads_test`
--
ALTER TABLE `exads_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;