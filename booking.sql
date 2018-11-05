/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50718
 Source Host           : localhost
 Source Database       : booking

 Target Server Type    : MySQL
 Target Server Version : 50718
 File Encoding         : utf-8

 Date: 11/05/2018 23:29:47 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `article_category`
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `article_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  KEY `article_category_article_id_foreign` (`article_id`),
  KEY `article_category_category_id_foreign` (`category_id`),
  CONSTRAINT `article_category_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `article_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `article_content`
-- ----------------------------
DROP TABLE IF EXISTS `article_content`;
CREATE TABLE `article_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `lang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_content_article_id_foreign` (`article_id`),
  CONSTRAINT `article_content_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `article_content`
-- ----------------------------
BEGIN;
INSERT INTO `article_content` VALUES ('1', '1', 'en', 'Istay Services Apartment 1', null, '', 'Meta title', 'meta desc', null), ('2', '2', 'en', 'Room 1 - istay1', null, '', null, null, null), ('3', '3', 'en', 'Room 2 istay 1', null, '', null, null, null), ('4', '4', 'en', 'Room 3 - istay1', null, '', null, null, null), ('5', '5', 'en', 'Istay Services Apartment 2', null, '', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `article_services`
-- ----------------------------
DROP TABLE IF EXISTS `article_services`;
CREATE TABLE `article_services` (
  `article_id` int(10) unsigned NOT NULL,
  `services_id` int(10) unsigned NOT NULL,
  KEY `article_services_article_id_foreign` (`article_id`),
  KEY `article_services_services_id_foreign` (`services_id`),
  CONSTRAINT `article_services_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `article_services_services_id_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `article_services`
-- ----------------------------
BEGIN;
INSERT INTO `article_services` VALUES ('1', '1'), ('1', '2'), ('1', '3'), ('1', '4'), ('1', '5'), ('1', '6'), ('1', '7'), ('1', '8'), ('5', '1'), ('5', '2'), ('5', '4'), ('5', '6'), ('5', '7'), ('5', '8');
COMMIT;

-- ----------------------------
--  Table structure for `articles`
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `system_link_type_id` tinyint(4) NOT NULL,
  `landing_type` tinyint(4) DEFAULT NULL COMMENT '1.istay 2.room',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_parent_id_foreign` (`parent_id`),
  KEY `articles_user_id_foreign` (`user_id`),
  CONSTRAINT `articles_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `articles`
-- ----------------------------
BEGIN;
INSERT INTO `articles` VALUES ('1', 'istay-services-apartment-1', '/uploads/posts/2018/11/20181103080014-7.jpg', '0', '0', null, '1', '4', '1', '1', '2018-11-02 20:57:30', '2018-11-03 08:00:47'), ('2', 'room-1-istay1', '/uploads/posts/2018/11/20181102211033-2.jpg', '244', '0', '1', '1', '4', '2', '1', '2018-11-02 21:10:33', '2018-11-02 21:10:33'), ('3', 'room-2-istay-1', '/uploads/posts/2018/11/20181102212541-4.jpg', '300', '0', '1', '1', '4', '2', '1', '2018-11-02 21:25:41', '2018-11-02 21:25:41'), ('4', 'room-3-istay1', '/uploads/posts/2018/11/20181102212714-3.jpg', '350', '0', '1', '1', '4', '2', '1', '2018-11-02 21:27:14', '2018-11-02 21:27:14'), ('5', 'istay-services-apartment-2', '/uploads/posts/2018/11/20181103080340-3.jpg', '0', '0', null, '1', '4', '1', '1', '2018-11-03 08:03:40', '2018-11-03 08:03:40');
COMMIT;

-- ----------------------------
--  Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `system_link_type_id` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug_unique` (`slug`),
  KEY `category_parent_id_foreign` (`parent_id`),
  CONSTRAINT `category_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `category_content`
-- ----------------------------
DROP TABLE IF EXISTS `category_content`;
CREATE TABLE `category_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_content_category_id_foreign` (`category_id`),
  CONSTRAINT `category_content_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_user_id_foreign` (`user_id`),
  CONSTRAINT `comment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `comment`
