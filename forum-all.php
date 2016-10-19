<?php
/**
 * DDForum index.
 */
use DDForum\Core\Util;
use DDForum\Core\User;
use DDForum\Core\Site;
use DDForum\Core\Counter;
use DDForum\Core\Config;

define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

// Load Startup file
require_once DDFPATH.'startup.php';

$title = "Forums - {$option->get('site_name')}";

include DDFPATH.'header.php'; ?>

<h2 class="page-title sectioner">All forums</h2>

<div class="table-responsive">
    <?php
    $forums = $forum->getAll("type = 'forum'");
    if (empty($forums)) {
        echo Site::info('No Forums found');
    } else { ?>
        <table class="topics table">
            <thead>
                <th>Forum</th>
                <th>Parent</th>
                <th>Creator</th>
                <th>Topics</th>
                <th>Active</th>
            </thead>
            <tbody>
            <?php foreach ($forums as $f) :
                $counter = new Counter(Config::getTablePrefix().'topics'); ?>
                <tr class="topic">
                    <td class="the-topic">
                        <a id="topic-<?php echo $f->id; ?>" href="<?php echo Site::url(); ?>/forum/<?php echo $f->slug . '/' . $f->id; ?>">
                            <?php echo $f->name; ?>
                        </a>
                    </td>
                    <td class="the-category">
                        <a id="forum-<?php echo $f->parent; ?>" href="<?php echo Site::url(); ?>/category/<?php echo $f->parent; ?>">
                            <?php echo $forum->get('name', $f->parent); ?>
                        </a>
                    </td>
                    <td class="the-poster">
                      <a id="user-<?php echo $f->creator; ?>" href="<?php echo Site::url(); ?>/users/<?php echo $f->creator; ?>">
                        <?php echo User::get('display_name', $f->creator); ?>
                      </a>
                    </td>
                    <td class="the-poster">
                      <?php echo $counter->count('topic', ['forum' => $f->id]); ?>
                    </td>
                    <td class="the-time">
                        <?php echo Util::time2str(Util::timestamp($f->last_post_date)); ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
  <?php } ?>
</div>
<?php include DDFPATH.'footer.php'; ?>
