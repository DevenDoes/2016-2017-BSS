-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2015 at 03:19 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `research`
--

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `id` int(11) NOT NULL,
  `author` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `filename` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `subject` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `time` int(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `author`, `filename`, `subject`, `name`, `time`) VALUES
(41, 'notaneditor@ncssm.edu', 'test_1450140692.txt', 'Test', 'The Effects of Lack of Sleep on BSS Webmasters', 1450140692),
(42, 'mig@ncssm.edu', 'test_1450141773.txt', 'adfasdfdsafdfs', 'asdfasdfasdf', 1450141773);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `password` blob,
  `salt` blob,
  `editor` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `salt`, `editor`) VALUES
(124, 'mig@ncssm.edu', 0x2a44324141443241333144333036463835463835303541303335373531453241424645464131364239, NULL, 1),
(125, 'test@ncssm.edu', 0x2a39344244434542453139303833434532413146393539464430324639363443374146344346433239, NULL, 0),
(126, 'ishaanislame@ncssm.edu', 0x2a42353036383638334342334132343046384232303845363934463833344535313246463038423346, NULL, 0),
(127, 'notaneditor@ncssm.edu', 0x2a44343031323830373637393337413331324545303741453445393930324331413238434134423635, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
