/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.21 : Database - shortlink
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `urls` */

DROP TABLE IF EXISTS `urls`;

CREATE TABLE `urls` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `original_url` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `urls` */

insert  into `urls`(`id`,`code`,`original_url`,`created_at`) values (1,'otg0y','http://mvc.com:88/',NULL),(2,'IJ0Me','http://mvc.com:88/',NULL),(3,'FqtA8','http://mvc.com:88/',NULL),(4,'uhALi','http://mvc.com:88/',NULL),(5,'I5Bbu','http://mvc.com:88/',NULL),(6,'uGpTL','http://mvc.com:88/',NULL),(7,'8KTwD','http://mvc.com:88/',NULL),(8,'Zc8Eu','http://mvc.com:88/',NULL),(9,'F0jbc','http://mvc.com:88/',NULL),(10,'mxa8k','http://mvc.com:88/',NULL),(11,'vORMg','http://mvc.com:88/',NULL),(12,'iqOdP','http://mvc.com:88/',NULL),(13,'Wh5A8','http://mvc.com:88/s',NULL),(14,'OuyFg','https://www.google.com/search?ei=ODKsXLWcJ9j4wAPKm4_QDg&q=example+jquery+click+to+copy+variable+to+clipboard&oq=example+jquery+click+to+copy+variable+to+clipboard&gs_l=psy-ab.3...145396.148669..148925...3.0..0.86.729.12......0....1..gws-wiz.......0i71j33i10.JNBLCdCUf9o',NULL),(15,'UrKl7','https://www.google.com/search?q=textarea+auto+height+content&oq=textarea+auto+h&aqs=chrome.2.69i57j0l5.9574j0j4&sourceid=chrome&ie=UTF-8',NULL),(16,'eR5LX','https://www.w3schools.com/bootstrap4/bootstrap_tooltip.asp',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
