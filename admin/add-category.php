<?php
/**
 * Add new forum and send to forum.php
 */

use DDForum\Core\Util;
use DDForum\Core\Database;

/** Load admin **/
require_once dirname(__FILE__).'/admin.php';

$user_id = $user->currentUserId();

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if (!empty($_POST['category-name'])) {
        $data = [
          'name'           =>  $_POST['category-name'],
          'description'    =>  $_POST['category-description'],
          'slug'           =>  Util::slug($_POST['category-name']),
          'type'           => 'category',
          'creator'        =>  $user_id,
          'create_date'    =>  date('Y-m-d H:i:s'),
          'last_post_date' =>  date('Y-m-d H:i:s'),
        ];

        if ($forum->create($data)) {
            Util::redirect("categories.php?message=Category created");
        } else {
            Util::redirect("categories.php?message=Unable to create category, try again");
        }
    } else {
        Util::redirect('categories.php?message=Enter category name');
    }
} else {
    Site::info('Access Denied', true, true);
}
