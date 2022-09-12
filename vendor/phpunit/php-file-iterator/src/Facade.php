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
 * Façade implementation that uses File_Iterator_Factory to create a
 * File_Iterator that operates on an AppendIterator that contains an
 * RecursiveDirectoryIterator for each given path. The list of unique
 * files is returned as an array.
 *
 * @since     Class available since Release 1.3.0
 */
class File_Iterator_Facade
{
    /**
     * @param  array|string $paths
     * @param  array|string $suffixes
     * @param  array|string $prefixes
     * @param  array        $exclude
     * @param  bool         $commonPath
     * @return array
     */
    public function getFilesAsArray($paths, $suffixes = '', $prefixes = '', array $exclude = array(), $commonPath = FALSE)
    {
        if (is_string($paths)) {
            $paths = array($paths);
        }

        $factory  = new File_Iterator_Factory;
        $iterator = $factory->getFileIterator(
          $paths, $suffixes, $prefixes, $exclude
        );

        $files = array();
=======
namespace SebastianBergmann\FileIterator;

use const DIRECTORY_SEPARATOR;
use function array_unique;
use function count;
use function dirname;
use function explode;
use function is_file;
use function is_string;
use function realpath;
use function sort;

class Facade
{
    /**
     * @param array|string $paths
     * @param array|string $suffixes
     * @param array|string $prefixes
     */
    public function getFilesAsArray($paths, $suffixes = '', $prefixes = '', array $exclude = [], bool $commonPath = false): array
    {
        if (is_string($paths)) {
            $paths = [$paths];
        }

        $iterator = (new Factory)->getFileIterator($paths, $suffixes, $prefixes, $exclude);

        $files = [];
>>>>>>> update

        foreach ($iterator as $file) {
            $file = $file->getRealPath();

            if ($file) {
                $files[] = $file;
            }
        }

        foreach ($paths as $path) {
            if (is_file($path)) {
                $files[] = realpath($path);
            }
        }

        $files = array_unique($files);
        sort($files);

        if ($commonPath) {
<<<<<<< HEAD
            return array(
              'commonPath' => $this->getCommonPath($files),
              'files'      => $files
            );
        } else {
            return $files;
        }
    }

    /**
     * Returns the common path of a set of files.
     *
     * @param  array  $files
     * @return string
     */
    protected function getCommonPath(array $files)
    {
        $count = count($files);

        if ($count == 0) {
            return '';
        }

        if ($count == 1) {
            return dirname($files[0]) . DIRECTORY_SEPARATOR;
        }

        $_files = array();
=======
            return [
                'commonPath' => $this->getCommonPath($files),
                'files'      => $files,
            ];
        }

        return $files;
    }

    protected function getCommonPath(array $files): string
    {
        $count = count($files);

        if ($count === 0) {
            return '';
        }

        if ($count === 1) {
            return dirname($files[0]) . DIRECTORY_SEPARATOR;
        }

        $_files = [];
>>>>>>> update

        foreach ($files as $file) {
            $_files[] = $_fileParts = explode(DIRECTORY_SEPARATOR, $file);

            if (empty($_fileParts[0])) {
                $_fileParts[0] = DIRECTORY_SEPARATOR;
            }
        }

        $common = '';
<<<<<<< HEAD
        $done   = FALSE;
=======
        $done   = false;
>>>>>>> update
        $j      = 0;
        $count--;

        while (!$done) {
            for ($i = 0; $i < $count; $i++) {
<<<<<<< HEAD
                if ($_files[$i][$j] != $_files[$i+1][$j]) {
                    $done = TRUE;
=======
                if ($_files[$i][$j] != $_files[$i + 1][$j]) {
                    $done = true;

>>>>>>> update
                    break;
                }
            }

            if (!$done) {
                $common .= $_files[0][$j];

                if ($j > 0) {
                    $common .= DIRECTORY_SEPARATOR;
                }
            }

            $j++;
        }

        return DIRECTORY_SEPARATOR . $common;
    }
}
