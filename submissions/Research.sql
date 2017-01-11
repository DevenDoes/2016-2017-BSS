-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'papers'
-- 
-- ---

DROP TABLE IF EXISTS `papers`;
		
CREATE TABLE `papers` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `author` VARCHAR(200) NULL DEFAULT NULL,
  `filename` VARCHAR(200) NULL DEFAULT NULL,
  `subject` VARCHAR(50) NULL DEFAULT NULL,
  `title` VARCHAR(50) NULL DEFAULT NULL,
  `timestamp` TIME NULL DEFAULT NULL,
  `mentorEmail` VARCHAR(200) NULL DEFAULT NULL,
  `category` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'users'
-- 
-- ---

DROP TABLE IF EXISTS `users`;
		
CREATE TABLE `users` (
  `id` INTEGER NOT NULL AUTO_INCREMENT DEFAULT NULL,
  `email` VARCHAR(50) NULL DEFAULT NULL,
  `password` VARCHAR(50) NULL DEFAULT NULL,
  `editor` BOOLEAN NULL DEFAULT NULL,
  `admin` BOOLEAN NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

insert into users set password = password('unicornslovescience'), email = 'broadstreetscientific@ncssm.edu', editor = 1, admin = 1;



-- ---
-- Foreign Keys 
-- ---


-- ---
-- Table Properties
-- ---

-- ALTER TABLE `papers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `papers` (`id`,`author`,`filename`,`subject`,`title`,`timestamp`) VALUES
-- ('','','','','','');
-- INSERT INTO `users` (`id`,`email`,`password`,`editor`) VALUES
-- ('','','','');
