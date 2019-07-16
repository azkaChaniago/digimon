-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2019 at 09:21 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_telkomsel`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `compare` (`Divisi` VARCHAR(30), `Lim` INT(11))  BEGIN
SELECT 
	monthname(sc.tanggal), sc.nsb AS `sc_nsb`, ta.nsb AS `ta_nsb`,
	sc.gt_pulsa AS `sc_gt_pulsa`, ta.gt_pulsa AS `ta_gt_pulsa`,
    m.nama_marketing, m.divisi, m.kode_marketing
FROM
	tbl_score_card AS sc
INNER JOIN 
	tbl_target_assignment AS ta
ON
	monthname(sc.tanggal) = monthname(ta.tanggal)
INNER JOIN
	tbl_marketing AS m
ON 
	sc.kode_marketing = m.kode_marketing
WHERE sc.kode_marketing = ta.kode_marketing AND m.divisi = Divisi LIMIT Lim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_canvasser_kpi` (`Awal` VARCHAR(20), `Akhir` VARCHAR(20))  BEGIN
	SELECT 
        u.nama_tdc AS `nama_tdc`,
        `ta`.`tanggal` AS `tanggal`,
        `m`.`kode_tdc` AS `kode_tdc`,
        `m`.`divisi` AS `divisi`,
        MONTHNAME(`ta`.`tanggal`) AS `bulan`,
        YEAR(`ta`.`tanggal`) AS `tahun`,
        ((((((((ROUND((((SUM(`sc`.`new_opening_outlet`) / `ta`.`new_opening_outlet`) * 3) / 100),
                2) + ROUND((((SUM(`sc`.`outlet_aktif_digital`) / `ta`.`outlet_aktif_digital`) * 9) / 100),
                2)) + ROUND((((SUM(`sc`.`outlet_aktif_voucher`) / `ta`.`outlet_aktif_voucher`) * 5) / 100),
                2)) + ROUND((((SUM(`sc`.`outlet_aktif_bang_tcash`) / `ta`.`outlet_aktif_bang_tcash`) * 5) / 100),
                2)) + ROUND((((SUM(`sc`.`sales_perdana`) / `ta`.`sales_perdana`) * 3) / 100),
                2)) + ROUND((((SUM(`sc`.`nsb`) / `ta`.`nsb`) * 15) / 100),
                2)) + ROUND((((SUM(`sc`.`mkios_bulk`) / `ta`.`mkios_bulk`) * 25) / 100),
                2)) + ROUND((((SUM(`sc`.`gt_pulsa`) / `ta`.`gt_pulsa`) * 15) / 100),
                2)) + ROUND((((SUM(`sc`.`mkios_reguler`) / `ta`.`mkios_reguler`) * 20) / 100),
                2)) AS `total_kpi`
    FROM
        (((`db_telkomsel`.`tbl_marketing` `m`
        JOIN `db_telkomsel`.`tbl_target_assignment` `ta` ON ((`m`.`kode_marketing` = `ta`.`kode_marketing`)))
        JOIN `db_telkomsel`.`tbl_score_card` `sc` ON ((`m`.`kode_marketing` = `sc`.`kode_marketing`)))
        JOIN `db_telkomsel`.`tbl_tdc` `u` ON ((`m`.`kode_tdc` = `u`.`kode_tdc`)))
	WHERE ta.tanggal BETWEEN Awal AND Akhir AND sc.tanggal between Awal AND Akhir AND m.divisi = 'canvasser'
    GROUP BY u.kode_tdc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_collector_kpi` (`Awal` VARCHAR(20), `Akhir` VARCHAR(20))  BEGIN

SELECT 
	u.kode_tdc AS `kode_tdc`,
	u.nama_tdc AS `nama_tdc`,
    ta.tanggal AS `tanggal`,
	monthname(ta.tanggal) AS `bulan`,
    year(ta.tanggal) AS `tahun`,
    ROUND((sum(sc.new_rs_non_outlet)/ta.new_rs_non_outlet)*25/100,2) +
    ROUND((sum(sc.nsb)/ta.nsb)*25/100,2) ++
    ROUND((sum(sc.gt_pulsa)/ta.gt_pulsa)*25/100,2) +
    ROUND((sum(sc.collecting)/ta.collecting)*25/100,2) AS `total_kpi`
FROM tbl_marketing AS m 
INNER JOIN tbl_target_assignment_collector AS ta 
	ON m.kode_marketing = ta.kode_marketing
INNER JOIN tbl_score_card_collector AS sc 
	ON m.kode_marketing = sc.kode_marketing
INNER JOIN tbl_tdc AS u
	ON m.kode_tdc = u.kode_tdc
WHERE  ta.tanggal BETWEEN Awal AND Akhir AND sc.tanggal between Awal AND Akhir AND m.divisi = 'collector'
GROUP BY u.kode_tdc;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_canvasser_progress_kpi` (`Awal` VARCHAR(20), `Akhir` VARCHAR(20), `Kode` VARCHAR(20))  BEGIN
SELECT 
        u.nama_tdc AS `nama_tdc`,
        `ta`.`tanggal` AS `tanggal`,
        m.kode_marketing AS kode_marketing,
        m.nama_marketing AS nama_marketing,
        `m`.`kode_tdc` AS `kode_tdc`,
        `m`.`divisi` AS `divisi`,
        MONTHNAME(`ta`.`tanggal`) AS `bulan`,
        YEAR(`ta`.`tanggal`) AS `tahun`,
        ((((((((ROUND((((SUM(`sc`.`new_opening_outlet`) / `ta`.`new_opening_outlet`) * 3) / 100),
                2) + ROUND((((SUM(`sc`.`outlet_aktif_digital`) / `ta`.`outlet_aktif_digital`) * 9) / 100),
                2)) + ROUND((((SUM(`sc`.`outlet_aktif_voucher`) / `ta`.`outlet_aktif_voucher`) * 5) / 100),
                2)) + ROUND((((SUM(`sc`.`outlet_aktif_bang_tcash`) / `ta`.`outlet_aktif_bang_tcash`) * 5) / 100),
                2)) + ROUND((((SUM(`sc`.`sales_perdana`) / `ta`.`sales_perdana`) * 3) / 100),
                2)) + ROUND((((SUM(`sc`.`nsb`) / `ta`.`nsb`) * 15) / 100),
                2)) + ROUND((((SUM(`sc`.`mkios_bulk`) / `ta`.`mkios_bulk`) * 25) / 100),
                2)) + ROUND((((SUM(`sc`.`gt_pulsa`) / `ta`.`gt_pulsa`) * 15) / 100),
                2)) + ROUND((((SUM(`sc`.`mkios_reguler`) / `ta`.`mkios_reguler`) * 20) / 100),
                2)) AS `total_kpi`
    FROM
        (((`db_telkomsel`.`tbl_marketing` `m`
        JOIN `db_telkomsel`.`tbl_target_assignment` `ta` ON ((`m`.`kode_marketing` = `ta`.`kode_marketing`)))
        JOIN `db_telkomsel`.`tbl_score_card` `sc` ON ((`m`.`kode_marketing` = `sc`.`kode_marketing`)))
        JOIN `db_telkomsel`.`tbl_tdc` `u` ON ((`m`.`kode_tdc` = `u`.`kode_tdc`)))
	WHERE ta.tanggal BETWEEN Awal AND Akhir AND sc.tanggal between Awal AND Akhir AND m.kode_marketing = Kode
    GROUP BY monthname(ta.tanggal) ORDER BY ta.tanggal ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detail_ta` (`Id` CHAR(20))  BEGIN
SELECT 
		*
    FROM
        ((`db_telkomsel`.`tbl_target_assignment` `ta`
        LEFT JOIN `db_telkomsel`.`tbl_marketing` `m` ON ((`ta`.`kode_marketing` = `m`.`kode_marketing`)))
        LEFT JOIN `db_telkomsel`.`tbl_user` `u` ON ((`ta`.`kode_user` = `u`.`kode_user`)))
	WHERE `ta`.`id_target` = Id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detail_ta_collector` (`Kode` VARCHAR(20))  BEGIN
	SELECT 
        `ta`.`kode_user` AS `kode_user`,
        YEAR(`ta`.`tanggal`) AS `tahun`,
        MONTHNAME(`ta`.`tanggal`) AS `bulan`,
        `m`.`nama_marketing` AS `nama_marketing`,
        `ta`.`new_rs_non_outlet` AS `new_rs_non_outlet`,
        `ta`.`collecting` AS `collecting`,
        `ta`.`id_target` AS `id_target`
    FROM
        ((`db_telkomsel`.`tbl_target_assignment_collector` `ta`
        JOIN `db_telkomsel`.`tbl_marketing` `m` ON ((`ta`.`kode_marketing` = `m`.`kode_marketing`)))
        JOIN `db_telkomsel`.`tbl_tdc` `t` ON ((`m`.`kode_tdc` = `t`.`kode_tdc`)))
    WHERE
        (`m`.`divisi` = 'collector') AND t.kode_tdc = Kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_histori_pivot` (`Awal` DATE, `Akhir` DATE, `Kode` CHAR(20))  BEGIN
SELECT * FROM db_telkomsel.view_pivot WHERE (tanggal BETWEEN Awal AND Akhir) AND kode_tdc = Kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marketing` (`Divisi` VARCHAR(20), `Kode` VARCHAR(25))  BEGIN
	SELECT 
		u.kode_user,
        YEAR(`ta`.`tanggal`) AS `tahun`,
        MONTHNAME(`ta`.`tanggal`) AS `bulan`,
        `m`.`nama_marketing` AS `nama_marketing`,
        `m`.`divisi` AS `divisi`,
        (((`ta`.`new_opening_outlet` + `ta`.`outlet_aktif_digital`) + `ta`.`outlet_aktif_voucher`) + `ta`.`outlet_aktif_bang_tcash`) AS `jumlah_outlet`,
        `ta`.`id_target` AS `id_target`
    FROM
        ((`db_telkomsel`.`tbl_target_assignment` `ta`
        JOIN `db_telkomsel`.`tbl_marketing` `m` ON ((`ta`.`kode_marketing` = `m`.`kode_marketing`)))
        JOIN `db_telkomsel`.`tbl_user` `u` ON ((`ta`.`kode_user` = `u`.`kode_user`)))
    WHERE
        (`m`.`divisi` = Divisi) AND (`u`.`kode_tdc` = Kode);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sc_collector` (`Kode` VARCHAR(20))  BEGIN
SELECT 
        `sc`.`kode_user` AS `kode_user`,
        `sc`.`tanggal` AS 	`tanggal`,
        YEAR(`sc`.`tanggal`) AS `tahun`,
        MONTHNAME(`sc`.`tanggal`) AS `bulan`,
        `m`.`nama_marketing` AS `nama_marketing`,
        `sc`.`new_rs_non_outlet` AS `new_rs_non_outlet`,
        `sc`.`nsb` AS `nsb`,
        `sc`.`gt_pulsa` AS `gt_pulsa`,
        `sc`.`collecting` AS `collecting`,
        `sc`.`id_score_card` AS `id`
    FROM
        ((`db_telkomsel`.`tbl_score_card_collector` `sc`
        JOIN `db_telkomsel`.`tbl_marketing` `m` ON ((`sc`.`kode_marketing` = `m`.`kode_marketing`)))
        JOIN `db_telkomsel`.`tbl_tdc` `t` ON ((`m`.`kode_tdc` = `t`.`kode_tdc`)))
    WHERE
        (`m`.`divisi` = 'collector') AND t.kode_tdc = Kode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kpi_collector` (`Awal` VARCHAR(20), `Akhir` VARCHAR(20), `TDC` VARCHAR(20), `Divisi` VARCHAR(20))  BEGIN

SELECT 
	ta.tanggal AS `tanggal`,
    u.kode_tdc AS `kode_tdc`,
	monthname(ta.tanggal) AS `bulan`,
    year(ta.tanggal) AS `tahun`,
    m.kode_marketing AS `kode_marketing`,
    m.nama_marketing AS `nama_marketing`,
    ROUND((sum(sc.new_rs_non_outlet)/ta.new_rs_non_outlet)*25/100,2) +
    ROUND((sum(sc.nsb)/ta.nsb)*25/100,2) ++
    ROUND((sum(sc.gt_pulsa)/ta.gt_pulsa)*25/100,2) +
    ROUND((sum(sc.collecting)/ta.collecting)*25/100,2) AS `total_kpi`
FROM tbl_marketing AS m 
INNER JOIN tbl_target_assignment_collector AS ta 
	ON m.kode_marketing = ta.kode_marketing
INNER JOIN tbl_score_card_collector AS sc 
	ON m.kode_marketing = sc.kode_marketing
INNER JOIN tbl_user AS u
	ON m.kode_tdc = u.kode_tdc
WHERE  ta.tanggal BETWEEN Awal AND Akhir AND sc.tanggal between Awal AND Akhir AND m.kode_tdc = TDC AND m.divisi = Divisi
GROUP BY sc.kode_marketing;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kpi_petugas` (`Awal` VARCHAR(20), `Akhir` VARCHAR(20), `TDC` CHAR(20), `Divisi` VARCHAR(20))  BEGIN

SELECT 
        `ta`.`tanggal` AS `tanggal`,
        `m`.`kode_tdc` AS `kode_tdc`,
        `m`.`divisi` AS `divisi`,
        MONTHNAME(`ta`.`tanggal`) AS `bulan`,
        YEAR(`ta`.`tanggal`) AS `tahun`,
        `m`.`kode_marketing` AS `kode_marketing`,
        `m`.`nama_marketing` AS `nama_marketing`,
        ((((((((ROUND((((SUM(`sc`.`new_opening_outlet`) / `ta`.`new_opening_outlet`) * 3) / 100),
                2) + ROUND((((SUM(`sc`.`outlet_aktif_digital`) / `ta`.`outlet_aktif_digital`) * 9) / 100),
                2)) + ROUND((((SUM(`sc`.`outlet_aktif_voucher`) / `ta`.`outlet_aktif_voucher`) * 5) / 100),
                2)) + ROUND((((SUM(`sc`.`outlet_aktif_bang_tcash`) / `ta`.`outlet_aktif_bang_tcash`) * 5) / 100),
                2)) + ROUND((((SUM(`sc`.`sales_perdana`) / `ta`.`sales_perdana`) * 3) / 100),
                2)) + ROUND((((SUM(`sc`.`nsb`) / `ta`.`nsb`) * 15) / 100),
                2)) + ROUND((((SUM(`sc`.`mkios_bulk`) / `ta`.`mkios_bulk`) * 25) / 100),
                2)) + ROUND((((SUM(`sc`.`gt_pulsa`) / `ta`.`gt_pulsa`) * 15) / 100),
                2)) + ROUND((((SUM(`sc`.`mkios_reguler`) / `ta`.`mkios_reguler`) * 20) / 100),
                2)) AS `total_kpi`
    FROM
        (((`db_telkomsel`.`tbl_marketing` `m`
        JOIN `db_telkomsel`.`tbl_target_assignment` `ta` ON ((`m`.`kode_marketing` = `ta`.`kode_marketing`)))
        JOIN `db_telkomsel`.`tbl_score_card` `sc` ON ((`m`.`kode_marketing` = `sc`.`kode_marketing`)))
        JOIN `db_telkomsel`.`tbl_user` `u` ON ((`m`.`kode_tdc` = `u`.`kode_tdc`)))
	WHERE ta.tanggal BETWEEN Awal AND Akhir AND sc.tanggal between Awal AND Akhir AND m.kode_tdc = TDC AND m.divisi = Divisi
    GROUP BY `sc`.`kode_marketing`;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `performance` (`Nama` VARCHAR(30), `Bulan` VARCHAR(30))  BEGIN

SELECT 
	monthname(ta.tanggal) AS `bulan`,
    year(ta.tanggal) AS `tahun`,
    m.nama_marketing AS `nama_marketing`,
    m.kode_marketing AS `kode_marketing`,
    ROUND((sum(sc.new_opening_outlet)/ta.new_opening_outlet*100),2) AS `new_opening_outlet`,
    ROUND((sum(sc.outlet_aktif_digital)/ta.outlet_aktif_digital*100),2) AS `outlet_aktif_digital`,
    ROUND((sum(sc.outlet_aktif_voucher)/ta.outlet_aktif_voucher*100),2) AS `outlet_aktif_voucher`,
    ROUND((sum(sc.outlet_aktif_bang_tcash)/ta.outlet_aktif_bang_tcash*100),2) AS `outlet_aktif_bang_tcash`,
    ROUND((sum(sc.sales_perdana)/ta.sales_perdana*100),2) AS `sales_perdana`,
    ROUND((sum(sc.nsb)/ta.nsb*100),2) AS `nsb`,
    ROUND((sum(sc.mkios_bulk)/ta.mkios_bulk*100),2) AS `mkios_bulk`,
    ROUND((sum(sc.gt_pulsa)/ta.gt_pulsa*100),2) AS `gt_pulsa`,
    ROUND((sum(sc.mkios_reguler)/ta.mkios_reguler*100),2) AS `mkios_reguler`
FROM tbl_marketing AS m 
INNER JOIN tbl_target_assignment AS ta 
	ON m.kode_marketing = ta.kode_marketing
INNER JOIN tbl_score_card AS sc 
	ON m.kode_marketing = sc.kode_marketing
WHERE monthname(sc.tanggal) = Bulan and monthname(sc.tanggal) = Bulan and monthname(ta.tanggal) = Bulan and monthname(ta.tanggal) = Bulan and m.kode_marketing = Nama;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `performance_collector` (`Kode` VARCHAR(30), `Bulan` VARCHAR(20))  BEGIN

SELECT 
	monthname(ta.tanggal) AS `bulan`,
    year(ta.tanggal) AS `tahun`,
    m.nama_marketing AS `nama_marketing`,
    m.kode_marketing AS `kode_marketing`,
    ROUND((sum(sc.new_rs_non_outlet)/ta.new_rs_non_outlet*100),2) AS `new_rs_non_outlet`,
    ROUND((sum(sc.nsb)/ta.nsb*100),2) AS `nsb`,
    ROUND((sum(sc.gt_pulsa)/ta.gt_pulsa*100),2) AS `gt_pulsa`,
    ROUND((sum(sc.collecting)/ta.collecting*100),2) AS `collecting`
FROM tbl_marketing AS m 
INNER JOIN tbl_target_assignment_collector AS ta 
	ON m.kode_marketing = ta.kode_marketing
INNER JOIN tbl_score_card_collector AS sc 
	ON m.kode_marketing = sc.kode_marketing
WHERE monthname(sc.tanggal) = Bulan and monthname(ta.tanggal) = Bulan and m.kode_marketing = Kode;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pivot_histori` (`Awal` DATE, `Akhir` DATE)  BEGIN
SELECT
	monthname(ho.tanggal) AS `bulan`, m.nama_marketing, o.nama_outlet, ho.`as`,
    ho.simpati, ho.`loop`, ho.nsb, ho.mkios_reguler, ho.mkios_bulk, ho.gt_pulsa
