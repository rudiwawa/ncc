-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2019 at 10:34 AM
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

--
-- Functions
--
CREATE  FUNCTION `get_ID_jenis` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
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

CREATE  FUNCTION `get_ID_jenis_fasilitas` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
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

CREATE  FUNCTION `get_ID_main` () RETURNS VARCHAR(16) CHARSET latin1 BEGIN
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

CREATE  FUNCTION `get_ID_main_fasilitas` () RETURNS VARCHAR(16) CHARSET latin1 BEGIN
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
    SELECT CONCAT('PRW',tahun,LPAD(bulan, 2,'0'),LPAD(tanggal, 2,'0'), LPAD(ID_int +1, 5,'0')) INTO result;
    
    RETURN result;
    
END$$

CREATE  FUNCTION `get_ID_sub` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
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

CREATE  FUNCTION `get_ID_sub_fasilitas` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
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

CREATE  FUNCTION `get_lastID_jenis` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE last_id varchar(8);
 
 SELECT  pariwisata_jenis.id_jenis INTO last_id FROM pariwisata_jenis ORDER BY pariwisata_jenis.id_jenis DESC LIMIT 1;
   RETURN IFNULL(last_id, "JEN0001");
END$$

CREATE  FUNCTION `get_lastID_jenis_fasilitas` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE last_id varchar(8);
 
 SELECT  fasilitas_jenis.id_jenis INTO last_id FROM fasilitas_jenis ORDER BY fasilitas_jenis.id_jenis DESC LIMIT 1;
   RETURN IFNULL(last_id, "JEN0001");
END$$

CREATE  FUNCTION `get_lastID_main` () RETURNS VARCHAR(16) CHARSET latin1 BEGIN
    DECLARE last_id varchar(16);
 
 SELECT  pariwisata_main.id_pariwisata INTO last_id FROM pariwisata_main ORDER BY pariwisata_main.id_pariwisata DESC LIMIT 1;
    RETURN IFNULL(last_id, "PRW2019072000001");
 
END$$

CREATE  FUNCTION `get_lastID_main_fasilitas` () RETURNS VARCHAR(16) CHARSET latin1 BEGIN
    DECLARE last_id varchar(16);
 
 SELECT  fasilitas_main.id_fasilitas INTO last_id FROM fasilitas_main ORDER BY fasilitas_main.id_fasilitas DESC LIMIT 1;
    RETURN IFNULL(last_id, "PRW2019072000001");
 
END$$

CREATE  FUNCTION `get_lastID_sub_jenis` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE last_id varchar(8);
 
 SELECT  pariwisata_sub_jenis.id_sub INTO last_id FROM pariwisata_sub_jenis ORDER BY pariwisata_sub_jenis.id_sub DESC LIMIT 1;
    RETURN IFNULL(last_id, "SUB0001");
 
END$$

CREATE  FUNCTION `get_lastID_sub_jenis_fasilitas` () RETURNS VARCHAR(8) CHARSET latin1 BEGIN
    DECLARE last_id varchar(8);
 
 SELECT  fasilitas_sub_jenis.id_sub INTO last_id FROM fasilitas_sub_jenis ORDER BY fasilitas_sub_jenis.id_sub DESC LIMIT 1;
    RETURN IFNULL(last_id, "SUB0001");
 
END$$

