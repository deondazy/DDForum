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
use SebastianBergmann\CodeCoverage\Filter as CodeCoverageFilter;
use SebastianBergmann\CodeCoverage\Report\Clover as CloverReport;
=======
namespace PHPUnit\TextUI;

use const PHP_EOL;
use const PHP_SAPI;
use const PHP_VERSION;
use function array_diff;
use function array_map;
use function array_merge;
use function assert;
use function class_exists;
use function count;
use function dirname;
use function file_put_contents;
use function htmlspecialchars;
use function is_array;
use function is_int;
use function is_string;
use function mt_srand;
use function range;
use function realpath;
use function sprintf;
use function time;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestResult;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\BaseTestRunner;
use PHPUnit\Runner\BeforeFirstTestHook;
use PHPUnit\Runner\DefaultTestResultCache;
use PHPUnit\Runner\Extension\ExtensionHandler;
use PHPUnit\Runner\Filter\ExcludeGroupFilterIterator;
use PHPUnit\Runner\Filter\Factory;
use PHPUnit\Runner\Filter\IncludeGroupFilterIterator;
use PHPUnit\Runner\Filter\NameFilterIterator;
use PHPUnit\Runner\Hook;
use PHPUnit\Runner\NullTestResultCache;
use PHPUnit\Runner\ResultCacheExtension;
use PHPUnit\Runner\StandardTestSuiteLoader;
use PHPUnit\Runner\TestHook;
use PHPUnit\Runner\TestListenerAdapter;
use PHPUnit\Runner\TestSuiteLoader;
use PHPUnit\Runner\TestSuiteSorter;
use PHPUnit\Runner\Version;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\FilterMapper;
use PHPUnit\TextUI\XmlConfiguration\Configuration;
use PHPUnit\TextUI\XmlConfiguration\Loader;
use PHPUnit\TextUI\XmlConfiguration\PhpHandler;
use PHPUnit\Util\Color;
use PHPUnit\Util\Filesystem;
use PHPUnit\Util\Log\JUnit;
use PHPUnit\Util\Log\TeamCity;
use PHPUnit\Util\Printer;
use PHPUnit\Util\TestDox\CliTestDoxPrinter;
use PHPUnit\Util\TestDox\HtmlResultPrinter;
use PHPUnit\Util\TestDox\TextResultPrinter;
use PHPUnit\Util\TestDox\XmlResultPrinter;
use PHPUnit\Util\XdebugFilterScriptGenerator;
use PHPUnit\Util\Xml\SchemaDetector;
use ReflectionClass;
use ReflectionException;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\Exception as CodeCoverageException;
use SebastianBergmann\CodeCoverage\Filter as CodeCoverageFilter;
use SebastianBergmann\CodeCoverage\Report\Clover as CloverReport;
use SebastianBergmann\CodeCoverage\Report\Cobertura as CoberturaReport;
>>>>>>> update
use SebastianBergmann\CodeCoverage\Report\Crap4j as Crap4jReport;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;
use SebastianBergmann\CodeCoverage\Report\PHP as PhpReport;
use SebastianBergmann\CodeCoverage\Report\Text as TextReport;
use SebastianBergmann\CodeCoverage\Report\Xml\Facade as XmlReport;
<<<<<<< HEAD
use SebastianBergmann\Environment\Runtime;

/**
 * A TestRunner for the Command Line Interface (CLI)
 * PHP SAPI Module.
 *
 * @since Class available since Release 2.0.0
 */
class PHPUnit_TextUI_TestRunner extends PHPUnit_Runner_BaseTestRunner
{
    const SUCCESS_EXIT   = 0;
    const FAILURE_EXIT   = 1;
    const EXCEPTION_EXIT = 2;
=======
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Environment\Runtime;
use SebastianBergmann\Invoker\Invoker;
use SebastianBergmann\Timer\Timer;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class TestRunner extends BaseTestRunner
{
    public const SUCCESS_EXIT = 0;

    public const FAILURE_EXIT = 1;

    public const EXCEPTION_EXIT = 2;
>>>>>>> update

    /**
     * @var CodeCoverageFilter
     */
<<<<<<< HEAD
    protected $codeCoverageFilter;

    /**
     * @var PHPUnit_Runner_TestSuiteLoader
     */
    protected $loader = null;

    /**
     * @var PHPUnit_TextUI_ResultPrinter
     */
    protected $printer = null;

    /**
     * @var bool
     */
    protected static $versionStringPrinted = false;

    /**
     * @var Runtime
     */
    private $runtime;
=======
    private $codeCoverageFilter;

    /**
     * @var TestSuiteLoader
     */
    private $loader;

    /**
     * @var ResultPrinter
     */
    private $printer;
>>>>>>> update

    /**
     * @var bool
     */
    private $messagePrinted = false;

    /**
<<<<<<< HEAD
     * @param PHPUnit_Runner_TestSuiteLoader $loader
     * @param CodeCoverageFilter             $filter
     *
     * @since Method available since Release 3.4.0
     */
    public function __construct(PHPUnit_Runner_TestSuiteLoader $loader = null, CodeCoverageFilter $filter = null)
=======
     * @var Hook[]
     */
    private $extensions = [];

    /**
     * @var Timer
     */
    private $timer;

    public function __construct(TestSuiteLoader $loader = null, CodeCoverageFilter $filter = null)
>>>>>>> update
    {
        if ($filter === null) {
            $filter = new CodeCoverageFilter;
        }

        $this->codeCoverageFilter = $filter;
        $this->loader             = $loader;
<<<<<<< HEAD
        $this->runtime            = new Runtime;
    }

    /**
     * @param PHPUnit_Framework_Test|ReflectionClass $test
     * @param array                                  $arguments
     *
     * @return PHPUnit_Framework_TestResult
     *
     * @throws PHPUnit_Framework_Exception
     */
    public static function run($test, array $arguments = [])
    {
        if ($test instanceof ReflectionClass) {
            $test = new PHPUnit_Framework_TestSuite($test);
        }

        if ($test instanceof PHPUnit_Framework_Test) {
            $aTestRunner = new self;

            return $aTestRunner->doRun(
                $test,
                $arguments
            );
        } else {
            throw new PHPUnit_Framework_Exception(
                'No test case or test suite found.'
            );
        }
    }

    /**
     * @return PHPUnit_Framework_TestResult
     */
    protected function createTestResult()
    {
        return new PHPUnit_Framework_TestResult;
    }

    private function processSuiteFilters(PHPUnit_Framework_TestSuite $suite, array $arguments)
    {
        if (!$arguments['filter'] &&
            empty($arguments['groups']) &&
            empty($arguments['excludeGroups'])) {
            return;
        }

        $filterFactory = new PHPUnit_Runner_Filter_Factory();

        if (!empty($arguments['excludeGroups'])) {
            $filterFactory->addFilter(
                new ReflectionClass('PHPUnit_Runner_Filter_Group_Exclude'),
                $arguments['excludeGroups']
            );
        }

        if (!empty($arguments['groups'])) {
            $filterFactory->addFilter(
                new ReflectionClass('PHPUnit_Runner_Filter_Group_Include'),
                $arguments['groups']
            );
        }

        if ($arguments['filter']) {
            $filterFactory->addFilter(
                new ReflectionClass('PHPUnit_Runner_Filter_Test'),
                $arguments['filter']
            );
        }
        $suite->injectFilter($filterFactory);
    }

    /**
     * @param PHPUnit_Framework_Test $suite
     * @param array                  $arguments
     * @param bool                   $exit
     *
     * @return PHPUnit_Framework_TestResult
     */
    public function doRun(PHPUnit_Framework_Test $suite, array $arguments = [], $exit = true)
=======
        $this->timer              = new Timer;
    }

