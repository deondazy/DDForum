<?php
/**
 * The DDForum startup file
 *
 * Loads the config.php file or fail and
 * ask for installation, the config.sample.php file is used for
 * creating the config.php file
 *
 * @package ddforum
 */

use DDForum\Core\Database;
use DDForum\Core\Option;
use DDForum\Core\Installer;
use DDForum\Core\Config;
use DDForum\Core\Exception\DDFException;

// Kill file if not included from root
if (!defined('DDFPATH')) {
    header('HTTP/1.1 403 Forbidden', true, 403);
    die();
}

// Compare PHP versions against our required 5.6
if (!version_compare(PHP_VERSION, '5.6', '>=')) {
    die(
        'PHP 5.6 or higher is required to run DDForum, you currently have PHP ' . PHP_VERSION
    );
}

// Increase error reporting to E_ALL
error_reporting(E_ALL);

// Set default timezone, we'll base off of this later
date_default_timezone_set('UTC');

// Autoloader
require DDFPATH . 'vendor/autoload.php';

// Use our own exception handler
DDFException::handle();

// Check DDForum Installation
if (file_exists(DDFPATH .'config.php')) {
    // The config file exists load it
    include DDFPATH .'config.php';

    $db = Config::get('db_connection');

    // Connect to the Database
    Database::instance()->connect($db->string, $db->user, $db->password);

    // Are all the tables available?
    if (!Database::instance()->checkTables()) {
        Installer::init();
    }

    // Set debugging options
    if (defined('DEBUG') && DEBUG) {
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        ini_set('error_log', 'error.log');
    }
} else {
    Installer::init();
}
