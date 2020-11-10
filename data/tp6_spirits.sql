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

 Date: 10/11/2020 16:43:53
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
INSERT INTO `admin` VALUES (3, 'admin', '$2y$10$GNHxUaVZj.oe50IwzCDS0O0DGvf7Vz.VYKAK/s7g6btSuSEXmx75S', '超级管理员', '', '::1', '2020-11-10 16:05:28', 0, '2020-04-12 18:17:50', NULL, 'admin@qq.com', '2020-11-10 16:05:28');
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
  `goods_source` varchar(50) NOT NULL DEFAULT '' COMMENT '商品来源',
  `goods_stock` int(11) NOT NULL DEFAULT '0' COMMENT '商品库存量',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `requie_id` varchar(255) NOT NULL DEFAULT '' COMMENT '唯一编号',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `requie_id` (`requie_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

-- ----------------------------
-- Records of goods
-- ----------------------------
BEGIN;
INSERT INTO `goods` VALUES (1, '测试商品', '', 150.00, '系统资源', 5000, '2020-10-31 23:17:12', '2020-10-31 23:17:36', '2020103130339');
INSERT INTO `goods` VALUES (2, '测试2', '', 100.00, '系统资源', 400, '2020-10-31 23:18:02', '2020-10-31 23:18:02', '2020103140660');
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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COMMENT='日志表';

-- ----------------------------
-- Records of login_log
-- ----------------------------
BEGIN;
INSERT INTO `login_log` VALUES (20, '116.136.7.47', 'admin', '2020-04-14 14:20:42', '登录成功,帐号:admin,登录IP:116.136.7.47', '用户登录');
INSERT INTO `login_log` VALUES (21, '116.136.7.47', 'admin', '2020-04-14 14:31:31', '登录成功,帐号:admin,登录IP:116.136.7.47', '用户登录');
INSERT INTO `login_log` VALUES (22, '123.121.167.58', 'admin', '2020-04-14 14:40:21', '登录成功,帐号:admin,登录IP:123.121.167.58', '用户登录');
INSERT INTO `login_log` VALUES (23, '1.31.0.80', 'admin', '2020-04-23 08:19:49', '登录成功,帐号:admin,登录IP:1.31.0.80', '用户登录');
INSERT INTO `login_log` VALUES (24, '116.136.8.47', 'admin', '2020-04-23 18:40:54', '登录成功,帐号:admin,登录IP:116.136.8.47', '用户登录');
INSERT INTO `login_log` VALUES (25, '116.136.8.47', 'admin', '2020-04-23 18:40:54', '登录成功,帐号:admin,登录IP:116.136.8.47', '用户登录');
INSERT INTO `login_log` VALUES (26, '124.192.225.167', 'admin', '2020-04-23 19:57:18', '登录成功,帐号:admin,登录IP:124.192.225.167', '用户登录');
INSERT INTO `login_log` VALUES (27, '1.31.2.127', 'admin', '2020-04-24 22:44:53', '登录成功,帐号:admin,登录IP:1.31.2.127', '用户登录');
INSERT INTO `login_log` VALUES (28, '111.193.234.229', 'admin', '2020-05-04 20:46:27', '登录成功,帐号:admin,登录IP:111.193.234.229', '用户登录');
INSERT INTO `login_log` VALUES (29, '125.33.117.58', 'admin', '2020-05-15 22:30:45', '登录成功,帐号:admin,登录IP:125.33.117.58', '用户登录');
INSERT INTO `login_log` VALUES (30, '124.206.0.247', 'admin', '2020-05-18 17:07:10', '登录成功,帐号:admin,登录IP:124.206.0.247', '用户登录');
INSERT INTO `login_log` VALUES (31, '124.206.0.247', 'admin', '2020-05-18 17:26:27', '登录成功,帐号:admin,登录IP:124.206.0.247', '用户登录');
INSERT INTO `login_log` VALUES (32, '124.206.0.247', 'admin', '2020-05-18 19:02:26', '登录成功,帐号:admin,登录IP:124.206.0.247', '用户登录');
INSERT INTO `login_log` VALUES (33, '1.31.3.126', 'admin', '2020-05-18 20:23:12', '登录成功,帐号:admin,登录IP:1.31.3.126', '用户登录');
INSERT INTO `login_log` VALUES (34, '124.206.0.247', 'admin', '2020-05-19 11:06:45', '登录成功,帐号:admin,登录IP:124.206.0.247', '用户登录');
INSERT INTO `login_log` VALUES (35, '1.31.3.126', 'admin', '2020-05-19 17:48:57', '登录成功,帐号:admin,登录IP:1.31.3.126', '用户登录');
INSERT INTO `login_log` VALUES (36, '1.31.3.126', 'admin', '2020-05-19 17:58:16', '登录成功,帐号:admin,登录IP:1.31.3.126', '用户登录');
INSERT INTO `login_log` VALUES (37, '124.193.148.26', 'admin', '2020-05-19 18:18:25', '登录成功,帐号:admin,登录IP:124.193.148.26', '用户登录');
INSERT INTO `login_log` VALUES (38, '1.31.3.126', 'admin', '2020-05-19 18:44:07', '登录成功,帐号:admin,登录IP:1.31.3.126', '用户登录');
INSERT INTO `login_log` VALUES (39, '222.74.68.2', 'admin', '2020-05-20 08:48:08', '登录成功,帐号:admin,登录IP:222.74.68.2', '用户登录');
INSERT INTO `login_log` VALUES (40, '222.74.68.2', 'admin', '2020-05-20 09:53:22', '登录成功,帐号:admin,登录IP:222.74.68.2', '用户登录');
INSERT INTO `login_log` VALUES (41, '124.193.148.26', 'admin', '2020-05-20 10:57:05', '登录成功,帐号:admin,登录IP:124.193.148.26', '用户登录');
INSERT INTO `login_log` VALUES (42, '222.74.68.2', 'admin', '2020-05-20 11:15:21', '登录成功,帐号:admin,登录IP:222.74.68.2', '用户登录');
INSERT INTO `login_log` VALUES (43, '222.74.68.2', 'admin', '2020-05-20 11:21:00', '登录成功,帐号:admin,登录IP:222.74.68.2', '用户登录');
INSERT INTO `login_log` VALUES (44, '222.74.68.2', 'admin', '2020-05-20 11:36:45', '登录成功,帐号:admin,登录IP:222.74.68.2', '用户登录');
INSERT INTO `login_log` VALUES (45, '222.74.68.2', 'admin', '2020-05-23 08:17:39', '登录成功,帐号:admin,登录IP:222.74.68.2', '用户登录');
INSERT INTO `login_log` VALUES (46, '222.74.68.2', 'admin', '2020-05-23 08:18:03', '登录成功,帐号:admin,登录IP:222.74.68.2', '用户登录');
INSERT INTO `login_log` VALUES (47, '124.206.0.247', 'admin', '2020-06-08 09:46:56', '登录成功,帐号:admin,登录IP:124.206.0.247', '用户登录');
INSERT INTO `login_log` VALUES (48, '124.206.0.247', 'admin', '2020-06-08 16:01:40', '登录成功,帐号:admin,登录IP:124.206.0.247', '用户登录');
INSERT INTO `login_log` VALUES (49, '125.33.123.15', 'admin', '2020-06-28 21:07:26', '登录成功,帐号:admin,登录IP:125.33.123.15', '用户登录');
INSERT INTO `login_log` VALUES (50, '125.33.123.15', 'admin', '2020-06-28 22:51:26', '登录成功,帐号:admin,登录IP:125.33.123.15', '用户登录');
INSERT INTO `login_log` VALUES (51, '123.121.165.105', 'admin', '2020-07-16 08:04:43', '登录成功,帐号:admin,登录IP:123.121.165.105', '用户登录');
INSERT INTO `login_log` VALUES (52, '124.206.0.247', 'admin', '2020-07-31 15:53:27', '登录成功,帐号:admin,登录IP:124.206.0.247', '用户登录');
INSERT INTO `login_log` VALUES (53, '::1', 'admin', '2020-10-28 17:54:15', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (54, '::1', 'admin', '2020-10-30 11:27:03', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (55, '::1', 'admin', '2020-10-30 14:08:59', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (56, '::1', 'admin', '2020-10-31 22:37:58', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (57, '::1', 'admin', '2020-10-31 23:05:31', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (58, '::1', 'admin', '2020-11-01 10:06:38', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (59, '::1', 'admin', '2020-11-01 11:59:49', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (60, '::1', 'admin', '2020-11-01 22:06:59', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (61, '::1', 'admin', '2020-11-04 11:08:59', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (62, '::1', 'admin', '2020-11-10 09:56:00', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (63, '::1', 'admin', '2020-11-10 15:40:11', '登录成功,帐号:admin,登录IP:::1', '用户登录');
INSERT INTO `login_log` VALUES (64, '::1', 'admin', '2020-11-10 16:05:28', '登录成功,帐号:admin,登录IP:::1', '用户登录');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_tel` varchar(255) DEFAULT '' COMMENT '手机号',
  `create_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
