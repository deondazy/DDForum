<?php
/**
 * Logout.
 */

// Can't be accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access denied' );
}

$logout = ( isset( $_GET['action'] ) && $_GET['action'] == 'logout' ) ? true : false;

if ( $logout ) {
	$ddf_user->logout();
	redirect("auth.php?action=login&logout=true");
}