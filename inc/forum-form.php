<?php
/**
 * Form for New and Edit Forum Screen
 *
 * @package DDForum
 */

// Can't be accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access denied' );
}

if ( $category_id == 0 && $forum_id != 0 && $topic_id == 0 ) :

	$user_id = $user->current_userID();

	if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
		$topic_subject = clean_input( $_POST['topic-subject'] );
		$topic_message = $_POST['topic-message'];
		$topic_status = is_admin() ? clean_input( $_POST['topic-status'] ) : 'open';

		if ( !empty($topic_subject) ) {
			$data = array(
		  	'topic_subject' => $topic_subject,
		  	'topic_message' => $topic_message,
		  	'forumID' => $forum_id,
		  	'topic_status' => $topic_status,
		  	'topic_poster' => $user_id,
		  	'topic_date' => 'now()',
			);

			$insert_topic = $ddf_db->insert_data($ddf_db->topics, $data);

			if ( $ddf_db->affected_rows > 0 ) {
				$count_forum_topics = $ddf_db->query("SELECT `topicID` FROM $ddf_db->topics WHERE `forumID` = '$forum_id'" );
				$count_forum_topics = $ddf_db->fetch_object($count_forum_topics);

				
				$ddf_db->update_data( $ddf_db->forums, array('forum_topics' => $ddf_db->row_count), "forumID='$forum_id'" );

				$count_user_topics = $ddf_db->query("SELECT `topicID` FROM $ddf_db->topics WHERE `topic_poster` = '$user_id'" );
				$count_user_topics = $ddf_db->fetch_object($count_user_topics);

				$ddf_db->update_data( $ddf_db->users, array('topic_count' => $ddf_db->row_count), "userID='$user_id'" );

				$msg = 'Topic created';
			}
			else {
				$msg = 'Unable to create topic, try again';
			}
		}
		else {
			$msg = 'Enter a subject for your topic';
		}
	} else { 
		// Nothing...
	}
?>

	<div class="container">

		<?php if ( isset( $msg ) ) { show_message( $msg ); } ?>

		<div class="add-form">

		<form method="post" action="" id="forum-form">

		<div class="form-title">Create new topic in "<?php echo $ddf_db->get_forum( 'forum_name', $forum_id ); ?>"</div>

			<p>
				<label for="topic-subject">Subject</label>
				<input type="text" id="topic-subject" name="topic-subject" class="text-box">
			</p>

			<p>
				<textarea class="topic-message" id="form-box" name="topic-message"></textarea>
			</p>

			<?php if ( is_admin() ) : ?>

				<p>
					<label for="forum-status">Status</label>
					<select id="topic-status" class="select-box" name="topic-status">
						<option value="open">Open</option>
						<option value="locked">Locked</option>
					</select>
				</p>

			<?php endif; ?>

			<input type="submit" class="action-btn" value="Create">
		</form>
		</div>
	</div>



<?php elseif ( $category_id == 0 && $forum_id != 0 && $topic_id != 0) : ?>

Add a reply

<?php endif; ?>