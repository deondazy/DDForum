<?php
/**
 * Form for New and Edit User Screen
 *
 * @package DDtopic
 */

// Can't be accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access denied' );
}

if ( CURRENT_PROFILE ) {
	$form_action = 'profile.php';
	$redirect_url = admin_url( 'profile.php' );
}
else if ( EDIT_PROFILE && $user_id != 0 ) {
	$form_action = 'user.php?action=edit&id=' . $user_id;
	$redirect_url = admin_url( 'user.php?action=edit&id=' . $user_id );
}

require_once( ABSPATH . 'admin/admin-header.php' );

if ( isset( $message ) ) {
	show_message( $message ) ;
}
elseif ( isset( $_GET['message'] ) ) {
	show_message( $_GET['message'] );
}

if ( isset( $msg ) ) {
	show_message( $msg ) ;
}

function user_data( $data ) {
	global $ddf_user, $user_id;

	return $ddf_user->get_user( $data, $user_id );
}
?>

<div class="profile-summary clearfix row">
	<div class="col-lg-4 col-sm-4">
		<div class="profile-avatar pull-left"><?php  echo $ddf_user->get_dp( $user_id ); ?></div>
		
		<div class="user-info pull-left">
			<div class="display-name"><?php echo user_data( 'display_name' ); ?></div>
			
			<div class="gender-age">
				<span class="gender"><?php echo ucfirst( user_data( 'gender' ) ); ?></span>
				<span class="user-age">(<?php echo user_data( 'age' ); ?>)</span>
			</div>

			<div class="online-status">
				<?php if ( user_data( 'status' ) == 1 && user_data( 'online_status') == 1 ) : ?>
					Online
				<?php elseif ( user_data( 'status' ) == 1 && user_data( 'online_status') == 0 ) : ?>
					Last seen <?php echo user_data( 'last_seen' ); ?>
				<?php elseif ( user_data( 'status' ) == 0 ) : ?>
					Banned
				<?php elseif ( user_data( 'status' ) == 2 ) : ?>
					Pending activation
				<?php endif; ?>
			</div>

			<div class="user-level"><?php echo get_level( $user_id ); ?></div>
		</div>
	</div>

	<div class="col-lg-4 col-sm-4">
		<div class="register-date">Member since: <?php echo user_data( 'register_date' ); ?></div>
		<div class="topic-count"><?php echo user_data( 'topic_count' ); ?> Topics</div>
		<div class="reply-count"><?php echo user_data( 'reply_count' ); ?> Replies</div>
		<div class="credits"><?php echo user_data( 'credit' ); ?> Credits</div>
	</div>

	<?php if ( !CURRENT_PROFILE ) : ?>
		<div class="col-lg-4 col-sm-4">
			<?php if ( user_data( 'use_pm' ) ) : ?>
				<div class="send-pm">Send PM</div>
			<?php endif; ?>

			<div class="send-email"><a rel="nofollow" href="mailto:<?php echo user_data( 'email' ); ?>">Send Email</a></div>
			
			<?php if ( !empty( user_data( 'facebook' ) ) ) : ?>
				<div class="facebook"><a rel="nofollow" href="<?php echo user_data( 'facebook' ); ?>">Facebook</a></div>
			<?php endif; ?>

			<?php if ( !empty( user_data( 'twitter' ) ) ) : ?>
				<div class="twitter"><a rel="nofollow" href="<?php echo user_data( 'twitter' ); ?>">Twitter</a></div>
			<?php endif; ?>

			<?php if ( !empty( user_data( 'website_url' ) ) ) : ?>
				<div class="website"><a rel="nofollow" href="<?php echo user_data( 'website_url' ); ?>"><?php echo !empty(user_data('website_title')) ? user_data('website_title') : user_data('website_url'); ?></a></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="col-lg-4 col-sm-4"></div>
</div>

