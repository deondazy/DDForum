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
 * A warning.
 *
 * @since Class available since Release 2.0.0
 */
class PHPUnit_Framework_WarningTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $message = '';

    /**
=======
namespace PHPUnit\Framework;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class WarningTestCase extends TestCase
{
    /**
>>>>>>> update
     * @var bool
     */
    protected $backupGlobals = false;

    /**
     * @var bool
     */
    protected $backupStaticAttributes = false;

    /**
     * @var bool
     */
    protected $runTestInSeparateProcess = false;

    /**
<<<<<<< HEAD
     * @var bool
     */
    protected $useErrorHandler = false;

    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
        parent::__construct('Warning');
    }

    /**
     * @throws PHPUnit_Framework_Exception
     */
    protected function runTest()
    {
        throw new PHPUnit_Framework_Warning($this->message);
    }

    /**
     * @return string
     *
     * @since Method available since Release 3.0.0
     */
    public function getMessage()
=======
     * @var string
     */
    private $message;

    public function __construct(string $message = '')
    {
        $this->message = $message;

        parent::__construct('Warning');
    }

    public function getMessage(): string
>>>>>>> update
    {
        return $this->message;
    }

    /**
     * Returns a string representation of the test case.
<<<<<<< HEAD
     *
     * @return string
     *
     * @since Method available since Release 3.4.0
     */
    public function toString()
    {
        return 'Warning';
    }
=======
     */
    public function toString(): string
    {
        return 'Warning';
    }

    /**
     * @throws Exception
     *
     * @psalm-return never-return
     */
    protected function runTest(): void
    {
        throw new Warning($this->message);
    }
>>>>>>> update
}
