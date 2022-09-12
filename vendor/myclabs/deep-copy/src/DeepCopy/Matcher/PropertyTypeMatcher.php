<?php

namespace DeepCopy\Matcher;

<<<<<<< HEAD
use ReflectionProperty;

/**
 * Match a property by its type
 *
 * @deprecated It is recommended to use {@see DeepCopy\TypeFilter\TypeFilter} instead, as it applies on all occurrences
 *             of given type in copied context (eg. array elements), not just on object properties.
=======
use DeepCopy\Reflection\ReflectionHelper;
use ReflectionException;

/**
 * Matches a property by its type.
 *
 * It is recommended to use {@see DeepCopy\TypeFilter\TypeFilter} instead, as it applies on all occurrences
 * of given type in copied context (eg. array elements), not just on object properties.
 *
 * @final
>>>>>>> update
 */
class PropertyTypeMatcher implements Matcher
{
    /**
     * @var string
     */
    private $propertyType;

    /**
     * @param string $propertyType Property type
     */
    public function __construct($propertyType)
    {
        $this->propertyType = $propertyType;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($object, $property)
    {
<<<<<<< HEAD
        $reflectionProperty = new ReflectionProperty($object, $property);
        $reflectionProperty->setAccessible(true);

=======
        try {
            $reflectionProperty = ReflectionHelper::getProperty($object, $property);
        } catch (ReflectionException $exception) {
            return false;
        }

        $reflectionProperty->setAccessible(true);

        // Uninitialized properties (for PHP >7.4)
        if (method_exists($reflectionProperty, 'isInitialized') && !$reflectionProperty->isInitialized($object)) {
            // null instanceof $this->propertyType
            return false;
        }

>>>>>>> update
        return $reflectionProperty->getValue($object) instanceof $this->propertyType;
    }
}
