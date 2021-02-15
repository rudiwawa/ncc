-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2019 at 10:21 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`nccsquad`@`%` PROCEDURE `p3` ()  BEGIN
    DECLARE last_id INT DEFAULT 55;
    SET last_id = 55;
  END$$

CREATE DEFINER=`nccsquad`@`%` PROCEDURE `SET_id` ()  BEGIN
DECLARE id varchar (8);
SELECT (`get_ID_sub`()) INTO id; 
    INSERT INTO `pariwisata_sub_jenis` (`id_sub`, `id_jenis`, `ket_sub_jenis`, `is_delete`, `time_update`, `id_admin`) VALUES (id, '', '', '', '', '');
  END$$

--
-- Functions
--
CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_ID_jenis` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE
        ID_v varchar(5);
    DECLARE
        result varchar(8);
    DECLARE
        ID_int INT DEFAULT 0;
    SELECT SUBSTRING(`get_lastID_jenis`(), 4, 5) INTO ID_v;
    SELECT CAST(ID_v AS int) INTO ID_int;
    SELECT CONCAT('JEN', LPAD(ID_int +1, 4,'0')) INTO result;
    
    RETURN result;
    
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_ID_jenis_fasilitas` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE
        ID_v varchar(5);
    DECLARE
        result varchar(8);
    DECLARE
        ID_int INT DEFAULT 0;
    SELECT SUBSTRING(`get_lastID_jenis_fasilitas`(), 4, 5) INTO ID_v;
    SELECT CAST(ID_v AS int) INTO ID_int;
    SELECT CONCAT('JEN', LPAD(ID_int +1, 4,'0')) INTO result;
    
    RETURN result;
    
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_ID_main` () RETURNS VARCHAR(16) CHARSET latin1 BEGIN
    DECLARE
        ID_v varchar(5);
    DECLARE
        result varchar(16);
    DECLARE
        ID_int INT DEFAULT 0;
	DECLARE
    	bulan varchar(5);
    DECLARE
    	tahun varchar(5);
    DECLARE
    	tanggal varchar(5);
        
    SELECT DAY(NOW()) INTO tanggal;
    SELECT MONTH(NOW()) INTO bulan;
    SELECT YEAR(NOW()) INTO tahun;
    
    SELECT SUBSTRING(`get_lastID_main`(), 12, 5) INTO ID_v;
    SELECT CAST(ID_v AS int) INTO ID_int;
    SELECT CONCAT('PRW',tahun,LPAD(bulan, 2,'0'),LPAD(tanggal, 2,'0'), LPAD(ID_int +1, 5,'0')) INTO result;
    
    RETURN result;
    
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_ID_main_fasilitas` () RETURNS VARCHAR(16) CHARSET latin1 BEGIN
    DECLARE
        ID_v varchar(5);
    DECLARE
        result varchar(16);
    DECLARE
        ID_int INT DEFAULT 0;
	DECLARE
    	bulan varchar(5);
    DECLARE
    	tahun varchar(5);
    DECLARE
    	tanggal varchar(5);
        
    SELECT DAY(NOW()) INTO tanggal;
    SELECT MONTH(NOW()) INTO bulan;
    SELECT YEAR(NOW()) INTO tahun;
    
    SELECT SUBSTRING(`get_lastID_main_fasilitas`(), 12, 5) INTO ID_v;
    SELECT CAST(ID_v AS int) INTO ID_int;
    SELECT CONCAT('FAS',tahun,LPAD(bulan, 2,'0'),LPAD(tanggal, 2,'0'), LPAD(ID_int +1, 5,'0')) INTO result;
    
    RETURN result;
    
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_ID_sub` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE
        ID_v varchar(5);
    DECLARE
        result varchar(8);
    DECLARE
        ID_int INT DEFAULT 0;
    SELECT SUBSTRING(`get_lastID_sub_jenis`(), 4, 5) INTO ID_v;
    SELECT CAST(ID_v AS int) INTO ID_int;
    SELECT CONCAT('SUB', LPAD(ID_int +1, 4,'0')) INTO result;
    
    RETURN result;
    
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_ID_sub_fasilitas` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE
        ID_v varchar(5);
    DECLARE
        result varchar(8);
    DECLARE
        ID_int INT DEFAULT 0;
    SELECT SUBSTRING(`get_lastID_sub_jenis_fasilitas`(), 4, 5) INTO ID_v;
    SELECT CAST(ID_v AS int) INTO ID_int;
    SELECT CONCAT('SUB', LPAD(ID_int +1, 4,'0')) INTO result;
    
    RETURN result;
    
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_lastID_jenis` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE last_id varchar(8);
 
 SELECT  pariwisata_jenis.id_jenis INTO last_id FROM pariwisata_jenis ORDER BY pariwisata_jenis.id_jenis DESC LIMIT 1;
   RETURN IFNULL(last_id, "JEN0001");
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_lastID_jenis_fasilitas` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE last_id varchar(8);
 
 SELECT  fasilitas_jenis.id_jenis INTO last_id FROM fasilitas_jenis ORDER BY fasilitas_jenis.id_jenis DESC LIMIT 1;
   RETURN IFNULL(last_id, "JEN0001");
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_lastID_main` () RETURNS VARCHAR(16) CHARSET latin1 BEGIN
    DECLARE last_id varchar(16);
 
 SELECT  pariwisata_main.id_pariwisata INTO last_id FROM pariwisata_main ORDER BY pariwisata_main.id_pariwisata DESC LIMIT 1;
    RETURN IFNULL(last_id, "PRW2019072000001");
 
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_lastID_main_fasilitas` () RETURNS VARCHAR(16) CHARSET latin1 BEGIN
    DECLARE last_id varchar(16);
 
 SELECT  fasilitas_main.id_fasilitas INTO last_id FROM fasilitas_main ORDER BY fasilitas_main.id_fasilitas DESC LIMIT 1;
    RETURN IFNULL(last_id, "PRW2019072000001");
 
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_lastID_sub_jenis` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE last_id varchar(8);
 
 SELECT  pariwisata_sub_jenis.id_sub INTO last_id FROM pariwisata_sub_jenis ORDER BY pariwisata_sub_jenis.id_sub DESC LIMIT 1;
    RETURN IFNULL(last_id, "SUB0001");
 
END$$

CREATE DEFINER=`nccsquad`@`%` FUNCTION `get_lastID_sub_jenis_fasilitas` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE last_id varchar(8);
 
 SELECT  fasilitas_sub_jenis.id_sub INTO last_id FROM fasilitas_sub_jenis ORDER BY fasilitas_sub_jenis.id_sub DESC LIMIT 1;
    RETURN IFNULL(last_id, "SUB0001");
 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `time_update` datetime NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `password_admin`, `time_update`, `activated`) VALUES
(4, 'aaaa', 'aaa@dd.c', '$2y$10$hFd6wka9xByHqljwaUs1jO0/TIdrDQefvr/XP.3xdM7', '2019-08-13 04:29:06', 2),
(13, 'danang', 'danangtp@student.ub.ac.id', '$2y$10$z94p6CXpgOqZ7zkoYebvvO0Cg69lmv/416rZYG9jxlycvanorp0V.', '2019-08-13 06:38:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_jenis`
--

