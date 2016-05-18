<?php

/**
 * Display screen for Categories, Forums and Topics
 *
 * @package DDForum
 */

use DDForum\Core\Database;
use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Reply;

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(__FILE__) . '/');
}

/** Load DDForum Startup **/
require_once(DDFPATH . 'startup.php');

$topic_id = isset( $_GET['id'] ) ? $_GET['id'] : 0;
$forum_id = Topic::get('forumID', $topic_id);

$title = Topic::get('topic_subject', $topic_id);

//count_topic_view( $topic_id );

require_once( DDFPATH . 'header.php' );

$replies = Reply::getAll("topicID = '$topic_id'");

// Pagination
$all_record = Database::rowCount();
$limit = 2;

$current = isset( $_GET['page'] ) ? $_GET['page'] : 1;
$first = ( $all_record - $all_record ) + 1;
$last = ceil( $all_record / $limit );
$prev = ( $current - 1 < $first ) ? $first : $current - 1;
$next = ( $current + 1 > $last ) ? $last : $current + 1;

$offset = isset( $_GET['page'] ) ? $limit * ( $current - 1 ) : 0;

$replies = Reply::paginate("reply_date DESC", $limit, $offset);

/*if ( empty( $replies) ) {
  $replies = array();
}*/
?>

<div class="topic-view">

  <div class="forum-info">
    <strong class="forum-name"><?php echo Forum::get('forum_name', $forum_id); ?></strong>
    <span class="topics-today"></span>
    <div class="forum-description"><?php echo Forum::get('forum_description', $forum_id); ?></div>
  </div>

  <!--<a href="#forum-form" class="add-btn">Add Reply</a>-->

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

  <h1 class="topic-subject"><?php echo Topic::get('topic_subject', $topic_id); ?></h1>

  <table class="table topic-listing">

    <tr>

      <td class="topic-poster">
        <img src="<?php echo User::get('avatar', Topic::get('topic_poster', $topic_id)); ?>" height="50" width="50">
      </td>

      <td class="topic-message">
        <?php echo Topic::get('topic_message', $topic_id); ?>
      </td>

    </tr>

    <?php foreach ($replies as $reply) : ?>

      <tr>

        <td class="topic-poster">
          <img src="<?php echo User::get('avatar', $reply->reply_poster); ?>" height="50" width="50">
        </td>

        <td class="topic-message">
          <?php echo $reply->reply_message; ?>
        </td>


          <!--<div class="topic-author">- by <?php echo $user->get_user("username", $reply->reply_poster); ?></div>-->
      </tr>

    <?php endforeach; ?>

  </table>

    <?php if ( $all_record > 5 ) : ?>
      <div class="paginate">
        <form action="forum.php?forum=<?php echo $forum_id; ?>" method="get">

          <a class="first-page <?php echo ( $current == $first ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $first; ?>">First</a>
          <a class="prev-page <?php echo ( $current == $prev ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $prev; ?>">Prev</a>

          <input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>

          <a class="next-page <?php echo ( $current == $next ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $next; ?>">Next</a>
          <a class="last-page <?php echo ( $current == $last ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $last; ?>">Last</a>

        </form>
    <?php endif; ?>
</div>
