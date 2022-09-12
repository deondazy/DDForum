<?php
/**
 * Administration Forum Screen
 *
 * @package DDForum
 * @subpackage Administration
 */

use DDForum\Core\Site;
use DDForum\Core\Forum;
use DDForum\Core\User;
use DDForum\Core\Util;
use DDForum\Core\Database;


if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
}

// Load admin
require_once DDFPATH.'admin/admin.php';

$title        =  'Categories';
$file         =  'categories.php';
$parent_menu  =  'forum-edit.php';
$categoryId   =  isset($_GET['id']) ? (int)$_GET['id'] : 0;
$action       =  isset($_GET['action']) ? $_GET['action'] : '';
$userId       =  $user->currentUserId();

switch ($action) {
    case 'edit':
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            if (!empty($_POST['category-name'])) {
                $data = [
                  'name'           =>  $_POST['category-name'],
                  'description'    =>  $_POST['category-description'],
                  'slug'           =>  Util::slug($_POST['category-name']),
                ];
            } else {
                Util::redirect('categories.php?message=Enter category name');
            }

            if ($forum->update($data, $categoryId)) {
                Util::redirect('categories.php?message=Category updated');
            } else {
                Util::redirect('categories.php?message=Unable to update category, try again');
            }
        }
        break;
    case 'delete':
        if ($forum->delete($categoryId)) {
            Util::redirect('categories.php?message=Category Deleted');
        } else {
            Util::redirect('categories.php?message=Unable to delete category, try again');
        }
        break;
}

require_once DDFPATH.'admin/admin-header.php';

$message = isset($_GET['message']) ? $_GET['message'] : '';
Site::info($message);
$cats = $forum->getAll("type = 'category'", "create_date DESC");

// Pagination
$all_record = count($cats);
$limit = 5;

$current = isset( $_GET['page'] ) ? $_GET['page'] : 1;
$first   = ($all_record - $all_record) + 1;
$last    = ceil($all_record / $limit);
$prev    = ($current - 1 < $first) ? $first : $current - 1;
$next    = ($current + 1 > $last) ? $last : $current + 1;

$offset = isset($_GET['page']) ? $limit * ($current - 1) : 0;

$cats = $forum->paginate($limit, $offset);
?>
<div class="category-add">
    <h3 class="section-title"><?php echo !empty($action) ? 'Update category' : 'Create new category'; ?></h3>
    <form method="post" action="<?php echo ($categoryId == 0) ? 'add-category.php' : 'categories.php?action=edit&id=' . $categoryId; ?>">
        <div class="form-control">
            <label for="category-name">Category name</label>
            <input type="text" id="category-name" name="category-name" value="<?php echo $forum->get('name', $categoryId); ?>">
        </div>

        <div class="form-control">
            <label for="category-description">Category description</label>
            <input type="text" id="category-description" name="category-description" value="<?php echo $forum->get('description', $categoryId); ?>">
        </div>
        <input type="submit" class="primary-button" value="<?php echo !empty($action) ? 'Update' : 'Create'; ?>">
  </form>
</div>

<?php if ($all_record > 5) : ?>
    <form action="" method="get">
        <div class="paginate">
            <a class="first-page <?php echo ($current == $first) ? 'disabled' : ''; ?>" href="?page=<?php echo $first; ?>">First</a>
            <a class="prev-page <?php echo ($current == $prev) ? 'disabled' : ''; ?>" href="?page=<?php echo $prev; ?>">Prev</a>
            <input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>
            <a class="next-page <?php echo ($current == $next) ? 'disabled' : ''; ?>" href="?page=<?php echo $next; ?>">Next</a>
            <a class="last-page <?php echo ($current == $last) ? 'disabled' : ''; ?>" href="?page=<?php echo $last; ?>">Last</a>
        </div>
    </form>
<?php endif; ?>
<table class="manage-item-list">
    <thead>
        <tr>
            <!--  <th scope="col" class="checker"><input id="select-all-1" type="checkbox"></th> -->
            <th scope="col">Category</th>
            <th scope="col">Forums</th>
            <th scope="col">Creator</th>
            <th scope="col">Created</th>
            <th class="action-col" scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php if (empty($cats)) : ?>
            <tr>
                <td colspan="10">Nothing to display</td>
            </tr>
        <?php else : ?>
            <?php foreach ($cats as $f) : ?>
                <tr id="entry-<?php echo $f->id; ?>">
                    <!--<th scope="row" class="checker">
                    <label class="screen-reader-text" for="item-select-<?php echo $forum->forumID; ?>">Select <?php echo $forum->forum_name; ?></label>
                    <input id="item-select-<?php echo $forum->forumID; ?>" type="checkbox"></td>-->

                    <td>
                        <strong>
                            <a href="categories.php?action=edit&amp;id=<?php echo $f->id; ?>">
                                <?php echo $f->name; ?>
                            </a>
                        </strong>
                        <div class="description"><?php echo $f->description; ?></div>
                    </td>
                    <td class="count-column"><?php echo $forum->count($f->id, 'parent'); ?></td>
                    <td><?php echo $user->get("display_name", $f->creator); ?></td>
                    <td><?php echo Util::time2str(Util::timestamp($f->last_post_date)); ?></td>
                    <td class="actions">
                        <a class="action-edit" href="categories.php?action=edit&amp;id=<?php echo $f->id; ?>"><span class="fa fa-pencil"></span></a>
                        <a class="action-view" href="<?php echo Site::url(); ?>/<?php echo $f->slug; ?>"><span class="fa fa-eye"></span></a>
                        <a class="action-delete" href="categories.php?action=delete&amp;id=<?php echo $f->id; ?>"><span class="fa fa-remove"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <!--<th scope="col" class="checker"><input id="select-all-2" type="checkbox"></th>-->
            <th scope="col">Category</th>
            <th scope="col">Forums</th>
            <th scope="col">Creator</th>
            <th scope="col">Created</th>
            <th class="action-col" scope="col">Actions</th>
        </tr>
    </tfoot>
</table>
<?php if ($all_record > 5) : ?>
    <form action="" method="get">
        <div class="paginate">
            <a class="first-page <?php echo ($current == $first) ? 'disabled' : ''; ?>" href="?page=<?php echo $first; ?>">First</a>
            <a class="prev-page <?php echo ($current == $prev) ? 'disabled' : ''; ?>" href="?page=<?php echo $prev; ?>">Prev</a>
            <input class="current-page" type="text" size="2" name="page" value="<?php echo $current; ?>"> of <span class="all-page"><?php echo $last; ?></span>
            <a class="next-page <?php echo ($current == $next) ? 'disabled' : ''; ?>" href="?page=<?php echo $next; ?>">Next</a>
            <a class="last-page <?php echo ($current == $last) ? 'disabled' : ''; ?>" href="?page=<?php echo $last; ?>">Last</a>
        </div>
    </form>
<?php endif;
include DDFPATH.'admin/admin-footer.php';
