-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: thinkox
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
-- Table structure for table `mj_action`
--

DROP TABLE IF EXISTS `mj_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text NOT NULL COMMENT '行为规则',
  `log` text NOT NULL COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统行为表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_action`
--

LOCK TABLES `mj_action` WRITE;
/*!40000 ALTER TABLE `mj_action` DISABLE KEYS */;
INSERT INTO `mj_action` VALUES (1,'user_login','用户登录','积分+10，每天一次','table:member|field:score|condition:uid={$self} AND status>-1|rule:score+10|cycle:24|max:1;','[user|get_nickname]在[time|time_format]登录了后台',1,1,1387181220),(2,'add_article','发布文章','积分+5，每天上限5次','table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:5','',2,0,1380173180),(3,'review','评论','评论积分+1，无限制','table:member|field:score|condition:uid={$self}|rule:score+1','',2,1,1383285646),(4,'add_document','发表文档','积分+10，每天上限5次','table:member|field:score|condition:uid={$self}|rule:score+10|cycle:24|max:5','[user|get_nickname]在[time|time_format]发表了一个微博。\r\n表[model]，记录编号[record]。',1,0,1394866289),(5,'add_document_topic','发表讨论','积分+5，每天上限10次','table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:10','',2,0,1383285551),(6,'update_config','更新配置','新增或修改或删除配置','','',1,1,1383294988),(7,'update_model','更新模型','新增或修改模型','','',1,1,1383295057),(8,'update_attribute','更新属性','新增或更新或删除属性','','',1,1,1383295963),(9,'update_channel','更新导航','新增或修改或删除导航','','',1,1,1383296301),(10,'update_menu','更新菜单','新增或修改或删除菜单','','',1,1,1383296392),(11,'update_category','更新分类','新增或修改或删除分类','','',1,1,1383296765),(13,'add_weibo','发微博','积分+2，金币+1，每天上限5次','table:member|field:score|condition:uid={$self}|rule:score+2|cycle:24|max:5|tox_money_rule:tox_money+1|tox_money_field:tox_money','',1,1,1408935799),(14,'add_weibo_comment','微博评论','积分+1，每天上限5次','table:member|field:score|condition:uid={$self}|rule:score+1|cycle:24|max:5','',1,1,1396342907),(15,'add_post','发帖子','积分+3，金币+1，每天上限5次','table:member|field:score|condition:uid={$self}|rule:score+3|cycle:24|max:5|tox_money_rule:tox_money+1|tox_money_field:tox_money','',1,1,1408935783),(16,'add_post_reply','发帖子回复','积分+1，每天上限5次，','table:member|field:score|condition:uid={$self}|rule:score+1|cycle:24|max:5','',1,1,1408935759),(17,'add_wallet','钱包增加','支付或者获取了钱包增加','','[user|get_nickname]在[time|time_format]增加了钱包',2,1,1419340031);
/*!40000 ALTER TABLE `mj_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_action_log`
--

DROP TABLE IF EXISTS `mj_action_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7528 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_action_log`
--

LOCK TABLES `mj_action_log` WRITE;
/*!40000 ALTER TABLE `mj_action_log` DISABLE KEYS */;
INSERT INTO `mj_action_log` VALUES (7179,1,1,0,'member',1,'admin在2014-12-04 10:26登录了后台',1,1417659984),(7180,1,1,0,'member',1,'admin在2014-12-04 14:23登录了后台',1,1417674186),(7181,13,1,0,'Weibo',1,'操作url：/thinkox/index.php?s=/weibo/index/dosend.html',1,1417674250),(7182,1,1,0,'member',1,'admin在2014-12-04 14:24登录了后台',1,1417674283),(7183,1,60,0,'member',60,'zhong在2014-12-04 14:29登录了后台',1,1417674542),(7184,15,60,0,'ForumPost',1,'操作url：/thinkox/index.php?s=/forum/index/doedit.html',1,1417674601),(7185,13,60,0,'Weibo',2,'操作url：/thinkox/index.php?s=/forum/index/doedit.html',1,1417674601),(7186,13,60,0,'Weibo',3,'操作url：/thinkox/index.php?s=/event/index/dopost.html',1,1417674897),(7187,13,60,0,'Weibo',4,'操作url：/thinkox/index.php?s=/group/index/doaddgroup.html',1,1417674999),(7188,13,60,0,'Weibo',5,'操作url：/thinkox/index.php?s=/group/index/doaddgroup.html',1,1417675027),(7189,1,1,0,'member',1,'admin在2014-12-04 14:46登录了后台',1,1417675560),(7190,1,1,0,'member',1,'admin在2014-12-04 15:01登录了后台',1,1417676505),(7191,1,60,0,'member',60,'zhong在2014-12-04 15:02登录了后台',1,1417676544),(7192,1,1,0,'member',1,'admin在2014-12-04 15:05登录了后台',1,1417676724),(7193,1,1,0,'member',1,'admin在2014-12-08 09:59登录了后台',1,1418003943),(7194,10,1,0,'Menu',2216,'操作url：/thinkox/index.php?s=/admin/menu/edit.html',1,1418004164),(7195,10,1,0,'Menu',172,'操作url：/thinkox/index.php?s=/admin/menu/edit.html',1,1418004210),(7196,10,1,0,'Menu',123,'操作url：/thinkox/index.php?s=/admin/menu/edit.html',1,1418004249),(7197,10,1,0,'Menu',154,'操作url：/thinkox/index.php?s=/admin/menu/edit.html',1,1418004265),(7198,9,1,0,'channel',4,'操作url：/thinkox/index.php?s=/admin/channel/edit.html',1,1418004360),(7199,9,1,0,'channel',15,'操作url：/thinkox/index.php?s=/admin/channel/edit.html',1,1418004374),(7200,9,1,0,'channel',1,'操作url：/thinkox/index.php?s=/admin/channel/edit.html',1,1418004422),(7201,1,1,2130706433,'member',1,'admin在2014-12-14 22:39登录了后台',1,1418567947),(7202,1,1,2130706433,'member',1,'admin在2014-12-14 22:41登录了后台',1,1418568091),(7203,15,1,2130706433,'ForumPost',2,'操作url：/index.php?s=/forum/index/doedit.html',1,1418609140),(7204,13,1,2130706433,'Weibo',6,'操作url：/index.php?s=/forum/index/doedit.html',1,1418609140),(7205,15,1,2130706433,'ForumPost',3,'操作url：/index.php?s=/forum/index/doedit.html',1,1418610047),(7206,13,1,2130706433,'Weibo',7,'操作url：/index.php?s=/forum/index/doedit.html',1,1418610047),(7207,15,1,2130706433,'ForumPost',4,'操作url：/index.php?s=/forum/index/doedit.html',1,1418610540),(7208,13,1,2130706433,'Weibo',8,'操作url：/index.php?s=/forum/index/doedit.html',1,1418610540),(7209,1,1,2130706433,'member',1,'admin在2014-12-15 11:36登录了后台',1,1418614598),(7210,16,1,2130706433,'ForumPostReply',1,'操作url：/index.php?s=/forum/index/doreply/post_id/4.html',1,1418615292),(7211,16,1,2130706433,'ForumPostReply',2,'操作url：/index.php?s=/forum/index/doreply/post_id/4.html',1,1418615306),(7212,16,1,2130706433,'ForumPostReply',3,'操作url：/index.php?s=/forum/index/doreply/post_id/4.html',1,1418615368),(7213,16,1,2130706433,'ForumPostReply',4,'操作url：/index.php?s=/forum/index/doreply/post_id/4.html',1,1418615380),(7214,16,1,2130706433,'ForumPostReply',5,'操作url：/index.php?s=/forum/index/doreply/post_id/4.html',1,1418615417),(7215,16,1,2130706433,'ForumPostReply',6,'操作url：/index.php?s=/forum/index/doreply/post_id/4.html',1,1418615474),(7216,1,1,2130706433,'member',1,'admin在2014-12-15 12:14登录了后台',1,1418616840),(7217,16,1,2130706433,'ForumPostReply',7,'操作url：/index.php?s=/forum/index/doreply/post_id/3.html',1,1418616888),(7218,16,1,2130706433,'ForumPostReply',8,'操作url：/index.php?s=/forum/index/doreply/post_id/3.html',1,1418617069),(7219,16,1,2130706433,'ForumPostReply',9,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617147),(7220,16,1,2130706433,'ForumPostReply',10,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617184),(7221,16,1,2130706433,'ForumPostReply',11,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617204),(7222,16,1,2130706433,'ForumPostReply',12,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617323),(7223,16,1,2130706433,'ForumPostReply',13,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617337),(7224,16,1,2130706433,'ForumPostReply',14,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617491),(7225,16,1,2130706433,'ForumPostReply',15,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617580),(7226,16,1,2130706433,'ForumPostReply',16,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617592),(7227,16,1,2130706433,'ForumPostReply',17,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617612),(7228,16,1,2130706433,'ForumPostReply',18,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617645),(7229,16,1,2130706433,'ForumPostReply',19,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617690),(7230,16,1,2130706433,'ForumPostReply',20,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617724),(7231,16,1,2130706433,'ForumPostReply',21,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617772),(7232,16,1,2130706433,'ForumPostReply',22,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617815),(7233,16,1,2130706433,'ForumPostReply',23,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617827),(7234,16,1,2130706433,'ForumPostReply',24,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617948),(7235,16,1,2130706433,'ForumPostReply',25,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418617985),(7236,16,1,2130706433,'ForumPostReply',26,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418618039),(7237,16,1,2130706433,'ForumPostReply',27,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418618115),(7238,16,1,2130706433,'ForumPostReply',28,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418618171),(7239,16,1,2130706433,'ForumPostReply',29,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418618272),(7240,16,1,2130706433,'ForumPostReply',30,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418618297),(7241,16,1,2130706433,'ForumPostReply',31,'操作url：/index.php?s=/forum/index/doreply/post_id/3.html',1,1418618411),(7242,16,1,2130706433,'ForumPostReply',32,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418618477),(7243,16,1,2130706433,'ForumPostReply',33,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418618501),(7244,16,1,2130706433,'ForumPostReply',34,'操作url：/index.php?s=/forum/index/doreply/post_id/3.html',1,1418618611),(7245,16,1,2130706433,'ForumPostReply',35,'操作url：/index.php?s=/forum/index/doreply/post_id/3.html',1,1418622704),(7246,16,1,2130706433,'ForumLzlReply',84,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418622818),(7247,16,1,2130706433,'ForumLzlReply',85,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418623015),(7248,16,1,2130706433,'ForumLzlReply',86,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418624494),(7249,16,1,2130706433,'ForumLzlReply',87,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418624501),(7250,16,1,2130706433,'ForumPostReply',36,'操作url：/index.php?s=/forum/index/doreply/post_id/3.html',1,1418624535),(7251,16,1,2130706433,'ForumPostReply',37,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418624580),(7252,16,1,2130706433,'ForumPostReply',38,'操作url：/index.php?s=/forum/index/doreply/post_id/3.html',1,1418624604),(7253,16,1,2130706433,'ForumPostReply',39,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418624619),(7254,16,1,2130706433,'ForumPostReply',40,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418624652),(7255,16,1,2130706433,'ForumLzlReply',88,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418624679),(7256,16,1,2130706433,'ForumLzlReply',89,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418624821),(7257,16,1,2130706433,'ForumPostReply',41,'操作url：/index.php?s=/forum/index/doreply/post_id/3.html',1,1418625069),(7258,16,1,2130706433,'ForumPostReply',42,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418625313),(7259,16,1,2130706433,'ForumLzlReply',90,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418625849),(7260,16,1,2130706433,'ForumLzlReply',91,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418626000),(7261,16,1,2130706433,'ForumLzlReply',92,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418626058),(7262,16,1,2130706433,'ForumLzlReply',93,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418626116),(7263,16,1,2130706433,'ForumLzlReply',94,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418626222),(7264,16,1,2130706433,'ForumLzlReply',95,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418626249),(7265,1,1,2130706433,'member',1,'admin在2014-12-15 15:00登录了后台',1,1418626851),(7266,1,1,2130706433,'member',1,'admin在2014-12-15 16:00登录了后台',1,1418630412),(7267,16,1,2130706433,'ForumPostReply',43,'操作url：/index.php?s=/forum/index/doreply/post_id/2.html',1,1418630424),(7268,16,1,2130706433,'ForumPostReply',44,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418630586),(7269,16,1,2130706433,'ForumPostReply',45,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418630655),(7270,16,1,2130706433,'ForumPostReply',46,'操作url：/index.php?s=/forum/index/doreply/post_id/1.html',1,1418630799),(7271,16,1,2130706433,'ForumPostReply',47,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418630816),(7272,16,1,2130706433,'ForumPostReply',48,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418630905),(7273,16,1,2130706433,'ForumPostReply',49,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418630916),(7274,16,1,2130706433,'ForumPostReply',50,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418631061),(7275,16,1,2130706433,'ForumPostReply',51,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418631246),(7276,6,1,2130706433,'config',39,'操作url：/index.php?s=/admin/config/edit.html',1,1418632942),(7277,6,1,2130706433,'config',85,'操作url：/index.php?s=/admin/config/edit.html',1,1418633048),(7278,6,1,2130706433,'config',85,'操作url：/index.php?s=/admin/config/edit.html',1,1418633137),(7279,1,1,2130706433,'member',1,'admin在2014-12-15 16:50登录了后台',1,1418633421),(7280,1,1,2130706433,'member',1,'admin在2014-12-15 16:51登录了后台',1,1418633474),(7281,1,1,2130706433,'member',1,'admin在2014-12-15 17:00登录了后台',1,1418634006),(7282,1,1,2130706433,'member',1,'admin在2014-12-15 17:23登录了后台',1,1418635425),(7283,6,1,2130706433,'config',85,'操作url：/index.php?s=/admin/config/edit.html',1,1418635575),(7284,16,1,2130706433,'ForumPostReply',52,'操作url：/index.php?s=/forum/index/doreply/post_id/3.html',1,1418636033),(7285,16,1,2130706433,'ForumPostReply',53,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418636047),(7286,16,1,2130706433,'ForumPostReply',54,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1418636144),(7287,6,1,2130706433,'config',85,'操作url：/index.php?s=/admin/config/edit.html',1,1418636280),(7288,16,1,2130706433,'ForumLzlReply',96,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418636360),(7289,16,1,2130706433,'ForumLzlReply',97,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418636519),(7290,16,1,2130706433,'ForumLzlReply',98,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418636571),(7291,15,1,2130706433,'ForumPost',5,'操作url：/index.php?s=/forum/index/doedit.html',1,1418637659),(7292,13,1,2130706433,'Weibo',9,'操作url：/index.php?s=/forum/index/doedit.html',1,1418637659),(7293,10,1,2130706433,'Menu',172,'操作url：/index.php?s=/admin/menu/edit.html',1,1418639903),(7294,10,1,2130706433,'Menu',172,'操作url：/index.php?s=/admin/menu/edit.html',1,1418643417),(7295,15,1,2130706433,'ForumPost',6,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721276),(7296,15,1,2130706433,'ForumPost',7,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721308),(7297,15,1,2130706433,'ForumPost',8,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721513),(7298,15,1,2130706433,'ForumPost',9,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721517),(7299,15,1,2130706433,'ForumPost',10,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721551),(7300,15,1,2130706433,'ForumPost',11,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721607),(7301,15,1,2130706433,'ForumPost',12,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721615),(7302,15,1,2130706433,'ForumPost',13,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721652),(7303,15,1,2130706433,'ForumPost',14,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721786),(7304,13,1,2130706433,'Weibo',10,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721786),(7305,15,1,2130706433,'ForumPost',15,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721925),(7306,13,1,2130706433,'Weibo',11,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721925),(7307,15,1,2130706433,'ForumPost',16,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721990),(7308,13,1,2130706433,'Weibo',12,'操作url：/index.php?s=/forum/index/doedit.html',1,1418721990),(7309,13,1,2130706433,'Weibo',13,'操作url：/index.php?s=/forum/index/doedit.html',1,1418724876),(7310,13,1,2130706433,'Weibo',14,'操作url：/index.php?s=/forum/index/doedit.html',1,1418725053),(7311,13,1,2130706433,'Weibo',15,'操作url：/index.php?s=/forum/index/doedit.html',1,1418726697),(7312,13,1,2130706433,'Weibo',16,'操作url：/index.php?s=/forum/index/doedit.html',1,1418726744),(7313,13,1,2130706433,'Weibo',17,'操作url：/index.php?s=/forum/index/doedit.html',1,1418726754),(7314,13,1,2130706433,'Weibo',18,'操作url：/index.php?s=/forum/index/doedit.html',1,1418726785),(7315,13,1,2130706433,'Weibo',19,'操作url：/index.php?s=/forum/index/doedit.html',1,1418726925),(7316,13,1,2130706433,'Weibo',20,'操作url：/index.php?s=/forum/index/doedit.html',1,1418726941),(7317,13,1,2130706433,'Weibo',21,'操作url：/index.php?s=/forum/index/doedit.html',1,1418727113),(7318,13,1,2130706433,'Weibo',22,'操作url：/index.php?s=/forum/index/doedit.html',1,1418727123),(7319,13,1,2130706433,'Weibo',23,'操作url：/index.php?s=/forum/index/doedit.html',1,1418727130),(7320,13,1,2130706433,'Weibo',24,'操作url：/index.php?s=/forum/index/doedit.html',1,1418727256),(7321,13,1,2130706433,'Weibo',25,'操作url：/index.php?s=/forum/index/doedit.html',1,1418735649),(7322,10,1,2130706433,'Menu',2235,'操作url：/index.php?s=/admin/menu/add.html',1,1418735939),(7323,10,1,2130706433,'Menu',2235,'操作url：/index.php?s=/admin/menu/edit.html',1,1418735997),(7324,10,1,2130706433,'Menu',2235,'操作url：/index.php?s=/admin/menu/edit.html',1,1418736086),(7325,10,1,2130706433,'Menu',2236,'操作url：/index.php?s=/admin/menu/add.html',1,1418736131),(7326,10,1,2130706433,'Menu',2237,'操作url：/index.php?s=/admin/menu/add.html',1,1418736163),(7327,10,1,2130706433,'Menu',2237,'操作url：/index.php?s=/admin/menu/edit.html',1,1418736203),(7328,10,1,2130706433,'Menu',2236,'操作url：/index.php?s=/admin/menu/edit.html',1,1418736357),(7329,10,1,2130706433,'Menu',2237,'操作url：/index.php?s=/admin/menu/edit.html',1,1418736369),(7330,10,1,2130706433,'Menu',0,'操作url：/index.php?s=/admin/menu/del.html',1,1418736379),(7331,10,1,2130706433,'Menu',2236,'操作url：/index.php?s=/admin/menu/edit.html',1,1418736576),(7332,10,1,2130706433,'Menu',0,'操作url：/index.php?s=/admin/menu/del/id/2237.html',1,1418740582),(7333,10,1,2130706433,'Menu',2238,'操作url：/index.php?s=/admin/menu/add.html',1,1418741961),(7334,10,1,2130706433,'Menu',2238,'操作url：/index.php?s=/admin/menu/edit.html',1,1418742004),(7335,13,1,2130706433,'Weibo',26,'操作url：/index.php?s=/forum/index/doedit.html',1,1418742497),(7336,13,1,2130706433,'Weibo',27,'操作url：/index.php?s=/forum/index/doedit.html',1,1418745286),(7337,13,1,2130706433,'Weibo',28,'操作url：/index.php?s=/forum/index/doedit.html',1,1418745380),(7338,13,1,2130706433,'Weibo',29,'操作url：/index.php?s=/forum/index/doedit.html',1,1418745399),(7339,13,1,2130706433,'Weibo',30,'操作url：/index.php?s=/forum/index/doedit.html',1,1418745617),(7340,13,1,2130706433,'Weibo',31,'操作url：/index.php?s=/forum/index/doedit.html',1,1418745632),(7341,13,1,2130706433,'Weibo',32,'操作url：/index.php?s=/forum/index/doedit.html',1,1418745641),(7342,15,1,2130706433,'ForumPost',17,'操作url：/index.php?s=/forum/index/doedit.html',1,1418787711),(7343,13,1,2130706433,'Weibo',33,'操作url：/index.php?s=/forum/index/doedit.html',1,1418787711),(7344,15,1,2130706433,'ForumPost',18,'操作url：/index.php?s=/forum/index/doedit.html',1,1418787742),(7345,13,1,2130706433,'Weibo',34,'操作url：/index.php?s=/forum/index/doedit.html',1,1418787742),(7346,15,1,2130706433,'ForumPost',19,'操作url：/index.php?s=/forum/index/doedit.html',1,1418788256),(7347,13,1,2130706433,'Weibo',35,'操作url：/index.php?s=/forum/index/doedit.html',1,1418788256),(7348,1,61,2130706433,'member',61,'apacal在2014-12-17 13:46登录了后台',1,1418795174),(7349,1,1,2130706433,'member',1,'admin在2014-12-17 14:09登录了后台',1,1418796584),(7350,1,1,2130706433,'member',1,'admin在2014-12-17 14:12登录了后台',1,1418796722),(7351,1,1,2130706433,'member',1,'admin在2014-12-17 14:13登录了后台',1,1418796802),(7352,16,1,2130706433,'ForumPostReply',55,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1418797496),(7353,1,1,2130706433,'member',1,'admin在2014-12-17 22:55登录了后台',1,1418828135),(7354,1,1,2130706433,'member',1,'admin在2014-12-17 22:57登录了后台',1,1418828257),(7355,1,61,2130706433,'member',61,'apacal在2014-12-17 23:01登录了后台',1,1418828504),(7356,16,61,2130706433,'ForumPostReply',56,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1418828522),(7357,16,61,2130706433,'ForumLzlReply',99,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418828598),(7358,16,61,2130706433,'ForumLzlReply',100,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418828619),(7359,1,1,2130706433,'member',1,'admin在2014-12-17 23:05登录了后台',1,1418828719),(7360,16,1,2130706433,'ForumLzlReply',101,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1418828738),(7361,1,1,2130706433,'member',1,'admin在2014-12-18 10:55登录了后台',1,1418871332),(7362,1,61,2130706433,'member',61,'apacal在2014-12-18 12:36登录了后台',1,1418877412),(7363,16,61,2130706433,'ForumPostReply',57,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1418877427),(7364,16,61,2130706433,'ForumPostReply',58,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1418877441),(7365,1,1,2130706433,'member',1,'admin在2014-12-18 12:37登录了后台',1,1418877455),(7366,1,1,2130706433,'member',1,'admin在2014-12-18 14:05登录了后台',1,1418882755),(7367,10,1,2130706433,'Menu',2239,'操作url：/index.php?s=/admin/menu/add.html',1,1418882819),(7368,15,1,2130706433,'ForumPost',20,'操作url：/index.php?s=/forum/index/doedit.html',1,1418892855),(7369,13,1,2130706433,'Weibo',37,'操作url：/index.php?s=/forum/index/doedit.html',1,1418892855),(7370,13,1,2130706433,'Weibo',38,'操作url：/index.php?s=/forum/index/doedit.html',1,1418892943),(7371,13,1,2130706433,'Weibo',39,'操作url：/index.php?s=/forum/index/doedit.html',1,1418893135),(7372,13,1,2130706433,'Weibo',40,'操作url：/index.php?s=/forum/index/doedit.html',1,1418893274),(7373,16,1,2130706433,'ForumPostReply',59,'操作url：/index.php?s=/forum/index/doreply/post_id/20.html',1,1418893298),(7374,16,1,2130706433,'ForumPostReply',60,'操作url：/index.php?s=/forum/index/doreply/post_id/20.html',1,1418894155),(7375,13,1,2130706433,'Weibo',41,'操作url：/index.php?s=/forum/index/doedit.html',1,1418894369),(7376,1,1,2130706433,'member',1,'admin在2014-12-18 17:25登录了后台',1,1418894710),(7377,1,61,2130706433,'member',61,'apacal在2014-12-18 17:25登录了后台',1,1418894736),(7378,16,61,2130706433,'ForumPostReply',61,'操作url：/index.php?s=/forum/index/doreply/post_id/20.html',1,1418894758),(7379,15,61,2130706433,'ForumPost',21,'操作url：/index.php?s=/forum/index/doedit.html',1,1418894823),(7380,13,61,2130706433,'Weibo',42,'操作url：/index.php?s=/forum/index/doedit.html',1,1418894823),(7381,13,61,2130706433,'Weibo',43,'操作url：/index.php?s=/forum/index/doedit.html',1,1418894839),(7382,16,61,2130706433,'ForumPostReply',62,'操作url：/index.php?s=/forum/index/doreply/post_id/21.html',1,1418894855),(7383,1,1,2130706433,'member',1,'admin在2014-12-18 17:27登录了后台',1,1418894874),(7384,1,1,2130706433,'member',1,'admin在2014-12-19 15:50登录了后台',1,1418975432),(7385,10,1,2130706433,'Menu',2240,'操作url：/index.php?s=/admin/menu/add.html',1,1418982129),(7386,10,1,2130706433,'Menu',2240,'操作url：/index.php?s=/admin/menu/edit.html',1,1418982174),(7387,10,1,2130706433,'Menu',2240,'操作url：/index.php?s=/admin/menu/edit.html',1,1418983205),(7388,10,1,2130706433,'Menu',2240,'操作url：/index.php?s=/admin/menu/edit.html',1,1418983236),(7389,10,1,2130706433,'Menu',2241,'操作url：/index.php?s=/admin/menu/add.html',1,1418986029),(7390,10,1,2130706433,'Menu',149,'操作url：/index.php?s=/admin/menu/edit.html',1,1418987585),(7391,10,1,2130706433,'Menu',2240,'操作url：/index.php?s=/admin/menu/edit.html',1,1418987675),(7392,10,1,2130706433,'Menu',2240,'操作url：/index.php?s=/admin/menu/edit.html',1,1418987712),(7393,10,1,2130706433,'Menu',2240,'操作url：/index.php?s=/admin/menu/edit.html',1,1418987816),(7394,10,1,2130706433,'Menu',2242,'操作url：/index.php?s=/admin/menu/add.html',1,1418992905),(7395,10,1,2130706433,'Menu',2243,'操作url：/index.php?s=/admin/menu/add.html',1,1419000344),(7396,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008071),(7397,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008074),(7398,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008079),(7399,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008080),(7400,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008080),(7401,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008081),(7402,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008081),(7403,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008082),(7404,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008082),(7405,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008083),(7406,1,61,2130706433,'member',61,'apacal在2014-12-20 00:54登录了后台',1,1419008093),(7407,1,1,2130706433,'member',1,'admin在2014-12-20 00:55登录了后台',1,1419008108),(7408,1,1,2130706433,'member',1,'admin在2014-12-20 12:01登录了后台',1,1419048066),(7409,1,1,2130706433,'member',1,'admin在2014-12-20 12:04登录了后台',1,1419048255),(7410,1,1,2130706433,'member',1,'admin在2014-12-22 14:29登录了后台',1,1419229768),(7411,1,1,2130706433,'member',1,'admin在2014-12-22 14:29登录了后台',1,1419229789),(7412,15,1,2130706433,'ForumPost',22,'操作url：/index.php?s=/forum/index/doedit.html',1,1419236703),(7413,13,1,2130706433,'Weibo',50,'操作url：/index.php?s=/forum/index/doedit.html',1,1419236703),(7414,15,1,2130706433,'ForumPost',23,'操作url：/index.php?s=/forum/index/doedit.html',1,1419236716),(7415,13,1,2130706433,'Weibo',51,'操作url：/index.php?s=/forum/index/doedit.html',1,1419236716),(7416,15,1,2130706433,'ForumPost',24,'操作url：/index.php?s=/forum/index/doedit.html',1,1419238711),(7417,13,1,2130706433,'Weibo',52,'操作url：/index.php?s=/forum/index/doedit.html',1,1419238711),(7418,16,1,2130706433,'ForumPostReply',63,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1419307682),(7419,1,1,2130706433,'member',1,'admin在2014-12-23 14:48登录了后台',1,1419317328),(7420,10,1,2130706433,'Menu',2244,'操作url：/index.php?s=/admin/menu/add.html',1,1419317977),(7421,10,1,2130706433,'Menu',2244,'操作url：/index.php?s=/admin/menu/edit.html',1,1419318025),(7422,10,1,2130706433,'Menu',2245,'操作url：/index.php?s=/admin/menu/add.html',1,1419318195),(7423,1,1,2130706433,'member',1,'admin在2014-12-23 16:20登录了后台',1,1419322856),(7424,6,1,2130706433,'config',87,'操作url：/index.php?s=/admin/config/edit.html',1,1419325399),(7425,6,1,2130706433,'config',88,'操作url：/index.php?s=/admin/config/edit.html',1,1419328187),(7426,6,1,2130706433,'config',88,'操作url：/index.php?s=/admin/config/edit.html',1,1419328203),(7427,16,1,2130706433,'ForumPostReply',64,'操作url：/index.php?s=/forum/index/doreply/post_id/3/content/test.html',1,1419329542),(7428,1,1,2130706433,'member',1,'admin在2014-12-23 20:30登录了后台',1,1419337806),(7429,1,1,2130706433,'member',1,'admin在2014-12-23 20:56登录了后台',1,1419339385),(7430,1,1,2130706433,'member',1,'admin在2014-12-23 20:58登录了后台',1,1419339496),(7431,1,1,2130706433,'member',1,'admin在2014-12-23 21:01登录了后台',1,1419339687),(7432,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:12增加了钱包',1,1419340327),(7433,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:16增加了钱包',1,1419340588),(7434,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:17增加了钱包',1,1419340638),(7435,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:17增加了钱包',1,1419340658),(7436,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:17增加了钱包',1,1419340670),(7437,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:17增加了钱包',1,1419340671),(7438,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:17增加了钱包',1,1419340678),(7439,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:18增加了钱包',1,1419340681),(7440,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:18增加了钱包',1,1419340732),(7441,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:19增加了钱包',1,1419340784),(7442,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:20增加了钱包',1,1419340835),(7443,17,1,2130706433,'Wallet',1,'admin在2014-12-23 21:29增加了钱包',1,1419341361),(7444,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/add.html',1,1419341482),(7445,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/edit.html',1,1419343781),(7446,10,1,2130706433,'Menu',2247,'操作url：/index.php?s=/admin/menu/add.html',1,1419343838),(7447,10,1,2130706433,'Menu',2247,'操作url：/index.php?s=/admin/menu/edit.html',1,1419343862),(7448,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/edit.html',1,1419343924),(7449,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/edit.html',1,1419343935),(7450,10,1,2130706433,'Menu',2244,'操作url：/index.php?s=/admin/menu/edit.html',1,1419343954),(7451,10,1,2130706433,'Menu',2248,'操作url：/index.php?s=/admin/menu/add.html',1,1419344025),(7452,17,1,2130706433,'Wallet',1,'admin在2014-12-23 22:19增加了钱包',1,1419344392),(7453,10,1,2130706433,'Menu',2249,'操作url：/index.php?s=/admin/menu/add.html',1,1419345353),(7454,10,1,2130706433,'Menu',2250,'操作url：/index.php?s=/admin/menu/add.html',1,1419346985),(7455,6,1,2130706433,'config',90,'操作url：/index.php?s=/admin/config/edit.html',1,1419347277),(7456,1,62,2130706433,'member',62,'richard在2014-12-23 23:13登录了后台',1,1419347620),(7457,1,1,2130706433,'member',1,'admin在2014-12-23 23:14登录了后台',1,1419347655),(7458,1,1,2130706433,'member',1,'admin在2014-12-23 23:14登录了后台',1,1419347660),(7459,1,63,2130706433,'member',63,'rich在2014-12-23 23:16登录了后台',1,1419347801),(7460,1,1,2130706433,'member',1,'admin在2014-12-24 15:25登录了后台',1,1419405932),(7461,1,1,2130706433,'member',1,'admin在2014-12-24 15:25登录了后台',1,1419405938),(7462,10,1,2130706433,'Menu',0,'操作url：/index.php?s=/admin/menu/del/id/172.html',1,1419406061),(7463,10,1,2130706433,'Menu',0,'操作url：/index.php?s=/admin/menu/del/id/188.html',1,1419406075),(7464,10,1,2130706433,'Menu',0,'操作url：/index.php?s=/admin/menu/del/id/93.html',1,1419406091),(7465,10,1,2130706433,'Menu',0,'操作url：/index.php?s=/admin/menu/del/id/154.html',1,1419406094),(7466,10,1,2130706433,'Menu',0,'操作url：/index.php?s=/admin/menu/del/id/2.html',1,1419406115),(7467,10,1,2130706433,'Menu',122,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406127),(7468,10,1,2130706433,'Menu',125,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406146),(7469,10,1,2130706433,'Menu',142,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406174),(7470,10,1,2130706433,'Menu',2217,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406335),(7471,10,1,2130706433,'Menu',2218,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406354),(7472,10,1,2130706433,'Menu',2222,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406389),(7473,10,1,2130706433,'Menu',2223,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406401),(7474,10,1,2130706433,'Menu',2228,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406411),(7475,10,1,2130706433,'Menu',2233,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406424),(7476,10,1,2130706433,'Menu',2234,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406435),(7477,10,1,2130706433,'Menu',2245,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406677),(7478,10,1,2130706433,'Menu',2218,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406819),(7479,10,1,2130706433,'Menu',219,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406911),(7480,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406967),(7481,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/edit.html',1,1419406988),(7482,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/edit.html',1,1419407043),(7483,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/edit.html',1,1419407183),(7484,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/edit.html',1,1419407241),(7485,10,1,2130706433,'Menu',2246,'操作url：/index.php?s=/admin/menu/edit.html',1,1419407252),(7486,1,1,2130706433,'member',1,'admin在2014-12-29 18:06登录了后台',1,1419847608),(7487,9,1,2130706433,'channel',2,'操作url：/index.php?s=/admin/channel/edit.html',1,1419847715),(7488,9,1,2130706433,'channel',0,'操作url：/index.php?s=/admin/channel/del/id/1.html',1,1419847721),(7489,9,1,2130706433,'channel',0,'操作url：/index.php?s=/admin/channel/del/id/4.html',1,1419847728),(7490,9,1,2130706433,'channel',0,'操作url：/index.php?s=/admin/channel/del/id/11.html',1,1419847736),(7491,9,1,2130706433,'channel',0,'操作url：/index.php?s=/admin/channel/del/id/14.html',1,1419847752),(7492,9,1,2130706433,'channel',0,'操作url：/index.php?s=/admin/channel/del/id/13.html',1,1419847758),(7493,9,1,2130706433,'channel',16,'操作url：/index.php?s=/admin/channel/edit.html',1,1419847785),(7494,1,1,2130706433,'member',1,'admin在2014-12-29 18:13登录了后台',1,1419848028),(7495,1,1,2130706433,'member',1,'admin在2014-12-29 20:16登录了后台',1,1419855367),(7496,6,1,2130706433,'config',60,'操作url：/index.php?s=/admin/config/edit.html',1,1419855526),(7497,1,1,2130706433,'member',1,'admin在2014-12-29 20:19登录了后台',1,1419855549),(7498,16,1,2130706433,'ForumPostReply',65,'操作url：/index.php?s=/forum/index/doreply/post_id/24.html',1,1419855571),(7499,15,1,2130706433,'ForumPost',25,'操作url：/index.php?s=/forum/index/doedit.html',1,1419855648),(7500,13,1,2130706433,'Weibo',54,'操作url：/index.php?s=/forum/index/doedit.html',1,1419855648),(7501,16,1,2130706433,'ForumPostReply',66,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1419859264),(7502,16,1,2130706433,'ForumPostReply',67,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1419859345),(7503,1,1,2130706433,'member',1,'admin在2014-12-29 23:19登录了后台',1,1419866343),(7504,16,1,2130706433,'ForumPostReply',68,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1419870220),(7505,16,1,2130706433,'ForumPostReply',69,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1419870692),(7506,16,1,2130706433,'ForumPostReply',70,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1419870806),(7507,16,1,2130706433,'ForumPostReply',71,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1419870922),(7508,16,1,2130706433,'ForumLzlReply',102,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1419871001),(7509,16,1,2130706433,'ForumLzlReply',103,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1419871012),(7510,16,1,2130706433,'ForumPostReply',72,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1419871266),(7511,16,1,2130706433,'ForumLzlReply',104,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1419871550),(7512,16,1,2130706433,'ForumLzlReply',105,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1419871555),(7513,16,1,2130706433,'ForumLzlReply',106,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1419871565),(7514,13,1,2130706433,'Weibo',55,'操作url：/index.php?s=/forum/index/doedit.html',1,1419871588),(7515,13,1,2130706433,'Weibo',56,'操作url：/index.php?s=/forum/index/doedit.html',1,1419872894),(7516,13,1,2130706433,'Weibo',57,'操作url：/index.php?s=/forum/index/doedit.html',1,1419872914),(7517,13,1,2130706433,'Weibo',58,'操作url：/index.php?s=/forum/index/doedit.html',1,1419872944),(7518,13,1,2130706433,'Weibo',59,'操作url：/index.php?s=/forum/index/doedit.html',1,1419873166),(7519,13,1,2130706433,'Weibo',60,'操作url：/index.php?s=/forum/index/doedit.html',1,1419873183),(7520,1,1,2130706433,'member',1,'admin在2014-12-30 01:13登录了后台',1,1419873225),(7521,1,1,2130706433,'member',1,'admin在2014-12-30 01:13登录了后台',1,1419873234),(7522,1,62,2130706433,'member',62,'richard在2014-12-30 01:14登录了后台',1,1419873267),(7523,16,62,2130706433,'ForumPostReply',73,'操作url：/index.php?s=/forum/index/doreply/post_id/19.html',1,1419873279),(7524,16,62,2130706433,'ForumLzlReply',107,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1419873292),(7525,16,62,2130706433,'ForumLzlReply',108,'操作url：/index.php?s=/forum/lzl/dosendlzlreply.html',1,1419873297),(7526,1,1,2130706433,'member',1,'admin在2014-12-30 01:15登录了后台',1,1419873324),(7527,1,1,2130706433,'member',1,'admin在2014-12-30 11:39登录了后台',1,1419910759);
/*!40000 ALTER TABLE `mj_action_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_addons`
--

DROP TABLE IF EXISTS `mj_addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COMMENT='插件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_addons`
--

LOCK TABLES `mj_addons` WRITE;
/*!40000 ALTER TABLE `mj_addons` DISABLE KEYS */;
INSERT INTO `mj_addons` VALUES (15,'EditorForAdmin','后台编辑器','用于增强整站长文本的输入和显示',1,'{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"500px\",\"editor_resize_type\":\"1\"}','thinkphp','0.1',1383126253,0),(2,'SiteStat','站点统计信息','统计站点的基础信息',1,'{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"1\",\"display\":\"1\",\"status\":\"0\"}','thinkphp','0.1',1379512015,0),(89,'DevTeam','开发团队信息','开发团队成员信息',1,'{\"title\":\"ThinkOX\\u5f00\\u53d1\\u56e2\\u961f\",\"width\":\"2\",\"display\":\"1\"}','thinkphp','0.1',1409038881,0),(4,'SystemInfo','系统环境信息','用于显示一些服务器的信息',1,'{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"2\",\"display\":\"1\"}','thinkphp','0.1',1379512036,0),(5,'Editor','前台编辑器','用于增强整站长文本的输入和显示',1,'{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"300px\",\"editor_resize_type\":\"1\"}','thinkphp','0.1',1379830910,0),(6,'Attachment','附件','用于文档模型上传附件',1,'null','thinkphp','0.1',1379842319,1),(9,'SocialComment','通用社交化评论','集成了各种社交化评论插件，轻松集成到系统中。',1,'{\"comment_type\":\"1\",\"comment_uid_youyan\":\"\",\"comment_short_name_duoshuo\":\"\",\"comment_data_list_duoshuo\":\"\"}','thinkphp','0.1',1380273962,0),(16,'Avatar','头像插件','用于头像的上传',1,'{\"random\":\"1\"}','caipeichao','0.1',1394449710,1),(49,'Checkin','签到','签到积分',1,'{\"random\":\"1\"}','想天软件工作室','0.1',1403764341,1),(58,'SyncLogin','同步登陆','同步登陆',1,'{\"type\":null,\"meta\":\"\",\"bind\":\"0\",\"QqKEY\":\"\",\"QqSecret\":\"\",\"SinaKEY\":\"\",\"SinaSecret\":\"\"}','xjw129xjt','0.1',1406598876,0),(41,'LocalComment','本地评论','本地评论插件，不依赖社会化评论平台',1,'{\"can_guest_comment\":\"1\"}','caipeichao','0.1',1399440324,0),(44,'InsertImage','插入图片','微博上传图片',1,'null','想天软件工作室','0.1',1402390777,0),(48,'Repost','转发','转发',1,'null','想天软件工作室','0.1',1403763025,0),(63,'Advertising','广告位置','广告位插件',1,'null','onep2p','0.1',1406689090,1),(64,'Advs','广告管理','广告插件',1,'null','onep2p','0.1',1406689131,1),(68,'ImageSlider','图片轮播','图片轮播，需要先通过 http://www.onethink.cn/topic/2153.html 的方法，让配置支持多图片上传',1,'{\"second\":\"3000\",\"direction\":\"horizontal\",\"imgWidth\":\"760\",\"imgHeight\":\"350\",\"url\":\"\",\"images\":\"92,93,94\"}','birdy','0.1',1407144129,0),(70,'SuperLinks','合作单位','合作单位',1,'{\"random\":\"1\"}','苏南 newsn.net','0.1',1407156572,1),(91,'Rank_checkin','签到排名','设置每天某一时刻开始 按时间先后 签到排名，取前十',1,'{\"random\":\"1\",\"ranktime\":null}','嘉兴想天信息科技有限公司','0.1',1409109841,1),(84,'Support','赞','赞的功能',1,'null','嘉兴想天信息科技有限公司','0.1',1408499141,0);
/*!40000 ALTER TABLE `mj_addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_advertising`
--

DROP TABLE IF EXISTS `mj_advertising`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_advertising` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '广告位置名称',
  `type` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '广告位置展示方式  0为默认展示一张',
  `width` char(20) NOT NULL DEFAULT '' COMMENT '广告位置宽度',
  `height` char(20) NOT NULL DEFAULT '' COMMENT '广告位置高度',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用，1：正常）',
  `pos` varchar(50) NOT NULL,
  `style` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='广告位置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_advertising`
--

LOCK TABLES `mj_advertising` WRITE;
/*!40000 ALTER TABLE `mj_advertising` DISABLE KEYS */;
INSERT INTO `mj_advertising` VALUES (1,'微博发布框下方',2,'620','87',1,'weibo_below_sendbox',0),(2,'微博首页签到排行下方',4,'','',1,'weibo_below_checkrank',0),(3,'首页1号广告位',1,'756','100',1,'home_ad1',0);
/*!40000 ALTER TABLE `mj_advertising` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_advs`
--

DROP TABLE IF EXISTS `mj_advs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_advs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '广告名称',
  `position` int(11) NOT NULL COMMENT '广告位置',
  `advspic` int(11) NOT NULL COMMENT '图片地址',
  `advstext` text NOT NULL COMMENT '文字广告内容',
  `advshtml` text NOT NULL COMMENT '代码广告内容',
  `link` char(140) NOT NULL DEFAULT '' COMMENT '链接地址',
  `level` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用，1：正常）',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='广告表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_advs`
--

LOCK TABLES `mj_advs` WRITE;
/*!40000 ALTER TABLE `mj_advs` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_advs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_attachment`
--

DROP TABLE IF EXISTS `mj_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '附件显示名',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件类型',
  `source` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源ID',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联记录ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '附件大小',
  `dir` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '上级目录ID',
  `sort` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `idx_record_status` (`record_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_attachment`
--

LOCK TABLES `mj_attachment` WRITE;
/*!40000 ALTER TABLE `mj_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_attribute`
--

DROP TABLE IF EXISTS `mj_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段注释',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `validate_rule` varchar(255) NOT NULL,
  `validate_time` tinyint(1) unsigned NOT NULL,
  `error_info` varchar(100) NOT NULL,
  `validate_type` varchar(25) NOT NULL,
  `auto_rule` varchar(100) NOT NULL,
  `auto_time` tinyint(1) unsigned NOT NULL,
  `auto_type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='模型属性表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_attribute`
--

LOCK TABLES `mj_attribute` WRITE;
/*!40000 ALTER TABLE `mj_attribute` DISABLE KEYS */;
INSERT INTO `mj_attribute` VALUES (1,'uid','用户ID','int(10) unsigned NOT NULL ','num','0','',0,'',1,0,1,1384508362,1383891233,'',0,'','','',0,''),(2,'name','标识','char(40) NOT NULL ','string','','同一根节点下标识不重复',1,'',1,0,1,1383894743,1383891233,'',0,'','','',0,''),(3,'title','标题','char(80) NOT NULL ','string','','文档标题',1,'',1,0,1,1383894778,1383891233,'',0,'','','',0,''),(4,'category_id','所属分类','int(10) unsigned NOT NULL ','string','','',0,'',1,0,1,1384508336,1383891233,'',0,'','','',0,''),(5,'description','描述','char(140) NOT NULL ','textarea','','',1,'',1,0,1,1383894927,1383891233,'',0,'','','',0,''),(6,'root','根节点','int(10) unsigned NOT NULL ','num','0','该文档的顶级文档编号',0,'',1,0,1,1384508323,1383891233,'',0,'','','',0,''),(7,'pid','所属ID','int(10) unsigned NOT NULL ','num','0','父文档编号',0,'',1,0,1,1384508543,1383891233,'',0,'','','',0,''),(8,'model_id','内容模型ID','tinyint(3) unsigned NOT NULL ','num','0','该文档所对应的模型',0,'',1,0,1,1384508350,1383891233,'',0,'','','',0,''),(9,'type','内容类型','tinyint(3) unsigned NOT NULL ','select','2','',1,'1:目录\r\n2:主题\r\n3:段落',1,0,1,1384511157,1383891233,'',0,'','','',0,''),(10,'position','推荐位','smallint(5) unsigned NOT NULL ','checkbox','0','多个推荐则将其推荐值相加',1,'1:列表推荐\r\n2:频道页推荐\r\n4:首页推荐',1,0,1,1383895640,1383891233,'',0,'','','',0,''),(11,'link_id','外链','int(10) unsigned NOT NULL ','num','0','0-非外链，大于0-外链ID,需要函数进行链接与编号的转换',1,'',1,0,1,1383895757,1383891233,'',0,'','','',0,''),(12,'cover_id','封面','int(10) unsigned NOT NULL ','picture','0','0-无封面，大于0-封面图片ID，需要函数处理',1,'',1,0,1,1384147827,1383891233,'',0,'','','',0,''),(13,'display','可见性','tinyint(3) unsigned NOT NULL ','radio','1','',1,'0:不可见\r\n1:所有人可见',1,0,1,1386662271,1383891233,'',0,'','regex','',0,'function'),(14,'deadline','截至时间','int(10) unsigned NOT NULL ','datetime','0','0-永久有效',1,'',1,0,1,1387163248,1383891233,'',0,'','regex','',0,'function'),(15,'attach','附件数量','tinyint(3) unsigned NOT NULL ','num','0','',0,'',1,0,1,1387260355,1383891233,'',0,'','regex','',0,'function'),(16,'view','浏览量','int(10) unsigned NOT NULL ','num','0','',1,'',1,0,1,1383895835,1383891233,'',0,'','','',0,''),(17,'comment','评论数','int(10) unsigned NOT NULL ','num','0','',1,'',1,0,1,1383895846,1383891233,'',0,'','','',0,''),(18,'extend','扩展统计字段','int(10) unsigned NOT NULL ','num','0','根据需求自行使用',0,'',1,0,1,1384508264,1383891233,'',0,'','','',0,''),(19,'level','优先级','int(10) unsigned NOT NULL ','num','0','越高排序越靠前',1,'',1,0,1,1383895894,1383891233,'',0,'','','',0,''),(20,'create_time','创建时间','int(10) unsigned NOT NULL ','datetime','0','',1,'',1,0,1,1383895903,1383891233,'',0,'','','',0,''),(21,'update_time','更新时间','int(10) unsigned NOT NULL ','datetime','0','',0,'',1,0,1,1384508277,1383891233,'',0,'','','',0,''),(22,'status','数据状态','tinyint(4) NOT NULL ','radio','0','',0,'-1:删除\r\n0:禁用\r\n1:正常\r\n2:待审核\r\n3:草稿',1,0,1,1384508496,1383891233,'',0,'','','',0,''),(23,'parse','内容解析类型','tinyint(3) unsigned NOT NULL ','select','0','',0,'0:html\r\n1:ubb\r\n2:markdown',2,0,1,1384511049,1383891243,'',0,'','','',0,''),(24,'content','文章内容','text NOT NULL ','editor','','',1,'',2,0,1,1383896225,1383891243,'',0,'','','',0,''),(25,'template','详情页显示模板','varchar(100) NOT NULL ','string','','参照display方法参数的定义',1,'',2,0,1,1383896190,1383891243,'',0,'','','',0,''),(26,'bookmark','收藏数','int(10) unsigned NOT NULL ','num','0','',1,'',2,0,1,1383896103,1383891243,'',0,'','','',0,''),(27,'parse','内容解析类型','tinyint(3) unsigned NOT NULL ','select','0','',0,'0:html\r\n1:ubb\r\n2:markdown',3,0,1,1387260461,1383891252,'',0,'','regex','',0,'function'),(28,'content','下载详细描述','text NOT NULL ','editor','','',1,'',3,0,1,1383896438,1383891252,'',0,'','','',0,''),(29,'template','详情页显示模板','varchar(100) NOT NULL ','string','','',1,'',3,0,1,1383896429,1383891252,'',0,'','','',0,''),(30,'file_id','文件ID','int(10) unsigned NOT NULL ','file','0','需要函数处理',1,'',3,0,1,1383896415,1383891252,'',0,'','','',0,''),(31,'download','下载次数','int(10) unsigned NOT NULL ','num','0','',1,'',3,0,1,1383896380,1383891252,'',0,'','','',0,''),(32,'size','文件大小','bigint(20) unsigned NOT NULL ','num','0','单位bit',1,'',3,0,1,1383896371,1383891252,'',0,'','','',0,''),(33,'zx','附件','int(10) UNSIGNED NOT NULL','file','','',1,'',2,0,1,1395988634,1395988634,'',3,'','regex','',3,'function');
/*!40000 ALTER TABLE `mj_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_auth_extend`
--

DROP TABLE IF EXISTS `mj_auth_extend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '用户id',
  `extend_id` mediumint(8) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) unsigned NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限',
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`),
  KEY `uid` (`group_id`),
  KEY `group_id` (`extend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与分类的对应关系表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_auth_extend`
--

LOCK TABLES `mj_auth_extend` WRITE;
/*!40000 ALTER TABLE `mj_auth_extend` DISABLE KEYS */;
INSERT INTO `mj_auth_extend` VALUES (1,1,1),(1,1,2),(1,2,1),(1,2,2),(1,3,1),(1,3,2),(1,4,1),(1,37,1);
/*!40000 ALTER TABLE `mj_auth_extend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_auth_group`
--

DROP TABLE IF EXISTS `mj_auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `only_home` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_auth_group`
--

LOCK TABLES `mj_auth_group` WRITE;
/*!40000 ALTER TABLE `mj_auth_group` DISABLE KEYS */;
INSERT INTO `mj_auth_group` VALUES (1,'admin',1,'管理员','',1,'',0),(5,'admin',1,'注册会员','',-1,'',1),(6,'admin',1,'Admin','',1,'1,2,7,8,9,10,11,12,13,14,15,16,17,18,56,57,58,59,60,71,72,73,74,79,205,206,208,211,215,216',1);
/*!40000 ALTER TABLE `mj_auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_auth_group_access`
--

DROP TABLE IF EXISTS `mj_auth_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_auth_group_access`
--

LOCK TABLES `mj_auth_group_access` WRITE;
/*!40000 ALTER TABLE `mj_auth_group_access` DISABLE KEYS */;
INSERT INTO `mj_auth_group_access` VALUES (1,1),(1,3),(60,1);
/*!40000 ALTER TABLE `mj_auth_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_auth_rule`
--

DROP TABLE IF EXISTS `mj_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  `only_home` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM AUTO_INCREMENT=321 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_auth_rule`
--

LOCK TABLES `mj_auth_rule` WRITE;
/*!40000 ALTER TABLE `mj_auth_rule` DISABLE KEYS */;
INSERT INTO `mj_auth_rule` VALUES (1,'admin',2,'Admin/Index/index','首页',1,'',0),(2,'admin',2,'Admin/Article/mydocument','资讯',1,'',0),(3,'admin',2,'Admin/User/index','用户',1,'',0),(4,'admin',2,'Admin/Addons/index','扩展',1,'',0),(5,'admin',2,'Admin/Config/group','系统',1,'',0),(7,'admin',1,'Admin/article/add','新增',1,'',0),(8,'admin',1,'Admin/article/edit','编辑',1,'',0),(9,'admin',1,'Admin/article/setStatus','改变状态',1,'',0),(10,'admin',1,'Admin/article/update','保存',1,'',0),(11,'admin',1,'Admin/article/autoSave','保存草稿',1,'',0),(12,'admin',1,'Admin/article/move','移动',1,'',0),(13,'admin',1,'Admin/article/copy','复制',1,'',0),(14,'admin',1,'Admin/article/paste','粘贴',1,'',0),(15,'admin',1,'Admin/article/permit','还原',1,'',0),(16,'admin',1,'Admin/article/clear','清空',1,'',0),(17,'admin',1,'Admin/article/index','文档列表',1,'',0),(18,'admin',1,'Admin/article/recycle','回收站',1,'',0),(19,'admin',1,'Admin/User/addaction','新增用户行为',1,'',0),(20,'admin',1,'Admin/User/editaction','编辑用户行为',1,'',0),(21,'admin',1,'Admin/User/saveAction','保存用户行为',1,'',0),(22,'admin',1,'Admin/User/setStatus','变更行为状态',1,'',0),(23,'admin',1,'Admin/User/changeStatus?method=forbidUser','禁用会员',1,'',0),(24,'admin',1,'Admin/User/changeStatus?method=resumeUser','启用会员',1,'',0),(25,'admin',1,'Admin/User/changeStatus?method=deleteUser','删除会员',1,'',0),(26,'admin',1,'Admin/User/index','用户信息',1,'',0),(27,'admin',1,'Admin/User/action','用户行为',1,'',0),(28,'admin',1,'Admin/AuthManager/changeStatus?method=deleteGroup','删除',1,'',0),(29,'admin',1,'Admin/AuthManager/changeStatus?method=forbidGroup','禁用',1,'',0),(30,'admin',1,'Admin/AuthManager/changeStatus?method=resumeGroup','恢复',1,'',0),(31,'admin',1,'Admin/AuthManager/createGroup','新增',1,'',0),(32,'admin',1,'Admin/AuthManager/editGroup','编辑',1,'',0),(33,'admin',1,'Admin/AuthManager/writeGroup','保存用户组',1,'',0),(34,'admin',1,'Admin/AuthManager/group','授权',1,'',0),(35,'admin',1,'Admin/AuthManager/access','访问授权',1,'',0),(36,'admin',1,'Admin/AuthManager/user','成员授权',1,'',0),(37,'admin',1,'Admin/AuthManager/removeFromGroup','解除授权',1,'',0),(38,'admin',1,'Admin/AuthManager/addToGroup','保存成员授权',1,'',0),(39,'admin',1,'Admin/AuthManager/category','分类授权',1,'',0),(40,'admin',1,'Admin/AuthManager/addToCategory','保存分类授权',1,'',0),(41,'admin',1,'Admin/AuthManager/index','权限管理',1,'',0),(42,'admin',1,'Admin/Addons/create','创建',1,'',0),(43,'admin',1,'Admin/Addons/checkForm','检测创建',1,'',0),(44,'admin',1,'Admin/Addons/preview','预览',1,'',0),(45,'admin',1,'Admin/Addons/build','快速生成插件',1,'',0),(46,'admin',1,'Admin/Addons/config','设置',1,'',0),(47,'admin',1,'Admin/Addons/disable','禁用',1,'',0),(48,'admin',1,'Admin/Addons/enable','启用',1,'',0),(49,'admin',1,'Admin/Addons/install','安装',1,'',0),(50,'admin',1,'Admin/Addons/uninstall','卸载',1,'',0),(51,'admin',1,'Admin/Addons/saveconfig','更新配置',1,'',0),(52,'admin',1,'Admin/Addons/adminList','插件后台列表',1,'',0),(53,'admin',1,'Admin/Addons/execute','URL方式访问插件',1,'',0),(54,'admin',1,'Admin/Addons/index','插件管理',1,'',0),(55,'admin',1,'Admin/Addons/hooks','钩子管理',1,'',0),(56,'admin',1,'Admin/model/add','新增',1,'',0),(57,'admin',1,'Admin/model/edit','编辑',1,'',0),(58,'admin',1,'Admin/model/setStatus','改变状态',1,'',0),(59,'admin',1,'Admin/model/update','保存数据',1,'',0),(60,'admin',1,'Admin/Model/index','模型管理',1,'',0),(61,'admin',1,'Admin/Config/edit','编辑',1,'',0),(62,'admin',1,'Admin/Config/del','删除',1,'',0),(63,'admin',1,'Admin/Config/add','新增',1,'',0),(64,'admin',1,'Admin/Config/save','保存',1,'',0),(65,'admin',1,'Admin/Config/group','网站设置',1,'',0),(66,'admin',1,'Admin/Config/index','配置管理',1,'',0),(67,'admin',1,'Admin/Channel/add','新增',1,'',0),(68,'admin',1,'Admin/Channel/edit','编辑',1,'',0),(69,'admin',1,'Admin/Channel/del','删除',1,'',0),(70,'admin',1,'Admin/Channel/index','导航管理',1,'',0),(71,'admin',1,'Admin/Category/edit','编辑',1,'',0),(72,'admin',1,'Admin/Category/add','新增',1,'',0),(73,'admin',1,'Admin/Category/remove','删除',1,'',0),(74,'admin',1,'Admin/Category/index','分类管理',1,'',0),(75,'admin',1,'Admin/file/upload','上传控件',-1,'',0),(76,'admin',1,'Admin/file/uploadPicture','上传图片',-1,'',0),(77,'admin',1,'Admin/file/download','下载',-1,'',0),(94,'admin',1,'Admin/AuthManager/modelauth','模型授权',1,'',0),(79,'admin',1,'Admin/article/batchOperate','导入',1,'',0),(80,'admin',1,'Admin/Database/index?type=export','备份数据库',1,'',0),(81,'admin',1,'Admin/Database/index?type=import','还原数据库',1,'',0),(82,'admin',1,'Admin/Database/export','备份',1,'',0),(83,'admin',1,'Admin/Database/optimize','优化表',1,'',0),(84,'admin',1,'Admin/Database/repair','修复表',1,'',0),(86,'admin',1,'Admin/Database/import','恢复',1,'',0),(87,'admin',1,'Admin/Database/del','删除',1,'',0),(88,'admin',1,'Admin/User/add','新增用户',1,'',0),(89,'admin',1,'Admin/Attribute/index','属性管理',1,'',0),(90,'admin',1,'Admin/Attribute/add','新增',1,'',0),(91,'admin',1,'Admin/Attribute/edit','编辑',1,'',0),(92,'admin',1,'Admin/Attribute/setStatus','改变状态',1,'',0),(93,'admin',1,'Admin/Attribute/update','保存数据',1,'',0),(95,'admin',1,'Admin/AuthManager/addToModel','保存模型授权',1,'',0),(96,'admin',1,'Admin/Category/move','移动',-1,'',0),(97,'admin',1,'Admin/Category/merge','合并',-1,'',0),(98,'admin',1,'Admin/Config/menu','后台菜单管理',-1,'',0),(99,'admin',1,'Admin/Article/mydocument','内容',-1,'',0),(100,'admin',1,'Admin/Menu/index','菜单管理',1,'',0),(101,'admin',1,'Admin/other','其他',-1,'',0),(102,'admin',1,'Admin/Menu/add','新增',1,'',0),(103,'admin',1,'Admin/Menu/edit','编辑',1,'',0),(104,'admin',1,'Admin/Think/lists?model=article','文章管理',-1,'',0),(105,'admin',1,'Admin/Think/lists?model=download','下载管理',1,'',0),(106,'admin',1,'Admin/Think/lists?model=config','配置管理',1,'',0),(107,'admin',1,'Admin/Action/actionlog','行为日志',1,'',0),(108,'admin',1,'Admin/User/updatePassword','修改密码',1,'',0),(109,'admin',1,'Admin/User/updateNickname','修改昵称',1,'',0),(110,'admin',1,'Admin/action/edit','查看行为日志',1,'',0),(205,'admin',1,'Admin/think/add','新增数据',1,'',0),(111,'admin',2,'Admin/article/index','文档列表',-1,'',0),(112,'admin',2,'Admin/article/add','新增',-1,'',0),(113,'admin',2,'Admin/article/edit','编辑',-1,'',0),(114,'admin',2,'Admin/article/setStatus','改变状态',-1,'',0),(115,'admin',2,'Admin/article/update','保存',-1,'',0),(116,'admin',2,'Admin/article/autoSave','保存草稿',-1,'',0),(117,'admin',2,'Admin/article/move','移动',-1,'',0),(118,'admin',2,'Admin/article/copy','复制',-1,'',0),(119,'admin',2,'Admin/article/paste','粘贴',-1,'',0),(120,'admin',2,'Admin/article/batchOperate','导入',-1,'',0),(121,'admin',2,'Admin/article/recycle','回收站',-1,'',0),(122,'admin',2,'Admin/article/permit','还原',-1,'',0),(123,'admin',2,'Admin/article/clear','清空',-1,'',0),(124,'admin',2,'Admin/User/add','新增用户',-1,'',0),(125,'admin',2,'Admin/User/action','用户行为',-1,'',0),(126,'admin',2,'Admin/User/addAction','新增用户行为',-1,'',0),(127,'admin',2,'Admin/User/editAction','编辑用户行为',-1,'',0),(128,'admin',2,'Admin/User/saveAction','保存用户行为',-1,'',0),(129,'admin',2,'Admin/User/setStatus','变更行为状态',-1,'',0),(130,'admin',2,'Admin/User/changeStatus?method=forbidUser','禁用会员',-1,'',0),(131,'admin',2,'Admin/User/changeStatus?method=resumeUser','启用会员',-1,'',0),(132,'admin',2,'Admin/User/changeStatus?method=deleteUser','删除会员',-1,'',0),(133,'admin',2,'Admin/AuthManager/index','权限管理',-1,'',0),(134,'admin',2,'Admin/AuthManager/changeStatus?method=deleteGroup','删除',-1,'',0),(135,'admin',2,'Admin/AuthManager/changeStatus?method=forbidGroup','禁用',-1,'',0),(136,'admin',2,'Admin/AuthManager/changeStatus?method=resumeGroup','恢复',-1,'',0),(137,'admin',2,'Admin/AuthManager/createGroup','新增',-1,'',0),(138,'admin',2,'Admin/AuthManager/editGroup','编辑',-1,'',0),(139,'admin',2,'Admin/AuthManager/writeGroup','保存用户组',-1,'',0),(140,'admin',2,'Admin/AuthManager/group','授权',-1,'',0),(141,'admin',2,'Admin/AuthManager/access','访问授权',-1,'',0),(142,'admin',2,'Admin/AuthManager/user','成员授权',-1,'',0),(143,'admin',2,'Admin/AuthManager/removeFromGroup','解除授权',-1,'',0),(144,'admin',2,'Admin/AuthManager/addToGroup','保存成员授权',-1,'',0),(145,'admin',2,'Admin/AuthManager/category','分类授权',-1,'',0),(146,'admin',2,'Admin/AuthManager/addToCategory','保存分类授权',-1,'',0),(147,'admin',2,'Admin/AuthManager/modelauth','模型授权',-1,'',0),(148,'admin',2,'Admin/AuthManager/addToModel','保存模型授权',-1,'',0),(149,'admin',2,'Admin/Addons/create','创建',-1,'',0),(150,'admin',2,'Admin/Addons/checkForm','检测创建',-1,'',0),(151,'admin',2,'Admin/Addons/preview','预览',-1,'',0),(152,'admin',2,'Admin/Addons/build','快速生成插件',-1,'',0),(153,'admin',2,'Admin/Addons/config','设置',-1,'',0),(154,'admin',2,'Admin/Addons/disable','禁用',-1,'',0),(155,'admin',2,'Admin/Addons/enable','启用',-1,'',0),(156,'admin',2,'Admin/Addons/install','安装',-1,'',0),(157,'admin',2,'Admin/Addons/uninstall','卸载',-1,'',0),(158,'admin',2,'Admin/Addons/saveconfig','更新配置',-1,'',0),(159,'admin',2,'Admin/Addons/adminList','插件后台列表',-1,'',0),(160,'admin',2,'Admin/Addons/execute','URL方式访问插件',-1,'',0),(161,'admin',2,'Admin/Addons/hooks','钩子管理',-1,'',0),(162,'admin',2,'Admin/Model/index','模型管理',-1,'',0),(163,'admin',2,'Admin/model/add','新增',-1,'',0),(164,'admin',2,'Admin/model/edit','编辑',-1,'',0),(165,'admin',2,'Admin/model/setStatus','改变状态',-1,'',0),(166,'admin',2,'Admin/model/update','保存数据',-1,'',0),(167,'admin',2,'Admin/Attribute/index','属性管理',-1,'',0),(168,'admin',2,'Admin/Attribute/add','新增',-1,'',0),(169,'admin',2,'Admin/Attribute/edit','编辑',-1,'',0),(170,'admin',2,'Admin/Attribute/setStatus','改变状态',-1,'',0),(171,'admin',2,'Admin/Attribute/update','保存数据',-1,'',0),(172,'admin',2,'Admin/Config/index','配置管理',-1,'',0),(173,'admin',2,'Admin/Config/edit','编辑',-1,'',0),(174,'admin',2,'Admin/Config/del','删除',-1,'',0),(175,'admin',2,'Admin/Config/add','新增',-1,'',0),(176,'admin',2,'Admin/Config/save','保存',-1,'',0),(177,'admin',2,'Admin/Menu/index','菜单管理',-1,'',0),(178,'admin',2,'Admin/Channel/index','导航管理',-1,'',0),(179,'admin',2,'Admin/Channel/add','新增',-1,'',0),(180,'admin',2,'Admin/Channel/edit','编辑',-1,'',0),(181,'admin',2,'Admin/Channel/del','删除',-1,'',0),(182,'admin',2,'Admin/Category/index','分类管理',-1,'',0),(183,'admin',2,'Admin/Category/edit','编辑',-1,'',0),(184,'admin',2,'Admin/Category/add','新增',-1,'',0),(185,'admin',2,'Admin/Category/remove','删除',-1,'',0),(186,'admin',2,'Admin/Category/move','移动',-1,'',0),(187,'admin',2,'Admin/Category/merge','合并',-1,'',0),(188,'admin',2,'Admin/Database/index?type=export','备份数据库',-1,'',0),(189,'admin',2,'Admin/Database/export','备份',-1,'',0),(190,'admin',2,'Admin/Database/optimize','优化表',-1,'',0),(191,'admin',2,'Admin/Database/repair','修复表',-1,'',0),(192,'admin',2,'Admin/Database/index?type=import','还原数据库',-1,'',0),(193,'admin',2,'Admin/Database/import','恢复',-1,'',0),(194,'admin',2,'Admin/Database/del','删除',-1,'',0),(195,'admin',2,'Admin/other','其他',1,'',0),(196,'admin',2,'Admin/Menu/add','新增',-1,'',0),(197,'admin',2,'Admin/Menu/edit','编辑',-1,'',0),(198,'admin',2,'Admin/Think/lists?model=article','应用',-1,'',0),(199,'admin',2,'Admin/Think/lists?model=download','下载管理',-1,'',0),(200,'admin',2,'Admin/Think/lists?model=config','应用',-1,'',0),(201,'admin',2,'Admin/Action/actionlog','行为日志',-1,'',0),(202,'admin',2,'Admin/User/updatePassword','修改密码',-1,'',0),(203,'admin',2,'Admin/User/updateNickname','修改昵称',-1,'',0),(204,'admin',2,'Admin/action/edit','查看行为日志',-1,'',0),(206,'admin',1,'Admin/think/edit','编辑数据',1,'',0),(207,'admin',1,'Admin/Menu/import','导入',1,'',0),(208,'admin',1,'Admin/Model/generate','生成',1,'',0),(209,'admin',1,'Admin/Addons/addHook','新增钩子',1,'',0),(210,'admin',1,'Admin/Addons/edithook','编辑钩子',1,'',0),(211,'admin',1,'Admin/Article/sort','文档排序',1,'',0),(212,'admin',1,'Admin/Config/sort','排序',1,'',0),(213,'admin',1,'Admin/Menu/sort','排序',1,'',0),(214,'admin',1,'Admin/Channel/sort','排序',1,'',0),(215,'admin',1,'Admin/Category/operate/type/move','移动',1,'',0),(216,'admin',1,'Admin/Category/operate/type/merge','合并',1,'',0),(217,'admin',1,'Admin/Forum/forum','板块管理',1,'',0),(218,'admin',1,'Admin/Forum/post','帖子管理',1,'',0),(219,'admin',1,'Admin/Forum/editForum','编辑／发表帖子',1,'',0),(220,'admin',1,'Admin/Forum/editPost','edit pots',1,'',0),(221,'admin',2,'Admin//Admin/Forum/index','讨论区',-1,'',0),(222,'admin',2,'Admin//Admin/Weibo/index','微博',-1,'',0),(223,'admin',1,'Admin/Forum/sortForum','排序',1,'',0),(224,'admin',1,'Admin/SEO/editRule','新增、编辑',1,'',0),(225,'admin',1,'Admin/SEO/sortRule','排序',1,'',0),(226,'admin',1,'Admin/SEO/index','规则管理',1,'',0),(227,'admin',1,'Admin/Forum/editReply','新增 编辑',1,'',0),(228,'admin',1,'Admin/Weibo/editComment','编辑回复',1,'',0),(229,'admin',1,'Admin/Weibo/editWeibo','编辑微博',1,'',0),(230,'admin',1,'Admin/SEO/ruleTrash','规则回收站',1,'',0),(231,'admin',1,'Admin/Rank/userList','查看用户',1,'',0),(232,'admin',1,'Admin/Rank/userRankList','用户头衔列表',1,'',0),(233,'admin',1,'Admin/Rank/userAddRank','关联新头衔',1,'',0),(234,'admin',1,'Admin/Rank/userChangeRank','编辑头衔关联',1,'',0),(235,'admin',1,'Admin/Issue/add','编辑专辑',1,'',0),(236,'admin',1,'Admin/Issue/issue','专辑管理',1,'',0),(237,'admin',1,'Admin/Issue/operate','专辑操作',1,'',0),(238,'admin',1,'Admin/Weibo/weibo','微博管理',1,'',0),(239,'admin',1,'Admin/Rank/index','头衔列表',1,'',0),(240,'admin',1,'Admin/Forum/forumTrash','板块回收站',1,'',0),(241,'admin',1,'Admin/Weibo/weiboTrash','微博回收站',1,'',0),(242,'admin',1,'Admin/Rank/editRank','添加头衔',1,'',0),(243,'admin',1,'Admin/Weibo/comment','回复管理',1,'',0),(244,'admin',1,'Admin/Forum/postTrash','帖子回收站',1,'',0),(245,'admin',1,'Admin/Weibo/commentTrash','回复回收站',1,'',0),(246,'admin',1,'Admin/Issue/issueTrash','专辑回收站',1,'',0),(247,'admin',1,'Admin//Admin/Forum/reply','回复管理',1,'',0),(248,'admin',1,'Admin/Forum/replyTrash','回复回收站',1,'',0),(249,'admin',2,'Admin/Forum/index','论坛',1,'',0),(250,'admin',2,'Admin/Weibo/weibo','动态',1,'',0),(251,'admin',2,'Admin/SEO/index','SEO',-1,'',0),(252,'admin',2,'Admin/Rank/index','头衔',-1,'',0),(253,'admin',2,'Admin/Issue/issue','主题',1,'',0),(254,'admin',1,'Admin/Issue/contents','内容管理',1,'',0),(255,'admin',1,'Admin/User/profile','扩展资料',1,'',0),(256,'admin',1,'Admin/User/editProfile','添加、编辑分组',1,'',0),(257,'admin',1,'Admin/User/sortProfile','分组排序',1,'',0),(258,'admin',1,'Admin/User/field','字段列表',1,'',0),(259,'admin',1,'Admin/User/editFieldSetting','添加、编辑字段',1,'',0),(260,'admin',1,'Admin/User/sortField','字段排序',1,'',0),(261,'admin',1,'Admin/Update/quick','全部补丁',1,'',0),(262,'admin',1,'Admin/Update/addpack','新增补丁',1,'',0),(263,'admin',1,'Admin/User/expandinfo_select','用户扩展资料列表',1,'',0),(264,'admin',1,'Admin/User/expandinfo_details','扩展资料详情',1,'',0),(265,'admin',1,'Admin/Shop/shopLog','商城信息记录',1,'',0),(266,'admin',1,'Admin/Shop/setStatus','商品分类状态设置',1,'',0),(267,'admin',1,'Admin/Shop/setGoodsStatus','商品状态设置',1,'',0),(268,'admin',1,'Admin/Shop/operate','商品分类操作',1,'',0),(269,'admin',1,'Admin/Shop/add','商品分类添加',1,'',0),(270,'admin',1,'Admin/Shop/goodsEdit','添加、编辑商品',1,'',0),(271,'admin',1,'Admin/Shop/hotSellConfig','热销商品阀值配置',1,'',0),(272,'admin',1,'Admin/Shop/setNew','设置新品',1,'',0),(273,'admin',1,'Admin/EventType/index','活动分类管理',1,'',0),(274,'admin',1,'Admin/Event/event','内容管理',1,'',0),(275,'admin',1,'Admin/EventType/eventTypeTrash','活动分类回收站',1,'',0),(276,'admin',1,'Admin/Event/verify','内容审核',1,'',0),(277,'admin',1,'Admin/Event/contentTrash','内容回收站',1,'',0),(278,'admin',1,'Admin/Rank/rankVerify','待审核用户头衔',1,'',0),(279,'admin',1,'Admin/Rank/rankVerifyFailure','被驳回的头衔申请',1,'',0),(280,'admin',1,'Admin/Weibo/config','微博设置',1,'',0),(281,'admin',1,'Admin/Issue/verify','内容审核',1,'',0),(282,'admin',1,'Admin/Shop/goodsList','商品列表',1,'',0),(283,'admin',1,'Admin/Shop/shopCategory','商品分类配置',1,'',0),(284,'admin',1,'Admin/Shop/categoryTrash','商品分类回收站',1,'',0),(285,'admin',1,'Admin/Shop/verify','待发货交易',1,'',0),(286,'admin',1,'Admin/Issue/contentTrash','内容回收站',1,'',0),(287,'admin',1,'Admin/Shop/goodsBuySuccess','交易成功记录',1,'',0),(288,'admin',1,'Admin/Shop/goodsTrash','商品回收站',1,'',0),(289,'admin',1,'Admin/Shop/toxMoneyConfig','货币配置',1,'',0),(290,'admin',2,'Admin/Shop/shopCategory','商城',1,'',0),(291,'admin',2,'Admin/EventType/index','活动',1,'',0),(292,'admin',1,'Admin/Issue/config','专辑设置',1,'',0),(293,'admin',1,'Admin/Event/config','活动设置',1,'',0),(294,'admin',1,'Admin/User/level','等级管理',1,'',0),(295,'admin',1,'admin/group/group','群组管理',1,'',0),(296,'admin',1,'Admin/group/groupType','分类管理',1,'',0),(297,'admin',1,'Admin/group/postType','文章分类',1,'',0),(298,'admin',1,'Admin/group/editPostCate','修改分类',1,'',0),(299,'admin',1,'Admin/group/sortPostCate','类型排序',1,'',0),(300,'admin',1,'Admin/group/editGroupType','修改群组分类',1,'',0),(301,'admin',1,'Admin/group/sortGroupType','群组类型排序',1,'',0),(302,'admin',1,'Admin/group/editLzlReply','编辑楼中楼回复',1,'',0),(303,'admin',1,'Admin/group/lzlreply','楼中楼回复',1,'',0),(304,'admin',1,'Admin/group/lzlreplyTrash','楼中楼回复回收站',1,'',0),(305,'admin',1,'Admin/group/editReply','编辑回复',1,'',0),(306,'admin',1,'Admin/group/groupTrash','群组回收站',1,'',0),(307,'admin',1,'Admin/group/post','文章管理',1,'',0),(308,'admin',1,'Admin/group/postTrash','文章回收站',1,'',0),(309,'admin',1,'Admin/group/reply','回复管理',1,'',0),(310,'admin',1,'Admin/group/replyTrash','回复回收站',1,'',0),(311,'admin',1,'Admin/group/config','群组设置',1,'',0),(312,'admin',1,'Admin/group/unverify','未审核群组',1,'',0),(313,'admin',1,'Admin/Forum/manageTags','标签管理',1,'',0),(314,'admin',1,'Admin/Forum/editTags','编辑标签',1,'',0),(315,'admin',1,'Admin/Forum/config','论坛设置',1,'',0),(316,'admin',2,'admin/group/index','圈子',1,'',0),(317,'admin',1,'Admin/Forum/complaint','投诉管理',1,'',0),(318,'admin',1,'Admin/rank/authRuleManage','头衔权限节点管理',1,'',0),(319,'admin',1,'Admin/rank/editauthrule','编辑头衔权限规则',1,'',0),(320,'admin',1,'Admin/Rank/manageAuth','访问授权',1,'',0);
/*!40000 ALTER TABLE `mj_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_avatar`
--

DROP TABLE IF EXISTS `mj_avatar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `path` varchar(200) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_temp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_avatar`
--

LOCK TABLES `mj_avatar` WRITE;
/*!40000 ALTER TABLE `mj_avatar` DISABLE KEYS */;
INSERT INTO `mj_avatar` VALUES (2,61,'2014-12-17/549118ad610c4-e8211c0f.png',1418795183,1,0);
/*!40000 ALTER TABLE `mj_avatar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_category`
--

DROP TABLE IF EXISTS `mj_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(30) NOT NULL COMMENT '标志',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `list_row` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页行数',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_index` varchar(100) NOT NULL COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL COMMENT '详情页模板',
  `template_edit` varchar(100) NOT NULL COMMENT '编辑页模板',
  `model` varchar(100) NOT NULL DEFAULT '' COMMENT '关联模型',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '允许发布的内容类型',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `reply_model` varchar(100) NOT NULL DEFAULT '',
  `extend` text NOT NULL COMMENT '扩展设置',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_category`
--

LOCK TABLES `mj_category` WRITE;
/*!40000 ALTER TABLE `mj_category` DISABLE KEYS */;
INSERT INTO `mj_category` VALUES (1,'blog','资讯',0,0,10,'','','','','','','','2','2,1',0,0,1,0,0,'1','',1379474947,1406206595,1,0),(2,'default_blog','APP',1,1,10,'','','','','','','','2','2,1,3',0,1,1,0,1,'1','',1379475028,1406171627,1,31),(40,'b3','大数据',1,0,10,'','','','','','','','2','2',0,1,1,1,0,'','',1406169194,1406183525,1,0),(41,'php','PHP',1,0,10,'','','','','','','','2','2',0,1,1,1,0,'','',1406171638,1406171693,1,0),(42,'create_yeah','创业',0,0,10,'','','','','','','','2','',0,1,1,1,0,'','',1406172024,1406172024,1,0);
/*!40000 ALTER TABLE `mj_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_channel`
--

DROP TABLE IF EXISTS `mj_channel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级频道ID',
  `title` char(30) NOT NULL COMMENT '频道标题',
  `url` char(100) NOT NULL COMMENT '频道连接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `target` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  `color` varchar(30) NOT NULL,
  `band_color` varchar(30) NOT NULL,
  `band_text` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_channel`
--

LOCK TABLES `mj_channel` WRITE;
/*!40000 ALTER TABLE `mj_channel` DISABLE KEYS */;
INSERT INTO `mj_channel` VALUES (2,0,'问答','Forum/Index/index',2,1379475131,1419847715,1,0,'','',''),(5,0,'会员','People/Index/index',5,1399784340,1406256451,1,0,'','',''),(17,0,'地图','Map/Index/index',10,1419847807,1419847807,1,0,'','',''),(16,0,'首页','Home/Index/index',1,1419847777,1419847785,1,0,'','',''),(15,0,'圈子','group/index/index',5,1410771228,1418004374,1,0,'','','');
/*!40000 ALTER TABLE `mj_channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_check_info`
--

DROP TABLE IF EXISTS `mj_check_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_check_info` (
  `uid` int(11) DEFAULT NULL,
  `con_num` int(11) DEFAULT '1',
  `total_num` int(11) DEFAULT '1',
  `ctime` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_check_info`
--

LOCK TABLES `mj_check_info` WRITE;
/*!40000 ALTER TABLE `mj_check_info` DISABLE KEYS */;
INSERT INTO `mj_check_info` VALUES (61,1,1,1418795215);
/*!40000 ALTER TABLE `mj_check_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_config`
--

DROP TABLE IF EXISTS `mj_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_config`
--

LOCK TABLES `mj_config` WRITE;
/*!40000 ALTER TABLE `mj_config` DISABLE KEYS */;
INSERT INTO `mj_config` VALUES (4,'WEB_SITE_CLOSE',4,'关闭站点',1,'0:关闭,1:开启','站点关闭后其他用户不能访问，管理员可以正常访问',1378898976,1379235296,1,'1',23),(9,'CONFIG_TYPE_LIST',3,'配置类型列表',4,'','主要用于数据解析和页面表单的生成',1378898976,1379235348,1,'0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举',34),(10,'WEB_SITE_ICP',1,'网站备案号',1,'','设置在网站底部显示的备案号，如“沪ICP备12007941号-2',1378900335,1379235859,1,'浙ICP备XX号',43),(11,'DOCUMENT_POSITION',3,'文档推荐位',2,'','文档推荐位，推荐到多个位置KEY值相加即可',1379053380,1379235329,1,'1:列表页推荐\r\n2:频道页推荐\r\n4:网站首页推荐',40),(12,'DOCUMENT_DISPLAY',3,'文档可见性',2,'','文章可见性仅影响前台显示，后台不收影响',1379056370,1379235322,1,'0:所有人可见\r\n1:仅注册会员可见\r\n2:仅管理员可见',46),(13,'COLOR_STYLE',4,'后台色系',1,'default_color:默认\r\nblue_color:紫罗兰\r\namaze:Amazu','后台颜色风格',1379122533,1409279514,1,'amaze',24),(20,'CONFIG_GROUP_LIST',3,'配置分组',4,'','配置分组',1379228036,1384418383,1,'1:基本\r\n2:内容\r\n3:用户\r\n4:系统\r\n5:邮件\r\n6:钱包＆支付宝',47),(21,'HOOKS_TYPE',3,'钩子的类型',4,'','类型 1-用于扩展显示内容，2-用于扩展业务处理',1379313397,1379313407,1,'1:视图\r\n2:控制器',49),(22,'AUTH_CONFIG',3,'Auth配置',4,'','自定义Auth.class.php类配置',1379409310,1379409564,1,'AUTH_ON:1\r\nAUTH_TYPE:2',51),(23,'OPEN_DRAFTBOX',4,'是否开启草稿功能',2,'0:关闭草稿功能\r\n1:开启草稿功能\r\n','新增文章时的草稿功能配置',1379484332,1379484591,1,'1',38),(24,'DRAFT_AOTOSAVE_INTERVAL',0,'自动保存草稿时间',2,'','自动保存草稿的时间间隔，单位：秒',1379484574,1386143323,1,'60',36),(25,'LIST_ROWS',0,'后台每页记录数',2,'','后台数据每页显示记录数',1379503896,1380427745,1,'10',53),(26,'USER_ALLOW_REGISTER',4,'是否允许用户注册',3,'0:关闭注册\r\n1:允许注册','是否开放用户注册',1379504487,1379504580,1,'1',44),(27,'CODEMIRROR_THEME',4,'预览插件的CodeMirror主题',4,'3024-day:3024 day\r\n3024-night:3024 night\r\nambiance:ambiance\r\nbase16-dark:base16 dark\r\nbase16-light:base16 light\r\nblackboard:blackboard\r\ncobalt:cobalt\r\neclipse:eclipse\r\nelegant:elegant\r\nerlang-dark:erlang-dark\r\nlesser-dark:lesser-dark\r\nmidnight:midnight','详情见CodeMirror官网',1379814385,1384740813,1,'ambiance',45),(28,'DATA_BACKUP_PATH',1,'数据库备份根路径',4,'','路径必须以 / 结尾',1381482411,1381482411,1,'./Data/',48),(29,'DATA_BACKUP_PART_SIZE',0,'数据库备份卷大小',4,'','该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M',1381482488,1381729564,1,'20971520',50),(30,'DATA_BACKUP_COMPRESS',4,'数据库备份文件是否启用压缩',4,'0:不压缩\r\n1:启用压缩','压缩备份文件需要PHP环境支持gzopen,gzwrite函数',1381713345,1381729544,1,'1',52),(31,'DATA_BACKUP_COMPRESS_LEVEL',4,'数据库备份文件压缩级别',4,'1:普通\r\n4:一般\r\n9:最高','数据库备份文件的压缩级别，该配置在开启压缩时生效',1381713408,1381713408,1,'9',54),(32,'DEVELOP_MODE',4,'开启开发者模式',4,'0:关闭\r\n1:开启','是否开启开发者模式',1383105995,1383291877,1,'1',55),(33,'ALLOW_VISIT',3,'不受限控制器方法',0,'','',1386644047,1386644741,1,'0:article/draftbox\r\n1:article/mydocument\r\n2:Category/tree\r\n3:Index/verify\r\n4:file/upload\r\n5:file/download\r\n6:user/updatePassword\r\n7:user/updateNickname\r\n8:user/submitPassword\r\n9:user/submitNickname\r\n10:file/uploadpicture',25),(34,'DENY_VISIT',3,'超管专限控制器方法',0,'','仅超级管理员可访问的控制器方法',1386644141,1386644659,1,'0:Addons/addhook\r\n1:Addons/edithook\r\n2:Addons/delhook\r\n3:Addons/updateHook\r\n4:Admin/getMenus\r\n5:Admin/recordList\r\n6:AuthManager/updateRules\r\n7:AuthManager/tree',26),(35,'REPLY_LIST_ROWS',0,'回复列表每页条数',2,'','',1386645376,1387178083,1,'10',28),(36,'ADMIN_ALLOW_IP',2,'后台允许访问IP',4,'','多个用逗号分隔，如果不配置表示不限制IP访问',1387165454,1387165553,1,'',56),(37,'SHOW_PAGE_TRACE',4,'是否显示页面Trace',4,'0:关闭\r\n1:开启','是否显示页面Trace信息',1387165685,1387165685,1,'1',32),(38,'WEB_SITE',1,'网站名称',1,'','用于邮件,短信,站内信显示',1388332311,1388501500,1,'酷网中国',27),(39,'MAIL_TYPE',4,'邮件类型',5,'1:SMTP 模块发送\r\n2:mail() 函数发送','如果您选择了采用服务器内置的 Mail 服务，您不需要填写下面的内容',1388332882,1418632942,1,'1',2),(40,'MAIL_SMTP_HOST',1,'SMTP 服务器',5,'','SMTP服务器',1388332932,1388332932,1,'smtp.163.com',3),(41,'MAIL_SMTP_PORT',0,'SMTP服务器端口',5,'','默认25',1388332975,1388332975,1,'25',4),(42,'MAIL_SMTP_USER',1,'SMTP服务器用户名',5,'','填写完整用户名',1388333010,1388333010,1,'apacalblog@163.com',5),(43,'MAIL_SMTP_PASS',6,'SMTP服务器密码',5,'','填写您的密码',1388333057,1389187088,1,'dev2014',6),(50,'MAIL_USER_PASS',5,'密码找回模板',0,'','支持HTML代码',1388583989,1388672614,1,'密码找回111223333555111',9),(51,'PIC_FILE_PATH',1,'图片文件保存根目录',4,'','图片文件保存根目录./目录/',1388673255,1388673255,1,'./Uploads/',10),(46,'MAIL_SMTP_CE',1,'邮件发送测试',5,'','填写测试邮件地址',1388334529,1388584028,1,'apacal@126.com',41),(47,'MAIL_USER_REG',5,'注册邮件模板',3,'','支持HTML代码',1388337307,1389532335,1,'<a href=\"http://3spp.cn\" target=\"_blank\">点击进入</a><span style=\"color:#E53333;\">当您收到这封邮件，表明您已注册成功，以上为您的用户名和密码。。。。祝您生活愉快····</span>',57),(52,'USER_NAME_BAOLIU',1,'保留用户名',3,'','禁止注册用户名,用\" , \"号隔开',1388845937,1388845937,1,'管理员,测试,admin,垃圾',11),(53,'USER_REG_TIME',0,'注册时间限制',3,'','同一IP注册时间限制，防恶意注册，格式分钟',1388847715,1388847715,1,'2',12),(48,'VERIFY_OPEN',4,'验证码配置',4,'0:全部关闭\r\n1:全部显示\r\n2:注册显示\r\n3:登陆显示','验证码配置',1388500332,1405561711,1,'2',7),(49,'VERIFY_TYPE',4,'验证码类型',4,'1:中文\r\n2:英文\r\n3:数字\r\n4:算数','验证码类型',1388500873,1405561731,1,'1',8),(54,'NO_BODY_TLE',2,'空白说明',2,'','空白说明',1392216444,1392981305,1,'呵呵，暂时没有内容哦！！',13),(55,'USER_RESPASS',5,'密码找回模板',3,'','密码找回文本',1396191234,1396191234,1,'<span style=\"color:#009900;\">请点击以下链接找回密码，如无反应，请将链接地址复制到浏览器中打开(下次登录前有效)</span>',14),(56,'COUNT_CODE',2,'统计代码',1,'','用于统计网站访问量的第三方代码，推荐CNZZ统计',1403058890,1403058890,1,'',29),(57,'SHARE_WEIBO_ID',0,'分享来源微博ID',1,'','来源的微博ID，不配置则隐藏顶部微博分享按钮。',1403091490,1403091490,1,'',30),(60,'AFTER_LOGIN_JUMP_URL',2,'登陆后跳转的Url',1,'','支持形如weibo/index/index的ThinkPhp路由写法，支持普通的url写法',1407145718,1419855526,1,'home/index/index',33),(58,'USER_REG_WEIBO_CONTENT',1,'用户注册微博提示内容',3,'','留空则表示不发新微博，支持face',1404965285,1404965445,1,'',15),(59,'WEIBO_WORDS_COUNT',0,'微博字数限制',1,'','最大允许的微博字数长度',1405330568,1405330622,1,'200',31),(61,'FOOTER_RIGHT',2,'底部右侧链接部分',1,'','链接部分',1408008354,1408008354,1,'  <p><h4><strong>联系</strong></h4></p>\r\n                    <p><a href=\"#\" target=\"_blank\">关于我们</a>\r\n                    <p>\r\n                    <p><a href=\"#\" target=\"_blank\">问题反馈</a></p>\r\n                    <p><a href=\"#\" target=\"_blank\">联系我们</a></p>',39),(62,'FOOTER_SUMMARY',2,'底部简介部分代码',1,'','',1408008496,1408008496,1,'合肥正宏网络科技有限公司是一家专注于为客户提供专业的社交方案。公司秉持简洁、高效、创新，不断为客户创造奇迹。',37),(63,'FOOTER_TITLE',2,'底部介绍标题',1,'','公司标题',1408008573,1408008573,1,'<a target=\"_blank\" href=\"#\">合肥正宏网络科技有限公司</a>',35),(64,'FOOTER_QCODE',2,'底部二维码部分代码',1,'','',1408008644,1408008738,1,' <img src=\"/Public/Core/images/erweima.png\"/>',42),(78,'_WEIBO_SHOW_TITLE',0,'',0,'','',1409670239,1409670239,1,'1',17),(75,'_WEIBO_SHOWTITLE',0,'',0,'','',1409670094,1409670094,1,'0',16),(92,'_FORUM_LIMIT_IMAGE',0,'',0,'','',1419406897,1419406897,1,'10',0),(82,'_ISSUE_NEED_VERIFY',0,'',0,'','',1409712596,1409712596,1,'0',19),(84,'_USER_LEVEL',0,'',0,'','',1409880649,1409880649,1,'0:Lv1 实习\r\n50:Lv2 试用\r\n100:Lv3 转正\r\n200:Lv4 助理\r\n400:Lv 5 经理\r\n800:Lv6 董事\r\n1600:Lv7 董事长',20),(85,'IS_SEND_MAIL_TO_REMIND_USER',4,'是否发送邮件提醒(当用户回答帖子后，提醒楼主和被回答者）',5,'1:发送\r\n2:不发送','',1418632999,1418636280,1,'2',21),(86,'MAIL_FOOTER',2,'邮箱FOOT',5,'','',1418636447,1418636447,1,'本邮件由系统发送请勿回复。',22),(87,'ALIPAY_PID',2,'支付宝PID',6,'','',1419325219,1419325399,1,'2088701997838426',1),(88,'ALIPAY_KEY',2,'支付包KEY',6,'','',1419325443,1419328203,1,'vfyee7647vn361eoiw27ua9ux3xg24qk',0),(89,'ALIPAY_USER',2,'支付宝用户',6,'','',1419325488,1419325488,1,'shasnfjd2013@qq.com',0),(90,'REG_WALLET',0,'注册用户增加的钱包',6,'','',1419347116,1419347277,1,'10',0),(91,'REG_WALLET_WEIBO',1,'注册获取钱包微博',6,'','',1419347503,1419347503,1,'我注册了，领取了10元钱包',0);
/*!40000 ALTER TABLE `mj_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_document`
--

DROP TABLE IF EXISTS `mj_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类',
  `description` char(140) NOT NULL DEFAULT '' COMMENT '描述',
  `root` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '根节点',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属ID',
  `model_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容模型ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '内容类型',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `cover_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封面',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '可见性',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '截至时间',
  `attach` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件数量',
  `view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `comment` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扩展统计字段',
  `level` int(10) NOT NULL DEFAULT '0' COMMENT '优先级',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  PRIMARY KEY (`id`),
  KEY `idx_category_status` (`category_id`,`status`),
  KEY `idx_status_type_pid` (`status`,`uid`,`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='文档模型基础表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_document`
--

LOCK TABLES `mj_document` WRITE;
/*!40000 ALTER TABLE `mj_document` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_document_article`
--

DROP TABLE IF EXISTS `mj_document_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_document_article` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `parse` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容解析类型',
  `content` text NOT NULL COMMENT '文章内容',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  `bookmark` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
  `zx` int(10) unsigned NOT NULL COMMENT '附近',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档模型文章表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_document_article`
--

LOCK TABLES `mj_document_article` WRITE;
/*!40000 ALTER TABLE `mj_document_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_document_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_document_download`
--

DROP TABLE IF EXISTS `mj_document_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_document_download` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `parse` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容解析类型',
  `content` text NOT NULL COMMENT '下载详细描述',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  `file_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档模型下载表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_document_download`
--

LOCK TABLES `mj_document_download` WRITE;
/*!40000 ALTER TABLE `mj_document_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_document_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_event`
--

DROP TABLE IF EXISTS `mj_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '发起人',
  `title` varchar(255) NOT NULL COMMENT '活动名称',
  `explain` text NOT NULL COMMENT '详细内容',
  `sTime` int(11) NOT NULL COMMENT '活动开始时间',
  `eTime` int(11) NOT NULL COMMENT '活动结束时间',
  `address` varchar(255) NOT NULL COMMENT '活动地点',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `limitCount` int(11) NOT NULL COMMENT '限制人数',
  `cover_id` int(11) NOT NULL COMMENT '封面ID',
  `deadline` int(11) NOT NULL,
  `attentionCount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `reply_count` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `signCount` int(11) NOT NULL,
  `is_recommend` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_event`
--

LOCK TABLES `mj_event` WRITE;
/*!40000 ALTER TABLE `mj_event` DISABLE KEYS */;
INSERT INTO `mj_event` VALUES (9,60,'zhong发布的第一个活动','<p>zhong发布的第一个活动啊！</p>',1417622400,1417708800,'广东省广州市番禺区兴亚三路',1417674897,20,110,1417555500,0,1,1417674897,4,1,1,0,0);
/*!40000 ALTER TABLE `mj_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_event_attend`
--

DROP TABLE IF EXISTS `mj_event_attend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_event_attend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `creat_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0为报名，1为参加',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_event_attend`
--

LOCK TABLES `mj_event_attend` WRITE;
/*!40000 ALTER TABLE `mj_event_attend` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_event_attend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_event_type`
--

DROP TABLE IF EXISTS `mj_event_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_event_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `allow_post` tinyint(4) NOT NULL,
  `pid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_event_type`
--

LOCK TABLES `mj_event_type` WRITE;
/*!40000 ALTER TABLE `mj_event_type` DISABLE KEYS */;
INSERT INTO `mj_event_type` VALUES (1,'慈善活动',1403859500,1403859485,1,0,0,0),(2,'公益活动',1403859511,1403859502,1,0,0,0);
/*!40000 ALTER TABLE `mj_event_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_field`
--

DROP TABLE IF EXISTS `mj_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `field_data` varchar(1000) NOT NULL,
  `createTime` int(11) NOT NULL,
  `changeTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_field`
--

LOCK TABLES `mj_field` WRITE;
/*!40000 ALTER TABLE `mj_field` DISABLE KEYS */;
INSERT INTO `mj_field` VALUES (46,60,36,'960034693',1417674755,1417674755);
/*!40000 ALTER TABLE `mj_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_field_group`
--

DROP TABLE IF EXISTS `mj_field_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_field_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_name` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visiable` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_field_group`
--

LOCK TABLES `mj_field_group` WRITE;
/*!40000 ALTER TABLE `mj_field_group` DISABLE KEYS */;
INSERT INTO `mj_field_group` VALUES (13,'个人资料',1,1403847366,0,1);
/*!40000 ALTER TABLE `mj_field_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_field_setting`
--

DROP TABLE IF EXISTS `mj_field_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_field_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(25) NOT NULL,
  `profile_group_id` int(11) NOT NULL,
  `visiable` tinyint(4) NOT NULL DEFAULT '1',
  `required` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  `form_type` varchar(25) NOT NULL,
  `form_default_value` varchar(200) NOT NULL,
  `validation` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` int(11) NOT NULL,
  `child_form_type` varchar(25) NOT NULL,
  `input_tips` varchar(100) NOT NULL COMMENT '输入提示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_field_setting`
--

LOCK TABLES `mj_field_setting` WRITE;
/*!40000 ALTER TABLE `mj_field_setting` DISABLE KEYS */;
INSERT INTO `mj_field_setting` VALUES (36,'qq',13,1,1,0,'input','','',1,1409045825,'string','');
/*!40000 ALTER TABLE `mj_field_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_file`
--

DROP TABLE IF EXISTS `mj_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `savename` char(20) NOT NULL DEFAULT '' COMMENT '保存名称',
  `savepath` char(30) NOT NULL DEFAULT '' COMMENT '文件保存路径',
  `ext` char(5) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `mime` char(40) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `location` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文件保存位置',
  `create_time` int(10) unsigned NOT NULL COMMENT '上传时间',
  `driver` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_md5` (`md5`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='文件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_file`
--

LOCK TABLES `mj_file` WRITE;
/*!40000 ALTER TABLE `mj_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_follow`
--

DROP TABLE IF EXISTS `mj_follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `follow_who` int(11) NOT NULL COMMENT '关注谁',
  `who_follow` int(11) NOT NULL COMMENT '谁关注',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COMMENT='关注表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_follow`
--

LOCK TABLES `mj_follow` WRITE;
/*!40000 ALTER TABLE `mj_follow` DISABLE KEYS */;
INSERT INTO `mj_follow` VALUES (73,1,60,1417674939);
/*!40000 ALTER TABLE `mj_follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_forum`
--

DROP TABLE IF EXISTS `mj_forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `post_count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `allow_user_group` text NOT NULL,
  `sort` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_forum`
--

LOCK TABLES `mj_forum` WRITE;
/*!40000 ALTER TABLE `mj_forum` DISABLE KEYS */;
INSERT INTO `mj_forum` VALUES (1,'默认版块',1407114174,35,1,'1',0,0),(2,'',0,0,-1,'0',0,0),(3,'',0,0,-1,'0',0,0),(4,'',0,0,-1,'0',0,0);
/*!40000 ALTER TABLE `mj_forum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_forum_bookmark`
--

DROP TABLE IF EXISTS `mj_forum_bookmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_forum_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_forum_bookmark`
--

LOCK TABLES `mj_forum_bookmark` WRITE;
/*!40000 ALTER TABLE `mj_forum_bookmark` DISABLE KEYS */;
INSERT INTO `mj_forum_bookmark` VALUES (1,1,16,1418733300),(3,1,19,1419871387),(4,62,19,1419873316);
/*!40000 ALTER TABLE `mj_forum_bookmark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_forum_lzl_reply`
--

DROP TABLE IF EXISTS `mj_forum_lzl_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_forum_lzl_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `to_f_reply_id` int(11) NOT NULL,
  `to_reply_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `uid` int(11) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_forum_lzl_reply`
--

LOCK TABLES `mj_forum_lzl_reply` WRITE;
/*!40000 ALTER TABLE `mj_forum_lzl_reply` DISABLE KEYS */;
INSERT INTO `mj_forum_lzl_reply` VALUES (84,3,35,0,'回复一下',1,1,1418622818,0),(85,3,35,84,'回复@admin ：hhhhhhhhhh',1,1,1418623015,0),(86,3,35,85,'回复@admin ：hhhhhhhhhhhhh',1,1,1418624494,0),(87,3,35,85,'回复@admin ：hhhhhhhhhhhhh',1,1,1418624501,0),(88,3,38,0,'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh',1,1,1418624679,0),(89,3,35,84,'回复@admin ：看看吧',1,1,1418624821,0),(90,3,35,86,'回复@admin ：再来回复',1,1,1418625849,0),(91,3,35,86,'回复@admin ：再来回复',1,1,1418626000,0),(92,3,35,86,'回复@admin ：再来回复',1,1,1418626058,0),(93,3,35,86,'回复@admin ：再来回复',1,1,1418626116,0),(94,3,35,86,'回复@admin ：再来回复',1,1,1418626222,0),(95,3,35,84,'回复@admin ：ａｇａｉｎ',1,1,1418626249,0),(96,2,43,0,'恢复已快快快快快快',1,1,1418636360,0),(97,2,43,0,'hsdfdsfsdfsdfsd',1,1,1418636519,0),(98,2,43,0,'bufafdasfdsafdfgdf',1,1,1418636571,0),(99,19,56,0,'我看看看。。。',61,61,1418828598,0),(100,19,56,99,'回复@apacal ：再看',61,61,1418828619,0),(101,19,56,100,'回复@apacal ：wokao',1,61,1418828738,0),(102,19,71,0,'fsdfd',1,1,1419871001,0),(103,19,71,0,'fsdfdsfdsf',1,1,1419871012,0),(104,19,71,102,'回复@admin ：fsdfdsf',1,1,1419871550,0),(105,19,71,103,'回复@admin ：fdsafdsf',1,1,1419871555,0),(106,19,71,105,'回复@admin ：fsdafdsf',1,1,1419871565,0),(107,19,73,0,'还是的话说的话',62,62,1419873292,0),(108,19,73,107,'回复@richard ：还是的话说的话',62,62,1419873297,0);
/*!40000 ALTER TABLE `mj_forum_lzl_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_forum_post`
--

DROP TABLE IF EXISTS `mj_forum_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_forum_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `parse` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `last_reply_time` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `reply_count` int(11) NOT NULL,
  `is_top` tinyint(4) NOT NULL COMMENT '是否置顶',
  `ip` int(11) NOT NULL,
  `is_open` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_forum_post`
--

LOCK TABLES `mj_forum_post` WRITE;
/*!40000 ALTER TABLE `mj_forum_post` DISABLE KEYS */;
INSERT INTO `mj_forum_post` VALUES (1,60,1,'zhong发布的第一个帖子',0,'<p><br/>zhong发布的第一个帖子内容！</p>',1417674601,1418745641,1,1418630799,15,1,0,0,1),(2,1,1,'test',0,'<p>test......................................</p>',1418609140,1418609140,-1,1418636571,4,4,0,0,1),(3,1,1,'test',0,'<p>adest.................</p>',1418610047,1418610047,-1,1419329542,28,60,0,2130706433,1),(4,1,1,'ffffffffffffffff',0,'<p>ffffffffffffffffffff</p>',1418610540,1418610540,-1,1418615474,14,6,0,2130706433,1),(5,1,1,'tttttttttt',0,'<p>ttttttttttttttttttt</p>',1418637659,1418637659,-1,1418637659,2,0,0,2130706433,1),(6,1,1,'test',0,'<p>this is at tag test</p>',1418721276,1418742497,-1,1418721276,32,0,0,2130706433,1),(7,1,1,'test',0,'<p>this is at tag test</p>',1418721308,1418721308,-1,1418721308,0,0,0,2130706433,1),(8,1,1,'test',0,'<p>this is at tag test</p>',1418721513,1418721513,-1,1418721513,0,0,0,2130706433,1),(9,1,1,'test',0,'<p>this is at tag test</p>',1418721517,1418721517,-1,1418721517,0,0,0,2130706433,1),(10,1,1,'test',0,'<p>this is at tag test</p>',1418721551,1418721551,-1,1418721551,0,0,0,2130706433,1),(11,1,1,'test',0,'<p>this is at tag test</p>',1418721607,1418721607,-1,1418721607,0,0,0,2130706433,1),(12,1,1,'test',0,'<p>this is at tag test</p>',1418721615,1418721615,-1,1418721615,0,0,0,2130706433,1),(13,1,1,'test',0,'<p>this is at tag test</p>',1418721652,1418721652,-1,1418721652,0,0,0,2130706433,1),(14,1,1,'test',0,'<p>ffffffffffffffffffffffff</p>',1418721786,1418721786,-1,1418721786,1,0,0,2130706433,1),(15,1,1,'testtagtag',0,'<p>fffffffffffffffffffffffffffffffffffff</p>',1418721925,1418721925,-1,1418721925,2,0,0,2130706433,1),(16,1,1,'text',0,'<p>texttttttttttttttttttttttttt</p>',1418721990,1418735649,-1,1418721990,34,0,0,2130706433,1),(17,1,1,'Hello',0,'<p>OK...............................</p>',1418787711,1418787711,1,1418787711,3,0,0,2130706433,1),(18,1,1,'NGINX',0,'<p>NGINX webserver</p>',1418787742,1418787742,1,1418787742,3,0,0,2130706433,1),(19,1,1,'TEST1',0,'<p>test 1 ..........</p>',1418788256,1419873183,1,1419873297,243,16,0,2130706433,1),(20,1,1,'好地方',0,'<p>好地方好的</p>',1418892855,1418893274,1,1418894758,17,3,0,2130706433,0),(21,61,1,'hhh',0,'<p>\r\n	ffffffffffffff\r\n</p>',1418894823,1418894839,1,1418894855,6,1,2,2130706433,0),(22,1,1,'fdfd',0,'<p>\r\n	fdffffffffffffff\r\n</p>',1419236703,1419236703,1,1419236703,1,0,2,2130706433,1),(23,1,1,'ffffffffffffffff',0,'<p>\r\n	fdfffffffffffffffffffffffff\r\n</p>',1419236716,1419236716,1,1419236716,3,0,1,2130706433,1),(24,1,1,'fffffffffffff',0,'<p>\r\n	fffffffffffffffffffffffffffffffffffffffffffffffffffffffff\r\n</p>',1419238711,1419238711,1,1419855572,12,1,3,2130706433,1),(25,1,1,'tesdty32',0,'<p>fdsfadsfffffffffff</p>',1419855648,1419873166,1,1419855648,15,0,2,2130706433,0);
/*!40000 ALTER TABLE `mj_forum_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_forum_post_reply`
--

DROP TABLE IF EXISTS `mj_forum_post_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_forum_post_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `parse` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `complaint_id` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_forum_post_reply`
--

LOCK TABLES `mj_forum_post_reply` WRITE;
/*!40000 ALTER TABLE `mj_forum_post_reply` DISABLE KEYS */;
INSERT INTO `mj_forum_post_reply` VALUES (1,1,4,0,'<p>hhhhhhhhhhhhhhhhhhhhhhhhh</p>',1418615292,1418615292,-1,0),(2,1,4,0,'<p>hahaha.,.......................</p>',1418615306,1418615306,-1,0),(3,1,4,0,'<p>f</p>',1418615368,1418615368,-1,0),(4,1,4,0,'<p>fffffffffffffffffffffffffffffffffffffffffff</p>',1418615380,1418615380,-1,0),(5,1,4,0,'<p>fdf</p>',1418615417,1418615417,-1,0),(6,1,4,0,'<p>ffffffff</p>',1418615474,1418615474,-1,0),(7,1,3,0,'<p>mail is comming.</p>',1418616888,1418616888,-1,0),(8,1,3,0,'<p>mail is comming.</p>',1418617069,1418617069,-1,0),(9,1,3,0,'test',1418617147,1418617147,-1,0),(10,1,3,0,'test',1418617184,1418617184,-1,0),(11,1,3,0,'test',1418617204,1418617204,-1,0),(12,1,3,0,'test',1418617323,1418617323,-1,0),(13,1,3,0,'test',1418617337,1418617337,-1,0),(14,1,3,0,'test',1418617491,1418617491,-1,0),(15,1,3,0,'test',1418617580,1418617580,-1,0),(16,1,3,0,'test',1418617592,1418617592,-1,0),(17,1,3,0,'test',1418617612,1418617612,-1,0),(18,1,3,0,'test',1418617645,1418617645,-1,0),(19,1,3,0,'test',1418617690,1418617690,-1,0),(20,1,3,0,'test',1418617724,1418617724,-1,0),(21,1,3,0,'test',1418617772,1418617772,-1,0),(22,1,3,0,'test',1418617815,1418617815,-1,0),(23,1,3,0,'test',1418617827,1418617827,-1,0),(24,1,3,0,'test',1418617948,1418617948,-1,0),(25,1,3,0,'test',1418617985,1418617985,-1,0),(26,1,3,0,'test',1418618039,1418618039,-1,0),(27,1,3,0,'test',1418618115,1418618115,-1,0),(28,1,3,0,'test',1418618171,1418618171,-1,0),(29,1,3,0,'test',1418618272,1418618272,-1,0),(30,1,3,0,'test',1418618297,1418618297,-1,0),(31,1,3,0,'<p>send a mail must</p>',1418618411,1418618411,-1,0),(32,1,3,0,'test',1418618477,1418618477,-1,0),(33,1,3,0,'test',1418618501,1418618501,-1,0),(34,1,3,0,'<p>a email send</p>',1418618611,1418618611,-1,0),(35,1,3,0,'<p>无聊呀</p>',1418622704,1418622704,1,0),(36,1,3,0,'<p>kkkkkkkkkkkkkkkkkkkk</p>',1418624535,1418624535,1,0),(37,1,3,0,'test',1418624580,1418624580,1,0),(38,1,3,0,'<p>kkkkkkkkkkkk</p>',1418624604,1418624604,1,0),(39,1,3,0,'test',1418624619,1418624619,1,0),(40,1,3,0,'test',1418624652,1418624652,1,0),(41,1,3,0,'<p>在　来一下</p>',1418625069,1418625069,1,0),(42,1,3,0,'test',1418625313,1418625313,1,0),(43,1,2,0,'<p>hahahhhhhhhh</p>',1418630424,1418630424,1,0),(44,1,3,0,'test',1418630586,1418630586,1,0),(45,1,3,0,'test',1418630655,1418630655,1,0),(46,1,1,0,'<p>xxxxxxxxxxxxxxxxxx</p>',1418630799,1418630799,1,0),(47,1,3,0,'test',1418630816,1418630816,1,0),(48,1,3,0,'test',1418630905,1418630905,1,0),(49,1,3,0,'test',1418630916,1418630916,1,0),(50,1,3,0,'test',1418631061,1418631061,1,0),(51,1,3,0,'test',1418631246,1418631246,1,0),(52,1,3,0,'<p>buchou</p>',1418636033,1418636033,1,0),(53,1,3,0,'test',1418636047,1418636047,1,0),(54,1,3,0,'test',1418636144,1418636144,1,0),(55,1,19,0,'<p>看看吧</p>',1418797496,1418797496,0,0),(56,61,19,0,'<p>huidayige</p>',1418828522,1418828522,1,23),(57,61,19,0,'<p>ziakankan</p>',1418877427,1418877427,1,24),(58,61,19,0,'<p>lailalalal</p>',1418877441,1418877441,1,25),(59,1,20,0,'<p>看看吧</p>',1418893298,1418893298,1,0),(60,1,20,0,'<p>好东西呀</p>',1418894155,1418894155,1,0),(61,61,20,0,'<p>apacal reply</p>',1418894758,1418894758,1,0),(62,61,21,0,'<p>hhhhhhhhhhhhhh</p>',1418894855,1418894855,1,0),(63,1,3,0,'test',1419307682,1419307682,1,0),(64,1,3,0,'test',1419329542,1419329542,1,0),(65,1,24,0,'<p>hello</p><p><br/></p><p><br/></p>',1419855571,1419855571,1,0),(66,1,19,0,'<p>fsdfsdf</p>',1419859264,1419859264,0,0),(67,1,19,0,'<p>fdfd</p>',1419859345,1419859345,0,0),(68,1,19,0,'<p>gfdgdfg</p>',1419870220,1419870220,0,0),(69,1,19,0,'<p>fdsfsdf</p>',1419870692,1419870692,0,0),(70,1,19,0,'<p>fdsfd</p>',1419870806,1419870806,0,0),(71,1,19,0,'<p>fffffffffff</p>',1419870922,1419870922,1,0),(72,1,19,0,'<p>fdsfdf</p>',1419871266,1419871266,1,0),(73,62,19,0,'<p>活动社会的上海</p>',1419873279,1419873279,1,0);
/*!40000 ALTER TABLE `mj_forum_post_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_forum_reply_complaint`
--

DROP TABLE IF EXISTS `mj_forum_reply_complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_forum_reply_complaint` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) unsigned NOT NULL,
  `reply_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `content` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_reply_id` (`uid`,`reply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_forum_reply_complaint`
--

LOCK TABLES `mj_forum_reply_complaint` WRITE;
/*!40000 ALTER TABLE `mj_forum_reply_complaint` DISABLE KEYS */;
INSERT INTO `mj_forum_reply_complaint` VALUES (23,1,56,0,'广发华福'),(24,1,57,0,'嘎嘎嘎');
/*!40000 ALTER TABLE `mj_forum_reply_complaint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_forum_tags`
--

DROP TABLE IF EXISTS `mj_forum_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_forum_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(2) DEFAULT '0',
  `tags_group` bigint(10) NOT NULL DEFAULT '0',
  `used_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_forum_tags`
--

LOCK TABLES `mj_forum_tags` WRITE;
/*!40000 ALTER TABLE `mj_forum_tags` DISABLE KEYS */;
INSERT INTO `mj_forum_tags` VALUES (14,'Linux',1,0,15),(15,'C',1,0,3),(16,'PHP',0,0,1),(17,'NGINX',0,0,1),(18,'PYTHON',0,0,7);
/*!40000 ALTER TABLE `mj_forum_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_forum_tags_relationships`
--

DROP TABLE IF EXISTS `mj_forum_tags_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_forum_tags_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `tag_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_forum_tags_relationships`
--

LOCK TABLES `mj_forum_tags_relationships` WRITE;
/*!40000 ALTER TABLE `mj_forum_tags_relationships` DISABLE KEYS */;
INSERT INTO `mj_forum_tags_relationships` VALUES (1,14,0),(1,16,0),(6,3,0),(6,4,0),(6,5,0),(6,6,0),(6,9,0),(15,3,0),(15,4,0),(16,1,0),(16,4,0),(16,6,0),(16,8,0),(16,12,0),(16,13,0),(17,14,0),(18,17,0),(19,18,0),(20,14,0),(21,14,0),(25,14,0);
/*!40000 ALTER TABLE `mj_forum_tags_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group`
--

DROP TABLE IF EXISTS `mj_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `post_count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `allow_user_group` text NOT NULL,
  `sort` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  `background` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '群组类型，0为公共的，1为私有的',
  `activity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group`
--

LOCK TABLES `mj_group` WRITE;
/*!40000 ALTER TABLE `mj_group` DISABLE KEYS */;
INSERT INTO `mj_group` VALUES (1,60,'zhong创建的圈子',1417674999,0,1,'0',0,110,111,1,'我们一起讨论事情吧！',0,0);
/*!40000 ALTER TABLE `mj_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group_bookmark`
--

DROP TABLE IF EXISTS `mj_group_bookmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group_bookmark`
--

LOCK TABLES `mj_group_bookmark` WRITE;
/*!40000 ALTER TABLE `mj_group_bookmark` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_group_bookmark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group_dynamic`
--

DROP TABLE IF EXISTS `mj_group_dynamic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group_dynamic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `row_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group_dynamic`
--

LOCK TABLES `mj_group_dynamic` WRITE;
/*!40000 ALTER TABLE `mj_group_dynamic` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_group_dynamic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group_lzl_reply`
--

DROP TABLE IF EXISTS `mj_group_lzl_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group_lzl_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `to_f_reply_id` int(11) NOT NULL,
  `to_reply_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `uid` int(11) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group_lzl_reply`
--

LOCK TABLES `mj_group_lzl_reply` WRITE;
/*!40000 ALTER TABLE `mj_group_lzl_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_group_lzl_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group_member`
--

DROP TABLE IF EXISTS `mj_group_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `activity` int(11) NOT NULL,
  `last_view` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group_member`
--

LOCK TABLES `mj_group_member` WRITE;
/*!40000 ALTER TABLE `mj_group_member` DISABLE KEYS */;
INSERT INTO `mj_group_member` VALUES (1,1,60,1,1417674999,1417674999,0,1417675001);
/*!40000 ALTER TABLE `mj_group_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group_notice`
--

DROP TABLE IF EXISTS `mj_group_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group_notice`
--

LOCK TABLES `mj_group_notice` WRITE;
/*!40000 ALTER TABLE `mj_group_notice` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_group_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group_post`
--

DROP TABLE IF EXISTS `mj_group_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `parse` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `last_reply_time` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `reply_count` int(11) NOT NULL,
  `is_top` tinyint(4) NOT NULL COMMENT '是否置顶',
  `cate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group_post`
--

LOCK TABLES `mj_group_post` WRITE;
/*!40000 ALTER TABLE `mj_group_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_group_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group_post_category`
--

DROP TABLE IF EXISTS `mj_group_post_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group_post_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL COMMENT '所属群组',
  `title` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group_post_category`
--

LOCK TABLES `mj_group_post_category` WRITE;
/*!40000 ALTER TABLE `mj_group_post_category` DISABLE KEYS */;
INSERT INTO `mj_group_post_category` VALUES (1,1,'默认分类',1417674999,1,0);
/*!40000 ALTER TABLE `mj_group_post_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group_post_reply`
--

DROP TABLE IF EXISTS `mj_group_post_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group_post_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `parse` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group_post_reply`
--

LOCK TABLES `mj_group_post_reply` WRITE;
/*!40000 ALTER TABLE `mj_group_post_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_group_post_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_group_type`
--

DROP TABLE IF EXISTS `mj_group_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_group_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='群组的分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_group_type`
--

LOCK TABLES `mj_group_type` WRITE;
/*!40000 ALTER TABLE `mj_group_type` DISABLE KEYS */;
INSERT INTO `mj_group_type` VALUES (1,'圈子默认分类',1,0,1409811696);
/*!40000 ALTER TABLE `mj_group_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_hooks`
--

DROP TABLE IF EXISTS `mj_hooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_hooks`
--

LOCK TABLES `mj_hooks` WRITE;
/*!40000 ALTER TABLE `mj_hooks` DISABLE KEYS */;
INSERT INTO `mj_hooks` VALUES (1,'pageHeader','页面header钩子，一般用于加载插件CSS文件和代码',1,0,'ImageSlider'),(2,'pageFooter','页面footer钩子，一般用于加载插件JS文件和JS代码',1,0,'SuperLinks'),(3,'documentEditForm','添加编辑表单的 扩展内容钩子',1,0,'Attachment'),(4,'documentDetailAfter','文档末尾显示',1,0,'Attachment,SocialComment,Avatar'),(5,'documentDetailBefore','页面内容前显示用钩子',1,0,''),(6,'documentSaveComplete','保存文档数据后的扩展钩子',2,0,'Attachment'),(7,'documentEditFormContent','添加编辑表单的内容显示钩子',1,0,'Editor'),(8,'adminArticleEdit','后台内容编辑页编辑器',1,1378982734,'EditorForAdmin'),(13,'AdminIndex','首页小格子个性化显示',1,1382596073,'SiteStat,SystemInfo,SyncLogin,Advertising,DevTeam'),(14,'topicComment','评论提交方式扩展钩子。',1,1380163518,'Editor'),(16,'app_begin','应用开始',2,1384481614,'Iswaf'),(17,'checkin','签到',1,1395371353,'Checkin'),(18,'Rank','签到排名钩子',1,1395387442,'Rank_checkin'),(20,'support','赞',1,1398264759,'Support'),(21,'localComment','本地评论插件',1,1399440321,'LocalComment'),(22,'weiboType','微博类型',1,1409121894,'InsertImage'),(23,'repost','转发钩子',1,1403668286,'Repost'),(24,'syncLogin','第三方登陆位置',1,1403700579,'SyncLogin'),(25,'syncMeta','第三方登陆meta接口',1,1403700633,'SyncLogin'),(26,'J_China_City','每个系统都需要的一个中国省市区三级联动插件。',1,1403841931,'ChinaCity'),(27,'Advs','广告位插件',1,1406687667,'Advs'),(28,'imageSlider','图片轮播钩子',1,1407144022,'ImageSlider'),(29,'friendLink','友情链接插件',1,1407156413,'SuperLinks'),(30,'beforeSendWeibo','在发微博之前预处理微博',2,1408084504,'InsertFile'),(31,'beforeSendRepost','转发微博前的预处理钩子',2,1408085689,''),(32,'parseWeiboContent','解析微博内容钩子',2,1409121261,'');
/*!40000 ALTER TABLE `mj_hooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_issue`
--

DROP TABLE IF EXISTS `mj_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `allow_post` tinyint(4) NOT NULL,
  `pid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_issue`
--

LOCK TABLES `mj_issue` WRITE;
/*!40000 ALTER TABLE `mj_issue` DISABLE KEYS */;
INSERT INTO `mj_issue` VALUES (13,'默认一级',1409712474,1409712467,1,0,0,0),(14,'默认二级',1409712480,1409712475,1,0,13,0);
/*!40000 ALTER TABLE `mj_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_issue_content`
--

DROP TABLE IF EXISTS `mj_issue_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_issue_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `view_count` int(11) NOT NULL COMMENT '阅读数量',
  `cover_id` int(11) NOT NULL COMMENT '封面图片id',
  `issue_id` int(11) NOT NULL COMMENT '所在专辑',
  `uid` int(11) NOT NULL COMMENT '发布者id',
  `reply_count` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='专辑内容表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_issue_content`
--

LOCK TABLES `mj_issue_content` WRITE;
/*!40000 ALTER TABLE `mj_issue_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_issue_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_local_comment`
--

DROP TABLE IF EXISTS `mj_local_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_local_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `app` text NOT NULL,
  `mod` text NOT NULL,
  `row_id` int(11) NOT NULL,
  `parse` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `create_time` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_local_comment`
--

LOCK TABLES `mj_local_comment` WRITE;
/*!40000 ALTER TABLE `mj_local_comment` DISABLE KEYS */;
INSERT INTO `mj_local_comment` VALUES (1,0,'Event','event',9,0,'不会吧！就结束了！',1417675100,0,1);
/*!40000 ALTER TABLE `mj_local_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_member`
--

DROP TABLE IF EXISTS `mj_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(16) NOT NULL DEFAULT '' COMMENT '昵称',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `qq` char(10) NOT NULL DEFAULT '' COMMENT 'qq号',
  `score` mediumint(8) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会员状态',
  `signature` text NOT NULL,
  `tox_money` int(11) NOT NULL,
  `pos_province` int(11) NOT NULL,
  `pos_city` int(11) NOT NULL,
  `pos_district` int(11) NOT NULL,
  `pos_community` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `status` (`status`),
  KEY `name` (`nickname`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_member`
--

LOCK TABLES `mj_member` WRITE;
/*!40000 ALTER TABLE `mj_member` DISABLE KEYS */;
INSERT INTO `mj_member` VALUES (1,'admin',0,'0000-00-00','',171,54,0,1417659262,2130706433,1419910759,1,'fdfdfdfdfdffdfdf',36,0,0,0,0),(58,'mark',0,'0000-00-00','',0,0,0,1417659591,0,0,1,'',0,0,0,0,0),(59,'mengjukeji',0,'0000-00-00','',0,0,0,1417673956,0,0,1,'',0,0,0,0,0),(60,'zhong',1,'0000-00-00','',21,2,0,1417674095,0,1417676544,1,'',5,0,0,0,0),(61,'apacal',0,'0000-00-00','',32,15,2130706433,1418795174,2130706433,1419008093,-1,'',3,0,0,0,0),(62,'richard',0,'0000-00-00','',23,2,2130706433,1419347620,2130706433,1419873267,1,'',0,0,0,0,0),(63,'rich',0,'0000-00-00','',10,1,2130706433,1419347801,2130706433,1419347801,1,'',0,0,0,0,0);
/*!40000 ALTER TABLE `mj_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_menu`
--

DROP TABLE IF EXISTS `mj_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=2251 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_menu`
--

LOCK TABLES `mj_menu` WRITE;
/*!40000 ALTER TABLE `mj_menu` DISABLE KEYS */;
INSERT INTO `mj_menu` VALUES (1,'首页',0,1,'Index/index',0,'','',0),(3,'文档列表',2,0,'article/index',1,'','内容',0),(4,'新增',3,0,'article/add',0,'','',0),(5,'编辑',3,0,'article/edit',0,'','',0),(6,'改变状态',3,0,'article/setStatus',0,'','',0),(7,'保存',3,0,'article/update',0,'','',0),(8,'保存草稿',3,0,'article/autoSave',0,'','',0),(9,'移动',3,0,'article/move',0,'','',0),(10,'复制',3,0,'article/copy',0,'','',0),(11,'粘贴',3,0,'article/paste',0,'','',0),(12,'导入',3,0,'article/batchOperate',0,'','',0),(13,'回收站',2,0,'article/recycle',1,'','内容',0),(14,'还原',13,0,'article/permit',0,'','',0),(15,'清空',13,0,'article/clear',0,'','',0),(16,'用户',0,5,'User/index',0,'','',0),(17,'用户信息',16,1,'User/index',0,'','用户管理',0),(18,'新增用户',17,0,'User/add',0,'添加新用户','',0),(19,'用户行为',16,18,'User/action',0,'','行为管理',0),(20,'新增用户行为',19,0,'User/addaction',0,'','',0),(21,'编辑用户行为',19,0,'User/editaction',0,'','',0),(22,'保存用户行为',19,0,'User/saveAction',0,'\"用户->用户行为\"保存编辑和新增的用户行为','',0),(23,'变更行为状态',19,0,'User/setStatus',0,'\"用户->用户行为\"中的启用,禁用和删除权限','',0),(24,'禁用会员',19,0,'User/changeStatus?method=forbidUser',0,'\"用户->用户信息\"中的禁用','',0),(25,'启用会员',19,0,'User/changeStatus?method=resumeUser',0,'\"用户->用户信息\"中的启用','',0),(26,'删除会员',19,0,'User/changeStatus?method=deleteUser',0,'\"用户->用户信息\"中的删除','',0),(27,'权限管理',16,2,'AuthManager/index',0,'','用户管理',0),(28,'删除',27,0,'AuthManager/changeStatus?method=deleteGroup',0,'删除用户组','',0),(29,'禁用',27,0,'AuthManager/changeStatus?method=forbidGroup',0,'禁用用户组','',0),(30,'恢复',27,0,'AuthManager/changeStatus?method=resumeGroup',0,'恢复已禁用的用户组','',0),(31,'新增',27,0,'AuthManager/createGroup',0,'创建新的用户组','',0),(32,'编辑',27,0,'AuthManager/editGroup',0,'编辑用户组名称和描述','',0),(33,'保存用户组',27,0,'AuthManager/writeGroup',0,'新增和编辑用户组的\"保存\"按钮','',0),(34,'授权',27,0,'AuthManager/group',0,'\"后台 \\ 用户 \\ 用户信息\"列表页的\"授权\"操作按钮,用于设置用户所属用户组','',0),(35,'访问授权',27,0,'AuthManager/access',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"访问授权\"操作按钮','',0),(36,'成员授权',27,0,'AuthManager/user',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"成员授权\"操作按钮','',0),(37,'解除授权',27,0,'AuthManager/removeFromGroup',0,'\"成员授权\"列表页内的解除授权操作按钮','',0),(38,'保存成员授权',27,0,'AuthManager/addToGroup',0,'\"用户信息\"列表页\"授权\"时的\"保存\"按钮和\"成员授权\"里右上角的\"添加\"按钮)','',0),(39,'分类授权',27,0,'AuthManager/category',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"分类授权\"操作按钮','',0),(40,'保存分类授权',27,0,'AuthManager/addToCategory',0,'\"分类授权\"页面的\"保存\"按钮','',0),(41,'模型授权',27,0,'AuthManager/modelauth',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"模型授权\"操作按钮','',0),(42,'保存模型授权',27,0,'AuthManager/addToModel',0,'\"分类授权\"页面的\"保存\"按钮','',0),(43,'扩展',0,7,'Addons/index',0,'','',0),(44,'插件管理',43,1,'Addons/index',0,'','扩展',0),(45,'创建',44,0,'Addons/create',0,'服务器上创建插件结构向导','',0),(46,'检测创建',44,0,'Addons/checkForm',0,'检测插件是否可以创建','',0),(47,'预览',44,0,'Addons/preview',0,'预览插件定义类文件','',0),(48,'快速生成插件',44,0,'Addons/build',0,'开始生成插件结构','',0),(49,'设置',44,0,'Addons/config',0,'设置插件配置','',0),(50,'禁用',44,0,'Addons/disable',0,'禁用插件','',0),(51,'启用',44,0,'Addons/enable',0,'启用插件','',0),(52,'安装',44,0,'Addons/install',0,'安装插件','',0),(53,'卸载',44,0,'Addons/uninstall',0,'卸载插件','',0),(54,'更新配置',44,0,'Addons/saveconfig',0,'更新插件配置处理','',0),(55,'插件后台列表',44,0,'Addons/adminList',0,'','',0),(56,'URL方式访问插件',44,0,'Addons/execute',0,'控制是否有权限通过url访问插件控制器方法','',0),(57,'钩子管理',43,2,'Addons/hooks',0,'','扩展',0),(58,'模型管理',2,3,'Model/index',0,'','系统设置',0),(59,'新增',58,0,'model/add',0,'','',0),(60,'编辑',58,0,'model/edit',0,'','',0),(61,'改变状态',58,0,'model/setStatus',0,'','',0),(62,'保存数据',58,0,'model/update',0,'','',0),(63,'属性管理',68,0,'Attribute/index',1,'网站属性配置。','',0),(64,'新增',63,0,'Attribute/add',0,'','',0),(65,'编辑',63,0,'Attribute/edit',0,'','',0),(66,'改变状态',63,0,'Attribute/setStatus',0,'','',0),(67,'保存数据',63,0,'Attribute/update',0,'','',0),(68,'系统',0,8,'Config/group',0,'','',0),(69,'网站设置',68,1,'Config/group',0,'','系统设置',0),(70,'配置管理',68,4,'Config/index',0,'','系统设置',0),(71,'编辑',70,0,'Config/edit',0,'新增编辑和保存配置','',0),(72,'删除',70,0,'Config/del',0,'删除配置','',0),(73,'新增',70,0,'Config/add',0,'新增配置','',0),(74,'保存',70,0,'Config/save',0,'保存配置','',0),(75,'菜单管理',68,5,'Menu/index',0,'','系统设置',0),(76,'导航管理',68,6,'Channel/index',0,'','系统设置',0),(77,'新增',76,0,'Channel/add',0,'','',0),(78,'编辑',76,0,'Channel/edit',0,'','',0),(79,'删除',76,0,'Channel/del',0,'','',0),(80,'分类管理',2,2,'Category/index',0,'','系统设置',0),(81,'编辑',80,0,'Category/edit',0,'编辑和保存栏目分类','',0),(82,'新增',80,0,'Category/add',0,'新增栏目分类','',0),(83,'删除',80,0,'Category/remove',0,'删除栏目分类','',0),(84,'移动',80,0,'Category/operate/type/move',0,'移动栏目分类','',0),(85,'合并',80,0,'Category/operate/type/merge',0,'合并栏目分类','',0),(86,'备份数据库',68,20,'Database/index?type=export',0,'','数据备份',0),(87,'备份',86,0,'Database/export',0,'备份数据库','',0),(88,'优化表',86,0,'Database/optimize',0,'优化数据表','',0),(89,'修复表',86,0,'Database/repair',0,'修复数据表','',0),(90,'还原数据库',68,0,'Database/index?type=import',0,'','数据备份',0),(91,'恢复',90,0,'Database/import',0,'数据库恢复','',0),(92,'删除',90,0,'Database/del',0,'删除备份文件','',0),(96,'新增',75,0,'Menu/add',0,'','系统设置',0),(98,'编辑',75,0,'Menu/edit',0,'','',0),(104,'下载管理',102,0,'Think/lists?model=download',0,'','',0),(105,'配置管理',102,0,'Think/lists?model=config',0,'','',0),(106,'行为日志',16,17,'Action/actionlog',0,'','行为管理',0),(108,'修改密码',16,3,'User/updatePassword',1,'','',0),(109,'修改昵称',16,4,'User/updateNickname',1,'','',0),(110,'查看行为日志',106,0,'action/edit',1,'','',0),(112,'新增数据',58,0,'think/add',1,'','',0),(113,'编辑数据',58,0,'think/edit',1,'','',0),(114,'导入',75,0,'Menu/import',0,'','',0),(115,'生成',58,0,'Model/generate',0,'','',0),(116,'新增钩子',57,0,'Addons/addHook',0,'','',0),(117,'编辑钩子',57,0,'Addons/edithook',0,'','',0),(118,'文档排序',3,0,'Article/sort',1,'','',0),(119,'排序',70,0,'Config/sort',1,'','',0),(120,'排序',75,0,'Menu/sort',1,'','',0),(121,'排序',76,0,'Channel/sort',1,'','',0),(122,'问答',0,2,'Forum/index',0,'','',0),(123,'动态',0,3,'Weibo/weibo',0,'','',0),(124,'板块管理',122,6,'Forum/forum',0,'','板块',0),(125,'问答管理',122,1,'Forum/post',0,'','问答',0),(126,'编辑／发表帖子',124,0,'Forum/editForum',0,'','',0),(127,'edit pots',125,0,'Forum/editPost',0,'','',0),(128,'排序',124,0,'Forum/sortForum',0,'','',0),(130,'新增、编辑',132,0,'SEO/editRule',0,'','',0),(131,'排序',132,0,'SEO/sortRule',0,'','',0),(132,'规则管理',68,0,'SEO/index',0,'','SEO规则',0),(133,'回复管理',122,8,'/Admin/Forum/reply',0,'','回复',0),(134,'新增 编辑',133,0,'Forum/editReply',0,'','',0),(140,'编辑回复',138,0,'Weibo/editComment',0,'','',0),(139,'编辑微博',137,0,'Weibo/editWeibo',0,'','',0),(137,'微博管理',123,1,'Weibo/weibo',0,'','微博',0),(138,'回复管理',123,3,'Weibo/comment',0,'','回复',0),(141,'板块回收站',122,7,'Forum/forumTrash',0,'','板块',0),(142,'问答回收站',122,2,'Forum/postTrash',0,'','问答',0),(143,'回复回收站',122,9,'Forum/replyTrash',0,'','回复',0),(144,'微博回收站',123,2,'Weibo/weiboTrash',0,'','微博',0),(145,'回复回收站',123,4,'Weibo/commentTrash',0,'','回复',0),(146,'规则回收站',68,0,'SEO/ruleTrash',0,'','SEO规则',0),(147,'头衔列表',16,16,'Rank/index',0,'','头衔管理',0),(149,'添加头衔',16,15,'Rank/editRank',1,'','头衔管理',0),(150,'查看用户',16,5,'Rank/userList',0,'','头衔管理',0),(151,'用户头衔列表',150,0,'Rank/userRankList',1,'','',0),(152,'关联新头衔',150,0,'Rank/userAddRank',1,'','',0),(153,'编辑头衔关联',150,0,'Rank/userChangeRank',1,'','',0),(155,'编辑专辑',154,0,'Issue/add',1,'','专辑',0),(156,'专辑管理',154,0,'Issue/issue',0,'','专辑',0),(157,'专辑回收站',154,4,'Issue/issueTrash',0,'','专辑',0),(158,'专辑操作',154,0,'Issue/operate',1,'','专辑',0),(159,'内容审核',154,1,'Issue/verify',0,'','内容管理',0),(160,'内容回收站',154,5,'Issue/contentTrash',0,'','内容管理',0),(161,'内容管理',154,0,'Issue/contents',0,'','内容管理',0),(162,'扩展资料',16,6,'Admin/User/profile',0,'','用户管理',0),(163,'添加、编辑分组',162,0,'Admin/User/editProfile',0,'','',0),(164,'分组排序',162,0,'Admin/User/sortProfile',0,'','',0),(165,'字段列表',162,0,'Admin/User/field',0,'','',0),(166,'添加、编辑字段',165,0,'Admin/User/editFieldSetting',0,'','',0),(167,'字段排序',165,0,'Admin/User/sortField',0,'','',0),(168,'全部补丁',68,0,'Admin/Update/quick',0,'','升级补丁',0),(169,'新增补丁',68,0,'Admin/Update/addpack',0,'','升级补丁',0),(170,'用户扩展资料列表',16,7,'Admin/User/expandinfo_select',0,'','用户管理',0),(171,'扩展资料详情',170,0,'User/expandinfo_details',0,'','',0),(185,'商城信息记录',172,0,'Shop/shopLog',0,'','商城记录',0),(184,'待发货交易',172,4,'Shop/verify',0,'','交易管理',0),(183,'交易成功记录',172,5,'Shop/goodsBuySuccess',0,'','交易管理',0),(182,'商品分类状态设置',176,0,'Shop/setStatus',0,'','',0),(181,'商品状态设置',174,0,'Shop/setGoodsStatus',0,'','',0),(180,'商品回收站',172,7,'Shop/goodsTrash',0,'','商品管理',0),(179,'商品分类回收站',172,3,'Shop/categoryTrash',0,'','商城配置',0),(178,'商品分类操作',176,0,'Shop/operate',0,'','',0),(176,'商品分类配置',172,2,'Shop/shopCategory',0,'','商城配置',0),(177,'商品分类添加',176,0,'Shop/add',0,'','',0),(175,'添加、编辑商品',174,0,'Shop/goodsEdit',0,'','',0),(174,'商品列表',172,1,'Shop/goodsList',0,'','商品管理',0),(173,'货币配置',172,8,'Shop/toxMoneyConfig',0,'','商城配置',0),(186,'热销商品阀值配置',172,0,'Shop/hotSellConfig',0,'','商城配置',0),(187,'设置新品',174,0,'Shop/setNew',0,'','',0),(189,'活动分类管理',188,0,'EventType/index',0,'','活动分类管理',0),(190,'内容管理',188,0,'Event/event',0,'','内容管理',0),(191,'活动分类回收站',188,0,'EventType/eventTypeTrash',0,'','活动分类管理',0),(192,'内容审核',188,0,'Event/verify',0,'','内容管理',0),(193,'内容回收站',188,0,'Event/contentTrash',0,'','内容管理',0),(216,'待审核用户头衔',16,8,'Rank/rankVerify',0,'','头衔管理',0),(217,'被驳回的头衔申请',16,9,'Rank/rankVerifyFailure',0,'','头衔管理',0),(218,'微博设置',123,0,'Weibo/config',0,'微博的基本配置','设置',0),(219,'论坛设置',122,10,'Forum/config',1,'','设置',1),(220,'专辑设置',154,0,'Issue/config',0,'','设置',0),(221,'活动设置',188,0,'Event/config',0,'','设置',0),(222,'等级管理',16,10,'User/level',0,'','用户管理',0),(2216,'圈子',0,4,'admin/group/index',0,'','',0),(2217,'圈子管理',2216,0,'admin/group/group',0,'','圈子',0),(2218,'圈子分类管理',2216,0,'group/groupType',0,'','圈子',0),(2219,'文章分类',2216,0,'group/postType',0,'','文章',0),(2220,'修改分类',2216,0,'group/editPostCate',1,'','文章',0),(2221,'类型排序',2216,0,'group/sortPostCate',1,'','文章',0),(2222,'修改圈子分类',2216,0,'group/editGroupType',1,'','圈子',0),(2223,'圈子类型排序',2216,0,'group/sortGroupType',1,'','圈子',0),(2224,'编辑楼中楼回复',2216,0,'group/editLzlReply',1,'','回复',0),(2225,'楼中楼回复',2216,0,'group/lzlreply',1,'','回复',0),(2226,'楼中楼回复回收站',2216,0,'group/lzlreplyTrash',1,'','回复',0),(2227,'编辑回复',2216,0,'group/editReply',1,'','回复',0),(2228,'圈子回收站',2216,0,'group/groupTrash',0,'','圈子',0),(2229,'文章管理',2216,0,'group/post',0,'','文章',0),(2230,'文章回收站',2216,0,'group/postTrash',0,'','文章',0),(2231,'回复管理',2216,0,'group/reply',0,'','回复',0),(2232,'回复回收站',2216,0,'group/replyTrash',0,'','回复',0),(2233,'圈子设置',2216,0,'group/config',0,'','圈子',0),(2234,'未审核圈子',2216,0,'group/unverify',0,'','圈子',0),(2240,'头衔权限节点管理',16,11,'rank/authRuleManage',0,'','头衔管理',0),(2236,'标签管理',122,3,'Forum/manageTags',0,'','标签',0),(2239,'投诉管理',122,5,'Forum/complaint',0,'','投诉',0),(2238,'编辑标签',122,4,'Forum/editTags',1,'','标签',0),(2241,'编辑头衔权限规则',16,12,'rank/editauthrule',1,'','头衔管理',0),(2242,'访问授权',16,13,'Rank/manageAuth',1,'','头衔管理',0),(2243,'头衔用户授权',16,14,'rank/manageAuthUsers',1,'','头衔管理',0),(2244,'钱包充值商城',2246,1,'Wallet/managePayShop',0,'','钱包',0),(2245,'编辑钱包充值商城',2246,15,'Wallet/editPayShop',1,'','钱包',0),(2246,'钱包',0,6,'Wallet/order',0,'','',0),(2247,'钱包',2247,0,'Wallet/order',0,'','',0),(2248,'钱包交易',2246,0,'Wallet/order',0,'','',0),(2249,'用户钱包',2246,0,'Wallet/userWallet',0,'','钱包',0),(2250,'交易详情',2246,0,'Wallet/orderDetail',1,'','钱包',0);
/*!40000 ALTER TABLE `mj_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_message`
--

DROP TABLE IF EXISTS `mj_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_uid` int(11) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0系统消息,1用户消息,2应用消息',
  `is_read` tinyint(4) NOT NULL,
  `last_toast` int(11) NOT NULL,
  `url` varchar(400) NOT NULL,
  `talk_id` int(11) NOT NULL,
  `appname` varchar(30) NOT NULL,
  `apptype` varchar(30) NOT NULL,
  `source_id` int(11) NOT NULL,
  `find_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=338 DEFAULT CHARSET=utf8 COMMENT='thinkox新增消息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_message`
--

LOCK TABLES `mj_message` WRITE;
/*!40000 ALTER TABLE `mj_message` DISABLE KEYS */;
INSERT INTO `mj_message` VALUES (322,60,1,'粉丝数增加','zhong 关注了你。',1417674934,0,0,1418568093,'/thinkox/index.php?s=/usercenter/index/index/uid/60.html',0,'usercenter','',0,0,0),(323,60,1,'粉丝数减少','zhong取消了对你的关注',1417674938,0,0,1418568093,'/thinkox/index.php?s=/usercenter/index/index/uid/60.html',0,'usercenter','',0,0,0),(324,60,1,'粉丝数增加','zhong 关注了你。',1417674939,0,1,1418568093,'/thinkox/index.php?s=/usercenter/index/index/uid/60.html',0,'usercenter','',0,0,0),(325,0,60,'游客评论了您','评论内容：不会吧！就结束了！',1417675100,0,1,1417675105,'http://localhost/thinkox/index.php?s=/event/index/detail/id/9.html',0,'Event','',0,0,0),(326,1,60,'admin回复了您的帖子。','回复内容：xxxxxxxxxxxxxxxxxx',1418630799,2,0,0,'/index.php?s=/forum/index/detail/id/1/page/1.html#46',0,'forum','reply',1,46,0),(327,0,1,'头衔申请','头衔申请成功,等待管理员审核',1418796909,0,0,1418796911,'/index.php?s=/usercenter/message/message/tab/system.html',0,'usercenter','',0,0,0),(328,61,1,'apacal回复了您的帖子。','回复内容：huidayige',1418828522,2,0,1418828721,'/index.php?s=/forum/index/detail/id/19/page/1.html#56',0,'forum','reply',19,56,0),(329,1,61,'admin回复了您的评论。','回复内容：回复@apacal ：wok',1418828738,2,0,1418877414,'/index.php?s=/forum/index/detail/id/19/page/1/sr/56/sp/1.html#56',0,'forum','',19,101,0),(330,61,1,'apacal回复了您的帖子。','回复内容：ziakankan',1418877427,2,0,1418877457,'/index.php?s=/forum/index/detail/id/19/page/1.html#57',0,'forum','reply',19,57,0),(331,61,1,'apacal回复了您的帖子。','回复内容：lailalalal',1418877441,2,0,1418877457,'/index.php?s=/forum/index/detail/id/19/page/1.html#58',0,'forum','reply',19,58,0),(332,61,1,'apacal回复了您的帖子。','回复内容：apacal reply',1418894758,2,0,1418894876,'/index.php?s=/forum/index/detail/id/20/page/1.html#61',0,'forum','reply',20,61,0),(333,1,61,'头衔颁发','管理员给你颁发了头衔：[高手]',1419000482,1,0,1419008095,'/index.php?s=/usercenter/message/message.html',0,'admin','',0,0,0),(334,1,61,'头衔颁发','管理员给你颁发了头衔：[牛逼]',1419000489,1,0,1419008095,'/index.php?s=/usercenter/message/message.html',0,'admin','',0,0,0),(335,1,61,'头衔颁发','管理员给你颁发了头衔：[高手]',1419008837,1,0,1419008841,'/index.php?s=/usercenter/message/message.html',0,'admin','',0,0,0),(336,1,61,'头衔颁发','管理员给你颁发了头衔：[LEVEL2]',1419234343,1,0,0,'/index.php?s=/usercenter/message/message.html',0,'admin','',0,0,0),(337,62,1,'richard回复了您的帖子。','回复内容：活动社会的上',1419873279,2,0,0,'/index.php?s=/forum/index/detail/id/19/page/1.html#73',0,'forum','reply',19,73,0);
/*!40000 ALTER TABLE `mj_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_model`
--

DROP TABLE IF EXISTS `mj_model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '模型标识',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '模型名称',
  `extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '继承的模型',
  `relation` varchar(30) NOT NULL DEFAULT '' COMMENT '继承与被继承模型的关联字段',
  `need_pk` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '新建表时是否需要主键字段',
  `field_sort` text NOT NULL COMMENT '表单字段排序',
  `field_group` varchar(255) NOT NULL DEFAULT '1:基础' COMMENT '字段分组',
  `attribute_list` text NOT NULL COMMENT '属性列表（表的字段）',
  `template_list` varchar(100) NOT NULL DEFAULT '' COMMENT '列表模板',
  `template_add` varchar(100) NOT NULL DEFAULT '' COMMENT '新增模板',
  `template_edit` varchar(100) NOT NULL DEFAULT '' COMMENT '编辑模板',
  `list_grid` text NOT NULL COMMENT '列表定义',
  `list_row` smallint(2) unsigned NOT NULL DEFAULT '10' COMMENT '列表数据长度',
  `search_key` varchar(50) NOT NULL DEFAULT '' COMMENT '默认搜索字段',
  `search_list` varchar(255) NOT NULL DEFAULT '' COMMENT '高级搜索的字段',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `engine_type` varchar(25) NOT NULL DEFAULT 'MyISAM' COMMENT '数据库引擎',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文档模型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_model`
--

LOCK TABLES `mj_model` WRITE;
/*!40000 ALTER TABLE `mj_model` DISABLE KEYS */;
INSERT INTO `mj_model` VALUES (1,'document','基础文档',0,'',1,'{\"1\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]}','1:基础','','','','','id:编号\r\ntitle:标题:article/index?cate_id=[category_id]&pid=[id]\r\ntype|get_document_type:类型\r\nlevel:优先级\r\nupdate_time|time_format:最后更新\r\nstatus_text:状态\r\nview:浏览\r\nid:操作:[EDIT]&cate_id=[category_id]|编辑,article/setstatus?status=-1&ids=[id]|删除',0,'','',1383891233,1384507827,1,'MyISAM'),(2,'article','文章',1,'',1,'{\"1\":[\"3\",\"24\",\"2\",\"5\"],\"2\":[\"9\",\"13\",\"19\",\"10\",\"12\",\"16\",\"17\",\"26\",\"20\",\"14\",\"11\",\"25\"]}','1:基础,2:扩展','','','','','id:编号\r\ntitle:标题:article/edit?cate_id=[category_id]&id=[id]\r\ncontent:内容',0,'','',1383891243,1387260622,1,'MyISAM'),(3,'download','下载',1,'',1,'{\"1\":[\"3\",\"28\",\"30\",\"32\",\"2\",\"5\",\"31\"],\"2\":[\"13\",\"10\",\"27\",\"9\",\"12\",\"16\",\"17\",\"19\",\"11\",\"20\",\"14\",\"29\"]}','1:基础,2:扩展','','','','','id:编号\r\ntitle:标题',0,'','',1383891252,1387260449,1,'MyISAM');
/*!40000 ALTER TABLE `mj_model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_pay_shop`
--

DROP TABLE IF EXISTS `mj_pay_shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_pay_shop` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `money` int(10) unsigned NOT NULL DEFAULT '5',
  `description` varchar(500) NOT NULL DEFAULT '',
  `shop_url` varchar(500) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_pay_shop`
--

LOCK TABLES `mj_pay_shop` WRITE;
/*!40000 ALTER TABLE `mj_pay_shop` DISABLE KEYS */;
INSERT INTO `mj_pay_shop` VALUES (11,'１元',1,'充值1元红包','http://kuwang.apacal.cn/',1);
/*!40000 ALTER TABLE `mj_pay_shop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_picture`
--

DROP TABLE IF EXISTS `mj_picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `type` varchar(50) NOT NULL,
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_picture`
--

LOCK TABLES `mj_picture` WRITE;
/*!40000 ALTER TABLE `mj_picture` DISABLE KEYS */;
INSERT INTO `mj_picture` VALUES (110,'local','/Uploads/Picture/2014-12-04/54800074878a0.JPG','','39ff197d12ea69ea463f59186db05a0c','414ed941442fb1068bf73d022448d8bb2f967c92',1,1417674868),(111,'local','/Uploads/Picture/2014-12-04/54800112177b3.jpg','','fc06c317e7e47034f4848af84d60b839','723fd77cc93aa8e1348fca3ab77178e5b1a0dbfa',1,1417675025),(112,'local','/Uploads/Picture/2014-12-17/54911f27b6cc4.png','','d5c1335c2deaff04b3a005064efa40fb','d2a7be0f89fe3b9879ccb55f0f894e761d0fdc23',1,1418796839),(113,'local','/Uploads/Picture/2014-12-19/5493fc93d697d.png','','ba8fc0ede0d3256edca0e509fc0d5182','eba2a02e45876d83e326e29d3fe35028bc032de9',1,1418984595),(114,'local','/Uploads/Picture/2014-12-29/54a145617d0bf.gif','','20be294542ac7c715d224539201ed244','7120b59151c07c4af301ecfc24c99d2602b0a168',1,1419855201),(115,'local','/Uploads/Picture/2014-12-29/54a1456ed3e73.jpg','','9cb6692a165bfbc9542ddd5da54e7fd9','c8a84e3058f178c711e47c69deb5352def268595',1,1419855214);
/*!40000 ALTER TABLE `mj_picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_rank`
--

DROP TABLE IF EXISTS `mj_rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '上传者id',
  `title` varchar(50) NOT NULL,
  `logo` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `types` tinyint(2) NOT NULL DEFAULT '1' COMMENT '前台是否可申请',
  `rules` varchar(400) DEFAULT '',
  `level` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_rank`
--

LOCK TABLES `mj_rank` WRITE;
/*!40000 ALTER TABLE `mj_rank` DISABLE KEYS */;
INSERT INTO `mj_rank` VALUES (5,1,'LEVEL1',114,1418796869,1,'5,6,7,9',1),(6,1,'LEVEL2',115,1418984599,1,'8,9,12',2);
/*!40000 ALTER TABLE `mj_rank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_rank_auth_rule`
--

DROP TABLE IF EXISTS `mj_rank_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_rank_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `description` varchar(500) DEFAULT '',
  `extend` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_rank_auth_rule`
--

LOCK TABLES `mj_rank_auth_rule` WRITE;
/*!40000 ALTER TABLE `mj_rank_auth_rule` DISABLE KEYS */;
INSERT INTO `mj_rank_auth_rule` VALUES (2,'/weibo/index/index','微博主页',0,'','是否访问',''),(3,'/forum/index/forum','论坛',0,'','是否可以访问',''),(4,'/issue/index/index','主题',0,'','',''),(5,'/usercenter/config/index','是否允许签名',1,'return $_SERVER[\'REQUEST_METHOD\'] == \'GET\'  || $_POST[\'signature\'] == \'\' ? false : true;','保存用户信息，并且有签名',''),(6,'/group/index/create','是否能建立圈子',1,'','',''),(7,'/forum/index/edit','限制提问数量，每天10个问题',1,'','','return $this->checkForumLimit(is_check(), 10);'),(8,'/forum/index/edit','限制提问数量，每天20个问题',1,'','','{\"limit\":10}'),(9,'/forum/index/doEdit','全部板块置顶',1,'','','{\"is_top\":2}'),(10,'/forum/index/doEdit','发布的板块置顶',1,'','','{\"is_top\":1}'),(11,'/forum/index/forum','帖子标题颜色为红色',0,'','','{\"color\":\"red\"}'),(12,'/forum/index/forum','帖子标题颜色为绿色',0,'','','{\"color\":\"green\"}');
/*!40000 ALTER TABLE `mj_rank_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_rank_user`
--

DROP TABLE IF EXISTS `mj_rank_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_rank_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `is_show` tinyint(4) NOT NULL COMMENT '是否显示在昵称右侧（必须有图片才可）',
  `create_time` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_rank_user`
--

LOCK TABLES `mj_rank_user` WRITE;
/*!40000 ALTER TABLE `mj_rank_user` DISABLE KEYS */;
INSERT INTO `mj_rank_user` VALUES (10,1,5,'',1,1419855296,1),(12,61,6,'',1,1419234343,1),(11,61,5,'',1,1419008837,1);
/*!40000 ALTER TABLE `mj_rank_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_seo_rule`
--

DROP TABLE IF EXISTS `mj_seo_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_seo_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `app` varchar(40) NOT NULL,
  `controller` varchar(40) NOT NULL,
  `action` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `seo_title` text NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_seo_rule`
--

LOCK TABLES `mj_seo_rule` WRITE;
/*!40000 ALTER TABLE `mj_seo_rule` DISABLE KEYS */;
INSERT INTO `mj_seo_rule` VALUES (4,'整站标题','','','',1,'','','酷网中国',7),(6,'论坛版块页','forum','index','forum',1,'{$forum.title} ','{$forum.title} ','{$forum.title} —— 酷网中国论坛',2),(7,'微博首页','Weibo','Index','index',1,'微博','微博首页','酷网中国',5),(8,'微博详情页','Weibo','Index','weiboDetail',1,'{$weibo.title|op_t},酷网中国,微博','{$weibo.content|op_t}\r\n','{$weibo.content|op_t}——酷网中国微博',6),(9,'用户中心','usercenter','index','index',1,'{$user_info.nickname|op_t},酷网中国','{$user_info.username|op_t}的个人主页','{$user_info.nickname|op_t}的个人主页',3),(10,'会员页面','people','index','index',1,'会员','会员','会员',4),(11,'论坛帖子详情页','forum','index','detail',1,'{$post.title|op_t},论坛,thinkox','{$post.title|op_t}','{$post.title|op_t} ——酷网中国',1),(12,'商城首页','shop','index','index',1,'商城,积分','积分商城','商城首页——酷网中国',0),(13,'商城商品详情页','shop','index','goodsdetail',1,'{$content.goods_name|op_t},商城','{$content.goods_name|op_t}','{$content.goods_name|op_t}——酷网中国商城',0),(14,'资讯首页','blog','index','index',1,'资讯首页','资讯首页\r\n','资讯——酷网中国',0),(15,'资讯列表页','blog','article','lists',1,'{$category.title|op_t}','{$category.title|op_t}','{$category.title|op_t}',0),(16,'资讯文章页','blog','article','detail',1,'{$info.title|op_t}','{$info.title|op_t}','{$info.title|op_t}——酷网中国',0),(17,'活动首页','event','index','index',1,'活动','活动首页','活动首页——酷网中国',0),(18,'活动详情页','event','index','detail',1,'{$content.title|op_t}','{$content.title|op_t}','{$content.title|op_t}——酷网中国',0),(19,'专辑首页','issue','index','index',1,'专辑','专辑首页','专辑首页——酷网中国',0),(20,'专辑详情页','issue','index','issuecontentdetail',1,'{$content.title|op_t}','{$content.title|op_t}','{$content.title|op_t}——酷网中国',0);
/*!40000 ALTER TABLE `mj_seo_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_shop`
--

DROP TABLE IF EXISTS `mj_shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(25) NOT NULL COMMENT '商品名称',
  `goods_ico` int(11) NOT NULL COMMENT '商品图标',
  `goods_introduct` varchar(100) NOT NULL COMMENT '商品简介',
  `goods_detail` text NOT NULL COMMENT '商品详情',
  `tox_money_need` int(11) NOT NULL COMMENT '需要金币数',
  `goods_num` int(11) NOT NULL COMMENT '商品余量',
  `changetime` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态，-1：删除；0：禁用；1：启用',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `category_id` int(11) NOT NULL,
  `is_new` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否为新品',
  `sell_num` int(11) NOT NULL DEFAULT '0' COMMENT '已出售量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='商品信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_shop`
--

LOCK TABLES `mj_shop` WRITE;
/*!40000 ALTER TABLE `mj_shop` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_shop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_shop_address`
--

DROP TABLE IF EXISTS `mj_shop_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_shop_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `change_time` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `phone` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_shop_address`
--

LOCK TABLES `mj_shop_address` WRITE;
/*!40000 ALTER TABLE `mj_shop_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_shop_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_shop_buy`
--

DROP TABLE IF EXISTS `mj_shop_buy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_shop_buy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `goods_num` int(11) NOT NULL COMMENT '购买数量',
  `status` tinyint(4) NOT NULL COMMENT '状态，-1：未领取；0：申请领取；1：已领取',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `createtime` int(11) NOT NULL COMMENT '购买时间',
  `gettime` int(11) NOT NULL COMMENT '交易结束时间',
  `address_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='购买商品信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_shop_buy`
--

LOCK TABLES `mj_shop_buy` WRITE;
/*!40000 ALTER TABLE `mj_shop_buy` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_shop_buy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_shop_category`
--

DROP TABLE IF EXISTS `mj_shop_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_shop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `pid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_shop_category`
--

LOCK TABLES `mj_shop_category` WRITE;
/*!40000 ALTER TABLE `mj_shop_category` DISABLE KEYS */;
INSERT INTO `mj_shop_category` VALUES (1,'奖品',1403507725,1403507717,1,0,0);
/*!40000 ALTER TABLE `mj_shop_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_shop_config`
--

DROP TABLE IF EXISTS `mj_shop_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_shop_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ename` varchar(25) NOT NULL COMMENT '标识',
  `cname` varchar(25) NOT NULL COMMENT '中文名称',
  `changetime` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商店配置';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_shop_config`
--

LOCK TABLES `mj_shop_config` WRITE;
/*!40000 ALTER TABLE `mj_shop_config` DISABLE KEYS */;
INSERT INTO `mj_shop_config` VALUES (1,'tox_money','金币',1403507688),(2,'min_sell_num','10',1403489181);
/*!40000 ALTER TABLE `mj_shop_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_shop_log`
--

DROP TABLE IF EXISTS `mj_shop_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_shop_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_shop_log`
--

LOCK TABLES `mj_shop_log` WRITE;
/*!40000 ALTER TABLE `mj_shop_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_shop_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_shop_see`
--

DROP TABLE IF EXISTS `mj_shop_see`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_shop_see` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_shop_see`
--

LOCK TABLES `mj_shop_see` WRITE;
/*!40000 ALTER TABLE `mj_shop_see` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_shop_see` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_super_links`
--

DROP TABLE IF EXISTS `mj_super_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_super_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '类别（1：图片，2：普通）',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '站点名称',
  `cover_id` int(10) NOT NULL COMMENT '图片ID',
  `link` char(140) NOT NULL DEFAULT '' COMMENT '链接地址',
  `level` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用，1：正常）',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='友情连接表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_super_links`
--

LOCK TABLES `mj_super_links` WRITE;
/*!40000 ALTER TABLE `mj_super_links` DISABLE KEYS */;
INSERT INTO `mj_super_links` VALUES (5,2,'想天科技',0,'http://www.ourstu.com',0,1,1407156786),(6,2,'Onethink',0,'http://www.onethink.cn',0,1,1407156813),(7,1,'ThinkOX',92,'http://tox.ourstu.com',0,0,1407156830);
/*!40000 ALTER TABLE `mj_super_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_support`
--

DROP TABLE IF EXISTS `mj_support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appname` varchar(20) NOT NULL COMMENT '应用名',
  `row` int(11) NOT NULL COMMENT '应用标识',
  `uid` int(11) NOT NULL COMMENT '用户',
  `create_time` int(11) NOT NULL COMMENT '发布时间',
  `table` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='支持的表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_support`
--

LOCK TABLES `mj_support` WRITE;
/*!40000 ALTER TABLE `mj_support` DISABLE KEYS */;
INSERT INTO `mj_support` VALUES (52,'Forum',1,60,1417674606,'post');
/*!40000 ALTER TABLE `mj_support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_sync_login`
--

DROP TABLE IF EXISTS `mj_sync_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_sync_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type_uid` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `oauth_token` varchar(255) NOT NULL,
  `oauth_token_secret` varchar(255) NOT NULL,
  `is_sync` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_sync_login`
--

LOCK TABLES `mj_sync_login` WRITE;
/*!40000 ALTER TABLE `mj_sync_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_sync_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_talk`
--

DROP TABLE IF EXISTS `mj_talk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_talk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` int(11) NOT NULL,
  `uids` varchar(100) NOT NULL,
  `appname` varchar(30) NOT NULL,
  `apptype` varchar(30) NOT NULL,
  `source_id` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `source_title` varchar(100) NOT NULL,
  `source_content` text NOT NULL,
  `source_url` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `message_id` int(11) NOT NULL,
  `other_uid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=164 DEFAULT CHARSET=utf8 COMMENT='会话表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_talk`
--

LOCK TABLES `mj_talk` WRITE;
/*!40000 ALTER TABLE `mj_talk` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_talk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_talk_message`
--

DROP TABLE IF EXISTS `mj_talk_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_talk_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `talk_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=278 DEFAULT CHARSET=utf8 COMMENT='聊天消息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_talk_message`
--

LOCK TABLES `mj_talk_message` WRITE;
/*!40000 ALTER TABLE `mj_talk_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_talk_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_talk_message_push`
--

DROP TABLE IF EXISTS `mj_talk_message_push`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_talk_message_push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `source_id` int(11) NOT NULL COMMENT '来源消息id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(4) NOT NULL,
  `talk_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=gbk COMMENT='状态，0为未提示，1为未点击，-1为已点击';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_talk_message_push`
--

LOCK TABLES `mj_talk_message_push` WRITE;
/*!40000 ALTER TABLE `mj_talk_message_push` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_talk_message_push` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_talk_push`
--

DROP TABLE IF EXISTS `mj_talk_push`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_talk_push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '接收推送的用户id',
  `source_id` int(11) NOT NULL COMMENT '来源id',
  `create_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态，0为未提示，1为未点击，-1为已点击',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COMMENT='对话推送表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_talk_push`
--

LOCK TABLES `mj_talk_push` WRITE;
/*!40000 ALTER TABLE `mj_talk_push` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_talk_push` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_ucenter_admin`
--

DROP TABLE IF EXISTS `mj_ucenter_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_ucenter_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员用户ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '管理员状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_ucenter_admin`
--

LOCK TABLES `mj_ucenter_admin` WRITE;
/*!40000 ALTER TABLE `mj_ucenter_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_ucenter_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_ucenter_member`
--

DROP TABLE IF EXISTS `mj_ucenter_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_ucenter_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_ucenter_member`
--

LOCK TABLES `mj_ucenter_member` WRITE;
/*!40000 ALTER TABLE `mj_ucenter_member` DISABLE KEYS */;
INSERT INTO `mj_ucenter_member` VALUES (1,'admin','b44a08061eb18193289c615a0fd7708e','apacal@126.com','',1417659262,0,1419910759,2130706433,1417659262,1),(58,'mark','1432780a73ac9754077d8c50c2ca27cb','mark@mengjukeji.com','',1417659591,0,0,0,1417659591,1),(59,'mengjukeji','4f5e386f287c91333482ddb27a180556','mengjukeji@mengjukeji.com','',1417673956,0,0,0,1417673956,1),(60,'zhong','1432780a73ac9754077d8c50c2ca27cb','zhong@qq.com','',1417674095,0,1417676544,0,1417674095,1),(61,'apacal','b44a08061eb18193289c615a0fd7708e','apacal@qq.com','',1418795174,2130706433,1419873215,2130706433,1418795174,1),(62,'richard','b44a08061eb18193289c615a0fd7708e','apacal@163.com','',1419347620,2130706433,1419873267,2130706433,1419347620,1),(63,'rich','b44a08061eb18193289c615a0fd7708e','apacalzqz@gmail.com','',1419347801,2130706433,1419347801,2130706433,1419347801,1);
/*!40000 ALTER TABLE `mj_ucenter_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_ucenter_setting`
--

DROP TABLE IF EXISTS `mj_ucenter_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_ucenter_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '设置ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型（1-用户配置）',
  `value` text NOT NULL COMMENT '配置数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_ucenter_setting`
--

LOCK TABLES `mj_ucenter_setting` WRITE;
/*!40000 ALTER TABLE `mj_ucenter_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_ucenter_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_url`
--

DROP TABLE IF EXISTS `mj_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接唯一标识',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `short` char(100) NOT NULL DEFAULT '' COMMENT '短网址',
  `status` tinyint(2) NOT NULL DEFAULT '2' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='链接表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_url`
--

LOCK TABLES `mj_url` WRITE;
/*!40000 ALTER TABLE `mj_url` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_url` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_user_token`
--

DROP TABLE IF EXISTS `mj_user_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_user_token`
--

LOCK TABLES `mj_user_token` WRITE;
/*!40000 ALTER TABLE `mj_user_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_user_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_wallet`
--

DROP TABLE IF EXISTS `mj_wallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_wallet` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `rich` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_wallet_id` (`uid`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_wallet`
--

LOCK TABLES `mj_wallet` WRITE;
/*!40000 ALTER TABLE `mj_wallet` DISABLE KEYS */;
INSERT INTO `mj_wallet` VALUES (1,1,10,1),(2,62,10,1),(3,63,10,1);
/*!40000 ALTER TABLE `mj_wallet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_wallet_order`
--

DROP TABLE IF EXISTS `mj_wallet_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_wallet_order` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `to_uid` bigint(20) NOT NULL,
  `from_uid` bigint(20) unsigned NOT NULL,
  `money` bigint(20) unsigned NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `order_type` char(80) NOT NULL DEFAULT '',
  `description` varchar(500) NOT NULL DEFAULT '',
  `extend` varchar(1000) NOT NULL DEFAULT '',
  `create_time` int(11) DEFAULT NULL,
  `complete_time` int(11) DEFAULT NULL,
  `ali_pay_no` bigint(20) DEFAULT NULL,
  `ali_pay_extend` varchar(1000) DEFAULT '',
  `pay_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_wallet_order`
--

LOCK TABLES `mj_wallet_order` WRITE;
/*!40000 ALTER TABLE `mj_wallet_order` DISABLE KEYS */;
INSERT INTO `mj_wallet_order` VALUES (1,1,0,1,0,'deposit','充值1元红包','{\"id\":\"11\",\"name\":\"\\uff11\\u5143\",\"money\":\"1\",\"description\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"shop_url\":\"http:\\/\\/kuwang.apacal.cn\\/\",\"status\":\"1\"}',1419327658,NULL,0,'',NULL),(2,1,0,1,0,'deposit','充值1元红包','{\"id\":\"11\",\"name\":\"\\uff11\\u5143\",\"money\":\"1\",\"description\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"shop_url\":\"http:\\/\\/kuwang.apacal.cn\\/\",\"status\":\"1\"}',1419328294,NULL,0,'',NULL),(3,1,0,1,0,'deposit','充值1元红包','{\"id\":\"11\",\"name\":\"\\uff11\\u5143\",\"money\":\"1\",\"description\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"shop_url\":\"http:\\/\\/kuwang.apacal.cn\\/\",\"status\":\"1\"}',1419328964,NULL,0,'',NULL),(4,1,0,1,0,'deposit','充值1元红包','{\"id\":\"11\",\"name\":\"\\uff11\\u5143\",\"money\":\"1\",\"description\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"shop_url\":\"http:\\/\\/kuwang.apacal.cn\\/\",\"status\":\"1\"}',1419329267,NULL,0,'',NULL),(5,1,0,1,0,'deposit','充值1元红包','{\"id\":\"11\",\"name\":\"\\uff11\\u5143\",\"money\":\"1\",\"description\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"shop_url\":\"http:\\/\\/kuwang.apacal.cn\\/\",\"status\":\"1\"}',1419329434,NULL,0,'',NULL),(6,1,0,1,0,'deposit','充值1元红包','{\"id\":\"11\",\"name\":\"\\uff11\\u5143\",\"money\":\"1\",\"description\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"shop_url\":\"http:\\/\\/kuwang.apacal.cn\\/\",\"status\":\"1\"}',1419329546,NULL,0,'',NULL),(7,1,0,1,2,'deposit','充值1元红包','{\"id\":\"11\",\"name\":\"\\uff11\\u5143\",\"money\":\"1\",\"description\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"shop_url\":\"http:\\/\\/kuwang.apacal.cn\\/\",\"status\":\"1\"}',1419329609,1419340835,0,'{\"body\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"buyer_email\":\"apacal@qq.com\",\"buyer_id\":\"2088802923380375\",\"exterface\":\"create_direct_pay_by_user\",\"is_success\":\"T\",\"notify_id\":\"RqPnCoPT3K9%2Fvwbh3InQ%2F0fjEEsjOtWxlZF1Z0QW2RMFlybj0mdJe6Eg%2FOj9RqzYZMeR\",\"notify_time\":\"2014-12-23 20:27:40\",\"notify_type\":\"trade_status_sync\",\"out_trade_no\":\"7\",\"payment_type\":\"1\",\"seller_email\":\"shasnfjd2013@qq.com\",\"seller_id\":\"2088701997838426\",\"subject\":\"\\uff11\\u5143\",\"total_fee\":\"0.01\",\"trade_no\":\"2014122312180137\",\"trade_status\":\"TRADE_SUCCESS\",\"sign\":\"cc6155fe55a240dcb6a9f3cd5fb37a2a\",\"sign_type\":\"MD5\"}',1419340835),(8,1,0,1,2,'deposit','充值1元红包','{\"id\":\"11\",\"name\":\"\\uff11\\u5143\",\"money\":\"1\",\"description\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"shop_url\":\"http:\\/\\/kuwang.apacal.cn\\/\",\"status\":\"1\"}',1419341308,1419341361,0,'{\"body\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"buyer_email\":\"apacal@qq.com\",\"buyer_id\":\"2088802923380375\",\"exterface\":\"create_direct_pay_by_user\",\"is_success\":\"T\",\"notify_id\":\"RqPnCoPT3K9%2Fvwbh3InQ%2F0fkOCLCcSGWjjHWorX5SRKNfXgSLUYX8urBOTa2kPpgaB2y\",\"notify_time\":\"2014-12-23 21:29:21\",\"notify_type\":\"trade_status_sync\",\"out_trade_no\":\"8\",\"payment_type\":\"1\",\"seller_email\":\"shasnfjd2013@qq.com\",\"seller_id\":\"2088701997838426\",\"subject\":\"\\uff11\\u5143\",\"total_fee\":\"0.01\",\"trade_no\":\"2014122312274537\",\"trade_status\":\"TRADE_SUCCESS\",\"sign\":\"5e0296da7bee09b9c3deae833aa3a307\",\"sign_type\":\"MD5\"}',1419341361),(9,1,0,1,2,'deposit','充值1元红包','{\"id\":\"11\",\"name\":\"\\uff11\\u5143\",\"money\":\"1\",\"description\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"shop_url\":\"http:\\/\\/kuwang.apacal.cn\\/\",\"status\":\"1\"}',1419344318,1419344393,2014122312346437,'{\"body\":\"\\u5145\\u503c1\\u5143\\u7ea2\\u5305\",\"buyer_email\":\"apacal@qq.com\",\"buyer_id\":\"2088802923380375\",\"exterface\":\"create_direct_pay_by_user\",\"is_success\":\"T\",\"notify_id\":\"RqPnCoPT3K9%2Fvwbh3InQ%2F0fkPfXpWQ0BPHESLU%2BbqZmJ52HNWEzXTxToLgNpoPkxDk0c\",\"notify_time\":\"2014-12-23 22:19:53\",\"notify_type\":\"trade_status_sync\",\"out_trade_no\":\"9\",\"payment_type\":\"1\",\"seller_email\":\"shasnfjd2013@qq.com\",\"seller_id\":\"2088701997838426\",\"subject\":\"\\uff11\\u5143\",\"total_fee\":\"0.01\",\"trade_no\":\"2014122312346437\",\"trade_status\":\"TRADE_SUCCESS\",\"sign\":\"5a2625c42ce76e88dcb8e71ac53b0c18\",\"sign_type\":\"MD5\"}',1419344393);
/*!40000 ALTER TABLE `mj_wallet_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_weibo`
--

DROP TABLE IF EXISTS `mj_weibo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_weibo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `comment_count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_top` tinyint(4) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `repost_count` int(11) NOT NULL,
  `from` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_weibo`
--

LOCK TABLES `mj_weibo` WRITE;
/*!40000 ALTER TABLE `mj_weibo` DISABLE KEYS */;
INSERT INTO `mj_weibo` VALUES (1,1,'admin发布的测试帖子。',1417674250,0,1,0,'feed','a:1:{s:10:\"attach_ids\";s:0:\"\";}',0,''),(2,60,'我发表了一个新的帖子【zhong发布的第一个帖子】：http://localhost/thinkox/index.php?s=/forum/index/detail/id/1.html',1417674601,0,1,0,'feed','a:0:{}',0,''),(3,60,'我发布了一个新的活动【zhong发布的第一个活动】：http://localhost/thinkox/index.php?s=/event/index/detail/id/9.html',1417674897,0,1,0,'feed','s:0:\"\";',0,''),(4,60,'我创建了一个新的群组【zhong创建的群组】：http://localhost/thinkox/index.php?s=/group/index/group/id/1.html',1417674999,0,1,0,'feed','s:0:\"\";',0,''),(5,60,'我修改了群组【zhong创建的群组】：http://localhost/thinkox/index.php?s=/group/index/group/id/1.html',1417675027,0,1,0,'feed','s:0:\"\";',0,''),(6,1,'我发表了一个新的帖子【test】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/2.html',1418609140,0,1,0,'feed','a:0:{}',0,''),(7,1,'我发表了一个新的帖子【test】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/3.html',1418610047,0,1,0,'feed','a:0:{}',0,''),(8,1,'我发表了一个新的帖子【ffffffffffffffff】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/4.html',1418610540,0,0,0,'feed','a:0:{}',0,''),(9,1,'我发表了一个新的帖子【tttttttttt】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/5.html',1418637659,0,1,0,'feed','a:0:{}',0,''),(10,1,'我发表了一个新的帖子【test】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/14.html',1418721786,0,1,0,'feed','a:0:{}',0,''),(11,1,'我发表了一个新的帖子【testtagtag】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/15.html',1418721925,0,1,0,'feed','a:0:{}',0,''),(12,1,'我发表了一个新的帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418721990,0,1,0,'feed','a:0:{}',0,''),(13,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418724876,0,1,0,'feed','a:0:{}',0,''),(14,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418725053,0,1,0,'feed','a:0:{}',0,''),(15,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418726697,0,1,0,'feed','a:0:{}',0,''),(16,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418726744,0,1,0,'feed','a:0:{}',0,''),(17,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418726754,0,1,0,'feed','a:0:{}',0,''),(18,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418726785,0,1,0,'feed','a:0:{}',0,''),(19,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418726925,0,1,0,'feed','a:0:{}',0,''),(20,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418726941,0,1,0,'feed','a:0:{}',0,''),(21,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418727113,0,1,0,'feed','a:0:{}',0,''),(22,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418727123,0,1,0,'feed','a:0:{}',0,''),(23,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418727130,0,1,0,'feed','a:0:{}',0,''),(24,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418727256,0,1,0,'feed','a:0:{}',0,''),(25,1,'我更新了帖子【text】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/16.html',1418735649,0,1,0,'feed','a:0:{}',0,''),(26,1,'我更新了帖子【test】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/6.html',1418742497,0,1,0,'feed','a:0:{}',0,''),(27,1,'我更新了帖子【zhong发布的第一个帖子】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/1.html',1418745286,0,1,0,'feed','a:0:{}',0,''),(28,1,'我更新了帖子【zhong发布的第一个帖子】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/1.html',1418745380,0,1,0,'feed','a:0:{}',0,''),(29,1,'我更新了帖子【zhong发布的第一个帖子】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/1.html',1418745399,0,1,0,'feed','a:0:{}',0,''),(30,1,'我更新了帖子【zhong发布的第一个帖子】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/1.html',1418745617,0,1,0,'feed','a:0:{}',0,''),(31,1,'我更新了帖子【zhong发布的第一个帖子】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/1.html',1418745632,0,1,0,'feed','a:0:{}',0,''),(32,1,'我更新了帖子【zhong发布的第一个帖子】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/1.html',1418745641,0,1,0,'feed','a:0:{}',0,''),(33,1,'我发表了一个新的帖子【Hello】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/17.html',1418787711,0,1,0,'feed','a:0:{}',0,''),(34,1,'我发表了一个新的帖子【NGINX】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/18.html',1418787742,0,1,0,'feed','a:0:{}',0,''),(35,1,'我发表了一个新的帖子【TEST1】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/19.html',1418788256,0,1,0,'feed','a:0:{}',0,''),(36,1,'管理员通过了@admin 的头衔申请：[高手]，申请理由：need',1418796919,0,1,0,'feed','a:0:{}',0,''),(37,1,'我发表了一个新的帖子【好地方】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/20.html',1418892855,0,1,0,'feed','a:0:{}',0,''),(38,1,'我更新了帖子【好地方】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/20.html',1418892943,0,1,0,'feed','a:0:{}',0,''),(39,1,'我更新了帖子【好地方】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/20.html',1418893135,0,1,0,'feed','a:0:{}',0,''),(40,1,'我更新了帖子【好地方】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/20.html',1418893274,0,1,0,'feed','a:0:{}',0,''),(41,1,'我更新了帖子【TEST1】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/19.html',1418894369,0,1,0,'feed','a:0:{}',0,''),(42,61,'我发表了一个新的帖子【hhh】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/21.html',1418894823,0,1,0,'feed','a:0:{}',0,''),(43,61,'我更新了帖子【hhh】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/21.html',1418894839,0,1,0,'feed','a:0:{}',0,''),(44,1,'管理员给@admin 颁发了新的头衔：[牛逼]，颁发理由：',1418984613,0,1,0,'feed','a:0:{}',0,''),(45,1,'管理员给@apacal 颁发了新的头衔：[高手]，颁发理由：',1419000482,0,1,0,'feed','a:0:{}',0,''),(46,1,'管理员给@apacal 颁发了新的头衔：[牛逼]，颁发理由：',1419000489,0,1,0,'feed','a:0:{}',0,''),(47,1,'管理员给@admin 颁发了新的头衔：[高手]，颁发理由：',1419007267,0,1,0,'feed','a:0:{}',0,''),(48,1,'管理员给@apacal 颁发了新的头衔：[高手]，颁发理由：',1419008837,0,1,0,'feed','a:0:{}',0,''),(49,1,'管理员给@apacal 颁发了新的头衔：[LEVEL2]，颁发理由：',1419234343,0,1,0,'feed','a:0:{}',0,''),(50,1,'我发表了一个新的帖子【fdfd】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/22.html',1419236703,0,1,0,'feed','a:0:{}',0,''),(51,1,'我发表了一个新的帖子【ffffffffffffffff】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/23.html',1419236716,0,1,0,'feed','a:0:{}',0,''),(52,1,'我发表了一个新的帖子【fffffffffffff】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/24.html',1419238711,0,1,0,'feed','a:0:{}',0,''),(53,63,'我注册了，领取了10元钱包',1419347801,0,1,0,'feed','a:0:{}',0,''),(54,1,'我发表了一个新的帖子【tesdty32】：http://www.kuwang.com/index.php?s=/forum/index/detail/id/25.html',1419855648,0,1,0,'feed','a:0:{}',0,''),(55,1,'我更新了帖子【TEST1】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/19.html',1419871588,0,1,0,'feed','a:0:{}',0,''),(56,1,'我更新了帖子【TEST1】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/19.html',1419872894,0,1,0,'feed','a:0:{}',0,''),(57,1,'我更新了帖子【TEST1】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/19.html',1419872914,0,1,0,'feed','a:0:{}',0,''),(58,1,'我更新了帖子【TEST1】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/19.html',1419872944,0,1,0,'feed','a:0:{}',0,''),(59,1,'我更新了帖子【tesdty32】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/25.html',1419873166,0,1,0,'feed','a:0:{}',0,''),(60,1,'我更新了帖子【TEST1】：http://kuwang.apacal.cn/index.php?s=/forum/index/detail/id/19.html',1419873183,0,1,0,'feed','a:0:{}',0,'');
/*!40000 ALTER TABLE `mj_weibo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_weibo_comment`
--

DROP TABLE IF EXISTS `mj_weibo_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_weibo_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `weibo_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `to_comment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_weibo_comment`
--

LOCK TABLES `mj_weibo_comment` WRITE;
/*!40000 ALTER TABLE `mj_weibo_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_weibo_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_weibo_top`
--

DROP TABLE IF EXISTS `mj_weibo_top`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_weibo_top` (
  `weibo_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`weibo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='置顶微博表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_weibo_top`
--

LOCK TABLES `mj_weibo_top` WRITE;
/*!40000 ALTER TABLE `mj_weibo_top` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_weibo_top` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-30 13:42:09
