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
 * XML helpers.
 *
 * @since Class available since Release 3.2.0
 */
class PHPUnit_Util_XML
{
    /**
     * Load an $actual document into a DOMDocument.  This is called
     * from the selector assertions.
     *
     * If $actual is already a DOMDocument, it is returned with
     * no changes.  Otherwise, $actual is loaded into a new DOMDocument
     * as either HTML or XML, depending on the value of $isHtml. If $isHtml is
     * false and $xinclude is true, xinclude is performed on the loaded
     * DOMDocument.
     *
     * Note: prior to PHPUnit 3.3.0, this method loaded a file and
     * not a string as it currently does.  To load a file into a
     * DOMDocument, use loadFile() instead.
     *
     * @param string|DOMDocument $actual
     * @param bool               $isHtml
     * @param string             $filename
     * @param bool               $xinclude
     * @param bool               $strict
     *
     * @return DOMDocument
     *
     * @since Method available since Release 3.3.0
     */
    public static function load($actual, $isHtml = false, $filename = '', $xinclude = false, $strict = false)
    {
        if ($actual instanceof DOMDocument) {
            return $actual;
        }

        if (!is_string($actual)) {
            throw new PHPUnit_Framework_Exception('Could not load XML from ' . gettype($actual));
        }

        if ($actual === '') {
            throw new PHPUnit_Framework_Exception('Could not load XML from empty string');
        }

        // Required for XInclude on Windows.
        if ($xinclude) {
            $cwd = getcwd();
            @chdir(dirname($filename));
        }

        $document                     = new DOMDocument;
        $document->preserveWhiteSpace = false;

        $internal  = libxml_use_internal_errors(true);
        $message   = '';
        $reporting = error_reporting(0);

        if ('' !== $filename) {
            // Necessary for xinclude
            $document->documentURI = $filename;
        }

        if ($isHtml) {
            $loaded = $document->loadHTML($actual);
        } else {
            $loaded = $document->loadXML($actual);
        }

        if (!$isHtml && $xinclude) {
            $document->xinclude();
        }

        foreach (libxml_get_errors() as $error) {
            $message .= "\n" . $error->message;
        }

        libxml_use_internal_errors($internal);
        error_reporting($reporting);

        if ($xinclude) {
            @chdir($cwd);
        }

        if ($loaded === false || ($strict && $message !== '')) {
            if ($filename !== '') {
                throw new PHPUnit_Framework_Exception(
                    sprintf(
                        'Could not load "%s".%s',
                        $filename,
                        $message != '' ? "\n" . $message : ''
                    )
                );
            } else {
                if ($message === '') {
                    $message = 'Could not load XML for unknown reason';
                }
                throw new PHPUnit_Framework_Exception($message);
            }
        }

        return $document;
    }

    /**
     * Loads an XML (or HTML) file into a DOMDocument object.
     *
     * @param string $filename
     * @param bool   $isHtml
     * @param bool   $xinclude
     * @param bool   $strict
     *
     * @return DOMDocument
     *
     * @since Method available since Release 3.3.0
     */
    public static function loadFile($filename, $isHtml = false, $xinclude = false, $strict = false)
    {
        $reporting = error_reporting(0);
        $contents  = file_get_contents($filename);
        error_reporting($reporting);

        if ($contents === false) {
            throw new PHPUnit_Framework_Exception(
                sprintf(
                    'Could not read "%s".',
                    $filename
                )
            );
        }

        return self::load($contents, $isHtml, $filename, $xinclude, $strict);
    }

