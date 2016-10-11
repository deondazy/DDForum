<?php
/**
 * Add new topic and send to topic.php
 */

use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Util;
use DDForum\Core\Database;

/** Load admin **/
require_once(dirname(__FILE__) . '/admin.php');

$user_id = User::currentUserId();

if ('POST' == $_SERVER['REQUEST_METHOD']) {

  if (!empty($_POST['topic-subject'])) {
    $data = [
      'subject'        =>  $_POST['topic-subject'],
      'slug'           =>  $_POST['topic-slug'],
      'message'        =>  $_POST['topic-message'],
      'status'         =>  $_POST['topic-status'],
      'forum'          =>  $_POST['topic-forum'],
      'create_date'    =>  date('Y-m-d H:i:s'),
      'last_post_date' =>  date('Y-m-d H:i:s'),
      'poster'         =>  $user_id,
      'last_poster'    =>  User::currentUserId(),
      'pinned'         =>  $_POST['pin'],
    ];

    $Topic = new Topic();

    if ($Topic->create($data)) {
      Util::redirect("topic.php?action=edit&id=".Database::instance()->lastInsertId()."&message=Topic created");
    } else {
      Util::redirect("topic-new.php?message=Unable to create topic, try again");
    }
  } else {
    Util::redirect('topic-new.php?message=Enter a subject for your topic');
  }
} else {
  Site::info('Access Denied', true, true);
}
