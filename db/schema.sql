-- Programming Training Team / TeamPortal
-- Reconstructed schema from the final GitHub source and the teacher-platform phpMyAdmin ERD.
-- MySQL 8 / MariaDB 10.5+ compatible.

CREATE DATABASE IF NOT EXISTS `programming_training_team`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `programming_training_team`;

CREATE TABLE IF NOT EXISTS `account` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `acc` VARCHAR(50) NOT NULL,
  `pwd` VARCHAR(255) NOT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` ENUM('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_account_acc` (`acc`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `personal_info` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `stu_id` VARCHAR(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `mail` VARCHAR(255) NOT NULL,
  `acc_id` INT NOT NULL,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_personal_info_stu_id` (`stu_id`),
  UNIQUE KEY `uq_personal_info_acc_id` (`acc_id`),
  CONSTRAINT `fk_personal_info_account`
    FOREIGN KEY (`acc_id`) REFERENCES `account` (`id`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `acc_id` INT NOT NULL,
  `category` VARCHAR(50) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `keywords` VARCHAR(255) DEFAULT NULL,
  `content` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_posts_acc_id` (`acc_id`),
  KEY `idx_posts_created_at` (`created_at`),
  CONSTRAINT `fk_posts_account`
    FOREIGN KEY (`acc_id`) REFERENCES `account` (`id`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_id` INT NOT NULL,
  `acc_id` INT NOT NULL,
  `content` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_comments_post_id` (`post_id`),
  KEY `idx_comments_acc_id` (`acc_id`),
  CONSTRAINT `fk_comments_post`
    FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `fk_comments_account`
    FOREIGN KEY (`acc_id`) REFERENCES `account` (`id`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `review` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `stu_id` VARCHAR(20) NOT NULL,
  `fullname` VARCHAR(100) NOT NULL,
  `acc` VARCHAR(100) NOT NULL,
  `pwd` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `q1` ENUM('yes','no') NOT NULL,
  `ApcsC` INT DEFAULT NULL,
  `ApcsP` INT DEFAULT NULL,
  `rawApcsC` INT DEFAULT NULL,
  `rawApcsP` INT DEFAULT NULL,
  `ApcsReason` TEXT DEFAULT NULL,
  `q2` TEXT DEFAULT NULL,
  `q3` ENUM('yes','no') NOT NULL,
  `q3_1` INT DEFAULT NULL,
  `q3_2` VARCHAR(20) DEFAULT NULL,
  `q3_3` TEXT DEFAULT NULL,
  `q4` TEXT DEFAULT NULL,
  `q5` TEXT DEFAULT NULL,
  `q6` TEXT DEFAULT NULL,
  `q7` TEXT DEFAULT NULL,
  `q8` TEXT DEFAULT NULL,
  `q9` TEXT DEFAULT NULL,
  `checked` TINYINT(1) NOT NULL DEFAULT 0,
  `pass` TINYINT(1) NOT NULL DEFAULT 0,
  `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_review_stu_id` (`stu_id`),
  UNIQUE KEY `uq_review_acc` (`acc`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `visitor` (
  `vid` INT NOT NULL,
  `visitor` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB;

INSERT INTO `visitor` (`vid`, `visitor`) VALUES (1, 0)
ON DUPLICATE KEY UPDATE `vid` = VALUES(`vid`);

-- Present in the original teacher-platform ERD but unused by the final PHP code.
CREATE TABLE IF NOT EXISTS `domjudge` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `stu_id` INT DEFAULT NULL,
  `acc` VARCHAR(50) DEFAULT NULL,
  `pwd` VARCHAR(255) DEFAULT NULL,
  `acc_id` INT DEFAULT NULL,
  `creat_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_domjudge_acc_id` (`acc_id`),
  CONSTRAINT `fk_domjudge_account`
    FOREIGN KEY (`acc_id`) REFERENCES `account` (`id`)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;
