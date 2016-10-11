<?php

/**
 * The file for displaying a single topic.
 */
use DDForum\Core\Database;
use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Reply;
use DDForum\Core\Site;
use DDForum\Core\Util;

if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once(DDFPATH . 'startup.php');

$topicId = isset($_GET['id']) ? $_GET['id'] : 0;
$topicSlug = isset($_GET['s']) ? $_GET['s'] : '';

$forum = new Forum();
$topic = new Topic();
$reply = new Reply();

$forumId = $topic->get('forum', $topicId);

$title = $topic->get('subject', $topicId);

$parent = isset($_GET['replytopost']) ? $_GET['replytopost'] : 0;

$replies = $reply->getAll("topic = {$topicId}", "create_date ASC");

// Pagination
$allRecords = Database::instance()->rowCount();
$limit = 5;

$current = isset($_GET['page']) ? $_GET['page'] : 1;
$first   = ($allRecords - $allRecords) + 1;
$last    = ceil($allRecords / $limit);
$prev    = ($current - 1 < $first) ? $first : $current - 1;
$next    = ($current + 1 > $last) ? $last : $current + 1;

$offset = isset($_GET['page']) ? $limit * ($current - 1) : 0;

$replies = $reply->paginate($limit, $offset);

include(DDFPATH . 'header.php');

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if (!empty($_POST['reply-message'])) {
        $replyData = [
            'forum'   => $forumId,
            'topic'   => $topicId,
            'parent'  => $parent,
            'message' => $_POST['reply-message'],
            'poster'  => User::currentUserId(),
            'create_date'    => date('Y-m-d H:i:s'),
        ];

        if ($reply->create($replyData)) {
            $lastInsertId = Database::instance()->lastInsertId();

            if (isset($_GET['page'])) {
                Site::url() . "/topic/" . $topic->get('slug', $topicId) . "/" . $topicId . "/page={$current}#post-" . $lastInsertId;
            }

            Util::redirect(
                Site::url() . "/topic/" . $topic->get('slug', $topicId) . "/" . $topicId . "#post-" . $lastInsertId
            );
        } else {
            Site::info('Unable to post reply, please try again', true);
        }
    } else {
        Site::info('You tried to post an empty reply', true);
    }
}
?>

<div class="topic-view">
    <?php
    if (!$topic->check('slug', $topicSlug, $topicId)) :
        Site::info("Topic doesn't exist,maybe it was removed or moved", true);
    else : ?>

        <?php if (User::isLogged()) : ?>
            <a href="#reply-form" class="add-btn pull-right">Add Reply</a>
        <?php endif; ?>

        <h1 class="topic-subject"><?php echo $topic->get('subject', $topicId); ?></h1>

        <ul class="topic-listing sectioner">
            <li class="topic-view" id="post-<?php echo $topicId; ?>">
                <div class="topic-poster-image">
                    <img src="<?php echo User::get('avatar', $topic->get('poster', $topicId)); ?>" height="60" width="60">
                </div>

                <div class="topic-body">
                    <div class="topic-message">
                        <div class="topic-meta">
                            <a href="<?php echo Site::url(); ?>/user/<?php echo User::get('username', $topic->get('poster', $topicId)); ?>" class="topic-author">
                                <?php echo User::get('display_name', $topic->get('poster', $topicId)); ?>
                            </a>

                            <span class="topic-date"><?php echo Util::time2str(Util::timestamp($topic->get('create_date', $topicId))); ?></span>
                        </div>
                        <?php echo $topic->get('message', $topicId); ?>
                    </div>
                    <footer class="pull-right">
                        <a href="#" class="topic-action js-like"><i class="fa fa-heart"></i> Like</a>
                        <a href="#" class="topic-action js-share"><i class="fa fa-chain"></i> Share</a>
                        <a href="replytopost=<?php echo $topicId; ?>#reply-form" class="topic-action js-reply"><i class="fa fa-reply"></i> Reply</a>
                    </footer>
                </div>
            </li>

            <?php foreach ($replies as $r) : ?>
                <li class="topic-view" id="post-<?php echo $r->id; ?>">
                    <div class="topic-poster-image">
                        <img src="<?php echo User::get('avatar', $r->poster); ?>" height="60" width="60">
                    </div>

                    <div class="topic-body">
                        <div class="topic-message">
                            <div class="topic-meta">
                                <a href="<?php echo Site::url(); ?>/user/<?php echo User::get('username', $r->poster); ?>" class="topic-author">
                                    <?php echo User::get('display_name', $r->poster); ?>
                                </a>

                                <span class="topic-date"><?php echo Util::time2str(Util::timestamp($r->create_date)); ?></span>
                            </div>
                            <?php echo $r->message; ?>
                        </div>
                        <footer class="pull-right">
                            <a href="#" class="topic-action js-like"><i class="fa fa-heart"></i> Like</a>
                            <a href="#" class="topic-action js-share"><i class="fa fa-chain"></i> Share</a>
                            <a href="replytopost=<?php echo $r->id; ?>#reply-form" class="topic-action js-reply"><i class="fa fa-reply"></i> Reply</a>
                        </footer>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if ( $allRecords > 5 ) : ?>
            <form action="" method="get" class="sectioner paginate-form">
                <div class="paginate centered">
                    <a class="page first-page <?php echo ($current == $first) ? 'disabled' : ''; ?>" href="<?php echo Site::url(); ?>/topic/<?php echo $topicSlug; ?>/<?php echo $topicId; ?>/page=<?php echo $first; ?>"><< First</a>

                    <a class="page prev-page <?php echo ($current == $prev) ? 'disabled' : ''; ?>" href="<?php echo Site::url(); ?>/topic/<?php echo $topicSlug; ?>/<?php echo $topicId; ?>/page=<?php echo $prev; ?>">< Prev</a>

                    <input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>
                    <a class="page next-page <?php echo ($current == $next) ? 'disabled' : ''; ?>" href="<?php echo Site::url(); ?>/topic/<?php echo $topicSlug; ?>/<?php echo $topicId; ?>/page=<?php echo $next; ?>">Next ></a>
                    <a class="page last-page <?php echo ($current == $last) ? 'disabled' : ''; ?>" href="<?php echo Site::url(); ?>/topic/<?php echo $topicSlug; ?>/<?php echo $topicId; ?>/page=<?php echo $last; ?>">Last >></a>
                </div>
            </form>
        <?php endif; ?>

        <?php if (User::isLogged()) {
            include(DDFPATH . 'inc/reply-form.php');
        }
    endif;

    include(DDFPATH . 'footer.php'); ?>
</div>
