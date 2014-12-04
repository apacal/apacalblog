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
-- Table structure for table `ablg_menu`
--

DROP TABLE IF EXISTS `ablg_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ablg_menu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父结点',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'menu名称',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '描述',
  `icon` varchar(100) NOT NULL DEFAULT 'icon-list' COMMENT 'icon',
  `sort` tinyint(5) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `createtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `adminid` int(5) NOT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='menu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ablg_menu`
--

LOCK TABLES `ablg_menu` WRITE;
/*!40000 ALTER TABLE `ablg_menu` DISABLE KEYS */;
INSERT INTO `ablg_menu` VALUES (1,5,'添加博客','','icon-list',0,1,1417367434,1417367434,3,'Article','add'),(2,5,'管理博客','','icon-list',0,1,1417367444,1417367444,3,'Article','manage'),(4,6,'添加menu','','icon-list',10,1,1417367458,1417369013,3,'Menu','add'),(5,18,'博文','','icon-list',0,1,1417367815,1417429759,3,'Article','index'),(6,9,'Admin Menu','','icon-list',0,1,1417367412,1417418730,3,'Menu','index'),(9,0,'系统设置','','icon-list',0,1,1417415010,1417418882,3,'#','#'),(8,6,'管理menu','','icon-list',0,1,1417405863,1417405863,3,'Menu','manage'),(10,0,'首页','','icon-list',20,1,1417415631,1417415631,3,'Index','index'),(11,9,'管理员','','icon-list',10,1,1417418769,1417418769,3,'Admin','index'),(12,11,'添加管理员','','icon-list',0,1,1417419075,1417419075,3,'Admin','add'),(13,11,'管理管理员','','icon-list',0,1,1417419109,1417419109,3,'Admin','manage'),(14,9,'Home Menu','','icon-list',0,1,1417420579,1417420579,3,'#','#'),(15,14,'添加Home Menu','','icon-list',0,1,1417420622,1417420622,3,'Category','add'),(16,14,'管理Home Menu','','icon-list',0,1,1417420655,1417420655,3,'Category','manage'),(17,18,'评论','','icon-list',-10,1,1417429682,1417431301,3,'Comment','index'),(18,0,'内容管理','','icon-list',10,1,1417429737,1417429737,3,'#','#'),(19,17,'管理评论','','icon-list',0,1,1417429901,1417429901,3,'Comment','manage'),(20,18,'大屏轮播','','icon-list',0,1,1417430620,1417430886,3,'Advert','index'),(21,20,'添加轮播','','icon-list',0,1,1417430645,1417430645,3,'Advert','add'),(22,20,'管理轮播','','icon-list',0,1,1417430670,1417430670,3,'Advert','manage'),(23,18,'闲言杂语','','icon-list',0,1,1417590242,1417590242,3,'Note','index'),(24,23,'添加闲言杂语','','icon-list',0,1,1417590279,1417590279,3,'Note','add'),(25,23,'管理闲言杂语','','icon-list',0,1,1417590309,1417590309,3,'Note','manage');
/*!40000 ALTER TABLE `ablg_menu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-04 23:13:41
