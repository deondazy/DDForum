<?php

// Can't be accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access denied' );
}
?>

<div id="admin-bar">
	<div class="container">
		
		<div id="admin-bar-nav" class="cf">
			<ul class="admin-bar-tools float-left">
				<li class="admin-bar-ddf-logo"><img src="images/ddforum.png" height="35" width="120" id="ddf-logo" class="float-left" alt="DDForum Logo"></li>
				<li>Add</li>
				<li>Messages</li>
				<li>Notifications</li>
			</ul>

			<div class="admin-bar-user float-right">
				<a href="<?php echo home_url(); ?>/auth.php?action=logout">Logout</a>
			</div>
		</div>
	</div>
</div>