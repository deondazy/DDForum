<?php

namespace DDForum\Core;

use DDForum\Core\Database;

class Paginate
{
    public static function paginate()
    {
        $all     =  Database::instance()->rowCount();
        $limit   =  2; // Change to site limit setting.

        $current =  isset($_GET['page']) ? $_GET['page'] : 1;
        $first   =  ($all - $all) + 1;
        $last    =  ceil($all / $limit);
        $prev    =  ($current - 1 < $first) ? $first : $current - 1;
        $next    =  ($current + 1 > $last) ? $last : $current + 1;

        $offset = isset($_GET['page']) ? $limit * ($current - 1) : 0;

        $query = ' LIMIT ' . $offset  . ', ' . $limit;

        Database::query(Database::$lastQuery . $query);

        Database::fetchAll();

        $output = '<form method="get">';
        $output .= '<div class="paginate">';
        $output .= '<a class="first-page ';
        $output .= ($current == $first) ? 'disabled' : '';
        $output .= '" href="?page=' . $first . '">First</a>';
        $output .= '<a class="prev-page ';
        $output .= ($current == $prev) ? 'disabled' : '';
        $output .= '" href="?page=' . $prev . '">Prev</a>';
        $output .= '<input class="current-page" type="text" size="2" name="page" value="'.$current.'"> of <span class="all-page">'. $last .'</span>';
        $output .= '<a class="next-page ';
        $output .= ($current == $next) ? 'disabled' : '';
        $output .= '" href="?page=' . $next.'">Next</a>';
        $output .= '<a class="last-page ';
        $output .= ($current == $last) ? 'disabled' : '';
        $output .= '" href="?page='.$last.'">Last</a>';
        $output .= '</div></form>';

        return $output;
    }
}
