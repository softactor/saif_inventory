--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_datetime` datetime NOT NULL,
  `featured_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cannonical_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Published','Draft','InActive','Scheduled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_map_categories`
--

CREATE TABLE `blog_map_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_map_tags`
--

CREATE TABLE `blog_map_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `entity_id` int(10) UNSIGNED DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assets` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `type_id`, `user_id`, `entity_id`, `icon`, `class`, `text`, `assets`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 49, 'plus', 'bg-green', 'trans(\"history.backend.permissions.created\") <strong>create-plant-equipment</strong>', NULL, '2019-01-22 05:42:35', '2019-01-22 05:42:35'),
(2, 3, 1, 49, 'save', 'bg-aqua', 'trans(\"history.backend.permissions.updated\") <strong>create-plant-equipment</strong>', NULL, '2019-01-22 05:43:48', '2019-01-22 05:43:48'),
(3, 2, 1, 2, 'save', 'bg-aqua', 'trans(\"history.backend.roles.updated\") <strong>Executive</strong>', NULL, '2019-01-22 05:46:25', '2019-01-22 05:46:25'),
(4, 1, 1, 4, 'plus', 'bg-green', 'trans(\"history.backend.users.created\") <strong>{user}</strong>', '{\"user_link\":[\"admin.access.user.show\",\"Rashed Al Banna\",4]}', '2019-02-04 03:18:51', '2019-02-04 03:18:51'),
(5, 1, 1, 4, 'save', 'bg-aqua', 'trans(\"history.backend.users.updated\") <strong>{user}</strong>', '{\"user_link\":[\"admin.access.user.show\",\"Rashed Al Banna\",4]}', '2019-02-04 03:21:04', '2019-02-04 03:21:04'),
(6, 3, 1, 50, 'plus', 'bg-green', 'trans(\"history.backend.permissions.created\") <strong>edit-plant-equipment</strong>', NULL, '2019-02-09 22:20:08', '2019-02-09 22:20:08'),
(7, 3, 1, 51, 'plus', 'bg-green', 'trans(\"history.backend.permissions.created\") <strong>view-plant-equipment</strong>', NULL, '2019-02-09 22:21:08', '2019-02-09 22:21:08'),
(8, 3, 1, 52, 'plus', 'bg-green', 'trans(\"history.backend.permissions.created\") <strong>delete-plant-equipment</strong>', NULL, '2019-02-09 22:22:25', '2019-02-09 22:22:25'),
(9, 3, 1, 53, 'plus', 'bg-green', 'trans(\"history.backend.permissions.created\") <strong>view-reports</strong>', NULL, '2019-02-09 22:48:43', '2019-02-09 22:48:43'),
(10, 3, 1, 54, 'plus', 'bg-green', 'trans(\"history.backend.permissions.created\") <strong>create-projects</strong>', NULL, '2019-02-10 02:33:20', '2019-02-10 02:33:20'),
(11, 3, 1, 55, 'plus', 'bg-green', 'trans(\"history.backend.permissions.created\") <strong>edit-projects</strong>', NULL, '2019-02-10 02:46:59', '2019-02-10 02:46:59'),
(12, 3, 1, 56, 'plus', 'bg-green', 'trans(\"history.backend.permissions.created\") <strong>view-projects</strong>', NULL, '2019-02-10 03:12:35', '2019-02-10 03:12:35'),
(13, 3, 1, 57, 'plus', 'bg-green', 'trans(\"history.backend.permissions.created\") <strong>delete-projects</strong>', NULL, '2019-02-10 03:13:20', '2019-02-10 03:13:20'),
(14, 1, 1, 4, 'save', 'bg-aqua', 'trans(\"history.backend.users.updated\") <strong>{user}</strong>', '{\"user_link\":[\"admin.access.user.show\",\"Rashed Al Banna\",4]}', '2019-02-12 00:42:08', '2019-02-12 00:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `history_types`
--

CREATE TABLE `history_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_types`
--

INSERT INTO `history_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'User', '2019-01-15 01:17:13', '2019-01-15 01:17:13'),
(2, 'Role', '2019-01-15 01:17:13', '2019-01-15 01:17:13'),
(3, 'Permission', '2019-01-15 01:17:13', '2019-01-15 01:17:13'),
(4, 'Page', '2019-01-15 01:17:13', '2019-01-15 01:17:13'),
(5, 'BlogTag', '2019-01-15 01:17:13', '2019-01-15 01:17:13'),
(6, 'BlogCategory', '2019-01-15 01:17:13', '2019-01-15 01:17:13'),
(7, 'Blog', '2019-01-15 01:17:13', '2019-01-15 01:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('backend','frontend') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `type`, `name`, `items`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'backend', 'Backend Sidebar Menu', '[{\"view_permission_id\":\"view-access-management\",\"icon\":\"fa-users\",\"open_in_new_tab\":0,\"url_type\":\"route\",\"url\":\"\",\"name\":\"Access Management\",\"id\":11,\"content\":\"Access Management\",\"children\":[{\"view_permission_id\":\"view-user-management\",\"open_in_new_tab\":0,\"url_type\":\"route\",\"url\":\"admin.access.user.index\",\"name\":\"User Management\",\"id\":12,\"content\":\"User Management\"},{\"view_permission_id\":\"view-role-management\",\"open_in_new_tab\":0,\"url_type\":\"route\",\"url\":\"admin.access.role.index\",\"name\":\"Role Management\",\"id\":13,\"content\":\"Role Management\"},{\"view_permission_id\":\"view-permission-management\",\"open_in_new_tab\":0,\"url_type\":\"route\",\"url\":\"admin.access.permission.index\",\"name\":\"Permission Management\",\"id\":14,\"content\":\"Permission Management\"}]},{\"view_permission_id\":\"view-module\",\"icon\":\"fa-wrench\",\"open_in_new_tab\":0,\"url_type\":\"route\",\"url\":\"admin.modules.index\",\"name\":\"Module\",\"id\":1,\"content\":\"Module\"},{\"view_permission_id\":\"view-menu\",\"icon\":\"fa-bars\",\"open_in_new_tab\":0,\"url_type\":\"route\",\"url\":\"admin.menus.index\",\"name\":\"Menus\",\"id\":3,\"content\":\"Menus\"},{\"view_permission_id\":\"edit-settings\",\"icon\":\"fa-gear\",\"open_in_new_tab\":0,\"url_type\":\"route\",\"url\":\"admin.settings.edit?id=1\",\"name\":\"Settings\",\"id\":9,\"content\":\"Settings\"},{\"view_permission_id\":\"view-projects\",\"icon\":\"fa fa-tasks\",\"open_in_new_tab\":0,\"url_type\":\"route\",\"url\":\"admin.projects.index\",\"name\":\"Projects\",\"id\":17,\"content\":\"Projects\"},{\"id\":15,\"name\":\"Plant Equipment\",\"url\":\"admin.plantEquipment.index\",\"url_type\":\"route\",\"open_in_new_tab\":0,\"icon\":\"fa fa-trello\",\"view_permission_id\":\"view-plant-equipment\",\"content\":\"Plant Equipment\"},{\"id\":16,\"name\":\"Reports\",\"url\":\"admin.reports.index\",\"url_type\":\"route\",\"open_in_new_tab\":0,\"icon\":\"fa fa-bar-chart\",\"view_permission_id\":\"view-reports\",\"content\":\"Reports\"}]', 1, NULL, '2019-01-15 01:17:14', '2019-02-10 05:03:11', NULL);

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
(1, '2017_11_02_060149_create_blog_categories_table', 1),
(2, '2017_11_02_060149_create_blog_map_categories_table', 1),
(3, '2017_11_02_060149_create_blog_map_tags_table', 1),
(4, '2017_11_02_060149_create_blog_tags_table', 1),
(5, '2017_11_02_060149_create_blogs_table', 1),
(6, '2017_11_02_060149_create_faqs_table', 1),
(7, '2017_11_02_060149_create_history_table', 1),
(8, '2017_11_02_060149_create_history_types_table', 1),
(9, '2017_11_02_060149_create_modules_table', 1),
(10, '2017_11_02_060149_create_notifications_table', 1),
(11, '2017_11_02_060149_create_pages_table', 1),
(12, '2017_11_02_060149_create_password_resets_table', 1),
(13, '2017_11_02_060149_create_permission_role_table', 1),
(14, '2017_11_02_060149_create_permission_user_table', 1),
(15, '2017_11_02_060149_create_permissions_table', 1),
(16, '2017_11_02_060149_create_role_user_table', 1),
(17, '2017_11_02_060149_create_roles_table', 1),
(18, '2017_11_02_060149_create_sessions_table', 1),
(19, '2017_11_02_060149_create_settings_table', 1),
(20, '2017_11_02_060149_create_social_logins_table', 1),
(21, '2017_11_02_060149_create_users_table', 1),
(22, '2017_11_02_060152_add_foreign_keys_to_history_table', 1),
(23, '2017_11_02_060152_add_foreign_keys_to_notifications_table', 1),
(24, '2017_11_02_060152_add_foreign_keys_to_permission_role_table', 1),
(25, '2017_11_02_060152_add_foreign_keys_to_permission_user_table', 1),
(26, '2017_11_02_060152_add_foreign_keys_to_role_user_table', 1),
(27, '2017_11_02_060152_add_foreign_keys_to_social_logins_table', 1),
(28, '2017_12_10_122555_create_menus_table', 1),
(29, '2017_12_24_042039_add_null_constraint_on_created_by_on_user_table', 2),
(30, '2017_12_28_005822_add_null_constraint_on_created_by_on_role_table', 2),
(31, '2017_12_28_010952_add_null_constraint_on_created_by_on_permission_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `view_permission_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'view_route',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `view_permission_id`, `name`, `url`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'view-access-management', 'Access Management', NULL, 1, NULL, '2019-01-15 01:17:14', NULL),
(2, 'view-user-management', 'User Management', 'admin.access.user.index', 1, NULL, '2019-01-15 01:17:14', NULL),
(3, 'view-role-management', 'Role Management', 'admin.access.role.index', 1, NULL, '2019-01-15 01:17:14', NULL),
(4, 'view-permission-management', 'Permission Management', 'admin.access.permission.index', 1, NULL, '2019-01-15 01:17:14', NULL),
(5, 'view-menu', 'Menus', 'admin.menus.index', 1, NULL, '2019-01-15 01:17:14', NULL),
(6, 'view-module', 'Module', 'admin.modules.index', 1, NULL, '2019-01-15 01:17:14', NULL),
(7, 'view-page', 'Pages', 'admin.pages.index', 1, NULL, '2019-01-15 01:17:14', NULL),
(8, 'edit-settings', 'Settings', 'admin.settings.edit', 1, NULL, '2019-01-15 01:17:14', NULL),
(9, 'view-blog', 'Blog Management', NULL, 1, NULL, '2019-01-15 01:17:14', NULL),
(10, 'view-blog-category', 'Blog Category Management', 'admin.blogcategories.index', 1, NULL, '2019-01-15 01:17:14', NULL),
(11, 'view-blog-tag', 'Blog Tag Management', 'admin.blogtags.index', 1, NULL, '2019-01-15 01:17:14', NULL),
(12, 'view-blog', 'Blog Management', 'admin.blogs.index', 1, NULL, '2019-01-15 01:17:14', NULL),
(13, 'view-faq', 'Faq Management', 'admin.faqs.index', 1, NULL, '2019-01-15 01:17:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - Dashboard , 2 - Email , 3 - Both',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `user_id`, `type`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'User Logged In: Viral', 1, 1, 1, '2019-01-15 22:50:38', '2019-01-22 05:49:53'),
(2, 'User Logged In: Viral', 1, 1, 1, '2019-01-15 22:53:34', '2019-01-22 05:49:51'),
(3, 'User Logged In: Viral', 1, 1, 1, '2019-01-15 23:05:32', '2019-01-22 05:49:51'),
(4, 'User Logged In: Viral', 1, 1, 1, '2019-01-16 00:28:46', '2019-01-22 05:49:51'),
(5, 'User Logged In: Viral', 1, 1, 1, '2019-01-16 00:28:54', '2019-01-22 05:49:51'),
(6, 'User Logged In: Viral', 1, 1, 1, '2019-01-16 01:03:57', '2019-01-22 05:49:51'),
(7, 'User Logged In: Viral', 1, 1, 1, '2019-01-16 01:24:51', '2019-01-22 05:49:47'),
(8, 'User Logged In: Viral', 1, 1, 1, '2019-01-16 01:30:11', '2019-01-22 05:49:47'),
(9, 'User Logged In: Viral', 1, 1, 1, '2019-01-16 03:01:53', '2019-01-22 05:49:47'),
(10, 'User Logged In: Viral', 1, 1, 1, '2019-01-16 03:28:19', '2019-01-22 05:49:47'),
(11, 'User Logged In: Viral', 1, 1, 1, '2019-01-16 03:57:31', '2019-01-22 05:49:47'),
(12, 'User Logged In: Viral', 1, 1, 1, '2019-01-16 05:34:56', '2019-01-22 05:49:41'),
(13, 'User Logged In: Viral', 1, 1, 1, '2019-01-17 20:26:27', '2019-01-22 05:49:41'),
(14, 'User Logged In: Viral', 1, 1, 1, '2019-01-17 20:49:14', '2019-01-22 05:49:41'),
(15, 'User Logged In: Viral', 1, 1, 1, '2019-01-19 23:35:26', '2019-01-22 05:49:41'),
(16, 'User Logged In: Viral', 1, 1, 1, '2019-01-21 21:34:52', '2019-01-22 05:49:41'),
(17, 'User Logged In: Admin', 1, 1, 1, '2019-01-21 21:54:14', '2019-01-22 05:49:29'),
(18, 'User Logged In: Admin', 1, 1, 1, '2019-01-21 23:42:13', '2019-01-22 05:49:29'),
(19, 'User Logged In: Admin', 1, 1, 1, '2019-01-21 23:54:34', '2019-01-22 05:49:29'),
(20, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 01:08:42', '2019-01-22 05:49:29'),
(21, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 01:21:36', '2019-01-22 05:49:29'),
(22, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 04:11:22', '2019-01-22 05:49:56'),
(23, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 05:01:33', '2019-01-22 05:49:56'),
(24, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 05:12:42', '2019-01-22 05:49:56'),
(25, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 05:31:13', '2019-01-22 05:49:56'),
(26, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 05:44:46', '2019-01-22 05:49:56'),
(27, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 20:55:00', '2019-02-01 21:50:54'),
(28, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 21:42:42', '2019-02-01 21:50:54'),
(29, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 22:02:34', '2019-02-01 21:50:54'),
(30, 'User Logged In: Admin', 1, 1, 1, '2019-01-22 22:48:50', '2019-02-01 21:50:54'),
(31, 'User Logged In: Admin', 1, 1, 1, '2019-01-23 01:05:46', '2019-02-01 21:50:52'),
(32, 'User Logged In: Admin', 1, 1, 1, '2019-01-23 02:29:09', '2019-02-01 21:50:52'),
(33, 'User Logged In: Admin', 1, 1, 1, '2019-01-23 02:56:33', '2019-02-01 21:50:52'),
(34, 'User Logged In: Admin', 1, 1, 1, '2019-01-23 04:15:00', '2019-02-01 21:50:52'),
(35, 'User Logged In: Admin', 1, 1, 1, '2019-01-23 04:40:39', '2019-02-01 21:50:52'),
(36, 'User Logged In: Admin', 1, 1, 1, '2019-01-23 21:15:31', '2019-02-01 21:50:50'),
(37, 'User Logged In: Admin', 1, 1, 1, '2019-01-23 21:56:35', '2019-02-01 21:50:50'),
(38, 'User Logged In: Admin', 1, 1, 1, '2019-01-23 22:21:32', '2019-02-01 21:50:50'),
(39, 'User Logged In: Admin', 1, 1, 1, '2019-01-23 22:51:10', '2019-02-01 21:50:50'),
(40, 'User Logged In: Admin', 1, 1, 1, '2019-02-01 21:50:13', '2019-02-01 21:50:54'),
(41, 'User Logged In: Admin', 1, 1, 0, '2019-02-03 21:06:56', NULL),
(42, 'User Logged In: Admin', 1, 1, 0, '2019-02-03 21:27:37', NULL),
(43, 'User Logged In: Admin', 1, 1, 0, '2019-02-03 21:41:48', NULL),
(44, 'User Logged In: Admin', 1, 1, 0, '2019-02-03 22:51:42', NULL),
(45, 'User Logged In: Admin', 1, 1, 1, '2019-02-03 23:26:55', '2019-02-09 21:33:04'),
(46, 'User Logged In: Admin', 1, 1, 1, '2019-02-03 23:31:30', '2019-02-09 21:33:04'),
(47, 'User Logged In: Admin', 1, 1, 1, '2019-02-03 23:56:12', '2019-02-09 21:33:04'),
(48, 'User Logged In: Admin', 1, 1, 1, '2019-02-04 00:32:44', '2019-02-09 21:33:04'),
(49, 'User Logged In: Admin', 1, 1, 1, '2019-02-04 00:43:13', '2019-02-09 21:33:04'),
(50, 'User Logged In: Admin', 1, 1, 1, '2019-02-04 01:03:36', '2019-02-09 21:33:01'),
(51, 'User Logged In: Admin', 1, 1, 1, '2019-02-04 03:13:37', '2019-02-09 21:33:01'),
(52, 'User Logged In: Rashed', 1, 1, 1, '2019-02-04 03:19:32', '2019-02-09 21:33:01'),
(53, 'User Logged In: Admin', 1, 1, 1, '2019-02-04 03:20:42', '2019-02-05 03:14:34'),
(54, 'User Logged In: Rashed', 1, 1, 1, '2019-02-04 03:21:20', '2019-02-05 03:14:34'),
(55, 'User Logged In: Admin', 1, 1, 1, '2019-02-04 03:37:59', '2019-02-05 03:14:34'),
(56, 'User Logged In: Admin', 1, 1, 1, '2019-02-05 02:28:16', '2019-02-05 03:14:34'),
(57, 'User Logged In: Admin', 1, 1, 1, '2019-02-05 03:14:19', '2019-02-05 03:14:34'),
(58, 'User Logged In: Admin', 1, 1, 1, '2019-02-05 03:27:24', '2019-02-09 21:33:01'),
(59, 'User Logged In: Admin', 1, 1, 1, '2019-02-09 21:09:56', '2019-02-09 21:33:01'),
(60, 'User Logged In: Admin', 1, 1, 0, '2019-02-09 22:15:22', NULL),
(61, 'User Logged In: Rashed', 1, 1, 0, '2019-02-09 22:26:39', NULL),
(62, 'User Logged In: Admin', 1, 1, 0, '2019-02-09 22:29:08', NULL),
(63, 'User Logged In: Admin', 1, 1, 0, '2019-02-09 23:14:20', NULL),
(64, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 00:15:05', NULL),
(65, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 00:34:48', NULL),
(66, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 00:49:15', '2019-02-10 05:05:06'),
(67, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 01:10:08', '2019-02-10 05:05:06'),
(68, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 01:32:07', '2019-02-10 05:05:06'),
(69, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 02:31:57', '2019-02-10 05:05:06'),
(70, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 02:44:02', '2019-02-10 05:05:06'),
(71, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 03:05:42', '2019-02-10 05:04:52'),
(72, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 03:29:10', '2019-02-10 05:04:52'),
(73, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 03:43:15', '2019-02-10 05:04:52'),
(74, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 04:22:52', '2019-02-10 05:04:52'),
(75, 'User Logged In: Admin', 1, 1, 1, '2019-02-10 04:52:17', '2019-02-10 05:04:52'),
(76, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 05:37:31', NULL),
(77, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 05:50:24', NULL),
(78, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 08:54:02', NULL),
(79, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 09:25:38', NULL),
(80, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 09:57:31', NULL),
(81, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 10:27:53', NULL),
(82, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 14:58:58', NULL),
(83, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 14:59:05', NULL),
(84, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 15:28:03', NULL),
(85, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 16:17:01', NULL),
(86, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 16:55:44', NULL),
(87, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 17:33:59', NULL),
(88, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 17:54:21', NULL),
(89, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 18:11:04', NULL),
(90, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 18:19:54', NULL),
(91, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 18:23:07', NULL),
(92, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 18:23:29', NULL),
(93, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 21:37:49', NULL),
(94, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 21:38:01', NULL),
(95, 'User Logged In: Admin', 1, 1, 0, '2019-02-10 22:06:30', NULL),
(96, 'User Logged In: Admin', 1, 1, 0, '2019-02-12 00:35:53', NULL),
(97, 'User Logged In: Admin', 1, 1, 0, '2019-02-12 00:36:29', NULL),
(98, 'User Logged In: Rashed', 1, 1, 0, '2019-02-12 00:40:08', NULL),
(99, 'User Logged In: Admin', 1, 1, 0, '2019-02-12 00:40:35', NULL),
(100, 'User Logged In: Rashed', 1, 1, 0, '2019-02-12 00:42:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cannonical_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `page_slug`, `description`, `cannonical_link`, `seo_title`, `seo_keyword`, `seo_description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Terms and conditions', 'terms-and-conditions', 'terms and conditions', NULL, NULL, NULL, NULL, 1, 1, NULL, '2019-01-15 01:17:14', '2019-01-15 01:17:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `sort`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'view-backend', 'View Backend', 1, 1, 1, NULL, '2019-01-15 01:17:03', '2019-01-15 01:17:03', NULL),
(2, 'view-frontend', 'View Frontend', 2, 1, 1, NULL, '2019-01-15 01:17:03', '2019-01-15 01:17:03', NULL),
(3, 'view-access-management', 'View Access Management', 3, 1, 1, NULL, '2019-01-15 01:17:03', '2019-01-15 01:17:03', NULL),
(4, 'view-user-management', 'View User Management', 4, 1, 1, NULL, '2019-01-15 01:17:03', '2019-01-15 01:17:03', NULL),
(5, 'view-active-user', 'View Active User', 5, 1, 1, NULL, '2019-01-15 01:17:04', '2019-01-15 01:17:04', NULL),
(6, 'view-deactive-user', 'View Deactive User', 6, 1, 1, NULL, '2019-01-15 01:17:04', '2019-01-15 01:17:04', NULL),
(7, 'view-deleted-user', 'View Deleted User', 7, 1, 1, NULL, '2019-01-15 01:17:04', '2019-01-15 01:17:04', NULL),
(8, 'show-user', 'Show User Details', 8, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(9, 'create-user', 'Create User', 9, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(10, 'edit-user', 'Edit User', 9, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(11, 'delete-user', 'Delete User', 10, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(12, 'activate-user', 'Activate User', 11, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(13, 'deactivate-user', 'Deactivate User', 12, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(14, 'login-as-user', 'Login As User', 13, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(15, 'clear-user-session', 'Clear User Session', 14, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(16, 'view-role-management', 'View Role Management', 15, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(17, 'create-role', 'Create Role', 16, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(18, 'edit-role', 'Edit Role', 17, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(19, 'delete-role', 'Delete Role', 18, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(20, 'view-permission-management', 'View Permission Management', 19, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(21, 'create-permission', 'Create Permission', 20, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(22, 'edit-permission', 'Edit Permission', 21, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(23, 'delete-permission', 'Delete Permission', 22, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(24, 'view-page', 'View Page', 23, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(25, 'create-page', 'Create Page', 24, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(26, 'edit-page', 'Edit Page', 25, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(27, 'delete-page', 'Delete Page', 26, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(28, 'view-email-template', 'View Email Templates', 27, 1, 1, NULL, '2019-01-15 01:17:05', '2019-01-15 01:17:05', NULL),
(29, 'create-email-template', 'Create Email Templates', 28, 1, 1, NULL, '2019-01-15 01:17:06', '2019-01-15 01:17:06', NULL),
(30, 'edit-email-template', 'Edit Email Templates', 29, 1, 1, NULL, '2019-01-15 01:17:06', '2019-01-15 01:17:06', NULL),
(31, 'delete-email-template', 'Delete Email Templates', 30, 1, 1, NULL, '2019-01-15 01:17:06', '2019-01-15 01:17:06', NULL),
(32, 'edit-settings', 'Edit Settings', 31, 1, 1, NULL, '2019-01-15 01:17:06', '2019-01-15 01:17:06', NULL),
(33, 'view-blog-category', 'View Blog Categories Management', 32, 1, 1, NULL, '2019-01-15 01:17:06', '2019-01-15 01:17:06', NULL),
(34, 'create-blog-category', 'Create Blog Category', 33, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(35, 'edit-blog-category', 'Edit Blog Category', 34, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(36, 'delete-blog-category', 'Delete Blog Category', 35, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(37, 'view-blog-tag', 'View Blog Tags Management', 36, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(38, 'create-blog-tag', 'Create Blog Tag', 37, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(39, 'edit-blog-tag', 'Edit Blog Tag', 38, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(40, 'delete-blog-tag', 'Delete Blog Tag', 39, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(41, 'view-blog', 'View Blogs Management', 40, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(42, 'create-blog', 'Create Blog', 41, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(43, 'edit-blog', 'Edit Blog', 42, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(44, 'delete-blog', 'Delete Blog', 43, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(45, 'view-faq', 'View FAQ Management', 44, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(46, 'create-faq', 'Create FAQ', 45, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(47, 'edit-faq', 'Edit FAQ', 46, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(48, 'delete-faq', 'Delete FAQ', 47, 1, 1, NULL, '2019-01-15 01:17:07', '2019-01-15 01:17:07', NULL),
(49, 'create-plant-equipment', 'Create Plant Equipment', 31, 1, 1, 1, '2019-01-22 05:42:35', '2019-01-22 05:43:48', NULL),
(50, 'edit-plant-equipment', 'Edit Plant Equipment', 32, 1, 1, NULL, '2019-02-09 22:20:08', '2019-02-09 22:20:08', NULL),
(51, 'view-plant-equipment', 'View Plant Equipment', 33, 1, 1, NULL, '2019-02-09 22:21:08', '2019-02-09 22:21:08', NULL),
(52, 'delete-plant-equipment', 'Delete Plant Equipment', 34, 1, 1, NULL, '2019-02-09 22:22:25', '2019-02-09 22:22:25', NULL),
(53, 'view-reports', 'View Reports', 40, 1, 1, NULL, '2019-02-09 22:48:43', '2019-02-09 22:48:43', NULL),
(54, 'create-projects', 'Create Projects', 41, 1, 1, NULL, '2019-02-10 02:33:20', '2019-02-10 02:33:20', NULL),
(55, 'edit-projects', 'Edit Projects', 33, 1, 1, NULL, '2019-02-10 02:46:59', '2019-02-10 02:46:59', NULL),
(56, 'view-projects', 'View Projects', 34, 1, 1, NULL, '2019-02-10 03:12:35', '2019-02-10 03:12:35', NULL),
(57, 'delete-projects', 'Delete Projects', 38, 1, 1, NULL, '2019-02-10 03:13:20', '2019-02-10 03:13:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(34, 2, 3),
(35, 1, 2),
(36, 3, 2),
(37, 4, 2),
(38, 5, 2),
(39, 6, 2),
(40, 7, 2),
(41, 8, 2),
(42, 16, 2),
(43, 20, 2),
(44, 24, 2),
(45, 25, 2),
(46, 26, 2),
(47, 27, 2),
(48, 28, 2),
(49, 29, 2),
(50, 30, 2),
(51, 31, 2),
(52, 33, 2),
(53, 34, 2),
(54, 35, 2),
(55, 36, 2),
(56, 37, 2),
(57, 38, 2),
(58, 39, 2),
(59, 40, 2),
(60, 41, 2),
(61, 42, 2),
(62, 43, 2),
(63, 44, 2),
(64, 45, 2),
(65, 46, 2),
(66, 47, 2),
(67, 48, 2),
(68, 49, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`id`, `permission_id`, `user_id`) VALUES
(1, 42, 2),
(2, 34, 2),
(3, 38, 2),
(4, 29, 2),
(5, 46, 2),
(6, 25, 2),
(7, 44, 2),
(8, 36, 2),
(9, 40, 2),
(10, 31, 2),
(11, 48, 2),
(12, 27, 2),
(13, 43, 2),
(14, 35, 2),
(15, 39, 2),
(16, 30, 2),
(17, 47, 2),
(18, 26, 2),
(19, 8, 2),
(20, 3, 2),
(21, 5, 2),
(22, 1, 2),
(23, 33, 2),
(24, 37, 2),
(25, 41, 2),
(26, 6, 2),
(27, 7, 2),
(28, 28, 2),
(29, 45, 2),
(30, 24, 2),
(31, 20, 2),
(32, 16, 2),
(33, 4, 2),
(34, 2, 3),
(38, 1, 4),
(39, 49, 4),
(40, 50, 4),
(41, 51, 4),
(42, 52, 4);

-- --------------------------------------------------------

--
-- Table structure for table `plant_and_equipment`
--

CREATE TABLE `plant_and_equipment` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `equipment_type` int(11) DEFAULT NULL,
  `date_form` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `name` varchar(700) DEFAULT NULL,
  `eel_code` varchar(300) DEFAULT NULL,
  `country_of_origin` varchar(400) DEFAULT NULL,
  `capacity` varchar(300) DEFAULT NULL,
  `make_by` varchar(300) DEFAULT NULL,
  `model` varchar(300) DEFAULT NULL,
  `year_of_manufac` int(11) DEFAULT NULL,
  `present_location` varchar(300) DEFAULT NULL,
  `remarks` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plant_and_equipment`
--

INSERT INTO `plant_and_equipment` (`id`, `project_id`, `equipment_type`, `date_form`, `date_to`, `name`, `eel_code`, `country_of_origin`, `capacity`, `make_by`, `model`, `year_of_manufac`, `present_location`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, '2019-02-01 00:00:00', '2019-02-09 00:00:00', 'CRAWLER CRANE', 'CC-001', 'CHINA', 'Bad', '380 TON, 84 M BOOM', 'ZCC3800', 2018, 'ON BOAT', 'Good', 1, NULL, '2019-01-23 03:01:36', '2019-02-10 15:39:11', NULL),
(3, 3, 2, '2019-02-01 00:00:00', '2019-02-28 00:00:00', 'CRAWLER CRANE', 'CC-001', 'CHINA', 'Better', '380 TON, 84 M BOOM', 'ZCC3800', 2018, 'ON BOAT', 'Good', 1, NULL, '2019-01-23 04:16:31', '2019-02-10 15:38:43', NULL),
(5, 1, 1, '2019-02-01 00:00:00', '2019-02-15 00:00:00', 'CRAWLER CRANE', 'CC-001', 'CHINA', 'Good', '380 TON, 84 M BOOM', 'ZCC3800', 2018, 'ON BOAT', 'Good', 1, NULL, '2019-01-23 04:26:54', '2019-02-10 15:38:53', NULL),
(6, 3, 1, NULL, NULL, 'Test - 1', 'TT06', 'Hongkong', '380 TON, 84 M BOOM', 'Teo', 'BBOO', 2018, 'Bangladesh', 'Excellent', 1, NULL, '2019-02-10 16:01:02', '2019-02-10 16:06:33', NULL),
(7, 1, 2, '2019-02-01 00:00:00', '2019-02-28 00:00:00', 'Test Eq', 'TW', 'CHINA', '380 TON, 84 M BOOM', 'test', '78M', 2018, 'Motijhil', 'Good', 1, NULL, '2019-02-12 00:38:57', '2019-02-12 00:38:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(500) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Project A', 1, NULL, '2019-02-10 09:09:28', '2019-02-10 10:05:57', NULL),
(3, 'Project B', 1, NULL, '2019-02-10 10:05:36', '2019-02-10 10:05:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_type`
--

CREATE TABLE `project_type` (
  `id` int(11) NOT NULL,
  `name` varchar(600) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_type`
--

INSERT INTO `project_type` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Owned', 0, 0, '2019-02-10 16:18:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Rented', 0, 0, '2019-02-10 16:18:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `all`, `sort`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', 1, 1, 1, 1, NULL, '2019-01-15 01:17:02', '2019-01-15 01:17:02', NULL),
(2, 'Executive', 0, 2, 0, 1, 1, '2019-01-15 01:17:02', '2019-01-22 05:46:25', NULL),
(3, 'User', 0, 3, 1, 1, NULL, '2019-01-15 01:17:02', '2019-01-15 01:17:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(6, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` text COLLATE utf8mb4_unicode_ci,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `company_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci,
  `from_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci,
  `disclaimer` text COLLATE utf8mb4_unicode_ci,
  `google_analytics` text COLLATE utf8mb4_unicode_ci,
  `home_video1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_video2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_video3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_video4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `values` text COLLATE utf8mb4_unicode_ci,
  `data_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `logo`, `favicon`, `seo_title`, `seo_keyword`, `seo_description`, `company_contact`, `company_address`, `from_name`, `from_email`, `facebook`, `linkedin`, `twitter`, `google`, `copyright_text`, `footer_text`, `terms`, `disclaimer`, `google_analytics`, `home_video1`, `home_video2`, `home_video3`, `home_video4`, `explanation1`, `explanation2`, `explanation3`, `explanation4`, `values`, `data_type`, `post_type`, `created_at`, `updated_at`) VALUES
(1, NULL, '1547629427Saif--Power-tec-Logo-226x48.jpg', '1547632780Saif--Power-tec-Logo-favicon.jpg', 'Saif Inventory Management System', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-16 03:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `social_logins`
--

CREATE TABLE `social_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `is_term_accept` tinyint(1) NOT NULL DEFAULT '0' COMMENT ' 0 = not accepted,1 = accepted',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `confirmation_code`, `confirmed`, `is_term_accept`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'Saif', 'admin@admin.com', '$2y$10$yzdRh.HNr8RukRLgiuVfoe37Ckjmr1wFdlQi0XHoTrCSLeBjLLYMS', 1, 'b1970adb3f301c8440c81e45b526060c', 1, 0, 'ZY2JWi3MlTmcBoCQqmBpxbOYhez4AQMUA4NZCyaJyo49rAmyotCvUmFJrEsS', 1, 1, '2019-01-15 01:17:02', '2019-01-21 21:36:38', NULL),
(2, 'Vipul', 'Basapati', 'executive@executive.com', '$2y$10$Xtds/X9sMuHoguyev.I6JO0g2b1c2eT4UiEuB3L6FUmmQlEI7h4gu', 1, '68c7a7b3a2968803ae6db884ae89f446', 1, 0, NULL, 1, NULL, '2019-01-15 01:17:02', '2019-01-15 01:17:02', NULL),
(3, 'User', 'Test', 'user@user.com', '$2y$10$hK926V1W.U2666U50rhQ7uj0TAMbB0cwa.kivaTzkVpSNVPQ7Re12', 1, 'fe3ae4e0b22211d756922a0bede508cf', 1, 0, NULL, 1, NULL, '2019-01-15 01:17:02', '2019-01-15 01:17:02', NULL),
(4, 'Rashed', 'Al Banna', 'r@gmail.com', '$2y$10$TKxuqIrAdSNAR5cvG0MtAeJrV34bRogqLC9bTmyyhsxZldb6THXtK', 1, 'b9a747f4ee9cab6be9906c6af5b4e04a', 1, 0, 'z4qOqC85oZTHcGY9gblduYAj69WeiDyXzWTsA20mlHoBN9a56ve640nWsEI0', 1, NULL, '2019-02-04 03:18:51', '2019-02-04 03:18:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_map_categories`
--
ALTER TABLE `blog_map_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_map_categories_blog_id_index` (`blog_id`),
  ADD KEY `blog_map_categories_category_id_index` (`category_id`);

--
-- Indexes for table `blog_map_tags`
--
ALTER TABLE `blog_map_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_map_tags_blog_id_index` (`blog_id`),
  ADD KEY `blog_map_tags_tag_id_index` (`tag_id`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_type_id_foreign` (`type_id`),
  ADD KEY `history_user_id_foreign` (`user_id`);

--
-- Indexes for table `history_types`
--
ALTER TABLE `history_types`
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
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_page_slug_unique` (`page_slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `plant_and_equipment`
--
ALTER TABLE `plant_and_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_type`
--
ALTER TABLE `project_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_logins_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_map_categories`
--
ALTER TABLE `blog_map_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_map_tags`
--
ALTER TABLE `blog_map_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `history_types`
--
ALTER TABLE `history_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `plant_and_equipment`
--
ALTER TABLE `plant_and_equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `project_type`
--
ALTER TABLE `project_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `history_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;