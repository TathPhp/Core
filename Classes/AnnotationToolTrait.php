<?php
declare(strict_types=1);

namespace Tath\Core\Classes;

use Doctrine\Common\Annotations\AnnotationReader;

trait AnnotationToolTrait
{
    private $cache = [];

    protected abstract function getReflectionClass(): \ReflectionClass;
    protected abstract function getAnnotationReader(): AnnotationReader;
}
