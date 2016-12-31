<?php
declare(strict_types=1);

namespace Tath\Core\Classes;

trait AnnotationToolProperties
{
    use AnnotationToolTrait;

    private function cachedProperties()
    {
        return $this->cache[self::PROPERTIES] ?? $this->initializePropertyCache()[self::PROPERTIES];
    }

    private function cachedPropertiesByAnnotation()
    {
        return $this->cache[self::PROPERTIES_BY_ANNOTATION] ??
            $this->initializePropertyCache()[self::PROPERTIES_BY_ANNOTATION];
    }

    private function initializePropertyCache()
    {
        $properties = $this->getReflectionClass()->getProperties();
        foreach ($properties as $property) {
            $this->loadProperty($property);
        }
        //If there are no annotations then this won't get created, so make an empty one here.
        if (!isset($this->cache[self::PROPERTIES_BY_ANNOTATION])) {
            $this->cache[self::PROPERTIES_BY_ANNOTATION] = [];
        }
        return $this->cache;
    }

    private function loadProperty(\ReflectionProperty $property)
    {
        $annotations = $this->getAnnotationReader()->getPropertyAnnotations($property);
        $this->cache[self::PROPERTIES][$property->name] = $annotations;
        foreach ($annotations as $annotation) {
            $this->cache[self::PROPERTIES_BY_ANNOTATION][get_class($annotation)][$property->name][] = $annotation;
        }
    }

    public function getProperties()
    {
        return $this->cachedProperties();
    }

    public function getPropertyAnnotations(string $name)
    {
        return $this->cachedProperties()[$name] ?? null;
    }

    public function getTypedProperties(string $type, string $name)
    {
        return $this->cachedPropertiesByAnnotation()[$type][$name] ?? [];
    }

    public function getPropertiesWith(string $type)
    {
        return $this->cachedPropertiesByAnnotation()[$type] ?? [];
    }
}
