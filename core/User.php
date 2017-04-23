<?php

namespace DDForum\Core;

class User extends Base
{
    /**
     * The Logged user username
     *
     * @var string
     */
    public $username;

    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('users');
    }

    public function __get($field)
    {
        Database::instance()->query("SELECT {$field} FROM {$this->table} WHERE username = :username");
        Database::instance()->bind(':username', $this->username);
        return Database::instance()->fetchOne()->$field;
    }

    /**
     * @inheritdoc
     */
    public function get($field, $id = null)
    {
        $id = ($id) ?: $this->currentUserId();
        return parent::get($field, $id);
    }

    /**
     * Check if a user is logged.
     *
     * @return bool
     */
    public function isLogged()
    {
        if (isset($_COOKIE['ddforum'])) {
            // Is cookie valid?
            list($username, $hash) = explode('_', $_COOKIE['ddforum']);
            $query = Database::instance()->query(
                "SELECT COUNT(id) FROM {$this->table} WHERE username = :username"
            );
            $query->bindValue(':username', $username);
            $query->execute();
            if ($query->fetchColumn() > 0) {
                $this->username = $username;
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Retrieve the id of logged user.
     *
     * @return int
     */
    public function currentUserId()
    {
        if ($this->isLogged()) {
            $id = Database::instance()->query("SELECT id FROM {$this->table} WHERE username = :username");
            Database::instance()->bind(':username', $this->username);
            return (int)Database::instance()->fetchOne()->id;
        }
        return 0;
    }

    /**
     * Check if user is an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        if ($this->isLogged()) {
            $level = $this->level;
            if (1 == $level) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Translate level number to it's name
     *
     * @param int $level The Level integer representation
     *
     * @return bool
     */
    public function level($level)
    {
        if (is_numeric($level)) {
            switch ($level) {
                case '0':
                    return 'Normal user';
                case '1':
                    return 'Administrator';
                case '2':
                    return 'Moderator';
                default:
                    return 'Normal user';
            }
        }
        return 'Normal user';
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

    /**
     * Check if user exist
     *
     * @param int|string $user The username or id for user to Check
     *
     * @return bool
     */
    public function exist($user)
    {
        if (is_numeric($user)) {
            $where = ' WHERE id = :user';
        } elseif (false !== strpos($user, '@')) {
            $where = ' WHERE email = :user';
        } else {
            $where = ' WHERE username = :user';
        }
        $query = Database::instance()->query("SELECT COUNT('id') FROM {$this->table} {$where}");
        $query->bindValue(':user', $user);
        $query->execute();
        if ($query->fetchColumn() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Find user by username
     *
     * @param string $username
     *
     * @return null|object
     */
    public function findByName($username)
    {
        $query = Database::instance()->query("SELECT * FROM {$this->table} WHERE username = :name");
        $query->bindValue(':name', $username);
        $query->execute();
        if ($query->fetchColumn() > 0) {
            return Database::instance()->fetchAll()[0];
        }
        return null;
    }

    /**
     * Find user by email
     *
     * @param string $email
     *
     * @return null|object
     */
    public function findByEmail($email)
    {
        $query = Database::instance()->query("SELECT * FROM {$this->table} WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();
        if ($query->fetchColumn() > 0) {
            return Database::instance()->fetchAll()[0];
        }
        return null;
    }

    public static function defaultAvatar()
    {
        if (file_exists(DDFPATH.'inc/avatar/ddf-avatar.png')) {
            return Installer::guessUrl().'/inc/avatar/ddf-avatar.png';
        }
    }

    /**
     * The total number of topics and replies posted by user
     *
     */
    public function postCount($userId)
    {
        global $topic, $reply;
        return $topic->count($userId, 'poster') + $reply->count($userId, 'poster');
    }
}
