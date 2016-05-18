<?php

use DDForum\Core\Database;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Reply;
use DDForum\Core\User;
use DDForum\Core\Option;
use DDForum\Core\Site;
use DDForum\Core\Util;

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(__FILE__) . '/');
}

/** Load DDForum Startup **/
require_once(DDFPATH . 'startup.php');

$user_id = isset( $_GET['id'] ) ? $_GET['id'] : 0;

$title = 'Profile - '. User::get('username', $user_id) . ' - ' . Option::get('site_name');

require_once(DDFPATH . 'header.php');
?>

<div class="user-block">
  <div class="user-block-wrap">
    <span class="user-image">
      <img src="<?php echo User::get('avatar', $user_id); ?>" height="120" width="120">
    </span>
    <span class="user-name">
      <?php echo User::get('display_name', $user_id); ?>
    </span>
  </div>
</div>
<div class="user-summary">
  <div class="user-summary-wrap">
    <span>Joined <strong><?php echo Util::time2str(User::get('register_date', $user_id)); ?></strong></span>
    <span>Last post <strong><?php echo User::get('last_post', $user_id); ?></strong></span>
    <span>Last seen <strong><?php echo Util::time2str(User::get('last_seen', $user_id)); ?></strong></span>
    <span>Views <strong><?php echo User::get('views', $user_id); ?></strong></span>
    <span>Coins <strong><?php echo User::get('credit', $user_id); ?></strong></span>
    <span>Level <strong><?php echo User::level(User::get('level', $user_id)); ?></strong></span>
  </div>
</div>

<!-- User Activity -->
<div class="user-activity">
  <div class="user-activity-wrap">
    <div class="user-handle js-handle"><strong>Activity</strong> <i class="fa fa-chevron-down"></i></div>
    <div class="user-field js-field">
      <?php
      $topics = User::topics($user_id);

      foreach ($topics as $topic) : ?>

        <div class="user-topic-wrap">
          <a class="user-topic" id="<?php echo $topic->topicID; ?>" href="../topic/<?php echo $topic->topicID; ?>">
            <?php echo $topic->topic_subject; ?>
          </a>
          <div class="user-topic-forum">
            <i class="fa fa-arrow-right"></i>
            <a href="../forum/<?php echo Forum::get('forumID', $topic->forumID); ?>">
              <?php echo Forum::get('forum_name', $topic->forumID); ?>
            </a>
          </div>
          <div class="user-topic-time">
            <?php echo Util::time2str($topic->topic_date); ?>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="user-details">
  <div class="user-details-wrap">
    <div class="user-handle js-handle"><strong>Details</strong> <i class="fa fa-chevron-down"></i></div>
    <div class="user-field js-field">
      <div class="user-field-info">First name <strong><?php echo User::get('first_name', $user_id); ?></strong></div>
      <div class="user-field-info">Last name <strong><?php echo User::get('last_name', $user_id); ?></strong></div>
      <div class="user-field-info">Display name <strong><?php echo User::get('display_name', $user_id); ?></strong></div>
      <div class="user-field-info">Biography <strong><?php echo User::get('biography', $user_id); ?></strong></div>
    </div>
  </div>
</div>

<?php require_once(DDFPATH . 'footer.php'); ?>
