<?php
/**
 * The functions file
 *
 * All functions and definitions for the ddforum
 *
 * @package ddforum
 */

// Can't be accessed directly
if ( !defined( 'DDFPATH' ) ) {
	die( 'Direct access denied' );
}

/**
 * Guess the URL for the site.
 *
 * Will remove admin links to retrieve only return URLs not in the admin
 * directory.
 *
 * @credit WordPress
 *
 * @return string The guessed URL.
 */
function guess_url() {
	if ( defined('SITEURL') && '' != SITEURL ) {
		$url = SITEURL;
	} else {
		$abspath_fix = str_replace( '\\', '/', DDFPATH );
		$script_filename_dir = dirname( $_SERVER['SCRIPT_FILENAME'] );

		// The request is for the admin
		if ( strpos( $_SERVER['REQUEST_URI'], 'admin' ) !== false || strpos( $_SERVER['REQUEST_URI'], 'auth.php' ) !== false ) {
			$path = preg_replace( '#/(admin/.*|auth.php)#i', '', $_SERVER['REQUEST_URI'] );

		// The request is for a file in DDFPATH
		} elseif ( $script_filename_dir . '/' == $abspath_fix ) {
			// Strip off any file/query params in the path
			$path = preg_replace( '#/[^/]*$#i', '', $_SERVER['PHP_SELF'] );

		} else {
			if ( false !== strpos( $_SERVER['SCRIPT_FILENAME'], $abspath_fix ) ) {
				// Request is hitting a file inside DDFPATH
				$directory = str_replace( DDFPATH, '', $script_filename_dir );
				// Strip off the sub directory, and any file/query paramss
				$path = preg_replace( '#/' . preg_quote( $directory, '#' ) . '/[^/]*$#i', '' , $_SERVER['REQUEST_URI'] );
			} elseif ( false !== strpos( $abspath_fix, $script_filename_dir ) ) {
				// Request is hitting a file above DDFPATH
				$subdirectory = substr( $abspath_fix, strpos( $abspath_fix, $script_filename_dir ) + strlen( $script_filename_dir ) );
				// Strip off any file/query params from the path, appending the sub directory to the install
				$path = preg_replace( '#/[^/]*$#i', '' , $_SERVER['REQUEST_URI'] ) . $subdirectory;
			} else {
				$path = $_SERVER['REQUEST_URI'];
			}
		}

		$schema = secure_protocol() ? 'https://' : 'http://'; // set_url_scheme() is not defined yet
		$url = $schema . $_SERVER['HTTP_HOST'] . $path;
	}

	return rtrim($url, '/');
}

function secure_protocol() {
	if ( isset($_SERVER['HTTPS']) ) {
		if ( 'on' == strtolower($_SERVER['HTTPS']) )
			return true;
		if ( '1' == $_SERVER['HTTPS'] )
			return true;
	} elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
		return true;
	}
	return false;

	//return true;
}

function home_url() {
	return get_option( 'site_url' );
}

function admin_url( $path = '' ) {
	return home_url() . '/admin/' . $path;
}

/**
 * Kill the script and display HTML error message
 */
function kill_script( $message = '', $back_link = false ) { ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>DDForum &rsaquo; Error</title>
	<style type="text/css">
		html, body {
			margin: 0;
			padding: 0;
		}
		body {
			background: #f1f1f1;
			font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
			margin-left: 5%;
			margin-right: 5%;
			font-size: 16px;
		}
		#error-div {
			background: #fff4f4;
			color: #4e3131;
			max-width: 700px;
			margin: 0 auto;
			padding: 20px 25px;
			border-radius: 5px;
			margin-top: 10%;
			box-shadow: 1px 2px 10px -4px #555;
		}
		#error-div h1 {
			font-size: 26px;
			border-bottom: 1px solid #f55;
		}
		.button-secondary {
			background: #f9f9f9;
		  border: 1px solid #ddd;
		  padding: 4px 15px;
		  font-size: 13px;
		  color: #555;
		  text-decoration: none;
		  cursor: pointer;
		}

		.button-secondary:hover {
			border-color: #ccc;
		}
	</style>
</head>
<body id="error-page">
	<div id="error-div">
		<?php echo $message; ?>

		<?php if ( $back_link ) : ?>
			<button class="action-button" onclick="window.history.back(-1)">Go back</button>
		<?php endif; ?>
	</div>
