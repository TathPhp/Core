<?php
declare(strict_types=1);

namespace Tath\Core\Classes;

use Doctrine\Common\Annotations\AnnotationReader;

class AnnotationTool implements AnnotationToolInterface
{
    use AnnotationToolTrait, AnnotationToolProperties, AnnotationToolMethods;

    const PROPERTIES = 'properties';
    const PROPERTIES_BY_ANNOTATION = 'propertiesByAnnotation';
    const METHODS = 'methods';
    const METHODS_BY_ANNOTATION = 'methodsByAnnotation';
    const CLASS_ANNOTATIONS = 'class';

    private $reflectionClass;
    private $annotationReader;
    private $type;

    /**
     * @var static[]
     */
    private static $annotationTools = [];

    /**
     * AnnotationTool constructor.
     * @param $type
     */
    private function __construct($type)
    {
        $this->type = $type;
        $this->reflectionClass = new \ReflectionClass($type);
        $this->annotationReader = new AnnotationReader();
    }

    /**
     * @param $class
     * @return static
     */
    public static function make($class)
    {
        if (isset(self::$annotationTools[$class])) {
            return self::$annotationTools[$class];
        }
        $tool = new static($class);
        self::$annotationTools[$class] = $tool;
        return $tool;
    }

    protected function getReflectionClass(): \ReflectionClass
    {
        return $this->reflectionClass;
    }

    protected function getAnnotationReader(): AnnotationReader
    {
        return $this->annotationReader;
    }

    public function getClassAnnotations()
    {
        return $this->cache[self::CLASS_ANNOTATIONS] ?? $this->initializeClassCache()[self::CLASS_ANNOTATIONS];
    }

    private function initializeClassCache()
    {
        $this->cache[self::CLASS_ANNOTATIONS] = $this->getAnnotationReader()
            ->getClassAnnotations($this->getReflectionClass());
        return $this->cache;
    }

    public function getClassAnnotationsOfType($type)
    {
        return array_filter($this->getClassAnnotations(), function ($annotation) use ($type) {
            return $annotation instanceof $type;
        });
    }
}
