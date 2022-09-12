<?php

namespace DDForum\Core;

class Config
{
    private static $registry = [];

    /**
     * Checks if an entry exists in the registry
     *
     * @param string $key Key to check for in the registry
     *
     * @return bool
     */
    public static function exists($key)
    {
        return isset(static::$registry[$key]);
    }

    /**
     * Sets a record in the registry
     *
     * @param string $key Array key for the entry
     * @param string $val Value for the entry
     */
    public static function set($key, $val)
    {
        $newConfig = !isset(static::$registry[$key]);

        if (!$newConfig) {
            return;
        }

        if (is_scalar($val)) {
            static::$registry[$key] = $val;
        } else {
            static::$registry[$key] = (object)$val;
        }
    }

    /**
     * Get a record from the registry
     *
     * @param string $key Array key for the record to get
     */
    public static function get($key)
    {
        if (static::exists($key)) {
            return static::$registry[$key];
        }
    }

    /**
     * Get Database name
     *
     * @return string|null
     */
    public static function getDbName()
    {
        if (static::exists('db_connection')) {
            return static::get('db_connection')->dbname;
        }

        return null;
    }

    /**
     * Get Database username
     *
     * @return string|null
     */
    public static function getDbUser()
    {
        if (static::exists('db_connection')) {
            return static::get('db_connection')->user;
        }

        return null;
    }

    /**
     * Get Database password
     *
     * @return string|null
     */
    public static function getDbPassword()
    {
        if (static::exists('db_connection')) {
            return static::get('db_connection')->password;
        }

        return null;
    }

    /**
     * Get Database Table Prefix
     *
     * @return string|null
     */
    public static function getTablePrefix()
    {
        if (static::exists('db_connection')) {
            return static::get('db_connection')->table_prefix;
        }

        return null;
    }
}
