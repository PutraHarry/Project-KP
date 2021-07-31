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

/*Table structure for table `tb_barang_gudang` */

DROP TABLE IF EXISTS `tb_barang_gudang`;

CREATE TABLE `tb_barang_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan_barang` int(11) DEFAULT NULL,
  `ket_barang` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_barang_gudang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barang_gudang` */

insert  into `tb_barang_gudang`(`id`,`id_barang`,`harga_barang`,`qty`,`satuan_barang`,`ket_barang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,34000,1,0,'baik',NULL,NULL,NULL);

/*Table structure for table `tb_bu` */

DROP TABLE IF EXISTS `tb_bu`;

CREATE TABLE `tb_bu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_BU` varchar(255) DEFAULT NULL,
  `tgl_BU` date DEFAULT NULL,
  `ket_BU` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_bu` */

insert  into `tb_bu`(`id`,`no_BU`,`tgl_BU`,`ket_BU`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'BPKAD/12/A','2021-07-31','Penerimaan Tinta dari Kominfo\r\n',NULL,NULL,NULL),
(2,'BPKAD/11/B','2021-07-30','Penerimaan Obat',NULL,NULL,NULL),
(3,'BPKAD/11/D','2021-07-31','Penggunaan Kertas',NULL,NULL,NULL);

/*Table structure for table `tb_d_bu` */

DROP TABLE IF EXISTS `tb_d_bu`;

CREATE TABLE `tb_d_bu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_BU` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_BU`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_d_bu_ibfk_1` FOREIGN KEY (`id_BU`) REFERENCES `tb_bu` (`id`),
  CONSTRAINT `tb_d_bu_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_bu` */

insert  into `tb_d_bu`(`id`,`id_BU`,`id_barang`,`qty`,`harga`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,2,2,40000,NULL,NULL,NULL),
(2,3,1,1,34000,NULL,NULL,NULL);

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
  CONSTRAINT `tb_d_opname_ibfk_2` FOREIGN KEY (`id_barang_gudang`) REFERENCES `tb_barang_gudang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_opname` */

insert  into `tb_d_opname`(`id`,`id_opname`,`id_barang_gudang`,`qty`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,1,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_saldo` */

insert  into `tb_d_saldo`(`id`,`id_saldo`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,2,34000,'baik',NULL,NULL,NULL);

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
(1,'Super Admin',NULL,NULL,NULL),
(2,'Staf Bidang',NULL,NULL,NULL),
(3,'PPBP',NULL,NULL,NULL),
(4,'Kabid',NULL,NULL,NULL),
(5,'Kasubag',NULL,NULL,NULL);

/*Table structure for table `tb_jenis_penerimaan` */

DROP TABLE IF EXISTS `tb_jenis_penerimaan`;

CREATE TABLE `tb_jenis_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jenis_penerimaan` */

