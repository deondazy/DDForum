<?php
/**
 * ddforum search
 *
 * @package DDForum
 * @subpackage Administrator
 */

/** Load DDForum Startup **/
require_once( dirname( __FILE__ ) . '/startup.php' );

$title = $_GET['s'] . ' - ' . get_option( 'site_name' );

require_once( ABSPATH . 'header.php' );

include( ABSPATH . 'footer.php' );
