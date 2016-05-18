<?php
/**
 * Form for New and Edit Forum Screen
 *
 * @package DDForum
 */

use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Util;
use DDForum\Core\Site;

define('DDFPATH', dirname(__FILE__) . '/');

// Load Startup file
require_once(DDFPATH . 'startup.php');

if ($_POST) {

  $topic_subject = $_POST['topic_subject'];
  $topic_forum   = $_POST['topic_forum'];
  $topic_message = $_POST['topic_message'];

  if (!empty($topic_subject)) {
    if (!empty($topic_message)) {
      if (!empty($topic_forum)) {
        $topic = [
          'forumID'       => $topic_forum,
          'topic_subject' => $topic_subject,
          'topic_slug'    => Util::slug($topic_subject),
          'topic_message' => $topic_message,
          'topic_date'    => date('Y-m-d H:i:s'),
          'topic_last_post_date' => date('Y-m-d H:i:s'),
          'topic_poster'  => User::currentUserId(),
          'topic_last_poster' => User::currentUserId(),
        ];

        if (Topic::create($topic)) {
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
