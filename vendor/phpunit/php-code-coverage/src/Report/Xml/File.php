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

class File
{
    /**
     * @var \DOMDocument
     */
    protected $dom;

    /**
     * @var \DOMElement
     */
    protected $contextNode;

    public function __construct(\DOMElement $context)
=======
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use DOMDocument;
use DOMElement;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
class File
{
    /**
     * @var DOMDocument
     */
    private $dom;

    /**
     * @var DOMElement
     */
    private $contextNode;

    public function __construct(DOMElement $context)
>>>>>>> update
    {
        $this->dom         = $context->ownerDocument;
        $this->contextNode = $context;
    }

<<<<<<< HEAD
    public function getTotals()
=======
    public function totals(): Totals
>>>>>>> update
    {
        $totalsContainer = $this->contextNode->firstChild;

        if (!$totalsContainer) {
            $totalsContainer = $this->contextNode->appendChild(
                $this->dom->createElementNS(
<<<<<<< HEAD
                    'http://schema.phpunit.de/coverage/1.0',
=======
                    'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
                    'totals'
                )
            );
        }

        return new Totals($totalsContainer);
    }

<<<<<<< HEAD
    public function getLineCoverage($line)
    {
        $coverage = $this->contextNode->getElementsByTagNameNS(
            'http://schema.phpunit.de/coverage/1.0',
=======
    public function lineCoverage(string $line): Coverage
    {
        $coverage = $this->contextNode->getElementsByTagNameNS(
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
            'coverage'
        )->item(0);

        if (!$coverage) {
            $coverage = $this->contextNode->appendChild(
                $this->dom->createElementNS(
<<<<<<< HEAD
                    'http://schema.phpunit.de/coverage/1.0',
=======
                    'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
                    'coverage'
                )
            );
        }

        $lineNode = $coverage->appendChild(
            $this->dom->createElementNS(
<<<<<<< HEAD
                'http://schema.phpunit.de/coverage/1.0',
=======
                'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
                'line'
            )
        );

        return new Coverage($lineNode, $line);
    }
<<<<<<< HEAD
=======

    protected function contextNode(): DOMElement
    {
        return $this->contextNode;
    }

    protected function dom(): DOMDocument
    {
        return $this->dom;
    }
>>>>>>> update
}
