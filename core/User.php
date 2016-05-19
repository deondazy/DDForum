<?php

namespace DDForum\Core;

use DDForum\Core\Database;
use DDForum\Core\Site;
use DDForum\Core\Util;

class User
{
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

  private static $loginKey = 'TYgt%gfdrt=1&778h#$&jk';

  /*
   * Class should not be instantiated
   */
  private function __construct()
  {
  }

  private static function table()
  {
    return TABLE_PREFIX . 'users';
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

    $query = "INSERT INTO ". self::table();
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
    if (isset($_COOKIE['ddforum'])) {
      // Is cookie valid?
      list($username, $hash) = preg_split('/_/', $_COOKIE['ddforum']);

      Database::query("SELECT COUNT(*) FROM ". self::table() ." WHERE username = :username");
      Database::bind(':username', $username);
      Database::execute();

      if (Database::$statement->fetchColumn() > 0) {
        return true;
      }

      return false;
    }

    return false;
  }

  /**
   * Retrieve the current userId of logged user
   *
   * @return bool
   *   UserId on success or 0 on failure
   */
  public static function currentUserId()
  {
    // Get username from the set cookie
    if (isset($_COOKIE['ddforum'])) {
      list($username, $hash) = preg_split('/_/', $_COOKIE['ddforum']);
      self::$username = $username;

      $userId = Database::query("SELECT userID FROM ". self::table() ." WHERE username = :username");
      Database::bind(':username', self::$username);

      return Database::fetchOne()->userID;
    }

    return 0;
  }

  public static function getAll() {
    Database::query("SELECT * FROM ". self::table());

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

    Database::query("SELECT $field FROM " . self::table() . " WHERE userID = $id");

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

    $query = "UPDATE ". self::table() ." SET ";
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
   * Register user
   *
   * @param array $data
   *   Array of supplied user details
   *
   * @return void
   */
  public static function register(array $user)
  {
    if (!is_array($user) || empty($user)) {
      throw new \InvalidArgumentException("Argument must be a non empty array");
    }

    // username is required
    if (!empty($user['username'])) {

      // Username cannot exceed 16 characters
      if (strlen($user['username']) <= 16) {

        // Allow only alphanumeric characters, underscores and hyphen
        if (preg_match("/^[a-zA-Z0-9]+$/", $user['username'])) {

          // Check if username is already taken
          if (!self::findByName($user['username'])) {

            // email is required
            if (!empty($user['email'])) {

              // Check if email is valid
              if (preg_match('/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/', $user['email'])) {

                // Check is email is already taken
                if (!self::findByEmail($user['email'])) {

                  // Password is required
                  if (!empty($user['password'])) {

                    // Password confirmation is required
                    if (!empty($user['password2'])) {

                      // Does the 2 passwords match
                      if ($user['password'] == $user['password2']) {

                        $first_name = isset($user['first_name']) ? $user['first_name'] : '';
                        $last_name  = isset($user['last_name']) ? $user['last_name'] : '';
                        $password   = md5($user['password']);

                        $data = [
                          'username'      =>  $user['username'],
                          'password'      =>  $password,
                          'email'         =>  $user['email'],
                          'first_name'    =>  $first_name,
                          'last_name'     =>  $last_name,
                          'display_name'  =>  $user['username'],
                          'country'       =>  $user['country'],
                          'birth_day'     =>  $user['birth_day'],
                          'birth_month'   =>  $user['birth_month'],
                          'birth_year'    =>  $user['birth_year'],
                          'age'           =>  date( 'Y' ) - $_POST['year'],
                          'gender'        =>  $user['gender'],
                          'avatar'        =>  self::defaultAvatar(),
                          'register_date' =>  date('Y-m-d'),
                          'last_seen'     =>  date('Y-m-d h:i:s'),
                          'credit'        =>  50, // TODO: Change value to site credit setting
                        ];
                      } else {
                        $error[] = 'Password mismatch';
                      }
                    } else {
                      $error[] = 'Confirm your password';
                    }
                  } else {
                    $error[] = 'Enter your password';
                  }
                } else {
                  $error[] = 'Email is already registered';
                }
              } else {
                $error[] = 'Email is invalid';
              }
            } else {
              $error[] = 'Enter your email';
            }
          } else {
            $error[] = 'Username is already registered';
          }
        } else {
          $error[] = 'Username contains invalid characters, use alphanumeric only';
        }
      } else {
        $error[] = 'Username is too long, 16 alphanumeric characters at most';
      }
    } else {
      $error[] = 'Enter your username';
    }

    if (!isset($error)) {
      if (self::create($data)) {
        $info = 'Registration successful. <a href="'.Site::url().'/login">Login</a>';
        Site::info($info, false, true);
      } else {
        Site::info('Registration failed, try again', true);
      }
    } else {
      Site::info($error);
    }
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
        Database::query("SELECT userID, username, password, level FROM " . self::table() . " WHERE username = :username");

        Database::bind(':username', $username);

        $user = Database::fetchOne();

        if ($user) {
          if (md5($password) == $user->password) {

            self::update(['online_status' => 1], $user->userID);

            $login_key = md5(self::$loginKey);

            if (!$remember) {
              setcookie('ddforum', $username . '_' . $login_key, 0);
            } else {
              setcookie('ddforum', $username . '_' . $login_key, time()+60*60*24*30);
            }

            if (1 == $user->level) {
              Util::redirect(Site::adminUrl());
            } else {
              Util::redirect(Site::url());
            }
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
    if (isset($_COOKIE['ddforum'])) {

      setcookie('ddforum', '', time()-60*60*24*30);

      self::update(['online_status' => 0, 'last_seen' => date('Y-m-d H:i:s')], self::currentUserId());

      return true;
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
    Database::query('SELECT userID FROM ' .self::table() .' WHERE userID = :id');
    Database::bind(':id', $user_id);

    Database::execute();

    if (Database::rowCount() > 0) {
      return true;
    }

    return false;
  }

  public static function findByName($username)
  {
    Database::query('SELECT username FROM ' .self::table() .' WHERE username = :name');
    Database::bind(':name', $username);

    Database::execute();

    if (Database::rowCount() > 0) {
      return true;
    }

    return false;
  }

  public static function findByEmail($email)
  {
    Database::query('SELECT email FROM ' .self::table() .' WHERE email = :email');
    Database::bind(':email', $email);

    Database::execute();

    if (Database::rowCount() > 0) {
      return true;
    }

    return false;
  }

  public static function defaultAvatar()
  {
    if (file_exists(DDFPATH . 'inc/avatar/ddf-avatar.png')) {
      return Site::url() . '/inc/avatar/ddf-avatar.png';
    }

    return null;
  }
}
