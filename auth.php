<?php
/**
 * DDForum user authentication screen
 *
 * Handles user register, user login and retrieve password
 *
 * @package DDForum
 */

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once(DDFPATH . 'startup.php');


if ( isset( $_GET['action'] ) ) {
  $action = $_GET['action'];
}
else {
  $action = 'login';
}

switch ( $action ) {
  case 'login':
    include 'inc/login.php';
    break;

  case 'logout':
    include 'inc/logout.php';
    break;

  case 'register':
    include 'inc/register.php';
    break;

  case 'retrieve-password':
    include 'inc/retrieve-password.php';
    break;

  default:
    include 'inc/login.php';
    break;
}
