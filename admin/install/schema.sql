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
