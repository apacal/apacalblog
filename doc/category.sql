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
-- Table structure for table `ablg_category`
--

DROP TABLE IF EXISTS `ablg_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ablg_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父结点',
  `cname` varchar(100) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `url` varchar(200) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '1',
  `sort` tinyint(5) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `uid` bigint(20) DEFAULT NULL,
  `updatetime` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='栏目';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ablg_category`
--

LOCK TABLES `ablg_category` WRITE;
/*!40000 ALTER TABLE `ablg_category` DISABLE KEYS */;
INSERT INTO `ablg_category` VALUES (1,16,'LINUX','Article/index',1,127,'/Category/image/20141116/1416131014.jpg',0,1421735669,1419942717),(2,8,'PHP','Article/index',1,50,'/Category/image/20141116/1416132324.jpg',0,1421735858,1419942402),(3,10,' 趣闻','Article/index',1,50,'/Category/image/20141116/1416132375.jpg',0,1421735876,1419942892),(5,16,'C&C++','Article/index',1,127,'/Category/image/20141116/1416132298.jpg',0,1421735883,1419942740),(6,8,'WEBSERVER','Article/index',1,10,'/Category/image/20141116/1416132428.jpg',0,1421735892,1395166073),(8,16,'WEB','Article/index',1,127,'/Category/image/20141116/1416132309.jpg',0,1421735933,1419942777),(9,0,'闲言','Note/index',1,-10,'/Category/image/20140708/1404834135.png',0,1421736025,1419942918),(10,0,'杂谈','Article/index',1,60,'/Category/image/20141116/1416132348.jpg',0,1421735915,1419942857),(11,16,'译文','Article/index',1,0,'/Category/image/20141116/1416132337.jpg',0,1421735949,1419942839),(12,10,'国学','Article/index',1,0,'/Category/image/20141116/1416132471.jpg',0,1421735956,1419942902),(13,0,'About Me','/article/87.html#nav-home',1,-30,'0',0,1420348548,1420348548),(14,0,'书籍','/book/my.html',1,-20,'0',0,0,0),(15,10,'其他','Article/index',1,-30,'0',0,1421736101,1420348320),(16,0,'program','Article/index',1,127,'0',0,1421688704,1419942767),(17,0,'图库','Gallery/index',1,0,'/Uploads/ckfinder/images/969c80cfjw8ehcwj1tmkzj20k00k0mya.jpg',3,1429318983,1429318894);
/*!40000 ALTER TABLE `ablg_category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-25 22:37:51
