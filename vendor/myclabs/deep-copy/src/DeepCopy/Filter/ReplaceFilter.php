<?php

namespace DeepCopy\Filter;

<<<<<<< HEAD
/**
 * Replace the value of a property
=======
use DeepCopy\Reflection\ReflectionHelper;

/**
 * @final
>>>>>>> update
 */
class ReplaceFilter implements Filter
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * @param callable $callable Will be called to get the new value for each property to replace
     */
    public function __construct(callable $callable)
    {
        $this->callback = $callable;
    }

    /**
<<<<<<< HEAD
=======
     * Replaces the object property by the result of the callback called with the object property.
     *
>>>>>>> update
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
<<<<<<< HEAD
        $reflectionProperty = new \ReflectionProperty($object, $property);
=======
        $reflectionProperty = ReflectionHelper::getProperty($object, $property);
>>>>>>> update
        $reflectionProperty->setAccessible(true);

        $value = call_user_func($this->callback, $reflectionProperty->getValue($object));

        $reflectionProperty->setValue($object, $value);
    }
}
