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
 * Base class for printers of TestDox documentation.
 *
 * @since Class available since Release 2.1.0
 */
abstract class PHPUnit_Util_TestDox_ResultPrinter extends PHPUnit_Util_Printer implements PHPUnit_Framework_TestListener
{
    /**
     * @var PHPUnit_Util_TestDox_NamePrettifier
=======
namespace PHPUnit\Util\TestDox;

use function get_class;
use function in_array;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\ErrorTestCase;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\Framework\WarningTestCase;
use PHPUnit\Runner\BaseTestRunner;
use PHPUnit\TextUI\ResultPrinter as ResultPrinterInterface;
use PHPUnit\Util\Printer;
use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
abstract class ResultPrinter extends Printer implements ResultPrinterInterface
{
    /**
     * @var NamePrettifier
>>>>>>> update
     */
    protected $prettifier;

    /**
     * @var string
     */
    protected $testClass = '';

    /**
     * @var int
     */
<<<<<<< HEAD
    protected $testStatus = false;
=======
    protected $testStatus;
>>>>>>> update

    /**
     * @var array
     */
    protected $tests = [];

    /**
     * @var int
     */
    protected $successful = 0;

    /**
     * @var int
     */
    protected $warned = 0;

    /**
     * @var int
     */
    protected $failed = 0;

    /**
     * @var int
     */
    protected $risky = 0;

    /**
     * @var int
     */
    protected $skipped = 0;

    /**
     * @var int
     */
    protected $incomplete = 0;

    /**
<<<<<<< HEAD
     * @var string
=======
     * @var null|string
>>>>>>> update
     */
    protected $currentTestClassPrettified;

    /**
<<<<<<< HEAD
     * @var string
=======
     * @var null|string
>>>>>>> update
     */
    protected $currentTestMethodPrettified;

    /**
     * @var array
     */
    private $groups;

    /**
     * @var array
     */
    private $excludeGroups;

    /**
     * @param resource $out
<<<<<<< HEAD
     * @param array    $groups
     * @param array    $excludeGroups
=======
     *
     * @throws \PHPUnit\Framework\Exception
>>>>>>> update
     */
    public function __construct($out = null, array $groups = [], array $excludeGroups = [])
    {
        parent::__construct($out);

        $this->groups        = $groups;
        $this->excludeGroups = $excludeGroups;

<<<<<<< HEAD
        $this->prettifier = new PHPUnit_Util_TestDox_NamePrettifier;
=======
        $this->prettifier = new NamePrettifier;
>>>>>>> update
        $this->startRun();
    }

    /**
     * Flush buffer and close output.
     */
<<<<<<< HEAD
    public function flush()
=======
    public function flush(): void
>>>>>>> update
    {
        $this->doEndClass();
        $this->endRun();

        parent::flush();
    }

    /**
     * An error occurred.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     */
    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time)
=======
     */
    public function addError(Test $test, Throwable $t, float $time): void
>>>>>>> update
    {
        if (!$this->isOfInterest($test)) {
            return;
        }

<<<<<<< HEAD
        $this->testStatus = PHPUnit_Runner_BaseTestRunner::STATUS_ERROR;
=======
        $this->testStatus = BaseTestRunner::STATUS_ERROR;
>>>>>>> update
        $this->failed++;
    }

    /**
     * A warning occurred.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test    $test
     * @param PHPUnit_Framework_Warning $e
     * @param float                     $time
     *
     * @since Method available since Release 5.1.0
     */
    public function addWarning(PHPUnit_Framework_Test $test, PHPUnit_Framework_Warning $e, $time)
=======
     */
    public function addWarning(Test $test, Warning $e, float $time): void
>>>>>>> update
    {
        if (!$this->isOfInterest($test)) {
            return;
        }

<<<<<<< HEAD
        $this->testStatus = PHPUnit_Runner_BaseTestRunner::STATUS_WARNING;
=======
        $this->testStatus = BaseTestRunner::STATUS_WARNING;
>>>>>>> update
        $this->warned++;
    }

    /**
     * A failure occurred.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test                 $test
     * @param PHPUnit_Framework_AssertionFailedError $e
     * @param float                                  $time
     */
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
=======
     */
    public function addFailure(Test $test, AssertionFailedError $e, float $time): void
