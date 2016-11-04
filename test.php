<?php
/**
 * ddforum index
 *
 * @package DDForum
 * @subpackage Administrator
 */

//include 'core/Paginate.php';

use DDForum\Core\Reply;
use DDForum\Core\Database;
use DDForum\Core\Option;
use DDForum\Core\User;
use DDForum\Core\Topic;
use DDForum\Core\Filter;
use DDForum\Core\Site;
use DDForum\Core\Forum;
use DDForum\Core\Paginate;
use DDForum\Core\Util;
use DDForum\Core\ForumItem;
use DDForum\Core\Config;
use DDForum\Core\Counter;

define('DDFPATH', dirname(__FILE__) . '/');

require(DDFPATH . 'vendor/autoload.php');

include(DDFPATH . 'ddf-config.php');

$db = Config::get('db_connection');

Database::instance()->connect('mysql:host=localhost;dbname=ddforum', 'root', '');

$user = new User();

$users = $user->getAll('id = 1');

$profile = [];

foreach ($users as $userKey => $userVal) {
    foreach ($userVal as $key => $val) {
        if (is_numeric($val)) {
            unset($val);
        }
        if (!empty($val)) {
            $profile[$key] = $val;
        }
    }
}
unset($profile['password'], $profile['avatar']);

function fixKey($key)
{
    $fix = str_replace('_', ' ', $key);
    $fix = ucfirst($fix);
    return $fix;
}

foreach ($profile as $key => $val) {
    if ($key == 'last_seen') {
        $val = Util::time2str(Util::timestamp($val));
    }
    if ($key == 'register_date') {
        $key = 'Registered';
        $val = Util::time2str(Util::formatDate($val));
    }



    echo fixKey($key) . ' = ' . $val . '<br>';
}
