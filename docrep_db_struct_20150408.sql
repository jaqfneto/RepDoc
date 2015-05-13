-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2015 at 03:19 PM
-- Server version: 5.5.41-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `docrep_db`
--
CREATE DATABASE IF NOT EXISTS `docrep_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `docrep_db`;

-- --------------------------------------------------------

--
-- Table structure for table `files_index_table`
--

DROP TABLE IF EXISTS `files_index_table`;
CREATE TABLE IF NOT EXISTS `files_index_table` (
  `id` int(11) NOT NULL,
  `palavra` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ids_files` varchar(1000) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81885 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `indexed_files_table`
--

DROP TABLE IF EXISTS `indexed_files_table`;
CREATE TABLE IF NOT EXISTS `indexed_files_table` (
  `id` int(11) NOT NULL,
  `id_file` int(11) NOT NULL,
  `file_path` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=307 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `index_table`
--

DROP TABLE IF EXISTS `index_table`;
CREATE TABLE IF NOT EXISTS `index_table` (
  `id` int(11) NOT NULL,
  `palavra` varchar(30) CHARACTER SET utf8 NOT NULL,
  `ids_missoes` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=532 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `missao`
--

DROP TABLE IF EXISTS `missao`;
CREATE TABLE IF NOT EXISTS `missao` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) CHARACTER SET utf8 NOT NULL,
  `descricao` varchar(240) COLLATE utf8_bin NOT NULL,
  `assunto` varchar(350) COLLATE utf8_bin NOT NULL,
  `dep` varchar(20) COLLATE utf8_bin NOT NULL,
  `ano` year(4) NOT NULL,
  `link_to_apresentacao` varchar(60) COLLATE utf8_bin NOT NULL,
  `num_participantes` int(11) NOT NULL,
  `p1` varchar(60) COLLATE utf8_bin NOT NULL,
  `r1` varchar(80) COLLATE utf8_bin NOT NULL,
  `p2` varchar(30) COLLATE utf8_bin NOT NULL,
  `r2` varchar(80) COLLATE utf8_bin NOT NULL,
  `p3` varchar(30) COLLATE utf8_bin NOT NULL,
  `r3` varchar(80) COLLATE utf8_bin NOT NULL,
  `logo` varchar(40) COLLATE utf8_bin NOT NULL,
  `Keywords` varchar(240) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `palavras_procuradas`
--

DROP TABLE IF EXISTS `palavras_procuradas`;
CREATE TABLE IF NOT EXISTS `palavras_procuradas` (
  `id` int(11) NOT NULL,
  `palavra` varchar(30) COLLATE utf8_bin NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `hostName` varchar(100) COLLATE utf8_bin NOT NULL,
  `hostIP` varchar(50) COLLATE utf8_bin NOT NULL,
  `lastAccessDateTime` datetime NOT NULL,
  `numAccess` int(11) NOT NULL,
  `sessions` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files_index_table`
--
ALTER TABLE `files_index_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indexed_files_table`
--
ALTER TABLE `indexed_files_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `index_table`
--
ALTER TABLE `index_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missao`
--
ALTER TABLE `missao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `palavras_procuradas`
--
ALTER TABLE `palavras_procuradas`
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
-- AUTO_INCREMENT for table `files_index_table`
--
ALTER TABLE `files_index_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81885;
--
-- AUTO_INCREMENT for table `indexed_files_table`
--
ALTER TABLE `indexed_files_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=307;
--
-- AUTO_INCREMENT for table `index_table`
--
ALTER TABLE `index_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=532;
--
-- AUTO_INCREMENT for table `missao`
--
ALTER TABLE `missao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `palavras_procuradas`
--
ALTER TABLE `palavras_procuradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
