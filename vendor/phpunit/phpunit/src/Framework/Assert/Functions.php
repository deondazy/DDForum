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
 * Returns a matcher that matches when the method is executed
 * zero or more times.
 *
 * @return PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount
 *
 * @since Method available since Release 3.0.0
 */
function any()
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::any',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_IsAnything matcher object.
 *
 * @return PHPUnit_Framework_Constraint_IsAnything
 *
 * @since Method available since Release 3.0.0
 */
function anything()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::anything',
        func_get_args()
    );
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
function arrayHasKey($key)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::arrayHasKey',
        func_get_args()
    );
}

/**
 * Asserts that an array has a specified key.
 *
 * @param mixed             $key
 * @param array|ArrayAccess $array
 * @param string            $message
 *
 * @since Method available since Release 3.0.0
 */
function assertArrayHasKey($key, $array, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertArrayHasKey',
        func_get_args()
    );
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
function assertArraySubset($subset, $array, $strict = false, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertArraySubset',
        func_get_args()
    );
}

/**
 * Asserts that an array does not have a specified key.
 *
 * @param mixed             $key
 * @param array|ArrayAccess $array
 * @param string            $message
 *
 * @since Method available since Release 3.0.0
 */
function assertArrayNotHasKey($key, $array, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertArrayNotHasKey',
        func_get_args()
    );
}

/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object contains a needle.
 *
 * @param mixed  $needle
 * @param string $haystackAttributeName
 * @param mixed  $haystackClassOrObject
 * @param string $message
 * @param bool   $ignoreCase
 * @param bool   $checkForObjectIdentity
 * @param bool   $checkForNonObjectIdentity
 *
 * @since Method available since Release 3.0.0
 */
function assertAttributeContains($needle, $haystackAttributeName, $haystackClassOrObject, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeContains',
        func_get_args()
    );
}

/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object contains only values of a given type.
 *
 * @param string $type
 * @param string $haystackAttributeName
 * @param mixed  $haystackClassOrObject
 * @param bool   $isNativeType
 * @param string $message
 *
 * @since Method available since Release 3.1.4
 */
function assertAttributeContainsOnly($type, $haystackAttributeName, $haystackClassOrObject, $isNativeType = null, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeContainsOnly',
        func_get_args()
    );
}

/**
 * Asserts the number of elements of an array, Countable or Traversable
 * that is stored in an attribute.
 *
 * @param int    $expectedCount
 * @param string $haystackAttributeName
 * @param mixed  $haystackClassOrObject
 * @param string $message
 *
 * @since Method available since Release 3.6.0
 */
function assertAttributeCount($expectedCount, $haystackAttributeName, $haystackClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeCount',
        func_get_args()
    );
}

/**
 * Asserts that a static attribute of a class or an attribute of an object
 * is empty.
 *
 * @param string $haystackAttributeName
 * @param mixed  $haystackClassOrObject
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertAttributeEmpty($haystackAttributeName, $haystackClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeEmpty',
        func_get_args()
    );
}

/**
 * Asserts that a variable is equal to an attribute of an object.
 *
 * @param mixed  $expected
 * @param string $actualAttributeName
 * @param string $actualClassOrObject
 * @param string $message
 * @param float  $delta
 * @param int    $maxDepth
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 */
function assertAttributeEquals($expected, $actualAttributeName, $actualClassOrObject, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeEquals',
        func_get_args()
    );
}

/**
 * Asserts that an attribute is greater than another value.
 *
 * @param mixed  $expected
 * @param string $actualAttributeName
 * @param string $actualClassOrObject
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertAttributeGreaterThan($expected, $actualAttributeName, $actualClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeGreaterThan',
        func_get_args()
    );
}

/**
 * Asserts that an attribute is greater than or equal to another value.
 *
 * @param mixed  $expected
 * @param string $actualAttributeName
 * @param string $actualClassOrObject
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertAttributeGreaterThanOrEqual($expected, $actualAttributeName, $actualClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeGreaterThanOrEqual',
        func_get_args()
    );
}

/**
 * Asserts that an attribute is of a given type.
 *
 * @param string $expected
 * @param string $attributeName
 * @param mixed  $classOrObject
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertAttributeInstanceOf($expected, $attributeName, $classOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeInstanceOf',
        func_get_args()
    );
}

/**
 * Asserts that an attribute is of a given type.
 *
 * @param string $expected
 * @param string $attributeName
 * @param mixed  $classOrObject
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertAttributeInternalType($expected, $attributeName, $classOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeInternalType',
        func_get_args()
    );
}

/**
 * Asserts that an attribute is smaller than another value.
 *
 * @param mixed  $expected
 * @param string $actualAttributeName
 * @param string $actualClassOrObject
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertAttributeLessThan($expected, $actualAttributeName, $actualClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeLessThan',
        func_get_args()
    );
}

/**
 * Asserts that an attribute is smaller than or equal to another value.
 *
 * @param mixed  $expected
 * @param string $actualAttributeName
 * @param string $actualClassOrObject
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertAttributeLessThanOrEqual($expected, $actualAttributeName, $actualClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeLessThanOrEqual',
        func_get_args()
    );
}

/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object does not contain a needle.
 *
 * @param mixed  $needle
 * @param string $haystackAttributeName
 * @param mixed  $haystackClassOrObject
 * @param string $message
 * @param bool   $ignoreCase
 * @param bool   $checkForObjectIdentity
 * @param bool   $checkForNonObjectIdentity
 *
 * @since Method available since Release 3.0.0
 */
function assertAttributeNotContains($needle, $haystackAttributeName, $haystackClassOrObject, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeNotContains',
        func_get_args()
    );
}

/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object does not contain only values of a given
 * type.
 *
 * @param string $type
 * @param string $haystackAttributeName
 * @param mixed  $haystackClassOrObject
 * @param bool   $isNativeType
 * @param string $message
 *
 * @since Method available since Release 3.1.4
 */
function assertAttributeNotContainsOnly($type, $haystackAttributeName, $haystackClassOrObject, $isNativeType = null, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeNotContainsOnly',
        func_get_args()
    );
}

/**
 * Asserts the number of elements of an array, Countable or Traversable
 * that is stored in an attribute.
 *
 * @param int    $expectedCount
 * @param string $haystackAttributeName
 * @param mixed  $haystackClassOrObject
 * @param string $message
 *
 * @since Method available since Release 3.6.0
 */
function assertAttributeNotCount($expectedCount, $haystackAttributeName, $haystackClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeNotCount',
        func_get_args()
    );
}

/**
 * Asserts that a static attribute of a class or an attribute of an object
 * is not empty.
 *
 * @param string $haystackAttributeName
 * @param mixed  $haystackClassOrObject
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertAttributeNotEmpty($haystackAttributeName, $haystackClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeNotEmpty',
        func_get_args()
    );
}

/**
 * Asserts that a variable is not equal to an attribute of an object.
 *
 * @param mixed  $expected
 * @param string $actualAttributeName
 * @param string $actualClassOrObject
 * @param string $message
 * @param float  $delta
 * @param int    $maxDepth
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 */
function assertAttributeNotEquals($expected, $actualAttributeName, $actualClassOrObject, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeNotEquals',
        func_get_args()
    );
}

/**
 * Asserts that an attribute is of a given type.
 *
 * @param string $expected
 * @param string $attributeName
 * @param mixed  $classOrObject
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertAttributeNotInstanceOf($expected, $attributeName, $classOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeNotInstanceOf',
        func_get_args()
    );
}

/**
 * Asserts that an attribute is of a given type.
 *
 * @param string $expected
 * @param string $attributeName
 * @param mixed  $classOrObject
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertAttributeNotInternalType($expected, $attributeName, $classOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeNotInternalType',
        func_get_args()
    );
}

/**
 * Asserts that a variable and an attribute of an object do not have the
 * same type and value.
 *
 * @param mixed  $expected
 * @param string $actualAttributeName
 * @param object $actualClassOrObject
 * @param string $message
 */
function assertAttributeNotSame($expected, $actualAttributeName, $actualClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeNotSame',
        func_get_args()
    );
}

/**
 * Asserts that a variable and an attribute of an object have the same type
 * and value.
 *
 * @param mixed  $expected
 * @param string $actualAttributeName
 * @param object $actualClassOrObject
 * @param string $message
 */
function assertAttributeSame($expected, $actualAttributeName, $actualClassOrObject, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertAttributeSame',
        func_get_args()
    );
}

/**
 * Asserts that a class has a specified attribute.
 *
 * @param string $attributeName
 * @param string $className
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertClassHasAttribute($attributeName, $className, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertClassHasAttribute',
        func_get_args()
    );
}

/**
 * Asserts that a class has a specified static attribute.
 *
 * @param string $attributeName
 * @param string $className
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertClassHasStaticAttribute($attributeName, $className, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertClassHasStaticAttribute',
        func_get_args()
    );
}

/**
 * Asserts that a class does not have a specified attribute.
 *
 * @param string $attributeName
 * @param string $className
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertClassNotHasAttribute($attributeName, $className, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertClassNotHasAttribute',
        func_get_args()
    );
}

/**
 * Asserts that a class does not have a specified static attribute.
 *
 * @param string $attributeName
 * @param string $className
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertClassNotHasStaticAttribute($attributeName, $className, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertClassNotHasStaticAttribute',
        func_get_args()
    );
}

/**
 * Asserts that a haystack contains a needle.
 *
 * @param mixed  $needle
 * @param mixed  $haystack
 * @param string $message
 * @param bool   $ignoreCase
 * @param bool   $checkForObjectIdentity
 * @param bool   $checkForNonObjectIdentity
 *
 * @since Method available since Release 2.1.0
 */
