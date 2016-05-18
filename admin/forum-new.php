<?php

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
}

$title = 'New Forum';
$file = 'forum-new.php';
$parent_menu = 'forum-edit.php';

// Load admin
require_once(DDFPATH . 'admin/admin.php');

require_once(DDFPATH . 'admin/admin-header.php');

include(DDFPATH . 'admin/inc/forum-form.php');
include(DDFPATH . 'admin/admin-footer.php');
