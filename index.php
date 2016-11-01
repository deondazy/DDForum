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

include DDFPATH.'header.php'; ?>
<div class="table-responsive">
    <?php if (empty($topics)) : ?>
        <?php echo Site::info('No Topics found'); ?>
    <?php else : ?>
        <table class="topics table">
            <thead>
                <th>Topic</th>
                <th>Category</th>
                <th>Poster</th>
                <th>Replies</th>
                <th>Views</th>
                <th>Active</th>
            </thead>
            <tbody>
                <?php foreach ($topics as $t) : ?>
                    <tr class="topic">
                        <td class="the-topic">
                            <?php if ($topic->isLocked($t->id)) : ?>
                                <i class="fa fa-lock"></i>
                            <?php endif; ?>
                            <a id="topic-<?php echo $t->id; ?>" href="<?php echo "{$siteUrl}/topic/{$t->slug}/{$t->id}"; ?>">
                                <?php echo $t->subject; ?>
                            </a>
                        </td>
                        <td class="the-category">
                            <a id="forum-<?php echo $t->forum; ?>" href="<?php echo "{$siteUrl}/forum/{$t->forum}"; ?>">
                                <?php echo $forum->get('name', $t->forum); ?>
                            </a>
                        </td>
                        <td class="the-poster">
                            <a id="user-<?php echo $t->poster; ?>" href="<?php echo "{$siteUrl}/user/{$user->get('username', $t->poster)}"; ?>">
                                <?php echo $user->get('display_name', $t->poster); ?>
                            </a>
                        </td>
                        <td class="the-reply int-value">
                            <?php echo $topic->countReplies($t->id); ?>
                        </td>
                        <td class="the-view int-value">
                            <?php echo $t->views; ?>
                        </td>
                        <td class="the-time">
                            <?php echo Util::time2str(Util::timestamp($t->last_post_date)); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php include DDFPATH.'footer.php'; ?>
<?php include DDFPATH.'inc/topic-form.php'; ?>
