<?php

namespace DeepCopy\Matcher;

/**
<<<<<<< HEAD
 * Match a specific property of a specific class
=======
 * @final
>>>>>>> update
 */
class PropertyMatcher implements Matcher
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $property;

    /**
     * @param string $class    Class name
     * @param string $property Property name
     */
    public function __construct($class, $property)
    {
        $this->class = $class;
        $this->property = $property;
    }

    /**
<<<<<<< HEAD
=======
     * Matches a specific property of a specific class.
     *
>>>>>>> update
     * {@inheritdoc}
     */
    public function matches($object, $property)
    {
<<<<<<< HEAD
        return ($object instanceof $this->class) && ($property == $this->property);
=======
        return ($object instanceof $this->class) && $property == $this->property;
>>>>>>> update
    }
}
