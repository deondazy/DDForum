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

$title     = "Messages - {$option->get('site_name')}";

include DDFPATH.'header.php';

$sort = filter_var($_GET['s'], FILTER_SANITIZE_STRING);
?>

<h1 class="page-title">Messages</h1>

<div class="sort-view sectioner clearfix">
    <ul class="view pull-left">
        <li class="sort-item">
            <a href="#">Unread</a>
        </li>
        <li class="sort-item">
            <a href="#">Read</a>
        </li>
        <li class="sort-item">
            <a href="#">Sent</a>
        </li>
    </ul>
    <?php if ($user->isLogged()) : ?>
        <a class="secondary-button open-editor new-topic pull-right" href="<?php echo $siteUrl; ?>/topic/new/">
            New Topic
        </a>
    <?php endif; ?>
</div>

<?php
$messages = $message->getAll();

foreach ($messages as $m) : ?>
<ul class="topic-listing">
    <li class="topic-view">
        <a href="<?php echo "{$siteUrl}/message/{$m->id}" ?>"><?php echo $m->title; ?></a>
    </li>
</ul>
<?php endforeach;

include 'footer.php';
