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

use SebastianBergmann\CodeCoverage\CodeCoverage;

class Builder
{
    /**
     * @param CodeCoverage $coverage
     *
     * @return Directory
     */
    public function build(CodeCoverage $coverage)
    {
        $files      = $coverage->getData();
        $commonPath = $this->reducePaths($files);
=======
namespace SebastianBergmann\CodeCoverage\Node;

use const DIRECTORY_SEPARATOR;
use function array_shift;
use function basename;
use function count;
use function dirname;
use function explode;
use function implode;
use function is_file;
use function str_replace;
use function strpos;
use function substr;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\ProcessedCodeCoverageData;
use SebastianBergmann\CodeCoverage\StaticAnalysis\FileAnalyser;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Builder
{
    /**
     * @var FileAnalyser
     */
    private $analyser;

    public function __construct(FileAnalyser $analyser)
    {
        $this->analyser = $analyser;
    }

    public function build(CodeCoverage $coverage): Directory
    {
        $data       = clone $coverage->getData(); // clone because path munging is destructive to the original data
        $commonPath = $this->reducePaths($data);
>>>>>>> update
        $root       = new Directory(
            $commonPath,
            null
        );

        $this->addItems(
            $root,
<<<<<<< HEAD
            $this->buildDirectoryStructure($files),
            $coverage->getTests(),
            $coverage->getCacheTokens()
=======
            $this->buildDirectoryStructure($data),
            $coverage->getTests()
>>>>>>> update
        );

        return $root;
    }

<<<<<<< HEAD
    /**
     * @param Directory $root
     * @param array     $items
     * @param array     $tests
     * @param bool      $cacheTokens
     */
    private function addItems(Directory $root, array $items, array $tests, $cacheTokens)
    {
        foreach ($items as $key => $value) {
            if (substr($key, -2) == '/f') {
                $key = substr($key, 0, -2);

                if (file_exists($root->getPath() . DIRECTORY_SEPARATOR . $key)) {
                    $root->addFile($key, $value, $tests, $cacheTokens);
                }
            } else {
                $child = $root->addDirectory($key);
                $this->addItems($child, $value, $tests, $cacheTokens);
=======
    private function addItems(Directory $root, array $items, array $tests): void
    {
        foreach ($items as $key => $value) {
            $key = (string) $key;

            if (substr($key, -2) === '/f') {
                $key      = substr($key, 0, -2);
                $filename = $root->pathAsString() . DIRECTORY_SEPARATOR . $key;

                if (is_file($filename)) {
                    $root->addFile(
                        new File(
                            $key,
                            $root,
                            $value['lineCoverage'],
                            $value['functionCoverage'],
                            $tests,
                            $this->analyser->classesIn($filename),
                            $this->analyser->traitsIn($filename),
                            $this->analyser->functionsIn($filename),
                            $this->analyser->linesOfCodeFor($filename)
                        )
                    );
                }
            } else {
                $child = $root->addDirectory($key);

                $this->addItems($child, $value, $tests);
>>>>>>> update
            }
        }
    }

    /**
     * Builds an array representation of the directory structure.
     *
     * For instance,
     *
     * <code>
     * Array
     * (
     *     [Money.php] => Array
     *         (
     *             ...
     *         )
     *
     *     [MoneyBag.php] => Array
     *         (
     *             ...
     *         )
     * )
     * </code>
     *
     * is transformed into
     *
     * <code>
     * Array
     * (
     *     [.] => Array
     *         (
     *             [Money.php] => Array
     *                 (
     *                     ...
     *                 )
     *
     *             [MoneyBag.php] => Array
     *                 (
     *                     ...
     *                 )
     *         )
     * )
     * </code>
<<<<<<< HEAD
     *
     * @param array $files
     *
     * @return array
     */
    private function buildDirectoryStructure($files)
    {
        $result = [];

        foreach ($files as $path => $file) {
            $path    = explode('/', $path);
=======
     */
    private function buildDirectoryStructure(ProcessedCodeCoverageData $data): array
    {
        $result = [];

        foreach ($data->coveredFiles() as $originalPath) {
            $path    = explode(DIRECTORY_SEPARATOR, $originalPath);
>>>>>>> update
            $pointer = &$result;
            $max     = count($path);

            for ($i = 0; $i < $max; $i++) {
<<<<<<< HEAD
                if ($i == ($max - 1)) {
                    $type = '/f';
                } else {
                    $type = '';
=======
                $type = '';

                if ($i === ($max - 1)) {
                    $type = '/f';
>>>>>>> update
                }

                $pointer = &$pointer[$path[$i] . $type];
            }

<<<<<<< HEAD
            $pointer = $file;
=======
            $pointer = [
                'lineCoverage'     => $data->lineCoverage()[$originalPath] ?? [],
                'functionCoverage' => $data->functionCoverage()[$originalPath] ?? [],
            ];
>>>>>>> update
        }

        return $result;
    }

    /**
     * Reduces the paths by cutting the longest common start path.
     *
     * For instance,
     *
     * <code>
     * Array
     * (
     *     [/home/sb/Money/Money.php] => Array
     *         (
     *             ...
     *         )
     *
     *     [/home/sb/Money/MoneyBag.php] => Array
     *         (
     *             ...
     *         )
     * )
     * </code>
     *
     * is reduced to
     *
     * <code>
     * Array
     * (
     *     [Money.php] => Array
     *         (
     *             ...
     *         )
     *
     *     [MoneyBag.php] => Array
     *         (
     *             ...
     *         )
     * )
     * </code>
<<<<<<< HEAD
     *
     * @param array $files
     *
     * @return string
     */
    private function reducePaths(&$files)
    {
        if (empty($files)) {
=======
     */
    private function reducePaths(ProcessedCodeCoverageData $coverage): string
    {
        if (empty($coverage->coveredFiles())) {
>>>>>>> update
            return '.';
        }

        $commonPath = '';
<<<<<<< HEAD
        $paths      = array_keys($files);

        if (count($files) == 1) {
            $commonPath                 = dirname($paths[0]) . '/';
            $files[basename($paths[0])] = $files[$paths[0]];

            unset($files[$paths[0]]);
=======
        $paths      = $coverage->coveredFiles();

        if (count($paths) === 1) {
            $commonPath = dirname($paths[0]) . DIRECTORY_SEPARATOR;
            $coverage->renameFile($paths[0], basename($paths[0]));
>>>>>>> update

            return $commonPath;
        }

        $max = count($paths);

        for ($i = 0; $i < $max; $i++) {
            // strip phar:// prefixes
            if (strpos($paths[$i], 'phar://') === 0) {
                $paths[$i] = substr($paths[$i], 7);
<<<<<<< HEAD
                $paths[$i] = strtr($paths[$i], '/', DIRECTORY_SEPARATOR);
=======
                $paths[$i] = str_replace('/', DIRECTORY_SEPARATOR, $paths[$i]);
>>>>>>> update
            }
            $paths[$i] = explode(DIRECTORY_SEPARATOR, $paths[$i]);

            if (empty($paths[$i][0])) {
                $paths[$i][0] = DIRECTORY_SEPARATOR;
            }
        }

        $done = false;
        $max  = count($paths);

        while (!$done) {
            for ($i = 0; $i < $max - 1; $i++) {
                if (!isset($paths[$i][0]) ||
<<<<<<< HEAD
                    !isset($paths[$i+1][0]) ||
                    $paths[$i][0] != $paths[$i+1][0]) {
                    $done = true;
=======
                    !isset($paths[$i + 1][0]) ||
                    $paths[$i][0] !== $paths[$i + 1][0]) {
                    $done = true;

>>>>>>> update
                    break;
                }
            }

            if (!$done) {
                $commonPath .= $paths[0][0];

<<<<<<< HEAD
                if ($paths[0][0] != DIRECTORY_SEPARATOR) {
=======
                if ($paths[0][0] !== DIRECTORY_SEPARATOR) {
>>>>>>> update
                    $commonPath .= DIRECTORY_SEPARATOR;
                }

                for ($i = 0; $i < $max; $i++) {
                    array_shift($paths[$i]);
                }
            }
        }

<<<<<<< HEAD
        $original = array_keys($files);
        $max      = count($original);

        for ($i = 0; $i < $max; $i++) {
            $files[implode('/', $paths[$i])] = $files[$original[$i]];
            unset($files[$original[$i]]);
        }

        ksort($files);

=======
        $original = $coverage->coveredFiles();
        $max      = count($original);

        for ($i = 0; $i < $max; $i++) {
            $coverage->renameFile($original[$i], implode(DIRECTORY_SEPARATOR, $paths[$i]));
        }

>>>>>>> update
        return substr($commonPath, 0, -1);
    }
}
