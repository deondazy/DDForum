<?php

use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Util;
use DDForum\Core\Site;

/** Load admin **/
require_once dirname(__FILE__).'/admin.php';

$title = 'Edit Forum';
$parent_menu = 'forum-edit.php';
$file = 'forum-edit.php';

$forum_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';
$user_id = User::currentUserId();

switch ($action) {
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['forum-title'])) {
                $data = [
                    'name' => $_POST['forum-title'],
                    'slug' => $_POST['forum-slug'],
                    'description' => $_POST['forum-description'],
                    'type' => $_POST['forum-type'],
                    'status' => $_POST['forum-status'],
                    'visibility' => $_POST['forum-visibility'],
                    'parent' => $_POST['forum-parent'],
                ];
            } else {
                $message = 'Enter forum name';
            }

            $forum = new Forum();

            if ($forum->update($data, $forum_id)) {
                $message = 'Forum Updated';
            } else {
                $message = 'Unable to update forum, try again';
            }
        }

        break;

    case 'delete':
        $forum = new Forum();

        if ($forum->delete($forum_id)) {
            Util::redirect('forum-edit.php?message=Forum Deleted');
        } else {
            Util::redirect('forum-edit.php?message=Unable to delete forum, try again');
        }

        break;

    default:
        Site::info('Unknown action', true, true);

        break;
}

include DDFPATH.'admin/inc/forum-form.php';
include DDFPATH.'admin/admin-footer.php';
