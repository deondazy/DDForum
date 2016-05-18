<?php
/**
 * DDForum index
 *
 * @package DDForum
 */

use DDForum\Core\Option;
use DDForum\Core\Util;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\User;
use DDForum\Core\Site;

define('DDFPATH', dirname(__FILE__) . '/');

// Load Startup file
require_once(DDFPATH . 'startup.php');

$title = Option::get('site_name');


require_once(DDFPATH . 'header.php');
?>

<div class="table-responsive">
  <table class="topics table">
    <thead>
      <th>Topic</th>
      <th>Category</th>
      <th>Poster</th>
      <th>Replies</th>
      <th>Views</th>
      <th>Active</th>
    </thead>

    <?php foreach ($topics as $topic) : ?>

      <tr class="topic">
        <td class="the-topic">

          <a id="topic-<?php echo $topic->topicID; ?>" href="<?php echo Site::url(); ?>/topics/<?php echo $topic->topicID; ?>">
            <?php echo $topic->topic_subject; ?>
          </a>

        </td>

        <td class="the-category">
          <a id="forum-<?php echo $topic->forumID; ?>" href="<?php echo Site::url(); ?>/forums/<?php echo $topic->forumID; ?>">
            <?php echo Forum::get('forum_name', $topic->forumID); ?>
          </a>
        </td>

        <td class="the-poster">
          <a id="user-<?php echo $topic->topic_poster; ?>" href="<?php echo Site::url(); ?>/users/<?php echo $topic->topic_poster; ?>">
            <?php echo User::get('display_name', $topic->topic_poster); ?>
          </a>
        </td>

        <td class="the-reply int-value">
          <?php echo $topic->topic_replies; ?>
        </td>

        <td class="the-view int-value">
          <?php echo $topic->topic_views; ?>
        </td>

        <td class="the-time">
          <?php echo Util::time2str(Util::timestamp($topic->topic_date)); ?>
        </td>


      </tr>

    <?php endforeach; ?>

  </table>
</div>

<?php include(DDFPATH . 'footer.php'); ?>
<?php include(DDFPATH . 'inc/topic-form.php'); ?>
