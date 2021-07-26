/*
SQLyog Enterprise v13.1.1 (32 bit)
MySQL - 10.4.8-MariaDB : Database - db_persediaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_persediaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_persediaan`;

/*Table structure for table `tb_barang` */

DROP TABLE IF EXISTS `tb_barang`;

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barang` */

/*Table structure for table `tb_bidang` */

DROP TABLE IF EXISTS `tb_bidang`;

CREATE TABLE `tb_bidang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_bidang` */

/*Table structure for table `tb_bu` */

DROP TABLE IF EXISTS `tb_bu`;

CREATE TABLE `tb_bu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_BU` varchar(255) DEFAULT NULL,
  `tgl_BU` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_bu` */

/*Table structure for table `tb_d_bu` */

DROP TABLE IF EXISTS `tb_d_bu`;

CREATE TABLE `tb_d_bu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_BU` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_BU`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_d_bu_ibfk_1` FOREIGN KEY (`id_BU`) REFERENCES `tb_bu` (`id`),
  CONSTRAINT `tb_d_bu_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_bu` */

/*Table structure for table `tb_d_saldo` */

DROP TABLE IF EXISTS `tb_d_saldo`;

CREATE TABLE `tb_d_saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_saldo` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` enum('baik','rusak') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  KEY `id_saldo` (`id_saldo`),
  CONSTRAINT `tb_d_saldo_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id`),
  CONSTRAINT `tb_d_saldo_ibfk_2` FOREIGN KEY (`id_saldo`) REFERENCES `tb_saldo_awal` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_saldo` */

/*Table structure for table `tb_jabatan` */

DROP TABLE IF EXISTS `tb_jabatan`;

CREATE TABLE `tb_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jabatan` */

/*Table structure for table `tb_jenis_penerimaan` */

DROP TABLE IF EXISTS `tb_jenis_penerimaan`;

CREATE TABLE `tb_jenis_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jenis_penerimaan` */

/*Table structure for table `tb_opd` */

DROP TABLE IF EXISTS `tb_opd`;

CREATE TABLE `tb_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_opd` */

/*Table structure for table `tb_penerimaan` */

DROP TABLE IF EXISTS `tb_penerimaan`;

CREATE TABLE `tb_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_penerimaan` int(11) DEFAULT NULL,
  `id_BU` int(11) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `pengirim` varchar(255) DEFAULT NULL,
  `status` enum('draft','final') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jenis_penerimaan` (`id_jenis_penerimaan`),
  KEY `id_BU` (`id_BU`),
  CONSTRAINT `tb_penerimaan_ibfk_1` FOREIGN KEY (`id_jenis_penerimaan`) REFERENCES `tb_jenis_penerimaan` (`id`),
  CONSTRAINT `tb_penerimaan_ibfk_2` FOREIGN KEY (`id_BU`) REFERENCES `tb_bu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penerimaan` */

/*Table structure for table `tb_pengeluaran` */

DROP TABLE IF EXISTS `tb_pengeluaran`;

CREATE TABLE `tb_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) DEFAULT NULL,
  `id_BU` int(11) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('draft','final') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_BU`),
  CONSTRAINT `tb_pengeluaran_ibfk_1` FOREIGN KEY (`id_BU`) REFERENCES `tb_bu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pengeluaran` */

/*Table structure for table `tb_penggunaan` */

DROP TABLE IF EXISTS `tb_penggunaan`;

CREATE TABLE `tb_penggunaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_penggunaan` date DEFAULT NULL,
  `id_BU` int(11) DEFAULT NULL,
  `status` enum('draft','approved','final','disetujui') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_BU`),
  CONSTRAINT `tb_penggunaan_ibfk_1` FOREIGN KEY (`id_BU`) REFERENCES `tb_bu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penggunaan` */

/*Table structure for table `tb_periode` */

DROP TABLE IF EXISTS `tb_periode`;

CREATE TABLE `tb_periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opd` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `status` enum('open','close') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_periode_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_periode` */

/*Table structure for table `tb_saldo_awal` */

DROP TABLE IF EXISTS `tb_saldo_awal`;

CREATE TABLE `tb_saldo_awal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `status` enum('draft','final','closed') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo_awal` */

/*Table structure for table `tb_unit` */

DROP TABLE IF EXISTS `tb_unit`;

CREATE TABLE `tb_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_unit` */

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `id_bidang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `id_unit` (`id_unit`),
  KEY `id_bidang` (`id_bidang`),
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id`),
  CONSTRAINT `tb_user_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_user_ibfk_3` FOREIGN KEY (`id_bidang`) REFERENCES `tb_bidang` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;