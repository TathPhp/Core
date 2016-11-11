<?php
declare(strict_types=1);

namespace Tath\Core\Tests\Fixtures;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class AnnotationA
 * @package Tath\Core\Tests\Fixtures
 *
 * @Annotation
 * @Target({"ALL"})
 */
class AnnotationA
{
    public $apples;

    public $airplanes;

    public $ants;
}
