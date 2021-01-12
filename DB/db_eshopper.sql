-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 08:01 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_eshopper`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PS6', 'ps6', 0, '2020-12-11 12:45:01', '2020-12-30 12:08:38'),
(3, 'ACNE', 'acne', 0, '2020-12-17 02:46:52', '2020-12-30 12:08:41'),
(4, 'GRÜNE ERDE', 'grune-erde', 0, '2020-12-17 02:47:44', '2020-12-30 12:08:42'),
(5, 'ALBIRO', 'albiro', 0, '2020-12-17 02:48:04', '2020-12-30 12:08:43'),
(6, 'RONHILL', 'ronhill', 1, '2020-12-17 02:48:15', '2020-12-30 12:03:28'),
(7, 'ODDMOLLY', 'oddmolly', 1, '2020-12-17 02:48:23', '2020-12-30 12:05:50'),
(8, 'BOUDESTIJN', 'boudestijn', 1, '2020-12-17 02:48:32', '2020-12-30 12:05:51'),
(9, 'RÖSCH CREATIVE CULTURE', 'rosch-creative-culture', 1, '2020-12-17 02:48:43', '2020-12-30 12:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SPORTSWEAR', 0, 'sportswear', 1, '2020-12-11 06:18:10', '2020-12-30 12:37:41'),
(2, 'MENS', 0, 'mens', 1, '2020-12-11 06:18:17', '2020-12-30 12:38:16'),
(3, 'WOMENS', 0, 'womens', 1, '2020-12-11 06:18:26', '2020-12-30 12:38:48'),
(4, 'KIDS', 0, 'kids', 1, '2020-12-11 06:18:33', '2020-12-30 12:38:48'),
(5, 'FASHION', 0, 'fashion', 0, '2020-12-11 06:18:38', '2020-12-11 06:18:38'),
(7, 'INTERIORS', 0, 'interiors', 0, '2020-12-11 06:18:49', '2020-12-11 06:18:49'),
(8, 'CLOTHING', 0, 'clothing', 0, '2020-12-11 06:18:54', '2020-12-11 06:18:54'),
(9, 'BAGS', 0, 'bags', 0, '2020-12-11 06:19:01', '2020-12-11 06:19:01'),
(10, 'SHOES', 0, 'shoes', 0, '2020-12-11 06:19:06', '2020-12-11 06:19:06'),
(11, 'NIKE', 1, 'nike', 0, '2020-12-11 06:19:29', '2020-12-11 06:19:29'),
(12, 'UNDER ARMOUR', 1, 'under-armour', 0, '2020-12-11 06:19:36', '2020-12-11 06:19:36'),
(13, 'ADIDAS', 1, 'adidas', 0, '2020-12-11 06:19:43', '2020-12-11 06:19:43'),
(14, 'PUMA', 1, 'puma', 0, '2020-12-11 06:19:50', '2020-12-11 06:19:50'),
(15, 'ASICS', 1, 'asics', 0, '2020-12-11 06:19:57', '2020-12-11 06:19:57'),
(16, 'FENDI', 2, 'fendi', 0, '2020-12-11 06:20:08', '2020-12-11 06:20:08'),
(17, 'GUESS', 2, 'guess', 0, '2020-12-11 06:20:16', '2020-12-11 06:20:16'),
(18, 'VALENTINO', 2, 'valentino', 0, '2020-12-11 06:20:24', '2020-12-11 06:20:24'),
(19, 'DIOR', 2, 'dior', 0, '2020-12-11 06:20:31', '2020-12-11 06:20:31'),
(20, 'VERSACE', 2, 'versace', 0, '2020-12-11 06:20:38', '2020-12-11 06:20:38'),
(22, 'PRADA', 2, 'prada', 0, '2020-12-11 06:21:01', '2020-12-11 06:21:01'),
(23, 'DOLCE AND GABBANA', 2, 'dolce-and-gabbana', 0, '2020-12-11 06:21:12', '2020-12-11 06:21:12'),
(24, 'CHANEL', 2, 'chanel', 0, '2020-12-11 06:21:18', '2020-12-11 06:21:18'),
(25, 'GUCCI', 2, 'gucci', 0, '2020-12-11 06:21:28', '2020-12-11 06:21:28'),
(26, 'FENDI', 3, 'fendi', 0, '2020-12-11 06:21:39', '2020-12-11 06:21:39'),
(27, 'GUESS', 3, 'guess', 0, '2020-12-11 06:21:50', '2020-12-11 06:21:50'),
(28, 'VALENTINO', 3, 'valentino', 0, '2020-12-11 06:21:58', '2020-12-11 06:21:58'),
(29, 'DIOR', 3, 'dior', 0, '2020-12-11 06:22:06', '2020-12-11 06:22:06'),
(30, 'VERSACE', 3, 'versace', 0, '2020-12-11 06:22:12', '2020-12-11 06:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(6, 'huynh trong dai', 'daihuynhtrong@viendong.edu.vn', '202cb962ac59075b964b07152d234b70', '2021-01-03 13:40:23', '2021-01-03 13:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `parent_id`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'menu 1', 0, NULL, NULL, ''),
(2, 'menu 2', 0, NULL, NULL, ''),
(3, 'menu 3', 0, NULL, NULL, ''),
(4, 'menu 4', 0, NULL, NULL, ''),
(5, 'menu 1.1', 1, NULL, NULL, ''),
(6, 'menu 1.2', 1, NULL, NULL, ''),
(7, 'menu 2.1', 2, NULL, NULL, ''),
(8, 'menu 2.2.1', 2, NULL, NULL, ''),
(9, 'menu 3.1', 3, NULL, NULL, ''),
(10, 'menu 3,1.2', 3, NULL, NULL, ''),
(11, 'menu 4.1', 4, NULL, NULL, ''),
(12, 'menu 4.1.2', 4, NULL, NULL, ''),
(13, 'menu 1.3', 1, '2020-12-25 12:34:19', '2020-12-25 12:34:19', '');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2020_12_11_033507_create_categories_table', 1),
(7, '2020_12_11_192322_create_brands_table', 2),
(8, '2020_12_12_092812_create_users_table', 3),
(9, '2020_12_12_162204_create_slides_table', 4),
(10, '2020_12_12_170723_create_products_table', 5),
(11, '2020_12_12_174353_create_product_images_table', 6),
(13, '2020_12_12_174620_create_tags_table', 7),
(14, '2020_12_12_175039_create_product_tags_table', 8),
(15, '2020_12_15_105129_add_column_feature_image_path', 9),
(16, '2020_12_15_114916_add_column_image_path_to_table_product_images', 10),
(17, '2020_12_18_093841_add_column_deleted_to_sliders', 11),
(18, '2020_12_18_100533_create_settings_table', 12),
(19, '2020_12_18_173237_create_roles_table', 13),
(20, '2020_12_18_173358_create_permissions_table', 13),
(21, '2020_12_18_173511_create_table_user_role', 13),
(22, '2020_12_18_173601_create_table_permission_role', 13),
(23, '2020_12_21_132552_add_column_deleted_at_table_usres', 14),
(24, '2020_12_21_151315_add_column_parent_id_permission', 15),
(25, '2020_12_22_115006_add_column_key_permission_table', 16),
(26, '2020_12_25_142214_create_menus_table', 17),
(28, '2020_12_25_202925_add_column_slug_to_menus_table', 18),
(29, '2020_12_29_122047_create_customers_table', 19),
(30, '2020_12_29_134312_create_contacts_table', 20),
(37, '2021_01_03_144023_create_shippings_table', 21),
(38, '2021_01_03_145006_create_payments_table', 21),
(40, '2021_01_03_210326_create_orders_table', 22),
(41, '2021_01_04_143409_create_orderdetails_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `order_id`, `product_id`, `name`, `price`, `sales_quantity`, `created_at`, `updated_at`) VALUES
(1, 40, 26, 'kimdai huynh', '20000', 1, '2021-01-05 09:57:23', NULL),
(2, 40, 28, 'Váy Đỏ', '20000', 1, '2021-01-05 09:57:23', NULL),
(3, 40, 34, 'san pham 10', '100', 1, '2021-01-05 09:57:23', NULL),
(4, 40, 32, 'san pham 8', '500', 2, '2021-01-05 09:57:23', NULL),
(5, 41, 32, 'san pham 8', '500', 1, '2021-01-06 13:45:40', NULL),
(6, 41, 31, 'Quan ao nam', '3000', 1, '2021-01-06 13:45:40', NULL),
(7, 42, 26, 'kimdai huynh', '20000', 1, '2021-01-06 13:47:33', NULL),
(8, 42, 32, 'san pham 8', '500', 1, '2021-01-06 13:47:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `customer_id`, `shipping_id`, `payment_id`, `total`, `status`, `created_at`, `updated_at`) VALUES
(40, '70d5b', 6, 49, 43, '41,100', 1, '2021-01-05 09:57:23', '2021-01-05 09:57:23'),
(41, 'ff706', 6, 50, 44, '3,500', 1, '2021-01-06 13:45:40', '2021-01-06 13:45:40'),
(42, '17279', 6, 51, 45, '20,500', 1, '2021-01-06 13:47:33', '2021-01-06 13:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `method`, `created_at`, `updated_at`) VALUES
(43, 'ATM', '2021-01-05 09:57:23', '2021-01-05 09:57:23'),
(44, 'ATM', '2021-01-06 13:45:40', '2021-01-06 13:45:40'),
(45, 'ATM', '2021-01-06 13:47:33', '2021-01-06 13:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `key_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `created_at`, `updated_at`, `parent_id`, `key_code`) VALUES
(1, 'category', 'category', '2020-12-23 03:38:50', '2020-12-23 03:38:50', 0, NULL),
(2, 'list', 'list', '2020-12-23 03:38:50', '2020-12-23 03:38:50', 1, 'category-list'),
(3, 'create', 'create', '2020-12-23 03:38:50', '2020-12-23 03:38:50', 1, 'category-create'),
(4, 'edit', 'edit', '2020-12-23 03:38:50', '2020-12-23 03:38:50', 1, 'category-edit'),
(5, 'delete', 'delete', '2020-12-23 03:38:50', '2020-12-23 03:38:50', 1, 'category-delete'),
(6, 'brand', 'brand', '2020-12-23 03:39:14', '2020-12-23 03:39:14', 0, NULL),
(7, 'list', 'list', '2020-12-23 03:39:14', '2020-12-23 03:39:14', 6, 'brand-list'),
(8, 'create', 'create', '2020-12-23 03:39:14', '2020-12-23 03:39:14', 6, 'brand-create'),
(9, 'edit', 'edit', '2020-12-23 03:39:14', '2020-12-23 03:39:14', 6, 'brand-edit'),
(10, 'delete', 'delete', '2020-12-23 03:39:14', '2020-12-23 03:39:14', 6, 'brand-delete'),
(11, 'user', 'user', '2020-12-23 03:39:23', '2020-12-23 03:39:23', 0, NULL),
(12, 'list', 'list', '2020-12-23 03:39:23', '2020-12-23 03:39:23', 11, 'user-list'),
(13, 'create', 'create', '2020-12-23 03:39:23', '2020-12-23 03:39:23', 11, 'user-create'),
(14, 'edit', 'edit', '2020-12-23 03:39:23', '2020-12-23 03:39:23', 11, 'user-edit'),
(15, 'delete', 'delete', '2020-12-23 03:39:23', '2020-12-23 03:39:23', 11, 'user-delete'),
(16, 'slider', 'slider', '2020-12-23 03:39:30', '2020-12-23 03:39:30', 0, NULL),
(17, 'list', 'list', '2020-12-23 03:39:30', '2020-12-23 03:39:30', 16, 'slider-list'),
(18, 'create', 'create', '2020-12-23 03:39:30', '2020-12-23 03:39:30', 16, 'slider-create'),
(19, 'edit', 'edit', '2020-12-23 03:39:30', '2020-12-23 03:39:30', 16, 'slider-edit'),
(20, 'delete', 'delete', '2020-12-23 03:39:30', '2020-12-23 03:39:30', 16, 'slider-delete'),
(21, 'product', 'product', '2020-12-23 03:39:38', '2020-12-23 03:39:38', 0, NULL),
(22, 'list', 'list', '2020-12-23 03:39:38', '2020-12-23 03:39:38', 21, 'product-list'),
(23, 'create', 'create', '2020-12-23 03:39:38', '2020-12-23 03:39:38', 21, 'product-create'),
(24, 'edit', 'edit', '2020-12-23 03:39:38', '2020-12-23 03:39:38', 21, 'product-edit'),
(25, 'delete', 'delete', '2020-12-23 03:39:38', '2020-12-23 03:39:38', 21, 'product-delete'),
(26, 'setting', 'setting', '2020-12-23 03:39:46', '2020-12-23 03:39:46', 0, NULL),
(27, 'list', 'list', '2020-12-23 03:39:46', '2020-12-23 03:39:46', 26, 'setting-list'),
(28, 'create', 'create', '2020-12-23 03:39:46', '2020-12-23 03:39:46', 26, 'setting-create'),
(29, 'edit', 'edit', '2020-12-23 03:39:47', '2020-12-23 03:39:47', 26, 'setting-edit'),
(30, 'delete', 'delete', '2020-12-23 03:39:47', '2020-12-23 03:39:47', 26, 'setting-delete'),
(31, 'role', 'role', '2020-12-23 03:39:57', '2020-12-23 03:39:57', 0, NULL),
(32, 'list', 'list', '2020-12-23 03:39:57', '2020-12-23 03:39:57', 31, 'role-list'),
(33, 'create', 'create', '2020-12-23 03:39:57', '2020-12-23 03:39:57', 31, 'role-create'),
(34, 'edit', 'edit', '2020-12-23 03:39:57', '2020-12-23 03:39:57', 31, 'role-edit'),
(35, 'delete', 'delete', '2020-12-23 03:39:57', '2020-12-23 03:39:57', 31, 'role-delete'),
(36, 'test', 'test', '2020-12-23 03:41:58', '2020-12-23 03:41:58', 0, NULL),
(37, 'list', 'list', '2020-12-23 03:41:58', '2020-12-23 03:41:58', 36, 'test-list'),
(38, 'create', 'create', '2020-12-23 03:41:58', '2020-12-23 03:41:58', 36, 'test-create');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(36, 7, 1, NULL, NULL),
(37, 8, 1, NULL, NULL),
(39, 24, 2, NULL, NULL),
(40, 2, 2, NULL, NULL),
(41, 2, 1, NULL, NULL),
(42, 3, 1, NULL, NULL),
(43, 4, 1, NULL, NULL),
(44, 5, 1, NULL, NULL),
(45, 9, 1, NULL, NULL),
(46, 10, 1, NULL, NULL),
(47, 12, 1, NULL, NULL),
(48, 13, 1, NULL, NULL),
(49, 14, 1, NULL, NULL),
(50, 15, 1, NULL, NULL),
(51, 17, 1, NULL, NULL),
(52, 18, 1, NULL, NULL),
(53, 19, 1, NULL, NULL),
(54, 20, 1, NULL, NULL),
(55, 22, 1, NULL, NULL),
(56, 23, 1, NULL, NULL),
(57, 24, 1, NULL, NULL),
(58, 25, 1, NULL, NULL),
(59, 27, 1, NULL, NULL),
(60, 28, 1, NULL, NULL),
(61, 29, 1, NULL, NULL),
(62, 30, 1, NULL, NULL),
(63, 32, 1, NULL, NULL),
(64, 33, 1, NULL, NULL),
(65, 34, 1, NULL, NULL),
(66, 35, 1, NULL, NULL),
(67, 37, 1, NULL, NULL),
(68, 38, 1, NULL, NULL),
(71, 17, 2, NULL, NULL),
(72, 22, 2, NULL, NULL),
(73, 27, 2, NULL, NULL),
(74, 32, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_views` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `feature_image_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `price`, `feature_image`, `content`, `description`, `number_of_views`, `status`, `category_id`, `brand_id`, `user_id`, `created_at`, `updated_at`, `feature_image_path`) VALUES
(16, 'san pham 4', 'san-pham-4', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasd</p>', NULL, 1, 2, 1, 1, '2021-01-07 15:29:37', '2021-01-07 15:29:37', '/storage/products/1/YuIQF31jFBmGxmmBXTop.jpg'),
(17, 'san pham 4', 'san-pham-4', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasd</p>', 10, 1, 2, 1, 1, '2021-01-07 15:30:38', '2021-01-07 15:43:53', '/storage/products/1/kVvqw5JkfskNWlTx3WqI.jpg'),
(18, 'san pham 4', 'san-pham-4', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasd</p>', NULL, 1, 11, 1, 1, '2020-12-15 13:38:35', '2021-01-07 15:26:50', '/storage/products/1/YI1WnlS4WX07Otat98h3.jpg'),
(19, 'san pham 4', 'san-pham-4', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasd</p>', 8, 1, 1, 1, 1, '2020-12-15 13:38:56', '2021-01-07 15:41:47', '/storage/products/1/d6ZKhPWh2xHX7yFIi93b.jpg'),
(20, 'san pham 4', 'san-pham-4', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasd</p>', 9, 1, 1, 1, 1, '2020-12-15 13:39:10', '2021-01-07 15:39:21', '/storage/products/1/DqJ7JVbePILdNGCNFnSg.jpg'),
(21, 'san pham 4', 'san-pham-4', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasd</p>', NULL, 1, 2, 1, 1, '2021-01-07 15:30:59', '2021-01-07 15:30:59', '/storage/products/1/MeuXa5xaD6Pv5AaxrcDh.jpg'),
(22, 'kimdai', 'kimdai', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>asdas</p>', 1, 1, 2, 1, 1, '2021-01-07 15:42:38', '2021-01-07 15:42:38', '/storage/products/1/uQvvyeKux2ZgSvhf8R9N.jpg'),
(23, 'kimdai huynh', 'kimdai-huynh', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasdasd</p>', NULL, 1, 11, 1, 1, '2020-12-15 13:42:38', '2021-01-07 15:34:10', '/storage/products/1/of7zOjSdOJNaD3Ou3DIX.jpg'),
(24, 'kimdai huynh', 'kimdai-huynh', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasdasd</p>', NULL, 0, 11, 1, 1, '2020-12-15 13:43:07', NULL, '/storage/products/1/hHeWkk1YhPxhocxya12q.jpg'),
(25, 'kimdai huynh', 'kimdai-huynh', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasdasd</p>', 5, 0, 2, 1, 1, '2021-01-07 15:29:07', '2021-01-07 15:31:46', '/storage/products/1/kJQhHWtCWV3tOcDpGjAw.jpg'),
(26, 'kimdai huynh', 'kimdai-huynh', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasdasd</p>', 72, 1, 1, 1, 1, '2020-12-31 06:58:33', '2021-01-07 15:25:05', '/storage/products/1/hGGl70g0fPOocoRhr14c.jpg'),
(27, 'kimdai huynh', 'kimdai-huynh', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>dasdasd</p>', 3, 1, 3, 1, 1, '2021-01-07 15:33:04', '2021-01-07 15:41:56', '/storage/products/1/nFe2VEPmybpk8QXXOSj2.jpg'),
(28, 'Váy Đỏ', 'vay-do', '20000', 'product6.jpg', '<p>asdasd</p>', '<p>sdadasd</p>', 2, 1, 1, 1, 1, '2020-12-25 04:55:56', '2020-12-31 09:39:50', '/storage/products/1/GvUCvprqf1cQAkK7juNE.jpg'),
(29, 'san pham 6', 'san-pham-6', '20000', 'product2.jpg', '<p>asdasdasdasd</p>', '<p>dasxasdasd</p>', 4, 1, 1, 1, 1, '2021-01-07 15:03:29', '2021-01-07 15:25:52', '/storage/products/1/6WMI74qs8aPV428Kw1jq.jpg'),
(30, 'kimdai', 'kimdai', '20000', 'product4.jpg', '<p>asdasdsad</p>', '<p>asdasd</p>', 4, 1, 1, 1, 1, '2021-01-07 14:56:24', '2021-01-07 14:56:24', '/storage/products/1/UObV3SaeLfMsaY8KfB4N.jpg'),
(31, 'Quan ao nam', 'quan-ao-nam', '3000', 'product2.jpg', '<p>asdasdasdas</p>', '<p>asdasd</p>', 14, 1, 1, 3, 1, '2021-01-07 15:06:38', '2021-01-07 15:06:38', '/storage/products/1/7KM3Z9On6LurftG7ibAC.jpg'),
(32, 'san pham 8', 'san-pham-8', '500', 'product1.jpg', '<p>asdasdasd</p>', '<p>adasdasd</p>', 63, 1, 1, 1, 1, '2021-01-07 15:13:27', '2021-01-07 15:13:27', '/storage/products/1/L6zP98U5Jpcdjd4aucwO.jpg'),
(34, 'san pham 10', 'san-pham-10', '100', 'product5.jpg', '<p>asasasasassa</p>', '<p>asasassa</p>', 4, 1, 1, 1, 1, '2021-01-07 15:13:09', '2021-01-07 15:25:38', '/storage/products/1/3lA6xqchhJWOCZrUfe5q.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image`, `product_id`, `created_at`, `updated_at`, `image_path`) VALUES
(1, 'product3.jpg', 27, '2020-12-15 13:44:03', '2020-12-15 13:44:03', '/storage/products/1/WDrATesjewz91hNJynou.jpg'),
(2, 'product4.jpg', 27, '2020-12-15 13:44:03', '2020-12-15 13:44:03', '/storage/products/1/NPjruFl1ugLmeN0zav6v.jpg'),
(3, 'product5.jpg', 27, '2020-12-15 13:44:03', '2020-12-15 13:44:03', '/storage/products/1/ZvoglRVa7cpgbYhe7RYB.jpg'),
(4, 'product3.jpg', 28, '2020-12-16 03:26:25', '2020-12-16 03:26:25', '/storage/products/1/Len3h2gGHTwHyVk3quJY.jpg'),
(5, 'product4.jpg', 28, '2020-12-16 03:26:25', '2020-12-16 03:26:25', '/storage/products/1/uAXi8yK70LZT1m9E4k0E.jpg'),
(6, 'product5 - Copy.jpg', 28, '2020-12-16 03:26:25', '2020-12-16 03:26:25', '/storage/products/1/rQaELYbXt9iqNY9oUft4.jpg'),
(7, 'product3.jpg', 29, '2020-12-16 04:10:12', '2020-12-16 04:10:12', '/storage/products/1/uSdphFISsmzlekxJuoIg.jpg'),
(8, 'product4.jpg', 29, '2020-12-16 04:10:12', '2020-12-16 04:10:12', '/storage/products/1/J0TCNZTw9F22uZ73evsS.jpg'),
(9, 'product6.jpg', 29, '2020-12-16 04:10:12', '2020-12-16 04:10:12', '/storage/products/1/pDpgIcT9gfGCL175m6s0.jpg'),
(10, 'product5.jpg', 30, '2020-12-16 04:19:22', '2020-12-16 04:19:22', '/storage/products/1/iLZfyvZNMbx7nc82IUbl.jpg'),
(11, 'product6.jpg', 30, '2020-12-16 04:19:22', '2020-12-16 04:19:22', '/storage/products/1/ZXF682jUyK1T1Zp9U7wn.jpg'),
(15, 'product3.jpg', 32, '2020-12-16 05:41:58', '2020-12-16 05:41:58', '/storage/products/1/zq8LK16a4TYYx7ZoXVvI.jpg'),
(16, 'product4.jpg', 32, '2020-12-16 05:41:58', '2020-12-16 05:41:58', '/storage/products/1/dt0dvMX3bE9EBYrQnGhk.jpg'),
(17, 'gallery4.jpg', 34, '2020-12-16 06:52:58', '2020-12-16 06:52:58', '/storage/products/1/spTZGnWqrVFstpCuxoBQ.jpg'),
(18, 'girl1.jpg', 34, '2020-12-16 06:52:58', '2020-12-16 06:52:58', '/storage/products/1/PVIZ19aNuVtqqlpoJRYn.jpg'),
(19, 'girl2.jpg', 34, '2020-12-16 06:52:58', '2020-12-16 06:52:58', '/storage/products/1/s4mf5qdRGlIn1HjeqGk2.jpg'),
(20, 'girl3.jpg', 34, '2020-12-16 06:52:58', '2020-12-16 06:52:58', '/storage/products/1/bV9E5BYlaPKqQOn99ssz.jpg'),
(22, 'product3.jpg', 31, '2020-12-17 04:15:42', '2020-12-17 04:15:42', '/storage/products/1/2QjS71TKMvOzWCHBY1h3.jpg'),
(23, 'product4.jpg', 31, '2020-12-17 04:15:42', '2020-12-17 04:15:42', '/storage/products/1/m9v2gc21qWX4rvpSSdxA.jpg'),
(24, 'product5 - Copy.jpg', 31, '2020-12-17 04:15:42', '2020-12-17 04:15:42', '/storage/products/1/AhzYkzJHYB5Q6DYm55yh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`id`, `product_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 29, 1, '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(2, 29, 2, '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(3, 29, 3, '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(4, 29, 4, '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(5, 29, 5, '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(6, 30, 1, '2020-12-16 04:19:22', '2020-12-16 04:19:22'),
(10, 32, 9, '2020-12-16 05:41:58', '2020-12-16 05:41:58'),
(11, 34, 7, '2020-12-16 06:52:58', '2020-12-16 06:52:58'),
(39, 31, 37, '2020-12-17 04:18:16', '2020-12-17 04:18:16'),
(40, 31, 38, '2020-12-17 04:18:16', '2020-12-17 04:18:16'),
(41, 31, 39, '2020-12-31 06:44:36', '2020-12-31 06:44:36'),
(42, 31, 2, '2020-12-31 06:44:36', '2020-12-31 06:44:36'),
(43, 31, 40, '2020-12-31 06:44:36', '2020-12-31 06:44:36'),
(44, 32, 7, '2020-12-31 06:45:22', '2020-12-31 06:45:22'),
(45, 32, 3, '2020-12-31 06:45:22', '2020-12-31 06:45:22'),
(46, 26, 41, '2020-12-31 06:58:33', '2020-12-31 06:58:33'),
(47, 26, 42, '2020-12-31 06:58:33', '2020-12-31 06:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Quản trị hệ thống', '2020-12-21 02:41:34', NULL),
(2, 'guest', 'Khách hàng', '2020-12-21 02:41:34', NULL),
(3, 'developer', 'Phát triển hệ thống', '2020-12-21 02:42:35', NULL),
(4, 'content', 'Chỉnh sửa nội dung', '2020-12-21 02:43:16', NULL),
(8, 'editor 1', 'nguoi soạn thảo van bản', '2020-12-22 05:47:28', '2020-12-22 06:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(5, 20, 3, NULL, NULL),
(6, 20, 4, NULL, NULL),
(7, 21, 4, NULL, NULL),
(9, 22, 4, NULL, NULL),
(10, 22, 3, NULL, NULL),
(11, 1, 1, NULL, NULL),
(12, 23, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `config_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `config_key`, `config_value`, `created_at`, `updated_at`) VALUES
(2, 'contact_phone', '+2 95 01 88 821', '2020-12-25 05:06:50', '2020-12-25 05:06:50'),
(3, 'email', 'huynhtrongdaiz@gmail.com', '2020-12-25 05:07:28', '2020-12-25 05:07:28'),
(4, 'facebook_link', 'https://www.facebook.com/Shop_Demo-110735967464023', '2020-12-25 05:09:47', '2020-12-25 05:09:47'),
(5, 'footer_config', '<p class=\"pull-left\">Copyright By KimDaiHuynh © 2020 E-SHOPPER Inc. All rights reserved.</p>\r\n<p class=\"pull-right\">Designed by <span><a target=\"_blank\" href=\"http://www.themeum.com\">Themeum</a></span></p>', '2020-12-25 05:11:00', '2020-12-25 05:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `lastname`, `middlename`, `firstname`, `phone`, `email`, `address`, `note`, `customer_id`, `created_at`, `updated_at`) VALUES
(49, 'huynh', 'trong', 'dai', '0389297385', 'huynhtrongdaiz@gmail.com', 'soc trang xa đại ăn 2', NULL, 6, '2021-01-05 09:57:23', '2021-01-05 09:57:23'),
(50, 'huynh', 'trong', 'dai', '0389297385', 'daihuynhtrong@viendong.edu.vn', 'asd', NULL, 6, '2021-01-06 13:45:40', '2021-01-06 13:45:40'),
(51, 'huynh', 'kim', 'dai', '0389297385', 'daihuynhtrong@viendong.edu.vn', 'asd', NULL, 6, '2021-01-06 13:47:33', '2021-01-06 13:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `description`, `image_path`, `image_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Váy Đỏ', '<p>vay do</p>', '/storage/slider/1/NAinjsezJKIDfusXpBPR.jpg', 'girl3.jpg', 0, '2020-12-18 02:41:38', '2020-12-18 02:44:57', '2020-12-18 02:44:57'),
(3, 'Free E-Commerce Template', '<div class=\"col-sm-6\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n</div>\r\n<div class=\"col-sm-6\">&nbsp;</div>', '/storage/slider/1/uYw3HmkceHf5fSNjODZL.jpg', 'girl3.jpg', 1, '2020-12-24 08:56:32', '2020-12-31 10:05:34', NULL),
(4, 'Free Ecommerce Template', '<div class=\"col-sm-6\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n</div>', '/storage/slider/1/axM6Josrzq2onuCxgtW1.jpg', 'girl2.jpg', 1, '2020-12-24 08:57:14', '2020-12-31 10:06:26', NULL),
(5, 'Free E-Commerce Template 2', '<div class=\"col-sm-6\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n</div>', '/storage/slider/1/n52c3wbc03ZXE2NQAWUJ.jpg', 'girl1.jpg', 1, '2020-12-24 08:58:13', '2020-12-31 10:06:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'quan ao', '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(2, 'ao thun', '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(3, 'phụ nữ', '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(4, 'Men', '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(5, 'trẻ em', '2020-12-16 04:10:12', '2020-12-16 04:10:12'),
(6, 'nu', '2020-12-16 05:10:29', '2020-12-16 05:10:29'),
(7, 'ao nu', '2020-12-16 05:10:29', '2020-12-16 05:10:29'),
(8, 'quan nu', '2020-12-16 05:10:29', '2020-12-16 05:10:29'),
(9, 'ao', '2020-12-16 05:41:58', '2020-12-16 05:41:58'),
(10, '6', '2020-12-17 04:02:06', '2020-12-17 04:02:06'),
(11, '7', '2020-12-17 04:02:06', '2020-12-17 04:02:06'),
(12, '8', '2020-12-17 04:02:06', '2020-12-17 04:02:06'),
(13, '10', '2020-12-17 04:04:13', '2020-12-17 04:04:13'),
(14, '11', '2020-12-17 04:04:13', '2020-12-17 04:04:13'),
(15, '12', '2020-12-17 04:04:13', '2020-12-17 04:04:13'),
(16, '13', '2020-12-17 04:08:29', '2020-12-17 04:08:29'),
(17, '14', '2020-12-17 04:08:29', '2020-12-17 04:08:29'),
(18, '15', '2020-12-17 04:08:29', '2020-12-17 04:08:29'),
(19, '16', '2020-12-17 04:09:13', '2020-12-17 04:09:13'),
(20, '17', '2020-12-17 04:09:13', '2020-12-17 04:09:13'),
(21, '18', '2020-12-17 04:09:13', '2020-12-17 04:09:13'),
(22, '19', '2020-12-17 04:09:34', '2020-12-17 04:09:34'),
(23, '20', '2020-12-17 04:09:34', '2020-12-17 04:09:34'),
(24, '21', '2020-12-17 04:09:34', '2020-12-17 04:09:34'),
(25, '22', '2020-12-17 04:13:29', '2020-12-17 04:13:29'),
(26, '23', '2020-12-17 04:13:29', '2020-12-17 04:13:29'),
(27, '24', '2020-12-17 04:13:29', '2020-12-17 04:13:29'),
(28, '25', '2020-12-17 04:14:18', '2020-12-17 04:14:18'),
(29, '26', '2020-12-17 04:14:18', '2020-12-17 04:14:18'),
(30, '27', '2020-12-17 04:14:18', '2020-12-17 04:14:18'),
(31, '28', '2020-12-17 04:15:42', '2020-12-17 04:15:42'),
(32, '29', '2020-12-17 04:15:42', '2020-12-17 04:15:42'),
(33, '30', '2020-12-17 04:15:42', '2020-12-17 04:15:42'),
(34, '31', '2020-12-17 04:16:02', '2020-12-17 04:16:02'),
(35, '32', '2020-12-17 04:16:02', '2020-12-17 04:16:02'),
(36, '33', '2020-12-17 04:16:02', '2020-12-17 04:16:02'),
(37, 'nam', '2020-12-17 04:18:16', '2020-12-17 04:18:16'),
(38, 'ao nam', '2020-12-17 04:18:16', '2020-12-17 04:18:16'),
(39, 'ao so mi', '2020-12-31 06:44:36', '2020-12-31 06:44:36'),
(40, 'ao thun nam', '2020-12-31 06:44:36', '2020-12-31 06:44:36'),
(41, 'áp thun', '2020-12-31 06:58:33', '2020-12-31 06:58:33'),
(42, 'áp thun nữ', '2020-12-31 06:58:33', '2020-12-31 06:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'no-avata.png',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kimdai', 'huynhtrongdaiz@gmail.com', 'SByG_126207638_1796121333884908_1744507912741236144_o.jpg', '$2y$10$4FTtMkfYmJxvMClpV.Nase.wB.Q91eS.2lCkkSffoqnqN3TebZrki', NULL, '2020-12-12 02:41:51', '2020-12-12 04:36:58', NULL),
(21, 'huynh trong dai', 'kimcuong@gmail.com', 'no-avata.png', '$2y$10$bPFckjJ8as.agHw8VAXm.eMY8oIb.Lz7dWOXuh9CwLXiTl/J3kUt.', NULL, '2020-12-21 04:19:36', '2020-12-21 07:19:57', '2020-12-21 07:19:57'),
(22, 'Váy Trắng', 'phubui2702@gmail.com', 'no-avata.png', '$2y$10$g6G.X3POham8VgrMYJVYEO2F/zaBHnLlsAT03JqcHE60sPHeOec.u', NULL, '2020-12-21 04:51:02', '2020-12-21 07:19:51', '2020-12-21 07:19:51'),
(23, 'huynh trong dai', 'daihuynhtrong@viendong.edu.vn', 'no-avata.png', '$2y$10$YCz/AHfgBhXDH/dQPMKFR.taiF0MGJcIaUVH4THu1A8IGZF.1BfEO', NULL, '2020-12-22 07:45:29', '2020-12-22 07:45:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderdetails_order_id_foreign` (`order_id`),
  ADD KEY `orderdetails_product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_shipping_id_foreign` (`shipping_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tags_product_id_foreign` (`product_id`),
  ADD KEY `product_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderdetails_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `orders_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD CONSTRAINT `product_tags_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
