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
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;

/**
 * Renders the dashboard for a directory node.
 */
class Dashboard extends Renderer
{
    /**
     * @param DirectoryNode $node
     * @param string        $file
     */
    public function render(DirectoryNode $node, $file)
    {
        $classes  = $node->getClassesAndTraits();
        $template = new \Text_Template(
            $this->templatePath . 'dashboard.html',
=======
namespace SebastianBergmann\CodeCoverage\Report\Html;

use function array_values;
use function arsort;
use function asort;
use function count;
use function explode;
use function floor;
use function json_encode;
use function sprintf;
use function str_replace;
use SebastianBergmann\CodeCoverage\Node\AbstractNode;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;
use SebastianBergmann\Template\Template;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Dashboard extends Renderer
{
    public function render(DirectoryNode $node, string $file): void
    {
        $classes      = $node->classesAndTraits();
        $templateName = $this->templatePath . ($this->hasBranchCoverage ? 'dashboard_branch.html' : 'dashboard.html');
        $template     = new Template(
            $templateName,
>>>>>>> update
            '{{',
            '}}'
        );

        $this->setCommonTemplateVariables($template, $node);

<<<<<<< HEAD
        $baseLink             = $node->getId() . '/';
=======
        $baseLink             = $node->id() . '/';
>>>>>>> update
        $complexity           = $this->complexity($classes, $baseLink);
        $coverageDistribution = $this->coverageDistribution($classes);
        $insufficientCoverage = $this->insufficientCoverage($classes, $baseLink);
        $projectRisks         = $this->projectRisks($classes, $baseLink);

        $template->setVar(
            [
                'insufficient_coverage_classes' => $insufficientCoverage['class'],
                'insufficient_coverage_methods' => $insufficientCoverage['method'],
                'project_risks_classes'         => $projectRisks['class'],
                'project_risks_methods'         => $projectRisks['method'],
                'complexity_class'              => $complexity['class'],
                'complexity_method'             => $complexity['method'],
                'class_coverage_distribution'   => $coverageDistribution['class'],
<<<<<<< HEAD
                'method_coverage_distribution'  => $coverageDistribution['method']
=======
                'method_coverage_distribution'  => $coverageDistribution['method'],
>>>>>>> update
            ]
        );

        $template->renderTo($file);
    }

<<<<<<< HEAD
    /**
     * Returns the data for the Class/Method Complexity charts.
     *
     * @param array  $classes
     * @param string $baseLink
     *
     * @return array
     */
    protected function complexity(array $classes, $baseLink)
=======
    protected function activeBreadcrumb(AbstractNode $node): string
    {
        return sprintf(
            '         <li class="breadcrumb-item"><a href="index.html">%s</a></li>' . "\n" .
            '         <li class="breadcrumb-item active">(Dashboard)</li>' . "\n",
            $node->name()
        );
    }

    /**
     * Returns the data for the Class/Method Complexity charts.
     */
    private function complexity(array $classes, string $baseLink): array
>>>>>>> update
    {
        $result = ['class' => [], 'method' => []];

        foreach ($classes as $className => $class) {
            foreach ($class['methods'] as $methodName => $method) {
<<<<<<< HEAD
                if ($className != '*') {
=======
                if ($className !== '*') {
>>>>>>> update
                    $methodName = $className . '::' . $methodName;
                }

                $result['method'][] = [
                    $method['coverage'],
                    $method['ccn'],
                    sprintf(
                        '<a href="%s">%s</a>',
                        str_replace($baseLink, '', $method['link']),
                        $methodName
<<<<<<< HEAD
                    )
=======
                    ),
>>>>>>> update
                ];
            }

            $result['class'][] = [
                $class['coverage'],
                $class['ccn'],
                sprintf(
                    '<a href="%s">%s</a>',
                    str_replace($baseLink, '', $class['link']),
                    $className
<<<<<<< HEAD
                )
=======
                ),
>>>>>>> update
            ];
        }

        return [
            'class'  => json_encode($result['class']),
<<<<<<< HEAD
            'method' => json_encode($result['method'])
=======
            'method' => json_encode($result['method']),
>>>>>>> update
        ];
    }

    /**
     * Returns the data for the Class / Method Coverage Distribution chart.
<<<<<<< HEAD
     *
     * @param array $classes
     *
     * @return array
     */
    protected function coverageDistribution(array $classes)
=======
     */
    private function coverageDistribution(array $classes): array
>>>>>>> update
    {
        $result = [
            'class' => [
                '0%'      => 0,
                '0-10%'   => 0,
                '10-20%'  => 0,
                '20-30%'  => 0,
                '30-40%'  => 0,
                '40-50%'  => 0,
                '50-60%'  => 0,
                '60-70%'  => 0,
                '70-80%'  => 0,
                '80-90%'  => 0,
                '90-100%' => 0,
<<<<<<< HEAD
                '100%'    => 0
=======
                '100%'    => 0,
>>>>>>> update
            ],
            'method' => [
                '0%'      => 0,
                '0-10%'   => 0,
                '10-20%'  => 0,
                '20-30%'  => 0,
                '30-40%'  => 0,
                '40-50%'  => 0,
                '50-60%'  => 0,
                '60-70%'  => 0,
                '70-80%'  => 0,
                '80-90%'  => 0,
                '90-100%' => 0,
<<<<<<< HEAD
                '100%'    => 0
            ]
=======
                '100%'    => 0,
            ],
>>>>>>> update
        ];

        foreach ($classes as $class) {
            foreach ($class['methods'] as $methodName => $method) {
<<<<<<< HEAD
                if ($method['coverage'] == 0) {
                    $result['method']['0%']++;
                } elseif ($method['coverage'] == 100) {
=======
                if ($method['coverage'] === 0) {
                    $result['method']['0%']++;
                } elseif ($method['coverage'] === 100) {
>>>>>>> update
                    $result['method']['100%']++;
                } else {
                    $key = floor($method['coverage'] / 10) * 10;
                    $key = $key . '-' . ($key + 10) . '%';
                    $result['method'][$key]++;
                }
            }

<<<<<<< HEAD
            if ($class['coverage'] == 0) {
                $result['class']['0%']++;
            } elseif ($class['coverage'] == 100) {
=======
            if ($class['coverage'] === 0) {
                $result['class']['0%']++;
            } elseif ($class['coverage'] === 100) {
>>>>>>> update
                $result['class']['100%']++;
            } else {
                $key = floor($class['coverage'] / 10) * 10;
                $key = $key . '-' . ($key + 10) . '%';
                $result['class'][$key]++;
            }
        }

        return [
            'class'  => json_encode(array_values($result['class'])),
<<<<<<< HEAD
            'method' => json_encode(array_values($result['method']))
=======
            'method' => json_encode(array_values($result['method'])),
>>>>>>> update
        ];
    }

    /**
     * Returns the classes / methods with insufficient coverage.
<<<<<<< HEAD
     *
     * @param array  $classes
     * @param string $baseLink
     *
     * @return array
     */
    protected function insufficientCoverage(array $classes, $baseLink)
=======
     */
    private function insufficientCoverage(array $classes, string $baseLink): array
>>>>>>> update
    {
        $leastTestedClasses = [];
        $leastTestedMethods = [];
        $result             = ['class' => '', 'method' => ''];

        foreach ($classes as $className => $class) {
            foreach ($class['methods'] as $methodName => $method) {
                if ($method['coverage'] < $this->highLowerBound) {
<<<<<<< HEAD
                    if ($className != '*') {
                        $key = $className . '::' . $methodName;
                    } else {
                        $key = $methodName;
=======
                    $key = $methodName;

                    if ($className !== '*') {
                        $key = $className . '::' . $methodName;
>>>>>>> update
                    }

                    $leastTestedMethods[$key] = $method['coverage'];
                }
            }

            if ($class['coverage'] < $this->highLowerBound) {
                $leastTestedClasses[$className] = $class['coverage'];
            }
        }

        asort($leastTestedClasses);
        asort($leastTestedMethods);

        foreach ($leastTestedClasses as $className => $coverage) {
            $result['class'] .= sprintf(
                '       <tr><td><a href="%s">%s</a></td><td class="text-right">%d%%</td></tr>' . "\n",
                str_replace($baseLink, '', $classes[$className]['link']),
                $className,
                $coverage
            );
        }

        foreach ($leastTestedMethods as $methodName => $coverage) {
<<<<<<< HEAD
            list($class, $method) = explode('::', $methodName);
=======
            [$class, $method] = explode('::', $methodName);
>>>>>>> update

            $result['method'] .= sprintf(
                '       <tr><td><a href="%s"><abbr title="%s">%s</abbr></a></td><td class="text-right">%d%%</td></tr>' . "\n",
                str_replace($baseLink, '', $classes[$class]['methods'][$method]['link']),
                $methodName,
                $method,
                $coverage
            );
        }

        return $result;
    }

    /**
     * Returns the project risks according to the CRAP index.
<<<<<<< HEAD
     *
     * @param array  $classes
     * @param string $baseLink
     *
     * @return array
     */
    protected function projectRisks(array $classes, $baseLink)
=======
     */
    private function projectRisks(array $classes, string $baseLink): array
>>>>>>> update
    {
        $classRisks  = [];
        $methodRisks = [];
        $result      = ['class' => '', 'method' => ''];

        foreach ($classes as $className => $class) {
            foreach ($class['methods'] as $methodName => $method) {
<<<<<<< HEAD
                if ($method['coverage'] < $this->highLowerBound &&
                    $method['ccn'] > 1) {
                    if ($className != '*') {
                        $key = $className . '::' . $methodName;
                    } else {
                        $key = $methodName;
=======
                if ($method['coverage'] < $this->highLowerBound && $method['ccn'] > 1) {
                    $key = $methodName;

                    if ($className !== '*') {
                        $key = $className . '::' . $methodName;
>>>>>>> update
                    }

                    $methodRisks[$key] = $method['crap'];
                }
            }

            if ($class['coverage'] < $this->highLowerBound &&
                $class['ccn'] > count($class['methods'])) {
                $classRisks[$className] = $class['crap'];
            }
        }

        arsort($classRisks);
        arsort($methodRisks);

        foreach ($classRisks as $className => $crap) {
            $result['class'] .= sprintf(
                '       <tr><td><a href="%s">%s</a></td><td class="text-right">%d</td></tr>' . "\n",
                str_replace($baseLink, '', $classes[$className]['link']),
                $className,
                $crap
            );
        }

        foreach ($methodRisks as $methodName => $crap) {
<<<<<<< HEAD
            list($class, $method) = explode('::', $methodName);
=======
            [$class, $method] = explode('::', $methodName);
>>>>>>> update

            $result['method'] .= sprintf(
                '       <tr><td><a href="%s"><abbr title="%s">%s</abbr></a></td><td class="text-right">%d</td></tr>' . "\n",
                str_replace($baseLink, '', $classes[$class]['methods'][$method]['link']),
                $methodName,
                $method,
                $crap
            );
        }

        return $result;
    }
<<<<<<< HEAD

    protected function getActiveBreadcrumb(AbstractNode $node)
    {
        return sprintf(
            '        <li><a href="index.html">%s</a></li>' . "\n" .
            '        <li class="active">(Dashboard)</li>' . "\n",
            $node->getName()
        );
    }
=======
>>>>>>> update
}
