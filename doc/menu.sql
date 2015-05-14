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
  `icon` varchar(100) NOT NULL DEFAULT 'icon-list' COMMENT 'icon',
  `url` char(80) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `uid` bigint(20) DEFAULT NULL,
  `sort` tinyint(5) DEFAULT NULL,
  `createtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='menu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ablg_menu`
--

LOCK TABLES `ablg_menu` WRITE;
/*!40000 ALTER TABLE `ablg_menu` DISABLE KEYS */;
INSERT INTO `ablg_menu` VALUES (4,6,'AddCMSMenu','glyphicon glyphicon-file','Menu/add',1,3,10,1417367458,1421846738),(5,18,'Post','glyphicon glyphicon-asterisk','',1,0,0,1417367815,1421659046),(6,9,'CMSMenu','glyphicon glyphicon-asterisk','',1,0,0,1417367412,1421658980),(8,6,'ManageCMSMenu','glyphicon glyphicon-cloud','Menu/manage',1,0,0,1417405863,1421658759),(9,0,'System Management','glyphicon glyphicon-cloud','',1,0,0,1417415010,1421656506),(11,9,'User','glyphicon glyphicon-asterisk','',1,0,10,1417418769,1421659012),(12,11,'AddUser','glyphicon glyphicon-user','User/add',1,0,10,1417419075,1422025482),(13,11,'ManageUser','glyphicon glyphicon-cloud','User/manage',1,0,0,1417419109,1421656788),(14,9,'BlogMenu','glyphicon glyphicon-asterisk','',1,0,0,1417420579,1421659068),(15,14,'AddBlogMenu','glyphicon glyphicon-file','Category/add',1,0,10,1417420622,1422025428),(16,14,'ManageBlogMenu','glyphicon glyphicon-cloud','Category/manage',1,0,0,1417420655,1422025421),(17,18,'Comment','glyphicon glyphicon-asterisk','',1,0,-10,1417429682,1422025593),(18,0,'Content Management ','glyphicon glyphicon-euro','',1,0,10,1417429737,1421659339),(19,17,'ManageComment','glyphicon glyphicon-comment','Comment/manage',1,0,0,1417429901,1421659272),(20,18,'Carousel','glyphicon glyphicon-asterisk','',1,0,0,1417430620,1421659414),(21,20,'AddCarousel','glyphicon glyphicon-picture','Advert/add',1,0,10,1417430645,1422025531),(22,20,'ManageCarousel','glyphicon glyphicon-cloud','Advert/manage',1,0,0,1417430670,1421659585),(23,18,'Note','glyphicon glyphicon-asterisk','',1,0,0,1417590242,1421659292),(24,23,'AddNote','glyphicon glyphicon-inbox','Note/add',1,0,10,1417590279,1422025520),(25,23,'ManageNote','glyphicon glyphicon-cloud','Note/manage',1,0,0,1417590309,1421659506),(29,5,'AddPost','glyphicon glyphicon-th-list','Article/add',1,0,10,1421681161,1422025546),(40,5,'ManagePost','glyphicon glyphicon-cloud','Article/manage',1,0,0,1421682711,1421685240),(41,9,'CMSAuth','glyphicon glyphicon-asterisk','',1,0,-1,1422023809,1422026531),(43,45,'ManageAuthRule','glyphicon glyphicon-file','AuthRule/manage',1,0,0,1422024111,1422024512),(45,41,'AuthRule','glyphicon glyphicon-cloud','',1,0,20,1422024251,1422025642),(46,45,'AddAuthRule','glyphicon glyphicon-file','AuthRule/add',1,0,10,1422024417,1422025459),(47,41,'AuthGroup','glyphicon glyphicon-cloud','',1,0,10,1422025312,1422025888),(48,47,'AddAuthGroup','glyphicon glyphicon-cloud','AuthGroup/add',1,0,10,1422025343,1422025683),(49,47,'ManageAuthGroup','glyphicon glyphicon-cloud','AuthGroup/manage',1,0,0,1422025351,1422025351),(50,41,'AuthGroupAccess','glyphicon glyphicon-cloud','',1,0,0,1422025801,1422025801),(51,50,'AddAuthGroupAccess','glyphicon glyphicon-cloud','AuthGroupAccess/add',1,0,10,1422025833,1422026580),(52,50,'ManageAuthGroupAccess','glyphicon glyphicon-asterisk','AuthGroupAccess/manage',1,0,0,1422025845,1422026594),(53,18,'Gallery','glyphicon glyphicon-cloud','',1,3,0,1429316810,1429316810),(54,53,'AddGallery','glyphicon glyphicon-file','Gallery/add',1,3,2,1429316874,1429316979),(55,53,'ManageGallery','glyphicon glyphicon-file','Gallery/manage',1,3,0,1429316900,1429316900);
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

-- Dump completed on 2015-04-25 22:37:38
