/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.6-MariaDB : Database - db_persediaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_persediaan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_persediaan`;

/*Table structure for table `tb_barang_opd` */

DROP TABLE IF EXISTS `tb_barang_opd`;

CREATE TABLE `tb_barang_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opd` int(11) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_barang_opd_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barang_opd` */

insert  into `tb_barang_opd`(`id`,`id_opd`,`id_jenis`,`id_barang`,`qty`,`created_at`,`updated_at`,`deleted_at`) values 
(9,1,1,1,12,'2021-12-08 05:03:36','2021-12-16 05:45:35',NULL),
(10,1,2,2,3,'2021-12-08 05:03:36','2021-12-13 11:49:18',NULL);

/*Table structure for table `tb_barang_unit` */

DROP TABLE IF EXISTS `tb_barang_unit`;

CREATE TABLE `tb_barang_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` int(11) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_barang_unit_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `tb_barang_unit` */

insert  into `tb_barang_unit`(`id`,`id_unit`,`id_jenis`,`id_barang`,`qty`,`created_at`,`updated_at`,`deleted_at`) values 
(19,1,1,1,1,'2021-12-08 05:11:14','2021-12-16 05:51:12',NULL),
(20,1,2,2,1,'2021-12-08 05:11:14','2021-12-13 11:38:53',NULL);

/*Table structure for table `tb_d_opname` */

DROP TABLE IF EXISTS `tb_d_opname`;

