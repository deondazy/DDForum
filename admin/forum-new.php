<?php

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$title = 'New Forum';
$file = 'forum-new.php';
$parent = 'forum-edit.php';

require_once( ABSPATH . 'admin/admin-header.php' );

include( ABSPATH . 'admin/inc/forum-form.php' );
include( ABSPATH . 'admin/admin-footer.php' );
