<?php

namespace DDForum\Tests;

use DDForum\Core\Database as DB;
use DDForum\Core\Forum;

class ForumTest extends \PHPUnit_Framework_TestCase
{
    protected $pdo;
    protected $forum;

    public function setup()
    {
        $this->pdo = DB::instance()->connect("sqlite::memory:");
        $this->createTable();
        $this->fillTable();
        $this->forum = new Forum('test_forums');
    }

    protected function createTable()
    {
        DB::instance()->connect($this->pdo);
        $stmt = "CREATE TABLE test_forums (
            id   INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(10) NOT NULL,
            message VARCHAR(10) NOT NULL
        )";
        DB::instance()->query($stmt);
        DB::instance()->execute();
    }

    protected function fillTable()
    {
        $forums = [
            'id' => 1,
            'name' => 'Forum name 1',
            'message' => 'Forum message 1',
        ];
        DB::instance()->insert('test_forums', $forums);
    }

    public function testGetForum()
    {
        $this->assertEquals('Forum name 1', $this->forum->get('name', 1));
    }

    public function testCreateForum()
    {
        $forum = [
            'id' => 2,
            'name' => 'Forum name 2',
            'message' => 'Forum message 2',
        ];
        $this->forum->create($forum);
        $this->forum->create(
            [
                'id' => 3,
                'name' => 'Forum name 3',
                'message' => 'Forum message 3'
            ]
        );
        $this->assertEquals('Forum name 2', $this->forum->get('name', 2));
    }

    public function testUpdateForum()
    {
        $this->forum->update(['name' => 'Updated name 3'], 3);
        $this->assertEquals('Updated name 3', $this->forum->get('name', 3));
    }

    public function testDeleteForum()
    {
        $actual = $this->forum->delete(3);
        $this->assertEquals(1, $actual);
    }

    public function testForumExists()
    {
        $this->assertTrue($this->forum->itemExist(1));
        $this->assertFalse($this->forum->itemExist(208));
    }

    public function testPagination()
    {
        $this->forum->getAll();
        $pagination = $this->forum->paginate(2, 1, 'id')[0];
        $this->assertObjectHasAttribute('name', $pagination);
    }
    
    public function testDropDown()
    {
        $dropdown = $this->forum->dropdown([
            'id' => 'id',
            'name' => 'name',
            'class' => 'class1 class2',
        ]);
        $this->assertStringStartsWith('<select id="id" name="name" class="class1 class2">', $dropdown);
        $this->assertStringEndsWith('</select>', $dropdown);
    }
}
