DROP TABLE IF EXISTS `ablg_auth_rule`;
CREATE TABLE `ablg_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rule` char(50) NOT NULL DEFAULT '',
  `name` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=Innodb DEFAULT CHARSET=utf8;



-- ----------------------------
-- ablg_auth_group 用户组表，
-- id：主键， title:用户组中文名称， rules：用户组拥有的规则id， 多个规则用“,”隔开
-- ----------------------------
 DROP TABLE IF EXISTS `ablg_auth_group`;
CREATE TABLE `ablg_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL DEFAULT '',
  `rules` varchar(500) NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARSET=utf8;
-- ----------------------------
-- ablg_auth_group_access 用户组明细表
-- uid:用户id，group_id：用户组id
-- ----------------------------
DROP TABLE IF EXISTS `ablg_auth_group_access`;
CREATE TABLE `ablg_auth_group_access` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint(21) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_2` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`),
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARSET=utf8;