-- ----------------------------
BEGIN;
INSERT INTO `comment` VALUES ('1', '1', '2018-11-03 07:15:06', '2018-11-03 07:15:06'), ('2', '1', '2018-11-03 07:15:18', '2018-11-03 07:15:18'), ('3', '1', '2018-11-03 07:15:40', '2018-11-03 07:15:40'), ('4', '1', '2018-11-03 07:16:00', '2018-11-03 07:16:00');
COMMIT;

-- ----------------------------
--  Table structure for `comment_content`
-- ----------------------------
DROP TABLE IF EXISTS `comment_content`;
CREATE TABLE `comment_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `comment_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_content_comment_id_foreign` (`comment_id`),
  CONSTRAINT `comment_content_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `comment_content`
-- ----------------------------
BEGIN;
INSERT INTO `comment_content` VALUES ('1', 'en', '1', 'Mary Leona', '/uploads/comment/2018/11/20181103071506-1.jpg', 'In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mimagna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.'), ('2', 'en', '2', 'Harry Potter', '/uploads/comment/2018/11/20181103071518-2.jpg', 'In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mimagna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.'), ('3', 'en', '3', 'Lione Messi', '/uploads/comment/2018/11/20181103071540-4.jpg', 'In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mimagna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.'), ('4', 'en', '4', 'Herrmione', '/uploads/comment/2018/11/20181103071600-2.jpg', 'In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mimagna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.');
COMMIT;

-- ----------------------------
--  Table structure for `contact`
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'save all information: where, when',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `contact`
-- ----------------------------
BEGIN;
INSERT INTO `contact` VALUES ('1', 'hung', 'cong@gmail.com', '0911222333', null, 'Thời gian: 11/05/2018 - 11/05/2018\nNgười lớn: 2\nTrẻ em: 0'), ('2', 'hung', 'cong@gmail.com', '0911222333', null, 'Thời gian: 11/05/2018 - 11/05/2018\nNgười lớn: 2\nTrẻ em: 0'), ('3', 'hung', 'cong@gmail.com', '0911222333', null, 'Thời gian: 11/05/2018 - 11/05/2018\nNgười lớn: 2\nTrẻ em: 0'), ('4', 'hung', 'cong@gmail.com', '0911222333', null, 'Thời gian: 11/05/2018 - 11/05/2018\nNgười lớn: 2\nTrẻ em: 0'), ('5', 'hung', 'cong@gmail.com', '0911222333', null, 'Thời gian: 11/05/2018 - 11/05/2018\nNgười lớn: 2\nTrẻ em: 0'), ('6', 'vvvv', 'bbb@gmail.com', '0911222333', null, 'Thời gian: 11/05/2018 - 11/05/2018\nNgười lớn: 1\nTrẻ em: 0'), ('7', 'nbbdsfgd', null, '0936111222', null, 'Time checkin - checkout: 11/05/2018 - 11/05/2018\nAdult: 1\nChild: 0'), ('8', 'hung nguyen van', 'test@gmail.com', '0911222999', null, 'Time checkin - checkout: 11/05/2018 - 11/05/2018\nAdult: 1\nChild: 0'), ('9', 'hung', 'test@gmail.com', '0915666444', null, 'Time checkin - checkout: 11/05/2018 - 11/05/2018\nAdult: 1\nChild: 0'), ('10', 'hung', 'test@gmail.com', '0984666999', null, 'Time checkin - checkout: 11/05/2018 - 11/06/2018<br />Adult: 1<br />Child: 0<br />Room: Room 1 - istay1<br />iStay: Istay Services Apartment 1'), ('11', 'jessica', 'hoang@gmail.com', '01268444999', null, 'Time checkin - checkout: 11/05/2018 - 11/07/2018<br />Adult: 1<br />Child: 0<br />Room: Room 1 - istay1<br />iStay: Istay Services Apartment 1'), ('12', 'Marry', 'hau@gmail.com', '0911226666', null, 'Time checkin - checkout: 11/05/2018 - 11/07/2018\r\nAdult: 1\r\nChild: 0\r\nRoom: Room 1 - istay1\r\niStay: Istay Services Apartment 1');
COMMIT;