    /**
     * @param DOMNode $node
     *
     * @since Method available since Release 3.3.0
     */
    public static function removeCharacterDataNodes(DOMNode $node)
=======
namespace PHPUnit\Util;

use const ENT_QUOTES;
use function assert;
use function class_exists;
use function htmlspecialchars;
use function mb_convert_encoding;
use function ord;
use function preg_replace;
use function settype;
use function strlen;
use DOMCharacterData;
use DOMDocument;
use DOMElement;
use DOMNode;
use DOMText;
use ReflectionClass;
use ReflectionException;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class Xml
{
    /**
     * @deprecated Only used by assertEqualXMLStructure()
     */
    public static function import(DOMElement $element): DOMElement
    {
        return (new DOMDocument)->importNode($element, true);
    }

    /**
     * @deprecated Only used by assertEqualXMLStructure()
     */
    public static function removeCharacterDataNodes(DOMNode $node): void
>>>>>>> update
    {
        if ($node->hasChildNodes()) {
            for ($i = $node->childNodes->length - 1; $i >= 0; $i--) {
                if (($child = $node->childNodes->item($i)) instanceof DOMCharacterData) {
                    $node->removeChild($child);
                }
            }
        }
    }

    /**
<<<<<<< HEAD
     * Escapes a string for the use in XML documents
     * Any Unicode character is allowed, excluding the surrogate blocks, FFFE,
     * and FFFF (not even as character reference).
     * See http://www.w3.org/TR/xml/#charsets
     *
     * @param string $string
     *
     * @return string
     *
     * @since Method available since Release 3.4.6
     */
    public static function prepareString($string)
=======
     * Escapes a string for the use in XML documents.
     *
     * Any Unicode character is allowed, excluding the surrogate blocks, FFFE,
     * and FFFF (not even as character reference).
     *
     * @see https://www.w3.org/TR/xml/#charsets
     */
    public static function prepareString(string $string): string
>>>>>>> update
    {
        return preg_replace(
            '/[\\x00-\\x08\\x0b\\x0c\\x0e-\\x1f\\x7f]/',
            '',
            htmlspecialchars(
<<<<<<< HEAD
                PHPUnit_Util_String::convertToUtf8($string),
                ENT_QUOTES,
                'UTF-8'
=======
                self::convertToUtf8($string),
                ENT_QUOTES
>>>>>>> update
            )
        );
    }

    /**
     * "Convert" a DOMElement object into a PHP variable.
<<<<<<< HEAD
     *
     * @param DOMElement $element
     *
     * @return mixed
     *
     * @since Method available since Release 3.4.0
=======
>>>>>>> update
     */
    public static function xmlToVariable(DOMElement $element)
    {
        $variable = null;

        switch ($element->tagName) {
            case 'array':
                $variable = [];

<<<<<<< HEAD
                foreach ($element->getElementsByTagName('element') as $element) {
                    $item = $element->childNodes->item(0);

                    if ($item instanceof DOMText) {
                        $item = $element->childNodes->item(1);
=======
                foreach ($element->childNodes as $entry) {
                    if (!$entry instanceof DOMElement || $entry->tagName !== 'element') {
                        continue;
                    }
                    $item = $entry->childNodes->item(0);

                    if ($item instanceof DOMText) {
                        $item = $entry->childNodes->item(1);
>>>>>>> update
                    }

                    $value = self::xmlToVariable($item);

<<<<<<< HEAD
                    if ($element->hasAttribute('key')) {
                        $variable[(string) $element->getAttribute('key')] = $value;
=======
                    if ($entry->hasAttribute('key')) {
                        $variable[(string) $entry->getAttribute('key')] = $value;
>>>>>>> update
                    } else {
                        $variable[] = $value;
                    }
                }
<<<<<<< HEAD
=======

>>>>>>> update
                break;

            case 'object':
                $className = $element->getAttribute('class');

                if ($element->hasChildNodes()) {
<<<<<<< HEAD
                    $arguments       = $element->childNodes->item(1)->childNodes;
=======
                    $arguments       = $element->childNodes->item(0)->childNodes;
>>>>>>> update
                    $constructorArgs = [];

                    foreach ($arguments as $argument) {
                        if ($argument instanceof DOMElement) {
                            $constructorArgs[] = self::xmlToVariable($argument);
                        }
                    }

<<<<<<< HEAD
                    $class    = new ReflectionClass($className);
                    $variable = $class->newInstanceArgs($constructorArgs);
                } else {
                    $variable = new $className;
                }
                break;

            case 'boolean':
                $variable = $element->textContent == 'true' ? true : false;
=======
                    try {
                        assert(class_exists($className));

                        $variable = (new ReflectionClass($className))->newInstanceArgs($constructorArgs);
                        // @codeCoverageIgnoreStart
                    } catch (ReflectionException $e) {
                        throw new Exception(
                            $e->getMessage(),
                            (int) $e->getCode(),
                            $e
                        );
                    }
                    // @codeCoverageIgnoreEnd
                } else {
                    $variable = new $className;
                }

                break;

            case 'boolean':
                $variable = $element->textContent === 'true';

>>>>>>> update
                break;

            case 'integer':
            case 'double':
            case 'string':
                $variable = $element->textContent;

                settype($variable, $element->tagName);
<<<<<<< HEAD
=======

>>>>>>> update
                break;
        }

        return $variable;
    }
<<<<<<< HEAD
=======

    private static function convertToUtf8(string $string): string
    {
        if (!self::isUtf8($string)) {
            $string = mb_convert_encoding($string, 'UTF-8');
        }

        return $string;
    }

    private static function isUtf8(string $string): bool
    {
        $length = strlen($string);

        for ($i = 0; $i < $length; $i++) {
            if (ord($string[$i]) < 0x80) {
                $n = 0;
            } elseif ((ord($string[$i]) & 0xE0) === 0xC0) {
                $n = 1;
            } elseif ((ord($string[$i]) & 0xF0) === 0xE0) {
                $n = 2;
            } elseif ((ord($string[$i]) & 0xF0) === 0xF0) {
                $n = 3;
            } else {
                return false;
            }

            for ($j = 0; $j < $n; $j++) {
                if ((++$i === $length) || ((ord($string[$i]) & 0xC0) !== 0x80)) {
                    return false;
                }
            }
        }

        return true;
    }
>>>>>>> update
}
