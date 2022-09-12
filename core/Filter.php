<?php

namespace DDForum\Core;

use DDForum\Core\Exception\WrongValueException;

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
     * We only want Alphanumeric characters for usernames that's at least
     * 3 characters long but not more than 16 characters
     *
     * @param string $username The username to filter
     *
     * @return string The filtered username
     */
    public static function username($username)
    {
        if (!ctype_alnum($username)) {
            throw new WrongValueException('Username is invalid, only Alphanumeric characters are allowed');
        }

        if (strlen($username) < 2 || strlen($username) > 16) {
            throw new WrongValueException('Username must be 3 to 16 characters long');
        }

        return $username;
    }

    /**
     * Filter Password
     *
     * Passwords can contain any combination of characters but must be at least
     * 8 characters long
     *
     * @param string $password The password to filter
     *
     * @return string The filtered password
     */
    public static function password($password)
    {
        if (!isset($password[7])) {
            throw new WrongValueException('Password must be at least 8 characters long');
        }

        return $password;
    }

    /**
     * Filter Email
     *
     * Email must be a valid email address
     *
     * @param string $email The email address to filter
     *
     * @return string The filtered email
     */
    public static function email($email)
    {
        if (!preg_match('/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/', $email)) {
            throw new WrongValueException('Email address is invalid');
        }

        return $email;
    }
}
