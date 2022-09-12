<<<<<<< HEAD
<?php
/*
 * This file is part of the Diff package.
=======
<?php declare(strict_types=1);
/*
 * This file is part of sebastian/diff.
>>>>>>> update
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
<<<<<<< HEAD

namespace SebastianBergmann\Diff;

/**
 */
class Line
{
    const ADDED     = 1;
    const REMOVED   = 2;
    const UNCHANGED = 3;
=======
namespace SebastianBergmann\Diff;

final class Line
{
    public const ADDED     = 1;

    public const REMOVED   = 2;

    public const UNCHANGED = 3;
>>>>>>> update

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $content;

<<<<<<< HEAD
    /**
     * @param int    $type
     * @param string $content
     */
    public function __construct($type = self::UNCHANGED, $content = '')
=======
    public function __construct(int $type = self::UNCHANGED, string $content = '')
>>>>>>> update
    {
        $this->type    = $type;
        $this->content = $content;
    }

<<<<<<< HEAD
    /**
     * @return string
     */
    public function getContent()
=======
    public function getContent(): string
>>>>>>> update
    {
        return $this->content;
    }

<<<<<<< HEAD
    /**
     * @return int
     */
    public function getType()
=======
    public function getType(): int
>>>>>>> update
    {
        return $this->type;
    }
}
