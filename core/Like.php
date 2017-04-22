<?php

namespace DDForum\Core;

class Like extends Base
{
    /**
     * Construct sets the specific table.
     */
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('likes');
    }

    /**
     * @inheritdoc
     */
    public function count($value = 0, $feild = 'item')
    {
        if (0 !== $value) {
            return count($this->getAll("{$feild} = '{$value}'"));
        }
        return parent::count();
    }

    public function like(array $data)
    {
        return $this->create($data);
    }

    public function unlike($item, $user)
    {
        Database::instance()->query("DELETE FROM {$this->table} WHERE item = :item AND liker = :user");
        Database::instance()->bind(':item', $item);
        Database::instance()->bind(':user', $user);
        return Database::instance()->execute();
    }

    public function isLiked($item, $user)
    {
        $liked = $this->getAll("item = {$item} AND liker = {$user}");
        if (!empty($liked)) {
            return true;
        }
        return false;
    }
}
