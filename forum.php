<?php

use DDForum\Core\Site;
use DDForum\Core\Option;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\User;
use DDForum\Core\Database;

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(__FILE__) . '/');
}

/** Load DDForum Startup **/
require_once(DDFPATH . 'startup.php');

$forum_id = isset( $_GET['id'] ) ? $_GET['id'] : 0;

$title = Forum::get('forum_name', $forum_id);

require_once(DDFPATH . 'header.php');

$topics = Topic::getAll();

// Pagination
$all_record = Database::rowCount();
$limit = 10;

$current = isset( $_GET['page'] ) ? $_GET['page'] : 1;
$first = ( $all_record - $all_record ) + 1;
$last = ceil( $all_record / $limit );
$prev = ( $current - 1 < $first ) ? $first : $current - 1;
$next = ( $current + 1 > $last ) ? $last : $current + 1;

$offset = isset( $_GET['page'] ) ? $limit * ( $current - 1 ) : 0;

$topics = Topic::paginate('topic_date DESC', $limit, $offset);
?>

<div class="single-forum">
  <div class="container">

    <div class="forum-info">
      <strong class="forum-name"><?php echo Forum::get('forum_name', $forum_id); ?></strong>
      <span class="topics-today">

      </span>
      <div class="forum-description"><?php echo Forum::get('forum_description', $forum_id); ?></div>
    </div>

    <a href="#forum-form" class="add-btn">Add Topic</a>

    <?php if ( $all_record > 2 ) : ?>

      <div class="paginate">
        <form action="" method="get">

          <a class="first-page <?php echo ( $current == $first ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $first; ?>">First</a>
          <a class="prev-page <?php echo ( $current == $prev ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $prev; ?>">Prev</a>

          <input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>

          <a class="next-page <?php echo ( $current == $next ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $next; ?>">Next</a>
          <a class="last-page <?php echo ( $current == $last ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $last; ?>">Last</a>

        </form>
      </div>

    <?php endif; ?>

    <div class="topic-listing clearfix">

      <?php if (!$topics) : ?>

        <div>No topics yet</div>

      <?php else : ?>

        <?php foreach ($topics as $topic) : ?>

          <div class="topic-wrap row">

            <div class="topic col-lg-4 col-sm-4">
              <strong>
                <a href="forum.php?forum=<?php echo $forum_id; ?>&amp;topic=<?php echo $topic->topicID; ?>">
                  <?php echo $topic->topic_subject; ?>
                </a>
              </strong>


              <div class="topic-author">- by <?php echo User::get("username", $topic->topic_poster); ?></div>
            </div>

            <div class="topic-replies col-lg-4 col-sm-4">
              <span class="count"><?php echo $topic->topic_replies; ?></span>
              <span class="count-text">Replies</span>
            </div>
          </div>

        <?php endforeach; ?>

      <?php endif; ?>

    </div>

    <?php if ( $all_record > 5 ) : ?>
      <div class="paginate">
        <form action="forum.php?forum=<?php echo $forum_id; ?>" method="get">

          <a class="first-page <?php echo ( $current == $first ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $first; ?>">First</a>
          <a class="prev-page <?php echo ( $current == $prev ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $prev; ?>">Prev</a>

          <input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>

          <a class="next-page <?php echo ( $current == $next ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $next; ?>">Next</a>
          <a class="last-page <?php echo ( $current == $last ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $last; ?>">Last</a>

        </form>
      </div>
    <?php endif; ?>
  </div>
</div>
