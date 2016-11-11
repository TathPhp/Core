<?php
declare(strict_types=1);

namespace Tath\Core\Classes;

trait AnnotationToolMethods
{
    use AnnotationToolTrait;

    private function cachedMethods()
    {
        return $this->cache[self::METHODS] ?? $this->initializeMethodCache()[self::METHODS];
    }

    private function cachedMethodsByAnnotation()
    {
        return $this->cache[self::METHODS_BY_ANNOTATION] ??
            $this->initializeMethodCache()[self::METHODS_BY_ANNOTATION];
    }

    private function initializeMethodCache()
    {
        $methods = $this->getReflectionClass()->getMethods();
        foreach ($methods as $method) {
            $this->loadMethod($method);
        }
        return $this->cache;
    }

    private function loadMethod(\ReflectionMethod $method)
    {
        $annotations = $this->getAnnotationReader()->getMethodAnnotations($method);
        $this->cache[self::METHODS][$method->name] = $annotations;
        foreach ($annotations as $annotation) {
            $this->cache[self::METHODS_BY_ANNOTATION][get_class($annotation)][$method->name][] = $annotation;
        }
    }

    public function getMethods()
    {
        return $this->cachedMethods();
    }

    public function getMethodAnnotations(string $name)
    {
        return $this->cachedMethods()[$name] ?? null;
    }

    public function getTypedMethods(string $type, string $name)
    {
        return $this->cachedMethodsByAnnotation()[$type][$name] ?? [];
    }

    public function getMethodsWith(string $type)
    {
        return $this->cachedMethodsByAnnotation()[$type] ?? [];
    }
}
