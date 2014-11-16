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
-- Table structure for table `ablg_advert`
--

DROP TABLE IF EXISTS `ablg_advert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ablg_advert` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) DEFAULT NULL COMMENT '图片',
  `description` varchar(500) DEFAULT NULL COMMENT '描述',
  `adminid` varchar(8) DEFAULT NULL COMMENT '管理员id',
  `createtime` int(10) NOT NULL,
  `is_check` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `title` varchar(100) NOT NULL,
  `sort` int(5) NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `go` varchar(50) NOT NULL DEFAULT '查看详情' COMMENT '链接信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ablg_advert`
--

LOCK TABLES `ablg_advert` WRITE;
/*!40000 ALTER TABLE `ablg_advert` DISABLE KEYS */;
INSERT INTO `ablg_advert` VALUES (9,'/Advert/image/20140320/1395250265.png','C++11新特性体验','3',1395255621,1,0,'C++11新特性体验',10,'http://apacal.cn/article/32.html',1408605063,'查看详情'),(12,'/Advert/image/20141116/1416129168.jpg','一个简单的脚本词典','3',1408605138,1,1,'如何写一个简单的词典',0,'http://apacal.cn/article/72.html',1416129168,'查看详情'),(11,'/Advert/image/20140407/1396874706.jpg','加盐hash，salted hash','3',1396874706,1,0,'如何安全地保存用户密码（加盐hash）',10,'http://apacal.cn/article/54.html',1408605168,'查看详情'),(10,'/Advert/image/20140320/1395255553.png','Ubuntu安装nginx + php5-fpm + pathinfo模式','3',1395255594,1,0,'Ubuntu安装nginx + php5-fpm + pathinfo模式',10,'http://apacal.cn/article/40.html',1408605181,'查看详情'),(13,'/Advert/image/20141116/1416129150.jpg','vundle来管理VIM插件','3',1408605214,1,1,'使用vundle来管理VIM插件',0,'http://apacal.cn/article/73.html',1416129150,'查看详情');
/*!40000 ALTER TABLE `ablg_advert` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-16 18:39:32
