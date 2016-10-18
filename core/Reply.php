<?php

namespace DDForum\Core;

class Reply extends ForumItem
{
    /**
     * Construct sets the specific table
     */
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('replies');
    }
}
