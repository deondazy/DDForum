<?php

namespace DeepCopy;

<<<<<<< HEAD
use DeepCopy\Exception\CloneException;
use DeepCopy\Filter\Filter;
use DeepCopy\Matcher\Matcher;
use DeepCopy\TypeFilter\Spl\SplDoublyLinkedList;
use DeepCopy\TypeFilter\TypeFilter;
use DeepCopy\TypeMatcher\TypeMatcher;
use ReflectionProperty;
use DeepCopy\Reflection\ReflectionHelper;

/**
 * DeepCopy
=======
use ArrayObject;
use DateInterval;
use DateTimeInterface;
use DateTimeZone;
use DeepCopy\Exception\CloneException;
use DeepCopy\Filter\Filter;
use DeepCopy\Matcher\Matcher;
use DeepCopy\Reflection\ReflectionHelper;
use DeepCopy\TypeFilter\Date\DateIntervalFilter;
use DeepCopy\TypeFilter\Spl\ArrayObjectFilter;
use DeepCopy\TypeFilter\Spl\SplDoublyLinkedListFilter;
use DeepCopy\TypeFilter\TypeFilter;
use DeepCopy\TypeMatcher\TypeMatcher;
use ReflectionObject;
use ReflectionProperty;
use SplDoublyLinkedList;

/**
 * @final
>>>>>>> update
 */
class DeepCopy
{
    /**
<<<<<<< HEAD
     * @var array
=======
     * @var object[] List of objects copied.
>>>>>>> update
     */
    private $hashMap = [];

    /**
     * Filters to apply.
<<<<<<< HEAD
     * @var array
=======
     *
     * @var array Array of ['filter' => Filter, 'matcher' => Matcher] pairs.
>>>>>>> update
     */
    private $filters = [];

    /**
     * Type Filters to apply.
<<<<<<< HEAD
     * @var array
     */
    private $typeFilters = [];

=======
     *
     * @var array Array of ['filter' => Filter, 'matcher' => Matcher] pairs.
     */
    private $typeFilters = [];

    /**
     * @var bool
     */
>>>>>>> update
    private $skipUncloneable = false;

    /**
     * @var bool
     */
    private $useCloneMethod;

    /**
     * @param bool $useCloneMethod   If set to true, when an object implements the __clone() function, it will be used
     *                               instead of the regular deep cloning.
     */
    public function __construct($useCloneMethod = false)
    {
        $this->useCloneMethod = $useCloneMethod;

<<<<<<< HEAD
        $this->addTypeFilter(new SplDoublyLinkedList($this), new TypeMatcher('\SplDoublyLinkedList'));
    }

    /**
     * Cloning uncloneable properties won't throw exception.
     * @param $skipUncloneable
=======
        $this->addTypeFilter(new ArrayObjectFilter($this), new TypeMatcher(ArrayObject::class));
        $this->addTypeFilter(new DateIntervalFilter(), new TypeMatcher(DateInterval::class));
        $this->addTypeFilter(new SplDoublyLinkedListFilter($this), new TypeMatcher(SplDoublyLinkedList::class));
    }

    /**
     * If enabled, will not throw an exception when coming across an uncloneable property.
     *
     * @param $skipUncloneable
     *
>>>>>>> update
     * @return $this
     */
    public function skipUncloneable($skipUncloneable = true)
    {
        $this->skipUncloneable = $skipUncloneable;
<<<<<<< HEAD
=======

>>>>>>> update
        return $this;
    }

    /**
<<<<<<< HEAD
     * Perform a deep copy of the object.
     * @param mixed $object
=======
     * Deep copies the given object.
     *
     * @param mixed $object
     *
>>>>>>> update
     * @return mixed
     */
    public function copy($object)
    {
        $this->hashMap = [];

        return $this->recursiveCopy($object);
    }

    public function addFilter(Filter $filter, Matcher $matcher)
    {
        $this->filters[] = [
            'matcher' => $matcher,
            'filter'  => $filter,
        ];
    }

<<<<<<< HEAD
=======
    public function prependFilter(Filter $filter, Matcher $matcher)
    {
        array_unshift($this->filters, [
            'matcher' => $matcher,
            'filter'  => $filter,
        ]);
    }

>>>>>>> update
    public function addTypeFilter(TypeFilter $filter, TypeMatcher $matcher)
    {
        $this->typeFilters[] = [
            'matcher' => $matcher,
            'filter'  => $filter,
        ];
    }

<<<<<<< HEAD

=======
>>>>>>> update
    private function recursiveCopy($var)
    {
        // Matches Type Filter
        if ($filter = $this->getFirstMatchedTypeFilter($this->typeFilters, $var)) {
            return $filter->apply($var);
        }

        // Resource
        if (is_resource($var)) {
            return $var;
        }
<<<<<<< HEAD
=======

>>>>>>> update
        // Array
        if (is_array($var)) {
            return $this->copyArray($var);
        }
<<<<<<< HEAD
=======

>>>>>>> update
        // Scalar
        if (! is_object($var)) {
            return $var;
        }
<<<<<<< HEAD
=======

        // Enum
        if (PHP_VERSION_ID >= 80100 && enum_exists(get_class($var))) {
            return $var;
        }

>>>>>>> update
        // Object
        return $this->copyObject($var);
    }

