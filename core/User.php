<?php

namespace DDForum\Core;

use DDForum\Core\Database;
use DDForum\Core\Site;
use DDForum\Core\Util;

class User
{
  /**
   * Database users table
   * @var string
   */
  private static $usersTable = TABLE_PREFIX . 'users';

  /**
   * Current user's UserID.
   *
   * @access public
   * @var int
   */
  public static $userId;

  /**
   * Current user's username
   *
   * @access public
   * @var string
   */
  public static $username;

  /**
   * Current user's password hash
   *
   * @access private
   * @var string
   */
  public static $password;

  /**
   * Current user's First Name
   *
   * @access public
   * @var string
   */
  public static $firstName;

  /**
   * Current user's Last Name
   *
   * @access public
   * @var string
   */
  public static $lastName;

  /**
   * Current user's Display Name
   *
   * @access public
   * @var string
   */
  public static $displayName;

  /**
   * Current user level on site
   *
   * @access public
   * @var string
   */
  public static $userLevel = 'user';

  /**
   * Current user's email
   *
   * @access public
   * @var string
   */
  public static $email;

  /**
   * Current user's Website
   *
   * @access public
   * @var string
   */
  public static $website;

  /**
   * Current user's Biography
   *
   * @access public
   * @var string
   */
  public static $biography;

  /**
   * Current user's registration time
   *
   * @access public
   * @var string
   */
  public static $regTime;

  /**
   * Current user's Avatar
   *
   * @access public
   * @var string
   */
  public static $avatar;

  public static $error = [];

  public static $loginKey;

  /*
   * Class should not be instantiated
   */
  private function __construct()
  {
  }

  /**
   * Create new User
   *
   * @param array $user
   *   Array of "users table column names" and value pairs
   */
  public static function create(array $user)
  {
    if (!is_array($user) || empty($user)) {
      throw new \InvalidArgumentException("Argument must be a non empty array");
    }

    $query = "INSERT INTO ". self::$usersTable;
    $col = '';
    $val = '';

    foreach ($user as $column => $value) {
      $col .= "$column, ";
      $val .= ":". $column . ", ";
    }

    $col = rtrim($col, ', ');
    $val = rtrim($val, ', ');
    $query .= " (" . $col . ") VALUES (". $val . ")";

    Database::query($query);

    foreach ($user as $param => $value) {
      Database::bind(":{$param}", $value);
    }

    return Database::execute();
  }

  /**
   * Check if a user is logged
   *
   * @return bool
   */
  public static function isLogged()
  {
    return isset($_COOKIE['ddforum_logged']);
  }

  /**
   * Retrieve the current userId of logged user
   *
   * @return bool
   *   UserId on success or 0 on failure
   */
  public static function currentUserId()
  {
    // Get username from the session|cookie set
    if (isset($_COOKIE[self::$loginKey])) {
      self::$username = $_COOKIE[self::$login_key];

      $userId = Database::query("SELECT userID FROM ". self::$usersTable ." WHERE username = :username");
      Database::bind(':username', self::$username);

      return Database::fetchOne()->userID;
    }

    return 0;
  }

  public static function getAll() {
    Database::query("SELECT * FROM ". self::$usersTable);

    return Database::fetchAll();
  }

  /**
   * Retrieve info for user with passed $id
   *
   * @param string $field
   *   The field to retrieve
   * @param int|string $id
   *   - string current_user: Retrieves info for currently logged user
   *   the userID
   * @return string|bool
   *   Returns the user info for specified field or false if user doesn't exist
   */
  public static function get($field, $id = 'current_user')
  {
    if ('current_user' == $id) {
      $id = self::currentUserId();
    }

    Database::query("SELECT $field FROM " . self::$usersTable . " WHERE userID = $id");

    $info = Database::fetchOne();

    if (!$info) {
      return false;
    }

    return $info->$field;
  }

  /**
   * Update user data
   *
   * @param array $data
   *   Array of key => value pairs for update
   * @param int $id
   *   The userID for user to update
   * @return bool
   *   true on success, false on failure
   */
  public static function update(Array $data, $id)
  {
    if (!is_array($data) || empty($data)) {
      throw new \InvalidArgumentException("Argument must be a non empty array");
    }

    $query = "UPDATE ". self::$usersTable ." SET ";
    $col = '';

    foreach ($data as $column => $value) {
      $col .= "$column = :$column, ";
    }

    $col = rtrim($col, ', ');
    $query .= $col . " WHERE userID = :id";

    Database::query($query);

    Database::bind(':id', $id);

    foreach ($data as $param => $value) {
      Database::bind(":{$param}", $value);
    }

    Database::execute();

    return Database::rowCount();
  }

