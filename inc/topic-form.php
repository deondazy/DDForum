<?php
/**
 * Form for New and Edit Forum Screen
 *
 * @package DDForum
 */

use DDForum\Core\User;
use DDForum\Core\Util;
use DDForum\Core\Site;

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if (!empty($_POST['topic-subject'])) {
        if (!empty($_POST['topic-message'])) {
            if (!empty($_POST['topic-forum'])) {
                $topic = [
                    'forum'          => $_POST['topic-forum'],
                    'subject'        => $_POST['topic-subject'],
                    'slug'           => Util::slug($_POST['topic-subject']),
                    'message'        => $_POST['topic-message'],
                    'create_date'    => date('Y-m-d H:i:s'),
                    'last_post_date' => date('Y-m-d H:i:s'),
                    'poster'         => User::currentUserId(),
                    'last_poster'    => User::currentUserId(),
                ];

                if ($Topic->create($topic)) {
                    Site::info('Topic created');
                } else {
                    Site::info('Unable to create topic, please try again', true);
                }
            } else {
                Site::info('Select a Forum for your topic', true);
            }
        } else {
            Site::info('Your topic should have a body message', true);
        }
    } else {
        Site::info('You should enter a title for your topic', true);
    }
}
?>
<div class="stopic-editor editor">
    <div class="container seditor-container">
        <form action="" method="post" id="stopic-form" class="seditor">

            <a href="#" title="Close" class="close-editor pull-right"><i class="fa fa-remove"></i></a>

            <div class="form-wrap-main">
                <div class="field">
                    <label class="screen-reader-text" for="topic-subject">Topic subject</label>
                    <input placeholder="Topic subject" type="text" id="topic-subject" class="editor-title" name="topic-subject" value="">
                </div>

                <div class="field">
                    <label class="screen-reader-text" for="topic-forum">Topic forum</label>
                    <?php echo $forum->dropdown([
                        'id'   => 'topic-forum',
                        'name' => 'topic-forum'
                    ]); ?>
                </div>

                <div class="field">
                    <label class="screen-reader-text" for="front-editor"></label>
                    <textarea class="editor-message" id="front-editor" name="topic-message"></textarea>
                </div>
                <input type="submit" class="primary-button submit-editor" value="<?php echo isset($action) ? 'Update' : 'Create'; ?>">
            </div>
        </form>
    </div>
</div>
