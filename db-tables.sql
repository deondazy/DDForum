DROP TABLE IF EXISTS `ddf_forums`;
CREATE TABLE `ddf_forums`(
`forumID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`forum_name` VARCHAR(100) NOT NULL DEFAULT '',
`forum_slug` VARCHAR(100) NOT NULL DEFAULT '',
`forum_description` TEXT NOT NULL,
`forum_type` VARCHAR(20) NOT NULL DEFAULT 'forum',
`forum_status` VARCHAR(20) NOT NULL DEFAULT 'open',
`forum_visibility` VARCHAR(20) NOT NULL DEFAULT 'public',
`forum_parent` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
`forum_creator` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
`forum_topics` BIGINT(20) NOT NULL DEFAULT '0',
`forum_replies` BIGINT(20) NOT NULL DEFAULT '0',
`forum_last_post` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
PRIMARY KEY (`forumID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_options`;
CREATE TABLE `ddf_options` (
`optionID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`option_name` VARCHAR(100) NOT NULL default '',
`option_value` LONGTEXT NOT NULL,
PRIMARY KEY (`optionID`),
UNIQUE KEY option_name (`option_name`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_users`;
CREATE TABLE `ddf_users` (
`userID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`username` varchar(60) NOT NULL default '',
`password` varchar(255) NOT NULL default '',
`email` varchar(100) NOT NULL default '',
`activation_key` varchar(200) NOT NULL default '',
`status` tinyint(1) NOT NULL default '1',
`level` tinyint(1) NOT NULL default '0',
`first_name` varchar(60) NOT NULL default '',
`last_name` varchar(60) NOT NULL default '',
`display_name` varchar(200) NOT NULL default '',
`birth_day` int(2) NOT NULL default '27',
`birth_month` int(2) NOT NULL default '10',
`birth_year` year(4) NOT NULL default '1995',
`age` int(11) NOT NULL default '18',
`gender` varchar(20) NOT NULL default 'male',
`city` varchar(100) NOT NULL default '',
`state` varchar(100) NOT NULL default '',
`country` varchar(100) NOT NULL default '',
`avatar` varchar(250) NOT NULL default '',
`biography` text NOT NULL,
`mobile` varchar(20) NOT NULL default '',
`facebook` varchar(100) NOT NULL default '',
`twitter` varchar(100) NOT NULL default '',
`website_title` varchar(100) NOT Null default '',
`website_url` varchar(100) NOT NULL default '',
`register_date` date NOT NULL default '0000-00-00',
`online_status` tinyint(1) NOT NULL default '0',
`last_seen` datetime NOT NULL default '0000-00-00 00:00:00',
`topic_count` bigint(20) NOT NULL default '0',
`reply_count` bigint(20) NOT NULL default '0',
`credit` bigint(20) NOT NULL default '0',
`use_pm` tinyint(1) NOT NULL default '1',
PRIMARY KEY (`userID`),
UNIQUE KEY username (`username`),
UNIQUE KEY email (`email`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_topics`;
CREATE TABLE `ddf_topics` (
`topicID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`forumID` bigint(20) UNSIGNED NOT NULL default '0',
`topic_subject` text NOT NULL,
`topic_slug` text NOT NULL,
`topic_message` longtext NOT NULL,
`topic_status` varchar(20) NOT NULL default 'open',
`topic_date` datetime NOT NULL default '0000-00-00 00:00:00',
`topic_last_post_date` datetime NOT NULL default '0000-00-00 00:00:00',
`topic_poster` bigint(20) UNSIGNED NOT NULL default '0',
`topic_last_poster` bigint(20) UNSIGNED NOT NULL default '0',
`topic_replies` bigint(20) NOT NULL default '0',
`topic_sticky` tinyint(1) NOT NULL default '0',
`topic_views` bigint(20) NOT NULL default '0',
PRIMARY KEY (`topicID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_replies`;
CREATE TABLE `ddf_replies` (
`replyID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`forumID` bigint(20) UNSIGNED NOT NULL default '0',
`topicID` bigint(20) UNSIGNED NOT NULL default '0',
`reply_message` longtext NOT NULL,
`reply_poster` bigint(20) UNSIGNED NOT NULL default '0',
`reply_date` datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY (`replyID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_pms`;
CREATE TABLE `ddf_pms` (
`ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(60) NOT NULL default '',
`message` longtext NOT NULL,
`from` bigint(20) UNSIGNED NOT NULL default '0',
`to` bigint(20) UNSIGNED NOT NULL default '0',
`read` tinyint(1) NOT NULL default '0',
`draft` tinyint(1) NOT NULL default '0',
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_files`;
CREATE TABLE `ddf_files` (
`ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`type` varchar(20) NOT NULL default '',
`name` varchar(60) NOT NULL default '',
`size` bigint(20) NOT NULL default '0',
`url` varchar(200) NOT NULL default '',
`uploader` bigint(20) UNSIGNED NOT NULL default '0',
`upload_date` datetime NOT NULL default '0000-00-00 00:00:00',
`downloads` bigint(20) NOT NULL default '0',
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_ads`;
CREATE TABLE `ddf_ads` (
`ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`forumID` bigint(20) UNSIGNED NOT NULL default '0',
`type` varchar(20) NOT NULL default 'image',
`name` varchar(60) NOT NULL default '',
`description` text NOT NULL,
`owner` bigint(20) UNSIGNED NOT NULL default '0',
`url` varchar(100) NOT NULL default '',
`image` varchar(100) NOT NULL default '',
`start` datetime NOT NULL default '0000-00-00 00:00:00',
`end` datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_attachments`;
CREATE TABLE `ddf_attachments` (
`ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`itemID` bigint(20) UNSIGNED NOT NULL default '0',
`name` varchar(60) NOT NULL default '',
`size` bigint(20) NOT NULL default '0',
`owner` bigint(20) UNSIGNED NOT NULL default '0',
`date` datetime NOT NULL default '0000-00-00 00:00:00',
`url` varchar(100) NOT NULL default '',
`mime` varchar(20) NOT NULL default '',
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_notifications`;
CREATE TABLE `ddf_notifications` (
`ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`notification` varchar(200) NOT NULL default '',
`date` datetime NOT NULL default '0000-00-00 00:00:00',
`to` bigint(20) UNSIGNED NOT NULL default '0',
`seen` tinyint(1) NOT NULL default '0',
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_follow`;
CREATE TABLE `ddf_follow` (
`ID`bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`itemID` bigint(20) UNSIGNED NOT NULL default '0',
`follower` bigint(20) UNSIGNED NOT NULL default '0',
`date` datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_likes`;
CREATE TABLE `ddf_likes` (
`ID`bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`itemID` bigint(20) UNSIGNED NOT NULL default '0',
`liker` bigint(20) UNSIGNED NOT NULL default '0',
`date` datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_badwords`;
CREATE TABLE `ddf_badwords` (
`ID`bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`word` varchar(100) NOT NULL default '',
`replace` longtext NOT NULL,
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_reports`;
CREATE TABLE `ddf_reports` (
`ID`bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`to` bigint(20) UNSIGNED NOT NULL default '0',
`from` bigint(20) UNSIGNED NOT NULL default '0',
`item` bigint(20) UNSIGNED NOT NULL default '0',
`message` longtext NOT NULL,
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `ddf_credit_transfer`;
CREATE TABLE `ddf_credit_transfer` (
`ID`bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
`to` bigint(20) UNSIGNED NOT NULL default '0',
`from` bigint(20) UNSIGNED NOT NULL default '0',
`amount` bigint(20) NOT NULL default '0',
`message` longtext NOT NULL,
PRIMARY KEY (`ID`)
) ENGINE = INNODB, DEFAULT CHARSET = utf8;
