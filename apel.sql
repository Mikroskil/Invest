-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2013 at 05:45 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apel`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_answer`
--

CREATE TABLE IF NOT EXISTS `forum_answer` (
  `question_id` int(4) NOT NULL DEFAULT '0',
  `a_id` int(4) NOT NULL DEFAULT '0',
  `a_name` varchar(65) NOT NULL DEFAULT '',
  `a_email` varchar(65) NOT NULL DEFAULT '',
  `a_answer` longtext NOT NULL,
  `a_datetime` varchar(25) NOT NULL DEFAULT '',
  KEY `a_id` (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_answer`
--

INSERT INTO `forum_answer` (`question_id`, `a_id`, `a_name`, `a_email`, `a_answer`, `a_datetime`) VALUES
(1, 1, 'horeee', 'lala', 'iyah.. emang benar', '23/11/13 04:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `forum_question`
--

CREATE TABLE IF NOT EXISTS `forum_question` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL,
  `name` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL DEFAULT '',
  `datetime` varchar(25) NOT NULL DEFAULT '',
  `view` int(4) NOT NULL DEFAULT '0',
  `reply` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `forum_question`
--

INSERT INTO `forum_question` (`id`, `topic`, `detail`, `name`, `email`, `datetime`, `view`, `reply`) VALUES
(1, 'success', 'is my right', 'Wincun Marthadiarto', 'cunz_skyghost@yahoo.com', '23/11/13 04:43:01', 9, 1),
(2, 'ddd', 'aa', 'adff', 'dgg', '23/11/13 04:43:17', 3, 0),
(3, 'dfdf', 'hoho', 'dfdg', 'grrrrrrrr', '23/11/13 04:44:17', 0, 0),
(4, 'lala', 'empat', 'dfd', 'neng', '23/11/13 04:51:57', 0, 0),
(5, 'dfd', 'dd', 'Z', 'ws', '23/11/13 05:02:16', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `like_account`
--

CREATE TABLE IF NOT EXISTS `like_account` (
  `username` varchar(50) NOT NULL,
  `no_account` varchar(50) NOT NULL,
  `like_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_account`
--

INSERT INTO `like_account` (`username`, `no_account`, `like_status`) VALUES
('INSIN', ' 13000002 ', 1),
('INSIN', ' 13000001 ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu_sajian`
--

CREATE TABLE IF NOT EXISTS `menu_sajian` (
  `no_account` varchar(50) NOT NULL,
  `nama_sajian` varchar(100) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `menu_sajian`
--

INSERT INTO `menu_sajian` (`no_account`, `nama_sajian`, `jenis`, `harga`, `seq`) VALUES
('13000002', 'Nasi + Ayam Goreng Dada', 'Makanan', 32000, 2),
('13000002', 'Kentang Goreng', 'Makanan', 15000, 3),
('13000002', 'Pepsi / Coca Cola', 'Minuman', 8000, 5),
('13000001', 'coba', 'Makanan', 5000, 6);

-- --------------------------------------------------------

--
-- Table structure for table `mhd_user_maintenances`
--

CREATE TABLE IF NOT EXISTS `mhd_user_maintenances` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `responsibility` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mhd_user_maintenances`
--

INSERT INTO `mhd_user_maintenances` (`username`, `password`, `responsibility`, `status`, `nama`, `email`, `gender`, `alamat`, `kota`, `tanggal_lahir`, `phone_number`) VALUES
('INSIN', '8228aa46b48d6226677755331050101f', 'ADMINISTRATOR', 'ACTIVE', 'In Sin', 'Insin_Lie93@yahoo.com', 'MALE', 'JALAN PEMUDA 41', 'TANJUNG PURA', '0000-00-00', '089695435730'),
('TESTING', 'ae2b1fca515949e5d54fb22b8ed95575', 'USER', 'ACTIVE', 'Testing', 'Testing@testing.com', 'MALE', 'TESTING', 'TESTING', '0000-00-00', '085261114414'),
('XIN', '8228aa46b48d6226677755331050101f', 'USER', 'ACTIVE', 'IN SIN', 'Insin_Lie93@yahoo.com', 'MALE', 'JALAN PEMUDA 41', 'TANJUNG PURA', '0000-00-00', '089661960048');

-- --------------------------------------------------------

--
-- Table structure for table `trd_account`
--

CREATE TABLE IF NOT EXISTS `trd_account` (
  `no_account` varchar(30) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `nama` varchar(500) NOT NULL,
  `alamat` varchar(500) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `profil_pic` varchar(1000) DEFAULT NULL,
  `latitude` decimal(11,0) DEFAULT NULL,
  `longitude` decimal(11,0) DEFAULT NULL,
  PRIMARY KEY (`no_account`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trd_account`
--

INSERT INTO `trd_account` (`no_account`, `user_id`, `nama`, `alamat`, `status`, `profil_pic`, `latitude`, `longitude`) VALUES
('13000001', 'INSIN', 'McDonalds (Merdeka Walk)', 'JL. Balaikota, Komplek Merdeka Walk, Medan', 'statuss terbaru', '13000001.png', NULL, NULL),
('13000002', 'INSIN', 'Texas Chicken (Thamrin Plaza)', 'Jalan H.M. Thamrin, Medan', 'Rasakan Renyahnya Ayam Goreng hanya di TEXAS CHICKEN !!!', 'Texas.jpg', 4, 99),
('13000003', 'INSIN', 'Kantin Mikroskil (Gedung B Lantai 6)', 'Jalan Thamrin No. 112, Medan', 'cuma 9000', 'logo.png', 4, 99),
('13000004', 'INSIN', 'Pecel Lele Wajir', 'Jalan Kol. Soegiono', NULL, 'Warung-Makan-YPU6.jpg', 4, 99),
('13000005', 'INSIN', 'Warung Nasi Mbak Sri (sebelah Kantor Imigrasi)', 'Jalan Mangkubumi, Medan', 'Yuk... Rasakan sensasi pedasnya...', 'Made_Warung_Nasi_Campur.jpg', 4, 99),
('13000006', 'INSIN', 'Waroeng Steak and Shake', 'Jalan SM Raja, Medan', NULL, 'logo.png', 4, 99),
('13000007', 'TESTING', 'Rumah Makan Tabona (Wajir)', 'Jalan Kol. Soegiono, Medan', NULL, 'tabona.jpg', 4, 99),
('13000008', 'TESTING', 'Warung Bakso Sebelah Mikroskil', 'Jalan HM. Thamrin, Medan', NULL, 'Bakso_mi_bihun.jpg', 4, 99),
('13000009', 'INSIN', 'kelas', 'mikroskil', NULL, 'Chrysanthemum.jpg', 4, 99);

-- --------------------------------------------------------

--
-- Table structure for table `trd_comment`
--

CREATE TABLE IF NOT EXISTS `trd_comment` (
  `no_account` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `isi` varchar(1000) NOT NULL,
  `input_dt` datetime NOT NULL,
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `trd_comment`
--

INSERT INTO `trd_comment` (`no_account`, `username`, `isi`, `input_dt`, `seq`) VALUES
('13000001', 'INSIN', 'komentar baru', '2013-12-18 18:22:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trd_posting`
--

CREATE TABLE IF NOT EXISTS `trd_posting` (
  `no_account` varchar(30) NOT NULL,
  `status` text NOT NULL,
  `post_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trd_posting`
--

INSERT INTO `trd_posting` (`no_account`, `status`, `post_time`) VALUES
('13000003', 'cuma 9000', '2013-12-17 01:37:35'),
('13000001', 'GRATIS!\r\nIced Coffee atau Sundae\r\n\r\n*Syarat & Ketentuan berlaku', '2013-12-17 01:39:53'),
('13000005', 'Yuk... Rasakan sensasi pedasnya...', '2013-12-17 01:43:25'),
('13000002', 'Enaknya Ayam Goreng hanya di TEXAS CHICKEN !!!', '2013-12-18 02:04:26'),
('13000002', 'Rasakan Renyahnya Ayam Goreng hanya di TEXAS CHICKEN !!!', '2013-12-18 02:05:52'),
('13000002', 'Rasakan Renyahnya Ayam Goreng hanya di TEXAS CHICKEN !!!', '2013-12-18 02:06:12'),
('13000001', 'statuss terbaru', '2013-12-18 18:21:27');

--
-- Triggers `trd_posting`
--
DROP TRIGGER IF EXISTS `trig_ins_trd_posting`;
DELIMITER //
CREATE TRIGGER `trig_ins_trd_posting` AFTER INSERT ON `trd_posting`
 FOR EACH ROW UPDATE TRD_ACCOUNT
   SET STATUS = NEW.STATUS
 WHERE NO_ACCOUNT = NEW.NO_ACCOUNT
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
