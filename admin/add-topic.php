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
require_once( dirname( __FILE__ ) . '/admin.php' );

$user_id = User::currentUserId();

if ('POST' == $_SERVER['REQUEST_METHOD']) {

  if (!empty($_POST['topic-subject'])) {
    $data = [
      'topic_subject'        =>  $_POST['topic-subject'],
      'topic_slug'           =>  $_POST['topic-slug'],
      'topic_message'        =>  $_POST['topic-message'],
      'topic_status'         =>  $_POST['topic-status'],
      'forumID'              =>  $_POST['topic-forum'],
      'topic_date'           =>  date('Y-m-d H:i:s'),
      'topic_last_post_date' =>  date('Y-m-d H:i:s'),
      'topic_poster'         =>  $user_id,
      'topic_last_poster'    =>  User::currentUserId(),
      'pin'                  =>  $_POST['pin'],
    ];

    if (Topic::create($data)) {
      Util::redirect("topic.php?action=edit&id=".Database::lastInsertId()."&message=Topic created");
    }
    else {
      Util::redirect("topic-new.php?message=Unable to create topic, try again");
    }
  }
  else {
    Util::redirect('topic-new.php?message=Enter a subject for your topic');
  }
}
else {
  Site::info('Access Denied', true, true);
}
