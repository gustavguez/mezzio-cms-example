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

-- 2020-07-17 01:45:28