<form enctype="multipart/form-data" action="<?php echo $form_action; ?>" method="post" role="form">

	<div class="form-wrap-main">

		<?php if ( is_admin() ) : ?>

			<h3>Admin Tools</h3>

			<table class="form-table">
				<tbody>

					<?php if ( !CURRENT_PROFILE ) : ?>
						<tr>
							<th scope="row"><label for="status">Status</label></th>
							<td><select name="status" id="status" class="select-box">
								<?php
								$status = array('Banned', 'Active', 'Pending Activation');

								$status = array_map( "trim", $status );

								foreach ( $status as $id => $item ) : ?>

									<option value="<?php echo $id; ?>" <?php selected( user_data( 'status' ), $id ); ?>><?php echo $item; ?></option>

								<?php endforeach; ?>

							</select></td>

						</tr>


						<?php if ( is_level( 'head_admin' ) ) : ?>
							<tr>
								<th scope="row"><label for="level">Level</label></th>
								<td><select class="select-box" name="level" id="level">
									<?php
									$level = array(
										2 => 'Admin',
										3 => 'Moderator',
										0 => 'User',
									);

									$level = array_map( "trim", $level );
									$level = array_unique( $level );

									foreach ( $level as $id => $item ) : ?>

										<option <?php selected( user_data( 'level' ), $id ); ?>><?php echo $item; ?></option>

									<?php endforeach; ?>

								</select></td>

							</tr>
						<?php endif; ?>
					<?php endif; ?>

					<tr>
						<th scope="row"><label for="credit">Credit</label></th>
						<td><input name="credit" type="number" id="credit" value="<?php echo user_data( 'credit' ); ?>" min="0" class="select-box"></td>
					</tr>
				</tbody>
			</table>

		<?php endif; ?>

		<h3>Options</h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="online-status">Online Status</label></th>
					<td>
						<select name="online-status" id="online-status">
							<option>Online</option>
							<option>Offline</option>
						</select>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="use-pm">Use PM</label></th>
					<td><select name="use-pm" id="use-pm" class="select-box">
						<?php $use_pm = array( 'No', 'Yes' );

						foreach ( $use_pm as $id => $item ) : ?>

							<option value="<?php echo $id; ?>" <?php selected( user_data( 'use_pm' ), $id ); ?>><?php echo $item; ?></option>

						<?php endforeach; ?>

					</select></td>

				</tr>
			</tbody>
		</table>


		<h3>Name</h3>

		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="uname">Username</label></th>
					<td><input id="uname" class="text-box-lg" type="text" value="<?php echo user_data( 'username' ); ?>" disabled></td>
				</tr>

				<tr>
					<th scope="row"><label for="fname">First Name</label></th>
					<td><input class="text-box-lg" type="text" value="<?php echo user_data( 'first_name' ); ?>" name="fname" id="fname"></td>
				</tr>

				<tr>
					<th scope="row"><label for="lname">Last Name</label></th>
					<td><input class="text-box-lg" type="text" value="<?php echo user_data( 'last_name' ); ?>" name="lname" id="lname"></td>
				</tr>

				<tr>
					<th scope="row"><label for="dname">Display Name</label></th>
					<td><select class="select-box" name="dname" id="dname">

						<?php
						$display_name = array();
						$display_name['username'] = user_data( 'username' );

						if ( !empty(user_data( 'first_name' )) )
							$display_name['first_name'] = user_data( 'first_name' );

						if ( !empty(user_data( 'last_name' )) )
							$display_name['last_name'] = user_data( 'last_name' );

						if ( !empty(user_data( 'first_name' )) && !empty(user_data( 'last_name' )) ) {
							$display_name['first_last'] = user_data( 'first_name' ) . ' ' .user_data( 'last_name' );
							$display_name['last_first'] = user_data( 'last_name' ) . ' ' .user_data( 'first_name' );
						}

						if ( !in_array(user_data( 'display_name' ), $display_name) )
							$display_name = array( 'displayname' => user_data( 'display_name' ) ) + $display_name;

						$display_name = array_map( "trim", $display_name );
						$display_name = array_unique( $display_name );

						foreach ( $display_name as $id => $item ) : ?>

							<option <?php selected( user_data( 'display_name' ), $item ); ?>><?php echo $item; ?></option>

						<?php endforeach; ?>

					</select></td>
				</tr>
			</tbody>
		</table>

		<h3>Contact Info</h3>

		<table class="form-table">

			<tr>
				<th scope="row"><label for="country">Country</label></th>
				<td>
					<?php echo json_item_select( ABSPATH . 'inc/country.json', user_data( 'country' ), 'country', 'country' ); ?>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="state">State</label></th>
				<td>
					<input class="text-box-lg" type="text" value="<?php echo user_data( 'state' ); ?>" name="state" id="state">
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="city">City</label></th>
				<td>
					<input class="text-box-lg" type="text" value="<?php echo user_data( 'city' ); ?>" name="city" id="city">
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="email">Email</label></th>
				<td><input placeholder="name@example.com" class="text-box-lg" type="email" value="<?php echo user_data( 'email' ); ?>" name="email" id="email"></td>
			</tr>

			<tr>
				<th scope="row"><label for="mobile">Mobile</label></th>
				<td><input class="text-box-lg" type="text" value="<?php echo user_data( 'mobile' ); ?>" name="mobile" id="mobile"></td>
			</tr>

			<tr>
				<th scope="row"><label for="website-title">Website Title</label></th>
				<td>
					<input placeholder="<?php echo get_option( 'site_name' ); ?>" class="text-box-lg" type="text" value="<?php echo user_data( 'website_title' ); ?>" name="website-title" id="website-title">
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="website-url">Website URL</label></th>
				<td>
					<input placeholder="<?php echo home_url(); ?>" class="text-box-lg" type="url" value="<?php echo user_data( 'website_url' ); ?>" name="website-url" id="website-url">
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="facebook">Facebook</label></th>
				<td><input placeholder="http://facebook.com/username" class="text-box-lg" type="url" value="<?php echo user_data( 'facebook' ); ?>" name="facebook" id="facebook"></td>
			</tr>

			<tr>
				<th scope="row"><label for="twitter">Twitter</label></th>
				<td><input placeholder="http://twitter.com/username" class="text-box-lg" type="url" value="<?php echo user_data( 'twitter' ); ?>" name="twitter" id="twitter"></td>
			</tr>
		</table>

		<h3>About Yourself</h3>

		<table class="form-table">

			<tr>
				<th scope="row"><label for="gender">Gender</label></th>
				<td><select class="select-box" name="gender" id="gender">

						<?php
						$gender = array('male' => 'Male', 'female' => 'Female');

						foreach ( $gender as $id => $item ) : ?>

							<option <?php selected( user_data( 'gender' ), $id ); ?>><?php echo $item; ?></option>

						<?php endforeach; ?>

					</select></td>
			</tr>

			<tr>
				<th scope="row"><label for="byear">Birthday</label></th>
				<td><?php echo date_select( user_data( 'birth_day' ), user_data( 'birth_month' ), user_data( 'birth_year' ) ); ?></td>
			</tr>

			<tr>
				<th scope="row"><label for="bio">Biography</label></th>
				<td><textarea class="textarea-box" id="bio" name="bio"><?php echo user_data( 'biography' ); ?></textarea></td>
			</tr>

			<tr>
				<th scope="row"><label for="user-avatar">Avatar</label></th>
				<td>
					<input type="hidden" name="MAX_FILE_SIZE" value="‪5242880‬">
					<div id="show-avatar"><?php echo $ddf_user->get_dp( $user_id ) ?></div>
					<div id="response"></div>
					<input id="user-avatar" name="avatar" type="file">
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="pass">Change Password</label></th>
				<td><input class="text-box-lg" type="password" name="pass" id="pass"></td>
			</tr>

			<tr>
				<th scope="row"><label for="cpass">Confirm Password</label></th>
				<td><input class="text-box-lg" type="password" name="cpass" id="cpass"></td>
			</tr>
		</table>

		<p><input class="primary-button" type="submit" value="Update" name="submit"></p>

	</div>

</form>