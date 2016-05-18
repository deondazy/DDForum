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
define('DB_NAME', 'ddforum');

// The database username
define('DB_USER', 'deondazy');

// The database password
define('DB_PASSWORD', '1234');

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

// DEBUG allows for displaying and logging errors
define('DEBUG', true);
