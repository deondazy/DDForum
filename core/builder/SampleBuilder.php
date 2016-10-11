<?php

namespace DDForum\Core\Builder;

class SampleBuilder implements SampleBuilderInterface
{
  private $class;

  public function __construct($class)
  {
    $this->class = "new DDForum\Core\Builder\{$class}";
  }

  public function build(array $sample)
  {
    return $this->class->create($sample);
  }
}
