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

use SebastianBergmann\Comparator\ComparisonFailure;

/**
 * A TestListener that generates a logfile of the test execution using the
 * TeamCity format (for use with PhpStorm, for instance).
 *
 * @since Class available since Release 5.0.0
 */
class PHPUnit_Util_Log_TeamCity extends PHPUnit_TextUI_ResultPrinter
=======
namespace PHPUnit\Util\Log;

use function class_exists;
use function count;
use function explode;
use function get_class;
use function getmypid;
use function ini_get;
use function is_bool;
use function is_scalar;
use function method_exists;
use function print_r;
use function round;
use function str_replace;
use function stripos;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\ExceptionWrapper;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\TestResult;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\TextUI\DefaultResultPrinter;
use PHPUnit\Util\Exception;
use PHPUnit\Util\Filter;
use ReflectionClass;
use ReflectionException;
use SebastianBergmann\Comparator\ComparisonFailure;
use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class TeamCity extends DefaultResultPrinter
>>>>>>> update
{
    /**
     * @var bool
     */
    private $isSummaryTestCountPrinted = false;

    /**
     * @var string
     */
    private $startedTestName;

    /**
<<<<<<< HEAD
     * @var string
     */
    private $flowId;

    /**
     * @param string $progress
     */
    protected function writeProgress($progress)
    {
    }

    /**
     * @param PHPUnit_Framework_TestResult $result
     */
    public function printResult(PHPUnit_Framework_TestResult $result)
    {
        $this->printHeader();
=======
     * @var false|int
     */
    private $flowId;

    public function printResult(TestResult $result): void
    {
        $this->printHeader($result);
>>>>>>> update
        $this->printFooter($result);
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
        $this->printEvent(
            'testFailed',
            [
<<<<<<< HEAD
                'name'    => $test->getName(),
                'message' => self::getMessage($e),
                'details' => self::getDetails($e),
=======
                'name'     => $test->getName(),
                'message'  => self::getMessage($t),
                'details'  => self::getDetails($t),
                'duration' => self::toMilliseconds($time),
>>>>>>> update
            ]
        );
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
    {
        $this->printEvent(
            'testFailed',
            [
                'name'    => $test->getName(),
                'message' => self::getMessage($e),
                'details' => self::getDetails($e)
            ]
        );
=======
     */
    public function addWarning(Test $test, Warning $e, float $time): void
    {
        $this->write(self::getMessage($e) . PHP_EOL);
>>>>>>> update
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
    {
        $parameters = [
            'name'    => $test->getName(),
            'message' => self::getMessage($e),
            'details' => self::getDetails($e),
        ];

        if ($e instanceof PHPUnit_Framework_ExpectationFailedException) {
=======
     */
    public function addFailure(Test $test, AssertionFailedError $e, float $time): void
    {
        $parameters = [
            'name'     => $test->getName(),
            'message'  => self::getMessage($e),
            'details'  => self::getDetails($e),
            'duration' => self::toMilliseconds($time),
        ];

        if ($e instanceof ExpectationFailedException) {
>>>>>>> update
            $comparisonFailure = $e->getComparisonFailure();

            if ($comparisonFailure instanceof ComparisonFailure) {
                $expectedString = $comparisonFailure->getExpectedAsString();

<<<<<<< HEAD
                if (is_null($expectedString) || empty($expectedString)) {
=======
                if ($expectedString === null || empty($expectedString)) {
>>>>>>> update
                    $expectedString = self::getPrimitiveValueAsString($comparisonFailure->getExpected());
                }

                $actualString = $comparisonFailure->getActualAsString();

<<<<<<< HEAD
                if (is_null($actualString) || empty($actualString)) {
                    $actualString = self::getPrimitiveValueAsString($comparisonFailure->getActual());
                }

                if (!is_null($actualString) && !is_null($expectedString)) {
=======
                if ($actualString === null || empty($actualString)) {
                    $actualString = self::getPrimitiveValueAsString($comparisonFailure->getActual());
                }

                if ($actualString !== null && $expectedString !== null) {
>>>>>>> update
                    $parameters['type']     = 'comparisonFailure';
                    $parameters['actual']   = $actualString;
                    $parameters['expected'] = $expectedString;
                }
            }
        }

        $this->printEvent('testFailed', $parameters);
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
    {
        $this->printIgnoredTest($test->getName(), $e);
=======
     */
    public function addIncompleteTest(Test $test, Throwable $t, float $time): void
    {
        $this->printIgnoredTest($test->getName(), $t, $time);
>>>>>>> update
    }

    /**
     * Risky test.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     */
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $this->addError($test, $e, $time);
=======
     */
    public function addRiskyTest(Test $test, Throwable $t, float $time): void
    {
        $this->addError($test, $t, $time);
>>>>>>> update
    }

    /**
     * Skipped test.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     */
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $testName = $test->getName();
        if ($this->startedTestName != $testName) {
            $this->startTest($test);
            $this->printIgnoredTest($testName, $e);
            $this->endTest($test, $time);
        } else {
            $this->printIgnoredTest($testName, $e);
        }
    }

    public function printIgnoredTest($testName, Exception $e)
=======
     */
    public function addSkippedTest(Test $test, Throwable $t, float $time): void
    {
        $testName = $test->getName();

        if ($this->startedTestName !== $testName) {
            $this->startTest($test);
            $this->printIgnoredTest($testName, $t, $time);
            $this->endTest($test, $time);
        } else {
            $this->printIgnoredTest($testName, $t, $time);
        }
    }

    public function printIgnoredTest(string $testName, Throwable $t, float $time): void
>>>>>>> update
    {
        $this->printEvent(
            'testIgnored',
            [
<<<<<<< HEAD
                'name'    => $testName,
                'message' => self::getMessage($e),
                'details' => self::getDetails($e),
=======
                'name'     => $testName,
                'message'  => self::getMessage($t),
                'details'  => self::getDetails($t),
                'duration' => self::toMilliseconds($time),
>>>>>>> update
            ]
        );
    }

    /**
     * A testsuite started.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_TestSuite $suite
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
=======
     */
    public function startTestSuite(TestSuite $suite): void
>>>>>>> update
    {
        if (stripos(ini_get('disable_functions'), 'getmypid') === false) {
            $this->flowId = getmypid();
        } else {
            $this->flowId = false;
        }

        if (!$this->isSummaryTestCountPrinted) {
            $this->isSummaryTestCountPrinted = true;

            $this->printEvent(
                'testCount',
                ['count' => count($suite)]
            );
        }

        $suiteName = $suite->getName();

        if (empty($suiteName)) {
            return;
        }

        $parameters = ['name' => $suiteName];

        if (class_exists($suiteName, false)) {
            $fileName                   = self::getFileName($suiteName);
<<<<<<< HEAD
            $parameters['locationHint'] = "php_qn://$fileName::\\$suiteName";
        } else {
            $split = preg_split('/::/', $suiteName);

            if (count($split) == 2 && method_exists($split[0], $split[1])) {
                $fileName                   = self::getFileName($split[0]);
                $parameters['locationHint'] = "php_qn://$fileName::\\$suiteName";
=======
            $parameters['locationHint'] = "php_qn://{$fileName}::\\{$suiteName}";
        } else {
            $split = explode('::', $suiteName);

            if (count($split) === 2 && class_exists($split[0]) && method_exists($split[0], $split[1])) {
                $fileName                   = self::getFileName($split[0]);
                $parameters['locationHint'] = "php_qn://{$fileName}::\\{$suiteName}";
>>>>>>> update
                $parameters['name']         = $split[1];
            }
        }

        $this->printEvent('testSuiteStarted', $parameters);
    }

    /**
     * A testsuite ended.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_TestSuite $suite
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
=======
     */
    public function endTestSuite(TestSuite $suite): void
>>>>>>> update
    {
        $suiteName = $suite->getName();

        if (empty($suiteName)) {
            return;
        }

        $parameters = ['name' => $suiteName];

        if (!class_exists($suiteName, false)) {
<<<<<<< HEAD
            $split = preg_split('/::/', $suiteName);

            if (count($split) == 2 && method_exists($split[0], $split[1])) {
=======
            $split = explode('::', $suiteName);

            if (count($split) === 2 && class_exists($split[0]) && method_exists($split[0], $split[1])) {
>>>>>>> update
                $parameters['name'] = $split[1];
            }
        }

        $this->printEvent('testSuiteFinished', $parameters);
    }

    /**
     * A test started.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     */
    public function startTest(PHPUnit_Framework_Test $test)
=======
     */
    public function startTest(Test $test): void
>>>>>>> update
    {
        $testName              = $test->getName();
        $this->startedTestName = $testName;
        $params                = ['name' => $testName];

<<<<<<< HEAD
        if ($test instanceof PHPUnit_Framework_TestCase) {
            $className              = get_class($test);
            $fileName               = self::getFileName($className);
            $params['locationHint'] = "php_qn://$fileName::\\$className::$testName";
=======
        if ($test instanceof TestCase) {
            $className              = get_class($test);
            $fileName               = self::getFileName($className);
            $params['locationHint'] = "php_qn://{$fileName}::\\{$className}::{$testName}";
>>>>>>> update
        }

        $this->printEvent('testStarted', $params);
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
        parent::endTest($test, $time);

        $this->printEvent(
            'testFinished',
            [
                'name'     => $test->getName(),
<<<<<<< HEAD
                'duration' => (int) (round($time, 2) * 1000)
=======
                'duration' => self::toMilliseconds($time),
>>>>>>> update
            ]
        );
    }

<<<<<<< HEAD
    /**
     * @param string $eventName
     * @param array  $params
     */
    private function printEvent($eventName, $params = [])
    {
        $this->write("\n##teamcity[$eventName");
=======
    protected function writeProgress(string $progress): void
    {
    }

    private function printEvent(string $eventName, array $params = []): void
    {
        $this->write("\n##teamcity[{$eventName}");
>>>>>>> update

        if ($this->flowId) {
            $params['flowId'] = $this->flowId;
        }

        foreach ($params as $key => $value) {
<<<<<<< HEAD
            $escapedValue = self::escapeValue($value);
            $this->write(" $key='$escapedValue'");
=======
            $escapedValue = self::escapeValue((string) $value);
            $this->write(" {$key}='{$escapedValue}'");
>>>>>>> update
        }

        $this->write("]\n");
    }

<<<<<<< HEAD
    /**
     * @param Exception $e
     *
     * @return string
     */
    private static function getMessage(Exception $e)
    {
        $message = '';

        if (!$e instanceof PHPUnit_Framework_Exception) {
            if (strlen(get_class($e)) != 0) {
                $message = $message . get_class($e);
            }

            if (strlen($message) != 0 && strlen($e->getMessage()) != 0) {
                $message = $message . ' : ';
            }
        }

        return $message . $e->getMessage();
    }

    /**
     * @param Exception $e
     *
     * @return string
     */
    private static function getDetails(Exception $e)
    {
        $stackTrace = PHPUnit_Util_Filter::getFilteredStacktrace($e);
        $previous   = $e->getPrevious();

        while ($previous) {
            $stackTrace .= "\nCaused by\n" .
                PHPUnit_Framework_TestFailure::exceptionToString($previous) . "\n" .
                PHPUnit_Util_Filter::getFilteredStacktrace($previous);

            $previous = $previous->getPrevious();
=======
    private static function getMessage(Throwable $t): string
    {
        $message = '';

        if ($t instanceof ExceptionWrapper) {
            if ($t->getClassName() !== '') {
                $message .= $t->getClassName();
            }

            if ($message !== '' && $t->getMessage() !== '') {
                $message .= ' : ';
            }
        }

        return $message . $t->getMessage();
    }

    private static function getDetails(Throwable $t): string
    {
        $stackTrace = Filter::getFilteredStacktrace($t);
        $previous   = $t instanceof ExceptionWrapper ? $t->getPreviousWrapped() : $t->getPrevious();

        while ($previous) {
            $stackTrace .= "\nCaused by\n" .
                TestFailure::exceptionToString($previous) . "\n" .
                Filter::getFilteredStacktrace($previous);

            $previous = $previous instanceof ExceptionWrapper ?
                $previous->getPreviousWrapped() : $previous->getPrevious();
>>>>>>> update
        }

        return ' ' . str_replace("\n", "\n ", $stackTrace);
    }

<<<<<<< HEAD
    /**
     * @param mixed $value
     *
     * @return string
     */
    private static function getPrimitiveValueAsString($value)
    {
        if (is_null($value)) {
            return 'null';
        } elseif (is_bool($value)) {
            return $value == true ? 'true' : 'false';
        } elseif (is_scalar($value)) {
            return print_r($value, true);
        }

        return;
    }

    /**
     * @param  $text
     *
     * @return string
     */
    private static function escapeValue($text)
    {
        $text = str_replace('|', '||', $text);
        $text = str_replace("'", "|'", $text);
        $text = str_replace("\n", '|n', $text);
        $text = str_replace("\r", '|r', $text);
        $text = str_replace(']', '|]', $text);
        $text = str_replace('[', '|[', $text);

        return $text;
=======
    private static function getPrimitiveValueAsString($value): ?string
    {
        if ($value === null) {
            return 'null';
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_scalar($value)) {
            return print_r($value, true);
        }

        return null;
    }

    private static function escapeValue(string $text): string
    {
        return str_replace(
            ['|', "'", "\n", "\r", ']', '['],
            ['||', "|'", '|n', '|r', '|]', '|['],
            $text
        );
>>>>>>> update
    }

    /**
     * @param string $className
<<<<<<< HEAD
     *
     * @return string
     */
    private static function getFileName($className)
    {
        $reflectionClass = new ReflectionClass($className);
        $fileName        = $reflectionClass->getFileName();

        return $fileName;
=======
     */
    private static function getFileName($className): string
    {
        try {
            return (new ReflectionClass($className))->getFileName();
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

    /**
     * @param float $time microseconds
     */
    private static function toMilliseconds(float $time): int
    {
        return (int) round($time * 1000);
>>>>>>> update
    }
}
