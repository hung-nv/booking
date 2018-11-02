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

 Date: 11/02/2018 07:00:58 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `article_content`
-- ----------------------------
BEGIN;
INSERT INTO `article_content` VALUES ('5', '5', 'en', 'ISTAY SERVICED APARTMENT 1', null, '', null, null, null), ('6', '5', 'ko', 'istay serviced apartment 1 korea', null, '', 'meta istay serviced apartment 1 korea', 'description istay serviced apartment 1 korea', null), ('7', '5', 'vi', 'Khach san istay1', null, '', 'title Khach san istay1', 'desc Khach san istay1', null);
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
INSERT INTO `article_services` VALUES ('5', '1'), ('5', '2'), ('5', '3'), ('5', '4'), ('5', '5'), ('5', '6'), ('5', '7'), ('5', '8');
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
  `user_id` int(10) unsigned NOT NULL,
  `system_link_type_id` tinyint(4) NOT NULL,
  `landing_type` tinyint(4) DEFAULT NULL COMMENT '1.istay 2.room',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_user_id_foreign` (`user_id`),
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `articles`
-- ----------------------------
BEGIN;
INSERT INTO `articles` VALUES ('5', 'istay-serviced-apartment-1', '/uploads/posts/2018/11/20181101230049-7.jpg', '0', '0', '1', '4', '1', '1', '2018-11-01 23:00:49', '2018-11-01 23:00:49');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `menu_system`
-- ----------------------------
BEGIN;
INSERT INTO `menu_system` VALUES ('1', 'Category', 'icon-grid', 'category', '0', '0', '1,2', '1'), ('2', 'Create Category', 'icon-plus', 'category.create', '1', '1', '1,2', '1'), ('3', 'All Category', 'icon-list', 'category.index', '1', '2', '1,2', '1'), ('4', 'Post', 'icon-book-open', 'post', '0', '1', '1,2', '1'), ('5', 'Create Post', 'icon-plus', 'post.create', '4', '1', '1,2', '1'), ('6', 'All Posts', 'icon-list', 'post.index', '4', '2', '1,2', '1'), ('7', 'Page', 'icon-notebook', 'page', '0', '2', '1,2', '1'), ('8', 'Create Page', 'icon-plus', 'page.create', '7', '1', '1,2', '1'), ('9', 'Create iStay', 'icon-note', 'page.landing', '7', '1', '1,2', '1'), ('10', 'Create Room', 'icon-note', 'page.room', '7', '1', '1,2', '1'), ('11', 'All Pages', 'icon-list', 'page.index', '7', '2', '1,2', '1'), ('12', 'Users', 'icon-user', 'user', '0', '6', '1', '1'), ('13', 'Create User', 'icon-user-follow', 'user.create', '12', '1', '1', '1'), ('14', 'All User', 'icon-users', 'user.index', '12', '2', '1', '1'), ('15', 'Themes', 'icon-globe', 'setting', '0', '7', '1,2', '1'), ('16', 'Menu', 'icon-diamond', 'setting.menu', '15', '1', '1,2', '1'), ('17', 'Setting', 'icon-settings', 'setting.index', '15', '2', '1,2', '1'), ('18', 'Comment', 'icon-globe', 'comment', '0', '3', '1,2', '1'), ('19', 'Create comment', 'icon-plus', 'comment.create', '18', '1', '1,2', '1'), ('20', 'All', 'icon-list', 'comment.index', '18', '2', '1,2', '1'), ('21', 'Services', 'icon-globe', 'services', '0', '4', '1,2', '1'), ('22', 'Create Services', 'icon-plus', 'services.create', '21', '1', '1,2', '1'), ('23', 'All', 'icon-list', 'services.index', '21', '2', '1,2', '1'), ('24', 'Contact', 'icon-globe', 'contact.index', '0', '5', '1,2', '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `meta_field`
-- ----------------------------
BEGIN;
INSERT INTO `meta_field` VALUES ('6', 'range-price', '100 - 200$', '5'), ('7', 'address', '0981688118', '5'), ('8', 'overview-title', 'Overview', '5'), ('9', 'overview-content', 'Located in the central business district and crowded residential area of The Manor, Me Tri - My Dinh, Istay 1 Serviced Apartment is always an ideal stopover for your vacation and business trip in Hanoi. Located in a prime location, with luxury furnitures and friendly staffs, Istay 1 Serviced Apeartment offers a comfortable living space like in your own home.\r\nIstay 1 offers serviced apartments with an area of 25m2 to 45m2, at reasonable rents ranging from $400 - $620 per month, $25 - $30 per day.', '5'), ('10', 'feature-heading', 'Features', '5'), ('11', 'about1-title', 'iStay  Bath', '5'), ('12', 'about1-description', 'Towel wamer and fog- free mirrors.\r\nIstay toiletries', '5'), ('13', 'about2-title', 'iStay Sleep', '5'), ('14', 'about2-description', 'Blanket and drap Everon Korea\r\nFeather down pillows\r\nPremier simmons mattress Everon Korea\r\nBaby soft slippers', '5'), ('15', 'gallery-heading', 'Gallery', '5'), ('16', 'gallery-image-1', '/uploads/fields/2018/11/20181101230049-1.jpg', '5'), ('17', 'gallery-image-4', '/uploads/fields/2018/11/20181101230049-5.jpg', '5'), ('18', 'gallery-image-2', '/uploads/fields/2018/11/20181101230049-2.jpg', '5'), ('19', 'gallery-image-5', '/uploads/fields/2018/11/20181101230049-5.jpg', '5'), ('20', 'gallery-image-3', '/uploads/fields/2018/11/20181101230049-3.jpg', '5'), ('21', 'gallery-image-6', '/uploads/fields/2018/11/20181101230049-6.jpg', '5'), ('25', 'range-price', '도와주세요', '6'), ('26', 'overview-title', '안녕하새요!', '6'), ('27', 'overview-content', '당신의 전화기를 빌릴수 있을까요?당신의 전화기를 빌릴수 있을까요?당신의 전화기를 빌릴수 있을까요?당신의 전화기를 빌릴수 있을까요?당신의 전화기를 빌릴수 있을까요?\r\n당신의 전화기를 빌릴수 있을까요?당신의 전화기를 빌릴수 있을까요?당신의 전화기를 빌릴수 있을까요?', '6'), ('28', 'feature-heading', '도와주세요', '6'), ('29', 'about1-title', '대사관이 어디에 있어요?', '6'), ('30', 'about1-description', '지갑을 잃어 버렸어요 지갑을 잃어 버렸어요지갑을 잃어 버렸어요지갑을 잃어 버렸어요지갑을 잃어 버렸어요', '6'), ('31', 'about2-title', '대사관이 어디에 있어요?', '6'), ('32', 'about2-description', '지갑을 잃어 버렸어요 지갑을 잃어 버렸어요지갑을 잃어 버렸어요지갑을 잃어 버렸어요지갑을 잃어 버렸어요', '6'), ('33', 'about3-title', '대사관이 어디에 있어요?', '6'), ('34', 'about3-description', '지갑을 잃어 버렸어요 지갑을 잃어 버렸어요지갑을 잃어 버렸어요지갑을 잃어 버렸어요지갑을 잃어 버렸어요', '6'), ('35', 'about4-title', '대사관이 어디에 있어요?', '6'), ('36', 'about4-description', '지갑을 잃어 버렸어요 지갑을 잃어 버렸어요지갑을 잃어 버렸어요지갑을 잃어 버렸어요지갑을 잃어 버렸어요', '6'), ('37', 'gallery-heading', '물 좀 주세요', '6'), ('38', 'range-price', '5tr - 10tr', '7'), ('39', 'overview-title', 'Overview Title vn', '7'), ('40', 'overview-content', 'Overview Content vn', '7'), ('41', 'feature-heading', 'heading vn', '7'), ('42', 'gallery-heading', 'Gallery Heading vn', '7');
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
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('177', '2014_10_12_000000_create_users_table', '1'), ('178', '2014_10_12_100000_create_password_resets_table', '1'), ('179', '2016_06_01_000001_create_oauth_auth_codes_table', '1'), ('180', '2016_06_01_000002_create_oauth_access_tokens_table', '1'), ('181', '2016_06_01_000003_create_oauth_refresh_tokens_table', '1'), ('182', '2016_06_01_000004_create_oauth_clients_table', '1'), ('183', '2016_06_01_000005_create_oauth_personal_access_clients_table', '1'), ('184', '2017_08_16_045421_create_menu_system_table', '1'), ('185', '2017_09_10_220943_create_articles_table', '1'), ('186', '2017_09_10_221006_create_category_table', '1'), ('187', '2017_09_10_221017_create_article_category_table', '1'), ('188', '2017_09_24_212525_create_menu_table', '1'), ('189', '2017_09_24_214045_create_menu_group_table', '1'), ('190', '2017_11_13_074422_create_options_table', '1'), ('191', '2018_08_09_042738_create_system_link_type_table', '1'), ('192', '2018_10_21_021921_create_article_content_table', '1'), ('193', '2018_10_21_022942_create_category_content_table', '1'), ('194', '2018_10_22_224317_create_meta_field_table', '1'), ('195', '2018_10_29_021127_create_comment_table', '1'), ('196', '2018_10_29_021152_create_comment_content_table', '1'), ('197', '2018_10_29_021230_create_services_table', '1'), ('198', '2018_10_29_021250_create_services_content_table', '1'), ('199', '2018_10_29_022115_create_contact_table', '1'), ('200', '2018_11_01_202932_create_article_services_table', '1');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
INSERT INTO `users` VALUES ('1', 'hung.nguyen', 'admin', '$2y$10$Zd2SjvmZF.CczZHX1iFWieypPXXUvoElECHcn3Lg9VhrxQ3LltB3K', '1', null, null, null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
