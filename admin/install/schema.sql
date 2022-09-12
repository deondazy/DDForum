<<<<<<< HEAD
CREATE TABLE IF NOT EXISTS `{$prefix}ads` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forum` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT 'image',
  `name` varchar(60) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `owner` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL DEFAULT '',
  `image` varchar(100) NOT NULL DEFAULT '',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `forum` (`forum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}attachments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL DEFAULT '',
  `size` bigint(20) NOT NULL DEFAULT '0',
  `owner` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `url` varchar(100) NOT NULL DEFAULT '',
  `mime` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `item` (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}badwords` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `word` varchar(100) NOT NULL DEFAULT '',
  `replace` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}credit_transfer` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `to` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `sender` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `amount` bigint(20) NOT NULL DEFAULT '0',
  `message` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}files` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `size` bigint(20) NOT NULL DEFAULT '0',
  `url` varchar(200) NOT NULL DEFAULT '',
  `uploader` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `upload_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `downloads` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}forums` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'forum',
  `status` varchar(20) NOT NULL DEFAULT 'open',
  `visibility` varchar(20) NOT NULL DEFAULT 'public',
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `creator` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (`id`),
   UNIQUE KEY `slug` (`slug`),
   KEY `name` (`name`),
   KEY `parent` (`parent`),
   KEY `creator` (`creator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}likes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `liker` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `item` (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}notifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `notification` varchar(200) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `to` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}options` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}pms` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '',
  `message` longtext NOT NULL,
  `sender` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `to` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}replies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forum` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `topic` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext NOT NULL,
  `poster` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `forum` (`forum`),
  KEY `topic` (`topic`),
  KEY `poster` (`poster`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `to` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `sender` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `item` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}topics` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forum` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT '',
  `message` longtext NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'open',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `poster` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `last_poster` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `views` bigint(20) NOT NULL DEFAULT '0',
  `pinned` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `forum` (`forum`),
  KEY `poster` (`poster`),
  KEY `last_poster` (`last_poster`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$prefix}users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `activation_key` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `first_name` varchar(60) NOT NULL DEFAULT '',
  `last_name` varchar(60) NOT NULL DEFAULT '',
  `display_name` varchar(200) NOT NULL DEFAULT '',
  `birth_day` int(2) NOT NULL DEFAULT '27',
  `birth_month` int(2) NOT NULL DEFAULT '10',
  `birth_year` year(4) NOT NULL DEFAULT '1995',
  `age` int(11) NOT NULL DEFAULT '18',
  `gender` varchar(20) NOT NULL DEFAULT 'male',
  `city` varchar(100) NOT NULL DEFAULT '',
  `state` varchar(100) NOT NULL DEFAULT '',
  `country` varchar(100) NOT NULL DEFAULT '',
  `avatar` varchar(250) NOT NULL DEFAULT '',
  `biography` text NOT NULL,
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `facebook` varchar(100) NOT NULL DEFAULT '',
  `twitter` varchar(100) NOT NULL DEFAULT '',
  `website_title` varchar(100) NOT NULL DEFAULT '',
  `website_url` varchar(100) NOT NULL DEFAULT '',
  `register_date` date NOT NULL DEFAULT '0000-00-00',
  `online_status` tinyint(1) NOT NULL DEFAULT '0',
  `last_seen` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `credit` bigint(20) NOT NULL DEFAULT '0',
  `use_pm` tinyint(1) NOT NULL DEFAULT '1',
   PRIMARY KEY (`id`),
   UNIQUE KEY `username` (`username`),
   UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
=======
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
>>>>>>> update
