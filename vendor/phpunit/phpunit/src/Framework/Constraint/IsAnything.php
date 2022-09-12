<<<<<<< HEAD
<?php
=======
<?php declare(strict_types=1);
>>>>>>> update
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

/**
 * Constraint that accepts any input value.
 *
 * @since Class available since Release 3.0.0
 */
class PHPUnit_Framework_Constraint_IsAnything extends PHPUnit_Framework_Constraint
{
    /**
     * Evaluates the constraint for parameter $other
=======
namespace PHPUnit\Framework\Constraint;

use PHPUnit\Framework\ExpectationFailedException;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class IsAnything extends Constraint
{
    /**
     * Evaluates the constraint for parameter $other.
>>>>>>> update
     *
     * If $returnResult is set to false (the default), an exception is thrown
     * in case of a failure. null is returned otherwise.
     *
     * If $returnResult is true, the result of the evaluation is returned as
     * a boolean value instead: true in case of success, false in case of a
     * failure.
     *
<<<<<<< HEAD
     * @param mixed  $other        Value or object to evaluate.
     * @param string $description  Additional information about the test
     * @param bool   $returnResult Whether to return a result or throw an exception
     *
     * @return mixed
     *
     * @throws PHPUnit_Framework_ExpectationFailedException
     */
    public function evaluate($other, $description = '', $returnResult = false)
=======
     * @throws ExpectationFailedException
     */
    public function evaluate($other, string $description = '', bool $returnResult = false): ?bool
>>>>>>> update
    {
        return $returnResult ? true : null;
    }

    /**
     * Returns a string representation of the constraint.
<<<<<<< HEAD
     *
     * @return string
     */
    public function toString()
=======
     */
    public function toString(): string
>>>>>>> update
    {
        return 'is anything';
    }

    /**
     * Counts the number of constraint elements.
<<<<<<< HEAD
     *
     * @return int
     *
     * @since Method available since Release 3.5.0
     */
    public function count()
=======
     */
    public function count(): int
>>>>>>> update
    {
        return 0;
    }
}
