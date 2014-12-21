DROP TABLE IF EXISTS `ablg_comment`;
CREATE TABLE `ablg_comment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '父结点',
  `origin_id` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '来源文章或者其它id',
  `cate_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目id',
  `author` varchar(30) NOT NULL DEFAULT '' COMMENT '作者',
  `author_id` int(10) NULL COMMENT '作者ID',
  `ip` varchar(20) NOT NULL DEFAULT '' COMMENT 'ip',
  `content` text NOT NULL COMMENT '内容',
  `createtime` int(10) unsigned NOT NULL COMMENT '发布时间',
  `agree` int(10) NOT NULL,
  `disagree` int(10) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `updatetime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ablg_term_relationships`;
CREATE TABLE `ablg_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ablg_term_taxonomy`;
CREATE TABLE `ablg_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ablg_terms`;
CREATE TABLE `ablg_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

