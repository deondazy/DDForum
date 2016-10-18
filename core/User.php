<?php

namespace DDForum\Core;

class User
{
    /**
     * Current user's username.
     *
     * @var string
     */
    public static $username;

    /**
     * User access error.
     *
     * @var array
     */
    public $error = [];

    public function __construct()
    {
        self::isLogged();
    }

    private static function table()
    {
        return Config::get('db_connection')->table_prefix . 'users';
    }

    public function __get($field)
    {
        Database::instance()->query("SELECT {$field} FROM ".self::table().' WHERE username = :username');
        Database::instance()->bind(':username', self::$username);

        return Database::instance()->fetchOne()->$field;
    }

    /**
     * Create new User.
     *
     * @param array $user
     *
     * @return bool
     */
    public static function create(array $user)
    {
        $query = 'INSERT INTO '.self::table();
        $col = '';
        $val = '';

        foreach ($user as $column => $value) {
            $col .= "{$column}, ";
            $val .= ":{$column}, ";
        }

        $col = rtrim($col, ', ');
        $val = rtrim($val, ', ');
        $query .= ' ('.$col.') VALUES ('.$val.')';

        Database::instance()->query($query);

        foreach ($user as $param => $value) {
            Database::instance()->bind(":{$param}", $value);
        }

        return Database::instance()->execute();
    }

    /**
     * Check if a user is logged.
     *
     * @return bool
     */
    public static function isLogged()
    {
        if (isset($_COOKIE['ddforum'])) {
            // Is cookie valid?
            list($username, $hash) = preg_split('/_/', $_COOKIE['ddforum']);

            Database::instance()->query('SELECT COUNT(*) FROM '.self::table().' WHERE username = :username');
            Database::instance()->bind(':username', $username);
            Database::instance()->execute();

            if (Database::instance()->rowCount() > 0) {
                self::$username = $username;

                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * Retrieve the current userId of logged user.
     *
     * @return bool
     */
    public static function currentUserId()
    {
        if (self::isLogged()) {
            $userId = Database::instance()->query('SELECT id FROM '.self::table().' WHERE username = :username');
            Database::instance()->bind(':username', self::$username);

            return Database::instance()->fetchOne()->id;
        }

        return 0;
    }

    /**
     * Get all users.
     */
    public static function getAll($id = null)
    {
        $sql = 'SELECT * FROM ' . self::table();

        if (!is_null($id)) {
            $sql .= ' WHERE id = :id';
        }

        Database::instance()->query($sql);
        Database::instance()->bind(':id', $id);

        return Database::instance()->fetchAll();
    }

    /**
     * Retrieve info for user with passed $id.
     *
     * @param string $field
     *   The field to retrieve
     * @param string $id
     *   ID of user to retrieve info for | current_user
     *
     * @return string
     *   Returns the user info for specified field or false if user doesn't exist
     */
    public static function get($field, $id = 'current_user')
    {
        if ('current_user' == $id) {
            $id = self::currentUserId();
        }

        Database::instance()->query("SELECT $field FROM ".self::table()." WHERE id = $id");

        $info = Database::instance()->fetchOne();

        if (!$info) {
            return false;
        }

        return $info->$field;
    }

    /**
     * Update user data.
     *
     * @param array $data
     *   Array of key => value pairs for update
     * @param int $id
     *   The userID for user to update
     *
     * @return int
     */
    public static function update(array $data, $id)
    {
        $query = 'UPDATE '.self::table().' SET ';
        $col = '';

        foreach ($data as $column => $value) {
            $col .= "$column = :$column, ";
        }

        $col = rtrim($col, ', ');
        $query .= $col.' WHERE id = :id';

        Database::instance()->query($query);

        Database::instance()->bind(':id', $id);

        foreach ($data as $param => $value) {
            Database::instance()->bind(":{$param}", $value);
        }

        Database::instance()->execute();

        return Database::instance()->rowCount();
    }

    /**
     * Check if user is an administrator.
     *
     * @return bool
     */
    public static function isAdmin()
    {
        if (self::isLogged()) {
            $level = self::get('level');

            if (1 == $level) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * Login user
     *
     * @param string $username User supplied username.
     * @param string $password User supplied password.
     * @param bool $remember Keep user logged in after session? Default to false.
     */
    public static function login($username, $password, $remember = false)
    {
        if (!empty($username)) {
            if (!empty($password)) {
                Database::instance()->query('SELECT id, username, password, level FROM '.self::table().' WHERE username = :username');

                Database::instance()->bind(':username', $username);

                $user = Database::instance()->fetchOne();

                if ($user) {
                    if (password_verify($password, $user->password)) {
                        self::update(['online_status' => 1], $user->id);

                        $login_key = md5(self::$loginKey);

                        if (!$remember) {
                            setcookie('ddforum', $username.'_'.$login_key, 0);
                        } else {
                            setcookie('ddforum', $username.'_'.$login_key, time() + 60 * 60 * 24 * 30);
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
        $query = Database::instance()->query('SELECT COUNT(*) FROM '.Config::get('db_connection')->table_prefix.'topics WHERE poster = :id');

        Database::instance()->bind(':id', $user_id);

        Database::instance()->execute();

        return $query->fetchColumn();
    }

    public static function replyCount($user_id)
    {
        $query = Database::instance()->query('SELECT COUNT(*) FROM '.Config::get('db_connection')->table_prefix.'replies WHERE poster = :id');

        Database::instance()->bind(':id', $user_id);

        Database::instance()->execute();

        return $query->fetchColumn();
    }

    public static function topics($user_id)
    {
        Database::instance()->query('SELECT * FROM '.Config::get('db_connection')->table_prefix.'topics WHERE poster = :id ORDER BY create_date DESC');
        Database::instance()->bind(':id', $user_id);

        return Database::instance()->fetchAll();
    }

    public static function paginate($order = 'userID DESC', $limit = null, $offset = 1)
    {
        $query = '';

        if (!empty($order)) {
            $query .= ' ORDER BY '.$order;
        }
        if (!empty($limit)) {
            $query .= ' LIMIT '.$offset.', '.$limit;
        }

        Database::instance()->query(Database::instance()->lastQuery.$query);

        return Database::instance()->fetchAll();
    }

    public static function exist($user_id)
    {
        Database::instance()->query('SELECT id FROM '.self::table().' WHERE id = :id');
        Database::instance()->bind(':id', $user_id);

        Database::instance()->execute();

        if (Database::instance()->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public static function findByName($username)
    {
        Database::instance()->query('SELECT * FROM '.self::table().' WHERE username = :name');
        Database::instance()->bind(':name', $username);

        Database::instance()->execute();

        if (Database::instance()->rowCount() > 0) {
            return Database::instance()->fetchAll()[0];
        }

        return false;
    }

    public static function findByEmail($email)
    {
        Database::instance()->query('SELECT * FROM '.self::table().' WHERE email = :email');
        Database::instance()->bind(':email', $email);

        Database::instance()->execute();

        if (Database::instance()->rowCount() > 0) {
            return Database::instance()->fetchOne();
        }

        return false;
    }

    public static function defaultAvatar()
    {
        if (file_exists(DDFPATH.'inc/avatar/ddf-avatar.png')) {
            return Site::url().'/inc/avatar/ddf-avatar.png';
        }
    }
}
