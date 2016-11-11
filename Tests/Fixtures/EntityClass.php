<?php
declare(strict_types=1);

namespace Tath\Core\Tests\Fixtures;

class EntityClass
{
    /**
     * @var string
     * @AnnotationA
     */
    private $foo;

    /**
     * @AnnotationA
     * @AnnotationB
     */
    private $bar;

    /**
     * @AnnotationA
     * @AnnotationA
     */
    private $baz;

    /**
     * @AnnotationA
     * @return string
     */
    public function getFoo()
    {
        return $this->foo;
    }

    /**
     * @param string $foo
     * @return EntityClass
     */
    public function setFoo($foo)
    {
        $this->foo = $foo;
        return $this;
    }

    /**
     * @AnnotationA
     * @AnnotationB
     * @return mixed
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * @param mixed $bar
     * @return EntityClass
     */
    public function setBar($bar)
    {
        $this->bar = $bar;
        return $this;
    }

    /**
     * @AnnotationA
     * @AnnotationA
     * @return mixed
     */
    public function getBaz()
    {
        return $this->baz;
    }

    /**
     * @param mixed $baz
     * @return $this
     */
    public function setBaz($baz)
    {
        $this->baz = $baz;
        return $this;
    }
}
