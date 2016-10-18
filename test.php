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

Database::instance()->connect('mysql:host=localhost;dbname=ddforum', 'root', '');
$prefix = Config::getTablePrefix();

$topic = new Topic();

var_dump($topic->isLocked(10));
