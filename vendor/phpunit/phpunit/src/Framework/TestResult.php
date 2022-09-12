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

use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Exception as CodeCoverageException;
use SebastianBergmann\CodeCoverage\CoveredCodeNotExecutedException;
use SebastianBergmann\CodeCoverage\MissingCoversAnnotationException;
use SebastianBergmann\CodeCoverage\UnintentionallyCoveredCodeException;
use SebastianBergmann\ResourceOperations\ResourceOperations;

/**
 * A TestResult collects the results of executing a test case.
 *
 * @since Class available since Release 2.0.0
 */
class PHPUnit_Framework_TestResult implements Countable
=======
namespace PHPUnit\Framework;

use const PHP_EOL;
use function count;
use function function_exists;
use function get_class;
use function sprintf;
use function xdebug_get_monitored_functions;
use function xdebug_is_debugger_active;
use function xdebug_start_function_monitor;
use function xdebug_stop_function_monitor;
use AssertionError;
use Countable;
use Error;
use PHPUnit\Util\ErrorHandler;
use PHPUnit\Util\ExcludeList;
use PHPUnit\Util\Printer;
use PHPUnit\Util\Test as TestUtil;
use ReflectionClass;
use ReflectionException;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Exception as OriginalCodeCoverageException;
use SebastianBergmann\CodeCoverage\UnintentionallyCoveredCodeException;
use SebastianBergmann\Invoker\Invoker;
use SebastianBergmann\Invoker\TimeoutException;
use SebastianBergmann\ResourceOperations\ResourceOperations;
use SebastianBergmann\Timer\Timer;
use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class TestResult implements Countable
>>>>>>> update
{
    /**
     * @var array
     */
<<<<<<< HEAD
    protected $passed = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var array
     */
    protected $failures = [];

    /**
     * @var array
     */
    protected $warnings = [];

    /**
     * @var array
     */
    protected $notImplemented = [];

    /**
     * @var array
     */
    protected $risky = [];

    /**
     * @var array
     */
    protected $skipped = [];

    /**
     * @var array
     */
    protected $listeners = [];
=======
    private $passed = [];

    /**
     * @var array<string>
     */
    private $passedTestClasses = [];

    /**
     * @var bool
     */
    private $currentTestSuiteFailed = false;

    /**
     * @var TestFailure[]
     */
    private $errors = [];

    /**
     * @var TestFailure[]
     */
    private $failures = [];

    /**
     * @var TestFailure[]
     */
    private $warnings = [];

    /**
     * @var TestFailure[]
     */
    private $notImplemented = [];

    /**
     * @var TestFailure[]
     */
    private $risky = [];

    /**
     * @var TestFailure[]
     */
    private $skipped = [];

    /**
     * @deprecated Use the `TestHook` interfaces instead
     *
     * @var TestListener[]
     */
    private $listeners = [];
>>>>>>> update

    /**
     * @var int
     */
<<<<<<< HEAD
    protected $runTests = 0;
=======
    private $runTests = 0;
>>>>>>> update

    /**
     * @var float
     */
<<<<<<< HEAD
    protected $time = 0;

    /**
     * @var PHPUnit_Framework_TestSuite
     */
    protected $topTestSuite = null;
=======
    private $time = 0;
>>>>>>> update

    /**
     * Code Coverage information.
     *
     * @var CodeCoverage
     */
<<<<<<< HEAD
    protected $codeCoverage;
=======
    private $codeCoverage;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $convertErrorsToExceptions = true;
=======
    private $convertDeprecationsToExceptions = false;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $stop = false;
=======
    private $convertErrorsToExceptions = true;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $stopOnError = false;
=======
    private $convertNoticesToExceptions = true;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $stopOnFailure = false;
=======
    private $convertWarningsToExceptions = true;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $stopOnWarning = false;
=======
    private $stop = false;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $beStrictAboutTestsThatDoNotTestAnything = false;
=======
    private $stopOnError = false;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $beStrictAboutOutputDuringTests = false;
=======
    private $stopOnFailure = false;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $beStrictAboutTodoAnnotatedTests = false;
=======
    private $stopOnWarning = false;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $beStrictAboutResourceUsageDuringSmallTests = false;
=======
    private $beStrictAboutTestsThatDoNotTestAnything = true;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $enforceTimeLimit = false;
=======
    private $beStrictAboutOutputDuringTests = false;

    /**
     * @var bool
     */
    private $beStrictAboutTodoAnnotatedTests = false;

    /**
     * @var bool
     */
    private $beStrictAboutResourceUsageDuringSmallTests = false;

    /**
     * @var bool
     */
    private $enforceTimeLimit = false;

    /**
     * @var bool
     */
    private $forceCoversAnnotation = false;
>>>>>>> update

    /**
     * @var int
     */
<<<<<<< HEAD
    protected $timeoutForSmallTests = 1;
=======
    private $timeoutForSmallTests = 1;
>>>>>>> update

    /**
     * @var int
     */
<<<<<<< HEAD
    protected $timeoutForMediumTests = 10;
=======
    private $timeoutForMediumTests = 10;
>>>>>>> update

    /**
     * @var int
     */
<<<<<<< HEAD
    protected $timeoutForLargeTests = 60;
=======
    private $timeoutForLargeTests = 60;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $stopOnRisky = false;
=======
    private $stopOnRisky = false;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $stopOnIncomplete = false;
=======
    private $stopOnIncomplete = false;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $stopOnSkipped = false;
=======
    private $stopOnSkipped = false;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $lastTestFailed = false;
=======
    private $lastTestFailed = false;

    /**
     * @var int
     */
    private $defaultTimeLimit = 0;

    /**
     * @var bool
     */
    private $stopOnDefect = false;
>>>>>>> update

    /**
     * @var bool
     */
    private $registerMockObjectsFromTestArgumentsRecursively = false;

    /**
<<<<<<< HEAD
     * Registers a TestListener.
     *
     * @param  PHPUnit_Framework_TestListener
     */
    public function addListener(PHPUnit_Framework_TestListener $listener)
=======
     * @deprecated Use the `TestHook` interfaces instead
     *
     * @codeCoverageIgnore
     *
     * Registers a TestListener.
     */
    public function addListener(TestListener $listener): void
>>>>>>> update
    {
        $this->listeners[] = $listener;
    }

    /**
<<<<<<< HEAD
     * Unregisters a TestListener.
     *
     * @param PHPUnit_Framework_TestListener $listener
     */
    public function removeListener(PHPUnit_Framework_TestListener $listener)
=======
     * @deprecated Use the `TestHook` interfaces instead
     *
     * @codeCoverageIgnore
     *
     * Unregisters a TestListener.
     */
    public function removeListener(TestListener $listener): void
>>>>>>> update
    {
        foreach ($this->listeners as $key => $_listener) {
            if ($listener === $_listener) {
                unset($this->listeners[$key]);
            }
        }
    }

    /**
<<<<<<< HEAD
     * Flushes all flushable TestListeners.
     *
     * @since Method available since Release 3.0.0
     */
    public function flushListeners()
    {
        foreach ($this->listeners as $listener) {
            if ($listener instanceof PHPUnit_Util_Printer) {
=======
     * @deprecated Use the `TestHook` interfaces instead
     *
     * @codeCoverageIgnore
     *
     * Flushes all flushable TestListeners.
     */
    public function flushListeners(): void
    {
        foreach ($this->listeners as $listener) {
            if ($listener instanceof Printer) {
>>>>>>> update
                $listener->flush();
            }
        }
    }

    /**
     * Adds an error to the list of errors.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param Throwable              $t
     * @param float                  $time
     */
    public function addError(PHPUnit_Framework_Test $test, $t, $time)
    {
        if ($t instanceof PHPUnit_Framework_RiskyTest) {
            $this->risky[] = new PHPUnit_Framework_TestFailure($test, $t);
            $notifyMethod  = 'addRiskyTest';

            if ($this->stopOnRisky) {
                $this->stop();
            }
        } elseif ($t instanceof PHPUnit_Framework_IncompleteTest) {
            $this->notImplemented[] = new PHPUnit_Framework_TestFailure($test, $t);
            $notifyMethod           = 'addIncompleteTest';
=======
     */
    public function addError(Test $test, Throwable $t, float $time): void
    {
        if ($t instanceof RiskyTestError) {
            $this->recordRisky($test, $t);

            $notifyMethod = 'addRiskyTest';

            if ($test instanceof TestCase) {
                $test->markAsRisky();
            }

            if ($this->stopOnRisky || $this->stopOnDefect) {
                $this->stop();
            }
        } elseif ($t instanceof IncompleteTest) {
            $this->recordNotImplemented($test, $t);

            $notifyMethod = 'addIncompleteTest';
>>>>>>> update

            if ($this->stopOnIncomplete) {
                $this->stop();
            }
<<<<<<< HEAD
        } elseif ($t instanceof PHPUnit_Framework_SkippedTest) {
            $this->skipped[] = new PHPUnit_Framework_TestFailure($test, $t);
            $notifyMethod    = 'addSkippedTest';
=======
        } elseif ($t instanceof SkippedTest) {
            $this->recordSkipped($test, $t);

            $notifyMethod = 'addSkippedTest';
>>>>>>> update

            if ($this->stopOnSkipped) {
                $this->stop();
            }
        } else {
<<<<<<< HEAD
            $this->errors[] = new PHPUnit_Framework_TestFailure($test, $t);
            $notifyMethod   = 'addError';
=======
            $this->recordError($test, $t);

            $notifyMethod = 'addError';
>>>>>>> update

            if ($this->stopOnError || $this->stopOnFailure) {
                $this->stop();
            }
        }

        // @see https://github.com/sebastianbergmann/phpunit/issues/1953
        if ($t instanceof Error) {
<<<<<<< HEAD
            $t = new PHPUnit_Framework_ExceptionWrapper($t);
        }

        foreach ($this->listeners as $listener) {
            $listener->$notifyMethod($test, $t, $time);
        }

        $this->lastTestFailed = true;
        $this->time          += $time;
=======
            $t = new ExceptionWrapper($t);
        }

        foreach ($this->listeners as $listener) {
            $listener->{$notifyMethod}($test, $t, $time);
        }

        $this->lastTestFailed = true;
        $this->time += $time;
>>>>>>> update
    }

    /**
     * Adds a warning to the list of warnings.
     * The passed in exception caused the warning.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test    $test
     * @param PHPUnit_Framework_Warning $e
     * @param float                     $time
     *
     * @since Method available since Release 5.1.0
     */
    public function addWarning(PHPUnit_Framework_Test $test, PHPUnit_Framework_Warning $e, $time)
    {
        if ($this->stopOnWarning) {
            $this->stop();
        }

        $this->warnings[] = new PHPUnit_Framework_TestFailure($test, $e);

        foreach ($this->listeners as $listener) {
            // @todo Remove check for PHPUnit 6.0.0
            // @see  https://github.com/sebastianbergmann/phpunit/pull/1840#issuecomment-162535997
            if (method_exists($listener, 'addWarning')) {
                $listener->addWarning($test, $e, $time);
            }
=======
     */
    public function addWarning(Test $test, Warning $e, float $time): void
    {
        if ($this->stopOnWarning || $this->stopOnDefect) {
            $this->stop();
        }

        $this->recordWarning($test, $e);

        foreach ($this->listeners as $listener) {
            $listener->addWarning($test, $e, $time);
>>>>>>> update
        }

        $this->time += $time;
    }

    /**
     * Adds a failure to the list of failures.
     * The passed in exception caused the failure.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test                 $test
     * @param PHPUnit_Framework_AssertionFailedError $e
     * @param float                                  $time
     */
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        if ($e instanceof PHPUnit_Framework_RiskyTest ||
            $e instanceof PHPUnit_Framework_OutputError) {
            $this->risky[] = new PHPUnit_Framework_TestFailure($test, $e);
            $notifyMethod  = 'addRiskyTest';

            if ($this->stopOnRisky) {
                $this->stop();
            }
        } elseif ($e instanceof PHPUnit_Framework_IncompleteTest) {
            $this->notImplemented[] = new PHPUnit_Framework_TestFailure($test, $e);
            $notifyMethod           = 'addIncompleteTest';
=======
     */
    public function addFailure(Test $test, AssertionFailedError $e, float $time): void
    {
        if ($e instanceof RiskyTestError || $e instanceof OutputError) {
            $this->recordRisky($test, $e);

            $notifyMethod = 'addRiskyTest';

            if ($test instanceof TestCase) {
                $test->markAsRisky();
            }

            if ($this->stopOnRisky || $this->stopOnDefect) {
                $this->stop();
            }
        } elseif ($e instanceof IncompleteTest) {
            $this->recordNotImplemented($test, $e);

            $notifyMethod = 'addIncompleteTest';
>>>>>>> update

            if ($this->stopOnIncomplete) {
                $this->stop();
            }
<<<<<<< HEAD
        } elseif ($e instanceof PHPUnit_Framework_SkippedTest) {
            $this->skipped[] = new PHPUnit_Framework_TestFailure($test, $e);
            $notifyMethod    = 'addSkippedTest';
=======
        } elseif ($e instanceof SkippedTest) {
            $this->recordSkipped($test, $e);

            $notifyMethod = 'addSkippedTest';
>>>>>>> update

            if ($this->stopOnSkipped) {
                $this->stop();
            }
        } else {
<<<<<<< HEAD
            $this->failures[] = new PHPUnit_Framework_TestFailure($test, $e);
            $notifyMethod     = 'addFailure';

            if ($this->stopOnFailure) {
=======
            $this->failures[] = new TestFailure($test, $e);
            $notifyMethod     = 'addFailure';

            if ($this->stopOnFailure || $this->stopOnDefect) {
>>>>>>> update
                $this->stop();
            }
        }

        foreach ($this->listeners as $listener) {
<<<<<<< HEAD
            $listener->$notifyMethod($test, $e, $time);
        }

        $this->lastTestFailed = true;
        $this->time          += $time;
    }

    /**
     * Informs the result that a testsuite will be started.
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @since Method available since Release 2.2.0
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
        if ($this->topTestSuite === null) {
            $this->topTestSuite = $suite;
        }
=======
            $listener->{$notifyMethod}($test, $e, $time);
        }

        $this->lastTestFailed = true;
        $this->time += $time;
    }

    /**
     * Informs the result that a test suite will be started.
     */
    public function startTestSuite(TestSuite $suite): void
    {
        $this->currentTestSuiteFailed = false;
>>>>>>> update

        foreach ($this->listeners as $listener) {
            $listener->startTestSuite($suite);
        }
    }

    /**
<<<<<<< HEAD
     * Informs the result that a testsuite was completed.
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @since Method available since Release 2.2.0
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
=======
     * Informs the result that a test suite was completed.
     */
    public function endTestSuite(TestSuite $suite): void
    {
        if (!$this->currentTestSuiteFailed) {
            $this->passedTestClasses[] = $suite->getName();
        }

>>>>>>> update
        foreach ($this->listeners as $listener) {
            $listener->endTestSuite($suite);
        }
    }

    /**
     * Informs the result that a test will be started.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     */
    public function startTest(PHPUnit_Framework_Test $test)
    {
        $this->lastTestFailed = false;
        $this->runTests      += count($test);
=======
     */
    public function startTest(Test $test): void
    {
        $this->lastTestFailed = false;
        $this->runTests += count($test);
>>>>>>> update

        foreach ($this->listeners as $listener) {
            $listener->startTest($test);
        }
    }

    /**
     * Informs the result that a test was completed.
     *
<<<<<<< HEAD
     * @param PHPUnit_Framework_Test $test
     * @param float                  $time
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function endTest(Test $test, float $time): void
>>>>>>> update
    {
        foreach ($this->listeners as $listener) {
            $listener->endTest($test, $time);
        }

<<<<<<< HEAD
        if (!$this->lastTestFailed && $test instanceof PHPUnit_Framework_TestCase) {
            $class  = get_class($test);
            $key    = $class . '::' . $test->getName();

            $this->passed[$key] = [
                'result' => $test->getResult(),
                'size'   => PHPUnit_Util_Test::getSize(
                    $class,
                    $test->getName(false)
                )
=======
        if (!$this->lastTestFailed && $test instanceof TestCase) {
            $class = get_class($test);
            $key   = $class . '::' . $test->getName();

            $this->passed[$key] = [
                'result' => $test->getResult(),
                'size'   => TestUtil::getSize(
                    $class,
                    $test->getName(false)
                ),
>>>>>>> update
            ];

            $this->time += $time;
        }
<<<<<<< HEAD
=======

        if ($this->lastTestFailed && $test instanceof TestCase) {
            $this->currentTestSuiteFailed = true;
        }
>>>>>>> update
    }

    /**
     * Returns true if no risky test occurred.
<<<<<<< HEAD
     *
     * @return bool
     *
     * @since Method available since Release 4.0.0
     */
    public function allHarmless()
    {
        return $this->riskyCount() == 0;
=======
     */
    public function allHarmless(): bool
    {
        return $this->riskyCount() === 0;
>>>>>>> update
    }

    /**
     * Gets the number of risky tests.
<<<<<<< HEAD
     *
     * @return int
     *
     * @since Method available since Release 4.0.0
     */
    public function riskyCount()
=======
     */
    public function riskyCount(): int
>>>>>>> update
    {
        return count($this->risky);
    }

    /**
     * Returns true if no incomplete test occurred.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function allCompletelyImplemented()
    {
        return $this->notImplementedCount() == 0;
=======
     */
    public function allCompletelyImplemented(): bool
    {
        return $this->notImplementedCount() === 0;
>>>>>>> update
    }

    /**
     * Gets the number of incomplete tests.
<<<<<<< HEAD
     *
     * @return int
     */
    public function notImplementedCount()
=======
     */
    public function notImplementedCount(): int
>>>>>>> update
    {
        return count($this->notImplemented);
    }

    /**
<<<<<<< HEAD
     * Returns an Enumeration for the risky tests.
     *
     * @return array
     *
     * @since Method available since Release 4.0.0
     */
    public function risky()
=======
     * Returns an array of TestFailure objects for the risky tests.
     *
     * @return TestFailure[]
     */
    public function risky(): array
>>>>>>> update
    {
        return $this->risky;
    }

    /**
<<<<<<< HEAD
     * Returns an Enumeration for the incomplete tests.
     *
     * @return array
     */
    public function notImplemented()
=======
     * Returns an array of TestFailure objects for the incomplete tests.
     *
     * @return TestFailure[]
     */
    public function notImplemented(): array
>>>>>>> update
    {
        return $this->notImplemented;
    }

    /**
     * Returns true if no test has been skipped.
<<<<<<< HEAD
     *
     * @return bool
     *
     * @since Method available since Release 3.0.0
     */
    public function noneSkipped()
    {
        return $this->skippedCount() == 0;
=======
     */
    public function noneSkipped(): bool
    {
        return $this->skippedCount() === 0;
>>>>>>> update
    }

    /**
     * Gets the number of skipped tests.
<<<<<<< HEAD
     *
     * @return int
     *
     * @since Method available since Release 3.0.0
     */
    public function skippedCount()
=======
     */
    public function skippedCount(): int
>>>>>>> update
    {
        return count($this->skipped);
    }

    /**
<<<<<<< HEAD
     * Returns an Enumeration for the skipped tests.
     *
     * @return array
     *
     * @since Method available since Release 3.0.0
     */
    public function skipped()
=======
     * Returns an array of TestFailure objects for the skipped tests.
     *
     * @return TestFailure[]
     */
    public function skipped(): array
>>>>>>> update
    {
        return $this->skipped;
    }

    /**
     * Gets the number of detected errors.
<<<<<<< HEAD
     *
     * @return int
     */
    public function errorCount()
=======
     */
    public function errorCount(): int
>>>>>>> update
    {
        return count($this->errors);
    }

    /**
<<<<<<< HEAD
     * Returns an Enumeration for the errors.
     *
     * @return array
     */
    public function errors()
=======
     * Returns an array of TestFailure objects for the errors.
     *
     * @return TestFailure[]
     */
    public function errors(): array
>>>>>>> update
    {
        return $this->errors;
    }

    /**
     * Gets the number of detected failures.
<<<<<<< HEAD
     *
     * @return int
     */
    public function failureCount()
=======
     */
    public function failureCount(): int
>>>>>>> update
    {
        return count($this->failures);
    }

    /**
<<<<<<< HEAD
     * Returns an Enumeration for the failures.
     *
     * @return array
     */
    public function failures()
=======
     * Returns an array of TestFailure objects for the failures.
     *
     * @return TestFailure[]
     */
    public function failures(): array
>>>>>>> update
    {
        return $this->failures;
    }

    /**
     * Gets the number of detected warnings.
<<<<<<< HEAD
     *
     * @return int
     *
     * @since Method available since Release 5.1.0
     */
    public function warningCount()
=======
     */
    public function warningCount(): int
>>>>>>> update
    {
        return count($this->warnings);
    }

    /**
<<<<<<< HEAD
     * Returns an Enumeration for the warnings.
     *
     * @return array
     *
     * @since Method available since Release 5.1.0
     */
    public function warnings()
=======
     * Returns an array of TestFailure objects for the warnings.
     *
     * @return TestFailure[]
     */
    public function warnings(): array
>>>>>>> update
    {
        return $this->warnings;
    }

    /**
     * Returns the names of the tests that have passed.
<<<<<<< HEAD
     *
     * @return array
     *
     * @since Method available since Release 3.4.0
     */
    public function passed()
=======
     */
    public function passed(): array
>>>>>>> update
    {
        return $this->passed;
    }

    /**
<<<<<<< HEAD
     * Returns the (top) test suite.
     *
     * @return PHPUnit_Framework_TestSuite
     *
     * @since Method available since Release 3.0.0
     */
    public function topTestSuite()
    {
        return $this->topTestSuite;
=======
     * Returns the names of the TestSuites that have passed.
     *
     * This enables @depends-annotations for TestClassName::class
     */
    public function passedClasses(): array
    {
        return $this->passedTestClasses;
>>>>>>> update
    }

    /**
     * Returns whether code coverage information should be collected.
<<<<<<< HEAD
     *
     * @return bool If code coverage should be collected
     *
     * @since Method available since Release 3.2.0
     */
    public function getCollectCodeCoverageInformation()
=======
     */
    public function getCollectCodeCoverageInformation(): bool
>>>>>>> update
    {
        return $this->codeCoverage !== null;
    }

    /**
     * Runs a TestCase.
     *
<<<<<<< HEAD
     * @param PHPUnit_Framework_Test $test
     */
    public function run(PHPUnit_Framework_Test $test)
    {
        PHPUnit_Framework_Assert::resetCount();

        if ($test instanceof PHPUnit_Framework_TestCase) {
            $test->setRegisterMockObjectsFromTestArgumentsRecursively(
                $this->registerMockObjectsFromTestArgumentsRecursively
            );
=======
     * @throws \SebastianBergmann\CodeCoverage\InvalidArgumentException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws CodeCoverageException
     * @throws UnintentionallyCoveredCodeException
     */
    public function run(Test $test): void
    {
        Assert::resetCount();

        $size = TestUtil::UNKNOWN;

        if ($test instanceof TestCase) {
            $test->setRegisterMockObjectsFromTestArgumentsRecursively(
                $this->registerMockObjectsFromTestArgumentsRecursively
            );

            $isAnyCoverageRequired = TestUtil::requiresCodeCoverageDataCollection($test);
            $size                  = $test->getSize();
>>>>>>> update
        }

        $error      = false;
        $failure    = false;
        $warning    = false;
        $incomplete = false;
        $risky      = false;
        $skipped    = false;

        $this->startTest($test);

<<<<<<< HEAD
        $errorHandlerSet = false;

        if ($this->convertErrorsToExceptions) {
            $oldErrorHandler = set_error_handler(
                ['PHPUnit_Util_ErrorHandler', 'handleError'],
                E_ALL | E_STRICT
            );

            if ($oldErrorHandler === null) {
                $errorHandlerSet = true;
            } else {
                restore_error_handler();
            }
        }

        $collectCodeCoverage = $this->codeCoverage !== null &&
                               !$test instanceof PHPUnit_Framework_WarningTestCase;
=======
        if ($this->convertDeprecationsToExceptions || $this->convertErrorsToExceptions || $this->convertNoticesToExceptions || $this->convertWarningsToExceptions) {
            $errorHandler = new ErrorHandler(
                $this->convertDeprecationsToExceptions,
                $this->convertErrorsToExceptions,
                $this->convertNoticesToExceptions,
                $this->convertWarningsToExceptions
            );

            $errorHandler->register();
        }

        $collectCodeCoverage = $this->codeCoverage !== null &&
                               !$test instanceof ErrorTestCase &&
                               !$test instanceof WarningTestCase &&
                               $isAnyCoverageRequired;
>>>>>>> update

        if ($collectCodeCoverage) {
            $this->codeCoverage->start($test);
        }

        $monitorFunctions = $this->beStrictAboutResourceUsageDuringSmallTests &&
<<<<<<< HEAD
                            !$test instanceof PHPUnit_Framework_WarningTestCase &&
                            $test->getSize() == PHPUnit_Util_Test::SMALL &&
                            function_exists('xdebug_start_function_monitor');

        if ($monitorFunctions) {
            xdebug_start_function_monitor(ResourceOperations::getFunctions());
        }

        PHP_Timer::start();

        try {
            if (!$test instanceof PHPUnit_Framework_WarningTestCase &&
                $test->getSize() != PHPUnit_Util_Test::UNKNOWN &&
                $this->enforceTimeLimit &&
                extension_loaded('pcntl') && class_exists('PHP_Invoker')) {
                switch ($test->getSize()) {
                    case PHPUnit_Util_Test::SMALL:
                        $_timeout = $this->timeoutForSmallTests;
                        break;

                    case PHPUnit_Util_Test::MEDIUM:
                        $_timeout = $this->timeoutForMediumTests;
                        break;

                    case PHPUnit_Util_Test::LARGE:
                        $_timeout = $this->timeoutForLargeTests;
                        break;
                }

                $invoker = new PHP_Invoker;
=======
                            !$test instanceof ErrorTestCase &&
                            !$test instanceof WarningTestCase &&
                            $size === TestUtil::SMALL &&
                            function_exists('xdebug_start_function_monitor');

        if ($monitorFunctions) {
            /* @noinspection ForgottenDebugOutputInspection */
            xdebug_start_function_monitor(ResourceOperations::getFunctions());
        }

        $timer = new Timer;
        $timer->start();

        try {
            $invoker = new Invoker;

            if (!$test instanceof ErrorTestCase &&
                !$test instanceof WarningTestCase &&
                $this->shouldTimeLimitBeEnforced($size) &&
                $invoker->canInvokeWithTimeout()) {
                switch ($size) {
                    case TestUtil::SMALL:
                        $_timeout = $this->timeoutForSmallTests;

                        break;

                    case TestUtil::MEDIUM:
                        $_timeout = $this->timeoutForMediumTests;

                        break;

                    case TestUtil::LARGE:
                        $_timeout = $this->timeoutForLargeTests;

                        break;

                    default:
                        $_timeout = $this->defaultTimeLimit;
                }

>>>>>>> update
                $invoker->invoke([$test, 'runBare'], [], $_timeout);
            } else {
                $test->runBare();
            }
<<<<<<< HEAD
        } catch (PHPUnit_Framework_MockObject_Exception $e) {
            $e = new PHPUnit_Framework_Warning(
                $e->getMessage()
            );

            $warning = true;
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            $failure = true;

            if ($e instanceof PHPUnit_Framework_RiskyTestError) {
                $risky = true;
            } elseif ($e instanceof PHPUnit_Framework_IncompleteTestError) {
                $incomplete = true;
            } elseif ($e instanceof PHPUnit_Framework_SkippedTestError) {
=======
        } catch (TimeoutException $e) {
            $this->addFailure(
                $test,
                new RiskyTestError(
                    $e->getMessage()
                ),
                $_timeout
            );

            $risky = true;
        } catch (AssertionFailedError $e) {
            $failure = true;

            if ($e instanceof RiskyTestError) {
                $risky = true;
            } elseif ($e instanceof IncompleteTestError) {
                $incomplete = true;
            } elseif ($e instanceof SkippedTestError) {
>>>>>>> update
                $skipped = true;
            }
        } catch (AssertionError $e) {
            $test->addToAssertionCount(1);

            $failure = true;
            $frame   = $e->getTrace()[0];

<<<<<<< HEAD
            $e = new PHPUnit_Framework_AssertionFailedError(
                sprintf(
                    '%s in %s:%s',
                    $e->getMessage(),
                    $frame['file'],
                    $frame['line']
                )
            );
        } catch (PHPUnit_Framework_Warning $e) {
            $warning = true;
        } catch (PHPUnit_Framework_Exception $e) {
            $error = true;
        } catch (Throwable $e) {
            $e     = new PHPUnit_Framework_ExceptionWrapper($e);
            $error = true;
        } catch (Exception $e) {
            $e     = new PHPUnit_Framework_ExceptionWrapper($e);
            $error = true;
        }

        $time = PHP_Timer::stop();
        $test->addToAssertionCount(PHPUnit_Framework_Assert::getCount());

        if ($monitorFunctions) {
            $blacklist = new PHPUnit_Util_Blacklist;
            $functions = xdebug_get_monitored_functions();
            xdebug_stop_function_monitor();

            foreach ($functions as $function) {
                if (!$blacklist->isBlacklisted($function['filename'])) {
                    $this->addFailure(
                        $test,
                        new PHPUnit_Framework_RiskyTestError(
=======
            $e = new AssertionFailedError(
                sprintf(
                    '%s in %s:%s',
                    $e->getMessage(),
                    $frame['file'] ?? $e->getFile(),
                    $frame['line'] ?? $e->getLine()
                ),
                0,
                $e
            );
        } catch (Warning $e) {
            $warning = true;
        } catch (Exception $e) {
            $error = true;
        } catch (Throwable $e) {
            $e     = new ExceptionWrapper($e);
            $error = true;
        }

        $time = $timer->stop()->asSeconds();

        $test->addToAssertionCount(Assert::getCount());

        if ($monitorFunctions) {
            $excludeList = new ExcludeList;

            /** @noinspection ForgottenDebugOutputInspection */
            $functions = xdebug_get_monitored_functions();

            /* @noinspection ForgottenDebugOutputInspection */
            xdebug_stop_function_monitor();

            foreach ($functions as $function) {
                if (!$excludeList->isExcluded($function['filename'])) {
                    $this->addFailure(
                        $test,
                        new RiskyTestError(
>>>>>>> update
                            sprintf(
                                '%s() used in %s:%s',
                                $function['function'],
                                $function['filename'],
                                $function['lineno']
                            )
                        ),
                        $time
                    );
                }
            }
        }

        if ($this->beStrictAboutTestsThatDoNotTestAnything &&
<<<<<<< HEAD
            $test->getNumAssertions() == 0) {
            $risky = true;
        }

=======
            $test->getNumAssertions() === 0) {
            $risky = true;
        }

        if ($this->forceCoversAnnotation && !$error && !$failure && !$warning && !$incomplete && !$skipped && !$risky) {
            $annotations = TestUtil::parseTestMethodAnnotations(
                get_class($test),
                $test->getName(false)
            );

            if (!isset($annotations['class']['covers']) &&
                !isset($annotations['method']['covers']) &&
                !isset($annotations['class']['coversNothing']) &&
                !isset($annotations['method']['coversNothing'])) {
                $this->addFailure(
                    $test,
                    new MissingCoversAnnotationException(
                        'This test does not have a @covers annotation but is expected to have one'
                    ),
                    $time
                );

                $risky = true;
            }
        }

>>>>>>> update
        if ($collectCodeCoverage) {
            $append           = !$risky && !$incomplete && !$skipped;
            $linesToBeCovered = [];
            $linesToBeUsed    = [];

<<<<<<< HEAD
            if ($append && $test instanceof PHPUnit_Framework_TestCase) {
                try {
                    $linesToBeCovered = PHPUnit_Util_Test::getLinesToBeCovered(
=======
            if ($append && $test instanceof TestCase) {
                try {
                    $linesToBeCovered = TestUtil::getLinesToBeCovered(
>>>>>>> update
                        get_class($test),
                        $test->getName(false)
                    );

<<<<<<< HEAD
                    $linesToBeUsed = PHPUnit_Util_Test::getLinesToBeUsed(
                        get_class($test),
                        $test->getName(false)
                    );
                } catch (PHPUnit_Framework_InvalidCoversTargetException $cce) {
                    $this->addWarning(
                        $test,
                        new PHPUnit_Framework_Warning(
=======
                    $linesToBeUsed = TestUtil::getLinesToBeUsed(
                        get_class($test),
                        $test->getName(false)
                    );
                } catch (InvalidCoversTargetException $cce) {
                    $this->addWarning(
                        $test,
                        new Warning(
>>>>>>> update
                            $cce->getMessage()
                        ),
                        $time
                    );
                }
            }

            try {
                $this->codeCoverage->stop(
                    $append,
                    $linesToBeCovered,
                    $linesToBeUsed
                );
            } catch (UnintentionallyCoveredCodeException $cce) {
<<<<<<< HEAD
                if (!$test->isMedium() && !$test->isLarge()) {
                    $this->addFailure(
                        $test,
                        new PHPUnit_Framework_UnintentionallyCoveredCodeError(
                            'This test executed code that is not listed as code to be covered or used:' .
                            PHP_EOL . $cce->getMessage()
                        ),
                        $time
                    );
                }
            } catch (CoveredCodeNotExecutedException $cce) {
                $this->addFailure(
                    $test,
                    new PHPUnit_Framework_CoveredCodeNotExecutedException(
                        'This test did not execute all the code that is listed as code to be covered:' .
                        PHP_EOL . $cce->getMessage()
                    ),
                    $time
                );
            } catch (MissingCoversAnnotationException $cce) {
                if ($linesToBeCovered !== false) {
                    $this->addFailure(
                        $test,
                        new PHPUnit_Framework_MissingCoversAnnotationException(
                            'This test does not have a @covers annotation but is expected to have one'
                        ),
                        $time
                    );
                }
            } catch (CodeCoverageException $cce) {
                $error = true;

                if (!isset($e)) {
                    $e = $cce;
                }
            }
        }

        if ($errorHandlerSet === true) {
            restore_error_handler();
        }

        if ($error === true) {
            $this->addError($test, $e, $time);
        } elseif ($failure === true) {
            $this->addFailure($test, $e, $time);
        } elseif ($warning === true) {
            $this->addWarning($test, $e, $time);
        } elseif ($this->beStrictAboutTestsThatDoNotTestAnything &&
                  !$test->doesNotPerformAssertions() &&
                  $test->getNumAssertions() == 0) {
            $this->addFailure(
                $test,
                new PHPUnit_Framework_RiskyTestError(
                    'This test did not perform any assertions'
=======
                $unintentionallyCoveredCodeError = new UnintentionallyCoveredCodeError(
                    'This test executed code that is not listed as code to be covered or used:' .
                    PHP_EOL . $cce->getMessage()
                );
            } catch (OriginalCodeCoverageException $cce) {
                $error = true;

                $e = $e ?? $cce;
            }
        }

        if (isset($errorHandler)) {
            $errorHandler->unregister();

            unset($errorHandler);
        }

        if ($error) {
            $this->addError($test, $e, $time);
        } elseif ($failure) {
            $this->addFailure($test, $e, $time);
        } elseif ($warning) {
            $this->addWarning($test, $e, $time);
        } elseif (isset($unintentionallyCoveredCodeError)) {
            $this->addFailure(
                $test,
                $unintentionallyCoveredCodeError,
                $time
            );
        } elseif ($this->beStrictAboutTestsThatDoNotTestAnything &&
            !$test->doesNotPerformAssertions() &&
            $test->getNumAssertions() === 0) {
            try {
                $reflected = new ReflectionClass($test);
                // @codeCoverageIgnoreStart
            } catch (ReflectionException $e) {
                throw new Exception(
                    $e->getMessage(),
                    (int) $e->getCode(),
                    $e
                );
            }
            // @codeCoverageIgnoreEnd

            $name = $test->getName(false);

            if ($name && $reflected->hasMethod($name)) {
                try {
                    $reflected = $reflected->getMethod($name);
                    // @codeCoverageIgnoreStart
                } catch (ReflectionException $e) {
                    throw new Exception(
                        $e->getMessage(),
                        (int) $e->getCode(),
                        $e
                    );
                }
                // @codeCoverageIgnoreEnd
            }

            $this->addFailure(
                $test,
                new RiskyTestError(
                    sprintf(
                        "This test did not perform any assertions\n\n%s:%d",
                        $reflected->getFileName(),
                        $reflected->getStartLine()
                    )
                ),
                $time
            );
        } elseif ($this->beStrictAboutTestsThatDoNotTestAnything &&
            $test->doesNotPerformAssertions() &&
            $test->getNumAssertions() > 0) {
            $this->addFailure(
                $test,
                new RiskyTestError(
                    sprintf(
                        'This test is annotated with "@doesNotPerformAssertions" but performed %d assertions',
                        $test->getNumAssertions()
                    )
>>>>>>> update
                ),
                $time
            );
        } elseif ($this->beStrictAboutOutputDuringTests && $test->hasOutput()) {
            $this->addFailure(
                $test,
<<<<<<< HEAD
                new PHPUnit_Framework_OutputError(
=======
                new OutputError(
>>>>>>> update
                    sprintf(
                        'This test printed output: %s',
                        $test->getActualOutput()
                    )
                ),
                $time
            );
<<<<<<< HEAD
        } elseif ($this->beStrictAboutTodoAnnotatedTests && $test instanceof PHPUnit_Framework_TestCase) {
            $annotations = $test->getAnnotations();
=======
        } elseif ($this->beStrictAboutTodoAnnotatedTests && $test instanceof TestCase) {
            $annotations = TestUtil::parseTestMethodAnnotations(
                get_class($test),
                $test->getName(false)
            );
>>>>>>> update

            if (isset($annotations['method']['todo'])) {
                $this->addFailure(
                    $test,
<<<<<<< HEAD
                    new PHPUnit_Framework_RiskyTestError(
=======
                    new RiskyTestError(
>>>>>>> update
                        'Test method is annotated with @todo'
                    ),
                    $time
                );
            }
        }

        $this->endTest($test, $time);
    }

    /**
     * Gets the number of run tests.
<<<<<<< HEAD
     *
     * @return int
     */
    public function count()
=======
     */
    public function count(): int
>>>>>>> update
    {
        return $this->runTests;
    }

    /**
     * Checks whether the test run should stop.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function shouldStop()
=======
     */
    public function shouldStop(): bool
>>>>>>> update
    {
        return $this->stop;
    }

    /**
     * Marks that the test run should stop.
     */
<<<<<<< HEAD
    public function stop()
=======
    public function stop(): void
>>>>>>> update
    {
        $this->stop = true;
    }

    /**
     * Returns the code coverage object.
<<<<<<< HEAD
     *
     * @return CodeCoverage
     *
     * @since Method available since Release 3.5.0
     */
    public function getCodeCoverage()
=======
     */
    public function getCodeCoverage(): ?CodeCoverage
>>>>>>> update
    {
        return $this->codeCoverage;
    }

    /**
     * Sets the code coverage object.
<<<<<<< HEAD
     *
     * @param CodeCoverage $codeCoverage
     *
     * @since Method available since Release 3.6.0
     */
    public function setCodeCoverage(CodeCoverage $codeCoverage)
=======
     */
    public function setCodeCoverage(CodeCoverage $codeCoverage): void
>>>>>>> update
    {
        $this->codeCoverage = $codeCoverage;
    }

    /**
<<<<<<< HEAD
     * Enables or disables the error-to-exception conversion.
     *
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 3.2.14
     */
    public function convertErrorsToExceptions($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

=======
     * Enables or disables the deprecation-to-exception conversion.
     */
    public function convertDeprecationsToExceptions(bool $flag): void
    {
        $this->convertDeprecationsToExceptions = $flag;
    }

    /**
     * Returns the deprecation-to-exception conversion setting.
     */
    public function getConvertDeprecationsToExceptions(): bool
    {
        return $this->convertDeprecationsToExceptions;
    }

    /**
     * Enables or disables the error-to-exception conversion.
     */
    public function convertErrorsToExceptions(bool $flag): void
    {
>>>>>>> update
        $this->convertErrorsToExceptions = $flag;
    }

    /**
     * Returns the error-to-exception conversion setting.
<<<<<<< HEAD
     *
     * @return bool
     *
     * @since Method available since Release 3.4.0
     */
    public function getConvertErrorsToExceptions()
=======
     */
    public function getConvertErrorsToExceptions(): bool
>>>>>>> update
    {
        return $this->convertErrorsToExceptions;
    }

    /**
<<<<<<< HEAD
     * Enables or disables the stopping when an error occurs.
     *
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 3.5.0
     */
    public function stopOnError($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

=======
     * Enables or disables the notice-to-exception conversion.
     */
    public function convertNoticesToExceptions(bool $flag): void
    {
        $this->convertNoticesToExceptions = $flag;
    }

    /**
     * Returns the notice-to-exception conversion setting.
     */
    public function getConvertNoticesToExceptions(): bool
    {
        return $this->convertNoticesToExceptions;
    }

    /**
     * Enables or disables the warning-to-exception conversion.
     */
    public function convertWarningsToExceptions(bool $flag): void
    {
        $this->convertWarningsToExceptions = $flag;
    }

    /**
     * Returns the warning-to-exception conversion setting.
     */
    public function getConvertWarningsToExceptions(): bool
    {
        return $this->convertWarningsToExceptions;
    }

    /**
     * Enables or disables the stopping when an error occurs.
     */
    public function stopOnError(bool $flag): void
    {
>>>>>>> update
        $this->stopOnError = $flag;
    }

    /**
     * Enables or disables the stopping when a failure occurs.
<<<<<<< HEAD
     *
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 3.1.0
     */
    public function stopOnFailure($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

=======
     */
    public function stopOnFailure(bool $flag): void
    {
>>>>>>> update
        $this->stopOnFailure = $flag;
    }

    /**
     * Enables or disables the stopping when a warning occurs.
<<<<<<< HEAD
     *
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 5.1.0
     */
    public function stopOnWarning($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stopOnWarning = $flag;
    }

    /**
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 4.0.0
     */
    public function beStrictAboutTestsThatDoNotTestAnything($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->beStrictAboutTestsThatDoNotTestAnything = $flag;
    }

    /**
     * @return bool
     *
     * @since Method available since Release 4.0.0
     */
    public function isStrictAboutTestsThatDoNotTestAnything()
=======
     */
    public function stopOnWarning(bool $flag): void
    {
        $this->stopOnWarning = $flag;
    }

    public function beStrictAboutTestsThatDoNotTestAnything(bool $flag): void
    {
        $this->beStrictAboutTestsThatDoNotTestAnything = $flag;
    }

    public function isStrictAboutTestsThatDoNotTestAnything(): bool
>>>>>>> update
    {
        return $this->beStrictAboutTestsThatDoNotTestAnything;
    }

<<<<<<< HEAD
    /**
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 4.0.0
     */
    public function beStrictAboutOutputDuringTests($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->beStrictAboutOutputDuringTests = $flag;
    }

    /**
     * @return bool
     *
     * @since Method available since Release 4.0.0
     */
    public function isStrictAboutOutputDuringTests()
=======
    public function beStrictAboutOutputDuringTests(bool $flag): void
    {
        $this->beStrictAboutOutputDuringTests = $flag;
    }

    public function isStrictAboutOutputDuringTests(): bool
>>>>>>> update
    {
        return $this->beStrictAboutOutputDuringTests;
    }

<<<<<<< HEAD
    /**
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 5.0.0
     */
    public function beStrictAboutResourceUsageDuringSmallTests($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->beStrictAboutResourceUsageDuringSmallTests = $flag;
    }

    /**
     * @return bool
     *
     * @since Method available since Release 5.0.0
     */
    public function isStrictAboutResourceUsageDuringSmallTests()
=======
    public function beStrictAboutResourceUsageDuringSmallTests(bool $flag): void
    {
        $this->beStrictAboutResourceUsageDuringSmallTests = $flag;
    }

    public function isStrictAboutResourceUsageDuringSmallTests(): bool
>>>>>>> update
    {
        return $this->beStrictAboutResourceUsageDuringSmallTests;
    }

<<<<<<< HEAD
    /**
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 5.0.0
     */
    public function enforceTimeLimit($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->enforceTimeLimit = $flag;
    }

    /**
     * @return bool
     *
     * @since Method available since Release 5.0.0
     */
    public function enforcesTimeLimit()
=======
    public function enforceTimeLimit(bool $flag): void
    {
        $this->enforceTimeLimit = $flag;
    }

    public function enforcesTimeLimit(): bool
>>>>>>> update
    {
        return $this->enforceTimeLimit;
    }

<<<<<<< HEAD
    /**
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 4.2.0
     */
    public function beStrictAboutTodoAnnotatedTests($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->beStrictAboutTodoAnnotatedTests = $flag;
    }

    /**
     * @return bool
     *
     * @since Method available since Release 4.2.0
     */
    public function isStrictAboutTodoAnnotatedTests()
=======
    public function beStrictAboutTodoAnnotatedTests(bool $flag): void
    {
        $this->beStrictAboutTodoAnnotatedTests = $flag;
    }

    public function isStrictAboutTodoAnnotatedTests(): bool
>>>>>>> update
    {
        return $this->beStrictAboutTodoAnnotatedTests;
    }

<<<<<<< HEAD
    /**
     * Enables or disables the stopping for risky tests.
     *
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 4.0.0
     */
    public function stopOnRisky($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

=======
    public function forceCoversAnnotation(): void
    {
        $this->forceCoversAnnotation = true;
    }

    public function forcesCoversAnnotation(): bool
    {
        return $this->forceCoversAnnotation;
    }

    /**
     * Enables or disables the stopping for risky tests.
     */
    public function stopOnRisky(bool $flag): void
    {
>>>>>>> update
        $this->stopOnRisky = $flag;
    }

    /**
     * Enables or disables the stopping for incomplete tests.
<<<<<<< HEAD
     *
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 3.5.0
     */
    public function stopOnIncomplete($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

=======
     */
    public function stopOnIncomplete(bool $flag): void
    {
>>>>>>> update
        $this->stopOnIncomplete = $flag;
    }

    /**
     * Enables or disables the stopping for skipped tests.
<<<<<<< HEAD
     *
     * @param bool $flag
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 3.1.0
     */
    public function stopOnSkipped($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

=======
     */
    public function stopOnSkipped(bool $flag): void
    {
>>>>>>> update
        $this->stopOnSkipped = $flag;
    }

    /**
<<<<<<< HEAD
     * Returns the time spent running the tests.
     *
     * @return float
     */
    public function time()
=======
     * Enables or disables the stopping for defects: error, failure, warning.
     */
    public function stopOnDefect(bool $flag): void
    {
        $this->stopOnDefect = $flag;
    }

    /**
     * Returns the time spent running the tests.
     */
    public function time(): float
>>>>>>> update
    {
        return $this->time;
    }

    /**
     * Returns whether the entire test was successful or not.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function wasSuccessful()
    {
        return empty($this->errors) && empty($this->failures) && empty($this->warnings);
=======
     */
    public function wasSuccessful(): bool
    {
        return $this->wasSuccessfulIgnoringWarnings() && empty($this->warnings);
    }

    public function wasSuccessfulIgnoringWarnings(): bool
    {
        return empty($this->errors) && empty($this->failures);
    }

    public function wasSuccessfulAndNoTestIsRiskyOrSkippedOrIncomplete(): bool
    {
        return $this->wasSuccessful() && $this->allHarmless() && $this->allCompletelyImplemented() && $this->noneSkipped();
    }

    /**
     * Sets the default timeout for tests.
     */
    public function setDefaultTimeLimit(int $timeout): void
    {
        $this->defaultTimeLimit = $timeout;
>>>>>>> update
    }

    /**
     * Sets the timeout for small tests.
<<<<<<< HEAD
     *
     * @param int $timeout
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 3.6.0
     */
    public function setTimeoutForSmallTests($timeout)
    {
        if (!is_integer($timeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

=======
     */
    public function setTimeoutForSmallTests(int $timeout): void
    {
>>>>>>> update
        $this->timeoutForSmallTests = $timeout;
    }

    /**
     * Sets the timeout for medium tests.
<<<<<<< HEAD
     *
     * @param int $timeout
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 3.6.0
     */
    public function setTimeoutForMediumTests($timeout)
    {
        if (!is_integer($timeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

=======
     */
    public function setTimeoutForMediumTests(int $timeout): void
    {
>>>>>>> update
        $this->timeoutForMediumTests = $timeout;
    }

    /**
     * Sets the timeout for large tests.
<<<<<<< HEAD
     *
     * @param int $timeout
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 3.6.0
     */
    public function setTimeoutForLargeTests($timeout)
    {
        if (!is_integer($timeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

=======
     */
    public function setTimeoutForLargeTests(int $timeout): void
    {
>>>>>>> update
        $this->timeoutForLargeTests = $timeout;
    }

    /**
     * Returns the set timeout for large tests.
<<<<<<< HEAD
     *
     * @return int
     */
    public function getTimeoutForLargeTests()
=======
     */
    public function getTimeoutForLargeTests(): int
>>>>>>> update
    {
        return $this->timeoutForLargeTests;
    }

<<<<<<< HEAD
    /**
     * @param bool $flag
     *
     * @since Method available since Release 5.4.0
     */
    public function setRegisterMockObjectsFromTestArgumentsRecursively($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->registerMockObjectsFromTestArgumentsRecursively = $flag;
    }

    /**
     * Returns the class hierarchy for a given class.
     *
     * @param string $className
     * @param bool   $asReflectionObjects
     *
     * @return array
     */
    protected function getHierarchy($className, $asReflectionObjects = false)
    {
        if ($asReflectionObjects) {
            $classes = [new ReflectionClass($className)];
        } else {
            $classes = [$className];
        }

        $done = false;

        while (!$done) {
            if ($asReflectionObjects) {
                $class = new ReflectionClass(
                    $classes[count($classes) - 1]->getName()
                );
            } else {
                $class = new ReflectionClass($classes[count($classes) - 1]);
            }

            $parent = $class->getParentClass();

            if ($parent !== false) {
                if ($asReflectionObjects) {
                    $classes[] = $parent;
                } else {
                    $classes[] = $parent->getName();
                }
            } else {
                $done = true;
            }
        }

        return $classes;
=======
    public function setRegisterMockObjectsFromTestArgumentsRecursively(bool $flag): void
    {
        $this->registerMockObjectsFromTestArgumentsRecursively = $flag;
    }

    private function recordError(Test $test, Throwable $t): void
    {
        $this->errors[] = new TestFailure($test, $t);
    }

    private function recordNotImplemented(Test $test, Throwable $t): void
    {
        $this->notImplemented[] = new TestFailure($test, $t);
    }

    private function recordRisky(Test $test, Throwable $t): void
    {
        $this->risky[] = new TestFailure($test, $t);
    }

    private function recordSkipped(Test $test, Throwable $t): void
    {
        $this->skipped[] = new TestFailure($test, $t);
    }

    private function recordWarning(Test $test, Throwable $t): void
    {
        $this->warnings[] = new TestFailure($test, $t);
    }

    private function shouldTimeLimitBeEnforced(int $size): bool
    {
        if (!$this->enforceTimeLimit) {
            return false;
        }

        if (!(($this->defaultTimeLimit || $size !== TestUtil::UNKNOWN))) {
            return false;
        }

        if (!extension_loaded('pcntl')) {
            return false;
        }

        if (!class_exists(Invoker::class)) {
            return false;
        }

        if (extension_loaded('xdebug') && xdebug_is_debugger_active()) {
            return false;
        }

        return true;
>>>>>>> update
    }
}
