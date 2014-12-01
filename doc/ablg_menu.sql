DROP TABLE IF EXISTS `ablg_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ablg_menu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父结点',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'menu名称',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '描述',
  `mid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `function` varchar(50) NOT NULL DEFAULT '' COMMENT '请求方法',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '请求url',
  `icon` varchar(100) NOT NULL DEFAULT 'icon-list' COMMENT 'icon',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序值',
  `status` int(1) NOT NULL DEFAULT '1',
  `createtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `adminid` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='menu';

