/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : tp6_spirits

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 13/11/2020 16:52:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `user_nick` varchar(100) NOT NULL DEFAULT '' COMMENT '昵称',
  `user_face` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `user_host` varchar(255) NOT NULL DEFAULT '' COMMENT 'IP',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `user_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户状态：0正常，1冻结',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `user_tel` int(11) DEFAULT NULL COMMENT '手机号',
  `user_email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='管理员';

-- ----------------------------
-- Records of admin
-- ----------------------------
BEGIN;
INSERT INTO `admin` VALUES (3, 'admin', '$2y$10$GNHxUaVZj.oe50IwzCDS0O0DGvf7Vz.VYKAK/s7g6btSuSEXmx75S', '超级管理员', '', '::1', '2020-11-13 14:35:02', 0, '2020-04-12 18:17:50', NULL, 'admin@qq.com', '2020-11-13 14:35:02');
COMMIT;

-- ----------------------------
-- Table structure for buy_history
-- ----------------------------
DROP TABLE IF EXISTS `buy_history`;
CREATE TABLE `buy_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_tel` varchar(255) DEFAULT '' COMMENT '手机号',
  `create_time` timestamp NULL DEFAULT NULL,
  `good_requie_id` varchar(255) DEFAULT NULL COMMENT '商品编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='购买记录表';

-- ----------------------------
-- Records of buy_history
-- ----------------------------
BEGIN;
INSERT INTO `buy_history` VALUES (1, '13295158684', '2020-11-11 22:54:05', '2020111394100');
COMMIT;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品编号',
  `goods_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_pic` varchar(255) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_price` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goods_stock` int(11) NOT NULL DEFAULT '0' COMMENT '商品库存量',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `requie_id` varchar(255) NOT NULL DEFAULT '' COMMENT '唯一编号',
  `attention` varchar(255) DEFAULT '' COMMENT '关注度',
  `goods_desc` text COMMENT '商品详情',
  `key_point` varchar(255) NOT NULL COMMENT '推荐理由',
  `produce_time` date DEFAULT NULL COMMENT '生产日期',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `requie_id` (`requie_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

-- ----------------------------
-- Records of goods
-- ----------------------------
BEGIN;
INSERT INTO `goods` VALUES (3, '荷花酒', '', 1199.00, 1500, '2020-11-13 16:03:21', '2020-11-13 16:03:21', '2020111394100', '10W+', '<p>商品名称：荷山酒 贵人&nbsp; / 关注度10W+</p>\n<p>推荐理由：[例：国家级调酒大师精心调制]</p>\n<p>生产时间：2008-08-08</p>\n<p>购买时间：2020-12-12</p>\n<p>商品名称：荷山酒 贵人&nbsp; / 关注度10W+</p>\n<p>推荐理由：[例：国家级调酒大师精心调制]</p>\n<p>生产时间：2008-08-08</p>\n<p>购买时间：2020-12-12</p>\n<p>商品名称：荷山酒 贵人&nbsp; / 关注度10W+</p>\n<p>推荐理由：[例：国家级调酒大师精心调制]</p>\n<p>生产时间：2008-08-08</p>\n<p>购买时间：2020-12-12</p>\n<p>商品名称：荷山酒 贵人&nbsp; / 关注度10W+</p>\n<p>推荐理由：[例：国家级调酒大师精心调制]</p>\n<p>生产时间：2008-08-08</p>\n<p>购买时间：2020-12-12</p>\n<p>商品名称：荷山酒 贵人&nbsp; / 关注度10W+</p>\n<p>推荐理由：[例：国家级调酒大师精心调制]</p>\n<p>生产时间：2008-08-08</p>\n<p>购买时间：2020-12-12</p>\n<p>商品名称：荷山酒 贵人&nbsp; / 关注度10W+</p>\n<p>推荐理由：[例：国家级调酒大师精心调制]</p>\n<p>生产时间：2008-08-08</p>\n<p>购买时间：2020-12-12</p>\n<p>商品名称：荷山酒 贵人&nbsp; / 关注度10W+</p>\n<p>推荐理由：[例：国家级调酒大师精心调制]</p>\n<p>生产时间：2008-08-08</p>\n<p>购买时间：2020-12-12</p>\n<p>商品名称：荷山酒 贵人&nbsp; / 关注度10W+</p>\n<p>推荐理由：[例：国家级调酒大师精心调制]</p>\n<p>生产时间：2008-08-08</p>\n<p>购买时间：2020-12-12</p>\n<p>&nbsp;</p>', '国家级调酒大师精心调制', '2008-08-08');
COMMIT;

-- ----------------------------
-- Table structure for goods_cates
-- ----------------------------
DROP TABLE IF EXISTS `goods_cates`;
CREATE TABLE `goods_cates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) NOT NULL DEFAULT '' COMMENT '类型名称',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='类型表';

-- ----------------------------
-- Records of goods_cates
-- ----------------------------
BEGIN;
INSERT INTO `goods_cates` VALUES (1, '面粉', '2020-04-14 14:34:40', NULL);
INSERT INTO `goods_cates` VALUES (2, '大米', '2020-04-14 14:34:47', NULL);
INSERT INTO `goods_cates` VALUES (5, '油', '2020-04-14 14:34:56', NULL);
INSERT INTO `goods_cates` VALUES (6, '杂粮', '2020-04-14 14:35:02', NULL);
COMMIT;

-- ----------------------------
-- Table structure for login_log
-- ----------------------------
DROP TABLE IF EXISTS `login_log`;
CREATE TABLE `login_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login_ip` varchar(255) DEFAULT NULL COMMENT '登录IP',
  `name` varchar(255) DEFAULT NULL COMMENT '登录名称',
  `create_t` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `content` varchar(255) DEFAULT NULL COMMENT '详情',
  `type` varchar(255) DEFAULT NULL COMMENT '操作类型',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='日志表';

-- ----------------------------
-- Records of login_log
-- ----------------------------
BEGIN;
INSERT INTO `login_log` VALUES (1, '::1', 'admin', '2020-11-10 22:29:11', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (2, '::1', 'admin', '2020-11-11 21:52:25', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (3, '::1', 'admin', '2020-11-11 21:54:03', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (4, '::1', 'admin', '2020-11-11 22:45:51', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (5, '::1', 'admin', '2020-11-13 14:35:02', '登录成功,帐号:admin,登录IP:::1', '用户登录');
COMMIT;

-- ----------------------------
-- Table structure for story
-- ----------------------------
DROP TABLE IF EXISTS `story`;
CREATE TABLE `story` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `requie_id` varchar(255) DEFAULT NULL COMMENT '商品编号',
  `user_tel` varchar(255) DEFAULT NULL COMMENT '用户手机号',
  `content` varchar(255) DEFAULT NULL COMMENT '故事内容',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='故事表';

SET FOREIGN_KEY_CHECKS = 1;
