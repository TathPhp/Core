<?php
declare(strict_types=1);

namespace Tath\Core\Tests\Classes;

use Tath\Core\Classes\AnnotationTool;
use Tath\Core\Tests\Fixtures\AnnotationA;
use Tath\Core\Tests\Fixtures\AnnotationB;
use Tath\Core\Tests\Fixtures\Bar;
use Tath\Core\Tests\Fixtures\Baz;
use Tath\Core\Tests\Fixtures\EntityClass;
use Tath\Core\Tests\Fixtures\Foo;

class AnnotationToolTest extends \PHPUnit_Framework_TestCase
{
    public function testRecycling()
    {
        $toolA = AnnotationTool::make(EntityClass::class);
        $toolB = AnnotationTool::make(EntityClass::class);
        $this->assertTrue($toolA === $toolB);
    }

    public function testHasProperties()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertEquals(3, count($tool->getProperties()));
    }

    public function testHasPropertyAnnotations()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertEquals(1, count($tool->getPropertyAnnotations('foo')));
        $this->assertEquals(2, count($tool->getPropertyAnnotations('bar')));
        $this->assertNull($tool->getPropertyAnnotations('unicorn'));
    }

    public function testDuplicateOnProperty()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $propertyAnnotations = $tool->getPropertyAnnotations('baz');
        $this->assertEquals(2, count($propertyAnnotations));
        foreach ($propertyAnnotations as $propertyAnnotation) {
            $this->assertInstanceOf(AnnotationA::class, $propertyAnnotation);
        }
    }

    public function testHasTypedOnProperty()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertInstanceOf(
            AnnotationA::class,
            $tool->getTypedProperties(AnnotationA::class, 'bar')[0]
        );
        $this->assertInstanceOf(
            AnnotationB::class,
            $tool->getTypedProperties(AnnotationB::class, 'bar')[0]
        );
        $typedProperties = $tool->getTypedProperties(AnnotationA::class, 'baz');
        $this->assertCount(2, $typedProperties);
        foreach ($typedProperties as $typedProperty) {
            $this->assertInstanceOf(AnnotationA::class, $typedProperty);
        }
    }

    public function testHasTypedPropertyNoType()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertCount(0, $tool->getTypedProperties(AnnotationB::class, 'foo'));
    }

    public function testHasTypedPropertyNoProperty()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertCount(0, $tool->getTypedProperties(AnnotationA::class, 'unicorn'));
    }

    public function testPropertiesWith()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $fieldsA = $tool->getPropertiesWith(AnnotationA::class);
        $fieldsB = $tool->getPropertiesWith(AnnotationB::class);
        $this->assertCount(3, $fieldsA);
        $this->assertCount(1, $fieldsB);
        $this->assertArrayHasKey('bar', $fieldsB);
    }

    public function testHasMethods()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertEquals(6, count($tool->getMethods()));
    }

    public function testHasMethodAnnotations()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertEquals(1, count($tool->getMethodAnnotations('getFoo')));
        $this->assertEquals(2, count($tool->getMethodAnnotations('getBar')));
        $this->assertNull($tool->getMethodAnnotations('getUnicorn'));
    }

    public function testDuplicateOnMethod()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $annotations = $tool->getMethodAnnotations('getBaz');
        $this->assertEquals(2, count($annotations));
        foreach ($annotations as $annotation) {
            $this->assertInstanceOf(AnnotationA::class, $annotation);
        }
    }

    public function testHasTypedOnMethod()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertInstanceOf(
            AnnotationA::class,
            $tool->getTypedMethods(AnnotationA::class, 'getBar')[0]
        );
        $this->assertInstanceOf(
            AnnotationB::class,
            $tool->getTypedMethods(AnnotationB::class, 'getBar')[0]
        );
        $typedMethods = $tool->getTypedMethods(AnnotationA::class, 'getBaz');
        $this->assertCount(2, $typedMethods);
        foreach ($typedMethods as $typedMethod) {
            $this->assertInstanceOf(AnnotationA::class, $typedMethod);
        }
    }

    public function testHasTypedOnMethodNoType()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertCount(0, $tool->getTypedMethods(AnnotationB::class, 'getFoo'));
    }

    public function testHasTypedOnMethodNoMethod()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $this->assertCount(0, $tool->getTypedMethods(AnnotationA::class, 'unicorn'));
    }

    public function testMethodsWith()
    {
        $tool = AnnotationTool::make(EntityClass::class);
        $methodsA = $tool->getMethodsWith(AnnotationA::class);
        $methodsB = $tool->getMethodsWith(AnnotationB::class);
        $this->assertCount(3, $methodsA);
        $this->assertCount(1, $methodsB);
        $this->assertArrayHasKey('getBar', $methodsB);
    }

    public function testClassAnnotations()
    {
        $fooTool = AnnotationTool::make(Foo::class);
        $barTool = AnnotationTool::make(Bar::class);
        $bazTool = AnnotationTool::make(Baz::class);
        $this->assertCount(1, $fooTool->getClassAnnotations());
        $this->assertCount(2, $barTool->getClassAnnotations());
        $annotations = $barTool->getClassAnnotationsOfType(AnnotationA::class);
        $this->assertCount(1, $annotations);
        $this->assertInstanceOf(AnnotationA::class, $annotations[0]);
        $this->assertCount(2, $bazTool->getClassAnnotations());
    }
}
