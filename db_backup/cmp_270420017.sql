/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : cmp

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-04-27 21:04:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for application_logs
-- ----------------------------
DROP TABLE IF EXISTS `application_logs`;
CREATE TABLE `application_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `err_num` int(11) DEFAULT NULL COMMENT 'The error number (if available)',
  `log_num` int(11) DEFAULT NULL COMMENT 'The CI log level (''ERROR'' => ''1'', ''DEBUG'' => ''2'',  ''TRACE'' => ''3'',  ''INFO'' => ''4'', ''ALL'' => ''5'')',
  `log_source` enum('PHP','CI') DEFAULT NULL COMMENT 'Is this a PHP error or a CI log message?',
  `log_msg` text COMMENT 'The text of the log message',
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_host_ip` varchar(24) DEFAULT NULL COMMENT 'The IP of the host sending the log message',
  PRIMARY KEY (`id`),
  KEY `err_num` (`err_num`),
  KEY `log_num` (`log_num`),
  KEY `log_source` (`log_source`),
  KEY `log_msg` (`log_msg`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of application_logs
-- ----------------------------

-- ----------------------------
-- Table structure for contact_us
-- ----------------------------
DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contact_us
-- ----------------------------

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_text` varchar(255) DEFAULT '' COMMENT 'lang var',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `destination_id` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('1', '1', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('2', '1', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('3', '2', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('4', '2', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('5', '3', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('6', '3', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('7', '4', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('8', '4', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('9', '5', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('10', '5', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('11', '6', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('12', '6', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('13', '7', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('14', '7', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('15', '8', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('16', '8', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('17', '9', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('18', '9', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('19', '10', 'True', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('20', '10', 'False', '2017-02-07 10:52:07');
INSERT INTO `options` VALUES ('21', '11', 'a. multiplying fishes and loaves of bread22', '2017-02-13 18:21:30');
INSERT INTO `options` VALUES ('22', '11', 'b. healing the centurion\'s servant22', '2017-02-13 18:21:30');
INSERT INTO `options` VALUES ('23', '11', 'c. raising Lazarus from the dead22', '2017-02-13 18:21:30');
INSERT INTO `options` VALUES ('24', '12', 'a. James', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('25', '12', 'c. Andrew', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('26', '12', 'b. Thomas', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('27', '12', 'd. Jude', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('28', '13', 'a. Solomon', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('29', '13', 'b. Caesar', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('30', '13', 'c. Herod', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('31', '13', 'd. Pilate', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('32', '14', 'a. Luke', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('33', '14', 'b. Andrew', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('34', '14', 'c. Peter', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('35', '14', 'd. Matthew', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('36', '15', 'a. Peter', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('37', '15', 'b. James', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('38', '15', 'c. Philip', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('39', '15', 'd. John', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('40', '16', 'a. John', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('41', '16', 'b. Matthew', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('42', '16', 'c. Acts', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('43', '16', 'd. Revelation', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('44', '17', 'a. Martha/Mary', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('45', '17', 'b. Leah/Eve', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('46', '17', 'c. Mary/ Sarah', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('47', '17', 'd. Anne/Elizabeth', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('48', '18', 'a. he was beheaded', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('49', '18', 'b. he was stoned', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('50', '18', 'c. he was thrown at the lions', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('51', '18', 'd. he was crucified', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('52', '19', 'a. The saints', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('53', '19', 'b. Jesus', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('54', '19', 'c. The Father', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('55', '19', 'd. His mother Mary', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('56', '20', 'a. Jesus', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('57', '20', 'b. Mary Magdalene', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('58', '20', 'c. Judas', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('59', '20', 'd. John', '2017-02-07 11:06:24');
INSERT INTO `options` VALUES ('66', '23', 'tttt', '2017-02-13 20:07:37');
INSERT INTO `options` VALUES ('67', '23', 'ddd', '2017-02-13 20:21:21');
INSERT INTO `options` VALUES ('68', '23', 'fff', '2017-02-13 20:21:21');
INSERT INTO `options` VALUES ('69', '23', 'qqq', '2017-02-13 20:37:54');
INSERT INTO `options` VALUES ('70', '23', 'eee', '2017-02-13 20:37:54');

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(255) DEFAULT NULL COMMENT 'lang var',
  `correct_option_id` int(11) DEFAULT NULL,
  `timer` int(11) NOT NULL DEFAULT '10',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('1', 'Is Jesus\'s mother named Mary?', '1', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('2', 'Garden of Eden was the name of the garden were Adam and Eve lived?', '3', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('3', 'Jesus fed 5,000 people with ham and bacon.', '6', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('4', 'Beheading is the method Romans used to kill Jesus.', '8', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('5', 'God Created Eve from Adam\'s head.', '10', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('6', 'Simon Peter was accused of being with Jesus, lied and said that he did not know him, three times.', '11', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('7', 'The cow tricked Eve into eating of the forbidden fruit.', '14', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('8', 'Soldiers placed crown of thorns on Christ\'s head at the crucifixion. ', '15', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('9', 'Herod showed his faith by being willing to offer his son on an altar to God.', '18', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('10', 'Creation is the significant event recorded in Genesis 1 and 2.', '19', '10', '2017-02-07 10:47:21');
INSERT INTO `questions` VALUES ('11', 'What was the first miracle Jesus performed? changing water into wine23', '21', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('12', 'Which apostle wouldn\'t believe in the risen Christ until he saw and touched Him and His wounds?', '26', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('13', 'Who was the king who ordered the slaying of male children because he was afraid of the newborn Christ?', '30', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('14', 'Which apostle denied Jesus three times?', '34', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('15', 'Who was described as \'the apostle Jesus loved\'?', '39', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('16', 'What is the fifth book of the New Testament?', '42', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('17', 'Who were the sisters of Lazarus, the man raised from the dead?', '44', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('18', 'How did John the Baptist die? ', '48', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('19', 'Whom did Jesus tell the apostles to pray to? the father', '54', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('20', 'Who washed the feet of the others at the Last Supper?', '56', '10', '2017-02-07 10:57:14');
INSERT INTO `questions` VALUES ('23', 'This is test question', '67', '10', '2017-02-13 19:35:33');

-- ----------------------------
-- Table structure for session_activity_log
-- ----------------------------
DROP TABLE IF EXISTS `session_activity_log`;
CREATE TABLE `session_activity_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `row_id` int(11) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `old_value` varchar(30000) DEFAULT NULL,
  `new_value` varchar(30000) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of session_activity_log
-- ----------------------------

-- ----------------------------
-- Table structure for session_log
-- ----------------------------
DROP TABLE IF EXISTS `session_log`;
CREATE TABLE `session_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(30) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of session_log
-- ----------------------------
INSERT INTO `session_log` VALUES ('1', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '2017-04-27 08:58:33');
INSERT INTO `session_log` VALUES ('2', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '2017-04-27 09:00:09');

-- ----------------------------
-- Table structure for site_settings
-- ----------------------------
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) DEFAULT NULL,
  `setting_value` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of site_settings
-- ----------------------------
INSERT INTO `site_settings` VALUES ('1', 'phone', '0333-3333333333', '1', '2016-11-11 12:13:04', '1', '2017-01-03 10:50:54', '1');
INSERT INTO `site_settings` VALUES ('2', 'info_email', 'info@tekstart.us', '1', '2016-11-11 12:13:40', '1', '2017-01-03 10:50:42', '1');
INSERT INTO `site_settings` VALUES ('3', 'address', 'Pakistan', '1', '2016-11-11 12:13:52', '1', '2017-01-03 10:50:58', '1');
INSERT INTO `site_settings` VALUES ('4', 'fb_link', 'https://www.facebook.com/', '1', '2016-11-11 12:14:08', '1', '2017-01-03 10:51:10', null);
INSERT INTO `site_settings` VALUES ('5', 'twitter_link', 'https://twitter.com/', '1', '2016-11-11 12:14:16', '1', '2017-01-03 10:51:23', null);
INSERT INTO `site_settings` VALUES ('6', 'linkedin_link', 'https://www.linkedin.com/', '1', '2016-11-11 12:14:23', '1', '2017-01-03 10:51:32', null);
INSERT INTO `site_settings` VALUES ('7', 'gplus_link', 'https://plus.google.com/', '1', '2016-11-11 12:14:34', '1', '2017-01-03 10:51:47', null);
INSERT INTO `site_settings` VALUES ('8', 'instagram_link', 'https://www.instagram.com/', '1', '2016-11-11 12:14:47', '1', '2017-01-03 10:52:06', null);
INSERT INTO `site_settings` VALUES ('9', 'site_name', 'CMP', '1', '2016-11-11 12:15:40', '1', '2017-04-27 20:56:55', '1');
INSERT INTO `site_settings` VALUES ('10', 'site_link', 'https://plus.google.com/', '1', '2016-11-28 22:32:15', null, '2017-04-27 20:45:50', null);
INSERT INTO `site_settings` VALUES ('11', 'google_map_api_key', 'AIzaSyAIQv5S8ax0j0TwS3Tx_dBsAqg-0Npb3gI', '1', '2016-12-13 16:02:14', null, '2017-04-27 20:47:14', null);
INSERT INTO `site_settings` VALUES ('12', 'admin_email', 'hassan@tekstart.us', '1', '2017-01-03 10:22:50', null, '2017-01-03 10:22:50', null);

-- ----------------------------
-- Table structure for sql_query_log
-- ----------------------------
DROP TABLE IF EXISTS `sql_query_log`;
CREATE TABLE `sql_query_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(50) DEFAULT NULL,
  `sql_query` varchar(500) DEFAULT NULL,
  `query_type` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=485 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sql_query_log
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `u_activation_code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fb_id` bigint(20) DEFAULT NULL,
  `profile_image_original` varchar(255) DEFAULT NULL,
  `profile_image_name` varchar(30) DEFAULT NULL,
  `profile_image_ext` varchar(5) DEFAULT NULL,
  `fb_token` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT '0',
  `game_life` int(11) DEFAULT '3',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Super', 'Admin', 'super', 'dc91c8ef68cfb5ec114055881d1cbac0', null, 'hassan@tekstart.us', 'male', '', 'admin', '', '2nsqy7Cx_IPHylkuECubohUA-JOKnL9ersKTW3BNqaBN8KuDzI', null, null, null, null, null, null, '3', '0', '1', '2016-08-22 16:06:13', '1', '2017-04-27 21:00:01', null);
INSERT INTO `users` VALUES ('2', 'Normal', 'User', 'normal', 'dc91c8ef68cfb5ec114055881d1cbac0', '', 'hassan+1@tekstart.us', 'male', '', 'user', '', '2nsqy7Cx_IPHylkuECubohUA-JOKnL9ersKTW3BNqaBN8KuDzI', null, '', '', '', '', null, '3', '0', '1', '2016-08-22 16:06:13', '1', '2017-04-27 21:03:49', null);

-- ----------------------------
-- Table structure for usertracking
-- ----------------------------
DROP TABLE IF EXISTS `usertracking`;
CREATE TABLE `usertracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) DEFAULT NULL,
  `user_identifier` varchar(255) NOT NULL,
  `request_uri` text NOT NULL,
  `timestamp` varchar(20) NOT NULL,
  `client_ip` varchar(50) NOT NULL,
  `client_user_agent` text NOT NULL,
  `referer_page` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usertracking
-- ----------------------------
INSERT INTO `usertracking` VALUES ('1', '1', '', '/cmp/admin', '1493308697', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/user/listing');
INSERT INTO `usertracking` VALUES ('2', null, '', '/cmp/admin/user/login', '1493308706', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '');
INSERT INTO `usertracking` VALUES ('3', '1', '', '/cmp/admin/user/listing', '1493308713', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/user/login');
INSERT INTO `usertracking` VALUES ('4', '1', '', '/cmp/admin/user/edit_user/23', '1493308733', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin');
INSERT INTO `usertracking` VALUES ('5', '1', '', '/cmp/admin/user/edit_user/1', '1493308792', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '');
INSERT INTO `usertracking` VALUES ('6', '1', '', '/cmp/admin/user/listing', '1493308801', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/user/edit_user/1');
INSERT INTO `usertracking` VALUES ('7', null, '', '/cmp/admin/user/login', '1493308805', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/user/listing');
INSERT INTO `usertracking` VALUES ('8', '1', '', '/cmp/admin/user/listing', '1493308809', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/user/login');
INSERT INTO `usertracking` VALUES ('9', '1', '', '/cmp/admin/questions', '1493308898', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/user/listing');
INSERT INTO `usertracking` VALUES ('10', '1', '', '/cmp/admin/questions/add', '1493308899', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/questions');
INSERT INTO `usertracking` VALUES ('11', '1', '', '/cmp/admin/questions', '1493308902', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/questions/add');
INSERT INTO `usertracking` VALUES ('12', '1', '', '/cmp/admin/user/listing', '1493308904', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/questions');
INSERT INTO `usertracking` VALUES ('13', '1', '', '/cmp/admin', '1493308920', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/user/listing');
INSERT INTO `usertracking` VALUES ('14', '1', '', '/cmp/admin', '1493308959', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://localhost/cmp/admin/user/listing');
INSERT INTO `usertracking` VALUES ('15', '1', '', '/cmp/admin', '1493308962', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '');
INSERT INTO `usertracking` VALUES ('16', '1', '', '/cmp/admin', '1493309030', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '');