FROM tbl_histori_order AS ho
INNER JOIN tbl_marketing AS m ON ho.kode_marketing = m.kode_marketing
INNER JOIN tbl_outlet AS o ON ho.id_outlet = o.id_outlet
WHERE ho.tanggal BETWEEN Awal AND Akhir;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `images_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '1=Active, 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `images_name`, `uploaded_on`, `status`) VALUES
(1, '5c8673ed3129a.jpg', '2019-03-11 14:42:53', '1'),
(2, '5c8673ed49e92.jpg', '2019-03-11 14:42:53', '1'),
(3, '5c8673ed514e0.jpg', '2019-03-11 14:42:53', '1'),
(4, '5c8675f08447c.jpg', '2019-03-11 14:51:28', '1'),
(5, '5c8675f0a605e.jpg', '2019-03-11 14:51:28', '1'),
(6, '5c8675f0ab2d5.jpg', '2019-03-11 14:51:28', '1'),
(7, '5c8675f0b056a.jpg', '2019-03-11 14:51:28', '1'),
(8, '5c8675f0b4843.jpg', '2019-03-11 14:51:28', '1'),
(9, '5c867651a64c0.jpg', '2019-03-11 14:53:05', '1'),
(10, '5c867651accc2.jpg', '2019-03-11 14:53:05', '1'),
(11, '5c867651b23bf.jpg', '2019-03-11 14:53:05', '1'),
(12, '5c867651b7f63.jpg', '2019-03-11 14:53:05', '1'),
(13, '5c867651c14b5.jpg', '2019-03-11 14:53:05', '1'),
(14, '5c8677ad1ce43.jpg', '2019-03-11 14:58:53', '1'),
(15, '5c8677ad220e8.jpg', '2019-03-11 14:58:53', '1'),
(16, '5c8677ad2863f.jpg', '2019-03-11 14:58:53', '1'),
(17, '5c8677ad317ff.jpg', '2019-03-11 14:58:53', '1'),
(18, 'outlet_5c86790380139.jpg', '2019-03-11 15:04:35', '1'),
(19, 'outlet_5c8679038799e.jpg', '2019-03-11 15:04:35', '1'),
(20, 'OT020_5c867d715a44c.jpg', '2019-03-11 15:23:29', '1'),
(21, 'OT020_5c867d715f17a.jpg', '2019-03-11 15:23:29', '1'),
(22, 'OT020_5c867d716a983.jpg', '2019-03-11 15:23:29', '1'),
(23, 'OT020_5c867d717cac8.png', '2019-03-11 15:23:29', '1'),
(24, 'OT020_5c867d718164d.jpg', '2019-03-11 15:23:29', '1'),
(25, 'OT020_5c867d718b3e4.jpg', '2019-03-11 15:23:29', '1'),
(26, 'OT020_5c867d71946ff.jpg', '2019-03-11 15:23:29', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_downline_gt`
--

