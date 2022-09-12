<?php

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
}

$title = 'New Topic';
$file = 'topic-new.php';
$parent_menu = 'topic-edit.php';

// Load admin
require_once(DDFPATH . 'admin/admin.php');

require_once(DDFPATH . 'admin/admin-header.php');

include(DDFPATH . 'admin/inc/topic-form.php');
include(DDFPATH . 'admin/admin-footer.php');
