<?php

namespace DDForum\Core;

class Database
{
  /**
   * The active PDO connection
   *
   * @var PDO|null
   */
  private static $pdo = null;

  /**
   * The last query string
   *
   * @var string|null
   */
  public static $statement;
  public static $lastQuery;

  /**
   * Connection options
   *
   * @var array
   */
  private static $options = [];

  /**
   * Last query error message
   *
   * @var string|null
   */
  public static $error = null;

  /**
   * DDForum know database tables
   *
   * @var array
   */
  private static $tables = [
    'ads',
    'attachments',
    'badwords',
    'categories',
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
   * Prefixed Database Tables
   *
   * @var array
   */
  public static $prefixTable = [];

  /*
   * This class should not be instantiated
   */
  private function __construct()
  {
  }

  /**
   * Connect to database
   *
   * Sets connection options, set prefix on tables and connect to the database
   *
   * @return PDO|PDOException
   */
  public static function connect()
  {
    if (self::isConnected()) {
      return;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

    self::$options = [
      \PDO::ATTR_PERSISTENT  => true,
      \PDO::ATTR_ERRMODE     => \PDO::ERRMODE_EXCEPTION
    ];

    try {
      self::$pdo = new \PDO($dsn, DB_USER, DB_PASSWORD, self::$options);

      // Set and prefix tables
      self::tables();

      return self::$pdo;
    } catch (\PDOException $e) {
      self::$error = $e->getMessage();

      throw new DatabaseException($e->getMessage());
    }
  }

  /**
   * Checks if there's an active database connection
   *
   * @return bool
   */
  public static function isConnected()
  {
    return isset(self::$pdo);
  }

  /**
   * Close database connection
   *
   * @return bool
   */
  public static function close()
  {
    self::$pdo = null;
    self::$statement = null;

    return true;
  }

  /**
   * Prepare a query to run against the database
   *
   * @param string $query The query statement
   * @return void
   */
  public static function query($query)
  {
    self::$statement = self::$pdo->prepare($query);
    self::$lastQuery = $query;
    return self::$statement;
  }

  /**
   * Bind the inputs with the query placeholders
   *
   * @param string $param
   *   The query placeholder
   * @param string $value
   *   Actual value to bind to the placeholder
   * @param string $type
   *   The datatype of the the parameter
   * @return bool
   */
  public static function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = \PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = \PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = \PDO::PARAM_NULL;
          break;
        default:
          $type = \PDO::PARAM_STR;
      }
    }
    return self::$statement->bindValue($param, $value, $type);
  }

  /**
   * Execute the prepared statement
   *
   * @return bool|PDOExeption
   */
  public static function execute()
  {
    try {
      return self::$statement->execute();
    } catch (\PDOException $e) {
      self::$error = $e->getMessage();
      return self::$error;
    }
  }

  public static function fetchAll()
  {
    self::execute();

    return self::$statement->fetchAll(\PDO::FETCH_OBJ);
  }

  public static function fetchOne()
  {
    self::execute();

    return self::$statement->fetch(\PDO::FETCH_OBJ);
  }

  public static function rowCount()
  {
    return self::$statement->rowCount();
  }

  public static function lastInsertId()
  {
    return self::$pdo->lastInsertId();
  }

  public static function beginTransaction()
  {
    return self::$pdo->beginTransaction();
  }

  public static function endTransaction()
  {
    return self::$pdo->commit();
  }

  public static function cancelTransaction()
  {
    return self::$pdo->rollBack();
  }

  public static function debugDumpParams()
  {
    return self::$stmt->debugDumpParams();
  }

  /**
   * Set database tables prefix
   *
   * @return array
   */
  public static function tables()
  {
    if (!defined('TABLE_PREFIX')) {
      define('TABLE_PREFIX', '');
    }

    foreach (self::$tables as $table) {
      self::$prefixTable[$table] = TABLE_PREFIX . $table;
    }

    return self::$prefixTable;
  }
}
