<?php
/**
 * Administration Dashboard Screen
 *
 * @package DDForum
 * @subpackage Administration
 */

use DDForum\Core\Site;

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
}

$title        =  'Dashboard';
$file         =  'index.php';
$parent_menu  =  'index.php';
$has_child    =  false;

// Load admin
require_once(DDFPATH . 'admin/admin.php');

/*$category_count = $ddf_db->query("SELECT * FROM $ddf_db->forums WHERE `forum_type` = 'category'")->num_rows;
$forum_count = $ddf_db->query("SELECT * FROM $ddf_db->forums WHERE `forum_type` = 'forum'")->num_rows;
$topic_count = $ddf_db->query("SELECT * FROM $ddf_db->topics")->num_rows;
$reply_count = $ddf_db->query("SELECT * FROM $ddf_db->replies")->num_rows;
$user_count = $ddf_db->query("SELECT * FROM $ddf_db->users")->num_rows;*/

require_once(DDFPATH . 'admin/admin-header.php');
?>

<div class="overview-content">
    <div class="overview-icon"><span class="fa fa-folder category"></span></div>

    <div class="overview-wrap">
        <div class="overview-number"><?php echo Site::categoryCount(); ?></div>
        <div class="overview-name">Categories</div>
    </div>

</div>

<div class="overview-content">
    <div class="overview-icon"><span class="fa fa-comment forum"></span></div>

    <div class="overview-wrap">
        <div class="overview-number"><?php echo Site::forumCount(); ?></div>
        <div class="overview-name">Forums</div>
    </div>

</div>

<div class="overview-content">
    <div class="overview-icon"><span class="fa fa-comments topic"></span></div>

    <div class="overview-wrap">
        <div class="overview-number"><?php echo Site::topicCount(); ?></div>
        <div class="overview-name">Topics</div>
    </div>

</div>

<div class="overview-content">
    <div class="overview-icon"><span class="fa fa-reply reply"></span></div>

    <div class="overview-wrap">
        <div class="overview-number"><?php echo Site::replyCount(); ?></div>
        <div class="overview-name">Replies</div>
    </div>

</div>

<div class="overview-content">
    <div class="overview-icon"><span class="fa fa-user user"></span></div>

    <div class="overview-wrap">
        <div class="overview-number"><?php echo Site::userCount(); ?></div>
        <div class="overview-name">Users</div>
    </div>

</div>

<?php
include( DDFPATH . 'admin/admin-footer.php' );
