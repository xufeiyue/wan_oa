/*
Navicat MySQL Data Transfer

Source Server         : company
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : oa

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-05-13 16:05:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for qp_admin
-- ----------------------------
DROP TABLE IF EXISTS `qp_admin`;
CREATE TABLE `qp_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `admin_name` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员登录用户名',
  `admin_pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员登录密码',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '角色Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of qp_admin
-- ----------------------------
INSERT INTO `qp_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '0');

-- ----------------------------
-- Table structure for qp_department
-- ----------------------------
DROP TABLE IF EXISTS `qp_department`;
CREATE TABLE `qp_department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `department` varchar(30) NOT NULL DEFAULT '' COMMENT '部门名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='部门表';

-- ----------------------------
-- Records of qp_department
-- ----------------------------
INSERT INTO `qp_department` VALUES ('1', '部门A001');
INSERT INTO `qp_department` VALUES ('2', '部门A002');
INSERT INTO `qp_department` VALUES ('3', '部门A003');
INSERT INTO `qp_department` VALUES ('4', '部门A004');
INSERT INTO `qp_department` VALUES ('5', '部门A004');
INSERT INTO `qp_department` VALUES ('6', '部门A006');
INSERT INTO `qp_department` VALUES ('7', '部门A007');
INSERT INTO `qp_department` VALUES ('8', '部门A008');
INSERT INTO `qp_department` VALUES ('9', '部门A009');
INSERT INTO `qp_department` VALUES ('10', '部门A010');

-- ----------------------------
-- Table structure for qp_privilege
-- ----------------------------
DROP TABLE IF EXISTS `qp_privilege`;
CREATE TABLE `qp_privilege` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `parent_id` smallint(5) NOT NULL DEFAULT '0' COMMENT '父id',
  `action_name` varchar(30) NOT NULL DEFAULT '' COMMENT '权限名称',
  `action_code` varchar(100) NOT NULL DEFAULT '' COMMENT '权限代码',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '权限链接',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '1显示2隐藏',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序，升序排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of qp_privilege
-- ----------------------------

-- ----------------------------
-- Table structure for qp_role
-- ----------------------------
DROP TABLE IF EXISTS `qp_role`;
CREATE TABLE `qp_role` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色Id',
  `role_name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名称',
  `privilege_list` longtext COMMENT '权限列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of qp_role
-- ----------------------------
