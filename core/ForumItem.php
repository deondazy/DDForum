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
     * Constructor sets the Database table
     *
     * @param string $table
     * @return string
     */
    public function __construct($table)
    {
        $this->table = Config::get('db_connection')->table_prefix . $table;
        return $this->table;
    }

    /**
     * Create a new item
     *
     * @param array $item
     * @return int
     */
    public function create(array $items)
    {
        $sql = "INSERT INTO {$this->table}";
        $col   = '';
        $val   = '';

        foreach ($items as $column => $value) {
            $col .= "{$column}, ";
            $val .= ":{$column}, "; // use the column names as named parameter
        }

        $col   = rtrim($col, ', '); // Remove last comma(,) on column names
        $val   = rtrim($val, ', '); // Remove last comma(,) on named parameters

        $sql .= " ({$col}) VALUES ({$val})"; // Construct the query

        Database::instance()->query($sql);

        //Bind all parameters
        foreach ($items as $param => $value) {
            Database::instance()->bind(":{$param}", $value);
        }

        return Database::instance()->execute();
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
        $query = "UPDATE {$this->table} SET ";
        $col = '';

        foreach ($data as $column => $value) {
            $col .= "{$column} = :{$column}, "; // use column names as named parameters
        }

        $col = rtrim($col, ', '); // remove last comma(,)
        $query .= $col . " WHERE id = :id";

        if (Database::instance()->query($query)) {
            // Bind :named parameters
            Database::instance()->bind(':id', $id);

            foreach ($data as $param => $value) {
                Database::instance()->bind(":{$param}", $value);
            }

            if (Database::instance()->execute()) {
                return Database::instance()->rowCount();
            }
            return -1;
        }
        return -1;
    }

    /**
     * Delete an item entry from database table
     *
     * @param int $id
     * @return int
     */
    public function delete($id)
    {
        // Does item exist
        if (!$this->itemExist($id)) {
            throw new ItemNotFoundException("You tried to delete an item that does not exist, maybe it was already deleted");
        }

        if (Database::instance()->query("DELETE FROM {$this->table} WHERE id = :id")) {
            if (Database::instance()->bind(':id', $id)) {
                return Database::instance()->rowCount();
            }
            return -1;
        }
        return -1;
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

    /**git ggjj
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
        $query = Database::instance()->query("SELECT COUNT(*) FROM {$this->table} WHERE id = ?");
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
