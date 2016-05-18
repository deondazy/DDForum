<?php

namespace DDForum\Core;

use DDForum\Core\Database;

class Option
{
  const TABLE = TABLE_PREFIX . 'options';

  public static function config_file()
  {
    return DDFPATH . 'config.php';
  }

  /**
   * Get an option value from database options table
   *
   * @param string|null $option
   *   The option to get, if null defaults to site_name
   * @return string
   */
  public static function get($option = null)
  {
    if (!$option) {
      $option = 'site_name';
    }

    Database::query("SELECT option_value FROM " .self::TABLE ." WHERE option_name = :option");
    Database::bind(':option', $option);

    return Database::fetchOne()->option_value;
  }

  public static function set($option, $value)
  {
    if (!empty($option)) {
      Database::query('SELECT optionID FROM ' .self::TABLE .' WHERE option_name = :option');
      Database::bind(':option', $option);
      $option_id = Database::fetchOne()->optionID;

      Database::query("UPDATE " .self::TABLE ." SET option_value = :value WHERE optionID = '$option_id'");
      Database::bind(':value', $value);

      return Database::execute();
    }

    return false;
  }

  public static function add($option, $value)
  {
    if (!empty($option)) {
      Database::query("INSERT INTO " .self::TABLE ." (option_name, option_value) VALUES (:option, :value)");
      Database::bind(':option', $option);
      Database::bind(':value', $value);
      Database::execute();

      return Database::rowCount();
    }

    return 0;
  }
}
