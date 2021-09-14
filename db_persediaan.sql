/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.6-MariaDB : Database - db_usahacamilan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_usahacamilan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_usahacamilan`;

/*Table structure for table `tb_bahan` */

DROP TABLE IF EXISTS `tb_bahan`;

CREATE TABLE `tb_bahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tb_bahan` */

insert  into `tb_bahan`(`id`,`nama`,`jumlah`,`harga`) values 
(1,'Tepung 500gr',40,12000),
(2,'Telur ',100,1500),
(3,'Gula 1kg',50,25000),
(4,'Singkong 1kg',30,30000),
(5,'Kentang 1kg',50,25000),
(6,'Jahe 1kg',20,20000),
(7,'Cabe 1kg',30,20000),
(8,'Nanas 1kg',10,40000),
(9,'Minyak l Liter',40,15000),
(10,'Asem 1 kg',40,10000);

/*Table structure for table `tb_d_distribusi` */

DROP TABLE IF EXISTS `tb_d_distribusi`;

CREATE TABLE `tb_d_distribusi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_distribusi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_distribusi` (`id_distribusi`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `tb_d_distribusi_ibfk_1` FOREIGN KEY (`id_distribusi`) REFERENCES `tb_distribusi` (`id`),
  CONSTRAINT `tb_d_distribusi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_distribusi` */

insert  into `tb_d_distribusi`(`id`,`id_distribusi`,`id_produk`,`jml`) values 
(1,1,6,5),
(2,1,8,5),
(3,1,9,10),
(4,1,10,10),
(5,2,1,10),
(6,2,2,10),
(7,2,9,10),
(8,3,4,30),
(9,3,5,40),
(10,3,7,10);

/*Table structure for table `tb_d_pembelian` */

DROP TABLE IF EXISTS `tb_d_pembelian`;

CREATE TABLE `tb_d_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembelian` int(11) DEFAULT NULL,
  `id_bahan` int(11) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pembelian` (`id_pembelian`),
  KEY `id_bahan` (`id_bahan`),
  CONSTRAINT `tb_d_pembelian_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `tb_pembelian` (`id`),
  CONSTRAINT `tb_d_pembelian_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `tb_bahan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_pembelian` */

insert  into `tb_d_pembelian`(`id`,`id_pembelian`,`id_bahan`,`jml`) values 
(1,1,6,20),
(2,1,7,20),
(3,1,2,10),
(4,2,1,10),
(5,2,3,5),
(6,2,2,40),
(7,3,4,20),
(8,3,5,20),
(9,3,8,10);

/*Table structure for table `tb_d_produksi` */

DROP TABLE IF EXISTS `tb_d_produksi`;

CREATE TABLE `tb_d_produksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produksi` int(11) DEFAULT NULL,
  `id_bahan` int(11) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produksi` (`id_produksi`),
  KEY `id_bahan` (`id_bahan`),
  CONSTRAINT `tb_d_produksi_ibfk_1` FOREIGN KEY (`id_produksi`) REFERENCES `tb_produksi` (`id`),
  CONSTRAINT `tb_d_produksi_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `tb_bahan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_produksi` */

insert  into `tb_d_produksi`(`id`,`id_produksi`,`id_bahan`,`jml`) values 
(1,1,5,5),
(2,1,9,1),
(3,2,4,5),
(4,2,7,5),
(5,3,4,5),
(6,3,9,5),
(7,4,3,10),
(8,4,6,10),
(9,5,3,10),
(10,5,10,10),
(11,6,3,10),
(12,6,7,10),
(13,6,10,10),
(14,7,1,10),
(15,7,3,10),
(16,7,8,2),
(17,8,1,10),
(18,8,3,10),
(19,9,1,10),
(20,9,3,10),
(21,10,1,10),
(22,10,2,10),
(23,10,3,10);

/*Table structure for table `tb_d_retur` */

DROP TABLE IF EXISTS `tb_d_retur`;

CREATE TABLE `tb_d_retur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_retur` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_retur` (`id_retur`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `tb_d_retur_ibfk_1` FOREIGN KEY (`id_retur`) REFERENCES `tb_retur` (`id`),
  CONSTRAINT `tb_d_retur_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_d_retur` */

insert  into `tb_d_retur`(`id`,`id_retur`,`id_produk`,`jml`) values 
(1,1,6,5),
(2,1,8,5),
(3,2,5,20),
(4,2,7,10);

/*Table structure for table `tb_distribusi` */

DROP TABLE IF EXISTS `tb_distribusi`;

CREATE TABLE `tb_distribusi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `tgl_distribusi` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vendor` (`id_vendor`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `tb_distribusi_ibfk_1` FOREIGN KEY (`id_vendor`) REFERENCES `tb_vendor` (`id`),
  CONSTRAINT `tb_distribusi_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `tb_distribusi` */

insert  into `tb_distribusi`(`id`,`id_karyawan`,`id_vendor`,`tgl_distribusi`) values 
(1,1,4,'2021-05-20 20:59:56'),
(2,3,2,'2021-05-20 21:00:10'),
(3,2,1,'2021-05-22 21:00:28'),
(4,4,3,'2021-05-12 22:13:16'),
(5,2,2,'2021-05-15 22:13:50'),
(6,1,1,'2021-01-21 22:14:10'),
(7,4,2,'2021-01-29 22:14:26'),
(8,3,4,'2021-02-17 22:14:41'),
(9,2,3,'2021-03-21 22:14:55'),
(10,1,4,'2021-04-01 22:15:10'),
(11,4,1,'2021-04-14 22:15:31'),
(12,1,4,'2021-04-29 22:15:51'),
(13,1,3,'2021-06-10 22:16:13'),
(14,3,3,'2021-06-30 22:16:38');

