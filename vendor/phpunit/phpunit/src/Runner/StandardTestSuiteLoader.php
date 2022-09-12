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
 * The standard test suite loader.
 *
 * @since Class available since Release 2.0.0
 */
class PHPUnit_Runner_StandardTestSuiteLoader implements PHPUnit_Runner_TestSuiteLoader
{
    /**
     * @param string $suiteClassName
     * @param string $suiteClassFile
     *
     * @return ReflectionClass
     *
     * @throws PHPUnit_Framework_Exception
     */
    public function load($suiteClassName, $suiteClassFile = '')
    {
        $suiteClassName = str_replace('.php', '', $suiteClassName);

        if (empty($suiteClassFile)) {
            $suiteClassFile = PHPUnit_Util_Filesystem::classNameToFilename(
                $suiteClassName
            );
        }

        if (!class_exists($suiteClassName, false)) {
            $loadedClasses = get_declared_classes();

            $filename = PHPUnit_Util_Fileloader::checkAndLoad($suiteClassFile);
=======
namespace PHPUnit\Runner;

use function array_diff;
use function array_values;
use function basename;
use function class_exists;
use function get_declared_classes;
use function sprintf;
use function stripos;
use function strlen;
use function substr;
use PHPUnit\Framework\TestCase;
use PHPUnit\Util\FileLoader;
use ReflectionClass;
use ReflectionException;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 *
 * @deprecated see https://github.com/sebastianbergmann/phpunit/issues/4039
 */
final class StandardTestSuiteLoader implements TestSuiteLoader
{
    /**
     * @throws Exception
     */
    public function load(string $suiteClassFile): ReflectionClass
    {
        $suiteClassName = basename($suiteClassFile, '.php');
        $loadedClasses  = get_declared_classes();

        if (!class_exists($suiteClassName, false)) {
            /* @noinspection UnusedFunctionResultInspection */
            FileLoader::checkAndLoad($suiteClassFile);
>>>>>>> update

            $loadedClasses = array_values(
                array_diff(get_declared_classes(), $loadedClasses)
            );
<<<<<<< HEAD
        }

        if (!class_exists($suiteClassName, false) && !empty($loadedClasses)) {
            $offset = 0 - strlen($suiteClassName);

            foreach ($loadedClasses as $loadedClass) {
                $class = new ReflectionClass($loadedClass);
                if (substr($loadedClass, $offset) === $suiteClassName &&
                    $class->getFileName() == $filename) {
                    $suiteClassName = $loadedClass;
=======

            if (empty($loadedClasses)) {
                throw $this->exceptionFor($suiteClassName, $suiteClassFile);
            }
        }

        if (!class_exists($suiteClassName, false)) {
            $offset = 0 - strlen($suiteClassName);

            foreach ($loadedClasses as $loadedClass) {
                // @see https://github.com/sebastianbergmann/phpunit/issues/5020
                if (stripos(substr($loadedClass, $offset - 1), '\\' . $suiteClassName) === 0 ||
                    stripos(substr($loadedClass, $offset - 1), '_' . $suiteClassName) === 0) {
                    $suiteClassName = $loadedClass;

>>>>>>> update
                    break;
                }
            }
        }

<<<<<<< HEAD
        if (!class_exists($suiteClassName, false) && !empty($loadedClasses)) {
            $testCaseClass = 'PHPUnit_Framework_TestCase';

            foreach ($loadedClasses as $loadedClass) {
                $class     = new ReflectionClass($loadedClass);
                $classFile = $class->getFileName();

                if ($class->isSubclassOf($testCaseClass) &&
                    !$class->isAbstract()) {
                    $suiteClassName = $loadedClass;
                    $testCaseClass  = $loadedClass;

                    if ($classFile == realpath($suiteClassFile)) {
                        break;
                    }
                }

                if ($class->hasMethod('suite')) {
                    $method = $class->getMethod('suite');

                    if (!$method->isAbstract() &&
                        $method->isPublic() &&
                        $method->isStatic()) {
                        $suiteClassName = $loadedClass;

                        if ($classFile == realpath($suiteClassFile)) {
                            break;
                        }
                    }
                }
            }
        }

        if (class_exists($suiteClassName, false)) {
            $class = new ReflectionClass($suiteClassName);

            if ($class->getFileName() == realpath($suiteClassFile)) {
=======
        if (!class_exists($suiteClassName, false)) {
            throw $this->exceptionFor($suiteClassName, $suiteClassFile);
        }

        try {
            $class = new ReflectionClass($suiteClassName);
            // @codeCoverageIgnoreStart
        } catch (ReflectionException $e) {
            throw new Exception(
                $e->getMessage(),
                (int) $e->getCode(),
                $e
            );
        }
        // @codeCoverageIgnoreEnd

        if ($class->isSubclassOf(TestCase::class) && !$class->isAbstract()) {
            return $class;
        }

        if ($class->hasMethod('suite')) {
            try {
                $method = $class->getMethod('suite');
                // @codeCoverageIgnoreStart
            } catch (ReflectionException $e) {
                throw new Exception(
                    $e->getMessage(),
                    (int) $e->getCode(),
                    $e
                );
            }
            // @codeCoverageIgnoreEnd

            if (!$method->isAbstract() && $method->isPublic() && $method->isStatic()) {
>>>>>>> update
                return $class;
            }
        }

<<<<<<< HEAD
        throw new PHPUnit_Framework_Exception(
            sprintf(
                "Class '%s' could not be found in '%s'.",
                $suiteClassName,
                $suiteClassFile
            )
        );
    }

    /**
     * @param ReflectionClass $aClass
     *
     * @return ReflectionClass
     */
    public function reload(ReflectionClass $aClass)
    {
        return $aClass;
    }
=======
        throw $this->exceptionFor($suiteClassName, $suiteClassFile);
    }

    public function reload(ReflectionClass $aClass): ReflectionClass
    {
        return $aClass;
    }

    private function exceptionFor(string $className, string $filename): Exception
    {
        return new Exception(
            sprintf(
                "Class '%s' could not be found in '%s'.",
                $className,
                $filename
            )
        );
    }
>>>>>>> update
}
