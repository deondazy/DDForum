<?php
/**
 * DDForum Administration Panel Menu
 *
 * @package DDForum
 * @subpackage Admin
 */

use DDForum\Core\Site;
use DDForum\Core\User;

/**
 * Admin Menu array
 *
 * 0: Name of the menu item
 * 1: Filename of the menu item
 * 2: Class(es) of the menu items
 * 3: Icon for the menu item
 * 4: Access capability
 */

$admin_menu[1] = ['Dashboard', 'index.php', '', 'fa-dashboard'];

$admin_menu[2] = ['Forums', 'forum-edit.php', '', 'fa-folder'];
    $admin_submenu['forum-edit.php'][1] = ['Categories', 'categories.php'];
    $admin_submenu['forum-edit.php'][2] = ['Manage Forums', 'forum-edit.php'];
    $admin_submenu['forum-edit.php'][3] = ['New Forum', 'forum-new.php'];

$admin_menu[3] = ['Topics', 'topic-edit.php', '', 'fa-comment'];
    $admin_submenu['topic-edit.php'][1] = ['Manage Topics', 'topic-edit.php'];
    $admin_submenu['topic-edit.php'][2] = ['New Topic', 'topic-new.php'];

$admin_menu[4] = [ 'Replies', 'reply-edit.php', '', 'fa-reply'];
    $admin_submenu['reply-edit.php'][1] = ['All Replies', 'reply-edit.php'];
    $admin_submenu['reply-edit.php'][2] = ['Add Reply', 'reply-new.php'];

/*$admin_menu[5] = [ 'Pages', 'page-edit.php', '', 'fa-file'];
  $admin_submenu['page-edit.php'][1] = [ 'All Pages', 'page-edit.php'];
  $admin_submenu['page-edit.php'][2] = [ 'New Page', 'page-new.php'];*/

$admin_menu[6] = [ 'Users', 'user-edit.php', '', 'fa-user'];
    $admin_submenu['user-edit.php'][1] = ['Add User', 'user-new.php'];
    $admin_submenu['user-edit.php'][2] = ['All Users', 'user-edit.php'];
    $admin_submenu['user-edit.php'][3] = ['My Profile', 'profile.php'];

/*$admin_menu[7] = [ 'Skins', 'skins.php', '', 'fa-paint-brush'];*/

/*$admin_menu[8] = [ 'Ads Manager', 'ads.php', '', 'fa-bullseye', ''];*/

$admin_menu[9] = ['Settings', 'settings-general.php', '', 'fa-wrench'];
?>

<div class="admin-menu-wrap clearfix">
    <div class="admin-menu-bg"></div>
    <div class="admin-menu-container">
        <div class="admin-profile-preview clearfix">
            <div class="avatar pull-left">
                <a href="<?php echo Site::adminUrl('profile.php'); ?>">
                    <img src="<?php echo $user->get('avatar'); ?>" height="60" width="60">
                </a>
            </div>
            <div class="pull-left">
                <div class="display-name">
                    <a href="<?php echo Site::adminUrl('profile.php'); ?>">
                        <?php echo $user->get('display_name'); ?>
                    </a>
                </div>
                <div class"level">
                    <?php echo $user->level($user->get('level')); ?>
                </div>
            </div>
        </div>
        <ul class="admin-menu">
            <?php foreach ($admin_menu as $menu) : ?>
                <li class="admin-menu-item<?php if ($menu[1] ==  $parent_menu) { echo ' active-menu'; } ?>">
                    <a href="<?php echo $menu[1]; ?>">
                        <span class="admin-menu-icon"><i class="fa <?php echo $menu[3]; ?>"></i></span>
                        <span class="admin-menu-name"><?php echo $menu[0]; ?></span>
                    </a>
                    <?php foreach ($admin_submenu as $parent => $menu_item) : ?>
                        <?php if ($parent == $menu[1]) : ?>
                            <ul class="admin-sub-menu">
                                <?php foreach ($menu_item as $sub) : ?>
                                    <li class="admin-sub-menu-item<?php if ($sub[1] == $file) { echo ' active-sub-menu'; } ?>">
                                        <a href="<?php echo $sub[1]; ?>"><?php echo $sub[0]; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
