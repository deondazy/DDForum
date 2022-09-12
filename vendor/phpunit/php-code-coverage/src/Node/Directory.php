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

use SebastianBergmann\CodeCoverage\InvalidArgumentException;

/**
 * Represents a directory in the code coverage information tree.
 */
class Directory extends AbstractNode implements \IteratorAggregate
=======
namespace SebastianBergmann\CodeCoverage\Node;

use function array_merge;
use function count;
use IteratorAggregate;
use RecursiveIteratorIterator;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Directory extends AbstractNode implements IteratorAggregate
>>>>>>> update
{
    /**
     * @var AbstractNode[]
     */
    private $children = [];

    /**
     * @var Directory[]
     */
    private $directories = [];

    /**
     * @var File[]
     */
    private $files = [];

    /**
     * @var array
     */
    private $classes;

    /**
     * @var array
     */
    private $traits;

    /**
     * @var array
     */
    private $functions;

    /**
<<<<<<< HEAD
     * @var array
     */
    private $linesOfCode = null;
=======
     * @psalm-var null|array{linesOfCode: int, commentLinesOfCode: int, nonCommentLinesOfCode: int}
     */
    private $linesOfCode;
>>>>>>> update

    /**
     * @var int
     */
    private $numFiles = -1;

    /**
     * @var int
     */
    private $numExecutableLines = -1;

    /**
     * @var int
     */
    private $numExecutedLines = -1;

    /**
     * @var int
     */
<<<<<<< HEAD
=======
    private $numExecutableBranches = -1;

    /**
     * @var int
     */
    private $numExecutedBranches = -1;

    /**
     * @var int
     */
    private $numExecutablePaths = -1;

    /**
     * @var int
     */
    private $numExecutedPaths = -1;

    /**
     * @var int
     */
>>>>>>> update
    private $numClasses = -1;

    /**
     * @var int
     */
    private $numTestedClasses = -1;

    /**
     * @var int
     */
    private $numTraits = -1;

    /**
     * @var int
     */
    private $numTestedTraits = -1;

    /**
     * @var int
     */
    private $numMethods = -1;

    /**
     * @var int
     */
    private $numTestedMethods = -1;

    /**
     * @var int
     */
    private $numFunctions = -1;

    /**
     * @var int
     */
    private $numTestedFunctions = -1;

<<<<<<< HEAD
    /**
     * Returns the number of files in/under this node.
     *
     * @return int
     */
    public function count()
    {
        if ($this->numFiles == -1) {
=======
    public function count(): int
    {
        if ($this->numFiles === -1) {
>>>>>>> update
            $this->numFiles = 0;

            foreach ($this->children as $child) {
                $this->numFiles += count($child);
            }
        }

        return $this->numFiles;
    }

<<<<<<< HEAD
    /**
     * Returns an iterator for this node.
     *
     * @return \RecursiveIteratorIterator
     */
    public function getIterator()
    {
        return new \RecursiveIteratorIterator(
            new Iterator($this),
            \RecursiveIteratorIterator::SELF_FIRST
        );
    }

    /**
     * Adds a new directory.
     *
     * @param string $name
     *
     * @return Directory
     */
    public function addDirectory($name)
=======
    public function getIterator(): RecursiveIteratorIterator
    {
        return new RecursiveIteratorIterator(
            new Iterator($this),
            RecursiveIteratorIterator::SELF_FIRST
        );
    }

    public function addDirectory(string $name): self
>>>>>>> update
    {
        $directory = new self($name, $this);

        $this->children[]    = $directory;
        $this->directories[] = &$this->children[count($this->children) - 1];

        return $directory;
    }

<<<<<<< HEAD
    /**
     * Adds a new file.
     *
     * @param string $name
     * @param array  $coverageData
     * @param array  $testData
     * @param bool   $cacheTokens
     *
     * @return File
     *
     * @throws InvalidArgumentException
     */
    public function addFile($name, array $coverageData, array $testData, $cacheTokens)
    {
        $file = new File(
            $name,
            $this,
            $coverageData,
            $testData,
            $cacheTokens
        );

=======
    public function addFile(File $file): void
    {
>>>>>>> update
        $this->children[] = $file;
        $this->files[]    = &$this->children[count($this->children) - 1];

        $this->numExecutableLines = -1;
        $this->numExecutedLines   = -1;
<<<<<<< HEAD

        return $file;
    }

    /**
     * Returns the directories in this directory.
     *
     * @return array
     */
    public function getDirectories()
=======
    }

    public function directories(): array
>>>>>>> update
    {
        return $this->directories;
    }

<<<<<<< HEAD
    /**
     * Returns the files in this directory.
     *
     * @return array
     */
    public function getFiles()
=======
    public function files(): array
>>>>>>> update
    {
        return $this->files;
    }

<<<<<<< HEAD
    /**
     * Returns the child nodes of this node.
     *
     * @return array
     */
    public function getChildNodes()
=======
    public function children(): array
>>>>>>> update
    {
        return $this->children;
    }

<<<<<<< HEAD
    /**
     * Returns the classes of this node.
     *
     * @return array
     */
    public function getClasses()
=======
    public function classes(): array
>>>>>>> update
    {
        if ($this->classes === null) {
            $this->classes = [];

            foreach ($this->children as $child) {
                $this->classes = array_merge(
                    $this->classes,
<<<<<<< HEAD
                    $child->getClasses()
=======
                    $child->classes()
>>>>>>> update
                );
            }
        }

        return $this->classes;
    }

<<<<<<< HEAD
    /**
     * Returns the traits of this node.
     *
     * @return array
     */
    public function getTraits()
=======
    public function traits(): array
>>>>>>> update
    {
        if ($this->traits === null) {
            $this->traits = [];

            foreach ($this->children as $child) {
                $this->traits = array_merge(
                    $this->traits,
<<<<<<< HEAD
                    $child->getTraits()
=======
                    $child->traits()
>>>>>>> update
                );
            }
        }

        return $this->traits;
    }

<<<<<<< HEAD
    /**
     * Returns the functions of this node.
     *
     * @return array
     */
    public function getFunctions()
=======
    public function functions(): array
>>>>>>> update
    {
        if ($this->functions === null) {
            $this->functions = [];

            foreach ($this->children as $child) {
                $this->functions = array_merge(
                    $this->functions,
<<<<<<< HEAD
                    $child->getFunctions()
=======
                    $child->functions()
>>>>>>> update
                );
            }
        }

        return $this->functions;
    }

    /**
<<<<<<< HEAD
     * Returns the LOC/CLOC/NCLOC of this node.
     *
     * @return array
     */
    public function getLinesOfCode()
    {
        if ($this->linesOfCode === null) {
            $this->linesOfCode = ['loc' => 0, 'cloc' => 0, 'ncloc' => 0];

            foreach ($this->children as $child) {
                $linesOfCode = $child->getLinesOfCode();

                $this->linesOfCode['loc']   += $linesOfCode['loc'];
                $this->linesOfCode['cloc']  += $linesOfCode['cloc'];
                $this->linesOfCode['ncloc'] += $linesOfCode['ncloc'];
=======
     * @psalm-return array{linesOfCode: int, commentLinesOfCode: int, nonCommentLinesOfCode: int}
     */
    public function linesOfCode(): array
    {
        if ($this->linesOfCode === null) {
            $this->linesOfCode = [
                'linesOfCode'           => 0,
                'commentLinesOfCode'    => 0,
                'nonCommentLinesOfCode' => 0,
            ];

            foreach ($this->children as $child) {
                $childLinesOfCode = $child->linesOfCode();

                $this->linesOfCode['linesOfCode'] += $childLinesOfCode['linesOfCode'];
                $this->linesOfCode['commentLinesOfCode'] += $childLinesOfCode['commentLinesOfCode'];
                $this->linesOfCode['nonCommentLinesOfCode'] += $childLinesOfCode['nonCommentLinesOfCode'];
>>>>>>> update
            }
        }

        return $this->linesOfCode;
    }

<<<<<<< HEAD
    /**
     * Returns the number of executable lines.
     *
     * @return int
     */
    public function getNumExecutableLines()
    {
        if ($this->numExecutableLines == -1) {
            $this->numExecutableLines = 0;

            foreach ($this->children as $child) {
                $this->numExecutableLines += $child->getNumExecutableLines();
=======
    public function numberOfExecutableLines(): int
    {
        if ($this->numExecutableLines === -1) {
            $this->numExecutableLines = 0;

            foreach ($this->children as $child) {
                $this->numExecutableLines += $child->numberOfExecutableLines();
>>>>>>> update
            }
        }

        return $this->numExecutableLines;
    }

<<<<<<< HEAD
    /**
     * Returns the number of executed lines.
     *
     * @return int
     */
    public function getNumExecutedLines()
    {
        if ($this->numExecutedLines == -1) {
            $this->numExecutedLines = 0;

            foreach ($this->children as $child) {
                $this->numExecutedLines += $child->getNumExecutedLines();
=======
    public function numberOfExecutedLines(): int
    {
        if ($this->numExecutedLines === -1) {
            $this->numExecutedLines = 0;

            foreach ($this->children as $child) {
                $this->numExecutedLines += $child->numberOfExecutedLines();
>>>>>>> update
            }
        }

        return $this->numExecutedLines;
    }

<<<<<<< HEAD
    /**
     * Returns the number of classes.
     *
     * @return int
     */
    public function getNumClasses()
    {
        if ($this->numClasses == -1) {
            $this->numClasses = 0;

            foreach ($this->children as $child) {
                $this->numClasses += $child->getNumClasses();
=======
    public function numberOfExecutableBranches(): int
    {
        if ($this->numExecutableBranches === -1) {
            $this->numExecutableBranches = 0;

            foreach ($this->children as $child) {
                $this->numExecutableBranches += $child->numberOfExecutableBranches();
            }
        }

        return $this->numExecutableBranches;
    }

    public function numberOfExecutedBranches(): int
    {
        if ($this->numExecutedBranches === -1) {
            $this->numExecutedBranches = 0;

            foreach ($this->children as $child) {
                $this->numExecutedBranches += $child->numberOfExecutedBranches();
            }
        }

        return $this->numExecutedBranches;
    }

    public function numberOfExecutablePaths(): int
    {
        if ($this->numExecutablePaths === -1) {
            $this->numExecutablePaths = 0;

            foreach ($this->children as $child) {
                $this->numExecutablePaths += $child->numberOfExecutablePaths();
            }
        }

        return $this->numExecutablePaths;
    }

    public function numberOfExecutedPaths(): int
    {
        if ($this->numExecutedPaths === -1) {
            $this->numExecutedPaths = 0;

            foreach ($this->children as $child) {
                $this->numExecutedPaths += $child->numberOfExecutedPaths();
            }
        }

        return $this->numExecutedPaths;
    }

    public function numberOfClasses(): int
    {
        if ($this->numClasses === -1) {
            $this->numClasses = 0;

            foreach ($this->children as $child) {
                $this->numClasses += $child->numberOfClasses();
>>>>>>> update
            }
        }

        return $this->numClasses;
    }

<<<<<<< HEAD
    /**
     * Returns the number of tested classes.
     *
     * @return int
     */
    public function getNumTestedClasses()
    {
        if ($this->numTestedClasses == -1) {
            $this->numTestedClasses = 0;

            foreach ($this->children as $child) {
                $this->numTestedClasses += $child->getNumTestedClasses();
=======
    public function numberOfTestedClasses(): int
    {
        if ($this->numTestedClasses === -1) {
            $this->numTestedClasses = 0;

            foreach ($this->children as $child) {
                $this->numTestedClasses += $child->numberOfTestedClasses();
>>>>>>> update
            }
        }

        return $this->numTestedClasses;
    }

<<<<<<< HEAD
    /**
     * Returns the number of traits.
     *
     * @return int
     */
    public function getNumTraits()
    {
        if ($this->numTraits == -1) {
            $this->numTraits = 0;

            foreach ($this->children as $child) {
                $this->numTraits += $child->getNumTraits();
=======
    public function numberOfTraits(): int
    {
        if ($this->numTraits === -1) {
            $this->numTraits = 0;

            foreach ($this->children as $child) {
                $this->numTraits += $child->numberOfTraits();
>>>>>>> update
            }
        }

        return $this->numTraits;
    }

<<<<<<< HEAD
    /**
     * Returns the number of tested traits.
     *
     * @return int
     */
    public function getNumTestedTraits()
    {
        if ($this->numTestedTraits == -1) {
            $this->numTestedTraits = 0;

            foreach ($this->children as $child) {
                $this->numTestedTraits += $child->getNumTestedTraits();
=======
    public function numberOfTestedTraits(): int
    {
        if ($this->numTestedTraits === -1) {
            $this->numTestedTraits = 0;

            foreach ($this->children as $child) {
                $this->numTestedTraits += $child->numberOfTestedTraits();
>>>>>>> update
            }
        }

        return $this->numTestedTraits;
    }

<<<<<<< HEAD
    /**
     * Returns the number of methods.
     *
     * @return int
     */
    public function getNumMethods()
    {
        if ($this->numMethods == -1) {
            $this->numMethods = 0;

            foreach ($this->children as $child) {
                $this->numMethods += $child->getNumMethods();
=======
    public function numberOfMethods(): int
    {
        if ($this->numMethods === -1) {
            $this->numMethods = 0;

            foreach ($this->children as $child) {
                $this->numMethods += $child->numberOfMethods();
>>>>>>> update
            }
        }

        return $this->numMethods;
    }

<<<<<<< HEAD
    /**
     * Returns the number of tested methods.
     *
     * @return int
     */
    public function getNumTestedMethods()
    {
        if ($this->numTestedMethods == -1) {
            $this->numTestedMethods = 0;

            foreach ($this->children as $child) {
                $this->numTestedMethods += $child->getNumTestedMethods();
=======
    public function numberOfTestedMethods(): int
    {
        if ($this->numTestedMethods === -1) {
            $this->numTestedMethods = 0;

            foreach ($this->children as $child) {
                $this->numTestedMethods += $child->numberOfTestedMethods();
>>>>>>> update
            }
        }

        return $this->numTestedMethods;
    }

<<<<<<< HEAD
    /**
     * Returns the number of functions.
     *
     * @return int
     */
    public function getNumFunctions()
    {
        if ($this->numFunctions == -1) {
            $this->numFunctions = 0;

            foreach ($this->children as $child) {
                $this->numFunctions += $child->getNumFunctions();
=======
    public function numberOfFunctions(): int
    {
        if ($this->numFunctions === -1) {
            $this->numFunctions = 0;

            foreach ($this->children as $child) {
                $this->numFunctions += $child->numberOfFunctions();
>>>>>>> update
            }
        }

        return $this->numFunctions;
    }

<<<<<<< HEAD
    /**
     * Returns the number of tested functions.
     *
     * @return int
     */
    public function getNumTestedFunctions()
    {
        if ($this->numTestedFunctions == -1) {
            $this->numTestedFunctions = 0;

            foreach ($this->children as $child) {
                $this->numTestedFunctions += $child->getNumTestedFunctions();
=======
    public function numberOfTestedFunctions(): int
    {
        if ($this->numTestedFunctions === -1) {
            $this->numTestedFunctions = 0;

            foreach ($this->children as $child) {
                $this->numTestedFunctions += $child->numberOfTestedFunctions();
>>>>>>> update
            }
        }

        return $this->numTestedFunctions;
    }
}
