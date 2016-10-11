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

  $topic_subject = $_POST['topic-subject'];
  $topic_forum   = $_POST['topic-forum'];
  $topic_message = $_POST['topic-message'];

  if (!empty($topic_subject)) {
    if (!empty($topic_message)) {
      if (!empty($topic_forum)) {
        $Topic = new Topic();

        $topic = [
          'forum'          => $topic_forum,
          'subject'        => $topic_subject,
          'slug'           => Util::slug($topic_subject),
          'message'        => $topic_message,
          'create_date'    => date('Y-m-d H:i:s'),
          'last_post_date' => date('Y-m-d H:i:s'),
          'poster'         => User::currentUserId(),
          'last_poster'    => User::currentUserId(),
        ];

        if ($Topic->create($topic)) {
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
