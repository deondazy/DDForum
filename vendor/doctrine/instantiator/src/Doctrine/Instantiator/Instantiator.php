<?php
<<<<<<< HEAD
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Instantiator;

use Closure;
=======

namespace Doctrine\Instantiator;

use ArrayIterator;
use Doctrine\Instantiator\Exception\ExceptionInterface;
>>>>>>> update
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Doctrine\Instantiator\Exception\UnexpectedValueException;
use Exception;
use ReflectionClass;
<<<<<<< HEAD

/**
 * {@inheritDoc}
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 */
=======
use ReflectionException;
use Serializable;

use function class_exists;
use function enum_exists;
use function is_subclass_of;
use function restore_error_handler;
use function set_error_handler;
use function sprintf;
use function strlen;
use function unserialize;

use const PHP_VERSION_ID;

>>>>>>> update
final class Instantiator implements InstantiatorInterface
{
    /**
     * Markers used internally by PHP to define whether {@see \unserialize} should invoke
     * the method {@see \Serializable::unserialize()} when dealing with classes implementing
     * the {@see \Serializable} interface.
     */
<<<<<<< HEAD
    const SERIALIZATION_FORMAT_USE_UNSERIALIZER   = 'C';
    const SERIALIZATION_FORMAT_AVOID_UNSERIALIZER = 'O';

    /**
     * @var \Closure[] of {@see \Closure} instances used to instantiate specific classes
     */
    private static $cachedInstantiators = array();

    /**
     * @var object[] of objects that can directly be cloned
     */
    private static $cachedCloneables = array();

    /**
     * {@inheritDoc}
=======
    public const SERIALIZATION_FORMAT_USE_UNSERIALIZER   = 'C';
    public const SERIALIZATION_FORMAT_AVOID_UNSERIALIZER = 'O';

    /**
     * Used to instantiate specific classes, indexed by class name.
     *
     * @var callable[]
     */
    private static $cachedInstantiators = [];

    /**
     * Array of objects that can directly be cloned, indexed by class name.
     *
     * @var object[]
     */
    private static $cachedCloneables = [];

    /**
     * @param string $className
     * @phpstan-param class-string<T> $className
     *
     * @return object
     * @phpstan-return T
     *
     * @throws ExceptionInterface
     *
     * @template T of object
>>>>>>> update
     */
    public function instantiate($className)
    {
        if (isset(self::$cachedCloneables[$className])) {
<<<<<<< HEAD
            return clone self::$cachedCloneables[$className];
=======
            /**
             * @phpstan-var T
             */
            $cachedCloneable = self::$cachedCloneables[$className];

            return clone $cachedCloneable;
>>>>>>> update
        }

        if (isset(self::$cachedInstantiators[$className])) {
            $factory = self::$cachedInstantiators[$className];

            return $factory();
        }

        return $this->buildAndCacheFromFactory($className);
    }

    /**
     * Builds the requested object and caches it in static properties for performance
     *
<<<<<<< HEAD
     * @param string $className
     *
     * @return object
     */
    private function buildAndCacheFromFactory($className)
=======
     * @phpstan-param class-string<T> $className
     *
     * @return object
     * @phpstan-return T
     *
     * @template T of object
     */
    private function buildAndCacheFromFactory(string $className)
>>>>>>> update
    {
        $factory  = self::$cachedInstantiators[$className] = $this->buildFactory($className);
        $instance = $factory();

        if ($this->isSafeToClone(new ReflectionClass($instance))) {
            self::$cachedCloneables[$className] = clone $instance;
        }

        return $instance;
    }

