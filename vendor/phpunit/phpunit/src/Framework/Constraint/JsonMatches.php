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
 * Asserts whether or not two JSON objects are equal.
 *
 * @since Class available since Release 3.7.0
 */
class PHPUnit_Framework_Constraint_JsonMatches extends PHPUnit_Framework_Constraint
=======
namespace PHPUnit\Framework\Constraint;

use function json_decode;
use function sprintf;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Util\Json;
use SebastianBergmann\Comparator\ComparisonFailure;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class JsonMatches extends Constraint
>>>>>>> update
{
    /**
     * @var string
     */
<<<<<<< HEAD
    protected $value;

    /**
     * Creates a new constraint.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct();
        $this->value = $value;
=======
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Returns a string representation of the object.
     */
    public function toString(): string
    {
        return sprintf(
            'matches JSON string "%s"',
            $this->value
        );
>>>>>>> update
    }

    /**
     * Evaluates the constraint for parameter $other. Returns true if the
     * constraint is met, false otherwise.
     *
     * This method can be overridden to implement the evaluation algorithm.
     *
<<<<<<< HEAD
     * @param mixed $other Value or object to evaluate.
     *
     * @return bool
     */
    protected function matches($other)
    {
        $decodedOther = json_decode($other);
        if (json_last_error()) {
            return false;
        }

        $decodedValue = json_decode($this->value);
        if (json_last_error()) {
            return false;
        }

        return $decodedOther == $decodedValue;
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return sprintf(
            'matches JSON string "%s"',
            $this->value
        );
=======
     * @param mixed $other value or object to evaluate
     */
    protected function matches($other): bool
    {
        [$error, $recodedOther] = Json::canonicalize($other);

        if ($error) {
            return false;
        }

        [$error, $recodedValue] = Json::canonicalize($this->value);

        if ($error) {
            return false;
        }

        return $recodedOther == $recodedValue;
    }

    /**
     * Throws an exception for the given compared value and test description.
     *
     * @param mixed             $other             evaluated value or object
     * @param string            $description       Additional information about the test
     * @param ComparisonFailure $comparisonFailure
     *
     * @throws \PHPUnit\Framework\Exception
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-return never-return
     */
    protected function fail($other, $description, ComparisonFailure $comparisonFailure = null): void
    {
        if ($comparisonFailure === null) {
            [$error, $recodedOther] = Json::canonicalize($other);

            if ($error) {
                parent::fail($other, $description);
            }

            [$error, $recodedValue] = Json::canonicalize($this->value);

            if ($error) {
                parent::fail($other, $description);
            }

            $comparisonFailure = new ComparisonFailure(
                json_decode($this->value),
                json_decode($other),
                Json::prettify($recodedValue),
                Json::prettify($recodedOther),
                false,
                'Failed asserting that two json values are equal.'
            );
        }

        parent::fail($other, $description, $comparisonFailure);
>>>>>>> update
    }
}
