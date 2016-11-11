<?php
declare(strict_types=1);

namespace Tath\Core\Tests\Classes;

use Doctrine\Common\Collections\ArrayCollection;
use Tath\Core\Classes\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testMakeFromArrayCollection()
    {
        $items = ['foo', 'bar', 'baz'];
        $arrayCollection = new ArrayCollection($items);
        $collection = Collection::make($arrayCollection);
        $this->assertEquals($items, $collection->toArray());
    }

    public function testMakeFromArray()
    {
        $items = ['foo', 'bar', 'baz'];
        $collection = Collection::make($items);
        $this->assertEquals($items, $collection->toArray());
    }
}
