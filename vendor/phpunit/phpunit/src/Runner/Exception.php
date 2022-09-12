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
class PHPUnit_Runner_Exception extends RuntimeException implements PHPUnit_Exception
=======
namespace PHPUnit\Runner;

use RuntimeException;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class Exception extends RuntimeException implements \PHPUnit\Exception
>>>>>>> update
{
}
