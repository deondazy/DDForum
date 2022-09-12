<?php

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
}

$title = 'Add Reply';
$file = 'reply-new.php';
$parent_menu = 'reply-edit.php';

// Load admin
require_once(DDFPATH . 'admin/admin.php');

require_once(DDFPATH . 'admin/admin-header.php');

include(DDFPATH . 'admin/inc/reply-form.php');
include(DDFPATH . 'admin/admin-footer.php');
