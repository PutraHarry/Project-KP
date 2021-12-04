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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_persediaan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_persediaan`;

/*Table structure for table `tb_barang_opd` */

DROP TABLE IF EXISTS `tb_barang_opd`;

CREATE TABLE `tb_barang_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `kode_transaksi` varchar(255) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan_barang` varchar(255) DEFAULT NULL,
  `status` enum('Diterima','Digunakan') DEFAULT NULL,
  `ket_barang` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  KEY `id_gudang` (`id_gudang`),
  CONSTRAINT `tb_barang_opd_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`),
  CONSTRAINT `tb_barang_opd_ibfk_2` FOREIGN KEY (`id_gudang`) REFERENCES `tb_opd_gudang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barang_opd` */

insert  into `tb_barang_opd`(`id`,`id_gudang`,`id_barang`,`kode_transaksi`,`harga_barang`,`qty`,`satuan_barang`,`status`,`ket_barang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,'BPKAD/SDA/1',NULL,2,NULL,'Diterima',NULL,'2021-12-04 04:36:59','2021-12-04 04:36:59',NULL),
(2,1,2,'BPKAD/SDA/1',NULL,1,NULL,'Diterima',NULL,'2021-12-04 04:36:59','2021-12-04 04:36:59',NULL);

/*Table structure for table `tb_barang_unit` */

DROP TABLE IF EXISTS `tb_barang_unit`;

CREATE TABLE `tb_barang_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `kode_transaksi` varchar(255) DEFAULT NULL,
  `satuan_barang` varchar(255) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `status` enum('Diterima','Digunakan') DEFAULT NULL,
  `ket_barang` enum('Baik','Rusak') DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_penerimaan` */

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_saldo` */

insert  into `tb_d_saldo`(`id`,`id_saldo`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,2,68000,'baik','2021-12-04 04:23:52','2021-12-04 04:23:52',NULL),
(2,1,2,1,40000,'baik','2021-12-04 04:24:00','2021-12-04 04:24:00',NULL);

/*Table structure for table `tb_jabatan` */

DROP TABLE IF EXISTS `tb_jabatan`;

CREATE TABLE `tb_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id`,`jabatan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Administrator',NULL,NULL,NULL),
(2,'Staf Bidang',NULL,NULL,NULL),
(3,'PPBP',NULL,NULL,NULL),
(4,'Kabid',NULL,NULL,NULL),
(5,'Kasubag',NULL,NULL,NULL);

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

/*Table structure for table `tb_master_kegiatan` */

DROP TABLE IF EXISTS `tb_master_kegiatan`;

CREATE TABLE `tb_master_kegiatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) DEFAULT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_master_kegiatan` */

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

/*Table structure for table `tb_opd_gudang` */

DROP TABLE IF EXISTS `tb_opd_gudang`;

CREATE TABLE `tb_opd_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opd` int(11) DEFAULT NULL,
  `nama_gudang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_opd_gudang_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_opd_gudang` */

insert  into `tb_opd_gudang`(`id`,`id_opd`,`nama_gudang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'Gudang BPKAD',NULL,NULL,NULL);

/*Table structure for table `tb_opname` */

DROP TABLE IF EXISTS `tb_opname`;

CREATE TABLE `tb_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_kegiatan` int(11) DEFAULT NULL,
  `kode_opname` varchar(255) DEFAULT NULL,
  `status_opname` enum('draft','final') DEFAULT NULL,
  `tgl_opname` date DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_periode` (`id_periode`),
  KEY `id_m_kegiatan` (`id_m_kegiatan`),
  CONSTRAINT `tb_opname_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_opname_ibfk_2` FOREIGN KEY (`id_m_kegiatan`) REFERENCES `tb_master_kegiatan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_opname` */

/*Table structure for table `tb_pemusnahan` */

DROP TABLE IF EXISTS `tb_pemusnahan`;

CREATE TABLE `tb_pemusnahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opname` int(11) DEFAULT NULL,
  `tgl_pemusnahan` date DEFAULT NULL,
  `id_m_kegiatan` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opname` (`id_opname`),
  KEY `id_m_kegiatan` (`id_m_kegiatan`),
  CONSTRAINT `tb_pemusnahan_ibfk_1` FOREIGN KEY (`id_opname`) REFERENCES `tb_opname` (`id`),
  CONSTRAINT `tb_pemusnahan_ibfk_2` FOREIGN KEY (`id_m_kegiatan`) REFERENCES `tb_master_kegiatan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_pemusnahan` */

/*Table structure for table `tb_penerimaan` */

DROP TABLE IF EXISTS `tb_penerimaan`;

CREATE TABLE `tb_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_kegiatan` int(11) DEFAULT NULL,
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
  KEY `id_m_kegiatan` (`id_m_kegiatan`),
  CONSTRAINT `tb_penerimaan_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_penerimaan_ibfk_2` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`),
  CONSTRAINT `tb_penerimaan_ibfk_3` FOREIGN KEY (`id_m_kegiatan`) REFERENCES `tb_master_kegiatan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penerimaan` */

