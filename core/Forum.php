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
    public function count($value = 0, $feild = 'forum')
    {
        if (0 !== $value) {
            return count($this->getAll("{$feild} = '{$value}'"));
        }
        return parent::count();
    }

    /**
     * HTML select drop-down with forum names.
     *
     * @param string $class The dropdown css class
     * @param string $type WHERE clause for type: forum|category
     */
    public function dropdown($tags = [], $type = null)
    {
        $tags += [
            'id' => 'forum',
            'name' => 'forum',
            'class' => 'editor-select',
            'selected' => null,
        ];
        $forums = $this->getAll($type);
        $output = "<select id=\"{$tags['id']}\" name=\"{$tags['name']}\" class=\"{$tags['class']}\">";
        if (is_null($tags['selected'])) {
            $output .= '<option disabled selected hidden>Select Forum</option>';
        }
        foreach ($forums as $forum) {
            $output .= "<option value=\"{$forum->id}\" ".Util::selected($tags['selected'], $forum->id, false)."> {$forum->name}</option>";
        }
        $output .= '</select>';
        return $output;
    }
}
