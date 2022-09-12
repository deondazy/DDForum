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
 * Constraint that asserts that one value is identical to another.
 *
 * Identical check is performed with PHP's === operator, the operator is
 * explained in detail at
 * {@url http://www.php.net/manual/en/types.comparisons.php}.
 * Two values are identical if they have the same value and are of the same
 * type.
 *
 * The expected value is passed in the constructor.
 *
 * @since Class available since Release 3.0.0
 */
class PHPUnit_Framework_Constraint_IsIdentical extends PHPUnit_Framework_Constraint
{
    /**
     * @var float
     */
    const EPSILON = 0.0000000001;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        parent::__construct();
=======
namespace PHPUnit\Framework\Constraint;

use const PHP_FLOAT_EPSILON;
use function abs;
use function get_class;
use function is_array;
use function is_float;
use function is_infinite;
use function is_nan;
use function is_object;
use function is_string;
use function sprintf;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\Comparator\ComparisonFailure;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class IsIdentical extends Constraint
{
    /**
     * @var mixed
     */
    private $value;

    public function __construct($value)
    {
>>>>>>> update
        $this->value = $value;
    }

    /**
<<<<<<< HEAD
     * Evaluates the constraint for parameter $other
=======
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
    {
        if (is_double($this->value) && is_double($other) &&
            !is_infinite($this->value) && !is_infinite($other) &&
            !is_nan($this->value) && !is_nan($other)) {
            $success = abs($this->value - $other) < self::EPSILON;
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public function evaluate($other, string $description = '', bool $returnResult = false): ?bool
    {
        if (is_float($this->value) && is_float($other) &&
            !is_infinite($this->value) && !is_infinite($other) &&
            !is_nan($this->value) && !is_nan($other)) {
            $success = abs($this->value - $other) < PHP_FLOAT_EPSILON;
>>>>>>> update
        } else {
            $success = $this->value === $other;
        }

        if ($returnResult) {
            return $success;
        }

        if (!$success) {
            $f = null;

            // if both values are strings, make sure a diff is generated
            if (is_string($this->value) && is_string($other)) {
<<<<<<< HEAD
                $f = new SebastianBergmann\Comparator\ComparisonFailure(
                    $this->value,
                    $other,
                    $this->value,
                    $other
=======
                $f = new ComparisonFailure(
                    $this->value,
                    $other,
                    sprintf("'%s'", $this->value),
                    sprintf("'%s'", $other)
                );
            }

            // if both values are array, make sure a diff is generated
            if (is_array($this->value) && is_array($other)) {
                $f = new ComparisonFailure(
                    $this->value,
                    $other,
                    $this->exporter()->export($this->value),
                    $this->exporter()->export($other)
>>>>>>> update
                );
            }

            $this->fail($other, $description, $f);
        }
<<<<<<< HEAD
    }

    /**
     * Returns the description of the failure
=======

        return null;
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function toString(): string
    {
        if (is_object($this->value)) {
            return 'is identical to an object of class "' .
                get_class($this->value) . '"';
        }

        return 'is identical to ' . $this->exporter()->export($this->value);
    }

    /**
     * Returns the description of the failure.
>>>>>>> update
     *
     * The beginning of failure messages is "Failed asserting that" in most
     * cases. This method should return the second part of that sentence.
     *
<<<<<<< HEAD
     * @param mixed $other Evaluated value or object.
     *
     * @return string
     */
    protected function failureDescription($other)
=======
     * @param mixed $other evaluated value or object
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    protected function failureDescription($other): string
>>>>>>> update
    {
        if (is_object($this->value) && is_object($other)) {
            return 'two variables reference the same object';
        }

        if (is_string($this->value) && is_string($other)) {
            return 'two strings are identical';
        }

<<<<<<< HEAD
        return parent::failureDescription($other);
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @return string
     */
    public function toString()
    {
        if (is_object($this->value)) {
            return 'is identical to an object of class "' .
                   get_class($this->value) . '"';
        } else {
            return 'is identical to ' .
                   $this->exporter->export($this->value);
        }
    }
=======
        if (is_array($this->value) && is_array($other)) {
            return 'two arrays are identical';
        }

        return parent::failureDescription($other);
    }
>>>>>>> update
}
