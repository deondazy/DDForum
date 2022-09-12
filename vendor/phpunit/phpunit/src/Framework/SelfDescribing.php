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
 * Interface for classes that can return a description of itself.
 *
 * @since      Interface available since Release 3.0.0
 */
interface PHPUnit_Framework_SelfDescribing
{
    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString();
=======
namespace PHPUnit\Framework;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
interface SelfDescribing
{
    /**
     * Returns a string representation of the object.
     */
    public function toString(): string;
>>>>>>> update
}