function assertContains($needle, $haystack, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertContains',
        func_get_args()
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
function assertContainsOnly($type, $haystack, $isNativeType = null, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertContainsOnly',
        func_get_args()
    );
}

/**
 * Asserts that a haystack contains only instances of a given classname
 *
 * @param string            $classname
 * @param array|Traversable $haystack
 * @param string            $message
 */
function assertContainsOnlyInstancesOf($classname, $haystack, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertContainsOnlyInstancesOf',
        func_get_args()
    );
}

/**
 * Asserts the number of elements of an array, Countable or Traversable.
 *
 * @param int    $expectedCount
 * @param mixed  $haystack
 * @param string $message
 */
function assertCount($expectedCount, $haystack, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertCount',
        func_get_args()
    );
}

/**
 * Asserts that a variable is empty.
 *
 * @param mixed  $actual
 * @param string $message
 *
 * @throws PHPUnit_Framework_AssertionFailedError
 */
function assertEmpty($actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertEmpty',
        func_get_args()
    );
}

/**
 * Asserts that a hierarchy of DOMElements matches.
 *
 * @param DOMElement $expectedElement
 * @param DOMElement $actualElement
 * @param bool       $checkAttributes
 * @param string     $message
 *
 * @since Method available since Release 3.3.0
 */
function assertEqualXMLStructure(DOMElement $expectedElement, DOMElement $actualElement, $checkAttributes = false, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertEqualXMLStructure',
        func_get_args()
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
function assertEquals($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertEquals',
        func_get_args()
    );
}

/**
 * Asserts that a condition is not true.
 *
 * @param bool   $condition
 * @param string $message
 *
 * @throws PHPUnit_Framework_AssertionFailedError
 */
function assertNotTrue($condition, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotTrue',
        func_get_args()
    );
}

/**
 * Asserts that a condition is false.
 *
 * @param bool   $condition
 * @param string $message
 *
 * @throws PHPUnit_Framework_AssertionFailedError
 */
function assertFalse($condition, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertFalse',
        func_get_args()
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
function assertFileEquals($expected, $actual, $message = '', $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertFileEquals',
        func_get_args()
    );
}

/**
 * Asserts that a file exists.
 *
 * @param string $filename
 * @param string $message
 *
 * @since Method available since Release 3.0.0
 */
function assertFileExists($filename, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertFileExists',
        func_get_args()
    );
}

/**
 * Asserts that the contents of one file is not equal to the contents of
 * another file.
 *
 * @param string $expected
 * @param string $actual
 * @param string $message
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 *
 * @since Method available since Release 3.2.14
 */
function assertFileNotEquals($expected, $actual, $message = '', $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertFileNotEquals',
        func_get_args()
    );
}

/**
 * Asserts that a file does not exist.
 *
 * @param string $filename
 * @param string $message
 *
 * @since Method available since Release 3.0.0
 */
function assertFileNotExists($filename, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertFileNotExists',
        func_get_args()
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
function assertGreaterThan($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertGreaterThan',
        func_get_args()
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
function assertGreaterThanOrEqual($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertGreaterThanOrEqual',
        func_get_args()
    );
}

/**
 * Asserts that a variable is of a given type.
 *
 * @param string $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertInstanceOf($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertInstanceOf',
        func_get_args()
    );
}

/**
 * Asserts that a variable is of a given type.
 *
 * @param string $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertInternalType($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertInternalType',
        func_get_args()
    );
}

/**
 * Asserts that a string is a valid JSON string.
 *
 * @param string $actualJson
 * @param string $message
 *
 * @since Method available since Release 3.7.20
 */
function assertJson($actualJson, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertJson',
        func_get_args()
    );
}

/**
 * Asserts that two JSON files are equal.
 *
 * @param string $expectedFile
 * @param string $actualFile
 * @param string $message
 */
function assertJsonFileEqualsJsonFile($expectedFile, $actualFile, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertJsonFileEqualsJsonFile',
        func_get_args()
    );
}

/**
 * Asserts that two JSON files are not equal.
 *
 * @param string $expectedFile
 * @param string $actualFile
 * @param string $message
 */
function assertJsonFileNotEqualsJsonFile($expectedFile, $actualFile, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertJsonFileNotEqualsJsonFile',
        func_get_args()
    );
}

/**
 * Asserts that the generated JSON encoded object and the content of the given file are equal.
 *
 * @param string $expectedFile
 * @param string $actualJson
 * @param string $message
 */
function assertJsonStringEqualsJsonFile($expectedFile, $actualJson, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertJsonStringEqualsJsonFile',
        func_get_args()
    );
}

/**
 * Asserts that two given JSON encoded objects or arrays are equal.
 *
 * @param string $expectedJson
 * @param string $actualJson
 * @param string $message
 */
function assertJsonStringEqualsJsonString($expectedJson, $actualJson, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertJsonStringEqualsJsonString',
        func_get_args()
    );
}

/**
 * Asserts that the generated JSON encoded object and the content of the given file are not equal.
 *
 * @param string $expectedFile
 * @param string $actualJson
 * @param string $message
 */
function assertJsonStringNotEqualsJsonFile($expectedFile, $actualJson, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertJsonStringNotEqualsJsonFile',
        func_get_args()
    );
}

/**
 * Asserts that two given JSON encoded objects or arrays are not equal.
 *
 * @param string $expectedJson
 * @param string $actualJson
 * @param string $message
 */
function assertJsonStringNotEqualsJsonString($expectedJson, $actualJson, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertJsonStringNotEqualsJsonString',
        func_get_args()
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
function assertLessThan($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertLessThan',
        func_get_args()
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
function assertLessThanOrEqual($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertLessThanOrEqual',
        func_get_args()
    );
}

/**
 * Asserts that a variable is finite.
 *
 * @param mixed  $actual
 * @param string $message
 */
function assertFinite($actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertFinite',
        func_get_args()
    );
}

/**
 * Asserts that a variable is infinite.
 *
 * @param mixed  $actual
 * @param string $message
 */
function assertInfinite($actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertInfinite',
        func_get_args()
    );
}

/**
 * Asserts that a variable is nan.
 *
 * @param mixed  $actual
 * @param string $message
 */
function assertNan($actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNan',
        func_get_args()
    );
}

/**
 * Asserts that a haystack does not contain a needle.
 *
 * @param mixed  $needle
 * @param mixed  $haystack
 * @param string $message
 * @param bool   $ignoreCase
 * @param bool   $checkForObjectIdentity
 * @param bool   $checkForNonObjectIdentity
 *
 * @since Method available since Release 2.1.0
 */
function assertNotContains($needle, $haystack, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotContains',
        func_get_args()
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
function assertNotContainsOnly($type, $haystack, $isNativeType = null, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotContainsOnly',
        func_get_args()
    );
}

/**
 * Asserts the number of elements of an array, Countable or Traversable.
 *
 * @param int    $expectedCount
 * @param mixed  $haystack
 * @param string $message
 */
function assertNotCount($expectedCount, $haystack, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotCount',
        func_get_args()
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
function assertNotEmpty($actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotEmpty',
        func_get_args()
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
function assertNotEquals($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotEquals',
        func_get_args()
    );
}

/**
 * Asserts that a variable is not of a given type.
 *
 * @param string $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertNotInstanceOf($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotInstanceOf',
        func_get_args()
    );
}

/**
 * Asserts that a variable is not of a given type.
 *
 * @param string $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertNotInternalType($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotInternalType',
        func_get_args()
    );
}

/**
 * Asserts that a condition is not false.
 *
 * @param bool   $condition
 * @param string $message
 *
 * @throws PHPUnit_Framework_AssertionFailedError
 */
function assertNotFalse($condition, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotFalse',
        func_get_args()
    );
}

/**
 * Asserts that a variable is not null.
 *
 * @param mixed  $actual
 * @param string $message
 */
function assertNotNull($actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotNull',
        func_get_args()
    );
}

/**
 * Asserts that a string does not match a given regular expression.
 *
 * @param string $pattern
 * @param string $string
 * @param string $message
 *
 * @since Method available since Release 2.1.0
 */
function assertNotRegExp($pattern, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotRegExp',
        func_get_args()
    );
}

/**
 * Asserts that two variables do not have the same type and value.
 * Used on objects, it asserts that two variables do not reference
 * the same object.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 */
function assertNotSame($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotSame',
        func_get_args()
    );
}

/**
 * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
 * is not the same.
 *
 * @param array|Countable|Traversable $expected
 * @param array|Countable|Traversable $actual
 * @param string                      $message
 */
function assertNotSameSize($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNotSameSize',
        func_get_args()
    );
}

/**
 * Asserts that a variable is null.
 *
 * @param mixed  $actual
 * @param string $message
 */
function assertNull($actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertNull',
        func_get_args()
    );
}

/**
 * Asserts that an object has a specified attribute.
 *
 * @param string $attributeName
 * @param object $object
 * @param string $message
 *
 * @since Method available since Release 3.0.0
 */
function assertObjectHasAttribute($attributeName, $object, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertObjectHasAttribute',
        func_get_args()
    );
}

/**
 * Asserts that an object does not have a specified attribute.
 *
 * @param string $attributeName
 * @param object $object
 * @param string $message
 *
 * @since Method available since Release 3.0.0
 */
function assertObjectNotHasAttribute($attributeName, $object, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertObjectNotHasAttribute',
        func_get_args()
    );
}

/**
 * Asserts that a string matches a given regular expression.
 *
 * @param string $pattern
 * @param string $string
 * @param string $message
 */
function assertRegExp($pattern, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertRegExp',
        func_get_args()
    );
}

