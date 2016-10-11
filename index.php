<?php
/**
 * DDForum index.
 */
use DDForum\Core\Util;
use DDForum\Core\User;
use DDForum\Core\Site;
use DDForum\Core\Option;

define('DDFPATH', dirname(__FILE__)  . DIRECTORY_SEPARATOR);

// Load Startup file
require_once(DDFPATH.'startup.php');

$title = Option::get('site_name');

include(DDFPATH.'header.php');
?>

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

        <?php foreach ($topics as $topic) : ?>
          <tr class="topic">
            <td class="the-topic">
              <a id="topic-<?php echo $topic->id; ?>" href="<?php echo Site::url(); ?>/topic/<?php echo $topic->slug . '/' . $topic->id; ?>">
                <?php echo $topic->subject; ?>
              </a>
            </td>

            <td class="the-category">
              <a id="forum-<?php echo $topic->forum; ?>" href="<?php echo Site::url(); ?>/forums/<?php echo $topic->forum; ?>">
                <?php echo $Forum->get('name', $topic->forum); ?>
              </a>
            </td>

            <td class="the-poster">
              <a id="user-<?php echo $topic->poster; ?>" href="<?php echo Site::url(); ?>/user/<?php echo User::get('username', $topic->poster); ?>">
                <?php echo User::get('display_name', $topic->poster); ?>
              </a>
            </td>

            <td class="the-reply int-value">

              <?php echo $Topic->countReplies($topic->id); ?>
            </td>

            <td class="the-view int-value">

              <?php echo $topic->views; ?>
            </td>

            <td class="the-time">

              <?php echo Util::time2str(Util::timestamp($topic->create_date)); ?>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>

    </table>

  <?php endif; ?>
</div>

<?php include DDFPATH.'footer.php'; ?>
<?php include DDFPATH.'inc/topic-form.php'; ?>
