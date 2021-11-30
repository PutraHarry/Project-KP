@ -1,6 +1,6 @@
/*
SQLyog Enterprise v13.1.1 (32 bit)
MySQL - 10.4.8-MariaDB : Database - db_persediaan
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.6-MariaDB : Database - db_persediaan
*********************************************************************
*/

@ -12,7 +12,7 @@ MySQL - 10.4.8-MariaDB : Database - db_persediaan
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_persediaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_persediaan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_persediaan`;

@ -31,15 +31,11 @@ CREATE TABLE `tb_barang_gudang` (
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_barang_gudang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`)
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_barang_gudang` */

insert  into `tb_barang_gudang`(`id`,`id_barang`,`harga_barang`,`qty`,`satuan_barang`,`ket_barang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,34000,1,'0','baik',NULL,NULL,NULL);

/*Table structure for table `tb_barang_opd` */

DROP TABLE IF EXISTS `tb_barang_opd`;
@ -48,10 +44,7 @@ CREATE TABLE `tb_barang_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan_barang` int(11) DEFAULT NULL,
  `ket_barang` enum('baik','rusak') DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
@ -64,9 +57,6 @@ CREATE TABLE `tb_barang_opd` (

/*Data for the table `tb_barang_opd` */

insert  into `tb_barang_opd`(`id`,`id_gudang`,`id_barang`,`harga_barang`,`qty`,`satuan_barang`,`ket_barang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,NULL,1,34000,1,0,'baik',NULL,NULL,NULL);

/*Table structure for table `tb_barang_unit` */

DROP TABLE IF EXISTS `tb_barang_unit`;
@ -75,6 +65,10 @@ CREATE TABLE `tb_barang_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_gudang` (`id_gudang`),
  KEY `id_barang` (`id_barang`),
@ -105,9 +99,6 @@ CREATE TABLE `tb_d_opname` (

/*Data for the table `tb_d_opname` */

insert  into `tb_d_opname`(`id`,`id_opname`,`id_barang_gudang`,`qty`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,1,NULL,NULL,NULL);

/*Table structure for table `tb_d_penerimaan` */

DROP TABLE IF EXISTS `tb_d_penerimaan`;
@ -131,11 +122,6 @@ CREATE TABLE `tb_d_penerimaan` (

/*Data for the table `tb_d_penerimaan` */

insert  into `tb_d_penerimaan`(`id`,`id_penerimaan`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,1,1,34000,'baik','2021-09-25 05:58:40','2021-09-25 05:58:40',NULL),
(2,1,1,2,68000,'baik','2021-10-03 22:04:58','2021-10-03 22:04:58',NULL),
(3,1,2,3,102000,'baik','2021-10-03 22:05:05','2021-10-03 22:05:05',NULL);

/*Table structure for table `tb_d_pengeluaran` */

DROP TABLE IF EXISTS `tb_d_pengeluaran`;
@ -178,9 +164,6 @@ CREATE TABLE `tb_d_penggunaan` (

/*Data for the table `tb_d_penggunaan` */

insert  into `tb_d_penggunaan`(`id`,`id_penggunaan`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,32,1,1,34000,'baik','2021-10-03 06:04:32','2021-10-03 06:04:32',NULL);

/*Table structure for table `tb_d_saldo` */

DROP TABLE IF EXISTS `tb_d_saldo`;
@ -200,50 +183,13 @@ CREATE TABLE `tb_d_saldo` (
  KEY `id_saldo` (`id_saldo`),
  CONSTRAINT `tb_d_saldo_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_master_barang` (`id`),
  CONSTRAINT `tb_d_saldo_ibfk_2` FOREIGN KEY (`id_saldo`) REFERENCES `tb_saldo_awal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_d_saldo` */

insert  into `tb_d_saldo`(`id`,`id_saldo`,`id_barang`,`qty`,`harga`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,2,34000,'baik',NULL,NULL,NULL),
(2,2,1,1,1,'baik','2021-09-07 13:19:52','2021-09-07 13:19:52',NULL),
(3,2,1,2,34000,'baik','2021-09-07 14:07:52','2021-09-07 14:07:52',NULL),
(4,2,1,2,34000,'baik','2021-09-07 14:08:21','2021-09-07 14:08:21',NULL),
(7,2,1,2,68000,'baik','2021-09-07 14:10:36','2021-09-07 14:10:36',NULL),
(8,2,1,2,68000,'baik','2021-09-07 14:17:14','2021-09-07 14:17:14',NULL),
(9,2,1,3,102000,'baik','2021-09-07 14:17:20','2021-09-07 14:17:20',NULL),
(10,2,1,NULL,NULL,'baik','2021-09-07 14:51:36','2021-09-07 14:51:36',NULL),
(11,2,1,NULL,NULL,'baik','2021-09-07 14:51:38','2021-09-07 14:51:38',NULL),
(12,2,1,NULL,NULL,'baik','2021-09-07 14:52:21','2021-09-07 14:52:21',NULL),
(13,2,1,NULL,NULL,'baik','2021-09-07 14:52:46','2021-09-07 14:52:46',NULL),
(14,2,1,NULL,NULL,'baik','2021-09-07 14:52:49','2021-09-07 14:52:49',NULL),
(15,2,1,NULL,NULL,'baik','2021-09-07 14:52:57','2021-09-07 14:52:57',NULL),
(16,2,1,NULL,NULL,'baik','2021-09-07 14:53:01','2021-09-07 14:53:01',NULL),
(17,2,1,NULL,NULL,'baik','2021-09-07 14:53:07','2021-09-07 14:53:07',NULL),
(18,2,1,NULL,NULL,'baik','2021-09-07 14:53:12','2021-09-07 14:53:12',NULL),
(19,2,1,NULL,NULL,'baik','2021-09-07 14:53:55','2021-09-07 14:53:55',NULL),
(20,2,1,NULL,NULL,'baik','2021-09-07 14:53:57','2021-09-07 14:53:57',NULL),
(21,2,1,NULL,NULL,'baik','2021-09-07 14:53:58','2021-09-07 14:53:58',NULL),
(22,2,1,NULL,NULL,'baik','2021-09-07 14:53:59','2021-09-07 14:53:59',NULL),
(23,2,1,NULL,NULL,'baik','2021-09-07 14:54:00','2021-09-07 14:54:00',NULL),
(24,2,1,NULL,NULL,'baik','2021-09-07 14:54:02','2021-09-07 14:54:02',NULL),
(25,2,1,NULL,NULL,'baik','2021-09-07 14:54:32','2021-09-07 14:54:32',NULL),
(26,2,1,NULL,NULL,'baik','2021-09-07 14:54:34','2021-09-07 14:54:34',NULL),
(27,2,1,NULL,NULL,'baik','2021-09-07 14:54:35','2021-09-07 14:54:35',NULL),
(28,2,1,NULL,NULL,'baik','2021-09-07 14:54:36','2021-09-07 14:54:36',NULL),
(29,2,1,NULL,NULL,'baik','2021-09-07 14:55:03','2021-09-07 14:55:03',NULL),
(30,2,1,NULL,NULL,'baik','2021-09-07 14:55:04','2021-09-07 14:55:04',NULL),
(31,2,1,NULL,NULL,'baik','2021-09-07 14:55:05','2021-09-07 14:55:05',NULL),
(32,2,2,1,40000,'baik','2021-09-07 15:10:17','2021-09-07 15:25:51',NULL),
(33,2,1,2,68000,'baik','2021-09-08 02:26:00','2021-09-08 02:26:22',NULL),
(34,22,1,2,68000,'baik','2021-09-08 14:08:03','2021-09-08 14:08:28',NULL),
(35,22,2,2,80000,'baik','2021-09-08 14:08:10','2021-09-08 14:08:10',NULL),
(36,2,2,2,80000,'baik','2021-10-03 21:59:39','2021-10-03 21:59:39',NULL),
(37,2,2,3,120000,'baik','2021-10-03 21:59:53','2021-10-03 21:59:53',NULL),
(38,21,1,NULL,NULL,'baik','2021-10-03 22:00:17','2021-10-03 22:00:17',NULL),
(39,21,1,2,68000,'baik','2021-10-03 22:00:23','2021-10-03 22:00:23',NULL),
(40,1,1,3,102000,'baik','2021-10-03 22:00:35','2021-10-03 22:00:35',NULL),
(41,1,1,1,34000,'baik','2021-10-03 22:02:30','2021-10-03 22:02:30',NULL);
(42,23,1,1,34000,'baik','2021-11-06 05:37:08','2021-11-06 05:37:08',NULL),
(43,23,2,1,40000,'baik','2021-11-06 05:46:33','2021-11-06 05:46:33',NULL);

/*Table structure for table `tb_gudang` */

@ -268,16 +214,20 @@ CREATE TABLE `tb_jabatan` (
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id`,`jabatan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Super Admin',NULL,NULL,NULL),
(2,'Staf Bidang',NULL,NULL,NULL),
(3,'PPBP',NULL,NULL,NULL),
(4,'Kabid',NULL,NULL,NULL),
(5,'Kasubag',NULL,NULL,NULL);
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

@ -298,8 +248,8 @@ CREATE TABLE `tb_master_barang` (
/*Data for the table `tb_master_barang` */

insert  into `tb_master_barang`(`id`,`nama_m_barang`,`harga_m_barang`,`satuan_m_barang`,`jenis_m_barang`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Kertas HVS 70',34000,'Rim',NULL,NULL,NULL,NULL),
(2,'Tinta Hitam',40000,'Buah',NULL,NULL,NULL,NULL);
(1,'Kertas HVS 70',34000,'Rim','KIB A',NULL,NULL,NULL),
(2,'Tinta Hitam',40000,'Buah','KIB B',NULL,NULL,NULL);

/*Table structure for table `tb_opd` */

@ -327,8 +277,10 @@ DROP TABLE IF EXISTS `tb_opd_gudang`;
CREATE TABLE `tb_opd_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opd` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  KEY `id_gudang` (`nama`),
  CONSTRAINT `tb_opd_gudang_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

@ -354,9 +306,6 @@ CREATE TABLE `tb_opname` (

/*Data for the table `tb_opname` */

insert  into `tb_opname`(`id`,`kode_opname`,`status_opname`,`tgl_opname`,`id_periode`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'AAA/12/A','final','2021-07-31',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_penerimaan` */

DROP TABLE IF EXISTS `tb_penerimaan`;
@ -385,10 +334,6 @@ CREATE TABLE `tb_penerimaan` (

/*Data for the table `tb_penerimaan` */

insert  into `tb_penerimaan`(`id`,`kode_penerimaan`,`jenis_penerimaan`,`tgl_terima`,`pengirim`,`status_penerimaan`,`total`,`id_opd`,`id_periode`,`ket_penerimaan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'BPKAD123','APBD Non Obat','0202-01-01','Orang A','draft',170000,NULL,NULL,NULL,'2021-09-13 18:06:49','2021-10-03 22:05:05',NULL),
(2,'BPKAD312','APBD Obat','2021-01-01','Orang B','draft',34000,NULL,NULL,NULL,'2021-09-14 17:38:22','2021-09-25 05:58:40',NULL);

/*Table structure for table `tb_pengeluaran` */

DROP TABLE IF EXISTS `tb_pengeluaran`;
@ -416,9 +361,6 @@ CREATE TABLE `tb_pengeluaran` (

/*Data for the table `tb_pengeluaran` */

insert  into `tb_pengeluaran`(`id`,`kode_pengeluaran`,`tgl_keluar`,`ket_pengeluaran`,`status_pengeluaran`,`id_periode`,`id_penggunaan`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'BPKAD/123/A','2021-07-31','Kertas\r\n','final',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tb_penggunaan` */

DROP TABLE IF EXISTS `tb_penggunaan`;
@ -447,39 +389,6 @@ CREATE TABLE `tb_penggunaan` (

/*Data for the table `tb_penggunaan` */

insert  into `tb_penggunaan`(`id`,`id_penerimaan`,`tgl_penggunaan`,`gudang_asal`,`gudang_tujuan`,`status_penggunaan`,`id_periode`,`id_opd`,`ket_penggunaan`,`created_at`,`updated_at`,`deleted_at`) values 
(2,1,'2021-01-01',NULL,NULL,'draft',NULL,NULL,NULL,'2021-10-01 03:06:34','2021-10-01 03:06:34',NULL),
(3,1,'2021-02-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 03:20:32','2021-10-01 03:20:32',NULL),
(4,2,'2021-03-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 04:05:26','2021-10-01 04:05:26',NULL),
(5,1,'2021-05-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 15:32:35','2021-10-01 15:32:35',NULL),
(6,1,'2021-05-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 16:22:07','2021-10-01 16:22:07',NULL),
(7,1,'2021-05-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 16:22:54','2021-10-01 16:22:54',NULL),
(8,1,'2021-05-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 16:54:41','2021-10-01 16:54:41',NULL),
(9,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 16:56:38','2021-10-01 16:56:38',NULL),
(10,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 16:57:11','2021-10-01 16:57:11',NULL),
(11,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 16:57:31','2021-10-01 16:57:31',NULL),
(12,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 16:57:52','2021-10-01 16:57:52',NULL),
(13,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 16:58:34','2021-10-01 16:58:34',NULL),
(14,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 16:59:46','2021-10-01 16:59:46',NULL),
(15,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 17:30:00','2021-10-01 17:30:00',NULL),
(16,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 17:31:19','2021-10-01 17:31:19',NULL),
(17,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 17:32:14','2021-10-01 17:32:14',NULL),
(18,1,'2000-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 17:32:55','2021-10-01 17:32:55',NULL),
(19,2,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 17:40:46','2021-10-01 17:40:46',NULL),
(20,1,'2021-04-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-01 17:44:30','2021-10-01 17:44:30',NULL),
(21,2,'2021-10-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-02 05:58:16','2021-10-02 05:58:16',NULL),
(22,1,'2021-11-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-02 05:59:14','2021-10-02 05:59:14',NULL),
(23,1,'2021-12-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-02 05:59:51','2021-10-02 05:59:51',NULL),
(24,2,'2021-12-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-02 06:00:12','2021-10-02 06:00:12',NULL),
(25,1,'2021-01-02','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-02 06:01:22','2021-10-02 06:01:22',NULL),
(26,2,'2021-01-02','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-02 06:01:30','2021-10-02 06:01:30',NULL),
(27,2,'2021-02-02','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-02 06:01:45','2021-10-02 06:01:45',NULL),
(28,2,'2021-03-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-02 06:02:31','2021-10-02 06:02:31',NULL),
(29,1,'2021-04-02','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-02 06:03:18','2021-10-02 06:03:18',NULL),
(30,1,'2021-06-01','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-03 06:03:12','2021-10-03 06:03:12',NULL),
(31,2,'2021-07-02','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-03 06:03:54','2021-10-03 06:03:54',NULL),
(32,2,'2021-07-02','BPKAD','Persediaan','draft',NULL,NULL,NULL,'2021-10-03 06:04:32','2021-10-03 06:04:32',NULL);

/*Table structure for table `tb_periode` */

DROP TABLE IF EXISTS `tb_periode`;
@ -503,7 +412,7 @@ CREATE TABLE `tb_periode` (
/*Data for the table `tb_periode` */

insert  into `tb_periode`(`id`,`id_opd`,`nama_periode`,`tgl_mulai`,`tgl_selesai`,`status_periode`,`ket_periode`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'Juli 2021','2021-07-01','2021-07-31','close','Periode Juli 2021','0000-00-00 00:00:00','2021-09-13 16:26:27',NULL),
(1,2,'Juli 2021','2021-07-01','2021-07-31','open','Periode Juli 2021','0000-00-00 00:00:00','2021-09-13 16:26:27',NULL),
(2,1,'Periode Januari 2022','2022-01-01','2022-01-31','open','periode janua 2022','2021-09-05 16:30:32','2021-09-13 16:26:27',NULL);

/*Table structure for table `tb_saldo_awal` */
@ -527,33 +436,12 @@ CREATE TABLE `tb_saldo_awal` (
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_saldo_awal_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `tb_periode` (`id`),
  CONSTRAINT `tb_saldo_awal_ibfk_2` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo_awal` */

insert  into `tb_saldo_awal`(`id`,`kode_saldo`,`tgl_input`,`status_saldo`,`ket_saldo`,`total`,`id_periode`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'ABC/123/D','2021-07-29','final','Testing123',136000,NULL,NULL,'2021-07-30 00:53:13','2021-10-03 22:02:30',NULL),
(2,'KP123BPKAD','2021-02-01','draft','test123321',626000,NULL,NULL,'2021-08-05 04:28:08','2021-10-03 21:59:53',NULL),
(3,'KP123BPKAD',NULL,'draft','test',NULL,NULL,NULL,'2021-08-05 04:29:35','2021-09-07 05:13:14',NULL),
(4,'KP123BPKAD',NULL,'draft','test',NULL,NULL,NULL,'2021-08-05 04:30:31','2021-09-07 05:13:47',NULL),
(5,'KP123BPKAD','2121-01-01','draft','test',NULL,NULL,NULL,'2021-08-05 04:33:13','2021-08-05 04:33:13',NULL),
(6,'KP123BPKAD','2021-01-01','draft','afsd',NULL,NULL,NULL,'2021-08-05 04:34:23','2021-08-05 04:34:23',NULL),
(7,'KP123BPKAD','2021-01-01','draft','afsd',NULL,NULL,NULL,'2021-08-05 04:35:10','2021-08-05 04:35:10',NULL),
(8,'KP123BPKAD','2021-01-01','draft','afsd',NULL,NULL,NULL,'2021-08-05 04:39:05','2021-08-05 04:39:05',NULL),
(9,'KP123BPKAD','1234-01-01','draft','fsf',NULL,NULL,NULL,'2021-08-05 04:39:50','2021-08-05 04:39:50',NULL),
(10,'KP123BPKAD','1234-01-01','draft','fsf',NULL,NULL,NULL,'2021-08-05 04:42:28','2021-08-05 04:42:28',NULL),
(11,'KP123BPKAD','1234-01-01','draft','fsf',NULL,NULL,NULL,'2021-08-05 04:44:47','2021-08-05 04:44:47',NULL),
(12,'KP123BPKAD','2021-01-01','draft','test',NULL,NULL,NULL,'2021-08-05 04:58:10','2021-08-05 04:58:10',NULL),
(13,'KP123BPKAD','2021-01-01','draft','test',NULL,NULL,NULL,'2021-08-05 04:58:19','2021-08-05 04:58:19',NULL),
(14,'KP123BPKAD','2021-01-01','draft','test',NULL,NULL,NULL,'2021-08-05 05:00:10','2021-08-05 05:00:10',NULL),
(15,'KP123BPKAD','2021-01-01','draft','test',NULL,NULL,NULL,'2021-08-05 05:00:32','2021-08-05 05:00:32',NULL),
(16,'KP123BPKAD','2021-01-01','draft','asjfkjas',NULL,NULL,NULL,'2021-08-05 05:01:45','2021-08-05 05:01:45',NULL),
(17,'KP789BPKAD','2022-01-12','draft','test paling baru',NULL,NULL,NULL,'2021-08-05 05:02:39','2021-08-05 05:02:39',NULL),
(18,'KP456BPKAD','2021-01-01','draft','input paling baru',NULL,NULL,NULL,'2021-08-05 05:05:43','2021-08-05 05:05:43',NULL),
(19,'dsjij','2021-01-01','draft','sadjd',NULL,NULL,NULL,'2021-08-18 01:02:44','2021-08-18 01:02:44',NULL),
(20,'123','2021-02-02','draft','afs',NULL,NULL,NULL,'2021-08-18 01:12:00','2021-08-18 01:12:00',NULL),
(21,'321','2021-03-03','draft','asd',68000,NULL,NULL,'2021-08-18 01:25:31','2021-10-03 22:00:23',NULL),
(22,'bpkad123456789','2023-01-01','final','saldo awal BPKAD tahun 2023',182000,NULL,NULL,'2021-09-08 14:07:53','2021-09-08 14:08:47',NULL);
(23,'BPKAD/SDA/1','2021-01-01','draft','test1',74000,2,1,'2021-11-06 05:36:37','2021-11-06 05:46:33',NULL);

/*Table structure for table `tb_unit` */

@ -569,14 +457,15 @@ CREATE TABLE `tb_unit` (
  PRIMARY KEY (`id`),
  KEY `id_opd` (`id_opd`),
  CONSTRAINT `tb_unit_ibfk_1` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_unit` */

insert  into `tb_unit`(`id`,`id_opd`,`unit`,`created_at`,`updated_at`,`deleted_at`) values 
(1,NULL,'Persediaan','2021-07-29 10:02:44','2021-07-29 10:02:46',NULL),
(2,NULL,'Aset','2021-07-29 10:02:49','2021-07-29 10:02:51',NULL),
(3,NULL,'Umum','2021-07-29 11:30:04','2021-07-29 11:30:07',NULL);
(1,1,'Persediaan','2021-07-29 10:02:44','2021-07-29 10:02:46',NULL),
(2,1,'Aset','2021-07-29 10:02:49','2021-07-29 10:02:51',NULL),
(3,2,'Umum','2021-07-29 11:30:04','2021-07-29 11:30:07',NULL),
(4,1,'keuangan',NULL,NULL,NULL);

/*Table structure for table `tb_unit_gudang` */

@ -585,13 +474,12 @@ DROP TABLE IF EXISTS `tb_unit_gudang`;
CREATE TABLE `tb_unit_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` int(11) DEFAULT NULL,
  `id_gudang` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_unit` (`id_unit`),
  KEY `id_gudang` (`id_gudang`),
  KEY `id_gudang` (`nama`),
  CONSTRAINT `tb_unit_gudang_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_unit_gudang_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_unit_gudang_ibfk_3` FOREIGN KEY (`id_gudang`) REFERENCES `tb_gudang` (`id`)
  CONSTRAINT `tb_unit_gudang_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_unit_gudang` */
@ -619,17 +507,22 @@ CREATE TABLE `tb_user` (
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id`),
  CONSTRAINT `tb_user_ibfk_3` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id`),
  CONSTRAINT `tb_user_ibfk_4` FOREIGN KEY (`id_opd`) REFERENCES `tb_opd` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`nama_user`,`dob`,`id_jabatan`,`id_unit`,`id_opd`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'super_admin','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Super Admin','0000-00-00',1,1,NULL,NULL,NULL,NULL),
(2,'staf_bidang','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','admin','2021-08-28',2,1,NULL,NULL,NULL,NULL),
(3,'ppbp','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','PPBP',NULL,3,1,NULL,NULL,NULL,NULL),
(4,'kabid','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Kabid',NULL,4,1,NULL,NULL,NULL,NULL),
(5,'kasubag','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','Kasubag',NULL,5,1,NULL,NULL,NULL,NULL),
(9,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL);
(1,'super_admin','$2y$10$6.4OsPZXkTRcucF8q6CbJexVF7xgKQJVr8bS9Kh7v6kCmRfdMTPJ6','Super Admin','2021-01-01',1,1,1,NULL,NULL,NULL),
(2,'admin_bpkad','$2y$10$09vwfFubuwO3OdVfGWzv9.HQpKZni8rGYFohmknf//PdP9xKM5ml2','Admin BPKAD','2021-01-01',5,1,1,NULL,NULL,NULL),
(3,'ppbpb_bpkad','$2y$10$AYOfnRQ646ZSOXPW5cLOyuoXlpDNnCDkPd4g2haTTWkQPexEOREka','PPBPB','2021-01-01',2,1,1,NULL,NULL,NULL),
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
