<?php

namespace Tath\Core\Exceptions;

use Tath\Core\Traits\DescribeObjectTrait;

class MissingArgumentException extends \Exception
{
    use DescribeObjectTrait;

    public static function makeWithArgumentNameAndFrom($argumentName, $from)
    {
        if (is_object($from)) {
            $from = self::describeObject($from);
        }
        return new static("Argument $argumentName missing from $from.");
    }
}