    /**
     * Copy an array
     * @param array $array
     * @return array
     */
    private function copyArray(array $array)
    {
        foreach ($array as $key => $value) {
            $array[$key] = $this->recursiveCopy($value);
        }

        return $array;
    }

    /**
<<<<<<< HEAD
     * Copy an object
     * @param object $object
=======
     * Copies an object.
     *
     * @param object $object
     *
     * @throws CloneException
     *
>>>>>>> update
     * @return object
     */
    private function copyObject($object)
    {
        $objectHash = spl_object_hash($object);

        if (isset($this->hashMap[$objectHash])) {
            return $this->hashMap[$objectHash];
        }

<<<<<<< HEAD
        $reflectedObject = new \ReflectionObject($object);

        if (false === $isCloneable = $reflectedObject->isCloneable() and $this->skipUncloneable) {
            $this->hashMap[$objectHash] = $object;
            return $object;
        }

        if (false === $isCloneable) {
            throw new CloneException(sprintf(
                'Class "%s" is not cloneable.',
                $reflectedObject->getName()
            ));
=======
        $reflectedObject = new ReflectionObject($object);
        $isCloneable = $reflectedObject->isCloneable();

        if (false === $isCloneable) {
            if ($this->skipUncloneable) {
                $this->hashMap[$objectHash] = $object;

                return $object;
            }

            throw new CloneException(
                sprintf(
                    'The class "%s" is not cloneable.',
                    $reflectedObject->getName()
                )
            );
>>>>>>> update
        }

        $newObject = clone $object;
        $this->hashMap[$objectHash] = $newObject;
<<<<<<< HEAD
        if ($this->useCloneMethod && $reflectedObject->hasMethod('__clone')) {
            return $object;
        }

        if ($newObject instanceof \DateTimeInterface) {
            return $newObject;
        }
=======

        if ($this->useCloneMethod && $reflectedObject->hasMethod('__clone')) {
            return $newObject;
        }

        if ($newObject instanceof DateTimeInterface || $newObject instanceof DateTimeZone) {
            return $newObject;
        }

>>>>>>> update
        foreach (ReflectionHelper::getProperties($reflectedObject) as $property) {
            $this->copyObjectProperty($newObject, $property);
        }

        return $newObject;
    }

    private function copyObjectProperty($object, ReflectionProperty $property)
    {
        // Ignore static properties
        if ($property->isStatic()) {
            return;
        }

        // Apply the filters
        foreach ($this->filters as $item) {
            /** @var Matcher $matcher */
            $matcher = $item['matcher'];
            /** @var Filter $filter */
            $filter = $item['filter'];

            if ($matcher->matches($object, $property->getName())) {
                $filter->apply(
                    $object,
                    $property->getName(),
                    function ($object) {
                        return $this->recursiveCopy($object);
                    }
                );
<<<<<<< HEAD
=======

>>>>>>> update
                // If a filter matches, we stop processing this property
                return;
            }
        }

        $property->setAccessible(true);
<<<<<<< HEAD
=======

        // Ignore uninitialized properties (for PHP >7.4)
        if (method_exists($property, 'isInitialized') && !$property->isInitialized($object)) {
            return;
        }

>>>>>>> update
        $propertyValue = $property->getValue($object);

        // Copy the property
        $property->setValue($object, $this->recursiveCopy($propertyValue));
    }

    /**
<<<<<<< HEAD
     * Returns first filter that matches variable, NULL if no such filter found.
     * @param array $filterRecords Associative array with 2 members: 'filter' with value of type {@see TypeFilter} and
     *                             'matcher' with value of type {@see TypeMatcher}
     * @param mixed $var
=======
     * Returns first filter that matches variable, `null` if no such filter found.
     *
     * @param array $filterRecords Associative array with 2 members: 'filter' with value of type {@see TypeFilter} and
     *                             'matcher' with value of type {@see TypeMatcher}
     * @param mixed $var
     *
>>>>>>> update
     * @return TypeFilter|null
     */
    private function getFirstMatchedTypeFilter(array $filterRecords, $var)
    {
        $matched = $this->first(
            $filterRecords,
            function (array $record) use ($var) {
                /* @var TypeMatcher $matcher */
                $matcher = $record['matcher'];

                return $matcher->matches($var);
            }
        );

        return isset($matched) ? $matched['filter'] : null;
    }

    /**
<<<<<<< HEAD
     * Returns first element that matches predicate, NULL if no such element found.
     * @param array    $elements
     * @param callable $predicate Predicate arguments are: element.
     * @return mixed|null
=======
     * Returns first element that matches predicate, `null` if no such element found.
     *
     * @param array    $elements Array of ['filter' => Filter, 'matcher' => Matcher] pairs.
     * @param callable $predicate Predicate arguments are: element.
     *
     * @return array|null Associative array with 2 members: 'filter' with value of type {@see TypeFilter} and 'matcher'
     *                    with value of type {@see TypeMatcher} or `null`.
>>>>>>> update
     */
    private function first(array $elements, callable $predicate)
    {
        foreach ($elements as $element) {
            if (call_user_func($predicate, $element)) {
                return $element;
            }
        }

        return null;
    }
}
