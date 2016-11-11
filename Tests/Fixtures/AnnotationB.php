<?php
declare(strict_types=1);

namespace Tath\Core\Tests\Fixtures;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class AnnotationB
 * @package Tath\Core\Tests\Fixtures
 *
 * @Annotation
 * @Target({"ALL"})
 */
class AnnotationB
{
    public $bananas;

    public $boats;

    public $beatles;
}
