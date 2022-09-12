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
 * A TestListener that generates a logfile of the test execution in XML markup.
 *
 * The XML markup used is the same as the one that is used by the JUnit Ant task.
 *
 * @since Class available since Release 2.1.0
 */
class PHPUnit_Util_Log_JUnit extends PHPUnit_Util_Printer implements PHPUnit_Framework_TestListener
=======
namespace PHPUnit\Util\Log;

use function class_exists;
use function get_class;
use function method_exists;
use function sprintf;
use function str_replace;
use function trim;
use DOMDocument;
use DOMElement;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\ExceptionWrapper;
use PHPUnit\Framework\SelfDescribing;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\Util\Exception;
use PHPUnit\Util\Filter;
use PHPUnit\Util\Printer;
use PHPUnit\Util\Xml;
use ReflectionClass;
use ReflectionException;
use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class JUnit extends Printer implements TestListener
>>>>>>> update
{
    /**
     * @var DOMDocument
     */
<<<<<<< HEAD
    protected $document;
=======
    private $document;
>>>>>>> update

    /**
     * @var DOMElement
     */
<<<<<<< HEAD
    protected $root;
=======
    private $root;
>>>>>>> update

    /**
     * @var bool
     */
<<<<<<< HEAD
    protected $logIncompleteSkipped = false;

    /**
     * @var bool
     */
    protected $writeDocument = true;
=======
    private $reportRiskyTests = false;
>>>>>>> update

    /**
     * @var DOMElement[]
     */
<<<<<<< HEAD
    protected $testSuites = [];
=======
    private $testSuites = [];
>>>>>>> update

    /**
     * @var int[]
     */
<<<<<<< HEAD
    protected $testSuiteTests = [0];
=======
    private $testSuiteTests = [0];
>>>>>>> update

    /**
     * @var int[]
     */
<<<<<<< HEAD
    protected $testSuiteAssertions = [0];
=======
    private $testSuiteAssertions = [0];
>>>>>>> update

    /**
     * @var int[]
     */
<<<<<<< HEAD
    protected $testSuiteErrors = [0];
=======
    private $testSuiteErrors = [0];
>>>>>>> update

    /**
     * @var int[]
     */
<<<<<<< HEAD
    protected $testSuiteFailures = [0];
=======
    private $testSuiteWarnings = [0];
>>>>>>> update

    /**
     * @var int[]
     */
<<<<<<< HEAD
    protected $testSuiteTimes = [0];
=======
    private $testSuiteFailures = [0];

    /**
     * @var int[]
     */
    private $testSuiteSkipped = [0];

    /**
     * @var int[]
     */
    private $testSuiteTimes = [0];
>>>>>>> update

    /**
     * @var int
     */
<<<<<<< HEAD
    protected $testSuiteLevel = 0;
=======
    private $testSuiteLevel = 0;
>>>>>>> update

    /**
     * @var DOMElement
     */
<<<<<<< HEAD
    protected $currentTestCase = null;

    /**
     * @var bool
     */
    protected $attachCurrentTestCase = true;

    /**
     * Constructor.
     *
     * @param mixed $out
     * @param bool  $logIncompleteSkipped
     */
    public function __construct($out = null, $logIncompleteSkipped = false)
=======
    private $currentTestCase;

    /**
     * @param null|mixed $out
     */
    public function __construct($out = null, bool $reportRiskyTests = false)
>>>>>>> update
    {
        $this->document               = new DOMDocument('1.0', 'UTF-8');
        $this->document->formatOutput = true;

        $this->root = $this->document->createElement('testsuites');
        $this->document->appendChild($this->root);

        parent::__construct($out);

<<<<<<< HEAD
        $this->logIncompleteSkipped = $logIncompleteSkipped;
=======
        $this->reportRiskyTests = $reportRiskyTests;
>>>>>>> update
    }

    /**
     * Flush buffer and close output.
     */
<<<<<<< HEAD
    public function flush()
    {
        if ($this->writeDocument === true) {
            $this->write($this->getXML());
        }
=======
    public function flush(): void
    {
        $this->write($this->getXML());
>>>>>>> update

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
    {
        $this->doAddFault($test, $e, $time, 'error');
=======
     */
    public function addError(Test $test, Throwable $t, float $time): void
    {
        $this->doAddFault($test, $t, 'error');
>>>>>>> update
        $this->testSuiteErrors[$this->testSuiteLevel]++;
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
        if (!$this->logIncompleteSkipped) {
            return;
        }

        $this->doAddFault($test, $e, $time, 'warning');
        $this->testSuiteFailures[$this->testSuiteLevel]++;
=======
     */
    public function addWarning(Test $test, Warning $e, float $time): void
    {
        $this->doAddFault($test, $e, 'warning');
        $this->testSuiteWarnings[$this->testSuiteLevel]++;
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
        $this->doAddFault($test, $e, $time, 'failure');
=======
     */
    public function addFailure(Test $test, AssertionFailedError $e, float $time): void
    {
        $this->doAddFault($test, $e, 'failure');
>>>>>>> update
        $this->testSuiteFailures[$this->testSuiteLevel]++;
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
        if ($this->logIncompleteSkipped && $this->currentTestCase !== null) {
            $error = $this->document->createElement(
                'error',
                PHPUnit_Util_XML::prepareString(
                    "Incomplete Test\n" .
                    PHPUnit_Util_Filter::getFilteredStacktrace($e)
                )
            );

            $error->setAttribute('type', get_class($e));

            $this->currentTestCase->appendChild($error);

            $this->testSuiteErrors[$this->testSuiteLevel]++;
        } else {
            $this->attachCurrentTestCase = false;
        }
=======
     */
    public function addIncompleteTest(Test $test, Throwable $t, float $time): void
    {
        $this->doAddSkipped();
>>>>>>> update
    }

    /**
     * Risky test.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     *
     * @since  Method available since Release 4.0.0
     */
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        if ($this->logIncompleteSkipped && $this->currentTestCase !== null) {
            $error = $this->document->createElement(
                'error',
                PHPUnit_Util_XML::prepareString(
                    "Risky Test\n" .
                    PHPUnit_Util_Filter::getFilteredStacktrace($e)
                )
            );

            $error->setAttribute('type', get_class($e));

            $this->currentTestCase->appendChild($error);

            $this->testSuiteErrors[$this->testSuiteLevel]++;
        } else {
            $this->attachCurrentTestCase = false;
        }
=======
     */
    public function addRiskyTest(Test $test, Throwable $t, float $time): void
    {
        if (!$this->reportRiskyTests) {
            return;
        }

        $this->doAddFault($test, $t, 'error');
        $this->testSuiteErrors[$this->testSuiteLevel]++;
>>>>>>> update
    }

    /**
     * Skipped test.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     *
     * @since  Method available since Release 3.0.0
     */
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        if ($this->logIncompleteSkipped && $this->currentTestCase !== null) {
            $error = $this->document->createElement(
                'error',
                PHPUnit_Util_XML::prepareString(
                    "Skipped Test\n" .
                    PHPUnit_Util_Filter::getFilteredStacktrace($e)
                )
            );

            $error->setAttribute('type', get_class($e));

            $this->currentTestCase->appendChild($error);

            $this->testSuiteErrors[$this->testSuiteLevel]++;
        } else {
            $this->attachCurrentTestCase = false;
        }
=======
     */
    public function addSkippedTest(Test $test, Throwable $t, float $time): void
    {
        $this->doAddSkipped();
>>>>>>> update
    }

    /**
     * A testsuite started.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @since  Method available since Release 2.2.0
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
=======
     */
    public function startTestSuite(TestSuite $suite): void
>>>>>>> update
    {
        $testSuite = $this->document->createElement('testsuite');
        $testSuite->setAttribute('name', $suite->getName());

        if (class_exists($suite->getName(), false)) {
            try {
                $class = new ReflectionClass($suite->getName());

                $testSuite->setAttribute('file', $class->getFileName());
            } catch (ReflectionException $e) {
            }
        }

        if ($this->testSuiteLevel > 0) {
            $this->testSuites[$this->testSuiteLevel]->appendChild($testSuite);
        } else {
            $this->root->appendChild($testSuite);
        }

        $this->testSuiteLevel++;
        $this->testSuites[$this->testSuiteLevel]          = $testSuite;
        $this->testSuiteTests[$this->testSuiteLevel]      = 0;
        $this->testSuiteAssertions[$this->testSuiteLevel] = 0;
        $this->testSuiteErrors[$this->testSuiteLevel]     = 0;
<<<<<<< HEAD
        $this->testSuiteFailures[$this->testSuiteLevel]   = 0;
=======
        $this->testSuiteWarnings[$this->testSuiteLevel]   = 0;
        $this->testSuiteFailures[$this->testSuiteLevel]   = 0;
        $this->testSuiteSkipped[$this->testSuiteLevel]    = 0;
>>>>>>> update
        $this->testSuiteTimes[$this->testSuiteLevel]      = 0;
    }

    /**
     * A testsuite ended.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @since  Method available since Release 2.2.0
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'tests',
            $this->testSuiteTests[$this->testSuiteLevel]
=======
     */
    public function endTestSuite(TestSuite $suite): void
    {
        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'tests',
            (string) $this->testSuiteTests[$this->testSuiteLevel]
>>>>>>> update
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'assertions',
<<<<<<< HEAD
            $this->testSuiteAssertions[$this->testSuiteLevel]
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'failures',
            $this->testSuiteFailures[$this->testSuiteLevel]
=======
            (string) $this->testSuiteAssertions[$this->testSuiteLevel]
>>>>>>> update
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'errors',
<<<<<<< HEAD
            $this->testSuiteErrors[$this->testSuiteLevel]
=======
            (string) $this->testSuiteErrors[$this->testSuiteLevel]
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'warnings',
            (string) $this->testSuiteWarnings[$this->testSuiteLevel]
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'failures',
            (string) $this->testSuiteFailures[$this->testSuiteLevel]
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'skipped',
            (string) $this->testSuiteSkipped[$this->testSuiteLevel]
>>>>>>> update
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'time',
            sprintf('%F', $this->testSuiteTimes[$this->testSuiteLevel])
        );

        if ($this->testSuiteLevel > 1) {
<<<<<<< HEAD
            $this->testSuiteTests[$this->testSuiteLevel - 1]      += $this->testSuiteTests[$this->testSuiteLevel];
            $this->testSuiteAssertions[$this->testSuiteLevel - 1] += $this->testSuiteAssertions[$this->testSuiteLevel];
            $this->testSuiteErrors[$this->testSuiteLevel - 1]     += $this->testSuiteErrors[$this->testSuiteLevel];
            $this->testSuiteFailures[$this->testSuiteLevel - 1]   += $this->testSuiteFailures[$this->testSuiteLevel];
            $this->testSuiteTimes[$this->testSuiteLevel - 1]      += $this->testSuiteTimes[$this->testSuiteLevel];
=======
            $this->testSuiteTests[$this->testSuiteLevel - 1] += $this->testSuiteTests[$this->testSuiteLevel];
            $this->testSuiteAssertions[$this->testSuiteLevel - 1] += $this->testSuiteAssertions[$this->testSuiteLevel];
            $this->testSuiteErrors[$this->testSuiteLevel - 1] += $this->testSuiteErrors[$this->testSuiteLevel];
            $this->testSuiteWarnings[$this->testSuiteLevel - 1] += $this->testSuiteWarnings[$this->testSuiteLevel];
            $this->testSuiteFailures[$this->testSuiteLevel - 1] += $this->testSuiteFailures[$this->testSuiteLevel];
            $this->testSuiteSkipped[$this->testSuiteLevel - 1] += $this->testSuiteSkipped[$this->testSuiteLevel];
            $this->testSuiteTimes[$this->testSuiteLevel - 1] += $this->testSuiteTimes[$this->testSuiteLevel];
>>>>>>> update
        }

        $this->testSuiteLevel--;
    }

    /**
     * A test started.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     */
    public function startTest(PHPUnit_Framework_Test $test)
    {
        $testCase = $this->document->createElement('testcase');
        $testCase->setAttribute('name', $test->getName());

        if ($test instanceof PHPUnit_Framework_TestCase) {
            $class      = new ReflectionClass($test);
            $methodName = $test->getName();

            if ($class->hasMethod($methodName)) {
                $method = $class->getMethod($test->getName());

                $testCase->setAttribute('class', $class->getName());
                $testCase->setAttribute('file', $class->getFileName());
                $testCase->setAttribute('line', $method->getStartLine());
            }
=======
     */
    public function startTest(Test $test): void
    {
        $usesDataprovider = false;

        if (method_exists($test, 'usesDataProvider')) {
            $usesDataprovider = $test->usesDataProvider();
        }

        $testCase = $this->document->createElement('testcase');
        $testCase->setAttribute('name', $test->getName());

        try {
            $class = new ReflectionClass($test);
            // @codeCoverageIgnoreStart
        } catch (ReflectionException $e) {
            throw new Exception(
                $e->getMessage(),
                (int) $e->getCode(),
                $e
            );
        }
        // @codeCoverageIgnoreEnd

        $methodName = $test->getName(!$usesDataprovider);

        if ($class->hasMethod($methodName)) {
            try {
                $method = $class->getMethod($methodName);
                // @codeCoverageIgnoreStart
            } catch (ReflectionException $e) {
                throw new Exception(
                    $e->getMessage(),
                    (int) $e->getCode(),
                    $e
                );
            }
            // @codeCoverageIgnoreEnd

            $testCase->setAttribute('class', $class->getName());
            $testCase->setAttribute('classname', str_replace('\\', '.', $class->getName()));
            $testCase->setAttribute('file', $class->getFileName());
            $testCase->setAttribute('line', (string) $method->getStartLine());
>>>>>>> update
        }

        $this->currentTestCase = $testCase;
    }

    /**
     * A test ended.
<<<<<<< HEAD
     *
     * @param PHPUnit_Framework_Test $test
     * @param float                  $time
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        if ($this->attachCurrentTestCase) {
            if ($test instanceof PHPUnit_Framework_TestCase) {
                $numAssertions = $test->getNumAssertions();
                $this->testSuiteAssertions[$this->testSuiteLevel] += $numAssertions;

                $this->currentTestCase->setAttribute(
                    'assertions',
                    $numAssertions
                );
            }

            $this->currentTestCase->setAttribute(
                'time',
                sprintf('%F', $time)
            );

            $this->testSuites[$this->testSuiteLevel]->appendChild(
                $this->currentTestCase
            );

            $this->testSuiteTests[$this->testSuiteLevel]++;
            $this->testSuiteTimes[$this->testSuiteLevel] += $time;

            if (method_exists($test, 'hasOutput') && $test->hasOutput()) {
                $systemOut = $this->document->createElement('system-out');
                $systemOut->appendChild(
                    $this->document->createTextNode($test->getActualOutput())
                );
                $this->currentTestCase->appendChild($systemOut);
            }
        }

        $this->attachCurrentTestCase = true;
        $this->currentTestCase       = null;
=======
     */
    public function endTest(Test $test, float $time): void
    {
        $numAssertions = 0;

        if (method_exists($test, 'getNumAssertions')) {
            $numAssertions = $test->getNumAssertions();
        }

        $this->testSuiteAssertions[$this->testSuiteLevel] += $numAssertions;

        $this->currentTestCase->setAttribute(
            'assertions',
            (string) $numAssertions
        );

        $this->currentTestCase->setAttribute(
            'time',
            sprintf('%F', $time)
        );

        $this->testSuites[$this->testSuiteLevel]->appendChild(
            $this->currentTestCase
        );

        $this->testSuiteTests[$this->testSuiteLevel]++;
        $this->testSuiteTimes[$this->testSuiteLevel] += $time;

        $testOutput = '';

        if (method_exists($test, 'hasOutput') && method_exists($test, 'getActualOutput')) {
            $testOutput = $test->hasOutput() ? $test->getActualOutput() : '';
        }

        if (!empty($testOutput)) {
            $systemOut = $this->document->createElement(
                'system-out',
                Xml::prepareString($testOutput)
            );

            $this->currentTestCase->appendChild($systemOut);
        }

        $this->currentTestCase = null;
>>>>>>> update
    }

    /**
     * Returns the XML as a string.
<<<<<<< HEAD
     *
     * @return string
     *
     * @since  Method available since Release 2.2.0
     */
    public function getXML()
=======
     */
    public function getXML(): string
>>>>>>> update
    {
        return $this->document->saveXML();
    }

<<<<<<< HEAD
    /**
     * Enables or disables the writing of the document
     * in flush().
     *
     * This is a "hack" needed for the integration of
     * PHPUnit with Phing.
     *
     * @return string
     *
     * @since  Method available since Release 2.2.0
     */
    public function setWriteDocument($flag)
    {
        if (is_bool($flag)) {
            $this->writeDocument = $flag;
        }
    }

    /**
     * Method which generalizes addError() and addFailure()
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     * @param string                 $type
     */
    private function doAddFault(PHPUnit_Framework_Test $test, Exception $e, $time, $type)
=======
    private function doAddFault(Test $test, Throwable $t, string $type): void
>>>>>>> update
    {
        if ($this->currentTestCase === null) {
            return;
        }

<<<<<<< HEAD
        if ($test instanceof PHPUnit_Framework_SelfDescribing) {
=======
        if ($test instanceof SelfDescribing) {
>>>>>>> update
            $buffer = $test->toString() . "\n";
        } else {
            $buffer = '';
        }

<<<<<<< HEAD
        $buffer .= PHPUnit_Framework_TestFailure::exceptionToString($e) .
                   "\n" .
                   PHPUnit_Util_Filter::getFilteredStacktrace($e);

        $fault = $this->document->createElement(
            $type,
            PHPUnit_Util_XML::prepareString($buffer)
        );

        $fault->setAttribute('type', get_class($e));
        $this->currentTestCase->appendChild($fault);
    }
=======
        $buffer .= trim(
            TestFailure::exceptionToString($t) . "\n" .
            Filter::getFilteredStacktrace($t)
        );

        $fault = $this->document->createElement(
            $type,
            Xml::prepareString($buffer)
        );

        if ($t instanceof ExceptionWrapper) {
            $fault->setAttribute('type', $t->getClassName());
        } else {
            $fault->setAttribute('type', get_class($t));
        }

        $this->currentTestCase->appendChild($fault);
    }

    private function doAddSkipped(): void
    {
        if ($this->currentTestCase === null) {
            return;
        }

        $skipped = $this->document->createElement('skipped');

        $this->currentTestCase->appendChild($skipped);

        $this->testSuiteSkipped[$this->testSuiteLevel]++;
    }
>>>>>>> update
}