    /**
     * @throws \PHPUnit\Runner\Exception
     * @throws \PHPUnit\TextUI\XmlConfiguration\Exception
     * @throws Exception
     */
    public function run(TestSuite $suite, array $arguments = [], array $warnings = [], bool $exit = true): TestResult
>>>>>>> update
    {
        if (isset($arguments['configuration'])) {
            $GLOBALS['__PHPUNIT_CONFIGURATION_FILE'] = $arguments['configuration'];
        }

        $this->handleConfiguration($arguments);

<<<<<<< HEAD
        $this->processSuiteFilters($suite, $arguments);
=======
        $warnings = array_merge($warnings, $arguments['warnings']);

        if (is_int($arguments['columns']) && $arguments['columns'] < 16) {
            $arguments['columns']   = 16;
            $tooFewColumnsRequested = true;
        }
>>>>>>> update

        if (isset($arguments['bootstrap'])) {
            $GLOBALS['__PHPUNIT_BOOTSTRAP'] = $arguments['bootstrap'];
        }

<<<<<<< HEAD
        if ($arguments['backupGlobals'] === false) {
            $suite->setBackupGlobals(false);
=======
        if ($arguments['backupGlobals'] === true) {
            $suite->setBackupGlobals(true);
>>>>>>> update
        }

        if ($arguments['backupStaticAttributes'] === true) {
            $suite->setBackupStaticAttributes(true);
        }

        if ($arguments['beStrictAboutChangesToGlobalState'] === true) {
<<<<<<< HEAD
            $suite->setbeStrictAboutChangesToGlobalState(true);
        }

        if (is_integer($arguments['repeat'])) {
            $test = new PHPUnit_Extensions_RepeatedTest(
                $suite,
                $arguments['repeat'],
                $arguments['processIsolation']
            );

            $suite = new PHPUnit_Framework_TestSuite();
            $suite->addTest($test);
=======
            $suite->setBeStrictAboutChangesToGlobalState(true);
        }

        if ($arguments['executionOrder'] === TestSuiteSorter::ORDER_RANDOMIZED) {
            mt_srand($arguments['randomOrderSeed']);
        }

        if ($arguments['cacheResult']) {
            if (!isset($arguments['cacheResultFile'])) {
                if (isset($arguments['configurationObject'])) {
                    assert($arguments['configurationObject'] instanceof Configuration);

                    $cacheLocation = $arguments['configurationObject']->filename();
                } else {
                    $cacheLocation = $_SERVER['PHP_SELF'];
                }

                $arguments['cacheResultFile'] = null;

                $cacheResultFile = realpath($cacheLocation);

                if ($cacheResultFile !== false) {
                    $arguments['cacheResultFile'] = dirname($cacheResultFile);
                }
            }

            $cache = new DefaultTestResultCache($arguments['cacheResultFile']);

            $this->addExtension(new ResultCacheExtension($cache));
        }

        if ($arguments['executionOrder'] !== TestSuiteSorter::ORDER_DEFAULT || $arguments['executionOrderDefects'] !== TestSuiteSorter::ORDER_DEFAULT || $arguments['resolveDependencies']) {
            $cache = $cache ?? new NullTestResultCache;

            $cache->load();

            $sorter = new TestSuiteSorter($cache);

            $sorter->reorderTestsInSuite($suite, $arguments['executionOrder'], $arguments['resolveDependencies'], $arguments['executionOrderDefects']);
            $originalExecutionOrder = $sorter->getOriginalExecutionOrder();

            unset($sorter);
        }

        if (is_int($arguments['repeat']) && $arguments['repeat'] > 0) {
            $_suite = new TestSuite;

            /* @noinspection PhpUnusedLocalVariableInspection */
            foreach (range(1, $arguments['repeat']) as $step) {
                $_suite->addTest($suite);
            }

            $suite = $_suite;

            unset($_suite);
>>>>>>> update
        }

        $result = $this->createTestResult();

<<<<<<< HEAD
=======
        $listener       = new TestListenerAdapter;
        $listenerNeeded = false;

        foreach ($this->extensions as $extension) {
            if ($extension instanceof TestHook) {
                $listener->add($extension);

                $listenerNeeded = true;
            }
        }

        if ($listenerNeeded) {
            $result->addListener($listener);
        }

        unset($listener, $listenerNeeded);

        if ($arguments['convertDeprecationsToExceptions']) {
            $result->convertDeprecationsToExceptions(true);
        }

>>>>>>> update
        if (!$arguments['convertErrorsToExceptions']) {
            $result->convertErrorsToExceptions(false);
        }

        if (!$arguments['convertNoticesToExceptions']) {
<<<<<<< HEAD
            PHPUnit_Framework_Error_Notice::$enabled = false;
        }

        if (!$arguments['convertWarningsToExceptions']) {
            PHPUnit_Framework_Error_Warning::$enabled = false;
=======
            $result->convertNoticesToExceptions(false);
        }

        if (!$arguments['convertWarningsToExceptions']) {
            $result->convertWarningsToExceptions(false);
>>>>>>> update
        }

        if ($arguments['stopOnError']) {
            $result->stopOnError(true);
        }

        if ($arguments['stopOnFailure']) {
            $result->stopOnFailure(true);
        }

        if ($arguments['stopOnWarning']) {
            $result->stopOnWarning(true);
        }

        if ($arguments['stopOnIncomplete']) {
            $result->stopOnIncomplete(true);
        }

        if ($arguments['stopOnRisky']) {
            $result->stopOnRisky(true);
        }

        if ($arguments['stopOnSkipped']) {
            $result->stopOnSkipped(true);
        }

<<<<<<< HEAD
=======
        if ($arguments['stopOnDefect']) {
            $result->stopOnDefect(true);
        }

>>>>>>> update
        if ($arguments['registerMockObjectsFromTestArgumentsRecursively']) {
            $result->setRegisterMockObjectsFromTestArgumentsRecursively(true);
        }

        if ($this->printer === null) {
<<<<<<< HEAD
            if (isset($arguments['printer']) &&
                $arguments['printer'] instanceof PHPUnit_Util_Printer) {
                $this->printer = $arguments['printer'];
            } else {
                $printerClass = 'PHPUnit_TextUI_ResultPrinter';

                if (isset($arguments['printer']) &&
                    is_string($arguments['printer']) &&
                    class_exists($arguments['printer'], false)) {
                    $class = new ReflectionClass($arguments['printer']);

                    if ($class->isSubclassOf('PHPUnit_TextUI_ResultPrinter')) {
                        $printerClass = $arguments['printer'];
                    }
                }

                $this->printer = new $printerClass(
                    isset($arguments['stderr']) ? 'php://stderr' : null,
                    $arguments['verbose'],
                    $arguments['colors'],
                    $arguments['debug'],
                    $arguments['columns'],
                    $arguments['reverseList']
                );
            }
        }

        if (!$this->printer instanceof PHPUnit_Util_Log_TAP) {
            $this->printer->write(
                PHPUnit_Runner_Version::getVersionString() . "\n"
            );

            self::$versionStringPrinted = true;

            if ($arguments['verbose']) {
                $runtime = $this->runtime->getNameWithVersion();

                if ($this->runtime->hasXdebug()) {
                    $runtime .= sprintf(
                        ' with Xdebug %s',
                        phpversion('xdebug')
                    );
                }

                $this->writeMessage('Runtime', $runtime);

                if (isset($arguments['configuration'])) {
                    $this->writeMessage(
                        'Configuration',
                        $arguments['configuration']->getFilename()
                    );
                }
            }

            if (isset($arguments['deprecatedCheckForUnintentionallyCoveredCodeSettingUsed'])) {
                print "Warning:       Deprecated configuration setting \"checkForUnintentionallyCoveredCode\" used\n";
            }
=======
            if (isset($arguments['printer'])) {
                if ($arguments['printer'] instanceof ResultPrinter) {
                    $this->printer = $arguments['printer'];
                } elseif (is_string($arguments['printer']) && class_exists($arguments['printer'], false)) {
                    try {
                        $reflector = new ReflectionClass($arguments['printer']);

                        if ($reflector->implementsInterface(ResultPrinter::class)) {
                            $this->printer = $this->createPrinter($arguments['printer'], $arguments);
                        }

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
            } else {
                $this->printer = $this->createPrinter(DefaultResultPrinter::class, $arguments);
            }
        }

        if (isset($originalExecutionOrder) && $this->printer instanceof CliTestDoxPrinter) {
            assert($this->printer instanceof CliTestDoxPrinter);

            $this->printer->setOriginalExecutionOrder($originalExecutionOrder);
            $this->printer->setShowProgressAnimation(!$arguments['noInteraction']);
        }

        if ($arguments['colors'] !== DefaultResultPrinter::COLOR_NEVER) {
            $this->write(
                'PHPUnit ' .
                Version::id() .
                ' ' .
                Color::colorize('bg-blue,fg-white', '#StandWith') .
                Color::colorize('bg-yellow,fg-black', 'Ukraine') .
                "\n"
            );
        } else {
            $this->write(Version::getVersionString() . "\n");
>>>>>>> update
        }

        foreach ($arguments['listeners'] as $listener) {
            $result->addListener($listener);
        }

        $result->addListener($this->printer);

<<<<<<< HEAD
        if (isset($arguments['testdoxHTMLFile'])) {
            $result->addListener(
                new PHPUnit_Util_TestDox_ResultPrinter_HTML(
=======
        $coverageFilterFromConfigurationFile = false;
        $coverageFilterFromOption            = false;
        $codeCoverageReports                 = 0;

        if (isset($arguments['testdoxHTMLFile'])) {
            $result->addListener(
                new HtmlResultPrinter(
>>>>>>> update
                    $arguments['testdoxHTMLFile'],
                    $arguments['testdoxGroups'],
                    $arguments['testdoxExcludeGroups']
                )
            );
        }

        if (isset($arguments['testdoxTextFile'])) {
            $result->addListener(
<<<<<<< HEAD
                new PHPUnit_Util_TestDox_ResultPrinter_Text(
=======
                new TextResultPrinter(
>>>>>>> update
                    $arguments['testdoxTextFile'],
                    $arguments['testdoxGroups'],
                    $arguments['testdoxExcludeGroups']
                )
            );
        }

        if (isset($arguments['testdoxXMLFile'])) {
            $result->addListener(
<<<<<<< HEAD
                new PHPUnit_Util_TestDox_ResultPrinter_XML(
=======
                new XmlResultPrinter(
>>>>>>> update
                    $arguments['testdoxXMLFile']
                )
            );
        }

<<<<<<< HEAD
        $codeCoverageReports = 0;
=======
        if (isset($arguments['teamcityLogfile'])) {
            $result->addListener(
                new TeamCity($arguments['teamcityLogfile'])
            );
        }

        if (isset($arguments['junitLogfile'])) {
            $result->addListener(
                new JUnit(
                    $arguments['junitLogfile'],
                    $arguments['reportUselessTests']
                )
            );
        }
>>>>>>> update

        if (isset($arguments['coverageClover'])) {
            $codeCoverageReports++;
        }

<<<<<<< HEAD
=======
        if (isset($arguments['coverageCobertura'])) {
            $codeCoverageReports++;
        }

>>>>>>> update
        if (isset($arguments['coverageCrap4J'])) {
            $codeCoverageReports++;
        }

        if (isset($arguments['coverageHtml'])) {
            $codeCoverageReports++;
        }

        if (isset($arguments['coveragePHP'])) {
            $codeCoverageReports++;
        }

        if (isset($arguments['coverageText'])) {
            $codeCoverageReports++;
        }

        if (isset($arguments['coverageXml'])) {
            $codeCoverageReports++;
        }

<<<<<<< HEAD
        if (isset($arguments['noCoverage'])) {
            $codeCoverageReports = 0;
        }

        if ($codeCoverageReports > 0) {
            if (!$this->runtime->canCollectCodeCoverage()) {
                $this->writeMessage('Error', 'No code coverage driver is available');

                $codeCoverageReports = 0;
            } elseif (!isset($arguments['whitelist']) && !$this->codeCoverageFilter->hasWhitelist()) {
                $this->writeMessage('Error', 'No whitelist configured, no code coverage will be generated');

                $codeCoverageReports = 0;
            }
        }

        if (!$this->printer instanceof PHPUnit_Util_Log_TAP) {
            $this->printer->write("\n");
        }

        if ($codeCoverageReports > 0) {
            $codeCoverage = new CodeCoverage(
                null,
                $this->codeCoverageFilter
            );

            $codeCoverage->setUnintentionallyCoveredSubclassesWhitelist(
                [SebastianBergmann\Comparator\Comparator::class]
            );

            $codeCoverage->setAddUncoveredFilesFromWhitelist(
                $arguments['addUncoveredFilesFromWhitelist']
            );

            $codeCoverage->setCheckForUnintentionallyCoveredCode(
                $arguments['strictCoverage']
            );

            $codeCoverage->setCheckForMissingCoversAnnotation(
                $arguments['strictCoverage']
            );

            $codeCoverage->setProcessUncoveredFilesFromWhitelist(
                $arguments['processUncoveredFilesFromWhitelist']
            );

            if (isset($arguments['forceCoversAnnotation'])) {
                $codeCoverage->setForceCoversAnnotation(
                    $arguments['forceCoversAnnotation']
                );
            }

            if (isset($arguments['disableCodeCoverageIgnore'])) {
                $codeCoverage->setDisableIgnoredLines(true);
            }

            if (isset($arguments['whitelist'])) {
                $this->codeCoverageFilter->addDirectoryToWhitelist($arguments['whitelist']);
            }

            $result->setCodeCoverage($codeCoverage);
        }

        if ($codeCoverageReports > 1) {
            if (isset($arguments['cacheTokens'])) {
                $codeCoverage->setCacheTokens($arguments['cacheTokens']);
            }
        }

        if (isset($arguments['jsonLogfile'])) {
            $result->addListener(
                new PHPUnit_Util_Log_JSON($arguments['jsonLogfile'])
            );
        }

        if (isset($arguments['tapLogfile'])) {
            $result->addListener(
                new PHPUnit_Util_Log_TAP($arguments['tapLogfile'])
            );
        }

        if (isset($arguments['teamcityLogfile'])) {
            $result->addListener(
                new PHPUnit_Util_Log_TeamCity($arguments['teamcityLogfile'])
            );
        }

        if (isset($arguments['junitLogfile'])) {
            $result->addListener(
                new PHPUnit_Util_Log_JUnit(
                    $arguments['junitLogfile'],
                    $arguments['logIncompleteSkipped']
                )
            );
        }

=======
        if ($codeCoverageReports > 0 || isset($arguments['xdebugFilterFile'])) {
            if (isset($arguments['coverageFilter'])) {
                if (!is_array($arguments['coverageFilter'])) {
                    $coverageFilterDirectories = [$arguments['coverageFilter']];
                } else {
                    $coverageFilterDirectories = $arguments['coverageFilter'];
                }

                foreach ($coverageFilterDirectories as $coverageFilterDirectory) {
                    $this->codeCoverageFilter->includeDirectory($coverageFilterDirectory);
                }

                $coverageFilterFromOption = true;
            }

            if (isset($arguments['configurationObject'])) {
                assert($arguments['configurationObject'] instanceof Configuration);

                $codeCoverageConfiguration = $arguments['configurationObject']->codeCoverage();

                if ($codeCoverageConfiguration->hasNonEmptyListOfFilesToBeIncludedInCodeCoverageReport()) {
                    $coverageFilterFromConfigurationFile = true;

                    (new FilterMapper)->map(
                        $this->codeCoverageFilter,
                        $codeCoverageConfiguration
                    );
                }
            }
        }

        if ($codeCoverageReports > 0) {
            try {
                if (isset($codeCoverageConfiguration) &&
                    ($codeCoverageConfiguration->pathCoverage() || (isset($arguments['pathCoverage']) && $arguments['pathCoverage'] === true))) {
                    $codeCoverageDriver = (new Selector)->forLineAndPathCoverage($this->codeCoverageFilter);
                } else {
                    $codeCoverageDriver = (new Selector)->forLineCoverage($this->codeCoverageFilter);
                }

                $codeCoverage = new CodeCoverage(
                    $codeCoverageDriver,
                    $this->codeCoverageFilter
                );

                if (isset($codeCoverageConfiguration) && $codeCoverageConfiguration->hasCacheDirectory()) {
                    $codeCoverage->cacheStaticAnalysis($codeCoverageConfiguration->cacheDirectory()->path());
                }

                if (isset($arguments['coverageCacheDirectory'])) {
                    $codeCoverage->cacheStaticAnalysis($arguments['coverageCacheDirectory']);
                }

                $codeCoverage->excludeSubclassesOfThisClassFromUnintentionallyCoveredCodeCheck(Comparator::class);

                if ($arguments['strictCoverage']) {
                    $codeCoverage->enableCheckForUnintentionallyCoveredCode();
                }

                if (isset($arguments['ignoreDeprecatedCodeUnitsFromCodeCoverage'])) {
                    if ($arguments['ignoreDeprecatedCodeUnitsFromCodeCoverage']) {
                        $codeCoverage->ignoreDeprecatedCode();
                    } else {
                        $codeCoverage->doNotIgnoreDeprecatedCode();
                    }
                }

                if (isset($arguments['disableCodeCoverageIgnore'])) {
                    if ($arguments['disableCodeCoverageIgnore']) {
                        $codeCoverage->disableAnnotationsForIgnoringCode();
                    } else {
                        $codeCoverage->enableAnnotationsForIgnoringCode();
                    }
                }

                if (isset($arguments['configurationObject'])) {
                    $codeCoverageConfiguration = $arguments['configurationObject']->codeCoverage();

                    if ($codeCoverageConfiguration->hasNonEmptyListOfFilesToBeIncludedInCodeCoverageReport()) {
                        if ($codeCoverageConfiguration->includeUncoveredFiles()) {
                            $codeCoverage->includeUncoveredFiles();
                        } else {
                            $codeCoverage->excludeUncoveredFiles();
                        }

                        if ($codeCoverageConfiguration->processUncoveredFiles()) {
                            $codeCoverage->processUncoveredFiles();
                        } else {
                            $codeCoverage->doNotProcessUncoveredFiles();
                        }
                    }
                }

                if ($this->codeCoverageFilter->isEmpty()) {
                    if (!$coverageFilterFromConfigurationFile && !$coverageFilterFromOption) {
                        $warnings[] = 'No filter is configured, code coverage will not be processed';
                    } else {
                        $warnings[] = 'Incorrect filter configuration, code coverage will not be processed';
                    }

                    unset($codeCoverage);
                }
            } catch (CodeCoverageException $e) {
                $warnings[] = $e->getMessage();
            }
        }

        if ($arguments['verbose']) {
            if (PHP_SAPI === 'phpdbg') {
                $this->writeMessage('Runtime', 'PHPDBG ' . PHP_VERSION);
            } else {
                $runtime = 'PHP ' . PHP_VERSION;

                if (isset($codeCoverageDriver)) {
                    $runtime .= ' with ' . $codeCoverageDriver->nameAndVersion();
                }

                $this->writeMessage('Runtime', $runtime);
            }

            if (isset($arguments['configurationObject'])) {
                assert($arguments['configurationObject'] instanceof Configuration);

                $this->writeMessage(
                    'Configuration',
                    $arguments['configurationObject']->filename()
                );
            }

            foreach ($arguments['loadedExtensions'] as $extension) {
                $this->writeMessage(
                    'Extension',
                    $extension
                );
            }

            foreach ($arguments['notLoadedExtensions'] as $extension) {
                $this->writeMessage(
                    'Extension',
                    $extension
                );
            }
        }

        if ($arguments['executionOrder'] === TestSuiteSorter::ORDER_RANDOMIZED) {
            $this->writeMessage(
                'Random Seed',
                (string) $arguments['randomOrderSeed']
            );
        }

        if (isset($tooFewColumnsRequested)) {
            $warnings[] = 'Less than 16 columns requested, number of columns set to 16';
        }

        if ((new Runtime)->discardsComments()) {
            $warnings[] = 'opcache.save_comments=0 set; annotations will not work';
        }

        if (isset($arguments['conflictBetweenPrinterClassAndTestdox'])) {
            $warnings[] = 'Directives printerClass and testdox are mutually exclusive';
        }

        foreach ($warnings as $warning) {
            $this->writeMessage('Warning', $warning);
        }

        if (isset($arguments['configurationObject'])) {
            assert($arguments['configurationObject'] instanceof Configuration);

            if ($arguments['configurationObject']->hasValidationErrors()) {
                if ((new SchemaDetector)->detect($arguments['configurationObject']->filename())->detected()) {
                    $this->writeMessage('Warning', 'Your XML configuration validates against a deprecated schema.');
                    $this->writeMessage('Suggestion', 'Migrate your XML configuration using "--migrate-configuration"!');
                } else {
                    $this->write(
                        "\n  Warning - The configuration file did not pass validation!\n  The following problems have been detected:\n"
                    );

                    $this->write($arguments['configurationObject']->validationErrors());

                    $this->write("\n  Test results may not be as expected.\n\n");
                }
            }
        }

        if (isset($arguments['xdebugFilterFile'], $codeCoverageConfiguration)) {
            $this->write(PHP_EOL . 'Please note that --dump-xdebug-filter and --prepend are deprecated and will be removed in PHPUnit 10.' . PHP_EOL);

            $script = (new XdebugFilterScriptGenerator)->generate($codeCoverageConfiguration);

            if ($arguments['xdebugFilterFile'] !== 'php://stdout' && $arguments['xdebugFilterFile'] !== 'php://stderr' && !Filesystem::createDirectory(dirname($arguments['xdebugFilterFile']))) {
                $this->write(sprintf('Cannot write Xdebug filter script to %s ' . PHP_EOL, $arguments['xdebugFilterFile']));

                exit(self::EXCEPTION_EXIT);
            }

            file_put_contents($arguments['xdebugFilterFile'], $script);

            $this->write(sprintf('Wrote Xdebug filter script to %s ' . PHP_EOL . PHP_EOL, $arguments['xdebugFilterFile']));

            exit(self::SUCCESS_EXIT);
        }

        $this->write("\n");

        if (isset($codeCoverage)) {
            $result->setCodeCoverage($codeCoverage);
        }

>>>>>>> update
        $result->beStrictAboutTestsThatDoNotTestAnything($arguments['reportUselessTests']);
        $result->beStrictAboutOutputDuringTests($arguments['disallowTestOutput']);
        $result->beStrictAboutTodoAnnotatedTests($arguments['disallowTodoAnnotatedTests']);
        $result->beStrictAboutResourceUsageDuringSmallTests($arguments['beStrictAboutResourceUsageDuringSmallTests']);
<<<<<<< HEAD
        $result->enforceTimeLimit($arguments['enforceTimeLimit']);
=======

        if ($arguments['enforceTimeLimit'] === true && !(new Invoker)->canInvokeWithTimeout()) {
            $this->writeMessage('Error', 'PHP extension pcntl is required for enforcing time limits');
        }

        $result->enforceTimeLimit($arguments['enforceTimeLimit']);
        $result->setDefaultTimeLimit($arguments['defaultTimeLimit']);
>>>>>>> update
        $result->setTimeoutForSmallTests($arguments['timeoutForSmallTests']);
        $result->setTimeoutForMediumTests($arguments['timeoutForMediumTests']);
        $result->setTimeoutForLargeTests($arguments['timeoutForLargeTests']);

<<<<<<< HEAD
        if ($suite instanceof PHPUnit_Framework_TestSuite) {
            $suite->setRunTestInSeparateProcess($arguments['processIsolation']);
=======
        if (isset($arguments['forceCoversAnnotation']) && $arguments['forceCoversAnnotation'] === true) {
            $result->forceCoversAnnotation();
        }

        $this->processSuiteFilters($suite, $arguments);
        $suite->setRunTestInSeparateProcess($arguments['processIsolation']);

        foreach ($this->extensions as $extension) {
            if ($extension instanceof BeforeFirstTestHook) {
                $extension->executeBeforeFirstTest();
            }
        }

        $testSuiteWarningsPrinted = false;

        foreach ($suite->warnings() as $warning) {
            $this->writeMessage('Warning', $warning);

            $testSuiteWarningsPrinted = true;
        }

        if ($testSuiteWarningsPrinted) {
            $this->write(PHP_EOL);
>>>>>>> update
        }

        $suite->run($result);

<<<<<<< HEAD
        unset($suite);
        $result->flushListeners();

        if ($this->printer instanceof PHPUnit_TextUI_ResultPrinter) {
            $this->printer->printResult($result);
        }

        if (isset($codeCoverage)) {
            if (isset($arguments['coverageClover'])) {
                $this->printer->write(
                    "\nGenerating code coverage report in Clover XML format ..."
                );

                try {
                    $writer = new CloverReport();
                    $writer->process($codeCoverage, $arguments['coverageClover']);

                    $this->printer->write(" done\n");
                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->printer->write(
                        " failed\n" . $e->getMessage() . "\n"
                    );
=======
        foreach ($this->extensions as $extension) {
            if ($extension instanceof AfterLastTestHook) {
                $extension->executeAfterLastTest();
            }
        }

        $result->flushListeners();
        $this->printer->printResult($result);

        if (isset($codeCoverage)) {
            if (isset($arguments['coverageClover'])) {
                $this->codeCoverageGenerationStart('Clover XML');

                try {
                    $writer = new CloverReport;
                    $writer->process($codeCoverage, $arguments['coverageClover']);

                    $this->codeCoverageGenerationSucceeded();

                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->codeCoverageGenerationFailed($e);
                }
            }

            if (isset($arguments['coverageCobertura'])) {
                $this->codeCoverageGenerationStart('Cobertura XML');

                try {
                    $writer = new CoberturaReport;
                    $writer->process($codeCoverage, $arguments['coverageCobertura']);

                    $this->codeCoverageGenerationSucceeded();

                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->codeCoverageGenerationFailed($e);
>>>>>>> update
                }
            }

            if (isset($arguments['coverageCrap4J'])) {
<<<<<<< HEAD
                $this->printer->write(
                    "\nGenerating Crap4J report XML file ..."
                );
=======
                $this->codeCoverageGenerationStart('Crap4J XML');
>>>>>>> update

                try {
                    $writer = new Crap4jReport($arguments['crap4jThreshold']);
                    $writer->process($codeCoverage, $arguments['coverageCrap4J']);

<<<<<<< HEAD
                    $this->printer->write(" done\n");
                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->printer->write(
                        " failed\n" . $e->getMessage() . "\n"
                    );
=======
                    $this->codeCoverageGenerationSucceeded();

                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->codeCoverageGenerationFailed($e);
>>>>>>> update
                }
            }

            if (isset($arguments['coverageHtml'])) {
<<<<<<< HEAD
                $this->printer->write(
                    "\nGenerating code coverage report in HTML format ..."
                );
=======
                $this->codeCoverageGenerationStart('HTML');
>>>>>>> update

                try {
                    $writer = new HtmlReport(
                        $arguments['reportLowUpperBound'],
                        $arguments['reportHighLowerBound'],
                        sprintf(
                            ' and <a href="https://phpunit.de/">PHPUnit %s</a>',
<<<<<<< HEAD
                            PHPUnit_Runner_Version::id()
=======
                            Version::id()
>>>>>>> update
                        )
                    );

                    $writer->process($codeCoverage, $arguments['coverageHtml']);

<<<<<<< HEAD
                    $this->printer->write(" done\n");
                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->printer->write(
                        " failed\n" . $e->getMessage() . "\n"
                    );
=======
                    $this->codeCoverageGenerationSucceeded();

                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->codeCoverageGenerationFailed($e);
>>>>>>> update
                }
            }

            if (isset($arguments['coveragePHP'])) {
<<<<<<< HEAD
                $this->printer->write(
                    "\nGenerating code coverage report in PHP format ..."
                );

                try {
                    $writer = new PhpReport();
                    $writer->process($codeCoverage, $arguments['coveragePHP']);

                    $this->printer->write(" done\n");
                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->printer->write(
                        " failed\n" . $e->getMessage() . "\n"
                    );
=======
                $this->codeCoverageGenerationStart('PHP');

                try {
                    $writer = new PhpReport;
                    $writer->process($codeCoverage, $arguments['coveragePHP']);

                    $this->codeCoverageGenerationSucceeded();

                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->codeCoverageGenerationFailed($e);
>>>>>>> update
                }
            }

            if (isset($arguments['coverageText'])) {
<<<<<<< HEAD
                if ($arguments['coverageText'] == 'php://stdout') {
                    $outputStream = $this->printer;
                    $colors       = $arguments['colors'] && $arguments['colors'] != PHPUnit_TextUI_ResultPrinter::COLOR_NEVER;
                } else {
                    $outputStream = new PHPUnit_Util_Printer($arguments['coverageText']);
=======
                if ($arguments['coverageText'] === 'php://stdout') {
                    $outputStream = $this->printer;
                    $colors       = $arguments['colors'] && $arguments['colors'] !== DefaultResultPrinter::COLOR_NEVER;
                } else {
                    $outputStream = new Printer($arguments['coverageText']);
>>>>>>> update
                    $colors       = false;
                }

                $processor = new TextReport(
                    $arguments['reportLowUpperBound'],
                    $arguments['reportHighLowerBound'],
                    $arguments['coverageTextShowUncoveredFiles'],
                    $arguments['coverageTextShowOnlySummary']
                );

                $outputStream->write(
                    $processor->process($codeCoverage, $colors)
                );
            }

            if (isset($arguments['coverageXml'])) {
<<<<<<< HEAD
                $this->printer->write(
                    "\nGenerating code coverage report in PHPUnit XML format ..."
                );

                try {
                    $writer = new XmlReport;
                    $writer->process($codeCoverage, $arguments['coverageXml']);

                    $this->printer->write(" done\n");
                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->printer->write(
                        " failed\n" . $e->getMessage() . "\n"
                    );
=======
                $this->codeCoverageGenerationStart('PHPUnit XML');

                try {
                    $writer = new XmlReport(Version::id());
                    $writer->process($codeCoverage, $arguments['coverageXml']);

                    $this->codeCoverageGenerationSucceeded();

                    unset($writer);
                } catch (CodeCoverageException $e) {
                    $this->codeCoverageGenerationFailed($e);
>>>>>>> update
                }
            }
        }

        if ($exit) {
<<<<<<< HEAD
            if ($result->wasSuccessful()) {
=======
            if (isset($arguments['failOnEmptyTestSuite']) && $arguments['failOnEmptyTestSuite'] === true && count($result) === 0) {
                exit(self::FAILURE_EXIT);
            }

            if ($result->wasSuccessfulIgnoringWarnings()) {
>>>>>>> update
                if ($arguments['failOnRisky'] && !$result->allHarmless()) {
                    exit(self::FAILURE_EXIT);
                }

                if ($arguments['failOnWarning'] && $result->warningCount() > 0) {
                    exit(self::FAILURE_EXIT);
                }

<<<<<<< HEAD
=======
                if ($arguments['failOnIncomplete'] && $result->notImplementedCount() > 0) {
                    exit(self::FAILURE_EXIT);
                }

                if ($arguments['failOnSkipped'] && $result->skippedCount() > 0) {
                    exit(self::FAILURE_EXIT);
                }

>>>>>>> update
                exit(self::SUCCESS_EXIT);
            }

            if ($result->errorCount() > 0) {
                exit(self::EXCEPTION_EXIT);
            }

            if ($result->failureCount() > 0) {
                exit(self::FAILURE_EXIT);
            }
        }

        return $result;
    }

    /**
<<<<<<< HEAD
     * @param PHPUnit_TextUI_ResultPrinter $resultPrinter
     */
    public function setPrinter(PHPUnit_TextUI_ResultPrinter $resultPrinter)
    {
        $this->printer = $resultPrinter;
=======
     * Returns the loader to be used.
     */
    public function getLoader(): TestSuiteLoader
    {
        if ($this->loader === null) {
            $this->loader = new StandardTestSuiteLoader;
        }

        return $this->loader;
    }

    public function addExtension(Hook $extension): void
    {
        $this->extensions[] = $extension;
>>>>>>> update
    }

    /**
     * Override to define how to handle a failed loading of
     * a test suite.
<<<<<<< HEAD
     *
     * @param string $message
     */
    protected function runFailed($message)
    {
        $this->write($message . PHP_EOL);
        exit(self::FAILURE_EXIT);
    }

    /**
     * @param string $buffer
     *
     * @since Method available since Release 3.1.0
     */
    protected function write($buffer)
    {
        if (PHP_SAPI != 'cli' && PHP_SAPI != 'phpdbg') {
=======
     */
    protected function runFailed(string $message): void
    {
        $this->write($message . PHP_EOL);

        exit(self::FAILURE_EXIT);
    }

    private function createTestResult(): TestResult
    {
        return new TestResult;
    }

    private function write(string $buffer): void
    {
        if (PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg') {
>>>>>>> update
            $buffer = htmlspecialchars($buffer);
        }

        if ($this->printer !== null) {
            $this->printer->write($buffer);
        } else {
            print $buffer;
        }
    }

    /**
<<<<<<< HEAD
     * Returns the loader to be used.
     *
     * @return PHPUnit_Runner_TestSuiteLoader
     *
     * @since Method available since Release 2.2.0
     */
    public function getLoader()
    {
        if ($this->loader === null) {
            $this->loader = new PHPUnit_Runner_StandardTestSuiteLoader;
        }

        return $this->loader;
    }

    /**
     * @param array $arguments
     *
     * @since Method available since Release 3.2.1
     */
    protected function handleConfiguration(array &$arguments)
    {
        if (isset($arguments['configuration']) &&
            !$arguments['configuration'] instanceof PHPUnit_Util_Configuration) {
            $arguments['configuration'] = PHPUnit_Util_Configuration::getInstance(
                $arguments['configuration']
            );
        }

        $arguments['debug']     = isset($arguments['debug'])     ? $arguments['debug']     : false;
        $arguments['filter']    = isset($arguments['filter'])    ? $arguments['filter']    : false;
        $arguments['listeners'] = isset($arguments['listeners']) ? $arguments['listeners'] : [];

        if (isset($arguments['configuration'])) {
            $arguments['configuration']->handlePHPConfiguration();

            $phpunitConfiguration = $arguments['configuration']->getPHPUnitConfiguration();

            if (isset($phpunitConfiguration['deprecatedCheckForUnintentionallyCoveredCodeSettingUsed'])) {
                $arguments['deprecatedCheckForUnintentionallyCoveredCodeSettingUsed'] = true;
            }

            if (isset($phpunitConfiguration['backupGlobals']) &&
                !isset($arguments['backupGlobals'])) {
                $arguments['backupGlobals'] = $phpunitConfiguration['backupGlobals'];
            }

            if (isset($phpunitConfiguration['backupStaticAttributes']) &&
                !isset($arguments['backupStaticAttributes'])) {
                $arguments['backupStaticAttributes'] = $phpunitConfiguration['backupStaticAttributes'];
            }

            if (isset($phpunitConfiguration['beStrictAboutChangesToGlobalState']) &&
                !isset($arguments['beStrictAboutChangesToGlobalState'])) {
                $arguments['beStrictAboutChangesToGlobalState'] = $phpunitConfiguration['beStrictAboutChangesToGlobalState'];
            }

            if (isset($phpunitConfiguration['bootstrap']) &&
                !isset($arguments['bootstrap'])) {
                $arguments['bootstrap'] = $phpunitConfiguration['bootstrap'];
            }

            if (isset($phpunitConfiguration['cacheTokens']) &&
                !isset($arguments['cacheTokens'])) {
                $arguments['cacheTokens'] = $phpunitConfiguration['cacheTokens'];
            }

            if (isset($phpunitConfiguration['colors']) &&
                !isset($arguments['colors'])) {
                $arguments['colors'] = $phpunitConfiguration['colors'];
            }

            if (isset($phpunitConfiguration['convertErrorsToExceptions']) &&
                !isset($arguments['convertErrorsToExceptions'])) {
                $arguments['convertErrorsToExceptions'] = $phpunitConfiguration['convertErrorsToExceptions'];
            }

            if (isset($phpunitConfiguration['convertNoticesToExceptions']) &&
                !isset($arguments['convertNoticesToExceptions'])) {
                $arguments['convertNoticesToExceptions'] = $phpunitConfiguration['convertNoticesToExceptions'];
            }

            if (isset($phpunitConfiguration['convertWarningsToExceptions']) &&
                !isset($arguments['convertWarningsToExceptions'])) {
                $arguments['convertWarningsToExceptions'] = $phpunitConfiguration['convertWarningsToExceptions'];
            }

            if (isset($phpunitConfiguration['processIsolation']) &&
                !isset($arguments['processIsolation'])) {
                $arguments['processIsolation'] = $phpunitConfiguration['processIsolation'];
            }

            if (isset($phpunitConfiguration['stopOnError']) &&
                !isset($arguments['stopOnError'])) {
                $arguments['stopOnError'] = $phpunitConfiguration['stopOnError'];
            }

            if (isset($phpunitConfiguration['stopOnFailure']) &&
                !isset($arguments['stopOnFailure'])) {
                $arguments['stopOnFailure'] = $phpunitConfiguration['stopOnFailure'];
            }

            if (isset($phpunitConfiguration['stopOnWarning']) &&
                !isset($arguments['stopOnWarning'])) {
                $arguments['stopOnWarning'] = $phpunitConfiguration['stopOnWarning'];
            }

            if (isset($phpunitConfiguration['stopOnIncomplete']) &&
                !isset($arguments['stopOnIncomplete'])) {
                $arguments['stopOnIncomplete'] = $phpunitConfiguration['stopOnIncomplete'];
            }

            if (isset($phpunitConfiguration['stopOnRisky']) &&
                !isset($arguments['stopOnRisky'])) {
                $arguments['stopOnRisky'] = $phpunitConfiguration['stopOnRisky'];
            }

            if (isset($phpunitConfiguration['stopOnSkipped']) &&
                !isset($arguments['stopOnSkipped'])) {
                $arguments['stopOnSkipped'] = $phpunitConfiguration['stopOnSkipped'];
            }

            if (isset($phpunitConfiguration['failOnWarning']) &&
                !isset($arguments['failOnWarning'])) {
                $arguments['failOnWarning'] = $phpunitConfiguration['failOnWarning'];
            }

            if (isset($phpunitConfiguration['failOnRisky']) &&
                !isset($arguments['failOnRisky'])) {
                $arguments['failOnRisky'] = $phpunitConfiguration['failOnRisky'];
            }

            if (isset($phpunitConfiguration['timeoutForSmallTests']) &&
                !isset($arguments['timeoutForSmallTests'])) {
                $arguments['timeoutForSmallTests'] = $phpunitConfiguration['timeoutForSmallTests'];
            }

            if (isset($phpunitConfiguration['timeoutForMediumTests']) &&
                !isset($arguments['timeoutForMediumTests'])) {
                $arguments['timeoutForMediumTests'] = $phpunitConfiguration['timeoutForMediumTests'];
            }

            if (isset($phpunitConfiguration['timeoutForLargeTests']) &&
                !isset($arguments['timeoutForLargeTests'])) {
                $arguments['timeoutForLargeTests'] = $phpunitConfiguration['timeoutForLargeTests'];
            }

            if (isset($phpunitConfiguration['reportUselessTests']) &&
                !isset($arguments['reportUselessTests'])) {
                $arguments['reportUselessTests'] = $phpunitConfiguration['reportUselessTests'];
            }

            if (isset($phpunitConfiguration['strictCoverage']) &&
                !isset($arguments['strictCoverage'])) {
                $arguments['strictCoverage'] = $phpunitConfiguration['strictCoverage'];
            }

            if (isset($phpunitConfiguration['disallowTestOutput']) &&
                !isset($arguments['disallowTestOutput'])) {
                $arguments['disallowTestOutput'] = $phpunitConfiguration['disallowTestOutput'];
            }

            if (isset($phpunitConfiguration['enforceTimeLimit']) &&
                !isset($arguments['enforceTimeLimit'])) {
                $arguments['enforceTimeLimit'] = $phpunitConfiguration['enforceTimeLimit'];
            }

            if (isset($phpunitConfiguration['disallowTodoAnnotatedTests']) &&
                !isset($arguments['disallowTodoAnnotatedTests'])) {
                $arguments['disallowTodoAnnotatedTests'] = $phpunitConfiguration['disallowTodoAnnotatedTests'];
            }

            if (isset($phpunitConfiguration['beStrictAboutResourceUsageDuringSmallTests']) &&
                !isset($arguments['beStrictAboutResourceUsageDuringSmallTests'])) {
                $arguments['beStrictAboutResourceUsageDuringSmallTests'] = $phpunitConfiguration['beStrictAboutResourceUsageDuringSmallTests'];
            }

            if (isset($phpunitConfiguration['verbose']) &&
                !isset($arguments['verbose'])) {
                $arguments['verbose'] = $phpunitConfiguration['verbose'];
            }

            if (isset($phpunitConfiguration['reverseDefectList']) &&
                !isset($arguments['reverseList'])) {
                $arguments['reverseList'] = $phpunitConfiguration['reverseDefectList'];
            }

            if (isset($phpunitConfiguration['forceCoversAnnotation']) &&
                !isset($arguments['forceCoversAnnotation'])) {
                $arguments['forceCoversAnnotation'] = $phpunitConfiguration['forceCoversAnnotation'];
            }

            if (isset($phpunitConfiguration['disableCodeCoverageIgnore']) &&
                !isset($arguments['disableCodeCoverageIgnore'])) {
                $arguments['disableCodeCoverageIgnore'] = $phpunitConfiguration['disableCodeCoverageIgnore'];
            }

            if (isset($phpunitConfiguration['registerMockObjectsFromTestArgumentsRecursively']) &&
                !isset($arguments['registerMockObjectsFromTestArgumentsRecursively'])) {
                $arguments['registerMockObjectsFromTestArgumentsRecursively'] = $phpunitConfiguration['registerMockObjectsFromTestArgumentsRecursively'];
=======
     * @throws \PHPUnit\TextUI\XmlConfiguration\Exception
     * @throws Exception
     */
    private function handleConfiguration(array &$arguments): void
    {
        if (!isset($arguments['configurationObject']) && isset($arguments['configuration'])) {
            $arguments['configurationObject'] = (new Loader)->load($arguments['configuration']);
        }

        if (!isset($arguments['warnings'])) {
            $arguments['warnings'] = [];
        }

        $arguments['debug']     = $arguments['debug'] ?? false;
        $arguments['filter']    = $arguments['filter'] ?? false;
        $arguments['listeners'] = $arguments['listeners'] ?? [];

        if (isset($arguments['configurationObject'])) {
            (new PhpHandler)->handle($arguments['configurationObject']->php());

            $codeCoverageConfiguration = $arguments['configurationObject']->codeCoverage();

            if (!isset($arguments['noCoverage'])) {
                if (!isset($arguments['coverageClover']) && $codeCoverageConfiguration->hasClover()) {
                    $arguments['coverageClover'] = $codeCoverageConfiguration->clover()->target()->path();
                }

                if (!isset($arguments['coverageCobertura']) && $codeCoverageConfiguration->hasCobertura()) {
                    $arguments['coverageCobertura'] = $codeCoverageConfiguration->cobertura()->target()->path();
                }

                if (!isset($arguments['coverageCrap4J']) && $codeCoverageConfiguration->hasCrap4j()) {
                    $arguments['coverageCrap4J'] = $codeCoverageConfiguration->crap4j()->target()->path();

                    if (!isset($arguments['crap4jThreshold'])) {
                        $arguments['crap4jThreshold'] = $codeCoverageConfiguration->crap4j()->threshold();
                    }
                }

                if (!isset($arguments['coverageHtml']) && $codeCoverageConfiguration->hasHtml()) {
                    $arguments['coverageHtml'] = $codeCoverageConfiguration->html()->target()->path();

                    if (!isset($arguments['reportLowUpperBound'])) {
                        $arguments['reportLowUpperBound'] = $codeCoverageConfiguration->html()->lowUpperBound();
                    }

                    if (!isset($arguments['reportHighLowerBound'])) {
                        $arguments['reportHighLowerBound'] = $codeCoverageConfiguration->html()->highLowerBound();
                    }
                }

                if (!isset($arguments['coveragePHP']) && $codeCoverageConfiguration->hasPhp()) {
                    $arguments['coveragePHP'] = $codeCoverageConfiguration->php()->target()->path();
                }

                if (!isset($arguments['coverageText']) && $codeCoverageConfiguration->hasText()) {
                    $arguments['coverageText']                   = $codeCoverageConfiguration->text()->target()->path();
                    $arguments['coverageTextShowUncoveredFiles'] = $codeCoverageConfiguration->text()->showUncoveredFiles();
                    $arguments['coverageTextShowOnlySummary']    = $codeCoverageConfiguration->text()->showOnlySummary();
                }

                if (!isset($arguments['coverageXml']) && $codeCoverageConfiguration->hasXml()) {
                    $arguments['coverageXml'] = $codeCoverageConfiguration->xml()->target()->path();
                }
            }

            $phpunitConfiguration = $arguments['configurationObject']->phpunit();

            $arguments['backupGlobals']                                   = $arguments['backupGlobals'] ?? $phpunitConfiguration->backupGlobals();
            $arguments['backupStaticAttributes']                          = $arguments['backupStaticAttributes'] ?? $phpunitConfiguration->backupStaticAttributes();
            $arguments['beStrictAboutChangesToGlobalState']               = $arguments['beStrictAboutChangesToGlobalState'] ?? $phpunitConfiguration->beStrictAboutChangesToGlobalState();
            $arguments['cacheResult']                                     = $arguments['cacheResult'] ?? $phpunitConfiguration->cacheResult();
            $arguments['colors']                                          = $arguments['colors'] ?? $phpunitConfiguration->colors();
            $arguments['convertDeprecationsToExceptions']                 = $arguments['convertDeprecationsToExceptions'] ?? $phpunitConfiguration->convertDeprecationsToExceptions();
            $arguments['convertErrorsToExceptions']                       = $arguments['convertErrorsToExceptions'] ?? $phpunitConfiguration->convertErrorsToExceptions();
            $arguments['convertNoticesToExceptions']                      = $arguments['convertNoticesToExceptions'] ?? $phpunitConfiguration->convertNoticesToExceptions();
            $arguments['convertWarningsToExceptions']                     = $arguments['convertWarningsToExceptions'] ?? $phpunitConfiguration->convertWarningsToExceptions();
            $arguments['processIsolation']                                = $arguments['processIsolation'] ?? $phpunitConfiguration->processIsolation();
            $arguments['stopOnDefect']                                    = $arguments['stopOnDefect'] ?? $phpunitConfiguration->stopOnDefect();
            $arguments['stopOnError']                                     = $arguments['stopOnError'] ?? $phpunitConfiguration->stopOnError();
            $arguments['stopOnFailure']                                   = $arguments['stopOnFailure'] ?? $phpunitConfiguration->stopOnFailure();
            $arguments['stopOnWarning']                                   = $arguments['stopOnWarning'] ?? $phpunitConfiguration->stopOnWarning();
            $arguments['stopOnIncomplete']                                = $arguments['stopOnIncomplete'] ?? $phpunitConfiguration->stopOnIncomplete();
            $arguments['stopOnRisky']                                     = $arguments['stopOnRisky'] ?? $phpunitConfiguration->stopOnRisky();
            $arguments['stopOnSkipped']                                   = $arguments['stopOnSkipped'] ?? $phpunitConfiguration->stopOnSkipped();
            $arguments['failOnEmptyTestSuite']                            = $arguments['failOnEmptyTestSuite'] ?? $phpunitConfiguration->failOnEmptyTestSuite();
            $arguments['failOnIncomplete']                                = $arguments['failOnIncomplete'] ?? $phpunitConfiguration->failOnIncomplete();
            $arguments['failOnRisky']                                     = $arguments['failOnRisky'] ?? $phpunitConfiguration->failOnRisky();
            $arguments['failOnSkipped']                                   = $arguments['failOnSkipped'] ?? $phpunitConfiguration->failOnSkipped();
            $arguments['failOnWarning']                                   = $arguments['failOnWarning'] ?? $phpunitConfiguration->failOnWarning();
            $arguments['enforceTimeLimit']                                = $arguments['enforceTimeLimit'] ?? $phpunitConfiguration->enforceTimeLimit();
            $arguments['defaultTimeLimit']                                = $arguments['defaultTimeLimit'] ?? $phpunitConfiguration->defaultTimeLimit();
            $arguments['timeoutForSmallTests']                            = $arguments['timeoutForSmallTests'] ?? $phpunitConfiguration->timeoutForSmallTests();
            $arguments['timeoutForMediumTests']                           = $arguments['timeoutForMediumTests'] ?? $phpunitConfiguration->timeoutForMediumTests();
            $arguments['timeoutForLargeTests']                            = $arguments['timeoutForLargeTests'] ?? $phpunitConfiguration->timeoutForLargeTests();
            $arguments['reportUselessTests']                              = $arguments['reportUselessTests'] ?? $phpunitConfiguration->beStrictAboutTestsThatDoNotTestAnything();
            $arguments['strictCoverage']                                  = $arguments['strictCoverage'] ?? $phpunitConfiguration->beStrictAboutCoversAnnotation();
            $arguments['ignoreDeprecatedCodeUnitsFromCodeCoverage']       = $arguments['ignoreDeprecatedCodeUnitsFromCodeCoverage'] ?? $codeCoverageConfiguration->ignoreDeprecatedCodeUnits();
            $arguments['disallowTestOutput']                              = $arguments['disallowTestOutput'] ?? $phpunitConfiguration->beStrictAboutOutputDuringTests();
            $arguments['disallowTodoAnnotatedTests']                      = $arguments['disallowTodoAnnotatedTests'] ?? $phpunitConfiguration->beStrictAboutTodoAnnotatedTests();
            $arguments['beStrictAboutResourceUsageDuringSmallTests']      = $arguments['beStrictAboutResourceUsageDuringSmallTests'] ?? $phpunitConfiguration->beStrictAboutResourceUsageDuringSmallTests();
            $arguments['verbose']                                         = $arguments['verbose'] ?? $phpunitConfiguration->verbose();
            $arguments['reverseDefectList']                               = $arguments['reverseDefectList'] ?? $phpunitConfiguration->reverseDefectList();
            $arguments['forceCoversAnnotation']                           = $arguments['forceCoversAnnotation'] ?? $phpunitConfiguration->forceCoversAnnotation();
            $arguments['disableCodeCoverageIgnore']                       = $arguments['disableCodeCoverageIgnore'] ?? $codeCoverageConfiguration->disableCodeCoverageIgnore();
            $arguments['registerMockObjectsFromTestArgumentsRecursively'] = $arguments['registerMockObjectsFromTestArgumentsRecursively'] ?? $phpunitConfiguration->registerMockObjectsFromTestArgumentsRecursively();
            $arguments['noInteraction']                                   = $arguments['noInteraction'] ?? $phpunitConfiguration->noInteraction();
            $arguments['executionOrder']                                  = $arguments['executionOrder'] ?? $phpunitConfiguration->executionOrder();
            $arguments['resolveDependencies']                             = $arguments['resolveDependencies'] ?? $phpunitConfiguration->resolveDependencies();

            if (!isset($arguments['bootstrap']) && $phpunitConfiguration->hasBootstrap()) {
                $arguments['bootstrap'] = $phpunitConfiguration->bootstrap();
            }

            if (!isset($arguments['cacheResultFile']) && $phpunitConfiguration->hasCacheResultFile()) {
                $arguments['cacheResultFile'] = $phpunitConfiguration->cacheResultFile();
            }

            if (!isset($arguments['executionOrderDefects'])) {
                $arguments['executionOrderDefects'] = $phpunitConfiguration->defectsFirst() ? TestSuiteSorter::ORDER_DEFECTS_FIRST : TestSuiteSorter::ORDER_DEFAULT;
            }

            if ($phpunitConfiguration->conflictBetweenPrinterClassAndTestdox()) {
                $arguments['conflictBetweenPrinterClassAndTestdox'] = true;
>>>>>>> update
            }

            $groupCliArgs = [];

            if (!empty($arguments['groups'])) {
                $groupCliArgs = $arguments['groups'];
            }

<<<<<<< HEAD
            $groupConfiguration = $arguments['configuration']->getGroupConfiguration();

            if (!empty($groupConfiguration['include']) &&
                !isset($arguments['groups'])) {
                $arguments['groups'] = $groupConfiguration['include'];
            }

            if (!empty($groupConfiguration['exclude']) &&
                !isset($arguments['excludeGroups'])) {
                $arguments['excludeGroups'] = array_diff($groupConfiguration['exclude'], $groupCliArgs);
            }

            foreach ($arguments['configuration']->getListenerConfiguration() as $listener) {
                if (!class_exists($listener['class'], false) &&
                    $listener['file'] !== '') {
                    require_once $listener['file'];
                }

                if (!class_exists($listener['class'])) {
                    throw new PHPUnit_Framework_Exception(
                        sprintf(
                            'Class "%s" does not exist',
                            $listener['class']
                        )
                    );
                }

                $listenerClass = new ReflectionClass($listener['class']);

                if (!$listenerClass->implementsInterface(PHPUnit_Framework_TestListener::class)) {
                    throw new PHPUnit_Framework_Exception(
                        sprintf(
                            'Class "%s" does not implement the PHPUnit_Framework_TestListener interface',
                            $listener['class']
                        )
                    );
                }

                if (count($listener['arguments']) == 0) {
                    $listener = new $listener['class'];
                } else {
                    $listener = $listenerClass->newInstanceArgs(
                        $listener['arguments']
                    );
                }

                $arguments['listeners'][] = $listener;
            }

            $loggingConfiguration = $arguments['configuration']->getLoggingConfiguration();

            if (isset($loggingConfiguration['coverage-clover']) &&
                !isset($arguments['coverageClover'])) {
                $arguments['coverageClover'] = $loggingConfiguration['coverage-clover'];
            }

            if (isset($loggingConfiguration['coverage-crap4j']) &&
                !isset($arguments['coverageCrap4J'])) {
                $arguments['coverageCrap4J'] = $loggingConfiguration['coverage-crap4j'];

                if (isset($loggingConfiguration['crap4jThreshold']) &&
                    !isset($arguments['crap4jThreshold'])) {
                    $arguments['crap4jThreshold'] = $loggingConfiguration['crap4jThreshold'];
                }
            }

            if (isset($loggingConfiguration['coverage-html']) &&
                !isset($arguments['coverageHtml'])) {
                if (isset($loggingConfiguration['lowUpperBound']) &&
                    !isset($arguments['reportLowUpperBound'])) {
                    $arguments['reportLowUpperBound'] = $loggingConfiguration['lowUpperBound'];
                }

                if (isset($loggingConfiguration['highLowerBound']) &&
                    !isset($arguments['reportHighLowerBound'])) {
                    $arguments['reportHighLowerBound'] = $loggingConfiguration['highLowerBound'];
                }

                $arguments['coverageHtml'] = $loggingConfiguration['coverage-html'];
            }

            if (isset($loggingConfiguration['coverage-php']) &&
                !isset($arguments['coveragePHP'])) {
                $arguments['coveragePHP'] = $loggingConfiguration['coverage-php'];
            }

            if (isset($loggingConfiguration['coverage-text']) &&
                !isset($arguments['coverageText'])) {
                $arguments['coverageText'] = $loggingConfiguration['coverage-text'];
                if (isset($loggingConfiguration['coverageTextShowUncoveredFiles'])) {
                    $arguments['coverageTextShowUncoveredFiles'] = $loggingConfiguration['coverageTextShowUncoveredFiles'];
                } else {
                    $arguments['coverageTextShowUncoveredFiles'] = false;
                }
                if (isset($loggingConfiguration['coverageTextShowOnlySummary'])) {
                    $arguments['coverageTextShowOnlySummary'] = $loggingConfiguration['coverageTextShowOnlySummary'];
                } else {
                    $arguments['coverageTextShowOnlySummary'] = false;
                }
            }

            if (isset($loggingConfiguration['coverage-xml']) &&
                !isset($arguments['coverageXml'])) {
                $arguments['coverageXml'] = $loggingConfiguration['coverage-xml'];
            }

            if (isset($loggingConfiguration['json']) &&
                !isset($arguments['jsonLogfile'])) {
                $arguments['jsonLogfile'] = $loggingConfiguration['json'];
            }

            if (isset($loggingConfiguration['plain'])) {
                $arguments['listeners'][] = new PHPUnit_TextUI_ResultPrinter(
                    $loggingConfiguration['plain'],
                    true
                );
            }

            if (isset($loggingConfiguration['tap']) &&
                !isset($arguments['tapLogfile'])) {
                $arguments['tapLogfile'] = $loggingConfiguration['tap'];
            }

            if (isset($loggingConfiguration['teamcity']) &&
                !isset($arguments['teamcityLogfile'])) {
                $arguments['teamcityLogfile'] = $loggingConfiguration['teamcity'];
            }

            if (isset($loggingConfiguration['junit']) &&
                !isset($arguments['junitLogfile'])) {
                $arguments['junitLogfile'] = $loggingConfiguration['junit'];

                if (isset($loggingConfiguration['logIncompleteSkipped']) &&
                    !isset($arguments['logIncompleteSkipped'])) {
                    $arguments['logIncompleteSkipped'] = $loggingConfiguration['logIncompleteSkipped'];
                }
            }

            if (isset($loggingConfiguration['testdox-html']) &&
                !isset($arguments['testdoxHTMLFile'])) {
                $arguments['testdoxHTMLFile'] = $loggingConfiguration['testdox-html'];
            }

            if (isset($loggingConfiguration['testdox-text']) &&
                !isset($arguments['testdoxTextFile'])) {
                $arguments['testdoxTextFile'] = $loggingConfiguration['testdox-text'];
            }

            if (isset($loggingConfiguration['testdox-xml']) &&
                !isset($arguments['testdoxXMLFile'])) {
                $arguments['testdoxXMLFile'] = $loggingConfiguration['testdox-xml'];
            }

            if ((isset($arguments['coverageClover']) ||
                isset($arguments['coverageCrap4J']) ||
                isset($arguments['coverageHtml']) ||
                isset($arguments['coveragePHP']) ||
                isset($arguments['coverageText']) ||
                isset($arguments['coverageXml'])) &&
                $this->runtime->canCollectCodeCoverage()) {
                $filterConfiguration                             = $arguments['configuration']->getFilterConfiguration();
                $arguments['addUncoveredFilesFromWhitelist']     = $filterConfiguration['whitelist']['addUncoveredFilesFromWhitelist'];
                $arguments['processUncoveredFilesFromWhitelist'] = $filterConfiguration['whitelist']['processUncoveredFilesFromWhitelist'];

                foreach ($filterConfiguration['whitelist']['include']['directory'] as $dir) {
                    $this->codeCoverageFilter->addDirectoryToWhitelist(
                        $dir['path'],
                        $dir['suffix'],
                        $dir['prefix']
                    );
                }

                foreach ($filterConfiguration['whitelist']['include']['file'] as $file) {
                    $this->codeCoverageFilter->addFileToWhitelist($file);
                }

                foreach ($filterConfiguration['whitelist']['exclude']['directory'] as $dir) {
                    $this->codeCoverageFilter->removeDirectoryFromWhitelist(
                        $dir['path'],
                        $dir['suffix'],
                        $dir['prefix']
                    );
                }

                foreach ($filterConfiguration['whitelist']['exclude']['file'] as $file) {
                    $this->codeCoverageFilter->removeFileFromWhitelist($file);
                }
            }
        }

        $arguments['addUncoveredFilesFromWhitelist']                  = isset($arguments['addUncoveredFilesFromWhitelist'])                  ? $arguments['addUncoveredFilesFromWhitelist']                  : true;
        $arguments['processUncoveredFilesFromWhitelist']              = isset($arguments['processUncoveredFilesFromWhitelist'])              ? $arguments['processUncoveredFilesFromWhitelist']              : false;
        $arguments['backupGlobals']                                   = isset($arguments['backupGlobals'])                                   ? $arguments['backupGlobals']                                   : null;
        $arguments['backupStaticAttributes']                          = isset($arguments['backupStaticAttributes'])                          ? $arguments['backupStaticAttributes']                          : null;
        $arguments['beStrictAboutChangesToGlobalState']               = isset($arguments['beStrictAboutChangesToGlobalState'])               ? $arguments['beStrictAboutChangesToGlobalState']               : null;
        $arguments['cacheTokens']                                     = isset($arguments['cacheTokens'])                                     ? $arguments['cacheTokens']                                     : false;
        $arguments['columns']                                         = isset($arguments['columns'])                                         ? $arguments['columns']                                         : 80;
        $arguments['colors']                                          = isset($arguments['colors'])                                          ? $arguments['colors']                                          : PHPUnit_TextUI_ResultPrinter::COLOR_DEFAULT;
        $arguments['convertErrorsToExceptions']                       = isset($arguments['convertErrorsToExceptions'])                       ? $arguments['convertErrorsToExceptions']                       : true;
        $arguments['convertNoticesToExceptions']                      = isset($arguments['convertNoticesToExceptions'])                      ? $arguments['convertNoticesToExceptions']                      : true;
        $arguments['convertWarningsToExceptions']                     = isset($arguments['convertWarningsToExceptions'])                     ? $arguments['convertWarningsToExceptions']                     : true;
        $arguments['excludeGroups']                                   = isset($arguments['excludeGroups'])                                   ? $arguments['excludeGroups']                                   : [];
        $arguments['groups']                                          = isset($arguments['groups'])                                          ? $arguments['groups']                                          : [];
        $arguments['logIncompleteSkipped']                            = isset($arguments['logIncompleteSkipped'])                            ? $arguments['logIncompleteSkipped']                            : false;
        $arguments['processIsolation']                                = isset($arguments['processIsolation'])                                ? $arguments['processIsolation']                                : false;
        $arguments['repeat']                                          = isset($arguments['repeat'])                                          ? $arguments['repeat']                                          : false;
        $arguments['reportHighLowerBound']                            = isset($arguments['reportHighLowerBound'])                            ? $arguments['reportHighLowerBound']                            : 90;
        $arguments['reportLowUpperBound']                             = isset($arguments['reportLowUpperBound'])                             ? $arguments['reportLowUpperBound']                             : 50;
        $arguments['crap4jThreshold']                                 = isset($arguments['crap4jThreshold'])                                 ? $arguments['crap4jThreshold']                                 : 30;
        $arguments['stopOnError']                                     = isset($arguments['stopOnError'])                                     ? $arguments['stopOnError']                                     : false;
        $arguments['stopOnFailure']                                   = isset($arguments['stopOnFailure'])                                   ? $arguments['stopOnFailure']                                   : false;
        $arguments['stopOnWarning']                                   = isset($arguments['stopOnWarning'])                                   ? $arguments['stopOnWarning']                                   : false;
        $arguments['stopOnIncomplete']                                = isset($arguments['stopOnIncomplete'])                                ? $arguments['stopOnIncomplete']                                : false;
        $arguments['stopOnRisky']                                     = isset($arguments['stopOnRisky'])                                     ? $arguments['stopOnRisky']                                     : false;
        $arguments['stopOnSkipped']                                   = isset($arguments['stopOnSkipped'])                                   ? $arguments['stopOnSkipped']                                   : false;
        $arguments['failOnWarning']                                   = isset($arguments['failOnWarning'])                                   ? $arguments['failOnWarning']                                   : false;
        $arguments['failOnRisky']                                     = isset($arguments['failOnRisky'])                                     ? $arguments['failOnRisky']                                     : false;
        $arguments['timeoutForSmallTests']                            = isset($arguments['timeoutForSmallTests'])                            ? $arguments['timeoutForSmallTests']                            : 1;
        $arguments['timeoutForMediumTests']                           = isset($arguments['timeoutForMediumTests'])                           ? $arguments['timeoutForMediumTests']                           : 10;
        $arguments['timeoutForLargeTests']                            = isset($arguments['timeoutForLargeTests'])                            ? $arguments['timeoutForLargeTests']                            : 60;
        $arguments['reportUselessTests']                              = isset($arguments['reportUselessTests'])                              ? $arguments['reportUselessTests']                              : false;
        $arguments['strictCoverage']                                  = isset($arguments['strictCoverage'])                                  ? $arguments['strictCoverage']                                  : false;
        $arguments['disallowTestOutput']                              = isset($arguments['disallowTestOutput'])                              ? $arguments['disallowTestOutput']                              : false;
        $arguments['enforceTimeLimit']                                = isset($arguments['enforceTimeLimit'])                                ? $arguments['enforceTimeLimit']                                : false;
        $arguments['disallowTodoAnnotatedTests']                      = isset($arguments['disallowTodoAnnotatedTests'])                      ? $arguments['disallowTodoAnnotatedTests']                      : false;
        $arguments['beStrictAboutResourceUsageDuringSmallTests']      = isset($arguments['beStrictAboutResourceUsageDuringSmallTests'])      ? $arguments['beStrictAboutResourceUsageDuringSmallTests']      : false;
        $arguments['reverseList']                                     = isset($arguments['reverseList'])                                     ? $arguments['reverseList']                                     : false;
        $arguments['registerMockObjectsFromTestArgumentsRecursively'] = isset($arguments['registerMockObjectsFromTestArgumentsRecursively']) ? $arguments['registerMockObjectsFromTestArgumentsRecursively'] : false;
        $arguments['verbose']                                         = isset($arguments['verbose'])                                         ? $arguments['verbose']                                         : false;
        $arguments['testdoxExcludeGroups']                            = isset($arguments['testdoxExcludeGroups'])                            ? $arguments['testdoxExcludeGroups']                            : [];
        $arguments['testdoxGroups']                                   = isset($arguments['testdoxGroups'])                                   ? $arguments['testdoxGroups']                                   : [];
    }

    /**
     * @param string $type
     * @param string $message
     *
     * @since Method available since Release 5.0.0
     */
    private function writeMessage($type, $message)
=======
            $groupConfiguration = $arguments['configurationObject']->groups();

            if (!isset($arguments['groups']) && $groupConfiguration->hasInclude()) {
                $arguments['groups'] = $groupConfiguration->include()->asArrayOfStrings();
            }

            if (!isset($arguments['excludeGroups']) && $groupConfiguration->hasExclude()) {
                $arguments['excludeGroups'] = array_diff($groupConfiguration->exclude()->asArrayOfStrings(), $groupCliArgs);
            }

            $extensionHandler = new ExtensionHandler;

            foreach ($arguments['configurationObject']->extensions() as $extension) {
                $extensionHandler->registerExtension($extension, $this);
            }

            foreach ($arguments['configurationObject']->listeners() as $listener) {
                $arguments['listeners'][] = $extensionHandler->createTestListenerInstance($listener);
            }

            unset($extensionHandler);

            foreach ($arguments['unavailableExtensions'] as $extension) {
                $arguments['warnings'][] = sprintf(
                    'Extension "%s" is not available',
                    $extension
                );
            }

            $loggingConfiguration = $arguments['configurationObject']->logging();

            if (!isset($arguments['noLogging'])) {
                if ($loggingConfiguration->hasText()) {
                    $arguments['listeners'][] = new DefaultResultPrinter(
                        $loggingConfiguration->text()->target()->path(),
                        true
                    );
                }

                if (!isset($arguments['teamcityLogfile']) && $loggingConfiguration->hasTeamCity()) {
                    $arguments['teamcityLogfile'] = $loggingConfiguration->teamCity()->target()->path();
                }

                if (!isset($arguments['junitLogfile']) && $loggingConfiguration->hasJunit()) {
                    $arguments['junitLogfile'] = $loggingConfiguration->junit()->target()->path();
                }

                if (!isset($arguments['testdoxHTMLFile']) && $loggingConfiguration->hasTestDoxHtml()) {
                    $arguments['testdoxHTMLFile'] = $loggingConfiguration->testDoxHtml()->target()->path();
                }

                if (!isset($arguments['testdoxTextFile']) && $loggingConfiguration->hasTestDoxText()) {
                    $arguments['testdoxTextFile'] = $loggingConfiguration->testDoxText()->target()->path();
                }

                if (!isset($arguments['testdoxXMLFile']) && $loggingConfiguration->hasTestDoxXml()) {
                    $arguments['testdoxXMLFile'] = $loggingConfiguration->testDoxXml()->target()->path();
                }
            }

            $testdoxGroupConfiguration = $arguments['configurationObject']->testdoxGroups();

            if (!isset($arguments['testdoxGroups']) && $testdoxGroupConfiguration->hasInclude()) {
                $arguments['testdoxGroups'] = $testdoxGroupConfiguration->include()->asArrayOfStrings();
            }

            if (!isset($arguments['testdoxExcludeGroups']) && $testdoxGroupConfiguration->hasExclude()) {
                $arguments['testdoxExcludeGroups'] = $testdoxGroupConfiguration->exclude()->asArrayOfStrings();
            }
        }

        $extensionHandler = new ExtensionHandler;

        foreach ($arguments['extensions'] as $extension) {
            $extensionHandler->registerExtension($extension, $this);
        }

        unset($extensionHandler);

        $arguments['backupGlobals']                                   = $arguments['backupGlobals'] ?? null;
        $arguments['backupStaticAttributes']                          = $arguments['backupStaticAttributes'] ?? null;
        $arguments['beStrictAboutChangesToGlobalState']               = $arguments['beStrictAboutChangesToGlobalState'] ?? null;
        $arguments['beStrictAboutResourceUsageDuringSmallTests']      = $arguments['beStrictAboutResourceUsageDuringSmallTests'] ?? false;
        $arguments['cacheResult']                                     = $arguments['cacheResult'] ?? true;
        $arguments['colors']                                          = $arguments['colors'] ?? DefaultResultPrinter::COLOR_DEFAULT;
        $arguments['columns']                                         = $arguments['columns'] ?? 80;
        $arguments['convertDeprecationsToExceptions']                 = $arguments['convertDeprecationsToExceptions'] ?? false;
        $arguments['convertErrorsToExceptions']                       = $arguments['convertErrorsToExceptions'] ?? true;
        $arguments['convertNoticesToExceptions']                      = $arguments['convertNoticesToExceptions'] ?? true;
        $arguments['convertWarningsToExceptions']                     = $arguments['convertWarningsToExceptions'] ?? true;
        $arguments['crap4jThreshold']                                 = $arguments['crap4jThreshold'] ?? 30;
        $arguments['disallowTestOutput']                              = $arguments['disallowTestOutput'] ?? false;
        $arguments['disallowTodoAnnotatedTests']                      = $arguments['disallowTodoAnnotatedTests'] ?? false;
        $arguments['defaultTimeLimit']                                = $arguments['defaultTimeLimit'] ?? 0;
        $arguments['enforceTimeLimit']                                = $arguments['enforceTimeLimit'] ?? false;
        $arguments['excludeGroups']                                   = $arguments['excludeGroups'] ?? [];
        $arguments['executionOrder']                                  = $arguments['executionOrder'] ?? TestSuiteSorter::ORDER_DEFAULT;
        $arguments['executionOrderDefects']                           = $arguments['executionOrderDefects'] ?? TestSuiteSorter::ORDER_DEFAULT;
        $arguments['failOnIncomplete']                                = $arguments['failOnIncomplete'] ?? false;
        $arguments['failOnRisky']                                     = $arguments['failOnRisky'] ?? false;
        $arguments['failOnSkipped']                                   = $arguments['failOnSkipped'] ?? false;
        $arguments['failOnWarning']                                   = $arguments['failOnWarning'] ?? false;
        $arguments['groups']                                          = $arguments['groups'] ?? [];
        $arguments['noInteraction']                                   = $arguments['noInteraction'] ?? false;
        $arguments['processIsolation']                                = $arguments['processIsolation'] ?? false;
        $arguments['randomOrderSeed']                                 = $arguments['randomOrderSeed'] ?? time();
        $arguments['registerMockObjectsFromTestArgumentsRecursively'] = $arguments['registerMockObjectsFromTestArgumentsRecursively'] ?? false;
        $arguments['repeat']                                          = $arguments['repeat'] ?? false;
        $arguments['reportHighLowerBound']                            = $arguments['reportHighLowerBound'] ?? 90;
        $arguments['reportLowUpperBound']                             = $arguments['reportLowUpperBound'] ?? 50;
        $arguments['reportUselessTests']                              = $arguments['reportUselessTests'] ?? true;
        $arguments['reverseList']                                     = $arguments['reverseList'] ?? false;
        $arguments['resolveDependencies']                             = $arguments['resolveDependencies'] ?? true;
        $arguments['stopOnError']                                     = $arguments['stopOnError'] ?? false;
        $arguments['stopOnFailure']                                   = $arguments['stopOnFailure'] ?? false;
        $arguments['stopOnIncomplete']                                = $arguments['stopOnIncomplete'] ?? false;
        $arguments['stopOnRisky']                                     = $arguments['stopOnRisky'] ?? false;
        $arguments['stopOnSkipped']                                   = $arguments['stopOnSkipped'] ?? false;
        $arguments['stopOnWarning']                                   = $arguments['stopOnWarning'] ?? false;
        $arguments['stopOnDefect']                                    = $arguments['stopOnDefect'] ?? false;
        $arguments['strictCoverage']                                  = $arguments['strictCoverage'] ?? false;
        $arguments['testdoxExcludeGroups']                            = $arguments['testdoxExcludeGroups'] ?? [];
        $arguments['testdoxGroups']                                   = $arguments['testdoxGroups'] ?? [];
        $arguments['timeoutForLargeTests']                            = $arguments['timeoutForLargeTests'] ?? 60;
        $arguments['timeoutForMediumTests']                           = $arguments['timeoutForMediumTests'] ?? 10;
        $arguments['timeoutForSmallTests']                            = $arguments['timeoutForSmallTests'] ?? 1;
        $arguments['verbose']                                         = $arguments['verbose'] ?? false;

        if ($arguments['reportLowUpperBound'] > $arguments['reportHighLowerBound']) {
            $arguments['reportLowUpperBound']  = 50;
            $arguments['reportHighLowerBound'] = 90;
        }
    }

    private function processSuiteFilters(TestSuite $suite, array $arguments): void
    {
        if (!$arguments['filter'] &&
            empty($arguments['groups']) &&
            empty($arguments['excludeGroups']) &&
            empty($arguments['testsCovering']) &&
            empty($arguments['testsUsing'])) {
            return;
        }

        $filterFactory = new Factory;

        if (!empty($arguments['excludeGroups'])) {
            $filterFactory->addFilter(
                new ReflectionClass(ExcludeGroupFilterIterator::class),
                $arguments['excludeGroups']
            );
        }

        if (!empty($arguments['groups'])) {
            $filterFactory->addFilter(
                new ReflectionClass(IncludeGroupFilterIterator::class),
                $arguments['groups']
            );
        }

        if (!empty($arguments['testsCovering'])) {
            $filterFactory->addFilter(
                new ReflectionClass(IncludeGroupFilterIterator::class),
                array_map(
                    static function (string $name): string
                    {
                        return '__phpunit_covers_' . $name;
                    },
                    $arguments['testsCovering']
                )
            );
        }

        if (!empty($arguments['testsUsing'])) {
            $filterFactory->addFilter(
                new ReflectionClass(IncludeGroupFilterIterator::class),
                array_map(
                    static function (string $name): string
                    {
                        return '__phpunit_uses_' . $name;
                    },
                    $arguments['testsUsing']
                )
            );
        }

        if ($arguments['filter']) {
            $filterFactory->addFilter(
                new ReflectionClass(NameFilterIterator::class),
                $arguments['filter']
            );
        }

        $suite->injectFilter($filterFactory);
    }

    private function writeMessage(string $type, string $message): void
>>>>>>> update
    {
        if (!$this->messagePrinted) {
            $this->write("\n");
        }

        $this->write(
            sprintf(
                "%-15s%s\n",
                $type . ':',
                $message
            )
        );

        $this->messagePrinted = true;
    }
<<<<<<< HEAD
=======

    private function createPrinter(string $class, array $arguments): ResultPrinter
    {
        $object = new $class(
            (isset($arguments['stderr']) && $arguments['stderr'] === true) ? 'php://stderr' : null,
            $arguments['verbose'],
            $arguments['colors'],
            $arguments['debug'],
            $arguments['columns'],
            $arguments['reverseList']
        );

        assert($object instanceof ResultPrinter);

        return $object;
    }

    private function codeCoverageGenerationStart(string $format): void
    {
        $this->write(
            sprintf(
                "\nGenerating code coverage report in %s format ... ",
                $format
            )
        );

        $this->timer->start();
    }

    private function codeCoverageGenerationSucceeded(): void
    {
        $this->write(
            sprintf(
                "done [%s]\n",
                $this->timer->stop()->asString()
            )
        );
    }

    private function codeCoverageGenerationFailed(\Exception $e): void
    {
        $this->write(
            sprintf(
                "failed [%s]\n%s\n",
                $this->timer->stop()->asString(),
                $e->getMessage()
            )
        );
    }
>>>>>>> update
}
