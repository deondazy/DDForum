<?php
/**
 * Users list
 *
 * @package DDForum
 * @subpackage Admin
 */

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

if ( !is_admin() ) {
	kill_script( 'You do not have the rights to access this page' );
}

$title = 'All Users';

$redirect_url = urlencode(admin_url('user-edit.php'));

require_once( ABSPATH . 'admin/admin-header.php' );

$message = isset( $_GET['message'] ) ? $_GET['message'] : '';
show_message($message);

$users = $ddf_db->fetch_all($ddf_db->users);

// Pagination
$all_record = $ddf_db->row_count;
$limit = 5;
		
$current = isset( $_GET['page'] ) ? $_GET['page'] : 1;
$first = ( $all_record - $all_record ) + 1;
$last = ceil( $all_record / $limit );
$prev = ( $current - 1 < $first ) ? $first : $current - 1;
$next = ( $current + 1 > $last ) ? $last : $current + 1;
		
$offset = isset( $_GET['page'] ) ? $limit * ( $current - 1 ) : 0;

$users = $ddf_db->fetch_all($ddf_db->users, "*", '', '', $limit, $offset);
?>
<a href="user-new.php" class="extra-nav">Add New User</a>

<?php if ( $all_record > 5 ) : ?> 
	<form action="" method="get">
		<div class="paginate">
	
			<a class="first-page <?php echo ( $current == $first ) ? 'disabled' : ''; ?>" href="?page=<?php echo $first; ?>">First</a>
			<a class="prev-page <?php echo ( $current == $prev ) ? 'disabled' : ''; ?>" href="?page=<?php echo $prev; ?>">Prev</a>

			<input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>

			<a class="next-page <?php echo ( $current == $next ) ? 'disabled' : ''; ?>" href="?page=<?php echo $next; ?>">Next</a>
			<a class="last-page <?php echo ( $current == $last ) ? 'disabled' : ''; ?>" href="?page=<?php echo $last; ?>">Last</a>
		
		</div>
	</form>
<?php endif; ?>

<table class="manage-item-list">
	<thead>
		<tr>
		<!--	<th scope="col" class="checker"><input id="select-all-1" type="checkbox"></th> -->
			<th scope="col">Username</th>
			<th scope="col">Display Name</th>
			<th scope="col">Email</th>
			<th scope="col">Level</th>
			<th scope="col">Posts</th>
			<th class="action-col" scope="col">Actions</th>
		</tr>
	</thead>

	<tbody>		
		
		<?php if ( ! $users ) : ?>
			<tr>
				<td colspan="10">Nothing to display</td>
			</tr>
		
		<?php else : ?>

			<?php foreach ($users as $user) : ?>

				<tr id="entry-<?php echo $user->userID; ?>">
					<!--<th scope="row" class="checker">
						<label class="screen-reader-text" for="item-select-<?php echo $forum->forumID; ?>">Select <?php echo $forum->forum_name; ?></label>
						<input id="item-select-<?php echo $forum->forumID; ?>" type="checkbox"></td>-->

					<td>
						<strong>
							<?php  if ( (int) $user->userID == (int) $ddf_user->current_userID() ) : ?>
								<a href="profile.php">
							<?php else : ?>
								<a href="user.php?action=edit&amp;id=<?php echo $user->userID; ?>">
							<?php endif; ?>
								<?php echo $user->username; ?>
							</a>
						</strong>
					</td>

					<td><?php echo $user->display_name; ?></td>

					<td><?php echo $user->email; ?></td>

					<td><?php echo get_level($user->userID); ?></td>

					<td  class="count-column"><?php echo $ddf_user->user_posts( $user->userID ); ?></td>

					<td class="actions">
						<a class="action-edit" href="user.php?action=edit&amp;id=<?php echo $user->userID; ?>"><span class="genericon genericon-edit"></span></a>
						
						<a class="action-view" href="<?php echo home_url(); ?>/user.php?id=<?php echo $user->userID; ?>"><span class="genericon genericon-show"></span></a>
						
						<a class="action-delete" href="user.php?action=delete&amp;id=<?php echo $user->userID; ?>"><span class="genericon genericon-close"></span></a>
					</td>
				</tr>

			<?php endforeach; ?>
		
		<?php endif; ?>
		
	</tbody>

	<tfoot>
		<tr>
			<th scope="col">Username</th>
			<th scope="col">Display Name</th>
			<th scope="col">Email</th>
			<th scope="col">Level</th>
			<th scope="col">Posts</th>
			<th class="action-col" scope="col">Actions</th>
		</tr>
	</tfoot>
	
</table>

<?php if ( $all_record > 5 ) : ?> 
	<form action="" method="get">
		<div class="paginate">
	
			<a class="first-page <?php echo ( $current == $first ) ? 'disabled' : ''; ?>" href="?page=<?php echo $first; ?>">First</a>
			<a class="prev-page <?php echo ( $current == $prev ) ? 'disabled' : ''; ?>" href="?page=<?php echo $prev; ?>">Prev</a>

			<input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>

			<a class="next-page <?php echo ( $current == $next ) ? 'disabled' : ''; ?>" href="?page=<?php echo $next; ?>">Next</a>
			<a class="last-page <?php echo ( $current == $last ) ? 'disabled' : ''; ?>" href="?page=<?php echo $last; ?>">Last</a>
		
		</div>
	</form>
<?php endif; ?>

<?php

include( ABSPATH . 'admin/admin-footer.php' );
?>