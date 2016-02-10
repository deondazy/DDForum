<?php
/**
 * Form for New and Edit topic Screen
 *
 * @package DDtopic
 */

// Can't be accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access denied' );
}

$reply_id = isset( $reply_id ) ? $reply_id : 0;

$reply_query = $ddf_db->fetch_all( $ddf_db->replies, "*", "replyID='$reply_id'" );

if ( $reply_query ) {

	foreach ( $reply_query as $reply ) {
		$reply_message = $reply->reply_message;
		$reply_topic = $reply->topicID;
		$reply_forum = $reply->forumID;
	}
}

$reply_message = ( !empty($reply_message) ) ? $reply_message : '';
$reply_topic = ( !empty($reply_topic) ) ? $reply_topic : '';
$reply_forum = ( !empty($reply_forum) ) ? $reply_forum : '';

require_once( ABSPATH . 'admin/admin-header.php' );

if ( isset( $message ) ) {
	show_message( $message ) ;
}
elseif ( isset( $_GET['message'] ) ) {
	show_message( $_GET['message'] );
}
?>

<form action="<?php echo ($reply_id == 0) ? 'add-reply.php' : 'reply.php?action=edit&id=' . $reply_id; ?>" method="post">
	
	<div class="form-wrap-main">

		<p>
			<label class="screen-reader-text" for="form-box"></label>
			<textarea class="reply-message" id="form-box" name="reply-message"><?php echo $reply_message; ?></textarea>
		</p>

	</div>

	<div class="form-wrap-side">
		
		<div class="head">Reply Settings</div>

		<div class="content">
			<p>
				<span class="label">Topic ID</span>
				<label class="screen-reader-text" for="reply-topic">Reply Topic</label>
				
				<input class="text-box" type="text" id="reply-topic" name="reply-topic" value="<?php echo $reply_topic; ?>">

			</p>
			
		</div>
		<input type="submit" class="primary-button" value="<?php echo isset($action) ? 'Update' : 'Reply'; ?>">
	</div>
</form>