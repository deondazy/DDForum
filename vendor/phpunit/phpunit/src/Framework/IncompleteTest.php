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
 * A marker interface for marking any exception/error as result of an unit
 * test as incomplete implementation or currently not implemented.
 *
 * @since      Interface available since Release 2.0.0
 */
interface PHPUnit_Framework_IncompleteTest
=======
namespace PHPUnit\Framework;

use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
interface IncompleteTest extends Throwable
>>>>>>> update
{
}
