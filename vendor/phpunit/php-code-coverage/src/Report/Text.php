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

namespace SebastianBergmann\CodeCoverage\Report;

use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Node\File;
use SebastianBergmann\CodeCoverage\Util;

/**
 * Generates human readable output from a code coverage object.
 *
 * The output gets put into a text file our written to the CLI.
 */
class Text
{
    private $lowUpperBound;
    private $highLowerBound;
    private $showUncoveredFiles;
    private $showOnlySummary;

    private $colors = [
        'green'  => "\x1b[30;42m",
        'yellow' => "\x1b[30;43m",
        'red'    => "\x1b[37;41m",
        'header' => "\x1b[1;37;40m",
        'reset'  => "\x1b[0m",
        'eol'    => "\x1b[2K",
    ];

    /**
     * @param int  $lowUpperBound
     * @param int  $highLowerBound
     * @param bool $showUncoveredFiles
     * @param bool $showOnlySummary
     */
    public function __construct($lowUpperBound = 50, $highLowerBound = 90, $showUncoveredFiles = false, $showOnlySummary = false)
=======
namespace SebastianBergmann\CodeCoverage\Report;

use const PHP_EOL;
use function array_map;
use function date;
use function ksort;
use function max;
use function sprintf;
use function str_pad;
use function strlen;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Node\File;
use SebastianBergmann\CodeCoverage\Util\Percentage;

final class Text
{
    /**
     * @var string
     */
    private const COLOR_GREEN = "\x1b[30;42m";

    /**
     * @var string
     */
    private const COLOR_YELLOW = "\x1b[30;43m";

    /**
     * @var string
     */
    private const COLOR_RED = "\x1b[37;41m";

    /**
     * @var string
     */
    private const COLOR_HEADER = "\x1b[1;37;40m";

    /**
     * @var string
     */
    private const COLOR_RESET = "\x1b[0m";

    /**
     * @var string
     */
    private const COLOR_EOL = "\x1b[2K";

    /**
     * @var int
     */
    private $lowUpperBound;

    /**
     * @var int
     */
    private $highLowerBound;

    /**
     * @var bool
     */
    private $showUncoveredFiles;

    /**
     * @var bool
     */
    private $showOnlySummary;

