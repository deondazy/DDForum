<?php

$title = 'Overview';

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$redirect_url = urlencode(admin_url());

$category_count = $ddf_db->query("SELECT * FROM $ddf_db->forums WHERE `forum_type` = 'category'")->num_rows;
$forum_count = $ddf_db->query("SELECT * FROM $ddf_db->forums WHERE `forum_type` = 'forum'")->num_rows;
$topic_count = $ddf_db->query("SELECT * FROM $ddf_db->topics")->num_rows;
$reply_count = $ddf_db->query("SELECT * FROM $ddf_db->replies")->num_rows;
$user_count = $ddf_db->query("SELECT * FROM $ddf_db->users")->num_rows;

require_once( ABSPATH . 'admin/admin-header.php' );
?>

<div class="overview-content">
	<div class="overview-icon"><span class="genericon genericon-category category"></span></div>

	<div class="overview-wrap">
		<div class="overview-number"><?php echo $category_count; ?></div>
		<div class="overview-name">Categories</div>
	</div>

</div>

<div class="overview-content">
	<div class="overview-icon"><span class="genericon genericon-chat forum"></span></div>

	<div class="overview-wrap">
		<div class="overview-number"><?php echo $forum_count; ?></div>
		<div class="overview-name">Forums</div>
	</div>

</div>

<div class="overview-content">
	<div class="overview-icon"><span class="genericon genericon-summary topic"></span></div>

	<div class="overview-wrap">
		<div class="overview-number"><?php echo $topic_count; ?></div>
		<div class="overview-name">Topics</div>
	</div>

</div>

<div class="overview-content">
	<div class="overview-icon"><span class="genericon genericon-reply reply"></span></div>

	<div class="overview-wrap">
		<div class="overview-number"><?php echo $reply_count; ?></div>
		<div class="overview-name">Replies</div>
	</div>

</div>

<div class="overview-content">
	<div class="overview-icon"><span class="genericon genericon-user user"></span></div>

	<div class="overview-wrap">
		<div class="overview-number"><?php echo $user_count; ?></div>
		<div class="overview-name">Users</div>
	</div>

</div>

<?php
include( ABSPATH . 'admin/admin-footer.php' );
