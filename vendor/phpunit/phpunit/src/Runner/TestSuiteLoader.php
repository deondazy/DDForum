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
 * An interface to define how a test suite should be loaded.
 *
 * @since      Interface available since Release 2.0.0
 */
interface PHPUnit_Runner_TestSuiteLoader
{
    /**
     * @param string $suiteClassName
     * @param string $suiteClassFile
     *
     * @return ReflectionClass
     */
    public function load($suiteClassName, $suiteClassFile = '');

    /**
     * @param ReflectionClass $aClass
     *
     * @return ReflectionClass
     */
    public function reload(ReflectionClass $aClass);
=======
namespace PHPUnit\Runner;

use ReflectionClass;

/**
 * @deprecated see https://github.com/sebastianbergmann/phpunit/issues/4039
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
interface TestSuiteLoader
{
    public function load(string $suiteClassFile): ReflectionClass;

    public function reload(ReflectionClass $aClass): ReflectionClass;
>>>>>>> update
}