/**
 * Asserts that two variables have the same type and value.
 * Used on objects, it asserts that two variables reference
 * the same object.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 */
function assertSame($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertSame',
        func_get_args()
    );
}

/**
 * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
 * is the same.
 *
 * @param array|Countable|Traversable $expected
 * @param array|Countable|Traversable $actual
 * @param string                      $message
 */
function assertSameSize($expected, $actual, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertSameSize',
        func_get_args()
    );
}

/**
 * Asserts that a string ends not with a given prefix.
 *
 * @param string $suffix
 * @param string $string
 * @param string $message
 *
 * @since Method available since Release 3.4.0
 */
function assertStringEndsNotWith($suffix, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringEndsNotWith',
        func_get_args()
    );
}

/**
 * Asserts that a string ends with a given prefix.
 *
 * @param string $suffix
 * @param string $string
 * @param string $message
 *
 * @since Method available since Release 3.4.0
 */
function assertStringEndsWith($suffix, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringEndsWith',
        func_get_args()
    );
}

/**
 * Asserts that the contents of a string is equal
 * to the contents of a file.
 *
 * @param string $expectedFile
 * @param string $actualString
 * @param string $message
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 *
 * @since Method available since Release 3.3.0
 */
function assertStringEqualsFile($expectedFile, $actualString, $message = '', $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringEqualsFile',
        func_get_args()
    );
}

/**
 * Asserts that a string matches a given format string.
 *
 * @param string $format
 * @param string $string
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertStringMatchesFormat($format, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringMatchesFormat',
        func_get_args()
    );
}

/**
 * Asserts that a string matches a given format file.
 *
 * @param string $formatFile
 * @param string $string
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertStringMatchesFormatFile($formatFile, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringMatchesFormatFile',
        func_get_args()
    );
}

/**
 * Asserts that the contents of a string is not equal
 * to the contents of a file.
 *
 * @param string $expectedFile
 * @param string $actualString
 * @param string $message
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 *
 * @since Method available since Release 3.3.0
 */
function assertStringNotEqualsFile($expectedFile, $actualString, $message = '', $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringNotEqualsFile',
        func_get_args()
    );
}

/**
 * Asserts that a string does not match a given format string.
 *
 * @param string $format
 * @param string $string
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertStringNotMatchesFormat($format, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringNotMatchesFormat',
        func_get_args()
    );
}

/**
 * Asserts that a string does not match a given format string.
 *
 * @param string $formatFile
 * @param string $string
 * @param string $message
 *
 * @since Method available since Release 3.5.0
 */
function assertStringNotMatchesFormatFile($formatFile, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringNotMatchesFormatFile',
        func_get_args()
    );
}

/**
 * Asserts that a string starts not with a given prefix.
 *
 * @param string $prefix
 * @param string $string
 * @param string $message
 *
 * @since Method available since Release 3.4.0
 */
function assertStringStartsNotWith($prefix, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringStartsNotWith',
        func_get_args()
    );
}

/**
 * Asserts that a string starts with a given prefix.
 *
 * @param string $prefix
 * @param string $string
 * @param string $message
 *
 * @since Method available since Release 3.4.0
 */
function assertStringStartsWith($prefix, $string, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertStringStartsWith',
        func_get_args()
    );
}

/**
 * Evaluates a PHPUnit_Framework_Constraint matcher object.
 *
 * @param mixed                        $value
 * @param PHPUnit_Framework_Constraint $constraint
 * @param string                       $message
 *
 * @since Method available since Release 3.0.0
 */
function assertThat($value, PHPUnit_Framework_Constraint $constraint, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertThat',
        func_get_args()
    );
}

/**
 * Asserts that a condition is true.
 *
 * @param bool   $condition
 * @param string $message
 *
 * @throws PHPUnit_Framework_AssertionFailedError
 */
function assertTrue($condition, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertTrue',
        func_get_args()
    );
}

/**
 * Asserts that two XML files are equal.
 *
 * @param string $expectedFile
 * @param string $actualFile
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertXmlFileEqualsXmlFile($expectedFile, $actualFile, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertXmlFileEqualsXmlFile',
        func_get_args()
    );
}

/**
 * Asserts that two XML files are not equal.
 *
 * @param string $expectedFile
 * @param string $actualFile
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertXmlFileNotEqualsXmlFile($expectedFile, $actualFile, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertXmlFileNotEqualsXmlFile',
        func_get_args()
    );
}

/**
 * Asserts that two XML documents are equal.
 *
 * @param string $expectedFile
 * @param string $actualXml
 * @param string $message
 *
 * @since Method available since Release 3.3.0
 */
function assertXmlStringEqualsXmlFile($expectedFile, $actualXml, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertXmlStringEqualsXmlFile',
        func_get_args()
    );
}

/**
 * Asserts that two XML documents are equal.
 *
 * @param string $expectedXml
 * @param string $actualXml
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertXmlStringEqualsXmlString($expectedXml, $actualXml, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertXmlStringEqualsXmlString',
        func_get_args()
    );
}

/**
 * Asserts that two XML documents are not equal.
 *
 * @param string $expectedFile
 * @param string $actualXml
 * @param string $message
 *
 * @since Method available since Release 3.3.0
 */
function assertXmlStringNotEqualsXmlFile($expectedFile, $actualXml, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertXmlStringNotEqualsXmlFile',
        func_get_args()
    );
}

/**
 * Asserts that two XML documents are not equal.
 *
 * @param string $expectedXml
 * @param string $actualXml
 * @param string $message
 *
 * @since Method available since Release 3.1.0
 */
function assertXmlStringNotEqualsXmlString($expectedXml, $actualXml, $message = '')
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::assertXmlStringNotEqualsXmlString',
        func_get_args()
    );
}

/**
 * Returns a matcher that matches when the method is executed
 * at the given $index.
 *
 * @param int $index
 *
 * @return PHPUnit_Framework_MockObject_Matcher_InvokedAtIndex
 *
 * @since Method available since Release 3.0.0
 */
function at($index)
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::at',
        func_get_args()
    );
}

/**
 * Returns a matcher that matches when the method is executed at least once.
 *
 * @return PHPUnit_Framework_MockObject_Matcher_InvokedAtLeastOnce
 *
 * @since Method available since Release 3.0.0
 */
function atLeastOnce()
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::atLeastOnce',
        func_get_args()
    );
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
function attribute(PHPUnit_Framework_Constraint $constraint, $attributeName)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::attribute',
        func_get_args()
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
function attributeEqualTo($attributeName, $value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::attributeEqualTo',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_Callback matcher object.
 *
 * @param callable $callback
 *
 * @return PHPUnit_Framework_Constraint_Callback
 */
function callback($callback)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::callback',
        func_get_args()
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
function classHasAttribute($attributeName)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::classHasAttribute',
        func_get_args()
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
function classHasStaticAttribute($attributeName)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::classHasStaticAttribute',
        func_get_args()
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
function contains($value, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::contains',
        func_get_args()
    );
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
function containsOnly($type)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::containsOnly',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_TraversableContainsOnly matcher
 * object.
 *
 * @param string $classname
 *
 * @return PHPUnit_Framework_Constraint_TraversableContainsOnly
 */
function containsOnlyInstancesOf($classname)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::containsOnlyInstancesOf',
        func_get_args()
    );
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
function equalTo($value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::equalTo',
        func_get_args()
    );
}

/**
 * Returns a matcher that matches when the method is executed
 * exactly $count times.
 *
 * @param int $count
 *
 * @return PHPUnit_Framework_MockObject_Matcher_InvokedCount
 *
 * @since Method available since Release 3.0.0
 */
function exactly($count)
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::exactly',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_FileExists matcher object.
 *
 * @return PHPUnit_Framework_Constraint_FileExists
 *
 * @since Method available since Release 3.0.0
 */
function fileExists()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::fileExists',
        func_get_args()
    );
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
function greaterThan($value)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::greaterThan',
        func_get_args()
    );
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
function greaterThanOrEqual($value)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::greaterThanOrEqual',
        func_get_args()
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
function identicalTo($value)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::identicalTo',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_IsEmpty matcher object.
 *
 * @return PHPUnit_Framework_Constraint_IsEmpty
 *
 * @since Method available since Release 3.5.0
 */
function isEmpty()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::isEmpty',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_IsFalse matcher object.
 *
 * @return PHPUnit_Framework_Constraint_IsFalse
 *
 * @since Method available since Release 3.3.0
 */
function isFalse()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::isFalse',
        func_get_args()
    );
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
function isInstanceOf($className)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::isInstanceOf',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_IsJson matcher object.
 *
 * @return PHPUnit_Framework_Constraint_IsJson
 *
 * @since Method available since Release 3.7.20
 */
function isJson()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::isJson',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_IsNull matcher object.
 *
 * @return PHPUnit_Framework_Constraint_IsNull
 *
 * @since Method available since Release 3.3.0
 */
function isNull()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::isNull',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_IsTrue matcher object.
 *
 * @return PHPUnit_Framework_Constraint_IsTrue
 *
 * @since Method available since Release 3.3.0
 */
function isTrue()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::isTrue',
        func_get_args()
    );
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
function isType($type)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::isType',
        func_get_args()
    );
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
function lessThan($value)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::lessThan',
        func_get_args()
    );
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
function lessThanOrEqual($value)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::lessThanOrEqual',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_And matcher object.
 *
 * @return PHPUnit_Framework_Constraint_And
 *
 * @since Method available since Release 3.0.0
 */
function logicalAnd()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::logicalAnd',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_Not matcher object.
 *
 * @param PHPUnit_Framework_Constraint $constraint
 *
 * @return PHPUnit_Framework_Constraint_Not
 *
 * @since Method available since Release 3.0.0
 */
