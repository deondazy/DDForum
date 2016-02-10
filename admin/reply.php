<?php

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$title = 'Edit Reply';
$parent = 'reply-edit.php';
$file = 'reply-edit.php';

$reply_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$forum_id = isset( $_GET['forum'] ) ? (int) $_GET['forum'] : 0;
$topic_id = isset( $_GET['topic'] ) ? (int) $_GET['topic'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';
$user_id = $user->current_userID();

switch ($action) {
	case 'edit':

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			$reply_message = $_POST['reply-message'];
			$reply_topic = clean_input($_POST['reply-topic']);
			$forum_id = $ddf_db->get_topic('forumID', $reply_topic);

			if ( !empty($reply_message) ) {

				$data = array(
				  'topicID' => $reply_topic,
				  'forumID' => $forum_id,
				  'reply_message' => $reply_message,
				  'reply_poster' => $user_id,
				  'reply_date' => 'now()',
				);
			}
			else {
				$message = 'Enter reply message';
			}

			$update_reply = $ddf_db->update_data($ddf_db->replies, $data, "replyID='$reply_id'");

			if ( $ddf_db->affected_rows > 0 ) {
				
				$count_topic_replies = $ddf_db->query("SELECT `replyID` FROM $ddf_db->replies WHERE `topicID` = '$reply_topic'" );

				$ddf_db->update_data( $ddf_db->topics, array('topic_replies' => $ddf_db->row_count), "topicID='$reply_topic'" );

				$count_forum_replies = $ddf_db->query("SELECT `replyID` FROM $ddf_db->replies WHERE `forumID` = '$forum_id'" );

				$ddf_db->update_data( $ddf_db->forums, array('forum_replies' => $ddf_db->row_count), "forumID='$forum_id'" );

				$count_user_replies = $ddf_db->query("SELECT `replyID` FROM $ddf_db->replies WHERE `reply_poster` = '$user_id'" );
				$count_user_replies = $ddf_db->fetch_object($count_user_replies);

				$ddf_db->update_data( $ddf_db->users, array('reply_count' => $ddf_db->row_count), "userID='$user_id'" );

				$message = 'Reply Updated';
			}
			else {
				$message = 'Unable to update reply, try again';
			}
		}
						
		break;

	case 'delete':
		$delete_reply = $ddf_db->delete_data( 'replies', "replyID='$reply_id'");

		if ( $ddf_db->affected_rows > 0 ) {

			$count_topic_replies = $ddf_db->query("SELECT `replyID` FROM `replies` WHERE `topicID` = '$topic_id'" );

			$ddf_db->update_data( "topics", array('topic_replies' => $ddf_db->row_count), "topicID='$topic_id'" );

			$count_forum_replies = $ddf_db->query("SELECT `replyID` FROM `replies` WHERE `forumID` = '$forum_id'" );

			$ddf_db->update_data( "forums", array('forum_replies' => $ddf_db->row_count), "forumID='$forum_id'" );

			$count_user_replies = $ddf_db->query("SELECT `replyID` FROM `replies` WHERE `reply_poster` = '$user_id'" );
			$count_user_replies = $ddf_db->fetch_object($count_user_replies);

			$ddf_db->update_data( "users", array('reply_count' => $ddf_db->row_count), "userID='$user_id'" );
				
			redirect("reply-edit.php?message=Reply Deleted");
		}
		else {
				redirect("reply-edit.php?message=Unable to delete reply, try again");
		}
		
		break;
				
	default:
		kill_script( 'Unknown action' );
		
		break;
}

include( ABSPATH . 'admin/inc/reply-form.php' );
include( ABSPATH . 'admin/admin-footer.php' );
