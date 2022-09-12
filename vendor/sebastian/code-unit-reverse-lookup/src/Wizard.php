<<<<<<< HEAD
<?php
/*
 * This file is part of code-unit-reverse-lookup.
=======
<?php declare(strict_types=1);
/*
 * This file is part of sebastian/code-unit-reverse-lookup.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

namespace SebastianBergmann\CodeUnitReverseLookup;

=======
namespace SebastianBergmann\CodeUnitReverseLookup;

use function array_merge;
use function assert;
use function get_declared_classes;
use function get_declared_traits;
use function get_defined_functions;
use function is_array;
use function range;
use ReflectionClass;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;

>>>>>>> update
/**
 * @since Class available since Release 1.0.0
 */
class Wizard
{
    /**
     * @var array
     */
    private $lookupTable = [];

    /**
     * @var array
     */
    private $processedClasses = [];

    /**
     * @var array
     */
    private $processedFunctions = [];

    /**
     * @param string $filename
     * @param int    $lineNumber
     *
     * @return string
     */
    public function lookup($filename, $lineNumber)
    {
        if (!isset($this->lookupTable[$filename][$lineNumber])) {
            $this->updateLookupTable();
        }

        if (isset($this->lookupTable[$filename][$lineNumber])) {
            return $this->lookupTable[$filename][$lineNumber];
<<<<<<< HEAD
        } else {
            return $filename . ':' . $lineNumber;
        }
    }

    private function updateLookupTable()
=======
        }

        return $filename . ':' . $lineNumber;
    }

    private function updateLookupTable(): void
>>>>>>> update
    {
        $this->processClassesAndTraits();
        $this->processFunctions();
    }

<<<<<<< HEAD
    private function processClassesAndTraits()
    {
        foreach (array_merge(get_declared_classes(), get_declared_traits()) as $classOrTrait) {
=======
    private function processClassesAndTraits(): void
    {
        $classes = get_declared_classes();
        $traits  = get_declared_traits();

        assert(is_array($classes));
        assert(is_array($traits));

        foreach (array_merge($classes, $traits) as $classOrTrait) {
>>>>>>> update
            if (isset($this->processedClasses[$classOrTrait])) {
                continue;
            }

<<<<<<< HEAD
            $reflector = new \ReflectionClass($classOrTrait);
=======
            $reflector = new ReflectionClass($classOrTrait);
>>>>>>> update

            foreach ($reflector->getMethods() as $method) {
                $this->processFunctionOrMethod($method);
            }

            $this->processedClasses[$classOrTrait] = true;
        }
    }

<<<<<<< HEAD
    private function processFunctions()
=======
    private function processFunctions(): void
>>>>>>> update
    {
        foreach (get_defined_functions()['user'] as $function) {
            if (isset($this->processedFunctions[$function])) {
                continue;
            }

<<<<<<< HEAD
            $this->processFunctionOrMethod(new \ReflectionFunction($function));
=======
            $this->processFunctionOrMethod(new ReflectionFunction($function));
>>>>>>> update

            $this->processedFunctions[$function] = true;
        }
    }

<<<<<<< HEAD
    /**
     * @param \ReflectionFunctionAbstract $functionOrMethod
     */
    private function processFunctionOrMethod(\ReflectionFunctionAbstract $functionOrMethod)
=======
    private function processFunctionOrMethod(ReflectionFunctionAbstract $functionOrMethod): void
>>>>>>> update
    {
        if ($functionOrMethod->isInternal()) {
            return;
        }

        $name = $functionOrMethod->getName();

<<<<<<< HEAD
        if ($functionOrMethod instanceof \ReflectionMethod) {
=======
        if ($functionOrMethod instanceof ReflectionMethod) {
>>>>>>> update
            $name = $functionOrMethod->getDeclaringClass()->getName() . '::' . $name;
        }

        if (!isset($this->lookupTable[$functionOrMethod->getFileName()])) {
            $this->lookupTable[$functionOrMethod->getFileName()] = [];
        }

        foreach (range($functionOrMethod->getStartLine(), $functionOrMethod->getEndLine()) as $line) {
            $this->lookupTable[$functionOrMethod->getFileName()][$line] = $name;
        }
    }
}
