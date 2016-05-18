<?php
/**
 * The DDForum Configuration
 *
 * This file contains the configuration for the MySQL settings
 * and table prefix
 *
 * This file is used for creating the config.php file, if you do not
 * want to use the web auto config file creation you can copy the
 * content of this file, fill in the settings information and save it
 * as config.php
 *
 * @package DDForum
 */

/**
 * MySQL Database settings
 *
 * Get this information from your host
 */
// The database name for DDForum installation
define('DB_NAME', 'the_database_name_here');

// The database username
define('DB_USER', 'the_database_username');

// The database password
define('DB_PASSWORD', 'the_database_password');

// The database host
define('DB_HOST', 'localhost');

/**
 * DDForum database table prefix
 *
 * With different prefix for different prefix for
 * different installations, you can run multiple
 * installations of DDForum from one database
 */
define('TABLE_PREFIX', 'ddf_');

// DEV_MODE allows for displaying and logging errors
define('DEV_MODE', false);
