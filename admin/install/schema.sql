CREATE TABLE {$prefix}ads (
  ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  forumID bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  type varchar(20) NOT NULL DEFAULT 'image',
  name varchar(60) NOT NULL DEFAULT '',
  description text NOT NULL,
  owner bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  url varchar(100) NOT NULL DEFAULT '',
  image varchar(100) NOT NULL DEFAULT '',
  start_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  end_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (ID),
  KEY forumID (forumID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}attachments (
  ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  itemID bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  name varchar(60) NOT NULL DEFAULT '',
  size bigint(20) NOT NULL DEFAULT '0',
  owner bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  url varchar(100) NOT NULL DEFAULT '',
  mime varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (ID),
  KEY itemID (itemID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}badwords (
  ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  word varchar(100) NOT NULL DEFAULT '',
  replace longtext NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}credit_transfer (
  ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  to bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  from bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  amount bigint(20) NOT NULL DEFAULT '0',
  message longtext NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}files (
  ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  type varchar(20) NOT NULL DEFAULT '',
  name varchar(60) NOT NULL DEFAULT '',
  size bigint(20) NOT NULL DEFAULT '0',
  url varchar(200) NOT NULL DEFAULT '',
  uploader bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  upload_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  downloads bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}forums (
  forumID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  forum_name varchar(100) NOT NULL DEFAULT '',
  forum_slug varchar(255) NOT NULL,
  forum_description text NOT NULL,
  forum_type varchar(20) NOT NULL DEFAULT 'forum',
  forum_status varchar(20) NOT NULL DEFAULT 'open',
  forum_visibility varchar(20) NOT NULL DEFAULT 'public',
  forum_parent bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  forum_creator bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  forum_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  forum_last_post datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (forumID),
   UNIQUE KEY forum_slug (forum_slug),
   KEY forum_name (forum_name),
   KEY forum_parent (forum_parent),
   KEY forum_creator (forum_creator)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}likes (
  ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  itemID bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  liker bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (ID),
  KEY itemID (itemID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}notifications (
  ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  notification varchar(200) NOT NULL DEFAULT '',
  date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  to bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  seen tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}options (
  optionID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  option_name varchar(100) NOT NULL DEFAULT '',
  option_value longtext NOT NULL,
  PRIMARY KEY (optionID),
  UNIQUE KEY option_name (option_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}pms (
  ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  title varchar(60) NOT NULL DEFAULT '',
  message longtext NOT NULL,
  from bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  to bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  read tinyint(1) NOT NULL DEFAULT '0',
  draft tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}replies (
  replyID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  forumID bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  topicID bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  reply_message longtext NOT NULL,
  reply_poster bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  reply_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (replyID),
  KEY forumID (forumID),
  KEY topicID (topicID),
  KEY reply_poster (reply_poster)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}reports (
  ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  to bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  from bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  item bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  message longtext NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}topics (
  topicID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  forumID bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  topic_subject text NOT NULL,
  topic_slug varchar(255) NOT NULL DEFAULT '',
  topic_message longtext NOT NULL,
  topic_status varchar(20) NOT NULL DEFAULT 'open',
  topic_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  topic_last_post_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  topic_poster bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  topic_last_poster bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  topic_sticky tinyint(1) NOT NULL DEFAULT '0',
  topic_views bigint(20) NOT NULL DEFAULT '0',
  pin tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (topicID),
  UNIQUE KEY topic_slug (topic_slug),
  KEY forumID (forumID),
  KEY topic_poster (topic_poster),
  KEY topic_last_poster (topic_last_poster)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$prefix}users (
  userID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  username varchar(60) NOT NULL DEFAULT '',
  password varchar(255) NOT NULL DEFAULT '',
  email varchar(100) NOT NULL DEFAULT '',
  activation_key varchar(200) NOT NULL DEFAULT '',
  status tinyint(1) NOT NULL DEFAULT '1',
  level tinyint(1) NOT NULL DEFAULT '0',
  first_name varchar(60) NOT NULL DEFAULT '',
  last_name varchar(60) NOT NULL DEFAULT '',
  display_name varchar(200) NOT NULL DEFAULT '',
  birth_day int(2) NOT NULL DEFAULT '27',
  birth_month int(2) NOT NULL DEFAULT '10',
  birth_year year(4) NOT NULL DEFAULT '1995',
  age int(11) NOT NULL DEFAULT '18',
  gender varchar(20) NOT NULL DEFAULT 'male',
  city varchar(100) NOT NULL DEFAULT '',
  state varchar(100) NOT NULL DEFAULT '',
  country varchar(100) NOT NULL DEFAULT '',
  avatar varchar(250) NOT NULL DEFAULT '',
  biography text NOT NULL,
  mobile varchar(20) NOT NULL DEFAULT '',
  facebook varchar(100) NOT NULL DEFAULT '',
  twitter varchar(100) NOT NULL DEFAULT '',
  website_title varchar(100) NOT NULL DEFAULT '',
  website_url varchar(100) NOT NULL DEFAULT '',
  register_date date NOT NULL DEFAULT '0000-00-00',
  online_status tinyint(1) NOT NULL DEFAULT '0',
  last_seen datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  credit bigint(20) NOT NULL DEFAULT '0',
  use_pm tinyint(1) NOT NULL DEFAULT '1',
   PRIMARY KEY (userID),
   UNIQUE KEY username (username),
   UNIQUE KEY email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
