<?php

namespace DeepCopy\Matcher;

/**
<<<<<<< HEAD
 * Match a property by its name
=======
 * @final
>>>>>>> update
 */
class PropertyNameMatcher implements Matcher
{
    /**
     * @var string
     */
    private $property;

    /**
     * @param string $property Property name
     */
    public function __construct($property)
    {
        $this->property = $property;
    }

    /**
<<<<<<< HEAD
=======
     * Matches a property by its name.
     *
>>>>>>> update
     * {@inheritdoc}
     */
    public function matches($object, $property)
    {
        return $property == $this->property;
    }
}
