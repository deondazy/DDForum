<<<<<<< HEAD
<?php
=======
<?php declare(strict_types=1);
>>>>>>> update
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

/**
 * @since Class available since Release 4.0.0
 */
class PHPUnit_Runner_Filter_Factory
{
    /**
     * @var array
=======
namespace PHPUnit\Runner\Filter;

use function assert;
use function sprintf;
use FilterIterator;
use Iterator;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Runner\Exception;
use RecursiveFilterIterator;
use ReflectionClass;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class Factory
{
    /**
     * @psalm-var array<int,array{0: \ReflectionClass, 1: array|string}>
>>>>>>> update
     */
    private $filters = [];

    /**
<<<<<<< HEAD
     * @param ReflectionClass $filter
     * @param mixed           $args
     */
    public function addFilter(ReflectionClass $filter, $args)
    {
        if (!$filter->isSubclassOf('RecursiveFilterIterator')) {
            throw new InvalidArgumentException(
=======
     * @param array|string $args
     *
     * @throws Exception
     */
    public function addFilter(ReflectionClass $filter, $args): void
    {
        if (!$filter->isSubclassOf(RecursiveFilterIterator::class)) {
            throw new Exception(
>>>>>>> update
                sprintf(
                    'Class "%s" does not extend RecursiveFilterIterator',
                    $filter->name
                )
            );
        }

        $this->filters[] = [$filter, $args];
    }

<<<<<<< HEAD
    /**
     * @return FilterIterator
     */
    public function factory(Iterator $iterator, PHPUnit_Framework_TestSuite $suite)
    {
        foreach ($this->filters as $filter) {
            list($class, $args) = $filter;
            $iterator           = $class->newInstance($iterator, $args, $suite);
        }

=======
    public function factory(Iterator $iterator, TestSuite $suite): FilterIterator
    {
        foreach ($this->filters as $filter) {
            [$class, $args] = $filter;
            $iterator       = $class->newInstance($iterator, $args, $suite);
        }

        assert($iterator instanceof FilterIterator);

>>>>>>> update
        return $iterator;
    }
}