/*Table structure for table `tb_jenis_produk` */

DROP TABLE IF EXISTS `tb_jenis_produk`;

CREATE TABLE `tb_jenis_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jenis_produk` */

insert  into `tb_jenis_produk`(`id`,`jenis`) values 
(1,'Keripik'),
(2,'Permen'),
(3,'Kue kering');

/*Table structure for table `tb_karyawan` */

DROP TABLE IF EXISTS `tb_karyawan`;

CREATE TABLE `tb_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `noHP` varchar(12) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_karyawan` */

insert  into `tb_karyawan`(`id`,`nama`,`tgl_lahir`,`gender`,`noHP`,`alamat`) values 
(1,'Harry Putra','2000-03-24','Laki-laki','082236552502','Denpasar, Bali'),
(2,'Dadang Suherman','1995-01-01','Laki-laki','081111122222','Denpasar, Bali'),
(3,'Adinda Gayatri','2000-03-09','Perempuan','081234567890','Tabanan, Bali'),
(4,'Tyagi Jisnu','2000-04-18','Laki-laki','089087456321','Karangasem, Bali');

/*Table structure for table `tb_pembelian` */

DROP TABLE IF EXISTS `tb_pembelian`;

CREATE TABLE `tb_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `tgl_pembelian` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_karyawan` (`id_karyawan`),
  KEY `id_supplier` (`id_supplier`),
  CONSTRAINT `tb_pembelian_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id`),
  CONSTRAINT `tb_pembelian_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pembelian` */

insert  into `tb_pembelian`(`id`,`id_karyawan`,`id_supplier`,`tgl_pembelian`) values 
(1,2,1,'2021-05-01 20:41:20'),
(2,1,3,'2021-05-04 20:41:39'),
(3,3,2,'2021-05-11 20:42:02');

/*Table structure for table `tb_produk` */

DROP TABLE IF EXISTS `tb_produk`;

CREATE TABLE `tb_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `id_jenis_produk` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jenis_produk` (`id_jenis_produk`),
  CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_jenis_produk`) REFERENCES `tb_jenis_produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tb_produk` */

insert  into `tb_produk`(`id`,`nama`,`id_jenis_produk`,`harga`) values 
(1,'Keripik Kentang',1,NULL),
(2,'Keripik Singkong Balado',1,NULL),
(3,'Keripik Singkong Original',1,NULL),
(4,'Permen Jahe',2,NULL),
(5,'Permen Asem',2,NULL),
(6,'Kue Nastar',3,NULL),
(7,'Permen Rujak',2,NULL),
(8,'Kue Hastangel',3,NULL),
(9,'Putri Salju',3,NULL),
(10,'Eggroll',3,NULL);

/*Table structure for table `tb_produksi` */

DROP TABLE IF EXISTS `tb_produksi`;

CREATE TABLE `tb_produksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `tgl_produksi` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produk` (`id_produk`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `tb_produksi_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id`),
  CONSTRAINT `tb_produksi_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tb_produksi` */

insert  into `tb_produksi`(`id`,`id_produk`,`id_karyawan`,`tgl_produksi`) values 
(1,1,3,'2021-05-12 20:45:06'),
(2,2,3,'2021-05-13 20:45:37'),
(3,3,3,'2021-05-13 20:45:52'),
(4,4,2,'2021-05-15 20:46:09'),
(5,5,2,'2021-05-15 20:46:22'),
(6,7,2,'2021-05-15 20:46:34'),
(7,6,1,'2021-05-16 20:46:48'),
(8,8,1,'2021-05-16 20:47:02'),
(9,9,3,'2021-05-16 20:47:30'),
(10,10,1,'2021-05-16 20:47:50');

/*Table structure for table `tb_retur` */

DROP TABLE IF EXISTS `tb_retur`;

CREATE TABLE `tb_retur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `tgl_retur` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vendor` (`id_vendor`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `tb_retur_ibfk_1` FOREIGN KEY (`id_vendor`) REFERENCES `tb_vendor` (`id`),
  CONSTRAINT `tb_retur_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `tb_karyawan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_retur` */

insert  into `tb_retur`(`id`,`id_karyawan`,`id_vendor`,`tgl_retur`) values 
(1,1,4,'2021-05-30 21:05:46'),
(2,2,1,'2021-05-30 21:06:05');

/*Table structure for table `tb_supplier` */

DROP TABLE IF EXISTS `tb_supplier`;

CREATE TABLE `tb_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `noHP` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_supplier` */

insert  into `tb_supplier`(`id`,`nama`,`alamat`,`noHP`) values 
(1,'Supplier Jaya','Jimbaran, Badung, Bali','036144044012'),
(2,'Supplier Agung','Denpasar, Bali','14046'),
(3,'Supplier Makmur','Tabanan, Bali','089797787911');

/*Table structure for table `tb_vendor` */

DROP TABLE IF EXISTS `tb_vendor`;

CREATE TABLE `tb_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `noHP` varchar(12) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_vendor` */

insert  into `tb_vendor`(`id`,`nama`,`noHP`,`alamat`) values 
(1,'Jaya Perkasa','441446','Badung Jimbaran, Bali'),
(2,'Bintang berdua','481481','Tabanan, Bali'),
(3,'Selalu Maju','14095','Gianyar, Bali'),
(4,'Tetap Moondoor','123654','Denpasar, Bali');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
