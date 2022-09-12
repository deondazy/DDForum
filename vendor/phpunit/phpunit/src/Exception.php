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
 * Marker interface for PHPUnit exceptions.
 *
 * @since      Interface available since Release 4.0.0
 */
interface PHPUnit_Exception
=======
namespace PHPUnit;

use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
interface Exception extends Throwable
>>>>>>> update
{
}
