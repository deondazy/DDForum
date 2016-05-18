<?php

namespace DDForum\Core;

use DDForum\Core\WrongValueException;

class Filter
{
  /**
   * Class should not be initialized
   */
  private function __construct()
  {
  }

  /**
   * Filter Usernames
   *
   * We only want Alphanumeric characters for usernames
   *
   * @param string $username
   *  The username to filter
   * @return string The filtered username
   */
  public static function username($username)
  {
    if (!ctype_alnum($username)) {
      throw new WrongValueException('Username is invalid, only Alphanumeric characters are allowed');
    }
    return $username;
  }

  /**
   * Filter Password
   *
   * Passwords can contain any combination of characters but must be at least
   * 8 characters long
   *
   * @param string $password
   *   The password to filter
   * @return string The filtered password
   */
  public static function password($password)
  {
    if (!isset($password[7])) {
      throw new WrongValueException('Password must be at least 8 characters long');
    }
    return $password;
  }
}
