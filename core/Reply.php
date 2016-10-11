<?php

namespace DDForum\Core;

class Reply extends ForumItem
{
  /**
   * Construct sets the specific table
   */
  public function __construct()
  {
    parent::__construct('replies');
  }
}
