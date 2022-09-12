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
 * This class defines the current version of PHPUnit.
 *
 * @since Class available since Release 2.0.0
 */
class PHPUnit_Runner_Version
{
    private static $pharVersion;
    private static $version;

    /**
     * Returns the current version of PHPUnit.
     *
     * @return string
     */
    public static function id()
    {
        if (self::$pharVersion !== null) {
            return self::$pharVersion;
        }

        if (self::$version === null) {
            $version       = new SebastianBergmann\Version('5.6.2', dirname(dirname(__DIR__)));
            self::$version = $version->getVersion();
=======
namespace PHPUnit\Runner;

use function array_slice;
use function dirname;
use function explode;
use function implode;
use function strpos;
use SebastianBergmann\Version as VersionId;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class Version
{
    /**
     * @var string
     */
    private static $pharVersion = '';

    /**
     * @var string
     */
    private static $version = '';

    /**
     * Returns the current version of PHPUnit.
     */
    public static function id(): string
    {
        if (self::$pharVersion !== '') {
            return self::$pharVersion;
        }

        if (self::$version === '') {
            self::$version = (new VersionId('9.5.24', dirname(__DIR__, 2)))->getVersion();
>>>>>>> update
        }

        return self::$version;
    }

<<<<<<< HEAD
    /**
     * @return string
     *
     * @since Method available since Release 4.8.13
     */
    public static function series()
=======
    public static function series(): string
>>>>>>> update
    {
        if (strpos(self::id(), '-')) {
            $version = explode('-', self::id())[0];
        } else {
            $version = self::id();
        }

        return implode('.', array_slice(explode('.', $version), 0, 2));
    }

<<<<<<< HEAD
    /**
     * @return string
     */
    public static function getVersionString()
    {
        return 'PHPUnit ' . self::id() . ' by Sebastian Bergmann and contributors.';
    }

    /**
     * @return string
     *
     * @since Method available since Release 4.0.0
     */
    public static function getReleaseChannel()
    {
        if (strpos(self::$pharVersion, '-') !== false) {
            return '-nightly';
        }

        return '';
=======
    public static function getVersionString(): string
    {
        return 'PHPUnit ' . self::id() . ' #StandWithUkraine';
>>>>>>> update
    }
}
