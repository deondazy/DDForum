<?php
/**
 * Administration Topic Screen
 *
 * @package DDForum
 * @subpackage Administration
 */

use DDForum\Core\Site;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Reply;
use DDForum\Core\User;
use DDForum\Core\Util;
use DDForum\Core\Database;


if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
}

$title        =  'Replies';
$file         =  'reply-edit.php';
$parent_menu  =  'reply-edit.php';
$has_child    =  true;

// Load admin
require_once(DDFPATH . 'admin/admin.php');

require_once(DDFPATH . 'admin/admin-header.php');

$message = isset( $_GET['message'] ) ? $_GET['message'] : '';

Site::info($message);

$replies = $reply->getAll();

// Pagination
$all_record = count($replies);
$limit = 5;

$current = isset( $_GET['page'] ) ? $_GET['page'] : 1;
$first = ( $all_record - $all_record ) + 1;
$last = ceil( $all_record / $limit );
$prev = ( $current - 1 < $first ) ? $first : $current - 1;
$next = ( $current + 1 > $last ) ? $last : $current + 1;

$offset = isset( $_GET['page'] ) ? $limit * ( $current - 1 ) : 0;

$replies = $reply->paginate($limit, $offset);
?>
<a href="reply-new.php" class="extra-nav">Add Reply</a>
<?php if ( $all_record > 5 ) : ?>
    <form action="" method="get">
        <div class="paginate">

            <a class="first-page <?php echo ( $current == $first ) ? 'disabled' : ''; ?>" href="?page=<?php echo $first; ?>">First</a>
            <a class="prev-page <?php echo ( $current == $prev ) ? 'disabled' : ''; ?>" href="?page=<?php echo $prev; ?>">Prev</a>

            <input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>

            <a class="next-page <?php echo ( $current == $next ) ? 'disabled' : ''; ?>" href="?page=<?php echo $next; ?>">Next</a>
            <a class="last-page <?php echo ( $current == $last ) ? 'disabled' : ''; ?>" href="?page=<?php echo $last; ?>">Last</a>

        </div>
    </form>
<?php endif; ?>

<table class="manage-item-list">
    <thead>
        <tr>
        <!--    <th scope="col" class="checker"><input id="select-all-1" type="checkbox"></th> -->
            <th scope="col">Topic</th>
            <th scope="col">Forum</th>
            <th scope="col">Author</th>
            <th scope="col">Reply date</th>
            <th class="action-col" scope="col">Actions</th>
        </tr>
    </thead>

    <tbody>

        <?php if (!$replies) : ?>
            <tr>
                <td colspan="10">Nothing to display</td>
            </tr>

        <?php else : ?>

            <?php foreach ($replies as $r) : ?>

                <tr id="entry-<?php echo $r->id; ?>">
                    <!--<th scope="row" class="checker">
                        <label class="screen-reader-text" for="item-select-<?php echo $forum->forumID; ?>">Select <?php echo $forum->forum_name; ?></label>
                        <input id="item-select-<?php echo $forum->forumID; ?>" type="checkbox"></td>-->

                    <td>
                        <strong>
                            <a href="reply.php?action=edit&amp;id=<?php echo $r->id; ?>&amp;forum=<?php echo $r->forum; ?>&amp;topic=<?php echo $r->topic; ?>">
                                <?php echo $topic->get('subject', $r->topic); ?>
                            </a>
                        </strong>
                    </td>

                    <td class="count-column"><?php echo $forum->get('name', $r->forum); ?></td>

                    <td><?php echo $user->get("display_name", $r->poster); ?></td>

                    <td class="count-column"><?php echo Util::time2str(Util::timestamp($r->create_date)); ?></td>

                    <td class="actions">
                        <a class="action-edit" href="reply.php?action=edit&amp;id=<?php echo $r->id; ?>&amp;forum=<?php echo $r->forum; ?>&amp;topic=<?php echo $r->topic; ?>"><span class="fa fa-pencil"></span></a>

                        <a class="action-view" href="<?php echo $siteUrl; ?>topics/<?php echo $r->topic; ?>/#<?php echo $r->id; ?>"><span class="fa fa-eye"></span></a>

                        <a class="action-delete" href="reply.php?action=delete&amp;id=<?php echo $r->id; ?>&amp;forum=<?php echo $r->forum; ?>&amp;topic=<?php echo $r->topic; ?>"><span class="fa fa-remove"></span></a>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php endif; ?>

    </tbody>

    <tfoot>
        <tr>
            <!--<th scope="col" class="checker"><input id="select-all-2" type="checkbox"></th>-->
            <th scope="col">Topic</th>
            <th scope="col">Forum</th>
            <th scope="col">Author</th>
            <th scope="col">Reply date</th>
            <th class="action-col" scope="col">Actions</th>
        </tr>
    </tfoot>

</table>
<?php if ( $all_record > 5 ) : ?>
    <form action="" method="get">
        <div class="paginate">

            <a class="first-page <?php echo ( $current == $first ) ? 'disabled' : ''; ?>" href="?page=<?php echo $first; ?>">First</a>
            <a class="prev-page <?php echo ( $current == $prev ) ? 'disabled' : ''; ?>" href="?page=<?php echo $prev; ?>">Prev</a>

            <input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>

            <a class="next-page <?php echo ( $current == $next ) ? 'disabled' : ''; ?>" href="?page=<?php echo $next; ?>">Next</a>
            <a class="last-page <?php echo ( $current == $last ) ? 'disabled' : ''; ?>" href="?page=<?php echo $last; ?>">Last</a>

        </div>
    </form>
<?php endif; ?>

<?php

include( DDFPATH . 'admin/admin-footer.php' );
?>
