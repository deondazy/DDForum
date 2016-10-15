<?php

namespace DDForum\Tests;

use DDForum\Core\Database as DB;
use DDForum\Core\Config;
use PDO;

class DatabaseTest extends \PHPUnit_Framework_TestCase
{
    private $pdo;

    private $data = [
        'name' => 'Matt',
        2 => 'Mark',
        3 => 'Luke',
        4 => 'John',
        5 => 'Andrew',
        6 => 'Philip',
        7 => 'James',
        8 => 'Sam',
        9 => 'Anthony',
        10 => 'Francis'
    ];

    public function setup()
    {
        if (!extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped("Need 'pdo_sqlite' to test in memory.");
        }

        include dirname(dirname(__FILE__)) .'/config.php';

        $this->pdo = new PDO("sqlite::memory:");
        $this->createTable();
    }

    public function testDatabaseConnection()
    {
        // Connect to the Database
        DB::instance()->connect($this->pdo);
        $this->assertTrue(DB::instance()->isConnected());

        // Disconnect
        DB::instance()->close();
        $this->assertFalse(DB::instance()->isConnected());

        // Reconnect
        DB::instance()->connect($this->pdo);
        $this->assertTrue(DB::instance()->isConnected());
    }

    private function createTable()
    {
        DB::instance()->connect($this->pdo);

        $stmt = "CREATE TABLE testdb (
            id   INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(10) NOT NULL
        )";

        DB::instance()->query($stmt);
        DB::instance()->execute();
    }

    public function testInsert()
    {
        foreach ($this->data as $value) {
            DB::instance()->insert('testdb', ['name' => $value]);
        }

        DB::instance()->query("SELECT * FROM testdb");
        $result = DB::instance()->fetchAll();
        $expect = 10;
        $actual = count($result);
        $this->assertEquals($expect, $actual);
    }

    public function testTableExists()
    {
        // Existing table test
        $this->assertTrue(DB::instance()->tableExists('testdb'));

        // Existing table test
        $this->assertFalse(DB::instance()->tableExists('notable'));
    }

    public function testTablePrefixingWorks()
    {
        $this->assertEquals(Config::getTablePrefix().'options', DB::instance()->prefixTable['options']);
    }

    public function testFetchAll()
    {
    }
}
