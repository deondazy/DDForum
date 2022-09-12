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

namespace SebastianBergmann\CodeCoverage\Report\Xml;

use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Node\AbstractNode;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;
use SebastianBergmann\CodeCoverage\Node\File as FileNode;
use SebastianBergmann\CodeCoverage\RuntimeException;

class Facade
=======
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use const DIRECTORY_SEPARATOR;
use const PHP_EOL;
use function count;
use function dirname;
use function file_get_contents;
use function file_put_contents;
use function is_array;
use function is_dir;
use function is_file;
use function is_writable;
use function libxml_clear_errors;
use function libxml_get_errors;
use function libxml_use_internal_errors;
use function sprintf;
use function strlen;
use function substr;
use DateTimeImmutable;
use DOMDocument;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\PathExistsButIsNotDirectoryException;
use SebastianBergmann\CodeCoverage\Driver\WriteOperationFailedException;
use SebastianBergmann\CodeCoverage\Node\AbstractNode;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;
use SebastianBergmann\CodeCoverage\Node\File as FileNode;
use SebastianBergmann\CodeCoverage\Util\Filesystem as DirectoryUtil;
use SebastianBergmann\CodeCoverage\Version;
use SebastianBergmann\CodeCoverage\XmlException;
use SebastianBergmann\Environment\Runtime;

