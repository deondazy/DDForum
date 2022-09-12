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
 * Exception that is raised when code is unintentionally covered.
 */
class UnintentionallyCoveredCodeException extends RuntimeException
=======
namespace SebastianBergmann\CodeCoverage;

use RuntimeException;

final class UnintentionallyCoveredCodeException extends RuntimeException implements Exception
>>>>>>> update
{
    /**
     * @var array
     */
<<<<<<< HEAD
    private $unintentionallyCoveredUnits = [];

    /**
     * @param array $unintentionallyCoveredUnits
     */
=======
    private $unintentionallyCoveredUnits;

>>>>>>> update
    public function __construct(array $unintentionallyCoveredUnits)
    {
        $this->unintentionallyCoveredUnits = $unintentionallyCoveredUnits;

        parent::__construct($this->toString());
    }

<<<<<<< HEAD
    /**
     * @return array
     */
    public function getUnintentionallyCoveredUnits()
=======
    public function getUnintentionallyCoveredUnits(): array
>>>>>>> update
    {
        return $this->unintentionallyCoveredUnits;
    }

<<<<<<< HEAD
    /**
     * @return string
     */
    private function toString()
=======
    private function toString(): string
>>>>>>> update
    {
        $message = '';

        foreach ($this->unintentionallyCoveredUnits as $unit) {
            $message .= '- ' . $unit . "\n";
        }

        return $message;
    }
}