CREATE TABLE `tb_d_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opname` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_d_opname_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_opname` */

insert  into `tb_d_opname`(`id`,`id_opname`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,2,1,40000,'baik','2021-12-08 05:43:54','2021-12-08 05:43:54',NULL),
(4,3,1,1,34000,'baik','2021-12-13 19:40:00','2021-12-13 11:40:00',NULL),
(5,4,1,3,102000,'rusak','2021-12-16 05:51:01','2021-12-16 05:51:01',NULL),
(7,5,1,1,34000,'baik','2021-12-17 15:40:37','2021-12-17 15:40:37',NULL),
(8,5,1,1,34000,'rusak','2021-12-17 15:43:18','2021-12-17 15:43:18',NULL);

/*Table structure for table `tb_d_penerimaan` */

DROP TABLE IF EXISTS `tb_d_penerimaan`;

CREATE TABLE `tb_d_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penerimaan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_penerimaan` (`id_penerimaan`),
  KEY `tb_d_penerimaan_ibfk_2` (`id_barang`),
  CONSTRAINT `tb_d_penerimaan_ibfk_1` FOREIGN KEY (`id_penerimaan`) REFERENCES `tb_penerimaan` (`id`),
  CONSTRAINT `tb_d_penerimaan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_penerimaan` */

insert  into `tb_d_penerimaan`(`id`,`id_penerimaan`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(12,9,1,2,68000,'baik','2021-12-08 05:03:28','2021-12-08 05:03:28',NULL),
(13,9,2,3,120000,'baik','2021-12-08 05:03:32','2021-12-08 05:03:32',NULL),
(16,11,1,3,102000,'baik','2021-12-08 05:05:25','2021-12-08 05:05:25',NULL),
(17,11,2,2,80000,'baik','2021-12-08 05:05:33','2021-12-08 05:05:33',NULL),
(18,13,1,1,34000,'baik','2021-12-13 08:45:42','2021-12-13 08:45:42',NULL),
(19,15,1,3,102000,'baik','2021-12-13 11:33:10','2021-12-13 11:33:10',NULL),
(20,15,2,2,80000,'baik','2021-12-13 11:33:19','2021-12-13 11:33:19',NULL),
(21,16,1,2,68000,'baik','2021-12-13 11:45:45','2021-12-13 11:45:45',NULL),
(22,17,1,1,34000,'baik','2021-12-13 11:48:42','2021-12-13 11:48:42',NULL),
(23,18,2,1,40000,'baik','2021-12-13 11:49:15','2021-12-13 11:49:15',NULL),
(24,19,1,1,34000,'baik','2021-12-13 11:49:41','2021-12-13 11:49:41',NULL),
(25,20,1,1,34000,'baik','2021-12-13 12:40:15','2021-12-13 12:40:15',NULL),
(26,21,1,5,170000,'baik','2021-12-13 12:40:54','2021-12-13 12:40:54',NULL),
(27,22,1,3,102000,'baik','2021-12-16 05:32:00','2021-12-16 05:32:00',NULL),
(29,23,1,1,34000,'baik','2021-12-17 13:33:58','2021-12-17 13:33:58',NULL);

/*Table structure for table `tb_d_pengeluaran` */

DROP TABLE IF EXISTS `tb_d_pengeluaran`;

CREATE TABLE `tb_d_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengeluaran` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pengeluaran` (`id_pengeluaran`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_d_pengeluaran_ibfk_1` FOREIGN KEY (`id_pengeluaran`) REFERENCES `tb_pengeluaran` (`id`),
  CONSTRAINT `tb_d_pengeluaran_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_pengeluaran` */

insert  into `tb_d_pengeluaran`(`id`,`id_pengeluaran`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(12,4,1,2,68000,'baik','2021-12-08 05:23:56','2021-12-08 05:23:56',NULL),
(13,4,2,2,80000,'baik','2021-12-08 05:24:09','2021-12-08 05:24:09',NULL),
(14,5,1,1,34000,'baik','2021-12-13 11:38:23','2021-12-13 11:38:23',NULL),
(15,5,2,1,40000,'baik','2021-12-13 11:38:30','2021-12-13 11:38:30',NULL),
(16,6,1,5,170000,'baik','2021-12-16 05:49:04','2021-12-16 05:49:04',NULL),
(18,7,1,1,34000,'baik','2021-12-17 14:59:18','2021-12-17 14:59:18',NULL);

/*Table structure for table `tb_d_penggunaan` */

DROP TABLE IF EXISTS `tb_d_penggunaan`;

CREATE TABLE `tb_d_penggunaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penggunaan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_penggunaan` (`id_penggunaan`),
  KEY `tb_d_penggunaan_ibfk_2` (`id_barang`),
  CONSTRAINT `tb_d_penggunaan_ibfk_1` FOREIGN KEY (`id_penggunaan`) REFERENCES `tb_penggunaan` (`id`),
  CONSTRAINT `tb_d_penggunaan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_penggunaan` */

/*Table structure for table `tb_d_saldo` */

DROP TABLE IF EXISTS `tb_d_saldo`;

CREATE TABLE `tb_d_saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_saldo` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  KEY `id_saldo` (`id_saldo`),
  CONSTRAINT `tb_d_saldo_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`),
  CONSTRAINT `tb_d_saldo_ibfk_2` FOREIGN KEY (`id_saldo`) REFERENCES `tb_saldo_awal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_saldo` */

insert  into `tb_d_saldo`(`id`,`id_saldo`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(3,1,1,1,34000,'baik','2021-12-16 01:48:52',NULL,NULL),
(4,2,1,3,102000,'baik','2021-12-16 05:26:55','2021-12-16 05:26:55',NULL),
(11,3,1,1,34000,'baik','2021-12-17 05:06:09','2021-12-17 05:06:09',NULL);

/*Table structure for table `tb_jabatan` */

DROP TABLE IF EXISTS `tb_jabatan`;

CREATE TABLE `tb_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id`,`jabatan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Admin BPKAD',NULL,NULL,NULL),
(2,'Staf Bidang',NULL,NULL,NULL),
(3,'PPBP',NULL,NULL,NULL),
(4,'KASI',NULL,NULL,NULL),
(5,'KASUBAG',NULL,NULL,NULL),
(6,'Administrator',NULL,NULL,NULL),
(7,'PPBPB',NULL,NULL,NULL),
(8,'TIM VERIFIKASI',NULL,NULL,NULL),
(9,'PPK',NULL,NULL,NULL),
(10,'Kepala PD',NULL,NULL,NULL);

/*Table structure for table `tb_jenis_barang` */

DROP TABLE IF EXISTS `tb_jenis_barang`;

CREATE TABLE `tb_jenis_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_barang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jenis_barang` */

insert  into `tb_jenis_barang`(`id`,`jenis_barang`) values 
(1,'Alat Tulis Kantor'),
(2,'Barang Cetakan'),
(3,'Alat Kebersihan');

/*Table structure for table `tb_master_barang` */

DROP TABLE IF EXISTS `tb_master_barang`;

CREATE TABLE `tb_master_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_m_barang` varchar(255) DEFAULT NULL,
  `harga_m_barang` int(11) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `satuan_m_barang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jenis` (`id_jenis`),
  CONSTRAINT `tb_master_barang_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_master_barang` */

insert  into `tb_master_barang`(`id`,`nama_m_barang`,`harga_m_barang`,`id_jenis`,`satuan_m_barang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Kertas HVS 70',34000,1,'Rim',NULL,NULL,NULL),
(2,'Tinta Hitam',40000,2,'Buah',NULL,NULL,NULL),
(3,'Sapu',24000,3,'Buah',NULL,NULL,NULL),
(4,'Pulpen',15000,1,'Lusin',NULL,NULL,NULL),
(5,'Kertas HVS 70',34000,2,'Rim',NULL,NULL,NULL);

/*Table structure for table `tb_master_kegiatan` */

DROP TABLE IF EXISTS `tb_master_kegiatan`;

CREATE TABLE `tb_master_kegiatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_program` int(11) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_master_kegiatan` */

insert  into `tb_master_kegiatan`(`id`,`id_program`,`kode`,`nama_kegiatan`) values 
(1,1,'1.1.1.1','kegiatan 1'),
(2,1,'1.1.1.2','kegiatan 2'),
(3,2,'1.1.2.1','kegiatan 3');

/*Table structure for table `tb_master_program` */

DROP TABLE IF EXISTS `tb_master_program`;

CREATE TABLE `tb_master_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_program` varchar(255) DEFAULT NULL,
  `nama_program` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_master_program` */

insert  into `tb_master_program`(`id`,`kode_program`,`nama_program`) values 
(1,'1.1.1','program 1'),
(2,'1.1.2','program 2');

/*Table structure for table `tb_opd` */

DROP TABLE IF EXISTS `tb_opd`;

CREATE TABLE `tb_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_opd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_opd` */

insert  into `tb_opd`(`id`,`nama_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'BPKAD','2021-07-29 10:01:53','0000-00-00 00:00:00','0000-00-00 00:00:00'),
(2,'Kominfo','2021-11-30 18:37:20','2021-11-30 18:37:22','2021-11-30 18:37:24');

/*Table structure for table `tb_opname` */

DROP TABLE IF EXISTS `tb_opname`;

CREATE TABLE `tb_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_opname` varchar(255) DEFAULT NULL,
  `status_opname` enum('draft','final','digunakan') DEFAULT NULL,
  `tgl_opname` date DEFAULT NULL,
  `ket_opname` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_periode` (`id_periode`),
  CONSTRAINT `tb_opname_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_opname` */

insert  into `tb_opname`(`id`,`kode_opname`,`status_opname`,`tgl_opname`,`ket_opname`,`total`,`id_periode`,`id_opd`,`id_unit`,`created_at`,`updated_at`,`deleted_at`) values 
(2,'BPKAD/OPN/1','digunakan','2021-01-01','test',40000,1,1,1,'2021-12-08 05:36:45','2021-12-08 06:11:52',NULL),
(3,'BPKAD/OPN/2','digunakan','2021-12-13','coba dinda 19.39',102000,1,1,1,'2021-12-13 11:39:32','2021-12-13 11:42:20',NULL),
(4,'BPKAD/OPN/3','digunakan','2021-12-16','opname',102000,3,1,1,'2021-12-16 05:50:20','2021-12-16 05:52:15',NULL),
(5,'BPKAD/OPN/4','draft','2021-12-17','asd',68000,3,1,1,'2021-12-17 15:13:59','2021-12-17 15:43:18',NULL);

/*Table structure for table `tb_pemusnahan` */

DROP TABLE IF EXISTS `tb_pemusnahan`;

CREATE TABLE `tb_pemusnahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opname` int(11) DEFAULT NULL,
  `kode_pemusnahan` varchar(255) DEFAULT NULL,
  `tgl_pemusnahan` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status_pemusnahan` enum('draft','final','disetujui_ppbp','disetujui_kepalaPD','disetujui_timVerifikasi') DEFAULT NULL,
  `ket_pemusnahan` text DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opname` (`id_opname`),
  CONSTRAINT `tb_pemusnahan_ibfk_1` FOREIGN KEY (`id_opname`) REFERENCES `tb_opname` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pemusnahan` */

insert  into `tb_pemusnahan`(`id`,`id_opname`,`kode_pemusnahan`,`tgl_pemusnahan`,`total`,`status_pemusnahan`,`ket_pemusnahan`,`id_periode`,`id_opd`,`id_unit`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,'BPKAD/PMS/1','2021-01-01',40000,'final','test',1,1,1,'2021-12-16 01:42:07','2021-12-08 06:11:52',NULL),
(2,3,'BPKAD/PMS/2','2021-12-13',102000,'final','Test dinda 19.42',1,NULL,1,'2021-12-13 19:42:20','2021-12-13 11:42:20',NULL),
(3,4,'BPKAD/PMS/3','2021-12-16',102000,'final','pemusnahan',3,1,1,'2021-12-16 13:52:15','2021-12-16 05:52:15',NULL);

/*Table structure for table `tb_penerimaan` */

DROP TABLE IF EXISTS `tb_penerimaan`;

CREATE TABLE `tb_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_program` int(11) DEFAULT NULL,
  `id_m_kegiatan` int(11) DEFAULT NULL,
  `id_rekening` int(11) DEFAULT NULL,
  `kode_penerimaan` varchar(255) DEFAULT NULL,
  `jenis_penerimaan` enum('APBD Non Obat','APBD Obat','Hibah Non Obat','Hibah Obat','Non APBD') DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `diterima_dari` varchar(255) DEFAULT NULL,
  `status_penerimaan` enum('draft','final','digunakan') DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `ket_penerimaan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jenis_penerimaan` (`jenis_penerimaan`),
  KEY `id_periode` (`id_periode`),
  KEY `id_opd` (`id_opd`),
  KEY `id_m_kegiatan` (`id_m_kegiatan`),
  CONSTRAINT `tb_penerimaan_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_penerimaan_ibfk_2` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`),
  CONSTRAINT `tb_penerimaan_ibfk_3` FOREIGN KEY (`id_m_kegiatan`) REFERENCES `tb_master_kegiatan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penerimaan` */

insert  into `tb_penerimaan`(`id`,`id_m_program`,`id_m_kegiatan`,`id_rekening`,`kode_penerimaan`,`jenis_penerimaan`,`tgl_terima`,`diterima_dari`,`status_penerimaan`,`total`,`id_opd`,`id_periode`,`ket_penerimaan`,`created_at`,`updated_at`,`deleted_at`) values 
(9,1,1,1,'BPKAD/PNR/1','APBD Non Obat','2021-01-01','0','digunakan',188000,1,1,'dasd','2021-12-08 05:03:23','2021-12-08 05:06:26',NULL),
(11,1,1,1,'BPKAD/PNR/2','APBD Non Obat','2021-01-01','0','final',182000,1,1,'dasd','2021-12-08 05:05:22','2021-12-08 05:05:37',NULL),
(12,1,1,1,'BPKAD/PNR/3','APBD Non Obat','2021-01-01','11','draft',NULL,1,1,'test','2021-12-11 13:18:22','2021-12-11 13:18:22',NULL),
(13,1,1,1,'BPKAD/PNR/4','APBD Obat','2021-01-01','11','final',34000,1,1,'test test','2021-12-13 08:45:37','2021-12-13 08:45:47',NULL),
(14,1,1,1,'BPKAD/PNR/5','APBD Obat','2021-01-01','ppk','draft',NULL,1,1,'bla ba','2021-12-13 08:48:21','2021-12-13 08:48:21',NULL),
(15,1,1,1,'BPKAD/PNR/6','APBD Non Obat','2021-12-13','ppk','digunakan',182000,1,1,'coba dinda 19.32','2021-12-13 11:33:00','2021-12-13 11:35:54',NULL),
(16,1,1,1,'BPKAD/PNR/7','Hibah Non Obat','2021-12-13','ppk','final',68000,1,1,'coba lagi','2021-12-13 11:45:40','2021-12-13 11:45:49',NULL),
(17,1,1,1,'BPKAD/PNR/8','APBD Obat','2021-12-13','ppk','final',34000,1,1,'cek','2021-12-13 11:48:37','2021-12-13 11:48:46',NULL),
(18,1,1,1,'BPKAD/PNR/9','Hibah Obat','2021-12-13','ppk','final',40000,1,1,'coba','2021-12-13 11:49:08','2021-12-13 11:49:18',NULL),
(19,1,1,1,'BPKAD/PNR/10','Non APBD','2021-12-13','ppk','final',34000,1,1,'kfdlkf','2021-12-13 11:49:37','2021-12-13 11:49:53',NULL),
(20,1,1,1,'BPKAD/PNR/11','APBD Non Obat','2021-12-13','ppk','final',34000,1,1,'coba lagi','2021-12-13 12:40:08','2021-12-13 12:40:19',NULL),
(21,1,1,1,'BPKAD/PNR/12','Non APBD','2021-12-13','ppk','digunakan',170000,1,1,'coba lagi','2021-12-13 12:40:47','2021-12-16 05:39:56',NULL),
(22,1,1,1,'BPKAD/PNR/13','APBD Obat','2021-12-16','ppk','draft',102000,1,3,'penerimaan desember 2021','2021-12-16 05:31:19','2021-12-16 05:32:32',NULL),
(23,1,1,1,'BPKAD/PNR/14','APBD Non Obat','2021-12-17','ppk','draft',34000,1,3,'asd','2021-12-17 13:21:57','2021-12-17 13:33:58',NULL);

/*Table structure for table `tb_pengeluaran` */

DROP TABLE IF EXISTS `tb_pengeluaran`;

CREATE TABLE `tb_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_kegiatan` int(11) DEFAULT NULL,
  `kode_pengeluaran` varchar(255) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `ket_pengeluaran` text DEFAULT NULL,
  `status_pengeluaran` enum('draft','final') DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_periode` (`id_periode`),
  KEY `id_opd` (`id_unit`),
  KEY `id_m_kegiatan` (`id_m_kegiatan`),
  CONSTRAINT `tb_pengeluaran_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_pengeluaran_ibfk_4` FOREIGN KEY (`id_unit`) REFERENCES `tb_opd` (`id`),
  CONSTRAINT `tb_pengeluaran_ibfk_5` FOREIGN KEY (`id_m_kegiatan`) REFERENCES `tb_master_kegiatan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pengeluaran` */

insert  into `tb_pengeluaran`(`id`,`id_m_kegiatan`,`kode_pengeluaran`,`tgl_keluar`,`ket_pengeluaran`,`status_pengeluaran`,`total`,`id_periode`,`id_opd`,`id_unit`,`created_at`,`updated_at`,`deleted_at`) values 
(4,1,'BPKAD/PGL/1','2021-01-01','teste','draft',188000,1,1,1,'2021-12-08 05:20:08','2021-12-08 05:24:14',NULL),
(5,1,'BPKAD/PGL/2','2021-12-13','coba dinda 19.38','final',74000,1,1,1,'2021-12-13 11:38:12','2021-12-13 11:38:53',NULL),
(6,1,'BPKAD/PGL/3','2021-12-16','pengeluaran','final',170000,3,1,1,'2021-12-16 05:46:48','2021-12-16 05:49:17',NULL),
(7,1,'BPKAD/PGL/4','2021-12-17','asd','draft',34000,3,1,1,'2021-12-17 05:24:45','2021-12-17 14:59:18',NULL);

/*Table structure for table `tb_penggunaan` */

DROP TABLE IF EXISTS `tb_penggunaan`;

CREATE TABLE `tb_penggunaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penerimaan` int(11) DEFAULT NULL,
  `kode_penggunaan` varchar(255) DEFAULT NULL,
  `tgl_penggunaan` date DEFAULT NULL,
  `status_penggunaan` enum('draft','approved','final','disetujui_ppbp','disetujui_atasanLangsung') DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `ket_penggunaan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_penerimaan`),
  KEY `id_periode` (`id_periode`),
  KEY `id_opd` (`id_unit`),
  KEY `id_gudang_opd` (`id_opd`),
  CONSTRAINT `tb_penggunaan_ibfk_1` FOREIGN KEY (`id_penerimaan`) REFERENCES `tb_penerimaan` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_3` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_4` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penggunaan` */

insert  into `tb_penggunaan`(`id`,`id_penerimaan`,`kode_penggunaan`,`tgl_penggunaan`,`status_penggunaan`,`total`,`id_periode`,`id_opd`,`id_unit`,`ket_penggunaan`,`created_at`,`updated_at`,`deleted_at`) values 
(2,9,'BPKAD/PGN/1','2021-01-01','disetujui_atasanLangsung',188000,1,1,1,'asdas','2021-12-08 05:06:16','2021-12-08 05:07:14',NULL),
(3,21,'BPKAD/PGN/2','2021-12-13','disetujui_atasanLangsung',182000,1,1,1,'Coba dinda 19.35','2021-12-13 11:35:45','2021-12-13 11:37:01',NULL),
(4,21,'BPKAD/PGN/3','2021-12-16','approved',170000,3,1,1,'penggunaan','2021-12-16 05:38:27','2021-12-16 05:45:35',NULL);

/*Table structure for table `tb_periode` */

DROP TABLE IF EXISTS `tb_periode`;

CREATE TABLE `tb_periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opd` int(11) DEFAULT NULL,
  `nama_periode` varchar(255) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `status_periode` enum('open','close') DEFAULT NULL,
  `ket_periode` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_periode_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_periode` */

