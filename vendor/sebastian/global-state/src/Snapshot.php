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

use ReflectionClass;
use Serializable;
=======
namespace SebastianBergmann\GlobalState;

use const PHP_VERSION_ID;
use function array_keys;
use function array_merge;
use function array_reverse;
use function func_get_args;
use function get_declared_classes;
use function get_declared_interfaces;
use function get_declared_traits;
use function get_defined_constants;
use function get_defined_functions;
use function get_included_files;
use function in_array;
use function ini_get_all;
use function is_array;
use function is_object;
use function is_resource;
use function is_scalar;
use function serialize;
use function unserialize;
use ReflectionClass;
use SebastianBergmann\ObjectReflector\ObjectReflector;
use SebastianBergmann\RecursionContext\Context;
use Throwable;
>>>>>>> update

/**
 * A snapshot of global state.
 */
class Snapshot
{
    /**
<<<<<<< HEAD
     * @var Blacklist
     */
    private $blacklist;
=======
     * @var ExcludeList
     */
    private $excludeList;
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $globalVariables = array();
=======
    private $globalVariables = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $superGlobalArrays = array();
=======
    private $superGlobalArrays = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $superGlobalVariables = array();
=======
    private $superGlobalVariables = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $staticAttributes = array();
=======
    private $staticAttributes = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $iniSettings = array();
=======
    private $iniSettings = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $includedFiles = array();
=======
    private $includedFiles = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $constants = array();
=======
    private $constants = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $functions = array();
=======
    private $functions = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $interfaces = array();
=======
    private $interfaces = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $classes = array();
=======
    private $classes = [];
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $traits = array();

