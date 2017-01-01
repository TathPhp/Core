<?php

namespace Tath\Core\Exceptions;

use Tath\Core\Traits\DescribeObjectTrait;

class MissingAnnotationException extends \Exception
{
    use DescribeObjectTrait;

    public static function makeWithAnnotationNameAndFrom($annotationName, $from)
    {
        if (is_object($from)) {
            $from = self::describeObject($from);
        }
        return new static("Annotation $annotationName missing from $from.");
    }
}
