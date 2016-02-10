<?php

$title = 'General Settings';

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

require_once( ABSPATH . 'admin/admin-header.php' );

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$site_name = clean_input( $_POST['site-name'] );
	$site_description = clean_input( $_POST['site-description'] );
	$site_url = clean_input( $_POST['site-url'] );
	$admin_email = clean_input( $_POST['admin-email'] );
	$enable_pm = clean_input( $_POST['enable-pm'] );
	$enable_credits = clean_input( $_POST['enable-credits'] );

	$options = array( 
		'site_name' => $site_name,
		'site_description' => $site_description,
		'site_url' => $site_url,
		'admin_email' => $admin_email,
		'enable_pm' => $enable_pm,
		'enable_credits' => $enable_credits,
	);

	foreach ( $options as $option => $value ) {
		$set_option = $ddf_db->set_option( $option, $value);

		//var_dump($set_option);
	}

	if ( $set_option ) {
		show_message( 'Settings saved' );
	}
	else {
		show_message( 'Unable to save settings, try again' );
	}
}
?>

<form action="" method="post" role="form">
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="site-name">Site Name</label></th>
				<td><input id="site-name" type="text" class="text-box-lg" name="site-name" value="<?php echo get_option('site_name'); ?>"></td>
			</tr>

			<tr>
				<th scope="row"><label for="site-description">Site Description</label></th>
				<td>
					<input id="site-description" type="text" class="text-box-lg" name="site-description" value="<?php echo get_option('site_description'); ?>">
					<p class="description">Explain in summary what this site is about</p>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="site-url">Site URL</label></th>
				<td>
					<input id="site-url" type="text" class="text-box-lg" name="site-url" value="<?php echo get_option('site_url'); ?>">
					<p class="description">This URL is your homepage address, enter an absolute URL e.g: http://sitename.com</p>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="admin-email">Admin Email</label></th>
				<td>
					<input id="admin-email" type="text" class="text-box-lg" name="admin-email" value="<?php echo get_option('admin_email'); ?>">
					<p class="description">This email is where you get notifications and other emailed admin info</p>
				</td>
			</tr>

			<tr>
				<th scope="row"><label for="enable-pm">Enable PM</label></th>
				<td><select name="enable-pm" id="enable-pm" class="select-box">
					<?php $use_pm = array( 'No', 'Yes' );
					foreach ( $use_pm as $id => $item ) : ?>
						<option value="<?php echo $id; ?>" <?php selected( get_option( 'enable_pm' ), $id ); ?>><?php echo $item; ?></option>
					<?php endforeach; ?>
				</select></td>
			</tr>

			<tr>
				<th scope="row"><label for="enable-credits">Enable Credits</label></th>
				<td><select name="enable-credits" id="enable-credits" class="select-box">
					<?php $use_credits = array( 'No', 'Yes' );
					foreach ( $use_credits as $id => $item ) : ?>
						<option value="<?php echo $id; ?>" <?php selected( get_option( 'enable_credits' ), $id ); ?>><?php echo $item; ?></option>
					<?php endforeach; ?>
				</select></td>
			</tr>
		</tbody>
	</table>
	<p><input id="submit" name="submit" class="primary-button" type="submit" value="Save Settings">
</form>