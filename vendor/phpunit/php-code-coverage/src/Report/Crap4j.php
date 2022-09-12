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
use SebastianBergmann\CodeCoverage\Node\File;
use SebastianBergmann\CodeCoverage\InvalidArgumentException;

class Crap4j
=======
namespace SebastianBergmann\CodeCoverage\Report;

use function date;
use function dirname;
use function file_put_contents;
use function htmlspecialchars;
use function is_string;
use function round;
use DOMDocument;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\WriteOperationFailedException;
use SebastianBergmann\CodeCoverage\Node\File;
use SebastianBergmann\CodeCoverage\Util\Filesystem;

final class Crap4j
>>>>>>> update
{
    /**
     * @var int
     */
    private $threshold;

<<<<<<< HEAD
    /**
     * @param int $threshold
     */
    public function __construct($threshold = 30)
    {
        if (!is_int($threshold)) {
            throw InvalidArgumentException::create(
                1,
                'integer'
            );
        }

=======
    public function __construct(int $threshold = 30)
    {
>>>>>>> update
        $this->threshold = $threshold;
    }

    /**
<<<<<<< HEAD
     * @param CodeCoverage $coverage
     * @param string       $target
     * @param string       $name
     *
     * @return string
     */
    public function process(CodeCoverage $coverage, $target = null, $name = null)
    {
        $document               = new \DOMDocument('1.0', 'UTF-8');
=======
     * @throws WriteOperationFailedException
     */
    public function process(CodeCoverage $coverage, ?string $target = null, ?string $name = null): string
    {
        $document               = new DOMDocument('1.0', 'UTF-8');
>>>>>>> update
        $document->formatOutput = true;

        $root = $document->createElement('crap_result');
        $document->appendChild($root);

        $project = $document->createElement('project', is_string($name) ? $name : '');
        $root->appendChild($project);
<<<<<<< HEAD
        $root->appendChild($document->createElement('timestamp', date('Y-m-d H:i:s', (int) $_SERVER['REQUEST_TIME'])));
=======
        $root->appendChild($document->createElement('timestamp', date('Y-m-d H:i:s')));
>>>>>>> update

        $stats       = $document->createElement('stats');
        $methodsNode = $document->createElement('methods');

        $report = $coverage->getReport();
        unset($coverage);

        $fullMethodCount     = 0;
        $fullCrapMethodCount = 0;
        $fullCrapLoad        = 0;
        $fullCrap            = 0;

        foreach ($report as $item) {
            $namespace = 'global';

            if (!$item instanceof File) {
                continue;
            }

            $file = $document->createElement('file');
<<<<<<< HEAD
            $file->setAttribute('name', $item->getPath());

            $classes = $item->getClassesAndTraits();

            foreach ($classes as $className => $class) {
                foreach ($class['methods'] as $methodName => $method) {
                    $crapLoad = $this->getCrapLoad($method['crap'], $method['ccn'], $method['coverage']);

                    $fullCrap     += $method['crap'];
=======
            $file->setAttribute('name', $item->pathAsString());

            $classes = $item->classesAndTraits();

            foreach ($classes as $className => $class) {
                foreach ($class['methods'] as $methodName => $method) {
                    $crapLoad = $this->crapLoad((float) $method['crap'], $method['ccn'], $method['coverage']);

                    $fullCrap += $method['crap'];
>>>>>>> update
                    $fullCrapLoad += $crapLoad;
                    $fullMethodCount++;

                    if ($method['crap'] >= $this->threshold) {
                        $fullCrapMethodCount++;
                    }

                    $methodNode = $document->createElement('method');

<<<<<<< HEAD
                    if (!empty($class['package']['namespace'])) {
                        $namespace = $class['package']['namespace'];
=======
                    if (!empty($class['namespace'])) {
                        $namespace = $class['namespace'];
>>>>>>> update
                    }

                    $methodNode->appendChild($document->createElement('package', $namespace));
                    $methodNode->appendChild($document->createElement('className', $className));
                    $methodNode->appendChild($document->createElement('methodName', $methodName));
                    $methodNode->appendChild($document->createElement('methodSignature', htmlspecialchars($method['signature'])));
                    $methodNode->appendChild($document->createElement('fullMethod', htmlspecialchars($method['signature'])));
<<<<<<< HEAD
                    $methodNode->appendChild($document->createElement('crap', $this->roundValue($method['crap'])));
                    $methodNode->appendChild($document->createElement('complexity', $method['ccn']));
                    $methodNode->appendChild($document->createElement('coverage', $this->roundValue($method['coverage'])));
                    $methodNode->appendChild($document->createElement('crapLoad', round($crapLoad)));
=======
                    $methodNode->appendChild($document->createElement('crap', (string) $this->roundValue((float) $method['crap'])));
                    $methodNode->appendChild($document->createElement('complexity', (string) $method['ccn']));
                    $methodNode->appendChild($document->createElement('coverage', (string) $this->roundValue($method['coverage'])));
                    $methodNode->appendChild($document->createElement('crapLoad', (string) round($crapLoad)));
>>>>>>> update

                    $methodsNode->appendChild($methodNode);
                }
            }
        }

        $stats->appendChild($document->createElement('name', 'Method Crap Stats'));
<<<<<<< HEAD
        $stats->appendChild($document->createElement('methodCount', $fullMethodCount));
        $stats->appendChild($document->createElement('crapMethodCount', $fullCrapMethodCount));
        $stats->appendChild($document->createElement('crapLoad', round($fullCrapLoad)));
        $stats->appendChild($document->createElement('totalCrap', $fullCrap));

        if ($fullMethodCount > 0) {
            $crapMethodPercent = $this->roundValue((100 * $fullCrapMethodCount) / $fullMethodCount);
        } else {
            $crapMethodPercent = 0;
        }

        $stats->appendChild($document->createElement('crapMethodPercent', $crapMethodPercent));
=======
        $stats->appendChild($document->createElement('methodCount', (string) $fullMethodCount));
        $stats->appendChild($document->createElement('crapMethodCount', (string) $fullCrapMethodCount));
        $stats->appendChild($document->createElement('crapLoad', (string) round($fullCrapLoad)));
        $stats->appendChild($document->createElement('totalCrap', (string) $fullCrap));

        $crapMethodPercent = 0;

        if ($fullMethodCount > 0) {
            $crapMethodPercent = $this->roundValue((100 * $fullCrapMethodCount) / $fullMethodCount);
        }

        $stats->appendChild($document->createElement('crapMethodPercent', (string) $crapMethodPercent));
>>>>>>> update

        $root->appendChild($stats);
        $root->appendChild($methodsNode);

        $buffer = $document->saveXML();

        if ($target !== null) {
<<<<<<< HEAD
            if (!is_dir(dirname($target))) {
                mkdir(dirname($target), 0777, true);
            }

            file_put_contents($target, $buffer);
=======
            Filesystem::createDirectory(dirname($target));

            if (@file_put_contents($target, $buffer) === false) {
                throw new WriteOperationFailedException($target);
            }
>>>>>>> update
        }

        return $buffer;
    }

<<<<<<< HEAD
    /**
     * @param float $crapValue
     * @param int   $cyclomaticComplexity
     * @param float $coveragePercent
     *
     * @return float
     */
    private function getCrapLoad($crapValue, $cyclomaticComplexity, $coveragePercent)
=======
    private function crapLoad(float $crapValue, int $cyclomaticComplexity, float $coveragePercent): float
>>>>>>> update
    {
        $crapLoad = 0;

        if ($crapValue >= $this->threshold) {
            $crapLoad += $cyclomaticComplexity * (1.0 - $coveragePercent / 100);
            $crapLoad += $cyclomaticComplexity / $this->threshold;
        }

        return $crapLoad;
    }

<<<<<<< HEAD
    /**
     * @param float $value
     *
     * @return float
     */
    private function roundValue($value)
=======
    private function roundValue(float $value): float
>>>>>>> update
    {
        return round($value, 2);
    }
}
