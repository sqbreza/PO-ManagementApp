/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : ice9

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2015-09-20 16:23:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `clients`
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `vat_reg_no` varchar(255) DEFAULT NULL,
  `prime_contact_personal` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `notes` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('3', 'Robi axiata Ltd.', 'Robi Corporate Office, 53 Gulshan South avenue, Gulshan 1, Dhaka, Bangladesh', '18121025236', '', '', '', '');
INSERT INTO `clients` VALUES ('4', 'Unilever Bangladesh Ltd.', 'CSD, 105-109 Tongi Industrial Area, Gazipur, Bangladesh.', '18041010920', 'Ishtiaque Shahriar', '', '', 'To: Scan operation, Unilever Bangladesh Ltd.\r\nAttn: Ahsanur Rahman, Assistant manager, activation events and media');
INSERT INTO `clients` VALUES ('5', 'Nestle Bangladesh Ltd.', 'Ninakabbo, Gulshan-Tejgaon link road', '', '', '', '', '');

-- ----------------------------
-- Table structure for `company`
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `established_date` date DEFAULT NULL,
  `total_employee` int(11) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `company_vat` float(5,2) DEFAULT NULL,
  `quotation_header_image` varchar(255) DEFAULT NULL,
  `quotation_table_header_color` varchar(255) DEFAULT NULL,
  `quotation_table_sub_header_color` varchar(255) DEFAULT NULL,
  `quotation_watermark_image` varchar(255) DEFAULT NULL,
  `bill_header_image` varchar(255) DEFAULT NULL,
  `bill_table_header_color` varchar(255) DEFAULT NULL,
  `bill_table_sub_header_color` varchar(255) DEFAULT NULL,
  `bill_watermark_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', 'MVRK Studios', 'Floor 7, 50 Lake Circus, Kalabagan, Dhaka 1205', null, null, '01730798608,01711187000', 'info@maverickbd.com', 'www.maverickbd.com', '4.50', 'IMG120150430070432.jpg', '#0080ff', '#008bbf', 'IMG220150430070432.jpg', '', '#000000', '#000000', '');

-- ----------------------------
-- Table structure for `file_archive`
-- ----------------------------
DROP TABLE IF EXISTS `file_archive`;
CREATE TABLE `file_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of file_archive
-- ----------------------------
INSERT INTO `file_archive` VALUES ('5', 'IQ20150128001', 'ARC_Q201501280410420.xlsx', 'Quotation');
INSERT INTO `file_archive` VALUES ('6', 'IQ20150128001', 'ARC_Q201501280410421.csv', 'Quotation');
INSERT INTO `file_archive` VALUES ('7', 'IQ20150128001', 'ARC_Q201501280410422.xlsx', 'Quotation');

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1421830587');
INSERT INTO `migration` VALUES ('m140524_153638_init_user', '1421830804');
INSERT INTO `migration` VALUES ('m140524_153642_init_user_auth', '1421830804');

-- ----------------------------
-- Table structure for `profile`
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_user_id` (`user_id`),
  CONSTRAINT `profile_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES ('2', '2', '2015-01-21 17:02:38', '2015-01-25 16:25:24', '');
INSERT INTO `profile` VALUES ('3', '3', '2015-04-09 07:55:53', '2015-04-09 08:18:58', 'Nishat Tasneem');

-- ----------------------------
-- Table structure for `quotation`
-- ----------------------------
DROP TABLE IF EXISTS `quotation`;
CREATE TABLE `quotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_name_header` varchar(255) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `client_company_id` int(11) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `po_no` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `supervisor_name` varchar(255) DEFAULT NULL,
  `show_section_amount` int(1) NOT NULL,
  `template_ref` int(11) DEFAULT NULL,
  `note_up` longtext,
  `note_down` longtext,
  `calculation` varchar(50) DEFAULT NULL,
  `vat` float(5,2) DEFAULT NULL,
  `service_charge` text,
  `amount_words` varchar(255) DEFAULT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quotation
