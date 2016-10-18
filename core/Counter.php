<?php

namespace DDForum\Core;

class Counter
{
    protected $table;
    protected $sql;
    protected $where = [];

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function count($item, array $where = [])
    {
        $this->where = $where;
        $this->sql = "SELECT COUNT(id) FROM $this->table";

        switch ($item) {
            case 'forum':
                $sql = $this->forum();
                break;
            case 'topic':
                $sql = $this->topic();
                break;
            case 'reply':
                $sql = $this->reply();
                break;
            default:
                $sql = $this->forum();
        }

        $statement = Database::instance()->query($sql);
        $statement->execute();
        return $statement->fetchColumn();
    }

    protected function forum()
    {
        if (!empty($this->where)) {
            $this->where += [
                'type' => 'all',
                'status' => 'open',
                'visibility' => 'public',
                'parent' => 0,
                'creator' => 0,
            ];
            $this->sql = "SELECT COUNT('id')
                    FROM {$this->table}
                    WHERE `status`     = '{$this->where['status']}'
                    AND `visibility` = '{$this->where['visibility']}'";
            if (0 !== $this->where['creator']) {
                $this->sql .= " AND `creator` = {$this->where['creator']}";
            }
            if (0 !== $this->where['parent']) {
                $this->sql .= " AND `parent` = {$this->where['parent']}";
            }
            if ('all' === $this->where['type']) {
                $this->sql .= " AND `type` = 'forum' OR 'category'";
            } else {
                $this->sql .= " AND `type` = '{$this->where['type']}'";
            }
        }

        return $this->sql;
    }

    protected function topic()
    {
        if (!empty($this->where)) {
            $this->where += [
                'status' => 'open',
                'sticky' => false,
                'pinned' => false,
                'forum' => 0,
                'poster' => 0,
            ];
            $this->sql = "SELECT COUNT('id')
                          FROM {$this->table}
                          WHERE `status` = '{$this->where['status']}'";
            if (0 !== $this->where['forum']) {
                $this->sql .= " AND `forum` = {$this->where['forum']}";
            }
            if (0 !== $this->where['poster']) {
                $this->sql .= " AND `poster` = {$this->where['poster']}";
            }
            if (false !== $this->where['pinned']) {
                $this->sql .= " AND `pinned` = 1";
            }
            if (false !== $this->where['sticky']) {
                $this->sql .= " AND `sticky` = 1";
            }
        }

        return $this->sql;
    }

    protected function reply()
    {
        if (!empty($this->where)) {
            $this->where += [
                'forum'  => 0,
                'topic'  => 0,
                'parent' => 0,
                'poster' => 0,
            ];
            $this->sql = "SELECT COUNT('id')
                          FROM {$this->table}
                          WHERE `parent` = '{$this->where['parent']}'";

            if (0 !== $this->where['forum']) {
                $this->sql .= " AND `forum` = {$this->where['forum']}";
            }
            if (0 !== $this->where['poster']) {
                $this->sql .= " AND `poster` = {$this->where['poster']}";
            }
            if (0 !== $this->where['topic']) {
                $this->sql .= " AND `topic` = {$this->where['topic']}";
            }
            if (0 !== $this->where['parent']) {
                $this->sql .= " AND `parent` = {$this->where['parent']}";
            }
        }

        return $this->sql;
    }
}
