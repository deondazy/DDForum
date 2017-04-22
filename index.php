<?php
/**
 * DDForum index.
 */
use DDForum\Core\Util;
use DDForum\Core\User;
use DDForum\Core\Site;

define('DDFPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

// Load Startup file
require_once DDFPATH.'startup.php';

$title = $option->get('site_name');

include DDFPATH . 'header.php'; ?>
<ul class="entry-lists">
    <?php
    if (empty($topics)) :
        echo Site::info('No Topics found');
    else :
        foreach ($topics as $t) : ?>
            <li class="entry">
                <a id="topic-<?php echo $t->id; ?>" href="<?php echo "{$siteUrl}/topic/{$t->slug}/"; ?>">
                    <?php echo $t->subject; ?>
                </a>

                <span class="entry-poster">
                    - By
                    <a href="<?php echo "{$siteUrl}/user/{$user->get('username', $t->poster)}"; ?>">
                        <?php echo $user->get('display_name', $t->poster); ?>
                        <img class="entry-poster-avatar" src="<?php echo $user->get('avatar', $t->poster); ?>" height="30" width="30">
                    </a>
                </span>
                <div class="entry-meta">
                    <span class="entry-replies"><?php echo $topic->countReplies($t->id); ?> replies</span> .
                    <span class="entry-views"><?php echo $t->views; ?> views</span> .
                    <span class="entry-date"><?php echo Util::time2str(Util::timestamp($t->create_date)); ?></span> .
                    <span class="entry-last-poster">Last reply by
                        <a href="<?php echo "{$siteUrl}/user/{$user->get('username', $t->last_poster)}"; ?>">
                            <?php echo $user->get('display_name', $t->last_poster); ?></span>
                        </a>
                </div>
            </li>
            <?php
        endforeach;
    endif; ?>
</ul>
<?php include DDFPATH.'footer.php'; ?>
<?php include DDFPATH.'inc/topic-form.php'; ?>
