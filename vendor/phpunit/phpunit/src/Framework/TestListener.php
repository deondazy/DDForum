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
 * A Listener for test progress.
 *
 * @since      Interface available since Release 2.0.0
 */
interface PHPUnit_Framework_TestListener
{
    /**
     * An error occurred.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     */
    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time);

    /**
     * A warning occurred.
     *
     * @param PHPUnit_Framework_Test    $test
     * @param PHPUnit_Framework_Warning $e
     * @param float                     $time
     *
     * @since Method available since Release 6.0.0
     *
     * @todo  Uncomment in time for PHPUnit 6.0.0
     *
     * @see   https://github.com/sebastianbergmann/phpunit/pull/1840#issuecomment-162535997
     */
//  public function addWarning(PHPUnit_Framework_Test $test, PHPUnit_Framework_Warning $e, $time);

    /**
     * A failure occurred.
     *
     * @param PHPUnit_Framework_Test                 $test
     * @param PHPUnit_Framework_AssertionFailedError $e
     * @param float                                  $time
     */
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time);

    /**
     * Incomplete test.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     */
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time);

    /**
     * Risky test.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     *
     * @since Method available since Release 4.0.0
     */
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time);

    /**
     * Skipped test.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     *
     * @since Method available since Release 3.0.0
     */
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time);

    /**
     * A test suite started.
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @since Method available since Release 2.2.0
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite);

    /**
     * A test suite ended.
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @since Method available since Release 2.2.0
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite);

    /**
     * A test started.
     *
     * @param PHPUnit_Framework_Test $test
     */
    public function startTest(PHPUnit_Framework_Test $test);

    /**
     * A test ended.
     *
     * @param PHPUnit_Framework_Test $test
     * @param float                  $time
     */
    public function endTest(PHPUnit_Framework_Test $test, $time);
=======
namespace PHPUnit\Framework;

use Throwable;

/**
 * This interface, as well as the associated mechanism for extending PHPUnit,
 * will be removed in PHPUnit 10. There is no alternative available in this
 * version of PHPUnit.
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 *
 * @deprecated
 * @see https://github.com/sebastianbergmann/phpunit/issues/4676
 */
interface TestListener
{
    public function addError(Test $test, Throwable $t, float $time): void;

    public function addWarning(Test $test, Warning $e, float $time): void;

    public function addFailure(Test $test, AssertionFailedError $e, float $time): void;

    public function addIncompleteTest(Test $test, Throwable $t, float $time): void;

    public function addRiskyTest(Test $test, Throwable $t, float $time): void;

    public function addSkippedTest(Test $test, Throwable $t, float $time): void;

    public function startTestSuite(TestSuite $suite): void;

    public function endTestSuite(TestSuite $suite): void;

    public function startTest(Test $test): void;

    public function endTest(Test $test, float $time): void;
>>>>>>> update
}