>>>>>>> update
    {
        if (!$this->isOfInterest($test)) {
            return;
        }

<<<<<<< HEAD
        $this->testStatus = PHPUnit_Runner_BaseTestRunner::STATUS_FAILURE;
=======
        $this->testStatus = BaseTestRunner::STATUS_FAILURE;
>>>>>>> update
        $this->failed++;
    }

    /**
     * Incomplete test.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     */
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time)
=======
     */
    public function addIncompleteTest(Test $test, Throwable $t, float $time): void
>>>>>>> update
    {
        if (!$this->isOfInterest($test)) {
            return;
        }

<<<<<<< HEAD
        $this->testStatus = PHPUnit_Runner_BaseTestRunner::STATUS_INCOMPLETE;
=======
        $this->testStatus = BaseTestRunner::STATUS_INCOMPLETE;
>>>>>>> update
        $this->incomplete++;
    }

    /**
     * Risky test.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     *
     * @since Method available since Release 4.0.0
     */
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time)
=======
     */
    public function addRiskyTest(Test $test, Throwable $t, float $time): void
>>>>>>> update
    {
        if (!$this->isOfInterest($test)) {
            return;
        }

<<<<<<< HEAD
        $this->testStatus = PHPUnit_Runner_BaseTestRunner::STATUS_RISKY;
=======
        $this->testStatus = BaseTestRunner::STATUS_RISKY;
>>>>>>> update
        $this->risky++;
    }

    /**
     * Skipped test.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     *
     * @since Method available since Release 3.0.0
     */
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time)
=======
     */
    public function addSkippedTest(Test $test, Throwable $t, float $time): void
>>>>>>> update
    {
        if (!$this->isOfInterest($test)) {
            return;
        }

<<<<<<< HEAD
        $this->testStatus = PHPUnit_Runner_BaseTestRunner::STATUS_SKIPPED;
=======
        $this->testStatus = BaseTestRunner::STATUS_SKIPPED;
>>>>>>> update
        $this->skipped++;
    }

    /**
     * A testsuite started.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @since Method available since Release 2.2.0
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
=======
     */
    public function startTestSuite(TestSuite $suite): void
>>>>>>> update
    {
    }

    /**
     * A testsuite ended.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @since Method available since Release 2.2.0
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
=======
     */
    public function endTestSuite(TestSuite $suite): void
>>>>>>> update
    {
    }

    /**
     * A test started.
     *
<<<<<<< HEAD
     * @param PHPUnit_Framework_Test $test
     */
    public function startTest(PHPUnit_Framework_Test $test)
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function startTest(Test $test): void
>>>>>>> update
    {
        if (!$this->isOfInterest($test)) {
            return;
        }

        $class = get_class($test);

<<<<<<< HEAD
        if ($this->testClass != $class) {
            if ($this->testClass != '') {
                $this->doEndClass();
            }

            $classAnnotations = PHPUnit_Util_Test::parseTestMethodAnnotations($class);
            if (isset($classAnnotations['class']['testdox'][0])) {
                $this->currentTestClassPrettified = $classAnnotations['class']['testdox'][0];
            } else {
                $this->currentTestClassPrettified = $this->prettifier->prettifyTestClass($class);
            }

            $this->startClass($class);

            $this->testClass = $class;
            $this->tests     = [];
        }

        $annotations = $test->getAnnotations();

        if (isset($annotations['method']['testdox'][0])) {
            $this->currentTestMethodPrettified = $annotations['method']['testdox'][0];
        } else {
            $this->currentTestMethodPrettified = $this->prettifier->prettifyTestMethod($test->getName(false));
        }

        if ($test instanceof PHPUnit_Framework_TestCase && $test->usesDataProvider()) {
            $this->currentTestMethodPrettified .= ' ' . $test->dataDescription();
        }

        $this->testStatus = PHPUnit_Runner_BaseTestRunner::STATUS_PASSED;
=======
        if ($this->testClass !== $class) {
            if ($this->testClass !== '') {
                $this->doEndClass();
            }

            $this->currentTestClassPrettified = $this->prettifier->prettifyTestClass($class);
            $this->testClass                  = $class;
            $this->tests                      = [];

            $this->startClass($class);
        }

        if ($test instanceof TestCase) {
            $this->currentTestMethodPrettified = $this->prettifier->prettifyTestCase($test);
        }

        $this->testStatus = BaseTestRunner::STATUS_PASSED;
>>>>>>> update
    }

    /**
     * A test ended.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param float                  $time
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
=======
     */
    public function endTest(Test $test, float $time): void
