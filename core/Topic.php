<?php

namespace DDForum\Core;

class Topic extends ForumItem
{
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('topics');
    }

    /**
     * @inheritdoc
     */
    public function count($value = 0, $feild = 'forum')
    {
        if (0 !== $value) {
            return count($this->getAll("{$feild} = '{$value}'"));
        }
        return parent::count();
    }

    public function getPinned()
    {
        Database::instance()->query("SELECT * FROM {$this->table} WHERE pinned = 1 ORDER BY create_date DESC");
        return Database::instance()->fetchAll();
    }

    public function getRecent()
    {
        Database::instance()->query("SELECT * FROM {$this->table} ORDER BY create_date DESC");
        return Database::instance()->fetchAll();
    }

    public function getTrending()
    {
        Database::instance()->query("SELECT * FROM {$this->table} WHERE pinned = 1 ORDER BY create_date DESC");
        return Database::instance()->fetchAll();
    }

    public function countReplies($topic_id)
    {
        Database::instance()->query("SELECT * FROM ".Config::get('db_connection')->table_prefix."replies WHERE topic = :topic_id");
        Database::instance()->bind(':topic_id', $topic_id);
        Database::instance()->execute();
        return Database::instance()->rowCount();
    }

    public function check($item, $value, $topicId)
    {
        Database::instance()->query("SELECT {$item} FROM {$this->table} WHERE {$item} = :value AND id = :topic_id");
        Database::instance()->bind(':topic_id', $topicId);
        Database::instance()->bind(':value', $value);
        Database::instance()->execute();

        if (Database::instance()->rowCount() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Check if a topic is locked
     *
     * @param int $id The id of the post to check
     *
     * @return bool
     */
    public function isLocked($id)
    {
        return $this->check('status', 'locked', $id);
    }

    public function addView($id)
    {
        $view = $this->get('views', $id);
        $addView = $view + 1;
        return $this->update(['views' => $addView], $id);
    }
}
