/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - turskattonline01
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`turskattonline01` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `turskattonline01`;

/*Table structure for table `administrator` */

DROP TABLE IF EXISTS `administrator`;

CREATE TABLE `administrator` (
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `active` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `journeypostregistration` */

DROP TABLE IF EXISTS `journeypostregistration`;

CREATE TABLE `journeypostregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `journeyTokenLoginId` char(36) DEFAULT NULL,
  `longitude` text DEFAULT NULL,
  `latitude` text DEFAULT NULL,
  `result1` tinyint(4) NOT NULL DEFAULT 0,
  `result2` tinyint(4) NOT NULL DEFAULT 0,
  `pendingReview` tinyint(4) NOT NULL DEFAULT 0,
  `reviewComment` text DEFAULT NULL,
  `navigatorFingerPrintId` varchar(255) DEFAULT NULL,
  `checksum` text DEFAULT NULL,
  `statusId` tinyint(4) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` datetime DEFAULT NULL,
  `navigatorDetails` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jounery_foreign_id` (`journeyTokenLoginId`),
  CONSTRAINT `jounery_foreign_id` FOREIGN KEY (`journeyTokenLoginId`) REFERENCES `journeytokenlogin` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `journeytokenlogin` */

DROP TABLE IF EXISTS `journeytokenlogin`;

CREATE TABLE `journeytokenlogin` (
  `id` char(36) NOT NULL,
  `password` varchar(255) NOT NULL,
  `used` tinyint(4) NOT NULL,
  `journeyId` int(11) NOT NULL,
  `inventory` longtext DEFAULT NULL,
  `general1` text DEFAULT NULL,
  `general2` text DEFAULT NULL,
  `lastNavigatorFingerPrintId` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