    /**
<<<<<<< HEAD
     * Builds a {@see \Closure} capable of instantiating the given $className without
     * invoking its constructor.
     *
     * @param string $className
     *
     * @return Closure
     */
    private function buildFactory($className)
=======
     * Builds a callable capable of instantiating the given $className without
     * invoking its constructor.
     *
     * @phpstan-param class-string<T> $className
     *
     * @phpstan-return callable(): T
     *
     * @throws InvalidArgumentException
     * @throws UnexpectedValueException
     * @throws ReflectionException
     *
     * @template T of object
     */
    private function buildFactory(string $className): callable
>>>>>>> update
    {
        $reflectionClass = $this->getReflectionClass($className);

        if ($this->isInstantiableViaReflection($reflectionClass)) {
<<<<<<< HEAD
            return function () use ($reflectionClass) {
                return $reflectionClass->newInstanceWithoutConstructor();
            };
=======
            return [$reflectionClass, 'newInstanceWithoutConstructor'];
>>>>>>> update
        }

        $serializedString = sprintf(
            '%s:%d:"%s":0:{}',
<<<<<<< HEAD
            $this->getSerializationFormat($reflectionClass),
=======
            is_subclass_of($className, Serializable::class) ? self::SERIALIZATION_FORMAT_USE_UNSERIALIZER : self::SERIALIZATION_FORMAT_AVOID_UNSERIALIZER,
>>>>>>> update
            strlen($className),
            $className
        );

        $this->checkIfUnSerializationIsSupported($reflectionClass, $serializedString);

<<<<<<< HEAD
        return function () use ($serializedString) {
=======
        return static function () use ($serializedString) {
>>>>>>> update
            return unserialize($serializedString);
        };
    }

    /**
<<<<<<< HEAD
     * @param string $className
     *
     * @return ReflectionClass
     *
     * @throws InvalidArgumentException
     */
    private function getReflectionClass($className)
=======
     * @phpstan-param class-string<T> $className
     *
     * @phpstan-return ReflectionClass<T>
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     *
     * @template T of object
     */
    private function getReflectionClass(string $className): ReflectionClass
>>>>>>> update
    {
        if (! class_exists($className)) {
            throw InvalidArgumentException::fromNonExistingClass($className);
        }

<<<<<<< HEAD
=======
        if (PHP_VERSION_ID >= 80100 && enum_exists($className, false)) {
            throw InvalidArgumentException::fromEnum($className);
        }

>>>>>>> update
        $reflection = new ReflectionClass($className);

        if ($reflection->isAbstract()) {
            throw InvalidArgumentException::fromAbstractClass($reflection);
        }

        return $reflection;
    }

    /**
<<<<<<< HEAD
     * @param ReflectionClass $reflectionClass
     * @param string          $serializedString
     *
     * @throws UnexpectedValueException
     *
     * @return void
     */
    private function checkIfUnSerializationIsSupported(ReflectionClass $reflectionClass, $serializedString)
    {
        set_error_handler(function ($code, $message, $file, $line) use ($reflectionClass, & $error) {
=======
     * @phpstan-param ReflectionClass<T> $reflectionClass
     *
     * @throws UnexpectedValueException
     *
     * @template T of object
     */
    private function checkIfUnSerializationIsSupported(ReflectionClass $reflectionClass, string $serializedString): void
    {
        set_error_handler(static function (int $code, string $message, string $file, int $line) use ($reflectionClass, &$error): bool {
>>>>>>> update
            $error = UnexpectedValueException::fromUncleanUnSerialization(
                $reflectionClass,
                $message,
                $code,
                $file,
                $line
            );
<<<<<<< HEAD
        });

        $this->attemptInstantiationViaUnSerialization($reflectionClass, $serializedString);

        restore_error_handler();
=======

            return true;
        });

        try {
            $this->attemptInstantiationViaUnSerialization($reflectionClass, $serializedString);
        } finally {
            restore_error_handler();
        }
>>>>>>> update

        if ($error) {
            throw $error;
        }
    }

    /**
<<<<<<< HEAD
     * @param ReflectionClass $reflectionClass
     * @param string          $serializedString
     *
     * @throws UnexpectedValueException
     *
     * @return void
     */
    private function attemptInstantiationViaUnSerialization(ReflectionClass $reflectionClass, $serializedString)
=======
     * @phpstan-param ReflectionClass<T> $reflectionClass
     *
     * @throws UnexpectedValueException
     *
     * @template T of object
     */
    private function attemptInstantiationViaUnSerialization(ReflectionClass $reflectionClass, string $serializedString): void
>>>>>>> update
    {
        try {
            unserialize($serializedString);
        } catch (Exception $exception) {
<<<<<<< HEAD
            restore_error_handler();

=======
>>>>>>> update
            throw UnexpectedValueException::fromSerializationTriggeredException($reflectionClass, $exception);
        }
    }

    /**
<<<<<<< HEAD
     * @param ReflectionClass $reflectionClass
     *
     * @return bool
     */
    private function isInstantiableViaReflection(ReflectionClass $reflectionClass)
    {
        if (\PHP_VERSION_ID >= 50600) {
            return ! ($this->hasInternalAncestors($reflectionClass) && $reflectionClass->isFinal());
        }

        return \PHP_VERSION_ID >= 50400 && ! $this->hasInternalAncestors($reflectionClass);
=======
     * @phpstan-param ReflectionClass<T> $reflectionClass
     *
     * @template T of object
     */
    private function isInstantiableViaReflection(ReflectionClass $reflectionClass): bool
    {
        return ! ($this->hasInternalAncestors($reflectionClass) && $reflectionClass->isFinal());
>>>>>>> update
    }

    /**
     * Verifies whether the given class is to be considered internal
     *
<<<<<<< HEAD
     * @param ReflectionClass $reflectionClass
     *
     * @return bool
     */
    private function hasInternalAncestors(ReflectionClass $reflectionClass)
=======
     * @phpstan-param ReflectionClass<T> $reflectionClass
     *
     * @template T of object
     */
    private function hasInternalAncestors(ReflectionClass $reflectionClass): bool
>>>>>>> update
    {
        do {
            if ($reflectionClass->isInternal()) {
                return true;
            }
<<<<<<< HEAD
        } while ($reflectionClass = $reflectionClass->getParentClass());
=======

            $reflectionClass = $reflectionClass->getParentClass();
        } while ($reflectionClass);
>>>>>>> update

        return false;
    }

    /**
<<<<<<< HEAD
     * Verifies if the given PHP version implements the `Serializable` interface serialization
     * with an incompatible serialization format. If that's the case, use serialization marker
     * "C" instead of "O".
     *
     * @link http://news.php.net/php.internals/74654
     *
     * @param ReflectionClass $reflectionClass
     *
     * @return string the serialization format marker, either self::SERIALIZATION_FORMAT_USE_UNSERIALIZER
     *                or self::SERIALIZATION_FORMAT_AVOID_UNSERIALIZER
     */
    private function getSerializationFormat(ReflectionClass $reflectionClass)
    {
        if ($this->isPhpVersionWithBrokenSerializationFormat()
            && $reflectionClass->implementsInterface('Serializable')
        ) {
            return self::SERIALIZATION_FORMAT_USE_UNSERIALIZER;
        }

        return self::SERIALIZATION_FORMAT_AVOID_UNSERIALIZER;
    }

    /**
     * Checks whether the current PHP runtime uses an incompatible serialization format
     *
     * @return bool
     */
    private function isPhpVersionWithBrokenSerializationFormat()
    {
        return PHP_VERSION_ID === 50429 || PHP_VERSION_ID === 50513;
    }

    /**
     * Checks if a class is cloneable
     *
     * @param ReflectionClass $reflection
     *
     * @return bool
     */
    private function isSafeToClone(ReflectionClass $reflection)
    {
        if (method_exists($reflection, 'isCloneable') && ! $reflection->isCloneable()) {
            return false;
        }

        // not cloneable if it implements `__clone`, as we want to avoid calling it
        return ! $reflection->hasMethod('__clone');
=======
     * Checks if a class is cloneable
     *
     * Classes implementing `__clone` cannot be safely cloned, as that may cause side-effects.
     *
     * @phpstan-param ReflectionClass<T> $reflectionClass
     *
     * @template T of object
     */
    private function isSafeToClone(ReflectionClass $reflectionClass): bool
    {
        return $reflectionClass->isCloneable()
            && ! $reflectionClass->hasMethod('__clone')
            && ! $reflectionClass->isSubclassOf(ArrayIterator::class);
>>>>>>> update
    }
}
