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

namespace SebastianBergmann\CodeCoverage\Report\Html;

use SebastianBergmann\CodeCoverage\Node\AbstractNode;
use SebastianBergmann\CodeCoverage\Node\File as FileNode;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;
use SebastianBergmann\Environment\Runtime;
use SebastianBergmann\Version;

/**
 * Base class for node renderers.
=======
namespace SebastianBergmann\CodeCoverage\Report\Html;

use function array_pop;
use function count;
use function sprintf;
use function str_repeat;
use function substr_count;
use SebastianBergmann\CodeCoverage\Node\AbstractNode;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;
use SebastianBergmann\CodeCoverage\Node\File as FileNode;
use SebastianBergmann\CodeCoverage\Version;
use SebastianBergmann\Environment\Runtime;
use SebastianBergmann\Template\Template;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
>>>>>>> update
 */
abstract class Renderer
{
    /**
     * @var string
     */
    protected $templatePath;

    /**
     * @var string
     */
    protected $generator;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var int
     */
    protected $lowUpperBound;

    /**
     * @var int
     */
    protected $highLowerBound;

    /**
<<<<<<< HEAD
=======
     * @var bool
     */
    protected $hasBranchCoverage;

    /**
>>>>>>> update
     * @var string
     */
    protected $version;

<<<<<<< HEAD
    /**
     * Constructor.
     *
     * @param string $templatePath
     * @param string $generator
     * @param string $date
     * @param int    $lowUpperBound
     * @param int    $highLowerBound
     */
    public function __construct($templatePath, $generator, $date, $lowUpperBound, $highLowerBound)
    {
        $version = new Version('4.0.2', dirname(dirname(dirname(dirname(__DIR__)))));

        $this->templatePath   = $templatePath;
        $this->generator      = $generator;
        $this->date           = $date;
        $this->lowUpperBound  = $lowUpperBound;
        $this->highLowerBound = $highLowerBound;
        $this->version        = $version->getVersion();
    }

