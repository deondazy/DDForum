<?php

/**
 * Notifications.
 */
use DDForum\Core\Database;
use DDForum\Core\User;
use DDForum\Core\Site;
use DDForum\Core\Util;

if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once DDFPATH.'startup.php';

$title     = "Notifications - {$option->get('site_name')}";

include DDFPATH.'header.php';
?>

<h1 class="page-title">Notifications</h1>

<?php
$notifications = $notif->getAll();

foreach ($notifications as $n) : ?>
<ul class="topic-listing">
    <li class="topic-view"><?php echo $n->notification; ?></li>
</ul>
<?php endforeach;

include 'footer.php';
