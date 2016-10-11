<?php

namespace DDForum\Tests;

use DDForum\Core\Database as DB;

class DatabaseTest extends \PHPUnit_Framework_TestCase
{
    private $pdo;

    public function setup()
    {
        $this->pdo = new \PDO("mysql:host=localhost;dbname=ddforum", 'root', '');
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

    public function testPDOInstance()
    {
        $this->assertInstanceOf('PDO', $this->pdo);
    }

    public function testDatabaseQuery()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `options` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL DEFAULT '',
            `value` longtext NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `name` (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        $query = DB::instance()->query($sql);

        $this->assertInstanceOf('PDOStatement', $query);
    }

    public function testQueryExecution()
    {
        $this->assertTrue(DB::instance()->execute());
    }

    public function testThatATableExists()
    {
        $this->assertTrue(DB::instance()->tableExists('options'));
    }
}
