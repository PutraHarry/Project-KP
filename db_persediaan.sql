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

/*Table structure for table `tb_barang_gudang` */

DROP TABLE IF EXISTS `tb_barang_gudang`;

CREATE TABLE `tb_barang_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan_barang` varchar(255) DEFAULT NULL,
  `ket_barang` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barang_gudang` */

/*Table structure for table `tb_barang_opd` */

DROP TABLE IF EXISTS `tb_barang_opd`;

CREATE TABLE `tb_barang_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `kode_transaksi` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status` enum('Digunakan','Diterima') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  KEY `id_gudang` (`id_gudang`),
  CONSTRAINT `tb_barang_opd_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`),
  CONSTRAINT `tb_barang_opd_ibfk_2` FOREIGN KEY (`id_gudang`) REFERENCES `tb_opd_gudang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barang_opd` */

insert  into `tb_barang_opd`(`id`,`id_gudang`,`id_barang`,`kode_transaksi`,`jumlah`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(2,1,1,NULL,1,NULL,NULL,NULL,NULL),
(3,1,1,NULL,1,'Diterima','2021-11-15 08:19:03','2021-11-15 08:19:03',NULL);

/*Table structure for table `tb_barang_unit` */

DROP TABLE IF EXISTS `tb_barang_unit`;

CREATE TABLE `tb_barang_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `kode_transaksi` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status` enum('Digunakan','Diterima') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_gudang` (`id_gudang`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_barang_unit_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `tb_unit_gudang` (`id`),
  CONSTRAINT `tb_barang_unit_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_barang_unit` */

/*Table structure for table `tb_d_opname` */

DROP TABLE IF EXISTS `tb_d_opname`;

CREATE TABLE `tb_d_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opname` int(11) DEFAULT NULL,
  `id_barang_gudang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opname` (`id_opname`),
  KEY `id_barang_gudang` (`id_barang_gudang`),
  CONSTRAINT `tb_d_opname_ibfk_1` FOREIGN KEY (`id_opname`) REFERENCES `tb_opname` (`id`),
  CONSTRAINT `tb_d_opname_ibfk_2` FOREIGN KEY (`id_barang_gudang`) REFERENCES `tb_barang_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_opname` */

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_penerimaan` */

insert  into `tb_d_penerimaan`(`id`,`id_penerimaan`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(4,3,1,1,34000,'baik','2021-11-06 11:08:35','2021-11-06 11:08:35',NULL);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_pengeluaran` */

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_saldo` */

insert  into `tb_d_saldo`(`id`,`id_saldo`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(42,23,1,1,34000,'baik','2021-11-06 05:37:08','2021-11-06 05:37:08',NULL),
(43,23,2,1,40000,'baik','2021-11-06 05:46:33','2021-11-06 05:46:33',NULL),
(44,24,1,1,34000,'baik','2021-11-07 04:43:29','2021-11-07 04:43:29',NULL),
(45,24,2,1,40000,'baik','2021-11-07 04:48:17','2021-11-07 04:48:17',NULL),
(46,25,1,1,34000,'baik','2021-11-07 04:49:14','2021-11-07 04:49:14',NULL),
(47,25,2,1,40000,'baik','2021-11-07 04:49:28','2021-11-07 04:49:28',NULL),
(48,26,1,1,34000,'baik','2021-11-15 05:50:54','2021-11-15 05:50:54',NULL),
(49,26,2,2,80000,'baik','2021-11-15 05:53:12','2021-11-15 05:53:12',NULL),
(50,27,1,1,34000,'baik','2021-11-15 06:55:24','2021-11-15 06:55:24',NULL);

/*Table structure for table `tb_gudang` */

DROP TABLE IF EXISTS `tb_gudang`;

CREATE TABLE `tb_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_gudang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_gudang` */

/*Table structure for table `tb_jabatan` */

DROP TABLE IF EXISTS `tb_jabatan`;

CREATE TABLE `tb_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id`,`jabatan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Administrator',NULL,NULL,NULL),
(2,'PPBPB',NULL,NULL,NULL),
(3,'KASI',NULL,NULL,NULL),
(4,'PPBP',NULL,NULL,NULL),
(5,'Admin BPKAD',NULL,NULL,NULL),
(6,'Tim Verifikasi',NULL,NULL,NULL),
(7,'KADIS',NULL,NULL,NULL),
(8,'KASUBAG',NULL,NULL,NULL),
(9,'SEKDIS',NULL,NULL,NULL);

/*Table structure for table `tb_master_barang` */

DROP TABLE IF EXISTS `tb_master_barang`;

CREATE TABLE `tb_master_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_m_barang` varchar(255) DEFAULT NULL,
  `harga_m_barang` int(11) DEFAULT NULL,
  `satuan_m_barang` varchar(255) DEFAULT NULL,
  `jenis_m_barang` enum('KIB A','KIB B','KIB C','KIB D','KIB E','KIB F') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_master_barang` */

insert  into `tb_master_barang`(`id`,`nama_m_barang`,`harga_m_barang`,`satuan_m_barang`,`jenis_m_barang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Kertas HVS 70',34000,'Rim','KIB A',NULL,NULL,NULL),
(2,'Tinta Hitam',40000,'Buah','KIB B',NULL,NULL,NULL);

/*Table structure for table `tb_opd` */

DROP TABLE IF EXISTS `tb_opd`;

CREATE TABLE `tb_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_opd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_opd` */

insert  into `tb_opd`(`id`,`nama_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'BPKAD','2021-07-29 10:01:53','0000-00-00 00:00:00','0000-00-00 00:00:00'),
(2,'Kominfo',NULL,NULL,NULL);

/*Table structure for table `tb_opd_gudang` */

DROP TABLE IF EXISTS `tb_opd_gudang`;

CREATE TABLE `tb_opd_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opd` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  KEY `id_gudang` (`nama`),
  CONSTRAINT `tb_opd_gudang_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_opd_gudang` */

insert  into `tb_opd_gudang`(`id`,`id_opd`,`nama`) values 
(1,1,'Gudang BPKAD');

/*Table structure for table `tb_opname` */

DROP TABLE IF EXISTS `tb_opname`;

CREATE TABLE `tb_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_opname` varchar(255) DEFAULT NULL,
  `status_opname` enum('draft','final') DEFAULT NULL,
  `tgl_opname` date DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_periode` (`id_periode`),
  CONSTRAINT `tb_opname_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_opname` */

/*Table structure for table `tb_penerimaan` */

DROP TABLE IF EXISTS `tb_penerimaan`;

CREATE TABLE `tb_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_penerimaan` varchar(255) DEFAULT NULL,
  `jenis_penerimaan` enum('APBD Non Obat','APBD Obat','Hibah Non Obat','Hibah Obat','Non APBD') DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `pengirim` varchar(255) DEFAULT NULL,
  `status_penerimaan` enum('draft','final') DEFAULT NULL,
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
  CONSTRAINT `tb_penerimaan_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_penerimaan_ibfk_2` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penerimaan` */

insert  into `tb_penerimaan`(`id`,`kode_penerimaan`,`jenis_penerimaan`,`tgl_terima`,`pengirim`,`status_penerimaan`,`total`,`id_opd`,`id_periode`,`ket_penerimaan`,`created_at`,`updated_at`,`deleted_at`) values 
(3,'BPKAD/PNR/1','APBD Obat','2021-01-01','orang a','draft',34000,1,2,'test1','2021-11-06 10:51:40','2021-11-06 11:08:35',NULL);

/*Table structure for table `tb_pengeluaran` */

DROP TABLE IF EXISTS `tb_pengeluaran`;

CREATE TABLE `tb_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengeluaran` varchar(255) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `ket_pengeluaran` text DEFAULT NULL,
  `status_pengeluaran` enum('draft','final') DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_penggunaan` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_periode` (`id_periode`),
  KEY `id_penggunaan` (`id_penggunaan`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_pengeluaran_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_pengeluaran_ibfk_3` FOREIGN KEY (`id_penggunaan`) REFERENCES `tb_penggunaan` (`id`),
  CONSTRAINT `tb_pengeluaran_ibfk_4` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pengeluaran` */

insert  into `tb_pengeluaran`(`id`,`kode_pengeluaran`,`tgl_keluar`,`ket_pengeluaran`,`status_pengeluaran`,`id_periode`,`id_penggunaan`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(2,'BPKAD/PGL/1','2021-01-01','test1','draft',2,33,1,'2021-11-06 11:17:05','2021-11-06 11:17:05',NULL);

/*Table structure for table `tb_penggunaan` */

DROP TABLE IF EXISTS `tb_penggunaan`;

CREATE TABLE `tb_penggunaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penerimaan` int(11) DEFAULT NULL,
  `kode_penggunaan` varchar(255) DEFAULT NULL,
  `tgl_penggunaan` date DEFAULT NULL,
  `gudang_asal` varchar(255) DEFAULT NULL,
  `gudang_tujuan` varchar(255) DEFAULT NULL,
  `status_penggunaan` enum('draft','approved','final','disetujui') DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `ket_penggunaan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_penerimaan`),
  KEY `id_periode` (`id_periode`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_penggunaan_ibfk_1` FOREIGN KEY (`id_penerimaan`) REFERENCES `tb_penerimaan` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_3` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penggunaan` */

insert  into `tb_penggunaan`(`id`,`id_penerimaan`,`kode_penggunaan`,`tgl_penggunaan`,`gudang_asal`,`gudang_tujuan`,`status_penggunaan`,`id_periode`,`id_opd`,`ket_penggunaan`,`created_at`,`updated_at`,`deleted_at`) values 
(33,3,'BPKAD/PGN/1','2021-01-01','BPKAD','Persediaan','draft',2,1,'test1','2021-11-06 11:07:48','2021-11-06 11:07:48',NULL),
(34,3,'BPKAD/PGN/2','2021-01-01','BPKAD','Persediaan','draft',2,1,'test','2021-11-06 11:09:41','2021-11-06 11:09:41',NULL);

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
(1,2,'Juli 2021','2021-07-01','2021-07-31','open','Periode Juli 2021','0000-00-00 00:00:00','2021-09-13 16:26:27',NULL),
(2,1,'Periode Januari 2022','2022-01-01','2022-01-31','close','periode janua 2022','2021-09-05 16:30:32','2021-11-07 08:26:42',NULL),
(4,1,'Februari 2022','2022-02-01','2022-02-28','open','Februari 2022','2021-11-07 08:26:42','2021-11-07 08:26:42',NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_periode` (`id_periode`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_saldo_awal_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_saldo_awal_ibfk_2` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo_awal` */

insert  into `tb_saldo_awal`(`id`,`kode_saldo`,`tgl_input`,`status_saldo`,`ket_saldo`,`total`,`id_periode`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(23,'BPKAD/SDA/1','2021-01-01','final','test1',74000,2,1,'2021-11-06 05:36:37','2021-11-06 15:47:24',NULL),
(24,'BPKAD/SDA/2','2021-01-01','final','test',74000,1,1,'2021-11-07 04:43:20','2021-11-07 04:48:17',NULL),
(25,'BPKAD/SDA/3','2021-01-01','final','test2',74000,1,1,'2021-11-07 04:49:10','2021-11-07 04:50:03',NULL),
(26,'BPKAD/SDA/4','2021-01-01','final','test',114000,1,1,'2021-11-15 05:50:50','2021-11-15 06:48:44',NULL),
(27,'BPKAD/SDA/5','2021-02-01','final','test',34000,4,1,'2021-11-15 06:55:19','2021-11-15 07:45:52',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_unit` */

insert  into `tb_unit`(`id`,`id_opd`,`unit`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'Persediaan','2021-07-29 10:02:44','2021-07-29 10:02:46',NULL),
(2,1,'Aset','2021-07-29 10:02:49','2021-07-29 10:02:51',NULL),
(3,2,'Umum','2021-07-29 11:30:04','2021-07-29 11:30:07',NULL),
(4,1,'keuangan',NULL,NULL,NULL);

/*Table structure for table `tb_unit_gudang` */

DROP TABLE IF EXISTS `tb_unit_gudang`;

CREATE TABLE `tb_unit_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_unit` (`id_unit`),
  KEY `id_gudang` (`nama`),
  CONSTRAINT `tb_unit_gudang_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_unit_gudang_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_unit_gudang` */

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
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id`),
  CONSTRAINT `tb_user_ibfk_3` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_user_ibfk_4` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`nama_user`,`dob`,`id_jabatan`,`id_unit`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'super_admin','$2y$10$6.4OsPZXkTRcucF8q6CbJexVF7xgKQJVr8bS9Kh7v6kCmRfdMTPJ6','Super Admin','2021-01-01',1,1,1,NULL,NULL,NULL),
(2,'admin_bpkad','$2y$10$09vwfFubuwO3OdVfGWzv9.HQpKZni8rGYFohmknf//PdP9xKM5ml2','Admin BPKAD','2021-01-01',5,1,1,NULL,NULL,NULL),
(3,'ppbpb_bpkad','$2y$10$Hls6HR..BZsxdLPvc5vpyuxrxufuaJDkx2ol7d5eiOfclU3mf8u9.','PPBPB','2021-01-01',2,1,1,NULL,NULL,NULL),
(4,'kasi','$2y$10$.yqtNbo2di7F9yRFze8K3.jg6WVKlanRA7AiRwLzQQ2IS85LwW2Wq','KASI','2021-01-01',3,1,1,NULL,NULL,NULL),
(5,'ppbp_bpkad','$2y$10$R9nB0JknUDsPKnNRYe3lx.uT3fWQsVJxUokIXlsRqOJM/gVzM14.G','PPBP','2021-01-01',4,1,1,NULL,NULL,NULL),
(6,'tim_verifikasi','$2y$10$d65Gx88kFhVtqmrmGmEFReqkHEpHVw7nxtO.NoC1VRzllmB/bX7bq','Tim Verifikasi','2021-01-01',6,1,1,NULL,NULL,NULL),
(7,'kadis','$2y$10$vX3.8e3PDoINmSr41z1MY.243TDFNeLcubEdmHd4./N4bkQhEJTba','KADIS','2021-01-01',7,1,1,NULL,NULL,NULL),
(8,'kasubag','$2y$10$MyTSbLEQhxynPjHE.eiKcOC7eT3wj3tRmdL/ijZbo8pcltWKW5jwW','KASUBAG','2021-01-01',8,1,1,NULL,NULL,NULL),
(9,'sekdis','$2y$10$87PmN9BAireT/Ta01uOYj.26S1KEzO6RBDzJnIdXjdAappJ6ID7TK','SEKDIS','2021-01-01',9,1,1,NULL,NULL,NULL),
(10,'ppbp_kominfo','$2y$10$jta3gXZcBDDFyjOQylnlpuuOGzyqTffKPQBPVjY0yoYGbx2g0i1/C','PPBP Kominfo','2021-01-01',4,3,2,NULL,NULL,NULL),
(11,'ppbpb_kominfo','$2y$10$n/D.0.WtErs.bSokFzV2.uA.n7K2mmQoZUhE/rCix8eQTb507aE9K','PPBPB Kominfo','2021-01-01',1,3,2,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
