-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `multimedias`;
CREATE TABLE `multimedias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `source` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `folder` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `news_contents`;
CREATE TABLE `news_contents` (
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
  CONSTRAINT `news_contents_ibfk_1` FOREIGN KEY (`multimedia_id`) REFERENCES `multimedias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `news_contents` (`id`, `title`, `keywords`, `description`, `content`, `user_id`, `multimedia_id`, `up_date`, `published`, `highlighted`) VALUES
(1,	'Prueba noticia 1',	'Prueba noticia 2',	'Prueba noticia 3',	'Prueba noticia 4',	NULL,	NULL,	NULL,	NULL,	NULL);

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

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('144bc801db18d01db334843ec11f7781fcbe37d4a7f05b3ac9289bc8d786c998821c4c07504e4dc8',	'admin',	'psr7-cms',	NULL,	'',	0,	'2020-07-18 20:38:04',	'2020-07-18 20:38:04',	'2020-07-19 20:38:04'),
('2680f189b609dfcfe5642176041db652db5a75009b1ed75ebf350ec874621f0072724917c6f94436',	'admin',	'psr7-cms',	NULL,	'',	0,	'2020-07-18 20:34:55',	'2020-07-18 20:34:55',	'2020-07-19 20:34:55'),
('644945e151a797113160e02aacc5651110536920e5fd2733d5fd0b7cea682b8cd3928c5262ccf57b',	'admin',	'mezzio-cms',	NULL,	'',	0,	'2020-07-18 21:57:39',	'2020-07-18 21:57:39',	'2020-07-19 21:57:39'),
('9e4c6379aa304a66d5247023c5348ec52a6eb879dcb63b9ca811da33fae40268dbfb2496ce54b066',	'admin',	'psr7-cms',	NULL,	'',	0,	'2020-07-18 20:31:30',	'2020-07-18 20:31:30',	'2020-07-19 20:31:30');

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

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('00b098e4feb2bef3a05dabf84c6c65da4740f97ec95f600604a66bc9266cc08a7b6fd4c7ade43cba',	'144bc801db18d01db334843ec11f7781fcbe37d4a7f05b3ac9289bc8d786c998821c4c07504e4dc8',	0,	'2020-08-18 20:38:04'),
('2a4c0e7fe228d37df7942f575499b401b34de648ede1ae075b8753a11b430e794dcbcad2329116c8',	'644945e151a797113160e02aacc5651110536920e5fd2733d5fd0b7cea682b8cd3928c5262ccf57b',	0,	'2020-08-18 21:57:39'),
('98d44d5141fbd2e549fb59cf2600df1a4f333ce8c9e07e479ad5b856bea9440e2bf260601fc5d451',	'9e4c6379aa304a66d5247023c5348ec52a6eb879dcb63b9ca811da33fae40268dbfb2496ce54b066',	0,	'2020-08-18 20:31:30'),
('c4f6e4561466dae1269bcbea71aff70a9f60cc1fdc0660e4ab8258270e60fe3b47bc90b0c655d609',	'2680f189b609dfcfe5642176041db652db5a75009b1ed75ebf350ec874621f0072724917c6f94436',	0,	'2020-08-18 20:34:55');

DROP TABLE IF EXISTS `oauth_scopes`;
CREATE TABLE `oauth_scopes` (
  `id` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `oauth_scopes` (`id`) VALUES
('cms');

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

INSERT INTO `oauth_users` (`id`, `username`, `password`, `first_name`, `last_name`, `profile_image`) VALUES
(1,	'admin',	'$2y$12$2LaZrwlj9k9cbYaS5/ItT.zyAQ4dOcHVaQGJdRwpvydfzIV7omfye',	'Admin',	'CMS',	NULL);

-- 2020-07-18 22:13:23