-- ----------------------------
--  Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `direct` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_group_id` int(11) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `prefix` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_link_type_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menu_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `menu_group`
-- ----------------------------
DROP TABLE IF EXISTS `menu_group`;
CREATE TABLE `menu_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `menu_system`
-- ----------------------------
DROP TABLE IF EXISTS `menu_system`;
CREATE TABLE `menu_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `show` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1,2',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `menu_system`
-- ----------------------------
BEGIN;
INSERT INTO `menu_system` VALUES ('1', 'Category', 'icon-grid', 'category', '0', '0', '1,2', '1'), ('2', 'Create Category', 'icon-plus', 'category.create', '1', '1', '1,2', '1'), ('3', 'All Category', 'icon-list', 'category.index', '1', '2', '1,2', '1'), ('4', 'Post', 'icon-book-open', 'post', '0', '1', '1,2', '1'), ('5', 'Create Post', 'icon-plus', 'post.create', '4', '1', '1,2', '1'), ('6', 'All Posts', 'icon-list', 'post.index', '4', '2', '1,2', '1'), ('7', 'Page', 'icon-notebook', 'page', '0', '2', '1,2', '1'), ('8', 'Create Page', 'icon-plus', 'page.create', '7', '1', '1,2', '1'), ('9', 'Create iStay', 'icon-note', 'page.landing', '7', '1', '1,2', '1'), ('10', 'Create Room', 'icon-note', 'page.room', '7', '1', '1,2', '1'), ('11', 'All Pages', 'icon-list', 'page.index', '7', '2', '1,2', '1'), ('12', 'Users', 'icon-user', 'user', '0', '6', '1', '1'), ('13', 'Create User', 'icon-user-follow', 'user.create', '12', '1', '1', '1'), ('14', 'All User', 'icon-users', 'user.index', '12', '2', '1', '1'), ('15', 'Themes', 'icon-globe', 'setting', '0', '7', '1,2', '1'), ('16', 'Menu', 'icon-diamond', 'setting.menu', '15', '1', '1,2', '0'), ('17', 'Setting English', 'icon-settings', 'setting.index', '15', '2', '1,2', '1'), ('18', 'Comment', 'icon-bubble', 'comment', '0', '3', '1,2', '1'), ('19', 'Create comment', 'icon-plus', 'comment.create', '18', '1', '1,2', '1'), ('20', 'All', 'icon-list', 'comment.index', '18', '2', '1,2', '1'), ('21', 'Services', 'icon-badge', 'services', '0', '4', '1,2', '1'), ('22', 'Create Services', 'icon-plus', 'services.create', '21', '1', '1,2', '1'), ('23', 'All', 'icon-list', 'services.index', '21', '2', '1,2', '1'), ('24', 'Contact', 'icon-envelope-open', 'contact.index', '0', '5', '1,2', '1'), ('25', 'Setting Korea', 'icon-settings', 'setting.korea', '15', '3', '1,2', '1'), ('26', 'Setting VN', 'icon-settings', 'setting.vietnam', '15', '4', '1,2', '1');
COMMIT;

-- ----------------------------
--  Table structure for `meta_field`
-- ----------------------------
DROP TABLE IF EXISTS `meta_field`;
CREATE TABLE `meta_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_value` text COLLATE utf8mb4_unicode_ci,
  `article_content_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_field_article_content_id_foreign` (`article_content_id`),
  CONSTRAINT `meta_field_article_content_id_foreign` FOREIGN KEY (`article_content_id`) REFERENCES `article_content` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `meta_field`
-- ----------------------------
BEGIN;
INSERT INTO `meta_field` VALUES ('1', 'range-price', '100$ - 200$', '1'), ('2', 'address', 'No.32, Lane 2, Tran Van Lai Str., Nam Tu Liem dtr., Hanoi', '1'), ('3', 'hotline', '098 168 8118', '1'), ('4', 'google-map', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.058569015825!2d105.78363901549474!3d21.030342385997418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4c70363217%3A0xb4db4afa8230b580!2zMyBQaOG7kSBEdXkgVMOibiwgROG7i2NoIFbhu41uZyBI4bqtdSwgQ-G6p3UgR2nhuqV5LCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1541419130975\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '1'), ('5', 'overview-title', 'Overview Title', '1'), ('6', 'overview-content', 'Overview Content', '1'), ('7', 'feature-heading', 'Feature Heading', '1'), ('8', 'about1-title', 'About Title 1', '1'), ('9', 'about1-description', 'About Description 1', '1'), ('10', 'about2-title', 'About Title 2', '1'), ('11', 'about2-description', 'About Description 2', '1'), ('12', 'gallery-heading', 'Gallery Heading', '1'), ('13', 'gallery-image-1', '/uploads/fields/2018/11/20181102205730-6.jpg', '1'), ('14', 'gallery-image-4', '/uploads/fields/2018/11/20181102205730-3.jpg', '1'), ('15', 'gallery-image-2', '/uploads/fields/2018/11/20181102205730-1.jpg', '1'), ('16', 'gallery-image-5', '/uploads/fields/2018/11/20181102205730-4.jpg', '1'), ('17', 'gallery-image-3', '/uploads/fields/2018/11/20181102205730-2.jpg', '1'), ('18', 'gallery-image-6', '/uploads/fields/2018/11/20181102205730-5.jpg', '1'), ('19', 'overview-title', 'Overview Title room 1', '2'), ('20', 'overview-content', 'Overview Content room 1', '2'), ('21', 'about1-title', 'About Title 1 room 1', '2'), ('22', 'about1-description', 'About Description 1 room 1', '2'), ('23', 'gallery-heading', 'Gallery Heading room 1', '2'), ('24', 'gallery-image-1', '/uploads/fields/2018/11/20181102211033-9.jpg', '2'), ('25', 'gallery-image-4', '/uploads/fields/2018/11/20181102211033-6.jpg', '2'), ('26', 'gallery-image-2', '/uploads/fields/2018/11/20181102211033-8.jpg', '2'), ('27', 'gallery-image-5', '/uploads/fields/2018/11/20181102211033-5.jpg', '2'), ('28', 'gallery-image-3', '/uploads/fields/2018/11/20181102211033-7.jpg', '2'), ('29', 'gallery-image-6', '/uploads/fields/2018/11/20181102211033-4.jpg', '2'), ('30', 'gallery-heading', 'Gallery Heading room 2', '3'), ('31', 'gallery-image-1', '/uploads/fields/2018/11/20181102212541-1.jpg', '3'), ('32', 'gallery-image-4', '/uploads/fields/2018/11/20181102212541-4.jpg', '3'), ('33', 'gallery-image-2', '/uploads/fields/2018/11/20181102212541-2.jpg', '3'), ('34', 'gallery-image-5', '/uploads/fields/2018/11/20181102212541-5.jpg', '3'), ('35', 'gallery-image-3', '/uploads/fields/2018/11/20181102212541-3.jpg', '3'), ('36', 'gallery-image-6', '/uploads/fields/2018/11/20181102212541-7.jpg', '3'), ('37', 'gallery-heading', 'Gallery Heading 3', '4'), ('38', 'gallery-image-1', '/uploads/fields/2018/11/20181102212714-5.jpg', '4'), ('39', 'gallery-image-2', '/uploads/fields/2018/11/20181102212714-8.jpg', '4'), ('40', 'gallery-image-3', '/uploads/fields/2018/11/20181102212714-6.jpg', '4'), ('41', 'range-price', '200 - 300$', '5'), ('42', 'address', 'Add: No.12 alley 39 Dinh Thon, My Dinh, Nam Tu Liem', '5'), ('43', 'hotline', '0981688118', '5'), ('44', 'feature-heading', 'Feature Heading', '5'), ('45', 'about1-title', 'About Title 1', '5'), ('46', 'about1-description', 'About Description 1', '5'), ('47', 'gallery-heading', 'Gallery Heading', '5'), ('48', 'gallery-image-1', '/uploads/fields/2018/11/20181103080340-1.jpg', '5'), ('49', 'gallery-image-4', '/uploads/fields/2018/11/20181103080340-4.jpg', '5'), ('50', 'gallery-image-2', '/uploads/fields/2018/11/20181103080340-2.jpg', '5'), ('51', 'gallery-image-5', '/uploads/fields/2018/11/20181103080340-5.jpg', '5'), ('52', 'gallery-image-3', '/uploads/fields/2018/11/20181103080340-3.jpg', '5'), ('53', 'gallery-image-6', '/uploads/fields/2018/11/20181103080340-8.jpg', '5');
COMMIT;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('201', '2014_10_12_000000_create_users_table', '1'), ('202', '2014_10_12_100000_create_password_resets_table', '1'), ('203', '2016_06_01_000001_create_oauth_auth_codes_table', '1'), ('204', '2016_06_01_000002_create_oauth_access_tokens_table', '1'), ('205', '2016_06_01_000003_create_oauth_refresh_tokens_table', '1'), ('206', '2016_06_01_000004_create_oauth_clients_table', '1'), ('207', '2016_06_01_000005_create_oauth_personal_access_clients_table', '1'), ('208', '2017_08_16_045421_create_menu_system_table', '1'), ('209', '2017_09_10_220943_create_articles_table', '1'), ('210', '2017_09_10_221006_create_category_table', '1'), ('211', '2017_09_10_221017_create_article_category_table', '1'), ('212', '2017_09_24_212525_create_menu_table', '1'), ('213', '2017_09_24_214045_create_menu_group_table', '1'), ('214', '2017_11_13_074422_create_options_table', '1'), ('215', '2018_08_09_042738_create_system_link_type_table', '1'), ('216', '2018_10_21_021921_create_article_content_table', '1'), ('217', '2018_10_21_022942_create_category_content_table', '1'), ('218', '2018_10_22_224317_create_meta_field_table', '1'), ('219', '2018_10_29_021127_create_comment_table', '1'), ('220', '2018_10_29_021152_create_comment_content_table', '1'), ('221', '2018_10_29_021230_create_services_table', '1'), ('222', '2018_10_29_021250_create_services_content_table', '1'), ('223', '2018_10_29_022115_create_contact_table', '1'), ('224', '2018_11_01_202932_create_article_services_table', '1');
COMMIT;

-- ----------------------------
--  Table structure for `oauth_access_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `oauth_auth_codes`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `oauth_clients`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `oauth_personal_access_clients`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `oauth_refresh_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `options`
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `options`
-- ----------------------------
BEGIN;
INSERT INTO `options` VALUES ('2', 'hotline', '0981688118', 'en'), ('3', 'email', 'hungnv6933@co-well.com.vn', 'en'), ('4', 'company_name', 'iStay Hotel Apartment', 'en'), ('5', 'company_description', 'Istay Serviced Apartment - High quality serviced apartment, customised to suit the needs and distinct tastes of today’s modern travellers, \r\nand have been a market leader in developing and operating innovative urban living spaces in Hanoi since 2016.\r\n\r\niStay1: No.34 alley 2 Tran Van Lai, My Dinh 1, Nam Tu Liem\r\niStay2: No.12 alley 39 Dinh Thon, My Dinh, Nam Tu Liem\r\niStay3: No.156 Dinh Thon, My Dinh 1, Nam Tu Liem\r\niStay5: No.45 alley 4 Dong Me street, Me Tri, Nam Tu Liem\r\niStay6: No. 3 alley 148 Tran Duy Hung, Cau Giay\r\nEmail: info@istay.vn', 'en'), ('6', 'meta_title', 'He thong khach san istay', 'en'), ('7', 'meta_description', 'He thong khach san istay', 'en'), ('8', 'promotion_heading', 'The owner of the hotel or business ?', 'en'), ('9', 'promotion_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.', 'en'), ('10', 'promotion_booking_label', 'Booking now', 'en'), ('11', 'company_logo', '/uploads/setting/2018/11/20181103032317-xuyen-1-1.png', 'en'), ('12', 'search_heading', 'EasyBook Hotel Booking System', 'en'), ('13', 'search_description', 'Let\'s start exploring the world together with EasyBook', 'en'), ('14', 'search_when_label', 'When', 'en'), ('15', 'search_where_label', 'Where', 'en'), ('16', 'search_label_direct', 'Search', 'en'), ('17', 'about_heading', 'About iStay Services Apartment', 'en'), ('18', 'about_description', 'Istay Serviced Apartment - High quality serviced apartment,  customised to suit the needs and distinct tastes of today’s modern travellers, \r\nand have been a market leader in developing and operating innovative urban living spaces in Hanoi since 2016.', 'en'), ('19', 'comment_heading', 'Feedback', 'en'), ('20', 'comment_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.', 'en'), ('21', 'promotion_background', '/uploads/setting/2018/11/20181103033001-14.jpg', 'en'), ('22', 'search_background', '/uploads/setting/2018/11/20181103033001-22.jpg', 'en'), ('23', 'hotline', '0981.645.688', 'vi'), ('25', 'company_name', 'Công ty test', 'vi'), ('26', 'company_description', 'desc test', 'vi'), ('27', 'meta_title', 'Công ty test', 'vi'), ('28', 'meta_description', 'Công ty test', 'vi'), ('29', 'promotion_heading', 'Khuyến mại hấp dẫn tháng 12', 'vi'), ('30', 'promotion_description', 'Đăng ký ngay để nhận được chuyến du lịch miễn phí', 'vi');
COMMIT;

-- ----------------------------
--  Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_username_index` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `services`
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_user_id_foreign` (`user_id`),
  CONSTRAINT `services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `services`
