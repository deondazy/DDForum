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
 * A TestFailure collects a failed test together with the caught exception.
 *
 * @since Class available since Release 2.0.0
 */
class PHPUnit_Framework_TestFailure
{
    /**
=======
namespace PHPUnit\Framework;

use function get_class;
use function sprintf;
use function trim;
use PHPUnit\Framework\Error\Error;
use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class TestFailure
{
    /**
     * @var null|Test
     */
    private $failedTest;

    /**
     * @var Throwable
     */
    private $thrownException;

    /**
>>>>>>> update
     * @var string
     */
    private $testName;

    /**
<<<<<<< HEAD
     * @var PHPUnit_Framework_Test|null
     */
    protected $failedTest;

    /**
     * @var Exception
     */
    protected $thrownException;

    /**
     * Constructs a TestFailure with the given test and exception.
     *
     * @param PHPUnit_Framework_Test $failedTest
     * @param Throwable              $t
     */
    public function __construct(PHPUnit_Framework_Test $failedTest, $t)
    {
        if ($failedTest instanceof PHPUnit_Framework_SelfDescribing) {
=======
     * Returns a description for an exception.
     */
    public static function exceptionToString(Throwable $e): string
    {
        if ($e instanceof SelfDescribing) {
            $buffer = $e->toString();

            if ($e instanceof ExpectationFailedException && $e->getComparisonFailure()) {
                $buffer .= $e->getComparisonFailure()->getDiff();
            }

            if ($e instanceof PHPTAssertionFailedError) {
                $buffer .= $e->getDiff();
            }

            if (!empty($buffer)) {
                $buffer = trim($buffer) . "\n";
            }

            return $buffer;
        }

        if ($e instanceof Error) {
            return $e->getMessage() . "\n";
        }

        if ($e instanceof ExceptionWrapper) {
            return $e->getClassName() . ': ' . $e->getMessage() . "\n";
        }

        return get_class($e) . ': ' . $e->getMessage() . "\n";
    }

    /**
     * Constructs a TestFailure with the given test and exception.
     */
    public function __construct(Test $failedTest, Throwable $t)
    {
        if ($failedTest instanceof SelfDescribing) {
>>>>>>> update
            $this->testName = $failedTest->toString();
        } else {
            $this->testName = get_class($failedTest);
        }

<<<<<<< HEAD
        if (!$failedTest instanceof PHPUnit_Framework_TestCase || !$failedTest->isInIsolation()) {
=======
        if (!$failedTest instanceof TestCase || !$failedTest->isInIsolation()) {
>>>>>>> update
            $this->failedTest = $failedTest;
        }

        $this->thrownException = $t;
    }

    /**
     * Returns a short description of the failure.
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
        return sprintf(
            '%s: %s',
            $this->testName,
            $this->thrownException->getMessage()
        );
    }

    /**
     * Returns a description for the thrown exception.
<<<<<<< HEAD
     *
     * @return string
     *
     * @since Method available since Release 3.4.0
     */
    public function getExceptionAsString()
=======
     */
    public function getExceptionAsString(): string
>>>>>>> update
    {
        return self::exceptionToString($this->thrownException);
    }

    /**
<<<<<<< HEAD
     * Returns a description for an exception.
     *
     * @param Exception $e
     *
     * @return string
     *
     * @since Method available since Release 3.2.0
     */
    public static function exceptionToString(Exception $e)
    {
        if ($e instanceof PHPUnit_Framework_SelfDescribing) {
            $buffer = $e->toString();

            if ($e instanceof PHPUnit_Framework_ExpectationFailedException && $e->getComparisonFailure()) {
                $buffer = $buffer . $e->getComparisonFailure()->getDiff();
            }

            if (!empty($buffer)) {
                $buffer = trim($buffer) . "\n";
            }
        } elseif ($e instanceof PHPUnit_Framework_Error) {
            $buffer = $e->getMessage() . "\n";
        } elseif ($e instanceof PHPUnit_Framework_ExceptionWrapper) {
            $buffer = $e->getClassname() . ': ' . $e->getMessage() . "\n";
        } else {
            $buffer = get_class($e) . ': ' . $e->getMessage() . "\n";
        }

        return $buffer;
    }

    /**
     * Returns the name of the failing test (including data set, if any).
     *
     * @return string
     *
     * @since Method available since Release 4.3.0
     */
    public function getTestName()
=======
     * Returns the name of the failing test (including data set, if any).
     */
    public function getTestName(): string
>>>>>>> update
    {
        return $this->testName;
    }

    /**
     * Returns the failing test.
     *
     * Note: The test object is not set when the test is executed in process
     * isolation.
     *
<<<<<<< HEAD
     * @see PHPUnit_Framework_Exception
     *
     * @return PHPUnit_Framework_Test|null
     */
    public function failedTest()
=======
     * @see Exception
     */
    public function failedTest(): ?Test
>>>>>>> update
    {
        return $this->failedTest;
    }

    /**
     * Gets the thrown exception.
<<<<<<< HEAD
     *
     * @return Exception
     */
    public function thrownException()
=======
     */
    public function thrownException(): Throwable
>>>>>>> update
    {
        return $this->thrownException;
    }

    /**
     * Returns the exception's message.
<<<<<<< HEAD
     *
     * @return string
     */
    public function exceptionMessage()
=======
     */
    public function exceptionMessage(): string
>>>>>>> update
    {
        return $this->thrownException()->getMessage();
    }

    /**
     * Returns true if the thrown exception
     * is of type AssertionFailedError.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function isFailure()
    {
        return ($this->thrownException() instanceof PHPUnit_Framework_AssertionFailedError);
=======
     */
    public function isFailure(): bool
    {
        return $this->thrownException() instanceof AssertionFailedError;
>>>>>>> update
    }
}
