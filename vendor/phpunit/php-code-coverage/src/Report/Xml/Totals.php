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

use SebastianBergmann\CodeCoverage\Util;

class Totals
{
    /**
     * @var \DOMNode
=======
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use function sprintf;
use DOMElement;
use DOMNode;
use SebastianBergmann\CodeCoverage\Util\Percentage;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Totals
{
    /**
     * @var DOMNode
>>>>>>> update
     */
    private $container;

    /**
<<<<<<< HEAD
     * @var \DOMElement
=======
     * @var DOMElement
>>>>>>> update
     */
    private $linesNode;

    /**
<<<<<<< HEAD
     * @var \DOMElement
=======
     * @var DOMElement
>>>>>>> update
     */
    private $methodsNode;

    /**
<<<<<<< HEAD
     * @var \DOMElement
=======
     * @var DOMElement
>>>>>>> update
     */
    private $functionsNode;

    /**
<<<<<<< HEAD
     * @var \DOMElement
=======
     * @var DOMElement
>>>>>>> update
     */
    private $classesNode;

    /**
<<<<<<< HEAD
     * @var \DOMElement
     */
    private $traitsNode;

    public function __construct(\DOMElement $container)
=======
     * @var DOMElement
     */
    private $traitsNode;

    public function __construct(DOMElement $container)
>>>>>>> update
    {
        $this->container = $container;
        $dom             = $container->ownerDocument;

        $this->linesNode = $dom->createElementNS(
<<<<<<< HEAD
            'http://schema.phpunit.de/coverage/1.0',
=======
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
            'lines'
        );

        $this->methodsNode = $dom->createElementNS(
<<<<<<< HEAD
            'http://schema.phpunit.de/coverage/1.0',
=======
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
            'methods'
        );

        $this->functionsNode = $dom->createElementNS(
<<<<<<< HEAD
            'http://schema.phpunit.de/coverage/1.0',
=======
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
            'functions'
        );

        $this->classesNode = $dom->createElementNS(
<<<<<<< HEAD
            'http://schema.phpunit.de/coverage/1.0',
=======
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
            'classes'
        );

        $this->traitsNode = $dom->createElementNS(
<<<<<<< HEAD
            'http://schema.phpunit.de/coverage/1.0',
=======
            'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
            'traits'
        );

        $container->appendChild($this->linesNode);
        $container->appendChild($this->methodsNode);
        $container->appendChild($this->functionsNode);
        $container->appendChild($this->classesNode);
        $container->appendChild($this->traitsNode);
    }

<<<<<<< HEAD
    public function getContainer()
=======
    public function container(): DOMNode
>>>>>>> update
    {
        return $this->container;
    }

<<<<<<< HEAD
    public function setNumLines($loc, $cloc, $ncloc, $executable, $executed)
    {
        $this->linesNode->setAttribute('total', $loc);
        $this->linesNode->setAttribute('comments', $cloc);
        $this->linesNode->setAttribute('code', $ncloc);
        $this->linesNode->setAttribute('executable', $executable);
        $this->linesNode->setAttribute('executed', $executed);
        $this->linesNode->setAttribute(
            'percent',
            Util::percent($executed, $executable, true)
        );
    }

    public function setNumClasses($count, $tested)
    {
        $this->classesNode->setAttribute('count', $count);
        $this->classesNode->setAttribute('tested', $tested);
        $this->classesNode->setAttribute(
            'percent',
            Util::percent($tested, $count, true)
        );
    }

    public function setNumTraits($count, $tested)
    {
        $this->traitsNode->setAttribute('count', $count);
        $this->traitsNode->setAttribute('tested', $tested);
        $this->traitsNode->setAttribute(
            'percent',
            Util::percent($tested, $count, true)
        );
    }

    public function setNumMethods($count, $tested)
    {
        $this->methodsNode->setAttribute('count', $count);
        $this->methodsNode->setAttribute('tested', $tested);
        $this->methodsNode->setAttribute(
            'percent',
            Util::percent($tested, $count, true)
        );
    }

    public function setNumFunctions($count, $tested)
    {
        $this->functionsNode->setAttribute('count', $count);
        $this->functionsNode->setAttribute('tested', $tested);
        $this->functionsNode->setAttribute(
            'percent',
            Util::percent($tested, $count, true)
=======
    public function setNumLines(int $loc, int $cloc, int $ncloc, int $executable, int $executed): void
    {
        $this->linesNode->setAttribute('total', (string) $loc);
        $this->linesNode->setAttribute('comments', (string) $cloc);
        $this->linesNode->setAttribute('code', (string) $ncloc);
        $this->linesNode->setAttribute('executable', (string) $executable);
        $this->linesNode->setAttribute('executed', (string) $executed);
        $this->linesNode->setAttribute(
            'percent',
            $executable === 0 ? '0' : sprintf('%01.2F', Percentage::fromFractionAndTotal($executed, $executable)->asFloat())
        );
    }

    public function setNumClasses(int $count, int $tested): void
    {
        $this->classesNode->setAttribute('count', (string) $count);
        $this->classesNode->setAttribute('tested', (string) $tested);
        $this->classesNode->setAttribute(
            'percent',
            $count === 0 ? '0' : sprintf('%01.2F', Percentage::fromFractionAndTotal($tested, $count)->asFloat())
        );
    }

    public function setNumTraits(int $count, int $tested): void
    {
        $this->traitsNode->setAttribute('count', (string) $count);
        $this->traitsNode->setAttribute('tested', (string) $tested);
        $this->traitsNode->setAttribute(
            'percent',
            $count === 0 ? '0' : sprintf('%01.2F', Percentage::fromFractionAndTotal($tested, $count)->asFloat())
        );
    }

    public function setNumMethods(int $count, int $tested): void
    {
        $this->methodsNode->setAttribute('count', (string) $count);
        $this->methodsNode->setAttribute('tested', (string) $tested);
        $this->methodsNode->setAttribute(
            'percent',
            $count === 0 ? '0' : sprintf('%01.2F', Percentage::fromFractionAndTotal($tested, $count)->asFloat())
        );
    }

    public function setNumFunctions(int $count, int $tested): void
    {
        $this->functionsNode->setAttribute('count', (string) $count);
        $this->functionsNode->setAttribute('tested', (string) $tested);
        $this->functionsNode->setAttribute(
            'percent',
            $count === 0 ? '0' : sprintf('%01.2F', Percentage::fromFractionAndTotal($tested, $count)->asFloat())
>>>>>>> update
        );
    }
}