</body>
</html>
<?php
die();
}

function load_admin_css() {
	echo '<link rel="stylesheet" href="'. home_url() . '/admin/css/admin.css' . '"/>';
}

function load_db() {
	global $ddf_db;
	include_once DDFPATH . 'inc/class-ddf-db.php';
	$ddf_db = new ddf_db( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );

	return $ddf_db;
}

/**
 * Checks if DDForum is installed
 *
 * Checks site_name option and all tables
 *
 * @return bool false if one or more table doesn't exist, true if all exist
 */
function is_installed() {
	global $ddf_db;

	if ( ! defined( 'INSTALLING' ) ) {

		$site_url = $ddf_db->get_option( "site_url" );


		if ( !empty($site_url) )
			return true;

		$tables = $ddf_db->tables();

		foreach ($tables as $t) {
			$table_exist[] = $ddf_db->query( 'DESCRIBE ' . $t );
		}

		if ( in_array(true, $table_exist) ) {
			// One or more table exist, suggest a tables fix.
			kill_script( "ERROR: Installation is incomplete, one or more table is unavailable" );
		}
		else {
			// No tables exist, run installer.
			$installer_link = guess_url() . '/admin/install.php';
			redirect( $installer_link );
			die;
		}
	}

	return false;
}

/**
 * Check if a user is logged in
 *
 * If the cookie is set then the user is logged in
 * return true else return false
 */
function is_logged() {
	if ( isset( $_COOKIE['ddforum_logged'] ) )
		return true;

	return false;
}

function is_level( $level ) {
	global $ddf_user;

	$levels = array(
		'user'       => 0,
		'head_admin' => 1,
		'admin'      => 2,
		'moderator'  => 3,
	);

	if ( array_key_exists($level, $levels) ) {
		$level = $levels[ $level ];


		if ( $ddf_user->get_user( 'level', 'current_user') == $level ) {
			return true;
		}
		return false;
	}
	return false;
}

function is_admin() {
	if ( is_level('head_admin') || is_level('admin') )
		return true;

	return false;
}

function is_email( $string ) {
	$string = clean_input( $string );

	if ( preg_match("/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/", $string) )
		return true;
	else
		return false;
}

function get_level( $user_id ) {
	global $ddf_user;

	if ( $user_id == 'current_user' ) {
		$user_id = $ddf_user->current_userID();
	}

	$levels = array( 'User', 'Head Admin', 'Admin', 'Moderator' );

	$level_index = $ddf_user->get_user( 'level', $user_id );

	if ( array_key_exists($level_index, $levels) ) {
		 foreach ($levels as $index => $level) {
		 	if ( $level_index == $index ) {
		 		return $level;
		 	}
		 }
	}

	return false;
}

function current_user_can( $capability ) {
	global $ddf_user;

	$capabilities = array(
		'read',
		'create_forum',
		'manage_forums',
		'create_topic',
		'manage_topics',
		'add_reply',
		'manage_replies',
		'add_user',
		'manage_users',
		'add_download_item',
		'manage_download_items',
		'change_settings',
	);

	if ( in_array($capability, $capabilities) ) {
		$user_caps = $ddf_user->get_user( 'capabilities', 'current_user' );

		if ( !empty($user_caps) ) {
			$user_caps = unserialize($user_caps);

			if ( in_array($capability, $user_caps) ) {
				return true;
			}
			return false;
		}
		return false;
	}
	return false;
}

/**
 * Shows a HTML message in the page
 */
function show_message( $text = '', $kill = false ) {

	if ( !empty( $text ) ) {

		if ( is_array( $text ) ) { ?>
			<div class="show-message">
				<?php foreach ( $text as $msg ) {
					echo $msg . '<br/>';
				} ?>
			</div>
			<?php
		}
		else { ?>

			<div class="show-message"><?php echo $text; ?></div>

			<?php
		}
	}

	if ( $kill )
		die;
}

function clean_input( $input ) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);

	return $input;
}

function get_forum( $field, $forum_id ) {
	global $ddf_db;

	$forum = $ddf_db->query("SELECT {$field} FROM {$ddf_db->forums} WHERE `forumID` = '$forum_id'");
	$forum = $ddf_db->fetch_object($forum);

	if ( !empty($forum) ) {

		if ( $ddf_db->row_count > 0 ) {
			return $forum->$field;
		}

		return false;
	}

	return false;
}

