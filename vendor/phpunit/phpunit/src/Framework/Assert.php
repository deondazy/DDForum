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
 * A set of assert methods.
 *
 * @since Class available since Release 2.0.0
 */
abstract class PHPUnit_Framework_Assert
=======
namespace PHPUnit\Framework;

use const DEBUG_BACKTRACE_IGNORE_ARGS;
use const PHP_EOL;
use function array_shift;
use function array_unshift;
use function assert;
use function class_exists;
use function count;
use function debug_backtrace;
use function explode;
use function file_get_contents;
use function func_get_args;
use function implode;
use function interface_exists;
use function is_array;
use function is_bool;
use function is_int;
use function is_iterable;
use function is_object;
use function is_string;
use function preg_match;
use function preg_split;
use function sprintf;
use function strpos;
use ArrayAccess;
use Countable;
use DOMAttr;
use DOMDocument;
use DOMElement;
use PHPUnit\Framework\Constraint\ArrayHasKey;
use PHPUnit\Framework\Constraint\Callback;
use PHPUnit\Framework\Constraint\ClassHasAttribute;
use PHPUnit\Framework\Constraint\ClassHasStaticAttribute;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\Count;
use PHPUnit\Framework\Constraint\DirectoryExists;
use PHPUnit\Framework\Constraint\FileExists;
use PHPUnit\Framework\Constraint\GreaterThan;
use PHPUnit\Framework\Constraint\IsAnything;
use PHPUnit\Framework\Constraint\IsEmpty;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\Constraint\IsEqualCanonicalizing;
use PHPUnit\Framework\Constraint\IsEqualIgnoringCase;
use PHPUnit\Framework\Constraint\IsEqualWithDelta;
use PHPUnit\Framework\Constraint\IsFalse;
use PHPUnit\Framework\Constraint\IsFinite;
use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\Constraint\IsInfinite;
use PHPUnit\Framework\Constraint\IsInstanceOf;
use PHPUnit\Framework\Constraint\IsJson;
use PHPUnit\Framework\Constraint\IsNan;
use PHPUnit\Framework\Constraint\IsNull;
use PHPUnit\Framework\Constraint\IsReadable;
use PHPUnit\Framework\Constraint\IsTrue;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\Constraint\IsWritable;
use PHPUnit\Framework\Constraint\JsonMatches;
use PHPUnit\Framework\Constraint\LessThan;
use PHPUnit\Framework\Constraint\LogicalAnd;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\LogicalOr;
use PHPUnit\Framework\Constraint\LogicalXor;
use PHPUnit\Framework\Constraint\ObjectEquals;
use PHPUnit\Framework\Constraint\ObjectHasAttribute;
use PHPUnit\Framework\Constraint\RegularExpression;
use PHPUnit\Framework\Constraint\SameSize;
use PHPUnit\Framework\Constraint\StringContains;
use PHPUnit\Framework\Constraint\StringEndsWith;
use PHPUnit\Framework\Constraint\StringMatchesFormatDescription;
use PHPUnit\Framework\Constraint\StringStartsWith;
use PHPUnit\Framework\Constraint\TraversableContainsEqual;
use PHPUnit\Framework\Constraint\TraversableContainsIdentical;
use PHPUnit\Framework\Constraint\TraversableContainsOnly;
use PHPUnit\Util\Type;
use PHPUnit\Util\Xml;
use PHPUnit\Util\Xml\Loader as XmlLoader;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
abstract class Assert
>>>>>>> update
{
    /**
     * @var int
     */
    private static $count = 0;

    /**
     * Asserts that an array has a specified key.
     *
<<<<<<< HEAD
     * @param mixed             $key
     * @param array|ArrayAccess $array
     * @param string            $message
     *
     * @since Method available since Release 3.0.0
     */
    public static function assertArrayHasKey($key, $array, $message = '')
    {
        if (!(is_integer($key) || is_string($key))) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
=======
     * @param int|string        $key
     * @param array|ArrayAccess $array
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertArrayHasKey($key, $array, string $message = ''): void
    {
        if (!(is_int($key) || is_string($key))) {
            throw InvalidArgumentException::create(
>>>>>>> update
                1,
                'integer or string'
            );
        }

        if (!(is_array($array) || $array instanceof ArrayAccess)) {
<<<<<<< HEAD
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
=======
            throw InvalidArgumentException::create(
>>>>>>> update
                2,
                'array or ArrayAccess'
            );
        }

<<<<<<< HEAD
        $constraint = new PHPUnit_Framework_Constraint_ArrayHasKey($key);

        static::assertThat($array, $constraint, $message);
    }

    /**
     * Asserts that an array has a specified subset.
     *
     * @param array|ArrayAccess $subset
     * @param array|ArrayAccess $array
     * @param bool              $strict  Check for object identity
     * @param string            $message
     *
     * @since Method available since Release 4.4.0
     */
    public static function assertArraySubset($subset, $array, $strict = false, $message = '')
    {
        if (!is_array($subset)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                1,
                'array or ArrayAccess'
            );
        }

        if (!is_array($array)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                2,
                'array or ArrayAccess'
            );
        }

        $constraint = new PHPUnit_Framework_Constraint_ArraySubset($subset, $strict);
=======
        $constraint = new ArrayHasKey($key);
>>>>>>> update

        static::assertThat($array, $constraint, $message);
    }

    /**
     * Asserts that an array does not have a specified key.
     *
<<<<<<< HEAD
     * @param mixed             $key
     * @param array|ArrayAccess $array
     * @param string            $message
     *
     * @since Method available since Release 3.0.0
     */
    public static function assertArrayNotHasKey($key, $array, $message = '')
    {
        if (!(is_integer($key) || is_string($key))) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
=======
     * @param int|string        $key
     * @param array|ArrayAccess $array
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertArrayNotHasKey($key, $array, string $message = ''): void
    {
        if (!(is_int($key) || is_string($key))) {
            throw InvalidArgumentException::create(
>>>>>>> update
                1,
                'integer or string'
            );
        }

        if (!(is_array($array) || $array instanceof ArrayAccess)) {
<<<<<<< HEAD
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
=======
            throw InvalidArgumentException::create(
>>>>>>> update
                2,
                'array or ArrayAccess'
            );
        }

<<<<<<< HEAD
        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_ArrayHasKey($key)
=======
        $constraint = new LogicalNot(
            new ArrayHasKey($key)
>>>>>>> update
        );

        static::assertThat($array, $constraint, $message);
    }

    /**
     * Asserts that a haystack contains a needle.
     *
<<<<<<< HEAD
     * @param mixed  $needle
     * @param mixed  $haystack
     * @param string $message
     * @param bool   $ignoreCase
     * @param bool   $checkForObjectIdentity
     * @param bool   $checkForNonObjectIdentity
     *
     * @since Method available since Release 2.1.0
     */
    public static function assertContains($needle, $haystack, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
    {
        if (is_array($haystack) ||
            is_object($haystack) && $haystack instanceof Traversable) {
            $constraint = new PHPUnit_Framework_Constraint_TraversableContains(
                $needle,
                $checkForObjectIdentity,
                $checkForNonObjectIdentity
            );
        } elseif (is_string($haystack)) {
            if (!is_string($needle)) {
                throw PHPUnit_Util_InvalidArgumentHelper::factory(
                    1,
                    'string'
                );
            }

            $constraint = new PHPUnit_Framework_Constraint_StringContains(
                $needle,
                $ignoreCase
            );
        } else {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                2,
                'array, traversable or string'
            );
        }
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertContains($needle, iterable $haystack, string $message = ''): void
    {
        $constraint = new TraversableContainsIdentical($needle);
>>>>>>> update

        static::assertThat($haystack, $constraint, $message);
    }

<<<<<<< HEAD
    /**
     * Asserts that a haystack that is stored in a static attribute of a class
     * or an attribute of an object contains a needle.
     *
     * @param mixed         $needle
     * @param string        $haystackAttributeName
     * @param string|object $haystackClassOrObject
     * @param string        $message
     * @param bool          $ignoreCase
     * @param bool          $checkForObjectIdentity
     * @param bool          $checkForNonObjectIdentity
     *
     * @since Method available since Release 3.0.0
     */
    public static function assertAttributeContains($needle, $haystackAttributeName, $haystackClassOrObject, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
    {
        static::assertContains(
            $needle,
            static::readAttribute($haystackClassOrObject, $haystackAttributeName),
            $message,
            $ignoreCase,
            $checkForObjectIdentity,
            $checkForNonObjectIdentity
        );
=======
    public static function assertContainsEquals($needle, iterable $haystack, string $message = ''): void
    {
        $constraint = new TraversableContainsEqual($needle);

        static::assertThat($haystack, $constraint, $message);
>>>>>>> update
    }

    /**
     * Asserts that a haystack does not contain a needle.
     *
<<<<<<< HEAD
     * @param mixed  $needle
     * @param mixed  $haystack
     * @param string $message
     * @param bool   $ignoreCase
     * @param bool   $checkForObjectIdentity
     * @param bool   $checkForNonObjectIdentity
     *
     * @since Method available since Release 2.1.0
     */
    public static function assertNotContains($needle, $haystack, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
    {
        if (is_array($haystack) ||
            is_object($haystack) && $haystack instanceof Traversable) {
            $constraint = new PHPUnit_Framework_Constraint_Not(
                new PHPUnit_Framework_Constraint_TraversableContains(
                    $needle,
                    $checkForObjectIdentity,
                    $checkForNonObjectIdentity
                )
            );
        } elseif (is_string($haystack)) {
            if (!is_string($needle)) {
                throw PHPUnit_Util_InvalidArgumentHelper::factory(
                    1,
                    'string'
                );
            }

            $constraint = new PHPUnit_Framework_Constraint_Not(
                new PHPUnit_Framework_Constraint_StringContains(
                    $needle,
                    $ignoreCase
                )
            );
        } else {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                2,
                'array, traversable or string'
            );
        }
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertNotContains($needle, iterable $haystack, string $message = ''): void
    {
        $constraint = new LogicalNot(
            new TraversableContainsIdentical($needle)
        );

        static::assertThat($haystack, $constraint, $message);
    }

    public static function assertNotContainsEquals($needle, iterable $haystack, string $message = ''): void
    {
        $constraint = new LogicalNot(new TraversableContainsEqual($needle));
>>>>>>> update

        static::assertThat($haystack, $constraint, $message);
    }

    /**
<<<<<<< HEAD
     * Asserts that a haystack that is stored in a static attribute of a class
     * or an attribute of an object does not contain a needle.
     *
     * @param mixed         $needle
     * @param string        $haystackAttributeName
     * @param string|object $haystackClassOrObject
     * @param string        $message
     * @param bool          $ignoreCase
     * @param bool          $checkForObjectIdentity
     * @param bool          $checkForNonObjectIdentity
     *
     * @since Method available since Release 3.0.0
     */
    public static function assertAttributeNotContains($needle, $haystackAttributeName, $haystackClassOrObject, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
    {
        static::assertNotContains(
            $needle,
            static::readAttribute($haystackClassOrObject, $haystackAttributeName),
            $message,
            $ignoreCase,
            $checkForObjectIdentity,
            $checkForNonObjectIdentity
        );
    }

    /**
     * Asserts that a haystack contains only values of a given type.
     *
     * @param string $type
     * @param mixed  $haystack
     * @param bool   $isNativeType
     * @param string $message
     *
     * @since Method available since Release 3.1.4
     */
    public static function assertContainsOnly($type, $haystack, $isNativeType = null, $message = '')
    {
        if (!(is_array($haystack) ||
            is_object($haystack) && $haystack instanceof Traversable)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                2,
                'array or traversable'
            );
        }

        if ($isNativeType == null) {
            $isNativeType = PHPUnit_Util_Type::isType($type);
=======
     * Asserts that a haystack contains only values of a given type.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = ''): void
    {
        if ($isNativeType === null) {
            $isNativeType = Type::isType($type);
>>>>>>> update
        }

        static::assertThat(
            $haystack,
<<<<<<< HEAD
            new PHPUnit_Framework_Constraint_TraversableContainsOnly(
=======
            new TraversableContainsOnly(
>>>>>>> update
                $type,
                $isNativeType
            ),
            $message
        );
    }

    /**
<<<<<<< HEAD
     * Asserts that a haystack contains only instances of a given classname
     *
     * @param string            $classname
     * @param array|Traversable $haystack
     * @param string            $message
     */
    public static function assertContainsOnlyInstancesOf($classname, $haystack, $message = '')
    {
        if (!(is_array($haystack) ||
            is_object($haystack) && $haystack instanceof Traversable)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                2,
                'array or traversable'
            );
        }

        static::assertThat(
            $haystack,
            new PHPUnit_Framework_Constraint_TraversableContainsOnly(
                $classname,
=======
     * Asserts that a haystack contains only instances of a given class name.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertContainsOnlyInstancesOf(string $className, iterable $haystack, string $message = ''): void
    {
        static::assertThat(
            $haystack,
            new TraversableContainsOnly(
                $className,
>>>>>>> update
                false
            ),
            $message
        );
    }

    /**
<<<<<<< HEAD
     * Asserts that a haystack that is stored in a static attribute of a class
     * or an attribute of an object contains only values of a given type.
     *
     * @param string        $type
     * @param string        $haystackAttributeName
     * @param string|object $haystackClassOrObject
     * @param bool          $isNativeType
     * @param string        $message
     *
     * @since Method available since Release 3.1.4
     */
    public static function assertAttributeContainsOnly($type, $haystackAttributeName, $haystackClassOrObject, $isNativeType = null, $message = '')
    {
        static::assertContainsOnly(
            $type,
            static::readAttribute($haystackClassOrObject, $haystackAttributeName),
            $isNativeType,
            $message
        );
    }

    /**
     * Asserts that a haystack does not contain only values of a given type.
     *
     * @param string $type
     * @param mixed  $haystack
     * @param bool   $isNativeType
     * @param string $message
     *
     * @since Method available since Release 3.1.4
     */
    public static function assertNotContainsOnly($type, $haystack, $isNativeType = null, $message = '')
    {
        if (!(is_array($haystack) ||
            is_object($haystack) && $haystack instanceof Traversable)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                2,
                'array or traversable'
            );
        }

        if ($isNativeType == null) {
            $isNativeType = PHPUnit_Util_Type::isType($type);
=======
     * Asserts that a haystack does not contain only values of a given type.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertNotContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = ''): void
    {
        if ($isNativeType === null) {
            $isNativeType = Type::isType($type);
>>>>>>> update
        }

        static::assertThat(
            $haystack,
<<<<<<< HEAD
            new PHPUnit_Framework_Constraint_Not(
                new PHPUnit_Framework_Constraint_TraversableContainsOnly(
=======
            new LogicalNot(
                new TraversableContainsOnly(
>>>>>>> update
                    $type,
                    $isNativeType
                )
            ),
            $message
        );
    }

    /**
<<<<<<< HEAD
     * Asserts that a haystack that is stored in a static attribute of a class
     * or an attribute of an object does not contain only values of a given
     * type.
     *
     * @param string        $type
     * @param string        $haystackAttributeName
     * @param string|object $haystackClassOrObject
     * @param bool          $isNativeType
     * @param string        $message
     *
     * @since Method available since Release 3.1.4
     */
    public static function assertAttributeNotContainsOnly($type, $haystackAttributeName, $haystackClassOrObject, $isNativeType = null, $message = '')
    {
        static::assertNotContainsOnly(
            $type,
            static::readAttribute($haystackClassOrObject, $haystackAttributeName),
            $isNativeType,
            $message
        );
    }

    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     *
     * @param int    $expectedCount
     * @param mixed  $haystack
     * @param string $message
     */
    public static function assertCount($expectedCount, $haystack, $message = '')
    {
        if (!is_int($expectedCount)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        if (!$haystack instanceof Countable &&
            !$haystack instanceof Traversable &&
            !is_array($haystack)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'countable or traversable');
=======
     * Asserts the number of elements of an array, Countable or Traversable.
     *
     * @param Countable|iterable $haystack
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertCount(int $expectedCount, $haystack, string $message = ''): void
    {
        if (!$haystack instanceof Countable && !is_iterable($haystack)) {
            throw InvalidArgumentException::create(2, 'countable or iterable');
>>>>>>> update
        }

        static::assertThat(
            $haystack,
<<<<<<< HEAD
            new PHPUnit_Framework_Constraint_Count($expectedCount),
            $message
        );
    }

    /**
     * Asserts the number of elements of an array, Countable or Traversable
     * that is stored in an attribute.
     *
     * @param int           $expectedCount
     * @param string        $haystackAttributeName
     * @param string|object $haystackClassOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.6.0
     */
    public static function assertAttributeCount($expectedCount, $haystackAttributeName, $haystackClassOrObject, $message = '')
    {
        static::assertCount(
            $expectedCount,
            static::readAttribute($haystackClassOrObject, $haystackAttributeName),
=======
            new Count($expectedCount),
>>>>>>> update
            $message
        );
    }

    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     *
<<<<<<< HEAD
     * @param int    $expectedCount
     * @param mixed  $haystack
     * @param string $message
     */
    public static function assertNotCount($expectedCount, $haystack, $message = '')
    {
        if (!is_int($expectedCount)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        if (!$haystack instanceof Countable &&
            !$haystack instanceof Traversable &&
            !is_array($haystack)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'countable or traversable');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_Count($expectedCount)
=======
     * @param Countable|iterable $haystack
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertNotCount(int $expectedCount, $haystack, string $message = ''): void
    {
        if (!$haystack instanceof Countable && !is_iterable($haystack)) {
            throw InvalidArgumentException::create(2, 'countable or iterable');
        }

        $constraint = new LogicalNot(
            new Count($expectedCount)
>>>>>>> update
        );

        static::assertThat($haystack, $constraint, $message);
    }

    /**
<<<<<<< HEAD
     * Asserts the number of elements of an array, Countable or Traversable
     * that is stored in an attribute.
     *
     * @param int           $expectedCount
     * @param string        $haystackAttributeName
     * @param string|object $haystackClassOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.6.0
     */
    public static function assertAttributeNotCount($expectedCount, $haystackAttributeName, $haystackClassOrObject, $message = '')
    {
        static::assertNotCount(
            $expectedCount,
            static::readAttribute($haystackClassOrObject, $haystackAttributeName),
            $message
        );
    }

    /**
     * Asserts that two variables are equal.
     *
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     * @param float  $delta
     * @param int    $maxDepth
     * @param bool   $canonicalize
     * @param bool   $ignoreCase
     */
    public static function assertEquals($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        $constraint = new PHPUnit_Framework_Constraint_IsEqual(
            $expected,
            $delta,
            $maxDepth,
            $canonicalize,
            $ignoreCase
=======
     * Asserts that two variables are equal.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertEquals($expected, $actual, string $message = ''): void
    {
        $constraint = new IsEqual($expected);

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that two variables are equal (canonicalizing).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertEqualsCanonicalizing($expected, $actual, string $message = ''): void
    {
        $constraint = new IsEqualCanonicalizing($expected);

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that two variables are equal (ignoring case).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertEqualsIgnoringCase($expected, $actual, string $message = ''): void
    {
        $constraint = new IsEqualIgnoringCase($expected);

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that two variables are equal (with delta).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertEqualsWithDelta($expected, $actual, float $delta, string $message = ''): void
    {
        $constraint = new IsEqualWithDelta(
            $expected,
            $delta
>>>>>>> update
        );

        static::assertThat($actual, $constraint, $message);
    }

    /**
<<<<<<< HEAD
     * Asserts that a variable is equal to an attribute of an object.
     *
     * @param mixed         $expected
     * @param string        $actualAttributeName
     * @param string|object $actualClassOrObject
     * @param string        $message
     * @param float         $delta
     * @param int           $maxDepth
     * @param bool          $canonicalize
     * @param bool          $ignoreCase
     */
    public static function assertAttributeEquals($expected, $actualAttributeName, $actualClassOrObject, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        static::assertEquals(
            $expected,
            static::readAttribute($actualClassOrObject, $actualAttributeName),
            $message,
            $delta,
            $maxDepth,
            $canonicalize,
            $ignoreCase
        );
    }

    /**
     * Asserts that two variables are not equal.
     *
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     * @param float  $delta
     * @param int    $maxDepth
     * @param bool   $canonicalize
     * @param bool   $ignoreCase
     *
     * @since Method available since Release 2.3.0
     */
    public static function assertNotEquals($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_IsEqual(
                $expected,
                $delta,
                $maxDepth,
                $canonicalize,
                $ignoreCase
=======
     * Asserts that two variables are not equal.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertNotEquals($expected, $actual, string $message = ''): void
    {
        $constraint = new LogicalNot(
            new IsEqual($expected)
        );

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that two variables are not equal (canonicalizing).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertNotEqualsCanonicalizing($expected, $actual, string $message = ''): void
    {
        $constraint = new LogicalNot(
            new IsEqualCanonicalizing($expected)
        );

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that two variables are not equal (ignoring case).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertNotEqualsIgnoringCase($expected, $actual, string $message = ''): void
    {
        $constraint = new LogicalNot(
            new IsEqualIgnoringCase($expected)
        );

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that two variables are not equal (with delta).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertNotEqualsWithDelta($expected, $actual, float $delta, string $message = ''): void
    {
        $constraint = new LogicalNot(
            new IsEqualWithDelta(
                $expected,
                $delta
>>>>>>> update
            )
        );

        static::assertThat($actual, $constraint, $message);
    }

    /**
<<<<<<< HEAD
     * Asserts that a variable is not equal to an attribute of an object.
     *
     * @param mixed         $expected
     * @param string        $actualAttributeName
     * @param string|object $actualClassOrObject
     * @param string        $message
     * @param float         $delta
     * @param int           $maxDepth
     * @param bool          $canonicalize
     * @param bool          $ignoreCase
     */
    public static function assertAttributeNotEquals($expected, $actualAttributeName, $actualClassOrObject, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        static::assertNotEquals(
            $expected,
            static::readAttribute($actualClassOrObject, $actualAttributeName),
            $message,
            $delta,
            $maxDepth,
            $canonicalize,
            $ignoreCase
=======
     * @throws ExpectationFailedException
     */
    public static function assertObjectEquals(object $expected, object $actual, string $method = 'equals', string $message = ''): void
    {
        static::assertThat(
            $actual,
            static::objectEquals($expected, $method),
            $message
>>>>>>> update
        );
    }

    /**
     * Asserts that a variable is empty.
     *
<<<<<<< HEAD
     * @param mixed  $actual
     * @param string $message
     *
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public static function assertEmpty($actual, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert empty $actual
     */
    public static function assertEmpty($actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::isEmpty(), $message);
    }

    /**
<<<<<<< HEAD
     * Asserts that a static attribute of a class or an attribute of an object
     * is empty.
     *
     * @param string        $haystackAttributeName
     * @param string|object $haystackClassOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertAttributeEmpty($haystackAttributeName, $haystackClassOrObject, $message = '')
    {
        static::assertEmpty(
            static::readAttribute($haystackClassOrObject, $haystackAttributeName),
            $message
        );
    }

    /**
     * Asserts that a variable is not empty.
     *
     * @param mixed  $actual
     * @param string $message
     *
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public static function assertNotEmpty($actual, $message = '')
=======
     * Asserts that a variable is not empty.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !empty $actual
     */
    public static function assertNotEmpty($actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::logicalNot(static::isEmpty()), $message);
    }

    /**
<<<<<<< HEAD
     * Asserts that a static attribute of a class or an attribute of an object
     * is not empty.
     *
     * @param string        $haystackAttributeName
     * @param string|object $haystackClassOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertAttributeNotEmpty($haystackAttributeName, $haystackClassOrObject, $message = '')
    {
        static::assertNotEmpty(
            static::readAttribute($haystackClassOrObject, $haystackAttributeName),
            $message
        );
    }

    /**
     * Asserts that a value is greater than another value.
     *
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertGreaterThan($expected, $actual, $message = '')
=======
     * Asserts that a value is greater than another value.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertGreaterThan($expected, $actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::greaterThan($expected), $message);
    }

    /**
<<<<<<< HEAD
     * Asserts that an attribute is greater than another value.
     *
     * @param mixed         $expected
     * @param string        $actualAttributeName
     * @param string|object $actualClassOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertAttributeGreaterThan($expected, $actualAttributeName, $actualClassOrObject, $message = '')
    {
        static::assertGreaterThan(
            $expected,
            static::readAttribute($actualClassOrObject, $actualAttributeName),
            $message
        );
    }

    /**
     * Asserts that a value is greater than or equal to another value.
     *
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertGreaterThanOrEqual($expected, $actual, $message = '')
=======
     * Asserts that a value is greater than or equal to another value.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertGreaterThanOrEqual($expected, $actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat(
            $actual,
            static::greaterThanOrEqual($expected),
            $message
        );
    }

    /**
<<<<<<< HEAD
     * Asserts that an attribute is greater than or equal to another value.
     *
     * @param mixed         $expected
     * @param string        $actualAttributeName
     * @param string|object $actualClassOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertAttributeGreaterThanOrEqual($expected, $actualAttributeName, $actualClassOrObject, $message = '')
    {
        static::assertGreaterThanOrEqual(
            $expected,
            static::readAttribute($actualClassOrObject, $actualAttributeName),
            $message
        );
    }

    /**
     * Asserts that a value is smaller than another value.
     *
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertLessThan($expected, $actual, $message = '')
=======
     * Asserts that a value is smaller than another value.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertLessThan($expected, $actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::lessThan($expected), $message);
    }

    /**
<<<<<<< HEAD
     * Asserts that an attribute is smaller than another value.
     *
     * @param mixed         $expected
     * @param string        $actualAttributeName
     * @param string|object $actualClassOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertAttributeLessThan($expected, $actualAttributeName, $actualClassOrObject, $message = '')
    {
        static::assertLessThan(
            $expected,
            static::readAttribute($actualClassOrObject, $actualAttributeName),
            $message
        );
    }

    /**
     * Asserts that a value is smaller than or equal to another value.
     *
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertLessThanOrEqual($expected, $actual, $message = '')
=======
     * Asserts that a value is smaller than or equal to another value.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertLessThanOrEqual($expected, $actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::lessThanOrEqual($expected), $message);
    }

    /**
<<<<<<< HEAD
     * Asserts that an attribute is smaller than or equal to another value.
     *
     * @param mixed         $expected
     * @param string        $actualAttributeName
     * @param string|object $actualClassOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertAttributeLessThanOrEqual($expected, $actualAttributeName, $actualClassOrObject, $message = '')
    {
        static::assertLessThanOrEqual(
            $expected,
            static::readAttribute($actualClassOrObject, $actualAttributeName),
            $message
        );
    }

    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file.
     *
     * @param string $expected
     * @param string $actual
     * @param string $message
     * @param bool   $canonicalize
     * @param bool   $ignoreCase
     *
     * @since Method available since Release 3.2.14
     */
    public static function assertFileEquals($expected, $actual, $message = '', $canonicalize = false, $ignoreCase = false)
=======
     * Asserts that the contents of one file is equal to the contents of another
     * file.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileEquals(string $expected, string $actual, string $message = ''): void
>>>>>>> update
    {
        static::assertFileExists($expected, $message);
        static::assertFileExists($actual, $message);

<<<<<<< HEAD
        static::assertEquals(
            file_get_contents($expected),
            file_get_contents($actual),
            $message,
            0,
            10,
            $canonicalize,
            $ignoreCase
        );
=======
        $constraint = new IsEqual(file_get_contents($expected));

        static::assertThat(file_get_contents($actual), $constraint, $message);
    }

    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file (canonicalizing).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileEqualsCanonicalizing(string $expected, string $actual, string $message = ''): void
    {
        static::assertFileExists($expected, $message);
        static::assertFileExists($actual, $message);

        $constraint = new IsEqualCanonicalizing(
            file_get_contents($expected)
        );

        static::assertThat(file_get_contents($actual), $constraint, $message);
    }

    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file (ignoring case).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileEqualsIgnoringCase(string $expected, string $actual, string $message = ''): void
    {
        static::assertFileExists($expected, $message);
        static::assertFileExists($actual, $message);

        $constraint = new IsEqualIgnoringCase(file_get_contents($expected));

        static::assertThat(file_get_contents($actual), $constraint, $message);
>>>>>>> update
    }

    /**
     * Asserts that the contents of one file is not equal to the contents of
     * another file.
     *
<<<<<<< HEAD
     * @param string $expected
     * @param string $actual
     * @param string $message
     * @param bool   $canonicalize
     * @param bool   $ignoreCase
     *
     * @since Method available since Release 3.2.14
     */
    public static function assertFileNotEquals($expected, $actual, $message = '', $canonicalize = false, $ignoreCase = false)
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileNotEquals(string $expected, string $actual, string $message = ''): void
>>>>>>> update
    {
        static::assertFileExists($expected, $message);
        static::assertFileExists($actual, $message);

<<<<<<< HEAD
        static::assertNotEquals(
            file_get_contents($expected),
            file_get_contents($actual),
            $message,
            0,
            10,
            $canonicalize,
            $ignoreCase
        );
=======
        $constraint = new LogicalNot(
            new IsEqual(file_get_contents($expected))
        );

        static::assertThat(file_get_contents($actual), $constraint, $message);
    }

    /**
     * Asserts that the contents of one file is not equal to the contents of another
     * file (canonicalizing).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileNotEqualsCanonicalizing(string $expected, string $actual, string $message = ''): void
    {
        static::assertFileExists($expected, $message);
        static::assertFileExists($actual, $message);

        $constraint = new LogicalNot(
            new IsEqualCanonicalizing(file_get_contents($expected))
        );

        static::assertThat(file_get_contents($actual), $constraint, $message);
    }

    /**
     * Asserts that the contents of one file is not equal to the contents of another
     * file (ignoring case).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileNotEqualsIgnoringCase(string $expected, string $actual, string $message = ''): void
    {
        static::assertFileExists($expected, $message);
        static::assertFileExists($actual, $message);

        $constraint = new LogicalNot(
            new IsEqualIgnoringCase(file_get_contents($expected))
        );

        static::assertThat(file_get_contents($actual), $constraint, $message);
>>>>>>> update
    }

    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualString
     * @param string $message
     * @param bool   $canonicalize
     * @param bool   $ignoreCase
     *
     * @since Method available since Release 3.3.0
     */
    public static function assertStringEqualsFile($expectedFile, $actualString, $message = '', $canonicalize = false, $ignoreCase = false)
    {
        static::assertFileExists($expectedFile, $message);

        static::assertEquals(
            file_get_contents($expectedFile),
            $actualString,
            $message,
            0,
            10,
            $canonicalize,
            $ignoreCase
        );
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringEqualsFile(string $expectedFile, string $actualString, string $message = ''): void
    {
        static::assertFileExists($expectedFile, $message);

        $constraint = new IsEqual(file_get_contents($expectedFile));

        static::assertThat($actualString, $constraint, $message);
    }

    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file (canonicalizing).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringEqualsFileCanonicalizing(string $expectedFile, string $actualString, string $message = ''): void
    {
        static::assertFileExists($expectedFile, $message);

        $constraint = new IsEqualCanonicalizing(file_get_contents($expectedFile));

        static::assertThat($actualString, $constraint, $message);
    }

    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file (ignoring case).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringEqualsFileIgnoringCase(string $expectedFile, string $actualString, string $message = ''): void
    {
        static::assertFileExists($expectedFile, $message);

        $constraint = new IsEqualIgnoringCase(file_get_contents($expectedFile));

        static::assertThat($actualString, $constraint, $message);
>>>>>>> update
    }

    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualString
     * @param string $message
     * @param bool   $canonicalize
     * @param bool   $ignoreCase
     *
     * @since Method available since Release 3.3.0
     */
    public static function assertStringNotEqualsFile($expectedFile, $actualString, $message = '', $canonicalize = false, $ignoreCase = false)
    {
        static::assertFileExists($expectedFile, $message);

        static::assertNotEquals(
            file_get_contents($expectedFile),
            $actualString,
            $message,
            0,
            10,
            $canonicalize,
            $ignoreCase
        );
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringNotEqualsFile(string $expectedFile, string $actualString, string $message = ''): void
    {
        static::assertFileExists($expectedFile, $message);

        $constraint = new LogicalNot(
            new IsEqual(file_get_contents($expectedFile))
        );

        static::assertThat($actualString, $constraint, $message);
    }

    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file (canonicalizing).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringNotEqualsFileCanonicalizing(string $expectedFile, string $actualString, string $message = ''): void
    {
        static::assertFileExists($expectedFile, $message);

        $constraint = new LogicalNot(
            new IsEqualCanonicalizing(file_get_contents($expectedFile))
        );

        static::assertThat($actualString, $constraint, $message);
    }

    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file (ignoring case).
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringNotEqualsFileIgnoringCase(string $expectedFile, string $actualString, string $message = ''): void
    {
        static::assertFileExists($expectedFile, $message);

        $constraint = new LogicalNot(
            new IsEqualIgnoringCase(file_get_contents($expectedFile))
        );

        static::assertThat($actualString, $constraint, $message);
>>>>>>> update
    }

    /**
     * Asserts that a file/dir is readable.
     *
<<<<<<< HEAD
     * @param string $filename
     * @param string $message
     */
    public static function assertIsReadable($filename, $message = '')
    {
        if (!is_string($filename)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_IsReadable;

        static::assertThat($filename, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertIsReadable(string $filename, string $message = ''): void
    {
        static::assertThat($filename, new IsReadable, $message);
>>>>>>> update
    }

    /**
     * Asserts that a file/dir exists and is not readable.
     *
<<<<<<< HEAD
     * @param string $filename
     * @param string $message
     */
    public static function assertNotIsReadable($filename, $message = '')
    {
        if (!is_string($filename)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_IsReadable
        );

        static::assertThat($filename, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertIsNotReadable(string $filename, string $message = ''): void
    {
        static::assertThat($filename, new LogicalNot(new IsReadable), $message);
    }

    /**
     * Asserts that a file/dir exists and is not readable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4062
     */
    public static function assertNotIsReadable(string $filename, string $message = ''): void
    {
        self::createWarning('assertNotIsReadable() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertIsNotReadable() instead.');

        static::assertThat($filename, new LogicalNot(new IsReadable), $message);
>>>>>>> update
    }

    /**
     * Asserts that a file/dir exists and is writable.
     *
<<<<<<< HEAD
     * @param string $filename
     * @param string $message
     */
    public static function assertIsWritable($filename, $message = '')
    {
        if (!is_string($filename)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_IsWritable;

        static::assertThat($filename, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertIsWritable(string $filename, string $message = ''): void
    {
        static::assertThat($filename, new IsWritable, $message);
>>>>>>> update
    }

    /**
     * Asserts that a file/dir exists and is not writable.
     *
<<<<<<< HEAD
     * @param string $filename
     * @param string $message
     */
    public static function assertNotIsWritable($filename, $message = '')
    {
        if (!is_string($filename)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_IsWritable
        );

        static::assertThat($filename, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertIsNotWritable(string $filename, string $message = ''): void
    {
        static::assertThat($filename, new LogicalNot(new IsWritable), $message);
    }

    /**
     * Asserts that a file/dir exists and is not writable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4065
     */
    public static function assertNotIsWritable(string $filename, string $message = ''): void
    {
        self::createWarning('assertNotIsWritable() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertIsNotWritable() instead.');

        static::assertThat($filename, new LogicalNot(new IsWritable), $message);
>>>>>>> update
    }

    /**
     * Asserts that a directory exists.
     *
<<<<<<< HEAD
     * @param string $directory
     * @param string $message
     */
    public static function assertDirectoryExists($directory, $message = '')
    {
        if (!is_string($directory)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_DirectoryExists;

        static::assertThat($directory, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertDirectoryExists(string $directory, string $message = ''): void
    {
        static::assertThat($directory, new DirectoryExists, $message);
>>>>>>> update
    }

    /**
     * Asserts that a directory does not exist.
     *
<<<<<<< HEAD
     * @param string $directory
     * @param string $message
     */
    public static function assertDirectoryNotExists($directory, $message = '')
    {
        if (!is_string($directory)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_DirectoryExists
        );

        static::assertThat($directory, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertDirectoryDoesNotExist(string $directory, string $message = ''): void
    {
        static::assertThat($directory, new LogicalNot(new DirectoryExists), $message);
    }

    /**
     * Asserts that a directory does not exist.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4068
     */
    public static function assertDirectoryNotExists(string $directory, string $message = ''): void
    {
        self::createWarning('assertDirectoryNotExists() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertDirectoryDoesNotExist() instead.');

        static::assertThat($directory, new LogicalNot(new DirectoryExists), $message);
>>>>>>> update
    }

    /**
     * Asserts that a directory exists and is readable.
     *
<<<<<<< HEAD
     * @param string $directory
     * @param string $message
     */
    public static function assertDirectoryIsReadable($directory, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertDirectoryIsReadable(string $directory, string $message = ''): void
>>>>>>> update
    {
        self::assertDirectoryExists($directory, $message);
        self::assertIsReadable($directory, $message);
    }

    /**
     * Asserts that a directory exists and is not readable.
     *
<<<<<<< HEAD
     * @param string $directory
     * @param string $message
     */
    public static function assertDirectoryNotIsReadable($directory, $message = '')
    {
        self::assertDirectoryExists($directory, $message);
        self::assertNotIsReadable($directory, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertDirectoryIsNotReadable(string $directory, string $message = ''): void
    {
        self::assertDirectoryExists($directory, $message);
        self::assertIsNotReadable($directory, $message);
    }

    /**
     * Asserts that a directory exists and is not readable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4071
     */
    public static function assertDirectoryNotIsReadable(string $directory, string $message = ''): void
    {
        self::createWarning('assertDirectoryNotIsReadable() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertDirectoryIsNotReadable() instead.');

        self::assertDirectoryExists($directory, $message);
        self::assertIsNotReadable($directory, $message);
>>>>>>> update
    }

    /**
     * Asserts that a directory exists and is writable.
     *
<<<<<<< HEAD
     * @param string $directory
     * @param string $message
     */
    public static function assertDirectoryIsWritable($directory, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertDirectoryIsWritable(string $directory, string $message = ''): void
>>>>>>> update
    {
        self::assertDirectoryExists($directory, $message);
        self::assertIsWritable($directory, $message);
    }

    /**
     * Asserts that a directory exists and is not writable.
     *
<<<<<<< HEAD
     * @param string $directory
     * @param string $message
     */
    public static function assertDirectoryNotIsWritable($directory, $message = '')
    {
        self::assertDirectoryExists($directory, $message);
        self::assertDirectoryNotIsWritable($directory, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertDirectoryIsNotWritable(string $directory, string $message = ''): void
    {
        self::assertDirectoryExists($directory, $message);
        self::assertIsNotWritable($directory, $message);
    }

    /**
     * Asserts that a directory exists and is not writable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4074
     */
    public static function assertDirectoryNotIsWritable(string $directory, string $message = ''): void
    {
        self::createWarning('assertDirectoryNotIsWritable() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertDirectoryIsNotWritable() instead.');

        self::assertDirectoryExists($directory, $message);
        self::assertIsNotWritable($directory, $message);
>>>>>>> update
    }

    /**
     * Asserts that a file exists.
     *
<<<<<<< HEAD
     * @param string $filename
     * @param string $message
     *
     * @since Method available since Release 3.0.0
     */
    public static function assertFileExists($filename, $message = '')
    {
        if (!is_string($filename)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_FileExists;

        static::assertThat($filename, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileExists(string $filename, string $message = ''): void
    {
        static::assertThat($filename, new FileExists, $message);
>>>>>>> update
    }

    /**
     * Asserts that a file does not exist.
     *
<<<<<<< HEAD
     * @param string $filename
     * @param string $message
     *
     * @since Method available since Release 3.0.0
     */
    public static function assertFileNotExists($filename, $message = '')
    {
        if (!is_string($filename)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_FileExists
        );

        static::assertThat($filename, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileDoesNotExist(string $filename, string $message = ''): void
    {
        static::assertThat($filename, new LogicalNot(new FileExists), $message);
    }

    /**
     * Asserts that a file does not exist.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4077
     */
    public static function assertFileNotExists(string $filename, string $message = ''): void
    {
        self::createWarning('assertFileNotExists() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertFileDoesNotExist() instead.');

        static::assertThat($filename, new LogicalNot(new FileExists), $message);
>>>>>>> update
    }

    /**
     * Asserts that a file exists and is readable.
     *
<<<<<<< HEAD
     * @param string $file
     * @param string $message
     */
    public static function assertFileIsReadable($file, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileIsReadable(string $file, string $message = ''): void
>>>>>>> update
    {
        self::assertFileExists($file, $message);
        self::assertIsReadable($file, $message);
    }

    /**
     * Asserts that a file exists and is not readable.
     *
<<<<<<< HEAD
     * @param string $file
     * @param string $message
     */
    public static function assertFileNotIsReadable($file, $message = '')
    {
        self::assertFileExists($file, $message);
        self::assertNotIsReadable($file, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileIsNotReadable(string $file, string $message = ''): void
    {
        self::assertFileExists($file, $message);
        self::assertIsNotReadable($file, $message);
    }

    /**
     * Asserts that a file exists and is not readable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4080
     */
    public static function assertFileNotIsReadable(string $file, string $message = ''): void
    {
        self::createWarning('assertFileNotIsReadable() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertFileIsNotReadable() instead.');

        self::assertFileExists($file, $message);
        self::assertIsNotReadable($file, $message);
>>>>>>> update
    }

    /**
     * Asserts that a file exists and is writable.
     *
<<<<<<< HEAD
     * @param string $file
     * @param string $message
     */
    public static function assertFileIsWritable($file, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileIsWritable(string $file, string $message = ''): void
>>>>>>> update
    {
        self::assertFileExists($file, $message);
        self::assertIsWritable($file, $message);
    }

    /**
     * Asserts that a file exists and is not writable.
     *
<<<<<<< HEAD
     * @param string $file
     * @param string $message
     */
    public static function assertFileNotIsWritable($file, $message = '')
    {
        self::assertFileExists($file, $message);
        self::assertNotIsWritable($file, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFileIsNotWritable(string $file, string $message = ''): void
    {
        self::assertFileExists($file, $message);
        self::assertIsNotWritable($file, $message);
    }

    /**
     * Asserts that a file exists and is not writable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4083
     */
    public static function assertFileNotIsWritable(string $file, string $message = ''): void
    {
        self::createWarning('assertFileNotIsWritable() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertFileIsNotWritable() instead.');

        self::assertFileExists($file, $message);
        self::assertIsNotWritable($file, $message);
>>>>>>> update
    }

    /**
     * Asserts that a condition is true.
     *
<<<<<<< HEAD
     * @param bool   $condition
     * @param string $message
     *
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public static function assertTrue($condition, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert true $condition
     */
    public static function assertTrue($condition, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($condition, static::isTrue(), $message);
    }

    /**
     * Asserts that a condition is not true.
     *
<<<<<<< HEAD
     * @param bool   $condition
     * @param string $message
     *
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public static function assertNotTrue($condition, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !true $condition
     */
    public static function assertNotTrue($condition, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($condition, static::logicalNot(static::isTrue()), $message);
    }

    /**
     * Asserts that a condition is false.
     *
<<<<<<< HEAD
     * @param bool   $condition
     * @param string $message
     *
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public static function assertFalse($condition, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert false $condition
     */
    public static function assertFalse($condition, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($condition, static::isFalse(), $message);
    }

    /**
     * Asserts that a condition is not false.
     *
<<<<<<< HEAD
     * @param bool   $condition
     * @param string $message
     *
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public static function assertNotFalse($condition, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !false $condition
     */
    public static function assertNotFalse($condition, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($condition, static::logicalNot(static::isFalse()), $message);
    }

    /**
     * Asserts that a variable is null.
     *
<<<<<<< HEAD
     * @param mixed  $actual
     * @param string $message
     */
    public static function assertNull($actual, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert null $actual
     */
    public static function assertNull($actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::isNull(), $message);
    }

    /**
     * Asserts that a variable is not null.
     *
<<<<<<< HEAD
     * @param mixed  $actual
     * @param string $message
     */
    public static function assertNotNull($actual, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !null $actual
     */
    public static function assertNotNull($actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::logicalNot(static::isNull()), $message);
    }

    /**
     * Asserts that a variable is finite.
     *
<<<<<<< HEAD
     * @param mixed  $actual
     * @param string $message
     */
    public static function assertFinite($actual, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertFinite($actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::isFinite(), $message);
    }

    /**
     * Asserts that a variable is infinite.
     *
<<<<<<< HEAD
     * @param mixed  $actual
     * @param string $message
     */
    public static function assertInfinite($actual, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertInfinite($actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::isInfinite(), $message);
    }

    /**
     * Asserts that a variable is nan.
     *
<<<<<<< HEAD
     * @param mixed  $actual
     * @param string $message
     */
    public static function assertNan($actual, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertNan($actual, string $message = ''): void
>>>>>>> update
    {
        static::assertThat($actual, static::isNan(), $message);
    }

    /**
     * Asserts that a class has a specified attribute.
     *
<<<<<<< HEAD
     * @param string $attributeName
     * @param string $className
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertClassHasAttribute($attributeName, $className, $message = '')
    {
        if (!is_string($attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'valid attribute name');
        }

        if (!is_string($className) || !class_exists($className)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'class name', $className);
        }

        $constraint = new PHPUnit_Framework_Constraint_ClassHasAttribute(
            $attributeName
        );

        static::assertThat($className, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertClassHasAttribute(string $attributeName, string $className, string $message = ''): void
    {
        if (!self::isValidClassAttributeName($attributeName)) {
            throw InvalidArgumentException::create(1, 'valid attribute name');
        }

        if (!class_exists($className)) {
            throw InvalidArgumentException::create(2, 'class name');
        }

        static::assertThat($className, new ClassHasAttribute($attributeName), $message);
>>>>>>> update
    }

    /**
     * Asserts that a class does not have a specified attribute.
     *
<<<<<<< HEAD
     * @param string $attributeName
     * @param string $className
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertClassNotHasAttribute($attributeName, $className, $message = '')
    {
        if (!is_string($attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'valid attribute name');
        }

        if (!is_string($className) || !class_exists($className)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'class name', $className);
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_ClassHasAttribute($attributeName)
        );

        static::assertThat($className, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertClassNotHasAttribute(string $attributeName, string $className, string $message = ''): void
    {
        if (!self::isValidClassAttributeName($attributeName)) {
            throw InvalidArgumentException::create(1, 'valid attribute name');
        }

        if (!class_exists($className)) {
            throw InvalidArgumentException::create(2, 'class name');
        }

        static::assertThat(
            $className,
            new LogicalNot(
                new ClassHasAttribute($attributeName)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that a class has a specified static attribute.
     *
<<<<<<< HEAD
     * @param string $attributeName
     * @param string $className
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertClassHasStaticAttribute($attributeName, $className, $message = '')
    {
        if (!is_string($attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'valid attribute name');
        }

        if (!is_string($className) || !class_exists($className)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'class name', $className);
        }

        $constraint = new PHPUnit_Framework_Constraint_ClassHasStaticAttribute(
            $attributeName
        );

        static::assertThat($className, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertClassHasStaticAttribute(string $attributeName, string $className, string $message = ''): void
    {
        if (!self::isValidClassAttributeName($attributeName)) {
            throw InvalidArgumentException::create(1, 'valid attribute name');
        }

        if (!class_exists($className)) {
            throw InvalidArgumentException::create(2, 'class name');
        }

        static::assertThat(
            $className,
            new ClassHasStaticAttribute($attributeName),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that a class does not have a specified static attribute.
     *
<<<<<<< HEAD
     * @param string $attributeName
     * @param string $className
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertClassNotHasStaticAttribute($attributeName, $className, $message = '')
    {
        if (!is_string($attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'valid attribute name');
        }

        if (!is_string($className) || !class_exists($className)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'class name', $className);
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_ClassHasStaticAttribute(
                $attributeName
            )
        );

        static::assertThat($className, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertClassNotHasStaticAttribute(string $attributeName, string $className, string $message = ''): void
    {
        if (!self::isValidClassAttributeName($attributeName)) {
            throw InvalidArgumentException::create(1, 'valid attribute name');
        }

        if (!class_exists($className)) {
            throw InvalidArgumentException::create(2, 'class name');
        }

        static::assertThat(
            $className,
            new LogicalNot(
                new ClassHasStaticAttribute($attributeName)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that an object has a specified attribute.
     *
<<<<<<< HEAD
     * @param string $attributeName
     * @param object $object
     * @param string $message
     *
     * @since Method available since Release 3.0.0
     */
    public static function assertObjectHasAttribute($attributeName, $object, $message = '')
    {
        if (!is_string($attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'valid attribute name');
        }

        if (!is_object($object)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'object');
        }

        $constraint = new PHPUnit_Framework_Constraint_ObjectHasAttribute(
            $attributeName
        );

        static::assertThat($object, $constraint, $message);
=======
     * @param object $object
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertObjectHasAttribute(string $attributeName, $object, string $message = ''): void
    {
        if (!self::isValidObjectAttributeName($attributeName)) {
            throw InvalidArgumentException::create(1, 'valid attribute name');
        }

        if (!is_object($object)) {
            throw InvalidArgumentException::create(2, 'object');
        }

        static::assertThat(
            $object,
            new ObjectHasAttribute($attributeName),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that an object does not have a specified attribute.
     *
<<<<<<< HEAD
     * @param string $attributeName
     * @param object $object
     * @param string $message
     *
     * @since Method available since Release 3.0.0
     */
    public static function assertObjectNotHasAttribute($attributeName, $object, $message = '')
    {
        if (!is_string($attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'valid attribute name');
        }

        if (!is_object($object)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'object');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_ObjectHasAttribute($attributeName)
        );

        static::assertThat($object, $constraint, $message);
=======
     * @param object $object
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertObjectNotHasAttribute(string $attributeName, $object, string $message = ''): void
    {
        if (!self::isValidObjectAttributeName($attributeName)) {
            throw InvalidArgumentException::create(1, 'valid attribute name');
        }

        if (!is_object($object)) {
            throw InvalidArgumentException::create(2, 'object');
        }

        static::assertThat(
            $object,
            new LogicalNot(
                new ObjectHasAttribute($attributeName)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     *
<<<<<<< HEAD
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     */
    public static function assertSame($expected, $actual, $message = '')
    {
        if (is_bool($expected) && is_bool($actual)) {
            static::assertEquals($expected, $actual, $message);
        } else {
            $constraint = new PHPUnit_Framework_Constraint_IsIdentical(
                $expected
            );

            static::assertThat($actual, $constraint, $message);
        }
    }

    /**
     * Asserts that a variable and an attribute of an object have the same type
     * and value.
     *
     * @param mixed         $expected
     * @param string        $actualAttributeName
     * @param string|object $actualClassOrObject
     * @param string        $message
     */
    public static function assertAttributeSame($expected, $actualAttributeName, $actualClassOrObject, $message = '')
    {
        static::assertSame(
            $expected,
            static::readAttribute($actualClassOrObject, $actualAttributeName),
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-template ExpectedType
     * @psalm-param ExpectedType $expected
     * @psalm-assert =ExpectedType $actual
     */
    public static function assertSame($expected, $actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsIdentical($expected),
>>>>>>> update
            $message
        );
    }

    /**
     * Asserts that two variables do not have the same type and value.
     * Used on objects, it asserts that two variables do not reference
     * the same object.
     *
<<<<<<< HEAD
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     */
    public static function assertNotSame($expected, $actual, $message = '')
    {
        if (is_bool($expected) && is_bool($actual)) {
            static::assertNotEquals($expected, $actual, $message);
        } else {
            $constraint = new PHPUnit_Framework_Constraint_Not(
                new PHPUnit_Framework_Constraint_IsIdentical($expected)
            );

            static::assertThat($actual, $constraint, $message);
        }
    }

    /**
     * Asserts that a variable and an attribute of an object do not have the
     * same type and value.
     *
     * @param mixed         $expected
     * @param string        $actualAttributeName
     * @param string|object $actualClassOrObject
     * @param string        $message
     */
    public static function assertAttributeNotSame($expected, $actualAttributeName, $actualClassOrObject, $message = '')
    {
        static::assertNotSame(
            $expected,
            static::readAttribute($actualClassOrObject, $actualAttributeName),
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertNotSame($expected, $actual, string $message = ''): void
    {
        if (is_bool($expected) && is_bool($actual)) {
            static::assertNotEquals($expected, $actual, $message);
        }

        static::assertThat(
            $actual,
            new LogicalNot(
                new IsIdentical($expected)
            ),
>>>>>>> update
            $message
        );
    }

    /**
     * Asserts that a variable is of a given type.
     *
<<<<<<< HEAD
     * @param string $expected
     * @param mixed  $actual
     * @param string $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertInstanceOf($expected, $actual, $message = '')
    {
        if (!(is_string($expected) && (class_exists($expected) || interface_exists($expected)))) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'class or interface name');
        }

        $constraint = new PHPUnit_Framework_Constraint_IsInstanceOf(
            $expected
        );

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that an attribute is of a given type.
     *
     * @param string        $expected
     * @param string        $attributeName
     * @param string|object $classOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertAttributeInstanceOf($expected, $attributeName, $classOrObject, $message = '')
    {
        static::assertInstanceOf(
            $expected,
            static::readAttribute($classOrObject, $attributeName),
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $expected
     * @psalm-assert =ExpectedType $actual
     */
    public static function assertInstanceOf(string $expected, $actual, string $message = ''): void
    {
        if (!class_exists($expected) && !interface_exists($expected)) {
            throw InvalidArgumentException::create(1, 'class or interface name');
        }

        static::assertThat(
            $actual,
            new IsInstanceOf($expected),
>>>>>>> update
            $message
        );
    }

    /**
     * Asserts that a variable is not of a given type.
     *
<<<<<<< HEAD
     * @param string $expected
     * @param mixed  $actual
     * @param string $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertNotInstanceOf($expected, $actual, $message = '')
    {
        if (!(is_string($expected) && (class_exists($expected) || interface_exists($expected)))) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'class or interface name');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_IsInstanceOf($expected)
        );

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that an attribute is of a given type.
     *
     * @param string        $expected
     * @param string        $attributeName
     * @param string|object $classOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertAttributeNotInstanceOf($expected, $attributeName, $classOrObject, $message = '')
    {
        static::assertNotInstanceOf(
            $expected,
            static::readAttribute($classOrObject, $attributeName),
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $expected
     * @psalm-assert !ExpectedType $actual
     */
    public static function assertNotInstanceOf(string $expected, $actual, string $message = ''): void
    {
        if (!class_exists($expected) && !interface_exists($expected)) {
            throw InvalidArgumentException::create(1, 'class or interface name');
        }

        static::assertThat(
            $actual,
            new LogicalNot(
                new IsInstanceOf($expected)
            ),
>>>>>>> update
            $message
        );
    }

    /**
<<<<<<< HEAD
     * Asserts that a variable is of a given type.
     *
     * @param string $expected
     * @param mixed  $actual
     * @param string $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertInternalType($expected, $actual, $message = '')
    {
        if (!is_string($expected)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_IsType(
            $expected
        );

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that an attribute is of a given type.
     *
     * @param string        $expected
     * @param string        $attributeName
     * @param string|object $classOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertAttributeInternalType($expected, $attributeName, $classOrObject, $message = '')
    {
        static::assertInternalType(
            $expected,
            static::readAttribute($classOrObject, $attributeName),
=======
     * Asserts that a variable is of type array.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert array $actual
     */
    public static function assertIsArray($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_ARRAY),
>>>>>>> update
            $message
        );
    }

    /**
<<<<<<< HEAD
     * Asserts that a variable is not of a given type.
     *
     * @param string $expected
     * @param mixed  $actual
     * @param string $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertNotInternalType($expected, $actual, $message = '')
    {
        if (!is_string($expected)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_IsType($expected)
        );

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that an attribute is of a given type.
     *
     * @param string        $expected
     * @param string        $attributeName
     * @param string|object $classOrObject
     * @param string        $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertAttributeNotInternalType($expected, $attributeName, $classOrObject, $message = '')
    {
        static::assertNotInternalType(
            $expected,
            static::readAttribute($classOrObject, $attributeName),
=======
     * Asserts that a variable is of type bool.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert bool $actual
     */
    public static function assertIsBool($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_BOOL),
            $message
        );
    }

    /**
     * Asserts that a variable is of type float.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert float $actual
     */
    public static function assertIsFloat($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_FLOAT),
            $message
        );
    }

    /**
     * Asserts that a variable is of type int.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert int $actual
     */
    public static function assertIsInt($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_INT),
            $message
        );
    }

    /**
     * Asserts that a variable is of type numeric.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert numeric $actual
     */
    public static function assertIsNumeric($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_NUMERIC),
            $message
        );
    }

    /**
     * Asserts that a variable is of type object.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert object $actual
     */
    public static function assertIsObject($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_OBJECT),
            $message
        );
    }

    /**
     * Asserts that a variable is of type resource.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert resource $actual
     */
    public static function assertIsResource($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_RESOURCE),
            $message
        );
    }

    /**
     * Asserts that a variable is of type resource and is closed.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert resource $actual
     */
    public static function assertIsClosedResource($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_CLOSED_RESOURCE),
            $message
        );
    }

    /**
     * Asserts that a variable is of type string.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert string $actual
     */
    public static function assertIsString($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_STRING),
            $message
        );
    }

    /**
     * Asserts that a variable is of type scalar.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert scalar $actual
     */
    public static function assertIsScalar($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_SCALAR),
            $message
        );
    }

    /**
     * Asserts that a variable is of type callable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert callable $actual
     */
    public static function assertIsCallable($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_CALLABLE),
            $message
        );
    }

    /**
     * Asserts that a variable is of type iterable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert iterable $actual
     */
    public static function assertIsIterable($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new IsType(IsType::TYPE_ITERABLE),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type array.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !array $actual
     */
    public static function assertIsNotArray($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_ARRAY)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type bool.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !bool $actual
     */
    public static function assertIsNotBool($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_BOOL)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type float.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !float $actual
     */
    public static function assertIsNotFloat($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_FLOAT)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type int.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !int $actual
     */
    public static function assertIsNotInt($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_INT)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type numeric.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !numeric $actual
     */
    public static function assertIsNotNumeric($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_NUMERIC)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type object.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !object $actual
     */
    public static function assertIsNotObject($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_OBJECT)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type resource.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !resource $actual
     */
    public static function assertIsNotResource($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_RESOURCE)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type resource.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !resource $actual
     */
    public static function assertIsNotClosedResource($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_CLOSED_RESOURCE)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type string.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !string $actual
     */
    public static function assertIsNotString($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_STRING)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type scalar.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !scalar $actual
     */
    public static function assertIsNotScalar($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_SCALAR)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type callable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !callable $actual
     */
    public static function assertIsNotCallable($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_CALLABLE)),
            $message
        );
    }

    /**
     * Asserts that a variable is not of type iterable.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert !iterable $actual
     */
    public static function assertIsNotIterable($actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new LogicalNot(new IsType(IsType::TYPE_ITERABLE)),
>>>>>>> update
            $message
        );
    }

    /**
     * Asserts that a string matches a given regular expression.
     *
<<<<<<< HEAD
     * @param string $pattern
     * @param string $string
     * @param string $message
     */
    public static function assertRegExp($pattern, $string, $message = '')
    {
        if (!is_string($pattern)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_PCREMatch($pattern);

        static::assertThat($string, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertMatchesRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        static::assertThat($string, new RegularExpression($pattern), $message);
    }

    /**
     * Asserts that a string matches a given regular expression.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4086
     */
    public static function assertRegExp(string $pattern, string $string, string $message = ''): void
    {
        self::createWarning('assertRegExp() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertMatchesRegularExpression() instead.');

        static::assertThat($string, new RegularExpression($pattern), $message);
>>>>>>> update
    }

    /**
     * Asserts that a string does not match a given regular expression.
     *
<<<<<<< HEAD
     * @param string $pattern
     * @param string $string
     * @param string $message
     *
     * @since Method available since Release 2.1.0
     */
    public static function assertNotRegExp($pattern, $string, $message = '')
    {
        if (!is_string($pattern)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_PCREMatch($pattern)
        );

        static::assertThat($string, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertDoesNotMatchRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        static::assertThat(
            $string,
            new LogicalNot(
                new RegularExpression($pattern)
            ),
            $message
        );
    }

    /**
     * Asserts that a string does not match a given regular expression.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4089
     */
    public static function assertNotRegExp(string $pattern, string $string, string $message = ''): void
    {
        self::createWarning('assertNotRegExp() is deprecated and will be removed in PHPUnit 10. Refactor your code to use assertDoesNotMatchRegularExpression() instead.');

        static::assertThat(
            $string,
            new LogicalNot(
                new RegularExpression($pattern)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
     * is the same.
     *
<<<<<<< HEAD
     * @param array|Countable|Traversable $expected
     * @param array|Countable|Traversable $actual
     * @param string                      $message
     */
    public static function assertSameSize($expected, $actual, $message = '')
    {
        if (!$expected instanceof Countable &&
            !$expected instanceof Traversable &&
            !is_array($expected)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'countable or traversable');
        }

        if (!$actual instanceof Countable &&
            !$actual instanceof Traversable &&
            !is_array($actual)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'countable or traversable');
=======
     * @param Countable|iterable $expected
     * @param Countable|iterable $actual
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertSameSize($expected, $actual, string $message = ''): void
    {
        if (!$expected instanceof Countable && !is_iterable($expected)) {
            throw InvalidArgumentException::create(1, 'countable or iterable');
        }

        if (!$actual instanceof Countable && !is_iterable($actual)) {
            throw InvalidArgumentException::create(2, 'countable or iterable');
>>>>>>> update
        }

        static::assertThat(
            $actual,
<<<<<<< HEAD
            new PHPUnit_Framework_Constraint_SameSize($expected),
=======
            new SameSize($expected),
>>>>>>> update
            $message
        );
    }

    /**
     * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
     * is not the same.
     *
<<<<<<< HEAD
     * @param array|Countable|Traversable $expected
     * @param array|Countable|Traversable $actual
     * @param string                      $message
     */
    public static function assertNotSameSize($expected, $actual, $message = '')
    {
        if (!$expected instanceof Countable &&
            !$expected instanceof Traversable &&
            !is_array($expected)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'countable or traversable');
        }

        if (!$actual instanceof Countable &&
            !$actual instanceof Traversable &&
            !is_array($actual)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'countable or traversable');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_SameSize($expected)
        );

        static::assertThat($actual, $constraint, $message);
=======
     * @param Countable|iterable $expected
     * @param Countable|iterable $actual
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertNotSameSize($expected, $actual, string $message = ''): void
    {
        if (!$expected instanceof Countable && !is_iterable($expected)) {
            throw InvalidArgumentException::create(1, 'countable or iterable');
        }

        if (!$actual instanceof Countable && !is_iterable($actual)) {
            throw InvalidArgumentException::create(2, 'countable or iterable');
        }

        static::assertThat(
            $actual,
            new LogicalNot(
                new SameSize($expected)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that a string matches a given format string.
     *
<<<<<<< HEAD
     * @param string $format
     * @param string $string
     * @param string $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertStringMatchesFormat($format, $string, $message = '')
    {
        if (!is_string($format)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_StringMatches($format);

        static::assertThat($string, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringMatchesFormat(string $format, string $string, string $message = ''): void
    {
        static::assertThat($string, new StringMatchesFormatDescription($format), $message);
>>>>>>> update
    }

    /**
     * Asserts that a string does not match a given format string.
     *
<<<<<<< HEAD
     * @param string $format
     * @param string $string
     * @param string $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertStringNotMatchesFormat($format, $string, $message = '')
    {
        if (!is_string($format)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_StringMatches($format)
        );

        static::assertThat($string, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringNotMatchesFormat(string $format, string $string, string $message = ''): void
    {
        static::assertThat(
            $string,
            new LogicalNot(
                new StringMatchesFormatDescription($format)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that a string matches a given format file.
     *
<<<<<<< HEAD
     * @param string $formatFile
     * @param string $string
     * @param string $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertStringMatchesFormatFile($formatFile, $string, $message = '')
    {
        static::assertFileExists($formatFile, $message);

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_StringMatches(
            file_get_contents($formatFile)
        );

        static::assertThat($string, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringMatchesFormatFile(string $formatFile, string $string, string $message = ''): void
    {
        static::assertFileExists($formatFile, $message);

        static::assertThat(
            $string,
            new StringMatchesFormatDescription(
                file_get_contents($formatFile)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that a string does not match a given format string.
     *
<<<<<<< HEAD
     * @param string $formatFile
     * @param string $string
     * @param string $message
     *
     * @since Method available since Release 3.5.0
     */
    public static function assertStringNotMatchesFormatFile($formatFile, $string, $message = '')
    {
        static::assertFileExists($formatFile, $message);

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_StringMatches(
                file_get_contents($formatFile)
            )
        );

        static::assertThat($string, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringNotMatchesFormatFile(string $formatFile, string $string, string $message = ''): void
    {
        static::assertFileExists($formatFile, $message);

        static::assertThat(
            $string,
            new LogicalNot(
                new StringMatchesFormatDescription(
                    file_get_contents($formatFile)
                )
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that a string starts with a given prefix.
     *
<<<<<<< HEAD
     * @param string $prefix
     * @param string $string
     * @param string $message
     *
     * @since Method available since Release 3.4.0
     */
    public static function assertStringStartsWith($prefix, $string, $message = '')
    {
        if (!is_string($prefix)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_StringStartsWith(
            $prefix
        );

        static::assertThat($string, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringStartsWith(string $prefix, string $string, string $message = ''): void
    {
        static::assertThat($string, new StringStartsWith($prefix), $message);
>>>>>>> update
    }

    /**
     * Asserts that a string starts not with a given prefix.
     *
     * @param string $prefix
     * @param string $string
<<<<<<< HEAD
     * @param string $message
     *
     * @since Method available since Release 3.4.0
     */
    public static function assertStringStartsNotWith($prefix, $string, $message = '')
    {
        if (!is_string($prefix)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_StringStartsWith($prefix)
        );

        static::assertThat($string, $constraint, $message);
=======
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringStartsNotWith($prefix, $string, string $message = ''): void
    {
        static::assertThat(
            $string,
            new LogicalNot(
                new StringStartsWith($prefix)
            ),
            $message
        );
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringContainsString(string $needle, string $haystack, string $message = ''): void
    {
        $constraint = new StringContains($needle, false);

        static::assertThat($haystack, $constraint, $message);
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringContainsStringIgnoringCase(string $needle, string $haystack, string $message = ''): void
    {
        $constraint = new StringContains($needle, true);

        static::assertThat($haystack, $constraint, $message);
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringNotContainsString(string $needle, string $haystack, string $message = ''): void
    {
        $constraint = new LogicalNot(new StringContains($needle));

        static::assertThat($haystack, $constraint, $message);
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringNotContainsStringIgnoringCase(string $needle, string $haystack, string $message = ''): void
    {
        $constraint = new LogicalNot(new StringContains($needle, true));

        static::assertThat($haystack, $constraint, $message);
>>>>>>> update
    }

    /**
     * Asserts that a string ends with a given suffix.
     *
<<<<<<< HEAD
     * @param string $suffix
     * @param string $string
     * @param string $message
     *
     * @since Method available since Release 3.4.0
     */
    public static function assertStringEndsWith($suffix, $string, $message = '')
    {
        if (!is_string($suffix)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_StringEndsWith($suffix);

        static::assertThat($string, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringEndsWith(string $suffix, string $string, string $message = ''): void
    {
        static::assertThat($string, new StringEndsWith($suffix), $message);
>>>>>>> update
    }

    /**
     * Asserts that a string ends not with a given suffix.
     *
<<<<<<< HEAD
     * @param string $suffix
     * @param string $string
     * @param string $message
     *
     * @since Method available since Release 3.4.0
     */
    public static function assertStringEndsNotWith($suffix, $string, $message = '')
    {
        if (!is_string($suffix)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!is_string($string)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        $constraint = new PHPUnit_Framework_Constraint_Not(
            new PHPUnit_Framework_Constraint_StringEndsWith($suffix)
        );

        static::assertThat($string, $constraint, $message);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertStringEndsNotWith(string $suffix, string $string, string $message = ''): void
    {
        static::assertThat(
            $string,
            new LogicalNot(
                new StringEndsWith($suffix)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that two XML files are equal.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualFile
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertXmlFileEqualsXmlFile($expectedFile, $actualFile, $message = '')
    {
        $expected = PHPUnit_Util_XML::loadFile($expectedFile);
        $actual   = PHPUnit_Util_XML::loadFile($actualFile);
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public static function assertXmlFileEqualsXmlFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        $expected = (new XmlLoader)->loadFile($expectedFile);
        $actual   = (new XmlLoader)->loadFile($actualFile);
>>>>>>> update

        static::assertEquals($expected, $actual, $message);
    }

    /**
     * Asserts that two XML files are not equal.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualFile
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertXmlFileNotEqualsXmlFile($expectedFile, $actualFile, $message = '')
    {
        $expected = PHPUnit_Util_XML::loadFile($expectedFile);
        $actual   = PHPUnit_Util_XML::loadFile($actualFile);
=======
     * @throws \PHPUnit\Util\Exception
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertXmlFileNotEqualsXmlFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        $expected = (new XmlLoader)->loadFile($expectedFile);
        $actual   = (new XmlLoader)->loadFile($actualFile);
>>>>>>> update

        static::assertNotEquals($expected, $actual, $message);
    }

    /**
     * Asserts that two XML documents are equal.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualXml
     * @param string $message
     *
     * @since Method available since Release 3.3.0
     */
    public static function assertXmlStringEqualsXmlFile($expectedFile, $actualXml, $message = '')
    {
        $expected = PHPUnit_Util_XML::loadFile($expectedFile);
        $actual   = PHPUnit_Util_XML::load($actualXml);
=======
     * @param DOMDocument|string $actualXml
     *
     * @throws \PHPUnit\Util\Xml\Exception
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertXmlStringEqualsXmlFile(string $expectedFile, $actualXml, string $message = ''): void
    {
        if (!is_string($actualXml)) {
            self::createWarning('Passing an argument of type DOMDocument for the $actualXml parameter is deprecated. Support for this will be removed in PHPUnit 10.');

            $actual = $actualXml;
        } else {
            $actual = (new XmlLoader)->load($actualXml);
        }

        $expected = (new XmlLoader)->loadFile($expectedFile);
>>>>>>> update

        static::assertEquals($expected, $actual, $message);
    }

    /**
     * Asserts that two XML documents are not equal.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualXml
     * @param string $message
     *
     * @since Method available since Release 3.3.0
     */
    public static function assertXmlStringNotEqualsXmlFile($expectedFile, $actualXml, $message = '')
    {
        $expected = PHPUnit_Util_XML::loadFile($expectedFile);
        $actual   = PHPUnit_Util_XML::load($actualXml);
=======
     * @param DOMDocument|string $actualXml
     *
     * @throws \PHPUnit\Util\Xml\Exception
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertXmlStringNotEqualsXmlFile(string $expectedFile, $actualXml, string $message = ''): void
    {
        if (!is_string($actualXml)) {
            self::createWarning('Passing an argument of type DOMDocument for the $actualXml parameter is deprecated. Support for this will be removed in PHPUnit 10.');

            $actual = $actualXml;
        } else {
            $actual = (new XmlLoader)->load($actualXml);
        }

        $expected = (new XmlLoader)->loadFile($expectedFile);
>>>>>>> update

        static::assertNotEquals($expected, $actual, $message);
    }

    /**
     * Asserts that two XML documents are equal.
     *
<<<<<<< HEAD
     * @param string $expectedXml
     * @param string $actualXml
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertXmlStringEqualsXmlString($expectedXml, $actualXml, $message = '')
    {
        $expected = PHPUnit_Util_XML::load($expectedXml);
        $actual   = PHPUnit_Util_XML::load($actualXml);
=======
     * @param DOMDocument|string $expectedXml
     * @param DOMDocument|string $actualXml
     *
     * @throws \PHPUnit\Util\Xml\Exception
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertXmlStringEqualsXmlString($expectedXml, $actualXml, string $message = ''): void
    {
        if (!is_string($expectedXml)) {
            self::createWarning('Passing an argument of type DOMDocument for the $expectedXml parameter is deprecated. Support for this will be removed in PHPUnit 10.');

            $expected = $expectedXml;
        } else {
            $expected = (new XmlLoader)->load($expectedXml);
        }

        if (!is_string($actualXml)) {
            self::createWarning('Passing an argument of type DOMDocument for the $actualXml parameter is deprecated. Support for this will be removed in PHPUnit 10.');

            $actual = $actualXml;
        } else {
            $actual = (new XmlLoader)->load($actualXml);
        }
>>>>>>> update

        static::assertEquals($expected, $actual, $message);
    }

    /**
     * Asserts that two XML documents are not equal.
     *
<<<<<<< HEAD
     * @param string $expectedXml
     * @param string $actualXml
     * @param string $message
     *
     * @since Method available since Release 3.1.0
     */
    public static function assertXmlStringNotEqualsXmlString($expectedXml, $actualXml, $message = '')
    {
        $expected = PHPUnit_Util_XML::load($expectedXml);
        $actual   = PHPUnit_Util_XML::load($actualXml);
=======
     * @param DOMDocument|string $expectedXml
     * @param DOMDocument|string $actualXml
     *
     * @throws \PHPUnit\Util\Xml\Exception
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertXmlStringNotEqualsXmlString($expectedXml, $actualXml, string $message = ''): void
    {
        if (!is_string($expectedXml)) {
            self::createWarning('Passing an argument of type DOMDocument for the $expectedXml parameter is deprecated. Support for this will be removed in PHPUnit 10.');

            $expected = $expectedXml;
        } else {
            $expected = (new XmlLoader)->load($expectedXml);
        }

        if (!is_string($actualXml)) {
            self::createWarning('Passing an argument of type DOMDocument for the $actualXml parameter is deprecated. Support for this will be removed in PHPUnit 10.');

            $actual = $actualXml;
        } else {
            $actual = (new XmlLoader)->load($actualXml);
        }
>>>>>>> update

        static::assertNotEquals($expected, $actual, $message);
    }

    /**
     * Asserts that a hierarchy of DOMElements matches.
     *
<<<<<<< HEAD
     * @param DOMElement $expectedElement
     * @param DOMElement $actualElement
     * @param bool       $checkAttributes
     * @param string     $message
     *
     * @since Method available since Release 3.3.0
     */
    public static function assertEqualXMLStructure(DOMElement $expectedElement, DOMElement $actualElement, $checkAttributes = false, $message = '')
    {
        $tmp             = new DOMDocument;
        $expectedElement = $tmp->importNode($expectedElement, true);

        $tmp           = new DOMDocument;
        $actualElement = $tmp->importNode($actualElement, true);

        unset($tmp);

        static::assertEquals(
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws AssertionFailedError
     * @throws ExpectationFailedException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4091
     */
    public static function assertEqualXMLStructure(DOMElement $expectedElement, DOMElement $actualElement, bool $checkAttributes = false, string $message = ''): void
    {
        self::createWarning('assertEqualXMLStructure() is deprecated and will be removed in PHPUnit 10.');

        $expectedElement = Xml::import($expectedElement);
        $actualElement   = Xml::import($actualElement);

        static::assertSame(
>>>>>>> update
            $expectedElement->tagName,
            $actualElement->tagName,
            $message
        );

        if ($checkAttributes) {
<<<<<<< HEAD
            static::assertEquals(
=======
            static::assertSame(
>>>>>>> update
                $expectedElement->attributes->length,
                $actualElement->attributes->length,
                sprintf(
                    '%s%sNumber of attributes on node "%s" does not match',
                    $message,
                    !empty($message) ? "\n" : '',
                    $expectedElement->tagName
                )
            );

            for ($i = 0; $i < $expectedElement->attributes->length; $i++) {
                $expectedAttribute = $expectedElement->attributes->item($i);
<<<<<<< HEAD
                $actualAttribute   = $actualElement->attributes->getNamedItem(
                    $expectedAttribute->name
                );
=======
                $actualAttribute   = $actualElement->attributes->getNamedItem($expectedAttribute->name);

                assert($expectedAttribute instanceof DOMAttr);
>>>>>>> update

                if (!$actualAttribute) {
                    static::fail(
                        sprintf(
                            '%s%sCould not find attribute "%s" on node "%s"',
                            $message,
                            !empty($message) ? "\n" : '',
                            $expectedAttribute->name,
                            $expectedElement->tagName
                        )
                    );
                }
            }
        }

<<<<<<< HEAD
        PHPUnit_Util_XML::removeCharacterDataNodes($expectedElement);
        PHPUnit_Util_XML::removeCharacterDataNodes($actualElement);

        static::assertEquals(
=======
        Xml::removeCharacterDataNodes($expectedElement);
        Xml::removeCharacterDataNodes($actualElement);

        static::assertSame(
>>>>>>> update
            $expectedElement->childNodes->length,
            $actualElement->childNodes->length,
            sprintf(
                '%s%sNumber of child nodes of "%s" differs',
                $message,
                !empty($message) ? "\n" : '',
                $expectedElement->tagName
            )
        );

        for ($i = 0; $i < $expectedElement->childNodes->length; $i++) {
            static::assertEqualXMLStructure(
                $expectedElement->childNodes->item($i),
                $actualElement->childNodes->item($i),
                $checkAttributes,
                $message
            );
        }
    }

    /**
<<<<<<< HEAD
     * Evaluates a PHPUnit_Framework_Constraint matcher object.
     *
     * @param mixed                        $value
     * @param PHPUnit_Framework_Constraint $constraint
     * @param string                       $message
     *
     * @since Method available since Release 3.0.0
     */
    public static function assertThat($value, PHPUnit_Framework_Constraint $constraint, $message = '')
=======
     * Evaluates a PHPUnit\Framework\Constraint matcher object.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertThat($value, Constraint $constraint, string $message = ''): void
>>>>>>> update
    {
        self::$count += count($constraint);

        $constraint->evaluate($value, $message);
    }

    /**
     * Asserts that a string is a valid JSON string.
     *
<<<<<<< HEAD
     * @param string $actualJson
     * @param string $message
     *
     * @since Method available since Release 3.7.20
     */
    public static function assertJson($actualJson, $message = '')
    {
        if (!is_string($actualJson)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertJson(string $actualJson, string $message = ''): void
    {
>>>>>>> update
        static::assertThat($actualJson, static::isJson(), $message);
    }

    /**
     * Asserts that two given JSON encoded objects or arrays are equal.
     *
<<<<<<< HEAD
     * @param string $expectedJson
     * @param string $actualJson
     * @param string $message
     */
    public static function assertJsonStringEqualsJsonString($expectedJson, $actualJson, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertJsonStringEqualsJsonString(string $expectedJson, string $actualJson, string $message = ''): void
>>>>>>> update
    {
        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);

<<<<<<< HEAD
        $expected = json_decode($expectedJson);
        $actual   = json_decode($actualJson);

        static::assertEquals($expected, $actual, $message);
=======
        static::assertThat($actualJson, new JsonMatches($expectedJson), $message);
>>>>>>> update
    }

    /**
     * Asserts that two given JSON encoded objects or arrays are not equal.
     *
     * @param string $expectedJson
     * @param string $actualJson
<<<<<<< HEAD
     * @param string $message
     */
    public static function assertJsonStringNotEqualsJsonString($expectedJson, $actualJson, $message = '')
=======
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertJsonStringNotEqualsJsonString($expectedJson, $actualJson, string $message = ''): void
>>>>>>> update
    {
        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);

<<<<<<< HEAD
        $expected = json_decode($expectedJson);
        $actual   = json_decode($actualJson);

        static::assertNotEquals($expected, $actual, $message);
=======
        static::assertThat(
            $actualJson,
            new LogicalNot(
                new JsonMatches($expectedJson)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that the generated JSON encoded object and the content of the given file are equal.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualJson
     * @param string $message
     */
    public static function assertJsonStringEqualsJsonFile($expectedFile, $actualJson, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertJsonStringEqualsJsonFile(string $expectedFile, string $actualJson, string $message = ''): void
>>>>>>> update
    {
        static::assertFileExists($expectedFile, $message);
        $expectedJson = file_get_contents($expectedFile);

        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);

<<<<<<< HEAD
        // call constraint
        $constraint = new PHPUnit_Framework_Constraint_JsonMatches(
            $expectedJson
        );

        static::assertThat($actualJson, $constraint, $message);
=======
        static::assertThat($actualJson, new JsonMatches($expectedJson), $message);
>>>>>>> update
    }

    /**
     * Asserts that the generated JSON encoded object and the content of the given file are not equal.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualJson
     * @param string $message
     */
    public static function assertJsonStringNotEqualsJsonFile($expectedFile, $actualJson, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertJsonStringNotEqualsJsonFile(string $expectedFile, string $actualJson, string $message = ''): void
>>>>>>> update
    {
        static::assertFileExists($expectedFile, $message);
        $expectedJson = file_get_contents($expectedFile);

        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);

<<<<<<< HEAD
        // call constraint
        $constraint = new PHPUnit_Framework_Constraint_JsonMatches(
            $expectedJson
        );

        static::assertThat($actualJson, new PHPUnit_Framework_Constraint_Not($constraint), $message);
=======
        static::assertThat(
            $actualJson,
            new LogicalNot(
                new JsonMatches($expectedJson)
            ),
            $message
        );
>>>>>>> update
    }

    /**
     * Asserts that two JSON files are equal.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualFile
     * @param string $message
     */
    public static function assertJsonFileEqualsJsonFile($expectedFile, $actualFile, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertJsonFileEqualsJsonFile(string $expectedFile, string $actualFile, string $message = ''): void
>>>>>>> update
    {
        static::assertFileExists($expectedFile, $message);
        static::assertFileExists($actualFile, $message);

        $actualJson   = file_get_contents($actualFile);
        $expectedJson = file_get_contents($expectedFile);

        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);

<<<<<<< HEAD
        // call constraint
        $constraintExpected = new PHPUnit_Framework_Constraint_JsonMatches(
            $expectedJson
        );

        $constraintActual = new PHPUnit_Framework_Constraint_JsonMatches($actualJson);
=======
        $constraintExpected = new JsonMatches(
            $expectedJson
        );

        $constraintActual = new JsonMatches($actualJson);
>>>>>>> update

        static::assertThat($expectedJson, $constraintActual, $message);
        static::assertThat($actualJson, $constraintExpected, $message);
    }

    /**
     * Asserts that two JSON files are not equal.
     *
<<<<<<< HEAD
     * @param string $expectedFile
     * @param string $actualFile
     * @param string $message
     */
    public static function assertJsonFileNotEqualsJsonFile($expectedFile, $actualFile, $message = '')
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public static function assertJsonFileNotEqualsJsonFile(string $expectedFile, string $actualFile, string $message = ''): void
>>>>>>> update
    {
        static::assertFileExists($expectedFile, $message);
        static::assertFileExists($actualFile, $message);

        $actualJson   = file_get_contents($actualFile);
        $expectedJson = file_get_contents($expectedFile);

        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);

<<<<<<< HEAD
        // call constraint
        $constraintExpected = new PHPUnit_Framework_Constraint_JsonMatches(
            $expectedJson
        );

        $constraintActual = new PHPUnit_Framework_Constraint_JsonMatches($actualJson);

        static::assertThat($expectedJson, new PHPUnit_Framework_Constraint_Not($constraintActual), $message);
        static::assertThat($actualJson, new PHPUnit_Framework_Constraint_Not($constraintExpected), $message);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_And matcher object.
     *
     * @return PHPUnit_Framework_Constraint_And
     *
     * @since Method available since Release 3.0.0
     */
    public static function logicalAnd()
    {
        $constraints = func_get_args();

        $constraint = new PHPUnit_Framework_Constraint_And;
=======
        $constraintExpected = new JsonMatches(
            $expectedJson
        );

        $constraintActual = new JsonMatches($actualJson);

        static::assertThat($expectedJson, new LogicalNot($constraintActual), $message);
        static::assertThat($actualJson, new LogicalNot($constraintExpected), $message);
    }

    /**
     * @throws Exception
     */
    public static function logicalAnd(): LogicalAnd
    {
        $constraints = func_get_args();

        $constraint = new LogicalAnd;
>>>>>>> update
        $constraint->setConstraints($constraints);

        return $constraint;
    }

<<<<<<< HEAD
    /**
     * Returns a PHPUnit_Framework_Constraint_Or matcher object.
     *
     * @return PHPUnit_Framework_Constraint_Or
     *
     * @since Method available since Release 3.0.0
     */
    public static function logicalOr()
    {
        $constraints = func_get_args();

        $constraint = new PHPUnit_Framework_Constraint_Or;
=======
    public static function logicalOr(): LogicalOr
    {
        $constraints = func_get_args();

        $constraint = new LogicalOr;
>>>>>>> update
        $constraint->setConstraints($constraints);

        return $constraint;
    }

<<<<<<< HEAD
    /**
     * Returns a PHPUnit_Framework_Constraint_Not matcher object.
     *
     * @param PHPUnit_Framework_Constraint $constraint
     *
     * @return PHPUnit_Framework_Constraint_Not
     *
     * @since Method available since Release 3.0.0
     */
    public static function logicalNot(PHPUnit_Framework_Constraint $constraint)
    {
        return new PHPUnit_Framework_Constraint_Not($constraint);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_Xor matcher object.
     *
     * @return PHPUnit_Framework_Constraint_Xor
     *
     * @since Method available since Release 3.0.0
     */
    public static function logicalXor()
    {
        $constraints = func_get_args();

        $constraint = new PHPUnit_Framework_Constraint_Xor;
=======
    public static function logicalNot(Constraint $constraint): LogicalNot
    {
        return new LogicalNot($constraint);
    }

    public static function logicalXor(): LogicalXor
    {
        $constraints = func_get_args();

        $constraint = new LogicalXor;
>>>>>>> update
        $constraint->setConstraints($constraints);

        return $constraint;
    }

<<<<<<< HEAD
    /**
     * Returns a PHPUnit_Framework_Constraint_IsAnything matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsAnything
     *
     * @since Method available since Release 3.0.0
     */
    public static function anything()
    {
        return new PHPUnit_Framework_Constraint_IsAnything;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsTrue matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsTrue
     *
     * @since Method available since Release 3.3.0
     */
    public static function isTrue()
    {
        return new PHPUnit_Framework_Constraint_IsTrue;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_Callback matcher object.
     *
     * @param callable $callback
     *
     * @return PHPUnit_Framework_Constraint_Callback
     */
    public static function callback($callback)
    {
        return new PHPUnit_Framework_Constraint_Callback($callback);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsFalse matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsFalse
     *
     * @since Method available since Release 3.3.0
     */
    public static function isFalse()
    {
        return new PHPUnit_Framework_Constraint_IsFalse;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsJson matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsJson
     *
     * @since Method available since Release 3.7.20
     */
    public static function isJson()
    {
        return new PHPUnit_Framework_Constraint_IsJson;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsNull matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsNull
     *
     * @since Method available since Release 3.3.0
     */
    public static function isNull()
    {
        return new PHPUnit_Framework_Constraint_IsNull;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsFinite matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsFinite
     *
     * @since Method available since Release 5.0.0
     */
    public static function isFinite()
    {
        return new PHPUnit_Framework_Constraint_IsFinite;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsInfinite matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsInfinite
     *
     * @since Method available since Release 5.0.0
     */
    public static function isInfinite()
    {
        return new PHPUnit_Framework_Constraint_IsInfinite;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsNan matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsNan
     *
     * @since Method available since Release 5.0.0
     */
    public static function isNan()
    {
        return new PHPUnit_Framework_Constraint_IsNan;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_Attribute matcher object.
     *
     * @param PHPUnit_Framework_Constraint $constraint
     * @param string                       $attributeName
     *
     * @return PHPUnit_Framework_Constraint_Attribute
     *
     * @since Method available since Release 3.1.0
     */
    public static function attribute(PHPUnit_Framework_Constraint $constraint, $attributeName)
    {
        return new PHPUnit_Framework_Constraint_Attribute(
            $constraint,
            $attributeName
        );
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_TraversableContains matcher
     * object.
     *
     * @param mixed $value
     * @param bool  $checkForObjectIdentity
     * @param bool  $checkForNonObjectIdentity
     *
     * @return PHPUnit_Framework_Constraint_TraversableContains
     *
     * @since Method available since Release 3.0.0
     */
    public static function contains($value, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
    {
        return new PHPUnit_Framework_Constraint_TraversableContains($value, $checkForObjectIdentity, $checkForNonObjectIdentity);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_TraversableContainsOnly matcher
     * object.
     *
     * @param string $type
     *
     * @return PHPUnit_Framework_Constraint_TraversableContainsOnly
     *
     * @since Method available since Release 3.1.4
     */
    public static function containsOnly($type)
    {
        return new PHPUnit_Framework_Constraint_TraversableContainsOnly($type);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_TraversableContainsOnly matcher
     * object.
     *
     * @param string $classname
     *
     * @return PHPUnit_Framework_Constraint_TraversableContainsOnly
     */
    public static function containsOnlyInstancesOf($classname)
    {
        return new PHPUnit_Framework_Constraint_TraversableContainsOnly($classname, false);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_ArrayHasKey matcher object.
     *
     * @param mixed $key
     *
     * @return PHPUnit_Framework_Constraint_ArrayHasKey
     *
     * @since Method available since Release 3.0.0
     */
    public static function arrayHasKey($key)
    {
        return new PHPUnit_Framework_Constraint_ArrayHasKey($key);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsEqual matcher object.
     *
     * @param mixed $value
     * @param float $delta
     * @param int   $maxDepth
     * @param bool  $canonicalize
     * @param bool  $ignoreCase
     *
     * @return PHPUnit_Framework_Constraint_IsEqual
     *
     * @since Method available since Release 3.0.0
     */
    public static function equalTo($value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        return new PHPUnit_Framework_Constraint_IsEqual(
            $value,
            $delta,
            $maxDepth,
            $canonicalize,
            $ignoreCase
        );
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsEqual matcher object
     * that is wrapped in a PHPUnit_Framework_Constraint_Attribute matcher
     * object.
     *
     * @param string $attributeName
     * @param mixed  $value
     * @param float  $delta
     * @param int    $maxDepth
     * @param bool   $canonicalize
     * @param bool   $ignoreCase
     *
     * @return PHPUnit_Framework_Constraint_Attribute
     *
     * @since Method available since Release 3.1.0
     */
    public static function attributeEqualTo($attributeName, $value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        return static::attribute(
            static::equalTo(
                $value,
                $delta,
                $maxDepth,
                $canonicalize,
                $ignoreCase
            ),
            $attributeName
        );
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsEmpty matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsEmpty
     *
     * @since Method available since Release 3.5.0
     */
    public static function isEmpty()
    {
        return new PHPUnit_Framework_Constraint_IsEmpty;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsWritable matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsWritable
     */
    public static function isWritable()
    {
        return new PHPUnit_Framework_Constraint_IsWritable;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsReadable matcher object.
     *
     * @return PHPUnit_Framework_Constraint_IsReadable
     */
    public static function isReadable()
    {
        return new PHPUnit_Framework_Constraint_IsReadable;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_DirectoryExists matcher object.
     *
     * @return PHPUnit_Framework_Constraint_DirectoryExists
     */
    public static function directoryExists()
    {
        return new PHPUnit_Framework_Constraint_DirectoryExists;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_FileExists matcher object.
     *
     * @return PHPUnit_Framework_Constraint_FileExists
     *
     * @since Method available since Release 3.0.0
     */
    public static function fileExists()
    {
        return new PHPUnit_Framework_Constraint_FileExists;
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_GreaterThan matcher object.
     *
     * @param mixed $value
     *
     * @return PHPUnit_Framework_Constraint_GreaterThan
     *
     * @since Method available since Release 3.0.0
     */
    public static function greaterThan($value)
    {
        return new PHPUnit_Framework_Constraint_GreaterThan($value);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_Or matcher object that wraps
     * a PHPUnit_Framework_Constraint_IsEqual and a
     * PHPUnit_Framework_Constraint_GreaterThan matcher object.
     *
     * @param mixed $value
     *
     * @return PHPUnit_Framework_Constraint_Or
     *
     * @since Method available since Release 3.1.0
     */
    public static function greaterThanOrEqual($value)
    {
        return static::logicalOr(
            new PHPUnit_Framework_Constraint_IsEqual($value),
            new PHPUnit_Framework_Constraint_GreaterThan($value)
        );
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_ClassHasAttribute matcher object.
     *
     * @param string $attributeName
     *
     * @return PHPUnit_Framework_Constraint_ClassHasAttribute
     *
     * @since Method available since Release 3.1.0
     */
    public static function classHasAttribute($attributeName)
    {
        return new PHPUnit_Framework_Constraint_ClassHasAttribute(
            $attributeName
        );
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_ClassHasStaticAttribute matcher
     * object.
     *
     * @param string $attributeName
     *
     * @return PHPUnit_Framework_Constraint_ClassHasStaticAttribute
     *
     * @since Method available since Release 3.1.0
     */
    public static function classHasStaticAttribute($attributeName)
    {
        return new PHPUnit_Framework_Constraint_ClassHasStaticAttribute(
            $attributeName
        );
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_ObjectHasAttribute matcher object.
     *
     * @param string $attributeName
     *
     * @return PHPUnit_Framework_Constraint_ObjectHasAttribute
     *
     * @since Method available since Release 3.0.0
     */
    public static function objectHasAttribute($attributeName)
    {
        return new PHPUnit_Framework_Constraint_ObjectHasAttribute(
            $attributeName
        );
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsIdentical matcher object.
     *
     * @param mixed $value
     *
     * @return PHPUnit_Framework_Constraint_IsIdentical
     *
     * @since Method available since Release 3.0.0
     */
    public static function identicalTo($value)
    {
        return new PHPUnit_Framework_Constraint_IsIdentical($value);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsInstanceOf matcher object.
     *
     * @param string $className
     *
     * @return PHPUnit_Framework_Constraint_IsInstanceOf
     *
     * @since Method available since Release 3.0.0
     */
    public static function isInstanceOf($className)
    {
        return new PHPUnit_Framework_Constraint_IsInstanceOf($className);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_IsType matcher object.
     *
     * @param string $type
     *
     * @return PHPUnit_Framework_Constraint_IsType
     *
     * @since Method available since Release 3.0.0
     */
    public static function isType($type)
    {
        return new PHPUnit_Framework_Constraint_IsType($type);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_LessThan matcher object.
     *
     * @param mixed $value
     *
     * @return PHPUnit_Framework_Constraint_LessThan
     *
     * @since Method available since Release 3.0.0
     */
    public static function lessThan($value)
    {
        return new PHPUnit_Framework_Constraint_LessThan($value);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_Or matcher object that wraps
     * a PHPUnit_Framework_Constraint_IsEqual and a
     * PHPUnit_Framework_Constraint_LessThan matcher object.
     *
     * @param mixed $value
     *
     * @return PHPUnit_Framework_Constraint_Or
     *
     * @since Method available since Release 3.1.0
     */
    public static function lessThanOrEqual($value)
    {
        return static::logicalOr(
            new PHPUnit_Framework_Constraint_IsEqual($value),
            new PHPUnit_Framework_Constraint_LessThan($value)
        );
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_PCREMatch matcher object.
     *
     * @param string $pattern
     *
     * @return PHPUnit_Framework_Constraint_PCREMatch
     *
     * @since Method available since Release 3.0.0
     */
    public static function matchesRegularExpression($pattern)
    {
        return new PHPUnit_Framework_Constraint_PCREMatch($pattern);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_StringMatches matcher object.
     *
     * @param string $string
     *
     * @return PHPUnit_Framework_Constraint_StringMatches
     *
     * @since Method available since Release 3.5.0
     */
    public static function matches($string)
    {
        return new PHPUnit_Framework_Constraint_StringMatches($string);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_StringStartsWith matcher object.
     *
     * @param mixed $prefix
     *
     * @return PHPUnit_Framework_Constraint_StringStartsWith
     *
     * @since Method available since Release 3.4.0
     */
    public static function stringStartsWith($prefix)
    {
        return new PHPUnit_Framework_Constraint_StringStartsWith($prefix);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_StringContains matcher object.
     *
     * @param string $string
     * @param bool   $case
     *
     * @return PHPUnit_Framework_Constraint_StringContains
     *
     * @since Method available since Release 3.0.0
     */
    public static function stringContains($string, $case = true)
    {
        return new PHPUnit_Framework_Constraint_StringContains($string, $case);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_StringEndsWith matcher object.
     *
     * @param mixed $suffix
     *
     * @return PHPUnit_Framework_Constraint_StringEndsWith
     *
     * @since Method available since Release 3.4.0
     */
    public static function stringEndsWith($suffix)
    {
        return new PHPUnit_Framework_Constraint_StringEndsWith($suffix);
    }

    /**
     * Returns a PHPUnit_Framework_Constraint_Count matcher object.
     *
     * @param int $count
     *
     * @return PHPUnit_Framework_Constraint_Count
     */
    public static function countOf($count)
    {
        return new PHPUnit_Framework_Constraint_Count($count);
    }
    /**
     * Fails a test with the given message.
     *
     * @param string $message
     *
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public static function fail($message = '')
    {
        throw new PHPUnit_Framework_AssertionFailedError($message);
    }

    /**
     * Returns the value of an attribute of a class or an object.
     * This also works for attributes that are declared protected or private.
     *
     * @param string|object $classOrObject
     * @param string        $attributeName
     *
     * @return mixed
     *
     * @throws PHPUnit_Framework_Exception
     */
    public static function readAttribute($classOrObject, $attributeName)
    {
        if (!is_string($attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        if (!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'valid attribute name');
        }

        if (is_string($classOrObject)) {
            if (!class_exists($classOrObject)) {
                throw PHPUnit_Util_InvalidArgumentHelper::factory(
                    1,
                    'class name'
                );
            }

            return static::getStaticAttribute(
                $classOrObject,
                $attributeName
            );
        } elseif (is_object($classOrObject)) {
            return static::getObjectAttribute(
                $classOrObject,
                $attributeName
            );
        } else {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                1,
                'class name or object'
            );
        }
    }

    /**
     * Returns the value of a static attribute.
     * This also works for attributes that are declared protected or private.
     *
     * @param string $className
     * @param string $attributeName
     *
     * @return mixed
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 4.0.0
     */
    public static function getStaticAttribute($className, $attributeName)
    {
        if (!is_string($className)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        if (!class_exists($className)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'class name');
        }

        if (!is_string($attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        if (!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'valid attribute name');
        }

        $class = new ReflectionClass($className);

        while ($class) {
            $attributes = $class->getStaticProperties();

            if (array_key_exists($attributeName, $attributes)) {
                return $attributes[$attributeName];
            }

            $class = $class->getParentClass();
        }

        throw new PHPUnit_Framework_Exception(
            sprintf(
                'Attribute "%s" not found in class.',
                $attributeName
            )
        );
    }

    /**
     * Returns the value of an object's attribute.
     * This also works for attributes that are declared protected or private.
     *
     * @param object $object
     * @param string $attributeName
     *
     * @return mixed
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 4.0.0
     */
    public static function getObjectAttribute($object, $attributeName)
    {
        if (!is_object($object)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'object');
        }

        if (!is_string($attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string');
        }

        if (!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'valid attribute name');
        }

        try {
            $attribute = new ReflectionProperty($object, $attributeName);
        } catch (ReflectionException $e) {
            $reflector = new ReflectionObject($object);

            while ($reflector = $reflector->getParentClass()) {
                try {
                    $attribute = $reflector->getProperty($attributeName);
                    break;
                } catch (ReflectionException $e) {
                }
            }
        }

        if (isset($attribute)) {
            if (!$attribute || $attribute->isPublic()) {
                return $object->$attributeName;
            }

            $attribute->setAccessible(true);
            $value = $attribute->getValue($object);
            $attribute->setAccessible(false);

            return $value;
        }

        throw new PHPUnit_Framework_Exception(
            sprintf(
                'Attribute "%s" not found in object.',
                $attributeName
            )
        );
=======
    public static function anything(): IsAnything
    {
        return new IsAnything;
    }

    public static function isTrue(): IsTrue
    {
        return new IsTrue;
    }

    /**
     * @psalm-template CallbackInput of mixed
     *
     * @psalm-param callable(CallbackInput $callback): bool $callback
     *
     * @psalm-return Callback<CallbackInput>
     */
    public static function callback(callable $callback): Callback
    {
        return new Callback($callback);
    }

    public static function isFalse(): IsFalse
    {
        return new IsFalse;
    }

    public static function isJson(): IsJson
    {
        return new IsJson;
    }

    public static function isNull(): IsNull
    {
        return new IsNull;
    }

    public static function isFinite(): IsFinite
    {
        return new IsFinite;
    }

    public static function isInfinite(): IsInfinite
    {
        return new IsInfinite;
    }

    public static function isNan(): IsNan
    {
        return new IsNan;
    }

    public static function containsEqual($value): TraversableContainsEqual
    {
        return new TraversableContainsEqual($value);
    }

    public static function containsIdentical($value): TraversableContainsIdentical
    {
        return new TraversableContainsIdentical($value);
    }

    public static function containsOnly(string $type): TraversableContainsOnly
    {
        return new TraversableContainsOnly($type);
    }

    public static function containsOnlyInstancesOf(string $className): TraversableContainsOnly
    {
        return new TraversableContainsOnly($className, false);
    }

    /**
     * @param int|string $key
     */
    public static function arrayHasKey($key): ArrayHasKey
    {
        return new ArrayHasKey($key);
    }

    public static function equalTo($value): IsEqual
    {
        return new IsEqual($value, 0.0, false, false);
    }

    public static function equalToCanonicalizing($value): IsEqualCanonicalizing
    {
        return new IsEqualCanonicalizing($value);
    }

    public static function equalToIgnoringCase($value): IsEqualIgnoringCase
    {
        return new IsEqualIgnoringCase($value);
    }

    public static function equalToWithDelta($value, float $delta): IsEqualWithDelta
    {
        return new IsEqualWithDelta($value, $delta);
    }

    public static function isEmpty(): IsEmpty
    {
        return new IsEmpty;
    }

    public static function isWritable(): IsWritable
    {
        return new IsWritable;
    }

    public static function isReadable(): IsReadable
    {
        return new IsReadable;
    }

    public static function directoryExists(): DirectoryExists
    {
        return new DirectoryExists;
    }

    public static function fileExists(): FileExists
    {
        return new FileExists;
    }

    public static function greaterThan($value): GreaterThan
    {
        return new GreaterThan($value);
    }

    public static function greaterThanOrEqual($value): LogicalOr
    {
        return static::logicalOr(
            new IsEqual($value),
            new GreaterThan($value)
        );
    }

    public static function classHasAttribute(string $attributeName): ClassHasAttribute
    {
        return new ClassHasAttribute($attributeName);
    }

    public static function classHasStaticAttribute(string $attributeName): ClassHasStaticAttribute
    {
        return new ClassHasStaticAttribute($attributeName);
    }

    public static function objectHasAttribute($attributeName): ObjectHasAttribute
    {
        return new ObjectHasAttribute($attributeName);
    }

    public static function identicalTo($value): IsIdentical
    {
        return new IsIdentical($value);
    }

    public static function isInstanceOf(string $className): IsInstanceOf
    {
        return new IsInstanceOf($className);
    }

    public static function isType(string $type): IsType
    {
        return new IsType($type);
    }

    public static function lessThan($value): LessThan
    {
        return new LessThan($value);
    }

    public static function lessThanOrEqual($value): LogicalOr
    {
        return static::logicalOr(
            new IsEqual($value),
            new LessThan($value)
        );
    }

    public static function matchesRegularExpression(string $pattern): RegularExpression
    {
        return new RegularExpression($pattern);
    }

    public static function matches(string $string): StringMatchesFormatDescription
    {
        return new StringMatchesFormatDescription($string);
    }

    public static function stringStartsWith($prefix): StringStartsWith
    {
        return new StringStartsWith($prefix);
    }

    public static function stringContains(string $string, bool $case = true): StringContains
    {
        return new StringContains($string, $case);
    }

    public static function stringEndsWith(string $suffix): StringEndsWith
    {
        return new StringEndsWith($suffix);
    }

    public static function countOf(int $count): Count
    {
        return new Count($count);
    }

    public static function objectEquals(object $object, string $method = 'equals'): ObjectEquals
    {
        return new ObjectEquals($object, $method);
    }

    /**
     * Fails a test with the given message.
     *
     * @throws AssertionFailedError
     *
     * @psalm-return never-return
     */
    public static function fail(string $message = ''): void
    {
        self::$count++;

        throw new AssertionFailedError($message);
>>>>>>> update
    }

    /**
     * Mark the test as incomplete.
     *
<<<<<<< HEAD
     * @param string $message
     *
     * @throws PHPUnit_Framework_IncompleteTestError
     *
     * @since Method available since Release 3.0.0
     */
    public static function markTestIncomplete($message = '')
    {
        throw new PHPUnit_Framework_IncompleteTestError($message);
=======
     * @throws IncompleteTestError
     *
     * @psalm-return never-return
     */
    public static function markTestIncomplete(string $message = ''): void
    {
        throw new IncompleteTestError($message);
>>>>>>> update
    }

    /**
     * Mark the test as skipped.
     *
<<<<<<< HEAD
     * @param string $message
     *
     * @throws PHPUnit_Framework_SkippedTestError
     *
     * @since Method available since Release 3.0.0
     */
    public static function markTestSkipped($message = '')
    {
        throw new PHPUnit_Framework_SkippedTestError($message);
=======
     * @throws SkippedTestError
     * @throws SyntheticSkippedError
     *
     * @psalm-return never-return
     */
    public static function markTestSkipped(string $message = ''): void
    {
        if ($hint = self::detectLocationHint($message)) {
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            array_unshift($trace, $hint);

            throw new SyntheticSkippedError($hint['message'], 0, $hint['file'], (int) $hint['line'], $trace);
        }

        throw new SkippedTestError($message);
>>>>>>> update
    }

    /**
     * Return the current assertion count.
<<<<<<< HEAD
     *
     * @return int
     *
     * @since Method available since Release 3.3.3
     */
    public static function getCount()
=======
     */
    public static function getCount(): int
>>>>>>> update
    {
        return self::$count;
    }

    /**
     * Reset the assertion counter.
<<<<<<< HEAD
     *
     * @since Method available since Release 3.3.3
     */
    public static function resetCount()
    {
        self::$count = 0;
    }
=======
     */
    public static function resetCount(): void
    {
        self::$count = 0;
    }

    private static function detectLocationHint(string $message): ?array
    {
        $hint  = null;
        $lines = preg_split('/\r\n|\r|\n/', $message);

        while (strpos($lines[0], '__OFFSET') !== false) {
            $offset = explode('=', array_shift($lines));

            if ($offset[0] === '__OFFSET_FILE') {
                $hint['file'] = $offset[1];
            }

            if ($offset[0] === '__OFFSET_LINE') {
                $hint['line'] = $offset[1];
            }
        }

        if ($hint) {
            $hint['message'] = implode(PHP_EOL, $lines);
        }

        return $hint;
    }

    private static function isValidObjectAttributeName(string $attributeName): bool
    {
        return (bool) preg_match('/[^\x00-\x1f\x7f-\x9f]+/', $attributeName);
    }

    private static function isValidClassAttributeName(string $attributeName): bool
    {
        return (bool) preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/', $attributeName);
    }

    /**
     * @codeCoverageIgnore
     */
    private static function createWarning(string $warning): void
    {
        foreach (debug_backtrace() as $step) {
            if (isset($step['object']) && $step['object'] instanceof TestCase) {
                assert($step['object'] instanceof TestCase);

                $step['object']->addWarning($warning);

                break;
            }
        }
    }
>>>>>>> update
}
