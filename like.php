<?php
/**
 * Like a post
 */

use DDForum\Core\Util;
use DDForum\Core\Site;
use DDForum\Core\Database;
use DDForum\Core\Like;

define('DDFPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

// Load Startup file
require_once DDFPATH.'startup.php';

$like = new Like();

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if (!$user->isLogged()) {
        Util::redirect(Site::url().'/login/');
    }

    $data = [
        'item'  =>  $_POST['like-item'],
        'liker' =>  $_POST['liker'],
        'date'  =>  date('Y-m-d H:i:s'),
    ];

    if ($_POST['isLiked'] == 1) {
        if ($like->unlike($_POST['like-item'], $_POST['liker'])) {
            Util::redirect($_SERVER['HTTP_REFERER'].'#post-'.$_POST['like-item']);
        }
    } else {
        if ($like->like($data)) {
            Util::redirect($_SERVER['HTTP_REFERER'].'#post-'.$_POST['like-item']);
        }
    }
}
