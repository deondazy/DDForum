<?php

use DDForum\Core\UserAuth;
use DDForum\Core\Util;
use DDForum\Core\Site;

if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once DDFPATH.'startup.php';

$userAuth = new DDForum\Core\UserAuth($user);
$userAuth->logout();
Util::redirect(Site::url());
