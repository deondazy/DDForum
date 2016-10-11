<?php
/**
 * Form for New and Edit topic Screen
 *
 * @package DDForum
 */

use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Site;
use DDForum\Core\Util;

// Can't be accessed directly
if ( !defined( 'DDFPATH' ) ) {
  die( 'Direct access denied' );
}

$Forum = new Forum();
$Topic = new Topic();

$topicId         =   isset($topic_id) ? $topic_id : 0;

$topicSubject    =   $Topic->get('subject', $topicId);
$topicSlug       =   $Topic->get('slug', $topicId);
$topicMessage    =   $Topic->get('message', $topicId);
$topicForum      =   $Topic->get('forum', $topicId);
$topicStatus     =   $Topic->get('status', $topicId);
$topicPinned     =   $Topic->get('pinned', $topicId);

require_once(DDFPATH.'admin/admin-header.php');

if (isset($message)) {
  Site::info($message);
}
elseif (isset($_GET['message'])) {
  Site::info($_GET['message']);
}
?>

<form action="<?php echo ($topicId == 0) ? 'add-topic.php' : 'topic.php?action=edit&id=' . $topicId; ?>" method="post" class="action-form clearfix">

  <div class="form-wrap-main">
    <div class="field">
      <span class="label">Topic Subject</span>
      <label class="screen-reader-text" for="topic-subject">Topic Subject</label>
      <input type="text" id="topic-subject" class="title-box js-title-box" name="topic-subject" value="<?php echo $topicSubject; ?>">
    </div>

    <div class="field">
      <label class="screen-reader-text" for="form-box"></label>
      <textarea class="topic-message" id="form-box" name="topic-message"><?php echo $topicMessage; ?></textarea>
    </div>
  </div>

  <div class="form-wrap-side">

    <div class="field">
      <span class="label">Topic Slug</span>
      <label class="screen-reader-text" for="topic-slug">Topic  Slug</label>
      <input type="text" id="topic-slug" class="title-box js-slug-box" name="topic-slug" value="<?php echo $topicSlug; ?>">
    </div>

    <div class="head">Topic Settings</div>

    <div class="content">
      <div class="field">
        <span class="label">Forum</span>
        <label class="screen-reader-text" for="topic-forum">Topic Forum</label>

        <?php echo $Forum->dropdown([
          'class'=>'select-box',
          'name' =>'topic-forum'
          ], $topicForum); ?>
      </div>

      <div class="field">
        <span class="label">Status</span>
        <label class="screen-reader-text" for="topic-status">topic Status</label>
        <select id="topic-status" class="select-box" name="topic-status">
          <?php
          $status = ['open' => 'Open', 'locked' => 'Locked'];
          $status = array_map("trim", $status);

          foreach ($status as $id => $item) : ?>
            <option value="<?php echo $id ?>" <?php Util::selected($topicStatus, $id); ?>>
              <?php echo $item; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="field">
        <span class="label">Pin on Homepage</span>
        <label class="screen-reader-text" for="pin">Pin on Homepage</label>
        <select id="pin" class="select-box" name="pin">
          <?php
          $pin = array(0 => 'No', 1 => 'Yes');
          $pin = array_map( "trim", $pin );

          foreach ($pin as $id => $item ) : ?>
            <option value="<?php echo $id ?>" <?php Util::selected($topicPinned, $id); ?>>
              <?php echo $item; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <input type="submit" class="primary-button" value="<?php echo isset($action) ? 'Update' : 'Create'; ?>">
  </div>
</form>
