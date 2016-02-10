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

$topic_id = isset( $topic_id ) ? $topic_id : 0;

$topic_query = $ddf_db->fetch_all( $ddf_db->topics, "*", "topicID='$topic_id'" );

if ( $topic_query ) {

	foreach ( $topic_query as $topic ) {
		$topic_subject = $topic->topic_subject;
		$topic_message = $topic->topic_message;
		$topic_forum = $topic->forumID;
		$topic_status = $topic->topic_status;
	}
}

$topic_subject = ( !empty($topic_subject) ) ? $topic_subject : '';
$topic_message = ( !empty($topic_message) ) ? $topic_message : '';
$topic_forum = ( !empty($topic_forum) ) ? $topic_forum : '';
$topic_status = ( !empty($topic_status) ) ? $topic_status : '';

require_once( ABSPATH . 'admin/admin-header.php' );

if ( isset( $message ) ) {
	show_message( $message ) ;
}
elseif ( isset( $_GET['message'] ) ) {
	show_message( $_GET['message'] );
}
?>

<form action="<?php echo ($topic_id == 0) ? 'add-topic.php' : 'topic.php?action=edit&id=' . $topic_id; ?>" method="post">
	
	<div class="form-wrap-main">

		<p>
			<span class="label">Subject</span>
			<label class="screen-reader-text" for="topic-subject">Topic Subject</label>
			<input type="text" id="topic-subject" class="title-box" name="topic-subject" value="<?php echo $topic_subject; ?>">
		</p>

		<p>
			<label class="screen-reader-text" for="form-box"></label>
			<textarea class="topic-message" id="form-box" name="topic-message"><?php echo $topic_message; ?></textarea>
		</p>

	</div>

	<div class="form-wrap-side">
		
		<div class="head">Topic Settings</div>

		<div class="content">
			<p>
				<span class="label">Forum</span>
				<label class="screen-reader-text" for="topic-forum">Topic Forum</label>
				
				<?php $all_forum = $ddf_db->fetch_all( $ddf_db->forums, "forumID, forum_name", "forum_type = 'forum'"); ?>

				<select id="topic-forum" class="select-box" name="topic-forum">

					<?php
					foreach ( $all_forum as $forum ) {
						$forum_data[$forum->forumID] = $forum->forum_name;
					}

					foreach ( $forum_data as $id => $item ) : ?>

						<option value="<?php echo $id; ?>" <?php selected( $topic_forum, $id ); ?>><?php echo $item; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<span class="label">Status</span>
				<label class="screen-reader-text" for="topic-status">topic Status</label>
				<select id="topic-status" class="select-box" name="topic-status">
					<?php
					$status = array('open' => 'open', 'locked' => 'locked');
					$status = array_map( "trim", $status );

					foreach ( $status as $id => $item ) : ?>
						<option value="<?php echo $item ?>" <?php selected( $topic_status, $item ); ?>>
							<?php echo ucfirst($item); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			
		</div>
		<input type="submit" class="primary-button" value="<?php echo isset($action) ? 'Update' : 'Create'; ?>">
	</div>
</form>