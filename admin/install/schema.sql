CREATE TABLE IF NOT EXISTS `{$prefix}ads` ( 
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, 
    `forum` BIGINT(20) UNSIGNED NULL, 
    `type` VARCHAR(20) NULL DEFAULT 'image', 
    `name` VARCHAR(60) NULL, 
    `description` TEXT NULL, 
    `owner` BIGINT(20) UNSIGNED NULL, 
    `url` VARCHAR(255) NULL, 
    `image` VARCHAR(255) NULL, 
    `start_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP, 
    `end_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (`id`), 
    INDEX `forum` (`forum`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}attachments` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` BIGINT(20) UNSIGNED NULL,
  `name` VARCHAR(60) NULL,
  `size` BIGINT(20) NULL,
  `owner` BIGINT(20) UNSIGNED NULL,
  `create_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `url` VARCHAR(100) NULL,
  `mime` VARCHAR(20) NULL,
  PRIMARY KEY (`id`),
  INDEX `item` (`item`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}badwords` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `word` VARCHAR(100) NULL,
  `replace` longtext NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}credit_transfer` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `to` BIGINT(20) UNSIGNED NULL,
  `sender` BIGINT(20) UNSIGNED NULL,
  `amount` BIGINT(20) NULL,
  `message` longtext NULL,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}files` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(20) NULL,
  `name` VARCHAR(60) NULL,
  `size` BIGINT(20) NULL,
  `url` VARCHAR(200) NULL,
  `uploader` BIGINT(20) UNSIGNED NULL,
  `upload_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `downloads` BIGINT(20) NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}forums` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `slug` VARCHAR(255) NULL,
  `description` text NULL,
  `type` VARCHAR(20) NULL DEFAULT 'forum',
  `status` VARCHAR(20) NULL DEFAULT 'open',
  `visibility` VARCHAR(20) NULL DEFAULT 'public',
  `parent` BIGINT(20) UNSIGNED NULL,
  `creator` BIGINT(20) UNSIGNED NULL,
  `create_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `last_post_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`),
   UNIQUE KEY `slug` (`slug`),
   INDEX `name` (`name`),
   INDEX `parent` (`parent`),
   INDEX `creator` (`creator`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}likes` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` BIGINT(20) UNSIGNED NULL,
  `liker` BIGINT(20) UNSIGNED NULL,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `item` (`item`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}notifications` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `notification` VARCHAR(200) NULL,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `to` BIGINT(20) UNSIGNED NULL,
  `seen` tinyint(1) NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}options` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `value` longtext NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}pms` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(60) NULL,
  `message` longtext NULL,
  `sender` BIGINT(20) UNSIGNED NULL,
  `to` BIGINT(20) UNSIGNED NULL,
  `status` VARCHAR(10) NULL DEFAULT 'pending',
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}replies` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forum` BIGINT(20) UNSIGNED NULL,
  `topic` BIGINT(20) UNSIGNED NULL,
  `parent` BIGINT(20) UNSIGNED NULL,
  `message` longtext NULL,
  `poster` BIGINT(20) UNSIGNED NULL,
  `create_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `forum` (`forum`),
  INDEX `topic` (`topic`),
  INDEX `poster` (`poster`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}reports` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `to` BIGINT(20) UNSIGNED NULL,
  `sender` BIGINT(20) UNSIGNED NULL,
  `item` BIGINT(20) UNSIGNED NULL,
  `message` longtext NULL,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}topics` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forum` BIGINT(20) UNSIGNED NULL,
  `subject` text NULL,
  `slug` VARCHAR(255) NULL,
  `message` longtext NULL,
  `status` VARCHAR(20) NULL DEFAULT 'open',
  `create_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `last_post_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `poster` BIGINT(20) UNSIGNED NULL,
  `last_poster` BIGINT(20) UNSIGNED NULL,
  `sticky` tinyint(1) NULL,
  `views` BIGINT(20) NULL,
  `pinned` tinyint(1) UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  INDEX `forum` (`forum`),
  INDEX `poster` (`poster`),
  INDEX `last_poster` (`last_poster`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `{$prefix}users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(60) NULL,
  `password` VARCHAR(255) NULL,
  `email` VARCHAR(100) NULL,
  `activation_key` VARCHAR(200) NULL,
  `status` tinyint(1) NULL DEFAULT '1',
  `level` tinyint(1) NULL,
  `first_name` VARCHAR(60) NULL,
  `last_name` VARCHAR(60) NULL,
  `display_name` VARCHAR(200) NULL,
  `birth_day` int(2) NULL DEFAULT '27',
  `birth_month` int(2) NULL DEFAULT '10',
  `birth_year` year(4) NULL DEFAULT '1995',
  `age` int(11) NULL DEFAULT '18',
  `gender` VARCHAR(20) NULL DEFAULT 'male',
  `city` VARCHAR(100) NULL,
  `state` VARCHAR(100) NULL,
  `country` VARCHAR(100) NULL,
  `avatar` VARCHAR(250) NULL,
  `biography` text NULL,
  `mobile` VARCHAR(20) NULL,
  `facebook` VARCHAR(100) NULL,
  `twitter` VARCHAR(100) NULL,
  `website_title` VARCHAR(100) NULL,
  `website_url` VARCHAR(100) NULL,
  `register_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `online_status` tinyint(1) NULL,
  `last_seen` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `credit` BIGINT(20) NULL,
  `use_pm` tinyint(1) NULL DEFAULT '1',
   PRIMARY KEY (`id`),
   UNIQUE KEY `username` (`username`),
   UNIQUE KEY `email` (`email`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;
