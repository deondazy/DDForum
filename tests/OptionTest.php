<?php

namespace DDForum\Tests;

use DDForum\Core\Database as DB;
use DDForum\Core\Option;

class OptionTest extends \PHPUnit_Framework_TestCase
{
    private $pdo;
    private $option;

    public function setup()
    {
        $this->pdo = new \PDO("sqlite::memory:");

        $this->createOptionsTable();
        $this->insertOptions();

        $this->option = new Option('testdboptions');
    }

    private function createOptionsTable()
    {
        DB::instance()->connect($this->pdo);

        $stmt = "CREATE TABLE testdboptions (
            id   INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(10) NOT NULL,
            value VARCHAR(10) NOT NULL
        )";

        DB::instance()->query($stmt);
        DB::instance()->execute();
    }

    private function insertOptions()
    {
        $options = [
            'name' => 'site_name',
            'value' => 'DDForum',
        ];

        DB::instance()->insert('testdboptions', $options);
    }

    public function testGetOption()
    {
        $this->assertEquals('DDForum', $this->option->get('site_name'));
    }

    public function testAddOption()
    {
        $this->option->add('site_admin', 'Deon Dazy');
        $this->option->add('site_description', 'PHP Forum');
        $this->assertEquals('Deon Dazy', $this->option->get('site_admin'));
    }

    public function testSetOption()
    {
        $this->option->set('site_description', 'My website');
        $this->assertEquals('My website', $this->option->get('site_description'));
    }
}
