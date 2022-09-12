<?php
/**
 * Base class for Forum, Topic and Reply subclasses
 *
 * @since 1.2
 */

namespace DDForum\Core;

use DDForum\Core\Exception\ItemNotFoundException;

abstract class ForumItem extends Base
{
    /**
     * Check if an item exist
     *
     * @param int $id
     * @return bool
     */
    public function itemExist($id)
    {
        $query = Database::instance()->query("SELECT COUNT('id') FROM {$this->table} WHERE id = :id");
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
