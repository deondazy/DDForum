<?php

namespace DDForum\Core;

abstract class Base
{
    /**
     * The Database Table;
     *
     * @var string
     */
    protected $table;

    /**
     * Constructor sets the Database Table.
     *
     * @param string $table
     */
    public function __construct($table)
    {
        $this->table = Database::instance()->prefixTable[$table];
    }

    /**
     * Create a new record in the Database
     *
     * @param array $data The data ['column' => 'value'] to insert.
     *
     * @return int The number of inserted rows.
     */
    public function create(Array $data)
    {
        return Database::instance()->insert($this->table, $data);
    }

    /**
     * Get a Value from a specific Column.
     *
     * @param string $field The column to get.
     * @param int $id The id of the value to get.
     *
     * @return mixed
     */
    public function get($field, $id)
    {
        return Database::instance()->get($this->table, $field, $id);
    }

    /**
     * Get all entry from all columns
     *
     * @param string $where The WHERE clause for query.
     * @param string $order ORDER BY.
     *
     * @return array
     */
    public function getAll($where = null, $order = null)
    {
        return Database::instance()->getAll($this->table, $where, $order);
    }

    /**
     * Update a value in a column
     *
     * @param array $data ['colum' => 'value'] for update
     * @param int $id The id of the field to update
     *
     * @return int Number of updated columns
     */
    public function update(Array $data, $id)
    {
        return Database::instance()->update($this->table, $data, $id);
    }

    /**
     * Delete a value from a table's column
     *
     * @param int $id The id of the value to delete
     *
     * @return int
     */
    public function delete($id)
    {
        return Database::instance()->delete($this->table, $id);
    }
    
    /*
     * Count all rows in the table
     * 
     * @return int
     */
    public function count()
    {
        return count($this->getAll());
    }
}