insert  into `tb_periode`(`id`,`id_opd`,`nama_periode`,`tgl_mulai`,`tgl_selesai`,`status_periode`,`ket_periode`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'Periode November 2021','2021-11-01','2021-12-01','close','Untuk November 2021','2021-12-04 04:21:19','2021-12-17 16:59:13',NULL),
(2,1,'Desember 2021','2021-12-01','2021-12-31','close','periode desember','2021-12-16 05:18:07','2021-12-16 05:19:42',NULL),
(3,1,'Januari 2022','2022-01-01','2022-01-31','open','Januari 2022','2021-12-16 05:19:42','2021-12-17 16:59:13',NULL);

/*Table structure for table `tb_permission` */

DROP TABLE IF EXISTS `tb_permission`;

CREATE TABLE `tb_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

/*Data for the table `tb_permission` */

insert  into `tb_permission`(`id`,`nama`,`id_jabatan`) values 
(1,'Lihat Periode',6),
(2,'Lihat Periode',1),
(3,'Lihat Periode',3),
(4,'Buat Periode',3),
(5,'Buka Periode',3),
(6,'Tutup Periode',3),
(7,'Lihat Saldo Awal',1),
(8,'Lihat Saldo Awal',6),
(9,'Lihat Saldo Awal',3),
(10,'Lihat Saldo Awal',7),
(11,'Buat Saldo Awal',7),
(12,'Edit Saldo Awal',7),
(13,'Delete Saldo Awal',7),
(14,'Final Saldo Awal',7),
(15,'Lihat Penerimaan',1),
(16,'Lihat Penerimaan',6),
(17,'Lihat Penerimaan',3),
(18,'Buat Penerimaan',3),
(19,'Edit Penerimaan',3),
(20,'Final Penerimaan',3),
(21,'Delete Penerimaan',3),
(22,'Lihat Penggunaan',1),
(23,'Lihat Penggunaan',6),
(24,'Lihat Penggunaan',3),
(25,'Lihat Penggunaan',4),
(26,'Lihat Penggunaan',5),
(27,'Lihat Penggunaan',7),
(28,'Buat Penggunaan',7),
(29,'Edit Penggunaan',7),
(30,'Delete Penggunaan',7),
(31,'Final Penggunaan',7),
(32,'Approved Penggunaan',4),
(33,'Disetujui PPBP Penggunaan',3),
(34,'Disetujui KASUBAG Penggunaan',5),
(35,'Lihat Pengeluaran',1),
(36,'Lihat Pengeluaran',6),
(37,'Lihat Pengeluaran',7),
(38,'Lihat Pengeluaran',3),
(39,'Lihat Pengeluaran',5),
(40,'Buat Pengeluaran',7),
(41,'Edit Pengeluaran',7),
(42,'Delete Pengeluaran',7),
(43,'Final Pengeluaran',7),
(44,'Lihat Opname',1),
(45,'Lihat Opname',6),
(46,'Lihat Opname',7),
(47,'Buat Opname',7),
(48,'Edit Opname',7),
(49,'Delete Opname',7),
(50,'Final Opname',7),
(51,'Lihat Pemusnahan',1),
(52,'Lihat Pemusnahan',6),
(53,'Lihat Pemusnahan',7),
(54,'Buat Pemusnahan',7),
(55,'Edit Pemusnahan',7),
(56,'Delete Pemusnahan',7),
(57,'Final Pemusnahan',7),
(58,'Lihat Master Barang',1),
(59,'Lihat Master Barang',6),
(60,'Buat Master Barang',1),
(61,'Buat Master Barang',6),
(62,'Edit Master Barang',1),
(63,'Edit Master Barang',6),
(64,'Delete Master Barang',1),
(65,'Delete Master Barang',6),
(66,'Lihat User',1),
(67,'Lihat User',6),
(68,'Buat User',1),
(69,'Buat User',6),
(70,'Edit User',1),
(71,'Edit User',6),
(72,'Delete User',1),
(73,'Delete User',6),
(74,'Edit Penggunaan',4),
(75,'Edit Penggunaan',3),
(76,'Edit Penggunaan',5),
(77,'Approved Penggunaan',4),
(78,'Disetujui PPBP Penggunaan',3),
(79,'Disetujui KASUBAG Penggunaan',5),
(80,'Edit Saldo Awal',3),
(81,'Lihat Opname',3),
(82,'Lihat Pemusnahan',3),
(83,'Lihat Pemusnahan',8),
(84,'Lihat Pemusnahan',10),
(85,'Disetujui PPBP Pemusnahan',3),
(86,'Disetujui Tim Verifikasi Pemusnahan',8),
(87,'Disetujui Kepala PD',10);

/*Table structure for table `tb_rekening` */

DROP TABLE IF EXISTS `tb_rekening`;

CREATE TABLE `tb_rekening` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rekening` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_rekening` */

insert  into `tb_rekening`(`id`,`nama_rekening`) values 
(1,'rekening 1');

/*Table structure for table `tb_saldo_awal` */

DROP TABLE IF EXISTS `tb_saldo_awal`;

CREATE TABLE `tb_saldo_awal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_saldo` varchar(255) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `status_saldo` enum('draft','final','closed') DEFAULT NULL,
  `ket_saldo` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_periode` (`id_periode`),
  KEY `id_opd` (`id_unit`),
  CONSTRAINT `tb_saldo_awal_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_saldo_awal_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo_awal` */

