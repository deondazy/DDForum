<?php

namespace DDForum\Tests;

use DDForum\Core\Database as DB;
use DDForum\Core\Forum;

class ForumTest extends \PHPUnit_Framework_TestCase
{
    private $pdo;
    private $forum;

    public function setup()
    {
        $this->pdo = new \PDO("sqlite::memory:");

        $this->createForumsTable();
        $this->insertForums();

        $this->forum = new Forum('testdbforums');
    }

    private function createForumsTable()
    {
        DB::instance()->connect($this->pdo);

        $stmt = "CREATE TABLE testdbforums (
            id   INTEGER PRIMARY KEY AUTOINCREMENT,
            subject VARCHAR(10) NOT NULL,
            message VARCHAR(10) NOT NULL
        )";

        DB::instance()->query($stmt);
        DB::instance()->execute();
    }

    private function insertForums()
    {
        $forums = [
            'id' => 1,
            'subject' => 'Forum subject 1',
            'message' => 'Forum message 1',
        ];

        DB::instance()->insert('testdbforums', $forums);
    }

    public function testGetForum()
    {
        $this->assertEquals('Forum subject 1', $this->forum->get('subject', 1));
    }

    public function testCreateForum()
    {
        $forum = [
            'id' => 2,
            'subject' => 'Forum subject 2',
            'message' => 'Forum message 2',
        ];
        $this->forum->create($forum);
        $this->forum->create(
            [
                'id' => 3,
                'subject' => 'Forum subject 3',
                'message' => 'Forum message 3'
            ]
        );
        $this->assertEquals('Forum subject 2', $this->forum->get('subject', 2));
    }

    public function testUpdateForum()
    {
        $this->forum->update(['subject' => 'Updated subject 3'], 3);
        $this->assertEquals('Updated subject 3', $this->forum->get('subject', 3));
    }

    public function testDeleteForum()
    {
        $actual = $this->forum->delete(3);
        $this->assertEquals(1, $actual);
    }

    public function testForumExists()
    {
        $this->assertTrue($this->forum->itemExist(1));
    }
}
