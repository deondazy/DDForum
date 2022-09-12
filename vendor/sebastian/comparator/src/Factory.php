<<<<<<< HEAD
<?php
/*
 * This file is part of the Comparator package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of sebastian/comparator.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

namespace SebastianBergmann\Comparator;

=======
namespace SebastianBergmann\Comparator;

use function array_unshift;

>>>>>>> update
/**
 * Factory for comparators which compare values for equality.
 */
class Factory
{
    /**
<<<<<<< HEAD
     * @var Comparator[]
     */
    private $comparators = array();

    /**
=======
>>>>>>> update
     * @var Factory
     */
    private static $instance;

    /**
<<<<<<< HEAD
     * Constructs a new factory.
     */
    public function __construct()
    {
        $this->register(new TypeComparator);
        $this->register(new ScalarComparator);
        $this->register(new NumericComparator);
        $this->register(new DoubleComparator);
        $this->register(new ArrayComparator);
        $this->register(new ResourceComparator);
        $this->register(new ObjectComparator);
        $this->register(new ExceptionComparator);
        $this->register(new SplObjectStorageComparator);
        $this->register(new DOMNodeComparator);
        $this->register(new MockObjectComparator);
        $this->register(new DateTimeComparator);
    }
=======
     * @var Comparator[]
     */
    private $customComparators = [];

    /**
     * @var Comparator[]
     */
    private $defaultComparators = [];
>>>>>>> update

    /**
     * @return Factory
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
<<<<<<< HEAD
            self::$instance = new self;
=======
            self::$instance = new self; // @codeCoverageIgnore
>>>>>>> update
        }

        return self::$instance;
    }

    /**
<<<<<<< HEAD
     * Returns the correct comparator for comparing two values.
     *
     * @param  mixed      $expected The first value to compare
     * @param  mixed      $actual   The second value to compare
=======
     * Constructs a new factory.
     */
    public function __construct()
    {
        $this->registerDefaultComparators();
    }

    /**
     * Returns the correct comparator for comparing two values.
     *
     * @param mixed $expected The first value to compare
     * @param mixed $actual   The second value to compare
     *
>>>>>>> update
     * @return Comparator
     */
    public function getComparatorFor($expected, $actual)
    {
<<<<<<< HEAD
        foreach ($this->comparators as $comparator) {
=======
        foreach ($this->customComparators as $comparator) {
>>>>>>> update
            if ($comparator->accepts($expected, $actual)) {
                return $comparator;
            }
        }
<<<<<<< HEAD
=======

        foreach ($this->defaultComparators as $comparator) {
            if ($comparator->accepts($expected, $actual)) {
                return $comparator;
            }
        }

        throw new RuntimeException('No suitable Comparator implementation found');
>>>>>>> update
    }

    /**
     * Registers a new comparator.
     *
<<<<<<< HEAD
     * This comparator will be returned by getInstance() if its accept() method
     * returns TRUE for the compared values. It has higher priority than the
     * existing comparators, meaning that its accept() method will be tested
     * before those of the other comparators.
     *
     * @param Comparator $comparator The registered comparator
     */
    public function register(Comparator $comparator)
    {
        array_unshift($this->comparators, $comparator);
=======
     * This comparator will be returned by getComparatorFor() if its accept() method
     * returns TRUE for the compared values. It has higher priority than the
     * existing comparators, meaning that its accept() method will be invoked
     * before those of the other comparators.
     *
     * @param Comparator $comparator The comparator to be registered
     */
    public function register(Comparator $comparator)/*: void*/
    {
        array_unshift($this->customComparators, $comparator);
>>>>>>> update

        $comparator->setFactory($this);
    }

    /**
     * Unregisters a comparator.
     *
<<<<<<< HEAD
     * This comparator will no longer be returned by getInstance().
     *
     * @param Comparator $comparator The unregistered comparator
     */
    public function unregister(Comparator $comparator)
    {
        foreach ($this->comparators as $key => $_comparator) {
            if ($comparator === $_comparator) {
                unset($this->comparators[$key]);
            }
        }
    }
=======
     * This comparator will no longer be considered by getComparatorFor().
     *
     * @param Comparator $comparator The comparator to be unregistered
     */
    public function unregister(Comparator $comparator)/*: void*/
    {
        foreach ($this->customComparators as $key => $_comparator) {
            if ($comparator === $_comparator) {
                unset($this->customComparators[$key]);
            }
        }
    }

    /**
     * Unregisters all non-default comparators.
     */
    public function reset()/*: void*/
    {
        $this->customComparators = [];
    }

    private function registerDefaultComparators(): void
    {
        $this->registerDefaultComparator(new MockObjectComparator);
        $this->registerDefaultComparator(new DateTimeComparator);
        $this->registerDefaultComparator(new DOMNodeComparator);
        $this->registerDefaultComparator(new SplObjectStorageComparator);
        $this->registerDefaultComparator(new ExceptionComparator);
        $this->registerDefaultComparator(new ObjectComparator);
        $this->registerDefaultComparator(new ResourceComparator);
        $this->registerDefaultComparator(new ArrayComparator);
        $this->registerDefaultComparator(new DoubleComparator);
        $this->registerDefaultComparator(new NumericComparator);
        $this->registerDefaultComparator(new ScalarComparator);
        $this->registerDefaultComparator(new TypeComparator);
    }

    private function registerDefaultComparator(Comparator $comparator): void
    {
        $this->defaultComparators[] = $comparator;

        $comparator->setFactory($this);
    }
>>>>>>> update
}