-- ----------------------------
INSERT INTO `quotation` VALUES ('19', 'IQ20150409007', 'Advertising', 'Advertising', '1', '3', '625693.75', 'IQ20150409007', '2015-04-09', 'Pending', '2', 'Sidrat', '1', '13', '', '', 'Percentage', '4.50', 'a:3:{i:0;s:1:\"0\";i:1;s:3:\"7.5\";i:2;s:1:\"0\";}', 'six lac twenty five thousand six hundred ninety three', '2015-05-04 14:28:25');
INSERT INTO `quotation` VALUES ('20', 'IQ20150409008', 'zxc', 'zxc', '1', '3', '13500.00', 'IQ20150409008', '2015-04-09', 'Pending', '2', 'asd', '0', '12', '', '', 'Units', '0.00', 'a:3:{i:0;s:1:\"0\";i:1;s:1:\"0\";i:2;s:1:\"0\";}', 'thirteen thousand five Hundred  ', '2015-04-09 10:50:35');
INSERT INTO `quotation` VALUES ('24', 'IQ20150409012', '123123', '123123', '1', '3', '19748864.00', 'IQ20150409012', '2015-04-09', 'Pending', '2', 'asdasd', '0', '12', '', '', 'Units', '0.00', 'a:3:{i:0;s:1:\"0\";i:1;s:1:\"0\";i:2;s:1:\"0\";}', 'one crore ninety seven lac forty eight thousand eight Hundred sixty four', '2015-04-09 12:14:23');
INSERT INTO `quotation` VALUES ('25', 'IQ20150409013', 'as', 'as', '1', '3', '88686.00', 'IQ20150409013', '2015-04-09', 'Pending', '2', 'sdasd', '0', '12', '', '', 'Units', '0.00', 'a:3:{i:0;s:1:\"0\";i:1;s:1:\"0\";i:2;s:1:\"0\";}', 'eighty eight thousand six Hundred eighty six', '2015-04-09 12:15:30');
INSERT INTO `quotation` VALUES ('26', 'IQ20150409014', 'asdasd', 'asdasd', '1', '3', '8136666.00', 'IQ20150409014', '2015-04-09', 'Pending', '2', 'asd', '0', '12', '', '', 'Units', '0.00', 'a:3:{i:0;s:1:\"0\";i:1;s:1:\"0\";i:2;s:1:\"0\";}', 'eighty one lac thirty six thousand six Hundred sixty six', '2015-04-09 12:16:48');
INSERT INTO `quotation` VALUES ('28', 'IQ20150412001', 'sdf', 'sdf', '1', '3', '26199.00', 'IQ20150412001', '2015-04-12', 'Pending', '2', 'asd', '1', '15', '', '', 'Units', '0.00', 'a:1:{i:0;s:1:\"0\";}', 'twenty six thousand one hundred ninety nine', '2015-04-12 19:32:51');

