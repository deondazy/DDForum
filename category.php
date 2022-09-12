<?php
/**
 * Category.
 */

use DDForum\Core\Util;
use DDForum\Core\Site;
use DDForum\Core\Counter;
use DDForum\Core\Config;

if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once DDFPATH.'startup.php';

$slug = isset($_GET['s']) ? $_GET['s'] : '';

if (!$forum->exist($slug)) {
    Site::info("Category doesn't exist, maybe it was removed or moved", true);
}

$id      = $forum->get('id', $slug);
$title   = "{$forum->get('name', $id)} - {$option->get('site_name')}";

include DDFPATH.'header.php'; ?>

<h2 class="page-title sectioner"><?php echo $title; ?></h2>

<ul class="table-responsive">
    <?php
    $forumsInCategory = $forum->getAll("parent = '{$id}'");
    if (empty($forumsInCategory)) {
        echo Site::info('No forum found');
    } else {
        foreach ($forumsInCategory as $forumInCategory) :  ?>
            <li class="forum-entry">
                <a id="forum-<?php echo $forumInCategory->id; ?>" href="<?php echo "{$siteUrl}/forum/{$forumInCategory->slug}/"; ?>">
                    <?php echo $forumInCategory->name; ?>:
                </a>
                <span clsss="forum-entry-description">
                    <?php echo $forumInCategory->description; ?>
                </span>
                <span class="forum-entry-topic-count">
                    (<?php echo $topic->count($forumInCategory->id, 'forum'); ?> Topics)
                </span>
            </li>
        <?php endforeach;
    } ?>
</ul>
<?php include DDFPATH.'footer.php'; ?>
