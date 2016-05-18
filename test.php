<?php
/**
 * ddforum index
 *
 * @package DDForum
 * @subpackage Administrator
 */

//include 'core/Paginate.php';

use DDForum\Core\Database;
use DDForum\Core\Option;
use DDForum\Core\User;
use DDForum\Core\Topic;
use DDForum\Core\Filter;
use DDForum\Core\Site;
use DDForum\Core\Forum;
use DDForum\Core\Paginate;
use DDForum\Core\Util;

define('DDFPATH', dirname(__FILE__) . '/');

/** Load DDForum Startup **/
require_once( dirname( __FILE__ ) . '/startup.php' );

include 'header.php';
var_dump(Database::tables());
