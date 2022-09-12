<<<<<<< HEAD
<?php
/*
 * This file is part of the Environment package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of sebastian/environment.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

namespace SebastianBergmann\Environment;

/**
 */
class Console
{
    const STDIN  = 0;
    const STDOUT = 1;
    const STDERR = 2;
=======
namespace SebastianBergmann\Environment;

use const DIRECTORY_SEPARATOR;
use const STDIN;
use const STDOUT;
use function defined;
use function fclose;
use function fstat;
use function function_exists;
use function getenv;
use function is_resource;
use function is_string;
use function posix_isatty;
use function preg_match;
use function proc_close;
use function proc_open;
use function sapi_windows_vt100_support;
use function shell_exec;
use function stream_get_contents;
use function stream_isatty;
use function trim;

final class Console
{
    /**
     * @var int
     */
    public const STDIN = 0;

    /**
     * @var int
     */
    public const STDOUT = 1;

    /**
     * @var int
     */
    public const STDERR = 2;
>>>>>>> update

    /**
     * Returns true if STDOUT supports colorization.
     *
     * This code has been copied and adapted from
<<<<<<< HEAD
     * Symfony\Component\Console\Output\OutputStream.
     *
     * @return bool
     */
    public function hasColorSupport()
    {
        if (DIRECTORY_SEPARATOR == '\\') {
            return false !== getenv('ANSICON') || 'ON' === getenv('ConEmuANSI') || 'xterm' === getenv('TERM');
        }

        if (!defined('STDOUT')) {
            return false;
=======
     * Symfony\Component\Console\Output\StreamOutput.
     */
    public function hasColorSupport(): bool
    {
        if ('Hyper' === getenv('TERM_PROGRAM')) {
            return true;
        }

        if ($this->isWindows()) {
            // @codeCoverageIgnoreStart
            return (defined('STDOUT') && function_exists('sapi_windows_vt100_support') && @sapi_windows_vt100_support(STDOUT)) ||
                false !== getenv('ANSICON') ||
                'ON' === getenv('ConEmuANSI') ||
                'xterm' === getenv('TERM');
            // @codeCoverageIgnoreEnd
        }

        if (!defined('STDOUT')) {
            // @codeCoverageIgnoreStart
            return false;
            // @codeCoverageIgnoreEnd
>>>>>>> update
        }

        return $this->isInteractive(STDOUT);
    }

    /**
     * Returns the number of columns of the terminal.
     *
<<<<<<< HEAD
     * @return int
     */
    public function getNumberOfColumns()
    {
        if (DIRECTORY_SEPARATOR == '\\') {
            $columns = 80;

            if (preg_match('/^(\d+)x\d+ \(\d+x(\d+)\)$/', trim(getenv('ANSICON')), $matches)) {
                $columns = $matches[1];
            } elseif (function_exists('proc_open')) {
                $process = proc_open(
                    'mode CON',
                    array(
                        1 => array('pipe', 'w'),
                        2 => array('pipe', 'w')
                    ),
                    $pipes,
                    null,
                    null,
                    array('suppress_errors' => true)
                );

                if (is_resource($process)) {
                    $info = stream_get_contents($pipes[1]);

                    fclose($pipes[1]);
                    fclose($pipes[2]);
                    proc_close($process);

                    if (preg_match('/--------+\r?\n.+?(\d+)\r?\n.+?(\d+)\r?\n/', $info, $matches)) {
                        $columns = $matches[2];
                    }
                }
            }

            return $columns - 1;
        }

        if (!$this->isInteractive(self::STDIN)) {
            return 80;
        }

        if (function_exists('shell_exec') && preg_match('#\d+ (\d+)#', shell_exec('stty size'), $match) === 1) {
=======
     * @codeCoverageIgnore
     */
    public function getNumberOfColumns(): int
    {
        if (!$this->isInteractive(defined('STDIN') ? STDIN : self::STDIN)) {
            return 80;
        }

        if ($this->isWindows()) {
            return $this->getNumberOfColumnsWindows();
        }

        return $this->getNumberOfColumnsInteractive();
    }

    /**
     * Returns if the file descriptor is an interactive terminal or not.
     *
     * Normally, we want to use a resource as a parameter, yet sadly it's not always awailable,
     * eg when running code in interactive console (`php -a`), STDIN/STDOUT/STDERR constants are not defined.
     *
     * @param int|resource $fileDescriptor
     */
    public function isInteractive($fileDescriptor = self::STDOUT): bool
    {
        if (is_resource($fileDescriptor)) {
            // These functions require a descriptor that is a real resource, not a numeric ID of it
            if (function_exists('stream_isatty') && @stream_isatty($fileDescriptor)) {
                return true;
            }

            // Check if formatted mode is S_IFCHR
            if (function_exists('fstat') && @stream_isatty($fileDescriptor)) {
                $stat = @fstat(STDOUT);

                return $stat ? 0020000 === ($stat['mode'] & 0170000) : false;
            }

            return false;
        }

        return function_exists('posix_isatty') && @posix_isatty($fileDescriptor);
    }

    private function isWindows(): bool
    {
        return DIRECTORY_SEPARATOR === '\\';
    }

    /**
     * @codeCoverageIgnore
     */
    private function getNumberOfColumnsInteractive(): int
    {
        if (function_exists('shell_exec') && preg_match('#\d+ (\d+)#', shell_exec('stty size') ?: '', $match) === 1) {
>>>>>>> update
            if ((int) $match[1] > 0) {
                return (int) $match[1];
            }
        }

<<<<<<< HEAD
        if (function_exists('shell_exec') && preg_match('#columns = (\d+);#', shell_exec('stty'), $match) === 1) {
=======
        if (function_exists('shell_exec') && preg_match('#columns = (\d+);#', shell_exec('stty') ?: '', $match) === 1) {
>>>>>>> update
            if ((int) $match[1] > 0) {
                return (int) $match[1];
            }
        }

        return 80;
    }

    /**
<<<<<<< HEAD
     * Returns if the file descriptor is an interactive terminal or not.
     *
     * @param int|resource $fileDescriptor
     *
     * @return bool
     */
    public function isInteractive($fileDescriptor = self::STDOUT)
    {
        return function_exists('posix_isatty') && @posix_isatty($fileDescriptor);
=======
     * @codeCoverageIgnore
     */
    private function getNumberOfColumnsWindows(): int
    {
        $ansicon = getenv('ANSICON');
        $columns = 80;

        if (is_string($ansicon) && preg_match('/^(\d+)x\d+ \(\d+x(\d+)\)$/', trim($ansicon), $matches)) {
            $columns = (int) $matches[1];
        } elseif (function_exists('proc_open')) {
            $process = proc_open(
                'mode CON',
                [
                    1 => ['pipe', 'w'],
                    2 => ['pipe', 'w'],
                ],
                $pipes,
                null,
                null,
                ['suppress_errors' => true]
            );

            if (is_resource($process)) {
                $info = stream_get_contents($pipes[1]);

                fclose($pipes[1]);
                fclose($pipes[2]);
                proc_close($process);

                if (preg_match('/--------+\r?\n.+?(\d+)\r?\n.+?(\d+)\r?\n/', $info, $matches)) {
                    $columns = (int) $matches[2];
                }
            }
        }

        return $columns - 1;
>>>>>>> update
    }
}
