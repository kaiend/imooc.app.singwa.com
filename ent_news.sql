/*
Navicat MySQL Data Transfer

Source Server         : 39.106.45.64
Source Server Version : 50636
Source Host           : 39.106.45.64:3306
Source Database       : qulvxing

Target Server Type    : MYSQL
Target Server Version : 50636
File Encoding         : 65001

Date: 2018-02-03 17:00:57
*/

SET FOREIGN_KEY_CHECKS=0;

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
