<?php

namespace DDForum\Core;

class Site
{
    private static $scriptName;

    /*
     * This class shouldn't be instantiated
     */
    private function __construct()
    {
    }

    public static function getRootPath()
    {
        return dirname(dirname(__FILE__)).'/';
    }

    /*
     * scriptName is a helper function to determine the name of the script
     * not all PHP installations return the same values for $_SERVER['SCRIPT_URL']
     * and $_SERVER['SCRIPT_NAME']
     */
    public static function scriptName()
    {
        switch (true) {
            case isset(self::$scriptName):
                break;

            case isset($_SERVER['SCRIPT_NAME']):
                self::$scriptName = $_SERVER['SCRIPT_NAME'];
                break;

            case isset($_SERVER['PHP_SELF']):
                self::$scriptName = $_SERVER['PHP_SELF'];
                break;


            default:
                self::info('Could not determine script name.', true, true);
        }

        return self::$scriptName;
    }

    /**
     * Get the site url.
     */
    public static function url()
    {
        global $option;

        if (null !== $option->get('site_url')) {
            return $option->get('site_url');
        } else {
            $abspath_fix = str_replace('\\', '/', XB_PATH);
            $script_filename_dir = dirname($_SERVER['SCRIPT_FILENAME']);

            // The request is for the Admin or the Login page
            if (strpos($_SERVER['REQUEST_URI'], 'admin') !== false || strpos($_SERVER['REQUEST_URI'], 'login.php') !== false) {
                // Remove the Admin or the Login page from the path
                $path = preg_replace('#/(admin/.*|login.php)#i', '', $_SERVER['REQUEST_URI']);
                // The request is for a file in XB_PATH
            } elseif ($script_filename_dir.'/' == $abspath_fix) {
                // Strip off any file/query params in the path
                $path = preg_replace('#/[^/]*$#i', '', $_SERVER['PHP_SELF']);
            } else {
                if (false !== strpos($_SERVER['SCRIPT_FILENAME'], $abspath_fix)) {
                    // Request is hitting a file inside XB_PATH
                    $directory = str_replace(XB_PATH, '', $script_filename_dir);
                    // Strip off the sub directory, and any file/query paramss
                    $path = preg_replace('#/'.preg_quote($directory, '#').'/[^/]*$#i', '', $_SERVER['REQUEST_URI']);
                } elseif (false !== strpos($abspath_fix, $script_filename_dir)) {
                    // Request is hitting a file above XB_PATH
                    $subdirectory = substr($abspath_fix, strpos($abspath_fix, $script_filename_dir) + strlen($script_filename_dir));
                    // Strip off any file/query params from the path, appending the sub directory to the install
                    $path = preg_replace('#/[^/]*$#i', '', $_SERVER['REQUEST_URI']).$subdirectory;
                } else {
                    $path = $_SERVER['REQUEST_URI'];
                }
            }

            $schema = self::ssl() ? 'https://' : 'http://'; // set_url_scheme() is not defined yet
            $url = $schema.$_SERVER['HTTP_HOST'].$path;

            return rtrim($url, '/');
        }
    }

    public static function ssl()
    {
        if (isset($_SERVER['HTTPS'])) {
            if ('on' == strtolower($_SERVER['HTTPS'])) {
                return true;
            }

            if ('1' == $_SERVER['HTTPS']) {
                return true;
            }
        } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
            return true;
        }

        return false;
    }

    public static function adminUrl($path = null)
    {
        if ($path) {
            return self::url().'/admin/'.$path;
        } else {
            return self::url().'/admin';
        }
    }

    /**
     * Display message info on the page in HTML.
     *
     * @param string $msg
     *                        The message to display
     * @param bool   $error
     *                        True if info is an error, false for notices
     * @param bool   $kill
     *                        Should script be terminated? Defaults to false
     */
    public static function info($str, $error = false, $kill = false)
    {
        $class = ($error) ? 'info-error' : 'info-notice';

        if (!empty($str)) {
            $output = '';

            if (is_array($str)) {
                $output = '<div class="info"><div class="'.$class.'">';

                foreach ($str as $str) {
                    $output .= $str.'<br />';
                }

                $output .= '</div></div>';
            } else {
                $output = '<div class="info"><div class="'.$class.'">'.$str.'</div></div> ';
            }

            if ($kill) {
                die($output);
            }

            echo $output;
        }
    }

    public static function isHomePage()
    {
        if ('index.php' == basename(self::scriptName())) {
            return true;
        }

        return false;
    }

    public static function isProfilePage()
    {
        if ('user.php' == basename(self::scriptName())) {
            return true;
        }

        return false;
    }

    public static function isForumPage()
    {
        if ('forum.php' == basename(self::scriptName())) {
            return true;
        }

        return false;
    }

    public static function isTopicPage()
    {
        if ('topic.php' == basename(self::scriptName())) {
            return true;
        }

        return false;
    }

    public static function isEditorPage()
    {
        if (('topic-new.php' == basename(self::scriptName())) || ('topic.php' == basename(self::scriptName()))) {
            return true;
        }

        return false;
    }

    public static function userCount()
    {
        $query = Database::instance()->query('SELECT COUNT(*) FROM '.Config::get('db_connection')->table_prefix.'users');
        $query->execute();

        return $query->fetchColumn();
    }

    public static function onlineUsersCount()
    {
        $query = Database::instance()->query('SELECT COUNT(*) FROM '.Config::get('db_connection')->table_prefix.'users WHERE online_status = 1');
        $query->execute();

        return $query->fetchColumn();
    }

    public static function categoryCount()
    {
        $query = Database::instance()->query('SELECT COUNT(*) FROM '.Config::get('db_connection')->table_prefix."forums WHERE type = 'category'");
        $query->execute();

        return $query->fetchColumn();
    }

    public static function forumCount()
    {
        $query = Database::instance()->query('SELECT COUNT(*) FROM '.Config::get('db_connection')->table_prefix."forums WHERE type = 'forum'");
        $query->execute();

        return $query->fetchColumn();
    }

    public static function topicCount()
    {
        $query = Database::instance()->query('SELECT COUNT(*) FROM '.Config::get('db_connection')->table_prefix.'topics');
        $query->execute();

        return $query->fetchColumn();
    }

    public static function replyCount()
    {
        $query = Database::instance()->query('SELECT COUNT(*) FROM '.Config::get('db_connection')->table_prefix.'replies');
        $query->execute();

        return $query->fetchColumn();
    }

    public static function title()
    {
        global $title, $option;

        return isset($title) ? $title : $option->get('site_name');
    }
}
