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

include(DDFPATH . 'config.php');

$db = Config::get('db_connection');

$string = 'user_pass';

$s = microtime(true);
for ($i = 0; $i <= 100000; $i++) {
    list($user, $pass) = preg_split('/_/', $string);
}
$e = microtime(true);

echo "preg_split() : " . ($e - $s) . "<br>";

$start = microtime(true);
for ($i = 0; $i <= 100000; $i++) {
    list($user, $pass) = explode('_', $string);
}
$end = microtime(true);

echo "explode(): " . ($end - $start) . "<br>";