>>>>>>> update
    {
        if (!$this->isOfInterest($test)) {
            return;
        }

<<<<<<< HEAD
        if (!isset($this->tests[$this->currentTestMethodPrettified])) {
            if ($this->testStatus == PHPUnit_Runner_BaseTestRunner::STATUS_PASSED) {
                $this->tests[$this->currentTestMethodPrettified]['success'] = 1;
                $this->tests[$this->currentTestMethodPrettified]['failure'] = 0;
            } else {
                $this->tests[$this->currentTestMethodPrettified]['success'] = 0;
                $this->tests[$this->currentTestMethodPrettified]['failure'] = 1;
            }
        } else {
            if ($this->testStatus == PHPUnit_Runner_BaseTestRunner::STATUS_PASSED) {
                $this->tests[$this->currentTestMethodPrettified]['success']++;
            } else {
                $this->tests[$this->currentTestMethodPrettified]['failure']++;
            }
        }
=======
        $this->tests[] = [$this->currentTestMethodPrettified, $this->testStatus];
>>>>>>> update

        $this->currentTestClassPrettified  = null;
        $this->currentTestMethodPrettified = null;
    }

<<<<<<< HEAD
    /**
     * @since Method available since Release 2.3.0
     */
    protected function doEndClass()
    {
        foreach ($this->tests as $name => $data) {
            $this->onTest($name, $data['failure'] == 0);
=======
    protected function doEndClass(): void
    {
        foreach ($this->tests as $test) {
            $this->onTest($test[0], $test[1] === BaseTestRunner::STATUS_PASSED);
>>>>>>> update
        }

        $this->endClass($this->testClass);
    }

    /**
     * Handler for 'start run' event.
     */
<<<<<<< HEAD
    protected function startRun()
=======
    protected function startRun(): void
>>>>>>> update
    {
    }

    /**
     * Handler for 'start class' event.
<<<<<<< HEAD
     *
     * @param string $name
     */
    protected function startClass($name)
=======
     */
    protected function startClass(string $name): void
>>>>>>> update
    {
    }

    /**
     * Handler for 'on test' event.
<<<<<<< HEAD
     *
     * @param string $name
     * @param bool   $success
     */
    protected function onTest($name, $success = true)
=======
     */
    protected function onTest(string $name, bool $success = true): void
>>>>>>> update
    {
    }

    /**
     * Handler for 'end class' event.
<<<<<<< HEAD
     *
     * @param string $name
     */
    protected function endClass($name)
=======
     */
    protected function endClass(string $name): void
>>>>>>> update
    {
    }

    /**
     * Handler for 'end run' event.
     */
<<<<<<< HEAD
    protected function endRun()
    {
    }

    /**
     * @param PHPUnit_Framework_Test $test
     *
     * @return bool
     */
    private function isOfInterest(PHPUnit_Framework_Test $test)
    {
        if (!$test instanceof PHPUnit_Framework_TestCase) {
            return false;
        }

        if ($test instanceof PHPUnit_Framework_WarningTestCase) {
=======
    protected function endRun(): void
    {
    }

    private function isOfInterest(Test $test): bool
    {
        if (!$test instanceof TestCase) {
            return false;
        }

        if ($test instanceof ErrorTestCase || $test instanceof WarningTestCase) {
>>>>>>> update
            return false;
        }

        if (!empty($this->groups)) {
            foreach ($test->getGroups() as $group) {
<<<<<<< HEAD
                if (in_array($group, $this->groups)) {
=======
                if (in_array($group, $this->groups, true)) {
>>>>>>> update
                    return true;
                }
            }

            return false;
        }

        if (!empty($this->excludeGroups)) {
            foreach ($test->getGroups() as $group) {
<<<<<<< HEAD
                if (in_array($group, $this->excludeGroups)) {
=======
                if (in_array($group, $this->excludeGroups, true)) {
>>>>>>> update
                    return false;
                }
            }

            return true;
        }

        return true;
    }
}
