/*
 Navicat Premium Data Transfer

 Source Server         : Web
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : blog

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 19/01/2021 14:06:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post`  (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `content` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`postid`, `userid`) USING BTREE,
  INDEX `userid`(`userid`) USING BTREE,
  INDEX `postid`(`postid`) USING BTREE,
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES (12, 13, 'sample post with date time stamp', '2021-01-15 15:05:46');
INSERT INTO `post` VALUES (15, 13, 'asdas', '2021-01-15 15:28:30');
INSERT INTO `post` VALUES (18, 13, '12', '2021-01-15 15:31:43');

-- ----------------------------
-- Table structure for post_comment
-- ----------------------------
DROP TABLE IF EXISTS `post_comment`;
CREATE TABLE `post_comment`  (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`commentid`, `postid`, `userid`) USING BTREE,
  INDEX `postid`(`postid`) USING BTREE,
  INDEX `userid`(`userid`) USING BTREE,
  CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`postid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post_comment
-- ----------------------------
INSERT INTO `post_comment` VALUES (65, 18, 13, 'sample', '2021-01-18 16:22:24');
INSERT INTO `post_comment` VALUES (66, 18, 13, 'chino gwapo', '2021-01-18 17:21:22');

-- ----------------------------
-- Table structure for post_reaction
-- ----------------------------
DROP TABLE IF EXISTS `post_reaction`;
CREATE TABLE `post_reaction`  (
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `reaction` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`postid`, `userid`) USING BTREE,
  INDEX `postid`(`postid`) USING BTREE,
  INDEX `userid`(`userid`) USING BTREE,
  CONSTRAINT `post_reaction_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`postid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `post_reaction_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post_reaction
-- ----------------------------
INSERT INTO `post_reaction` VALUES (12, 13, 'Like', '2021-01-18');
INSERT INTO `post_reaction` VALUES (12, 14, 'Like', '2021-01-18');
INSERT INTO `post_reaction` VALUES (12, 15, 'Like', '2021-01-18');
INSERT INTO `post_reaction` VALUES (15, 14, 'Like', '2021-01-18');
INSERT INTO `post_reaction` VALUES (15, 15, 'Like', '2021-01-18');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `age` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (13, 'mark', 'mark', '12', 'mark', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
INSERT INTO `user` VALUES (14, 'karl', 'tapangan', '10', 'karl', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
INSERT INTO `user` VALUES (15, 'chino', 'gulfan', '12', 'chino', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
INSERT INTO `user` VALUES (16, 'rus', 'sel', '12', 'russel', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
INSERT INTO `user` VALUES (17, 'denver', 'gomez', '12', 'denver', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

SET FOREIGN_KEY_CHECKS = 1;
