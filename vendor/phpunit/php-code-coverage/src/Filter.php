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

namespace SebastianBergmann\CodeCoverage;

/**
 * Filter for whitelisting of code coverage information.
 */
class Filter
{
    /**
     * Source files that are whitelisted.
     *
     * @var array
     */
    private $whitelistedFiles = [];

    /**
     * Adds a directory to the whitelist (recursively).
     *
     * @param string $directory
     * @param string $suffix
     * @param string $prefix
     */
    public function addDirectoryToWhitelist($directory, $suffix = '.php', $prefix = '')
    {
        $facade = new \File_Iterator_Facade;
        $files  = $facade->getFilesAsArray($directory, $suffix, $prefix);

        foreach ($files as $file) {
            $this->addFileToWhitelist($file);
=======
namespace SebastianBergmann\CodeCoverage;

use function array_keys;
use function is_file;
use function realpath;
use function strpos;
use SebastianBergmann\FileIterator\Facade as FileIteratorFacade;

final class Filter
{
    /**
     * @psalm-var array<string,true>
     */
    private $files = [];

    /**
     * @psalm-var array<string,bool>
     */
    private $isFileCache = [];

    public function includeDirectory(string $directory, string $suffix = '.php', string $prefix = ''): void
    {
        foreach ((new FileIteratorFacade)->getFilesAsArray($directory, $suffix, $prefix) as $file) {
            $this->includeFile($file);
>>>>>>> update
        }
    }

    /**
<<<<<<< HEAD
     * Adds a file to the whitelist.
     *
     * @param string $filename
     */
    public function addFileToWhitelist($filename)
    {
        $this->whitelistedFiles[realpath($filename)] = true;
    }

    /**
     * Adds files to the whitelist.
     *
     * @param array $files
     */
    public function addFilesToWhitelist(array $files)
    {
        foreach ($files as $file) {
            $this->addFileToWhitelist($file);
        }
    }

    /**
     * Removes a directory from the whitelist (recursively).
     *
     * @param string $directory
     * @param string $suffix
     * @param string $prefix
     */
    public function removeDirectoryFromWhitelist($directory, $suffix = '.php', $prefix = '')
    {
        $facade = new \File_Iterator_Facade;
        $files  = $facade->getFilesAsArray($directory, $suffix, $prefix);

        foreach ($files as $file) {
            $this->removeFileFromWhitelist($file);
        }
    }

    /**
     * Removes a file from the whitelist.
     *
     * @param string $filename
     */
    public function removeFileFromWhitelist($filename)
    {
        $filename = realpath($filename);

        unset($this->whitelistedFiles[$filename]);
    }

    /**
     * Checks whether a filename is a real filename.
     *
     * @param string $filename
     *
     * @return bool
     */
    public function isFile($filename)
    {
        if ($filename == '-' ||
=======
     * @psalm-param list<string> $files
     */
    public function includeFiles(array $filenames): void
    {
        foreach ($filenames as $filename) {
            $this->includeFile($filename);
        }
    }

    public function includeFile(string $filename): void
    {
        $filename = realpath($filename);

        if (!$filename) {
            return;
        }

        $this->files[$filename] = true;
    }

    public function excludeDirectory(string $directory, string $suffix = '.php', string $prefix = ''): void
    {
        foreach ((new FileIteratorFacade)->getFilesAsArray($directory, $suffix, $prefix) as $file) {
            $this->excludeFile($file);
        }
    }

    public function excludeFile(string $filename): void
    {
        $filename = realpath($filename);

        if (!$filename || !isset($this->files[$filename])) {
            return;
        }

        unset($this->files[$filename]);
    }

    public function isFile(string $filename): bool
    {
        if (isset($this->isFileCache[$filename])) {
            return $this->isFileCache[$filename];
        }

        if ($filename === '-' ||
>>>>>>> update
            strpos($filename, 'vfs://') === 0 ||
            strpos($filename, 'xdebug://debug-eval') !== false ||
            strpos($filename, 'eval()\'d code') !== false ||
            strpos($filename, 'runtime-created function') !== false ||
            strpos($filename, 'runkit created function') !== false ||
            strpos($filename, 'assert code') !== false ||
<<<<<<< HEAD
            strpos($filename, 'regexp code') !== false) {
            return false;
        }

        return file_exists($filename);
    }

    /**
     * Checks whether or not a file is filtered.
     *
     * @param string $filename
     *
     * @return bool
     */
    public function isFiltered($filename)
    {
        if (!$this->isFile($filename)) {
            return true;
        }

        $filename = realpath($filename);

        return !isset($this->whitelistedFiles[$filename]);
    }

    /**
     * Returns the list of whitelisted files.
     *
     * @return array
     */
    public function getWhitelist()
    {
        return array_keys($this->whitelistedFiles);
    }

    /**
     * Returns whether this filter has a whitelist.
     *
     * @return bool
     */
    public function hasWhitelist()
    {
        return !empty($this->whitelistedFiles);
    }

    /**
     * Returns the whitelisted files.
     *
     * @return array
     */
    public function getWhitelistedFiles()
    {
        return $this->whitelistedFiles;
    }

    /**
     * Sets the whitelisted files.
     *
     * @param array $whitelistedFiles
     */
    public function setWhitelistedFiles($whitelistedFiles)
    {
        $this->whitelistedFiles = $whitelistedFiles;
=======
            strpos($filename, 'regexp code') !== false ||
            strpos($filename, 'Standard input code') !== false) {
            $isFile = false;
        } else {
            $isFile = is_file($filename);
        }

        $this->isFileCache[$filename] = $isFile;

        return $isFile;
    }

    public function isExcluded(string $filename): bool
    {
        return !isset($this->files[$filename]) || !$this->isFile($filename);
    }

    /**
     * @psalm-return list<string>
     */
    public function files(): array
    {
        return array_keys($this->files);
    }

    public function isEmpty(): bool
    {
        return empty($this->files);
>>>>>>> update
    }
}
