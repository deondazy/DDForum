<?php

namespace DDForum\Core;

use PDO;
use PDOException;

class Database
{
    /**
     * Database instance
     *
     * @var PDO
     */
    private static $instance;

    /**
     * The active PDO connection.
     *
     * @var PDO
     */
    private $pdo;

    /**
     * The prepared PDOStatement.
     *
     * @var PDOStatement
     */
    private $statement;

    /**
     * The last Query string.
     *
     * @var string
     */
    public $lastQuery;

    /**
     * Connection options.
     *
     * @var array
     */
    private $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];

    /**
     * Last query error message.
     *
     * @var string
     */
    public $errorMessage = null;

    /**
     * DDForum know database tables.
     *
     * @var array
     */
    private $tables = [
        'ads',
        'attachments',
        'badwords',
        'credit_transfer',
        'files',
        'forums',
        'likes',
        'notifications',
        'options',
        'pms',
        'replies',
        'reports',
        'topics',
        'users',
    ];

    /**
     * This class should not be instantiated
     */
    private function __construct()
    {
    }

    /**
     * This class cannot be cloned
     */
    private function __clone()
    {
    }

    /**
     * Database object instance
     */
    public static function instance()
    {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Connect to a database.
     *
     * Sets connection options, and connect to the database
     *
     * @param string $dsn Data Source Name for the database driver
     * @param string $username Database username
     * @param string $password Database password
     *
     * @return PDO A PDO object
     *
     * @throws \DDForum\Core\Exception\DatabaseException
     */
    public function connect($dsn, $username, $password)
    {
        // Are we already connected?
        if ($this->isConnected()) {
            return;
        }

        $options = $this->options;

        try {
            $this->pdo = new \PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new \DDForum\Core\Exception\DatabaseException($e->getMessage());
        }

        return $this->pdo;
    }

    /**
     * Checks if there's an active Database connection.
     *
     * @return bool
     */
    public function isConnected()
    {
        return isset($this->pdo);
    }

    /**
     * Close database connection.
     *
     * @return bool
     */
    public function close()
    {
        $this->pdo = null;
        $this->statement = null;
        $this->lastQuery = null;
        return true;
    }

    /**
     * Check that a table exisits in the database
     *
     * @param string $tableName Name of the table to checkTables
     *
     * @return bool
     */
    public function tableExists($tableName)
    {
        $query = $this->query("SELECT 1 FROM {$tableName} LIMIT 1");
        $this->execute();

        if ($query->columnCount() > 0) {
            return true;
        }

        return false;
    }

    public function databaseTables()
    {
        $dbTtables = [];
        $db = Config::get('db_connection')->dbname;
        $this->query("SHOW TABLES FROM {$db}");
        $tables = $this->fetchOne();

        foreach ($tables as $table) {
            $dbTables[] = $table;
        }

        return $dbTables;
    }

    /**
     * Check if all prefixed Database tables are available.
     *
     * @return bool
     */
    public function checkTables()
    {
        foreach ($this->prefixTables() as $table) {
            if (!$this->tableExists($table)) {
                continue;
            }
            return true;
        }
        return false;
    }

    /**
     * Prepare a query to run against the database.
     *
     * @param string $query
     *
     * @return PDOStatement
     */
    public function query($query)
    {
        $this->connect($this->pdo);

        try {
            $this->statement = $this->pdo->prepare($query);
        } catch (PDOException $e) {
            throw new DatabaseException('Failed to prepare statement');
        }

        if ($this->statement) {
            $this->lastQuery = $query;

            return $this->statement;
        }

        return false;
    }

    /**
     * Bind the inputs with the query placeholders.
     *
     * @param string $param
     * @param string $value
     * @param string $type
     *
     * @return bool
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        return $this->statement->bindValue($param, $value, $type);
    }

    /**
     * Execute the prepared statement.
     *
     * @return bool
     */
    public function execute()
    {
        try {
            return $this->statement->execute();
        } catch (PDOException $e) {
            throw new DatabaseException('Execution of prepared statement failed');
        }
    }

    /**
     * Execute prepared statement and fetch array of all the result set rows.
     *
     * @return array
     */
    public function fetchAll()
    {
        $this->execute();

        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Execute the prepared statement and fetch a single row from the result set.
     *
     * @return object
     */
    public function fetchOne()
    {
        $this->execute();

        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Count the affected rows returned by the last query.
     *
     * @return int
     */
    public function rowCount()
    {
        return $this->statement->rowCount();
    }

    /**
     * The last AUTO_INCREMENTed id for the last INSERT query.
     *
     * @return int
     */
    public function lastInsertId()
    {
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Begins a transaction.
     *
     * @return bool
     */
    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }

    /**
     * Commit the transaction.
     *
     * @return bool
     */
    public function endTransaction()
    {
        return $this->pdo->commit();
    }

    /**
     * Roll back active transaction.
     *
     * @return bool
     */
    public function cancelTransaction()
    {
        return $this->pdo->rollBack();
    }
}
