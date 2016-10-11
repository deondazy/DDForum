<?php
/**
 * Form for New and Edit reply Screen
 *
 * @package DDForum
 */

use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Reply;
use DDForum\Core\Site;
use DDForum\Core\Util;

// Can't be accessed directly
if ( !defined( 'DDFPATH' ) ) {
  die('Direct access denied');
}

$reply_id = isset($reply_id) ? $reply_id : 0;

$Topic = new Topic();
$Reply = new Reply();

$reply_message =  $Reply->get('message', $reply_id);
$reply_topic   =  $Reply->get('topic', $reply_id);
$reply_forum   =  $Reply->get('forum', $reply_id);

require_once( DDFPATH . 'admin/admin-header.php' );

if (isset($message)) {
  Site::info($message);
}
elseif (isset($_GET['message'])) {
  Site::info($_GET['message']);
}
?>

<form action="<?php echo ($reply_id == 0) ? 'add-reply.php' : 'reply.php?action=edit&id=' . $reply_id; ?>" method="post">

  <div class="form-wrap-main">

    <p>
      <label class="screen-reader-text" for="form-box"></label>
      <textarea class="reply-message" id="form-box" name="reply-message"><?php echo $reply_message; ?></textarea>
    </p>

  </div>

  <div class="form-wrap-side">

    <div class="head">Reply Settings</div>

    <div class="content">
      <p>
        <span class="label">Topic ID</span>
        <label class="screen-reader-text" for="reply-topic">Reply Topic</label>

        <input class="text-box" type="text" id="reply-topic" name="reply-topic" value="<?php echo $reply_topic; ?>">

      </p>

    </div>
    <input type="submit" class="primary-button" value="<?php echo isset($action) ? 'Update' : 'Reply'; ?>">
  </div>
</form>
