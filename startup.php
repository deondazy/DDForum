<?php
/**
 * The ddforum startup file
 *
 * Loads the config.php file or fail and
 * ask for installation, the config.sample.php file is used for
 * creating the config.php file
 *
 * @package ddforum
 */

use DDForum\Core\Database;
use DDForum\Core\DatabaseException;
use DDForum\Core\Option;
use DDForum\Core\Site;
use DDForum\Core\Error;

// Kill file if not included from root
if ( !defined( 'DDFPATH' ) ) {
	header( 'HTTP/1.1 403 Forbidden', true, 403 );
	die();
}

// Compare PHP versions against our required 5.4
if (!version_compare(PHP_VERSION, '5.4', '>=')) {
	die('PHP 5.4 or higher is required to run DDForum, you currently have PHP ' . PHP_VERSION . '.');
}

// Increase error reporting to E_ALL
error_reporting(E_ALL);

// Set default timezone, we'll base off of this later
date_default_timezone_set('UTC');

// Autoloader
require_once DDFPATH . 'vendor/autoload.php';

// Use our own error handler
Error::handle();

/*
 * Check DDForum Installation
 */

$config_file = Option::config_file();

if (file_exists($config_file)) {

	// The config file exists load it
	require_once($config_file);

	// Connect to the Database
	Database::connect();

	if (defined('DEBUG') && DEBUG) {
		ini_set('display_errors', 1);
		ini_set('log_errors', 1);
		ini_set('error_log', 'error.log');
	}

} else {
	/*
	 * No config file, we run installation
	 */

	// Path to install.php file
	$create_config = Site::adminUrl('install/install.php');

	// Redirect to install.php
	if (false === strpos($_SERVER['REQUEST_URI'], 'install')) {
		header('Location: ' . $create_config);
		exit;
	}
}
