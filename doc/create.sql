DROP TABLE IF EXISTS `ablg_comment`;
CREATE TABLE `ablg_comment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '父结点',
  `oid` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '来源文章或者其它id',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目id',
  `author` varchar(30) NOT NULL DEFAULT '' COMMENT '作者',
  `ip` varchar(20) NOT NULL DEFAULT '' COMMENT 'ip',
  `content` text NOT NULL COMMENT '内容',
  `createtime` int(10) unsigned NOT NULL COMMENT '发布时间',
  `agree` int(10) NOT NULL,
  `disagree` int(10) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `updatetime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8