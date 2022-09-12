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

class Node
{
    /**
     * @var \DOMDocument
=======
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use DOMDocument;
use DOMElement;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
abstract class Node
{
    /**
     * @var DOMDocument
>>>>>>> update
     */
    private $dom;

    /**
<<<<<<< HEAD
     * @var \DOMElement
     */
    private $contextNode;

    public function __construct(\DOMElement $context)
=======
     * @var DOMElement
     */
    private $contextNode;

    public function __construct(DOMElement $context)
>>>>>>> update
    {
        $this->setContextNode($context);
    }

<<<<<<< HEAD
    protected function setContextNode(\DOMElement $context)
    {
        $this->dom         = $context->ownerDocument;
        $this->contextNode = $context;
    }

    public function getDom()
=======
    public function dom(): DOMDocument
>>>>>>> update
    {
        return $this->dom;
    }

<<<<<<< HEAD
    protected function getContextNode()
    {
        return $this->contextNode;
    }

    public function getTotals()
    {
        $totalsContainer = $this->getContextNode()->firstChild;

        if (!$totalsContainer) {
            $totalsContainer = $this->getContextNode()->appendChild(
                $this->dom->createElementNS(
                    'http://schema.phpunit.de/coverage/1.0',
=======
    public function totals(): Totals
    {
        $totalsContainer = $this->contextNode()->firstChild;

        if (!$totalsContainer) {
            $totalsContainer = $this->contextNode()->appendChild(
                $this->dom->createElementNS(
                    'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
                    'totals'
                )
            );
        }

        return new Totals($totalsContainer);
    }

<<<<<<< HEAD
    public function addDirectory($name)
    {
        $dirNode = $this->getDom()->createElementNS(
            'http://schema.phpunit.de/coverage/1.0',
=======
    public function addDirectory(string $name): Directory
    {
        $dirNode = $this->dom()->createElementNS(
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
            'directory'
        );

        $dirNode->setAttribute('name', $name);
<<<<<<< HEAD
        $this->getContextNode()->appendChild($dirNode);
=======
        $this->contextNode()->appendChild($dirNode);
>>>>>>> update

        return new Directory($dirNode);
    }

<<<<<<< HEAD
    public function addFile($name, $href)
    {
        $fileNode = $this->getDom()->createElementNS(
            'http://schema.phpunit.de/coverage/1.0',
=======
    public function addFile(string $name, string $href): File
    {
        $fileNode = $this->dom()->createElementNS(
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
            'file'
        );

        $fileNode->setAttribute('name', $name);
        $fileNode->setAttribute('href', $href);
<<<<<<< HEAD
        $this->getContextNode()->appendChild($fileNode);

        return new File($fileNode);
    }
=======
        $this->contextNode()->appendChild($fileNode);

        return new File($fileNode);
    }

    protected function setContextNode(DOMElement $context): void
    {
        $this->dom         = $context->ownerDocument;
        $this->contextNode = $context;
    }

    protected function contextNode(): DOMElement
    {
        return $this->contextNode;
    }
>>>>>>> update
}
