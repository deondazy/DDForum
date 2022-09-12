<?php

namespace DDForum\Core;

class Option
{
    /**
     * Database options table
     *
     * @var string
     */
    protected $table;

    public function __construct($table = null)
    {
        $this->table = ($table) ?: Database::instance()->prefixTable['options'];
    }

    /**
     * Get an option value from database options table
     *
     * @param string $option
     * @return string
     */
    public function get($option = 'site_name')
    {
        Database::instance()->query(
            "SELECT value FROM {$this->table} WHERE name = :option"
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
    public function set($option, $value)
    {
        $stmt = Database::instance()->query(
            "UPDATE {$this->table} SET value = :value WHERE name = :option"
        );
        $stmt->bindValue(':value', $value);
        $stmt->bindValue(':option', $option);

        return $stmt->execute();
    }

    /**
     * Add new option to options table
     *
     * @param string $option
     * @param string $value
     * @return int
     */
    public function add($option, $value)
    {
        Database::instance()->query(
            "INSERT INTO {$this->table} (name, value) VALUES (:option, :value)"
        );
        Database::instance()->bind(':option', $option);
        Database::instance()->bind(':value', $value);
        Database::instance()->execute();

        return Database::instance()->rowCount();
    }
}
