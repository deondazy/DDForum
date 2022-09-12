<?php

namespace DeepCopy\TypeMatcher;

<<<<<<< HEAD
/**
 * TypeMatcher class
 */
=======
>>>>>>> update
class TypeMatcher
{
    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
<<<<<<< HEAD
     * @param $element
=======
     * @param mixed $element
     *
>>>>>>> update
     * @return boolean
     */
    public function matches($element)
    {
        return is_object($element) ? is_a($element, $this->type) : gettype($element) === $this->type;
    }
}
