<?php
/**
 * Add new forum and send to forum.php
 */

use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Util;

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$user_id = User::currentUserId();

if ('POST' == $_SERVER['REQUEST_METHOD']) {

  if (!empty($_POST['forum-title'])) {
    $data = [
      'forum_name'         =>  $_POST['forum-title'],
      'forum_slug'         =>  $_POST['forum-slug'],
      'forum_description'  =>  $_POST['forum-description'],
      'forum_type'         =>  $_POST['forum-type'],
      'forum_status'       =>  $_POST['forum-status'],
      'forum_visibility'   =>  $_POST['forum-visibility'],
      'forum_parent'       =>  $_POST['forum-parent'],
      'forum_creator'      =>  $user_id,
      'forum_date'         =>  date('Y-m-d H:i:s'),
      'forum_last_post'    =>  date('Y-m-d H:i:s'),
    ];

    if (Forum::create($data)) {
      Util::redirect("forum.php?action=edit&id=".Forum::$newForumId."&message=Forum created");
    } else {
      Util::redirect("forum-new.php?message=Unable to create forum, try again");
    }
  } else {
    Util::redirect('forum-new.php?message=Enter forum title');
  }
} else {
  Site::info('Access Denied', true, true);
}
