<<<<<<< HEAD
<?php
=======
<?php declare(strict_types=1);
>>>>>>> update
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

/**
 * Utility methods to load PHP sourcefiles.
 *
 * @since Class available since Release 2.3.0
 */
class PHPUnit_Util_Fileloader
{
    /**
     * Checks if a PHP sourcefile is readable.
     * The sourcefile is loaded through the load() method.
     *
     * @param string $filename
     *
     * @return string
     *
     * @throws PHPUnit_Framework_Exception
     */
    public static function checkAndLoad($filename)
    {
        $includePathFilename = stream_resolve_include_path($filename);

        if (!$includePathFilename || !is_readable($includePathFilename)) {
            throw new PHPUnit_Framework_Exception(
=======
namespace PHPUnit\Util;

use const DIRECTORY_SEPARATOR;
use function array_diff;
use function array_keys;
use function fopen;
use function get_defined_vars;
use function sprintf;
use function stream_resolve_include_path;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class FileLoader
{
    /**
     * Checks if a PHP sourcecode file is readable. The sourcecode file is loaded through the load() method.
     *
     * As a fallback, PHP looks in the directory of the file executing the stream_resolve_include_path function.
     * We do not want to load the Test.php file here, so skip it if it found that.
     * PHP prioritizes the include_path setting, so if the current directory is in there, it will first look in the
     * current working directory.
     *
     * @throws Exception
     */
    public static function checkAndLoad(string $filename): string
    {
        $includePathFilename = stream_resolve_include_path($filename);

        $localFile = __DIR__ . DIRECTORY_SEPARATOR . $filename;

        if (!$includePathFilename ||
            $includePathFilename === $localFile ||
            !self::isReadable($includePathFilename)) {
            throw new Exception(
>>>>>>> update
                sprintf('Cannot open file "%s".' . "\n", $filename)
            );
        }

        self::load($includePathFilename);

        return $includePathFilename;
    }

    /**
     * Loads a PHP sourcefile.
<<<<<<< HEAD
     *
     * @param string $filename
     *
     * @return mixed
     *
     * @since Method available since Release 3.0.0
     */
    public static function load($filename)
    {
        $oldVariableNames = array_keys(get_defined_vars());

        include_once $filename;

        $newVariables     = get_defined_vars();
        $newVariableNames = array_diff(
            array_keys($newVariables),
            $oldVariableNames
        );

        foreach ($newVariableNames as $variableName) {
            if ($variableName != 'oldVariableNames') {
                $GLOBALS[$variableName] = $newVariables[$variableName];
            }
        }

        return $filename;
=======
     */
    public static function load(string $filename): void
    {
        $oldVariableNames = array_keys(get_defined_vars());

        /**
         * @noinspection PhpIncludeInspection
         * @psalm-suppress UnresolvableInclude
         */
        include_once $filename;

        $newVariables = get_defined_vars();

        foreach (array_diff(array_keys($newVariables), $oldVariableNames) as $variableName) {
            if ($variableName !== 'oldVariableNames') {
                $GLOBALS[$variableName] = $newVariables[$variableName];
            }
        }
    }

    /**
     * @see https://github.com/sebastianbergmann/phpunit/pull/2751
     */
    private static function isReadable(string $filename): bool
    {
        return @fopen($filename, 'r') !== false;
>>>>>>> update
    }
}
