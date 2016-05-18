<?php

namespace DDForum\Core;

use DDForum\Core\Forum;
use DDForum\Core\Option;

class Site
{
  private static $scriptName;

  /**
   * This class shouldn't be instantiated
   */
  private function __construct()
  {
  }

  /**
   * script_name is a helper function to determine the name of the script
   * not all PHP installations return the same values for $_SERVER['SCRIPT_URL']
   * and $_SERVER['SCRIPT_NAME']
   */
  public static function scriptName()
  {
    switch ( true ) {
      case isset( self::$scriptName ):
        break;
      case isset( $_SERVER['SCRIPT_NAME'] ):
        self::$scriptName = $_SERVER['SCRIPT_NAME'];
        break;
      case isset( $_SERVER['PHP_SELF'] ):
        self::$scriptName = $_SERVER['PHP_SELF'];
        break;
      default:
        //Error::raise( _t( 'Could not determine script name.' ) );
        die();
    }
    return self::$scriptName;
  }

  public static function url()
  {
    $absPathFix = str_replace('\\', '/', DDFPATH);
    $scriptFilenameDir = dirname($_SERVER['SCRIPT_FILENAME']);

    // The request is for the admin
    if (strpos($_SERVER['REQUEST_URI'], 'admin') !== false || strpos($_SERVER['REQUEST_URI'], 'auth.php') !== false ) {
      $path = preg_replace('#/(admin/.*|auth.php)#i', '', $_SERVER['REQUEST_URI']);

    // The request is for a file in DDFPATH
    } elseif ($scriptFilenameDir . '/' == $absPathFix ) {
      // Strip off any file/query params in the path
      $path = preg_replace('#/[^/]*$#i', '', $_SERVER['PHP_SELF']);

    } else {
      if ( false !== strpos( $_SERVER['SCRIPT_FILENAME'], $absPathFix ) ) {
        // Request is hitting a file inside DDFPATH
        $directory = str_replace(DDFPATH, '', $scriptFilenameDir);
        // Strip off the sub directory, and any file/query paramss
        $path = preg_replace( '#/' . preg_quote( $directory, '#' ) . '/[^/]*$#i', '' , $_SERVER['REQUEST_URI'] );
      } elseif ( false !== strpos( $absPathFix, $scriptFilenameDir ) ) {
        // Request is hitting a file above DDFPATH
        $subdirectory = substr( $absPathFix, strpos( $absPathFix, $scriptFilenameDir ) + strlen( $scriptFilenameDir ) );
        // Strip off any file/query params from the path, appending the sub directory to the install
        $path = preg_replace( '#/[^/]*$#i', '' , $_SERVER['REQUEST_URI'] ) . $subdirectory;
      } else {
        $path = $_SERVER['REQUEST_URI'];
      }
    }

    $schema = self::ssl() ? 'https://' : 'http://'; // set_url_scheme() is not defined yet
    $url = $schema . $_SERVER['HTTP_HOST'] . $path;

    return rtrim($url, '/');
  }

  public static function ssl()
  {
    if ( isset($_SERVER['HTTPS']) ) {
      if ( 'on' == strtolower($_SERVER['HTTPS']) ) {
        return true;
      }
      if ( '1' == $_SERVER['HTTPS'] ) {
        return true;
      }
    } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
      return true;
    }
    return false;
  }

  public static function adminUrl($path = null)
  {
    if ($path) {
      return self::url() . '/admin/' . $path;
    } else {
      return self::url() . '/admin';
    }
  }

  /**
   * Display message info on the page in HTML
   *
   * @param string $message
   *   The message to display
   * @param bool $error
   *   True if info is an error, false for notices
   * @param bool $kill
   *   Should script be terminated? Defaults to false
   */
  public static function info($message, $error = false, $kill = false)
  {
    $class = ($error) ? 'info-error' : 'info-notice';

    if (!empty($message)) {
      $output = '';

      if (is_array($message)) {
        $output = '<div class="info"><div class="'. $class .'">';

        foreach ($message as $msg) {
          $output .= $msg . '<br />';
        }

        $output .= '</div></div>';
      } else {
        $output = '<div class="info"><div class="'. $class .'">' . $message . '</div></div> ';
      }
      echo $output;
    }

    if ($kill) {
      exit;
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
    Database::query('SELECT * FROM '. TABLE_PREFIX .'users');
    Database::execute();
    return Database::rowCount();
  }

  public static function onlineUsersCount()
  {
    Database::query('SELECT * FROM '. TABLE_PREFIX . 'users WHERE online_status = 1');
    Database::execute();
    return Database::rowCount();
  }

  public static function categoryCount()
  {
    Database::query("SELECT * FROM ". TABLE_PREFIX ."forums WHERE forum_type = 'category'");
    Database::execute();
    return Database::rowCount();
  }

  public static function forumCount()
  {
    Database::query("SELECT * FROM ". TABLE_PREFIX ."forums WHERE forum_type = 'forum'");
    Database::execute();
    return Database::rowCount();
  }

  public static function topicCount()
  {
    Database::query('SELECT * FROM '. TABLE_PREFIX .'topics');
    Database::execute();
    return Database::rowCount();
  }

  public static function replyCount()
  {
    Database::query('SELECT * FROM '. TABLE_PREFIX .'replies');
    Database::execute();
    return Database::rowCount();
  }

  /**
   * Install DDForum
   */
  public static function install()
  {
    try {
      $queries = self::getSqlQueries();

      Database::beginTransaction();

      foreach ($queries as $query) {
        Database::query($query);
        Database::execute();
      }

      Database::endTransaction();

      return true;
    } catch (Exception $e) {
      Database::cancelTransaction();
      self::info($e->getMessage(), true);

      return false;
    }
  }

  private static function getSqlQueries()
  {
    $schema_path = DDFPATH .'admin/install/schema.sql';

    $schema_sql = trim(file_get_contents($schema_path), "\r\n ");
    $schema_sql = str_replace('{$prefix}', TABLE_PREFIX, $schema_sql);

    $queries = preg_split("/(\\r\\n|\\r|\\n)\\1/", $schema_sql);

    return $queries;
  }

  public static function createDefaults()
  {
    $sample_category = [
      'forumID'           => 1,
      'forum_name'        => 'Default Category',
      'forum_slug'        =>  'default-category',
      'forum_description' => 'This is the Default Category, edit or delete it.',
      'forum_type'        => 'category',
      'forum_creator'     => 1,
    ];

    $sample_forum = [
      'forumID'           => 2,
      'forum_name'        => 'Default Forum',
      'forum_slug'        => 'default-forum',
      'forum_description' => 'This is the Default Forum, edit or delete it.',
      'forum_creator'     => 1,
    ];

    if (Forum::create($sample_category) && Forum::create($sample_forum)) {
      return true;
    }

    return false;
  }

  public static function createOptions($site_name, $email)
  {
    $options = [
      'site_name'             => $site_name,
      'site_url'              => self::url(),
      'site_description'      => '',
      'admin_email'           => $email,
      'enable_pm'             => 1,
      'enable_credits'        => 1,
      'enable_ads'            => 1,
      'enable_downloads'      => 1,
      'enable_notifications'  => 1,
      'enable_likes'          => 1,
      'users_can_upload'      => 0,
      'allow_reports'         => 1,
      'allow_credit_transfer' => 1,
    ];

    foreach ($options as $option_name => $value) {
       $add_options = Option::add($option_name, $value);
    }

    if ($add_options) {
      return true;
    }

    return false;
  }
}