-- ----------------------------
BEGIN;
INSERT INTO `services` VALUES ('1', 'fal fa-rocket', '1', '2018-11-01 20:35:55', '2018-11-01 20:35:55'), ('2', 'fal fa-wifi', '1', '2018-11-01 20:36:17', '2018-11-01 20:36:17'), ('3', 'fal fa-parking', '1', '2018-11-01 20:36:35', '2018-11-01 20:36:35'), ('4', 'fal fa-snowflake', '1', '2018-11-01 20:36:52', '2018-11-01 20:36:52'), ('5', 'fal fa-plane', '1', '2018-11-01 20:37:05', '2018-11-01 20:37:05'), ('6', 'fal fa-paw', '1', '2018-11-01 20:37:21', '2018-11-01 20:37:21'), ('7', 'fal fa-utensils', '1', '2018-11-01 20:37:34', '2018-11-01 20:37:34'), ('8', 'fal fa-wheelchair', '1', '2018-11-01 20:37:48', '2018-11-01 20:37:48');
COMMIT;

-- ----------------------------
--  Table structure for `services_content`
-- ----------------------------
DROP TABLE IF EXISTS `services_content`;
CREATE TABLE `services_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `services_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `services_content_services_id_foreign` (`services_id`),
  CONSTRAINT `services_content_services_id_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `services_content`
-- ----------------------------
BEGIN;
INSERT INTO `services_content` VALUES ('1', 'en', '1', 'Elevator in building'), ('2', 'en', '2', 'Free Wi Fi'), ('3', 'en', '3', 'Free Parking'), ('4', 'en', '4', 'Air Conditioned'), ('5', 'en', '5', 'Airport Shuttle'), ('6', 'en', '6', 'Pet Friendly'), ('7', 'en', '7', 'Restaurant Inside'), ('8', 'en', '8', 'Wheelchair Friendly');
COMMIT;

-- ----------------------------
--  Table structure for `system_link_type`
-- ----------------------------
DROP TABLE IF EXISTS `system_link_type`;
CREATE TABLE `system_link_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_link_type_prefix_unique` (`prefix`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `system_link_type`
-- ----------------------------
BEGIN;
INSERT INTO `system_link_type` VALUES ('1', 'Category Details', 'category', null, null), ('2', 'Post Details', 'post', null, null), ('3', 'Page Details', 'page', null, null), ('4', 'Landing', '', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1.administrator 2.support',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'hung.nguyen', 'admin', '$2y$10$Rs2F8rk3erptBEnoGPCiMe8ciwCFrKC6CVLapx/p3ex5PcSunx0tG', '1', null, null, null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
