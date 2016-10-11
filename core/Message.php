<?php

namespace DDForum\Core;

class Message
{
    private $table;

    public static function table()
    {
        return Config::get('db_connection')->table_prefix."pms";
    }

    public static function send(array $details)
    {
        $sql = "INSERT INTO ".self::table();
        $col   = '';
        $val   = '';

        foreach ($details as $column => $value) {
            $col .= "`{$column}`, ";
            $val .= ":{$column}, "; // use the column names as named parameter
        }

        $col   = rtrim($col, ', '); // Remove last comma(,) on column names
        $val   = rtrim($val, ', '); // Remove last comma(,) on named parameters

        $sql .= " ({$col}) VALUES ({$val})"; // Construct the query

        Database::instance()->query($sql);

        //Bind all parameters
        foreach ($details as $param => $value) {
            Database::instance()->bind(":{$param}", $value);
        }

        return Database::instance()->execute();
    }
}
