<?php
/**
 * Display screen for Categories, Forums and Topics
 *
 * @package DDForum
 */

/** Load DDForum Startup **/
require_once( dirname( __FILE__ ) . '/startup.php' );

$forum_id = isset( $_GET['forum'] ) ? $_GET['forum'] : 0;
$category_id = isset( $_GET['category'] ) ? $_GET['category'] : 0;
$topic_id = isset( $_GET['topic'] ) ? $_GET['topic'] : 0;

if ( $category_id != 0 && $forum_id == 0 && $topic_id == 0 ) {

	include( ABSPATH . 'templates/category.php' );

}

elseif ( $category_id == 0 && $forum_id != 0 && $topic_id == 0 ) {

	include( ABSPATH . 'templates/forum.php' );

}

elseif ( $category_id == 0 && $forum_id != 0 && $topic_id != 0) {

	include( ABSPATH . 'templates/topic.php' );

}

include( ABSPATH . 'inc/forum-form.php' );

include( ABSPATH . 'footer.php' );