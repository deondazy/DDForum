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
=======
namespace PHPUnit\Framework;

use const PHP_VERSION_ID;
use function array_keys;
use function get_class;
use function spl_object_hash;
use PHPUnit\Util\Filter;
use Throwable;
use WeakReference;
>>>>>>> update

/**
 * Wraps Exceptions thrown by code under test.
 *
 * Re-instantiates Exceptions thrown by user-space code to retain their original
 * class names, properties, and stack traces (but without arguments).
 *
<<<<<<< HEAD
 * Unlike PHPUnit_Framework_Exception, the complete stack of previous Exceptions
 * is processed.
 *
 * @since Class available since Release 4.3.0
 */
class PHPUnit_Framework_ExceptionWrapper extends PHPUnit_Framework_Exception
=======
 * Unlike PHPUnit\Framework\Exception, the complete stack of previous Exceptions
 * is processed.
 *
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ExceptionWrapper extends Exception
>>>>>>> update
{
    /**
     * @var string
     */
<<<<<<< HEAD
    protected $classname;

    /**
     * @var PHPUnit_Framework_ExceptionWrapper|null
=======
    protected $className;

    /**
     * @var null|ExceptionWrapper
>>>>>>> update
     */
    protected $previous;

    /**
<<<<<<< HEAD
     * @param Throwable|Exception $e
     */
    public function __construct($e)
    {
        // PDOException::getCode() is a string.
        // @see http://php.net/manual/en/class.pdoexception.php#95812
        parent::__construct($e->getMessage(), (int) $e->getCode());

        $this->classname = get_class($e);
        $this->file      = $e->getFile();
        $this->line      = $e->getLine();

        $this->serializableTrace = $e->getTrace();

        foreach ($this->serializableTrace as $i => $call) {
            unset($this->serializableTrace[$i]['args']);
        }

        if ($e->getPrevious()) {
            $this->previous = new self($e->getPrevious());
        }
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        return $this->classname;
    }

    /**
     * @return PHPUnit_Framework_ExceptionWrapper
     */
    public function getPreviousWrapped()
    {
        return $this->previous;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $string = PHPUnit_Framework_TestFailure::exceptionToString($this);

        if ($trace = PHPUnit_Util_Filter::getFilteredStacktrace($this)) {
=======
     * @var null|WeakReference<Throwable>
     */
    private $originalException;

    public function __construct(Throwable $t)
    {
        // PDOException::getCode() is a string.
        // @see https://php.net/manual/en/class.pdoexception.php#95812
        parent::__construct($t->getMessage(), (int) $t->getCode());

        $this->setOriginalException($t);
    }

    public function __toString(): string
    {
        $string = TestFailure::exceptionToString($this);

        if ($trace = Filter::getFilteredStacktrace($this)) {
>>>>>>> update
            $string .= "\n" . $trace;
        }

        if ($this->previous) {
            $string .= "\nCaused by\n" . $this->previous;
        }

        return $string;
    }
<<<<<<< HEAD
=======

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getPreviousWrapped(): ?self
    {
        return $this->previous;
    }

    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    public function setOriginalException(Throwable $t): void
    {
        $this->originalException($t);

        $this->className = get_class($t);
        $this->file      = $t->getFile();
        $this->line      = $t->getLine();

        $this->serializableTrace = $t->getTrace();

        foreach (array_keys($this->serializableTrace) as $key) {
            unset($this->serializableTrace[$key]['args']);
        }

        if ($t->getPrevious()) {
            $this->previous = new self($t->getPrevious());
        }
    }

    public function getOriginalException(): ?Throwable
    {
        return $this->originalException();
    }

    /**
     * Method to contain static originalException to exclude it from stacktrace to prevent the stacktrace contents,
     * which can be quite big, from being garbage-collected, thus blocking memory until shutdown.
     *
     * Approach works both for var_dump() and var_export() and print_r().
     */
    private function originalException(Throwable $exceptionToStore = null): ?Throwable
    {
        // drop once PHP 7.3 support is removed
        if (PHP_VERSION_ID < 70400) {
            static $originalExceptions;

            $instanceId = spl_object_hash($this);

            if ($exceptionToStore) {
                $originalExceptions[$instanceId] = $exceptionToStore;
            }

            return $originalExceptions[$instanceId] ?? null;
        }

        if ($exceptionToStore) {
            $this->originalException = WeakReference::create($exceptionToStore);
        }

        return $this->originalException !== null ? $this->originalException->get() : null;
    }
>>>>>>> update
}
