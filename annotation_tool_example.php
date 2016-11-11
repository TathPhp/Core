<?php
declare(strict_types=1);

namespace Tath\Core;

use Doctrine\Common\Annotations\Annotation\Target;

require_once 'vendor/autoload.php';

/**
 * @Annotation
 * @Target({"CLASS"})
 */
class Waldo
{
    public $bobo;
}

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Plugh
{
    public $wibble;
}

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class Grault
{
    public $garply;
}

/**
 * Class Foo
 * @Waldo(bobo="tea")
 */
class Foo {
    /**
     * @Plugh(wibble="wobble")
     */
    public $bar;

    /**
     * @Grault(garply="corge")
     */
    public function baz() {}
}

$tool = \Tath\Core\Classes\AnnotationTool::make(Foo::class);

echo "### \$tool->getClassAnnotations()\n";
var_dump(
    $tool->getClassAnnotations()
);

echo "### \$tool->getClassAnnotationsOfType(Waldo::class)\n";
var_dump(
    $tool->getClassAnnotationsOfType(Waldo::class)
);

echo "### \$tool->getMethods()\n";
var_dump(
    $tool->getMethods()
);

echo "### \$tool->getMethodAnnotations('baz')\n";
var_dump(
    $tool->getMethodAnnotations('baz')
);

echo "### \$tool->getTypedMethods(Grault::class, 'baz')\n";
var_dump(
    $tool->getTypedMethods(Grault::class, 'baz')
);

echo "### \$tool->getMethodsWith(Grault::class)\n";
var_dump(
    $tool->getMethodsWith(Grault::class)
);

echo "### \$tool->getProperties()\n";
var_dump(
    $tool->getProperties()
);

echo "### \$tool->getPropertyAnnotations('bar')\n";
var_dump(
    $tool->getPropertyAnnotations('bar')
);

echo "### \$tool->getTypedProperties(Plugh::class, 'bar')\n";
var_dump(
    $tool->getTypedProperties(Plugh::class, 'bar')
);

echo "### \$tool->getPropertiesWith(Plugh::class)\n";
var_dump(
    $tool->getPropertiesWith(Plugh::class)
);
