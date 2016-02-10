<?php
/**
 * ddforum index
 *
 */
?>

<!DOCTYPE html>
<html class="admin-bar">
	<head>
		<title><?php echo $title ?> &lsaquo; DDForum</title>
		<meta charset="utf8">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo home_url() . '/inc/css/bootstrap.css'; ?>">
		<?php load_admin_css(); ?>
		<link rel="stylesheet" href="<?php echo home_url() . '/inc/font/genericons.css'; ?>">

		<script src="<?php echo home_url() . '/inc/js/jquery.js'; ?>"></script>
		<script src="<?php echo home_url() . '/inc/js/tinymce/js/tinymce/tinymce.js' ?>"></script>
		<script src="<?php echo home_url() . '/inc/js/editor.js' ?>"></script>
		<script src="<?php echo admin_url('js/functions.js') ?>"></script>
		<script src="<?php echo admin_url('js/uploader.js') ?>"></script>
	</head>

	<body>
		<div class="wrap">

			<?php include ABSPATH . 'admin/inc/admin-menu.php'; ?>

			<div id="admin-content">

				<?php include ABSPATH . 'inc/admin-bar.php'; ?>

				<div id="admin-body">
			
					<header class="admin-header"><h2><?php echo $title; ?></h2></header>

					<div id="main" class="container clearfix">