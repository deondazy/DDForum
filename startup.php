<?php
/**
 * The DDForum startup file
 *
 * Loads the ddf-config.php file or fail and
 * ask for installation
 *
 * @package DDForum
 */

use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Reply;
use DDForum\Core\Option;
use DDForum\Core\Database;
use DDForum\Core\Installer;
use DDForum\Core\Attachment;
use DDForum\Core\Config;
use DDForum\Core\Notification;
use DDForum\Core\Message;
use DDForum\Core\Exception\DDFException;

// Kill file if not included from root
if (!defined('DDFPATH')) {
    header('HTTP/1.1 403 Forbidden', true, 403);
    exit();
}

<<<<<<< HEAD
// Compare PHP versions against our required 5.6
if (!version_compare(PHP_VERSION, '5.6', '>=')) {
    exit(
        'PHP 5.6 or higher is required to run DDForum, you currently have PHP '.PHP_VERSION
=======
if (!defined('DDF_VERSION')) {
    define('DDF_VERSION', '1.0.0');
}

// Required PHP version
define('DDF_PHP_VERSION', '7.4');

// Define App Name
define('DDF_APP_NAME', 'DDForum');

// Compare PHP versions against our required 5.6
if (!version_compare(PHP_VERSION, DDF_PHP_VERSION, '>=')) {
    exit(
        'PHP '.DDF_PHP_VERSION.' or higher is required to run '.DDF_APP_NAME.', you currently have PHP '.PHP_VERSION
>>>>>>> update
    );
}

// Increase error reporting to E_ALL
error_reporting(E_ALL);

// Set default timezone, we'll base off of this later
date_default_timezone_set('UTC');

// Autoloader
require DDFPATH.'vendor/autoload.php';

// Use our own exception handler
//DDFException::handle();

// Check DDForum Installation
if (!file_exists(DDFPATH.'ddf-config.php')) {
    Installer::init();
} else {
    // The config file exists load it
    include DDFPATH.'ddf-config.php';

    // Check and set debugging options
    if (defined('DEBUG') && DEBUG) {
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        ini_set('error_log', 'error.log');
    }

    // Get Database configuration details
    $db = Config::get('db_connection');

    // Connect to the Database
    Database::instance()->connect($db->string, $db->user, $db->password);

    // Check for the option table
    if (!Database::instance()->checkOptionsTable()) {
        Installer::init();
    }

    // All good! create needed objects
    $forum    = new Forum();
    $topic    = new Topic();
    $reply    = new Reply();
    $option   = new Option();
    $user     = new User();
    $notif    = new Notification();
    $message  = new Message();
    $attach   = new Attachment();
}