  /**
   * Check if user is an administrator
   *
   * @return bool
   */
  public static function isAdmin()
  {
    $level = self::get('level');

    if (1 == $level) {
      return true;
    }
    return false;
  }

  /**
   * Login user
   *
   * @param string $username
   *   User supplied username.
   * @param string $password
   *   User supplied password.
   * @param bool $remember
   *   Whether to keep user logged in after session. Default to false.
   * @return void
   */
  public static function login($username, $password, $remember = false)
  {
    if (!empty($username)) {
      if (!empty($password)) {
        Database::query("SELECT userID, username, password, level FROM " . self::$usersTable . " WHERE username = :username");

        Database::bind(':username', $username);

        $user = Database::fetchOne();

        if ($user) {
          if (md5($password) == $user->password) {
            $login_key = uniqid('ddforum_logged_');
            self::$loginKey = $login_key;

            if (!$remember) {
              setcookie($login_key, $username, 0);
            } else {
              setcookie($login_key, $username, time()+60*60*24*30);
            }

            /*if (self::isAdmin()) {*/
              Util::redirect(Site::url());
            /*} /*else {
              Util::redirect(Site::url());
            }*/

          } else {
            self::$error[] = 'Password is incorrect';
            return false;
          }

        } else {
          self::$error[] = 'Username is not registered';
          return false;
        }

      } else {
        self::$error[] = 'Enter your password';
        return false;
      }
    } else {
      self::$error[] = 'Enter your username';
      return false;
    }
  }

  /**
   * Log user out
   */
  public static function logout()
  {
    if (isset($_COOKIE['ddforum_logged'])) {

      setcookie('ddforum_logged', '', time()-60*60*24*30);

      $userId = self::$this->currentUserId();

      /**$this->db_obj->update_data( $this->db_obj->users, array( 'online_status' => 0, 'last_seen' => 'now()' ), "userID = '$user_id'");*/
    }

    return false;
  }

  public static function level($level)
  {
    if (!empty($level)) {
      switch ($level) {
        case '0':
          return 'Normal user';
        break;

        case '1':
          return 'Administrator';
        break;

        case '2':
          return 'Moderator';
        break;

        default:
          return 'Normal user';
        break;
      }
    }
    return 'Normal user';
  }

  public static function postCount($user_id)
  {
    return self::topicCount($user_id) + self::replyCount($user_id);
  }

  public static function topicCount($user_id)
  {
    Database::query('SELECT COUNT(*) FROM ' .TABLE_PREFIX .'topics WHERE topic_poster = :id');

    Database::bind(':id', $user_id);

    Database::execute();

    return Database::$statement->fetchColumn();
  }

  public static function replyCount($user_id)
  {
    Database::query('SELECT COUNT(*) FROM ' .TABLE_PREFIX .'replies WHERE reply_poster = :id');

    Database::bind(':id', $user_id);

    Database::execute();

    return Database::$statement->fetchColumn();
  }

  public static function topics($user_id)
  {
    Database::query('SELECT * FROM '. TABLE_PREFIX . 'topics WHERE topic_poster = :id ORDER BY topic_date DESC');
    Database::bind(':id', $user_id);

    return Database::fetchAll();
  }

   public static function paginate($order = 'userID DESC', $limit = null, $offset = 1)
   {
    $query = '';

    if (!empty($order)) {
      $query .= ' ORDER BY ' . $order;
    }
    if (!empty($limit)) {
      $query .= ' LIMIT ' . $offset  . ', ' . $limit;
    }

    Database::query(Database::$lastQuery . $query);

    return Database::fetchAll();
  }

  public static function exist($user_id)
  {
    Database::query('SELECT userID FROM ' .self::$usersTable .' WHERE userID = :id');
    Database::bind(':id', $user_id);

    Database::execute();

    if (Database::rowCount() > 0) {
      return true;
    }

    return false;
  }

  public static function findByName($username)
  {
    Database::query('SELECT username FROM ' .self::$usersTable .' WHERE username = :name');
    Database::bind(':name', $username);

    Database::execute();

    if (Database::rowCount() > 0) {
      return true;
    }

    return false;
  }

  public static function findByEmail($email)
  {
    Database::query('SELECT email FROM ' .self::$usersTable .' WHERE email = :email');
    Database::bind(':email', $email);

    Database::execute();

    if (Database::rowCount() > 0) {
      return true;
    }

    return false;
  }
}
