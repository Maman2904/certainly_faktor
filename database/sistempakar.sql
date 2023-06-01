/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : sistempakar

 Target Server Type    : MySQL
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 01/06/2023 12:07:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity_log
-- ----------------------------
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subject_id` bigint UNSIGNED NULL DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `causer_id` bigint UNSIGNED NULL DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subject`(`subject_type` ASC, `subject_id` ASC) USING BTREE,
  INDEX `causer`(`causer_type` ASC, `causer_id` ASC) USING BTREE,
  INDEX `activity_log_log_name_index`(`log_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activity_log
-- ----------------------------
INSERT INTO `activity_log` VALUES (1, 'user', 'You have created user', 'App\\Models\\User', 1, NULL, NULL, '{\"attributes\":{\"name\":\"Admin\",\"username\":\"admin\"}}', '2023-05-30 23:45:05', '2023-05-30 23:45:05');
INSERT INTO `activity_log` VALUES (2, 'user', 'You have created user', 'App\\Models\\User', 2, NULL, NULL, '{\"attributes\":{\"name\":\"Johni\",\"username\":\"johni\"}}', '2023-05-30 23:45:05', '2023-05-30 23:45:05');
INSERT INTO `activity_log` VALUES (3, 'ciriciri', 'You have created ciriciri', 'App\\Models\\Ciriciri', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"nama\":\"bintik\",\"kode\":\"c1\"}}', '2023-05-31 00:02:22', '2023-05-31 00:02:22');
INSERT INTO `activity_log` VALUES (4, 'defect', 'You have created defect', 'App\\Models\\Defect', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"nama\":\"BURN MARK\",\"kode\":\"k1\"}}', '2023-05-31 00:18:31', '2023-05-31 00:18:31');
INSERT INTO `activity_log` VALUES (5, 'user', 'You have created user', 'App\\Models\\User', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"maman\",\"username\":\"maman\"}}', '2023-05-31 00:37:48', '2023-05-31 00:37:48');

-- ----------------------------
-- Table structure for ciriciri_defect
-- ----------------------------
DROP TABLE IF EXISTS `ciriciri_defect`;
CREATE TABLE `ciriciri_defect`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ciriciri_id` int UNSIGNED NOT NULL,
  `defect_id` int UNSIGNED NOT NULL,
  `value_cf` double(8, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ciriciri_defect
-- ----------------------------

-- ----------------------------
-- Table structure for ciriciris
-- ----------------------------
DROP TABLE IF EXISTS `ciriciris`;
CREATE TABLE `ciriciris`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ciriciris
-- ----------------------------
INSERT INTO `ciriciris` VALUES (1, 'bintik', 'c1');

-- ----------------------------
-- Table structure for defects
-- ----------------------------
DROP TABLE IF EXISTS `defects`;
CREATE TABLE `defects`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyebab` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `solusi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of defects
-- ----------------------------
INSERT INTO `defects` VALUES (1, 'k1', 'BURN MARK', 'kakak', 'lalalala');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for hasils
-- ----------------------------
DROP TABLE IF EXISTS `hasils`;
CREATE TABLE `hasils`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `defect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cf_max` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciriciri_terpilih` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_pdf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hasils
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2017_08_24_000000_create_settings_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2021_04_23_030446_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (6, '2021_04_28_072156_create_activity_log_table', 1);
INSERT INTO `migrations` VALUES (7, '2022_05_25_045640_create_defects_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_05_25_045640_create_penyakits_table', 1);
INSERT INTO `migrations` VALUES (9, '2022_05_25_045757_create_ciriciris_table', 1);
INSERT INTO `migrations` VALUES (10, '2022_05_25_045757_create_gejalas_table', 1);
INSERT INTO `migrations` VALUES (11, '2022_05_28_075608_create_hasils_table', 1);
INSERT INTO `migrations` VALUES (12, '2022_05_28_075608_create_riwayats_table', 1);
INSERT INTO `migrations` VALUES (13, '2022_06_27_191302_create_gejala_penyakit_table', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 3);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'dashboard', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (2, 'logs-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (3, 'logs-delete', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (4, 'role-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (5, 'role-create', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (6, 'role-edit', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (7, 'role-delete', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (8, 'member-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (9, 'member-create', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (10, 'member-edit', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (11, 'member-delete', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (12, 'setting-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (13, 'setting-edit', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (14, 'penyakit-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (15, 'penyakit-create', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (16, 'penyakit-edit', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (17, 'penyakit-delete', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (18, 'gejala-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (19, 'gejala-create', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (20, 'gejala-edit', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (21, 'gejala-delete', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (22, 'defect-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (23, 'defect-create', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (24, 'defect-edit', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (25, 'defect-delete', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (26, 'ciriciri-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (27, 'ciriciri-create', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (28, 'ciriciri-edit', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (29, 'ciriciri-delete', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (30, 'rulesdefect-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (31, 'rulesdefect-edit', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (32, 'penentuan', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (33, 'penentuan-create', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (34, 'hasil-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (35, 'hasil-show', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (37, 'rules-list', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `permissions` VALUES (38, 'rules-edit', 'web', '2023-05-30 23:45:04', '2023-05-30 23:45:04');

-- ----------------------------
-- Table structure for riwayats
-- ----------------------------
DROP TABLE IF EXISTS `riwayats`;
CREATE TABLE `riwayats`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil_diagnosa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cf_max` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gejala_terpilih` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_pdf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of riwayats
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 1);
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (5, 1);
INSERT INTO `role_has_permissions` VALUES (6, 1);
INSERT INTO `role_has_permissions` VALUES (7, 1);
INSERT INTO `role_has_permissions` VALUES (8, 1);
INSERT INTO `role_has_permissions` VALUES (9, 1);
INSERT INTO `role_has_permissions` VALUES (10, 1);
INSERT INTO `role_has_permissions` VALUES (11, 1);
INSERT INTO `role_has_permissions` VALUES (12, 1);
INSERT INTO `role_has_permissions` VALUES (13, 1);
INSERT INTO `role_has_permissions` VALUES (14, 1);
INSERT INTO `role_has_permissions` VALUES (15, 1);
INSERT INTO `role_has_permissions` VALUES (16, 1);
INSERT INTO `role_has_permissions` VALUES (17, 1);
INSERT INTO `role_has_permissions` VALUES (18, 1);
INSERT INTO `role_has_permissions` VALUES (19, 1);
INSERT INTO `role_has_permissions` VALUES (20, 1);
INSERT INTO `role_has_permissions` VALUES (21, 1);
INSERT INTO `role_has_permissions` VALUES (22, 1);
INSERT INTO `role_has_permissions` VALUES (23, 1);
INSERT INTO `role_has_permissions` VALUES (24, 1);
INSERT INTO `role_has_permissions` VALUES (25, 1);
INSERT INTO `role_has_permissions` VALUES (26, 1);
INSERT INTO `role_has_permissions` VALUES (27, 1);
INSERT INTO `role_has_permissions` VALUES (28, 1);
INSERT INTO `role_has_permissions` VALUES (29, 1);
INSERT INTO `role_has_permissions` VALUES (30, 1);
INSERT INTO `role_has_permissions` VALUES (31, 1);
INSERT INTO `role_has_permissions` VALUES (32, 1);
INSERT INTO `role_has_permissions` VALUES (32, 2);
INSERT INTO `role_has_permissions` VALUES (33, 1);
INSERT INTO `role_has_permissions` VALUES (33, 2);
INSERT INTO `role_has_permissions` VALUES (34, 1);
INSERT INTO `role_has_permissions` VALUES (34, 2);
INSERT INTO `role_has_permissions` VALUES (35, 1);
INSERT INTO `role_has_permissions` VALUES (35, 2);
INSERT INTO `role_has_permissions` VALUES (37, 1);
INSERT INTO `role_has_permissions` VALUES (38, 1);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin', 'web', '2023-05-30 23:45:05', '2023-05-30 23:45:05');
INSERT INTO `roles` VALUES (2, 'Pengguna', 'web', '2023-05-30 23:45:05', '2023-05-30 23:45:05');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `settings_key_index`(`key` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', 'admin', '$2y$10$VZwAxsTiQTyWcp6.j6Obd.L70AMc8RsrDU5txPk8WyjDQgAr56n2K', NULL, NULL, '2023-05-30 23:45:04', '2023-05-30 23:45:04');
INSERT INTO `users` VALUES (2, 'Johni', 'johni', '$2y$10$Aww28QNbR5QEX974IV44Qu0HOiLsNXyAdsczDRMT8GHFow/6bDONS', NULL, NULL, '2023-05-30 23:45:05', '2023-05-30 23:45:05');
INSERT INTO `users` VALUES (3, 'maman', 'maman', '$2y$10$8X63M2Sozf/BC.uK3eU6b.t29NlMtm7gyWszTsSobwkWu.r1wjy4i', NULL, NULL, '2023-05-31 00:37:48', '2023-05-31 00:37:48');

SET FOREIGN_KEY_CHECKS = 1;
