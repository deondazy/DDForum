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

use SebastianBergmann\CodeCoverage\Util;

/**
 * Base class for nodes in the code coverage information tree.
 */
abstract class AbstractNode implements \Countable
=======
namespace SebastianBergmann\CodeCoverage\Node;

use const DIRECTORY_SEPARATOR;
use function array_merge;
use function str_replace;
use function substr;
use Countable;
use SebastianBergmann\CodeCoverage\Util\Percentage;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
abstract class AbstractNode implements Countable
>>>>>>> update
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
<<<<<<< HEAD
    private $path;
=======
    private $pathAsString;
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    private $pathArray;
=======
    private $pathAsArray;
>>>>>>> update

    /**
     * @var AbstractNode
     */
    private $parent;

    /**
     * @var string
     */
    private $id;

<<<<<<< HEAD
    /**
     * Constructor.
     *
     * @param string       $name
     * @param AbstractNode $parent
     */
    public function __construct($name, AbstractNode $parent = null)
    {
        if (substr($name, -1) == '/') {
=======
    public function __construct(string $name, self $parent = null)
    {
        if (substr($name, -1) === DIRECTORY_SEPARATOR) {
>>>>>>> update
            $name = substr($name, 0, -1);
        }

        $this->name   = $name;
        $this->parent = $parent;
    }

<<<<<<< HEAD
    /**
     * @return string
     */
    public function getName()
=======
    public function name(): string
>>>>>>> update
    {
        return $this->name;
    }

<<<<<<< HEAD
    /**
     * @return string
     */
    public function getId()
    {
        if ($this->id === null) {
            $parent = $this->getParent();
=======
    public function id(): string
    {
        if ($this->id === null) {
            $parent = $this->parent();
>>>>>>> update

            if ($parent === null) {
                $this->id = 'index';
            } else {
<<<<<<< HEAD
                $parentId = $parent->getId();

                if ($parentId == 'index') {
=======
                $parentId = $parent->id();

                if ($parentId === 'index') {
>>>>>>> update
                    $this->id = str_replace(':', '_', $this->name);
                } else {
                    $this->id = $parentId . '/' . $this->name;
                }
            }
        }

        return $this->id;
    }

<<<<<<< HEAD
    /**
     * @return string
     */
    public function getPath()
    {
        if ($this->path === null) {
            if ($this->parent === null || $this->parent->getPath() === null || $this->parent->getPath() === false) {
                $this->path = $this->name;
            } else {
                $this->path = $this->parent->getPath() . '/' . $this->name;
            }
        }

        return $this->path;
    }

    /**
     * @return array
     */
    public function getPathAsArray()
    {
        if ($this->pathArray === null) {
            if ($this->parent === null) {
                $this->pathArray = [];
            } else {
                $this->pathArray = $this->parent->getPathAsArray();
            }

            $this->pathArray[] = $this;
        }

        return $this->pathArray;
    }

    /**
     * @return AbstractNode
     */
    public function getParent()
=======
    public function pathAsString(): string
    {
        if ($this->pathAsString === null) {
            if ($this->parent === null) {
                $this->pathAsString = $this->name;
            } else {
                $this->pathAsString = $this->parent->pathAsString() . DIRECTORY_SEPARATOR . $this->name;
            }
        }

        return $this->pathAsString;
    }

    public function pathAsArray(): array
    {
        if ($this->pathAsArray === null) {
            if ($this->parent === null) {
                $this->pathAsArray = [];
            } else {
                $this->pathAsArray = $this->parent->pathAsArray();
            }

            $this->pathAsArray[] = $this;
        }

        return $this->pathAsArray;
    }

    public function parent(): ?self
>>>>>>> update
    {
        return $this->parent;
    }

<<<<<<< HEAD
    /**
     * Returns the percentage of classes that has been tested.
     *
     * @param bool $asString
     *
     * @return int
     */
    public function getTestedClassesPercent($asString = true)
    {
        return Util::percent(
            $this->getNumTestedClasses(),
            $this->getNumClasses(),
            $asString
        );
    }

    /**
     * Returns the percentage of traits that has been tested.
     *
     * @param bool $asString
     *
     * @return int
     */
    public function getTestedTraitsPercent($asString = true)
    {
        return Util::percent(
            $this->getNumTestedTraits(),
            $this->getNumTraits(),
            $asString
        );
    }

    /**
     * Returns the percentage of traits that has been tested.
     *
     * @param bool $asString
     *
     * @return int
     */
    public function getTestedClassesAndTraitsPercent($asString = true)
    {
        return Util::percent(
            $this->getNumTestedClassesAndTraits(),
            $this->getNumClassesAndTraits(),
            $asString
        );
    }

    /**
     * Returns the percentage of methods that has been tested.
     *
     * @param bool $asString
     *
     * @return int
     */
    public function getTestedMethodsPercent($asString = true)
    {
        return Util::percent(
            $this->getNumTestedMethods(),
            $this->getNumMethods(),
            $asString
        );
    }

    /**
     * Returns the percentage of executed lines.
     *
     * @param bool $asString
     *
     * @return int
     */
    public function getLineExecutedPercent($asString = true)
    {
        return Util::percent(
            $this->getNumExecutedLines(),
            $this->getNumExecutableLines(),
            $asString
        );
    }

    /**
     * Returns the number of classes and traits.
     *
     * @return int
     */
    public function getNumClassesAndTraits()
    {
        return $this->getNumClasses() + $this->getNumTraits();
    }

    /**
     * Returns the number of tested classes and traits.
     *
     * @return int
     */
    public function getNumTestedClassesAndTraits()
    {
        return $this->getNumTestedClasses() + $this->getNumTestedTraits();
    }

    /**
     * Returns the classes and traits of this node.
     *
     * @return array
     */
    public function getClassesAndTraits()
    {
        return array_merge($this->getClasses(), $this->getTraits());
    }

    /**
     * Returns the classes of this node.
     *
     * @return array
     */
    abstract public function getClasses();

    /**
     * Returns the traits of this node.
     *
     * @return array
     */
    abstract public function getTraits();

    /**
     * Returns the functions of this node.
     *
     * @return array
     */
    abstract public function getFunctions();

    /**
     * Returns the LOC/CLOC/NCLOC of this node.
     *
     * @return array
     */
    abstract public function getLinesOfCode();

    /**
     * Returns the number of executable lines.
     *
     * @return int
     */
    abstract public function getNumExecutableLines();

    /**
     * Returns the number of executed lines.
     *
     * @return int
     */
    abstract public function getNumExecutedLines();

    /**
     * Returns the number of classes.
     *
     * @return int
     */
    abstract public function getNumClasses();

    /**
     * Returns the number of tested classes.
     *
     * @return int
     */
    abstract public function getNumTestedClasses();

    /**
     * Returns the number of traits.
     *
     * @return int
     */
    abstract public function getNumTraits();

    /**
     * Returns the number of tested traits.
     *
     * @return int
     */
    abstract public function getNumTestedTraits();

    /**
     * Returns the number of methods.
     *
     * @return int
     */
    abstract public function getNumMethods();

    /**
     * Returns the number of tested methods.
     *
     * @return int
     */
    abstract public function getNumTestedMethods();

    /**
     * Returns the number of functions.
     *
     * @return int
     */
    abstract public function getNumFunctions();

    /**
     * Returns the number of tested functions.
     *
     * @return int
     */
    abstract public function getNumTestedFunctions();
=======
    public function percentageOfTestedClasses(): Percentage
    {
        return Percentage::fromFractionAndTotal(
            $this->numberOfTestedClasses(),
            $this->numberOfClasses(),
        );
    }

    public function percentageOfTestedTraits(): Percentage
    {
        return Percentage::fromFractionAndTotal(
            $this->numberOfTestedTraits(),
            $this->numberOfTraits(),
        );
    }

    public function percentageOfTestedClassesAndTraits(): Percentage
    {
        return Percentage::fromFractionAndTotal(
            $this->numberOfTestedClassesAndTraits(),
            $this->numberOfClassesAndTraits(),
        );
    }

    public function percentageOfTestedFunctions(): Percentage
    {
        return Percentage::fromFractionAndTotal(
            $this->numberOfTestedFunctions(),
            $this->numberOfFunctions(),
        );
    }

    public function percentageOfTestedMethods(): Percentage
    {
        return Percentage::fromFractionAndTotal(
            $this->numberOfTestedMethods(),
            $this->numberOfMethods(),
        );
    }

    public function percentageOfTestedFunctionsAndMethods(): Percentage
    {
        return Percentage::fromFractionAndTotal(
            $this->numberOfTestedFunctionsAndMethods(),
            $this->numberOfFunctionsAndMethods(),
        );
    }

    public function percentageOfExecutedLines(): Percentage
    {
        return Percentage::fromFractionAndTotal(
            $this->numberOfExecutedLines(),
            $this->numberOfExecutableLines(),
        );
    }

    public function percentageOfExecutedBranches(): Percentage
    {
        return Percentage::fromFractionAndTotal(
            $this->numberOfExecutedBranches(),
            $this->numberOfExecutableBranches()
        );
    }

    public function percentageOfExecutedPaths(): Percentage
    {
        return Percentage::fromFractionAndTotal(
            $this->numberOfExecutedPaths(),
            $this->numberOfExecutablePaths()
        );
    }

    public function numberOfClassesAndTraits(): int
    {
        return $this->numberOfClasses() + $this->numberOfTraits();
    }

    public function numberOfTestedClassesAndTraits(): int
    {
        return $this->numberOfTestedClasses() + $this->numberOfTestedTraits();
    }

    public function classesAndTraits(): array
    {
        return array_merge($this->classes(), $this->traits());
    }

    public function numberOfFunctionsAndMethods(): int
    {
        return $this->numberOfFunctions() + $this->numberOfMethods();
    }

    public function numberOfTestedFunctionsAndMethods(): int
    {
        return $this->numberOfTestedFunctions() + $this->numberOfTestedMethods();
    }

    abstract public function classes(): array;

    abstract public function traits(): array;

    abstract public function functions(): array;

    /**
     * @psalm-return array{linesOfCode: int, commentLinesOfCode: int, nonCommentLinesOfCode: int}
     */
    abstract public function linesOfCode(): array;

    abstract public function numberOfExecutableLines(): int;

    abstract public function numberOfExecutedLines(): int;

    abstract public function numberOfExecutableBranches(): int;

    abstract public function numberOfExecutedBranches(): int;

    abstract public function numberOfExecutablePaths(): int;

    abstract public function numberOfExecutedPaths(): int;

    abstract public function numberOfClasses(): int;

    abstract public function numberOfTestedClasses(): int;

    abstract public function numberOfTraits(): int;

    abstract public function numberOfTestedTraits(): int;

    abstract public function numberOfMethods(): int;

    abstract public function numberOfTestedMethods(): int;

    abstract public function numberOfFunctions(): int;

    abstract public function numberOfTestedFunctions(): int;
>>>>>>> update
}
