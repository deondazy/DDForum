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
 * Base class for all test runners.
 *
 * @since Class available since Release 2.0.0
 */
abstract class PHPUnit_Runner_BaseTestRunner
{
    const STATUS_PASSED     = 0;
    const STATUS_SKIPPED    = 1;
    const STATUS_INCOMPLETE = 2;
    const STATUS_FAILURE    = 3;
    const STATUS_ERROR      = 4;
    const STATUS_RISKY      = 5;
    const STATUS_WARNING    = 6;
    const SUITE_METHODNAME  = 'suite';

    /**
     * Returns the loader to be used.
     *
     * @return PHPUnit_Runner_TestSuiteLoader
     */
    public function getLoader()
    {
        return new PHPUnit_Runner_StandardTestSuiteLoader;
=======
namespace PHPUnit\Runner;

use function is_dir;
use function is_file;
use function substr;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestSuite;
use ReflectionClass;
use ReflectionException;
use SebastianBergmann\FileIterator\Facade as FileIteratorFacade;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
abstract class BaseTestRunner
{
    /**
     * @var int
     */
    public const STATUS_UNKNOWN = -1;

    /**
     * @var int
     */
    public const STATUS_PASSED = 0;

    /**
     * @var int
     */
    public const STATUS_SKIPPED = 1;

    /**
     * @var int
     */
    public const STATUS_INCOMPLETE = 2;

    /**
     * @var int
     */
    public const STATUS_FAILURE = 3;

    /**
     * @var int
     */
    public const STATUS_ERROR = 4;

    /**
     * @var int
     */
    public const STATUS_RISKY = 5;

    /**
     * @var int
     */
    public const STATUS_WARNING = 6;

    /**
     * @var string
     */
    public const SUITE_METHODNAME = 'suite';

    /**
     * Returns the loader to be used.
     */
    public function getLoader(): TestSuiteLoader
    {
        return new StandardTestSuiteLoader;
>>>>>>> update
    }

    /**
     * Returns the Test corresponding to the given suite.
     * This is a template method, subclasses override
     * the runFailed() and clearStatus() methods.
     *
<<<<<<< HEAD
     * @param string $suiteClassName
     * @param string $suiteClassFile
     * @param mixed  $suffixes
     *
     * @return PHPUnit_Framework_Test
     */
    public function getTest($suiteClassName, $suiteClassFile = '', $suffixes = '')
    {
        if (is_dir($suiteClassName) &&
            !is_file($suiteClassName . '.php') && empty($suiteClassFile)) {
            $facade = new File_Iterator_Facade;
            $files  = $facade->getFilesAsArray(
                $suiteClassName,
                $suffixes
            );

            $suite = new PHPUnit_Framework_TestSuite($suiteClassName);
=======
     * @param string|string[] $suffixes
     *
     * @throws Exception
     */
    public function getTest(string $suiteClassFile, $suffixes = ''): ?TestSuite
    {
        if (is_dir($suiteClassFile)) {
            /** @var string[] $files */
            $files = (new FileIteratorFacade)->getFilesAsArray(
                $suiteClassFile,
                $suffixes
            );

            $suite = new TestSuite($suiteClassFile);
>>>>>>> update
            $suite->addTestFiles($files);

            return $suite;
        }

<<<<<<< HEAD
        try {
            $testClass = $this->loadSuiteClass(
                $suiteClassName,
                $suiteClassFile
            );
        } catch (PHPUnit_Framework_Exception $e) {
            $this->runFailed($e->getMessage());

            return;
=======
        if (is_file($suiteClassFile) && substr($suiteClassFile, -5, 5) === '.phpt') {
            $suite = new TestSuite;
            $suite->addTestFile($suiteClassFile);

            return $suite;
        }

        try {
            $testClass = $this->loadSuiteClass(
                $suiteClassFile
            );
        } catch (\PHPUnit\Exception $e) {
            $this->runFailed($e->getMessage());

            return null;
>>>>>>> update
        }

        try {
            $suiteMethod = $testClass->getMethod(self::SUITE_METHODNAME);

            if (!$suiteMethod->isStatic()) {
                $this->runFailed(
                    'suite() method must be static.'
                );

<<<<<<< HEAD
                return;
            }

            try {
                $test = $suiteMethod->invoke(null, $testClass->getName());
            } catch (ReflectionException $e) {
                $this->runFailed(
                    sprintf(
                        "Failed to invoke suite() method.\n%s",
                        $e->getMessage()
                    )
                );

                return;
            }
        } catch (ReflectionException $e) {
            try {
                $test = new PHPUnit_Framework_TestSuite($testClass);
            } catch (PHPUnit_Framework_Exception $e) {
                $test = new PHPUnit_Framework_TestSuite;
                $test->setName($suiteClassName);
            }
=======
                return null;
            }

            $test = $suiteMethod->invoke(null, $testClass->getName());
        } catch (ReflectionException $e) {
            $test = new TestSuite($testClass);
>>>>>>> update
        }

        $this->clearStatus();

        return $test;
    }

    /**
     * Returns the loaded ReflectionClass for a suite name.
<<<<<<< HEAD
     *
     * @param string $suiteClassName
     * @param string $suiteClassFile
     *
     * @return ReflectionClass
     */
    protected function loadSuiteClass($suiteClassName, $suiteClassFile = '')
    {
        $loader = $this->getLoader();

        return $loader->load($suiteClassName, $suiteClassFile);
=======
     */
    protected function loadSuiteClass(string $suiteClassFile): ReflectionClass
    {
        return $this->getLoader()->load($suiteClassFile);
>>>>>>> update
    }

    /**
     * Clears the status message.
     */
<<<<<<< HEAD
    protected function clearStatus()
=======
    protected function clearStatus(): void
>>>>>>> update
    {
    }

    /**
     * Override to define how to handle a failed loading of
     * a test suite.
<<<<<<< HEAD
     *
     * @param string $message
     */
    abstract protected function runFailed($message);
=======
     */
    abstract protected function runFailed(string $message): void;
>>>>>>> update
}
