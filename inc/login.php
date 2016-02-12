<?php
/**
 * Loging in.
 */

// Can't be accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access denied' );
}

$title = 'Login - ' . get_option( 'site_name' );

$logout = ( isset( $_GET['logout'] ) && $_GET['logout'] == true ) ? true : false;

// Check if form is submitted
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	// Clean user's input
	$username = clean_input( $_POST['uname'] );
	$password = clean_input( $_POST['pass'] );

	$remember = ( isset($_POST['remember']) ) ? true : false;
	
	$ddf_user->login( $username, $password, $remember );
}

require_once( ABSPATH . 'header.php' );
?>

<div class="container">
	<div class="form-wrap">

		<?php 
		if ( $logout ) {
			show_message('You have logged out');
		}
		elseif ( is_logged() && !$logout ) { 
			show_message('You are already logged in', true); 
		}
		?>

		<h2 class="page-title">Login To <?php echo get_option( 'site_name' ); ?></h2>

		<form role="form" action="" method="post" class="action-form form-inline">

			<h4 class="area-head">Enter your Username and Password below to login</h4>
			
			<div class="form-groups">
				<div class="form-group">
					<label for="login-uname">Username</label>
					<input id="login-uname" class="form-control" type="text" name="uname">
				</div>
				
				<div class="form-group">
					<label for="login-pass">Password</label>
					<input id="login-pass" class="form-control" type="password" name="pass">
				</div>

				<div class="form-group">
					<label for="login-remember">
						<input id="login-remember" class="checkbox-input" type="checkbox"> Remember me
					</label>
				</div>

				<input id="login-submit" class="action-button" type="submit" value="login">
			</div>
		</form>
	</div>
</div>
