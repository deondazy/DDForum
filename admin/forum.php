<?php

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$title = 'Edit Forum';
$parent = 'forum-edit.php';
$file = 'forum-edit.php';

$forum_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';
$user_id = $user->current_userID();

switch ($action) {
	case 'edit':

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

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
			}
			else {
				$message = 'Enter forum name';
			}

			$update_forum = $ddf_db->update_data( $ddf_db->forums, $data, "forumID='$forum_id'");

			if ( $ddf_db->affected_rows > 0 ) {
				$message = 'Forum Updated';
			}
			else {
				$message = 'Unable to update forum, try again';
			}
		}
						
		break;

	case 'delete':
		$delete_forum = $ddf_db->delete_data( $ddf_db->forums, "forumID='$forum_id'");

		if ( $ddf_db->affected_rows > 0 ) {
				redirect("forum-edit.php?message=Forum Deleted");
			}
			else {
				redirect("forum-edit.php?message=Unable to delete forum, try again");
			}
		break;
				
	default:
		kill_script( 'Unknown action' );
		
		break;
}

include( ABSPATH . 'admin/inc/forum-form.php' );
include( ABSPATH . 'admin/admin-footer.php' );
