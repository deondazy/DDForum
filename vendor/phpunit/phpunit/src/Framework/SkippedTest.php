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
 * A marker interface for marking a unit test as being skipped.
 *
 * @since      Interface available since Release 3.0.0
 */
interface PHPUnit_Framework_SkippedTest
=======
namespace PHPUnit\Framework;

use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
interface SkippedTest extends Throwable
>>>>>>> update
{
}
