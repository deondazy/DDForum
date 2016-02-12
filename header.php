<?php
/**
 * DDForum Front-end header
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo isset( $title ) ? $title : 'DDForum'; ?></title>

		<meta charset="utf8">
		<meta content="width=device-width, initial-scale=1" name="viewport">

		<link rel="stylesheet" href="<?php echo home_url() . '/inc/css/bootstrap.css'; ?>">
		<link rel="stylesheet" href="<?php echo home_url() . '/inc/css/style.css'; ?>">

		<script src="<?php echo home_url() . '/inc/js/jquery.js'; ?>"></script>
		<script src="<?php echo home_url() . '/inc/js/tinymce/js/tinymce/tinymce.js' ?>"></script>
		<script src="<?php echo home_url() . '/inc/js/editor.js' ?>"></script>
	</head>

	<body>
		
		<header id="site-header">
			<div class="container">
				<div class="masthead">
					<h1><a rel="home" href="<?php echo home_url(); ?>"><?php echo get_option( 'site_name' ); ?></a></h1>

					<nav class="navigation clearfix">
						<ul class="main-navigation">

							<?php if ( is_logged() ) : ?>
								Hello <strong><?php $ddf_user->get_user( 'display_name', 'current_user' ); ?>:</strong> &bull; 
								<li class="nav-link"><a href="#">Edit Profile(user)</a></li> &bull; 
								<li class="nav-link"><a href="auth.php?action=logout">Logout</a></li> &bull; 
							<?php else : ?>
								Hello <strong>Guest:</strong>
								<li class="nav-link"><a href="auth.php?action=register"><b>Register</b></a></li> &bull; 
								<li class="nav-link"><a href="auth.php">Login</a></li> &bull; 
							<?php endif; ?>
						</ul>
					</nav>

					<div class="site-search">
						<form method="get" action="search.php">
							<input type="text" name="s">
							<input type="submit" value="search">
						</form>
					</div>
				</div>
			</div>
		</header>

		<div class="content">
