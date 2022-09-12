<<<<<<< HEAD
<?php
/*
 * This file is part of the Text_Template package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-text-template.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

/**
 * A simple template engine.
 *
 * @since Class available since Release 1.0.0
 */
class Text_Template
=======
namespace SebastianBergmann\Template;

use function array_merge;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function sprintf;
use function str_replace;

final class Template
>>>>>>> update
{
    /**
     * @var string
     */
<<<<<<< HEAD
    protected $template = '';
=======
    private $template = '';
>>>>>>> update

    /**
     * @var string
     */
<<<<<<< HEAD
    protected $openDelimiter = '{';
=======
    private $openDelimiter;
>>>>>>> update

    /**
     * @var string
     */
<<<<<<< HEAD
    protected $closeDelimiter = '}';
=======
    private $closeDelimiter;
>>>>>>> update

    /**
     * @var array
     */
<<<<<<< HEAD
    protected $values = array();

    /**
     * Constructor.
     *
     * @param  string                   $file
     * @throws InvalidArgumentException
     */
    public function __construct($file = '', $openDelimiter = '{', $closeDelimiter = '}')
    {
        $this->setFile($file);
=======
    private $values = [];

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(string $file = '', string $openDelimiter = '{', string $closeDelimiter = '}')
    {
        $this->setFile($file);

>>>>>>> update
        $this->openDelimiter  = $openDelimiter;
        $this->closeDelimiter = $closeDelimiter;
    }

    /**
<<<<<<< HEAD
     * Sets the template file.
     *
     * @param  string                   $file
     * @throws InvalidArgumentException
     */
    public function setFile($file)
=======
     * @throws InvalidArgumentException
     */
    public function setFile(string $file): void
>>>>>>> update
    {
        $distFile = $file . '.dist';

        if (file_exists($file)) {
            $this->template = file_get_contents($file);
<<<<<<< HEAD
        }

        else if (file_exists($distFile)) {
            $this->template = file_get_contents($distFile);
        }

        else {
            throw new InvalidArgumentException(
              'Template file could not be loaded.'
=======
        } elseif (file_exists($distFile)) {
            $this->template = file_get_contents($distFile);
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    'Failed to load template "%s"',
                    $file
                )
>>>>>>> update
            );
        }
    }

<<<<<<< HEAD
    /**
     * Sets one or more template variables.
     *
     * @param array $values
     * @param bool  $merge
     */
    public function setVar(array $values, $merge = TRUE)
=======
    public function setVar(array $values, bool $merge = true): void
>>>>>>> update
    {
        if (!$merge || empty($this->values)) {
            $this->values = $values;
        } else {
            $this->values = array_merge($this->values, $values);
        }
    }

<<<<<<< HEAD
    /**
     * Renders the template and returns the result.
     *
     * @return string
     */
    public function render()
    {
        $keys = array();
=======
    public function render(): string
    {
        $keys = [];
>>>>>>> update

        foreach ($this->values as $key => $value) {
            $keys[] = $this->openDelimiter . $key . $this->closeDelimiter;
        }

        return str_replace($keys, $this->values, $this->template);
    }

    /**
<<<<<<< HEAD
     * Renders the template and writes the result to a file.
     *
     * @param string $target
     */
    public function renderTo($target)
    {
        $fp = @fopen($target, 'wt');

        if ($fp) {
            fwrite($fp, $this->render());
            fclose($fp);
        } else {
            $error = error_get_last();

            throw new RuntimeException(
              sprintf(
                'Could not write to %s: %s',
                $target,
                substr(
                  $error['message'],
                  strpos($error['message'], ':') + 2
                )
              )
=======
     * @codeCoverageIgnore
     */
    public function renderTo(string $target): void
    {
        if (!file_put_contents($target, $this->render())) {
            throw new RuntimeException(
                sprintf(
                    'Writing rendered result to "%s" failed',
                    $target
                )
>>>>>>> update
            );
        }
    }
}
<<<<<<< HEAD

=======
>>>>>>> update
