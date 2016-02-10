<?php
/**
 * Add new topic and send to topic.php
 */

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$user_id = $user->current_userID();

if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
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

		$insert_topic = $ddf_db->insert_data($ddf_db->topics, $data);

		if ( $insert_topic ) {
			$count_forum_topics = $ddf_db->query("SELECT `topicID` FROM $ddf_db->topics WHERE `forumID` = '$topic_forum'" );
			$count_forum_topics = $ddf_db->fetch_object($count_forum_topics);

			
			$ddf_db->update_data( $ddf_db->forums, array('forum_topics' => $ddf_db->row_count), "forumID='$topic_forum'" );

			$count_user_topics = $ddf_db->query("SELECT `topicID` FROM $ddf_db->topics WHERE `topic_poster` = '$user_id'" );
			$count_user_topics = $ddf_db->fetch_object($count_user_topics);

			$ddf_db->update_data( $ddf_db->users, array('topic_count' => $ddf_db->row_count), "userID='$user_id'" );

			redirect("topic.php?action=edit&id=$insert_topic&message=Topic created");
		}
		else {
			redirect("topic-new.php?message=Unable to create topic, try again");
		}
	}
	else {
		redirect('topic-new.php?message=Enter a subject for your topic');
	}
}
else {
	kill_script('Access Denied');
}