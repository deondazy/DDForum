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
 * A skipped test case
 *
 * @since Class available since Release 4.3.0
 */
class PHPUnit_Framework_SkippedTestCase extends PHPUnit_Framework_TestCase
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
final class SkippedTestCase extends TestCase
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
     * @var bool
     */
    protected $useOutputBuffering = false;

    /**
     * @param string $message
     */
    public function __construct($className, $methodName, $message = '')
    {
        $this->message = $message;
        parent::__construct($className . '::' . $methodName);
    }

    /**
     * @throws PHPUnit_Framework_Exception
     */
    protected function runTest()
    {
        $this->markTestSkipped($this->message);
    }

    /**
     * @return string
     */
    public function getMessage()
=======
     * @var string
     */
    private $message;

    public function __construct(string $className, string $methodName, string $message = '')
    {
        parent::__construct($className . '::' . $methodName);

        $this->message = $message;
    }

    public function getMessage(): string
>>>>>>> update
    {
        return $this->message;
    }

    /**
     * Returns a string representation of the test case.
     *
<<<<<<< HEAD
     * @return string
     */
    public function toString()
    {
        return $this->getName();
    }
=======
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function toString(): string
    {
        return $this->getName();
    }

    /**
     * @throws Exception
     */
    protected function runTest(): void
    {
        $this->markTestSkipped($this->message);
    }
>>>>>>> update
}