CREATE TABLE `fasilitas_jenis` (
  `id_jenis` varchar(8) NOT NULL,
  `ket_jenis` text NOT NULL,
  `img` text NOT NULL,
  `img_marker` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL,
  `time_update` datetime NOT NULL,
  `id_admin` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas_jenis`
--

INSERT INTO `fasilitas_jenis` (`id_jenis`, `ket_jenis`, `img`, `img_marker`, `is_delete`, `time_update`, `id_admin`) VALUES
('JEN0002', 'TRANSPORTASI', 'db4731f921eadee9fc7b21f23f710ad6.jpg', '0', '0', '2019-08-12 10:55:15', 'admin1'),
('JEN0003', 'HALTE', 'd29eaae9f8d38539c61659ce210f78d0.jpg', '0', '0', '2019-08-12 10:57:54', 'admin1'),
('JEN0004', 'STASIUN', '63ccba92e0046f0ab7368e167349e12f.jpg', '0', '0', '2019-08-14 14:49:00', 'admin1'),
('JEN0005', 'AAA', '5b7920cd424fee46ec5305b71b4d5163.jpg', '0', '1', '2019-08-12 11:02:01', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_main`
--

CREATE TABLE `fasilitas_main` (
  `id_fasilitas` varchar(16) NOT NULL,
  `id_jenis` varchar(8) NOT NULL,
  `id_sub` varchar(8) NOT NULL,
  `ket_main` text NOT NULL,
  `detail` text NOT NULL,
  `img` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL,
  `time_update` datetime NOT NULL,
  `id_admin` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas_main`
--

INSERT INTO `fasilitas_main` (`id_fasilitas`, `id_jenis`, `id_sub`, `ket_main`, `detail`, `img`, `is_delete`, `time_update`, `id_admin`) VALUES
('FAS2019081200002', 'JEN0002', 'SUB0002', 'BUS', '{\"alamat\":[{\"alamat\":\"Jl. Buring No.61, 65112, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa Timur 65119, Indonesia\",\"loc\":\"[\'0.989897\',\'0.989897\']\"},{\"alamat\":\"Jl. A. Yani No.15, Blimbing, Kec. Blimbing, Kota Malang, Jawa Timur 65126, Indonesia\",\"loc\":\"[\'-7.941967\',\'112.641457\']\"}],\"ket\":\"SDFGHJK45678\",\"tlp\":\"098765432345\",\"website\":\"https:\\/\\/lh5.com\",\"email\":\"widyatamaadi@gmail.com\"}', '[\"ac589c3f86e56a9ca2ad16d0e2623fc2.jpg\"]', '0', '2019-08-14 14:24:59', 'admin1'),
('FAS2019081200003', 'JEN0002', 'SUB0002', 'GATAU`\'', '{\"alamat\":[{\"alamat\":\"Jl. Buring No.61, 65112, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa Timur 65119, Indonesia\",\"loc\":\"[\'-7.969051\',\'112.624397\']\"}],\"ket\":\"ASDFGH4321[;L\",\"tlp\":\"098765432345\",\"website\":\"https:\\/\\/lh5.com\",\"email\":\"admin@admin.com\"}', '[\"8454779c3899d1cb9739111af81f558a.jpg\",\"b5a2c7c7a40ff35280d6a7c32bfa6ac6.jpg\",\"f12e97d1adcb176eb8e78ca6997a20de.jpg\"]', '0', '2019-08-14 14:23:35', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_sub_jenis`
--

CREATE TABLE `fasilitas_sub_jenis` (
  `id_sub` varchar(8) NOT NULL,
  `id_jenis` varchar(8) NOT NULL,
  `ket_sub_jenis` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL,
  `time_update` datetime NOT NULL,
  `id_admin` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas_sub_jenis`
--

INSERT INTO `fasilitas_sub_jenis` (`id_sub`, `id_jenis`, `ket_sub_jenis`, `is_delete`, `time_update`, `id_admin`) VALUES
('SUB0002', 'JEN0002', 'DARAT', '0', '2019-08-12 11:00:04', 'admin2'),
('SUB0003', 'JEN0002', 'LAUT', '0', '2019-08-12 10:59:58', 'admin2'),
('SUB0004', 'JEN0004', 'KERETA', '0', '2019-08-12 11:00:28', 'admin2'),
('SUB0005', 'JEN0002', 'sd', '0', '2019-08-14 13:50:01', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` int(1) NOT NULL DEFAULT '0',
  `is_private_key` int(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pariwisata_jenis`
--

CREATE TABLE `pariwisata_jenis` (
  `id_jenis` varchar(8) NOT NULL,
  `ket_jenis` text NOT NULL,
  `img` text NOT NULL,
  `img_marker` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL,
  `time_update` datetime NOT NULL,
  `id_admin` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pariwisata_jenis`
--

INSERT INTO `pariwisata_jenis` (`id_jenis`, `ket_jenis`, `img`, `img_marker`, `is_delete`, `time_update`, `id_admin`) VALUES
('JEN0002', 'Info Tempat Wisata', '0ea6471050d8a9dd9f7b2a717486f25c.jpg', '0', '0', '2019-08-12 10:06:17', 'admin1'),
('JEN0003', 'Info Penginapan', '321919e630ca31756562ee6b375ee2ee.jpg', '0', '0', '2019-08-14 14:11:18', 'admin1'),
('JEN0004', 'Info- Kuliner', '894eb8bbcc6d0953ac50f7df8b3130c7.jpg', '0', '1', '2019-08-13 14:02:44', 'admin1'),
('JEN0005', 'Info Oleh oleh', '903e557d2a14c516271cf1bea4e4826c.jpg', '0', '1', '2019-08-12 10:08:45', 'admin1'),
('JEN0006', 'Info Oleh-oleh', '0cbda5fe38cfab6ccd4382e384082c36.jpg', '0', '0', '2019-08-14 15:07:02', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `pariwisata_main`
--

CREATE TABLE `pariwisata_main` (
  `id_pariwisata` varchar(16) NOT NULL,
  `id_jenis` varchar(8) NOT NULL,
  `id_sub` varchar(8) NOT NULL,
  `ket_main` text NOT NULL,
  `detail` text NOT NULL,
  `img` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL,
  `time_update` datetime NOT NULL,
  `id_admin` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pariwisata_main`
--

INSERT INTO `pariwisata_main` (`id_pariwisata`, `id_jenis`, `id_sub`, `ket_main`, `detail`, `img`, `is_delete`, `time_update`, `id_admin`) VALUES
('PRW2019081200004', 'JEN0002', 'SUB0005', 'Paroki Santa Perawan Maria dari Gunung Karmel', '{\"alamat\":[{\"alamat\":\"Jl. Buring No.61, 65112, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa Timur 65119, Indonesia\",\"loc\":\"[\'-7.969051\',\'112.624397\']\"}],\"ket\":\"Jangan lupa ibadah wkwk\",\"tlp\":\"098765432345\",\"website\":\"www.mesjid.com\",\"email\":\"mahmoud@zalt.me\"}', '[\"2662fda4f16fd3b2ec06ab7fa48cb184.jpg\",\"7a9085bb5bcc6d9ca080d50560ab0753.jpg\",\"5c0593d08d03b88daf0bf7409eddbb13.jpg\"]', '0', '2019-08-14 14:20:51', 'admin1'),
('PRW2019081200005', 'JEN0002', 'SUB0005', 'Alun Alun Merdeka Malang', '{\"alamat\":[{\"alamat\":\"Jl. Merdeka Selatan, Kiduldalem, Kec. Klojen, Kota Malang, Jawa Timur 65119, Indonesia\",\"loc\":\"[\'-7.982424\',\'112.630800\']\"}],\"ket\":\"Keren cuy\",\"tlp\":\"098765432345\",\"website\":\"www.alun.com\",\"email\":\"admin@admin.com\"}', '[\"a0fcea57e6319ac201115cd7e6cbb440.jpg\",\"11097b830c316171db36943f798a36ae.jpg\",\"6ebca43e01bd09f3dd225c921b179488.jpg\"]', '0', '2019-08-14 13:22:38', 'admin1'),
('PRW2019081200006', 'JEN0002', 'SUB0005', 'Eco Edu Park', '{\"alamat\":[{\"alamat\":\"Unnamed Road, Purwantoro, Kec. Blimbing, Kota Malang, Jawa Timur 65126, Indonesia\",\"loc\":\"[\\\"-7.945877\',\'112.641905\']\"}],\"ket\":\"apa yaaa\",\"tlp\":\"098789876678\",\"website\":\"www.ccc.com\",\"email\":\"admin@admin.com\"}', '[\"d1a8b3dfacfe0de6806dd17976d5ea12.jpg\",\"c8adbb11c138252642647a495b3cd37d.jpg\"]', '0', '2019-08-14 14:52:49', 'admin1'),
('PRW2019081400007', 'JEN0002', 'SUB0005', 'Malang Strudel', '{\"alamat\":[{\"alamat\":\"Jl. Buring No.61, 65112, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa Timur 65119, Indonesia\",\"loc\":\"[\'-7.969051\',\'112.624397\']\"}],\"ket\":\"enak guys\",\"tlp\":\"098789876678\",\"website\":\"strudel.com\",\"email\":\"admin@admin.com\"}', '[\"91e8e1b0d7c3347807a1494eaac0a39b.jpg\",\"d06d5a80cd8b47e30617cce865e1b9de.jpg\",\"5550d9493c65175f364faca50428edee.jpg\"]', '0', '2019-08-14 15:08:49', 'admin1'),
('PRW2019081400008', 'JEN0003', 'SUB0009', 'tejooo homestay', '{\"alamat\":[{\"alamat\":\"Jl. Buring No.61, 65112, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa Timur 65119, Indonesia\",\"loc\":\"[\'-7.941967\',\'112.641457\']\"}],\"ket\":\"lalalaa\",\"tlp\":\"098765432345\",\"website\":\"https:\\/\\/tejotejoooo.com\",\"email\":\"widyatamaadi@gmail.com\"}', '[\"2889de7989a4c5d5eb00247d0befa09d.jpg\"]', '0', '2019-08-14 14:44:48', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `pariwisata_sub_jenis`
--

CREATE TABLE `pariwisata_sub_jenis` (
  `id_sub` varchar(8) NOT NULL,
  `id_jenis` varchar(8) NOT NULL,
  `ket_sub_jenis` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL,
  `time_update` datetime NOT NULL,
  `id_admin` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pariwisata_sub_jenis`
--

INSERT INTO `pariwisata_sub_jenis` (`id_sub`, `id_jenis`, `ket_sub_jenis`, `is_delete`, `time_update`, `id_admin`) VALUES
('SUB0002', 'JEN0002', 'Taman Slamet', '1', '2019-08-12 09:24:50', 'admin2'),
('SUB0003', 'JEN0003', 'Eco Edu Park', '1', '2019-08-12 09:25:10', 'admin2'),
('SUB0004', 'JEN0004', 'Masjid Jami', '1', '2019-08-12 09:26:04', 'admin2'),
('SUB0005', 'JEN0002', 'Wisata Taman', '0', '2019-08-12 10:09:33', 'admin2'),
('SUB0006', 'JEN0002', 'Wisata Edukasi', '0', '2019-08-12 10:09:44', 'admin2'),
('SUB0007', 'JEN0002', 'Wisata Religi', '0', '2019-08-12 10:09:54', 'admin2'),
('SUB0008', 'JEN0003', 'Hotel', '0', '2019-08-12 10:10:05', 'admin2'),
('SUB0009', 'JEN0003', 'Homestay', '1', '2019-08-12 10:10:24', 'admin2'),
('SUB0010', 'JEN0003', 'Guest House', '0', '2019-08-12 10:10:39', 'admin2'),
('SUB0011', 'JEN0004', 'Unknown', '0', '2019-08-12 10:54:00', 'admin2'),
('SUB0012', 'JEN0005', 'Unknown', '0', '2019-08-12 10:53:55', 'admin2'),
('SUB0013', 'JEN0006', 'Strudel', '0', '2019-08-14 14:36:05', 'admin2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `fasilitas_jenis`
--
ALTER TABLE `fasilitas_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `fasilitas_main`
--
ALTER TABLE `fasilitas_main`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `fasilitas_sub_jenis`
--
ALTER TABLE `fasilitas_sub_jenis`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pariwisata_jenis`
--
ALTER TABLE `pariwisata_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `pariwisata_main`
--
ALTER TABLE `pariwisata_main`
  ADD PRIMARY KEY (`id_pariwisata`);

--
-- Indexes for table `pariwisata_sub_jenis`
--
ALTER TABLE `pariwisata_sub_jenis`
  ADD PRIMARY KEY (`id_sub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
