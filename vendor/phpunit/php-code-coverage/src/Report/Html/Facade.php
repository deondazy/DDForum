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

use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;
use SebastianBergmann\CodeCoverage\RuntimeException;

/**
 * Generates an HTML report from a code coverage object.
 */
class Facade
=======
namespace SebastianBergmann\CodeCoverage\Report\Html;

use const DIRECTORY_SEPARATOR;
use function copy;
use function date;
use function dirname;
use function substr;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\InvalidArgumentException;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;
use SebastianBergmann\CodeCoverage\Util\Filesystem;

final class Facade
>>>>>>> update
{
    /**
     * @var string
     */
    private $templatePath;

    /**
     * @var string
     */
    private $generator;

    /**
     * @var int
     */
    private $lowUpperBound;

    /**
     * @var int
     */
    private $highLowerBound;

<<<<<<< HEAD
    /**
     * Constructor.
     *
     * @param int    $lowUpperBound
     * @param int    $highLowerBound
     * @param string $generator
     */
    public function __construct($lowUpperBound = 50, $highLowerBound = 90, $generator = '')
    {
=======
    public function __construct(int $lowUpperBound = 50, int $highLowerBound = 90, string $generator = '')
    {
        if ($lowUpperBound > $highLowerBound) {
            throw new InvalidArgumentException(
                '$lowUpperBound must not be larger than $highLowerBound'
            );
        }

>>>>>>> update
        $this->generator      = $generator;
        $this->highLowerBound = $highLowerBound;
        $this->lowUpperBound  = $lowUpperBound;
        $this->templatePath   = __DIR__ . '/Renderer/Template/';
    }

<<<<<<< HEAD
    /**
     * @param CodeCoverage $coverage
     * @param string       $target
     */
    public function process(CodeCoverage $coverage, $target)
    {
        $target = $this->getDirectory($target);
        $report = $coverage->getReport();
        unset($coverage);

        if (!isset($_SERVER['REQUEST_TIME'])) {
            $_SERVER['REQUEST_TIME'] = time();
        }

        $date = date('D M j G:i:s T Y', $_SERVER['REQUEST_TIME']);
=======
    public function process(CodeCoverage $coverage, string $target): void
    {
        $target = $this->directory($target);
        $report = $coverage->getReport();
        $date   = date('D M j G:i:s T Y');
>>>>>>> update

        $dashboard = new Dashboard(
            $this->templatePath,
            $this->generator,
            $date,
            $this->lowUpperBound,
<<<<<<< HEAD
            $this->highLowerBound
=======
            $this->highLowerBound,
            $coverage->collectsBranchAndPathCoverage()
>>>>>>> update
        );

        $directory = new Directory(
            $this->templatePath,
            $this->generator,
            $date,
            $this->lowUpperBound,
<<<<<<< HEAD
            $this->highLowerBound
=======
            $this->highLowerBound,
            $coverage->collectsBranchAndPathCoverage()
>>>>>>> update
        );

        $file = new File(
            $this->templatePath,
            $this->generator,
            $date,
            $this->lowUpperBound,
<<<<<<< HEAD
            $this->highLowerBound
=======
            $this->highLowerBound,
            $coverage->collectsBranchAndPathCoverage()
>>>>>>> update
        );

        $directory->render($report, $target . 'index.html');
        $dashboard->render($report, $target . 'dashboard.html');

        foreach ($report as $node) {
<<<<<<< HEAD
            $id = $node->getId();

            if ($node instanceof DirectoryNode) {
                if (!file_exists($target . $id)) {
                    mkdir($target . $id, 0777, true);
                }
=======
            $id = $node->id();

            if ($node instanceof DirectoryNode) {
                Filesystem::createDirectory($target . $id);
>>>>>>> update

                $directory->render($node, $target . $id . '/index.html');
                $dashboard->render($node, $target . $id . '/dashboard.html');
            } else {
                $dir = dirname($target . $id);

<<<<<<< HEAD
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }

                $file->render($node, $target . $id . '.html');
=======
                Filesystem::createDirectory($dir);

                $file->render($node, $target . $id);
>>>>>>> update
            }
        }

        $this->copyFiles($target);
    }

<<<<<<< HEAD
    /**
     * @param string $target
     */
    private function copyFiles($target)
    {
        $dir = $this->getDirectory($target . 'css');
        copy($this->templatePath . 'css/bootstrap.min.css', $dir . 'bootstrap.min.css');
        copy($this->templatePath . 'css/nv.d3.min.css', $dir . 'nv.d3.min.css');
        copy($this->templatePath . 'css/style.css', $dir . 'style.css');

        $dir = $this->getDirectory($target . 'fonts');
        copy($this->templatePath . 'fonts/glyphicons-halflings-regular.eot', $dir . 'glyphicons-halflings-regular.eot');
        copy($this->templatePath . 'fonts/glyphicons-halflings-regular.svg', $dir . 'glyphicons-halflings-regular.svg');
        copy($this->templatePath . 'fonts/glyphicons-halflings-regular.ttf', $dir . 'glyphicons-halflings-regular.ttf');
        copy($this->templatePath . 'fonts/glyphicons-halflings-regular.woff', $dir . 'glyphicons-halflings-regular.woff');
        copy($this->templatePath . 'fonts/glyphicons-halflings-regular.woff2', $dir . 'glyphicons-halflings-regular.woff2');

        $dir = $this->getDirectory($target . 'js');
        copy($this->templatePath . 'js/bootstrap.min.js', $dir . 'bootstrap.min.js');
        copy($this->templatePath . 'js/d3.min.js', $dir . 'd3.min.js');
        copy($this->templatePath . 'js/holder.min.js', $dir . 'holder.min.js');
        copy($this->templatePath . 'js/html5shiv.min.js', $dir . 'html5shiv.min.js');
        copy($this->templatePath . 'js/jquery.min.js', $dir . 'jquery.min.js');
        copy($this->templatePath . 'js/nv.d3.min.js', $dir . 'nv.d3.min.js');
        copy($this->templatePath . 'js/respond.min.js', $dir . 'respond.min.js');
    }

    /**
     * @param string $directory
     *
     * @return string
     *
     * @throws RuntimeException
     */
    private function getDirectory($directory)
=======
    private function copyFiles(string $target): void
    {
        $dir = $this->directory($target . '_css');

        copy($this->templatePath . 'css/bootstrap.min.css', $dir . 'bootstrap.min.css');
        copy($this->templatePath . 'css/nv.d3.min.css', $dir . 'nv.d3.min.css');
        copy($this->templatePath . 'css/style.css', $dir . 'style.css');
        copy($this->templatePath . 'css/custom.css', $dir . 'custom.css');
        copy($this->templatePath . 'css/octicons.css', $dir . 'octicons.css');

        $dir = $this->directory($target . '_icons');
        copy($this->templatePath . 'icons/file-code.svg', $dir . 'file-code.svg');
        copy($this->templatePath . 'icons/file-directory.svg', $dir . 'file-directory.svg');

        $dir = $this->directory($target . '_js');
        copy($this->templatePath . 'js/bootstrap.min.js', $dir . 'bootstrap.min.js');
        copy($this->templatePath . 'js/popper.min.js', $dir . 'popper.min.js');
        copy($this->templatePath . 'js/d3.min.js', $dir . 'd3.min.js');
        copy($this->templatePath . 'js/jquery.min.js', $dir . 'jquery.min.js');
        copy($this->templatePath . 'js/nv.d3.min.js', $dir . 'nv.d3.min.js');
        copy($this->templatePath . 'js/file.js', $dir . 'file.js');
    }

    private function directory(string $directory): string
>>>>>>> update
    {
        if (substr($directory, -1, 1) != DIRECTORY_SEPARATOR) {
            $directory .= DIRECTORY_SEPARATOR;
        }

<<<<<<< HEAD
        if (is_dir($directory)) {
            return $directory;
        }

        if (@mkdir($directory, 0777, true)) {
            return $directory;
        }

        throw new RuntimeException(
            sprintf(
                'Directory "%s" does not exist.',
                $directory
            )
        );
=======
        Filesystem::createDirectory($directory);

        return $directory;
>>>>>>> update
    }
}
