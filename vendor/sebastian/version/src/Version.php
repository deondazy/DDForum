<?php
/*
<<<<<<< HEAD
 * This file is part of the Version package.
=======
 * This file is part of sebastian/version.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann;

<<<<<<< HEAD
/**
 * @since Class available since Release 1.0.0
 */
class Version
=======
final class Version
>>>>>>> update
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $release;

    /**
     * @var string
     */
    private $version;

<<<<<<< HEAD
    /**
     * @param string $release
     * @param string $path
     */
    public function __construct($release, $path)
=======
    public function __construct(string $release, string $path)
>>>>>>> update
    {
        $this->release = $release;
        $this->path    = $path;
    }

<<<<<<< HEAD
    /**
     * @return string
     */
    public function getVersion()
    {
        if ($this->version === null) {
            if (count(explode('.', $this->release)) == 3) {
=======
    public function getVersion(): string
    {
        if ($this->version === null) {
            if (\substr_count($this->release, '.') + 1 === 3) {
>>>>>>> update
                $this->version = $this->release;
            } else {
                $this->version = $this->release . '-dev';
            }

            $git = $this->getGitInformation($this->path);

            if ($git) {
<<<<<<< HEAD
                if (count(explode('.', $this->release)) == 3) {
                    $this->version = $git;
                } else {
                    $git = explode('-', $git);

                    $this->version = $this->release . '-' . end($git);
=======
                if (\substr_count($this->release, '.') + 1 === 3) {
                    $this->version = $git;
                } else {
                    $git = \explode('-', $git);

                    $this->version = $this->release . '-' . \end($git);
>>>>>>> update
                }
            }
        }

        return $this->version;
    }

    /**
<<<<<<< HEAD
     * @param string $path
     *
     * @return bool|string
     */
    private function getGitInformation($path)
    {
        if (!is_dir($path . DIRECTORY_SEPARATOR . '.git')) {
            return false;
        }

        $process = proc_open(
=======
     * @return bool|string
     */
    private function getGitInformation(string $path)
    {
        if (!\is_dir($path . DIRECTORY_SEPARATOR . '.git')) {
            return false;
        }

        $process = \proc_open(
>>>>>>> update
            'git describe --tags',
            [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ],
            $pipes,
            $path
        );

<<<<<<< HEAD
        if (!is_resource($process)) {
            return false;
        }

        $result = trim(stream_get_contents($pipes[1]));

        fclose($pipes[1]);
        fclose($pipes[2]);

        $returnCode = proc_close($process);
=======
        if (!\is_resource($process)) {
            return false;
        }

        $result = \trim(\stream_get_contents($pipes[1]));

        \fclose($pipes[1]);
        \fclose($pipes[2]);

        $returnCode = \proc_close($process);
>>>>>>> update

        if ($returnCode !== 0) {
            return false;
        }

        return $result;
    }
}
