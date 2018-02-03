/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : imooc_app_singwa

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-02-03 17:07:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ent_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `ent_admin_user`;
CREATE TABLE `ent_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL COMMENT '密码',
  `last_login_ip` varchar(30) DEFAULT NULL,
  `last_login_time` int(10) unsigned DEFAULT NULL,
  `listorder` int(8) unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_time` int(10) unsigned DEFAULT NULL,
  `update_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE COMMENT '用户名',
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='后台用户表';

-- ----------------------------
-- Records of ent_admin_user
-- ----------------------------
INSERT INTO `ent_admin_user` VALUES ('4', 'admin', 'c53d0bf8dcdbc8fbf430feb1230742d5', null, null, null, '1', '1517634727', '1517634727');
INSERT INTO `ent_admin_user` VALUES ('5', 'kaiend', 'b02aa4087a47ea270befd2fd6d2f17df', '127.0.0.1', '1517642678', null, '1', '1517634949', '1517642678');

-- ----------------------------
-- Table structure for ent_news
-- ----------------------------
DROP TABLE IF EXISTS `ent_news`;
CREATE TABLE `ent_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `smail_title` varchar(20) DEFAULT '' COMMENT '二级标题',
  `catid` int(8) unsigned DEFAULT '0' COMMENT '栏目id',
  `image` varchar(255) DEFAULT '' COMMENT '图片',
  `content` text COMMENT '内容',
  `description` varchar(200) DEFAULT '',
  `is_position` tinyint(1) unsigned DEFAULT '0' COMMENT '推荐',
  `is_head_figure` tinyint(1) unsigned DEFAULT '0',
  `is_allowcomments` tinyint(1) unsigned DEFAULT '0',
  `listorder` varchar(200) DEFAULT NULL,
  `source_type` tinyint(1) unsigned DEFAULT '0' COMMENT '新闻来源',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `title` (`title`) USING BTREE COMMENT 'title',
  KEY `create_time` (`create_time`) USING BTREE COMMENT 'create_time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ent_news
-- ----------------------------
