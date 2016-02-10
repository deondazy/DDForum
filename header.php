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
					<h1>DDForum</h1>

					<nav class="navigation clearfix">
						<ul class="main-navigation">
							<li><a href="<?php echo home_url(); ?>">Home</a></li>

							<li><a href="cats">Other categories</a></li>
						</ul>

						<ul class="user-navigation">
							<?php if ( is_logged() ) : ?>
								<li class="user-link"><a href="auth.php?action=logout">Logout</a></li>
							<?php else : ?>
								<li class="user-link"><a href="auth.php?action=register">Register</a></li>
								<li class="user-link"><a href="auth.php">Login</a></li>
							<?php endif; ?>
						</ul>
					</nav>
				</div>
			</div>
		</header>

		<div class="content">