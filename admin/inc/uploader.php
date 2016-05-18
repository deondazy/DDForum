<?php

$title = 'General Settings';

/** Load DDForum Startup **/
require_once( dirname( dirname( dirname( __FILE__ ) ) ) . '/startup.php' );

require_once( DDFPATH . 'admin/admin-header.php' );

$upload_dir 	= 	DDFPATH . 'inc/avatar/';
$upload_file 	= 	$upload_dir . basename($_POST['avatar']);

foreach ($_FILES["avatar"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
    $name = $_FILES["avatar"]["name"][$key];
    move_uploaded_file( $_FILES["avatar"]["tmp_name"][$key], $upload_dir . $_FILES['avatar']['name'][$key]);
  }
}

echo "<h2>Successfully Uploaded Images</h2>";
