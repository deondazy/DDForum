<?php

namespace DDForum\Core;

use DDForum\Core\Database;

class Reply
{
  private static $table = TABLE_PREFIX . 'replies';

  /**
   * New created forumID
   * @var int
   */
  public static $newForumId;

  public static $title;

  public static $description;

  public static $status;

  public static $date;

  public static $lastPostDate;

  public static $author;

  public static $lastReplyAuthor;

  public static $replyCount;

  public static $viewCount;

  public static $sticky;

  public static $pinOnHomepage;

  public static $count;

  /**
   * Create new forum in forums table
   *
   * @param array $forum
   *   Array of "forum table column names" and value pairs
   */
  public static function create(array $reply)
  {
    if (!is_array($reply) && empty($reply)) {
      throw new \InvalidArgumentException("Argument must be a non empty array");
    }

    $query = "INSERT INTO ". self::$table;
    $col = '';
    $val = '';

    foreach ($reply as $column => $value) {
      $col .= "$column, ";
      $val .= ":". $column . ", ";
    }

    $col = rtrim($col, ', ');
    $val = rtrim($val, ', ');
    $query .= " (" . $col . ") VALUES (". $val . ")";

    Database::query($query);

    foreach ($reply as $param => $value) {
      Database::bind(":{$param}", $value);
    }

    $execute = Database::execute();
    self::$newReplyId = (int)Database::lastInsertId();

    return $execute;
  }

  /**
   * Update Forum entry
   *
   * @param array $data
   *   Array of key => value pairs for update
   * @param string $id
   *   Unique id for which forum entry to update
   * @return bool
   */
  public static function update(Array $reply, $id)
  {
    if (!is_array($reply) && empty($reply)) {
      throw new \InvalidArgumentException("Argument must be a non empty array");
    }

    $query = "UPDATE ". self::$table ." SET ";
    $col = '';

    foreach ($reply as $column => $value) {
      $col .= "$column = :$column, ";
    }

    $col = rtrim($col, ', ');
    $query .= $col . " WHERE forumID = " . $id;

    Database::query($query);

    foreach ($reply as $param => $value) {
      Database::bind(":{$param}", $value);
    }

    return Database::execute();
  }

  /**
   * Remove Forum entry
   *
   * @param int $id
   *   Forum Id to delete
   * @return bool
   */
  public static function delete($id)
  {
    Database::query("DELETE FROM ". self::$table ." WHERE replyID = :id");
    Database::bind(':id', $id);

    return Database::execute();

  }

  public static function getAll($where = null) {
    $query = "SELECT * FROM ". self::$table;

    if ($where) {
      $query .= " WHERE " . $where;
    }

    Database::query($query);

    self::$count = Database::$statement->rowCount();

    return Database::fetchAll();
  }

  public static function get($field, $id)
  {
    Database::query("SELECT $field FROM " . self::$table . " WHERE replyID = :id");
    Database::bind(':id', $id);

    if (!Database::fetchOne()) {
      return null;
    }

    return Database::fetchOne()->$field;
  }

  public static function paginate($order = 'replyID DESC', $limit = null, $offset = 1)
  {
    $query = '';

    if (!empty($order)) {
      $query .= ' ORDER BY ' . $order;
    }
    if (!empty($limit)) {
      $query .= ' LIMIT ' . $offset  . ', ' . $limit;
    }

    Database::query(Database::$lastQuery . $query);
    self::$count = Database::rowCount();
    return Database::fetchAll();

  }
}
