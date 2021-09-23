-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 08:21 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quecommerz`
--

-- --------------------------------------------------------

--
-- Table structure for table `qq_app_seos`
--

CREATE TABLE `qq_app_seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qq_app_settings`
--

CREATE TABLE `qq_app_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qq_attributes`
--

CREATE TABLE `qq_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qq_brands`
--

CREATE TABLE `qq_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qq_brands`
--

INSERT INTO `qq_brands` (`id`, `uuid`, `brand`, `slug`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(3, '945ad6fa-3dd4-407b-acaf-cb3e41e521a2', 'Adidas', 'adidas', NULL, 'brands/adidas.png', '2021-09-09 03:12:26', '2021-09-09 03:12:26'),
(4, '945ad735-07d0-4ac7-984c-744444e73838', 'Kotlin', 'kotlin', 'this  is kotlin description', 'brands/kotlin.png', '2021-09-09 03:13:05', '2021-09-09 03:13:05'),
(5, '945ae5ad-1b55-4585-9958-0738cc7da226', 'Javascript', 'javascript', NULL, 'brands/javascript.png', '2021-09-09 03:53:33', '2021-09-09 03:53:33'),
(6, '945ae690-301c-467d-9e48-b019d9216f06', 'Swift brand', 'swift-brand', NULL, 'brands/swift-brand.png', '2021-09-09 03:56:01', '2021-09-09 03:56:01'),
(8, '945ae6cf-0579-43dc-a82c-f7d531f8dfea', 'Flutter', 'flutter', NULL, 'brands/flutter.png', '2021-09-09 03:56:42', '2021-09-09 03:56:42'),
(10, '945ae723-bf61-42ea-ad2e-c13a946434ff', 'Xamarin', 'xamarin', NULL, 'brands/xamarin.png', '2021-09-09 03:57:38', '2021-09-09 03:57:38'),
(11, '945ae743-b920-41a6-9813-e253e41c782a', 'Ionic', 'ionic', NULL, 'brands/ionic.png', '2021-09-09 03:57:59', '2021-09-09 03:57:59'),
(12, '94647bf8-cc72-4962-adff-2d2c3c3eaa75', 'Nike', 'nike', NULL, 'brands/nike.png', '2021-09-13 22:16:16', '2021-09-13 22:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `qq_categories`
--

CREATE TABLE `qq_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qq_categories`
--

INSERT INTO `qq_categories` (`id`, `uuid`, `parent_id`, `category`, `slug`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(25, '94590c91-5207-4475-bf0b-c4b2ba7c2f44', NULL, 'Watches', 'watches', NULL, NULL, '2021-09-08 05:50:38', '2021-09-08 05:50:38'),
(28, '94590cc4-e9c8-4b10-b165-855e74b8402b', NULL, 'Shirt', 'shirt', NULL, NULL, '2021-09-08 05:51:12', '2021-09-08 05:51:12'),
(29, '94590cca-918d-402c-ab9c-725d59a150fb', NULL, 'Sharee', 'sharee', NULL, NULL, '2021-09-08 05:51:16', '2021-09-08 05:51:16'),
(30, '945a9118-0d82-416d-92fa-2bae16afe0a7', NULL, 'Men\'s fashion', 'mens-fashion', NULL, NULL, '2021-09-08 23:57:02', '2021-09-08 23:57:02'),
(31, '945a925b-b60e-42fc-bd4c-1fc15efb0762', 30, 'Jeans', 'jeans', NULL, NULL, '2021-09-09 00:00:34', '2021-09-09 00:00:34'),
(32, '945aab39-0d0e-4cae-a422-fd20ac20d6aa', NULL, 'Women\'s Fashion', 'womens-fashion', NULL, NULL, '2021-09-09 01:10:06', '2021-09-09 01:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `qq_failed_jobs`
--

CREATE TABLE `qq_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qq_migrations`
--

CREATE TABLE `qq_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qq_migrations`
--

INSERT INTO `qq_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_08_31_054412_add_avatar_to_users_table', 1),
(6, '2021_08_31_054647_add_status_column_to_users_table', 1),
(7, '2021_08_31_054820_create_user_infos_table', 1),
(8, '2021_08_31_054851_add_uuid_column_to_users_table', 1),
(9, '2021_08_31_055012_create_activities_table', 1),
(10, '2021_08_31_060248_create_categories_table', 1),
(11, '2021_08_31_060259_create_brands_table', 1),
(12, '2021_08_31_060400_create_app_settings_table', 1),
(13, '2021_08_31_092515_create_attributes_table', 1),
(14, '2021_08_31_092544_create_products_table', 1),
(15, '2021_08_31_094040_create_product_variants_table', 1),
(16, '2021_08_31_094322_create_product_variant_options_table', 1),
(17, '2021_08_31_094334_create_product_images_table', 1),
(18, '2021_08_31_100555_create_unit_types_table', 1),
(19, '2021_08_31_100629_add_unit_type_id_column_to_products_table', 1),
(20, '2021_08_31_105903_create_product_seos_table', 1),
(21, '2021_08_31_110441_create_product_stocks_table', 1),
(22, '2021_08_31_111959_create_app_seos_table', 1),
(25, '2021_09_06_092950_create_temporary_files_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `qq_password_resets`
--

CREATE TABLE `qq_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qq_personal_access_tokens`
--

CREATE TABLE `qq_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qq_products`
--

CREATE TABLE `qq_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `discount_type` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` int(11) NOT NULL DEFAULT 1,
  `unit_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qq_products`
--

INSERT INTO `qq_products` (`id`, `uuid`, `sku`, `product`, `slug`, `descriptions`, `category_id`, `brand_id`, `price`, `discount`, `discount_type`, `unit`, `unit_type_id`, `thumbnail`, `alt`, `publish`, `status`, `created_at`, `updated_at`) VALUES
(2, '9468d08a-0f94-4449-91a2-816190b4393a', 'Sample-123', 'Sample product', 'sample-product', '<p>lorem</p>', 25, 3, 100.00, 10.00, 'flat', 1, 1, 'sample-product.jpeg', 'sample-product', 1, 1, '2021-09-16 01:56:02', '2021-09-16 01:56:02'),
(3, '9468d2ca-f959-4182-a4b8-c9dea61327fb', 'Sample-123456', 'Sample product two', 'sample-product-two', NULL, 28, 6, 50.00, 5.00, 'percent', 1, 1, 'sample-product-two.jpeg', 'sample-product-two', 1, 1, '2021-09-16 02:02:20', '2021-09-16 02:02:20'),
(4, '9468d3f0-9f31-4f72-b4bd-bcbb8d0d1fe5', 'Sample-1234', 'Sample product three', 'sample-product-three', NULL, 28, 4, 60.00, 1.00, 'percent', 1, 1, 'sample-product-three.jpeg', 'sample-product-three', 0, 0, '2021-09-16 02:05:32', '2021-09-16 02:05:32'),
(5, '9468d695-f8b8-481f-bd28-aa9316e87b7b', 'Sample-654', 'Sample product four', 'sample-product-four', NULL, 29, 10, 100.00, 0.00, NULL, 1, 1, 'sample-product-four.jpeg', 'sample-product-four', 1, 1, '2021-09-16 02:12:57', '2021-09-16 02:12:57'),
(6, '9468d74e-82e3-4b48-91bf-9fa3dda03e9a', 'Sample-12325', 'Sample product five', 'sample-product-five', NULL, 25, 5, 230.00, 30.00, 'percent', 1, 1, 'sample-product-five.jpeg', 'sample-product-five', 1, 1, '2021-09-16 02:14:57', '2021-09-16 02:14:57'),
(7, '9468dc8d-c1a9-4e41-9c58-12bb0f70e6ab', 'Sample-12369', 'Sample product six', 'sample-product-six', NULL, 30, 11, 200.00, 10.00, 'percent', 1, 1, 'sample-product-six.jpeg', 'sample-product-six', 1, 1, '2021-09-16 02:29:38', '2021-09-16 02:29:38'),
(8, '9468dfa2-02a7-40aa-be73-e9c2ee225060', NULL, 'sample product 778899', 'sample-product-778899', NULL, 31, 12, 100.00, 0.00, 'flat', 1, 1, 'sample-product-778899.jpeg', 'sample-product-778899', 1, 1, '2021-09-16 02:38:14', '2021-09-16 02:38:14'),
(9, '9468f222-5f78-4592-8188-4272f9ab349f', 'sample-product-531', 'sample product seven', 'sample-product-seven', '<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h2><p><br></p><p>Donec imperdiet congue ligula, sit amet feugiat nisl vehicula et. Phasellus faucibus nisi id mi hendrerit, sollicitudin interdum odio ultricies. Vivamus vestibulum feugiat lacus, vitae ultricies felis auctor at. Sed quis sollicitudin velit. Donec tortor lacus, faucibus vitae efficitur vel, semper vitae nunc. Vivamus odio lectus, malesuada quis fermentum et, sollicitudin eu turpis. Morbi eu leo ante. Praesent ut bibendum mi, feugiat rhoncus mauris. Nam malesuada augue sapien, ut condimentum augue egestas vitae.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque euismod sollicitudin iaculis. Phasellus nec sollicitudin lacus. Cras at imperdiet nulla. Nam et elit placerat, consectetur dolor sit amet, vestibulum nunc. Mauris at diam ac est fermentum hendrerit id dignissim enim. Mauris arcu ex, convallis at elit id, rutrum feugiat tortor. Mauris faucibus tellus eu augue finibus lacinia.</p><p><br></p><p>Quisque metus tellus, dictum eu egestas id, <strong><em>euismod et risus. Cras ac condimentum urna,</em></strong> in vulputate libero. Phasellus vestibulum, ligula vel sodales fermentum, dui dui tristique urna, ac interdum felis dui luctus sem. Morbi ultricies metus at blandit eleifend. In tristique leo purus, et pulvinar nisl ultricies nec. Proin quis ipsum accumsan, sollicitudin erat vitae, rhoncus ante. </p><p><br></p><ol><li>Praesent consectetur sem sit amet tellus rhoncus,</li><li> vitae fringilla ipsum sodales.</li><li>Phasellus ultrices non ligula nec laoreet.</li></ol>', 25, 8, 200.00, 0.00, 'flat', 1, 1, 'sample-product-seven.jpeg', 'sample-product-seven', 1, 1, '2021-09-16 03:29:58', '2021-09-16 03:29:58'),
(10, '9468f924-a13b-45ad-afbe-5b72c4639fcc', 'product1223221', 'Smaple product eight', 'smaple-product-eight', NULL, 32, 10, 233.00, 0.00, 'flat', 1, 1, 'smaple-product-eight.jpeg', 'smaple-product-eight', 1, 1, '2021-09-16 03:49:34', '2021-09-16 03:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `qq_product_images`
--

CREATE TABLE `qq_product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qq_product_images`
--

INSERT INTO `qq_product_images` (`id`, `product_id`, `image`, `alt`, `extension`, `created_at`, `updated_at`) VALUES
(5, 3, 'sample-product-two(0).jpeg', 'sample-product-two(0).jpeg', '.jpeg', '2021-09-16 02:02:20', '2021-09-16 02:02:20'),
(6, 3, 'sample-product-two(1).jpeg', 'sample-product-two(1).jpeg', '.jpeg', '2021-09-16 02:02:21', '2021-09-16 02:02:21'),
(7, 3, 'sample-product-two(2).jpeg', 'sample-product-two(2).jpeg', '.jpeg', '2021-09-16 02:02:21', '2021-09-16 02:02:21'),
(8, 4, 'sample-product-three(0).jpeg', 'sample-product-three(0).jpeg', '.jpeg', '2021-09-16 02:05:32', '2021-09-16 02:05:32'),
(9, 4, 'sample-product-three(1).jpeg', 'sample-product-three(1).jpeg', '.jpeg', '2021-09-16 02:05:33', '2021-09-16 02:05:33'),
(10, 4, 'sample-product-three(2).jpeg', 'sample-product-three(2).jpeg', '.jpeg', '2021-09-16 02:05:33', '2021-09-16 02:05:33'),
(11, 5, 'sample-product-four(0).jpeg', 'sample-product-four(0).jpeg', '.jpeg', '2021-09-16 02:12:57', '2021-09-16 02:12:57'),
(12, 5, 'sample-product-four(1).jpeg', 'sample-product-four(1).jpeg', '.jpeg', '2021-09-16 02:12:57', '2021-09-16 02:12:57'),
(13, 5, 'sample-product-four(2).jpeg', 'sample-product-four(2).jpeg', '.jpeg', '2021-09-16 02:12:57', '2021-09-16 02:12:57'),
(14, 6, 'sample-product-five(0).jpeg', 'sample-product-five(0).jpeg', '.jpeg', '2021-09-16 02:14:57', '2021-09-16 02:14:57'),
(15, 6, 'sample-product-five(1).jpeg', 'sample-product-five(1).jpeg', '.jpeg', '2021-09-16 02:14:58', '2021-09-16 02:14:58'),
(16, 6, 'sample-product-five(2).jpeg', 'sample-product-five(2).jpeg', '.jpeg', '2021-09-16 02:14:58', '2021-09-16 02:14:58'),
(17, 6, 'sample-product-five(3).jpeg', 'sample-product-five(3).jpeg', '.jpeg', '2021-09-16 02:14:58', '2021-09-16 02:14:58'),
(18, 7, 'sample-product-six(0).jpeg', 'sample-product-six(0).jpeg', '.jpeg', '2021-09-16 02:29:38', '2021-09-16 02:29:38'),
(19, 7, 'sample-product-six(1).jpeg', 'sample-product-six(1).jpeg', '.jpeg', '2021-09-16 02:29:38', '2021-09-16 02:29:38'),
(20, 7, 'sample-product-six(2).jpeg', 'sample-product-six(2).jpeg', '.jpeg', '2021-09-16 02:29:38', '2021-09-16 02:29:38'),
(21, 7, 'sample-product-six(3).jpeg', 'sample-product-six(3).jpeg', '.jpeg', '2021-09-16 02:29:39', '2021-09-16 02:29:39'),
(22, 8, 'sample-product-778899(0).jpeg', 'sample-product-778899(0).jpeg', '.jpeg', '2021-09-16 02:38:14', '2021-09-16 02:38:14'),
(23, 8, 'sample-product-778899(1).jpeg', 'sample-product-778899(1).jpeg', '.jpeg', '2021-09-16 02:38:14', '2021-09-16 02:38:14'),
(24, 8, 'sample-product-778899(2).jpeg', 'sample-product-778899(2).jpeg', '.jpeg', '2021-09-16 02:38:15', '2021-09-16 02:38:15'),
(25, 9, 'sample-product-seven(0).jpeg', 'sample-product-seven(0).jpeg', '.jpeg', '2021-09-16 03:29:58', '2021-09-16 03:29:58'),
(26, 9, 'sample-product-seven(1).jpeg', 'sample-product-seven(1).jpeg', '.jpeg', '2021-09-16 03:29:59', '2021-09-16 03:29:59'),
(27, 9, 'sample-product-seven(2).jpeg', 'sample-product-seven(2).jpeg', '.jpeg', '2021-09-16 03:29:59', '2021-09-16 03:29:59'),
(28, 9, 'sample-product-seven(3).jpeg', 'sample-product-seven(3).jpeg', '.jpeg', '2021-09-16 03:29:59', '2021-09-16 03:29:59'),
(29, 10, 'smaple-product-eight_0.jpeg', 'smaple-product-eight_0.jpeg', '.jpeg', '2021-09-16 03:49:34', '2021-09-16 03:49:34'),
(30, 10, 'smaple-product-eight_1.jpeg', 'smaple-product-eight_1.jpeg', '.jpeg', '2021-09-16 03:49:34', '2021-09-16 03:49:34'),
(31, 10, 'smaple-product-eight_2.jpeg', 'smaple-product-eight_2.jpeg', '.jpeg', '2021-09-16 03:49:35', '2021-09-16 03:49:35'),
(32, 10, 'smaple-product-eight_3.jpeg', 'smaple-product-eight_3.jpeg', '.jpeg', '2021-09-16 03:49:35', '2021-09-16 03:49:35'),
(33, 10, 'smaple-product-eight_4.jpeg', 'smaple-product-eight_4.jpeg', '.jpeg', '2021-09-16 03:49:35', '2021-09-16 03:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `qq_product_seos`
--

CREATE TABLE `qq_product_seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qq_product_seos`
--

INSERT INTO `qq_product_seos` (`id`, `product_id`, `keywords`, `tags`, `descriptions`, `created_at`, `updated_at`) VALUES
(1, 2, 'watch', 'watch', 'this watch', '2021-09-16 01:56:02', '2021-09-16 01:56:02'),
(2, 3, 'shirt', 'shirt', 'shirt', '2021-09-16 02:02:20', '2021-09-16 02:02:20'),
(3, 4, NULL, NULL, NULL, '2021-09-16 02:05:32', '2021-09-16 02:05:32'),
(4, 5, NULL, NULL, NULL, '2021-09-16 02:12:57', '2021-09-16 02:12:57'),
(5, 6, NULL, NULL, NULL, '2021-09-16 02:14:57', '2021-09-16 02:14:57'),
(6, 7, NULL, NULL, NULL, '2021-09-16 02:29:38', '2021-09-16 02:29:38'),
(7, 8, NULL, NULL, NULL, '2021-09-16 02:38:14', '2021-09-16 02:38:14'),
(8, 9, NULL, NULL, NULL, '2021-09-16 03:29:58', '2021-09-16 03:29:58'),
(9, 10, NULL, NULL, NULL, '2021-09-16 03:49:34', '2021-09-16 03:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `qq_product_stocks`
--

CREATE TABLE `qq_product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 1,
  `unit_price` double(8,2) NOT NULL DEFAULT 0.00,
  `purchase_price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qq_product_variants`
--

CREATE TABLE `qq_product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qq_product_variant_options`
--

CREATE TABLE `qq_product_variant_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `SKU` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qq_unit_types`
--

CREATE TABLE `qq_unit_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qq_unit_types`
--

INSERT INTO `qq_unit_types` (`id`, `unit_type`, `created_at`, `updated_at`) VALUES
(1, 'pcs', NULL, NULL),
(2, 'kg', NULL, NULL),
(3, 'gm', NULL, NULL),
(4, 'liter', NULL, NULL),
(5, 'ml', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qq_app_seos`
--
ALTER TABLE `qq_app_seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qq_app_settings`
--
ALTER TABLE `qq_app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qq_attributes`
--
ALTER TABLE `qq_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qq_brands`
--
ALTER TABLE `qq_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qq_categories`
--
ALTER TABLE `qq_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qq_categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `qq_failed_jobs`
--
ALTER TABLE `qq_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `qq_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `qq_migrations`
--
ALTER TABLE `qq_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qq_password_resets`
--
ALTER TABLE `qq_password_resets`
  ADD KEY `qq_password_resets_email_index` (`email`);

--
-- Indexes for table `qq_personal_access_tokens`
--
ALTER TABLE `qq_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `qq_personal_access_tokens_token_unique` (`token`),
  ADD KEY `qq_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `qq_products`
--
ALTER TABLE `qq_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qq_products_category_id_foreign` (`category_id`),
  ADD KEY `qq_products_brand_id_foreign` (`brand_id`),
  ADD KEY `qq_products_unit_type_id_foreign` (`unit_type_id`);

--
-- Indexes for table `qq_product_images`
--
ALTER TABLE `qq_product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qq_product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `qq_product_seos`
--
ALTER TABLE `qq_product_seos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qq_product_seos_product_id_foreign` (`product_id`);

--
-- Indexes for table `qq_product_stocks`
--
ALTER TABLE `qq_product_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qq_product_stocks_product_id_foreign` (`product_id`),
  ADD KEY `qq_product_stocks_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `qq_product_variants`
--
ALTER TABLE `qq_product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qq_product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `qq_product_variant_options`
--
ALTER TABLE `qq_product_variant_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qq_product_variant_options_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `qq_unit_types`
--
ALTER TABLE `qq_unit_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qq_app_seos`
--
ALTER TABLE `qq_app_seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qq_app_settings`
--
ALTER TABLE `qq_app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qq_attributes`
--
ALTER TABLE `qq_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qq_brands`
--
ALTER TABLE `qq_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `qq_categories`
--
ALTER TABLE `qq_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `qq_failed_jobs`
--
ALTER TABLE `qq_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qq_migrations`
--
ALTER TABLE `qq_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `qq_personal_access_tokens`
--
ALTER TABLE `qq_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qq_products`
--
ALTER TABLE `qq_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `qq_product_images`
--
ALTER TABLE `qq_product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `qq_product_seos`
--
ALTER TABLE `qq_product_seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `qq_product_stocks`
--
ALTER TABLE `qq_product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qq_product_variants`
--
ALTER TABLE `qq_product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qq_product_variant_options`
--
ALTER TABLE `qq_product_variant_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qq_unit_types`
--
ALTER TABLE `qq_unit_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `qq_categories`
--
ALTER TABLE `qq_categories`
  ADD CONSTRAINT `qq_categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `qq_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `qq_products`
--
ALTER TABLE `qq_products`
  ADD CONSTRAINT `qq_products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `qq_brands` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `qq_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `qq_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `qq_products_unit_type_id_foreign` FOREIGN KEY (`unit_type_id`) REFERENCES `qq_unit_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `qq_product_images`
--
ALTER TABLE `qq_product_images`
  ADD CONSTRAINT `qq_product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `qq_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qq_product_seos`
--
ALTER TABLE `qq_product_seos`
  ADD CONSTRAINT `qq_product_seos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `qq_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qq_product_stocks`
--
ALTER TABLE `qq_product_stocks`
  ADD CONSTRAINT `qq_product_stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `qq_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qq_product_stocks_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `qq_product_variants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qq_product_variants`
--
ALTER TABLE `qq_product_variants`
  ADD CONSTRAINT `qq_product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `qq_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qq_product_variant_options`
--
ALTER TABLE `qq_product_variant_options`
  ADD CONSTRAINT `qq_product_variant_options_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `qq_product_variants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
