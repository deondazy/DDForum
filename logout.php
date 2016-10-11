<?php

use DDForum\Core\UserAuth;
use DDForum\Core\Util;
use DDForum\Core\Site;

if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once(DDFPATH . 'startup.php');

if (UserAuth::logout()) {
    Util::redirect(Site::url());
} else {
    Site::info("Unable to log you out, try again");
}
