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
 * A TestSuite is a composite of Tests. It runs a collection of test cases.
 *
 * Here is an example using the dynamic test definition.
 *
 * <code>
 * <?php
 * $suite = new PHPUnit_Framework_TestSuite;
 * $suite->addTest(new MathTest('testPass'));
 * ?>
 * </code>
 *
 * Alternatively, a TestSuite can extract the tests to be run automatically.
 * To do so you pass a ReflectionClass instance for your
 * PHPUnit_Framework_TestCase class to the PHPUnit_Framework_TestSuite
 * constructor.
 *
 * <code>
 * <?php
 * $suite = new PHPUnit_Framework_TestSuite(
 *   new ReflectionClass('MathTest')
 * );
 * ?>
 * </code>
 *
 * This constructor creates a suite with all the methods starting with
 * "test" that take no arguments.
 *
 * @since Class available since Release 2.0.0
 */
class PHPUnit_Framework_TestSuite implements PHPUnit_Framework_Test, PHPUnit_Framework_SelfDescribing, IteratorAggregate
{
    /**
     * Last count of tests in this suite.
     *
     * @var int|null
     */
    private $cachedNumTests;

    /**
=======
namespace PHPUnit\Framework;

use const PHP_EOL;
use function array_keys;
use function array_map;
use function array_merge;
use function array_unique;
use function basename;
use function call_user_func;
use function class_exists;
use function count;
use function dirname;
use function get_declared_classes;
use function implode;
use function is_bool;
use function is_callable;
use function is_file;
use function is_object;
use function is_string;
use function method_exists;
use function preg_match;
use function preg_quote;
use function sprintf;
use function strpos;
use function substr;
use Iterator;
use IteratorAggregate;
use PHPUnit\Runner\BaseTestRunner;
use PHPUnit\Runner\Filter\Factory;
use PHPUnit\Runner\PhptTestCase;
use PHPUnit\Util\FileLoader;
use PHPUnit\Util\Reflection;
use PHPUnit\Util\Test as TestUtil;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
class TestSuite implements IteratorAggregate, Reorderable, SelfDescribing, Test
{
    /**
>>>>>>> update
     * Enable or disable the backup and restoration of the $GLOBALS array.
     *
     * @var bool
     */
<<<<<<< HEAD
    protected $backupGlobals = null;
=======
    protected $backupGlobals;
>>>>>>> update

    /**
     * Enable or disable the backup and restoration of static attributes.
     *
     * @var bool
     */
<<<<<<< HEAD
    protected $backupStaticAttributes = null;

    /**
     * @var bool
     */
    private $beStrictAboutChangesToGlobalState = null;
=======
    protected $backupStaticAttributes;
>>>>>>> update

    /**
     * @var bool
     */
    protected $runTestInSeparateProcess = false;

    /**
     * The name of the test suite.
     *
     * @var string
     */
    protected $name = '';

    /**
     * The test groups of the test suite.
     *
<<<<<<< HEAD
     * @var array
=======
     * @psalm-var array<string,list<Test>>
>>>>>>> update
     */
    protected $groups = [];

    /**
     * The tests in the test suite.
     *
<<<<<<< HEAD
     * @var array
=======
     * @var Test[]
>>>>>>> update
     */
    protected $tests = [];

    /**
     * The number of tests in the test suite.
     *
     * @var int
     */
    protected $numTests = -1;

    /**
     * @var bool
     */
    protected $testCase = false;

    /**
<<<<<<< HEAD
     * @var array
=======
     * @var string[]
>>>>>>> update
     */
    protected $foundClasses = [];

    /**
<<<<<<< HEAD
     * @var PHPUnit_Runner_Filter_Factory
     */
    private $iteratorFilter = null;

    /**
     * Constructs a new TestSuite:
     *
     *   - PHPUnit_Framework_TestSuite() constructs an empty TestSuite.
     *
     *   - PHPUnit_Framework_TestSuite(ReflectionClass) constructs a
     *     TestSuite from the given class.
     *
     *   - PHPUnit_Framework_TestSuite(ReflectionClass, String)
     *     constructs a TestSuite from the given class with the given
     *     name.
     *
     *   - PHPUnit_Framework_TestSuite(String) either constructs a
=======
     * @var null|list<ExecutionOrderDependency>
     */
    protected $providedTests;

    /**
     * @var null|list<ExecutionOrderDependency>
     */
    protected $requiredTests;

    /**
     * @var bool
     */
    private $beStrictAboutChangesToGlobalState;

    /**
     * @var Factory
     */
    private $iteratorFilter;

    /**
     * @var int
     */
    private $declaredClassesPointer;

    /**
     * @psalm-var array<int,string>
     */
    private $warnings = [];

