<?php

namespace DDForum\Core;

class Forum extends ForumItem
{
    /**
     * Construct sets the specific table.
     */
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('forums');
    }
    
    /**
     * @inheritdoc
     */
    public function count($type = 'forum')
    {
        return count($this->getAll("type = '$type'"));
    }

    /**
     * HTML select drop-down with forum names.
     *
     * @param string $class The dropdown css class
     * @param string $selected The selected dropdown option
     */
    public function dropdown($tags = [], $selected = null)
    {
        $tags += [
            'id' => 'forum',
            'name' => 'forum',
            'class' => 'editor-select'
        ];
        $forums = $this->getAll();
        $output = "<select id=\"{$tags['id']}\" name=\"{$tags['name']}\" class=\"{$tags['class']}\">";
        if (is_null($selected)) {
            $output .= '<option disabled selected hidden>Select Forum</option>';
        }
        foreach ($forums as $forum) {
            $output .= "<option value=\"{$forum->id}\" ".Util::selected($selected, $forum->id, false)."> {$forum->name}</option>";
        }
        $output .= '</select>';
        return $output;
    }
}
