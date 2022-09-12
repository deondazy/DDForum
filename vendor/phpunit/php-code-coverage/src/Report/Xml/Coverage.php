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

use SebastianBergmann\CodeCoverage\RuntimeException;

class Coverage
{
    /**
     * @var \XMLWriter
=======
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use DOMElement;
use SebastianBergmann\CodeCoverage\ReportAlreadyFinalizedException;
use XMLWriter;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Coverage
{
    /**
     * @var XMLWriter
>>>>>>> update
     */
    private $writer;

    /**
<<<<<<< HEAD
     * @var \DOMElement
=======
     * @var DOMElement
>>>>>>> update
     */
    private $contextNode;

    /**
     * @var bool
     */
    private $finalized = false;

<<<<<<< HEAD
    public function __construct(\DOMElement $context, $line)
    {
        $this->contextNode = $context;

        $this->writer = new \XMLWriter;
        $this->writer->openMemory();
        $this->writer->startElementNs(null, $context->nodeName, 'http://schema.phpunit.de/coverage/1.0');
        $this->writer->writeAttribute('nr', $line);
    }

    public function addTest($test)
    {
        if ($this->finalized) {
            throw new RuntimeException('Coverage Report already finalized');
=======
    public function __construct(DOMElement $context, string $line)
    {
        $this->contextNode = $context;

        $this->writer = new XMLWriter();
        $this->writer->openMemory();
        $this->writer->startElementNS(null, $context->nodeName, 'https://schema.phpunit.de/coverage/1.0');
        $this->writer->writeAttribute('nr', $line);
    }

    /**
     * @throws ReportAlreadyFinalizedException
     */
    public function addTest(string $test): void
    {
        if ($this->finalized) {
            throw new ReportAlreadyFinalizedException;
>>>>>>> update
        }

        $this->writer->startElement('covered');
        $this->writer->writeAttribute('by', $test);
        $this->writer->endElement();
    }

<<<<<<< HEAD
    public function finalize()
=======
    public function finalize(): void
>>>>>>> update
    {
        $this->writer->endElement();

        $fragment = $this->contextNode->ownerDocument->createDocumentFragment();
        $fragment->appendXML($this->writer->outputMemory());

        $this->contextNode->parentNode->replaceChild(
            $fragment,
            $this->contextNode
        );

        $this->finalized = true;
    }
}
