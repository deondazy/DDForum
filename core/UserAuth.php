<?php

namespace DDForum\Core;

use DDForum\Core\Exception\WrongValueException;

class UserAuth
{
    /**
     * Random login Key.
     *
     * @var string
     */
    private static $loginKey = 'TYgt%gfdrt=1&778h#$&jk';

    /**
     * Register user.
     *
     * @param array $data Array of supplied user details
     *
     * @throws DDForum\Core\Exception\WrongValueException
     */
    public static function register(array $user)
    {
        // username is required
        if (!empty($user['username'])) {
            Filter::username($user['username']);
            // Check if username is already taken
            if (!User::findByName($user['username'])) {
                // Password is required
                if (!empty($user['password'])) {
                    // Filter password for length
                    Filter::password($user['password']);
                    // Password confirmation is required
                    if (!empty($user['password2'])) {
                        // Does the 2 passwords match
                        if ($user['password'] == $user['password2']) {
                            // Encrypt the password
                            $password  = password_hash($user['password'], PASSWORD_DEFAULT);

                            // email is required
                            if (!empty($user['email'])) {
                                // Check if email is valid
                                Filter::email($user['email']);
                                // Check if email is already taken
                                if (!User::findByEmail($user['email'])) {
                                    $data = [
                                        'username'      => $user['username'],
                                        'password'      => $password,
                                        'email'         => $user['email'],
                                        'display_name'  => $user['username'],
                                        'country'       => $user['country'],
                                        'birth_day'     => $user['birth_day'],
                                        'birth_month'   => $user['birth_month'],
                                        'birth_year'    => $user['birth_year'],
                                        'age'           => date('Y') - $_POST['year'],
                                        'gender'        => $user['gender'],
                                        'avatar'        => User::defaultAvatar(),
                                        'register_date' => date('Y-m-d'),
                                        'last_seen'     => date('Y-m-d h:i:s'),
                                        'credit'        => 50, // TODO: Change value to site credit setting
                                    ];
                                } else {
                                    throw new WrongValueException('Email is already registered');
                                }
                            } else {
                                throw new WrongValueException('Enter your email');
                            }
                        } else {
                            throw new WrongValueException('Password mismatch');
                        }
                    } else {
                        throw new WrongValueException('Confirm your password');
                    }
                } else {
                    throw new WrongValueException('Enter your password');
                }
            } else {
                throw new WrongValueException('Username is already registered');
            }
        } else {
            throw new WrongValueException('Enter your username');
        }

        if (User::create($data)) {
            Site::info('Registration successful. <a href="' . Site::url() . '/login">Login</a>', false, true);
        } else {
            throw new WrongValueException('Registration failed, try again');
        }
    }

    /**
     * Login user
     *
     * @param string $username User supplied username.
     * @param string $password User supplied password.
     * @param bool $remember Keep user logged in after session? Default to false.
     *
     * @throws DDForum\Core\Exception\WrongValueException
     */
    public static function login($username, $password, $remember = false)
    {
        // Username is required
        if (!empty($username)) {
            // Does this user exist?
            $user = User::findByName($username);

            if ($user) {
                // Password is required
                if (!empty($password)) {
                    if (password_verify($password, $user->password)) {
                        User::update(['online_status' => 1], $user->id);

                        $loginKey = md5(self::$loginKey);

                        if (!$remember) {
                            setcookie('ddforum', $username.'_'.$loginKey, 0, preg_replace('|https?://[^/]+|i', '', Site::url() . '/'));
                        } else { // Store cookie for a month
                            setcookie('ddforum', $username.'_'.$loginKey, time() + 60 * 60 * 24 * 30, preg_replace('|https?://[^/]+|i', '', Site::url() . '/'));
                        }

                        // Where to send user after a successful login
                        if (1 == $user->level) { // User is an Administrator
                            Util::redirect(Site::adminUrl());
                        }

                        Util::redirect(Site::url());
                    } else {
                        throw new WrongValueException('Your password is incorrect');
                    }
                } else {
                    throw new WrongValueException('Enter your password');
                }
            } else {
                throw new WrongValueException('Username is not registered');
            }
        } else {
            throw new WrongValueException('Enter your username');
        }
    }

    /**
     * Log user out.
     */
    public static function logout()
    {
        if (isset($_COOKIE['ddforum'])) {
            setcookie('ddforum', '', time() - 60 * 60 * 24 * 30, preg_replace('|https?://[^/]+|i', '', Site::url() . '/'));

            User::update(['online_status' => 0, 'last_seen' => date('Y-m-d H:i:s')], User::currentUserId());

            return true;
        }

        return false;
    }
}
