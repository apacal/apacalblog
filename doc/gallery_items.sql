-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: apacalblog
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ablg_gallery_items`
--

DROP TABLE IF EXISTS `ablg_gallery_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ablg_gallery_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_id` bigint(20) unsigned NOT NULL,
  `image` varchar(200) NOT NULL DEFAULT '',
  `status` int(1) DEFAULT '1',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序值',
  `uid` bigint(20) DEFAULT '1',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gallery_item` (`gallery_id`,`image`),
  KEY `gallery_index` (`gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ablg_gallery_items`
--

LOCK TABLES `ablg_gallery_items` WRITE;
/*!40000 ALTER TABLE `ablg_gallery_items` DISABLE KEYS */;
INSERT INTO `ablg_gallery_items` VALUES (36,8,'/Uploads/ckfinder/images/%E6%96%B0%E7%89%88%E6%B7%98%E5%AE%9D%E7%BD%91%E9%9A%90%E8%97%8F%E7%9A%84%E5%AF%82%E5%AF%9E.png',1,50,3,1429953709,1429953709,'test'),(42,2,'/Uploads/ckfinder/images/%E6%96%B0%E7%89%88%E6%B7%98%E5%AE%9D%E7%BD%91%E9%9A%90%E8%97%8F%E7%9A%84%E5%AF%82%E5%AF%9E.png',1,50,3,1429955160,1429955160,'fdfd'),(43,2,'/Uploads/ckfinder/images/vim-shell.png',1,50,3,1429955206,1429955206,'fdf'),(44,8,'/Uploads/ckfinder/images/969c80cfjw8ehcwj1tmkzj20k00k0mya.jpg',1,50,3,1429955223,1429955223,'dsfdsf'),(46,8,'/Uploads/ckfinder/images/vim-shell.png',1,50,3,1429955234,1429955234,'fdfdfdf'),(47,2,'/Uploads/ckfinder/images/969c80cfjw8ehcwj1tmkzj20k00k0mya.jpg',1,50,3,1429955374,1429955374,'dfsdfd');
/*!40000 ALTER TABLE `ablg_gallery_items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-25 22:38:16
