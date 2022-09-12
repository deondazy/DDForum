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

namespace SebastianBergmann\CodeCoverage\Report;

use SebastianBergmann\CodeCoverage\CodeCoverage;

/**
 * Uses var_export() to write a SebastianBergmann\CodeCoverage\CodeCoverage object to a file.
 */
class PHP
{
    /**
     * @param CodeCoverage $coverage
     * @param string       $target
     *
     * @return string
     */
    public function process(CodeCoverage $coverage, $target = null)
    {
        $filter = $coverage->filter();

        $output = sprintf(
            '<?php
$coverage = new SebastianBergmann\CodeCoverage\CodeCoverage;
$coverage->setData(%s);
$coverage->setTests(%s);

$filter = $coverage->filter();
$filter->setWhitelistedFiles(%s);

return $coverage;',
            var_export($coverage->getData(true), 1),
            var_export($coverage->getTests(), 1),
            var_export($filter->getWhitelistedFiles(), 1)
        );

        if ($target !== null) {
            return file_put_contents($target, $output);
        } else {
            return $output;
        }
=======
namespace SebastianBergmann\CodeCoverage\Report;

use function dirname;
use function file_put_contents;
use function serialize;
use function sprintf;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\WriteOperationFailedException;
use SebastianBergmann\CodeCoverage\Util\Filesystem;

final class PHP
{
    public function process(CodeCoverage $coverage, ?string $target = null): string
    {
        $buffer = sprintf(
            "<?php
return \unserialize(<<<'END_OF_COVERAGE_SERIALIZATION'%s%s%sEND_OF_COVERAGE_SERIALIZATION%s);",
            PHP_EOL,
            serialize($coverage),
            PHP_EOL,
            PHP_EOL
        );

        if ($target !== null) {
            Filesystem::createDirectory(dirname($target));

            if (@file_put_contents($target, $buffer) === false) {
                throw new WriteOperationFailedException($target);
            }
        }

        return $buffer;
>>>>>>> update
    }
}