function get_option( $option ) {
	global $ddf_db;

	$option = $ddf_db->get_option( $option );

	if ( !empty($option) ) {
		return $option;
	}
}

function redirect( $link = '' ) {
	if ( ! empty( $link ) ) {
		if ( ! headers_sent() ) {
			return header( 'Location: ' . trim( $link ) );
			exit;
		}
		else {
			kill_script( 'Unable to redirect <a href="' . $link . '">Click here</a> to proceed' );
		}
	}
	else {
		return false;
	}
}

function __checked_selected_result( $helper, $current, $show, $type ) {
	if ( (string) $helper === (string) $current )
		$result = " $type='$type'";

	else
		$result = '';

	if ( $show )
		echo $result;

	return $result;
}

function selected( $selected, $current = true, $show = true ) {
	return __checked_selected_result( $selected, $current, $show, 'selected' );
}

function checked( $checked, $current = true, $show = true ) {
	return __checked_selected_result( $checked, $current, $show, 'checked' );
}

function time2str($ts) {
	if ( !ctype_digit( $ts ) ) {
		$ts = strtotime( $ts );
	}

	$diff = time() - $ts;

	if ( $diff == 0 ) {
		return 'now';
	}
	elseif ( $diff > 0 ) {
		$day_diff = floor( $diff / 86400 );

		if ( $day_diff == 0 ) {
      if ( $diff < 60 ) return 'just now';
      if ( $diff < 120 ) return '1 minute ago';
      if ( $diff < 3600 ) return floor( $diff / 60 ) . ' minutes ago';
      if ( $diff < 7200 ) return '1 hour ago';
      if ( $diff < 86400 ) return floor( $diff / 3600 ) . ' hours ago';
    }

    if ( $day_diff == 1 ) return 'Yesterday';
    if ( $day_diff < 7 ) return $day_diff . ' days ago';
    if ( $day_diff < 31 ) return ceil( $day_diff / 7 ) . ' weeks ago';
    if ( $day_diff < 60 ) return 'last month';

    return date('F Y', $ts);
	}
	else {
		$diff = abs($diff);
	  $day_diff = floor($diff / 86400);

	  if ( $day_diff == 0 ) {
	  	if ( $diff < 120 ) return 'in a minute';
      if ( $diff < 3600 ) return 'in ' . floor($diff / 60) . ' minutes';
      if ( $diff < 7200 ) return 'in an hour';
      if ( $diff < 86400 ) return 'in ' . floor($diff / 3600) . ' hours';
    }

    if ( $day_diff == 1 ) return 'Tomorrow';
    if ( $day_diff < 4 ) return date('l', $ts);
    if ( $day_diff < 7 + ( 7 - date('w') ) ) return 'next week';
    if ( ceil($day_diff / 7 ) < 4 ) return 'in ' . ceil($day_diff / 7) . ' weeks';
    if ( date('n', $ts ) == date( 'n' ) + 1 ) return 'next month';
    return date( 'F Y', $ts );
	}
}

function timestamp( $datetime ) {
	list($date, $time) = explode(' ', $datetime);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);

	return $timestamp;
}

function breadcrumbs($separator = ' » ', $home = 'Home') {
	$path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

	$base_url = substr($_SERVER['SERVER_PROTOCOL'], 0, strpos($_SERVER['SERVER_PROTOCOL'], '/')) . '://' . $_SERVER['HTTP_HOST'] . '/';

	$breadcrumbs = array('<a href=""' . $base_url . '"">' . $home . '</a>');

	$tmp = array_keys($path);
	$last = end($tmp);
	unset($tmp);

	foreach ($path as $x => $crumb) {
$title = ucwords(str_replace(array('.php', '_'), array('', ' '), $crumb));
if ($x == 1){
$breadcrumbs[] = '<a href=""' . $base_url . $crumb.'"">'.$title.'</a>';
}elseif ($x > 1 && $x < $last){
$tmp = "for($i = 1; $i <= $x; $i++){ $tmp .= $path[$i] . '/'; } $tmp .= '\'>$title";
$breadcrumbs[] = $tmp;
unset($tmp);
}else{
$breadcrumbs[] = "$title";
}
}

return implode($separator, $breadcrumbs);
}

