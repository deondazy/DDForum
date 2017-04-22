<?php

$title = $ddf_db->get_topic( 'topic_subject', $topic_id );

count_topic_view( $topic_id );

require_once( DDFPATH . 'header.php' );

$replies = $ddf_db->fetch_all($ddf_db->replies, "*", "topicID = '$topic_id'");

// Pagination
$all_record = $ddf_db->row_count;
$limit = 2;

$current = isset( $_GET['page'] ) ? $_GET['page'] : 1;
$first = ( $all_record - $all_record ) + 1;
$last = ceil( $all_record / $limit );
$prev = ( $current - 1 < $first ) ? $first : $current - 1;
$next = ( $current + 1 > $last ) ? $last : $current + 1;

$offset = isset( $_GET['page'] ) ? $limit * ( $current - 1 ) : 0;

$replies = $ddf_db->fetch_all($ddf_db->replies, "*", "topicID = '$topic_id'", '', $limit, $offset);

if ( empty( $replies) ) {
	$replies = array();
}
?>

<div class="topic-view">

	<div class="forum-info">
		<strong class="forum-name"><?php echo $ddf_db->get_forum( 'forum_name', $forum_id ); ?></strong>
		<span class="topics-today"></span>
		<div class="forum-description"><?php echo $ddf_db->get_forum( 'forum_description', $forum_id ); ?></div>
	</div>

	<!--<a href="#forum-form" class="add-btn">Add Reply</a>-->

	<?php if ( $all_record > 2 ) : ?>

		<div class="paginate">
			<form action="" method="get">

				<a class="first-page <?php echo ( $current == $first ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $first; ?>">First</a>
				<a class="prev-page <?php echo ( $current == $prev ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $prev; ?>">Prev</a>

				<input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>

				<a class="next-page <?php echo ( $current == $next ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $next; ?>">Next</a>
				<a class="last-page <?php echo ( $current == $last ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $last; ?>">Last</a>

			</form>
		</div>

	<?php endif; ?>

  <h1 class="topic-subject"><?php echo $ddf_db->get_topic( 'topic_subject', $topic_id ); ?></h1>

	<table class="table topic-listing">

    <tr>

      <td class="topic-poster">
        <?php echo $ddf_user->get_dp( $ddf_db->get_topic( 'topic_poster', $topic_id ), 50, 50 ); ?>
      </td>

      <td class="topic-message">
        <?php echo $ddf_db->get_topic( 'topic_message', $topic_id ); ?>
      </td>

    </tr>

		<?php foreach ($replies as $reply) : ?>

      <tr>

        <td class="topic-poster">
          <?php echo $ddf_user->get_dp( $reply->reply_poster, 50, 50 ); ?>
        </td>

				<td class="topic-message">
          <?php echo $reply->reply_message; ?>
        </td>


					<!--<div class="topic-author">- by <?php echo $user->get_user("username", $reply->reply_poster); ?></div>-->
			</tr>

		<?php endforeach; ?>

	</table>

		<?php if ( $all_record > 5 ) : ?>
			<div class="paginate">
				<form action="forum.php?forum=<?php echo $forum_id; ?>" method="get">

					<a class="first-page <?php echo ( $current == $first ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $first; ?>">First</a>
					<a class="prev-page <?php echo ( $current == $prev ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $prev; ?>">Prev</a>

					<input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>

					<a class="next-page <?php echo ( $current == $next ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $next; ?>">Next</a>
					<a class="last-page <?php echo ( $current == $last ) ? 'disabled' : ''; ?>" href="?forum=<?php echo $forum_id; ?>&amp;page=<?php echo $last; ?>">Last</a>

				</form>
		<?php endif; ?>
</div>