insert  into `tb_saldo_awal`(`id`,`kode_saldo`,`tgl_input`,`status_saldo`,`ket_saldo`,`total`,`id_periode`,`id_opd`,`id_unit`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'BPKAD/SDA/1','2021-11-01','final','Sisa Barang periode Oktober 2021',108000,1,1,1,'2021-12-04 04:21:52','2021-12-04 04:36:59',NULL),
(2,'BPKAD/SDA/2','2021-12-16','final','saldo awal 2022',204000,3,1,1,'2021-12-16 05:24:44','2021-12-16 05:28:32',NULL),
(3,'BPKAD/SDA/3','2021-12-16','draft','test',34000,3,1,1,'2021-12-16 15:02:22','2021-12-17 05:06:09',NULL);

/*Table structure for table `tb_test` */

DROP TABLE IF EXISTS `tb_test`;

CREATE TABLE `tb_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_test` */

insert  into `tb_test`(`id`,`id_barang`,`qty`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,5,'2021-12-07 14:07:42','2021-12-07 06:07:42',NULL),
(2,2,6,'2021-12-07 14:07:42','2021-12-07 06:07:42',NULL);

/*Table structure for table `tb_unit` */

DROP TABLE IF EXISTS `tb_unit`;

CREATE TABLE `tb_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opd` int(11) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_unit_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_unit` */

insert  into `tb_unit`(`id`,`id_opd`,`unit`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'Persediaan','2021-07-29 10:02:44','2021-07-29 10:02:46',NULL),
(2,1,'Aset','2021-07-29 10:02:49','2021-07-29 10:02:51',NULL),
(3,1,'Umum','2021-07-29 11:30:04','2021-07-29 11:30:07',NULL);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `tb_user_ibfk_3` (`id_unit`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_user_ibfk_3` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_user_ibfk_4` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`),
  CONSTRAINT `tb_user_ibfk_5` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`nama_user`,`dob`,`id_jabatan`,`id_unit`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'super_admin','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Super Admin','0000-00-00',6,1,1,NULL,NULL,NULL),
(2,'admin_bpkad','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','admin','2021-08-28',1,1,1,NULL,NULL,NULL),
(3,'ppbp','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','PPBP',NULL,3,1,1,NULL,NULL,NULL),
(4,'kasi','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','KASI',NULL,4,1,1,NULL,NULL,NULL),
(5,'kasubag','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Kasubag',NULL,5,1,1,NULL,NULL,NULL),
(10,'ppbpb','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','PPBPB',NULL,7,1,1,NULL,NULL,NULL),
(11,'ppk','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','ppk',NULL,9,1,1,NULL,NULL,NULL),
(12,'tim_pemusnahan','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','TIM Pemusnahan',NULL,8,1,1,NULL,NULL,NULL),
(13,'kepala_pd','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Kepala PD',NULL,10,1,1,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
