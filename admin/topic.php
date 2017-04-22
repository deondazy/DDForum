<?php

use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Util;
use DDForum\Core\Site;

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$title       = 'Edit Topic';
$parent_menu = 'topic-edit.php';
$file        = 'topic-edit.php';

$topic_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$action   = isset($_GET['action']) ? $_GET['action'] : '';
$user_id  = $user->currentUserId();
$Topic = new Topic();

switch ($action) {
  case 'edit':

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      if (!empty($_POST['topic-subject'])) {
        $data = [
          'subject'        =>  $_POST['topic-subject'],
          'slug'           =>  $_POST['topic-slug'],
          'message'        =>  $_POST['topic-message'],
          'forum'          =>  $_POST['topic-forum'],
          'status'         =>  $_POST['topic-status'],
          'pinned'         =>  $_POST['pin'],
        ];
      } else {
        $msg = 'Enter topic subject';
      }

      if ($Topic->update($data, $topic_id)) {
        $msg = 'Topic Updated';
      } else {
        $msg = 'Unable to update topic, try again';
      }
    }

    break;

  case 'delete':

    if ($Topic->delete($topic_id)) {
        Util::redirect("topic-edit.php?message=Topic Deleted");
      } else {
        Util::redirect("topic-edit.php?message=Unable to delete topic, try again");
      }
    break;

  default:
    Site::info('Unknown action', true, true);

    break;
}

include( DDFPATH . 'admin/inc/topic-form.php' );
include( DDFPATH . 'admin/admin-footer.php' );
