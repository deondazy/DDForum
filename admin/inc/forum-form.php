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

$forum_id = isset( $forum_id ) ? $forum_id : 0;

$forum_query = $ddf_db->fetch_all( $ddf_db->forums, "*", "forumID='$forum_id'" );

if ( $forum_query ) {

	foreach ( $forum_query as $forum ) {
		$forum_name = $forum->forum_name;
		$forum_description = $forum->forum_description;
		$forum_type = $forum->forum_type;
		$forum_status = $forum->forum_status;
		$forum_visibility = $forum->forum_visibility;
		$forum_parent = $forum->forum_parent;
	}
}

$forum_name = ( !empty($forum_name) ) ? $forum_name : '';
$forum_description = ( !empty($forum_description) ) ? $forum_description : '';
$forum_type = ( !empty($forum_type) ) ? $forum_type : '';
$forum_status = ( !empty($forum_status) ) ? $forum_status : '';
$forum_visibility = ( !empty($forum_visibility) ) ? $forum_visibility : '';
$forum_parent = ( !empty($forum_id) ) ? $forum_parent : '';

require_once( ABSPATH . 'admin/admin-header.php' );

if ( isset( $message ) ) {
	show_message( $message ) ;
}
elseif ( isset( $_GET['message'] ) ) {
	show_message( $_GET['message'] );
}
?>

<form action="<?php echo ($forum_id == 0) ? 'add-forum.php' : 'forum.php?action=edit&id=' . $forum_id; ?>" method="post">
	
	<div class="form-wrap-main">

		<p>
			<span class="label">Forum Name</span>
			<label class="screen-reader-text" for="forum-title">Forum Name</label>
			<input type="text" id="forum-title" class="title-box" name="forum-title" value="<?php echo $forum_name; ?>">
		</p>

		<p>
			<label class="screen-reader-text" for="form-box"></label>
			<textarea class="forum-description" id="form-box" name="forum-description"><?php echo $forum_description; ?></textarea>
		</p>

	</div>

	<div class="form-wrap-side">
		
		<div class="head">Forum Settings</div>

		<div class="content">
			<p>
				<span class="label">Type</span>
				<label class="screen-reader-text" for="forum-type">Forum Type</label>
				<select id="forum-type" class="select-box" name="forum-type">
					<?php
					$type = array('forum' => 'forum', 'category' => 'category');
					$type = array_map( "trim", $type );

					foreach ( $type as $id => $item ) : ?>
						<option value="<?php echo $item ?>" <?php selected( $forum_type, $item ); ?>>
							<?php echo ucfirst($item); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<span class="label">Status</span>
				<label class="screen-reader-text" for="forum-status">Forum Status</label>
				<select id="forum-status" class="select-box" name="forum-status">
					<?php
					$status = array('open' => 'open', 'locked' => 'locked');
					$status = array_map( "trim", $status );

					foreach ( $status as $id => $item ) : ?>
						<option value="<?php echo $item ?>" <?php selected( $forum_status, $item ); ?>>
							<?php echo ucfirst($item); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<span class="label">Visibility</span>
				<label class="screen-reader-text" for="forum-status">Forum Visibility</label>
				<select id="forum-visibility" class="select-box" name="forum-visibility">
					<?php
					$visibility = array('public' => 'public', 'private' => 'private', 'hidden' => 'hidden');
					$visibility = array_map( "trim", $visibility );

					foreach ( $visibility as $id => $item ) : ?>
						<option value="<?php echo $item ?>" <?php selected( $forum_visibility, $item ); ?>>
							<?php echo ucfirst($item); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<span class="label">Parent</span>
				<label class="screen-reader-text" for="forum-status">Forum Parent</label>
				<?php $all_forum = $ddf_db->fetch_all( $ddf_db->forums, "forumID, forum_name, forum_parent"); ?>

				<select id="forum-parent" class="select-box" name="forum-parent">

					<?php
					foreach ( $all_forum as $parents ) {
						$parent_data[0] = 'None';
						$parent_data[$parents->forumID] = $parents->forum_name;
					}

					// Remove current forum from parent list
					if ( $forum_id != 0 ) {
						unset( $parent_data[$forum_id] );
					}

					foreach ( $parent_data as $id => $item ) : ?>

						<option value="<?php echo $id; ?>" <?php selected( $forum_parent, $id ); ?>><?php echo $item; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<input type="submit" class="primary-button" value="<?php echo isset($action) ? 'Update' : 'Create'; ?>">
	</div>
</form>