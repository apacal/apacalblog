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
  `mid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父结点',
  `cname` varchar(100) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '描述',
  `keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键字',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序值',
  `is_check` int(1) NOT NULL COMMENT '是否审核',
  `status` int(1) NOT NULL DEFAULT '1',
  `createtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `image` varchar(200) NOT NULL,
  `adminid` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `colindex` (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='栏目';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ablg_category`
--

LOCK TABLES `ablg_category` WRITE;
/*!40000 ALTER TABLE `ablg_category` DISABLE KEYS */;
INSERT INTO `ablg_category` VALUES (1,1,0,'LINUX','LINUX的屌丝经历，分享一些LINUX的学习经历和遇到的问题！','linux,shell,commandline,ubuntu,debian，LINUX',220,1,1,1395166120,1416131014,'/Category/image/20141116/1416131014.jpg',3),(2,1,8,'PHP','学习PHP的过程中遇到的问题以及经历还有一些关于PHP的趣事！','PHP，ThinkPHP，php',50,1,1,1395167533,1416132324,'/Category/image/20141116/1416132324.jpg',3),(3,1,0,' 趣闻','分享一些有趣的事情！','程序员的趣闻，NEWS,INSTERSTING',50,1,1,1395167021,1416132375,'/Category/image/20141116/1416132375.jpg',3),(4,1,0,'生活','生活一些不知所谓的感悟，扯东扯西。','Apacal，生活感悟',50,1,0,1395167510,1416132363,'/Category/image/20141116/1416132363.jpg',3),(5,1,0,'C&amp;C++','C++是万能的，一些C++的学习经历和有趣的事，以及一些新闻！','C++，STL，Template，Inside Model of C++，泛型程序设计',210,1,1,1395166131,1416132298,'/Category/image/20141116/1416132298.jpg',3),(6,1,8,'WEBSERVER','一些关于WEB服务，主要是在案LINUX环境下的。在架设服务器环境和运行中的总结。','webserver, linux, web服务相关,linuxWeb服务',10,1,1,1395166073,1416132428,'/Category/image/20141116/1416132428.jpg',3),(10,1,0,'生涯＆杂谈','程序员的职业生涯，杂谈','程序员，职场生涯，杂谈。',60,1,1,1406118048,1416132348,'/Category/image/20141116/1416132348.jpg',3),(7,2,0,'相册','生活中的一些照片','相册，我的相册，Apacal相册',10,1,0,1396882688,1404834240,'/Category/image/20140407/1396882934.JPG',3),(8,1,0,'WEB','屌丝的WEB开发，包含服务器和WEB语言。','WEB ',140,1,1,1397878917,1416132309,'/Category/image/20141116/1416132309.jpg',3),(9,4,0,'闲言','个人闲言记录，只为了看到幼稚的自己．','闲言杂语，杂谈',0,1,1,1404834135,1404930757,'/Category/image/20140708/1404834135.png',3),(11,1,0,'译文','翻译的一些文章。','翻译的文章',130,1,1,1408673481,1416132337,'/Category/image/20141116/1416132337.jpg',3),(12,1,0,'国学','学习中国固有的或传统的学术文化','国学',120,1,1,1408873702,1416132471,'/Category/image/20141116/1416132471.jpg',3);
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

-- Dump completed on 2014-11-16 18:40:09