function set_page_view() {
	$sample_rate = 100;
if(mt_rand(1,$sample_rate) == 1) {
    $query = mysql_query(" UPDATE posts SET views = views + {$sample_rate} WHERE id = '{$id}' ");
    // execute query, etc
}
}

function user_exist( $user_id ) {
	global $user;

	if ( $user->get_user( 'userID', $user_id) ) {
		return true;
	}

	return false;
}

function get_user( $field, $user_id ) {
	global $ddf_user;

	$user = $ddf_user->get_user( $field, $user_id );

	if ( $user )
		return $user;
}

function date_select( $selected_day = '', $selected_month = '', $selected_year = '' ) { ?>

	<select class="select-box" id="day" name="day">
		<?php

		for ( $i = 1; $i <= 31; $i++ ) {
			$day[] = $i;
		}

		foreach ( $day as $id => $item ) : ?>
			<option value="<?php echo $item; ?>" <?php selected( $selected_day, $item ); ?>><?php echo $item; ?></option>
		<?php endforeach; ?>
	</select>

	<select class="select-box" id="month" name="month">
		<?php
		$months = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

		foreach ( $months as $id => $item ) :
			if ( $id == 0 ) continue; ?>
			<option value="<?php echo $id; ?>" <?php selected( $selected_month, $id ); ?>><?php echo $item; ?></option>
		<?php endforeach; ?>
	</select>

	<select class="select-box" id="year" name="year">
		<?php
		$current_year = (int) date('Y');
		$start_year = $current_year - 100;

		for ( $i = $start_year; $i <= $current_year; $i++ ) {
			$year[] = $i;
		}

		foreach ( $year as $id => $item ) : ?>
			<option value="<?php echo $item; ?>" <?php selected( $selected_year, $item ); ?>><?php echo $item; ?></option>
		<?php endforeach; ?>
	</select>
<?php }

function json_item_select( $json, $selected = '', $id = '', $name = '' ) {
	if ( file_exists( $json ) ) :
		$file = file_get_contents( $json );
		$get_json = json_decode($file);

		foreach ($get_json as $arr) {
			foreach ( $arr as $key => $value ) {
				$array[$key] = $value;
			}
		} ?>

		<select class="select-box" id="<?php echo $id; ?>" name="<?php echo $name; ?>">

			<?php for($i = 0, $c = count($array); $i < $c; $i++) : ?>
				<option value="<?php echo lcfirst( $array[$i] ); ?>" <?php selected( $selected, lcfirst($array[$i]) ); ?>><?php echo $array[$i]; ?></option>
			<?php endfor; ?>

		</select>
	<?php
	else :
		return show_message('File not found');
	endif;
}