    /**
     * @param \Text_Template $template
     * @param array          $data
     *
     * @return string
     */
    protected function renderItemTemplate(\Text_Template $template, array $data)
    {
        $numSeparator  = '&nbsp;/&nbsp;';

        if (isset($data['numClasses']) && $data['numClasses'] > 0) {
            $classesLevel = $this->getColorLevel($data['testedClassesPercent']);
=======
    public function __construct(string $templatePath, string $generator, string $date, int $lowUpperBound, int $highLowerBound, bool $hasBranchCoverage)
    {
        $this->templatePath      = $templatePath;
        $this->generator         = $generator;
        $this->date              = $date;
        $this->lowUpperBound     = $lowUpperBound;
        $this->highLowerBound    = $highLowerBound;
        $this->version           = Version::id();
        $this->hasBranchCoverage = $hasBranchCoverage;
    }

    protected function renderItemTemplate(Template $template, array $data): string
    {
        $numSeparator = '&nbsp;/&nbsp;';

        if (isset($data['numClasses']) && $data['numClasses'] > 0) {
            $classesLevel = $this->colorLevel($data['testedClassesPercent']);
>>>>>>> update

            $classesNumber = $data['numTestedClasses'] . $numSeparator .
                $data['numClasses'];

<<<<<<< HEAD
            $classesBar = $this->getCoverageBar(
                $data['testedClassesPercent']
            );
        } else {
            $classesLevel  = 'success';
            $classesNumber = '0' . $numSeparator . '0';
            $classesBar    = $this->getCoverageBar(100);
        }

        if ($data['numMethods'] > 0) {
            $methodsLevel = $this->getColorLevel($data['testedMethodsPercent']);
=======
            $classesBar = $this->coverageBar(
                $data['testedClassesPercent']
            );
        } else {
            $classesLevel                         = '';
            $classesNumber                        = '0' . $numSeparator . '0';
            $classesBar                           = '';
            $data['testedClassesPercentAsString'] = 'n/a';
        }

        if ($data['numMethods'] > 0) {
            $methodsLevel = $this->colorLevel($data['testedMethodsPercent']);
>>>>>>> update

            $methodsNumber = $data['numTestedMethods'] . $numSeparator .
                $data['numMethods'];

<<<<<<< HEAD
            $methodsBar = $this->getCoverageBar(
                $data['testedMethodsPercent']
            );
        } else {
            $methodsLevel                         = 'success';
            $methodsNumber                        = '0' . $numSeparator . '0';
            $methodsBar                           = $this->getCoverageBar(100);
            $data['testedMethodsPercentAsString'] = '100.00%';
        }

        if ($data['numExecutableLines'] > 0) {
            $linesLevel = $this->getColorLevel($data['linesExecutedPercent']);
=======
            $methodsBar = $this->coverageBar(
                $data['testedMethodsPercent']
            );
        } else {
            $methodsLevel                         = '';
            $methodsNumber                        = '0' . $numSeparator . '0';
            $methodsBar                           = '';
            $data['testedMethodsPercentAsString'] = 'n/a';
        }

        if ($data['numExecutableLines'] > 0) {
            $linesLevel = $this->colorLevel($data['linesExecutedPercent']);
>>>>>>> update

            $linesNumber = $data['numExecutedLines'] . $numSeparator .
                $data['numExecutableLines'];

<<<<<<< HEAD
            $linesBar = $this->getCoverageBar(
                $data['linesExecutedPercent']
            );
        } else {
            $linesLevel                           = 'success';
            $linesNumber                          = '0' . $numSeparator . '0';
            $linesBar                             = $this->getCoverageBar(100);
            $data['linesExecutedPercentAsString'] = '100.00%';
=======
            $linesBar = $this->coverageBar(
                $data['linesExecutedPercent']
            );
        } else {
            $linesLevel                           = '';
            $linesNumber                          = '0' . $numSeparator . '0';
            $linesBar                             = '';
            $data['linesExecutedPercentAsString'] = 'n/a';
        }

        if ($data['numExecutablePaths'] > 0) {
            $pathsLevel = $this->colorLevel($data['pathsExecutedPercent']);

            $pathsNumber = $data['numExecutedPaths'] . $numSeparator .
                $data['numExecutablePaths'];

            $pathsBar = $this->coverageBar(
                $data['pathsExecutedPercent']
            );
        } else {
            $pathsLevel                           = '';
            $pathsNumber                          = '0' . $numSeparator . '0';
            $pathsBar                             = '';
            $data['pathsExecutedPercentAsString'] = 'n/a';
        }

        if ($data['numExecutableBranches'] > 0) {
            $branchesLevel = $this->colorLevel($data['branchesExecutedPercent']);

            $branchesNumber = $data['numExecutedBranches'] . $numSeparator .
                $data['numExecutableBranches'];

            $branchesBar = $this->coverageBar(
                $data['branchesExecutedPercent']
            );
        } else {
            $branchesLevel                           = '';
            $branchesNumber                          = '0' . $numSeparator . '0';
            $branchesBar                             = '';
            $data['branchesExecutedPercentAsString'] = 'n/a';
>>>>>>> update
        }

        $template->setVar(
            [
<<<<<<< HEAD
                'icon'                   => isset($data['icon']) ? $data['icon'] : '',
                'crap'                   => isset($data['crap']) ? $data['crap'] : '',
                'name'                   => $data['name'],
                'lines_bar'              => $linesBar,
                'lines_executed_percent' => $data['linesExecutedPercentAsString'],
                'lines_level'            => $linesLevel,
                'lines_number'           => $linesNumber,
                'methods_bar'            => $methodsBar,
                'methods_tested_percent' => $data['testedMethodsPercentAsString'],
                'methods_level'          => $methodsLevel,
                'methods_number'         => $methodsNumber,
                'classes_bar'            => $classesBar,
                'classes_tested_percent' => isset($data['testedClassesPercentAsString']) ? $data['testedClassesPercentAsString'] : '',
                'classes_level'          => $classesLevel,
                'classes_number'         => $classesNumber
=======
                'icon'                      => $data['icon'] ?? '',
                'crap'                      => $data['crap'] ?? '',
                'name'                      => $data['name'],
                'lines_bar'                 => $linesBar,
                'lines_executed_percent'    => $data['linesExecutedPercentAsString'],
                'lines_level'               => $linesLevel,
                'lines_number'              => $linesNumber,
                'paths_bar'                 => $pathsBar,
                'paths_executed_percent'    => $data['pathsExecutedPercentAsString'],
                'paths_level'               => $pathsLevel,
                'paths_number'              => $pathsNumber,
                'branches_bar'              => $branchesBar,
                'branches_executed_percent' => $data['branchesExecutedPercentAsString'],
                'branches_level'            => $branchesLevel,
                'branches_number'           => $branchesNumber,
                'methods_bar'               => $methodsBar,
                'methods_tested_percent'    => $data['testedMethodsPercentAsString'],
                'methods_level'             => $methodsLevel,
                'methods_number'            => $methodsNumber,
                'classes_bar'               => $classesBar,
                'classes_tested_percent'    => $data['testedClassesPercentAsString'] ?? '',
                'classes_level'             => $classesLevel,
                'classes_number'            => $classesNumber,
>>>>>>> update
            ]
        );

        return $template->render();
    }

<<<<<<< HEAD
    /**
     * @param \Text_Template $template
     * @param AbstractNode   $node
     */
    protected function setCommonTemplateVariables(\Text_Template $template, AbstractNode $node)
    {
        $template->setVar(
            [
                'id'               => $node->getId(),
                'full_path'        => $node->getPath(),
                'path_to_root'     => $this->getPathToRoot($node),
                'breadcrumbs'      => $this->getBreadcrumbs($node),
                'date'             => $this->date,
                'version'          => $this->version,
                'runtime'          => $this->getRuntimeString(),
                'generator'        => $this->generator,
                'low_upper_bound'  => $this->lowUpperBound,
                'high_lower_bound' => $this->highLowerBound
=======
    protected function setCommonTemplateVariables(Template $template, AbstractNode $node): void
    {
        $template->setVar(
            [
                'id'               => $node->id(),
                'full_path'        => $node->pathAsString(),
                'path_to_root'     => $this->pathToRoot($node),
                'breadcrumbs'      => $this->breadcrumbs($node),
                'date'             => $this->date,
                'version'          => $this->version,
                'runtime'          => $this->runtimeString(),
                'generator'        => $this->generator,
                'low_upper_bound'  => $this->lowUpperBound,
                'high_lower_bound' => $this->highLowerBound,
>>>>>>> update
            ]
        );
    }

<<<<<<< HEAD
    protected function getBreadcrumbs(AbstractNode $node)
    {
        $breadcrumbs = '';
        $path        = $node->getPathAsArray();
=======
    protected function breadcrumbs(AbstractNode $node): string
    {
        $breadcrumbs = '';
        $path        = $node->pathAsArray();
>>>>>>> update
        $pathToRoot  = [];
        $max         = count($path);

        if ($node instanceof FileNode) {
            $max--;
        }

        for ($i = 0; $i < $max; $i++) {
            $pathToRoot[] = str_repeat('../', $i);
        }

        foreach ($path as $step) {
            if ($step !== $node) {
<<<<<<< HEAD
                $breadcrumbs .= $this->getInactiveBreadcrumb(
=======
                $breadcrumbs .= $this->inactiveBreadcrumb(
>>>>>>> update
                    $step,
                    array_pop($pathToRoot)
                );
            } else {
<<<<<<< HEAD
                $breadcrumbs .= $this->getActiveBreadcrumb($step);
=======
                $breadcrumbs .= $this->activeBreadcrumb($step);
>>>>>>> update
            }
        }

        return $breadcrumbs;
    }

<<<<<<< HEAD
    protected function getActiveBreadcrumb(AbstractNode $node)
    {
        $buffer = sprintf(
            '        <li class="active">%s</li>' . "\n",
            $node->getName()
        );

        if ($node instanceof DirectoryNode) {
            $buffer .= '        <li>(<a href="dashboard.html">Dashboard</a>)</li>' . "\n";
=======
    protected function activeBreadcrumb(AbstractNode $node): string
    {
        $buffer = sprintf(
            '         <li class="breadcrumb-item active">%s</li>' . "\n",
            $node->name()
        );

        if ($node instanceof DirectoryNode) {
            $buffer .= '         <li class="breadcrumb-item">(<a href="dashboard.html">Dashboard</a>)</li>' . "\n";
>>>>>>> update
        }

        return $buffer;
    }

<<<<<<< HEAD
    protected function getInactiveBreadcrumb(AbstractNode $node, $pathToRoot)
    {
        return sprintf(
            '        <li><a href="%sindex.html">%s</a></li>' . "\n",
            $pathToRoot,
            $node->getName()
        );
    }

    protected function getPathToRoot(AbstractNode $node)
    {
        $id    = $node->getId();
        $depth = substr_count($id, '/');

        if ($id != 'index' &&
=======
    protected function inactiveBreadcrumb(AbstractNode $node, string $pathToRoot): string
    {
        return sprintf(
            '         <li class="breadcrumb-item"><a href="%sindex.html">%s</a></li>' . "\n",
            $pathToRoot,
            $node->name()
        );
    }

    protected function pathToRoot(AbstractNode $node): string
    {
        $id    = $node->id();
        $depth = substr_count($id, '/');

        if ($id !== 'index' &&
>>>>>>> update
            $node instanceof DirectoryNode) {
            $depth++;
        }

        return str_repeat('../', $depth);
    }

<<<<<<< HEAD
    protected function getCoverageBar($percent)
    {
        $level = $this->getColorLevel($percent);

        $template = new \Text_Template(
            $this->templatePath . 'coverage_bar.html',
=======
    protected function coverageBar(float $percent): string
    {
        $level = $this->colorLevel($percent);

        $templateName = $this->templatePath . ($this->hasBranchCoverage ? 'coverage_bar_branch.html' : 'coverage_bar.html');
        $template     = new Template(
            $templateName,
>>>>>>> update
            '{{',
            '}}'
        );

        $template->setVar(['level' => $level, 'percent' => sprintf('%.2F', $percent)]);

        return $template->render();
    }

<<<<<<< HEAD
    /**
     * @param int $percent
     *
     * @return string
     */
    protected function getColorLevel($percent)
    {
        if ($percent <= $this->lowUpperBound) {
            return 'danger';
        } elseif ($percent > $this->lowUpperBound &&
            $percent <  $this->highLowerBound) {
            return 'warning';
        } else {
            return 'success';
        }
    }

    /**
     * @return string
     */
    private function getRuntimeString()
    {
        $runtime = new Runtime;

        $buffer = sprintf(
=======
    protected function colorLevel(float $percent): string
    {
        if ($percent <= $this->lowUpperBound) {
            return 'danger';
        }

        if ($percent > $this->lowUpperBound &&
            $percent < $this->highLowerBound) {
            return 'warning';
        }

        return 'success';
    }

    private function runtimeString(): string
    {
        $runtime = new Runtime;

        return sprintf(
>>>>>>> update
            '<a href="%s" target="_top">%s %s</a>',
            $runtime->getVendorUrl(),
            $runtime->getName(),
            $runtime->getVersion()
        );
<<<<<<< HEAD

        if ($runtime->hasXdebug() && !$runtime->hasPHPDBGCodeCoverage()) {
            $buffer .= sprintf(
                ' with <a href="https://xdebug.org/">Xdebug %s</a>',
                phpversion('xdebug')
            );
        }

        return $buffer;
=======
>>>>>>> update
    }
}
