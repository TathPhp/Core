<?php

namespace Tath\Core\Traits;

trait DescribeObjectTrait
{
    protected static function describeObject($from)
    {
        return method_exists($from, '__toString') ?
            get_class($from) . ' / ' . strval($from) :
            get_class($from);
    }
}
