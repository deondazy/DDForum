<?php

namespace DDForum\Core;

class Attachment extends Base
{
    /**
     * Construct sets the specific table.
     */
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('attachments');
    }

    /**
     * @inheritdoc
     */
    public function get($field, $item = null)
    {
        $where = " WHERE item = :id";

        Database::instance()->query("SELECT $field FROM {$this->table} {$where}");
        Database::instance()->bind(':id', $item);
        if (Database::instance()->fetchOne()) {
            return Database::instance()->fetchOne()->$field;
        }
        return null;
    }

    /**
     * Check if an item exist
     *
     * @param int $id
     * @return bool
     */
    public function exist($id)
    {
        $query = Database::instance()->query("SELECT COUNT('item') FROM {$this->table} WHERE item = :id");
        Database::instance()->bind(':id', $id);
        $query->execute();
        if ($query->fetchColumn() == 0) {
            return false;
        }
        return true;
    }
}
