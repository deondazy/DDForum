<<<<<<< HEAD
<?php
/*
 * This file is part of the php-code-coverage package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

namespace SebastianBergmann\CodeCoverage;

/**
 * Exception interface for php-code-coverage component.
 */
interface Exception
=======
namespace SebastianBergmann\CodeCoverage;

use Throwable;

interface Exception extends Throwable
>>>>>>> update
{
}