/*Table structure for table `tb_pengeluaran` */

DROP TABLE IF EXISTS `tb_pengeluaran`;

CREATE TABLE `tb_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_kegiatan` int(11) DEFAULT NULL,
  `kode_pengeluaran` varchar(255) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `ket_pengeluaran` text DEFAULT NULL,
  `status_pengeluaran` enum('draft','final') DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_penggunaan` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_periode` (`id_periode`),
  KEY `id_penggunaan` (`id_penggunaan`),
  KEY `id_opd` (`id_unit`),
  KEY `id_m_kegiatan` (`id_m_kegiatan`),
  CONSTRAINT `tb_pengeluaran_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_pengeluaran_ibfk_3` FOREIGN KEY (`id_penggunaan`) REFERENCES `tb_penggunaan` (`id`),
  CONSTRAINT `tb_pengeluaran_ibfk_4` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_pengeluaran_ibfk_5` FOREIGN KEY (`id_m_kegiatan`) REFERENCES `tb_master_kegiatan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pengeluaran` */

/*Table structure for table `tb_penggunaan` */

DROP TABLE IF EXISTS `tb_penggunaan`;

CREATE TABLE `tb_penggunaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_kegiatan` int(11) DEFAULT NULL,
  `id_penerimaan` int(11) DEFAULT NULL,
  `tgl_penggunaan` date DEFAULT NULL,
  `id_gudang_opd` int(11) DEFAULT NULL,
  `id_gudang_unit` int(11) DEFAULT NULL,
  `status_penggunaan` enum('draft','approved','final','disetujui') DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `ket_penggunaan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_penerimaan`),
  KEY `id_periode` (`id_periode`),
  KEY `id_opd` (`id_unit`),
  KEY `id_gudang_opd` (`id_gudang_opd`),
  KEY `id_gudang_unit` (`id_gudang_unit`),
  KEY `id_m_kegiatan` (`id_m_kegiatan`),
  CONSTRAINT `tb_penggunaan_ibfk_1` FOREIGN KEY (`id_penerimaan`) REFERENCES `tb_penerimaan` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_3` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_4` FOREIGN KEY (`id_gudang_opd`) REFERENCES `tb_opd_gudang` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_5` FOREIGN KEY (`id_gudang_unit`) REFERENCES `tb_unit_gudang` (`id`),
  CONSTRAINT `tb_penggunaan_ibfk_6` FOREIGN KEY (`id_m_kegiatan`) REFERENCES `tb_master_kegiatan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penggunaan` */

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_periode` */

insert  into `tb_periode`(`id`,`id_opd`,`nama_periode`,`tgl_mulai`,`tgl_selesai`,`status_periode`,`ket_periode`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'Periode November 2021','2021-11-01','2021-12-01','open','Untuk November 2021','2021-12-04 04:21:19','2021-12-04 04:21:19',NULL);

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
  `id_unit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_periode` (`id_periode`),
  KEY `id_opd` (`id_unit`),
  CONSTRAINT `tb_saldo_awal_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_saldo_awal_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo_awal` */

insert  into `tb_saldo_awal`(`id`,`kode_saldo`,`tgl_input`,`status_saldo`,`ket_saldo`,`total`,`id_periode`,`id_unit`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'BPKAD/SDA/1','2021-11-01','final','Sisa Barang periode Oktober 2021',108000,1,1,'2021-12-04 04:21:52','2021-12-04 04:36:59',NULL);

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

/*Table structure for table `tb_unit_gudang` */

DROP TABLE IF EXISTS `tb_unit_gudang`;

CREATE TABLE `tb_unit_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` int(11) DEFAULT NULL,
  `nama_gudang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_unit` (`id_unit`),
  CONSTRAINT `tb_unit_gudang_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_unit_gudang_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_unit_gudang` */

insert  into `tb_unit_gudang`(`id`,`id_unit`,`nama_gudang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'Gudang Persediaan',NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`nama_user`,`dob`,`id_jabatan`,`id_unit`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'super_admin','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Super Admin','0000-00-00',1,1,1,NULL,NULL,NULL),
(2,'staf_bidang','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','admin','2021-08-28',2,1,1,NULL,NULL,NULL),
(3,'ppbp','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','PPBP',NULL,3,1,1,NULL,NULL,NULL),
(4,'kabid','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Kabid',NULL,4,1,1,NULL,NULL,NULL),
(5,'kasubag','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Kasubag',NULL,5,1,1,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
