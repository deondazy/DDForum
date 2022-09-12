<<<<<<< HEAD
<?php
/*
 * This file is part of the php-code-coverage package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

namespace SebastianBergmann\CodeCoverage\Node;

use SebastianBergmann\CodeCoverage\InvalidArgumentException;

/**
 * Represents a file in the code coverage information tree.
 */
class File extends AbstractNode
=======
namespace SebastianBergmann\CodeCoverage\Node;

use function array_filter;
use function count;
use function range;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class File extends AbstractNode
>>>>>>> update
{
    /**
     * @var array
     */
<<<<<<< HEAD
    private $coverageData;
=======
    private $lineCoverageData;

    /**
     * @var array
     */
    private $functionCoverageData;
>>>>>>> update

    /**
     * @var array
     */
    private $testData;

    /**
     * @var int
     */
    private $numExecutableLines = 0;

    /**
     * @var int
     */
    private $numExecutedLines = 0;

    /**
<<<<<<< HEAD
=======
     * @var int
     */
    private $numExecutableBranches = 0;

    /**
     * @var int
     */
    private $numExecutedBranches = 0;

    /**
     * @var int
     */
    private $numExecutablePaths = 0;

    /**
     * @var int
     */
    private $numExecutedPaths = 0;

    /**
>>>>>>> update
     * @var array
     */
    private $classes = [];

    /**
     * @var array
     */
    private $traits = [];

    /**
     * @var array
     */
    private $functions = [];

    /**
<<<<<<< HEAD
     * @var array
     */
    private $linesOfCode = [];
=======
     * @psalm-var array{linesOfCode: int, commentLinesOfCode: int, nonCommentLinesOfCode: int}
     */
    private $linesOfCode;
>>>>>>> update

    /**
     * @var int
     */
<<<<<<< HEAD
    private $numTestedTraits = 0;
=======
    private $numClasses;
>>>>>>> update

    /**
     * @var int
     */
    private $numTestedClasses = 0;

    /**
     * @var int
     */
<<<<<<< HEAD
    private $numMethods = null;
=======
    private $numTraits;
>>>>>>> update

    /**
     * @var int
     */
<<<<<<< HEAD
    private $numTestedMethods = null;
=======
    private $numTestedTraits = 0;
>>>>>>> update

    /**
     * @var int
     */
<<<<<<< HEAD
    private $numTestedFunctions = null;
=======
    private $numMethods;

    /**
     * @var int
     */
    private $numTestedMethods;

    /**
     * @var int
     */
    private $numTestedFunctions;
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $startLines = [];

    /**
     * @var array
     */
    private $endLines = [];

    /**
     * @var bool
     */
    private $cacheTokens;

    /**
     * Constructor.
     *
     * @param string       $name
     * @param AbstractNode $parent
     * @param array        $coverageData
     * @param array        $testData
     * @param bool         $cacheTokens
     *
     * @throws InvalidArgumentException
     */
    public function __construct($name, AbstractNode $parent, array $coverageData, array $testData, $cacheTokens)
    {
        if (!is_bool($cacheTokens)) {
            throw InvalidArgumentException::create(
                1,
                'boolean'
            );
        }

        parent::__construct($name, $parent);

        $this->coverageData = $coverageData;
        $this->testData     = $testData;
        $this->cacheTokens  = $cacheTokens;

        $this->calculateStatistics();
    }

    /**
     * Returns the number of files in/under this node.
     *
     * @return int
     */
    public function count()
=======
    private $codeUnitsByLine = [];

    /**
     * @psalm-param array{linesOfCode: int, commentLinesOfCode: int, nonCommentLinesOfCode: int} $linesOfCode
     */
    public function __construct(string $name, AbstractNode $parent, array $lineCoverageData, array $functionCoverageData, array $testData, array $classes, array $traits, array $functions, array $linesOfCode)
    {
        parent::__construct($name, $parent);

        $this->lineCoverageData     = $lineCoverageData;
        $this->functionCoverageData = $functionCoverageData;
        $this->testData             = $testData;
        $this->linesOfCode          = $linesOfCode;

        $this->calculateStatistics($classes, $traits, $functions);
    }

    public function count(): int
>>>>>>> update
    {
        return 1;
    }

<<<<<<< HEAD
    /**
     * Returns the code coverage data of this node.
     *
     * @return array
     */
    public function getCoverageData()
    {
        return $this->coverageData;
    }

    /**
     * Returns the test data of this node.
     *
     * @return array
     */
    public function getTestData()
=======
    public function lineCoverageData(): array
    {
        return $this->lineCoverageData;
    }

    public function functionCoverageData(): array
    {
        return $this->functionCoverageData;
    }

    public function testData(): array
>>>>>>> update
    {
        return $this->testData;
    }

<<<<<<< HEAD
    /**
     * Returns the classes of this node.
     *
     * @return array
     */
    public function getClasses()
=======
    public function classes(): array
>>>>>>> update
    {
        return $this->classes;
    }

<<<<<<< HEAD
    /**
     * Returns the traits of this node.
     *
     * @return array
     */
    public function getTraits()
=======
    public function traits(): array
>>>>>>> update
    {
        return $this->traits;
    }

<<<<<<< HEAD
    /**
     * Returns the functions of this node.
     *
     * @return array
     */
    public function getFunctions()
=======
    public function functions(): array
>>>>>>> update
    {
        return $this->functions;
    }

    /**
<<<<<<< HEAD
     * Returns the LOC/CLOC/NCLOC of this node.
     *
     * @return array
     */
    public function getLinesOfCode()
=======
     * @psalm-return array{linesOfCode: int, commentLinesOfCode: int, nonCommentLinesOfCode: int}
     */
    public function linesOfCode(): array
>>>>>>> update
    {
        return $this->linesOfCode;
    }

<<<<<<< HEAD
    /**
     * Returns the number of executable lines.
     *
     * @return int
     */
    public function getNumExecutableLines()
=======
    public function numberOfExecutableLines(): int
>>>>>>> update
    {
        return $this->numExecutableLines;
    }

<<<<<<< HEAD
    /**
     * Returns the number of executed lines.
     *
     * @return int
     */
    public function getNumExecutedLines()
=======
    public function numberOfExecutedLines(): int
>>>>>>> update
    {
        return $this->numExecutedLines;
    }

<<<<<<< HEAD
    /**
     * Returns the number of classes.
     *
     * @return int
     */
    public function getNumClasses()
    {
        return count($this->classes);
    }

    /**
     * Returns the number of tested classes.
     *
     * @return int
     */
    public function getNumTestedClasses()
=======
    public function numberOfExecutableBranches(): int
    {
        return $this->numExecutableBranches;
    }

    public function numberOfExecutedBranches(): int
    {
        return $this->numExecutedBranches;
    }

    public function numberOfExecutablePaths(): int
    {
        return $this->numExecutablePaths;
    }

    public function numberOfExecutedPaths(): int
    {
        return $this->numExecutedPaths;
    }

    public function numberOfClasses(): int
    {
        if ($this->numClasses === null) {
            $this->numClasses = 0;

            foreach ($this->classes as $class) {
                foreach ($class['methods'] as $method) {
                    if ($method['executableLines'] > 0) {
                        $this->numClasses++;

                        continue 2;
                    }
                }
            }
        }

        return $this->numClasses;
    }

    public function numberOfTestedClasses(): int
>>>>>>> update
    {
        return $this->numTestedClasses;
    }

<<<<<<< HEAD
    /**
     * Returns the number of traits.
     *
     * @return int
     */
    public function getNumTraits()
    {
        return count($this->traits);
    }

    /**
     * Returns the number of tested traits.
     *
     * @return int
     */
    public function getNumTestedTraits()
=======
    public function numberOfTraits(): int
    {
        if ($this->numTraits === null) {
            $this->numTraits = 0;

            foreach ($this->traits as $trait) {
                foreach ($trait['methods'] as $method) {
                    if ($method['executableLines'] > 0) {
                        $this->numTraits++;

                        continue 2;
                    }
                }
            }
        }

        return $this->numTraits;
    }

    public function numberOfTestedTraits(): int
>>>>>>> update
    {
        return $this->numTestedTraits;
    }

<<<<<<< HEAD
    /**
     * Returns the number of methods.
     *
     * @return int
     */
    public function getNumMethods()
=======
    public function numberOfMethods(): int
>>>>>>> update
    {
        if ($this->numMethods === null) {
            $this->numMethods = 0;

            foreach ($this->classes as $class) {
                foreach ($class['methods'] as $method) {
                    if ($method['executableLines'] > 0) {
                        $this->numMethods++;
                    }
                }
            }

            foreach ($this->traits as $trait) {
                foreach ($trait['methods'] as $method) {
                    if ($method['executableLines'] > 0) {
                        $this->numMethods++;
                    }
                }
            }
        }

        return $this->numMethods;
    }

<<<<<<< HEAD
    /**
     * Returns the number of tested methods.
     *
     * @return int
     */
    public function getNumTestedMethods()
=======
    public function numberOfTestedMethods(): int
>>>>>>> update
    {
        if ($this->numTestedMethods === null) {
            $this->numTestedMethods = 0;

            foreach ($this->classes as $class) {
                foreach ($class['methods'] as $method) {
                    if ($method['executableLines'] > 0 &&
<<<<<<< HEAD
                        $method['coverage'] == 100) {
=======
                        $method['coverage'] === 100) {
>>>>>>> update
                        $this->numTestedMethods++;
                    }
                }
            }

            foreach ($this->traits as $trait) {
                foreach ($trait['methods'] as $method) {
                    if ($method['executableLines'] > 0 &&
<<<<<<< HEAD
                        $method['coverage'] == 100) {
=======
                        $method['coverage'] === 100) {
>>>>>>> update
                        $this->numTestedMethods++;
                    }
                }
            }
        }

        return $this->numTestedMethods;
    }

<<<<<<< HEAD
    /**
     * Returns the number of functions.
     *
     * @return int
     */
    public function getNumFunctions()
=======
    public function numberOfFunctions(): int
>>>>>>> update
    {
        return count($this->functions);
    }

<<<<<<< HEAD
    /**
     * Returns the number of tested functions.
     *
     * @return int
     */
    public function getNumTestedFunctions()
=======
    public function numberOfTestedFunctions(): int
>>>>>>> update
    {
        if ($this->numTestedFunctions === null) {
            $this->numTestedFunctions = 0;

            foreach ($this->functions as $function) {
                if ($function['executableLines'] > 0 &&
<<<<<<< HEAD
                    $function['coverage'] == 100) {
=======
                    $function['coverage'] === 100) {
>>>>>>> update
                    $this->numTestedFunctions++;
                }
            }
        }

        return $this->numTestedFunctions;
    }

<<<<<<< HEAD
    /**
     * Calculates coverage statistics for the file.
     */
    protected function calculateStatistics()
    {
        $classStack = $functionStack = [];

        if ($this->cacheTokens) {
            $tokens = \PHP_Token_Stream_CachingFactory::get($this->getPath());
        } else {
            $tokens = new \PHP_Token_Stream($this->getPath());
        }

        $this->processClasses($tokens);
        $this->processTraits($tokens);
        $this->processFunctions($tokens);
        $this->linesOfCode = $tokens->getLinesOfCode();
        unset($tokens);

        for ($lineNumber = 1; $lineNumber <= $this->linesOfCode['loc']; $lineNumber++) {
            if (isset($this->startLines[$lineNumber])) {
                // Start line of a class.
                if (isset($this->startLines[$lineNumber]['className'])) {
                    if (isset($currentClass)) {
                        $classStack[] = &$currentClass;
                    }

                    $currentClass = &$this->startLines[$lineNumber];
                } // Start line of a trait.
                elseif (isset($this->startLines[$lineNumber]['traitName'])) {
                    $currentTrait = &$this->startLines[$lineNumber];
                } // Start line of a method.
                elseif (isset($this->startLines[$lineNumber]['methodName'])) {
                    $currentMethod = &$this->startLines[$lineNumber];
                } // Start line of a function.
                elseif (isset($this->startLines[$lineNumber]['functionName'])) {
                    if (isset($currentFunction)) {
                        $functionStack[] = &$currentFunction;
                    }

                    $currentFunction = &$this->startLines[$lineNumber];
                }
            }

            if (isset($this->coverageData[$lineNumber])) {
                if (isset($currentClass)) {
                    $currentClass['executableLines']++;
                }

                if (isset($currentTrait)) {
                    $currentTrait['executableLines']++;
                }

                if (isset($currentMethod)) {
                    $currentMethod['executableLines']++;
                }

                if (isset($currentFunction)) {
                    $currentFunction['executableLines']++;
                }

                $this->numExecutableLines++;

                if (count($this->coverageData[$lineNumber]) > 0) {
                    if (isset($currentClass)) {
                        $currentClass['executedLines']++;
                    }

                    if (isset($currentTrait)) {
                        $currentTrait['executedLines']++;
                    }

                    if (isset($currentMethod)) {
                        $currentMethod['executedLines']++;
                    }

                    if (isset($currentFunction)) {
                        $currentFunction['executedLines']++;
                    }
=======
    private function calculateStatistics(array $classes, array $traits, array $functions): void
    {
        foreach (range(1, $this->linesOfCode['linesOfCode']) as $lineNumber) {
            $this->codeUnitsByLine[$lineNumber] = [];
        }

        $this->processClasses($classes);
        $this->processTraits($traits);
        $this->processFunctions($functions);

        foreach (range(1, $this->linesOfCode['linesOfCode']) as $lineNumber) {
            if (isset($this->lineCoverageData[$lineNumber])) {
                foreach ($this->codeUnitsByLine[$lineNumber] as &$codeUnit) {
                    $codeUnit['executableLines']++;
                }

                unset($codeUnit);

                $this->numExecutableLines++;

                if (count($this->lineCoverageData[$lineNumber]) > 0) {
                    foreach ($this->codeUnitsByLine[$lineNumber] as &$codeUnit) {
                        $codeUnit['executedLines']++;
                    }

                    unset($codeUnit);
>>>>>>> update

                    $this->numExecutedLines++;
                }
            }
<<<<<<< HEAD

            if (isset($this->endLines[$lineNumber])) {
                // End line of a class.
                if (isset($this->endLines[$lineNumber]['className'])) {
                    unset($currentClass);

                    if ($classStack) {
                        end($classStack);
                        $key          = key($classStack);
                        $currentClass = &$classStack[$key];
                        unset($classStack[$key]);
                    }
                } // End line of a trait.
                elseif (isset($this->endLines[$lineNumber]['traitName'])) {
                    unset($currentTrait);
                } // End line of a method.
                elseif (isset($this->endLines[$lineNumber]['methodName'])) {
                    unset($currentMethod);
                } // End line of a function.
                elseif (isset($this->endLines[$lineNumber]['functionName'])) {
                    unset($currentFunction);

                    if ($functionStack) {
                        end($functionStack);
                        $key             = key($functionStack);
                        $currentFunction = &$functionStack[$key];
                        unset($functionStack[$key]);
                    }
                }
            }
=======
>>>>>>> update
        }

        foreach ($this->traits as &$trait) {
            foreach ($trait['methods'] as &$method) {
<<<<<<< HEAD
                if ($method['executableLines'] > 0) {
                    $method['coverage'] = ($method['executedLines'] /
                            $method['executableLines']) * 100;
                } else {
                    $method['coverage'] = 100;
                }

                $method['crap'] = $this->crap(
                    $method['ccn'],
                    $method['coverage']
                );
=======
                $methodLineCoverage   = $method['executableLines'] ? ($method['executedLines'] / $method['executableLines']) * 100 : 100;
                $methodBranchCoverage = $method['executableBranches'] ? ($method['executedBranches'] / $method['executableBranches']) * 100 : 0;
                $methodPathCoverage   = $method['executablePaths'] ? ($method['executedPaths'] / $method['executablePaths']) * 100 : 0;

                $method['coverage'] = $methodBranchCoverage ?: $methodLineCoverage;
                $method['crap']     = (new CrapIndex($method['ccn'], $methodPathCoverage ?: $methodLineCoverage))->asString();
>>>>>>> update

                $trait['ccn'] += $method['ccn'];
            }

<<<<<<< HEAD
            if ($trait['executableLines'] > 0) {
                $trait['coverage'] = ($trait['executedLines'] /
                        $trait['executableLines']) * 100;
            } else {
                $trait['coverage'] = 100;
            }

            if ($trait['coverage'] == 100) {
                $this->numTestedClasses++;
            }

            $trait['crap'] = $this->crap(
                $trait['ccn'],
                $trait['coverage']
            );
        }

        foreach ($this->classes as &$class) {
            foreach ($class['methods'] as &$method) {
                if ($method['executableLines'] > 0) {
                    $method['coverage'] = ($method['executedLines'] /
                            $method['executableLines']) * 100;
                } else {
                    $method['coverage'] = 100;
                }

                $method['crap'] = $this->crap(
                    $method['ccn'],
                    $method['coverage']
                );
=======
            unset($method);

            $traitLineCoverage   = $trait['executableLines'] ? ($trait['executedLines'] / $trait['executableLines']) * 100 : 100;
            $traitBranchCoverage = $trait['executableBranches'] ? ($trait['executedBranches'] / $trait['executableBranches']) * 100 : 0;
            $traitPathCoverage   = $trait['executablePaths'] ? ($trait['executedPaths'] / $trait['executablePaths']) * 100 : 0;

            $trait['coverage'] = $traitBranchCoverage ?: $traitLineCoverage;
            $trait['crap']     = (new CrapIndex($trait['ccn'], $traitPathCoverage ?: $traitLineCoverage))->asString();

            if ($trait['executableLines'] > 0 && $trait['coverage'] === 100) {
                $this->numTestedClasses++;
            }
        }

        unset($trait);

        foreach ($this->classes as &$class) {
            foreach ($class['methods'] as &$method) {
                $methodLineCoverage   = $method['executableLines'] ? ($method['executedLines'] / $method['executableLines']) * 100 : 100;
                $methodBranchCoverage = $method['executableBranches'] ? ($method['executedBranches'] / $method['executableBranches']) * 100 : 0;
                $methodPathCoverage   = $method['executablePaths'] ? ($method['executedPaths'] / $method['executablePaths']) * 100 : 0;

                $method['coverage'] = $methodBranchCoverage ?: $methodLineCoverage;
                $method['crap']     = (new CrapIndex($method['ccn'], $methodPathCoverage ?: $methodLineCoverage))->asString();
>>>>>>> update

                $class['ccn'] += $method['ccn'];
            }

<<<<<<< HEAD
            if ($class['executableLines'] > 0) {
                $class['coverage'] = ($class['executedLines'] /
                        $class['executableLines']) * 100;
            } else {
                $class['coverage'] = 100;
            }

            if ($class['coverage'] == 100) {
                $this->numTestedClasses++;
            }

            $class['crap'] = $this->crap(
                $class['ccn'],
                $class['coverage']
            );
        }
    }

    /**
     * @param \PHP_Token_Stream $tokens
     */
    protected function processClasses(\PHP_Token_Stream $tokens)
    {
        $classes = $tokens->getClasses();
        unset($tokens);

        $link = $this->getId() . '.html#';

        foreach ($classes as $className => $class) {
            $this->classes[$className] = [
                'className'       => $className,
                'methods'         => [],
                'startLine'       => $class['startLine'],
                'executableLines' => 0,
                'executedLines'   => 0,
                'ccn'             => 0,
                'coverage'        => 0,
                'crap'            => 0,
                'package'         => $class['package'],
                'link'            => $link . $class['startLine']
            ];

            $this->startLines[$class['startLine']] = &$this->classes[$className];
            $this->endLines[$class['endLine']]     = &$this->classes[$className];

            foreach ($class['methods'] as $methodName => $method) {
                $this->classes[$className]['methods'][$methodName] = $this->newMethod($methodName, $method, $link);

                $this->startLines[$method['startLine']] = &$this->classes[$className]['methods'][$methodName];
                $this->endLines[$method['endLine']]     = &$this->classes[$className]['methods'][$methodName];
=======
            unset($method);

            $classLineCoverage   = $class['executableLines'] ? ($class['executedLines'] / $class['executableLines']) * 100 : 100;
            $classBranchCoverage = $class['executableBranches'] ? ($class['executedBranches'] / $class['executableBranches']) * 100 : 0;
            $classPathCoverage   = $class['executablePaths'] ? ($class['executedPaths'] / $class['executablePaths']) * 100 : 0;

            $class['coverage'] = $classBranchCoverage ?: $classLineCoverage;
            $class['crap']     = (new CrapIndex($class['ccn'], $classPathCoverage ?: $classLineCoverage))->asString();

            if ($class['executableLines'] > 0 && $class['coverage'] === 100) {
                $this->numTestedClasses++;
            }
        }

        unset($class);

        foreach ($this->functions as &$function) {
            $functionLineCoverage   = $function['executableLines'] ? ($function['executedLines'] / $function['executableLines']) * 100 : 100;
            $functionBranchCoverage = $function['executableBranches'] ? ($function['executedBranches'] / $function['executableBranches']) * 100 : 0;
            $functionPathCoverage   = $function['executablePaths'] ? ($function['executedPaths'] / $function['executablePaths']) * 100 : 0;

            $function['coverage'] = $functionBranchCoverage ?: $functionLineCoverage;
            $function['crap']     = (new CrapIndex($function['ccn'], $functionPathCoverage ?: $functionLineCoverage))->asString();

            if ($function['coverage'] === 100) {
                $this->numTestedFunctions++;
            }
        }
    }

    private function processClasses(array $classes): void
    {
        $link = $this->id() . '.html#';

        foreach ($classes as $className => $class) {
            $this->classes[$className] = [
                'className'          => $className,
                'namespace'          => $class['namespace'],
                'methods'            => [],
                'startLine'          => $class['startLine'],
                'executableLines'    => 0,
                'executedLines'      => 0,
                'executableBranches' => 0,
                'executedBranches'   => 0,
                'executablePaths'    => 0,
                'executedPaths'      => 0,
                'ccn'                => 0,
                'coverage'           => 0,
                'crap'               => 0,
                'link'               => $link . $class['startLine'],
            ];

            foreach ($class['methods'] as $methodName => $method) {
                $methodData                                        = $this->newMethod($className, $methodName, $method, $link);
                $this->classes[$className]['methods'][$methodName] = $methodData;

                $this->classes[$className]['executableBranches'] += $methodData['executableBranches'];
                $this->classes[$className]['executedBranches'] += $methodData['executedBranches'];
                $this->classes[$className]['executablePaths'] += $methodData['executablePaths'];
                $this->classes[$className]['executedPaths'] += $methodData['executedPaths'];

                $this->numExecutableBranches += $methodData['executableBranches'];
                $this->numExecutedBranches += $methodData['executedBranches'];
                $this->numExecutablePaths += $methodData['executablePaths'];
                $this->numExecutedPaths += $methodData['executedPaths'];

                foreach (range($method['startLine'], $method['endLine']) as $lineNumber) {
                    $this->codeUnitsByLine[$lineNumber] = [
                        &$this->classes[$className],
                        &$this->classes[$className]['methods'][$methodName],
                    ];
                }
>>>>>>> update
            }
        }
    }

<<<<<<< HEAD
    /**
     * @param \PHP_Token_Stream $tokens
     */
    protected function processTraits(\PHP_Token_Stream $tokens)
    {
        $traits = $tokens->getTraits();
        unset($tokens);

        $link = $this->getId() . '.html#';

        foreach ($traits as $traitName => $trait) {
            $this->traits[$traitName] = [
                'traitName'       => $traitName,
                'methods'         => [],
                'startLine'       => $trait['startLine'],
                'executableLines' => 0,
                'executedLines'   => 0,
                'ccn'             => 0,
                'coverage'        => 0,
                'crap'            => 0,
                'package'         => $trait['package'],
                'link'            => $link . $trait['startLine']
            ];

            $this->startLines[$trait['startLine']] = &$this->traits[$traitName];
            $this->endLines[$trait['endLine']]     = &$this->traits[$traitName];

            foreach ($trait['methods'] as $methodName => $method) {
                $this->traits[$traitName]['methods'][$methodName] = $this->newMethod($methodName, $method, $link);

                $this->startLines[$method['startLine']] = &$this->traits[$traitName]['methods'][$methodName];
                $this->endLines[$method['endLine']]     = &$this->traits[$traitName]['methods'][$methodName];
=======
    private function processTraits(array $traits): void
    {
        $link = $this->id() . '.html#';

        foreach ($traits as $traitName => $trait) {
            $this->traits[$traitName] = [
                'traitName'          => $traitName,
                'namespace'          => $trait['namespace'],
                'methods'            => [],
                'startLine'          => $trait['startLine'],
                'executableLines'    => 0,
                'executedLines'      => 0,
                'executableBranches' => 0,
                'executedBranches'   => 0,
                'executablePaths'    => 0,
                'executedPaths'      => 0,
                'ccn'                => 0,
                'coverage'           => 0,
                'crap'               => 0,
                'link'               => $link . $trait['startLine'],
            ];

            foreach ($trait['methods'] as $methodName => $method) {
                $methodData                                       = $this->newMethod($traitName, $methodName, $method, $link);
                $this->traits[$traitName]['methods'][$methodName] = $methodData;

                $this->traits[$traitName]['executableBranches'] += $methodData['executableBranches'];
                $this->traits[$traitName]['executedBranches'] += $methodData['executedBranches'];
                $this->traits[$traitName]['executablePaths'] += $methodData['executablePaths'];
                $this->traits[$traitName]['executedPaths'] += $methodData['executedPaths'];

                $this->numExecutableBranches += $methodData['executableBranches'];
                $this->numExecutedBranches += $methodData['executedBranches'];
                $this->numExecutablePaths += $methodData['executablePaths'];
                $this->numExecutedPaths += $methodData['executedPaths'];

                foreach (range($method['startLine'], $method['endLine']) as $lineNumber) {
                    $this->codeUnitsByLine[$lineNumber] = [
                        &$this->traits[$traitName],
                        &$this->traits[$traitName]['methods'][$methodName],
                    ];
                }
>>>>>>> update
            }
        }
    }

<<<<<<< HEAD
    /**
     * @param \PHP_Token_Stream $tokens
     */
    protected function processFunctions(\PHP_Token_Stream $tokens)
    {
        $functions = $tokens->getFunctions();
        unset($tokens);

        $link = $this->getId() . '.html#';

        foreach ($functions as $functionName => $function) {
            $this->functions[$functionName] = [
                'functionName'    => $functionName,
                'signature'       => $function['signature'],
                'startLine'       => $function['startLine'],
                'executableLines' => 0,
                'executedLines'   => 0,
                'ccn'             => $function['ccn'],
                'coverage'        => 0,
                'crap'            => 0,
                'link'            => $link . $function['startLine']
            ];

            $this->startLines[$function['startLine']] = &$this->functions[$functionName];
            $this->endLines[$function['endLine']]     = &$this->functions[$functionName];
        }
    }

    /**
     * Calculates the Change Risk Anti-Patterns (CRAP) index for a unit of code
     * based on its cyclomatic complexity and percentage of code coverage.
     *
     * @param int   $ccn
     * @param float $coverage
     *
     * @return string
     */
    protected function crap($ccn, $coverage)
    {
        if ($coverage == 0) {
            return (string) (pow($ccn, 2) + $ccn);
        }

        if ($coverage >= 95) {
            return (string) $ccn;
        }

        return sprintf(
            '%01.2F',
            pow($ccn, 2) * pow(1 - $coverage/100, 3) + $ccn
        );
    }

    /**
     * @param string $methodName
     * @param array  $method
     * @param string $link
     *
     * @return array
     */
    private function newMethod($methodName, array $method, $link)
    {
        return [
            'methodName'      => $methodName,
            'visibility'      => $method['visibility'],
            'signature'       => $method['signature'],
            'startLine'       => $method['startLine'],
            'endLine'         => $method['endLine'],
            'executableLines' => 0,
            'executedLines'   => 0,
            'ccn'             => $method['ccn'],
            'coverage'        => 0,
            'crap'            => 0,
            'link'            => $link . $method['startLine'],
        ];
=======
    private function processFunctions(array $functions): void
    {
        $link = $this->id() . '.html#';

        foreach ($functions as $functionName => $function) {
            $this->functions[$functionName] = [
                'functionName'       => $functionName,
                'namespace'          => $function['namespace'],
                'signature'          => $function['signature'],
                'startLine'          => $function['startLine'],
                'endLine'            => $function['endLine'],
                'executableLines'    => 0,
                'executedLines'      => 0,
                'executableBranches' => 0,
                'executedBranches'   => 0,
                'executablePaths'    => 0,
                'executedPaths'      => 0,
                'ccn'                => $function['ccn'],
                'coverage'           => 0,
                'crap'               => 0,
                'link'               => $link . $function['startLine'],
            ];

            foreach (range($function['startLine'], $function['endLine']) as $lineNumber) {
                $this->codeUnitsByLine[$lineNumber] = [&$this->functions[$functionName]];
            }

            if (isset($this->functionCoverageData[$functionName]['branches'])) {
                $this->functions[$functionName]['executableBranches'] = count(
                    $this->functionCoverageData[$functionName]['branches']
                );

                $this->functions[$functionName]['executedBranches'] = count(
                    array_filter(
                        $this->functionCoverageData[$functionName]['branches'],
                        static function (array $branch)
                        {
                            return (bool) $branch['hit'];
                        }
                    )
                );
            }

            if (isset($this->functionCoverageData[$functionName]['paths'])) {
                $this->functions[$functionName]['executablePaths'] = count(
                    $this->functionCoverageData[$functionName]['paths']
                );

                $this->functions[$functionName]['executedPaths'] = count(
                    array_filter(
                        $this->functionCoverageData[$functionName]['paths'],
                        static function (array $path)
                        {
                            return (bool) $path['hit'];
                        }
                    )
                );
            }

            $this->numExecutableBranches += $this->functions[$functionName]['executableBranches'];
            $this->numExecutedBranches += $this->functions[$functionName]['executedBranches'];
            $this->numExecutablePaths += $this->functions[$functionName]['executablePaths'];
            $this->numExecutedPaths += $this->functions[$functionName]['executedPaths'];
        }
    }

    private function newMethod(string $className, string $methodName, array $method, string $link): array
    {
        $methodData = [
            'methodName'         => $methodName,
            'visibility'         => $method['visibility'],
            'signature'          => $method['signature'],
            'startLine'          => $method['startLine'],
            'endLine'            => $method['endLine'],
            'executableLines'    => 0,
            'executedLines'      => 0,
            'executableBranches' => 0,
            'executedBranches'   => 0,
            'executablePaths'    => 0,
            'executedPaths'      => 0,
            'ccn'                => $method['ccn'],
            'coverage'           => 0,
            'crap'               => 0,
            'link'               => $link . $method['startLine'],
        ];

        $key = $className . '->' . $methodName;

        if (isset($this->functionCoverageData[$key]['branches'])) {
            $methodData['executableBranches'] = count(
                $this->functionCoverageData[$key]['branches']
            );

            $methodData['executedBranches'] = count(
                array_filter(
                    $this->functionCoverageData[$key]['branches'],
                    static function (array $branch)
                    {
                        return (bool) $branch['hit'];
                    }
                )
            );
        }

        if (isset($this->functionCoverageData[$key]['paths'])) {
            $methodData['executablePaths'] = count(
                $this->functionCoverageData[$key]['paths']
            );

            $methodData['executedPaths'] = count(
                array_filter(
                    $this->functionCoverageData[$key]['paths'],
                    static function (array $path)
                    {
                        return (bool) $path['hit'];
                    }
                )
            );
        }

        return $methodData;
>>>>>>> update
    }
}