final class Facade
>>>>>>> update
{
    /**
     * @var string
     */
    private $target;

    /**
     * @var Project
     */
    private $project;

    /**
<<<<<<< HEAD
     * @param CodeCoverage $coverage
     * @param string       $target
     *
     * @throws RuntimeException
     */
    public function process(CodeCoverage $coverage, $target)
    {
        if (substr($target, -1, 1) != DIRECTORY_SEPARATOR) {
=======
     * @var string
     */
    private $phpUnitVersion;

    public function __construct(string $version)
    {
        $this->phpUnitVersion = $version;
    }

    /**
     * @throws XmlException
     */
    public function process(CodeCoverage $coverage, string $target): void
    {
        if (substr($target, -1, 1) !== DIRECTORY_SEPARATOR) {
>>>>>>> update
            $target .= DIRECTORY_SEPARATOR;
        }

        $this->target = $target;
        $this->initTargetDirectory($target);

        $report = $coverage->getReport();

        $this->project = new Project(
<<<<<<< HEAD
            $coverage->getReport()->getName()
        );

        $this->processTests($coverage->getTests());
        $this->processDirectory($report, $this->project);

        $index                     = $this->project->asDom();
        $index->formatOutput       = true;
        $index->preserveWhiteSpace = false;
        $index->save($target . '/index.xml');
    }

    /**
     * @param string $directory
     */
    private function initTargetDirectory($directory)
    {
        if (file_exists($directory)) {
            if (!is_dir($directory)) {
                throw new RuntimeException(
                    "'$directory' exists but is not a directory."
                );
            }

            if (!is_writable($directory)) {
                throw new RuntimeException(
                    "'$directory' exists but is not writable."
                );
            }
        } elseif (!@mkdir($directory, 0777, true)) {
            throw new RuntimeException(
                "'$directory' could not be created."
            );
        }
    }

    private function processDirectory(DirectoryNode $directory, Node $context)
    {
        $dirObject = $context->addDirectory($directory->getName());

        $this->setTotals($directory, $dirObject->getTotals());

        foreach ($directory as $node) {
            if ($node instanceof DirectoryNode) {
                $this->processDirectory($node, $dirObject);
                continue;
            }

            if ($node instanceof FileNode) {
                $this->processFile($node, $dirObject);
                continue;
            }

            throw new RuntimeException(
                'Unknown node type for XML report'
            );
        }
    }

    private function processFile(FileNode $file, Directory $context)
    {
        $fileObject = $context->addFile(
            $file->getName(),
            $file->getId() . '.xml'
        );

        $this->setTotals($file, $fileObject->getTotals());

        $fileReport = new Report($file->getName());

        $this->setTotals($file, $fileReport->getTotals());

        foreach ($file->getClassesAndTraits() as $unit) {
            $this->processUnit($unit, $fileReport);
        }

        foreach ($file->getFunctions() as $function) {
            $this->processFunction($function, $fileReport);
        }

        foreach ($file->getCoverageData() as $line => $tests) {
            if (!is_array($tests) || count($tests) == 0) {
                continue;
            }

            $coverage = $fileReport->getLineCoverage($line);
=======
            $coverage->getReport()->name()
        );

        $this->setBuildInformation();
        $this->processTests($coverage->getTests());
        $this->processDirectory($report, $this->project);

        $this->saveDocument($this->project->asDom(), 'index');
    }

    private function setBuildInformation(): void
    {
        $buildNode = $this->project->buildInformation();
        $buildNode->setRuntimeInformation(new Runtime);
        $buildNode->setBuildTime(new DateTimeImmutable);
        $buildNode->setGeneratorVersions($this->phpUnitVersion, Version::id());
    }

    /**
     * @throws PathExistsButIsNotDirectoryException
     * @throws WriteOperationFailedException
     */
    private function initTargetDirectory(string $directory): void
    {
        if (is_file($directory)) {
            if (!is_dir($directory)) {
                throw new PathExistsButIsNotDirectoryException($directory);
            }

            if (!is_writable($directory)) {
                throw new WriteOperationFailedException($directory);
            }
        }

        DirectoryUtil::createDirectory($directory);
    }

    /**
     * @throws XmlException
     */
    private function processDirectory(DirectoryNode $directory, Node $context): void
    {
        $directoryName = $directory->name();

        if ($this->project->projectSourceDirectory() === $directoryName) {
            $directoryName = '/';
        }

        $directoryObject = $context->addDirectory($directoryName);

        $this->setTotals($directory, $directoryObject->totals());

        foreach ($directory->directories() as $node) {
            $this->processDirectory($node, $directoryObject);
        }

        foreach ($directory->files() as $node) {
            $this->processFile($node, $directoryObject);
        }
    }

    /**
     * @throws XmlException
     */
    private function processFile(FileNode $file, Directory $context): void
    {
        $fileObject = $context->addFile(
            $file->name(),
            $file->id() . '.xml'
        );

        $this->setTotals($file, $fileObject->totals());

        $path = substr(
            $file->pathAsString(),
            strlen($this->project->projectSourceDirectory())
        );

        $fileReport = new Report($path);

        $this->setTotals($file, $fileReport->totals());

        foreach ($file->classesAndTraits() as $unit) {
            $this->processUnit($unit, $fileReport);
        }

        foreach ($file->functions() as $function) {
            $this->processFunction($function, $fileReport);
        }

        foreach ($file->lineCoverageData() as $line => $tests) {
            if (!is_array($tests) || count($tests) === 0) {
                continue;
            }

            $coverage = $fileReport->lineCoverage((string) $line);
>>>>>>> update

            foreach ($tests as $test) {
                $coverage->addTest($test);
            }

            $coverage->finalize();
        }

<<<<<<< HEAD
        $this->initTargetDirectory(
            $this->target . dirname($file->getId()) . '/'
        );

        $fileDom                     = $fileReport->asDom();
        $fileDom->formatOutput       = true;
        $fileDom->preserveWhiteSpace = false;
        $fileDom->save($this->target . $file->getId() . '.xml');
    }

    private function processUnit($unit, Report $report)
    {
        if (isset($unit['className'])) {
            $unitObject = $report->getClassObject($unit['className']);
        } else {
            $unitObject = $report->getTraitObject($unit['traitName']);
=======
        $fileReport->source()->setSourceCode(
            file_get_contents($file->pathAsString())
        );

        $this->saveDocument($fileReport->asDom(), $file->id());
    }

    private function processUnit(array $unit, Report $report): void
    {
        if (isset($unit['className'])) {
            $unitObject = $report->classObject($unit['className']);
        } else {
            $unitObject = $report->traitObject($unit['traitName']);
>>>>>>> update
        }

        $unitObject->setLines(
            $unit['startLine'],
            $unit['executableLines'],
            $unit['executedLines']
        );

<<<<<<< HEAD
        $unitObject->setCrap($unit['crap']);

        $unitObject->setPackage(
            $unit['package']['fullPackage'],
            $unit['package']['package'],
            $unit['package']['subpackage'],
            $unit['package']['category']
        );

        $unitObject->setNamespace($unit['package']['namespace']);
=======
        $unitObject->setCrap((float) $unit['crap']);
        $unitObject->setNamespace($unit['namespace']);
>>>>>>> update

        foreach ($unit['methods'] as $method) {
            $methodObject = $unitObject->addMethod($method['methodName']);
            $methodObject->setSignature($method['signature']);
<<<<<<< HEAD
            $methodObject->setLines($method['startLine'], $method['endLine']);
            $methodObject->setCrap($method['crap']);
            $methodObject->setTotals(
                $method['executableLines'],
                $method['executedLines'],
                $method['coverage']
=======
            $methodObject->setLines((string) $method['startLine'], (string) $method['endLine']);
            $methodObject->setCrap($method['crap']);
            $methodObject->setTotals(
                (string) $method['executableLines'],
                (string) $method['executedLines'],
                (string) $method['coverage']
>>>>>>> update
            );
        }
    }

<<<<<<< HEAD
    private function processFunction($function, Report $report)
    {
        $functionObject = $report->getFunctionObject($function['functionName']);

        $functionObject->setSignature($function['signature']);
        $functionObject->setLines($function['startLine']);
        $functionObject->setCrap($function['crap']);
        $functionObject->setTotals($function['executableLines'], $function['executedLines'], $function['coverage']);
    }

    private function processTests(array $tests)
    {
        $testsObject = $this->project->getTests();

        foreach ($tests as $test => $result) {
            if ($test == 'UNCOVERED_FILES_FROM_WHITELIST') {
                continue;
            }

=======
    private function processFunction(array $function, Report $report): void
    {
        $functionObject = $report->functionObject($function['functionName']);

        $functionObject->setSignature($function['signature']);
        $functionObject->setLines((string) $function['startLine']);
        $functionObject->setCrap($function['crap']);
        $functionObject->setTotals((string) $function['executableLines'], (string) $function['executedLines'], (string) $function['coverage']);
    }

    private function processTests(array $tests): void
    {
        $testsObject = $this->project->tests();

        foreach ($tests as $test => $result) {
>>>>>>> update
            $testsObject->addTest($test, $result);
        }
    }

<<<<<<< HEAD
    private function setTotals(AbstractNode $node, Totals $totals)
    {
        $loc = $node->getLinesOfCode();

        $totals->setNumLines(
            $loc['loc'],
            $loc['cloc'],
            $loc['ncloc'],
            $node->getNumExecutableLines(),
            $node->getNumExecutedLines()
        );

        $totals->setNumClasses(
            $node->getNumClasses(),
            $node->getNumTestedClasses()
        );

        $totals->setNumTraits(
            $node->getNumTraits(),
            $node->getNumTestedTraits()
        );

        $totals->setNumMethods(
            $node->getNumMethods(),
            $node->getNumTestedMethods()
        );

        $totals->setNumFunctions(
            $node->getNumFunctions(),
            $node->getNumTestedFunctions()
        );
    }
=======
    private function setTotals(AbstractNode $node, Totals $totals): void
    {
        $loc = $node->linesOfCode();

        $totals->setNumLines(
            $loc['linesOfCode'],
            $loc['commentLinesOfCode'],
            $loc['nonCommentLinesOfCode'],
            $node->numberOfExecutableLines(),
            $node->numberOfExecutedLines()
        );

        $totals->setNumClasses(
            $node->numberOfClasses(),
            $node->numberOfTestedClasses()
        );

        $totals->setNumTraits(
            $node->numberOfTraits(),
            $node->numberOfTestedTraits()
        );

        $totals->setNumMethods(
            $node->numberOfMethods(),
            $node->numberOfTestedMethods()
        );

        $totals->setNumFunctions(
            $node->numberOfFunctions(),
            $node->numberOfTestedFunctions()
        );
    }

    private function targetDirectory(): string
    {
        return $this->target;
    }

    /**
     * @throws XmlException
     */
    private function saveDocument(DOMDocument $document, string $name): void
    {
        $filename = sprintf('%s/%s.xml', $this->targetDirectory(), $name);

        $document->formatOutput       = true;
        $document->preserveWhiteSpace = false;
        $this->initTargetDirectory(dirname($filename));

        file_put_contents($filename, $this->documentAsString($document));
    }

    /**
     * @throws XmlException
     *
     * @see https://bugs.php.net/bug.php?id=79191
     */
    private function documentAsString(DOMDocument $document): string
    {
        $xmlErrorHandling = libxml_use_internal_errors(true);
        $xml              = $document->saveXML();

        if ($xml === false) {
            $message = 'Unable to generate the XML';

            foreach (libxml_get_errors() as $error) {
                $message .= PHP_EOL . $error->message;
            }

            throw new XmlException($message);
        }

        libxml_clear_errors();
        libxml_use_internal_errors($xmlErrorHandling);

        return $xml;
    }
>>>>>>> update
}
