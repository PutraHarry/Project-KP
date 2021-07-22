/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.6-MariaDB : Database - project_kp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`project_kp` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `project_kp`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`id`,`username`,`email`,`password`,`created_at`,`updated_at`) values 
(1,'admin','admin@gmail.com','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','2021-07-22 08:49:24',NULL);

/*Table structure for table `tb_test` */

DROP TABLE IF EXISTS `tb_test`;

CREATE TABLE `tb_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `tb_test` */

insert  into `tb_test`(`id`,`nama`,`keterangan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Harry Putra','Test user 1\r\n',NULL,NULL,NULL),
(2,'Adinda Gayatri','Test User 2 coba',NULL,'2021-07-14 03:23:11',NULL),
(3,'Tyagi Jisnu','Test User 3\r\n',NULL,NULL,NULL),
(4,'Dayu Dian','Test User 4\r\n',NULL,NULL,NULL),
(5,'Orang BARU','Berhasil ternyata nyobainnya gan',NULL,'2021-07-14 03:24:41',NULL),
(6,'Saya Saiyan','Mungkin sodara goku',NULL,'2021-07-14 03:50:16',NULL),
(7,'Di situ yang saya tahu','Mbeekkk',NULL,'2021-07-14 03:52:21',NULL),
(8,'Sini',NULL,NULL,NULL,NULL),
(9,'Bajuri',NULL,NULL,NULL,NULL),
(10,'Naruto',NULL,NULL,NULL,NULL),
(11,'Luffy',NULL,NULL,NULL,NULL),
(12,'Goku',NULL,NULL,NULL,NULL),
(13,'Ichigo',NULL,NULL,NULL,NULL),
(14,'Gohan',NULL,NULL,NULL,NULL),
(15,'Natsu',NULL,NULL,NULL,NULL),
(16,'Luacy',NULL,NULL,NULL,NULL),
(17,'Igneel',NULL,NULL,NULL,NULL),
(18,'Aldi',NULL,NULL,'2021-07-14 02:01:25','2021-07-14 02:01:25'),
(19,'Adi',NULL,NULL,'2021-07-14 01:50:15','2021-07-14 01:50:15'),
(20,'Andi',NULL,NULL,'2021-07-14 01:49:25','2021-07-14 01:49:25'),
(21,'User yang di test untuk dihapus','NTAR HAPUS YA GAN\r\n',NULL,'2021-07-14 01:28:00','2021-07-14 01:28:00'),
(22,'Doraemon','Karakter kucing robot lucu yang memiliki kantong ajaib','2021-07-14 03:31:14','2021-07-14 03:31:14',NULL),
(23,'Kamen Rider','Pahlawan bertopeng kesukaan Tyagi mungkin','2021-07-14 03:31:59','2021-07-14 03:32:18',NULL),
(24,'Percobaan tERBARU','Test Apakah Oke?','2021-07-14 03:56:44','2021-07-14 03:56:44',NULL),
(25,'User 21','Test User 21','2021-07-14 03:57:15','2021-07-14 03:58:16',NULL),
(26,'User 22','Test User 22','2021-07-14 03:57:49','2021-07-14 03:57:49',NULL),
(27,'User 23','Test User 23','2021-07-14 03:58:32','2021-07-14 03:59:06','2021-07-14 03:59:06');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('admin','user') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`nama`,`email`,`password`,`level`) values 
(1,'admin','admin@gmail.com','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','admin'),
(2,'user','user@gmail.com','$2y$10$uRqgcA9x9kfY6USLkFqJxeUZbe4FdVGl3uXH3J0Aj9m6f99q.fk6S','user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
