<?php
/**
 * Add new forum and send to forum.php
 */

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$user_id = $user->current_userID();

if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
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

		$insert_reply = $ddf_db->insert_data($ddf_db->replies, $data);

		if ( $insert_reply ) {
			$count_topic_replies = $ddf_db->query("SELECT `replyID` FROM ddf_db->replies WHERE `topicID` = '$reply_topic'" );

			$ddf_db->update_data( $ddf_db->topics, array('topic_replies' => $ddf_db->row_count), "topicID='$reply_topic'" );

			$count_forum_replies = $ddf_db->query("SELECT `replyID` FROM ddf_db->replies WHERE `forumID` = '$forum_id'" );

			$ddf_db->update_data( $ddf_db->forums, array('forum_replies' => $ddf_db->row_count), "forumID='$forum_id'" );

			$count_user_replies = $ddf_db->query("SELECT `replyID` FROM ddf_db->replies WHERE `reply_poster` = '$user_id'" );
			$count_user_replies = $ddf_db->fetch_object($count_user_replies);

			$ddf_db->update_data( "users", array('reply_count' => $ddf_db->row_count), "userID='$user_id'" );

			redirect("reply.php?action=edit&id=$insert_reply&message=Reply added");
		}
		else {
			redirect("reply-new.php?message=Unable to add reply, try again");
		}
	}
	else {
		redirect('reply-new.php?message=Enter reply message');
	}
}
else {
	kill_script('Access Denied');
}