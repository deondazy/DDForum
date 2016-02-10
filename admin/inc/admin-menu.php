<?php
/**
 * DDForum Administration Panel Menu
 *
 * @package DDForum
 * @subpackage Admin
 */

/**
 * Admin Menu array
 *
 * 0: Name of the menu item
 * 1: Filename of the menu item
 * 2: Class(es) of the menu items
 * 3: Icon for the menu item
 * 4: Access capability
 */

$admin_menu[1] = array( 'Overview', 'index.php', '', 'genericon-show' );

$admin_menu[2] = array( 'Forums', 'forum-edit.php', '', 'genericon-chat' );
	$admin_submenu['forum-edit.php'][1] = array( 'Manage Forums', 'forum-edit.php' );
	$admin_submenu['forum-edit.php'][2] = array( 'New Forum', 'forum-new.php' );

$admin_menu[4] = array( 'Topics', 'topic-edit.php', '', 'genericon-summary' );
	$admin_submenu['topic-edit.php'][1] = array( 'Manage Topics', 'topic-edit.php' );
	$admin_submenu['topic-edit.php'][2] = array( 'New Topic', 'topic-new.php' );

$admin_menu[5] = array( 'Replies', 'reply-edit.php', '', 'genericon-reply' );
	$admin_submenu['reply-edit.php'][1] = array( 'All Replies', 'reply-edit.php' );
	$admin_submenu['reply-edit.php'][2] = array( 'Add Reply', 'reply-new.php' );

$admin_menu[6] = array( 'Users', 'user-edit.php', '', 'genericon-user' );
	$admin_submenu['user-edit.php'][1] = array( 'Add User', 'user-new.php' );
	$admin_submenu['user-edit.php'][2] = array( 'All Users', 'user-edit.php' );
	$admin_submenu['user-edit.php'][3] = array( 'My Profile', 'profile.php' );

$admin_menu[7] = array( 'Skins', 'skins.php', '', 'genericon-paintbrush' );

$admin_menu[8] = array( 'Ads Manager', 'ads.php', '', 'genericon-location', '' );

$admin_menu[9] = array( 'Settings', 'settings-general.php', '', 'genericon-cog' );
?>

<div id="admin-menu-wrap">
	
	<div id="admin-menu-bg"></div>
	
	<div id="admin-menu-container">

		<div class="admin-profile-preview clearfix">
			<div class="avatar pull-left">
				<a href="<?php echo admin_url('profile.php'); ?>">
					<?php echo $ddf_user->get_dp( 'current_user', 60, 60 ); ?>
				</a>
			</div>
			
			<div class="pull-left">
				<div class="display-name">
					<a href="<?php echo admin_url('profile.php'); ?>">
						<?php echo $ddf_user->get_user( 'display_name', 'current_user' ); ?>
					</a>
				</div>

				<div class"level">
					<?php echo get_level($ddf_user->current_userID()); ?>
				</div>
			</div>
		</div>

		<ul id="admin-menu">

			<?php foreach ( $admin_menu as $menu ) : ?>

				<li class="admin-menu-item">
					
					<a href="<?php echo $menu[1]; ?>">

						<div class="admin-menu-icon"><span class="genericon <?php echo $menu[3]; ?>"></span></div>
						
						<div class="admin-menu-name"><?php echo $menu[0]; ?></div>

					</a>

					<?php foreach ($admin_submenu as $parent => $menu_item) : ?>
						
						<?php if ( $parent == $menu[1] ) : ?>

							<ul class="admin-sub-menu">
					 
								<?php foreach ( $menu_item as $sub ) : ?>

									<li class="admin-sub-menu-item"><a href="<?php echo $sub[1]; ?>"><?php echo $sub[0]; ?></a></li>

								<?php endforeach; ?>

							</ul>

						<?php endif; ?>

					<?php endforeach; ?>
					
				</li>

			<?php endforeach; ?>

		</ul>
	</div>
</div>