function install() {
	global $ddf_db;

	$sql = <<<INSTALL
		CREATE TABLE $ddf_db->forums (
		`forumID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`forum_name` VARCHAR(100) NOT NULL DEFAULT '',
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

		CREATE TABLE $ddf_db->options (
		`optionID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`option_name` VARCHAR(100) NOT NULL default '',
		`option_value` LONGTEXT NOT NULL,
		PRIMARY KEY (`optionID`),
		UNIQUE KEY option_name (`option_name`)
		) ENGINE = INNODB, DEFAULT CHARSET = utf8;

		CREATE TABLE $ddf_db->users (
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

		CREATE TABLE $ddf_db->topics (
		`topicID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`forumID` bigint(20) UNSIGNED NOT NULL default '0',
		`topic_subject` text NOT NULL,
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

		CREATE TABLE $ddf_db->replies (
		`replyID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`forumID` bigint(20) UNSIGNED NOT NULL default '0',
		`topicID` bigint(20) UNSIGNED NOT NULL default '0',
		`reply_message` longtext NOT NULL,
		`reply_poster` bigint(20) UNSIGNED NOT NULL default '0',
		`reply_date` datetime NOT NULL default '0000-00-00 00:00:00',
		PRIMARY KEY (`replyID`)
		) ENGINE = INNODB, DEFAULT CHARSET = utf8;

		CREATE TABLE $ddf_db->pms (
		`ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`title` varchar(60) NOT NULL default '',
		`message` longtext NOT NULL,
		`from` bigint(20) UNSIGNED NOT NULL default '0',
		`to` bigint(20) UNSIGNED NOT NULL default '0',
		`read` tinyint(1) NOT NULL default '0',
		`draft` tinyint(1) NOT NULL default '0',
		PRIMARY KEY (`ID`)
		) ENGINE = INNODB, DEFAULT CHARSET = utf8;

		CREATE TABLE $ddf_db->files (
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

		CREATE TABLE $ddf_db->ads (
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

		CREATE TABLE $ddf_db->attachments (
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

		CREATE TABLE $ddf_db->notifications (
		`ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`notification` varchar(200) NOT NULL default '',
		`date` datetime NOT NULL default '0000-00-00 00:00:00',
		`to` bigint(20) UNSIGNED NOT NULL default '0',
		`seen` tinyint(1) NOT NULL default '0',
		PRIMARY KEY (`ID`)
		) ENGINE = INNODB, DEFAULT CHARSET = utf8;

		CREATE TABLE `$ddf_db->likes` (
		`ID`bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`itemID` bigint(20) UNSIGNED NOT NULL default '0',
		`liker` bigint(20) UNSIGNED NOT NULL default '0',
		`date` datetime NOT NULL default '0000-00-00 00:00:00',
		PRIMARY KEY (`ID`)
		) ENGINE = INNODB, DEFAULT CHARSET = utf8;

		CREATE TABLE $ddf_db->badwords (
		`ID`bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`word` varchar(100) NOT NULL default '',
		`replace` longtext NOT NULL,
		PRIMARY KEY (`ID`)
		) ENGINE = INNODB, DEFAULT CHARSET = utf8;

		CREATE TABLE $ddf_db->reports (
		`ID`bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`to` bigint(20) UNSIGNED NOT NULL default '0',
		`from` bigint(20) UNSIGNED NOT NULL default '0',
		`item` bigint(20) UNSIGNED NOT NULL default '0',
		`message` longtext NOT NULL,
		PRIMARY KEY (`ID`)
		) ENGINE = INNODB, DEFAULT CHARSET = utf8;

		CREATE TABLE $ddf_db->credit_transfer (
		`ID`bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`to` bigint(20) UNSIGNED NOT NULL default '0',
		`from` bigint(20) UNSIGNED NOT NULL default '0',
		`amount` bigint(20) NOT NULL default '0',
		`message` longtext NOT NULL,
		PRIMARY KEY (`ID`)
		) ENGINE = INNODB, DEFAULT CHARSET = utf8;
INSTALL;

	$run_install = $ddf_db->db_connect->multi_query($sql);

	if ( $run_install ) {
		return true;
	}

	return false;
}

function populate_defaults() {
	global $ddf_db;

	$sample_category = array(
		'forumID' => 1,
	  'forum_name' => 'First Category',
	  'forum_description' => 'This is the First Category, edit or delete it.',
	  'forum_type' => 'category',
	  'forum_creator' => 1,
	);

	$sample_forum = array(
		'forumID' => 2,
	  'forum_name' => 'First Forum',
	  'forum_description' => 'This is the First Forum, edit or delete it.',
	  'forum_creator' => 1,
	);

	$insert_category = $ddf_db->insert_data( $ddf_db->forums, $sample_category );
	$insert_forum = $ddf_db->insert_data( $ddf_db->forums, $sample_forum );

	if ( $insert_category && $insert_forum )
		return true;

	return false;
}

function populate_options( $site_name, $email ) {
	global $ddf_db;

	$options = array(
		'site_name' => $site_name,
		'site_url' => guess_url(),
		'site_description' => '',
		'admin_email' => $email,
		'enable_pm' => 1,
		'enable_credits' => 1,
		'enable_ads' => 1,
		'enable_downloads' => 1,
		'enable_notifications' => 1,
		'enable_likes' => 1,
		'users_can_upload' => 0,
		'allow_reports' => 1,
		'allow_credit_transfer' => 1,
	);

	foreach ( $options as $option_name => $value ) {
		 $insert_options = $ddf_db->insert_data( $ddf_db->options, array('option_name' => $option_name, 'option_value' => $value ));
	}

	if ( $insert_options )
		return true;

	return false;
}

function count_topic_view( $topic_id ) {
	global $ddf_db;

	$ddf_db->update_data( $ddf_db->topics, array("topic_views" => "increment(1)"), "topicID = '{$topic_id}'" );
}
