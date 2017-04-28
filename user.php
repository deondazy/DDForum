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
require_once DDFPATH.'startup.php';

$username = isset($_GET['u']) ? $_GET['u'] : '';

$profile = $user->findByName($username);

if (!$profile) {
    Site::info('User does not exist', true, true);
}

$title = "{$user->get('username', $profile->id)} - {$option->get('site_name')}";

include DDFPATH.'header.php';
?>

<div class="user-block">
    <a href="#" class="user-profile-cover">
        <img src="<?php echo "{$siteUrl}/inc/images/profile-cover.jpg"?>" class="user-profile-cover-photo">
    </a>

    <div class="user-image"><img src="<?php echo $user->get('avatar', $profile->id); ?>" height="168" width="168"></div>

    <div class="user-profile-name">
        <div class="user-display-name"><?php echo $user->get('display_name', $profile->id); ?></div>
        <div class="user-username">(<?php echo $user->get('username', $profile->id); ?>)</div>
    </div>
</div>
<div class="user-summary sectioner">
  <div class="user-summary-wrap">
    <span>Joined <strong><?php echo Util::time2str($user->get('register_date', $profile->id)); ?></strong></span>
    <!--<span>Last post <strong><?php //echo $user->get('', $user->id); ?></strong></span>-->
    <span>Last seen <strong><?php echo Util::time2str($user->get('last_seen', $profile->id)); ?></strong></span>
    <!--<span>Views <strong><?php //echo $user->get('views', $user->id); ?></strong></span>-->
    <span>Coins <strong><?php echo $user->get('credit', $profile->id); ?></strong></span>
    <span>Level <strong><?php echo $user->level($user->get('level', $profile->id)); ?></strong></span>
  </div>
</div>

<!-- User Activity -->
<div class="user-activity sectioner">
    <div class="user-activity-wrap">
        <div class="user-handle js-handle"><strong>Activity</strong> <i class="fa fa-chevron-down"></i></div>

        <div class="user-field js-field">
            <?php
            $topics = $user->topics($profile->id);

            foreach ($topics as $t) : ?>

            <div class="user-topic-wrap">
                <a class="avatar-link" href="<?php echo "{$siteUrl}/user/".$user->get('username', $profile->id); ?>">
                    <img class="avatar" src="<?php echo $user->get('avatar', $profile->id); ?>" height="45" width="45">
                </a>
                <a class="user-topic" id="<?php echo $t->id; ?>" href="<?php echo "{$siteUrl}/topic/{$t->slug}/"; ?>">
                    <?php echo $t->subject; ?>
                </a>
                <div class="user-topic-forum">
                    <i class="fa fa-arrow-right"></i>
                    <a href="<?php echo "{$siteUrl}/forum/{$forum->get('id', $t->forum)}"; ?>">
                        <?php echo $forum->get('name', $t->forum); ?>
                    </a>
                </div>
                <div class="user-topic-time">
                    <?php echo Util::time2str($t->create_date); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$users = $user->getAll("id = {$profile->id}");
$p = [];
foreach ($users as $userKey => $userVal) {
    foreach ($userVal as $key => $val) {
        if (is_numeric($val)) {
            unset($val);
        }
        if (!empty($val)) {
            $p[$key] = $val;
        }
    }
}

unset($p['password'], $p['avatar']);

function fixKey($key)
{
    $fix = str_replace('_', ' ', $key);
    $fix = ucfirst($fix);
    return $fix;
} ?>

<div class="user-details">
    <div class="user-details-wrap">
        <div class="user-handle js-handle"><strong>Details</strong> <i class="fa fa-chevron-down"></i></div>
        <div class="user-field js-field">

            <?php
            foreach ($p as $key => $val) {
                if ($key == 'last_seen') {
                    $val = Util::time2str(Util::timestamp($val));
                }
                if ($key == 'country') {
                    $val = ucfirst($val);
                }
                if ($key == 'facebook' || $key == 'twitter' || $key == 'website_url') {
                    $val = '<a target="_blank" href="'.$val.'">'.$val.'</a>';
                }
                if ($key == 'register_date') {
                    $key = 'Registered';
                    $val = Util::time2str(Util::formatDate($val));
                } ?>

                <div class="user-field-info">
                    <span class="info-title"><?php echo fixKey($key); ?></span>
                    <strong><?php echo $val; ?></strong>
                </div>
                <?php
            } ?>
        </div>
    </div>
</div>
<?php include DDFPATH.'footer.php';
