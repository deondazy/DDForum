<<<<<<< HEAD
<?php
/*
 * This file is part of the php-code-coverage package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

namespace SebastianBergmann\CodeCoverage\Report\Xml;

class Report extends File
{
    public function __construct($name)
    {
        $this->dom = new \DOMDocument;
        $this->dom->loadXML('<?xml version="1.0" ?><phpunit xmlns="http://schema.phpunit.de/coverage/1.0"><file /></phpunit>');

        $this->contextNode = $this->dom->getElementsByTagNameNS(
            'http://schema.phpunit.de/coverage/1.0',
            'file'
        )->item(0);

        $this->setName($name);
    }

    private function setName($name)
    {
        $this->contextNode->setAttribute('name', $name);
    }

    public function asDom()
    {
        return $this->dom;
    }

    public function getFunctionObject($name)
    {
        $node = $this->contextNode->appendChild(
            $this->dom->createElementNS(
                'http://schema.phpunit.de/coverage/1.0',
=======
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use function basename;
use function dirname;
use DOMDocument;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Report extends File
{
    public function __construct(string $name)
    {
        $dom = new DOMDocument();
        $dom->loadXML('<?xml version="1.0" ?><phpunit xmlns="https://schema.phpunit.de/coverage/1.0"><file /></phpunit>');

        $contextNode = $dom->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
            'file'
        )->item(0);

        parent::__construct($contextNode);

        $this->setName($name);
    }

    public function asDom(): DOMDocument
    {
        return $this->dom();
    }

    public function functionObject($name): Method
    {
        $node = $this->contextNode()->appendChild(
            $this->dom()->createElementNS(
                'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
                'function'
            )
        );

        return new Method($node, $name);
    }

<<<<<<< HEAD
    public function getClassObject($name)
    {
        return $this->getUnitObject('class', $name);
    }

    public function getTraitObject($name)
    {
        return $this->getUnitObject('trait', $name);
    }

    private function getUnitObject($tagName, $name)
    {
        $node = $this->contextNode->appendChild(
            $this->dom->createElementNS(
                'http://schema.phpunit.de/coverage/1.0',
=======
    public function classObject($name): Unit
    {
        return $this->unitObject('class', $name);
    }

    public function traitObject($name): Unit
    {
        return $this->unitObject('trait', $name);
    }

    public function source(): Source
    {
        $source = $this->contextNode()->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
            'source'
        )->item(0);

        if (!$source) {
            $source = $this->contextNode()->appendChild(
                $this->dom()->createElementNS(
                    'https://schema.phpunit.de/coverage/1.0',
                    'source'
                )
            );
        }

        return new Source($source);
    }

    private function setName(string $name): void
    {
        $this->contextNode()->setAttribute('name', basename($name));
        $this->contextNode()->setAttribute('path', dirname($name));
    }

    private function unitObject(string $tagName, $name): Unit
    {
        $node = $this->contextNode()->appendChild(
            $this->dom()->createElementNS(
                'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
                $tagName
            )
        );

        return new Unit($node, $name);
    }
}
