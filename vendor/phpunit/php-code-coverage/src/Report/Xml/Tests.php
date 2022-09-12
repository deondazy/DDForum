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

namespace SebastianBergmann\CodeCoverage\Report\Xml;

class Tests
=======
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use DOMElement;

/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class Tests
>>>>>>> update
{
    private $contextNode;

    private $codeMap = [
<<<<<<< HEAD
        0 => 'PASSED',     // PHPUnit_Runner_BaseTestRunner::STATUS_PASSED
        1 => 'SKIPPED',    // PHPUnit_Runner_BaseTestRunner::STATUS_SKIPPED
        2 => 'INCOMPLETE', // PHPUnit_Runner_BaseTestRunner::STATUS_INCOMPLETE
        3 => 'FAILURE',    // PHPUnit_Runner_BaseTestRunner::STATUS_FAILURE
        4 => 'ERROR',      // PHPUnit_Runner_BaseTestRunner::STATUS_ERROR
        5 => 'RISKY',      // PHPUnit_Runner_BaseTestRunner::STATUS_RISKY
        6 => 'WARNING'     // PHPUnit_Runner_BaseTestRunner::STATUS_WARNING
    ];

    public function __construct(\DOMElement $context)
=======
        -1 => 'UNKNOWN',    // PHPUnit_Runner_BaseTestRunner::STATUS_UNKNOWN
        0  => 'PASSED',     // PHPUnit_Runner_BaseTestRunner::STATUS_PASSED
        1  => 'SKIPPED',    // PHPUnit_Runner_BaseTestRunner::STATUS_SKIPPED
        2  => 'INCOMPLETE', // PHPUnit_Runner_BaseTestRunner::STATUS_INCOMPLETE
        3  => 'FAILURE',    // PHPUnit_Runner_BaseTestRunner::STATUS_FAILURE
        4  => 'ERROR',      // PHPUnit_Runner_BaseTestRunner::STATUS_ERROR
        5  => 'RISKY',      // PHPUnit_Runner_BaseTestRunner::STATUS_RISKY
        6  => 'WARNING',     // PHPUnit_Runner_BaseTestRunner::STATUS_WARNING
    ];

    public function __construct(DOMElement $context)
>>>>>>> update
    {
        $this->contextNode = $context;
    }

<<<<<<< HEAD
    public function addTest($test, array $result)
    {
        $node = $this->contextNode->appendChild(
            $this->contextNode->ownerDocument->createElementNS(
                'http://schema.phpunit.de/coverage/1.0',
=======
    public function addTest(string $test, array $result): void
    {
        $node = $this->contextNode->appendChild(
            $this->contextNode->ownerDocument->createElementNS(
                'https://schema.phpunit.de/coverage/1.0',
>>>>>>> update
                'test'
            )
        );

        $node->setAttribute('name', $test);
        $node->setAttribute('size', $result['size']);
<<<<<<< HEAD
        $node->setAttribute('result', (int) $result['status']);
=======
        $node->setAttribute('result', (string) $result['status']);
>>>>>>> update
        $node->setAttribute('status', $this->codeMap[(int) $result['status']]);
    }
}
