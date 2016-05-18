<?php
/**
 * DDForum index
 *
 * @package DDForum
 */

use DDForum\Core\Option;
use DDForum\Core\Util;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\User;

define('DDFPATH', dirname(__FILE__) . '/');

// Load Startup file
require_once(DDFPATH . 'startup.php');

$title = 'New topic - ' . Option::get('site_name');


require_once(DDFPATH . 'header.php');

echo '<h2 class="page-title">Create new Topic</h2>';

include(DDFPATH . 'inc/topic-form.php');

include(DDFPATH . 'footer.php');
