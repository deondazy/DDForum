<?php

/** Load DDForum Startup **/
require_once( dirname( dirname( __FILE__ ) ) . '/startup.php' );

// Check login
if ( ! is_logged() ) {
  redirect( home_url() . '/auth.php' );
}

// Check level
if ( !is_level( 'head_admin') && !is_level( 'admin') ) {
	kill_script( 'You don\'t have the rights to access this page' );
}