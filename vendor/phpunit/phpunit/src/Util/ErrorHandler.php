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

// Workaround for http://bugs.php.net/bug.php?id=47987,
// see https://github.com/sebastianbergmann/phpunit/issues#issue/125 for details
// Use dirname(__DIR__) instead of using /../ because of https://github.com/facebook/hhvm/issues/5215
require_once dirname(__DIR__) . '/Framework/Error.php';
require_once dirname(__DIR__) . '/Framework/Error/Notice.php';
require_once dirname(__DIR__) . '/Framework/Error/Warning.php';
require_once dirname(__DIR__) . '/Framework/Error/Deprecated.php';

/**
 * Error handler that converts PHP errors and warnings to exceptions.
 *
 * @since Class available since Release 3.3.0
 */
class PHPUnit_Util_ErrorHandler
{
    protected static $errorStack = [];

    /**
     * Returns the error stack.
     *
     * @return array
     */
    public static function getErrorStack()
    {
        return self::$errorStack;
    }

    /**
     * @param int    $errno
     * @param string $errstr
     * @param string $errfile
     * @param int    $errline
     *
     * @throws PHPUnit_Framework_Error
     */
    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        if (!($errno & error_reporting())) {
            return false;
        }

        self::$errorStack[] = [$errno, $errstr, $errfile, $errline];

        $trace = debug_backtrace(false);
        array_shift($trace);

        foreach ($trace as $frame) {
            if ($frame['function'] == '__toString') {
                return false;
            }
        }

        if ($errno == E_NOTICE || $errno == E_USER_NOTICE || $errno == E_STRICT) {
            if (PHPUnit_Framework_Error_Notice::$enabled !== true) {
                return false;
            }

            $exception = 'PHPUnit_Framework_Error_Notice';
        } elseif ($errno == E_WARNING || $errno == E_USER_WARNING) {
            if (PHPUnit_Framework_Error_Warning::$enabled !== true) {
                return false;
            }

            $exception = 'PHPUnit_Framework_Error_Warning';
        } elseif ($errno == E_DEPRECATED || $errno == E_USER_DEPRECATED) {
            if (PHPUnit_Framework_Error_Deprecated::$enabled !== true) {
                return false;
            }

            $exception = 'PHPUnit_Framework_Error_Deprecated';
        } else {
            $exception = 'PHPUnit_Framework_Error';
        }

        throw new $exception($errstr, $errno, $errfile, $errline);
    }

    /**
     * Registers an error handler and returns a function that will restore
     * the previous handler when invoked
     *
     * @param int $severity PHP predefined error constant
     *
     * @throws Exception if event of specified severity is emitted
     */
    public static function handleErrorOnce($severity = E_WARNING)
    {
        $terminator = function () {
            static $expired = false;
            if (!$expired) {
                $expired = true;
                // cleans temporary error handler
                return restore_error_handler();
            }
        };

        set_error_handler(function ($errno, $errstr) use ($severity) {
            if ($errno === $severity) {
                return;
            }

            return false;
        });

        return $terminator;
=======
namespace PHPUnit\Util;

use const E_DEPRECATED;
use const E_NOTICE;
use const E_STRICT;
use const E_USER_DEPRECATED;
use const E_USER_NOTICE;
use const E_USER_WARNING;
use const E_WARNING;
use function error_reporting;
use function restore_error_handler;
use function set_error_handler;
use PHPUnit\Framework\Error\Deprecated;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ErrorHandler
{
    /**
     * @var bool
     */
    private $convertDeprecationsToExceptions;

    /**
     * @var bool
     */
    private $convertErrorsToExceptions;

    /**
     * @var bool
     */
    private $convertNoticesToExceptions;

    /**
     * @var bool
     */
    private $convertWarningsToExceptions;

    /**
     * @var bool
     */
    private $registered = false;

    public static function invokeIgnoringWarnings(callable $callable)
    {
        set_error_handler(
            static function ($errorNumber, $errorString)
            {
                if ($errorNumber === E_WARNING) {
                    return;
                }

                return false;
            }
        );

        $result = $callable();

        restore_error_handler();

        return $result;
    }

    public function __construct(bool $convertDeprecationsToExceptions, bool $convertErrorsToExceptions, bool $convertNoticesToExceptions, bool $convertWarningsToExceptions)
    {
        $this->convertDeprecationsToExceptions = $convertDeprecationsToExceptions;
        $this->convertErrorsToExceptions       = $convertErrorsToExceptions;
        $this->convertNoticesToExceptions      = $convertNoticesToExceptions;
        $this->convertWarningsToExceptions     = $convertWarningsToExceptions;
    }

    public function __invoke(int $errorNumber, string $errorString, string $errorFile, int $errorLine): bool
    {
        /*
         * Do not raise an exception when the error suppression operator (@) was used.
         *
         * @see https://github.com/sebastianbergmann/phpunit/issues/3739
         */
        if (!($errorNumber & error_reporting())) {
            return false;
        }

        switch ($errorNumber) {
            case E_NOTICE:
            case E_USER_NOTICE:
            case E_STRICT:
                if (!$this->convertNoticesToExceptions) {
                    return false;
                }

                throw new Notice($errorString, $errorNumber, $errorFile, $errorLine);

            case E_WARNING:
            case E_USER_WARNING:
                if (!$this->convertWarningsToExceptions) {
                    return false;
                }

                throw new Warning($errorString, $errorNumber, $errorFile, $errorLine);

            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                if (!$this->convertDeprecationsToExceptions) {
                    return false;
                }

                throw new Deprecated($errorString, $errorNumber, $errorFile, $errorLine);

            default:
                if (!$this->convertErrorsToExceptions) {
                    return false;
                }

                throw new Error($errorString, $errorNumber, $errorFile, $errorLine);
        }
    }

    public function register(): void
    {
        if ($this->registered) {
            return;
        }

        $oldErrorHandler = set_error_handler($this);

        if ($oldErrorHandler !== null) {
            restore_error_handler();

            return;
        }

        $this->registered = true;
    }

    public function unregister(): void
    {
        if (!$this->registered) {
            return;
        }

        restore_error_handler();
>>>>>>> update
    }
}
