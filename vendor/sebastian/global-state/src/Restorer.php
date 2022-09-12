<<<<<<< HEAD
<?php
/*
 * This file is part of the GlobalState package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of sebastian/global-state.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

namespace SebastianBergmann\GlobalState;

=======
namespace SebastianBergmann\GlobalState;

use function array_diff;
use function array_key_exists;
use function array_keys;
use function array_merge;
use function function_exists;
use function get_defined_functions;
use function in_array;
use function is_array;
use ReflectionClass;
>>>>>>> update
use ReflectionProperty;

/**
 * Restorer of snapshots of global state.
 */
class Restorer
{
    /**
     * Deletes function definitions that are not defined in a snapshot.
     *
<<<<<<< HEAD
     * @param  Snapshot         $snapshot
     * @throws RuntimeException when the uopz_delete() function is not available
     * @see    https://github.com/krakjoe/uopz
     */
    public function restoreFunctions(Snapshot $snapshot)
=======
     * @throws RuntimeException when the uopz_delete() function is not available
     *
     * @see https://github.com/krakjoe/uopz
     */
    public function restoreFunctions(Snapshot $snapshot): void
>>>>>>> update
    {
        if (!function_exists('uopz_delete')) {
            throw new RuntimeException('The uopz_delete() function is required for this operation');
        }

        $functions = get_defined_functions();

        foreach (array_diff($functions['user'], $snapshot->functions()) as $function) {
            uopz_delete($function);
        }
    }

    /**
     * Restores all global and super-global variables from a snapshot.
<<<<<<< HEAD
     *
     * @param Snapshot $snapshot
     */
    public function restoreGlobalVariables(Snapshot $snapshot)
=======
     */
    public function restoreGlobalVariables(Snapshot $snapshot): void
>>>>>>> update
    {
        $superGlobalArrays = $snapshot->superGlobalArrays();

        foreach ($superGlobalArrays as $superGlobalArray) {
            $this->restoreSuperGlobalArray($snapshot, $superGlobalArray);
        }

        $globalVariables = $snapshot->globalVariables();

        foreach (array_keys($GLOBALS) as $key) {
<<<<<<< HEAD
            if ($key != 'GLOBALS' &&
                !in_array($key, $superGlobalArrays) &&
                !$snapshot->blacklist()->isGlobalVariableBlacklisted($key)) {
                if (isset($globalVariables[$key])) {
=======
            if ($key !== 'GLOBALS' &&
                !in_array($key, $superGlobalArrays, true) &&
                !$snapshot->excludeList()->isGlobalVariableExcluded($key)) {
                if (array_key_exists($key, $globalVariables)) {
>>>>>>> update
                    $GLOBALS[$key] = $globalVariables[$key];
                } else {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }

    /**
     * Restores all static attributes in user-defined classes from this snapshot.
<<<<<<< HEAD
     *
     * @param Snapshot $snapshot
     */
    public function restoreStaticAttributes(Snapshot $snapshot)
    {
        $current    = new Snapshot($snapshot->blacklist(), false, false, false, false, true, false, false, false, false);
        $newClasses = array_diff($current->classes(), $snapshot->classes());
=======
     */
    public function restoreStaticAttributes(Snapshot $snapshot): void
    {
        $current    = new Snapshot($snapshot->excludeList(), false, false, false, false, true, false, false, false, false);
        $newClasses = array_diff($current->classes(), $snapshot->classes());

>>>>>>> update
        unset($current);

        foreach ($snapshot->staticAttributes() as $className => $staticAttributes) {
            foreach ($staticAttributes as $name => $value) {
                $reflector = new ReflectionProperty($className, $name);
                $reflector->setAccessible(true);
                $reflector->setValue($value);
            }
        }

        foreach ($newClasses as $className) {
<<<<<<< HEAD
            $class    = new \ReflectionClass($className);
=======
            $class    = new ReflectionClass($className);
>>>>>>> update
            $defaults = $class->getDefaultProperties();

            foreach ($class->getProperties() as $attribute) {
                if (!$attribute->isStatic()) {
                    continue;
                }

                $name = $attribute->getName();

<<<<<<< HEAD
                if ($snapshot->blacklist()->isStaticAttributeBlacklisted($className, $name)) {
=======
                if ($snapshot->excludeList()->isStaticAttributeExcluded($className, $name)) {
>>>>>>> update
                    continue;
                }

                if (!isset($defaults[$name])) {
                    continue;
                }

                $attribute->setAccessible(true);
                $attribute->setValue($defaults[$name]);
            }
        }
    }

    /**
     * Restores a super-global variable array from this snapshot.
<<<<<<< HEAD
     *
     * @param Snapshot $snapshot
     * @param $superGlobalArray
     */
    private function restoreSuperGlobalArray(Snapshot $snapshot, $superGlobalArray)
=======
     */
    private function restoreSuperGlobalArray(Snapshot $snapshot, string $superGlobalArray): void
>>>>>>> update
    {
        $superGlobalVariables = $snapshot->superGlobalVariables();

        if (isset($GLOBALS[$superGlobalArray]) &&
            is_array($GLOBALS[$superGlobalArray]) &&
            isset($superGlobalVariables[$superGlobalArray])) {
            $keys = array_keys(
                array_merge(
                    $GLOBALS[$superGlobalArray],
                    $superGlobalVariables[$superGlobalArray]
                )
            );

            foreach ($keys as $key) {
                if (isset($superGlobalVariables[$superGlobalArray][$key])) {
                    $GLOBALS[$superGlobalArray][$key] = $superGlobalVariables[$superGlobalArray][$key];
                } else {
                    unset($GLOBALS[$superGlobalArray][$key]);
                }
            }
        }
    }
}
