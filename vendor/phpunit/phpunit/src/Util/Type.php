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
 * Utility class for textual type (and value) representation.
 *
 * @since Class available since Release 3.0.0
 */
class PHPUnit_Util_Type
{
    public static function isType($type)
    {
        return in_array(
            $type,
            [
                'numeric',
                'integer',
                'int',
                'float',
                'string',
                'boolean',
                'bool',
                'null',
                'array',
                'object',
                'resource',
                'scalar'
            ]
        );
=======
namespace PHPUnit\Util;

use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class Type
{
    public static function isType(string $type): bool
    {
        switch ($type) {
            case 'numeric':
            case 'integer':
            case 'int':
            case 'iterable':
            case 'float':
            case 'string':
            case 'boolean':
            case 'bool':
            case 'null':
            case 'array':
            case 'object':
            case 'resource':
            case 'scalar':
                return true;

            default:
                return false;
        }
    }

    public static function isCloneable(object $object): bool
    {
        try {
            $clone = clone $object;
        } catch (Throwable $t) {
            return false;
        }

        return $clone instanceof $object;
>>>>>>> update
    }
}
