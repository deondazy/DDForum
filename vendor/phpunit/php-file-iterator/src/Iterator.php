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
 * FilterIterator implementation that filters files based on prefix(es) and/or
 * suffix(es). Hidden files and files from hidden directories are also filtered.
 *
 * @since     Class available since Release 1.0.0
 */
class File_Iterator extends FilterIterator
{
    const PREFIX = 0;
    const SUFFIX = 1;

    /**
     * @var array
     */
    protected $suffixes = array();

    /**
     * @var array
     */
    protected $prefixes = array();

    /**
     * @var array
     */
    protected $exclude = array();
=======
namespace SebastianBergmann\FileIterator;

use function array_filter;
use function array_map;
use function preg_match;
use function realpath;
use function str_replace;
use function strlen;
use function strpos;
use function substr;
use FilterIterator;

class Iterator extends FilterIterator
{
    public const PREFIX = 0;

    public const SUFFIX = 1;
>>>>>>> update

    /**
     * @var string
     */
<<<<<<< HEAD
    protected $basepath;

    /**
     * @param Iterator $iterator
     * @param array    $suffixes
     * @param array    $prefixes
     * @param array    $exclude
     * @param string   $basepath
     */
    public function __construct(Iterator $iterator, array $suffixes = array(), array $prefixes = array(), array $exclude = array(), $basepath = NULL)
    {
        $exclude = array_filter(array_map('realpath', $exclude));

        if ($basepath !== NULL) {
            $basepath = realpath($basepath);
        }

        if ($basepath === FALSE) {
            $basepath = NULL;
        } else {
            foreach ($exclude as &$_exclude) {
                $_exclude = str_replace($basepath, '', $_exclude);
            }
        }

        $this->prefixes = $prefixes;
        $this->suffixes = $suffixes;
        $this->exclude  = $exclude;
        $this->basepath = $basepath;
=======
    private $basePath;

    /**
     * @var array
     */
    private $suffixes = [];

    /**
     * @var array
     */
    private $prefixes = [];

    /**
     * @var array
     */
    private $exclude = [];

    public function __construct(string $basePath, \Iterator $iterator, array $suffixes = [], array $prefixes = [], array $exclude = [])
    {
        $this->basePath = realpath($basePath);
        $this->prefixes = $prefixes;
        $this->suffixes = $suffixes;
        $this->exclude  = array_filter(array_map('realpath', $exclude));
>>>>>>> update

        parent::__construct($iterator);
    }

<<<<<<< HEAD
    /**
     * @return bool
     */
    public function accept()
    {
        $current  = $this->getInnerIterator()->current();
        $filename = $current->getFilename();
        $realpath = $current->getRealPath();

        if ($this->basepath !== NULL) {
            $realpath = str_replace($this->basepath, '', $realpath);
        }

        // Filter files in hidden directories.
        if (preg_match('=/\.[^/]*/=', $realpath)) {
            return FALSE;
        }

        return $this->acceptPath($realpath) &&
=======
    public function accept(): bool
    {
        $current  = $this->getInnerIterator()->current();
        $filename = $current->getFilename();
        $realPath = $current->getRealPath();

        if ($realPath === false) {
            return false;
        }

        return $this->acceptPath($realPath) &&
>>>>>>> update
               $this->acceptPrefix($filename) &&
               $this->acceptSuffix($filename);
    }

<<<<<<< HEAD
    /**
     * @param  string $path
     * @return bool
     * @since  Method available since Release 1.1.0
     */
    protected function acceptPath($path)
    {
        foreach ($this->exclude as $exclude) {
            if (strpos($path, $exclude) === 0) {
                return FALSE;
            }
        }

        return TRUE;
    }

    /**
     * @param  string $filename
     * @return bool
     * @since  Method available since Release 1.1.0
     */
    protected function acceptPrefix($filename)
=======
    private function acceptPath(string $path): bool
    {
        // Filter files in hidden directories by checking path that is relative to the base path.
        if (preg_match('=/\.[^/]*/=', str_replace($this->basePath, '', $path))) {
            return false;
        }

        foreach ($this->exclude as $exclude) {
            if (strpos($path, $exclude) === 0) {
                return false;
            }
        }

        return true;
    }

    private function acceptPrefix(string $filename): bool
>>>>>>> update
    {
        return $this->acceptSubString($filename, $this->prefixes, self::PREFIX);
    }

<<<<<<< HEAD
    /**
     * @param  string $filename
     * @return bool
     * @since  Method available since Release 1.1.0
     */
    protected function acceptSuffix($filename)
=======
    private function acceptSuffix(string $filename): bool
>>>>>>> update
    {
        return $this->acceptSubString($filename, $this->suffixes, self::SUFFIX);
    }

<<<<<<< HEAD
    /**
     * @param  string $filename
     * @param  array  $subString
     * @param  int    $type
     * @return bool
     * @since  Method available since Release 1.1.0
     */
    protected function acceptSubString($filename, array $subStrings, $type)
    {
        if (empty($subStrings)) {
            return TRUE;
        }

        $matched = FALSE;

        foreach ($subStrings as $string) {
            if (($type == self::PREFIX && strpos($filename, $string) === 0) ||
                ($type == self::SUFFIX &&
                 substr($filename, -1 * strlen($string)) == $string)) {
                $matched = TRUE;
=======
    private function acceptSubString(string $filename, array $subStrings, int $type): bool
    {
        if (empty($subStrings)) {
            return true;
        }

        $matched = false;

        foreach ($subStrings as $string) {
            if (($type === self::PREFIX && strpos($filename, $string) === 0) ||
                ($type === self::SUFFIX &&
                 substr($filename, -1 * strlen($string)) === $string)) {
                $matched = true;

>>>>>>> update
                break;
            }
        }

        return $matched;
    }
}