function logicalNot(PHPUnit_Framework_Constraint $constraint)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::logicalNot',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_Or matcher object.
 *
 * @return PHPUnit_Framework_Constraint_Or
 *
 * @since Method available since Release 3.0.0
 */
function logicalOr()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::logicalOr',
        func_get_args()
    );
}

/**
 * Returns a PHPUnit_Framework_Constraint_Xor matcher object.
 *
 * @return PHPUnit_Framework_Constraint_Xor
 *
 * @since Method available since Release 3.0.0
 */
function logicalXor()
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::logicalXor',
        func_get_args()
    );
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
function matches($string)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::matches',
        func_get_args()
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
function matchesRegularExpression($pattern)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::matchesRegularExpression',
        func_get_args()
    );
}

/**
 * Returns a matcher that matches when the method is never executed.
 *
 * @return PHPUnit_Framework_MockObject_Matcher_InvokedCount
 *
 * @since Method available since Release 3.0.0
 */
function never()
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::never',
        func_get_args()
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
function objectHasAttribute($attributeName)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::objectHasAttribute',
        func_get_args()
    );
}

/**
 * @param mixed $value, ...
 *
 * @return PHPUnit_Framework_MockObject_Stub_ConsecutiveCalls
 *
 * @since Method available since Release 3.0.0
 */
function onConsecutiveCalls()
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::onConsecutiveCalls',
        func_get_args()
    );
}

/**
 * Returns a matcher that matches when the method is executed exactly once.
 *
 * @return PHPUnit_Framework_MockObject_Matcher_InvokedCount
 *
 * @since Method available since Release 3.0.0
 */
function once()
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::once',
        func_get_args()
    );
}

/**
 * @param int $argumentIndex
 *
 * @return PHPUnit_Framework_MockObject_Stub_ReturnArgument
 *
 * @since Method available since Release 3.3.0
 */
function returnArgument($argumentIndex)
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::returnArgument',
        func_get_args()
    );
}

/**
 * @param mixed $callback
 *
 * @return PHPUnit_Framework_MockObject_Stub_ReturnCallback
 *
 * @since Method available since Release 3.3.0
 */
function returnCallback($callback)
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::returnCallback',
        func_get_args()
    );
}

/**
 * Returns the current object.
 *
 * This method is useful when mocking a fluent interface.
 *
 * @return PHPUnit_Framework_MockObject_Stub_ReturnSelf
 *
 * @since Method available since Release 3.6.0
 */
function returnSelf()
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::returnSelf',
        func_get_args()
    );
}

/**
 * @param mixed $value
 *
 * @return PHPUnit_Framework_MockObject_Stub_Return
 *
 * @since Method available since Release 3.0.0
 */
function returnValue($value)
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::returnValue',
        func_get_args()
    );
}

/**
 * @param array $valueMap
 *
 * @return PHPUnit_Framework_MockObject_Stub_ReturnValueMap
 *
 * @since Method available since Release 3.6.0
 */
function returnValueMap(array $valueMap)
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::returnValueMap',
        func_get_args()
    );
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
function stringContains($string, $case = true)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::stringContains',
        func_get_args()
    );
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
function stringEndsWith($suffix)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::stringEndsWith',
        func_get_args()
    );
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
function stringStartsWith($prefix)
{
    return call_user_func_array(
        'PHPUnit_Framework_Assert::stringStartsWith',
        func_get_args()
    );
}

/**
 * @param Exception $exception
 *
 * @return PHPUnit_Framework_MockObject_Stub_Exception
 *
 * @since Method available since Release 3.1.0
 */
