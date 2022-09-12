<<<<<<< HEAD
<?php
/*
 * This file is part of the Comparator package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of sebastian/comparator.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

namespace SebastianBergmann\Comparator;

=======
namespace SebastianBergmann\Comparator;

use Exception;

>>>>>>> update
/**
 * Compares Exception instances for equality.
 */
class ExceptionComparator extends ObjectComparator
{
    /**
     * Returns whether the comparator can compare two values.
     *
<<<<<<< HEAD
     * @param  mixed $expected The first value to compare
     * @param  mixed $actual   The second value to compare
=======
     * @param mixed $expected The first value to compare
     * @param mixed $actual   The second value to compare
     *
>>>>>>> update
     * @return bool
     */
    public function accepts($expected, $actual)
    {
<<<<<<< HEAD
        return $expected instanceof \Exception && $actual instanceof \Exception;
=======
        return $expected instanceof Exception && $actual instanceof Exception;
>>>>>>> update
    }

    /**
     * Converts an object to an array containing all of its private, protected
     * and public properties.
     *
<<<<<<< HEAD
     * @param  object $object
=======
     * @param object $object
     *
>>>>>>> update
     * @return array
     */
    protected function toArray($object)
    {
        $array = parent::toArray($object);

        unset(
            $array['file'],
            $array['line'],
            $array['trace'],
            $array['string'],
            $array['xdebug_message']
        );

        return $array;
    }
}
