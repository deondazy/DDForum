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

class Unit
{
    /**
     * @var \DOMElement
     */
    private $contextNode;

    public function __construct(\DOMElement $context, $name)
=======
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use DOMElement;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Unit
{
    /**
     * @var DOMElement
     */
    private $contextNode;

    public function __construct(DOMElement $context, string $name)
>>>>>>> update
    {
        $this->contextNode = $context;

        $this->setName($name);
    }

<<<<<<< HEAD
    private function setName($name)
    {
        $this->contextNode->setAttribute('name', $name);
    }

    public function setLines($start, $executable, $executed)
    {
        $this->contextNode->setAttribute('start', $start);
        $this->contextNode->setAttribute('executable', $executable);
        $this->contextNode->setAttribute('executed', $executed);
    }

    public function setCrap($crap)
    {
        $this->contextNode->setAttribute('crap', $crap);
    }

    public function setPackage($full, $package, $sub, $category)
    {
        $node = $this->contextNode->getElementsByTagNameNS(
            'http://schema.phpunit.de/coverage/1.0',
            'package'
        )->item(0);

        if (!$node) {
            $node = $this->contextNode->appendChild(
                $this->contextNode->ownerDocument->createElementNS(
                    'http://schema.phpunit.de/coverage/1.0',
                    'package'
                )
            );
        }

        $node->setAttribute('full', $full);
        $node->setAttribute('name', $package);
        $node->setAttribute('sub', $sub);
        $node->setAttribute('category', $category);
    }

    public function setNamespace($namespace)
    {
        $node = $this->contextNode->getElementsByTagNameNS(
            'http://schema.phpunit.de/coverage/1.0',
=======
    public function setLines(int $start, int $executable, int $executed): void
    {
        $this->contextNode->setAttribute('start', (string) $start);
        $this->contextNode->setAttribute('executable', (string) $executable);
        $this->contextNode->setAttribute('executed', (string) $executed);
    }

    public function setCrap(float $crap): void
    {
        $this->contextNode->setAttribute('crap', (string) $crap);
    }

    public function setNamespace(string $namespace): void
    {
        $node = $this->contextNode->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
            'namespace'
        )->item(0);

        if (!$node) {
            $node = $this->contextNode->appendChild(
                $this->contextNode->ownerDocument->createElementNS(
<<<<<<< HEAD
                    'http://schema.phpunit.de/coverage/1.0',
=======
                    'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
                    'namespace'
                )
            );
        }

        $node->setAttribute('name', $namespace);
    }

<<<<<<< HEAD
    public function addMethod($name)
    {
        $node = $this->contextNode->appendChild(
            $this->contextNode->ownerDocument->createElementNS(
                'http://schema.phpunit.de/coverage/1.0',
=======
    public function addMethod(string $name): Method
    {
        $node = $this->contextNode->appendChild(
            $this->contextNode->ownerDocument->createElementNS(
                'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
                'method'
            )
        );

        return new Method($node, $name);
    }
<<<<<<< HEAD
=======

    private function setName(string $name): void
    {
        $this->contextNode->setAttribute('name', $name);
    }
>>>>>>> update
}