DELIMITER ;

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
('JEN0014', 'sdsdds', '55fc70a2b4c0f5d212d773eb0052a008.jpg', '0', '1', '2019-07-23 15:17:19', 'admin1'),
('JEN0015', 'AAAA SSUUU', '95e4bf17b497e19458be698057dcf934.jpg', '0', '0', '2019-07-23 15:21:24', 'admin1'),
('JEN0016', 'sdsdf', '18f41693014515d8d6f776eb710f2a7f.jpg', '0', '0', '2019-07-23 15:21:33', 'admin1');

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
('PRW2019072300002', 'JEN0016', 'SUB0003', 'Tempora alias in cor', '{\"alamat\":[{\"alamat\":\"Cupidatat quos adipi\",\"loc\":\"Dolore minima illo e\"},{\"alamat\":\"Nisi qui quia a magn\",\"loc\":\"Maiores quas vel sin\"},{\"alamat\":\"Dolor id dicta vitae\",\"loc\":\"Laborum Aut est eiu\"},{\"alamat\":\"Voluptatum non facer\",\"loc\":\"Et amet libero quib\"}],\"ket\":\"Dolore amet labore \",\"tlp\":\"Sint et vitae ipsa \",\"website\":\"https:\\/\\/www.dywogylehut.mobi\",\"email\":\"kany@mailinator.com\"}', '[\"471c2e7b2c823ff5b2c6c615db01e49b.jpg\"]', '0', '2019-07-23 15:30:10', 'admin1'),
('PRW2019072300003', 'JEN0016', 'SUB0003', 'Autem tenetur corpor', '{\"alamat\":[{\"alamat\":\"Et eu ut non hic\",\"loc\":\"Irure consequat Qui\"}],\"ket\":\"Dolorem rerum sit o\",\"tlp\":\"A aut vel quas id om\",\"website\":\"https:\\/\\/www.fyresodubony.co\",\"email\":\"-\"}', '[\"4835061892c87106a2791096c5ff966b.jpg\",\"06a853859a39736fd531f0e1cd7ee1b6.jpg\",\"9c5f6c6d89bfd248a12a490d30541fcd.jpg\"]', '1', '2019-07-23 15:33:46', 'admin1');

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
('SUB0002', 'JEN0015', 'XXYYU', '0', '2019-07-23 15:22:02', 'admin2'),
('SUB0003', 'JEN0016', 'AAXXY', '0', '2019-07-23 15:21:57', 'admin2');

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
('JEN0002', 'dfdf', 'ca57558167577b4b6d7870c8e90e303c.gif', '0', '1', '2019-07-21 17:36:24', 'admin1'),
('JEN0003', 'dd', '45247cca59339c597d0344309f5d0176.jpg', '0', '1', '2019-07-21 17:36:53', 'admin1'),
('JEN0004', 'dfgfdg', '72accf27ebcdc98b9f1593fa8b2beda3.jpg', '0', '1', '2019-07-21 17:40:14', 'admin1'),
('JEN0005', 'Info Wisata', 'b4d6959c9b535f0f7966b9dc13ddf421.jpg', '0', '0', '2019-07-22 11:01:35', 'admin1'),
('JEN0006', 'Info Penginapan', '7a53a1a168d970bea3b3f83b78a5f5b6.jpg', '0', '0', '2019-07-21 17:45:12', 'admin1'),
('JEN0007', 'Info Oleh Oleh', 'fb3836ff9106a6033915a5a5aa3bec08.jpg', '0', '0', '2019-07-21 17:45:34', 'admin1'),
('JEN0008', 'Info Kuliner', '66b7cfcebe4474d68fe9925104129069.jpg', '0', '1', '2019-07-22 11:00:40', 'admin1'),
('JEN0009', ' j', '1d644ccd9a085d2183110c832183805b.jpg', '0', '1', '2019-07-22 09:38:23', 'admin1'),
('JEN0010', ' jjn ', '763e3f79a0f795e9c39bdd94cd254797.jpg', '0', '1', '2019-07-22 09:39:05', 'admin1'),
('JEN0011', 'Fasilitas Publik', '9cabd6b47470ad2678d407e2d9911dff.jpg', '0', '0', '2019-07-23 15:10:28', 'admin1'),
('JEN0012', 'Fasilitas Publik', '6c2d03699bdd2bab9dead2480f65ecc3.jpg', '0', '1', '2019-07-23 15:11:03', 'admin1'),
('JEN0013', 'XXX', 'c67c32742b3bb427d1dde2b81759de1a.jpg', '0', '1', '2019-07-23 15:14:25', 'admin1');

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
('PRW2019072100002', 'JEN0005', 'SUB0002', 'Kampung Tridi', '{\"alamat\":[{\"alamat\":\"Jl. Temenggungan Ledok, Kesatrian, Kec. Blimbing, Kota Malang, Jawa Timur 65121\",\"loc\":\"[\\\"0.989897\\\",\\\"0.989897\\\"]\"},{\"alamat\":\"Kota Malang, Jawa Timur 65121\",\"loc\":\"[\\\"0.989897\\\",\\\"0.989897\\\"]\"}],\"ket\":\"A hot spot for photos, this cheerful village offers colorful houses with funky decor & public art.\",\"tlp\":\"0813-3623-3017\",\"website\":\"https:\\/\\/www.instagram.com\\/kampung_tridi\\/\",\"email\":\"-\"}', '[\"6143c487a49bd0c142cee449d65a8c82.jpg\"]', '0', '2019-07-22 21:07:25', 'admin1'),
('PRW2019072100003', 'JEN0006', 'SUB0007', 'Aut harum fugiat ut', '{\"alamat\":[{\"alamat\":\"Voluptatem odio aut\",\"loc\":\"Totam veniam qui ex\"}],\"ket\":\"Accusantium beatae e\",\"tlp\":\"Eveniet labore duci\",\"website\":\"https:\\/\\/www.vywidu.co\",\"email\":\"habyzuwal@mailinator.net\"}', '[\"3f1e10448fe419f8f67e33865a2cdd83.jpg\",\"6e1458884733cb5c69c46fc09823b5d6.jpg\"]', '0', '2019-07-22 11:33:18', 'admin1'),
('PRW2019072200004', 'JEN0006', 'SUB0006', 'Numquam ullamco inci', '{\"alamat\":[{\"alamat\":\"Voluptatum quidem ne\",\"loc\":\"Fuga A repudiandae \"}],\"ket\":\"dfdfdf\",\"tlp\":\"Sint aut eligendi qu\",\"website\":\"https:\\/\\/www.runozynulesud.tv\",\"email\":\"qetomywyf@mailinator.net\"}', '[\"a18b3eeb4a9806a6395251d1ebc750c6.jpg\",\"29c66fcf85177d714d6b7de22c1f390c.jpg\"]', '1', '2019-07-22 14:26:19', 'admin1'),
('PRW2019072200005', 'JEN0006', 'SUB0006', 'Pariatur Sunt non ', '{\"alamat\":[{\"alamat\":\"alamat\",\"loc\":\"Quasi Nam exercitati\"}],\"ket\":\"Ipsam nobis est anim\",\"tlp\":\"Veniam quis in libe\",\"website\":\"https:\\/\\/www.varysa.ws\",\"email\":\"zuxyxo@mailinator.net\"}', '[\"7a3962e67a4f5ed1cfca7120a725cb26.jpg\"]', '1', '2019-07-22 09:17:49', 'admin1'),
('PRW2019072200006', 'JEN0006', 'SUB0006', 'Quis a optio neque ', '{\"alamat\":[{\"alamat\":\"Ex voluptatem Sint \",\"loc\":\"Laborum Vel dolorem\"}],\"ket\":\"Sapiente ipsum ipsum\",\"tlp\":\"Quia in non cumque m\",\"website\":\"https:\\/\\/www.vadebequcecowe.net\",\"email\":\"nuquhik@mailinator.com\"}', '[\"b195ecbdd92eaf95985cf8a48149d16f.jpg\"]', '1', '2019-07-22 09:06:36', 'admin1'),
('PRW2019072200007', 'JEN0006', 'SUB0006', 'Temporibus aut sequi', '{\"alamat\":[{\"alamat\":\"Exercitationem est e\",\"loc\":\"Commodi est minima \"},{\"alamat\":\"fui\",\"loc\":\"tuyy\"}],\"ket\":\"Maxime quia dicta et\",\"tlp\":\"Soluta est rem sapie\",\"website\":\"https:\\/\\/www.diwuhuredud.cm\",\"email\":\"wucahuqoce@mailinator.net\"}', '[\"ddbb48b70321d788f01273fa380f3f7e.jpg\",\"55ce9395a823b2518eaf128d84ca78e6.jpg\"]', '1', '2019-07-22 10:45:22', 'admin1'),
('PRW2019072300008', 'JEN0006', 'SUB0006', 'Magni laborum Imped', '{\"alamat\":[{\"alamat\":\"Ut dolores in eligen\",\"loc\":\"Ad quod et velit qui\"},{\"alamat\":\"sdsd\",\"loc\":\"sdsd\"}],\"ket\":\"Voluptatem tempor se\",\"tlp\":\"Sequi mollit quo qua\",\"website\":\"https:\\/\\/www.buwahilypi.cm\",\"email\":\"juwuge@mailinator.com\"}', '[\"cd8b92d2c7f612a01a197169bff29aa0.jpg\"]', '0', '2019-07-23 14:05:42', 'admin1'),
('PRW2019072300009', 'JEN0016', 'SUB0003', 'Suscipit non explica', '{\"alamat\":[{\"alamat\":\"Aute velit dolor et \",\"loc\":\"Cumque aliquid qui o\"}],\"ket\":\"Dolor exercitation p\",\"tlp\":\"Consectetur ratione\",\"website\":\"https:\\/\\/www.zyfagiq.org\",\"email\":\"nacazoc@mailinator.net\"}', '[\"e4a1928d959300920394de0956839b34.jpg\",\"3558c332a66d21c544f75a2870157676.jpg\"]', '0', '2019-07-23 15:22:36', 'admin1');

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
('SUB0002', 'JEN0005', 'Kampung Wisata', '0', '2019-07-22 11:01:28', 'admin2'),
('SUB0003', 'JEN0005', 'Wisata Sejarah', '0', '2019-07-21 17:46:57', 'admin2'),
('SUB0004', 'JEN0005', 'Wisata Religi', '0', '2019-07-21 17:47:05', 'admin2'),
('SUB0005', 'JEN0005', 'Wisata Rekreasi', '0', '2019-07-21 17:47:14', 'admin2'),
('SUB0006', 'JEN0006', 'Hotel', '0', '2019-07-21 17:47:31', 'admin2'),
('SUB0007', 'JEN0006', 'Homestay', '1', '2019-07-21 17:48:19', 'admin2'),
('SUB0008', 'JEN0006', 'Guest House', '0', '2019-07-21 17:48:08', 'admin2'),
('SUB0009', 'JEN0005', 'dfdf', '1', '2019-07-21 17:48:33', 'admin2'),
('SUB0010', 'JEN0010', 'myuh iuiuii uh ihi ih', '0', '2019-07-22 09:39:26', 'admin2');

--
-- Indexes for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
