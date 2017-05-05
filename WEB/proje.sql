-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Nis 2016, 19:48:48
-- Sunucu sürümü: 5.7.9
-- PHP Sürümü: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `course` varchar(10) NOT NULL,
  PRIMARY KEY (`class_id`),
  KEY `course` (`course`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `course_code` varchar(10) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `course_type` varchar(50) NOT NULL,
  `section` int(2) NOT NULL,
  `lecturer` int(100) NOT NULL,
  PRIMARY KEY (`course_code`),
  KEY `lecturer` (`lecturer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `curve_grade`
--

DROP TABLE IF EXISTS `curve_grade`;
CREATE TABLE IF NOT EXISTS `curve_grade` (
  `curve_id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(10) NOT NULL,
  `letter` varchar(5) NOT NULL,
  `first` int(11) NOT NULL,
  `last` int(11) NOT NULL,
  PRIMARY KEY (`curve_id`),
  KEY `course` (`course`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `default_grade`
--

DROP TABLE IF EXISTS `default_grade`;
CREATE TABLE IF NOT EXISTS `default_grade` (
  `letter_grade` varchar(5) NOT NULL,
  `first_grade` int(11) NOT NULL,
  `last_grade` int(11) NOT NULL,
  PRIMARY KEY (`letter_grade`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `classes` int(11) NOT NULL,
  `field1` varchar(50) NOT NULL,
  `field2` varchar(50) NOT NULL,
  `field3` varchar(50) NOT NULL,
  `field4` varchar(50) NOT NULL,
  `field5` varchar(50) NOT NULL,
  `field7` varchar(50) NOT NULL,
  `field8` varchar(50) NOT NULL,
  `field9` varchar(50) NOT NULL,
  `field10` varchar(50) NOT NULL,
  `field11` varchar(50) NOT NULL,
  `field12` varchar(50) NOT NULL,
  `field13` varchar(50) NOT NULL,
  `field14` varchar(50) NOT NULL,
  `field15` varchar(50) NOT NULL,
  `field16` varchar(50) NOT NULL,
  `field17` varchar(50) NOT NULL,
  `field18` varchar(50) NOT NULL,
  `field19` varchar(50) NOT NULL,
  `field20` varchar(50) NOT NULL,
  `field_percentage1` int(11) NOT NULL,
  `field_percentage2` int(11) NOT NULL,
  `field_percentage3` int(11) NOT NULL,
  `field_percentage4` int(11) NOT NULL,
  `field_percentage5` int(11) NOT NULL,
  `field_percentage6` int(11) NOT NULL,
  `field_percentage7` int(11) NOT NULL,
  `field_percentage8` int(11) NOT NULL,
  `field_percentage9` int(11) NOT NULL,
  `field_percentage10` int(11) NOT NULL,
  `field_percentage11` int(11) NOT NULL,
  `field_percentage12` int(11) NOT NULL,
  `field_percentage13` int(11) NOT NULL,
  `field_percentage14` int(11) NOT NULL,
  `field_percentage15` int(11) NOT NULL,
  `field_percentage16` int(11) NOT NULL,
  `field_percentage17` int(11) NOT NULL,
  `field_percentage18` int(11) NOT NULL,
  `field_percentage19` int(11) NOT NULL,
  `field_percentage20` int(11) NOT NULL,
  PRIMARY KEY (`grade_id`),
  KEY `classes` (`classes`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tip` int(1) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `tip`) VALUES
(13, 'superuser', '123', 1),
(12, 'lecturer', '123', 3),
(10, 'admin', '123', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
