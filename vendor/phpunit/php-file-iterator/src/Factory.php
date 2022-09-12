<<<<<<< HEAD
<?php
/*
 * This file is part of the File_Iterator package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-file-iterator.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

/**
 * Factory Method implementation that creates a File_Iterator that operates on
 * an AppendIterator that contains an RecursiveDirectoryIterator for each given
 * path.
 *
 * @since     Class available since Release 1.1.0
 */
class File_Iterator_Factory
{
    /**
     * @param  array|string   $paths
     * @param  array|string   $suffixes
     * @param  array|string   $prefixes
     * @param  array          $exclude
     * @return AppendIterator
     */
    public function getFileIterator($paths, $suffixes = '', $prefixes = '', array $exclude = array())
    {
        if (is_string($paths)) {
            $paths = array($paths);
=======
namespace SebastianBergmann\FileIterator;

use const GLOB_ONLYDIR;
use function array_filter;
use function array_map;
use function array_merge;
use function glob;
use function is_dir;
use function is_string;
use function realpath;
use AppendIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Factory
{
    /**
     * @param array|string $paths
     * @param array|string $suffixes
     * @param array|string $prefixes
     */
    public function getFileIterator($paths, $suffixes = '', $prefixes = '', array $exclude = []): AppendIterator
    {
        if (is_string($paths)) {
            $paths = [$paths];
>>>>>>> update
        }

        $paths   = $this->getPathsAfterResolvingWildcards($paths);
        $exclude = $this->getPathsAfterResolvingWildcards($exclude);

        if (is_string($prefixes)) {
<<<<<<< HEAD
            if ($prefixes != '') {
                $prefixes = array($prefixes);
            } else {
                $prefixes = array();
=======
            if ($prefixes !== '') {
                $prefixes = [$prefixes];
            } else {
                $prefixes = [];
>>>>>>> update
            }
        }

        if (is_string($suffixes)) {
<<<<<<< HEAD
            if ($suffixes != '') {
                $suffixes = array($suffixes);
            } else {
                $suffixes = array();
=======
            if ($suffixes !== '') {
                $suffixes = [$suffixes];
            } else {
                $suffixes = [];
>>>>>>> update
            }
        }

        $iterator = new AppendIterator;

        foreach ($paths as $path) {
            if (is_dir($path)) {
                $iterator->append(
<<<<<<< HEAD
                  new File_Iterator(
                    new RecursiveIteratorIterator(
                      new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
                    ),
                    $suffixes,
                    $prefixes,
                    $exclude,
                    $path
                  )
=======
                    new Iterator(
                        $path,
                        new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::FOLLOW_SYMLINKS | RecursiveDirectoryIterator::SKIP_DOTS)
                        ),
                        $suffixes,
                        $prefixes,
                        $exclude
                    )
>>>>>>> update
                );
            }
        }

        return $iterator;
    }

<<<<<<< HEAD
    /**
     * @param  array $paths
     * @return array
     */
    protected function getPathsAfterResolvingWildcards(array $paths)
    {
        $_paths = array();

        foreach ($paths as $path) {
            if ($locals = glob($path, GLOB_ONLYDIR)) {
                $_paths = array_merge($_paths, $locals);
            } else {
                $_paths[] = $path;
            }
        }

        return $_paths;
=======
    protected function getPathsAfterResolvingWildcards(array $paths): array
    {
        $_paths = [[]];

        foreach ($paths as $path) {
            if ($locals = glob($path, GLOB_ONLYDIR)) {
                $_paths[] = array_map('\realpath', $locals);
            } else {
                $_paths[] = [realpath($path)];
            }
        }

        return array_filter(array_merge(...$_paths));
>>>>>>> update
    }
}
