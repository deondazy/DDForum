<?php

namespace DDForum\Core;

use PDO;
use PDOStatement;
use PDOException;
use DDForum\Core\Exception\DatabaseException;

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
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

        // Disable multi query execution
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false
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
     * Database tables with prefix
     *
     * @var array
     */
    public $prefixTable = [];

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
    public function connect($dsn, $username = null, $password = null)
    {
        // Are we already connected?
        if ($this->isConnected()) {
            return;
        }

        if ($dsn instanceof PDO) {
            $this->pdo = $dsn;
        } else {
            $options = $this->options;

            try {
                $this->pdo = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                throw new DatabaseException($e->getMessage());
            }
        }

        // Prefix Database tables
        $this->prefixTables();

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
     * Close database connection (Clean up).
     */
    public function close()
    {
        $this->pdo = null;
        $this->statement = null;
        $this->lastQuery = null;
    }

    /**
     * Check that a table exists in the database
     *
     * @param string $tableName Name of the table to check
     *
     * @return bool
     */
    public function tableExists($tableName)
    {
        $statement = $this->query("SELECT 1 FROM {$tableName} LIMIT 1");

        if ($statement) {
            try {
                $this->execute();
                return (bool) $statement->columnCount();
            } catch (DatabaseException $e) {
                return false;
            }
        }
        return false;
    }

    /*public function databaseTables()
    {
        $dbTtables = [];
        $db = Config::get('db_connection')->dbname;
        $this->query("SHOW TABLES FROM {$db}");
        $tables = $this->fetchOne();

        foreach ($tables as $table) {
            $dbTables[] = $table;
        }

        return $dbTables;
    }*/

    /**
     * Set database tables prefix.
     *
     * @return array
     */
    public function prefixTables()
    {
        foreach ($this->tables as $table) {
            $this->prefixTable[$table] = Config::getTablePrefix().$table;
        }

        return $this->prefixTable;
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
            if ($this->statement instanceof PDOStatement) {
                $this->lastQuery = $this->statement->queryString;
            }
        } catch (PDOException $e) {
            throw new DatabaseException('Failed to prepare statement: '.$e->getMessage());
        }

        return $this->statement;
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
    public function execute(array $param = null)
    {
        try {
            if ($this->statement instanceof PDOStatement) {
                if (!is_null($param)) {
                    return $this->statement->execute();
                }
                return $this->statement->execute($param);
            }
        } catch (PDOException $e) {
            throw new DatabaseException("Execution of prepared statement failed: {$e->getMessage()} in {$e->getFile()} on line {$e->getLine()}");
        }
    }

    public function insert($table, array $data)
    {
        $sql = "INSERT INTO {$table}";
        $col   = '';
        $val   = '';

        foreach ($data as $column => $value) {
            $col .= "{$column}, ";
            $val .= ":{$column}, "; // use the column names as named parameter
        }

        $col = rtrim($col, ', '); // Remove last comma(,) on column names
        $val = rtrim($val, ', '); // Remove last comma(,) on named parameters

        $sql .= " ({$col}) VALUES ({$val})"; // Construct the query

        $this->query($sql);

        //Bind all parameters
        foreach ($data as $param => $value) {
            $this->bind(":{$param}", $value);
        }
        $this->execute();

        return $this->rowCount();
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
        $this->connect($this->pdo);
        return $this->pdo->beginTransaction();
    }

    /**
     * Commit the transaction.
     *
     * @return bool
     */
    public function endTransaction()
    {
        $this->connect($this->pdo);
        return $this->pdo->commit();
    }

    /**
     * Roll back active transaction.
     *
     * @return bool
     */
    public function cancelTransaction()
    {
        $this->connect($this->pdo);
        return $this->pdo->rollBack();
    }
}
