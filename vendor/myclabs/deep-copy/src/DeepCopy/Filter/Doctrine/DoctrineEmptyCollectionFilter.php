<?php

namespace DeepCopy\Filter\Doctrine;

use DeepCopy\Filter\Filter;
<<<<<<< HEAD
use Doctrine\Common\Collections\ArrayCollection;

class DoctrineEmptyCollectionFilter implements Filter
{
    /**
     * Apply the filter to the object.
=======
use DeepCopy\Reflection\ReflectionHelper;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @final
 */
class DoctrineEmptyCollectionFilter implements Filter
{
    /**
     * Sets the object property to an empty doctrine collection.
>>>>>>> update
     *
     * @param object   $object
     * @param string   $property
     * @param callable $objectCopier
     */
    public function apply($object, $property, $objectCopier)
    {
<<<<<<< HEAD
        $reflectionProperty = new \ReflectionProperty($object, $property);
=======
        $reflectionProperty = ReflectionHelper::getProperty($object, $property);
>>>>>>> update
        $reflectionProperty->setAccessible(true);

        $reflectionProperty->setValue($object, new ArrayCollection());
    }
} 