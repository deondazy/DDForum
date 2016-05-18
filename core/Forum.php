<?php

namespace DDForum\Core;

use DDForum\Core\Database;

class Forum
{
  private static $table = TABLE_PREFIX . 'forums';

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
  public static function create(array $forum)
  {
    if (!is_array($forum) && empty($forum)) {
      throw new \InvalidArgumentException("Argument must be a non empty array");
    }

    $query = "INSERT INTO ". self::$table;
    $col = '';
    $val = '';

    foreach ($forum as $column => $value) {
      $col .= "$column, ";
      $val .= ":". $column . ", ";
    }

    $col = rtrim($col, ', ');
    $val = rtrim($val, ', ');
    $query .= " (" . $col . ") VALUES (". $val . ")";

    Database::query($query);

    foreach ($forum as $param => $value) {
      Database::bind(":{$param}", $value);
    }

    $execute = Database::execute();
    self::$newForumId = (int)Database::lastInsertId();

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
  public static function update($forum, $id)
  {
    if (!is_array($forum) && empty($forum)) {
      throw new \InvalidArgumentException("Argument must be a non empty array");
    }

    $query = "UPDATE ". self::$table ." SET ";
    $col = '';

    foreach ($forum as $column => $value) {
      $col .= "$column = :$column, ";
    }

    $col = rtrim($col, ', ');
    $query .= $col . " WHERE forumID = " . $id;

    Database::query($query);

    foreach ($forum as $param => $value) {
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
    Database::query("DELETE FROM ". self::$table ." WHERE forumID = :id");
    Database::bind(':id', $id);

    return Database::execute();

  }

  public static function getAll() {
    Database::query("SELECT * FROM ". self::$table);

    self::$count = Database::$statement->rowCount();

    return Database::fetchAll();
  }

  public static function get($field, $id)
  {
    Database::query("SELECT $field FROM " . self::$table . " WHERE forumID = :id");
    Database::bind(':id', $id);

    if (!Database::fetchOne()) {
      return null;
    }

    return Database::fetchOne()->$field;
  }

  public static function paginate($order = 'forumID DESC', $limit = null, $offset = 1)
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

  /**
   * HTML select dropdown with forum names
   */
  public static function dropdown($class = 'editor-select', $selected = null)
  {
    Database::query("SELECT * FROM ". self::$table ." WHERE forum_type = 'forum'");
    $forums = Database::fetchAll();

    $output = '<select id="topic-forum" name="topic-forum" class="'.$class.'">';

    if (is_null($selected)) {
      $output .= '<option disabled selected hidden>Select Forum</option>';
    }

    foreach ($forums as $forum) {
      $output .= '<option value="'. $forum->forumID .'" ' . Util::selected($selected, $forum->forumID, false) .'>'. $forum->forum_name .'</option>';
    }

    $output .= '</select>';

    return $output;
  }

  public static function countTopics($forum_id)
  {
    Database::query("SELECT * FROM ". TABLE_PREFIX . 'topics WHERE forumID = :forum_id');
    Database::bind(':forum_id', $forum_id);
    Database::execute();
    return Database::rowCount();
  }

  public static function countReplies($forum_id)
  {
    Database::query("SELECT * FROM ". TABLE_PREFIX . 'replies WHERE forumID = :forum_id');
    Database::bind(':forum_id', $forum_id);
    Database::execute();
    return Database::rowCount();
  }
}