CREATE TABLE `tbl_downline_gt` (
  `id_downline_gt` char(20) NOT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `divisi` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_marketing` char(20) DEFAULT NULL,
  `nama_downline` varchar(200) DEFAULT NULL,
  `alamat_gt` varchar(200) DEFAULT NULL,
  `nomor_gt` varchar(100) DEFAULT NULL,
  `deposit` double DEFAULT '0',
  `foto` longtext,
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_downline_gt`
--

INSERT INTO `tbl_downline_gt` (`id_downline_gt`, `kode_tdc`, `divisi`, `tanggal`, `kode_marketing`, `nama_downline`, `alamat_gt`, `nomor_gt`, `deposit`, `foto`, `kode_user`) VALUES
('002', '007', 'INDIRECT', '2019-05-21', '075', 'BRAD', 'LEDLEELED', '98746', 25000, '[{\"file_name\":\"GT_5ccac954ccda4.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/GT_5ccac954ccda4.jpg\",\"raw_name\":\"GT_5ccac954ccda4\",\"orig_name\":\"GT_5ccac954ccda4.jpg\",\"client_name\":\"0f44a3bcf32081e4b1132604523b2ab56bcd94aa09a3b5d7a3087045c2175060 1.jpg\",\"file_ext\":\".jpg\",\"file_size\":466.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"GT_5ccac954d1e51.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/GT_5ccac954d1e51.jpg\",\"raw_name\":\"GT_5ccac954d1e51\",\"orig_name\":\"GT_5ccac954d1e51.jpg\",\"client_name\":\"1c94b60a51c9f57349113c31402ce4e5d1397e1c0ce5fa69581018ca38de1541.jpg\",\"file_ext\":\".jpg\",\"file_size\":480.83,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"GT_5ccac954db82b.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/GT_5ccac954db82b.jpg\",\"raw_name\":\"GT_5ccac954db82b\",\"orig_name\":\"GT_5ccac954db82b.jpg\",\"client_name\":\"1cd011187c0a00cc9bc822c670e95bc0c0ec28741d1b2ad20cb279082cfb48b4 - Copy.jpg\",\"file_ext\":\".jpg\",\"file_size\":1941.99,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', '013'),
('111', '007', 'DIRECT', '2019-01-01', '016', 'RIAN', 'JL PULAI LEGUNDI', '777777', 2300000, '', 'L342r'),
('12', '009', 'COLLECTOR', '0000-00-00', '002', 'RIAN', 'JL CHUI PAT KAI NO 3', '3234234342', 29500, '[{\"file_name\":\"GT_5ccbd7bbd2111.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/GT_5ccbd7bbd2111.jpg\",\"raw_name\":\"GT_5ccbd7bbd2111\",\"orig_name\":\"GT_5ccbd7bbd2111.jpg\",\"client_name\":\"1c94b60a51c9f57349113c31402ce4e5d1397e1c0ce5fa69581018ca38de1541.jpg\",\"file_ext\":\".jpg\",\"file_size\":480.83,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"GT_5ccbd7bc0be50.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/downlinegt\\/GT_5ccbd7bc0be50.jpg\",\"raw_name\":\"GT_5ccbd7bc0be50\",\"orig_name\":\"GT_5ccbd7bc0be50.jpg\",\"client_name\":\"1cd011187c0a00cc9bc822c670e95bc0c0ec28741d1b2ad20cb279082cfb48b4 - Copy.jpg\",\"file_ext\":\".jpg\",\"file_size\":1941.99,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', 'L342r');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `id_event` int(11) NOT NULL,
  `kode_tdc` char(10) DEFAULT NULL,
  `divisi` varchar(100) DEFAULT NULL,
  `tgl_event` date DEFAULT NULL,
  `kode_marketing` char(20) DEFAULT NULL,
  `nama_event` varchar(200) DEFAULT NULL,
  `lokasi_penjualan` varchar(200) DEFAULT NULL,
  `qty_5k` int(11) DEFAULT '0',
  `qty_10k` int(11) DEFAULT '0',
  `qty_20k` int(11) DEFAULT '0',
  `qty_25k` int(11) DEFAULT '0',
  `qty_50k` int(11) DEFAULT '0',
  `qty_100k` int(11) DEFAULT '0',
  `mount_bulk` double DEFAULT '0',
  `mount_legacy` double DEFAULT '0',
  `mount_digital` double DEFAULT '0',
  `mount_tcash` double DEFAULT '0',
  `qty_low_nsb` int(11) DEFAULT '0',
  `qty_middle_nsb` int(11) DEFAULT '0',
  `qty_high_nsb` int(11) DEFAULT '0',
  `qty_as_nsb` int(11) DEFAULT '0',
  `qty_simpati_nsb` int(11) DEFAULT '0',
  `qty_loop_nsb` int(11) DEFAULT '0',
  `foto_kegiatan` longtext,
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`id_event`, `kode_tdc`, `divisi`, `tgl_event`, `kode_marketing`, `nama_event`, `lokasi_penjualan`, `qty_5k`, `qty_10k`, `qty_20k`, `qty_25k`, `qty_50k`, `qty_100k`, `mount_bulk`, `mount_legacy`, `mount_digital`, `mount_tcash`, `qty_low_nsb`, `qty_middle_nsb`, `qty_high_nsb`, `qty_as_nsb`, `qty_simpati_nsb`, `qty_loop_nsb`, `foto_kegiatan`, `kode_user`) VALUES
(3, '007', 'INDIRECT', '2019-04-02', '003', 'TELL HER', 'CHICAGO', 464, 9999, 999, 9999, 88888, 8888, 9999, 4654654, 99999, 32423, 9999, 6546, 9999, 546546546, 546546, 54654654, '5cc0b63fb02b0.jpg', 'L342r'),
(5, 'TDC', 'DIRECT', '2019-04-10', '018', 'CITY LOSS', 'KEDATON', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 4500000, 45000000, 5500000, 53000, 34000, 66000, 89000, 43000, 34000, '5cc0b661a64e2.jpg', '007'),
(6, 'TDC002', 'DIRECT', '2019-04-03', '020', 'HYUNG', 'ENGGAL', 40000, 40000, 40000, 50000, 60000, 80000, 3400000, 3400000, 6600000, 6200000, 600000, 300000, 700000, 320000, 600000, 400000, '[{\"file_name\":\"EVENT_5cc50f91c1a40.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5cc50f91c1a40.jpg\",\"raw_name\":\"EVENT_5cc50f91c1a40\",\"orig_name\":\"EVENT_5cc50f91c1a40.jpg\",\"client_name\":\"0f44a3bcf32081e4b1132604523b2ab56bcd94aa09a3b5d7a3087045c2175060 1.jpg\",\"file_ext\":\".jpg\",\"file_size\":466.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"EVENT_5cc50f91e64c6.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5cc50f91e64c6.jpg\",\"raw_name\":\"EVENT_5cc50f91e64c6\",\"orig_name\":\"EVENT_5cc50f91e64c6.jpg\",\"client_name\":\"1c94b60a51c9f57349113c31402ce4e5d1397e1c0ce5fa69581018ca38de1541.jpg\",\"file_ext\":\".jpg\",\"file_size\":480.83,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"EVENT_5cc50f91ef46f.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5cc50f91ef46f.jpg\",\"raw_name\":\"EVENT_5cc50f91ef46f\",\"orig_name\":\"EVENT_5cc50f91ef46f.jpg\",\"client_name\":\"1cd011187c0a00cc9bc822c670e95bc0c0ec28741d1b2ad20cb279082cfb48b4.jpg\",\"file_ext\":\".jpg\",\"file_size\":1941.99,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', '007'),
(7, '003', 'DIRECT', '2019-05-24', '001', 'CITY LOSS', 'ENGGAL', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 4500000, 45000000, 5500000, 53000, 34000, 66000, 89000, 43000, 34000, 'NULL', '007'),
(8, '004', 'DIRECT', '2019-05-24', '002', 'CITY LOSS', 'KEDATON', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 4500000, 45000000, 5500000, 53000, 34000, 66000, 89000, 43000, 34000, 'NULL', '007'),
(9, '007', 'DIRE', '2019-05-11', '900', 'BERBAGI TAKJIL', 'KEDATON', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 4500000, 45000000, 5500000, 53000, 3000, 66000, 89000, 43000, 34000, '[{\"file_name\":\"EVENT_5ce4ab5e8bd8b.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5ce4ab5e8bd8b.jpg\",\"raw_name\":\"EVENT_5ce4ab5e8bd8b\",\"orig_name\":\"EVENT_5ce4ab5e8bd8b.jpg\",\"client_name\":\"2d31d5b4b142e2aef348b9f94dd1cd34095e97e0a9b1379fd73f93b70852693c.jpg\",\"file_ext\":\".jpg\",\"file_size\":412.07,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"EVENT_5ce4ab5e90f2d.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5ce4ab5e90f2d.jpg\",\"raw_name\":\"EVENT_5ce4ab5e90f2d\",\"orig_name\":\"EVENT_5ce4ab5e90f2d.jpg\",\"client_name\":\"390ea247846db88a039e5f268d52ef095ad4e3cea65aa1a1fc852aa49f585c57 1.jpg\",\"file_ext\":\".jpg\",\"file_size\":454.93,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"EVENT_5ce4ab5e9564c.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5ce4ab5e9564c.jpg\",\"raw_name\":\"EVENT_5ce4ab5e9564c\",\"orig_name\":\"EVENT_5ce4ab5e9564c.jpg\",\"client_name\":\"0415e4eca9ec46c9c574504969ea9bf12aeaf46e36f58d1ebd7308be15838edf.jpg\",\"file_ext\":\".jpg\",\"file_size\":1123.31,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', '007'),
(11, '007', 'DIRECT', '2019-05-14', '014', 'BERBUKA BERSAMA', 'KEDATON', 4000, 70000, 32000, 80000, 30000, 100000, 48000000, 4500000, 45000000, 5500000, 53000, 34000, 66000, 89000, 43000, 34000, 'NULL', '007'),
(13, '007', 'CANVASSER', '1922-03-23', '017', 'SANTUNAN', 'ENGGAL', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 4500000, 45000000, 5500000, 53000, 34000, 66000, 89000, 43000, 34000, '[{\"file_name\":\"EVENT_5ce4aa929ff29.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5ce4aa929ff29.jpg\",\"raw_name\":\"EVENT_5ce4aa929ff29\",\"orig_name\":\"EVENT_5ce4aa929ff29.jpg\",\"client_name\":\"392edf8b98da8bb2a7b83b8721b3ac48fffcba79102c54abf585566601477301.jpg\",\"file_ext\":\".jpg\",\"file_size\":454.27,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"EVENT_5ce4aa92a4098.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5ce4aa92a4098.jpg\",\"raw_name\":\"EVENT_5ce4aa92a4098\",\"orig_name\":\"EVENT_5ce4aa92a4098.jpg\",\"client_name\":\"0415e4eca9ec46c9c574504969ea9bf12aeaf46e36f58d1ebd7308be15838edf.jpg\",\"file_ext\":\".jpg\",\"file_size\":1123.31,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', '007'),
(14, '002', 'DIRECT', '2019-05-23', 'CAN004', 'BERBAGI TAKJIL', 'BUNDERAN GAJAH', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 4500000, 45000000, 5500000, 53000, 34000, 66000, 89000, 43000, 34000, '[{\"file_name\":\"EVENT_5ce4c5603fddc.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5ce4c5603fddc.jpg\",\"raw_name\":\"EVENT_5ce4c5603fddc\",\"orig_name\":\"EVENT_5ce4c5603fddc.jpg\",\"client_name\":\"0c3a6aa609378574472c55c9d6cdda192d94032c21e2174d4f861286ed9de2a9.jpg\",\"file_ext\":\".jpg\",\"file_size\":1208.79,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"EVENT_5ce4c56073dea.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/event\\/EVENT_5ce4c56073dea.jpg\",\"raw_name\":\"EVENT_5ce4c56073dea\",\"orig_name\":\"EVENT_5ce4c56073dea.jpg\",\"client_name\":\"1cd011187c0a00cc9bc822c670e95bc0c0ec28741d1b2ad20cb279082cfb48b4 - Copy.jpg\",\"file_ext\":\".jpg\",\"file_size\":1941.99,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', '002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foto_saleling`
--

CREATE TABLE `tbl_foto_saleling` (
  `id_saleling` int(11) NOT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `divisi` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_marketing` char(20) DEFAULT NULL,
  `lokasi_saleling` varchar(100) DEFAULT NULL,
  `foto_kegiatan` longtext,
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_foto_saleling`
--

INSERT INTO `tbl_foto_saleling` (`id_saleling`, `kode_tdc`, `divisi`, `tanggal`, `kode_marketing`, `lokasi_saleling`, `foto_kegiatan`, `kode_user`) VALUES
(7, '009', 'DIRECT', '0000-00-00', '011', 'bandar lampung', '[{\"file_name\":\"SALELING_5cca6e3e68c57.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5c', '007'),
(8, '007', 'DIRECT', '2019-02-05', '016', 'sukarame', '[{\"file_name\":\"SALELING_5ce3a5934f3fa.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5ce3a5934f3fa.jpg\",\"raw_name\":\"SALELING_5ce3a5934f3fa\",\"orig_name\":\"SALELING_5ce3a5934f3fa.jpg\",\"client_name\":\"cf68fd432353dbc4c5c5070c7b7c321545a9f624eca354f8d4b348b4f84ea935.jpg\",\"file_ext\":\".jpg\",\"file_size\":1231.38,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"SALELING_5ce3a5936d895.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5ce3a5936d895.jpg\",\"raw_name\":\"SALELING_5ce3a5936d895\",\"orig_name\":\"SALELING_5ce3a5936d895.jpg\",\"client_name\":\"d0d1d75d48fd6d5e2c06c89c46120df79b2b45eca1d24f410596dca764a50f9a.jpg\",\"file_ext\":\".jpg\",\"file_size\":453.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"SALELING_5ce3a5937370b.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5ce3a5937370b.jpg\",\"raw_name\":\"SALELING_5ce3a5937370b\",\"orig_name\":\"SALELING_5ce3a5937370b.jpg\",\"client_name\":\"d9ffc7b3824f393a918fe0f427c037ab1963edeff9ae9acd47b744e402e92280 (2).jpg\",\"file_ext\":\".jpg\",\"file_size\":590.01,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', '007'),
(9, '002', 'DIRECT', '2019-05-13', '002', 'bandar lampung', '[{\"file_name\":\"SALELING_5cd924a4b69bb.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5cd924a4b69bb.jpg\",\"raw_name\":\"SALELING_5cd924a4b69bb\",\"orig_name\":\"SALELING_5cd924a4b69bb.jpg\",\"client_name\":\"1c94b60a51c9f57349113c31402ce4e5d1397e1c0ce5fa69581018ca38de1541.jpg\",\"file_ext\":\".jpg\",\"file_size\":480.83,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"SALELING_5cd924a4d3f33.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5cd924a4d3f33.jpg\",\"raw_name\":\"SALELING_5cd924a4d3f33\",\"orig_name\":\"SALELING_5cd924a4d3f33.jpg\",\"client_name\":\"1cd011187c0a00cc9bc822c670e95bc0c0ec28741d1b2ad20cb279082cfb48b4 - Copy.jpg\",\"file_ext\":\".jpg\",\"file_size\":1941.99,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', '007'),
(10, '007', 'INDIRECT', '2019-03-21', '012', 'sukabumi', '[{\"file_name\":\"SALELING_5cd925fe8a6c6.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5cd925fe8a6c6.jpg\",\"raw_name\":\"SALELING_5cd925fe8a6c6\",\"orig_name\":\"SALELING_5cd925fe8a6c6.jpg\",\"client_name\":\"1c94b60a51c9f57349113c31402ce4e5d1397e1c0ce5fa69581018ca38de1541.jpg\",\"file_ext\":\".jpg\",\"file_size\":480.83,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"SALELING_5cd925fe90e8b.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5cd925fe90e8b.jpg\",\"raw_name\":\"SALELING_5cd925fe90e8b\",\"orig_name\":\"SALELING_5cd925fe90e8b.jpg\",\"client_name\":\"02f3a5ec4bce7076943714353c74a42e0b090103db1dc5a768aabddaf1e07534 1.jpg\",\"file_ext\":\".jpg\",\"file_size\":477.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"SALELING_5cd925fe95cfb.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5cd925fe95cfb.jpg\",\"raw_name\":\"SALELING_5cd925fe95cfb\",\"orig_name\":\"SALELING_5cd925fe95cfb.jpg\",\"client_name\":\"02f3a5ec4bce7076943714353c74a42e0b090103db1dc5a768aabddaf1e07534.jpg\",\"file_ext\":\".jpg\",\"file_size\":477.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', '007'),
(11, '007', 'collector', '2019-01-01', '014', 'BAWEAN', '[{\"file_name\":\"SALELING_5ce274edc4e22.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5ce274edc4e22.jpg\",\"raw_name\":\"SALELING_5ce274edc4e22\",\"orig_name\":\"SALELING_5ce274edc4e22.jpg\",\"client_name\":\"b1849084c884515b8c16c5bcb13d3cf3864a47fe9b3ac0fbe9b796f92b48b8ba.jpg\",\"file_ext\":\".jpg\",\"file_size\":485.24,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"SALELING_5ce274edc9570.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/saleling\\/SALELING_5ce274edc9570.jpg\",\"raw_name\":\"SALELING_5ce274edc9570\",\"orig_name\":\"SALELING_5ce274edc9570.jpg\",\"client_name\":\"c4747aba2b1d08a4ae6c6db06fe5eac74511fbe421e7243eaa5e480db03bf5d9.jpg\",\"file_ext\":\".jpg\",\"file_size\":477.45,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', '007');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galeri`
--

CREATE TABLE `tbl_galeri` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `foto` longtext NOT NULL,
  `kode_user` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_galeri`
--

INSERT INTO `tbl_galeri` (`id`, `tanggal`, `keterangan`, `foto`, `kode_user`) VALUES
(4, '2019-04-17', 'BC & TANDEM', 'BC_TANDEM_5ca409c575c17.jpg', 'IND013'),
(5, '2019-04-17', 'BC & TANDEM', 'BC_TANDEM_5ca409c58bbdb.jpg', 'IND013'),
(6, '2019-04-17', 'BC & TANDEM', 'BC_TANDEM_5ca409c59e1cd.jpg', 'IND013'),
(7, '2019-04-22', 'BRANDING OUTLET', 'BRANDING_OUTLET_5ca41242afcc3.jpg', 'IND013'),
(9, '2019-04-02', 'INFO KOMPETITOR', 'INFO_KOMPETITOR_5ca413ed51498.jpg', 'IND013'),
(11, '2019-04-17', 'INFO KOMPETITOR', 'INFO_KOMPETITOR_5ca417bc32237.jpeg', 'IND013'),
(12, '2019-04-17', 'INFO KOMPETITOR', 'INFO_KOMPETITOR_5ca417bc50043.jpeg', 'IND013'),
(13, '2019-04-17', 'INFO KOMPETITOR', 'INFO_KOMPETITOR_5ca417bc689e5.jpeg', 'IND013'),
(14, '2019-04-17', 'INFO KOMPETITOR', 'INFO_KOMPETITOR_5ca417bc7c839.jpeg', 'IND013'),
(15, '2019-04-24', 'BRANDING OUTLET', 'BRANDING_OUTLET_5ca4590db9c43.jpeg', 'IND013'),
(16, '2019-04-24', 'BRANDING OUTLET', 'BRANDING_OUTLET_5ca4590e345fd.jpeg', 'IND013'),
(17, '2019-04-24', 'BRANDING OUTLET', 'BRANDING_OUTLET_5ca4590e4caf2.jpeg', 'IND013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_histori_order`
--

CREATE TABLE `tbl_histori_order` (
  `id_histori_order` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_marketing` char(11) DEFAULT NULL,
  `id_outlet` char(20) DEFAULT NULL,
  `as` int(11) DEFAULT '0',
  `simpati` int(11) DEFAULT '0',
  `loop` int(11) DEFAULT '0',
  `nsb` int(11) DEFAULT '0',
  `mkios_reguler` int(11) DEFAULT '0',
  `mkios_bulk` int(11) DEFAULT '0',
  `gt_pulsa` int(11) DEFAULT '0',
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_histori_order`
--

INSERT INTO `tbl_histori_order` (`id_histori_order`, `tanggal`, `kode_marketing`, `id_outlet`, `as`, `simpati`, `loop`, `nsb`, `mkios_reguler`, `mkios_bulk`, `gt_pulsa`, `kode_user`) VALUES
(1, '2019-01-02', '001', 'out990', 78, 78, 78, 55, 77, 44, 77, '002'),
(2, '2019-01-13', '012', 'out990', 55, 77, 44, 87, 45, 76, 45, '002'),
(6, '2019-01-03', '003', '013', 67, 45, 45, 76, 67, 45, 34, '013'),
(10, '2019-02-03', 'mark002', 'out990', 54, 65, 32, 45, 45, 45, 23, '002'),
(11, '2019-02-05', '002', '089', 64, 78, 46, 88, 54, 67, 45, '013'),
(12, '2019-03-01', '003', '009', 67, 34, 34, 34, 67, 66, 43, '005'),
(14, '2019-03-02', '003', '013', 45, 77, 34, 55, 76, 23, 89, '002'),
(15, '2019-04-03', '002', '013', 89, 56, 53, 24, 87, 42, 68, '002'),
(16, '2019-03-13', 'ZAR001', '009', 12, 12, 14, 42, 42, 12, 54, '002'),
(18, '2019-03-04', 'CAn002', 'OT007', 300000, 200000, 400000, 320000, 320000, 900000, 999000, 'IND013'),
(19, '2019-03-05', 'CAN003', 'OT009', 32000, 340000, 3330000, 3200000, 3300000, 2900000, 2100000, 'IND013'),
(20, '2019-03-05', 'CAN004', 'OT009', 890000, 420000, 2200000, 1200000, 2200000, 3400000, 2100000, 'IND013'),
(21, '2019-03-06', 'COL001', 'OT007', 210000, 2100000, 410000, 2100000, 3100000, 220000, 4100000, 'IND013'),
(22, '2019-04-01', 'COL002', 'ot001', 40000, 50000, 20000, 30000, 50000, 30000, 50000, 'IND013'),
(23, '2019-03-27', 'COL002', 'OT005', 8000, 4000, 5000, 20000, 30003, 50000, 40000, 'IND013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hvc`
--

CREATE TABLE `tbl_hvc` (
  `id_hvc` int(11) NOT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `tgl_hvc` date DEFAULT NULL,
  `kode_marketing` char(20) DEFAULT NULL,
  `nama_mercent` varchar(100) DEFAULT NULL,
  `longlat_lokasi_mercent` varchar(50) DEFAULT NULL,
  `latitude_lokasi_mercent` varchar(50) DEFAULT NULL,
  `alamat_hvc` varchar(100) DEFAULT NULL,
  `qty_5k` int(11) DEFAULT '0',
  `qty_10k` int(11) DEFAULT '0',
  `qty_20k` int(11) DEFAULT '0',
  `qty_25k` int(11) DEFAULT '0',
  `qty_50k` int(11) DEFAULT '0',
  `qty_100k` int(11) DEFAULT '0',
  `mount_bulk` double DEFAULT '0',
  `qty_low_nsb` int(11) DEFAULT '0',
  `qty_middle_nsb` int(11) DEFAULT '0',
  `qty_high_nsb` int(11) DEFAULT '0',
  `qty_as_nsb` int(11) DEFAULT '0',
  `qty_simpati_nsb` int(11) NOT NULL,
  `qty_loop_nsb` int(11) DEFAULT '0',
  `foto_kegiatan` longtext,
  `keterangan_kegiatan` varchar(100) DEFAULT NULL,
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_hvc`
--

INSERT INTO `tbl_hvc` (`id_hvc`, `kode_tdc`, `tgl_hvc`, `kode_marketing`, `nama_mercent`, `longlat_lokasi_mercent`, `latitude_lokasi_mercent`, `alamat_hvc`, `qty_5k`, `qty_10k`, `qty_20k`, `qty_25k`, `qty_50k`, `qty_100k`, `mount_bulk`, `qty_low_nsb`, `qty_middle_nsb`, `qty_high_nsb`, `qty_as_nsb`, `qty_simpati_nsb`, `qty_loop_nsb`, `foto_kegiatan`, `keterangan_kegiatan`, `kode_user`) VALUES
(1, '007', '2019-05-21', '002', 'RIMURU', '1684131', '56416843', 'JL. ETAN', 464, 9999, 999, 54546, 46, 546, 465, 9999, 6546, 9999, 546546546, 0, 54654654, '[{\"file_name\":\"HVC_5ce3ae6c2aff6.JPG\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ce3ae6c2aff6.JPG\",\"raw_name\":\"HVC_5ce3ae6c2aff6\",\"orig_name\":\"HVC_5ce3ae6c2aff6.JPG\",\"client_name\":\"9bd0b59b87ae036fd1be29d98e42fc87ee9b096f97f4a002b766a85b3b596450.JPG\",\"file_ext\":\".JPG\",\"file_size\":472.94,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"HVC_5ce3ae6c457ad.JPG\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ce3ae6c457ad.JPG\",\"raw_name\":\"HVC_5ce3ae6c457ad\",\"orig_name\":\"HVC_5ce3ae6c457ad.JPG\",\"client_name\":\"9d3d5f4b786f804a35fcaf6dfec8e4799d677372ac75ca12a208a04136a16cd2.JPG\",\"file_ext\":\".JPG\",\"file_size\":451.76,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', 'GOOD', '002'),
(2, '007', '2019-02-05', '002', 'ANIKI', '32423423', '43242343', 'JL HANOMAN  NO 55', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 53000, 34000, 66000, 89000, 43000, 34000, '[{\"file_name\":\"HVC_5ccaed8bafac9.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ccaed8bafac9.jpg\",\"raw_name\":\"HVC_5ccaed8bafac9\",\"orig_name\":\"HVC_5ccaed8bafac9.jpg\",\"client_name\":\"61cffc5ec2bad4ee075cb4b878a9f700bfc23527a6ffedb89eda68a9084c8c70.jpg\",\"file_ext\":\".jpg\",\"file_size\":469.67,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"HVC_5ccaed8c0ed16.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ccaed8c0ed16.jpg\",\"raw_name\":\"HVC_5ccaed8c0ed16\",\"orig_name\":\"HVC_5ccaed8c0ed16.jpg\",\"client_name\":\"67f2b016e59637e2fa4b6d23f00c19e2a87a3833578ebd8d592052381f59832f.jpg\",\"file_ext\":\".jpg\",\"file_size\":1030.68,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"HVC_5ccaed8c212c7.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ccaed8c212c7.jpg\",\"raw_name\":\"HVC_5ccaed8c212c7\",\"orig_name\":\"HVC_5ccaed8c212c7.jpg\",\"client_name\":\"74b77bf453ffffcbf203e187ac54bcfebec9756a3cf38cc16569af75d700bb42.jpg\",\"file_ext\":\".jpg\",\"file_size\":556.55,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', 'RUTIN', '007'),
(3, '003', '2019-05-17', '001', 'LOBO', '32423423', '43242343', 'JL. HAMBALI NO 33324', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 53000, 34000, 66000, 89000, 43000, 34000, '[{\"file_name\":\"HVC_5ccbe49774e87.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ccbe49774e87.jpg\",\"raw_name\":\"HVC_5ccbe49774e87\",\"orig_name\":\"HVC_5ccbe49774e87.jpg\",\"client_name\":\"1c94b60a51c9f57349113c31402ce4e5d1397e1c0ce5fa69581018ca38de1541.jpg\",\"file_ext\":\".jpg\",\"file_size\":480.83,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"HVC_5ccbe497a0119.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ccbe497a0119.jpg\",\"raw_name\":\"HVC_5ccbe497a0119\",\"orig_name\":\"HVC_5ccbe497a0119.jpg\",\"client_name\":\"1cd011187c0a00cc9bc822c670e95bc0c0ec28741d1b2ad20cb279082cfb48b4 - Copy.jpg\",\"file_ext\":\".jpg\",\"file_size\":1941.99,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', 'RUTIN', 'leo_sayer'),
(4, '007', '2019-05-09', '017', 'DO', '334444', '444444', 'JL. PISANG NO 34', 5, 5, 5, 5, 40000, 5, 5, 5, 5, 5, 5, 5, 2000, '[{\"file_name\":\"HVC_5cd927f4aac3b.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5cd927f4aac3b.jpg\",\"raw_name\":\"HVC_5cd927f4aac3b\",\"orig_name\":\"HVC_5cd927f4aac3b.jpg\",\"client_name\":\"0dc5cb8af0606280483fcfa221b0ede260592e8d0378b52df521b07826851359.jpg\",\"file_ext\":\".jpg\",\"file_size\":458.27,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', 'RUTIN', 'leo_sayer'),
(5, '007', '1970-01-01', '002', 'SAYER', '32423423', '43242343', 'JL. PISANG NO 34', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 53000, 34000, 66000, 89000, 43000, 34000, '', 'RUTIN', 'leo_sayer'),
(6, '007', '2019-05-22', 'mark001', 'TOKUGAWA', '444444444', '444444444', 'JL HANOMAN  NO 55', 4000, 70000, 32000, 80000, 30000, 100000, 23232, 53000, 34000, 66000, 89000, 43000, 34000, '[{\"file_name\":\"HVC_5ce4b18a7529f.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ce4b18a7529f.jpg\",\"raw_name\":\"HVC_5ce4b18a7529f\",\"orig_name\":\"HVC_5ce4b18a7529f.jpg\",\"client_name\":\"cf68fd432353dbc4c5c5070c7b7c321545a9f624eca354f8d4b348b4f84ea935.jpg\",\"file_ext\":\".jpg\",\"file_size\":1231.38,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"HVC_5ce4b18a7b752.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ce4b18a7b752.jpg\",\"raw_name\":\"HVC_5ce4b18a7b752\",\"orig_name\":\"HVC_5ce4b18a7b752.jpg\",\"client_name\":\"d0d1d75d48fd6d5e2c06c89c46120df79b2b45eca1d24f410596dca764a50f9a.jpg\",\"file_ext\":\".jpg\",\"file_size\":453.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"HVC_5ce4b18a7f981.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/hvc\\/HVC_5ce4b18a7f981.jpg\",\"raw_name\":\"HVC_5ce4b18a7f981\",\"orig_name\":\"HVC_5ce4b18a7f981.jpg\",\"client_name\":\"d9ffc7b3824f393a918fe0f427c037ab1963edeff9ae9acd47b744e402e92280 (2).jpg\",\"file_ext\":\".jpg\",\"file_size\":590.01,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', 'RUTIN', 'leo_sayer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_komunitas`
--

CREATE TABLE `tbl_komunitas` (
  `id_komunitas` int(11) NOT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `nama_petugas` varchar(100) DEFAULT NULL,
  `nama_komunitas` varchar(100) DEFAULT NULL,
  `nama_ketua` varchar(100) DEFAULT NULL,
  `no_hpketua` varchar(12) DEFAULT NULL,
  `alamat_komunitas` varchar(200) DEFAULT NULL,
  `jumlah_anggota` int(11) DEFAULT NULL,
  `nama_sosmed` varchar(100) DEFAULT NULL,
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_komunitas`
--

INSERT INTO `tbl_komunitas` (`id_komunitas`, `kode_tdc`, `nama_petugas`, `nama_komunitas`, `nama_ketua`, `no_hpketua`, `alamat_komunitas`, `jumlah_anggota`, `nama_sosmed`, `kode_user`) VALUES
(2, '007', 'EXTREME', 'SOLO', 'DOE', '33243242342', 'EASY ROAD', 342, 'EXTREME_TO_EXTEND', 'L342r'),
(3, 'TDC', 'LEO', 'DISTANCE', 'SAYER', '9809709789', 'SUKARAME', 657, '@__DISTANCE', '001'),
(4, '007', 'FOO', 'BAR', 'DOE', '33243242342', 'JL. PISANG NO 34', 342, 'EXTREME_TO_EXTEND', 'L342r');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marketing`
--

CREATE TABLE `tbl_marketing` (
  `kode_marketing` char(20) NOT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `divisi` varchar(100) DEFAULT NULL,
  `nama_marketing` varchar(100) DEFAULT NULL,
  `mkios` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_marketing`
--

INSERT INTO `tbl_marketing` (`kode_marketing`, `kode_tdc`, `divisi`, `nama_marketing`, `mkios`, `no_hp`, `alamat`, `email`) VALUES
('001', '045', 'administrator', 'Baker', '99999', '888888888888', 'Clear st. 2131', 'brandon@b.com'),
('002', '003', 'direct', 'Rainbow', 'Dio', '0888888888888', 'Babyllonia st. 132', 'dio@rainbow.com'),
('003', '003', 'collector', 'Lobo', 'Howcanitell', '085465456545', 'Low bow st. 92', 'lo@bo.com'),
('011', '045', 'Collector', 'Mendy', '3423', '42343244324324', 'Sukarame', 'suka@rame.com'),
('012', '045', 'collector', 'Aguero', '3423423', '65456546', 'Sukabumi', 'suka@bumi.com'),
('013', '045', 'collector', 'Da Silva', '3423423', '65456546', 'Way Huwi', 'huwi@way.com'),
('014', '045', 'collector', 'Mahrez', '3242323423', '65456546', 'Way Dadi', 'dadi@way.com'),
('015', '045', 'collector', 'Ederson', '2343423', '65456546', 'Way Kambas', 'kambas@way.com'),
('016', '045', 'canvasser', 'Pogba', '3213423', '65456546', 'Kedaton', 'suka@kedaton.com'),
('017', '003', 'canvasser', 'Baily', '232343423', '65456546', 'Way Halim', 'way@halim.com'),
('018', '045', 'canvasser', 'De Gea', '342777777', '65456546', 'Lungsir', 'suka@lung.com'),
('019', '003', 'canvasser', 'Rushford', '34767623', '65456546', 'Rawa Laut', 'rawa@laut.com'),
('020', '003', 'canvasser', 'Sanchez', '3457657', '65456546', 'Panjang', 'suka@panjang.com'),
('021', '003', 'Canvasser', 'Martial', '34287987', '65456546', 'Teluk', 'teluk@betung.com'),
('075', '003', 'direct', 'Zakaria', '4864643131', '08654123164569', 'Bekasi', 'zakaria__@rocketmail.com'),
('900', '004', 'Direct', 'Agung Deni W', '900', '900', 'Teluk', 'dedi@gmail.com'),
('CAn002', 'TDC001', 'CANVASSER', 'ANDRE SHEVCHENKO', '878', '081232421232', 'jl soekarno-hatta no 45 bandar lampung', 'SHEVA@GMAIL.COM'),
('CAN003', 'TDC001', 'CANVASSER', 'PAULO MALDINI', '99090', '081379103212', 'jl. urip sumohardjo no 3', 'maldinielcapitano@gmail.com'),
('CAN004', 'TDC001', 'CANVASSER', 'ANDREA PIRLO', '8797', '081278654309', 'JL ZA PAGAR ALAM NO 21', 'AREAP@GMAIL.COM'),
('CAN005', 'TDC002', 'CANVASSER', 'IRMA', '22212321', '089992233311', 'PESISIR BARAT', 'IRMA@GMAIL.COM'),
('COL001', 'TDC001', 'COLLECTOR', 'ARTHUR CURRY', '323422', '08232143223423', 'JL ATLANTIS NO 33', 'ARTHUR_CURR@GMAIL.COM'),
('COL002', 'TDC001', 'COLLECTOR', 'MERA', '3324234', '08997788332211', 'JL OCEANN NO 12', 'MERA__@GMAIL.COM'),
('COL003', 'TDC001', 'COLLECTOR', 'VOLKO', '342342', '0876545672123', 'JL ATLANTEA NO 3', 'VOLKO_VOLKO@GMAIL.COM'),
('mark001', 'kmz001', 'Direct', 'Tony Stark', '33', '33', '33', 'tony__@stark.com'),
('mark002', '045', 'Direct', 'Steve Rogers', '888', '88', '786', 'rogers@captain.us'),
('ZAR001', 'TDC', 'Canvasser', 'YENI ', '082180081445', '081369332493', 'JL TEUKU UMAR 10 G PENENGAHAN', 'YENI@GMAIL.COM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marketshare`
--

CREATE TABLE `tbl_marketshare` (
  `id_market` int(11) NOT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `npsn` char(20) DEFAULT NULL,
  `tgl_marketshare` date DEFAULT NULL,
  `qty_simpati` int(11) DEFAULT '0',
  `qty_as` int(11) DEFAULT '0',
  `qty_loop` int(11) DEFAULT '0',
  `qty_mentari` int(11) DEFAULT '0',
  `qty_im3` int(11) DEFAULT '0',
  `qty_xl` int(11) DEFAULT '0',
  `qty_axsis` int(11) DEFAULT '0',
  `qty_tri` int(11) DEFAULT '0',
  `qty_smartfrend` int(11) DEFAULT '0',
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_marketshare`
--

INSERT INTO `tbl_marketshare` (`id_market`, `kode_tdc`, `npsn`, `tgl_marketshare`, `qty_simpati`, `qty_as`, `qty_loop`, `qty_mentari`, `qty_im3`, `qty_xl`, `qty_axsis`, `qty_tri`, `qty_smartfrend`, `kode_user`) VALUES
(4, '007', '876756557', '2019-05-22', 10, 10, 10, 10, 10, 10, 10, 110, 10, 'L342r'),
(6, '', '666677', '2019-06-03', 889, 430, 320, 335, 530, 320, 323, 540, 540, 'L342r'),
(7, '', '666677', '2019-05-20', 889, 430, 8, 335, 530, 320, 323, 540, 540, 'L342r'),
(8, '007', '001', '2019-05-22', 430, 78, 320, 335, 530, 320, 323, 540, 540, 'L342r'),
(9, '007', '22052019', '2019-01-01', 11000, 11000, 10000, 10000, 10000, 100001, 100, 1000100, 100000, 'L342r');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_market_share_broadband`
--

CREATE TABLE `tbl_market_share_broadband` (
  `id_market` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `qty_telkomsel_marketshare` int(11) DEFAULT '0',
  `qty_indosat_marketshare` int(11) DEFAULT '0',
  `qty_xl_marketshare` int(11) DEFAULT '0',
  `qty_tri_marketshare` int(11) DEFAULT '0',
  `qty_smartfrend_marketshare` int(11) DEFAULT '0',
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_market_share_broadband`
--

INSERT INTO `tbl_market_share_broadband` (`id_market`, `tanggal`, `kabupaten`, `kecamatan`, `qty_telkomsel_marketshare`, `qty_indosat_marketshare`, `qty_xl_marketshare`, `qty_tri_marketshare`, `qty_smartfrend_marketshare`, `kode_user`) VALUES
(1, '2019-03-21', NULL, 'Ago', 999, 999, 10, 10, 999, '013'),
(2, '2020-10-01', NULL, 'Sukabumi', 77, 4654, 654654, 77777, 654, '005'),
(3, '2019-04-08', 'BANDAR LAMPUNG', 'Sukabumi', 9846, 777777, 7777, 77777, 7777, '002'),
(4, '2019-03-12', NULL, 'Kedaton', 878, 78787, 87878, 787, 878, '002'),
(5, '2019-04-19', 'LAMPUNG SELATAN', 'TANJUNG BINTANG', 8, 88, 79, 6876, 88, '002'),
(6, '2019-03-24', NULL, 'Lambar', 8, 8, 1, 8, 1, '002'),
(7, '2019-02-16', NULL, 'Kedaton', 878, 8, 10, 1, 8, '002'),
(8, '2019-03-06', 'LAMPUNG SELATAN', 'Palas', 77, 77, 77, 77, 77, '002'),
(9, '2019-03-07', 'LAMPUNG TIMUR', 'JABUNG', 67, 67, 67, 67, 67, '002'),
(10, '2019-03-06', 'BANDAR LAMPUNG', 'BUMI WARAS', 32424, 34234, 64432, 43242, 54353, 'IND013'),
(11, '2019-03-15', 'BANDAR LAMPUNG', 'KEDATON', 34324, 12232, 1244, 3433, 4434, 'IND013'),
(12, '2019-03-13', 'LAMPUNG SELATAN', 'MERBAU MATARAM', 3242, 3242, 3444, 2212, 6424, 'IND013'),
(13, '2019-03-15', 'LAMPUNG SELATAN', 'KATIBUNG', 8989, 2133, 9288, 3428, 3428, 'IND013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_market_share_regular`
--

CREATE TABLE `tbl_market_share_regular` (
  `id_market` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `qty_telkomsel_marketshare` int(11) DEFAULT '0',
  `qty_indosat_marketshare` int(11) DEFAULT '0',
  `qty_xl_marketshare` int(11) DEFAULT '0',
  `qty_tri_marketshare` int(11) DEFAULT '0',
  `qty_smartfrend_marketshare` int(11) DEFAULT '0',
  `mount_telkomsel_rechargeshare` double DEFAULT '0',
  `mount_indosat_rechargeshare` double DEFAULT '0',
  `mount_xl_rechargeshare` double DEFAULT '0',
  `mount_tri_rechargeshare` double DEFAULT '0',
  `mount_smartfrend_rechargeshare` double DEFAULT '0',
  `qty_telkomsel_salesshare` int(11) DEFAULT '0',
  `qty_indosat_salesshare` int(11) DEFAULT '0',
  `qty_xl_salesshare` int(11) DEFAULT '0',
  `qty_tri_salesshare` int(11) DEFAULT '0',
  `qty_smartfrend_salesshare` int(11) DEFAULT '0',
  `kode_user` char(10) DEFAULT NULL,
  `qty_simpati_marketshare` int(11) DEFAULT NULL,
  `qty_as_marketshare` int(11) DEFAULT NULL,
  `qty_loop_marketshare` int(11) DEFAULT NULL,
  `qty_mentari_marketshare` int(11) DEFAULT NULL,
  `qty_im3_marketshare` int(11) DEFAULT NULL,
  `mount_simpati_rechargeshare` int(11) DEFAULT NULL,
  `mount_as_rechargeshare` int(11) DEFAULT NULL,
  `mount_loop_rechargeshare` int(11) DEFAULT NULL,
  `mount_mentari_rechargeshare` int(11) DEFAULT NULL,
  `mount_im3_rechargeshare` int(11) DEFAULT NULL,
  `qty_simpati_salesshare` int(11) DEFAULT NULL,
  `qty_as_salesshare` int(11) DEFAULT NULL,
  `qty_loop_salesshare` int(11) DEFAULT NULL,
  `qty_mentari_salesshare` int(11) DEFAULT NULL,
  `qty_im3_salesshare` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_market_share_regular`
--

INSERT INTO `tbl_market_share_regular` (`id_market`, `tanggal`, `kabupaten`, `kecamatan`, `qty_telkomsel_marketshare`, `qty_indosat_marketshare`, `qty_xl_marketshare`, `qty_tri_marketshare`, `qty_smartfrend_marketshare`, `mount_telkomsel_rechargeshare`, `mount_indosat_rechargeshare`, `mount_xl_rechargeshare`, `mount_tri_rechargeshare`, `mount_smartfrend_rechargeshare`, `qty_telkomsel_salesshare`, `qty_indosat_salesshare`, `qty_xl_salesshare`, `qty_tri_salesshare`, `qty_smartfrend_salesshare`, `kode_user`, `qty_simpati_marketshare`, `qty_as_marketshare`, `qty_loop_marketshare`, `qty_mentari_marketshare`, `qty_im3_marketshare`, `mount_simpati_rechargeshare`, `mount_as_rechargeshare`, `mount_loop_rechargeshare`, `mount_mentari_rechargeshare`, `mount_im3_rechargeshare`, `qty_simpati_salesshare`, `qty_as_salesshare`, `qty_loop_salesshare`, `qty_mentari_salesshare`, `qty_im3_salesshare`) VALUES
(1, '2019-01-17', 'PESAWARAN', 'TATAAN', 77, 777777, 7777, 77777, 7777, 498, 498498, 20000, 849848, 8, 888, 8888, 8, 88, 88, '013', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2019-01-23', 'BANDAR LAMPUNG', 'WAY HALIM', 89, 84, 654, 6546, 5465, 46, 546, 4, 64, 78, 4654, 64, 654, 654, 654, '002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2020-02-11', 'BANDAR LAMPUNG', 'SUKARAME', 98798, 798, 798, 798, 798798, 798, 7987, 7, 8, 79, 8798, 798, 798, 7987, 9879, '013', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '4654-05-06', 'LAMPUNG SELATAN', 'PALAS', 9846, 4654, 654654, 654654, 654, 0, 0, 0, 89, 90, 0, 0, 0, 0, 0, '002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2019-03-08', 'LAMPUNG TIMUR', 'JABUNG', 8798, 798798, 7987, 987987, 987, 8.979, 8.978, 98.798, 879.879, 8.978, 9898, 9, 9808, 8, 987, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2019-02-27', 'LAMPUNG TIMUR', 'JABUNG', 8, 77, 77, 767, 8, 786.876, 87.678, 6.876, 8.768, 7.687, 7, 87676, 7, 87676, 687, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2019-03-14', 'LAMPUNG SELATAN', 'NATAR', 879, 879, 897, 789, 789, 80.987, 76.876, 879.879, 797.987, 987.879, 878989, 897987, 9, 9, 789, '002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2019-03-28', 'LAMPUNG SELATAN', 'TANJUNG BINTANG', 8, 8, 10, 6876, 8, 80.987, 8.978, 6.876, 789.789, 798.798, 878989, 878, 7, 9, 789, '002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '2019-03-08', 'BANDAR LAMPUNG', 'SUKABUMI', 1, 1, 1, 1, 1, 1.111, 1.111, 1.111, 1.111, 1.111, 1, 1, 111, 1, 1, '002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '2019-01-13', 'BANDAR LAMPUNG', 'WAY DADI', 8, 8, 10, 1, 8, 80.987, 8.978, 6.876, 1.111, 798.798, 878989, 878, 7, 9, 789, '002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '2019-01-20', 'BANDAR LAMPUNG', 'PAHOMAN', 8, 8, 1, 8, 8, 1.111, 8.978, 6.876, 789.789, 1.111, 878989, 1, 7, 1, 687, '002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '2019-03-24', 'BANDAR LAMPUNG', 'RAJABASA', 876, 88, 9, 7, 76, 768, 687.687, 687, 687, 6.786, 87, 687, 687, 687, 68, '002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '2019-06-22', 'LAMPUNG SELATAN', 'TELUK BETUNG', 0, 0, 78, 88, 78, 0, 0, 60, 70, 30, 0, 0, 30, 23, 32, '002', 40, 40, 40, 30, 30, 30, 30, 30, 25, 25, 54, 54, 54, 22, 22),
(14, '2019-02-06', 'BANDAR LAMPUNG', 'ENGGAL', 66, 44, 22, 22, 22, 33, 22, 11, 11, 11, 99, 66, 33, 33, 33, '002', 22, 22, 22, 22, 22, 11, 11, 11, 11, 11, 33, 33, 33, 33, 33),
(15, '2019-02-28', 'LAMPUNG SELATAN', 'KEDAMAIAN', 270, 180, 90, 90, 90, 240, 160, 80, 80, 80, 30, 20, 10, 10, 10, '002', 90, 90, 90, 90, 90, 80, 80, 80, 80, 80, 10, 10, 10, 10, 10),
(16, '2019-02-01', 'BANDAR LAMPUNG', 'ENGGAL', 132, 88, 44, 44, 44, 99, 66, 33, 33, 33, 66, 44, 22, 22, 22, '002', 44, 44, 44, 44, 44, 33, 33, 33, 33, 33, 22, 22, 22, 22, 22),
(17, '2019-02-08', 'BANDAR LAMPUNG', 'SUKARAME', 132, 88, 44, 44, 44, 99, 66, 33, 33, 33, 66, 44, 22, 22, 22, '002', 44, 44, 44, 44, 44, 33, 33, 33, 33, 33, 22, 22, 22, 22, 22),
(18, '2019-02-27', 'LAMPUNG TIMUR', 'JABUNG', 198, 132, 66, 666, 66, 132, 88, 44, 44, 44, 66, 24, 22, 22, 22, '002', 66, 66, 66, 66, 66, 44, 44, 44, 44, 44, 22, 22, 22, 22, 2),
(19, '2019-03-21', 'LAMPUNG TIMUR', 'JABUNG', 234, 86, 89, 89, 89, 193, 159, 67, 45, 54, 183, 174, 87, 789, 789, '002', 78, 78, 78, 78, 8, 88, 99, 6, 70, 89, 76, 9, 98, 98, 76),
(20, '2019-02-28', 'LAMPUNG SELATAN', 'TANJUNG SARI', 132, 132, 6, 67, 77, 176, 110, 77, 88, 66, 241, 854, 67, 56, 45, '002', 44, 44, 44, 66, 66, 44, 88, 44, 55, 55, 87, 67, 87, 767, 87),
(21, '2019-03-05', 'LAMPUNG SELATAN', 'PALAS', 27, 18, 9, 9, 9, 21, 14, 7, 7, 7, 15, 10, 5, 5, 5, '002', 9, 9, 9, 9, 9, 7, 7, 7, 7, 7, 5, 5, 5, 5, 5),
(22, '2019-03-04', 'BANDAR LAMPUNG', 'SUKARAME', 5900000, 5600000, 2100000, 4200000, 2100000, 9410000, 13420000, 2210000, 200000, 2100000, 8500000, 6500000, 110000, 900000, 120000, 'IND013', 800000, 3000000, 2100000, 4400000, 1200000, 4900000, 2300000, 2210000, 4220000, 9200000, 4200000, 2200000, 2100000, 4400000, 2100000),
(23, '2019-03-04', 'BANDAR LAMPUNG', 'ENGGAL', 1550000, 900000, 700000, 340000, 600000, 1640000, 1860000, 902000, 440000, 420000, 1290000, 830000, 530000, 220000, 120000, 'IND013', 780000, 430000, 340000, 670000, 230000, 870000, 340000, 430000, 870000, 990000, 980000, 210000, 100000, 510000, 320000),
(24, '2019-03-04', 'BANDAR LAMPUNG', 'WAY HALIM', 7500000, 5400000, 550000, 530000, 300000, 11400000, 1420000, 2100000, 1980000, 1990000, 1450000, 4220000, 1800000, 320000, 2200000, 'IND013', 1200000, 2000000, 4300000, 2200000, 3200000, 5000000, 3200000, 3200000, 220000, 1200000, 230000, 410000, 810000, 3300000, 920000),
(25, '2019-03-04', 'LAMPUNG SELATAN', 'SUKARAJA', 4190000, 3520000, 2200000, 1000000, 400000, 5210000, 2300000, 4102100, 2100000, 1200000, 5180000, 4010000, 2200000, 1500000, 210000, 'IND013', 890000, 1200000, 2100000, 420000, 3100000, 900000, 210000, 4100000, 2100000, 200000, 980000, 2100000, 2100000, 800000, 3210000),
(26, '2019-03-04', 'LAMPUNG TIMUR', 'PASIR SAKTI', 7150000, 3400000, 1900000, 2100000, 1800000, 3950000, 2620000, 2900000, 2200000, 530000, 6180000, 6300000, 890000, 890000, 220000, 'IND013', 650000, 3300000, 3200000, 1200000, 2200000, 870000, 980000, 2100000, 420000, 2200000, 1800000, 1980000, 2400000, 2100000, 4200000),
(27, '2019-03-21', 'LAMPUNG SELATAN', 'RAJABASA', 10099230, 9322112, 320000, 320000, 330000, 5320000, 2300000, 900000, 210000, 330000, 5210000, 911000, 2100000, 330000, 2100000, 'IND013', 7899000, 200230, 2000000, 9002112, 320000, 120000, 2100000, 3100000, 2100000, 200000, 910000, 2200000, 2100000, 890000, 21000),
(28, '2019-03-21', 'LAMPUNG SELATAN', 'SRAGI', 12129900, 4100000, 320000, 3200000, 330000, 12300000, 4999000, 2200000, 910000, 2100000, 6400000, 1678000, 210000, 239000, 980000, 'IND013', 7899900, 2230000, 2000000, 900000, 3200000, 9000000, 2100000, 1200000, 2999000, 2000000, 2100000, 2200000, 2100000, 880000, 798000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mercent`
--

CREATE TABLE `tbl_mercent` (
  `id_mercent` int(11) NOT NULL,
  `kode_tdc` char(12) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_marketing` char(12) DEFAULT NULL,
  `nama_mercent` varchar(100) DEFAULT NULL,
  `nama_pic` varchar(100) DEFAULT NULL,
  `no_hp_pic` varchar(100) DEFAULT NULL,
  `no_ktp` varchar(100) DEFAULT NULL,
  `npwp` varchar(100) DEFAULT NULL,
  `longtitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `alamat_mercent` varchar(200) DEFAULT NULL,
  `produk_diajukan` varchar(200) DEFAULT NULL,
  `foto_mercent` longtext,
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_mercent`
--

INSERT INTO `tbl_mercent` (`id_mercent`, `kode_tdc`, `tanggal`, `kode_marketing`, `nama_mercent`, `nama_pic`, `no_hp_pic`, `no_ktp`, `npwp`, `longtitude`, `latitude`, `alamat_mercent`, `produk_diajukan`, `foto_mercent`, `kode_user`) VALUES
(2, '007', '2019-05-02', '003', 'SAYER', 'dancing', '9897897', '77987987987', '87987987', '34324', '3424234', '786', 'AS', '[{\"file_name\":\"MER_5ccafc7e3b159.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/mercent\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/mercent\\/MER_5ccafc7e3b159.jpg\",\"raw_name\":\"MER_5ccafc7e3b159\",\"orig_name\":\"MER_5ccafc7e3b159.jpg\",\"client_name\":\"67f2b016e59637e2fa4b6d23f00c19e2a87a3833578ebd8d592052381f59832f.jpg\",\"file_ext\":\".jpg\",\"file_size\":1030.68,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"MER_5ccafc7e5bec4.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/mercent\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/mercent\\/MER_5ccafc7e5bec4.jpg\",\"raw_name\":\"MER_5ccafc7e5bec4\",\"orig_name\":\"MER_5ccafc7e5bec4.jpg\",\"client_name\":\"86e67d92a58853a079b078091007b37fed35bb40b89b5e9b69e9cb3743117a9c.jpg\",\"file_ext\":\".jpg\",\"file_size\":1110.73,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', NULL),
(11, 'TDC002', '2019-05-04', '003', 'JIMMY', 'WEQWEQWE', '432432342', '34234342', '324234234', '45345345', '454335', 'ZEPPELIN', 'SIMPATI', NULL, '001'),
(12, '007', '2019-01-01', '001', 'AAAAAA', 'dancing', '098099876', '965765675765', '87987987', '34324', '3424234', 'JL. PISANG NO 34', 'AS', '[{\"file_name\":\"MER_5cd928649af2a.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/mercent\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/mercent\\/MER_5cd928649af2a.jpg\",\"raw_name\":\"MER_5cd928649af2a\",\"orig_name\":\"MER_5cd928649af2a.jpg\",\"client_name\":\"0f44a3bcf32081e4b1132604523b2ab56bcd94aa09a3b5d7a3087045c2175060 1.jpg\",\"file_ext\":\".jpg\",\"file_size\":466.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_outlet`
--

CREATE TABLE `tbl_outlet` (
  `id_outlet` char(20) NOT NULL,
  `nama_outlet` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `kode_marketing` char(12) DEFAULT NULL,
  `hari_kunjungan` varchar(100) DEFAULT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `nomor_rs` varchar(20) DEFAULT NULL,
  `kategori_outlet` varchar(100) DEFAULT NULL,
  `galeri_foto` longtext,
  `kode_user` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_outlet`
--

INSERT INTO `tbl_outlet` (`id_outlet`, `nama_outlet`, `kabupaten`, `kecamatan`, `alamat`, `nama_pemilik`, `no_hp`, `kode_marketing`, `hari_kunjungan`, `kode_tdc`, `nomor_rs`, `kategori_outlet`, `galeri_foto`, `kode_user`) VALUES
('008', 'Brightness', 'Bandar Lampung', 'Metro Barat', 'Elmo st. 43', 'Persley', '085462168469', '075', 'Selasa', '004', '2423423', '234234234', NULL, '013'),
('009', 'Suko', 'Lampung Selatan', 'Sragi', 'jl. Etan', 'Gerdunkle', '085511223311658', '011', 'Senin', '004', '2423423', 'Besar', NULL, '013'),
('010', 'Brightness', 'Metro', 'Pringsewu', 'Jl. Elvis', 'Willy Wonka', '085511223311658', '011', 'Jumat', '004', '77777777', 'Menengah', NULL, '013'),
('011', 'Breaking Good', 'Bandar Lampung', 'Alabama', 'Elmo st. 43', 'Willy Wonka', '082315145413', '011', 'Senin', '004', '234234', 'Kecil', NULL, '013'),
('012', 'Breaking Bad', 'Metro', 'Pringsewu', 'Jl. Suara', 'Persley', '082315145413', '016', 'Selasa', '003', '234234', '234234234', NULL, '013'),
('013', 'Liverpool', 'Bandar Lampung', 'Kedamaian', 'Jl Kucing No 123', 'Salah', '0932132312423432', '5c7365b40c5e', 'Selasa', 'kmz001', '234344534', '34234ewrer', NULL, ''),
('014', 'Suko', 'Lampung Timur', 'Sukabumi', 'jl. Etan', 'Gerdunkle', '082315145413', '016', 'Jumat', '007', '77777777', '234234234', NULL, '013'),
('015', 'Darkness Oldfriend', 'Bandar Lampung', 'Kemiling', 'Jl. Suara', 'Willy Wonka', '085462168469', '016', 'Selasa', '004', '77777777', 'Menengah', NULL, '013'),
('016', 'Hear me Roar', 'Lampung Selatan', 'Bakauheni', 'Westeros', 'Tyron', '085462168469', '002', 'Minggu', '002', '469', 'Besar', NULL, 'L342r'),
('017', 'Suko', 'Bandar Lampung', 'Langkapura', 'jl. Etan', 'Brother', '085511223311658', '003', 'Senin', '001', '2423423', 'Besar', NULL, '003'),
('089', 'Darkness Oldfriend', 'Lampung Selatan', 'Palas', 'Jl. Suara', 'Persley', '085511223311658', '001', 'Rabu', '002', '987916', 'Menengah', NULL, 'L342r'),
('ot001', 'SI NONA', 'BANDAR LAMPUNG', 'KEDATON', 'JL ZA PAGAR ALAM NO 78', 'ELLY KASIM', '081323908877', 'CAn002', 'SENIN', 'TDC001', '11111111111', 'BESAR', NULL, ''),
('OT002', 'DINDIN', 'LAMPUNG SELATAN', 'KALIANDA', 'JL. SUNGAI GARINGI NO45', 'TIAR RAMON', '081344568890', 'CAN003', 'SELASA', 'TDC001', '00023123121', 'SEDANG', NULL, '013'),
('OT003', 'TAFAQQUH', 'LAMPUNG SELATAN', 'KATIBUNG', 'JL. PADJAJARAN NO 45 ', 'SOMAD', '083285983412', 'CAn002', 'SELASA', 'TDC001', '98342343', 'BESAR', NULL, '013'),
('OT004', 'AKHYAR', 'LAMPUNG TIMUR', 'PASIR SAKTI', 'JL. NANGKA NO 89', 'ADI HIDAYAT', '087865564344', 'CAN004', 'JUMAT', 'TDC001', '89342342', 'MENENGAH', '[]', ''),
('OT005', 'SYAMEELA', 'PESAWARAN', 'TEGINENENG', 'JL. JOGLO NO 34', 'OEMAR MITA', '087323128988', 'CAN003', 'RABU', 'TDC001', '87968797', 'KECIL', 'null', '013'),
('OT007', 'SHIFT', 'BANDAR LAMPUNG', 'ENGGAL', 'JL PEMUDA HIJRAH NO 66', 'HANAN ATTAKI', '089945457888', 'CAN003', 'JUMAT', 'TDC001', '0980980', 'BESAR', 'null', '013'),
('OT008', 'BROTHER FILLAH', 'BANDAR LAMPUNG', 'BUMI WARAS', 'JL. BANGAU NO78', 'HANDY BONY', '086655443321', 'CAN004', 'SABTU', 'TDC001', '6876876', 'MENENGAH', NULL, '013'),
('OT009', 'RODJA', 'LAMPUNG SELATAN', 'PENENGAHAN', 'JL. HAMBALI NO 22', 'JAWAS', '08989797685676', 'CAN003', 'KAMIS', 'TDC001', '656789', 'BESAR', NULL, '013'),
('OT010', 'YUFID', 'LAMPUNG SELATAN', 'SIDOMULYO', 'JL. HANAFI NO 04', 'ANDIRJA', '0834322353421', 'CAN003', 'RABU', 'TDC001', '0U8798677', 'MENENGAH', NULL, '013'),
('OT017', 'UMAR BIN ABDUL AZIZ', 'LAMPUNG TIMUR', 'WAWAY KARYA', 'JL BAGHDAD NO 77', 'ABU SOFYAN', '08777777777777', 'CAN003', 'KAMIS', 'TDC001', '32423423', 'KECIL', '[{\"file_name\":\"OT017_5c8a1e9a9f2a5.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/OT017_5c8a1e9a9f2a5.jpg\",\"raw_name\":\"OT017_5c8a1e9a9f2a5\",\"orig_name\":\"OT017_5c8a1e9a9f2a5.jpg\",\"client_name\":\"1366_768_31028261.jpg\",\"file_ext\":\".jpg\",\"file_size\":81.07,\"is_image\":true,\"image_width\":1366,\"image_height\":768,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1366\\\" height=\\\"768\\\"\"},{\"file_name\":\"OT017_5c8a1e9aa3494.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/OT017_5c8a1e9aa3494.jpg\",\"raw_name\":\"OT017_5c8a1e9aa3494\",\"orig_name\":\"OT017_5c8a1e9aa3494.jpg\",\"client_name\":\"1366_768_361023519.jpg\",\"file_ext\":\".jpg\",\"file_size\":66.62,\"is_image\":true,\"image_width\":1366,\"image_height\":768,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1366\\\" height=\\\"768\\\"\"},{\"file_name\":\"OT017_5c8a1e9aa65d2.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/OT017_5c8a1e9aa65d2.jpg\",\"raw_name\":\"OT017_5c8a1e9aa65d2\",\"orig_name\":\"OT017_5c8a1e9aa65d2.jpg\",\"client_name\":\"1366_768_411031338.jpg\",\"file_ext\":\".jpg\",\"file_size\":122.43,\"is_image\":true,\"image_width\":1366,\"image_height\":768,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1366\\\" height=\\\"768\\\"\"}]', ''),
('OT018', 'MAMALUK', 'PESAWARAN', 'TEGINENENG', 'JL UTARA NO 8', 'SALADIN', '0823213231122', 'CAN003', 'JUMAT', 'TDC001', '764324234', 'MENENGAH', '[\"outlet_5c86790380139.jpg\",\"outlet_5c8679038799e.jpg\"]', '013'),
('OT020', 'NANKATSU', 'PESAWARAN', 'TEGINENENG', 'JL. NANKATSU NO 10', 'TSUBASA', '0822131231231', 'CAN003', 'SENIN', 'TDC001', '876887', 'MENENGAH', '[\"OT020_5c867d715a44c.jpg\",\"OT020_5c867d715f17a.jpg\",\"OT020_5c867d716a983.jpg\",\"OT020_5c867d717cac8.png\",\"OT020_5c867d718164d.jpg\",\"OT020_5c867d718b3e4.jpg\",\"OT020_5c867d71946ff.jpg\"]', '013'),
('OT029', 'MANG', 'LAMPUNG TIMUR', 'PASIR SAKTI', 'JL. KARTINI NO 33', 'JURGEN', '08232143223423', 'CAN003', 'MINGGU', 'TDC001', '87678', 'BESAR', '[{\"file_name\":\"OT029_5cb5861fc5e37.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/OT029_5cb5861fc5e37.jpg\",\"raw_name\":\"OT029_5cb5861fc5e37\",\"orig_name\":\"OT029_5cb5861fc5e37.jpg\",\"client_name\":\"02f3a5ec4bce7076943714353c74a42e0b090103db1dc5a768aabddaf1e07534.jpg\",\"file_ext\":\".jpg\",\"file_size\":477.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"OT029_5cb5861fcaab1.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/OT029_5cb5861fcaab1.jpg\",\"raw_name\":\"OT029_5cb5861fcaab1\",\"orig_name\":\"OT029_5cb5861fcaab1.jpg\",\"client_name\":\"2d31d5b4b142e2aef348b9f94dd1cd34095e97e0a9b1379fd73f93b70852693c.jpg\",\"file_ext\":\".jpg\",\"file_size\":412.07,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', ''),
('OUT0078', 'OKEY', 'LAMPUNG SELATAN', 'CANDIPURO', 'JL PAT KAI NO 2', 'ANDI', '081245456767', 'CAN004', 'SENIN', 'TDC001', '432343452', 'BESAR', '[{\"file_name\":\"OUT0078_5cb535afb22d1.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/OUT0078_5cb535afb22d1.jpg\",\"raw_name\":\"OUT0078_5cb535afb22d1\",\"orig_name\":\"OUT0078_5cb535afb22d1.jpg\",\"client_name\":\"2d31d5b4b142e2aef348b9f94dd1cd34095e97e0a9b1379fd73f93b70852693c.jpg\",\"file_ext\":\".jpg\",\"file_size\":412.07,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"OUT0078_5cb535afb977a.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/outlet\\/OUT0078_5cb535afb977a.jpg\",\"raw_name\":\"OUT0078_5cb535afb977a\",\"orig_name\":\"OUT0078_5cb535afb977a.jpg\",\"client_name\":\"3a1d91aac5e36c9e0f33ac9431dcbdc41c10d224183aae0fa452359d87465f1d.jpg\",\"file_ext\":\".jpg\",\"file_size\":475.4,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', ''),
('out990', 'Hel', 'Lampung Timur', 'Jabung', '767', 'Klopp', '789', '5c735f665432', 'Senin', '045', '3423423434', 'Besar', NULL, '013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan_harian`
--

CREATE TABLE `tbl_penjualan_harian` (
  `id_penjualan` int(11) NOT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `divisi` varchar(100) DEFAULT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `kode_marketing` char(20) DEFAULT NULL,
  `lokasi_penjualan` varchar(100) DEFAULT NULL,
  `qty_5k` int(11) DEFAULT '0',
  `qty_10k` int(11) DEFAULT '0',
  `qty_20k` int(11) DEFAULT '0',
  `qty_25k` int(11) DEFAULT '0',
  `qty_50k` int(11) DEFAULT '0',
  `qty_100k` int(11) DEFAULT '0',
  `mount_bulk` double DEFAULT '0',
  `mount_legacy` double DEFAULT '0',
  `paket_max_digital` varchar(50) DEFAULT NULL,
  `no_msdn_digital` varchar(50) DEFAULT NULL,
  `price_digital` double DEFAULT '0',
  `msdn_tcash` varchar(50) DEFAULT NULL,
  `cashin_tcash` double DEFAULT '0',
  `status_tcash` varchar(20) DEFAULT NULL,
  `qty_low_nsb` int(11) DEFAULT '0',
  `qty_middle_nsb` int(11) DEFAULT '0',
  `qty_high_nsb` int(11) DEFAULT '0',
  `qty_as_nsb` int(11) DEFAULT '0',
  `qty_simpati_nsb` int(11) DEFAULT '0',
  `qty_loop_nsb` int(11) DEFAULT '0',
  `foto_kegiatan` longtext,
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_penjualan_harian`
--

INSERT INTO `tbl_penjualan_harian` (`id_penjualan`, `kode_tdc`, `divisi`, `tgl_penjualan`, `kode_marketing`, `lokasi_penjualan`, `qty_5k`, `qty_10k`, `qty_20k`, `qty_25k`, `qty_50k`, `qty_100k`, `mount_bulk`, `mount_legacy`, `paket_max_digital`, `no_msdn_digital`, `price_digital`, `msdn_tcash`, `cashin_tcash`, `status_tcash`, `qty_low_nsb`, `qty_middle_nsb`, `qty_high_nsb`, `qty_as_nsb`, `qty_simpati_nsb`, `qty_loop_nsb`, `foto_kegiatan`, `kode_user`) VALUES
(1, '002', 'Indirect', '2020-11-30', '002', 'California', 464, 9999, 999, 9999, 46, 8888, 465, 4654654, '234234', '54345', 45345, NULL, 43534, '5345345', 9999, 6546, 9999, 546546546, 546546, 54654654, '0', '013'),
(2, '003', 'Indirect', '2020-11-12', '002', 'California', 464, 9999, 999, 9999, 46, 546, 465, 4654654, '234234', '54345', 45345, '498', 43534, '5345345', 9999, 6546, 9999, 546546546, 546546, 54654654, NULL, '002'),
(3, '002', 'Direct', '2019-10-29', '002', 'Chicago', 464, 9999, 999, 9999, 46, 546, 465, 4654654, '234234', '54345', 45345, NULL, 43534, '5345345', 9999, 6546, 9999, 546546546, 546546, 54654654, 'default.png', '013'),
(4, '007', 'INDIRECT', '2019-03-30', '015', 'SUKABUMI', 80000, 70000, 32000, 80000, 30000, 100000, 48000000, 4500000, '4000', '5000', 3200, '4000', 3000, '5000', 53000, 34000, 66000, 89000, 43000, 34000, '[{\"file_name\":\"PENJUALANHARIAN_5cc5329be43d2.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/PENJUALANHARIAN_5cc5329be43d2.jpg\",\"raw_name\":\"PENJUALANHARIAN_5cc5329be43d2\",\"orig_name\":\"PENJUALANHARIAN_5cc5329be43d2.jpg\",\"client_name\":\"02f3a5ec4bce7076943714353c74a42e0b090103db1dc5a768aabddaf1e07534 1.jpg\",\"file_ext\":\".jpg\",\"file_size\":477.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"PENJUALANHARIAN_5cc5329c36288.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/PENJUALANHARIAN_5cc5329c36288.jpg\",\"raw_name\":\"PENJUALANHARIAN_5cc5329c36288\",\"orig_name\":\"PENJUALANHARIAN_5cc5329c36288.jpg\",\"client_name\":\"02f3a5ec4bce7076943714353c74a42e0b090103db1dc5a768aabddaf1e07534.jpg\",\"file_ext\":\".jpg\",\"file_size\":477.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"PENJUALANHARIAN_5cc5329c52b49.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/PENJUALANHARIAN_5cc5329c52b49.jpg\",\"raw_name\":\"PENJUALANHARIAN_5cc5329c52b49\",\"orig_name\":\"PENJUALANHARIAN_5cc5329c52b49.jpg\",\"client_name\":\"2d31d5b4b142e2aef348b9f94dd1cd34095e97e0a9b1379fd73f93b70852693c.jpg\",\"file_ext\":\".jpg\",\"file_size\":412.07,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', 'L342r'),
(5, '007', 'DIREC', '2019-03-14', '019', 'KEDATON', 80000, 40000, 32000, 80000, 30000, 100000, 48000000, 4500000, '4000', '5000', 3200, '4000', 3000, '5000', 53000, 34000, 66000, 89000, 43000, 34000, '[{\"file_name\":\"PENJUALANHARIAN_5ce2741e76524.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/PENJUALANHARIAN_5ce2741e76524.jpg\",\"raw_name\":\"PENJUALANHARIAN_5ce2741e76524\",\"orig_name\":\"PENJUALANHARIAN_5ce2741e76524.jpg\",\"client_name\":\"a798d64af543fa9a21da94b396b6c7955ee1deb20f1b5338b58ff09c2e2dd177.jpg\",\"file_ext\":\".jpg\",\"file_size\":461.42,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"PENJUALANHARIAN_5ce2741e94935.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/PENJUALANHARIAN_5ce2741e94935.jpg\",\"raw_name\":\"PENJUALANHARIAN_5ce2741e94935\",\"orig_name\":\"PENJUALANHARIAN_5ce2741e94935.jpg\",\"client_name\":\"a4537deb4124aec866d8021774cb47089dda1b6e1f1f65570ab206e67b2acc9c.jpg\",\"file_ext\":\".jpg\",\"file_size\":1498.05,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', NULL),
(6, '007', 'DIRECT', '2019-05-20', '002', 'BUNDERAN GAJAH', 4000, 40000, 32000, 2000, 40000, 2000, 48000000, 4500000, '4000', '5000', 3200, '4000', 3000, '5000', 53000, 34000, 66000, 89000, 43000, 34000, '[{\"file_name\":\"PENJUALANHARIAN_5ce3b310f0aa9.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/PENJUALANHARIAN_5ce3b310f0aa9.jpg\",\"raw_name\":\"PENJUALANHARIAN_5ce3b310f0aa9\",\"orig_name\":\"PENJUALANHARIAN_5ce3b310f0aa9.jpg\",\"client_name\":\"cf68fd432353dbc4c5c5070c7b7c321545a9f624eca354f8d4b348b4f84ea935.jpg\",\"file_ext\":\".jpg\",\"file_size\":1231.38,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"PENJUALANHARIAN_5ce3b31108820.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/PENJUALANHARIAN_5ce3b31108820.jpg\",\"raw_name\":\"PENJUALANHARIAN_5ce3b31108820\",\"orig_name\":\"PENJUALANHARIAN_5ce3b31108820.jpg\",\"client_name\":\"d0d1d75d48fd6d5e2c06c89c46120df79b2b45eca1d24f410596dca764a50f9a.jpg\",\"file_ext\":\".jpg\",\"file_size\":453.3,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"},{\"file_name\":\"PENJUALANHARIAN_5ce3b3110e56e.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/\",\"full_path\":\"E:\\/xampp\\/htdocs\\/digimon\\/upload\\/penjualanharian\\/PENJUALANHARIAN_5ce3b3110e56e.jpg\",\"raw_name\":\"PENJUALANHARIAN_5ce3b3110e56e\",\"orig_name\":\"PENJUALANHARIAN_5ce3b3110e56e.jpg\",\"client_name\":\"d9ffc7b3824f393a918fe0f427c037ab1963edeff9ae9acd47b744e402e92280 (2).jpg\",\"file_ext\":\".jpg\",\"file_size\":590.01,\"is_image\":true,\"image_width\":1920,\"image_height\":1080,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1080\\\"\"}]', NULL),
(7, '007', 'INDIRECT', '2019-05-22', '003', 'BUNDERAN GAJAH', 4000, 40000, 32000, 80000, 30000, 100000, 48000000, 4500000, '4000', '5000', 3200, '4000', 3000, '5000', 53000, 34000, 66000, 89000, 43000, 34000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reg_marketshare`
--

CREATE TABLE `tbl_reg_marketshare` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `qty_telkomsel_marketshare` int(11) NOT NULL,
  `qty_simpati_marketshare` int(11) NOT NULL,
  `qty_as_marketshare` int(11) NOT NULL,
  `qty_loop_marketshare` int(11) NOT NULL,
  `qty_indosat_marketshare` int(11) NOT NULL,
  `qty_mentari_marketshare` int(11) NOT NULL,
  `qty_im3_marketshare` int(11) NOT NULL,
  `qty_xl_marketshare` int(11) NOT NULL,
  `qty_tri_marketshare` int(11) NOT NULL,
  `qty_smartfrend_marketshare` int(11) NOT NULL,
  `kode_user` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reg_marketshare`
--

INSERT INTO `tbl_reg_marketshare` (`id`, `tanggal`, `kabupaten`, `kecamatan`, `qty_telkomsel_marketshare`, `qty_simpati_marketshare`, `qty_as_marketshare`, `qty_loop_marketshare`, `qty_indosat_marketshare`, `qty_mentari_marketshare`, `qty_im3_marketshare`, `qty_xl_marketshare`, `qty_tri_marketshare`, `qty_smartfrend_marketshare`, `kode_user`) VALUES
(3, '2019-03-02', 'LAMPUNG TIMUR', 'WAWAY KARYA', 10000, 5000, 3000, 2000, 3500, 1500, 2000, 3000, 2300, 3000, 'IND013'),
(4, '2019-03-01', 'LAMPUNG SELATAN', 'SRAGI', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(5, '2019-03-01', 'LAMPUNG SELATAN', 'KETAPANG', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(6, '2019-03-01', 'LAMPUNG SELATAN', 'NATAR', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(7, '2019-03-01', 'LAMPUNG TIMUR', 'JABUNG', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(8, '2019-03-01', 'LAMPUNG SELATAN', 'PALAS', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(9, '2019-03-01', 'BANDAR LAMPUNG', 'WAYHALIM', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(10, '2019-03-01', 'PESAWARAN', 'TEGINENENG', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(11, '2019-04-03', 'BANDAR LAMPUNG', 'SUKARAME', 165000, 90000, 32000, 43000, 73000, 33000, 40000, 53000, 32000, 50000, 'IND013'),
(12, '2019-04-29', 'BANDAR LAMPUNG', 'KEDATON', 140000, 40000, 50000, 50000, 70000, 20000, 50000, 500000, 50000, 50000, 'IND013'),
(13, '2019-04-29', 'LAMPUNG SELATAN', 'SRAGI', 36000, 2000, 30000, 4000, 999200, 900000, 99200, 3000, 3000, 4000, 'IND013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reg_rechargeshare`
--

CREATE TABLE `tbl_reg_rechargeshare` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `mount_telkomsel_rechargeshare` decimal(11,0) NOT NULL,
  `mount_simpati_rechargeshare` decimal(11,0) NOT NULL,
  `mount_as_rechargeshare` decimal(11,0) NOT NULL,
  `mount_loop_rechargeshare` decimal(11,0) NOT NULL,
  `mount_indosat_rechargeshare` decimal(11,0) NOT NULL,
  `mount_mentari_rechargeshare` decimal(11,0) NOT NULL,
  `mount_im3_rechargeshare` decimal(11,0) NOT NULL,
  `mount_xl_rechargeshare` decimal(11,0) NOT NULL,
  `mount_tri_rechargeshare` decimal(11,0) NOT NULL,
  `mount_smartfrend_rechargeshare` decimal(11,0) NOT NULL,
  `kode_user` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reg_rechargeshare`
--

INSERT INTO `tbl_reg_rechargeshare` (`id`, `tanggal`, `kabupaten`, `kecamatan`, `mount_telkomsel_rechargeshare`, `mount_simpati_rechargeshare`, `mount_as_rechargeshare`, `mount_loop_rechargeshare`, `mount_indosat_rechargeshare`, `mount_mentari_rechargeshare`, `mount_im3_rechargeshare`, `mount_xl_rechargeshare`, `mount_tri_rechargeshare`, `mount_smartfrend_rechargeshare`, `kode_user`) VALUES
(2, '2019-03-02', 'LAMPUNG TIMUR', 'JABUNG', '10000', '5000', '3000', '2000', '3500', '1500', '2000', '3000', '2300', '300', 'IND013'),
(3, '2019-03-01', 'BANDAR LAMPUNG', 'ENGGAL', '1000', '500', '300', '200', '350', '150', '200', '300', '230', '300', 'IND013'),
(4, '2019-03-01', 'LAMPUNG SELATAN', 'SRAGI', '1000', '500', '300', '200', '350', '150', '200', '300', '230', '300', 'IND013'),
(6, '2019-03-01', 'LAMPUNG SELATAN', 'NATAR', '1000', '500', '300', '200', '350', '150', '200', '300', '230', '300', 'IND013'),
(7, '2019-03-01', 'LAMPUNG TIMUR', 'JABUNG', '1000', '500', '300', '200', '350', '150', '200', '300', '230', '300', 'IND013'),
(8, '2019-03-01', 'LAMPUNG SELATAN', 'PALAS', '1000', '500', '300', '200', '350', '150', '200', '300', '230', '300', 'IND013'),
(9, '2019-03-01', 'BANDAR LAMPUNG', 'WAYHALIM', '1000', '500', '300', '200', '350', '150', '200', '300', '230', '300', 'IND013'),
(10, '2019-03-01', 'PESAWARAN', 'TEGINENENG', '1000', '500', '300', '200', '350', '150', '200', '300', '230', '300', 'IND013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reg_salesshare`
--

CREATE TABLE `tbl_reg_salesshare` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `qty_telkomsel_salesshare` int(11) NOT NULL,
  `qty_simpati_salesshare` int(11) NOT NULL,
  `qty_as_salesshare` int(11) NOT NULL,
  `qty_loop_salesshare` int(11) NOT NULL,
  `qty_indosat_salesshare` int(11) NOT NULL,
  `qty_mentari_salesshare` int(11) NOT NULL,
  `qty_im3_salesshare` int(11) NOT NULL,
  `qty_xl_salesshare` int(11) NOT NULL,
  `qty_tri_salesshare` int(11) NOT NULL,
  `qty_smartfrend_salesshare` int(11) NOT NULL,
  `kode_user` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reg_salesshare`
--

INSERT INTO `tbl_reg_salesshare` (`id`, `tanggal`, `kabupaten`, `kecamatan`, `qty_telkomsel_salesshare`, `qty_simpati_salesshare`, `qty_as_salesshare`, `qty_loop_salesshare`, `qty_indosat_salesshare`, `qty_mentari_salesshare`, `qty_im3_salesshare`, `qty_xl_salesshare`, `qty_tri_salesshare`, `qty_smartfrend_salesshare`, `kode_user`) VALUES
(1, '2019-03-01', 'BANDAR LAMPUNG', 'SUKARAME', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(2, '2019-03-10', 'LAMPUNG SELATAN', 'JATI AGUNG', 10000, 4000, 3000, 3000, 8000, 4000, 4000, 2400, 2200, 3000, 'IND013'),
(3, '2019-03-01', 'BANDAR LAMPUNG', 'KEMILING', 1500, 700, 600, 200, 1200, 650, 550, 300, 230, 120, 'IND013'),
(4, '2019-03-01', 'BANDAR LAMPUNG', 'SUKABUMI', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(5, '2019-03-01', 'BANDAR LAMPUNG', 'ENGGAL', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(6, '2019-03-01', 'LAMPUNG SELATAN', 'SRAGI', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(7, '2019-03-01', 'LAMPUNG SELATAN', 'KETAPANG', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(8, '2019-03-01', 'LAMPUNG SELATAN', 'NATAR', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(9, '2019-03-01', 'LAMPUNG TIMUR', 'JABUNG', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(10, '2019-03-01', 'LAMPUNG SELATAN', 'PALAS', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(12, '2019-03-01', 'PESAWARAN', 'TEGINENENG', 1000, 500, 300, 200, 350, 150, 200, 300, 230, 300, 'IND013'),
(13, '2019-04-03', 'BANDAR LAMPUNG', 'WAY HALIM', 1690000, 750000, 410000, 530000, 810000, 600000, 210000, 1010000, 1200000, 1100000, 'IND013');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_score_card`
--

CREATE TABLE `tbl_score_card` (
  `id_score_card` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_marketing` char(20) DEFAULT NULL,
  `new_opening_outlet` int(11) DEFAULT '0',
  `outlet_aktif_digital` int(11) DEFAULT '0',
  `outlet_aktif_voucher` int(11) DEFAULT '0',
  `outlet_aktif_bang_tcash` int(11) DEFAULT '0',
  `sales_perdana` int(11) DEFAULT '0',
  `nsb` int(11) DEFAULT '0',
  `mkios_reguler` int(11) DEFAULT '0',
  `mkios_bulk` int(11) DEFAULT '0',
  `gt_pulsa` int(11) DEFAULT '0',
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_score_card`
--

INSERT INTO `tbl_score_card` (`id_score_card`, `tanggal`, `kode_marketing`, `new_opening_outlet`, `outlet_aktif_digital`, `outlet_aktif_voucher`, `outlet_aktif_bang_tcash`, `sales_perdana`, `nsb`, `mkios_reguler`, `mkios_bulk`, `gt_pulsa`, `kode_user`) VALUES
(4, '2019-02-22', '075', 43, 89, 34, 7, 234, 888, 888, 888, 888, '002'),
(6, '2019-02-07', '016', 56, 3, 3, 34, 4, 4, 4, 4, 4, '002'),
(7, '2019-02-14', '021', 89, 89, 89, 88, 55, 77, 88, 99, 44, '003'),
(8, '2019-02-14', '017', 2, 2, 2, 2, 400, 400, 400, 400, 400, '002'),
(9, '2019-02-14', '018', 8787, 3435, 6, 4, 656, 545, 454, 455, 454, '003'),
(10, '2019-02-14', '019', 54, 43, 32, 2, 44, 67, 87, 565, 765, '003'),
(11, '2019-02-14', '020', 23, 45, 3, 4, 65, 5, 645, 654, 43, '003'),
(12, '2019-12-13', '002', 87987, 8787, 87, 87878, 7878, 878, 787, 878, 788, '002'),
(13, '2019-02-02', '011', 87, 22, 44, 45, 10, 45, 45, 435, 9, '002'),
(14, '2019-02-05', '012', 2, 3, 4, 5, 2000, 2000, 2000, 2000, 2000, '002'),
(15, '2019-02-01', '013', 456, 45, 65, 654, 6546, 456, 45, 65, 54, '002'),
(16, '2019-02-28', '014', 65, 6, 77, 65, 65, 65, 65, 65, 65, '003'),
(17, '2019-02-28', '015', 65, 6, 57, 65, 55, 65, 65, 66, 65, '003'),
(18, '2019-02-28', '010', 65, 6, 57, 65, 55, 65, 65, 66, 65, '002'),
(20, '2019-02-22', '012', 5, 7, 4, 3, 2000, 2000, 2000, 2000, 2000, '002'),
(23, '2019-03-01', '018', 1, 20, 22, 12, 400, 200, 300, 700, 400, '002'),
(45, '2019-03-01', 'CAn002', 2, 1, 0, 2, 800, 31, 12, 30, 87, 'IND013'),
(46, '2019-03-03', 'CAn002', 1, 0, 0, 0, 800, 120, 200, 310, 90, 'IND013'),
(47, '2019-03-04', 'CAn002', 1, 1, 0, 1, 80, 14, 90, 310, 200, 'IND013'),
(48, '2019-03-01', 'CAN004', 1, 2, 1, 1, 90, 32, 3290, 2000, 99, 'IND013'),
(49, '2019-03-03', 'CAN004', 17, 1, 3, 3, 700, 300, 978, 45, 3200, 'IND013'),
(50, '2019-03-04', 'CAN004', 1, 2, 1, 1, 2400, 500, 92, 11, 21, 'IND013'),
(51, '2019-03-04', 'CAN003', 10, 3, 4, 2, 21, 80, 20, 41, 900, 'IND013'),
(52, '2019-03-05', 'CAN003', 0, 4, 5, 2, 79, 80, 41, 55, 87, 'IND013'),
(53, '2019-03-03', '016', 3, 5, 2, 4, 230, 500, 220, 1234, 430, '002'),
(54, '2019-03-04', '016', 4, 5, 8, 5, 200, 400, 120, 230, 444, '002'),
(55, '2019-02-04', 'CAn002', 4, 15, 15, 15, 4000, 4000, 5600, 2300, 5100, 'IND013'),
(56, '2019-02-05', 'CAn002', 3, 2, 4, 2, 5000, 2100, 4100, 2100, 2100, 'IND013'),
(57, '2019-02-06', 'CAn002', 2, 1, 1, 1, 4100, 2000, 3100, 9000, 9000, 'IND013'),
(58, '2019-01-01', 'CAn002', 5, 2, 3, 2, 6000, 9000, 8000, 2100, 9000, 'IND013'),
(59, '2019-04-01', '016', 5, 15, 15, 15, 2000, 4000, 5300, 2100, 7600, '002'),
(60, '2019-04-02', '018', 5, 12, 11, 14, 3000, 5000, 3000, 5000, 5000, '002'),
(61, '2019-04-03', '018', 2, 3, 4, 2, 300, 2000, 4000, 4000, 2000, '002'),
(62, '2019-04-16', 'CAn002', 3, 5, 5, 5, 4000, 5000, 9000, 2000, 1000, 'IND013'),
(63, '2019-04-24', 'CAN003', 4, 5, 5, 5, 2000, 5000, 6000, 2000, 9000, 'IND013'),
(64, '2018-01-01', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(65, '2019-01-01', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(66, '2019-01-02', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(67, '2019-01-03', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(68, '2019-01-04', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(69, '2019-01-05', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(70, '2019-03-01', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(71, '2019-03-02', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(72, '2019-03-03', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(73, '2019-03-04', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(74, '2019-03-05', '012', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(75, '2019-04-01', '012', 5, 5, 5, 5, 4500, 4500, 4500, 4500, 4500, '002'),
(76, '2019-04-02', '012', 5, 5, 5, 5, 4500, 4500, 4500, 4500, 4500, '002'),
(77, '2019-04-03', '012', 5, 5, 5, 5, 4500, 4500, 4500, 4500, 4500, '002'),
(78, '2019-04-04', '012', 5, 5, 5, 5, 4500, 4500, 4500, 4500, 4500, '002'),
(79, '2019-04-05', '012', 5, 5, 5, 5, 4500, 4500, 4500, 4500, 4500, '002'),
(80, '2019-02-01', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(81, '2019-01-02', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(82, '2019-01-03', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(83, '2019-01-04', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(84, '2019-02-02', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(85, '2019-02-03', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(86, '2019-03-01', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(87, '2019-03-02', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(88, '2019-03-03', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(89, '2019-04-01', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(90, '2019-04-02', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(91, '2019-04-03', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(92, '2019-04-04', '017', 3, 3, 3, 3, 3000, 3000, 3000, 3000, 3000, '002'),
(93, '2019-06-01', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(94, '2019-06-02', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(95, '2019-06-03', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(96, '2019-06-04', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(97, '2019-06-05', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(98, '2019-06-05', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(99, '2019-06-07', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(100, '2019-06-08', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(101, '2019-06-09', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(102, '2019-06-10', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(103, '2019-06-11', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(104, '2019-06-12', '016', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(105, '2019-06-01', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(106, '2019-06-02', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(107, '2019-06-03', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(108, '2019-06-04', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(109, '2019-06-05', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(110, '2019-06-05', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(111, '2019-06-07', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(112, '2019-06-08', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(113, '2019-06-09', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(114, '2019-06-10', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(115, '2019-06-11', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002'),
(116, '2019-06-12', '018', 3, 2, 2, 2, 250, 500, 350, 550, 150, '002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_score_card_collector`
--

CREATE TABLE `tbl_score_card_collector` (
  `id_score_card` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_marketing` char(20) DEFAULT NULL,
  `new_rs_non_outlet` int(11) DEFAULT NULL,
  `nsb` int(11) DEFAULT NULL,
  `gt_pulsa` int(11) DEFAULT NULL,
  `collecting` int(11) DEFAULT NULL,
  `kode_user` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_score_card_collector`
--

INSERT INTO `tbl_score_card_collector` (`id_score_card`, `tanggal`, `kode_marketing`, `new_rs_non_outlet`, `nsb`, `gt_pulsa`, `collecting`, `kode_user`) VALUES
(2, '2019-02-08', '012', 66, 77, 78, 76, '002'),
(3, '2019-03-04', '003', 1, 20, 100000, 20, '002'),
(4, '2019-03-04', 'COL001', 3, 300, 2000, 12000, 'IND013'),
(5, '2019-03-05', 'COL001', 2, 280, 1000, 34000, 'IND013'),
(6, '2019-03-06', 'COL001', 1, 450, 24000, 50000, 'IND013'),
(7, '2019-03-04', 'COL002', 3, 2200, 2000, 45000, 'IND013'),
(8, '2019-03-05', 'COL002', 1, 2300, 4800, 31000, 'IND013'),
(9, '2019-03-11', 'COL003', 4, 400, 6000, 67000, 'IND013'),
(10, '2019-03-05', 'COL003', 1, 400, 2100, 89000, 'IND013'),
(11, '2019-02-04', 'COL001', 5, 2000, 4000, 5000, 'IND013'),
(12, '2019-02-05', 'COL001', 0, 2500, 7000, 8000, 'IND013'),
(13, '2019-02-04', 'COL002', 2, 4500, 2000, 5000, 'IND013'),
(14, '2019-04-01', '012', 4, 3000, 3200, 5000, '002'),
(15, '2019-04-01', '013', 7, 2000, 5000, 6000, '002'),
(16, '2019-04-24', 'COL001', 5, 30000, 43000, 50000, 'IND013'),
(17, '2019-04-25', 'COL001', 3, 20000, 50000, 21000, 'IND013'),
(18, '2019-01-01', '013', 4, 4500, 4500, 4500, '002'),
(19, '2019-01-01', '013', 5, 300, 300, 300, '002'),
(20, '2019-01-01', '013', 5, 400, 400, 400, '002'),
(21, '2019-01-01', '013', 5, 4500, 4500, 4500, '002'),
(22, '2019-02-01', '013', 5, 300, 300, 300, '002'),
(23, '2019-02-01', '013', 5, 300, 300, 300, '002'),
(24, '2019-02-01', '013', 5, 300, 300, 300, '002'),
(25, '2019-02-01', '013', 5, 250, 250, 250, '002'),
(26, '2019-02-01', '013', 5, 250, 250, 250, '002'),
(27, '2019-03-01', '013', 5, 250, 250, 250, '002'),
(28, '2019-03-01', '013', 5, 2000, 2000, 2000, '002'),
(29, '2019-03-01', '013', 5, 2000, 2000, 2000, '002'),
(30, '2019-04-01', '013', 5, 2000, 2000, 2000, '002'),
(31, '2019-04-01', '013', 5, 2500, 2500, 2500, '002'),
(32, '2019-04-01', '013', 5, 4000, 4000, 4000, '002'),
(33, '2019-04-01', '013', 5, 4500, 4500, 4500, '002'),
(34, '2019-05-01', '013', 5, 6000, 6000, 6000, '002'),
(35, '2019-05-01', '013', 5, 3000, 3000, 3000, '002'),
(36, '2019-05-01', '013', 5, 1400, 1400, 1400, '002'),
(37, '2019-05-01', '013', 5, 1000, 1000, 1000, '002'),
(38, '2019-06-01', '013', 5, 5000, 5000, 5000, '002'),
(39, '2019-06-01', '013', 5, 2400, 2400, 2400, '002'),
(40, '2019-06-01', '013', 5, 1500, 1500, 1500, '002'),
(41, '2019-06-01', '013', 5, 7000, 7000, 7000, '002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sekolah`
--

CREATE TABLE `tbl_sekolah` (
  `npsn` char(20) NOT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `alamat_sekolah` varchar(200) DEFAULT NULL,
  `jumlah_siswa` int(11) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longtitude` varchar(100) DEFAULT NULL,
  `kode_marketing` char(20) DEFAULT NULL,
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_sekolah`
--

INSERT INTO `tbl_sekolah` (`npsn`, `kode_tdc`, `kabupaten`, `kecamatan`, `nama_sekolah`, `alamat_sekolah`, `jumlah_siswa`, `latitude`, `longtitude`, `kode_marketing`, `kode_user`) VALUES
('001', '007', 'Lampung Selatan', 'Jatimulyo', 'MAN 1 Tanjung Karang', 'Jatimulyo', 4561, '6698466', '31158436', '002', '013'),
('22052019', '007', 'BANDAR LAMPUNG', 'ENGGAL', 'YAYASAN PENDIDIKAN AL KAUTSAR', 'JL. HAMBALI NO 33324', 4534534, '3424234', '34324', '013', 'leo_sayer'),
('666677', '007', 'LAMPUNG SELATAN', 'WAY SULAN', 'ORI', 'JL HANOMAN  NO 55', 4534534, '3424', '43423', '012', 'leo_sayer'),
('876756557', '007', 'PILIH KABUPATEN', 'PILIH KECAMATAN', 'SMA N1 BANDAR LAMPUNG', 'JALAN CUT NYAK DIEN', 4534534, '3424234', '34324', '003', 'leo_sayer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_target_assignment`
--

CREATE TABLE `tbl_target_assignment` (
  `id_target` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_marketing` char(12) DEFAULT NULL,
  `new_opening_outlet` int(11) DEFAULT '0',
  `outlet_aktif_digital` int(11) DEFAULT '0',
  `outlet_aktif_voucher` int(11) DEFAULT '0',
  `outlet_aktif_bang_tcash` int(11) DEFAULT '0',
  `sales_perdana` int(11) DEFAULT NULL,
  `nsb` int(11) DEFAULT '0',
  `mkios_bulk` int(11) DEFAULT '0',
  `gt_pulsa` int(11) DEFAULT '0',
  `mkios_reguler` int(11) DEFAULT '0',
  `kode_user` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_target_assignment`
--

INSERT INTO `tbl_target_assignment` (`id_target`, `tanggal`, `kode_marketing`, `new_opening_outlet`, `outlet_aktif_digital`, `outlet_aktif_voucher`, `outlet_aktif_bang_tcash`, `sales_perdana`, `nsb`, `mkios_bulk`, `gt_pulsa`, `mkios_reguler`, `kode_user`) VALUES
(1, '2019-01-30', '011', 22, 22222, 342, 444, 89, 222, 222, 222, 22, '005'),
(2, '2019-01-31', '012', 50, 50, 50, 50, 30000, 30000, 30000, 30000, 30000, '002'),
(5, '2019-02-07', '017', 20, 20, 20, 20, 30000, 30000, 30000, 30000, 30000, '002'),
(6, '2019-02-26', '018', 999, 99, 56, 556, 64, 999, 9, 99, 9, NULL),
(7, '2019-02-01', '011', 87, 978, 789, 79, 23, 989, 7987, 8, 65, '6546546'),
(8, '2019-02-01', '012', 15, 15, 15, 15, 15000, 15000, 15000, 15000, 15000, '002'),
(9, '2019-02-01', '013', 876, 68, 456, 54, 23, 151, 564, 64, 54, '65'),
(10, '2019-02-01', '014', 89, 67, 657, 87, 64, 231, 89, 789, 677, '876'),
(11, '2019-02-01', '015', 89, 67, 657, 87, 64, 325, 89, 789, 677, '876'),
(13, '2019-02-01', '020', 89, 67, 657, 87, 34, 235, 89, 789, 677, '876'),
(18, '2019-02-04', '016', 90, 90, 34, 44, 34, 90, 100, 100, 100, '002'),
(24, '2019-03-01', '016', 10, 40, 60, 45, 900, 2300, 4100, 3400, 2000, '002'),
(25, '2019-03-30', '018', 10, 40, 30, 50, 800, 3100, 3200, 4000, 2300, '002'),
(28, '2019-03-30', 'CAN004', 20, 5, 5, 5, 4000, 2100, 4100, 2310, 4100, 'IND013'),
(29, '2019-03-30', 'CAn002', 18, 4, 4, 4, 9000, 1900, 2210, 2300, 4100, 'IND013'),
(30, '2019-03-30', 'CAN003', 30, 5, 5, 5, 8000, 9000, 21000, 2100, 3000, 'IND013'),
(31, '2019-02-28', 'CAn002', 12, 20, 30, 30, 200000, 320000, 220000, 410000, 210000, 'IND013'),
(32, '2019-02-28', 'CAN003', 10, 60, 20, 55, 230000, 230000, 500000, 300000, 450000, 'IND013'),
(33, '2019-01-30', 'CAn002', 10, 15, 15, 15, 100000, 200000, 210000, 300000, 140000, 'IND013'),
(34, '2019-04-01', '018', 20, 50, 50, 50, 50000, 23000, 21000, 42000, 43000, '002'),
(35, '2019-04-01', '016', 15, 60, 50, 60, 50000, 32000, 63000, 23000, 62000, '002'),
(36, '2019-04-30', 'CAn002', 20, 50, 50, 40, 90000, 98000, 80000, 78000, 32000, 'IND013'),
(37, '2019-04-30', 'CAN003', 20, 50, 50, 50, 30000, 40000, 60000, 53000, 40000, 'IND013'),
(38, '2019-03-05', '012', 20, 20, 20, 20, 20000, 20000, 20000, 20000, 20000, '002'),
(39, '2019-04-06', '012', 25, 25, 25, 25, 25000, 25000, 25000, 25000, 25000, '022'),
(40, '2019-01-01', '017', 15, 15, 15, 15, 25000, 25000, 25000, 25000, 25000, '002'),
(41, '2019-03-01', '017', 25, 25, 25, 25, 50000, 50000, 50000, 50000, 50000, '002'),
(42, '2019-04-01', '017', 20, 20, 20, 20, 30000, 30000, 30000, 30000, 30000, '002'),
(43, '2019-05-01', '017', 50, 50, 50, 50, 50000, 50000, 50000, 50000, 50000, '002'),
(44, '2019-06-01', '017', 45, 45, 45, 45, 45000, 45000, 45000, 45000, 45000, '002'),
(45, '2019-06-01', '016', 50, 20, 20, 20, 50000, 50000, 50000, 50000, 50000, '002'),
(46, '2019-06-01', '018', 45, 30, 30, 30, 45000, 45000, 45000, 45000, 45000, '002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_target_assignment_collector`
--

CREATE TABLE `tbl_target_assignment_collector` (
  `id_target` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_marketing` char(20) DEFAULT NULL,
  `new_rs_non_outlet` int(11) DEFAULT NULL,
  `nsb` int(11) DEFAULT NULL,
  `gt_pulsa` int(11) DEFAULT NULL,
  `collecting` int(11) DEFAULT NULL,
  `kode_user` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_target_assignment_collector`
--

INSERT INTO `tbl_target_assignment_collector` (`id_target`, `tanggal`, `kode_marketing`, `new_rs_non_outlet`, `nsb`, `gt_pulsa`, `collecting`, `kode_user`) VALUES
(2, '2019-02-28', '003', 908897, 89798, 87987, 87987, '002'),
(3, '2019-02-01', '013', 30, 50000, 50000, 50000, '002'),
(4, '2019-02-28', '015', 34, 234, 342, 23, '002'),
(5, '2019-03-01', '013', 40, 50000, 50000, 50000, '002'),
(6, '2019-03-30', '015', 4, 250, 1000000, 200, '002'),
(7, '2019-03-30', '015', 15, 380, 3000, 4100, 'IND013'),
(8, '2019-03-30', '003', 15, 240, 5000, 6700, 'IND013'),
(10, '2019-03-30', 'COL002', 9, 5000, 13000, 500000, 'IND013'),
(11, '2019-03-30', 'COL003', 13, 45000, 30000, 300000, 'IND013'),
(12, '2019-03-30', 'COL001', 14, 24000, 50000, 780000, 'IND013'),
(13, '2019-02-28', 'COL001', 20, 40000, 41000, 21000, 'IND013'),
(14, '2019-02-28', 'COL002', 18, 21000, 44000, 21000, 'IND013'),
(15, '2019-04-01', '012', 20, 41000, 22100, 32000, '002'),
(16, '2019-04-01', '013', 40, 55000, 50000, 50000, '002'),
(17, '2019-04-30', 'COL001', 25, 500000, 210000, 520000, 'IND013'),
(18, '2019-01-01', '013', 25, 50000, 50000, 50000, '002'),
(19, '2019-05-01', '013', 45, 70000, 70000, 70000, '002'),
(20, '2019-06-01', '013', 55, 70000, 70000, 70000, '002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tdc`
--

CREATE TABLE `tbl_tdc` (
  `kode_tdc` char(20) NOT NULL,
  `nama_tdc` varchar(100) DEFAULT NULL,
  `manager` varchar(50) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `no_callcenter` varchar(20) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `kode_user` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_tdc`
--

INSERT INTO `tbl_tdc` (`kode_tdc`, `nama_tdc`, `manager`, `no_telepon`, `no_callcenter`, `alamat`, `kode_user`) VALUES
('002', 'Kedaton', 'Ryan', '07213434232', '0897232134234', 'Jl. Mama Aa', 'dir001'),
('003', 'Keratoon', 'Keating', '08454545454545', '07215555555', 'Endless st.', '005'),
('004', 'Natar', 'Jimmy Page', '086451316465', '184351616', 'Led st. 32', 'L342r'),
('007', 'Tanjung Bintang', '351351', '15614', '351351351', '351356168', '013'),
('009', 'blue', 'All Rise', '09324321321', '34234123', 'permata biru', '122'),
('010', 'KORPRI', 'BRYAN', '081333333333', '072198324', 'PERUMDAM', '010'),
('045', 'Teluk Betung', 'Mana', '084654567865', '0721654898465', 'jl. Etan', '002'),
('TDC', 'TDC TELUK BETUNG', 'Muhajirin (KJ)', '082180683333', '082180683333', 'Jl. Sultan Hasanudin', 'dir001'),
('TDC001', 'LANNISTER', 'TYWIN', '081231975464', '07213344556', 'JL. ELANG NO 13 BLOK B 11 GRIYA', 'IND013'),
('TDC002', 'IYI', 'dedi', '0878787878787', '072167687', 'malaysia', 'ind004');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `kode_user` char(10) NOT NULL,
  `kode_tdc` char(20) DEFAULT NULL,
  `nama_user` varchar(20) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`kode_user`, `kode_tdc`, `nama_user`, `level`, `password`) VALUES
('002', '045', 'bee_gees', 'indirect', 'howdeep'),
('013', '002', 'admin', 'administrator', 'bismillah'),
('099', '003', 'blah', 'adm_indirect', 'zeppelin'),
('dir001', '002', 'peter_parker', 'direct', 'spiderman'),
('dir002', '045', 'BATMAN', 'adm_direct', 'IAMTHENIGHT'),
('IND013', 'TDC001', 'TYWIN LANNISTER', 'INDIRECT', 'HEARMEROAR'),
('L342r', '007', 'leo_sayer', 'direct', 'whenineedyou');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kpi_canvasser`
-- (See below for the actual view)
--
CREATE TABLE `view_kpi_canvasser` (
`kode_tdc` char(20)
,`divisi` varchar(100)
,`sc_bulan` varchar(9)
,`ta_bulan` varchar(9)
,`tahun` int(4)
,`nama_marketing` varchar(100)
,`total_kpi` decimal(44,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_list_distribusi`
-- (See below for the actual view)
--
CREATE TABLE `view_list_distribusi` (
`tahun` int(4)
,`bulan` varchar(9)
,`nama_marketing` varchar(100)
,`divisi` varchar(100)
,`jumlah_outlet` bigint(14)
,`id_target` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_list_distribusi_collector`
-- (See below for the actual view)
--
CREATE TABLE `view_list_distribusi_collector` (
`kode_user` char(20)
,`tahun` int(4)
,`bulan` varchar(9)
,`nama_marketing` varchar(100)
,`new_rs_non_outlet` int(11)
,`collecting` int(11)
,`id_target` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_list_score_card`
-- (See below for the actual view)
--
CREATE TABLE `view_list_score_card` (
`kode_tdc` char(20)
,`tanggal` date
,`tahun` int(4)
,`bulan` varchar(9)
,`nama_marketing` varchar(100)
,`divisi` varchar(100)
,`jumlah_outlet` bigint(14)
,`id_score_card` int(11)
,`new_opening_outlet` int(11)
,`outlet_aktif_digital` int(11)
,`outlet_aktif_voucher` int(11)
,`outlet_aktif_bang_tcash` int(11)
,`sales_perdana` int(11)
,`nsb` int(11)
,`mkios_reguler` int(11)
,`mkios_bulk` int(11)
,`gt_pulsa` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_marketshare_reguler`
-- (See below for the actual view)
--
CREATE TABLE `view_marketshare_reguler` (
`kode_tdc` char(20)
,`id_market` int(11)
,`tanggal` date
,`kecamatan` varchar(100)
,`total_marketshare` bigint(16)
,`total_rechargeshare` double
,`total_salesshare` bigint(16)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pivot`
-- (See below for the actual view)
--
CREATE TABLE `view_pivot` (
`kode_tdc` char(20)
,`tanggal` date
,`bulan` varchar(9)
,`kd_marketing` varchar(20)
,`id_outlet` varchar(20)
,`nama_marketing` varchar(100)
,`nama_outlet` varchar(100)
,`sum_of_as` decimal(32,0)
,`sum_of_simpati` decimal(32,0)
,`sum_of_loop` decimal(32,0)
,`sum_of_nsb` decimal(32,0)
,`sum_of_mkios_reguler` decimal(32,0)
,`sum_of_mkios_bulk` decimal(32,0)
,`sum_of_gt_pulsa` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_salesshare`
-- (See below for the actual view)
--
CREATE TABLE `view_salesshare` (
`nama_tdc` varchar(100)
,`kabupaten` varchar(100)
,`kecamatan` varchar(100)
,`nama_marketing` varchar(100)
,`nama_outlet` varchar(100)
,`id_outlet` char(20)
,`nomor_rs` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `view_kpi_canvasser`
--
DROP TABLE IF EXISTS `view_kpi_canvasser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kpi_canvasser`  AS  select `m`.`kode_tdc` AS `kode_tdc`,`m`.`divisi` AS `divisi`,monthname(`sc`.`tanggal`) AS `sc_bulan`,monthname(`ta`.`tanggal`) AS `ta_bulan`,year(`ta`.`tanggal`) AS `tahun`,`m`.`nama_marketing` AS `nama_marketing`,((((((((round((((sum(`sc`.`new_opening_outlet`) / `ta`.`new_opening_outlet`) * 3) / 100),2) + round((((sum(`sc`.`outlet_aktif_digital`) / `ta`.`outlet_aktif_digital`) * 9) / 100),2)) + round((((sum(`sc`.`outlet_aktif_voucher`) / `ta`.`outlet_aktif_voucher`) * 5) / 100),2)) + round((((sum(`sc`.`outlet_aktif_bang_tcash`) / `ta`.`outlet_aktif_bang_tcash`) * 5) / 100),2)) + round((((sum(`sc`.`sales_perdana`) / `ta`.`sales_perdana`) * 3) / 100),2)) + round((((sum(`sc`.`nsb`) / `ta`.`nsb`) * 15) / 100),2)) + round((((sum(`sc`.`mkios_bulk`) / `ta`.`mkios_bulk`) * 25) / 100),2)) + round((((sum(`sc`.`gt_pulsa`) / `ta`.`gt_pulsa`) * 15) / 100),2)) + round((((sum(`sc`.`mkios_reguler`) / `ta`.`mkios_reguler`) * 20) / 100),2)) AS `total_kpi` from (((`tbl_marketing` `m` join `tbl_target_assignment` `ta` on((`m`.`kode_marketing` = `ta`.`kode_marketing`))) join `tbl_score_card` `sc` on((`m`.`kode_marketing` = `sc`.`kode_marketing`))) join `tbl_user` `u` on((`m`.`kode_tdc` = `u`.`kode_tdc`))) group by `m`.`kode_marketing`,monthname(`ta`.`tanggal`) ;

-- --------------------------------------------------------

--
-- Structure for view `view_list_distribusi`
--
DROP TABLE IF EXISTS `view_list_distribusi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_list_distribusi`  AS  select year(`ta`.`tanggal`) AS `tahun`,monthname(`ta`.`tanggal`) AS `bulan`,`m`.`nama_marketing` AS `nama_marketing`,`m`.`divisi` AS `divisi`,(((`ta`.`new_opening_outlet` + `ta`.`outlet_aktif_digital`) + `ta`.`outlet_aktif_voucher`) + `ta`.`outlet_aktif_bang_tcash`) AS `jumlah_outlet`,`ta`.`id_target` AS `id_target` from ((`tbl_target_assignment` `ta` join `tbl_marketing` `m` on((`ta`.`kode_marketing` = `m`.`kode_marketing`))) join `tbl_user` `u` on((`ta`.`kode_user` = `u`.`kode_user`))) where (`m`.`divisi` = 'canvasser') ;

-- --------------------------------------------------------

--
-- Structure for view `view_list_distribusi_collector`
--
DROP TABLE IF EXISTS `view_list_distribusi_collector`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_list_distribusi_collector`  AS  select `ta`.`kode_user` AS `kode_user`,year(`ta`.`tanggal`) AS `tahun`,monthname(`ta`.`tanggal`) AS `bulan`,`m`.`nama_marketing` AS `nama_marketing`,`ta`.`new_rs_non_outlet` AS `new_rs_non_outlet`,`ta`.`collecting` AS `collecting`,`ta`.`id_target` AS `id_target` from ((`tbl_target_assignment_collector` `ta` join `tbl_marketing` `m` on((`ta`.`kode_marketing` = `m`.`kode_marketing`))) join `tbl_user` `u` on((`ta`.`kode_user` = `u`.`kode_user`))) where (`m`.`divisi` = 'collector') ;

-- --------------------------------------------------------

--
-- Structure for view `view_list_score_card`
--
DROP TABLE IF EXISTS `view_list_score_card`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_list_score_card`  AS  select `u`.`kode_tdc` AS `kode_tdc`,`sc`.`tanggal` AS `tanggal`,year(`sc`.`tanggal`) AS `tahun`,monthname(`sc`.`tanggal`) AS `bulan`,`m`.`nama_marketing` AS `nama_marketing`,`m`.`divisi` AS `divisi`,(((`sc`.`new_opening_outlet` + `sc`.`outlet_aktif_digital`) + `sc`.`outlet_aktif_voucher`) + `sc`.`outlet_aktif_bang_tcash`) AS `jumlah_outlet`,`sc`.`id_score_card` AS `id_score_card`,`sc`.`new_opening_outlet` AS `new_opening_outlet`,`sc`.`outlet_aktif_digital` AS `outlet_aktif_digital`,`sc`.`outlet_aktif_voucher` AS `outlet_aktif_voucher`,`sc`.`outlet_aktif_bang_tcash` AS `outlet_aktif_bang_tcash`,`sc`.`sales_perdana` AS `sales_perdana`,`sc`.`nsb` AS `nsb`,`sc`.`mkios_reguler` AS `mkios_reguler`,`sc`.`mkios_bulk` AS `mkios_bulk`,`sc`.`gt_pulsa` AS `gt_pulsa` from ((`tbl_score_card` `sc` join `tbl_marketing` `m` on((`sc`.`kode_marketing` = `m`.`kode_marketing`))) join `tbl_user` `u` on((`sc`.`kode_user` = `u`.`kode_user`))) where (`m`.`divisi` = 'canvasser') ;

-- --------------------------------------------------------

--
-- Structure for view `view_marketshare_reguler`
--
DROP TABLE IF EXISTS `view_marketshare_reguler`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_marketshare_reguler`  AS  select `u`.`kode_tdc` AS `kode_tdc`,`tbl_market_share_regular`.`id_market` AS `id_market`,`tbl_market_share_regular`.`tanggal` AS `tanggal`,`tbl_market_share_regular`.`kecamatan` AS `kecamatan`,(((((`tbl_market_share_regular`.`qty_telkomsel_marketshare` + `tbl_market_share_regular`.`qty_indosat_marketshare`) + `tbl_market_share_regular`.`qty_smartfrend_marketshare`) + `tbl_market_share_regular`.`qty_xl_marketshare`) + `tbl_market_share_regular`.`qty_tri_marketshare`) + `tbl_market_share_regular`.`qty_smartfrend_marketshare`) AS `total_marketshare`,(((((`tbl_market_share_regular`.`mount_telkomsel_rechargeshare` + `tbl_market_share_regular`.`mount_indosat_rechargeshare`) + `tbl_market_share_regular`.`mount_smartfrend_rechargeshare`) + `tbl_market_share_regular`.`mount_xl_rechargeshare`) + `tbl_market_share_regular`.`mount_tri_rechargeshare`) + `tbl_market_share_regular`.`mount_smartfrend_rechargeshare`) AS `total_rechargeshare`,(((((`tbl_market_share_regular`.`qty_telkomsel_salesshare` + `tbl_market_share_regular`.`qty_indosat_salesshare`) + `tbl_market_share_regular`.`qty_smartfrend_salesshare`) + `tbl_market_share_regular`.`qty_xl_salesshare`) + `tbl_market_share_regular`.`qty_tri_salesshare`) + `tbl_market_share_regular`.`qty_smartfrend_salesshare`) AS `total_salesshare` from (`tbl_market_share_regular` join `tbl_user` `u` on((`tbl_market_share_regular`.`kode_user` = `u`.`kode_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_pivot`
--
DROP TABLE IF EXISTS `view_pivot`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pivot`  AS  select `tbl_marketing`.`kode_tdc` AS `kode_tdc`,`ho`.`tanggal` AS `tanggal`,ifnull(monthname(`ho`.`tanggal`),NULL) AS `bulan`,ifnull(`tbl_marketing`.`kode_marketing`,NULL) AS `kd_marketing`,ifnull(`tbl_outlet`.`id_outlet`,NULL) AS `id_outlet`,ifnull(`tbl_marketing`.`nama_marketing`,NULL) AS `nama_marketing`,ifnull(`tbl_outlet`.`nama_outlet`,NULL) AS `nama_outlet`,sum(if((month(`ho`.`tanggal`) = 1),`ho`.`as`,if((month(`ho`.`tanggal`) = 2),`ho`.`as`,if((month(`ho`.`tanggal`) = 3),`ho`.`as`,if((month(`ho`.`tanggal`) = 4),`ho`.`as`,if((month(`ho`.`tanggal`) = 5),`ho`.`as`,if((month(`ho`.`tanggal`) = 6),`ho`.`as`,if((month(`ho`.`tanggal`) = 7),`ho`.`as`,if((month(`ho`.`tanggal`) = 8),`ho`.`as`,if((month(`ho`.`tanggal`) = 9),`ho`.`as`,if((month(`ho`.`tanggal`) = 10),`ho`.`as`,if((month(`ho`.`tanggal`) = 11),`ho`.`as`,if((month(`ho`.`tanggal`) = 12),`ho`.`as`,0))))))))))))) AS `sum_of_as`,sum(if((month(`ho`.`tanggal`) = 1),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 2),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 3),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 4),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 5),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 6),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 7),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 8),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 9),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 10),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 11),`ho`.`simpati`,if((month(`ho`.`tanggal`) = 12),`ho`.`simpati`,0))))))))))))) AS `sum_of_simpati`,sum(if((month(`ho`.`tanggal`) = 1),`ho`.`loop`,if((month(`ho`.`tanggal`) = 2),`ho`.`loop`,if((month(`ho`.`tanggal`) = 3),`ho`.`loop`,if((month(`ho`.`tanggal`) = 4),`ho`.`loop`,if((month(`ho`.`tanggal`) = 5),`ho`.`loop`,if((month(`ho`.`tanggal`) = 6),`ho`.`loop`,if((month(`ho`.`tanggal`) = 7),`ho`.`loop`,if((month(`ho`.`tanggal`) = 8),`ho`.`loop`,if((month(`ho`.`tanggal`) = 9),`ho`.`loop`,if((month(`ho`.`tanggal`) = 10),`ho`.`loop`,if((month(`ho`.`tanggal`) = 11),`ho`.`loop`,if((month(`ho`.`tanggal`) = 12),`ho`.`loop`,0))))))))))))) AS `sum_of_loop`,sum(if((month(`ho`.`tanggal`) = 1),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 2),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 3),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 4),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 5),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 6),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 7),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 8),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 9),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 10),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 11),`ho`.`nsb`,if((month(`ho`.`tanggal`) = 12),`ho`.`nsb`,0))))))))))))) AS `sum_of_nsb`,sum(if((month(`ho`.`tanggal`) = 1),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 2),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 3),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 4),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 5),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 6),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 7),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 8),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 9),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 10),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 11),`ho`.`mkios_reguler`,if((month(`ho`.`tanggal`) = 12),`ho`.`mkios_reguler`,0))))))))))))) AS `sum_of_mkios_reguler`,sum(if((month(`ho`.`tanggal`) = 1),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 2),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 3),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 4),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 5),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 6),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 7),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 8),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 9),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 10),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 11),`ho`.`mkios_bulk`,if((month(`ho`.`tanggal`) = 12),`ho`.`mkios_bulk`,0))))))))))))) AS `sum_of_mkios_bulk`,sum(if((month(`ho`.`tanggal`) = 1),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 2),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 3),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 4),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 5),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 6),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 7),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 8),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 9),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 10),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 11),`ho`.`gt_pulsa`,if((month(`ho`.`tanggal`) = 12),`ho`.`gt_pulsa`,0))))))))))))) AS `sum_of_gt_pulsa` from ((`tbl_histori_order` `ho` join `tbl_marketing` on((`ho`.`kode_marketing` = `tbl_marketing`.`kode_marketing`))) join `tbl_outlet` on((`ho`.`id_outlet` = `tbl_outlet`.`id_outlet`))) group by monthname(`ho`.`tanggal`),`tbl_outlet`.`nama_outlet`,`tbl_marketing`.`nama_marketing`,`tbl_outlet`.`id_outlet`,`tbl_marketing`.`kode_marketing` with rollup ;

