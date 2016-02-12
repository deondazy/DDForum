<?php
/**
 * ddforum index
 *
 * @package DDForum
 * @subpackage Administrator
 */

/** Load DDForum Startup **/
require_once( dirname( __FILE__ ) . '/startup.php' );

$title = get_option( 'site_name' );

require_once( ABSPATH . 'header.php' );

$categories = $ddf_db->fetch_all( $ddf_db->forums, "*", "forum_type='category'");

foreach ( $categories as $category ) : 

	$forums = $ddf_db->fetch_all( $ddf_db->forums, "*", "forum_type = 'forum'"); ?>

	<div class="category-wrap">
		<div class="container">
			<div class="category-name">
				<a id="category-<?php echo $category->forumID; ?>" href="forum.php?category=<?php echo $category->forumID; ?>">
					<?php echo $category->forum_name; ?>
				</a>
			</div>

			<?php foreach ( $forums as $forum ) : ?>

				<div class="category-content row">
					
					<?php if ( $forum->forum_parent == $category->forumID ) : ?>
	
						<div class="col-lg-4 col-sm-4">
							<div class="forum">
								<strong class="category-title">
									<a id="forum-<?php echo $forum->forumID; ?>" href="forum.php?forum=<?php echo $forum->forumID; ?>">
										<?php echo $forum->forum_name; ?>
									</a>
								</strong>
								<div class="forum-stats">
									<?php echo $forum->forum_topics; ?> Topics, <?php echo $forum->forum_replies; ?> Replies <br />  Last reply: <?php echo time2str(timestamp($forum->forum_last_post)); ?>
								</div>
							</div>
						</div>

					<?php else : ?>
						
						<div class="forum">Nothing to display</div>

					<?php endif; ?>

				</div>
					
			<?php endforeach; ?>
		</div>
	</div>

<?php endforeach;
 
include( ABSPATH . 'footer.php' );
