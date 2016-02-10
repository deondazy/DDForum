<?php
/**
 * Add new forum and send to forum.php
 */

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$user_id = $user->current_userID();

if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
	$forum_name = clean_input( $_POST['forum-title'] );
	$forum_description = $_POST['forum-description'];
	$forum_type = $_POST['forum-type'];
	$forum_status = clean_input( $_POST['forum-status'] );
	$forum_visibility = clean_input( $_POST['forum-visibility'] );
	$forum_parent = clean_input( $_POST['forum-parent'] );

	if ( !empty($forum_name) ) {
		$data = array(
  		'forum_name' => $forum_name,
	  	'forum_description' => $forum_description,
	  	'forum_type' => $forum_type,
	  	'forum_status' => $forum_status,
	  	'forum_visibility' => $forum_visibility,
	  	'forum_parent' => $forum_parent,
	  	'forum_creator' => $user_id,
		);

		$insert_forum = $ddf_db->insert_data($ddf_db->forums, $data);

		if ( $ddf_db->affected_rows > 0 ) {
			redirect("forum.php?action=edit&id=$insert_forum&message=Forum created");
		}
		else {
			redirect("forum-new.php?message=Unable to create forum, try again");
		}
	}
	else {
		redirect('forum-new.php?message=Enter forum title');
	}
}
else {
	kill_script('Access Denied');
}