<?php
use DDForum\Core\Util;
use DDForum\Core\Site;

/** Load admin **/
require_once dirname( __FILE__ ).'/admin.php';

$title        = 'Edit Reply';
$parent_menu  = 'reply-edit.php';
$file         = 'reply-edit.php';

$reply_id  =  isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$forum_id  =  isset( $_GET['forum'] ) ? (int) $_GET['forum'] : 0;
$topic_id  =  isset( $_GET['topic'] ) ? (int) $_GET['topic'] : 0;
$action    =  isset($_GET['action']) ? $_GET['action'] : '';
$user_id   =  $user->currentUserId();

switch ($action) {
	case 'edit':
		if ('POST' == $_SERVER['REQUEST_METHOD']) {
			if (!empty($_POST['reply-message'])) {
				$data = [
					'message' =>  $_POST['reply-message'],
					'topic'   =>  $_POST['reply-topic'],
					'forum'   =>  $topic->get('forum', $topic_id),
				];
			}
			else {
				$message = 'Enter reply message';
			}

			if ($reply->update($data, $reply_id)) {
				$message = 'Reply Updated';
			}
			else {
				$message = 'Unable to update reply, try again';
			}
		}

		break;

	case 'delete':

		if ($reply->delete($reply_id)) {
			redirect("reply-edit.php?message=Reply Deleted");
		}
		else {
			redirect("reply-edit.php?message=Unable to delete reply, try again");
		}

		break;

	default:
		Site::info('Unknown action', true, true);

		break;
}

include DDFPATH.'admin/inc/reply-form.php';
include DDFPATH.'admin/admin-footer.php';
