<?php

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$title = 'Add Reply';
$file = 'reply-new.php';
$parent = 'reply-edit.php';

require_once( ABSPATH . 'admin/admin-header.php' );

include( ABSPATH . 'admin/inc/reply-form.php' );
include( ABSPATH . 'admin/admin-footer.php' );