insert  into `tb_jenis_penerimaan`(`id`,`jenis`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Non Obat',NULL,NULL,NULL),
(2,'Obat',NULL,NULL,NULL),
(3,'Hibah Non Obat',NULL,NULL,NULL),
(4,'Hibah Obat',NULL,NULL,NULL),
(5,'Non APBD',NULL,NULL,NULL);

/*Table structure for table `tb_master_barang` */

DROP TABLE IF EXISTS `tb_master_barang`;

CREATE TABLE `tb_master_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_m_barang` varchar(255) DEFAULT NULL,
  `harga_m_barang` int(11) DEFAULT NULL,
  `satuan_m_barang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_master_barang` */

insert  into `tb_master_barang`(`id`,`nama_m_barang`,`harga_m_barang`,`satuan_m_barang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Kertas HVS 70',34000,'Rim',NULL,NULL,NULL),
(2,'Tinta Hitam',40000,'Buah',NULL,NULL,NULL);

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

/*Table structure for table `tb_opname` */

DROP TABLE IF EXISTS `tb_opname`;

CREATE TABLE `tb_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_opname` varchar(255) DEFAULT NULL,
  `status_opname` enum('draft','final') DEFAULT NULL,
  `tgl_opname` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_opname` */

insert  into `tb_opname`(`id`,`kode_opname`,`status_opname`,`tgl_opname`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'AAA/12/A','draft','2021-07-31',NULL,NULL,NULL);

/*Table structure for table `tb_penerimaan` */

DROP TABLE IF EXISTS `tb_penerimaan`;

CREATE TABLE `tb_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_penerimaan` int(11) DEFAULT NULL,
  `id_BU` int(11) DEFAULT NULL,
  `kode_penerimaan` varchar(255) DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `pengirim` varchar(255) DEFAULT NULL,
  `status_penerimaan` enum('draft','final') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jenis_penerimaan` (`id_jenis_penerimaan`),
  KEY `id_BU` (`id_BU`),
  CONSTRAINT `tb_penerimaan_ibfk_1` FOREIGN KEY (`id_jenis_penerimaan`) REFERENCES `tb_jenis_penerimaan` (`id`),
  CONSTRAINT `tb_penerimaan_ibfk_2` FOREIGN KEY (`id_BU`) REFERENCES `tb_bu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penerimaan` */

insert  into `tb_penerimaan`(`id`,`id_jenis_penerimaan`,`id_BU`,`kode_penerimaan`,`tgl_terima`,`pengirim`,`status_penerimaan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,5,1,'KOM/123/A','2021-07-31','Suardana','final',NULL,NULL,NULL);

/*Table structure for table `tb_pengeluaran` */

DROP TABLE IF EXISTS `tb_pengeluaran`;

CREATE TABLE `tb_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengeluaran` varchar(255) DEFAULT NULL,
  `id_BU` int(11) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `ket_pengeluaran` text DEFAULT NULL,
  `status_pengeluaran` enum('draft','final') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_BU`),
  CONSTRAINT `tb_pengeluaran_ibfk_1` FOREIGN KEY (`id_BU`) REFERENCES `tb_bu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pengeluaran` */

insert  into `tb_pengeluaran`(`id`,`kode_pengeluaran`,`id_BU`,`tgl_keluar`,`ket_pengeluaran`,`status_pengeluaran`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'BPKAD/123/A',3,'2021-07-31','Kertas\r\n','final',NULL,NULL,NULL);

/*Table structure for table `tb_penggunaan` */

DROP TABLE IF EXISTS `tb_penggunaan`;

CREATE TABLE `tb_penggunaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_penggunaan` date DEFAULT NULL,
  `id_BU` int(11) DEFAULT NULL,
  `status_penggunaan` enum('draft','approved','final','disetujui') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_BU`),
  CONSTRAINT `tb_penggunaan_ibfk_1` FOREIGN KEY (`id_BU`) REFERENCES `tb_bu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penggunaan` */

insert  into `tb_penggunaan`(`id`,`tgl_penggunaan`,`id_BU`,`status_penggunaan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'2021-07-30',3,'disetujui',NULL,NULL,NULL);

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
(1,1,'Juli 2021','2021-07-01','2021-07-31','open','Periode Juli 2021','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);

/*Table structure for table `tb_saldo_awal` */

DROP TABLE IF EXISTS `tb_saldo_awal`;

CREATE TABLE `tb_saldo_awal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_saldo` varchar(255) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `status_saldo` enum('draft','final','closed') DEFAULT NULL,
  `ket_saldo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo_awal` */

insert  into `tb_saldo_awal`(`id`,`kode_saldo`,`tgl_input`,`status_saldo`,`ket_saldo`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'ABC/123/D','2021-07-29','draft','Testing','2021-07-30 00:53:13','2021-07-30 01:30:44',NULL);

/*Table structure for table `tb_unit` */

DROP TABLE IF EXISTS `tb_unit`;

CREATE TABLE `tb_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_unit_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_unit` */

insert  into `tb_unit`(`id`,`unit`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Persediaan',1,'2021-07-29 10:02:44','2021-07-29 10:02:46',NULL),
(2,'Aset',1,'2021-07-29 10:02:49','2021-07-29 10:02:51',NULL),
(3,'Umum',2,'2021-07-29 11:30:04','2021-07-29 11:30:07',NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `tb_user_ibfk_3` (`id_unit`),
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id`),
  CONSTRAINT `tb_user_ibfk_3` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`nama_user`,`dob`,`id_jabatan`,`id_unit`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'admin','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Super Admin','0000-00-00',1,1,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
