<?php

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$title = 'Edit Topic';
$parent = 'topic-edit.php';
$file = 'topic-edit.php';

$topic_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';
$user_id = $user->current_userID();

switch ($action) {
	case 'edit':

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			$topic_subject = clean_input( $_POST['topic-subject'] );
			$topic_message = $_POST['topic-message'];
			$topic_forum = clean_input( $_POST['topic-forum'] );
			$topic_status = clean_input( $_POST['topic-status'] );

			if ( !empty($topic_subject) ) {
				$data = array(
			  	'topic_subject' => $topic_subject,
			  	'topic_message' => $topic_message,
			  	'forumID' => $topic_forum,
			  	'topic_status' => $topic_status,
			  	'topic_poster' => $user_id,
			  	'topic_date' => 'now()',
				);
			}
			else {
				$message = 'Enter a subject for your topic';
			}

			$update_topic = $ddf_db->update_data($ddf_db->topics, $data, "topicID='$topic_id'");

			if ( $ddf_db->affected_rows > 0 ) {
				$count_forum_topics = $ddf_db->query("SELECT `topicID` FROM $ddf_db->topics WHERE `forumID` = '$topic_forum'" );
				$count_forum_topics = $ddf_db->fetch_object($count_forum_topics);

				
				$ddf_db->update_data( $ddf_db->forums, array('forum_topics' => $ddf_db->row_count), "forumID='$topic_forum'" );

				$count_user_topics = $ddf_db->query("SELECT `topicID` FROM $ddf_db->topics WHERE `topic_poster` = '$user_id'" );
				$count_user_topics = $ddf_db->fetch_object($count_user_topics);

				$ddf_db->update_data( $ddf_db->users, array('topic_count' => $ddf_db->row_count), "userID='$user_id'" );

				$message = 'Topic Updated';
			}
			else {
				$message = 'Unable to update topic, try again';
			}
		}
						
		break;

	case 'delete':
		$topic_forum_id = $ddf_db->get_topic('forumID', $topic_id);
		$delete_topic = $ddf_db->delete_data( $ddf_db->topics, "topicID='$topic_id'");

		if ( $delete_topic ) {
			$count_forum_topics = $ddf_db->query("SELECT `topicID` FROM $ddf_db->topics WHERE `forumID` = '$topic_forum_id'" );
			$count_forum_topics = $ddf_db->fetch_object($count_forum_topics);

			$ddf_db->update_data( $ddf_db->forums, array('forum_topics' => $ddf_db->row_count), "forumID='$topic_forum_id'" );

			$count_forum_replies = $ddf_db->query("SELECT `topic_replies` FROM $ddf_db->topics WHERE `forumID` = '$topic_forum_id'" );

			$ddf_db->update_data( $ddf_db->forums, array('forum_topics' => $ddf_db->row_count), "forumID='$topic_forum_id'" );

			$count_user_topics = $ddf_db->query("SELECT `topicID` FROM $ddf_db->topics WHERE `topic_poster` = '$user_id'" );
				$count_user_topics = $ddf_db->fetch_object($count_user_topics);

			$ddf_db->update_data( $ddf_db->users, array('topic_count' => $ddf_db->row_count), "userID='$user_id'" );

			$ddf_db->delete_data( $ddf_db->replies, "topicID='$topic_id'" );
				
				redirect("topic-edit.php?message=Topic Deleted");
			}
			else {
				redirect("topic-edit.php?message=Unable to delete topic, try again");
			}
		break;
				
	default:
		kill_script( 'Unknown action' );
		
		break;
}

include( ABSPATH . 'admin/inc/topic-form.php' );
include( ABSPATH . 'admin/admin-footer.php' );