    /**
     * Creates a snapshot of the current global state.
     *
     * @param Blacklist $blacklist
     * @param bool      $includeGlobalVariables
     * @param bool      $includeStaticAttributes
     * @param bool      $includeConstants
     * @param bool      $includeFunctions
     * @param bool      $includeClasses
     * @param bool      $includeInterfaces
     * @param bool      $includeTraits
     * @param bool      $includeIniSettings
     * @param bool      $includeIncludedFiles
     */
    public function __construct(Blacklist $blacklist = null, $includeGlobalVariables = true, $includeStaticAttributes = true, $includeConstants = true, $includeFunctions = true, $includeClasses = true, $includeInterfaces = true, $includeTraits = true, $includeIniSettings = true, $includeIncludedFiles = true)
    {
        if ($blacklist === null) {
            $blacklist = new Blacklist;
        }

        $this->blacklist = $blacklist;
=======
    private $traits = [];

    /**
     * Creates a snapshot of the current global state.
     */
    public function __construct(ExcludeList $excludeList = null, bool $includeGlobalVariables = true, bool $includeStaticAttributes = true, bool $includeConstants = true, bool $includeFunctions = true, bool $includeClasses = true, bool $includeInterfaces = true, bool $includeTraits = true, bool $includeIniSettings = true, bool $includeIncludedFiles = true)
    {
        $this->excludeList = $excludeList ?: new ExcludeList;
>>>>>>> update

        if ($includeConstants) {
            $this->snapshotConstants();
        }

        if ($includeFunctions) {
            $this->snapshotFunctions();
        }

        if ($includeClasses || $includeStaticAttributes) {
            $this->snapshotClasses();
        }

        if ($includeInterfaces) {
            $this->snapshotInterfaces();
        }

        if ($includeGlobalVariables) {
            $this->setupSuperGlobalArrays();
            $this->snapshotGlobals();
        }

        if ($includeStaticAttributes) {
            $this->snapshotStaticAttributes();
        }

        if ($includeIniSettings) {
            $this->iniSettings = ini_get_all(null, false);
        }

        if ($includeIncludedFiles) {
            $this->includedFiles = get_included_files();
        }

<<<<<<< HEAD
        if (function_exists('get_declared_traits')) {
=======
        if ($includeTraits) {
>>>>>>> update
            $this->traits = get_declared_traits();
        }
    }

<<<<<<< HEAD
    /**
     * @return Blacklist
     */
    public function blacklist()
    {
        return $this->blacklist;
    }

    /**
     * @return array
     */
    public function globalVariables()
=======
    public function excludeList(): ExcludeList
    {
        return $this->excludeList;
    }

    public function globalVariables(): array
>>>>>>> update
    {
        return $this->globalVariables;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function superGlobalVariables()
=======
    public function superGlobalVariables(): array
>>>>>>> update
    {
        return $this->superGlobalVariables;
    }

<<<<<<< HEAD
    /**
     * Returns a list of all super-global variable arrays.
     *
     * @return array
     */
    public function superGlobalArrays()
=======
    public function superGlobalArrays(): array
>>>>>>> update
    {
        return $this->superGlobalArrays;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function staticAttributes()
=======
    public function staticAttributes(): array
>>>>>>> update
    {
        return $this->staticAttributes;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function iniSettings()
=======
    public function iniSettings(): array
>>>>>>> update
    {
        return $this->iniSettings;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function includedFiles()
=======
    public function includedFiles(): array
>>>>>>> update
    {
        return $this->includedFiles;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function constants()
=======
    public function constants(): array
>>>>>>> update
    {
        return $this->constants;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function functions()
=======
    public function functions(): array
>>>>>>> update
    {
        return $this->functions;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function interfaces()
=======
    public function interfaces(): array
>>>>>>> update
    {
        return $this->interfaces;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function classes()
=======
    public function classes(): array
>>>>>>> update
    {
        return $this->classes;
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function traits()
=======
    public function traits(): array
>>>>>>> update
    {
        return $this->traits;
    }

    /**
     * Creates a snapshot user-defined constants.
     */
<<<<<<< HEAD
    private function snapshotConstants()
=======
    private function snapshotConstants(): void
>>>>>>> update
    {
        $constants = get_defined_constants(true);

        if (isset($constants['user'])) {
            $this->constants = $constants['user'];
        }
    }

    /**
     * Creates a snapshot user-defined functions.
     */
<<<<<<< HEAD
    private function snapshotFunctions()
=======
    private function snapshotFunctions(): void
>>>>>>> update
    {
        $functions = get_defined_functions();

        $this->functions = $functions['user'];
    }

    /**
     * Creates a snapshot user-defined classes.
     */
<<<<<<< HEAD
    private function snapshotClasses()
=======
    private function snapshotClasses(): void
>>>>>>> update
    {
        foreach (array_reverse(get_declared_classes()) as $className) {
            $class = new ReflectionClass($className);

            if (!$class->isUserDefined()) {
                break;
            }

            $this->classes[] = $className;
        }

        $this->classes = array_reverse($this->classes);
    }

    /**
     * Creates a snapshot user-defined interfaces.
     */
<<<<<<< HEAD
    private function snapshotInterfaces()
=======
    private function snapshotInterfaces(): void
>>>>>>> update
    {
        foreach (array_reverse(get_declared_interfaces()) as $interfaceName) {
            $class = new ReflectionClass($interfaceName);

            if (!$class->isUserDefined()) {
                break;
            }

            $this->interfaces[] = $interfaceName;
        }

        $this->interfaces = array_reverse($this->interfaces);
    }

    /**
     * Creates a snapshot of all global and super-global variables.
     */
<<<<<<< HEAD
    private function snapshotGlobals()
=======
    private function snapshotGlobals(): void
>>>>>>> update
    {
        $superGlobalArrays = $this->superGlobalArrays();

        foreach ($superGlobalArrays as $superGlobalArray) {
            $this->snapshotSuperGlobalArray($superGlobalArray);
        }

        foreach (array_keys($GLOBALS) as $key) {
<<<<<<< HEAD
            if ($key != 'GLOBALS' &&
                !in_array($key, $superGlobalArrays) &&
                $this->canBeSerialized($GLOBALS[$key]) &&
                !$this->blacklist->isGlobalVariableBlacklisted($key)) {
=======
            if ($key !== 'GLOBALS' &&
                !in_array($key, $superGlobalArrays, true) &&
                $this->canBeSerialized($GLOBALS[$key]) &&
                !$this->excludeList->isGlobalVariableExcluded($key)) {
                /* @noinspection UnserializeExploitsInspection */
>>>>>>> update
                $this->globalVariables[$key] = unserialize(serialize($GLOBALS[$key]));
            }
        }
    }

    /**
     * Creates a snapshot a super-global variable array.
<<<<<<< HEAD
     *
     * @param $superGlobalArray
     */
    private function snapshotSuperGlobalArray($superGlobalArray)
    {
        $this->superGlobalVariables[$superGlobalArray] = array();

        if (isset($GLOBALS[$superGlobalArray]) && is_array($GLOBALS[$superGlobalArray])) {
            foreach ($GLOBALS[$superGlobalArray] as $key => $value) {
=======
     */
    private function snapshotSuperGlobalArray(string $superGlobalArray): void
    {
        $this->superGlobalVariables[$superGlobalArray] = [];

        if (isset($GLOBALS[$superGlobalArray]) && is_array($GLOBALS[$superGlobalArray])) {
            foreach ($GLOBALS[$superGlobalArray] as $key => $value) {
                /* @noinspection UnserializeExploitsInspection */
>>>>>>> update
                $this->superGlobalVariables[$superGlobalArray][$key] = unserialize(serialize($value));
            }
        }
    }

    /**
     * Creates a snapshot of all static attributes in user-defined classes.
     */
<<<<<<< HEAD
    private function snapshotStaticAttributes()
    {
        foreach ($this->classes as $className) {
            $class    = new ReflectionClass($className);
            $snapshot = array();
=======
    private function snapshotStaticAttributes(): void
    {
        foreach ($this->classes as $className) {
            $class    = new ReflectionClass($className);
            $snapshot = [];
>>>>>>> update

            foreach ($class->getProperties() as $attribute) {
                if ($attribute->isStatic()) {
                    $name = $attribute->getName();

<<<<<<< HEAD
                    if ($this->blacklist->isStaticAttributeBlacklisted($className, $name)) {
=======
                    if ($this->excludeList->isStaticAttributeExcluded($className, $name)) {
>>>>>>> update
                        continue;
                    }

                    $attribute->setAccessible(true);
<<<<<<< HEAD
                    $value = $attribute->getValue();

                    if ($this->canBeSerialized($value)) {
=======

                    if (PHP_VERSION_ID >= 70400 && !$attribute->isInitialized()) {
                        continue;
                    }

                    $value = $attribute->getValue();

                    if ($this->canBeSerialized($value)) {
                        /* @noinspection UnserializeExploitsInspection */
>>>>>>> update
                        $snapshot[$name] = unserialize(serialize($value));
                    }
                }
            }

            if (!empty($snapshot)) {
                $this->staticAttributes[$className] = $snapshot;
            }
        }
    }

    /**
     * Returns a list of all super-global variable arrays.
<<<<<<< HEAD
     *
     * @return array
     */
    private function setupSuperGlobalArrays()
    {
        $this->superGlobalArrays = array(
=======
     */
    private function setupSuperGlobalArrays(): void
    {
        $this->superGlobalArrays = [
>>>>>>> update
            '_ENV',
            '_POST',
            '_GET',
            '_COOKIE',
            '_SERVER',
            '_FILES',
<<<<<<< HEAD
            '_REQUEST'
        );

        if (ini_get('register_long_arrays') == '1') {
            $this->superGlobalArrays = array_merge(
                $this->superGlobalArrays,
                array(
                    'HTTP_ENV_VARS',
                    'HTTP_POST_VARS',
                    'HTTP_GET_VARS',
                    'HTTP_COOKIE_VARS',
                    'HTTP_SERVER_VARS',
                    'HTTP_POST_FILES'
                )
            );
        }
    }

    /**
     * @param  mixed $variable
     * @return bool
     * @todo   Implement this properly
     */
    private function canBeSerialized($variable)
    {
        if (!is_object($variable)) {
            return !is_resource($variable);
        }

        if ($variable instanceof \stdClass) {
            return true;
        }

        $class = new ReflectionClass($variable);

        do {
            if ($class->isInternal()) {
                return $variable instanceof Serializable;
            }
        } while ($class = $class->getParentClass());

        return true;
    }
=======
            '_REQUEST',
        ];
    }

    private function canBeSerialized($variable): bool
    {
        if (is_scalar($variable) || $variable === null) {
            return true;
        }

        if (is_resource($variable)) {
            return false;
        }

        foreach ($this->enumerateObjectsAndResources($variable) as $value) {
            if (is_resource($value)) {
                return false;
            }

            if (is_object($value)) {
                $class = new ReflectionClass($value);

                if ($class->isAnonymous()) {
                    return false;
                }

                try {
                    @serialize($value);
                } catch (Throwable $t) {
                    return false;
                }
            }
        }

        return true;
    }

    private function enumerateObjectsAndResources($variable): array
    {
        if (isset(func_get_args()[1])) {
            $processed = func_get_args()[1];
        } else {
            $processed = new Context;
        }

        $result = [];

        if ($processed->contains($variable)) {
            return $result;
        }

        $array = $variable;
        $processed->add($variable);

        if (is_array($variable)) {
            foreach ($array as $element) {
                if (!is_array($element) && !is_object($element) && !is_resource($element)) {
                    continue;
                }

                if (!is_resource($element)) {
                    /** @noinspection SlowArrayOperationsInLoopInspection */
                    $result = array_merge(
                        $result,
                        $this->enumerateObjectsAndResources($element, $processed)
                    );
                } else {
                    $result[] = $element;
                }
            }
        } else {
            $result[] = $variable;

            foreach ((new ObjectReflector)->getAttributes($variable) as $value) {
                if (!is_array($value) && !is_object($value) && !is_resource($value)) {
                    continue;
                }

                if (!is_resource($value)) {
                    /** @noinspection SlowArrayOperationsInLoopInspection */
                    $result = array_merge(
                        $result,
                        $this->enumerateObjectsAndResources($value, $processed)
                    );
                } else {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }
>>>>>>> update
}
