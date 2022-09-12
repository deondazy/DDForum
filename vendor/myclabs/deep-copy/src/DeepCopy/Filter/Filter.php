<?php

namespace DeepCopy\Filter;

/**
 * Filter to apply to a property while copying an object
 */
interface Filter
{
    /**
<<<<<<< HEAD
     * Apply the filter to the object.
=======
     * Applies the filter to the object.
     *
>>>>>>> update
     * @param object   $object
     * @param string   $property
     * @param callable $objectCopier
     */
    public function apply($object, $property, $objectCopier);
}
