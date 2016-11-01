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
    public function count($topicId = 0)
    {
        if (0 !== $topicId) {
            return count($this->getAll("topic = '$topicId'"));
        }
        return parent::count();
    }
}
