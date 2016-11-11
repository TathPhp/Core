Tath Core
=========
Tath Core is a library which is intended to support the not yet written Tath
library which will offer the ability to generate forms and grids for Symfony
using annotations, similarly to how Doctrine can create schema from annotations.

**Tath and by extension Tath Core are under active development and the interface
should not be considered stable.**

AnnotationTool
--------------
This class wraps the Doctrine 
[AnnotationReader](http://docs.doctrine-project.org/projects/doctrine-common/en/latest/reference/annotations.html)
to make it easier to read the annotations you're interested in.

Annotations are classes which themselves are annotated with @Annotation:

    /**
     * @Annotation
     * @Target({"ALL"})
     */
    class Bobo
    {
        public $foo;
    }
    
See [Annotation Classes](http://docs.doctrine-project.org/projects/doctrine-common/en/latest/reference/annotations.html#annotation-classes)
in the Doctrine documentation.

The examples in the documentation here are based on the following example class:

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

The full source for this class and the examples below can be found in
annotatoin_tool_example.php.

### AnnotationTool::make($className)
Make an AnnotationTool for the provided class. These are cached and re-used when
the same class is requested again since code should not mutate during execution.
Annotations are lazy loaded as needed into the cache.

    $tool = AnnotationTool::make(Foo::class);
    
### AnnotationTool->getClassAnnotations()
Gets all class level annotations.

    $tool->getClassAnnotations();

This would return an array of one Waldo instance for Foo.

### AnnotationTool->getClassAnnotationsOfType($annotationClassName)
Gets all class level annotations of the specified type. Note that annotations may be
repeated, so this returns an array even when only one annotation is present.

    $tool->getClassAnnotationsOfType(Waldo::class);
    
This would return the same single instance of Waldo since that's all we have in the
example. If we had asked for a different class it would have returned an empty array.

### AnnotationTool->getMethods()
Gets an associative array of methods and their annotations. The array keys are method
names, and the values are arrays of annotation instances.

    $tool->getMethods();
    
This would return a single key / value pair with a key 'baz' and a value containing
an array of a single Grault instance.

### AnnotationTool->->getMethodAnnotations($methodName)
Gets an array of all annotations for the provided method name.

    $tool->getMethodAnnotations('baz')
    
Returns an array with a single Grault instance.

### AnnotationTool->getTypedMethods($annotationClassName, $methodName)
Gets an array of the requested annotation type for the provided method name.

    $tool->getTypedMethods(Grault::class, 'baz')
    
Returns an array with a single Grault instance. If a different annotation class name
was provided then this would have returned an empty array.

### AnnotationTool->getMethodsWith($annotationClassName)
Gets an associative array of method name keys and array values. The value arrays contain
only the requested annotation type. If no methods have the requested annotation type then
an empty array is returned.

    $tool->getMethodsWith(Grault::class)

This would return a single key / value pair with a key 'baz' and a value containing
an array of a single Grault instance.

### AnnotationTool->getProperties()
Gets an associative array of properties and their annotations. The array keys are 
property names, and the values are arrays of annotation instances.

    $tool->getProperties()
    
This would return a single key / value pair with a key 'bar' and a value containing
an array of a single Plugh instance.

### AnnotationTool->getPropertyAnnotations('bar')
Gets an array of all annotations for the provided property name.

    $tool->getPropertyAnnotations('bar')
    
Returns an array with a single Plugh instance.

### AnnotationTool->getTypedProperties(Plugh::class, 'bar')
Gets an array of the requested annotation type for the provided property name.

    $tool->getTypedProperties(Plugh::class, 'bar')
    
Returns an array with a single Plugh instance. If a different annotation class name
was provided then this would have returned an empty array.

### AnnotationTool->getPropertiesWith(Plugh::class)
Gets an associative array of property name keys and array values. The value arrays contain
only the requested annotation type. If no properties have the requested annotation type then
an empty array is returned.

    $tool->getPropertiesWith(Plugh::class)
    
This would return a single key / value pair with a key 'bar' and a value containing
an array of a single Plugh instance.