-- ----------------------------
-- Table structure for `quotation_ref`
-- ----------------------------
DROP TABLE IF EXISTS `quotation_ref`;
CREATE TABLE `quotation_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) NOT NULL,
  `template_ref` int(11) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `cost_day` float(10,2) DEFAULT NULL,
  `units` float(10,2) DEFAULT NULL,
  `total` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=409 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quotation_ref
-- ----------------------------
INSERT INTO `quotation_ref` VALUES ('324', 'IQ20150409008', '12', 'Pre-production', 'Planning & Visualization', '', '500.00', '4.00', '2000.00');
INSERT INTO `quotation_ref` VALUES ('325', 'IQ20150409008', '12', 'Production', 'Shooting & Video capure', '', '500.00', '2.00', '1000.00');
INSERT INTO `quotation_ref` VALUES ('326', 'IQ20150409008', '12', 'Production', 'Field Equipment Cost', '', '500.00', '5.00', '2500.00');
INSERT INTO `quotation_ref` VALUES ('327', 'IQ20150409008', '12', 'Production', 'Food', '', '500.00', '5.00', '2500.00');
INSERT INTO `quotation_ref` VALUES ('328', 'IQ20150409008', '12', 'Post-production', 'Editing Panel fee', '', '600.00', '5.00', '3000.00');
INSERT INTO `quotation_ref` VALUES ('329', 'IQ20150409008', '12', 'Post-production', 'Editors fees', '', '500.00', '5.00', '2500.00');
INSERT INTO `quotation_ref` VALUES ('349', 'IQ20150409012', '12', 'Pre-production', 'Planning & Visualization', '', '23.00', '23.00', '529.00');
INSERT INTO `quotation_ref` VALUES ('350', 'IQ20150409012', '12', 'Production', 'Shooting & Video capure', '', '2132.00', '2.00', '4264.00');
INSERT INTO `quotation_ref` VALUES ('351', 'IQ20150409012', '12', 'Production', 'Field Equipment Cost', '', '213.00', '223.00', '47499.00');
INSERT INTO `quotation_ref` VALUES ('352', 'IQ20150409012', '12', 'Post-production', 'Editing Panel fee', '', '123213.00', '123.00', '15155199.00');
INSERT INTO `quotation_ref` VALUES ('353', 'IQ20150409012', '12', 'Post-production', 'High quality rendering and compression', '', '21321.00', '213.00', '4541373.00');
INSERT INTO `quotation_ref` VALUES ('354', 'IQ20150409013', '12', 'Pre-production', 'Planning & Visualization', '', '234.00', '32.00', '7488.00');
INSERT INTO `quotation_ref` VALUES ('355', 'IQ20150409013', '12', 'Production', 'Shooting & Video capure', '', '234.00', '23.00', '5382.00');
INSERT INTO `quotation_ref` VALUES ('356', 'IQ20150409013', '12', 'Post-production', 'Editing Panel fee', '', '234.00', '324.00', '75816.00');
INSERT INTO `quotation_ref` VALUES ('357', 'IQ20150409014', '12', 'Pre-production', 'Planning & Visualization', '', '234.00', '234.00', '54756.00');
INSERT INTO `quotation_ref` VALUES ('358', 'IQ20150409014', '12', 'Production', 'Shooting & Video capure', '', '234.00', '234.00', '54756.00');
INSERT INTO `quotation_ref` VALUES ('359', 'IQ20150409014', '12', 'Production', 'Field Equipment Cost', '', '234.00', '234.00', '54756.00');
INSERT INTO `quotation_ref` VALUES ('360', 'IQ20150409014', '12', 'Post-production', 'Editing Panel fee', '', '234324.00', '34.00', '7967016.00');
INSERT INTO `quotation_ref` VALUES ('361', 'IQ20150409014', '12', 'Post-production', 'Editors fees', '', '234.00', '23.00', '5382.00');
INSERT INTO `quotation_ref` VALUES ('400', 'IQ20150412001', '15', 'test', 'a', '', '123.00', '213.00', '26199.00');
INSERT INTO `quotation_ref` VALUES ('405', 'IQ20150409007', '13', 'Maxus', 'Facebook', '', '100000.00', '5.00', '5000.00');
INSERT INTO `quotation_ref` VALUES ('406', 'IQ20150409007', '13', 'Maxus', 'GDN', '', '200000.00', '5.00', '10000.00');
INSERT INTO `quotation_ref` VALUES ('407', 'IQ20150409007', '13', 'G&R', 'G&R ads', '', null, null, '450000.00');
INSERT INTO `quotation_ref` VALUES ('408', 'IQ20150409007', '13', 'Creatives', 'Creatives content', '(1000 x 10)', null, null, '100000.00');

-- ----------------------------
-- Table structure for `ref_generator`
-- ----------------------------
DROP TABLE IF EXISTS `ref_generator`;
CREATE TABLE `ref_generator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `serial` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_generator
-- ----------------------------
INSERT INTO `ref_generator` VALUES ('1', '2015-03-15', '1', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('2', '2015-04-02', '1', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('26', '2015-04-08', '1', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('27', '2015-04-08', '2', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('28', '2015-04-08', '3', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('29', '2015-04-08', '4', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('30', '2015-04-08', '5', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('31', '2015-04-08', '6', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('32', '2015-04-08', '7', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('33', '2015-04-08', '8', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('34', '2015-04-08', '9', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('35', '2015-04-08', '10', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('39', '2015-04-09', '1', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('40', '2015-04-09', '2', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('41', '2015-04-09', '3', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('42', '2015-04-09', '4', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('43', '2015-04-09', '5', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('44', '2015-04-09', '6', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('45', '2015-04-09', '7', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('46', '2015-04-09', '8', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('47', '2015-04-09', '9', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('48', '2015-04-09', '10', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('51', '2015-04-09', '11', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('52', '2015-04-09', '12', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('53', '2015-04-09', '13', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('54', '2015-04-09', '14', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('55', '2015-04-10', '1', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('56', '2015-04-12', '1', 'Quotation', 'Ice9');
INSERT INTO `ref_generator` VALUES ('57', '2015-04-26', '1', 'Quotation', 'Ice9');

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `can_admin` smallint(6) NOT NULL DEFAULT '0',
  `can_moderate` smallint(6) NOT NULL,
  `can_user` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'Admin', '2015-01-21 10:00:04', null, '1', '1', '1');
INSERT INTO `role` VALUES ('2', 'Moderate', '2015-01-21 10:00:04', null, '0', '1', '1');
INSERT INTO `role` VALUES ('3', 'User', null, null, '0', '0', '1');

-- ----------------------------
-- Table structure for `template`
-- ----------------------------
DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `type` enum('Quotation','Bill') DEFAULT 'Quotation',
  `calculation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of template
-- ----------------------------
INSERT INTO `template` VALUES ('12', 'Pre-production / Production / Post-production', '1', 'Quotation', 'Units');
INSERT INTO `template` VALUES ('13', 'Online Advertising', '1', 'Quotation', 'Percentage');
INSERT INTO `template` VALUES ('14', 'test', '1', 'Quotation', 'Units');
INSERT INTO `template` VALUES ('15', 'test', '1', 'Quotation', 'Units');
INSERT INTO `template` VALUES ('16', 'test', '1', 'Quotation', 'Percentage');

-- ----------------------------
-- Table structure for `template_fields`
-- ----------------------------
DROP TABLE IF EXISTS `template_fields`;
CREATE TABLE `template_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `template_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of template_fields
-- ----------------------------
INSERT INTO `template_fields` VALUES ('102', '13', 'Maxus', 'Facebook', 'Quotation');
INSERT INTO `template_fields` VALUES ('103', '13', 'Maxus', 'GDN', 'Quotation');
INSERT INTO `template_fields` VALUES ('104', '13', 'G&R', 'G&R ads', 'Quotation');
INSERT INTO `template_fields` VALUES ('105', '13', 'Creatives', 'Creatives content', 'Quotation');
INSERT INTO `template_fields` VALUES ('121', '12', 'Pre-production', 'Planning & Visualization', 'Quotation');
INSERT INTO `template_fields` VALUES ('122', '12', 'Production', 'Shooting & Video capure', 'Quotation');
INSERT INTO `template_fields` VALUES ('123', '12', 'Production', 'Field Equipment Cost', 'Quotation');
INSERT INTO `template_fields` VALUES ('124', '12', 'Production', 'Dirctor', 'Quotation');
INSERT INTO `template_fields` VALUES ('125', '12', 'Production', 'Cinematographer', 'Quotation');
INSERT INTO `template_fields` VALUES ('126', '12', 'Production', 'Actors', 'Quotation');
INSERT INTO `template_fields` VALUES ('127', '12', 'Production', 'Production Personnel Fees', 'Quotation');
INSERT INTO `template_fields` VALUES ('128', '12', 'Production', 'Transport', 'Quotation');
INSERT INTO `template_fields` VALUES ('129', '12', 'Production', 'Food', 'Quotation');
INSERT INTO `template_fields` VALUES ('130', '12', 'Post-production', 'Editing Panel fee', 'Quotation');
INSERT INTO `template_fields` VALUES ('131', '12', 'Post-production', 'Editors fees', 'Quotation');
INSERT INTO `template_fields` VALUES ('132', '12', 'Post-production', 'Compositing and color grading', 'Quotation');
INSERT INTO `template_fields` VALUES ('133', '12', 'Post-production', 'Motion graphics and CG Effects', 'Quotation');
INSERT INTO `template_fields` VALUES ('134', '12', 'Post-production', 'Sound mixing', 'Quotation');
INSERT INTO `template_fields` VALUES ('135', '12', 'Post-production', 'High quality rendering and compression', 'Quotation');
INSERT INTO `template_fields` VALUES ('136', '14', 'sdf', 'sdf', 'Quotation');
INSERT INTO `template_fields` VALUES ('137', '15', 'test', 'a', 'Quotation');
INSERT INTO `template_fields` VALUES ('138', '15', 'test', 'b', 'Quotation');
INSERT INTO `template_fields` VALUES ('145', '16', 'test', 'a', 'Quotation');
INSERT INTO `template_fields` VALUES ('146', '16', 'test', 'b', 'Quotation');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `create_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `ban_time` timestamp NULL DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`email`),
  UNIQUE KEY `user_username` (`username`),
  KEY `user_role_id` (`role_id`),
  CONSTRAINT `user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', '1', '1', 'ice9@ice9interactive.com', null, 'ice9', '$2y$13$0O4FC3vkMQfeVe5UdRU05ugY/9FGLVg0m8wfcPZVCr0cuhPVM3x6.', 'z1VmF3-KwscqDGRqKXOhbQ2mgwnUeZI4', 'CRWbjimUIG1Er6oEgSWG0swetWk1-UsR', '::1', '2015-06-01 17:20:22', '::1', '2015-01-21 17:02:38', '2015-01-25 16:25:24', null, null);
INSERT INTO `user` VALUES ('3', '1', '1', 'nishat@maverickbd.com', null, 'Nishat', '$2y$13$M099qUvAWi0aXStNjqT4mOoFnp4te4VVCDxVWXa6pciTfAVtxlzNu', null, null, '103.242.217.163', '2015-04-09 08:19:19', null, '2015-04-09 07:55:53', '2015-04-09 08:19:57', null, null);

-- ----------------------------
-- Table structure for `user_auth`
-- ----------------------------
DROP TABLE IF EXISTS `user_auth`;
CREATE TABLE `user_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_attributes` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_auth_provider_id` (`provider_id`),
  KEY `user_auth_user_id` (`user_id`),
  CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_auth
-- ----------------------------

-- ----------------------------
-- Table structure for `user_key`
-- ----------------------------
DROP TABLE IF EXISTS `user_key`;
CREATE TABLE `user_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `consume_time` timestamp NULL DEFAULT NULL,
  `expire_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_key_key` (`key`),
  KEY `user_key_user_id` (`user_id`),
  CONSTRAINT `user_key_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_key
-- ----------------------------
INSERT INTO `user_key` VALUES ('1', '2', '1', 'O2mruzbQXRtZUNcNz4Dimok6eEejxLUv', '2015-01-21 17:02:38', null, null);
