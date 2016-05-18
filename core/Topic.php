<?php

namespace DDForum\Core;

use DDForum\Core\Database;

class Topic
{
  const TABLE = TABLE_PREFIX . 'topics';

  /**
   * New created topicID
   * @var int
   */
  public static $newtopicId;

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
   * Create new topic in topics table
   *
   * @param array $topic
   *   Array of "topic table column names" and value pairs
   */
  public static function create(array $topic)
  {
    if (!is_array($topic) && empty($topic)) {
      throw new \InvalidArgumentException("Argument must be a non empty array");
    }

    $query = "INSERT INTO ". self::TABLE;
    $col = '';
    $val = '';

    foreach ($topic as $column => $value) {
      $col .= "$column, ";
      $val .= ":". $column . ", ";
    }

    $col = rtrim($col, ', ');
    $val = rtrim($val, ', ');
    $query .= " (" . $col . ") VALUES (". $val . ")";

    Database::query($query);

    foreach ($topic as $param => $value) {
      Database::bind(":{$param}", $value);
    }

    $execute = Database::execute();
    self::$newtopicId = (int)Database::lastInsertId();

    return $execute;
  }

  /**
   * Update topic entry
   *
   * @param array $data
   *   Array of key => value pairs for update
   * @param string $id
   *   Unique id for which topic entry to update
   * @return bool
   */
  public static function update($topic, $id)
  {
    if (!is_array($topic) && empty($topic)) {
      throw new \InvalidArgumentException("Argument must be a non empty array");
    }

    $query = "UPDATE ". self::TABLE ." SET ";
    $col = '';

    foreach ($topic as $column => $value) {
      $col .= "$column = :$column, ";
    }

    $col = rtrim($col, ', ');
    $query .= $col . " WHERE topicID = :id";

    Database::query($query);

    Database::bind(':id', $id);

    foreach ($topic as $param => $value) {
      Database::bind(":{$param}", $value);
    }

    return Database::execute();
  }

  /**
   * Remove topic entry
   *
   * @param int $id
   *   topic Id to delete
   * @return bool
   */
  public static function delete($id)
  {
    Database::query("DELETE FROM ". self::TABLE ." WHERE topicID = :id");
    Database::bind(':id', $id);

    return Database::execute();

  }

  public static function getAll() {
    Database::query("SELECT * FROM ". self::TABLE);

    self::$count = Database::$statement->rowCount();

    return Database::fetchAll();
  }

  public static function get($field, $id)
  {
    Database::query("SELECT $field FROM " . self::TABLE . " WHERE topicID = :id");
    Database::bind(':id', $id);

    if (!Database::fetchOne()) {
      return null;
    }

    return Database::fetchOne()->$field;
  }

  public static function paginate($order = 'topicID DESC', $limit = null, $offset = 1)
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

  public static function getPinned()
  {
    Database::query("SELECT * FROM ". self::TABLE ." WHERE pin = 1");
    return Database::fetchAll();
  }

  public static function getTrending()
  {
    Database::query("SELECT * FROM ". self::TABLE ." WHERE pin = 1");
    return Database::fetchAll();
  }

  public static function countReplies($topic_id)
  {
    Database::query("SELECT * FROM ". TABLE_PREFIX . 'replies WHERE topicID = :topic_id');
    Database::bind(':topic_id', $topic_id);
    Database::execute();
    return Database::rowCount();
  }
}
