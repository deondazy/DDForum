<?php

use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Util;
use DDForum\Core\Site;

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$title       = 'Edit Forum';
$parent_menu = 'forum-edit.php';
$file        = 'forum-edit.php';

$forum_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$action   = isset($_GET['action']) ? $_GET['action'] : '';
$user_id  = User::currentUserId();

switch ($action) {
	case 'edit':

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			if (!empty($_POST['forum-title'])) {
        $data = [
          'forum_name'         =>  $_POST['forum-title'],
          'forum_slug'         =>  $_POST['forum-slug'],
          'forum_description'  =>  $_POST['forum-description'],
          'forum_type'         =>  $_POST['forum-type'],
          'forum_status'       =>  $_POST['forum-status'],
          'forum_visibility'   =>  $_POST['forum-visibility'],
          'forum_parent'       =>  $_POST['forum-parent'],
        ];
			}
			else {
				$message = 'Enter forum name';
			}

			if (Forum::update($data, $forum_id)) {
				$message = 'Forum Updated';
			}
			else {
				$message = 'Unable to update forum, try again';
			}
		}

		break;

	case 'delete':

		if (Forum::delete($forum_id)) {
				Util::redirect("forum-edit.php?message=Forum Deleted");
			}
			else {
				Util::redirect("forum-edit.php?message=Unable to delete forum, try again");
			}
		break;

	default:
		Site::info('Unknown action', true, true);

		break;
}

include( DDFPATH . 'admin/inc/forum-form.php' );
include( DDFPATH . 'admin/admin-footer.php' );
