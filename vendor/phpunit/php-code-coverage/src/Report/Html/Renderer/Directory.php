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

use SebastianBergmann\CodeCoverage\Node\AbstractNode as Node;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;

/**
 * Renders a directory node.
 */
class Directory extends Renderer
{
    /**
     * @param DirectoryNode $node
     * @param string        $file
     */
    public function render(DirectoryNode $node, $file)
    {
        $template = new \Text_Template($this->templatePath . 'directory.html', '{{', '}}');
=======
namespace SebastianBergmann\CodeCoverage\Report\Html;

use function count;
use function sprintf;
use function str_repeat;
use SebastianBergmann\CodeCoverage\Node\AbstractNode as Node;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;
use SebastianBergmann\Template\Template;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Directory extends Renderer
{
    public function render(DirectoryNode $node, string $file): void
    {
        $templateName = $this->templatePath . ($this->hasBranchCoverage ? 'directory_branch.html' : 'directory.html');
        $template     = new Template($templateName, '{{', '}}');
>>>>>>> update

        $this->setCommonTemplateVariables($template, $node);

        $items = $this->renderItem($node, true);

<<<<<<< HEAD
        foreach ($node->getDirectories() as $item) {
            $items .= $this->renderItem($item);
        }

        foreach ($node->getFiles() as $item) {
=======
        foreach ($node->directories() as $item) {
            $items .= $this->renderItem($item);
        }

        foreach ($node->files() as $item) {
>>>>>>> update
            $items .= $this->renderItem($item);
        }

        $template->setVar(
            [
<<<<<<< HEAD
                'id'    => $node->getId(),
                'items' => $items
=======
                'id'    => $node->id(),
                'items' => $items,
>>>>>>> update
            ]
        );

        $template->renderTo($file);
    }

<<<<<<< HEAD
    /**
     * @param Node $node
     * @param bool $total
     *
     * @return string
     */
    protected function renderItem(Node $node, $total = false)
    {
        $data = [
            'numClasses'                   => $node->getNumClassesAndTraits(),
            'numTestedClasses'             => $node->getNumTestedClassesAndTraits(),
            'numMethods'                   => $node->getNumMethods(),
            'numTestedMethods'             => $node->getNumTestedMethods(),
            'linesExecutedPercent'         => $node->getLineExecutedPercent(false),
            'linesExecutedPercentAsString' => $node->getLineExecutedPercent(),
            'numExecutedLines'             => $node->getNumExecutedLines(),
            'numExecutableLines'           => $node->getNumExecutableLines(),
            'testedMethodsPercent'         => $node->getTestedMethodsPercent(false),
            'testedMethodsPercentAsString' => $node->getTestedMethodsPercent(),
            'testedClassesPercent'         => $node->getTestedClassesAndTraitsPercent(false),
            'testedClassesPercentAsString' => $node->getTestedClassesAndTraitsPercent()
=======
    private function renderItem(Node $node, bool $total = false): string
    {
        $data = [
            'numClasses'                      => $node->numberOfClassesAndTraits(),
            'numTestedClasses'                => $node->numberOfTestedClassesAndTraits(),
            'numMethods'                      => $node->numberOfFunctionsAndMethods(),
            'numTestedMethods'                => $node->numberOfTestedFunctionsAndMethods(),
            'linesExecutedPercent'            => $node->percentageOfExecutedLines()->asFloat(),
            'linesExecutedPercentAsString'    => $node->percentageOfExecutedLines()->asString(),
            'numExecutedLines'                => $node->numberOfExecutedLines(),
            'numExecutableLines'              => $node->numberOfExecutableLines(),
            'branchesExecutedPercent'         => $node->percentageOfExecutedBranches()->asFloat(),
            'branchesExecutedPercentAsString' => $node->percentageOfExecutedBranches()->asString(),
            'numExecutedBranches'             => $node->numberOfExecutedBranches(),
            'numExecutableBranches'           => $node->numberOfExecutableBranches(),
            'pathsExecutedPercent'            => $node->percentageOfExecutedPaths()->asFloat(),
            'pathsExecutedPercentAsString'    => $node->percentageOfExecutedPaths()->asString(),
            'numExecutedPaths'                => $node->numberOfExecutedPaths(),
            'numExecutablePaths'              => $node->numberOfExecutablePaths(),
            'testedMethodsPercent'            => $node->percentageOfTestedFunctionsAndMethods()->asFloat(),
            'testedMethodsPercentAsString'    => $node->percentageOfTestedFunctionsAndMethods()->asString(),
            'testedClassesPercent'            => $node->percentageOfTestedClassesAndTraits()->asFloat(),
            'testedClassesPercentAsString'    => $node->percentageOfTestedClassesAndTraits()->asString(),
>>>>>>> update
        ];

        if ($total) {
            $data['name'] = 'Total';
        } else {
<<<<<<< HEAD
            if ($node instanceof DirectoryNode) {
                $data['name'] = sprintf(
                    '<a href="%s/index.html">%s</a>',
                    $node->getName(),
                    $node->getName()
                );

                $data['icon'] = '<span class="glyphicon glyphicon-folder-open"></span> ';
            } else {
                $data['name'] = sprintf(
                    '<a href="%s.html">%s</a>',
                    $node->getName(),
                    $node->getName()
                );

                $data['icon'] = '<span class="glyphicon glyphicon-file"></span> ';
            }
        }

        return $this->renderItemTemplate(
            new \Text_Template($this->templatePath . 'directory_item.html', '{{', '}}'),
=======
            $up           = str_repeat('../', count($node->pathAsArray()) - 2);
            $data['icon'] = sprintf('<img src="%s_icons/file-code.svg" class="octicon" />', $up);

            if ($node instanceof DirectoryNode) {
                $data['name'] = sprintf(
                    '<a href="%s/index.html">%s</a>',
                    $node->name(),
                    $node->name()
                );
                $data['icon'] = sprintf('<img src="%s_icons/file-directory.svg" class="octicon" />', $up);
            } elseif ($this->hasBranchCoverage) {
                $data['name'] = sprintf(
                    '%s <a class="small" href="%s.html">[line]</a> <a class="small" href="%s_branch.html">[branch]</a> <a class="small" href="%s_path.html">[path]</a>',
                    $node->name(),
                    $node->name(),
                    $node->name(),
                    $node->name()
                );
            } else {
                $data['name'] = sprintf(
                    '<a href="%s.html">%s</a>',
                    $node->name(),
                    $node->name()
                );
            }
        }

        $templateName = $this->templatePath . ($this->hasBranchCoverage ? 'directory_item_branch.html' : 'directory_item.html');

        return $this->renderItemTemplate(
            new Template($templateName, '{{', '}}'),
>>>>>>> update
            $data
        );
    }
}
