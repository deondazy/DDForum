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
    
    /**
     * @inheritdoc
     */
    public function count($value = 0, $feild = 'topic')
    {
        if (0 !== $value) {
            return count($this->getAll("{$feild} = '{$value}'"));
        }
        return parent::count();
    }
}
