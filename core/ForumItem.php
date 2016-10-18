<?php
/**
 * Base class for Forum, Topic and Reply subclasses
 *
 * @since 1.2
 */

namespace DDForum\Core;

use DDForum\Core\Exception\ItemNotFoundException;

abstract class ForumItem
{
    /**
     * Database table
     *
     * @var string
     */
    protected $table;

    /**
     * Total number of rows in item table
     *
     * @var int
     */
    public $count;

    /**
     * Constructor sets the Database table to use
     *
     * @param string $table The Database table
     */
    public function __construct($table)
    {
        $this->table = Database::instance()->prefixTable[$table];
    }

    /**
     * Create a new item
     *
     * @param array $item
     *
     * @return bool
     */
    public function create(array $items)
    {
        return Database::instance()->insert($this->table, $items);
    }

    /**
     * Update an item's value
     *
     * @param array $data
     * @param int $id
     * @return int
     */
    public function update(array $data, $id)
    {
        return Database::instance()->update($this->table, $id, $data);
    }

    /**
     * Delete an item entry from database table
     *
     * @param int $id
     * @return int
     */
    public function delete($id)
    {
        return Database::instance()->delete($this->table, $id);
    }

    /**
     * Get result of a single entry column
     *
     * @param string $field
     * @param int $id
     * @return string
     */
    public function get($field, $id = 0)
    {
        Database::instance()->query("SELECT $field FROM {$this->table} WHERE id = :id");
        Database::instance()->bind(':id', $id);
        if (Database::instance()->fetchOne()) {
            return Database::instance()->fetchOne()->$field;
        }
        return null;
    }

    /**
     * Get all entry columns
     *
     * @return array
     */
    public function getAll($where = null, $order = "create_date DESC")
    {
        $result = [];

        $query = "SELECT * FROM {$this->table} ";

        if (!is_null($where)) {
            $query .= "WHERE {$where} ";
        }

        $query .= "ORDER BY {$order}";

        Database::instance()->query($query);

        $result = Database::instance()->fetchAll();

        return $result;
    }

    /**
     * Check if an item exist
     *
     * @param int $id
     * @return bool
     */
    public function itemExist($id)
    {
        $query = Database::instance()->query("SELECT COUNT(*) FROM {$this->table} WHERE id = :id");
        Database::instance()->bind(':id', $id);
        $query->execute();

        if ($query->fetchColumn() == 0) {
            return false;
        }

        return true;
    }

    /**
     * Paginate item result set
     *
     * @param int $limit
     * @param  int $offset
     * @param string $order
     * @return object
     */
    public function paginate($limit = 10, $offset = 1, $order = null)
    {
        $result = [];

        $query = "";

        if (!is_null($order)) {
            $query .= " ORDER BY {$order}";
        }

        if (!empty($limit)) {
            $query .= " LIMIT {$offset}, {$limit}";
        }

        Database::instance()->query(Database::instance()->lastQuery.$query);
        $result = Database::instance()->fetchAll();

        return $result;
    }
}
