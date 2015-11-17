



-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'users'a
-- 
-- ---

DROP TABLE IF EXISTS `users`;
		
CREATE TABLE `users` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `email` VARCHAR (32) DEFAULT NULL,
  `password` BLOB NULL DEFAULT NULL,
  `salt` BLOB NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'papers'
-- 
-- ---

DROP TABLE IF EXISTS `papers`;
		
CREATE TABLE `papers` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `author` VARCHAR (32) DEFAULT NULL,
  `filename` VARCHAR (32) DEFAULT NULL,
  `subject` VARCHAR(32) DEFAULT NULL, 
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---



-- ---
-- Table Properties
-- ---

-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `papers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `users` (`id`,`name`,`email`,`password`,`salt`) VALUES
-- ('','','','','');
-- INSERT INTO `papers` (`id`,`user_id`,`filename`) VALUES
-- ('','','');

