-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2018 at 05:30 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.8-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flipmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_field`
--

CREATE TABLE `advance_field` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_link_type_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `article_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_group`
--

CREATE TABLE `article_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_tag`
--

CREATE TABLE `article_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Color', NULL, NULL),
(2, 'Size', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` int(10) UNSIGNED NOT NULL,
  `attr_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attr_value`, `attribute_id`, `created_at`, `updated_at`) VALUES
(2, 'White', 1, '2018-09-11 21:47:01', '2018-09-11 21:47:01'),
(3, 'Blue', 1, '2018-09-12 00:01:52', '2018-09-12 00:01:52'),
(4, 'Green', 1, '2018-09-12 00:01:59', '2018-09-12 00:01:59'),
(5, 'Red', 1, '2018-09-12 00:02:05', '2018-09-12 00:02:05'),
(6, 'Yellow', 1, '2018-09-12 00:02:24', '2018-09-12 00:02:24'),
(7, 'Black', 1, '2018-09-12 00:02:42', '2018-09-12 00:02:42'),
(8, 'S', 2, '2018-09-12 00:02:53', '2018-09-12 00:02:53'),
(9, 'M', 2, '2018-09-12 00:02:55', '2018-09-12 00:02:55'),
(10, 'L', 2, '2018-09-12 00:02:57', '2018-09-12 00:02:57'),
(11, 'XL', 2, '2018-09-12 00:02:59', '2018-09-12 00:02:59'),
(12, 'XXL', 2, '2018-09-12 00:03:02', '2018-09-12 00:03:02'),
(13, 'XS', 2, '2018-09-12 00:03:15', '2018-09-12 00:03:15'),
(14, 'Pink', 1, '2018-09-12 00:58:56', '2018-09-12 00:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `system_link_type_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `parent_id`, `image`, `icon`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `sort`, `system_link_type_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Thời trang nữ', 'thoi-trang-nu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:12:07', '2018-09-12 00:12:07', 1),
(2, 'Phụ kiện thời trang', 'phu-kien-thoi-trang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:12:35', '2018-09-12 00:12:35', 1),
(3, 'Sức khỏe & Làm đẹp', 'suc-khoe-lam-dep', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:12:45', '2018-09-12 00:12:45', 1),
(4, 'Quà tặng', 'qua-tang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:12:57', '2018-09-12 00:12:57', 1),
(5, 'Đầm, Váy', 'dam-vay', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:13:19', '2018-09-12 00:15:20', 1),
(7, 'Áo nữ', 'ao-nu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:15:34', '2018-09-12 00:15:34', 1),
(8, 'Quần nữ', 'quan-nu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:15:57', '2018-09-12 00:15:57', 1),
(9, 'Áo khoác nữ', 'ao-khoac-nu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:16:10', '2018-09-12 00:16:10', 1),
(10, 'Đồ mặc nhà, đồ ngủ', 'do-mac-nha-do-ngu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:16:36', '2018-09-12 00:16:36', 1),
(11, 'Đồ bơi, đồ đi biển', 'do-boi-do-di-bien', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:16:47', '2018-09-12 00:16:47', 1),
(12, 'Chân váy', 'chan-vay', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:17:58', '2018-09-12 00:17:58', 1),
(13, 'Quần áo thể thao nữ', 'quan-ao-the-thao-nu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:18:07', '2018-09-12 00:18:07', 1),
(14, 'Set bộ, jumpsuit', 'set-bo-jumpsuit', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:18:37', '2018-09-12 00:18:37', 1),
(15, 'Áo sơ mi nữ', 'ao-so-mi-nu', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:29:16', '2018-09-12 00:29:16', 1),
(16, 'Áo trễ vai', 'ao-tre-vai', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:29:28', '2018-09-12 00:29:28', 1),
(17, 'Áo ren', 'ao-ren', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:30:08', '2018-09-12 00:30:08', 1),
(18, 'Áo thun, áo polo nữ', 'ao-thun-ao-polo-nu', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:30:29', '2018-09-12 00:30:29', 1),
(19, 'Áo 2 dây, áo quây', 'ao-2-day-ao-quay', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:30:53', '2018-09-12 00:30:53', 1),
(20, 'Áo hoodie nữ', 'ao-hoodie-nu', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:31:15', '2018-09-12 00:31:15', 1),
(21, 'Áo denim nữ', 'ao-denim-nu', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:31:42', '2018-09-12 00:31:42', 1),
(22, 'Áo len', 'ao-len', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:31:51', '2018-09-12 00:31:51', 1),
(23, 'Áo peplum', 'ao-peplum', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:32:56', '2018-09-12 00:32:56', 1),
(24, 'Đầm ren', 'dam-ren', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:33:42', '2018-09-12 00:33:42', 1),
(25, 'Đầm xòe', 'dam-xoe', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:33:50', '2018-09-12 00:33:50', 1),
(26, 'Đầm suông', 'dam-suong', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:33:58', '2018-09-12 00:33:58', 1),
(27, 'Đầm ôm', 'dam-om', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:34:12', '2018-09-12 00:34:12', 1),
(28, 'Đầm maxi', 'dam-maxi', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:34:21', '2018-09-12 00:34:21', 1),
(29, 'Váy công sở', 'vay-cong-so', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:34:32', '2018-09-12 00:34:32', 1),
(30, 'Váy da hội, dự tiệc', 'vay-da-hoi-du-tiec', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:35:06', '2018-09-12 00:35:06', 1),
(31, 'Váy thun', 'vay-thun', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:35:26', '2018-09-12 00:35:26', 1),
(32, 'Váy trễ vai', 'vay-tre-vai', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:35:35', '2018-09-12 00:35:35', 1),
(33, 'Váy xếp ly', 'vay-xep-ly', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:36:16', '2018-09-12 00:36:59', 1),
(34, 'Váy denim', 'vay-denim', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:36:25', '2018-09-12 00:36:25', 1),
(35, 'Váy len', 'vay-len', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:36:46', '2018-09-12 00:36:46', 1),
(36, 'Đầm, váy khác', 'dam-vay-khac', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, '2018-09-12 00:37:39', '2018-09-12 00:37:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1.draft 0.published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `value`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Home Slide', NULL, NULL, 1),
(2, 'Hot', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_information`
--

CREATE TABLE `member_information` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'true:default shipping address'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `direct` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_group_id` int(11) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `prefix` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_link_type_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `slug`, `parent_id`, `direct`, `route`, `menu_group_id`, `sort`, `prefix`, `system_link_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Thời trang nữ', 'thoi-trang-nu', NULL, NULL, NULL, 1, 0, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:50:44'),
(2, 'Đầm, Váy', 'dam-vay', 1, NULL, NULL, 1, 1, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:00'),
(3, 'Áo nữ', 'ao-nu', 1, NULL, NULL, 1, 2, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:01'),
(4, 'Quần nữ', 'quan-nu', 1, NULL, NULL, 1, 3, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:02'),
(5, 'Áo khoác nữ', 'ao-khoac-nu', 1, NULL, NULL, 1, 4, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:03'),
(6, 'Đồ mặc nhà, đồ ngủ', 'do-mac-nha-do-ngu', 1, NULL, NULL, 1, 5, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:05'),
(7, 'Đồ bơi, đồ đi biển', 'do-boi-do-di-bien', 1, NULL, NULL, 1, 6, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:06'),
(8, 'Chân váy', 'chan-vay', 1, NULL, NULL, 1, 7, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:07'),
(9, 'Quần áo thể thao nữ', 'quan-ao-the-thao-nu', 1, NULL, NULL, 1, 8, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:08'),
(10, 'Set bộ, jumpsuit', 'set-bo-jumpsuit', 1, NULL, NULL, 1, 9, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:11'),
(11, 'Phụ kiện thời trang', 'phu-kien-thoi-trang', NULL, NULL, NULL, 1, 1, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:11'),
(12, 'Sức khỏe & Làm đẹp', 'suc-khoe-lam-dep', NULL, NULL, NULL, 1, 2, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:11'),
(13, 'Quà tặng', 'qua-tang', NULL, NULL, NULL, 1, 3, '', 4, '2018-09-12 00:50:44', '2018-09-12 00:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`id`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Top Menu', '2018-09-12 00:50:21', '2018-09-12 00:50:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_system`
--

CREATE TABLE `menu_system` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `show` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1,2',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_system`
--

INSERT INTO `menu_system` (`id`, `label`, `icon`, `route`, `parent_id`, `sort`, `show`, `status`) VALUES
(1, 'Category', 'icon-grid', 'category', 0, 0, '1,2', 1),
(2, 'Create Category', 'icon-plus', 'category.create', 1, 1, '1,2', 1),
(3, 'All Category', 'icon-list', 'category.index', 1, 2, '1,2', 1),
(4, 'Post', 'icon-book-open', 'post', 0, 0, '1,2', 1),
(5, 'Create Post', 'icon-plus', 'post.create', 4, 1, '1,2', 1),
(6, 'All Posts', 'icon-list', 'post.index', 4, 2, '1,2', 1),
(7, 'Page', 'icon-notebook', 'page', 0, 0, '1,2', 1),
(8, 'Create Page', 'icon-plus', 'page.create', 7, 1, '1,2', 1),
(9, 'Create Landing Page', 'icon-note', 'page.landing', 7, 1, '1,2', 1),
(10, 'All Pages', 'icon-list', 'page.index', 7, 2, '1,2', 1),
(11, 'Custom field', 'icon-puzzle', 'advanceField', 0, 0, '1', 1),
(12, 'Create Field', 'icon-plus', 'advanceField.create', 11, 1, '1', 1),
(13, 'All Custom Field', 'icon-list', 'advanceField.index', 11, 2, '1', 1),
(14, 'Products', 'icon-handbag', 'product', 0, 0, '1,2', 1),
(15, 'Create Product', 'icon-plus', 'product.create', 14, 0, '1,2', 1),
(16, 'All Products', 'icon-list', 'product.index', 14, 0, '1,2', 1),
(17, 'Attributes', 'icon-tag', 'attributeValue.index', 14, 0, '1,2', 1),
(18, 'Users', 'icon-user', 'user', 0, 0, '1', 1),
(19, 'Create User', 'icon-user-follow', 'user.create', 18, 1, '1', 1),
(20, 'All User', 'icon-users', 'user.index', 18, 2, '1', 1),
(21, 'Themes', 'icon-globe', 'setting', 0, 0, '1,2', 1),
(22, 'Menu', 'icon-diamond', 'setting.menu', 21, 1, '1,2', 1),
(23, 'Setting', 'icon-settings', 'setting.index', 21, 2, '1,2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meta_field`
--

CREATE TABLE `meta_field` (
  `id` int(10) UNSIGNED NOT NULL,
  `key_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_value` text COLLATE utf8mb4_unicode_ci,
  `article_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(281, '2017_10_12_225924_create_branch_table', 1),
(286, '2014_10_12_000000_create_users_table', 2),
(287, '2014_10_12_100000_create_password_resets_table', 2),
(288, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(289, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(290, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(291, '2016_06_01_000004_create_oauth_clients_table', 2),
(292, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(293, '2017_08_16_045421_create_menu_system_table', 2),
(294, '2017_09_10_220943_create_articles_table', 2),
(295, '2017_09_10_221006_create_category_table', 2),
(296, '2017_09_10_221017_create_article_category_table', 2),
(297, '2017_09_12_165520_create_tags_table', 2),
(298, '2017_09_12_165607_create_article_tag_table', 2),
(299, '2017_09_17_092109_create_advance_field_table', 2),
(300, '2017_09_17_092158_create_meta_field_table', 2),
(301, '2017_09_17_233557_create_groups_table', 2),
(302, '2017_09_17_233651_create_article_group_table', 2),
(303, '2017_09_24_212525_create_menu_table', 2),
(304, '2017_09_24_214045_create_menu_group_table', 2),
(305, '2017_10_11_103824_create_attributes_table', 2),
(306, '2017_10_11_103856_create_attribute_values_table', 2),
(307, '2017_10_11_110111_create_members_table', 2),
(308, '2017_10_11_110126_create_member_information_table', 2),
(309, '2017_10_11_110139_create_products_table', 2),
(310, '2017_10_11_110152_create_product_catagory_table', 2),
(311, '2017_10_11_110226_create_product_tag_table', 2),
(312, '2017_10_11_110244_create_product_images_table', 2),
(313, '2017_10_11_110304_create_product_attribute_value_table', 2),
(314, '2017_10_11_151416_create_orders_table', 2),
(315, '2017_10_11_151425_create_order_products_table', 2),
(316, '2017_10_11_155311_create_order_product_details_table', 2),
(317, '2017_10_11_172231_create_order_product_attributes_table', 2),
(318, '2017_10_11_172249_create_order_product_attribute_groups_table', 2),
(319, '2017_10_11_172337_create_order_attribute_images_table', 2),
(320, '2017_11_09_172417_create_events_table', 2),
(321, '2017_11_09_172432_create_product_event_table', 2),
(322, '2017_11_13_074422_create_options_table', 2),
(323, '2018_08_09_042738_create_system_link_type_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `key`, `value`) VALUES
(1, 'site_heading', 'Shop chuyên quần áo nam nữ'),
(2, 'parent', '5,7,8,9,10,13'),
(3, 'meta_title', 'Meta Title'),
(4, 'meta_description', 'Description'),
(5, 'meta_keywords', 'Keywords'),
(6, 'main_menu_id', '1'),
(11, 'banner_image_1', ''),
(12, 'banner_image_2', ''),
(13, 'banner_image_3', ''),
(14, 'banner_image_4', ''),
(15, 'selectedCatalog', '15,16,17,18,22');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `total_money` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address_id` int(10) UNSIGNED NOT NULL,
  `shipping_address_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1.wait confirm 2.approved 3.finish 4.cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_attribute_images`
--

CREATE TABLE `order_attribute_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_product_attribute_id` int(10) UNSIGNED NOT NULL,
  `order_product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantities` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product_attributes`
--

CREATE TABLE `order_product_attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `attr_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product_attribute_groups`
--

CREATE TABLE `order_product_attribute_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_product_detail_id` int(10) UNSIGNED NOT NULL,
  `order_product_attribute_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product_details`
--

CREATE TABLE `order_product_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_product_id` int(10) UNSIGNED NOT NULL,
  `quantities` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `new_price` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `in_stock` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `slug`, `special`, `description`, `content`, `cover_image`, `price`, `new_price`, `user_id`, `in_stock`, `meta_title`, `meta_description`, `meta_keywords`, `view`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'sm01', 'Sơ mi kẻ sọc SM01 Hàng nhập', 'so-mi-ke-soc-sm01-hang-nhap', NULL, 'Chất vải: Kate\r\nChiều dài tay áo: Tay dài\r\nHọa tiết: Sọc kẻ.\r\nPhong cách: Công sở.', '<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">M&atilde; sản phẩm :sm01</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">k&iacute;ch thước :s-2xl</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Th&iacute;ch hợp: đi biển, dự tiệc, d&atilde; ngoại...</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">H&agrave;ng nhập trực tiếp từ xưởng nước ngo&agrave;i đảm bảo chất lượng.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Hướng dẫn chọn size</span><br />\r\n&nbsp;</p>\r\n\r\n<p>⚛️<span style=\"color:rgb(153, 51, 102)\">&nbsp;Cam kết của shop</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:blue\">Sản phẩm giống h&igrave;nh 100%.</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:rgb(49, 23, 241)\">Đ&acirc;y l&agrave; h&agrave;ng shop nhập trực tiếp kh&ocirc;ng qua bất cứ trung gian n&agrave;o, &nbsp;kh&ocirc;ng phải&nbsp;h&agrave;ng gia c&ocirc;ng tại Việt Nam n&ecirc;n qu&yacute; kh&aacute;ch c&oacute; thể y&ecirc;n t&acirc;m về chất lượng sản phẩm.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Ship COD to&agrave;n quốc (giao h&agrave;ng v&agrave; thu tiền tận địa chỉ kh&aacute;ch h&agrave;ng).</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:blue\">Được xem v&agrave; kiểm tra sản phẩm trước khi thanh to&aacute;n nhận h&agrave;ng.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Hỗ trợ đổi h&agrave;ng trong v&ograve;ng 48 giờ với c&aacute;c l&yacute; do kh&aacute;ch quan (kh&ocirc;ng vừa size, lỗi sản phẩm,...)</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Li&ecirc;n hệ đặt h&agrave;ng nhanh call/sms/zalo :&nbsp;<em>0989.34.24.60</em></span>&nbsp;</p>', '/uploads/products/2018/09/20180912080317-1.jpg', 178000, 168000, 1, 1, NULL, NULL, NULL, 0, '2018-09-12 01:03:17', '2018-09-12 01:03:22', NULL, 1),
(2, 'SM120', 'Sơ mi nữ cổ trụ phối nơ SM120 Hàng nhập', 'so-mi-nu-co-tru-phoi-no-sm120-hang-nhap', NULL, 'Chất vải: Khác.\r\nChiều dài tay áo: Tay dài.\r\nHọa tiết: Trơn.\r\nPhong cách: Công sở.', '<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">M&atilde; sản phẩm :sm120</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">k&iacute;ch thước :s-2xl</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Th&iacute;ch hợp: đi biển, dự tiệc, d&atilde; ngoại...</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">H&agrave;ng nhập trực tiếp từ xưởng nước ngo&agrave;i đảm bảo chất lượng.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Hướng dẫn chọn size</span><br />\r\n&nbsp;</p>\r\n\r\n<p>⚛️<span style=\"color:rgb(153, 51, 102)\">&nbsp;Cam kết của shop</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:blue\">Sản phẩm giống h&igrave;nh 100%.</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:rgb(49, 23, 241)\">Đ&acirc;y l&agrave; h&agrave;ng shop nhập trực tiếp kh&ocirc;ng qua bất cứ trung gian n&agrave;o, &nbsp;kh&ocirc;ng phải&nbsp;h&agrave;ng gia c&ocirc;ng tại Việt Nam n&ecirc;n qu&yacute; kh&aacute;ch c&oacute; thể y&ecirc;n t&acirc;m về chất lượng sản phẩm.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Ship COD to&agrave;n quốc (giao h&agrave;ng v&agrave; thu tiền tận địa chỉ kh&aacute;ch h&agrave;ng).</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:blue\">Được xem v&agrave; kiểm tra sản phẩm trước khi thanh to&aacute;n nhận h&agrave;ng.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Hỗ trợ đổi h&agrave;ng trong v&ograve;ng 48 giờ với c&aacute;c l&yacute; do kh&aacute;ch quan (kh&ocirc;ng vừa size, lỗi sản phẩm,...)</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Li&ecirc;n hệ đặt h&agrave;ng nhanh call/sms/zalo :&nbsp;<em>0989.34.24.60</em></span>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ⚛️<span style=\"color:rgb(153, 51, 102)\">&nbsp;Ưu đ&atilde;i từ shop</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:blue\">Giảm ngay 2% cho đơn h&agrave;ng tr&ecirc;n 200k khi thanh to&aacute;n trực tuyến qua thẻ ng&acirc;n h&agrave;ng (ATM, visa..) hoặc qua t&agrave;i khoản Senpay.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Đơn h&agrave;ng ho&agrave;n tất được đ&aacute;nh&nbsp;gi&aacute;&nbsp;5*&nbsp;bạn sẽ được giảm th&ecirc;m 5% cho đơn h&agrave;ng tiếp theo khi mua của shop (Vui l&ograve;ng li&ecirc;n hệ trực tiếp cho lần mua tiếp theo để shop x&aacute;c nhận th&ocirc;ng tin ch&iacute;nh x&aacute;c).</span></p>', '/uploads/products/2018/09/20180912080752-5.jpg', 250000, 199000, 1, 1, NULL, NULL, NULL, 0, '2018-09-12 01:07:52', '2018-09-12 01:07:52', NULL, 1),
(3, 'SM28', 'Áo form rộng SM28 Hàng nhập', 'ao-form-rong-sm28-hang-nhap', NULL, 'Chất vải: Khác.\r\nChiều dài tay áo: Tay ngắn.\r\nHọa tiết: Trơn.\r\nPhong cách: Nhẹ nhàng.', '<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">k&iacute;ch thước :s-2xl</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Th&iacute;ch hợp: đi biển, dự tiệc, d&atilde; ngoại...</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">H&agrave;ng nhập trực tiếp từ xưởng nước ngo&agrave;i đảm bảo chất lượng.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Hướng dẫn chọn size</span><br />\r\n&nbsp;</p>\r\n\r\n<p>⚛️<span style=\"color:rgb(153, 51, 102)\">&nbsp;Cam kết của shop</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:blue\">Sản phẩm giống h&igrave;nh 100%.</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:rgb(49, 23, 241)\">Đ&acirc;y l&agrave; h&agrave;ng shop nhập trực tiếp kh&ocirc;ng qua bất cứ trung gian n&agrave;o, &nbsp;kh&ocirc;ng phải&nbsp;h&agrave;ng gia c&ocirc;ng tại Việt Nam n&ecirc;n qu&yacute; kh&aacute;ch c&oacute; thể y&ecirc;n t&acirc;m về chất lượng sản phẩm.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Ship COD to&agrave;n quốc (giao h&agrave;ng v&agrave; thu tiền tận địa chỉ kh&aacute;ch h&agrave;ng).</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:blue\">Được xem v&agrave; kiểm tra sản phẩm trước khi thanh to&aacute;n nhận h&agrave;ng.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Hỗ trợ đổi h&agrave;ng trong v&ograve;ng 48 giờ với c&aacute;c l&yacute; do kh&aacute;ch quan (kh&ocirc;ng vừa size, lỗi sản phẩm,...)</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Li&ecirc;n hệ đặt h&agrave;ng nhanh call/sms/zalo :&nbsp;<em>0989.34.24.60</em></span>&nbsp;</p>', '/uploads/products/2018/09/20180912081005-4.jpg', 220000, 169000, 1, 1, NULL, NULL, NULL, 0, '2018-09-12 01:10:05', '2018-09-12 01:10:05', NULL, 1),
(4, 'sm12', 'Sơ mi công sở kẻ caro sm12 Hàng nhập', 'so-mi-cong-so-ke-caro-sm12-hang-nhap', NULL, 'Chất vải: Khác.\r\nChiều dài tay áo: Tay dài.\r\nHọa tiết: Caro.\r\nPhong cách: Công sở.', '<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">k&iacute;ch thước :s-2xl</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Th&iacute;ch hợp: đi biển, dự tiệc, d&atilde; ngoại...</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">H&agrave;ng nhập trực tiếp từ xưởng nước ngo&agrave;i đảm bảo chất lượng.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Hướng dẫn chọn size</span></p>', '/uploads/products/2018/09/20180912081341-1.jpg', 220000, 150000, 1, 1, NULL, NULL, NULL, 0, '2018-09-12 01:13:41', '2018-09-12 01:13:41', NULL, 1),
(5, 'SM06', 'Áo sơ mi kiểu dáng Hàn Quốc SM06', 'ao-so-mi-kieu-dang-han-quoc-sm06', NULL, 'Chất vải: Khác.\r\nChiều dài tay áo: Tay dài.\r\nHọa tiết: Khác.\r\nPhong cách: Công sở.', '<p>⚛️<span style=\"color:rgb(153, 51, 102)\">&nbsp;Cam kết của shop</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:blue\">Sản phẩm giống h&igrave;nh 100%.</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:rgb(49, 23, 241)\">Đ&acirc;y l&agrave; h&agrave;ng shop nhập trực tiếp kh&ocirc;ng qua bất cứ trung gian n&agrave;o, &nbsp;kh&ocirc;ng phải&nbsp;h&agrave;ng gia c&ocirc;ng tại Việt Nam n&ecirc;n qu&yacute; kh&aacute;ch c&oacute; thể y&ecirc;n t&acirc;m về chất lượng sản phẩm.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Ship COD to&agrave;n quốc (giao h&agrave;ng v&agrave; thu tiền tận địa chỉ kh&aacute;ch h&agrave;ng).</span></p>\r\n\r\n<p>✅&nbsp;<span style=\"color:blue\">Được xem v&agrave; kiểm tra sản phẩm trước khi thanh to&aacute;n nhận h&agrave;ng.</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Hỗ trợ đổi h&agrave;ng trong v&ograve;ng 48 giờ với c&aacute;c l&yacute; do kh&aacute;ch quan (kh&ocirc;ng vừa size, lỗi sản phẩm,...)</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Li&ecirc;n hệ đặt h&agrave;ng nhanh call/sms/zalo :&nbsp;<em>0989.34.24.60</em></span>&nbsp;</p>', '/uploads/products/2018/09/20180912081522-5.jpg', 250000, 199000, 1, 1, NULL, NULL, NULL, 0, '2018-09-12 01:15:22', '2018-09-12 01:15:22', NULL, 1),
(6, 'dqc3935', 'Áo len cổ tim', 'ao-len-co-tim', NULL, 'Chiều dài áo: Ngang rốn.\r\nChiều dài tay áo: Tay dài.\r\nHọa tiết: Trơn.\r\nKiểu cổ áo: Cổ tim.\r\nPhong cách: Dễ thương.', '<p>H&agrave;ng cam kết nhập- Kh&ocirc;ng b&aacute;n sản phẩm may k&eacute;m chất lượng</p>\r\n\r\n<p>*** Ri&ecirc;ng kh&aacute;ch sỉ mua h&agrave;ng inbocx zalo: 0966959204 để biết gi&aacute; sỉ</p>\r\n\r\n<p>Sie M 42 đến 49kg, Size L từ 49 đến 55kg</p>\r\n\r\n<p>+ Giao h&agrave;ng tận nơi</p>\r\n\r\n<p>Chất liệu : Vải len cao cấp</p>\r\n\r\n<p>M&agrave;u sắc : x&aacute;m t&iacute;m v&agrave;ng đỏ đen trắng</p>\r\n\r\n<p>Hotline: 0966.959.204 viber, sms, call, zalo)</p>', '/uploads/products/2018/09/20180917075719-3.jpg', 205000, 165000, 1, 1, NULL, NULL, NULL, 0, '2018-09-17 00:57:19', '2018-09-17 01:38:47', NULL, 1),
(7, 'ALe07', 'Áo len lưới cánh rơi AL07 hàng nhập - ALe07', 'ao-len-luoi-canh-roi-al07-hang-nhap-ale07', NULL, 'Chiều dài áo: Qua rốn.\r\nChiều dài tay áo: Tay lửng.\r\nKiểu cổ áo: Cổ U.\r\nHọa tiết: Trơn.\r\nPhong cách: Dễ thương.', '<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">M&atilde; sản phẩm :al07</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">k&iacute;ch thước :freesize</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">Th&iacute;ch hợp: đi biển, dự tiệc, d&atilde; ngoại...</span></p>\r\n\r\n<p>✅<span style=\"color:blue\">&nbsp;</span><span style=\"color:blue\">H&agrave;ng nhập trực tiếp từ xưởng nước ngo&agrave;i đảm bảo chất lượng.</span></p>', '/uploads/products/2018/09/20180917075953-1.jpg', 260000, 199000, 1, 1, NULL, NULL, NULL, 0, '2018-09-17 00:59:53', '2018-09-17 00:59:53', NULL, 1),
(8, 'AL123HQ', 'Áo len nữ đẹp hàn quốc, áo len nữ thu đông - AL123HQ', 'ao-len-nu-dep-han-quoc-ao-len-nu-thu-dong-al123hq', NULL, 'Chiều dài áo: Ngang rốn.\r\nChiều dài tay áo: Tay dài.\r\nHọa tiết: Khối màu - color block.\r\nKiểu cổ áo: Cổ trụ/lọ.\r\nPhong cách: Khác.', '<div style=\"box-sizing: border-box; color: rgb(29, 33, 41); font-family: SFUIText, arial; font-size: 12px;\">\r\n<div style=\"box-sizing: border-box; color: rgb(75, 79, 86);\">\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\"><em>&Aacute;o len nữ đẹp l&agrave; một loại trang phục dễ t&iacute;nh, c&oacute; thể phối hợp với mọi loại quần &aacute;o m&agrave; vẫn l&agrave;m to&aacute;t l&ecirc;n phong c&aacute;ch, v&agrave; sự nổi bật cho người mặc. &nbsp;</em></div>\r\n</div>\r\n\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\">&nbsp;</div>\r\n</div>\r\n\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\"><em>&Aacute;o kho&aacute;c len nữ d&aacute;ng d&agrave;i v&agrave; &aacute;o cổ lọ đẹp bằng len hứa hẹn sẽ g&acirc;y sốt trong m&ugrave;a thu đ&ocirc;ng năm 2017.</em></div>\r\n</div>\r\n\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\"><em>Chiếc &aacute;o len nữ n&agrave;y c&oacute; chất liệu mềm mại kh&ocirc;ng chỉ tạo cảm gi&aacute;c thỏa m&aacute;i dễ chịu cho chị em phụ nữ m&agrave; c&ograve;n gi&uacute;p giữ ấm cho cơ thể rất tốt. th&ecirc;m chiếc thắt lưng, t&uacute;i x&aacute;ch, legging&hellip;chiếc &aacute;o bằng len n&agrave;y sẽ l&agrave; sự kết hợp tuyệt vời tạo n&ecirc;n sự trẻ trung, s&agrave;nh điệu cho c&aacute;c n&agrave;ng nữ. &Aacute;o len cổ lọ</em></div>\r\n</div>\r\n\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\">&nbsp;</div>\r\n</div>\r\n\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\"><em>M&agrave;u sắc: X&aacute;m, đỏ đậm , xanh l&aacute; đậm, đen , n&acirc;u x&aacute;m nhạt.&nbsp;</em></div>\r\n</div>\r\n\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\">&nbsp;</div>\r\n</div>\r\n\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\"><em>K&iacute;ch thước: chiều d&agrave;i 60 cm Chiều rộng vai 58 cm Ngực 116 cm Chiều d&agrave;i tay 50 cm</em></div>\r\n\r\n<div style=\"box-sizing: border-box;\"><em>Freesize&nbsp;</em></div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(29, 33, 41); font-family: SFUIText, arial; font-size: 12px;\">\r\n<div style=\"box-sizing: border-box;\">\r\n<p><em><span style=\"color:rgba(0, 0, 0, 0.8)\">CAM KẾT - GI&Aacute; B&Aacute;N Đ&Uacute;NG CHẤT LƯỢNG SẢN PHẨM</span></em></p>\r\n\r\n<p><em><span style=\"color:rgba(0, 0, 0, 0.8)\">SẢN PHẨM GIỐNG NHƯ M&Ocirc; TẢ H&Igrave;NH ẢNH 100%</span></em></p>\r\n\r\n<p><em><span style=\"color:rgba(0, 0, 0, 0.8)\">CHẤT ĐẸP BAO ĐỔI TRẢ TRONG V&Ograve;NG 7 NG&Agrave;Y</span></em></p>\r\n</div>\r\n</div>', '/uploads/products/2018/09/20180917080127-4.jpg', 225000, 199000, 1, 1, NULL, NULL, NULL, 0, '2018-09-17 01:01:27', '2018-09-17 01:01:27', NULL, 1),
(9, 'AL188', 'Áo len dệt kim Sang Trong - Hàng nhâp - AL188', 'ao-len-det-kim-sang-trong-hang-nhap-al188', NULL, 'Chiều dài áo: Qua rốn.\r\nChiều dài tay áo: Tay dài.\r\nHọa tiết: Khác.\r\nKiểu cổ áo: Khác.\r\nPhong cách: Dễ thương.', '<ul>\r\n	<li>Hệ thống b&aacute;n sỉ lẻ h&agrave;ng đầu chuy&ecirc;n h&agrave;ng nhập cao cấp, mang đến cho bạn những trải nghiệm mua sắm với những mẫu thời trang hiện đại, s&agrave;nh điệu, xu hướng mới lạ từ c&aacute;c h&atilde;ng thời trang nước ngo&agrave;i.&nbsp;</li>\r\n	<li><span style=\"color:rgb(255, 0, 255)\">M&Ocirc; TẢ SẢN PHẨM V&Agrave; CHẤT LIỆU&nbsp;</span></li>\r\n	<li><span style=\"color:rgb(255, 0, 255)\">chu ý: HÀNG Y HÌNH 100%</span></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>TH&Ocirc;NG TIN SẢN PHẨM&nbsp; &nbsp;</li>\r\n</ul>\r\n\r\n<p>&nbsp; &nbsp;*&nbsp; &nbsp;T&ecirc;n sản phẩm: &Aacute;o len dệt kim Sang Trong - H&agrave;ng nh&acirc;p - AL188</p>\r\n\r\n<p>&nbsp; &nbsp;* &nbsp; &nbsp;M&atilde; sản phẩm: AL188</p>\r\n\r\n<p>&nbsp; &nbsp;* &nbsp; &nbsp;Th&iacute;ch hợp: đi chơi, đi&nbsp;tiệc, đi l&agrave;m</p>\r\n\r\n<p>&nbsp; &nbsp;* &nbsp; &nbsp;Cam kết h&agrave;ng nhập chất lượng sản phẩm 100% như h&igrave;nh.</p>', '/uploads/products/2018/09/20180917080347-2.png', 226000, 118000, 1, 1, NULL, NULL, NULL, 0, '2018-09-17 01:03:47', '2018-09-17 01:03:47', NULL, 1),
(10, 'act15', 'Áo Cotton Thái Nhập Thêu Chữ', 'ao-cotton-thai-nhap-theu-chu', NULL, 'Chất vải: Cotton 4 chiều,Cotton 100%.\r\nPhong cách: Dễ thương.\r\nKiểu cổ áo: Cổ tròn.\r\nHọa tiết: Ký tự.\r\nChiều dài tay áo: Tay ngắn.\r\nChiều dài áo: Qua rốn.', '<p><span style=\"color:rgb(255, 0, 0)\">Cam Kết H&agrave;ng Nhập Thun Th&aacute;i Si&ecirc;u Đẹp -&nbsp;</span><span style=\"color:rgb(255, 0, 0)\">Y H&igrave;nh Thật 100%</span></p>\r\n\r\n<p><span style=\"color:rgb(255, 0, 0)\">MẪU ĐỘC QUYỀN</span><span style=\"color:rgb(255, 0, 0)\">&nbsp;Cotton Thun Th&aacute;i nhập th&ecirc;u chữ cực xinh đơn giản chi tiết cao cấp, phối đồ n&agrave;o cũng hợp thời trang&nbsp;</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><span style=\"color:rgb(128, 0, 128)\"><em>:</em>&nbsp;</span><span style=\"color:rgb(51, 102, 255)\">Chất vải thun cotton Th&aacute;i Nhập cực xinh, kiểu đơn giản nhưng dễ thương lắm lu&ocirc;n kh&aacute;ch ơi</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><span style=\"color:rgb(51, 102, 255)\"><em><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\">:</span></span></em>&nbsp;Thun cotton Th&aacute;i co gi&atilde;n tốt l&ecirc;n form &ocirc;m d&aacute;ng t&ocirc;n v&ograve;ng 1 v&ograve;ng 2, thun mịn &ecirc;m mặc m&aacute;t, rất xinh xắn đễ thương cho mọi bạn Nữ ah</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Mẫu b&aacute;n cực chạy, kh&aacute;ch y&ecirc;n t&acirc;m kh&ocirc;ng hề lo lỗi mốt, phối quần jean, ch&acirc;n v&aacute;y, quần short, quần legging ...bla...bla... đều đẹp ah&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + H&igrave;nh chụp sản phẩm thật tại&nbsp;Shop Yuna Passio nha&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Chất liệu: thun cotton Th&aacute;i nhập&nbsp;mềm mịn tho&aacute;ng m&aacute;t, Cổ tr&ograve;n bo đẹp, MẪU&nbsp;ĐỘC QUYỀN c&ugrave;ng BẢNG M&Agrave;U ĐẸP KH&Ocirc;NG NƠI N&Agrave;O C&Oacute; của Shop</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Freesize = 1 form = 1 cỡ&nbsp;&aacute;o &ocirc;m d&aacute;ng d&agrave;nh cho Nữ 55kg cao m65 trở xuống mặc đẹp&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><em><span style=\"color:rgb(128, 0, 128)\">:</span></em><span style=\"color:rgb(51, 102, 255)\">&nbsp;H&igrave;nh ảnh v&agrave; kiểu d&aacute;ng sản phẩm l&agrave; đồng nhất, bao đổi trả nếu sản phẩm kh&ocirc;ng như m&ocirc; tả</span></p>', '/uploads/products/2018/09/20180917081012-3.jpg', 354000, 268000, 1, 1, NULL, NULL, NULL, 0, '2018-09-17 01:10:12', '2018-09-17 01:10:12', NULL, 1),
(11, 'C425', 'Áo thun sọc ngang', 'ao-thun-soc-ngang', NULL, 'Chất vải: Cotton 4 chiều,Cotton 100%.\r\nPhong cách: Dễ thương.\r\nKiểu cổ áo: Cổ tròn.\r\nHọa tiết: Ký tự.\r\nChiều dài tay áo: Tay ngắn.\r\nChiều dài áo: Qua rốn.', '<p><span style=\"color:rgb(255, 0, 0)\">Cam Kết H&agrave;ng Nhập Thun Th&aacute;i Si&ecirc;u Đẹp -&nbsp;</span><span style=\"color:rgb(255, 0, 0)\">Y H&igrave;nh Thật 100%</span></p>\r\n\r\n<p><span style=\"color:rgb(255, 0, 0)\">MẪU ĐỘC QUYỀN</span><span style=\"color:rgb(255, 0, 0)\">&nbsp;Cotton Thun Th&aacute;i nhập th&ecirc;u chữ cực xinh đơn giản chi tiết cao cấp, phối đồ n&agrave;o cũng hợp thời trang&nbsp;</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><span style=\"color:rgb(128, 0, 128)\"><em>:</em>&nbsp;</span><span style=\"color:rgb(51, 102, 255)\">Chất vải thun cotton Th&aacute;i Nhập cực xinh, kiểu đơn giản nhưng dễ thương lắm lu&ocirc;n kh&aacute;ch ơi</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><span style=\"color:rgb(51, 102, 255)\"><em><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\">:</span></span></em>&nbsp;Thun cotton Th&aacute;i co gi&atilde;n tốt l&ecirc;n form &ocirc;m d&aacute;ng t&ocirc;n v&ograve;ng 1 v&ograve;ng 2, thun mịn &ecirc;m mặc m&aacute;t, rất xinh xắn đễ thương cho mọi bạn Nữ ah</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Mẫu b&aacute;n cực chạy, kh&aacute;ch y&ecirc;n t&acirc;m kh&ocirc;ng hề lo lỗi mốt, phối quần jean, ch&acirc;n v&aacute;y, quần short, quần legging ...bla...bla... đều đẹp ah&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + H&igrave;nh chụp sản phẩm thật tại&nbsp;Shop Yuna Passio nha&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Chất liệu: thun cotton Th&aacute;i nhập&nbsp;mềm mịn tho&aacute;ng m&aacute;t, Cổ tr&ograve;n bo đẹp, MẪU&nbsp;ĐỘC QUYỀN c&ugrave;ng BẢNG M&Agrave;U ĐẸP KH&Ocirc;NG NƠI N&Agrave;O C&Oacute; của Shop</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Freesize = 1 form = 1 cỡ&nbsp;&aacute;o &ocirc;m d&aacute;ng d&agrave;nh cho Nữ 55kg cao m65 trở xuống mặc đẹp&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><em><span style=\"color:rgb(128, 0, 128)\">:</span></em><span style=\"color:rgb(51, 102, 255)\">&nbsp;H&igrave;nh ảnh v&agrave; kiểu d&aacute;ng sản phẩm l&agrave; đồng nhất, bao đổi trả nếu sản phẩm kh&ocirc;ng như m&ocirc; tả</span></p>', '/uploads/products/2018/09/20180917081128-4.png', 354000, 268000, 1, 1, NULL, NULL, NULL, 0, '2018-09-17 01:10:44', '2018-09-17 01:11:28', NULL, 1),
(12, 'C4251', 'Áo thun nữ in hình Năm Tuất đón Tết - N1', 'ao-thun-nu-in-hinh-nam-tuat-don-tet-n1', NULL, 'Chất vải: Cotton 4 chiều,Cotton 100%.\r\nPhong cách: Dễ thương.\r\nKiểu cổ áo: Cổ tròn.\r\nHọa tiết: Ký tự.\r\nChiều dài tay áo: Tay ngắn.\r\nChiều dài áo: Qua rốn.', '<p><span style=\"color:rgb(255, 0, 0)\">Cam Kết H&agrave;ng Nhập Thun Th&aacute;i Si&ecirc;u Đẹp -&nbsp;</span><span style=\"color:rgb(255, 0, 0)\">Y H&igrave;nh Thật 100%</span></p>\r\n\r\n<p><span style=\"color:rgb(255, 0, 0)\">MẪU ĐỘC QUYỀN</span><span style=\"color:rgb(255, 0, 0)\">&nbsp;Cotton Thun Th&aacute;i nhập th&ecirc;u chữ cực xinh đơn giản chi tiết cao cấp, phối đồ n&agrave;o cũng hợp thời trang&nbsp;</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><span style=\"color:rgb(128, 0, 128)\"><em>:</em>&nbsp;</span><span style=\"color:rgb(51, 102, 255)\">Chất vải thun cotton Th&aacute;i Nhập cực xinh, kiểu đơn giản nhưng dễ thương lắm lu&ocirc;n kh&aacute;ch ơi</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><span style=\"color:rgb(51, 102, 255)\"><em><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\">:</span></span></em>&nbsp;Thun cotton Th&aacute;i co gi&atilde;n tốt l&ecirc;n form &ocirc;m d&aacute;ng t&ocirc;n v&ograve;ng 1 v&ograve;ng 2, thun mịn &ecirc;m mặc m&aacute;t, rất xinh xắn đễ thương cho mọi bạn Nữ ah</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Mẫu b&aacute;n cực chạy, kh&aacute;ch y&ecirc;n t&acirc;m kh&ocirc;ng hề lo lỗi mốt, phối quần jean, ch&acirc;n v&aacute;y, quần short, quần legging ...bla...bla... đều đẹp ah&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + H&igrave;nh chụp sản phẩm thật tại&nbsp;Shop Yuna Passio nha&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Chất liệu: thun cotton Th&aacute;i nhập&nbsp;mềm mịn tho&aacute;ng m&aacute;t, Cổ tr&ograve;n bo đẹp, MẪU&nbsp;ĐỘC QUYỀN c&ugrave;ng BẢNG M&Agrave;U ĐẸP KH&Ocirc;NG NƠI N&Agrave;O C&Oacute; của Shop</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Freesize = 1 form = 1 cỡ&nbsp;&aacute;o &ocirc;m d&aacute;ng d&agrave;nh cho Nữ 55kg cao m65 trở xuống mặc đẹp&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><em><span style=\"color:rgb(128, 0, 128)\">:</span></em><span style=\"color:rgb(51, 102, 255)\">&nbsp;H&igrave;nh ảnh v&agrave; kiểu d&aacute;ng sản phẩm l&agrave; đồng nhất, bao đổi trả nếu sản phẩm kh&ocirc;ng như m&ocirc; tả</span></p>', '/uploads/products/2018/09/20180917084118-1.jpg', 354000, 268000, 1, 1, NULL, NULL, NULL, 0, '2018-09-17 01:40:57', '2018-09-17 01:41:50', NULL, 1),
(13, 'a17', 'Áo thun nữ dập chữ nổi áo phông nữ', 'ao-thun-nu-dap-chu-noi-ao-phong-nu', NULL, 'Chất vải: Cotton 4 chiều,Cotton 100%.\r\nPhong cách: Dễ thương.\r\nKiểu cổ áo: Cổ tròn.\r\nHọa tiết: Ký tự.\r\nChiều dài tay áo: Tay ngắn.\r\nChiều dài áo: Qua rốn.', '<p><span style=\"color:rgb(255, 0, 0)\">Cam Kết H&agrave;ng Nhập Thun Th&aacute;i Si&ecirc;u Đẹp -&nbsp;</span><span style=\"color:rgb(255, 0, 0)\">Y H&igrave;nh Thật 100%</span></p>\r\n\r\n<p><span style=\"color:rgb(255, 0, 0)\">MẪU ĐỘC QUYỀN</span><span style=\"color:rgb(255, 0, 0)\">&nbsp;Cotton Thun Th&aacute;i nhập th&ecirc;u chữ cực xinh đơn giản chi tiết cao cấp, phối đồ n&agrave;o cũng hợp thời trang&nbsp;</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><span style=\"color:rgb(128, 0, 128)\"><em>:</em>&nbsp;</span><span style=\"color:rgb(51, 102, 255)\">Chất vải thun cotton Th&aacute;i Nhập cực xinh, kiểu đơn giản nhưng dễ thương lắm lu&ocirc;n kh&aacute;ch ơi</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><span style=\"color:rgb(51, 102, 255)\"><em><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\">:</span></span></em>&nbsp;Thun cotton Th&aacute;i co gi&atilde;n tốt l&ecirc;n form &ocirc;m d&aacute;ng t&ocirc;n v&ograve;ng 1 v&ograve;ng 2, thun mịn &ecirc;m mặc m&aacute;t, rất xinh xắn đễ thương cho mọi bạn Nữ ah</span></p>\r\n\r\n<p><span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Mẫu b&aacute;n cực chạy, kh&aacute;ch y&ecirc;n t&acirc;m kh&ocirc;ng hề lo lỗi mốt, phối quần jean, ch&acirc;n v&aacute;y, quần short, quần legging ...bla...bla... đều đẹp ah&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + H&igrave;nh chụp sản phẩm thật tại&nbsp;Shop Yuna Passio nha&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Chất liệu: thun cotton Th&aacute;i nhập&nbsp;mềm mịn tho&aacute;ng m&aacute;t, Cổ tr&ograve;n bo đẹp, MẪU&nbsp;ĐỘC QUYỀN c&ugrave;ng BẢNG M&Agrave;U ĐẸP KH&Ocirc;NG NƠI N&Agrave;O C&Oacute; của Shop</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; + Freesize = 1 form = 1 cỡ&nbsp;&aacute;o &ocirc;m d&aacute;ng d&agrave;nh cho Nữ 55kg cao m65 trở xuống mặc đẹp&nbsp;</span><br />\r\n<span style=\"color:rgb(51, 102, 255)\"><span style=\"color:rgb(0, 0, 0)\"><span style=\"color:rgb(128, 0, 128)\"><em>&Aacute;o Cotton Th&aacute;i</em><em>&nbsp;Nhập Th&ecirc;u Chữ</em></span></span></span><em><span style=\"color:rgb(128, 0, 128)\">:</span></em><span style=\"color:rgb(51, 102, 255)\">&nbsp;H&igrave;nh ảnh v&agrave; kiểu d&aacute;ng sản phẩm l&agrave; đồng nhất, bao đổi trả nếu sản phẩm kh&ocirc;ng như m&ocirc; tả</span></p>', '/uploads/products/2018/09/20180917084403-1.jpg', 354000, 268000, 1, 1, NULL, NULL, NULL, 0, '2018-09-17 01:43:34', '2018-09-17 01:44:09', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_value`
--

CREATE TABLE `product_attribute_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_value_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `attr_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute_value`
--

INSERT INTO `product_attribute_value` (`id`, `attribute_value_id`, `product_id`, `attr_name`, `attr_value`) VALUES
(1, 2, 2, 'Color', 'White'),
(2, 8, 2, 'Size', 'S'),
(3, 9, 2, 'Size', 'M'),
(4, 10, 2, 'Size', 'L'),
(5, 2, 3, 'Color', 'White'),
(6, 8, 3, 'Size', 'S'),
(7, 9, 3, 'Size', 'M'),
(8, 10, 3, 'Size', 'L'),
(9, 2, 1, 'Color', 'White'),
(10, 7, 1, 'Color', 'Black'),
(11, 14, 1, 'Color', 'Pink'),
(12, 8, 1, 'Size', 'S'),
(13, 9, 1, 'Size', 'M'),
(14, 10, 1, 'Size', 'L'),
(15, 8, 4, 'Size', 'S'),
(16, 9, 4, 'Size', 'M'),
(17, 10, 4, 'Size', 'L'),
(18, 2, 5, 'Color', 'White'),
(19, 8, 5, 'Size', 'S'),
(20, 9, 5, 'Size', 'M'),
(21, 10, 5, 'Size', 'L'),
(25, 2, 7, 'Color', 'White'),
(26, 14, 7, 'Color', 'Pink'),
(27, 2, 9, 'Color', 'White'),
(28, 5, 9, 'Color', 'Red'),
(35, 2, 6, 'Color', 'White'),
(36, 6, 6, 'Color', 'Yellow'),
(37, 14, 6, 'Color', 'Pink'),
(38, 2, 12, 'Color', 'White'),
(39, 8, 12, 'Size', 'S'),
(40, 9, 12, 'Size', 'M'),
(44, 2, 13, 'Color', 'White'),
(45, 8, 13, 'Size', 'S'),
(46, 9, 13, 'Size', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 15, NULL, NULL),
(2, 2, 15, NULL, NULL),
(3, 3, 15, NULL, NULL),
(4, 4, 15, NULL, NULL),
(5, 5, 15, NULL, NULL),
(6, 6, 22, NULL, NULL),
(7, 7, 22, NULL, NULL),
(8, 8, 22, NULL, NULL),
(9, 9, 22, NULL, NULL),
(10, 10, 18, NULL, NULL),
(11, 11, 18, NULL, NULL),
(12, 12, 18, NULL, NULL),
(13, 13, 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_event`
--

CREATE TABLE `product_event` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image`, `product_id`) VALUES
(1, '/uploads/products/2018/09/20180912080317-4.jpg', 1),
(2, '/uploads/products/2018/09/20180912080317-3.jpg', 1),
(3, '/uploads/products/2018/09/20180912080317-2.jpg', 1),
(4, '/uploads/products/2018/09/20180912080317-1.jpg', 1),
(5, '/uploads/products/2018/09/20180912080752-5.jpg', 2),
(6, '/uploads/products/2018/09/20180912080752-4.jpg', 2),
(7, '/uploads/products/2018/09/20180912080752-3.jpg', 2),
(8, '/uploads/products/2018/09/20180912080752-2.jpg', 2),
(9, '/uploads/products/2018/09/20180912080752-1.jpg', 2),
(10, '/uploads/products/2018/09/20180912081005-4.jpg', 3),
(11, '/uploads/products/2018/09/20180912081005-3.jpg', 3),
(12, '/uploads/products/2018/09/20180912081005-2.jpg', 3),
(13, '/uploads/products/2018/09/20180912081005-1.jpg', 3),
(14, '/uploads/products/2018/09/20180912081341-1.jpg', 4),
(15, '/uploads/products/2018/09/20180912081522-5.jpg', 5),
(16, '/uploads/products/2018/09/20180912081522-4.jpg', 5),
(17, '/uploads/products/2018/09/20180912081522-3.jpg', 5),
(18, '/uploads/products/2018/09/20180912081522-2.jpg', 5),
(19, '/uploads/products/2018/09/20180912081522-1.jpg', 5),
(21, '/uploads/products/2018/09/20180917075719-3.jpg', 6),
(24, '/uploads/products/2018/09/20180917075953-1.jpg', 7),
(25, '/uploads/products/2018/09/20180917080127-4.jpg', 8),
(26, '/uploads/products/2018/09/20180917080127-3.jpg', 8),
(27, '/uploads/products/2018/09/20180917080127-2.jpg', 8),
(28, '/uploads/products/2018/09/20180917080127-1.jpg', 8),
(29, '/uploads/products/2018/09/20180917080347-2.png', 9),
(30, '/uploads/products/2018/09/20180917080347-1.jpg', 9),
(31, '/uploads/products/2018/09/20180917081012-3.jpg', 10),
(32, '/uploads/products/2018/09/20180917081012-2.jpg', 10),
(33, '/uploads/products/2018/09/20180917081012-1.jpg', 10),
(37, '/uploads/products/2018/09/20180917081128-4.png', 11),
(39, '/uploads/products/2018/09/20180917084118-2.jpg', 12),
(40, '/uploads/products/2018/09/20180917084118-1.jpg', 12),
(43, '/uploads/products/2018/09/20180917084403-3.jpg', 13),
(44, '/uploads/products/2018/09/20180917084403-2.jpg', 13),
(45, '/uploads/products/2018/09/20180917084403-1.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_link_type`
--

CREATE TABLE `system_link_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_link_type`
--

INSERT INTO `system_link_type` (`id`, `name`, `prefix`, `created_at`, `updated_at`) VALUES
(1, 'Category Details', 'category', NULL, NULL),
(2, 'Post Details', 'post', NULL, NULL),
(3, 'Page Details', 'page', NULL, NULL),
(4, 'Catalog Details', '', NULL, NULL),
(5, 'Product Details', 'product', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1.administrator 2.support',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'hung.nguyen', 'admin', '$2y$10$9VzkzDI750HZfhqtvE7Sx.BVXH9SS5IbBGH21UB3D3/DMfeXHK0ZK', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_field`
--
ALTER TABLE `advance_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_user_id_foreign` (`user_id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD KEY `article_category_article_id_foreign` (`article_id`),
  ADD KEY `article_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `article_group`
--
ALTER TABLE `article_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_group_article_id_foreign` (`article_id`),
  ADD KEY `article_group_group_id_foreign` (`group_id`);

--
-- Indexes for table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_tag_article_id_foreign` (`article_id`),
  ADD KEY `article_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_slug_unique` (`slug`),
  ADD KEY `category_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_email_unique` (`email`);

--
-- Indexes for table `member_information`
--
ALTER TABLE `member_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_information_member_id_foreign` (`member_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_system`
--
ALTER TABLE `menu_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_field`
--
ALTER TABLE `meta_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meta_field_article_id_foreign` (`article_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_member_id_foreign` (`member_id`),
  ADD KEY `orders_billing_address_id_foreign` (`billing_address_id`),
  ADD KEY `orders_shipping_address_id_foreign` (`shipping_address_id`);

--
-- Indexes for table `order_attribute_images`
--
ALTER TABLE `order_attribute_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_attribute_images_order_product_attribute_id_foreign` (`order_product_attribute_id`),
  ADD KEY `order_attribute_images_order_product_id_foreign` (`order_product_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `order_product_attributes`
--
ALTER TABLE `order_product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product_attribute_groups`
--
ALTER TABLE `order_product_attribute_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_groups_order_sp_details_id` (`order_product_detail_id`),
  ADD KEY `order_groups_order_attr_id` (`order_product_attribute_id`);

--
-- Indexes for table `order_product_details`
--
ALTER TABLE `order_product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_details_order_product_id_foreign` (`order_product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_username_index` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_value_attribute_value_id_foreign` (`attribute_value_id`),
  ADD KEY `product_attribute_value_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_product_id_foreign` (`product_id`),
  ADD KEY `product_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_event`
--
ALTER TABLE `product_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_event_product_id_foreign` (`product_id`),
  ADD KEY `product_event_event_id_foreign` (`event_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tag_product_id_foreign` (`product_id`),
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `system_link_type`
--
ALTER TABLE `system_link_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `system_link_type_prefix_unique` (`prefix`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_field`
--
ALTER TABLE `advance_field`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `article_group`
--
ALTER TABLE `article_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `article_tag`
--
ALTER TABLE `article_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member_information`
--
ALTER TABLE `member_information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu_system`
--
ALTER TABLE `menu_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `meta_field`
--
ALTER TABLE `meta_field`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_attribute_images`
--
ALTER TABLE `order_attribute_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_product_attributes`
--
ALTER TABLE `order_product_attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_product_attribute_groups`
--
ALTER TABLE `order_product_attribute_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_product_details`
--
ALTER TABLE `order_product_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product_event`
--
ALTER TABLE `product_event`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_link_type`
--
ALTER TABLE `system_link_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_group`
--
ALTER TABLE `article_group`
  ADD CONSTRAINT `article_group_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_group_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `article_tag_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_information`
--
ALTER TABLE `member_information`
  ADD CONSTRAINT `member_information_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meta_field`
--
ALTER TABLE `meta_field`
  ADD CONSTRAINT `meta_field_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_billing_address_id_foreign` FOREIGN KEY (`billing_address_id`) REFERENCES `member_information` (`id`),
  ADD CONSTRAINT `orders_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `orders_shipping_address_id_foreign` FOREIGN KEY (`shipping_address_id`) REFERENCES `member_information` (`id`);

--
-- Constraints for table `order_attribute_images`
--
ALTER TABLE `order_attribute_images`
  ADD CONSTRAINT `order_attribute_images_order_product_attribute_id_foreign` FOREIGN KEY (`order_product_attribute_id`) REFERENCES `order_product_attributes` (`id`),
  ADD CONSTRAINT `order_attribute_images_order_product_id_foreign` FOREIGN KEY (`order_product_id`) REFERENCES `order_products` (`id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_product_attribute_groups`
--
ALTER TABLE `order_product_attribute_groups`
  ADD CONSTRAINT `order_groups_order_attr_id` FOREIGN KEY (`order_product_attribute_id`) REFERENCES `order_product_attributes` (`id`),
  ADD CONSTRAINT `order_groups_order_sp_details_id` FOREIGN KEY (`order_product_detail_id`) REFERENCES `order_product_details` (`id`);

--
-- Constraints for table `order_product_details`
--
ALTER TABLE `order_product_details`
  ADD CONSTRAINT `order_product_details_order_product_id_foreign` FOREIGN KEY (`order_product_id`) REFERENCES `order_products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD CONSTRAINT `product_attribute_value_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attribute_value_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_event`
--
ALTER TABLE `product_event`
  ADD CONSTRAINT `product_event_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_event_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
