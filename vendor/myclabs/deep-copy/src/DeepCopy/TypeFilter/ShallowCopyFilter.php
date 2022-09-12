<?php

namespace DeepCopy\TypeFilter;

<<<<<<< HEAD
=======
/**
 * @final
 */
>>>>>>> update
class ShallowCopyFilter implements TypeFilter
{
    /**
     * {@inheritdoc}
     */
    public function apply($element)
    {
        return clone $element;
    }
}
