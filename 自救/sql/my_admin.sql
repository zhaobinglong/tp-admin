/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-12-26 14:52:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_admin
-- ----------------------------
DROP TABLE IF EXISTS `my_admin`;
CREATE TABLE `my_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL DEFAULT '',
  `password` varchar(120) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of my_admin
-- ----------------------------
INSERT INTO `my_admin` VALUES ('1', 'admin', '8ec66c5cd1b464c86f21734ad94733a00e768326', '1560402355', '1560402355');

-- ----------------------------
-- Table structure for my_config
-- ----------------------------
DROP TABLE IF EXISTS `my_config`;
CREATE TABLE `my_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL COMMENT '网站名称',
  `desc` varchar(255) NOT NULL COMMENT '网站描述',
  `logo` varchar(120) NOT NULL DEFAULT '' COMMENT '网站logo',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `appid` varchar(120) NOT NULL DEFAULT '' COMMENT '小程序账号',
  `app_secret` varchar(255) NOT NULL DEFAULT '' COMMENT '小程序密码',
  `template_id` varchar(255) NOT NULL COMMENT '消息推送模版',
  `clear_time` int(11) NOT NULL COMMENT '兑换记录里面的记录能不能一定时间自动清除',
  `share_logo` varchar(255) NOT NULL COMMENT '分享logo',
  `share_title` varchar(120) NOT NULL COMMENT '分享说明',
  `encrypt_id` varchar(32) NOT NULL COMMENT '加密id',
  `encrypt_secret` varchar(32) NOT NULL COMMENT '加密秘钥',
  `encrypt_md5` varchar(32) NOT NULL,
  `key_word` varchar(255) NOT NULL COMMENT '关键字',
  `encrypt_header_md5` varchar(32) NOT NULL COMMENT '头部md5加密',
  `cloud_save_ak` varchar(255) NOT NULL COMMENT '七牛云对象存储ak',
  `cloud_save_sk` varchar(255) NOT NULL COMMENT '七牛云对象存储sk',
  `cloud_save_action` varchar(255) NOT NULL COMMENT '上传使用的地址',
  `cloud_save_bucket` varchar(255) NOT NULL COMMENT '七牛云bucket',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='配置表';

-- ----------------------------
-- Records of my_config
-- ----------------------------
INSERT INTO `my_config` VALUES ('1', '梦幻西游', '最好别进来', 'http://q29zw25a3.bkt.clouddn.com/0c4da7240549749b5af2cd8649017b4f', '1560322201', '1576315046', 'wxcd4093fa1ebc4694', '9fac0dfae0036e9f51807e49d7694387', 'rvCGkjjBpj3uUQ9pZ36SxMTxRYylw0mqj6LgWB3c8mk', '20', 'uploads/20190703/5d12df371f97eeabbf28d640cea64bec.jpg', 'bar', 'kcnwxA4WRixxnWCd', 'Tdi6pCbTxkE88ceQ', 'sphZZ6Zcx42ARBfS', '我的世界', '8daRMcSkSDK6R4hZ', 'Byw93n41gkukITA1u74xHgGk2APN8ANlnwOhYWf8', 'sNVunAFOAhj7URJpvwshFTX5LkRasXmI7tqtg433', 'http://q29zw25a3.bkt.clouddn.com', 'sundayss1');

-- ----------------------------
-- Table structure for my_error_log
-- ----------------------------
DROP TABLE IF EXISTS `my_error_log`;
CREATE TABLE `my_error_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='错误日志\r\n';

-- ----------------------------
-- Records of my_error_log
-- ----------------------------

-- ----------------------------
-- Table structure for my_form
-- ----------------------------
DROP TABLE IF EXISTS `my_form`;
CREATE TABLE `my_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` varchar(255) NOT NULL DEFAULT '0' COMMENT '收集的form_id，用于发送消息',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信公众号获取的 fromId';

-- ----------------------------
-- Records of my_form
-- ----------------------------

-- ----------------------------
-- Table structure for my_images
-- ----------------------------
DROP TABLE IF EXISTS `my_images`;
CREATE TABLE `my_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(200) NOT NULL DEFAULT '' COMMENT '访问路径',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='图片表';

-- ----------------------------
-- Records of my_images
-- ----------------------------
INSERT INTO `my_images` VALUES ('12', 'http://q29zw25a3.bkt.clouddn.com/11ea56ac2e1875ecbf30d1ad9f0531a5', '1576314657', '1576314657');
INSERT INTO `my_images` VALUES ('13', 'http://q29zw25a3.bkt.clouddn.com/747d7fae95e7171e47ee210f8b28acf6', '1576314658', '1576314658');
INSERT INTO `my_images` VALUES ('14', 'http://q29zw25a3.bkt.clouddn.com/aa6bfaa5614d0945ff5cac1e80bee0e0', '1576314658', '1576314658');
INSERT INTO `my_images` VALUES ('15', 'http://q29zw25a3.bkt.clouddn.com/0c4da7240549749b5af2cd8649017b4f', '1576314924', '1576314924');
INSERT INTO `my_images` VALUES ('16', 'http://q29zw25a3.bkt.clouddn.com/7d660a9a058c3d064ab09dbd1b7b8f71', '1576314924', '1576314924');
INSERT INTO `my_images` VALUES ('17', 'http://q29zw25a3.bkt.clouddn.com/37626d85444179eb7ad8374d5cd159be', '1576314925', '1576314925');

-- ----------------------------
-- Table structure for my_test
-- ----------------------------
DROP TABLE IF EXISTS `my_test`;
CREATE TABLE `my_test` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `test` text CHARACTER SET utf8 NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of my_test
-- ----------------------------
INSERT INTO `my_test` VALUES ('1', 'http://q29zw25a3.bkt.clouddn.com/37626d85444179eb7ad8374d5cd159be,http://q29zw25a3.bkt.clouddn.com/7d660a9a058c3d064ab09dbd1b7b8f71,http://q29zw25a3.bkt.clouddn.com/0c4da7240549749b5af2cd8649017b4f,http://q29zw25a3.bkt.clouddn.com/aa6bfaa5614d0945ff5cac1e80bee0e0,http://q29zw25a3.bkt.clouddn.com/747d7fae95e7171e47ee210f8b28acf6', '0', '1');

-- ----------------------------
-- Table structure for my_wechat_user
-- ----------------------------
DROP TABLE IF EXISTS `my_wechat_user`;
CREATE TABLE `my_wechat_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(120) NOT NULL DEFAULT '',
  `nickname` varchar(120) NOT NULL DEFAULT '' COMMENT '昵称',
  `header_img` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `refresh_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='微信已授权登录用户';

-- ----------------------------
-- Records of my_wechat_user
-- ----------------------------
INSERT INTO `my_wechat_user` VALUES ('2', 'ocA5c5R8gA7B5Pj9NHEQN8b3W3aM', '', '', '1574672886', '1574672886', '1574672886');
