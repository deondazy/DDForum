<?php
/**
 * Add new reply and send to reply.php
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

	if (!empty($_POST['reply-message'])) {

		$data = [
			'topicID'       =>  $_POST['reply-topic'],
			'forumID'       =>  Topic::get('forumID', $_POST['reply-topic']),
			'reply_message' =>  $_POST['reply-message'],
			'reply_poster'  =>  $user_id,
			'reply_date'    =>  date('Y-m-d H:i:s'),
		];

		if (Reply::create($data)) {
			Util::redirect("reply.php?action=edit&id=".Database::lastInsertId()."&message=Reply added");
		}
		else {
			Util::redirect("reply-new.php?message=Unable to add reply, try again");
		}
	}
	else {
		Util::redirect('reply-new.php?message=Enter reply message');
	}
}
else {
	Site::info('Access Denied', true, true);
}
