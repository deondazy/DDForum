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

$topicsInForum = $topic->getAll("forum = '{$id}'", "last_post_date DESC");

// Pagination
$allRecords = count($topicsInForum);
$limit   = 5; // TODO: Change to site limit settings
$current = isset($_GET['page']) ? $_GET['page'] : 1;
$first   = ($allRecords - $allRecords) + 1;
$last    = ceil($allRecords / $limit);
$prev    = ($current - 1 < $first) ? $first : $current - 1;
$next    = ($current + 1 > $last) ? $last : $current + 1;
$offset = isset($_GET['page']) ? $limit * ($current - 1) : 0;
$topicsInForum = $topic->paginate($limit, $offset);

include DDFPATH.'header.php'; ?>

<h2 class="page-title sectioner"><?php echo $title; ?></h2>

<ul class="entry-lists">
    <?php
    if (empty($topicsInForum)) {
        echo Site::info('No topics found');
    } else {
        foreach ($topicsInForum as $topicInForum) :  ?>
            <li class="entry">
                <a id="topic-<?php echo $topicInForum->id; ?>" href="<?php echo "{$siteUrl}/topic/{$topicInForum->slug}/"; ?>">
                    <?php echo $topicInForum->subject; ?>
                </a>

                <span class="entry-poster">
                    - By
                    <a href="<?php echo "{$siteUrl}/user/{$user->get('username', $topicInForum->poster)}"; ?>">
                        <?php echo $user->get('display_name', $topicInForum->poster); ?>
                        <img class="entry-poster-avatar" src="<?php echo $user->get('avatar', $topicInForum->poster); ?>" height="30" width="30">
                    </a>
                </span>
                <div class="entry-meta">
                    <span class="entry-replies"><?php echo $topic->countReplies($topicInForum->id); ?> replies</span> .
                    <span class="entry-views"><?php echo $topicInForum->views; ?> views</span> .
                    <span class="entry-date"><?php echo Util::time2str(Util::timestamp($topicInForum->create_date)); ?></span> .
                    <span class="entry-last-poster">Last reply by
                        <a href="<?php echo "{$siteUrl}/user/{$user->get('username', $topicInForum->last_poster)}"; ?>">
                            <?php echo $user->get('display_name', $topicInForum->last_poster); ?></span>
                        </a>
                </div>
            </li>
        <?php endforeach;
    } ?>

    <?php if ($allRecords > $limit) : ?>
        <form action="<?php echo "{$siteUrl}/forum/{$slug}/"; ?>" method="get">
            <div class="paginate centered">
                <a class="page first-page <?php echo ($current == $first) ? 'disabled' : ''; ?>" href="<?php echo "{$siteUrl}/forum/{$slug}/page={$first}"; ?>"><< First</a>

                <a class="page prev-page <?php echo ($current == $prev) ? 'disabled' : ''; ?>" href="<?php echo "{$siteUrl}/forum/{$slug}/page={$prev}"; ?>">< Prev</a>

                <span class="all-page"><?php echo "{$current} of {$last}"; ?></span>
                <a class="page next-page <?php echo ($current == $next) ? 'disabled' : ''; ?>" href="<?php echo "{$siteUrl}/forum/{$slug}/page={$next}"; ?>">Next ></a>
                <a class="page last-page <?php echo ($current == $last) ? 'disabled' : ''; ?>" href="<?php echo "{$siteUrl}/forum/{$slug}/page={$last}"; ?>">Last >></a>
            </div>
        </form>
    <?php endif; ?>
</ul>
<?php include DDFPATH.'footer.php'; ?>