    /**
     * Constructs a new TestSuite.
     *
     *   - PHPUnit\Framework\TestSuite() constructs an empty TestSuite.
     *
     *   - PHPUnit\Framework\TestSuite(ReflectionClass) constructs a
     *     TestSuite from the given class.
     *
     *   - PHPUnit\Framework\TestSuite(ReflectionClass, String)
     *     constructs a TestSuite from the given class with the given
     *     name.
     *
     *   - PHPUnit\Framework\TestSuite(String) either constructs a
>>>>>>> update
     *     TestSuite from the given class (if the passed string is the
     *     name of an existing class) or constructs an empty TestSuite
     *     with the given name.
     *
<<<<<<< HEAD
     * @param mixed  $theClass
     * @param string $name
     *
     * @throws PHPUnit_Framework_Exception
     */
    public function __construct($theClass = '', $name = '')
    {
        $argumentsValid = false;

        if (is_object($theClass) &&
            $theClass instanceof ReflectionClass) {
            $argumentsValid = true;
        } elseif (is_string($theClass) &&
                 $theClass !== '' &&
                 class_exists($theClass, false)) {
            $argumentsValid = true;

            if ($name == '') {
                $name = $theClass;
            }

            $theClass = new ReflectionClass($theClass);
        } elseif (is_string($theClass)) {
            $this->setName($theClass);
=======
     * @param ReflectionClass|string $theClass
     *
     * @throws Exception
     */
    public function __construct($theClass = '', string $name = '')
    {
        if (!is_string($theClass) && !$theClass instanceof ReflectionClass) {
            throw InvalidArgumentException::create(
                1,
                'ReflectionClass object or string'
            );
        }

        $this->declaredClassesPointer = count(get_declared_classes());

        if (!$theClass instanceof ReflectionClass) {
            if (class_exists($theClass, true)) {
                if ($name === '') {
                    $name = $theClass;
                }

                try {
                    $theClass = new ReflectionClass($theClass);
                } catch (ReflectionException $e) {
                    throw new Exception(
                        $e->getMessage(),
                        (int) $e->getCode(),
                        $e
                    );
                }
                // @codeCoverageIgnoreEnd
            } else {
                $this->setName($theClass);

                return;
            }
        }

        if (!$theClass->isSubclassOf(TestCase::class)) {
            $this->setName((string) $theClass);
>>>>>>> update

            return;
        }

<<<<<<< HEAD
        if (!$argumentsValid) {
            throw new PHPUnit_Framework_Exception;
        }

        if (!$theClass->isSubclassOf('PHPUnit_Framework_TestCase')) {
            throw new PHPUnit_Framework_Exception(
                'Class "' . $theClass->name . '" does not extend PHPUnit_Framework_TestCase.'
            );
        }

        if ($name != '') {
=======
        if ($name !== '') {
>>>>>>> update
            $this->setName($name);
        } else {
            $this->setName($theClass->getName());
        }

        $constructor = $theClass->getConstructor();

        if ($constructor !== null &&
            !$constructor->isPublic()) {
            $this->addTest(
<<<<<<< HEAD
                self::warning(
=======
                new WarningTestCase(
>>>>>>> update
                    sprintf(
                        'Class "%s" has no public constructor.',
                        $theClass->getName()
                    )
                )
            );

            return;
        }

<<<<<<< HEAD
        foreach ($theClass->getMethods() as $method) {
=======
        foreach ((new Reflection)->publicMethodsInTestClass($theClass) as $method) {
            if (!TestUtil::isTestMethod($method)) {
                continue;
            }

>>>>>>> update
            $this->addTestMethod($theClass, $method);
        }

        if (empty($this->tests)) {
            $this->addTest(
<<<<<<< HEAD
                self::warning(
=======
                new WarningTestCase(
>>>>>>> update
                    sprintf(
                        'No tests found in class "%s".',
                        $theClass->getName()
                    )
                )
            );
        }

        $this->testCase = true;
    }

    /**
     * Returns a string representation of the test suite.
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
        return $this->getName();
    }

    /**
     * Adds a test to the suite.
     *
<<<<<<< HEAD
     * @param PHPUnit_Framework_Test $test
     * @param array                  $groups
     */
    public function addTest(PHPUnit_Framework_Test $test, $groups = [])
    {
        $class = new ReflectionClass($test);

        if (!$class->isAbstract()) {
            $this->tests[]  = $test;
            $this->numTests = -1;

            if ($test instanceof self &&
                empty($groups)) {
                $groups = $test->getGroups();
            }

            if (empty($groups)) {
                $groups = ['default'];
=======
     * @param array $groups
     */
    public function addTest(Test $test, $groups = []): void
    {
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

        if (!$class->isAbstract()) {
            $this->tests[] = $test;
            $this->clearCaches();

            if ($test instanceof self && empty($groups)) {
                $groups = $test->getGroups();
            }

            if ($this->containsOnlyVirtualGroups($groups)) {
                $groups[] = 'default';
>>>>>>> update
            }

            foreach ($groups as $group) {
                if (!isset($this->groups[$group])) {
                    $this->groups[$group] = [$test];
                } else {
                    $this->groups[$group][] = $test;
                }
            }

<<<<<<< HEAD
            if ($test instanceof PHPUnit_Framework_TestCase) {
=======
            if ($test instanceof TestCase) {
>>>>>>> update
                $test->setGroups($groups);
            }
        }
    }

    /**
     * Adds the tests from the given class to the suite.
     *
<<<<<<< HEAD
     * @param mixed $testClass
     *
     * @throws PHPUnit_Framework_Exception
     */
    public function addTestSuite($testClass)
    {
        if (is_string($testClass) && class_exists($testClass)) {
            $testClass = new ReflectionClass($testClass);
        }

        if (!is_object($testClass)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
=======
     * @psalm-param object|class-string $testClass
     *
     * @throws Exception
     */
    public function addTestSuite($testClass): void
    {
        if (!(is_object($testClass) || (is_string($testClass) && class_exists($testClass)))) {
            throw InvalidArgumentException::create(
>>>>>>> update
                1,
                'class name or object'
            );
        }

<<<<<<< HEAD
=======
        if (!is_object($testClass)) {
            try {
                $testClass = new ReflectionClass($testClass);
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

>>>>>>> update
        if ($testClass instanceof self) {
            $this->addTest($testClass);
        } elseif ($testClass instanceof ReflectionClass) {
            $suiteMethod = false;

<<<<<<< HEAD
            if (!$testClass->isAbstract()) {
                if ($testClass->hasMethod(PHPUnit_Runner_BaseTestRunner::SUITE_METHODNAME)) {
                    $method = $testClass->getMethod(
                        PHPUnit_Runner_BaseTestRunner::SUITE_METHODNAME
                    );

                    if ($method->isStatic()) {
                        $this->addTest(
                            $method->invoke(null, $testClass->getName())
                        );

                        $suiteMethod = true;
                    }
                }
            }

            if (!$suiteMethod && !$testClass->isAbstract()) {
                $this->addTest(new self($testClass));
            }
        } else {
            throw new PHPUnit_Framework_Exception;
        }
    }

=======
            if (!$testClass->isAbstract() && $testClass->hasMethod(BaseTestRunner::SUITE_METHODNAME)) {
                try {
                    $method = $testClass->getMethod(
                        BaseTestRunner::SUITE_METHODNAME
                    );
                    // @codeCoverageIgnoreStart
                } catch (ReflectionException $e) {
                    throw new Exception(
                        $e->getMessage(),
                        (int) $e->getCode(),
                        $e
                    );
                }
                // @codeCoverageIgnoreEnd

                if ($method->isStatic()) {
                    $this->addTest(
                        $method->invoke(null, $testClass->getName())
                    );

                    $suiteMethod = true;
                }
            }

            if (!$suiteMethod && !$testClass->isAbstract() && $testClass->isSubclassOf(TestCase::class)) {
                $this->addTest(new self($testClass));
            }
        } else {
            throw new Exception;
        }
    }

    public function addWarning(string $warning): void
    {
        $this->warnings[] = $warning;
    }

>>>>>>> update
    /**
     * Wraps both <code>addTest()</code> and <code>addTestSuite</code>
     * as well as the separate import statements for the user's convenience.
     *
     * If the named file cannot be read or there are no new tests that can be
<<<<<<< HEAD
     * added, a <code>PHPUnit_Framework_WarningTestCase</code> will be created instead,
     * leaving the current test run untouched.
     *
     * @param string $filename
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 2.3.0
     */
    public function addTestFile($filename)
    {
        if (!is_string($filename)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (file_exists($filename) && substr($filename, -5) == '.phpt') {
            $this->addTest(
                new PHPUnit_Extensions_PhptTestCase($filename)
            );
=======
     * added, a <code>PHPUnit\Framework\WarningTestCase</code> will be created instead,
     * leaving the current test run untouched.
     *
     * @throws Exception
     */
    public function addTestFile(string $filename): void
    {
        if (is_file($filename) && substr($filename, -5) === '.phpt') {
            $this->addTest(new PhptTestCase($filename));

            $this->declaredClassesPointer = count(get_declared_classes());
>>>>>>> update

            return;
        }

<<<<<<< HEAD
        // The given file may contain further stub classes in addition to the
        // test class itself. Figure out the actual test class.
        $classes    = get_declared_classes();
        $filename   = PHPUnit_Util_Fileloader::checkAndLoad($filename);
        $newClasses = array_diff(get_declared_classes(), $classes);

        // The diff is empty in case a parent class (with test methods) is added
        // AFTER a child class that inherited from it. To account for that case,
        // cumulate all discovered classes, so the parent class may be found in
=======
        $numTests = count($this->tests);

        // The given file may contain further stub classes in addition to the
        // test class itself. Figure out the actual test class.
        $filename   = FileLoader::checkAndLoad($filename);
        $newClasses = array_slice(get_declared_classes(), $this->declaredClassesPointer);

        // The diff is empty in case a parent class (with test methods) is added
        // AFTER a child class that inherited from it. To account for that case,
        // accumulate all discovered classes, so the parent class may be found in
>>>>>>> update
        // a later invocation.
        if (!empty($newClasses)) {
            // On the assumption that test classes are defined first in files,
            // process discovered classes in approximate LIFO order, so as to
            // avoid unnecessary reflection.
<<<<<<< HEAD
            $this->foundClasses = array_merge($newClasses, $this->foundClasses);
        }

        // The test class's name must match the filename, either in full, or as
        // a PEAR/PSR-0 prefixed shortname ('NameSpace_ShortName'), or as a
        // PSR-1 local shortname ('NameSpace\ShortName'). The comparison must be
        // anchored to prevent false-positive matches (e.g., 'OtherShortName').
        $shortname      = basename($filename, '.php');
        $shortnameRegEx = '/(?:^|_|\\\\)' . preg_quote($shortname, '/') . '$/';

        foreach ($this->foundClasses as $i => $className) {
            if (preg_match($shortnameRegEx, $className)) {
                $class = new ReflectionClass($className);
=======
            $this->foundClasses           = array_merge($newClasses, $this->foundClasses);
            $this->declaredClassesPointer = count(get_declared_classes());
        }

        // The test class's name must match the filename, either in full, or as
        // a PEAR/PSR-0 prefixed short name ('NameSpace_ShortName'), or as a
        // PSR-1 local short name ('NameSpace\ShortName'). The comparison must be
        // anchored to prevent false-positive matches (e.g., 'OtherShortName').
        $shortName      = basename($filename, '.php');
        $shortNameRegEx = '/(?:^|_|\\\\)' . preg_quote($shortName, '/') . '$/';

        foreach ($this->foundClasses as $i => $className) {
            if (preg_match($shortNameRegEx, $className)) {
                try {
                    $class = new ReflectionClass($className);
                    // @codeCoverageIgnoreStart
                } catch (ReflectionException $e) {
                    throw new Exception(
                        $e->getMessage(),
                        (int) $e->getCode(),
                        $e
                    );
                }
                // @codeCoverageIgnoreEnd
>>>>>>> update

                if ($class->getFileName() == $filename) {
                    $newClasses = [$className];
                    unset($this->foundClasses[$i]);
<<<<<<< HEAD
=======

>>>>>>> update
                    break;
                }
            }
        }

        foreach ($newClasses as $className) {
<<<<<<< HEAD
            $class = new ReflectionClass($className);

            if (!$class->isAbstract()) {
                if ($class->hasMethod(PHPUnit_Runner_BaseTestRunner::SUITE_METHODNAME)) {
                    $method = $class->getMethod(
                        PHPUnit_Runner_BaseTestRunner::SUITE_METHODNAME
                    );
=======
            try {
                $class = new ReflectionClass($className);
                // @codeCoverageIgnoreStart
            } catch (ReflectionException $e) {
                throw new Exception(
                    $e->getMessage(),
                    (int) $e->getCode(),
                    $e
                );
            }
            // @codeCoverageIgnoreEnd

            if (dirname($class->getFileName()) === __DIR__) {
                continue;
            }

            if (!$class->isAbstract()) {
                if ($class->hasMethod(BaseTestRunner::SUITE_METHODNAME)) {
                    try {
                        $method = $class->getMethod(
                            BaseTestRunner::SUITE_METHODNAME
                        );
                        // @codeCoverageIgnoreStart
                    } catch (ReflectionException $e) {
                        throw new Exception(
                            $e->getMessage(),
                            (int) $e->getCode(),
                            $e
                        );
                    }
                    // @codeCoverageIgnoreEnd
>>>>>>> update

                    if ($method->isStatic()) {
                        $this->addTest($method->invoke(null, $className));
                    }
<<<<<<< HEAD
                } elseif ($class->implementsInterface('PHPUnit_Framework_Test')) {
=======
                } elseif ($class->implementsInterface(Test::class)) {
                    // Do we have modern namespacing ('Foo\Bar\WhizBangTest') or old-school namespacing ('Foo_Bar_WhizBangTest')?
                    $isPsr0            = (!$class->inNamespace()) && (strpos($class->getName(), '_') !== false);
                    $expectedClassName = $isPsr0 ? $className : $shortName;

                    if (($pos = strpos($expectedClassName, '.')) !== false) {
                        $expectedClassName = substr(
                            $expectedClassName,
                            0,
                            $pos
                        );
                    }

                    if ($class->getShortName() !== $expectedClassName) {
                        $this->addWarning(
                            sprintf(
                                "Test case class not matching filename is deprecated\n               in %s\n               Class name was '%s', expected '%s'",
                                $filename,
                                $class->getShortName(),
                                $expectedClassName
                            )
                        );
                    }

>>>>>>> update
                    $this->addTestSuite($class);
                }
            }
        }

<<<<<<< HEAD
=======
        if (count($this->tests) > ++$numTests) {
            $this->addWarning(
                sprintf(
                    "Multiple test case classes per file is deprecated\n               in %s",
                    $filename
                )
            );
        }

>>>>>>> update
        $this->numTests = -1;
    }

    /**
     * Wrapper for addTestFile() that adds multiple test files.
     *
<<<<<<< HEAD
     * @param array|Iterator $filenames
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 2.3.0
     */
    public function addTestFiles($filenames)
    {
        if (!(is_array($filenames) ||
             (is_object($filenames) && $filenames instanceof Iterator))) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                1,
                'array or iterator'
            );
        }

        foreach ($filenames as $filename) {
=======
     * @throws Exception
     */
    public function addTestFiles(iterable $fileNames): void
    {
        foreach ($fileNames as $filename) {
>>>>>>> update
            $this->addTestFile((string) $filename);
        }
    }

    /**
     * Counts the number of test cases that will be run by this test.
     *
<<<<<<< HEAD
     * @param bool $preferCache Indicates if cache is preferred.
     *
     * @return int
     */
    public function count($preferCache = false)
    {
        if ($preferCache && $this->cachedNumTests !== null) {
            $numTests = $this->cachedNumTests;
        } else {
            $numTests = 0;

            foreach ($this as $test) {
                $numTests += count($test);
            }

            $this->cachedNumTests = $numTests;
        }

        return $numTests;
    }

    /**
     * @param ReflectionClass $theClass
     * @param string          $name
     *
     * @return PHPUnit_Framework_Test
     *
     * @throws PHPUnit_Framework_Exception
     */
    public static function createTest(ReflectionClass $theClass, $name)
    {
        $className = $theClass->getName();

        if (!$theClass->isInstantiable()) {
            return self::warning(
                sprintf('Cannot instantiate class "%s".', $className)
            );
        }

        $backupSettings = PHPUnit_Util_Test::getBackupSettings(
            $className,
            $name
        );

        $preserveGlobalState = PHPUnit_Util_Test::getPreserveGlobalStateSettings(
            $className,
            $name
        );

        $runTestInSeparateProcess = PHPUnit_Util_Test::getProcessIsolationSettings(
            $className,
            $name
        );

        $constructor = $theClass->getConstructor();

        if ($constructor !== null) {
            $parameters = $constructor->getParameters();

            // TestCase() or TestCase($name)
            if (count($parameters) < 2) {
                $test = new $className;
            } // TestCase($name, $data)
            else {
                try {
                    $data = PHPUnit_Util_Test::getProvidedData(
                        $className,
                        $name
                    );
                } catch (PHPUnit_Framework_IncompleteTestError $e) {
                    $message = sprintf(
                        'Test for %s::%s marked incomplete by data provider',
                        $className,
                        $name
                    );

                    $_message = $e->getMessage();

                    if (!empty($_message)) {
                        $message .= "\n" . $_message;
                    }

                    $data = self::incompleteTest($className, $name, $message);
                } catch (PHPUnit_Framework_SkippedTestError $e) {
                    $message = sprintf(
                        'Test for %s::%s skipped by data provider',
                        $className,
                        $name
                    );

                    $_message = $e->getMessage();

                    if (!empty($_message)) {
                        $message .= "\n" . $_message;
                    }

                    $data = self::skipTest($className, $name, $message);
                } catch (Throwable $_t) {
                    $t = $_t;
                } catch (Exception $_t) {
                    $t = $_t;
                }

                if (isset($t)) {
                    $message = sprintf(
                        'The data provider specified for %s::%s is invalid.',
                        $className,
                        $name
                    );

                    $_message = $t->getMessage();

                    if (!empty($_message)) {
                        $message .= "\n" . $_message;
                    }

                    $data = self::warning($message);
                }

                // Test method with @dataProvider.
                if (isset($data)) {
                    $test = new PHPUnit_Framework_TestSuite_DataProvider(
                        $className . '::' . $name
                    );

                    if (empty($data)) {
                        $data = self::warning(
                            sprintf(
                                'No tests found in suite "%s".',
                                $test->getName()
                            )
                        );
                    }

                    $groups = PHPUnit_Util_Test::getGroups($className, $name);

                    if ($data instanceof PHPUnit_Framework_WarningTestCase ||
                        $data instanceof PHPUnit_Framework_SkippedTestCase ||
                        $data instanceof PHPUnit_Framework_IncompleteTestCase) {
                        $test->addTest($data, $groups);
                    } else {
                        foreach ($data as $_dataName => $_data) {
                            $_test = new $className($name, $_data, $_dataName);

                            if ($runTestInSeparateProcess) {
                                $_test->setRunTestInSeparateProcess(true);

                                if ($preserveGlobalState !== null) {
                                    $_test->setPreserveGlobalState($preserveGlobalState);
                                }
                            }

                            if ($backupSettings['backupGlobals'] !== null) {
                                $_test->setBackupGlobals(
                                    $backupSettings['backupGlobals']
                                );
                            }

                            if ($backupSettings['backupStaticAttributes'] !== null) {
                                $_test->setBackupStaticAttributes(
                                    $backupSettings['backupStaticAttributes']
                                );
                            }

                            $test->addTest($_test, $groups);
                        }
                    }
                } else {
                    $test = new $className;
                }
            }
        }

        if (!isset($test)) {
            throw new PHPUnit_Framework_Exception('No valid test provided.');
        }

        if ($test instanceof PHPUnit_Framework_TestCase) {
            $test->setName($name);

            if ($runTestInSeparateProcess) {
                $test->setRunTestInSeparateProcess(true);

                if ($preserveGlobalState !== null) {
                    $test->setPreserveGlobalState($preserveGlobalState);
                }
            }

            if ($backupSettings['backupGlobals'] !== null) {
                $test->setBackupGlobals($backupSettings['backupGlobals']);
            }

            if ($backupSettings['backupStaticAttributes'] !== null) {
                $test->setBackupStaticAttributes(
                    $backupSettings['backupStaticAttributes']
                );
            }
        }

        return $test;
    }

    /**
     * Creates a default TestResult object.
     *
     * @return PHPUnit_Framework_TestResult
     */
    protected function createResult()
    {
        return new PHPUnit_Framework_TestResult;
=======
     * @todo refactor usage of numTests in DefaultResultPrinter
     */
    public function count(): int
    {
        $this->numTests = 0;

        foreach ($this as $test) {
            $this->numTests += count($test);
        }

        return $this->numTests;
>>>>>>> update
    }

    /**
     * Returns the name of the suite.
<<<<<<< HEAD
     *
     * @return string
     */
    public function getName()
=======
     */
    public function getName(): string
>>>>>>> update
    {
        return $this->name;
    }

    /**
     * Returns the test groups of the suite.
     *
<<<<<<< HEAD
     * @return array
     *
     * @since Method available since Release 3.2.0
     */
    public function getGroups()
    {
        return array_keys($this->groups);
    }

    public function getGroupDetails()
=======
     * @psalm-return list<string>
     */
    public function getGroups(): array
    {
        return array_map(
            static function ($key): string
            {
                return (string) $key;
            },
            array_keys($this->groups)
        );
    }

    public function getGroupDetails(): array
>>>>>>> update
    {
        return $this->groups;
    }

    /**
<<<<<<< HEAD
     * Set tests groups of the test case
     *
     * @param array $groups
     *
     * @since Method available since Release 4.0.0
     */
    public function setGroupDetails(array $groups)
=======
     * Set tests groups of the test case.
     */
    public function setGroupDetails(array $groups): void
>>>>>>> update
    {
        $this->groups = $groups;
    }

    /**
     * Runs the tests and collects their result in a TestResult.
     *
<<<<<<< HEAD
     * @param PHPUnit_Framework_TestResult $result
     *
     * @return PHPUnit_Framework_TestResult
     */
    public function run(PHPUnit_Framework_TestResult $result = null)
=======
     * @throws \PHPUnit\Framework\CodeCoverageException
     * @throws \SebastianBergmann\CodeCoverage\InvalidArgumentException
     * @throws \SebastianBergmann\CodeCoverage\UnintentionallyCoveredCodeException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Warning
     */
    public function run(TestResult $result = null): TestResult
>>>>>>> update
    {
        if ($result === null) {
            $result = $this->createResult();
        }

<<<<<<< HEAD
        if (count($this) == 0) {
            return $result;
        }

        $hookMethods = PHPUnit_Util_Test::getHookMethods($this->name);

        $result->startTestSuite($this);

        try {
            $this->setUp();

            foreach ($hookMethods['beforeClass'] as $beforeClassMethod) {
                if ($this->testCase === true &&
                    class_exists($this->name, false) &&
                    method_exists($this->name, $beforeClassMethod)) {
                    if ($missingRequirements = PHPUnit_Util_Test::getMissingRequirements($this->name, $beforeClassMethod)) {
                        $this->markTestSuiteSkipped(implode(PHP_EOL, $missingRequirements));
                    }

                    call_user_func([$this->name, $beforeClassMethod]);
                }
            }
        } catch (PHPUnit_Framework_SkippedTestSuiteError $e) {
            $numTests = count($this);

            for ($i = 0; $i < $numTests; $i++) {
                $result->startTest($this);
                $result->addFailure($this, $e, 0);
                $result->endTest($this, 0);
            }

            $this->tearDown();
            $result->endTestSuite($this);

            return $result;
        } catch (Throwable $_t) {
            $t = $_t;
        } catch (Exception $_t) {
            $t = $_t;
        }

        if (isset($t)) {
            $numTests = count($this);

            for ($i = 0; $i < $numTests; $i++) {
                $result->startTest($this);
                $result->addError($this, $t, 0);
                $result->endTest($this, 0);
            }

            $this->tearDown();
            $result->endTestSuite($this);

            return $result;
=======
        if (count($this) === 0) {
            return $result;
        }

        /** @psalm-var class-string $className */
        $className   = $this->name;
        $hookMethods = TestUtil::getHookMethods($className);

        $result->startTestSuite($this);

        $test = null;

        if ($this->testCase && class_exists($this->name, false)) {
            try {
                foreach ($hookMethods['beforeClass'] as $beforeClassMethod) {
                    if (method_exists($this->name, $beforeClassMethod)) {
                        if ($missingRequirements = TestUtil::getMissingRequirements($this->name, $beforeClassMethod)) {
                            $this->markTestSuiteSkipped(implode(PHP_EOL, $missingRequirements));
                        }

                        call_user_func([$this->name, $beforeClassMethod]);
                    }
                }
            } catch (SkippedTestSuiteError $error) {
                foreach ($this->tests() as $test) {
                    $result->startTest($test);
                    $result->addFailure($test, $error, 0);
                    $result->endTest($test, 0);
                }

                $result->endTestSuite($this);

                return $result;
            } catch (Throwable $t) {
                $errorAdded = false;

                foreach ($this->tests() as $test) {
                    if ($result->shouldStop()) {
                        break;
                    }

                    $result->startTest($test);

                    if (!$errorAdded) {
                        $result->addError($test, $t, 0);

                        $errorAdded = true;
                    } else {
                        $result->addFailure(
                            $test,
                            new SkippedTestError('Test skipped because of an error in hook method'),
                            0
                        );
                    }

                    $result->endTest($test, 0);
                }

                $result->endTestSuite($this);

                return $result;
            }
>>>>>>> update
        }

        foreach ($this as $test) {
            if ($result->shouldStop()) {
                break;
            }

<<<<<<< HEAD
            if ($test instanceof PHPUnit_Framework_TestCase ||
                $test instanceof self) {
                $test->setbeStrictAboutChangesToGlobalState($this->beStrictAboutChangesToGlobalState);
=======
            if ($test instanceof TestCase || $test instanceof self) {
                $test->setBeStrictAboutChangesToGlobalState($this->beStrictAboutChangesToGlobalState);
>>>>>>> update
                $test->setBackupGlobals($this->backupGlobals);
                $test->setBackupStaticAttributes($this->backupStaticAttributes);
                $test->setRunTestInSeparateProcess($this->runTestInSeparateProcess);
            }

            $test->run($result);
        }

<<<<<<< HEAD
        foreach ($hookMethods['afterClass'] as $afterClassMethod) {
            if ($this->testCase === true && class_exists($this->name, false) && method_exists($this->name, $afterClassMethod)) {
                call_user_func([$this->name, $afterClassMethod]);
            }
        }

        $this->tearDown();

=======
        if ($this->testCase && class_exists($this->name, false)) {
            foreach ($hookMethods['afterClass'] as $afterClassMethod) {
                if (method_exists($this->name, $afterClassMethod)) {
                    try {
                        call_user_func([$this->name, $afterClassMethod]);
                    } catch (Throwable $t) {
                        $message = "Exception in {$this->name}::{$afterClassMethod}" . PHP_EOL . $t->getMessage();
                        $error   = new SyntheticError($message, 0, $t->getFile(), $t->getLine(), $t->getTrace());

                        $placeholderTest = clone $test;
                        $placeholderTest->setName($afterClassMethod);

                        $result->startTest($placeholderTest);
                        $result->addFailure($placeholderTest, $error, 0);
                        $result->endTest($placeholderTest, 0);
                    }
                }
            }
        }

>>>>>>> update
        $result->endTestSuite($this);

        return $result;
    }

<<<<<<< HEAD
    /**
     * @param bool $runTestInSeparateProcess
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 3.7.0
     */
    public function setRunTestInSeparateProcess($runTestInSeparateProcess)
    {
        if (is_bool($runTestInSeparateProcess)) {
            $this->runTestInSeparateProcess = $runTestInSeparateProcess;
        } else {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }
    }

    /**
     * Runs a test.
     *
     * @deprecated
     *
     * @param PHPUnit_Framework_Test       $test
     * @param PHPUnit_Framework_TestResult $result
     */
    public function runTest(PHPUnit_Framework_Test $test, PHPUnit_Framework_TestResult $result)
    {
        $test->run($result);
    }

    /**
     * Sets the name of the suite.
     *
     * @param  string
     */
    public function setName($name)
=======
    public function setRunTestInSeparateProcess(bool $runTestInSeparateProcess): void
    {
        $this->runTestInSeparateProcess = $runTestInSeparateProcess;
    }

    public function setName(string $name): void
>>>>>>> update
    {
        $this->name = $name;
    }

    /**
<<<<<<< HEAD
     * Returns the test at the given index.
     *
     * @param  int|false
     *
     * @return PHPUnit_Framework_Test
     */
    public function testAt($index)
    {
        if (isset($this->tests[$index])) {
            return $this->tests[$index];
        } else {
            return false;
        }
    }

    /**
     * Returns the tests as an enumeration.
     *
     * @return array
     */
    public function tests()
=======
     * Returns the tests as an enumeration.
     *
     * @return Test[]
     */
    public function tests(): array
>>>>>>> update
    {
        return $this->tests;
    }

    /**
<<<<<<< HEAD
     * Set tests of the test suite
     *
     * @param array $tests
     *
     * @since Method available since Release 4.0.0
     */
    public function setTests(array $tests)
=======
     * Set tests of the test suite.
     *
     * @param Test[] $tests
     */
    public function setTests(array $tests): void
>>>>>>> update
    {
        $this->tests = $tests;
    }

    /**
     * Mark the test suite as skipped.
     *
     * @param string $message
     *
<<<<<<< HEAD
     * @throws PHPUnit_Framework_SkippedTestSuiteError
     *
     * @since Method available since Release 3.0.0
     */
    public function markTestSuiteSkipped($message = '')
    {
        throw new PHPUnit_Framework_SkippedTestSuiteError($message);
    }

    /**
     * @param ReflectionClass  $class
     * @param ReflectionMethod $method
     */
    protected function addTestMethod(ReflectionClass $class, ReflectionMethod $method)
    {
        if (!$this->isTestMethod($method)) {
            return;
        }

        $name = $method->getName();

        if (!$method->isPublic()) {
            $this->addTest(
                self::warning(
                    sprintf(
                        'Test method "%s" in test class "%s" is not public.',
                        $name,
                        $class->getName()
                    )
                )
            );

            return;
        }

        $test = self::createTest($class, $name);

        if ($test instanceof PHPUnit_Framework_TestCase ||
            $test instanceof PHPUnit_Framework_TestSuite_DataProvider) {
            $test->setDependencies(
                PHPUnit_Util_Test::getDependencies($class->getName(), $name)
            );
        }

        $this->addTest(
            $test,
            PHPUnit_Util_Test::getGroups($class->getName(), $name)
        );
    }

    /**
     * @param ReflectionMethod $method
     *
     * @return bool
     */
    public static function isTestMethod(ReflectionMethod $method)
    {
        if (strpos($method->name, 'test') === 0) {
            return true;
        }

        // @scenario on TestCase::testMethod()
        // @test     on TestCase::testMethod()
        $docComment = $method->getDocComment();

        return strpos($docComment, '@test')     !== false ||
               strpos($docComment, '@scenario') !== false;
    }

    /**
     * @param string $message
     *
     * @return PHPUnit_Framework_WarningTestCase
     */
    protected static function warning($message)
    {
        return new PHPUnit_Framework_WarningTestCase($message);
    }

    /**
     * @param string $class
     * @param string $methodName
     * @param string $message
     *
     * @return PHPUnit_Framework_SkippedTestCase
     *
     * @since Method available since Release 4.3.0
     */
    protected static function skipTest($class, $methodName, $message)
    {
        return new PHPUnit_Framework_SkippedTestCase($class, $methodName, $message);
    }

    /**
     * @param string $class
     * @param string $methodName
     * @param string $message
     *
     * @return PHPUnit_Framework_IncompleteTestCase
     *
     * @since Method available since Release 4.3.0
     */
    protected static function incompleteTest($class, $methodName, $message)
    {
        return new PHPUnit_Framework_IncompleteTestCase($class, $methodName, $message);
=======
     * @throws SkippedTestSuiteError
     *
     * @psalm-return never-return
     */
    public function markTestSuiteSkipped($message = ''): void
    {
        throw new SkippedTestSuiteError($message);
>>>>>>> update
    }

    /**
     * @param bool $beStrictAboutChangesToGlobalState
<<<<<<< HEAD
     *
     * @since Method available since Release 4.6.0
     */
    public function setbeStrictAboutChangesToGlobalState($beStrictAboutChangesToGlobalState)
    {
        if (is_null($this->beStrictAboutChangesToGlobalState) && is_bool($beStrictAboutChangesToGlobalState)) {
=======
     */
    public function setBeStrictAboutChangesToGlobalState($beStrictAboutChangesToGlobalState): void
    {
        if (null === $this->beStrictAboutChangesToGlobalState && is_bool($beStrictAboutChangesToGlobalState)) {
>>>>>>> update
            $this->beStrictAboutChangesToGlobalState = $beStrictAboutChangesToGlobalState;
        }
    }

    /**
     * @param bool $backupGlobals
<<<<<<< HEAD
     *
     * @since Method available since Release 3.3.0
     */
    public function setBackupGlobals($backupGlobals)
    {
        if (is_null($this->backupGlobals) && is_bool($backupGlobals)) {
=======
     */
    public function setBackupGlobals($backupGlobals): void
    {
        if (null === $this->backupGlobals && is_bool($backupGlobals)) {
>>>>>>> update
            $this->backupGlobals = $backupGlobals;
        }
    }

    /**
     * @param bool $backupStaticAttributes
<<<<<<< HEAD
     *
     * @since Method available since Release 3.4.0
     */
    public function setBackupStaticAttributes($backupStaticAttributes)
    {
        if (is_null($this->backupStaticAttributes) &&
            is_bool($backupStaticAttributes)) {
=======
     */
    public function setBackupStaticAttributes($backupStaticAttributes): void
    {
        if (null === $this->backupStaticAttributes && is_bool($backupStaticAttributes)) {
>>>>>>> update
            $this->backupStaticAttributes = $backupStaticAttributes;
        }
    }

    /**
     * Returns an iterator for this test suite.
<<<<<<< HEAD
     *
     * @return RecursiveIteratorIterator
     *
     * @since Method available since Release 3.1.0
     */
    public function getIterator()
    {
        $iterator = new PHPUnit_Util_TestSuiteIterator($this);
=======
     */
    public function getIterator(): Iterator
    {
        $iterator = new TestSuiteIterator($this);
>>>>>>> update

        if ($this->iteratorFilter !== null) {
            $iterator = $this->iteratorFilter->factory($iterator, $this);
        }

        return $iterator;
    }

<<<<<<< HEAD
    public function injectFilter(PHPUnit_Runner_Filter_Factory $filter)
    {
        $this->iteratorFilter = $filter;
=======
    public function injectFilter(Factory $filter): void
    {
        $this->iteratorFilter = $filter;

>>>>>>> update
        foreach ($this as $test) {
            if ($test instanceof self) {
                $test->injectFilter($filter);
            }
        }
    }

    /**
<<<<<<< HEAD
     * Template Method that is called before the tests
     * of this test suite are run.
     *
     * @since Method available since Release 3.1.0
     */
    protected function setUp()
    {
    }

    /**
     * Template Method that is called after the tests
     * of this test suite have finished running.
     *
     * @since Method available since Release 3.1.0
     */
    protected function tearDown()
    {
=======
     * @psalm-return array<int,string>
     */
    public function warnings(): array
    {
        return array_unique($this->warnings);
    }

    /**
     * @return list<ExecutionOrderDependency>
     */
    public function provides(): array
    {
        if ($this->providedTests === null) {
            $this->providedTests = [];

            if (is_callable($this->sortId(), true)) {
                $this->providedTests[] = new ExecutionOrderDependency($this->sortId());
            }

            foreach ($this->tests as $test) {
                if (!($test instanceof Reorderable)) {
                    // @codeCoverageIgnoreStart
                    continue;
                    // @codeCoverageIgnoreEnd
                }
                $this->providedTests = ExecutionOrderDependency::mergeUnique($this->providedTests, $test->provides());
            }
        }

        return $this->providedTests;
    }

    /**
     * @return list<ExecutionOrderDependency>
     */
    public function requires(): array
    {
        if ($this->requiredTests === null) {
            $this->requiredTests = [];

            foreach ($this->tests as $test) {
                if (!($test instanceof Reorderable)) {
                    // @codeCoverageIgnoreStart
                    continue;
                    // @codeCoverageIgnoreEnd
                }
                $this->requiredTests = ExecutionOrderDependency::mergeUnique(
                    ExecutionOrderDependency::filterInvalid($this->requiredTests),
                    $test->requires()
                );
            }

            $this->requiredTests = ExecutionOrderDependency::diff($this->requiredTests, $this->provides());
        }

        return $this->requiredTests;
    }

    public function sortId(): string
    {
        return $this->getName() . '::class';
    }

    /**
     * Creates a default TestResult object.
     */
    protected function createResult(): TestResult
    {
        return new TestResult;
    }

    /**
     * @throws Exception
     */
    protected function addTestMethod(ReflectionClass $class, ReflectionMethod $method): void
    {
        $methodName = $method->getName();

        $test = (new TestBuilder)->build($class, $methodName);

        if ($test instanceof TestCase || $test instanceof DataProviderTestSuite) {
            $test->setDependencies(
                TestUtil::getDependencies($class->getName(), $methodName)
            );
        }

        $this->addTest(
            $test,
            TestUtil::getGroups($class->getName(), $methodName)
        );
    }

    private function clearCaches(): void
    {
        $this->numTests      = -1;
        $this->providedTests = null;
        $this->requiredTests = null;
    }

    private function containsOnlyVirtualGroups(array $groups): bool
    {
        foreach ($groups as $group) {
            if (strpos($group, '__phpunit_') !== 0) {
                return false;
            }
        }

        return true;
>>>>>>> update
    }
}
