<?php
/**
 * Loging in.
 */

// Can't be accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access denied' );
}

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

		<h1 class="page-title">Login</h1>
		<form action="" method="post" class="action-form">
			<p class="form-control">
				<label for="login-uname">Username</label>
				<input id="login-uname" class="box-input" type="text" name="uname">
			</p>
			<p class="form-control">
				<label for="login-pass">Password</label>
				<input id="login-pass" class="box-input" type="password" name="pass">
			</p>
			<p class="form-control">
				<label for="login-remember">
					<input id="login-remember" class="checkbox-input" type="checkbox"> Remember me
				</label>
			</p>
			<p class="form-control">
				<input id="login-submit" class="action-button" type="submit" value="login">
			</p>
		</form>
	</div>
</div>
