<?php

namespace DDForum\Core;

class Option
{
    /**
     * Database options table
     *
     * @var string
     */
    private static $table;

    private function __construct()
    {
    }

    private static function table()
    {
        self::$table = Config::get('db_connection')->table_prefix . 'options';
        return self::$table;
    }

    /**
     * Get an option value from database options table
     *
     * @param string $option
     * @return string
     */
    public static function get($option = 'site_name')
    {
        Database::instance()->query(
            "SELECT value FROM ".self::table()." WHERE name = :option"
        );

        Database::instance()->bind(':option', $option);

        return Database::instance()->fetchOne()->value;
    }

    /**
     * Update an option in Database options table
     *
     * @param string $option
     * @param string $value
     * @return int
     */
    public static function set($option, $value)
    {
        $stmt = Database::instance()->query(
            "UPDATE ".self::table()." SET value = :value WHERE name = :option"
        );
        $stmt->bindValue(':value', $value);
        $stmt->bindValue(':option', $option);

        $stmt->execute();

        var_dump($stmt->rowCount());
    }

    /**
     * Add new option to options table
     *
     * @param string $option
     * @param string $value
     * @return int
     */
    public static function add($option, $value)
    {
        Database::instance()->query(
            "INSERT INTO ".self::table()." (name, value) VALUES (:option, :value)"
        );
        Database::instance()->bind(':option', $option);
        Database::instance()->bind(':value', $value);
        Database::instance()->execute();

        return Database::instance()->rowCount();
    }
}
