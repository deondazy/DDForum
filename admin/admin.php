<?php

use DDForum\Core\User;
use DDForum\Core\Site;
use DDForum\Core\Util;

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(dirname(__FILE__)) . '/');
}

// Load DDForum Startup
require_once DDFPATH.'startup.php';

// Check login
if (!$user->isLogged()) {
  Util::redirect(Site::url().'/login');
}

// Check level
if (!$user->isAdmin()) {
	Site::info('You don\'t have the rights to access this page', true, true);
}
