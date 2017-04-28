<?php
/**
 * DDForum index
 *
 * @package DDForum
 */

use DDForum\Core\Database;
use DDForum\Core\site;
use DDForum\Core\Util;
use DDForum\Core\User;

define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

// Load Startup file
require_once DDFPATH.'startup.php';

$title = "New topic - {$option->get('site_name')}";

if (!$user->isLogged()) {
    Util::redirect(Site::url().'/login/');
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if (!empty($_POST['topic-subject'])) {
        if (!empty($_POST['topic-message'])) {
            if (!empty($_POST['topic-forum'])) {
                $topicData = [
                    'forum'          => $_POST['topic-forum'],
                    'subject'        => $_POST['topic-subject'],
                    'slug'           => Util::slug($_POST['topic-subject']),
                    'message'        => $_POST['topic-message'],
                    'create_date'    => date('Y-m-d H:i:s'),
                    'last_post_date' => date('Y-m-d H:i:s'),
                    'poster'         => $user->currentUserId(),
                    'last_poster'    => $user->currentUserId(),
                ];

                if ($user->isAdmin()) {
                    $topicData['pinned'] = isset($_POST['pin']) ? 1 : 0;
                }

                if ($topic->create($topicData)) {
                    $topicId = Database::instance()->lastInsertId();

                    Util::redirect("{$siteUrl}/topic/".Util::slug($_POST['topic-subject'])."/");
                } else {
                    $err = 'Unable to create topic, please try again';
                }
            } else {
                $err = 'Select a Forum for your topic';
            }
        } else {
            $err = 'Your topic should have a body message';
        }
    } else {
        $err = 'You should enter a title for your topic';
    }
}

include DDFPATH.'header.php';
?>

<h2 class="page-title">Create new Topic</h2>

<form action="" method="post" id="stopic-form" class="action-form">

    <?php
    if (isset($err)) {
        Site::info($err, true);
    }
    ?>

    <div class="form-groups">
        <div class="form-group">
            <label class="screen-reader-text" for="topic-subject">Topic subject</label>
            <input placeholder="Topic subject" type="text" id="topic-subject" class="form-control" name="topic-subject" value="">
        </div>

        <div class="form-group">
            <label class="screen-reader-text" for="topic-forum">Topic forum</label>
            <?php echo $forum->dropdown([
                'class' => 'form-control',
                'id'    => 'topic-forum',
                'name'  => 'topic-forum',
            ],
            "type = 'forum'"); ?>
        </div>

        <div class="form-group">
            <label class="screen-reader-text" for="front-editor"></label>
            <textarea class="editor-message" id="front-editor" name="topic-message"></textarea>
        </div>

        <?php if ($user->isAdmin()) : ?>
            <div class="form-group">
                <label for="pin">
                    <input type="checkbox" class="form-control" id="pin" name="pin"></textarea>
                    Pin on homepage
                </label>
            </div>
        <?php endif; ?>

        <input type="submit" class="action-button centered" value="Post">
    </div>
</form>
<?php

include(DDFPATH . 'footer.php');
