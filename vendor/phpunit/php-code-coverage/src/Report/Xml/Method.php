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

class Method
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
final class Method
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

    public function setSignature($signature)
=======
    public function setSignature(string $signature): void
>>>>>>> update
    {
        $this->contextNode->setAttribute('signature', $signature);
    }

<<<<<<< HEAD
    public function setLines($start, $end = null)
=======
    public function setLines(string $start, ?string $end = null): void
>>>>>>> update
    {
        $this->contextNode->setAttribute('start', $start);

        if ($end !== null) {
            $this->contextNode->setAttribute('end', $end);
        }
    }

<<<<<<< HEAD
    public function setTotals($executable, $executed, $coverage)
=======
    public function setTotals(string $executable, string $executed, string $coverage): void
>>>>>>> update
    {
        $this->contextNode->setAttribute('executable', $executable);
        $this->contextNode->setAttribute('executed', $executed);
        $this->contextNode->setAttribute('coverage', $coverage);
    }

<<<<<<< HEAD
    public function setCrap($crap)
    {
        $this->contextNode->setAttribute('crap', $crap);
    }
=======
    public function setCrap(string $crap): void
    {
        $this->contextNode->setAttribute('crap', $crap);
    }

    private function setName(string $name): void
    {
        $this->contextNode->setAttribute('name', $name);
    }
>>>>>>> update
}
