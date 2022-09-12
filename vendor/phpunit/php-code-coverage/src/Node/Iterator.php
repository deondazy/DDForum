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

namespace SebastianBergmann\CodeCoverage\Node;

/**
 * Recursive iterator for node object graphs.
 */
class Iterator implements \RecursiveIterator
=======
namespace SebastianBergmann\CodeCoverage\Node;

use function count;
use RecursiveIterator;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Iterator implements RecursiveIterator
>>>>>>> update
{
    /**
     * @var int
     */
    private $position;

    /**
     * @var AbstractNode[]
     */
    private $nodes;

<<<<<<< HEAD
    /**
     * @param Directory $node
     */
    public function __construct(Directory $node)
    {
        $this->nodes = $node->getChildNodes();
=======
    public function __construct(Directory $node)
    {
        $this->nodes = $node->children();
>>>>>>> update
    }

    /**
     * Rewinds the Iterator to the first element.
     */
<<<<<<< HEAD
    public function rewind()
=======
    public function rewind(): void
>>>>>>> update
    {
        $this->position = 0;
    }

    /**
     * Checks if there is a current element after calls to rewind() or next().
<<<<<<< HEAD
     *
     * @return bool
     */
    public function valid()
=======
     */
    public function valid(): bool
>>>>>>> update
    {
        return $this->position < count($this->nodes);
    }

    /**
     * Returns the key of the current element.
<<<<<<< HEAD
     *
     * @return int
     */
    public function key()
=======
     */
    public function key(): int
>>>>>>> update
    {
        return $this->position;
    }

    /**
     * Returns the current element.
<<<<<<< HEAD
     *
     * @return \PHPUnit_Framework_Test
     */
    public function current()
=======
     */
    public function current(): ?AbstractNode
>>>>>>> update
    {
        return $this->valid() ? $this->nodes[$this->position] : null;
    }

    /**
     * Moves forward to next element.
     */
<<<<<<< HEAD
    public function next()
=======
    public function next(): void
>>>>>>> update
    {
        $this->position++;
    }

    /**
     * Returns the sub iterator for the current element.
     *
     * @return Iterator
     */
<<<<<<< HEAD
    public function getChildren()
    {
        return new self(
            $this->nodes[$this->position]
        );
=======
    public function getChildren(): self
    {
        return new self($this->nodes[$this->position]);
>>>>>>> update
    }

    /**
     * Checks whether the current element has children.
<<<<<<< HEAD
     *
     * @return bool
     */
    public function hasChildren()
=======
     */
    public function hasChildren(): bool
>>>>>>> update
    {
        return $this->nodes[$this->position] instanceof Directory;
    }
}
