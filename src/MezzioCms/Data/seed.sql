-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `multimedias`;
CREATE TABLE `multimedias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `source` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `folder` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `type` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `news_content_categories`;
CREATE TABLE `news_content_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `news_contents`;
CREATE TABLE `news_contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `user_id` int DEFAULT NULL,
  `multimedia_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `up_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `published` tinyint DEFAULT NULL,
  `highlighted` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `multimedia_id` (`multimedia_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `news_contents_ibfk_1` FOREIGN KEY (`multimedia_id`) REFERENCES `multimedias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `news_contents_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `oauth_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `news_contents_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `news_content_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` varchar(40) DEFAULT NULL,
  `client_id` varchar(40) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text,
  `revoked` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx1_oauth_access_tokens` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` int DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `scopes` text,
  `revoked` tinyint(1) DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `name` varchar(40) NOT NULL,
  `user_id` int DEFAULT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `redirect` varchar(255) DEFAULT NULL,
  `personal_access_client` tinyint(1) DEFAULT NULL,
  `password_client` tinyint(1) DEFAULT NULL,
  `revoked` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `idx1_oauth_clients` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `oauth_clients` (`name`, `user_id`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
('mezzio-cms',	NULL,	'$2y$12$lMvPGYg4kNY5z3hYV4aSOu2dT4x94bjI1zkgrB9/MMGfgxsU6QCwC',	'/',	1,	1,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `client_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `idx1_oauth_personal_access_clients` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) DEFAULT NULL,
  `revoked` tinyint(1) DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx1_oauth_refresh_tokens` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `oauth_scopes`;
CREATE TABLE `oauth_scopes` (
  `id` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `oauth_users`;
CREATE TABLE `oauth_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `recipes_contents`;
CREATE TABLE `recipes_contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `user_id` int DEFAULT NULL,
  `multimedia_id` int DEFAULT NULL,
  `up_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `published` tinyint DEFAULT NULL,
  `highlighted` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `multimedia_id` (`multimedia_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `recipes_contents_ibfk_1` FOREIGN KEY (`multimedia_id`) REFERENCES `multimedias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recipes_contents_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `oauth_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `sections_contents`;
CREATE TABLE `sections_contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `user_id` int DEFAULT NULL,
  `multimedia_id` int DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `up_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `published` tinyint DEFAULT NULL,
  `highlighted` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `multimedia_id` (`multimedia_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `sections_contents_ibfk_1` FOREIGN KEY (`multimedia_id`) REFERENCES `multimedias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sections_contents_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `oauth_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `sections_contents_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `sections_contents` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2020-08-02 01:23:51