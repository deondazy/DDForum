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
 * Constraint that evaluates against a specified closure.
 */
class PHPUnit_Framework_Constraint_Callback extends PHPUnit_Framework_Constraint
{
    private $callback;

    /**
     * @param callable $callback
     *
     * @throws PHPUnit_Framework_Exception
     */
    public function __construct($callback)
    {
        if (!is_callable($callback)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
                1,
                'callable'
            );
        }

        parent::__construct();

=======
namespace PHPUnit\Framework\Constraint;

/**
 * @psalm-template CallbackInput of mixed
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class Callback extends Constraint
{
    /**
     * @var callable
     *
     * @psalm-var callable(CallbackInput $input): bool
     */
    private $callback;

    /** @psalm-param callable(CallbackInput $input): bool $callback */
    public function __construct(callable $callback)
    {
>>>>>>> update
        $this->callback = $callback;
    }

    /**
<<<<<<< HEAD
     * Evaluates the constraint for parameter $value. Returns true if the
     * constraint is met, false otherwise.
     *
     * @param mixed $other Value or object to evaluate.
     *
     * @return bool
     */
    protected function matches($other)
    {
        return call_user_func($this->callback, $other);
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @return string
     */
    public function toString()
    {
        return 'is accepted by specified callback';
=======
     * Returns a string representation of the constraint.
     */
    public function toString(): string
    {
        return 'is accepted by specified callback';
    }

    /**
     * Evaluates the constraint for parameter $value. Returns true if the
     * constraint is met, false otherwise.
     *
     * @param mixed $other value or object to evaluate
     *
     * @psalm-param CallbackInput $other
     */
    protected function matches($other): bool
    {
        return ($this->callback)($other);
>>>>>>> update
    }
}