    public function __construct(int $lowUpperBound = 50, int $highLowerBound = 90, bool $showUncoveredFiles = false, bool $showOnlySummary = false)
>>>>>>> update
    {
        $this->lowUpperBound      = $lowUpperBound;
        $this->highLowerBound     = $highLowerBound;
        $this->showUncoveredFiles = $showUncoveredFiles;
        $this->showOnlySummary    = $showOnlySummary;
    }

<<<<<<< HEAD
    /**
     * @param CodeCoverage $coverage
     * @param bool         $showColors
     *
     * @return string
     */
    public function process(CodeCoverage $coverage, $showColors = false)
    {
        $output = PHP_EOL . PHP_EOL;
        $report = $coverage->getReport();
        unset($coverage);

        $colors = [
            'header'  => '',
            'classes' => '',
            'methods' => '',
            'lines'   => '',
            'reset'   => '',
            'eol'     => ''
        ];

        if ($showColors) {
            $colors['classes'] = $this->getCoverageColor(
                $report->getNumTestedClassesAndTraits(),
                $report->getNumClassesAndTraits()
            );
            $colors['methods'] = $this->getCoverageColor(
                $report->getNumTestedMethods(),
                $report->getNumMethods()
            );
            $colors['lines']   = $this->getCoverageColor(
                $report->getNumExecutedLines(),
                $report->getNumExecutableLines()
            );
            $colors['reset']   = $this->colors['reset'];
            $colors['header']  = $this->colors['header'];
            $colors['eol']     = $this->colors['eol'];
=======
    public function process(CodeCoverage $coverage, bool $showColors = false): string
    {
        $hasBranchCoverage = !empty($coverage->getData(true)->functionCoverage());

        $output = PHP_EOL . PHP_EOL;
        $report = $coverage->getReport();

        $colors = [
            'header'   => '',
            'classes'  => '',
            'methods'  => '',
            'lines'    => '',
            'branches' => '',
            'paths'    => '',
            'reset'    => '',
            'eol'      => '',
        ];

        if ($showColors) {
            $colors['classes'] = $this->coverageColor(
                $report->numberOfTestedClassesAndTraits(),
                $report->numberOfClassesAndTraits()
            );

            $colors['methods'] = $this->coverageColor(
                $report->numberOfTestedMethods(),
                $report->numberOfMethods()
            );

            $colors['lines'] = $this->coverageColor(
                $report->numberOfExecutedLines(),
                $report->numberOfExecutableLines()
            );

            $colors['branches'] = $this->coverageColor(
                $report->numberOfExecutedBranches(),
                $report->numberOfExecutableBranches()
            );

            $colors['paths'] = $this->coverageColor(
                $report->numberOfExecutedPaths(),
                $report->numberOfExecutablePaths()
            );

            $colors['reset']  = self::COLOR_RESET;
            $colors['header'] = self::COLOR_HEADER;
            $colors['eol']    = self::COLOR_EOL;
>>>>>>> update
        }

        $classes = sprintf(
            '  Classes: %6s (%d/%d)',
<<<<<<< HEAD
            Util::percent(
                $report->getNumTestedClassesAndTraits(),
                $report->getNumClassesAndTraits(),
                true
            ),
            $report->getNumTestedClassesAndTraits(),
            $report->getNumClassesAndTraits()
=======
            Percentage::fromFractionAndTotal(
                $report->numberOfTestedClassesAndTraits(),
                $report->numberOfClassesAndTraits()
            )->asString(),
            $report->numberOfTestedClassesAndTraits(),
            $report->numberOfClassesAndTraits()
>>>>>>> update
        );

        $methods = sprintf(
            '  Methods: %6s (%d/%d)',
<<<<<<< HEAD
            Util::percent(
                $report->getNumTestedMethods(),
                $report->getNumMethods(),
                true
            ),
            $report->getNumTestedMethods(),
            $report->getNumMethods()
        );

        $lines = sprintf(
            '  Lines:   %6s (%d/%d)',
            Util::percent(
                $report->getNumExecutedLines(),
                $report->getNumExecutableLines(),
                true
            ),
            $report->getNumExecutedLines(),
            $report->getNumExecutableLines()
=======
            Percentage::fromFractionAndTotal(
                $report->numberOfTestedMethods(),
                $report->numberOfMethods(),
            )->asString(),
            $report->numberOfTestedMethods(),
            $report->numberOfMethods()
        );

        $paths    = '';
        $branches = '';

        if ($hasBranchCoverage) {
            $paths = sprintf(
                '  Paths:   %6s (%d/%d)',
                Percentage::fromFractionAndTotal(
                    $report->numberOfExecutedPaths(),
                    $report->numberOfExecutablePaths(),
                )->asString(),
                $report->numberOfExecutedPaths(),
                $report->numberOfExecutablePaths()
            );

            $branches = sprintf(
                '  Branches:   %6s (%d/%d)',
                Percentage::fromFractionAndTotal(
                    $report->numberOfExecutedBranches(),
                    $report->numberOfExecutableBranches(),
                )->asString(),
                $report->numberOfExecutedBranches(),
                $report->numberOfExecutableBranches()
            );
        }

        $lines = sprintf(
            '  Lines:   %6s (%d/%d)',
            Percentage::fromFractionAndTotal(
                $report->numberOfExecutedLines(),
                $report->numberOfExecutableLines(),
            )->asString(),
            $report->numberOfExecutedLines(),
            $report->numberOfExecutableLines()
>>>>>>> update
        );

        $padding = max(array_map('strlen', [$classes, $methods, $lines]));

        if ($this->showOnlySummary) {
            $title   = 'Code Coverage Report Summary:';
            $padding = max($padding, strlen($title));

            $output .= $this->format($colors['header'], $padding, $title);
        } else {
<<<<<<< HEAD
            $date  = date('  Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
=======
            $date  = date('  Y-m-d H:i:s');
>>>>>>> update
            $title = 'Code Coverage Report:';

            $output .= $this->format($colors['header'], $padding, $title);
            $output .= $this->format($colors['header'], $padding, $date);
            $output .= $this->format($colors['header'], $padding, '');
            $output .= $this->format($colors['header'], $padding, ' Summary:');
        }

        $output .= $this->format($colors['classes'], $padding, $classes);
        $output .= $this->format($colors['methods'], $padding, $methods);
<<<<<<< HEAD
=======

        if ($hasBranchCoverage) {
            $output .= $this->format($colors['paths'], $padding, $paths);
            $output .= $this->format($colors['branches'], $padding, $branches);
        }
>>>>>>> update
        $output .= $this->format($colors['lines'], $padding, $lines);

        if ($this->showOnlySummary) {
            return $output . PHP_EOL;
        }

        $classCoverage = [];

        foreach ($report as $item) {
            if (!$item instanceof File) {
                continue;
            }

<<<<<<< HEAD
            $classes = $item->getClassesAndTraits();

            foreach ($classes as $className => $class) {
                $classStatements        = 0;
                $coveredClassStatements = 0;
                $coveredMethods         = 0;
                $classMethods           = 0;
=======
            $classes = $item->classesAndTraits();

            foreach ($classes as $className => $class) {
                $classExecutableLines    = 0;
                $classExecutedLines      = 0;
                $classExecutableBranches = 0;
                $classExecutedBranches   = 0;
                $classExecutablePaths    = 0;
                $classExecutedPaths      = 0;
                $coveredMethods          = 0;
                $classMethods            = 0;
>>>>>>> update

                foreach ($class['methods'] as $method) {
                    if ($method['executableLines'] == 0) {
                        continue;
                    }

                    $classMethods++;
<<<<<<< HEAD
                    $classStatements        += $method['executableLines'];
                    $coveredClassStatements += $method['executedLines'];
=======
                    $classExecutableLines += $method['executableLines'];
                    $classExecutedLines += $method['executedLines'];
                    $classExecutableBranches += $method['executableBranches'];
                    $classExecutedBranches += $method['executedBranches'];
                    $classExecutablePaths += $method['executablePaths'];
                    $classExecutedPaths += $method['executedPaths'];

>>>>>>> update
                    if ($method['coverage'] == 100) {
                        $coveredMethods++;
                    }
                }

<<<<<<< HEAD
                if (!empty($class['package']['namespace'])) {
                    $namespace = '\\' . $class['package']['namespace'] . '::';
                } elseif (!empty($class['package']['fullPackage'])) {
                    $namespace = '@' . $class['package']['fullPackage'] . '::';
                } else {
                    $namespace = '';
                }

                $classCoverage[$namespace . $className] = [
                    'namespace'         => $namespace,
                    'className '        => $className,
                    'methodsCovered'    => $coveredMethods,
                    'methodCount'       => $classMethods,
                    'statementsCovered' => $coveredClassStatements,
                    'statementCount'    => $classStatements,
=======
                $classCoverage[$className] = [
                    'namespace'         => $class['namespace'],
                    'className'         => $className,
                    'methodsCovered'    => $coveredMethods,
                    'methodCount'       => $classMethods,
                    'statementsCovered' => $classExecutedLines,
                    'statementCount'    => $classExecutableLines,
                    'branchesCovered'   => $classExecutedBranches,
                    'branchesCount'     => $classExecutableBranches,
                    'pathsCovered'      => $classExecutedPaths,
                    'pathsCount'        => $classExecutablePaths,
>>>>>>> update
                ];
            }
        }

        ksort($classCoverage);

<<<<<<< HEAD
        $methodColor = '';
        $linesColor  = '';
        $resetColor  = '';

        foreach ($classCoverage as $fullQualifiedPath => $classInfo) {
            if ($classInfo['statementsCovered'] != 0 ||
                $this->showUncoveredFiles) {
                if ($showColors) {
                    $methodColor = $this->getCoverageColor($classInfo['methodsCovered'], $classInfo['methodCount']);
                    $linesColor  = $this->getCoverageColor($classInfo['statementsCovered'], $classInfo['statementCount']);
                    $resetColor  = $colors['reset'];
                }

                $output .= PHP_EOL . $fullQualifiedPath . PHP_EOL
                    . '  ' . $methodColor . 'Methods: ' . $this->printCoverageCounts($classInfo['methodsCovered'], $classInfo['methodCount'], 2) . $resetColor . ' '
                    . '  ' . $linesColor . 'Lines: ' . $this->printCoverageCounts($classInfo['statementsCovered'], $classInfo['statementCount'], 3) . $resetColor
                ;
=======
        $methodColor   = '';
        $pathsColor    = '';
        $branchesColor = '';
        $linesColor    = '';
        $resetColor    = '';

        foreach ($classCoverage as $fullQualifiedPath => $classInfo) {
            if ($this->showUncoveredFiles || $classInfo['statementsCovered'] != 0) {
                if ($showColors) {
                    $methodColor   = $this->coverageColor($classInfo['methodsCovered'], $classInfo['methodCount']);
                    $pathsColor    = $this->coverageColor($classInfo['pathsCovered'], $classInfo['pathsCount']);
                    $branchesColor = $this->coverageColor($classInfo['branchesCovered'], $classInfo['branchesCount']);
                    $linesColor    = $this->coverageColor($classInfo['statementsCovered'], $classInfo['statementCount']);
                    $resetColor    = $colors['reset'];
                }

                $output .= PHP_EOL . $fullQualifiedPath . PHP_EOL
                    . '  ' . $methodColor . 'Methods: ' . $this->printCoverageCounts($classInfo['methodsCovered'], $classInfo['methodCount'], 2) . $resetColor . ' ';

                if ($hasBranchCoverage) {
                    $output .= '  ' . $pathsColor . 'Paths: ' . $this->printCoverageCounts($classInfo['pathsCovered'], $classInfo['pathsCount'], 3) . $resetColor . ' '
                    . '  ' . $branchesColor . 'Branches: ' . $this->printCoverageCounts($classInfo['branchesCovered'], $classInfo['branchesCount'], 3) . $resetColor . ' ';
                }
                $output .= '  ' . $linesColor . 'Lines: ' . $this->printCoverageCounts($classInfo['statementsCovered'], $classInfo['statementCount'], 3) . $resetColor;
>>>>>>> update
            }
        }

        return $output . PHP_EOL;
    }

<<<<<<< HEAD
    protected function getCoverageColor($numberOfCoveredElements, $totalNumberOfElements)
    {
        $coverage = Util::percent(
=======
    private function coverageColor(int $numberOfCoveredElements, int $totalNumberOfElements): string
    {
        $coverage = Percentage::fromFractionAndTotal(
>>>>>>> update
            $numberOfCoveredElements,
            $totalNumberOfElements
        );

<<<<<<< HEAD
        if ($coverage >= $this->highLowerBound) {
            return $this->colors['green'];
        } elseif ($coverage > $this->lowUpperBound) {
            return $this->colors['yellow'];
        }

        return $this->colors['red'];
    }

    protected function printCoverageCounts($numberOfCoveredElements, $totalNumberOfElements, $precision)
    {
        $format = '%' . $precision . 's';

        return Util::percent(
            $numberOfCoveredElements,
            $totalNumberOfElements,
            true,
            true
        ) .
        ' (' . sprintf($format, $numberOfCoveredElements) . '/' .
        sprintf($format, $totalNumberOfElements) . ')';
    }

    private function format($color, $padding, $string)
    {
        $reset = $color ? $this->colors['reset'] : '';

        return $color . str_pad($string, $padding) . $reset . PHP_EOL;
=======
        if ($coverage->asFloat() >= $this->highLowerBound) {
            return self::COLOR_GREEN;
        }

        if ($coverage->asFloat() > $this->lowUpperBound) {
            return self::COLOR_YELLOW;
        }

        return self::COLOR_RED;
    }

    private function printCoverageCounts(int $numberOfCoveredElements, int $totalNumberOfElements, int $precision): string
    {
        $format = '%' . $precision . 's';

        return Percentage::fromFractionAndTotal(
            $numberOfCoveredElements,
            $totalNumberOfElements
        )->asFixedWidthString() .
            ' (' . sprintf($format, $numberOfCoveredElements) . '/' .
        sprintf($format, $totalNumberOfElements) . ')';
    }

    /**
     * @param false|string $string
     */
    private function format(string $color, int $padding, $string): string
    {
        $reset = $color ? self::COLOR_RESET : '';

        return $color . str_pad((string) $string, $padding) . $reset . PHP_EOL;
>>>>>>> update
    }
}
