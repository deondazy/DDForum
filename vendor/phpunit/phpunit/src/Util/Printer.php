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
 * Utility class that can print to STDOUT or write to a file.
 *
 * @since Class available since Release 2.0.0
 */
class PHPUnit_Util_Printer
{
    /**
     * If true, flush output after every write.
     *
     * @var bool
     */
    protected $autoFlush = false;

    /**
     * @var resource
     */
    protected $out;

    /**
     * @var string
     */
    protected $outTarget;

    /**
     * Constructor.
     *
     * @param mixed $out
     *
     * @throws PHPUnit_Framework_Exception
     */
    public function __construct($out = null)
    {
        if ($out !== null) {
            if (is_string($out)) {
                if (strpos($out, 'socket://') === 0) {
                    $out = explode(':', str_replace('socket://', '', $out));

                    if (sizeof($out) != 2) {
                        throw new PHPUnit_Framework_Exception;
                    }

                    $this->out = fsockopen($out[0], $out[1]);
                } else {
                    if (strpos($out, 'php://') === false &&
                        !is_dir(dirname($out))) {
                        mkdir(dirname($out), 0777, true);
                    }

                    $this->out = fopen($out, 'wt');
                }

                $this->outTarget = $out;
            } else {
                $this->out = $out;
            }
        }
    }

    /**
     * Flush buffer and close output if it's not to a PHP stream
     */
    public function flush()
    {
        if ($this->out && strncmp($this->outTarget, 'php://', 6) !== 0) {
            fclose($this->out);
        }
    }

    /**
     * Performs a safe, incremental flush.
     *
     * Do not confuse this function with the flush() function of this class,
     * since the flush() function may close the file being written to, rendering
     * the current object no longer usable.
     *
     * @since Method available since Release 3.3.0
     */
    public function incrementalFlush()
    {
        if ($this->out) {
            fflush($this->out);
        } else {
            flush();
        }
    }

    /**
     * @param string $buffer
     */
    public function write($buffer)
    {
        if ($this->out) {
            fwrite($this->out, $buffer);

            if ($this->autoFlush) {
                $this->incrementalFlush();
            }
        } else {
            if (PHP_SAPI != 'cli' && PHP_SAPI != 'phpdbg') {
                $buffer = htmlspecialchars($buffer);
            }

            print $buffer;

            if ($this->autoFlush) {
                $this->incrementalFlush();
            }
        }
    }

    /**
     * Check auto-flush mode.
     *
     * @return bool
     *
     * @since Method available since Release 3.3.0
     */
    public function getAutoFlush()
    {
        return $this->autoFlush;
    }

    /**
     * Set auto-flushing mode.
     *
     * If set, *incremental* flushes will be done after each write. This should
     * not be confused with the different effects of this class' flush() method.
     *
     * @param bool $autoFlush
     *
     * @since Method available since Release 3.3.0
     */
    public function setAutoFlush($autoFlush)
    {
        if (is_bool($autoFlush)) {
            $this->autoFlush = $autoFlush;
        } else {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
=======
namespace PHPUnit\Util;

use const ENT_COMPAT;
use const ENT_SUBSTITUTE;
use const PHP_SAPI;
use function assert;
use function count;
use function dirname;
use function explode;
use function fclose;
use function fopen;
use function fsockopen;
use function fwrite;
use function htmlspecialchars;
use function is_resource;
use function is_string;
use function sprintf;
use function str_replace;
use function strncmp;
use function strpos;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
class Printer
{
    /**
     * @psalm-var closed-resource|resource
     */
    private $stream;

    /**
     * @var bool
     */
    private $isPhpStream;

    /**
     * @param null|resource|string $out
     *
     * @throws Exception
     */
    public function __construct($out = null)
    {
        if (is_resource($out)) {
            $this->stream = $out;

            return;
        }

        if (!is_string($out)) {
            return;
        }

        if (strpos($out, 'socket://') === 0) {
            $tmp = explode(':', str_replace('socket://', '', $out));

            if (count($tmp) !== 2) {
                throw new Exception(
                    sprintf(
                        '"%s" does not match "socket://hostname:port" format',
                        $out
                    )
                );
            }

            $this->stream = fsockopen($tmp[0], (int) $tmp[1]);

            return;
        }

        if (strpos($out, 'php://') === false && !Filesystem::createDirectory(dirname($out))) {
            throw new Exception(
                sprintf(
                    'Directory "%s" was not created',
                    dirname($out)
                )
            );
        }

        $this->stream      = fopen($out, 'wb');
        $this->isPhpStream = strncmp($out, 'php://', 6) !== 0;
    }

    public function write(string $buffer): void
    {
        if ($this->stream) {
            assert(is_resource($this->stream));

            fwrite($this->stream, $buffer);
        } else {
            if (PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg') {
                $buffer = htmlspecialchars($buffer, ENT_COMPAT | ENT_SUBSTITUTE);
            }

            print $buffer;
        }
    }

    public function flush(): void
    {
        if ($this->stream && $this->isPhpStream) {
            assert(is_resource($this->stream));

            fclose($this->stream);
>>>>>>> update
        }
    }
}
