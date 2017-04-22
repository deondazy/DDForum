<?php

namespace DDForum\Core;

class Message extends Base
{
    /**
     * Construct sets the specific table.
     */
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('pms');
    }

    public function send(array $details)
    {
        return $this->create($details);
    }

    public function count()
    {
        $counter = new Counter($this->table);
        return $counter->count('message');
    }
}
