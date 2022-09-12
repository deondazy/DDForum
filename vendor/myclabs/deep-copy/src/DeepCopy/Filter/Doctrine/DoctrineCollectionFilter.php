<?php

namespace DeepCopy\Filter\Doctrine;

use DeepCopy\Filter\Filter;
<<<<<<< HEAD
use ReflectionProperty;

/**
 * Set a null value for a property
=======
use DeepCopy\Reflection\ReflectionHelper;

/**
 * @final
>>>>>>> update
 */
class DoctrineCollectionFilter implements Filter
{
    /**
<<<<<<< HEAD
=======
     * Copies the object property doctrine collection.
     *
>>>>>>> update
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
<<<<<<< HEAD
        $reflectionProperty = new ReflectionProperty($object, $property);
=======
        $reflectionProperty = ReflectionHelper::getProperty($object, $property);
>>>>>>> update

        $reflectionProperty->setAccessible(true);
        $oldCollection = $reflectionProperty->getValue($object);

        $newCollection = $oldCollection->map(
            function ($item) use ($objectCopier) {
                return $objectCopier($item);
            }
        );

        $reflectionProperty->setValue($object, $newCollection);
    }
}
