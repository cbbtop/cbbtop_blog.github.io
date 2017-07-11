/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cbb

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-11 15:07:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for about_blog
-- ----------------------------
DROP TABLE IF EXISTS `about_blog`;
CREATE TABLE `about_blog` (
  `blog_id` mediumint(8) NOT NULL COMMENT '用户ID',
  `blog_keyword` varchar(255) NOT NULL COMMENT '博客关键字',
  `blog_description` varchar(255) NOT NULL COMMENT '博客描述',
  `blog_name` varchar(36) NOT NULL COMMENT '博客名称',
  `blog_title` varchar(128) NOT NULL COMMENT '博客标题',
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of about_blog
-- ----------------------------

-- ----------------------------
-- Table structure for ad
-- ----------------------------
DROP TABLE IF EXISTS `ad`;
CREATE TABLE `ad` (
  `ad_id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `position_id` smallint(5) NOT NULL COMMENT '0,站外广告;从1开始代表的是该广告所处的广告位,同表ad_postition中的字段position_id的值',
  `media_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '广告类型,0图片;1flash;2代码3文字',
  `ad_name` varchar(60) NOT NULL COMMENT '该条广告记录的广告名称',
  `ad_link` varchar(255) NOT NULL COMMENT '广告链接地址',
  `ad_code` text NOT NULL COMMENT '广告链接的表现,文字广告就是文字或图片和flash就是它们的地址',
  `start_time` int(13) NOT NULL DEFAULT '0' COMMENT '广告开始时间',
  `end_time` int(13) NOT NULL DEFAULT '0' COMMENT '广告结束时间',
  `link_man` varchar(60) NOT NULL COMMENT '广告联系人',
  `link_email` varchar(60) NOT NULL COMMENT '广告联系人的邮箱',
  `link_phone` varchar(60) NOT NULL COMMENT '广告联系人得电话',
  `click_count` mediumint(8) NOT NULL DEFAULT '0' COMMENT '广告点击次数',
  `enabled` tinyint(3) NOT NULL DEFAULT '1' COMMENT '该广告是否关闭;1开启; 0关闭; 关闭后广告将不再有效',
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ad
-- ----------------------------

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(60) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `last_login` int(11) DEFAULT '0' COMMENT '最后登陆时间',
  `last_ip` varchar(15) DEFAULT '0' COMMENT '最后登陆ip',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `article_id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '文章自增ID号',
  `article_name` varchar(128) NOT NULL COMMENT '文章名称',
  `article_time` int(13) NOT NULL COMMENT '发布时间',
  `article_click` int(10) NOT NULL COMMENT '查看人数',
  `type_id` mediumint(8) NOT NULL COMMENT '所属分类',
  `user_name` varchar(10) NOT NULL COMMENT '作者',
  `article_type` int(13) NOT NULL DEFAULT '1' COMMENT '文章的模式:0为私有，1为公开',
  `article_content` text NOT NULL COMMENT '文章内容',
  `article_up` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否置顶:0为否，1为是',
  `article_photo` varchar(255) NOT NULL,
  `last_update` int(6) DEFAULT NULL,
  `article_des` varchar(255) NOT NULL COMMENT '文章描述',
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('7', 'javaasadasdas', '1491658951', '0', '9', 'wqe', '1', 'addadaddd', '1', '2017-04-0858891727.jpg', '0', 'ewqewqeeeeeeeeeeeeeeeeeeeeeeeeeee', 'php');
INSERT INTO `article` VALUES ('8', 'java123123', '1491659009', '0', '9', 'sadasd', '1', 'addda', '1', '2017-04-081818342435.jpg', '0', 'sadasdasd', 'php');

-- ----------------------------
-- Table structure for article_type
-- ----------------------------
DROP TABLE IF EXISTS `article_type`;
CREATE TABLE `article_type` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '文章自增ID',
  `user_id` mediumint(8) NOT NULL COMMENT '该分类所属用户',
  `name` varchar(60) NOT NULL COMMENT '分类名称',
  `pid` int(60) DEFAULT NULL COMMENT '父类id',
  `path` varchar(255) NOT NULL DEFAULT '0,' COMMENT '分类路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_type
-- ----------------------------
INSERT INTO `article_type` VALUES ('4', '0', '后端', '0', '0,');
INSERT INTO `article_type` VALUES ('6', '0', '数据库', '0', '0,');
INSERT INTO `article_type` VALUES ('5', '0', '前端', '0', '0,');
INSERT INTO `article_type` VALUES ('8', '0', 'PHP', '4', '0,4,');
INSERT INTO `article_type` VALUES ('127', '0', 'memcached', '6', '0,6,');
INSERT INTO `article_type` VALUES ('10', '0', 'Linux', '4', '0,4,');
INSERT INTO `article_type` VALUES ('126', '0', 'css', '5', '0,5,');
INSERT INTO `article_type` VALUES ('128', '0', 'mysql', '6', '0,6,');
INSERT INTO `article_type` VALUES ('129', '0', 'redis', '6', '0,6,');
INSERT INTO `article_type` VALUES ('130', '0', 'composer', '4', '0,4,');
INSERT INTO `article_type` VALUES ('131', '0', 'js', '5', '0,5,');
INSERT INTO `article_type` VALUES ('132', '0', 'jq', '5', '0,5,');

-- ----------------------------
-- Table structure for friendly_link
-- ----------------------------
DROP TABLE IF EXISTS `friendly_link`;
CREATE TABLE `friendly_link` (
  `link_id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '友情链接自增ID',
  `link_name` varchar(60) NOT NULL COMMENT '友情链接名称',
  `link_url` varchar(255) NOT NULL COMMENT '链接地址',
  `link_logo` varchar(255) DEFAULT NULL COMMENT 'LOGO图片',
  `order` tinyint(3) NOT NULL COMMENT '在页面显示的顺序',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friendly_link
-- ----------------------------
INSERT INTO `friendly_link` VALUES ('1', 'mk', 'va86.com', 'q.jpg', '1');
INSERT INTO `friendly_link` VALUES ('3', 'luo', 'luo.com', '3.jpg', '3');

-- ----------------------------
-- Table structure for stay_message
-- ----------------------------
DROP TABLE IF EXISTS `stay_message`;
CREATE TABLE `stay_message` (
  `stay_id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '留言表自增ID',
  `user_id` mediumint(8) NOT NULL COMMENT '用户ID',
  `article_id` mediumint(8) NOT NULL COMMENT '留言文章ID',
  `message_content` varchar(255) NOT NULL COMMENT '留言内容',
  `stay_user_ip` varchar(15) NOT NULL COMMENT '留言用户的IP地址',
  `message_stay_time` int(13) NOT NULL COMMENT '留言时间',
  `reply` varchar(255) NOT NULL DEFAULT '1' COMMENT '留言回复',
  `reply_time` int(13) NOT NULL COMMENT '回复时间',
  `user_name` varchar(10) NOT NULL COMMENT '用户名',
  PRIMARY KEY (`stay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stay_message
-- ----------------------------
INSERT INTO `stay_message` VALUES ('7', '12', '6', 'sdad', '', '1491659096', '1', '0', 'adsd');
INSERT INTO `stay_message` VALUES ('8', '12', '7', 'sads', '', '1491659150', '1', '0', 'das');
INSERT INTO `stay_message` VALUES ('9', '12', '6', '尼玛', '', '1491751419', '1', '0', '宝宝');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` varchar(32) NOT NULL COMMENT '用户名',
  `user_pwd` varchar(32) NOT NULL COMMENT '用户密码',
  `user_phone` int(12) NOT NULL COMMENT '用户手机号码',
  `user_sex` varchar(6) NOT NULL COMMENT '用户性别',
  `user_email` varchar(64) NOT NULL COMMENT '用户EMAIL地址',
  `user_last_login_ip` varchar(15) NOT NULL COMMENT '用户上一次登录IP地址',
  `user_description` varchar(255) NOT NULL COMMENT '自我描述',
  `user_image_url` varchar(255) NOT NULL COMMENT '用户头像存储路径',
  `user_register_time` int(13) NOT NULL COMMENT '用户注册时间',
  `user_lock` tinyint(3) NOT NULL COMMENT '是否锁定，0为不锁定，1为锁定',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for user_comment
-- ----------------------------
DROP TABLE IF EXISTS `user_comment`;
CREATE TABLE `user_comment` (
  `comment_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '评论自增ID号',
  `user_id` mediumint(8) DEFAULT NULL COMMENT '收到评论的用户ID',
  `type_id` tinyint(3) NOT NULL COMMENT '评论分类ID',
  `commit_id` mediumint(8) NOT NULL COMMENT '评论内容的ID',
  `commit_content` varchar(255) NOT NULL COMMENT '评论内容',
  `commit_user_name` varchar(8) NOT NULL COMMENT '评论者名字',
  `commit_time` int(13) NOT NULL COMMENT '评论时间',
  `commit_ip` varchar(15) NOT NULL COMMENT '评论时的IP地址',
  `commit_to` varchar(255) DEFAULT NULL COMMENT '评论回复',
  `commit_totime` int(11) DEFAULT NULL COMMENT '回复评论时间',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_comment
-- ----------------------------
INSERT INTO `user_comment` VALUES ('1', '1', '4', '1', 'sadsadasd', '1', '12', '1', '1', '1');
INSERT INTO `user_comment` VALUES ('2', null, '4', '1', 'ddd', 'dd', '1489589082', '', null, null);
INSERT INTO `user_comment` VALUES ('3', null, '4', '1', 'ddds', 'dds', '1489589339', '', null, null);
INSERT INTO `user_comment` VALUES ('4', null, '4', '1', 'ddds', 'ddsddd', '1489589426', '', null, null);
INSERT INTO `user_comment` VALUES ('5', null, '4', '1', 'dddsd', 'ddsdddd', '1489589463', '', null, null);
INSERT INTO `user_comment` VALUES ('6', null, '4', '1', 'dsadasd', 'dasdsad', '1489589496', '', null, null);
INSERT INTO `user_comment` VALUES ('7', null, '4', '1', 'dsasad', 'dasdas', '1489589602', '', null, null);
INSERT INTO `user_comment` VALUES ('8', null, '0', '1', '撒的', 'das', '1489589748', '', null, null);
INSERT INTO `user_comment` VALUES ('9', null, '4', '1', '的撒大大', 'ddd', '1489589792', '', null, null);
INSERT INTO `user_comment` VALUES ('10', null, '4', '1', 'sadasdas', 'dadas', '1489589832', '', null, null);
INSERT INTO `user_comment` VALUES ('11', null, '4', '1', 'sad', 'dsad', '1489626310', '', null, null);
INSERT INTO `user_comment` VALUES ('12', null, '4', '1', '122', '12', '1489626951', '', null, null);
INSERT INTO `user_comment` VALUES ('13', null, '4', '1', 'sadsa', 'dasdsadd', '1489626997', '', null, null);
INSERT INTO `user_comment` VALUES ('14', null, '4', '1', 'ASDD', 'SDAD', '1489627235', '', null, null);
INSERT INTO `user_comment` VALUES ('15', null, '4', '1', 'dsad', 'sad', '1489627377', '', null, null);
INSERT INTO `user_comment` VALUES ('16', null, '4', '1', 'sadd', 'dsa', '1489627432', '', null, null);