=======
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

/*Table structure for table `tb_barang_gudang` */

DROP TABLE IF EXISTS `tb_barang_gudang`;

CREATE TABLE `tb_barang_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan_barang` int(11) DEFAULT NULL,
  `ket_barang` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_barang_gudang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barang_gudang` */

/*Table structure for table `tb_bu` */

DROP TABLE IF EXISTS `tb_bu`;

CREATE TABLE `tb_bu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_BU` varchar(255) DEFAULT NULL,
  `tgl_BU` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_BU` (`id_BU`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_d_bu_ibfk_1` FOREIGN KEY (`id_BU`) REFERENCES `tb_bu` (`id`),
  CONSTRAINT `tb_d_bu_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_bu` */

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
  CONSTRAINT `tb_d_opname_ibfk_2` FOREIGN KEY (`id_barang_gudang`) REFERENCES `tb_barang_gudang` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_opname` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_saldo` */

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
(1,'Super Admin',NULL,NULL,NULL),
(2,'Staf Bidang',NULL,NULL,NULL),
(3,'PPBP',NULL,NULL,NULL),
(4,'Kabid',NULL,NULL,NULL),
(5,'Kasubag',NULL,NULL,NULL);

/*Table structure for table `tb_jenis_penerimaan` */

DROP TABLE IF EXISTS `tb_jenis_penerimaan`;

CREATE TABLE `tb_jenis_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jenis_penerimaan` */

/*Table structure for table `tb_master_barang` */

DROP TABLE IF EXISTS `tb_master_barang`;

CREATE TABLE `tb_master_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_m_barang` varchar(255) DEFAULT NULL,
  `harga_m_barang` int(11) DEFAULT NULL,
  `satuan_m_barang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_master_barang` */

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
(1,'BPKAD','2021-07-29 10:01:53','2021-07-29 10:01:56','2021-07-29 10:01:57');

/*Table structure for table `tb_opname` */

DROP TABLE IF EXISTS `tb_opname`;

CREATE TABLE `tb_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_opname` varchar(255) DEFAULT NULL,
  `status_opname` enum('draft','final') DEFAULT NULL,
  `tgl_opname` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_opname` */

/*Table structure for table `tb_penerimaan` */

DROP TABLE IF EXISTS `tb_penerimaan`;

CREATE TABLE `tb_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_penerimaan` int(11) DEFAULT NULL,
  `id_BU` int(11) DEFAULT NULL,
  `kode_penerimaan` varchar(255) DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `pengirim` varchar(255) DEFAULT NULL,
  `status_penerimaan` enum('draft','final') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
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
  `kode_pengeluaran` varchar(255) DEFAULT NULL,
  `id_BU` int(11) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `ket_pengeluaran` text DEFAULT NULL,
  `status_pengeluaran` enum('draft','final') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
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
  `status_penggunaan` enum('draft','approved','final','disetujui') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_periode` */

/*Table structure for table `tb_saldo_awal` */

DROP TABLE IF EXISTS `tb_saldo_awal`;

CREATE TABLE `tb_saldo_awal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_saldo` varchar(255) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `status_saldo` enum('draft','final','closed') DEFAULT NULL,
  `ket_saldo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo_awal` */

/*Table structure for table `tb_unit` */

DROP TABLE IF EXISTS `tb_unit`;

CREATE TABLE `tb_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) DEFAULT NULL,
  `id_opd` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_unit_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_unit` */

insert  into `tb_unit`(`id`,`unit`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Persediaan',1,'2021-07-29 10:02:44','2021-07-29 10:02:46','2021-07-29 10:02:47'),
(2,'Persediaan',1,'2021-07-29 10:02:49','2021-07-29 10:02:51','2021-07-29 10:02:53');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `tb_user_ibfk_3` (`id_unit`),
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id`),
  CONSTRAINT `tb_user_ibfk_3` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`nama_user`,`dob`,`id_jabatan`,`id_unit`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'admin','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Super Admin','0000-00-00',1,1,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
