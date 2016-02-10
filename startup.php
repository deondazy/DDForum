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

// Check PHP version
$phpversion_required = '5.4';
$phpversion_installed = phpversion();

if ( $phpversion_installed < $phpversion_required ) {
	die("PHP $phpversion_required is required to run this script");
}

define( 'ABSPATH', dirname(__FILE__) . '/' ); // absolute path

// Load functions
require_once( ABSPATH . '/inc/functions.php' );

if ( file_exists( ABSPATH . 'config.php' ) ) {

	/** The config file exists load it */
	require_once( ABSPATH . 'config.php' );

} else {

	/** No config file, so we gonna create it */

	// Path to install.php file
	$create_config = guess_url() . '/admin/install.php';

	// Redirect to install.php
	if ( false === strpos( $_SERVER['REQUEST_URI'], 'install' ) ) {
		header( 'Location: ' . $create_config );
		exit;
	}
}

/* Load and connect to database */
include_once ABSPATH . 'inc/class-ddf-db.php';

load_db();

is_installed();

include_once ABSPATH . 'inc/class-ddf-users.php';
