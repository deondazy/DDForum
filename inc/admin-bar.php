<?php

use DDForum\Core\Site;

// Can't be accessed directly
if (!defined('DDFPATH')) {
    die('Direct access denied');
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
                    <li class="add">
                        <a href="<?php echo Site::url(); ?>" title="View site" target="_blank"><i class="fa fa-eye"></i></a>
                    </li>
                    <li class="msg">
                        <a href="<?php echo Site::adminUrl("message.php"); ?>"><i class="fa fa-envelope"></i></a>
                    </li>
                    <li class="notif">
                        <a href="#"><i class="fa fa-info"></i></a>
                    </li>
                    <li class="logout">
                        <a href="<?php echo Site::url(); ?>/auth.php?action=logout"><i class="fa fa-power-off"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