function throwException(Exception $exception)
{
    return call_user_func_array(
        'PHPUnit_Framework_TestCase::throwException',
        func_get_args()
    );
=======
namespace PHPUnit\Framework;

use function func_get_args;
use ArrayAccess;
use Countable;
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
use PHPUnit\Framework\Constraint\LessThan;
use PHPUnit\Framework\Constraint\LogicalAnd;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\LogicalOr;
use PHPUnit\Framework\Constraint\LogicalXor;
use PHPUnit\Framework\Constraint\ObjectEquals;
use PHPUnit\Framework\Constraint\ObjectHasAttribute;
use PHPUnit\Framework\Constraint\RegularExpression;
use PHPUnit\Framework\Constraint\StringContains;
use PHPUnit\Framework\Constraint\StringEndsWith;
use PHPUnit\Framework\Constraint\StringMatchesFormatDescription;
use PHPUnit\Framework\Constraint\StringStartsWith;
use PHPUnit\Framework\Constraint\TraversableContainsEqual;
use PHPUnit\Framework\Constraint\TraversableContainsIdentical;
use PHPUnit\Framework\Constraint\TraversableContainsOnly;
use PHPUnit\Framework\MockObject\Rule\AnyInvokedCount as AnyInvokedCountMatcher;
use PHPUnit\Framework\MockObject\Rule\InvokedAtIndex as InvokedAtIndexMatcher;
use PHPUnit\Framework\MockObject\Rule\InvokedAtLeastCount as InvokedAtLeastCountMatcher;
use PHPUnit\Framework\MockObject\Rule\InvokedAtLeastOnce as InvokedAtLeastOnceMatcher;
use PHPUnit\Framework\MockObject\Rule\InvokedAtMostCount as InvokedAtMostCountMatcher;
use PHPUnit\Framework\MockObject\Rule\InvokedCount as InvokedCountMatcher;
use PHPUnit\Framework\MockObject\Stub\ConsecutiveCalls as ConsecutiveCallsStub;
use PHPUnit\Framework\MockObject\Stub\Exception as ExceptionStub;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument as ReturnArgumentStub;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback as ReturnCallbackStub;
use PHPUnit\Framework\MockObject\Stub\ReturnSelf as ReturnSelfStub;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;
use PHPUnit\Framework\MockObject\Stub\ReturnValueMap as ReturnValueMapStub;
use Throwable;

if (!function_exists('PHPUnit\Framework\assertArrayHasKey')) {
    /**
     * Asserts that an array has a specified key.
     *
     * @param int|string        $key
     * @param array|ArrayAccess $array
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertArrayHasKey
     */
    function assertArrayHasKey($key, $array, string $message = ''): void
    {
        Assert::assertArrayHasKey(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertArrayNotHasKey')) {
    /**
     * Asserts that an array does not have a specified key.
     *
     * @param int|string        $key
     * @param array|ArrayAccess $array
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertArrayNotHasKey
     */
    function assertArrayNotHasKey($key, $array, string $message = ''): void
    {
        Assert::assertArrayNotHasKey(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertContains')) {
    /**
     * Asserts that a haystack contains a needle.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertContains
     */
    function assertContains($needle, iterable $haystack, string $message = ''): void
    {
        Assert::assertContains(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertContainsEquals')) {
    function assertContainsEquals($needle, iterable $haystack, string $message = ''): void
    {
        Assert::assertContainsEquals(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotContains')) {
    /**
     * Asserts that a haystack does not contain a needle.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotContains
     */
    function assertNotContains($needle, iterable $haystack, string $message = ''): void
    {
        Assert::assertNotContains(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotContainsEquals')) {
    function assertNotContainsEquals($needle, iterable $haystack, string $message = ''): void
    {
        Assert::assertNotContainsEquals(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertContainsOnly')) {
    /**
     * Asserts that a haystack contains only values of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertContainsOnly
     */
    function assertContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = ''): void
    {
        Assert::assertContainsOnly(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertContainsOnlyInstancesOf')) {
    /**
     * Asserts that a haystack contains only instances of a given class name.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertContainsOnlyInstancesOf
     */
    function assertContainsOnlyInstancesOf(string $className, iterable $haystack, string $message = ''): void
    {
        Assert::assertContainsOnlyInstancesOf(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotContainsOnly')) {
    /**
     * Asserts that a haystack does not contain only values of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotContainsOnly
     */
    function assertNotContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = ''): void
    {
        Assert::assertNotContainsOnly(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertCount')) {
    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     *
     * @param Countable|iterable $haystack
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertCount
     */
    function assertCount(int $expectedCount, $haystack, string $message = ''): void
    {
        Assert::assertCount(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotCount')) {
    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     *
     * @param Countable|iterable $haystack
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotCount
     */
    function assertNotCount(int $expectedCount, $haystack, string $message = ''): void
    {
        Assert::assertNotCount(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertEquals')) {
    /**
     * Asserts that two variables are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertEquals
     */
    function assertEquals($expected, $actual, string $message = ''): void
    {
        Assert::assertEquals(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertEqualsCanonicalizing')) {
    /**
     * Asserts that two variables are equal (canonicalizing).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertEqualsCanonicalizing
     */
    function assertEqualsCanonicalizing($expected, $actual, string $message = ''): void
    {
        Assert::assertEqualsCanonicalizing(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertEqualsIgnoringCase')) {
    /**
     * Asserts that two variables are equal (ignoring case).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertEqualsIgnoringCase
     */
    function assertEqualsIgnoringCase($expected, $actual, string $message = ''): void
    {
        Assert::assertEqualsIgnoringCase(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertEqualsWithDelta')) {
    /**
     * Asserts that two variables are equal (with delta).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertEqualsWithDelta
     */
    function assertEqualsWithDelta($expected, $actual, float $delta, string $message = ''): void
    {
        Assert::assertEqualsWithDelta(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotEquals')) {
    /**
     * Asserts that two variables are not equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotEquals
     */
    function assertNotEquals($expected, $actual, string $message = ''): void
    {
        Assert::assertNotEquals(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotEqualsCanonicalizing')) {
    /**
     * Asserts that two variables are not equal (canonicalizing).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotEqualsCanonicalizing
     */
    function assertNotEqualsCanonicalizing($expected, $actual, string $message = ''): void
    {
        Assert::assertNotEqualsCanonicalizing(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotEqualsIgnoringCase')) {
    /**
     * Asserts that two variables are not equal (ignoring case).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotEqualsIgnoringCase
     */
    function assertNotEqualsIgnoringCase($expected, $actual, string $message = ''): void
    {
        Assert::assertNotEqualsIgnoringCase(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotEqualsWithDelta')) {
    /**
     * Asserts that two variables are not equal (with delta).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotEqualsWithDelta
     */
    function assertNotEqualsWithDelta($expected, $actual, float $delta, string $message = ''): void
    {
        Assert::assertNotEqualsWithDelta(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertObjectEquals')) {
    /**
     * @throws ExpectationFailedException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertObjectEquals
     */
    function assertObjectEquals(object $expected, object $actual, string $method = 'equals', string $message = ''): void
    {
        Assert::assertObjectEquals(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertEmpty')) {
    /**
     * Asserts that a variable is empty.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert empty $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertEmpty
     */
    function assertEmpty($actual, string $message = ''): void
    {
        Assert::assertEmpty(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotEmpty')) {
    /**
     * Asserts that a variable is not empty.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !empty $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotEmpty
     */
    function assertNotEmpty($actual, string $message = ''): void
    {
        Assert::assertNotEmpty(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertGreaterThan')) {
    /**
     * Asserts that a value is greater than another value.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertGreaterThan
     */
    function assertGreaterThan($expected, $actual, string $message = ''): void
    {
        Assert::assertGreaterThan(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertGreaterThanOrEqual')) {
    /**
     * Asserts that a value is greater than or equal to another value.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertGreaterThanOrEqual
     */
    function assertGreaterThanOrEqual($expected, $actual, string $message = ''): void
    {
        Assert::assertGreaterThanOrEqual(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertLessThan')) {
    /**
     * Asserts that a value is smaller than another value.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertLessThan
     */
    function assertLessThan($expected, $actual, string $message = ''): void
    {
        Assert::assertLessThan(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertLessThanOrEqual')) {
    /**
     * Asserts that a value is smaller than or equal to another value.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertLessThanOrEqual
     */
    function assertLessThanOrEqual($expected, $actual, string $message = ''): void
    {
        Assert::assertLessThanOrEqual(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileEquals')) {
    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileEquals
     */
    function assertFileEquals(string $expected, string $actual, string $message = ''): void
    {
        Assert::assertFileEquals(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileEqualsCanonicalizing')) {
    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file (canonicalizing).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileEqualsCanonicalizing
     */
    function assertFileEqualsCanonicalizing(string $expected, string $actual, string $message = ''): void
    {
        Assert::assertFileEqualsCanonicalizing(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileEqualsIgnoringCase')) {
    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file (ignoring case).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileEqualsIgnoringCase
     */
    function assertFileEqualsIgnoringCase(string $expected, string $actual, string $message = ''): void
    {
        Assert::assertFileEqualsIgnoringCase(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileNotEquals')) {
    /**
     * Asserts that the contents of one file is not equal to the contents of
     * another file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileNotEquals
     */
    function assertFileNotEquals(string $expected, string $actual, string $message = ''): void
    {
        Assert::assertFileNotEquals(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileNotEqualsCanonicalizing')) {
    /**
     * Asserts that the contents of one file is not equal to the contents of another
     * file (canonicalizing).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileNotEqualsCanonicalizing
     */
    function assertFileNotEqualsCanonicalizing(string $expected, string $actual, string $message = ''): void
    {
        Assert::assertFileNotEqualsCanonicalizing(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileNotEqualsIgnoringCase')) {
    /**
     * Asserts that the contents of one file is not equal to the contents of another
     * file (ignoring case).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileNotEqualsIgnoringCase
     */
    function assertFileNotEqualsIgnoringCase(string $expected, string $actual, string $message = ''): void
    {
        Assert::assertFileNotEqualsIgnoringCase(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringEqualsFile')) {
    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringEqualsFile
     */
    function assertStringEqualsFile(string $expectedFile, string $actualString, string $message = ''): void
    {
        Assert::assertStringEqualsFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringEqualsFileCanonicalizing')) {
    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file (canonicalizing).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringEqualsFileCanonicalizing
     */
    function assertStringEqualsFileCanonicalizing(string $expectedFile, string $actualString, string $message = ''): void
    {
        Assert::assertStringEqualsFileCanonicalizing(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringEqualsFileIgnoringCase')) {
    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file (ignoring case).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringEqualsFileIgnoringCase
     */
    function assertStringEqualsFileIgnoringCase(string $expectedFile, string $actualString, string $message = ''): void
    {
        Assert::assertStringEqualsFileIgnoringCase(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringNotEqualsFile')) {
    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringNotEqualsFile
     */
    function assertStringNotEqualsFile(string $expectedFile, string $actualString, string $message = ''): void
    {
        Assert::assertStringNotEqualsFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringNotEqualsFileCanonicalizing')) {
    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file (canonicalizing).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringNotEqualsFileCanonicalizing
     */
    function assertStringNotEqualsFileCanonicalizing(string $expectedFile, string $actualString, string $message = ''): void
    {
        Assert::assertStringNotEqualsFileCanonicalizing(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringNotEqualsFileIgnoringCase')) {
    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file (ignoring case).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringNotEqualsFileIgnoringCase
     */
    function assertStringNotEqualsFileIgnoringCase(string $expectedFile, string $actualString, string $message = ''): void
    {
        Assert::assertStringNotEqualsFileIgnoringCase(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsReadable')) {
    /**
     * Asserts that a file/dir is readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsReadable
     */
    function assertIsReadable(string $filename, string $message = ''): void
    {
        Assert::assertIsReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotReadable')) {
    /**
     * Asserts that a file/dir exists and is not readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotReadable
     */
    function assertIsNotReadable(string $filename, string $message = ''): void
    {
        Assert::assertIsNotReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotIsReadable')) {
    /**
     * Asserts that a file/dir exists and is not readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4062
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotIsReadable
     */
    function assertNotIsReadable(string $filename, string $message = ''): void
    {
        Assert::assertNotIsReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsWritable')) {
    /**
     * Asserts that a file/dir exists and is writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsWritable
     */
    function assertIsWritable(string $filename, string $message = ''): void
    {
        Assert::assertIsWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotWritable')) {
    /**
     * Asserts that a file/dir exists and is not writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotWritable
     */
    function assertIsNotWritable(string $filename, string $message = ''): void
    {
        Assert::assertIsNotWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotIsWritable')) {
    /**
     * Asserts that a file/dir exists and is not writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4065
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotIsWritable
     */
    function assertNotIsWritable(string $filename, string $message = ''): void
    {
        Assert::assertNotIsWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDirectoryExists')) {
    /**
     * Asserts that a directory exists.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDirectoryExists
     */
    function assertDirectoryExists(string $directory, string $message = ''): void
    {
        Assert::assertDirectoryExists(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDirectoryDoesNotExist')) {
    /**
     * Asserts that a directory does not exist.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDirectoryDoesNotExist
     */
    function assertDirectoryDoesNotExist(string $directory, string $message = ''): void
    {
        Assert::assertDirectoryDoesNotExist(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDirectoryNotExists')) {
    /**
     * Asserts that a directory does not exist.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4068
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDirectoryNotExists
     */
    function assertDirectoryNotExists(string $directory, string $message = ''): void
    {
        Assert::assertDirectoryNotExists(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDirectoryIsReadable')) {
    /**
     * Asserts that a directory exists and is readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDirectoryIsReadable
     */
    function assertDirectoryIsReadable(string $directory, string $message = ''): void
    {
        Assert::assertDirectoryIsReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDirectoryIsNotReadable')) {
    /**
     * Asserts that a directory exists and is not readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDirectoryIsNotReadable
     */
    function assertDirectoryIsNotReadable(string $directory, string $message = ''): void
    {
        Assert::assertDirectoryIsNotReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDirectoryNotIsReadable')) {
    /**
     * Asserts that a directory exists and is not readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4071
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDirectoryNotIsReadable
     */
    function assertDirectoryNotIsReadable(string $directory, string $message = ''): void
    {
        Assert::assertDirectoryNotIsReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDirectoryIsWritable')) {
    /**
     * Asserts that a directory exists and is writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDirectoryIsWritable
     */
    function assertDirectoryIsWritable(string $directory, string $message = ''): void
    {
        Assert::assertDirectoryIsWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDirectoryIsNotWritable')) {
    /**
     * Asserts that a directory exists and is not writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDirectoryIsNotWritable
     */
    function assertDirectoryIsNotWritable(string $directory, string $message = ''): void
    {
        Assert::assertDirectoryIsNotWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDirectoryNotIsWritable')) {
    /**
     * Asserts that a directory exists and is not writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4074
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDirectoryNotIsWritable
     */
    function assertDirectoryNotIsWritable(string $directory, string $message = ''): void
    {
        Assert::assertDirectoryNotIsWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileExists')) {
    /**
     * Asserts that a file exists.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileExists
     */
    function assertFileExists(string $filename, string $message = ''): void
    {
        Assert::assertFileExists(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileDoesNotExist')) {
    /**
     * Asserts that a file does not exist.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileDoesNotExist
     */
    function assertFileDoesNotExist(string $filename, string $message = ''): void
    {
        Assert::assertFileDoesNotExist(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileNotExists')) {
    /**
     * Asserts that a file does not exist.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4077
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileNotExists
     */
    function assertFileNotExists(string $filename, string $message = ''): void
    {
        Assert::assertFileNotExists(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileIsReadable')) {
    /**
     * Asserts that a file exists and is readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileIsReadable
     */
    function assertFileIsReadable(string $file, string $message = ''): void
    {
        Assert::assertFileIsReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileIsNotReadable')) {
    /**
     * Asserts that a file exists and is not readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileIsNotReadable
     */
    function assertFileIsNotReadable(string $file, string $message = ''): void
    {
        Assert::assertFileIsNotReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileNotIsReadable')) {
    /**
     * Asserts that a file exists and is not readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4080
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileNotIsReadable
     */
    function assertFileNotIsReadable(string $file, string $message = ''): void
    {
        Assert::assertFileNotIsReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileIsWritable')) {
    /**
     * Asserts that a file exists and is writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileIsWritable
     */
    function assertFileIsWritable(string $file, string $message = ''): void
    {
        Assert::assertFileIsWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileIsNotWritable')) {
    /**
     * Asserts that a file exists and is not writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileIsNotWritable
     */
    function assertFileIsNotWritable(string $file, string $message = ''): void
    {
        Assert::assertFileIsNotWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFileNotIsWritable')) {
    /**
     * Asserts that a file exists and is not writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4083
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFileNotIsWritable
     */
    function assertFileNotIsWritable(string $file, string $message = ''): void
    {
        Assert::assertFileNotIsWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertTrue')) {
    /**
     * Asserts that a condition is true.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert true $condition
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertTrue
     */
    function assertTrue($condition, string $message = ''): void
    {
        Assert::assertTrue(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotTrue')) {
    /**
     * Asserts that a condition is not true.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !true $condition
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotTrue
     */
    function assertNotTrue($condition, string $message = ''): void
    {
        Assert::assertNotTrue(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFalse')) {
    /**
     * Asserts that a condition is false.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert false $condition
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFalse
     */
    function assertFalse($condition, string $message = ''): void
    {
        Assert::assertFalse(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotFalse')) {
    /**
     * Asserts that a condition is not false.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !false $condition
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotFalse
     */
    function assertNotFalse($condition, string $message = ''): void
    {
        Assert::assertNotFalse(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNull')) {
    /**
     * Asserts that a variable is null.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert null $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNull
     */
    function assertNull($actual, string $message = ''): void
    {
        Assert::assertNull(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotNull')) {
    /**
     * Asserts that a variable is not null.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !null $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotNull
     */
    function assertNotNull($actual, string $message = ''): void
    {
        Assert::assertNotNull(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertFinite')) {
    /**
     * Asserts that a variable is finite.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertFinite
     */
    function assertFinite($actual, string $message = ''): void
    {
        Assert::assertFinite(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertInfinite')) {
    /**
     * Asserts that a variable is infinite.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertInfinite
     */
    function assertInfinite($actual, string $message = ''): void
    {
        Assert::assertInfinite(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNan')) {
    /**
     * Asserts that a variable is nan.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNan
     */
    function assertNan($actual, string $message = ''): void
    {
        Assert::assertNan(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertClassHasAttribute')) {
    /**
     * Asserts that a class has a specified attribute.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertClassHasAttribute
     */
    function assertClassHasAttribute(string $attributeName, string $className, string $message = ''): void
    {
        Assert::assertClassHasAttribute(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertClassNotHasAttribute')) {
    /**
     * Asserts that a class does not have a specified attribute.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertClassNotHasAttribute
     */
    function assertClassNotHasAttribute(string $attributeName, string $className, string $message = ''): void
    {
        Assert::assertClassNotHasAttribute(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertClassHasStaticAttribute')) {
    /**
     * Asserts that a class has a specified static attribute.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertClassHasStaticAttribute
     */
    function assertClassHasStaticAttribute(string $attributeName, string $className, string $message = ''): void
    {
        Assert::assertClassHasStaticAttribute(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertClassNotHasStaticAttribute')) {
    /**
     * Asserts that a class does not have a specified static attribute.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertClassNotHasStaticAttribute
     */
    function assertClassNotHasStaticAttribute(string $attributeName, string $className, string $message = ''): void
    {
        Assert::assertClassNotHasStaticAttribute(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertObjectHasAttribute')) {
    /**
     * Asserts that an object has a specified attribute.
     *
     * @param object $object
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertObjectHasAttribute
     */
    function assertObjectHasAttribute(string $attributeName, $object, string $message = ''): void
    {
        Assert::assertObjectHasAttribute(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertObjectNotHasAttribute')) {
    /**
     * Asserts that an object does not have a specified attribute.
     *
     * @param object $object
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertObjectNotHasAttribute
     */
    function assertObjectNotHasAttribute(string $attributeName, $object, string $message = ''): void
    {
        Assert::assertObjectNotHasAttribute(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertSame')) {
    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-template ExpectedType
     * @psalm-param ExpectedType $expected
     * @psalm-assert =ExpectedType $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertSame
     */
    function assertSame($expected, $actual, string $message = ''): void
    {
        Assert::assertSame(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotSame')) {
    /**
     * Asserts that two variables do not have the same type and value.
     * Used on objects, it asserts that two variables do not reference
     * the same object.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotSame
     */
    function assertNotSame($expected, $actual, string $message = ''): void
    {
        Assert::assertNotSame(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertInstanceOf')) {
    /**
     * Asserts that a variable is of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $expected
     * @psalm-assert =ExpectedType $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertInstanceOf
     */
    function assertInstanceOf(string $expected, $actual, string $message = ''): void
    {
        Assert::assertInstanceOf(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotInstanceOf')) {
    /**
     * Asserts that a variable is not of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @psalm-template ExpectedType of object
     * @psalm-param class-string<ExpectedType> $expected
     * @psalm-assert !ExpectedType $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotInstanceOf
     */
    function assertNotInstanceOf(string $expected, $actual, string $message = ''): void
    {
        Assert::assertNotInstanceOf(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsArray')) {
    /**
     * Asserts that a variable is of type array.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert array $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsArray
     */
    function assertIsArray($actual, string $message = ''): void
    {
        Assert::assertIsArray(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsBool')) {
    /**
     * Asserts that a variable is of type bool.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert bool $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsBool
     */
    function assertIsBool($actual, string $message = ''): void
    {
        Assert::assertIsBool(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsFloat')) {
    /**
     * Asserts that a variable is of type float.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert float $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsFloat
     */
    function assertIsFloat($actual, string $message = ''): void
    {
        Assert::assertIsFloat(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsInt')) {
    /**
     * Asserts that a variable is of type int.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert int $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsInt
     */
    function assertIsInt($actual, string $message = ''): void
    {
        Assert::assertIsInt(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNumeric')) {
    /**
     * Asserts that a variable is of type numeric.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert numeric $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNumeric
     */
    function assertIsNumeric($actual, string $message = ''): void
    {
        Assert::assertIsNumeric(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsObject')) {
    /**
     * Asserts that a variable is of type object.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert object $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsObject
     */
    function assertIsObject($actual, string $message = ''): void
    {
        Assert::assertIsObject(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsResource')) {
    /**
     * Asserts that a variable is of type resource.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert resource $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsResource
     */
    function assertIsResource($actual, string $message = ''): void
    {
        Assert::assertIsResource(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsClosedResource')) {
    /**
     * Asserts that a variable is of type resource and is closed.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert resource $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsClosedResource
     */
    function assertIsClosedResource($actual, string $message = ''): void
    {
        Assert::assertIsClosedResource(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsString')) {
    /**
     * Asserts that a variable is of type string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert string $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsString
     */
    function assertIsString($actual, string $message = ''): void
    {
        Assert::assertIsString(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsScalar')) {
    /**
     * Asserts that a variable is of type scalar.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert scalar $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsScalar
     */
    function assertIsScalar($actual, string $message = ''): void
    {
        Assert::assertIsScalar(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsCallable')) {
    /**
     * Asserts that a variable is of type callable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert callable $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsCallable
     */
    function assertIsCallable($actual, string $message = ''): void
    {
        Assert::assertIsCallable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsIterable')) {
    /**
     * Asserts that a variable is of type iterable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert iterable $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsIterable
     */
    function assertIsIterable($actual, string $message = ''): void
    {
        Assert::assertIsIterable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotArray')) {
    /**
     * Asserts that a variable is not of type array.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !array $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotArray
     */
    function assertIsNotArray($actual, string $message = ''): void
    {
        Assert::assertIsNotArray(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotBool')) {
    /**
     * Asserts that a variable is not of type bool.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !bool $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotBool
     */
    function assertIsNotBool($actual, string $message = ''): void
    {
        Assert::assertIsNotBool(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotFloat')) {
    /**
     * Asserts that a variable is not of type float.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !float $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotFloat
     */
    function assertIsNotFloat($actual, string $message = ''): void
    {
        Assert::assertIsNotFloat(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotInt')) {
    /**
     * Asserts that a variable is not of type int.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !int $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotInt
     */
    function assertIsNotInt($actual, string $message = ''): void
    {
        Assert::assertIsNotInt(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotNumeric')) {
    /**
     * Asserts that a variable is not of type numeric.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !numeric $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotNumeric
     */
    function assertIsNotNumeric($actual, string $message = ''): void
    {
        Assert::assertIsNotNumeric(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotObject')) {
    /**
     * Asserts that a variable is not of type object.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !object $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotObject
     */
    function assertIsNotObject($actual, string $message = ''): void
    {
        Assert::assertIsNotObject(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotResource')) {
    /**
     * Asserts that a variable is not of type resource.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !resource $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotResource
     */
    function assertIsNotResource($actual, string $message = ''): void
    {
        Assert::assertIsNotResource(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotClosedResource')) {
    /**
     * Asserts that a variable is not of type resource.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !resource $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotClosedResource
     */
    function assertIsNotClosedResource($actual, string $message = ''): void
    {
        Assert::assertIsNotClosedResource(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotString')) {
    /**
     * Asserts that a variable is not of type string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !string $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotString
     */
    function assertIsNotString($actual, string $message = ''): void
    {
        Assert::assertIsNotString(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotScalar')) {
    /**
     * Asserts that a variable is not of type scalar.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !scalar $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotScalar
     */
    function assertIsNotScalar($actual, string $message = ''): void
    {
        Assert::assertIsNotScalar(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotCallable')) {
    /**
     * Asserts that a variable is not of type callable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !callable $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotCallable
     */
    function assertIsNotCallable($actual, string $message = ''): void
    {
        Assert::assertIsNotCallable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertIsNotIterable')) {
    /**
     * Asserts that a variable is not of type iterable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @psalm-assert !iterable $actual
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertIsNotIterable
     */
    function assertIsNotIterable($actual, string $message = ''): void
    {
        Assert::assertIsNotIterable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertMatchesRegularExpression')) {
    /**
     * Asserts that a string matches a given regular expression.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertMatchesRegularExpression
     */
    function assertMatchesRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        Assert::assertMatchesRegularExpression(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertRegExp')) {
    /**
     * Asserts that a string matches a given regular expression.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4086
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertRegExp
     */
    function assertRegExp(string $pattern, string $string, string $message = ''): void
    {
        Assert::assertRegExp(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertDoesNotMatchRegularExpression')) {
    /**
     * Asserts that a string does not match a given regular expression.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertDoesNotMatchRegularExpression
     */
    function assertDoesNotMatchRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        Assert::assertDoesNotMatchRegularExpression(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotRegExp')) {
    /**
     * Asserts that a string does not match a given regular expression.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4089
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotRegExp
     */
    function assertNotRegExp(string $pattern, string $string, string $message = ''): void
    {
        Assert::assertNotRegExp(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertSameSize')) {
    /**
     * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
     * is the same.
     *
     * @param Countable|iterable $expected
     * @param Countable|iterable $actual
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertSameSize
     */
    function assertSameSize($expected, $actual, string $message = ''): void
    {
        Assert::assertSameSize(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertNotSameSize')) {
    /**
     * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
     * is not the same.
     *
     * @param Countable|iterable $expected
     * @param Countable|iterable $actual
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertNotSameSize
     */
    function assertNotSameSize($expected, $actual, string $message = ''): void
    {
        Assert::assertNotSameSize(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringMatchesFormat')) {
    /**
     * Asserts that a string matches a given format string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringMatchesFormat
     */
    function assertStringMatchesFormat(string $format, string $string, string $message = ''): void
    {
        Assert::assertStringMatchesFormat(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringNotMatchesFormat')) {
    /**
     * Asserts that a string does not match a given format string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringNotMatchesFormat
     */
    function assertStringNotMatchesFormat(string $format, string $string, string $message = ''): void
    {
        Assert::assertStringNotMatchesFormat(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringMatchesFormatFile')) {
    /**
     * Asserts that a string matches a given format file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringMatchesFormatFile
     */
    function assertStringMatchesFormatFile(string $formatFile, string $string, string $message = ''): void
    {
        Assert::assertStringMatchesFormatFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringNotMatchesFormatFile')) {
    /**
     * Asserts that a string does not match a given format string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringNotMatchesFormatFile
     */
    function assertStringNotMatchesFormatFile(string $formatFile, string $string, string $message = ''): void
    {
        Assert::assertStringNotMatchesFormatFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringStartsWith')) {
    /**
     * Asserts that a string starts with a given prefix.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringStartsWith
     */
    function assertStringStartsWith(string $prefix, string $string, string $message = ''): void
    {
        Assert::assertStringStartsWith(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringStartsNotWith')) {
    /**
     * Asserts that a string starts not with a given prefix.
     *
     * @param string $prefix
     * @param string $string
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringStartsNotWith
     */
    function assertStringStartsNotWith($prefix, $string, string $message = ''): void
    {
        Assert::assertStringStartsNotWith(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringContainsString')) {
    /**
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringContainsString
     */
    function assertStringContainsString(string $needle, string $haystack, string $message = ''): void
    {
        Assert::assertStringContainsString(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringContainsStringIgnoringCase')) {
    /**
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringContainsStringIgnoringCase
     */
    function assertStringContainsStringIgnoringCase(string $needle, string $haystack, string $message = ''): void
    {
        Assert::assertStringContainsStringIgnoringCase(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringNotContainsString')) {
    /**
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringNotContainsString
     */
    function assertStringNotContainsString(string $needle, string $haystack, string $message = ''): void
    {
        Assert::assertStringNotContainsString(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringNotContainsStringIgnoringCase')) {
    /**
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringNotContainsStringIgnoringCase
     */
    function assertStringNotContainsStringIgnoringCase(string $needle, string $haystack, string $message = ''): void
    {
        Assert::assertStringNotContainsStringIgnoringCase(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringEndsWith')) {
    /**
     * Asserts that a string ends with a given suffix.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringEndsWith
     */
    function assertStringEndsWith(string $suffix, string $string, string $message = ''): void
    {
        Assert::assertStringEndsWith(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertStringEndsNotWith')) {
    /**
     * Asserts that a string ends not with a given suffix.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertStringEndsNotWith
     */
    function assertStringEndsNotWith(string $suffix, string $string, string $message = ''): void
    {
        Assert::assertStringEndsNotWith(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertXmlFileEqualsXmlFile')) {
    /**
     * Asserts that two XML files are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertXmlFileEqualsXmlFile
     */
    function assertXmlFileEqualsXmlFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        Assert::assertXmlFileEqualsXmlFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertXmlFileNotEqualsXmlFile')) {
    /**
     * Asserts that two XML files are not equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \PHPUnit\Util\Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertXmlFileNotEqualsXmlFile
     */
    function assertXmlFileNotEqualsXmlFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        Assert::assertXmlFileNotEqualsXmlFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertXmlStringEqualsXmlFile')) {
    /**
     * Asserts that two XML documents are equal.
     *
     * @param DOMDocument|string $actualXml
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \PHPUnit\Util\Xml\Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertXmlStringEqualsXmlFile
     */
    function assertXmlStringEqualsXmlFile(string $expectedFile, $actualXml, string $message = ''): void
    {
        Assert::assertXmlStringEqualsXmlFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertXmlStringNotEqualsXmlFile')) {
    /**
     * Asserts that two XML documents are not equal.
     *
     * @param DOMDocument|string $actualXml
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \PHPUnit\Util\Xml\Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertXmlStringNotEqualsXmlFile
     */
    function assertXmlStringNotEqualsXmlFile(string $expectedFile, $actualXml, string $message = ''): void
    {
        Assert::assertXmlStringNotEqualsXmlFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertXmlStringEqualsXmlString')) {
    /**
     * Asserts that two XML documents are equal.
     *
     * @param DOMDocument|string $expectedXml
     * @param DOMDocument|string $actualXml
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \PHPUnit\Util\Xml\Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertXmlStringEqualsXmlString
     */
    function assertXmlStringEqualsXmlString($expectedXml, $actualXml, string $message = ''): void
    {
        Assert::assertXmlStringEqualsXmlString(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertXmlStringNotEqualsXmlString')) {
    /**
     * Asserts that two XML documents are not equal.
     *
     * @param DOMDocument|string $expectedXml
     * @param DOMDocument|string $actualXml
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \PHPUnit\Util\Xml\Exception
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertXmlStringNotEqualsXmlString
     */
    function assertXmlStringNotEqualsXmlString($expectedXml, $actualXml, string $message = ''): void
    {
        Assert::assertXmlStringNotEqualsXmlString(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertEqualXMLStructure')) {
    /**
     * Asserts that a hierarchy of DOMElements matches.
     *
     * @throws AssertionFailedError
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @codeCoverageIgnore
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/4091
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertEqualXMLStructure
     */
    function assertEqualXMLStructure(DOMElement $expectedElement, DOMElement $actualElement, bool $checkAttributes = false, string $message = ''): void
    {
        Assert::assertEqualXMLStructure(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertThat')) {
    /**
     * Evaluates a PHPUnit\Framework\Constraint matcher object.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertThat
     */
    function assertThat($value, Constraint $constraint, string $message = ''): void
    {
        Assert::assertThat(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertJson')) {
    /**
     * Asserts that a string is a valid JSON string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertJson
     */
    function assertJson(string $actualJson, string $message = ''): void
    {
        Assert::assertJson(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertJsonStringEqualsJsonString')) {
    /**
     * Asserts that two given JSON encoded objects or arrays are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertJsonStringEqualsJsonString
     */
    function assertJsonStringEqualsJsonString(string $expectedJson, string $actualJson, string $message = ''): void
    {
        Assert::assertJsonStringEqualsJsonString(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertJsonStringNotEqualsJsonString')) {
    /**
     * Asserts that two given JSON encoded objects or arrays are not equal.
     *
     * @param string $expectedJson
     * @param string $actualJson
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertJsonStringNotEqualsJsonString
     */
    function assertJsonStringNotEqualsJsonString($expectedJson, $actualJson, string $message = ''): void
    {
        Assert::assertJsonStringNotEqualsJsonString(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertJsonStringEqualsJsonFile')) {
    /**
     * Asserts that the generated JSON encoded object and the content of the given file are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertJsonStringEqualsJsonFile
     */
    function assertJsonStringEqualsJsonFile(string $expectedFile, string $actualJson, string $message = ''): void
    {
        Assert::assertJsonStringEqualsJsonFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertJsonStringNotEqualsJsonFile')) {
    /**
     * Asserts that the generated JSON encoded object and the content of the given file are not equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertJsonStringNotEqualsJsonFile
     */
    function assertJsonStringNotEqualsJsonFile(string $expectedFile, string $actualJson, string $message = ''): void
    {
        Assert::assertJsonStringNotEqualsJsonFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertJsonFileEqualsJsonFile')) {
    /**
     * Asserts that two JSON files are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertJsonFileEqualsJsonFile
     */
    function assertJsonFileEqualsJsonFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        Assert::assertJsonFileEqualsJsonFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\assertJsonFileNotEqualsJsonFile')) {
    /**
     * Asserts that two JSON files are not equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
     *
     * @see Assert::assertJsonFileNotEqualsJsonFile
     */
    function assertJsonFileNotEqualsJsonFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        Assert::assertJsonFileNotEqualsJsonFile(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\logicalAnd')) {
    function logicalAnd(): LogicalAnd
    {
        return Assert::logicalAnd(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\logicalOr')) {
    function logicalOr(): LogicalOr
    {
        return Assert::logicalOr(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\logicalNot')) {
    function logicalNot(Constraint $constraint): LogicalNot
    {
        return Assert::logicalNot(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\logicalXor')) {
    function logicalXor(): LogicalXor
    {
        return Assert::logicalXor(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\anything')) {
    function anything(): IsAnything
    {
        return Assert::anything(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isTrue')) {
    function isTrue(): IsTrue
    {
        return Assert::isTrue(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\callback')) {
    function callback(callable $callback): Callback
    {
        return Assert::callback(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isFalse')) {
    function isFalse(): IsFalse
    {
        return Assert::isFalse(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isJson')) {
    function isJson(): IsJson
    {
        return Assert::isJson(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isNull')) {
    function isNull(): IsNull
    {
        return Assert::isNull(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isFinite')) {
    function isFinite(): IsFinite
    {
        return Assert::isFinite(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isInfinite')) {
    function isInfinite(): IsInfinite
    {
        return Assert::isInfinite(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isNan')) {
    function isNan(): IsNan
    {
        return Assert::isNan(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\containsEqual')) {
    function containsEqual($value): TraversableContainsEqual
    {
        return Assert::containsEqual(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\containsIdentical')) {
    function containsIdentical($value): TraversableContainsIdentical
    {
        return Assert::containsIdentical(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\containsOnly')) {
    function containsOnly(string $type): TraversableContainsOnly
    {
        return Assert::containsOnly(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\containsOnlyInstancesOf')) {
    function containsOnlyInstancesOf(string $className): TraversableContainsOnly
    {
        return Assert::containsOnlyInstancesOf(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\arrayHasKey')) {
    function arrayHasKey($key): ArrayHasKey
    {
        return Assert::arrayHasKey(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\equalTo')) {
    function equalTo($value): IsEqual
    {
        return Assert::equalTo(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\equalToCanonicalizing')) {
    function equalToCanonicalizing($value): IsEqualCanonicalizing
    {
        return Assert::equalToCanonicalizing(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\equalToIgnoringCase')) {
    function equalToIgnoringCase($value): IsEqualIgnoringCase
    {
        return Assert::equalToIgnoringCase(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\equalToWithDelta')) {
    function equalToWithDelta($value, float $delta): IsEqualWithDelta
    {
        return Assert::equalToWithDelta(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isEmpty')) {
    function isEmpty(): IsEmpty
    {
        return Assert::isEmpty(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isWritable')) {
    function isWritable(): IsWritable
    {
        return Assert::isWritable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isReadable')) {
    function isReadable(): IsReadable
    {
        return Assert::isReadable(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\directoryExists')) {
    function directoryExists(): DirectoryExists
    {
        return Assert::directoryExists(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\fileExists')) {
    function fileExists(): FileExists
    {
        return Assert::fileExists(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\greaterThan')) {
    function greaterThan($value): GreaterThan
    {
        return Assert::greaterThan(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\greaterThanOrEqual')) {
    function greaterThanOrEqual($value): LogicalOr
    {
        return Assert::greaterThanOrEqual(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\classHasAttribute')) {
    function classHasAttribute(string $attributeName): ClassHasAttribute
    {
        return Assert::classHasAttribute(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\classHasStaticAttribute')) {
    function classHasStaticAttribute(string $attributeName): ClassHasStaticAttribute
    {
        return Assert::classHasStaticAttribute(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\objectHasAttribute')) {
    function objectHasAttribute($attributeName): ObjectHasAttribute
    {
        return Assert::objectHasAttribute(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\identicalTo')) {
    function identicalTo($value): IsIdentical
    {
        return Assert::identicalTo(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isInstanceOf')) {
    function isInstanceOf(string $className): IsInstanceOf
    {
        return Assert::isInstanceOf(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\isType')) {
    function isType(string $type): IsType
    {
        return Assert::isType(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\lessThan')) {
    function lessThan($value): LessThan
    {
        return Assert::lessThan(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\lessThanOrEqual')) {
    function lessThanOrEqual($value): LogicalOr
    {
        return Assert::lessThanOrEqual(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\matchesRegularExpression')) {
    function matchesRegularExpression(string $pattern): RegularExpression
    {
        return Assert::matchesRegularExpression(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\matches')) {
    function matches(string $string): StringMatchesFormatDescription
    {
        return Assert::matches(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\stringStartsWith')) {
    function stringStartsWith($prefix): StringStartsWith
    {
        return Assert::stringStartsWith(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\stringContains')) {
    function stringContains(string $string, bool $case = true): StringContains
    {
        return Assert::stringContains(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\stringEndsWith')) {
    function stringEndsWith(string $suffix): StringEndsWith
    {
        return Assert::stringEndsWith(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\countOf')) {
    function countOf(int $count): Count
    {
        return Assert::countOf(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\objectEquals')) {
    function objectEquals(object $object, string $method = 'equals'): ObjectEquals
    {
        return Assert::objectEquals(...func_get_args());
    }
}

if (!function_exists('PHPUnit\Framework\any')) {
    /**
     * Returns a matcher that matches when the method is executed
     * zero or more times.
     */
    function any(): AnyInvokedCountMatcher
    {
        return new AnyInvokedCountMatcher;
    }
}

if (!function_exists('PHPUnit\Framework\never')) {
    /**
     * Returns a matcher that matches when the method is never executed.
     */
    function never(): InvokedCountMatcher
    {
        return new InvokedCountMatcher(0);
    }
}

if (!function_exists('PHPUnit\Framework\atLeast')) {
    /**
     * Returns a matcher that matches when the method is executed
     * at least N times.
     */
    function atLeast(int $requiredInvocations): InvokedAtLeastCountMatcher
    {
        return new InvokedAtLeastCountMatcher(
            $requiredInvocations
        );
    }
}

if (!function_exists('PHPUnit\Framework\atLeastOnce')) {
    /**
     * Returns a matcher that matches when the method is executed at least once.
     */
    function atLeastOnce(): InvokedAtLeastOnceMatcher
    {
        return new InvokedAtLeastOnceMatcher;
    }
}

if (!function_exists('PHPUnit\Framework\once')) {
    /**
     * Returns a matcher that matches when the method is executed exactly once.
     */
    function once(): InvokedCountMatcher
    {
        return new InvokedCountMatcher(1);
    }
}

if (!function_exists('PHPUnit\Framework\exactly')) {
    /**
     * Returns a matcher that matches when the method is executed
     * exactly $count times.
     */
    function exactly(int $count): InvokedCountMatcher
    {
        return new InvokedCountMatcher($count);
    }
}

if (!function_exists('PHPUnit\Framework\atMost')) {
    /**
     * Returns a matcher that matches when the method is executed
     * at most N times.
     */
    function atMost(int $allowedInvocations): InvokedAtMostCountMatcher
    {
        return new InvokedAtMostCountMatcher($allowedInvocations);
    }
}

if (!function_exists('PHPUnit\Framework\at')) {
    /**
     * Returns a matcher that matches when the method is executed
     * at the given index.
     */
    function at(int $index): InvokedAtIndexMatcher
    {
        return new InvokedAtIndexMatcher($index);
    }
}

if (!function_exists('PHPUnit\Framework\returnValue')) {
    function returnValue($value): ReturnStub
    {
        return new ReturnStub($value);
    }
}

if (!function_exists('PHPUnit\Framework\returnValueMap')) {
    function returnValueMap(array $valueMap): ReturnValueMapStub
    {
        return new ReturnValueMapStub($valueMap);
    }
}

if (!function_exists('PHPUnit\Framework\returnArgument')) {
    function returnArgument(int $argumentIndex): ReturnArgumentStub
    {
        return new ReturnArgumentStub($argumentIndex);
    }
}

if (!function_exists('PHPUnit\Framework\returnCallback')) {
    function returnCallback($callback): ReturnCallbackStub
    {
        return new ReturnCallbackStub($callback);
    }
}

if (!function_exists('PHPUnit\Framework\returnSelf')) {
    /**
     * Returns the current object.
     *
     * This method is useful when mocking a fluent interface.
     */
    function returnSelf(): ReturnSelfStub
    {
        return new ReturnSelfStub;
    }
}

if (!function_exists('PHPUnit\Framework\throwException')) {
    function throwException(Throwable $exception): ExceptionStub
    {
        return new ExceptionStub($exception);
    }
}

if (!function_exists('PHPUnit\Framework\onConsecutiveCalls')) {
    function onConsecutiveCalls(): ConsecutiveCallsStub
    {
        $args = func_get_args();

        return new ConsecutiveCallsStub($args);
    }
>>>>>>> update
}
