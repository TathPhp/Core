<?php
namespace Tath\Core\Classes;

interface AnnotationToolInterface
{
    public function getClassAnnotations();

    public function getClassAnnotationsOfType($type);

    public function getMethods();

    public function getMethodAnnotations(string $name);

    public function getTypedMethods(string $type, string $name);

    public function getMethodsWith(string $type);

    public function getProperties();

    public function getPropertyAnnotations(string $name);

    public function getTypedProperties(string $type, string $name);

    public function getPropertiesWith(string $type);
}