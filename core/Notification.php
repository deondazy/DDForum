<?php

namespace DDForum\Core;

class Notification
{
    protected $table;

    public function __construct($table = null)
    {
        $this->table = ($table) ?: Database::instance()->prefixTable['notifications'];
    }

    /**
     * Create a new notification
     *
     * @param array $items The notification data
     *
     * @return int
     */
    public function create(array $items)
    {
        return Database::instance()->insert($this->table, $items);
    }

    public function count()
    {
        $counter = new Counter($this->table);
        return $counter->count('notification');
    }

    public function getAll()
    {
        $to = "`to` = ". User::currentUserId();
        return Database::instance()->getAll($this->table, $to, '`date` ASC');
    }
}
