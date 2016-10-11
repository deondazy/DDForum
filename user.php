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
    define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

/** Load DDForum Startup **/
require_once(DDFPATH . 'startup.php');

$username = isset($_GET['u']) ? $_GET['u'] : '';

$user = User::findByName($username);

$forum = new Forum();

if (!$user) {
    Site::info('User does not exist', true, true);
}

$title = 'Profile - '. User::get('username', $user->id) . ' - ' . Option::get('site_name');

require_once(DDFPATH . 'header.php');
?>

<div class="user-block">
    <a href="#" class="user-profile-cover">
        <img src="<?php echo Site::url(); ?>/inc/images/360skibo.com album art.jpg" class="user-profile-cover-photo">
    </a>

    <div class="user-image"><img src="<?php echo User::get('avatar', $user->id); ?>" height="168" width="168"></div>

    <div class="user-profile-name">
        <div class="user-display-name"><?php echo User::get('display_name', $user->id); ?></div>
        <div class="user-username">(<?php echo User::get('username', $user->id); ?>)</div>
    </div>
</div>

<div class="user-summary sectioner">
  <div class="user-summary-wrap">
    <span>Joined <strong><?php echo Util::time2str(User::get('register_date', $user->id)); ?></strong></span>
    <span>Last post <strong><?php echo User::get('last_post', $user->id); ?></strong></span>
    <span>Last seen <strong><?php echo Util::time2str(User::get('last_seen', $user->id)); ?></strong></span>
    <span>Views <strong><?php echo User::get('views', $user->id); ?></strong></span>
    <span>Coins <strong><?php echo User::get('credit', $user->id); ?></strong></span>
    <span>Level <strong><?php echo User::level(User::get('level', $user->id)); ?></strong></span>
  </div>
</div>

<!-- User Activity -->
<div class="user-activity sectioner">
    <div class="user-activity-wrap">
        <div class="user-handle js-handle"><strong>Activity</strong> <i class="fa fa-chevron-down"></i></div>

        <div class="user-field js-field">
            <?php
            $topics = User::topics($user->id);

            foreach ($topics as $topic) : ?>

            <div class="user-topic-wrap">
                <a class="avatar-link" href="<?php echo Site::url(); ?>/user/<?php echo User::get('username', $user->id); ?>">
                    <img class="avatar" src="<?php echo User::get('avatar', $user->id); ?>" height="45" width="45">
                </a>
                <a class="user-topic" id="<?php echo $topic->id; ?>" href="<?php echo Site::url(); ?>/topic/<?php echo $topic->slug; ?>/<?php echo $topic->id; ?>">
                    <?php echo $topic->subject; ?>
                </a>
          <div class="user-topic-forum">
            <i class="fa fa-arrow-right"></i>
            <a href="../forum/<?php echo $forum->get('id', $topic->forum); ?>">
              <?php echo $forum->get('name', $topic->forum); ?>
            </a>
          </div>
          <div class="user-topic-time">
            <?php echo Util::time2str($topic->create_date); ?>
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
            <div class="user-field-info">
                <span class="info-title">First name</span> <strong><?php echo User::get('first_name', $user->id); ?></strong>
            </div>
            <div class="user-field-info">
                <span class="info-title">Last name</span> <strong><?php echo User::get('last_name', $user->id); ?></strong>
            </div>
            <div class="user-field-info">
                <span class="info-title">Display name</span> <strong><?php echo User::get('display_name', $user->id); ?></strong>
            </div>
            <div class="user-field-info">
                <span class="info-title">Biography</span> <strong><?php echo User::get('biography', $user->id); ?></strong>
            </div>
        </div>
    </div>
</div>

<?php require_once(DDFPATH . 'footer.php'); ?>