-- --------------------------------------------------------

--
-- Structure for view `view_salesshare`
--
DROP TABLE IF EXISTS `view_salesshare`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_salesshare`  AS  (select `t`.`nama_tdc` AS `nama_tdc`,`o`.`kabupaten` AS `kabupaten`,`o`.`kecamatan` AS `kecamatan`,`m`.`nama_marketing` AS `nama_marketing`,`o`.`nama_outlet` AS `nama_outlet`,`o`.`id_outlet` AS `id_outlet`,`o`.`nomor_rs` AS `nomor_rs` from ((`tbl_tdc` `t` join `tbl_marketing` `m` on((`t`.`kode_tdc` = `m`.`kode_tdc`))) join `tbl_outlet` `o` on((`m`.`kode_marketing` = `o`.`kode_marketing`)))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_downline_gt`
--
ALTER TABLE `tbl_downline_gt`
  ADD PRIMARY KEY (`id_downline_gt`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `tbl_foto_saleling`
--
ALTER TABLE `tbl_foto_saleling`
  ADD PRIMARY KEY (`id_saleling`);

--
-- Indexes for table `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_histori_order`
--
ALTER TABLE `tbl_histori_order`
  ADD PRIMARY KEY (`id_histori_order`);

--
-- Indexes for table `tbl_hvc`
--
ALTER TABLE `tbl_hvc`
  ADD PRIMARY KEY (`id_hvc`);

--
-- Indexes for table `tbl_komunitas`
--
ALTER TABLE `tbl_komunitas`
  ADD PRIMARY KEY (`id_komunitas`);

--
-- Indexes for table `tbl_marketing`
--
ALTER TABLE `tbl_marketing`
  ADD PRIMARY KEY (`kode_marketing`);

--
-- Indexes for table `tbl_marketshare`
--
ALTER TABLE `tbl_marketshare`
  ADD PRIMARY KEY (`id_market`);

--
-- Indexes for table `tbl_market_share_broadband`
--
ALTER TABLE `tbl_market_share_broadband`
  ADD PRIMARY KEY (`id_market`);

--
-- Indexes for table `tbl_market_share_regular`
--
ALTER TABLE `tbl_market_share_regular`
  ADD PRIMARY KEY (`id_market`);

--
-- Indexes for table `tbl_mercent`
--
ALTER TABLE `tbl_mercent`
  ADD PRIMARY KEY (`id_mercent`);

--
-- Indexes for table `tbl_outlet`
--
ALTER TABLE `tbl_outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `tbl_penjualan_harian`
--
ALTER TABLE `tbl_penjualan_harian`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `tbl_reg_marketshare`
--
ALTER TABLE `tbl_reg_marketshare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reg_rechargeshare`
--
ALTER TABLE `tbl_reg_rechargeshare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reg_salesshare`
--
ALTER TABLE `tbl_reg_salesshare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_score_card`
--
ALTER TABLE `tbl_score_card`
  ADD PRIMARY KEY (`id_score_card`);

--
-- Indexes for table `tbl_score_card_collector`
--
ALTER TABLE `tbl_score_card_collector`
  ADD PRIMARY KEY (`id_score_card`);

--
-- Indexes for table `tbl_sekolah`
--
ALTER TABLE `tbl_sekolah`
  ADD PRIMARY KEY (`npsn`);

--
-- Indexes for table `tbl_target_assignment`
--
ALTER TABLE `tbl_target_assignment`
  ADD PRIMARY KEY (`id_target`);

--
-- Indexes for table `tbl_target_assignment_collector`
--
ALTER TABLE `tbl_target_assignment_collector`
  ADD PRIMARY KEY (`id_target`);

--
-- Indexes for table `tbl_tdc`
--
ALTER TABLE `tbl_tdc`
  ADD PRIMARY KEY (`kode_tdc`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_foto_saleling`
--
ALTER TABLE `tbl_foto_saleling`
  MODIFY `id_saleling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_histori_order`
--
ALTER TABLE `tbl_histori_order`
  MODIFY `id_histori_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_hvc`
--
ALTER TABLE `tbl_hvc`
  MODIFY `id_hvc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_komunitas`
--
ALTER TABLE `tbl_komunitas`
  MODIFY `id_komunitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_marketshare`
--
ALTER TABLE `tbl_marketshare`
  MODIFY `id_market` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_market_share_broadband`
--
ALTER TABLE `tbl_market_share_broadband`
  MODIFY `id_market` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_market_share_regular`
--
ALTER TABLE `tbl_market_share_regular`
  MODIFY `id_market` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_mercent`
--
ALTER TABLE `tbl_mercent`
  MODIFY `id_mercent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_penjualan_harian`
--
ALTER TABLE `tbl_penjualan_harian`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_reg_marketshare`
--
ALTER TABLE `tbl_reg_marketshare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_reg_rechargeshare`
--
ALTER TABLE `tbl_reg_rechargeshare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_reg_salesshare`
--
ALTER TABLE `tbl_reg_salesshare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_score_card`
--
ALTER TABLE `tbl_score_card`
  MODIFY `id_score_card` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tbl_score_card_collector`
--
ALTER TABLE `tbl_score_card_collector`
  MODIFY `id_score_card` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_target_assignment`
--
ALTER TABLE `tbl_target_assignment`
  MODIFY `id_target` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_target_assignment_collector`
--
ALTER TABLE `tbl_target_assignment_collector`
  MODIFY `id_target` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
