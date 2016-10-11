<?php
/**
 * Add new forum and send to forum.php
 */

use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Util;
use DDForum\Core\Database;

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$user_id = User::currentUserId();

$Forum = new Forum();

if ('POST' == $_SERVER['REQUEST_METHOD']) {

  if (!empty($_POST['forum-title'])) {
    $data = [
      'name'           =>  $_POST['forum-title'],
      'slug'           =>  $_POST['forum-slug'],
      'description'    =>  $_POST['forum-description'],
      'type'           =>  $_POST['forum-type'],
      'status'         =>  $_POST['forum-status'],
      'visibility'     =>  $_POST['forum-visibility'],
      'parent'         =>  $_POST['forum-parent'],
      'creator'        =>  $user_id,
      'create_date'    =>  date('Y-m-d H:i:s'),
      'last_post_date' =>  date('Y-m-d H:i:s'),
    ];

    if ($Forum->create($data)) {
      Util::redirect("forum.php?action=edit&id=".Database::instance()->lastInsertId()."&message=Forum created");
    } else {
      Util::redirect("forum-new.php?message=Unable to create forum, try again");
    }
  } else {
    Util::redirect('forum-new.php?message=Enter forum title');
  }
} else {
  Site::info('Access Denied', true, true);
}
