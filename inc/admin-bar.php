<?php

use DDForum\Core\Site;

// Can't be accessed directly
if ( !defined( 'DDFPATH' ) ) {
	die( 'Direct access denied' );
}
?>

<nav id="admin-bar">
	<div class="container">

		<div id="admin-bar-nav" class="cf">
			<div class="admin-bar-ddf-logo float-left">
				<img src="images/ddforum-logo.png" id="ddf-logo" alt="DDForum Logo">
			</div>

			<div class="admin-bar-tools float-right">
				<ul class="cf">
					<li class="add"><i class="fa fa-plus"></i>
						<ul>
							<li>Forum</li>
							<li>Topic</li>
							<li>Reply</li>
							<li>Page</li>
							<li>User</li>
						</ul>
					</li>

					<li class="msg">
						<a href="message"><i class="fa fa-envelope"></i></li>

					<li class="notif"><i class="fa fa-info"></i></li>

					<li class="logout">
						<a href="<?php echo Site::url(); ?>/auth.php?action=logout"><i class="fa fa-power-off"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
